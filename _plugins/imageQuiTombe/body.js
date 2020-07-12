
var isNS = (navigator.appName == "Netscape" && parseInt(navigator.appVersion) >= 4);
var funy_tqp_obName = "funy_tqp_bou";


//var funy_tqp_XX = document.body.clientWidth -funy_tqp_posX ;
//var funy_tqp_YY = funy_tqp_posY ; //document.body.clientHeight - posY;

var funy_tqp_XX = funy_tqp_imgWidth;
var funy_tqp_YY = funy_tqp_imgHeight;
var funy_tqp_coef = 1 + ((100 - funy_tqp_coefRebondissement)/100);

var funy_tqp_isruning = true;


jjd = document.getElementById("jjd54");

document.write("<div id='" + funy_tqp_obName + "' style='position:absolute; z-index:1;'>");
document.write("<IMG SRC='" + funy_tqp_image + "' height=" + funy_tqp_imgHeight 
             + "px width=" + funy_tqp_imgWidth + "px>");
document.write("</div>");

funy_tqp_ob = document.getElementById(funy_tqp_obName);

//var div1 = funy_tqp_ob.style;
var funy_tqp_objet;
var coord;
var coordb=800;
//funy_tqp_objet = new Array(div1);
funy_tqp_objet = document.getElementById(funy_tqp_obName);
coord = new Array();
coord[0]=0;
coord[1]=0;
coord[2]=0;
j = 0;

//---------------------------------------------------
function funy_tqp_reb() {
 //alert (window.height + '-' + funy_tqp_imgHeight);
 //alert (document.body.scrollHeight); 
  tailley = document.body.offsetHeight - funy_tqp_imgHeight;
   //tailley = document.ensureVisible - funy_tqp_imgHeight; 
  //tailley = screen.height - funy_tqp_imgHeight; 
  //tailley = document.body.scrollHeight - funy_tqp_imgHeight;   
  taillex = document.body.clientWidth;
  offsety = document.body.scrollTop;
  offsetx = document.body.scrollLeft;

  maxi = tailley + offsety - funy_tqp_YY;
  
  if (funy_tqp_posX < 0) {
    coord[0] =taillex + offsetx - funy_tqp_XX - funy_tqp_posX ;    
  }else{
    coord[0] =funy_tqp_posX + offsetx //taillex + offsetx - funy_tqp_XX ;    
  }
  

  coord[1] += coord[2];

 
  if (coord[1]>maxi) {
    coord[1]=maxi;
    coord[2] = -coord[2] / funy_tqp_coef;
  }
  old =  funy_tqp_objet.style.top; 
  funy_tqp_objet.style.left = coord[0] + "px";
  funy_tqp_objet.style.top  = coord[1]  + "px";
  coord[2]+=1;
  j++;
  
   //if (jjd) jjd.value = j + " : "+ funy_tqp_objet.style.top + " : " + coord[1] + " : " + old; 
  //jjd.value = funy_tqp_objet.style.top + " : " + coord[1] + " : " + old;
  
  if ((funy_tqp_objet.style.top != old | j < 100) & (funy_tqp_isruning) ){
    tempo = setTimeout("funy_tqp_reb()", funy_tqp_tempo); 
    j ++;     
  }else{
    if (!funy_tqp_isruning){
      funy_tqp_objet.style.top  = "-100px";      
    }
   
    setTimeout("funy_tqp_stop()", funy_tqp_persistance * 100);    
  }

}
//----------------------------------------------------------
function funy_tqp_init(){
      funy_tqp_YY = funy_tqp_imgHeight;
      coord[0]=0;
      coord[1]=0;
      coord[2]=0;
      j = 0;
  
  
}
//----------------------------------------------------------
function funy_tqp_stop(){
    //alert("funy_tqp_stop");
    funy_tqp_isruning = false;
    //funy_tqp_objet.display = "none";
    funy_tqp_objet.style.top  = "-100px";
    
}
//----------------------------------------------------------
function funy_tqp_start(){
    if (!funy_tqp_isruning){
      funy_tqp_isruning = true;
      funy_tqp_init();
      setTimeout("funy_tqp_reb()", funy_tqp_delai);
    }
}


//----------------------------------------------------
setTimeout("funy_tqp_reb()", funy_tqp_delai);
