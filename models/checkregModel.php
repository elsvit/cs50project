<?php
class CheckRegModel
{
	public function changeUserRights($checkMail, $passCheckMail)
	{
		$db = Db::getConnection();
		$sqlSel = $db->prepare('SELECT password FROM users WHERE email = :email');
		$sqlSel->execute(array('email' => $checkMail));
		while($row = $sqlSel->fetch())
		{
			$passCheck = substr($row['password'], 2, 22);
		}
		if ($passCheckMail==$passCheck)
		{
			$sqlUpd = $db->prepare('UPDATE users SET id_rights=2 WHERE email = :email'); //2-registered user
		    $sqlUpd->execute(array(':email' => $checkMail));
			return true;
		}
	return false;
	}
}