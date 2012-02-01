<?php

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

/**
 * This is the add-action, it will display a form to create a new item
 *
 * @author Davy Hellemans <davy.hellemans@netlash.com>
 */
class BackendRewritesAdd extends BackendBaseActionAdd
{
	public function execute()
	{
		parent::execute();
		$this->loadForm();
		$this->validateForm();
		$this->parse();
		$this->display();
	}

	protected function loadForm()
	{
		$this->frm = new BackendForm('add');
		$this->frm->addText('source');
		$this->frm->addText('destination');
		$this->frm->addCheckbox('is_regexp');
	}

	protected function validateForm()
	{
		if($this->frm->isSubmitted())
		{
			$this->frm->cleanupFields();

			$this->frm->getField('source')->isFilled(BL::err('FieldIsRequired'));
			$this->frm->getField('destination')->isFilled(BL::err('FieldIsRequired'));

			if($this->frm->isCorrect())
			{
				$item = array(
					'source' => $this->frm->getField('source')->getValue(),
					'destination' => $this->frm->getField('destination')->getValue(),
					'is_regexp' => ($this->frm->getField('is_regexp')->getValue()) ? 'Y' : 'N',
					'created_on' => BackendModel::getUTCDate(),
					'edited_on' => BackendModel::getUTCDate()
				);

				$id = BackendRewritesModel::insert($item);

				// hook
				BackendModel::triggerEvent($this->getModule(), 'after_add', array('item' => $item));

				// index page
				$this->redirect(
					BackendModel::createURLForAction('index') . '&report=added&highlight=row-' . $id
				);
			}
		}
	}
}
