<?php
/*
 * Your installation or use of this SugarCRM file is subject to the applicable
 * terms available at
 * http://support.sugarcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this SugarCRM file.
 *
 * Copyright (C) SugarCRM Inc. All rights reserved.
 */

class SugarUpgradePreHintMigrate extends UpgradeScript
{
    public function run()
    {
        if ($this->shouldRun()) {
            $this->log('Uninstall previous Hint package');
            $this->uninstallHint();
        }
    }

    /**
     * Determines if this upgrader should run
     *
     * @return bool true if the upgrader should run
     */
    protected function shouldRun()
    {
        $upgradeHistory = (new UpgradeHistory())->retrieveByIdName('hint-package');
        return $upgradeHistory instanceof SugarBean && $upgradeHistory->status === 'installed' &&
            version_compare($this->from_version, '12.0.0', '<');
    }

    public function uninstallHint()
    {
        $pkgMgr = new \Sugarcrm\Sugarcrm\PackageManager\PackageManager();
        $upgradeHistory = (new UpgradeHistory())->retrieveByIdName('hint-package');
        $removeTables = false;
        $pkgMgr->uninstallPackage($upgradeHistory, $removeTables);
    }
}
