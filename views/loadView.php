<div class="loadView" align="center">
<form action='user' method=post enctype=multipart/form-data id="loadFile">
		<input type=file name="uploadfile[]" accept = "image/*" required multiple>
		<input type=submit name="loadFile" value=<?=Lang::arr('Save')?>>
</form>
</div>
<?php 
if (@!empty($infoloadView))
{
	echo "$infoloadView";
} 
?>

