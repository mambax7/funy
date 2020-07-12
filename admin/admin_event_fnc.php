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

/*

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
*/                                     


function listEvent () {
global $xoopsModule, $xoopsDB;
 
    
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN; 
  $nbCols = 13; 
  
    $line = buildHR(1, '696969',$nbCols); 
	  //xoops_cp_header();
    
    OpenTable();
    //**********************************************************************************    
    //echo "<b>"._AD_FUN_TEXTES."</b><br>";    

    $sqlquery = db_getEvents ();
    //displayArray($sqlquery,"--------db_getEvents-----------");    
    
    $h = 0;
    echo "<FORM ACTION='admin_event.php?op=saveList' METHOD=POST>\n";
    echo "<table>";  
    
    $plugin = '';          
    while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {
      if ($plugin <> $sqlfetch['plugin']){
        $hrb = ($plugin <> '');
        $plugin = $sqlfetch['plugin'];
        echo buildTitleOption2('plugin: ',$plugin.' - '.$sqlfetch['description'], $nbCols, '0000FF', $hrb);
      }
      
      
       echo "<INPUT TYPE=\"hidden\" id='idEvent_{$h}'  "
           ." NAME='idEvent_{$h}'  size='1%'  " 
           ." VALUE='{$sqlfetch['idEvent']}'>";
       
       echo "<INPUT TYPE=\"hidden\" id='txtOldActif_{$h}'  "
           ." NAME='txtOldActif_{$h}'  size='1%'  " 
           ." VALUE='{$sqlfetch['actif']}'>";
    
      echo '<tr>';
      
      echo "<td>({$sqlfetch['idEvent']})</td>";      
      //echo "<td>{$sqlfetch['plugin']}</td>";      
      echo "<td><b>{$sqlfetch['nom']}</b></td>";
      //echo "<td>{$sqlfetch['description']}</td>";            
        $idEvent = $sqlfetch['idEvent'];

      echo "<td>{$sqlfetch['dateDebut']}</td>";
      echo "<td> => "._AD_FUN_TO2." => </td>";      
      echo "<td>{$sqlfetch['dateFin']}</td>";
      
     $lib = (($sqlfetch['multi'] ==1)? '<b>multi</b>' : 'single' ); 
     echo "<TD align='right'  >{$lib}</td>\n";      
      
      if ((($sqlfetch['idEvent'] == 1) | ($sqlfetch['nom'] == 'global') | ($sqlfetch['nom'] == 'global_js')) & true){
         echo "<TD align='center'  >"
             ."<INPUT TYPE=\"hidden\" id='txtActif_{$h}'  "
             ." NAME='txtActif_{$h}'  size='1%'  " 
             ." VALUE='1'>"
             .(($sqlfetch['actif']==1) ? '<b>X</b>' : '')
             ."</td>";
      
      }else{
        $c = ($sqlfetch['actif']==1)?"checked":"";
        echo "<TD align='center'  ><input type='checkbox' "
             ."ID='txtActif_{$h}' NAME='txtActif_{$h}' size='5%' "
             ."value='1' ".$c."></td>\n";
      
      }
      
        echo "<TD align='right'  >{$sqlfetch['ordre']}</td>\n";
       
        //-----------------------------------------------------------------------   	   
        $link = "admin_event.php?op=edit&idEvent=".$idEvent;
        echo build_icoOption($link, _JJDICO_EDIT, _AD_FUN_EDIT);
        //-----------------------------------------------------------------------   	   
        $link = "admin_event.php?op=init&idEvent=".$idEvent;
        echo build_icoOption($link, _JJDICO_URL."prepar.gif", _AD_FUN_INIT_EVENT);
        
        //-----------------------------------------------------------------------   	   
        $link = "admin_event.php?op=genereParamsEvent&idEvent=".$idEvent;
        echo build_icoOption($link, _JJDICO_URL."refresh.gif", _AD_FUN_GENERER_PARAMS);
        
        //-----------------------------------------------------------------------   	   
        $link = "admin_event.php?op=showParamsEvent&plugin={$plugin}&idEvent={$idEvent}&name={$sqlfetch['nom']}";
        echo build_icoOption($link, _JJDICO_URL."script.gif", _AD_FUN_SCRIPTS);
        
        //-----------------------------------------------------------------------
        //suppression          
    	  
       if ((($sqlfetch['idEvent'] == 1) | ($sqlfetch['nom'] == 'global') | ($sqlfetch['nom'] == 'global_js')) & true){
         echo "<TD align='center'></td>";
       }else{
          $link = "admin_event.php?op=remove&idEvent={$idEvent}&name={$sqlquery['nom']}";        
          echo build_icoOption($link, _JJDICO_REMOVE, _AD_FUN_DELETE);
       
       }
        //-----------------------------------------------------------------------
        /*

        //previsualisation du texte
    	  $link = "admin_texte.php?op=previewTexte&id={$idEvent}&name={$sqlquery['nom']}";        
        echo build_icoOption($link, _JJDICO_VIEW, _AD_FUN_VIEWTEXT); 
       //-----------------------------------------------------------------------  
        */      
      
      
      
      
      echo '</tr>';      
      $h++; 
    }
    
    echo "</table>";      


    //**********************************************************************************
echo "<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=3>
  <tr valign='top'>
    <td align='left' ><input type='button' name='cancel' value='"._CLOSE."' onclick='".buildUrlJava("index.php",false)."'></td>
    <td align='left' width='200'></td>

    <td align='right'>
    <input type='submit' name='saveList' value='"._AD_FUN_SAVE."' onclick='".buildUrlJava("admin_event.php?op=saveList",false)."'>    
  
  </tr>
  </form>";

//    <input type='button' name='new'  value='"._AD_FUN_NEW."' onclick='".buildUrlJava("admin_event.php?op=new",false)."'>    
	CloseTable();
	//xoops_cp_footer();
	
	//----------------------------------------------------------
	//-affichage des evennement du jour
	//----------------------------------------------------------	
  OpenTable();	
  
  $sqlquery = 	db_getCurrentEvents();
  //displayArray($tEvent,"db_getCurrentEvents");
  //while (list($key,$item) = each ($tEvent)){
  echo buildTitleOption4a(_AD_FUN_CURRENTS_EVENTS,_AD_FUN_CURRENTS_EVENTS_DSC,5,'000000',false,true);
  while ($sqlfetch = $xoopsDB->fetchArray($sqlquery)) {  
    $event = db_getEvent($sqlfetch['idEvent']);
    //$p = db_detEvent($sqlfetch['idEvent']) ;
    echo "<tr>";
    echo "<td>({$event['idEvent']})</td>";
    echo "<td>{$event['plugin']}</td>";  
    echo "<td>{$event['nom']}</td>";    
    echo "<td>{$event['dateDebut']}</td>";    
    echo "<td>{$event['dateFin']}</td>";  
    echo "<td>{$event['ordre']}</td>";        
    echo "</tr>";    
  }
  CloseTable();
	
	
	
}

/*****************************************************************
 *
 *****************************************************************/
