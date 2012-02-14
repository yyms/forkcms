<?php

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

/**
 * This is the edit-action, it will display a form to edit an existing item
 *
 * @author Davy Hellemans <davy.hellemans@netlash.com>
 */
class BackendRedirectEdit extends BackendBaseActionEdit
{
	public function execute()
	{
		$this->id = $this->getParameter('id', 'int');

		if($this->id !== null && BackendRedirectModel::exists($this->id))
		{
			parent::execute();

			$this->getData();
			$this->loadForm();
			$this->validateForm();
			$this->parse();
			$this->display();
		}

		// no item found
		else $this->redirect(BackendModel::createURLForAction('index') . '&error=non-existing');
	}

	protected function getData()
	{
		$this->record = (array) BackendRedirectModel::get($this->id);

		// no item found
		if(empty($this->record))
		{
			$this->redirect(BackendModel::createURLForAction('index') . '&error=non-existing');
		}
	}

	protected function loadForm()
	{
		$this->frm = new BackendForm('edit');
		$this->frm->addText('source', $this->record['source']);
		$this->frm->addText('destination', $this->record['destination']);
	}

	protected function parse()
	{
		parent::parse();
		$this->tpl->assign('item', $this->record);
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
					'edited_on' => BackendModel::getUTCDate()
				);

				BackendRedirectModel::update($this->id, $item);

				// hooks
				BackendModel::triggerEvent($this->getModule(), 'after_edit', array('item' => $item));

				// to index action
				$this->redirect(
					BackendModel::createURLForAction('index') .
					'&report=edited&&id=' . $this->id .
					'&highlight=row-' . $this->id
				);
			}
		}
	}
}
