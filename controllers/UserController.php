<?php
require_once ROOT.'/views/userView.php';
require_once ROOT.'/views/allView.php';
require_once ROOT.'/views/settingsView.php';

class UserController
{
	public function userAction()
	{
		if (isset($_SESSION['userid']))
		{	
			/////////////////////
			$userid = $_SESSION['userid'];
			$copyFileInfo = "";
			$sizeFileInfo = "";
			$existsFileInfo = "";
			$commentBtn="";

			if(isset($_REQUEST['loadFile']))
			{
				$maxFileSize=6000000;
				$smallImgAnnex="_";
				$fn = 0;
				while(isset($_FILES['uploadfile']['name'][$fn]))
				{
					$fileName = $_FILES['uploadfile']['name'][$fn];
					if($_FILES['uploadfile']['error'][$fn]==0)
					{
						if($_FILES['uploadfile']['size'][$fn]<$maxFileSize)
						{
							$uploaddir = ROOT.'/imgs/';
							$uploadfile = "i".$_SESSION['userid']."_".basename($fileName);
							$uploadfilePath = $uploaddir.$uploadfile;
							if(file_exists($uploadfilePath))
							{
								$existsFileInfo = " File ".$fileName." already exists ";
							}else
							{	

								$imgFile1000=$uploadfilePath;
								UserModel::imageResizeWidth($imgFile1000, $_FILES['uploadfile']['tmp_name'][$fn], 1366);
								if (file_exists($imgFile1000)) 
								 {
								 	//for small Img annex "_"
								 	$outFile =  $uploaddir.$smallImgAnnex.$uploadfile;
								 	UserModel::imageResizeWidth($outFile, $uploadfilePath);
								 	$copyFileInfo = " File is saved. ";
								 	
								 	UserModel::imgToDb($_SESSION['userid'], $uploadfile, $_FILES['uploadfile']['size'][$fn]);
								 }else
								 { 
								 	$copyFileInfo = " Error! File didnot save! ";
								 }
							}
						}else
						{
							$sizeFileInfo =" File is bigger then $maxFileSize byte. ";
						} 
					}else
					{
						?>
						    <script>
						      alert("Error file load <?=$fileName;?>");
						    </script>
						<?php
					}
				$fn++;
				}
			}
			
			if(isset($_POST['newImgName']))
			{
				$errInp=inpFilter::filename($_POST['newImgName']);
				if(!$errInp)
				{
					$newImgName = trim($_POST['newImgName']);
					$idImgNewImgName = trim($_POST['idImgNewImgName']);
					UserModel::renameImg($idImgNewImgName, $newImgName);

					Log::writeLog($newImgName." 84");
					Log::writeLog($idImgNewImgName);					
				}else
				{
					Log::writeLog($errInp);
				}
			}
			if(isset($_POST['idImgDelete']))
			{
				UserModel::deleteImg($_POST['idImgDelete']);
			}

			$user = UserModel::userFunc($userid);
			$img = UserModel::imgFunc($userid);
			$comment = UserModel::outCommFuncAll($img);

			userView::headView();
			userView::headerView($user);
			userView::loadView($copyFileInfo, $sizeFileInfo, $existsFileInfo);

			if(isset($_POST['idImgComm']))
			{
				if(!empty($_POST['idImgComm'])){
				$idImgComm = $_POST['idImgComm'];
				$idUserComm = $_POST['idUserComm'];
				$newCommTxt = $_POST['newCommTxt'];
				$comment = UserModel::inpCommentFunc($idImgComm, $idUserComm, $newCommTxt);
				}
			}

			//output imgs	
			$i=0;
			$userGroups = UserModel::userGroups($userid);
			while(isset($img[$i]['path']))
			{
				
				userView::photoView($img[$i]['id_img_owner'], $img[$i]['name_img_owner'],$img[$i]['id_img'], $img[$i]['path'], $img[$i]['datetime'], $userGroups, $userid);
				$idImg = $img[$i]['id_img'];
				if(isset($comment[$idImg]))
				{
					$j=0;
					while(isset($comment[$idImg][$j]['id_comment']))
					{
						$datetimeComm=$comment[$idImg][$j]['datetime'];
						$id_userComm=$comment[$idImg][$j]['id_user'];
						$commentTxt=$comment[$idImg][$j]['comment'];
						// $likesComm=$comment[$id_img][$j]['likes'];//!!!!ADD LATER LIKES
						$userNameComm = UserModel::userFunc($id_userComm);
						userView::commentView($userNameComm, $datetimeComm, $commentTxt);
					$j++;
					}
				}
				userView::commentBotView($idImg, $userid);
				$i++;
			}
			userView::spaceFooterView();
			userView::footerView();
			return true;
		}else
		{
			return false;
		}
	}

