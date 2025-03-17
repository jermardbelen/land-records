-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 17, 2025 at 02:41 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `permits_db`
--
CREATE DATABASE `permits_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `permits_db`;

-- --------------------------------------------------------

--
-- Table structure for table `client_tb`
--

CREATE TABLE IF NOT EXISTS `client_tb` (
  `farm_permit_id` varchar(255) NOT NULL,
  `collectors_permit_id` varchar(50) DEFAULT NULL,
  `tin` varchar(50) DEFAULT NULL,
  `email_address` varchar(50) DEFAULT NULL,
  `group_id` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `company` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `municipality` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `permit_status` varchar(50) DEFAULT NULL,
  `expiration_date` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `mobile_number` varchar(50) DEFAULT NULL,
  `approved_date` varchar(50) DEFAULT NULL,
  `other_details` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`farm_permit_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `landsurvey_tb`
--

CREATE TABLE IF NOT EXISTS `landsurvey_tb` (
  `landsurvey_id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `email_address` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `areacode` varchar(50) DEFAULT NULL,
  `mobile_no` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `municipality` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `purpose` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`landsurvey_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `recordsdata_tb`
--

CREATE TABLE IF NOT EXISTS `recordsdata_tb` (
  `recordsdata_id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `landsurvey_id` varchar(1000) DEFAULT NULL,
  `survey_number` varchar(1000) DEFAULT NULL,
  `location` varchar(1000) DEFAULT NULL,
  `survey_plan` varchar(1000) DEFAULT NULL,
  `cadastral_map` varchar(1000) DEFAULT NULL,
  `lot_data_computation` varchar(1000) DEFAULT NULL,
  `lot_description` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`recordsdata_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `species_tb`
--

CREATE TABLE IF NOT EXISTS `species_tb` (
  `species_id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `wildlife_export_id` varchar(50) DEFAULT NULL,
  `common_name` varchar(50) DEFAULT NULL,
  `scientific_name` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `quantity_weight` varchar(50) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `family` varchar(50) DEFAULT NULL,
  `specimen_type` varchar(50) DEFAULT NULL,
  `acquisition_mode` varchar(50) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`species_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26249 ;

-- --------------------------------------------------------

--
-- Table structure for table `timber_permit_tb`
--

CREATE TABLE IF NOT EXISTS `timber_permit_tb` (
  `application_id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `timber_permit_no` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `date_approved` varchar(255) DEFAULT NULL,
  `date_apply` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `house_no` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `municipality` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`application_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tree_tb`
--

CREATE TABLE IF NOT EXISTS `tree_tb` (
  `tree_id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` varchar(255) DEFAULT NULL,
  `species` varchar(255) DEFAULT NULL,
  `dbh_dab` varchar(255) DEFAULT NULL,
  `mh` varchar(255) DEFAULT NULL,
  `th` varchar(255) DEFAULT NULL,
  `volume` varchar(255) DEFAULT NULL,
  `gps_northing` varchar(255) DEFAULT NULL,
  `gps_easting` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `stem_quality` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `common_name` varchar(255) DEFAULT NULL,
  `scientific_name` varchar(255) DEFAULT NULL,
  `family` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `entry_by` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `more_info` varchar(255) DEFAULT NULL,
  `optional` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`tree_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_tb`
--

CREATE TABLE IF NOT EXISTS `users_tb` (
  `user_id` varchar(255) NOT NULL,
  `username` varchar(1000) DEFAULT NULL,
  `password` varchar(1000) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `group_id` varchar(1000) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `birthdate` varchar(255) DEFAULT NULL,
  `contactnumber` varchar(255) DEFAULT NULL,
  `civilstatus` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `office` varchar(50) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `division` varchar(255) DEFAULT NULL,
  `esign_description` varchar(255) DEFAULT NULL,
  `authorized_esign` varchar(255) DEFAULT NULL,
  `details` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wildlife_export_tb`
--

CREATE TABLE IF NOT EXISTS `wildlife_export_tb` (
  `wildlife_export_id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `wec_no` varchar(50) DEFAULT NULL,
  `farm_permit_id` varchar(50) DEFAULT NULL,
  `no` varchar(1) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '1',
  `status` varchar(50) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `tin` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `municipality` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `consignee_lastname` varchar(50) DEFAULT NULL,
  `consignee_firstname` varchar(50) DEFAULT NULL,
  `consignee_middlename` varchar(50) DEFAULT NULL,
  `consignee_address` varchar(1000) DEFAULT NULL,
  `consignee_municipality` varchar(50) DEFAULT NULL,
  `consignee_province` varchar(50) DEFAULT NULL,
  `mobile_no` varchar(50) DEFAULT NULL,
  `email_address` varchar(50) DEFAULT NULL,
  `purpose` varchar(50) DEFAULT NULL,
  `exported_before_date` varchar(50) DEFAULT NULL,
  `shipment_mode` varchar(50) DEFAULT NULL,
  `shipment_location` varchar(50) DEFAULT NULL,
  `shipment_date` varchar(50) DEFAULT NULL,
  `date_issued` varchar(50) DEFAULT NULL,
  `expiration_date` varchar(50) DEFAULT NULL,
  `amount` varchar(50) DEFAULT NULL,
  `confirmation_no` varchar(50) DEFAULT NULL,
  `reference_no` varchar(50) DEFAULT NULL,
  `or_date` varchar(50) DEFAULT NULL,
  `local_transport_permit` varchar(50) DEFAULT NULL,
  `inspection_report` varchar(50) DEFAULT NULL,
  `export_declaration` varchar(50) DEFAULT NULL,
  `official_receipt` varchar(50) DEFAULT NULL,
  `sales_invoice` varchar(50) DEFAULT NULL,
  `other_attachment` varchar(50) DEFAULT NULL,
  `sales_invoice_amount` varchar(50) DEFAULT NULL,
  `processed_by` varchar(50) DEFAULT NULL,
  `remarks` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`wildlife_export_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2546 ;
