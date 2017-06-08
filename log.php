<?php
class Log
{
	public static function writeLog($val)
	{
		$logfile = ROOT.'/log.txt';
		if(file_exists($logfile))
		{
			file_put_contents($logfile, $val, FILE_APPEND);
			$curTime = ' --'.date("H:i:s")."--. \r\n";
			file_put_contents($logfile, $curTime, FILE_APPEND);
		}
	}
	
	public static function checkTime()
	{
	    list($usec, $sec) = explode(" ", microtime());
	    return ((float)$usec + (float)$sec);
	} 
}
