//alert ("funy_menuRuban_build");
var funy_menuRuban_prefixe = "funy_menuRuban_";

var funy_menuRuban_imgH = 0;
var funy_menuRuban_minH = 0;

var funy_menuRuban_fondW;    
var funy_menuRuban_fondH;

var funy_menuRuban_diametreW;    
var funy_menuRuban_diametreH;

var funy_menuRuban_absoluteX;    
var funy_menuRuban_absoluteY;

var funy_menuRuban_isMoving = false;
var funy_menuRuban_la = 0;
var funy_menuRuban_tLog = new Array;

var funy_menuRuban_angle=0;
var funy_menuRuban_timer;
var funy_menuRuban_sens = "Non";
var funy_menuRuban_secteur = funy_menuRuban_array.length / 2;
var funy_menuRuban_inclinaison = funy_menuRuban_inclinaisonEllipse * Math.PI/180;      
var funy_menuRuban_mapMiddleBande = 140; //bande du milieu    

    //-----------------------------------------   

/*********************************************************************
 
 *********************************************************************/
function funy_menuRuban_build2(){
    /*
    var obDiv = "<div style='width: 588; height: 600px; background-color: #000000;' align='right'>"
     + "<img src='" + funy_site + funy_menuRuban_imgFond + "'>"
     + "<br>Move your mouse over the pool balls"
     + "</div>";
    
    */
  
    var obDiv = "<img src='" + funy_site + funy_menuRuban_imgFond + "'>"
     + "<br>Move your mouse over the pool balls";

    var obID = document.getElementById("divMenuRuban");
    obID.innerHTML = obDiv;
     
    //document.write(obDiv);       
  
}


/*********************************************************************
 
 *********************************************************************/
