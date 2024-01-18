-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-01-18 09:27:10
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
(3, 'elite.jpg', 2);

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
  `type_id` int(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `p01_gallery`
--

INSERT INTO `p01_gallery` (`id`, `title`, `text`, `img`, `user`, `type_id`) VALUES
(2, 'elite', '測試上傳', 'elite.jpg', 'admin', 2),
(3, 'elite02', '測試上傳', 'elite02.jpg', 'admin', 2),
(4, 'elite03', '測試上傳', 'elite03.jpg', 'admin', 2),
(5, 'elite04', '測試上傳', 'elite04.jpg', 'admin', 2),
(6, 'elite05', '測試上傳', 'elite05.jpg', 'admin', 2),
(7, 'elite06', '測試上傳', 'elite06.jpg', 'admin', 2),
(8, 'elite07', '測試上傳', 'elite07.jpg', 'admin', 2);

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
(5, 2, 'test'),
(6, 3, 'admin'),
(7, 5, 'admin'),
(34, 2, 'admin'),
(37, 7, 'admin'),
(39, 8, 'admin'),
(40, 6, 'admin');

-- --------------------------------------------------------

--
-- 資料表結構 `p01_type`
--

CREATE TABLE `p01_type` (
  `id` int(4) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `display` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `p01_type`
--

INSERT INTO `p01_type` (`id`, `name`, `display`) VALUES
(2, 'Elite dangerous', 1);

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
(3, 'test', '0000', '12345@gmail.com', 0);

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
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `p01_gallery`
--
ALTER TABLE `p01_gallery`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `p01_gallery_like`
--
ALTER TABLE `p01_gallery_like`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `p01_type`
--
ALTER TABLE `p01_type`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `p01_user`
--
ALTER TABLE `p01_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
