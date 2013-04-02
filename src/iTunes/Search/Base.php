<?php
namespace iTunes\Search;

use Guzzle\Batch\BatchBuilder;
use Guzzle\Cache\DoctrineCacheAdapter;
use Guzzle\Http\Client;
use Guzzle\Log\MessageFormatter;
use Guzzle\Log\MonologLogAdapter;
use Guzzle\Plugin\Cache\CachePlugin;
use Guzzle\Plugin\Log\LogPlugin;
use iTunes\Cacher;
use iTunes\Logger;
use Symfony\Component\Filesystem\Filesystem;

class Base
{
	private $http;
	private $queue;
	private $tmp;

	public function __construct()
	{
		$fs = new Filesystem();

		$this->tmp = sys_get_temp_dir() . "/alfred-itunes-workflow";
		$fs->mkdir($this->tmp);

		$this->http = new Client();
		$this->http->addSubscriber(new CachePlugin(new DoctrineCacheAdapter(Cacher::get())));
		$this->http->addSubscriber(new LogPlugin(new MonologLogAdapter(Logger::get()), MessageFormatter::DEBUG_FORMAT));

		Logger::get()->info('Instantiated a SearchInterface:', array(
			'SearchInterface' => get_called_class()
		));
		Logger::get()->info('Writing to the temporary directory.', array(
			'tmp' => $this->tmp
		));
	}

	public function search($params)
	{
		$request = $this->http->get('https://itunes.apple.com/search?' . http_build_query($params, null, '&'));
		$response = $request->send()->json();
		return $response['results'];
	}

	public function lookup($params)
	{
		$request = $this->http->get('https://itunes.apple.com/lookup?' . http_build_query($params, null, '&'));
		$response = $request->send()->json();
		return $response['results'];
	}

	public function artwork($url, $id)
	{
		$path = $this->tmp . "/${id}.jpg";
		$fh = fopen($path, 'w+');
		$this->queue[] = $this->http->get($url, null, $fh);

		Logger::get()->info('Added artwork to the queue.', array(
			'url' => $url,
			'path' => $path,
		));

		return $path;
	}

	public function flush()
	{
		Logger::get()->info('Flushing the artwork queue.');

		return $this->http->send($this->queue);
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
