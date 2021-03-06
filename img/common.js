// $Id: common.js,v 1.2 2003/04/12 22:31:06 lukasz Exp $

document.onkeyup = CheckKeyPress;

var keyPressF2 = function() { };
var keyPressF4 = function() { };
var keyPressF8 = function() { };
var keyPressF9 = function() { };
var keyPressESC = function() { };
var keyPressPageUp = function() { };
var keyPressPageDown = function() { };
var keyPressHome = function() { };
var keyPressEnd = function() { };
var keyPressLeft = function() { };
var keyPressUp = function() { };
var keyPressRight = function() { };
var keyPressDown = function() { };
var keyPressInsert = function() { };
var keyPressDelete = function() { };
var keyPressEnter = function() { };
var keyPressTab = function() { };

function CheckKeyPress(e) 
{
    var KeyID=(window.event) ? event.keyCode : e.keyCode;
    
    if (KeyID == 113) { keyPressF2(); }
    if (KeyID == 115) { keyPressF4(); }
    if (KeyID == 119) { keyPressF8(); }
    if (KeyID == 120) { keyPressF9(); }
    if (KeyID == 27) { keyPressESC(); }
    if (KeyID == 33) { keyPressPageUp(); }
    if (KeyID == 34) { keyPressPageDown(); }
    if (KeyID == 36) { keyPressHome(); }
    if (KeyID == 35) { keyPressEnd(); }
    if (KeyID == 37) { keyPressLeft(); }
    if (KeyID == 38) { keyPressUp(); }
    if (KeyID == 39) { keyPressRight(); }
    if (KeyID == 40) { keyPressDown(); }
    if (KeyID == 45) { keyPressInsert(); }
    if (KeyID == 46) { keyPressDelete(); }
    if (KeyID == 13) { keyPressEnter(); }
    if (KeyID == 9) { keyPressTab(); }
}

function confirmLink(theLink, message)
{
	var is_confirmed = confirm(message);

	if (is_confirmed) {
		theLink.href += '&is_sure=1';
	}
	return is_confirmed;
}

function confirmForm(formField, message, okValue)
{
	var is_confirmed = confirm(message);
	if (is_confirmed) {
		formField.value = okValue;
	}
	return is_confirmed;
}

function addClass(theElem, theClass)
{
	theElem.className += ' ' + theClass;
}

function addClassId(idElem, theClass)
{
	document.getElementById(idElem).className += ' ' + theClass;
}

function removeClass(theElem, theClass)
{
	regexp = new RegExp('\\s*' + theClass, 'i');
	var str = theElem.className;
	theElem.className = str.replace(regexp, '');
}

function removeClassId(idElem, theClass)
{
	regexp = new RegExp('\\s*' + theClass, 'i');
	var str = document.getElementById(idElem).className;
	document.getElementById(idElem).className = str.replace(regexp, '');
}

// LMS: function to autoresize iframe and parent div container (overlib)
function autoiframe_setsize(id, width, height)
{
	var doc = window.parent ? parent.document : document,
		frame = doc.getElementById(id);

    if (!frame)
        return;

	if (width) {
		frame.style.width = width + 'px';
		frame.parentNode.style.width = width + 'px';
	}
	else
	    width = frame.offsetWidth;

	if (height) {
		frame.style.height = height + 'px';
		frame.parentNode.style.height = height + 'px';
	}
	else
	    height = frame.offsetHeight;

    // move frame if it doesn't fit the screen
    var pos = get_object_pos(frame),
        parent_frame = doc.getElementById('overDiv'),
        dw = doc.body.offsetWidth,
        dh = doc.body.offsetWidth;

    if (width < dw && pos.x + width > dw - 15) {
        parent_frame.style.left = (dw - width - 15) + 'px';
    }
    if (height < dh && pos.y + height > dh - 15) {
        parent_frame.style.top = (dh - height - 15) + 'px';
    }
}

function openSelectWindow(theURL, winName, myWidth, myHeight, isCenter, formfield)
{
	targetfield = formfield;
	popup(theURL, 1, 1, 30, 15);
	autoiframe_setsize('autoiframe', myWidth, myHeight);

	return false;
}

