<?php
namespace iTunes\Search;

use iTunes\Search\Base as SearchBase;
use iTunes\Search\SearchInterface;
use iTunes\Utilities as Util;

class Id extends SearchBase implements SearchInterface
{
	public function __construct()
	{
		parent::__construct();
	}

	public function __invoke($wf, $query)
	{
		$responses = $this->lookup(array(
			'id' => $query,
		));

		if (count($responses) > 0)
		{
			foreach ($responses as $response)
			{
				$artwork = $this->artwork(
					$this->filter($response, 'artworkUrl100'),
					$this->filter($response, 'trackId')
				);

				switch ($this->filter($response, 'kind'))
				{
					case 'feature-movie':
						$wf->result(array(
							'uid' => sha1($this->filter($response, 'trackName')),
							'arg' => $this->filter($response, 'trackViewUrl'),
							'title' => $this->filter($response, 'trackName') . ' (' . date('Y', strtotime($this->filter($response, 'releaseDate'))) . ')',
							'subtitle' => 'View description, ratings and other details.',
							'icon' => $artwork,
						));
						$wf->result(array(
							'uid' => sha1($this->filter($response, 'trackName')) . 'runtime',
							'title' => Util::timeHMS($this->filter($response, 'trackTimeMillis') / 1000),
							'subtitle' => 'Runtime',
							'icon' => ITMS_ROOT . '/icon.png',
							'valid' => 'no',
							'autocomplete' => 'id ' . $this->filter($response, 'trackId'),
						));
						$wf->result(array(
							'uid' => sha1($this->filter($response, 'trackName')) . 'genre',
							'title' => $this->filter($response, 'primaryGenreName'),
							'subtitle' => 'Genre',
							'icon' => ITMS_ROOT . '/icon.png',
							'valid' => 'no',
							'autocomplete' => 'id ' . $this->filter($response, 'trackId'),
						));
						$wf->result(array(
							'uid' => sha1($this->filter($response, 'trackName')) . 'date',
							'title' => gmdate('j F Y', strtotime($this->filter($response, 'releaseDate'))),
							'subtitle' => 'Release Date',
							'icon' => ITMS_ROOT . '/icon.png',
							'valid' => 'no',
							'autocomplete' => 'id ' . $this->filter($response, 'trackId'),
						));
						$wf->result(array(
							'uid' => sha1($this->filter($response, 'trackName')) . 'director',
							'title' => $this->filter($response, 'artistName'),
							'subtitle' => 'Director',
							'icon' => ITMS_ROOT . '/icon.png',
							'valid' => 'no',
							'autocomplete' => 'id ' . $this->filter($response, 'trackId'),
						));
						$wf->result(array(
							'uid' => sha1($this->filter($response, 'trackName')) . 'id',
							'arg' => $this->filter($response, 'trackId'),
							'title' => $this->filter($response, 'trackId'),
							'subtitle' => 'Copy the iTunes Content ID to your clipboard.',
							'icon' => ITMS_ROOT . '/icon.png',
							'valid' => 'yes',
						));
						break;
				}
			}

			// $responses = $this->flush();
		}
	}
}
