-- MySQL dump 10.13  Distrib 5.6.24, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: seleccionpersonal_bd
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.19-MariaDB

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
-- Table structure for table `candidato`
--

DROP TABLE IF EXISTS `candidato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `candidato` (
  `doc_ID` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `hijos` varchar(2) NOT NULL,
  `departamento_nacimiento` varchar(50) NOT NULL,
  `ciudad_nacimiento` varchar(50) NOT NULL,
  `estado_civil` varchar(20) NOT NULL,
  `sexo` varchar(20) NOT NULL,
  `edad` char(2) NOT NULL,
  `email` varchar(200) NOT NULL,
  `Disposicion_laboral_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`doc_ID`),
  KEY `Disposicion_laboral_id` (`Disposicion_laboral_id`),
  CONSTRAINT `candidato_ibfk_1` FOREIGN KEY (`Disposicion_laboral_id`) REFERENCES `disposicion_laboral` (`Disposicion_laboral_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidato`
--

LOCK TABLES `candidato` WRITE;
/*!40000 ALTER TABLE `candidato` DISABLE KEYS */;
INSERT INTO `candidato` VALUES ('12345677','Renzo','Ruiz Pastor','Las brisas','964550776','0','Lambayeque','Chiclayo','Soltero','H','26','renzorp_14@hotmail.com',4),('45977448','Jose Antonio','Juan Peres','urb. Caja DepÃ³sito, Calle Tereza Fanny','964550776','1','Lambayeque','Chiclayo','Soltero','H','29','jose_peres@hotmail.com',4),('46547854','Sandra ','Alvarez Mejia','Los Ãlamos # 415, Santa Victoria','985456587','0','Lambayeque','Chiclayo','Soltero','M','28','sandra_ing@hotmail.com',4),('47741254','Marco Antonio','Chicoma Santisteban','Los Laureles # 405, Caja de PÃ³sito','985587412','0','Lambayeque','Chiclayo','Casado','H','35','Antonio@hotmail.com',3);
/*!40000 ALTER TABLE `candidato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `convocatoria`
--

DROP TABLE IF EXISTS `convocatoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `convocatoria` (
  `convocatoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_convocatoria` varchar(200) NOT NULL,
  `estado` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`convocatoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `convocatoria`
--

LOCK TABLES `convocatoria` WRITE;
/*!40000 ALTER TABLE `convocatoria` DISABLE KEYS */;
INSERT INTO `convocatoria` VALUES (23,'CreaciÃ³n del servicio de saneamiento de los anexos Cruzpampa, Esmeralda y Tambopata, ampliaciÃ³n y mejoramiento del servicio de agua potable en el anexo Cruzpampa - ViÃ±ac â€“ Yauyos- Lima','SP');
/*!40000 ALTER TABLE `convocatoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cronograma`
--

DROP TABLE IF EXISTS `cronograma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cronograma` (
  `cronograma_id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_cronograma` varchar(100) NOT NULL,
  `convocatoria_id` int(11) DEFAULT NULL,
  `etapa_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cronograma_id`),
  KEY `convocatoria_id` (`convocatoria_id`),
  KEY `etapa_id` (`etapa_id`),
  CONSTRAINT `cronograma_ibfk_1` FOREIGN KEY (`convocatoria_id`) REFERENCES `convocatoria` (`convocatoria_id`),
  CONSTRAINT `cronograma_ibfk_2` FOREIGN KEY (`etapa_id`) REFERENCES `etapa` (`etapa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cronograma`
--

LOCK TABLES `cronograma` WRITE;
/*!40000 ALTER TABLE `cronograma` DISABLE KEYS */;
INSERT INTO `cronograma` VALUES (16,'Del 10 al 14 de julio del 2017',23,1),(17,'Del 10 al 14 de julio del 2017',23,2),(18,'Del 10 al 14 de julio del 2017',23,3),(19,'14 de julio del 2017',23,4),(20,'15 de julio del 2017',23,5);
/*!40000 ALTER TABLE `cronograma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamento` (
  `departamento_id` int(11) NOT NULL AUTO_INCREMENT,
  `departamento_nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`departamento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` VALUES (1,'Administración'),(2,'Contabilidad'),(3,'Costo y Presupuesto'),(4,'Logística'),(5,'Mantenimientos de Equipos'),(6,'Legal'),(7,'Topografía'),(8,'Sistemas de Información'),(9,'Esctructuras'),(10,'Medio Ambiente'),(11,'Consulta y Atención'),(12,'Hidráulica'),(13,'Estudio de Suelos'),(14,'Proyectos');
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disposicion_laboral`
--

DROP TABLE IF EXISTS `disposicion_laboral`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disposicion_laboral` (
  `Disposicion_laboral_id` int(11) NOT NULL AUTO_INCREMENT,
  `trabaja_actualmente` char(2) NOT NULL,
  `cambio_residencia` char(2) NOT NULL,
  PRIMARY KEY (`Disposicion_laboral_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disposicion_laboral`
--

LOCK TABLES `disposicion_laboral` WRITE;
/*!40000 ALTER TABLE `disposicion_laboral` DISABLE KEYS */;
INSERT INTO `disposicion_laboral` VALUES (1,'Si','Si'),(2,'Si','No'),(3,'No','No'),(4,'No','Si');
/*!40000 ALTER TABLE `disposicion_laboral` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estudio_candidato`
--

DROP TABLE IF EXISTS `estudio_candidato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estudio_candidato` (
  `estudio_candidato_id` int(11) NOT NULL AUTO_INCREMENT,
  `institucion_educativa` varchar(100) NOT NULL,
  `titulo_estudio` varchar(100) NOT NULL,
  `grado_estudio` varchar(20) NOT NULL,
  `fecha_inicio` varchar(20) NOT NULL,
  `fecha_fin` varchar(20) NOT NULL,
  `doc_ID` varchar(20) DEFAULT NULL,
  `estado_estudios` varchar(50) NOT NULL,
  PRIMARY KEY (`estudio_candidato_id`),
  KEY `doc_ID` (`doc_ID`),
  CONSTRAINT `estudio_candidato_ibfk_1` FOREIGN KEY (`doc_ID`) REFERENCES `candidato` (`doc_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estudio_candidato`
--

LOCK TABLES `estudio_candidato` WRITE;
/*!40000 ALTER TABLE `estudio_candidato` DISABLE KEYS */;
INSERT INTO `estudio_candidato` VALUES (9,'Ssssssssssss','sssssssssssssssss','Magister','0001-11-11','0001-11-11','45977448','Culminado'),(10,'hhhhhhhhhhhhhhh','hhhhhhhhhhhhhhh','EducaciÃ³n Primaria','0001-01-01','0001-01-01','45977448','Culminado'),(11,'hhhhhhhhhhhhhhh','hhhhhhhhhhhhhhh','EducaciÃ³n Primaria','0001-01-01','0001-01-01','45977448','Culminado'),(12,'rrrrrrrrrrrrrrrr','rrrrrrrrrrrrrrrrrrrrrrrrrrrr','EducaciÃ³n Secundari','0001-01-01','0001-01-01','45977448','Cursando'),(13,'Usat','Ingeniera Civil','Universitari','2011-01-01','2016-01-01','46547854','Culminado'),(14,'Usat','Ingeniera Civil','Universitario','2010-01-01','2015-01-01','47741254','Culminado'),(15,'dddddddddd','dddddddddddd','EducaciÃ³n Primaria','2016-01-01','2017-01-10','47741254','Culminado');
/*!40000 ALTER TABLE `estudio_candidato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etapa`
--

DROP TABLE IF EXISTS `etapa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etapa` (
  `etapa_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_etapa` varchar(100) NOT NULL,
  PRIMARY KEY (`etapa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etapa`
--

LOCK TABLES `etapa` WRITE;
/*!40000 ALTER TABLE `etapa` DISABLE KEYS */;
INSERT INTO `etapa` VALUES (1,'Recepción de Postulaciones'),(2,'Filtro Curricular'),(3,'Pruebas de Selección'),(4,'Resultado de Pruebas de selección'),(5,'Entrevista Gerencial y Resultado Final'),(6,'Resultado Final');
/*!40000 ALTER TABLE `etapa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `experiencia_laboral`
--

DROP TABLE IF EXISTS `experiencia_laboral`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `experiencia_laboral` (
  `experiencia_labora_ID` int(11) NOT NULL AUTO_INCREMENT,
  `rubro_empresa` varchar(100) NOT NULL,
  `empresa` varchar(100) NOT NULL,
  `puesto` varchar(100) NOT NULL,
  `lugar` varchar(20) NOT NULL,
  `descripcion_laboral` varchar(500) NOT NULL,
  `area` varchar(100) NOT NULL,
  `doc_ID` varchar(20) DEFAULT NULL,
  `duracion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`experiencia_labora_ID`),
  KEY `doc_ID` (`doc_ID`),
  CONSTRAINT `experiencia_laboral_ibfk_1` FOREIGN KEY (`doc_ID`) REFERENCES `candidato` (`doc_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experiencia_laboral`
--

LOCK TABLES `experiencia_laboral` WRITE;
/*!40000 ALTER TABLE `experiencia_laboral` DISABLE KEYS */;
INSERT INTO `experiencia_laboral` VALUES (16,'Construccion','pepe construcciones','Jefe de proyectos','Ambos','-----------------','EjecuciÃ³n de obras','45977448','De 2 a 3 anos'),(18,'Construccion','Renzito consultores','Jefe de obra','Ambos','----------------------','EjecuciÃ³n de obras','45977448','Menor a 1 ano'),(19,'Construccion','pepe construcciones','Abogado especialista en constructoras','Oficina','-------------------','EjecuciÃ³n de obras','45977448','De 2 a 3 anos'),(20,'Construccion','pepe construcciones','Contador','Oficina','--------------','EjecuciÃ³n de obras','45977448','De 1 a 2 anos'),(21,'Construccion','pepe construcciones','Contador','Ambos','Supervisar los proyectos de la empresa, con el fin hacer cumplir con los protocolos de seguridad y calidad de la obra.','Calidad','46547854','De 1 a 2 anos'),(22,'Construccion','Dera Constructora - Chiclayo','Jefe de obra','Ambos','Supervisar que la obra se este construyendo de acuerdo con los requerimientos establecidos con el cliente.','EjecuciÃ³n de obras','46547854','Menor a 1 ano'),(23,'Construccion','pepe construcciones','Jefe de proyectos','Oficina','-----------------------','EjecuciÃ³n de obras','46547854','De 2 a 3 anos'),(24,'Construccion','pepe construcciones','Contador','Oficina','-----------','EjecuciÃ³n de obras','47741254','De 1 a 2 anos'),(25,'Construccion','pepe construcciones','Jefe de proyectos','Oficina','----------------------','EjecuciÃ³n de obras','47741254','De 2 a 3 anos'),(26,'Construccion','Dera Constructora - Chiclayo','Jefe de obra','Ambos','----------------','EjecuciÃ³n de obras','47741254','Menor a 1 ano');
/*!40000 ALTER TABLE `experiencia_laboral` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `experiencia_requerida`
--

DROP TABLE IF EXISTS `experiencia_requerida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `experiencia_requerida` (
  `experiencia_requeridad_id` int(11) NOT NULL AUTO_INCREMENT,
  `experiencia_requerida` varchar(100) NOT NULL,
  `duracion` varchar(100) NOT NULL,
  `puesto_laboral_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`experiencia_requeridad_id`),
  KEY `puesto_laboral_ID` (`puesto_laboral_ID`),
  CONSTRAINT `experiencia_requerida_ibfk_1` FOREIGN KEY (`puesto_laboral_ID`) REFERENCES `puesto_laboral` (`puesto_laboral_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experiencia_requerida`
--

LOCK TABLES `experiencia_requerida` WRITE;
/*!40000 ALTER TABLE `experiencia_requerida` DISABLE KEYS */;
INSERT INTO `experiencia_requerida` VALUES (3,'Jefe de proyectos','de 2 a 3 anos',12),(7,'Jefe de obra','Menor a 1 ano',12),(9,'Obrero constructor','de 1 a 2 anos',13),(11,'Obrero mesclador de cemento','de 1 a 2 anos',13);
/*!40000 ALTER TABLE `experiencia_requerida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `finalista`
--

DROP TABLE IF EXISTS `finalista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `finalista` (
  `finalista_ID` int(11) NOT NULL AUTO_INCREMENT,
  `doc_id` varchar(20) DEFAULT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `puesto_laboral_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`finalista_ID`),
  UNIQUE KEY `DOC_ID_PREGUNTA_ID_uniq` (`doc_id`,`puesto_laboral_id`),
  KEY `puesto_laboral_id` (`puesto_laboral_id`),
  CONSTRAINT `finalista_ibfk_1` FOREIGN KEY (`puesto_laboral_id`) REFERENCES `puesto_laboral` (`puesto_laboral_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `finalista`
--

LOCK TABLES `finalista` WRITE;
/*!40000 ALTER TABLE `finalista` DISABLE KEYS */;
INSERT INTO `finalista` VALUES (1,'46547854','Sandra ','Alvarez Mejia','sandra_ing@hotmail.com','985456587',NULL,12),(2,'47741254','Marco Antonio','Chicoma Santisteban','Antonio@hotmail.com','985587412',NULL,12);
/*!40000 ALTER TABLE `finalista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formacion_deseable`
--

DROP TABLE IF EXISTS `formacion_deseable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formacion_deseable` (
  `formacion_deseable_id` int(11) NOT NULL AUTO_INCREMENT,
  `formacion_deseable_nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`formacion_deseable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formacion_deseable`
--

LOCK TABLES `formacion_deseable` WRITE;
/*!40000 ALTER TABLE `formacion_deseable` DISABLE KEYS */;
/*!40000 ALTER TABLE `formacion_deseable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ponderacion_deseable`
--

DROP TABLE IF EXISTS `ponderacion_deseable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ponderacion_deseable` (
  `ponderacion_deseable_id` int(11) NOT NULL AUTO_INCREMENT,
  `ponderacion_deseable_minimo` int(11) DEFAULT NULL,
  `ponderacion_deseable_maximo` int(11) DEFAULT NULL,
  `prueba_id` int(11) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `valoracion` int(11) DEFAULT NULL,
  PRIMARY KEY (`ponderacion_deseable_id`),
  KEY `prueba_id` (`prueba_id`),
  CONSTRAINT `ponderacion_deseable_ibfk_1` FOREIGN KEY (`prueba_id`) REFERENCES `prueba` (`prueba_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ponderacion_deseable`
--

LOCK TABLES `ponderacion_deseable` WRITE;
/*!40000 ALTER TABLE `ponderacion_deseable` DISABLE KEYS */;
INSERT INTO `ponderacion_deseable` VALUES (31,0,4,18,'C',1),(32,5,9,18,'I',2),(33,10,14,18,'I',3),(34,15,19,18,'I',4),(35,20,24,18,'I',5),(36,0,1,16,'I',1),(37,2,3,16,'C',2),(38,4,5,16,'I',3),(39,6,7,16,'I',4),(40,8,9,16,'I',5),(41,0,1,15,'I',1),(42,2,3,15,'C',2),(43,4,5,15,'I',3),(44,6,7,15,'I',4),(45,8,9,15,'I',5),(46,0,3,19,'I',1),(47,4,7,19,'C',2),(48,8,12,19,'I',3),(49,13,16,19,'I',4),(50,17,20,19,'I',5),(51,0,3,20,'I',1),(52,4,7,20,'I',2),(53,8,12,20,'I',3),(54,13,16,20,'C',4),(55,17,20,20,'C',5);
/*!40000 ALTER TABLE `ponderacion_deseable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postulacion`
--

DROP TABLE IF EXISTS `postulacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `postulacion` (
  `postulacion` int(11) NOT NULL AUTO_INCREMENT,
  `doc_id` varchar(20) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `fecha_postulacion` varchar(100) DEFAULT NULL,
  `puesto_laboral_id` int(11) DEFAULT NULL,
  `finalista` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`postulacion`),
  UNIQUE KEY `DOC_ID_PREGUNTA_ID_uniq` (`doc_id`,`puesto_laboral_id`),
  KEY `puesto_laboral_id` (`puesto_laboral_id`),
  CONSTRAINT `postulacion_ibfk_1` FOREIGN KEY (`puesto_laboral_id`) REFERENCES `puesto_laboral` (`puesto_laboral_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postulacion`
--

LOCK TABLES `postulacion` WRITE;
/*!40000 ALTER TABLE `postulacion` DISABLE KEYS */;
INSERT INTO `postulacion` VALUES (27,'45977448','Jose Antonio','CURRICULO APTO','11/07/17 a las 05:38',12,NULL),(28,'47741254','Marco Antonio','CURRICULO APTO','11/07/17 a las 09:38',12,NULL),(29,'46547854','Sandra ','CURRICULO APTO','12/07/17 a las 11:05',12,NULL),(30,'46547854','Sandra ','CURRICULO NO APTO','24/07/17 a las 04:46',13,NULL);
/*!40000 ALTER TABLE `postulacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pregunta`
--

DROP TABLE IF EXISTS `pregunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pregunta` (
  `pregunta_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_pregunta` varchar(10000) DEFAULT NULL,
  `prueba_id` int(11) DEFAULT NULL,
  `puntaje` float DEFAULT NULL,
  `respuesta` char(1) DEFAULT NULL,
  `puntaje_incorrecto` float DEFAULT NULL,
  `estado` varchar(50) DEFAULT 'SIN RESPONDER',
  PRIMARY KEY (`pregunta_id`),
  KEY `prueba_id` (`prueba_id`),
  CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`prueba_id`) REFERENCES `prueba` (`prueba_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pregunta`
--

LOCK TABLES `pregunta` WRITE;
/*!40000 ALTER TABLE `pregunta` DISABLE KEYS */;
INSERT INTO `pregunta` VALUES (2,'<table style=\"width: 607px;\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 347.382px;\">\r\n<p><strong>&nbsp;&iquest;cuanto es 3 + 2 ?</strong></p>\r\n<p style=\"text-align: left;\">a) 1 &nbsp; &nbsp; b) 2 &nbsp; &nbsp; c) 3 &nbsp; &nbsp; d) 4 &nbsp; &nbsp; e) n.a</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>',15,1,'e',0,'SIN RESPONDER'),(3,'<table style=\"width: 491.795px; height: 94px;\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 338px;\">\r\n<p style=\"text-align: left;\"><strong>2. Si tengo 2 manzanas y me como una, &iquest;cuantas manzanas me quedan?</strong></p>\r\n<p>&nbsp;a) 4 &nbsp; &nbsp;b) 1&nbsp; &nbsp; b) 8&nbsp; &nbsp; b) 2&nbsp; &nbsp; b) 5 &nbsp; &nbsp;&nbsp;</p>\r\n</td>\r\n<td style=\"width: 151.795px;\"><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://lasmatesdivertidas.files.wordpress.com/2013/10/manzanas1.jpg\" alt=\"\" width=\"100\" height=\"114\" /></td>\r\n</tr>\r\n</tbody>\r\n</table>',15,1,'b',0,'SIN RESPONDER'),(4,'<table style=\"width: 567.438px;\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 369px;\">\r\n<p><strong>3. Tengo 4 platanos y me como 3. &iquest;Cu&aacute;ntos me quedan?</strong></p>\r\n<p>&nbsp;</p>\r\n<p><strong>a) 4 &nbsp; &nbsp;b) 2 &nbsp; &nbsp;c) 1 &nbsp; &nbsp;d) 0 &nbsp; &nbsp; e) n.a</strong></p>\r\n</td>\r\n<td style=\"width: 195.438px;\"><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"http://www.gifss.com/alimentos/platanos/banana1.gif\" alt=\"\" width=\"100\" height=\"89\" /></td>\r\n</tr>\r\n</tbody>\r\n</table>',15,1,'c',0,'SIN RESPONDER'),(5,'<table style=\"width: 643px;\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 320.368px;\">\r\n<p>Tengo 10 ladrillos y se me pierden 4.</p>\r\n<p>&iquest;Cu&aacute;ntos me quendan?</p>\r\n<p>a) 1 &nbsp; &nbsp; b) 6 &nbsp; &nbsp; c) 3 &nbsp; &nbsp;d) 11 &nbsp; &nbsp; e) 10 &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>\r\n</td>\r\n<td style=\"width: 320.632px;\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>',16,1,'b',0,'SIN RESPONDER'),(6,'<table style=\"width: 865px;\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 390.253px;\">\r\n<p>Cuanto es&nbsp;</p>\r\n<p><img src=\"http://respuestas.tips/wp-content/uploads/2013/07/suma.jpg\" width=\"300\" height=\"198\" /></p>\r\n<p>a) 4 &nbsp; &nbsp; b) 1 &nbsp; &nbsp; c) 6 &nbsp; &nbsp; d)5 &nbsp; &nbsp; e) n.a</p>\r\n</td>\r\n<td style=\"padding-left: 30px; width: 471.747px;\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>',16,1,'a',0,'SIN RESPONDER'),(8,'<p><img style=\"float: left;\" src=\"http://respuestas.tips/wp-content/uploads/2013/07/suma.jpg\" alt=\"\" width=\"250\" height=\"166\" /></p>\r\n<p>&nbsp; &nbsp;&nbsp;a) 1 &nbsp; &nbsp; &nbsp;b) -1 &nbsp; &nbsp; &nbsp;c) 3 &nbsp; &nbsp; &nbsp;d) 5 &nbsp; &nbsp; &nbsp; e) 4 &nbsp;</p>',16,1,'e',0,'SIN RESPONDER'),(10,'<table style=\"width: 586px;\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 258.892px;\">\r\n<p>4 * 9</p>\r\n<p>&nbsp;</p>\r\n<p>a) 4 &nbsp; &nbsp; b) 13 &nbsp; &nbsp; c) 36 &nbsp; &nbsp; d) 2 &nbsp; &nbsp; e) n.a</p>\r\n</td>\r\n<td style=\"width: 326.108px;\"><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://www.natursan.net/wp-content/beneficiosperas.jpg\" alt=\"\" width=\"140\" height=\"87\" /></td>\r\n</tr>\r\n</tbody>\r\n</table>',18,1,'c',0,'SIN RESPONDER'),(11,'<p><strong><span style=\"color: #ff0000;\">&iquest;Qu&eacute; significa emita&ntilde;o?</span></strong></p>\r\n<p>a) monje &nbsp; &nbsp; b) solidario &nbsp; &nbsp; &nbsp;c) fil&oacute;sofo &nbsp; &nbsp; &nbsp;d) enano</p>',19,4,'b',0,'SIN RESPONDER'),(12,'<p><strong>&iquest; Cu&aacute; de estas cuatro cosas no puede agruparse con las dem&aacute;s ?</strong></p>\r\n<p><strong>a) tarta &nbsp; &nbsp; &nbsp;b) naranja &nbsp; &nbsp; c) pl&aacute;tano &nbsp; &nbsp; &nbsp;d) cereza &nbsp; &nbsp;</strong></p>',19,4,'a',0,'SIN RESPONDER'),(13,'<p><strong>&iquest;Qu&eacute; significa calmante?</strong></p>\r\n<p><strong>a) astringente &nbsp; &nbsp; &nbsp;b) absorbente &nbsp; &nbsp; c) sedante &nbsp; &nbsp; &nbsp;d) vehemente</strong></p>',19,4,'c',0,'SIN RESPONDER'),(14,'<p><strong>&iquest; Qu&eacute; significa aquiescencia?</strong></p>\r\n<p>a) cerilla &nbsp; &nbsp; b) cerdo &nbsp; &nbsp;ca) cerrado &nbsp; &nbsp; d) cereza</p>',19,4,'d',0,'SIN RESPONDER'),(15,'<p><strong>U&ntilde;as es a gato como para la abeja es a :</strong></p>\r\n<p>a) miel &nbsp; &nbsp; &nbsp;b) panal &nbsp; &nbsp; c) cera &nbsp; &nbsp; &nbsp;d) aguij&oacute;n</p>',19,4,'e',0,'SIN RESPONDER'),(16,'<p><strong>&iquest;Cu&aacute;l de las 4 opciones, es un ingrediente para mesclar semento?</strong></p>\r\n<p><strong>a) agua &nbsp; &nbsp; &nbsp;b) fierro &nbsp; &nbsp; &nbsp;c) aceite de carro &nbsp; &nbsp;d) n.a</strong></p>',20,4,'a',0,'SIN RESPONDER'),(17,'<p>&nbsp;<strong>&iquest;C&oacute;mo se llama la m&aacute;quina para mesclar cemento?</strong></p>\r\n<p><strong>a) mesclador &nbsp; &nbsp; &nbsp;b) trompo &nbsp; &nbsp; &nbsp;c) carrito mesclador &nbsp; &nbsp;d) n.a</strong></p>',20,4,'b',0,'SIN RESPONDER'),(18,'<p>&nbsp;</p>\r\n<p><strong><sub>&iquest;Cu&aacute;nto pesa un ladrillo de 24x7cm</sub></strong></p>\r\n<p>a) 3kg &nbsp; &nbsp; b) 2.20kg &nbsp; &nbsp; &nbsp;c) 1.5kg &nbsp; &nbsp;d) n.a</p>',20,4,'b',0,'SIN RESPONDER'),(19,'<p><strong><sub>&iquest;Cu&aacute;nto pesa un una bolsa de cemento seg&uacute;n las normas peruanas ?</sub></strong></p>\r\n<p>a) 32kg &nbsp; &nbsp; &nbsp;b) f38kg &nbsp; &nbsp; c) 42.5kg &nbsp; &nbsp; d) 50kg</p>',20,4,'c',0,'SIN RESPONDER'),(20,'<p><strong>&iquest;Qu&eacute; marca de cemento se utiliza para que el agua no filtre en las paredes?</strong></p>\r\n<p>&nbsp; &nbsp; a) pacasmayo b) sol c) aceite de carro &nbsp; &nbsp;d) andino</p>',20,4,'a',0,'SIN RESPONDER');
/*!40000 ALTER TABLE `pregunta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promedio_prueba`
--

DROP TABLE IF EXISTS `promedio_prueba`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promedio_prueba` (
  `resultado_candidato_prueba_id` int(11) NOT NULL AUTO_INCREMENT,
  `promedio` float DEFAULT '0',
  `prueba_id` int(11) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `doc_ID` varchar(20) DEFAULT NULL,
  `estado_promedio` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`resultado_candidato_prueba_id`),
  UNIQUE KEY `DOC_ID_prueba_id_uniq` (`doc_ID`,`prueba_id`),
  KEY `prueba_id` (`prueba_id`),
  CONSTRAINT `promedio_prueba_ibfk_1` FOREIGN KEY (`prueba_id`) REFERENCES `prueba` (`prueba_id`),
  CONSTRAINT `promedio_prueba_ibfk_2` FOREIGN KEY (`doc_ID`) REFERENCES `candidato` (`doc_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promedio_prueba`
--

LOCK TABLES `promedio_prueba` WRITE;
/*!40000 ALTER TABLE `promedio_prueba` DISABLE KEYS */;
INSERT INTO `promedio_prueba` VALUES (7,1,15,'CALIFICADO','45977448','I'),(8,1,18,'CALIFICADO','45977448','C'),(9,1,16,'CALIFICADO','45977448','I'),(10,3,15,'CALIFICADO','47741254','C'),(11,1,18,'CALIFICADO','47741254','C'),(12,3,16,'CALIFICADO','47741254','C'),(13,1,15,'CALIFICADO','46547854','I');
/*!40000 ALTER TABLE `promedio_prueba` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prueba`
--

DROP TABLE IF EXISTS `prueba`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prueba` (
  `prueba_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_prueba` varchar(100) NOT NULL,
  `instruccion` varchar(500) DEFAULT NULL,
  `tipo_prueba_id` int(11) DEFAULT NULL,
  `puesto_laboral_id` int(11) DEFAULT NULL,
  `duracion` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`prueba_id`),
  KEY `tipo_prueba_id` (`tipo_prueba_id`),
  KEY `puesto_laboral_id` (`puesto_laboral_id`),
  CONSTRAINT `prueba_ibfk_1` FOREIGN KEY (`tipo_prueba_id`) REFERENCES `tipo_prueba` (`tipo_prueba_id`),
  CONSTRAINT `prueba_ibfk_2` FOREIGN KEY (`puesto_laboral_id`) REFERENCES `puesto_laboral` (`puesto_laboral_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prueba`
--

LOCK TABLES `prueba` WRITE;
/*!40000 ALTER TABLE `prueba` DISABLE KEYS */;
INSERT INTO `prueba` VALUES (15,'Aptitud verbal','Responda lo mÃ¡s rÃ¡pido que pueda, pero siendo eficaz. Recuerde que solo tiene 9 minutos para este examen.',1,12,'15m'),(16,'PMOPK','--------------------',3,12,'8m'),(18,'Fluidez verbal','--------------------',1,12,'4m'),(19,'Aptitud verbal','A continuaciÃ³n le presentamos una serie de cuestiones que tratan de evaluar su comprensiÃ³n y razonamiento verbal.\r\n\r\nCada pregunta tiene cuatro respuestas, solo una es la correcta; debe agregar la respuesta su con el nÃºmero id de la pregunta.',1,13,'10m'),(20,'Materiales de construcciÃ³n','A continuaciÃ³n le presentamos una serie de cuestiones que tratan de evaluar sus conocimiento de los materiales de construcciÃ³n. Sea rÃ¡pido pero seguro.',3,13,'10m');
/*!40000 ALTER TABLE `prueba` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puesto_laboral`
--

DROP TABLE IF EXISTS `puesto_laboral`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `puesto_laboral` (
  `puesto_laboral_ID` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_puesto` varchar(100) NOT NULL,
  `edad` varchar(100) NOT NULL,
  `sexo` char(1) NOT NULL,
  `objetivo_puesto` varchar(200) NOT NULL,
  `funciones_puesto` varchar(1000) NOT NULL,
  `horario_trabajo` varchar(150) NOT NULL,
  `condiciones_trabajo` varchar(100) NOT NULL,
  `relaciones_sociales_internas` varchar(150) NOT NULL,
  `relaciones_sociales_externas` varchar(150) NOT NULL,
  `responsabilidades` varchar(250) NOT NULL,
  `equipo_de_trabajo` varchar(250) NOT NULL,
  `observaciones_finales` varchar(150) NOT NULL,
  `sueldo` int(11) NOT NULL,
  `deteccion_necesidad` varchar(500) NOT NULL,
  `formacion_deseable_id` int(11) DEFAULT NULL,
  `departamento_id` int(11) DEFAULT NULL,
  `convocatoria_id` int(11) DEFAULT NULL,
  `tipo_jornada` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`puesto_laboral_ID`),
  KEY `formacion_deseable_id` (`formacion_deseable_id`),
  KEY `departamento_id` (`departamento_id`),
  KEY `convocatoria_id` (`convocatoria_id`),
  CONSTRAINT `puesto_laboral_ibfk_1` FOREIGN KEY (`formacion_deseable_id`) REFERENCES `formacion_deseable` (`formacion_deseable_id`),
  CONSTRAINT `puesto_laboral_ibfk_2` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`departamento_id`),
  CONSTRAINT `puesto_laboral_ibfk_3` FOREIGN KEY (`convocatoria_id`) REFERENCES `convocatoria` (`convocatoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puesto_laboral`
--

LOCK TABLES `puesto_laboral` WRITE;
/*!40000 ALTER TABLE `puesto_laboral` DISABLE KEYS */;
INSERT INTO `puesto_laboral` VALUES (12,'Jefe de Proyectos','Entre 35 a 50 aÃ±os','A','Cumplir los requerimientos de los interesados del proyecto, travÃ©s de los estÃ¡ndares de su departamento y el cumplimiento de las leyes nacionales.','Supervisar y controlar que las operaciones del proyecto a su cargo sigan en marcha hacia su finalizaciÃ³n .','de 7 am a 1 pm y de 3 pm a 5 pm.','Muy buenas, contando con todas las herramientas necesarias para sus funciones.','Colaboradores de la empresa VICSAC, que estÃ©n trabajando con el proyecto.','Funcionarios pÃºblicos de provincias o departamentos, como son los alcaldes, regidores, gerentes de municipalidades, ingenieros, etc.','Responsable de coordinar con los interesados del proyecto, tanto de relaciones sociales internas como externas; y ademÃ¡s facilitar las tareas de su personal para lograr que cumplan sus objetivos.','Cuenta con una oficina equipada con herramientas tecnolÃ³gicas, materiales de escritorio, aire acondicionado, etc.','El contrato se le renueva cada 6 meses, dependiendo del cumplimiento de sus objetivos.',7500,'',NULL,14,23,'Tiempo completo'),(13,'Obreros','entre lo18 a 30 aÃ±os','H','Facilitar a la obra en su construcciÃ³n.','Mesclar cemento y cargar los ladrillos al piso correspondiente.','de 8 am a 1 pm y de 3 pm a 6 pm.','Muy buenas, ya que cuenta con herramientas de construcciÃ³n para desempeÃ±ar mejor sus actividades y','CompaÃ±eros del mismo nivel y jefe de obra.','ninguna.','Asegurar que el cemento estÃ© muy bien mezclado y ademÃ¡s asegurarse de tener un buen rendimiento en trasladar la carga de materiales de construcciÃ³n.','ContarÃ¡ con un uniforme lleno de herramintas Ãºtiles para sus actividades.','ninguna.',1500,'',NULL,14,23,'Tiempo completo');
/*!40000 ALTER TABLE `puesto_laboral` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respuesta_candidato`
--

DROP TABLE IF EXISTS `respuesta_candidato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `respuesta_candidato` (
  `RESPUESTA_CANDIDATO_ID` int(11) NOT NULL AUTO_INCREMENT,
  `respuesta` char(1) NOT NULL,
  `doc_id` varchar(20) NOT NULL,
  `puntaje_correcto` float DEFAULT NULL,
  `puntaje_incorrecto` float DEFAULT NULL,
  `estado` varchar(100) NOT NULL,
  `pregunta_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`RESPUESTA_CANDIDATO_ID`),
  UNIQUE KEY `DOC_ID_PREGUNTA_ID_uniq` (`doc_id`,`pregunta_id`),
  KEY `pregunta_id` (`pregunta_id`),
  CONSTRAINT `respuesta_candidato_ibfk_1` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`pregunta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respuesta_candidato`
--

LOCK TABLES `respuesta_candidato` WRITE;
/*!40000 ALTER TABLE `respuesta_candidato` DISABLE KEYS */;
INSERT INTO `respuesta_candidato` VALUES (7,'e','45977448',1,0,'Respuesta Correcta',2),(8,'a','45977448',NULL,0,'Respuesta Incorrecta',3),(9,'a','45977448',NULL,0,'Respuesta Incorrecta',4),(10,'c','45977448',1,0,'Respuesta Correcta',10),(11,'b','45977448',1,0,'Respuesta Correcta',5),(12,'e','47741254',1,0,'Respuesta Correcta',2),(13,'b','47741254',1,0,'Respuesta Correcta',3),(14,'c','47741254',1,0,'Respuesta Correcta',4),(15,'c','47741254',1,0,'Respuesta Correcta',10),(16,'b','47741254',1,0,'Respuesta Correcta',5),(17,'a','47741254',1,0,'Respuesta Correcta',6),(18,'e','47741254',1,0,'Respuesta Correcta',8),(19,'e','46547854',1,0,'Respuesta Correcta',2);
/*!40000 ALTER TABLE `respuesta_candidato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_prueba`
--

DROP TABLE IF EXISTS `tipo_prueba`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_prueba` (
  `tipo_prueba_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_prueba` varchar(100) NOT NULL,
  PRIMARY KEY (`tipo_prueba_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_prueba`
--

LOCK TABLES `tipo_prueba` WRITE;
/*!40000 ALTER TABLE `tipo_prueba` DISABLE KEYS */;
INSERT INTO `tipo_prueba` VALUES (1,'Prueba Específica'),(2,'Prueba de Prácticas Profesionales'),(3,'Prueba de Conocimiento');
/*!40000 ALTER TABLE `tipo_prueba` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `p_cuenta` varchar(8) NOT NULL,
  `p_clave` char(32) NOT NULL,
  `p_tipo` char(1) NOT NULL,
  `p_foto` varchar(50) DEFAULT NULL,
  `p_estado` char(1) DEFAULT 'P',
  `fecha_registro` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`p_cuenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('45977448','123','P','archivos/fotos/foto_45977448.jpg','P','2017-06-17 00:33:04'),('46547854','123','P','archivos/fotos/foto_46547854.png','P','2017-07-08 22:23:25'),('47741254','123','P','archivos/fotos/foto_47741254.jpg','P','2017-07-09 01:56:40'),('48485474','123','A','foto_12345678','A','2017-06-17 00:04:54');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'seleccionpersonal_bd'
--

--
-- Dumping routines for database 'seleccionpersonal_bd'
--
/*!50003 DROP PROCEDURE IF EXISTS `fn_actualizarConvocatoria2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `fn_actualizarConvocatoria2`(
                                       in p_convocatoria_id int,
                                       in p_estado varchar(100), 
                                       in p_nombre_convocatoria varchar(200), 
                                       in p_fecha_cronograma1 varchar(100),
                                       in p_fecha_cronograma2 varchar(100),
                                       in p_fecha_cronograma3 varchar(100),
                                       in p_fecha_cronograma4 varchar(100),
                                       in p_fecha_cronograma5 varchar(100)
                                        )
begin
							
 
    
-- ------------------------------------------------------------------------									
					update convocatoria
                    set nombre_convocatoria = p_nombre_convocatoria,
                    estado = p_estado
                    where convocatoria_id = p_convocatoria_id;
                    
                    update cronograma
                    set fecha_cronograma = p_fecha_cronograma1
                    where convocatoria_id = p_convocatoria_id and 
						  etapa_id = 1;
                    
                    update cronograma
                    set fecha_cronograma = p_fecha_cronograma2
                    where convocatoria_id = p_convocatoria_id and 
						  etapa_id = 2;
                    
                    update cronograma
                    set fecha_cronograma = p_fecha_cronograma3
                    where convocatoria_id = p_convocatoria_id and 
						  etapa_id = 3;
                    
                    update cronograma
                    set fecha_cronograma = p_fecha_cronograma4
                    where convocatoria_id = p_convocatoria_id and 
						  etapa_id = 4;
                    
                    update cronograma
                    set fecha_cronograma = p_fecha_cronograma5
                    where convocatoria_id = p_convocatoria_id and 
						  etapa_id = 5;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `fn_actualizarCriterio` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `fn_actualizarCriterio`(
									in p_ponderacion_deseable_minimo int,
                                    in p_ponderacion_deseable_maximo int,
                                    in p_valoracion int,
                                    in p_estado varchar(100),
                                   /* in p_ponderacion_deseable_minimo2 int,
                                    in p_ponderacion_deseable_maximo2 int,
                                    in p_valoracion2 int,
                                    in p_estado2 varchar(100),
                                    in p_ponderacion_deseable_minimo3 int,
                                    in p_ponderacion_deseable_maximo3 int,
                                    in p_valoracion3 int,
                                    in p_estado3 varchar(100),
                                    in p_ponderacion_deseable_minimo4 int,
                                    in p_ponderacion_deseable_maximo4 int,
                                    in p_valoracion4 int,
                                    in p_estado4 varchar(100),
                                    in p_ponderacion_deseable_minimo5 int,
                                    in p_ponderacion_deseable_maximo5 int,
                                    in p_valoracion5 int,
                                    in p_estado5 varchar(100),*/
                                    in p_nombre_prueba varchar(100), 
                                    -- in p_puesto_laboral_id int,
                                    in p_tipo_prueba_id int,
                                    in p_prueba_id int,
                                    in p_ponderacion_deseable_id int
									)
