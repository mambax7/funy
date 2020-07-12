var funy_transition_container;	// Reference to the gallery div
var funy_transition_noFading = false;
//var funy_transition_galleryWidth;	// Width of gallery
//var funy_transition_galleryHeight;	// Height of galery
var funy_transition_index = 0;	// Index of current image shown
var Opera = navigator.userAgent.indexOf('Opera') >=0 ? true : false;
var funy_transition_isRunning = true;

var funy_transition_obImg1;
var funy_transition_obImg2;

var funy_transition_width;
var funy_transition_height;
var funy_transition_EffetList = funy_transition_effet.split(",");
//alert ("nbEffet = " + funy_transition_EffetList.length);
/****************************************************************
 *
 ****************************************************************/ 
function funy_transition_run()
{


  
  var funy_transition_obImg = funy_transition_obImg1;  
  funy_transition_obImg1 = funy_transition_obImg2;
  funy_transition_obImg2 = funy_transition_obImg ; 
/*   
  var funy_transition_obImg = funy_transition_obImg2;  
  funy_transition_obImg2 = funy_transition_obImg1;
  funy_transition_obImg1 = funy_transition_obImg ;   
*/  
  //funy_transition_obImg1.src = funy_transition_obImg2.src;
  //funy_transition_obImg1.style.visibility = "visible";
  
  funy_transition_next();  
  funy_transition_obImg2.src =  funy_site + funy_transition_Files[funy_transition_index];  

	funy_currentOpacity=100;	// Reset current opacity



	// Displaying image divs
	funy_transition_obImg1.style.visibility = 'visible';
	if(Opera)funy_transition_obImg1.style.display = 'inline';
	if(navigator.userAgent.indexOf('Opera')<0){
		funy_transition_obImg2.style.visibility = 'visible';
	}

/*

*/
	if(document.all){	// IE rules
		funy_transition_obImg1.style.filter = 'alpha(opacity=100)';
		funy_transition_obImg2.style.filter = 'alpha(opacity=1)';
	}else{
		funy_transition_obImg1.style.opacity = 0.99;	// Can't use 1 and 0 because of screen flickering in FF
		funy_transition_obImg2.style.opacity = 0.01;
	}
//alert(funy_transition_mode);

/*

  if (funy_transition_mode == 0){
    var lTransition = (((Math.random() * 1000) % 3) + 1).toFixed(0) * 1;    
  }else{
    var lTransition = funy_transition_mode;
  }
*/
  
  if (funy_transition_EffetList.length == 0){
    lTransition = 0;
  }else if(funy_transition_EffetList.length == 1){
    lTransition = funy_transition_EffetList[0];    
  }else{
    var r = (((Math.random() * 1000) % (funy_transition_EffetList.length-1))).toFixed(0) * 1;    
    lTransition = funy_transition_EffetList[r] * 1;  
  }

//alert("transition = |"+ lTransition + "|" + r + "|" + funy_transition_EffetList.length);
  
	if (funy_transition_isRunning) {
        switch (lTransition * 1){	
        case  0:   //---Fondu
            setTimeout('funy_transition_showFondu()',funy_transition_timeBetweenSlides);      
            break;    
            
        case  1:   //---Saccadé
            setTimeout('funy_transition_showSacade()',funy_transition_timeBetweenSlides);      
            break;
    
        case  2:   //---Zoom avant milieu
        case  3:   //---Zoom avant gauche
        case  4:   //---Zoom avant haut
        case  5:   //---Zoom avant droire
        case  6:   //---Zoom avant bas
        case  7:   //---Zoom avant coin haut-gauche
        case  8:   //---Zoom avant coin haut-droite
        case  9:   //---Zoom avant coin avant bas-droite
        case 10:   //---Zoom avant coin bas-gauche
            //var sRun = "funy_transition_showZoomAvant(" + (lTransition - 1) + ",1)";
            var sRun = "funy_transition_showZoom(" + (lTransition - 1) + ",0,1)";            
            //alert (sRun);
            setTimeout(sRun,funy_transition_timeBetweenSlides);        
            break;
            
        case 11:   //---Zoom arriere milieu
        case 12:   //---Zoom arriere gauche
        case 13:   //---Zoom arriere haut
        case 14:   //---Zoom arriere droire
        case 15:   //---Zoom arriere bas
        case 16:   //---Zoom arriere coin haut-gauche
        case 17:   //---Zoom arriere coin haut-droite
        case 18:   //---Zoom arriere coin avant bas-droite
        case 19:   //---Zoom arriere coin bas-gauche
            //var sRun = "funy_transition_showZoomArriere(" + (lTransition - 10) + ",1)";
            var sRun = "funy_transition_showZoomArriere(" + (lTransition - 10) + ",1,1)";            
            //alert (sRun);
            setTimeout(sRun,funy_transition_timeBetweenSlides);        
            break;
            
        default:
            setTimeout('funy_transition_showFondu()',funy_transition_timeBetweenSlides);
    
        }	
	}
}

