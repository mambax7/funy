<?php

/**************************************************************************
 * Ce sript pertmet de faire défiler de manière aléatoire des images de même dimention
 * dans un block prédéfini .
 * Le script original provient du site 	www.dhtmlgoodies.com 
 * Il ne permetait de faire défiler que des miniatures sur un des côté de XOOPS 
 * Je l'ai largement modifié dans sa partie PHP principalement pour répondre à mes besoins
 *  
 * Ajouts et modifications 
 * ------------------------ 
 * Calcul automatique de la taille des images. toutes les images doivent avoir 
 * la même taille, mais cette taille peut être différentes selon le jeu dimages.
 * L'ancienne option à été conserver, il suffit de remettre la variable $modeSize à zéro
 * Il est donc possible à présent de le metttre au centre avec des images plus grandes
 *  
 * Le repertoire ou se trouve les image doit être dans le dossier uploads de Xoops
 * mais le sous-dossier peut être changé plus facilement, il suffit de modifier la variable $folder
 * 
 * Le nombre d'image à été rendu automatique pour la construction du JavaScript
 * $nbImages est le nombre d'image du slideShow sélectionnée dans la liste 
 *    répondant au critère de filtre énoncé plus pas 
 * Il suffit juste de modifier la variable $nbImages. 
 * Si $nbImages = zéro ou plus grand que le nombre d'images disponibles, 
 *    $nbImages prends * la totalité de la séléction.
 * Il est possible à présent de ne selectionner q'une seule image, 
 *    cela donne un effet de battement de coeur.
 * 
 *
 * Ajout d'options de filtrage dans la construction de la liste des images sélectionables.
 *    $prefixe   : Filtre tous les fichiers qui commencent par ce préfixe
 *    $extention : Filtre tous les fichiers qui finissent par ce suffixe en général une extention  
 *    $caseSensitiveOnPrefixe : Filtre sur la casse de $prefise et $extention  (serveur linux uniquement)           
 *    $caseSensitiveOnExtention : Filtre sur la casse de $extention et $extention (serveur linux uniquement)   
 * 
 * Ajout d'une légende optionnelle au dessus ou au dessous ($legendTop et $legendBottom);
 * Cette légende peut être du code HTML comme une adresse HTML 
 * 
 * Ajout de la possibilité de paramètrer le slide: 
 *    $timeBetweenSlides = délai en millieme de seconde entre chaque afichage
 *    $fadingSpeed       = rapidite de l'stompage  valeur plus petite = plus rapide
 *    $currentOpacity    = opacité initiale
 *  
 * Ajout d'option de debugage. 
 * si_DEBUG = true, les noms des fichier sont afficés sur la page ainsi 
 *  que d'autre information utilies pour les tests 
 * Il ne faut as oublier de remetre _Degug a false avant la mise en prod
 ***************************************************************************                 
 * Installation
 * Créer un bloqck, copier ce script dans le block
 * spécifiez que c'est un script PHP
 * n'oubliez pas de modifier les paramètres selon vos besoins    
 ***************************************************************************
 * Licence: c'est la même que celle du script d'origine
 *          je vous demanderais de garder aussi dans les commentaire 
 *          mes références en plus de celles des auteurs d'origine  
 ***************************************************************************
 * script 
 * original     : (C) www.dhtmlgoodies.com, November 2005 
 * modification : Jean-Jacques DELALANDRE le 22/08/2006.
 * eMail        : jjd@kiolo.com
 * site         : http://ace.wakasensei.fr  
 **************************************************************************/
/**************************************************************************
constantes definies pour la fonction d'affichage des infos de debugage
c'est la somme binaire de ces constante qui sera utilisé par la fonction
ex: si on veut envoyer le message "Hele sur une ligne cadre à gauche précédée 
par un trait horizontale, et suivi d'un retour à la ligne il faudra passer en parametres:
    _HTML_LINE_BEFORE | _HTML_LEFT | _HTML_CRLF_AFTER
on peut aussi utiliser le signe "+" au lieu de "|" , mais attention aux valeurs passees en doublon
    _HTML_LINE_BEFORE | _HTML_LEFT | CRLF_AFTER | CRLF_AFTER   sera correct malgre le doublon CRLF_AFTER 
    _HTML_LINE_BEFORE + _HTML_LEFT + CRLF_AFTER + CRLF_AFTER   sera incorrect et ne donnera pas le résultat excompté  
*************************************************************************/


