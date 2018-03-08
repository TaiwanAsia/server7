-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- 主機: localhost
-- 產生時間： 2018 年 03 月 08 日 06:47
-- 伺服器版本: 10.1.25-MariaDB
-- PHP 版本： 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `server7`
--

-- --------------------------------------------------------

--
-- 資料表結構 `EMPLOYEE`
--

CREATE TABLE `EMPLOYEE` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `ACCOUNT` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `PASSWORD` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `EMPLOYEE`
--

INSERT INTO `EMPLOYEE` (`ID`, `NAME`, `ACCOUNT`, `PASSWORD`) VALUES
(1, '小祿', 'zzz', 'aaa');

-- --------------------------------------------------------

--
-- 資料表結構 `ORDERS`
--

CREATE TABLE `ORDERS` (
  `ID` int(20) NOT NULL,
  `日期` date NOT NULL,
  `業務` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `客戶姓名` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `身分證字號` varchar(10) NOT NULL,
  `聯絡電話` varchar(20) NOT NULL,
  `聯絡人` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `聯絡地址` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `買賣` varchar(1) NOT NULL,
  `股票` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `張數` float NOT NULL,
  `完稅價` float DEFAULT NULL,
  `成交價` float NOT NULL,
  `盤價` float NOT NULL,
  `匯款金額` int(11) NOT NULL,
  `匯款銀行` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `匯款分行` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `匯款戶名` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `轉讓會員` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `完稅人` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `新舊` tinyint(1) NOT NULL,
  `自行應付` float DEFAULT NULL,
  `刻印` tinyint(1) DEFAULT NULL,
  `過戶費` int(10) DEFAULT NULL,
  `媒合` tinyint(1) NOT NULL,
  `收付款` varchar(10) NOT NULL,
  `過戶日` date NOT NULL,
  `通知查帳` varchar(10) NOT NULL,
  `契約` varchar(10) NOT NULL,
  `稅單` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `ORDERS`
--

INSERT INTO `ORDERS` (`ID`, `日期`, `業務`, `客戶姓名`, `身分證字號`, `聯絡電話`, `聯絡人`, `聯絡地址`, `買賣`, `股票`, `張數`, `完稅價`, `成交價`, `盤價`, `匯款金額`, `匯款銀行`, `匯款分行`, `匯款戶名`, `轉讓會員`, `完稅人`, `新舊`, `自行應付`, `刻印`, `過戶費`, `媒合`, `收付款`, `過戶日`, `通知查帳`, `契約`, `稅單`) VALUES
(4, '2018-03-01', '小鹿', '王大明', 'H123456787', '0933123456', '王大明', '新北市板橋區雙十路二段17號33樓', '1', '大老闆小公司', 1.375, NULL, 21.9, 23, 23000, '彰化銀行', NULL, '陳小華', '李一刀', '李一刀', 0, NULL, NULL, NULL, 20, '', '2018-03-02', '', '', ''),
(17, '2018-03-01', '999', '9999', '9', '999', '999', '9999', '9', '9', 9, 9, 9, 99, 9, '9', '9', '9', '9', '9', 9, 99, 9, 9, 9, '9', '2018-03-03', '9', '9', '9'),
(18, '2018-03-01', 'ㄚ', 'ㄚ', '8', '8', '8', '8', '9', '9', 9, 9, 9, 9, 9, '9', '9', '9', '9', '9', 9, 9, 9, 9, 9, '9', '2018-03-02', '3', '3', '3'),
(19, '2018-02-25', '1', '2', '3', '4', '5', '6', '1', '8', 9, 10, 11, 12, 14, '15', '16', '17', '18', '19', 20, 21, 22, 23, 24, '25', '2018-03-02', '26', '27', '28'),
(20, '2018-03-03', '小祿', '莊曉涵', 'F345678909', '0933123456', '原阿謙', '中山路二段17號2樓', '0', '安安水電', 30.7, 0, 33.9, 31, 9999, '安心銀行', '', '我匯款', '大會元', '是完稅', 0, 0, 0, 0, 4, '??', '2018-03-04', '??', '??', '??'),
(21, '2018-03-08', '小祿', '9', '9', '9', '9', '9', '1', '9', 9, 9, 9, 9, 9, '9', '9', '9', '9', '9', 1, 9, 9, 9, 6, '9', '2018-03-07', '', '', ''),
(22, '2018-03-08', '小祿', '9', '9', '9', '9', '9', '1', '9', 9, 9, 9, 9, 9, '9', '9', '9', '9', '9', 1, 9, 9, 9, 23, '9', '2018-03-08', '', '', ''),
(23, '2018-03-08', '小祿', '9', '9', '9', '9', '9', '0', '9', 9, 9, 9, 9, 9, '9', '9', '9', '9', '9', 0, 9, 9, 9, 22, '9', '2018-03-08', '', '', '');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `EMPLOYEE`
--
ALTER TABLE `EMPLOYEE`
  ADD PRIMARY KEY (`ID`);

--
-- 資料表索引 `ORDERS`
--
ALTER TABLE `ORDERS`
  ADD PRIMARY KEY (`ID`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `EMPLOYEE`
--
ALTER TABLE `EMPLOYEE`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用資料表 AUTO_INCREMENT `ORDERS`
--
ALTER TABLE `ORDERS`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
