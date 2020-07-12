

//alert("ooooooooooooooooooooo");

var funy_ns = (document.layers);
var funy_ie = (document.all);
var funy_w3 = (document.getElementById && !funy_ie);


var funy_nav_unknow  = -1;
var funy_nav_w3  = 0;
var funy_nav_ie  = 1;
var funy_nav_ns4 = 2;


funy_nav = funy_getNavigateur();
//alert("funy_nav = " + funy_nav);

/*
exemple de switch pour me faciliter le boulot

  switch (funy_nav){
    case funy_nav_w3:
      
      break;
    case funy_nav_ie:
      
      break;
    case funy_nav_ns4:
      
      break;
    default:
      
      break;
  }

*/
//-----------------------------------------------
//recherche le navigateur
function funy_getNavigateur(){
  
  if (document.getElementById && !document.all) {
    lfuny_nav = funy_nav_w3;
  }else if(document.all) {
    lfuny_nav = funy_nav_ie;  
  }else if (document.layers) {
    lfuny_nav = funy_nav_ns4;  
  }else{
    lfuny_nav = funy_nav_unknow;  
  }
  
  return  lfuny_nav;
}

//-------------------------------------------------------------
// Cette fonction est un petit programme qui extrait la valeur du cookie
function getCookie(byname){
  byname = byname + "=";
  nlen   = byname.length;
  fromN  = document.cookie.indexOf(byname)+0;
  
  if((fromN) != -1) {
    fromN += nlen; 
    toN = document.cookie.indexOf(";",fromN)+0;
    if(toN == -1){
        toN=document.cookie.length;
    } 
    return unescape(document.cookie.substring(fromN,toN));
  }
  return null;
}
//-------------------------------------------------------------
// Cette fonction écrit le cookie
function setCookie(name,value,time) {
  exp = new Date();
  if((name==null)||(value==null)) return false; 
  if(time==null) time=365*86400000; 
  exp.setTime(exp.getTime()+time);
  //alert("expires="+exp.toGMTString());
  document.cookie = escape(name)+"="+escape(value)+"; " + "expires="+exp.toGMTString();
return true;
} 

//-------------------------------------------------------------
// Cette fonction detruit le cookie
function removeCookie(name) {
  //alert(name);
  //setCookie(name,"","Fri, 02 Jan 1970 00:00:00 GMT");
  value="";
  document.cookie = escape(name)+"="+escape(value)+"; " + "expires=Fri, 02 Jan 1970 00:00:00 GMT";
return true;
} 

//-----------------------------------------------------------------
// Cette fonction regarde dans le cookie la valeur du compteur d'accès
function checkAccess(){
  today=new Date();
  countvalue = getCookie("counter");
  if((countvalue == null)||(countvalue=="")) 
  {countvalue = "0";
  }
  countvalue = parseInt(countvalue)+1;
  setCookie("counter",countvalue);
}



  checkAccess();
  count = parseInt(countvalue);
 /*  
  if(count==1)
    {s="Ceci est votre première visite.";} 
  else
    {s="Ceci est votre "+count+" ème visite.";}
  document.writeln(s);
 */


