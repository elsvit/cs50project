/* save comment */
function saveComm(idImgComm, idUserComm)
{
    var newCommTxt = $('#textCom'+idImgComm).val();
    console.log("idImgComm="+idImgComm);
    console.log("idUserComm="+idUserComm);
    console.log("newCommTxt="+newCommTxt);
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
            "user",
            {
                'idImgComm': idImgComm,
                'idUserComm': idUserComm,
                'newCommTxt': newCommTxt
            }
        )
        .done(function() { console.log("_Done"); })
        .fail(function() { console.log("_Fail"); })
        .success(function() { 
            console.log("_Success выполнение");
            location.reload();
         })
        .complete(function() { console.log("_Complete выполнения"); })
        ;
    });
};

/* select groups for extend */
function saveExtendByIdGroup(idImg, idUser, allCheckList)
{
    var arrCheck = allCheckList.split(',');
    var annex = arrCheck[0]+idImg+'_';
    var checkList = "";
    var idCheck;
    // console.log(annex,' length=',arrCheck.length);
    // console.log(arrCheck);
    for(var i=1; i<(arrCheck.length);i++)
    {
        idCheck = ''+annex+arrCheck[i];
        // console.log('i_idcheck_value=',arrCheck[i],' ',idCheck,' ',document.getElementById(idCheck).checked);
        if(document.getElementById(idCheck).checked)
        {
            checkList+=arrCheck[i]+',';
            // console.log('checkList',checkList);
        }
    }
    checkList = checkList.slice(0, -1);
    // console.log('checkListEnd=',checkList,' ',checkList.length);
    if(checkList.length>0)
    {
        $(function(){
            //e.preventDefault();
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
                "all",
                {
                    'extendIdImg': idImg,
                    'extendIdGroups': checkList
                    
                }
            )
            .done(function() { console.log("_Done"); })
            .fail(function() { console.log("_Fail"); })
            .success(function() { 
                console.log("_Success выполнение");
                document.getElementById('extendPhoto'+idImg).style.display ='none';
             })
            .complete(function() { console.log("_Complete выполнения"); })
            ;
        });
    }
}
/* Rename file*/
function renameImgById(idImg)
{
    var newImgName = document.getElementById('imgRenameDeleteInput'+idImg).value;
    console.log("input=",newImgName," idImg=",idImg);
    if (/[a-z][\w-]+/i.test(newImgName))
    {
        $(function(){
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
            "user",
            {
                'idImgNewImgName': idImg,
                'newImgName': newImgName
            }
        )
        .done(function() { console.log("_Done"); })
        .fail(function() { console.log("_Fail"); })
        .success(function() { 
            console.log("_Success выполнение");
            document.getElementById('imgRenameDelete'+idImg).style.display ='none';
            location.reload();
         })
        .complete(function() { console.log("_Complete выполнения"); })
        ;
    }); 
    }else
    {
        alert('Error! INCORRECT filename. Use: a-z, A-Z, -, _');
    }    
}
/* Delete img*/
function deleteImgById(idImg)
{
    console.log("delete idImg",idImg);
    if (confirm('Delete image?'))
    {
        $(function(){
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
                "user",
                {
                    'idImgDelete': idImg
                }
            )
            .done(function() { console.log("_Done"); })
            .fail(function() { console.log("_Fail"); })
            .success(function() { 
                console.log("_Success выполнение");
                document.getElementById('imgRenameDelete'+idImg).style.display ='none';
                location.reload();
             })
            .complete(function() { console.log("_Complete выполнения"); })
            ;
        });       
    }
}