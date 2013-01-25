/**
 * NextGEN Gallery - plupload Handlers 
 *
 * Built on top of the plupload library
 *   http://www.plupload.com version 1.4.2
 *
 *  version 1.0.0
 */

// on load change the upload to plupload
function initUploader() {

	jQuery(document).ready(function($){
	   
    	/* Not working in chrome, needs rework
        var dropElm = jQuery('#' + uploader.settings.drop_element);
    	if (dropElm.length && uploader.features.dragdrop) {
    		dropElm.bind('dragenter', function() {
    			jQuery(this).css('border', '3px dashed #cccccc');
    		});
    		dropElm.bind('dragout drop', function() {
    			jQuery(this).css('border', 'none');
    		});
    	}*/
        
        // enable or disable the resize feature
		jQuery('#image_resize').bind('change', function() {
			var arg = jQuery(this).prop('checked');
			setResize( arg );
            
			if ( arg )
				setUserSetting('ngg_upload_resize', '1');
			else
				deleteUserSetting('ngg_upload_resize');            
		});
        
        // get user settings from cookie
        setResize( getUserSetting('ngg_upload_resize', false) );
        
        if ( uploader.features.dragdrop )
				jQuery('.ngg-dragdrop-info').show();
        	
        jQuery("#uploadimage_btn").after("<input class='button-primary' type='button' name='uploadimage' id='plupload_btn' value='" + uploader.settings.i18n.upload + "' />")
                                  .remove();
    	jQuery("#plupload_btn").click( function() { uploader.start(); } );
	}); 
}

// called when a file is added
function fileQueued( fileObj ) {
    debug('[FilesAdded]', fileObj);
    
	filesize = " (" + plupload.formatSize(fileObj.size) + ") ";
	jQuery("#txtFileName").val(fileObj.name);
	jQuery("#uploadQueue")
		.append("<div id='" + fileObj.id + "' class='nggUploadItem'> [<a href=''>" + uploader.settings.i18n.remove + "</a>] " + fileObj.name + filesize + "</div>")
		.children("div:last").slideDown("slow")
		.end();
    jQuery('#' + fileObj.id + ' a').click(function(e) {
        jQuery('#' + fileObj.id).remove();
		uploader.removeFile(fileObj);
		e.preventDefault();
	});        
}

// called before the uploads start
function uploadStart(fileObj) {
    debug('[uploadStart]');
    nggProgressBar.init(nggAjaxOptions);
	// check if a gallery is selected
	if (jQuery('#galleryselect').val() > "0") {
	    debug('[gallery selected]');
		// update the selected gallery in the post_params 
		uploader.settings.multipart_params.galleryselect = jQuery('#galleryselect').val();
	} else {
        debug('[gallery not selected]');
		jQuery('#uploadimage_form').prepend("<input type=\"hidden\" name=\"swf_callback\" value=\"-1\">");
		jQuery("#uploadimage_form").submit();
	}    
	return true;
}

// called during the upload progress
function uploadProgress(fileObj, bytesDone, bytesTotal) {
    var percent = Math.ceil((bytesDone / bytesTotal) * 100);
    debug('[uploadProgress]', fileObj.name + ' : ' + percent + "%");
    nggProgressBar.increase( percent );
	jQuery("#progressbar span").text(percent + "% - " + fileObj.name);
}

// called when all files are uploaded
function uploadComplete(fileObj) {
    debug('[uploadComplete]');

	// Upload the next file until queue is empty
	if ( uploader.total.queued == 0) {
        //TODO: we submit here no error code
		jQuery('#uploadimage_form').prepend("<input type=\"hidden\" name=\"swf_callback\" value=\"0\">");
        nggProgressBar.finished();   
		jQuery("#uploadimage_form").submit();				 
	}	
}

// called when the file is uploaded
function uploadSuccess(fileObj, serverData) {
    debug('[uploadSuccess]', serverData);
    
    if (serverData.response != 0)
        nggProgressBar.addNote("<strong>ERROR</strong>: " + fileObj.name + " : " + serverData.response);
    
	jQuery("#" + fileObj.id).hide("slow");
	jQuery("#" + fileObj.id).remove();
}

function cancelUpload() {
	uploader.stop();
	jQuery.each(uploader.files, function(i,file) {
		if (file.status == plupload.STOPPED)
			jQuery('#' + file.id).remove();
	});
}

function uploadError(fileObj, errorCode, message) {
    debug('[uploadError]', errorCode, message);
	switch (errorCode) {
		case plupload.FAILED:
			error_name = fileObj.name + " : " + pluploadL10n.upload_failed;
			break;
		case plupload.FILE_EXTENSION_ERROR: