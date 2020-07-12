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

include_once ("header.php");
//-----------------------------------------------------------------------------------
global $xoopsModule;
//$f= dirname(dirname(__FILE__));
$f= XOOPS_ROOT_PATH."/modules/funy";
include_once ($f."/include/funy_constantes.php");
include_once ($f."/include/funy_data.php");
include_once ($f."/include/funy_balise.php");
//-----------------------------------------------------------------------------------



/*******************************************************************
 *
 *******************************************************************/
function funy_show_control($options) {
global $xoopsDB,$xoopsTpl,$xoTheme,$funyBlockName,$funySS;
  //----------------------------------------------------------------
	$block = array();
	$numDef = $options[0];

		$def = array();
		$block['def'][] = $def;
		//$block['title'] = "zzzzzzzzzz";

	$xoopsTpl->assign('funy_zzzzz', 'aaaaaaaa');  
	$xoopsTpl->assign('PostSS', $funySS);  
//displayArray($funySS,"-------funy_show_control-----------------");  

  return $block;

}
/*******************************************************************
 *
 *******************************************************************/
function funy_show_script($options) {
	global $xoopsDB,$xoopsTpl,$xoTheme,$funyBlockName,$funySS;
//displayArray($funySS,"----------funy_show_script--------------");	
	$xoopsTpl->assign('PostSS', $funySS);
	
  //buildAllScripts($options);  
  
  buildAllScripts($options);
  //----------------------------------------------------------------
	$block = array();
	$numDef = $options[0];

		$def = array();
		$block['def'][] = $def;
		//$block['title'] = "zzzzzzzzzz";
  return $block;

}
/*******************************************************************
 *
 *******************************************************************/
function funy_show_rename($options) {
global $xoopsDB,$xoopsTpl,$xoTheme,$funyBlockName,$funySS;    
	
  
  //$xoopsTpl->assign('PostSS', $funySS);
  //displayArray($funySS,"----------funy_show_rename--------------");
	//$xoopsTpl->assign('funy_zzzzz', 'aaaaaaaa');
    
    //echo "<hr>dernier blocks<hr>";
    //$funyBlockName[$balise]['title']= $tParams['funy_param']['blockTitle']['value'];
    
    $funyBlockName['Funy-script']['title']= '';    
    $funyBlockName['Funy-rename']['title']= '';    
    //displayArray($funyBlockName,"-------------funy_show_rename----------");
    
    
    /****************************************************************
     *  afectation des nom de bocks
     ****************************************************************/  
  	while (list($key, $b) = each($funyBlockName)){
       if (isset($b['title']) & isset($b['bid'])){
         $xoTheme->plugins['xos_logos_PageBuilder']->blocks[$b['side']][$b['bid']]['title'] = $b['title'];     
       }
    }
    
    //----------------------------------------------------------------
    $block['def'][] = array();
    return $block;

}

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
/*******************************************************************
 *
 *******************************************************************/
function funy_edit_control($options) {
    //----------------------------------------------------------------
    $block['def'][] = array();
    return $block;

}
/*******************************************************************
 *
 *******************************************************************/
function funy_edit_script($options) {

}
/*******************************************************************
 *
 *******************************************************************/
function funy_edit_rename($options) {

}

///////////////////////////////////////////////////////////////////////////

/*******************************************************************
 *
 *******************************************************************/
function buildAllScripts($options) {
	global $xoopsDB,$xoopsTpl,$xoTheme,$funyBlockName,$funySS;
	
  
  //displayArray($xoTheme->plugins['xos_logos_PageBuilder']->blocks, "--funy_show_action----");

	$tKey =array();//pour verifier les plugin deja fait(pas encore ulti tache))
	$idEvent = 1;
	//echo "zzz";

	//echo "<hr><code>{$balis2insert}</code><hr>";
	//$xoopsTpl->assign('funy_baliseToInsert', getBalisesToInsertedInbloc());  
	$xoopsTpl->assign('file2insert', _FUN_ROOT_PATH."_plugin_declaration/balise2insert.html");	
	//$xoopsTpl->assign('funy_block_0_begin', _FUN_ROOT_PATH."_plugin_declaration/balise2insert.html");
	
  
  $tSmarty = array();
	$tSmarty ['pathToolsJS'][] = _JJD_JS_TOOLS ;
	//$tSmarty ['funy_baliseToInsert'][] = getBalisesToInsertedInbloc() ;	
	$funySS = array();
	$tMulti = array();
	
  $tStart = array();
	$tStop = array();
	
  $params = array();
	$sqlquery = db_getCurrentEvents();

  $funyBlockName = db_getFunyBlockId();
  //displayArray($funyBlockName, "-------buildLinkEvent--liste des blocks---------");  
  //displayArray($sqlquery, "-------sqlquery---------");	
  
  
  while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
    if (isset($t[$sqlfetch['plugin']]) & $sqlfetch['multi'] == 0) continue;
    $t[$sqlfetch['plugin']] = true;    
      //displayArray($sqlfetch, "***** funy_show_action *****");
      //echo "idEvent->{$sqlfetch['idEvent']}";
      buildLinkEvent($sqlfetch['idEvent'], $tSmarty, $tStart, $tStop, $funyBlockName, $funySS, $tMulti);
  }	
  
  //displayArray($tStart,"-----------funy_start_action--------------");
  if (count($tStart) > 0) {
    $start = "\n<script type='text/javascript'>\n"
           //."alert('funy_start_action')\n"
           . "\nfunction funy_start_all (){\n    "
           . implode("\n    ", $tStart)
           . "\n}\n</script>\n";  
    $tSmarty['funy_start_all'][]= $start;
  }
  
  //displayArray($tStop,"-----------funy_stop_action--------------");  
  if (count($tStop) > 0) {
    $stop = "\n<script type='text/javascript'>\n"
          . "\nfunction funy_stop_all (){\n    "    
          . implode("\n   ", $tStop)
          . "\n}\n</script>\n";  

    $tSmarty['funy_stop_all'][] = $stop;
  }

  //displayArray($tSmarty,"-----------funy_show_action--------------");
  
  assignSmarty($tSmarty);
