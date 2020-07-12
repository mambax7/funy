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



//define ("_br", "<br>");

//-------------------------------------------------------------
$vars = array(array('name' =>'op',         'default' => 'list'),
              array('name' =>'idProverbe', 'default' => 0),
              array('name' =>'pinochio',   'default' => false));
              
require (_FUN_JJD_PATH."include/gp_globe.php");
//-------------------------------------------------------------

function listProverbe () {
global $xoopsModule, $xoopsDB, $adoProverbe;
 
    
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
	  //xoops_cp_header();
    
    OpenTable();
    //**********************************************************************************    
    //echo "<b>"._AD_HER_TEXTES."</b><br>";    


    $sqlquery = $adoProverbe->getRows('pays,categorie,texte');    
    //displayArray($sqlquery,"-------listProverbe---------");
    echo "<table ".getTblStyle().">";  
    
    $categorie = '';   
    $pays = '';           
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      $idProverbe = $sqlfetch['idProverbe'];    
      
      $bg = getRowStyle($row,'',0,3); 
      /*
      if ($categorie <> $sqlfetch['categorie']){
        $categorie = $sqlfetch['categorie'];
        //echo "<hr>{$oldTypeLettre}-{$typeLettre}-{$caption}<hr>";
        echo buildDescription($categorie, $colSpan = 5, ($categorie <> ''));
              
      }
      
      */
      if ($pays <> $sqlfetch['pays']){
        $pays = $sqlfetch['pays'];
        //echo "<hr>{$oldTypeLettre}-{$typeLettre}-{$caption}<hr>";
        echo buildDescription("<b>{$pays}</b>", $colSpan = 5, ($categorie <> ''));
              
      }
      
      echo '<tr>';
      echo "<td {$bg} align='right'>({$idProverbe})</td>";
      //echo "<td>{$sqlfetch['description']}</td>";            
      
      $strMax = 120;
      if (strlen($sqlfetch['texte']) > $strMax){
        $h = strpos ($sqlfetch['texte'] , ";", $strMax)+1; 
        if ($h<50 & $h>60) $h = $strMax;
        $txt = substr($sqlfetch['texte'],0,$h);
      }else{
        $txt = $sqlfetch['texte'];      
      }
      

      echo "<td {$bg}>-{$txt} ...</td>";
      //echo "<td>{$sqlfetch['description']}</td>";            

        
        //-----------------------------------------------------------------------   	   
        $link = "admin_proverbe.php?op=edit&idProverbe=".$idProverbe;
        echo build_icoOption($link, _JJDICO_EDIT, _AD_FUN_EDIT, '', '', $bg);
        //-----------------------------------------------------------------------
        //Dupliquer la lettre
    	  $link = "admin_proverbe.php?op=duplicate&idProverbe=".$idProverbe;
        echo build_icoOption($link, _JJDICO_DUPLICATE, _AD_FUN_DUPLICATE, '', '', $bg);        
        //-----------------------------------------------------------------------
        //suppression du texte        
    	  $link = "admin_proverbe.php?op=remove&idProverbe={$idProverbe}&name={$sqlquery['nom']}";        
        echo build_icoOption($link, _JJDICO_REMOVE, _AD_FUN_DELETE, '', '', $bg);
        //-----------------------------------------------------------------------
        //previsualisation du texte
    	  //$link = "admin_proverbe.php?op=previewProverbe&id={$idProverbe}&name={$sqlquery['nom']}";        
        //echo build_icoOption($link, _JJDICO_VIEW, _AD_FUN_VIEWTEXT, '', '', $bg); 
       //-----------------------------------------------------------------------  
      
      
      
      
      
      echo '</tr>';       
    }
    
    echo "</table>";      


    //**********************************************************************************
echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
  <tr valign='top'>
    <td align='left' ><input type='button' name='cancel' value='"._CLOSE."' onclick='".buildUrlJava("index.php",false)."'></td>
    <td align='left' width='200'></td>

    <td align='right'>
    <input type='button' name='new' value='"._AD_FUN_NEW."' onclick='".buildUrlJava("admin_proverbe.php?op=new",false)."'>    
  </tr>
  </form>";

    
	CloseTable();
	//xoops_cp_footer();

}



