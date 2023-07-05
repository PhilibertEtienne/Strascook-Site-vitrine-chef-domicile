-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: strascook
-- ------------------------------------------------------
-- Server version	8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `idadmin` int NOT NULL AUTO_INCREMENT,
  `username` text,
  `password` text,
  PRIMARY KEY (`idadmin`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'yavuz','yavuz'),(2,'phil','phil'),(3,'phil','phil'),(4,'guigous','guigous'),(5,'guigous','guigous'),(6,'picsou','$2y$10$edv2ZCIPLpNngy0NygFo3.LPqrP0ReKzGa5wTEFFI9CK5URUjW0f.'),(7,'picsou','$2y$10$rChUcj0768VGG059ww5iTuBndP1owwyIfCB1KiTa9iOmr37jVYvVu');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client` (
  `idclient` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(45) DEFAULT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(10) DEFAULT NULL,
  `adresse_livraison` text,
  `adresse_facturation` text,
  PRIMARY KEY (`idclient`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (14,'Philibert','Etienne','philibert.etienne4@orange.fr','0689023708','15 Rue Gustave Mathieu','15 Rue Gustave Mathieu'),(19,'lefou','pierrot','pierrot@gmail.com','3349500217','33 paris','33 parris'),(20,'VALJEAN','JEAN','boloss@gmial.com','0666666666','11 rue du 11','11 rue du 11'),(21,'LEPONGE','BOB','eponge@gmial.com','0386590277','krab','krab'),(22,'VALJEAN','JEAN','jeanvaljean@gmail.com','0689023708','33 rue de Lampertheim','33 rue de Lampertheim');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commandecontrolleur`
--

DROP TABLE IF EXISTS `commandecontrolleur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commandecontrolleur` (
  `client_idclient` int NOT NULL,
  `numeroCommande` int DEFAULT NULL,
  KEY `fk_commandecontrolleur_client1_idx` (`client_idclient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commandecontrolleur`
--

LOCK TABLES `commandecontrolleur` WRITE;
/*!40000 ALTER TABLE `commandecontrolleur` DISABLE KEYS */;
INSERT INTO `commandecontrolleur` VALUES (19,14),(20,15),(21,16),(14,17),(14,18),(14,19),(14,20),(14,24),(14,25),(22,26);
/*!40000 ALTER TABLE `commandecontrolleur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `devis`
--

DROP TABLE IF EXISTS `devis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `devis` (
  `idDevis` int NOT NULL AUTO_INCREMENT,
  `produit` varchar(45) DEFAULT NULL,
  `quantité` int DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `client_idclient` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `nbconvives` int DEFAULT NULL,
  `numeroCommande` int DEFAULT NULL,
  `prixTotal` float DEFAULT NULL,
  `isValid` tinyint DEFAULT NULL,
  PRIMARY KEY (`idDevis`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devis`
--

LOCK TABLES `devis` WRITE;
/*!40000 ALTER TABLE `devis` DISABLE KEYS */;
INSERT INTO `devis` VALUES (65,'Steak',4,4,'14','2222-02-22',3,19,NULL,NULL),(66,'Omelette',3,8,'14','2222-02-22',3,19,NULL,NULL),(67,'Tropico',2,3,'14','2222-02-22',3,19,NULL,NULL),(68,'Steak',4,4,'14','2222-02-22',3,20,NULL,NULL),(69,'Omelette',3,8,'14','2222-02-22',3,20,NULL,NULL),(70,'Tropico',2,3,'14','2222-02-22',3,20,NULL,NULL),(71,'Tropico',3,3,'14','2023-12-12',4,21,NULL,NULL),(72,'Tropico',3,3,'14','2023-12-12',4,22,NULL,NULL),(73,'Tropico',3,3,'14','2023-12-12',4,23,NULL,NULL),(74,'Tropico',3,3,'14','2023-12-12',4,24,NULL,NULL),(75,'Steak',4,4,'14','2033-11-15',1,25,27,NULL),(76,'Omelette',1,8,'14','2033-11-15',1,25,27,NULL),(77,'Tropico',1,3,'14','2033-11-15',1,25,27,NULL),(78,'Steak',1,4,'22','2024-11-12',3,26,31,1),(79,'Omelette',3,8,'22','2024-11-12',3,26,31,1),(80,'Tropico',1,3,'22','2024-11-12',3,26,31,1);
/*!40000 ALTER TABLE `devis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produit`
--

DROP TABLE IF EXISTS `produit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produit` (
  `idproduit` int NOT NULL AUTO_INCREMENT,
  `annee` int DEFAULT NULL,
  `semaine` int DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `description` text,
  `menu` varchar(45) DEFAULT NULL,
  `regime` varchar(45) DEFAULT NULL,
  `prix` int DEFAULT NULL,
  PRIMARY KEY (`idproduit`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produit`
--

LOCK TABLES `produit` WRITE;
/*!40000 ALTER TABLE `produit` DISABLE KEYS */;
INSERT INTO `produit` VALUES (1,2023,19,'Steak','un bon steak','plat','carnivore',4),(2,2023,17,'Laitue','Une bonne laitue','entree','vegetarien',4),(3,2023,19,'Omelette','Une bonne omelette','plat','carnivore',8),(4,2023,17,'Île flottante','Une bonne île flottante','dessert','vegetarien',4),(5,2023,NULL,'Tropico','La boisson des champions','boisson',NULL,3),(6,2023,19,'Salade','Une bonne salade','entree','vegetarien',6),(7,2023,19,'Oeuf mayo','de bons oeufs mayo','entree','carnivore',3),(8,2023,19,'Sardine','de bonnes sardines','entree','poisson',4),(9,2023,19,'Ratatouille','une bonne ratatouille','plat','vegetarien',7),(10,2023,19,'Sole meunière','une bonne sole','plat','poisson',7),(11,2023,NULL,'Sprite','Un bon sprite','boisson',NULL,3);
/*!40000 ALTER TABLE `produit` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-09  9:47:36
