<?php
define ('_AD_FUN_ACTIF',                          'Actif');
define ('_AD_FUN_ADDOK',                          'La D&eacute;finition a &eacute;t&eacute; ajout&eacute;e dans la Base de Donn&eacute;es');
define ('_AD_FUN_AFFECTERBALISES',                'Affecter les balises');
define ('_AD_FUN_AFTER',                          'Apr&egrave;s');
define ('_AD_FUN_AUTHOR',                         'Auteur');
define ('_AD_FUN_AVERTISSEMENT',                  'Avertissement');
define ('_AD_FUN_BALISE',                         'Balise');
define ('_AD_FUN_BALISE_SMARTY',                  'Balise SMARTY');
define ('_AD_FUN_BALISES',                        'Balises');
define ('_AD_FUN_BEFORE',                         'Avant');
define ('_AD_FUN_BLOCK',                          'Bloc');
define ('_AD_FUN_BLOCK_SIDE',                     'Gauche|Droite|Non d&eacute;fini|Centre-Haut-Gauche|Centre-Haut-Droite|Centre-Haut-Milieu|Non d&eacute;fini|Centre-Bas-Gauche|Centre-Bas-Droite|Centre-Bas-Milieu');
define ('_AD_FUN_BLOCK_TYPE',                     'Type');
define ('_AD_FUN_BLOCKS',                         'Blocs');
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
define ('_AD_FUN_CANCEL',                         'Annuler');
define ('_AD_FUN_CATEGORY',                       'Cat&eacute;gorie');
define ('_AD_FUN_CLEARBALISES',                   'Effacer les balisee');
define ('_AD_FUN_CLOSE',                          'Fermer');
define ('_AD_FUN_CODE_INSERE',                    'Code ins&eacute;r&eacute;');
define ('_AD_FUN_CODE_LIE',                       'Fichier li&eacute;');
define ('_AD_FUN_CONFIGURATION_MODULE',           'Configuration du module');
define ('_AD_FUN_CONFIRM_DEL',                    "Confirmez vous la suppression de &quot;&quot;%1\$s&quot;&quot; des &quot;&quot;%2\$s&quot;&quot; ?");
define ('_AD_FUN_CONFIRM_INIT',                   'Confirmez la r&eacute;initialistion des param&egrave;tres');
define ('_AD_FUN_CURRENTS_EVENTS',                'Ev&egrave;nnements courants');
define ('_AD_FUN_CURRENTS_EVENTS_DSC',            'Liste ordnn&eacute;e des &eacute;v&eacute;nnements du jour');
define ('_AD_FUN_DATE_DEBUT',                     'Date de d&eacute;but');
define ('_AD_FUN_DATE_FIN',                       'Date de fin');
define ('_AD_FUN_DELETE',                         'Supprimer');
define ('_AD_FUN_DESCRIPTION',                    'Description');
define ('_AD_FUN_DUPLICATE',                      'Dupliquer');
define ('_AD_FUN_EDIT',                           'Editer');
define ('_AD_FUN_EVENT',                          'Ev&eacute;nement');
define ('_AD_FUN_EVENTS',                         'Ev&eacute;nnements');
define ('_AD_FUN_EVERYWHERE',                     'Partout');
define ('_AD_FUN_FILE',                           'Fichier');
define ('_AD_FUN_GENERER_PARAMS',                 'Re g&eacute;n&eacute;rer le fichier de param&egrave;tres');
define ('_AD_FUN_INIT_EVENT',                     'Initialisation des param&egrave;tres de l&apos;&eacute;v&eacute;nement');
define ('_AD_FUN_INIT_FUNY_BLOCKS',               'Initialisation des blocks cach&eacute;s');
define ('_AD_FUN_INSTANCES',                      'Instances');
define ('_AD_FUN_INSTANCES_DESC',                 'Nombre de fois ou le texte sera remplac&eacute; (0=partout)');
define ('_AD_FUN_MODE',                           'Mode');
define ('_AD_FUN_NAME',                           'Nom');
define ('_AD_FUN_NEW',                            'Nouveau');
define ('_AD_FUN_NO',                             'Non');
define ('_AD_FUN_NO_DESCRIPTION',                 '<strong><font color=red>Il n&apos;y a pas de description pour ce pugin.</font></strong>');
define ('_AD_FUN_NOM',                            'Nom');
define ('_AD_FUN_ORDRE',                          'Ordre');
define ('_AD_FUN_PAYS',                           'Pays');
define ('_AD_FUN_PERIODE_ANNUELLE',               'Annuelle');
define ('_AD_FUN_PERIODE_BIMENSUELLE',            'Bi-Mensuelle');
define ('_AD_FUN_PERIODE_DSC',                    'P&eacute;riodicit&eacute; &agrave; laquelle la lettre doit &ecirc;tre envoy&eacute;e.');
define ('_AD_FUN_PERIODE_EVENT_DSC',              'les date de d&eacute;but et de fin seront adapt&eacute;es, selon la p&eacute;riodicit&eacute;,');
define ('_AD_FUN_PERIODE_HEBDOMADAIRE',           'Hebdomadaire');
define ('_AD_FUN_PERIODE_JOURNALIERE',            'Journali&egrave;re');
define ('_AD_FUN_PERIODE_MAX',                    'P&eacute;riode');
define ('_AD_FUN_PERIODE_MAX_DSC',                'P&eacute;riode de recherche des &eacute;l&eacute;ments &agrave; int&eacute;grer. '.'<br>'
                                                 .'Les &eacute;l&eacute;ments ant&eacute;rieures &agrave; cette p&eacute;riode ne seront pas pris en compte.');

