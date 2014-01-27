$(function(){
    
    if ($("[name='contentEditor']").length > 0){
        CKEDITOR.replace('contentEditor', {
            height: 500
        });
    }
    
    $(".js-confirm").bind('click', function(e){
        if (!confirm("Are you sure you want to do this?")){
            e.preventDefault();
            return false;
        }
    });
    
});