begin
-- ACTUALIZA EL REGISTRO DE LA PRUEBA        
        update 
			prueba
        set 
			nombre_prueba = p_nombre_prueba,
            tipo_prueba_id = p_tipo_prueba_id
		where
			prueba_id = p_prueba_id;
        -- 1
        
        update 
			ponderacion_deseable
        set 
			ponderacion_deseable_minimo = p_ponderacion_deseable_minimo,
            ponderacion_deseable_maximo = p_ponderacion_deseable_maximo,
            valoracion = p_valoracion,
            estado = p_estado,
            prueba_id = p_prueba_id
		where
			ponderacion_deseable_id = p_ponderacion_deseable_id;
 /*           
            -- 2
		update 
			ponderacion_deseable
        set 
			ponderacion_deseable_minimo = p_ponderacion_deseable_minimo2,
            ponderacion_deseable_maximo = p_ponderacion_deseable_maximo2,
            valoracion = p_valoracion2,
            estado = p_estado2,
            prueba_id = p_prueba_id
		where
            ponderacion_deseable_id = p_ponderacion_deseable_id;
            
            -- 3
		update 
			ponderacion_deseable
        set 
			ponderacion_deseable_minimo = p_ponderacion_deseable_minimo3,
            ponderacion_deseable_maximo = p_ponderacion_deseable_maximo3,
            valoracion = p_valoracion3,
            estado = p_estado3,
            prueba_id = p_prueba_id
		where
            ponderacion_deseable_id = p_ponderacion_deseable_id;
            -- 4
		update 
			ponderacion_deseable
        set 
			ponderacion_deseable_minimo = p_ponderacion_deseable_minimo4,
            ponderacion_deseable_maximo = p_ponderacion_deseable_maximo4,
            valoracion = p_valoracion4,
            estado = p_estado4,
            prueba_id = p_prueba_id
		where
            ponderacion_deseable_id = p_ponderacion_deseable_id;
            -- 5
		update 
			ponderacion_deseable
        set 
			ponderacion_deseable_minimo = p_ponderacion_deseable_minimo5,
            ponderacion_deseable_maximo = p_ponderacion_deseable_maximo5,
            valoracion = p_valoracion5,
            estado = p_estado5,
            prueba_id = p_prueba_id
		where
            ponderacion_deseable_id = p_ponderacion_deseable_id;
        */
 end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `fn_Actualizar_Estudios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `fn_Actualizar_Estudios`(
					in p_doc_id varchar(20),in p_estudio_candidato_id int,
					in p_institucion_educativa varchar(100),in p_titulo_estudio varchar(100),
					in p_grado_estudio varchar(12),in p_f_inicio date,
                    in p_f_fin date,in p_estado_estudios varchar(50)
										)
begin
	
								update estudio_candidato
								set 
									institucion_educativa = p_institucion_educativa,
									titulo_estudio = p_titulo_estudio,
									grado_estudio = p_grado_estudio,
                                    fecha_inicio = p_f_inicio,
                                    fecha_fin = p_f_fin,
                                    estado_estudios = p_estado_estudios
								where
									doc_id = p_doc_id and estudio_candidato_id = p_estudio_candidato_id;

end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `fn_Actualizar_Experiencia` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `fn_Actualizar_Experiencia`(
					in p_experiencia_laboral_id varchar(20),in p_rubro_empresa varchar(100),
					in p_empresa varchar(100),in p_puesto varchar(100),
					in p_lugar varchar(20),in p_descripcion_laboral varchar(500),
					in p_area varchar(100),in p_duracion varchar(100)
										)
begin
	
								update experiencia_laboral
								set 
									rubro_empresa = p_rubro_empresa,
									empresa = p_empresa,
									puesto = p_puesto, lugar = p_lugar,
                                    descripcion_laboral = p_descripcion_laboral, area = p_area,
                                    duracion = p_duracion
								where
									experiencia_labora_id = p_experiencia_laboral_id;

end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `fn_actualiza_puesto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `fn_actualiza_puesto`(

									in p_puesto_laboral_id int,in p_convocatoria_id int,in p_nombre_puesto varchar(100),
                                    in p_departamento_id int,
									in p_edad varchar(100),
									in p_sexo char(1),
									in p_objetivo_puesto varchar(200),
									in p_funciones_puesto varchar(1000),
									in p_horario_trabajo varchar(150),
									in p_condiciones_trabajo varchar(100),
									in p_relaciones_sociales_internas varchar(150),
									in p_relaciones_sociales_externas varchar(150),
									in p_responsabilidades varchar(250),
									in p_equipo_de_trabajo varchar(250),
									in p_observaciones_finales varchar(150),
                                    in p_tipo_jornada varchar(100),
									in p_sueldo int
								)
