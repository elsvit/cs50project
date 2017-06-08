<?php
class RegistController
{
	public function registAction()
	{
		$arError = array();
		$arInfo = array();

		if(isset($_REQUEST["register"]))
		{
		  	$name = trim($_REQUEST['name']);
		    $lastname = trim($_REQUEST['lastname']);
		    $email = trim($_REQUEST['email']);
		    $pass = $_REQUEST['pass'];
		    $pass_confirm = $_REQUEST['pass_confirm'];

			$arError = RegistModel::inpRegForm($name, $lastname, $email, $pass, $pass_confirm);
			if (count($arError)==0)
			{
				$arInfo = RegistModel::registSQLnMail($email, $pass, $name, $lastname);
			}
		}

		$HeaderLeft1href = '/auth/auth';
		$HeaderLeft1text = Lang::arr('Enter');
		$HeaderLeft2href = '/main/main';
		$HeaderLeft2text = Lang::arr('Main');
		$HeaderMidhref = '#';
		$HeaderMidtext = ' ';
		$regInpError = array();
		
		include_once(ROOT.'/views/registView.php');
		return true;
	}

}