/****************************************************************
 *
 ****************************************************************/ 
function funy_transition_next()
{
    var newIndex = funy_transition_index;
    if (funy_transition_alea == 1){

        while (newIndex == funy_transition_index){
        newIndex = (funy_transition_index + (funy_transition_Files.length+(Math.random()*1000).toFixed(0))) % (funy_transition_Files.length);
        }
    
    }else{
        newIndex = (funy_transition_index + 1) % funy_transition_Files.length;    
    }
   
   funy_transition_index = Math.abs(newIndex); ;
   
}
/****************************************************************
 *
 ****************************************************************/ 
function funy_transition_showFondu(){

	if(funy_transition_noFading){
		funy_transition_obImg1.style.visibility = 'hidden';
		if(Opera) funy_transition_obImg1.style.display = 'none';
		funy_transition_run();
		return;
	}
  //---------------------------------------------------
  
  
  
  
	funy_currentOpacity--;
	if(document.all){
		funy_transition_obImg1.style.filter = 'alpha(opacity='+funy_currentOpacity+')';
		funy_transition_obImg2.style.filter = 'alpha(opacity='+(100-funy_currentOpacity)+')';
	}else{
		funy_transition_obImg1.style.opacity = Math.max(0.01,funy_currentOpacity/100);	// Can't use 1 and 0 because of screen flickering in FF
		funy_transition_obImg2.style.opacity = Math.min(0.99,(1 - (funy_currentOpacity/100)));
	}

	funy_transition_obImg1.style.visibility = 'visible';
	if(funy_currentOpacity>0 & funy_transition_isRunning){
	   //en prevision d'autre defets a venir: glisser, rebondi, ...
      setTimeout('funy_transition_showFondu()',funy_transition_fadingSpeed);
	}else{
		funy_transition_obImg1.style.visibility = 'hidden';
		if(Opera)funy_transition_obImg1.style.display = 'none';
		funy_transition_run();
	}
}

/****************************************************************
 *
 ****************************************************************/ 
function funy_transition_showSacade(){

	if(funy_transition_noFading){
		funy_transition_obImg1.style.visibility = 'hidden';
		if(Opera) funy_transition_obImg1.style.display = 'none';
		funy_transition_run();
		return;
	}
  //---------------------------------------------------
  funy_transition_next();  
  funy_transition_obImg1.src =  funy_site + funy_transition_Files[funy_transition_index];  
  funy_transition_obImg2.src =  funy_site + funy_transition_Files[funy_transition_index];
	funy_currentOpacity = funy_currentOpacity - 10;
	
	

  //----------------------------------------------------
	if(funy_currentOpacity > 0 & funy_transition_isRunning){
	   //en prevision d'autre defets a venir: glisser, rebondi, ...
      setTimeout('funy_transition_showSacade()',funy_transition_fadingSpeed*10);
	}else{
		funy_transition_obImg1.style.visibility = 'hidden';
		if(Opera)funy_transition_obImg1.style.display = 'none';
		funy_transition_run();
	}
}

/****************************************************************
 *
 ****************************************************************/ 