function showParamsEvent($p){
Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;

    $idEvent = $p['idEvent'];
  	$f = getFileNameDeclaration($p['plugin'], $p['idEvent'], 0);  	
    $content = loadTextFile($f);    
    
    $sql = "SELECT * FROM "._FUN_TFN_SMARTY." WHERE idEvent={$idEvent}";
    $sqlquery = $xoopsDB->query ($sql);
      
          
  //echo versionJS();
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
    OpenTable();  







 		echo "<FORM ACTION='admin_event.php?op=list' METHOD=POST>\n";
    
    //********************************************************************
    //CloseTable();
    //OpenTable();   
    echo "<table width='80%'>";     
    //********************************************************************  
    //echo buildTitleOption (_AD_FUN_OPTIONS_GENERALES,_AD_FUN_OPTIONS_GENERALES_DESC);    
    //********************************************************************

    //---id
    echo "<TR><TD colspan='3'>({$idEvent}) - {$p['plugin']} ->>> <strong>{$p['name']}</strong></TD></TR>";
    //echo "<TR><TD colspan='3'>{$f}</TD></TR>";
    //--------------------------------------------------    
    echo "<TR><TD></TD><TD>";  
    echo "<table>";      
    //--------------------------------------------------

    echo " <TR><td  style='border-style: solid; border-width: 1px; padding: 1' bgcolor='#FFFF99'>"._AD_FUN_SCRIPT_PARAMS."<br>{$f}</td></TR>";
    echo " <TR><td  style='border-style: solid; border-width: 1px; padding: 1' bgcolor='#FFFFFF'><pre>{$content}</pre></td></TR>";    



    
    while ($t = $xoopsDB->fetchArray($sqlquery)) {
      //displayArray($t,"------------------------");
      
    	$folder = dirname(_FUN_DIR_PLUGIN.$p['plugin']).'/';      
    	$f = $folder.$t['fichier'];   
      $content =  loadTextFile($f);       	
      $content = str_replace ('<', "&lt;", $content);
      $content = str_replace ('>', "&gt;", $content);  
      
      echo " <TR><td  style='border-style: solid; border-width: 1px; padding: 1' bgcolor='#FFFF99'>{$f}<br>"._AD_FUN_BALISE_SMARTY." : <strong>{$t['balise']}</strong></td></TR>";
      echo " <TR><td  style='border-style: solid; border-width: 1px; padding: 1' bgcolor='#FFFFFF'><code><pre>{$content}</pre></code></td></TR>";


    }
    
    //--------------------------------------------------  
    echo "</table>";    
    echo "</TD><TD></TD></TR>";    
    //--------------------------------------------------      
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
       
}

//-----------------------------------------------------------------
/*****************************************************************
 *
 *****************************************************************/
