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

//include_once ("admin/admin_header.php");
//---------------------------------------------------------------
include_once (XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')
                               ."class/xoopsformloader.php");
require_once ("funy_constantes.php");
require_once ("funy_generique.php");
include_once (_FUN_JJD_PATH."/include/functions.php");

//---------------------------------------------------------------/

/*********************************************************************

**********************************************************************/
function db_getEvents($idEvent = 0, $orderby = "plugin, nom"){
global $xoopsDB;
  
  $sql = "SELECT * FROM "._FUN_TFN_EVENT
       .(($idEvent == 0) ? '': " WHERE idEvent = {$idEvent}")
       .(($orderby <> '') ? " ORDER BY {$orderby}" : '');
       
    //echo '<hr>JJD-'.$sql.'<hr>';          
    $sqlquery = $xoopsDB->query ($sql);  
    return $sqlquery;

}

/*********************************************************************

**********************************************************************/
function db_getEvent($idEvent, $init = false){
 	global $xoopsModuleConfig, $xoopsDB, $xoopsModule, $xoopsConfig;
  
  $sql = "SELECT * FROM "._FUN_TFN_EVENT
       . " WHERE idEvent = {$idEvent}";
//    echo '<hr>JJD-'.$sql.'<hr>';          
    $sqlquery = $xoopsDB->query ($sql);
    $t = $xoopsDB->FetchArray($sqlquery);
    
    if ($init) {
      $newT = array();
      $newT['idEvent']      = $t['idEvent'];
      $newT['plugin']       = $t['plugin'];  
      $newT['nom']          = $t['nom'];   
      $newT['description']  = $t['description'];      
      $newT['dateDebut']    = $t['dateDebut'];
      $newT['dateFin']      = $t['dateFin'];     
      $newT['periodicite']  = $t['periodicite'];      
      $newT['actif']        = $t['actif'];      
      $newT['isObject']     = $t['isObject'];      
      $newT['objectName']   = $t['objectName'];   
      $newT['multi']        = $t['multi'];  
      $newT['ordre']        = 99;      
      $newT['init']         = true;                
      $t = $newT;   
      
      $sql = "DELETE FROM "._FUN_TFN_PARAM." WHERE idEvent = {$idEvent}";  
      $xoopsDB->queryF ($sql);
    }
    //--------------------------------------------  
    //recherche de parametres  
    //--------------------------------------------    
    //$t['param'] = db_getParams($idEvent, $t['plugin']);    
    db_getParams($idEvent, $t['plugin'], $t, $tSmarty); 
      $t['smarty'] = $tSmarty;       
    //--------------------------------------------  
    return $t;

}
/*********************************************************************

**********************************************************************/
function getFunyLang2($file){
 	global $xoopsModuleConfig, $xoopsDB, $xoopsModule, $xoopsConfig;
    
    $fullName = _FUN_DIR_PLUGIN.$file;
    $language = $xoopsConfig['language'];    
    $f =  dirname($fullName).'/'.$language.'.lang';
    //echo "<hr>$file<br>$f<hr>";
    $iniLang = parse_ini_file($f,true);
    
    return $iniLang;
    
}

/*********************************************************************

**********************************************************************/
function getFunyLang($file){
 	global $xoopsModuleConfig, $xoopsDB, $xoopsModule, $xoopsConfig;
    
    
    $f = getFileLang(_FUN_DIR_PLUGIN.$file, 'dico', 'lang');    
    //echo "<hr>$file<br>$f<hr>";
    $iniLang = parse_ini_file($f,true);
    
    return $iniLang;
    
}

