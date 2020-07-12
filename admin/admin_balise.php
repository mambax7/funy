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
$slash = ((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/');
include_once (XOOPS_ROOT_PATH.$slash."/modules/".$xoopsModule->getVar('dirname')
                                    ."/include/funy_constantes.php");
include_once (XOOPS_ROOT_PATH.$slash."/modules/".$xoopsModule->getVar('dirname')
                                    ."/include/funy_generique.php");
                                     
                                     
//-----------------------------------------------------------------------------------


//-------------------------------------------------------------
$vars = array(array('name' =>'op',        'default' => 'list'),
              array('name' =>'idBalise',  'default' => 0),
              array('name' =>'pinochio',  'default' => false));
require (_FUN_JJD_PATH."include/gp_globe.php");
//-------------------------------------------------------------


function listBalise () {
global $xoopsModule, $xoopsConfig, $xoopsDB;
 
    
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
  	$myts =& MyTextSanitizer::getInstance();
	  //xoops_cp_header();
    $tPosition = getBalisepositions();
    $tBalises = getBalisesInsertedA($xoopsConfig['theme_set']);
    //displayArray($tBalises, "listBalise");

    OpenTable();
    //**********************************************************************************    
    //echo "<b>"._AD_FUN_TEXTES."</b><br>";    

    $sqlquery = db_getBalises ();
    echo "<FORM ACTION='admin_balise.php?op=new' METHOD=POST>"._funbr;

    //displayArray($sqlquery,"----- db_getBalises -----");
    echo "<table>";  
    
    
    
        
    $f = _FUN_ROOT_PATH . "doc/help/avertissement-balises-{$xoopsConfig['language']}.html";
    if (!file_exists($f)){
      $lg = "english";    
      $f = _FUN_ROOT_PATH . "doc/help/avertissement-balises-{$lg}.html";    
    }
    //echo "<hr>{$f}<hr>";
    $content =   $content = file_get_contents($f);
    $content = str_replace (chr(13), "", $content);
    $content = str_replace (chr(10), " ", $content);    
    echo buildTitleOption4a(_AD_FUN_AVERTISSEMENT,$content,11,'000000',false,true);
    //echo "</tr>";    

    //-titre des lolones
    echo "<tr>";
    echo "<td align='right'>#</td>";
    echo "<td>"._AD_FUN_NAME."</td>";    
    echo "<td>"._AD_FUN_TEXTE."</td>";    
    echo "<td>"._AD_FUN_POSITION."</td>";    
    echo "<td>"._AD_FUN_REPERE."</td>";
    echo "<td>"._AD_FUN_REPEAT."</td>";    
    echo "<td>"._AD_FUN_ACTIF."</td>";  
    echo "<td>"._AD_FUN_ORDRE."</td>";    
    echo "<td>".""."</td>";  
    echo "<td>".""."</td>";    
          
    echo "</tr>";
  
    $numLine = 0;
    //foreach ($sqlquery as $sqlfetch => $v) {
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $idBalise = $sqlfetch['idBalise'];    
      
      //--------------------------------------------------------
      //test pour mettre en gras les balises insérées dans le themes actuel
      //--------------------------------------------------------
      if(isset($tBalises[$idBalise])){      
        $b1 = '<strong>';
        $b2 = '</strong>'; 
      }else{      
        $b1 = '';
        $b2 = ''; 
      }      

      //--------------------------------------------------------      
      
      echo '<tr>';
      
     echo "<TD align='center'  >"
         ."<INPUT TYPE=\"hidden\" "
         ." NAME='txtBalise[{$idBalise}][idBalise]'  size='1%'  " 
         ." VALUE='{$idBalise}'>"
         ."{$sqlfetch['idBalise']}</td>";
      
      $nom = $myts->displayTarea($sqlfetch['nom'], "1", "1", "1");
      echo "<td>{$b1}{$nom}{$b2}</td>";

      $nom = $myts->displayTarea($sqlfetch['smarty'], "1", "1", "1");
      echo "<td>{$nom}</td>";

      
      $position = $tPosition[$sqlfetch['position']];     
      echo "<td>{$position}</td>";

      $repere = $myts->displayTarea($sqlfetch['repere'], "0", "0", "0");
      echo "<td>{$repere}</td>";
      //echo "<td><code>{$sqlfetch['repere']}</code></td>";      
      
      $lib = (($sqlfetch['instance'] == 0) ? _AD_FUN_EVERYWHERE : $sqlfetch['instance'].' '._AD_FUN_TIME);
      echo "<td>{$lib}</td>";
      
      //echo "<td>[{$sqlfetch['ordre']}]</td>";


/*
     echo "<TD align='center'  >"
         ."<INPUT TYPE=\"hidden\" id='txtActif_{$h}'  "
         ." NAME='txtActif_{$h}'  size='1%'  " 
         ." VALUE='1'>"
         .(($sqlfetch['actif']==1) ? '<b>X</b>' : '')

      $c = ($sqlfetch['actif']==1)?"checked":"";
      echo "<TD align='center'  ><input type='checkbox' "
           ."ID='txtActif_{$h}' NAME='txtActif_{$h}' size='5%' "
           ."value='1' ".$c."></td>\n";
*/    

      $c = ($sqlfetch['actif']==1)?"checked":"";
      echo "<TD align='center'  ><input type='checkbox' "
           ."NAME='txtBalise[{$idBalise}][actif]' size='5%' "
           ."value='1' ".$c.">"
           ."</td>\n";


    //---ordre
      echo "<TD align='center'  >";
    $lwSpin=5;
    echo htmlSpin ("","txtBalise[{$idBalise}][ordre]", (++$numLine)*10 , 99, 1, 1, $lwSpin , '', 1);      
      echo "</TD>\n";
      
          //echo htmlSpin ("","txtStrOrdre_{$numLine}", ($numLine+1)*10, 365, 1, 1, $lwSpin , '', 1);      

/*


      echo buildSpin(_FUN_AD_INSTANCE, _FUN_AD_INSTANCE_DSC , 
                     $txtName, $sqlfetch['instance'], 0, 99, 1, 10);
*/    
      $jjd = false;    
      if ($sqlfetch['unkill'] == 0 | $jjd){
      
        //-----------------------------------------------------------------------   	   
        $link = "admin_balise.php?op=edit&idBalise=".$idBalise;
        echo build_icoOption($link, _JJDICO_EDIT, _AD_FUN_EDIT);
        //-----------------------------------------------------------------------
        //suppression          
    	  $link = "admin_balise.php?op=remove&idBalise={$idBalise}";        
        echo build_icoOption($link, _JJDICO_REMOVE, _AD_FUN_DELETE);
        //-----------------------------------------------------------------------
      
      }else{
        //echo "<td align='center'>X</td>";      
        echo "<td align='center'>X</td>"; 
        echo "<td align='center'>X</td>";             
      }
      
      
      
      echo '</tr>';       
    }
    
    echo "</table>";      


    //**********************************************************************************
echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
  <tr valign='top'>
    <td align='left' ><input type='button' name='cancel' value='"._CLOSE."' onclick='".buildUrlJava("index.php",false)."'></td>
    <td align='left' width='200'></td>


    <td align='right'>
    <input type='submit' name='actif' value='"._AD_FUN_UPDATE."' onclick='".buildUrlJava("admin_balise.php?op=actif",false)."'>    
    </td>

    <td align='right'>
    <input type='button' name='new' value='"._AD_FUN_NEW."' onclick='".buildUrlJava("admin_balise.php?op=new",false)."'>    
  </tr></table>
  </form>";

    
  CloseTable();
	//xoops_cp_footer();
	//-----------------------------------------------------------------
 	// passons maintenant … l'affectation des balises aux feuilles de styles
   //----------------------------------------------------------------- 
  OpenTable();

    echo "<FORM ACTION='admin_balise.php?op=balise' METHOD=POST>"._funbr;

    //displayArray($sqlquery,"----- db_getBalises -----");
    echo "<table>";  
    

    //---Feuille de style   
    $f = XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')."themes/";
    $lstCSS = getFileListH($f, 'theme.html', 1);
    array_unshift ( $lstCSS, '');    
    $lg = strlen($f);

    $i = 0;
    for ($h = 0; $h < count($lstCSS); $h++){
      $lstCSS[$h] = substr(dirname($lstCSS[$h]), $lg);
      echo "<INPUT TYPE=\"hidden\" id='txtCSS_{$h}'  NAME='txtCSS_{$h}'  size='1%'"." VALUE='{$lstCSS[$h]}'>";
      if ($lstCSS[$h] ==  $xoopsConfig['theme_set']) $i = $h; 
  //$fds = XOOPS_URL."/themes/{$xoopsConfig['theme_set']}/style.css";      
    }

    echo buildList(_AD_FUN_THEME, _AD_FUN_STYLE_SHEET_FUN_DSC, 'txtFeuilleDeStyle', $lstCSS, $i);  //    
    
    //afichae en liste des balis insee dans le theme actuel
    //$lstBalises = getBalisesInsertedA($xoopsConfig['theme_set']);
    //echo "<tr><td>"._AD_FUN_BALISES_INSERTED."</td><td>{$lstBalises}</td></tr>";

/*

    //********************************************************************

    //---Feuille de style   
    $f = XOOPS_ROOT_PATH.((substr(XOOPS_ROOT_PATH, -1) == '/') ? '' : '/')."themes/";
    echo buildListFromFolder(_AD_HER_STYLE_SHEET, 
                             _AD_HER_STYLE_SHEET_DSC, 
                             $p['feuilleDeStyle'],                             
                             'txtFeuilleDeStyle',
                             $f, 
                             'style.css', 
                             1,                             
                             $AddBlanck = true );
    
    
  $fds = XOOPS_URL."/themes/{$xoopsConfig['theme_set']}/style.css";  

*/











    //**********************************************************************************
echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
  <tr valign='top'>
    <td align='left' ><input type='button' name='cancel' value='"._CLOSE."' onclick='".buildUrlJava("index.php",false)."'></td>
    <td align='left' width='200'></td>

    <td align='right'>
    <input type='submit' name='setBalise' value='"._AD_FUN_AFFECTERBALISES."' >    
    <input type='submit' name='clearBalise' value='"._AD_FUN_CLEARBALISES."' >
  </tr></table>
  </form>";
  
  
  CloseTable();
}


//-----------------------------------------------------------------
/*****************************************************************
 *
 *****************************************************************/
function editBalise($p){
Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
  
  //displayArray($p['param'], "--- editEvent ---");

	   $myts =& MyTextSanitizer::getInstance();

    //------------------------------------------------  
    $ligneDeSeparation = "<TR><td colspan='2'><hr></td></TR>"._funbr;  
    $listYesNo = array(_AD_FUN_NO,_AD_FUN_YES);    
    $tPosition = getBalisepositions();   
 
    //------------------------------------------------    

    
          
  //echo versionJS();
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
    OpenTable();  

        
    //********************************************************************
	  //echo "<div align='center'><B>"._AD_FUN_ADMIN." ".$xoopsConfig['sitename']."</B><br>";
  	//echo "<B>"._AD_FUN_TEXTE_MANAGEMENT."</B></div>";
    
 		echo "<FORM ACTION='admin_balise.php?op=save' METHOD=POST>"._funbr;
    
    //********************************************************************
    //CloseTable();
    //OpenTable();   
    echo "<table width='80%'>"._funbr;     
    //********************************************************************  
    //echo buildTitleOption (_AD_FUN_OPTIONS_GENERALES,_AD_FUN_OPTIONS_GENERALES_DESC);    
    //********************************************************************

    //---id
    echo "<TR>"._funbr;
    //echo "<TD align='left' >"."({$p['idEvent']})"."</TD>"._funbr;
    echo "<TD align='right' >".""." <INPUT TYPE=\"hidden\" id='idBalise'  NAME='idBalise'  size='1%'"." VALUE='{$p['idBalise']}'></TD>"._funbr;
    echo "</TR>"._funbr;    

    //---Name
    echo "<td>"._AD_FUN_PLUGIN." ({$p['idBalise']})</td><td><b>{$p['nom']}</b>"
        ."<INPUT TYPE=\"hidden\" id='idBalise'  NAME='idBalise'  size='1%'"." VALUE='".$p['idBalise']."'>"
        ."</td>"; 
    //---nom
    echo buildInput(_AD_FUN_NOM, '', 'txtNom', $myts->displayTarea($p['nom'], "1", "1", "1"), '60%');    

    //---smarty
    echo buildInput(_AD_FUN_TEXTE, '', 'txtSmarty', $myts->displayTarea($p['smarty'], "1", "1", "1"), '60%');    

    //---position
    echo buildList(_AD_FUN_POSITION, '', 'txtPosition', $tPosition, $p['position']);
    //$p['position'] = 0;
    //echo "<td></td><td> <INPUT TYPE=\"hidden\" id='txtPosition'  NAME='txtPosition'  size='1%'"." VALUE='{$p['position']}'></TD>";


    //---repere
    echo buildInput(_AD_FUN_REPERE, '', 'txtRepere', $myts->displayTarea($p['repere'], "1", "1", "1"), '60%');    
    
    //---nombre de remplacement
    echo buildSpin(_AD_FUN_INSTANCES, _AD_FUN_INSTANCES_DESC, 
                   'txtInstance', $p['instance'], 99, 0, 1, 10);

    echo buildSpin(_AD_FUN_ORDRE, _AD_FUN_ORDRE, 
                   'txtOrdre', $p['ordre'], 99, 0, 1, 10);


//////////////////////////////////////////////////////////////////////
    //---liste des codes de remplacement
    //jai change de présentation, mais jegarde pour revoir ca pus tard
    /*
    $oc = "insertTextIntoWysiwyg(\"lstCode\", \"txtTexte\",{$xoopsModuleConfig['editor']});";    
    $listCode = buildHtmlList ("lstCode", getCodeList(), 0,  0, $nbRows = 12, '', $oc);
    
    echo "<TD align='center' ><B>"._AD_FUN_TEXTE."</B><br>"._AD_FUN_TAGINFO."<br>{$listCode}</TD>"._br;    
    */
    //---texte    
    
   
    
 
 
    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>"._funbr;    
    //********************************************************************



    echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
      <tr valign='top'>
        <td align='left' ><input type='button' name='cancel' value='"._CANCEL."' onclick='".buildUrlJava("admin_balise.php",false)."'></td>
        <td align='left' width='200'></td>
    
        <td align='right'>
        <input type='submit' name='submit' value='"._AD_FUN_VALIDER."' )'>    
        </td>    
      </tr>
      </table>
      </form>";
    
        
    	CloseTable();
//    	xoops_cp_footer();

      //------------------------------------------------------------------
      //$xoopsTpl->append('dic_post', $post);
    


}




