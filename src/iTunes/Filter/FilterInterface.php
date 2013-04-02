<?php
namespace iTunes\Filter;

interface FilterInterface
{
	public function __invoke($wf, $query, $kind = null);
}
