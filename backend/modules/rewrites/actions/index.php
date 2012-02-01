<?php

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

/**
 * This is the index-action (default), it will display the overview of rewrites
 *
 * @author Davy Hellemans <davy.hellemans@netlash.com>
 */
class BackendRewritesIndex extends BackendBaseActionIndex
{
	public function execute()
	{
		parent::execute();
		$this->loadDataGrid();
		$this->parse();
		$this->display();
	}

	protected function loadDataGrid()
	{
		$this->dataGrid = new BackendDataGridDB(BackendRewritesModel::QRY_DATAGRID_BROWSE);

		// labels
		$this->dataGrid->setHeaderLabels(
			array('is_regexp' => ucfirst(BL::lbl('RegularExpression')))
		);

		// sorting
		$this->dataGrid->setSortingColumns(
			array('source', 'destination', 'is_regexp', 'created_on'),
			'source'
		);

		// long date
		$this->dataGrid->setColumnFunction(
			array('BackendDataGridFunctions', 'getLongDate'),
			array('[created_on]'),
			'created_on',
			true
		);

		// edit column
		$this->dataGrid->addColumn(
			'edit',
			null,
			BL::lbl('Edit'),
			BackendModel::createURLForAction('edit') . '&amp;id=[id]',
			BL::lbl('Edit')
		);

		// our JS needs to know an id, so we can highlight it
		$this->dataGrid->setRowAttributes(array('id' => 'row-[id]'));
	}

	/**
	 * Parse the datagrid
	 */
	protected function parse()
	{
		$this->tpl->assign(
			'dataGrid',
			($this->dataGrid->getNumResults() != 0) ? $this->dataGrid->getContent() : false
		);
	}
}
