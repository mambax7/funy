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


//-----------------------------------------------------------------------------------
global $xoopsModule;
include_once (XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')
                               ."/modules/".$xoopsModule->getVar('dirname')
                               ."/include/funy_constantes.php");
//-----------------------------------------------------------------------------------


//-------------------------------------------------------------
$vars = array(array('name' =>'op',        'default' => 'list'),
              array('name' =>'pinochio',  'default' => false));
require (_FUN_JJD_PATH."include/gp_globe.php");
//-------------------------------------------------------------


function listPlugin () {
global $xoopsModule, $xoopsDB;
 
    
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
	  //xoops_cp_header();
    $line = buildHR(1, '696969',5);
    OpenTable();
    //**********************************************************************************    
    //echo "<b>"._AD_FUN_TEXTES."</b><br>";    

    $sqlquery = db_getFunyPlugins ();
    
    //displayArray($sqlquery,"----- db_getFunyPlugins -----");
    echo "<table>";  
    
    //foreach ($sqlquery as $sqlfetch => $v) {
    while (list ($key, $section) = each ($sqlquery)) {
    //print_r ($section);    echo"<hr>";
    
    $sqlfetch = $section['info'];
    //displayArray($sqlfetch,"----- listPlugin -----");          
    //while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      echo '<tr>';
      //echo "<td>{$sqlfetch['idPlugin']}</td>";      
      echo "<td><b>{$sqlfetch['nom']}</b></td>";
      //echo "<td>{$sqlfetch['description']}</td>";            
        //$idEvent = $sqlfetch['idEvent'];
      
      $link = "<a href='{$sqlfetch['site']}'>{$sqlfetch['auteur']}</a>";
      echo "<td>{$link}</td>";
      echo "<td>{$sqlfetch['description']}<br><i>{$sqlfetch['shortName']}</1></td>";
        
         //echo "<hr>nom = {$sqlfetch['shortName']}<hr>";
        //--------------------------------------
      $f = _FUN_DIR_PLUGIN.$sqlfetch['shortName'];	
      $ini = parse_ini_file($f, true);	
      //echo "<hr>showDescription<br>$plugin<br>{$f}<br>{$ini['info']['fichierDescription']}<hr>";
      
      $ok = false;
      $ok =  (isset ($ini['info']['fichierDescription']));
        if ($ok){
          $link = "admin_plugin.php?op=showDescription&plugin=".$sqlfetch['shortName'];   
          echo build_icoOption($link, _JJDICO_URL.'comment3.gif', _AD_FUN_DESCRIPTION);               
        }else{        
          echo "<td></td>";          
        } 	   
       
        //-----------------------------------------------------------------------  
        //echo "<hr>nom = {$sqlfetch['shortName']}<hr>";
        if ((true) & ($sqlfetch['nom'] == 'global' | $sqlfetch['nom'] == 'global_js')){
          echo "<td></td>";          
        }else{
          $link = "admin_event.php?op=new&plugin=".$sqlfetch['shortName'];   
          echo build_icoOption($link, _JJDICO_NEW, _AD_FUN_NEW);               
        } 	   


        //-----------------------------------------------------------------------
/*


        //suppression          
    	  $link = "admin_event.php?op=remove&idEvent={$idEvent}&name={$sqlquery['nom']}";        
        echo build_icoOption($link, _JJDICO_REMOVE, _AD_FUN_DELETE);
*/        
        
        //-----------------------------------------------------------------------
        /*

        //previsualisation du texte
    	  $link = "admin_texte.php?op=previewTexte&id={$idEvent}&name={$sqlquery['nom']}";        
        echo build_icoOption($link, _JJDICO_VIEW, _AD_FUN_VIEWTEXT); 
       //-----------------------------------------------------------------------  
        */      
      
      
      
      
      echo '</tr>';      
      echo $line; 
    }
    
    echo "</table>";      


    //**********************************************************************************
echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
  <tr valign='top'>
    <td align='left' ><input type='button' name='cancel' value='"._CLOSE."' onclick='".buildUrlJava("index.php",false)."'></td>
    <td align='left' width='200'></td>

  </tr>
  </form>";

//    <td align='right'>
//    <input type='button' name='new' value='"._AD_FUN_NEW."' onclick='".buildUrlJava("admin_event.php?op=new",false)."'>    
    
	CloseTable();
	//xoops_cp_footer();

}

/****************************************************************
 *
 ****************************************************************/

