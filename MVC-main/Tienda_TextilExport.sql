SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Base de datos: Cuponera

CREATE DATABASE Textil_Export;
USE Textil_Export;

-- Estructura de las Tablas

-- Tabla Tipo_Usuario

CREATE TABLE IF NOT EXISTS `Tipo_Usuarios` (
    `ID_Tipo_Usuario` int(11) NOT NULL,
    `Tipo_Usuario` varchar(30) NOT NULL,
    PRIMARY KEY(`ID_Tipo_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insertando Datos
INSERT INTO `Tipo_Usuarios` (`ID_Tipo_Usuario`, `Tipo_Usuario`) VALUES
(1, 'ADMIN'),
(2, 'EMPLEADO'),
(3, 'USUARIO');

-- Tabla Clientes

CREATE TABLE IF NOT EXISTS `Usuarios` (
    `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT,
    `Nombres` varchar(30) NOT NULL,
    `Apellidos` varchar(30) NOT NULL,
    `Telefono` varchar(9) NOT NULL,
    `Correo` varchar(50) NOT NULL,
    `Password` varchar(60) NOT NULL,
    `Estado` varchar(60) NOT NULL,
    `id_tipo_usuario` int(11) NOT NULL,
    PRIMARY KEY(`ID_Usuario`),
    KEY `FK_USUARIO` (`id_tipo_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insertando Datos
INSERT INTO `Usuarios` (`ID_Usuario`, `Nombres`, `Apellidos`, `Telefono`, `Correo`, `Password`,`id_tipo_usuario`) VALUES
('','Marco', 'Lopez', '62096080', 'marcolopez121@outlook.com', '123456', 3);

-- Tabla Categoria

CREATE TABLE IF NOT EXISTS `Categoria` (
    `ID_Categoria` int(11) NOT NULL AUTO_INCREMENT,
    `Categoria` varchar(30) NOT NULL,
    PRIMARY KEY(`ID_Categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insertando Datos
INSERT INTO `Categoria` (`ID_Categoria`, `Categoria`) VALUES
('','Textil');

-- Tabla Productos

CREATE TABLE IF NOT EXISTS `Productos` (
    `ID_Producto` varchar(9) NOT NULL,
    `Nombre` varchar(30) NOT NULL,
    `Descripcion` varchar(30) NOT NULL,
    `Img` varchar(50),
    `id_categoria` int(11) NOT NULL,
    `Precio` varchar(6) NOT NULL,
    `Existencias` int(11) NOT NULL,
    PRIMARY KEY(`ID_Producto`),
    KEY `FK_CATEGORIA` (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insertando Datos
INSERT INTO `Productos` (`ID_Producto`, `Nombre`, `Descripcion`, `Img`, `id_categoria`, `Precio`, `Existencias`) VALUES
('PROD00001','Camiseta', 'Hecha con algodon suave', NULL , 0, 2.50, 3);

-- Tabla Ordenes

CREATE TABLE IF NOT EXISTS `Ordenes` (
    `ID_Orden` int(11) NOT NULL AUTO_INCREMENT,
    `id_usuario` int(11) NOT NULL,
    `Total` Decimal(10,2) NOT NULL,
    PRIMARY KEY(`ID_Orden`),
    kEY `FK_USUARIO_ORDEN` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insertando Datos
/*INSERT INTO `Ofertas` (`ID_Oferta`, `Titulo_Oferta`, `Precio_Regular`, `Precio_Oferta`, `Fecha_Inicio_Oferta`, `Fecha_Fin_Oferta`, `Cantidad_Cupones`, `Descripcion`, `Estado_Oferta`, `Justificacion`, `Imagen`, `id_empresa`) VALUES
('','Promocion de Botellas 6x2', 8.40, 2.25, '2023-03-26', '2023-05-22', NULL, 'Botellas a buen precio', NULL, NULL, NULL, 'EMP001');*/

-- Tabla Cupones_Clientes

CREATE TABLE IF NOT EXISTS `Ordenes_Detalles` (
    `ID_Detalles` int(11) NOT NULL AUTO_INCREMENT,
    `id_producto` varchar(9) NOT NULL,
    `id_orden` int(11) NOT NULL,
    `Cantidad` int(11) NOT NULL,
    PRIMARY KEY(`ID_Detalles`),
    kEY `FK_PRODUCTO_DETALLE` (`id_producto`),
    KEY `FK_ORDEN_DETALLE` (`id_orden`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insertando Datos
/*INSERT INTO `Cupones_Clientes` (`ID_Cupon`, `id_oferta`, `id_usuario`, `Estado_Cupon`, `Cantidad`) VALUES
('EMP0010000001',0, 0,'Disponible', 2);*/

-- Llaves Foraneas

ALTER TABLE `Usuarios`
  ADD CONSTRAINT `FK_USUARIO` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `Tipo_Usuarios` (`ID_Tipo_Usuario`);

ALTER TABLE `Ordenes`
 ADD CONSTRAINT `FK_USUARIO_ORDEN` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`ID_Usuario`);

ALTER TABLE `Productos`
 ADD CONSTRAINT `FK_CATEGORIA` FOREIGN KEY (`id_categoria`) REFERENCES `Categoria` (`ID_Categoria`);

ALTER TABLE `Ordenes_Detalles`
  ADD CONSTRAINT `FK_PRODUCTO_DETALLE` FOREIGN KEY (`id_producto`) REFERENCES `Productos` (`ID_Producto`),
  ADD CONSTRAINT `FK_ORDEN_DETALLE` FOREIGN KEY (`id_orden`) REFERENCES `Ordenes` (`ID_Orden`);
