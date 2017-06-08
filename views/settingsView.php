<?php
class settingsView
{
	public static function headView()
	{
		require_once(ROOT.'/views/head.php');
	}

	public static function headerView()
	{
		$HeaderLeft1href = '/main/main';
		$HeaderLeft1text = Lang::arr('Main');
		$HeaderLeft2href = '/user/user';
		$HeaderLeft2text = Lang::arr('My_photos');
		$HeaderMidhref = '#';
		$HeaderMidtext = ' ';
		require_once(ROOT.'/views/header.php');
	}

	public static function middleView($user, $userGroups, $members, $allUsers, $arError, $arInfo)
	{
		require_once(ROOT.'/views/settingsMiddleView.php');
	}

	public static function footerView()
	{
		require_once(ROOT.'/views/footer.php');
		require_once(ROOT.'/views/script.php');
	}
}
