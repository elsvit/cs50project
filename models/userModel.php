<?php
class UserModel
{
	public static function imgToDb($id_user, $path, $size)
	{
		$img_right = 1; //only I
		$db = Db::getConnection();
	    $sql = $db->prepare('INSERT INTO img (id_user, path, size, img_right)
	    	VALUES (:id_user, :path, :size, :img_right)');
	    if($sql->execute(array(':id_user'=>$id_user, ':path'=>$path, ':size'=>$size,  ':img_right'=>$img_right)))
	   	{
	    	return true;
	   	}else
	   	{
	   		return false;
	   	}
	}
	//get user name & lastname from user id
	public static function userFunc($id_user) //name & lastname from id
	{
		$db = Db::getConnection();
		$sql = $db->prepare('SELECT name, lastname FROM users WHERE id = :id');
		$sql -> execute(array('id' => $id_user));
		while($row = $sql->fetch())
		{
			$user['name'] = $row['name'];
			@$user['lastname'] = $row['lastname'];
		}
		return $user;
	}
	
	//get user name, lastname, email from user id
	public static function getUserNameLastnameEmail($id_user) //name & lastname from id
	{
		$db = Db::getConnection();
		$sql = $db->prepare('SELECT name, lastname, email FROM users WHERE id = :id');
		$sql -> execute(array('id' => $id_user));
		while($row = $sql->fetch())
		{
			$user['id'] = $id_user;
			$user['name'] = $row['name'];
			@$user['lastname'] = $row['lastname'];
			@$user['email'] = $row['email'];
		}
		return $user;
	}
	//get user settings from user id
	public static function getUserSettings($id_user) 
	{
		$db = Db::getConnection();
		$sql = $db->prepare('SELECT name, lastname, email, sex, birthday, country, place FROM users WHERE id = :id');
		$sql -> execute(array('id' => $id_user));
		while($row = $sql->fetch())
		{
			$user['id'] = $id_user;
			$user['name'] = $row['name'];
			@$user['lastname'] = $row['lastname'];
			@$user['email'] = $row['email'];
			@$user['sex'] = $row['sex'];
			@$user['birthday'] = $row['birthday'];
			@$user['country'] = $row['country'];
			@$user['place'] = $row['place'];
		}
		return $user;
	}

	//User Groups
	public static function userGroups($id_user)
	{
		$userGroups = array();
		$db = Db::getConnection();
		$sql = $db->prepare('SELECT id_group, name FROM groups WHERE id_user = :id_user');
		$sql -> execute(array('id_user' => $id_user));
		while($row = $sql->fetch())
		{
			@$userGroups[$row['id_group']] = $row['name'];
		}
		return $userGroups;
	}

	public static function addNewGroup($id_user, $new_group_name, $new_group_description)
	{
		$id_user=intval($id_user);
		$db = Db::getConnection();
		$sql = $db->prepare('SELECT name FROM groups WHERE id_user = :id_user');
		$sql -> execute(array(':id_user' => $id_user));
		while($row = $sql->fetch())
		{
			if($new_group_name == $row['name'])
			{
				return false;
			}
		}

		$db = Db::getConnection();
		$sql2 = $db->prepare('INSERT INTO groups (id_user, name, description) VALUES (:id_user, :name, :description)');
		return ($sql2 -> execute(array(':id_user'=>$id_user,	':name'=>$new_group_name, ':description'=>$new_group_description)));
	}

	public static function addNewMemberOfGroup($id_user, $groupName, $emailNewMemberOfGroup)
	{

		$id_user=intval($id_user);
		$db = Db::getConnection();
		$sql = $db->prepare('SELECT users.email AS email FROM users INNER JOIN usgroup ON users.id = usgroup.id_user INNER JOIN groups ON usgroup.id_group = groups.id_group WHERE groups.name = :groupName');
		$sql -> execute(array(':groupName' => $groupName));
		while($row = $sql->fetch())
		{
			if($emailNewMemberOfGroup == $row['email'])
			{
				
				return false;
			}
		}

		$db = Db::getConnection();
		$sql3 = $db->prepare('SELECT id_group FROM groups WHERE name = :groupName AND id_user=:id_user');
		$sql3 -> execute(array(':groupName' => $groupName, ':id_user' => $id_user));
		while($row = $sql3->fetch())
		{
			$id_group = $row['id_group'];
		}

		$db = Db::getConnection();
		$sql4 = $db->prepare('SELECT id  AS id_member FROM users WHERE email = :email');
		$sql4 -> execute(array(':email' => $emailNewMemberOfGroup));
		while($row = $sql4->fetch())
		{
			$id_member = $row['id_member'];
		}

/*		$db = Db::getConnection();
		$sqlTest = $db->prepare("INSERT INTO `000` (test) VALUES ('addNewMemberOfGroup_1')");
		$sqlTest -> execute();*/

		$db = Db::getConnection();		
		$sql2 = $db->prepare('INSERT INTO usgroup (id_user, id_group) VALUES (:id_user, :id_group)');
		return ($sql2 -> execute(array(':id_user'=>$id_member,	':id_group'=>$id_group)));
	}	


	//get users images array from users id
	public static function imgFunc($id_user) //id_img, path, datetime from id_user
	{	
		$img=array();
		$db = Db::getConnection();
		$sql = $db->prepare('SELECT img.id_user AS id_img_owner, users.name AS name_img_owner, img.id_img AS id_img, img.path AS path, img.datetime AS datetime FROM img INNER JOIN users ON users.id=img.id_user WHERE id_user = :id_user ORDER BY datetime DESC LIMIT 100');
		$sql -> execute(array(':id_user' => $id_user));
		$i=0;
		while($row = $sql->fetch())
		{
			$img[$i]['id_img_owner'] = $row['id_img_owner'];
			$img[$i]['name_img_owner'] = $row['name_img_owner'];
			$img[$i]['id_img'] = $row['id_img'];
			$img[$i]['path'] = $row['path'];
			$img[$i]['datetime'] = $row['datetime'];
			$i++;
		}
		return $img;
	}
	//get ALL images array from users id
	public static function allImgFunc($id_user)
	{
		$img=array();
		$db = Db::getConnection();
		$sql = $db->prepare('SELECT img.id_user AS id_img_owner, users.name AS name_img_owner, img.id_img AS id_img, img.path AS path, img.id_user AS id_img_owner, imgext.datetime AS datetime	FROM users INNER JOIN img ON users.id=img.id_user INNER JOIN imgext ON  img.id_img = imgext.id_img INNER JOIN usgroup ON imgext.id_group = usgroup.id_group  WHERE usgroup.id_user = :id_user ORDER BY imgext.datetime DESC LIMIT 100');
		$sql -> execute(array(':id_user' => $id_user));
		$i=0;
		while($row = $sql->fetch())
		{
			$img[$i]['name_img_owner'] = $row['name_img_owner'];
			$img[$i]['id_img_owner'] = $row['id_img'];
			$img[$i]['id_img'] = $row['id_img'];
			$img[$i]['path'] = $row['path'];
			$img[$i]['datetime'] = $row['datetime'];
			$i++;
		}
		return $img;
	}

	public static function renameImg($idImgNewImgName, $newImgName)
	{
		$db = Db::getConnection();
		$sql = $db->prepare('SELECT id_user, path FROM img WHERE id_img = :id_img');
		$sql -> execute(array(':id_img' => $idImgNewImgName));
		while($row = $sql->fetch())
		{
			$userid = $row['id_user'];
			$path = $row['path'];
		}
		$imgdir = ROOT.'/imgs/';
		if(file_exists($imgdir.$path))
		{
			$i=1;
			while($i++)
			{
				$newPath = "i".$userid."_".$newImgName.".".substr(strrchr($path, '.'), 1);			
				if(file_exists($imgdir.$newPath))
				{
					$newPath = "i".$userid."_".$newImgName."_".$i.".".substr(strrchr($path, '.'), 1);
					continue;
				}
				if(rename($imgdir.$path, $imgdir.$newPath))
				{
					$db1 = Db::getConnection();
					$sql1 = $db1->prepare('UPDATE img SET path=:path WHERE id_img = :id_img');
					if($sql1->execute(array(':path'=>$newPath, ':id_img'=>$idImgNewImgName)))
					{
						$okText="userModel_210: rename ".$path." to ".$newPath." Ok. SQL-OK";
			    		Log::writeLog($okText);
					}else{
			    		$errText="userModel_213: rename ".$path." to ".$newPath." Ok. But sql-ERROR";
			    		Log::writeLog($errText);
					}
				}
				if(rename($imgdir."_".$path, $imgdir."_".$newPath))
				{
				}else{

					$errText="userModel_222: rename ".$path." to ".$newPath." Ok. But Rename small file-ERROR";
			    	Log::writeLog($errText);
				}
				return true;
			}
		}
		return false;
	}

	public static function deleteImg($idImg)
	{
		$db = Db::getConnection();
		$sql = $db->prepare('SELECT id_user, path FROM img WHERE id_img = :id_img');
		$sql -> execute(array(':id_img' => $idImg));
		while($row = $sql->fetch())
		{
			$userid = $row['id_user'];
			$path = $row['path'];
		}
		$imgdir = ROOT.'/imgs/';
		$num =0;
		if(file_exists($imgdir.$path))
		{
			if(unlink($imgdir.$path))
			{
				$num++;				
			}
		}
		if(file_exists($imgdir."_".$path))
		{
			if(unlink($imgdir."_".$path))
			{
				$num++;
			}
		}
		if($num)
		{
			$db = Db::getConnection();
			$sql = $db->prepare('DELETE FROM img WHERE id_img = :id_img');
			if($sql->execute(array(':id_img'=>$idImg)))
			{
			}else{
				$errText="userModel_237: ERROR delete in table img idImg= ".$idImg;
				Log::writeLog($errText);
			}
			$db1 = Db::getConnection();
			$sql1 = $db1->prepare('DELETE FROM comment WHERE id_img = :id_img');
			if($sql1->execute(array(':id_img'=>$idImg)))
			{
			}else{
				$errText="userModel_244: ERROR delete in table comment idImg= ".$idImg;
				Log::writeLog($errText);
			}
			$db2 = Db::getConnection();
			$sql2 = $db2->prepare('DELETE FROM imgext WHERE id_img = :id_img');
			if($sql2->execute(array(':id_img'=>$idImg)))
			{
			}else{
				$errText="userModel_252: ERROR delete in table imgext idImg= ".$idImg;
				Log::writeLog($errText);
			}
		}
	}

	public static function extendImg($extendIdImg, $extendIdGroups)
	{
		$arrExtendIdGroups = explode(',', $extendIdGroups);
		foreach($arrExtendIdGroups as $key => $extendIdGroup)
		{
			$db = Db::getConnection();
			$sql = $db->prepare('INSERT INTO imgext (id_img, id_group)  
		    	VALUES (:id_img, :id_group)');
		    if(!$sql->execute(array(':id_img'=>$extendIdImg,	':id_group'=>$extendIdGroup)))
		   	{
		    	return false;
		   	}
		}	
		return false;
	}

	//insert users comment
	public static function inpCommentFunc($id_img, $id_user, $comment)
	{	
		$db = Db::getConnection();
		$sql = $db->prepare('INSERT INTO comment (id_img, id_user, comment)  
	    	VALUES (:id_img, :id_user, :comment)');
	    if($sql->execute(array(':id_img'=>$id_img,	':id_user'=>$id_user, ':comment'=>$comment)))
	   	{
	    	return true;
	   	}else
	   	{
	   		return false;
	   	}
	}

	//members[id/email/name/lastname][group][] 
	public static function groupMembers($userid, $groupId=false)
	{
		$members = array();
		$db = Db::getConnection();
		//result: id name lastname email groupid groupname
		if($groupId)
		{
			$sql = $db->prepare('SELECT users.id AS id, users.name AS name, users.lastname AS lastname, users.email AS email, usgroup.id_group AS groupid, groups.name AS groupname	FROM users INNER JOIN usgroup ON users.id = usgroup.id_user INNER JOIN groups ON usgroup.id_group = groups.id_group AND groups.id_user = :userid WHERE usgroup.id_group = :id_group');
			$sql -> execute(array(':id_group'=>$groupId, ':userid'=>$userid));
		}else{
		$sql = $db->prepare('SELECT users.id AS id, users.name AS name, users.lastname AS lastname, users.email AS email, usgroup.id_group AS groupid, groups.name AS groupname	FROM users INNER JOIN usgroup ON users.id = usgroup.id_user INNER JOIN groups ON usgroup.id_group = groups.id_group AND groups.id_user = :userid');
		$sql -> execute(array(':userid'=>$userid));			
		}
		while($row = $sql->fetch())
		{
			$members['id'][] = $row['id'];
			$members['email'][] = $row['email'];
			$members['name'][] = $row['name'];
			$members['lastname'][] = $row['lastname'];
			$members['groupid'][] = $row['groupid'];
			$members['groupname'][] = $row['groupname'];
		}
		return $members;
	}

	public static function allUsers($userid)
	{
		//ALL USERS
		$allUsers =array();
		$db = Db::getConnection();
		$sql = $db->prepare('SELECT id, name, lastname, email, id_rights  FROM users');
		$sql -> execute();
		while($row = $sql->fetch())
		{
			if($row['id_rights']!=2 || $userid==$row['id']) {continue;}
			$allUsers['id'][] = $row['id'];
			$allUsers['email'][] = $row['email'];
			$allUsers['name'][] = $row['name'];
			$allUsers['lastname'][] = $row['lastname'];
		}
		return $allUsers;
	}


	//get image 20 last comments
	public static function outCommFuncAll($img) //all comments from id_img-s
	{	
		$i=0;
		$comment = array();
		$db = Db::getConnection();
		while(isset($img[$i]['id_img']))
		{
			$sql = $db->prepare('SELECT id_comment, datetime, id_user, comment, likes 
				FROM comment WHERE id_img = :id_img ORDER BY datetime DESC LIMIT 20');
			$id_img = $img[$i]['id_img'];
			$sql -> execute(array(':id_img' => $id_img));
				$j=0;
				while($row = $sql->fetch())
				{
					$comment[$id_img][$j]['id_comment'] = $row['id_comment'];
					$comment[$id_img][$j]['datetime'] = $row['datetime'];
					$comment[$id_img][$j]['id_user'] = $row['id_user'];
					$comment[$id_img][$j]['comment'] = $row['comment'];
					$comment[$id_img][$j]['likes'] = $row['likes'];
					$j++;
				}
		$i++;
		}
		return $comment;
	}
	//get image  10 last comments
	public static function outCommFunc($id_img)
	{	
		//echo "id_img=".$id_img."<br>";
		$db = Db::getConnection();
		$sql = $db->prepare('SELECT * 
			FROM comment WHERE id_img = :id_img ORDER BY datetime DESC LIMIT 10');
		if($sql -> execute(array(':id_img' => $id_img)))
		{
			$i=0;
			while($row = $sql->fetch())
			{
				echo $comm[$i]['id_comment'] = $row['id_comment'];
				echo " i=".$i."<br>";
				echo $comm[$i]['datetime'] = $row['datetime'];
				echo " i=".$i."<br>";	
				echo $comm[$i]['id_user'] = $row['id_user'];
				echo " i=".$i."<br>";	
				$i++;
			}
			return $comm;
		}else
		{
			return false;
		}
	}
	//select language-!!!dont use now
	public static function changeSelectLang($id_user, $lang){
		$db = Db::getConnection();
		$sqlUpd = $db->prepare('UPDATE users SET lang=:lang WHERE id = :id');
		$sqlUpd->execute(array(':id' => $id_user, ':lang'=>$lang));
		$_SESSION['lang'] = $lang;
		setcookie('lang', $lang, time()+3600*24, '/');
	}
	
	public static function changeUserSettings($userid, $name, $lastname, $sex, $birthday, $country, $place, $newpass, $aldpass)
	{
		$arError = array();
		$password = md5(md5(trim($aldpass)));
		$db = Db::getConnection();
		$sql = $db->prepare("SELECT password FROM users WHERE id=$userid ");
		$sql->execute();
		while($row = $sql->fetch())
		{
			if($password == $row['password'])
			{
				$nameUpdate="";
				$lastnameUpdate="";
				$sexUpdate="";
				$birthdayUpdate="";
				$countryUpfate="";
				$placeUpdate="";
				$queryUpdate = "UPDATE users SET ";
				$koma="";
				if ($name) 
				{
					$queryUpdate.="name='".$name."'";
					$koma=", ";
				}
				if ($lastname) 
				{
					$queryUpdate.=$koma."lastname='".$lastname."' ";
					$koma=", ";
				}
				if ($sex) 
				{
					$queryUpdate.=$koma."sex='".$sex."' ";
					$koma=", ";
				}
				if ($birthday) 
				{
					$queryUpdate.=$koma."birthday='".$birthday."' ";
					$koma=", ";
				}
				if ($country) 
				{
					$queryUpdate.=$koma."country='".$country."' ";
					$koma=", ";
				}
				if ($place) 
				{
					$queryUpdate.=$koma."place='".$place."' ";
					$koma=", ";
				}
				if ($newpass) 
				{
					$newpassmd5 = md5(md5(trim($newpass)));
					$queryUpdate.=$koma."password='".$newpassmd5."' ";
				}

				$db2 = Db::getConnection();
				$queryUpdate .= " WHERE id='".$userid."'";
				echo "queryUpdate= ".$queryUpdate."<br>";
				$sql2 = $db2->prepare($queryUpdate);
				$sql2->execute();
			}else
			{
				$arError[] = "Error Password";
			}
		}
		return $arError;
	}

	//resize image to width 400px
	public static function imageResizeWidth($outFile, $inFile, $newWidth=400, $quality = 75)  // качество для формата jpeg 0-100
	{
		ini_set("gd.jpeg_ignore_warning", 1); // иначе на некоторых jpeg-файлах не работает
		list($oldWidth, $oldHeight, $type) = getimagesize($inFile);

	    
	    $coef = $newWidth/$oldWidth;
   		$newHeight = round($oldHeight*$coef);
	    switch ($type) {
        case IMAGETYPE_JPEG: $typeImg = 'jpeg'; break;
        case IMAGETYPE_GIF: $typeImg = 'gif' ;break;
        case IMAGETYPE_PNG: $typeImg = 'png'; break;
   		}
   		$imgfunction = "imagecreatefrom$typeImg";
   		$srcFile = $imgfunction($inFile);
   		$destination_resource = imagecreatetruecolor($newWidth,$newHeight);
   		imagecopyresampled($destination_resource, $srcFile, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);
   		if ($type = 2) { # jpeg
	        imageinterlace($destination_resource, 1); // чересстрочное формирование изображение
	        imagejpeg($destination_resource, $outFile, $quality);      
    	}
    	else { # gif, png
	        $imgfunction = "image$typeImg";
	        $imgfunction($destination_resource, $outFile);
    	}
     	imagedestroy($destination_resource);
    	imagedestroy($srcFile);   	
	}
	//Resize weight = 1000
	public static function imageResizeWidth1366($outFile, $inFile, $newWidth=1366, $quality = 75)  // качество для формата jpeg 0-100
	{
		ini_set("gd.jpeg_ignore_warning", 1); // иначе на некоторых jpeg-файлах не работает
		list($oldWidth, $oldHeight, $type) = getimagesize($inFile);

	    
	    $coef = $newWidth/$oldWidth;
   		$newHeight = round($oldHeight*$coef);
	    switch ($type) {
        case IMAGETYPE_JPEG: $typeImg = 'jpeg'; break;
        case IMAGETYPE_GIF: $typeImg = 'gif' ;break;
        case IMAGETYPE_PNG: $typeImg = 'png'; break;
   		}
   		$imgfunction = "imagecreatefrom".$typeImg;
   		$srcFile = $imgfunction($inFile);
   		$destination_resource = imagecreatetruecolor($newWidth,$newHeight);
   		imagecopyresampled($destination_resource, $srcFile, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);
   		if ($type = 2) { # jpeg
	        imageinterlace($destination_resource, 1); // чересстрочное формирование изображение
	        imagejpeg($destination_resource, $outFile, $quality);      
    	}
    	else { # gif, png
	        $imgfunction = "image$typeImg";
	        $imgfunction($destination_resource, $outFile);
    	}
     	imagedestroy($destination_resource);
    	imagedestroy($srcFile);   	
	}


}
