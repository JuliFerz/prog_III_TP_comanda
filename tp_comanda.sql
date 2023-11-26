-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2023 a las 05:46:01
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
(1, 'Qud25', 5, 1, 7, 55, 'Leah Castro', NULL, 'Qud25_1_LeahNatalieUta.png', 1, 'listo para servir', '2023-11-25'),
(2, 'Qud25', 9, 1, 11, 55, 'Natalie Atlas', NULL, 'Qud25_1_LeahNatalieUta.png', 1, 'listo para servir', '2023-11-25'),
(3, 'Qud25', 5, 1, 105, 55, 'Uta Carolina', NULL, 'Qud25_1_LeahNatalieUta.png', 1, 'listo para servir', '2023-11-25'),
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
(1, 'cocinero', NULL),
(2, 'bartender', NULL),
(3, 'cervecero', NULL),
(4, 'mozo', NULL),
(5, 'socio', NULL),
(6, 'admin', NULL),
(7, 'cliente', NULL);

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
  `clave` varchar(150) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `id_sector` int(11) NOT NULL,
  `prioridad` int(1) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `fecha_baja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `nombre`, `apellido`, `correo`, `id_sector`, `prioridad`, `estado`, `fecha_baja`) VALUES
(1, 'admin', '$2y$10$Da0Cipt6jin4t4/ZtNFCm.zZZ1OccDJ3Oa3Pv67uoxk9lvumMB6Jy', 'Julian', 'Fernandez', 'admin@gmail.com', 6, 3, 1, NULL),
(2, 'chandler', 'clave1', 'Clayton', 'Maximo', 'amet.ultricies@aol.net', 3, 1, 1, NULL),
(3, 'malik', 'clave2', 'Ferdinand', 'Figueroa', 'aliquam.erat.volutpat@google.net', 3, 1, 1, NULL),
(4, 'travis', 'clave3', 'Jamal', 'Ignacio', 'aliquet.sem.ut@protonmail.com', 3, 1, 1, NULL),
(5, 'anne', 'clave4', 'Aaron', 'Alonsos', 'lacus@yahoo.com', 2, 1, 1, NULL),
(6, 'eve', 'clave5', 'Salvador', 'Figueroa', 'in.ornare@protonmail.com', 4, 1, 1, NULL),
(7, 'adria', 'clave6', 'Miranda', 'Vargas', 'cum.sociis@google.org', 1, 1, 1, NULL),
(8, 'yuli', 'clave7', 'Rigel', 'Gonzalez', 'vulputate@protonmail.ca', 2, 1, 1, NULL),
(9, 'urielle', 'clave8', 'Melvin', 'Rojas', 'nibh.phasellus@outlook.edu', 3, 1, 1, NULL),
(10, 'risa', 'clave9', 'Karly', 'Perez', 'dapibus.quam.quis@outlook.net', 3, 1, 1, NULL),
(11, 'lucius', 'clave10', 'Avye', 'Felipe', 'nec.malesuada@google.net', 1, 1, 1, NULL),
(12, 'george', 'clave11', 'Lewis', 'Emilia', 'ligula.elit@google.com', 3, 1, 1, NULL),
(13, 'macey', 'clave12', 'Todd', 'Paz', 'vel.est.tempor@aol.couk', 1, 1, 1, NULL),
(14, 'dexter', 'clave13', 'Kim', 'Figueroa', 'fermentum.vel.mauris@outlook.ca', 4, 1, 1, NULL),
(15, 'quemby', 'clave14', 'Andrew', 'Daniel', 'nibh@hotmail.com', 1, 1, 1, NULL),
(16, 'selma', 'clave15', 'Lacey', 'Valentina', 'iaculis.odio@protonmail.couk', 2, 1, 1, NULL),
(17, 'candace', 'clave16', 'Tucker', 'Maria', 'nulla.magna@icloud.couk', 1, 1, 1, NULL),
(18, 'lacy', 'clave17', 'Travis', 'Joaquin', 'nec.mollis@protonmail.org', 3, 1, 1, NULL),
(19, 'elvis', 'clave18', 'Driscoll', 'Vergara', 'egestas.fusce@protonmail.edu', 3, 1, 1, NULL),
(20, 'dominic', 'clave19', 'Kirby', 'Chichi', 'molestie.tellus.aenean@protonmail.com', 4, 1, 1, NULL),
(21, 'jaquelyn', 'clave20', 'Dale', 'Laura', 'arcu.vivamus@yahoo.couk', 2, 1, 1, NULL),
(22, 'judith', 'clave21', 'Ava', 'Gonzalez', 'non.nisi.aenean@outlook.org', 1, 1, 1, NULL),
(23, 'halee', 'clave22', 'Francis', 'Vega', 'elit@icloud.couk', 3, 1, 1, NULL),
(24, 'april', 'clave23', 'Kylan', 'Contreras', 'purus@aol.couk', 3, 1, 1, NULL),
(25, 'kevyn', 'clave24', 'Xavier', 'Silva', 'nunc.sed@aol.couk', 1, 1, 1, NULL),
(26, 'eaton', 'clave25', 'Gage', 'Sebastian', 'natoque.penatibus@google.ca', 1, 1, 1, NULL),
(27, 'cheryl', 'clave26', 'Rebecca', 'Espinoza', 'luctus.aliquet@hotmail.net', 3, 1, 1, NULL),
(28, 'anne', 'clave27', 'Audra', 'Isabella', 'massa.mauris@google.edu', 4, 1, 1, NULL),
(29, 'elvis', 'clave28', 'Minerva', 'Felipe', 'ipsum.dolor.sit@hotmail.net', 2, 1, 1, NULL),
(30, 'clementine', 'clave29', 'Aileen', 'Figueroa', 'curabitur.sed@icloud.ca', 3, 1, 1, NULL),
(31, 'gabriel', 'clave30', 'Bevis', 'Ignacio', 'amet@protonmail.edu', 1, 1, 1, NULL),
(32, 'wilma', 'clave31', 'Gannon', 'Sofia', 'eget.tincidunt@outlook.edu', 3, 1, 1, NULL),
(33, 'edan', 'clave32', 'Nathan', 'Luis', 'cursus.purus@protonmail.couk', 3, 1, 1, NULL),
(34, 'jasmine', 'clave33', 'Conan', 'Florencia', 'ultricies@google.ca', 3, 1, 1, NULL),
(35, 'wade', 'clave34', 'Rhea', 'Azizi', 'nostra@aol.ca', 3, 1, 1, NULL),
(36, 'magee', 'clave35', 'Timon', 'Monserrat', 'mollis.nec.cursus@aol.com', 3, 1, 1, NULL),
(37, 'fallon', 'clave36', 'Kelsie', 'Reyes', 'orci.luctus.et@aol.org', 1, 1, 1, NULL),
(38, 'jerry', 'clave37', 'Owen', 'Gonzalez', 'eget.mollis@outlook.couk', 4, 1, 1, NULL),
(39, 'anjolie', 'clave38', 'Kyle', 'Vera', 'metus.sit@outlook.org', 1, 1, 1, NULL),
(40, 'brittany', 'clave39', 'Claire', 'Sepulveda', 'neque@icloud.com', 4, 1, 1, NULL),
(41, 'mercedes', 'clave40', 'Clarke', 'Carrasco', 'ultricies.ornare.elit@icloud.org', 2, 1, 1, NULL),
(42, 'juliet', 'clave41', 'Ishmael', 'Rodriguez', 'erat@hotmail.edu', 2, 1, 1, NULL),
(43, 'maryam', 'clave42', 'Octavius', 'Magdalena', 'tristique@protonmail.net', 3, 1, 1, NULL),
(44, 'fatima', 'clave43', 'Giselle', 'Bravo', 'consectetuer@protonmail.edu', 1, 1, 1, NULL),
(45, 'naomi', 'clave44', 'Brooke', 'Lopez', 'purus.sapien@google.edu', 4, 1, 1, NULL),
(46, 'ifeoma', 'clave45', 'Iliana', 'Martina', 'per.inceptos@aol.edu', 3, 1, 1, NULL),
(47, 'evan', 'clave46', 'Bo', 'Thiarre', 'mollis@google.edu', 2, 1, 1, NULL),
(48, 'julian', 'clave47', 'Kylie', 'Alvarez', 'mauris@google.com', 4, 1, 1, NULL),
(49, 'alma', 'clave48', 'Cullen', 'Augustin', 'orci.consectetuer@google.com', 4, 1, 1, NULL),
(50, 'clayton', 'clave49', 'Vladimir', 'Fernanda', 'neque@protonmail.edu', 3, 1, 1, NULL),
(51, 'reagan', 'clave50', 'Kevin', 'Vicente', 'turpis.vitae@hotmail.com', 1, 1, 1, NULL),
(52, 'abel', 'clave51', 'Alexandra', 'Trinidad', 'donec.tincidunt@protonmail.com', 4, 1, 1, NULL),
(53, 'rahim', 'clave52', 'Jonas', 'Gomez', 'amet.lorem@yahoo.ca', 1, 1, 1, NULL),
(54, 'alma', 'clave53', 'Jenna', 'Trinidad', 'felis.donec@google.net', 4, 1, 1, NULL),
(55, 'phelan', 'clave54', 'Stewart', 'Perez', 'non.enim@aol.ca', 4, 1, 1, NULL),
(56, 'aileen', 'clave55', 'Christian', 'Daniel', 'lorem.ac@hotmail.edu', 3, 1, 1, NULL),
(57, 'shea', 'clave56', 'Martin', 'Diem', 'amet@icloud.org', 2, 1, 1, NULL),
(58, 'colorado', 'clave57', 'Roanna', 'Zavala', 'sit.amet@protonmail.couk', 3, 1, 1, NULL),
(59, 'grant', 'clave58', 'Signe', 'Sebastian', 'nulla.aliquet.proin@icloud.com', 4, 1, 1, NULL),
(60, 'brendan', 'clave59', 'Richard', 'Martin', 'semper@outlook.couk', 4, 1, 1, NULL),
(61, 'linus', 'clave60', 'Willow', 'Fernanda', 'nisi.nibh.lacinia@hotmail.ca', 1, 1, 1, NULL),
(62, 'nissim', 'clave61', 'Zahir', 'Araya', 'nulla.eget@yahoo.net', 4, 1, 1, NULL),
(63, 'olympia', 'clave62', 'Tara', 'Chichi', 'sapien.gravida@outlook.org', 4, 1, 1, NULL),
(64, 'eve', 'clave63', 'Xyla', 'Javier', 'phasellus@aol.com', 2, 1, 1, NULL),
(65, 'stacey', 'clave64', 'Evelyn', 'Araya', 'praesent.interdum@icloud.ca', 2, 1, 1, NULL),
(66, 'camilla', 'clave65', 'Kirk', 'Vera', 'pellentesque.ut.ipsum@outlook.org', 3, 1, 1, NULL),
(67, 'mariam', 'clave66', 'Piper', 'Carla', 'velit.quisque@hotmail.org', 2, 1, 1, NULL),
(68, 'nadine', 'clave67', 'Leandra', 'Soto', 'tortor.nibh@protonmail.com', 2, 1, 1, NULL),
(69, 'honorato', 'clave68', 'Winifred', 'Valentina', 'in.mi@icloud.net', 1, 1, 1, NULL),
(70, 'iliana', 'clave69', 'Audrey', 'Maximiliano', 'cursus.a@icloud.com', 3, 1, 1, NULL),
(71, 'jasmine', 'clave70', 'Hope', 'Miranda', 'porttitor.eros.nec@hotmail.com', 3, 1, 1, NULL),
(72, 'garrett', 'clave71', 'Kibo', 'Hernandez', 'integer.sem.elit@hotmail.edu', 3, 1, 1, NULL),
(73, 'vivian', 'clave72', 'Kyra', 'Vega', 'integer@google.org', 1, 1, 1, NULL),
(74, 'joy', 'clave73', 'Herman', 'Augustin', 'bibendum.donec@google.couk', 1, 1, 1, NULL),
(75, 'cameron', 'clave74', 'Malachi', 'Alexandra', 'non.dapibus@yahoo.ca', 3, 1, 1, NULL),
(76, 'hall', 'clave75', 'Chase', 'Vergara', 'vivamus.rhoncus@outlook.org', 4, 1, 1, NULL),
(77, 'althea', 'clave76', 'Burton', 'Rojas', 'donec.fringilla.donec@aol.org', 1, 1, 1, NULL),
(78, 'maile', 'clave77', 'Hayfa', 'Cortes', 'non.ante@icloud.couk', 3, 1, 1, NULL),
(79, 'clementine', 'clave78', 'Regan', 'Tapia', 'lacinia.mattis@google.edu', 4, 1, 1, NULL),
(80, 'kadeem', 'clave79', 'Geoffrey', 'Diem', 'mauris.nulla.integer@icloud.ca', 2, 1, 1, NULL),
(81, 'kiona', 'clave80', 'Wade', 'Gonzalez', 'turpis.egestas.fusce@outlook.couk', 3, 1, 1, NULL),
(82, 'amelia', 'clave81', 'Carson', 'Alvarez', 'non.luctus@icloud.ca', 4, 1, 1, NULL),
(83, 'jackson', 'clave82', 'Marsden', 'Barbara', 'phasellus@outlook.org', 4, 1, 1, NULL),
(84, 'mallory', 'clave83', 'Kylynn', 'Diego', 'sem.egestas@aol.net', 4, 1, 1, NULL),
(85, 'summer', 'clave84', 'Keane', 'Chichi', 'non.dui.nec@protonmail.com', 3, 1, 1, NULL),
(86, 'kessie', 'clave85', 'Stella', 'Alexandra', 'cras.eu.tellus@outlook.org', 3, 1, 1, NULL),
(87, 'zelenia', 'clave86', 'Mikayla', 'Zavala', 'ac.orci.ut@outlook.net', 1, 1, 1, NULL),
(88, 'angela', 'clave87', 'Mercedes', 'Gonzalez', 'et.magnis.dis@icloud.ca', 1, 1, 1, NULL),
(89, 'jolie', 'clave88', 'Yoko', 'Hernandez', 'nascetur.ridiculus@icloud.ca', 2, 1, 1, NULL),
(90, 'rose', 'clave89', 'Evangeline', 'Martina', 'amet@aol.org', 1, 1, 1, NULL),
(91, 'pascale', 'clave90', 'Ivory', 'Pascal', 'cum.sociis.natoque@protonmail.edu', 1, 1, 1, NULL),
(92, 'harrison', 'clave91', 'Elaine', 'Valentina', 'duis.at@google.couk', 1, 1, 1, NULL),
(93, 'len', 'clave92', 'Marsden', 'Francisco', 'phasellus.dapibus.quam@google.com', 2, 1, 1, NULL),
(94, 'macey', 'clave93', 'Donovan', 'Cortes', 'elit.etiam@hotmail.edu', 3, 1, 1, NULL),
(95, 'lael', 'clave94', 'Amena', 'Thiarre', 'aliquam.eu.accumsan@aol.net', 2, 1, 1, NULL),
(96, 'inga', 'clave95', 'Barrett', 'Camila', 'donec.felis@aol.ca', 2, 1, 1, NULL),
(97, 'winter', 'clave96', 'Paula', 'Sofia', 'magna@protonmail.org', 3, 1, 1, NULL),
(98, 'mara', 'clave97', 'Carolyn', 'Jose', 'enim.nisl.elementum@hotmail.couk', 4, 1, 1, NULL),
(99, 'penelope', 'clave98', 'Wesley', 'Rocio', 'mollis.phasellus@protonmail.ca', 2, 1, 1, NULL),
(100, 'murphy', 'clave99', 'Ryder', 'Valentina', 'ullamcorper@aol.com', 2, 1, 1, NULL),
(101, 'tashya', 'clave100', 'Lucian', 'Gomez', 'ac.fermentum@outlook.ca', 2, 1, 1, NULL),
(102, 'Test', '$2y$10$e69edooswhhpM.CfZ/x.LeCX4Y9OK3gPC3U42Ot/E7P', 'Julian', 'Fernandez', 'correo@test.com', 1, 1, 1, NULL),
(103, 'test', '$2y$10$cjhHTPY82PMjlgzlCpuobOKpMbXrWnSaGr3ka0m3FmkUmY/VgOkj.', 'NombreTest', 'ApellidoTest', 'correo@test.com', 1, 1, 1, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
