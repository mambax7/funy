<?php

class cls_waterEffect{  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
 
/**************************************************************************
version et nom du script
 *************************************************************************/
  var $version      = '1.1.02';  
  var $name =  'Water effect';
  
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
  function  cls_waterEffect($options){
    $this->ini = $options;
  }
  
////////////////////////////////////////////////////////////////////////////

function render(){


$p = $this->ini;
//displayArray($p, "------render-------");


$fps          = $p['fps']['value'];

//$widthDiv     = $p['widthDiv']['value'];
//$heightDiv    = $p['heightDiv']['value'];

//$width        = $p['width']['value'];
//$height       = $p['height']['value'];
$message      = $p['message']['value'];
$errorMessage = $p['errorMessage']['value'];
$alignement   = $p['alignement']['value'];
$bgColor      = $p['bgColor']['value'];

$t = array('left','center','right');
$align = $t[$alignement];
//$p['image']['value'] = "billard.jpg";
//$p['image']['value'] = "truhe_ani.gif";

   if (isset ($p['image']['folder'])){
    $folder   = XOOPS_URL .'/' . $p['image']['folder'];             
   }else{
    $folder   = XOOPS_URL .'/' . $p['folder_img']['value'];             
   }
  $f = $folder . $p['image']['value'];
  //-------------------------------------
  $img        = imagecreatefromjpeg($f);
  $width      = imageSX($img);
  $height     = imageSY($img);
  $widthDiv   = $width;
  $heightDiv  = $height;

  $java =  '';  

  $we = "<center><div style=\"width:{$widthDiv}px; height: {$heightDiv}px; background-color: #{$bgColor};\" align={$align}>\n"
      . "      <applet code=\"{$java}water.class\" name=\"bump\" width=\"{$width}px\" height=\"{$height}px\">\n"
      . "        <param name=\"fps\" value=\"{$fps}\">\n"
      . "        <param name=\"image\" value=\"{$f}\">\n"
      . "        alt=\"{$errorMessage}\n"
      . "      </applet>\n"
      . ($message <> '' ? "	<br>{$message}\n" : '')  
      . "</div>\n</center>";

/*
$ws = str_replace ("<", "&lt;", $we);
$ws = str_replace (">", "&gt;", $ws);
echo "<hr><pre>{$ws}</pre><hr>";
*/

  
  return $we;

}

//------------------------------------------------------
} //fin de la classe

?>