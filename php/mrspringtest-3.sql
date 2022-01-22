-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2019 年 04 月 25 日 13:48
-- 伺服器版本： 8.0.13
-- PHP 版本： 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `mrspringtest`
--

-- --------------------------------------------------------

--
-- 資料表結構 `article`
--

CREATE TABLE `article` (
  `artNo` int(11) NOT NULL COMMENT 'PK autoIncrement',
  `artTitle` varchar(10) NOT NULL,
  `memNo` int(11) NOT NULL COMMENT 'FK',
  `artText` varchar(300) NOT NULL,
  `artTime` datetime NOT NULL,
  `cardNo` int(11) NOT NULL COMMENT 'FK',
  `artLikeCount` int(11) NOT NULL DEFAULT '0' COMMENT '預設值：0',
  `artMesCount` int(11) NOT NULL COMMENT '預設值：0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章';

--
-- 傾印資料表的資料 `article`
--

INSERT INTO `article` (`artNo`, `artTitle`, `memNo`, `artText`, `artTime`, `cardNo`, `artLikeCount`, `artMesCount`) VALUES
(1, 'qew', 1, 'qwe', '2019-04-11 00:00:00', 1, 0, 0),
(2, 'qew', 1, 'qwe', '2019-04-11 00:00:00', 1, 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `articlereport`
--

CREATE TABLE `articlereport` (
  `artReportNo` int(11) NOT NULL COMMENT 'PK autoIncrement',
  `artNo` int(11) NOT NULL COMMENT 'FK',
  `memNo` int(11) NOT NULL COMMENT 'FK',
  `artReportStatus` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0：已處理 1：未處理'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='被檢舉文章';

-- --------------------------------------------------------

--
-- 資料表結構 `branch`
--

CREATE TABLE `branch` (
  `branchNo` int(11) NOT NULL COMMENT 'PK autoIncrement',
  `branchName` varchar(10) NOT NULL,
  `branchAddress` varchar(50) NOT NULL,
  `branchTel` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分店' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- 資料表結構 `card`
--

CREATE TABLE `card` (
  `cardNo` int(11) NOT NULL COMMENT 'PK autoIncrement',
  `cardName` varchar(10) NOT NULL,
  `memNo` int(11) NOT NULL COMMENT 'FK',
  `cardText` varchar(6) NOT NULL,
  `cardFont` varchar(20) NOT NULL,
  `cardTextColor1` varchar(20) NOT NULL,
  `cardTextColor2` varchar(20) DEFAULT NULL COMMENT 'null',
  `cardTextColor3` varchar(20) DEFAULT NULL COMMENT 'null',
  `cardTextColor4` varchar(20) DEFAULT NULL COMMENT 'null',
  `cardTextColor5` varchar(20) DEFAULT NULL COMMENT 'null',
  `cardTextColor6` varchar(20) DEFAULT NULL COMMENT 'null',
  `cardPrice` int(11) NOT NULL,
  `artNo` int(11) DEFAULT NULL COMMENT 'null',
  `cardStatus` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0：關閉 1：開啟'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='湯牌';

--
-- 傾印資料表的資料 `card`
--

INSERT INTO `card` (`cardNo`, `cardName`, `memNo`, `cardText`, `cardFont`, `cardTextColor1`, `cardTextColor2`, `cardTextColor3`, `cardTextColor4`, `cardTextColor5`, `cardTextColor6`, `cardPrice`, `artNo`, `cardStatus`) VALUES
(1, 'qwe', 1, '123', 'arial', '#aaa', '#aaa', '#aaa', '', NULL, NULL, 1200, 1, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `carditem1`
--

CREATE TABLE `carditem1` (
  `cardItem1No` int(11) NOT NULL,
  `cardNo` int(11) NOT NULL,
  `item1No` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `carditem1`
--

INSERT INTO `carditem1` (`cardItem1No`, `cardNo`, `item1No`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `carditem2`
--

CREATE TABLE `carditem2` (
  `cardItem2No` int(11) NOT NULL,
  `cardNo` int(11) DEFAULT NULL,
  `item2No` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `carditem2`
--

INSERT INTO `carditem2` (`cardItem2No`, `cardNo`, `item2No`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- 資料表結構 `carditem3`
--

CREATE TABLE `carditem3` (
  `cardItem3No` int(11) NOT NULL,
  `cardNo` int(11) NOT NULL,
  `item3No` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `carditem3`
--

INSERT INTO `carditem3` (`cardItem3No`, `cardNo`, `item3No`) VALUES
(1, 1, 3);

-- --------------------------------------------------------

--
-- 資料表結構 `carditem4`
--

CREATE TABLE `carditem4` (
  `cardItem4No` int(11) NOT NULL,
  `cardNo` int(11) NOT NULL,
  `item4No` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `carditem4`
--

INSERT INTO `carditem4` (`cardItem4No`, `cardNo`, `item4No`) VALUES
(1, 1, 4);

-- --------------------------------------------------------

--
-- 資料表結構 `coupon`
--

CREATE TABLE `coupon` (
  `couponNo` int(11) NOT NULL COMMENT 'PK autoIncrement',
  `couponName` varchar(10) NOT NULL,
  `couponType` int(11) NOT NULL COMMENT '1：減價(減法) 2：打折(乘法)',
  `couponDiscount` float NOT NULL,
  `couponStatus` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0：下架 1：上架'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='優惠券類別';

-- --------------------------------------------------------

--
-- 資料表結構 `effecttype`
--

CREATE TABLE `effecttype` (
  `effectTypeNo` int(11) NOT NULL COMMENT 'PK autoIncrement',
  `effectTypeName` varchar(10) NOT NULL,
  `effectTypeText` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='藥材種類';

--
-- 傾印資料表的資料 `effecttype`
--

INSERT INTO `effecttype` (`effectTypeNo`, `effectTypeName`, `effectTypeText`) VALUES
(1, '舒筋活骨', '【療效說明】您有肩頸僵硬、四肢末端發麻、蹲下去爬不起來等等的困擾嗎？湯先生嚴選舒筋活骨類別，藉由獨特的藥材能量沁入您的每一寸筋骨，帶來前所未有的體驗！想要軟Q靈活又彈性地蹦蹦跳嗎？選擇舒筋活骨類就對了！'),
(2, '安定心神', '【療效說明】每天在夢裡被狗追、在辦公室被主管電、在家裡又被喵星人欺凌，這樣的生活壓力壓得您無法喘息了嗎？湯先生嚴選安定心神類別，利用獨特的藥材特性，療癒您的感官、解放您的抑鬱，讓您在泡湯的同時，洗去一身的雜念，回歸純粹的心靈。'),
(3, '養顏美容', '【療效說明】美容界的黑科技橫空出世！保濕鎖水、緊緻拉提、美白抗衰全效合一！選用湯先生嚴選養顏美容類別，藉由全新的藥材聚合效果，前所未有的清新體驗，將喚醒您肌膚深層的小宇宙，引發新一次的肌齡革命。');

-- --------------------------------------------------------

--
-- 資料表結構 `item`
--

CREATE TABLE `item` (
  `itemNo` int(11) NOT NULL COMMENT 'PK autoIncrement',
  `itemName` varchar(10) NOT NULL,
  `pointA` float NOT NULL,
  `pointB` float NOT NULL,
  `pointC` float NOT NULL,
  `itemText` text NOT NULL,
  `itemTime` int(11) NOT NULL COMMENT '1：早上 2：下午 3：晚上 0：無',
  `itemColor` varchar(20) NOT NULL,
  `itemInterval` int(11) DEFAULT NULL COMMENT '1：大 2：中 3：小 null',
  `itemPrice` int(11) NOT NULL,
  `itemImg1Url` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '藥材彩色圖片路徑',
  `itemImg2Url` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '藥材印章圖片路徑',
  `itemImg3Url` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '藥材百科圖片路徑',
  `itemImg4Url` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '藥材原始圖片路徑',
  `effectTypeNo` int(11) NOT NULL COMMENT 'FK',
  `itemStatus` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0：下架 1：上架'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='藥材';

--
-- 傾印資料表的資料 `item`
--

INSERT INTO `item` (`itemNo`, `itemName`, `pointA`, `pointB`, `pointC`, `itemText`, `itemTime`, `itemColor`, `itemInterval`, `itemPrice`, `itemImg1Url`, `itemImg2Url`, `itemImg3Url`, `itemImg4Url`, `effectTypeNo`, `itemStatus`) VALUES
(1, '櫻花', 90, 40, 20, '櫻花藥材說明文字', 1, '#E16B8C', NULL, 150, 'images/itemPics/item0-1-c.png', 'images/itemPics/item0-1-s.png', 'images/itemPics/item0-1-w.png', 'images/itemPics/item0-1-o.png', 1, 1),
(2, '山茱萸', 60, 50, 40, '山茱萸藥材文字說明', 0, '#D05A6E', 3, 100, 'images/itemPics/item0-2-c.png', 'images/itemPics/item0-2-s.png', 'images/itemPics/item0-2-w.png', 'images/itemPics/item0-2-o.png', 1, 1),
(3, '菊花', 60, 40, 10, '菊花藥材文字說明', 0, '#E03C8A', 2, 110, 'images/itemPics/item0-3-c.png', 'images/itemPics/item0-3-s.png', 'images/itemPics/item0-3-w.png', 'images/itemPics/item0-3-o.png', 1, 1),
(4, '薰衣草', 70, 20, 40, '薰衣草藥材文字說明', 0, '#DB3D3D', 1, 120, 'images/itemPics/item0-4-c.png', 'images/itemPics/item0-4-s.png', 'images/itemPics/item0-4-w.png', 'images/itemPics/item0-4-o.png', 1, 1),
(5, '玫瑰花', 30, 90, 20, '玫瑰花藥材說明文字', 2, '#F17C67', NULL, 150, 'images/itemPics/item1-1-c.png', 'images/itemPics/item1-1-s.png', 'images/itemPics/item1-1-w.png', 'images/itemPics/item1-1-o.png', 2, 1),
(6, '檸檬', 20, 70, 10, '檸檬藥材說明文字', 0, '#FB9966', 3, 90, 'images/itemPics/item1-2-c.png', 'images/itemPics/item1-2-s.png', 'images/itemPics/item1-2-w.png', 'images/itemPics/item1-2-o.png', 2, 1),
(7, '蒜頭', 30, 70, 50, '蒜頭藥材說明文字', 0, '#ED784A', 2, 115, 'images/itemPics/item1-3-c.png', 'images/itemPics/item1-3-s.png', 'images/itemPics/item1-3-w.png', 'images/itemPics/item1-3-o.png', 2, 1),
(8, '生薑', 10, 80, 20, '生薑藥材說明文字', 0, '#FB6633', 1, 135, 'images/itemPics/item1-4-c.png', 'images/itemPics/item1-4-s.png', 'images/itemPics/item1-4-w.png', 'images/itemPics/item1-4-o.png', 2, 1),
(9, '繡球花', 10, 20, 90, '繡球花藥材說明文字', 3, '#86C166', NULL, 160, 'images/itemPics/item2-1-c.png', 'images/itemPics/item2-1-s.png', 'images/itemPics/item2-1-w.png', 'images/itemPics/item2-1-o.png', 3, 1),
(10, '佛手柑', 10, 30, 80, '佛手柑藥材說明文字', 0, '#A8D8B9', 3, 95, 'images/itemPics/item2-2-c.png', 'images/itemPics/item2-2-s.png', 'images/itemPics/item2-2-w.png', 'images/itemPics/item2-2-o.png', 3, 1),
(11, '八角', 20, 30, 90, '八角藥材說明文字', 0, '#66BAB7', 2, 120, 'images/itemPics/item2-3-c.png', 'images/itemPics/item2-3-s.png', 'images/itemPics/item2-3-w.png', 'images/itemPics/item2-3-o.png', 3, 1),
(12, '枸杞', 10, 10, 90, '枸杞藥材說明文字', 0, '#90B44B', 1, 140, 'images/itemPics/item2-4-c.png', 'images/itemPics/item2-4-s.png', 'images/itemPics/item2-4-w.png', 'images/itemPics/item2-4-o.png', 3, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `keyword`
--

CREATE TABLE `keyword` (
  `keywordNo` int(11) NOT NULL COMMENT 'PK autoIncrement',
  `keywordName` varchar(10) NOT NULL,
  `keywordStatus` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0：下架 1：上架',
  `keywordTagStatus` tinyint(1) NOT NULL COMMENT '0：下架 1：上架'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='機器人關鍵字';

-- --------------------------------------------------------

--
-- 資料表結構 `likes`
--

CREATE TABLE `likes` (
  `likesNo` int(11) NOT NULL COMMENT 'PK autoIncrement',
  `artNo` int(11) NOT NULL COMMENT 'FK',
  `memNo` int(11) NOT NULL COMMENT 'FK'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章按讚紀錄';

-- --------------------------------------------------------

--
-- 資料表結構 `manager`
--

CREATE TABLE `manager` (
  `managerNo` int(11) NOT NULL COMMENT 'PK autoIncrement',
  `managerId` varchar(10) NOT NULL,
  `managerPsw` varchar(10) NOT NULL,
  `managerName` varchar(10) NOT NULL,
  `managerLevel` int(11) NOT NULL COMMENT '1：一般管理員 2：高級管理員'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理員';

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `memNo` int(11) NOT NULL COMMENT 'PK autoIncrement',
  `memId` varchar(10) NOT NULL,
  `memPsw` varchar(10) NOT NULL,
  `memLastName` varchar(10) NOT NULL,
  `memFirstName` varchar(10) NOT NULL,
  `memNickname` varchar(10) NOT NULL,
  `memTel` varchar(10) NOT NULL,
  `memEmail` varchar(50) NOT NULL,
  `memImgUrl` varchar(50) DEFAULT NULL COMMENT 'null',
  `memStatus` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0：停權 1：一般'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='會員' ROW_FORMAT=COMPACT;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`memNo`, `memId`, `memPsw`, `memLastName`, `memFirstName`, `memNickname`, `memTel`, `memEmail`, `memImgUrl`, `memStatus`) VALUES
(1, 'test', 'test', 'test', 'test', 'test', '0936290345', 'test@gmail.cpom', NULL, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `membercoupon`
--

CREATE TABLE `membercoupon` (
  `memCouponNo` int(11) NOT NULL COMMENT 'PK autoIncrement',
  `couponNo` int(11) NOT NULL COMMENT 'FK',
  `memNo` int(11) NOT NULL COMMENT 'FK',
  `memCouponDate` date NOT NULL,
  `memCouponStatus` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0：不可使用 1：可使用'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='會員的優惠券';

-- --------------------------------------------------------

--
-- 資料表結構 `message`
--

CREATE TABLE `message` (
  `mesNo` int(11) NOT NULL COMMENT 'PK autoIncrement',
  `artNo` int(11) NOT NULL COMMENT 'FK',
  `memNo` int(11) NOT NULL COMMENT 'FK',
  `mesText` varchar(50) NOT NULL,
  `mesTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='留言';

-- --------------------------------------------------------

--
-- 資料表結構 `messagereport`
--

CREATE TABLE `messagereport` (
  `mesReportNo` int(11) NOT NULL COMMENT 'PK autoIncrement',
  `mesNo` int(11) NOT NULL COMMENT 'FK',
  `memNo` int(11) NOT NULL COMMENT 'FK',
  `mesReportStatus` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0：已處理 1：未處理'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='被檢舉留言';

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `orderNo` int(11) NOT NULL COMMENT 'PK autoIncrement',
  `orderTime` datetime NOT NULL,
  `orderResDate` date NOT NULL,
  `orderResTime` int(11) NOT NULL COMMENT '1：早上 2：下午 3：晚上',
  `memNo` int(11) NOT NULL COMMENT 'FK',
  `roomNo` int(11) NOT NULL COMMENT 'FK',
  `cardNo` int(11) NOT NULL COMMENT 'FK',
  `orderOldPrice` int(11) NOT NULL,
  `orderNewPrice` int(11) NOT NULL,
  `couponNo` int(11) DEFAULT NULL COMMENT 'FK、null',
  `orderStatus` int(11) NOT NULL COMMENT '1：未入住 2：已核銷 3：未核銷'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='訂單' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- 資料表結構 `question`
--

CREATE TABLE `question` (
  `quesNo` int(11) NOT NULL COMMENT 'PK autoIncrement',
  `quesType` int(11) NOT NULL COMMENT '1：筋骨類 2：精神類 3：美白類',
  `quesText` varchar(100) NOT NULL,
  `ans1Text` varchar(20) NOT NULL,
  `ans1Score` float NOT NULL,
  `ans2Text` varchar(20) NOT NULL,
  `ans2Score` float NOT NULL,
  `ans3Text` varchar(20) NOT NULL,
  `ans3Score` float NOT NULL,
  `quesStatus` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0：下架 1：上架'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='諮詢題庫';

-- --------------------------------------------------------

--
-- 資料表結構 `reply`
--

CREATE TABLE `reply` (
  `replyNo` int(11) NOT NULL COMMENT 'PK autoIncrement',
  `replyText` varchar(100) NOT NULL,
  `keywordNo` int(11) NOT NULL COMMENT 'FK'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='中文：機器人回覆';

-- --------------------------------------------------------

--
-- 資料表結構 `reservation`
--

CREATE TABLE `reservation` (
  `reserNo` int(11) NOT NULL COMMENT 'PK autoIncrement',
  `roomNo` int(11) NOT NULL COMMENT 'FK',
  `reserDate` date NOT NULL,
  `reserMorning` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0：可接受預約 1：不接受預約',
  `reserAfternoon` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0：可接受預約 1：不接受預約',
  `reserNight` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0：可接受預約 1：不接受預約'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='不開放湯屋時段';

-- --------------------------------------------------------

--
-- 資料表結構 `robotmessage`
--

CREATE TABLE `robotmessage` (
  `robotDefMesNo` int(11) NOT NULL COMMENT 'PK autoIncrement',
  `robotDefMesText` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='機器人預設文字';

-- --------------------------------------------------------

--
-- 資料表結構 `room`
--

CREATE TABLE `room` (
  `roomNo` int(11) NOT NULL COMMENT 'PK autoIncrement',
  `roomName` varchar(10) NOT NULL,
  `roomDescription` varchar(50) NOT NULL,
  `roomPrice` int(11) NOT NULL,
  `branchNo` int(11) NOT NULL COMMENT 'FK'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='湯屋' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- 資料表結構 `roomimage`
--

CREATE TABLE `roomimage` (
  `roomImgNo` int(11) NOT NULL COMMENT 'PK autoIncrement',
  `roomNo` int(11) NOT NULL COMMENT 'FK',
  `roomImgUrl` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='湯屋圖片' ROW_FORMAT=COMPACT;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`artNo`),
  ADD KEY `memNo` (`memNo`),
  ADD KEY `cardNo` (`cardNo`);

--
-- 資料表索引 `articlereport`
--
ALTER TABLE `articlereport`
  ADD PRIMARY KEY (`artReportNo`),
  ADD KEY `artNo` (`artNo`),
  ADD KEY `memNo` (`memNo`);

--
-- 資料表索引 `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branchNo`);

--
-- 資料表索引 `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`cardNo`),
  ADD KEY `memNo` (`memNo`);

--
-- 資料表索引 `carditem1`
--
ALTER TABLE `carditem1`
  ADD PRIMARY KEY (`cardItem1No`),
  ADD KEY `cardNo` (`cardNo`),
  ADD KEY `carditem1_ibfk_2` (`item1No`);

--
-- 資料表索引 `carditem2`
--
ALTER TABLE `carditem2`
  ADD PRIMARY KEY (`cardItem2No`),
  ADD KEY `carditem2_ibfk_1` (`cardNo`),
  ADD KEY `carditem2_ibfk_2` (`item2No`);

--
-- 資料表索引 `carditem3`
--
ALTER TABLE `carditem3`
  ADD PRIMARY KEY (`cardItem3No`),
  ADD KEY `cardNo` (`cardNo`),
  ADD KEY `carditem3_ibfk_2` (`item3No`);

--
-- 資料表索引 `carditem4`
--
ALTER TABLE `carditem4`
  ADD PRIMARY KEY (`cardItem4No`),
  ADD KEY `cardNo` (`cardNo`),
  ADD KEY `itemNo` (`item4No`);

--
-- 資料表索引 `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`couponNo`);

--
-- 資料表索引 `effecttype`
--
ALTER TABLE `effecttype`
  ADD PRIMARY KEY (`effectTypeNo`);

--
-- 資料表索引 `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`itemNo`),
  ADD KEY `effectTypeNo` (`effectTypeNo`);

--
-- 資料表索引 `keyword`
--
ALTER TABLE `keyword`
  ADD PRIMARY KEY (`keywordNo`);

--
-- 資料表索引 `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likesNo`),
  ADD KEY `artNo` (`artNo`),
  ADD KEY `memNo` (`memNo`);

--
-- 資料表索引 `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`managerNo`);

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`memNo`);

--
-- 資料表索引 `membercoupon`
--
ALTER TABLE `membercoupon`
  ADD PRIMARY KEY (`memCouponNo`),
  ADD KEY `couponNo` (`couponNo`),
  ADD KEY `memNo` (`memNo`);

--
-- 資料表索引 `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`mesNo`),
  ADD KEY `artNo` (`artNo`),
  ADD KEY `memNo` (`memNo`);

--
-- 資料表索引 `messagereport`
--
ALTER TABLE `messagereport`
  ADD PRIMARY KEY (`mesReportNo`),
  ADD KEY `mesNo` (`mesNo`),
  ADD KEY `memNo` (`memNo`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderNo`),
  ADD KEY `memNo` (`memNo`),
  ADD KEY `roomNo` (`roomNo`),
  ADD KEY `cardNo` (`cardNo`),
  ADD KEY `couponNo` (`couponNo`);

--
-- 資料表索引 `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`quesNo`);

--
-- 資料表索引 `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`replyNo`),
  ADD KEY `keywordNo` (`keywordNo`);

--
-- 資料表索引 `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reserNo`),
  ADD KEY `roomNo` (`roomNo`);

--
-- 資料表索引 `robotmessage`
--
ALTER TABLE `robotmessage`
  ADD PRIMARY KEY (`robotDefMesNo`);

--
-- 資料表索引 `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomNo`),
  ADD KEY `branchNo` (`branchNo`);

--
-- 資料表索引 `roomimage`
--
ALTER TABLE `roomimage`
  ADD PRIMARY KEY (`roomImgNo`),
  ADD KEY `roomNo` (`roomNo`);

--
-- 在傾印的資料表使用自動增長(AUTO_INCREMENT)
--

--
-- 使用資料表自動增長(AUTO_INCREMENT) `article`
--
ALTER TABLE `article`
  MODIFY `artNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK autoIncrement', AUTO_INCREMENT=3;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `articlereport`
--
ALTER TABLE `articlereport`
  MODIFY `artReportNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK autoIncrement';

--
-- 使用資料表自動增長(AUTO_INCREMENT) `branch`
--
ALTER TABLE `branch`
  MODIFY `branchNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK autoIncrement';

--
-- 使用資料表自動增長(AUTO_INCREMENT) `card`
--
ALTER TABLE `card`
  MODIFY `cardNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK autoIncrement', AUTO_INCREMENT=3;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `carditem1`
--
ALTER TABLE `carditem1`
  MODIFY `cardItem1No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `carditem2`
--
ALTER TABLE `carditem2`
  MODIFY `cardItem2No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `carditem3`
--
ALTER TABLE `carditem3`
  MODIFY `cardItem3No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `carditem4`
--
ALTER TABLE `carditem4`
  MODIFY `cardItem4No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `coupon`
--
ALTER TABLE `coupon`
  MODIFY `couponNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK autoIncrement';

--
-- 使用資料表自動增長(AUTO_INCREMENT) `effecttype`
--
ALTER TABLE `effecttype`
  MODIFY `effectTypeNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK autoIncrement', AUTO_INCREMENT=4;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `item`
--
ALTER TABLE `item`
  MODIFY `itemNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK autoIncrement', AUTO_INCREMENT=13;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `keyword`
--
ALTER TABLE `keyword`
  MODIFY `keywordNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK autoIncrement';

--
-- 使用資料表自動增長(AUTO_INCREMENT) `likes`
--
ALTER TABLE `likes`
  MODIFY `likesNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK autoIncrement';

--
-- 使用資料表自動增長(AUTO_INCREMENT) `manager`
--
ALTER TABLE `manager`
  MODIFY `managerNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK autoIncrement';

--
-- 使用資料表自動增長(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `memNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK autoIncrement', AUTO_INCREMENT=3;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `membercoupon`
--
ALTER TABLE `membercoupon`
  MODIFY `memCouponNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK autoIncrement';

--
-- 使用資料表自動增長(AUTO_INCREMENT) `message`
--
ALTER TABLE `message`
  MODIFY `mesNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK autoIncrement';

--
-- 使用資料表自動增長(AUTO_INCREMENT) `messagereport`
--
ALTER TABLE `messagereport`
  MODIFY `mesReportNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK autoIncrement';

--
-- 使用資料表自動增長(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `orderNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK autoIncrement';

--
-- 使用資料表自動增長(AUTO_INCREMENT) `question`
--
ALTER TABLE `question`
  MODIFY `quesNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK autoIncrement';

--
-- 使用資料表自動增長(AUTO_INCREMENT) `reply`
--
ALTER TABLE `reply`
  MODIFY `replyNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK autoIncrement';

--
-- 使用資料表自動增長(AUTO_INCREMENT) `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reserNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK autoIncrement';

--
-- 使用資料表自動增長(AUTO_INCREMENT) `robotmessage`
--
ALTER TABLE `robotmessage`
  MODIFY `robotDefMesNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK autoIncrement';

--
-- 使用資料表自動增長(AUTO_INCREMENT) `room`
--
ALTER TABLE `room`
  MODIFY `roomNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK autoIncrement';

--
-- 使用資料表自動增長(AUTO_INCREMENT) `roomimage`
--
ALTER TABLE `roomimage`
  MODIFY `roomImgNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK autoIncrement';

--
-- 已傾印資料表的限制(constraint)
--

--
-- 資料表的限制(constraint) `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`memNo`) REFERENCES `member` (`memno`),
  ADD CONSTRAINT `article_ibfk_2` FOREIGN KEY (`cardNo`) REFERENCES `card` (`cardno`);

--
-- 資料表的限制(constraint) `articlereport`
--
ALTER TABLE `articlereport`
  ADD CONSTRAINT `articlereport_ibfk_1` FOREIGN KEY (`artNo`) REFERENCES `article` (`artno`),
  ADD CONSTRAINT `articlereport_ibfk_2` FOREIGN KEY (`memNo`) REFERENCES `member` (`memno`);

--
-- 資料表的限制(constraint) `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `card_ibfk_5` FOREIGN KEY (`memNo`) REFERENCES `member` (`memno`);

--
-- 資料表的限制(constraint) `carditem1`
--
ALTER TABLE `carditem1`
  ADD CONSTRAINT `carditem1_ibfk_1` FOREIGN KEY (`cardNo`) REFERENCES `card` (`cardno`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `carditem1_ibfk_2` FOREIGN KEY (`item1No`) REFERENCES `item` (`itemno`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- 資料表的限制(constraint) `carditem2`
--
ALTER TABLE `carditem2`
  ADD CONSTRAINT `carditem2_ibfk_1` FOREIGN KEY (`cardNo`) REFERENCES `card` (`cardno`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `carditem2_ibfk_2` FOREIGN KEY (`item2No`) REFERENCES `item` (`itemno`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- 資料表的限制(constraint) `carditem3`
--
ALTER TABLE `carditem3`
  ADD CONSTRAINT `carditem3_ibfk_1` FOREIGN KEY (`cardNo`) REFERENCES `card` (`cardno`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `carditem3_ibfk_2` FOREIGN KEY (`item3No`) REFERENCES `item` (`itemno`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- 資料表的限制(constraint) `carditem4`
--
ALTER TABLE `carditem4`
  ADD CONSTRAINT `carditem4_ibfk_1` FOREIGN KEY (`cardNo`) REFERENCES `card` (`cardno`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `carditem4_ibfk_2` FOREIGN KEY (`item4No`) REFERENCES `item` (`itemno`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- 資料表的限制(constraint) `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`effectTypeNo`) REFERENCES `effecttype` (`effecttypeno`);

--
-- 資料表的限制(constraint) `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`artNo`) REFERENCES `article` (`artno`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`memNo`) REFERENCES `member` (`memno`);

--
-- 資料表的限制(constraint) `membercoupon`
--
ALTER TABLE `membercoupon`
  ADD CONSTRAINT `membercoupon_ibfk_1` FOREIGN KEY (`couponNo`) REFERENCES `coupon` (`couponno`),
  ADD CONSTRAINT `membercoupon_ibfk_2` FOREIGN KEY (`memNo`) REFERENCES `member` (`memno`);

--
-- 資料表的限制(constraint) `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`artNo`) REFERENCES `article` (`artno`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`memNo`) REFERENCES `member` (`memno`);

--
-- 資料表的限制(constraint) `messagereport`
--
ALTER TABLE `messagereport`
  ADD CONSTRAINT `messagereport_ibfk_1` FOREIGN KEY (`mesNo`) REFERENCES `message` (`mesno`),
  ADD CONSTRAINT `messagereport_ibfk_2` FOREIGN KEY (`memNo`) REFERENCES `member` (`memno`);

--
-- 資料表的限制(constraint) `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`memNo`) REFERENCES `member` (`memno`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`roomNo`) REFERENCES `room` (`roomno`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`cardNo`) REFERENCES `card` (`cardno`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`couponNo`) REFERENCES `coupon` (`couponno`);

--
-- 資料表的限制(constraint) `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`keywordNo`) REFERENCES `keyword` (`keywordno`);

--
-- 資料表的限制(constraint) `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`roomNo`) REFERENCES `room` (`roomno`);

--
-- 資料表的限制(constraint) `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`branchNo`) REFERENCES `branch` (`branchno`);

--
-- 資料表的限制(constraint) `roomimage`
--
ALTER TABLE `roomimage`
  ADD CONSTRAINT `roomimage_ibfk_1` FOREIGN KEY (`roomNo`) REFERENCES `room` (`roomno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