begin
-- DECLARE _puestoID int;
		
        -- set _puestoID = (select count(*) from puesto_laboral);
		
				update puesto_laboral 
							set  
								nombre_puesto = p_nombre_puesto,                           
								edad = p_edad,
								sexo = p_sexo,
								objetivo_puesto = p_objetivo_puesto,
								funciones_puesto = p_funciones_puesto,
								horario_trabajo = p_horario_trabajo,
								condiciones_trabajo = p_condiciones_trabajo,
								relaciones_sociales_internas = p_relaciones_sociales_internas,
								relaciones_sociales_externas = p_relaciones_sociales_externas,
								responsabilidades = p_responsabilidades,
								equipo_de_trabajo = p_equipo_de_trabajo,
								observaciones_finales = p_observaciones_finales,
                                tipo_jornada = p_tipo_jornada,
								sueldo = p_sueldo,
								departamento_id = p_departamento_id,
                                convocatoria_id = p_convocatoria_id
						where
							puesto_laboral_id = p_puesto_laboral_id;

end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `fn_actualzizarConvocatoria` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `fn_actualzizarConvocatoria`(
                                       in p_nombre_convocatoria varchar(200), 
                                       in p_fecha_cronograma1 varchar(100),
                                       in p_fecha_cronograma2 varchar(100),
                                       in p_fecha_cronograma3 varchar(100),
                                       in p_fecha_cronograma4 varchar(100),
                                       in p_fecha_cronograma5 varchar(100)
                                        )
