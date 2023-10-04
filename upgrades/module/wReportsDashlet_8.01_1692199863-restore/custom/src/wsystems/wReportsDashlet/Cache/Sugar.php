<?php
namespace Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\Cache;

class Sugar extends AbstractCache
{

    /**
     *
     * @param mixed $key
     *
     * @return bool
     */
    public function _has($key)
    {
        $this->_data = \SugarCache::instance()->get($key);

        return $this->_data !== null;
    }

    /**
     * Implementation is broken because otherwise we would have to make 2 round trips
     * and get the same value to both check existance and get the content.
     * SugarCRM doesn't implement a real has() or isset() method, they just get the
     * value from the server and then verify wether it's null or not.
     * Bad SugarCRM. Bad. (or maybe good - they avoid 2 connections to the ES server?)
     *
     * @param mixed $key
     * @return mixed
     */
    public function _get($key)
    {
        $_data = null;

        if (is_null($this->_data) === false) {
            $_data = $this->_data;
        } else {
            $_data = \SugarCache::instance()->get($key);
        }

        return json_decode($_data);
    }

    /**
     *
     * @param mixed $key
     * @param mixed $data
     *
     * @return void
     */
    public function _set($key, $data)
    {
        $serialized = json_encode($data);

        \SugarCache::instance()->set($key, $serialized, $this->ttl);
    }

    protected function _getCache($key)
    {
        if (is_array($this->_data) === true) {
            $data = array_shift($this->_data)["cache_data"];

            return empty($data) === false ? json_decode($data) : null;
        }

        return null;
    }
}