function editEvent($p){
Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
  
  //displayArray($p, "--- editEvent ---");
  //displayArray($p['smarty'], "--- editEvent ---");
	
    $myts =& MyTextSanitizer::getInstance();

    //------------------------------------------------  
    $ligneDeSeparation = buildHR(1,'696969',3);  
    $listYesNo = array(_AD_FUN_NO,_AD_FUN_YES);    
    $listPeriodicite = array(_AD_FUN_PERIODE_ANNUELLE,
                             _AD_FUN_PERIODE_SEMESTRIELLE,
                             _AD_FUN_PERIODE_TRIMESTRIELLE,
                             _AD_FUN_PERIODE_BIMENSUELLE,
                             _AD_FUN_PERIODE_MENSUELLE,
                             _AD_FUN_PERIODE_HEBDOMADAIRE,
                             _AD_FUN_PERIODE_JOURNALIERE);
        
 
    //------------------------------------------------    
    $idEvent = $p['idEvent'];
    
          
  //echo versionJS();
  echo _JJD_JSI_TOOLS;
  echo _JJD_JSI_SPIN;  
  
    OpenTable();  


    //********************************************************************
	  //echo "<div align='center'><B>"._AD_FUN_ADMIN." ".$xoopsConfig['sitename']."</B><br>";
  	//echo "<B>"._AD_FUN_TEXTE_MANAGEMENT."</B></div>";
    
 		echo "<FORM ACTION='admin_event.php?op=save' METHOD=POST>"._funbr;
    
    //********************************************************************
    //CloseTable();
    //OpenTable();   
    echo "<table width='80%'>";     
    //********************************************************************  
    //echo buildTitleOption (_AD_FUN_OPTIONS_GENERALES,_AD_FUN_OPTIONS_GENERALES_DESC);    
    //********************************************************************

    //---id
    echo "<TR>";
    //echo "<TD align='left' >"."({$p['idEvent']})"."</TD>"._funbr;
    echo "<TD align='right' >"
         ."<INPUT TYPE=\"hidden\" id='idEvent'  NAME='idEvent'  size='1%'"." VALUE='".$p['idEvent']."'>\n"
         ."<INPUT TYPE=\"hidden\" id='txtIsObject' NAME='txtIsObject'  size='1%' VALUE='{$p['isObject']}'>\n"
         ."<INPUT TYPE=\"hidden\" id='txtObjectName' NAME='txtObjectName'  size='1%' VALUE='{$p['objectName']}'>\n"         
         ."</TD></TR>";    

    //---Name
    $description = $myts->displayTarea($p['description'], "1", "1", "1");
    echo "<td>"._AD_FUN_PLUGIN." ({$p['idEvent']})</td><td><b>{$p['plugin']}</b>"
        ."<INPUT TYPE=\"hidden\" id='txtPlugin'  NAME='txtPlugin'  size='1%'"." VALUE='{$p['plugin']}'>"
        ."<INPUT TYPE=\"hidden\" id='txtDescription'  NAME='txtDescription'  size='1%'"." VALUE='{$description}'>"        
        ."<INPUT TYPE=\"hidden\" id='txtMulti'  NAME='txtMulti'  size='1%'"." VALUE='{$p['multi']}'>"        
        ."</td>"; 

         

    echo "<tr><td colspan='10'>{$p['description']}</td></tr>";    
    buildInput(_AD_FUN_NOM, '', 'txtNom', $myts->displayTarea($p['nom'], "1", "1", "1"), '60%');    


    //---Name
    echo buildInput(_AD_FUN_NOM, '', 'txtNom', $myts->displayTarea($p['nom'], "1", "1", "1"), '60%');    




    echo $ligneDeSeparation;
        //echo "<tr><td>sss</td></tr>";

    

    echo "<tr>";
    echo "<td><b>"._AD_FUN_DATE_DEBUT."</b></td>";      
    echo "<td style='align:left;'>";
    $ele1 = new  XoopsFormTextDateSelect('', 'txtDateDebut', 15, strtotime($p['dateDebut']  ));    
    echo $ele1->render()."</td>";
    echo "<td></td></tr>";

    
    $ele2 = new  XoopsFormTextDateSelect('', 'txtDateFin', 15, strtotime($p['dateFin']  ));
    echo "<tr>";
    echo "<td><b>"._AD_FUN_DATE_FIN."</b></td>";      
    echo "<td style='align:left;'>".$ele2->render()."</td>";
    echo "<td></td></tr>";


    //---Periodicite
    echo buildList(_AD_FUN_PERIODICITE, _AD_FUN_PERIODE_EVENT_DSC, 'txtPeriodicite', $listPeriodicite, $p['periodicite']);
    
    
    echo buildSpin(_AD_FUN_ORDRE, '', 
                   'txtOrdre', $p['ordre'], 100, 1, 1, 10, '');
    //---ordre
    echo $ligneDeSeparation;
//////////////////////////////////////////////////////////////////////


      echo "</table>";
      echo "<table>";     
      echo "<tr>";      
      echo '<td>#</td>';       
      echo '<td>'._AD_FUN_FILE.'</td>';
      echo '<td>'._AD_FUN_BALISE.'</td>';
      echo '<td>'._AD_FUN_MODE.'</td>';      
      //echo '<td>'._AD_FUN_SELECTION.'</td>';    
      echo "</tr>\n";      

    
          
    $h = 0;    
    while (list ($key, $item) = each ($p['smarty'])) {
      echo "<tr>";
      echo buildHidden ("smarty[$h][idSmarty]",  $item['idSmarty'], '', true, false);      
      echo buildHidden ("smarty[$h][file]",      $item['file'], '', true, false);
      
      if ($item['selection'] == 1){
        $listName = "smarty[$h][balise]";
        //$listCode = buildHtmlList ($listName, getBalisesInBlocks(), $item['balise']);    
        $listCode = buildHtmlListString($listName, getBalisesInBlocks(), $item['balise']);   
        echo "<td>{$listCode}</td>";    
      }else{
        echo buildHidden ("smarty[$h][balise]",    $item['balise'], '', true, false);      
      }
      
      $lib = (($item['mode'] == 1) ? _AD_FUN_CODE_LIE : _AD_FUN_CODE_INSERE);
      echo buildHidden ("smarty[$h][mode]",      $item['mode'], $lib, true, false);      
      //echo "<td>{$lib}</td>";
      //echo buildHidden ("[smarty][$h][mode]",      $item['mode'], true, false);      
      echo buildHidden ("smarty[$h][selection]", $item['selection'], false, false);    
      

      
      echo "</tr>\n";
      $h++;    
    }
      echo "</table>";
      echo "<table>";

    echo $ligneDeSeparation;
//////////////////////////////////////////////////////////////////////
    //displayArray($p,"----- p['param'] -----");
    $params = $p['funy_param'];
    //displayArray($params,"----- p['param'] -----");    
    //displayArray($p, "-------event---------");
    if (count($params) > 0){

          //------------------------------------------------------------------
          $h=0;
          while (list ($key, $sqlfetch) = each ($params)) {
          //$key=$sqlfetch['name'];
             if ($sqlfetch['type'] == 999) continue;
             if (!isset($sqlfetch['globalModule'])) $sqlfetch['globalModule'] = 0;
             if ($sqlfetch['globalModule'] == 1) continue;
                          
             $txtName = "txtParamNom_{$h}";          
             $txtHidenName = "txtHParamNom_{$h}";   
             $txtType = "txtType_{$h}";             
             
             echo "<INPUT TYPE=\"hidden\" id='txtKey_{$h}'  "
                 ." NAME='txtKey_{$h}'  size='1%'  " 
                 ." VALUE='{$key}'>";
                    
             echo "<INPUT TYPE=\"hidden\" id='{$txtHidenName}'  "
                 ." NAME='{$txtHidenName}'  size='1%'  " 
                 ." VALUE='{$sqlfetch['name']}'>";
                 
             echo "<INPUT TYPE=\"hidden\" id='{$txtType}'  "
                 ." NAME='{$txtType}'  size='1%'  " 
                 ." VALUE='{$sqlfetch['type']}'>";
                 
                 
                 
                 
           //displayArray($sqlfetch,"----- $key -----");
           //while ($sqlfetch = $xoopsDB->fetchArray($params)) {
              if (!isset($sqlfetch['type'])) $sqlfetch['type'] = 0;
              if (!isset($sqlfetch['description'])) $sqlfetch['description'] = '';              
              
              //----------------------------------------------------
              //IMPORTANT - ne pas oblier de modifier egalement "saveParams2Text"
              //----------------------------------------------------
              $typeParam = getTypeFunParam($sqlfetch['type']);

             
              switch ($typeParam){
              case _FUN_TP_NEW_BALISE;
                //pas pris en compte ce sont de nouvelle balise
                break;
                
              case _FUN_TP_SPIN: //c'est un spin
                    if (!isset($sqlfetch['unite'])) $sqlfetch['unite'] = '';
                    echo buildSpin($key, $sqlfetch['description'], 
                                   $txtName, $sqlfetch['value'], 
                                    $sqlfetch['max'], 
                                    $sqlfetch['min'],
                                    1, 10, '', $sqlfetch['unite']);
                    break;
                    
              case _FUN_TP_LIST: //c'est une liste de libele dont le numéro d'ordre est atomatique 
                      //displayArray($p['funy_dico'],"-----funy_dico----------");
                      $list = $sqlfetch['list']; 
                      if (isset($p['funy_dico'][$list])) {
                      $list = $p['funy_dico'][$list] ;                  
                      }                     
                      $list = explode(';', $list);                      
                      
                      //$list = explode(';', $sqlfetch['list']);
                      echo buildList($key, 
                                     $sqlfetch['description'], 
                                     $txtName, 
                                     $list, 
                                     $sqlfetch['value']);
                    break;   
                                   
              case _FUN_TP_LIBELLES: //c'est une liste de libele c'est le libelle qui est stockée              
                    //displayArray($p['funy_list'],"-----funy_list----------");                    
                    if (isset($p['funy_list'][$sqlfetch['list']])) {
                      $list = $p['funy_list'][$sqlfetch['list']];
                    }else{
                      $list = $sqlfetch['list'];                  
                    }

                    $tList = explode ('|', $list);
                    $list = buildHtmlListString($txtName, $tList, $sqlfetch['value']);
 
                    echo "<TR>"._br;
                    echo "<TD align='left' ><B>".$key."</B></TD>"._br;    
                    echo "<TD align='left' >{$list}</TD>"._br;
                    echo buildDescription($sqlfetch['description']);    
                    echo "</TR>\n";
                    break;              
              
              case _FUN_TP_FILES: //c'est une liste de fichiers  
                  //---Icone    
                //$list = getGifFiles (_FUN_DIR_RESSOURCES, $sqlfetch['value'], "txtParamNom_{$h}");
                
             //$folder   = _FUN_DIR_RESSOURCES;
             
             if (isset ($sqlfetch['folder'])){
              $folder   = _JJD_PROOT . $sqlfetch['folder'];             
             }else{
              $folder   = _JJD_PROOT . $params['folder_img']['value'];             
             }
             //echo "<hr>{$folder}<hr>";             

             if (!isset($sqlfetch['extensions'])) $sqlfetch['extensions'] = "gif;jpg;png;bmp";
            
            $list = buildListFromFolder($key, 
                             $sqlfetch['description'], 
                             $sqlfetch['value'],  
                             $txtName,
                             $folder, 
                             $sqlfetch['extensions'], 
                             0,
                             false,
                             1,
                             '');
    
                //$p['icone'] = 'livre1.gif';
                //$img = "<img src='"._LEX_URL_LEXICONES."{$p['icone']}' name='imgIcone' border=0 Alt='' width='20' height='20' ALIGN='absmiddle'>";
                //$img = '';   
                /*
                */                
 
                echo "<TR>"._br;
                //echo "<TD align='left' ><B>".$key."</B></TD>"._br;    
                //echo "<TD align='left' >{$list}   {$img}</TD>"._br;
                echo "<TD align='left' >{$list}</TD>"._br;
                echo buildDescription($sqlfetch['description']);    
                echo "</TR>"._br;
          
                    break;   
                                                  
              case _FUN_TP_FOLDER_FUNY: //liste de dossier dans funy  
                $f = _FUN_DIR_PLUGIN.$sqlfetch['folder'];
                //echo "<hr>_FUN_TP_FOLDER_FUNY<br>{$f}<hr>";      
                $list = getFolder($f, '', false);
                //displayArray($list,"---------_FUN_TP_FOLDER_FUNY--------------");
                

                echo buildList($key, 
                               $sqlfetch['description'], 
                               $txtName, 
                               $list, 
                               $sqlfetch['value']);

    

                
                break;              

              case _FUN_TP_COLOR: //c'est une couleur
                    echo buildColorSelecteur($key, $sqlfetch['description'], $txtName, $sqlfetch['value']);
              
                    break;
                    
                    
              //----------------------------------------------------------
              case _FUN_TP_HTML_TEXT: //c'est un texte HTML              
              case _FUN_TP_HTML_FILE: //c'est un texte html dans un fichier 
              case _FUN_TP_ASCII_TEXT: //c'est un texte ascii texte   
              case _FUN_TP_ASCII_FILE: //c'est un texte ascii dans un fichier 
              case _FUN_TP_ARRAY:                        
                //-------------------------------------------------
                if ($typeParam == _FUN_TP_HTML_FILE 
                  | $typeParam == _FUN_TP_ASCII_FILE 
                  | $typeParam == _FUN_TP_ARRAY ){                  
                  
                  //if ($idEvent == 0 | $sqlfetch['value'] = ''){
                  //echo "<hr>11-{$key}<br>{$sqlfetch['value']}<hr>";
                  if ($idEvent == 0 | isset($p['init'])){   
                   $f = getFileLang(_FUN_DIR_PLUGIN.$p['plugin'] , $sqlfetch['file']);
                   
                   //echo "<hr>{$f}<hr>";                   
                   $sqlfetch['value'] = loadTextFile($f);  
                   /*

                   $sqlfetch['value'] = str_replace("\n",'',$sqlfetch['value']);                   
                   $sqlfetch['value'] = str_replace(chr(13),'',$sqlfetch['value']);                   
                   $sqlfetch['value'] = str_replace(chr(10),'',$sqlfetch['value']);                               
                   */                  
                  }   
                
                }

                switch ($typeParam){              


                
                case _FUN_TP_HTML_FILE: //c'est un texte dans un fichier 
                case _FUN_TP_HTML_TEXT: //c'est un texte HTML    
                 	//$desc1 = getXME($myts->makeTareaData4Show($sqlfetch['value']), $txtName, '','100%');
                 	$desc1 = getXME($myts->htmlSpecialChars($myts->stripSlashesGPC($sqlfetch['value'])), $txtName, '','100%');                 	
                  break;
                
                             
                case _FUN_TP_ASCII_TEXT:  
                  //$desc1 = getEditorHTML(_EDITOR_TEXTAREA, $myts->makeTareaData4Show($sqlfetch['value']), $txtName, '', '100%');                     
                  $desc1 = getEditorHTML(_EDITOR_TEXTAREA, $myts->htmlSpecialChars($myts->stripSlashesGPC($sqlfetch['value'])), $txtName, '', '100%');
                  break; 
                
                case _FUN_TP_ARRAY:                        
                case _FUN_TP_ASCII_FILE:                       
                  $desc1 = getEditorHTML(_EDITOR_TEXTAREA, $sqlfetch['value'], $txtName, '', '100%');                
                }               
                
                //-pour tous ces cas affichage du render
                echo "<TR>"._br;
                echo "<TD align='center' ><B>".$key."</B</TD>"._br;    
                echo "<TD align='left'  >";
                echo $desc1->render();
                echo "</TD>"._br;
                echo "</TR>"._br;
                echo buildDescription($sqlfetch['description']);    
                
              //----------------------------------------------------------                

                break;  
                            
              //----------------------------------------------------------
              case _FUN_TP_FOLDER: //liste de fichier             
                $desc1 = getEditorHTML(_EDITOR_TEXTAREA, $sqlfetch['value'], $txtName, '', '100%');

                echo buildInput($key, 
                                $sqlfetch['description'],
                                "txtParamNom_{$h}" , 
                                $myts->displayTarea($sqlfetch['value'], "1", "1", "1"),
                                 '60', $sqlfetch['name']);

                break;              
              

              case _FUN_TP_HIDDEN_VAR: //c'est une variable masquée déclaée dans le fichier ini mais non modifiable
              case _FUN_TP_URL:
              case _FUN_TP_URL_FUNY: 
                  echo "<TR><TD><b>{$key}</b></td><td>"
                      ."<INPUT TYPE=\"hidden\" id='{$txtName}'  NAME='{$txtName}'  size='1%' VALUE='{$sqlfetch['value']}'>"
                      .$sqlfetch['value']."</td></tr>";    
                  echo buildDescription($sqlfetch['description']);                    
                  break;   
                  
              case _FUN_TP_TABLE_LIST: //liste de valeur dans une table
                $defaut = $sqlfetch['value'];
                $cat = buildHtmlListFromTable ($txtName, 
                                           $sqlfetch['table'], 
                                           $sqlfetch['field'], 
                                           $sqlfetch['field'], 
                                           $sqlfetch['field'], 
                                           $defaut , 
                                           "",
                                           '',
                                           "150",
                                           '',
                                           true);
                  
                  echo "<TR><TD><b>{$key}</b></td><td>"
                      ."<INPUT TYPE=\"hidden\" id='{$txtName}'  NAME='{$txtName}'  size='1%' VALUE='{$sqlfetch['value']}'>"
                      .$cat."</td></tr>";    
                  echo buildDescription($sqlfetch['description']);                    
                  break;              
              
                  
              case _FUN_TP_DESCRIPTION:              
                  echo "<TR><TD><b>{$key}</b></td><td>"
                      ."<INPUT TYPE=\"hidden\" id='{$txtName}'  NAME='{$txtName}'  size='1%' VALUE='{$p['nom']}'>"
                      .$p['nom']."</td></tr>";    
                  echo buildDescription($sqlfetch['description']);                    
                  break;   
                             
              case _FUN_TP_TITLE: //c'est un titre                    
                   echo buildTitleOption3 ($sqlfetch['description']);
                   break;
                   
                   
              case _FUN_TP_LINE: //c'est une ligne de separation    
                 $sqlfetch['value'] = 999;                
                  echo "<TR><TD colspan='3' >"
                      ."<INPUT TYPE=\"hidden\" id='{$txtName}'  NAME='{$txtName}'  size='1%' VALUE='{$sqlfetch['value']}'>"
                      ."<hr>"
                      ."</td></tr>";    

                   break;
                   
              case _FUN_TP_CHECKLISTBIN:                   
              case _FUN_TP_CHECKLIST: 
                //displayArray($p['funy_dico'],"-----funy_dico----------");
                $list = $sqlfetch['list']; 
                if (isset($p['funy_dico'][$list])) $list = $p['funy_dico'][$list] ;                  
                              
                $tList = explode(';', $list);
                $tItem = array();
                $b = $sqlfetch['value'];   
                //echo "<hr>{$list}-{$b}<hr>";
                
                $lib = 'lib'; $val = 'val'; $id  = 'id';
                $h=0;
                
                for ($h=0; $h < count($tList); $h++){
                  $tItem[] = array ($lib => $tList[$h], 
                                    $val => isBitOk($h, $b), 
                                    $id  => $h);
                }
            

            
                echo "<tr><td><b>{$key}</b><td>"._br;
                echo buildCheckedListHA ($tItem, '' , $txtName, 0, 1, $lib, $val, $id);
                echo "</td></tr>\n";
                echo buildDescription($sqlfetch['description']);
        
        
                //$bAffichage = checkBoxToBin($t, 'txtAffichage', $def);


/*
        //--element a afficher 
    
        $lib = 'lib';
        $val = 'val';
        $id  = 'id';
        $h=0;
        $b = $p['affichage'];
    
        $t = array(array($lib => _AD_HER_NAME,              $val => isBitOk($h, $b), $id => $h++),    
                   array($lib => _AD_HER_LIBELLE,           $val => isBitOk($h, $b), $id => $h++),               
                   array($lib => _AD_HER_DESCRIPTION,       $val => isBitOk($h, $b), $id => $h++),  
                   array($lib => _AD_HER_AVERTISSEMENT,     $val => isBitOk($h, $b), $id => $h++));    
        echo "<tr><td><b>"._AD_HER_AFFICHAGE."</b><td>"._br;
        echo buildCheckedListH ($t, '' , "txtAffichage", 0, 1, $lib, $val, $id);
        echo "</td></tr>"._br;
        echo buildDescription(_AD_HER_AFFICHAGE_DSC);


  $bAffichage = checkBoxToBin($t, 'txtAffichage', $def);






*/
                
                break;
                
              case _FUN_TP_NOT_DEFINED: 
                echo buildInput($key, 
                                $sqlfetch['description'],
                                "txtParamNom_{$h}" , 
                                $sqlfetch['value'],
                                 '60', $sqlfetch['name']);
                
                break;
                              
              default:
                //---nom - valeur en direct du plugin          
                echo buildInput($key, 
                                $sqlfetch['description'],
                                "txtParamNom_{$h}" , 
                                $myts->displayTarea($sqlfetch['value'], "1", "1", "1"),
                                 '60', $sqlfetch['name']);

                break;
              }

            //---------------------------------------------------------------
            $h++;      
          }
    }          
    





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
        <td align='left' ><input type='button' name='cancel' value='"._CANCEL."' onclick='".buildUrlJava("admin_event.php",false)."'></td>
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


/***********************************************************************
 *
 ***********************************************************************/
/****************************************************************************
 *
 ****************************************************************************/
function getGifFiles($folder, $defaut = '', $name){

  //$folder = _LEX_ROOT_PATH.'images/lexIcones/';
  //$onChange = "changeImgFromList(\"imgIcone\", \"lstIcones\", \""._LEX_URL_LEXICONES."\");";
  //$onChange = "changeImgFromList(\"imgIcone\", \"lstIcones\", \""._LEX_URL_LEXICONES."\", \"\");"; 
  $onChange = '';
  return  htmlFilesList ($defaut, $folder, 'gif', $onChange, $name);

}




/*******************************************************************
 *
 *******************************************************************/
function saveEvent ($t) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	   $myts =& MyTextSanitizer::getInstance();
	   //$name = $myts->displayTarea();	

  //------------------------------------
  //displayArray($t,'---------saveEvent----------------');
  //displayArray($t['smarty'],'---------saveEvent----------------');  
  //exit;
  $idEvent = $t['idEvent'];
  //-----------------------------------------------------------
  $bAffichage = checkBoxToBin($t, 'txtAffichage', $def);
  //-----------------------------------------------------------
  
   $t['txtNom']         = string2sql($t['txtNom']);
   $t['txtDescription'] = string2sql($t['txtDescription']);   
   //$t['txtTexte'] = string2sql($t['txtTexte']);
   $t['txtActif'] = 1; //provisoire en attendant de statuer sur l'utilite de ce champ
    
  if ($idEvent == 0){
    
      $sql = "INSERT INTO "._FUN_TFN_EVENT."\n"
            ."(plugin, nom, description, dateDebut, dateFin, periodicite, actif, "
            . "isObject, objectName,ordre,multi)\n"
            ."VALUES ("
            ."'{$t['txtPlugin']}',"             
            ."'{$t['txtNom']}',"  
            ."'{$t['txtDescription']}',"            
            ."'{$t['txtDateDebut']}',"
            ."'{$t['txtDateFin']}'," 
            ."{$t['txtPeriodicite']},"   
            ."{$t['txtActif']}," 
            ."{$t['txtIsObject']},"
            ."'{$t['txtObjectName']}'," 
            ."{$t['txtOrdre']},"  
            ."{$t['txtMulti']}"                                                                   
            .")";

            
      $xoopsDB->query($sql);
      $idEvent = $xoopsDB->getInsertId() ;
      $t['idEvent'] = $idEvent;
      
  }else{
      $sql = "UPDATE "._FUN_TFN_EVENT." SET "
           ."nom               = '{$t['txtNom']}',"
//           ."description       = '{$t['txtDescription']}',"           
           ."dateDebut         = '{$t['txtDateDebut']}',"  
           ."dateFin           = '{$t['txtDateFin']}',"  
           ."periodicite       = {$t['txtPeriodicite']},"   
           ."actif             = {$t['txtActif']}," 
           ."isObject          = {$t['txtIsObject']},"
           ."objectName        = '{$t['txtObjectName']}',"
           ."ordre             = {$t['txtOrdre']}, "           
           ."multi             = {$t['txtMulti']} "                                 
           ." WHERE idEvent = ".$idEvent;
          
      $xoopsDB->query($sql);            
  }

  //echo "<hr>saveEvent<br>{$sql}<hr>";
  //-------------------------------------------
  $e = db_getEvent($idEvent);
  saveSmarty ($t['smarty'], $idEvent, $e);
  saveParams ($t);
  //exit;
  if ($t['txtIsObject'] == 1){
    saveParams2Object($idEvent, $t['txtObjectName']);  
  }else{
    saveParams2Text($idEvent);  
  }  

  //-------------------------------------------           
//echo "<hr>{$sql}<hr>";  exit;
}
/*******************************************************************
 *
 *******************************************************************/
