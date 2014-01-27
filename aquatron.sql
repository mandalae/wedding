-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 05, 2013 at 04:32 PM
-- Server version: 5.1.54
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aquatron`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl`
--

CREATE TABLE IF NOT EXISTS `acl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `acl_text` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `acl`
--

INSERT INTO `acl` (`id`, `name`, `acl_text`) VALUES
(1, 'Admin', 'admin'),
(2, 'Floor manager', 'floor'),
(3, 'Staff member', 'staff'),
(4, 'Student', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `seo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `seo` (`seo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `image_id`, `active`, `seo`) VALUES
(1, 'Scubapro', 0, 1359555323, 'scubapro'),
(2, 'Beuchat', 0, 1359560346, 'beuchat'),
(3, 'Oceanic', 0, 1359555374, 'oceanic'),
(4, 'Suunto', 0, 1359555387, 'suunto'),
(5, 'Mares', 0, 1359555409, 'mares');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_category` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `seo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `categories`
--


-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_danish_ci NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `ext` varchar(4) CHARACTER SET latin1 COLLATE latin1_danish_ci NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `width`, `height`, `ext`, `timestamp`) VALUES
(16, 'blackcatbonebackground.png', 991, 449, 'png', 1362227649);

-- --------------------------------------------------------

--
-- Table structure for table `image_tags`
--

CREATE TABLE IF NOT EXISTS `image_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `image_id_2` (`image_id`,`tag`),
  KEY `image_id` (`image_id`),
  FULLTEXT KEY `tag` (`tag`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `image_tags`
--

INSERT INTO `image_tags` (`id`, `image_id`, `tag`) VALUES
(1, 1, 'test'),
(2, 2, ''),
(3, 3, ''),
(4, 4, ''),
(5, 5, ''),
(6, 6, ''),
(7, 7, ''),
(8, 8, ''),
(9, 9, ''),
(10, 10, ''),
(11, 11, ''),
(12, 12, ''),
(13, 13, ''),
(14, 14, ''),
(15, 15, ''),
(16, 16, 'test'),
(17, 16, 'black cat bone');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brand` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `price` double NOT NULL,
  `discount_price` double NOT NULL,
  `active` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  `seo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `products`
--


-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `image` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `staff`
--


-- --------------------------------------------------------

--
-- Table structure for table `texts`
--

CREATE TABLE IF NOT EXISTS `texts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `headline` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `seo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visible` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `texts`
--

INSERT INTO `texts` (`id`, `content`, `headline`, `active`, `timestamp`, `seo`, `visible`) VALUES
(1, '<p><span style="font-size:12px;"><span style="font-family: verdana,geneva,sans-serif;">Congratulations to all of our divers with new qualifications! Click <a href="http://www.aquatron.co.uk/cgi-bin/web_store.cgi?page=newly_qualified_divers.html">here</a> to see details of those who have passed courses with us.</span></span></p>\r\n\r\n<p><span style="font-size:12px;"><span style="font-family: verdana,geneva,sans-serif;"><a href="http://www.aquatron.co.uk/cgi-bin/web_store.cgi?page=divertraining.html&amp;cart_id=4406918_161602468548_13496" target="_blank">Learn to Scuba Dive in Glasgow, Scotland with Padi courses run throughout the year!</a></span></span></p>\r\n\r\n<p><span style="font-size:12px;"><span style="font-family: verdana,geneva,sans-serif;">Join Aquatron on Facebook</span></span> or have a look at what UK diving has to offer</p>\r\n\r\n<p><span style="font-family:verdana,geneva,sans-serif;"><span style="font-size:12px;">AQUATRON is Scotland&#39;s Largest Padi 5 Star IDC Dive Centre with over 40 in business !</span></span></p>\r\n\r\n<p><span style="font-family:verdana,geneva,sans-serif;"><span style="font-size:12px;">We offer the best prices and best quality service for diving gear in the UK</span></span></p>\r\n\r\n<p><span style="font-family:verdana,geneva,sans-serif;"><span style="font-size:12px;">Established in 1969 - Still here, so we must be doing something right!</span></span></p>\r\n\r\n<p><span style="font-family:verdana,geneva,sans-serif;"><span style="font-size:12px;">Our Price Promise</span></span></p>\r\n\r\n<p><span style="font-family:verdana,geneva,sans-serif;"><span style="font-size:12px;">We are constantly monitoring prices from all the on-line &amp; mail order outlets in the UK to keep our prices as good as you can get! YOU can help us!!! Let us know of any UK price that is cheaper than ours and we will happily match it. <em>That&#39;s a promise</em>.</span></span></p>\r\n\r\n<p><span style="font-family:verdana,geneva,sans-serif;"><span style="font-size:12px;">Since we&#39;ve been in business for so long, not only have we built up our expertise, facilities and experience, we have aquired all the best agencies for the quality dive gear YOU want to have:</span></span></p>\r\n', 'Welcome to AQUATRON Dive Centre', 1360083617, 1360083617, 'welcome-to-aquatron-dive-centre', 1),
(2, 'Below are a few links to Dive Centres and other activities that we think would interest you.  Check them out and let us know what you think!', 'Links', 1358111634, 1358111634, 'links', 1),
(3, '<p>This is a test page</p>\r\n', 'Test page', 1359552738, 1359552738, 'test-page', 1),
(6, '<p>Meet the staff</p>\r\n', 'Staff', 1360496011, 1360496011, 'staff', 0),
(7, '<p>Use the form below to register as a user on Aquatron&#39;s new website.</p>\r\n\r\n<p>As a user you will be able to track your training and many other fancy features.</p>\r\n', 'Register', 1362252606, 1362252606, 'register', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `acl` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` int(11) NOT NULL,
  `phone` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `acl`, `timestamp`, `deleted`, `active`, `ip`, `name`, `address`, `zipcode`, `city`, `description`, `image`, `phone`) VALUES
(1, 'c@rpediem.com', '098f6bcd4621d373cade4e832627b4f6', 1, 1359122730, 0, 1360504524, '', 'Chris Skaaning', 'Flat 1/1, 129 Buccleuch Street', 'G3 6QN', 'Glasgow', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.', 0, 0),
(3, 'ds@aquatron.co.uk', '', 3, 0, 0, 1362250682, '', 'Derek Sweeney', '', '', '', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.', 16, 0),
(5, 'c@rpediem.dk', '098f6bcd4621d373cade4e832627b4f6', 4, 1362255283, 0, 1362255283, '', 'Chris Skaaning', '1-1, 129 Buccleuch Street', 'G3 6QN', 'Glasgow', '', 0, 0);
