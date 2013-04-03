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
		$responses = $this->search(array(
			'media' => 'movie',
			'term' => $query,
		));

		if (count($responses) > 0)
		{
			foreach ($responses as $response)
			{
				$this->parse($wf, $response);
			}

			$responses = $this->flush();
		}
	}

	public function parse($wf, $response)
	{
		$artwork = $this->artwork(
			$this->filter($response, 'artworkUrl100'),
			$this->filter($response, 'trackId')
		);

		$wf->result(array(
			'uid' => sha1($this->filter($response, 'trackName')),
			'arg' => $this->filter($response, 'trackId'),
			'title' => $this->filter($response, 'trackName'),
			'subtitle' => ('[' . date('Y', strtotime($this->filter($response, 'releaseDate'))) . ', ' .
				$this->filter($response, 'primaryGenreName') . ', ' .
				$this->filter($response, 'contentAdvisoryRating') . '] ' .
				$this->filter($response, 'longDescription')),
			'icon' => $artwork,
			'valid' => 'no',
			'autocomplete' => 'id ' . $this->filter($response, 'trackId'),
		));
	}
}
