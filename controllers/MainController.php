<?php
//include_once ROOT.'/models/mainModel.php';

class MainController
{

	public $model;
	public function __construct(){
         $this->model = new mainModel();
    }


	public function mainAction()
	{
		$HeaderLeft1href = '/auth/auth';
		$HeaderLeft1text = Lang::arr('Enter');
		$HeaderLeft2href = '/regist/regist';
		$HeaderLeft2text = Lang::arr('Registration');
		$HeaderMidhref = 'http://www.logicgame.net';
		$HeaderMidtext = 'Logic Games';

		require_once(ROOT.'/views/mainView.php');
		return true;
	}

	public function outAction()
	{
		$lang = $_SESSION['lang'];
		$this->model->outUser();
		
		$HeaderLeft1href = '/auth/auth';
		$HeaderLeft1text = Lang::arr('Enter');;
		$HeaderLeft2href = '/regist/regist';
		$HeaderLeft2text = Lang::arr('Registration');
		$HeaderMidhref = 'http://www.logicgame.net';
		$HeaderMidtext = 'Logic Games';
		require_once(ROOT.'/views/mainView.php');
		return true;
	}

	public function contactsAction()
	{
		$HeaderLeft1href = '/main/main';
		$HeaderLeft1text = Lang::arr('Main');
		$HeaderLeft2href = '/regist/regist';
		$HeaderLeft2text = Lang::arr('Registration');
		$HeaderMidhref = 'http://www.logicgame.net';
		$HeaderMidtext = 'Logic Games';
		require_once(ROOT.'/views/contactsView.php');
	}

	public function projectAction()
	{
		$HeaderLeft1href = '/main/main';
		$HeaderLeft1text = Lang::arr('Main');
		$HeaderLeft2href = '/regist/regist';
		$HeaderLeft2text = Lang::arr('Registration');
		$HeaderMidhref = 'http://www.logicgame.net';
		$HeaderMidtext = 'Logic Games';
		require_once(ROOT.'/views/projectView.php');
	}
}