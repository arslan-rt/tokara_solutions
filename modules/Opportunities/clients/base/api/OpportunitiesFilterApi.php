<?php
/*
 * Your installation or use of this SugarCRM file is subject to the applicable
 * terms available at
 * http://support.sugarcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this SugarCRM file.
 *
 * Copyright (C) SugarCRM Inc. All rights reserved.
 */

class OpportunitiesFilterApi extends FilterApi
{
    /**
     * @inheritdoc
     */
    public function registerApiRest()
    {
        $api = parent::registerApiRest();
        $api['filterModuleAll']['path'] = ['Opportunities'];

        return $api;
    }

    /**
     * @inheritdoc
     */
    public function filterListSetup(ServiceBase $api, array $args, $acl = 'list')
    {
        $filterSetup = parent::filterListSetup($api, $args, $acl);

        // if Forecast specific arguments are present, add those to the filter def
        if (isset($args['user_id'], $args['type'], $args['time_period'], $args['metrics'])) {
            $options = $filterSetup[2];
            $query = $filterSetup[1];

            //We need to add the filter to this query to this to handle view
            //api parameters
            if (isset($options['id_query'])) {
                $options['id_query'] = $this->addForecastFilter($api, $args, $options['id_query']);
            }

            $filterSetup[1] = $this->addForecastFilter($api, $args, $query);
        }
        return $filterSetup;
    }

    /**
     * Adds the forecast Filter parameters to the filter generated by the
     * FilterApi
     * @param ServiceBase $api The REST API object.
     * @param array $args REST API arguments.
     * @param SugarQuery $query The query the filter is going to be added to.
     * @return SugarQuery The query with the additional filters applied.
     * @throws SugarApiExceptionNotFound
     */
    private function addForecastFilter(ServiceBase $api, array $args, SugarQuery $query)
    {
        $forecastUserId = $args["user_id"];
        $forecastUserType = $args["type"];
        $forecastTimePeriodId = $args["time_period"];
        $metrics = $args['metrics'] ?? [];
        $filterDef = [];

        $filterDef = $this->addForecastDateClosedFilter($filterDef, $forecastTimePeriodId);

        $filterDef = $this->addForecastAssignedUserFilter($filterDef, $forecastUserType, $forecastUserId);

        if (!empty($metrics)) {
            $filterDef = $this->addForecastMetricsFilter($filterDef, $metrics);
        }

        // Add filters to the query
        self::addFilters($filterDef, $query->where(), $query);

        return $query;
    }

    /**
     * Adds the forecast Filter parameters to the filter generated by the
     * FilterApi
     * @param ServiceBase $api The REST API object.
     * @return SugarQuery The query with the additional filters applied.
     * @throws SugarApiExceptionNotFound
     */
    protected function addForecastDateClosedFilter($filterDef, $forecastTimePeriodId)
    {
        $admin = BeanFactory::getBean('Administration', null);
        $forecastsSettings = $admin->getConfigForModule('Forecasts', 'base', true);

        if (is_null($forecastTimePeriodId)) {
            $forecastTimePeriodId = TimePeriod::getCurrentId();
        }

        $timePeriod = BeanFactory::retrieveBean('TimePeriods', $forecastTimePeriodId);

        if (!$timePeriod) {
            $timePeriod = TimePeriod::getCurrentTimePeriod($forecastsSettings['timeperiod_leaf_interval']);
        }

        array_push($filterDef, [
            'date_closed' => [
                '$dateBetween' => [
                    $timePeriod->start_date,
                    $timePeriod->end_date,
                ],
            ],
        ]);

        return $filterDef;
    }

    /**
     * Adds the forecast Filter parameters to the filter generated by the
     * FilterApi
     * @param ServiceBase $api The REST API object.
     * @return SugarQuery The query with the additional filters applied.
     * @throws SugarApiExceptionNotFound
     */
    protected function addForecastAssignedUserFilter($filterDef, $forecastUserType, $forecastUserId)
    {
        $reportees = [];
        if ($forecastUserType == 'Rollup') {
            $reportees = Forecast::getAllReporteesIds([$forecastUserId]);
        }
        $reportees[] = $forecastUserId;

        array_push($filterDef, [
            'assigned_user_id' => [
                '$in' => $reportees,
            ],
        ]);

        return $filterDef;
    }

    /**
     * Adds the forecast Filter parameters to the filter generated by the
     * FilterApi
     * @param ServiceBase $api The REST API object.
     * @return SugarQuery The query with the additional filters applied.
     * @throws SugarApiExceptionNotFound
     */
    protected function addForecastMetricsFilter($filterDef, $metrics)
    {
        foreach ($metrics as $metric) {
            if (!empty($metric['filter'])) {
                foreach ($metric['filter'] as $filter) {
                    $filterDef[] = $filter;
                }
            }
        }

        return $filterDef;
    }
}
