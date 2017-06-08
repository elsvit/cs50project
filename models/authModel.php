<?php
class AuthModel
{
	public static function inpAuthForm($email, $pass, $rempas = 0)
	{
	  	if($pass)
	  	{
		  	$password = md5(md5(trim($pass)));

			$arErrors = array();
			if($errArr = InpFilter::email($email))
			{
				$arErrors[] = $errArr;
			}else{
				$db = Db::getConnection();
				$result = $db->prepare('SELECT id, password, id_rights FROM users WHERE email = :email');
				$result->execute(array('email' => $email));
				while($row = $result->fetch())
				{
					$user['id'] = $row['id'];
					$user['password'] = $row['password'];
					$user['id_rights'] = $row['id_rights'];
				}
				if ($user['id_rights'] == 2)
				{
					if(isset($user['password']) && $password == $user['password'])
					{
						$_SESSION['userid'] = $user['id'];
						if($rempas==1){
			            	setcookie('userpsw', $user['password'], time()+3600*24, '/');
			            	setcookie('userid', $user['id'], time()+3600*24, '/');
			            }
			            else
			        	{
							setcookie('userpsw', '', time()-3600*24, '/');
							setcookie('userid', '', time()-3600*24, '/');
			        	}
			        	
						header("Location: /user/user/");
						//TO USER PAGE!!!!!!!!!!!!!!!!!!
					}else
					{
						$arErrors[]="Error e-mail or password";
					}
				}else{
					$arErrors[]="Authorize please";
				}
			}
			
		}else{
			$arErrors[]="Enter password";
		}
		$impAuthInpError = implode(", ", $arErrors);
		$impAuthInpError='inpAuthForm 47 '.$impAuthInpError;
		Log::writeLog($impAuthInpError);
		return $arErrors; 
	}	

	public static function GoGo()
	{

        header('HTTP/1.1');
        header("Status: 200");
        header('Location: /user/user/');
		exit();
	}

	public function is_authorize(){
        if(!empty($_COOKIE['userpsw'])&&!empty($_COOKIE['userid']))
        {
	        $password=$_COOKIE['userpsw'];
	        $userid=$_COOKIE['userid'];
	        $db = Db::getConnection();
			$result = $db->prepare('SELECT id,  id_rights FROM users WHERE password = :password AND id = :userid');
			$result->execute(array('password' => $password, 'userid' => $userid));
			while($row = $result->fetch())
			{
					if ($row['id_rights'] == 2)
					{
						$_SESSION['userid'] = $row['id'];
					}
			}
        }
        return empty($_SESSION['userid']) ? false : true;
    }
		
}	