<?php
namespace iTunes;

class Utilities
{
	/**
	 * Converts the number of seconds into HH:MM:SS format.
	 *
	 * @param  integer $seconds The number of seconds to format.
	 * @return string           The formatted time.
	 */
	public static function timeHMS($seconds = 0)
	{
		$time = '';

		// First pass
		$hours = (integer) ($seconds / 3600);
		$seconds = $seconds % 3600;
		$minutes = (integer) ($seconds / 60);
		$seconds = $seconds % 60;

		// Cleanup
		$time .= ($hours) ? $hours . ':' : '';
		$time .= ($minutes < 10 && $hours > 0) ? '0' . $minutes : $minutes;
		$time .= ':';
		$time .= ($seconds < 10) ? '0' . $seconds : $seconds;

		return $time;
	}

	/**
	 * Return human readable file sizes.
	 *
	 * @author Aidan Lister <aidan@php.net>
	 * @author Ryan Parman <ryan@getcloudfusion.com>
	 * @license http://www.php.net/license/3_01.txt PHP License
	 * @link http://aidanlister.com/repos/v/function.size_readable.php Original Function
	 *
	 * @param  integer $size    File size in bytes.
	 * @param  string  $unit    The maximum unit to use. Defaults to the largest appropriate unit.
	 * @param  string  $default The format for the return string. Defaults to `%01.2f %s`.
	 * @return string           The human-readable file size.
	 */
	public static function formatSize($size, $unit = null, $default = null)
	{
		// Units
		$sizes = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB');
		$mod = 1024;
		$ii = count($sizes) - 1;

		// Max unit
		$unit = array_search((string) $unit, $sizes);
		if ($unit === null || $unit === false)
		{
			$unit = $ii;
		}

		// Return string
		if ($default === null)
		{
			$default = '%01.2f %s';
		}

		// Loop
		$i = 0;
		while ($unit != $i && $size >= 1024 && $i < $ii)
		{
			$size /= $mod;
			$i++;
		}

		return sprintf($default, $size, $sizes[$i]);
	}
}
