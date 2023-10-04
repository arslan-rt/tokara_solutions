<?php

class_alias("SugarAutoLoader", "AutoLoadSugar");

class SugarAutoLoaderCustom extends AutoLoadSugar
{
    public static function put($filename, $data, $save = false)
    {
        return parent::put($filename, $data, $save);
    }

    public static function touchCustom($filename, $save = false)
    {
        return parent::touch($filename, $save);
    }

    public static function unlinkCustom($filename, $save = false)
    {
        return parent::unlink($filename, $save);
    }
}
