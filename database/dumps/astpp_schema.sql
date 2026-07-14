/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.5.29-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: astpp
-- ------------------------------------------------------
-- Server version	10.5.29-MariaDB-0+deb11u1

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
-- Table structure for table `accessnumber`
--

DROP TABLE IF EXISTS `accessnumber`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `accessnumber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `access_number` varchar(25) DEFAULT NULL,
  `country_id` int(11) NOT NULL DEFAULT 0,
  `description` varchar(1000) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 for active and 1 for inactive',
  `creation_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `account_unverified`
--

DROP TABLE IF EXISTS `account_unverified`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `account_unverified` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reseller_id` int(11) NOT NULL,
  `number` varchar(20) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `country_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `timezone_id` int(11) NOT NULL,
  `otp` int(11) NOT NULL,
  `retries` int(11) NOT NULL,
  `client_ip` varchar(50) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(20) NOT NULL,
  `reseller_id` int(11) DEFAULT NULL COMMENT 'Resellers account id',
  `pricelist_id` int(11) NOT NULL COMMENT 'pricelist table id',
  `paypal_permission` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:enable,1:disable',
  `reference` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:active,1:inactive',
  `sweep_id` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Sweep list table id',
  `creation` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `credit_limit` decimal(20,5) NOT NULL DEFAULT 0.00000,
  `posttoexternal` tinyint(1) NOT NULL DEFAULT 0,
  `balance` decimal(20,5) NOT NULL DEFAULT 0.00000,
  `password` varchar(100) NOT NULL DEFAULT '',
  `first_name` varchar(40) NOT NULL DEFAULT '',
  `last_name` varchar(40) NOT NULL DEFAULT '',
  `company_name` varchar(40) NOT NULL DEFAULT '',
  `address_1` varchar(80) NOT NULL DEFAULT '',
  `address_2` varchar(80) NOT NULL DEFAULT '',
  `postal_code` varchar(12) NOT NULL DEFAULT '',
  `province` varchar(20) NOT NULL DEFAULT '',
  `city` varchar(20) NOT NULL DEFAULT '',
  `country_id` int(11) NOT NULL DEFAULT 0 COMMENT 'Country table id',
  `telephone_1` varchar(20) NOT NULL DEFAULT '',
  `telephone_2` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(80) NOT NULL DEFAULT '',
  `notification_email` varchar(80) NOT NULL DEFAULT '',
  `language_id` int(11) NOT NULL DEFAULT 0 COMMENT 'language table id',
  `currency_id` int(11) NOT NULL DEFAULT 0 COMMENT 'Currency table id',
  `maxchannels` int(11) NOT NULL DEFAULT 1,
  `cps` int(11) NOT NULL DEFAULT 0,
  `dialed_modify` mediumtext NOT NULL,
  `type` tinyint(1) DEFAULT 0,
  `timezone_id` int(11) NOT NULL DEFAULT 0 COMMENT 'timezone table id',
  `inuse` int(11) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=deleted',
  `notify_credit_limit` decimal(20,5) NOT NULL DEFAULT 0.00000,
  `notify_flag` tinyint(1) NOT NULL,
  `notify_email` varchar(80) NOT NULL,
  `commission_rate` int(11) NOT NULL DEFAULT 0,
  `invoice_day` int(11) NOT NULL DEFAULT 0,
  `invoice_interval` int(11) NOT NULL,
  `invoice_note` text NOT NULL,
  `last_bill_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pin` varchar(20) NOT NULL,
  `first_used` datetime NOT NULL,
  `expiry` datetime NOT NULL,
  `validfordays` int(11) NOT NULL DEFAULT 3652,
  `local_call_cost` decimal(20,5) NOT NULL DEFAULT 0.00000,
  `pass_link_status` tinyint(1) NOT NULL DEFAULT 0,
  `local_call` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1:enable,0:disable',
  `charge_per_min` varchar(100) NOT NULL,
  `is_recording` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 for On,1 for Off',
  `allow_ip_management` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1:enable,0:disable',
  `permission_id` int(11) NOT NULL DEFAULT 0,
  `deleted_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `localization_id` int(11) DEFAULT 0,
  `notifications` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:enable,1:disable',
  `is_distributor` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 for yes and 1 for No ',
  `generate_invoice` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:enable,1:disable',
  `std_cid_translation` varchar(100) NOT NULL,
  `did_cid_translation` varchar(100) NOT NULL,
  `tax_number` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `number` (`number`),
  KEY `pricelist` (`pricelist_id`),
  KEY `reseller` (`reseller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `accounts_callerid`
--

DROP TABLE IF EXISTS `accounts_callerid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `accounts_callerid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountid` int(11) NOT NULL DEFAULT 0,
  `callerid_name` varchar(30) NOT NULL DEFAULT '',
  `callerid_number` varchar(20) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 active 1 inactive',
  PRIMARY KEY (`id`),
  KEY `accountid` (`accountid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `accounts_cdr_summary`
--