function iniGlobalJS () {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;

  $sql = "INSERT INTO "._FUN_TFN_EVENT." ("
       . "`idEvent`, `plugin`, `nom`, `dateDebut`, `dateFin`, "
       . "`periodicite`, `actif`, `isObject`, `objectName`, `ordre`) VALUES "
       ." (1, 'global_module/config.ini', 'global', "
       . "'2008-01-01 00:00:00', '2008-12-31 00:00:00', 0, 1, 0, '0', 0);";
  $xoopsDB->queryF($sql);
  
}


/*******************************************************************
 *
 *******************************************************************/
function saveEventVierge () {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	   $myts =& MyTextSanitizer::getInstance();
	   //$name = $myts->displayTarea();	

    //iniGlobalJS();
		//saveTexte ($_POST);
	  $t['idEvent'] = 1;
  $idEvent = $t['idEvent'];	  
		$t = getEvent ($idEvent);   
    //displayArray($p,"-----------------"); 

  //------------------------------------
  //displayArray($t,'-----------saveEventVierge--------------');
  //displayArray($t['smarty'],'---------saveEvent----------------');  
  //exit;

  $sql = "DELETE FROM "._FUN_TFN_EVENT." WHERE idEvent = {$idEvent}";
  $xoopsDB->queryF($sql);  
    
    $sql = "INSERT INTO "._FUN_TFN_EVENT._sqlbr
          ."(idEvent, plugin, nom, dateDebut, dateFin, periodicite, actif, isObject, objectName,ordre)"._sqlbr
          ."VALUES ("
          ."{$idEvent},"
          ."'{$t['plugin']}',"             
          ."'{$t['nom']}',"  
          ."'{$t['dateDebut']}',"
          ."'{$t['dateFin']}'," 
          ."{$t['periodicite']},"   
          ."{$t['actif']}," 
          ."{$t['isObject']},"
          ."'{$t['objectName']}'," 
          ."{$t['ordre']}"                                                         
          .")";

          
      $xoopsDB->queryF($sql);
      $idEvent = $xoopsDB->getInsertId() ;
      $t['idEvent'] = $idEvent;
      
  
  //echo "<hr>saveEvent<br>{$sql}<hr>";
  //-------------------------------------------
  
  $e = db_getEvent($idEvent);
  saveSmarty ($t['smarty'], $idEvent, $e);  
  saveParams ($t);  

  /*  


  //exit;
  if ($t['isObject'] == 1){
    saveParams2Object($idEvent, $t['txtObjectName']);  
  }else{
    saveParams2Text($idEvent);  
  } 
  
   
  */
  //-------------------------------------------           
//echo "<hr>{$sql}<hr>";  exit;
}

