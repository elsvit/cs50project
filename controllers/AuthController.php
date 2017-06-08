<?php
class authToView
{
	public static function generateView($authInpError)
	{
		$HeaderLeft1href = '/main/main';
		$HeaderLeft1text = Lang::arr('Main');
		$HeaderLeft2href = '/regist/regist';
		$HeaderLeft2text = Lang::arr('Registration');
		$HeaderMidhref = '#';
		$HeaderMidtext = ' ';
		include_once(ROOT.'/views/authView.php');
	}
}

class AuthController
{
	public $model;
	public function __construct(){
         $this->model = new authModel();
    }
	public function authAction()
	{
		if(!empty($_SESSION['userid']))
    {
    	header('Location: /user/user');
    }
		if($this->model->is_authorize())
		{
       header('Location: /user/user');
    }
        $authInpError = array();
		if(isset($_REQUEST["auth"]))
		{
			if(isset($_REQUEST['rempas']))
			{
				$rempas=1;
			}else
			{
				$rempas=0;
			}
			$authInpError = AuthModel::inpAuthForm($_REQUEST['email'], $_REQUEST['pass'], $rempas);
			if (count($authInpError)==0)
			{
				header('Location: /user/user');

				?>
				<a href = "/user/user"><?=Lang::arr('Enter')?></a>
				<?php
			}else
			{
			}
		} 
			$impAuthInpError = implode(", ", $authInpError);
			Log::writeLog('authAction 68 '.$impAuthInpError);		
		authToView::generateView($authInpError);
		return true;
	}
}
?>