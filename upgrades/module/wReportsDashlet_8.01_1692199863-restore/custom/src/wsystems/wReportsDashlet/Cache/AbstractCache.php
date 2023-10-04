<?php
namespace Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\Cache;

abstract class AbstractCache
{
    protected $_key;
    protected $_data = null;

    protected $runner;
    protected $refresh;

    public $ttl = 24 * 60 * 60;

    public function __construct($runner, $refresh = false)
    {
        $this->runner  = $runner;
        $this->refresh = $refresh;
    }

    /**
     *
     * @return mixed
     */
    public function key()
    {
        if (empty($this->_key) === false) {
            return $this->_key;
        }

        global $current_user;

        $this->_key = "WREPORTS_"
        . $current_user->id . "_"
        . $this->runner->report->saved_report_id . "_"
        . md5(json_encode($this->runner->sort)) . "_"
            . ($this->runner->linked ? md5(json_encode($this->runner->link)) : "UNLINKED");

        return $this->_key;
    }

    /**
     *
     * @return mixed
     */
    public function getCache()
    {
        $data = null;

        if ($this->_should() && $this->_has($this->key())) {
            $data = $this->_getCache($this->key());
        }

        if (is_null($data)) {
            $this->runner->run();

            $data = $this->runner->apiFormat();

            $this->_set($this->key(), $data);
        }

        return $data;
    }

    /**
     *
     * @return bool
     */
    protected function _should()
    {
        return !$this->refresh;
    }

    abstract protected function _has($key);

    abstract protected function _getCache($key);

    abstract protected function _set($key, $data);
}
