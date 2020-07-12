
<!--
//  © Joe Milicevic trouvé sur www.dhtmlshock.com/
var funyDFDT_cnt =-1;
var funyDFDT_str = '';
var funyDFDT_time = 0;

//-----------------------------------------------------
function funyDFDT_animateTitle(nt,t){
  funyDFDT_str = nt;
  if(document.all ||document.getElementById){
    if(t == 1){
      document.title='';
      funyDFDT_cnt=-1;
    }
    if(funyDFDT_cnt < funyDFDT_str.length){
      if(funyDFDT_str.charAt(funyDFDT_cnt+1)==" " & funyDFDT_replaceSBbyUS == 1){
        ++funyDFDT_cnt;
        document.title += "_";
      }else{
        document.title += funyDFDT_str.charAt(++funyDFDT_cnt);
      }
    }
    
    TO=setTimeout('funyDFDT_animateTitle(funyDFDT_str,0)',funyDFDT_tempo);    
    

    if(funyDFDT_cnt == funyDFDT_str.length){
      funyDFDT_time++;
      if (funyDFDT_repeat == 0 | funyDFDT_time < funyDFDT_repeat){
        funyDFDT_init(funyDFDT_clearCurrentTitle);
      }else clearTimeout(TO);
    }
  }
}
//-----------------------------------------------------
function funyDFDT_init(t){
    if(t == 1){

    }
      document.title='';    
    funyDFDT_cnt=-1;    
}
//-------------------------------------------------------
setTimeout('funyDFDT_animateTitle(funyDFDT_texte,funyDFDT_clearCurrentTitle)' ,funyDFDT_tempo);

//-->

