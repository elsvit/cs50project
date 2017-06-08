<div class="commText" id="commText<?=$idImg;?>">
	<p><textarea rows="3" cols="34" id="textCom<?=$idImg;?>"></textarea></p>
	<p>
	<button onclick='saveComm(<?=$idImg;?>, <?=$userid;?>)' class="saveComm" name="saveComm"  value="<?=$idImg;?>"><?=Lang::arr('Save')?></button>
	<button onclick="document.getElementById('commText<?=$idImg;?>').style.display ='none'" name="inpComBtn" value="Cancel"><?=Lang::arr('Cancel')?></button>
	</p>
</div>
<div class="commentBtn">
	<button onclick="document.getElementById('commText<?=$idImg;?>').style.display ='block'" name="inpComBtn" value="Comment"><?=Lang::arr('Comment')?></button>
</div>


