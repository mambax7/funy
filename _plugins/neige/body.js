
//--------------------------------------------------------------
//  Original:  Altan - http://www.altan.hr/snow 
//var funy_snow_no = 15; // nombre de flocons
//var funy_snow_speed = 5; // plus le nombre est petit, plus la vitesse augmente
//var funy_snow_snowflake = "snow.gif"; // image
//---------------------------------------------------------------



var funy_snow_dx, funy_snow_xp, funy_snow_yp;    // coordinate and position variables
var funy_snow_am, funy_snow_stx, funy_snow_sty;  // amplitude and step variables
var funy_snow_doc_width = 800, funy_snow_doc_height = 600;
var funy_snow_obRoot = "funy_snow_dot";
var i=0;
var j = 0;

funy_snow_doc_width = document.body.clientWidth;
funy_snow_doc_height = document.body.clientHeight;
var funy_snow_isruning = true;

//alert ("funy_snow_doc_width = " + funy_snow_doc_width + " | funy_snow_doc_height = " + funy_snow_doc_height);
funy_snow_dx = new Array();
funy_snow_xp = new Array();
funy_snow_yp = new Array();
funy_snow_am = new Array();
funy_snow_stx = new Array();
funy_snow_sty = new Array();

//document.write("<STYLE type='text/css'>");
//document.write("	neige {border-style: none;}");
//document.write("</STYLE>");

 
funy_snow_coefHr = funy_snow_coefH / 100
funy_snow_coefVr = funy_snow_coefV / 10




//var img = funy_site + funy_folder_img + funy_snow_flake;
var img = funy_snow_flake;
//alert (img);

for (i = 0; i < funy_snow_no; ++ i) {  
    funy_snow_dx[i] = 0;                        // set coordinate variables
    funy_snow_xp[i] = Math.random()*(funy_snow_doc_width-50);  // set position variables
    funy_snow_yp[i] = Math.random()*funy_snow_doc_height;
    funy_snow_am[i] = Math.random()*funy_snow_ampH;         // set amplitude variables
    funy_snow_stx[i] = funy_snow_coefHr + Math.random()/10; // set step variables
    funy_snow_sty[i] = funy_snow_coefVr + Math.random();     // set step variables
    
    

    document.write("<div id='" + funy_snow_obRoot + i + "' style='POSITION: absolute;");
    document.write(" Z-INDEX: " + i *10 + "; VISIBILITY: visible;");
    //document.write(" TOP: 15px; LEFT: 15px;\">");
    document.write(" TOP: " + (15 +(i*20)) + "px; LEFT: " + (150 +(i*20)) + "px;\'>");    
    document.write("<img src=\"" + img + "\" border=\"0px\" ></div>");
/*
    
//    document.write("<table><tr><td>");    
//    document.write("largeur = " + funy_snow_doc_width + " | hauteur = " + funy_snow_doc_height);   
//    document.write("</td></tr></table>");     
*/
}
//alert("la");


//----------------------------------------------------------------------
function funy_snow_action() {  // IE main animation function
    //alert("snowIE");
    for (i = 0; i < funy_snow_no; i++) {  // iterate for every dot
      funy_snow_yp[i] += funy_snow_sty[i];
      if (funy_snow_yp[i] > funy_snow_doc_height-50) {
        funy_snow_xp[i] = Math.random()*(funy_snow_doc_width - funy_snow_am[i]-30);
        funy_snow_yp[i] = 0;
        funy_snow_stx[i] = funy_snow_coefHr + Math.random()/10;
        funy_snow_sty[i] = funy_snow_coefVr + Math.random();
        funy_snow_doc_width = document.body.clientWidth;
        funy_snow_doc_height = document.body.clientHeight;
//alert ("funy_snow_doc_width = " + funy_snow_doc_width + " | funy_snow_doc_height = " + funy_snow_doc_height);
      }
      funy_snow_dx[i] += funy_snow_stx[i];
      ob = document.getElementById(funy_snow_obRoot + i);
      //alert (ob.id);
      //ob.top =  funy_snow_yp[i];
      ob.style.top = funy_snow_yp[i] + "px";
      ob.style.left = funy_snow_xp[i] + funy_snow_am[i]*Math.sin(funy_snow_dx[i]) + "px";
      //ob.style.border = "none";      
      
      //alert (ob.id + "-" + ob.style.left + "-" + ob.style.top);
      
      //btn =  document.getElementById("jjd54");
      //j++;
      //btn.value = j + "-" + funy_snow_doc_height + "-" + ob.style.top ;
    }
    
    //document.write(jjd + ":");
    if (funy_snow_isruning){
      setTimeout('funy_snow_action()', funy_snow_speed);      
    }else{
      for (i = 0; i < funy_snow_no; i++) {  // iterate for every dot
        ob = document.getElementById(funy_snow_obRoot + i);        
        //alert (ob.id);  
        //ob.visible  = false;            
        ob.style.top  = "-100px";
        //ob.style.left = "-100px";
      }
    }

    
}
//----------------------------------------------------------
function funy_snow_stop(){
    //alert("funy_snow_stop");
    funy_snow_isruning = false;

}
//----------------------------------------------------------
function funy_snow_start(){

    
    if (!funy_snow_isruning){
      funy_snow_isruning = true;
      setTimeout('funy_snow_action()', funy_snow_speed);
      
    }
}

//----------------------------------------------------------
//alert ("mise en route : funy_snow_speed = " + funy_snow_speed);
funy_snow_action();

//---------------------------------------------------------


