<?php
	$cubeImgDir = "/imgs/cube/";
	$dd = dir(ROOT.$cubeImgDir);
	$cubeImgArr = array();
	while(false!==($entry = $dd->read()))
	{
		switch (pathinfo($entry, PATHINFO_EXTENSION)) 
		{
			case 'jpg': 
				if(is_numeric(pathinfo($entry, PATHINFO_FILENAME)))
				{
					$cubeImgArr[] = pathinfo($entry, PATHINFO_BASENAME);
				}
			break;
			case 'png': 
				if(is_numeric(pathinfo($entry, PATHINFO_FILENAME)))
				{
					$cubeImgArr[] = pathinfo($entry, PATHINFO_BASENAME );
				}
			break;
			case 'gif': 
				if(is_numeric(pathinfo($entry, PATHINFO_FILENAME)))
				{
					$cubeImgArr[] = pathinfo($entry, PATHINFO_BASENAME );
				}
			break;
		}
	}
	$cubeImg1=$cubeImgArr[array_rand($cubeImgArr)];
	$cubeImg2=$cubeImgArr[array_rand($cubeImgArr)];
	$cubeImg3=$cubeImgArr[array_rand($cubeImgArr)];
	$cubeImg6=$cubeImgArr[array_rand($cubeImgArr)];
?>
<div class="mainMiddle">
<div class="mainCube">
	<div id="wrapper">
		<div id="cube">
			<div class="side" id="side1"><img src="<?php echo "",$cubeImgDir,$cubeImg1;?>" height="400" width="400"></div>
			<div class="side" id="side2"><img src="<?php echo  "",$cubeImgDir,$cubeImg2;?>" height="400" width="400"></div>
			<div class="side" id="side3"><img src="<?php echo  "",$cubeImgDir,$cubeImg3;?>" height="400" width="400"></div>
			<div class="side" id="side5"><img src= "<?php echo  "",$cubeImgDir,"back1.png";?>"
			height="400" width="400"></div>
			<div class="side" id="side6"><img src="<?php echo  "",$cubeImgDir,$cubeImg6;?>" height="400" width="400"></div>
		</div>
	</div>
</div>
</div>



