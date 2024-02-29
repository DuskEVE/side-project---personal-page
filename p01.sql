-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-02-29 06:54:59
-- 伺服器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `p01`
--

-- --------------------------------------------------------

--
-- 資料表結構 `p01_banner`
--

CREATE TABLE `p01_banner` (
  `id` int(4) UNSIGNED NOT NULL,
  `img` text NOT NULL,
  `type_id` int(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `p01_banner`
--

INSERT INTO `p01_banner` (`id`, `img`, `type_id`) VALUES
(1, 'home.png', 0),
(3, 'elite.jpg', 2),
(4, 'vlhem.jpg', 4),
(5, 'nebula.jpg', 5);

-- --------------------------------------------------------

--
-- 資料表結構 `p01_gallery`
--

CREATE TABLE `p01_gallery` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `text` text NOT NULL,
  `img` text NOT NULL,
  `user` text NOT NULL,
  `like_count` int(10) UNSIGNED NOT NULL,
  `type_id` int(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `p01_gallery`
--

INSERT INTO `p01_gallery` (`id`, `title`, `text`, `img`, `user`, `like_count`, `type_id`) VALUES
(2, 'elite', '測試上傳', 'elite.jpg', 'admin', 0, 2),
(3, 'elite02', '測試上傳', 'elite02.jpg', 'admin', 0, 2),
(4, 'elite03', '測試上傳', 'elite03.jpg', 'admin', 0, 2),
(5, 'elite04', '測試上傳', 'elite04.jpg', 'admin', 1, 2),
(6, 'elite05', '測試上傳', 'elite05.jpg', 'admin', 0, 2),
(7, 'elite06', '測試上傳', 'elite06.jpg', 'admin', 0, 2),
(8, 'elite07', '測試上傳', 'elite07.jpg', 'admin', 0, 2),
(9, 'elite08', '', '20210520205444_1.jpg', 'admin', 0, 2),
(10, 'elite09', '', '20210526175414_1.jpg', 'admin', 0, 2),
(11, 'elite10', '', '20210602005708_1.jpg', 'admin', 0, 2),
(12, 'elite11', '', '20210602005859_1.jpg', 'admin', 0, 2),
(13, 'elite12', '', '20210603053619_1.jpg', 'admin', 0, 2),
(14, 'elite13', '', '20210605111614_1.jpg', 'admin', 0, 2),
(15, 'elite14', '', '20210605152918_2.jpg', 'admin', 0, 2),
(16, 'elite15', '', '20210605163356_1.jpg', 'admin', 0, 2),
(17, 'elite16', '', '20210608204556_2.jpg', 'admin', 0, 2),
(18, 'elite17', '', '20210612192533_2.jpg', 'admin', 0, 2),
(19, 'elite18', '', '20210612195923_1.jpg', 'admin', 0, 2),
(20, 'elite19', '', '20210613042252_1.jpg', 'admin', 0, 2),
(21, 'elite20', '', '20210613152346_1.jpg', 'admin', 0, 2),
(22, 'elite21', '', '001.jpg', 'admin', 0, 2),
(24, 'elite23', '', '002.jpg', 'admin', 0, 2),
(25, 'elite24', '', '003.jpg', 'admin', 0, 2),
(26, 'vh01', '', '20231125121352_1.jpg', 'admin', 0, 4),
(27, 'vh02', '', '20231125121403_1.jpg', 'admin', 0, 4),
(28, 'vh03', '', '20231125121425_1.jpg', 'admin', 0, 4),
(29, 'vh04', '', '20231125121455_1.jpg', 'admin', 0, 4),
(30, 'nebula01', '', '2oc.jpg', 'test', 0, 5);

-- --------------------------------------------------------

--
-- 資料表結構 `p01_gallery_like`
--

CREATE TABLE `p01_gallery_like` (
  `id` int(10) UNSIGNED NOT NULL,
  `gallery_id` int(10) UNSIGNED NOT NULL,
  `user` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `p01_gallery_like`
--

INSERT INTO `p01_gallery_like` (`id`, `gallery_id`, `user`) VALUES
(42, 5, 'admin');

-- --------------------------------------------------------

--
-- 資料表結構 `p01_news`
--

CREATE TABLE `p01_news` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `text` text NOT NULL,
  `type_id` int(4) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `display` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `p01_news`
--

INSERT INTO `p01_news` (`id`, `title`, `text`, `type_id`, `date`, `display`) VALUES
(1, '測試新聞標題01', '編輯測試01', 2, '2024-01-25', 1),
(2, '測試新聞標題02', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. \r\nFuga, veniam aut deleniti eos voluptatum, \r\nnostrum temporibus voluptates nam vel, \r\nquas rem voluptas id similique. Omnis voluptas fugit saepe obcaecati necessitatibus?', 4, '2024-01-25', 1),
(3, '測試新聞標題03', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. \r\nFuga, veniam aut deleniti eos voluptatum, \r\nnostrum temporibus voluptates nam vel, \r\nquas rem voluptas id similique. Omnis voluptas fugit saepe obcaecati necessitatibus?', 5, '2024-01-25', 1),
(5, '新增新聞測試', '新增內容測試123', 4, '0000-00-00', 1),
(6, '測試新聞標題05', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. \r\nFuga, veniam aut deleniti eos voluptatum, \r\nnostrum temporibus voluptates nam vel, \r\nquas rem voluptas id similique. Omnis voluptas fugit saepe obcaecati necessitatibus?', 2, '2024-01-30', 1),
(7, '測試新聞標題06', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. \r\nFuga, veniam aut deleniti eos voluptatum, \r\nnostrum temporibus voluptates nam vel, \r\nquas rem voluptas id similique. Omnis voluptas fugit saepe obcaecati necessitatibus?', 2, '2024-01-30', 1),
(8, '測試新聞標題07', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. \r\nFuga, veniam aut deleniti eos voluptatum, \r\nnostrum temporibus voluptates nam vel, \r\nquas rem voluptas id similique. Omnis voluptas fugit saepe obcaecati necessitatibus?', 2, '2024-01-30', 1),
(9, '測試新聞標題08', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. \r\nFuga, veniam aut deleniti eos voluptatum, \r\nnostrum temporibus voluptates nam vel, \r\nquas rem voluptas id similique. Omnis voluptas fugit saepe obcaecati necessitatibus?', 2, '2024-01-30', 1),
(10, '測試新聞標題09', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. \r\nFuga, veniam aut deleniti eos voluptatum, \r\nnostrum temporibus voluptates nam vel, \r\nquas rem voluptas id similique. Omnis voluptas fugit saepe obcaecati necessitatibus?', 2, '2024-01-30', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `p01_type`
--

CREATE TABLE `p01_type` (
  `id` int(4) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `appid` int(10) UNSIGNED NOT NULL,
  `display` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `p01_type`
--

INSERT INTO `p01_type` (`id`, `name`, `appid`, `display`) VALUES
(2, 'Elite dangerous', 359320, 1),
(4, 'Valheim', 892970, 1),
(5, 'nebula:fleet command', 887570, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `p01_user`
--

CREATE TABLE `p01_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `admin` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `p01_user`
--

INSERT INTO `p01_user` (`id`, `user`, `password`, `email`, `admin`) VALUES
(1, 'admin', '1234', 'x987000@gmail.com', 1),
(3, 'test', '0000', '12345@gmail.com', 0),
(4, 'test02', '1111', '123@gmail.com.tw', 0);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `p01_banner`
--
ALTER TABLE `p01_banner`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `p01_gallery`
--
ALTER TABLE `p01_gallery`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `p01_gallery_like`
--
ALTER TABLE `p01_gallery_like`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `p01_news`
--
ALTER TABLE `p01_news`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `p01_type`
--
ALTER TABLE `p01_type`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `p01_user`
--
ALTER TABLE `p01_user`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `p01_banner`
--
ALTER TABLE `p01_banner`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `p01_gallery`
--
ALTER TABLE `p01_gallery`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `p01_gallery_like`
--
ALTER TABLE `p01_gallery_like`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `p01_news`
--
ALTER TABLE `p01_news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `p01_type`
--
ALTER TABLE `p01_type`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `p01_user`
--
ALTER TABLE `p01_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
