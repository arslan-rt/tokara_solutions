<?php

namespace Sugarcrm\Sugarcrm\custom\wsystems\HookedFilterApi\Traits;

use LogicHook;

/**
 * *** HookTrait ***
 *
 * This trait is mainly designed to allow triggering basic/custom logic hooks,
 * either for a certain module or global, when needed.
 *
 * Besides this, it also can list existing hooks registered either globally or for a module.
 *
 * @package HookedFilterApi
 * @author Vali Bratulescu
 * @version 1.0.0
 * @since SugarCRM 8.0
 * @since PHP 7.1
 *
 * *** Methods available ***
 *
 * @method hookTrigger
 * @method hookList
 */
trait HookTrait
{
    /**
     * @access protected
     *
     * @var LogicHook
     */
    protected $hook = null;

    /**
     * Triggers logic hooks.
     * If module is passed in, it will trigger that module logic hook,
     * otherwise, it will trigger the global application logic hook.
     *
     * @param string|null $module
     * @param string $event
     * @param array $arguments
     *
     * @return void
     */
    public function hookTrigger(?string $module, string $event, array $arguments): void
    {
        $this->hookInstance()->call_custom_logic($module, $event, $arguments);
    }

    /**
     * Returns a list with the logic hooks registered for the given module.
     * If no module is passed in, it will return global logic hooks.
     *
     * @param null|string $module
     *
     * @return array
     */
    public function hookList(?string $module): array
    {
        return $this->hookInstance()->getHooks($module, true);
    }

    /**
     * Retrieves the LogicHook instance.
     *
     * @access protected
     *
     * @return LogicHook
     */
    protected function hookInstance(): LogicHook
    {
        if ($this->hook instanceof LogicHook === false) {
            $this->hook = LogicHook::initialize();
        }

        return $this->hook;
    }
}