/*********************************************************************

**********************************************************************/
function db_getPluginParams($file, &$gList, $withPrivate = false, $globalModule = 0){
 	global $xoopsModuleConfig, $xoopsDB, $xoopsModule, $xoopsConfig;


    //--------------------------------------------    
    $fullName = _FUN_DIR_PLUGIN.$file;

    $iniLang = getFunyLang($file);
    //--------------------------------------------  
    //du fichier de langue
    //--------------------------------------------    
    //$language = $xoopsConfig['language'];    
    //$f =  dirname($fullName).'/'.$language.'.lang';
    //echo "<hr>$file<br>$f<hr>";
    //$iniLang = parse_ini_file($f,true);
    
    $lang  = $iniLang['language'];    
    //displayArray($lang,'langue');

    //--------------------------------------------  
    //recherche de parametres  du plugin
    //--------------------------------------------    
    //echo "<hr>{$fullName}<br>";
    $ini = parse_ini_file($fullName,true);
    $gList = (isset($ini['list']) ? $ini['list'] : array());

    $newParam = array();    
    reset($ini);    
    //displayArray($ini,'---------db_getPluginParams----------------');
    
    while (list($key, $p) = each($ini)) {  
      
      if (!isset($p['type']))continue;   //c'est pas un parametre
      if (isset($p['private']) & !$withPrivate)continue; //parametre du plugin global non global
      //displayArray($p,'---------db_getPluginParams----------------');
      //$name = $p['name'];
      //echo "<hr>{$name}<hr>";
      $p['description'] = ((isset($lang[$key])) ? $lang[$key] : '');
      $p['globalModule'] = $globalModule;
      //$newParam[$p['name']] = $p;
      $newParam[$key] = $p;      
    }  

    //displayArray($newParam,'---------db_getPluginParams----------------');
    return $newParam;
}

/*********************************************************************

**********************************************************************/
function db_getPluginBalises($file){
 	global $xoopsModuleConfig, $xoopsDB, $xoopsModule, $xoopsConfig;


    //--------------------------------------------    
    $fullName = _FUN_DIR_PLUGIN.$file;

    
    //--------------------------------------------  
    //du fichier de langue
    //--------------------------------------------    
    $iniLang = getFunyLang($file);
    /*
    $language = $xoopsConfig['language'];    
    $f =  dirname($fullName).'/'.$language.'.lang';
    //echo "<hr>$file<br>$f<hr>";
    $iniLang = parse_ini_file($f,true);
    
    */
    $lang  = $iniLang['language'];    
    //displayArray($lang,'langue');

    //--------------------------------------------  
    //recherche de parametres  du plugin
    //--------------------------------------------    
    //echo "<hr>{$fullName}<br>";
    $ini = parse_ini_file($fullName,true);
    $newBalise = array();    
    reset($ini);    
    //displayArray($ini,'---------db_getPluginParams----------------');
    
    while (list($key, $p) = each($ini['smarty'])) {
      $tItem = explode('|', $p);  
      $t['idSmarty'] = 0;      
      $t['file'] = $key;
      $t['balise'] = $tItem[0];
      $t['mode'] = (isset($tItem[1]) ? $tItem[1] : 0);     
      $t['selection'] = (isset($tItem[2]) ? $tItem[2] : 0);      
      $p['description'] = ((isset($lang[$key])) ? $lang[$key] : '');       
      //---------------------------------------------------------
      $newBalise[$key] = $t;      
    }  

    //displayArray($newParam,'---------db_getPluginParams----------------');
    return $newBalise;
}

/*********************************************************************

**********************************************************************/
function db_getParams($idEvent, $file , &$tParam, &$tSmarty){
 	global $xoopsModuleConfig, $xoopsDB, $xoopsModule, $xoopsConfig;
  
  $language = $xoopsConfig['language'];  
    
    //---------------------------------------------------
    //recherche du nom du fichier s'il n'a pas été passer en paramètre
    //---------------------------------------------------
    if ($file == ''){
      $sql = "SELECT plugin FROM "._FUN_TFN_EVENT
            ." WHERE idEvent = {$idEvent}";
      //    echo '<hr>JJD-'.$sql.'<hr>';          
      $sqlquery = $xoopsDB->query ($sql);
      list($file) = $xoopsDB->fetchRow($sqlquery);
    }
    
    //--------------------------------------------  
    //recherche de parametres globaux et du plugin
    //--------------------------------------------  
    if ($file == 'global_module/config.ini'){
      $newParam = db_getPluginParams($file, $gList, true);    
    }else{
      $gFile = 'global_module/config.ini';
      $globalParam = db_getPluginParams($gFile, $gList, false, 1);  
      $globalIniLang = getFunyLang($gFile);
      //displayArray($globalIniLang); 
      
      $newParam = db_getPluginParams($file, $pList);//pList n'est pas utilise pour le moment
      
      //recupe des libellé du module global s'il ne sont pas déclaré dnas le ini du plugin
      while(list($key, $p) = each($newParam)){
        if ($p['description'] == ''){
          //if (isset($globalParam['description'])) $p['description'] = $globalParam['description'];
          if (isset($globalParam[$key])) $newParam[$key]['description'] = $globalParam[$key]['description'];                    
        }
      }
      $newParam = array_merge($globalParam, $newParam);
    }
   
    
    //echo "<hr>";    
    //--------------------------------------------  
    //recherche des valeurs modifiées pour l'evenement  
    //--------------------------------------------    
    //displayArray($newParam,"----- newParam -----");
    if ($idEvent <> 0){
      $sql = "SELECT * FROM "._FUN_TFN_PARAM
            ." WHERE idEvent = {$idEvent}";
      //echo '<hr>JJD-'.$sql.'<hr>';          
      $sqlquery = $xoopsDB->queryF ($sql);
      //list($file) = $xoopsDB->fetchRow($sqlquery);
      while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
          //echo "<hr>{$sqlfetch['nom']}={$sqlfetch['valeur']}<hr>";      
          if (isset($newParam[$sqlfetch['keyName']])) {

            $newParam[$sqlfetch['keyName']]['value'] = $sqlfetch['valeur'];          
          }

      }	
    
    }
    //--------------------------------------------   
    
