/**
 * WP Fullscreen TinyMCE plugin
 *
 * Contains code from Moxiecode Systems AB released under LGPL License http://tinymce.moxiecode.com/license
 */

(function() {
	tinymce.create('tinymce.plugins.wpFullscreenPlugin', {

		init : function(ed, url) {
			var t = this, oldHeight = 0, s = {}, DOM = tinymce.DOM;

			// Register commands
			ed.addCommand('wpFullScreenClose', function() {
				// this removes the editor, content has to be saved first with tinyMCE.execCommand('wpFullScreenSave');
				if ( ed.getParam('wp_fullscreen_is_enabled') ) {
					DOM.win.setTimeout(function() {
						tinyMCE.remove(ed);
						DOM.remove('wp_mce_fullscreen_parent');
						tinyMCE.settings = tinyMCE.oldSettings; // Restore old settings
					}, 10);
				}
			});

			ed.addCommand('wpFullScreenSave', function() {
				var ed = tinyMCE.get('wp_mce_fullscreen'), edd;

				ed.focus();
				edd = tinyMCE.get( ed.getParam('wp_fullscreen_editor_id') );

				edd.setContent( ed.getContent({format : 'raw'}), {format : 'raw'} );
			});

			ed.addCommand('wpFullScreenInit', function() {
				var d, b, fsed;

				ed = tinyMCE.activeEditor;
				d = ed.getDoc();
				b = d.body;

				tinyMCE.oldSettings = tinyMCE.settings; // Store old settings

				tinymce.each(ed.settings, function(v, n) {
					s[n] = v;
				});

				s.id = 'wp_mce_fullscreen';
				s.wp_fullscreen_is_enabled = true;
				s.wp_fullscreen_editor_id = ed.id;
				s.theme_advanced_resizing = false;
				s.theme_a