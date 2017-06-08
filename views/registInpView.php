<div class="regist">
  <h2><?php echo Lang::arr('Registration');?></h2>
  <form method="post" action='regist'>
    <p><input type="text" name="name" maxlength='30'  value="<?=@$_REQUEST["name"];?>"  
      Title=<?php echo Lang::arr('Allowable_symbols');?>': a-z, A-Z, а-я, А-Я.' placeholder="Name"><font color='red'>*</font></p>
    <p><input type="text" name="lastname" maxlength='30'  value="<?=@$_REQUEST['lastname'];?>" 
      Title=<?php echo Lang::arr('Allowable_symbols');?>': a-z, A-Z, а-я, А-Я, - .' placeholder="Last Name"><font color='#dddddd'>_</font></p>
    <p><input type="text" name="email" maxlength='60' value="<?=@$_REQUEST['email'];?>" 
      Title='e-mail - '<?php echo Lang::arr('Allowable_symbols');?>': a-z, A-Z, 0-9, _ , . , - , @.' placeholder="email"><font color='red'>*</font></p>
    <p><input type="password" id="password" name="pass" maxlength='30' placeholder="Password"><font color='red'>*</font></p>
    <p><input type="password" id="pass_confirm" name="pass_confirm" maxlength='30' placeholder="Confirm Password"><font color='red'>*</font></p>
    <p>
    <input type="checkbox" class='showPass' id='showPass' name="showPass"
      onChange='changeShowPass()'
    >
    <label for="showPass"><?php echo Lang::arr('Show_password');?></label>
    </p>
    <p><input type="submit" name="register" value="<?php echo Lang::arr('Registration');?>"></p>
    <p><font color='red'>*</font> <?php echo Lang::arr('Necessary_field');?></p>
  </form>
</div>

<script>
  function changeShowPass(){
    var showPsw = document.getElementById('showPass').checked;
    console.log('showPsw:', showPsw);  
    if(showPsw){
      document.getElementsByName('pass')[0].setAttribute('type', 'text');
      document.getElementsByName('pass_confirm')[0].setAttribute('type', 'text');
    }else{
      document.getElementsByName('pass')[0].setAttribute('type', 'password');
      document.getElementsByName('pass_confirm')[0].setAttribute('type', 'password');
    }  
  }
</script>
<?php
if (count($arError)>0)
{
  echo "<p>";
  foreach ($arError as $key => $value) {
?>
    <script>
      alert("Error <?=$value;?>");
    </script>
<?php
  }
  echo "</p>";
}
if (count($arInfo)>0)
{
  echo "<p>";
  foreach ($arInfo as $key => $value) {
    echo $value."<br>";
  }
  echo "</p>";
}

?>