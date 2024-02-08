-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 31 2024 г., 20:21
-- Версия сервера: 5.7.39
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `DbTechnoShop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `BRAND`
--

CREATE TABLE `BRAND` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `BRAND`
--

INSERT INTO `BRAND` (`id`, `title`) VALUES
(1, 'Apple'),
(2, 'Samsung'),
(3, 'Dell'),
(4, 'Nintendo'),
(5, 'Canon'),
(6, 'Sony');

-- --------------------------------------------------------

--
-- Структура таблицы `ENTITY_STATUS`
--

CREATE TABLE `ENTITY_STATUS` (
  `ID` int(11) NOT NULL,
  `TITLE` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `ENTITY_STATUS`
--

INSERT INTO `ENTITY_STATUS` (`ID`, `TITLE`) VALUES
(1, 'Активный'),
(2, 'Неактивный');

-- --------------------------------------------------------

--
-- Структура таблицы `IMAGE`
--

CREATE TABLE `IMAGE` (
  `ID` int(11) NOT NULL,
  `PRODUCT_ID` int(11) NOT NULL,
  `PATH` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IS_COVER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `ORDER`
--

CREATE TABLE `ORDER` (
  `ID` int(11) NOT NULL,
  `PRICE` float NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `PRODUCT_ID` int(11) NOT NULL,
  `ADDRESS` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `STATUS_ID` int(11) NOT NULL,
  `ENTITY_STATUS_ID` int(11) NOT NULL,
  `DATE_CREATE` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `PRODUCT`
--

CREATE TABLE `PRODUCT` (
  `ID` int(11) NOT NULL,
  `TITLE` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DESCRIPTION` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PRICE` float NOT NULL,
  `ENTITY_STATUS_ID` int(11) NOT NULL,
  `DATE_RELEASE` datetime DEFAULT CURRENT_TIMESTAMP,
  `DATE_UPDATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `SORT_ORDER` int(11) NOT NULL DEFAULT '0',
  `BRAND_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `PRODUCT`
--

INSERT INTO `PRODUCT` (`ID`, `TITLE`, `DESCRIPTION`, `PRICE`, `ENTITY_STATUS_ID`, `DATE_RELEASE`, `DATE_UPDATE`, `SORT_ORDER`, `BRAND_ID`) VALUES
(1, 'Apple iPhone 13 Pro Max', 'Features Proximity Sensor, E-compass, Gyro Sensor, Accelerometer, Ambient Light Sensor, Barometer, Ultra Wide-Angle Camera, eSIM, Telephoto Lens, LiDAR Scanner', 450, 1, '2024-01-30 22:56:11', '2024-01-30 22:56:11', 0, 1),
(2, 'Samsung Galaxy Tab S8 Wi-Fi + 5G (Without Simlock) 256GB, 11-Inch, SM-X706B', 'For sale is a SAMSUNG Galaxy Tab S8 WiFi+5G with 256GB of internal memory and 8GB of RAM. The high-performance tablet is perfect for students and gamers and comes with an S Pen, the Book Cover EJ-DT630 as a keyboard and a case and tempered glass for even more protection. It has been professionally cleaned and is fully functional.', 1000, 1, '2024-01-30 23:25:24', '2024-01-30 23:25:24', 0, 2),
(3, 'Dell Latitude 3420 14\" FHD 60Hz Intel i5-1135G7 256GB SSD 8GB RAM - Win 10 Pro', 'Dell Latitude 3420 Business Laptop Smaller and faster than ever? Yes. Level-up your productivity with this 14\" smart laptop. Customize to fit your needs with a vast array of options and speed your work with Dell Optimizer, now with ExpressConnect.', 740, 1, '2024-01-31 16:03:26', '2024-01-31 16:03:26', 0, 3),
(4, 'NEW Nintendo Switch OLED Mario Limited Edition + Mario Rabbids ✨ Sparks of Hope', 'Features  This limited edition Mario OLED Switch features a vivid 7-inch OLED screen, detachable Joy-Con controllers, 64 GB internal storage, improved audio, and a dock with a wired LAN port. This bundle includes the console and the Mario + Rabbids Sparks of Hope Game. This region free console is playable anywhere and genuine from Nintendo.', 323, 1, '2024-01-31 16:07:08', '2024-01-31 16:07:08', 0, 4),
(5, 'Nintendo Switch Pro Controller, Bluetooth Wireless Gaming Controller Switch Game -NFC', 'High Quality Controller for Nintendo Switch: 100% brand new and high quality, designed for an immersive gaming experience with your Nintendo Switch.   Innovative Features :   Double Shock: For a more realistic gaming experience.  Turbo, Capture, and Home functions: Advanced controls to improve your game.  0.7m Charging Cable: Convenient to play while charging.  2 High-quality Analog Sticks: No dead zone for precise control.  Bluetooth Version 2.1 + EDR: Reliable wireless connection.', 60, 1, '2024-01-31 19:11:55', '2024-01-31 19:11:55', 0, 4),
(6, 'Apple Watch Series 7 41mm 32 GB Aluminum Case Sport Band Midnight', 'pple has become a staple in the smart watch community. They have stepped up their game with the Apple Watch Series 7. It has a beautiful 41 mm retina display and sensors that can read your blood oxygen level and heart rate. The battery life of this device can last over 24 hours and it is water resistant up to 164 feet.  Display:  41 mm Retina Display  Operating system:  Apple iOS  Wi-Fi Compatibility:  Wireless B | Wireless G | Wireless N  Storage:  32 GB', 350, 1, '2024-01-31 19:14:49', '2024-01-31 19:14:49', 0, 1),
(7, 'Samsung Galaxy Buds 2 Pro SM-R510 Wireless Earbud Headphones Bluetooth', 'ACTIVE NOISE CANCELLATION: Reduce unwanted noise with Galaxy Buds2 Pro; They use Intelligent Active Noise Cancellation* to quiet even the loudest outside sounds; Tune in to what matters most without being bothered by distracting sounds around you.Note : If the size of the earbud tips does not match the size of your ear canals or the headset is not worn properly in your ears, you may not obtain the correct sound qualities or call performance. Change the earbud tips to ones that fit more snugly in your ear HI-FI SOUND QUALITY: Studio quality sound isn’t just for the pros; Feel every note like you’re there with Galaxy Buds2 Pro** and get a next-level listening experience, whether you’re rocking out to your playlist or staying informed with a podcast ENHANCED 360-DEGREE AUDIO: Amplify what you like; Minimize what you don’t; Enhanced 360-degree audio** brings out the tones you love from every angle for a personalized surround sound experience every time you pop them in', 129.99, 1, '2024-01-31 19:17:04', '2024-01-31 19:17:04', 0, 2),
(8, 'Canon EOS 5D Mark II Digital SLR Camera Black Superb', 'Explore the world of photography and perfect your skills with this Canon EOS Digital SLR Camera. Great for larger prints, this DSLR camera features 30.4-megapixel resolution to capture impressive detail. The camera features a USB port for transferring content to other devices and showing your pictures to friends and family. Sharpen your skills and take extraordinary photos with this Canon EOS Digital SLR Camera.', 359.99, 1, '2024-01-31 19:21:16', '2024-01-31 19:21:16', 0, 5),
(9, 'Apple iPhone 14 - 512 GB ', 'The iPhone 14 display has rounded corners that follow a beautiful curved design, and these corners are within a standard rectangle. When measured as a standard rectangular shape, the screen is 6.06 inches diagonally (actual viewable area is less).', 1338, 1, '2024-01-31 20:11:15', '2024-01-31 20:11:15', 0, 1),
(10, 'Sony PS5 Blu-Ray Edition Console', 'The PlayStation 5s main hardware features include a solid-state drive customized for high-speed data streaming to enable significant improvements in storage performance, an AMD GPU capable of 4K resolution display at up to 120 frames per second, hardware-accelerated ray tracing for realistic lighting and reflections.', 399.99, 1, '2024-01-31 20:11:56', '2024-01-31 20:11:56', 0, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `PRODUCT_ORDER`
--

CREATE TABLE `PRODUCT_ORDER` (
  `PRODUCT_ID` int(11) NOT NULL,
  `ORDER_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `PRODUCT_TAG`
