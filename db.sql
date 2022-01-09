-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Янв 09 2022 г., 18:08
-- Версия сервера: 10.5.11-MariaDB-1:10.5.11+maria~focal
-- Версия PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `techlibrary_library`
--

-- --------------------------------------------------------

--
-- Структура таблицы `antiBotCode`
--

CREATE TABLE `antiBotCode` (
  `ID` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `datePut` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `authorList`
--

CREATE TABLE `authorList` (
  `ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `familyName` text NOT NULL,
  `bookCount` int(11) NOT NULL DEFAULT 0,
  `userID` int(11) NOT NULL DEFAULT 0,
  `datePut` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `booksAuthorList`
--

CREATE TABLE `booksAuthorList` (
  `ID` int(11) NOT NULL,
  `authorID` int(11) NOT NULL,
  `bookID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `booksCategoryList`
--

CREATE TABLE `booksCategoryList` (
  `ID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `bookID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `booksFileList`
--

CREATE TABLE `booksFileList` (
  `ID` int(11) NOT NULL,
  `storage` int(11) NOT NULL,
  `bookID` int(11) NOT NULL,
  `fileName` text NOT NULL,
  `fileSize` double NOT NULL,
  `fileFormat` enum('etc','djvu','pdf','txt') NOT NULL DEFAULT 'etc',
  `pages` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `booksImageList`
--

CREATE TABLE `booksImageList` (
  `ID` int(11) NOT NULL,
  `imageName` text NOT NULL,
  `bookID` int(11) NOT NULL,
  `storage` int(11) NOT NULL,
  `orderID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `booksList`
--

CREATE TABLE `booksList` (
  `ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `smallDescr` text NOT NULL,
  `descr` text NOT NULL,
  `year` int(4) NOT NULL,
  `format` enum('djvu','pdf','txt','etc') NOT NULL DEFAULT 'etc',
  `rating` float NOT NULL DEFAULT 0,
  `ratingCount` int(11) NOT NULL DEFAULT 0,
  `downloadCount` int(11) NOT NULL DEFAULT 0,
  `readCount` int(11) NOT NULL DEFAULT 0,
  `readTextCount` int(11) NOT NULL DEFAULT 0,
  `free` enum('no','yes') NOT NULL DEFAULT 'yes',
  `userID` int(11) NOT NULL DEFAULT 0,
  `approved` enum('no','yes','finish','list') NOT NULL DEFAULT 'no',
  `datePut` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `booksMessages`
--

CREATE TABLE `booksMessages` (
  `ID` int(11) NOT NULL,
  `userName` text NOT NULL,
  `bookID` int(11) NOT NULL,
  `message` text NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `approved` enum('no','yes') NOT NULL DEFAULT 'no',
  `datePut` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `booksPrintList`
--

CREATE TABLE `booksPrintList` (
  `ID` int(11) NOT NULL,
  `printID` int(11) NOT NULL,
  `bookID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `categoryList`
--

CREATE TABLE `categoryList` (
  `ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `descr` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `parentID` int(11) NOT NULL,
  `bookCount` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `confirmEmail`
--

CREATE TABLE `confirmEmail` (
  `ID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `hash` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `datePut` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `logBook`
--

CREATE TABLE `logBook` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL DEFAULT 0,
  `code` int(11) NOT NULL,
  `datePut` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `printList`
--

CREATE TABLE `printList` (
  `ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `city` text NOT NULL,
  `bookCount` int(11) NOT NULL DEFAULT 0,
  `userID` int(11) NOT NULL DEFAULT 0,
  `datePut` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `statAgentLog`
--

CREATE TABLE `statAgentLog` (
  `ID` int(11) NOT NULL,
  `userAgent` text COLLATE utf8_unicode_ci NOT NULL,
  `ip` text COLLATE utf8_unicode_ci NOT NULL,
  `datePut` date NOT NULL,
  `dateLast` datetime NOT NULL,
  `count` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `statQueryLog`
--

CREATE TABLE `statQueryLog` (
  `ID` int(11) NOT NULL,
  `agentID` int(11) NOT NULL,
  `query` text COLLATE utf8_unicode_ci NOT NULL,
  `count` int(11) NOT NULL DEFAULT 1,
  `datePut` date NOT NULL,
  `lastDate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `tiffImageList`
--

CREATE TABLE `tiffImageList` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL DEFAULT 0,
  `bookID` int(11) NOT NULL DEFAULT 0,
  `fileID` int(11) NOT NULL DEFAULT 0,
  `page` int(11) NOT NULL DEFAULT 0,
  `imageName` text COLLATE utf8_unicode_ci NOT NULL,
  `datePut` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `tiket`
--

CREATE TABLE `tiket` (
  `ID` int(11) NOT NULL,
  `subject` text COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `userID` int(11) NOT NULL DEFAULT 0,
  `parentID` int(11) NOT NULL DEFAULT 0,
  `state` enum('open','close','answer') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'open',
  `datePut` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `passw` text NOT NULL,
  `email` text NOT NULL,
  `emailConfirm` enum('no','yes') NOT NULL DEFAULT 'no',
  `dateRegistration` datetime NOT NULL,
  `lastLogin` datetime NOT NULL,
  `ip` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `state` enum('user','moderator','administrator') NOT NULL DEFAULT 'user',
  `ban` enum('no','yes') NOT NULL DEFAULT 'no',
  `amount` int(11) NOT NULL DEFAULT 0,
  `datePremium` datetime NOT NULL,
  `freePremium` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `userImageRenderOptions`
--

CREATE TABLE `userImageRenderOptions` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `monochrome` enum('true','false') NOT NULL DEFAULT 'true',
  `transparent` enum('true','false') NOT NULL DEFAULT 'true',
  `colors` int(11) NOT NULL DEFAULT 16,
  `format` enum('png','gif','jpg') NOT NULL DEFAULT 'png',
  `resize` int(11) NOT NULL DEFAULT 794
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `userLinks`
--

CREATE TABLE `userLinks` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `bookID` int(11) NOT NULL,
  `fileID` int(11) NOT NULL,
  `pageNum` int(11) NOT NULL,
  `datePut` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `userOptions`
--

CREATE TABLE `userOptions` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL DEFAULT 0,
  `name` text NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `userSession`
--

CREATE TABLE `userSession` (
  `ID` int(11) NOT NULL,
  `hash` text NOT NULL,
  `userID` int(11) NOT NULL,
  `userAgent` text NOT NULL,
  `lastPage` datetime NOT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `antiBotCode`
--
ALTER TABLE `antiBotCode`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `authorList`
--
ALTER TABLE `authorList`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `booksAuthorList`
--
ALTER TABLE `booksAuthorList`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `booksCategoryList`
--
ALTER TABLE `booksCategoryList`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `booksFileList`
--
ALTER TABLE `booksFileList`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `booksImageList`
--
ALTER TABLE `booksImageList`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `booksList`
--
ALTER TABLE `booksList`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `booksMessages`
--
ALTER TABLE `booksMessages`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `booksPrintList`
--
ALTER TABLE `booksPrintList`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `categoryList`
--
ALTER TABLE `categoryList`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `confirmEmail`
--
ALTER TABLE `confirmEmail`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `logBook`
--
ALTER TABLE `logBook`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `printList`
--
ALTER TABLE `printList`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `statAgentLog`
--
ALTER TABLE `statAgentLog`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `statQueryLog`
--
ALTER TABLE `statQueryLog`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `tiffImageList`
--
ALTER TABLE `tiffImageList`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `userImageRenderOptions`
--
ALTER TABLE `userImageRenderOptions`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `userLinks`
--
ALTER TABLE `userLinks`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `userOptions`
--
ALTER TABLE `userOptions`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `userSession`
--
ALTER TABLE `userSession`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `antiBotCode`
--
ALTER TABLE `antiBotCode`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `authorList`
--
ALTER TABLE `authorList`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `booksAuthorList`
--
ALTER TABLE `booksAuthorList`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `booksCategoryList`
--
ALTER TABLE `booksCategoryList`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `booksFileList`
--
ALTER TABLE `booksFileList`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `booksImageList`
--
ALTER TABLE `booksImageList`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `booksList`
--
ALTER TABLE `booksList`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `booksMessages`
--
ALTER TABLE `booksMessages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `booksPrintList`
--
ALTER TABLE `booksPrintList`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `categoryList`
--
ALTER TABLE `categoryList`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `confirmEmail`
--
ALTER TABLE `confirmEmail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `logBook`
--
ALTER TABLE `logBook`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `printList`
--
ALTER TABLE `printList`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `statAgentLog`
--
ALTER TABLE `statAgentLog`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `statQueryLog`
--
ALTER TABLE `statQueryLog`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tiffImageList`
--
ALTER TABLE `tiffImageList`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tiket`
--
ALTER TABLE `tiket`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `userImageRenderOptions`
--
ALTER TABLE `userImageRenderOptions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `userLinks`
--
ALTER TABLE `userLinks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `userOptions`
--
ALTER TABLE `userOptions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `userSession`
--
ALTER TABLE `userSession`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

INSERT INTO `user` (`ID`, `name`, `passw`, `email`, `emailConfirm`, `dateRegistration`, `lastLogin`, `ip`, `state`, `ban`, `amount`, `datePremium`, `freePremium`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com', 'yes', '2013-02-15 16:45:51', '2022-01-09 19:50:24', '', 'administrator', 'no', 0, '0000-00-00 00:00:00', 1),
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
