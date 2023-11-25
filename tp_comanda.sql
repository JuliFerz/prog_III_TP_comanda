-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2023 a las 23:29:11
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tp_comanda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestas`
--

CREATE TABLE `encuestas` (
  `id` int(11) NOT NULL,
  `codigo_pedido` varchar(5) NOT NULL,
  `puntos_mesa` int(11) NOT NULL,
  `puntos_restaurante` int(11) NOT NULL,
  `puntos_mozo` int(11) NOT NULL,
  `puntos_cocinero` int(11) NOT NULL,
  `comentarios` varchar(66) NOT NULL,
  `fecha_baja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `encuestas`
--

INSERT INTO `encuestas` (`id`, `codigo_pedido`, `puntos_mesa`, `puntos_restaurante`, `puntos_mozo`, `puntos_cocinero`, `comentarios`, `fecha_baja`) VALUES
(1, 'Qud25', 9, 8, 7, 6, 'Todo ok por el momento.', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL,
  `codigo_pedido` varchar(5) DEFAULT NULL,
  `tiempo_preparacion` int(11) DEFAULT NULL,
  `estado` varchar(50) NOT NULL,
  `fecha_baja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `codigo_pedido`, `tiempo_preparacion`, `estado`, `fecha_baja`) VALUES
(1, NULL, NULL, 'cerrada', NULL),
(2, NULL, NULL, 'libre', NULL),
(3, 'yJP0b', NULL, 'libre', NULL),
(4, NULL, NULL, 'libre', NULL),
(5, NULL, NULL, 'libre', NULL),
(6, NULL, NULL, 'libre', NULL),
(7, NULL, NULL, 'libre', NULL),
(8, NULL, NULL, 'libre', NULL),
(9, NULL, NULL, 'libre', NULL),
(10, NULL, NULL, 'libre', NULL),
(11, NULL, NULL, 'libre', '2023-11-23'),
(12, NULL, NULL, 'libre', '2023-11-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `codigo_pedido` varchar(5) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `tiempo_preparacion` int(11) DEFAULT NULL,
  `nombre_cliente` varchar(50) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `id_encuesta` int(11) DEFAULT NULL,
  `estado` varchar(50) NOT NULL,
  `fecha_baja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `codigo_pedido`, `id_producto`, `id_mesa`, `id_usuario`, `tiempo_preparacion`, `nombre_cliente`, `descripcion`, `foto`, `id_encuesta`, `estado`, `fecha_baja`) VALUES
