<?php
define ('_AD_FUN_ACTIF',                          'Actif');
define ('_AD_FUN_ADDOK',                          'The definition has been added to the database');
define ('_AD_FUN_AFFECTERBALISES',                'Affect balises');
define ('_AD_FUN_AFTER',                          'After');
define ('_AD_FUN_AUTHOR',                         'Author');
define ('_AD_FUN_AVERTISSEMENT',                  'Avertissement');
define ('_AD_FUN_BALISE',                         'Balise');
define ('_AD_FUN_BALISE_SMARTY',                  'Balise SMARTY');
define ('_AD_FUN_BALISES',                        'Balises');
define ('_AD_FUN_BEFORE',                         'Before');
define ('_AD_FUN_BLOCK',                          'Block');
define ('_AD_FUN_BLOCK_SIDE',                     'Left|Right|Not define|Center-Top-Left|Center-Top-Right|Center-Top-Center|Not define|Center-Bottom-Left|Center-Bottom-Right|Center-Bottom-Center|');
define ('_AD_FUN_BLOCK_TYPE',                     'Type');
define ('_AD_FUN_BLOCKS',                         'Blocks');
define ('_AD_FUN_BLOCKS_FUNY_DSC',                '<big><b>Param&eacute;trage des blocks du module.</b></big> : Attention l&apos;emplacement, l&apos;ordre et la visibilit&eacute; des blocs sont d&eacute;terminants.'.'<br>'
                                                 .'C&apos;est d&apos;abord l&apos;emplacement qui d&eacute;fini l&apos;ordre puis le poids.'.'<br>'
                                                 .'<b>Ordre des emplacement:</b>'.'<br>'
                                                 .'0 - Gauche'.'<br>'
                                                 .'1 - Droite'.'<br>'
                                                 .'2 - Non d&eacute;fini'.'<br>'
                                                 .'3 - Centre-Haut-Gauche'.'<br>'
                                                 .'4 - Centre-Haut-Droite'.'<br>'
                                                 .'5 - Centre-Haut-Milieu'.'<br>'
                                                 .'6 - Non d&eacute;fini'.'<br>'
                                                 .'7 - Centre-Bas-Gauche'.'<br>'
                                                 .'8 - Centre-Bas-Droite'.'<br>'
                                                 .'9 - Centre-Bas-Milieu'.'<br>'
                                                 .''.'<br>'
                                                 .'<span style=&quot;font-weight: bold;&quot;>Pr&eacute;conisations</span>'.'<br>'
                                                 .'<ul>'.'<br>'
                                                 .'<li>Le block <b>&quot;funy_block_script&quot;</b> doit &ecirc;tre avant tous les autres blocks. De pr&eacute;f&eacute;rence positionnez le &agrave; gauche avec un poid de 99 et sans titre. Il doit &ecirc;tre visible, mais sans titre il passera pratiquement inaper&ccedil;u.</li>'.'<br>'
                                                 .'<li>Le block <b>&quot;funy_rename&quot;</b> doit se trouver en dernier. placer le soit &agrave; &quot;droite&quot; ou au &quot;centre-bas-milieu&quot;, et sans titre.'.'<br>'
                                                 .'C&apos;est ce qui se charge de renommer les blocks avec les titre d&eacute;finis dans certains plugins. Si vous n&apos;utilisez les titres des blocks dans les plugins, vous pouvre laisser ce bloc invisible (non conseill&eacute;).'.'<br>'
                                                 .'<li>Le block <b>&quot;funy&quot;</b> doit se trouver avant le bloc &quot;funy_rename&quot;. Il peut &ecirc;tre invisible. Son seul int&eacute;r&ecirc;t est d&apos;&ecirc;tre pourvu de boutons qui permettent de stoper ou relancer certains scripts.</li>'.'<br>'
                                                 .'<li>Les autres blocks <b>&quot;funy_block_0&quot; &agrave; &quot;funy_block_4&quot;</b> doivent se trouver entre les blocks &quot;funy_block_script&quot; et &quot;funy_block_rename&quot;'.'<br>'
                                                 .'Ne rendez visible que ceux que vous utilisez.</li>'.'<br>'
                                                 .'<li><b>Titre des blocks</b> : Certains plugins permettent d&apos;affecter un nom au block. Si le titre n&apos;est pas une chaine vide dans le plugin, c&apos;est ce dernier qui sera affich&eacute; &agrave; la place de celui du bloc.</li>'.'<br>'
                                                 .'</ul>');