$tParam['funy_param'] = $newParam ;
$tParam['funy_list']  = $gList ;
  $iniLang = getFunyLang($file);
      //displayArray($globalIniLang);
      //displayArray($iniLang);      
  
  
  if (isset($iniLang['dico']) & isset($globalIniLang)){
    $tParam['funy_dico'] = array_merge($iniLang['dico'],$globalIniLang['dico']);
  } else{
      if (isset($globalIniLang['dico'])){    
        $tParam['funy_dico'] = $globalIniLang['dico'];
      }
  }
  
//displayArray($tParam['funy_dico'],"-----dico---------"); 
//displayArray($iniLang,"-----iniLang---------");
    //--------------------------------------------  
    
    //--------------------------------------------  
    //recherche des valeurs balises pour insertion dans les templates  
    //--------------------------------------------    
    $tSmarty = db_getPluginBalises($file);
    //displayArray($newParam,"----- newParam -----");
    if ($idEvent <> 0){
      $sql = "SELECT * FROM "._FUN_TFN_SMARTY
            ." WHERE idEvent = {$idEvent}";
      //echo '<hr>JJD-'.$sql.'<hr>';          
      $sqlquery = $xoopsDB->queryF ($sql);
      //list($file) = $xoopsDB->fetchRow($sqlquery);
      while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
          //echo "<hr>{$sqlfetch['nom']}={$sqlfetch['valeur']}<hr>";      
          if (isset($tSmarty[$sqlfetch['fichier']])) {
            $tSmarty[$sqlfetch['fichier']]['idSmarty']  = $sqlfetch['idSmarty'];
            $tSmarty[$sqlfetch['fichier']]['fichier']   = $sqlfetch['fichier'];   
            $tSmarty[$sqlfetch['fichier']]['balise']    = $sqlfetch['balise'];            
            $tSmarty[$sqlfetch['fichier']]['mode']      = $sqlfetch['mode'];            
            $tSmarty[$sqlfetch['fichier']]['selection'] = $sqlfetch['selection'];                   
          }

      }	
    
    }
    
    //displayArray($tSmarty, "----- tSmarty -----");    
    //--------------------------------------------    
    
    
    
    
    
//displayArray($tParam, "----- tParams -----");    
    return true;

}

/**************************************************************************
 *

 function build_icoOption($link, $icone, $alt, $texteBefore='', $textAfter=''){
    //$alt = str_replace("'","\'",$alt);
    $ico = "<TD align='center'>{$texteBefore}"
           ."<A href='{$link}'><img src='{$icone}' border=0 "
           ."Alt=\"{$alt}\" title=\"{$alt}\" width='20' height='20' ALIGN='absmiddle'></A>"
           ."{$textAfter}</td>";            
  return $ico;
 }
 **************************************************************************/ 
