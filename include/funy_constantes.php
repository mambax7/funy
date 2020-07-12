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

//-----------------------------------------------------------------
define ('_FUN_SHOWID', true);
define ('_funbr', "\n");
define ('_sqlbr', " \n");
//define ('_br', '<br>');
//-----------------------------------------------------------------
//Definition des constante e dossier
//-----------------------------------------------------------------
global $xoopsModule, $xoopsDB;
if (!defined('_FUN_DIR_NAME')){ 
    define ('_FUN_DIR_NAME','funy');
}

$slashP = ((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/');
$slashU = ((substr(XOOPS_URL,  -1) == '/') ? '' : '/');

define ('_FUN_JJD_PATH',      XOOPS_ROOT_PATH.$slashP.'modules/jjd_tools/_common/');
define ('_FUN_SUB_FOLDER',       '/modules/'._FUN_DIR_NAME.'/'  );
define ('_FUN_ROOT_PATH',     XOOPS_ROOT_PATH.$slashP.'modules/'._FUN_DIR_NAME.'/'  );


define ('_FUN_DIR_PLUGIN',     _FUN_ROOT_PATH.'_plugins/');
define ('_FUN_DIR_PLUGIN_DEC', _FUN_ROOT_PATH.'_plugin_declaration/');
//define ('_FUN_DIR_RESSOURCES', _FUN_ROOT_PATH.'_ressources/');
define ('_FUN_DIR_RESSOURCES', _FUN_ROOT_PATH.'images/');
//----------------------------------------------------------------------
define ('_FUN_URL',           XOOPS_URL._FUN_SUB_FOLDER);

define ('_FUN_URL_ADMIN',      _FUN_URL.'admin/');
define ('_FUN_URL_IMG',        _FUN_URL.'images/');
define ('_FUN_URL_ICONES',     _FUN_URL.'images/icones/');
define ('_FUN_URL_CACHE',      _FUN_URL.'cache/');
define ('_FUN_URL_RESSOURCES', _FUN_URL.'_ressources/');
define ('_FUN_URL_PLUGIN',     _FUN_URL.'_plugins/');
define ('_FUN_URL_PLUGIN_DEC', _FUN_URL.'_plugin_declaration/');

//-----------------------------------------------------------------
define ('_FUN_JS_TOOLS',     _FUN_URL.'js/funy.js');
define ('_FUN_JSI_TOOLS',     "<script type=\"text/javascript\" src=\""._FUN_JS_TOOLS."\"></script>\n");


//-----------------------------------------------------------------

//-----------------------------------------------------------------
//Definition des constante de table
//-----------------------------------------------------------------
define ('_FUN_TBL_PREFIXE',     'fun_');

define ('_FUN_TBL_EVENT',       'event');
define ('_FUN_TBL_PARAM',       'param');
define ('_FUN_TBL_BALISE',      'balise');
define ('_FUN_TBL_SMARTY',      'smarty');
define ('_FUN_TBL_PROVERBE',    'proverbe');
//-------------------------------------------------------
define ('_FUN_TAB_EVENT',       _FUN_TBL_PREFIXE._FUN_TBL_EVENT);
define ('_FUN_TAB_PARAM',       _FUN_TBL_PREFIXE._FUN_TBL_PARAM);
define ('_FUN_TAB_BALISE',      _FUN_TBL_PREFIXE._FUN_TBL_BALISE);
define ('_FUN_TAB_SMARTY',      _FUN_TBL_PREFIXE._FUN_TBL_SMARTY);
define ('_FUN_TAB_PROVERBE',    _FUN_TBL_PREFIXE._FUN_TBL_PROVERBE);
//-----------------------------------------------------------------
define ('_FUN_TFN_EVENT',       $xoopsDB->prefix(_FUN_TAB_EVENT));
define ('_FUN_TFN_PARAM',       $xoopsDB->prefix(_FUN_TAB_PARAM));
define ('_FUN_TFN_BALISE',      $xoopsDB->prefix(_FUN_TAB_BALISE));
define ('_FUN_TFN_SMARTY',      $xoopsDB->prefix(_FUN_TAB_SMARTY));
define ('_FUN_TFN_PROVERBE',    $xoopsDB->prefix(_FUN_TAB_PROVERBE));
//-----------------------------------------------------------------
define ('_FUN_BLOC_MAX',       3);

//-----------------------------------------------------------------

//---------------------------------
define ('_FUNJJD_DEBUG',        255);
//---------------------------------




//------------------------------------------------------------------------




                             
/*************************************************************************
* definition des onglets
*************************************************************************/
define('_FUN_ONGLET_GESTION',     1);
define('_FUN_ONGLET_PLUGIN',      2);
define('_FUN_ONGLET_EVENT',       3);
define('_FUN_ONGLET_PROVERBE',    4);
define('_FUN_ONGLET_BALISE',      5);
define('_FUN_ONGLET_BLOCK',       6);

define('_FUN_ONGLET_DOC',         7);
define('_FUN_ONGLET_LICENCE',     _FUN_ONGLET_DOC + 1);
define('_FUN_ONGLET_HISTO',       _FUN_ONGLET_DOC + 1);


/*************************************************************************
* definition des type de paramètres à utiliser dans les fichier de config des plugins
*************************************************************************/
define ('_FUN_TP_NOT_DEFINED',   0); //non définie
define ('_FUN_TP_SPIN',          1); //spin
define ('_FUN_TP_LIST',          2); //liste de libele dont le numéro d'ordre est atomatique 
define ('_FUN_TP_FILES',         3); //liste de fichiers
define ('_FUN_TP_COLOR',         4); //couleur
define ('_FUN_TP_HTML_TEXT',     5); //texte HTML
define ('_FUN_TP_HIDDEN_VAR',    6); //variable masquée déclarée dans le fichier ini mais non modifiable
define ('_FUN_TP_TABLE_LIST',    7); //liste de valeur dans une table
define ('_FUN_TP_URL_FUNY',      8); //URL du site sur le module funy
define ('_FUN_TP_DESCRIPTION',   9); //descripption avec maleur chachée
define ('_FUN_TP_TITLE',        10); //titre   
define ('_FUN_TP_HTML_FILE',    11); //texte html dans un fichier   
define ('_FUN_TP_ASCII_TEXT',   12); //texte ascii texte 
define ('_FUN_TP_ASCII_FILE',   13); //texte ascii dans un fichier
define ('_FUN_TP_LIBELLES',     14); //c'est une liste de libele c'est le libelle qui est stockée   
define ('_FUN_TP_FOLDER',       15); //liste de fichier dans un répertoire
define ('_FUN_TP_URL',          16); //URL du site 
define ('_FUN_TP_ARRAY',        17); //------------- 
define ('_FUN_TP_CHECKLISTBIN', 18); //-------------
define ('_FUN_TP_CHECKLIST',    18); //-------------
define ('_FUN_TP_LINE',         20); //ligne de séparation pour aérer l'afficha des paramètres
define ('_FUN_TP_FOLDER_FUNY',  21); //liste de fichier dans un répertoire

define ('_FUN_TP_NEW_BALISE',  999); //pas pris en compte ce sont de nouvelle balise

 



?>
