<div class="photoView">
	<div class="atopImgLine">
		<div class='atopImgLeft'>  <!-- text above the image-->
			<?php if($idImgOwner!=$userid):?>
			<div class="atopImgUserName"><?=$nameImgOwner;?>  </div>
			<?php else:?>
			<div class="atopImgPhotoName">
				<a onclick="document.getElementById('imgRenameDelete<?php echo $idImg;?>').style.display ='block'"><?=basename($imgPath);?></a>
			</div>
			<?php endif;?>
			<div class="atopImgPhotoDate"><?=date("H:i d.m.y  ", strtotime($imgTime));?></div>
		</div>
		<div class="atopImgRight">
			<div class="extendPhotoBtn">
				<a onclick="clickExtend(<?php echo $idImg;?>)"><?php echo Lang::arr('Extend');?></a>
			</div>
		</div>
	</div>
	
	<div class='userImg'>  <!-- user image-->
		<!-- <div class="topImg"> -->
			<div class="topImgLeft">
				<div class="imgRenameDelete" id="imgRenameDelete<?php echo $idImg;?>">
					<div class="imgRename">
							<a onclick="renameImgById(<?=$idImg;?>)"><?php echo Lang::arr('Rename');?></a><?php 
							$pattern = '/_*i[0-9]+_/';
							preg_match($pattern, basename($imgPath), $result);
							echo ": ".$result[0]."...";
							?>
					</div> 	
					<div class="imgRenameDeleteInput" >
						<input type="text" size='14' id="imgRenameDeleteInput<?php echo $idImg;?>" placeholder=<?php  
						$pattern = '/_*i[0-9]+_/';
						echo substr(preg_replace($pattern, '', basename($imgPath)),0,-4);?> title = "Input new middle of filename (symbols:a-z A-Z 0-9 _ -)">
					</div>
					<div class="imgDeleteBtn">
							<a onclick="deleteImgById(<?=$idImg;?>)"><?php echo Lang::arr('Delete');?></a>
					</div>
					<div class="cancelImgRenameDelete">
						<a onclick="document.getElementById('imgRenameDelete<?php echo $idImg;?>').style.display ='none'"><?php echo Lang::arr('Cancel');?></a>
					</div>
					
				</div>
			</div>
			<div class="topImgRight">
				<div class="extendPhoto" id="extendPhoto<?php echo $idImg;?>">
					<?php 
					$allCheckList="checkExtendByIdGroup";
					if(count($userGroups)>0):
					foreach($userGroups as $idGroup => $nameGroup):
						$allCheckList.=','.$idGroup;
						?>
						<p><input type="checkbox" class='checkExtendByIdGroup' id="checkExtendByIdGroup<?php echo $idImg;?>_<?php echo $idGroup;?>" name="<?=$idGroup;?>" value=<?=$idGroup;?>><?php echo $nameGroup;?></li></p>
					<?php endforeach;?>
					<div class="saveCancelExtendPhoto">
						<div class="saveExtendPhoto">
							<a onclick="saveExtendByIdGroup(<?=$idImg;?>, <?=$userid;?>, '<?=$allCheckList;?>')"><?php echo Lang::arr('Ok');?></a>
						</div> 	
						<div class="cancelExtendPhoto">
							<a onclick="document.getElementById('extendPhoto<?php echo $idImg;?>').style.display ='none'"><?php echo Lang::arr('Cancel');?></a>
						</div>
					</div>
					<?php else:?> 
						<p>
							Create Group(s) Please.
						</p>
					<?php endif;?>
				</div>
			</div>
		<!-- </div> -->	
	
		<p><a href="<?='/imgs/'.$imgPathIn;?>" download title="download fullsize file"> <img src="<?='/imgs/'.$imgPath;?>" width="400" alt="<?=$pathView;?>"></a></p>
	</div>
</div>
<script src="/js/user.js"></script>
<script>
	function clickExtend(idImg){
		var display = document.getElementById('extendPhoto'+idImg).style.display;
		document.getElementById('extendPhoto'+idImg).style.display = display == 'block' ? 'none' : 'block ';
	}
</script>