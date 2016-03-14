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
  `slug` varchar(1024) NOT NULL COMMENT 'Permanlink. Identificação do evento por url amigável.',
  `id_endereco` int(10) unsigned DEFAULT NULL,
  `valor_inscricao` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url_evento_UNIQUE` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tenilevento_evento`
--

LOCK TABLES `tenilevento_evento` WRITE;
/*!40000 ALTER TABLE `tenilevento_evento` DISABLE KEYS */;
INSERT INTO `tenilevento_evento` VALUES (1,'Convenção 2016','Ano do Acrescentar e Multiplicar','Mega convenção mundial das Casas da Benção do Senhor Jesus Cristo dos últimos dias da semana.','2016-07-19','2016-07-24',NULL,NULL,3000,NULL,NULL,'Igreja Casa da Bênção',NULL,'contato@cb.org.br','convencao-2016',NULL,NULL),(2,'Encontro de Casais 2016','Não sei o tema','– 3 refeições inclusas;','2016-11-11','2016-11-13',NULL,NULL,100,NULL,NULL,'Igreja Batista Exodus',NULL,NULL,'encontro-de-casais-2016',NULL,NULL),(3,'Tenil Teleiso','lkjasdf','','2016-03-24','2016-03-26',NULL,NULL,NULL,1,0,'',NULL,'','tenil-teleiso',NULL,NULL);
/*!40000 ALTER TABLE `tenilevento_evento` ENABLE KEYS */;
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

-- Dump completed on 2016-03-05 14:22:09
