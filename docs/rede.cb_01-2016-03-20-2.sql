-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: rede.cb_01
-- ------------------------------------------------------
-- Server version	5.7.11-log

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
-- Table structure for table `tenil_endereco`
--

DROP TABLE IF EXISTS `tenil_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tenil_endereco` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_perfil` int(10) unsigned DEFAULT NULL,
  `logradouro` varchar(255) DEFAULT NULL,
  `numero` varchar(5) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `localidade` varchar(255) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `cep` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `perfil_idx` (`id_perfil`),
  CONSTRAINT `perfil` FOREIGN KEY (`id_perfil`) REFERENCES `teniluser_perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tenil_endereco`
--

LOCK TABLES `tenil_endereco` WRITE;
/*!40000 ALTER TABLE `tenil_endereco` DISABLE KEYS */;
INSERT INTO `tenil_endereco` VALUES (1,2,'QSE 7','43','Taguatinga','Taguatinga Sulva','Brasília','DF','72025070');
/*!40000 ALTER TABLE `tenil_endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tenil_telefone`
--

DROP TABLE IF EXISTS `tenil_telefone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tenil_telefone` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_perfil` int(10) unsigned DEFAULT NULL,
  `ddd` varchar(2) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `id_tipo` tinyint(3) unsigned DEFAULT NULL,
  `ramal` varchar(5) DEFAULT NULL,
  `contato` varchar(45) DEFAULT NULL,
  `flag_sms` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `1_idx` (`id_tipo`),
  KEY `2_idx` (`id_perfil`),
  CONSTRAINT `1` FOREIGN KEY (`id_tipo`) REFERENCES `tenil_telefone_tipo` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `pefil` FOREIGN KEY (`id_perfil`) REFERENCES `teniluser_perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tenil_telefone`
--

