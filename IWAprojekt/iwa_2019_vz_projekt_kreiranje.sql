-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema iwa_2019_vz_projekt
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema iwa_2019_vz_projekt
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `iwa_2019_vz_projekt` DEFAULT CHARACTER SET utf8 ;
USE `iwa_2019_vz_projekt` ;

-- -----------------------------------------------------
-- Table `iwa_2019_vz_projekt`.`tip_korisnika`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2019_vz_projekt`.`tip_korisnika` (
  `tip_korisnika_id` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`tip_korisnika_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iwa_2019_vz_projekt`.`korisnik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2019_vz_projekt`.`korisnik` (
  `korisnik_id` INT NOT NULL AUTO_INCREMENT,
  `tip_korisnika_id` INT NOT NULL,
  `korisnicko_ime` VARCHAR(50) NOT NULL,
  `lozinka` VARCHAR(50) NOT NULL,
  `ime` VARCHAR(50) NOT NULL,
  `prezime` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `slika` TEXT NOT NULL,
  PRIMARY KEY (`korisnik_id`),
  INDEX `fk_korisnik_tip_korisnika_idx` (`tip_korisnika_id` ASC),
  CONSTRAINT `fk_korisnik_tip_korisnika`
    FOREIGN KEY (`tip_korisnika_id`)
    REFERENCES `iwa_2019_vz_projekt`.`tip_korisnika` (`tip_korisnika_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iwa_2019_vz_projekt`.`valuta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2019_vz_projekt`.`valuta` (
  `valuta_id` INT NOT NULL AUTO_INCREMENT,
  `moderator_id` INT NOT NULL,
  `naziv` VARCHAR(50) NOT NULL,
  `tecaj` DOUBLE NOT NULL,
  `slika` TEXT NOT NULL,
  `zvuk` TEXT NULL COMMENT '	',
  `aktivno_od` TIME NULL,
  `aktivno_do` TIME NULL,
  `datum_azuriranja` DATE NULL,
  PRIMARY KEY (`valuta_id`),
  INDEX `fk_liga_korisnik1_idx` (`moderator_id` ASC),
  CONSTRAINT `fk_liga_korisnik1`
    FOREIGN KEY (`moderator_id`)
    REFERENCES `iwa_2019_vz_projekt`.`korisnik` (`korisnik_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'liga_id';


-- -----------------------------------------------------
-- Table `iwa_2019_vz_projekt`.`sredstva`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2019_vz_projekt`.`sredstva` (
  `sredstva_id` INT NOT NULL AUTO_INCREMENT,
  `korisnik_id` INT NOT NULL,
  `valuta_id` INT NOT NULL,
  `iznos` DOUBLE NOT NULL,
  INDEX `fk_korisnik_has_utakmica_korisnik1_idx` (`korisnik_id` ASC),
  PRIMARY KEY (`sredstva_id`),
  INDEX `fk_sredstva_valuta1_idx` (`valuta_id` ASC),
  CONSTRAINT `fk_korisnik_has_utakmica_korisnik1`
    FOREIGN KEY (`korisnik_id`)
    REFERENCES `iwa_2019_vz_projekt`.`korisnik` (`korisnik_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sredstva_valuta1`
    FOREIGN KEY (`valuta_id`)
    REFERENCES `iwa_2019_vz_projekt`.`valuta` (`valuta_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iwa_2019_vz_projekt`.`zahtjev`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2019_vz_projekt`.`zahtjev` (
  `zahtjev_id` INT NOT NULL AUTO_INCREMENT,
  `korisnik_id` INT NOT NULL,
  `iznos` DECIMAL NOT NULL,
  `prodajem_valuta_id` INT NOT NULL,
  `kupujem_valuta_id` INT NOT NULL,
  `datum_vrijeme_kreiranja` DATETIME NOT NULL,
  `prihvacen` TINYINT(1) NOT NULL,
  PRIMARY KEY (`zahtjev_id`),
  INDEX `fk_zahtjev_valuta1_idx` (`prodajem_valuta_id` ASC),
  INDEX `fk_zahtjev_valuta2_idx` (`kupujem_valuta_id` ASC),
  INDEX `fk_zahtjev_korisnik1_idx` (`korisnik_id` ASC),
  CONSTRAINT `fk_zahtjev_valuta1`
    FOREIGN KEY (`prodajem_valuta_id`)
    REFERENCES `iwa_2019_vz_projekt`.`valuta` (`valuta_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_zahtjev_valuta2`
    FOREIGN KEY (`kupujem_valuta_id`)
    REFERENCES `iwa_2019_vz_projekt`.`valuta` (`valuta_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_zahtjev_korisnik1`
    FOREIGN KEY (`korisnik_id`)
    REFERENCES `iwa_2019_vz_projekt`.`korisnik` (`korisnik_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'korisnik_korisnik_id';

CREATE USER 'iwa_2019'@'localhost' IDENTIFIED BY 'foi2019';

GRANT SELECT, INSERT, TRIGGER, UPDATE, DELETE ON TABLE `iwa_2019_vz_projekt`.* TO 'iwa_2019'@'localhost';

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
