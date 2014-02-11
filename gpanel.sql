-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2014 at 01:56 AM
-- Server version: 5.5.25
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gpanel`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_article`
--

CREATE TABLE IF NOT EXISTS `ci_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ci_article`
--

INSERT INTO `ci_article` (`id`, `category_id`, `date_created`) VALUES
(2, 2, '2014-02-11 21:47:34');

-- --------------------------------------------------------

--
-- Table structure for table `ci_article_lang`
--

CREATE TABLE IF NOT EXISTS `ci_article_lang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `text` text NOT NULL,
  `uri` varchar(250) NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ci_article_lang`
--

INSERT INTO `ci_article_lang` (`id`, `article_id`, `lang_id`, `title`, `text`, `uri`, `enabled`) VALUES
(3, 2, 1, 'Lorem Ipsum has been the industry', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&nbsp;</p>\r\n\r\n<div><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>\r\n\r\n<div>&nbsp;</div>\r\n\r\n<div><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>\r\n', 'ro-lorem-ipsum-has-been-the-industry-2', 1),
(4, 2, 2, 'Lorem Ipsum has been the industry', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&nbsp;</p>\r\n\r\n<div><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>\r\n\r\n<div>&nbsp;</div>\r\n\r\n<div><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>\r\n', 'en-lorem-ipsum-has-been-the-industry-2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_category`
--

CREATE TABLE IF NOT EXISTS `ci_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `uri` varchar(250) NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ci_category`
--

INSERT INTO `ci_category` (`id`, `parent`, `title`, `uri`, `enabled`) VALUES
(1, 0, 'Blog', 'blog', 1),
(2, 1, 'About', 'about', 1),
(3, 1, 'Events', 'events', 1),
(4, 0, 'News', 'news', 1),
(5, 4, 'Social', 'social', 1),
(6, 4, 'Media', 'media', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_file`
--

CREATE TABLE IF NOT EXISTS `ci_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `path` varchar(250) NOT NULL,
  `module_id` int(11) NOT NULL,
  `module_name` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL DEFAULT 'unidentified',
  `size` float NOT NULL,
  `ord` int(11) NOT NULL,
  `uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `ci_file`
--

INSERT INTO `ci_file` (`id`, `name`, `path`, `module_id`, `module_name`, `type`, `size`, `ord`, `uploaded`) VALUES
(20, '', '/upload/files/santuan.JPG', 7, 'page', 'image', 0, 0, '2013-10-06 17:01:00'),
(21, '', '/upload/files/Capture.JPG', 9, 'page', 'image', 0, 0, '2013-10-06 17:03:43'),
(22, '', '/upload/files/1385050_528403780575536_1335968142_n.jpg', 13, 'page', 'image', 0, 0, '2013-10-06 20:34:32'),
(23, 'asdfcxvxczvxcv', '/upload/files/IMG_17183.JPG', 12, 'page', 'image', 2850670, 24, '2014-02-11 21:30:20'),
(24, 'fdsfasdf', '/upload/files/IMG_17184.JPG', 12, 'page', 'image', 2850670, 0, '2014-02-11 21:30:44'),
(25, 'Imagine articol', '/upload/files/IMG_17151.JPG', 2, 'page', 'image', 1520140, 25, '2014-02-11 21:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `ci_lang`
--

CREATE TABLE IF NOT EXISTS `ci_lang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `ext` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ci_lang`
--

INSERT INTO `ci_lang` (`id`, `name`, `ext`) VALUES
(1, 'Romanian', 'ro'),
(2, 'English', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `ci_page`
--

CREATE TABLE IF NOT EXISTS `ci_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `ord` int(11) NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `ci_page`
--

INSERT INTO `ci_page` (`id`, `parent`, `ord`, `enabled`) VALUES
(5, 0, 1, 1),
(6, 5, 1, 1),
(7, 8, 1, 1),
(8, 6, 1, 1),
(9, 5, 1, 1),
(10, 6, 1, 1),
(11, 0, 1, 1),
(12, 8, 1, 1),
(13, 10, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_page_lang`
--

CREATE TABLE IF NOT EXISTS `ci_page_lang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `text` text NOT NULL,
  `uri` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `ci_page_lang`
--

INSERT INTO `ci_page_lang` (`id`, `page_id`, `lang_id`, `title`, `text`, `uri`) VALUES
(7, 5, 1, 'sdfasd', '', 'ro-sdfasd-5'),
(8, 5, 2, 'sdfasd', '', 'en-sdfasd-5'),
(9, 6, 1, 'qwee', '', 'ro-qwe-6'),
(10, 6, 2, 'qwe2', '', 'en-qwe-6'),
(11, 7, 1, 'dfsdfsdf1', '1', 'ro-dfsdfsdf-7'),
(12, 7, 2, 'dfsdfsdf2', '2', 'en-dfsdfsdf-7'),
(13, 8, 1, 'sdfdsfdsf', '', 'ro-sdfdsfdsf-8'),
(14, 8, 2, 'sdfdsfdsf', '', 'en-sdfdsfdsf-8'),
(15, 9, 1, 'sdfasdf', '', 'ro-sdfasdf-9'),
(16, 9, 2, 'sdfasdf', '', 'en-sdfasdf-9'),
(17, 10, 1, 'dfgfdgfdgdfg', '', 'ro-dfgfdgfdgdfg-10'),
(18, 10, 2, 'dfgfdgfdgdfg', '', 'en-dfgfdgfdgdfg-10'),
(19, 11, 1, 'hfgfhgfh', '', 'ro-hfgfhgfh-11'),
(20, 11, 2, 'hfgfhgfh', '', 'en-hfgfhgfh-11'),
(21, 12, 1, 'ggdhgfhfg', '', 'ro-ggdhgfhfg-12'),
(22, 12, 2, 'ggdhgfhfg', '', 'en-ggdhgfhfg-12'),
(23, 13, 1, 'ffdghfdhgfh', '', 'ro-ffdghfdhgfh-13'),
(24, 13, 2, 'ffdghfdhgfh', '', 'en-ffdghfdhgfh-13');

-- --------------------------------------------------------

--
-- Table structure for table `ci_var`
--

CREATE TABLE IF NOT EXISTS `ci_var` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL DEFAULT '0',
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ci_var`
--

INSERT INTO `ci_var` (`id`, `parent`, `name`) VALUES
(1, 0, 'namevar'),
(2, 0, 'dsfdsf'),
(3, 0, 'dsfdsf'),
(4, 0, 'dsfdsf'),
(5, 0, 'dsfdsf'),
(6, 0, 'dsfdsf'),
(7, 0, 'dsfdsf'),
(8, 0, 'dsfdsf');

-- --------------------------------------------------------

--
-- Table structure for table `ci_var_lang`
--

CREATE TABLE IF NOT EXISTS `ci_var_lang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `var_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `value` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ci_var_lang`
--

INSERT INTO `ci_var_lang` (`id`, `var_id`, `lang_id`, `value`) VALUES
(1, 1, 1, 'dcgvdgdfc sda dss'),
(2, 1, 2, 'fgfdbv cx 1'),
(3, 6, 1, 'dvfsdfdfs'),
(4, 6, 2, 'dsfsdfsdfsvcxvc'),
(5, 7, 1, 'dvfsdfdfs'),
(6, 7, 2, 'dsfsdfsdfsvcxvc'),
(7, 8, 1, 'dvfsdfdfs'),
(8, 8, 2, 'dsfsdfsdfsvcxvc');

-- --------------------------------------------------------

--
-- Table structure for table `g_menu`
--

CREATE TABLE IF NOT EXISTS `g_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `icon` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `top` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `g_menu`
--

INSERT INTO `g_menu` (`id`, `name`, `icon`, `url`, `top`) VALUES
(1, 'Settings', 'icon-wrench', 'settings', 0),
(2, 'Pages', 'icon-file-alt', 'pages', 0),
(3, 'Users', 'icon-user', 'users', 0),
(4, 'Menu', 'icon-list-alt', 'menu', 0),
(5, 'Articles', 'icon-paste', 'articles', 0),
(6, 'Vars', 'icon-font', 'vars', 0);

-- --------------------------------------------------------

--
-- Table structure for table `g_settings`
--

CREATE TABLE IF NOT EXISTS `g_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `value` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `g_settings`
--

INSERT INTO `g_settings` (`id`, `name`, `value`) VALUES
(1, 'title', 'dsfsdf1'),
(2, 'description', 'sdfsdfsdfsdf2'),
(3, 'email', 'sdfsdfsdfsdfsdfsdf3');

-- --------------------------------------------------------

--
-- Table structure for table `g_user`
--

CREATE TABLE IF NOT EXISTS `g_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(250) NOT NULL,
  `password` varchar(100) NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `g_user`
--

INSERT INTO `g_user` (`id`, `login`, `password`, `last_login`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2014-02-12 01:23:36');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