begin
	
    DECLARE _convocatoria_id int;
	set _convocatoria_id = (select count(*) from convocatoria);
    
-- ------------------------------------------------------------------------									
					update convocatoria
                    set nombre_convocatoria = p_nombre_convocatoria
                    where convocatoria_id = _convocatoria_id;
                    
                    update cronograma
                    set fecha_cronograma = p_fecha_cronograma1
                    where convocatoria_id = _convocatoria_id and 
						  etapa_id = 1;
                    
                    update cronograma
                    set fecha_cronograma = p_fecha_cronograma2
                    where convocatoria_id = _convocatoria_id and 
						  etapa_id = 2;
                    
                    update cronograma
                    set fecha_cronograma = p_fecha_cronograma3
                    where convocatoria_id = _convocatoria_id and 
						  etapa_id = 3;
                    
                    update cronograma
                    set fecha_cronograma = p_fecha_cronograma4
                    where convocatoria_id = _convocatoria_id and 
						  etapa_id = 4;
                    
                    update cronograma
                    set fecha_cronograma = p_fecha_cronograma5
                    where convocatoria_id = _convocatoria_id and 
						  etapa_id = 5;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `fn_calificarPrueba` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `fn_calificarPrueba`(
									in p_doc_id varchar(20),
									in p_prueba_id int
                                   -- in p_puesto_id int,
                                    -- in p_tipo_puesto_id int
								)