/****************************************************************
 *
 ****************************************************************/
function saveEventActifChange ($p) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
  //displayArray($p,"----- saveEventActifChange -----");
  $lstPrefixe = "idEvent;txtActif;txtOldActif";  
  $t =  getArrayOnPrefixArray ($p, $lstPrefixe);  
  
  //displayArray($t,"----- saveEventActifChange -----");
  
  while (list($key, $item) = each($t)){      
  //for ($h = 0; $h < count($t); $h++){
    //$item = $t[$h] ; 
    if ($item['idEvent'] == 0) continue;
    if (!isset($item['txtActif'])) $item['txtActif']=0;
    
    if ($item['txtActif'] <> $item['txtOldActif'] ){
      $sql = "UPDATE "._FUN_TFN_EVENT
            ." SET actif = {$item['txtActif']} "  
            ." WHERE idEvent = {$item['idEvent']}";
      $xoopsDB->query($sql);    
      //echo "<hr>{$sql}<hr>";
    
    }
  } 
  
  
//exit;   
}  
/****************************************************************
 *
 ****************************************************************/
function saveSmarty ($p, $idEvent, $e) {
	Global $xoopsDB;  
  //displayArray($p, "---------saveSmarty--------------");
  
  $sql = "UPDATE "._FUN_TFN_SMARTY." SET flag=0 WHERE idEvent={$idEvent}";
  $xoopsDB->queryF($sql);	
  
  while (list($key,$tItem) = each ($p)){
    if ($tItem['idSmarty'] <> 0){
      $sql = "UPDATE "._FUN_TFN_SMARTY.' SET '
           . " idEvent = {$idEvent},"
           . " fichier = '{$tItem['file']}',"           
           . " balise = '{$tItem['balise']}',"
           . " mode = {$tItem['mode']},"           
           . " selection = {$tItem['selection']},"   
           . " flag = 1"                   
           . " WHERE idSmarty = {$tItem['idSmarty']}";
    }else{
      $sql = "INSERT INTO "._FUN_TFN_SMARTY
           .' (idEvent,fichier,balise,mode,selection,flag) VALUES ('
           . " {$idEvent},'{$tItem['file']}','{$tItem['balise']}',"
           . " {$tItem['mode']},{$tItem['selection']},1)";
    
    }
    //echo "<hr>saveSmarty<br>{$sql}<hr>";
    $xoopsDB->queryF($sql);    
    
  }
  
  $sql = "DELETE FROM "._FUN_TFN_SMARTY." WHERE flag=0 AND idEvent={$idEvent}";  
  $xoopsDB->queryF($sql);	


  if ($e['multi'] == 1){
    $f = getFileNameDeclaration($e['plugin'], $idEvent, 0, 'div');
    $tContent = array();
    $tContent[] = "<script type=\"text/javascript\">";    
    $tContent[] = "//-------------------------------";
    $tContent[] = "var funy_event = {$idEvent};";    
    //$tContent[] = "alert (\"funy_event-div = \" + funy_event);";    
    $tContent[] = "//-------------------------------";    
    $tContent[] = "</script>";   
     
    $content = implode ("\n", $tContent);
    fputContent ($f, $content, $msg );
    //echo "<hr>saveSmarty<br>{$f}<hr>";
  }


 }






