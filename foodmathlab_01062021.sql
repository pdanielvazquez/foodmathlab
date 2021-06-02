-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-06-2021 a las 03:44:14
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `foodmathlab`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `id_alimento` int(11) NOT NULL,
  `categoria` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `id_alimento`, `categoria`) VALUES
(1, 1, 'Dulces no rellenas'),
(2, 1, 'Saladas'),
(3, 1, 'Wafer'),
(4, 1, 'Dulces rellenas'),
(5, 2, 'Pastelitos con relleno'),
(6, 2, 'Pastelitos sin relleno'),
(7, 2, 'Panetón'),
(8, 3, 'Panes'),
(9, 3, 'Bollería'),
(10, 3, 'Postres'),
(11, 4, 'Postres'),
(12, 4, 'Bollería'),
(13, 5, 'Azucarados'),
(14, 5, 'Con chocolate'),
(15, 5, 'Saludables'),
(16, 6, 'Vinagretas'),
(17, 6, 'Mayonesa'),
(18, 6, 'Mostazas'),
(19, 6, 'Catsup'),
(20, 6, 'BBQ'),
(21, 6, 'Picantes'),
(22, 6, 'Otros'),
(23, 7, 'Batidos'),
(24, 7, 'Jugos'),
(25, 7, 'Néctares'),
(26, 7, 'Polvos y refrescos'),
(27, 8, 'Barra/Molde'),
(28, 8, 'Confitado/relleno'),
(29, 8, 'Mesa'),
(30, 8, 'Cobertura'),
(31, 16, 'Relleno'),
(32, 16, 'Sólido'),
(33, 16, 'Con chile'),
(34, 9, 'Mantequillas'),
(35, 9, 'Margarinas'),
(36, 9, 'Mantecas'),
(37, 9, 'Aceites para freír'),
(38, 9, 'Aceites culinarios y análogos de queso'),
(39, 10, 'Mantequillas'),
(40, 10, 'Margarinas'),
(41, 10, 'Mantecas'),
(42, 10, 'Aceites para freír'),
(43, 10, 'Aceites culinarios y análogos de queso'),
(44, 11, 'Papa congelada'),
(45, 11, 'Puré de papa'),
(46, 12, 'Fruta seca'),
(47, 12, 'Barra de cereal'),
(48, 13, 'Yogurt'),
(49, 13, 'Quesos'),
(50, 13, 'Crema ácida'),
(51, 13, 'Helado'),
(52, 13, 'Postes refrigerados'),
(53, 13, 'Crema Batida'),
(54, 14, 'Pasta de sémola de trigo'),
(55, 14, 'Avena'),
(56, 15, 'Gelatina en polvo'),
(57, 15, 'Postres congelados e instantáneos'),
(58, 17, 'Conservas de pescado'),
(59, 15, 'GELATINA'),
(60, 18, 'Panes congelados'),
(61, 19, 'Frutas y verduras'),
(62, 13, 'Leche');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `descripcion` text COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `tipo` enum('solido','liquido') COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `id_usuario`, `descripcion`, `nombre`, `tipo`) VALUES
(4, 22, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ut scelerisque lectus. Ut malesuada erat felis, sed faucibus ante lobortis at. Praesent non lacus auctor, tristique nulla quis, faucibus nunc. ', 'Frituras', 'solido'),
(5, 22, 'Maecenas pellentesque lectus mi, ut feugiat diam luctus ut. Maecenas auctor, arcu eu fringilla porta, massa nibh pretium enim, quis facilisis tellus sem vitae nisi. ', 'Refrescos', 'liquido'),
(6, 22, 'Este es un grupo de prueba del programador', 'Chocolates', 'solido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_opciones`
--

CREATE TABLE `menu_opciones` (
  `id_opcion` int(5) NOT NULL,
  `orden` int(5) NOT NULL,
  `opcion` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `icono` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `menu_opciones`
--

INSERT INTO `menu_opciones` (`id_opcion`, `orden`, `opcion`, `icono`, `descripcion`, `activo`) VALUES
(1, 1, 'Productos', 'fas fa-shopping-basket', 'Agregar, Agrupar, Consultar', 1),
(2, 2, 'Reportes', 'fas fa-chart-bar', 'Por tipo, Por grupo', 1),
(3, 3, 'Administrador', 'fas fa-cogs', 'Usuarios & Permisos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_menu`
--

CREATE TABLE `permisos_menu` (
  `id_usuario` int(11) NOT NULL,
  `id_opcion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `permisos_menu`
--

INSERT INTO `permisos_menu` (`id_usuario`, `id_opcion`) VALUES
(22, 1),
(22, 2),
(22, 3);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `permisos_usuarios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `permisos_usuarios` (
`id_usuario` int(11)
,`id_opcion` int(5)
,`orden` int(5)
,`opcion` varchar(50)
,`icono` varchar(50)
,`activo` tinyint(1)
,`descripcion` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_foodmathlab`
--

CREATE TABLE `productos_foodmathlab` (
  `id_prod` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tipo` enum('solido','liquido') NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cantidad_neta` decimal(12,8) DEFAULT NULL,
  `cantidad_porcion` decimal(12,8) NOT NULL,
  `energia` decimal(12,8) DEFAULT NULL,
  `calograsas` decimal(12,8) DEFAULT NULL,
  `lipidos` decimal(12,8) DEFAULT NULL,
  `acidosgs` decimal(12,8) DEFAULT NULL,
  `acidosgm` decimal(12,8) DEFAULT NULL,
  `acidosgp` decimal(12,8) DEFAULT NULL,
  `acidostrans` decimal(12,8) DEFAULT NULL,
  `colesterol` decimal(12,8) DEFAULT NULL,
  `sodio` decimal(12,8) DEFAULT NULL,
  `hidratos` decimal(12,8) DEFAULT NULL,
  `fibra` decimal(12,8) DEFAULT NULL,
  `azucaresa` decimal(12,8) DEFAULT NULL,
  `proteina` decimal(12,8) DEFAULT NULL,
  `vitaa` decimal(12,8) DEFAULT NULL,
  `acidoascord` decimal(12,8) DEFAULT NULL,
  `tiamina` decimal(12,8) DEFAULT NULL,
  `riboflavina` decimal(12,8) DEFAULT NULL,
  `acidopanto` decimal(12,8) DEFAULT NULL,
  `vitad` decimal(12,8) DEFAULT NULL,
  `niacina` decimal(12,8) DEFAULT NULL,
  `piridoxina` decimal(12,8) DEFAULT NULL,
  `acidofolico` decimal(12,8) DEFAULT NULL,
  `cobalamina` decimal(12,8) DEFAULT NULL,
  `vitaminae` decimal(12,8) DEFAULT NULL,
  `tocoferol` decimal(12,8) DEFAULT NULL,
  `vitak` decimal(12,8) DEFAULT NULL,
  `calcio` decimal(12,8) DEFAULT NULL,
  `fosforo` decimal(12,8) DEFAULT NULL,
  `hierro` decimal(12,8) DEFAULT NULL,
  `magnesio` decimal(12,8) DEFAULT NULL,
  `potasio` decimal(12,8) DEFAULT NULL,
  `zinc` decimal(12,8) DEFAULT NULL,
  `acidolino` decimal(12,8) DEFAULT NULL,
  `fruta` decimal(12,8) DEFAULT NULL,
  `verdura` decimal(12,8) DEFAULT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos_foodmathlab`
--

INSERT INTO `productos_foodmathlab` (`id_prod`, `id_user`, `tipo`, `id_categoria`, `id_grupo`, `nombre`, `cantidad_neta`, `cantidad_porcion`, `energia`, `calograsas`, `lipidos`, `acidosgs`, `acidosgm`, `acidosgp`, `acidostrans`, `colesterol`, `sodio`, `hidratos`, `fibra`, `azucaresa`, `proteina`, `vitaa`, `acidoascord`, `tiamina`, `riboflavina`, `acidopanto`, `vitad`, `niacina`, `piridoxina`, `acidofolico`, `cobalamina`, `vitaminae`, `tocoferol`, `vitak`, `calcio`, `fosforo`, `hierro`, `magnesio`, `potasio`, `zinc`, `acidolino`, `fruta`, `verdura`, `fecha`) VALUES
(3, 22, 'solido', 1, 4, 'Bombitos - Gamesa', '150.00000000', '30.00000000', '142.00000000', '0.00000000', '6.20000000', '0.00000000', '0.00000000', '1.60000000', '0.05000000', '0.00000000', '0.30200000', '18.90000000', '0.50000000', '3.00000000', '2.60000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '2021-04-09 20:11:05'),
(4, 22, 'solido', 1, 4, 'Frojles bayos refritos con chorizo - La sierra', '430.00000000', '130.00000000', '143.00000000', '0.00000000', '6.00000000', '0.00000000', '0.00000000', '1.00000000', '0.01560000', '0.00000000', '0.49400000', '15.00000000', '5.80000000', '1.00000000', '7.30000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '2021-04-09 20:13:34'),
(5, 22, 'solido', 1, 4, 'Café de grano tostado mezclado con azúcar a la canela - Legal', '200.00000000', '2.80000000', '5.00000000', '0.00000000', '0.10000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00060000', '1.00000000', '0.00000000', '1.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '2021-04-09 20:17:38'),
(6, 22, 'solido', 14, 6, 'Hersheys', '251.00000000', '100.00000000', '520.40000000', '0.00000000', '28.80000000', '17.60000000', '0.00000000', '0.00000000', '0.08700000', '0.00000000', '0.09900000', '0.00000000', '3.00000000', '53.10000000', '6.60000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '2021-05-13 19:55:59'),
(7, 22, 'solido', 14, 6, 'Abuelita', '270.00000000', '100.00000000', '448.00000000', '0.00000000', '14.32000000', '10.72000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00500000', '76.00000000', '2.72000000', '75.00000000', '3.40000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '2021-05-13 20:14:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `submenu_opciones`
--

CREATE TABLE `submenu_opciones` (
  `id_opcion` int(5) NOT NULL,
  `orden_submenu` int(5) NOT NULL,
  `opcion_submenu` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `ruta_submenu` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `icono_submenu` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `activo_submenu` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `submenu_opciones`
--

INSERT INTO `submenu_opciones` (`id_opcion`, `orden_submenu`, `opcion_submenu`, `ruta_submenu`, `icono_submenu`, `activo_submenu`) VALUES
(1, 0, '1. grupos', 'productos_grupos', 'fas fa-arrow-alt-circle-right', 1),
(1, 1, '2. nuevo', 'producto_nuevo', 'fas fa-arrow-alt-circle-right', 1),
(1, 2, '3. registrados', 'productos_registrados', 'fas fa-arrow-alt-circle-right', 1),
(2, 0, 'Por grupos', 'reporte_grupos', 'fas fa-arrow-alt-circle-right', 1),
(2, 1, 'sólidos', 'reporte/solido', 'fas fa-arrow-alt-circle-right', 0),
(2, 2, 'líquidos', 'reporte/liquido', 'fas fa-arrow-alt-circle-right', 0),
(2, 3, 'Por tipos', 'reporte_tipos', 'fas fa-arrow-alt-circle-right', 1),
(3, 1, 'Usuarios & Permisos', 'usuarios', 'fas fa-arrow-alt-circle-right', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `nombre` varchar(110) DEFAULT NULL,
  `correo` varchar(70) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `root` tinyint(1) DEFAULT NULL,
  `etq_NS` tinyint(1) DEFAULT NULL,
  `etq_EC` tinyint(1) DEFAULT NULL,
  `etq_MX` tinyint(1) DEFAULT NULL,
  `etq_CH` tinyint(1) DEFAULT NULL,
  `etq_PR` tinyint(1) DEFAULT NULL,
  `etq_UK` tinyint(1) DEFAULT NULL,
  `etq_SN` tinyint(1) DEFAULT NULL,
  `mod_ref` tinyint(1) DEFAULT NULL,
  `mod_com` tinyint(1) DEFAULT NULL,
  `mod_cru` tinyint(1) DEFAULT NULL,
  `no_prd` text DEFAULT NULL,
  `no_emp` text DEFAULT NULL,
  `no_mrc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `nombre`, `correo`, `password`, `root`, `etq_NS`, `etq_EC`, `etq_MX`, `etq_CH`, `etq_PR`, `etq_UK`, `etq_SN`, `mod_ref`, `mod_com`, `mod_cru`, `no_prd`, `no_emp`, `no_mrc`) VALUES
(6, 'Nutrimonitor_Admin', 'demoadmin@novo.com', '$2y$10$LznCZCu..mKk64iU0EdfFOnRqo7lj.CSAJORVM/Qfv/4rXvaLkrXC', 1, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL),
(7, 'Usuario Captura 1', 'usercap1', '$2y$10$l8Rikc730NQkO4urNoU90.BrA58hyO3gyGQyFaDHdfjVl8pmW6.LG', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL),
(8, 'Usuario Captura 2', 'usercap2', '$2y$10$ORCqkRwhq1fz1/onvE1mzOmd92IA6.8711OxQXdMF8ByWvWuzVmQe', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Clara Elena Delgado Viloria', 'CDelgadoV@alicorp.com.pe', '$2y$10$GnUANwlYBmKpGHOPd4AS..6o2G9MjBgyPSyRZngq9YzBYilyFy472', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Alejandra Mariana Rizo Patron Eguren', 'ARizopatronE@alicorp.com.pe', '$2y$10$hmalfETEXBek4PMsIe.OIuzs0GncAcLKoxTk5Xl/ID81OitznfxfW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'PAULO DANIEL VAZQUEZ MORA', 'daniel.vazquez@utpuebla.edu.mx', '$2y$10$UkOPjnYi1DSskmMYijE/JeZrvOCpyHjsHnKR96STU3YIfC/UJiZ7y', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura para la vista `permisos_usuarios`
--
DROP TABLE IF EXISTS `permisos_usuarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `permisos_usuarios`  AS  select `pm`.`id_usuario` AS `id_usuario`,`mo`.`id_opcion` AS `id_opcion`,`mo`.`orden` AS `orden`,`mo`.`opcion` AS `opcion`,`mo`.`icono` AS `icono`,`mo`.`activo` AS `activo`,`mo`.`descripcion` AS `descripcion` from (`permisos_menu` `pm` join `menu_opciones` `mo` on(`pm`.`id_opcion` = `mo`.`id_opcion`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `id_alimento` (`id_alimento`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `fk_grupos_usuario` (`id_usuario`);

--
-- Indices de la tabla `menu_opciones`
--
ALTER TABLE `menu_opciones`
  ADD PRIMARY KEY (`id_opcion`);

--
-- Indices de la tabla `permisos_menu`
--
ALTER TABLE `permisos_menu`
  ADD PRIMARY KEY (`id_usuario`,`id_opcion`),
  ADD KEY `fk_permisos_menu` (`id_opcion`);

--
-- Indices de la tabla `productos_foodmathlab`
--
ALTER TABLE `productos_foodmathlab`
  ADD PRIMARY KEY (`id_prod`),
  ADD KEY `fk_productos_usuarios` (`id_user`),
  ADD KEY `fk_productos_categorias` (`id_categoria`);

--
-- Indices de la tabla `submenu_opciones`
--
ALTER TABLE `submenu_opciones`
  ADD PRIMARY KEY (`id_opcion`,`orden_submenu`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `menu_opciones`
--
ALTER TABLE `menu_opciones`
  MODIFY `id_opcion` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos_foodmathlab`
--
ALTER TABLE `productos_foodmathlab`
  MODIFY `id_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `CATEGORIAS_ibfk_1` FOREIGN KEY (`id_alimento`) REFERENCES `alimentos` (`id_alimento`);

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `fk_grupos_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos_menu`
--
ALTER TABLE `permisos_menu`
  ADD CONSTRAINT `fk_permisos_menu` FOREIGN KEY (`id_opcion`) REFERENCES `menu_opciones` (`id_opcion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_permisos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos_foodmathlab`
--
ALTER TABLE `productos_foodmathlab`
  ADD CONSTRAINT `fk_productos_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_productos_usuarios` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `submenu_opciones`
--
ALTER TABLE `submenu_opciones`
  ADD CONSTRAINT `fk_menu_submenu_opciones` FOREIGN KEY (`id_opcion`) REFERENCES `menu_opciones` (`id_opcion`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
