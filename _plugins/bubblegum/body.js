
////////////////////////////////////////////////////////////////////////////////////////////////////////

function $(id)
{	// pour les inconditionnels de "prototype"
	return document.getElementById(id);
}

////////////////////////////////////////////////////////////////////////////////////////////////////////

function hex(x)
{	// convertit un octet numérique en un format "string hexadécimal"
	var s=Math.round(x).toString(16).toUpperCase();
	
	return (s.length==2)? s : '0'+s;
}

////////////////////////////////////////////////////////////////////////////////////////////////////////

function getgradient(color1,color2,n)
{	// renvoie un tableau de n dégradés allant des couleurs color1 à color2 comprises
	var 
		i,gradient=[],
		r0=(color1>>16)& 0xFF,
		g0=(color1>>8)& 0xFF,
		b0=(color1>>0)& 0xFF,
		r=(((color2>>16)& 0xFF)-r0)/(n-1),
		g=(((color2>>8)& 0xFF)-g0)/(n-1),
		b=(((color2>>0)& 0xFF)-b0)/(n-1);

	for (i=0;i<n;i++) gradient[i]='#'+hex(r0+r*i)+hex(g0+g*i)+hex(b0+b*i);
	
	return gradient;
}

// ici commence la classe //////////////////////////////////////////////////////////////////////////////

function animation(){}									// pas très original comme nom, mais bon...

////////////////////////////////////////////////////////////////////////////////////////////////////////

animation.prototype.sonjob=function(p)
{	// exécution du "processus fils"
	with (this.PROCESS[p]) {							// "chaud bouillant", les 2 blocs "with"	imbriqués!
		//alert ("t= " + t);
    if (t>=0) with ($('absolute'+charnum).style) {			// caractère en cours de traitement
			color=this.GRADIENT[t];
			fontSize = (this.INCR * t)+this.SIZEMIN + "px";		// calcul de la taille de police
			//zzz= this.INCR * t;
			//alert("this.INCR = " + this.INCR + " - t = " + t + " - fontsize = " + fontSize + " - zzz = " + zzz);
			top=((this.HEIGHT[0]-this.HEIGHT[t])/2)+"px";	// positionnements "top" et "left" du caractère
			left=(posleft+(this.WIDTH[charnum][0]-this.WIDTH[charnum][t])/2)+"px";
			t--;
		}	
		else {												// le traitement du caractère courant est terminé											
			if (charnum==this.CHARMAX-1) clearInterval(timer); // le processus est terminé : on le "tue"
			else {											// traitement d'un nouveau caractère
				t=this.TMAX-1;
				posleft+=(this.WIDTH[charnum++][0])+"px";
			}
		}
	}
}

////////////////////////////////////////////////////////////////////////////////////////////////////////

animation.prototype.createson=function(p)
{	// création d'un "processus fils" et initialisation de ses attributs
	var _this=this;			// astuce pour contourner le rejet de "this" dans la fonction "setInterval"
	
	return {
		t : this.TMAX-1,		// on commence par la taille de police la plus grande
		charnum : 0,			// n° du caractère en cours de traitement
		posleft : 0+"px",			// positionnement "left" de ce caractère dans la plus petite taille de police
		timer : setInterval(function(){_this.sonjob(p);},this.DELAY)	// identifiant du "processus fils"
	};
}

////////////////////////////////////////////////////////////////////////////////////////////////////////

animation.prototype.fatherjob=function()
{	// la tâche du "processus père" : créer ses 4 "processus fils" à intervalles réguliers
	this.PROCESS[this.PROCESSNUM]= this.createson(this.PROCESSNUM);
	if (++this.PROCESSNUM==this.PROCESSMAX) clearInterval(this.TIMER);		
}

//////////////////////////////////////////////////////////////////////////////////////////////////////// 

animation.prototype.createfather=function()
{	// démarre l'animation en créant le "processus père"
	var _this=this;			// astuce pour contourner le rejet de "this" dans la fonction "setInterval"
	
	this.TIMER=setInterval(function(){_this.fatherjob();},this.DELAY*this.DELTA);
/*

	if (funy_bubblegum_reprise > 0){
    funy_bubblegum_reprise --;
    //this.createfather();	
	  //setTimeout(function(){_this.createfather();}, 10000);    
	  alert ("reprise = "+ funy_bubblegum_reprise);	  
	  setTimeout(function(){_this.createfather();}, 30000);	  

  }
*/
}
 
////////////////////////////////////////////////////////////////////////////////////////////////////////