function funy_transition_showZoom(mode, zoom, delai){
try{
    
    //zoom : 0 = avant - 1 = arriere
    if (zoom == 0) {
        z1 = 100;
        z2 = 0;
    }else{
        z1 = 0;
        z2 = 100;
    }

	if(funy_transition_noFading){
	  funy_transition_obImg1.style.top  = "0px";
      funy_transition_obImg1.style.left = "0px";  

		funy_transition_obImg1.style.visibility = 'visible';
		if(Opera) funy_transition_obImg1.style.display = 'none';
		funy_transition_run();
		return;
	}
  //---------------------------------------------------
  
  if (funy_currentOpacity == 100) {
    //alert("funy_transition_showZoomAvant");
    funy_transition_obImg1.style.zIndex= 198;
    funy_transition_obImg2.style.zIndex= 199;  
    
  	funy_transition_obImg1.style.visibility = 'visible';  
  	funy_transition_obImg2.style.visibility = 'visible';	
    funy_transition_obImg1.style.left = "0px";	  
    funy_transition_obImg1.style.top  = "0px";
  
    
		funy_transition_obImg1.style.filter = 'alpha(opacity='+100+')';
		funy_transition_obImg2.style.filter = 'alpha(opacity='+(100)+')';

		funy_transition_obImg1.style.opacity = 0.99; //Math.max(0.01,funy_currentOpacity/100);	// Can't use 1 and 0 because of screen flickering in FF
		funy_transition_obImg2.style.opacity = 0.99; //Math.min(0.99,(1 - (funy_currentOpacity/100)));
    
   
    //funy_transition_mode++;
    //if (funy_transition_mode > 5) funy_transition_mode = 3;
    
    if (mode == 0){
      coin = ((Math.random()*100).toFixed(0) % 8) + 1;      
    }else{
      coin = mode;      
    }


    
  }
  //http://xoops.kiolo.com/
  
  // a cause du temps de chargement de la page 
  //il faut verifier que ces valeurs ont ete initialisee 
  if (funy_transition_width == 0){
    funy_transition_width  = funy_transition_obImg1.width;
    funy_transition_height = funy_transition_obImg1.height;
 }

  var lh = funy_transition_height / 100 * Math.abs(funy_currentOpacity - z1);
  var lw = funy_transition_width  / 100 * Math.abs(funy_currentOpacity - z1);
    
    //var coin = funy_transition_mode - 2;
    //if (sens == 2) sens = (Math.random()*100).fixe(0) % 4;
      
    switch (coin){
      //------------------------------------------------------
      case 2:   //---Zoom avant gauche
          var lt = 0;
          var ll = 0;
          lh = funy_transition_height;
          break;
          
      case 3:   //---Zoom avant haut
          var lt = 0;
          var ll = 0;
          lw = funy_transition_width;
          break;

      case 4:   //---Zoom avant droite
          var lt = 0;
          var ll = funy_transition_width  / 100 * Math.abs(funy_currentOpacity - z2);
          lh = funy_transition_height;
          break;

      case 5:   //---Zoom avant bas
          var lt = funy_transition_height / 100 * Math.abs(funy_currentOpacity - z2);
          var ll = 0;
          lw = funy_transition_width;
          break;

      //------------------------------------------------------      
      case 6:   //---Zoom avant coin haut-gauche
          var lt = 0;
          var ll = 0;
          break;
      
      case 7:   //---Zoom avant coin haut-droite      
          var lt = 0;
          var ll = funy_transition_width  / 100 * Math.abs(funy_currentOpacity - z2);
          break;
                    
      case 8:   //---Zoom avant coin avant bas-droite      
          var lt = funy_transition_height / 100 * Math.abs(funy_currentOpacity - z2);
          var ll = funy_transition_width  / 100 * Math.abs(funy_currentOpacity - z2);
          break;
      
      case 9:   //---Zoom avant coin bas-gauche   
          var lt = funy_transition_height / 100 * Math.abs(funy_currentOpacity - z2);
          var ll = 0;
          break;
          
      //------------------------------------------------------         
      default:   //---Zoom avant milieu
          var lt = (funy_transition_height / 100 * Math.abs(funy_currentOpacity - z2))/2;
          var ll = (funy_transition_width  / 100 * Math.abs(funy_currentOpacity) - z2)/2;
          break
      
     }


lt = lt.toFixed(0);
ll = ll.toFixed(0);
  if (lt < 0) lt = 0;
  if (ll < 0) ll = 0;
  if (lt > 1000) lt = 1000;
  if (ll > 1000) ll = 1000;
 
  funy_transition_obImg2.style.left = ll + "px";  
  funy_transition_obImg2.style.top  = lt + "px";
  
  funy_transition_obImg2.style.width  = lw + "px";  
  funy_transition_obImg2.style.height = lh + "px";  



	funy_currentOpacity = funy_currentOpacity - 1;
	
//alert ("la : ll = " + ll + " - lt = " + lt + " - lw = " + lw + " - lh =" lh);	

  //----------------------------------------------------
	if(funy_currentOpacity > 0 & funy_transition_isRunning){
	   //en prevision d'autre defets a venir: glisser, rebondi, ...
      //setTimeout('funy_transition_showZoomAvant()', 1);
      setTimeout('funy_transition_showZoom(' + mode + ',' + zoom + ',' + delai + ')',1);      
	}else{
		//funy_transition_obImg1.style.visibility = 'hidden';
		//if(Opera)funy_transition_obImg1.style.display = 'none';
		funy_transition_run();
	}
}catch (e){
      setTimeout('funy_transition_showZoom(' + mode + ',' + zoom  + ',' + delai + ')',1);
}
}