//valeur de base
define ("_HTML_NONE",             0);
define ("_HTML_CRLF_BEFORE",      1);
define ("_HTML_CRLF_AFTER",       2);
define ("_HTML_BEGIN_LEFT",       4);
define ("_HTML_END_LEFT",         8);
define ("_HTML_LINE_BEFORE",     16);
define ("_HTML_LINE_AFTER",      32);

//valeur composite
define ("_HTML_ONLINE_ALONE",     3);
define ("_HTML_ONLEFT_ALONE",    15);
define ("_HTML_LINES",           48);
define ("_HTML_LEFT",            12);


class cls_fondu{  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
 
/**************************************************************************
version et nom du script
 *************************************************************************/
  var $version      = '1.1.08';  
  var $name =  'Fondu';
  
/**************************************************************************
tableau de parametre du fichier ini
 *************************************************************************/
var $ini;
            
/**************************************************************************
si vrai affiche la liste des fichier selectionné, 
a utiliser uniquement pour faire des tests
ne pas oublier de la remmetre à false in fine
 *************************************************************************/
    var $_DEBUG = false;



/************************************************************
 * Constructucteur:
 ************************************************************/
  function  cls_fondu($options){
    $this->ini = $options;
  }
  
////////////////////////////////////////////////////////////////////////////



/***************************************************************************
* Renvoie un tableau du chemin complet des fichier répondant aux critères
* passé en paramèrtes
* permet de filtrer sur un prefixe et sur l'extention
* auteur: Jean-Jacques DELALANDRE
* 
function fondu_getFiles(){
***************************************************************************/
function fondu_getFiles($chemin, 
                        $prefixe = "" , 
                        $extention = "*", 
                        $caseSensitiveOnPrefixe   = false, 
                        $caseSensitiveOnExtention = false){


$_DEBUG = $this->_DEBUG;

//echo "<hr>fondu_getFiles - echo : {$_DEBUG}<br>extension = {$extention}<br>{$chemin}<hr>";

  $tFiles = array ();
  if (substr($chemin, -1, 1) <> "/"){$chemin .= "/";}

  if ($_DEBUG){
    $this->jdecho ($chemin, _HTML_ONLINE_ALONE + _HTML_BEGIN_LEFT);
    $this->jdecho ("Prefixe cs =".(($caseSensitiveOnPrefixe)?"True":"False")." = '".$prefixe."'", _HTML_CRLF_AFTER);
    $this->jdecho ("Extention cs =".(($caseSensitiveOnExtention)?"True":"False")." = '".$extention."'", _HTML_LINE_AFTER + _HTML_END_LEFT);
  }


  if ($caseSensitiveOnPrefixe && $caseSensitiveOnExtention){
    if ($extention == "" or $extention == "." ) {$extention = ".*" ;}
    if (substr($extention,0,1)<> ".") {$extention = ".".$extention ;}
    $modele = $chemin.$prefixe.'*'.$extention ;
    if ($_DEBUG){$this->jdecho ("Modele = ".$modele, _HTML_ONLEFT_ALONE);}
  
    $tFiles = glob($modele);
    }
  
  else {
      $prefixe   = str_replace("*", "", $prefixe);
      $extention = str_replace("*", "", $extention);
      
      $lgPrefixe   = strlen($prefixe);
      $lgExtention = strlen($extention);
      
      $repertoire = opendir($chemin);
      
      if ($_DEBUG){$this->jdecho ("", _HTML_BEGIN_LEFT);}
    
      while ($fichier = readDir($repertoire)){
        if ($_DEBUG){$this->jdecho ($fichier." = ", _HTML_CRLF_BEFORE );}

       //--------------------------------------------------------        
        if ($fichier == "." or $fichier == ".."){ continue;}
        //--------------------------------------------------------        
        if ($lgPrefixe > 0){
          if (caseSensitiveOnPrefixe){
            if ( strncmp( $fichier, $prefixe, $lgPrefixe) <> 0 ){ continue;}
          }
          else {
            if ( strncasecmp( $fichier, $prefixe, $lgPrefixe) <> 0 ){ continue;}
          }
        } 
        //--------------------------------------------------------        
        if ($lgExtention > 0){
          $tmp = substr($fichier, -$lgExtention, $lgExtention) ;
          if ($caseSensitiveOnExtention){
            if ( strncmp( $tmp, $extention, $lgExtention) <> 0 ){ continue;}          }
          else {
            if ( strncasecmp( $tmp, $extention, $lgExtention) <> 0 ){ continue;}
          }
        } 
        //--------------------------------------------------------        
        
        $tFiles [] = $chemin.$fichier;
        if ($_DEBUG){$this->jdecho ("ok", _HTML_NONE);}
      } 
    closeDir ($repertoire); 
    if ($_DEBUG){$this->jdecho ("---Fin de fondu_getFiles----------------------", _HTML_CRLF_BEFORE + _HTML_END_LEFT + _HTML_LINE_AFTER);}
    
  }
  
  return $tFiles;
}

/***************************************************************************
fonction d'affiche des information de debugage
auteur: Jean-Jacques DELALANDRE
***************************************************************************/
function jdecho ($expression, $flag = _HTML_NONE){

  if (!$this->_DEBUG) {return;}

  if (($flag &  _HTML_LINE_BEFORE) <> 0){echo '<hr>';}
  if (($flag &  _HTML_CRLF_BEFORE) <> 0){echo '<br>';}
  if (($flag &  _HTML_BEGIN_LEFT)  <> 0){echo '<p align="left">';}

  echo $expression;

  if (($flag &  _HTML_END_LEFT)    <> 0){echo '</p>';}
  if (($flag &  _HTML_CRLF_AFTER)  <> 0){echo '<br>';}
  if (($flag &  _HTML_LINE_AFTER)  <> 0){echo '<hr>';} 
}





/************************************************************************
 *
 ************************************************************************/
function buildFondu(){
/***************************************************************************
Parametrage du SlideShow
***************************************************************************/
$p = $this->ini;

$folder = $p['folder']['value'];
$prefixe = $p['prefixe']['value'];
$extention = $p['extention']['value'];
$caseSensitiveOnPrefixe = $p['caseSensitiveOnPrefixe']['value'];
$caseSensitiveOnExtention = $p['caseSensitiveOnExtention']['value'];
$modeSize = $p['modeSize']['value'];
$fadingSpeed = $p['fadingSpeed']['value'];
$currentOpacity = $p['currentOpacity']['value'];
$timeBetweenSlides = $p['timeBetweenSlides']['value'];
$legendTop= $p['legendTop']['value'];
$legendBotom = $p['legendBotom']['value'];

//displayArray($this->ini, "------buildFondu--------");
/*
echo "<hr>$folder{}<br>$prefixe{}<br>{$extention}<br>"
     ."{$caseSensitiveOnPrefixe}<br>{$caseSensitiveOnExtention}<br>{$modeSize}";



 = $p['']['value'];
 = $p['']['value'];
 = $p['']['value'];
 = $p['']['value'];
 = $p['']['value'];
*/

/***************************************************************************
Nombre d'image sélectionnées pour l'afichage dans la moulinette - 0 = toutes
***************************************************************************/
$nbImages = 0;

/**************************************************************************
Défitinition de la taille par defaut
j'ai gardé cette option pour garder la compatibilité avec le script d'origine
 *************************************************************************/
$thumbWidthDefault  = 141;
$thumbHeightDefault = 100;


/***************************************************************************
Construction de la liste des images
***************************************************************************/

    $images = array();
    $f = str_replace("//", "/", XOOPS_UPLOAD_PATH.'/'.$folder.'/');


    
    $images = $this->fondu_getFiles($f, $prefixe, $extention, 
                             $caseSensitiveOnPrefixe, $caseSensitiveOnExtention);
                             
/*    
    $images = $t = $this->fondu_getFiles();
*/    

    $tbluneimage = array();
    srand((double) microtime() * 10000000);
    $tImagesSelected = array();
    
    //si le nombre d'images est zéro ou plus grand que le nombre d'image disponible on les prends toutes
    if ($nbImages == 0 or $nbImages > count($images)){ $nbImages = count($images);}
    
    /*
    si le nombre d'image est 1 on les prends une image au hazard et 
    on cre un tableau de 2 itel aec la meme image, sinon il y un blanc pas tres élégant
    */
    if ($nbImages == 1){
      $tbluneimage[] = array_rand($images, $nbImages );
      $tbluneimage[] = $tbluneimage[0] ;
    }
    else{
      $tbluneimage = array_rand($images, $nbImages );
    }
    
    
    //construction de la liste des images a insérer dans le script
    foreach($tbluneimage as $uneimage) {
      $img =  XOOPS_UPLOAD_URL.'/'.$folder.'/'.basename($images[$uneimage]);
    	$tImagesSelected[] = '<img src="'.$img.'">';
    	//echo "==>".$img."<br>";
    }
    
    //initialisation de la chaine à inserer dans la liste dans la page HTML (voir $headerArray)
    $sep = chr(13).chr(10);
    $lstImages = implode($sep, $tImagesSelected); 
    
    /***************************************************************************
    Calcule la taille des images
    ***************************************************************************/
    if ($modeSize == 0){
      /***************************************************************************
      taille prédéfinie par les constantes
      ***************************************************************************/
      $thumb_width  = $thumbWidthDefault.'px';
      $thumb_height = $thumbHeightDefault.'px';
    }
    else {
      /***************************************************************************
      Recupere la taille de la preiiere image qui servira pour toutes les images
      toutes les images du répertoires doivent donc avoir la meme taille
      ***************************************************************************/
      //echo "<hr>{$images[0]}<hr>";
      $img = imagecreatefromjpeg($images[0]);
      $thumb_width  = imageSX($img).'px';
      $thumb_height = imageSY($img).'px';
      
      /*
      

      $thumb_width  = '300'.'px';
      $thumb_height = '300'.'px';
      */      
    }



/**************************************************************************
Défitinition du style CSS pour le block 
 *************************************************************************/
$headerStyle = <<<fintexte
<style type="text/css">
	#imageSlideshowHolder{
		margin:5px;	/* "Air" */
		width:  {$thumb_width};	 /* Image width 141*/
		height: {$thumb_height};	/* Image height 100*/
		position:relative;	/* Don't remove this line */
		align:center;
	}