begin
    
		DECLARE _promedio float;
        DECLARE _num_pruebas_correctas_prueba int;
        DECLARE _num_pruebas_correctas_candidato int;
			IF (
					SELECT 
						sum(r.puntaje_correcto) - sum(r.puntaje_incorrecto)
					FROM RESPUESTA_CANDIDATO r inner join pregunta p
					ON
						(r.pregunta_id = p.pregunta_id) inner join prueba u
					ON
						(p.prueba_id = u.prueba_id)
					WHERE
						r.doc_id =  p_doc_id  and u.prueba_id = p_prueba_id
							) IS NULL THEN
                          
                           insert into PROMEDIO_PRUEBA(promedio,prueba_id,estado,doc_id)
						 values( 0,p_prueba_id,'CALIFICADO',p_doc_id);
                         
						/*		UPDATE 
									PROMEDIO_PRUEBA
								SET 
									promedio = 0,
									prueba_id = p_prueba_id,
									estado = 'CALIFICADO'
								where 
									doc_id = p_doc_id;
				*/
			 ELSE
						SELECT 
							(sum(r.puntaje_correcto) - sum(r.puntaje_incorrecto)) into _promedio 
						FROM RESPUESTA_CANDIDATO r inner join pregunta p
						ON
							(r.pregunta_id = p.pregunta_id) inner join prueba u
						ON
							(p.prueba_id = u.prueba_id)
						WHERE
							r.doc_id =  p_doc_id  and u.prueba_id = p_prueba_id;
							
						 insert into PROMEDIO_PRUEBA(promedio,prueba_id,estado,doc_id)
						 values( _promedio,p_prueba_id,'CALIFICADO',p_doc_id);
						
							/* UPDATE 
								PROMEDIO_PRUEBA
							SET 
								promedio = _promedio,
								prueba_id = p_prueba_id,
								estado = 'CALIFICADO'
							where 
								doc_id = p_doc_id;
                                
                                */
					end if;			
                         IF (
								SELECT 
									DISTINCT PD.ESTADO
								FROM PROMEDIO_PRUEBA PP INNER JOIN PRUEBA P
								ON
									(PP.PRUEBA_ID = P.PRUEBA_ID) INNER JOIN PONDERACION_DESEABLE PD
								ON
									(P.PRUEBA_ID = PD.PRUEBA_ID)
								WHERE
									PP.DOC_ID = p_doc_id AND
									PP.PRUEBA_ID = p_prueba_id  AND
									PROMEDIO BETWEEN 
												PD.PONDERACION_DESEABLE_MINIMO and PD.PONDERACION_DESEABLE_MAXIMO
								  ) = 'I' THEN
										
											UPDATE 
												PROMEDIO_PRUEBA
											SET 
												estado_promedio = 'I'
											where 
												 doc_id = p_doc_id and
												prueba_id = p_prueba_id;
							
								ELSE
											UPDATE 
												PROMEDIO_PRUEBA
											SET 
												estado_promedio = 'C'
											where 
												doc_id = p_doc_id and
												prueba_id = p_prueba_id;
								end if;     
					
	END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `fn_cursor` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `fn_cursor`()
