SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `mysql_database` ;
CREATE SCHEMA IF NOT EXISTS `mysql_database` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mysql_database` ;

-- -----------------------------------------------------
-- Table `mysql_database`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mysql_database`.`user` ;

CREATE  TABLE IF NOT EXISTS `mysql_database`.`user` (
  `username` CHAR(30) NOT NULL ,
  `password` CHAR(45) NULL ,
  `nombres` CHAR(45) NULL ,
  `apellidos` CHAR(45) NULL ,
  `correo` CHAR(45) NULL ,
  `telefono` CHAR(45) NULL ,
  `ts` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  `status` CHAR(30) NULL ,
  `type` INT NULL ,
  PRIMARY KEY (`username`) )
ENGINE = InnoDB
COMMENT = 'Tabla que guarda la informacion de los usuarios';


-- -----------------------------------------------------
-- Table `mysql_database`.`status`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mysql_database`.`status` ;

CREATE  TABLE IF NOT EXISTS `mysql_database`.`status` (
  `id` INT NOT NULL ,
  `description` CHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mysql_database`.`sample`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mysql_database`.`sample` ;

CREATE  TABLE IF NOT EXISTS `mysql_database`.`sample` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` CHAR(250) NULL ,
  `result` CHAR(45) NULL ,
  `score` CHAR(45) NULL ,
  `calibration_value` CHAR(45) NULL ,
  `calibration_descr` CHAR(45) NULL ,
  `status_id` INT NOT NULL ,
  `ts` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  `originame` CHAR(45) NULL ,
  `imagename` CHAR(100) NULL ,
  `imagepath` CHAR(250) NULL ,
  `allexperts` CHAR(2) NOT NULL DEFAULT 'No' ,
  `status` VARCHAR(500) NULL ,
  `hide` int(1) NOT NULL DEFAULT '0' ,
  `mela_edad` CHAR(20) NULL ,
  `mela_tiem` CHAR(20) NULL ,
  `mela_mole` CHAR(20) NULL ,
  `mela_ubic` CHAR(30) NULL ,
  `tb_muestra` CHAR(50) NULL ,
  `tb_cultivo` CHAR(10) NULL ,
  `tb_pozo` CHAR(20) NULL ,
  `tb_diagnos` CHAR(30) NULL ,
  `tb_procesa` DATE NULL ,
  `tb_foto` DATE NULL ,
  `ccu_lamina` CHAR( 20 ) NOT NULL ,
  `ccu_fur` DATE NOT NULL ,
  `ccu_edad` CHAR( 10 ) NOT NULL ,
  `ccu_pap` DATE NOT NULL ,
  `ccu_dxpap` CHAR( 20 ) NOT NULL ,
  `ccu_gp` CHAR( 20 ) NOT NULL ,
  `ccu_lacta` CHAR( 20 ) NOT NULL ,
  `ccu_gesta` CHAR( 20 ) NOT NULL ,
  `ccu_mac` CHAR( 50 ) NOT NULL ,
  `ccu_antece` CHAR( 200 ) NOT NULL ,
  `ccu_per` CHAR( 100 ) NOT NULL ,
  `vag_flu` CHAR(60) NULL ,
  `vag_can` CHAR(30) NULL ,
  `vag_fet` CHAR(30) NULL ,
  `vag_ami` CHAR(30) NULL ,
  `vag_sec` CHAR(30) NULL ,
  `vag_cel` CHAR(30) NULL ,
  `vag_pru` CHAR(30) NULL ,
  `vag_irr` CHAR(30) NULL , 
  
  PRIMARY KEY (`id`) ,
  
  INDEX `fk_sample_status1` (`status_id` ASC) ,
  
  CONSTRAINT `fk_sample_status1`
    FOREIGN KEY (`status_id` )
    REFERENCES `mysql_database`.`status` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mysql_database`.`comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mysql_database`.`comments` ;

CREATE  TABLE IF NOT EXISTS `mysql_database`.`comments` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `idexperto` CHAR(30) NULL ,
  `idsample` INT NULL ,
  `comentario` VARCHAR(1000) NULL ,
  `ts` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  `status` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
COMMENT = 'Tabla de los comentarios de las muestras';

-- -----------------------------------------------------
-- Table `mysql_database`.`ccu_lamina`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mysql_database`.`ccu_lamina` ;

