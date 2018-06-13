<?php

function makeSlug($name)
{
	return strtolower(str_replace(' ', '_', $name));
}