function openSelectWindow2(theURL, winName, myWidth, myHeight, isCenter, formfield1, formfield2)
{
	targetfield1 = formfield1;
	targetfield2 = formfield2;
	popup(theURL, 1, 1, 30, 15);
	autoiframe_setsize('autoiframe', myWidth, myHeight);

	return false;
}

function ipchoosewin(formfield1, formfield2, netid, device)
{
	var url = '?m=chooseip' +  (netid ? '&netid=' + netid : '') + (device ? '&device=' + device : '');
	return openSelectWindow2(url, 'chooseip', 350, 380, 'true', formfield1, formfield2);
}

function ipchoosewinpub(formfield1, formfield2, netid, device)
{
	var url = '?m=chooseippub' +  (netid ? '&netid=' + netid : '') + (device ? '&device=' + device : '');
	return openSelectWindow2(url, 'chooseip', 350, 380, 'true', formfield1, formfield2);
}


function macchoosewin(formfield)
{
	return openSelectWindow('?m=choosemac','choosemac',290,380,'true',formfield);
}

function customerchoosewin(formfield)
{
	return openSelectWindow('?m=choosecustomer','choosecustomer',450,250,'true',formfield);
}

function customersearchchoosewin(formfieldid,formfieldname)
{
	return openSelectWindow2('?m=choosecustomersearch','choosecustomersearch',450,250,'true',formfieldid,formfieldname);
}

function contractorchoosewin(formfield,formfield2)
{
	return openSelectWindow2('?m=choosecontractor','choosecontractor',450,250,'true',formfield,formfield2);
}

function nodechoosewin(formfield, customerid)
{
	return openSelectWindow('?m=choosenode&id='+customerid,'choosenode',350,200,'true',formfield);
}

function locationchoosewin(varname, formname, city, street)
{
	return openSelectWindow('?m=chooselocation&name='+varname+'&form='+formname+'&city='+city+'&street='+street,'chooselocation',350,200,'true');
}

function invoiceconvertwin(varname, docid, parent)
{
	return openSelectWindow('?m=invoiceconvert&name=' + varname + '&parent=' + parent + '&docid=' + docid,'invoiceconvert',350,300,'true');
}

function gpscoordschoosewin(formfield1, formfield2)
{
	return openSelectWindow2('?m=choosegpscoords', 'choosegpscoords', 450, 300, 'true', formfield1, formfield2);
}

function netlinkpropertieschoosewin(id, devid, isnetlink)
{
	return openSelectWindow('?m=netlinkproperties&id=' + id + '&devid=' + devid + '&isnetlink=' + (isnetlink ? 1 : 0),
		'netlinkproperties', 350, 100, 'true');
}

function sendvalue(targetfield, value)
{
	targetfield.value = value;
	// close popup
	window.parent.parent.popclick();
	targetfield.focus();
}

function sendvalue2(targetfield1, value1, targetfield2, value2)
{
	targetfield1.value = value1;
	targetfield2.value = value2;
	// close popup
	window.parent.parent.popclick();
	targetfield1.focus();
}

function showOrHide(elementslist)
{
	var elements_array = elementslist.split(" ");
	var part_num = 0;
	while (part_num < elements_array.length)
	{
		var elementid = elements_array[part_num];
		if(document.getElementById(elementid).style.display != 'none')
		{
			document.getElementById(elementid).style.display = 'none';
			setCookie(elementid, '0');
		}
		else
		{
			document.getElementById(elementid).style.display = '';
			setCookie(elementid, '1');
		}
		part_num += 1;
	}
}

function ShowOrHideBox(elementslist)
{
	var elements_array = elementslist.split(" ");
	var part_num = 0;
	while (part_num < elements_array.length)
	{
		var elementid = elements_array[part_num];
		if(document.getElementById(elementid).style.display != 'none')
		{
			document.getElementById(elementid).style.display = 'none';
//			setCookie(elementid, '0');
			sendPOST('?m=profiles','action=setprofile&variable='+elementid+'&content=0');
		}
		else
		{
			document.getElementById(elementid).style.display = '';
//			setCookie(elementid, '1');
			sendPOST('?m=profiles','action=setprofile&variable='+elementid+'&content=1');
		}
		part_num += 1;
	}
}

