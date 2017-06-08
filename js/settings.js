function addNewGroup(idOwnerGroup)
{
    var newGroupName = $('#newGroupName').val();
    var newGroupDescription = $('#newGroupDescription').val();
    
    console.log("newGroupName="+newGroupName);
    console.log("newGroupDescription="+newGroupDescription);
    console.log("idOwnerGroup="+idOwnerGroup);
    $(function(){
        // e.preventDefault();
        $.ajaxSetup({
        error : function(jqXHR, textStatus, errorThrown) {
            if(jqXHR.status === 404) {
              console.log("Element not found.");
            } else {
              console.log("Error: " + textStatus + ": " + errorThrown);
            }
        }
        });

        $.post(
            "settings",
            {
                'idOwnerGroup': idOwnerGroup,
                'newGroupName': newGroupName,
                'newGroupDescription': newGroupDescription
            }
        )
        .done(function() { console.log("_Done"); })
        .fail(function() { console.log("_Fail"); })
        .success(function() { 
            console.log("_Success newGroupName=",newGroupName,"  ",newGroupDescription);
            location.reload();
         })
        .complete(function() { console.log("_Complete выполнения"); })
        ;
    });


};

function addNewMember()
{
    var selectUser = document.getElementById("selectUserForGroup").value;
    var groupName = document.getElementById("selectGroup").value;
    var emailNewMemberOfGroup = selectUser.substr(selectUser.indexOf(". ")+2);
    console.log("selectUser=",selectUser," GroupName=",groupName," emailNewMemberOfGroup=",emailNewMemberOfGroup);  
    $(function(){
        // e.preventDefault();
        $.ajaxSetup({
            error : function(jqXHR, textStatus, errorThrown) {
                if(jqXHR.status === 404) {
                  console.log("Element not found.");
                } else {
                  console.log("Error: " + textStatus + ": " + errorThrown);
                }
            }
        });

        $.post(
            "settings",
            {
                'groupName': groupName,
                'emailNewMemberOfGroup': emailNewMemberOfGroup
            },
            function(){
                console.log("_Success emailNewMemberOfGroup=",groupName,"  ",emailNewMemberOfGroup);
                location.reload();
            }
        )
        .done(function() { console.log("_Done"); })
        .fail(function() { console.log("_Fail"); })
        .complete(function() { console.log("_Complete выполнения"); })
        ;
    });
}    
