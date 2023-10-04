<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils;

use TimeDate;

class TimeDateUtils
{
    /**
     * fromTimeStampToDB function
     *
     * @param String $ts  timestamp ex:1550854800000
     * @return void
     */
    public static function fromTimeStampToDB($ts, $isMiliseconds, $onlyTime = true)
    {
        if ($isMiliseconds === true) {
            $ts = (int) ($ts / 1000);
        }

        $result = TimeDate::fromTimestamp($ts);

        if ($onlyTime) {
            return $result->asDbDate();
        } else {
            return $result->asDb();
        }
    }
}