/*********************************************************************

**********************************************************************/
function complterParams($idEvent, &$params){
global $xoopsDB;
  
  $sql = "SELECT * FROM "._FUN_TFN_PARAM
       ."WHERE idEvent = {$idEvent}"
       ." ORDER BY nom";
//    echo '<hr>JJD-'.$sql.'<hr>';          
    $sqlquery = $xoopsDB->query ($sql);
  
  while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $param[$sqlfetch['keyName']] = $param[$sqlfetch['valeur']];
  }	
      
    return true;

}
/*********************************************************************

**********************************************************************/
function db_getFunyBlockId(){
global $xoopsDB;
  
  $sql = "SELECT * FROM ".$xoopsDB->prefix("newblocks")
       ." WHERE name like 'funy_%'";
       //." WHERE name like 'funy_block_%'";       
       
//    echo '<hr>JJD-'.$sql.'<hr>';          
    $sqlquery = $xoopsDB->query ($sql);


	$tSide = array('canvas_left',     'canvas_right',     'canvas_center', 
                 'page_topleft',    'page_topright',    'page_topcenter', 
                 'canvas_06', 
                 'page_bottomleft', 'page_bottomright', 'page_bottomcenter');

  
  $t = array();
  while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $t[$sqlfetch['name']] =array('bid' => $sqlfetch['bid'],
                                   'idSide' => $sqlfetch['side'],      
                                   'side' => $tSide[intVal($sqlfetch['side'])]);
  }	
      
    return $t;

}

/**************************************************************************
 *
 **************************************************************************/
 function db_getFunyPlugins (){
 	global $xoopsModuleConfig, $xoopsDB, $xoopsModule, $xoopsConfig;
 	//$iniFile = "config.ini";
 	
 	//----------------------------------------------------------------
  //recherche dans le repertoire pluggin de la liste des pluggin
 	//----------------------------------------------------------------  
  //$folder = _FUN_ROOT_PATH."_plugins/";  
  $t = getFileListH(_FUN_DIR_PLUGIN,  ".ini");
  $tf = array();
  $lg = strlen(_FUN_DIR_PLUGIN);
  $tf = array();
  $plugins = array();
  //displayArray($t,"----- db_getFunyPlugins ---> folder -----");  
  $language = $xoopsConfig['language'];	
  
  
  for ($h = 0; $h < count($t); $h++){
    //$f = $t[$h].$iniFile;
    $shortName = substr($t[$h], $lg);
    $ini = parse_ini_file($t[$h],true);
    $ini['info']['shortName'] = $shortName ;
    
    //$f =  dirname($t[$h]).'/'.$language.'.lang';
    $f = getFileLang($t[$h], 'dico','lang');
    $iniLang = parse_ini_file($f,true);
    $ini['info']['description'] = $iniLang['language']['description'];
    //displayArray($ini['params'],"----- db_getFunyPlugins ---> {$tf['shortName']} -----");    
    //echo "<hr>{$tf['shortName']}<br>";    
    //reset($ini);
    //print_r ($ini);   
 
    
    //displayArray($tf,"----- db_getFunyPlugins -----");
    //-------------------------------------------------
    $plugins[$shortName] = $ini;
  }
  //----------------------------------------------------- 	
  db_updateBalises($plugins);  
  return $plugins;
  
 }

/*********************************************************************

**********************************************************************/
function getFileNameDeclaration($plugin, $event, $mode = 0, $suffixe = ''){
global $xoopsDB;
      
      $name = str_replace ('/', '_',$plugin);
      $name = str_replace ('.ini', '',$name);      
      if ($suffixe <> '') $name =  str_replace ('_config', '_'.$suffixe, $name);  
  
      if ($mode == 1){
        $file = _FUN_URL_PLUGIN_DEC."{$name}_{$event}.js";  //  $name.'_'.$nameEvent.'.js';      
      }else{
        $file = _FUN_DIR_PLUGIN_DEC."{$name}_{$event}.js";  //  $name.'_'.$nameEvent.'.js';      
      }
      
      //echo "<hr>getFileNemeDeclaration<br>$file<hr>";
      return $file;
      
}
/*********************************************************************

**********************************************************************/
function db_getCurrentEvents(){
global $xoopsDB;
  $currentTM = date('Y-m-d', time());
  
  $sql = "SELECT DISTINCT idEvent, plugin, multi FROM "._FUN_TFN_EVENT
       ." WHERE (dateDebut <= '{$currentTM}'"
       ."   AND dateFin   >= '{$currentTM}'"
       ."   AND actif   = 1) "
       ."   OR idEvent = 1 "                     
       ." ORDER BY ordre,dateDebut DESC,nom";
       
    //echo "<hr>db_getCurrentEvents<br>{$sql}<hr>";          
    $sqlquery = $xoopsDB->query ($sql);  
    return $sqlquery;

}
/****************************************************************
 *
 ****************************************************************/