/*******************************************************************
 *
 *******************************************************************/
function saveBalise ($t) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	   $myts =& MyTextSanitizer::getInstance();
	    $name = $myts->displayTarea();	

  //------------------------------------
  
  $idBalise = $t['idBalise'];
  //-----------------------------------------------------------
   $t['txtNnom']      = string2sql($t['txtNom']);
   $t['txtRepere'] = string2sql($t['txtRepere']);
   
    
  if ($idBalise == 0){
    
      $sql = "INSERT INTO "._FUN_TFN_BALISE." "
            ."(nom, smarty, position, repere, instance, ordre)"
            ."VALUES (" 
            ."'{$t['txtNom']}',"  
            ."'{$t['txtSmarty']}',"            
            ."{$t['txtPosition']},"
            ."'{$t['txtRepere']}',"            
            ."{$t['txtInstance']},"          
            ."{$t['txtOrdre']}"              
            .")";

            
      $xoopsDB->query($sql);
    
  }else{
      $sql = "UPDATE "._FUN_TFN_BALISE." SET "
            ." nom               = '{$t['txtNom']}',"
            ." smarty            = '{$t['txtSmarty']}',"            
            ." position          = {$t['txtPosition']},"  
            ." repere            = '{$t['txtRepere']}',"  
            ." instance          = {$t['txtInstance']},"   
            ." ordre             = {$t['txtOrdre']}"            
            ." WHERE idBalise = ".$idBalise;
          
      $xoopsDB->query($sql);            
  }
           
