<?php
class CheckRegController 
{
	public function checkRegAction() 
	{
		$arError = array();
		$arInfo = array();
		if(isset($_GET['checkMail'])&&isset($_GET['passCheckMail']))
		{
			$checkMail = $_GET['checkMail'];
			$passCheckMail = $_GET['passCheckMail'];
			$changeStatus= new CheckRegModel;
			if($changeStatus->changeUserRights($checkMail, $passCheckMail))
			{
				$HeaderLeft1href = '/main/main';
				$HeaderLeft1text = Lang::arr('Main');
				$HeaderLeft2href = '/regist/regist';
				$HeaderLeft2text = Lang::arr('Registration');
				$authInpError = array();
				include_once(ROOT.'/views/authView.php');
				return true;
				echo Lang::arr('You_are_registered');
			}else
			{
				$HeaderLeft1href = '/auth/auth';
				$HeaderLeft1text = Lang::arr('Enter');
				$HeaderLeft2href = '/main/main';
				$HeaderLeft2text = Lang::arr('Main');
				$regInpError = array();
				$regInpError[] = 'Error link. Pleasw try later.';
				include_once(ROOT.'/views/registView.php');
			}


		return true;

		}else{
			return false;
		}
	}
}