<?php
class mainModel
{
	public function outUser()
	{
		$_SESSION['userid'] = null;
		setcookie('userpsw', '', time()-3600*24, '/');
		setcookie('userid', '', time()-3600*24, '/');
	}
}
