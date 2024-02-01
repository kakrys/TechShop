SET NAMES utf8mb4;

INSERT INTO `ROLE` (`ID`, `TITLE`) VALUES
    (1,	'admin');
INSERT INTO `USER` (`ID`, `NAME`, `SURNAME`, `EMAIL`, `PASSWORD`, `ADDRESS`, `ROLE_ID`, `ENTITY_STATUS_ID`) VALUES
    (2,	'Vadim',	'Valeev',	'admin@gmail.com',	'password',	'asfasfasf',	1,	1);