function showDescription ($plugin) {
global $xoopsModule, $xoopsDB;



    //********************************************************************
	  //echo "<div align='center'><B>"._AD_FUN_ADMIN." ".$xoopsConfig['sitename']."</B><br>";
  	//echo "<B>"._AD_FUN_TEXTE_MANAGEMENT."</B></div>";
    
 		echo "<FORM ACTION='admin_plugin.php?op=list' METHOD=POST>"._funbr;
    
    //********************************************************************
    //CloseTable();
    OpenTable();   
    echo "<table width='80%'>";     
    //********************************************************************  
    //echo buildTitleOption (_AD_FUN_OPTIONS_GENERALES,_AD_FUN_OPTIONS_GENERALES_DESC);    
    //********************************************************************
   
      $f = _FUN_DIR_PLUGIN.$plugin;	
      $ini = parse_ini_file($f, true);	
      //echo "<hr>showDescription<br>$plugin<br>{$f}<br>{$ini['info']['fichierDescription']}<hr>";
      
      if (isset ($ini['info']['fichierDescription'])){
        $f = getFileLang($f, $ini['info']['fichierDescription']);      
        $content = loadTextFile($f);   
      }else{
        $content = _AD_FUN_NO_DESCRIPTION;
      }
      //echo "<hr>{$f}<hr>";
      //displayArray($ini,'-------getEvent-------------');
      
   //-------------------------------------------------------
    if (!isset($ini['info']['site'])) $ini['info']['site'] = ''; 
    $url = (($ini['info']['site'] == '') ? ''  : " ===> <a href='{$ini['info']['site']}'>site</a>");  
    
    echo "<tr><td>";
    echo "<strong>{$ini['info']['nom']} ({$ini['info']['auteur']})</strong>{$url}";
    echo "</td></tr>";    
    echo buildHR(1,'696969',1);
    echo "<tr><td>";
    echo "<pre>{$content}</pre>";
 
    echo "</td></tr>"; 
    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>"._funbr;    
    //********************************************************************



    echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
      <tr valign='top'>
    
        <td align='right'>
        <input type='submit' name='submit' value='"._AD_FUN_CLOSE."' )'>    
        </td>    
      </tr>
      </table>
      </form>";
    
        
    	CloseTable();
//    	xoops_cp_footer();

      //------------------------------------------------------------------
      //$xoopsTpl->append('dic_post', $post);
    




























}
 



/****************************************************************
 *
 ****************************************************************/

function clearPlugin ($lib) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "DELETE FROM "._FUN_TFN_EVENT." "
	      ."WHERE idEvent = ".$id;
	
       $xoopsDB->query($sql);	

	
  
}



 
/****************************************************************************
 *
 ****************************************************************************/
function getPlugin (){
	global $xoopsModuleConfig, $xoopsDB;
   

  if ($idEvent == 0) {
      $p = array ('idPlugin'           => 0, 
                  'nom'               => '',
                  'dateDebut'         => '',
                  'dateFin'           => '',
                  'periodicite'       => 0,
                  'actif'             => 1);

  }
  else {
    	
    $sql = "SELECT  * FROM "._FUN_TFN_PLUGIN
          ." WHERE idPlugin = ".$idPlugin;
  
    //echo $sql."<br>";          
    $sqlquery=$xoopsDB->query($sql);
    //$p =  $xoopsDB->fetchRow($sqlquery);
    $sqlfetch=$xoopsDB->fetchArray($sqlquery);
    
   $p = $sqlfetch;

   $p['nom']      = sql2string ($p['nom']);




    
  }
  return $p;
}

/************************************************************************
 *
 ************************************************************************/
 
  admin_xoops_cp_header(_FUN_ONGLET_PLUGIN, $xoopsModule); 

  switch($op) {
  case "list":
		listPlugin ();
		break;


  case "save":
		savePlugin ($_POST);
    redirect_header("admin_plugin.php?op=list",1,_AD_FUN_ADDOK);		
		break;


  case "showDescription":
    showDescription ($gepeto['plugin']);		   
    break;



  case "removeOk":
		//saveTexte ($_POST);
    //deleteTexte ($id);
    deletePlugin ($_POST['idEvent']);    
    redirect_header("admin_plugin.php?op=list",1,_AD_FUN_DELETEOK);    
		break;

  case "clear":
		//saveTexte ($_POST);
    clearPlugin ($id);
    redirect_header("admin_plugin.php?op=edit",1,_AD_FUN_ADDOK);    
		break;


		
	default:
	 $state = _FUN_STATE_WAIT;
    redirect_header("admin_Plugin.php?op=list",1,_AD_FUN_ADDOK);
    break;
}


   
admin_xoops_cp_footer();

 

 
//---------------------------------------------------------------------
    



?>
