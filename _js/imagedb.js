$(function(){
    if (typeof multiple != 'undefined' && multiple.length > 0){
        toggleList($("#image_list"));
    }
    
    $(".imageContainer").on('click', ".image_view", function(e){
        e.preventDefault();
        
        $.fancybox({
        	'padding'		: 0,
        	'href'			: $(this).attr('href'),
        	'title'   		: $(this).find('img').attr('title'),
        	'transitionIn'	: 'elastic',
        	'transitionOut'	: 'elastic'
        });
    });
    
    $(".imageContainer").on('click', ".js-selectImage", function(e){
        e.preventDefault();
        
        if (multiple.length == 0){
            window.opener.select_image($(this).attr('href'), selector, $(this).attr('rel'));
            window.close();
        } else {
            var imageId = $(this).attr('href');
            var $ul = $("#image_list ul").append($(document.createElement('li')));
            $ul.find('li:last').attr('rel', imageId).append('<img src="' + $(this).attr('rel') + '" width="80" height="80" />');
            $(".pagination_link").attr('href', $(".pagination_link").attr('href') + imageId + ';');
            $(".menupunkt[rel='billeder']").attr('href', $(".menupunkt[rel='billeder']").attr('href') + imageId + ';');
        }
    });
    
    $(".imageContainer").on('click', ".js-selectMultipleImages", function(e){
        e.preventDefault();
        
        var json = [];
        $("#image_list ul li").each(function(){
            json.push({id:$(this).attr('rel'), path:$(this).find('img').attr('src')});
        });
        
        window.opener.select_multiple_images(json, selector);
        window.close();
    });
    
    /*$(".menupunkt[rel='billedoversigt']").bind('click', function(e){
        e.preventDefault();
        
        window.open("/admin/imagedb/", "imagedb", "height=760,width=1075,menubar=no,resizable=yes,scrollbars=yes,toolbar=no");
    });*/
    
    $(".imageContainer").on('click', ".imagedb_delete", function(e){
        e.preventDefault();
        if (confirm("Are you certain you want to delete this image?")){
            var $parent = $(this).parents('.admin_image:first');
            var $imageId = $(this).attr('href');
            deleteImage($imageId, $parent);
        }
    });
    
    initImageUpload();
    
});

function deleteImage($imageId, $parent, force){
    if (typeof force == 'undefined') force = 0; else force = 1;
    $.get("/_feed/deleteImage.php", {imageId:$imageId, force:force}, function(json){
        if (json.success){
            $parent.fadeOut('fast', function(){
                $(this).remove();
            });
            dubuy.ui.showMessage(json.msg, !json.success);
        } else {
            // The image is currently being used
            if (json.errorCode == 1){
                if (confirm(json.msg)){
                    // Do the request again, but with a force parameter
                    deleteImage($imageId, $parent, 1);
                } else {
                    dubuy.ui.showMessage("Billedet blev ikke slettet.", !json.success);
                }
            } else {
                dubuy.ui.showMessage(json.msg, !json.success);
            }
        }
    });
}

function toggleList($list){
    if ($list.width() > 0){
        $list.animate({
            width:'0px'
        }, 'fast');
    } else {
        $list.animate({
            width:'200px'
        }, 'fast');
    }
}

function initImageUpload(){
	if ($("#spanButtonPlaceholder").length > 0){
		swfu = new SWFUpload({
				upload_url: "/admin/imagedb/upload.php",	// Relative to the SWF file
				post_params: {"tags":$("#tags").val()},

				// File Upload Settings
				file_size_limit : "30720",	// 30MB
				file_types : "*.jpg;*.png;*.jpeg;*.gif,*.tiff,*.tif",
				file_types_description : "Images",
				file_upload_limit : "0",

				// Event Handler Settings - these functions as defined in Handlers.js
				//  The handlers are not part of SWFUpload but are part of my website and control how
				//  my website reacts to the SWFUpload events.
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,

				// Button Settings
				button_placeholder_id : "spanButtonPlaceholder",
				button_width: 180,
				button_height: 18,
				button_text : '<span class="button">Select Images <span class="buttonSmall">(30 MB Max)</span></span>',
				button_text_style : '.button { font-family: Helvetica, Arial, sans-serif; font-size: 12pt; } .buttonSmall { font-size: 10pt; }',
				button_text_top_padding: 0,
				button_text_left_padding: 18,

				// Flash Settings
				flash_url : "/_js/swfupload/swfupload.swf",	// Relative to this file

				custom_settings : {
					upload_target : "divFileProgressContainer"
				},

				// Debug Settings
				debug: false
			});
		$("#tags").bind("keyup", function(e){
		    swfu.addPostParam("tags", $(this).val());
		});
	}
}