function funy_menuRuban_build(){
    //var obDiv = funy_menuRuban_buildStyle();  
    var obDiv = "";    
    var obID = document.getElementById("divMenuRuban");    
  
    //alert (obDiv);
    //var obDiv = "<div id='zzzzzzzzz' style='width: 500px; height: 600px;'>\n";
    //obDiv += "<div id='divMenuRuban' style='width: 500px; height: 600px;'>\n";
    //var obDiv = "<div id='divMenuRuban' width='500px' height='300px'>\n";    
    
    //var x = obID.style.left;
    //var y = obID.style.top;    
    //alert (x + "-" + y);
    target = (funy_menuRuban_target == 1) ? "target='_blank'" : "";
    
    for (h = 0; h < funy_menuRuban_array.length; h++){
      //alert  (funy_site ) ;
      //alert  (funy_site + funy_menuRuban_array[h]['img']) ;
        obDiv += "<A href='" + funy_menuRuban_array[h]['link'] + "' " + target + ">";            
        obDiv += "<img id='" + funy_menuRuban_prefixe + h + "'";
        obDiv +=  " src='" + funy_site + funy_menuRuban_array[h]['img'] + "'";
        obDiv +=  " class='imag'";        
        obDiv +=  " alt='" + funy_menuRuban_array[h]['alt'] + "'";    
        obDiv +=  " title='" + funy_menuRuban_array[h]['title'] + "'";            
        //obDiv +=  " onclick='javascript:funy_menuRuban_redirect(this);'";        
        obDiv +=  " />\n";  
        obDiv +=  "</A>\n";              
    }

    //---------------------------------------------------------------    
    if (funy_menuRuban_imgFond=="") funy_menuRuban_imgFond = "modules/funy/_plugins/menu-ruban/images/fond-transparent.png";
    obDiv += "<img id='funy_menuRuban_Imgfond'";
    obDiv +=  " src='" + funy_site + funy_menuRuban_imgFond + "'";
    obDiv +=  " width='" + funy_menuRuban_bgW + "px' height='" + funy_menuRuban_bgH + "px'";    
    obDiv +=  " alt=''"; 
    //obDiv +=  " onmouseover='javascript:funy_menuRuban_arretDefilement();' onMouseOut='javascript:funy_menuRuban_defilement();'";           
    obDiv +=  " usemap='#MenuRuban'";    
    obDiv +=  " style='border:0; '";
    obDiv +=  " />\n";        
    
    
    var mapB = (funy_menuRuban_bgW - funy_menuRuban_mapMiddleBande ) / 2;
    
    var xa1 = 0;
    var xa2 = xa1 + mapB;
    
    var xb1 = xa2;  
    var xb2 = xb1 + funy_menuRuban_mapMiddleBande;  
    
    var xc1 = xb2;  
    var xc2 = xc1 + mapB;  
    
    switch (funy_menuRuban_modeDefilement){
      case 1:
        obDiv +=  "<map id='MenuRuban' name='MenuRuban'>\n";    
        obDiv +=  "<area  shape='rect' alt='Gauche' coords='" + xa1 + ",0," + xa2 + "," + funy_menuRuban_bgH + "' onmouseover='javascript:funy_menuRuban_defilementGauche();' onMouseOut='javascript:funy_menuRuban_arretDefilement();' href='' />\n";    
        obDiv +=  "<area  shape='rect' alt='Droite' coords='" + xb1 + ",0," + xb2 + "," + funy_menuRuban_bgH + "' onmouseover='javascript:funy_menuRuban_arretDefilement();' onMouseOut='javascript:funy_menuRuban_arretDefilement();' href='' />\n";
        obDiv +=  "<area  shape='rect' alt='Droite' coords='" + xc1 + ",0," + xc2 + "," + funy_menuRuban_bgH + "' onmouseover='javascript:funy_menuRuban_defilementDroite();' onMouseOut='javascript:funy_menuRuban_arretDefilement();' href='' />\n";        
        obDiv +=  "</map>";    
        break;      
      
      default:
        obDiv +=  "<map id='MenuRuban' name='MenuRuban'>\n";    
        obDiv +=  "<area  shape='rect' alt='Gauche' coords='" + xa1 + ",0," + xa2 + "," + funy_menuRuban_bgH + "' onmouseover='javascript:funy_menuRuban_defilementGauche();' onMouseOut='javascript:funy_menuRuban_defilementGauche();'  href='' />\n";    
        obDiv +=  "<area  shape='rect' alt='Droite' coords='" + xb1 + ",0," + xb2 + "," + funy_menuRuban_bgH + "' onmouseover='javascript:funy_menuRuban_arretDefilement();'  href='' />\n";
        obDiv +=  "<area  shape='rect' alt='Droite' coords='" + xc1 + ",0," + xc2 + "," + funy_menuRuban_bgH + "' onmouseover='javascript:funy_menuRuban_defilementDroite();' onMouseOut='javascript:funy_menuRuban_defilementDroite();'  href='' />\n";        
        obDiv +=  "</map>";    
        break;
      
    }        
/*

*/
/*
    obDiv +=  "<map id='MenuRuban' name='MenuRuban'>\n";    
    obDiv +=  "<area  shape='rect' alt='Gauche' coords='0,0," + mapW + "," + funy_menuRuban_bgH + "' onmouseover='javascript:funy_menuRuban_defilementGauche();' onMouseOut='javascript:funy_menuRuban_arretDefilement();' href='' />\n";    
    obDiv +=  "<area  shape='rect' alt='Droite' coords='" + mapW + ",0," + (funy_menuRuban_bgW + funy_menuRuban_mapMiddleBande) + "," + funy_menuRuban_bgH + "' onmouseover='javascript:funy_menuRuban_arretDefilement();' onMouseOut='javascript:funy_menuRuban_arretDefilement();' href='' />\n";
    obDiv +=  "<area  shape='rect' alt='Droite' coords='" + (mapW + funy_menuRuban_mapMiddleBande) + ",0," + (funy_menuRuban_bgW*2 + funy_menuRuban_mapMiddleBande) + "," + funy_menuRuban_bgH + "' onmouseover='javascript:funy_menuRuban_defilementDroite();' onMouseOut='javascript:funy_menuRuban_arretDefilement();' href='' />\n";        
    obDiv +=  "</map>";    

*/
    
    //---------------------------------------------------
    //obDiv +=  "</div>\n";
    //obDiv +=  "</div>\n";    
    

    obID.innerHTML = obDiv;
    //document.write(obDiv);
    //document.write("<div><hr>zzzzzzkkkkkkkkkkkkkkkkkkkkkkkkkkkkkzzzzzzzzzz<hr></div>");  
    //alert (obDiv);    
    
    //-----------------------------------------------------------------
    var obIdFond = document.getElementById("funy_menuRuban_Imgfond");   
    funy_menuRuban_fondW = obIdFond.width;    
    funy_menuRuban_fondH = obIdFond.height;
    

    i = 0;
    var obIdImg = document.getElementById(funy_menuRuban_prefixe + i);
    //var coef = obIdImg.width / obIdImg.height ;       
    
    if(funy_menuRuban_imgW == 0) funy_menuRuban_imgW = obIdImg.width;
    //funy_menuRuban_imgW -= funy_menuRuban_minW;    
    
    funy_menuRuban_imgH = obIdImg.height / obIdImg.width * funy_menuRuban_imgW;
    
    if (funy_menuRuban_minH != 0){
      funy_menuRuban_minH = obIdImg.height / obIdImg.width * funy_menuRuban_minW;      
    }

    //funy_menuRuban_diametreW = ((funy_menuRuban_fondW - (funy_menuRuban_margeW * 2) - funy_menuRuban_imgW)) / 2;
    //funy_menuRuban_diametreH = ((funy_menuRuban_fondH - (funy_menuRuban_margeH * 2) - funy_menuRuban_imgH) / 2;      
    
    funy_menuRuban_diametreW = funy_menuRuban_fondW - (funy_menuRuban_margeW * 2) - funy_menuRuban_imgW;
    funy_menuRuban_diametreH = funy_menuRuban_fondH - (funy_menuRuban_margeH * 2) - funy_menuRuban_imgH;
      
    funy_menuRuban_rayonW = funy_menuRuban_diametreW / 2;
    funy_menuRuban_rayonH = funy_menuRuban_diametreH / 2;
    
    //funy_menuRuban_centreW = (funy_menuRuban_diametreW / 2);
    //funy_menuRuban_centreH = (funy_menuRuban_diametreH / 2);
    
    var fx = funy_getDomOffset( obIdFond, "offsetLeft");
    var fy = funy_getDomOffset( obIdFond, "offsetTop" ); 
    funy_menuRuban_absoluteX = funy_getDomOffset( obIdFond, "offsetLeft" ) 
                               + ((funy_menuRuban_fondW - funy_menuRuban_imgW) / 2);
    funy_menuRuban_absoluteY = funy_getDomOffset( obIdFond, "offsetTop" )  
                               + ((funy_menuRuban_fondH - funy_menuRuban_imgH) / 2); 
    
    
//funy_show("Tille aloué au fond",funy_menuRuban_bgW,funy_menuRuban_bgH);    
//funy_show("Position du fond",fx,fy);    
//funy_show("Position du centre",funy_menuRuban_absoluteX,funy_menuRuban_absoluteY);
//funy_show("Taille du fond",funy_menuRuban_fondW,funy_menuRuban_fondH);
//funy_show("Diametre",funy_menuRuban_diametreW,funy_menuRuban_diametreH);
//funy_show("Rayon",funy_menuRuban_rayonW,funy_menuRuban_rayonH);
//funy_show("Taille Image",funy_menuRuban_imgW,funy_menuRuban_imgH);
//funy_show("Taille min",funy_menuRuban_minW,funy_menuRuban_minH);
    funy_menuRuban_show ()
    return true
     


}
/*********************************************************************
 
 *********************************************************************/

