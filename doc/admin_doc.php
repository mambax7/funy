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


include_once ("../admin/admin_header.php");
include_once (_HER_JJD_PATH.'include/adminOnglet/adminOnglet.php');


//require_once (XOOPS_ROOT_PATH."/include/jjd/functions.php");
//require_once (XOOPS_ROOT_PATH."/include/jjd/html_functions.php");



//define ("_br", "<br>");

//-------------------------------------------------------------
$vars = array(array('name' =>'op',        'default' => 'hermes'),
              array('name' =>'pinochio',  'default' => false));
              
require (_HER_JJD_PATH."include/gp_globe.php");
//-------------------------------------------------------------

/*****************************************************************************
 *  controleur
*****************************************************************************/

    

   admin_xoops_cp_header(_FUN_ONGLET_DOC + $gepeto['numDoc'], $xoopsModule);
   $tDoc = array('funy','GPL'); 
//    displayArray ($tDoc, "***** docs *****");
    viewDoc ($tDoc[$gepeto['numDoc']], $xoopsConfig['language'], _HER_ROOT_PATH);

  
  admin_xoops_cp_footer();





?>
