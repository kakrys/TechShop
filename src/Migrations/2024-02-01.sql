SET NAMES utf8mb4;

INSERT INTO `ROLE` (`ID`, `TITLE`) VALUES
    (1, 'admin'),
    (2, 'user');
INSERT INTO `USER` (`ID`, `NAME`, `SURNAME`, `EMAIL`, `PASSWORD`, `ADDRESS`, `ROLE_ID`, `ENTITY_STATUS_ID`) VALUES
    (2, 'Vadim', 'Valeev', 'admin@gmail.com', '$2y$10$pQD0zMpuvZQ6K4X8/MG3HuklvFOVklQSOd1lhAf4ij3uIhuoFHY.q', 'Kaliningrad', 1, 1);


