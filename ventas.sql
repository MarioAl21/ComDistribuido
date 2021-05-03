-- MySQL dump 10.16  Distrib 10.1.38-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: ventas
-- ------------------------------------------------------
-- Server version	10.1.38-MariaDB

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
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `ciudad` text NOT NULL,
  `vigencia` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Mario N. Zavala','Puebla','2021-03-24 12:33:12'),(3,'Jose Alcazara','Puebla','2021-03-24 12:34:03'),(4,'Mario','3454','2021-03-24 12:57:15'),(5,'Mario','3454','2021-03-24 13:07:28'),(6,'Rodrigo Armienta','Xalapa','2021-03-24 13:19:13'),(7,'Fernando ','Puebla','2021-03-24 13:21:00'),(8,'Hugo Alavarez','Xalapa','2021-03-24 13:23:09'),(9,'Felix','Puebla','2021-03-24 13:29:02'),(10,'Enrrique','CDMX','2021-03-24 13:33:24'),(11,'Ramirez','Puebla','2021-03-24 13:34:30'),(12,'Armando','Chiapas','2021-03-24 13:43:03'),(13,'Gustavo','Merida','2021-03-24 16:15:04'),(14,'Alvaro Guzman','Texas','2021-03-24 16:16:36'),(15,'Mario N. Zavala','Puebla','2021-03-27 21:31:20'),(16,'Mario N. Zavala','Puebla','2021-03-27 21:31:39'),(17,'Mario N. Zavala','Puebla','2021-03-27 21:32:13'),(18,'Mario','3454','2021-03-27 21:32:59');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleados`
--

DROP TABLE IF EXISTS `empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `telefono` varchar(18) NOT NULL,
  `correo` text NOT NULL,
  `password` varchar(30) DEFAULT NULL,
  `puesto` text NOT NULL,
  `sueldo` double NOT NULL,
  PRIMARY KEY (`id_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados`
--

LOCK TABLES `empleados` WRITE;
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
INSERT INTO `empleados` VALUES (1,'Rafael Medina','22 12 19 56 23','rafme@gmail.com','rafel21-90org','Gerente',21000),(2,'Eduardo Trejo','22 23 78 12 45','edTR23@gmail.com','eduardlogin_*21','Facturista',13500),(3,'Elisabeth Alvarez','22 29 12 09 21','eliAl@gmail.com','FantasmitaCordial_7','Almacenista',9500),(4,'Claudia Gomez','22 11 61 89 11','clau_90@gmail.com','regulusCon34','HHRR',11200),(5,'Martin Vicencio','22 20 21 90 12','mar_vin19@gmail.com','*Logia_90','Vendedor',5000),(6,'Roberto Aparicio','22 22 81 67 77','roberto_AparGom@gmail.com','korden09*03','Vendedor',5000),(7,'Raymundo Estegula','22 22 23 90 04','ray_21@gmail.com','spartan117','Vendedor',5000);
/*!40000 ALTER TABLE `empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordenes`
--

DROP TABLE IF EXISTS `ordenes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordenes` (
  `id_orden` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `receptor` text NOT NULL,
  `ciudad` text NOT NULL,
  `id_cliente` int(11) NOT NULL,
  PRIMARY KEY (`id_orden`),
  KEY `id_cliente` (`id_cliente`),
  CONSTRAINT `ordenes_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordenes`
--

LOCK TABLES `ordenes` WRITE;
/*!40000 ALTER TABLE `ordenes` DISABLE KEYS */;
/*!40000 ALTER TABLE `ordenes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `importe` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `comision` double DEFAULT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `id_vendedor` (`id_vendedor`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_vendedor`) REFERENCES `vendedores` (`id_vendedor`),
  CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `costo_compra` double NOT NULL,
  `precio_venta` double NOT NULL,
  `descuento` double DEFAULT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Fibra de vidrio',1800,25.7,95.89,NULL),(2,'tugsteno',12000,341.9,405.78,NULL),(3,'aislante termico',22000,131.13,199.34,NULL),(4,'semiconductores',31000,1531.13,2300,0.17);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendedores` (
  `id_vendedor` int(11) NOT NULL AUTO_INCREMENT,
  `id_empleado` int(11) NOT NULL,
  PRIMARY KEY (`id_vendedor`),
  KEY `id_empleado` (`id_empleado`),
  CONSTRAINT `vendedores_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendedores`
--

LOCK TABLES `vendedores` WRITE;
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
INSERT INTO `vendedores` VALUES (1,5),(2,6),(3,7);
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-27 20:07:25
