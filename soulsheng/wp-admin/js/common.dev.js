var showNotice, adminMenu, columns, validateForm, screenMeta;
(function($){
// Removed in 3.3.
// (perhaps) needed for back-compat
adminMenu = {
	init : function() {},
	fold : function() {},
	restoreMenuState : function() {},
	toggle : function() {},
	favorites : function() {}
};

// show/hide/save table columns
columns = {
	init : function() {
		var that = this;
		$('.hide-column-tog', '#adv-settings').click( function() {
			var $t = $(this), column = $t.val();
			if ( $t.prop('checked') )
				that.checked(column);
			else
				that.unchecked(column);

			columns.saveManageColumnsState();
		});
	},

	saveManageColumnsState : function() {
		var hidden = this.hidden();
		$.post(ajaxurl, {
			action: 'hidden-columns',
			hidden: hidden,
			screenoptionnonce: $('#screenoptionnonce').val(),
			page: pagenow
		});
	},

	checked : function(column) {
		$('.column-' + column).show();
		this.colSpanChange(+1);
	},

	unchecked : function(column) {
		$('.column-' + column).hide();
		this.colSpanChange(-1);
	},

	hidden : function() {
		return $('.manage-column').filter(':hidden').map(function() { return this.id; }).get().join(',');
	},

	useCheckboxesForHidden : function() {
		this.hidden = function(){
			return $('.hide-column-tog').not(':checked').map(function() {
				var id = this.id;
				return id.substring( id, id.length - 5 );
			}).get().join(',');
		};
	},

	colSpanChange : function(diff) {
		var $t = $('table').find('.colspanchange'), n;
		if ( !$t.length )
			return;
		n = parseInt( $t.attr('colspan'), 10 ) + diff;
		$t.attr('colspan', n.toString());
	}
}

$(document).ready(function(){columns.init();});

validateForm = function( form ) {
	return !$( form ).find('.form-required').filter( function() { return $('input:visible', this).val() == ''; } ).addClass( 'form-invalid' ).find('input:visible').change( function() { $(this).closest('.form-invalid').removeClass( 'form-invalid' ); } ).size();
}

// stub for doing better warnings
showNotice = {
	warn : function() {
		var msg = commonL10n.warnDelete || '';
		if ( confirm(msg) ) {
			return true;
		}

		return false;
	},

	note : function(text) {
		alert(text);
	}
};

screenMeta = {
	element: null, // #screen-meta
	toggles: null, // .screen-meta-toggle
	page:    null, // #wpcontent

	init: function() {
		this.element = $('#screen-meta');
		this.toggles = $('.screen-meta-toggle a');
		this.page    = $('#wpcontent');

		this.toggles.click( this.toggleEvent );
	},

	toggleEvent: function( e ) {
		var panel = $( this.href.replace(/.+#/, '#') );
		e.preventDefault();

		if ( !panel.length )
			return;

		if ( panel.is(':visible') )
			screenMeta.close( panel, $(this) );
		else
			screenMeta.open( panel, $(this) );
	},

	open: function( panel, link ) {

		$('.screen-meta-toggle').not( link.parent() ).css('visibility', 'hidden');

		panel.parent().show();
		panel.slideDown( 'fast', function() {
			link.addClass('screen-meta-active');
		});
	},

	close: function( panel, link ) {
		panel.slideUp( 'fast', function() {
			link.removeClass('screen-meta-active');
			$('.screen-meta-toggle').css('visibility', '');
			panel.parent().hide();
		});
	}
};

/**
 * Help tabs.
 */
$('.contextual-help-tabs').delegate('a', 'click focus', function(e) {
	var link = $(this),
		panel;

	e.preventDefault();

	// Don't do anything if the click is for the tab already showing.
	if ( link.is('.active a') )
		return false;

	// Links
	$('.contextual-help-tabs .active').removeClass('active');
	link.parent('li').addClass('active');

	panel = $( link.attr('href') );

	// Panels
	$('.help-tab-content').not( panel ).removeClass('active').hide();
	panel.addClass('active').show();
});

$(document).ready( function() {
	var lastClicked = false, checks, first, last, checked, menu = $('#adminmenu'),
		pageInput = $('input.current-page'), currentPage = pageInput.val(), refresh;

	// admin menu
	refresh = function(i, el){ // force the browser to refresh the tabbing index
		var node = $(el), tab = node.attr('tabindex');
		if ( tab )
			node.attr('tabindex', '0').attr('tabindex', tab);
	};

	$('#collapse-menu', menu).click(f