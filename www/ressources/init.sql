DROP TABLE IF EXISTS `rents`;
DROP TABLE IF EXISTS `vehicles`; 
DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `clients`;

CREATE TABLE `clients`(
   `id_client` INT NOT NULL AUTO_INCREMENT,
   `lastname` VARCHAR(50)  NOT NULL,
   `firstname` VARCHAR(50)  NOT NULL,
   `email` VARCHAR(255)  NOT NULL,
   `birthday` DATE NOT NULL,
   `phone` CHAR(12)  NOT NULL,
   `city` VARCHAR(100)  NOT NULL,
   `zipcode` CHAR(5)  NOT NULL,
   `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
   `updated_at` DATETIME,
   PRIMARY KEY(`id_client`)
);

CREATE TABLE `categories`(
   `id_category` INT NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(50)  NOT NULL,
   PRIMARY KEY(`id_category`)
);

CREATE TABLE `vehicles`(
   `id_vehicle` INT NOT NULL AUTO_INCREMENT,
   `brand` VARCHAR(50)  NOT NULL,
   `model` VARCHAR(50)  NOT NULL,
   `registration` VARCHAR(10)  NOT NULL,
   `mileage` INT NOT NULL,
   `picture` VARCHAR(150),
   `id_category` INT NOT NULL,
   `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
   `updated_at` DATETIME NOT NULL,
   `deleted_at` DATETIME,
   PRIMARY KEY(`id_vehicle`),
   FOREIGN KEY(`id_category`) REFERENCES `categories`(`id_category`)
);

CREATE TABLE `rents`(
   `id_rent` INT NOT NULL AUTO_INCREMENT,
   `startdate` DATETIME NOT NULL,
   `enddate` DATETIME NOT NULL,
   `id_vehicle` INT NOT NULL,
   `id_client` INT NOT NULL,
   `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
   `confirmed_at` DATETIME,
   PRIMARY KEY(`id_rent`),
   FOREIGN KEY(`id_vehicle`) REFERENCES `vehicles`(`id_vehicle`),
   FOREIGN KEY(`id_client`) REFERENCES `clients`(`id_client`)
);

DELIMITER $$; 
CREATE TRIGGER vehicles_update 
BEFORE UPDATE ON `vehicles`
FOR EACH ROW
BEGIN
   SET NEW.updated_at = CURRENT_TIMESTAMP;
END $$

CREATE TRIGGER clients_update
BEFORE UPDATE ON `clients`
FOR EACH ROW
BEGIN
   SET NEW.updated_at = CURRENT_TIMESTAMP;
END $$

DELIMITER ;


DELIMITER //
CREATE EVENT update_status
ON SCHEDULE EVERY 1 DAY
DO
BEGIN
  UPDATE `rents`
  SET status = 'en cours'
  WHERE (`startdate` < CURRENT_TIMESTAMP) AND (`enddate` > CURRENT_TIMESTAMP);

  UPDATE `rents`
  SET status = 'passée'
  WHERE (`startdate` < CURRENT_TIMESTAMP) AND (`enddate` < CURRENT_TIMESTAMP);
END//
DELIMITER ;