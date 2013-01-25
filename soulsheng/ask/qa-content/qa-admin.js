/*
	Question2Answer (c) Gideon Greenspan

	http://www.question2answer.org/

	
	File: qa-content/qa-admin.js
	Version: See define()s at top of qa-include/qa-base.php
	Description: Javascript for admin pages to handle Ajax-triggered operations


	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	More about this license: http://www.question2answer.org/license.php
*/

var qa_recalc_running=0;

window.onbeforeunload=function(event)
{
	if (qa_recalc_running>0) {
		event=event||window.event;
		var message=qa_warning_recalc;
		event.returnValue=message;
		return message;
	}
};

function qa_recalc_click(state, elem, value, noteid)
{
	if (elem.qa_recalc_running) {
		elem.qa_recalc_stopped=true;
	
	} else {
		elem.qa_recalc_running=true;
		elem.qa_recalc_stopped=false;
		qa_recalc_running++;
		
		document.getElementById(noteid).innerHTML='';
		elem.qa_original_value=elem.value;
		if (value)
			elem.value=value;
		
		qa_recalc_update(elem, state, noteid);
	}
	
	return 