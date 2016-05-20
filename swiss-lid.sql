CREATE TABLE IF NOT EXISTS `sys_ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_ci_sessions`
--

INSERT INTO `sys_ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('d396368d709afa213069f8ccc12288d8', '120.89.112.166', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', 1419416074, 'a:10:{s:9:"user_data";s:0:"";s:9:"user_type";s:5:"ADMIN";s:7:"user_id";s:1:"2";s:9:"user_name";s:11:"Sohail Raza";s:10:"last_login";s:19:"2014-12-23 13:56:35";s:5:"email";s:18:"raza@webciters.com";s:5:"phone";s:13:"0031105509911";s:7:"address";s:30:"Boompjes 404, 3011XZ Rotterdam";s:5:"image";s:11:"default.jpg";s:8:"loggedin";s:4:"true";}'),
('2ef1aa3317302555dbdf0acfe6d403ba', '91.102.41.13', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0', 1419416723, ''),
('88398301d8d6681a612bc30cf2ed3559', '91.102.41.13', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0', 1419416724, ''),
('bcff4cfdba90bd34cc1fd3e82cabe6fe', '91.102.41.13', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0', 1419416730, '');

-- --------------------------------------------------------

--
-- Table structure for table `sys_offices`
--

CREATE TABLE IF NOT EXISTS `sys_offices` (
  `offices_id` int(11) NOT NULL AUTO_INCREMENT,
  `offices_name` varchar(500) NOT NULL,
  `offices_desc` varchar(500) NOT NULL,
  `offices_address1` varchar(500) NOT NULL,
  `offices_address2` varchar(500) NOT NULL,
  `offices_address3` varchar(500) NOT NULL,
  `offices_address4` varchar(500) NOT NULL,
  `offices_disclaimer` varchar(500) NOT NULL,
  `offices_phone` varchar(50) NOT NULL,
  `offices_mobile` varchar(50) NOT NULL,
  `offices_url` varchar(50) NOT NULL,
  `offices_country` varchar(50) NOT NULL,
  `offices_order` int(11) NOT NULL,
  `offices_status` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`offices_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `sys_offices`
--