//echo "<hr>{$sql}<hr>";  exit;
}


 
/****************************************************************************
 *
 ****************************************************************************/
function getBalise ($idBalise){
	global $xoopsModuleConfig, $xoopsDB;
   

  if ($idBalise == 0) {
      $p = array ('idBalise'          => 0, 
                  'nom'               => '',
                  'smarty'            => '',                  
                  'position'          => 0,
                  'repere'            => '',
                  'instance'          => 0,
                  'ordre'             => 99);

  }
  else {
    	
    $sql = "SELECT  * FROM "._FUN_TFN_BALISE
          ." WHERE idBalise = ".$idBalise;
  
    //echo $sql."<br>";          
    $sqlquery=$xoopsDB->query($sql);
    //$p =  $xoopsDB->fetchRow($sqlquery);
    $sqlfetch=$xoopsDB->fetchArray($sqlquery);
    
   $p = $sqlfetch;

   //$p['nom']      = sql2string ($p['nom']);




    
  }
  return $p;
}
/****************************************************************************
 *
 ****************************************************************************/
function updateBalisesActives ($p){
global $xoopsModuleConfig, $xoopsDB;
  
  //displayArray($p, "-------updateBalisesActives-------------");
  $sql = "UPDATE "._FUN_TFN_BALISE." SET actif = 0";
  $xoopsDB->query($sql);  
  
  while (list($key,$v) = each ($p) ){
    if (!isset($v['actif'])) $v['actif'] = 0;  
      $sql = "UPDATE "._FUN_TFN_BALISE
           . " SET actif = {$v['actif']},"
           . " ordre = {$v['ordre']}"
           . " WHERE idBalise={$v['idBalise']}";    
      //echo "<hr>{$sql}<hr>";
      $xoopsDB->query($sql);  
    
  }
}
/****************************************************************************
 *
 ****************************************************************************/
