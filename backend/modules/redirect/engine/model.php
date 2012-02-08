<?php

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

/**
 * In this file we store all generic functions that we will be using in the blog module
 *
 * @author Davy Hellemans <davy.hellemans@netlash.com>
 */
class BackendRewritesModel
{
	const QRY_DATAGRID_BROWSE =
		'SELECT i.id, i.source, i.destination, i.is_regexp, UNIX_TIMESTAMP(i.created_on) AS created_on
		 FROM rewrites AS i';

	/**
	 * Deletes the item with the given id.
	 *
	 * @param int $id
	 */
	public static function delete($id)
	{
		BackendModel::getDB()->delete('rewrites', 'id = ?', (int) $id);
	}

	/**
	 * Checks if an item exists
	 *
	 * @param int $id
	 * @return bool
	 */
	public static function exists($id)
	{
		return (bool) BackendModel::getDB()->getVar(
			'SELECT i.id FROM rewrites AS i WHERE i.id = ?', (int) $id
		);
	}

	/**
	 * Fetch all data for the given id.
	 *
	 * @param int $id
	 * @return array
	 */
	public static function get($id)
	{
		return (array) BackendModel::getDB()->getRecord(
			'SELECT i.*, UNIX_TIMESTAMP(i.created_on) AS created_on, UNIX_TIMESTAMP(i.edited_on) AS edited_on
			 FROM rewrites AS i
			 WHERE i.id = ?',
			(int) $id
		);
	}

	/**
	 * @param array $item
	 * @return int
	 */
	public static function insert(array $item)
	{
		return BackendModel::getDB()->insert('rewrites', $item);
	}

	/**
	 * @param int $id
	 * @param array $item
	 * @return int
	 */
	public static function update($id, array $item)
	{
		return BackendModel::getDB()->update('rewrites', $item, 'id = ?', (int) $id);
	}
}
