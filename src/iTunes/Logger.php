<?php
namespace iTunes;

use Monolog\Logger as Monolog;
use Monolog\Handler\StreamHandler;

class Logger
{
	private static $logger;

	public static function set()
	{
		$log = new Monolog('iTunes Store Workflow for Alfred');
		$log->pushHandler(new StreamHandler('/tmp/itunes-workflow-alfred.log', Monolog::DEBUG));
		self::$logger = $log;
	}

	public static function get()
	{
		return self::$logger;
	}
}
