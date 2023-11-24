-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2023 a las 04:16:09
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
  `codigo_pedido` int(11) NOT NULL,
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
(1, 20, 10, 9, 8, 7, 'Estuvo la verdad excelente todo...', NULL),
(2, 21, 5, 5, 7, 6, 'Todo ok.', NULL),
(3, 22, 6, 10, 7, 3, 'Tienen que mejorar.', NULL),
(4, 23, 4, 3, 4, 3, 'No me gusto.', NULL),
(5, 24, 7, 5, 2, 6, 'Fui con un amigo. ', NULL),
(6, 25, 4, 8, 5, 8, 'Que locura la merlusa!', NULL),
(7, 1, 9, 8, 7, 6, 'Todo ok por el momento.', '2023-11-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `fecha_baja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `estado`, `fecha_baja`) VALUES
(1, 1, NULL),
(2, 1, NULL),
(3, 1, NULL),
(4, 1, NULL),
(5, 1, NULL),
(6, 1, NULL),
(7, 1, NULL),
(8, 1, NULL),
(9, 1, NULL),
(10, 1, NULL),
(11, 0, '2023-11-23');

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
  `nombre_cliente` varchar(50) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `estado` varchar(50) NOT NULL,
  `fecha_baja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `codigo_pedido`, `id_producto`, `id_mesa`, `id_usuario`, `nombre_cliente`, `descripcion`, `foto`, `estado`, `fecha_baja`) VALUES
(1, 'Qud25', 5, 1, NULL, 'Leah Castro', NULL, NULL, 'pendiente', NULL),
(2, 'Qud25', 9, 1, NULL, 'Natalie Atlas', NULL, NULL, 'pendiente', NULL),
(3, 'Qud25', 5, 1, NULL, 'Uta Carolina', NULL, NULL, 'pendiente', NULL),
(4, 'OiQ1h', 2, 2, NULL, 'Beatrice Espinoza', NULL, NULL, 'pendiente', NULL),
(5, 'OiQ1h', 12, 2, NULL, 'Beck Flores', NULL, NULL, 'pendiente', NULL),
(6, 'OiQ1h', 7, 2, NULL, 'Zeph Nicolas', NULL, NULL, 'pendiente', NULL),
(7, '4Bev7', 8, 3, NULL, 'Martha Sepulveda', NULL, NULL, 'pendiente', NULL),
(8, '4Bev7', 13, 3, NULL, 'Gregory Silva', NULL, NULL, 'pendiente', NULL),
(9, '4Bev7', 15, 3, NULL, 'Prescott Trinidad', NULL, NULL, 'pendiente', NULL),
(10, '9lTBs', 2, 4, NULL, 'Rashad Maximiliano', NULL, NULL, 'pendiente', NULL),
(11, '9lTBs', 4, 4, NULL, 'Idona Alexandra', NULL, NULL, 'pendiente', NULL),
(12, '9lTBs', 17, 4, NULL, 'Lani Rocio', NULL, NULL, 'pendiente', NULL),
(13, 'rnePW', 11, 5, NULL, 'Elton Soto', NULL, NULL, 'pendiente', NULL),
(14, 'rnePW', 7, 5, NULL, 'Carla Testudines', NULL, NULL, 'pendiente', NULL),
(15, 'rnePW', 12, 5, NULL, 'Noah Herrera', NULL, NULL, 'pendiente', NULL),
(16, 'NKOTn', 11, 6, NULL, 'Honorato Flores', NULL, NULL, 'pendiente', NULL),
(17, 'NKOTn', 3, 6, NULL, 'Uma Vasquez', NULL, NULL, 'pendiente', NULL),
(18, 'NKOTn', 7, 6, NULL, 'Nora Soto', NULL, NULL, 'pendiente', NULL),
(19, 'DoEUa', 15, 7, NULL, 'Merrill Fernanda', NULL, NULL, 'pendiente', NULL),
(20, 'DoEUa', 9, 7, NULL, 'William Alexandra', NULL, NULL, 'pendiente', NULL),
(21, 'DoEUa', 10, 7, NULL, 'Baxter Sofia', NULL, NULL, 'pendiente', NULL),
(22, 'nrqCM', 4, 8, NULL, 'Yen Trinidad', NULL, NULL, 'pendiente', NULL),
(23, 'nrqCM', 6, 8, NULL, 'Madonna Camila', NULL, NULL, 'pendiente', NULL),
(24, 'nrqCM', 2, 8, NULL, 'Cheryl Perez', NULL, NULL, 'pendiente', NULL),
(25, 'avdcy', 8, 9, NULL, 'Ocean Herrera', NULL, NULL, 'pendiente', NULL),
(26, 'avdcy', 2, 9, NULL, 'Eleanor Felipe', NULL, NULL, 'pendiente', NULL),
(27, 'avdcy', 15, 9, NULL, 'Kato Florencia', NULL, NULL, 'pendiente', NULL),
(28, 'pPU58', 16, 10, NULL, 'Sigourney Luis', NULL, NULL, 'pendiente', NULL),
(29, 'pPU58', 12, 10, NULL, 'Maggie Joaquin', NULL, NULL, 'pendiente', NULL),
(30, 'pPU58', 4, 10, NULL, 'Sydney Gabriel', NULL, NULL, 'pendiente', NULL),
(31, 'szWS8', 18, 11, NULL, 'Stacy Tapia', NULL, NULL, 'pendiente', NULL),
(32, 'szWS8', 10, 11, NULL, 'September Maximiliano', NULL, NULL, 'pendiente', NULL),
(33, 'szWS8', 7, 11, NULL, 'Harding Bentlee', NULL, NULL, 'pendiente', NULL),
(34, 'sWkvj', 3, 12, NULL, 'Shelly Isabella', NULL, NULL, 'pendiente', NULL),
(35, 'sWkvj', 14, 12, NULL, 'Axel Monserrat', NULL, NULL, 'pendiente', NULL),
(36, 'sWkvj', 10, 12, NULL, 'Martina Chichi', NULL, NULL, 'pendiente', NULL),
(37, 'jMcET', 15, 13, NULL, 'Oliver Bentlee', NULL, NULL, 'pendiente', NULL),
(38, 'jMcET', 9, 13, NULL, 'Karen Tomas', NULL, NULL, 'pendiente', NULL),
(39, 'jMcET', 13, 13, NULL, 'Jeremy Figueroa', NULL, NULL, 'pendiente', NULL),
(40, 'a03g1', 6, 14, NULL, 'Kirestin Vera', NULL, NULL, 'pendiente', NULL),
(41, 'a03g1', 10, 14, NULL, 'Flavia Hernandez', NULL, NULL, 'pendiente', NULL),
(42, 'a03g1', 6, 14, NULL, 'Jack Torres', NULL, NULL, 'pendiente', NULL),
(43, 'KyaP7', 5, 15, NULL, 'Erica Castillo', NULL, NULL, 'pendiente', NULL),
(44, 'KyaP7', 8, 15, NULL, 'Bianca Castillo', NULL, NULL, 'pendiente', NULL),
(45, 'KyaP7', 1, 15, NULL, 'Roary Araya', NULL, NULL, 'pendiente', NULL),
(46, 'DSk3T', 6, 16, NULL, 'Jade Testudines', NULL, NULL, 'pendiente', NULL),
(47, 'DSk3T', 8, 16, NULL, 'Arden Joaquin', NULL, NULL, 'pendiente', NULL),
(48, 'DSk3T', 10, 16, NULL, 'Malachi Reyes', NULL, NULL, 'pendiente', NULL),
(49, 'BKcbd', 9, 17, NULL, 'Brenna Flores', NULL, NULL, 'pendiente', NULL),
(50, 'BKcbd', 5, 17, NULL, 'Violet Laura', NULL, NULL, 'pendiente', NULL),
(51, 'BKcbd', 17, 17, NULL, 'Jin Vega', NULL, NULL, 'pendiente', NULL),
(52, 'Lh2i0', 14, 18, NULL, 'Davis Cristobal', NULL, NULL, 'pendiente', NULL),
(53, 'Lh2i0', 15, 18, NULL, 'Stephanie Rocio', NULL, NULL, 'pendiente', NULL),
(54, 'Lh2i0', 16, 18, NULL, 'Justine Bastian', NULL, NULL, 'pendiente', NULL),
(55, 'HlQTy', 12, 19, NULL, 'Edward Tapia', NULL, NULL, 'pendiente', NULL),
(56, 'HlQTy', 14, 19, NULL, 'Carly Camila', NULL, NULL, 'pendiente', NULL),
(57, 'HlQTy', 6, 19, NULL, 'Kiayada Ramirez', NULL, NULL, 'pendiente', NULL),
(58, 'ghfeF', 13, 20, NULL, 'Nina Diaz', NULL, NULL, 'pendiente', NULL),
(59, 'ghfeF', 5, 20, NULL, 'Grant Fernandez', NULL, NULL, 'pendiente', NULL),
(60, 'ghfeF', 5, 20, NULL, 'Bert Magdalena', NULL, NULL, 'pendiente', NULL),
(61, 'dpmxq', 6, 21, NULL, 'Britanney Vega', NULL, NULL, 'pendiente', NULL),
(62, 'dpmxq', 3, 21, NULL, 'Anthony Araya', NULL, NULL, 'pendiente', NULL),
(63, 'dpmxq', 11, 21, NULL, 'Lyle Jara', NULL, NULL, 'pendiente', NULL),
(64, 'yFSdm', 15, 22, NULL, 'Paloma Matias', NULL, NULL, 'pendiente', NULL),
(65, 'yFSdm', 2, 22, NULL, 'Keiko Jara', NULL, NULL, 'pendiente', NULL),
(66, 'yFSdm', 2, 22, NULL, 'Guy Luis', NULL, NULL, 'pendiente', NULL),
(67, 'xjoJQ', 5, 23, NULL, 'Mary Julieta', NULL, NULL, 'pendiente', NULL),
(68, 'xjoJQ', 15, 23, NULL, 'Ima Rivera', NULL, NULL, 'pendiente', NULL),
(69, 'xjoJQ', 14, 23, NULL, 'Sandra Vicente', NULL, NULL, 'pendiente', NULL),
(70, '7wfYz', 2, 24, NULL, 'Phelan Gutierrez', NULL, NULL, 'pendiente', NULL),
(71, '7wfYz', 3, 24, NULL, 'Lana Paula', NULL, NULL, 'pendiente', NULL),
(72, '7wfYz', 16, 24, NULL, 'Denton Perez', NULL, NULL, 'pendiente', NULL),
(73, '1wAr5', 14, 25, NULL, 'Griffin Martina', NULL, NULL, 'pendiente', NULL),
(74, '1wAr5', 5, 25, NULL, 'Donovan Cristobal', NULL, NULL, 'pendiente', NULL),
(75, '1wAr5', 5, 25, NULL, 'Frances Ignacio', NULL, NULL, 'pendiente', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `tipo_id`, `precio`, `stock`, `estado`, `fecha_creacion`, `fecha_modificacion`, `fecha_baja`) VALUES
(1, 'Pizza', 1, 22274, 99, 1, '2023-11-12', NULL, NULL),
(2, 'Pastas', 1, 20092, 22, 1, '2023-11-12', NULL, NULL),
(3, 'Empanadas', 1, 4153, 76, 1, '2023-11-12', NULL, NULL),
(4, 'Milanesas', 1, 3338, 42, 1, '2023-11-12', NULL, NULL),
(5, 'Omelette', 1, 21011, 55, 1, '2023-11-12', NULL, NULL),
(6, 'Sandwich', 1, 6840, 5, 1, '2023-11-12', NULL, NULL),
(7, 'Vino', 2, 19687, 32, 1, '2023-11-12', NULL, NULL),
(8, 'Soda', 2, 3737, 31, 1, '2023-11-12', NULL, NULL),
(9, 'Gaseosa', 2, 21791, 78, 1, '2023-11-12', NULL, NULL),
(10, 'Monster', 2, 2072, 93, 1, '2023-11-12', NULL, NULL),
(11, 'Agua', 2, 10641, 78, 1, '2023-11-12', NULL, NULL),
(12, 'Cerveza blanca', 3, 18503, 56, 1, '2023-11-12', NULL, NULL),
(13, 'Cerveza rubia', 3, 22924, 65, 1, '2023-11-12', NULL, NULL),
(14, 'Helado', 4, 24816, 54, 1, '2023-11-12', NULL, NULL),
(15, 'Pastel', 4, 24348, 82, 1, '2023-11-12', NULL, NULL),
(16, 'Tarta', 4, 15938, 83, 1, '2023-11-12', NULL, NULL),
(17, 'Bombon', 4, 7093, 45, 1, '2023-11-12', NULL, NULL),
(18, 'Alfajor', 4, 7277, 4, 1, '2023-11-12', NULL, NULL),
(19, 'Pure con milanesas', 1, 6500, 70014, 1, '2023-11-14', '2023-11-14', '2023-11-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sector`
--

CREATE TABLE `sector` (
  `id` int(11) NOT NULL,
  `detalle` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sector`
--

INSERT INTO `sector` (`id`, `detalle`) VALUES
(1, 'Cocinero'),
(2, 'Bartender'),
(3, 'Cervecero'),
(4, 'Candy Bar');

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
  `sector` varchar(25) NOT NULL,
  `prioridad` int(1) NOT NULL,
  `fecha_baja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `sector`, `prioridad`, `fecha_baja`) VALUES
(1, 'admin', 'admin', 'admin', 3, NULL),
(2, 'Cairo', 'KUF53QYT3TL', 'bartender', 1, NULL),
(3, 'Ina', 'XSU83MPV5FU', 'cervecero', 1, NULL),
(4, 'Marvin', 'WUW10BNG6WK', 'cocinero', 1, NULL),
(5, 'Venus', 'ZEX43IBW3FJ', 'mozo', 1, NULL),
(6, 'Irene', 'RWK09SMM2YX', 'bartender', 1, NULL),
(7, 'Jane', 'QOI44VHL5UX', 'cervecero', 1, NULL),
(8, 'Walter', 'FQI61KWJ0DT', 'cocinero', 1, NULL),
(9, 'Vivian', 'EYL82MQP2LL', 'mozo', 1, NULL),
(10, 'Nelle', 'HGZ57PRN5YT', 'bartender', 1, NULL),
(11, 'Nathan', 'SSL33SRS4JG', 'cervecero', 1, NULL),
(12, 'Pascale', 'OQT09LBW2QX', 'cocinero', 1, NULL),
(13, 'Cassandra', 'RMD84EPR4ED', 'mozo', 1, NULL),
(14, 'Uta', 'UUK88HJM4FU', 'bartender', 1, NULL),
(15, 'Mira', 'PYP42NDD1BM', 'cervecero', 1, NULL),
(16, 'Paula', 'ZLZ54CPH8KW', 'cocinero', 1, NULL),
(17, 'Gannon', 'OVM28JEZ3ID', 'mozo', 1, NULL),
(18, 'Jacqueline', 'CDT50FUY4GG', 'bartender', 1, NULL),
(19, 'Vernon', 'HUU64MBB8YE', 'cervecero', 1, NULL),
(20, 'Cailin', 'OLP67INN2UI', 'cocinero', 1, NULL),
(21, 'Alika', 'CFN96ASY2WO', 'mozo', 1, NULL),
(22, 'Tallulah', 'WRJ35KRU8VK', 'bartender', 1, NULL),
(23, 'Noel', 'CMS26KWU1FG', 'cervecero', 1, NULL),
(24, 'Daquan', 'DTC75XSE3GR', 'cocinero', 1, NULL),
(25, 'Jena', 'IRU51YBI7PH', 'mozo', 1, NULL),
(26, 'Geraldine', 'CER92ILI7RH', 'bartender', 1, NULL),
(27, 'MacKensie', 'LCY26EVL5QH', 'cervecero', 1, NULL),
(28, 'Amela', 'PQQ53MMB2JD', 'cocinero', 1, NULL),
(29, 'Dillon', 'BQG35EWE7KK', 'mozo', 1, NULL),
(30, 'Kuame', 'WIG42KBY2QG', 'bartender', 1, NULL),
(31, 'Inez', 'LFD41EJX8LT', 'cervecero', 1, NULL),
(32, 'Yardley', 'BON82TKP8UL', 'cocinero', 1, NULL),
(33, 'Germane', 'SMH41ING2BV', 'mozo', 1, NULL),
(34, 'Rooney', 'YNI31PYE7UH', 'bartender', 1, NULL),
(35, 'Upton', 'WMW26QDV9QP', 'cervecero', 1, NULL),
(36, 'Jonas', 'YKH06QNQ9UI', 'cocinero', 1, NULL),
(37, 'Kim', 'JLT18TGB9XO', 'mozo', 1, NULL),
(38, 'Liberty', 'IYK43UBU5WS', 'bartender', 1, NULL),
(39, 'Upton', 'XVT62KES0SC', 'cervecero', 1, NULL),
(40, 'Shellie', 'RJK28GHH4ED', 'cocinero', 1, NULL),
(41, 'Boris', 'ZKP26DNB0YJ', 'mozo', 1, NULL),
(42, 'Remedios', 'LYN54LPX6EJ', 'bartender', 1, NULL),
(43, 'Aiko', 'OXQ66XTX9PU', 'cervecero', 1, NULL),
(44, 'Macy', 'IXH64XJM9GT', 'cocinero', 1, NULL),
(45, 'Leslie', 'XQT63BAY1VB', 'mozo', 1, NULL),
(46, 'Peter', 'YYL28LCW0TF', 'bartender', 1, NULL),
(47, 'Mechelle', 'SOF57GTT7HD', 'cervecero', 1, NULL),
(48, 'Maisie', 'NZJ18FXW2NY', 'cocinero', 1, NULL),
(49, 'Steel', 'HRJ93FIN6HD', 'mozo', 1, NULL),
(50, 'Dolan', 'HEY89DLR3IU', 'bartender', 1, NULL),
(51, 'Sarah', 'IGK31BSL6QF', 'cervecero', 1, NULL),
(52, 'Angelica', 'FEH46YDS4CC', 'cocinero', 1, NULL),
(53, 'Mary', 'OYD32XWU1JN', 'mozo', 1, NULL),
(54, 'Eaton', 'IXP32CUB3UX', 'bartender', 1, NULL),
(55, 'Desiree', 'MGO85UXK5FG', 'cervecero', 1, NULL),
(56, 'Pamela', 'SNL27XLG1PF', 'cocinero', 1, NULL),
(57, 'Hyatt', 'NHI96QHI2TV', 'mozo', 1, NULL),
(58, 'Zephr', 'DPC33RPF6PG', 'bartender', 1, NULL),
(59, 'Freya', 'YNG46RZW2BW', 'cervecero', 1, NULL),
(60, 'Buffy', 'QMP25LCU4VE', 'cocinero', 1, NULL),
(61, 'Aiko', 'FFN65ECE3KV', 'mozo', 1, NULL),
(62, 'Joseph', 'NRQ99DGU2HC', 'bartender', 1, NULL),
(63, 'Sasha', 'EBN41IUF7XO', 'cervecero', 1, NULL),
(64, 'Heather', 'LMA21NJT8ZY', 'cocinero', 1, NULL),
(65, 'Clinton', 'JVC57IMH2MK', 'mozo', 1, NULL),
(66, 'Roanna', 'WSE25NPT7VN', 'bartender', 1, NULL),
(67, 'Alec', 'QJQ80JZO6OC', 'cervecero', 1, NULL),
(68, 'Plato', 'SPJ63GVF3BA', 'cocinero', 1, NULL),
(69, 'Lydia', 'GRB57EKD8SQ', 'mozo', 1, NULL),
(70, 'Cassandra', 'OTV88AAU5IG', 'bartender', 1, NULL),
(71, 'Candice', 'SSR16FXY7RD', 'cervecero', 1, NULL),
(72, 'Travis', 'LBM28DJS8UR', 'cocinero', 1, NULL),
(73, 'Lana', 'OFX18WDN9FY', 'mozo', 1, NULL),
(74, 'Otto', 'CGG42HRR2CG', 'bartender', 1, NULL),
(75, 'Steel', 'SWJ51LQQ8CF', 'cervecero', 1, NULL),
(76, 'Gregory', 'FCN21GHI1FG', 'cocinero', 1, NULL),
(77, 'Jena', 'PGI76VWY0VR', 'mozo', 1, NULL),
(78, 'Samuel', 'GKI07XMF8YQ', 'bartender', 1, NULL),
(79, 'Denton', 'VVP45UBH5CP', 'cervecero', 1, NULL),
(80, 'Ronan', 'VRX08OQZ3VY', 'cocinero', 1, NULL),
(81, 'Lysandra', 'FMI16AVS5FX', 'mozo', 1, NULL),
(82, 'Hilel', 'IXP91WUH6TR', 'bartender', 1, NULL),
(83, 'Zelda', 'BDP69UHJ0WQ', 'cervecero', 1, NULL),
(84, 'Shad', 'MTY52FRW1EJ', 'cocinero', 1, NULL),
(85, 'Ryan', 'IFG65GLN5XU', 'mozo', 1, NULL),
(86, 'Edward', 'ZML59OVN1RB', 'bartender', 1, NULL),
(87, 'Gloria', 'QDM81EOO9RT', 'cervecero', 1, NULL),
(88, 'Tate', 'IIG22KUE3VF', 'cocinero', 1, NULL),
(89, 'Lillian', 'NXI81EYP4SM', 'mozo', 1, NULL),
(90, 'Juliet', 'FOJ32MTT4HP', 'bartender', 1, NULL),
(91, 'Darrel', 'LSS36OPM1SO', 'cervecero', 1, NULL),
(92, 'Mufutau', 'QTD28MPO8OD', 'cocinero', 1, NULL),
(93, 'Oprah', 'BMJ74OOE5WX', 'mozo', 1, NULL),
(94, 'Silas', 'TGR44CND4MN', 'bartender', 1, NULL),
(95, 'Holmes', 'BJK17LTU6NQ', 'cervecero', 1, NULL),
(96, 'Brynne', 'SYJ31UQO0KV', 'cocinero', 1, NULL),
(97, 'Igor', 'FHJ44TOW6JG', 'mozo', 1, NULL),
(98, 'Lunea', 'TVF60BLE8QQ', 'bartender', 1, NULL),
(99, 'Rama', 'LQM54XOR5CP', 'cervecero', 1, NULL),
(100, 'Beverly', 'EEY98EAX8LX', 'cocinero', 1, NULL),
(101, 'Kieran', 'DYD03UYL2DU', 'mozo', 1, NULL),
(102, 'Testing', 'test123', 'cocinero', 1, '2023-11-11');

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
-- Indices de la tabla `sector`
--
ALTER TABLE `sector`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `sector`
--
ALTER TABLE `sector`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
