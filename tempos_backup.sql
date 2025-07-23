/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.13-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: TEMPOS
-- ------------------------------------------------------
-- Server version	10.11.13-MariaDB-0ubuntu0.24.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administradores`
--

DROP TABLE IF EXISTS `administradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `administradores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administradores`
--

LOCK TABLES `administradores` WRITE;
/*!40000 ALTER TABLE `administradores` DISABLE KEYS */;
INSERT INTO `administradores` VALUES
(1,'Santiago','a23310173@ceti.mx');
/*!40000 ALTER TABLE `administradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `bitacora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `sentencia` text NOT NULL,
  `contrasentencia` text DEFAULT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora`
--

LOCK TABLES `bitacora` WRITE;
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
INSERT INTO `bitacora` VALUES
(1,'2025-05-14','Desconocido','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"AX7148\", precio = 5669.00, descripcion = \"Set de reloj y pulsera de acero inoxidable bicolor con cronógrafo\", stock = 4, genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285421/AX7148SET__NLP__NLC_F.jpg?v=638310047586170000\" WHERE id = 5;','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"AX7148\", precio = 5669.00, descripcion = \"Set de reloj y pulsera de acero inoxidable bicolor con cronógrafo\", stock = 3, genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285421/AX7148SET__NLP__NLC_F.jpg?v=638310047586170000\" WHERE id = 5;','02:26:35'),
(2,'2025-05-14','Desconocido','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"AX7148\", precio = 5669.00, descripcion = \"Set de reloj y pulsera de acero inoxidable bicolor con cronógrafo\", stock = 3, genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285421/AX7148SET__NLP__NLC_F.jpg?v=638310047586170000\" WHERE id = 5;','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"AX7148\", precio = 5669.00, descripcion = \"Set de reloj y pulsera de acero inoxidable bicolor con cronógrafo\", stock = 4, genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285421/AX7148SET__NLP__NLC_F.jpg?v=638310047586170000\" WHERE id = 5;','02:29:21'),
(3,'2025-05-14','Desconocido','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"AX7148\", precio = 5669.00, descripcion = \"Set de reloj y pulsera de acero inoxidable bicolor con cronógrafo\", stock = 4, genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285421/AX7148SET__NLP__NLC_F.jpg?v=638310047586170000\" WHERE id = 5;','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"AX7148\", precio = 5669.00, descripcion = \"Set de reloj y pulsera de acero inoxidable bicolor con cronógrafo\", stock = 3, genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285421/AX7148SET__NLP__NLC_F.jpg?v=638310047586170000\" WHERE id = 5;','02:30:31'),
(4,'2025-05-14','Desconocido','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"AX7148\", precio = \"5669.00\", descripcion = \"Set de reloj y pulsera de acero inoxidable bicolor con cronógrafo\", stock = \"3\", genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285421/AX7148SET__NLP__NLC_F.jpg?v=638310047586170000\" WHERE id = 5;','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"AX7148\", precio = \"5669.00\", descripcion = \"Set de reloj y pulsera de acero inoxidable bicolor con cronógrafo\", stock = \"4\", genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285421/AX7148SET__NLP__NLC_F.jpg?v=638310047586170000\" WHERE id = 5;','02:34:32'),
(5,'2025-05-14','Desconocido','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"AX7148\", precio = \"5669.00\", descripcion = \"Set de reloj y pulsera de acero inoxidable bicolor con cronógrafo\", stock = \"4\", genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285421/AX7148SET__NLP__NLC_F.jpg?v=638310047586170000\" WHERE id = 5;','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"AX7148\", precio = \"5669.00\", descripcion = \"Set de reloj y pulsera de acero inoxidable bicolor con cronógrafo\", stock = \"3\", genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285421/AX7148SET__NLP__NLC_F.jpg?v=638310047586170000\" WHERE id = 5;','02:35:51'),
(6,'2025-05-14','Desconocido','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"AX7148\", precio = \"5669.00\", descripcion = \"Set de reloj y pulsera de acero inoxidable bicolor con cronógrafo\", stock = \"3\", genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285421/AX7148SET__NLP__NLC_F.jpg?v=638310047586170000\" WHERE id = 5;','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"AX7148\", precio = \"5669.00\", descripcion = \"Set de reloj y pulsera de acero inoxidable bicolor con cronógrafo\", stock = \"4\", genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285421/AX7148SET__NLP__NLC_F.jpg?v=638310047586170000\" WHERE id = 5;','02:41:29'),
(7,'2025-05-14','DEBUG','Usuario capturado: Desconocido',NULL,'02:45:36'),
(8,'2025-05-14','Desconocido','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"AX7148\", precio = \"5669.00\", descripcion = \"Set de reloj y pulsera de acero inoxidable bicolor con cronógrafo\", stock = \"5\", genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285421/AX7148SET__NLP__NLC_F.jpg?v=638310047586170000\" WHERE id = 5;','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"AX7148\", precio = \"5669.00\", descripcion = \"Set de reloj y pulsera de acero inoxidable bicolor con cronógrafo\", stock = \"3\", genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285421/AX7148SET__NLP__NLC_F.jpg?v=638310047586170000\" WHERE id = 5;','02:45:36'),
(9,'2025-05-14','DEBUG','Usuario capturado: Desconocido',NULL,'02:48:27'),
(10,'2025-05-14','Desconocido','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"AX7148\", precio = \"5669.00\", descripcion = \"Set de reloj y pulsera de acero inoxidable bicolor con cronógrafo\", stock = \"3\", genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285421/AX7148SET__NLP__NLC_F.jpg?v=638310047586170000\" WHERE id = 5;','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"AX7148\", precio = \"5669.00\", descripcion = \"Set de reloj y pulsera de acero inoxidable bicolor con cronógrafo\", stock = \"5\", genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285421/AX7148SET__NLP__NLC_F.jpg?v=638310047586170000\" WHERE id = 5;','02:48:27'),
(11,'2025-05-14','DEBUG','Usuario capturado: Santiago',NULL,'02:51:21'),
(12,'2025-05-14','Santiago','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"AX7148\", precio = 5669.00, descripcion = \"Set de reloj y pulsera de acero inoxidable bicolor con cronógrafo\", stock = 13, genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285421/AX7148SET__NLP__NLC_F.jpg?v=638310047586170000\" WHERE id = 5;','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"AX7148\", precio = 5669.00, descripcion = \"Set de reloj y pulsera de acero inoxidable bicolor con cronógrafo\", stock = 3, genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285421/AX7148SET__NLP__NLC_F.jpg?v=638310047586170000\" WHERE id = 5;','02:51:21'),
(13,'2025-05-14','Santiago','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"AX7148\", precio = 5669.00, descripcion = \"Set de reloj y pulsera de acero inoxidable bicolor con cronógrafo\", stock = 4, genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285421/AX7148SET__NLP__NLC_F.jpg?v=638310047586170000\" WHERE id = 5;','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"AX7148\", precio = 5669.00, descripcion = \"Set de reloj y pulsera de acero inoxidable bicolor con cronógrafo\", stock = 13, genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285421/AX7148SET__NLP__NLC_F.jpg?v=638310047586170000\" WHERE id = 5;','02:53:01'),
(14,'2025-05-14','Santiago','DELETE FROM productos WHERE id = 10;','INSERT INTO productos (id, marca, modelo, precio, descripcion, stock, genero, imagen) VALUES (10, \"Rolex\", \"Rolex Oyster Perpetual\", 140000.00, \"hola\", 42, \"Mujer\", \"https://tienda.montepiedad.com.mx/cdn/shop/products/158684814-1.jpg?v=1635369407\");','02:55:47'),
(15,'2025-05-14','Santiago','INSERT INTO productos (marca, modelo, precio, descripcion, stock, genero, imagen) VALUES (\"Rolex\", \"Rolex Oyster Perpetual\", 150000.00, \"0\", 1, \"Mujer\", \"https://es.watchesofamerica.com/cdn/shop/products/cartier-santos-100-xl-men_s-watch-w20124u2_800x.jpg?v=1614993921\");','DELETE FROM productos WHERE id = 14;','03:11:25'),
(16,'2025-05-14','Santiago','UPDATE usuarios SET nombre = \"Prueba1\" WHERE id = 3;','UPDATE usuarios SET nombre = \"Prueba\", email = \"1@1.com\", pais = \"Canada\", ciudad = \"Vancouver\", contrasena = \"$2y$10$CLw56BrNKrAejBTAkJID3Oau5InaVQ1mdkSaXrOvLzeMNKD2WMA1O\" WHERE id = 3;','03:27:09'),
(17,'2025-05-14','Santiago','UPDATE productos SET marca = \"Casio\", modelo = \"CA53W-1 Calculator\", precio = 800.00, descripcion = \"CASIO CA-53W-1 Data Bank- Reloj Calculadora de Resina  ¿Alguna vez no supo cuánto debía dejar de propina en un restaurante? Gracias a este reloj con calculadora de ocho dígitos, puede hacer este cálculo con certeza.\", stock = 7, genero = \"Unisex\", imagen = \"https://m.media-amazon.com/images/S/aplus-media/sota/6b676ef9-5d0d-4baf-bd89-c96d6583cd2f._SR300,300_.png\" WHERE id = 4;','UPDATE productos SET marca = \"Casio\", modelo = \"CA53W-1 Calculator\", precio = 800.00, descripcion = \"CASIO CA-53W-1 Data Bank- Reloj Calculadora de Resina  ¿Alguna vez no supo cuánto debía dejar de propina en un restaurante? Gracias a este reloj con calculadora de ocho dígitos, puede hacer este cálculo con certeza.\", stock = 5, genero = \"Unisex\", imagen = \"https://m.media-amazon.com/images/S/aplus-media/sota/6b676ef9-5d0d-4baf-bd89-c96d6583cd2f._SR300,300_.png\" WHERE id = 4;','03:29:27'),
(18,'2025-05-14','Santiago','UPDATE productos SET marca = \"Bulova\", modelo = \"CANDOR CHRONO\", precio = 12000.00, descripcion = \"def\", stock = 4, genero = \"Mujer\", imagen = \"https://ss376.liverpool.com.mx/xl/1133283516.jpg\" WHERE id = 13;','UPDATE productos SET marca = \"Bulova\", modelo = \"CANDOR CHRONO\", precio = 12000.00, descripcion = \"0\", stock = 4, genero = \"Mujer\", imagen = \"https://ss376.liverpool.com.mx/xl/1133283516.jpg\" WHERE id = 13;','03:33:02'),
(19,'2025-05-14','Desconocido','DELETE FROM usuarios WHERE id = 3;','INSERT INTO usuarios (id, nombre, email, contrasena, pais, ciudad) VALUES (3, \"Prueba1\", \"1@1.com\", \"$2y$10$CLw56BrNKrAejBTAkJID3Oau5InaVQ1mdkSaXrOvLzeMNKD2WMA1O\", \"Canada\", \"Vancouver\");','03:41:22'),
(20,'2025-05-14','Desconocido','DELETE FROM usuarios WHERE id = 3;','INSERT INTO usuarios (id, nombre, email, contrasena, pais, ciudad) VALUES (3, \"Prueba1\", \"1@1.com\", \"$2y$10$CLw56BrNKrAejBTAkJID3Oau5InaVQ1mdkSaXrOvLzeMNKD2WMA1O\", \"Canada\", \"Vancouver\");','03:46:00'),
(21,'2025-05-14','Santiago','UPDATE productos SET marca = \"Bulova\", modelo = \"CANDOR CHRONO\", precio = 12000.00, descripcion = \"def\", stock = 6, genero = \"Mujer\", imagen = \"https://ss376.liverpool.com.mx/xl/1133283516.jpg\" WHERE id = 13;','UPDATE productos SET marca = \"Bulova\", modelo = \"CANDOR CHRONO\", precio = 12000.00, descripcion = \"def\", stock = 4, genero = \"Mujer\", imagen = \"https://ss376.liverpool.com.mx/xl/1133283516.jpg\" WHERE id = 13;','03:46:44'),
(22,'2025-05-14','Santiago','UPDATE productos SET marca = \"Bulova\", modelo = \"CANDOR CHRONO\", precio = 12000.00, descripcion = \"def\", stock = 4, genero = \"Mujer\", imagen = \"https://ss376.liverpool.com.mx/xl/1133283516.jpg\" WHERE id = 13;','UPDATE productos SET marca = \"Bulova\", modelo = \"CANDOR CHRONO\", precio = 12000.00, descripcion = \"def\", stock = 6, genero = \"Mujer\", imagen = \"https://ss376.liverpool.com.mx/xl/1133283516.jpg\" WHERE id = 13;','03:47:58'),
(23,'2025-05-14','Santiago','DELETE FROM usuarios WHERE id = 3;','INSERT INTO usuarios (id, nombre, email, contrasena, pais, ciudad) VALUES (3, \"Prueba1\", \"1@1.com\", \"$2y$10$CLw56BrNKrAejBTAkJID3Oau5InaVQ1mdkSaXrOvLzeMNKD2WMA1O\", \"Canada\", \"Vancouver\");','03:49:42'),
(24,'2025-05-14','Santiago','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"ax2451ax2451\", precio = 3998.00, descripcion = \"El reloj de 46 mm cuenta con una esfera azul mate con textura de rayos de sol, movimiento de fecha de tres manecillas y brazalete de acero inoxidable.\", stock = 13, genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285449/AX2451_AX2451_NLP__NLC_F.jpg?v=638310047809400000\" WHERE id = 1;','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"ax2451ax2451\", precio = 3999.00, descripcion = \"El reloj de 46 mm cuenta con una esfera azul mate con textura de rayos de sol, movimiento de fecha de tres manecillas y brazalete de acero inoxidable.\", stock = 13, genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285449/AX2451_AX2451_NLP__NLC_F.jpg?v=638310047809400000\" WHERE id = 1;','03:52:06'),
(25,'2025-05-14','Santiago','DELETE FROM productos WHERE id = 14;','INSERT INTO productos (id, marca, modelo, precio, descripcion, stock, genero, imagen) VALUES (14, \"Rolex\", \"Rolex Oyster Perpetual\", 150000.00, \"0\", 1, \"Mujer\", \"https://es.watchesofamerica.com/cdn/shop/products/cartier-santos-100-xl-men_s-watch-w20124u2_800x.jpg?v=1614993921\");','03:52:17'),
(26,'2025-05-14','Santiago','INSERT INTO productos (marca, modelo, precio, descripcion, stock, genero, imagen) VALUES (\"Rolex\", \"Rolex Oyster Perpetual\", 58000.00, \"0\", 1, \"Mujer\", \"https://tienda.montepiedad.com.mx/cdn/shop/products/158684814-1.jpg?v=1635369407\");','DELETE FROM productos WHERE id = 15;','03:52:50'),
(27,'2025-05-14','Santiago','UPDATE usuarios SET nombre = \"Prueba\" WHERE id = 3;','UPDATE usuarios SET nombre = \"Prueba1\", email = \"1@1.com\", pais = \"Canada\", ciudad = \"Vancouver\", contrasena = \"$2y$10$CLw56BrNKrAejBTAkJID3Oau5InaVQ1mdkSaXrOvLzeMNKD2WMA1O\" WHERE id = 3;','03:53:07'),
(28,'2025-05-14','Santiago','DELETE FROM usuarios WHERE id = 3;','INSERT INTO usuarios (id, nombre, email, contrasena, pais, ciudad) VALUES (3, \"Prueba\", \"1@1.com\", \"$2y$10$CLw56BrNKrAejBTAkJID3Oau5InaVQ1mdkSaXrOvLzeMNKD2WMA1O\", \"Canada\", \"Vancouver\");','03:53:14'),
(29,'2025-05-14','Santiago','UPDATE usuarios SET contrasena = \"***CONTRASEÑA_CAMBIADA***\" WHERE id = 7;','UPDATE usuarios SET nombre = \"Rosa\", email = \"rosa@gmail.com\", pais = \"Mexico\", ciudad = \"Guadalajara\", contrasena = \"$2y$10$nt9zbT4rn0fXqh53Zz1vxuaC/A4zta5/22o2fiGX54eUgLGkzT6/m\" WHERE id = 7;','03:55:24'),
(30,'2025-05-14','Santiago','UPDATE usuarios SET email = \"rosa1@gmail.com\" WHERE id = 7;','UPDATE usuarios SET nombre = \"Rosa\", email = \"rosa@gmail.com\", pais = \"Mexico\", ciudad = \"Guadalajara\", contrasena = \"$2y$10$jHrPvXXM/OHwynjLM977kursVSkKVPrDVbQHnJvv/YzN4WOZzBtBa\" WHERE id = 7;','10:51:28'),
(31,'2025-05-14','Santiago','UPDATE productos SET marca = \"Bulova\", modelo = \"CANDOR CHRONO\", precio = 12000.00, descripcion = \"def.\", stock = 4, genero = \"Mujer\", imagen = \"https://ss376.liverpool.com.mx/xl/1133283516.jpg\" WHERE id = 13;','UPDATE productos SET marca = \"Bulova\", modelo = \"CANDOR CHRONO\", precio = 12000.00, descripcion = \"def\", stock = 4, genero = \"Mujer\", imagen = \"https://ss376.liverpool.com.mx/xl/1133283516.jpg\" WHERE id = 13;','10:51:48'),
(32,'2025-05-14','Santiago','UPDATE usuarios SET contrasena = \"***CONTRASEÑA_CAMBIADA***\" WHERE id = 2;','UPDATE usuarios SET nombre = \"Ricardo O.\", email = \"a23310171@ceti.mx\", pais = \"Francia\", ciudad = \"Puteaux\", contrasena = \"$2y$10$5YUuSfy9gu6IopcrU8OFt.TIPLybKeQKxQTu02120OZOdQl2aNWjW\" WHERE id = 2;','10:52:33'),
(33,'2025-05-14','Santiago','INSERT INTO usuarios (nombre, email, contrasena, pais, ciudad) VALUES (\"iSAAC\", \"ISAAC@CETI.MX\", \"***CONTRASEÑA_ENCRIPTADA***\", \"Mexico\", \"Zapopan\");','DELETE FROM usuarios WHERE id = 13;','14:02:17'),
(34,'2025-05-14','Santiago','UPDATE usuarios SET nombre = \"Hannia O.\", email = \"hannia@gmail.com\" WHERE id = 12;','UPDATE usuarios SET nombre = \"Hannia\", email = \"hannia@.com\", pais = \"Mexico\", ciudad = \"Zapopan\", contrasena = \"1111\" WHERE id = 12;','14:42:45'),
(35,'2025-05-19','Santiago','INSERT INTO productos (marca, modelo, precio, descripcion, stock, genero, imagen) VALUES (\"Apple\", \"Apple watch Ultra 2\", 22500.00, \"0\", 5, \"Unisex\", \"https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcSQCfZTXe5sXVeW2ieG_PKPQYsravNCy32jJrxHsE37C5qMit-nQMaSW8WfGx34plfPhSti4gKIXEdgh1FDdwbcAbGVofULDqLWsJqXqJqASEWFkcsc4mD8PQ\");','DELETE FROM productos WHERE id = 16;','23:21:38'),
(36,'2025-05-19','Santiago','INSERT INTO usuarios (nombre, email, contrasena, pais, ciudad) VALUES (\"Ruth\", \"1@1.com\", \"***CONTRASEÑA_ENCRIPTADA***\", \"\", \"\");','DELETE FROM usuarios WHERE id = 14;','23:23:19'),
(37,'2025-05-19','Santiago','UPDATE usuarios SET pais = \"Mexico\" WHERE id = 14;','UPDATE usuarios SET nombre = \"Ruth\", email = \"1@1.com\", pais = \"\", ciudad = \"\", contrasena = \"$2y$10$uMDBD1ySa.8pcjbAPKEh8eypy7G9W2EYHwqrZIK37VQAe4ice6tUG\" WHERE id = 14;','23:24:03'),
(38,'2025-05-19','Santiago','DELETE FROM usuarios WHERE id = 14;','INSERT INTO usuarios (id, nombre, email, contrasena, pais, ciudad) VALUES (14, \"Ruth\", \"1@1.com\", \"$2y$10$uMDBD1ySa.8pcjbAPKEh8eypy7G9W2EYHwqrZIK37VQAe4ice6tUG\", \"Mexico\", \"\");','23:24:08'),
(39,'2025-06-15','Santiago','INSERT INTO usuarios (nombre, email, contrasena, pais, ciudad) VALUES (\"Ruth\", \"1@1.com\", \"***CONTRASEÑA_ENCRIPTADA***\", \"Mexico\", \"\");','DELETE FROM usuarios WHERE id = 14;','12:14:45'),
(40,'2025-06-15','Santiago','DELETE FROM usuarios WHERE id = 14;','INSERT INTO usuarios (id, nombre, email, contrasena, pais, ciudad) VALUES (14, \"Ruth\", \"1@1.com\", \"$2y$10$uMDBD1ySa.8pcjbAPKEh8eypy7G9W2EYHwqrZIK37VQAe4ice6tUG\", \"Mexico\", \"\");','12:15:16'),
(41,'2025-06-15','Santiago','INSERT INTO usuarios (nombre, email, contrasena, pais, ciudad) VALUES (\"Ruth\", \"1@1.com\", \"***CONTRASEÑA_ENCRIPTADA***\", \"Mexico\", \"\");','DELETE FROM usuarios WHERE id = 14;','12:15:54'),
(42,'2025-06-15','Santiago','DELETE FROM usuarios WHERE id = 14;','INSERT INTO usuarios (id, nombre, email, contrasena, pais, ciudad) VALUES (14, \"Ruth\", \"1@1.com\", \"$2y$10$uMDBD1ySa.8pcjbAPKEh8eypy7G9W2EYHwqrZIK37VQAe4ice6tUG\", \"Mexico\", \"\");','12:16:01'),
(43,'2025-06-15','Santiago','INSERT INTO productos (marca, modelo, precio, descripcion, stock, genero, imagen) VALUES (\"Prueba\", \"Prueba\", 1.00, \"0\", 100, \"Unisex\", \"https://acnews.blob.core.windows.net/imgnews/large/NAZ_fa3962a02a884daf8e86b96588f7b757.webp\");','DELETE FROM productos WHERE id = 17;','13:54:35'),
(44,'2025-06-17','Santiago','INSERT INTO usuarios (nombre, email, contrasena, pais, ciudad) VALUES (\"Proyecto\", \"proyecto@gmail.com\", \"***CONTRASEÑA_ENCRIPTADA***\", \"Mexico\", \"Cancun\");','DELETE FROM usuarios WHERE id = 15;','17:46:23'),
(45,'2025-06-17','Proyecto','UPDATE usuarios SET nombre = \"Proyecto1\" WHERE id = 15;','UPDATE usuarios SET nombre = \"Proyecto\", email = \"proyecto@gmail.com\", pais = \"Mexico\", ciudad = \"Cancun\", contrasena = \"$2y$10$ernjSuWTnbTmhgzkoYnEreqTCRL1YrBFDGm/8FhGKA4D2uuidtBj2\" WHERE id = 15;','17:46:59'),
(46,'2025-06-17','Proyecto','UPDATE usuarios SET nombre = \"Proyecto\" WHERE id = 15;','UPDATE usuarios SET nombre = \"Proyecto1\", email = \"proyecto@gmail.com\", pais = \"Mexico\", ciudad = \"Cancun\", contrasena = \"$2y$10$ernjSuWTnbTmhgzkoYnEreqTCRL1YrBFDGm/8FhGKA4D2uuidtBj2\" WHERE id = 15;','17:47:06'),
(47,'2025-06-17','Proyecto','INSERT INTO usuarios (nombre, email, contrasena, pais, ciudad) VALUES (\"tercerparcial\", \"proyecto3@gmail.com\", \"***CONTRASEÑA_ENCRIPTADA***\", \"Mexico\", \"Tijuana\");','DELETE FROM usuarios WHERE id = 16;','18:03:59'),
(48,'2025-06-17','tercerparcial','UPDATE usuarios SET nombre = \"tercerparcial3\" WHERE id = 16;','UPDATE usuarios SET nombre = \"tercerparcial\", email = \"proyecto3@gmail.com\", pais = \"Mexico\", ciudad = \"Tijuana\", contrasena = \"$2y$10$0QBPsV5z8/bBrGgXDFbbAOYaiupO.r7hVj5gQvEaHtnQTADbW0ymG\" WHERE id = 16;','18:04:28'),
(49,'2025-06-17','tercerparcial','UPDATE usuarios SET nombre = \"tercerparcial\" WHERE id = 16;','UPDATE usuarios SET nombre = \"tercerparcial3\", email = \"proyecto3@gmail.com\", pais = \"Mexico\", ciudad = \"Tijuana\", contrasena = \"$2y$10$0QBPsV5z8/bBrGgXDFbbAOYaiupO.r7hVj5gQvEaHtnQTADbW0ymG\" WHERE id = 16;','18:04:33'),
(50,'2025-06-17','tercerparcial','INSERT INTO usuarios (nombre, email, contrasena, pais, ciudad) VALUES (\"Juan\", \"juan1@gmail.com\", \"***CONTRASEÑA_ENCRIPTADA***\", \"Mexico\", \"CDMX\");','DELETE FROM usuarios WHERE id = 17;','18:11:54'),
(51,'2025-06-17','Juan','UPDATE usuarios SET nombre = \"Juan Perez\" WHERE id = 17;','UPDATE usuarios SET nombre = \"Juan\", email = \"juan1@gmail.com\", pais = \"Mexico\", ciudad = \"CDMX\", contrasena = \"$2y$10$vamyPYXOfGGGo/0nXVCqGuOSrlwE4gggwKH/bUFbpjw5Z2cUbhFVm\" WHERE id = 17;','18:12:24'),
(52,'2025-06-17','Santiago','UPDATE usuarios SET email = \"juan12@gmail.com\" WHERE id = 17;','UPDATE usuarios SET nombre = \"Juan Perez\", email = \"juan1@gmail.com\", pais = \"Mexico\", ciudad = \"CDMX\", contrasena = \"$2y$10$vamyPYXOfGGGo/0nXVCqGuOSrlwE4gggwKH/bUFbpjw5Z2cUbhFVm\" WHERE id = 17;','18:17:08'),
(53,'2025-06-17','Santiago','DELETE FROM usuarios WHERE id = 17;','INSERT INTO usuarios (id, nombre, email, contrasena, pais, ciudad) VALUES (17, \"Juan Perez\", \"juan12@gmail.com\", \"$2y$10$vamyPYXOfGGGo/0nXVCqGuOSrlwE4gggwKH/bUFbpjw5Z2cUbhFVm\", \"Mexico\", \"CDMX\");','18:17:17'),
(54,'2025-06-17','Santiago','UPDATE productos SET marca = \"Prueba\", modelo = \"Prueba\", precio = 100.00, descripcion = \"Producto de prueba\", stock = 30, genero = \"Unisex\", imagen = \"https://acnews.blob.core.windows.net/imgnews/large/NAZ_fa3962a02a884daf8e86b96588f7b757.webp\" WHERE id = 17;','UPDATE productos SET marca = \"Prueba\", modelo = \"Prueba\", precio = 1.00, descripcion = \"0\", stock = 100, genero = \"Unisex\", imagen = \"https://acnews.blob.core.windows.net/imgnews/large/NAZ_fa3962a02a884daf8e86b96588f7b757.webp\" WHERE id = 17;','18:17:53'),
(56,'2025-06-17','Santiago','INSERT INTO productos (marca, modelo, precio, descripcion, stock, genero, imagen) VALUES (\"Rolex\", \"Rolex Oyster Perpetual\", 50000.00, \"0\", 56, \"Mujer\", \"https://acnews.blob.core.windows.net/imgnews/large/NAZ_fa3962a02a884daf8e86b96588f7b757.webp\");','DELETE FROM productos WHERE id = 18;','18:18:41'),
(57,'2025-06-17','Santiago','DELETE FROM productos WHERE id = 18;','INSERT INTO productos (id, marca, modelo, precio, descripcion, stock, genero, imagen) VALUES (18, \"Rolex\", \"Rolex Oyster Perpetual\", 50000.00, \"0\", 56, \"Mujer\", \"https://acnews.blob.core.windows.net/imgnews/large/NAZ_fa3962a02a884daf8e86b96588f7b757.webp\");','18:25:26'),
(58,'2025-06-17','Santiago','DELETE FROM usuarios WHERE id = 16;','INSERT INTO usuarios (id, nombre, email, contrasena, pais, ciudad) VALUES (16, \"tercerparcial\", \"proyecto3@gmail.com\", \"$2y$10$0QBPsV5z8/bBrGgXDFbbAOYaiupO.r7hVj5gQvEaHtnQTADbW0ymG\", \"Mexico\", \"Tijuana\");','18:25:47'),
(59,'2025-06-17','Santiago','DELETE FROM usuarios WHERE id = 15;','INSERT INTO usuarios (id, nombre, email, contrasena, pais, ciudad) VALUES (15, \"Proyecto\", \"proyecto@gmail.com\", \"$2y$10$ernjSuWTnbTmhgzkoYnEreqTCRL1YrBFDGm/8FhGKA4D2uuidtBj2\", \"Mexico\", \"Cancun\");','18:25:49'),
(60,'2025-06-17','Santiago','INSERT INTO usuarios (nombre, email, contrasena, pais, ciudad) VALUES (\"Prueba\", \"prueba1@gmail.com\", \"***CONTRASEÑA_ENCRIPTADA***\", \"Mexico\", \"Zapopan\");','DELETE FROM usuarios WHERE id = 18;','18:27:46'),
(61,'2025-06-17','Prueba','UPDATE usuarios SET nombre = \"Prueba Proyecto\" WHERE id = 18;','UPDATE usuarios SET nombre = \"Prueba\", email = \"prueba1@gmail.com\", pais = \"Mexico\", ciudad = \"Zapopan\", contrasena = \"$2y$10$seeCnWD3xIr5Hzqwfe4jzOZu4WJ9bkGWK9nvR57OL9yRogD/lbAqW\" WHERE id = 18;','18:28:31'),
(62,'2025-06-17','Santiago','UPDATE usuarios SET email = \"prueba18@gmail.com\" WHERE id = 18;','UPDATE usuarios SET nombre = \"Prueba Proyecto\", email = \"prueba1@gmail.com\", pais = \"Mexico\", ciudad = \"Zapopan\", contrasena = \"$2y$10$seeCnWD3xIr5Hzqwfe4jzOZu4WJ9bkGWK9nvR57OL9yRogD/lbAqW\" WHERE id = 18;','18:33:19'),
(63,'2025-06-17','Santiago','INSERT INTO usuarios (nombre, email, contrasena, pais, ciudad) VALUES (\"MIguel Perez\", \"miguel@gmail.com\", \"***CONTRASEÑA_ENCRIPTADA***\", \"Francia\", \"Paris\");','DELETE FROM usuarios WHERE id = 19;','18:34:07'),
(64,'2025-06-17','MIguel Perez','UPDATE productos SET marca = \"Prueba\", modelo = \"Prueba\", precio = 1000.00, descripcion = \"Producto de prueba\", stock = 30, genero = \"Unisex\", imagen = \"https://acnews.blob.core.windows.net/imgnews/large/NAZ_fa3962a02a884daf8e86b96588f7b757.webp\" WHERE id = 17;','UPDATE productos SET marca = \"Prueba\", modelo = \"Prueba\", precio = 100.00, descripcion = \"Producto de prueba\", stock = 30, genero = \"Unisex\", imagen = \"https://acnews.blob.core.windows.net/imgnews/large/NAZ_fa3962a02a884daf8e86b96588f7b757.webp\" WHERE id = 17;','18:34:26'),
(65,'2025-06-17','Santiago','UPDATE usuarios SET email = \"prueba19@gmail.com\" WHERE id = 18;','UPDATE usuarios SET nombre = \"Prueba Proyecto\", email = \"prueba18@gmail.com\", pais = \"Mexico\", ciudad = \"Zapopan\", contrasena = \"$2y$10$seeCnWD3xIr5Hzqwfe4jzOZu4WJ9bkGWK9nvR57OL9yRogD/lbAqW\" WHERE id = 18;','18:35:09'),
(66,'2025-06-17','Santiago','UPDATE productos SET marca = \"Prueba\", modelo = \"Prueba\", precio = 500.00, descripcion = \"Producto de prueba\", stock = 30, genero = \"Unisex\", imagen = \"https://acnews.blob.core.windows.net/imgnews/large/NAZ_fa3962a02a884daf8e86b96588f7b757.webp\" WHERE id = 17;','UPDATE productos SET marca = \"Prueba\", modelo = \"Prueba\", precio = 1000.00, descripcion = \"Producto de prueba\", stock = 30, genero = \"Unisex\", imagen = \"https://acnews.blob.core.windows.net/imgnews/large/NAZ_fa3962a02a884daf8e86b96588f7b757.webp\" WHERE id = 17;','18:35:33'),
(67,'2025-06-17','Santiago','INSERT INTO productos (marca, modelo, precio, descripcion, stock, genero, imagen) VALUES (\"HUGO BOSS\", \"xxxx\", 6900.00, \"0\", 5, \"Unisex\", \"https://images.hugoboss.com/is/image/boss/hbeu58244900_999_200?$re_fullPageZoom$&amp;qlt=85&amp;fit=crop,1&amp;align=1,1&amp;bgcolor=ebebeb&amp;lastModified=1740748250000&amp;wid=1200&amp;hei=1818&amp;fmt=webp\");','DELETE FROM productos WHERE id = 19;','18:36:03'),
(68,'2025-06-17','Santiago','DELETE FROM productos WHERE id = 19;','INSERT INTO productos (id, marca, modelo, precio, descripcion, stock, genero, imagen) VALUES (19, \"HUGO BOSS\", \"xxxx\", 6900.00, \"0\", 5, \"Unisex\", \"https://images.hugoboss.com/is/image/boss/hbeu58244900_999_200?$re_fullPageZoom$&amp;qlt=85&amp;fit=crop,1&amp;align=1,1&amp;bgcolor=ebebeb&amp;lastModified=1740748250000&amp;wid=1200&amp;hei=1818&amp;fmt=webp\");','18:36:42'),
(69,'2025-06-17','Santiago','INSERT INTO usuarios (nombre, email, contrasena, pais, ciudad) VALUES (\"Prueba\", \"t@t.com\", \"***CONTRASEÑA_ENCRIPTADA***\", \"\", \"\");','DELETE FROM usuarios WHERE id = 20;','19:02:30'),
(70,'2025-06-17','Prueba','DELETE FROM usuarios WHERE id = 20;','INSERT INTO usuarios (id, nombre, email, contrasena, pais, ciudad) VALUES (20, \"Prueba\", \"t@t.com\", \"$2y$10$2TGqK43t6xljk4RqHe1l/OP2wEuL9EDVQmaXcnx56T0vwiYKXg9Ve\", \"\", \"\");','19:02:39'),
(71,'2025-06-17','Santiago','INSERT INTO usuarios (nombre, email, contrasena, pais, ciudad) VALUES (\"t\", \"t@t.com\", \"***CONTRASEÑA_ENCRIPTADA***\", \"\", \"\");','DELETE FROM usuarios WHERE id = 21;','19:05:03'),
(75,'2025-06-17','Santiago','DELETE FROM productos WHERE id = 15;','INSERT INTO productos (id, marca, modelo, precio, descripcion, stock, genero, imagen) VALUES (15, \"Rolex\", \"Rolex Oyster Perpetual\", 58000.00, \"0\", 1, \"Mujer\", \"https://tienda.montepiedad.com.mx/cdn/shop/products/158684814-1.jpg?v=1635369407\");','19:05:58'),
(76,'2025-06-17','Santiago','INSERT INTO usuarios (nombre, email, contrasena, pais, ciudad) VALUES (\"Proyecto 3P\", \"proyecto@gmail.com\", \"***CONTRASEÑA_ENCRIPTADA***\", \"MExico\", \"Vallarta\");','DELETE FROM usuarios WHERE id = 22;','19:14:18'),
(77,'2025-06-17','Proyecto 3P','UPDATE usuarios SET  WHERE id = 22;','UPDATE usuarios SET nombre = \"Proyecto 3P\", email = \"proyecto@gmail.com\", pais = \"MExico\", ciudad = \"Vallarta\", contrasena = \"$2y$10$0qR5ECTp.GJ31KvZyI68X.Ltltngp5.Dy70OFiZylaYx5IOl6ebWK\" WHERE id = 22;','19:14:48'),
(78,'2025-06-17','Santiago','UPDATE usuarios SET email = \"proyecto3p@gmail.com\" WHERE id = 22;','UPDATE usuarios SET nombre = \"Proyecto 3P\", email = \"proyecto@gmail.com\", pais = \"Mexico\", ciudad = \"Vallarta\", contrasena = \"$2y$10$0qR5ECTp.GJ31KvZyI68X.Ltltngp5.Dy70OFiZylaYx5IOl6ebWK\" WHERE id = 22;','19:19:34'),
(79,'2025-06-17','Santiago','INSERT INTO usuarios (nombre, email, contrasena, pais, ciudad) VALUES (\"Ruth\", \"ruth@gmail.com\", \"***CONTRASEÑA_ENCRIPTADA***\", \"Canada\", \"Sun Peaks\");','DELETE FROM usuarios WHERE id = 23;','19:20:27'),
(80,'2025-06-17','Santiago','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"AX7148\", precio = 5700.00, descripcion = \"Set de reloj y pulsera de acero inoxidable bicolor con cronógrafo\", stock = 4, genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285421/AX7148SET__NLP__NLC_F.jpg?v=638310047586170000\" WHERE id = 5;','UPDATE productos SET marca = \"Armani Exchange\", modelo = \"AX7148\", precio = 5669.00, descripcion = \"Set de reloj y pulsera de acero inoxidable bicolor con cronógrafo\", stock = 4, genero = \"Hombre\", imagen = \"https://armanixmx.vteximg.com.br/arquivos/ids/285421/AX7148SET__NLP__NLC_F.jpg?v=638310047586170000\" WHERE id = 5;','19:21:19'),
(81,'2025-06-17','Santiago','INSERT INTO productos (marca, modelo, precio, descripcion, stock, genero, imagen) VALUES (\"Omega\", \"MoonSwatch 1965\", 8000.00, \"0\", 12, \"Unisex\", \"https://www.swatch.com/dw/image/v2/BDNV_PRD/on/demandware.static/-/Library-Sites-swarp-global/default/dwd0fb84e8/images/Swatch/collections/2022/moonswatch/New-LP/moon_image1_960x900_d.jpg\");','DELETE FROM productos WHERE id = 20;','19:21:58'),
(82,'2025-06-17','Santiago','DELETE FROM usuarios WHERE id = 23;','INSERT INTO usuarios (id, nombre, email, contrasena, pais, ciudad) VALUES (23, \"Ruth\", \"ruth@gmail.com\", \"$2y$10$duGq8VyH5Dom.lmmgdem2elZn45pJ85PDX08wQUqm.MFrpx/USro.\", \"Canada\", \"Sun Peaks\");','19:22:59'),
(83,'2025-06-19','Santiago','INSERT INTO usuarios (nombre, email, contrasena, pais, ciudad) VALUES (\"Rosa \", \"rsantana@ceti.mx\", \"***CONTRASEÑA_ENCRIPTADA***\", \"Mexico\", \"Guadalajara\");','DELETE FROM usuarios WHERE id = 24;','09:49:27');
/*!40000 ALTER TABLE `bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrito`
--

DROP TABLE IF EXISTS `carrito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(255) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_agregado` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrito`
--

LOCK TABLES `carrito` WRITE;
/*!40000 ALTER TABLE `carrito` DISABLE KEYS */;
INSERT INTO `carrito` VALUES
(25,'guest_6823ec1a5adb3',3,1,'2025-05-14 01:06:35'),
(36,'guest_684f216d9d0cf',5,1,'2025-06-15 19:49:44'),
(42,'15',3,1,'2025-06-17 23:47:45'),
(43,'15',4,1,'2025-06-17 23:47:48'),
(46,'guest_6852029e2043a',1,1,'2025-06-18 00:04:52'),
(51,'guest_6852046cdc540',1,1,'2025-06-18 00:12:58');
/*!40000 ALTER TABLE `carrito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_pedidos`
--

DROP TABLE IF EXISTS `detalle_pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_pedidos` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `id_pedido` (`id_pedido`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `detalle_pedidos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE CASCADE,
  CONSTRAINT `detalle_pedidos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_pedidos`
--

LOCK TABLES `detalle_pedidos` WRITE;
/*!40000 ALTER TABLE `detalle_pedidos` DISABLE KEYS */;
INSERT INTO `detalle_pedidos` VALUES
(1,1,17,1,1.00,1.00),
(2,2,17,1,1.00,1.00),
(3,3,17,1,1.00,1.00),
(4,4,3,1,5950.00,5950.00),
(5,4,16,1,22500.00,22500.00),
(6,5,16,1,22500.00,22500.00),
(7,5,3,1,5950.00,5950.00),
(8,6,16,1,22500.00,22500.00),
(9,6,1,1,3998.00,3998.00),
(10,7,1,1,3998.00,3998.00),
(11,7,5,1,5669.00,5669.00),
(12,8,1,1,3998.00,3998.00),
(13,8,10,1,140000.00,140000.00),
(14,9,3,1,5950.00,5950.00),
(15,10,13,1,12000.00,12000.00),
(16,11,10,1,140000.00,140000.00),
(17,11,13,1,12000.00,12000.00),
(18,11,16,3,22500.00,67500.00);
/*!40000 ALTER TABLE `detalle_pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(255) NOT NULL,
  `fecha_pedido` datetime DEFAULT current_timestamp(),
  `total_pedido` decimal(10,2) NOT NULL,
  `estado_pedido` varchar(50) DEFAULT 'Pendiente',
  `paypal_order_id` varchar(255) DEFAULT NULL,
  `nombre_cliente` varchar(255) DEFAULT NULL,
  `email_cliente` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pedido`),
  UNIQUE KEY `paypal_order_id` (`paypal_order_id`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES
(1,'1','2025-06-15 14:46:50',1.00,'Pagado','15B96335X0093251Y','SANTIAGO RAMIREZ','a23310173@ceti.mx'),
(2,'1','2025-06-15 14:51:37',1.00,'Pagado','34U84067CJ087602G','Santiago Ramirez','a23310173@ceti.mx'),
(3,'1','2025-06-15 15:04:47',1.00,'Pagado','9P886006J6836661W','santiago ramirez','a23310173@ceti.mx'),
(4,'1','2025-06-17 17:57:44',28450.00,'Pagado','1TS57980RV115250S','John Doe','sb-t9gpc43822498@personal.example.com'),
(5,'16','2025-06-17 18:06:54',28450.00,'Pagado','8VC09826N8969554D','John Doe','a23310173@gmail.com'),
(6,'17','2025-06-17 18:14:29',26498.00,'Pagado','3FN311428T515712S','John Doe','a23310173@ceti.mx'),
(7,'18','2025-06-17 18:30:46',9667.00,'Pagado','8X414133G5649792Y','John Doe','a23310173@ceti.mx'),
(8,'22','2025-06-17 19:16:50',143998.00,'Pagado','7UN18157UB636914N','John Doe','a23310173@ceti.mx'),
(9,'1','2025-06-19 10:01:07',5950.00,'Pagado','3H053167L5365734C','John Doe','sb-uo47bs43762124@personal.example.com'),
(10,'1','2025-06-19 10:05:32',12000.00,'Pagado','7FB03391YM559362C','Santiago','a23310173@ceti.mx'),
(11,'24','2025-06-19 10:06:36',219500.00,'Pagado','23A4363333066381L','Rosa ','rsantana@ceti.mx');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(100) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `stock` int(100) NOT NULL,
  `genero` varchar(100) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES
(1,'Armani Exchange','ax2451ax2451',3998.00,'El reloj de 46 mm cuenta con una esfera azul mate con textura de rayos de sol, movimiento de fecha de tres manecillas y brazalete de acero inoxidable.',13,'Hombre','https://armanixmx.vteximg.com.br/arquivos/ids/285449/AX2451_AX2451_NLP__NLC_F.jpg?v=638310047809400000'),
(3,'Omega','MoonSwatch 1965',5950.00,'El reloj de 46 mm cuenta con una esfera azul mate con textura de rayos de sol, movimiento de fecha de tres manecillas y brazalete de acero inoxidable.',5,'Unisex','https://www.swatch.com/dw/image/v2/BDNV_PRD/on/demandware.static/-/Library-Sites-swarp-global/default/dwd0fb84e8/images/Swatch/collections/2022/moonswatch/New-LP/moon_image1_960x900_d.jpg'),
(4,'Casio','CA53W-1 Calculator',800.00,'CASIO CA-53W-1 Data Bank- Reloj Calculadora de Resina  ¿Alguna vez no supo cuánto debía dejar de propina en un restaurante? Gracias a este reloj con calculadora de ocho dígitos, puede hacer este cálculo con certeza.',7,'Unisex','https://m.media-amazon.com/images/S/aplus-media/sota/6b676ef9-5d0d-4baf-bd89-c96d6583cd2f._SR300,300_.png'),
(5,'Armani Exchange','AX7148',5700.00,'Set de reloj y pulsera de acero inoxidable bicolor con cronógrafo',4,'Hombre','https://armanixmx.vteximg.com.br/arquivos/ids/285421/AX7148SET__NLP__NLC_F.jpg?v=638310047586170000'),
(10,'Rolex','Rolex Oyster Perpetual',140000.00,'hola',42,'Mujer','https://tienda.montepiedad.com.mx/cdn/shop/products/158684814-1.jpg?v=1635369407'),
(13,'Bulova','CANDOR CHRONO',12000.00,'def.',4,'Mujer','https://ss376.liverpool.com.mx/xl/1133283516.jpg'),
(16,'Apple','Apple watch Ultra 2',22500.00,'0',5,'Unisex','https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcSQCfZTXe5sXVeW2ieG_PKPQYsravNCy32jJrxHsE37C5qMit-nQMaSW8WfGx34plfPhSti4gKIXEdgh1FDdwbcAbGVofULDqLWsJqXqJqASEWFkcsc4mD8PQ'),
(17,'Prueba','Prueba',500.00,'Producto de prueba',30,'Unisex','https://acnews.blob.core.windows.net/imgnews/large/NAZ_fa3962a02a884daf8e86b96588f7b757.webp'),
(20,'Omega','MoonSwatch 1965',8000.00,'0',12,'Unisex','https://www.swatch.com/dw/image/v2/BDNV_PRD/on/demandware.static/-/Library-Sites-swarp-global/default/dwd0fb84e8/images/Swatch/collections/2022/moonswatch/New-LP/moon_image1_960x900_d.jpg');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER after_insert_productos 
AFTER INSERT ON productos 
FOR EACH ROW 
BEGIN
    DECLARE v_usuario VARCHAR(255) DEFAULT 'Desconocido';
    
    
    SELECT usuario INTO v_usuario 
    FROM sesion_activa 
    ORDER BY id DESC 
    LIMIT 1;
    
    
    IF v_usuario IS NULL OR v_usuario = '' THEN
        SET v_usuario = 'Desconocido';
    END IF;
    
    
    INSERT INTO bitacora (fecha, hora, nombre, sentencia, contrasentencia)
    VALUES (CURDATE(), CURTIME(), v_usuario, 
            CONCAT('INSERT INTO productos (marca, modelo, precio, descripcion, stock, genero, imagen) VALUES (',
                  '"', NEW.marca, '", "', NEW.modelo, '", ', NEW.precio, ', "', 
                  NEW.descripcion, '", ', NEW.stock, ', "', NEW.genero, '", "', 
                  NEW.imagen, '");'),
            CONCAT('DELETE FROM productos WHERE id = ', NEW.id, ';')
    );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER before_update_productos 
BEFORE UPDATE ON productos 
FOR EACH ROW 
BEGIN
    DECLARE v_usuario VARCHAR(255) DEFAULT 'Desconocido';
    
    
    SELECT usuario INTO v_usuario 
    FROM sesion_activa 
    ORDER BY id DESC 
    LIMIT 1;
    
    
    IF v_usuario IS NULL OR v_usuario = '' THEN
        SET v_usuario = 'Desconocido';
    END IF;
    
    
    INSERT INTO bitacora (fecha, hora, nombre, sentencia, contrasentencia)
    VALUES (CURDATE(), CURTIME(), v_usuario, 
            CONCAT('UPDATE productos SET marca = "', NEW.marca, '", modelo = "', NEW.modelo, 
                   '", precio = ', NEW.precio, ', descripcion = "', NEW.descripcion, 
                   '", stock = ', NEW.stock, ', genero = "', NEW.genero, 
                   '", imagen = "', NEW.imagen, '" WHERE id = ', NEW.id, ';'),
            CONCAT('UPDATE productos SET marca = "', OLD.marca, '", modelo = "', OLD.modelo, 
                   '", precio = ', OLD.precio, ', descripcion = "', OLD.descripcion, 
                   '", stock = ', OLD.stock, ', genero = "', OLD.genero, 
                   '", imagen = "', OLD.imagen, '" WHERE id = ', OLD.id, ';')
    );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER before_delete_productos 
BEFORE DELETE ON productos 
FOR EACH ROW 
BEGIN
    DECLARE v_usuario VARCHAR(255) DEFAULT 'Desconocido';
    
    
    SELECT usuario INTO v_usuario 
    FROM sesion_activa 
    ORDER BY id DESC 
    LIMIT 1;
    
    
    IF v_usuario IS NULL OR v_usuario = '' THEN
        SET v_usuario = 'Desconocido';
    END IF;
    
    
    INSERT INTO bitacora (fecha, hora, nombre, sentencia, contrasentencia)
    VALUES (CURDATE(), CURTIME(), v_usuario, 
            CONCAT('DELETE FROM productos WHERE id = ', OLD.id, ';'),
            CONCAT('INSERT INTO productos (id, marca, modelo, precio, descripcion, stock, genero, imagen) VALUES (',
                  OLD.id, ', "', OLD.marca, '", "', OLD.modelo, '", ', OLD.precio, ', "', 
                  OLD.descripcion, '", ', OLD.stock, ', "', OLD.genero, '", "', OLD.imagen, '");')
    );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `sesion_activa`
--

DROP TABLE IF EXISTS `sesion_activa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sesion_activa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sesion_activa`
--

LOCK TABLES `sesion_activa` WRITE;
/*!40000 ALTER TABLE `sesion_activa` DISABLE KEYS */;
INSERT INTO `sesion_activa` VALUES
(1,'Rosa ');
/*!40000 ALTER TABLE `sesion_activa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES
(1,'Santiago','a23310173@ceti.mx','$2y$10$FUe.xyS69ArnQCen4SdBaunh2JmGlNY9tztB4.5eLa6ouWBZRJhMC','Irlanda','Dublin'),
(2,'Ricardo O.','a23310171@ceti.mx','$2y$10$W6IkPCrUy/sl6zYCdb3KP.sPfiU3a6Fz0xCad4I64FcB0C1H7trOG','Francia','Puteaux'),
(7,'Rosa','rosa1@gmail.com','$2y$10$jHrPvXXM/OHwynjLM977kursVSkKVPrDVbQHnJvv/YzN4WOZzBtBa','Mexico','Guadalajara'),
(12,'Hannia O.','hannia@gmail.com','1111','Mexico','Zapopan'),
(13,'iSAAC','ISAAC@CETI.MX','$2y$10$7dsR5mIhPJAv8KepbNt4fePRbeycc..LUCnoO02Dm8CNS2gvcQZjy','Mexico','Zapopan'),
(18,'Prueba Proyecto','prueba19@gmail.com','$2y$10$seeCnWD3xIr5Hzqwfe4jzOZu4WJ9bkGWK9nvR57OL9yRogD/lbAqW','Mexico','Zapopan'),
(19,'MIguel Perez','miguel@gmail.com','$2y$10$iBunvWl1IL/P5Hrz6BhGy.ra325wcUaEkRlKUFQB.gLgHW79uyCQS','Francia','Paris'),
(21,'t','t@t.com','$2y$10$r.YQW7I1iPJaDXKxnp3FA.j6ZV/lV4jgkBHsvWvXOh26HkypbDKXG','',''),
(22,'Proyecto 3P','proyecto3p@gmail.com','$2y$10$0qR5ECTp.GJ31KvZyI68X.Ltltngp5.Dy70OFiZylaYx5IOl6ebWK','Mexico','Vallarta'),
(24,'Rosa ','rsantana@ceti.mx','$2y$10$ieYsHJkV9pf4NUyI5rasoOkr/2NA1kr5sd8wfnbMqRgCgUGiNIfCy','Mexico','Guadalajara');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER after_insert_usuario
AFTER INSERT ON usuarios
FOR EACH ROW
BEGIN
    DECLARE v_usuario VARCHAR(255) DEFAULT 'Desconocido';
    
    
    SELECT usuario INTO v_usuario 
    FROM sesion_activa 
    ORDER BY id DESC 
    LIMIT 1;
    
    
    IF v_usuario IS NULL OR v_usuario = '' THEN
        SET v_usuario = 'Desconocido';
    END IF;
    
    
    INSERT INTO bitacora (fecha, hora, nombre, sentencia, contrasentencia)
    VALUES (CURDATE(), CURTIME(), v_usuario, 
            CONCAT('INSERT INTO usuarios (nombre, email, contrasena, pais, ciudad) VALUES (',
                  '"', NEW.nombre, '", "', NEW.email, '", "', '***CONTRASEÑA_ENCRIPTADA***', '", "', 
                  IFNULL(NEW.pais, ''), '", "', IFNULL(NEW.ciudad, ''), '");'),
            CONCAT('DELETE FROM usuarios WHERE id = ', NEW.id, ';')
    );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER before_update_usuarios
BEFORE UPDATE ON usuarios
FOR EACH ROW
BEGIN
    DECLARE v_usuario VARCHAR(255) DEFAULT 'Desconocido';
    
    
    SELECT usuario INTO v_usuario 
    FROM sesion_activa 
    ORDER BY id DESC 
    LIMIT 1;
    
    
    IF v_usuario IS NULL OR v_usuario = '' THEN
        SET v_usuario = 'Desconocido';
    END IF;
    
    
    INSERT INTO bitacora (fecha, hora, nombre, sentencia, contrasentencia)
    VALUES (CURDATE(), CURTIME(), v_usuario, 
            CONCAT('UPDATE usuarios SET ',
                  IF(NEW.nombre <> OLD.nombre, CONCAT('nombre = "', NEW.nombre, '"'), ''),
                  IF(NEW.email <> OLD.email, CONCAT(IF(NEW.nombre <> OLD.nombre, ', ', ''), 'email = "', NEW.email, '"'), ''),
                  IF(NEW.pais <> OLD.pais, CONCAT(IF(NEW.nombre <> OLD.nombre OR NEW.email <> OLD.email, ', ', ''), 'pais = "', NEW.pais, '"'), ''),
                  IF(NEW.ciudad <> OLD.ciudad, CONCAT(IF(NEW.nombre <> OLD.nombre OR NEW.email <> OLD.email OR NEW.pais <> OLD.pais, ', ', ''), 'ciudad = "', NEW.ciudad, '"'), ''),
                  IF(NEW.contrasena <> OLD.contrasena, CONCAT(IF(NEW.nombre <> OLD.nombre OR NEW.email <> OLD.email OR NEW.pais <> OLD.pais OR NEW.ciudad <> OLD.ciudad, ', ', ''), 'contrasena = "', '***CONTRASEÑA_CAMBIADA***', '"'), ''),
                  ' WHERE id = ', OLD.id, ';'),
            CONCAT('UPDATE usuarios SET ',
                  'nombre = "', OLD.nombre, '", ',
                  'email = "', OLD.email, '", ',
                  'pais = "', OLD.pais, '", ',
                  'ciudad = "', OLD.ciudad, '", ',
                  'contrasena = "', OLD.contrasena, '" ',
                  'WHERE id = ', OLD.id, ';')
    );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER before_delete_usuarios
BEFORE DELETE ON usuarios
FOR EACH ROW
BEGIN
    DECLARE v_usuario VARCHAR(255) DEFAULT 'Desconocido';
    
    
    SELECT usuario INTO v_usuario 
    FROM sesion_activa 
    ORDER BY id DESC 
    LIMIT 1;
    
    
    IF v_usuario IS NULL OR v_usuario = '' THEN
        SET v_usuario = 'Desconocido';
    END IF;
    
    
    INSERT INTO bitacora (fecha, hora, nombre, sentencia, contrasentencia)
    VALUES (CURDATE(), CURTIME(), v_usuario, 
            CONCAT('DELETE FROM usuarios WHERE id = ', OLD.id, ';'),
            CONCAT('INSERT INTO usuarios (id, nombre, email, contrasena, pais, ciudad) VALUES (',
                  OLD.id, ', "', OLD.nombre, '", "', OLD.email, '", "', 
                  IFNULL(OLD.contrasena, ''), '", "', IFNULL(OLD.pais, ''), '", "', 
                  IFNULL(OLD.ciudad, ''), '");')
    );
END */;;
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

-- Dump completed on 2025-07-16  8:30:06