timer_now = new Date();
timer_start = timer_now.getTime();

function getSeconds()
{
	var timer_now2 = new Date();
	return Math.round((timer_now2.getTime() - timer_start)/1000);
}

function getCookie(name)
{
	var cookies = document.cookie.split(';');
	for (var i=0; i<cookies.length; i++) {
		var a = cookies[i].split('=');
		if (a.length == 2) {
			a[0] = a[0].trim();
			a[1] = a[1].trim();
			if (a[0] == name)
				return unescape(a[1]);
		}
	}
	return null;
}

function setCookie(name, value, permanent)
{
	var cookie = name + '=' + escape(value);
	if (permanent != null) {
		var d = new Date();
		d.setTime(d.getTime() + 365 * 24 * 3600 * 1000);
		cookie += '; expires=' + d.toUTCString();
	}
	document.cookie = cookie;
}

if (typeof String.prototype.trim == 'undefined')
{
	String.prototype.trim = function()
	{
        	var s = this.replace(/^\s*/, '');
	        return s.replace(/\s*$/, '');
	};
}

function inArray(a, v)
{
    for (var i in a) {
        if (a[i] == v) {
            return true;
        }
    }
    return false;
}

function checkElement(id)
{
	var elem = document.getElementById(id);

	if (!elem) {
		var list = document.getElementsByName(id);
		if (list.length) {
			elem = list[0];
		}
	}

	if (elem) {
		elem.checked = !elem.checked;
		if (typeof elem.onchange === 'function')
			elem.onchange();
	}
}

function CheckAll(form, elem, excl)
{
    var i, len, n, e, f,
        form = document.forms[form] ? document.forms[form] : document.getElementById(form),
        inputs = form.getElementsByTagName('INPUT');

    for (i=0, len=inputs.length; i<len; i++) {
        e = inputs[i];

        if (e.type != 'checkbox' || e == elem)
            continue;

        if (excl && excl.length) {
            f = 0;
            for (n=0; n<excl.length; n++)
                if (e.name == excl[n])
                    f = 1;
            if (f)
                continue;
        }

        e.checked = elem.checked;
    }
}

function get_object_pos(obj)
{
	// get old element size/position
	var x = (document.layers) ? obj.x : obj.offsetLeft;
	var y = (document.layers) ? obj.y : obj.offsetTop;

	// calculate element position
	var elm = obj.offsetParent;
	while (elm) {
	    x += elm.offsetLeft;
		y += elm.offsetTop;
		elm = elm.offsetParent;
	}

	return {x:x, y:y};
}

