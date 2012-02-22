<?php

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

namespace Common;

use Monolog\Logger as MonologLogger;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Processor\WebProcessor;
use Monolog\Processor\IntrospectionProcessor;

/**
 * This is the Fork CMS logger. It is a wrapper to Monolog.
 *
 * @author Dieter Vanden Eynde <dieter@netlash.com>
 */
class Logger extends MonologLogger
{
	/**
	 * @param string $channel
	 * @param string $logFile
	 */
	public function __construct($channel, $logFile)
	{
		parent::__construct($channel);

		$logFile = (string) $logFile;

		// in debug mode log all
		$logLevel = (SPOON_DEBUG) ? MonologLogger::DEBUG : MonologLogger::INFO;

		// log to rotating files
		$this->pushHandler(new RotatingFileHandler($logFile, 0, $logLevel));

		// log additional debug information
		$this->pushProcessor(new WebProcessor());
		$this->pushProcessor(new IntrospectionProcessor());
	}
}
