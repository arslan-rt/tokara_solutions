<?php

namespace Sugarcrm\Sugarcrm\custom\wsystems\wEnhancedScheduledReports\Traits;

use Configurator;

trait SugarConfigTrait
{
    /**
     * @var Configurator
     */
    protected $config = null;

    /**
     * Saves data to config_override.php file.
     *
     * @param string $key
     * @param mixed $value
     *
     * @return void
     */
    public function configSet(string $key, $value): void
    {
        $config = $this->configInstance();

        $config->loadConfig();
        $config->config[$key] = $value;
        $config->handleOverride();
        $config->clearCache();
    }

    /**
     * Retrieves data from config_override.php file.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function configGet(string $key)
    {
        $this->configInstance()->loadConfig();

        return $this->configInstance()->config[$key];
    }

    /**
     * @return Configurator
     */
    protected function configInstance(): Configurator
    {
        if ($this->config instanceof Configurator === false) {
            $this->config = new Configurator();
        }

        return $this->config;
    }
}
