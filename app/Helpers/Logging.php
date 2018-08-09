<?php
/**
 * @param $message
 * @param string $status
 * @param string $level
 */
function LogIt($message, $status = '', $level = 'debug')
{
	$pid = getmypid();

	if($status == 'start')
	{	

		Log::$level("\n");
		Log::$level("*************** START $pid ***************\n");
	}

	

	Log::$level($pid  . " ".$message);

	if($status == 'end')
	{	

		Log::$level("\n");
		Log::$level("*************** END $pid ***************\n");
	}
}