function multiselect(formid, elemid, def, selected)
{
	var old_element = document.getElementById(elemid);
	var form = document.getElementById(formid);

	if (!old_element || !form) {
		return;
	}

	var selected_elements = null;
	if (selected)
		selected_elements = '|' + selected.join('|') + '|';

	// create new multiselect div
	var new_element = document.createElement('DIV');
	new_element.className = 'multiselect';
	new_element.id = elemid;
	new_element.innerHTML = def && !selected ? def : '';

	// save (overlib) popups
	new_element.onmouseover = old_element.onmouseover;
	new_element.onmouseout = old_element.onmouseout;

	// replace select with multiselect
	old_element.parentNode.replaceChild(new_element, old_element);

	// create multiselect list div (hidden)
	var div = document.createElement('DIV');
	var iframe = document.createElement('IFRAME');
	var ul = document.createElement('UL');

	div.className = 'multiselectlayer';
	div.id = elemid + '-layer';
	div.style.display = 'none';

	for(var i=0, len=old_element.options.length; i<len; i++)
	{
		var li = document.createElement('LI');
		var box = document.createElement('INPUT');
		var span = document.createElement('SPAN');

		box.type = 'checkbox';
		box.name = old_element.name;
		box.value = old_element.options[i].value;
		if (selected_elements && selected_elements.indexOf('|' + old_element.options[i].value + '|') != -1) {
			box.checked = true;
			addClass(li, 'selected');
		}

		span.innerHTML = old_element.options[i].text;

		// add some mouse/key events handlers
		li.onclick = function() {
			var box = this.childNodes[0];
			var selected = this.className.match(/selected/);
			box.checked = selected ? false : true;

			if(selected) {
				removeClass(this, 'selected');
				if(def) {
					var xlen = this.parentNode.childNodes.length;
					for(var x=0; x<xlen; x++) {
						if(this.parentNode.childNodes[x].className.match(/selected/)) {
							break;
						}
					}
					if(x==xlen) {
						new_element.innerHTML = def;
					}
				}
			} else {
				addClass(this, 'selected');
				new_element.innerHTML = '';
			}
		};
		// TODO: keyboard events

		// add elements
		li.appendChild(box);
		li.appendChild(span);
		ul.appendChild(li);
	}

	// add list
	div.appendChild(iframe);
	div.appendChild(ul);
	form.appendChild(div);

	// add some mouse/key event handlers
	new_element.onclick = function() {
		var list = document.getElementById(this.id + '-layer');

		if(list.style.display == 'none') {
			var pos = get_object_pos(this);

			list.style.left = pos.x + 'px';
			list.style.top = this.offsetHeight + pos.y + 'px';
			list.style.display = 'block';
			// IE max-height hack
			if(document.all && list.childNodes[1].offsetHeight > 200) {
				list.childNodes[1].style.height = '200px';
			}
		} else {
			list.style.display = 'none';
		}
	};
	// TODO: keyboard events
}

var lms_login_timeout_value,
    lms_login_timeout,
    lms_sticky_popup;

function start_login_timeout(sec)
{
    if (!sec) sec = 600;
    lms_login_timeout_value = sec;
    lms_login_timeout = window.setTimeout('window.location.reload(true)', (sec + 5) * 1000);
}

function reset_login_timeout()
{
    window.clearTimeout(lms_login_timeout);
    start_login_timeout(lms_login_timeout_value);
}

// Display overlib popup
function popup(content, frame, sticky, offset_x, offset_y)
{
	if (lms_sticky_popup)
		return;

	if (frame)
		content = '<iframe id="autoiframe" width=100 height=10 frameborder=0 scrolling=no '
			+'src="'+content+'&popup=1"></iframe>';

	if (!offset_x) offset_x = 15;
	if (!offset_y) offset_y = 15;

	if (sticky) {
		// let's check how people will react for this small change ;-)
		//overlib(content, HAUTO, VAUTO, OFFSETX, offset_x, OFFSETY, offset_y, STICKY, MOUSEOFF);
		overlib(content, HAUTO, VAUTO, OFFSETX, offset_x, OFFSETY, offset_y, STICKY);
		var body = document.getElementsByTagName('BODY')[0];
		body.onmousedown = function () { popclick(); };
		lms_sticky_popup = 1;
	}
	else {
		 overlib(content, HAUTO, VAUTO, OFFSETX, offset_x, OFFSETY, offset_y);
	}
}

function popup_center(content,widths,heights,scroll)
{
	if (!scroll) scroll=0;
	
	if (scroll == 1) { scroll='yes'; } else { scroll='no'; }
	
	var d = document;
	if ( typeof window.innerWidth != 'undefined' )
	{
		var winW = window.innerWidth;
		var winH = window.innerHeight;
	}
	else
	{
		if (d.documentElement && typeof d.documentElement.clientWidth != 'undefined' && d.documentElement.clientWidth != 0)
		{
			var winW = d.documentElement.clientWidth;
			var winH = d.documentElement.clientHeight;
		}
		else
		{
			if (d.body && typeof d.body.clientWidth != 'undefined')
			{
				var winW = d.body.clientWidth;
				var winH = d.body.clientHeight;
			}
		}
	}
	
	var fix_x = ((winW - widths) / 2);
	var fix_y = ((winH - heights) / 3);
	
	content = '<iframe width="' + widths + '" height="' + heights + '" frameborder="0" scrolling="' + scroll + '" src="'+content+'&popup=1"></iframe>';
	overlib(content,STICKY,WIDTH,widths,HEIGHT,heights,FOLLOWMOUSE,0,FIXX,fix_x,FIXY,fix_y,BGCLASS,"overlib_popup");
	
	var body = document.getElementsByTagName('BODY')[0];
	body.onmousedown = function () { popclick(); };
	lms_sticky_popup = 1;
}


