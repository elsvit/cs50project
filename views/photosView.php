
			<?if(!$commentBtn==$img[$i]['id_img']):?>
				<div class="commentBtn">
					<form action='user' method=post id="commentBtn">
						<button name=inpComBtn value="<?=$img[$i]['id_img'];?>">
							Комментировать
						</button>
					</form>
				</div>
			<?else:?>
				<div class="saveCommentBtn">
					<form action='user' method=post id="saveCommentBtn">
						<p><textarea rows="3" cols="40" name="textCom"></textarea></p>
						<!-- <p><input type="submit" name=okTextCom value="Сохранить комментарий"></p> -->
			    		<p><button name=okTextCom  value="<?=$img[$i]['id_img'];?>">
							Сохранить комментарий
						</button>
						<button name=escTextCom  value="<?=$img[$i]['id_img'];?>">
							Отменить
						</button>
						</p>
			    		<? $_SESSION['pathImg']=$img[$i]['path']?>
					</form>
				</div>
			<?endif;?>
			
			<?$j=0?>
			<?while(isset($comment[$img[$i]['id_img']][$j]['id_comment'])):?>
				<p>
					<?=$comment[$img[$i]['id_img']][$j]['id_user'];?>
					|
					<?=date("H:i d.m.y  ", strtotime($comment[$img[$i]['id_img']][$j]['datetime']));?>
				</p>
				<p><?=$comment[$img[$i]['id_img']][$j]['comment'];?></p>
			<?$j++?>
			<?endwhile;?>
		
	</div>

