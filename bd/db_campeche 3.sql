CREATE DATABASE  IF NOT EXISTS `campeche` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `campeche`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: campeche
-- ------------------------------------------------------
-- Server version	5.7.12-log

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
  `id` int(11) NOT NULL,
  `turista_username` varchar(100) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `fechainicio` datetime DEFAULT NULL,
  `fechafin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_actividad_turista1_idx` (`turista_username`),
  CONSTRAINT `fk_actividad_turista1` FOREIGN KEY (`turista_username`) REFERENCES `turista` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividad`
--

LOCK TABLES `actividad` WRITE;
/*!40000 ALTER TABLE `actividad` DISABLE KEYS */;
/*!40000 ALTER TABLE `actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `authorities`
--

DROP TABLE IF EXISTS `authorities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authorities` (
  `username` varchar(50) NOT NULL,
  `authority` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`username`),
  CONSTRAINT `fk_authorities_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authorities`
--

LOCK TABLES `authorities` WRITE;
/*!40000 ALTER TABLE `authorities` DISABLE KEYS */;
/*!40000 ALTER TABLE `authorities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calificacion`
--

DROP TABLE IF EXISTS `calificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calificacion` (
  `id_comentario` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `comentario` varchar(500) DEFAULT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `fecha_creacion` varchar(45) DEFAULT NULL,
  `turista_username` varchar(100) NOT NULL,
  PRIMARY KEY (`id_comentario`),
  KEY `fk_calificacion_turista1_idx` (`turista_username`),
  CONSTRAINT `fk_calificacion_turista1` FOREIGN KEY (`turista_username`) REFERENCES `turista` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calificacion`
--

LOCK TABLES `calificacion` WRITE;
/*!40000 ALTER TABLE `calificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `calificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `codigo_qr`
--

DROP TABLE IF EXISTS `codigo_qr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `codigo_qr` (
  `id_codigo_qr` int(11) NOT NULL,
  `id_cupon` int(11) NOT NULL,
  `turista_username` varchar(100) NOT NULL,
  `canjeado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_codigo_qr`,`id_cupon`),
  KEY `fk_codigo_qr_cupon_idx` (`id_cupon`),
  KEY `fk_codigo_qr_turista1_idx` (`turista_username`),
  CONSTRAINT `fk_codigo_qr_cupon` FOREIGN KEY (`id_cupon`) REFERENCES `cupon` (`id_cupon`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_codigo_qr_turista1` FOREIGN KEY (`turista_username`) REFERENCES `turista` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `codigo_qr`
--

LOCK TABLES `codigo_qr` WRITE;
/*!40000 ALTER TABLE `codigo_qr` DISABLE KEYS */;
/*!40000 ALTER TABLE `codigo_qr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentario_rechazo`
--

DROP TABLE IF EXISTS `comentario_rechazo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comentario_rechazo` (
  `id_comentario_rechazo` int(11) NOT NULL AUTO_INCREMENT,
  `id_informacion_sitio` int(11) NOT NULL,
  `comentario` varchar(500) DEFAULT NULL,
  `fecha_publicacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id_comentario_rechazo`),
  KEY `fk_comentario_rechazo_informacion_sitio1_idx` (`id_informacion_sitio`),
  CONSTRAINT `fk_comentario_rechazo_informacion_sitio1` FOREIGN KEY (`id_informacion_sitio`) REFERENCES `revision_informacion` (`id_revision_informacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentario_rechazo`
--

LOCK TABLES `comentario_rechazo` WRITE;
/*!40000 ALTER TABLE `comentario_rechazo` DISABLE KEYS */;
/*!40000 ALTER TABLE `comentario_rechazo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentario_rechazo_paquete`
--

DROP TABLE IF EXISTS `comentario_rechazo_paquete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comentario_rechazo_paquete` (
  `id` int(11) NOT NULL,
  `idpaquete` int(11) NOT NULL,
  `comentario_rechazo` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`,`idpaquete`),
  KEY `fk_comentariopaquete_paquete1_idx` (`idpaquete`),
  CONSTRAINT `fk_comentariopaquete_paquete1` FOREIGN KEY (`idpaquete`) REFERENCES `paquete` (`id_paquete`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentario_rechazo_paquete`
--

LOCK TABLES `comentario_rechazo_paquete` WRITE;
/*!40000 ALTER TABLE `comentario_rechazo_paquete` DISABLE KEYS */;
/*!40000 ALTER TABLE `comentario_rechazo_paquete` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cupon`
--

DROP TABLE IF EXISTS `cupon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cupon` (
  `id_cupon` int(11) NOT NULL,
  `id_revision_objeto` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion_corta` varchar(150) NOT NULL,
  `descripcion_larga` varchar(500) NOT NULL,
  `id_imagen_extra` varchar(12) DEFAULT NULL,
  `vigencia` datetime NOT NULL,
  `terminos_y_condiciones` varchar(250) NOT NULL,
  PRIMARY KEY (`id_cupon`,`id_revision_objeto`),
  KEY `fk_cupon_revision_objeto1_idx` (`id_revision_objeto`),
  CONSTRAINT `fk_cupon_revision_objeto1` FOREIGN KEY (`id_revision_objeto`) REFERENCES `revision_objeto` (`id_revision_objeto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cupon`
--

LOCK TABLES `cupon` WRITE;
/*!40000 ALTER TABLE `cupon` DISABLE KEYS */;
/*!40000 ALTER TABLE `cupon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `descripcion_idioma`
--

DROP TABLE IF EXISTS `descripcion_idioma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `descripcion_idioma` (
  `id_revision_informacion` int(11) NOT NULL,
  `lang_code` char(5) NOT NULL,
  `descripcion_larga` varchar(500) NOT NULL,
  `descripcion_corta` varchar(150) NOT NULL,
  PRIMARY KEY (`lang_code`,`id_revision_informacion`),
  KEY `fk_descripcion_idioma_revision_informacion1_idx` (`id_revision_informacion`),
  CONSTRAINT `fk_descripcion_idioma_revision_informacion1` FOREIGN KEY (`id_revision_informacion`) REFERENCES `revision_informacion` (`id_revision_informacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `descripcion_idioma`
--

LOCK TABLES `descripcion_idioma` WRITE;
/*!40000 ALTER TABLE `descripcion_idioma` DISABLE KEYS */;
/*!40000 ALTER TABLE `descripcion_idioma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `id_plan` int(11) NOT NULL,
  `id_sector` int(11) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `telefono1` varchar(15) NOT NULL,
  `telefono2` varchar(15) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `numero_empleados` int(11) DEFAULT NULL,
  `propietario` varchar(250) DEFAULT NULL,
  `tamano` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_empresa`),
  KEY `fk_empresa_sector_idx` (`id_sector`),
  KEY `fk_empresa_plan1_idx` (`id_plan`),
  CONSTRAINT `fk_empresa_plan1` FOREIGN KEY (`id_plan`) REFERENCES `plan` (`id_plan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresa_sector1` FOREIGN KEY (`id_sector`) REFERENCES `sector` (`id_sector`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa_paquete`
--

DROP TABLE IF EXISTS `empresa_paquete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresa_paquete` (
  `idempresa` int(11) NOT NULL,
  `idpaquete` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idempresa`,`idpaquete`),
  KEY `fk_empresa_has_paquete_paquete1_idx` (`idpaquete`),
  KEY `fk_empresa_has_paquete_empresa1_idx` (`idempresa`),
  CONSTRAINT `fk_empresa_has_paquete_empresa1` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`id_empresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresa_has_paquete_paquete1` FOREIGN KEY (`idpaquete`) REFERENCES `paquete` (`id_paquete`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa_paquete`
--

LOCK TABLES `empresa_paquete` WRITE;
/*!40000 ALTER TABLE `empresa_paquete` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresa_paquete` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evento`
--

DROP TABLE IF EXISTS `evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evento` (
  `id_evento` int(11) NOT NULL AUTO_INCREMENT,
  `id_sitio` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `fecha` varchar(45) DEFAULT NULL,
  `hora` varchar(45) DEFAULT NULL,
  `lugar` varchar(45) DEFAULT NULL,
  `costo` varchar(45) DEFAULT NULL,
  `beneficiario` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_evento`,`id_sitio`),
  KEY `fk_evento_establecimiento1_idx` (`id_sitio`),
  CONSTRAINT `fk_evento_establecimiento1` FOREIGN KEY (`id_sitio`) REFERENCES `sitio` (`id_sitio`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento`
--

LOCK TABLES `evento` WRITE;
/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
/*!40000 ALTER TABLE `evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `geocercas`
--

DROP TABLE IF EXISTS `geocercas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `geocercas` (
  `category_id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `Poligono` polygon DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `geocercas`
--

LOCK TABLES `geocercas` WRITE;
/*!40000 ALTER TABLE `geocercas` DISABLE KEYS */;
/*!40000 ALTER TABLE `geocercas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `informacion_sitio`
--

DROP TABLE IF EXISTS `informacion_sitio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `informacion_sitio` (
  `id_informacion_sitio` int(11) NOT NULL AUTO_INCREMENT,
  `id_revision_informacion` int(11) NOT NULL,
  `ubicacionGIS` point NOT NULL,
  `fecha_actualizacion` datetime NOT NULL,
  `url_audioguia` varchar(500) DEFAULT NULL,
  `url_carta` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_informacion_sitio`,`id_revision_informacion`),
  KEY `fk_ubicacion_informacion_sitio1_idx` (`id_revision_informacion`),
  CONSTRAINT `fk_ubicacion_informacion_sitio1` FOREIGN KEY (`id_revision_informacion`) REFERENCES `revision_informacion` (`id_revision_informacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `informacion_sitio`
--

LOCK TABLES `informacion_sitio` WRITE;
/*!40000 ALTER TABLE `informacion_sitio` DISABLE KEYS */;
/*!40000 ALTER TABLE `informacion_sitio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `municipios`
--

DROP TABLE IF EXISTS `municipios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `municipios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `municipios`
--

LOCK TABLES `municipios` WRITE;
/*!40000 ALTER TABLE `municipios` DISABLE KEYS */;
/*!40000 ALTER TABLE `municipios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pais`
--

DROP TABLE IF EXISTS `pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pais` (
  `id_pais` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id_pais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pais`
--

LOCK TABLES `pais` WRITE;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paquete`
--

DROP TABLE IF EXISTS `paquete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paquete` (
  `id_paquete` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_paquete`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paquete`
--

LOCK TABLES `paquete` WRITE;
/*!40000 ALTER TABLE `paquete` DISABLE KEYS */;
/*!40000 ALTER TABLE `paquete` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plan`
--

DROP TABLE IF EXISTS `plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plan` (
  `id_plan` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `costo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_plan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plan`
--

LOCK TABLES `plan` WRITE;
/*!40000 ALTER TABLE `plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planificador`
--

DROP TABLE IF EXISTS `planificador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `planificador` (
  `idevento` int(11) NOT NULL,
  `idturista` int(11) NOT NULL,
  PRIMARY KEY (`idevento`,`idturista`),
  KEY `fk_planificador_evento1_idx` (`idevento`),
  CONSTRAINT `fk_planificador_evento1` FOREIGN KEY (`idevento`) REFERENCES `evento` (`id_evento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planificador`
--

LOCK TABLES `planificador` WRITE;
/*!40000 ALTER TABLE `planificador` DISABLE KEYS */;
/*!40000 ALTER TABLE `planificador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rango_ventas`
--

DROP TABLE IF EXISTS `rango_ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rango_ventas` (
  `id_rango_ventas` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_rango_ventas`,`id_empresa`),
  KEY `fk_rango_ventas_empresa1_idx` (`id_empresa`),
  CONSTRAINT `fk_rango_ventas_empresa1` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rango_ventas`
--

LOCK TABLES `rango_ventas` WRITE;
/*!40000 ALTER TABLE `rango_ventas` DISABLE KEYS */;
/*!40000 ALTER TABLE `rango_ventas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `revision_informacion`
--

DROP TABLE IF EXISTS `revision_informacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `revision_informacion` (
  `id_revision_informacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_sitio` int(11) NOT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `url_sitio_web` varchar(500) DEFAULT NULL,
  `id_imagen_perfil` varchar(12) DEFAULT NULL,
  `id_logo` varchar(12) DEFAULT NULL,
  `id_carta` varchar(12) DEFAULT NULL,
  `ubicacionGIS` point DEFAULT NULL,
  PRIMARY KEY (`id_revision_informacion`),
  KEY `fk_informacion_sitio_sitio1_idx` (`id_sitio`),
  CONSTRAINT `fk_informacion_sitio_sitio1` FOREIGN KEY (`id_sitio`) REFERENCES `sitio` (`id_sitio`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `revision_informacion`
--

LOCK TABLES `revision_informacion` WRITE;
/*!40000 ALTER TABLE `revision_informacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `revision_informacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `revision_objeto`
--

DROP TABLE IF EXISTS `revision_objeto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `revision_objeto` (
  `id_revision_objeto` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  PRIMARY KEY (`id_revision_objeto`),
  KEY `fk_empresa_has_revision_empresa1_idx` (`id_empresa`),
  CONSTRAINT `fk_empresa_has_revision_empresa1` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `revision_objeto`
--

LOCK TABLES `revision_objeto` WRITE;
/*!40000 ALTER TABLE `revision_objeto` DISABLE KEYS */;
/*!40000 ALTER TABLE `revision_objeto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sector`
--

DROP TABLE IF EXISTS `sector`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sector` (
  `id_sector` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_sector`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sector`
--

LOCK TABLES `sector` WRITE;
/*!40000 ALTER TABLE `sector` DISABLE KEYS */;
/*!40000 ALTER TABLE `sector` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sitio`
--

DROP TABLE IF EXISTS `sitio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sitio` (
  `id_sitio` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `municipios_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `telefono1` varchar(15) DEFAULT NULL,
  `telefono2` varchar(15) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `horario` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_sitio`),
  KEY `fk_establecimiento_empresa1_idx` (`id_empresa`),
  KEY `fk_establecimiento_municipios1_idx` (`municipios_id`),
  CONSTRAINT `fk_establecimiento_empresa1` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_establecimiento_municipios1` FOREIGN KEY (`municipios_id`) REFERENCES `municipios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sitio`
--

LOCK TABLES `sitio` WRITE;
/*!40000 ALTER TABLE `sitio` DISABLE KEYS */;
/*!40000 ALTER TABLE `sitio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sitio_has_calificacion`
--

DROP TABLE IF EXISTS `sitio_has_calificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sitio_has_calificacion` (
  `calificacion_id_comentario` int(11) NOT NULL,
  `id_sitio` int(11) NOT NULL,
  PRIMARY KEY (`calificacion_id_comentario`),
  KEY `fk_empresa_has_calificacion_calificacion1_idx` (`calificacion_id_comentario`),
  KEY `fk_sitio_has_calificacion_sitio1_idx` (`id_sitio`),
  CONSTRAINT `fk_empresa_has_calificacion_calificacion1` FOREIGN KEY (`calificacion_id_comentario`) REFERENCES `calificacion` (`id_comentario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sitio_has_calificacion_sitio1` FOREIGN KEY (`id_sitio`) REFERENCES `sitio` (`id_sitio`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sitio_has_calificacion`
--

LOCK TABLES `sitio_has_calificacion` WRITE;
/*!40000 ALTER TABLE `sitio_has_calificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `sitio_has_calificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `sitio_info`
--

DROP TABLE IF EXISTS `sitio_info`;
/*!50001 DROP VIEW IF EXISTS `sitio_info`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `sitio_info` AS SELECT 
 1 AS `id_sitio`,
 1 AS `id_empresa`,
 1 AS `municipios_id`,
 1 AS `nombre`,
 1 AS `direccion`,
 1 AS `telefono1`,
 1 AS `telefono2`,
 1 AS `capacidad`,
 1 AS `horario`,
 1 AS `id_sector`,
 1 AS `sector`,
 1 AS `ubicacionGIS`,
 1 AS `id_carta`,
 1 AS `descripcion_larga`,
 1 AS `descripcion_corta`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `tema_interes`
--

DROP TABLE IF EXISTS `tema_interes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tema_interes` (
  `id_tema_interes` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tema_interes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tema_interes`
--

LOCK TABLES `tema_interes` WRITE;
/*!40000 ALTER TABLE `tema_interes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tema_interes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tema_interes_turista`
--

DROP TABLE IF EXISTS `tema_interes_turista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tema_interes_turista` (
  `id_tema_interes` int(11) NOT NULL,
  `turista_username` varchar(100) NOT NULL,
  PRIMARY KEY (`id_tema_interes`,`turista_username`),
  KEY `fk_tema_interes_turista_tema_interes_idx` (`id_tema_interes`),
  KEY `fk_tema_interes_turista_turista1_idx` (`turista_username`),
  CONSTRAINT `fk_tema_interes_turista_turista1` FOREIGN KEY (`turista_username`) REFERENCES `turista` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_turista_has_tema_interes_tema_interes1` FOREIGN KEY (`id_tema_interes`) REFERENCES `tema_interes` (`id_tema_interes`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tema_interes_turista`
--

LOCK TABLES `tema_interes_turista` WRITE;
/*!40000 ALTER TABLE `tema_interes_turista` DISABLE KEYS */;
/*!40000 ALTER TABLE `tema_interes_turista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `token` (
  `token` varchar(45) NOT NULL,
  `username` varchar(100) NOT NULL,
  `vigencia` datetime NOT NULL,
  PRIMARY KEY (`username`,`token`),
  KEY `fk_token_users1_idx` (`username`),
  CONSTRAINT `fk_token_users1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `token`
--

LOCK TABLES `token` WRITE;
/*!40000 ALTER TABLE `token` DISABLE KEYS */;
/*!40000 ALTER TABLE `token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turista`
--

DROP TABLE IF EXISTS `turista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `turista` (
  `username` varchar(100) NOT NULL,
  `id_pais` int(11) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `ciudad_procedencia` varchar(50) DEFAULT NULL,
  `primera_visita` tinyint(1) DEFAULT NULL,
  `dias_en_el_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`),
  KEY `fk_turista_usuario1_idx` (`username`),
  KEY `fk_turista_1_idx` (`id_pais`),
  CONSTRAINT `fk_turista_1` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id_pais`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_turista_usuario1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turista`
--

LOCK TABLES `turista` WRITE;
/*!40000 ALTER TABLE `turista` DISABLE KEYS */;
/*!40000 ALTER TABLE `turista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_empresa`
--

DROP TABLE IF EXISTS `usuario_empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_empresa` (
  `id_empresa` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  PRIMARY KEY (`id_empresa`,`username`),
  KEY `fk_usuario_empresa_usuario_idx` (`username`),
  KEY `fk_usuario_empresa_empresa_idx` (`id_empresa`),
  CONSTRAINT `fk_empresa_has_usuario_empresa1` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresa_has_usuario_usuario1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_empresa`
--

LOCK TABLES `usuario_empresa` WRITE;
/*!40000 ALTER TABLE `usuario_empresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vacante`
--

DROP TABLE IF EXISTS `vacante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vacante` (
  `id_vacante` int(11) NOT NULL,
  `id_revision_objeto` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `salario` varchar(45) DEFAULT NULL,
  `horario` varchar(45) DEFAULT NULL,
  `escolaridad` varchar(45) DEFAULT NULL,
  `habilidades` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `temporal` tinyint(1) DEFAULT NULL,
  `tiempo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_vacante`),
  KEY `fk_vacante_revision_objeto1_idx` (`id_revision_objeto`),
  CONSTRAINT `fk_vacante_revision_objeto1` FOREIGN KEY (`id_revision_objeto`) REFERENCES `revision_objeto` (`id_revision_objeto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vacante`
--

LOCK TABLES `vacante` WRITE;
/*!40000 ALTER TABLE `vacante` DISABLE KEYS */;
/*!40000 ALTER TABLE `vacante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video` (
  `id_video` int(11) NOT NULL,
  `id_revision_objeto` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `precio` double NOT NULL,
  `fecha_subida` datetime NOT NULL,
  `id_img_preview` varchar(12) NOT NULL,
  `id_video_archivo` varchar(12) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_video`),
  KEY `fk_video_revision_objeto1_idx` (`id_revision_objeto`),
  CONSTRAINT `fk_video_revision_objeto1` FOREIGN KEY (`id_revision_objeto`) REFERENCES `revision_objeto` (`id_revision_objeto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_turista`
--

DROP TABLE IF EXISTS `video_turista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video_turista` (
  `id` int(11) NOT NULL,
  `turista_idusuario` varchar(25) NOT NULL,
  PRIMARY KEY (`id`,`turista_idusuario`),
  KEY `fk_video_has_turista_turista1_idx` (`turista_idusuario`),
  KEY `fk_video_has_turista_video1_idx` (`id`),
  CONSTRAINT `fk_video_has_turista_turista1` FOREIGN KEY (`turista_idusuario`) REFERENCES `turista` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_video_has_turista_video1` FOREIGN KEY (`id`) REFERENCES `video` (`id_video`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_turista`
--

LOCK TABLES `video_turista` WRITE;
/*!40000 ALTER TABLE `video_turista` DISABLE KEYS */;
/*!40000 ALTER TABLE `video_turista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_usuario`
--

DROP TABLE IF EXISTS `video_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video_usuario` (
  `id_video` int(11) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  PRIMARY KEY (`id_video`,`usuario`),
  KEY `fk_video_usuario_idx` (`usuario`),
  KEY `fk_video_usuario_id1` (`id_video`),
  CONSTRAINT `fk_video_has_usuario_usuario1` FOREIGN KEY (`usuario`) REFERENCES `users` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_video_has_usuario_video1` FOREIGN KEY (`id_video`) REFERENCES `video` (`id_video`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_usuario`
--

LOCK TABLES `video_usuario` WRITE;
/*!40000 ALTER TABLE `video_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `video_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `sitio_info`
--

/*!50001 DROP VIEW IF EXISTS `sitio_info`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `sitio_info` AS select `sitio`.`id_sitio` AS `id_sitio`,`sitio`.`id_empresa` AS `id_empresa`,`sitio`.`municipios_id` AS `municipios_id`,`sitio`.`nombre` AS `nombre`,`sitio`.`direccion` AS `direccion`,`sitio`.`telefono1` AS `telefono1`,`sitio`.`telefono2` AS `telefono2`,`sitio`.`capacidad` AS `capacidad`,`sitio`.`horario` AS `horario`,`sector`.`id_sector` AS `id_sector`,`sector`.`nombre` AS `sector`,`revision_informacion`.`ubicacionGIS` AS `ubicacionGIS`,`revision_informacion`.`id_carta` AS `id_carta`,`descripcion_idioma`.`descripcion_larga` AS `descripcion_larga`,`descripcion_idioma`.`descripcion_corta` AS `descripcion_corta` from ((((`sitio` join `revision_informacion` on((`revision_informacion`.`id_sitio` = `sitio`.`id_sitio`))) join `empresa` on((`sitio`.`id_empresa` = `empresa`.`id_empresa`))) join `sector` on((`empresa`.`id_sector` = `sector`.`id_sector`))) join `descripcion_idioma` on((`descripcion_idioma`.`id_revision_informacion` = `revision_informacion`.`id_revision_informacion`))) where (`revision_informacion`.`status` = 'A') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-26 15:29:45
