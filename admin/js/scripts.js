// CKEditor
$(document).ready(function(){
    ClassicEditor
    .create( document.querySelector( '#body' ) )
    .catch( error => {
        console.error( error );
    } );
});

// checkAll
$(document).ready(function(){
    $('#selectAllBoxes').click(function(event){
        if(this.checked)
        {
            $('.checkBoxes').each(function(){
                this.checked = true;
            });
        }
        else {
            $('.checkBoxes').each(function(){
                this.checked = false;
            });
        }
    });
});

// Users Online
function loadUsersOnline()
{
    $.get("functions.php?onlineusers=result", function (data) {  
        $(".useronline").text(data);
    });
}

setInterval(function(){
    loadUsersOnline();
},500);
