<?php
//  ------------------------------------------------------------------------ //
//       FUNY - Module de gestion de  JAVASCRIPT pour XOOPS                  //
//                    Copyright (c) janvier 2008 JJ Delalandre               //
//                       <http://xoops.kiolo.com>                            //
//  ------------------------------------------------------------------------ //
/******************************************************************************

Ce programme est libre, vous pouvez le redistribuer et/ou le modifier selon
les termes de la Licence Publique Générale GNU publiée par la Free Software 
Foundation (version 2 ou bien toute autre version ultérieure choisie par vous). 

Ce programme est distribué car potentiellement utile, 
mais SANS AUCUNE GARANTIE, ni explicite ni implicite, 
y compris les garanties de commercialisation ou d'adaptation 
dans un but spécifique. Reportez-vous à la Licence Publique Générale GNU 
pour plus de détails. 

Vous devez avoir reçu une copie de la Licence Publique Générale GNU 
en même temps que ce programme ; si ce n'est pas le cas, 
écrivez à la 
               Free Software Foundation, Inc., 
               59 Temple Place, Suite 330, 
            Boston, MA 02111-1307, +tats-Unis. 

Créeation janvier 2007
Dernière modification : janvier 2009 
******************************************************************************/

/***********************************************************************
 * construit la ligne de titre secondaire de la section d'option du lexique
 ***********************************************************************/
function buildTitleOption4a($title, $description = '', $nbCol = 2, 
                           $fontColor = 'FFFFFF', 
                           $hrBefore = true, $hrAfter = false){
  
    $t = array();
    //-------------------------------------------
    if ($hrBefore){
      //$t[] = "<TR><td colspan='{$nbCol}'>{$hrb}</td></TR>\n";   
      $t[] = buildHR(1,'839d2d', $nbCol); 
    }
    $t[] = "<TR>";
    $t[] = "<TD align='left' colspan='{$nbCol}'><B><font color='#{$fontColor}'>{$title}</font></B>";
        
    if ($description <> ""){  
    $t[] = "<br><i><font color='#{$fontColor}'>{$description}</font></i>";    
    } 
    
    $t[] = "</TR></TD>";
    
    if ($hrAfter){
      //$t[] = "<TR><td colspan='{$nbCol}'>{$hrb}</td></TR>\n";   
      $t[] = buildHR(1,'839d2d', $nbCol);       
    }
    
    //-------------------------------------------
    return implode(_br, $t)._br;

}

/*********************************************************************

**********************************************************************/
function getFileLang($fullName, $shortName, $extension=""){
 	global $xoopsModuleConfig, $xoopsDB, $xoopsModule, $xoopsConfig;
    
    if (substr($fullName, -1, 1) <> '/'){
        $fullName = dirname($fullName) .'/';
    };
    
    $language = $xoopsConfig['language'];    
    $f =  $fullName . 'language/' . $language . '/' . $shortName . (($extension == '') ? '': '.'.$extension);
    //echo "<hr>$file<br>$f<hr>";
    
    return $f;
    
}


/****************************************************************************
 * transforme une liste de checkbox en valeur numerique binaire
 ****************************************************************************/
function checkBoxToBinA($t, $value = 'on', $colId='id', $colValue='value'){
  //displayArray($t, "****** checkBoxToBinA *************");
  $b = 0; //initialisation de da valeur binaire
  
  if (count($t) > 0){
    for ($h = 0; $h < count($t); $h++){
        if (isset($t[$h][$colValue])){

          //if ($list[$h][$name] ==  $value) $b += pow(2,$h);
          $b += pow(2,$h);   
        //echo "$h - $b";               
        } 
    }
  }  


  
  //-----------------------------------------------------------  
  return $b;

}

/****************************************************************************
 * transforme une liste de checkbox en valeur numerique binaire
 ****************************************************************************/
function binToList($b, $nbBit=32, $sep =','){
  
  $t = array();
  for ($h = 0; $h < $nbBit; $h++){
    if (isBitOk($h, $b)) $t[] = $h;
  
  }
  
  //-----------------------------------------------------------  
  $list = implode($sep, $t);
  return $list;

}

?>
