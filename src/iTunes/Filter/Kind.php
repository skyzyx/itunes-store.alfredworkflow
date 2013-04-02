<?php
namespace iTunes\Filter;

use iTunes\Filter\FilterInterface;

class Kind implements FilterInterface
{
	public function __invoke($wf, $query, $kind = null)
	{
		$wf->result(array(
			'uid' => 'music',
			'arg' => 'music',
			'title' => 'Music',
			'subtitle' => 'Search the iTunes Store for music.',
			'icon' => ITMS_ROOT . '/icon.png',
			'valid' => 'no',
			'autocomplete' => 'music '
		));

		$wf->result(array(
			'uid' => 'movie',
			'arg' => 'movie',
			'title' => 'Movies',
			'subtitle' => 'Search the iTunes Store for a movie.',
			'icon' => ITMS_ROOT . '/icon.png',
			'valid' => 'no',
			'autocomplete' => 'movie '
		));

		$wf->result(array(
			'uid' => 'tvShow',
			'arg' => 'tvShow',
			'title' => 'TV Shows',
			'subtitle' => 'Search the iTunes Store for TV shows.',
			'icon' => ITMS_ROOT . '/icon.png',
			'valid' => 'no',
			'autocomplete' => 'tv '
		));

		$wf->result(array(
			'uid' => 'software',
			'arg' => 'software',
			'title' => 'iOS Software',
			'subtitle' => 'Search the iTunes Store for iOS software.',
			'icon' => ITMS_ROOT . '/icon.png',
			'valid' => 'no',
			'autocomplete' => 'ios '
		));

		$wf->result(array(
			'uid' => 'ebook',
			'arg' => 'ebook',
			'title' => 'Books',
			'subtitle' => 'Search the iBookstore for books.',
			'icon' => ITMS_ROOT . '/icon.png',
			'valid' => 'no',
			'autocomplete' => 'book '
		));

		$wf->result(array(
			'uid' => 'musicVideo',
			'arg' => 'musicVideo',
			'title' => 'Music Videos',
			'subtitle' => 'Search the iTunes Store for music videos.',
			'icon' => ITMS_ROOT . '/icon.png',
			'valid' => 'no',
			'autocomplete' => 'video '
		));

		$wf->result(array(
			'uid' => 'audiobook',
			'arg' => 'audiobook',
			'title' => 'Audiobooks',
			'subtitle' => 'Search the iTunes Store for audiobooks.',
			'icon' => ITMS_ROOT . '/icon.png',
			'valid' => 'no',
			'autocomplete' => 'audiobook '
		));

		$wf->result(array(
			'uid' => 'shortFilm',
			'arg' => 'shortFilm',
			'title' => 'Short Films',
			'subtitle' => 'Search the iTunes Store for short films.',
			'icon' => ITMS_ROOT . '/icon.png',
			'valid' => 'no',
			'autocomplete' => 'short '
		));

		$wf->result(array(
			'uid' => 'podcast',
			'arg' => 'podcast',
			'title' => 'Podcasts',
			'subtitle' => 'Search the iTunes Store for podcasts.',
			'icon' => ITMS_ROOT . '/icon.png',
			'valid' => 'no',
			'autocomplete' => 'podcast '
		));

		$wf->result(array(
			'uid' => 'all',
			'arg' => 'all',
			'title' => 'Everything',
			'subtitle' => 'Search every kind of content in the iTunes Store.',
			'icon' => ITMS_ROOT . '/icon.png',
			'valid' => 'no',
			'autocomplete' => 'all '
		));
	}
}
