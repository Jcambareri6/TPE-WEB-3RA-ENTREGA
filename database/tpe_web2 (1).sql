-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-10-2023 a las 00:11:58
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tpe_web2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `CompraID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ProductoID` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `FechaCompra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `MarcaID` int(11) NOT NULL,
  `Nombre` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`MarcaID`, `Nombre`) VALUES
(1, 'Samsung'),
(8, 'Iphone'),
(9, 'Motorola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ProductoID` int(11) NOT NULL,
  `Imagen` varchar(45) NOT NULL,
  `NombreProducto` varchar(100) NOT NULL,
  `Descripcion` text NOT NULL,
  `Precio` double NOT NULL,
  `Stock` int(11) NOT NULL,
  `IDmarca` int(11) NOT NULL,
  `Condicion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ProductoID`, `Imagen`, `NombreProducto`, `Descripcion`, `Precio`, `Stock`, `IDmarca`, `Condicion`) VALUES
(25, './images/652d3802b1960.jpg', 'Samsung A30', 'Marca: Samsung\r\nModelo: Galaxy A30\r\nPantalla: Pantalla Super AMOLED de 6.4 pulgadas\r\nResolución: 1080 x 2340 píxeles\r\nCámara Principal: Doble cámara, 16 MP + 5 MP\r\nCámara Frontal: 16 MP\r\nProcesador: Exynos 7904 Octa-Core\r\nAlmacenamiento: Variante de 32 GB o 64 GB de almacenamiento interno\r\nMemoria RAM: 3 GB o 4 GB de RAM\r\nSistema Operativo: Android 9.0 (Pie)\r\nBatería: Batería de 4000 mAh\r\nLector de Huellas: Sí, en la parte trasera', 12, 12000, 1, 'Nuevo'),
(26, './images/652d389364bcb.jpg', 'Samsung S22 ULTRA', 'Pantalla: AMOLED de 6,8 pulgadas. Resolución QHD+ a 3.080 x 1.440.\r\nProcesador: Qualcomm Snapdragon 8 Gen 2.\r\nAlmacenamiento: 8 o 12GB de RAM. 256 y 512GB. En países desarrollados hay de 1TB de memoria interna.\r\nCámaras traseras: Principal: 200 megapíxeles f/1.7 OIS.\r\nCámara delantera: 12 megapíxeles f/2.2 25mm.\r\nBatería: 5.000 mAh.\r\nSistema operativo: Android 13.', 3, 300000, 1, 'Nuevo'),
(28, './images/652d39ca7550f.jpg', 'Motorola e22 ', 'Pantalla: 6.5\", 720 x 1600 pixels\r\nProcesador: Mediatek Helio G37 2.3GHz\r\nRAM: 4GB\r\nAlmacenamiento: 64GB\r\nExpansión: microSD\r\nCámara: Dual, 16MP+2MP\r\nBatería: 4020 mAh\r\nOS: Android 12', 12, 120000, 9, 'Usado'),
(29, './images/652d3a2e55406.jpg', 'MOTOROLA E20 ', 'Memoria RAM: 2 GB.\r\nMemoria ROM: 32 GB.\r\nLector de Tarjetas: MICRO SDXC.\r\nCámara Principal Imagen: DUAL:  13 MP, f/2.2, 26 mm (gran angular), PDAF / 2 MP, f/2.4, (macro). Flash LED, HDR, Panorama.\r\nCámara Principal Video: 1080p a 30 fps.\r\nCámara Selfie Imagen: 5 MP, f/2.2. HDR.\r\nCámara Selfie Video: 1080p a 30 fps.', 12, 120000, 9, 'Nuevo'),
(30, './images/652d3ab59d26d.jpg', 'Iphone 11 Pro Max', 'Pantalla: 6.5\", 1242 x 2688 pixels\r\nProcesador: Apple A13 Bionic\r\nRAM: 4GB\r\nAlmacenamiento: 64GB/256GB/512GB\r\nExpansión: sin microSD\r\nCámara: Triple, 12MP+12MP+12MP\r\nBatería: 3969 mAh\r\nOS: iOS 13', 12, 120000, 8, 'Nuevo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUser` int(1) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUser`, `username`, `password`) VALUES
(1, 'webadmin@gmail.com', '$2y$10$SuGVCRbDkd74jCh5Ubr2r.nbKCsXCrKmmXqLjLiUwO/aiLOHIZOti');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`CompraID`),
  ADD KEY `FK_ProductoID` (`ProductoID`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`MarcaID`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ProductoID`),
  ADD KEY `FK_MarcaID` (`IDmarca`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `CompraID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `MarcaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ProductoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUser` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `FK_ProductoID` FOREIGN KEY (`ProductoID`) REFERENCES `productos` (`ProductoID`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `FK_MarcaID` FOREIGN KEY (`IDmarca`) REFERENCES `marcas` (`MarcaID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
