SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `mysql_webnostic` ;
CREATE SCHEMA IF NOT EXISTS `mysql_webnostic` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;
USE `mysql_webnostic` ;

-- -----------------------------------------------------
-- Table `mysql_webnostic`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mysql_webnostic`.`user` ;

CREATE  TABLE IF NOT EXISTS `mysql_webnostic`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(45) NULL ,
  `password` VARCHAR(45) NULL ,
  `nombres` VARCHAR(45) NULL ,
  `apellidos` VARCHAR(45) NULL ,
  `correo` VARCHAR(45) NULL ,
  `telefono` VARCHAR(45) NULL ,
  `ts` TIMESTAMP NULL ,
  `status` INT NULL ,
  `type` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
COMMENT = 'Tabla que guarda la informacion de los usuarios';


-- -----------------------------------------------------
-- Table `mysql_webnostic`.`status`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mysql_webnostic`.`status` ;

CREATE  TABLE IF NOT EXISTS `mysql_webnostic`.`status` (
  `id` INT NOT NULL ,
  `description` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mysql_webnostic`.`sample`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mysql_webnostic`.`sample` ;

CREATE  TABLE IF NOT EXISTS `mysql_webnostic`.`sample` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `calibration_value` VARCHAR(45) NULL ,
  `status_id` INT NOT NULL ,
  `ts` TIMESTAMP NULL ,
  `imagename` VARCHAR(45) NULL ,
  `imagepath` VARCHAR(80) NULL ,
  `trichu_score` VARCHAR(45) NULL ,
  `trichu_result` VARCHAR(45) NULL ,
  `taenia_score` VARCHAR(45) NULL ,
  `taenia_result` VARCHAR(45) NULL ,
  `fascio_score` VARCHAR(45) NULL ,
  `fascio_result` VARCHAR(45) NULL ,
  `diphy_score` VARCHAR(45) NULL ,
  `diphy_result` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sample_user` (`user_id` ASC) ,
  INDEX `fk_sample_status1` (`status_id` ASC) ,
  CONSTRAINT `fk_sample_user`
    FOREIGN KEY (`user_id` )
    REFERENCES `mysql_webnostic`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sample_status1`
    FOREIGN KEY (`status_id` )
    REFERENCES `mysql_webnostic`.`status` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mysql_webnostic`.`calibration`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mysql_webnostic`.`calibration` ;

CREATE  TABLE IF NOT EXISTS `mysql_webnostic`.`calibration` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `value` VARCHAR(45) NULL ,
  `status_id` INT NOT NULL ,
  `ts` TIMESTAMP NULL ,
  `description` VARCHAR(45) NULL ,
  `imagename` VARCHAR(45) NULL ,
  `imagepath` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_calibration_user1` (`user_id` ASC) ,
  INDEX `fk_calibration_status1` (`status_id` ASC) ,
  CONSTRAINT `fk_calibration_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `mysql_webnostic`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_calibration_status1`
    FOREIGN KEY (`status_id` )
    REFERENCES `mysql_webnostic`.`status` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mysql_webnostic`.`calibration_status_log`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mysql_webnostic`.`calibration_status_log` ;

CREATE  TABLE IF NOT EXISTS `mysql_webnostic`.`calibration_status_log` (
  `id` INT NOT NULL ,
  `calibration_id` INT NOT NULL ,
  `status_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_calibration_status_log_calibration1` (`calibration_id` ASC) ,
  INDEX `fk_calibration_status_log_status1` (`status_id` ASC) ,
  CONSTRAINT `fk_calibration_status_log_calibration1`
    FOREIGN KEY (`calibration_id` )
    REFERENCES `mysql_webnostic`.`calibration` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_calibration_status_log_status1`
    FOREIGN KEY (`status_id` )
    REFERENCES `mysql_webnostic`.`status` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mysql_webnostic`.`sample_status_log`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mysql_webnostic`.`sample_status_log` ;

CREATE  TABLE IF NOT EXISTS `mysql_webnostic`.`sample_status_log` (
  `id` INT NOT NULL ,
  `sample_id` INT NOT NULL ,
  `status_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sample_status_log_sample1` (`sample_id` ASC) ,
  INDEX `fk_sample_status_log_status1` (`status_id` ASC) ,
  CONSTRAINT `fk_sample_status_log_sample1`
    FOREIGN KEY (`sample_id` )
    REFERENCES `mysql_webnostic`.`sample` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sample_status_log_status1`
    FOREIGN KEY (`status_id` )
    REFERENCES `mysql_webnostic`.`status` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `mysql_webnostic`.`user`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `mysql_webnostic`;
INSERT INTO `mysql_webnostic`.`user` (`id`, `username`, `password`, `nombres`, `apellidos`, `correo`, `telefono`, `ts`, `status`, `type`) VALUES ('1', 'memberuser', '123456', 'member', 'user', '', '', CURRENT_TIMESTAMP, '1', '0');
INSERT INTO `mysql_webnostic`.`user` (`id`, `username`, `password`, `nombres`, `apellidos`, `correo`, `telefono`, `ts`, `status`, `type`) VALUES ('2', 'adminuser', '123456', 'admin', 'user', '', '', CURRENT_TIMESTAMP, '1', '1');
INSERT INTO `mysql_webnostic`.`user` (`id`, `username`, `password`, `nombres`, `apellidos`, `correo`, `telefono`, `ts`, `status`, `type`) VALUES ('3', 'inactivememberuser', '123456', 'inactive', 'member user', '', '', CURRENT_TIMESTAMP, '0', '0');
INSERT INTO `mysql_webnostic`.`user` (`id`, `username`, `password`, `nombres`, `apellidos`, `correo`, `telefono`, `ts`, `status`, `type`) VALUES ('4', 'inactiveadminuser', '123456', 'inactive', 'admin user', '', '', CURRENT_TIMESTAMP, '0', '1');

COMMIT;

-- -----------------------------------------------------
-- Data for table `mysql_webnostic`.`status`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `mysql_webnostic`;
INSERT INTO `mysql_webnostic`.`status` (`id`, `description`) VALUES ('1', 'on hold');
INSERT INTO `mysql_webnostic`.`status` (`id`, `description`) VALUES ('2', 'processing');
INSERT INTO `mysql_webnostic`.`status` (`id`, `description`) VALUES ('3', 'finish');
INSERT INTO `mysql_webnostic`.`status` (`id`, `description`) VALUES ('4', 'error');

COMMIT;