function popup_scroll(content, frame, sticky, offset_x, offset_y)
{
	if (lms_sticky_popup)
		return;

	if (frame)
		content = '<iframe id="autoiframe" width=100 height=10 frameborder=0 scrolling=auto '
			+'src="'+content+'&popup=1"></iframe>';

	if (!offset_x) offset_x = 15;
	if (!offset_y) offset_y = 15;

	if (sticky) {
		// let's check how people will react for this small change ;-)
		//overlib(content, HAUTO, VAUTO, OFFSETX, offset_x, OFFSETY, offset_y, STICKY, MOUSEOFF);
		overlib(content, HAUTO, VAUTO, OFFSETX, offset_x, OFFSETY, offset_y, STICKY);
		var body = document.getElementsByTagName('BODY')[0];
		body.onmousedown = function () { popclick(); };
		lms_sticky_popup = 1;
	}
	else {
		 overlib(content, HAUTO, VAUTO, OFFSETX, offset_x, OFFSETY, offset_y);
	}
}

// Hide non-sticky popup
function pophide()
{
    if (lms_sticky_popup) {
        return;
    }

    return nd();
}

// Hide sticky popup
function popclick()
{
    lms_sticky_popup = 0;
    o3_removecounter++;
    return nd();
}

function check_teryt(locid, init)
{
    var checked = document.getElementById('teryt').checked;

    if (locid) {
        var loc = document.getElementById(locid);
        if (checked) {
            //if (!init)
            //    loc.value = '';
            loc.setAttribute('readonly', true);
        }
        else {
            loc.removeAttribute('readonly');
        }
    }

    return checked;
}

function ping_popup(ip, type)
{
	popup('?m=ping&ip=' + ip + '&type=' + (type ? type : 0), 1, 1, 30, 30);
	autoiframe_setsize('autoiframe', 480, 300);
}

function monitchart_popup(id,type)
{
	popup('?m=monitchartwin&id=' + id + '&type=' + type, 1, 1, 30, 30);
	autoiframe_setsize('autoiframe', 608,360);
}



function message_search_template(formfield1,formfield2)
{
	//return openSelectWindow2('?m=messagesearchtemplate', 'messagesearchtemplate', 600, 300, 'true', formfield,formfield2)
	popup_scroll('?m=messagesearchtemplate&idtheme=' + formfield1 + '&idmess=' + formfield2, 1, 1, 30, 30);
	autoiframe_setsize('autoiframe', 600,300);
}

function divisioninfo_popup(id)
{
	popup_scroll('?m=divisioninfowin&id=' + id, 1, 1, 30, 30);
	autoiframe_setsize('autoiframe', 450,250);
}

function help_popup(id)
{
	popup('?m=helpinfowin&key=' + id, 1, 1, 30, 30);
	autoiframe_setsize('autoiframe', 450,250);
}

function notatnik_popup()
{
	popup('?m=notatnik', 1, 1, 30, 30);
	autoiframe_setsize('autoiframe', 650,400);
}

function infocenter_popup(key)
{
	popup_scroll('?m=infocenterwin&key=' + key, 1, 1, 30, 30);
	autoiframe_setsize('autoiframe', 450,250);
}

