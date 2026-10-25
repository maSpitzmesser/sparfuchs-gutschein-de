<?php



$Create_Offer_Table_Affilinet = "CREATE TABLE IF NOT EXISTS `offers_affilinet` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `shopid` int(9) NOT NULL,
  `title` tinytext COLLATE latin1_german2_ci,
  `type` varchar(255) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `worth` decimal(9,2) DEFAULT NULL,
  `unit` varchar(10) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `valid_from` date DEFAULT NULL,
  `valid_to` date DEFAULT NULL,
  `minimum_order_value` varchar(255) COLLATE latin1_german2_ci DEFAULT NULL,
  `existing_customers` varchar(255) COLLATE latin1_german2_ci DEFAULT NULL,
  `new_customers` varchar(255) COLLATE latin1_german2_ci DEFAULT NULL,
  `description` text COLLATE latin1_german2_ci,
  `guide` text COLLATE latin1_german2_ci NOT NULL,
  `forwardlink` varchar(255) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `frame` tinyint(11) NOT NULL DEFAULT '0',
  `code` text COLLATE latin1_german2_ci,
  `public` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`),
  FULLTEXT KEY `guide` (`guide`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci AUTO_INCREMENT=373";
        
        
$Create_Offer_Table_Zanox = "CREATE TABLE IF NOT EXISTS `offers_zanox` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `shopid` int(9) NOT NULL,
  `title` tinytext COLLATE latin1_german2_ci,
  `type` varchar(255) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `worth` decimal(9,2) DEFAULT NULL,
  `unit` varchar(10) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `valid_from` date DEFAULT NULL,
  `valid_to` date DEFAULT NULL,
  `minimum_order_value` varchar(255) COLLATE latin1_german2_ci DEFAULT NULL,
  `existing_customers` varchar(255) COLLATE latin1_german2_ci DEFAULT NULL,
  `new_customers` varchar(255) COLLATE latin1_german2_ci DEFAULT NULL,
  `description` text COLLATE latin1_german2_ci,
  `guide` text COLLATE latin1_german2_ci NOT NULL,
  `forwardlink` varchar(255) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `frame` tinyint(11) NOT NULL DEFAULT '0',
  `code` text COLLATE latin1_german2_ci,
  `public` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`),
  FULLTEXT KEY `guide` (`guide`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci AUTO_INCREMENT=373";
        
        
        
        
?>