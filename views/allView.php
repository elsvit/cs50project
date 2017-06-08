<?php
class allView
{
	public static function headView()
	{
		require_once(ROOT.'/views/head.php');
	}

	public static function headerView($user)
	{
		$HeaderLeft1href = '/main/out';
		$HeaderLeft1text = Lang::arr('Exit');
		$HeaderLeft2href = '/user/settings';
		$HeaderLeft2text = $user['name']." ".$user['lastname'];
		$HeaderMidhref = '/user/user';
		$HeaderMidtext = Lang::arr('My_photos');;
		require_once(ROOT.'/views/header.php');
	}

	public static function photoView($idImgOwner, $nameImgOwner, $idImg ,$imgPathIn, $imgTime, $userGroups, $userid)
	{
		$sFile=ROOT.'/imgs/_'.$imgPathIn;
		if(file_exists($sFile)){
			$imgPath="_".$imgPathIn;
		}else{
			$imgPath=$imgPathIn;
		}
		include(ROOT.'/views/photoView.php');
	}

	public static function commentView($userNameComm, $datetimeComm, $commentTxt)
	{
		include(ROOT.'/views/commentView.php');
	}
	public static function commentBotView($idImg, $userid)
	{
		include(ROOT.'/views/commentBotView.php');
	}
	public static function spaceFooterView()
	{
		include(ROOT.'/views/spaceFooterView.php');
	}
	public static function footerView()
	{
	require_once(ROOT.'/views/footer.php');
	require_once(ROOT.'/views/script.php');
	}
}
