<?php 
$lang = $_SESSION['lang'];
$langList = Lang::langList();
?>
<footer class="footer">
	<div class="footer_botline">
		<div class="container">
			<div class="col-md-12">
				<div class="row">
					<div class="bot_links" align="center">
						<table>
							<tr>
								<td>
									<a href="/main/contacts"><?php echo Lang::arr('Contacts');?></a> |
									<a href="/main/project"><?php echo Lang::arr('Project');?></a> |
								</td>
								<td>
									<form method='post' action=''>
									<select onchange="changeLang()" name="langSelect" id="langSelect">
											<?php foreach($langList as $key => $val):?>
												<?php if($val == $_SESSION['lang']):?>
													<option selected value="<?php echo $val;?>"><?php echo $_SESSION['lang'];?></option>
												<?php else:?>
													<option value="<?php echo $val;?>"><?php echo $val;?></option>
												<?php endif;?>
											<?php endforeach;?>
										</select>
									</form>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>			