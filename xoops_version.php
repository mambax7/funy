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

//-----------------------------------------------------------------------------------
global $xoopsModule;
//$f = dirname(__FILE__)."/include/funy_constantes.php";
//echo "<hr>$f<hr>";
include_once (dirname(__FILE__)."/include/funy_constantes.php");
//-----------------------------------------------------------------------------------

if (!defined('_FUN_DIR_NAME')){ 
    define ('_FUN_DIR_NAME','funy');
}

include_once (_FUN_JJD_PATH.'include/editor_functions.php');

            
//----------------------------------------------------------------------------

$modversion['name']         = "funy"; 
$modversion['version']      = "1.31"; 
$modversion['dateVersion']  = "01-04-2009";

$modversion['description']  = defined('_MI_FUN_FUNY_DSC')?constant('_MI_FUN_FUNY_DSC'):'Gestion de lettres de diffusion';
$modversion['credits']      = "Jean-Jacques DELALANDRE";
$modversion['author']       = "shinaid@kiolo.com";
$modversion['initiales']    = "J&deg;J&deg;D";
$modversion['license']      = "GPL";
$modversion['official']     = 0;
$modversion['image']        = "images/funy_logo.png";
$modversion['dirname']      = _FUN_DIR_NAME;

// Admin things
$modversion['hasAdmin']     = 1;
$modversion['adminindex']   = "admin/index.php";
$modversion['adminmenu']    = "admin/menu.php";

//--------------------------------------------------------

//install:
//$modversion['onInstall']     = 'include/install.php';
$modversion['onInstall']     = 'admin/admin_version.php';
//suppression:
//$modversion['onUninstall']   = 'include/uninstall.php';
$modversion['onUninstall']   = 'admin/admin_version.php';
//mise à jour:
//$modversion['onUpdate'] = 'include/update.php';
$modversion['onUpdate'] = 'admin/admin_version.php';
//--------------------------------------------------------

// Blocks
/*

*/

$i=1;
$modversion['blocks'][$i]['file']        = "funy_block_main.php";
$modversion['blocks'][$i]['name']        = 'Funy'; 
$modversion['blocks'][$i]['title']       = 'Funy (JJD)'; 
$modversion['blocks'][$i]['description'] = '_MD_FUN_CONTROL';
$modversion['blocks'][$i]['show_func']   = "funy_show_control";
$modversion['blocks'][$i]['edit_func']   = "funy_edit_control";
$modversion['blocks'][$i]['options']     = "0";
$modversion['blocks'][$i]['template']    = 'funy_block_action.html';

$i++;
$modversion['blocks'][$i]['file']        = "funy_block_main.php";
$modversion['blocks'][$i]['name']        = 'Funy-script';  
$modversion['blocks'][$i]['description'] = '_MD_FUN_NAME';
$modversion['blocks'][$i]['show_func']   = "funy_show_script";
$modversion['blocks'][$i]['edit_func']   = "funy_edit_script";
$modversion['blocks'][$i]['options']     = "5";
$modversion['blocks'][$i]['template']    = 'funy_block_script.html';

$i++;
$modversion['blocks'][$i]['file']        = "funy_block_main.php";
$modversion['blocks'][$i]['name']        = 'Funy-rename';  
$modversion['blocks'][$i]['description'] = '_MD_FUN_RENAME';
$modversion['blocks'][$i]['show_func']   = "funy_show_rename";
$modversion['blocks'][$i]['edit_func']   = "funy_edit_rename";
$modversion['blocks'][$i]['options']     = "999";
$modversion['blocks'][$i]['template']    = 'funy_block_rename.html';



for ($h = 0; $h < 5; $h++){
  $i++;
  $modversion['blocks'][$i]['file']        = "funy_block.php";
  $modversion['blocks'][$i]['name']        = "funy_block_{$h}";  
  $modversion['blocks'][$i]['description'] = "_MD_FUN_TEXTE{$h}";
  $modversion['blocks'][$i]['show_func']   = "funy_show_block";
  $modversion['blocks'][$i]['edit_func']   = "funy_edit_block";
  $modversion['blocks'][$i]['options']     = "{$h}";
  $modversion['blocks'][$i]['template']    = "funy_block_{$h}.html";
}



// Menu -----------------------------------------------------------------
$modversion['hasMain'] = 1;
/*


$i=0;
$modversion['sub'][$i]['name']  = _MI_HER_PROFILE;
$modversion['sub'][$i]['url']   = "index.php?op=profile";
*/
//-----------------------------------------------------------------

// All tables should not have any prefix!
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
//$modversion['sqlfile']['proverbe-01'] = "sql/proverbe-01.sql";


// Tables created by sql file (without prefix!)
$i = 0;
$modversion['tables'][$i++]  = _FUN_TAB_EVENT;
$modversion['tables'][$i++]  = _FUN_TAB_PARAM;
$modversion['tables'][$i++]  = _FUN_TAB_BALISE;
$modversion['tables'][$i++]  = _FUN_TAB_SMARTY;
$modversion['tables'][$i++]  = _FUN_TAB_PROVERBE;

/*------------------------------------------------------------------
 Templates

$i = 0;

$i++;
$modversion['templates'][$i]['file']         = 'funy_block_rename.html';
$modversion['templates'][$i]['description']  = 'Funy detail plugin';
------------------------------------------------------------------*/


//------------------------------------------------------------------
// Search
//------------------------------------------------------------------

$modversion['hasSearch']      = 0;

/*
$modversion['search']['file'] = "include/search.inc.php";
$modversion['search']['func'] = "her_search";
*/
// Comments
$modversion['hasComments']          = 0;


       
//------------------------------------------------------------------
// Config Settings
//------------------------------------------------------------------
$i=-1;
//------------------------------------------------------------------
// General 
//------------------------------------------------------------------
$i++;
$modversion['config'][$i]['name'] = 'dateVersion';
$modversion['config'][$i]['title'] = '_MI_FN_DateVersion';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'hidden';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '18/03/2007';
//------------------------------------------------------------------

$i++;
$modversion['config'][$i]['name'] = 'editor';
$modversion['config'][$i]['title'] = '_MI_FUN_EDITOR';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 1;
$modversion['config'][$i]['options'] =  getEditorList();


$i++;
$modversion['config'][$i]['name'] = 'urlDoc';
$modversion['config'][$i]['title'] = '_MI_FUN_URLDOC';
$modversion['config'][$i]['description'] = '_MI_FUN_URLDOC_DSC';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'xoops.kiolo.com';

//--------------------------------------------------------------


//----styles defauts---------------------------------------------------




//------------------------------------------------------------------------
// Notification
$modversion['hasNotification'] = 0;



?>
