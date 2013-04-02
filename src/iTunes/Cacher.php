<?php
namespace iTunes;

use Doctrine\Common\Cache\FilesystemCache;
use Symfony\Component\Filesystem\Filesystem;

class Cacher
{
	private static $cacher;

	public static function set()
	{
		$tmp = sys_get_temp_dir();
		$cache = new FilesystemCache($tmp);
		self::$cacher = $cache;
	}

	public static function get()
	{
		return self::$cacher;
	}
}
