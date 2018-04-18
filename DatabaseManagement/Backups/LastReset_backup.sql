-- MySQL dump 10.13  Distrib 5.5.42, for osx10.6 (i386)
--
-- Host: localhost    Database: sdevbase
-- ------------------------------------------------------
-- Server version	5.5.42

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
-- Table structure for table `Account`
--

DROP TABLE IF EXISTS `Account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Account` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(50) DEFAULT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `EmailAddress` varchar(50) DEFAULT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `ChangedBy` varchar(50) DEFAULT NULL,
  `UserRole` int(11) DEFAULT NULL,
  `SearchMetaInfo` text,
  UNIQUE KEY `Id` (`Id`),
  UNIQUE KEY `Username` (`Username`),
  KEY `UserRole` (`UserRole`),
  CONSTRAINT `Account_UserRole` FOREIGN KEY (`UserRole`) REFERENCES `UserRole` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Account`
--

LOCK TABLES `Account` WRITE;
/*!40000 ALTER TABLE `Account` DISABLE KEYS */;
/*!40000 ALTER TABLE `Account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ApiEntity`
--

DROP TABLE IF EXISTS `ApiEntity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ApiEntity` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `EntityName` varchar(50) DEFAULT NULL,
  `ApiKey` int(11) DEFAULT NULL,
  `SearchMetaInfo` text,
  UNIQUE KEY `Id` (`Id`),
  KEY `ApiKey` (`ApiKey`),
  CONSTRAINT `ApiEntity_ApiKey` FOREIGN KEY (`ApiKey`) REFERENCES `ApiKey` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ApiEntity`
--