CREATE  TABLE IF NOT EXISTS `mysql_database`.`ccu_lamina` (
  `lam` CHAR(20) NULL ,
  `diag` CHAR(50) NULL ,
  `expe` CHAR(25) NULL ,
  `soft` CHAR(25) NULL ,
  `lab` CHAR(30) NULL ,
  `ts` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`lam`) )
ENGINE = InnoDB
COMMENT = 'Tabla de los diagnosticos por lamina ccu';

-- -----------------------------------------------------
-- Table `mysql_database`.`calibration`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mysql_database`.`calibration` ;

CREATE  TABLE IF NOT EXISTS `mysql_database`.`calibration` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` CHAR(50) NULL ,
  `value` CHAR(45) NULL ,
  `status_id` INT NOT NULL ,
  `ts` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  `description` CHAR(45) NULL ,
  `imagename` CHAR(45) NULL ,
  `imagepath` CHAR(250) NULL ,
  `hide` int(1) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) ,
  
  INDEX `fk_calibration_status1` (`status_id` ASC) ,
  
  CONSTRAINT `fk_calibration_status1`
    FOREIGN KEY (`status_id` )
    REFERENCES `mysql_database`.`status` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mysql_database`.`calibration_status_log`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mysql_database`.`calibration_status_log` ;

CREATE  TABLE IF NOT EXISTS `mysql_database`.`calibration_status_log` (
  `id` INT NOT NULL ,
  `calibration_id` INT NOT NULL ,
  `status_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_calibration_status_log_calibration1` (`calibration_id` ASC) ,
  INDEX `fk_calibration_status_log_status1` (`status_id` ASC) ,
  CONSTRAINT `fk_calibration_status_log_calibration1`
    FOREIGN KEY (`calibration_id` )
    REFERENCES `mysql_database`.`calibration` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_calibration_status_log_status1`
    FOREIGN KEY (`status_id` )
    REFERENCES `mysql_database`.`status` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mysql_database`.`sample_status_log`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mysql_database`.`sample_status_log` ;

CREATE  TABLE IF NOT EXISTS `mysql_database`.`sample_status_log` (
  `id` INT NOT NULL ,
  `sample_id` INT NOT NULL ,
  `status_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sample_status_log_sample1` (`sample_id` ASC) ,
  INDEX `fk_sample_status_log_status1` (`status_id` ASC) ,
  CONSTRAINT `fk_sample_status_log_sample1`
    FOREIGN KEY (`sample_id` )
    REFERENCES `mysql_database`.`sample` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sample_status_log_status1`
    FOREIGN KEY (`status_id` )
    REFERENCES `mysql_database`.`status` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `mysql_database`.`user`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `mysql_database`;

INSERT INTO `mysql_database`.`user` (`username`, `password`, `nombres`, `apellidos`, `correo`, `telefono`, `ts`, `status`, `type`) VALUES ('adminuser', '123456', 'admin', 'user', '', '', CURRENT_TIMESTAMP, '1', '2');


COMMIT;

-- -----------------------------------------------------
-- Data for table `mysql_database`.`status`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `mysql_database`;
INSERT INTO `mysql_database`.`status` (`id`, `description`) VALUES ('1', 'on hold');
INSERT INTO `mysql_database`.`status` (`id`, `description`) VALUES ('2', 'processing');
INSERT INTO `mysql_database`.`status` (`id`, `description`) VALUES ('3', 'finish');
INSERT INTO `mysql_database`.`status` (`id`, `description`) VALUES ('4', 'error');

COMMIT;
