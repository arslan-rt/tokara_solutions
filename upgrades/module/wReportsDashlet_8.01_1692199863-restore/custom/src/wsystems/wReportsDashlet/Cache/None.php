<?php
namespace Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\Cache;

class None extends AbstractCache
{
    protected function _has($key)
    {
        return false;
    }

    protected function _get($key)
    {
        return false;
    }

    protected function _set($key, $data)
    {
        return false;
    }

    protected function _should()
    {
        return false;
    }

    protected function _getCache($key)
    {}
}
