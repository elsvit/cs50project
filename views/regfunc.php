<div class="regist">
        <h2>Регистрация</h2>
        <form method="post">
         <p><input type="text" name="name" maxlength='30'  value="<?=$_REQUEST['name']?>"  
          Title='Имя - допустимимые символы: a-z, A-Z, а-я, А-Я, не пустое.' placeholder="Name"><font color='red'>*</font></p>
         <p><input type="text" name="lastname" maxlength='30'  value="<?=$_REQUEST['lastname']?>" 
          Title="Фамилия - допустимимые символы: a-z, A-Z, а-я, А-Я, - ." placeholder="Last Name"></p>
         <p><input type="text" name="email" maxlength='60' value="<?=$_REQUEST['email']?>" 
          Title="e-mail - допустимимые символы: a-z, A-Z, 0-9, _ , . , - , @ и не быть пустым." placeholder="email"><font color='red'>*</font></p>
         <p><input type="password" name="pass" maxlength='30' placeholder="Password"><font color='red'>*</font></p>
         <p><input type="password" name="pass_confirm" maxlength='30' placeholder="Confirm Password"><font color='red'>*</font></p>
         <p>
          <input type="checkbox" name="vispas" id='vispas'>
          <label for="vispas">Показать пароль</label>
         </p>
         <p><input type="submit" name="register" value="Регистрация"></p>
         <p><font color='red'>*</font> Обязательное поле</p>
        </form>

        <?
        //$_GLOBAL['base']="project4";
        ?>
        <?php
        $link = mysql_connect($_GLOBAL['nyhost'],$_GLOBAL['myhostpsw']);
        if($link){
         mysql_select_db($_GLOBAL['base'], $link);
         if($_REQUEST['register']){
          $arErrors = array();
          if(!preg_match("/^([a-zйцукенгшщзхъфывапролджэячсмитьбюЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮёЁіІїЇєЄ`])+$/i", $_REQUEST['name'])){
           $arErrors[] = "Имя может содержать только буквы и не быть пустым.";
          }
          if ($_REQUEST['lastname']) {
            if(!preg_match("/^([a-zйцукенгшщзхъфывапролджэячсмитьбюЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮёЁіІїЇєЄ`-])+$/i", $_REQUEST['lastname'])){
              $arErrors[] = "Если Вы вводите Фамилия: может содержать только буквы и - .";
            }
          }
          if(!preg_match("|^([a-zA-Z0-9_\.-]+)@([a-zA-Z0-9_\.-]+)$|", $_REQUEST['email'])){
           $arErrors[] = "e-mail может содержать только латинские символы, цифры, '_', '.', '-' и не быть пустым.";
          }
          if(($_REQUEST['pass'] !== $_REQUEST['pass_confirm']) | $_REQUEST['pass']==''){
           $arErrors[] = 'Ошибка введения Паролей';
          }
          $query = mysql_query("SELECT COUNT(id) FROM users WHERE users.email='".$_REQUEST['email']."'");
          if(@mysql_result($query, 0) > 0){
           $arErrors[] = 'Пользователь с таким email уже существует';
          }

          if(count($arErrors) == 0){
           $name = $_REQUEST['name'];
           $email = $_REQUEST['email'];
           $password = md5(md5(trim($_REQUEST['pass'])));
           
          echo "<br>";
           if (mysql_query("INSERT INTO users (name, email, password, id_rights) 
            VALUES ('$name', '$email', '$password', 0)")){
            echo "INSERT OK<br>";

             $passCheckMail = substr($password, 2, 22);

             $check_reg="Для подтверждения регистрации перейдите по ссылке\r\n
             <a href="."mysite/check_reg.php?passCheckMail=\r\n".
             $passCheckMail."&idChackMail=".$email."></a>";
             mail('$email', "Фотоархив регистрация", $check_reg);   
           }else{
            echo "INSERT ERROR<br>";
           }
          }else{
             foreach ($arErrors as $error) {
            ?>
             <p><font color='red'><?=$error?></font></p>
            <?
           }
          }
         
         } 
        }else{
         echo "error connect: ",mysql_error();
        }
        @mysql_close($link);
        ?>
  </div>