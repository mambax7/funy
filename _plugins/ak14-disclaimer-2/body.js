//alert ("")

funy_cName = "ak14-stat";

if (document.cookie.indexOf(funy_cName)<= -1 )
	{
	document.cookie='test_cook=oui;path=/';
	if (document.cookie.indexOf('test_cook')<=-1){
      window.location.replace('' + funy_ak14d2_url + '/fr/cookie.php?url=' + escape(window.location));
  }
  else {
    ouinon=confirm(funy_ak14d2_disclaimer);
  }
  	if (ouinon==false)
			{
			window.location.replace(funy_ak14d2_url + '/fr/recherche/');
			}
		else {document.cookie = funy_cName + '=ok;';}
	}

//----------------------------------------------
function funy_ak14d2_restart(){

   //--------------------------------------------
 
  removeCookie('test_cook');	
  removeCookie(funy_cName);
  location.reload();
  //alert ("funy_ak14_restart" + "-" + funy_cName);

}
