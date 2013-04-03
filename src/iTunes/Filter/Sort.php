<?php
namespace iTunes\Filter;

use iTunes\Filter\FilterInterface;
use iTunes\Logger;
use iTunes\Search\Id;
use iTunes\Search\Movie;

class Sort implements FilterInterface
{
	public function __invoke($wf, $query, $kind = null)
	{
		Logger::get()->info('"kind" data passed to the sorter.');

		switch ($kind)
		{
			case 'id':
				$id = new Id();
				$id($wf, $query);
				break;

			case 'music':
				break;

			case 'movie':
				$movie = new Movie();
				$movie($wf, $query);
				break;

			case 'tv':
				break;

			case 'ios':
				break;

			case 'book':
				break;

			case 'video':
				break;

			case 'audiobook':
				break;

			case 'short':
				break;

			case 'podcast':
				break;

			case 'all':
			default:
				break;
		}
	}
}