/****************************************************************
 *
 ****************************************************************/
 function saveParams ($p) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
  $myts =& MyTextSanitizer::getInstance();
  
  //$r = array();
  //$r['isObject'] = 0;
  
  $lstPrefixe = "txtParamNom;txtHParamNom;txtType;txtKey";  
  $idEvent = $p['idEvent'];  

  $t =  getArrayOnPrefixArray ($p, $lstPrefixe);  
  
  //displayArray($p, "******{$idEvent}*************");
  //-----------------------------------------------------------------------
  //-----------------------------------------------------------------------
    $sql = "DELETE FROM "._FUN_TFN_PARAM  
          ." WHERE idEvent = {$idEvent} ";
    $xoopsDB->queryF($sql);    
    //----------------------------------------------------
  //-----------------------------------------------------------   
  /*

  $lstPrefixe = "txtFile";
  $tCSS =  getArrayOnPrefixArray ($t, $lstPrefixe);  
  $img = $tCSS[$t['txtFeuilleDeStyle']]['txtFile'];
  */  
  //displayArray ($tCSS, "======= saveLettre =t CSS =========");
   //$t['txtFeuilleDeStyle']  = string2sql();  
  //-----------------------------------------------------------        

        
  for ($h = 0; $h < count($t); $h++){
    $item = $t[$h] ; 

    /*

    switch ($item['txtType']){
      case 3:
        $v = _FUN_URL._FUN_DIR_RESSOURCES.$item['txtParamNom'];
        break;      
              
      default:
        $v = string2sql($item['txtParamNom']);      
        break;
    }
    */
      $typeParam  = getTypeFunParam($item['txtType']);
      
      //echo "<hr>{$typeParam}<hr>";
      switch($typeParam){
        case _FUN_TP_HTML_FILE: 
        case _FUN_TP_ARRAY:
        case _FUN_TP_ASCII_TEXT:     
        case _FUN_TP_HTML_TEXT:
        case _FUN_TP_ASCII_FILE:      
        case _FUN_TP_FOLDER:          
        	$v = $myts->addSlashes($item['txtParamNom']);
        	//$v = $myts->makeTareaData4Save($item['txtParamNom']);        	
          break;  
                
        case _FUN_TP_CHECKLISTBIN:
        case _FUN_TP_CHECKLIST: 
          //  displayArray($item, "******{$idEvent}*************");  
          //$v = checkBoxToBin($item['txtParamNom'], 'i', $def);
          //$v = checkBoxToBin($item, 'txtParamNom', $def);
          $v = checkBoxToBinA($item['txtParamNom']);
          //echo "<hr>effet = {$v}<hr>";         

          break;

        default:
        /*
        _FUN_TP_NOT_DEFINED
        _FUN_TP_NEW_BALISE
        _FUN_TP_SPIN
        _FUN_TP_LIST
        _FUN_TP_FILES
        _FUN_TP_COLOR
        _FUN_TP_HIDDEN_VAR
        _FUN_TP_URL_FUNY
        _FUN_TP_TABLE_LIST
        _FUN_TP_DESCRIPTION
        _FUN_TP_TITLE
        _FUN_TP_LINE
        _FUN_TP_LIBELLES
        */
        
        $v = string2sql($item['txtParamNom']);          
        break;
      }
        

        
        
    $sql = "INSERT INTO "._FUN_TFN_PARAM
          ." (idEvent,nom,valeur,typeValeur,keyName)"  
          ." VALUES ({$idEvent},'{$item['txtHParamNom']}','{$v}',{$typeParam},'{$item['txtKey']}')";

      //echo "<hr>saveParams -> {$sql}<hr>"; //exit;
/*

    $sql = "UPDATE "._HER_TFN_PARAM  
          ." SET  valeur = '{$v}' "
          ." WHERE idEvent = {$idEvent} " 
          ." AND nom = '{$item['txtHParamNom']}'";
*/
      $xoopsDB->queryF($sql);    
      //echo "<hr>{$sql}<hr>";
      //if ($item['txtHParamNom'] == 'funy_isObject')   $r['isObject'] = $v;
  } 
  
  
//exit;   
}  

