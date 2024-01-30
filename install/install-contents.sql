ALTER TABLE ENTITY_STATUS AUTO_INCREMENT = 1;
INSERT INTO  `ENTITY_STATUS`(`TITLE`)
VALUES('Активный'),
      ('Неактивный');

INSERT INTO `TAG`( `TITLE`, `ENTITY_STATUS_ID`)
VALUES
    ('Мобильные телефоны',1),
    ('Ноутбуки',1),
    ('Планшеты',1),
    ('Часы',1),
    ('Наушники',1),
    ('Камеры',1),
    ('Игровые приставки',1),
    ('Аксессуары',1);