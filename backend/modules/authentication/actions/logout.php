<?php

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

/**
 * This is the logout-action, it will logout the current user
 *
 * @author Tijs Verkoyen <tijs@sumocoders.be>
 */
class BackendAuthenticationLogout extends BackendBaseAction
{
	/**
	 * Execute the action
	 */
	public function execute()
	{
		parent::execute();

		if(BackendAuthentication::getUser()->isAuthenticated())
		{
			$userId = BackendAuthentication::getUser()->getUserId();

			BackendAuthentication::logout();

			$this->logger->info(
				'Logout',
				array(
					'user_id' => $userId
				)
			);
		}

		// redirect to login-screen
		$this->redirect(BackendModel::createUrlForAction('index', $this->getModule()));
	}
}