begin
-- DECLARO VARIABLES
 
 DECLARE exp varchar(100); -- JEFE DE PROYECTOS
 -- DECLARE done INT DEFAULT FALSE;
 DECLARE vb_termina BOOL DEFAULT FALSE;
 DECLARE cur1 cursor for SELECT experiencia_requerida FROM experiencia_requerida where puesto_laboral_id = 12; 
 DECLARE CONTINUE HANDLER 
       FOR SQLSTATE '02000'
       SET vb_termina = TRUE;
	open cur1;
    read_loop : LOOP
		fetch cur1 into exp;
        select exp;
	End LOOP;
    close cur1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `fn_eliminarConvocatoriaCronograma` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `fn_eliminarConvocatoriaCronograma`(
                                       in p_convocatoria_id int
                                        )
begin	
                       
                    /*   delete from cronograma
					where convocatoria_id = p_convocatoria_id;
                    
                    delete from convocatoria
					where convocatoria_id = p_convocatoria_id;
                      */ 
                       
                       
                    delete 
						r,
                        c
                    from 
						cronograma r LEFT JOIN convocatoria c
					on
						r.convocatoria_id = c.convocatoria_id
					where 
						r.convocatoria_id = p_convocatoria_id;
                    
				                    
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `fn_eliminarPuesto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `fn_eliminarPuesto`(
                                       in p_puesto_laboral_id int
                                        )
begin	
                    delete from puesto_laboral
					where puesto_laboral_id = p_puesto_laboral_id;
                    
                  
                    
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `fn_FiltroCurriculo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `fn_FiltroCurriculo`(
									in p_doc_id varchar(20),
									in p_puesto_laboral_id int,
									in p_tipo_jornada varchar(50),
									in p_estado_requerimientos varchar(50)
								)
