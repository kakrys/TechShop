ALTER TABLE ENTITY_STATUS
    AUTO_INCREMENT = 1;
INSERT INTO `ENTITY_STATUS`(`TITLE`)
VALUES ('Active'),
       ('Inactive');
INSERT INTO `tag` (`ID`, `TITLE`, `ENTITY_STATUS_ID`)
VALUES (1, 'mobile', 1),
       (2, 'laptop', 1),
       (3, 'tablet', 1),
       (4, 'wearable', 1),
       (5, 'audio', 1),
       (6, 'camera', 1),
       (7, 'gaming', 1),
       (8, 'accessories', 1);
INSERT INTO `brand` (`id`, `title`)
VALUES (1, 'Apple'),
       (2, 'Samsung'),
       (3, 'Dell'),
       (4, 'Nintendo'),
       (5, 'Canon'),
       (6,	'Sony');
INSERT INTO `product` (`ID`, `TITLE`, `DESCRIPTION`, `PRICE`, `ENTITY_STATUS_ID`, `DATE_RELEASE`, `DATE_UPDATE`,
                       `SORT_ORDER`, `BRAND_ID`)
VALUES (1, 'iPhone 13 Pro Max',
        'Features Proximity Sensor, E-compass, Gyro Sensor, Accelerometer, Ambient Light Sensor, Barometer, Ultra Wide-Angle Camera, eSIM, Telephoto Lens, LiDAR Scanner',
        450, 1, '2024-01-30 22:56:11', '2024-01-30 22:56:11', 0, 1),
       (2, 'Samsung Galaxy Tab S8 Wi-Fi + 5G (Without Simlock) 256GB, 11-Inch, SM-X706B',
        'For sale is a SAMSUNG Galaxy Tab S8 WiFi+5G with 256GB of internal memory and 8GB of RAM. The high-performance tablet is perfect for students and gamers and comes with an S Pen, the Book Cover EJ-DT630 as a keyboard and a case and tempered glass for even more protection. It has been professionally cleaned and is fully functional.',
        1000, 1, '2024-01-30 23:25:24', '2024-01-30 23:25:24', 0, 2),
       (3, 'Dell Latitude 3420 14\" FHD 60Hz Intel i5-1135G7 256GB SSD 8GB RAM - Win 10 Pro',
        'Dell Latitude 3420 Business Laptop Smaller and faster than ever? Yes. Level-up your productivity with this 14\" smart laptop. Customize to fit your needs with a vast array of options and speed your work with Dell Optimizer, now with ExpressConnect.',
        740, 1, '2024-01-31 16:03:26', '2024-01-31 16:03:26', 0, 3),
       (4, 'NEW Nintendo Switch OLED Mario Limited Edition + Mario Rabbids вњЁ Sparks of Hope',
        'Features  This limited edition Mario OLED Switch features a vivid 7-inch OLED screen, detachable Joy-Con controllers, 64 GB internal storage, improved audio, and a dock with a wired LAN port. This bundle includes the console and the Mario + Rabbids Sparks of Hope Game. This region free console is playable anywhere and genuine from Nintendo.',
        323, 1, '2024-01-31 16:07:08', '2024-01-31 16:07:08', 0, 4),
       (5, 'Nintendo Switch Pro Controller, Bluetooth Wireless Gaming Controller Switch Game -NFC',
        'High Quality Controller for Nintendo Switch: 100% brand new and high quality, designed for an immersive gaming experience with your Nintendo Switch.   Innovative Features :   Double Shock: For a more realistic gaming experience.  Turbo, Capture, and Home functions: Advanced controls to improve your game.  0.7m Charging Cable: Convenient to play while charging.  2 High-quality Analog Sticks: No dead zone for precise control.  Bluetooth Version 2.1 + EDR: Reliable wireless connection.',
        60, 1, '2024-01-31 19:11:55', '2024-01-31 19:11:55', 0, 4),
       (6, 'Apple Watch Series 7 41mm 32 GB Aluminum Case Sport Band Midnight',
        'pple has become a staple in the smart watch community. They have stepped up their game with the Apple Watch Series 7. It has a beautiful 41 mm retina display and sensors that can read your blood oxygen level and heart rate. The battery life of this device can last over 24 hours and it is water resistant up to 164 feet.  Display:  41 mm Retina Display  Operating system:  Apple iOS  Wi-Fi Compatibility:  Wireless B | Wireless G | Wireless N  Storage:  32 GB',
        350, 1, '2024-01-31 19:14:49', '2024-01-31 19:14:49', 0, 4),
       (7, 'Samsung Galaxy Buds 2 Pro SM-R510 Wireless Earbud Headphones Bluetooth',
        'ACTIVE NOISE CANCELLATION: Reduce unwanted noise with Galaxy Buds2 Pro; They use Intelligent Active Noise Cancellation* to quiet even the loudest outside sounds; Tune in to what matters most without being bothered by distracting sounds around you.Note : If the size of the earbud tips does not match the size of your ear canals or the headset is not worn properly in your ears, you may not obtain the correct sound qualities or call performance. Change the earbud tips to ones that fit more snugly in your ear HI-FI SOUND QUALITY: Studio quality sound isnвЂ™t just for the pros; Feel every note like youвЂ™re there with Galaxy Buds2 Pro** and get a next-level listening experience, whether youвЂ™re rocking out to your playlist or staying informed with a podcast ENHANCED 360-DEGREE AUDIO: Amplify what you like; Minimize what you donвЂ™t; Enhanced 360-degree audio** brings out the tones you love from every angle for a personalized surround sound experience every time you pop them in',
        129.99, 1, '2024-01-31 19:17:04', '2024-01-31 19:17:04', 0, 2),
       (8, 'Canon EOS 5D Mark II Digital SLR Camera Black Superb',
        'Explore the world of photography and perfect your skills with this Canon EOS Digital SLR Camera. Great for larger prints, this DSLR camera features 30.4-megapixel resolution to capture impressive detail. The camera features a USB port for transferring content to other devices and showing your pictures to friends and family. Sharpen your skills and take extraordinary photos with this Canon EOS Digital SLR Camera.',
        359.99, 1, '2024-01-31 19:21:16', '2024-01-31 19:21:16', 0, 5),
       (9,	'Apple iPhone 14 - 512 GB ',	'The iPhone 14 display has rounded corners that follow a beautiful curved design, and these corners are within a standard rectangle. When measured as a standard rectangular shape, the screen is 6.06 inches diagonally (actual viewable area is less).',	1338,	1,	'2024-01-31 20:11:15',	'2024-01-31 20:11:15',	0,	1),
       (10,	'Sony PS5 Blu-Ray Edition Console',	'The PlayStation 5s main hardware features include a solid-state drive customized for high-speed data streaming to enable significant improvements in storage performance, an AMD GPU capable of 4K resolution display at up to 120 frames per second, hardware-accelerated ray tracing for realistic lighting and reflections.',	399.99,	1,	'2024-01-31 20:11:56',	'2024-01-31 20:11:56',	0,	6);


INSERT INTO `product_tag` (`PRODUCT_ID`, `TAG_ID`)
VALUES (1, 1),
       (2, 3),
       (3, 2),
       (4, 7),
       (5, 8),
       (5, 7),
       (6, 4),
       (7, 5),
       (8, 6),
        (9,1),
        (10,7);