function funy_menuRuban_buildStyle (){
    var sStyle = "<STYLE type='text/css'>"
               + ".imag"
               + "{"
               + "  position:absolute;"
               + "  border : 0px;"
               + "}"
               + "#divMenuRuban"
               + "{"
               + "  width:   " + funy_menuRuban_bgW + "px;"
               + "  height : " + funy_menuRuban_bgH + "px;"
               + "}"
               + "</STYLE>";

  return sStyle;
  
}	
/*********************************************************************
 
 *********************************************************************/

function funy_menuRuban_show ()
{	
    for(i=0; i < funy_menuRuban_array.length; i++){
       var obID = document.getElementById(funy_menuRuban_prefixe + i);      
      // funy_menuRuban_computeProperty (obID, i)
       r = funy_menuRuban_computePropertyA (i);
       
       obID.style.left = r['x'];       
       obID.style.top = r['y'] ;      
       obID.width  = r['width'];      
       obID.style.zIndex= r['zIndex'];
       obID.style.opacity=r['opacity'] ;
       obID.style.filter=r['filter'] ;
    }  
    
}
/*********************************************************************
 


function funy_menuRuban_computeProperty (obID, i)
{	
       var angle = (funy_menuRuban_angle + funy_menuRuban_inclinaison) + i * Math.PI / funy_menuRuban_secteur;      
	     
       var lx = funy_menuRuban_absoluteX + (funy_menuRuban_rayonW * (Math.cos(angle)));
       obID.style.left = lx + "px";
	     
       var ly = funy_menuRuban_absoluteY + (funy_menuRuban_rayonH *(Math.sin(angle))); 
       obID.style.top = ly + "px";
       
//funy_show("position img",lx,ly);        

        agl = funy_menuRuban_angle + i * Math.PI / funy_menuRuban_secteur;
        obID.width  = (funy_menuRuban_imgW-funy_menuRuban_minW) * (Math.sin(agl)) + funy_menuRuban_minW; //+ 30;
        //obID.height = lhImg * (Math.sin(agl)) + 30;        
        
        var sinus = Math.sin(agl);
        //obID.style.zIndex= (50*(sinus)+100);
        obID.style.opacity=(sinus+1)*(funy_menuRuban_opacite/100);
        obID.style.filter="alpha(opacity=" + (sinus+1)*funy_menuRuban_opacite + ")";
}
 *********************************************************************/