INSERT INTO `sys_offices` (`offices_id`, `offices_name`, `offices_desc`, `offices_address1`, `offices_address2`, `offices_address3`, `offices_address4`, `offices_disclaimer`, `offices_phone`, `offices_mobile`, `offices_url`, `offices_country`, `offices_order`, `offices_status`) VALUES
(33, 'Swiss LED Technologies AG', 'this is located in swizerland', 'Baarerstrasse 43', '6300 Zug', 'Switzerland', '', '', '+41 848 04 08 48', '', 'www.swiss-led.com', 'CH', 1, 'Y'),
(34, 'Swiss LED Switzerland ', '', 'Chemin des Chalets 7', '1279 Chavannes de Bogis', 'Switzerland', '', '', '+41 22 510 56 22', '', 'www.swiss-led.com', 'CH', 2, 'Y'),
(35, 'Swiss LED Switzerland', '', 'Bedpran 2', '2855 Glovelier', 'Switzerland', '', '', '+ 41 32 426 56 56', '', 'www.swiss-led.com', 'CH', 4, 'Y'),
(36, 'Swiss LED Switzerland ', '', 'Freilagerstrasse 39', '8047 Zurich', 'Switzerland', '', '', '+41 848 040 848', '', 'www.swiss-led.com', 'CH', 3, 'Y'),
(37, 'Swiss LED Benelux', '', 'Oude Middenweg 231C', '2491 AG Den Haag', 'Netherlands', '', 'test', '+31 70 2500 231', '', 'www.swiss-led.com', 'NL', 9, 'Y'),
(38, 'Swiss LED Middle East ', '', 'Office #2004', 'Jumeirah Business Center 3', 'Cluster Y, Jumeirah Lakes Towers', 'United Arab Emirates', '', '+971 45 586295', '', 'www.swiss-led.com', 'AE', 7, 'Y'),
(39, 'Swiss LED South Africa', '', 'Unit B2, Northlands Deco Park', 'Newmarket Rd, Randburg, 2164', 'Johannesburg', 'South Africa', '', '+27 10 020 2023', '', 'www.swiss-led.com', 'ZA', 6, 'Y'),
(40, 'Swiss LED USA', '', '410 S Citrus Ave', 'Covina, CA 91723', 'United States of America', '', '', '+1 888 722 3118', '', 'www.swiss-led.com', 'US', 10, 'Y'),
(41, 'Swiss LED China', '', '24/F, Zhong Lu Square', 'Hua Qiao Cheng', 'Shenzhen 518053', 'China', '', '+86 135 000 60260', '', 'www.swiss-led.com', 'CN', 8, 'Y'),
(42, 'Swiss LED Spain ', '', 'C/ La Querra 2', '03580 Alfaz del Pi', 'Spain', '', '', '+ 34 965 887 671', '+ 34 693 728 000', 'www.swiss-led.com', 'ES', 5, 'Y'),
(43, 'Swiss LED Turkey', '', '1372. Sokak No: 16/101', 'Alsancak – Izmir 35210', 'Turkey', '', '', '+90 (0) 232 483 84 40', '+90 (0) 532 370 84 00', 'www.swiss-led.com', 'TR', 10, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `sys_options`
--

CREATE TABLE IF NOT EXISTS `sys_options` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `option_key` varchar(200) NOT NULL,
  `option_value` text NOT NULL,
  `common_id` varchar(200) NOT NULL,
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_id` (`option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sys_system`
--

CREATE TABLE IF NOT EXISTS `sys_system` (
  `system_id` int(22) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(200) DEFAULT NULL,
  `menu_text` varchar(200) DEFAULT NULL,
  `page_url` varchar(200) DEFAULT NULL,
  `page_slug` varchar(200) DEFAULT NULL,
  `icon_url` varchar(200) DEFAULT NULL,
  `display_order` int(11) DEFAULT NULL,
  `parent_slug` varchar(200) DEFAULT NULL,
  `status` enum('Y','N') DEFAULT NULL,
  `module_desc` varchar(500) NOT NULL,
  PRIMARY KEY (`system_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52751 ;

--
-- Dumping data for table `sys_system`
--

INSERT INTO `sys_system` (`system_id`, `page_title`, `menu_text`, `page_url`, `page_slug`, `icon_url`, `display_order`, `parent_slug`, `status`, `module_desc`) VALUES
(52749, 'Signature Preview', 'Signature Preview', 'signature/signature.php', 'signature', 'entypo-brush', 5, '0', 'Y', 'videolist'),
(52750, 'Regional Offices', 'Regional Offices', 'offices/offices.php', 'offices', 'entypo-book', 5, '0', 'Y', 'videolist');

-- --------------------------------------------------------

--
-- Table structure for table `sys_user`
--

CREATE TABLE IF NOT EXISTS `sys_user` (
  `user_id` int(22) NOT NULL AUTO_INCREMENT,
  `status` enum('Y','N') DEFAULT 'Y',
  `first_name` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `display_order` int(11) DEFAULT NULL,
  `user_type` enum('ADMIN','USER','RUNNER','TRAINER','SPONSOR') DEFAULT 'USER',
  `last_login` datetime DEFAULT NULL,
  `last_name` varchar(400) NOT NULL,
  `address` varchar(500) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `image` varchar(500) NOT NULL DEFAULT 'default.jpg',
  `user_name` varchar(50) NOT NULL,
  `registered_date` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sys_user`
--

INSERT INTO `sys_user` (`user_id`, `status`, `first_name`, `password`, `email`, `display_order`, `user_type`, `last_login`, `last_name`, `address`, `phone`, `image`, `user_name`, `registered_date`) VALUES
(2, 'Y', 'Durga', 'e10adc3949ba59abbe56e057f20f883e', 'dps.bhusal@gmail.com', NULL, 'ADMIN', '2016-05-19 22:52:02', 'Sharma', 'Boompjes 404, 3011XZ Rotterdam', '0031105509911', 'default.jpg', 'admin', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sys_user_setting`
--

CREATE TABLE IF NOT EXISTS `sys_user_setting` (
  `user_setting_id` int(22) NOT NULL AUTO_INCREMENT,
  `system_id` int(22) DEFAULT NULL,
  `user_id` int(22) DEFAULT NULL,
  PRIMARY KEY (`user_setting_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `sys_user_setting`
--

INSERT INTO `sys_user_setting` (`user_setting_id`, `system_id`, `user_id`) VALUES
(19, 229, 3),
(20, 231, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sys_website_setting`
--

CREATE TABLE IF NOT EXISTS `sys_website_setting` (
  `website_setting_id` int(22) NOT NULL AUTO_INCREMENT,
  `field_name` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `field_text` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `field_value` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `display_order` int(11) NOT NULL,
  PRIMARY KEY (`website_setting_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `sys_website_setting`
--

INSERT INTO `sys_website_setting` (`website_setting_id`, `field_name`, `field_text`, `field_value`, `display_order`) VALUES
(1, 'email_address', 'Email Address', 'alexsharma68@gmail.com', 2),
(5, 'website_logo', 'Website Logo', 'swiss_led.gif', 10),
(11, 'site_name', 'Title', 'Swiss LED', 0),
(12, 'site_slug', 'Sub Title', 'Technologies AG', 1),
(13, 'regional_offices', 'Regional Offices Lists', 'Switzerland — United States — South Africa — United Arab Emirates — China — Netherlands — Spain — Turkey', 8),
(14, 'slogan', 'Slogan', 'Technologies for the future', 9),
(15, 'disclaimer', 'Disclaimer', 'The information in this e-mail and in any attachment is confidential and intended solely for the attention of the named addressee. If you have received this e-mail by error, please inform us immediately and delete this message and any attachment from your system without producing, distributing or retaining copies hereof. All our activities are subject to our General Terms and Conditions that can be found on our website.', 9);
