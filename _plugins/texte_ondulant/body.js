
/* script edited by David Gardner (toolmandav@geocities.com)*/
//mettre le texte ici

//var funy_text = "hhhhhaaaaa";
//var funy_timer = 50;
//var funy_height = 25;
//var tdim = new Array(25,25);
//<{funy_affecter_var}>
//var funy_align = new array('left','center','right');
var funy_onde_isruning = true;

funy_text = funy_parseBonus(funy_text, funy_onde_pays, funy_url);

//----------------------------------------------
function funy_onde_nextSize(i,hmax,textLength)
{
return (hmax * Math.abs(Math.sin(i/(textLength/3.14))));  
//if (incMethod == 1) return (tdim[0]* Math.abs(Math.sin(i/(textLength/3.14))));
//if (incMethod == 2) return (tdim[1]* Math.abs(Math.cos(i/(textLength/3.14))));
}

//----------------------------------------------
function funy_onde_sizeCycle(text,method,dis)
{
	output = "";
	i = 0;
	
	while (i < text.length)
	{
	  sLettre = getNextChar(text, i);
	  i += sLettre.length -1;
    	   
		size = parseInt(funy_onde_nextSize(i + dis, method,text.length));
		output += "<font style='font-size: "+ size +"pt;color:#" + funy_textColor 
              + ";'>" + sLettre + "</font>";
    i++;    
	}

		size = parseInt(funy_onde_nextSize(0, method,text.length));
		output += "<font style='font-size: "+ size +"pt;color:#" + funy_textColor 
              + ";'>" + "X" + "</font>";





	obt =  document.getElementById("theDiv");

	if (obt) {
	//obt.align =funy_align[funy_align]; 
  obt.innerHTML = output;    
  }


}
//----------------------------------------------
function funy_onde_sizeCycle2(text,method,dis)
{
	output = "";
	for (i = 0; i < text.length; i++)
	{
		size = parseInt(funy_onde_nextSize(i + dis, method,text.length));
		output += "<font style='font-size: "+ size +"pt;color:#" + funy_textColor 
              + ";'>" + text.substring(i,i+1)+ "</font>";
	}

		size = parseInt(funy_onde_nextSize(0, method,text.length));
		output += "<font style='font-size: "+ size +"pt;color:#" + funy_textColor 
              + ";'>" + "X" + "</font>";





	obt =  document.getElementById("theDiv");

	if (obt) {
	//obt.align =funy_align[funy_align]; 
  obt.innerHTML = output;    
  }


}

//----------------------------------------------
function funy_onde_doWave(n) 
{   
	funy_onde_sizeCycle(funy_text, funy_height, n);
	if (n > funy_text.length) {n=0}

  if (funy_onde_isruning){
	 setTimeout("funy_onde_doWave(" + (n+1) + ")", 50);
	}
}

//----------------------------------------------------------
function funy_onde_stop(){
      //alert("snowIE");
    funy_onde_isruning = false;

}
//----------------------------------------------------------
function funy_onde_start(){
    if (!funy_onde_isruning){
      funy_onde_isruning = true;
      funy_onde_doWave(1);
      
    }
}

//----------------------------------------------------------

funy_onde_doWave(1);