LOCK TABLES `tenil_telefone` WRITE;
/*!40000 ALTER TABLE `tenil_telefone` DISABLE KEYS */;
INSERT INTO `tenil_telefone` VALUES (1,NULL,'61','654321654',NULL,'','',NULL),(2,NULL,'61','84024282',NULL,'','',NULL),(4,NULL,'45','45464748',NULL,'','',NULL),(5,NULL,'61','123456',NULL,'','',1),(8,15,'21','1212121221',NULL,'1','1212',1),(9,15,'21','123',NULL,'123','123',1),(10,NULL,'61','37024282',NULL,NULL,NULL,1),(11,NULL,'61','3702-4282',NULL,NULL,NULL,1),(12,NULL,'61','33565734',NULL,NULL,NULL,1),(13,NULL,'61','37024282',NULL,NULL,NULL,1),(14,NULL,'61','33565734',NULL,NULL,NULL,1),(15,NULL,'61','84024282',NULL,NULL,NULL,1),(16,NULL,'61','37024282',NULL,NULL,NULL,1),(17,NULL,'61','84024282',NULL,NULL,NULL,1),(18,NULL,'61','33565734',NULL,NULL,NULL,1),(19,NULL,'61','84024282',NULL,NULL,NULL,1),(20,2,'61','33565734',NULL,NULL,NULL,1),(22,2,'61','84024282',NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `tenil_telefone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tenil_telefone_operadora`
--

DROP TABLE IF EXISTS `tenil_telefone_operadora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tenil_telefone_operadora` (
  `id` int(10) unsigned NOT NULL,
  `codigo_operadora_api` int(10) unsigned NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo_operadora_UNIQUE` (`codigo_operadora_api`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tenil_telefone_operadora`
--

LOCK TABLES `tenil_telefone_operadora` WRITE;
/*!40000 ALTER TABLE `tenil_telefone_operadora` DISABLE KEYS */;
/*!40000 ALTER TABLE `tenil_telefone_operadora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tenil_telefone_tipo`
--

DROP TABLE IF EXISTS `tenil_telefone_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tenil_telefone_tipo` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tenil_telefone_tipo`
--

LOCK TABLES `tenil_telefone_tipo` WRITE;
/*!40000 ALTER TABLE `tenil_telefone_tipo` DISABLE KEYS */;
INSERT INTO `tenil_telefone_tipo` VALUES (1,'Residencial'),(2,'Comercial'),(3,'Recado'),(4,'Celular');
/*!40000 ALTER TABLE `tenil_telefone_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tenilacl_privileges`
--

DROP TABLE IF EXISTS `tenilacl_privileges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tenilacl_privileges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  `nome` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `resource_id` (`resource_id`),
  CONSTRAINT `tenilacl_privileges_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tenilacl_roles` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `tenilacl_privileges_ibfk_2` FOREIGN KEY (`resource_id`) REFERENCES `tenilacl_resources` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tenilacl_privileges`
--

LOCK TABLES `tenilacl_privileges` WRITE;
/*!40000 ALTER TABLE `tenilacl_privileges` DISABLE KEYS */;
INSERT INTO `tenilacl_privileges` VALUES (4,1,8,'allow','2015-05-14 09:37:26','2015-05-14 09:37:26');
/*!40000 ALTER TABLE `tenilacl_privileges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tenilacl_resources`
--

DROP TABLE IF EXISTS `tenilacl_resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tenilacl_resources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tenilacl_resources`
--

LOCK TABLES `tenilacl_resources` WRITE;
/*!40000 ALTER TABLE `tenilacl_resources` DISABLE KEYS */;
INSERT INTO `tenilacl_resources` VALUES (8,'Application\\Controller\\Index.index','2015-05-06 14:52:10','2015-05-06 14:52:10');
/*!40000 ALTER TABLE `tenilacl_resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tenilacl_roles`
--

DROP TABLE IF EXISTS `tenilacl_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tenilacl_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `tenilacl_roles_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `tenilacl_roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tenilacl_roles`
--

LOCK TABLES `tenilacl_roles` WRITE;
/*!40000 ALTER TABLE `tenilacl_roles` DISABLE KEYS */;
INSERT INTO `tenilacl_roles` VALUES (1,NULL,'Visitante','2014-05-01 00:00:00','2015-03-12 14:42:16'),(5,1,'Registrado','2014-05-01 00:00:00','2014-05-01 00:00:00'),(7,5,'Administrador','2014-05-01 00:00:00','2015-05-06 14:47:59');
/*!40000 ALTER TABLE `tenilacl_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tenilevento_boleto`
--

DROP TABLE IF EXISTS `tenilevento_boleto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tenilevento_boleto` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_pagador` int(10) unsigned NOT NULL COMMENT 'O pagador (ou sacado) está relacionado a inscrição, neste caso.',
  `data_vencimento` date NOT NULL,
  `data_processamento` date NOT NULL,
  `valor_boleto` decimal(10,2) NOT NULL,
  `valor_pago` decimal(10,2) DEFAULT NULL COMMENT 'Arquivo de retorno.',
  `nosso_numero` int(11) unsigned NOT NULL COMMENT '"75896452";  // Nosso numero sem o DV - REGRA: Máximo de 11 caracteres!',
  `numero_documento` int(11) DEFAULT NULL,
  `demonstrativo_1` varchar(50) DEFAULT NULL,
  `demonstrativo_2` varchar(50) DEFAULT NULL,
  `demonstrativo_3` varchar(50) DEFAULT NULL,
  `instrucoes_1` varchar(50) DEFAULT NULL,
  `instrucoes_2` varchar(50) DEFAULT NULL,
  `instrucoes_3` varchar(50) DEFAULT NULL,
  `instrucoes_4` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `nosso_numero_UNIQUE` (`nosso_numero`),
  KEY `fk_boleto_inscricao_idx` (`id_pagador`),
  CONSTRAINT `fk_boleto_inscricao` FOREIGN KEY (`id_pagador`) REFERENCES `tenilevento_inscricao` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tenilevento_boleto`
--

LOCK TABLES `tenilevento_boleto` WRITE;
/*!40000 ALTER TABLE `tenilevento_boleto` DISABLE KEYS */;
INSERT INTO `tenilevento_boleto` VALUES (1,15,'2016-03-22','2016-03-15',70.00,NULL,462,NULL,'Referente à inscrição no evento:','Convenção 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-15 13:42:26','0000-00-00 00:00:00'),(2,10001,'2016-03-22','2016-03-15',70.50,NULL,404,NULL,'Referente à inscrição no evento:','Convenção 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-15 15:12:15','2016-03-15 19:27:35'),(3,10002,'2016-03-22','2016-03-15',70.00,NULL,10002,NULL,'Referente à inscrição no evento:','Convenção 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-15 15:21:41','0000-00-00 00:00:00'),(4,10003,'2016-03-22','2016-03-15',70.00,NULL,10003,10003,'Referente à inscrição no evento:','Convenção 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-15 18:13:40','0000-00-00 00:00:00'),(5,10004,'2016-03-22','2016-03-15',70.00,NULL,10004,10004,'Referente à inscrição no evento:','Convenção 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-15 18:15:13','0000-00-00 00:00:00'),(6,10005,'2016-03-22','2016-03-15',70.00,NULL,10005,10005,'Referente à inscrição no evento:','Convenção 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-15 18:17:08','0000-00-00 00:00:00'),(7,10006,'2016-03-22','2016-03-15',70.00,NULL,10006,10006,'Referente à inscrição no evento:','Convenção 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-15 18:19:45','0000-00-00 00:00:00'),(8,10007,'2016-03-22','2016-03-15',70.00,NULL,10007,10007,'Referente à inscrição no evento:','Convenção 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-15 18:20:30','0000-00-00 00:00:00'),(9,10008,'2016-03-22','2016-03-15',70.00,NULL,10008,10008,'Referente à inscrição no evento:','Convenção 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-15 18:23:18','0000-00-00 00:00:00'),(10,10009,'2016-03-22','2016-03-15',70.00,NULL,10009,10009,'Referente à inscrição no evento:','Convenção 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-15 18:45:51','0000-00-00 00:00:00'),(11,10010,'2016-03-22','2016-03-15',70.00,NULL,10010,10010,'Referente à inscrição no evento:','Convenção 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-15 19:30:20','2016-03-15 19:30:20'),(12,10011,'2016-03-22','2016-03-15',70.00,NULL,10011,10011,'Referente à inscrição no evento:','Convenção 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-15 21:12:06','2016-03-15 21:12:06'),(13,10012,'2016-03-22','2016-03-15',70.00,NULL,10012,10012,'Referente à inscrição no evento:','Convenção 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-15 21:50:12','2016-03-15 21:50:12'),(14,10013,'2016-03-22','2016-03-15',70.00,NULL,10013,10013,'Referente à inscrição no evento:','Convenção 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-15 23:55:07','2016-03-15 23:55:07'),(15,10014,'2016-03-23','2016-03-16',70.00,NULL,10014,10014,'Referente à inscrição no evento:','Convenção Mundial 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-16 16:17:50','2016-03-16 16:17:50'),(16,10015,'2016-03-23','2016-03-16',70.00,NULL,10015,10015,'Referente à inscrição no evento:','Convenção Mundial 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-16 16:19:54','2016-03-16 16:19:54'),(17,10016,'2016-03-23','2016-03-16',70.00,NULL,10016,10016,'Referente à inscrição no evento:','Convenção Mundial 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-16 16:46:43','2016-03-16 16:46:43'),(18,10017,'2016-03-23','2016-03-16',70.00,NULL,10017,10017,'Referente à inscrição no evento:','Convenção Mundial 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-16 16:51:45','2016-03-16 16:51:45'),(19,10018,'2016-03-23','2016-03-16',70.00,NULL,10018,10018,'Referente à inscrição no evento:','Convenção Mundial 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-16 17:46:12','2016-03-16 17:46:12'),(20,10019,'2016-03-23','2016-03-16',70.00,NULL,10019,10019,'Referente à inscrição no evento:','Convenção Mundial 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-16 18:41:17','2016-03-16 18:41:17'),(21,10020,'2016-03-25','2016-03-18',12.34,NULL,10020,10020,'Referente à inscrição no evento:','Convenção Mundial 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-18 12:08:28','2016-03-18 12:09:20'),(22,10021,'2016-03-25','2016-03-18',70.00,NULL,10021,10021,'Referente à inscrição no evento:','Convenção Mundial 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-18 14:09:09','2016-03-18 14:09:09'),(23,10022,'2016-03-25','2016-03-18',70.00,NULL,10022,10022,'Referente à inscrição no evento:','Convenção Mundial 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-18 14:20:07','2016-03-18 14:20:07'),(24,10023,'2016-03-25','2016-03-18',70.00,NULL,10023,10023,'Referente à inscrição no evento:','Convenção Mundial 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-18 14:48:33','2016-03-18 14:48:33'),(25,10024,'2016-03-25','2016-03-18',70.00,NULL,10024,10024,'Referente à inscrição no evento:','Convenção Mundial 2016','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-18 14:57:31','2016-03-18 14:57:31'),(26,10026,'2016-03-27','2016-03-20',12.34,NULL,10026,10026,'Referente à inscrição no evento:','Testando create_at','O não pagamento cancelará a inscrição.','Sr. Caixa, não receber após o vencimento.','','','','2016-03-20 13:11:09','2016-03-20 13:11:09');
/*!40000 ALTER TABLE `tenilevento_boleto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tenilevento_evento`
--

DROP TABLE IF EXISTS `tenilevento_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tenilevento_evento` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(512) NOT NULL,
  `tema` varchar(512) DEFAULT NULL,
  `descricao` text,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fim` time DEFAULT NULL,
  `qtd_vagas` int(10) unsigned DEFAULT NULL,
  `flag_inscricoes_abertas` tinyint(4) DEFAULT NULL,
  `flag_evento_gratuito` tinyint(4) DEFAULT NULL,
  `organizador` varchar(512) DEFAULT NULL,
  `id_fone_1` int(10) unsigned DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL COMMENT 'Permanlink. Identificação do evento por url amigável.',
  `id_endereco` int(10) unsigned DEFAULT NULL,
  `valor_inscricao` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slugl_evento_UNIQUE` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tenilevento_evento`
--

LOCK TABLES `tenilevento_evento` WRITE;
/*!40000 ALTER TABLE `tenilevento_evento` DISABLE KEYS */;
INSERT INTO `tenilevento_evento` VALUES (1,'Convenção Mundial 2016','Ano do Acrescentar e Multiplicar','Você tem um encontro marcado! Em Brasília, na Catedral da Bênção.','2016-07-19','2016-07-24',NULL,NULL,3000,1,0,'Igreja Casa da Bênção',NULL,'contato@cb.org.br','convencao-mundial-2016',NULL,70.00,'2016-03-14 15:01:26','2016-03-18 12:06:25'),(2,'Encontro de Casais 2016','Não sei o tema','– 3 refeições inclusas;','2016-11-11','2016-11-13',NULL,NULL,100,NULL,NULL,'Igreja Batista Exodus',NULL,NULL,'encontro-de-casais-2016',NULL,NULL,'2016-03-14 15:01:26','0000-00-00 00:00:00'),(3,'Tenil Teleiso','lkjasdf','','2016-03-24','2016-03-26',NULL,NULL,NULL,1,0,'',NULL,'','tenil-teleiso',NULL,NULL,'2016-03-14 15:01:26','0000-00-00 00:00:00'),(4,'Keanu Reeves','Jimmy Fallon','','2016-03-08','2016-03-08','20:00:00','21:00:00',NULL,1,0,'Matrix',NULL,'quecoisa@ex.com','keanu-reeves',NULL,NULL,'2016-03-14 15:01:26','0000-00-00 00:00:00'),(5,'Natal 2016','Papai Noel','','2016-06-08','2016-11-22',NULL,NULL,NULL,1,0,'asdfasdf',NULL,'asdfasdf@com.br','natal-2016',NULL,NULL,'2016-03-14 15:01:26','0000-00-00 00:00:00'),(6,'Constituição da áçééíáéóúàã~~~sskdkj kskl  fdslkj;lasfdk j          fskjsdflka sdfads lkdfs jlk sdfj   - --------- xfdfjksdflkj','teses','','2016-03-15','2016-03-24',NULL,NULL,NULL,1,0,'',NULL,'','constituicao-da-aceeiaeouaa-sskdkj-kskl-fdslkj-lasfdk-j-fskjsdflka-sdfads-lkdfs-jlk-sdfj-xfdfjksdflkj',NULL,NULL,'2016-03-14 15:01:26','0000-00-00 00:00:00'),(7,'Santa Ceia - Março de 2016','Mulheres da Bênção','Santa Ceia das mulheres da Bênção.','2016-03-13','2016-03-13',NULL,NULL,NULL,1,0,'Igreja Catedral da Bênção',NULL,'contato@cb.org.br','santa-ceia-marco-de-2016',NULL,NULL,'2016-03-14 15:01:26','0000-00-00 00:00:00'),(8,'Testando create_at','teSTE','','2016-03-20','2016-03-20',NULL,NULL,NULL,1,0,'',NULL,'','testando-create-at',NULL,12.34,'2016-03-20 12:54:35','2016-03-20 12:54:35');
/*!40000 ALTER TABLE `tenilevento_evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tenilevento_inscricao`
--

DROP TABLE IF EXISTS `tenilevento_inscricao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tenilevento_inscricao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_responsavel` int(10) unsigned DEFAULT NULL,
  `id_evento` int(10) unsigned DEFAULT NULL,
  `nome` varchar(512) NOT NULL,
  `email` varchar(512) DEFAULT NULL,
  `cpf` varchar(11) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `end_logradouro` varchar(255) DEFAULT NULL,
  `end_numero` varchar(5) DEFAULT NULL,
  `end_complemento` varchar(255) DEFAULT NULL,
  `end_bairro` varchar(255) DEFAULT NULL,
  `end_localidade` varchar(255) DEFAULT NULL,
  `end_uf` varchar(2) DEFAULT NULL,
  `end_cep` varchar(8) DEFAULT NULL,
  `fone_fixo` varchar(11) DEFAULT NULL,
  `fone_celular` varchar(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tenilevento_incricao_ibfk_1_idx` (`id_evento`),
  CONSTRAINT `tenilevento_incricao_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `tenilevento_evento` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10027 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tenilevento_inscricao`
--

LOCK TABLES `tenilevento_inscricao` WRITE;
/*!40000 ALTER TABLE `tenilevento_inscricao` DISABLE KEYS */;
INSERT INTO `tenilevento_inscricao` VALUES (1,NULL,1,'roberto','','',NULL,'','',NULL,'','','','',NULL,NULL,'2016-03-08 15:05:05','2016-03-08 15:05:05'),(2,NULL,4,'Roberto','','65896092172','2012-12-31','QSE','7',NULL,'Taguatinga Sul','Taguatinga','DF','72025070',NULL,NULL,'2016-03-08 15:19:10','2016-03-08 15:19:10'),(3,NULL,3,'Abobreu','roberto.tenil@gmail.com','65896092172','2016-02-28','QSE','7',NULL,'Taguatinga','Brasília','DF','72025070',NULL,NULL,'2016-03-08 15:23:17','2016-03-08 15:23:17'),(4,NULL,1,'Jonatas','jonatas@jj.com','68545645645','2016-03-08','qse!','13',NULL,'3232','312312','DF','sdfasf',NULL,NULL,'2016-03-08 17:14:54','2016-03-08 17:14:54'),(5,NULL,1,'Roberto','roberto.tenil@gmail.com','65896092172','2012-09-28','QSE','43',NULL,'Taguatinga','Taguatinga','DF','72025070','6137024282','6184024282','2016-03-09 14:10:29','2016-03-09 14:10:29'),(6,NULL,1,'Roberto','roberto@tenil.com.br','65896092172','1980-12-22','QSE','123',NULL,'123','123','12','12','','','2016-03-09 18:48:08','2016-03-09 18:48:08'),(7,NULL,1,'Roberto','roberto@tenil.com.br','65896092172','1976-12-22','asdf','asdf',NULL,'asdf','asdf','dd','asfs','','','2016-03-09 18:51:03','2016-03-09 18:51:03'),(8,NULL,1,'sddfgdg','roberto.tenil@gmail.com','65896092172','1995-10-25','asdfasf','12345',NULL,'asdffsdf','asdfasdfasf','MS','72000000','','','2016-03-09 21:36:32','2016-03-09 21:36:32'),(9,NULL,1,'ewrqwerkd','roberto@tenil.com','65896092172','2133-12-23','asdfasdf','asdfa',NULL,'asdfasdf','asdfasdef','MG','32132132','','61321321321','2016-03-09 22:45:59','2016-03-09 22:45:59'),(10,NULL,1,'roberto','roberto.tenil@gmail.com','65896092172','2016-09-03','asdf','asdfa',NULL,'asdfasdf','asdfasf','PB','32132132','','6184024282','2016-03-10 14:24:10','2016-03-10 14:24:10'),(11,NULL,1,'roberto','roberto.tenil@gmail.com','65896092172','2016-03-30','asdfasdf','asdfa',NULL,'fdasdfasd','fasdfasdf','CE','11321321','321321','6184024282','2016-03-10 14:41:45','2016-03-10 14:41:45'),(12,NULL,1,'UM DOIS TRES DE OLIVEIRA QUATRO','AO6691@YAHOO.com.br','07671158801','1966-01-30','rua 04, chacara 22','7',NULL,'SHVP','Taguatinga','DF','72006290','6174006225','6181736144','2016-03-11 19:00:30','2016-03-11 19:00:30'),(13,NULL,1,'Roberto Teste','roberto.tenil@gmail.com','65896092172','2016-03-01','QSE 7','43',NULL,'Taguatinga Sul','Taguatinga','DF','72025070','','6184024282','2016-03-15 13:21:30','2016-03-15 13:21:30'),(14,NULL,1,'Miriam Teste','miriam@tenil.com.br','88668550144','1981-07-07','QS 102','1101',NULL,'Samambaia Sul','Taguatinga','DF','72025070','','6184244240','2016-03-15 13:41:00','2016-03-15 13:41:00'),(15,NULL,1,'Miriam Teste','miriam@tenil.com.br','88668550144','1981-07-07','QS 102','1101',NULL,'Samambaia Sul','Taguatinga','DF','72025070','','6184244240','2016-03-15 13:42:26','2016-03-15 13:42:26'),(10001,NULL,1,'Roberto Santos Silva','roberto.tenil@gmail.com','65896092172','1976-12-22','QS 102 CJ 2 LT 1, 2, 3 BL B','1101',NULL,'Samambaia','Brasília','DF','72300603','6137024282','6184024282','2016-03-15 15:12:15','2016-03-15 15:12:15'),(10002,NULL,1,'Miriam Silva de Araújo','miriam@tenil.com.br','88668550144','1981-07-07','QS 102 CJ 2 LT 1, 2, 3 BL B','1101',NULL,'Samambaia','Brasília','DF','72300603','','6184234240','2016-03-15 15:21:41','2016-03-15 15:21:41'),(10003,NULL,1,'Jonatas','jonatas@tenil.com.br','65896092172','1976-12-22','ASFDASDFASDF','a;lsk',NULL,'asl;kdfj','aslkjf','DF','32132132','','6184024282','2016-03-15 18:13:40','2016-03-15 18:13:40'),(10004,NULL,1,'Jonatas','jonatas@tenil.com.br','65896092172','1976-12-22','a;lskfdj','a;lsk',NULL,'asl;kdfj','aslkjf','DF','32132132','','6184024282','2016-03-15 18:15:13','2016-03-15 18:15:13'),(10005,NULL,1,'Jonatas','jonatas@tenil.com.br','65896092172','1976-12-22','a;lskfdj','a;lsk',NULL,'asl;kdfj','aslkjf','DF','32132132','','6184024282','2016-03-15 18:17:08','2016-03-15 18:17:08'),(10006,NULL,1,'Jonatas','jonatas@tenil.com.br','65896092172','1976-12-22','a;lskfdj','a;lsk',NULL,'asl;kdfj','aslkjf','DF','32132132','','6184024282','2016-03-15 18:19:45','2016-03-15 18:19:45'),(10007,NULL,1,'Jonatas','jonatas@tenil.com.br','65896092172','1976-12-22','a;lskfdj','a;lsk',NULL,'asl;kdfj','aslkjf','DF','32132132','','6184024282','2016-03-15 18:20:30','2016-03-15 18:20:30'),(10008,NULL,1,'Jonatas','jonatas@tenil.com.br','65896092172','1976-12-22','a;lskfdj','a;lsk',NULL,'asl;kdfj','aslkjf','DF','32132132','','6184024282','2016-03-15 18:23:18','2016-03-15 18:23:18'),(10009,NULL,1,'Joãozinho','joaozinho@tenil.com.br','65896092172','1981-11-11','asdfasdfa','sdfsd',NULL,'sfafdsadf','adsffasdfadsf','MG','32165465','','6184024282','2016-03-15 18:45:51','2016-03-15 18:45:51'),(10010,NULL,1,'Joãozinho das Couves','joaozinho@tenil.com.br','65896092172','1981-11-11','asdfasdfa','sdfsd',NULL,'sfafdsadf','adsffasdfadsf','MG','32165465','','6184024282','2016-03-15 19:30:20','2016-03-15 19:30:20'),(10011,NULL,1,'Adílson Wlaufredir de Oliveira','adilson@wlaufredir.com.br','07671158801','1966-01-30','rua 04, chacara 22','7',NULL,'SHVP','BRASILIA','DF','72006290','6174006225','6181736144','2016-03-15 21:12:06','2016-03-15 21:12:06'),(10012,NULL,1,'Miriam Silva de Araújo','miriam@tenil.com.br','88668550144','1981-07-07','QS 10','1101',NULL,'Samambaia','Brasília','DF','72300603','','6184234240','2016-03-15 21:50:12','2016-03-15 21:50:12'),(10013,NULL,1,'Mirian Priscila Santos Silva','mirianpriscila@gmail.com','85463736120','1979-01-31','CSB 3 lote 05 apartamento 107','107',NULL,'Sul','Taguatinga','DF','72015535','6130426148','6182216335','2016-03-15 23:55:07','2016-03-15 23:55:07'),(10014,NULL,1,'Roberto','roberto.tenil@yahoo.com','65896092172','1976-12-22','QSE 7','43','','Taguatinga Sulva','Taguatinga','DF','72025070','','6184024282','2016-03-16 16:17:50','2016-03-16 16:17:50'),(10015,NULL,1,'Roberto','roberto.tenil@gmail.com','65896092172','1966-12-22','QSE','43','Testando complemento','sdlkfjasdlfkj','asdlfkjasdflkj','DF','32132132','2132321321','6184024282','2016-03-16 16:19:54','2016-03-16 16:19:54'),(10016,NULL,1,'sdfsdfsfsfs','1234@gmail.com','18530249100','1980-11-11','dfsdfsdfsdfsdf','sfsfs','sdfsdfsdfs','sdfsdfsdf','sdfsdfsdfsdfsdfs','DF','70658264','','55555555555','2016-03-16 16:46:43','2016-03-16 16:46:43'),(10017,NULL,1,'Eloisa Maria dos Santos Silva','eloisa@tenil.com.br','09872043191','1949-12-24','QSE','07','Casa 43','Taguatinga Sul','Taguatinga','DF','72025070','6133565734','6184026292','2016-03-16 16:51:45','2016-03-16 16:51:45'),(10018,NULL,1,'ivan freitas','ivan@tenil.com.br','00992309174','1984-05-02','qsc 19','1','casa 10','tag sul','taguatinga','DF','72016190','','6196321828','2016-03-16 17:46:12','2016-03-16 17:46:12'),(10019,NULL,1,'lilian Brunelli figueredo','lilianfig@aol.com','40046753168','1967-08-20','QSF 01 A/esp','4/5','','Taguatinga','Taguatinga','DF','72025500','','6199097220','2016-03-16 18:41:17','2016-03-16 18:41:17'),(10020,NULL,1,'Roberto Santos Silva','roberto.tenil@gmail.com','65896092172','1976-12-22','QSE 7','43','','Taguatinga','Brasília','DF','72025070','6137024282','6184024282','2016-03-18 12:08:28','2016-03-18 12:08:28'),(10021,NULL,1,'Roberto','roberto@tenil.com.br','65896092172','2016-03-18','QSE 7','43','','Taguatinga','Brasília','AL','72025070','','6184024282','2016-03-18 14:09:09','2016-03-18 14:09:09'),(10022,NULL,1,'Roberto','roberto@tenil.com.br','65896092172','1976-12-22','QSE 7','43','','Taguatinga','Brasília','DF','72025070','','6184024282','2016-03-18 14:20:07','2016-03-18 14:20:07'),(10023,NULL,1,'Adilson de Oliveira','adilson@wlaufredir.com','07671158801','1966-01-30','rua 04, chacara 22','7','','SHVP','Taguatinga','DF','72006290','6174006225','6181736144','2016-03-18 14:48:33','2016-03-18 14:48:33'),(10024,NULL,1,'Jonatas','jonatasdf22@hotmail.com','05181870120','2016-03-20','Qs 106 conjunto 01 lote 02','02','Samabaia-sul','Samambaia','Samambaia','DF','72302511','6184902993','6184902993','2016-03-18 14:57:31','2016-03-18 14:57:31'),(10025,NULL,8,'Roberto','roberto@tenil.com.br','65896092172','1976-12-22','QSE 7','43','a6s5df1as','Taguatinga','Brasília','AL','72025070','','6184024282','2016-03-20 13:09:43','2016-03-20 13:09:43'),(10026,NULL,8,'Roberto','roberto@tenil.com.br','65896092172','1976-12-22','QSE 7','43','','Taguatinga','Brasília','AL','72025070','','6184024282','2016-03-20 13:11:09','2016-03-20 13:11:09');
/*!40000 ALTER TABLE `tenilevento_inscricao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teniluser_perfil`
--

DROP TABLE IF EXISTS `teniluser_perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teniluser_perfil` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(10) unsigned NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `sobrenome` varchar(255) DEFAULT NULL,
  `apelido` varchar(255) DEFAULT NULL,
  `id_tratamento` tinyint(3) unsigned DEFAULT NULL,
  `is_gravatar` tinyint(1) DEFAULT NULL,
  `id_foto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `id_perfil_UNIQUE` (`id_user`),
  KEY `fk-perfil-user-tipo-tratamento_idx` (`id_tratamento`),
  CONSTRAINT `fk-perfil-user-tipo-tratamento` FOREIGN KEY (`id_tratamento`) REFERENCES `teniluser_tipo_tratamento` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk-user` FOREIGN KEY (`id_user`) REFERENCES `teniluser_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teniluser_perfil`
--

LOCK TABLES `teniluser_perfil` WRITE;
/*!40000 ALTER TABLE `teniluser_perfil` DISABLE KEYS */;
INSERT INTO `teniluser_perfil` VALUES (2,15,'Roberto','Tenil','Tenil Silva',6,NULL,NULL),(15,42,'Adilson','','',NULL,0,NULL),(16,43,'Janatas',NULL,NULL,NULL,0,NULL);
/*!40000 ALTER TABLE `teniluser_perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teniluser_tipo_tratamento`
--

DROP TABLE IF EXISTS `teniluser_tipo_tratamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teniluser_tipo_tratamento` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `abreviacao` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teniluser_tipo_tratamento`
--

LOCK TABLES `teniluser_tipo_tratamento` WRITE;
/*!40000 ALTER TABLE `teniluser_tipo_tratamento` DISABLE KEYS */;
INSERT INTO `teniluser_tipo_tratamento` VALUES (1,'Apóstolo','Ap.'),(2,'Bispo','Bpo.'),(3,'Diácono','Diác.'),(4,'Doutor','Dr.'),(5,'Evangelista','Ev.'),(6,'Pastor','Pr.'),(7,'Presbítero','Presbo.'),(8,'Senhor','Sr.'),(9,'Obreiro','Ob.');
/*!40000 ALTER TABLE `teniluser_tipo_tratamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teniluser_user`
--

DROP TABLE IF EXISTS `teniluser_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teniluser_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `activation_key` varchar(255) NOT NULL,
  `password_reset_key` varchar(255) DEFAULT NULL,
  `role_id` int(10) unsigned DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `user-role_idx` (`role_id`),
  CONSTRAINT `user-role` FOREIGN KEY (`role_id`) REFERENCES `tenilacl_roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teniluser_user`
--

LOCK TABLES `teniluser_user` WRITE;
/*!40000 ALTER TABLE `teniluser_user` DISABLE KEYS */;
INSERT INTO `teniluser_user` VALUES (13,'mirianpriscila@gmail.com','TBBCL1Ho2WZV1JmRCgjU/nlHZ4seNZnI3h5dFrlKzSc=','iJuplRcJlCk=',1,'1d45d5f93ac3d3e4c005f9d1dfca3d97','gX4QroTVo03u1rUggWpluSs9T27nkKHCZGQERkv4qFlu19cj8Lgtqw2NjPMdb9Y6',NULL,'2015-05-21 11:55:49','2015-02-26 14:54:19'),(14,'adilson@wlaufredir.com.br','JRuI4VWfmujxarZm9oSiL3JP5W9cRiryDgYWMnsTQV0=','lIm24xQzqP4=',1,'4a01a29c7ba13683fbfebe1f76cedd7f',NULL,NULL,'2015-03-05 17:01:34','2015-02-27 11:12:04'),(15,'roberto.tenil@gmail.com','FrzQFH0voR5A9NXsWmU0ZpgeeROvHy/txGHm/B2/S/c=','udRxJlm/dzA=',0,'95af570f1c600d92ffdb7165cfaf98fc','Drq3CR73AmiYZrE4UjUpIORbYqKbtEq0lx0utGlFCzBkfLdH0F46Penr7LyIowBD',7,'2015-05-21 11:43:07','2015-02-27 11:35:39'),(42,'adilson@dollop.com.br','/hAEtw1BKdihO2k6cDIgY8T6cDx80LhtHsWjGdyktWE=','ezdlGtkXsn8=',0,'92effb7fee15ac8839211904bb26bd8e',NULL,NULL,'2015-05-26 16:33:35','2015-05-26 16:33:35'),(43,'jonatasdf22@hotmail.com','HLsNzV3u/B5FRk9oWgBDd7AexKxjppXyCy+sDNoByK4=','lNAPGZl5sU4=',0,'ff1e1412ada93331f3b4c82958996b6e',NULL,NULL,'2016-02-15 17:09:11','2016-02-15 17:09:11');
/*!40000 ALTER TABLE `teniluser_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-20 10:31:08
