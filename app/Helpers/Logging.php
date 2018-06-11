<?php

function LogIt($message, $status = '', $level = 'debug')
{
	$pid = getmypid();

	if($status == 'start')
	{	

		Log::$level("\n");
		Log::$level("*************** START $pid ***************\n");
	}

	if($status == 'end')
	{	

		Log::$level("\n");
		Log::$level("*************** END $pid ***************\n");
	}

	Log::$level($pid  . " ".$message);
}