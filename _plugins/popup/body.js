
//alert("navigateur = " + funy_navigator);
//alert ("zzzzzzzzzzzzzzzzzzzz");
var funyPP_isruning = true;
var funyPP_forcer = false;
var obName = "sponsorAdDiv";
funyPP_adCount = 0;

//funyPP_params = array();
//funyPP_params['texteHTML'] = funyPP_texteHTML;

h = 0;

funyPP_texteHTML = funy_parseBonus(funyPP_texteHTML, funyPP_pays, funyPP_url);


var funyPP = {name : obName, 
              texteHTML : funyPP_texteHTML,
              borderWidth : funyPP_borderWidth,
              bgColor : funyPP_bgColor,
              borderColorLight : funyPP_borderColorLight,
              borderColorDark : funyPP_borderColorDark};
                       

funyPP_buildDiv(obName, funyPP_texteHTML,funyPP_borderWidth,funyPP_bgColor,funyPP_borderColorLight,funyPP_borderColorDark);

//alert ("ok");


// DHTML Ad Box By Matt Gabbert at www.nolag.com
// La durée d'affichage en secondes
//funyPP_adTime=7;  
// Le nombre de fois que la boite sera affichée
//funyPP_chanceAd=2; 

//---------------------------------------------

  adDiv = document.getElementById(obName).style;
//alert ("--- " + ns + " | " + ie + " | " + w3 + " ---");
//----------------------------------------------------------------------------
function funyPP_buildDiv(obName, htmlTexte,borderWidth,bgColor,borderColorLight,borderColorDark){
  /*

  document.write("<style type='text/css'>");
  document.write("<!--");
  document.write("#" +  obName + " {position:absolute; height:1px; width:1px; top:0px; left:0px;}");
  document.write("-->");
  document.write("</style>");
  */  
  
  //document.write("<div id='" +  obName + "' style='visibility:hidden'>");
  document.write("<div id='" +  obName + "' style='align:center;"
                + "position:absolute;visibility:hidden;z-index:1000;"
                + "width:" + funyPP_width + "px;"
                //+ "background-color:#aaaaaa;"                
                //+ "border:2px red;"
                + "word-wrap: break-word;'>");

//alert (htmlTexte);
//  document.write(htmlTexte);
  document.write("<table id='tab_popup' width='80px' height='80%' " 
                 + " border='" + borderWidth + "'"
                 + " bgcolor='#" + bgColor + "'"
                 + " bordercolorlight='#" + borderColorLight + "'"
                 + " bordercolorlight='#" + borderColorDark + "'"
                 + " style='word-wrap: break-word;'><tr>"
                 + "<td align='center' width='100%' valign='middle' style='word-wrap: break-word;'>");

  document.write("<!--***** Le message de la boite ici ! *****-->");
  document.write("<!--***** Votre message sera en Html *****-->");
  document.write("<!--***** Fin de votre message *****-->");

  document.write(htmlTexte);  
  document.write("</td></tr></table>");
  /*  
  
  document.write("<div style='width:80%; height:80%; " 
                 + " border:" + borderWidth + ";"
                 + " bgcolor:'#" + bgColor + ";"
                 + " bordercolorlight:#" + borderColorLight + ";"
                 + " bordercolorlight:#" + borderColorDark + ";'"
                 + " >");
  document.write(htmlTexte);  
  document.write("</div>");
  */  
  document.write("</div>");
  
  
}

//----------------------------------------------------------------------------
function funyPP_initAd(){
var cd = new Date();

//an.setFullDay(an.setFullDay)
cName = "popup" + funyPP_name;
h = Number(getCookie(cName))+1;
//alert(Number(h));
//h=5;

 setCookie(cName,h,cd.toGMTString()); 
//alert (getCookie(cName) + "-" + funyPP_repeat +  "-" + funyPP_pays + "-" + funyPP_forcer);
if (h > funyPP_repeat & !funyPP_forcer){return;}
	
	randAd = Math.ceil(Math.random()*funyPP_chanceAd);

  adDiv.width  = funyPP_width +  "px";
  adDiv.height = funyPP_height + "px";
  
	//if(randAd==1) showAd();
  funyPP_showAd();

}

//----------------------------------------------------------------------------
function funyPP_showAd(){
if(funyPP_adCount < funyPP_adTime * 10){
  
  funyPP_adCount += 1;
  
  if (funyPP_left == 0) {
    	//documentWidth = self.innerWidth/2+window.pageXOffset-20;    
    	documentWidth = document.body.clientWidth;	
      posX = ((documentWidth - funyPP_width ) / 2) ;	
  }else{
      posX = funyPP_left;    
  }

  if (funyPP_top == 0) {
    	//documentHeight = self.innerHeight/2+window.pageYOffset-20; 
    	documentHeight = document.body.clientHeight; 
      //posY = ((documentHeight - funyPP_height) / 2);    	
      posY = ((screen.height - funyPP_height) / 2);    
  }else{
      posY = funyPP_top;    
  }

	adDiv.left = posX + "px";
  adDiv.top  = posY + "px";
  
  //funyPP_width = funyPP_width - 50;
  //adDiv.width  = funyPP_width + "px";  
  //adDiv.width  = "100px";  
  
  adDiv.visibility = "visible";  
/*

  jjd = document.getElementById("jjd54"); 
	  jjd.value = documentWidth  + " x " + documentHeight + " : " + posX + "x" + posY;  
	  //jjd.value = posX + " : " + posY;     
  if (jjd){

	  //jjd.value = documentWidth  + " x " + documentHeight;
	  
	}
*/
//alert (funyPP_adCount);
  //adDiv.width = documentWidth-300 + "px";
  //adDiv.height = documentHeight - 200 + "px";


	
	setTimeout("funyPP_showAd()",100);
  }else funyPP_closeAd();
}

//-----------------------------------------------------
function funyPP_closeAd(){
  funyPP_isruning = false;
  funyPP_forcer = false;
  adDiv.display = "none";
}

//----------------------------------------------------------
function funyPP_stop(){
      //alert("snowIE");
    funyPP_closeAd();
}
//----------------------------------------------------------
function funyPP_start(){
    funyPP_closeAd();
    
    if (!funyPP_isruning){
    //alert("funyPP_start => " + funyPP_isruning);      
      funyPP_isruning = true;
      funyPP_forcer = true;
      adDiv.display = "";
      funyPP_adCount=0;
      funyPP_showAd();
    }
}

//-----------------------------------------------------

onload=funyPP_initAd();