//----------------------------------------------------------
function funy_transformEntites(sLine){
//var z1 = "&nbsp;=&iexcl;=&cent;";
var z1 = "&nbsp;=&iexcl;=&cent;=&pound;=&curren;=&yen;=&brvbar;=&sect;=&uml;=&copy;=&ordf;=&laquo;=&not;=&shy;=&reg;=&macr;=&deg;=&plusmn;=&sup2;=&sup3;=&acute;=&micro;=&para;=&middot;=&cedil;=&sup1;=&ordm;=&raquo;=&frac14;=&frac12;=&frac34;=&iquest;=&Agrave;=&Aacute;=&Acirc;=&Atilde;=&Auml;=&Aring;=&AElig;=&Ccedil;=&Egrave;=&Eacute;=&Ecirc;=&Euml;=&Igrave;=&Iacute;=&Icirc;=&Iuml;=&ETH;=&Ntilde;=&Ograve;=&Oacute;=&Ocirc;=&Otilde;=&Ouml;=&times;=&Oslash;=&Ugrave;=&Uacute;=&Ucirc;=&Uuml;=&Yacute;=&THORN;=&szlig;=&agrave;=&aacute;=&acirc;=&atilde;=&auml;=&aring;=&aelig;=&ccedil;=&egrave;=&eacute;=&ecirc;=&euml;=&igrave;=&iacute;=&icirc;=&iuml;=&eth;=&ntilde;=&ograve;=&oacute;=&ocirc;=&otilde;=&ouml;=&divide;=&oslash;=&ugrave;=&uacute;=&ucirc;=&uuml;=&yacute;=&thorn;=&yuml;=&quot;=&lt;=&gt;=&amp;";
var z2 = " ¡¢£¤¥¦§¨ªª«¬­®¯ÝÝÝÝÝÝÝ++ÝÝ++++++--+-+ÝÝ++--Ý-+----++++++++Ý_ÝÝ_aáGpSsætFTOd8fen=ñ==()ö~øúúvnýÝÿ\"<>&";
var test = "";
var i = 0;

  //var tEntite = new array();
  var tEntite = z1.split("=");
  //var tEntite = new Array("bb","zz","rr","tt");
  //alert (tEntite[0]);  
 //alert (tEntite.length);  
  
  
  for (h = 0; h < tEntite.length; h++){
    //alert (tEntite[h]+ " = " +  z2.charAt(h));
    motif = new RegExp(tEntite[h], "g") ;
    sLine = sLine.replace(motif, z2.charAt(h));

    i++;
    i = i % 10;
    if (i == 0) {
      fl = " | ";
    }else{
      fl = "\n";      
    } 
    test = test + tEntite[h] + " ---> " + z2.charAt(h) + fl;    
    
  }
  
  alert (test);
  alert (z2);
  return sLine;  
}

//---------------------------------------------------------
function funy_get_xhr() {
//var sHref = "<{$refSeeAlsoo}>";
   //alert("RequOte en cours !");   
   
var xhr_object = null; 
  //recherche du bon navigateur   
  if(window.XMLHttpRequest) // Firefox   
    {
      xhr_object = new XMLHttpRequest();      
      return xhr_object;
    }
   
 else if(window.ActiveXObject) // Internet Explorer   
    {
      xhr_object = new ActiveXObject("Microsoft.XMLHTTP");      
      return xhr_object;  
    }
   
 else { // XMLHttpRequest non supportT par le navigateur   
    alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");   
    return null;   
    }   
   
}