	/* Don't change these values */
	#imageSlideshowHolder img{
		position:absolute;
		left:0px;
		top:0px;
	}
	</style>
fintexte;

/**************************************************************************
Insertion des scripts Javascript
 **************************************************************************/
$headerScript = <<<fintexte
	<script type="text/javascript">
	/************************************************************************************************************
	(C) www.dhtmlgoodies.com, November 2005

	This is a script from www.dhtmlgoodies.com. You will find this and a lot of other scripts at our website.

	Terms of use:
	You are free to use this script as long as the copyright message is kept intact. However, you may not
	redistribute, sell or repost it without our permission.

	Thank you!

	www.dhtmlgoodies.com
	Alf Magne Kalleland
  -------------------------------------------------------------------------------------------------------------
  modified by Jean-Jacques DELALANDRE - 21/08/2006 - jjd@kiolo.com
  I wood to show the block in the center with more easly parametters
  - add of the automatique calcul of the size
  - add of constants to parametters easly
	************************************************************************************************************/

	var slideshow2_noFading = false;
	var slideshow2_timeBetweenSlides = $timeBetweenSlides;	// Amount of time between each image(1000 = 1 second)
	var slideshow2_fadingSpeed       = $fadingSpeed;      	// Speed of fading	(Lower value = faster)
	var slideshow2_currentOpacity    = $currentOpacity;	    // Initial opacity

	var slideshow2_galleryContainer;	// Reference to the gallery div
	var slideshow2_galleryWidth;	// Width of gallery
	var slideshow2_galleryHeight;	// Height of galery
	var slideshow2_slideIndex = -1;	// Index of current image shown
	var slideshow2_slideIndexNext = false;	// Index of next image shown
	var slideshow2_imageDivs = new Array();	// Array of image divs(Created dynamically)
	var slideshow2_imagesInGallery = false;	// Number of images in gallery
	var Opera = navigator.userAgent.indexOf('Opera')>=0?true:false;
	
	var slideshow2_run = true;
	
	//-------------------------------------------------------------
	function createParentDivs(imageIndex)
	{
		if(imageIndex==slideshow2_imagesInGallery){
			showGallery();
		}else{
			var imgObj = document.getElementById('galleryImage' + imageIndex);
			if(Opera)imgObj.style.position = 'static';
			slideshow2_imageDivs[slideshow2_imageDivs.length] =  imgObj;
			imgObj.style.visibility = 'hidden';
			imageIndex++;
			createParentDivs(imageIndex);
		}
	}

	function showGallery()
	{
		if(slideshow2_slideIndex==-1)slideshow2_slideIndex=0; else slideshow2_slideIndex++;	// Index of next image to show
		if(slideshow2_slideIndex==slideshow2_imageDivs.length)slideshow2_slideIndex=0;
		slideshow2_slideIndexNext = slideshow2_slideIndex+1;	// Index of the next next image
		if(slideshow2_slideIndexNext==slideshow2_imageDivs.length)slideshow2_slideIndexNext = 0;

		slideshow2_currentOpacity=100;	// Reset current opacity

		// Displaying image divs
		slideshow2_imageDivs[slideshow2_slideIndex].style.visibility = 'visible';
		if(Opera)slideshow2_imageDivs[slideshow2_slideIndex].style.display = 'inline';
		if(navigator.userAgent.indexOf('Opera')<0){
			slideshow2_imageDivs[slideshow2_slideIndexNext].style.visibility = 'visible';
		}

		if(document.all){	// IE rules
			slideshow2_imageDivs[slideshow2_slideIndex].style.filter = 'alpha(opacity=100)';
			slideshow2_imageDivs[slideshow2_slideIndexNext].style.filter = 'alpha(opacity=1)';
		}else{
			slideshow2_imageDivs[slideshow2_slideIndex].style.opacity = 0.99;	// Can't use 1 and 0 because of screen flickering in FF
			slideshow2_imageDivs[slideshow2_slideIndexNext].style.opacity = 0.01;
		}


		if (slideshow2_run) setTimeout('revealImage()',slideshow2_timeBetweenSlides);
	}

	function revealImage()
	{
		if(slideshow2_noFading){
			slideshow2_imageDivs[slideshow2_slideIndex].style.visibility = 'hidden';
			if(Opera)slideshow2_imageDivs[slideshow2_slideIndex].style.display = 'none';
			showGallery();
			return;
		}
		slideshow2_currentOpacity--;
		if(document.all){
			slideshow2_imageDivs[slideshow2_slideIndex].style.filter = 'alpha(opacity='+slideshow2_currentOpacity+')';
			slideshow2_imageDivs[slideshow2_slideIndexNext].style.filter = 'alpha(opacity='+(100-slideshow2_currentOpacity)+')';
		}else{
			slideshow2_imageDivs[slideshow2_slideIndex].style.opacity = Math.max(0.01,slideshow2_currentOpacity/100);	// Can't use 1 and 0 because of screen flickering in FF
			slideshow2_imageDivs[slideshow2_slideIndexNext].style.opacity = Math.min(0.99,(1 - (slideshow2_currentOpacity/100)));
		}
		if(slideshow2_currentOpacity>0 & slideshow2_run){
			setTimeout('revealImage()',slideshow2_fadingSpeed);
		}else{
			slideshow2_imageDivs[slideshow2_slideIndex].style.visibility = 'hidden';
			if(Opera)slideshow2_imageDivs[slideshow2_slideIndex].style.display = 'none';
			showGallery();
		}
	}

	function initImageGallery()
	{
		slideshow2_galleryContainer = document.getElementById('imageSlideshowHolder');
		slideshow2_galleryWidth = slideshow2_galleryContainer.clientWidth;
		slideshow2_galleryHeight = slideshow2_galleryContainer.clientHeight;
		galleryImgArray = slideshow2_galleryContainer.getElementsByTagName('IMG');
		for(var no=0;no<galleryImgArray.length;no++){
			galleryImgArray[no].id = 'galleryImage' + no;
		}
		slideshow2_imagesInGallery = galleryImgArray.length;
		createParentDivs(0);

	}