--

CREATE TABLE `PRODUCT_TAG` (
  `PRODUCT_ID` int(11) NOT NULL,
  `TAG_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `PRODUCT_TAG`
--

INSERT INTO `PRODUCT_TAG` (`PRODUCT_ID`, `TAG_ID`) VALUES
(1, 1),
(2, 3),
(3, 2),
(4, 7),
(5, 8),
(5, 7),
(6, 4),
(7, 5),
(8, 6),
(9, 1),
(10, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `ROLE`
--

CREATE TABLE `ROLE` (
  `ID` int(11) NOT NULL,
  `TITLE` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `ROLE`
--


-- --------------------------------------------------------

--
-- Структура таблицы `STATUS`
--

CREATE TABLE `STATUS` (
  `ID` int(11) NOT NULL,
  `TITLE` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `TAG`
--

CREATE TABLE `TAG` (
  `ID` int(11) NOT NULL,
  `TITLE` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ENTITY_STATUS_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `TAG`
--

INSERT INTO `TAG` (`ID`, `TITLE`, `ENTITY_STATUS_ID`) VALUES
(1, 'mobile', 1),
(2, 'laptop', 1),
(3, 'tablet', 1),
(4, 'wearable', 1),
(5, 'audio', 1),
(6, 'camera', 1),
(7, 'gaming', 1),
(8, 'accessories', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `USER`
--

CREATE TABLE `USER` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SURNAME` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EMAIL` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PASSWORD` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ADDRESS` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ROLE_ID` int(11) NOT NULL,
  `ENTITY_STATUS_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `BRAND`
--
ALTER TABLE `BRAND`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ENTITY_STATUS`
--
ALTER TABLE `ENTITY_STATUS`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `IMAGE`
--
ALTER TABLE `IMAGE`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `PRODUCT_ID` (`PRODUCT_ID`);

--
-- Индексы таблицы `ORDER`
--
ALTER TABLE `ORDER`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ENTITY_STATUS_ID` (`ENTITY_STATUS_ID`),
  ADD KEY `STATUS_ID` (`STATUS_ID`),
  ADD KEY `PRODUCT_ID` (`PRODUCT_ID`);

--
-- Индексы таблицы `PRODUCT`
--
ALTER TABLE `PRODUCT`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ENTITY_STATUS_ID` (`ENTITY_STATUS_ID`),
  ADD KEY `BRAND_ID` (`BRAND_ID`);

--
-- Индексы таблицы `PRODUCT_ORDER`
--
ALTER TABLE `PRODUCT_ORDER`
  ADD KEY `ORDER_ID` (`ORDER_ID`),
  ADD KEY `PRODUCT_ID` (`PRODUCT_ID`);

--
-- Индексы таблицы `PRODUCT_TAG`
--
ALTER TABLE `PRODUCT_TAG`
  ADD KEY `PRODUCT_ID` (`PRODUCT_ID`),
  ADD KEY `TAG_ID` (`TAG_ID`);

--
-- Индексы таблицы `ROLE`
--
ALTER TABLE `ROLE`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `STATUS`
--
ALTER TABLE `STATUS`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `TAG`
--
ALTER TABLE `TAG`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ENTITY_STATUS_ID` (`ENTITY_STATUS_ID`);

--
-- Индексы таблицы `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`),
  ADD KEY `ROLE_ID` (`ROLE_ID`),
  ADD KEY `ENTITY_STATUS_ID` (`ENTITY_STATUS_ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `BRAND`
--
ALTER TABLE `BRAND`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `ENTITY_STATUS`
--
ALTER TABLE `ENTITY_STATUS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `IMAGE`
--
ALTER TABLE `IMAGE`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `ORDER`
--
ALTER TABLE `ORDER`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `PRODUCT`
--
ALTER TABLE `PRODUCT`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `ROLE`
--
ALTER TABLE `ROLE`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `STATUS`
--
ALTER TABLE `STATUS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `TAG`
--
ALTER TABLE `TAG`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `USER`
--
ALTER TABLE `USER`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `IMAGE`
--
ALTER TABLE `IMAGE`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `PRODUCT` (`ID`);

--
-- Ограничения внешнего ключа таблицы `ORDER`
--
ALTER TABLE `ORDER`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`ENTITY_STATUS_ID`) REFERENCES `ENTITY_STATUS` (`ID`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`STATUS_ID`) REFERENCES `STATUS` (`ID`),
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `PRODUCT` (`ID`);