(1, 'Qud25', 5, 1, 7, 55, 'Leah Castro', NULL, NULL, 1, 'listo para servir', '2023-11-25'),
(2, 'Qud25', 9, 1, 11, 55, 'Natalie Atlas', NULL, NULL, 1, 'listo para servir', '2023-11-25'),
(3, 'Qud25', 5, 1, 105, 55, 'Uta Carolina', NULL, NULL, 1, 'listo para servir', '2023-11-25'),
(4, 'OiQ1h', 2, 2, NULL, NULL, 'Beatrice Espinoza', NULL, NULL, NULL, 'pendiente', NULL),
(5, 'OiQ1h', 12, 2, NULL, NULL, 'Beck Flores', NULL, NULL, NULL, 'pendiente', NULL),
(6, 'OiQ1h', 7, 2, NULL, NULL, 'Zeph Nicolas', NULL, NULL, NULL, 'pendiente', NULL),
(7, '4Bev7', 8, 3, NULL, NULL, 'Martha Sepulveda', NULL, NULL, NULL, 'pendiente', NULL),
(8, '4Bev7', 13, 3, NULL, NULL, 'Gregory Silva', NULL, NULL, NULL, 'pendiente', NULL),
(9, '4Bev7', 15, 3, NULL, NULL, 'Prescott Trinidad', NULL, NULL, NULL, 'pendiente', NULL),
(10, '9lTBs', 2, 4, NULL, NULL, 'Rashad Maximiliano', NULL, NULL, NULL, 'pendiente', NULL),
(11, '9lTBs', 4, 4, NULL, NULL, 'Idona Alexandra', NULL, NULL, NULL, 'pendiente', NULL),
(12, '9lTBs', 17, 4, NULL, NULL, 'Lani Rocio', NULL, NULL, NULL, 'pendiente', NULL),
(13, 'rnePW', 11, 5, NULL, NULL, 'Elton Soto', NULL, NULL, NULL, 'pendiente', NULL),
(14, 'rnePW', 7, 5, NULL, NULL, 'Carla Testudines', NULL, NULL, NULL, 'pendiente', NULL),
(15, 'rnePW', 12, 5, NULL, NULL, 'Noah Herrera', NULL, NULL, NULL, 'pendiente', NULL),
(16, 'NKOTn', 11, 6, NULL, NULL, 'Honorato Flores', NULL, NULL, NULL, 'pendiente', NULL),
(17, 'NKOTn', 3, 6, NULL, NULL, 'Uma Vasquez', NULL, NULL, NULL, 'pendiente', NULL),
(18, 'NKOTn', 7, 6, NULL, NULL, 'Nora Soto', NULL, NULL, NULL, 'pendiente', NULL),
(19, 'DoEUa', 15, 7, NULL, NULL, 'Merrill Fernanda', NULL, NULL, NULL, 'pendiente', NULL),
(20, 'DoEUa', 9, 7, NULL, NULL, 'William Alexandra', NULL, NULL, NULL, 'pendiente', NULL),
(21, 'DoEUa', 10, 7, NULL, NULL, 'Baxter Sofia', NULL, NULL, NULL, 'pendiente', NULL),
(22, 'nrqCM', 4, 8, NULL, NULL, 'Yen Trinidad', NULL, NULL, NULL, 'pendiente', NULL),
(23, 'nrqCM', 6, 8, NULL, NULL, 'Madonna Camila', NULL, NULL, NULL, 'pendiente', NULL),
(24, 'nrqCM', 2, 8, NULL, NULL, 'Cheryl Perez', NULL, NULL, NULL, 'pendiente', NULL),
(25, 'avdcy', 8, 9, NULL, NULL, 'Ocean Herrera', NULL, NULL, NULL, 'pendiente', NULL),
(26, 'avdcy', 2, 9, NULL, NULL, 'Eleanor Felipe', NULL, NULL, NULL, 'pendiente', NULL),
(27, 'avdcy', 15, 9, NULL, NULL, 'Kato Florencia', NULL, NULL, NULL, 'pendiente', NULL),
(28, 'pPU58', 16, 10, NULL, NULL, 'Sigourney Luis', NULL, NULL, NULL, 'pendiente', NULL),
(29, 'pPU58', 12, 10, NULL, NULL, 'Maggie Joaquin', NULL, NULL, NULL, 'pendiente', NULL),
(30, 'pPU58', 4, 10, NULL, NULL, 'Sydney Gabriel', NULL, NULL, NULL, 'pendiente', NULL),
(31, 'szWS8', 18, 11, NULL, NULL, 'Stacy Tapia', NULL, NULL, NULL, 'pendiente', NULL),
(32, 'szWS8', 10, 11, NULL, NULL, 'September Maximiliano', NULL, NULL, NULL, 'pendiente', NULL),
(33, 'szWS8', 7, 11, NULL, NULL, 'Harding Bentlee', NULL, NULL, NULL, 'pendiente', NULL),
(34, 'sWkvj', 3, 12, NULL, NULL, 'Shelly Isabella', NULL, NULL, NULL, 'pendiente', NULL),
(35, 'sWkvj', 14, 12, NULL, NULL, 'Axel Monserrat', NULL, NULL, NULL, 'pendiente', NULL),
(36, 'sWkvj', 10, 12, NULL, NULL, 'Martina Chichi', NULL, NULL, NULL, 'pendiente', NULL),
(37, 'jMcET', 15, 13, NULL, NULL, 'Oliver Bentlee', NULL, NULL, NULL, 'pendiente', NULL),
(38, 'jMcET', 9, 13, NULL, NULL, 'Karen Tomas', NULL, NULL, NULL, 'pendiente', NULL),
(39, 'jMcET', 13, 13, NULL, NULL, 'Jeremy Figueroa', NULL, NULL, NULL, 'pendiente', NULL),
(40, 'a03g1', 6, 14, NULL, NULL, 'Kirestin Vera', NULL, NULL, NULL, 'pendiente', NULL),
(41, 'a03g1', 10, 14, NULL, NULL, 'Flavia Hernandez', NULL, NULL, NULL, 'pendiente', NULL),
(42, 'a03g1', 6, 14, NULL, NULL, 'Jack Torres', NULL, NULL, NULL, 'pendiente', NULL),
(43, 'KyaP7', 5, 15, NULL, NULL, 'Erica Castillo', NULL, NULL, NULL, 'pendiente', NULL),
(44, 'KyaP7', 8, 15, NULL, NULL, 'Bianca Castillo', NULL, NULL, NULL, 'pendiente', NULL),
(45, 'KyaP7', 1, 15, NULL, NULL, 'Roary Araya', NULL, NULL, NULL, 'pendiente', NULL),
(46, 'DSk3T', 6, 16, NULL, NULL, 'Jade Testudines', NULL, NULL, NULL, 'pendiente', NULL),
(47, 'DSk3T', 8, 16, NULL, NULL, 'Arden Joaquin', NULL, NULL, NULL, 'pendiente', NULL),
(48, 'DSk3T', 10, 16, NULL, NULL, 'Malachi Reyes', NULL, NULL, NULL, 'pendiente', NULL),
(49, 'BKcbd', 9, 17, NULL, NULL, 'Brenna Flores', NULL, NULL, NULL, 'pendiente', NULL),
(50, 'BKcbd', 5, 17, NULL, NULL, 'Violet Laura', NULL, NULL, NULL, 'pendiente', NULL),
(51, 'BKcbd', 17, 17, NULL, NULL, 'Jin Vega', NULL, NULL, NULL, 'pendiente', NULL),
(52, 'Lh2i0', 14, 18, NULL, NULL, 'Davis Cristobal', NULL, NULL, NULL, 'pendiente', NULL),
(53, 'Lh2i0', 15, 18, NULL, NULL, 'Stephanie Rocio', NULL, NULL, NULL, 'pendiente', NULL),
(54, 'Lh2i0', 16, 18, NULL, NULL, 'Justine Bastian', NULL, NULL, NULL, 'pendiente', NULL),
(55, 'HlQTy', 12, 19, NULL, NULL, 'Edward Tapia', NULL, NULL, NULL, 'pendiente', NULL),
(56, 'HlQTy', 14, 19, NULL, NULL, 'Carly Camila', NULL, NULL, NULL, 'pendiente', NULL),
(57, 'HlQTy', 6, 19, NULL, NULL, 'Kiayada Ramirez', NULL, NULL, NULL, 'pendiente', NULL),
(58, 'ghfeF', 13, 20, NULL, NULL, 'Nina Diaz', NULL, NULL, NULL, 'pendiente', NULL),
(59, 'ghfeF', 5, 20, NULL, NULL, 'Grant Fernandez', NULL, NULL, NULL, 'pendiente', NULL),
(60, 'ghfeF', 5, 20, NULL, NULL, 'Bert Magdalena', NULL, NULL, NULL, 'pendiente', NULL),
(61, 'dpmxq', 6, 21, NULL, NULL, 'Britanney Vega', NULL, NULL, NULL, 'pendiente', NULL),
(62, 'dpmxq', 3, 21, NULL, NULL, 'Anthony Araya', NULL, NULL, NULL, 'pendiente', NULL),
(63, 'dpmxq', 11, 21, NULL, NULL, 'Lyle Jara', NULL, NULL, NULL, 'pendiente', NULL),
(64, 'yFSdm', 15, 22, NULL, NULL, 'Paloma Matias', NULL, NULL, NULL, 'pendiente', NULL),
(65, 'yFSdm', 2, 22, NULL, NULL, 'Keiko Jara', NULL, NULL, NULL, 'pendiente', NULL),
(66, 'yFSdm', 2, 22, NULL, NULL, 'Guy Luis', NULL, NULL, NULL, 'pendiente', NULL),
(67, 'xjoJQ', 5, 23, NULL, NULL, 'Mary Julieta', NULL, NULL, NULL, 'pendiente', NULL),
(68, 'xjoJQ', 15, 23, NULL, NULL, 'Ima Rivera', NULL, NULL, NULL, 'pendiente', NULL),
(69, 'xjoJQ', 14, 23, NULL, NULL, 'Sandra Vicente', NULL, NULL, NULL, 'pendiente', NULL),
(70, '7wfYz', 2, 24, NULL, NULL, 'Phelan Gutierrez', NULL, NULL, NULL, 'pendiente', NULL),
(71, '7wfYz', 3, 24, NULL, NULL, 'Lana Paula', NULL, NULL, NULL, 'pendiente', NULL),
(72, '7wfYz', 16, 24, NULL, NULL, 'Denton Perez', NULL, NULL, NULL, 'pendiente', NULL),
(73, '1wAr5', 14, 25, NULL, NULL, 'Griffin Martina', NULL, NULL, NULL, 'pendiente', NULL),
(74, '1wAr5', 5, 25, NULL, NULL, 'Donovan Cristobal', NULL, NULL, NULL, 'pendiente', NULL),
(75, '1wAr5', 5, 25, NULL, NULL, 'Frances Ignacio', NULL, NULL, NULL, 'pendiente', NULL),
(76, 'fBpLK', 5, 1, NULL, NULL, 'Jorge', NULL, '', NULL, 'pendiente', NULL),
(77, 'fBpLK', 18, 1, 0, NULL, 'Cliente de prueba', NULL, '', NULL, 'pendiente', NULL),
(78, 'kJMT7', 4, 1, NULL, NULL, 'Jorge', NULL, '', NULL, 'pendiente', NULL),
(79, 'mGif2', 4, 1, NULL, NULL, 'Jorge', NULL, '', NULL, 'pendiente', NULL),
(80, 'yjEAW', 4, 2, NULL, NULL, 'Jorge', NULL, NULL, NULL, 'pendiente', NULL),
(81, 'd4G8K', 4, 2, NULL, NULL, 'Jorge', NULL, NULL, NULL, 'pendiente', NULL),
(82, 'e6VQl', 4, 2, NULL, NULL, 'Jorge', NULL, NULL, NULL, 'pendiente', NULL),
(83, 'vIWkn', 4, 2, NULL, NULL, 'Jorge', NULL, NULL, NULL, 'pendiente', NULL),
(84, 'xnBeg', 4, 2, NULL, NULL, 'Jorge', NULL, NULL, NULL, 'pendiente', NULL),
(85, 'je8WH', 4, 2, NULL, NULL, 'Jorge', NULL, NULL, NULL, 'pendiente', NULL),
(86, 'n71kg', 4, 2, NULL, NULL, 'Jorge', NULL, NULL, NULL, 'pendiente', NULL),
(87, 'n71kg', 18, 1, 0, 35, 'Cliente de prueba', NULL, NULL, NULL, 'pendiente', NULL),
(88, 'n71kg', 18, 1, 0, 35, 'Cliente de prueba', NULL, NULL, NULL, 'pendiente', NULL),
(89, 'yJP0b', 10, 3, NULL, NULL, 'test', NULL, NULL, NULL, 'pendiente', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `id_sector` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `tiempo_preparacion` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `id_sector`, `precio`, `stock`, `tiempo_preparacion`, `estado`, `fecha_creacion`, `fecha_modificacion`, `fecha_baja`) VALUES
(1, 'Pizza', 1, 22274, 99, 35, 1, '2023-11-12', NULL, NULL),
(2, 'Pastas', 1, 20092, 22, 30, 1, '2023-11-12', NULL, NULL),
(3, 'Empanadas', 1, 4153, 76, 20, 1, '2023-11-12', NULL, NULL),
(4, 'Milanesas', 1, 3338, 22, 25, 1, '2023-11-12', '2023-11-25', NULL),
(5, 'Omelette', 1, 21011, 55, 15, 1, '2023-11-12', NULL, NULL),
(6, 'Sandwich', 1, 6840, 5, 15, 1, '2023-11-12', NULL, NULL),
(7, 'Helado', 1, 24816, 54, 10, 1, '2023-11-12', NULL, NULL),
(8, 'Pastel', 1, 24348, 82, 15, 1, '2023-11-12', NULL, NULL),
(9, 'Tarta', 1, 15938, 83, 25, 1, '2023-11-12', NULL, NULL),
(10, 'Bombon', 1, 7093, 41, 10, 1, '2023-11-12', '2023-11-25', NULL),
(11, 'Alfajor', 1, 7277, 4, 7, 1, '2023-11-12', NULL, NULL),
(12, 'Vino', 2, 19687, 32, 5, 1, '2023-11-12', NULL, NULL),
(13, 'Soda', 2, 3737, 31, 5, 1, '2023-11-12', NULL, NULL),
(14, 'Gaseosa', 2, 21791, 78, 5, 1, '2023-11-12', NULL, NULL),
(15, 'Monster', 2, 2072, 93, 5, 1, '2023-11-12', NULL, NULL),
(16, 'Agua', 2, 10641, 78, 5, 1, '2023-11-12', NULL, NULL),
(17, 'Cerveza blanca', 3, 18503, 56, 5, 1, '2023-11-12', NULL, NULL),
(18, 'Cerveza rubia', 3, 22924, 65, 5, 1, '2023-11-12', NULL, NULL),
(19, 'Pure con milanesa', 1, 6500, 70014, 25, 1, '2023-11-24', '2023-11-24', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sectores`
--

CREATE TABLE `sectores` (
  `id` int(11) NOT NULL,
  `detalle` varchar(20) NOT NULL,
  `fecha_baja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sectores`
--

INSERT INTO `sectores` (`id`, `detalle`, `fecha_baja`) VALUES
(1, 'Cocinero', NULL),
(2, 'Bartender', NULL),
(3, 'Cervecero', NULL),
(4, 'Mozo', NULL),
(5, 'Socio', NULL),
(6, 'Admin', NULL),
(7, 'Test(2)', '2023-11-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_productos`
--

CREATE TABLE `tipo_productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fecha_baja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_productos`
--

INSERT INTO `tipo_productos` (`id`, `nombre`, `fecha_baja`) VALUES
(1, 'Comida', NULL),
(2, 'Bebida', NULL),
(3, 'Cerveza', NULL),
(4, 'Dulce', NULL),
(5, 'Test(2)', '2023-11-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `id_sector` int(11) NOT NULL,
  `prioridad` int(1) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `fecha_baja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `id_sector`, `prioridad`, `estado`, `fecha_baja`) VALUES
(1, 'admin', 'admin', 6, 3, 1, NULL),
(2, 'Cairo', 'KUF53QYT3TL', 3, 1, 1, NULL),
(3, 'Ina', 'XSU83MPV5FU', 3, 1, 1, NULL),
(4, 'Marvin', 'WUW10BNG6WK', 3, 1, 1, NULL),
(5, 'Venus', 'ZEX43IBW3FJ', 2, 1, 1, NULL),
(6, 'Irene', 'RWK09SMM2YX', 4, 1, 1, NULL),
(7, 'Jane', 'QOI44VHL5UX', 1, 1, 1, NULL),
(8, 'Walter', 'FQI61KWJ0DT', 2, 1, 1, NULL),
(9, 'Vivian', 'EYL82MQP2LL', 3, 1, 1, NULL),
(10, 'Nelle', 'HGZ57PRN5YT', 3, 1, 1, NULL),
(11, 'Nathan', 'SSL33SRS4JG', 1, 1, 1, NULL),
(12, 'Pascale', 'OQT09LBW2QX', 3, 1, 1, NULL),
(13, 'Cassandra', 'RMD84EPR4ED', 1, 1, 1, NULL),
(14, 'Uta', 'UUK88HJM4FU', 4, 1, 1, NULL),
(15, 'Mira', 'PYP42NDD1BM', 1, 1, 1, NULL),
(16, 'Paula', 'ZLZ54CPH8KW', 2, 1, 1, NULL),
(17, 'Gannon', 'OVM28JEZ3ID', 1, 1, 1, NULL),
(18, 'Jacqueline', 'CDT50FUY4GG', 3, 1, 1, NULL),
(19, 'Vernon', 'HUU64MBB8YE', 3, 1, 1, NULL),
(20, 'Cailin', 'OLP67INN2UI', 4, 1, 1, NULL),
(21, 'Alika', 'CFN96ASY2WO', 2, 1, 1, NULL),
(22, 'Tallulah', 'WRJ35KRU8VK', 1, 1, 1, NULL),
(23, 'Noel', 'CMS26KWU1FG', 3, 1, 1, NULL),
(24, 'Daquan', 'DTC75XSE3GR', 3, 1, 1, NULL),
(25, 'Jena', 'IRU51YBI7PH', 1, 1, 1, NULL),
(26, 'Geraldine', 'CER92ILI7RH', 1, 1, 1, NULL),
(27, 'MacKensie', 'LCY26EVL5QH', 3, 1, 1, NULL),
(28, 'Amela', 'PQQ53MMB2JD', 4, 1, 1, NULL),
(29, 'Dillon', 'BQG35EWE7KK', 2, 1, 1, NULL),
(30, 'Kuame', 'WIG42KBY2QG', 3, 1, 1, NULL),
(31, 'Inez', 'LFD41EJX8LT', 1, 1, 1, NULL),
(32, 'Yardley', 'BON82TKP8UL', 3, 1, 1, NULL),
(33, 'Germane', 'SMH41ING2BV', 3, 1, 1, NULL),
(34, 'Rooney', 'YNI31PYE7UH', 3, 1, 1, NULL),
(35, 'Upton', 'WMW26QDV9QP', 3, 1, 1, NULL),
(36, 'Jonas', 'YKH06QNQ9UI', 3, 1, 1, NULL),
(37, 'Kim', 'JLT18TGB9XO', 1, 1, 1, NULL),
(38, 'Liberty', 'IYK43UBU5WS', 4, 1, 1, NULL),
(39, 'Upton', 'XVT62KES0SC', 1, 1, 1, NULL),
(40, 'Shellie', 'RJK28GHH4ED', 4, 1, 1, NULL),
(41, 'Boris', 'ZKP26DNB0YJ', 2, 1, 1, NULL),
(42, 'Remedios', 'LYN54LPX6EJ', 2, 1, 1, NULL),
(43, 'Aiko', 'OXQ66XTX9PU', 3, 1, 1, NULL),
(44, 'Macy', 'IXH64XJM9GT', 1, 1, 1, NULL),
(45, 'Leslie', 'XQT63BAY1VB', 4, 1, 1, NULL),
(46, 'Peter', 'YYL28LCW0TF', 3, 1, 1, NULL),
(47, 'Mechelle', 'SOF57GTT7HD', 2, 1, 1, NULL),
(48, 'Maisie', 'NZJ18FXW2NY', 4, 1, 1, NULL),
(49, 'Steel', 'HRJ93FIN6HD', 4, 1, 1, NULL),
(50, 'Dolan', 'HEY89DLR3IU', 3, 1, 1, NULL),
(51, 'Sarah', 'IGK31BSL6QF', 1, 1, 1, NULL),
(52, 'Angelica', 'FEH46YDS4CC', 4, 1, 1, NULL),
(53, 'Mary', 'OYD32XWU1JN', 1, 1, 1, NULL),
(54, 'Eaton', 'IXP32CUB3UX', 4, 1, 1, NULL),
(55, 'Desiree', 'MGO85UXK5FG', 4, 1, 1, NULL),
(56, 'Pamela', 'SNL27XLG1PF', 3, 1, 1, NULL),
(57, 'Hyatt', 'NHI96QHI2TV', 2, 1, 1, NULL),
(58, 'Zephr', 'DPC33RPF6PG', 3, 1, 1, NULL),
(59, 'Freya', 'YNG46RZW2BW', 4, 1, 1, NULL),
(60, 'Buffy', 'QMP25LCU4VE', 4, 1, 1, NULL),
(61, 'Aiko', 'FFN65ECE3KV', 1, 1, 1, NULL),
(62, 'Joseph', 'NRQ99DGU2HC', 4, 1, 1, NULL),
(63, 'Sasha', 'EBN41IUF7XO', 4, 1, 1, NULL),
(64, 'Heather', 'LMA21NJT8ZY', 2, 1, 1, NULL),
(65, 'Clinton', 'JVC57IMH2MK', 2, 1, 1, NULL),
(66, 'Roanna', 'WSE25NPT7VN', 3, 1, 1, NULL),
(67, 'Alec', 'QJQ80JZO6OC', 2, 1, 1, NULL),
(68, 'Plato', 'SPJ63GVF3BA', 2, 1, 1, NULL),
(69, 'Lydia', 'GRB57EKD8SQ', 1, 1, 1, NULL),
(70, 'Cassandra', 'OTV88AAU5IG', 3, 1, 1, NULL),
(71, 'Candice', 'SSR16FXY7RD', 3, 1, 1, NULL),
(72, 'Travis', 'LBM28DJS8UR', 3, 1, 1, NULL),
(73, 'Lana', 'OFX18WDN9FY', 1, 1, 1, NULL),
(74, 'Otto', 'CGG42HRR2CG', 1, 1, 1, NULL),
(75, 'Steel', 'SWJ51LQQ8CF', 3, 1, 1, NULL),
(76, 'Gregory', 'FCN21GHI1FG', 4, 1, 1, NULL),
(77, 'Jena', 'PGI76VWY0VR', 1, 1, 1, NULL),
(78, 'Samuel', 'GKI07XMF8YQ', 3, 1, 1, NULL),
(79, 'Denton', 'VVP45UBH5CP', 4, 1, 1, NULL),
(80, 'Ronan', 'VRX08OQZ3VY', 2, 1, 1, NULL),
(81, 'Lysandra', 'FMI16AVS5FX', 3, 1, 1, NULL),
(82, 'Hilel', 'IXP91WUH6TR', 4, 1, 1, NULL),
(83, 'Zelda', 'BDP69UHJ0WQ', 4, 1, 1, NULL),
(84, 'Shad', 'MTY52FRW1EJ', 4, 1, 1, NULL),
(85, 'Ryan', 'IFG65GLN5XU', 3, 1, 1, NULL),
(86, 'Edward', 'ZML59OVN1RB', 3, 1, 1, NULL),
(87, 'Gloria', 'QDM81EOO9RT', 1, 1, 1, NULL),
(88, 'Tate', 'IIG22KUE3VF', 1, 1, 1, NULL),
(89, 'Lillian', 'NXI81EYP4SM', 2, 1, 1, NULL),
(90, 'Juliet', 'FOJ32MTT4HP', 1, 1, 1, NULL),
(91, 'Darrel', 'LSS36OPM1SO', 1, 1, 1, NULL),
(92, 'Mufutau', 'QTD28MPO8OD', 1, 1, 1, NULL),
(93, 'Oprah', 'BMJ74OOE5WX', 2, 1, 1, NULL),
(94, 'Silas', 'TGR44CND4MN', 3, 1, 1, NULL),
(95, 'Holmes', 'BJK17LTU6NQ', 2, 1, 1, NULL),
(96, 'Brynne', 'SYJ31UQO0KV', 2, 1, 1, NULL),
(97, 'Igor', 'FHJ44TOW6JG', 3, 1, 1, NULL),
(98, 'Lunea', 'TVF60BLE8QQ', 4, 1, 1, NULL),
(99, 'Rama', 'LQM54XOR5CP', 2, 1, 1, NULL),
(100, 'Beverly', 'EEY98EAX8LX', 2, 1, 1, NULL),
(101, 'Kieran', 'DYD03UYL2DU', 2, 1, 1, NULL),
(102, 'Testing', '$2y$10$YeFDBx3qEWPNrp6Jc.mldu2wM3ImgtnM4srTa9N9ixj', 2, 1, 1, '2023-11-25'),
(105, 'Test', '$2y$10$NU4d8zrY6hWrb1od6PwFLOW2B1urxOWNcaB3U6wcuS3', 1, 1, 1, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sectores`
--
ALTER TABLE `sectores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `sectores`
--
ALTER TABLE `sectores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
