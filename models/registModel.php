<?php
class RegistModel
{
	public static function inpRegForm($name, $lastname, $email, $pass, $pass_confirm)
	{
		$arError = array();
		if($errArr = InpFilter::latCyr($name))
		{
			$arError[] = $errArr;
		}
		if ($lastname) 
		{
			if($errArr = InpFilter::latCyr2($lastname))
			{
				$arError[] = $errArr;
			}
		}
		if($errArr = InpFilter::email($email))
		{
			$arError[] = $errArr;
		}
		if(($pass !== $pass_confirm) | $pass=='')
		{
			$arError[] = Lang::arr('ERROR');
		}
		$db = Db::getConnection();
		$result = $db->prepare('SELECT id FROM users WHERE email = :email');
		$result->execute(array('email' => $email));
		while($row = $result->fetch())
		{
			$arError[] = Lang::arr('email_exists');
			break;
		}
		if (count($arError)==0)
		{
			$password = md5(md5(trim($pass)));
			$lang = $_SESSION['lang'];
			$id_rights=3;//3=unregistered user
			$db = Db::getConnection();
		    $result = $db->prepare('INSERT INTO users (name, lastname, email, password, id_rights, lang)  VALUES (:name, :lastname, :email, :password, :id_rights, :lang)');
		    if($result->execute(array(':name'=>$name, ':lastname'=>$lastname, 
		    	':email'=>$email, ':password'=>$password, ':id_rights'=>$id_rights, ':lang'=>$lang)))
		    {
		    }else
		    {
		    	$arError[] = Lang::arr('ERROR_DB');
		    }
		}
		
		return $arError; 
		
	}

	public static function registSQLnMail($email, $pass, $name, $lastname)
	{
		$arReport = array();
   		$password = md5(md5(trim($pass)));
		$passCheckMail = substr($password, 2, 22);
		$check_reg="<p>Dear ".$name." ".$lastname."</p>";
		$check_reg.="<p>For confirm registration please click on the link </p>"; 
		$check_reg.='<a href = ';
		$check_reg.='"http//'.$_SERVER['HTTP_HOST'];
		$check_reg.='/checkReg/checkReg/?passCheckMail=';
		$check_reg.=$passCheckMail;
		$check_reg.="&checkMail=";
		$check_reg.=$email;
		$check_reg.='"'.'>Confirm registration</a>.';
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= 'From: Activate Account <photo.base@gmail.com>\r\n';
        $headers .= "Cc: photo.base@gmail.com\r\n";
        $headers .= "Bcc: photo.base@gmail.com\r\n";
		mail ($email, "Фотоархив - регистрация", $check_reg, $headers);
		//$arReport[] = "check_reg=".'"'.$check_reg.'"';
		$arReport[] = "Вам на почту был отправлен запрос подтверждения регистрации<br> ";
		// echo "<a href= mysite/check_reg.php?passCheckMail=\r\n";
		// echo $passCheckMail."&checkMail=".$email.">Подтверждение регистрации</a>.";
		    	
	return $arReport; 
	}
		
}	




