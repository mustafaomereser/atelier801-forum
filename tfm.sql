-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 28 Nis 2020, 13:40:55
-- Sunucu sürümü: 10.4.11-MariaDB
-- PHP Sürümü: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `tfm`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `account`
--

CREATE TABLE `account` (
  `IP` longtext NOT NULL,
  `Time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `banlog`
--

CREATE TABLE `banlog` (
  `Username` longtext NOT NULL,
  `BannedBy` longtext NOT NULL,
  `Time` longtext NOT NULL,
  `Reason` longtext NOT NULL,
  `Date` longtext NOT NULL,
  `Status` longtext NOT NULL,
  `IP` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `banlog`
--

INSERT INTO `banlog` (`Username`, `BannedBy`, `Time`, `Reason`, `Date`, `Status`, `IP`) VALUES
('Database', '0', '24', 'TEST', '158648032', 'Online', '25.115.179.125');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `casierlog`
--

CREATE TABLE `casierlog` (
  `id` int(11) NOT NULL,
  `PlayerID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `State` text NOT NULL,
  `Timestamp` text NOT NULL,
  `Bannedby` text NOT NULL,
  `Time` text NOT NULL,
  `Reason` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `casierlog`
--

INSERT INTO `casierlog` (`id`, `PlayerID`, `Name`, `State`, `Timestamp`, `Bannedby`, `Time`, `Reason`, `date`) VALUES
(1, 1, 'Database', 'BAN', '1587024941', 'Depwesso', '360', 'ANAN', '1587024941'),
(2, 1, 'Database', 'BAN', '1587034941', 'Depwesso', '360', 'ANAN', '1587024941');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `conversation`
--

CREATE TABLE `conversation` (
  `id` int(11) NOT NULL,
  `hash` text NOT NULL,
  `player` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` text NOT NULL,
  `readed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `player` int(11) NOT NULL,
  `started` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `hash` text NOT NULL,
  `trash` int(11) NOT NULL DEFAULT 0,
  `etkilesim` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `player` int(11) NOT NULL,
  `data` int(11) NOT NULL,
  `mode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `forums`
--

CREATE TABLE `forums` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `icon` text NOT NULL,
  `sub_section` text NOT NULL,
  `priv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `forums`
--

INSERT INTO `forums` (`id`, `title`, `icon`, `sub_section`, `priv`) VALUES
(1, 'Deneme1', 'transformice', '', 0),
(2, 'Deneme2', 'transformice', '1', 0),
(3, 'Deneme3', 'runforcheese', '2', 0),
(4, 'asdasdasda', 'drapeau', '3', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iletisim`
--

CREATE TABLE `iletisim` (
  `id` int(11) NOT NULL,
  `kadi` text NOT NULL,
  `email` text NOT NULL,
  `kategori` text NOT NULL,
  `konu` text NOT NULL,
  `mesaj` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ippermaban`
--

CREATE TABLE `ippermaban` (
  `IP` longtext NOT NULL,
  `BannedBy` longtext NOT NULL,
  `Reason` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `player` int(11) NOT NULL,
  `data` int(11) NOT NULL,
  `topic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `loginlog`
--

CREATE TABLE `loginlog` (
  `id` int(11) NOT NULL,
  `username` longtext DEFAULT NULL,
  `ip` longtext NOT NULL,
  `yazi` longtext NOT NULL,
  `Timestamp` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `loginlog`
--

INSERT INTO `loginlog` (`id`, `username`, `ip`, `yazi`, `Timestamp`) VALUES
(1, 'Admin', '127.0.0.1', '\n <V>[ Admin ]</V> <G>23.04.2020 - 00:35:59</G> <G>( </G><VI>127.0.0.1</VI><G> - XX - Localhost</G><G> )</G>', '1587591359'),
(2, 'Admin', '127.0.0.1', '\n <V>[ Admin ]</V> <G>23.04.2020 - 03:37:24</G> <G>( </G><VI>127.0.0.1</VI><G> - XX - Localhost</G><G> )</G>', '1587602244'),
(3, '+Database', '127.0.0.1', '\n <V>[ +Database ]</V> <G>23.04.2020 - 06:40:21</G> <G>( </G><VI>127.0.0.1</VI><G> - XX - Localhost</G><G> )</G>', '1587613221'),
(4, '+Database', '127.0.0.1', '\n <V>[ +Database ]</V> <G>23.04.2020 - 06:47:57</G> <G>( </G><VI>127.0.0.1</VI><G> - XX - Localhost</G><G> )</G>', '1587613677'),
(5, '+Database', '127.0.0.1', '\n <V>[ +Database ]</V> <G>23.04.2020 - 06:55:29</G> <G>( </G><VI>127.0.0.1</VI><G> - XX - Localhost</G><G> )</G>', '1587614129'),
(6, '+Database', '127.0.0.1', '\n <V>[ +Database ]</V> <G>26.04.2020 - 03:12:20</G> <G>( </G><VI>127.0.0.1</VI><G> - XX - Localhost</G><G> )</G>', '1587859940'),
(7, '+Database', '127.0.0.1', '\n <V>[ +Database ]</V> <G>26.04.2020 - 03:15:01</G> <G>( </G><VI>127.0.0.1</VI><G> - XX - Localhost</G><G> )</G>', '1587860101'),
(8, '+Database', '127.0.0.1', '\n <V>[ +Database ]</V> <G>26.04.2020 - 06:17:28</G> <G>( </G><VI>127.0.0.1</VI><G> - XX - Localhost</G><G> )</G>', '1587871048'),
(9, '+Database', '127.0.0.1', '\n <V>[ +Database ]</V> <G>26.04.2020 - 06:32:05</G> <G>( </G><VI>127.0.0.1</VI><G> - XX - Localhost</G><G> )</G>', '1587871925'),
(10, '+Database', '127.0.0.1', '\n <V>[ +Database ]</V> <G>28.04.2020 - 13:54:23</G> <G>( </G><VI>127.0.0.1</VI><G> - XX - Localhost</G><G> )</G>', '1588071263'),
(11, '+Database', '127.0.0.1', '\n <V>[ +Database ]</V> <G>28.04.2020 - 14:08:43</G> <G>( </G><VI>127.0.0.1</VI><G> - XX - Localhost</G><G> )</G>', '1588072123'),
(12, '+Database', '127.0.0.1', '\n <V>[ +Database ]</V> <G>28.04.2020 - 14:17:46</G> <G>( </G><VI>127.0.0.1</VI><G> - XX - Localhost</G><G> )</G>', '1588072666');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `player` text NOT NULL,
  `log` text NOT NULL,
  `text` text NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `oyunlist`
--

CREATE TABLE `oyunlist` (
  `id` int(11) NOT NULL,
  `img` text NOT NULL,
  `text` text NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `oyunlist`
--

INSERT INTO `oyunlist` (`id`, `img`, `text`, `link`) VALUES
(3, 'img/banners/transformice.jpg', '$b = array(\"TR\"=>\"Gel ve Transformice\'da mümkün olduğunca fazla peynir toplamak için diğer farelere katıl. Dünyanın dört bir yanından oyuncularla oyna, arkadaşlarınla canlı sohbet et ve fareni kişiselleştir.\");\r\n', 'http://www.transformice.com/');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `polls`
--

CREATE TABLE `polls` (
  `id` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `answers` text NOT NULL,
  `users_answers` text NOT NULL,
  `general_result` int(11) NOT NULL DEFAULT 0,
  `one_more_choise` int(11) NOT NULL DEFAULT 0,
  `mode` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `profilestribe`
--

CREATE TABLE `profilestribe` (
  `id` int(11) NOT NULL,
  `tribe` int(11) NOT NULL,
  `avatar` text NOT NULL,
  `lang` text NOT NULL,
  `aciklama` text NOT NULL,
  `reisg` int(11) NOT NULL DEFAULT 1,
  `msgg` int(11) NOT NULL DEFAULT 1,
  `msgaciklama` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `profilestribe`
--

INSERT INTO `profilestribe` (`id`, `tribe`, `avatar`, `lang`, `aciklama`, `reisg`, `msgg`, `msgaciklama`) VALUES
(1, 1, '', 'xx', '', 1, 1, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `profilesuser`
--

CREATE TABLE `profilesuser` (
  `id` int(11) NOT NULL,
  `player` int(11) NOT NULL,
  `staciklama` int(11) NOT NULL DEFAULT 0,
  `aciklama` text NOT NULL,
  `stonline` int(11) NOT NULL DEFAULT 1,
  `online` text NOT NULL,
  `stbirthday` int(11) NOT NULL DEFAULT 0,
  `birthday` text NOT NULL,
  `stgender` int(11) NOT NULL DEFAULT 0,
  `stkonum` int(11) NOT NULL DEFAULT 0,
  `konum` text NOT NULL,
  `lang` text NOT NULL DEFAULT 'xx',
  `hash` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `profilesuser`
--

INSERT INTO `profilesuser` (`id`, `player`, `staciklama`, `aciklama`, `stonline`, `online`, `stbirthday`, `birthday`, `stgender`, `stkonum`, `konum`, `lang`, `hash`) VALUES
(1, 1, 0, '', 1, '1588074060', 0, '', 0, 0, '', 'xx', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `byid` int(11) NOT NULL,
  `reportid` int(11) NOT NULL,
  `reason` text NOT NULL,
  `mode` text NOT NULL,
  `link` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `handled` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `icon` text NOT NULL,
  `forum` int(11) NOT NULL,
  `lang` text NOT NULL,
  `locked` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `section`
--

INSERT INTO `section` (`id`, `title`, `icon`, `forum`, `lang`, `locked`) VALUES
(1, 'Announcements', 'atelier801', 1, 'xx', 0),
(2, 'Hoppala', 'transformice', 2, 'tr', 0),
(3, 'asdsadasdas', 'megaphone', 3, 'xx', 0),
(4, 'asdasdasd', 'fortoresse', 4, 'xx', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `store_invoices`
--

CREATE TABLE `store_invoices` (
  `id` bigint(20) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `credit` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date` bigint(20) DEFAULT NULL,
  `orderId` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `gateway` varchar(255) DEFAULT NULL,
  `postData` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `topic`
--

CREATE TABLE `topic` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `section` int(11) NOT NULL,
  `player` int(11) NOT NULL,
  `date` text NOT NULL,
  `pinned` int(11) NOT NULL DEFAULT 0,
  `locked` int(11) NOT NULL DEFAULT 0,
  `etkilesim` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `topic`
--

INSERT INTO `topic` (`id`, `title`, `section`, `player`, `date`, `pinned`, `locked`, `etkilesim`) VALUES
(1, '$tit = array(\"TR\"=>\"İlk\",\"EN\"=>\"first\");', 2, 1, '1587972642', 0, 0, '1587972642'),
(2, '$tit = array(\"TR\"=>\"asdasd\",\"EN\"=>\"asdasdasd\");', 3, 1, '1587978386', 0, 0, '1587978386'),
(3, 'asdasdasd', 1, 1, '1588056728', 1, 1, '1588056728');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `topicm`
--

CREATE TABLE `topicm` (
  `id` int(11) NOT NULL,
  `player` int(11) NOT NULL,
  `topic` int(11) NOT NULL,
  `text` text NOT NULL,
  `handled` int(11) NOT NULL DEFAULT 0,
  `hreason` text NOT NULL,
  `hwho` int(11) NOT NULL,
  `date` text NOT NULL,
  `lastedit` text NOT NULL,
  `devtracker` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `topicm`
--

INSERT INTO `topicm` (`id`, `player`, `topic`, `text`, `handled`, `hreason`, `hwho`, `date`, `lastedit`, `devtracker`) VALUES
(1, 1, 1, 'asdasdasd', 0, '', 0, '1587972642', '', 1),
(2, 1, 2, 'asdasdasdas', 0, '', 0, '1587978386', '', 0),
(3, 1, 3, 'asdasd', 0, '', 0, '1588056728', '', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tribe`
--

CREATE TABLE `tribe` (
  `Code` int(11) NOT NULL,
  `Name` longtext NOT NULL,
  `Message` longtext NOT NULL DEFAULT '',
  `House` int(11) NOT NULL DEFAULT 0,
  `Ranks` longtext NOT NULL DEFAULT '0|${trad#TG_0}|0;0|${trad#TG_1}|0;2|${trad#TG_2}|0;3|${trad#TG_3}|0;4|${trad#TG_4}|32;5|${trad#TG_5}|160;6|${trad#TG_6}|416;7|${trad#TG_7}|932;8|${trad#TG_8}|2044;9|${trad#TG_9}|2046',
  `Historique` longtext NOT NULL DEFAULT '',
  `Members` longtext NOT NULL,
  `Points` int(11) NOT NULL DEFAULT 0,
  `CreateTime` int(11) NOT NULL,
  `alimlar` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `tribe`
--

INSERT INTO `tribe` (`Code`, `Name`, `Message`, `House`, `Ranks`, `Historique`, `Members`, `Points`, `CreateTime`, `alimlar`) VALUES
(1, 'Test', 'asdasdasdasasdasfasdasfasdasf', 0, '0|${trad#TG_0}|0;0|${trad#TG_1}|0;2|${trad#TG_2}|0;3|${trad#TG_3}|0;4|${trad#TG_4}|32;5|${trad#TG_5}|160;6|${trad#TG_6}|2044;7|${trad#TG_7}|2044;8|${trad#TG_8}|2044;9|${trad#TG_9}|2046', '2/26437819/Database/Gmflame|6/26436591/asdasdasdas/Database|6/26436591/asdasdasdas/Database|2/26436583/Database/Depwesso|1/26436574/Database/Test', '1,2,3', 0, 0, 1),
(2, 'asd', '', 0, '0|${trad#TG_0}|0;0|${trad#TG_1}|0;2|${trad#TG_2}|0;3|${trad#TG_3}|0;4|${trad#TG_4}|32;5|${trad#TG_5}|160;6|${trad#TG_6}|416;7|${trad#TG_7}|932;8|${trad#TG_8}|2044;9|${trad#TG_9}|2046', '1/26460037/Admin/asd', '4', 0, 26460037, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `userpermaban`
--

CREATE TABLE `userpermaban` (
  `Username` longtext NOT NULL,
  `Reason` longtext NOT NULL,
  `BannedBy` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `Username` longtext NOT NULL,
  `Password` longtext NOT NULL,
  `PlayerID` int(11) NOT NULL,
  `Email` longtext NOT NULL DEFAULT '',
  `PrivLevel` longtext NOT NULL DEFAULT '1',
  `TitleNumber` int(11) NOT NULL DEFAULT 0,
  `FirstCount` int(11) NOT NULL DEFAULT 0,
  `CheeseCount` int(11) NOT NULL DEFAULT 0,
  `ShamanCheeses` int(11) NOT NULL DEFAULT 0,
  `ShopCheeses` int(11) NOT NULL DEFAULT 0,
  `ShopFraises` int(11) NOT NULL DEFAULT 0,
  `ShamanSaves` int(11) NOT NULL DEFAULT 0,
  `HardModeSaves` int(11) NOT NULL DEFAULT 0,
  `DivineModeSaves` int(11) NOT NULL DEFAULT 0,
  `BootcampCount` int(11) NOT NULL DEFAULT 0,
  `ShamanType` int(11) NOT NULL DEFAULT 0,
  `ShopItems` longtext NOT NULL DEFAULT '',
  `ShamanItems` longtext NOT NULL DEFAULT '',
  `Clothes` longtext NOT NULL DEFAULT '',
  `Look` longtext NOT NULL DEFAULT '1;0,0,0,0,0,0,0,0,0',
  `ShamanLook` longtext NOT NULL DEFAULT '0,0,0,0,0,0,0,0,0,0',
  `MouseColor` longtext NOT NULL DEFAULT '78583a',
  `ShamanColor` longtext NOT NULL DEFAULT '95d9d6',
  `RegDate` int(11) NOT NULL,
  `Badges` longtext NOT NULL DEFAULT '',
  `CheeseTitleList` longtext NOT NULL DEFAULT '',
  `FirstTitleList` longtext NOT NULL DEFAULT '',
  `ShamanTitleList` longtext NOT NULL DEFAULT '',
  `ShopTitleList` longtext NOT NULL DEFAULT '',
  `BootcampTitleList` longtext NOT NULL DEFAULT '',
  `HardModeTitleList` longtext NOT NULL DEFAULT '',
  `DivineModeTitleList` longtext NOT NULL DEFAULT '',
  `SpecialTitleList` longtext NOT NULL DEFAULT '',
  `BanHours` int(11) NOT NULL DEFAULT 0,
  `ShamanLevel` int(11) NOT NULL DEFAULT 1,
  `ShamanExp` int(11) NOT NULL DEFAULT 0,
  `ShamanExpNext` int(11) NOT NULL DEFAULT 32,
  `Skills` longtext NOT NULL DEFAULT '',
  `LastOn` int(11) NOT NULL DEFAULT 0,
  `FriendsList` longtext NOT NULL DEFAULT '',
  `IgnoredsList` longtext NOT NULL DEFAULT '',
  `Gender` int(11) NOT NULL DEFAULT 0,
  `Marriage` longtext NOT NULL DEFAULT '',
  `Gifts` longtext NOT NULL DEFAULT '',
  `Messages` longtext NOT NULL DEFAULT '',
  `SurvivorStats` longtext NOT NULL DEFAULT '0,0,0,0',
  `RacingStats` longtext NOT NULL DEFAULT '0,0,0,0',
  `Consumables` longtext NOT NULL DEFAULT '0:10',
  `EquipedConsumables` longtext NOT NULL DEFAULT '0',
  `Pet` int(11) NOT NULL DEFAULT 0,
  `PetEnd` int(11) NOT NULL DEFAULT 0,
  `ShamanBadges` longtext NOT NULL DEFAULT '',
  `EquipedShamanBadge` int(11) NOT NULL DEFAULT 0,
  `TotemItemCount` int(11) NOT NULL DEFAULT 0,
  `Totem` longtext NOT NULL DEFAULT '',
  `CustomItems` longtext NOT NULL DEFAULT '',
  `TribeCode` int(11) NOT NULL DEFAULT 0,
  `TribeRank` int(11) NOT NULL DEFAULT 0,
  `TribeJoined` int(11) NOT NULL DEFAULT 0,
  `Tag` longtext NOT NULL DEFAULT '',
  `Time` int(11) NOT NULL DEFAULT 0,
  `Fur` int(11) NOT NULL DEFAULT 0,
  `FurEnd` int(11) NOT NULL DEFAULT 0,
  `Hazelnut` int(11) NOT NULL DEFAULT 0,
  `VipTime` int(11) NOT NULL DEFAULT 0,
  `Langue` text NOT NULL,
  `OldNames` longtext NOT NULL DEFAULT '',
  `Avatar` text NOT NULL DEFAULT 'default.png',
  `Reward` int(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`Username`, `Password`, `PlayerID`, `Email`, `PrivLevel`, `TitleNumber`, `FirstCount`, `CheeseCount`, `ShamanCheeses`, `ShopCheeses`, `ShopFraises`, `ShamanSaves`, `HardModeSaves`, `DivineModeSaves`, `BootcampCount`, `ShamanType`, `ShopItems`, `ShamanItems`, `Clothes`, `Look`, `ShamanLook`, `MouseColor`, `ShamanColor`, `RegDate`, `Badges`, `CheeseTitleList`, `FirstTitleList`, `ShamanTitleList`, `ShopTitleList`, `BootcampTitleList`, `HardModeTitleList`, `DivineModeTitleList`, `SpecialTitleList`, `BanHours`, `ShamanLevel`, `ShamanExp`, `ShamanExpNext`, `Skills`, `LastOn`, `FriendsList`, `IgnoredsList`, `Gender`, `Marriage`, `Gifts`, `Messages`, `SurvivorStats`, `RacingStats`, `Consumables`, `EquipedConsumables`, `Pet`, `PetEnd`, `ShamanBadges`, `EquipedShamanBadge`, `TotemItemCount`, `Totem`, `CustomItems`, `TribeCode`, `TribeRank`, `TribeJoined`, `Tag`, `Time`, `Fur`, `FurEnd`, `Hazelnut`, `VipTime`, `Langue`, `OldNames`, `Avatar`, `Reward`) VALUES
('+Database', 'gER/MR+QF5emwGnSJbtPfWlYsLvEXYaZhhCV7gcGhM8=', 1, 'mustafaomereser@gmail.com', '12,9,8,7,6,5,4,3,2,1', 1100, 0, 0, 0, 79250, 100360, 17, 0, 0, 0, 0, '822_898989+4A4A4A,701,631_53532A+53532A,2104,305_555520,13_736E24,230113', '', '00/1;13_736E24,0,0,5_555520,0,0,31_53532A+53532A,1,0/4e443a/95d9d6', '113;13_736E24,0,0,5_555520,0,0,31_53532A+53532A,1,0', '0,0,0,0,0,0,0,0,0,0', '78583a', '4E443A', 1586191503, '217', '', '', '', '115.1,116.1,117.1,118.1', '', '', '', '', 0, 1, 0, 32, '', 26467875, '', '', 2, '', '', '', '0,0,0,0', '0,0,0,0', '0:15;28:2;2262:4;12:15;3:599;1:40;10:13;13:15;15:10;16:21;17:18;29:5;31:5;2259:7;2250:1;2246:9;9:12;11:22;2203:25;77:2;5:20;7:21;23:14;18:8;4:22;2:7;14:20;8:26;6:8;2448:4;2343:1;34:6', '2234', 11, 3183, '', 0, 0, '', '', 1, 9, 26436574, '#a', 39928, 10, 3571, 0, 0, 'tr', '', '1.jpg', 1587700714),
('Depwesso', 'natq5Sjkfom9xTWK2aoqBF6gCCED0KPXGESUTQQ/tx4=', 2, 'Depwessookul22@gmail.com', '5,4,3,2,1', 446, 0, 0, 0, 100000, 100000, 2, 0, 0, 0, 0, '', '', '', '1;0,0,0,0,0,0,0,0,0', '0,0,0,0,0,0,0,0,0,0', '78583a', '95d9d6', 1586191835, '', '', '', '', '', '', '', '', '', 0, 1, 0, 32, '', 26442411, '', '', 2, '', '', '', '0,0,0,0', '0,0,0,0', '0:11;2203:4;11:15;2262:1;28:3;3:4;12:1;13:9;31:19;2256:100;2255:100;2254:100;2253:100;2252:100;2251:100;2250:100;2258:100;2260:100', '', 0, 1586544680, '', 0, 0, '', '', 1, 0, 26436583, '#tag', 9198, 0, 90789, 0, 0, 'tr', '', '', 1),
('Gmflame', 'g1HStgXfb320PEzmkuO9hesAOzs64waG2C/Cuk7NkCA=', 3, 'sdsdgsdgsgs@gmail.com', '7,6,5,4,3,2,1', 0, 0, 0, 0, 100000, 100000, 1, 0, 0, 0, 0, '', '', '', '1;0,0,0,0,0,0,0,0,0', '0,0,0,0,0,0,0,0,0,0', '78583a', '95d9d6', 1586267352, '', '', '', '', '', '', '', '', '', 0, 1, 0, 32, '', 26451419, '', '', 0, '', '', '', '0,0,0,0', '0,0,0,0', '0:2;28:6;2262:30;1:1', '', 0, 1587085189, '', 0, 0, '', '', 1, 0, 26437819, '', 9572, 0, 1586306169, 0, 0, 'tr', '', '', 0),
('Admin', 'gER/MR+QF5emwGnSJbtPfWlYsLvEXYaZhhCV7gcGhM8=', 4, 'm@gm.cm', '11,10,9,8,2,1', 0, 0, 0, 0, 99500, 100000, 7, 0, 0, 0, 0, '', '', '', '1;0,0,0,0,0,0,0,0,0', '0,0,0,0,0,0,0,0,0,0', '78583a', '95d9d6', 1586290600, '', '', '', '', '', '', '', '', '', 0, 1, 0, 32, '', 26460037, '', '', 2, '', '', '', '0,0,0,0', '0,0,0,0', '0:10', '', 0, 1587602261, '', 0, 0, '', '', 2, 9, 26460037, '#adm', 584, 0, 1586312607, 0, 0, 'tr', '', '', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `usertempban`
--

CREATE TABLE `usertempban` (
  `Username` longtext NOT NULL,
  `Reason` longtext NOT NULL,
  `Time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `usertempmute`
--

CREATE TABLE `usertempmute` (
  `Username` longtext NOT NULL,
  `Time` int(11) NOT NULL,
  `Reason` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `casierlog`
--
ALTER TABLE `casierlog`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `iletisim`
--
ALTER TABLE `iletisim`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `loginlog`
--
ALTER TABLE `loginlog`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `oyunlist`
--
ALTER TABLE `oyunlist`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `profilestribe`
--
ALTER TABLE `profilestribe`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `profilesuser`
--
ALTER TABLE `profilesuser`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `store_invoices`
--
ALTER TABLE `store_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `topicm`
--
ALTER TABLE `topicm`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tribe`
--
ALTER TABLE `tribe`
  ADD UNIQUE KEY `Code` (`Code`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `PlayerID` (`PlayerID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `casierlog`
--
ALTER TABLE `casierlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `forums`
--
ALTER TABLE `forums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `iletisim`
--
ALTER TABLE `iletisim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `loginlog`
--
ALTER TABLE `loginlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `oyunlist`
--
ALTER TABLE `oyunlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `profilestribe`
--
ALTER TABLE `profilestribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `profilesuser`
--
ALTER TABLE `profilesuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `topicm`
--
ALTER TABLE `topicm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `tribe`
--
ALTER TABLE `tribe`
  MODIFY `Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `PlayerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
