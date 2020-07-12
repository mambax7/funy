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


class cls_fun_1_22a{  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
  var $version      = '1.06a';  
  var $dateVersion  = "2008-12-31 12:12:12"; //date("Y-m-d h:m:s");
  var $description  = "mofification pour nouveaux type de plugin";

            

/************************************************************
 * Constructucteur:
 ************************************************************/
  function  cls_fun_1_22a($options){
 
  }

/*************************************************************************
 *
 *************************************************************************/
function getVersion()     {return $this->version;}
function getDateVersion() {return $this->dateVersion;}
function getDescription() {return $this->description;}


/*************************************************************************
 *
 *************************************************************************/

function updateModule(&$module){

    $this->alter_event();
    $this->alter_smarty();    
    return true;

} // fin updtateModule




/*************************************************************************
 *
 *************************************************************************/
function alter_event(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('fun_event');  
  
  $sql = "ALTER TABLE {$table} "
        ." ADD `description` VARCHAR( 255 ) NOT NULL,"  
        ." ADD `multi` TINYINT NOT NULL DEFAULT '0';";  
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  
  return true;   
   
}//fin 


/*************************************************************************
 *
 *************************************************************************/
function alter_smarty(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('fun_smarty');  
  
  $sql = "ALTER TABLE {$table} "
        ." ADD `flag` TINYINT NOT NULL DEFAULT '0';";  
  
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  
  return true;   
   
}//fin 


//-----------------------------------------------------------
//-----------------------------------------------------------

} // fin de la classe

?>


