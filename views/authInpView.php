<div class="auth">
  <h2><?=Lang::arr('Authorization')?></h2>
  <form method="post" action='/auth/auth' id="auth">
    <p><input type="text" name="email" id="email" maxlength="60" value="<?=@$_REQUEST['email'];?>"
    .  Title="e-mail - "<?=Lang::arr('Allowable_symbols')?>": a-z, A-Z, 0-9, _ , . , - , @." placeholder="email"><font color='red'>*</font></p>
    <p><input type="password" name="pass" id="pas" maxlength="30" placeholder="Password"><font color='red'>*</font></p>
    <p><input type="checkbox" name="rempas" id="rempas">
    <label for="rempas"><?=Lang::arr('Remember')?></label></p>
    <p><input type="submit" name="auth" value="<?=Lang::arr('Authorization')?>"></p>
  </form>
</div>
<?php

  if(@count($authInpError)>0){
    echo Lang::arr('Authorization_ERROR')."<p>";
    echo "<br>";
    foreach ($authInpError as $key => $value) {
      echo $value."<br>";
     }
  echo "</p>";  
  }

?>