function changeMacFormat(id)
{
	if (!id) return;
	var elem = document.getElementById(id);
	if (!elem) return;
	var curmac = elem.innerHTML;
	var macpatterns = [ /^([0-9a-f]{2}:){5}[0-9a-f]{2}$/gi, /^([0-9a-f]{2}-){5}[0-9a-f]{2}$/gi,
		/^([0-9a-f]{4}\.){2}[0-9a-f]{4}$/gi, /^[0-9a-f]{12}$/gi ];
	for (var i in macpatterns)
		if (macpatterns[i].test(curmac))
			break;
	if (i >= macpatterns.length)
		return;
	i = parseInt(i);
	switch (i) {
		case 0:
			curmac = curmac.replace(/:/g, '-');
			break;
		case 1:
			curmac = curmac.replace(/-/g, '');
			curmac = curmac.toLowerCase();
			curmac = curmac.replace(/^([0-9a-f]{4})([0-9a-f]{4})([0-9a-f]{4})$/gi, '$1.$2.$3');
			break;
		case 2:
			curmac = curmac.replace(/\./g, '');
			curmac = curmac.toUpperCase();
			break;
		case 3:
			curmac = curmac.replace(/^([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/gi, '$1:$2:$3:$4:$5:$6');
	}
	elem.innerHTML = curmac;
}

function ShowAjaxLoadingImage()
{
//    document.getElementById('id_loadajax_img').innerHTML = 
//	'<div style="width:80px;height:80px;position:fixed;top:40%;left:49%;"><img src="img/loading_ajax.gif" alt="Czekaj..."></div>';
}

function HideAjaxLoadingImage()
{
//    document.getElementById('id_loadajax_img').innerHTML = '';
}

//function ShowAjaxLoadingImage()
//{
//    document.getElementById('id_loadajax_img').src = 'img/328.gif';
//}
//
//function HideAjaxLoadingImage()
//{
//    document.getElementById('id_loadajax_img').src = 'img/empty.gif';
//}

function loadAjax(idel,strona)
{
    if (strona=='empty') {
	$("#"+idel+"").empty();
    } else {
	ShowAjaxLoadingImage();
	$.ajax({ 
		url:strona, 
		cache:false,
		success:function(html){$("#"+idel+"").empty().append(html);
		HideAjaxLoadingImage();
		}
		
	});
	
    }
}

function loadAD(idel,strona)
{
    if (strona=='empty') {
	$("#"+idel+"").empty();
    } else {
	$.ajax({ 
		url:strona, 
//		cache:false,
		success:function(html){$("#"+idel+"").empty().append(html);
		}
	});
	
    }
}

function AjaxObjectCreateGeneral() {
    var req;
    try {
	req = new XMLHttpRequest();
    }
    catch (e) {
	try {
	    req = new ActiveXObject("Msxml2.XMLHTTP");
	} 
	catch(e) {
	    try {
		req = new ActiveXObject("Microsoft.XMLHTTP");
	    } 
	    catch(e) {
		return false;
	    }
	}
    }
    return req;
}


function sendPOST(plik,dane) {
    var xml = AjaxObjectCreateGeneral();
    var wynik = null;
    if ( xml != false ) {
	xml.onreadystatechange = function() {
	    if ( xml.readyState == 4 ) {
		if ( xml.status == 200 ) {
		    wynik = xml.responseText;
		    if ( xml.responseText == "true" ) wynik = true;
		    if ( xml.responseText == "false" ) wynik = false;
		    if ( xml.responseText == "null" ) wynik = null;
		} 
		else wynik = null;
	    } 
	    else wynik = null;
	}
	xml.open('POST',plik,false);
	xml.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	xml.send(dane);
    }
    return wynik;
}

function setProfile(variable,content) {

    sendPOST('?m=profiles','action=setprofile&variable='+variable+'&content='+content);

}


function v_ipchoosewin(formfield)
{
    var url = '?m=v_chooseip';
	return openSelectWindow(url,'chooseip',350,380,'true',formfield);
}


function netdevmodelchoosewin(varname, formname, netdevmodelid, producer, model)
{
	return openSelectWindow('?m=choosenetdevmodel&name='+varname+'&form='+formname+'&netdevmodelid='+netdevmodelid+'&producer='+producer+'&model='+model,'chooselocation',350,200,'true');
}


