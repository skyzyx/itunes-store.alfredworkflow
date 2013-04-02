<?php
namespace iTunes\Search;

use iTunes\Search\Base as SearchBase;
use iTunes\Search\SearchInterface;

class Movie extends SearchBase implements SearchInterface
{
	public function __construct()
	{
		parent::__construct();
	}

	public function __invoke($wf, $query)
	{
		$responses = $this->request(array(
			'media' => 'movie',
			'term' => $query,
		));

		if (count($responses) > 0)
		{
			foreach ($responses as $response)
			{
				$wf->result(array(
					'uid' => sha1($this->filter($response, 'trackName')),
					'arg' => $this->filter($response, 'trackId'),
					'title' => $this->filter($response, 'trackName'),
					'subtitle' => ('[' . $this->filter($response, 'primaryGenreName') . ', ' .
						$this->filter($response, 'contentAdvisoryRating') . '] ' .
						$this->filter($response, 'longDescription')),
					'icon' => $response['artworkUrl100'],
					'valid' => 'no',
					'autocomplete' => $this->filter($response, 'trackId'),
				));
			}
		}
	}
}