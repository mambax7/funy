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


/*********************************************************************

**********************************************************************/
function getBalisesInserted($theme){
global $xoopsDB;
   $tBalises = getBalisesInsertedA($theme);
   $t = array();
   while (list($key, $tb) = each($tBalises)) {
    if($tb['actif'] == 1){      
      $b1 = '<strong>';
      $b2 = '</strong>'; 
    }else{      
      $b1 = '';
      $b2 = ''; 
    }      
           
    $t[] = "{$b1}<code>({$tb['idBalise']})={$tb['smarty']}</code>{$b2}";    
   
   } 
   
   return  "|" . implode(" || ", $t) . "|";
}
/*********************************************************************

**********************************************************************/
function getBalisesToInsertedInbloc($sep = "\n"){
global $xoopsConfig;

   $tBalises = getBalisesInsertedA($xoopsConfig['theme_set'], 0);
   $t = array();
   while (list($key, $tb) = each($tBalises)) {
    $t[] = str_replace("%%", "\n",$tb['smarty']);    
   } 
   
   return  implode($sep, $t);
}

/*********************************************************************

**********************************************************************/
function getBalisesInsertedA($theme, $mode=1){
//mode = 1=balise insérées
//mode = 0=balise non sérées
global $xoopsDB;
   
  //$fds = XOOPS_URL."/themes/{$xoopsConfig['theme_set']}/style.css";  
  $fds1 = XOOPS_ROOT_PATH."/themes/{$theme}/theme.html"; 
  //-------------------------------------------------------  
  //verifie si le fichier d'origine existe, si non le cré
  //-------------------------------------------------------
  //echo "<hr>{$fds1}<br>{$fds2}<hr>";  
  if (!file_exists ($fds1)){
    return array();
  }
  //-------------------------------------------------------  
  //recherche des balise
  //-------------------------------------------------------  
  $sqlquery = db_getBalises();
  
  //------------------------------------------------------- 
  //charge le contenu de l'original et traite les balises
  //-------------------------------------------------------  
  $content = file_get_contents($fds1);
  $t = array();
    
  while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {

    //$find = stristr($content, "a");
    //$find = '';
    //echo "<hr><code>{$sqlfetch['smarty']}<br>{$find}</code>";    
    $smarty = str_replace('%%', "\n", $sqlfetch['smarty']);
    $r = stristr($content, $smarty);
    if ((!($r === false) & $mode==1 ) | (($r === false) & $mode==0 & $sqlfetch['actif']==1)){
      $t[$sqlfetch['idBalise']] = $sqlfetch;
    }
  }
  
  //displayArray($t, "getBalisesInsertedA");
  return $t;
}



/*********************************************************************

**********************************************************************/
function db_updateBalises($plugins){
   //displayArray ($plugins, "---------db_updateBalises----------");
   
   while (list($kPlugin, $tp) = each($plugins)) {
     //echo "<hr>{$kPlugin}";   
     while (list($kSection, $ts) = each($tp)) {   
      //echo "{$kSection}<br>";     
      if (!isset($ts['type'])) $ts['type'] = 0;
      if ($ts['type'] == 999){
        //echo "{$kSection}->>>-{$kPlugin}<br>";
        db_setNewBalise($kSection, $ts);        
      }      
     }
   
   }

}
 

/*********************************************************************

**********************************************************************/
function db_setNewBalise($balise, $params){
global $xoopsDB;

 $existe = getScalaire(_FUN_TAB_BALISE, "nom", "nom like '$balise'", 'count');
 if ($existe > 0) return;
 
 if (!isset($params['position'])) $params['position'] = 0;   
 if (!isset($params['instance'])) $params['instance'] = 0; 
 if (!isset($params['ordre']))    $params['ordre'] = 0; 
 if (!isset($params['actif']))    $params['actif'] = 1; 
 if (!isset($params['unkill']))   $params['unkill'] = 0; 
 
 $sql = "INSERT INTO "._FUN_TFN_BALISE
 . "(nom,	repere,	smarty,	position,	instance,	ordre, actif,	unkill)"
 . "values ('{$balise}',"
 .         "'{$params['repere']}',"
 .         "'{$params['smarty']}'," 
 .         "{$params['position']},"
 .         "{$params['instance']},"
 .         "{$params['ordre']},"
 .         "{$params['actif']}," 
 .         "{$params['unkill']})";
 
 //echo "<hr>{$sql}<hr>";
 $sqlquery = $xoopsDB->queryF($sql);  
}
 
