<?php

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

/**
 * In this file we store all generic functions that we will be using in the redirect module
 *
 * @author Davy Hellemans <davy.hellemans@netlash.com>
 */
class FrontendRedirectModel
{
	/**
	 * Fetch all redirects.
	 */
	public static function getAll()
	{
		return (array) FrontendModel::getDB()->getPairs(
			'SELECT source, destination FROM redirects'
		);
	}

	/**
	 * Searches the URL and checks if there's a redirect setup for it.
	 *
	 * @param string $URL
	 * @return bool
	 */
	public static function redirect($URL)
	{
		$URL = '/' . FRONTEND_LANGUAGE . '/' . strtolower($URL);
		$redirects = FrontendRedirectModel::getAll();

		// go to redirect url
		if(array_key_exists($URL, $redirects))
		{
			SpoonHTTP::redirect($redirects[$URL], 301);
		}

		return false;
	}
}
