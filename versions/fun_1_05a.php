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


class cls_fun_1_05a{  

/************************************************************
 * declaration des varaibles membre:
 ************************************************************/
  var $version      = '1.05a';  
  var $dateVersion  = "2008-12-31 12:12:12"; //date("Y-m-d h:m:s");
  var $description  = "gestion des balise";

            

/************************************************************
 * Constructucteur:
 ************************************************************/
  function  cls_fun_1_05a($options){
 
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

    $this->alter_balise();
    $this->update_balise();
    
    return true;

} // fin updtateModule




/*************************************************************************
 *
 *************************************************************************/
function alter_balise(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('fun_balise');  
  
  $sql = "ALTER TABLE {$table} "
        ."ADD `ordre` INT NOT NULL DEFAULT '0',"
        ."ADD `actif` TINYINT NOT NULL DEFAULT '1';";  
  
  $xoopsDB->queryF ($sql);  
  //--------------------------------------------------  
  return true;   
   
}//fin 



/*************************************************************************
 *
 *************************************************************************/
function update_balise(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('fun_balise');  
  
  $sql = "DELETE FROM {$table WHERE smarty like '%funy_param%'};";  
  $xoopsDB->queryF ($sql);  
  
  $sql = "
    INSERT INTO `{$table}` (`nom`, `smarty`, `position`, `repere`, `instance`, `unkill`, `ordre`, `actif`) VALUES
    ('funy_param', '<{\$funy_param}>', 1, '</head>', 1, 1, 10, 1),
    ('head_fin', '<{\$funy_head}>%%', 1, '</head>', 1, 1, 20, 1),
    ('body', '<{\$funy_body}>', 2, '<body>', 1, 1, 50, 1),
    ('body_onload', '<{\$funy_body_onload}>', 2, '<body', 1, 1, 70, 1),
    ('body_fin', '<{\$body_fin}>', 1, '</body>', 0, 1, 60, 1),
    ('funy_start_all', '<{\$funy_start_all}>', 1, '</head>', 1, 1, 40, 1),
    ('funy_stop_all', '<{\$funy_stop_all}>', 1, '</head>', 1, 1, 30, 1);";
  $xoopsDB->queryF ($sql);

  //--------------------------------------------------  
  return true;   
   
}//fin 
/*************************************************************************
 *
 *************************************************************************/
function update_balise(){
global $xoopsModuleConfig, $xoopsDB;

  //-------------------------------------------  
  $table = $xoopsDB->prefix('fun_balise');  
  
  $sql = "DELETE FROM {$table};";  
  $xoopsDB->queryF ($sql);  
  
  $sql = "
    INSERT INTO `{$table}` (`nom`, `smarty`, `position`, `repere`, `instance`, `unkill`, `ordre`, `actif`) VALUES
    ('funy_param', '<{\$funy_param}>', 1, '</head>', 1, 1, 10, 1),
    ('funy_head_fin', '<{\$funy_head}>%%', 1, '</head>', 1, 1, 20, 1),
    ('funy_body', '<{\$funy_body}>', 2, '<body>', 1, 1, 50, 1),
    ('funy_body_onload', '<{\$funy_body_onload}>', 2, '<body', 1, 1, 70, 1),
    ('funy_body_fin', '<{\$body_fin}>', 1, '</body>', 0, 1, 60, 1),
    ('funy_start_all', '<{\$funy_start_all}>', 1, '</head>', 1, 1, 40, 1),
    ('funy_stop_all', '<{\$funy_stop_all}>', 1, '</head>', 1, 1, 30, 1);";
  $xoopsDB->queryF ($sql);

  //--------------------------------------------------  
  return true;   
   
}//fin 




//-----------------------------------------------------------
//-----------------------------------------------------------

} // fin de la classe

?>