--
-- Ограничения внешнего ключа таблицы `PRODUCT`
--
ALTER TABLE `PRODUCT`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`ENTITY_STATUS_ID`) REFERENCES `ENTITY_STATUS` (`ID`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`BRAND_ID`) REFERENCES `BRAND` (`id`);

--
-- Ограничения внешнего ключа таблицы `PRODUCT_ORDER`
--
ALTER TABLE `PRODUCT_ORDER`
  ADD CONSTRAINT `product_order_ibfk_1` FOREIGN KEY (`ORDER_ID`) REFERENCES `ORDER` (`ID`),
  ADD CONSTRAINT `product_order_ibfk_2` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `PRODUCT` (`ID`);

--
-- Ограничения внешнего ключа таблицы `PRODUCT_TAG`
--
ALTER TABLE `PRODUCT_TAG`
  ADD CONSTRAINT `product_tag_ibfk_1` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `PRODUCT` (`ID`),
  ADD CONSTRAINT `product_tag_ibfk_2` FOREIGN KEY (`TAG_ID`) REFERENCES `TAG` (`ID`);

--
-- Ограничения внешнего ключа таблицы `TAG`
--
ALTER TABLE `TAG`
  ADD CONSTRAINT `tag_ibfk_1` FOREIGN KEY (`ENTITY_STATUS_ID`) REFERENCES `ENTITY_STATUS` (`ID`);

--
-- Ограничения внешнего ключа таблицы `USER`
--
ALTER TABLE `USER`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`ROLE_ID`) REFERENCES `ROLE` (`ID`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`ENTITY_STATUS_ID`) REFERENCES `ENTITY_STATUS` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