/****************************************************************
 *
 ****************************************************************/ 
function funy_transition_showZoomAvant(mode, delai){
try{

	if(funy_transition_noFading){
	  funy_transition_obImg1.style.top  = "0px";
      funy_transition_obImg1.style.left = "0px";  

		funy_transition_obImg1.style.visibility = 'visible';
		if(Opera) funy_transition_obImg1.style.display = 'none';
		funy_transition_run();
		return;
	}
  //---------------------------------------------------
  
  if (funy_currentOpacity == 100) {
    //alert("funy_transition_showZoomAvant");
    funy_transition_obImg1.style.zIndex= 198;
    funy_transition_obImg2.style.zIndex= 199;  
    
  	funy_transition_obImg1.style.visibility = 'visible';  
  	funy_transition_obImg2.style.visibility = 'visible';	
    funy_transition_obImg1.style.left = "0px";	  
    funy_transition_obImg1.style.top  = "0px";
  
    
		funy_transition_obImg1.style.filter = 'alpha(opacity='+100+')';
		funy_transition_obImg2.style.filter = 'alpha(opacity='+(100)+')';

		funy_transition_obImg1.style.opacity = 0.99; //Math.max(0.01,funy_currentOpacity/100);	// Can't use 1 and 0 because of screen flickering in FF
		funy_transition_obImg2.style.opacity = 0.99; //Math.min(0.99,(1 - (funy_currentOpacity/100)));
    
   
    //funy_transition_mode++;
    //if (funy_transition_mode > 5) funy_transition_mode = 3;
    
    if (mode == 0){
      coin = ((Math.random()*100).toFixed(0) % 8) + 1;      
    }else{
      coin = mode;      
    }


    
  }
  http://xoops.kiolo.com/
  
  // a cause du temps de chargement de la page 
  //il faut verifier que ces valeurs ont ete initialisee 
  if (funy_transition_width == 0){
    funy_transition_width  = funy_transition_obImg1.width;
    funy_transition_height = funy_transition_obImg1.height;
 }

  var lh = funy_transition_height / 100 * (100- funy_currentOpacity);
  var lw = funy_transition_width  / 100 * (100- funy_currentOpacity);
    
    //var coin = funy_transition_mode - 2;
    //if (sens == 2) sens = (Math.random()*100).fixe(0) % 4;
      
    switch (coin){
      //------------------------------------------------------
      case 2:   //---Zoom avant gauche
          var lt = 0;
          var ll = 0;
          lh = funy_transition_height;
          break;
          
      case 3:   //---Zoom avant haut
          var lt = 0;
          var ll = 0;
          lw = funy_transition_width;
          break;

      case 4:   //---Zoom avant droite
          var lt = 0;
          var ll = funy_transition_width  / 100 * ( funy_currentOpacity);
          lh = funy_transition_height;
          break;

      case 5:   //---Zoom avant bas
          var lt = funy_transition_height / 100 * ( funy_currentOpacity);
          var ll = 0;
          lw = funy_transition_width;
          break;

      //------------------------------------------------------      
      case 6:   //---Zoom avant coin haut-gauche
          var lt = 0;
          var ll = 0;
          break;
      
      case 7:   //---Zoom avant coin haut-droite      
          var lt = 0;
          var ll = funy_transition_width  / 100 * ( funy_currentOpacity);
          break;
                    
      case 8:   //---Zoom avant coin avant bas-droite      
          var lt = funy_transition_height / 100 * ( funy_currentOpacity);
          var ll = funy_transition_width  / 100 * ( funy_currentOpacity);
          break;
      
      case 9:   //---Zoom avant coin bas-gauche   
          var lt = funy_transition_height / 100 * ( funy_currentOpacity);
          var ll = 0;
          break;
          
      //------------------------------------------------------         
      default:   //---Zoom avant milieu
          var lt = (funy_transition_height / 100 * ( funy_currentOpacity))/2;
          var ll = (funy_transition_width  / 100 * ( funy_currentOpacity))/2;
          break
      
     }


lt = lt.toFixed(0);
ll = ll.toFixed(0);
  if (lt < 0) lt = 0;
  if (ll < 0) ll = 0;
  if (lt > 1000) lt = 1000;
  if (ll > 1000) ll = 1000;
 
  funy_transition_obImg2.style.left = ll + "px";  
  funy_transition_obImg2.style.top  = lt + "px";
  
  funy_transition_obImg2.style.width  = lw + "px";  
  funy_transition_obImg2.style.height = lh + "px";  



	funy_currentOpacity = funy_currentOpacity - 1;
	
//alert ("la : ll = " + ll + " - lt = " + lt + " - lw = " + lw + " - lh =" lh);	

  //----------------------------------------------------
	if(funy_currentOpacity > 0 & funy_transition_isRunning){
	   //en prevision d'autre defets a venir: glisser, rebondi, ...
      //setTimeout('funy_transition_showZoomAvant()', 1);
      setTimeout('funy_transition_showZoomAvant(' + mode + ',' + delai + ')',1);      
	}else{
		//funy_transition_obImg1.style.visibility = 'hidden';
		//if(Opera)funy_transition_obImg1.style.display = 'none';
		funy_transition_run();
	}
}catch (e){
      setTimeout('funy_transition_showZoomAvant(' + mode + ',' + delai + ')',1);
}
}

