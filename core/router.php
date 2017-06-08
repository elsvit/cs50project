<?php
session_start();

/*  for test view in log.txt*/
/*  Log::writeLog(val)  */

class Router
{
	const CONTR = 'main'; //default controller
	const ACTION = 'main';
	private function getURI()
	{
		if (!empty($_SERVER['REQUEST_URI']))
		{
			return strtolower(trim($_SERVER['REQUEST_URI'],'/'));
		}
	}

	public function run()
	{
		require_once(ROOT.'/global/lang.php');
		require_once(ROOT.'/global/inpFilter.php');
		require_once(ROOT.'/log.php');
		$langList = Lang::langList();
		if(!empty($_COOKIE['lang'])&&(array_search($_COOKIE['lang'], $langList)))
		{
			$_SESSION['lang']=$_COOKIE['lang'];
		}else{
			$_SESSION['lang']=$langList[0];
			setcookie('lang', $langList[0], time()+3600*24*7, '/');
		} 
		$uri = $this->getURI(); //Get query string
		$uriArr = explode('/', $uri);
		@$uriArr[0] = (string)$uriArr[0] ? $uriArr[0] : self::CONTR;
		@$uriArr[1] = (string)$uriArr[1] ? $uriArr[1] : self::ACTION;
		$modelName = $uriArr[0].'Model';
		$controllerName = ucfirst($uriArr[0].'Controller');
		$actionName = $uriArr[1].'Action';
		$modelFile = ROOT.'/models/'.$modelName.'.php';
		$controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
 
		if (file_exists($controllerFile))
		{
		 	if (file_exists($modelFile))
			{
			 	include_once($modelFile);
			}
		 	include_once($controllerFile);
		//Create object, evoke method(action)
		 	$controllerObject = new $controllerName;
		 	if(method_exists($controllerObject, $actionName))
		 	{
            	$controllerObject->$actionName();
        	}else
        	{
	            header("Location: /main/main");
        	}
		}else
		{
			header("Location: /main/main");
		}
	}

}