	public function inpComBtn()
	{
		if ($_SESSION['userid'])
		{	
			$copyFileInfo = "";
			$sizeFileInfo = "";
			$existsFileInfo = "";

			$userid = $_SESSION['userid'];
			$user = UserModel::userFunc($userid);
			$img = UserModel::imgFunc($userid);;
		
			$HeaderLeft1href = '/main/main';
			$HeaderLeft1text = Lang::arr('Main');
			$HeaderLeft2href = '/user/settings';
			$HeaderLeft2text = $user['name']." ".$user['lastname'];

			$commentBtn=true;

			require_once(ROOT.'/views/photosView.php');

			return true;
		}else
		{
			return;
		}
	}

	public function inpCom()
	{
		if ($_SESSION['userid'])
		{	
			$copyFileInfo = "";
			$sizeFileInfo = "";
			$existsFileInfo = "";

			$userid = $_SESSION['userid'];
			$user = UserModel::userFunc($userid);
			$img = UserModel::imgFunc($userid);;
		
			$HeaderLeft1href = '/main/main';
			$HeaderLeft1text = Lang::arr('Main');
			$HeaderLeft2href = '/user/settings';
			$HeaderLeft2text = $user['name']." ".$user['lastname'];

			$commentBtn=false;
			
			require_once(ROOT.'/views/photosView.php');

			return true;
		}else
		{
			return false;
		}
	}

	public function allAction()
	{
		if ($_SESSION['userid'])
		{	
			
			$userid = $_SESSION['userid'];
			$copyFileInfo = "";
			$sizeFileInfo = "";
			$existsFileInfo = "";
			$commentBtn="";

			$user = UserModel::userFunc($userid);

			//new for ALL
			$img = UserModel::allImgFunc($userid);

			$comment = UserModel::outCommFuncAll($img);


			allView::headView();
			allView::headerView($user);

			if(isset($_POST['extendIdImg']))
			{
				$extendIdImg=$_POST['extendIdImg'];
				$extendIdGroups=$_POST['extendIdGroups'];
				$extendImg=UserModel::extendImg($extendIdImg, $extendIdGroups);
			}
			
			if(isset($_POST['idImgComm']))
			{
				if(!empty($_POST['idImgComm'])){
				$idImgComm = $_POST['idImgComm'];
				$idUserComm = $_POST['idUserComm'];
				$newCommTxt = $_POST['newCommTxt'];
				$comment = UserModel::inpCommentFunc($idImgComm, $idUserComm, $newCommTxt);
				}
			}

			//output imgs	
			$i=0;
			$userGroups = UserModel::userGroups($userid);
			while(isset($img[$i]['path']))
			{
				
				allView::photoView($img[$i]['id_img_owner'], $img[$i]['name_img_owner'], $img[$i]['id_img'], $img[$i]['path'], $img[$i]['datetime'], $userGroups, $userid);
				$idImg = $img[$i]['id_img'];
				if(isset($comment[$idImg]))
				{
					$j=0;
					while(isset($comment[$idImg][$j]['id_comment']))
					{
						$datetimeComm=$comment[$idImg][$j]['datetime'];
						$id_userComm=$comment[$idImg][$j]['id_user'];
						$commentTxt=$comment[$idImg][$j]['comment'];
						$userNameComm = UserModel::userFunc($id_userComm);
						allView::commentView($userNameComm, $datetimeComm, $commentTxt);
					$j++;
					}
				}
				allView::commentBotView($idImg, $userid);
				$i++;
			}
			allView::spaceFooterView();
			allView::footerView();
			return true;
		}else
		{
			return false;
		}
	}		
	
