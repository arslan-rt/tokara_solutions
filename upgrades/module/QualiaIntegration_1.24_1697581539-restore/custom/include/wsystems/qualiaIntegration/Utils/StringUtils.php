<?php

namespace Sugarcrm\Sugarcrm\custom\inc\wsystems\qualiaIntegration\Utils;

class StringUtils
{
    /**
     * Check if the variabile is empty or null
     *
     * @param String $str
     * @return boolean
     */
    public static function isNotNullOrEmptyString($str)
    {
        return (isset($str) && trim($str) !== '');
    }
}
