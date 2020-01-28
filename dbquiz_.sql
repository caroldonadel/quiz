-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema quiz
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema quiz
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `quiz` DEFAULT CHARACTER SET utf8 ;
USE `quiz` ;

-- -----------------------------------------------------
-- Table `quiz`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quiz`.`usuarios` (
  `idusuarios` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `nivel` VARCHAR(5) NOT NULL,
  PRIMARY KEY (`idusuarios`),
        unique (email))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `quiz`.`quizzes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quiz`.`quizzes` (
  `idquizzes` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(250) NOT NULL,
  `idusuarios` INT NOT NULL,
  PRIMARY KEY (`idquizzes`),
  INDEX `fk_quizzes_usuarios_idx` (`idusuarios` ASC) ,
  CONSTRAINT `fk_quizzes_usuarios`
    FOREIGN KEY (`idusuarios`)
    REFERENCES `quiz`.`usuarios` (`idusuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `quiz`.`perguntas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quiz`.`perguntas` (
  `idperguntas` INT NOT NULL AUTO_INCREMENT,
  `titulo` TEXT NOT NULL,
  `idquizzes` INT NOT NULL,
  PRIMARY KEY (`idperguntas`),
  INDEX `fk_perguntas_quizzes1_idx` (`idquizzes` ASC) ,
  CONSTRAINT `fk_perguntas_quizzes1`
    FOREIGN KEY (`idquizzes`)
    REFERENCES `quiz`.`quizzes` (`idquizzes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `quiz`.`alternativas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quiz`.`alternativas` (
  `idalternativas` INT NOT NULL AUTO_INCREMENT,
  `descricao` TEXT NOT NULL,
  `idperguntas` INT NOT NULL,
  `correta` TINYINT NOT NULL,
  PRIMARY KEY (`idalternativas`),
  INDEX `fk_alternativas_perguntas1_idx` (`idperguntas` ASC) ,
  CONSTRAINT `fk_alternativas_perguntas1`
    FOREIGN KEY (`idperguntas`)
    REFERENCES `quiz`.`perguntas` (`idperguntas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `quiz`.`respostas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quiz`.`respostas` (
  `idrespostas` INT NOT NULL AUTO_INCREMENT,
  `idusuarios` INT NOT NULL,
  `idalternativas` INT NOT NULL,
  `dataresposta` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idrespostas`),
  INDEX `fk_respostas_usuarios1_idx` (`idusuarios` ASC) ,
  INDEX `fk_respostas_alternativas1_idx` (`idalternativas` ASC) ,
  CONSTRAINT `fk_respostas_usuarios1`
    FOREIGN KEY (`idusuarios`)
    REFERENCES `quiz`.`usuarios` (`idusuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_respostas_alternativas1`
    FOREIGN KEY (`idalternativas`)
    REFERENCES `quiz`.`alternativas` (`idalternativas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
