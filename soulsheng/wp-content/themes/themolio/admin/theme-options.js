jQuery(document).ready(function() {

    //Loading current tab using cookie
    if(getCookie("currtab") != "" && getCookie("currtab") != null) {
        jQuery('.nav-tab').removeClass('nav-tab-active');
        var currtab = getCookie("currtab");
        jQuery('#' + currtab).addClass('nav-tab-active');
        var currsection = currtab.replace('nav-tab-','settings-');
        jQuery('.settings-section').hide();
        jQuery('#' + currsection).show();
    }

    //Animating tab
    jQuery('.nav-tab').click(function() {
        var clickedId = jQuery(this).attr("id");
        var currentId = jQuery('.nav-tab-active').attr("id");
        if(clickedId != currentId) {
            var clickedSectionId = clickedId.replace('nav-tab-','settings-');
            var currentSectionId = jQuery('.current-section').attr("id");
            jQuery('.settings-section').hide();
            jQuery('#' + currentSectionId).removeClass('current-section');
            jQuery('#' + clickedSectionId).slideDown(500);
            jQuery('#' + clickedSectionId).addClass('current-section');
            jQuery('#' + currentId).removeClass('nav-tab-active');
            jQuery('#' + clickedId).addClass('nav-tab-active');
        }
    });

    //Upload image script
    var formfieldID;
    jQuery('.image_upload').click(function() {
	var btnId = jQuery(this).attr("id");
	formfieldID = btnId.replace("_upload","");
	tb_show('', 'media-