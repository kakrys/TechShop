CREATE TABLE `PRODUCT` (
	                       `ID` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	                       `TITLE` varchar(255) NOT NULL,
	                       `DESCRIPTION` varchar(1000) NOT NULL,
	                       `PRICE` float NOT NULL,
	                       `ENTITY_STATUS_ID` int NOT NULL,
	                       `DATE_RELEASE` datetime DEFAULT NOW(),
	                       `DATE_UPDATE` datetime DEFAULT NOW(),
	                       `SORT_ORDER` int NOT NULL DEFAULT 0
);

CREATE TABLE `ORDER` (
	                     `ID` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	                     `PRICE` float NOT NULL,
	                     `USER_ID` int NOT NULL,
	                     `PRODUCT_ID` int NOT NULL,
	                     `ADDRESS` varchar(255) NOT NULL,
	                     `STATUS_ID` int NOT NULL,
	                     `ENTITY_STATUS_ID` int NOT NULL,
	                     `DATE_CREATE` datetime DEFAULT NOW()
);

CREATE TABLE `TAG` (
	                   `ID` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	                   `TITLE` varchar(255) NOT NULL,
	                   `ENTITY_STATUS_ID` int NOT NULL
);

CREATE TABLE `USER` (
	                    `ID` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	                    `NAME` varchar(255) NOT NULL,
	                    `SURNAME` varchar(255) NOT NULL,
	                    `EMAIL` varchar(255) UNIQUE NOT NULL,
	                    `PASSWORD` varchar(255),
	                    `ADDRESS` varchar(255),
	                    `ROLE_ID` int NOT NULL,
	                    `ENTITY_STATUS_ID` int NOT NULL
);

CREATE TABLE `IMAGE` (
	                     `ID` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	                     `PRODUCT_ID` int NOT NULL,
	                     `PATH` varchar(255) NOT NULL,
	                     `IS_COVER` int NOT NULL
);

CREATE TABLE `ROLE` (
	                    `ID` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	                    `TITLE` varchar(255) NOT NULL
);

CREATE TABLE `PRODUCT_ORDER` (
	                             `PRODUCT_ID` int NOT NULL,
	                             `ORDER_ID` int NOT NULL
);

CREATE TABLE `PRODUCT_TAG` (
	                           `PRODUCT_ID` int NOT NULL,
	                           `TAG_ID` int NOT NULL
);

CREATE TABLE `STATUS` (
	                      `ID` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	                      `TITLE` varchar(255) NOT NULL
);

CREATE TABLE `ENTITY_STATUS` (
	                             `ID` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	                             `TITLE` varchar(255) NOT NULL
);

ALTER TABLE `USER` ADD FOREIGN KEY (`ROLE_ID`) REFERENCES `ROLE` (`ID`);

ALTER TABLE `PRODUCT_TAG` ADD FOREIGN KEY (`PRODUCT_ID`) REFERENCES `PRODUCT` (`ID`);

ALTER TABLE `PRODUCT_TAG` ADD FOREIGN KEY (`TAG_ID`) REFERENCES `TAG` (`ID`);

ALTER TABLE `PRODUCT_ORDER` ADD FOREIGN KEY (`ORDER_ID`) REFERENCES `ORDER` (`ID`);

ALTER TABLE `PRODUCT_ORDER` ADD FOREIGN KEY (`PRODUCT_ID`) REFERENCES `PRODUCT` (`ID`);

ALTER TABLE `USER` ADD FOREIGN KEY (`ENTITY_STATUS_ID`) REFERENCES `ENTITY_STATUS` (`ID`);

ALTER TABLE `PRODUCT` ADD FOREIGN KEY (`ENTITY_STATUS_ID`) REFERENCES `ENTITY_STATUS` (`ID`);

ALTER TABLE `ORDER` ADD FOREIGN KEY (`ENTITY_STATUS_ID`) REFERENCES `ENTITY_STATUS` (`ID`);

ALTER TABLE `ORDER` ADD FOREIGN KEY (`STATUS_ID`) REFERENCES `STATUS` (`ID`);

ALTER TABLE `ORDER` ADD FOREIGN KEY (`PRODUCT_ID`) REFERENCES `PRODUCT` (`ID`);

ALTER TABLE `TAG` ADD FOREIGN KEY (`ENTITY_STATUS_ID`) REFERENCES `ENTITY_STATUS` (`ID`);

ALTER TABLE `IMAGE` ADD FOREIGN KEY (`PRODUCT_ID`) REFERENCES `PRODUCT` (`ID`);