/*********************************************************************
 
 *********************************************************************/

function funy_menuRuban_computePropertyA (i)
{	
       r = new Array();
       var angle = (funy_menuRuban_angle + funy_menuRuban_inclinaison) + i * Math.PI / funy_menuRuban_secteur;      
	     
       var lx = funy_menuRuban_absoluteX + (funy_menuRuban_rayonW * (Math.cos(angle)));
       r['x']  = lx + "px";
	     
       var ly = funy_menuRuban_absoluteY + (funy_menuRuban_rayonH *(Math.sin(angle))); 
       r['y']  = ly + "px";
       
//funy_show("position img",lx,ly);        

        agl = funy_menuRuban_angle + i * Math.PI / funy_menuRuban_secteur;
        r['width'] = (funy_menuRuban_imgW-funy_menuRuban_minW) * (Math.sin(agl)) + funy_menuRuban_minW; //+ 30;
        //r['height'] = lhImg * (Math.sin(agl)) + 30;        
        
        var sinus = Math.sin(agl);
        var zIndex = (50*(sinus)+100);
        r['zIndex'] = zIndex.toFixed(0);
        
        var filter = (sinus+1)*(funy_menuRuban_opacite);
        if (filter < 0 )   filter = 0;
        if (filter > 100 ) filter = 100;         
        if (filter == 0){
          var opacite = 0;
        }else{
          var opacite = (filter / 100).toFixed(1);
        }
        
        r['opacity'] = opacite;
        r['filter']  = "alpha(opacity=" +  filter + ")";
        
        return r;
}

