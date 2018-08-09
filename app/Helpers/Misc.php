<?php
/**
 * @param $name
 * @return string
 */
function makeSlug($name)
{
	return strtolower(str_replace(' ', '_', $name));
}