LOCK TABLES `ApiEntity` WRITE;
/*!40000 ALTER TABLE `ApiEntity` DISABLE KEYS */;
/*!40000 ALTER TABLE `ApiEntity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ApiKey`
--

DROP TABLE IF EXISTS `ApiKey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ApiKey` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ApiKey` varchar(200) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  UNIQUE KEY `Id` (`Id`),
  UNIQUE KEY `ApiKey` (`ApiKey`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ApiKey`
--

LOCK TABLES `ApiKey` WRITE;
/*!40000 ALTER TABLE `ApiKey` DISABLE KEYS */;
/*!40000 ALTER TABLE `ApiKey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AuditLogEntry`
--

DROP TABLE IF EXISTS `AuditLogEntry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AuditLogEntry` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `EntryTimeStamp` datetime DEFAULT NULL,
  `ObjectName` varchar(50) DEFAULT NULL,
  `ModificationType` varchar(15) DEFAULT NULL,
  `UserEmail` varchar(100) DEFAULT NULL,
  `ObjectId` text,
  `AuditLogEntryDetail` text,
  UNIQUE KEY `Id` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AuditLogEntry`
--

LOCK TABLES `AuditLogEntry` WRITE;
/*!40000 ALTER TABLE `AuditLogEntry` DISABLE KEYS */;
INSERT INTO `AuditLogEntry` VALUES (1,'2017-07-12 10:29:56','PageView','Create','Anonymous',NULL,'<strong>Values after create:</strong> <br>Id -> <br>TimeStamped -> 12-Jul-2017<br>IPAddress -> ::1<br>PageDetails -> /sDev-Base/DatabaseManagement/ManageDatabase.php<br>UserAgentDetails -> Application: Apache <br>Server Name: localhost <br>HTTP User Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36 <br><br>UserRole -> Anonymous<br>Username -> Anonymous<br>'),(2,'2017-07-12 10:30:17','PageView','Create','Anonymous',NULL,'<strong>Values after create:</strong> <br>Id -> <br>TimeStamped -> 12-Jul-2017<br>IPAddress -> ::1<br>PageDetails -> /sDev-Base/assets/_core/php/_devtools/start_page.php<br>UserAgentDetails -> Application: Apache <br>Server Name: localhost <br>HTTP User Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36 <br><br>UserRole -> Anonymous<br>Username -> Anonymous<br>'),(3,'2017-07-12 10:30:30','PageView','Create','Anonymous',NULL,'<strong>Values after create:</strong> <br>Id -> <br>TimeStamped -> 12-Jul-2017<br>IPAddress -> ::1<br>PageDetails -> /sDev-Base/sDevORM/index.php<br>UserAgentDetails -> Application: Apache <br>Server Name: localhost <br>HTTP User Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36 <br><br>UserRole -> Anonymous<br>Username -> Anonymous<br>'),(4,'2017-07-12 10:30:39','PageView','Create','Anonymous',NULL,'<strong>Values after create:</strong> <br>Id -> <br>TimeStamped -> 12-Jul-2017<br>IPAddress -> ::1<br>PageDetails -> /sDev-Base/assets/_core/php/_devtools/start_page.php<br>UserAgentDetails -> Application: Apache <br>Server Name: localhost <br>HTTP User Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36 <br><br>UserRole -> Anonymous<br>Username -> Anonymous<br>'),(5,'2017-07-12 10:30:49','PageView','Create','Anonymous',NULL,'<strong>Values after create:</strong> <br>Id -> <br>TimeStamped -> 12-Jul-2017<br>IPAddress -> ::1<br>PageDetails -> /sDev-Base/App/User/PlaceHolder_Overview/<br>UserAgentDetails -> Application: Apache <br>Server Name: localhost <br>HTTP User Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36 <br><br>UserRole -> Anonymous<br>Username -> Anonymous<br>'),(6,'2017-07-12 10:31:06','PlaceHolder','Create','Anonymous',NULL,'<strong>Values after create:</strong> <br>Id -> <br>DummyOne -> 03-Jul-2017<br>DummyTwo -> Result,Test<br>DummyThree -> 123<br>DummyFour -> 1<br>DummyFive -> 08-Jul-2017<br>DummySix -> 456<br>Account -> <br>SearchMetaInfo -> <br>UserRole -> <br>'),(7,'2017-07-12 10:31:10','PlaceHolder','Create','Anonymous',NULL,'<strong>Values after create:</strong> <br>Id -> <br>DummyOne -> <br>DummyTwo -> Test,Result<br>DummyThree -> <br>DummyFour -> 0<br>DummyFive -> <br>DummySix -> <br>Account -> <br>SearchMetaInfo -> <br>UserRole -> <br>'),(8,'2017-07-12 10:34:06','PageView','Create','Anonymous',NULL,'<strong>Values after create:</strong> <br>Id -> <br>TimeStamped -> 12-Jul-2017<br>IPAddress -> ::1<br>PageDetails -> /sDev-Base/assets/_core/php/_devtools/start_page.php<br>UserAgentDetails -> Application: Apache <br>Server Name: localhost <br>HTTP User Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36 <br><br>UserRole -> Anonymous<br>Username -> Anonymous<br>'),(9,'2017-07-12 10:34:09','PageView','Create','Anonymous',NULL,'<strong>Values after create:</strong> <br>Id -> <br>TimeStamped -> 12-Jul-2017<br>IPAddress -> ::1<br>PageDetails -> /sDev-Base/DatabaseManagement/ManageDatabase.php<br>UserAgentDetails -> Application: Apache <br>Server Name: localhost <br>HTTP User Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36 <br><br>UserRole -> Anonymous<br>Username -> Anonymous<br>'),(10,'2017-07-12 10:34:15','PageView','Create','Anonymous',NULL,'<strong>Values after create:</strong> <br>Id -> <br>TimeStamped -> 12-Jul-2017<br>IPAddress -> ::1<br>PageDetails -> /sDev-Base/DatabaseManagement/ManageDatabase.php<br>UserAgentDetails -> Application: Apache <br>Server Name: localhost <br>HTTP User Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36 <br><br>UserRole -> Anonymous<br>Username -> Anonymous<br>'),(11,'2017-07-12 10:34:45','PageView','Create','Anonymous',NULL,'<strong>Values after create:</strong> <br>Id -> <br>TimeStamped -> 12-Jul-2017<br>IPAddress -> ::1<br>PageDetails -> /sDev-Base/DatabaseManagement/ManageDatabase.php<br>UserAgentDetails -> Application: Apache <br>Server Name: localhost <br>HTTP User Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36 <br><br>UserRole -> Anonymous<br>Username -> Anonymous<br>'),(12,'2017-07-12 10:34:58','PageView','Create','Anonymous',NULL,'<strong>Values after create:</strong> <br>Id -> <br>TimeStamped -> 12-Jul-2017<br>IPAddress -> ::1<br>PageDetails -> /sDev-Base/DatabaseManagement/ManageDatabase.php<br>UserAgentDetails -> Application: Apache <br>Server Name: localhost <br>HTTP User Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36 <br><br>UserRole -> Anonymous<br>Username -> Anonymous<br>');
/*!40000 ALTER TABLE `AuditLogEntry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `BackgroundProcess`
--

DROP TABLE IF EXISTS `BackgroundProcess`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BackgroundProcess` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `PId` varchar(50) DEFAULT NULL,
  `UserId` varchar(50) DEFAULT NULL,
  `UpdateDateTime` datetime DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Summary` text,
  `StartDateTime` datetime DEFAULT NULL,
  UNIQUE KEY `Id` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BackgroundProcess`
--

LOCK TABLES `BackgroundProcess` WRITE;
/*!40000 ALTER TABLE `BackgroundProcess` DISABLE KEYS */;
/*!40000 ALTER TABLE `BackgroundProcess` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `BackgroundProcessUpdate`
--

DROP TABLE IF EXISTS `BackgroundProcessUpdate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BackgroundProcessUpdate` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UpdateDateTime` datetime DEFAULT NULL,
  `UpdateMessage` text,
  `BackgroundProcess` int(11) DEFAULT NULL,
  `SearchMetaInfo` text,
  UNIQUE KEY `Id` (`Id`),
  KEY `BackgroundProcess` (`BackgroundProcess`),
  CONSTRAINT `BackgroundProcessUpdate_BackgroundProcess` FOREIGN KEY (`BackgroundProcess`) REFERENCES `BackgroundProcess` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BackgroundProcessUpdate`
--

LOCK TABLES `BackgroundProcessUpdate` WRITE;
/*!40000 ALTER TABLE `BackgroundProcessUpdate` DISABLE KEYS */;
/*!40000 ALTER TABLE `BackgroundProcessUpdate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EmailMessage`
--

DROP TABLE IF EXISTS `EmailMessage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EmailMessage` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `SentDate` datetime DEFAULT NULL,
  `FromAddress` varchar(150) DEFAULT NULL,
  `ReplyEmail` varchar(150) DEFAULT NULL,
  `Recipients` text,
  `Cc` text,
  `Bcc` text,
  `Subject` text,
  `EmailMessage` text,
  `Attachments` text,
  `ErrorInfo` text,
  UNIQUE KEY `Id` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EmailMessage`
--

LOCK TABLES `EmailMessage` WRITE;
/*!40000 ALTER TABLE `EmailMessage` DISABLE KEYS */;
/*!40000 ALTER TABLE `EmailMessage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EmailTemplate`
--

DROP TABLE IF EXISTS `EmailTemplate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EmailTemplate` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `TemplateName` varchar(200) DEFAULT NULL,
  `CcAddresses` text,
  `BccAddresses` text,
  `Published` int(11) DEFAULT NULL,
  UNIQUE KEY `Id` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EmailTemplate`
--

LOCK TABLES `EmailTemplate` WRITE;
/*!40000 ALTER TABLE `EmailTemplate` DISABLE KEYS */;
/*!40000 ALTER TABLE `EmailTemplate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EmailTemplateContentBlock`
--

DROP TABLE IF EXISTS `EmailTemplateContentBlock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EmailTemplateContentBlock` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ContentBlock` text,
  `ContentType` varchar(50) DEFAULT NULL,
  `Position` varchar(50) DEFAULT NULL,
  `EmailTemplateContentRow` int(11) DEFAULT NULL,
  `SearchMetaInfo` text,
  UNIQUE KEY `Id` (`Id`),
  KEY `EmailTemplateContentRow` (`EmailTemplateContentRow`),
  CONSTRAINT `EmailTemplateContentBlock_EmailTemplateContentRow` FOREIGN KEY (`EmailTemplateContentRow`) REFERENCES `EmailTemplateContentRow` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EmailTemplateContentBlock`
--

LOCK TABLES `EmailTemplateContentBlock` WRITE;
/*!40000 ALTER TABLE `EmailTemplateContentBlock` DISABLE KEYS */;
/*!40000 ALTER TABLE `EmailTemplateContentBlock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EmailTemplateContentRow`
--

DROP TABLE IF EXISTS `EmailTemplateContentRow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EmailTemplateContentRow` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Columns` int(11) DEFAULT NULL,
  `RowOrder` int(11) DEFAULT NULL,
  `EmailTemplate` int(11) DEFAULT NULL,
  `SearchMetaInfo` text,
  UNIQUE KEY `Id` (`Id`),
  KEY `EmailTemplate` (`EmailTemplate`),
  CONSTRAINT `EmailTemplateContentRow_EmailTemplate` FOREIGN KEY (`EmailTemplate`) REFERENCES `EmailTemplate` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EmailTemplateContentRow`
--

LOCK TABLES `EmailTemplateContentRow` WRITE;
/*!40000 ALTER TABLE `EmailTemplateContentRow` DISABLE KEYS */;
/*!40000 ALTER TABLE `EmailTemplateContentRow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FileDocument`
--

DROP TABLE IF EXISTS `FileDocument`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FileDocument` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FileName` varchar(200) DEFAULT NULL,
  `Path` varchar(300) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  UNIQUE KEY `Id` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FileDocument`
--

LOCK TABLES `FileDocument` WRITE;
/*!40000 ALTER TABLE `FileDocument` DISABLE KEYS */;
/*!40000 ALTER TABLE `FileDocument` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `LoginToken`
--

DROP TABLE IF EXISTS `LoginToken`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LoginToken` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `LoginToken` varchar(50) DEFAULT NULL,
  `Account` int(11) DEFAULT NULL,
  `SearchMetaInfo` text,
  UNIQUE KEY `Id` (`Id`),
  UNIQUE KEY `LoginToken` (`LoginToken`),
  KEY `Account` (`Account`),
  CONSTRAINT `LoginToken_Account` FOREIGN KEY (`Account`) REFERENCES `Account` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LoginToken`
--

LOCK TABLES `LoginToken` WRITE;
/*!40000 ALTER TABLE `LoginToken` DISABLE KEYS */;
/*!40000 ALTER TABLE `LoginToken` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PageView`
--

DROP TABLE IF EXISTS `PageView`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PageView` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `TimeStamped` datetime DEFAULT NULL,
  `IPAddress` varchar(50) DEFAULT NULL,
  `PageDetails` varchar(500) DEFAULT NULL,
  `UserAgentDetails` text,
  `UserRole` varchar(200) DEFAULT NULL,
  `Username` varchar(200) DEFAULT NULL,
  UNIQUE KEY `Id` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PageView`
--

LOCK TABLES `PageView` WRITE;
/*!40000 ALTER TABLE `PageView` DISABLE KEYS */;
INSERT INTO `PageView` VALUES (1,'2017-07-12 10:29:56','::1','/sDev-Base/DatabaseManagement/ManageDatabase.php','Application: Apache <br>Server Name: localhost <br>HTTP User Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36 <br>','Anonymous','Anonymous'),(2,'2017-07-12 10:30:17','::1','/sDev-Base/assets/_core/php/_devtools/start_page.php','Application: Apache <br>Server Name: localhost <br>HTTP User Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36 <br>','Anonymous','Anonymous'),(3,'2017-07-12 10:30:30','::1','/sDev-Base/sDevORM/index.php','Application: Apache <br>Server Name: localhost <br>HTTP User Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36 <br>','Anonymous','Anonymous'),(4,'2017-07-12 10:30:39','::1','/sDev-Base/assets/_core/php/_devtools/start_page.php','Application: Apache <br>Server Name: localhost <br>HTTP User Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36 <br>','Anonymous','Anonymous'),(5,'2017-07-12 10:30:49','::1','/sDev-Base/App/User/PlaceHolder_Overview/','Application: Apache <br>Server Name: localhost <br>HTTP User Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36 <br>','Anonymous','Anonymous'),(6,'2017-07-12 10:34:06','::1','/sDev-Base/assets/_core/php/_devtools/start_page.php','Application: Apache <br>Server Name: localhost <br>HTTP User Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36 <br>','Anonymous','Anonymous'),(7,'2017-07-12 10:34:08','::1','/sDev-Base/DatabaseManagement/ManageDatabase.php','Application: Apache <br>Server Name: localhost <br>HTTP User Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36 <br>','Anonymous','Anonymous'),(8,'2017-07-12 10:34:15','::1','/sDev-Base/DatabaseManagement/ManageDatabase.php','Application: Apache <br>Server Name: localhost <br>HTTP User Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36 <br>','Anonymous','Anonymous'),(9,'2017-07-12 10:34:44','::1','/sDev-Base/DatabaseManagement/ManageDatabase.php','Application: Apache <br>Server Name: localhost <br>HTTP User Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36 <br>','Anonymous','Anonymous'),(10,'2017-07-12 10:34:58','::1','/sDev-Base/DatabaseManagement/ManageDatabase.php','Application: Apache <br>Server Name: localhost <br>HTTP User Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36 <br>','Anonymous','Anonymous');
/*!40000 ALTER TABLE `PageView` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PasswordReset`
--

DROP TABLE IF EXISTS `PasswordReset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PasswordReset` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Token` varchar(200) DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `Account` int(11) DEFAULT NULL,
  `SearchMetaInfo` text,
  UNIQUE KEY `Id` (`Id`),
  UNIQUE KEY `Token` (`Token`),
  KEY `Account` (`Account`),
  CONSTRAINT `PasswordReset_Account` FOREIGN KEY (`Account`) REFERENCES `Account` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PasswordReset`
--

LOCK TABLES `PasswordReset` WRITE;
/*!40000 ALTER TABLE `PasswordReset` DISABLE KEYS */;
/*!40000 ALTER TABLE `PasswordReset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PlaceHolder`
--

DROP TABLE IF EXISTS `PlaceHolder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PlaceHolder` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `DummyOne` date DEFAULT NULL,
  `DummyTwo` varchar(20) DEFAULT NULL,
  `DummyThree` int(11) DEFAULT NULL,
  `DummyFour` int(11) DEFAULT NULL,
  `DummyFive` datetime DEFAULT NULL,
  `DummySix` double DEFAULT NULL,
  `Account` int(11) DEFAULT NULL,
  `SearchMetaInfo` text,
  `UserRole` int(11) DEFAULT NULL,
  UNIQUE KEY `Id` (`Id`),
  UNIQUE KEY `DummyFour` (`DummyFour`),
  KEY `Account` (`Account`),
  KEY `UserRole` (`UserRole`),
  CONSTRAINT `PlaceHolder_Account` FOREIGN KEY (`Account`) REFERENCES `Account` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `PlaceHolder_UserRole` FOREIGN KEY (`UserRole`) REFERENCES `UserRole` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PlaceHolder`
--

LOCK TABLES `PlaceHolder` WRITE;
/*!40000 ALTER TABLE `PlaceHolder` DISABLE KEYS */;
INSERT INTO `PlaceHolder` VALUES (1,'2017-07-03','Result,Test',123,1,'2017-07-08 15:02:00',456,NULL,NULL,NULL),(2,NULL,'Test,Result',NULL,0,NULL,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `PlaceHolder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RemoteAccess`
--

DROP TABLE IF EXISTS `RemoteAccess`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RemoteAccess` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IpAddress` varchar(50) DEFAULT NULL,
  `AccessDateTime` datetime DEFAULT NULL,
  UNIQUE KEY `Id` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RemoteAccess`
--

LOCK TABLES `RemoteAccess` WRITE;
/*!40000 ALTER TABLE `RemoteAccess` DISABLE KEYS */;
/*!40000 ALTER TABLE `RemoteAccess` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SummernoteEntry`
--

DROP TABLE IF EXISTS `SummernoteEntry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SummernoteEntry` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `EntryHtml` text,
  `AuthorId` varchar(100) DEFAULT NULL,
  `LastChangedDate` datetime DEFAULT NULL,
  UNIQUE KEY `Id` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SummernoteEntry`
--

LOCK TABLES `SummernoteEntry` WRITE;
/*!40000 ALTER TABLE `SummernoteEntry` DISABLE KEYS */;
/*!40000 ALTER TABLE `SummernoteEntry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserRole`
--

DROP TABLE IF EXISTS `UserRole`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UserRole` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Role` varchar(50) DEFAULT NULL,
  UNIQUE KEY `Id` (`Id`),
  UNIQUE KEY `Role` (`Role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserRole`
--

LOCK TABLES `UserRole` WRITE;
/*!40000 ALTER TABLE `UserRole` DISABLE KEYS */;
INSERT INTO `UserRole` VALUES (1,'Administrator'),(2,'User');
/*!40000 ALTER TABLE `UserRole` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-12 10:35:03