//-----------------------------------------------------
function funy_findProverbe(sHref){
  
  xhr_object = funy_get_xhr();
  if (xhr_object == null) return;
  //sHref = funyPP_url + "proverbe.php?op=find&pays=" + funyPP_pays;



 xhr_object.open("GET", sHref , false);   
 xhr_object.send(null);   
 
 //analyse du r‚sultat de la requete
 //c'est un chaine de valeur separe par des pipe (|)
 if(xhr_object.readyState == 4) {
      var resultat = xhr_object.responseText;
      //alert(resultat);      
      
      sDeb = "|#begin#|";
      sFin = "|#end#|";
      var h = resultat.indexOf(sDeb, 0);
      var i = resultat.indexOf(sFin, h+1);
      var j = resultat.indexOf("|", i+1);

      //recupe de la iste d'identifiant
      v = resultat.substr(h + sDeb.length, i-h-sDeb.length);
      //alert (h + "-" + i + "-" + j + "-" + sDeb.length + " => " + v);      
      t = v.split("|");     
      }  

   return t;


}
//-----------------------------------------------------
function funy_parseProverbe(sText, sPays, sUrl){

  if (sText.indexOf("[proverbe]") < 0)  return sText;
  //-----------------------------------------------------------
  
  if (sUrl == "" ) sUrl = funy_url;
    
  sHref1 = sUrl + "proverbe.php?op=find&pays=" + sPays;
  
  //sHref2 = "http://xoops.kiolo.com/modules/cyclope/proverbe.php?op=find&pays=" + funyPP_pays;
  //sHref2 = "http://localhost/modules/cyclope/proverbe.php?op=find&pays=" + funyPP_pays;
  //alert(sHref1);  
  //t = funyPP_findProverbe(funyPP_url + "proverbe.php?op=find&pays=" + funyPP_pays);
  //  alert(sHref1 + "\n" + sHref2);  
  
  t = funy_findProverbe(sHref1);  
  
  //funyPP_texteHTML = t[3];
  sText = sText.replace("[proverbe]",t[3]);
  sText = sText.replace("[auteur]",t[2]);
  sText = sText.replace("[categorie]",t[1]);
  sText = sText.replace("[pays]",t[0]);
  sText = sText.replace(/&nbsp;/g, " ");
  
  //sText = funy_transformEntites(sText);
  //alert(sText);
  return sText;
    
    
  
}
//-----------------------------------------------------
function funy_parseBonus(sText, sUrl){
//ex:  [toto:proverbe:proverbe.php?pays=indien&categorie=&lineSize=60]
  if (sUrl == "" ) sUrl = funy_url;
  
  var motif =  /\[(\w+?)\:(.+?):(.+?)\]/igm;
  
  h = 0;
  var tp = new Array();

  while (h<12 & (resultat = motif.exec(sText)) != null){
    tp[h] = resultat;
 /*
    alert("correspndance : " + resultat.length + " => " + resultat[2] 
        + "\n  a la position " + resultat.index
        + " lastIndex = " + motif.lastIndex);
 */ 
    h++;   
  }
  //---------------------------------------------------------
  for (h = 0; h < tp.length; h++){  
  
    switch(tp[h][2]){
      case "proverbe":
        sText = funy_parseProverbe2(sText, tp[h], sUrl);         
        break;
    }
  
  


  }
  
  

  return sText;
    
    
  
}
//-----------------------------------------------------
function funy_parseProverbe2(sText, tp, sUrl){
  
  //for (h = 0; h < 1; h++){
    //alert ("compteur : " + h);
    sHref1 = sUrl + tp[3];  
    sHref1 = sHref1.replace(/&amp;/g, "&");
    //alert(sHref1);    
    
    switch(tp[1]){
      case "proverbe":
        alert ("ok");
        break;
    }
    t = funy_findProverbe(sHref1);   
    sText = sText.replace(tp[0], t[3]);    
    //alert("replace : " + tp[0]);    
    
    //alert("par : " + t[3]); 
    //alert("correspondance : " + tp.length + " => " + tp[0]);
    //alert("replace : " + tp[1] + ".pays");    
    //alert("par : " + t[0]); 
    
    sText = sText.replace("[" + tp[1] + ".pays"       + "]" ,  t[0]);
    sText = sText.replace("[" + tp[1] + ".categorie"  + "]" ,  t[1]);
    sText = sText.replace("[" + tp[1] + ".auteur"     + "]" ,  t[2]);
    sText = sText.replace("[" + tp[1] + ".texte"      + "]" ,  t[3]);
    sText = sText.replace("[" + tp[1] + ".idProverbe" + "]" ,  t[4]);    

  return sText;
  
}
//-----------------------------------------------------
function getNextChar(sExpression, i){
	
    sLettre = sExpression.substring(i, i+1);  
    if (sLettre == "&"){
      j = sExpression.indexOf(";", i);
      if (j > 0){
        sLettre = sExpression.substring(i, j+1);        
      } 
    }
    
    return sLettre;
}

/*********************************************************************
Récupère la position réelle d'un objet dans la page (en tenant compte de tous ses parents)
IN 	: Obj => Javascript Object ; Prop => Offset voulu (offsetTop,offsetLeft,offsetBottom,offsetRight)
OUT	: Numérique => position réelle d'un objet sur la page.
 *********************************************************************/
function funy_getDomOffset( Obj, Prop ) {
	var iVal = 0;
	while (Obj && Obj.tagName != 'BODY') {
		eval('iVal += Obj.' + Prop + ';');
		Obj = Obj.offsetParent;
	}
	return iVal;
}





