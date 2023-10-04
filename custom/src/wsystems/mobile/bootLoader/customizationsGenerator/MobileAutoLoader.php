<?php

class_alias('SugarAutoLoader', 'AutoLoadSugarMobile');

class MobileAutoLoader extends AutoLoadSugarMobile
{
    public static function put($filename, $data, $save = false)
    {
        return parent::put($filename, $data, $save);
    }

    public static function getDirFiles($dir, $get_dirs = false, $extension = null, $recursive = false)
    {
        return parent::getDirFiles($dir, $get_dirs, $extension, $recursive);
    }
}
