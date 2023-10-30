-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2023 a las 05:02:13
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(2) NOT NULL,
  `categoria` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(1, 'ELECTRICIDAD'),
(2, 'CONSTRUCCIÓN'),
(3, 'PINTURAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `usuario` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`usuario`, `clave`) VALUES
('admin', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `codigo` varchar(6) NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `cantidad` int(3) NOT NULL,
  `total` float(10,2) NOT NULL,
  `detalles` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`codigo`, `cliente`, `dni`, `correo`, `telefono`, `fecha`, `cantidad`, `total`, `detalles`) VALUES
('401965', 'Denardo Edgard Taco Sánchez', '70948049', 'denardo110901@gmail.com', '914314466', '2023-10-29', 8, 187.10, '{\"215428\":[\"Foco Led 12W\",\"5\",9.5],\"267990\":[\"Varilla de Fierro 4.7mm\",\" 1\",8.6],\"504932\":[\"Duralatex 4L Ambar\",\" 2\",65.5]}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `codigo` varchar(6) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `fkCategoria` int(2) NOT NULL,
  `stock` int(4) NOT NULL,
  `precio` float(10,2) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `ruta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codigo`, `nombre`, `marca`, `fkCategoria`, `stock`, `precio`, `descripcion`, `ruta`) VALUES
('215428', 'Foco Led 12W', 'Alfa', 1, 55, 9.50, 'Foco led de 12w.', 'img/LED-spotlight-12.webp'),
('267990', 'Varilla de Fierro 4.7mm', 'Aceros Arequipa', 2, 7, 8.60, 'Varillas de acero o fierros de construcción corrugados con diámetro de 4.7 mm y 8.8 metros de largo, peso 1.162 kg, norma ASTM a496 grado 60.                                                                        ', 'img/iron-rod-47.webp'),
('504932', 'Duralatex 4L Ambar', 'CPP', 3, 14, 65.50, 'Pintura látex de 4 lt con acabado mate, a base de resina vinil-acrílica que otorga buena resistencia y poder cubriente, color ámbar, uso ideal para interiores y exteriores,', 'img/duralatex-ambar.webp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `codigo` varchar(6) NOT NULL,
  `cliente` varchar(50) NOT NULL,
  `cantidad` int(5) NOT NULL,
  `total` float(10,2) NOT NULL,
  `detalles` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_idCategoria` (`fkCategoria`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_idCategoria` FOREIGN KEY (`fkCategoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
