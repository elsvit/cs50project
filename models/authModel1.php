<?php
class AuthModel
{
	public static function inpAuthForm($email, $pass, $rempas)
	{
	  	$password = md5(md5(trim($pass)));
	  	if($rempas==1)
	  	{
	    	//setcookie("user", "$email", time()+3600*24*3);
	 	}
		$arErrors = array();
		if(!preg_match("|^([a-zA-Z0-9_\.-]+)@([a-zA-Z0-9_\.-]+)$|", $email))
		{
			$arErrors[] = "e-mail может содержать только латинские символы, цифры, '_', '.', '-' и не быть пустым.";
		}
		$db = Db::getConnection();
		$result = $db->prepare('SELECT id, password FROM users WHERE email = :email');
		$result->execute(array('email' => $email));
		while($row = $result->fetch())
		{
			$user['id'] = $row['id'];
			$user['password'] = $row['password'];
		}
		
		if($password == $user['password'])
		{

			$_SESSION['userid'] = $user['id'];

			//TO USER PAGE!!!!!!!!!!!!!!!!!!
		}else
		{
			$arErrors[]="Неверный e-mail или пароль";
		}
		return $arErrors; 
	}	
		
}	