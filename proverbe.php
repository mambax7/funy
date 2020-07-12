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
//include_once (XOOPS_ROOT_PATH."/modules/".$xoopsModule->getVar('dirname')."/include/funy_constantes.php");
include_once (XOOPS_ROOT_PATH."/modules/funy/include/funy_constantes.php");
//-----------------------------------------------------------------------------------
//include_once (_FUN_ROOT_JJD_INCLUDE."functions.php");

//-------------------------------------------------------------

/*

$vars = array(array('name' =>'op',         'default' => ''),
              array('name' =>'idProverbe', 'default' => 0),
              array('name' =>'type',       'default' => 0),
              array('name' =>'pinochio',   'default' => false));

require (_FUN_JJD_PATH."include/gp_globe.php");
*/
//-------------------------------------------------------------


//Admin or not
//---------------------------------------------------------------------------
if($xoopsUser) {
	$adminview = $xoopsUser->isAdmin($xoopsModule->mid()) ;
} else {
	$adminview=0;
}

/************************************************************************
 *
 ************************************************************************/
 function findProverbe($p){
 global $xoopsDB;
  
  if (!isset($p['pays'])) $p['pays'] = '';
  if (($p['pays']=='0'))  $p['pays'] = '';  
  
  if ($p['pays'] <> '' ){
    $sqlWhere = " WHERE pays like '{$p['pays']}'";
  }else{
    $sqlWhere = '';
  }
  if (!isset($p['carLine'])) $p['carLine'] = 0;  
  
  
  $orderBy = " ORDER BY idProverbe";
  //--------------------------------------------------------------------4
  $sql = "SELECT count(idProverbe) as nbProverbe FROM "._FUN_TFN_PROVERBE 
       . $sqlWhere.$orderBy;
  $sqlquery = $xoopsDB->query($sql);      
  //echo "<hr>{$sql}<hr>";  
  list($countProverbe) = $xoopsDB->fetchRow( $sqlquery ) ;      
  $n = rand (1, $countProverbe-1);     
  //--------------------------------------------------------------------4  
//echo "<hr>nb proverbe = {$countProverbe}<hr>";
  
  $sql = "SELECT pays,categorie,auteur,texte,idProverbe FROM "._FUN_TFN_PROVERBE  
       . $sqlWhere.$orderBy  
       . " LIMIT {$n},1";
  //echo "<hr>{$sql}<hr>";
  $sqlquery = $xoopsDB->query($sql);
  $t = $xoopsDB->fetchArray($sqlquery);
  
  $sql = "UPDATE  "._FUN_TFN_PROVERBE." SET hits = hits+1 "
       . " WHERE idProverbe = {$t['idProverbe']}";
  $xoopsDB->queryF($sql);
  $t['texte'] = str_replace("&nbsp;", " ", $t['texte']);
  
  $p['carLine'] = 40;
  if ($p['carLine'] <> 0 ){
    $proverbe = $t['texte'];
    $h = strpos ($proverbe , " ", $p['carLine']);
    $i = 0;
    $lines = array();
    
    while (!$h === false){
      $lines[]  = substr($proverbe, 0, $h);
      $proverbe = substr($proverbe, $h+1);
      $h = strpos($proverbe , " ", $p['carLine']);       
    }
    $lines[] = $proverbe;
    $t['texte'] = implode("<br />", $lines);    
  }
  //displayArray($t,"----------findProverbe-------------");
  //$t['texte'] .=  "-{$countProverbe}-{$n}";
  return '|#begin#|' .implode ('|', $t) .'|#end#|';
  
  //exemple
  //http://localhost/xoops2018a/modules/funy/proverbe.php?op=find&pays=indien 
}
/************************************************************************
 *
 ************************************************************************/
  $op = $_GET['op'];
  switch($op) {
  case "find":
		$r = findProverbe ($_GET);
		//echo "<hr>{$r}<hr>";
		echo $r;
		break;


		
	default:
    redirect_header(XOOPS_UTL,1,_AD_FUN_ADDOK);
    break;
}


   

 
//---------------------------------------------------------------------
    



?>
