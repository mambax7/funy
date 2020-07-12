
CREATE TABLE `fun_event` (
  `idEvent` bigint(20) NOT NULL auto_increment,
  `plugin` varchar(150) NOT NULL,
  `nom` varchar(60) NOT NULL,
  `description` VARCHAR( 255 ) NOT NULL,
  `dateDebut` datetime NOT NULL,
  `dateFin` datetime NOT NULL,
  `periodicite` int(11) NOT NULL default '0',
  `actif` tinyint(1) NOT NULL,
  `isObject` tinyint(4) NOT NULL default '0',
  `objectName` varchar(30) NOT NULL,
  `multi` TINYINT NOT NULL DEFAULT '0',
  `ordre` INT NOT NULL DEFAULT '99',  
  PRIMARY KEY  (`idEvent`)
) type=MyISAM ;

CREATE TABLE `fun_param` (
  `idParam` bigint(20) NOT NULL auto_increment,
  `idEvent` bigint(20) NOT NULL,
  `nom` varchar(50) default NULL,
  `valeur` LONGTEXT default NULL,
  `typeValeur` tinyint(3) unsigned default NULL,
  `keyName` varchar(30) default NULL,  
  PRIMARY KEY  (`idParam`),
  KEY `jjd02_fun_param_FKIndex1` (`idEvent`)
) type=MyISAM ;

  
CREATE TABLE `fun_balise` (
  `idBalise` bigint(20) NOT NULL auto_increment,
  `nom` varchar(60) NOT NULL,
  `smarty` varchar(60) NOT NULL,
  `position` int(11) NOT NULL default '0',
  `repere` varchar(60) NOT NULL,
  `instance` int(11) NOT NULL default '1',
  `unkill` int(4) NOT NULL default '0',
  `ordre` int(11) NOT NULL default '0',
  `actif` tinyint(4) NOT NULL default '1',
  PRIMARY KEY  (`idBalise`),
  UNIQUE KEY `nom` (`nom`)
) type=MyISAM ;

 CREATE TABLE `fun_proverbe` (
  `idProverbe` bigint(20) NOT NULL auto_increment,
  `texte` longtext NOT NULL,
  `pays` varchar(30) NOT NULL,
  `auteur` varchar(60) NOT NULL,
  `categorie` varchar(30) NOT NULL default 'proverbe',
  `hits` INT NOT NULL DEFAULT '0',  
  PRIMARY KEY  (`idProverbe`)
) type=MyISAM ;

 CREATE TABLE `fun_smarty` (
  `idSmarty` BIGINT NOT NULL AUTO_INCREMENT ,
  `idEvent` BIGINT NOT NULL DEFAULT '0',  
  `fichier` VARCHAR( 60 ) NOT NULL ,
  `balise` VARCHAR( 60 ) NOT NULL ,
  `mode` TINYINT NOT NULL DEFAULT '0',
  `selection` TINYINT NOT NULL DEFAULT '0',
  `flag` TINYINT NOT NULL DEFAULT '0',
  PRIMARY KEY ( `idSmarty` )
) type=MyISAM ;


INSERT INTO `jjd_versions` (`module`, `code`, `version`, `dateVersion`, `libelle`) VALUES
('funy', 'fun_1_05a.php', '1.05a', '2008-12-31 12:12:12', 'gestion des balise');

INSERT INTO `fun_event` (`idEvent`, `plugin`, `nom`, `dateDebut`, `dateFin`, `periodicite`, `actif`, `isObject`, `objectName`, `ordre`) VALUES
(1, 'global_module/config.ini', 'global', '2008-01-01 00:00:00', '2008-12-31 00:00:00', 0, 1, 0, '0', 0);


INSERT INTO `fun_balise` (`nom`, `smarty`, `position`, `repere`, `instance`, `unkill`, `ordre`, `actif`) VALUES
('funy_function',  '%%<{\$funy_function}>%%',  1, '</head>', 1, 1, 10, 1),
('funy_param',       '<{\$funy_param}>%%',     1, '</head>', 1, 1, 10, 1),
('funy_head_fin',    '<{\$funy_head}>%%',      1, '</head>', 1, 1, 20, 1),
('funy_body',        '<{\$funy_body}>%%',      2, '<body>',  1, 1, 50, 1),
('funy_body_onload', '<{\$funy_body_onload}>', 2, '<body',   1, 1, 70, 1),
('funy_body_fin',    '<{\$funy_body_fin}>%%',  1, '</body>', 1, 1, 60, 1),
('funy_start_all',   '<{\$funy_start_all}>%%', 1, '</head>', 1, 1, 40, 1),
('funy_stop_all',    '<{\$funy_stop_all}>%%',  1, '</head>', 1, 1, 30, 1);




INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('A&nbsp;force&nbsp;de&nbsp;patience&nbsp;et&nbsp;de&nbsp;saindoux,&nbsp;l''&eacute;l&eacute;phant&nbsp;sodomise&nbsp;le&nbsp;pou.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Aimons&nbsp;na&icirc;tre,&nbsp;aimons&nbsp;vivre,&nbsp;aimons&nbsp;mourir&nbsp;:&nbsp;le&nbsp;n&eacute;ant&nbsp;n''existe&nbsp;pas.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Aller&nbsp;doucement&nbsp;n''emp&ecirc;che&nbsp;pas&nbsp;d''arriver.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Au&nbsp;bout&nbsp;de&nbsp;la&nbsp;patience,&nbsp;il&nbsp;y&nbsp;a&nbsp;le&nbsp;ciel.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Au&nbsp;chef,&nbsp;il&nbsp;faut&nbsp;des&nbsp;hommes&nbsp;et&nbsp;aux&nbsp;hommes,&nbsp;un&nbsp;chef.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Au&nbsp;th&eacute;&acirc;tre,&nbsp;il&nbsp;faut&nbsp;toujours&nbsp;s''asseoir&nbsp;au&nbsp;premier&nbsp;rang,&nbsp;car&nbsp;si&nbsp;la&nbsp;pi&egrave;ce&nbsp;est&nbsp;ennuyeuse,&nbsp;au&nbsp;moins&nbsp;on&nbsp;en&nbsp;sort&nbsp;ras&eacute;&nbsp;de&nbsp;pr&egrave;s.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Bouche&nbsp;de&nbsp;miel,&nbsp;coeur&nbsp;de&nbsp;fiel.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Ce&nbsp;n''est&nbsp;pas&nbsp;&agrave;&nbsp;toute&nbsp;oreille&nbsp;perc&eacute;e&nbsp;que&nbsp;l''on&nbsp;met&nbsp;des&nbsp;anneaux&nbsp;d''or.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Ce&nbsp;n''est&nbsp;pas&nbsp;parce&nbsp;que&nbsp;c''est&nbsp;dur&nbsp;que&nbsp;l''on&nbsp;ose&nbsp;pas,&nbsp;mais&nbsp;c''est&nbsp;parce&nbsp;que&nbsp;l''on&nbsp;ose&nbsp;pas&nbsp;que&nbsp;c''est&nbsp;dur.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Ce&nbsp;n''est&nbsp;pas&nbsp;parce&nbsp;que&nbsp;la&nbsp;hy&egrave;ne&nbsp;a&nbsp;mauvaise&nbsp;haleine&nbsp;qu''il&nbsp;faut&nbsp;lui&nbsp;interdire&nbsp;de&nbsp;bailler.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Ce&nbsp;qui&nbsp;est&nbsp;plus&nbsp;fort&nbsp;que&nbsp;l''&eacute;l&eacute;phant,&nbsp;c''est&nbsp;la&nbsp;brousse.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Celui&nbsp;qui&nbsp;a&nbsp;faim&nbsp;ne&nbsp;casse&nbsp;pas&nbsp;les&nbsp;graines&nbsp;pour&nbsp;en&nbsp;garder&nbsp;les&nbsp;amandes&nbsp;dans&nbsp;la&nbsp;main.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Celui&nbsp;qui&nbsp;a&nbsp;plant&eacute;&nbsp;un&nbsp;arbre&nbsp;avant&nbsp;de&nbsp;mourir&nbsp;n''a&nbsp;pas&nbsp;v&eacute;cu&nbsp;inutilement.','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Celui&nbsp;qui&nbsp;demande&nbsp;qu''on&nbsp;lui&nbsp;r&eacute;p&egrave;te,&nbsp;n''est&nbsp;pas&nbsp;forcement&nbsp;sourd.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Celui&nbsp;qui&nbsp;n''a&nbsp;pas&nbsp;travers&eacute;&nbsp;la&nbsp;rivi&egrave;re&nbsp;ne&nbsp;se&nbsp;moque&nbsp;pas&nbsp;de&nbsp;celui&nbsp;qui&nbsp;est&nbsp;dans&nbsp;le&nbsp;gu&eacute;.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Celui&nbsp;qui&nbsp;nage&nbsp;au&nbsp;milieu&nbsp;de&nbsp;la&nbsp;rivi&egrave;re&nbsp;n''est&nbsp;pas&nbsp;forcement&nbsp;con&nbsp;sur&nbsp;les&nbsp;bords.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Celui&nbsp;qui&nbsp;se&nbsp;l&egrave;ve&nbsp;tard&nbsp;ne&nbsp;voit&nbsp;jamais&nbsp;la&nbsp;tortue&nbsp;se&nbsp;brosser&nbsp;les&nbsp;dents&nbsp;le&nbsp;matin.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Celui&nbsp;qui&nbsp;se&nbsp;l&egrave;ve&nbsp;t&ocirc;t,&nbsp;ne&nbsp;voit&nbsp;pas&nbsp;le&nbsp;l&eacute;zard&nbsp;se&nbsp;brosser&nbsp;les&nbsp;dents.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('C''est&nbsp;au&nbsp;bout&nbsp;de&nbsp;la&nbsp;vieille&nbsp;corde&nbsp;qu''on&nbsp;tisse&nbsp;la&nbsp;nouvelle.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('C''est&nbsp;celui&nbsp;qui&nbsp;a&nbsp;p&eacute;t&eacute;,&nbsp;qui&nbsp;a&nbsp;le&nbsp;cul&nbsp;chaud.','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('C''est&nbsp;celui&nbsp;qui&nbsp;n''a&nbsp;jamais&nbsp;exerc&eacute;&nbsp;qui&nbsp;trouve&nbsp;que&nbsp;le&nbsp;pouvoir&nbsp;n''est&nbsp;pas&nbsp;plaisant.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('C''est&nbsp;en&nbsp;remuant&nbsp;l''herbe&nbsp;que&nbsp;l''on&nbsp;prend&nbsp;des&nbsp;grillons.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Dans&nbsp;un&nbsp;r&eacute;gime&nbsp;fasciste,&nbsp;on&nbsp;n''apprend&nbsp;pas&nbsp;&quot;je&nbsp;suis,&nbsp;tu&nbsp;es&quot;&nbsp;mais&nbsp;&quot;je&nbsp;hais,&nbsp;tu&nbsp;suis&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('De&nbsp;la&nbsp;marmite&nbsp;jusqu''aux&nbsp;tripes&nbsp;d''Ali.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Dieu&nbsp;n''a&nbsp;fait&nbsp;qu''&eacute;baucher&nbsp;l''homme;&nbsp;c''est&nbsp;sur&nbsp;la&nbsp;terre&nbsp;que&nbsp;chacun&nbsp;se&nbsp;cr&eacute;e.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('En&nbsp;Afrique,&nbsp;chaque&nbsp;fois&nbsp;qu''un&nbsp;vieillard&nbsp;meurt,&nbsp;c''est&nbsp;une&nbsp;biblioth&egrave;que&nbsp;qui&nbsp;br&ucirc;le.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Entour&eacute;&nbsp;d''un&nbsp;univers&nbsp;de&nbsp;choses&nbsp;tangibles&nbsp;et&nbsp;visibles&nbsp;:&nbsp;les&nbsp;animaux,&nbsp;les&nbsp;v&eacute;g&eacute;taux,&nbsp;les&nbsp;astres,&nbsp;l''homme,&nbsp;de&nbsp;tout&nbsp;temps,&nbsp;per&ccedil;oit&nbsp;qu''au&nbsp;plus&nbsp;profond&nbsp;de&nbsp;ces&nbsp;&ecirc;tres&nbsp;et&nbsp;de&nbsp;ces&nbsp;choses&nbsp;r&eacute;side&nbsp;quelque&nbsp;chose&nbsp;de&nbsp;puissant&nbsp;qu''il&nbsp;ne&nbsp;peut&nbsp;d&eacute;crire,&nbsp;et&nbsp;qui&nbsp;les&nbsp;anime.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Il&nbsp;est&nbsp;tr&egrave;s&nbsp;facile&nbsp;de&nbsp;se&nbsp;perdre&nbsp;dans&nbsp;le&nbsp;monde&nbsp;profane&nbsp;ou&nbsp;d''oublier&nbsp;notre&nbsp;connexion&nbsp;&agrave;&nbsp;l''esprit.&nbsp;Et&nbsp;pourtant,&nbsp;sans&nbsp;ce&nbsp;lien,&nbsp;nous&nbsp;ne&nbsp;sommes&nbsp;que&nbsp;des&nbsp;morts&nbsp;vivants.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Il&nbsp;faut&nbsp;attendre&nbsp;d''avoir&nbsp;travers&eacute;&nbsp;toute&nbsp;la&nbsp;rivi&egrave;re&nbsp;avant&nbsp;de&nbsp;dire&nbsp;que&nbsp;le&nbsp;crocodile&nbsp;a&nbsp;une&nbsp;sale&nbsp;gueule.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Il&nbsp;faut&nbsp;fa&ccedil;onner&nbsp;l''argile&nbsp;pendant&nbsp;qu''elle&nbsp;est&nbsp;molle.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Il&nbsp;n''y&nbsp;a&nbsp;pas&nbsp;de&nbsp;plus&nbsp;grand&nbsp;bonheur&nbsp;que&nbsp;la&nbsp;venue&nbsp;d''un&nbsp;h&ocirc;te&nbsp;dans&nbsp;la&nbsp;paix&nbsp;et&nbsp;l''amiti&eacute;.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Il&nbsp;n''y&nbsp;a&nbsp;pas&nbsp;la&nbsp;place&nbsp;pour&nbsp;plusieurs&nbsp;crocodiles&nbsp;dans&nbsp;le&nbsp;m&ecirc;me&nbsp;marigot.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('La&nbsp;banane&nbsp;qui&nbsp;doit&nbsp;m&ucirc;rir&nbsp;finira&nbsp;bien&nbsp;par&nbsp;m&ucirc;rir.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('La&nbsp;ch&egrave;vre&nbsp;mange&nbsp;l&agrave;&nbsp;o&ugrave;&nbsp;elle&nbsp;est&nbsp;attach&eacute;e.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('La&nbsp;douleur&nbsp;est&nbsp;comme&nbsp;le&nbsp;riz&nbsp;dans&nbsp;un&nbsp;d&eacute;p&ocirc;t:&nbsp;si&nbsp;chaque&nbsp;jour&nbsp;on&nbsp;en&nbsp;prend&nbsp;un&nbsp;panier,&nbsp;&agrave;&nbsp;la&nbsp;fin&nbsp;il&nbsp;n''y&nbsp;en&nbsp;a&nbsp;plus.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('La&nbsp;figue&nbsp;ne&nbsp;tombe&nbsp;jamais&nbsp;en&nbsp;plein&nbsp;dans&nbsp;la&nbsp;bouche.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('La&nbsp;force&nbsp;du&nbsp;baobab&nbsp;est&nbsp;dans&nbsp;ses&nbsp;racines.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('La&nbsp;gourde&nbsp;qui&nbsp;a&nbsp;contenu&nbsp;du&nbsp;piment,&nbsp;peut,&nbsp;m&ecirc;me&nbsp;vide,&nbsp;faire&nbsp;&eacute;ternuer.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('La&nbsp;langue&nbsp;qui&nbsp;fourche&nbsp;fait&nbsp;plus&nbsp;de&nbsp;mal&nbsp;que&nbsp;le&nbsp;pied&nbsp;qui&nbsp;tr&eacute;buche.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('La&nbsp;main&nbsp;de&nbsp;celui&nbsp;qui&nbsp;demande&nbsp;est&nbsp;toujours&nbsp;en&nbsp;dessous&nbsp;de&nbsp;celle&nbsp;de&nbsp;celui&nbsp;&agrave;&nbsp;qui&nbsp;il&nbsp;demande.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('La&nbsp;montre&nbsp;molle&nbsp;est&nbsp;une&nbsp;invention&nbsp;de&nbsp;Salvador&nbsp;Dali,&nbsp;particuli&egrave;rement&nbsp;adapt&eacute;e&nbsp;aux&nbsp;horaires&nbsp;souples&nbsp;et&nbsp;aux&nbsp;journ&eacute;es&nbsp;&eacute;lastiques,&nbsp;mais&nbsp;inutilisable&nbsp;quand&nbsp;les&nbsp;temps&nbsp;sont&nbsp;durs&nbsp;.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('La&nbsp;mouche&nbsp;a&nbsp;beau&nbsp;voler,&nbsp;elle&nbsp;ne&nbsp;deviendra&nbsp;jamais&nbsp;un&nbsp;oiseau...&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('L&agrave;&nbsp;o&ugrave;&nbsp;la&nbsp;hache&nbsp;va,&nbsp;c''est&nbsp;pour&nbsp;couper&nbsp;du&nbsp;bois.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('L&agrave;&nbsp;o&ugrave;&nbsp;le&nbsp;coeur&nbsp;est,&nbsp;les&nbsp;pieds&nbsp;n''h&eacute;sitent&nbsp;pas&nbsp;&agrave;&nbsp;y&nbsp;aller&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('La&nbsp;petite&nbsp;fourmi&nbsp;noire&nbsp;peut&nbsp;entrer&nbsp;chez&nbsp;l''homme,&nbsp;mais&nbsp;cet&nbsp;homme&nbsp;ne&nbsp;peut&nbsp;entrer&nbsp;chez&nbsp;elle!&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('La&nbsp;poule&nbsp;n''a&nbsp;jamais&nbsp;honte&nbsp;de&nbsp;son&nbsp;poulailler.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('La&nbsp;reconnaissance&nbsp;d''un&nbsp;&acirc;ne&nbsp;est&nbsp;un&nbsp;coup&nbsp;de&nbsp;pied.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('La&nbsp;route&nbsp;ne&nbsp;donne&nbsp;pas&nbsp;de&nbsp;renseignements&nbsp;au&nbsp;voyageur.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('La&nbsp;soci&eacute;t&eacute;&nbsp;de&nbsp;consommation&nbsp;porte&nbsp;mal&nbsp;son&nbsp;nom,&nbsp;car&nbsp;un&nbsp;con&nbsp;ne&nbsp;fait&nbsp;g&eacute;n&eacute;ralement&nbsp;pas&nbsp;de&nbsp;sommation&nbsp;avant&nbsp;de&nbsp;dire&nbsp;une&nbsp;connerie&nbsp;en&nbsp;soci&eacute;t&eacute;&nbsp;.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('La&nbsp;terre&nbsp;est&nbsp;m&egrave;re&nbsp;de&nbsp;tout&nbsp;ce&nbsp;qui&nbsp;est&nbsp;anim&eacute;,&nbsp;le&nbsp;lien&nbsp;des&nbsp;g&eacute;n&eacute;rations&nbsp;pass&eacute;es,&nbsp;pr&eacute;sentes&nbsp;et&nbsp;&agrave;&nbsp;venir.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('La&nbsp;violence&nbsp;du&nbsp;vent&nbsp;n''enl&egrave;ve&nbsp;pas&nbsp;les&nbsp;t&acirc;ches&nbsp;du&nbsp;l&eacute;opard.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('L''amour&nbsp;est&nbsp;aveugle,&nbsp;il&nbsp;faut&nbsp;donc&nbsp;toucher.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;boeuf&nbsp;ne&nbsp;se&nbsp;vante&nbsp;pas&nbsp;de&nbsp;sa&nbsp;force&nbsp;devant&nbsp;l''&eacute;l&eacute;phant.','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;borgne&nbsp;n''a&nbsp;qu''un&nbsp;oeil,&nbsp;mais&nbsp;il&nbsp;pleure&nbsp;quand&nbsp;m&ecirc;me.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;boucher&nbsp;d&icirc;ne&nbsp;avec&nbsp;des&nbsp;navets.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;chien&nbsp;a&nbsp;beau&nbsp;avoir&nbsp;quatre&nbsp;pattes,&nbsp;il&nbsp;ne&nbsp;peut&nbsp;emprunter&nbsp;deux&nbsp;chemins&nbsp;&agrave;&nbsp;la&nbsp;fois.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;chien&nbsp;perdu&nbsp;n''entend&nbsp;pas&nbsp;le&nbsp;sifflet&nbsp;de&nbsp;son&nbsp;maitre.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;coq&nbsp;a&nbsp;un&nbsp;seul&nbsp;propri&eacute;taire&nbsp;mais&nbsp;il&nbsp;chante&nbsp;pour&nbsp;tout&nbsp;le&nbsp;village.&nbsp;&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('le&nbsp;coq&nbsp;qui&nbsp;chante&nbsp;si&nbsp;fi&egrave;rement&nbsp;aujourd''hui&nbsp;ne&nbsp;dois&nbsp;pas&nbsp;oublier&nbsp;qu''il&nbsp;vient&nbsp;d''un&nbsp;oeuf.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;corps&nbsp;de&nbsp;l''homme&nbsp;contient&nbsp;du&nbsp;sang.&nbsp;Cependant&nbsp;quand&nbsp;il&nbsp;crache,&nbsp;c''est&nbsp;de&nbsp;l''eau.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;corps&nbsp;de&nbsp;l''homme&nbsp;est&nbsp;bien&nbsp;petit&nbsp;par&nbsp;rapport&nbsp;&agrave;&nbsp;l''esprit&nbsp;qui&nbsp;l''habite.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;crapeau&nbsp;aime&nbsp;l''eau,&nbsp;mais&nbsp;pas&nbsp;l''eau&nbsp;chaude...&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;derri&egrave;re&nbsp;de&nbsp;la&nbsp;femme&nbsp;est&nbsp;plus&nbsp;doux&nbsp;que&nbsp;sa&nbsp;t&ecirc;te.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;drapeau&nbsp;suit&nbsp;la&nbsp;direction&nbsp;du&nbsp;vent.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;feu&nbsp;qui&nbsp;te&nbsp;br&ucirc;lera,&nbsp;c''est&nbsp;celui&nbsp;auquel&nbsp;tu&nbsp;te&nbsp;chauffes.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;fleuve&nbsp;fait&nbsp;des&nbsp;d&eacute;tours&nbsp;parce&nbsp;que&nbsp;personne&nbsp;ne&nbsp;lui&nbsp;montre&nbsp;le&nbsp;chemin.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;gecko,&nbsp;m&ecirc;me&nbsp;gros,&nbsp;n''atteint&nbsp;pas&nbsp;le&nbsp;l&eacute;zard.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;gibier&nbsp;peut&nbsp;oublier&nbsp;les&nbsp;chasseurs,&nbsp;mais&nbsp;les&nbsp;chasseurs&nbsp;n''oublient&nbsp;pas&nbsp;le&nbsp;gibier.&nbsp;&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;grillon&nbsp;tient&nbsp;dans&nbsp;le&nbsp;creux&nbsp;de&nbsp;la&nbsp;main,&nbsp;mais&nbsp;on&nbsp;l''entend&nbsp;dans&nbsp;toute&nbsp;la&nbsp;prairie.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;l&eacute;opard&nbsp;ne&nbsp;se&nbsp;d&eacute;place&nbsp;pas&nbsp;sans&nbsp;ses&nbsp;taches.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;l&eacute;zard&nbsp;fait&nbsp;beaucoup&nbsp;de&nbsp;pompages&nbsp;,&nbsp;mais&nbsp;il&nbsp;n''a&nbsp;jamais&nbsp;eu&nbsp;des&nbsp;biceps.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;mensonge&nbsp;donne&nbsp;des&nbsp;fleurs&nbsp;mais&nbsp;pas&nbsp;de&nbsp;fruits.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;minaret&nbsp;est&nbsp;tomb&eacute;,&nbsp;ils&nbsp;ont&nbsp;pondu&nbsp;le&nbsp;coiffeur.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;sang&nbsp;est&nbsp;plus&nbsp;&eacute;pais&nbsp;que&nbsp;l''eau.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;serpent&nbsp;dit&nbsp;:&nbsp;je&nbsp;grimpe&nbsp;sur&nbsp;un&nbsp;arbre&nbsp;et&nbsp;je&nbsp;n''ai&nbsp;pas&nbsp;de&nbsp;bras.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;serpent&nbsp;oublie&nbsp;qu''il&nbsp;a&nbsp;mordu&nbsp;la&nbsp;poule,&nbsp;mais&nbsp;la&nbsp;poule&nbsp;n''oublie&nbsp;jamais&nbsp;!&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;soleil&nbsp;n''ignore&nbsp;pas&nbsp;un&nbsp;village&nbsp;parce&nbsp;qu''il&nbsp;est&nbsp;petit.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;soleil&nbsp;n''oublie&nbsp;jamais&nbsp;un&nbsp;village,&nbsp;m&ecirc;me&nbsp;si&nbsp;il&nbsp;est&nbsp;petit.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;ventre&nbsp;affam&eacute;&nbsp;n''a&nbsp;pas&nbsp;d''oreilles.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;vieil&nbsp;&eacute;l&eacute;phant&nbsp;sait&nbsp;o&ugrave;&nbsp;trouver&nbsp;de&nbsp;l''eau.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Le&nbsp;vieux&nbsp;se&nbsp;chauffe&nbsp;avec&nbsp;le&nbsp;bois&nbsp;r&eacute;colt&eacute;&nbsp;dans&nbsp;sa&nbsp;jeunesse.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('L''eau&nbsp;chaude&nbsp;n''oublie&nbsp;pas&nbsp;qu''elle&nbsp;a&nbsp;&eacute;t&eacute;&nbsp;froide.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('L''&eacute;l&eacute;phant&nbsp;meurt,&nbsp;mais&nbsp;ses&nbsp;d&eacute;fenses&nbsp;demeurent.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('L''&eacute;l&eacute;phant&nbsp;ne&nbsp;peut&nbsp;pas&nbsp;courir&nbsp;et&nbsp;se&nbsp;gratter&nbsp;les&nbsp;fesses&nbsp;en&nbsp;m&ecirc;me&nbsp;temps.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Lentement&nbsp;se&nbsp;courbe&nbsp;la&nbsp;banane.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('L''erreur&nbsp;n''annule&nbsp;pas&nbsp;la&nbsp;valeur&nbsp;de&nbsp;l''effort&nbsp;accompli.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Les&nbsp;nuages&nbsp;sont&nbsp;le&nbsp;pr&eacute;sage&nbsp;de&nbsp;la&nbsp;pluie.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Les&nbsp;poules&nbsp;ne&nbsp;frayent&nbsp;pas&nbsp;avec&nbsp;les&nbsp;cafards.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Les&nbsp;probl&egrave;mes&nbsp;ne&nbsp;cherchent&nbsp;pas&nbsp;les&nbsp;gens,&nbsp;ce&nbsp;sont&nbsp;les&nbsp;gens&nbsp;qui&nbsp;cherchent&nbsp;les&nbsp;probl&egrave;mes.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('L''esprit&nbsp;est&nbsp;la&nbsp;force,&nbsp;la&nbsp;vie&nbsp;qui&nbsp;se&nbsp;trouve&nbsp;en&nbsp;toute&nbsp;chose.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('L''&eacute;tranger&nbsp;te&nbsp;permet&nbsp;d''&ecirc;tre&nbsp;toi-m&ecirc;me,&nbsp;en&nbsp;faisant,&nbsp;de&nbsp;toi,&nbsp;un&nbsp;&eacute;tranger.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('L''homme&nbsp;a&nbsp;invent&eacute;&nbsp;la&nbsp;montre,&nbsp;mais&nbsp;Dieu&nbsp;a&nbsp;invent&eacute;&nbsp;le&nbsp;temps.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('L''homme&nbsp;qui&nbsp;a&nbsp;la&nbsp;diarrh&eacute;e&nbsp;n''a&nbsp;pas&nbsp;peur&nbsp;de&nbsp;l''obscurit&eacute;.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('L''oiseau&nbsp;vole&nbsp;dans&nbsp;le&nbsp;ciel,&nbsp;mais&nbsp;n''oublie&nbsp;pas&nbsp;qu''un&nbsp;jour&nbsp;ses&nbsp;os&nbsp;tomberont&nbsp;parterre!&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('L''ombre&nbsp;du&nbsp;z&egrave;bre,&nbsp;n''a&nbsp;pas&nbsp;de&nbsp;rayures.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('L''oreille&nbsp;n''est&nbsp;jamais&nbsp;plus&nbsp;grande&nbsp;que&nbsp;la&nbsp;t&ecirc;te.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Lorsque&nbsp;tu&nbsp;ne&nbsp;sais&nbsp;pas&nbsp;o&ugrave;&nbsp;tu&nbsp;vas,&nbsp;regarde&nbsp;d''o&ugrave;&nbsp;tu&nbsp;viens.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Lorsque&nbsp;tu&nbsp;offres&nbsp;un&nbsp;pagne&nbsp;&agrave;&nbsp;ta&nbsp;belle-m&egrave;re,&nbsp;ne&nbsp;lui&nbsp;dis&nbsp;pas&nbsp;que&nbsp;c''est&nbsp;pour&nbsp;couvrir&nbsp;ses&nbsp;fesses.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('M&ecirc;me&nbsp;la&nbsp;poule&nbsp;noire&nbsp;pond&nbsp;des&nbsp;oeufs&nbsp;blancs!&nbsp;&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('M&ecirc;me&nbsp;le&nbsp;poisson&nbsp;qui&nbsp;vit&nbsp;dans&nbsp;l''eau&nbsp;a&nbsp;toujours&nbsp;soif.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('M&ecirc;me&nbsp;si&nbsp;le&nbsp;gnou&nbsp;mange&nbsp;l''herbe,&nbsp;elle&nbsp;continue&nbsp;de&nbsp;pousser.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Mieux&nbsp;vaut&nbsp;habiter&nbsp;une&nbsp;maison&nbsp;en&nbsp;&quot;L&quot;&nbsp;qu''un&nbsp;ch&acirc;teau&nbsp;hant&eacute;&nbsp;.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Ne&nbsp;brandis&nbsp;pas&nbsp;dans&nbsp;l''air&nbsp;le&nbsp;serpent&nbsp;que&nbsp;tu&nbsp;as&nbsp;tu&eacute;,&nbsp;les&nbsp;autres&nbsp;serpents&nbsp;te&nbsp;guettent.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Ne&nbsp;jette&nbsp;pas&nbsp;la&nbsp;provision&nbsp;d''eau&nbsp;de&nbsp;ta&nbsp;jarre&nbsp;parce&nbsp;que&nbsp;la&nbsp;pluie&nbsp;s''annonce.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Ne&nbsp;mets&nbsp;pas&nbsp;ton&nbsp;doigt&nbsp;entre&nbsp;l''&eacute;corce&nbsp;et&nbsp;l''arbre.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Ne&nbsp;pile&nbsp;pas&nbsp;ton&nbsp;mil&nbsp;avec&nbsp;une&nbsp;banane&nbsp;m&ucirc;re.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Ne&nbsp;repousse&nbsp;pas&nbsp;du&nbsp;pied&nbsp;la&nbsp;pirogue&nbsp;qui&nbsp;t''a&nbsp;d&eacute;pos&eacute;&nbsp;sur&nbsp;la&nbsp;berge.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Ne&nbsp;te&nbsp;lasse&nbsp;pas&nbsp;de&nbsp;crier&nbsp;ta&nbsp;joie&nbsp;d''&ecirc;tre&nbsp;en&nbsp;vie&nbsp;et&nbsp;tu&nbsp;n''entendras&nbsp;plus&nbsp;d''autres&nbsp;cris.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('On&nbsp;apprend&nbsp;l''utilit&eacute;&nbsp;des&nbsp;fesses&nbsp;que&nbsp;lorsque&nbsp;vient&nbsp;le&nbsp;moment&nbsp;de&nbsp;s''assoir.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('On&nbsp;n''ach&egrave;te&nbsp;pas&nbsp;un&nbsp;bijou&nbsp;non&nbsp;depouille&nbsp;de&nbsp;son&nbsp;emballage.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('On&nbsp;ne&nbsp;peut&nbsp;pas&nbsp;tresser&nbsp;la&nbsp;t&ecirc;te&nbsp;d''un&nbsp;absent.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('On&nbsp;n''est&nbsp;pas&nbsp;orphelin&nbsp;d''avoir&nbsp;perdu&nbsp;p&egrave;re&nbsp;et&nbsp;m&egrave;re,&nbsp;mais&nbsp;d''avoir&nbsp;perdu&nbsp;l''espoir.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('On&nbsp;peut&nbsp;aider&nbsp;un&nbsp;bœuf&nbsp;&agrave;&nbsp;se&nbsp;relever&nbsp;que&nbsp;s''il&nbsp;s''efforce&nbsp;lui-m&ecirc;me&nbsp;de&nbsp;le&nbsp;faire.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('On&nbsp;peut&nbsp;dire&nbsp;de&nbsp;quelqu''un&nbsp;qui&nbsp;s''est&nbsp;pris&nbsp;une&nbsp;veste&nbsp;qu''il&nbsp;s''est&nbsp;fait&nbsp;saper&nbsp;le&nbsp;moral.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('On&nbsp;tarde&nbsp;&agrave;&nbsp;grandir,&nbsp;on&nbsp;ne&nbsp;tarde&nbsp;pas&nbsp;&agrave;&nbsp;mourir.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Peu&nbsp;importe&nbsp;la&nbsp;direction&nbsp;du&nbsp;vent,&nbsp;le&nbsp;soleil&nbsp;va&nbsp;toujours&nbsp;l&agrave;&nbsp;ou&nbsp;il&nbsp;doit&nbsp;aller.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Pour&nbsp;qu''un&nbsp;enfant&nbsp;grandisse,&nbsp;il&nbsp;faut&nbsp;tout&nbsp;un&nbsp;village.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Quand&nbsp;&ccedil;a&nbsp;domine&nbsp;&ccedil;a,&nbsp;le&nbsp;monde&nbsp;devient&nbsp;&ccedil;a!&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Quand&nbsp;le&nbsp;h&eacute;risson&nbsp;n''en&nbsp;a&nbsp;plus&nbsp;pour&nbsp;longtemps&nbsp;&agrave;&nbsp;vivre,&nbsp;il&nbsp;trouve&nbsp;qu''il&nbsp;fait&nbsp;trop&nbsp;chaud&nbsp;dans&nbsp;les&nbsp;buissons.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Quand&nbsp;le&nbsp;lion&nbsp;aura&nbsp;son&nbsp;propre&nbsp;historien,&nbsp;l''histoire&nbsp;ne&nbsp;sera&nbsp;plus&nbsp;&eacute;crite&nbsp;par&nbsp;le&nbsp;chasseur.&nbsp;&nbsp;&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Quand&nbsp;le&nbsp;singe&nbsp;voit&nbsp;un&nbsp;beau&nbsp;fruit&nbsp;dans&nbsp;l''arbre&nbsp;et&nbsp;qu''il&nbsp;ne&nbsp;peut&nbsp;s''en&nbsp;saisir,&nbsp;alors&nbsp;le&nbsp;singe&nbsp;dit&nbsp;que&nbsp;le&nbsp;fruit&nbsp;est&nbsp;pourri.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Quand&nbsp;les&nbsp;&eacute;l&eacute;phants&nbsp;se&nbsp;battent&nbsp;,&nbsp;c''est&nbsp;l''herbe&nbsp;qui&nbsp;souffre&nbsp;!&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Quand&nbsp;on&nbsp;a&nbsp;mang&eacute;&nbsp;sal&eacute;,&nbsp;on&nbsp;ne&nbsp;peut&nbsp;plus&nbsp;manger&nbsp;sans&nbsp;sel.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Quand&nbsp;on&nbsp;a&nbsp;rien&nbsp;&agrave;&nbsp;dire&nbsp;il&nbsp;vaut&nbsp;mieux&nbsp;se&nbsp;taire.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Quand&nbsp;on&nbsp;coupe&nbsp;les&nbsp;oreilles,&nbsp;le&nbsp;cou&nbsp;s''inqui&egrave;te.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Quand&nbsp;on&nbsp;enterre&nbsp;un&nbsp;cadavre,&nbsp;on&nbsp;ne&nbsp;laisse&nbsp;pas&nbsp;ses&nbsp;pieds&nbsp;dehors.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Quand&nbsp;on&nbsp;n''a&nbsp;qu''une&nbsp;lance,&nbsp;on&nbsp;ne&nbsp;doit&nbsp;pas&nbsp;s''en&nbsp;servir&nbsp;contre&nbsp;un&nbsp;l&eacute;opard.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Quand&nbsp;tu&nbsp;es&nbsp;boubou,&nbsp;tu&nbsp;sors&nbsp;boubou&nbsp;sur&nbsp;la&nbsp;photo.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Quand&nbsp;tu&nbsp;marches,&nbsp;le&nbsp;pagne&nbsp;dure;&nbsp;quand&nbsp;tu&nbsp;es&nbsp;assis,&nbsp;le&nbsp;pagne&nbsp;s''use.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Quand&nbsp;un&nbsp;homme&nbsp;est&nbsp;li&eacute;&nbsp;avec&nbsp;une&nbsp;corde,&nbsp;t&ocirc;t&nbsp;ou&nbsp;tard&nbsp;il&nbsp;la&nbsp;rompt.&nbsp;&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Que&nbsp;celui&nbsp;qui&nbsp;n''a&nbsp;pas&nbsp;travers&eacute;&nbsp;ne&nbsp;se&nbsp;moque&nbsp;pas&nbsp;de&nbsp;celui&nbsp;qui&nbsp;s''est&nbsp;noy&eacute;.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Quelle&nbsp;que&nbsp;soit&nbsp;la&nbsp;maigreur&nbsp;de&nbsp;l''&eacute;l&eacute;phant,&nbsp;ses&nbsp;couilles&nbsp;remplissent&nbsp;toujours&nbsp;la&nbsp;marmite.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Qui&nbsp;dort&nbsp;affam&eacute;&nbsp;se&nbsp;l&egrave;ve&nbsp;le&nbsp;matin&nbsp;le&nbsp;coeur&nbsp;plein&nbsp;de&nbsp;haine&nbsp;.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Qui&nbsp;est&nbsp;press&eacute;&nbsp;d''avoir&nbsp;un&nbsp;enfant&nbsp;&eacute;pouse&nbsp;une&nbsp;femme&nbsp;enceinte.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Qui&nbsp;flatte&nbsp;le&nbsp;crocodile&nbsp;peut&nbsp;se&nbsp;baigner&nbsp;tranquille.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Qui&nbsp;nage&nbsp;dans&nbsp;le&nbsp;sens&nbsp;du&nbsp;courant&nbsp;fait&nbsp;rire&nbsp;les&nbsp;crocodiles.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Qui&nbsp;veut&nbsp;du&nbsp;miel&nbsp;doit&nbsp;avoir&nbsp;le&nbsp;courage&nbsp;d''affronter&nbsp;les&nbsp;abeilles.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Qui&nbsp;veut&nbsp;souffrir,&nbsp;tra&icirc;ne&nbsp;son&nbsp;sexe&nbsp;dans&nbsp;la&nbsp;fourmili&egrave;re.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Sarcle&nbsp;tous&nbsp;tes&nbsp;plants&nbsp;de&nbsp;sorgho,&nbsp;tu&nbsp;ne&nbsp;sais&nbsp;pas&nbsp;lequel&nbsp;portera&nbsp;fruits&nbsp;et&nbsp;lequel&nbsp;restera&nbsp;st&eacute;rile.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Se&nbsp;prot&eacute;ger&nbsp;et&nbsp;faire&nbsp;attention&nbsp;maintient&nbsp;en&nbsp;vie,&nbsp;savoir&nbsp;courrir&nbsp;la&nbsp;rallonge&nbsp;!','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Si&nbsp;la&nbsp;personne&nbsp;partie&nbsp;puiser&nbsp;l''eau&nbsp;n''est&nbsp;pas&nbsp;de&nbsp;retour,&nbsp;c''est&nbsp;que&nbsp;les&nbsp;calebasses&nbsp;ne&nbsp;sont&nbsp;pas&nbsp;encore&nbsp;remplies.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Si&nbsp;la&nbsp;porte&nbsp;est&nbsp;ferm&eacute;e,&nbsp;n''h&eacute;site&nbsp;pas&nbsp;&agrave;&nbsp;passer&nbsp;par&nbsp;les&nbsp;fen&ecirc;tres&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Si&nbsp;la&nbsp;porte&nbsp;est&nbsp;ouverte,&nbsp;&ccedil;a&nbsp;ne&nbsp;sert&nbsp;&agrave;&nbsp;rien&nbsp;de&nbsp;passer&nbsp;par&nbsp;les&nbsp;fen&ecirc;tres.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Si&nbsp;le&nbsp;sol&nbsp;te&nbsp;br&ucirc;le&nbsp;les&nbsp;pieds&nbsp;c''est&nbsp;que&nbsp;tu&nbsp;ne&nbsp;cours&nbsp;pas&nbsp;assez&nbsp;vite.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Si&nbsp;press&eacute;e&nbsp;soit&nbsp;la&nbsp;mouche,&nbsp;elle&nbsp;doit&nbsp;attendre&nbsp;que&nbsp;sorte&nbsp;l''excr&eacute;ment.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Si&nbsp;tu&nbsp;as&nbsp;de&nbsp;nombreuses&nbsp;richesses&nbsp;donne&nbsp;ton&nbsp;bien&nbsp;;&nbsp;si&nbsp;tu&nbsp;poss&egrave;de&nbsp;peu,&nbsp;donne&nbsp;ton&nbsp;coeur.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Si&nbsp;tu&nbsp;es&nbsp;un&nbsp;cheval,&nbsp;il&nbsp;ne&nbsp;faut&nbsp;pas&nbsp;qu''on&nbsp;t''appelle&nbsp;un&nbsp;&acirc;ne!&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Si&nbsp;tu&nbsp;n''as&nbsp;pas&nbsp;assez&nbsp;d''eau&nbsp;pour&nbsp;prendre&nbsp;un&nbsp;bain&nbsp;,&nbsp;lave&nbsp;toi&nbsp;le&nbsp;visage.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Si&nbsp;tu&nbsp;ne&nbsp;sais&nbsp;pas&nbsp;o&ugrave;&nbsp;tu&nbsp;vas,&nbsp;t&acirc;che&nbsp;au&nbsp;moins&nbsp;de&nbsp;te&nbsp;souvenir&nbsp;d''o&ugrave;&nbsp;tu&nbsp;viens&nbsp;!&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Si&nbsp;tu&nbsp;peux&nbsp;marcher,&nbsp;tu&nbsp;peux&nbsp;danser.&nbsp;Si&nbsp;tu&nbsp;peux&nbsp;parler,&nbsp;tu&nbsp;peux&nbsp;chanter...&nbsp;&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Si&nbsp;tu&nbsp;regardes&nbsp;une&nbsp;image&nbsp;tr&egrave;s&nbsp;laide,&nbsp;v&eacute;rifies&nbsp;que&nbsp;ce&nbsp;ne&nbsp;soit&nbsp;pas&nbsp;ton&nbsp;reflet...&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Si&nbsp;tu&nbsp;s&egrave;mes&nbsp;une&nbsp;&eacute;pine,&nbsp;quand&nbsp;elle&nbsp;poussera,&nbsp;elle&nbsp;te&nbsp;piquera&nbsp;.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Si&nbsp;tu&nbsp;supportes&nbsp;la&nbsp;fum&eacute;e,&nbsp;tu&nbsp;te&nbsp;r&eacute;chaufferas&nbsp;avec&nbsp;la&nbsp;braise.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Si&nbsp;tu&nbsp;te&nbsp;tapes&nbsp;la&nbsp;t&ecirc;te&nbsp;contre&nbsp;une&nbsp;cruche&nbsp;et&nbsp;que&nbsp;sa&nbsp;sonne&nbsp;creux,&nbsp;n''en&nbsp;d&eacute;duis&nbsp;pas&nbsp;forc&eacute;ment&nbsp;que&nbsp;c''est&nbsp;la&nbsp;cruche&nbsp;qui&nbsp;est&nbsp;vide...&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Si&nbsp;tu&nbsp;vois&nbsp;un&nbsp;crocodile&nbsp;en&nbsp;train&nbsp;d''acheter&nbsp;un&nbsp;pantalon,&nbsp;c''est&nbsp;qu''il&nbsp;a&nbsp;trouv&eacute;&nbsp;le&nbsp;moyen&nbsp;de&nbsp;sortir&nbsp;sa&nbsp;queue.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Si&nbsp;un&nbsp;d&eacute;corateur&nbsp;vous&nbsp;propose&nbsp;des&nbsp;rideaux&nbsp;vert&nbsp;empire,&nbsp;exigez&nbsp;les&nbsp;m&ecirc;mes&nbsp;en&nbsp;mieux.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Si&nbsp;un&nbsp;petit&nbsp;arbre&nbsp;est&nbsp;sorti&nbsp;de&nbsp;terre&nbsp;sous&nbsp;un&nbsp;baobab,&nbsp;il&nbsp;meurt&nbsp;arbrisseau.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Si&nbsp;vous&nbsp;nagez&nbsp;dans&nbsp;le&nbsp;bonheur,&nbsp;soyez&nbsp;prudent,&nbsp;restez&nbsp;l&agrave;&nbsp;o&ugrave;&nbsp;vous&nbsp;avez&nbsp;pied.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Soul&egrave;ve&nbsp;ta&nbsp;charge&nbsp;jusqu''au&nbsp;genou&nbsp;,&nbsp;on&nbsp;t''aidera&nbsp;&agrave;&nbsp;la&nbsp;mettre&nbsp;sur&nbsp;la&nbsp;t&ecirc;te&nbsp;!&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Suivez&nbsp;les&nbsp;abeilles&nbsp;et&nbsp;vous&nbsp;mangerez&nbsp;le&nbsp;miel.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Sur&nbsp;quelque&nbsp;arbre&nbsp;que&nbsp;ton&nbsp;p&egrave;re&nbsp;soit&nbsp;mont&eacute;,&nbsp;si&nbsp;tu&nbsp;ne&nbsp;peux&nbsp;grimper,&nbsp;mets&nbsp;au&nbsp;moins&nbsp;la&nbsp;main&nbsp;sur&nbsp;le&nbsp;tronc.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Tant&nbsp;qu''on&nbsp;n''esp&egrave;re&nbsp;pas,&nbsp;on&nbsp;ne&nbsp;s''impatiente&nbsp;pas.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Toi&nbsp;dans&nbsp;la&nbsp;for&ecirc;t,&nbsp;moi&nbsp;dans&nbsp;la&nbsp;for&ecirc;t,&nbsp;et&nbsp;tu&nbsp;me&nbsp;demandes&nbsp;o&ugrave;&nbsp;est&nbsp;le&nbsp;soleil&nbsp;?&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Tous&nbsp;les&nbsp;blancs&nbsp;ont&nbsp;une&nbsp;montre,&nbsp;mais&nbsp;ils&nbsp;n''ont&nbsp;jamais&nbsp;le&nbsp;temps.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Tout&nbsp;a&nbsp;une&nbsp;fin,&nbsp;sauf&nbsp;la&nbsp;banane&nbsp;qui&nbsp;en&nbsp;a&nbsp;deux.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Tout&nbsp;&ecirc;tre,&nbsp;m&ecirc;me&nbsp;une&nbsp;simple&nbsp;apparence,&nbsp;le&nbsp;moindre&nbsp;signe&nbsp;sensible,&nbsp;est&nbsp;dou&eacute;&nbsp;d''une&nbsp;force&nbsp;singuli&egrave;re.&nbsp;Il&nbsp;reste&nbsp;que&nbsp;l''homme,&nbsp;surtout&nbsp;l''homme&nbsp;vivant,&nbsp;est&nbsp;dou&eacute;&nbsp;de&nbsp;ce&nbsp;privil&egrave;ge&nbsp;d''avoir&nbsp;la&nbsp;plus&nbsp;active,&nbsp;la&nbsp;plus&nbsp;dynamique.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Toute&nbsp;naissance&nbsp;est&nbsp;la&nbsp;renaissance&nbsp;d''un&nbsp;anc&ecirc;tre.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Traverse&nbsp;la&nbsp;rivi&egrave;re&nbsp;avant&nbsp;d''insulter&nbsp;le&nbsp;crocodile.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Trop&nbsp;de&nbsp;plaisanterie&nbsp;am&egrave;ne&nbsp;la&nbsp;querelle.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Trop&nbsp;de&nbsp;sel&nbsp;g&acirc;te&nbsp;la&nbsp;sauce.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Tueur&nbsp;&agrave;&nbsp;gages,&nbsp;c''est&nbsp;un&nbsp;m&eacute;tier&nbsp;comme&nbsp;un&nbsp;autre;&nbsp;tous&nbsp;les&nbsp;jours,&nbsp;on&nbsp;pointe,&nbsp;la&nbsp;seule&nbsp;diff&eacute;rence,&nbsp;c''est&nbsp;qu''apr&egrave;s,&nbsp;on&nbsp;tire.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Un&nbsp;a&nbsp;posteriori&nbsp;est&nbsp;un&nbsp;a&nbsp;priori&nbsp;favorable&nbsp;d''un&nbsp;homme&nbsp;envers&nbsp;une&nbsp;femme&nbsp;qui&nbsp;a&nbsp;un&nbsp;beau&nbsp;post&eacute;rieur.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Un&nbsp;acacia&nbsp;ne&nbsp;tombe&nbsp;pas&nbsp;&agrave;&nbsp;la&nbsp;volont&eacute;&nbsp;d''une&nbsp;ch&egrave;vre&nbsp;maigre&nbsp;qui&nbsp;convoite&nbsp;ses&nbsp;fruits.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Un&nbsp;ami&nbsp;dans&nbsp;le&nbsp;besoin&nbsp;est&nbsp;un&nbsp;v&eacute;ritable&nbsp;ami.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Un&nbsp;b&eacute;b&eacute;&nbsp;au&nbsp;dos&nbsp;ne&nbsp;sait&nbsp;pas&nbsp;que&nbsp;la&nbsp;route&nbsp;est&nbsp;longue.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Un&nbsp;grain&nbsp;de&nbsp;ma&iuml;s&nbsp;a&nbsp;toujours&nbsp;tort&nbsp;devant&nbsp;une&nbsp;poule.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Un&nbsp;homme&nbsp;plein&nbsp;de&nbsp;vices&nbsp;finit&nbsp;un&nbsp;jour&nbsp;ou&nbsp;l''autre&nbsp;sous&nbsp;&eacute;crou.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Un&nbsp;homme&nbsp;qui&nbsp;se&nbsp;noie&nbsp;s''agrippe&nbsp;&agrave;&nbsp;l''eau.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Un&nbsp;pet&nbsp;qui&nbsp;se&nbsp;prolonge&nbsp;peut&nbsp;entrainer&nbsp;une&nbsp;vraie&nbsp;chiasse.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Un&nbsp;poisson&nbsp;qui&nbsp;pourrit&nbsp;et&nbsp;tous&nbsp;sont&nbsp;pourris.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Un&nbsp;policier&nbsp;de&nbsp;proximit&eacute;&nbsp;est&nbsp;un&nbsp;policier&nbsp;qui&nbsp;tire&nbsp;&agrave;&nbsp;bout&nbsp;portant.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Un&nbsp;seul&nbsp;doigt&nbsp;ne&nbsp;peut&nbsp;prendre&nbsp;un&nbsp;caillou.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Un&nbsp;seul&nbsp;morceau&nbsp;de&nbsp;bois&nbsp;donne&nbsp;de&nbsp;la&nbsp;fum&eacute;e&nbsp;mais&nbsp;pas&nbsp;de&nbsp;feu.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Un&nbsp;silence&nbsp;vaut&nbsp;25&nbsp;r&eacute;ponses.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Un&nbsp;sorcier&nbsp;ne&nbsp;se&nbsp;gu&eacute;rit&nbsp;pas&nbsp;lui-m&ecirc;me.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Un&nbsp;tronc&nbsp;d''arbre&nbsp;a&nbsp;beau&nbsp;s&eacute;journer&nbsp;dans&nbsp;le&nbsp;fleuve,&nbsp;il&nbsp;ne&nbsp;se&nbsp;transformera&nbsp;jamais&nbsp;en&nbsp;crocodile!&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Une&nbsp;femme&nbsp;qui&nbsp;veut&nbsp;que&nbsp;son&nbsp;mari&nbsp;lui&nbsp;ach&egrave;te&nbsp;une&nbsp;robe&nbsp;dernier&nbsp;cri&nbsp;aura&nbsp;toujours&nbsp;le&nbsp;dernier&nbsp;mot.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Une&nbsp;pirogue&nbsp;n''est&nbsp;jamais&nbsp;trop&nbsp;grande&nbsp;pour&nbsp;chavirer.&nbsp;','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Vient&nbsp;manger&nbsp;des&nbsp;figues,&nbsp;qui&nbsp;t''a&nbsp;invit&eacute;&nbsp;?&nbsp;.','africain','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('A&nbsp;toi&nbsp;la&nbsp;galette&nbsp;tr&egrave;s&nbsp;fine,&nbsp;&agrave;&nbsp;moi&nbsp;le&nbsp;repas&nbsp;deux&nbsp;fois.&nbsp;','Alg&eacute;rien','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Arabe,&nbsp;tu&nbsp;est&nbsp;Arabe&nbsp;m&ecirc;me&nbsp;si&nbsp;tu&nbsp;t''appelle&nbsp;Colonel&nbsp;Bendaoud.&nbsp;','Alg&eacute;rien','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Avec&nbsp;une&nbsp;seule&nbsp;f&egrave;ve&nbsp;on&nbsp;ne&nbsp;peut&nbsp;pas&nbsp;pr&eacute;parer&nbsp;la&nbsp;soupe.&nbsp;','Alg&eacute;rien','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Balaie&nbsp;l&agrave;&nbsp;o&ugrave;&nbsp;tu&nbsp;veux&nbsp;tomber.&nbsp;','Alg&eacute;rien','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Ben&ecirc;t,&nbsp;qui&nbsp;a&nbsp;cuit&nbsp;un&nbsp;œuf,&nbsp;Ben&ecirc;t&nbsp;qui&nbsp;esp&egrave;re&nbsp;en&nbsp;manger.&nbsp;','Alg&eacute;rien','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Bonjour&nbsp;mon&nbsp;voisin,&nbsp;tu&nbsp;t''occupes&nbsp;de&nbsp;ton&nbsp;cot&eacute;&nbsp;et&nbsp;je&nbsp;m''occupe&nbsp;du&nbsp;mien.&nbsp;','Alg&eacute;rien','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('&Ccedil;a&nbsp;ne&nbsp;sert&nbsp;&agrave;&nbsp;rien&nbsp;de&nbsp;convoiter&nbsp;une&nbsp;chose&nbsp;qui&nbsp;n''est&nbsp;pas&nbsp;&agrave;&nbsp;nous.&nbsp;','Alg&eacute;rien','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Ce&nbsp;n''est&nbsp;pas&nbsp;parce&nbsp;qu''il&nbsp;&eacute;tudie&nbsp;qu''il&nbsp;ne&nbsp;se&nbsp;soulage&nbsp;pas,&nbsp;ce&nbsp;n''est&nbsp;pas&nbsp;parce&nbsp;qu''il&nbsp;prie&nbsp;que&nbsp;Dieu&nbsp;il&nbsp;ne&nbsp;craigne&nbsp;pas.&nbsp;','Alg&eacute;rien','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Ce&nbsp;que&nbsp;les&nbsp;parents&nbsp;disent&nbsp;de&nbsp;bon&nbsp;ou&nbsp;mauvais,&nbsp;les&nbsp;enfants&nbsp;vont&nbsp;le&nbsp;r&eacute;p&eacute;ter.&nbsp;','Alg&eacute;rien','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Ce&nbsp;sont&nbsp;les&nbsp;trous&nbsp;creus&eacute;s&nbsp;par&nbsp;les&nbsp;rats&nbsp;qui&nbsp;ont&nbsp;fait&nbsp;tomber&nbsp;le&nbsp;cheval.&nbsp;','Alg&eacute;rien','','proverbe');
INSERT INTO fun_proverbe(texte,pays,auteur,categorie) VALUES ('Celui&nbsp;qui&nbsp;a&nbsp;mang&eacute;&nbsp;sa&nbsp;part,&nbsp;ferme&nbsp;les&nbsp;yeux.&nbsp;','Alg&eacute;rien','','proverbe');


 