animation.prototype.init=function(logo)
{	// calculs et opérations préalables
	var i, j, len=logo.length, w, size,posleft, s='', div1=$('div1');
	
//div1.style.width  = "300px";
//div1.style.height  = "600px";
      
	// attribution de la première couleur 
	div1.style.color=this.GRADIENT[0];	
	// affichage du logo en positionnement "static"
	for (i=0;i<len;i++) 
		s+='<span id="static'+i+'" style="position:static; font-size:'+this.SIZEMIN+'px;">'+logo.charAt(i)+
			'</span>';
			
//		s+='<span id="static'+i+'" style="position:static; font-size:'+this.SIZEMIN*2+'px;">'+ "X" +
//			'</span>';

	div1.innerHTML=s;
	
	// calcul de la largeur w du logo et stockage de la largeur de chaque caractère dans chaque taille
	for (i=w=0;i<len;i++) with ($('static'+i)) {								// pour chaque caractère
		w+=offsetWidth;	
		this.WIDTH[i]=[];
		for (j=0,size=this.SIZEMIN;j<this.TMAX;j++,size+=this.INCR) {	// pour chaque taille
		//alert("j = " + j + " - size = " + size);
			style.fontSize=size;
			this.WIDTH[i][j]=offsetWidth;		
			if (!i) this.HEIGHT[j]=offsetHeight;	
		}
	}
	
	// centrage du logo
/*

alert (div1.id
      + " - lw = " + div1.style.width 
      + " - lh = " + div1.style.height
      + " - ll = " + div1.style.left      
      + " - lt = " + div1.style.top);    
      
*/        
	div1.style.width=w + "px";
	div1.style.marginLeft = funy_bubblegum_marginLeft + "px"; // (w/2);

	// maintenant, affichage du logo en positionnement "absolute"
	ll= div1.style.left;
	for (i=posleft=0,s='';i<len;posleft+=this.WIDTH[i][0],i++) {

		s+='<span id="absolute'+i+'" style="position:absolute; left:'+posleft+'px; font-size:'+this.SIZEMIN+
			'px; z-index:'+(len-i)+';">'+logo.charAt(i)+'</span>';
    
  }

//		s+='<span id="absolute'+i+'" style="position:absolute; left:'+posleft+'; font-size:'+this.SIZEMIN*2+
//			'px; z-index:'+(len-i)+';">'+"Y"+'</span>';
	div1.innerHTML=s;	
	//div1.innerHTML=">>>>>" + s + "<<<<<";	
	//alert ("posleft = " +	posleft );
	
	return len;
}

////////////////////////////////////////////////////////////////////////////////////////////////////////

animation.prototype.construct=function(logo,color1,color2)
{	// "constructeur" de la classe
	this.TMAX=15;			// nombre de tailles de police : en partant de SIZEMIN par incrément de INCR
	this.SIZEMIN=30;		// en pixels, plus petite taille de police
	this.INCR=6;			// sert à calculer les tailles successives de police
	this.CHARMAX=0;		// nombre de caractères du logo
	this.WIDTH=[];			// tableau 2 dimensions des largeurs de chaque caractère dans chaque taille de police
	this.HEIGHT=[];		// tableau 1 dimension de la hauteur de chaque taille de police 
	this.GRADIENT=[];		// tableau des dégradés : un pour chaque taille de police
	this.TIMER=0;			// identifiant du "processus père"
	this.PROCESS=[];		// tableau des "processus fils" créés
	this.PROCESSMAX= funy_bubblegum_processMax ;	// nombre de "processus fils" à créer
	this.PROCESSNUM=0;	// n° du "processus fils" à créer
	this.DELTA=13;			// nombre de "DELAY" séparant la création de 2 "processus fils" consécutifs
	this.DELAY=30;			// en ms, laps de temps séparant, pour chaque "processus fils", le traitement de 2...
								// tailles consécutives du même caractère
								
	// calcul des couleurs (foncé pour les petits caractères -> clair pour les gros)
	this.GRADIENT=getgradient(color1,color2,this.TMAX);
	// calcul des dimensions des caractères dans les différentes tailles de polices
	this.CHARMAX=this.init(logo);
	// lancement de l'animation proprement dite
	this.createfather();	
	//this.createfather();  							
}

////////////////////////////////////////////////////////////////////////////////////////////////////////
function testdiv(){
var  div1=$('div1');
	div1.innerHTML="testdiv";  
}
////////////////////////////////////////////////////////////////////////////////////////////////////////
function funy_bubblegum_start(){
  
  obj.construct(funy_bubblegum_logo, "0x" + funy_bubblegum_color1, "0x" + funy_bubblegum_color2);
  
	
  if (funy_bubblegum_reprise != 0 ){
    funy_bubblegum_reprise --;
    //if (funy_bubblegum_reprise != 1 ) funy_bubblegum_reprise --;    
    //this.createfather();	
	  //setTimeout(function(){_this.createfather();}, 10000);    
	  //alert ("reprise = "+ funy_bubblegum_reprise);	  
	  setTimeout(" funy_bubblegum_start()", funy_bubblegum_delai * 1000);	  

  }

}

////////////////////////////////////////////////////////////////////////////////////////////////////////
function funy_bubblegum_stop(){
  

}
////////////////////////////////////////////////////////////////////////////////////////////////////////

//alert ("bulle");
var obj=new animation();
//obj.construct('MONLOGO',0x336699,0x99CCCC);

// testdiv();
funy_bubblegum_reprise-- ;
funy_bubblegum_start();

