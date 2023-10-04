<?php

namespace Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet;

use Configurator;
use SugarConfig;

class Config
{

    /**
     *
     * @return mixed
     */
    public static function getLoggingLevel()
    {
        $config = SugarConfig::getInstance();
        $level  = $config->get("logger.channels.wReportsDashlet.level", "SYSTEM");

        return $level;
    }

    /**
     *
     * @param mixed $level
     *
     * @return true|void
     */
    public static function setLoggingLevel($level)
    {
        if (self::getLoggingLevel() === $level) {
            return true;
        }

        $configurator = new Configurator();

        if ($level === "SYSTEM") {
            $configurator->config["logger"]["channels"]["wReportsDashlet"] = array();
        } else {
            $configurator->config["logger"]["channels"]["wReportsDashlet"]["level"] = $level;
        }

        $configurator->handleOverride();
    }

    /**
     *
     * @return mixed
     */
    public static function getCacheBackend()
    {
        $config = SugarConfig::getInstance();
        $level  = $config->get("wReportsDashlet.cache.backend", "none");

        return $level;
    }

    /**
     *
     * @param mixed $backend
     *
     * @return true|void
     */
    public static function setCacheBackend($backend)
    {
        if (self::getCacheBackend() === $backend) {
            return true;
        }

        $configurator                                                = new Configurator();
        $configurator->config["wReportsDashlet"]["cache"]["backend"] = $backend;

        $configurator->handleOverride();
    }
}
