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
/*

$f= XOOPS_ROOT_PATH."/modules/funy";
include_once ($f."/include/funy_constantes.php");
include_once ($f."/include/funy_data.php");
*/
global $funyBlock;
//-----------------------------------------------------------------------------------
function displayOptionsBlock($options, $msg=""){
	$c = count($options);
  echo "<hr>{$msg} => {$c}<hr>";
  while (list($key, $item)= each ($options)){
    echo "<hr>{$key} = {$item}<hr>";
  }
  
  

}
//-----------------------------------------------------------------------------------
function funy_show_block($options) {


global $xoopsDB, $xoTheme; $funyBlock;

//displayArray($xoTheme->plugins['xos_logos_PageBuilder']->blocks, "--funy_show_action----");
/*

if ($options[0] == 4){
  if (isset($xoTheme->plugins['xos_logos_PageBuilder']->blocks['page_topcenter'][43])){

  };
  
  

}else{
   if (!isset($funyBlock)) $funyBlock = array();


	$sql = "SELECT bid, side FROM ".$xoopsDB->prefix('newblocks')
	     . " WHERE name='funy_block_{$options[0]}' ";
	$rst = $xoopsDB->queryF($sql);
	list($idBlock, $side) = $xoopsDB->fetchRow($rst);
	$tSide = array('canvas_left',     'canvas_right',     'canvas_center', 
                 'page_topleft',    'page_topright',    'page_topcenter', 
                 'page_bottomleft', 'page_bottomright', 'page_bottomcenter');
  
  $keySide = $tSide[$side];
  $t = array('side'   => $keySide,
             'title'  => "title : {$idBlock}",
             'idSide' => $side);
  $xoTheme->plugins['xos_logos_PageBuilder']->blocks['funy'][$idBlock] = $t;	
}
*/
   
//	$block = $options[0];
//echo "<hr>{$block}<hr>"	
	//----------------------------------------------------------------
	$block = array();
	$numDef = $options[0];

		$def = array();

		$block['def'][] = $def;

  return $block;
}

/************************************************************************
 *
 ************************************************************************/
 
function funy_edit_block($options) {
	
  $block = $options[0];
	//----------------------------------------------------------------
	$form  = "";

	return $form;
}


?>