function updateBalisesActives2 ($p){
global $xoopsModuleConfig, $xoopsDB;
  
  //displayArray($p, "-------updateBalisesActives-------------");
  $sql = "UPDATE "._FUN_TFN_BALISE." SET actif = 0";
  $xoopsDB->query($sql);  
  
  while (list($key,$v) = each ($p) ){
    if (isset($v['actif'])){
      $sql = "UPDATE "._FUN_TFN_BALISE." SET actif = 1 WHERE idBalise={$v['idBalise']}";    
      //echo "<hr>{$sql}<hr>";
      $xoopsDB->query($sql);  
    
    }
  }
}
/****************************************************************************
 *
 ****************************************************************************/
function deleteBalise ($idBalise){
global $xoopsModuleConfig, $xoopsDB;
  
  //displayArray($p, "-------updateBalisesActives-------------");
  $sql = "DELETE FROM "._FUN_TFN_BALISE." WHERE idBalise={$idBalise}";
  $xoopsDB->query($sql);  
  
}

/****************************************************************
 *
 ****************************************************************/

function clearEvent ($lib) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "DELETE FROM "._FUN_TFN_EVENT." "
	      ."WHERE idEvent = ".$id;
	
       $xoopsDB->query($sql);	

	
  
}
/****************************************************************
 *
 ****************************************************************/
