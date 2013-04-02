<?php
namespace iTunes\Search;

use Guzzle\Cache\DoctrineCacheAdapter;
use Guzzle\Http\Client;
use Guzzle\Log\MessageFormatter;
use Guzzle\Log\MonologLogAdapter;
use Guzzle\Plugin\Cache\CachePlugin;
use Guzzle\Plugin\Log\LogPlugin;
use iTunes\Cacher;
use iTunes\Logger;

class Base
{
	private $http;

	public function __construct()
	{
		$this->http = new Client();
		$this->http->addSubscriber(new CachePlugin(new DoctrineCacheAdapter(Cacher::get())));
		$this->http->addSubscriber(new LogPlugin(new MonologLogAdapter(Logger::get()), MessageFormatter::DEBUG_FORMAT));

		Logger::get()->info('Instantiated a SearchInterface:', array(
			'SearchInterface' => get_called_class()
		));
	}

	public function request($params)
	{
		$request = $this->http->get('https://itunes.apple.com/search?' . http_build_query($params, null, '&'));
		$response = $request->send()->json();
		return $response['results'];
	}

	public function filter($array, $key)
	{
		if (isset($array[$key]))
		{
			return $array[$key];
		}

		return null;
	}
}
