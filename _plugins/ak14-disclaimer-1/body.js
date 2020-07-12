//alert ("")

funy_cName = "ak14";  
if (document.cookie.indexOf(funy_cName)<=-1 | false)
	{
	document.cookie='test_cook=oui;path=/';
	if (document.cookie.indexOf('test_cook')<=-1){
    window.location.replace('http://www.ak14.net/fr/cookie.php?url=' + escape(window.location));
  }
	else {
		function visite()
			{
			document.cookie = funy_cName + '=ok;';
			if(document.getElementById)
				document.getElementById("bloc-disclaimer").style.display='none'
			}
			document.write("<div id='bloc-disclaimer' style='text-align:left;'>");
			
			lw = 100 - funy_ak14d1_msk_margin_left - funy_ak14d1_msk_margin_right;
      document.write("<div style='position:absolute;z-index:1000;"
                   + "width:" + lw + "%;height:90%;"
                   + "min-height:" + 20048 + "px;"
                   + "margin-left:" + funy_ak14d1_msk_margin_left + "%;"
                   + "margin-right:" + funy_ak14d1_msk_margin_right + "%;"
                   + "margin-top:" + funy_ak14d1_msk_margin_top + "px;"
                   + "margin-bottom:" + funy_ak14d1_msk_margin_bottom + "px;" 
                   + "border:0px red solid;"
                   + " background-color:#" + funy_ak14d1_opacity_Color + ";"
                   + "filter:alpha(opacity=" + funy_ak14d1_msk_opacity + ");"
                   + "-moz-opacity:0.95;opacity: " + funy_ak14d1_msk_opacity/100 + ";"
                   + "text-align:center;"
                   + "line-height: normal ; clear: both;'>");
			document.write("</div>");
			
      document.write("<div style='position:absolute;z-index:1001;width:100%;text-align:center; clear: both;'>");
			document.write("<div style='width:" + funy_ak14d1_box_width + "px;"
                   + "height:" + funy_ak14d1_box_height + "px;"
                   + "margin-left:auto;margin-right:auto;"
                   + "margin-top:" + funy_ak14d1_box_top + "px;"
                   + "border:4px red solid;padding:10px;"
                   + "background-color:#000000;"
                   + "font-family:Verdana,Arial,Geneva,Helvetica,sans-serif;font-size:13px;"
                   + "color:#FFFFFF;'>");
			
      
      document.write("<br /><img src='" + funy_ak14d1_icone + "' alt='ATTENTION' /><br />");
			
      
      document.write(funy_ak14d1_disclaimer);
			
			document.write("<br /><br />");
			document.write("<a href='#' onclick='visite();return(false)' style='color:#FF0000;font-size:30px;text-decoration:underline;background:transparent;font-weight:900' title='" + funy_ak14d1_ok_title + "'>" + funy_ak14d1_ok + "</a>");
			document.write("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
			document.write("<a href='http://www.ak14.net/fr/recherche/' style='color:#FF0000;font-size:30px;text-decoration:underline;background:transparent;font-weight:900' title='" + funy_ak14d1_cancel_title + "'>" + funy_ak14d1_cancel + "</a></div>");
			//----------------------------------------------------------
      funy_ak14d1_box_top=8;
      funy_ak14d1_box_height = 12;
      document.write("<div style='width:" + funy_ak14d1_box_width + "px;"
                   + "height:" + funy_ak14d1_box_height + "px;"
                   + "margin-left:auto;margin-right:auto;"
                   + "margin-top:" + funy_ak14d1_box_top + "px;"
                   + "border:4px red solid;padding:10px;"
                   + "background-color:#000000;"
                   + "font-family:Verdana,Arial,Geneva,Helvetica,sans-serif;font-size:13px;"
                   + "color:#FFFFFF;'>");
			
      document.write("<a style='color:#696969;font-size:10px' href='"
                    + funy_ak14d1_url +"' target='_blank'>" + funy_ak14d1_url + "</a>");
			document.write("</div>");                    
      //-----------------------------------------              
                    
			document.write("</div>");
			document.write("</div>");

		}
	}


//----------------------------------------------
function funy_ak14d1_restart(){
  
  removeCookie(funy_cName);
  location.reload();
  //alert ("funy_ak14d1_restart");
}
