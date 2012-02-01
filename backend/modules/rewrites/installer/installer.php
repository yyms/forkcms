<?php

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

/**
 * Installer for the rewrites module
 *
 * @author Davy Hellemans <davy.hellemans@netlash.com>
 */
class RewritesInstaller extends ModuleInstaller
{
	const MODULE = 'rewrites';

	public function install()
	{
		// load install.sql
		$this->importSQL(dirname(__FILE__) . '/data/install.sql');

		// add this module
		$this->addModule(self::MODULE);

		// import locale
		$this->importLocale(dirname(__FILE__) . '/data/locale.xml');

		// module rights
		$this->setModuleRights(1, self::MODULE);

		// action rights
		$this->setActionRights(1, self::MODULE, 'add');
		$this->setActionRights(1, self::MODULE, 'delete');
		$this->setActionRights(1, self::MODULE, 'edit');
		$this->setActionRights(1, self::MODULE, 'index');

		// set navigation
		$navigationModulesId = $this->setNavigation(null, 'Modules');
		$this->setNavigation($navigationModulesId, 'Rewrites', 'rewrites/index', array('rewrites/add', 'rewrites/edit'));
	}
}