/****************************************************************
 *
 ****************************************************************/
 function saveParams2Text ($idEvent) {
      $myts =& MyTextSanitizer::getInstance();
       $p = db_getEvent($idEvent);
       if (!isset($p['multi'])) $p['multi'] = 0;
       
      //displayArray($p, "---------saveParams2Text---------------");
      //$file = _FUN_DIR_PLUGIN.$p['plugin'];
      //$file = dirname($file).'/'.$p['nom'].".txt";
      //$file = getFileNameDeclaration($p[''], $p['nom'], );
      
      $file = getFileNameDeclaration($p['plugin'], $p['idEvent']);      
      //echo "<hr>saveParams2Text<br>{$file}<hr>";
      //----------------------------------------------
    $params = $p['funy_param'];
    if (count($params) > 0){
          $h=0;     
          $t = array();
          $sep = "//".str_repeat ('-',60 );          
           
 


          //$t[] = "<script  type='text/javascript' >" ;        
          //$t[] = "<!-- " . str_repeat ('=',55 );            
          $t[] = "// parametre globaux pour le plugin {$p['plugin']}" ;          
          //$t[] = $sep ;

          $declaration = "var funy_event = {$idEvent};";
          $t[] =  $declaration;
          $m = array();
          
          //------------------------------------------------------------------          
          switch($p['multi']){
            case 1:
              break;
              
            case 2:
              //$t[] = " {$p['objectName']}[{$idEvent}] = new {$p['objectName']}_def();";
              //$t[] = "{$p['objectName']}[funy_event] = new {$p['objectName']}_def(funy_event);";
              $t[] = "{$p['objectName']}[{$idEvent}] = new {$p['objectName']}_def({$idEvent});";              
              break;
            
            default:
              break;
          }          
          
          //------------------------------------------------------------------
          while (list ($key, $sqlfetch) = each ($params)) {
          if (!isset($sqlfetch['globalModule'])) $sqlfetch['globalModule'] = 0;
          if ($sqlfetch['globalModule'] == 1) continue;          
          
          //displayArray($sqlfetch, "----- saveParams2Text -----");
          $typeDeclare = 0;
          
          if (!isset($sqlfetch['declarationJS'])) $sqlfetch['declarationJS'] = 1;
          if ($sqlfetch['declarationJS'] == 0) continue;
          
          switch($p['multi']){
            case 1:
              $declaration = "var {$sqlfetch['name']} = new Array();";
              $m[] =  $declaration;
              break;
              
            case 2:
              //$declaration = "var {$sqlfetch['name']} = new Array();";
              //$m[] =  $declaration;
              break;
            
            default:
              break;
          }
          /*

          if ($p['multi'] == 1){
              $declaration = "var {$sqlfetch['name']} = new Array();";
              $m[] =  $declaration;
          }
          */          
          $typeParam = getTypeFunParam($sqlfetch['type']);
            if ($typeParam  == _FUN_TP_NEW_BALISE ) continue;

            switch ($typeParam){
              case _FUN_TP_NOT_DEFINED:
              case _FUN_TP_COLOR:    
              case _FUN_TP_TABLE_LIST: 
              case _FUN_TP_DESCRIPTION:                            
                //$v = $myts->previewTarea ($sqlfetch['value'],1,0,0,0,0);                       
                $v = str_replace('"', "'", $sqlfetch['value']);
                //$v = $myts->previewTarea ($sqlfetch['value'],1,0,0,0,0);
                //$v = "\"{$sqlfetch['value']}\"";
                $v = "\"{$v}\"";
                break;
                
              case _FUN_TP_FILES:                                          
                 if (isset ($sqlfetch['folder'])){
                  $folder   = $sqlfetch['folder'];             
                 }else{
                  $folder   = $params['folder_img']['value'];             
                 }

                $v = "\"". XOOPS_URL . '/' . $folder . $sqlfetch['value']."\"";              
                break;
                
                
              case _FUN_TP_LIBELLES:
              case _FUN_TP_ASCII_TEXT:
              case _FUN_TP_ASCII_FILE:
                $v = $myts->previewTarea ($sqlfetch['value'],1,0,0,0,0);
                $v = str_replace('<br />',"\n", $v);                
                $v =str_replace("\"", "\\\"", $v);
                $v = str_replace(chr(10), '' , $v);                
                $v = str_replace(chr(13), '\n" + "' , $v);                
                $v = "\"".$v."\"";                
                break;              
                
              //--------------------------------------------------------------  
              case _FUN_TP_FOLDER:
                $v  = "\"{$sqlfetch['value']}\"";                
                //arrayName = "funy_fonduJS_Files"
                
                $ext = $params['extention']['value'];
                $folder = XOOPS_ROOT_PATH.'/'.$sqlfetch['value'];
                $folder = str_replace ('//', '/', $folder);                
                //$taf  = getFiles ($folder, $ext, false, true);
                $taf  = getFiles2 ($folder, false, $ext);  
                              
                //echo "<hr>_FUN_TP_FOLDER : {$folder}<hr>";
                //displayArray($taf, "-------{$ext}----------");
                //exit;
               
                $declaration = "var {$sqlfetch['arrayName']} = new Array();";
                $t[] =  $declaration;
            
                $h = 0;
                while (list($key, $item) = each($taf)){
                  //$declaration = "    {$sqlfetch['arrayName']}[{$h}] = \"{$sqlfetch['value']}/{$item}\";";
                  $declaration = "    {$sqlfetch['arrayName']}[{$h}] = \"{$sqlfetch['value']}/{$item}\";";                  
                  $t[] =  $declaration;
                  $h++;
                }
                
                //-----------------------------------------
                if (isset($sqlfetch['widthName']) | isset($sqlfetch['heightName'])){
                    $f = $folder . '/' . $taf[0];

                    $img = imagecreatefromjpeg($f);

                    if (isset($sqlfetch['widthName']) | isset($sqlfetch['heightName'])){
                         $thumb_width  = imageSX($img).'px';   
                        $declaration = "var {$sqlfetch['widthName']} = \"{$thumb_width}\";";
                        $t[] =  $declaration;
                    }
                
                    if (isset($sqlfetch['widthName']) | isset($sqlfetch['heightName'])){
                        $thumb_height = imageSY($img).'px';  
                        $declaration = "var {$sqlfetch['heightName']} = \"{$thumb_height}\";";
                        $t[] =  $declaration;
                    }                    
                    //echo "<hr>$f<br>$declaration<hr>";
                
                }
               
                
                $typeDeclare = 0;                
                break;
                
              //--------------------------------------------------------------  
              case _FUN_TP_ARRAY:
                /*
                if isset($sqlfetch['file']){
                  $list = $sqlfetch['value'];                
                }else{
                  $list = $sqlfetch['value'];                
                }
                
                $list = str_replace(char(13), '|', $list);
                $list = str_replace(char(10), '|', $list);             

                */
                
                $list = str_replace(chr(13), '|', $sqlfetch['value']);
                $list = str_replace(chr(10), '|', $list);             
                $tList = explode('|', $list);
                $aName = $sqlfetch['arrayName'];
                $declaration = "var {$aName} = new Array();";
                $t[] =  $declaration;
                $i = -1;
//echo "<hr>{$list}<hr>";
//displayArray($tList, "--------------------------");
                for ($h = 0; $h < count($tList); $h++){
                  if ($tList[$h] == '') continue;                
                  $item = explode(':=', $tList[$h]);
                  
                  if ($item[0] == 'new') {
                    $i++;
                    $t[] = "";
                    $t[] = "{$aName}[{$i}] = new Array();";                    
                    continue;
                  }
                                    
 
                  $t[] = "{$aName}[{$i}]['{$item[0]}'] = \"{$item[1]}\";"; ;                                 
                }   
              
                break;                
                //--------------------------------------------------------------              
              case _FUN_TP_HTML_FILE:
              case _FUN_TP_HTML_TEXT:
                $v = $myts->previewTarea ($sqlfetch['value'],1,0,0,0,0);
                
                $v =str_replace("\"", "\\\"", $v);
                $v = "\"".$v."\"";                
              
                break;
                
              case _FUN_TP_URL_FUNY:
                $v = "\"".XOOPS_URL."/modules/funy/\"";
                break; 
                               
              case _FUN_TP_URL:
                $v = "\"".XOOPS_URL."/\"";
                break; 
 
              case _FUN_TP_CHECKLIST:
                $v = "\"".binToList($sqlfetch['value'])."\"";
                break; 
                                                                  
              default:
                /*
                _FUN_TP_NEW_BALISE              
                _FUN_TP_SPIN              
                _FUN_TP_LIST              
                _FUN_TP_HIDDEN_VAR              
                _FUN_TP_TITLE              
                _FUN_TP_LINE              
                */
                  $v = $sqlfetch['value'];              
                  break;
            }
            //----------------------------------------------
            if ($typeDeclare == 2){ 
            //if (is_array($v)){
                $declaration = "var {$sqlfetch['name']} = new Array();";
                $t[] =  $declaration;
            
              $h = 0;
              while (list($key, $item) = each($v)){
                $declaration = "    {$sqlfetch['name']}[{$h}] = \"{$item}\";";
                $t[] =  $declaration;
                $h++;
              }
            }elseif ($typeDeclare == 0) {
                switch ($p['multi']){
                case 1:
                  //$declaration = "{$sqlfetch['name']}[{$idEvent}] = {$v};"; 
                  $declaration = "{$sqlfetch['name']}[funy_event] = {$v};";                               
                  break;  
                                  
                case 2:
                  //funy_rebond[xx].prototype.rebond= $v;
                  //$declaration = "{$p['objectName']}[{$idEvent}].{$sqlfetch['name']} = {$v};";
                  //$declaration = "{$p['objectName']}[funy_event].{$sqlfetch['name']} = {$v};";                  
                  $declaration = "{$p['objectName']}[{$idEvent}].{$sqlfetch['name']} = {$v};";                                                    
                  break;                
                
                default:
                  $declaration = "var {$sqlfetch['name']} = {$v};";                
                  break;
                }
                /*

                if ($p['multi'] == 1){
                  $declaration = "{$sqlfetch['name']}[{$idEvent}] = {$v};";                
                }else{
                  $declaration = "var {$sqlfetch['name']} = {$v};";                
                }
                */                
                $t[] =  $declaration;
            }


            //---------------------------------------------------------------
            $h++;      
          }
  
          //$t[] = '// ' . str_repeat ('=', 55 ) . " End -->" ;
          //$t[] = "</script>" ;   
                                 


          switch ($p['multi']){
            case 1:
                break;
                
            case 2:
               //$t[] = "funy_rebond[funy_event].run();";
               $t[] = "funy_rebond[{$idEvent}].run();";               
                break;
          }
        
          $content = implode("\n", $t); 
         
          
    }else{
      $content = "";
    }          
    
    //------------------------------------


    fputContent ($file, $content, $msg );
    
    //-------------------------------------------
    //creation du fichier_0.js a inserer
    //-------------------------------------------    
    switch ($p['multi']){
    case 1:
       $file = getFileNameDeclaration($p['plugin'], 0);
       $content = implode("\n", $m);
       fputContent ($file, $content, $msg );       
        break;
        
    case 2:
       $file = getFileNameDeclaration($p['plugin'], 0);
       //recupere la liste des evennement du meme plugin
       //et construire les déclaration du type ob=new array()
       $declaration = "var {$p['objectName']} = new Array();";
       $content = $declaration;
       fputContent ($file, $content, $msg );       
        break;
    }
    
    /*

    if ($p['multi'] == 1){
       $file = getFileNameDeclaration($p['plugin'], 0);
       $content = implode("\n", $m);
       fputContent ($file, $content, $msg );       
    }
    */    
    
    //$oct = file_put_contents ($file, $content);
    //echo "<hr>{$file}<br>oct = {$oct}<br>$msg<br>$content<hr>";

            
// exit;     
 
 }