define ('_AD_FUN_PERIODE_MENSUELLE',              'Mensuelle');
define ('_AD_FUN_PERIODE_SEMESTRIELLE',           'Semestrielle');
define ('_AD_FUN_PERIODE_TRIMESTRIELLE',          'Trimestrielle');
define ('_AD_FUN_PERIODICITE',                    'Periodicit&eacute;');
define ('_AD_FUN_PLUGIN',                         'plugin');
define ('_AD_FUN_POSITION',                       'Position');
define ('_AD_FUN_PROVERBES',                      'Proverbes');
define ('_AD_FUN_REPEAT',                         'R&eacute;p&eacute;tition');
define ('_AD_FUN_REPERE',                         'Rep&egrave;re');
define ('_AD_FUN_REPLACE',                        'Remplacer');
define ('_AD_FUN_REPLACE_BY',                     'Remplacer par');
define ('_AD_FUN_SAVE',                           'Enregistrer');
define ('_AD_FUN_SCRIPT',                         'Script');
define ('_AD_FUN_SCRIPT_PARAMS',                  'D&eacute;claration des param&egrave;tres du script');
define ('_AD_FUN_SCRIPTS',                        'Scripts');
define ('_AD_FUN_SELECTION',                      'S&eacute;lection');
define ('_AD_FUN_SIDE',                           'C&ocirc;t&eacute;');
define ('_AD_FUN_STYLE_SHEET',                    'Feuille de style');
define ('_AD_FUN_STYLE_SHEET_DSC',                'Associe la feuille de style &agrave; la lettre de diffusion.'.'<br>'
                                                 .'Si aucune feulle n&apos;est s&eacute;lectionn&eacute;e, c&apos;est la feuille de style du th&egrave;me du site qui est utilis&eacute;e.');

define ('_AD_FUN_STYLE_SHEET_FUN_DSC',            'S&eacute;lectionnez le th&egrave;me &agrave; traiter.'.'<br>'
                                                 .'Seules les balises actives seront ins&eacute;r&eacute;es dans le fichier principal du th&egrave;me.');

define ('_AD_FUN_TEXTE',                          'Texte');
define ('_AD_FUN_THEME',                          'Th&egrave;me');
define ('_AD_FUN_TIME',                           'Fois');
define ('_AD_FUN_TITLE',                          'Titre');
define ('_AD_FUN_TO',                             '&agrave;');
define ('_AD_FUN_TO2',                            'au');
define ('_AD_FUN_TYPE',                           'Type');
define ('_AD_FUN_UPDATE',                         'Mettre &agrave; jour');
define ('_AD_FUN_VALIDER',                        'valider');
define ('_AD_FUN_VISIBLE',                        'Visible');
define ('_AD_FUN_WEIGHT',                         'Poids');
define ('_AD_FUN_YES',                            'Oui');
?>
