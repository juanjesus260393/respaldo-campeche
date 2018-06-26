-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema campeche
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `campeche` ;

-- -----------------------------------------------------
-- Schema campeche
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `campeche` DEFAULT CHARACTER SET utf8 ;
USE `campeche` ;

-- -----------------------------------------------------
-- Table `sector`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sector` ;

CREATE TABLE IF NOT EXISTS `sector` (
  `id_sector` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(200) NULL,
  PRIMARY KEY (`id_sector`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `plan`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `plan` ;

CREATE TABLE IF NOT EXISTS `plan` (
  `id_plan` INT NOT NULL,
  `descripcion` VARCHAR(45) NULL,
  `nombre` VARCHAR(45) NULL,
  `costo` VARCHAR(45) NULL,
  PRIMARY KEY (`id_plan`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empresa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empresa` ;

CREATE TABLE IF NOT EXISTS `empresa` (
  `id_empresa` INT NOT NULL AUTO_INCREMENT,
  `id_plan` INT NOT NULL,
  `id_sector` INT NOT NULL,
  `descripcion` VARCHAR(500) NOT NULL,
  `telefono1` VARCHAR(15) NOT NULL,
  `telefono2` VARCHAR(15) NULL,
  `direccion` VARCHAR(200) NULL,
  `nombre` VARCHAR(200) NULL,
  `numero_empleados` INT NULL,
  `propietario` VARCHAR(250) NULL,
  `tamano` VARCHAR(100) NULL,
  PRIMARY KEY (`id_empresa`),
  INDEX `fk_empresa_sector_idx` (`id_sector` ASC),
  INDEX `fk_empresa_plan1_idx` (`id_plan` ASC),
  CONSTRAINT `fk_empresa_sector1`
    FOREIGN KEY (`id_sector`)
    REFERENCES `sector` (`id_sector`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresa_plan1`
    FOREIGN KEY (`id_plan`)
    REFERENCES `plan` (`id_plan`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `revision_objeto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `revision_objeto` ;

CREATE TABLE IF NOT EXISTS `revision_objeto` (
  `id_revision_objeto` INT NOT NULL AUTO_INCREMENT,
  `id_empresa` INT NOT NULL,
  `fecha_creacion` DATETIME NULL,
  `fecha_actualizacion` DATETIME NULL,
  `status` CHAR(1) NULL,
  PRIMARY KEY (`id_revision_objeto`),
  INDEX `fk_empresa_has_revision_empresa1_idx` (`id_empresa` ASC),
  CONSTRAINT `fk_empresa_has_revision_empresa1`
    FOREIGN KEY (`id_empresa`)
    REFERENCES `empresa` (`id_empresa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cupon`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cupon` ;

CREATE TABLE IF NOT EXISTS `cupon` (
  `id_cupon` INT NOT NULL,
  `titulo` VARCHAR(50) NOT NULL,
  `descripcion` VARCHAR(200) NOT NULL,
  `ruta_imagen` VARCHAR(250) NULL,
  `vigencia` DATETIME NOT NULL,
  `revision_objeto_id_revision_objeto` INT NOT NULL,
  PRIMARY KEY (`id_cupon`, `revision_objeto_id_revision_objeto`),
  INDEX `fk_cupon_revision_objeto1_idx` (`revision_objeto_id_revision_objeto` ASC),
  CONSTRAINT `fk_cupon_revision_objeto1`
    FOREIGN KEY (`revision_objeto_id_revision_objeto`)
    REFERENCES `revision_objeto` (`id_revision_objeto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users` ;

CREATE TABLE IF NOT EXISTS `users` (
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `enabled` TINYINT(1) NULL,
  PRIMARY KEY (`username`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pais`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pais` ;

CREATE TABLE IF NOT EXISTS `pais` (
  `id_pais` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_pais`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `turista`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `turista` ;

CREATE TABLE IF NOT EXISTS `turista` (
  `username` VARCHAR(100) NOT NULL,
  `id_pais` INT NULL,
  `nombre` VARCHAR(200) NULL,
  `ciudad_procedencia` VARCHAR(50) NULL,
  `primera_visita` TINYINT(1) NULL,
  `dias_en_el_estado` INT NULL,
  PRIMARY KEY (`username`),
  INDEX `fk_turista_usuario1_idx` (`username` ASC),
  INDEX `fk_turista_1_idx` (`id_pais` ASC),
  CONSTRAINT `fk_turista_usuario1`
    FOREIGN KEY (`username`)
    REFERENCES `users` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_turista_1`
    FOREIGN KEY (`id_pais`)
    REFERENCES `pais` (`id_pais`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `codigo_qr`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `codigo_qr` ;

CREATE TABLE IF NOT EXISTS `codigo_qr` (
  `id_codigo_qr` INT NOT NULL,
  `id_cupon` INT NOT NULL,
  `turista_username` VARCHAR(100) NOT NULL,
  `canjeado` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_codigo_qr`, `id_cupon`),
  INDEX `fk_codigo_qr_cupon_idx` (`id_cupon` ASC),
  INDEX `fk_codigo_qr_turista1_idx` (`turista_username` ASC),
  CONSTRAINT `fk_codigo_qr_cupon`
    FOREIGN KEY (`id_cupon`)
    REFERENCES `cupon` (`id_cupon`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_codigo_qr_turista1`
    FOREIGN KEY (`turista_username`)
    REFERENCES `turista` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `video`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `video` ;

CREATE TABLE IF NOT EXISTS `video` (
  `id_video` INT NOT NULL,
  `id_revision_objeto` INT NOT NULL,
  `titulo` VARCHAR(100) NULL,
  `descripcion` VARCHAR(500) NULL,
  `precio` DOUBLE NOT NULL,
  `fecha_subida` DATETIME NOT NULL,
  `ruta_img_preview` VARCHAR(500) NOT NULL,
  `ruta_video` VARCHAR(500) NOT NULL,
  `status` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id_video`),
  INDEX `fk_video_revision_objeto1_idx` (`id_revision_objeto` ASC),
  CONSTRAINT `fk_video_revision_objeto1`
    FOREIGN KEY (`id_revision_objeto`)
    REFERENCES `revision_objeto` (`id_revision_objeto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `authorities`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `authorities` ;

CREATE TABLE IF NOT EXISTS `authorities` (
  `username` VARCHAR(50) NOT NULL,
  `authority` VARCHAR(50) NULL,
  PRIMARY KEY (`username`),
  CONSTRAINT `fk_authorities_1`
    FOREIGN KEY (`username`)
    REFERENCES `users` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `usuario_empresa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usuario_empresa` ;

CREATE TABLE IF NOT EXISTS `usuario_empresa` (
  `id_empresa` INT NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_empresa`, `username`),
  INDEX `fk_usuario_empresa_usuario_idx` (`username` ASC),
  INDEX `fk_usuario_empresa_empresa_idx` (`id_empresa` ASC),
  CONSTRAINT `fk_empresa_has_usuario_empresa1`
    FOREIGN KEY (`id_empresa`)
    REFERENCES `empresa` (`id_empresa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresa_has_usuario_usuario1`
    FOREIGN KEY (`username`)
    REFERENCES `users` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tema_interes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tema_interes` ;

CREATE TABLE IF NOT EXISTS `tema_interes` (
  `id_tema_interes` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NULL,
  PRIMARY KEY (`id_tema_interes`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tema_interes_turista`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tema_interes_turista` ;

CREATE TABLE IF NOT EXISTS `tema_interes_turista` (
  `id_tema_interes` INT NOT NULL,
  `turista_username` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_tema_interes`, `turista_username`),
  INDEX `fk_tema_interes_turista_tema_interes_idx` (`id_tema_interes` ASC),
  INDEX `fk_tema_interes_turista_turista1_idx` (`turista_username` ASC),
  CONSTRAINT `fk_turista_has_tema_interes_tema_interes1`
    FOREIGN KEY (`id_tema_interes`)
    REFERENCES `tema_interes` (`id_tema_interes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tema_interes_turista_turista1`
    FOREIGN KEY (`turista_username`)
    REFERENCES `turista` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rango_ventas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rango_ventas` ;

CREATE TABLE IF NOT EXISTS `rango_ventas` (
  `id_rango_ventas` INT NOT NULL AUTO_INCREMENT,
  `id_empresa` INT NOT NULL,
  `descripcion` VARCHAR(50) NULL,
  PRIMARY KEY (`id_rango_ventas`, `id_empresa`),
  INDEX `fk_rango_ventas_empresa1_idx` (`id_empresa` ASC),
  CONSTRAINT `fk_rango_ventas_empresa1`
    FOREIGN KEY (`id_empresa`)
    REFERENCES `empresa` (`id_empresa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `video_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `video_usuario` ;

CREATE TABLE IF NOT EXISTS `video_usuario` (
  `id_video` INT NOT NULL,
  `usuario` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`id_video`, `usuario`),
  INDEX `fk_video_usuario_idx` (`usuario` ASC),
  INDEX `fk_video_usuario_id1` (`id_video` ASC),
  CONSTRAINT `fk_video_has_usuario_video1`
    FOREIGN KEY (`id_video`)
    REFERENCES `video` (`id_video`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_video_has_usuario_usuario1`
    FOREIGN KEY (`usuario`)
    REFERENCES `users` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `municipios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `municipios` ;

CREATE TABLE IF NOT EXISTS `municipios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sitio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sitio` ;

CREATE TABLE IF NOT EXISTS `sitio` (
  `id_sitio` INT NOT NULL AUTO_INCREMENT,
  `id_empresa` INT NOT NULL,
  `municipios_id` INT NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion_larga` VARCHAR(500) NOT NULL,
  `descripcion_corta` VARCHAR(100) NOT NULL,
  `direccion` VARCHAR(200) NULL,
  `telefono1` VARCHAR(15) NULL,
  `telefono2` VARCHAR(15) NULL,
  `capacidad` INT NULL,
  PRIMARY KEY (`id_sitio`),
  INDEX `fk_establecimiento_empresa1_idx` (`id_empresa` ASC),
  INDEX `fk_establecimiento_municipios1_idx` (`municipios_id` ASC),
  CONSTRAINT `fk_establecimiento_empresa1`
    FOREIGN KEY (`id_empresa`)
    REFERENCES `empresa` (`id_empresa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_establecimiento_municipios1`
    FOREIGN KEY (`municipios_id`)
    REFERENCES `municipios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comentario_rechazo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comentario_rechazo` ;

CREATE TABLE IF NOT EXISTS `comentario_rechazo` (
  `id_comentario_rechazo` INT NOT NULL AUTO_INCREMENT,
  `id_informacion_sitio` INT NOT NULL,
  `comentario` VARCHAR(500) NULL,
  `fecha_publicacion` DATETIME NULL,
  PRIMARY KEY (`id_comentario_rechazo`),
  INDEX `fk_comentario_rechazo_informacion_sitio1_idx` (`id_informacion_sitio` ASC),
  CONSTRAINT `fk_comentario_rechazo_informacion_sitio1`
    FOREIGN KEY (`id_informacion_sitio`)
    REFERENCES `revision_informacion` (`id_revision_informacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vacante`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `vacante` ;

CREATE TABLE IF NOT EXISTS `vacante` (
  `id_vacante` INT NOT NULL,
  `id_revision_objeto` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `salario` VARCHAR(45) NULL,
  `horario` VARCHAR(45) NULL,
  `escolaridad` VARCHAR(45) NULL,
  `habilidades` VARCHAR(45) NULL,
  `descripcion` VARCHAR(45) NULL,
  `temporal` TINYINT(1) NULL,
  `tiempo` VARCHAR(45) NULL,
  PRIMARY KEY (`id_vacante`),
  INDEX `fk_vacante_revision_objeto1_idx` (`id_revision_objeto` ASC),
  CONSTRAINT `fk_vacante_revision_objeto1`
    FOREIGN KEY (`id_revision_objeto`)
    REFERENCES `revision_objeto` (`id_revision_objeto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `evento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `evento` ;

CREATE TABLE IF NOT EXISTS `evento` (
  `id_evento` INT NOT NULL AUTO_INCREMENT,
  `id_sitio` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `fecha` VARCHAR(45) NULL,
  `hora` VARCHAR(45) NULL,
  `lugar` VARCHAR(45) NULL,
  `costo` VARCHAR(45) NULL,
  `beneficiario` VARCHAR(45) NULL,
  PRIMARY KEY (`id_evento`, `id_sitio`),
  INDEX `fk_evento_establecimiento1_idx` (`id_sitio` ASC),
  CONSTRAINT `fk_evento_establecimiento1`
    FOREIGN KEY (`id_sitio`)
    REFERENCES `sitio` (`id_sitio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `paquete`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `paquete` ;

CREATE TABLE IF NOT EXISTS `paquete` (
  `id_paquete` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `status` VARCHAR(45) NULL,
  PRIMARY KEY (`id_paquete`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empresa_paquete`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empresa_paquete` ;

CREATE TABLE IF NOT EXISTS `empresa_paquete` (
  `idempresa` INT NOT NULL,
  `idpaquete` INT NOT NULL,
  `descripcion` VARCHAR(45) NULL,
  PRIMARY KEY (`idempresa`, `idpaquete`),
  INDEX `fk_empresa_has_paquete_paquete1_idx` (`idpaquete` ASC),
  INDEX `fk_empresa_has_paquete_empresa1_idx` (`idempresa` ASC),
  CONSTRAINT `fk_empresa_has_paquete_empresa1`
    FOREIGN KEY (`idempresa`)
    REFERENCES `empresa` (`id_empresa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresa_has_paquete_paquete1`
    FOREIGN KEY (`idpaquete`)
    REFERENCES `paquete` (`id_paquete`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comentario_rechazo_paquete`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comentario_rechazo_paquete` ;

CREATE TABLE IF NOT EXISTS `comentario_rechazo_paquete` (
  `id` INT NOT NULL,
  `idpaquete` INT NOT NULL,
  `comentario_rechazo` VARCHAR(500) NULL,
  PRIMARY KEY (`id`, `idpaquete`),
  INDEX `fk_comentariopaquete_paquete1_idx` (`idpaquete` ASC),
  CONSTRAINT `fk_comentariopaquete_paquete1`
    FOREIGN KEY (`idpaquete`)
    REFERENCES `paquete` (`id_paquete`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `planificador`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `planificador` ;

CREATE TABLE IF NOT EXISTS `planificador` (
  `idevento` INT NOT NULL,
  `idturista` INT NOT NULL,
  PRIMARY KEY (`idevento`, `idturista`),
  INDEX `fk_planificador_evento1_idx` (`idevento` ASC),
  CONSTRAINT `fk_planificador_evento1`
    FOREIGN KEY (`idevento`)
    REFERENCES `evento` (`id_evento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `actividad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `actividad` ;

CREATE TABLE IF NOT EXISTS `actividad` (
  `id` INT NOT NULL,
  `turista_username` VARCHAR(100) NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `fechainicio` DATETIME NULL,
  `fechafin` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_actividad_turista1_idx` (`turista_username` ASC),
  CONSTRAINT `fk_actividad_turista1`
    FOREIGN KEY (`turista_username`)
    REFERENCES `turista` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `token`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `token` ;

CREATE TABLE IF NOT EXISTS `token` (
  `token` VARCHAR(45) NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`username`, `token`),
  INDEX `fk_token_users1_idx` (`username` ASC),
  CONSTRAINT `fk_token_users1`
    FOREIGN KEY (`username`)
    REFERENCES `users` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `video_turista`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `video_turista` ;

CREATE TABLE IF NOT EXISTS `video_turista` (
  `id` INT NOT NULL,
  `turista_idusuario` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`id`, `turista_idusuario`),
  INDEX `fk_video_has_turista_turista1_idx` (`turista_idusuario` ASC),
  INDEX `fk_video_has_turista_video1_idx` (`id` ASC),
  CONSTRAINT `fk_video_has_turista_video1`
    FOREIGN KEY (`id`)
    REFERENCES `video` (`id_video`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_video_has_turista_turista1`
    FOREIGN KEY (`turista_idusuario`)
    REFERENCES `turista` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GeoCercas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `GeoCercas` ;

CREATE TABLE IF NOT EXISTS `GeoCercas` (
  `category_id` INT NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `Poligono` POLYGON NULL,
  PRIMARY KEY (`category_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `revision_informacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `revision_informacion` ;

CREATE TABLE IF NOT EXISTS `revision_informacion` (
  `id_revision_informacion` INT NOT NULL AUTO_INCREMENT,
  `id_sitio` INT NOT NULL,
  `fecha_creacion` DATETIME NULL,
  `fecha_actualizacion` DATETIME NULL,
  `status` CHAR(1) NULL,
  `ubicacionGIS` POINT NULL,
  `url_audioguia` VARCHAR(500) NULL,
  `url_carta` VARCHAR(500) NULL,
  PRIMARY KEY (`id_revision_informacion`),
  INDEX `fk_informacion_sitio_sitio1_idx` (`id_sitio` ASC),
  CONSTRAINT `fk_informacion_sitio_sitio1`
    FOREIGN KEY (`id_sitio`)
    REFERENCES `sitio` (`id_sitio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `informacion_sitio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `informacion_sitio` ;

CREATE TABLE IF NOT EXISTS `informacion_sitio` (
  `id_informacion_sitio` INT NOT NULL AUTO_INCREMENT,
  `id_revision_informacion` INT NOT NULL,
  `ubicacionGIS` POINT NOT NULL,
  `fecha_actualizacion` DATETIME NOT NULL,
  `url_audioguia` VARCHAR(500) NULL,
  `url_carta` VARCHAR(500) NULL,
  PRIMARY KEY (`id_informacion_sitio`, `id_revision_informacion`),
  INDEX `fk_ubicacion_informacion_sitio1_idx` (`id_revision_informacion` ASC),
  CONSTRAINT `fk_ubicacion_informacion_sitio1`
    FOREIGN KEY (`id_revision_informacion`)
    REFERENCES `revision_informacion` (`id_revision_informacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `comentario_rechazo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comentario_rechazo` ;

CREATE TABLE IF NOT EXISTS `comentario_rechazo` (
  `id_comentario_rechazo` INT NOT NULL AUTO_INCREMENT,
  `id_informacion_sitio` INT NOT NULL,
  `comentario` VARCHAR(500) NULL,
  `fecha_publicacion` DATETIME NULL,
  PRIMARY KEY (`id_comentario_rechazo`),
  INDEX `fk_comentario_rechazo_informacion_sitio1_idx` (`id_informacion_sitio` ASC),
  CONSTRAINT `fk_comentario_rechazo_informacion_sitio1`
    FOREIGN KEY (`id_informacion_sitio`)
    REFERENCES `revision_informacion` (`id_revision_informacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `calificacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `calificacion` ;

CREATE TABLE IF NOT EXISTS `calificacion` (
  `id_comentario` INT NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `comentario` VARCHAR(500) NULL,
  `calificacion` INT NULL,
  `fecha_creacion` VARCHAR(45) NULL,
  `turista_username` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_comentario`),
  INDEX `fk_calificacion_turista1_idx` (`turista_username` ASC),
  CONSTRAINT `fk_calificacion_turista1`
    FOREIGN KEY (`turista_username`)
    REFERENCES `turista` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `empresa_has_calificacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `empresa_has_calificacion` ;

CREATE TABLE IF NOT EXISTS `empresa_has_calificacion` (
  `empresa_id_empresa` INT NOT NULL,
  `calificacion_id_comentario` INT NOT NULL,
  PRIMARY KEY (`empresa_id_empresa`, `calificacion_id_comentario`),
  INDEX `fk_empresa_has_calificacion_calificacion1_idx` (`calificacion_id_comentario` ASC),
  INDEX `fk_empresa_has_calificacion_empresa1_idx` (`empresa_id_empresa` ASC),
  CONSTRAINT `fk_empresa_has_calificacion_empresa1`
    FOREIGN KEY (`empresa_id_empresa`)
    REFERENCES `empresa` (`id_empresa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresa_has_calificacion_calificacion1`
    FOREIGN KEY (`calificacion_id_comentario`)
    REFERENCES `calificacion` (`id_comentario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
