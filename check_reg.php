<?php
//check_reg.php must be in index.php dir
define('ROOT', dirname(__FILE__));
include_once('/core/db.php');
require_once('/config/global.php');
$db = Db::getConnection();
//http://mysite/check_reg.php?passCheckMail=7fd1517e323f26c6f1b0b6&checkMail=butenko.yv@gmail.com
    
//$_GLOBAL['base']="project4";
//$link = mysql_connect("localhost",'root');
//mysql_select_db($_GLOBAL['base'], $link);
$mailCheck = $_GET[checkMail];

//$passCheck = @substr(mysql_query("SELECT password FROM users WHERE users.id='".$idCheck."'"), 2, 22);
$sqlSel = $db->prepare('SELECT password FROM users WHERE email = :email');
$sqlSel->execute(array('email' => $mailCheck ));
while($row = $sqlSel->fetch())
{
	$passCheck = substr($row['password'], 2, 22);
}
if ($_GET[passCheckMail]==$passCheck)
{
//	mysql_query("UPDATE users SET id_rights=2 WHERE id=$idCheck"); //2-registered user
	$sqlUpd = $db->prepare('UPDATE users SET id_rights=2 WHERE email = :email'); //2-registered user
    $sqlUpd->execute(array(':email' => $mailCheck));
	echo 'Вы зарегистрированы';
}else
{
	echo 'Неверная ссылка! Попробуйте регистрацию еще раз.';
	sleep(2);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<a href="/auth/auth">ENTER</a>
</body>
</html>