begin
		 if p_tipo_jornada = (select tipo_jornada from puesto_laboral where puesto_laboral_id = p_puesto_laboral_id) and 
				   p_estado_requerimientos = 'Si' then
			if	
				(select experiencia_requerida from experiencia_requerida where puesto_laboral_id = p_puesto_laboral_id and experiencia_requerida not in 
                (select puesto from	experiencia_laboral where doc_id = p_doc_id )) IS NULL and 
                (select duracion from experiencia_requerida where puesto_laboral_id = p_puesto_laboral_id and duracion not in 
                (select duracion from experiencia_laboral where doc_id = p_doc_id )) IS NULL THEN 

					insert into postulacion(doc_id,nombre,estado,fecha_postulacion,puesto_laboral_id)
					values(
							p_doc_id,(
									select nombre from candidato where doc_id = p_doc_id
									),'CURRICULO APTO',(
													select date_format(now(),'%d/%m/%y a las %h:%i')as fecha),p_puesto_laboral_id
						  );
                          
							   -- insert into PROMEDIO_PRUEBA(doc_id)
							   -- values(p_doc_id);       
				else
					insert into postulacion(doc_id,nombre,estado,fecha_postulacion,puesto_laboral_id)
					values(
							p_doc_id,(
									select nombre from candidato where doc_id = p_doc_id
									),'CURRICULO NO APTO',(
													select date_format(now(),'%d/%m/%y a las %h:%i')as fecha),p_puesto_laboral_id
						  );
			end if;
		else
					insert into postulacion(doc_id,nombre,estado,fecha_postulacion,puesto_laboral_id)
					values(
							p_doc_id,(
									select nombre from candidato where doc_id = p_doc_id
									),'CURRICULO NO APTO',(
													select date_format(now(),'%d/%m/%y a las %h:%i')as fecha),p_puesto_laboral_id
						  );
			end if;
	END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `fn_guardarRespuesta` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `fn_guardarRespuesta`(
									in p_doc_id varchar(20),
									in p_pregunta_id int,
									in p_respuesta char(1)
								)
begin
    
		DECLARE _puntaje_correcto float;
        DECLARE _puntaje_incorrecto float;
        DECLARE _respuesta_correcta float;
		DECLARE _prueba_id int;

        
			SET _puntaje_correcto = (select puntaje from pregunta where pregunta_id = p_pregunta_id);
			SET _puntaje_incorrecto = (select puntaje_incorrecto from pregunta where pregunta_id = p_pregunta_id);
			SET _respuesta_correcta = (select respuesta from pregunta where pregunta_id = p_pregunta_id);
			SET _prueba_id = (select prueba_id from pregunta where pregunta_id = p_pregunta_id);
				
            
			-- -------------------- CONDICIONES IF -------------------------------		
                
					
                
                 IF (select respuesta from pregunta where pregunta_id = p_pregunta_id) = p_respuesta THEN
                
					insert into RESPUESTA_CANDIDATO(respuesta,doc_id,puntaje_correcto,puntaje_incorrecto,estado,pregunta_id)
					values(p_respuesta,p_doc_id,_puntaje_correcto,_puntaje_incorrecto,'Respuesta Correcta',p_pregunta_id);
				ELSEIF (select respuesta from pregunta where pregunta_id = p_pregunta_id) <> p_respuesta THEN
					insert into RESPUESTA_CANDIDATO(respuesta,doc_id,puntaje_incorrecto,estado,pregunta_id)
					values(p_respuesta,p_doc_id,_puntaje_incorrecto,'Respuesta Incorrecta',p_pregunta_id);
			    END IF;
                
	END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `fn_registrarCandidato` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `fn_registrarCandidato`(
					in op1 char(2), in op2 char(2), in p_doc_id varchar(20), in p_nombre varchar(100),
					in p_apellidos varchar(100), in p_direccion varchar(200), in p_celular varchar(20),
					in p_hijos varchar(2), in p_departamento_nacimiento varchar(50),
					in p_ciudad_nacimiento varchar(50), in p_estado_civil varchar(20),
					in p_sexo varchar(20), in p_edad char(2), in p_email varchar(200)
									)
begin

					if op1 = "Si" and op2 = "Si" then
					
							insert into candidato
									(
									doc_id,nombre,apellidos,direccion,celular,hijos,
									departamento_nacimiento,ciudad_nacimiento,estado_civil,
									sexo,edad,email,disposicion_laboral_id
									)
							values(
									p_doc_id,p_nombre,p_apellidos,p_direccion,p_celular,p_hijos,
									p_departamento_nacimiento,p_ciudad_nacimiento,p_estado_civil,
									p_sexo,p_edad,p_email,1
									);

					elseif op1 = "Si" and op2 = "No" then
						
							insert into candidato
									(
									doc_id,nombre,apellidos,direccion,celular,hijos,
									departamento_nacimiento,ciudad_nacimiento,estado_civil,
									sexo,edad,email,disposicion_laboral_id
									)
							values(
									p_doc_id,p_nombre,p_apellidos,p_direccion,p_celular,p_hijos,
									p_departamento_nacimiento,p_ciudad_nacimiento,p_estado_civil,
									p_sexo,p_edad,p_email,2
									);
						elseif op1 = "No" and op2 = "No" then
							
								insert into candidato
										(
										doc_id,nombre,apellidos,direccion,celular,hijos,
										departamento_nacimiento,ciudad_nacimiento,estado_civil,
										sexo,edad,email,disposicion_laboral_id
										)
								values(
										p_doc_id,p_nombre,p_apellidos,p_direccion,p_celular,p_hijos,
										p_departamento_nacimiento,p_ciudad_nacimiento,p_estado_civil,
										p_sexo,p_edad,p_email,3
										);
							elseif op1 = "No" and op2 = "Si" then
								
									insert into candidato
											(
											doc_id,nombre,apellidos,direccion,celular,hijos,
											departamento_nacimiento,ciudad_nacimiento,estado_civil,
											sexo,edad,email,disposicion_laboral_id
											)
									values(
											p_doc_id,p_nombre,p_apellidos,p_direccion,p_celular,p_hijos,
											p_departamento_nacimiento,p_ciudad_nacimiento,p_estado_civil,
											p_sexo,p_edad,p_email,4
											);
							end if;	

end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `fn_registrarConvocatoria` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `fn_registrarConvocatoria`(
                                       in p_nombre_convocatoria varchar(200), 
                                       in p_etapa1 varchar(100),
                                       in p_fecha_cronograma1 varchar(100),
                                       in p_etapa2 varchar(100),
                                       in p_fecha_cronograma2 varchar(100),
                                       in p_etapa3 varchar(100),
                                       in p_fecha_cronograma3 varchar(100),
                                       in p_etapa4 varchar(100),
                                       in p_fecha_cronograma4 varchar(100),
                                       in p_etapa5 varchar(100),
                                       in p_fecha_cronograma5 varchar(100)
                                        )
begin
	-- DECLARE _puesto_laboral_id int;
    DECLARE _convocatoria_id int;
	-- set _puesto_laboral_id = (select max(puesto_laboral_id) from puesto_laboral);
    
-- ------------------------------------------------------------------------									
					insert into convocatoria(nombre_convocatoria, estado)
                    values(p_nombre_convocatoria,'NP');
    set _convocatoria_id = (select max(convocatoria_id) from convocatoria);                
    
					-- update puesto_laboral
                    -- set convocatoria_id = _convocatoria_id
                    -- where puesto_laboral_id = _puesto_laboral_id;
                    insert into cronograma(fecha_cronograma,convocatoria_id,etapa_id)
                    values(p_fecha_cronograma1,_convocatoria_id,p_etapa1);
                    insert into cronograma(fecha_cronograma,convocatoria_id,etapa_id)
                    values(p_fecha_cronograma2,_convocatoria_id,p_etapa2);
                    insert into cronograma(fecha_cronograma,convocatoria_id,etapa_id)
                    values(p_fecha_cronograma3,_convocatoria_id,p_etapa3);
                    insert into cronograma(fecha_cronograma,convocatoria_id,etapa_id)
                    values(p_fecha_cronograma4,_convocatoria_id,p_etapa4);
                    insert into cronograma(fecha_cronograma,convocatoria_id,etapa_id)
                    values(p_fecha_cronograma5,_convocatoria_id,p_etapa5);
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `fn_registrarCriterio` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `fn_registrarCriterio`(
									in p_ponderacion_deseable_minimo1 int,
                                    in p_ponderacion_deseable_maximo1 int,
                                    in p_valoracion1 int,
                                    in p_estado1 varchar(100),
                                    in p_ponderacion_deseable_minimo2 int,
                                    in p_ponderacion_deseable_maximo2 int,
                                    in p_valoracion2 int,
                                    in p_estado2 varchar(100),
                                    in p_ponderacion_deseable_minimo3 int,
                                    in p_ponderacion_deseable_maximo3 int,
                                    in p_valoracion3 int,
                                    in p_estado3 varchar(100),
                                    in p_ponderacion_deseable_minimo4 int,
                                    in p_ponderacion_deseable_maximo4 int,
                                    in p_valoracion4 int,
                                    in p_estado4 varchar(100),
                                    in p_ponderacion_deseable_minimo5 int,
                                    in p_ponderacion_deseable_maximo5 int,
                                    in p_valoracion5 int,
                                    in p_estado5 varchar(100),
                                    in p_prueba_id int
                                  --  in p_nombre_prueba varchar(100),
                                  
                                 --   in p_tipo_prueba_id int
									)
