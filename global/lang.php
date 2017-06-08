<?php
class Lang
{
	// languages
	public static function langList()
	{
		$langList = array(
			"ENG",
			"UKR",
			"RUS"
			);
		return $langList;
	}
	//get value on need language, val=meaning example="Main"
	public static function arr($val)
	{
		///////////////////////////////////////////
		$fileLang = ROOT.'/global/lang.csv'; 
		$arrLang = array();
		if (file_exists($fileLang)){
			$arrLangFile=file($fileLang);
			foreach ($arrLangFile as $line => $value) 
			{
				$arrTemp=explode(";", $value);
				foreach (self::langList() as $keyLang => $valLang)
				{
					$arrLang[$valLang][$arrTemp[0]]=trim($arrTemp[$keyLang+1]);
				}
			}
		}
		$lang = $_SESSION['lang'];
		return !empty($arrLang[$lang][$val]) ? $arrLang[$lang][$val] : $val;
	}
}	
