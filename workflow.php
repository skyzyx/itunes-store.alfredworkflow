<?php
require_once __DIR__ . '/vendor/autoload.php';

define('ITMS_ROOT', __DIR__);

use Alfred\Storage\Plist;
use Alfred\Workflow;
use Guzzle\Http\Client;
use iTunes\Cacher;
use iTunes\Logger;

Logger::set();
Cacher::set();

$bundle_id = 'com.ryanparman.workflow.itunes';
$query = isset($argv[1]) ? $argv[1] : null;
$wf = new Workflow($bundle_id);
$plist = new Plist($bundle_id);

Logger::get()->info('Start workflow:', array(
	'bundle_id' => $bundle_id,
	'query'     => $query,
));

// Nothing entered yet...
if (!$query)
{
	Logger::get()->info('No query value.');

	$kind = new iTunes\Filter\Kind();
	$kind($wf, $query);
}
else
{
	$query = explode(' ', $query);
	$kind = array_shift($query);
	$kind = str_replace('\\', '', trim($kind));
	$query = str_replace('\\', '', trim(implode(' ', $query)));

	Logger::get()->info('Query value:', array(
		'kind'  => $kind,
		'query' => $query,
	));

	// if ($query !== '')
	// {
		$sort = new iTunes\Filter\Sort();
		$sort($wf, $query, $kind);
	// }
}

if ($query !== '' && count($wf->results) === 0)
{
	Logger::get()->info('There is a query, but there are no results.');

	$wf->result(array(
		'uid' => 'none',
		'arg' => $query,
		'title' => 'No results',
		'subtitle' => 'No results found.',
		'icon' => __DIR__ . '/icon.png',
		'valid' => 'no',
	));
}

echo $wf->toXML();
