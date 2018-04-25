SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `dbciijus` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `dbciijus` ;

-- -----------------------------------------------------
-- Table `dbciijus`.`ciijus_administrador_rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbciijus`.`ciijus_administrador_rol` (
  `idciijus_administrador_rol` INT(11) NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(100) NULL,
  PRIMARY KEY (`idciijus_administrador_rol`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `dbciijus`.`ciijus_administrador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbciijus`.`ciijus_administrador` (
  `idciijus_administrador` INT(11) NOT NULL AUTO_INCREMENT,
  `idciijus_administrador_rol` INT(11) NOT NULL,
  `correo` VARCHAR(100) NULL,
  `usuario` VARCHAR(45) NULL,
  `passwd` VARCHAR(45) NULL,
  `avatar` VARCHAR(200) NULL,
  `nombre` VARCHAR(80) NULL,
  `apellidos` VARCHAR(80) NULL,
  `telefono` VARCHAR(45) NULL,
  `activo` INT(1) NULL DEFAULT 1,
  `root` INT(1) NULL DEFAULT 0,
  `creado` DATETIME NULL,
  PRIMARY KEY (`idciijus_administrador`),
  INDEX `fk_ciijus_administrador_ciijus_administrador_rol1_idx` (`idciijus_administrador_rol` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `dbciijus`.`ciijus_slider`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbciijus`.`ciijus_slider` (
  `idciijus_slider` INT(11) NOT NULL AUTO_INCREMENT,
  `idciijus_administrador` INT(11) NOT NULL,
  `portada` VARCHAR(200) NULL,
  `nombre` VARCHAR(100) NULL,
  `link` INT(1) NULL,
  `url` TEXT NULL,
  `creado` DATETIME NULL,
  PRIMARY KEY (`idciijus_slider`),
  INDEX `fk_ciijus_slider_ciijus_administrador1_idx` (`idciijus_administrador` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `dbciijus`.`ciijus_post_categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbciijus`.`ciijus_post_categoria` (
  `idciijus_post_categoria` INT(11) NOT NULL AUTO_INCREMENT,
  `idciijus_administrador` INT(11) NOT NULL,
  `titulo` VARCHAR(200) NULL,
  `descripcion` TEXT NULL,
  `creado` DATETIME NULL,
  PRIMARY KEY (`idciijus_post_categoria`),
  INDEX `fk_ciijus_post_categoria_ciijus_administrador1_idx` (`idciijus_administrador` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `dbciijus`.`ciijus_post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbciijus`.`ciijus_post` (
  `idciijus_post` INT(11) NOT NULL AUTO_INCREMENT,
  `idciijus_administrador` INT(11) NOT NULL,
  `idciijus_post_categoria` INT(11) NOT NULL,
  `portada` VARCHAR(200) NULL,
  `titulo` VARCHAR(200) NULL,
  `introduccion` VARCHAR(250) NULL,
  `descripcion` TEXT NULL,
  `status` INT(1) NULL,
  `autor` VARCHAR(80) NULL,
  `creado` DATETIME NULL,
  PRIMARY KEY (`idciijus_post`),
  INDEX `fk_ciijus_post_ciijus_post_categoria1_idx` (`idciijus_post_categoria` ASC),
  INDEX `fk_ciijus_post_ciijus_administrador1_idx` (`idciijus_administrador` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `dbciijus`.`ciijus_oferta_categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbciijus`.`ciijus_oferta_categoria` (
  `idciijus_oferta_categoria` INT(11) NOT NULL AUTO_INCREMENT,
  `idciijus_administrador` INT(11) NOT NULL,
  `portada` VARCHAR(200) NULL,
  `titulo` VARCHAR(200) NULL,
  `descripcion` TEXT NULL,
  `icono` VARCHAR(100) NULL,
  `creado` DATETIME NULL,
  PRIMARY KEY (`idciijus_oferta_categoria`),
  INDEX `fk_ciijus_post_categoria_ciijus_administrador1_idx` (`idciijus_administrador` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `dbciijus`.`ciijus_oferta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbciijus`.`ciijus_oferta` (
  `idciijus_oferta` INT(11) NOT NULL AUTO_INCREMENT,
  `idciijus_administrador` INT(11) NOT NULL,
  `idciijus_oferta_categoria` INT(11) NOT NULL,
  `portada` VARCHAR(200) NULL,
  `titulo` VARCHAR(200) NULL,
  `introduccion` VARCHAR(250) NULL,
  `descripcion` TEXT NULL,
  `ubicacion` TEXT NULL,
  `ponente` VARCHAR(200) NULL,
  `fechainicio` DATETIME NULL,
  `fechafin` DATETIME NULL,
  `activo` INT(1) NULL DEFAULT 1,
  `costo` DECIMAL(10,2) NULL,
  `descuento` INT(1) NULL,
  `costo_descuento` DECIMAL(10,2) NULL,
  `creado` DATETIME NULL,
  PRIMARY KEY (`idciijus_oferta`),
  INDEX `fk_ciijus_oferta_ciijus_oferta_categoria1_idx` (`idciijus_oferta_categoria` ASC),
  INDEX `fk_ciijus_oferta_ciijus_administrador1_idx` (`idciijus_administrador` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `dbciijus`.`ciijus_contacto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbciijus`.`ciijus_contacto` (
  `idciijus_contacto` INT(11) NOT NULL AUTO_INCREMENT,
  `idciijus_administrador` INT(11) NOT NULL,
  `nombre` VARCHAR(200) NULL,
  `correo` VARCHAR(200) NULL,
  `telefono` VARCHAR(45) NULL,
  `mensaje` TEXT NULL,
  `creado` DATETIME NULL,
  PRIMARY KEY (`idciijus_contacto`),
  INDEX `fk_ciijus_contacto_ciijus_administrador1_idx` (`idciijus_administrador` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `dbciijus`.`ciijus_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbciijus`.`ciijus_usuario` (
  `idciijus_usuario` INT(11) NOT NULL AUTO_INCREMENT,
  `avatar` VARCHAR(200) NULL,
  `username` VARCHAR(100) NULL,
  `token` VARCHAR(100) NULL,
  `email` VARCHAR(100) NULL,
  `name` VARCHAR(60) NULL,
  `lastname` VARCHAR(60) NULL,
  `phone` VARCHAR(45) NULL,
  `address` VARCHAR(255) NULL,
  `procedence` TEXT NULL,
  `email_validation` INT(1) NULL,
  `active` INT(1) NULL,
  `created` DATETIME NULL,
  PRIMARY KEY (`idciijus_usuario`))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `dbciijus`.`ciijus_versiones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbciijus`.`ciijus_versiones` (
  `idciijus_versiones` INT(11) NOT NULL,
  `idciijus_administrador` INT(11) NOT NULL,
  `version` VARCHAR(100) NULL,
  `introduccion` VARCHAR(200) NULL,
  `descripcion` TEXT NULL,
  `fecha` DATETIME NULL,
  `creado` DATETIME NULL,
  PRIMARY KEY (`idciijus_versiones`),
  INDEX `fk_ciijus_versiones_ciijus_administrador1_idx` (`idciijus_administrador` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `dbciijus`.`ciijus_usuario_has_order`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbciijus`.`ciijus_usuario_has_order` (
  `idciijus_usuario` INT(11) NOT NULL,
  `orderid` VARCHAR(100) NULL,
  `idciijus_item` INT(11) NULL,
  `item_type` VARCHAR(45) NULL,
  `fecha` DATETIME NULL,
  `pagado` INT(1) NULL,
  `creado` DATETIME NULL,
  PRIMARY KEY (`idciijus_usuario`),
  INDEX `fk_ciijus_usuario_has_order_ciijus_usuario1_idx` (`idciijus_usuario` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `dbciijus`.`ciijus_acerca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbciijus`.`ciijus_acerca` (
  `idciijus_acerca` INT(11) NOT NULL AUTO_INCREMENT,
  `idciijus_administrador` INT(11) NOT NULL,
  `portada` VARCHAR(200) NULL,
  `titulo` VARCHAR(200) NULL,
  `descripcion` TEXT NULL,
  `creado` DATETIME NULL,
  PRIMARY KEY (`idciijus_acerca`),
  INDEX `fk_ciijus_acerca_ciijus_administrador1_idx` (`idciijus_administrador` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `dbciijus`.`ciijus_libro_categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbciijus`.`ciijus_libro_categoria` (
  `idciijus_libro_categoria` INT(11) NOT NULL AUTO_INCREMENT,
  `idciijus_administrador` INT(11) NOT NULL,
  `titulo` VARCHAR(200) NULL,
  `descripcion` TEXT NULL,
  `creado` DATETIME NULL,
  PRIMARY KEY (`idciijus_libro_categoria`),
  INDEX `fk_ciijus_libro_categoria_ciijus_administrador1_idx` (`idciijus_administrador` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `dbciijus`.`ciijus_libro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbciijus`.`ciijus_libro` (
  `idciijus_libro` INT(11) NOT NULL AUTO_INCREMENT,
  `idciijus_administrador` INT(11) NOT NULL,
  `idciijus_libro_categoria` INT(11) NOT NULL,
  `portada` VARCHAR(200) NULL,
  `nombre` VARCHAR(200) NULL,
  `autor` VARCHAR(200) NULL,
  `costo` DECIMAL(10,2) NULL,
  `cantidad` INT(11) NULL,
  `descuento` INT(1) NULL,
  `costo_descuento` DECIMAL(10,2) NULL,
  `activo` INT(1) NULL,
  `creado` DATETIME NULL,
  PRIMARY KEY (`idciijus_libro`),
  INDEX `fk_ciijus_libro_ciijus_libro_categoria1_idx` (`idciijus_libro_categoria` ASC),
  INDEX `fk_ciijus_libro_ciijus_administrador1_idx` (`idciijus_administrador` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `dbciijus`.`ciijus_pago`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbciijus`.`ciijus_pago` (
  `idciijus_pago` INT(11) NOT NULL AUTO_INCREMENT,
  `idciijus_usuario` INT(11) NOT NULL,
  `orderid` VARCHAR(45) NULL,
  `subtotal` DECIMAL(10,2) NULL,
  `forma_pago` INT(1) NULL,
  `iva` FLOAT NULL,
  `total` DECIMAL(10,2) NULL,
  `creado` DATETIME NULL,
  PRIMARY KEY (`idciijus_pago`),
  INDEX `fk_ciijus_pago_ciijus_usuario1_idx` (`idciijus_usuario` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `dbciijus`.`ciijus_director`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbciijus`.`ciijus_director` (
  `idciijus_director` INT(11) NOT NULL AUTO_INCREMENT,
  `idciijus_administrador` INT(11) NOT NULL,
  `portada` VARCHAR(200) NULL,
  `titulo` VARCHAR(200) NULL,
  `descripcion` TEXT NULL,
  `creado` DATETIME NULL,
  PRIMARY KEY (`idciijus_director`),
  INDEX `fk_ciijus_director_ciijus_administrador1_idx` (`idciijus_administrador` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `dbciijus`.`ciijus_miembro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbciijus`.`ciijus_miembro` (
  `idciijus_miembro` INT(11) NOT NULL AUTO_INCREMENT,
  `idciijus_administrador` INT(11) NOT NULL,
  `portada` VARCHAR(200) NULL,
  `nombre` VARCHAR(200) NULL,
  `puesto` VARCHAR(200) NULL,
  `origen` VARCHAR(100) NULL,
  `creado` DATETIME NULL,
  PRIMARY KEY (`idciijus_miembro`),
  INDEX `fk_ciijus_miembro_ciijus_administrador1_idx` (`idciijus_administrador` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `dbciijus`.`ciijus_acuerdo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbciijus`.`ciijus_acuerdo` (
  `idciijus_acuerdo` INT(11) NOT NULL AUTO_INCREMENT,
  `idciijus_administrador` INT(11) NOT NULL,
  `portada` VARCHAR(200) NULL,
  `titulo` VARCHAR(200) NULL,
  `url` VARCHAR(200) NULL,
  `creado` DATETIME NULL,
  PRIMARY KEY (`idciijus_acuerdo`),
  INDEX `fk_ciijus_acuerdo_ciijus_administrador1_idx` (`idciijus_administrador` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `dbciijus`.`ciijus_clinica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbciijus`.`ciijus_clinica` (
  `idciijus_clinica` INT(11) NOT NULL AUTO_INCREMENT,
  `idciijus_administrador` INT(11) NOT NULL,
  `titulo` VARCHAR(200) NULL,
  `portada` VARCHAR(200) NULL COMMENT '	',
  `perfil` VARCHAR(200) NULL,
  `descripcion` TEXT NULL,
  `creado` DATETIME NULL,
  PRIMARY KEY (`idciijus_clinica`),
  INDEX `fk_ciijus_clinica_ciijus_administrador1_idx` (`idciijus_administrador` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `dbciijus`.`ciijus_coloquium`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbciijus`.`ciijus_coloquium` (
  `idciijus_coloquium` INT(11) NOT NULL AUTO_INCREMENT,
  `idciijus_administrador` INT(11) NOT NULL,
  `portada` VARCHAR(200) NULL,
  `nombre` VARCHAR(200) NULL,
  `codigo` TEXT NULL,
  `creado` DATETIME NULL,
  PRIMARY KEY (`idciijus_coloquium`),
  INDEX `fk_ciijus_coloquium_ciijus_administrador1_idx` (`idciijus_administrador` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
