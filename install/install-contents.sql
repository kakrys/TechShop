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