/****************************************************************
 *
 ****************************************************************/ 
function funy_transition_showZoomArriere(mode, delai){
try{

	if(funy_transition_noFading){
	  funy_transition_obImg1.style.top  = "0px";
      funy_transition_obImg1.style.left = "0px";  

		funy_transition_obImg1.style.visibility = 'visible';
		if(Opera) funy_transition_obImg1.style.display = 'none';
		funy_transition_run();
		return;
	}
  //---------------------------------------------------
  
  if (funy_currentOpacity == 100) {
    //alert("funy_transition_showZoomAvant");
    funy_transition_obImg1.style.zIndex= 199;
    funy_transition_obImg2.style.zIndex= 198;  
    
  	funy_transition_obImg1.style.visibility = 'visible';  
  	funy_transition_obImg2.style.visibility = 'visible';	
    funy_transition_obImg1.style.left = "0px";	  
    funy_transition_obImg1.style.top  = "0px";
    funy_transition_obImg2.style.left = "0px";	  
    funy_transition_obImg2.style.top  = "0px";
  
    
		funy_transition_obImg1.style.filter = 'alpha(opacity='+100+')';
		funy_transition_obImg2.style.filter = 'alpha(opacity='+(100)+')';

		funy_transition_obImg1.style.opacity = 0.99; //Math.max(0.01,funy_currentOpacity/100);	// Can't use 1 and 0 because of screen flickering in FF
		funy_transition_obImg2.style.opacity = 0.99; //Math.min(0.99,(1 - (funy_currentOpacity/100)));
    
    if (mode == 0){
      coin = ((Math.random()*100).toFixed(0) % 8) + 1;      
    }else{
      coin = mode;      
    }


    
  }
  http://xoops.kiolo.com/
  
  // a cause du temps de chargement de la page 
  //il faut verifier que ces valeurs ont ete initialisee 
  if (funy_transition_width == 0){
    funy_transition_width  = funy_transition_obImg1.width;
    funy_transition_height = funy_transition_obImg1.height;
 }
  funy_transition_obImg2.style.width  = funy_transition_width + "px";  
  funy_transition_obImg2.style.height = funy_transition_height + "px";  

  var lh = funy_transition_height / 100 * (funy_currentOpacity);
  var lw = funy_transition_width  / 100 * (funy_currentOpacity);
    
    //var coin = funy_transition_mode - 2;
    //if (sens == 2) sens = (Math.random()*100).fixe(0) % 4;
  
      
    switch (coin){
      //------------------------------------------------------
      case 2:   //---Zoom avant gauche
          var lt = 0;
          var ll = 0;
          lh = funy_transition_height;
          break;
          
      case 3:   //---Zoom avant haut
          var lt = 0;
          var ll = 0;
          lw = funy_transition_width;
          break;

      case 4:   //---Zoom avant droite
          var lt = 0;
          var ll = funy_transition_width  / 100 * (100 - funy_currentOpacity);
          lh = funy_transition_height;
          break;

      case 5:   //---Zoom avant bas
          var lt = funy_transition_height / 100 * (100 - funy_currentOpacity);
          var ll = 0;
          lw = funy_transition_width;
          break;

      //------------------------------------------------------      
      case 6:   //---Zoom avant coin haut-gauche
          var lt = 0;
          var ll = 0;
          break;
      
      case 7:   //---Zoom avant coin haut-droite      
          var lt = 0;
          var ll = funy_transition_width  / 100 * (100 - funy_currentOpacity);
          break;
                    
      case 8:   //---Zoom avant coin avant bas-droite      
          var lt = funy_transition_height / 100 * (100 - funy_currentOpacity);
          var ll = funy_transition_width  / 100 * (100 - funy_currentOpacity);
          break;
      
      case 9:   //---Zoom avant coin bas-gauche   
          var lt = funy_transition_height / 100 * (100 - funy_currentOpacity);
          var ll = 0;
          break;
          
      //------------------------------------------------------         
      default:
          var lt = (funy_transition_height / 100 * (100 - funy_currentOpacity))/2;
          var ll = (funy_transition_width  / 100 * (100 -  funy_currentOpacity))/2;
          break
      
     }


lt = lt.toFixed(0);
ll = ll.toFixed(0);
  if (lt < 0) lt = 0;
  if (ll < 0) ll = 0;
  if (lt > 1000) lt = 1000;
  if (ll > 1000) ll = 1000;
 
  funy_transition_obImg1.style.left = ll + "px";  
  funy_transition_obImg1.style.top  = lt + "px";
  
  funy_transition_obImg1.style.width  = lw + "px";  
  funy_transition_obImg1.style.height = lh + "px";  



	funy_currentOpacity = funy_currentOpacity - 1;
	
//alert ("la : ll = " + ll + " - lt = " + lt + " - lw = " + lw + " - lh =" lh);	

  //----------------------------------------------------
	if(funy_currentOpacity > 0 & funy_transition_isRunning){
	   //en prevision d'autre defets a venir: glisser, rebondi, ...
      //setTimeout('funy_transition_showZoomArriere()', 1);
      setTimeout('funy_transition_showZoomArriere(' + mode + ',' + delai + ')',1);      
	}else{
		//funy_transition_obImg1.style.visibility = 'hidden';
		//if(Opera)funy_transition_obImg1.style.display = 'none';
		funy_transition_run();
	}
}catch (e){
      setTimeout('funy_transition_showZoomArriere(' + mode + ',' + delai + ')',1);
}
}
/****************************************************************
 *
 ****************************************************************/ 