define ('_AD_FUN_BLOCKS_INITIALISES',             'Les blocs du modules ont &eacute;t&eacute; initialis&eacute;s avec succ&egrave;s.');
define ('_AD_FUN_CANCEL',                         'Cancel');
define ('_AD_FUN_CATEGORY',                       'Category');
define ('_AD_FUN_CLEARBALISES',                   'Clear balises');
define ('_AD_FUN_CLOSE',                          'Close');
define ('_AD_FUN_CODE_INSERE',                    'Code ins&eacute;r&eacute;');
define ('_AD_FUN_CODE_LIE',                       'Fichier li&eacute;');
define ('_AD_FUN_CONFIGURATION_MODULE',           'Module configuration');
define ('_AD_FUN_CONFIRM_DEL',                    "Confirm that you wont remove &quot;%1\$s&quot; from &quot;%2\$s&quot; ?");
define ('_AD_FUN_CONFIRM_INIT',                   'Confirmez la r&eacute;initialistion des param&egrave;tres');
define ('_AD_FUN_CURRENTS_EVENTS',                'Currents events');
define ('_AD_FUN_CURRENTS_EVENTS_DSC',            'Liste ordnn&eacute;es des &eacute;v&eacute;nnement du jour');
define ('_AD_FUN_DATE_DEBUT',                     'Begin date');
define ('_AD_FUN_DATE_FIN',                       'end date');
define ('_AD_FUN_DELETE',                         'Delete');
define ('_AD_FUN_DESCRIPTION',                    'Description');
define ('_AD_FUN_DUPLICATE',                      'Duplicate');
define ('_AD_FUN_EDIT',                           'Edit');
define ('_AD_FUN_EVENT',                          'Ev&eacute;nement');
define ('_AD_FUN_EVENTS',                         'Events');
define ('_AD_FUN_EVERYWHERE',                     'Every where');
define ('_AD_FUN_FILE',                           'File');
define ('_AD_FUN_GENERER_PARAMS',                 'Re g&eacute;n&eacute;rer le fichier de param&egrave;tres');
define ('_AD_FUN_INIT_EVENT',                     'Initialisation des param&egrave;tres de l&apos;&eacute;v&eacute;nement');
define ('_AD_FUN_INIT_FUNY_BLOCKS',               'Initialisation des blocks cach&eacute;s');
define ('_AD_FUN_INSTANCES',                      'Instances');
define ('_AD_FUN_INSTANCES_DESC',                 'Nombre de fois ou le texte sera remplac&eacute; (0=partout)');
define ('_AD_FUN_MODE',                           'Mode');
define ('_AD_FUN_NAME',                           'Name');
define ('_AD_FUN_NEW',                            'New');
define ('_AD_FUN_NO',                             'No');
define ('_AD_FUN_NO_DESCRIPTION',                 '<strong><font color=red>There is no description for this plugin.</font></strong>');
define ('_AD_FUN_NOM',                            'Name');
define ('_AD_FUN_ORDRE',                          'Order');
define ('_AD_FUN_PAYS',                           'Pays');
define ('_AD_FUN_PERIODE_ANNUELLE',               'Yearly');
define ('_AD_FUN_PERIODE_BIMENSUELLE',            'Bi-monthly');
define ('_AD_FUN_PERIODE_DSC',                    'P&eacute;riodicit&eacute; &agrave; la quelle la lettre doit &ecirc; tre envoy&eacute;e.');
define ('_AD_FUN_PERIODE_EVENT_DSC',              'les date de d&eacute;but et de fin seront adapt&eacute;es, Selon la p&eacute;riodicit&eacute;,');
define ('_AD_FUN_PERIODE_HEBDOMADAIRE',           'Hebdomadaire');
define ('_AD_FUN_PERIODE_JOURNALIERE',            'Journali&egrave;re');
define ('_AD_FUN_PERIODE_MAX',                    'P&eacute;riod');
define ('_AD_FUN_PERIODE_MAX_DSC',                'P&eacute;riode de recherche des &eacute;l&eacute;ments &agrave; int&eacute;grer. '.'<br>'
                                                 .'Les &eacute;l&eacute;ments ant&eacute;rieures &agrave; cette p&eacute;riode ne seront pas pris en compte.');

define ('_AD_FUN_PERIODE_MENSUELLE',              'Monthly');
define ('_AD_FUN_PERIODE_SEMESTRIELLE',           'Half-yearly');
define ('_AD_FUN_PERIODE_TRIMESTRIELLE',          'Quaterly');
define ('_AD_FUN_PERIODICITE',                    'Periodicit&eacute;');
define ('_AD_FUN_PLUGIN',                         'plugin');
define ('_AD_FUN_POSITION',                       'Position');
define ('_AD_FUN_PROVERBES',                      'Proverbes');
define ('_AD_FUN_REPEAT',                         'Repeat');
define ('_AD_FUN_REPERE',                         'Rep&egrave;re');
define ('_AD_FUN_REPLACE',                        'Replace');
define ('_AD_FUN_REPLACE_BY',                     'Replace by');
define ('_AD_FUN_SAVE',                           'Save');
define ('_AD_FUN_SCRIPT',                         'Script');
define ('_AD_FUN_SCRIPT_PARAMS',                  'D&eacute;claration des param&egrave;tres du script');
define ('_AD_FUN_SCRIPTS',                        'Scripts');
define ('_AD_FUN_SELECTION',                      'Selection');
define ('_AD_FUN_SIDE',                           'Side');
define ('_AD_FUN_STYLE_SHEET',                    'Style sheet');
define ('_AD_FUN_STYLE_SHEET_DSC',                'Associe la feuille de style &agrave; la lettre de diffusion.'.'<br>'
                                                 .'Si aucune feulle n&apos;est s&eacute;lectionn&eacute;e, c&apos;est la feuille de style du th&egrave;me du site qui est utilis&eacute;e.');

define ('_AD_FUN_STYLE_SHEET_FUN_DSC',            'S&eacute;lectionnez le th&egrave;me &agrave; traiter.'.'<br>'
                                                 .'Seules les balises actives seront ins&eacute;r&eacute;es dans le fichier principal du th&egrave;me.');

define ('_AD_FUN_TEXTE',                          'Text');
define ('_AD_FUN_THEME',                          'Theme');
define ('_AD_FUN_TIME',                           'Time');
define ('_AD_FUN_TITLE',                          'Title');
define ('_AD_FUN_TO',                             'to');
define ('_AD_FUN_TO2',                            'to');
define ('_AD_FUN_TYPE',                           'Type');
define ('_AD_FUN_UPDATE',                         'Update');
define ('_AD_FUN_VALIDER',                        'Validate');
define ('_AD_FUN_VISIBLE',                        'Visible');
define ('_AD_FUN_WEIGHT',                         'Weight');
define ('_AD_FUN_YES',                            'Yes');
?>