//displayArray($funySS,"----------postSS--------------");


}
/***********************************************************************
 *
 ***********************************************************************/ 
function buildLinkEvent($idEvent, 
                        &$tSmarty, 
                        &$tStart, 
                        &$tStop, 
                        &$funyBlockName, 
                        &$funySS, 
                        &$tMulti) {
	global $xoopsDB,$xoopsTpl;
	/*
  */
	//$sql = "SELECT * FROM "._FUN_TFN_EVENT." WHERE idEvent = {$idEvent}";
	$sqlFetch = db_getEvents($idEvent);
	$p = $xoopsDB->fetchArray($sqlFetch);
  

	$configName = _FUN_DIR_PLUGIN.$p['plugin'];	
	$folder = dirname($configName).'/';
  $url =  str_replace(_FUN_DIR_PLUGIN,_FUN_URL_PLUGIN,$folder);
  
	//echo "<hr>{$fullName}<br>";
  $ini = parse_ini_file($configName,true);
  db_getParams($idEvent, $p['plugin'], $tParams, $tS);  
  //displayArray($tParams, "-------buildLinkEvent-----------");
  //displayArray($ini, "-------buildLinkEvent-----------");  
  //$balise = $ini['balise'];

  //if ($tParams['blockTitle']) $funyBlockName[$idEvent] = $tParams['blockTitle'];
  
    //--------------------------------------------------------
    //linkage du fichier de parametre du plugin
    //--------------------------------------------------------  
    $key = 'funy_param';    
    if (!isset($tSmarty [$key])) $tSmarty [$key] = array();    
    

    if ($p['multi'] == 1 ){
  	 $f = getFileNameDeclaration($p['plugin'], 0, 1);
     //$k = str_replace("/","-", $f);
     if (!isset($tMulti[$f])) {
       //echo "<hr>Ajout de la declaration de tableaux pour les plugins multi<br>{$f}<hr>";  	 
       $link = "<script type=\"text/javascript\" src=\"{$f}\"></script>";   
       $tSmarty [$key][] = $link;   
       $tMulti[$f] = true;    
     }   
    }  
  	
    //$f = getFileNameDeclaration($p['plugin'], $p['nom'], 1);
  	$f = getFileNameDeclaration($p['plugin'], $p['idEvent'], 1);  	
    //echo "<hr>fichier de parametre du plugin<br>{$f}<hr>";  	
    $link = "<script type=\"text/javascript\" src=\"{$f}\"></script>";
    //echo "<hr>linkage du fichier de parametre du plugin<br>{$link}<hr>";    
    $tSmarty [$key][] = $link;
    
  
    //----------------------------------------------------------
    //insertion du code HTML ou ou tag DIV,  resultat de fonction php .... 
    //----------------------------------------------------------
    if (isset($ini['smarty']))  {
      $sql = "SELECT * FROM "._FUN_TFN_SMARTY." WHERE idEvent={$idEvent}";
      $sqlquery = $xoopsDB->query ($sql);
      
      while ($t = $xoopsDB->fetchArray($sqlquery)) {
      //$t = explode('|', $item);  
      $balise = $t['balise'];
      //$tb = explode('__', $balise);
      //$blockName = $tb[0];
      $key = $t['fichier'];
      //if (substr($balise,12) == 'funy_block_' & isset ($ini['blockTitle'])){      
      
      //echo "<hr>balise--->{$balise}<hr>";
      if (substr($balise,0,11) == 'funy_block_' & isset ($ini['blockTitle'])){
        if ($tParams['funy_param']['blockTitle']['value'] <> ''){
          //$funyBlockName[$balise]['title']= substr($balise,0,11).':'.$balise.':'.$tParams['funy_param']['blockTitle']['value'];
          $blockName = substr($balise, 0, 12);
          $funyBlockName[$blockName]['title']= $tParams['funy_param']['blockTitle']['value'];      
        }else{
        //$funyBlockName[$balise]['title']= 'yyy';//$ini['blockTitle'];        
        }
      }else{
        //$funyBlockName[$balise]['title']= '???';//$ini['blockTitle'];      
      }
        //$funyBlockName[$balise]['title']= 'aaaaaaaaaaaaa';//$ini['blockTitle'];      
      
      $tBlock = db_getFunyBlockId();


      //echo "<hr>{$balise}={$t[1]} - insertion des javascript<br>{$item}<br>{$f}<hr>";      
      
      $content = "";
      if (!isset($tSmarty [$balise])) $tSmarty [$balise] = array();      
      //------------------------------------------------      
      switch ($t['mode']){

        case 1:
          $f = $url.$key;
          if (!isset($tMulti[$f])) {
            //echo "<hr>{$t[1]} - insertion des liens javascript<br>{$f}<hr>";    
            $content = "<script type=\"text/javascript\" src=\"{$f}\"></script>"; 
            $tMulti[$f] = true;    
          }   

        
        

          break;
          
        case 2:
            $f = $folder . $key;
            //echo "<hr>{$f}<hr>";
            include_once ($f); 
            $clName = str_replace('.php', '', $key);
            //echo "<hr>classe : {$clName}<hr>";           
            //$obp = new $clName($ini);
            //displayArray($tParams['funy_param'], "-------buildLinkEvent-----------");
            $obp = new $clName($tParams['funy_param']);            
            $content = $obp->render();
            //echo "<hr><code>code fondu:<br>$content{}</code><hr>";
            break;   
                          
        default:
          if ($p['multi'] == 1){
            $f = getFileNameDeclaration($p['plugin'], $idEvent, 0, 'div'); 
            $content = file_get_contents($f);            
            //echo "<hr>++>{$key}-{$configName}<br>{$f}<br>{$content}<hr>";  
            if ($content <> "" ) $tSmarty [$balise][] = $content ;                                 
            //todo
            //{
          }
          
           
          $f = $folder.$key;  
          //echo "<hr>{$t[1]} - insertion du code des javascript<br>{$f}<hr>";               
          $content = file_get_contents($f);   
          //echo "<hr>-->{$key}-{$configName}<br>{$f}<br>{$content}<hr>";     
          break;          
      }
   
      if ($content <> "" ) $tSmarty [$balise][] = $content ;      
      
    }
  }

  //displayArray($funyBlockName, "-------buildLinkEvent--liste des blocks---------");   
   
    //----------------------------------------------------------
    //ajout de l'appel aux fonction stop et run si elle existent
    //----------------------------------------------------------
    //displayArray($ini,"----------buildLinkEvent---------------");
    //displayArray($tParams,"----------buildLinkEvent---------------");    
    
    $nom = $ini['info']['nom'];
    if (isset($tParams ['funy_param']['show_buttons']['value'])){
      $show_buttons =  $tParams['funy_param']['show_buttons']['value'];
    }else{
      $show_buttons = 0;    
    }
    //----------------------------------------------
    if (isset($ini ['info']['stopScript'])) {
      $tStop[] = $ini ['info']['stopScript'] . '();';
      
      if ($show_buttons == 1){
        if (!isset($funySS[$nom])) $funySS[$nom] = array();
        $funySS[$nom]['name'] = $nom;
        $funySS[$nom]['stop'] = $ini ['info']['stopScript'] . '();';           
      }
    } 

    if (isset($ini ['info']['runScript'])) {
      $tStart[] = $ini ['info']['runScript'] . '();';
      
      if ($show_buttons == 1){
        if (!isset($funySS[$nom])) $funySS[$nom] = array();      
        $funySS[$nom]['name']  = $nom;
        $funySS[$nom]['start'] = $ini ['info']['runScript'] . '();';           
      
      }      
      
    } 
    
//displayArray($funySS,"-----buildLinkEvent-----postSS--------------");    
  
}

/************************************************************************
 *
 ************************************************************************/

function assignSmarty($tSmarty) {
	global $xoopsDB,$xoopsTpl;

//	$xoopsTpl->assign("zzzzz", "dddd");	
  while (list ($key, $item) = each ($tSmarty)) {
    //displayArray($item, "----- assignSmarty -----");
    //echo "<hr>{$key}<br>";
    $link = implode("\n", $item);
    $xoopsTpl->assign($key, $link);  
  }

}


/************************************************************************
 *
 ************************************************************************/
 
function funy_edit_action($options) {
	$form  = "";

	return $form;
}


?>



