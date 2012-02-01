<?php

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

/**
 * This action will delete a rewrite rule.
 *
 * @author Davy Hellemans <davy.hellemans@netlash.com>
 */
class BackendRewritesDelete extends BackendBaseActionDelete
{
	public function execute()
	{
		$this->id = $this->getParameter('id', 'int');

		if($this->id !== null && BackendRewritesModel::exists($this->id))
		{
			parent::execute();

			BackendRewritesModel::delete($this->id);

			// hooks
			BackendModel::triggerEvent($this->getModule(), 'after_delete', array('id' => $this->id));

			// to index action
			$this->redirect(BackendModel::createURLForAction('index') . '&report=deleted');
		}

		// something went wrong
		else $this->redirect(BackendModel::createURLForAction('index') . '&error=non-existing');
	}
}