/*********************************************************************

 *********************************************************************/

function funy_menuRuban_defilement()
{
    switch (funy_menuRuban_sens)
    {
        case "Droite" :
             funy_menuRuban_angle -= 0.05;
            break;
        case "Gauche" :
             funy_menuRuban_angle += 0.05;
            break;            
        default :
            //funy_menuRuban_angle=funy_menuRuban_angle;
    }
    funy_menuRuban_show (); 
}
/*********************************************************************
 
 *********************************************************************/

function funy_menuRuban_defilementDroite()
{
    if (funy_menuRuban_sens!="Droite")
    {
        funy_menuRuban_sens="Droite";
        if (!funy_menuRuban_isMoving) funy_menuRuban_timer=setInterval("funy_menuRuban_defilement()",funy_menuRuban_speed);
        funy_menuRuban_isMoving = true;
    }   
}
/*********************************************************************
 
 *********************************************************************/

function funy_menuRuban_defilementGauche()
{
    if (funy_menuRuban_sens!="Gauche")
    {
        funy_menuRuban_sens="Gauche";
        if (!funy_menuRuban_isMoving) funy_menuRuban_timer=setInterval("funy_menuRuban_defilement()",funy_menuRuban_speed);
        funy_menuRuban_isMoving = true;
    }   
}

/*********************************************************************
 
 *********************************************************************/
function funy_menuRuban_arretDefilement()
{
    clearInterval(funy_menuRuban_timer);
    funy_menuRuban_sens="Non";
    funy_menuRuban_isMoving = false;
}
/*********************************************************************
 
 *********************************************************************/

function funy_menuRuban_redirect (LienRedirection)
{
    var sid =   LienRedirection.id;
    sid = sid.substr(funy_menuRuban_prefixe.length,2);
    //alert (sid);
    //lid = sid.toNumber;
    
    //alert (funy_menuRuban_array[sid]["link"]);    
    document.location = funy_menuRuban_array[sid]["link"];      

}

/*********************************************************************
 
 *********************************************************************/
function funy_show(title, x1, y1){
   
  if (funy_menuRuban_la > 12) return;   
  h = funy_menuRuban_tLog.length;
  funy_menuRuban_tLog[h] = new Array;
  funy_menuRuban_tLog[h][0] = title;
  funy_menuRuban_tLog[h][1] = x1;  
  funy_menuRuban_tLog[h][2] = y1;  
  
  tdStyle1 = "style='background-color: #FFDDDD; border-style: solid; border-width: 1px'";
  tdStyle2 = "style='background-color: #D2E9FF; border-style: solid; border-width: 1px'";
    
  sLog = "<div style='none'><table border='1px' width='200px,150px,150px'>";
  for (h = 0; h < funy_menuRuban_tLog.length; h++){
      tdStyle = ((h % 2) == 0) ? tdStyle1 : tdStyle2;
  sLog += "<tr>"
        + "<td " + tdStyle + ">" + funy_menuRuban_tLog[h][0] + "</td>"
        + "<td " + tdStyle + " align='right'>" + funy_menuRuban_tLog[h][1] + "</td>"
        + "<td " + tdStyle + " align='right'>" + funy_menuRuban_tLog[h][2] + "</td>"  
        + "</tr>";      
        
  }
  sLog += "</table></div>";

  //sLog += title + ": \nh = " + x1 + " - w = " + y1 + ": <br>"; 
  var obId = document.getElementById("divAlert");  
  obId.innerHTML = sLog;
  funy_menuRuban_la ++;

}

/*********************************************************************
 
 *********************************************************************/
//funy_menuRuban_build2();
funy_menuRuban_build(); 
//funy_menuRuban_sens="Droite";


    switch (funy_menuRuban_modeDefilement){
      case 1:
        funy_menuRuban_defilement();
        break;      
      
      default:
        funy_menuRuban_defilementDroite();        
        break;
      
    }        