//-----------------------------------------------------------------
/*****************************************************************
 *
 *****************************************************************/
function editProverbe($p){
	
    Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	   $myts =& MyTextSanitizer::getInstance();

    //------------------------------------------------  
    $ligneDeSeparation = buildHR(1, _JJD_HR_COLOR1, 2);
    //$listYesNo = aList_noYes();    
        
 
    
          
  //echo versionJS();
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
    OpenTable();  

        
    //********************************************************************
	  //echo "<div align='center'><B>"._AD_HER_ADMIN." ".$xoopsConfig['sitename']."</B><br>";
  	//echo "<B>"._AD_HER_TEXTE_MANAGEMENT."</B></div>";
    
 		echo "<FORM ACTION='admin_proverbe.php?op=save' METHOD=POST>";
    
    //********************************************************************
    //CloseTable();
    //OpenTable();   
    echo "<table width='80%'>";     
    //********************************************************************  
    //echo buildTitleOption (_AD_HER_OPTIONS_GENERALES,_AD_HER_OPTIONS_GENERALES_DESC);    
    //********************************************************************

    //---id
    echo "<TR>";
    echo "<TD align='left' >".""."</TD>";
    echo "<TD align='right' >".$p['idProverbe']." <INPUT TYPE=\"hidden\" id='idProverbe'  NAME='idProverbe'  size='1%'"." VALUE='".$p['idProverbe']."'></TD>";
    echo "</TR>";    


    //---Pays
    echo buildInput(_AD_FUN_PAYS, '', 'txtPays', $myts->displayTarea($p['pays'], "1", "1", "1"), '60%');    
    
    //---categorie
    echo buildInput(_AD_FUN_CATEGORY, '', 'txtCategorie', $myts->displayTarea($p['categorie'], "1", "1", "1"), '60%');    

    //---auteur
    echo buildInput(_AD_FUN_AUTHOR, '', 'txtAuteur', $myts->displayTarea($p['auteur'], "1", "1", "1"), '60%');    


    //---liste des codes de remplacement
    //jai change de présentation, mais jegarde pour revoir ca pus tard
    /*
    $oc = "insertTextIntoWysiwyg(\"lstCode\", \"txtProverbe\",{$xoopsModuleConfig['editor']});";    
    $listCode = buildHtmlList ("lstCode", getCodeList(), 0,  0, $nbRows = 12, '', $oc);
    
    echo "<TD align='center' ><B>"._AD_HER_TEXTE."</B><br>"._AD_HER_TAGINFO."<br>{$listCode}</TD>"._br;    
    */
    
    
   
    //---texte    
   	//$desc1 = getXME($myts->makeTareaData4Show($p['texte']), 'txtTexte', '','100%');
   	$desc1 = getXME($myts->htmlSpecialChars($myts->stripSlashesGPC($p['texte'])), 'txtTexte', '','100%');


    echo "<TR>"._br;
    echo "<TD align='center' ><B>"._AD_FUN_TEXTE."</B</TD>"._br;    
    echo "<TD align='left'  >";
    echo $desc1->render();
    echo "</TD>"._br;
    echo "</TR>"._br;
    
  //insertCodeDeRemplacement('txtProverbe','lstCode');   
  echo $ligneDeSeparation; 
 
    
       
/*

    //---incrustation
    echo buildSpin(_AD_HER_INCRUSTATION, '', 'txtIncrustation', $p['incrustation'], 8, -8, 0, 10);
*/
    //********************************************************************  
    echo "</table>";      
    CloseTable();
    OpenTable();    
    echo "<table width='80%'>";    
    //********************************************************************



    echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
      <tr valign='top'>
        <td align='left' ><input type='button' name='cancel' value='"._CANCEL."' onclick='".buildUrlJava("admin_proverbe.php",false)."'></td>
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


/****************************************************************************
 *
 ****************************************************************************/
function previewProverbe ($idProverbe){
global $xoopsUser;
  $params =array('idLettre'  => 1954,
                 'idArchive' => 2501,
                 'caption' =>  'Titre de la lettre pour exemple');
                 
$paramsPerso = array(_FUN_CODE_USER.'idUser'   => $xoopsUser->uid(),
                     _FUN_CODE_USER.'pseudo'   => $xoopsUser->uname(),      
                     _FUN_CODE_USER.'name'     => $xoopsUser->name(),
                     _FUN_CODE_USER.'email'    => $xoopsUser->email(),    
                     _FUN_CODE_USER.'mail'     => $xoopsUser->email(),
                     _FUN_CODE_USER.'login'    => $xoopsUser->uname(),                      
                     'idLettre' => $cession['idLettre'],
                     'idArchive'=> $cession['idArchive']);      


    $texte = buildLetter_Proverbe ($idProverbe, $params);
    $texte = replaceCodeInLetter($texte, $params);
    $texte = replaceCodePersonalise ($texte, $paramsPerso);    
    //**********************************************************************
    echo $texte;
    //**********************************************************************
    $link = "<a href='javascript:window.close();'>Close</a>";
    
		echo "<FORM ACTION='admin_proverbe.php?op=list' METHOD=POST>";
    echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
        <tr valign='top'>
        <td align='center' ><input type='submit' name='cancel' value='"._CLOSE."' ></td>
        <td align='left' width='200'></td>
        </tr>";
        //<td align='center' ><input type='button' name='cancel' value='"._CLOSE."' onclick='javascript:window.close();'></td>

   echo "</form>";
/*    
    //**********************************************************************    
	CloseTable();
	xoops_cp_footer();
*/ 
  
  
  
  
}



 

/************************************************************************
 *
 ************************************************************************/
//include_once (_HER_JJD_PATH.'include/adminOnglet/adminOnglet.php'); 
include_once (_FUN_ROOT_PATH.'class/cls_funy_proverbe.php');
$adoProverbe = new cls_funy_proverbe();
   
  admin_xoops_cp_header(_FUN_ONGLET_PROVERBE, $xoopsModule); 

  switch($op) {
  case "list":
		listProverbe ();
		break;
		

  case "new":
		$adoProverbe->saveRequest($_POST);
    $p = $adoProverbe->getArray(0);
    editProverbe ($p);
		break;

  case "edit":
		$p = $adoProverbe->getArray($idProverbe);
    editProverbe ($p);
    //redirect_header("admin_proverbe.php?op=edit",1,_AD_HER_ADDOK);    
		break;

  case "save":
		$adoProverbe->saveRequest($_POST);		
    redirect_header("admin_proverbe.php?op=list",1,_AD_FUN_ADDOK);		
		break;



  case "remove":
    //xoops_cp_header();
    $msg = sprintf(_AD_FUN_CONFIRM_DEL, "<b>{$_GET['name']} (id:{$idProverbe})</b>" , _AD_FUN_LETTERS);            
    xoops_confirm(array('op'         => 'removeOk', 
                        'idProverbe'    => $_GET['idProverbe'] ,
                        'ok'         => 1),
                        "admin_proverbe.php", $msg );
//    xoops_cp_footer();
    
    break;

  case "removeOk":
    $adoProverbe->deleteId($_POST['idProverbe']);    
    redirect_header("admin_proverbe.php?op=list",1,_AD_FUN_DELETEOK);    
		break;

  case "duplicate":
		$p = $adoProverbe->newClone ($idProverbe, true, 'nom');    
    editProverbe ($p);    
  	break;


  case "previewProverbe":
    previewProverbe ($id);
		break;

		
	default:
	 $state = _FUN_STATE_WAIT;
    redirect_header("admin_proverbe.php?op=list",1,_AD_FUN_ADDOK);
    break;
}


   
admin_xoops_cp_footer();

 

 
//---------------------------------------------------------------------
    



?>