DROP TABLE IF EXISTS `accounts_cdr_summary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `accounts_cdr_summary` (
  `date_hour` datetime NOT NULL DEFAULT current_timestamp(),
  `country_id` int(11) NOT NULL,
  `account_entity_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `reseller_id` int(11) NOT NULL,
  `total_calls` int(11) NOT NULL,
  `answered_calls` smallint(6) NOT NULL,
  `minutes` smallint(6) NOT NULL,
  `debit` decimal(20,5) NOT NULL,
  `cost` decimal(20,5) NOT NULL,
  `acd` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`date_hour`,`country_id`,`account_id`,`reseller_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `activity_reports`
--

DROP TABLE IF EXISTS `activity_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountid` int(11) NOT NULL,
  `reseller_id` int(11) NOT NULL DEFAULT 1,
  `last_did_call_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_outbound_call_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `balance` varchar(40) NOT NULL,
  `credit_limit` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `accountid` (`accountid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `addons`
--

DROP TABLE IF EXISTS `addons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `addons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_name` varchar(30) NOT NULL,
  `version` varchar(10) NOT NULL,
  `installed_date` timestamp NULL DEFAULT NULL,
  `last_updated_date` timestamp NULL DEFAULT NULL,
  `files` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ani_map`
--

DROP TABLE IF EXISTS `ani_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ani_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(20) NOT NULL DEFAULT '',
  `accountid` int(11) NOT NULL DEFAULT 0,
  `reseller_id` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0-Active,1-inactive',
  `context` varchar(20) NOT NULL DEFAULT '',
  `creation_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `last_modified_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `number` (`number`),
  KEY `account` (`accountid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `automated_report_log`
--

DROP TABLE IF EXISTS `automated_report_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `automated_report_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(100) DEFAULT NULL,
  `usercode` varchar(50) DEFAULT NULL,
  `creation_date` datetime NOT NULL,
  `purge_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `backup_database`
--

DROP TABLE IF EXISTS `backup_database`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `backup_database` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `backup_name` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `path` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `block_patterns`
--

DROP TABLE IF EXISTS `block_patterns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `block_patterns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountid` int(11) NOT NULL DEFAULT 0,
  `blocked_patterns` varchar(15) NOT NULL DEFAULT '',
  `destination` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `accountid` (`accountid`),
  KEY `blocked_patterns` (`blocked_patterns`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `calltype`
--

DROP TABLE IF EXISTS `calltype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `calltype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `call_type` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 for active,1 for inactive,2 for delete',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 active 1 inactive',
  `creation_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cdrs`
--

DROP TABLE IF EXISTS `cdrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cdrs` (
  `uniqueid` varchar(60) NOT NULL DEFAULT '',
  `accountid` int(11) DEFAULT 0,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `sip_user` varchar(20) NOT NULL DEFAULT '',
  `callerid` varchar(120) NOT NULL,
  `callednum` varchar(30) NOT NULL DEFAULT '',
  `translated_dst` varchar(30) NOT NULL,
  `ct` int(11) NOT NULL DEFAULT 0,
  `billseconds` smallint(6) NOT NULL DEFAULT 0,
  `trunk_id` smallint(6) NOT NULL DEFAULT 0,
  `trunkip` varchar(15) NOT NULL DEFAULT '',
  `callerip` varchar(15) NOT NULL DEFAULT '',
  `disposition` varchar(45) NOT NULL DEFAULT '',
  `callstart` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `debit` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `cost` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `pricelist_id` smallint(6) NOT NULL DEFAULT 0,
  `package_id` int(11) NOT NULL DEFAULT 0,
  `pattern` varchar(20) NOT NULL,
  `notes` varchar(80) NOT NULL,
  `invoiceid` int(11) NOT NULL DEFAULT 0,
  `rate_cost` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `reseller_id` int(11) NOT NULL DEFAULT 0,
  `reseller_code` varchar(20) NOT NULL,
  `reseller_code_destination` varchar(80) DEFAULT NULL,
  `reseller_cost` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `provider_code` varchar(20) NOT NULL,
  `provider_code_destination` varchar(80) NOT NULL,
  `provider_cost` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `provider_call_cost` decimal(20,6) NOT NULL,
  `call_direction` enum('outbound','inbound') NOT NULL,
  `calltype` enum('STANDARD','DID','FREE','CALLINGCARD','FAX','LOCAL','BROADCAST') NOT NULL DEFAULT 'STANDARD',
  `billmsec` int(11) NOT NULL DEFAULT 0,
  `answermsec` int(11) NOT NULL DEFAULT 0,
  `waitmsec` int(11) NOT NULL DEFAULT 0,
  `progress_mediamsec` int(11) NOT NULL DEFAULT 0,
  `flow_billmsec` int(11) NOT NULL DEFAULT 0,
  `is_recording` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 for On,1 for Off',
  `call_request` tinyint(4) NOT NULL DEFAULT 0,
  `country_id` int(11) NOT NULL DEFAULT 0,
  `end_stamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `cdr_index` (`callstart`,`reseller_id`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='cdrs';
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`astppuser`@`localhost`*/ /*!50003 TRIGGER `cdr_records` AFTER INSERT ON `cdrs` FOR EACH ROW BEGIN
   INSERT INTO `cdrs_staging` (`uniqueid`, `accountid`, `type`, `sip_user`, `callerid`, `callednum`, `translated_dst`, `ct`, `billseconds`, `trunk_id`, `trunkip`, `callerip`, `disposition`, `callstart`, `debit`, `cost`, `provider_id`, `pricelist_id`, `package_id`, `pattern`, `notes`, `invoiceid`, `rate_cost`, `reseller_id`, `reseller_code`, `reseller_code_destination`, `reseller_cost`, `provider_code`, `provider_code_destination`, `provider_cost`, `provider_call_cost`, `call_direction`, `calltype`, `billmsec`, `answermsec`, `waitmsec`, `progress_mediamsec`, `flow_billmsec`, `is_recording`, `call_request`, `country_id`,`end_stamp`) VALUES (NEW.uniqueid, NEW.accountid, NEW.type, NEW.sip_user, NEW.callerid, NEW.callednum, NEW.translated_dst, NEW.ct, NEW.billseconds, NEW.trunk_id, NEW.trunkip, NEW.callerip, NEW.disposition, NEW.callstart, NEW.debit, NEW.cost, NEW.provider_id, NEW.pricelist_id, NEW.package_id, NEW.pattern, NEW.notes, NEW.invoiceid, NEW.rate_cost, NEW.reseller_id, NEW.reseller_code, NEW.reseller_code_destination, NEW.reseller_cost, NEW.provider_code, NEW.provider_code_destination, NEW.provider_cost, NEW.provider_call_cost, NEW.call_direction, NEW.calltype, NEW.billmsec, NEW.answermsec, NEW.waitmsec, NEW.progress_mediamsec, NEW.flow_billmsec, NEW.is_recording, NEW.call_request, NEW.country_id,NEW.end_stamp);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`astppuser`@`localhost`*/ /*!50003 TRIGGER `activity_reports` AFTER INSERT ON `cdrs` FOR EACH ROW BEGIN
IF (NEW.calltype = 'DID' AND NEW.call_direction = 'outbound') THEN
  INSERT INTO `activity_reports` (accountid,reseller_id,last_did_call_time,balance,credit_limit) VALUES (NEW.accountid, NEW.reseller_id, NEW.callstart,(SELECT balance from accounts where id=NEW.accountid),(SELECT credit_limit from accounts where id=NEW.accountid)) ON DUPLICATE KEY UPDATE `last_did_call_time`=NEW.callstart,`balance`=VALUES(balance),`credit_limit`=VALUES(credit_limit);
ELSEIF (NEW.calltype = 'STANDARD') THEN
    INSERT INTO `activity_reports` (accountid, reseller_id,last_outbound_call_time,balance,credit_limit) VALUES (NEW.accountid, NEW.reseller_id, NEW.callstart,(SELECT balance from accounts where id=NEW.accountid),(SELECT credit_limit from accounts where id=NEW.accountid)) ON DUPLICATE KEY UPDATE `last_outbound_call_time`=NEW.callstart,`balance`=VALUES(balance),`credit_limit`=VALUES(credit_limit);
END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `cdrs_day_by_summary`
--

DROP TABLE IF EXISTS `cdrs_day_by_summary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cdrs_day_by_summary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `reseller_id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `country_id` int(11) NOT NULL,
  `billseconds` int(11) NOT NULL,
  `mcd` int(11) NOT NULL,
  `total_calls` int(11) NOT NULL,
  `debit` decimal(10,5) NOT NULL,
  `cost` decimal(10,5) NOT NULL,
  `total_answered_call` int(11) NOT NULL,
  `total_fail_call` int(11) NOT NULL,
  `unique_date` varchar(50) NOT NULL DEFAULT '00000000',
  `calldate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_index` (`account_id`,`reseller_id`,`country_id`,`unique_date`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cdrs_staging`
--

DROP TABLE IF EXISTS `cdrs_staging`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cdrs_staging` (
  `uniqueid` varchar(60) NOT NULL DEFAULT '',
  `accountid` int(11) DEFAULT 0,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `sip_user` varchar(20) NOT NULL DEFAULT '',
  `callerid` varchar(120) NOT NULL,
  `callednum` varchar(30) NOT NULL DEFAULT '',
  `translated_dst` varchar(30) NOT NULL,
  `ct` int(11) NOT NULL DEFAULT 0,
  `billseconds` smallint(6) NOT NULL DEFAULT 0,
  `trunk_id` smallint(6) NOT NULL DEFAULT 0,
  `trunkip` varchar(15) NOT NULL DEFAULT '',
  `callerip` varchar(15) NOT NULL DEFAULT '',
  `disposition` varchar(45) NOT NULL DEFAULT '',
  `callstart` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `debit` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `cost` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `pricelist_id` smallint(6) NOT NULL DEFAULT 0,
  `package_id` int(11) NOT NULL DEFAULT 0,
  `pattern` varchar(20) NOT NULL,
  `notes` varchar(80) NOT NULL,
  `invoiceid` int(11) NOT NULL DEFAULT 0,
  `rate_cost` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `reseller_id` int(11) NOT NULL DEFAULT 0,
  `reseller_code` varchar(20) NOT NULL,
  `reseller_code_destination` varchar(80) DEFAULT NULL,
  `reseller_cost` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `provider_code` varchar(20) NOT NULL,
  `provider_code_destination` varchar(80) NOT NULL,
  `provider_cost` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `provider_call_cost` decimal(20,6) NOT NULL,
  `call_direction` enum('outbound','inbound') NOT NULL,
  `calltype` enum('STANDARD','DID','FREE','CALLINGCARD','FAX') NOT NULL DEFAULT 'STANDARD',
  `billmsec` int(11) NOT NULL DEFAULT 0,
  `answermsec` int(11) NOT NULL DEFAULT 0,
  `waitmsec` int(11) NOT NULL DEFAULT 0,
  `progress_mediamsec` int(11) NOT NULL DEFAULT 0,
  `flow_billmsec` int(11) NOT NULL DEFAULT 0,
  `is_recording` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 for On,1 for Off',
  `call_request` tinyint(4) NOT NULL DEFAULT 0,
  `country_id` int(11) NOT NULL DEFAULT 0,
  `end_stamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT 0,
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cli_group`
--

DROP TABLE IF EXISTS `cli_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cli_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL DEFAULT '0',
  `description` varchar(100) NOT NULL,
  `reseller_id` int(11) DEFAULT 0 COMMENT 'Accoun',
  `mapping_expired_by` char(5) NOT NULL,
  `mapping_expired_after` char(5) NOT NULL,
  `assignment_method` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `creation_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `last_access_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `reseller` (`reseller_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `commission`
--

DROP TABLE IF EXISTS `commission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `commission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `accountid` int(11) NOT NULL,
  `reseller_id` int(11) NOT NULL DEFAULT 0,
  `payment_id` int(11) NOT NULL DEFAULT 0,
  `amount` decimal(10,5) NOT NULL DEFAULT 0.00000,
  `commission` decimal(10,5) NOT NULL DEFAULT 0.00000,
  `commission_rate` decimal(10,5) NOT NULL DEFAULT 0.00000,
  `commission_status` varchar(10) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `counters`
--

DROP TABLE IF EXISTS `counters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `counters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `package_id` int(11) NOT NULL DEFAULT 0,
  `accountid` int(11) NOT NULL DEFAULT 0,
  `used_seconds` int(11) NOT NULL DEFAULT 0,
  `type` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `package_id` (`product_id`),
  KEY `accountid` (`accountid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `countrycode`
--

DROP TABLE IF EXISTS `countrycode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `countrycode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_id` int(11) NOT NULL,
  `iso` char(2) NOT NULL,
  `country` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `countrycode` int(11) NOT NULL,
  `vat` decimal(10,5) NOT NULL DEFAULT 0.00000,
  `latitude` varchar(20) NOT NULL,
  `longitude` varchar(20) NOT NULL,
  `capital` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`iso`)
) ENGINE=InnoDB AUTO_INCREMENT=223 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cron_settings`
--

DROP TABLE IF EXISTS `cron_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cron_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `command` varchar(50) NOT NULL,
  `exec_interval` int(11) NOT NULL DEFAULT 1,
  `creation_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `last_modified_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `last_execution_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `next_execution_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `file_path` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency` varchar(3) NOT NULL DEFAULT '',
  `currencyname` varchar(40) NOT NULL DEFAULT '',
  `currencyrate` decimal(10,3) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_supported` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `currency` (`currency`),
  KEY `currencyrate` (`currencyrate`)
) ENGINE=InnoDB AUTO_INCREMENT=192 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `default_templates`
--

DROP TABLE IF EXISTS `default_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `default_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL DEFAULT '',
  `subject` varchar(500) NOT NULL,
  `description` varchar(512) NOT NULL,
  `sms_template` varchar(500) NOT NULL,
  `alert_template` varchar(500) NOT NULL,
  `template` mediumtext NOT NULL,
  `last_modified_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `reseller_id` int(11) NOT NULL DEFAULT 0,
  `is_email_enable` tinyint(1) NOT NULL DEFAULT 0,
  `is_sms_enable` tinyint(1) NOT NULL,
  `is_alert_enable` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `did_call_types`
--

DROP TABLE IF EXISTS `did_call_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `did_call_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `call_type_code` varchar(55) NOT NULL,
  `call_type` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dids`
--

DROP TABLE IF EXISTS `dids`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dids` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(40) NOT NULL DEFAULT '',
  `accountid` int(11) NOT NULL DEFAULT 0 COMMENT 'Accounts table id',
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `connectcost` decimal(20,5) NOT NULL DEFAULT 0.00000,
  `includedseconds` int(11) NOT NULL DEFAULT 0,
  `monthlycost` decimal(20,5) NOT NULL DEFAULT 0.00000,
  `cost` double(20,5) NOT NULL DEFAULT 0.00000,
  `init_inc` int(11) NOT NULL DEFAULT 0,
  `inc` int(11) NOT NULL,
  `extensions` varchar(180) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 for active 1 for inactive',
  `provider_id` int(11) NOT NULL DEFAULT 0,
  `country_id` int(11) NOT NULL DEFAULT 0,
  `province` varchar(20) NOT NULL DEFAULT '',
  `city` varchar(20) NOT NULL DEFAULT '',
  `setup` decimal(20,5) NOT NULL DEFAULT 0.00000,
  `maxchannels` int(11) NOT NULL DEFAULT 0,
  `call_type` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'call type',
  `leg_timeout` int(11) NOT NULL DEFAULT 30,
  `product_id` int(11) NOT NULL,
  `always` int(11) NOT NULL,
  `always_destination` varchar(50) NOT NULL,
  `user_busy` int(11) NOT NULL,
  `user_busy_destination` varchar(50) NOT NULL,
  `user_not_registered` int(11) NOT NULL,
  `user_not_registered_destination` varchar(50) NOT NULL,
  `no_answer` int(11) NOT NULL,
  `no_answer_destination` varchar(50) NOT NULL,
  `failover_extensions` varchar(180) NOT NULL,
  `failover_call_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 enable 1 for disable',
  `always_vm_flag` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 enable 1 for disable',
  `user_busy_vm_flag` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 enable 1 for disable',
  `user_not_registered_vm_flag` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 enable 1 for disable',
  `no_answer_vm_flag` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 enable 1 for disable',
  `call_type_vm_flag` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 enable 1 for disable',
  `last_modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `account` (`accountid`),
  KEY `number` (`number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `freeswich_servers`
--

DROP TABLE IF EXISTS `freeswich_servers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `freeswich_servers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freeswitch_host` varchar(100) NOT NULL,
  `freeswitch_password` varchar(50) NOT NULL,
  `freeswitch_port` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Active , 1= inactive',
  `creation_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `last_modified_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `gateways`
--

DROP TABLE IF EXISTS `gateways`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `gateways` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sip_profile_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(20) NOT NULL DEFAULT '',
  `gateway_data` text NOT NULL,
  `created_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `accountid` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 for Active 1 for Inactive',
  `dialplan_variable` varchar(500) NOT NULL,
  `last_modified_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `invoice_conf`
--

DROP TABLE IF EXISTS `invoice_conf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoice_conf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountid` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `address` varchar(300) NOT NULL,
  `city` varchar(20) NOT NULL,
  `province` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `emailaddress` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `invoice_prefix` varchar(11) NOT NULL DEFAULT 'INV_',
  `invoice_start_from` int(11) NOT NULL DEFAULT 1,
  `logo` varchar(100) NOT NULL,
  `favicon` varchar(100) NOT NULL,
  `invoice_note` text NOT NULL,
  `invoice_due_notification` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:enable,1:disable',
  `invoice_notification` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:enable,1:disable',
  `no_usage_invoice` tinyint(4) NOT NULL DEFAULT 0,
  `interval` varchar(11) NOT NULL,
  `notify_before_day` int(11) NOT NULL DEFAULT 1,
  `invoice_taxes_number` varchar(100) NOT NULL DEFAULT 'ABN 12 345 678 901',
  `domain` varchar(100) NOT NULL,
  `website_title` varchar(100) NOT NULL,
  `website_footer` varchar(100) NOT NULL,
  `reseller_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `invoice_details`
--

DROP TABLE IF EXISTS `invoice_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoice_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountid` int(11) NOT NULL,
  `reseller_id` int(11) NOT NULL DEFAULT 0,
  `invoiceid` int(11) NOT NULL DEFAULT 0,
  `order_item_id` int(11) NOT NULL DEFAULT 0,
  `charge_type` varchar(30) NOT NULL,
  `payment_id` int(11) NOT NULL DEFAULT 0,
  `product_category` int(11) NOT NULL DEFAULT 0,
  `is_tax` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 FOR NO AND 1 FOR YES',
  `base_currency` varchar(5) NOT NULL,
  `exchange_rate` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `account_currency` varchar(5) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `debit` decimal(20,5) NOT NULL DEFAULT 0.00000,
  `credit` decimal(20,5) NOT NULL DEFAULT 0.00000,
  `created_date` datetime NOT NULL,
  `generate_type` int(11) NOT NULL DEFAULT 0 COMMENT '0:Auto 1:manually',
  `before_balance` varchar(100) NOT NULL DEFAULT '0',
  `after_balance` varchar(100) NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT 1 COMMENT 'Default will be 1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(25) NOT NULL,
  `number` varchar(200) NOT NULL,
  `accountid` int(11) NOT NULL DEFAULT 0,
  `reseller_id` int(11) NOT NULL DEFAULT 0,
  `payment_id` int(11) NOT NULL DEFAULT 0,
  `from_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `to_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `due_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:paid,1:unpaid,2:partial_payment',
  `generate_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `type` enum('I','R') NOT NULL DEFAULT 'I' COMMENT 'I => Invoice R=> Receipt',
  `generate_type` int(11) NOT NULL DEFAULT 0 COMMENT '0:Auto 1:manually',
  `confirm` int(11) DEFAULT 0 COMMENT '0:not conform 1:conform',
  `notes` longtext NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:Not delete 1:delete',
  PRIMARY KEY (`id`),
  KEY `accountid` (`accountid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ip_map`
--

DROP TABLE IF EXISTS `ip_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ip_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `ip` varchar(30) NOT NULL DEFAULT '',
  `accountid` int(11) NOT NULL DEFAULT 0 COMMENT 'Accounts table id',
  `reseller_id` int(11) NOT NULL DEFAULT 0,
  `pricelist_id` int(11) NOT NULL DEFAULT 0,
  `prefix` varchar(20) NOT NULL DEFAULT '',
  `context` varchar(20) NOT NULL DEFAULT 'default',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0-Active,1-inactive',
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_modified_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `account` (`accountid`),
  KEY `ip` (`ip`),
  KEY `prefix` (`prefix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(5) NOT NULL,
  `languagename` varchar(40) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `locale` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `locale` (`locale`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `license`
--

DROP TABLE IF EXISTS `license`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `license` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `license_key` varchar(30) NOT NULL,
  `localkey` text NOT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_updated_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `localization`
--

DROP TABLE IF EXISTS `localization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `localization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `account_id` int(11) NOT NULL,
  `reseller_id` int(11) NOT NULL DEFAULT 0,
  `country_id` int(11) NOT NULL,
  `in_caller_id_originate` varchar(200) NOT NULL,
  `out_caller_id_originate` varchar(200) NOT NULL,
  `number_originate` varchar(200) NOT NULL,
  `in_caller_id_terminate` varchar(200) NOT NULL,
  `out_caller_id_terminate` varchar(200) NOT NULL,
  `number_terminate` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `creation_date` datetime DEFAULT '1000-01-01 00:00:00',
  `modified_date` datetime DEFAULT '1000-01-01 00:00:00',
  `dst_base_cid` varchar(200) NOT NULL,
  `custom_rule` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `login_activity_report`
--

DROP TABLE IF EXISTS `login_activity_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `login_activity_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `country_name` varchar(200) NOT NULL,
  `ip` varchar(255) NOT NULL DEFAULT '',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mail_details`
--

DROP TABLE IF EXISTS `mail_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `mail_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `subject` varchar(100) NOT NULL,
  `body` mediumtext NOT NULL,
  `from` varchar(100) NOT NULL,
  `to` varchar(100) NOT NULL,
  `attachment` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 : Send 1: Not send',
  `template` varchar(100) NOT NULL,
  `reseller_id` int(11) NOT NULL DEFAULT 0,
  `to_number` varchar(20) NOT NULL,
  `sms_body` varchar(500) NOT NULL,
  `sip_user_name` varchar(255) NOT NULL,
  `push_message_body` varchar(555) NOT NULL,
  `callkit_token` varchar(512) NOT NULL,
  `status_code` int(11) NOT NULL,
  `cc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menu_modules`
--

DROP TABLE IF EXISTS `menu_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_label` varchar(25) NOT NULL,
  `module_name` varchar(25) NOT NULL,
  `module_url` varchar(100) NOT NULL,
  `menu_title` varchar(20) NOT NULL,
  `menu_image` varchar(25) NOT NULL,
  `menu_subtitle` varchar(20) NOT NULL,
  `priority` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=563 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_category` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,5) NOT NULL DEFAULT 0.00000,
  `setup_fee` decimal(10,5) NOT NULL DEFAULT 0.00000,
  `billing_type` int(11) NOT NULL,
  `billing_days` int(11) NOT NULL DEFAULT 0,
  `free_minutes` int(11) NOT NULL DEFAULT 0,
  `accountid` int(11) NOT NULL,
  `reseller_id` int(11) NOT NULL,
  `billing_date` datetime NOT NULL,
  `next_billing_date` datetime NOT NULL,
  `is_terminated` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 FOR NO AND 1 FOR YES',
  `termination_date` datetime NOT NULL,
  `termination_note` varchar(255) NOT NULL,
  `from_currency` varchar(3) NOT NULL,
  `exchange_rate` decimal(10,5) NOT NULL DEFAULT 1.00000,
  `to_currency` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) NOT NULL,
  `parent_order_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `order_generated_by` int(11) NOT NULL,
  `payment_gateway` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `accountid` int(11) NOT NULL,
  `reseller_id` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `outbound_routes`
--

DROP TABLE IF EXISTS `outbound_routes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `outbound_routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pattern` varchar(15) DEFAULT NULL,
  `comment` varchar(80) DEFAULT '',
  `connectcost` decimal(20,5) NOT NULL DEFAULT 0.00000,
  `includedseconds` int(11) NOT NULL DEFAULT 0,
  `cost` decimal(20,5) NOT NULL DEFAULT 0.00000,
  `trunk_id` int(11) NOT NULL DEFAULT 0,
  `inc` int(11) NOT NULL,
  `strip` varchar(40) NOT NULL DEFAULT '',
  `prepend` varchar(40) NOT NULL DEFAULT '',
  `precedence` int(11) NOT NULL DEFAULT 0,
  `reseller_id` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 for active 1 for inactive',
  `init_inc` int(11) NOT NULL DEFAULT 0,
  `creation_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `last_modified_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pattern2` (`pattern`,`trunk_id`),
  KEY `trunk` (`trunk_id`),
  KEY `pattern` (`pattern`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `package_patterns`
--

DROP TABLE IF EXISTS `package_patterns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `package_patterns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT 0,
  `patterns` varchar(50) NOT NULL,
  `destination` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_id` (`product_id`,`country_id`,`patterns`),
  KEY `package_id` (`product_id`),
  KEY `patterns` (`patterns`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `packages_view`
--

DROP TABLE IF EXISTS `packages_view`;
/*!50001 DROP VIEW IF EXISTS `packages_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `packages_view` AS SELECT
 1 AS `id`,
  1 AS `product_id`,
  1 AS `package_name`,
  1 AS `free_minutes`,
  1 AS `applicable_for`,
  1 AS `accountid` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `payment_transaction`
--

DROP TABLE IF EXISTS `payment_transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountid` int(11) NOT NULL,
  `amount` decimal(20,5) NOT NULL,
  `tax` varchar(10) NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `actual_amount` decimal(20,5) NOT NULL,
  `payment_fee` decimal(20,5) NOT NULL DEFAULT 0.00000,
  `reseller_id` int(11) NOT NULL DEFAULT 0,
  `transaction_id` varchar(50) NOT NULL,
  `customer_ip` varchar(100) NOT NULL,
  `user_currency` varchar(50) NOT NULL,
  `currency_rate` decimal(10,5) NOT NULL COMMENT 'user currency rate against base currency rate',
  `transaction_details` mediumtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `reseller_id` int(11) NOT NULL DEFAULT 0,
  `description` text NOT NULL,
  `login_type` tinyint(1) NOT NULL DEFAULT 0,
  `permissions` text NOT NULL,
  `edit_permissions` longtext NOT NULL,
  `creation_date` datetime NOT NULL,
  `modification_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pricelists`
--

DROP TABLE IF EXISTS `pricelists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `pricelists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `markup` varchar(50) NOT NULL DEFAULT '0',
  `routing_type` tinyint(1) NOT NULL DEFAULT 0,
  `initially_increment` int(11) NOT NULL,
  `inc` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 for active,1 for inactive,2 for delete',
  `reseller_id` int(11) NOT NULL DEFAULT 0 COMMENT 'Accounts table id',
  `pricelist_id_admin` int(11) NOT NULL DEFAULT 0,
  `routing_prefix` varchar(100) NOT NULL,
  `call_count` int(11) NOT NULL DEFAULT 0,
  `creation_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `reseller_id` (`reseller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`astppuser`@`localhost`*/ /*!50003 TRIGGER `updateRates` AFTER UPDATE ON `pricelists` FOR EACH ROW BEGIN
   if new.status = '2'
   then
       Delete from routes where pricelist_id = new.id;
   end if;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `country_id` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `product_category` int(11) NOT NULL,
  `buy_cost` decimal(20,5) NOT NULL DEFAULT 0.00000,
  `price` decimal(20,5) DEFAULT 0.00000,
  `setup_fee` decimal(20,5) NOT NULL DEFAULT 0.00000,
  `can_resell` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 for no,0 for yes',
  `commission` decimal(10,5) NOT NULL DEFAULT 0.00000,
  `billing_type` tinyint(1) NOT NULL,
  `billing_days` int(11) NOT NULL DEFAULT 0,
  `free_minutes` int(11) NOT NULL DEFAULT 0,
  `applicable_for` int(11) NOT NULL,
  `apply_on_existing_account` tinyint(1) NOT NULL,
  `apply_on_rategroups` varchar(50) NOT NULL,
  `destination_rategroups` varchar(50) NOT NULL,
  `destination_countries` varchar(256) NOT NULL,
  `destination_calltypes` varchar(50) NOT NULL,
  `release_no_balance` tinyint(1) NOT NULL,
  `can_purchase` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 for yes, 1 for no',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 for active,1 for inactive',
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 for no,1 for yes',
  `created_by` int(11) NOT NULL,
  `reseller_id` int(11) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `last_modified_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `provider_cdr_summary`
--

DROP TABLE IF EXISTS `provider_cdr_summary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `provider_cdr_summary` (
  `date_hour` varchar(25) NOT NULL,
  `country_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `trunk_id` int(11) NOT NULL,
  `total_calls` int(11) NOT NULL,
  `answered_calls` int(11) NOT NULL,
  `minutes` varchar(50) NOT NULL,
  `cost` decimal(15,3) NOT NULL,
  PRIMARY KEY (`date_hour`,`country_id`,`provider_id`,`trunk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `q850code`
--

DROP TABLE IF EXISTS `q850code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `q850code` (
  `cause` varchar(70) NOT NULL,
  `code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ratedeck`
--

DROP TABLE IF EXISTS `ratedeck`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ratedeck` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `destination` varchar(80) NOT NULL,
  `country_id` int(11) NOT NULL,
  `pattern` varchar(40) NOT NULL,
  `call_type` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1 = Disabled / Inactive / False / No , 0 = Enable / Active / True / Yes,2->Deleted',
  `reseller_id` int(11) NOT NULL DEFAULT 0,
  `creation_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `last_modified_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `pattern` (`pattern`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `refill_coupon`
--

DROP TABLE IF EXISTS `refill_coupon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `refill_coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(30) NOT NULL,
  `amount` decimal(20,5) NOT NULL,
  `description` varchar(55) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=Active,1=Inactive,2-Inuse',
  `firstused` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `account_id` int(11) NOT NULL,
  `reseller_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reports_process_list`
--

DROP TABLE IF EXISTS `reports_process_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `reports_process_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_execution_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reseller_cdrs`
--

DROP TABLE IF EXISTS `reseller_cdrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `reseller_cdrs` (
  `uniqueid` varchar(60) NOT NULL DEFAULT '',
  `accountid` int(11) DEFAULT 0,
  `callerid` varchar(120) NOT NULL DEFAULT '',
  `callednum` varchar(30) NOT NULL DEFAULT '',
  `translated_dst` varchar(30) NOT NULL,
  `billseconds` smallint(6) NOT NULL DEFAULT 0,
  `disposition` varchar(45) NOT NULL DEFAULT '',
  `callstart` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `debit` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `cost` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `pricelist_id` smallint(6) NOT NULL DEFAULT 0,
  `package_id` smallint(6) NOT NULL DEFAULT 0,
  `pattern` varchar(20) NOT NULL,
  `notes` varchar(80) NOT NULL,
  `calltype` enum('STANDARD','DID','FREE','CALLINGCARD','FAX','LOCAL') NOT NULL DEFAULT 'STANDARD',
  `reseller_id` int(11) NOT NULL DEFAULT 0,
  `rate_cost` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `reseller_code` varchar(20) NOT NULL DEFAULT '',
  `reseller_code_destination` varchar(80) NOT NULL DEFAULT '',
  `reseller_cost` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `call_direction` enum('outbound','inbound') NOT NULL,
  `call_request` tinyint(4) NOT NULL DEFAULT 0,
  `country_id` int(11) NOT NULL,
  `end_stamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `trunk_id` int(11) NOT NULL,
  KEY `rs_cdr_index` (`callstart`,`reseller_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='cdrs';
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`astppuser`@`localhost`*/ /*!50003 TRIGGER `reseller_cdrs_records` AFTER INSERT ON `reseller_cdrs` FOR EACH ROW BEGIN
   INSERT INTO `cdrs_staging` (`uniqueid`, `accountid`, `callerid`, `callednum`, `billseconds`, `disposition`, `callstart`, `debit`, `cost`, `pricelist_id`, `package_id`, `pattern`, `notes`, `calltype`, `reseller_id`, `rate_cost`, `reseller_code`, `reseller_code_destination`, `reseller_cost`, `call_direction`, `call_request`, `country_id`,`end_stamp`) VALUES ( NEW.uniqueid, NEW.accountid, NEW.callerid, NEW.callednum, NEW.billseconds, NEW.disposition, NEW.callstart, NEW.debit, NEW.cost, NEW.pricelist_id, NEW.package_id, NEW.pattern, NEW.notes, NEW.calltype, NEW.reseller_id, NEW.rate_cost, NEW.reseller_code, NEW.reseller_code_destination, NEW.reseller_cost, NEW.call_direction, NEW.call_request, NEW.country_id,NEW.end_stamp);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `reseller_products`
--

DROP TABLE IF EXISTS `reseller_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `reseller_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `reseller_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `buy_cost` decimal(10,5) NOT NULL DEFAULT 0.00000,
  `price` decimal(10,5) NOT NULL DEFAULT 0.00000,
  `free_minutes` int(11) NOT NULL DEFAULT 0,
  `commission` decimal(10,5) NOT NULL DEFAULT 0.00000,
  `setup_fee` decimal(10,5) NOT NULL DEFAULT 0.00000,
  `billing_days` int(11) NOT NULL,
  `billing_type` tinyint(4) NOT NULL COMMENT '0 for onetime,1 for recurring',
  `is_owner` tinyint(4) NOT NULL COMMENT '0 for yes, 1 for no',
  `is_optin` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 for yes, 1 for no',
  `optin_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `modified_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_id` (`product_id`,`account_id`,`reseller_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `roles_and_permission`
--

DROP TABLE IF EXISTS `roles_and_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles_and_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:Admin,1:Reseller',
  `permission_type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:Main,1:Edit',
  `menu_name` varchar(50) NOT NULL,
  `module_name` varchar(50) NOT NULL,
  `sub_module_name` varchar(50) NOT NULL,
  `module_url` varchar(50) NOT NULL,
  `display_name` varchar(100) NOT NULL,
  `permissions` mediumtext NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:Active,1:Inactive',
  `creation_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `priority` decimal(10,5) NOT NULL DEFAULT 0.00000,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `routes`
--

DROP TABLE IF EXISTS `routes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pattern` varchar(40) DEFAULT '',
  `comment` varchar(80) DEFAULT '',
  `connectcost` decimal(20,5) NOT NULL DEFAULT 0.00000,
  `includedseconds` int(11) NOT NULL,
  `cost` decimal(20,5) NOT NULL DEFAULT 0.00000,
  `pricelist_id` int(11) DEFAULT 0,
  `inc` int(11) DEFAULT NULL,
  `country_id` int(11) NOT NULL DEFAULT 0,
  `call_type` varchar(20) NOT NULL,
  `routing_type` varchar(50) NOT NULL,
  `percentage` varchar(50) NOT NULL,
  `call_count` int(11) NOT NULL,
  `accountid` int(11) DEFAULT 0,
  `reseller_id` int(11) DEFAULT 0,
  `precedence` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 for active 1 for inactive',
  `trunk_id` varchar(50) DEFAULT NULL COMMENT 'Trunk id for force routing',
  `init_inc` int(11) NOT NULL DEFAULT 0,
  `creation_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_rg_accid_key` (`pattern`,`pricelist_id`,`accountid`),
  KEY `pattern` (`pattern`),
  KEY `pricelist` (`pricelist_id`),
  KEY `reseller` (`reseller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `routing`
--

DROP TABLE IF EXISTS `routing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `routing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pricelist_id` int(11) NOT NULL,
  `trunk_id` int(11) NOT NULL,
  `routes_id` int(11) NOT NULL DEFAULT 0,
  `percentage` varchar(20) NOT NULL,
  `call_count` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sip_devices`
--

DROP TABLE IF EXISTS `sip_devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sip_devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL DEFAULT '',
  `sip_profile_id` int(11) NOT NULL DEFAULT 0,
  `reseller_id` int(11) NOT NULL DEFAULT 0,
  `accountid` int(11) NOT NULL DEFAULT 0,
  `dir_params` longtext NOT NULL,
  `dir_vars` longtext NOT NULL,
  `codec` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:active,1:inactive',
  `creation_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `last_modified_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `call_waiting` int(11) NOT NULL DEFAULT 0 COMMENT '0:Enable 1:Disable',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sip_profiles`
--

DROP TABLE IF EXISTS `sip_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sip_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `sip_ip` varchar(39) NOT NULL DEFAULT '',
  `sip_port` varchar(6) NOT NULL DEFAULT '',
  `profile_data` text NOT NULL,
  `created_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `last_modified_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `accountid` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 for active 1 for inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `speed_dial`
--

DROP TABLE IF EXISTS `speed_dial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `speed_dial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `speed_num` int(11) NOT NULL,
  `number` varchar(15) NOT NULL,
  `accountid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sweeplist`
--

DROP TABLE IF EXISTS `sweeplist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sweeplist` (
  `id` int(10) unsigned NOT NULL DEFAULT 0,
  `sweep` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `system`
--

DROP TABLE IF EXISTS `system`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(48) DEFAULT NULL,
  `display_name` varchar(255) NOT NULL,
  `value` varchar(1111) DEFAULT NULL,
  `field_type` varchar(250) NOT NULL DEFAULT 'default_system_input',
  `comment` varchar(255) DEFAULT NULL,
  `timestamp` datetime NOT NULL DEFAULT '2019-04-01 00:00:00',
  `reseller_id` int(11) NOT NULL,
  `is_display` tinyint(1) NOT NULL DEFAULT 0,
  `group_title` varchar(50) NOT NULL,
  `sub_group` varchar(200) NOT NULL,
  `field_rules` varchar(80) NOT NULL DEFAULT '' COMMENT 'CI Rules for validation',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `reseller` (`reseller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=603 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `taxes`
--

DROP TABLE IF EXISTS `taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `taxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taxes_priority` int(11) DEFAULT 1,
  `taxes_amount` decimal(20,5) NOT NULL DEFAULT 0.00000,
  `tax_type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:Default,1:Other',
  `taxes_rate` decimal(20,5) NOT NULL DEFAULT 0.00000,
  `taxes_description` varchar(255) NOT NULL,
  `reseller_id` int(11) NOT NULL DEFAULT 0,
  `last_modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `creation_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 for active 1 for inactive',
  PRIMARY KEY (`id`),
  KEY `taxes_priority` (`taxes_priority`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `taxes_to_accounts`
--

DROP TABLE IF EXISTS `taxes_to_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `taxes_to_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountid` int(11) NOT NULL DEFAULT 0,
  `taxes_id` int(11) NOT NULL DEFAULT 0,
  `taxes_priority` tinyint(4) NOT NULL DEFAULT 0,
  `assign_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `accountid` (`accountid`),
  KEY `taxes_id` (`taxes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `timezone`
--

DROP TABLE IF EXISTS `timezone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `timezone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gmttime` varchar(255) DEFAULT NULL,
  `gmtoffset` bigint(20) NOT NULL DEFAULT 0,
  `timezone_name` varchar(255) NOT NULL,
  `timezone_digit` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=426 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(255) NOT NULL,
  `en_En` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `en_En` (`en_En`)
) ENGINE=InnoDB AUTO_INCREMENT=2325 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `trunks`
--

DROP TABLE IF EXISTS `trunks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trunks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `tech` varchar(10) NOT NULL DEFAULT '',
  `gateway_id` int(11) NOT NULL DEFAULT 0,
  `failover_gateway_id` int(11) NOT NULL DEFAULT 0 COMMENT 'Fail over Gateway id',
  `failover_gateway_id1` int(11) NOT NULL DEFAULT 0,
  `provider_id` int(11) DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `dialed_modify` mediumtext NOT NULL,
  `resellers_id` varchar(11) NOT NULL DEFAULT '0',
  `precedence` int(11) NOT NULL DEFAULT 0,
  `maxchannels` int(11) NOT NULL DEFAULT 0,
  `cps` int(11) NOT NULL DEFAULT 0,
  `codec` varchar(100) NOT NULL,
  `leg_timeout` int(11) NOT NULL DEFAULT 30,
  `creation_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cid_translation` varchar(100) NOT NULL,
  `localization_id` int(11) NOT NULL,
  `sip_cid_type` varchar(50) NOT NULL COMMENT 'none:- None, rpid :- Remote-Party-ID, pid :- P-Asserted-Identity',
  PRIMARY KEY (`id`),
  KEY `provider` (`provider_id`),
  KEY `resellers_id` (`resellers_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`astppuser`@`localhost`*/ /*!50003 TRIGGER `updateTerminationRates` AFTER UPDATE ON `trunks` FOR EACH ROW BEGIN
   if new.status = '2'
   then
        Delete from outbound_routes where trunk_id = new.id;
   end if;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `userlevels`
--

DROP TABLE IF EXISTS `userlevels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `userlevels` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(15) NOT NULL,
  `module_permissions` varchar(2000) NOT NULL,
  PRIMARY KEY (`userlevelid`),
  KEY `userlevelname` (`userlevelname`),
  KEY `module_permissions` (`module_permissions`(1024))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usertracking`
--

DROP TABLE IF EXISTS `usertracking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `usertracking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(100) NOT NULL,
  `user_identifier` varchar(255) NOT NULL,
  `request_uri` mediumtext NOT NULL,
  `timestamp` datetime NOT NULL,
  `client_ip` varchar(50) NOT NULL,
  `client_user_agent` mediumtext NOT NULL,
  `referer_page` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4020 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `view_dids`
--

DROP TABLE IF EXISTS `view_dids`;
/*!50001 DROP VIEW IF EXISTS `view_dids`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `view_dids` AS SELECT
 1 AS `id`,
  1 AS `number`,
  1 AS `reseller_product_id`,
  1 AS `account_id`,
  1 AS `reseller_id`,
  1 AS `buyer_accountid`,
  1 AS `country_id`,
  1 AS `cost`,
  1 AS `call_type`,
  1 AS `city`,
  1 AS `province`,
  1 AS `leg_timeout`,
  1 AS `maxchannels`,
  1 AS `extensions`,
  1 AS `buy_cost`,
  1 AS `setup_fee`,
  1 AS `price`,
  1 AS `billing_type`,
  1 AS `billing_days`,
  1 AS `product_id`,
  1 AS `modified_date` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_invoices`
--

DROP TABLE IF EXISTS `view_invoices`;
/*!50001 DROP VIEW IF EXISTS `view_invoices`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `view_invoices` AS SELECT
 1 AS `id`,
  1 AS `number`,
  1 AS `accountid`,
  1 AS `reseller_id`,
  1 AS `from_date`,
  1 AS `to_date`,
  1 AS `due_date`,
  1 AS `status`,
  1 AS `is_paid`,
  1 AS `generate_date`,
  1 AS `type`,
  1 AS `payment_id`,
  1 AS `generate_type`,
  1 AS `confirm`,
  1 AS `notes`,
  1 AS `is_deleted`,
  1 AS `debit`,
  1 AS `debit_exchange_rate`,
  1 AS `credit`,
  1 AS `credit_exchange_rate` */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `packages_view`
--

/*!50001 DROP VIEW IF EXISTS `packages_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `packages_view` AS select `O`.`order_id` AS `id`,`P`.`id` AS `product_id`,`P`.`name` AS `package_name`,`O`.`free_minutes` AS `free_minutes`,`P`.`applicable_for` AS `applicable_for`,`O`.`accountid` AS `accountid` from (`products` `P` join `order_items` `O`) where `P`.`id` = `O`.`product_id` and `P`.`product_category` = 1 and `P`.`status` = 0 and (`O`.`termination_date` >= utc_timestamp() or `O`.`termination_date` = '0000-00-00 00:00:00') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_dids`
--

/*!50001 DROP VIEW IF EXISTS `view_dids`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_dids` AS select `dids`.`id` AS `id`,`dids`.`number` AS `number`,`reseller_products`.`id` AS `reseller_product_id`,`reseller_products`.`account_id` AS `account_id`,`reseller_products`.`reseller_id` AS `reseller_id`,if(`dids`.`parent_id` <> `reseller_products`.`account_id`,(select `subrpro`.`account_id` from `reseller_products` `subrpro` where `subrpro`.`id` > `reseller_products`.`id` order by `subrpro`.`id` limit 1),`dids`.`accountid`) AS `buyer_accountid`,`dids`.`country_id` AS `country_id`,`dids`.`cost` AS `cost`,`dids`.`call_type` AS `call_type`,`dids`.`city` AS `city`,`dids`.`province` AS `province`,`dids`.`leg_timeout` AS `leg_timeout`,`dids`.`maxchannels` AS `maxchannels`,`dids`.`extensions` AS `extensions`,`reseller_products`.`buy_cost` AS `buy_cost`,`reseller_products`.`setup_fee` AS `setup_fee`,`reseller_products`.`price` AS `price`,`reseller_products`.`billing_type` AS `billing_type`,`reseller_products`.`billing_days` AS `billing_days`,`reseller_products`.`product_id` AS `product_id`,`reseller_products`.`modified_date` AS `modified_date` from (`reseller_products` join `dids` on(`dids`.`product_id` = `reseller_products`.`product_id`)) where `reseller_products`.`is_optin` = 0 order by `reseller_products`.`account_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_invoices`
--

/*!50001 DROP VIEW IF EXISTS `view_invoices`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_invoices` AS select `invoices`.`id` AS `id`,concat(`invoices`.`prefix`,`invoices`.`number`) AS `number`,`invoices`.`accountid` AS `accountid`,`invoices`.`reseller_id` AS `reseller_id`,`invoices`.`from_date` AS `from_date`,`invoices`.`to_date` AS `to_date`,`invoices`.`due_date` AS `due_date`,`invoices`.`status` AS `status`,if((select `accounts`.`posttoexternal` from `accounts` where `accounts`.`id` = `invoices`.`accountid`) = 0,0,if(sum(`invoice_details`.`debit`) - sum(`invoice_details`.`credit`) = 0,0,1)) AS `is_paid`,`invoices`.`generate_date` AS `generate_date`,`invoices`.`type` AS `type`,`invoices`.`payment_id` AS `payment_id`,`invoices`.`generate_type` AS `generate_type`,`invoices`.`confirm` AS `confirm`,`invoices`.`notes` AS `notes`,`invoices`.`is_deleted` AS `is_deleted`,sum(`invoice_details`.`debit`) AS `debit`,sum(`invoice_details`.`debit` * `invoice_details`.`exchange_rate`) AS `debit_exchange_rate`,sum(`invoice_details`.`credit`) AS `credit`,sum(`invoice_details`.`credit` * `invoice_details`.`exchange_rate`) AS `credit_exchange_rate` from (`invoices` join `invoice_details` on(`invoices`.`id` = `invoice_details`.`invoiceid`)) group by `invoice_details`.`invoiceid` */;
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

-- Dump completed on 2026-06-14  0:57:18