	public function settingsAction()
	{
		if ($_SESSION['userid'])
		{
			$userid = $_SESSION['userid'];
			$arError = array();
			$arInfo = array();
			//CHANGE USERS NAME, LASTNAME, PASSWORD
			if(isset($_POST["changeUserData"])&&!empty($_POST["changeUserData"]))
			{
		  	$name = trim($_POST['name']);
		    $lastname = trim($_POST['lastname']);
		    $newpass = $_POST['pass'];
		    $newpass_confirm = $_POST['pass_confirm'];
		    $sex = @$_POST['sex'];
		    $birthday = $_POST['birthday'];
		    $country = trim($_POST['country']);
		    $place = trim($_POST['place']);
		    $aldpass = $_POST['aldpass'];
				$num=0;
				if ($name) 
				{
					if($errArr = InpFilter::latCyr($name))
					{
						$arError[] = $errArr;
					}
					$num=1;
				}
				if ($sex) 
				{
					$num=1;
				}
				if ($birthday) 
				{
					$num=1;
				}
				if ($lastname) 
				{
					if($errArr = InpFilter::latCyr2($lastname))
					{
						$arError[] = $errArr;
					}
					$num=1;
				}
				if ($country) 
				{
					if($errArr = InpFilter::latCyrWords($country))
					{
						$arError[] = $errArr;
					}
					$num=1;
				}
				if ($place) 
				{
					if($errArr = InpFilter::latCyrWords($place))
					{
						$arError[] = $errArr;
					}
					$num=1;
				}
				if ($newpass)
				{
					if($newpass !== $newpass_confirm) 
					{
						{
							$arError[] = "New Password: ".Lang::arr('ERROR');
						}
					}else{
						$num=1;
					}
				}
				if (count($arError) == 0 && $num > 0)
				{
					$arError = UserModel::changeUserSettings($userid, $name, $lastname, $sex, $birthday, $country, $place, $newpass, $aldpass);
				}
				if (count($arError)==0)
				{
					$arInfo[] = Lang::arr('Ok').".";
				}
				$_POST["changeUserData"]=null;
			}

			if(isset($_POST['newGroupName']))
			{
				if(!empty($_POST['newGroupName']))
				{
					$newGroupName = trim($_POST['newGroupName']);
					$newGroupDescription = trim($_POST['newGroupDescription']);

					if($errArr = InpFilter::latCyrNumWords($newGroupName))
					{
						$arError[] = $errArr;
					}
					if (count($arError)==0)
					{
						$newGroup = UserModel::addNewGroup($userid, $newGroupName, $newGroupDescription);
					}
				}
			}
			if(isset($_POST['emailNewMemberOfGroup']))
			{
				if(!empty($_POST['emailNewMemberOfGroup']))
				{
					$emailNewMemberOfGroup = $_POST['emailNewMemberOfGroup'];
					$groupName = $_POST['groupName'];
					$newMember = UserModel::addNewMemberOfGroup($userid, $groupName, $emailNewMemberOfGroup);
				}
			}
			//ARR 	name lastname email by id
			$user = UserModel::getUserSettings($userid);
			//arr ALL GROUPS incl USER
			$userGroups = UserModel::userGroups($userid);

			$members = array();
			$allUsers = UserModel::allUsers($userid);
			$members = UserModel::groupMembers($userid);
			
			settingsView::headView();
			settingsView::headerView();			

			settingsView::middleView($user, $userGroups, $members, $allUsers, $arError, $arInfo);		
			settingsView::footerView();		
		}
		return;
	}

}
?>