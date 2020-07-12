// Fichier JavaScript

var angle=0;
var timer;
var FlgDefilement = "Non";
var speed = 50;

function Affichage ()
{	
    for(i=1;i<13;i++)
    {
	var Gauche = 200+150*(Math.cos(angle+i*Math.PI/6));
        document.getElementById("i"+i).style.left=Gauche+"px";
	var Hauteur = 80+50*(Math.sin(angle+i*Math.PI/6))+document.getElementById("i"+i).width/2; 
        document.getElementById("i"+i).style.top=Hauteur+"px";
        agl=angle+i*Math.PI/6;
        document.getElementById("i"+i).width=20*(Math.sin(agl))+30;
        document.getElementById("i"+i).style.zIndex=50*(Math.sin(agl))+100;
        document.getElementById("i"+i).style.opacity=(Math.sin(agl)+1)*0.50;
        document.getElementById("i"+i).style.filter="alpha(opacity="+(Math.sin(agl)+1)*50+")";
	
    }  
}

function Defilement()
{
    switch (FlgDefilement)
    {
        case "Droite" :
             angle=angle-0.05;
            break;
        case "Gauche" :
             angle=angle+0.05;
            break;            
        default :
            angle=angle;
    }
    Affichage (); 
}

function DefilementDroite()
{
    if (FlgDefilement!="Droite")
    {
        FlgDefilement="Droite";
        timer=setInterval("Defilement()",speed);
    }   
}

function DefilementGauche()
{
    if (FlgDefilement!="Gauche")
    {
        FlgDefilement="Gauche";
        timer=setInterval("Defilement()",speed);
    }   
}

function ArretDefilement()
{
    clearInterval(timer);
    FlgDefilement="Non";
}

function Lien (LienRedirection)
{
    switch(LienRedirection.id)
    {
        case "i1" :
            document.location="http://intranet/agenda/"
            break;
        case "i2" :
            document.location="http://intranet/"
            break;
        case "i3" :
            document.location="http://intranet/Liste_Etudes/"
            break;
        case "i4" :
            document.location="http://intranet/adresses/"
            break;
        case "i5" :
            document.location="http://intranet/"
            break;
        case "i6" :
            document.location="http://intranet/"
            break;
        case "i7" :
            document.location="http://intranet/gesper/"
            break;
        case "i8" :
            document.location="http://intranet/"
            break;
        case "i9" :
            document.location="http://intranet/"
            break;
        case "i10" :
            document.location="http://intranet/"
            break;
        case "i11" :
            document.location="http://intranet/"
            break;
        case "i12" :
            document.location="http://intranet/"
            break;
    }
}