function funy_transition_showZoomHorsCadre(mode, delai){
try{

	if(funy_transition_noFading){
	  funy_transition_obImg1.style.top  = "0px";
      funy_transition_obImg1.style.left = "0px";  

		funy_transition_obImg1.style.visibility = 'visible';
		if(Opera) funy_transition_obImg1.style.display = 'none';
		funy_transition_run();
		return;
	}
  //---------------------------------------------------
  
  if (funy_currentOpacity == 100) {
    //alert("funy_transition_showZoomAvant");
    funy_transition_obImg1.style.zIndex= 199;
    funy_transition_obImg2.style.zIndex= 198;  
    
  	funy_transition_obImg1.style.visibility = 'visible';  
  	funy_transition_obImg2.style.visibility = 'visible';	
    funy_transition_obImg1.style.left = "0px";	  
    funy_transition_obImg1.style.top  = "0px";
  
    
		funy_transition_obImg1.style.filter = 'alpha(opacity='+100+')';
		funy_transition_obImg2.style.filter = 'alpha(opacity='+(100)+')';

		funy_transition_obImg1.style.opacity = 0.99; //Math.max(0.01,funy_currentOpacity/100);	// Can't use 1 and 0 because of screen flickering in FF
		funy_transition_obImg2.style.opacity = 0.99; //Math.min(0.99,(1 - (funy_currentOpacity/100)));
    
   
    //funy_transition_mode++;
    //if (funy_transition_mode > 5) funy_transition_mode = 3;
    
    if (mode == 0){
      coin = ((Math.random()*100).toFixed(0) % 8) + 1;      
    }else{
      coin = mode;      
    }


    
  }
  http://xoops.kiolo.com/
  
  // a cause du temps de chargement de la page 
  //il faut verifier que ces valeurs ont ete initialisee 
  if (funy_transition_width == 0){
    funy_transition_width  = funy_transition_obImg1.width;
    funy_transition_height = funy_transition_obImg1.height;
 }

  var lh = funy_transition_height / 100 * (funy_currentOpacity);
  var lw = funy_transition_width  / 100 * (funy_currentOpacity);
    
    //var coin = funy_transition_mode - 2;
    //if (sens == 2) sens = (Math.random()*100).fixe(0) % 4;
  
      
    switch (coin){
      case 2:
          var lt = funy_transition_height / 100 * ( funy_currentOpacity);
          var ll = funy_transition_width  / 100 * ( funy_currentOpacity);
          break;
          
      case 3:  
          var lt = funy_transition_height / 100 * ( funy_currentOpacity);
          var ll = 0;
          break;
                    
      case 4:      
          var lt = 0;
          var ll = 0;
          break;
      
      case 5:   
          var lt = 0;
          var ll = funy_transition_width  / 100 * ( funy_currentOpacity);
          break;
          
      //------------------------------------------------------
      case 6:
          var lt = 0;
          var ll = 0;
          lh = funy_transition_height;
          break;
          
      case 7:
          var lt = 0;
          var ll = 0;
          lw = funy_transition_width;
          break;

      case 8:
          var lt = 0;
          var ll = funy_transition_width  / 100 * ( funy_currentOpacity);
          lh = funy_transition_height;
          break;

      case 9:
          var lt = funy_transition_height / 100 * ( funy_currentOpacity);
          var ll = 0;
          lw = funy_transition_width;
          break;

      //------------------------------------------------------         
      default:
          var lt = (funy_transition_height / 100 * ( funy_currentOpacity))/2;
          var ll = (funy_transition_width  / 100 * ( funy_currentOpacity))/2;
          break
      
     }


lt = lt.toFixed(0);
ll = ll.toFixed(0);
  if (lt < 0) lt = 0;
  if (ll < 0) ll = 0;
  if (lt > 1000) lt = 1000;
  if (ll > 1000) ll = 1000;
 
  funy_transition_obImg1.style.left = ll + "px";  
  funy_transition_obImg1.style.top  = lt + "px";
  
  funy_transition_obImg1.style.width  = lw + "px";  
  funy_transition_obImg1.style.height = lh + "px";  



	funy_currentOpacity = funy_currentOpacity - 1;
	
//alert ("la : ll = " + ll + " - lt = " + lt + " - lw = " + lw + " - lh =" lh);	

  //----------------------------------------------------
	if(funy_currentOpacity > 0 & funy_transition_isRunning){
	   //en prevision d'autre defets a venir: glisser, rebondi, ...
      //setTimeout('funy_transition_showZoomArriere()', 1);
      setTimeout('funy_transition_showZoomArriere(' + mode + ',' + delai + ')',1);      
	}else{
		//funy_transition_obImg1.style.visibility = 'hidden';
		//if(Opera)funy_transition_obImg1.style.display = 'none';
		funy_transition_run();
	}
}catch (e){
      setTimeout('funy_transition_showZoomArriere(' + mode + ',' + delai + ')',1);
}
}
	
/****************************************************************
 *
 ****************************************************************/ 

function funy_transition_init()
{
	funy_transition_container = document.getElementById('funy_transition_holder');
	//funy_transition_galleryWidth = funy_transition_container.clientWidth;
	//funy_transition_galleryHeight = funy_transition_container.clientHeight;
	
  //funy_transition_run();
      setTimeout('funy_transition_run()');
}


//-----------------------------------------
function funy_transition_start(){
  //alert("funy_transition_start");  
  funy_transition_isRunning = true;  
  funy_transition_init();	// Initialize the gallery
}
//-----------------------------------------
function funy_transition_stop(){
  //alert("funy_transition_stop");  
  funy_transition_isRunning = false;
}








