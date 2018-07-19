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
-- Table `campeche`.`sector`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`sector` ;

CREATE TABLE IF NOT EXISTS `campeche`.`sector` (
  `id_sector` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(200) NULL,
  PRIMARY KEY (`id_sector`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`membresia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`membresia` ;

CREATE TABLE IF NOT EXISTS `campeche`.`membresia` (
  `id_membresia` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(500) NOT NULL,
  `nombre` VARCHAR(50) NOT NULL,
  `costo` DOUBLE NOT NULL,
  PRIMARY KEY (`id_membresia`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`rango_ventas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`rango_ventas` ;

CREATE TABLE IF NOT EXISTS `campeche`.`rango_ventas` (
  `id_rango_ventas` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(50) NULL,
  PRIMARY KEY (`id_rango_ventas`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`empresa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`empresa` ;

CREATE TABLE IF NOT EXISTS `campeche`.`empresa` (
  `id_empresa` INT NOT NULL AUTO_INCREMENT,
  `id_membresia` INT NOT NULL,
  `id_sector` INT NOT NULL,
  `id_rango_ventas` INT NOT NULL,
  `descripcion` VARCHAR(500) NOT NULL,
  `telefono` VARCHAR(15) NOT NULL,
  `extension` VARCHAR(7) NULL,
  `celular` VARCHAR(15) NULL,
  `direccion` VARCHAR(200) NULL,
  `nombre` VARCHAR(200) NULL,
  `numero_empleados` INT NULL,
  `propietario` VARCHAR(250) NULL,
  `tamano` VARCHAR(100) NULL,
  `facebook` VARCHAR(250) NULL,
  `twitter` VARCHAR(250) NULL,
  `instagram` VARCHAR(250) NULL,
  `youtube` VARCHAR(250) NULL,
  `googleplus` VARCHAR(250) NULL,
  PRIMARY KEY (`id_empresa`),
  INDEX `fk_empresa_sector_idx` (`id_sector` ASC),
  INDEX `fk_empresa_plan1_idx` (`id_membresia` ASC),
  INDEX `fk_empresa_rango_ventas1_idx` (`id_rango_ventas` ASC),
  CONSTRAINT `fk_empresa_sector1`
    FOREIGN KEY (`id_sector`)
    REFERENCES `campeche`.`sector` (`id_sector`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresa_plan1`
    FOREIGN KEY (`id_membresia`)
    REFERENCES `campeche`.`membresia` (`id_membresia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresa_rango_ventas1`
    FOREIGN KEY (`id_rango_ventas`)
    REFERENCES `campeche`.`rango_ventas` (`id_rango_ventas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`revision_objeto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`revision_objeto` ;

CREATE TABLE IF NOT EXISTS `campeche`.`revision_objeto` (
  `id_revision_objeto` INT NOT NULL AUTO_INCREMENT,
  `id_empresa` INT NOT NULL,
  `fecha_creacion` DATETIME NULL,
  `fecha_actualizacion` DATETIME NULL,
  `status` CHAR(1) NULL,
  PRIMARY KEY (`id_revision_objeto`),
  INDEX `fk_empresa_has_revision_empresa1_idx` (`id_empresa` ASC),
  CONSTRAINT `fk_empresa_has_revision_empresa1`
    FOREIGN KEY (`id_empresa`)
    REFERENCES `campeche`.`empresa` (`id_empresa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`cupon`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`cupon` ;

CREATE TABLE IF NOT EXISTS `campeche`.`cupon` (
  `id_cupon` INT NOT NULL,
  `id_revision_objeto` INT NOT NULL,
  `titulo` VARCHAR(100) NOT NULL,
  `descripcion_corta` VARCHAR(150) NOT NULL,
  `descripcion_larga` VARCHAR(500) NOT NULL,
  `id_imagen_vista_previa` VARCHAR(12) NOT NULL,
  `id_imagen_extra` VARCHAR(12) NULL,
  `vigencia_inicio` DATETIME NOT NULL,
  `vigencia_fin` DATETIME NOT NULL,
  `terminos_y_condiciones` VARCHAR(250) NOT NULL,
  `limite_codigos` INT NOT NULL,
  PRIMARY KEY (`id_cupon`, `id_revision_objeto`),
  INDEX `fk_cupon_revision_objeto1_idx` (`id_revision_objeto` ASC),
  CONSTRAINT `fk_cupon_revision_objeto1`
    FOREIGN KEY (`id_revision_objeto`)
    REFERENCES `campeche`.`revision_objeto` (`id_revision_objeto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`users` ;

CREATE TABLE IF NOT EXISTS `campeche`.`users` (
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `enabled` TINYINT(1) NULL,
  PRIMARY KEY (`username`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`pais`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`pais` ;

CREATE TABLE IF NOT EXISTS `campeche`.`pais` (
  `id_pais` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_pais`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`turista`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`turista` ;

CREATE TABLE IF NOT EXISTS `campeche`.`turista` (
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
    REFERENCES `campeche`.`users` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_turista_1`
    FOREIGN KEY (`id_pais`)
    REFERENCES `campeche`.`pais` (`id_pais`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`codigo_qr`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`codigo_qr` ;

CREATE TABLE IF NOT EXISTS `campeche`.`codigo_qr` (
  `id_codigo_qr` INT NOT NULL,
  `id_cupon` INT NOT NULL,
  `turista_username` VARCHAR(100) NOT NULL,
  `canjeado` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_codigo_qr`, `id_cupon`),
  INDEX `fk_codigo_qr_cupon_idx` (`id_cupon` ASC),
  INDEX `fk_codigo_qr_turista1_idx` (`turista_username` ASC),
  CONSTRAINT `fk_codigo_qr_cupon`
    FOREIGN KEY (`id_cupon`)
    REFERENCES `campeche`.`cupon` (`id_cupon`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_codigo_qr_turista1`
    FOREIGN KEY (`turista_username`)
    REFERENCES `campeche`.`turista` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`video`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`video` ;

CREATE TABLE IF NOT EXISTS `campeche`.`video` (
  `id_video` INT NOT NULL,
  `id_revision_objeto` INT NOT NULL,
  `titulo` VARCHAR(100) NULL,
  `descripcion` VARCHAR(500) NULL,
  `precio` DOUBLE NOT NULL,
  `fecha_subida` DATETIME NOT NULL,
  `id_img_preview` VARCHAR(12) NOT NULL,
  `id_video_archivo` VARCHAR(12) NOT NULL,
  `status` TINYINT(1) NOT NULL,
  `visualizaciones` DECIMAL(65,0) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_video`),
  INDEX `fk_video_revision_objeto1_idx` (`id_revision_objeto` ASC),
  CONSTRAINT `fk_video_revision_objeto1`
    FOREIGN KEY (`id_revision_objeto`)
    REFERENCES `campeche`.`revision_objeto` (`id_revision_objeto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`authorities`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`authorities` ;

CREATE TABLE IF NOT EXISTS `campeche`.`authorities` (
  `username` VARCHAR(50) NOT NULL,
  `authority` VARCHAR(50) NULL,
  PRIMARY KEY (`username`),
  CONSTRAINT `fk_authorities_1`
    FOREIGN KEY (`username`)
    REFERENCES `campeche`.`users` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`usuario_empresa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`usuario_empresa` ;

CREATE TABLE IF NOT EXISTS `campeche`.`usuario_empresa` (
  `id_empresa` INT NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_empresa`, `username`),
  INDEX `fk_usuario_empresa_usuario_idx` (`username` ASC),
  INDEX `fk_usuario_empresa_empresa_idx` (`id_empresa` ASC),
  CONSTRAINT `fk_empresa_has_usuario_empresa1`
    FOREIGN KEY (`id_empresa`)
    REFERENCES `campeche`.`empresa` (`id_empresa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresa_has_usuario_usuario1`
    FOREIGN KEY (`username`)
    REFERENCES `campeche`.`users` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`tema_interes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`tema_interes` ;

CREATE TABLE IF NOT EXISTS `campeche`.`tema_interes` (
  `id_tema_interes` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NULL,
  PRIMARY KEY (`id_tema_interes`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`tema_interes_turista`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`tema_interes_turista` ;

CREATE TABLE IF NOT EXISTS `campeche`.`tema_interes_turista` (
  `id_tema_interes` INT NOT NULL,
  `turista_username` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_tema_interes`, `turista_username`),
  INDEX `fk_tema_interes_turista_tema_interes_idx` (`id_tema_interes` ASC),
  INDEX `fk_tema_interes_turista_turista1_idx` (`turista_username` ASC),
  CONSTRAINT `fk_turista_has_tema_interes_tema_interes1`
    FOREIGN KEY (`id_tema_interes`)
    REFERENCES `campeche`.`tema_interes` (`id_tema_interes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tema_interes_turista_turista1`
    FOREIGN KEY (`turista_username`)
    REFERENCES `campeche`.`turista` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`video_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`video_usuario` ;

CREATE TABLE IF NOT EXISTS `campeche`.`video_usuario` (
  `id_video` INT NOT NULL,
  `usuario` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`id_video`, `usuario`),
  INDEX `fk_video_usuario_idx` (`usuario` ASC),
  INDEX `fk_video_usuario_id1` (`id_video` ASC),
  CONSTRAINT `fk_video_has_usuario_video1`
    FOREIGN KEY (`id_video`)
    REFERENCES `campeche`.`video` (`id_video`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_video_has_usuario_usuario1`
    FOREIGN KEY (`usuario`)
    REFERENCES `campeche`.`users` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`municipios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`municipios` ;

CREATE TABLE IF NOT EXISTS `campeche`.`municipios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`sitio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`sitio` ;

CREATE TABLE IF NOT EXISTS `campeche`.`sitio` (
  `id_sitio` INT NOT NULL AUTO_INCREMENT,
  `id_empresa` INT NOT NULL,
  `municipios_id` INT NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `direccion` VARCHAR(200) NULL,
  `telefono1` VARCHAR(15) NULL,
  `telefono2` VARCHAR(15) NULL,
  `capacidad` INT NULL,
  `horario` VARCHAR(50) NULL,
  PRIMARY KEY (`id_sitio`),
  INDEX `fk_establecimiento_empresa1_idx` (`id_empresa` ASC),
  INDEX `fk_establecimiento_municipios1_idx` (`municipios_id` ASC),
  CONSTRAINT `fk_establecimiento_empresa1`
    FOREIGN KEY (`id_empresa`)
    REFERENCES `campeche`.`empresa` (`id_empresa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_establecimiento_municipios1`
    FOREIGN KEY (`municipios_id`)
    REFERENCES `campeche`.`municipios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`comentario_rechazo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`comentario_rechazo` ;

CREATE TABLE IF NOT EXISTS `campeche`.`comentario_rechazo` (
  `id_comentario_rechazo` INT NOT NULL AUTO_INCREMENT,
  `id_informacion_sitio` INT NOT NULL,
  `comentario` VARCHAR(500) NULL,
  `fecha_publicacion` DATETIME NULL,
  PRIMARY KEY (`id_comentario_rechazo`),
  INDEX `fk_comentario_rechazo_informacion_sitio1_idx` (`id_informacion_sitio` ASC),
  CONSTRAINT `fk_comentario_rechazo_informacion_sitio1`
    FOREIGN KEY (`id_informacion_sitio`)
    REFERENCES `campeche`.`revision_informacion` (`id_revision_informacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`vacante`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`vacante` ;

CREATE TABLE IF NOT EXISTS `campeche`.`vacante` (
  `id_vacante` INT NOT NULL,
  `id_revision_objeto` INT NOT NULL,
  `nombre` VARCHAR(50) NOT NULL,
  `salario` VARCHAR(50) NOT NULL,
  `horario` VARCHAR(50) NOT NULL,
  `escolaridad` VARCHAR(50) NOT NULL,
  `habilidades` VARCHAR(500) NOT NULL,
  `descripcion` VARCHAR(500) NOT NULL,
  `temporal` TINYINT(1) NOT NULL,
  `tiempo` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_vacante`),
  INDEX `fk_vacante_revision_objeto1_idx` (`id_revision_objeto` ASC),
  CONSTRAINT `fk_vacante_revision_objeto1`
    FOREIGN KEY (`id_revision_objeto`)
    REFERENCES `campeche`.`revision_objeto` (`id_revision_objeto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`evento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`evento` ;

CREATE TABLE IF NOT EXISTS `campeche`.`evento` (
  `id_evento` INT NOT NULL AUTO_INCREMENT,
  `id_sitio` INT NOT NULL,
  `nombre` VARCHAR(50) NOT NULL,
  `fecha` DATETIME NOT NULL,
  `lugar` VARCHAR(200) NOT NULL,
  `costo` DOUBLE NOT NULL,
  `beneficiario` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`id_evento`, `id_sitio`),
  INDEX `fk_evento_establecimiento1_idx` (`id_sitio` ASC),
  CONSTRAINT `fk_evento_establecimiento1`
    FOREIGN KEY (`id_sitio`)
    REFERENCES `campeche`.`sitio` (`id_sitio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`paquete`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`paquete` ;

CREATE TABLE IF NOT EXISTS `campeche`.`paquete` (
  `id_paquete` INT NOT NULL,
  `nombre` VARCHAR(50) NULL,
  `status` CHAR(1) NULL,
  PRIMARY KEY (`id_paquete`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`empresa_paquete`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`empresa_paquete` ;

CREATE TABLE IF NOT EXISTS `campeche`.`empresa_paquete` (
  `idempresa` INT NOT NULL,
  `idpaquete` INT NOT NULL,
  `descripcion` VARCHAR(500) NULL,
  PRIMARY KEY (`idempresa`, `idpaquete`),
  INDEX `fk_empresa_has_paquete_paquete1_idx` (`idpaquete` ASC),
  INDEX `fk_empresa_has_paquete_empresa1_idx` (`idempresa` ASC),
  CONSTRAINT `fk_empresa_has_paquete_empresa1`
    FOREIGN KEY (`idempresa`)
    REFERENCES `campeche`.`empresa` (`id_empresa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresa_has_paquete_paquete1`
    FOREIGN KEY (`idpaquete`)
    REFERENCES `campeche`.`paquete` (`id_paquete`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`comentario_rechazo_paquete`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`comentario_rechazo_paquete` ;

CREATE TABLE IF NOT EXISTS `campeche`.`comentario_rechazo_paquete` (
  `id` INT NOT NULL,
  `idpaquete` INT NOT NULL,
  `comentario_rechazo` VARCHAR(500) NULL,
  PRIMARY KEY (`id`, `idpaquete`),
  INDEX `fk_comentariopaquete_paquete1_idx` (`idpaquete` ASC),
  CONSTRAINT `fk_comentariopaquete_paquete1`
    FOREIGN KEY (`idpaquete`)
    REFERENCES `campeche`.`paquete` (`id_paquete`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`planificador`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`planificador` ;

CREATE TABLE IF NOT EXISTS `campeche`.`planificador` (
  `idevento` INT NOT NULL,
  `idturista` INT NOT NULL,
  PRIMARY KEY (`idevento`, `idturista`),
  INDEX `fk_planificador_evento1_idx` (`idevento` ASC),
  CONSTRAINT `fk_planificador_evento1`
    FOREIGN KEY (`idevento`)
    REFERENCES `campeche`.`evento` (`id_evento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`actividad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`actividad` ;

CREATE TABLE IF NOT EXISTS `campeche`.`actividad` (
  `id` INT NOT NULL,
  `turista_username` VARCHAR(100) NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `fechainicio` DATETIME NULL,
  `fechafin` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_actividad_turista1_idx` (`turista_username` ASC),
  CONSTRAINT `fk_actividad_turista1`
    FOREIGN KEY (`turista_username`)
    REFERENCES `campeche`.`turista` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`token`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`token` ;

CREATE TABLE IF NOT EXISTS `campeche`.`token` (
  `token` VARCHAR(64) NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  `vigencia` DATETIME NOT NULL,
  PRIMARY KEY (`token`),
  INDEX `fk_token_users1_idx` (`username` ASC),
  CONSTRAINT `fk_token_users1`
    FOREIGN KEY (`username`)
    REFERENCES `campeche`.`users` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`video_turista`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`video_turista` ;

CREATE TABLE IF NOT EXISTS `campeche`.`video_turista` (
  `id` INT NOT NULL,
  `turista_idusuario` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`id`, `turista_idusuario`),
  INDEX `fk_video_has_turista_turista1_idx` (`turista_idusuario` ASC),
  INDEX `fk_video_has_turista_video1_idx` (`id` ASC),
  CONSTRAINT `fk_video_has_turista_video1`
    FOREIGN KEY (`id`)
    REFERENCES `campeche`.`video` (`id_video`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_video_has_turista_turista1`
    FOREIGN KEY (`turista_idusuario`)
    REFERENCES `campeche`.`turista` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`GeoCercas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`GeoCercas` ;

CREATE TABLE IF NOT EXISTS `campeche`.`GeoCercas` (
  `category_id` INT NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `Poligono` POLYGON NULL,
  PRIMARY KEY (`category_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`revision_informacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`revision_informacion` ;

CREATE TABLE IF NOT EXISTS `campeche`.`revision_informacion` (
  `id_revision_informacion` INT NOT NULL AUTO_INCREMENT,
  `id_sitio` INT NOT NULL,
  `fecha_creacion` DATETIME NULL,
  `fecha_actualizacion` DATETIME NULL,
  `status` CHAR(1) NULL,
  `url_sitio_web` VARCHAR(500) NULL,
  `id_imagen_perfil` VARCHAR(12) NULL,
  `id_logo` VARCHAR(12) NULL,
  `id_carta` VARCHAR(12) NULL,
  `ubicacionGIS` POINT NULL,
  PRIMARY KEY (`id_revision_informacion`),
  INDEX `fk_informacion_sitio_sitio1_idx` (`id_sitio` ASC),
  CONSTRAINT `fk_informacion_sitio_sitio1`
    FOREIGN KEY (`id_sitio`)
    REFERENCES `campeche`.`sitio` (`id_sitio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`informacion_sitio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`informacion_sitio` ;

CREATE TABLE IF NOT EXISTS `campeche`.`informacion_sitio` (
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
    REFERENCES `campeche`.`revision_informacion` (`id_revision_informacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`comentario_rechazo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`comentario_rechazo` ;

CREATE TABLE IF NOT EXISTS `campeche`.`comentario_rechazo` (
  `id_comentario_rechazo` INT NOT NULL AUTO_INCREMENT,
  `id_informacion_sitio` INT NOT NULL,
  `comentario` VARCHAR(500) NULL,
  `fecha_publicacion` DATETIME NULL,
  PRIMARY KEY (`id_comentario_rechazo`),
  INDEX `fk_comentario_rechazo_informacion_sitio1_idx` (`id_informacion_sitio` ASC),
  CONSTRAINT `fk_comentario_rechazo_informacion_sitio1`
    FOREIGN KEY (`id_informacion_sitio`)
    REFERENCES `campeche`.`revision_informacion` (`id_revision_informacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`calificacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`calificacion` ;

CREATE TABLE IF NOT EXISTS `campeche`.`calificacion` (
  `id_comentario` INT NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  `comentario` VARCHAR(500) NULL,
  `calificacion` FLOAT NULL,
  `fecha_creacion` DATETIME NULL,
  PRIMARY KEY (`id_comentario`),
  INDEX `fk_calificacion_turista1_idx` (`username` ASC),
  CONSTRAINT `fk_calificacion_turista1`
    FOREIGN KEY (`username`)
    REFERENCES `campeche`.`turista` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`sitio_has_calificacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`sitio_has_calificacion` ;

CREATE TABLE IF NOT EXISTS `campeche`.`sitio_has_calificacion` (
  `calificacion_id_comentario` INT NOT NULL,
  `id_sitio` INT NOT NULL,
  PRIMARY KEY (`calificacion_id_comentario`),
  INDEX `fk_empresa_has_calificacion_calificacion1_idx` (`calificacion_id_comentario` ASC),
  INDEX `fk_sitio_has_calificacion_sitio1_idx` (`id_sitio` ASC),
  CONSTRAINT `fk_empresa_has_calificacion_calificacion1`
    FOREIGN KEY (`calificacion_id_comentario`)
    REFERENCES `campeche`.`calificacion` (`id_comentario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sitio_has_calificacion_sitio1`
    FOREIGN KEY (`id_sitio`)
    REFERENCES `campeche`.`sitio` (`id_sitio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`descripcion_idioma`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`descripcion_idioma` ;

CREATE TABLE IF NOT EXISTS `campeche`.`descripcion_idioma` (
  `id_revision_informacion` INT NOT NULL,
  `lang_code` CHAR(5) NOT NULL,
  `descripcion_larga` VARCHAR(500) NOT NULL,
  `descripcion_corta` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`lang_code`, `id_revision_informacion`),
  INDEX `fk_descripcion_idioma_revision_informacion1_idx` (`id_revision_informacion` ASC),
  CONSTRAINT `fk_descripcion_idioma_revision_informacion1`
    FOREIGN KEY (`id_revision_informacion`)
    REFERENCES `campeche`.`revision_informacion` (`id_revision_informacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`ad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`ad` ;

CREATE TABLE IF NOT EXISTS `campeche`.`ad` (
  `id_ad` INT NOT NULL,
  `id_revision_objeto` INT NOT NULL,
  `tipo` CHAR(1) NOT NULL,
  `id_img` VARCHAR(12) NOT NULL,
  `visualizaciones` DECIMAL(65,0) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_ad`),
  INDEX `fk_ad_revision_objeto1_idx` (`id_revision_objeto` ASC),
  CONSTRAINT `fk_ad_revision_objeto1`
    FOREIGN KEY (`id_revision_objeto`)
    REFERENCES `campeche`.`revision_objeto` (`id_revision_objeto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`imagen_galeria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`imagen_galeria` ;

CREATE TABLE IF NOT EXISTS `campeche`.`imagen_galeria` (
  `id_archivo_imagen` VARCHAR(12) NOT NULL,
  `id_revision_informacion` INT NOT NULL,
  INDEX `fk_imagen_galeria_revision_informacion1_idx` (`id_revision_informacion` ASC),
  PRIMARY KEY (`id_archivo_imagen`),
  CONSTRAINT `fk_imagen_galeria_revision_informacion1`
    FOREIGN KEY (`id_revision_informacion`)
    REFERENCES `campeche`.`revision_informacion` (`id_revision_informacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `campeche`.`fullpass_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `campeche`.`fullpass_user` ;

CREATE TABLE IF NOT EXISTS `campeche`.`fullpass_user` (
  `username` VARCHAR(100) NOT NULL,
  `vigencia` DATETIME NOT NULL,
  INDEX `fk_fullpass_user_users1_idx` (`username` ASC),
  PRIMARY KEY (`username`),
  CONSTRAINT `fk_fullpass_user_users1`
    FOREIGN KEY (`username`)
    REFERENCES `campeche`.`users` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `campeche` ;

-- -----------------------------------------------------
-- Placeholder table for view `campeche`.`sitio_info`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `campeche`.`sitio_info` (`id_sitio` INT, `id_empresa` INT, `municipios_id` INT, `nombre` INT, `direccion` INT, `telefono1` INT, `telefono2` INT, `capacidad` INT, `horario` INT, `id_sector` INT, `sector` INT, `ubicacionGIS` INT, `id_carta` INT, `lang_code` INT, `descripcion_larga` INT, `descripcion_corta` INT, `memebresia` INT);

-- -----------------------------------------------------
-- View `campeche`.`sitio_info`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `campeche`.`sitio_info` ;
DROP TABLE IF EXISTS `campeche`.`sitio_info`;
USE `campeche`;
CREATE  OR REPLACE VIEW `sitio_info` AS
	SELECT sitio.id_sitio AS id_sitio, sitio.id_empresa AS id_empresa, sitio.municipios_id AS municipios_id, 
		   sitio.nombre AS nombre, sitio.direccion AS direccion, sitio.telefono1 AS telefono1, sitio.telefono2 AS telefono2,
           sitio.capacidad AS capacidad, sitio.horario AS horario, sector.id_sector AS id_sector, sector.nombre AS sector, 
           revision_informacion.ubicacionGIS AS ubicacionGIS, revision_informacion.id_carta AS id_carta, 
           descripcion_idioma.lang_code AS lang_code, descripcion_idioma.descripcion_larga AS descripcion_larga, 
           descripcion_idioma.descripcion_corta AS descripcion_corta,
           membresia.id_membresia AS memebresia
		FROM sitio
	JOIN revision_informacion
		ON revision_informacion.id_sitio = sitio.id_sitio
	JOIN empresa
		ON sitio.id_empresa = empresa.id_empresa
	JOIN sector
		ON empresa.id_sector = sector.id_sector
	JOIN descripcion_idioma
		ON descripcion_idioma.id_revision_informacion=revision_informacion.id_revision_informacion
	JOIN membresia
		ON empresa.id_membresia=membresia.id_membresia
	WHERE revision_informacion.status = 'A';

-- -----------------------------------------------------
-- Data for table `campeche`.`membresia`
-- -----------------------------------------------------
START TRANSACTION;
USE `campeche`;
INSERT INTO `campeche`.`membresia` (`id_membresia`, `descripcion`, `nombre`, `costo`) VALUES (1, 'Membresía básica', 'Básica', 1);
INSERT INTO `campeche`.`membresia` (`id_membresia`, `descripcion`, `nombre`, `costo`) VALUES (2, 'Membresia premium', 'Premium', 2);
INSERT INTO `campeche`.`membresia` (`id_membresia`, `descripcion`, `nombre`, `costo`) VALUES (3, 'Membresía 360', '360', 3);

COMMIT;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