function fputContent ($filename, $somecontent, &$msg ) {


  //------------------------------------------------------
// Assurons nous que le fichier est accessible en ‚criture


    // Dans notre exemple, nous ouvrons le fichier $filename en mode d'ajout
    // Le pointeur de fichier est plac‚ … la fin du fichier
    // c'est l… que $somecontent sera plac‚
    //echo "<hr>fputContent<br>$filename<hr>";
    if (!$handle = fopen($filename, 'wb')) {
         $msg = "Impossible d'ouvrir le fichier ($filename)";
         exit;
    }

    // Ecrivons quelque chose dans notre fichier.
    if (fwrite($handle, $somecontent) === FALSE) {
       $msg = "Impossible d'ecrire dans le fichier ($filename)";
       exit;
    }
    
    $msg = "L'ecriture de ($somecontent) dans le fichier ($filename) a r‚ussi";
    
    fclose($handle);
/*

if (is_writable($filename)) {                    
} else {
    $msg = "Le fichier $filename n'est pas accessible en ‚criture.";
}
*/
}
    
/**********************************************************************
 *
 **********************************************************************/
function getTypeFunParam($type){
  if (is_numeric($type)){
    return $type;
  }else{
    if (defined($type)){
      return constant($type);    
    }else{
      return _FUN_TP_NOT_DEFINED;    
    }

  }
}


/****************************************************************
 *
 ****************************************************************/

function getBalisesInBlocks () {
    
    $t = array();
    for ($h = 0; $h < 5; $h++){
        $t[] = "funy_block_{$h}__left";
        $t[] = "funy_block_{$h}__center";
        $t[] = "funy_block_{$h}__right";                
    }
             
  return $t;
}


/****************************************************************
 *
 ****************************************************************/

function buildHidden ($name, $value, $lib='', $showValue = true, $addRow = true) {
  $t = array();
  
  if ($addRow)  $t[] = '<tr>';
  $t[] = "<td>";
  //$t[] = "<INPUT TYPE='hidden' id='{$name}' NAME='{$name}' VALUE='{$value}'>";  
  $t[] = "<INPUT TYPE='hidden' NAME='{$name}' VALUE='{$value}'>";  
  
  
  //if ($showValue)  $t[] = $value;
  $t[] = (($showValue) ? $value : $lib);  
  
  
  $t[] = "</td>";   
  if ($addRow)  $t[] = '</tr>';  
  
  return implode ('', $t);
}


/****************************************************************
 *
 ****************************************************************/

function initFunyBlocks () {
global $xoopsDB;
$rootName = 'funy%';

    $sql = "SELECT bid FROM ".$xoopsDB->prefix('newblocks')
         . " WHERE `name` LIKE '{$rootName}'" ;
         
   $sqlquery = $xoopsDB->query ($sql);
   while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {  
      $sql = "DELETE FROM ".$xoopsDB->prefix('group_permission')
           . " WHERE gperm_groupid = 2"
           . "   AND gperm_itemid = {$sqlfetch['bid']}"
           . "   AND gperm_modid = 1"
           . "   AND gperm_name = 'block_read'";
           
           
      $xoopsDB->queryF ($sql);            
                        
      $sql = "INSERT INTO ".$xoopsDB->prefix('group_permission')
           . "  (gperm_groupid, gperm_itemid, gperm_modid, gperm_name)"
           . " VALUES(2, {$sqlfetch['bid']}, 1, 'block_read')";
      $xoopsDB->queryF ($sql);  
   }
   
    //-----------------------------------------------------------------

  $sql1 = "UPDATE ".$xoopsDB->prefix('newblocks')
      . " SET `side` = '1',"
      . "  `visible` = '1', "
      . "     weight = 99"
      . " WHERE `name` LIKE 'Funy'" ;
  $xoopsDB->queryF ($sql1);

  
  $sql1 = "UPDATE ".$xoopsDB->prefix('newblocks')
      . " SET `side` = '0',"
      . "  `visible` = '1', "
      . "     weight = 0"
      . " WHERE `name` LIKE 'Funy-script'" ;
  $xoopsDB->queryF ($sql1);

  $sql2 = "UPDATE ".$xoopsDB->prefix('newblocks')
     . " SET `side` = '2',"
     . "  `visible` = '1', "
     . "     weight = 30000"
     . " WHERE `name` LIKE 'funy-rename'" ;
  $xoopsDB->queryF ($sql2);

  
  //echo "<hr>initFunyBlocks<br>{$sql1}<br>{$sql2}<hr>"  ;
}


?>


