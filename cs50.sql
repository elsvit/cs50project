-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 08 2017 г., 10:34
-- Версия сервера: 5.5.47-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `cs50`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id_comment` int(11) NOT NULL AUTO_INCREMENT,
  `id_img` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  `comment` text NOT NULL,
  `likes` text,
  PRIMARY KEY (`id_comment`),
  KEY `id_img` (`id_img`,`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- Структура таблицы `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `rights_group` int(11) DEFAULT '0',
  PRIMARY KEY (`id_group`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Структура таблицы `img`
--

CREATE TABLE IF NOT EXISTS `img` (
  `id_img` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `discribe` varchar(255) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `size` int(11) NOT NULL,
  `img_right` int(11) NOT NULL,
  `likes` text,
  `post` text,
  PRIMARY KEY (`id_img`),
  KEY `id_user` (`id_user`),
  KEY `id_user_2` (`id_user`),
  KEY `id_user_3` (`id_user`),
  KEY `id_user_4` (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Структура таблицы `imgext`
--

CREATE TABLE IF NOT EXISTS `imgext` (
  `id_ext` int(11) NOT NULL AUTO_INCREMENT,
  `id_img` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_ext`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `lastname` varchar(40) DEFAULT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(35) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `id_rights` int(11) NOT NULL,
  `avatar` varchar(70) DEFAULT NULL,
  `sex` enum('male','female','','') DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `place` varchar(50) DEFAULT NULL,
  `lang` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_2` (`email`),
  UNIQUE KEY `id` (`id`),
  KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Структура таблицы `usgroup`
--

CREATE TABLE IF NOT EXISTS `usgroup` (
  `id_usgroup` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `right` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_usgroup`),
  KEY `id_user` (`id_user`,`id_group`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='належність юзера до групи' AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `usgroup`
--

-- INSERT INTO `usgroup` (`id_usgroup`, `id_user`, `id_group`, `right`) VALUES
-- (1, 86, 1, 0),
-- (2, 70, 2, 0),
-- (6, 70, 4, 0),

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