/*********************************************************************

**********************************************************************/
function db_getBalises($idBalise = 0){
global $xoopsDB;
  
  $sql = "SELECT * FROM "._FUN_TFN_BALISE
       .(($idBalise == 0) ? '': " WHERE idBalise = {$idBalise}")
       ." ORDER BY ordre,nom,idBalise";
    //echo '<hr>JJD-'.$sql.'<hr>';          
    $sqlquery = $xoopsDB->query ($sql);  
    return $sqlquery;

}

/*****************************************************************
 *
 *****************************************************************/
function restaureBalise2theme($sheetStyle){
Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
  
  $fds1 = XOOPS_ROOT_PATH."/themes/{$sheetStyle}/theme.html";
  $fds2 = XOOPS_ROOT_PATH."/themes/{$sheetStyle}/theme.html.old";  
  //echo "<hr>restaureBalise2theme<br>{$sheetStyle}<hr>";
  //echo "<hr>{$fds1}<br>{$fds2}<hr>";  
  //-------------------------------------------------------  
  //verifie si le fichier d'origine existe, sinon on sort
  //-------------------------------------------------------
  //echo "<hr>{$fds1}<br>{$fds2}<hr>";  
  if (file_exists ($fds2)){
    $r = copy ($fds2, $fds1 );
  }else{
    $r = false;
  }

  return $r;    
}
/*****************************************************************
 *
 *****************************************************************/
function getBalisepositions(){
  return array(_AD_FUN_REPLACE,_AD_FUN_BEFORE,_AD_FUN_AFTER);
}

/*****************************************************************
 *
 *****************************************************************/
function afecterBalise2theme($sheetStyle){
Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;

  //echo "<hr>afecterBalise2theme<br>{$sheetStyle}<hr>";
  $fds1 = XOOPS_ROOT_PATH."/themes/{$sheetStyle}/theme.html";
  $fds2 = XOOPS_ROOT_PATH."/themes/{$sheetStyle}/theme.html.old";  
  $fds3 = XOOPS_ROOT_PATH."/themes/{$sheetStyle}/theme.html.new";  
  
  //-------------------------------------------------------  
  //verifie si le fichier d'origine existe, si non le cré
  //-------------------------------------------------------
  //echo "<hr>{$fds1}<br>{$fds2}<hr>";  
  if (!file_exists ($fds2)){
    copy ($fds1, $fds2);
  }
  //------------------------------------------------------- 
  //charge le contenu de l'original et traite les balises
  //-------------------------------------------------------  
  $content = file_get_contents($fds2);  
  $sql = "SELECT * FROM "._FUN_TFN_BALISE
        ." WHERE actif=1 ORDER BY ordre,nom";
       
    //echo "<hr>afecterBalise2theme<br>{$sql}<hr>";          
    $sqlquery = $xoopsDB->queryF ($sql);  
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
        //traite les retour a la ligne    
        $repere = str_replace("%%" ,"\n", $sqlfetch['repere']); 
        $smarty = str_replace("%%" ,"\n", $sqlfetch['smarty']); 
        $ok = true;
        //----------------------------------------------        
        switch ($sqlfetch['position']){
          
        case 1:// _AD_FUN_BEFORE    
          $replace = $smarty . $repere;     
          break;        

        case 2://_AD_FUN_AFTER   
          $replace = $repere . $smarty;         
          break;        
        
        case 0://_AD_FUN_REPLACE
        default:        
          $replace = $smarty ;        
          break;        
        }
        


        $content = str_replace($repere,$replace,$content);        
/*        
        $content preg_replace ( mixed pattern, mixed replacement, mixed subject [, int limit])

        $content = preg_replace ($repere, $replace, $content);
*/
        /*

        $h = strpos($content, $smarty);

        if ($h === false){
          //echo "<br>non -{$smarty}-{$h}<hr>";        

        }else{
          //echo "<br>ok -{$smarty}-{$h}<hr>";        
        }
        */
        
    }	

  //------------------------------------------------------- 
  //sauvegade le nouveau contenu dans le fichier
  //-------------------------------------------------------  
   fputContent ($fds1, $content, $msg ) ; 
  //-------------------------------------------------------  
  //exit;
  return true;
       
  //echo "<hr>afecterBalise2theme<br>{$fds1}<hr>";  

  //fputContent ($fds2, $content, $msg ) ;
  //echo "<hr>$msg<hr>";
  
  
  
  
//exit();  
    
  

}


?>