/****************************************************************
 *
 ****************************************************************/
 function saveParams2Object ($idEvent, $objectName) {
      $myts =& MyTextSanitizer::getInstance();
       $p = db_getEvent($idEvent);
      //$file = _FUN_DIR_PLUGIN.$p['plugin'];
      //$file = getFileNameDeclaration($p['plugin'], $p['nom']);
      $file = getFileNameDeclaration($p['plugin'], $p['idEvent']);
      //echo "<hr>saveParams2Text<br>{$file}<hr>";
      //----------------------------------------------
    $params = $p['funy_param'];
    if (count($params) > 0){
          $h=0;     
          $t = array();
          $sep = "//".str_repeat ('-',60 );          
           
 


          //$t[] = "<script  type='text/javascript' >" ;        
          //$t[] = "<!-- " . str_repeat ('=',55 );            
          $name = $objectName.$idEvent;
          $t[] = "{$name}.name = \"ppo{$idEvent}\"" ;                  
          //$t[] = $sep ;
          
          //------------------------------------------------------------------
          while (list ($key, $sqlfetch) = each ($params)) {
          //displayArray($sqlfetch, "----- saveParams2Text -----");
            
            switch ($sqlfetch['type']){
              case 0:
              case 4:              
                $v = "\"{$sqlfetch['value']}\"";
                break;
                                          
              case 3:
                $v = "\""._FUN_URL_RESSOURCES.$sqlfetch['value']."\"";              
                break;
                
              case 5:

                $v = $myts->previewTarea ($sqlfetch['value'],1,0,0,0,0);
                
                $v =str_replace("\"", "\\\"", $v);
                $v = "\"".$v."\"";                
              
                break;
              
              default:
                $v = $sqlfetch['value'];              
                break;
            }
            
            
            
            $declaration = "{$name}.{$sqlfetch['name']} = {$v}";
            $t[] =  $declaration;


            //---------------------------------------------------------------
            $h++;      
          }
  
          //$t[] = '// ' . str_repeat ('=', 55 ) . " End -->" ;
          //$t[] = "</script>" ;   
                                 

          $content = "// instance object globale pour le plugin {$p['plugin']}\n"
                    ."var {$name} = new {$objectName}();\n"
                    . implode(",\n", $t) . ";\n"
                    ."//------------------------------------------------------\n";
          
          fputContent ($file, $content, $msg );
          //$oct = file_put_contents ($file, $content);
          //echo "<hr>{$file}<br>oct = {$oct}<br>$msg<br>$content<hr>";
 
         
          
    }          
            
// exit;     
 
 }
/****************************************************************
 *
 ****************************************************************/
 function saveParams2Object2 ($idEvent) {
      $myts =& MyTextSanitizer::getInstance();
       $p = db_getEvent($idEvent);
      //$file = _FUN_DIR_PLUGIN.$p['plugin'];
      //$file = dirname($file).'/'.$p['nom'].".txt";
      $file = getFileNameDeclaration($p['plugin'], $p['$idEvent']);
      //echo "<hr>saveParams2Text<br>{$file}<hr>";
      //----------------------------------------------
    $params = $p['funy_param'];
    if (count($params) > 0){
          $h=0;     
          $t = array();
          $sep = "//".str_repeat ('-',60 );          
           
 


          //$t[] = "<script  type='text/javascript' >" ;        
          //$t[] = "<!-- " . str_repeat ('=',55 );            
  
          $t[] = "name : \"ppo{$idEvent}\"" ;                  
          //$t[] = $sep ;
          
          //------------------------------------------------------------------
          while (list ($key, $sqlfetch) = each ($params)) {
          //displayArray($sqlfetch, "----- saveParams2Text -----");
            
            switch ($sqlfetch['type']){
              case 0:
              case 4:              
                $v = "\"{$sqlfetch['value']}\"";
                break;
                                          
              case 3:
                $v = "\""._FUN_URL_RESSOURCES.$sqlfetch['value']."\"";              
                break;
                
              case 5:

                $v = $myts->previewTarea ($sqlfetch['value'],1,0,0,0,0);
                
                $v =str_replace("\"", "\\\"", $v);
                $v = "\"".$v."\"";                
              
                break;
              
              default:
                $v = $sqlfetch['value'];              
                break;
            }
            
            
            
            $declaration = "     {$sqlfetch['name']} : {$v}";
            $t[] =  $declaration;


            //---------------------------------------------------------------
            $h++;      
          }
  
          //$t[] = '// ' . str_repeat ('=', 55 ) . " End -->" ;
          //$t[] = "</script>" ;   
                                 

          $content = "// instance object globale pour le plugin {$p['plugin']}\n"
                    ."var funy_ppo{$idEvent} = {" . implode(",\n", $t) . "};\n"
                    ."//------------------------------------------------------\n";
          
          fputContent ($file, $content, $msg );
          //$oct = file_put_contents ($file, $content);
          //echo "<hr>{$file}<br>oct = {$oct}<br>$msg<br>$content<hr>";
 
         
          
    }          
            
// exit;     
 
 }

/****************************************************************
 *
 ****************************************************************/

function newEvent () {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "INSERT INTO "._FUN_TFN_EVENT." "
	      ."(name,description,periodicite,jour) "
	      ."VALUES ('???','???',0,0)";
	
       $xoopsDB->query($sql);	

  
}

/****************************************************************
 *
 ****************************************************************/

function deleteEvent ($id) {
	Global $xoopsModuleConfig, $xoopsDB, $xoopsConfig, $xoopsModule;
	
	$sql = "DELETE FROM "._FUN_TFN_EVENT." "
	      ."WHERE idEvent = ".$id;
	
       $xoopsDB->query($sql);	

	
  
}

/****************************************************************************
 *
 ****************************************************************************/
function previewEvent ($idEvent){
  
}



 
/****************************************************************************
 *
 ****************************************************************************/
function getEvent ($idEvent, $plugin=''){
	global $xoopsModuleConfig, $xoopsDB;
   

  if ($idEvent == 0) {
      $f = _FUN_DIR_PLUGIN.$plugin;	
      $ini = parse_ini_file($f, true);	

      $iniLang = getFunyLang($plugin);



      
      //displayArray($ini,'-------getEvent-------------');      
      
      if (!isset($ini['info']['multi'])) $ini['info']['multi'] = 0 ;
      
      //echo "<hr>{$f}<hr>";

      
      $isObject = ((isset($ini['info']['isObject'])) ? $ini['info']['isObject'] : 0);
      $objectName = ((isset($ini['info']['objectName'])) ? $ini['info']['objectName'] : 0);      
  //-------------------------------------------------------
      $p = array ('idEvent'           => 0, 
                  'plugin'            => $plugin,
                  'nom'               => $ini['info']['nom'],
                  'description'       => $iniLang['language']['description'],                  
                  'dateDebut'         => '',
                  'dateFin'           => '',
                  'periodicite'       => 0,
                  'actif'             => 1,
                  'isObject'          => $isObject,
                  'objectName'        => $objectName,
                  'ordre'             => 99,
                  'multi'             => $ini['info']['multi']);
      //$p['param'] = db_getParams($idEvent, $plugin);
      db_getParams($idEvent, $plugin, $p, $tSmarty);
      $p['smarty'] = $tSmarty;
  }
  else {
    //$p =array();
    //db_getEvent($idEvent, '', $p);
    $p = db_getEvent($idEvent);
    /*
	
    $sql = "SELECT  * FROM "._FUN_TFN_EVENT." "
          ."WHERE idEvent = ".$idEvent;
  
    //echo $sql."<br>";          
    $sqlquery=$xoopsDB->query($sql);
    //$p =  $xoopsDB->fetchRow($sqlquery);
    $sqlfetch=$xoopsDB->fetchArray($sqlquery);
    
   $p = $sqlfetch;

   $p['nom']      = sql2string ($p['nom']);

    */


    
  }
  return $p;
}

 
//---------------------------------------------------------------------
?>
