<?php
//RETURN FALS!!!!! IF ALL OK (not errors)
class InpFilter 
{
	public static function lat($val)
	{
		if(preg_match("/^([a-z])+$/i", $val))
		{
			return false;
		}
		return 'Error input! '.$val.' Allowed: a-z, A-Z.';
	}

	public static function latNum($val)
	{
		if(preg_match("/^([a-z0-9])+$/i", $val))
		{
			return false;
		}
		return 'Error input! '.$val.' Allowed: a-z, A-Z.';
	}
	public static function filename($val)
	{
		if(preg_match("/[a-z][\w-]+/i", $val))
		{
			return false;
		}
		return 'Error input! '.$val.' Allowed: a-z, A-Z, - _.';
	}

	public static function latCyr($val)
	{
		if(preg_match("/^([a-zйцукенгшщзхъфывапролджэячсмитьбюЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮёЁіІїЇєЄ`])+$/i", $val))
		{
			return false;
		}
		return 'Error input! '.$val.' Allowed: a-z, A-Z, а-я, А-Я, `.';
	}

	//like nameLatCyr + '-'
	public static function latCyr2($val)
	{
		if(preg_match("/^([a-zйцукенгшщзхъфывапролджэячсмитьбюЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮёЁіІїЇєЄ`\-])+$/i", $val))
		{
			return false;
		}
		return 'Error input! '.$val.' Allowed: a-z, A-Z, а-я, А-Я, `, -.';
	}

	public static function latCyrNum($val)
	{
		if(preg_match("/^([a-z0-9йцукенгшщзхъфывапролджэячсмитьбюЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮёЁіІїЇєЄ`\-])+$/i", $val))
		{
			return false;
		}
		return 'Error input! '.$val.' Allowed: 0-9, a-z, A-Z, а-я, А-Я, `, -.';
	}

	public static function latCyrWords($val)
	{
		if(preg_match("/^([a-zйцукенгшщзхъфывапролджэячсмитьбюЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮёЁіІїЇєЄ` \-])+$/i", $val))
		{
			return false;
		}
		return 'Error input! '.$val.' Allowed: a-z, A-Z, а-я, А-Я, `, -, .';
	}

	public static function latCyrNumWords($val)
	{
		if(preg_match("/^([a-z0-9йцукенгшщзхъфывапролджэячсмитьбюЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮёЁіІїЇєЄ` \-])+$/i", $val))
		{
			return false;
		}
		return 'Error input! '.$val.' Allowed: 0-9, a-z, A-Z, а-я, А-Я, `, -, .';
	}

	public static function email($val)
	{
		if(preg_match("/^(([\w\-+'`\.])+@(([\w\-]+)\.)+[a-zA-Z][a-zA-Z]+)$/", $val))
		{
			return false;
		}
		return 'Error input! '.$val.' Allowed: a-z, A-Z, 0-9, +, -, ., _, \', `, 1-@.';
	}
}

?>