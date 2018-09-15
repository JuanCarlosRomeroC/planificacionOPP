-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: planificador
-- ------------------------------------------------------
-- Server version	5.7.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `actividad`
--

DROP TABLE IF EXISTS `actividad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actividad` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) CHARACTER SET latin1 NOT NULL,
  `id_jefatura` int(4) NOT NULL,
  `id_unidad` int(4) NOT NULL DEFAULT '0',
  `fecha_created` date NOT NULL,
  `fecha_updated` date DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id` (`id_jefatura`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividad`
--

LOCK TABLES `actividad` WRITE;
/*!40000 ALTER TABLE `actividad` DISABLE KEYS */;
INSERT INTO `actividad` VALUES (1,'manteamiento de computadoras',3,0,'2018-08-07','2018-08-19',1),(2,'Brindar soporte tecnico a los distintos sistemas desarrollados por el SEDES potosi',1,2,'2018-08-09',NULL,1),(6,'miki rafael',4,0,'2018-08-09',NULL,1),(7,'actividad de jefatura prueba',1,2,'2018-08-09',NULL,1),(8,'nueva actividad EDITADA',1,2,'2018-08-09','2018-08-19',1),(9,'Reparacion del equipamiento informatico, atravez del remplazo de accesorios, para garantiza el funcionamiento optimo',1,2,'2018-08-19','2018-08-19',1),(10,'una nueva actividad creada por el planificador',8,39,'2018-09-13','2018-09-13',1);
/*!40000 ALTER TABLE `actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargo`
--

DROP TABLE IF EXISTS `cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargo`
--

LOCK TABLES `cargo` WRITE;
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
INSERT INTO `cargo` VALUES (1,'DESARROLLADOR DE SOFTWARE',''),(2,'INGENIERO DE SISTEMAS',''),(3,'TECNICO ','');
/*!40000 ALTER TABLE `cargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `establecimiento`
--

DROP TABLE IF EXISTS `establecimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `establecimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_municipio` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_municipio_idx` (`id_municipio`),
  CONSTRAINT `id_municipio` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=474 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `establecimiento`
--

LOCK TABLES `establecimiento` WRITE;
/*!40000 ALTER TABLE `establecimiento` DISABLE KEYS */;
INSERT INTO `establecimiento` VALUES (1,'C.S. AVAROA',50301),(2,'C.S. BETANZOS',50301),(3,'C.S. BETANZOS C.N.S.',50301),(4,'C.S. CHACPI GRANDE',50301),(5,'C.S. MAMAHOTA',50301),(6,'C.S. MILLARES',50301),(7,'C.S. POCO POCO',50301),(8,'C.S. QUIVI QUIVI',50301),(9,'C.S. TIRQUIBUCO',50301),(10,'C.S. VILA VILA',50301),(11,'C.S. VILLA CARMEN',50301),(12,'P.S. ANCOMAYO',50301),(13,'P.S. B.PUITA',50301),(14,'P.S. BUEY TAMBO',50301),(15,'P.S. HUANO HUANO',50301),(16,'P.S. KOA KOA',50301),(17,'P.S. LA FLORIDA',50301),(18,'P.S. LAGUNILLAS',50301),(19,'P.S. MARIACA',50301),(20,'P.S. OTUYO',50301),(21,'P.S. QUIVINCHA',50301),(22,'P.S. SIPORO',50301),(23,'P.S. TIRISPAYA',50301),(24,'P.S. TRAPICHE BAJO',50301),(25,'P.S. URIFAYA',50301),(26,'P.S. VIÃ±A QUEMADA',50301),(27,'C.S. CHAQUI',50302),(28,'C.S. COIPASI',50302),(29,'P.S. BAÃ±OS CHAQUI',50302),(30,'P.S. CHICO CHICO',50302),(31,'P.S. CHIUTALUYO',50302),(32,'P.S. DON DIEGO',50302),(33,'P.S. EL PALOMAR',50302),(34,'C.S. CKARA CARA (COTAGAITA)',50601),(35,'C.S. CORNACA',50601),(36,'C.S. COTAGAITA',50601),(37,'C.S. COTAGAITA (CAJA)',50601),(38,'C.S. PALCA HIGUERAS',50601),(39,'C.S. SAGRARIO(CAJA)',50601),(40,'C.S. TABLAYA CHICA',50601),(41,'C.S. TASNA RETIRO',50601),(42,'C.S. TASNA ROSARIO',50601),(43,'C.S. TOROPALCA',50601),(44,'C.S. TOTORA (COTAGAITA)',50601),(45,'C.S. TUMUSLA',50601),(46,'P.S. ASCANTI',50601),(47,'P.S. CALILA',50601),(48,'P.S. CAZON',50601),(49,'P.S. CHECOCHI',50601),(50,'P.S. CHUI CHUI',50601),(51,'P.S. COLLPA UNO',50601),(52,'P.S. COTAGAITILLA',50601),(53,'P.S. ESCARA',50601),(54,'P.S. JACOSCAPA',50601),(55,'P.S. LAYTAPI',50601),(56,'P.S. LIMETA',50601),(57,'P.S. MOCKO PATA',50601),(58,'P.S. PAMPA GRANDE',50601),(59,'P.S. QECHISLA',50601),(60,'P.S. RAMADAS',50601),(61,'P.S. SAGRARIO',50601),(62,'P.S. SAN JORGE',50601),(63,'P.S. TAPCHIQUIRA',50601),(64,'P.S. TASNA',50601),(65,'P.S. THAPI',50601),(66,'P.S. TOCLA (COTAGAITA)',50601),(67,'P.S. URUPALCA',50601),(68,'P.S. VICHACLA',50601),(69,'P.S. VILLA CONCEPCION',50601),(70,'C.S. CALCHA',50602),(71,'C.S. VITICHI',50602),(72,'C.S. YAWISLA',50602),(73,'P.S. ARIPALCA',50602),(74,'P.S. CALVI',50602),(75,'P.S. KEHUACA GRANDE',50602),(76,'P.S. PECKA',50602),(77,'P.S. PEKAJSI',50602),(78,'P.S. SAN ANTONIO',50602),(79,'P.S. TOQUENZA',50602),(80,'P.S. TUSQUIÃ±A',50602),(81,'P.S. YULO',50602),(82,'C.S. COLQUECHACA',50401),(83,'C.S. COLQUECHACA (C.N.S.)',50401),(84,'C.S. MACHA',50401),(85,'C.S. ULUCHI',50401),(86,'P.S. AYOMA',50401),(87,'P.S. BOMBORI',50401),(88,'P.S. CASTILLA HUMA',50401),(89,'P.S. CHALVIRI-COLQUECHACA',50401),(90,'P.S. CHAYRAPATA',50401),(91,'P.S. CHUAFAYA',50401),(92,'P.S. FUTINA',50401),(93,'P.S. IRUCOYANA',50401),(94,'P.S. PAMPA COLORADA',50401),(95,'P.S. ROSARIO',50401),(96,'P.S. SALINAS ALTA',50401),(97,'P.S. THURKO',50401),(98,'P.S. TITIRI',50401),(99,'P.S. TOMAYCURI',50401),(100,'C.S. CKARA CKARA (OCURI)',50404),(101,'C.S. OCURI',50404),(102,'P.S. JUTHY',50404),(103,'P.S. LUYUPAMPA',50404),(104,'P.S. MARAGUA',50404),(105,'P.S. MARCOMA',50404),(106,'P.S. MILLUNI',50404),(107,'P.S. PEAÃ±A',50404),(108,'P.S. PUCALOMA',50404),(109,'P.S. YURIMATA',50404),(110,'C.S. POCOATA',50403),(111,'C.S. SAN MIGUEL DE KHARI',50403),(112,'P.S. ALCARAPI',50403),(113,'P.S. CAMPAYA',50403),(114,'P.S. COLLANA TUICA',50403),(115,'P.S. COLLPA Q`ASA',50403),(116,'P.S. HUANCARANI',50403),(117,'P.S. KHAPAJRANCHO',50403),(118,'P.S. PACOTANCA',50403),(119,'P.S. QUESINFUCO',50403),(120,'P.S. SARIJCHI',50403),(121,'P.S. TOLAPAMPA',50403),(122,'P.S. TOTORA (POCOATA)',50403),(123,'P.S. UREKA',50403),(124,'P.S. YAWACO',50403),(125,'C.S. RAVELO',50402),(126,'P.S. ANTORA',50402),(127,'P.S. HUAYCOMA',50402),(128,'P.S. JANINA',50402),(129,'P.S. KUTURI',50402),(130,'P.S. LACAYANI',50402),(131,'P.S. PITANTORA',50402),(132,'P.S. RODEO',50402),(133,'P.S. TOMOYO',50402),(134,'P.S. YUCURI',50402),(135,'P.S. YURUBAMBA',50402),(136,'C.S. CHAQUILLA',51203),(137,'C.S. PORCO',51203),(138,'P.S. CARMA',51203),(139,'C.S. YURA',51202),(140,'P.S. CALAZAYA',51202),(141,'P.S. CARLOS MACHICADO',51202),(142,'P.S. KORKA',51202),(143,'P.S. PAJCHA',51202),(144,'P.S. TACORA',51202),(145,'P.S. TARANA',51202),(146,'P.S. TAURO',51202),(147,'P.S. TICA TICA',51202),(148,'P.S. TOLAPAMPA - POTOSI',51202),(149,'P.S. TOMAVE',51202),(150,'\"P.S. TOTORA  \"\"K\"\"\"',51202),(151,'C.S. RODEO',50303),(152,'C.S. TACOBAMBA',50303),(153,'P.S. CERCA CANCHA',50303),(154,'P.S. CHALLVIRI',50303),(155,'P.S. COLAVI',50303),(156,'P.S. HUERTAMAYU',50303),(157,'P.S. MIGMA',50303),(158,'C.S. BELEN DE URMIRI',50104),(159,'P.S. PUITUCO',50104),(160,'P.S. VACUYO',50104),(161,'C.S. AZANGARO',50101),(162,'C.S. C.I.E.S.',50101),(163,'C.S. CAJA PETROLERA',50101),(164,'C.S. CANTUMARCA',50101),(165,'C.S. CENTRO DE EMERGENCIAS',50101),(166,'C.S. COSSMIL',50101),(167,'C.S. CRUZ ROJA',50101),(168,'C.S. DISPENSARIO SAN GERARDO',50101),(169,'C.S. EMERGENCIA (SEDES)',50101),(170,'C.S. HUARI HUARI',50101),(171,'C.S. LAS DELICIAS',50101),(172,'C.S. PAILAVIRI',50101),(173,'C.S. PARY ORKO',50101),(174,'C.S. PENAL DE CANTUMARCA',50101),(175,'C.S. PLAN 40',50101),(176,'C.S. POTOSI',50101),(177,'C.S. SAGRADA FAMILIA',50101),(178,'C.S. SAN BENITO',50101),(179,'C.S. SAN CRISTOBAL',50101),(180,'C.S. SAN GERARDO',50101),(181,'C.S. SAN PEDRO',50101),(182,'C.S. SAN ROQUE',50101),(183,'C.S. SENAC',50101),(184,'C.S. VILLA COLON',50101),(185,'C.S. VILLA VENEZUELA',50101),(186,'HOSP. BOL-CUBA SAN CRISTOBAL',50101),(187,'HOSP. D. BRACAMONTE',50101),(188,'HOSP. N.I.S. DE CONCEPCION',50101),(189,'HOSP. OBRERO # 5 CNS',50101),(190,'HOSP. S.S. UNIVERSITARIO',50101),(191,'P.S. CHAQUILLA ALTA',50101),(192,'P.S. CHULLCHUCANI',50101),(193,'P.S. SANTIAGO DE OCKORURO',50101),(194,'P.S. TARAPAYA',50101),(195,'C.S. TINGUIPAYA',50102),(196,'P.S. ACTARA',50102),(197,'P.S. ANTHURA',50102),(198,'P.S. CAIMOMA',50102),(199,'P.S. CALLPA PAMPA',50102),(200,'P.S. CHALLA MAYU',50102),(201,'P.S. CIENEGOMA',50102),(202,'P.S. JAHUACAYA',50102),(203,'P.S. KELLU CANCHA',50102),(204,'P.S. MUITA',50102),(205,'P.S. PUJYU PAMPA',50102),(206,'P.S. PUKA PUNTA',50102),(207,'P.S. SAYACA',50102),(208,'P.S. SIHUAYO',50102),(209,'P.S. TALULA',50102),(210,'P.S. TUISURI',50102),(211,'C.S. YOCALLA',50103),(212,'P.S. CAYARA',50103),(213,'P.S. CHIRACORO',50103),(214,'P.S. TOTORA D',50103),(215,'P.S. TURQUI',50103),(216,'P.S. YURAC CKASA',50103),(217,'C.S. CAIZA D',51102),(218,'C.S. CUCHU INGENIO',51102),(219,'C.S. TRES CRUCES',51102),(220,'P.S. ALCATUYO',51102),(221,'P.S. CALTAPI PUNKU',51102),(222,'P.S. CHILLMA',51102),(223,'P.S. FRAGUA',51102),(224,'P.S. HORNOS',51102),(225,'P.S. HUICHACA',51102),(226,'P.S. LA LAVA',51102),(227,'P.S. PANCOCHI',51102),(228,'P.S. TUCTAPARI',51102),(229,'C.S. CALAPAYA',51101),(230,'C.S. CHECCHI',51101),(231,'C.S. CHINOLI',51101),(232,'C.S. CKOCHAS',51101),(233,'C.S. KELUYO',51101),(234,'C.S. KEPALLO',51101),(235,'C.S. OTAVI',51101),(236,'C.S. PACASI',51101),(237,'C.S. PUNA',51101),(238,'C.S. TURUCHIPA',51101),(239,'P.S. AUCAPAMPA',51101),(240,'P.S. CAPAÃ±A',51101),(241,'P.S. CARPA HUATA',51101),(242,'P.S. ESMERALDA ALTA',51101),(243,'P.S. HUATINA',51101),(244,'P.S. HUAYLLAJARA',51101),(245,'P.S. LAJAS',51101),(246,'P.S. MEDIA LUNA',51101),(247,'P.S. MELENA ALTA',51101),(248,'P.S. MICULPAYA',51101),(249,'P.S. MOLLES',51101),(250,'P.S. ORONKOTA',51101),(251,'P.S. SAN LORENZO - PUNA',51101),(252,'P.S. SAN PEDRO DE ESQUIRI',51101),(253,'P.S. SEOCOCHI',51101),(254,'P.S. SEPULTURAS - POTOSI',51101),(255,'P.S. SUQUICHA',51101),(256,'P.S. TOCLA (PUNA)',51101),(257,'P.S. TOMBILLO',51101),(258,'P.S. TOMOLA',51101),(259,'P.S. TURQUIÃ±A',51101),(260,'P.S. UYUNI (PUNA)',51101),(261,'P.S. VILACAYA',51101),(262,'P.S. YASCAPI',51101),(263,'P.S. Ã±UQUI',51101),(264,'C.S. CARIPUYO',50702),(265,'C.S. JANKO JANKO',50702),(266,'P.S. CHOJLLA',50702),(267,'P.S. HUANACOMA',50702),(268,'P.S. HUAÃ±ACHACA',50702),(269,'P.S. LACAYA',50702),(270,'C.S. COLLOMA',50701),(271,'C.S. MALLCUCHAPI',50701),(272,'C.S. SACACA',50701),(273,'C.S. SAKANI',50701),(274,'P.S. HUARAYA',50701),(275,'P.S. JANKARACHI',50701),(276,'P.S. LAYUPAMPA',50701),(277,'P.S. PICHUYA',50701),(278,'P.S. SILLU SILLU',50701),(279,'P.S. TARHUACHAPI',50701),(280,'C.S. CHIRO K´ASA',50501),(281,'C.S. MICANI',50501),(282,'C.S. SAN PEDRO DE B.V.',50501),(283,'P.S. COCHUBAMDURIRI',50501),(284,'P.S. ESQUENCACHI',50501),(285,'P.S. MOSCARI',50501),(286,'P.S. PAIRUMANI',50501),(287,'P.S. QUINAMARA',50501),(288,'P.S. SAN MARCOS',50501),(289,'P.S. SURAGUA',50501),(290,'P.S. TORACARI',50501),(291,'C.S. JULO',50502),(292,'C.S. TORO TORO',50502),(293,'C.S. YAMBATA',50502),(294,'P.S. AÃ±AHUANI',50502),(295,'P.S. CARASI',50502),(296,'P.S. PALLA PALLA',50502),(297,'P.S. POCOSUCO',50502),(298,'P.S. TAMBO K´ASA',50502),(299,'C.S. ACACIO',51302),(300,'P.S. CHURITACA',51302),(301,'P.S. KIRUSILLANI',51302),(302,'P.S. PIRIQUINA',51302),(303,'P.S. TORNO K`ASA',51302),(304,'P.S. TOTOROMA',51302),(305,'C.S. ARAMPAMPA',51301),(306,'P.S. ASANQUIRI',51301),(307,'P.S. KOARACA',51301),(308,'P.S. SANTIAGO',51301),(309,'P.S. SARCURI',51301),(310,'C.S. ANIMAS',50802),(311,'C.S. ATOCHA',50802),(312,'C.S. CHOROLQUE',50802),(313,'C.S. SANTA BARBARA',50802),(314,'C.S. SIETE SUYOS',50802),(315,'C.S. TATASI',50802),(316,'HOSP. OBRERO 13',50802),(317,'P.S. COTANI',50802),(318,'P.S. GUADALUPE ATOCHA',50802),(319,'P.S. SAN VICENTE',50802),(320,'P.S. TATASI B',50802),(321,'P.S. TELAMAYU',50802),(322,'C.S. CHILCOBIJA',50801),(323,'C.S. CHUQUIAGO',50801),(324,'C.S. COSSMIL',50801),(325,'C.S. ESMORACA',50801),(326,'C.S. ESTARCA',50801),(327,'C.S. OPLOCA',50801),(328,'C.S. POLICONSULTORIO NRO. 37',50801),(329,'C.S. RIO BLANCO',50801),(330,'C.S. SAN ANTONIO (TUPIZA)',50801),(331,'C.S. SAN GERARDO',50801),(332,'C.S. SENAC - TUPIZA',50801),(333,'C.S. SUD',50801),(334,'C.S. SUIPACHA',50801),(335,'C.S. TALINA',50801),(336,'C.S. TUPIZA',50801),(337,'C.S. VILLA FATIMA',50801),(338,'C.S. VILLA PACHECO',50801),(339,'HOSP. EDUARDO EGUÍA',50801),(340,'P.S. ALTO MAMAHOTA',50801),(341,'P.S. CHACOPAMPA',50801),(342,'P.S. HUMACHA',50801),(343,'P.S. KENKO',50801),(344,'P.S. MOLINO',50801),(345,'P.S. NAZARENO',50801),(346,'P.S. OPLOCA',50801),(347,'P.S. ORO INGENIO',50801),(348,'P.S. PALQUIZA',50801),(349,'P.S. PEÃ±A AMARILLA',50801),(350,'P.S. PIEDRAS BLANCAS',50801),(351,'P.S. QUIRIZA',50801),(352,'P.S. REYNECILLAS',50801),(353,'P.S. SALO',50801),(354,'P.S. SAN JOSE PAMPA GRANDE',50801),(355,'P.S. SAN MIGUEL',50801),(356,'P.S. SUPIRA',50801),(357,'P.S. TAMBO',50801),(358,'P.S. TAPAXA',50801),(359,'P.S. TOCLOCA',50801),(360,'P.S. VISCACHANI',50801),(361,'P.S. ZAPATERA',50801),(362,'C.S. MOJINETE',51002),(363,'P.S. CASA GRANDE',51002),(364,'P.S. LA CIENEGA',51002),(365,'C.S. SAN ANTONIO DE ESMORUCO',51003),(366,'P.S. GUADALUPE (SAN ANTONIO)',51003),(367,'P.S. RIO MOJON',51003),(368,'P.S. RIO SECO',51003),(369,'C.S. SAN PABLO DE LIPEZ',51001),(370,'P.S. CERRILLOS',51001),(371,'P.S. POLULOS',51001),(372,'P.S. QUETENA CHICO',51001),(373,'P.S. QUETENA GRANDE',51001),(374,'P.S. RELAVE',51001),(375,'P.S. RIO SAN PABLO',51001),(376,'P.S. SAN ANTONIO DE LIPEZ',51001),(377,'P.S. SANTA ISABEL',51001),(378,'P.S. VILUYO',51001),(379,'C.S. CHAYANTA',50202),(380,'C.S. IRUPATA',50202),(381,'C.S. PANACACHI',50202),(382,'P.S. AMAYAPAMPA',50202),(383,'P.S. AYMAYA',50202),(384,'P.S. CHAYANTA CALA CALA',50202),(385,'P.S. CNS  AMAYAPAMPA',50202),(386,'P.S. CNS CHAYANTA',50202),(387,'P.S. COATACA',50202),(388,'P.S. ENTRE RIOS (CHAYANTA)',50202),(389,'P.S. KEWAYLLUNI',50202),(390,'P.S. KOPANA',50202),(391,'P.S. QUINTA PAMPA',50202),(392,'C.S. CATAVI',50203),(393,'C.S. CNS POLICLINICO LLALLAGUA',50203),(394,'C.S. MADRE OBRERA',50203),(395,'C.S. SIGLO XX',50203),(396,'HOSP. MADRE OBRERA (LLALLAGUA)',50203),(397,'P.S. CAMANI',50203),(398,'P.S. CAPUNITA',50203),(399,'P.S. CNS  CATAVI',50203),(400,'P.S. JACHOJO',50203),(401,'P.S. SAUTA',50203),(402,'P.S. UYUNI',50203),(403,'C.S. CALA CALA',50201),(404,'C.S. CHUQUIUTA',50201),(405,'C.S. MOROCOMARCA',50201),(406,'C.S. PATA PATA GRANDE',50201),(407,'C.S. UNCIA',50201),(408,'HOSP. OBRERO Nº11 UNCIA',50201),(409,'P.S. ARANIPAMPA',50201),(410,'P.S. CNS CHUQUIUTA',50201),(411,'P.S. MERKAYMAYA',50201),(412,'P.S. MIKANI',50201),(413,'C.S. COROMA',51201),(414,'C.S. PULACAYO C.N.S.',51201),(415,'C.S. RIO MULATO',51201),(416,'C.S. UYUNI',51201),(417,'HOSP. OBRERO C.N.S.',51201),(418,'P.S. ALPACANI-QUEHUA',51201),(419,'P.S. BELLA VISTA - UYUNI',51201),(420,'P.S. CANDELARIA DE VILUYO',51201),(421,'P.S. CERDAS',51201),(422,'P.S. COLCHANI',51201),(423,'P.S. POLICLINICO UYUNI C.N.S.',51201),(424,'P.S. PULACAYO',51201),(425,'P.S. TUSQUI',51201),(426,'C.S. LLICA',51401),(427,'P.S. BELLA  VISTA',51401),(428,'P.S. CHACOMA - POTOSI',51401),(429,'P.S. HUANAQUE',51401),(430,'P.S. LLICA C.N.S.',51401),(431,'P.S. PALAYA',51401),(432,'P.S. SEJCIHUA',51401),(433,'P.S. TRES CRUCES',51401),(434,'P.S. VILLA AROMA',51401),(435,'C.S. TAHUA',51402),(436,'P.S. CAQUENA',51402),(437,'P.S. YONZA',51402),(438,'C.S. SAN AGUSTIN',51601),(439,'P.S. ALOTA',51601),(440,'P.S. TODO- SANTOS',51601),(441,'\"C.S. COLCHA \"\"K\"\"\"',50901),(442,'C.S. SAN CRISTOBAL',50901),(443,'C.S. SAN JUAN - POTOSI',50901),(444,'\"P.S. CALCHA \"\"K\"\"\"',50901),(445,'P.S. COCANI',50901),(446,'\"P.S. COLCHA \"\"K\"\" C.N.S.\"',50901),(447,'P.S. COPACABANA',50901),(448,'\"P.S. CULPINA \"\"K\"\"\"',50901),(449,'P.S. POZO CABADO',50901),(450,'P.S. RIO GRANDE',50901),(451,'\"P.S. SANTIAGO \"\"K\"\"\"',50901),(452,'P.S. SANTIAGO DE AGENCHA',50901),(453,'P.S. VILLA MAR',50901),(454,'P.S. ZONIQUERA',50901),(455,'P.S. SAN PEDRO DE QUEMES',50902),(456,'C.S. C.N.S. POLICLINICO 5',51501),(457,'C.S. CHAGUA',51501),(458,'C.S. CHOSCONTY',51501),(459,'C.S. ELIODORO VILLAZON',51501),(460,'C.S. MOJO',51501),(461,'C.S. SAN JUAN DE DIOS',51501),(462,'C.S. SAN JUDAS TADEO',51501),(463,'C.S. SAN MARTIN',51501),(464,'HOSP. SAN ROQUE',51501),(465,'P.S. BERQUE',51501),(466,'P.S. CASIRA',51501),(467,'P.S. CHIPIHUAYCO',51501),(468,'P.S. HIGUERAS',51501),(469,'P.S. MORAYA',51501),(470,'P.S. SAGNASTY',51501),(471,'P.S. SELOCHA',51501),(472,'P.S. SOCOCHA',51501),(473,'P.S. YURUMA',51501);
/*!40000 ALTER TABLE `establecimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `jefatura` varchar(200) DEFAULT NULL,
  `unidad` varchar(200) DEFAULT NULL,
  `color` varchar(7) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Hola mundo','JEFATURA DE GESTION DE CALIDAD Y AUDITORIA EN SALUD','UNIDAD HABILITACION ESTABLECIMIENTOS DE SALUD','#000','2017-04-24 00:00:00','2017-04-25 00:00:00'),(3,'REALIZAR UNA FERIA','JEFATURA ADMINISTRATIVA Y FINANCIERA','UNIDAD FINANCIERA','#FF0000','2017-04-10 00:00:00','2017-04-11 00:00:00'),(4,'FORTALESIMIENTO INSTITUCIONAL','JEFATURA DE PLANIFICACION Y PROYECTOS','UNIDAD DE PLANIFICACION','#008000','2017-04-04 00:00:00','2017-04-07 00:00:00');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `informe`
--

DROP TABLE IF EXISTS `informe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `informe` (
  `id_i` int(11) NOT NULL AUTO_INCREMENT,
  `id_us` int(11) DEFAULT NULL,
  `nombre` varchar(70) DEFAULT NULL,
  `apellido` varchar(70) DEFAULT NULL,
  `cargo` varchar(70) DEFAULT NULL,
  `jefatura` varchar(100) DEFAULT NULL,
  `unidad` varchar(100) DEFAULT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `fecha_ela` date DEFAULT NULL,
  `fecha_p` date DEFAULT NULL,
  `objetivo` varchar(200) DEFAULT NULL,
  `actividades` varchar(200) DEFAULT NULL,
  `resultados` varchar(200) DEFAULT NULL,
  `fecha_e` date DEFAULT NULL,
  `fecha_c` date DEFAULT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_i`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `informe`
--

LOCK TABLES `informe` WRITE;
/*!40000 ALTER TABLE `informe` DISABLE KEYS */;
INSERT INTO `informe` VALUES (1,4,'MIKI','THENIER','INGENIERO DE SISTEMAS','JEFATURA DE REDES DE SERVICIO DE SALUD','UNIDAD HABILITACION ESTABLECIMIENTOS DE SALUD','CALLE NOGALES NÂº 666','2017-04-25','2017-04-26','LOGRAR MEJORAS EN LA SALUD','REALIZAR UNA FERIA EN SAN PEDRO','VENEFICIAR A FAMILIAS','2017-04-27','2017-04-28','NINGUNA'),(2,4,'MIKI','THENIER','INGENIERO DE SISTEMAS','JEFATURA DE GESTION DE CALIDAD Y AUDITORIA EN SALUD','UNIDAD HABILITACION ESTABLECIMIENTOS DE SALUD','CALLE NOGALES NÂº 666','2017-04-25','2017-04-26','TTT','YYY','UUU','2017-04-27','2017-04-28','OOO'),(3,4,'MIKI','THENIER','INGENIERO DE SISTEMAS','JEFATURA DE PLANIFICACION Y PROYECTOS','UNIDAD DE  PLANIFICACION','CALLE NOGALES NÂº 666','2017-05-02','2017-05-03','REUNION TECNICA CON RESPONSABLES DE JEFATURAS DEL SEDES POTOSI','ElaboraciÃ³n de cronograma de actividades de jefaturas y unidades.','Mejorar la coordinaciÃ³n de actividades de cada jefatura y unidad en las CRSS y RSSM del departamento','2017-05-17','2017-05-25','NINGUNA'),(4,4,'MIKI','THENIER','INGENIERO DE SISTEMAS','JEFATURA ADMINISTRATIVA Y FINANCIERA','UNIDAD HABILITACION ESTABLECIMIENTOS DE SALUD','CALLE NOGALES NÂº 666','2017-05-02','2017-05-03','REUNION TECNICA CON RESPONSABLES DE JEFATURAS DEL SEDES POTOSI','ElaboraciÃ³n de cronograma de actividades de jefaturas y unidades','Mejorar la coordinaciÃ³n de actividades de cada jefatura y unidad en las CRSS y RSSM del departamento.','2017-05-10','2017-05-18','NINGUNA'),(5,4,'MIKI','THENIER','INGENIERO DE SISTEMAS','JEFATURA DE PLANIFICACION Y PROYECTOS','UNIDAD HABILITACION ESTABLECIMIENTOS DE SALUD','CALLE NOGALES NÂº 666','2017-04-19','2017-04-20','REUNION TECNICA CON RESPONSABLES DE JEFATURAS DEL SEDES POTOSI','ElaboraciÃ³n de cronograma de actividades de jefaturas y unidades.','Mejorar la coordinaciÃ³n de actividades de cada jefatura y unidad en las CRSS y RSSM del departamento.','2017-04-26','2017-04-27','NINGUNA'),(6,4,'MIKI','THENIER','INGENIERO DE SISTEMAS','JEFATURA DE PLANIFICACION Y PROYECTOS','UNIDAD DE PLANIFICACION','CALLE NOGALES NÂº 666','2017-04-24','2017-04-25','FORTALECIMIENTO INSTITUCIONAL','RevisiÃ³n de hojas de ruta  que ingresen a la Jefatura de planificaciÃ³n ','Hojas de ruta respondidas informes elaborados.','2017-04-27','2017-04-28','NINGUNA');
/*!40000 ALTER TABLE `informe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jefatura`
--

DROP TABLE IF EXISTS `jefatura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jefatura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jefatura`
--

LOCK TABLES `jefatura` WRITE;
/*!40000 ALTER TABLE `jefatura` DISABLE KEYS */;
INSERT INTO `jefatura` VALUES (1,'JEFATURA DE GESTION DE CALIDAD Y AUDITORIA EN SALUD',''),(2,'JEFATURA DE REDES DE SERVICIO DE SALUD',''),(3,'JEFATURA DE EPIDEMIOLOGIA E INVESTIGACION',''),(4,'JEFATURA DE SEGUROS DE SALUD',''),(5,'JEFATURA PROMOCION DE LA SALUD',''),(6,'JEFATURA DE PLANIFICACION Y PROYECTOS',''),(7,'JEFATURA MEDICINA TRADICIONAL',''),(8,'JEFATURA ADMINISTRATIVA Y FINANCIERA',''),(9,'mi propia jeaftura','\0'),(10,'Mi Propia Jeafturas','\0');
/*!40000 ALTER TABLE `jefatura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `municipio`
--

DROP TABLE IF EXISTS `municipio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `municipio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_redsalud` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_redsalud_idx` (`id_redsalud`),
  CONSTRAINT `id_redsalud` FOREIGN KEY (`id_redsalud`) REFERENCES `redsalud` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=51602 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `municipio`
--

LOCK TABLES `municipio` WRITE;
/*!40000 ALTER TABLE `municipio` DISABLE KEYS */;
INSERT INTO `municipio` VALUES (50101,'SecciÃ³n Capital - PotosÃ­',4),(50102,'Primera SecciÃ³n - Tinquipaya',11),(50103,'Segunda SecciÃ³n -Yocalla',11),(50104,'Tercera SecciÃ³n -Urmiri',11),(50201,'Primera SecciÃ³n -UncÃ­a',8),(50202,'Segunda SecciÃ³n -Chayanta',8),(50203,'Tercera SecciÃ³n -Llallagua',8),(50301,'Primera SecciÃ³n -Betanzos',1),(50302,'Segunda SecciÃ³n -ChaquÃ­',1),(50303,'Tercera SeccÃ³n -Tacobamba',4),(50401,'Primera SecciÃ³n -Colquechaca',3),(50402,'Segunda SecciÃ³n -Ravelo',3),(50403,'Tercera SecciÃ³n -Pocoata',3),(50404,'Cuarta SecciÃ³n -OcurÃ­',3),(50501,'Primera SecciÃ³n -San Pedro de Buena Vista',6),(50502,'Segunda SecciÃ³n -Toro Toro',6),(50601,'Primera SecciÃ³n -Cotagaita',2),(50602,'Segunda SecciÃ³n -Vitichi',2),(50701,'Primera SecciÃ³n -Villa de Sacaca',6),(50702,'Segunda SecciÃ³n -Caripuyo',6),(50801,'Primera SecciÃ³n -Tupiza',7),(50802,'Segunda SecciÃ³n -Atocha',7),(50901,'Primera SecciÃ³n -Colcha \"K\"',9),(50902,'Segunda SecciÃ³n -San Pedro de Quemes',9),(51001,'Primera SecciÃ³n -San Pablo de LÃ­pez',7),(51002,'Segunda SecciÃ³n -Mojinete',7),(51003,'Tercera SecciÃ³n -San Antonio de Esmoruco',7),(51101,'Primera SecciÃ³n -Puna',5),(51102,'Segunda SecciÃ³n -Caiza \"D\"',5),(51201,'Primera SecciÃ³n -Uyuni',9),(51202,'Segunda SecciÃ³n -Tomave',4),(51203,'Tercera SecciÃ³n -Porco',4),(51301,'Primera SecciÃ³n -Arampampa',6),(51302,'Segunda SecciÃ³n -Acasio',6),(51401,'Primera SecciÃ³n -Llica',9),(51402,'Segunda SeccÃ³n -Tahua',9),(51501,'Primera SecciÃ³n -VillazÃ³n',10),(51601,'Primera SecciÃ³n -San AgustÃ­n',9);
/*!40000 ALTER TABLE `municipio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `otra_actividad`
--

DROP TABLE IF EXISTS `otra_actividad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `otra_actividad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `otra_actividad`
--

LOCK TABLES `otra_actividad` WRITE;
/*!40000 ALTER TABLE `otra_actividad` DISABLE KEYS */;
INSERT INTO `otra_actividad` VALUES (1,'Taller'),(2,'Capacitacion'),(3,'Supervicion'),(4,'Cursos'),(5,'Proyectos');
/*!40000 ALTER TABLE `otra_actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `otra_planificacion`
--

DROP TABLE IF EXISTS `otra_planificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `otra_planificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_establecimiento` int(11) DEFAULT NULL,
  `tipo_actividad` varchar(6) CHARACTER SET latin1 NOT NULL,
  `tipo_lugar` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `ciudad` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `id_otra_actividad` int(11) NOT NULL,
  `lugar` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `fecha_de` date NOT NULL,
  `fecha_hasta` date NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_otra_actividad_idx` (`id_otra_actividad`),
  KEY `idusuario_idx` (`id_usuario`),
  CONSTRAINT `id_otra_actividad` FOREIGN KEY (`id_otra_actividad`) REFERENCES `otra_actividad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idusuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `otra_planificacion`
--

LOCK TABLES `otra_planificacion` WRITE;
/*!40000 ALTER TABLE `otra_planificacion` DISABLE KEYS */;
INSERT INTO `otra_planificacion` VALUES (1,32,0,'local','','',5,'ejemplo de planificacion local','2018-07-27','2018-08-27',0),(2,32,0,'viaje','departamental','pando',1,'ejemplo de viaje a ciudad','2018-08-27','2018-08-27',0),(3,32,212,'viaje','provincial','potosi',1,'prueba de viaje provincial','2018-08-27','2018-08-27',0);
/*!40000 ALTER TABLE `otra_planificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planificacion`
--

DROP TABLE IF EXISTS `planificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `planificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_actividad` int(5) NOT NULL,
  `fecha_de` date NOT NULL,
  `fecha_hasta` date NOT NULL,
  `objetivo` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `esperado` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `vista_unidad` tinyint(1) NOT NULL DEFAULT '0',
  `vista_jefatura` tinyint(1) NOT NULL DEFAULT '0',
  `vista_planificador` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_elaboracion` date NOT NULL,
  `fecha_presentacion` date DEFAULT NULL,
  `observacion` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_usuario_idx` (`id_usuario`),
  KEY `id_actividad_planificacion_idx` (`id_actividad`),
  CONSTRAINT `id_actividad_planificacion` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planificacion`
--

LOCK TABLES `planificacion` WRITE;
/*!40000 ALTER TABLE `planificacion` DISABLE KEYS */;
INSERT INTO `planificacion` VALUES (1,32,9,'2018-08-20','2018-08-20','los objetivos trazados|un objetivo de editar|','desinfectar virus|resultado de editar|',1,1,1,'2018-08-20','2018-09-05','se concluyo con exito',1),(2,32,9,'2018-08-20','2018-08-20','separando con lineas|los objetivos trazados|','separando con linea|los resultados esperando|',1,1,1,'2018-08-20','2018-09-05','se concluyo con exito',1),(3,32,9,'2018-08-22','2018-08-23','nuevo objetivo de computadoras|','un resultado de nuevo|',1,1,1,'2018-08-20','2018-09-05','se concluyo con exito',1),(4,32,9,'2018-09-05','2018-09-07','desarrollo de un sitio web|ponerla en produccion|','sitio web concluido|sitio web en la web|',0,0,0,'2018-09-04','2018-09-06',NULL,0),(5,32,2,'2018-09-06','2018-09-06','obetivos para validar|','rsultados para validar|',1,1,1,'2018-09-06','2018-09-06','observacion se completo satisfactoriamente',1);
/*!40000 ALTER TABLE `planificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planificacion_anual`
--

DROP TABLE IF EXISTS `planificacion_anual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `planificacion_anual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_planificacion_idx` (`id_usuario`),
  KEY `id_actividad_idx` (`id_actividad`),
  KEY `id_actividad` (`id_actividad`),
  CONSTRAINT `id_actividad_anual` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_usuario_anual` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planificacion_anual`
--

LOCK TABLES `planificacion_anual` WRITE;
/*!40000 ALTER TABLE `planificacion_anual` DISABLE KEYS */;
INSERT INTO `planificacion_anual` VALUES (1,32,9,2018,1),(2,32,2,2018,0),(3,32,8,2018,0);
/*!40000 ALTER TABLE `planificacion_anual` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `redsalud`
--

DROP TABLE IF EXISTS `redsalud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `redsalud` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `redsalud`
--

LOCK TABLES `redsalud` WRITE;
/*!40000 ALTER TABLE `redsalud` DISABLE KEYS */;
INSERT INTO `redsalud` VALUES (1,'BETANZOS'),(2,'COTAGAITA'),(3,'OCURI'),(4,'POTOSI (URBANO)'),(5,'PUNA'),(6,'SACACA'),(7,'TUPIZA'),(8,'UNCIA'),(9,'UYUNI'),(10,'VILLAZON'),(11,'POTOSI (RURAL)');
/*!40000 ALTER TABLE `redsalud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reporte`
--

DROP TABLE IF EXISTS `reporte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reporte` (
  `id_r` int(11) NOT NULL AUTO_INCREMENT,
  `id_u` int(11) DEFAULT NULL,
  `nombre` varchar(70) DEFAULT NULL,
  `apellido` varchar(70) DEFAULT NULL,
  `cargo` varchar(70) DEFAULT NULL,
  `jefatura` varchar(100) DEFAULT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `fecha_ela` date DEFAULT NULL,
  `fecha_p` date DEFAULT NULL,
  `objetivo` varchar(200) DEFAULT NULL,
  `actividades` varchar(200) DEFAULT NULL,
  `resultados` varchar(200) DEFAULT NULL,
  `fecha_e` date DEFAULT NULL,
  `fecha_c` date DEFAULT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  `mes` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_r`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reporte`
--

LOCK TABLES `reporte` WRITE;
/*!40000 ALTER TABLE `reporte` DISABLE KEYS */;
INSERT INTO `reporte` VALUES (1,4,'MIKI','THENIER','INGENIERO DE SISTEMAS','JEFATURA DE GESTION DE CALIDAD Y AUDITORIA EN SALUD','CALLE NOGALES NÂº 666','2017-04-25','2017-04-26','LOGRAR MEJORAS EN LA SALUD DE  POTOSI','REALIZAR UNA FERIA EN SAN PEDRO','VENEFICIAR A FAMILIAS','2017-04-27','2017-04-28','NINGUNA','4'),(2,4,'MIKI','THENIER','INGENIERO DE SISTEMAS','JEFATURA ADMINISTRATIVA Y FINANCIERA','CALLE NOGALES NÂº 666','2017-05-02','2017-05-03','REUNION TECNICA CON RESPONSABLES DE JEFATURAS DEL SEDES POTOSI','ElaboraciÃ³n de cronograma de actividades de jefaturas y unidades','Mejorar la coordinaciÃ³n de actividades de cada jefatura y unidad en las CRSS y RSSM del departamento.','2017-05-10','2017-05-18','NINGUNA','5'),(3,4,'MIKI','THENIER','INGENIERO DE SISTEMAS','JEFATURA DE PLANIFICACION Y PROYECTOS','CALLE NOGALES NÂº 666','2017-04-19','2017-04-20','REUNION TECNICA CON RESPONSABLES DE JEFATURAS DEL SEDES POTOSI','ElaboraciÃ³n de cronograma de actividades de jefaturas y unidades.','Mejorar la coordinaciÃ³n de actividades de cada jefatura y unidad en las CRSS y RSSM del departamento.','2017-04-26','2017-04-27','NINGUNA','4');
/*!40000 ALTER TABLE `reporte` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reporte_u`
--

DROP TABLE IF EXISTS `reporte_u`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reporte_u` (
  `id_re` int(11) NOT NULL AUTO_INCREMENT,
  `id_un` int(11) DEFAULT NULL,
  `nombre_u` varchar(70) DEFAULT NULL,
  `apellido` varchar(70) DEFAULT NULL,
  `cargo` varchar(70) DEFAULT NULL,
  `jefatura` varchar(100) DEFAULT NULL,
  `unidad` varchar(100) DEFAULT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `fecha_ela` date DEFAULT NULL,
  `fecha_p` date DEFAULT NULL,
  `objetivo` varchar(200) DEFAULT NULL,
  `actividades` varchar(200) DEFAULT NULL,
  `resultados` varchar(200) DEFAULT NULL,
  `fecha_e` date DEFAULT NULL,
  `fecha_c` date DEFAULT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  `mes` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_re`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reporte_u`
--

LOCK TABLES `reporte_u` WRITE;
/*!40000 ALTER TABLE `reporte_u` DISABLE KEYS */;
INSERT INTO `reporte_u` VALUES (2,4,'MIKI','THENIER','INGENIERO DE SISTEMAS','JEFATURA DE PLANIFICACION Y PROYECTOS','UNIDAD DE INFORMATICA Y TELECOMUNICACIONES','CALLE NOGALES NÂº 666','2017-05-02','2017-05-03','REUNION TECNICA CON RESPONSABLES DE JEFATURAS DEL SEDES POTOSI','ElaboraciÃ³n de cronograma de actividades de jefaturas y unidades.','Mejorar la coordinaciÃ³n de actividades de cada jefatura y unidad en las CRSS y RSSM del departamento','2017-05-17','2017-05-25','NINGUNA','5'),(3,4,'MIKI','THENIER','INGENIERO DE SISTEMAS','JEFATURA DE GESTION DE CALIDAD Y AUDITORIA EN SALUD','UNIDAD HABILITACION ESTABLECIMIENTOS DE SALUD','CALLE NOGALES NÂº 666','2017-04-24','2017-04-25','FORTALECIMIENTO INSTITUCIONAL DE SEDES POTOSI','RevisiÃ³n de hojas de ruta  que ingresen a la Jefatura de planificaciÃ³n ','Hojas de ruta respondidas informes elaborados.','2017-04-27','2017-04-28','NINGUNA','4');
/*!40000 ALTER TABLE `reporte_u` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidad`
--

DROP TABLE IF EXISTS `unidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `id_jefatura` int(11) NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `id_jefatura_idx` (`id_jefatura`),
  CONSTRAINT `id_jefatura` FOREIGN KEY (`id_jefatura`) REFERENCES `jefatura` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidad`
--

LOCK TABLES `unidad` WRITE;
/*!40000 ALTER TABLE `unidad` DISABLE KEYS */;
INSERT INTO `unidad` VALUES (1,'UNIDAD HABILITACION ESTABLECIMIENTOS DE SALUD',1,''),(2,'UNIDAD DE ACREDITACION DE ESTABLECIMIENTOS DE SALUD',1,''),(3,'UNIDAD DE AUDITORIA EN SALUD',1,''),(4,'UNIDAD DE ATENCION INTEGRAL A LA MUJER SSR',2,''),(5,'UNIDAD SALUD MENTAL ESCOLAR Y ADOLESCENTES',2,''),(6,'UNIDAD DE LABORATORIOS',2,''),(7,'UNIDAD DE FARMACIA Y SUMINISTROS',2,''),(8,'UNIDAD DE SALUD ORAL',2,''),(9,'UNIDAD DE EMERGENCIAS',2,''),(10,' UNIDAD DE ATENCION INTEGRAL',2,''),(11,'UNIDAD DE GESTION HOSPITALES DE II Y III NIVEL',2,''),(12,' UNIDAD DE RED DE ENLACE',3,''),(13,'UNIDAD ENFERMEDADES NO TRANSMISIBLES',3,''),(14,'UNIDAD DE TUBERCULOSIS',3,''),(15,'UNIDAD DE CONTROL DE VECTORES',3,''),(16,'UNIDAD PAI',3,''),(17,'UNIDAD DE SALUD AMBIENTAL',3,''),(18,'UNIDAD ITS VIH-SIDA',3,''),(19,'UNIDAD DE ENFERMEDADES EMERGENTES Y REMERGENTES\n',3,''),(20,'UNIDAD DE LABORATORIO VIGILANCIA EPIDEMIOLOGICA',3,''),(21,'JEFATURA DE SEGUROS SALUD',4,''),(22,'UNIDAD DE DISCAPACIDAD',5,''),(23,'UNIDAD DE EDUCACION PARA LA VIDA',5,''),(24,'UNIDAD DEL BUEN TRATO Y GENERO',5,''),(25,'UNIDAD DE ALIMENTACION Y NUTRICION',5,''),(26,'UNIDAD DE SALUD COMUNITARIA Y MOVILIZACION SOCIAL',5,''),(27,'PROGRAMA MI SALUD',5,''),(28,'PROGRAMA BONO JUANA AZURDUY',5,''),(29,'UNIDAD DE PLANIFICACION',6,''),(31,'UNIDAD DE PROYECTOS',6,''),(32,'UNIDAD SNIS-VE',6,''),(33,'UNIDAD DE INFORMATICA Y TELECOMUNICACIONES',6,''),(34,'UNIDAD DE CAPACITACION Y ACREDITACION PROFESIONAL',6,''),(35,'JEFATURA MEDICINA TRADICIONAL',7,''),(36,'UNIDAD FINANCIERA',8,''),(37,'UNIDAD ADMINISTRATIVA',8,''),(38,'UNIDAD DE RECURSOS HUMANOS',8,''),(39,'UNIDAD DE CONTRATACIONES',8,''),(40,'UNIDAD MANTENIMIENTO SEDES POTOSI',8,''),(41,'mi propia unidad',9,''),(42,'mi propia unidad de alado',10,'\0');
/*!40000 ALTER TABLE `unidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ci` int(9) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `id_cargo` int(3) NOT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `id_lugar` int(3) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tipo` int(1) NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `id_cargo_idx` (`id_cargo`),
  CONSTRAINT `id_cargo` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,8639045,'lizbeth','poquechoque',2,'76100000',0,'$2y$10$d5WrohzkA3FojFln5raEaelgJqwCCeDSkVqF8Mdxu1b0yDmf6rZfe',0,''),(4,0,'mauricio','palomo ari',3,'',0,'$2y$10$d5WrohzkA3FojFln5raEaelgJqwCCeDSkVqF8Mdxu1b0yDmf6rZfe',0,''),(18,5570422,'limbert','arando benavides',2,'',0,'$2y$10$d5WrohzkA3FojFln5raEaelgJqwCCeDSkVqF8Mdxu1b0yDmf6rZfe',2,''),(20,1111111,'rosa','meligado',1,'3342351',0,'$2y$10$d5WrohzkA3FojFln5raEaelgJqwCCeDSkVqF8Mdxu1b0yDmf6rZfe',1,''),(24,7777778,'paola','alejandra',3,'',0,'$2y$10$d5WrohzkA3FojFln5raEaelgJqwCCeDSkVqF8Mdxu1b0yDmf6rZfe',1,''),(25,7777777,'juancito','tortillas',3,'645645654',0,'$2y$10$d5WrohzkA3FojFln5raEaelgJqwCCeDSkVqF8Mdxu1b0yDmf6rZfe',1,''),(26,2222222,'palomillo','parades castro',3,'76179176',0,'$2y$10$d5WrohzkA3FojFln5raEaelgJqwCCeDSkVqF8Mdxu1b0yDmf6rZfe',2,''),(27,3333333,'usuario','prueba jefatura',2,'',1,'$2y$10$d5WrohzkA3FojFln5raEaelgJqwCCeDSkVqF8Mdxu1b0yDmf6rZfe',3,''),(28,1234566,'usuario','prueba admin',2,'',0,'$2y$10$RJezYz7rRYWIQs2qjlfMfeqyPhoNcoBGnPZZOZuue0VpuI/QgmYLe',2,''),(29,4433333,'usuario','prueba jefaturador',1,'',8,'$2y$10$TnZPzF1iqryOEhbIdrKGFeXusa8EVaSLU7ybozma.cnyuDWc9ShM.',5,''),(30,4444444,'prueba','usuario unidad',1,'',2,'$2y$10$xdqMuFPuTrtCysK9ZBGOeO6FjVi7VXVsQ5IhazPqutRZJoOEoS20.',4,''),(31,4321345,'prueba','usuario normal',1,'',3,'$2y$10$k/L2taKE5hl/AguTD7FCUuuHcmeYj6ZBfGXw5qxUA/DkpcqU/Djpy',4,''),(32,5555555,'prueba','usuario sin asignar',2,'',2,'$2y$10$RzL5gBOegE8rJmlifrUTbOgdPeXxnqb4y4GPPKlmNwH7qVSWt.Y52',5,''),(33,3434342,'probando ','otra vez al administrador',2,'',0,'$2y$10$5DgN0TmMMdA6UHSpjmee6O6BIlIJFsUAa0rEpPbVm6Eg51KOckjtK',0,'');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-15 11:24:59
