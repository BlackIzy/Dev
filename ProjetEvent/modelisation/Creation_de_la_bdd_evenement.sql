-- MySQL Script generated by MySQL Workbench
-- Mon Oct 11 17:01:37 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema zal3-zberteab0
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema zal3-zberteab0
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `zal3-zberteab0` DEFAULT CHARACTER SET utf8 ;
USE `zal3-zberteab0` ;



-- -----------------------------------------------------
-- Table `zal3-zberteab0`.`t_compte_cpt`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zal3-zberteab0`.`t_compte_cpt` (
  `cpt_login` VARCHAR(20) NOT NULL,
  `cpt_mdp` CHAR(64) NULL,
  `cpt_etat` CHAR(1) NULL,
  PRIMARY KEY (`cpt_login`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `zal3-zberteab0`.`t_organisateur_org`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zal3-zberteab0`.`t_organisateur_org` (
  `org_id` INT NOT NULL,
  `org_nom` VARCHAR(60) NULL,
  `org_prenom` VARCHAR(60) NULL,
  `org_email` VARCHAR(100) NULL,
  `cpt_login` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`org_id`),
  INDEX `fk_Organisateur_Compte_idx` (`cpt_login` ASC) ,
  UNIQUE INDEX `Compte_login_UNIQUE` (`cpt_login` ASC) ,
  CONSTRAINT `fk_Organisateur_Compte`
    FOREIGN KEY (`cpt_login`)
    REFERENCES `zal3-zberteab0`.`t_compte_cpt` (`cpt_login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `zal3-zberteab0`.`t_invite_inv`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zal3-zberteab0`.`t_invite_inv` (
  `inv_id` INT NOT NULL AUTO_INCREMENT,
  `inv_nom` VARCHAR(60) NULL,
  `inv_discipline` VARCHAR(60) NULL,
  `inv_presentation` VARCHAR(200) NULL,
  `inv_biographie` VARCHAR(300) NULL,
  `inv_photo` VARCHAR(200) NULL,
  `cpt_login` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`inv_id`),
  INDEX `fk_Invite_Compte1_idx` (`cpt_login` ASC) ,
  UNIQUE INDEX `Compte_login_UNIQUE` (`cpt_login` ASC) ,
  CONSTRAINT `fk_Invite_Compte1`
    FOREIGN KEY (`cpt_login`)
    REFERENCES `zal3-zberteab0`.`t_compte_cpt` (`cpt_login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `zal3-zberteab0`.`t_reseau_social_rsl`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zal3-zberteab0`.`t_reseau_social_rsl` (
  `rsl_id` INT NOT NULL AUTO_INCREMENT,
  `rsl_nom` VARCHAR(60) NULL,
  `rsl_url` VARCHAR(200) NULL,
  PRIMARY KEY (`rsl_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `zal3-zberteab0`.`t_lieu_lie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zal3-zberteab0`.`t_lieu_lie` (
  `lie_id` INT NOT NULL AUTO_INCREMENT,
  `lie_nom` VARCHAR(60) NULL,
  `lie_entree` CHAR(1) NULL,
  PRIMARY KEY (`lie_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `zal3-zberteab0`.`t_animation_ani`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zal3-zberteab0`.`t_animation_ani` (
  `ani_id` INT NOT NULL AUTO_INCREMENT,
  `ani_intitule` VARCHAR(60) NULL,
  `ani_date_debut` DATETIME NULL,
  `ani_date_fin` DATETIME NULL,
  `lie_id` INT NOT NULL,
  PRIMARY KEY (`ani_id`),
  INDEX `fk_Animation_Lieu1_idx` (`lie_id` ASC) ,
  CONSTRAINT `fk_Animation_Lieu1`
    FOREIGN KEY (`lie_id`)
    REFERENCES `zal3-zberteab0`.`t_lieu_lie` (`lie_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `zal3-zberteab0`.`t_service_ser`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zal3-zberteab0`.`t_service_ser` (
  `ser_id` INT NOT NULL AUTO_INCREMENT,
  `ser_nom` VARCHAR(60) NULL,
  `ser_descriptif` VARCHAR(120) NULL,
  `lie_id` INT NOT NULL,
  PRIMARY KEY (`ser_id`),
  INDEX `fk_Service_Lieu1_idx` (`lie_id` ASC) ,
  CONSTRAINT `fk_Service_Lieu1`
    FOREIGN KEY (`lie_id`)
    REFERENCES `zal3-zberteab0`.`t_lieu_lie` (`lie_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `zal3-zberteab0`.`t_participant_par`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zal3-zberteab0`.`t_participant_par` (
  `par_id` INT NULL,
  `par_chainecar` VARCHAR(60) NULL,
  `par_typepass` VARCHAR(60) NULL,
  `par_nom` VARCHAR(60) NULL,
  `par_prenom` VARCHAR(60) NULL,
  `par_email` VARCHAR(100) NULL,
  `par_tel` VARCHAR(200) NULL,
  PRIMARY KEY (`par_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `zal3-zberteab0`.`t_objet_trouve_obt`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zal3-zberteab0`.`t_objet_trouve_obt` (
  `obt_id` INT NULL AUTO_INCREMENT,
  `obt_nom` VARCHAR(60) NULL,
  `obt_descriptif` VARCHAR(200) NULL,
  `lie_id` INT NOT NULL,
  `par_id` INT NULL,
  PRIMARY KEY (`obt_id`),
  INDEX `fk_Objet Trouve_Lieu1_idx` (`lie_id` ASC) ,
  INDEX `fk_Objet Trouve_Participant1_idx` (`par_id` ASC) ,
  CONSTRAINT `fk_Objet Trouve_Lieu1`
    FOREIGN KEY (`lie_id`)
    REFERENCES `zal3-zberteab0`.`t_lieu_lie` (`lie_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Objet Trouve_Participant1`
    FOREIGN KEY (`par_id`)
    REFERENCES `zal3-zberteab0`.`t_participant_par` (`par_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `zal3-zberteab0`.`tj_inv_rsl`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zal3-zberteab0`.`tj_inv_rsl` (
  `inv_id` INT NOT NULL,
  `rsl_id` INT NOT NULL,
  PRIMARY KEY (`inv_id`, `rsl_id`),
  INDEX `fk_Invite_has_Reseau Social_Reseau Social1_idx` (`rsl_id` ASC) ,
  INDEX `fk_Invite_has_Reseau Social_Invite1_idx` (`inv_id` ASC) ,
  CONSTRAINT `fk_Invite_has_Reseau Social_Invite1`
    FOREIGN KEY (`inv_id`)
    REFERENCES `zal3-zberteab0`.`t_invite_inv` (`inv_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Invite_has_Reseau Social_Reseau Social1`
    FOREIGN KEY (`rsl_id`)
    REFERENCES `zal3-zberteab0`.`t_reseau_social_rsl` (`rsl_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `zal3-zberteab0`.`tj_inv_ani`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zal3-zberteab0`.`tj_inv_ani` (
  `inv_id` INT NOT NULL,
  `ani_id` INT NOT NULL,
  PRIMARY KEY (`inv_id`, `ani_id`),
  INDEX `fk_Invite_has_Animation_Animation1_idx` (`ani_id` ASC) ,
  INDEX `fk_Invite_has_Animation_Invite1_idx` (`inv_id` ASC) ,
  CONSTRAINT `fk_Invite_has_Animation_Invite1`
    FOREIGN KEY (`inv_id`)
    REFERENCES `zal3-zberteab0`.`t_invite_inv` (`inv_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Invite_has_Animation_Animation1`
    FOREIGN KEY (`ani_id`)
    REFERENCES `zal3-zberteab0`.`t_animation_ani` (`ani_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `zal3-zberteab0`.`t_passeport_pas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zal3-zberteab0`.`t_passeport_pas` (
  `pas_id` INT NOT NULL AUTO_INCREMENT,
  `pass_id` VARCHAR(20) NULL,
  `pas_mdp` VARCHAR(64) NULL,
  `inv_id` INT NOT NULL,
  INDEX `fk_Passeport_Invite1_idx` (`inv_id` ASC) ,
  PRIMARY KEY (`pas_id`),
  CONSTRAINT `fk_Passeport_Invite1`
    FOREIGN KEY (`inv_id`)
    REFERENCES `zal3-zberteab0`.`t_invite_inv` (`inv_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `zal3-zberteab0`.`t_post_pst`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zal3-zberteab0`.`t_post_pst` (
  `pst_id` INT NOT NULL AUTO_INCREMENT,
  `pst_mssg` VARCHAR(140) NULL,
  `pas_id` INT NOT NULL,
  PRIMARY KEY (`pst_id`),
  INDEX `fk_t_post_pst_t_passeport_pas1_idx` (`pas_id` ASC) ,
  CONSTRAINT `fk_t_post_pst_t_passeport_pas1`
    FOREIGN KEY (`pas_id`)
    REFERENCES `zal3-zberteab0`.`t_passeport_pas` (`pas_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `zal3-zberteab0`.`t_actualite_act`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zal3-zberteab0`.`t_actualite_act` (
  `act_id` INT NOT NULL AUTO_INCREMENT,
  `act_intitule` VARCHAR(60) NULL,
  `act_texte` VARCHAR(300) NULL,
  `acte_date_de_pub` DATETIME NULL,
  `act_etat` VARCHAR(1) NULL,
  `org_id` INT NOT NULL,
  PRIMARY KEY (`act_id`),
  INDEX `fk_Actualite_Organisateur1_idx` (`org_id` ASC) ,
  CONSTRAINT `fk_Actualite_Organisateur1`
    FOREIGN KEY (`org_id`)
    REFERENCES `zal3-zberteab0`.`t_organisateur_org` (`org_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `zal3-zberteab0` ;

-- -----------------------------------------------------
-- Placeholder table for view `zal3-zberteab0`.`view1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zal3-zberteab0`.`view1` (`id` INT);

-- -----------------------------------------------------
--  routine1
-- -----------------------------------------------------

DELIMITER $$
USE `zal3-zberteab0`$$
$$

DELIMITER ;

-- -----------------------------------------------------
-- View `zal3-zberteab0`.`view1`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `zal3-zberteab0`.`view1`;
USE `zal3-zberteab0`;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;