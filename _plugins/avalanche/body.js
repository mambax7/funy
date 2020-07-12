
//--------------------------------------------------------------
//  Original:  Altan - http://www.altan.hr/snow 
//var funy_avalanche_no = 15; // nombre de flocons
//var funy_avalanche_speed = 5; // plus le nombre est petit, plus la vitesse augmente
//var funy_avalanche_snowflake = "snow.gif"; // image
//---------------------------------------------------------------



var funy_avalanche_dx, funy_avalanche_xp, funy_avalanche_yp;    // coordinate and position variables
var funy_avalanche_am, funy_avalanche_stx, funy_avalanche_sty;  // amplitude and step variables
var funy_avalanche_doc_width = 800, funy_avalanche_doc_height = 600;
var funy_avalanche_obRoot = "funy_avalanche_dot";
var i = 0;
var j = 0;

funy_avalanche_doc_width = document.body.clientWidth;
funy_avalanche_doc_height = document.body.clientHeight;
var funy_avalanche_isruning = true;

//alert ("funy_avalanche_doc_width = " + funy_avalanche_doc_width + " | funy_avalanche_doc_height = " + funy_avalanche_doc_height);
funy_avalanche_dx = new Array();
funy_avalanche_xp = new Array();
funy_avalanche_yp = new Array();
funy_avalanche_am = new Array();
funy_avalanche_stx = new Array();
funy_avalanche_sty = new Array();
funy_avalanche_tourniquet = new Array();
//document.write("<STYLE type='text/css'>");
//document.write("	neige {border-style: none;}");
//document.write("</STYLE>");

 
funy_avalanche_coefHr = funy_avalanche_coefH / 100
funy_avalanche_coefVr = funy_avalanche_coefV / 10



for (i = 0; i < funy_avalanche_no; ++ i) {  
    funy_avalanche_dx[i] = 0;                        // set coordinate variables
    funy_avalanche_xp[i] = Math.random()*(funy_avalanche_doc_width-50);  // set position variables
    funy_avalanche_yp[i] = Math.random()*funy_avalanche_doc_height;
    funy_avalanche_am[i] = Math.random()*funy_avalanche_ampH;         // set amplitude variables
    funy_avalanche_stx[i] = funy_avalanche_coefHr + Math.random()/10; // set step variables
    funy_avalanche_sty[i] = funy_avalanche_coefVr + Math.random();     // set step variables
    
    funy_avalanche_tourniquet[i] = 0;
    
    document.write("<div id='" + funy_avalanche_obRoot + i + "' style='POSITION: absolute;");
    document.write(" Z-INDEX: " + i *10 + "; VISIBILITY: visible;");
    //document.write(" TOP: 15px; LEFT: 15px;\">");
    document.write(" TOP: " + (15 +(i*20)) + "px; LEFT: " + (150 +(i*20)) + "px;\'>");    
    
    img = funy_site + funy_avalanche_img[funy_avalanche_rnd()];
    //alert (img);
    document.write("<img src=\"" + img + "\" border=\"0px\" ></div>");
/*
    
//    document.write("<table><tr><td>");    
//    document.write("largeur = " + funy_avalanche_doc_width + " | hauteur = " + funy_avalanche_doc_height);   
//    document.write("</td></tr></table>");     
*/
}
//alert("la");

//----------------------------------------------------------------------
function funy_avalanche_rnd() {
  
  c = funy_avalanche_img.length;  
  var index = Math.floor(Math.random()*(1000)) % c;  
  return index;
}
//----------------------------------------------------------------------
function funy_avalanche_action() {  // IE main animation function
    //document.write ("funy_avalanche_action");
    for (i = 0; i < funy_avalanche_no; i++) {  // iterate for every dot
      bChangeImg = false;
      funy_avalanche_yp[i] += funy_avalanche_sty[i];
      if (funy_avalanche_yp[i] > funy_avalanche_doc_height-50) {
        funy_avalanche_xp[i] = Math.random()*(funy_avalanche_doc_width - funy_avalanche_am[i]-30);
        funy_avalanche_yp[i] = 0;
        funy_avalanche_stx[i] = funy_avalanche_coefHr + Math.random()/10;
        funy_avalanche_sty[i] = funy_avalanche_coefVr + Math.random();
        funy_avalanche_doc_width = document.body.clientWidth;
        funy_avalanche_doc_height = document.body.clientHeight;
        
        bChangeImg = true;
//alert ("funy_avalanche_doc_width = " + funy_avalanche_doc_width + " | funy_avalanche_doc_height = " + funy_avalanche_doc_height);
      }
      funy_avalanche_dx[i] += funy_avalanche_stx[i];
      ob = document.getElementById(funy_avalanche_obRoot + i);

      //ob.top =  funy_avalanche_yp[i];
      ob.style.top = funy_avalanche_yp[i] + "px";
      ob.style.left = funy_avalanche_xp[i] + funy_avalanche_am[i]*Math.sin(funy_avalanche_dx[i]) + "px";
      //ob.style.border = "none";      
      
      //alert ("ob.src = " + ob.src);      
      
      if (funy_avalanche_tourniquet != 0 ){
        funy_avalanche_tourniquet[i] = (funy_avalanche_tourniquet[i] + 1) % funy_avalanche_tourniquet_speed;
        if (funy_avalanche_tourniquet[i] == 0 | bChangeImg){
          img = funy_site + funy_avalanche_img[funy_avalanche_rnd()];
          //img = funy_avalanche_url + funy_avalanche_img[0];      
          //ob.src =  img;     
          ob.innerHTML  =  "<img src=\"" + img + "\" border=\"0px\" >"; 
        }
        
        
      }
      //alert (ob.id + "-" + ob.style.left + "-" + ob.style.top);
      
      //btn =  document.getElementById("jjd54");
      //j++;
      //btn.value = j + "-" + funy_avalanche_doc_height + "-" + ob.style.top ;
    }
    
    //document.write(jjd + ":");
    if (funy_avalanche_isruning){
      setTimeout('funy_avalanche_action()', funy_avalanche_speed);      
    }else{
      for (i = 0; i < funy_avalanche_no; i++) {  // iterate for every dot
        ob = document.getElementById(funy_avalanche_obRoot + i);        
        //alert (ob.id);  
        //ob.visible  = false;            
        ob.style.top  = "-100px";
        //ob.style.left = "-100px";
      }
    }

    
}
//----------------------------------------------------------
function funy_avalanche_stop(){
    //alert("funy_avalanche_stop");
    funy_avalanche_isruning = false;

}
//----------------------------------------------------------
function funy_avalanche_start(){

    
    if (!funy_avalanche_isruning){
      funy_avalanche_isruning = true;
      setTimeout('funy_avalanche_action()', funy_avalanche_speed);
      
    }
}

//----------------------------------------------------------
//alert ("mise en route : funy_avalanche_speed = " + funy_avalanche_speed);
funy_avalanche_action();

//---------------------------------------------------------


