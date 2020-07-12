if (document.cookie.indexOf('mi-ak14')<=-1)
	{
	document.cookie='test_cook=oui;path=/';
	if (document.cookie.indexOf('test_cook')<=-1){window.location.replace('http://www.ak14.net/fr/cookie.php?url=' + escape(window.location));}
	else {ouinon=confirm("ATTENTION : SITE INTERDIT AUX MINEURS ! !\n"+"\n"+"Le contenu de ce site ainsi que les contenus vers lesquels pointent les liens de ce site sont interdits aux enfants. Ils peuvent choquer certaines sensibilit\351s\n"+"\n"+"Pour acc\351der \340 ce site cliquez sur OK\n"+"\n"+"SI VOUS ETES MINEUR, CLIQUEZ SUR ANNULER.");}
		if (ouinon==false)
			{
			if (history.length>1) { history.go(-1); }
			else { window.location.href = 'http://www.ak14.net/fr/recherche/'; }
			}
		else {document.cookie='mi-ak14=ok;';}
	}