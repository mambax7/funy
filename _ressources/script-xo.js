var funy_ns = (document.layers);
var funy_ie = (document.all);
var funy_w3 = (document.getElementById && !ie);


if (document.getElementById && !ie){
  funy_navigator = 0;  
}else if (document.all){
  funy_navigator = 1;
}else if (document.layers){
  funy_navigator = 2;  
}else{
  funy_navigator = 0;  
}
	function xoLogCreateCookie(name,value,days) {
		if (days) {
			var date = new Date();
			date.setTime(date.getTime()+(days*24*60*60*1000));
			var expires = "; expires="+date.toGMTString();
		}
		else var expires = "";
		document.cookie = name+"="+value+expires+"; path=/";
	}
	function xoLogReadCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0;i < ca.length;i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return null;
	}
	function xoLogEraseCookie(name) {
		createCookie(name,"",-1);
	}
	function xoSetLoggerView( name ) {
		var log = document.getElementById( "xo-logger-output" );
		if ( !log ) return;
		var i, elt;
		for ( i=0; i!=log.childNodes.length; i++ ) {
			elt = log.childNodes[i];
			if ( elt.tagName && elt.tagName.toLowerCase() != 'script' && elt.id != "xo-logger-tabs" ) {
				elt.style.display = ( !name || elt.id == "xo-logger-" + name ) ? "block" : "none";
			}
		}
		xoLogCreateCookie( 'XOLOGGERVIEW', name, 1 );
	}
	xoSetLoggerView( xoLogReadCookie( 'XOLOGGERVIEW' ) );
