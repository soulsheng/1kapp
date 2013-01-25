(function ($) {
	$(function () {
		var wrap = $('#wp_rp_theme_options_wrap'),
			json_url = $('#wp_rp_json_url').val(),
			current_theme = $('#wp_rp_theme_selected').val(),
			themes = null,
			update_themes = function () {
				var td = $('<td />');

				wrap.empty();
				if ($('#wp_rp_theme_title').length === 0) {
					wrap.append('<th scope="row">Select Theme:</th>');
				}
				wrap.append(td);

				if (themes) {
					$.each(themes, function (i, theme) {
						var selected = theme.location === current_theme ? 'checked="checked"' : '';

						td.append('<label><input ' + selected + ' type="radio" name="wp_rp_theme" value="' + theme.location + '" /> ' + theme.name  + '</label><br />');
					});
					wrap.append(tr);
				}
			},
			append_get_themes_script = function () {
				var script = document.createElement('script'),
					body = document.getElementsByTagName("body").item(0);
				script.type = 'text/javascript';
				script.src = json_url + 'themes.js';

				body.appendChild(script);
			};

		window.wp_rp_themes_cb = function (data) {
			if (data && data.themes) {
				themes = data.themes;

				update_themes();
			}
		};

		append_get_themes_script();

		if (!window.localStorage || !window.localStorage.wp_wp_survey_1) {
			$('#wp-rp-survey').show();
		}

		$('#wp-rp-survey .close, #wp-rp-survey .link').click(function () {
			$('#wp-rp-survey').fadeOut();
			if (window.localStorage) {
				window.localStorage.wp_wp_survey_1 = "close";
			}
		});
	});
}(jQuery));
