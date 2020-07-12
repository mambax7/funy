
//alert ("ici");

h = 0;
ff_name = "funy_Farandole";

ff_funy_mode = 1;
ff_R   = 0;
ff_x1  = 0.1;
ff_y1  = 0.05;
ff_x2  = 0.25;
ff_y2  = 0.24;
ff_x3  = 1.6;
ff_y3  = 0.24;
ff_x4  = 300;
ff_y4  = 200;
ff_x5  = 300;
ff_y5  = 200;
ff_DI  = document.getElementsByTagName("img");
ff_DIL = ff_DI.length;
ff_old_x = new Array();
ff_old_y = new Array();
var ff_process;
//--------------------------------------------

function funyFarandole(){
  alert("funyFarandole");  
 funyFarandole_memo_coordonnees();
 ff_process = setInterval('funyFarandole_boucle()', 50); 
}
//--------------------------------------------
function funyFarandole_boucle(){
h++;
//if (h<5){alert("farandole");}


  for(i=0; i - ff_DIL; i++){
    ff_DIS = ff_DI[i].style; 
    ff_DIS.position = 'absolute'; 
    ff_DIS.left = (Math.sin(ff_R * ff_x1 + i * ff_x2 + ff_x3) * ff_x4 + ff_x5) + "px"; 
    ff_DIS.top  = (Math.cos(ff_R * ff_y1 + i * ff_y2 + ff_y3) * ff_y4 + ff_y5) + "px";
  }


  ff_R++;
if (ff_R > 100) {funyFarandole_restaure_coordonnees();}
}
//----------------------------------------------
function funyFarandole_memo_coordonnees(){
  alert("funyFarandole_memo_coordonnees");
  for(i=0; i - ff_DIL; i++){
    ff_DIS = ff_DI[i].style;    
    ff_old_x[i]  = ff_DIS.left;
    ff_old_y[i]  = ff_DIS.top;  
  }
  
}

//----------------------------------------------
function funyFarandole_restaure_coordonnees(){
  alert("funyFarandole_restaure_coordonnees");
  clearInterval(ff_process);  
  for(i=0; i - ff_DIL; i++){
    ff_DIS = ff_DI[i].style;    
    ff_DIS.left = ff_old_x[i];
    ff_DIS.top = ff_old_y[i];  
  }
  
}

//javascript:R=0; x1=.1; y1=.05; x2=.25; y2=.24; x3=1.6; y3=.24; x4=300; y4=200; x5=300; y5=200; DI=document.getElementsByTagName(%22img%22); DIL=DI.length; function A(){for(i=0; i-DIL; i++){DIS=DI[ i ].style; DIS.position='absolute'; DIS.left=(Math.sin(R*x1+i*x2+x3)*x4+x5)+%22px%22; DIS.top=(Math.cos(R*y1+i*y2+y3)*y4+y5)+%22px%22}R++}setInterval('A()',50); void(0);
funyFarandole() ;
void(0);
