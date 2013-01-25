/**
 * editor_plugin_src.js
 *
 * Copyright 2009, Moxiecode Systems AB
 * Released under LGPL License.
 *
 * License: http://tinymce.moxiecode.com/license
 * Contributing: http://tinymce.moxiecode.com/contributing
 */

(function() {
	var DOM = tinymce.DOM;

	tinymce.create('tinymce.plugins.FullScreenPlugin', {
		init : function(ed, url) {
			var t = this, s = {}, vp, posCss;

			t.editor = ed;

			// Register commands
			ed.addCommand('mceFullScreen', function() {
				var win, de = DOM.doc.documentElement;

				if (ed.getParam('fullscreen_is_enabled')) {
					if (ed.getParam('fullscreen_new_window'))
						closeFullscreen(); // Call to close in new window
					else {
						DOM.win.setTimeout(function() {
							tinymce.dom.Event.remove(DOM.win, 'resize', t.resizeFunc);
							tinyMCE.get(ed.getParam('fullscreen_editor_id')).setContent(ed.getContent());
							tinyMCE.remove(ed);
							DOM.remove('mce_fullscreen_container');
							de.style.overflow = ed.getParam('fullscreen_html_overflow');
							DOM.setStyle(DOM.doc.body, 'overflow', ed.getParam('fullscreen_overflow'));
							DOM.win.scrollTo(ed.getParam('fullscreen_scrollx'), ed.getParam('fullscreen_scrolly'));
							tinyMCE.settings = tinyMCE.oldSettings; // Restore old settings
						}, 10);
					}

					return;
				}

				if (ed.getParam('fullscreen_new_window')) {
					win = DOM.win.open(url + "/fullscreen.htm", "mceFullScreenPopup", "fullscreen=yes,menubar=no,toolbar=no,scrol