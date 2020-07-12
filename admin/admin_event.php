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


include_once ("admin_header.php");
include_once (_FUN_JJD_PATH.'include/adminOnglet/adminOnglet.php');
include_once (_FUN_JJD_PATH.'include/sysfile_functions.php');

//-----------------------------------------------------------------------------------
global $xoopsModule;
$slash = ((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/');
include_once (XOOPS_ROOT_PATH.$slash."/modules/".$xoopsModule->getVar('dirname')
                                    ."/include/funy_constantes.php");
include_once (XOOPS_ROOT_PATH.$slash."/modules/".$xoopsModule->getVar('dirname')
                                    ."/include/funy_generique.php");
                                     
include_once ('admin_event_fnc.php');
//-----------------------------------------------------------------------------------


//-------------------------------------------------------------
$vars = array(array('name' =>'op',        'default' => 'list'),
              array('name' =>'idEvent',   'default' => 0),
              array('name' =>'pinochio',  'default' => false));
require (_FUN_JJD_PATH."include/gp_globe.php");
//-------------------------------------------------------------

/************************************************************************
 *
 ************************************************************************/
 
  admin_xoops_cp_header(_FUN_ONGLET_EVENT, $xoopsModule); 

  switch($op) {
  case "list":
		listEvent ();
		break;

/*
		
  case "saveList":
		saveListTexte ($_POST);
    redirect_header("admin_texte.php?op=list",1,_AD_FUN_ADDOK);		
		break;
*/
  case "new":
		//saveTexte ($_POST);
    $p = getEvent (0, $gepeto['plugin']);
    
    editEvent ($p);
    //redirect_header("admin_Texte.php?op=edit",1,_AD_FUN_ADDOK);    
		break;

  case "edit":
		//saveTexte ($_POST);
		$p = getEvent ($idEvent);
    editEvent ($p);
    //redirect_header("admin_texte.php?op=edit",1,_AD_FUN_ADDOK);    
		break;
		


  case "init":
    //xoops_cp_header();
    $msg = sprintf(_AD_FUN_CONFIRM_INIT, "<b>{$_GET['name']} (id:{$idEvent})</b>" , _AD_FUN_EVENTS);            
    xoops_confirm(array('op'         => 'initOk', 
                        'idEvent'    => $_GET['idEvent'] ,
                        'ok'         => 1),
                        "admin_event.php", $msg );
//    xoops_cp_footer();
    
    break;

  case "initOk":
		//saveTexte ($_POST);
		$p = db_getEvent($idEvent, true);
    editEvent ($p);
   
		break;



  case "genereParamsEvent":
    saveEventVierge();
    redirect_header("admin_event.php?op=list",1,_AD_FUN_ADDOK);  
      
		break;

  case "showParamsEvent":
		//saveTexte ($_POST);
    showParamsEvent ($gepeto);
		break;


  case "save":
		saveEvent ($_POST);
    redirect_header("admin_event.php?op=list",1,_AD_FUN_ADDOK);		
		break;

  case "saveList":
		saveEventActifChange ($gepeto);
    redirect_header("admin_event.php?op=list",1,_AD_FUN_ADDOK);		
		break;


  case "remove":
    //xoops_cp_header();
    $msg = sprintf(_AD_FUN_CONFIRM_DEL, "<b>{$_GET['name']} (id:{$idEvent})</b>" , _AD_FUN_EVENTS);            
    xoops_confirm(array('op'         => 'removeOk', 
                        'idEvent'    => $_GET['idEvent'] ,
                        'ok'         => 1),
                        "admin_event.php", $msg );
//    xoops_cp_footer();
    
    break;

  case "removeOk":
		//saveTexte ($_POST);
    //deleteTexte ($id);
    deleteEvent ($_POST['idEvent']);    
    redirect_header("admin_event.php?op=list",1,_AD_FUN_DELETEOK);    
		break;

  case "duplicate":
    $idEvent = duplicateEvent ($idEvent); 
		$p = getEvent ($idEvent);    
    editEvent ($p);    
  	break;

  case "clear":
		//saveTexte ($_POST);
    clearEvent ($id);
    redirect_header("admin_event.php?op=edit",1,_AD_FUN_ADDOK);    
		break;

  case "previewEvent":
		//saveTexte ($_POST);
    //previewTexte ($id);
		break;

		
	default:
	 $state = _FUN_STATE_WAIT;
    redirect_header("admin_event.php?op=list",1,_AD_FUN_ADDOK);
    break;

}


   
admin_xoops_cp_footer();

 

 
//---------------------------------------------------------------------
?>
