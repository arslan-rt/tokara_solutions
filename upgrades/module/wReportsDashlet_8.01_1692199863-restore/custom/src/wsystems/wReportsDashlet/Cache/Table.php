<?php
namespace Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet\Cache;

use Exception;
use Sugarcrm\Sugarcrm\Dbal\Query\QueryBuilder;

class Table extends AbstractCache
{

    /**
     *
     * @param mixed $key
     *
     * @return bool
     */
    public function _has($key)
    {
        $rowset = $this->_fetch($key);

        if (count($rowset) > 0) {
            $this->_data = $rowset;

            return true;
        } else {
            $this->_data = null;

            return false;
        }
    }

    /**
     *
     * @param mixed $key
     *
     * @return mixed
     */
    public function _get($key)
    {
        $_data = null;

        if (is_null($this->_data) === false) {
            $_data = $this->_data;
        } else {
            $_data = $this->_fetch($key);
        }

        if (count($_data) === 0) {
            return null;
        }

        $_data = $_data[0]["cache_data"];

        return json_decode($_data);
    }

    /**
     *
     * @param mixed $key
     * @param mixed $data
     *
     * @return true
     */
    public function _set($key, $data)
    {
        global $timedate;

        $serialized = json_encode($data);

        $expiry = $timedate->getNow()
                           ->modify("+{$this->ttl} seconds")
                           ->asDb();

        $this->_delete($key);
        $this->_insert($key, $serialized, $expiry);

        return true;
    }

    /**
     *
     * @return QueryBuilder
     *
     * @throws Exception
     */
    protected function _query()
    {
        $db      = \DBManagerFactory::getInstance();
        $builder = $db->getConnection()->createQueryBuilder();

        return $builder;
    }

    /**
     *
     * @param mixed $key
     *
     * @return mixed[]
     */
    protected function _fetch($key)
    {
        global $timedate;

        $now = $timedate->getNow()->asDb();

        $query = $this->_query();

        $query->select("cache_data")
              ->from("wreportsdashlet_cache")
              ->where(
                  $query->expr()->andX(
                      $query->expr()->eq("cache_key", ":key"),
                      $query->expr()->gte("cache_expire", ":expiry")
                  )
              )
              ->setParameter(":key", $key)
              ->setParameter(":expiry", $now)
              ->setFirstResult(0)
              ->setMaxResults(1);

        $result = $query->execute()->fetchAll();

        return $result;
    }

    /**
     *
     * @param mixed $key
     *
     * @return true
     */
    protected function _delete($key)
    {
        $query = $this->_query();

        $query->delete("wreportsdashlet_cache")
              ->where("cache_key = :key")
              ->setParameter("key", $key)
              ->execute();

        return true;
    }

    /**
     *
     * @param mixed $key
     * @param mixed $data
     * @param mixed $expiry
     *
     * @return true
     */
    protected function _insert($key, $data, $expiry)
    {
        $query = $this->_query();

        $query->insert("wreportsdashlet_cache")
              ->values(
                  array(
                      "cache_key"    => ":key",
                      "cache_data"   => ":data",
                      "cache_expire" => ":expiry",
                  )
              )
              ->setParameter("key", $key)
              ->setParameter("data", $data)
              ->setParameter("expiry", $expiry)
              ->execute();

        return true;
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