begin    
        -- 1
		insert into ponderacion_deseable
									(
										ponderacion_deseable_minimo,
                                        ponderacion_deseable_maximo,
                                        valoracion,
                                        estado,
                                        prueba_id
									)
		values(
				p_ponderacion_deseable_minimo1,
                p_ponderacion_deseable_maximo1,
                p_valoracion1,
                p_estado1,
                p_prueba_id
			);
            -- 2
		insert into ponderacion_deseable
									(
										ponderacion_deseable_minimo,
                                        ponderacion_deseable_maximo,
                                        valoracion,
                                        estado,
                                        prueba_id
									)
		values(
				p_ponderacion_deseable_minimo2,
                p_ponderacion_deseable_maximo2,
                p_valoracion2,
                p_estado2,
                p_prueba_id
			);
            -- 3
		insert into ponderacion_deseable
									(
										ponderacion_deseable_minimo,
                                        ponderacion_deseable_maximo,
                                        valoracion,
                                        estado,
                                        prueba_id
									)
		values(
				p_ponderacion_deseable_minimo3,
                p_ponderacion_deseable_maximo3,
                p_valoracion3,
                p_estado3,
                p_prueba_id
			);
            -- 4
		insert into ponderacion_deseable
									(
										ponderacion_deseable_minimo,
                                        ponderacion_deseable_maximo,
                                        valoracion,
                                        estado,
                                        prueba_id
									)
		values(
				p_ponderacion_deseable_minimo4,
                p_ponderacion_deseable_maximo4,
                p_valoracion4,
                p_estado4,
                p_prueba_id
			);
            -- 5
		insert into ponderacion_deseable
									(
										ponderacion_deseable_minimo,
                                        ponderacion_deseable_maximo,
                                        valoracion,
                                        estado,
                                        prueba_id
									)
		values(
				p_ponderacion_deseable_minimo5,
                p_ponderacion_deseable_maximo5,
                p_valoracion5,
                p_estado5,
                p_prueba_id
			);
        
 end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `fn_registrarPuesto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `fn_registrarPuesto`(
                            in p_departamento_id int,in p_convocatoria_id int,in p_nombre_puesto varchar(100),in p_edad varchar(100),
                            in p_sexo char(1),in p_objetivo_puesto varchar(200),
                            in p_funciones_puesto varchar(1000),in p_horario_trabajo varchar(150),
                            in p_condiciones_trabajo varchar(100),in p_relaciones_sociales_internas varchar(150),
                            in p_relaciones_sociales_externas varchar(150),in p_responsabilidades varchar(250),
                            in p_equipo_de_trabajo varchar(250),in p_observaciones_finales varchar(150),
                            in p_tipo_jornada varchar(100), in p_sueldo int
                            
                            )
begin
				insert into PUESTO_LABORAL
									(
                                    nombre_puesto,edad,sexo,objetivo_puesto,funciones_puesto,
                                    horario_trabajo,condiciones_trabajo,relaciones_sociales_internas,
                                    relaciones_sociales_externas,responsabilidades, equipo_de_trabajo,
									observaciones_finales,tipo_jornada,sueldo,departamento_id,convocatoria_id
									)
				values
					(
                    p_nombre_puesto,p_edad,p_sexo,p_objetivo_puesto,p_funciones_puesto,p_horario_trabajo,
					p_condiciones_trabajo,p_relaciones_sociales_internas,
                    p_relaciones_sociales_externas,p_responsabilidades,
                    p_equipo_de_trabajo,p_observaciones_finales,p_tipo_jornada,p_sueldo,p_departamento_id,
                    p_convocatoria_id
					);
                    
                

end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `fn_Registrar_Estudios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `fn_Registrar_Estudios`(
					in p_doc_id varchar(20),
					in p_institucion_educativa varchar(100),in p_titulo_estudio varchar(100),
					in p_grado_estudio varchar(20),in p_f_inicio date,
                    in p_f_fin date,in p_estado_estudios varchar(50)
										)
begin

DECLARE specialty CONDITION FOR SQLSTATE '45000'; 
								IF p_f_inicio < p_f_fin THEN
				
									insert into estudio_candidato
												(
												institucion_educativa,titulo_estudio,grado_estudio,
												fecha_inicio,fecha_fin, doc_id,estado_estudios
												)
									values (
											p_institucion_educativa,p_titulo_estudio,p_grado_estudio,
											p_f_inicio,p_f_fin,p_doc_id,p_estado_estudios
											);
								 ELSE
									 SIGNAL SQLSTATE '45000'
									 SET MESSAGE_TEXT = 'Error: La fecha de inicio es mayor a la fecha fin!';
								end if;

end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `fn_Registrar_Experiencia` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `fn_Registrar_Experiencia`(
					in p_doc_id varchar(20),in p_rubro_empresa varchar(100),
					in p_empresa varchar(100),in p_puesto varchar(100),
					in p_lugar varchar(20),in p_descripcion_laboral varchar(500),
					in p_area varchar(100),in p_duracion varchar(100)
										)
begin
	
					insert into experiencia_laboral
								(
                                rubro_empresa,empresa,puesto,lugar,
                                descripcion_laboral,area,duracion,doc_id
                                )
					values (
							p_rubro_empresa,p_empresa,p_puesto,p_lugar,
                            p_descripcion_laboral,p_area,p_duracion,p_doc_id
                            );

end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `fn_seleccion_finalistas1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `fn_seleccion_finalistas1`(
									 in p_doc_id varchar(20),
									-- in p_prueba_id int,
                                    in p_puesto_id int
                                    -- in p_tipo_puesto_id int
								)
begin
    
		DECLARE _num_prueba int;
        DECLARE _num_pruebas_correctas_candidato int;
        DECLARE specialty CONDITION FOR SQLSTATE '45000';  
							
                            
                            
                            select 
								count(*) into _num_prueba
							from
								prueba
							where
								puesto_laboral_id = p_puesto_id;
						
							
							select 
								count(*) into _num_pruebas_correctas_candidato
							from
								promedio_prueba pp inner join prueba p
							on
								( pp.prueba_id = p.prueba_id ) inner join puesto_laboral pl
							on
								( p.puesto_laboral_id = pl.puesto_laboral_id)
							where
								pl.puesto_laboral_id = p_puesto_id and
								pp.estado_promedio = 'C' and
								pp.doc_id = p_doc_id;
                                
                                
                                
                                 IF	( _num_pruebas_correctas_candidato =  _num_prueba) THEN
					
						
									INSERT INTO FINALISTA (doc_id,nombres,apellidos,email,celular,puesto_laboral_id)
									values(p_doc_id, (select nombre from candidato where doc_id = p_doc_id),
										  (select apellidos from candidato where doc_id = p_doc_id),
										  (select email from candidato where doc_id = p_doc_id),
										  (select celular from candidato where doc_id = p_doc_id),p_puesto_id 
										  );
								-- ELSE
									-- SIGNAL SQLSTATE '45000'
									-- SET MESSAGE_TEXT = 'LO SENTIMOS!, USTED NO A SIDO SELECCIONADO.';
                                    
								END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_para_probar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_para_probar`(
										-- in p_doc_id varchar(20),
										in p_puesto_laboral_id int
									-- in p_tipo_jornada varchar(50),
										-- in p_estado_requerimientos varchar(50)
										)
begin
	-- declaracion de variables locales
	declare p_du int;
    declare p_req1 varchar(100);/*
	declare p_req2 varchar(100);
	declare p_req3 varchar(100);
	declare p_req4 varchar(100);
	declare p_req5 varchar(100);
	declare p_req6 varchar(100);
	declare p_req7 varchar(100);*/
	declare no_hay_mas_registros int default 0;
	declare elCursor cursor for
	SELECT experiencia_requerida, duracion FROM experiencia_requerida where puesto_laboral_id = p_puesto_laboral_id; 
	declare continue handler for not found set no_hay_mas_registros = 1;
	-- tabla temporal
	drop temporary table if exists tablatemporal;
	create temporary table tablaTemp_requerimientoRequerido 
    (
      `experiencia_requerida1` varchar(100) default null,
      `duracion1` int default null,
	  `experiencia_requerida2` varchar(100) default null,
      `duracion2` int default null,
	  `experiencia_requerida3` varchar(100) default null,
      `duracion3` int default null,
	  `experiencia_requerida4` varchar(100) default null,
      `duracion4` int default null,
	  `experiencia_requerida5` varchar(100) default null,
      `duracion5` int default null,
	  `experiencia_requerida6` varchar(100) default null,
      `duracion6` int default null,
	  `experiencia_requerida7` varchar(100) default null,
      `duracion7` int default null
    );
	-- se abre el cursor
		open elCursor;
		-- se van tomando los datos hasta que el cursor llegue al final
		bucle: loop
			fetch elCursor into p_req1, p_du;
			if (no_hay_mas_registros = 1) then
				leave bucle;
			end if;
			-- se cargan los datos en la tabla temporal
			 insert tablaTemp_requerimientoRequerido
												(
												experiencia_requerida1,duracion1
                                                ) 
			values (p_req1,p_du);
            
             insert tablaTemp_requerimientoRequerido
												(
												experiencia_requerida2,duracion1
                                                ) 
			values (p_req1,p_du);
        
		end loop bucle;
		close elCursor;
		select * from tablaTemp_requerimientoRequerido;
		drop temporary table if exists tablaTemp_requerimientoRequerido;
	end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-25 12:56:10