//-----------------------------------------
function funy_fondu_start(){
  //alert("funy_fondu_start");  
  slideshow2_run = true;  
  initImageGallery();	// Initialize the gallery
}
//-----------------------------------------
function funy_fondu_stop(){
  //alert("funy_fondu_stop");  
  slideshow2_run = false;
}

	</script>
fintexte;
  

/***************************************************************************
construction du tableau pour le script
***************************************************************************/
$headerArray = 


$headerArray = <<<fintexte
<div align='center'>
	<div id="imageSlideshowHolder">
	  $lstImages
	</div>
</div>
<script type="text/javascript">
initImageGallery();	// Initialize the gallery
</script>
fintexte;

/***************************************************************************
On envoie la soudure
***************************************************************************/
//echo "<hr>On envoie la soudure<hr>";
$t = array();
    
    if ($legendTop <> ""){ $t[] = "<center>".$legendTop."</center>";}
    $t[] = $headerStyle;
    $t[] = $headerScript;
    $t[] = $headerArray;
    if ($legendBotom <> ""){$t[] = "<center>".$legendBotom."</center>";}
        
    return $t;
}


function render(){
    $t = $this->buildFondu();
    
    //$code =  implode ("\n", $t);
    //echo "<hr><code>{$code}</code></hr>";
    return implode ("\n", $t);
}



///////////////////////////////////////////////////////////////
}// fin de la classe  /////////////////////////////////////////
///////////////////////////////////////////////////////////////


 







/***************************************************************************/

/*

switch ($_POST['op']){
  case 'getFiles'
    $t = fondu_getFiles($_POST);
    break;
    
    default:
      break;
  
}
*/

?>