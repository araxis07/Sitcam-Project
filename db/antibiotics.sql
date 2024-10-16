-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2024 at 01:52 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `antibiotics`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id_account` int(50) NOT NULL,
  `username_account` varchar(50) DEFAULT NULL,
  `email_account` varchar(50) DEFAULT NULL,
  `password_account` varchar(97) DEFAULT NULL,
  `salt_account` varchar(256) DEFAULT NULL,
  `role_account` varchar(50) DEFAULT NULL,
  `images_account` varchar(50) DEFAULT NULL,
  `login_count_account` int(1) NOT NULL,
  `lock_account` int(1) NOT NULL,
  `ban_account` datetime DEFAULT NULL,
  `reported_count` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id_account`, `username_account`, `email_account`, `password_account`, `salt_account`, `role_account`, `images_account`, `login_count_account`, `lock_account`, `ban_account`, `reported_count`) VALUES
(2, 'member', 'member@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$aWZiNVNaSi8vVG5OcGlmNg$nBoPY0lPdB9GC/nzo2LIStP5b4VV/Iw9bWrFcFLiE0M', 'ab21409ae4d3d48840635b02c27be7af069b9a9a4c7798c1d2b1e654f6fdb15fec2691b745f90315879eaada67ad4148a49fb49717c090feafcaaada55b9070de1f89c9530632d4167ae8c970eb1d32efbf86cf33bcc641c233a0fa1790261c36a9fd9a9e70186959ca5e33557d9af5156940fbe13', 'member', 'default_images_account.jpg', 1, 0, '0000-00-00 00:00:00', 0),
(3, 'Admin', 'admin@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$bXMxekU2U1l5LlJSakQ5Qw$auQgIBXB+ht4bhCCdC5/MsSEOTWvCNypVapTPQz/jKk', '4d02ab0b6d9642c678a899183403be36abb8f6f00e95f1b11e4315cbfb80e7ec9b53151291a303f968df1e6545518b06cc2b749ff4af38cf39603e2f6a0b5a85cf6f8e3fd236610c6839ba9c260f3bf3e277406d9fdf35c7d28d18b7fad54383e302cf94f9f4f9709e93b40fa8d23cef', 'admin', 'default_images_account.jpg', 0, 0, '2024-10-16 14:51:38', 0),
(4, 'San', 'Santas1s@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$SzZPOTVlNjI1emxCNHM5Yw$heD/Bnf1NebRTXGDoWilvbGeQQuqYIZQu8nhA+hWi6s', 'be64419531ee7c4495a3c426d551adc30923cdfbad1c29b674704db21efadb6e584e733658cef335c3f5948b2420aa07fc459933dd13f847458ac968041b78d2fcec75fd54c2e4250c09305066b6b45ba55e5661d2f70302c3b88ff5c159f57da0', 'member', 'default_images_account.jpg', 1, 0, '0000-00-00 00:00:00', 0),
(5, 'gg', 'gg@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$UzNYMlRsYTNZZ1ZJVXk5TQ$3bo7zx2qP8DhRnDdaMkrb5GxzTuWKL0spE6X1fNFlmA', '51d847ceebc686c714548d07dc9e71272e8926f122575638c08121746c65e6b366502caf3a82c49fb4c4b71afa4da7e08ddd9cb1265c95e48d8239822f425984d3da536b48c1375430134715f1f7f6f8fc8cb6d8fb9a007d72366b1503b2f327a8d4410dd0ddd168fa24b8393515e08d778a', 'member', 'default_images_account.jpg', 0, 0, '0000-00-00 00:00:00', 0),
(6, 'ggez', 'ggez@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$UnZmcDFiZHJRYVgxc01Pcg$i9wbnPRa1hDHaF6cjKIdcIEuNfLEelBsW39GXooU5ZU', '5ee5c29620b0588e1209c61be91300ae78d74032cdb8bcb2ade82e434292cf8f26de259854bcd59106d21c1dcd008be7254664cb62e9dc3157187b0792f3822248f1d271b08bb32212082846445c967fdfd5bff7f3faf66bc5d2b9b9d2d50b58fbae293f087a928f', 'member', 'default_images_account.jpg', 0, 0, '0000-00-00 00:00:00', 1),
(7, 'ez', 'ez@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$S2hJM2pVUk1rQkNCMVVKdg$W89xqZXhJcJlz0ZhoOO/z/R8zalpEY6P96+SY0/mrhU', '07f75482c88e66febe8e62394fc295d81d3d2c9e215a818f36dcf97ee56f8a284fe32c8ddb1deae1cefc538157bb4c30f70e9a377f0ec2462dd31ae578bb0ec0ccf5d0cf06334046498a6b8497d83063b6c23fca41ab5c09b9d21420bac1309137aaea88511767c3a4d1ee7215', 'member', 'default_images_account.jpg', 1, 0, '0000-00-00 00:00:00', 0),
(8, 'bite', 'bite@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$cC5aWDUwalkuaVdtTm5Qbw$rfsq8t89iEma3ktXFJJ/qQTIsWC2Oj78Y4AXy498Sbw', '167259d797c172147a8cf1f96c1e9d1dc0bcf0dc6e7ec326764370b5b2bbca5b4c2c9ab2605b78c50cabe2aaed20bf7d857c6c7315c264b5de94fee63aee504a2984d92bc20da813a753289c2c37482a7da5e5fb1f544b4d1b0c01ac86c131e82fb8f643e0e80d', 'member', 'default_images_account.jpg', 0, 0, '0000-00-00 00:00:00', 0),
(9, 'aon', 'aon@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$SFM1SnZrVklpb3c1WE9CdQ$U6KktiScJ+ZK66yetIRXUdhuIhiqQ9cgzOcDsFRnYrI', '004514f6900496271e896e0e601dadef0c0899df4cad90190254921a24a0b179f31f0576e3394c98082c1cd60a42bc1f9b98e7b317c6351557f58cdbfeb04cbacb103ee3c78d93678fafe417f3cbb13fd2bd0263efd3ed9027844e89833305fe31fe04', 'member', 'default_images_account.jpg', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `d_patience`
--

CREATE TABLE `d_patience` (
  `username` varchar(50) NOT NULL,
  `total_score` varchar(50) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `treat_score` varchar(50) DEFAULT NULL,
  `treat_comments` varchar(155) DEFAULT NULL,
  `docname` varchar(50) DEFAULT NULL,
  `doccon` varchar(50) DEFAULT NULL,
  `p_show_count` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `d_patience`
--

INSERT INTO `d_patience` (`username`, `total_score`, `comments`, `email`, `treat_score`, `treat_comments`, `docname`, `doccon`, `p_show_count`) VALUES
('ggez', 'ตวามเสี่ยงสูง', 'sdads', 'ggez@gmail.com', 'ทำบุญเยอะๆ', 'Message', 'โอม', 'ดาวอังคาร', 1),
('member', 'ความเสี่ยงต่ำ', 'sadad', 'member@gmail.com', 'สวดอภิธรรม', '1d1d', 'โอม', 'ดาวอังคาร', 0),
('San', 'ตวามเสี่ยงสูง', 'DFQ', 'Santas1s@gmail.com', 'มาพบแพทย์ที่รพ.', 'Message', 'โอม', 'ดาวอังคาร', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id_account`);

--
-- Indexes for table `d_patience`
--
ALTER TABLE `d_patience`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id_account` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;