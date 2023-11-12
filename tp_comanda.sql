-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2023 a las 01:46:08
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
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `id` int(5) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `foto_mesa` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`id`, `estado`, `foto_mesa`) VALUES
(1, 0, '/test.png'),
(2, 1, '/test2.png'),
(3, 1, '/test3.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `codigo_pedido` int(5) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre_cliente` varchar(50) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `codigo_pedido`, `id_mesa`, `id_usuario`, `nombre_cliente`, `descripcion`, `estado`) VALUES
(1, 1000, 1, 72, 'Kasper Alonsos', NULL, 1),
(2, 1001, 2, 15, 'Audra Matias', NULL, 0),
(3, 1002, 3, 49, 'Cora Zuniga', NULL, 1),
(4, 1003, 4, 87, 'Odette Castro', NULL, 1),
(5, 1004, 5, 12, 'Lana Maximo', NULL, 0),
(6, 1005, 6, 30, 'Ferdinand Monserrat', NULL, 0),
(7, 1006, 7, 16, 'Beverly Vargas', NULL, 1),
(8, 1007, 8, 62, 'Leonard Daniel', NULL, 0),
(9, 1008, 9, 89, 'Astra Benjamin', NULL, 1),
(10, 1009, 10, 39, 'Zahir Castillo', NULL, 1),
(11, 1010, 11, 66, 'Keefe Thiarre', NULL, 0),
(12, 1011, 12, 61, 'Jessica Azizi', NULL, 1),
(13, 1012, 13, 75, 'Tanner Sebastian', NULL, 1),
(14, 1013, 14, 62, 'Ayanna Juan', NULL, 1),
(15, 1014, 15, 90, 'Hanna Fuentes', NULL, 0),
(16, 1015, 16, 84, 'Daniel Fuentes', NULL, 0),
(17, 1016, 17, 73, 'Colt Gabriel', NULL, 0),
(18, 1017, 18, 44, 'Cally Cortes', NULL, 1),
(19, 1018, 19, 96, 'Ivory Diem', NULL, 1),
(20, 1019, 20, 56, 'Nash Reyes', NULL, 1),
(21, 1020, 21, 75, 'Dustin Castro', NULL, 0),
(22, 1021, 22, 70, 'Hollee Morales', NULL, 1),
(23, 1022, 23, 2, 'Madison Castillo', NULL, 0),
(24, 1023, 24, 37, 'Gloria Carrasco', NULL, 1),
(25, 1024, 25, 100, 'Illiana Rivera', NULL, 0),
(26, 1025, 26, 38, 'Kareem Martina', NULL, 0),
(27, 1026, 27, 30, 'Talon Diaz', NULL, 0),
(28, 1027, 28, 49, 'Brady Laura', NULL, 0),
(29, 1028, 29, 46, 'Tatyana Carolina', NULL, 1),
(30, 1029, 30, 73, 'Elijah Sebastian', NULL, 0),
(31, 1030, 31, 14, 'Declan Bentlee', NULL, 1),
(32, 1031, 32, 30, 'Otto Alonsos', NULL, 1),
(33, 1032, 33, 62, 'Juliet Javier', NULL, 0),
(34, 1033, 34, 26, 'Erasmus Benjamin', NULL, 1),
(35, 1034, 35, 52, 'Brian Pia', NULL, 1),
(36, 1035, 36, 95, 'Tanya Bravo', NULL, 0),
(37, 1036, 37, 60, 'Noelani Azizi', NULL, 0),
(38, 1037, 38, 73, 'Rogan Florencia', NULL, 0),
(39, 1038, 39, 80, 'Slade Pascal', NULL, 1),
(40, 1039, 40, 56, 'Oscar Laura', NULL, 1),
(41, 1040, 41, 83, 'Violet Juan', NULL, 1),
(42, 1041, 42, 77, 'Cain Camila', NULL, 0),
(43, 1042, 43, 85, 'Xenos Zuniga', NULL, 0),
(44, 1043, 44, 49, 'Sebastian Gonzalez', NULL, 1),
(45, 1044, 45, 36, 'Zeus Bastian', NULL, 1),
(46, 1045, 46, 75, 'Todd Isabella', NULL, 1),
(47, 1046, 47, 96, 'James Felipe', NULL, 0),
(48, 1047, 48, 74, 'Erin Gonzalez', NULL, 0),
(49, 1048, 49, 35, 'Zoe Fuentes', NULL, 1),
(50, 1049, 50, 58, 'Whilemina Alonsos', NULL, 0),
(51, 1050, 51, 64, 'Idona Monserrat', NULL, 0),
(52, 1051, 52, 10, 'Gloria Fernandez', NULL, 1),
(53, 1052, 53, 4, 'Wendy Valenzuela', NULL, 0),
(54, 1053, 54, 39, 'Ivory Julieta', NULL, 0),
(55, 1054, 55, 63, 'Elizabeth Diem', NULL, 0),
(56, 1055, 56, 23, 'Amanda Benjamin', NULL, 0),
(57, 1056, 57, 2, 'Erasmus Rivera', NULL, 1),
(58, 1057, 58, 19, 'Adrian Isabella', NULL, 1),
(59, 1058, 59, 63, 'Yen Cortes', NULL, 0),
(60, 1059, 60, 81, 'Rinah Joaquin', NULL, 0),
(61, 1060, 61, 74, 'Kylie Vergara', NULL, 0),
(62, 1061, 62, 45, 'Quynn Diem', NULL, 1),
(63, 1062, 63, 75, 'Reuben Martin', NULL, 0),
(64, 1063, 64, 53, 'Kadeem Gonzalez', NULL, 1),
(65, 1064, 65, 12, 'Athena Gabriel', NULL, 0),
(66, 1065, 66, 15, 'Odessa Isabella', NULL, 0),
(67, 1066, 67, 17, 'Hop Cortes', NULL, 1),
(68, 1067, 68, 94, 'Meredith Paz', NULL, 0),
(69, 1068, 69, 32, 'Callum Flores', NULL, 0),
(70, 1069, 70, 8, 'Brenden Castillo', NULL, 0),
(71, 1070, 71, 98, 'Irene Javier', NULL, 1),
(72, 1071, 72, 56, 'Barclay Sanchez', NULL, 1),
(73, 1072, 73, 96, 'Demetrius Miranda', NULL, 0),
(74, 1073, 74, 75, 'Lester Paz', NULL, 1),
(75, 1074, 75, 22, 'Colt Julieta', NULL, 0),
(76, 1075, 76, 16, 'Linus Azizi', NULL, 1),
(77, 1076, 77, 41, 'Sandra Juan', NULL, 0),
(78, 1077, 78, 6, 'Ann Catalina', NULL, 0),
(79, 1078, 79, 41, 'Jamal Rivera', NULL, 0),
(80, 1079, 80, 87, 'Cooper Alonsos', NULL, 0),
(81, 1080, 81, 20, 'Unity Martina', NULL, 0),
(82, 1081, 82, 59, 'Micah Diego', NULL, 1),
(83, 1082, 83, 33, 'Jonah Miranda', NULL, 0),
(84, 1083, 84, 39, 'William Cristobal', NULL, 1),
(85, 1084, 85, 65, 'Sebastian Vargas', NULL, 0),
(86, 1085, 86, 81, 'Graiden Perez', NULL, 1),
(87, 1086, 87, 77, 'Martena Cristobal', NULL, 1),
(88, 1087, 88, 29, 'Anika Gabriela', NULL, 0),
(89, 1088, 89, 13, 'Cora Julieta', NULL, 1),
(90, 1089, 90, 68, 'Myra Isabella', NULL, 0),
(91, 1090, 91, 18, 'Hedda Contreras', NULL, 1),
(92, 1091, 92, 7, 'Maite Isabella', NULL, 1),
(93, 1092, 93, 89, 'Scott Rivera', NULL, 1),
(94, 1093, 94, 22, 'Ursula Juan', NULL, 1),
(95, 1094, 95, 87, 'Penelope Vasquez', NULL, 0),
(96, 1095, 96, 8, 'Gary Paula', NULL, 0),
(97, 1096, 97, 93, 'Elijah Fernanda', NULL, 0),
(98, 1097, 98, 42, 'Oliver Espinoza', NULL, 1),
(99, 1098, 99, 81, 'Vera Diem', NULL, 1),
(100, 1099, 100, 3, 'Axel Augustin', NULL, 0),
(101, 1101, 4, 45, 'Cliente de prueba', '', 1);

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
(1, 'Barra de tragos'),
(2, 'Barra de choperas'),
(3, 'Cocina'),
(4, 'Candy Bar');

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
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sector`
--
ALTER TABLE `sector`
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
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT de la tabla `sector`
--
ALTER TABLE `sector`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
