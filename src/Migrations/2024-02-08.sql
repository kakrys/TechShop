SET NAMES utf8mb4;

INSERT INTO `product` (`ID`, `TITLE`, `DESCRIPTION`, `PRICE`, `ENTITY_STATUS_ID`, `DATE_RELEASE`, `DATE_UPDATE`, `SORT_ORDER`, `BRAND_ID`) VALUES
    (11,	'Apple iPad Air',	'Apple M1 chip powers next-level performance and all-day battery life',	499,	1,	'2024-02-08 19:14:36',	'2024-02-08 19:14:36',	1,	1),
    (12,	'Dell Inspiron 16 5620 Laptop',	'Dell Inspiron 16 5620 Laptop- 16.0-inch 16:10 FHD+ (1920 x 1200) Display, Intel Core i7-1255U, 16GB Memory, 512GB SSD, NVIDIA GeForce MX570, Intel Wi-Fi 6E, Windows 11 Home - Platinum Silver',	580,	1,	'2024-02-08 19:17:37',	'2024-02-08 19:17:37',	1,	3),
    (13,	'Sony DualSense wireless controller',	'Discover a deeper gaming experience1 with the innovative PS5® controller.The DualSense wireless controller for PS5 consoles offers immersive haptic feedback2, dynamic adaptive triggers and a built-in microphone, all integrated into an iconic design.',	69,	1,	'2024-02-08 19:20:11',	'2024-02-08 19:20:11',	1,	6),
    (14,	'Samsung Galaxy S24 Ultra',	'Elevate your work with the most epic Galaxy yet, featuring the game-changing power of Galaxy AI. From researching on the spot to capturing every detail of your projects day or night, unleash new ways to stay productive, collaborate and more.',	750,	1,	'2024-02-08 19:27:12',	'2024-02-08 19:27:12',	1,	2),
    (15,	'Apple AirPods Pro (2nd generation)',	'AirPods Pro (2nd generation) with MagSafe Charging Case (USB‑C).Active Noise Cancellation and Transparency mode.Personalized Spatial Audio with dynamic head tracking.',	249,	1,	'2024-02-08 19:29:34',	'2024-02-08 19:29:34',	1,	1),
    (16,	'Apple MacBook Air',	'Strikingly thin and fast so you can work, play, or create anywhere.The most affordable Mac laptop to get things done on the go.',	1299,	1,	'2024-02-08 19:31:19',	'2024-02-08 19:31:19',	1,	1),
    (17,	'Sony Alpha 9 III - Full-frame Mirrorless Interchangeable Lens Camera',	'Unprecedented imagery from the world’s first camera with global shutter full-frame image sensor Blackout-free, 120 fps continuous shooting with full AF/AE tracking Preserve split-second moments with maximum shutter speed of 1/80,000 second',	5999,	1,	'2024-02-08 19:35:50',	'2024-02-08 19:35:50',	1,	6),
    (18,	'Sony Xperia 1 V 256GB',	'factory unlocked smartphone, 6.5” 4K 120Hz display, 4K 120fps HDR, true optical zoom, 5G',	1295,	1,	'2024-02-08 19:39:49',	'2024-02-08 19:39:49',	1,	6),
    (19,	'Case with Stand for Sony Xperia 1 V',	'Comfortable grip for shooting videos and photos. Two-way kickstand for shooting selfies, video chat, live stream and watching videos. Functional tactile texture and color to match your phone.',	38,	1,	'2024-02-08 19:41:23',	'2024-02-08 19:41:23',	1,	6);
INSERT INTO `product_tag` (`PRODUCT_ID`, `TAG_ID`) VALUES
   (11,	3),
   (12,	2),
   (13,	7),
   (13,	8),
   (14,	1),
   (15,	5),
   (16,	2),
   (17,	6),
   (18,	1),
   (19,	8);
INSERT INTO `image` (`ID`, `PRODUCT_ID`, `PATH`, `IS_COVER`) VALUES
(11,	11,	'f7e84d927b9be34476054b450e9340dc.png',	1),
(12,	12,	'604e13f3feb884019da3ea375f9ebe08.png',	1),
(13,	13,	'0d6917938a7970c79c53565079423dc4.png',	1),
(14,	14,	'93602e63d2d068e24011586f0b5f616c.png',	1),
(15,	15,	'0081f692cdaa98a294108241190533fd.png',	1),
(16,	16,	'ede6cecb07d67dd037cc378f123ebd28.png',	1),
(17,	17,	'407af8f8543df9f1a56e9e174412e969.png',	1),
(18,	18,	'1619ea06b5e4f48503cbb018a2876c3a.png',	1),
(19,	19,	'3c47a7e6513344f2f7ac3156b4e51c4d.png',	1);