function buildFileBalise2Insert(){
	$balis2insert = getBalisesToInsertedInbloc();
	$f = _FUN_DIR_PLUGIN_DEC."balise2insert.html";
  fputContent ($f, $balis2insert, $msg );	

}


/************************************************************************
 *
 ************************************************************************/
 if (isset($gepeto['actif'])) $op="actif";
 //displayArray($gepeto, "------------");
 	buildFileBalise2Insert();
 	
  admin_xoops_cp_header(_FUN_ONGLET_BALISE, $xoopsModule); 

  switch($op) {
  case "list":
		listBalise ();
		break;

  case "new":
		//saveTexte ($_POST);
    $p = getBalise (0);
    editBalise ($p);
    //redirect_header("admin_Texte.php?op=edit",1,_AD_FUN_ADDOK);    
		break;

  case "save":
		saveBalise ($gepeto);
		//buildFileBalise2Insertt();
    redirect_header("admin_balise.php?op=list",1,_AD_FUN_ADDOK);		
		break;

  case "edit":
		//saveTexte ($_POST);
		$p = getBalise($idBalise);
    editBalise ($p);
    //redirect_header("admin_texte.php?op=edit",1,_AD_FUN_ADDOK);    
		break;

  case "actif":
		updateBalisesActives ($gepeto['txtBalise']);
		//buildFileBalise2Insertt();
    redirect_header("admin_balise.php?op=list",1,_AD_FUN_ADDOK);		
		break;



  case "remove":
    //xoops_cp_header();
    $msg = sprintf(_AD_FUN_CONFIRM_DEL, "<b>{$_GET['name']} (id:{$idBalise})</b>" , _AD_FUN_BALISES);            
    xoops_confirm(array('op'         => 'removeOk', 
                        'idBalise'    => $_GET['idBalise'] ,
                        'ok'         => 1),
                        "admin_balise.php", $msg );
//    xoops_cp_footer();
		break;		
		
  case "removeOk":
		//saveTexte ($_POST);
    //deleteTexte ($id);
    deleteBalise ($_POST['idBalise']);    
    //buildFileBalise2Insertt();
    redirect_header("admin_balise.php?op=list",1,_AD_FUN_DELETEOK);    
		break;

  case "clear":
		//saveTexte ($_POST);
    clearEvent ($id);
    //buildFileBalise2Insertt();
    redirect_header("admin_pligin.php?op=edit",1,_AD_FUN_ADDOK);    
		break;


  case "balise":
      $lstPrefixe = "txtCSS";
      $tCSS =  getArrayOnPrefixArray ($gepeto, $lstPrefixe);  
      $feuilleDeStyle = $tCSS[$gepeto['txtFeuilleDeStyle']]['txtCSS'];
      //displayArray ($tCSS, "======= saveLettre =t CSS =========");
  
      if (isset($gepeto['setBalise'])){
          afecterBalise2theme($feuilleDeStyle);
      }else{
        restaureBalise2theme($feuilleDeStyle);
      } 
    //buildFileBalise2Insert();
    redirect_header("admin_balise.php?op=list",1,_AD_FUN_ADDOK);
		break;

		
	default:
	 $state = _FUN_STATE_WAIT;
    redirect_header("admin_balise.php?op=list",1,_AD_FUN_ADDOK);
    break;
}


   
admin_xoops_cp_footer();

 

 
//---------------------------------------------------------------------
    

?>
