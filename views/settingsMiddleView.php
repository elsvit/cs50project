<div class="settingsWrapp">
  <div class="settings">
    <h2><?php echo Lang::arr('Settings');?></h2>
   
      <div class="settingsBlocks">

        <!-- change users settings BLOCK -->
        <div class="userData">
          
          <form method="post" action='settings'>
            <h4> E-mail:
            <?=$user['email'];?></h4>
            <p><input type="text" name="name" maxlength='30'  value="<?=@$_REQUEST["name"];?>" Title="<?php echo Lang::arr('Allowable_symbols');?>: a-z, A-Z, а-я, А-Я." placeholder="<?=$user['name'];?>"><font color='#dddddd'>_</font></p>
            <p><input type="text" name="lastname" maxlength='30'  value="<?=@$_REQUEST['lastname'];?>" 
              Title="<?php echo Lang::arr('Allowable_symbols');?>: a-z, A-Z, а-я, А-Я, - ." placeholder="<?=$user['lastname'];?>"><font color='#dddddd'>_</font></p>
            
           <!-- sex: -->
           <?php
            $checkedMale = "";          
            $checkedFemale = "";          
            if($user['sex']=='male')
            {
               $checkedMale = "checked";
            }
            if($user['sex']=='female')
            {
               $checkedFemale = "checked";
            }
           ?>
           <p><input type="radio" <?php echo $checkedMale;?> name="sex" value="male"><?php echo Lang::arr('Male');?>
           <input type="radio" <?php echo $checkedFemale;?> name="sex" value="female"><?php echo Lang::arr('Female');?></p>  
           <!-- birthday -->
           <p><input type="date" name="birthday" value="<?=$user['birthday'];?>"></p>
           <!-- country -->
           <p><input type="text" name="country" maxlength='30'  value="<?=@$_REQUEST['country'];?>" 
              Title="Input Your Country" placeholder="<?php echo $user['country'] ? $user['country']: Lang::arr('Country');?>"><font color='#dddddd'>_</font></p>
            <!-- place -->
            <p><input type="text" name="place" maxlength='30'  value="<?=@$_REQUEST['place'];?>" 
              Title="Where are You from" placeholder="<?php echo $user['place'] ? $user['place']: Lang::arr('Place');?>"><font color='#dddddd'>_</font></p>

            <p><input type="password" id="password" name="pass" maxlength='30' placeholder="New Password"><font color='#dddddd'>_</font></p>
            <p><input type="password" id="pass_confirm" name="pass_confirm" maxlength='30' placeholder="Confirm New Password"><font color='#dddddd'>_</font></p>
            <p>
            <input type="checkbox" class='showPass' id='showPass' name="showPass" onChange='changeShowPass("showPass", ["pass", "pass_confirm", "aldpass"])'>
            <label for="showPass"><?php echo Lang::arr('Show_password');?></label>

            <!-- ALD PASSWORD -->
            <p><input type="password" id="aldpass" name="aldpass" maxlength='30' placeholder="Password"><font color='red'>*</font></p>

            </p>
            <p><input type="submit" name="changeUserData" value="<?php echo Lang::arr('Save');?>"></p>
            <p><font color='red'>*</font> <?php echo Lang::arr('Necessary_field');?></p>
          </form>

          <?php
          if (count($arError)>0)
          {
            echo "<p>";
            foreach ($arError as $key => $value){
                echo " ".$value."<br>";
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
          }?>
        </div>
        
       <div class="userGroupsBlock">
        <div class="userGroups">
          <h4><?php echo Lang::arr('Groups').":";?></h4>

            <button onclick="document.getElementById('inpNewGroup').style.display ='block'" class="addNewGroup" name="addNewGroup"  value="addNewGroup" title="Add new group">+</button>
            
            <select onchange="changeSelectGroup()" name="selectGroup" id="selectGroup">
              <?php foreach($userGroups as $idGroup => $nameGroup):?>
                <?php if($nameGroup == $_POST['groupName']):?>
                  <option selected value="<?php echo $nameGroup;?>"><?php echo $nameGroup;?></option>
                <?php else:?>
                  <option value="<?php echo $nameGroup;?>"><?php echo $nameGroup;?></option>
                <?php endif;?>
              <?php endforeach;?>
            </select>

              <div class="inpNewGroup" id="inpNewGroup">
                <div class="inpNameNewGroup">
                  <input type="text" name="newGroupName" id="newGroupName" maxlength=15  value="<?=@$_REQUEST['newGroupName'];?>" 
                    Title="Input New Group" placeholder = "Input New Group">
                </div>
                <div class="inpDescriptionNewGroup">
                  <textarea rows="" cols="19" id="newGroupDescription" name="newGroupDescription" placeholder = "Describe New Group"></textarea>
                </div>
                <div class="btnAddNewGroupAndCancel">
                  <button onclick='addNewGroup(<?php echo $user['id'];?>)' class="saveNewGroup" name="saveNewGroup" value="<?php echo $user['id'];?>"><?php echo Lang::arr('Save')?></button>
                    <button onclick="document.getElementById('inpNewGroup').style.display ='none'" name="cancelSaveNewGroup" value="Cancel"><?=Lang::arr('Cancel')?></button>
                </div>

              </div>

          <!-- +(PLUS) MEMBER OF GROUP -->
          <h4><?php echo Lang::arr('Users').":";?></h4>
          <div class="plusMemberOfGroupWrapper">
            <div class="plusMemberOfGroup">
              <div class="btnPlusMember">
              <button onclick="document.getElementById('allUsersBlock').style.display ='block'" class="addNewMember" name="addNewMember"  value="addNewMember" title="Add new member of group">+</button>  
              </div>
              <div class="whiteBG">
                <div id="selectGroupView">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="groupMembers">

<!-- //////////////////// -->
          <select name="selectMember" id="selectMember" size=20>
           </select>
            
            <?php 

             echo '<script> var membersJson='.json_encode($members).';
              var selectGroupIndex = document.getElementById("selectGroup").selectedIndex;
              var startSelectGroupValue = document.getElementById("selectGroup").value;
              // console.log("startSelectGroupValue=",startSelectGroupValue);
              var objSel = document.getElementById("selectMember");
              var sel=0;
              for(var i=0; i<membersJson["groupname"].length; i++)
              {
                if(membersJson["groupname"][i] == startSelectGroupValue)
                {
                  objSel.options[sel] = new Option(membersJson["name"][i]+". "+membersJson["email"][i], i);
                  sel++;                      
                 }
              }
              document.getElementById("selectGroupView").innerHTML = startSelectGroupValue;
              document.getElementById("groupInallUsersBlock").innerHTML = startSelectGroupValue;

              function changeSelectGroup()
              {
                  var selectGroupIndex = document.getElementById("selectGroup").selectedIndex;
                  var selectGroupValue = document.getElementById("selectGroup").value;
                  // console.log("change=", selectGroupIndex, "  ", selectGroupValue);
                  document.getElementById("selectGroupView").innerHTML = selectGroupValue;
                  document.getElementById("groupInallUsersBlock").innerHTML = selectGroupValue;
                  
                  var objSel = document.getElementById("selectMember");
                  objSel.options.length=0;
                  var sel=0;
                  for(var i=0; i<membersJson["groupname"].length; i++)
                  {
                    if(membersJson["groupname"][i] == selectGroupValue)
                    {
                      objSel.options[sel] = new Option(membersJson["name"][i]+" "+membersJson["lastname"][i]+". "+membersJson["email"][i], i);
                      sel++;                      
                     }
                  }
              }
              </script>';
            ?>

        </div>

      </div>  <!-- end userGroupsBLOCK -->

      <div class="allUsersBlock" id="allUsersBlock">
        <h4>Add new member to group<div id="groupInallUsersBlock"></div></h4>

                <!-- SELECT MEMBER FROM ALL USERS -->
        <div class="addNewMember">
          <div class="addNewMemberBlock" id="addNewMemberBlock">
            <div class="addCancelNewMember" id="addCancelNewMember">
              <p>
              <button onclick='addNewMember()' class="saveNewMember" name="saveNewMember" value="<?php echo $user['id'];?>"><?php echo Lang::arr('Add_user')?></button>
                <button onclick="document.getElementById('allUsersBlock').style.display ='none'" name="cancelSaveNewMember" value="Cancel"><?=Lang::arr('Cancel')?></button>
              </p>
            </div>
            
            <div class="allUsersOut">
              <select name="selectUserForGroup" id="selectUserForGroup" size=20 title="Select and Add_user to select group">
                <?php 
                for($i=0; $i<=count($allUsers['id']); $i++):
                  if(!empty($allUsers['id'][$i])):
                    $line = $allUsers['name'][$i]." ".$allUsers['lastname'][$i].". ".$allUsers['email'][$i];
                  ?>
                    <option value="<?php echo $line;?>"><?php echo $line;?></option>
                  <?php endif;?>  
                <?php endfor;?>
              </select>
            </div>
          </div>

        </div>
      </div> <!-- end ALL users BLOCK -->


    </div><!-- end settings block -->
 
  </div>
</div>
<pre>




</pre>

<script src="/js/settings.js"></script>
<script>
  function changeShowPass(idCheck, arrName){
    var showPsw = document.getElementById(idCheck).checked;
    for(var i = 0, n = arrName.length; i < n; i++)
    {
      var type = showPsw ? 'text' : 'password';
      document.getElementsByName(arrName[i])[0].setAttribute('type', type);
    }
  }
</script>



