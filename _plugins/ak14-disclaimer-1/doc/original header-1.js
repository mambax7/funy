alert ("")
if (document.cookie.indexOf('ak14')<=-1 | true)
	{
	document.cookie='test_cook=oui;path=/';
	if (document.cookie.indexOf('test_cook')<=-1){
    window.location.replace('http://www.ak14.net/fr/cookie.php?url=' + escape(window.location));
  }
	else {
		function visite()
			{
			document.cookie='ak14=ok;';
			if(document.getElementById)
				document.getElementById("bloc-disclaimer").style.display='none'
			}
			document.write("<div id='bloc-disclaimer' style='text-align:left;'>");
			document.write("<div style='position:absolute;z-index:1000;width:96%;height:90%;min-height:1024px;margin-left:2%;margin-right:2%;margin-top:10px;margin-bottom:10px;border:0px red solid; background-color:#ffffff;filter:alpha(opacity=95);-moz-opacity:0.95;opacity: 0.95;text-align:center;line-height: normal ; clear: both;'>");
			document.write("</div>");
			document.write("<div style='position:absolute;z-index:1001;width:100%;text-align:center; clear: both;'>");
			document.write("<div style='width:450px;height:450px;margin-left:auto;margin-right:auto;margin-top:25px;border:4px red solid;padding:10px;background-color:#000000;font-family:Verdana,Arial,Geneva,Helvetica,sans-serif;font-size:13px;color:#FFFFFF;'>");
			document.write("<br /><img src='http://www.ak14.net/fr/images/panneau-bgnoir.png' alt='ATTENTION' />");
			document.write("<br /><span style='font-size:50px;margin:0px;font-variant:small-caps;font-weight:900;'>Attention</span>");
			document.write("<br /><strong>Site interdit aux mineurs</strong><br />");
			document.write("<span style='line-height:20px;'>Le site internet que vous vous appr&ecirc;tez &agrave; visiter est r&eacute;serv&eacute; &agrave; un public adulte et averti. Le contenu de ce site ainsi que les contenus vers lesquels pointent les liens de ce site risquent de heurter certaines sensibilit&eacute;s.</span>");
			document.write("<br /><br /><strong>Si vous &ecirc;tes mineur, cliquez sur QUITTER</strong>");
			document.write("<br /><br />");
			document.write("<a href='#' onclick='visite();return(false)' style='color:#FF0000;font-size:30px;text-decoration:underline;background:transparent;font-weight:900' title='Visiter ce site interdit aux mineurs'>VISITER</a>");
			document.write("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
			document.write("<a href='http://www.ak14.net/fr/recherche/' style='color:#FF0000;font-size:30px;text-decoration:underline;background:transparent;font-weight:900' title='Ne pas visiter ce site r&eacute;serv&eacute; aux adultes'>QUITTER</a>");
			document.write("</div><br /><a style='color:#696969;font-size:10px' href='http://www.AK14.net' target='_blank'>www.AK14.net</a>");
			document.write("</div>");
			document.write("</div>");

		}
	}

