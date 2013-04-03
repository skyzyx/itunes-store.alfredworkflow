<?php
namespace iTunes;

use Doctrine\Common\Cache\FilesystemCache;
use Symfony\Component\Filesystem\Filesystem;

class Cacher
{
	private static $cacher;
	private static $cache_path;

	public static function set()
	{
		$fs = new Filesystem();
		$tmp = self::cachePath() . '/cache';
		$fs->mkdir($tmp);

		$cache = new FilesystemCache($tmp);
		self::$cacher = $cache;

		Logger::get()->info('Doctrine Cache:', array(
			'path' => $tmp,
		));
	}

	public static function get()
	{
		return self::$cacher;
	}

	public static function cachePath()
	{
		return sys_get_temp_dir() . '/alfred-itunes-workflow';
	}
}
