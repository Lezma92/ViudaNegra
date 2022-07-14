-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-07-2022 a las 23:28:50
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `viuda_negra`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `botellasycocteles`
--

CREATE TABLE `botellasycocteles` (
  `id` int(11) NOT NULL,
  `id_categoriademenu` int(11) NOT NULL COMMENT 'llave foranea, sirve para saber a que categoria perteneces una bebida',
  `nombre` varchar(200) NOT NULL COMMENT 'Se guardará el nombre de la bebida',
  `estadocontrol` enum('vigente','agotado','debaja') DEFAULT NULL COMMENT 'Este campo servira para saber si la bebida sigue vigente, si se encuentra dentro del stock',
  `fecha_registro` datetime DEFAULT current_timestamp() COMMENT 'Se guardara la fecha de cuando fue registrada cada bebida'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `botellasycocteles`
--

INSERT INTO `botellasycocteles` (`id`, `id_categoriademenu`, `nombre`, `estadocontrol`, `fecha_registro`) VALUES
(1, 1, 'COCTELES CON ALCOHOL', 'vigente', '2022-04-25 06:12:12'),
(2, 2, 'AGUA NATURAL', 'vigente', '2022-04-29 12:00:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriademenu`
--

CREATE TABLE `categoriademenu` (
  `id` int(11) NOT NULL COMMENT 'Llave primaria de la tabla, se encarga de llevar un registro unico',
  `nombremenu` varchar(80) NOT NULL COMMENT 'Se registra el nombre de la categoria que se maneja dentro del bar, ej. cocteles, bebidas, botanas,. etc..',
  `url_imagen` varchar(250) DEFAULT NULL COMMENT 'Aqui se guardara la dirección de una imagen que representará la categoria de la que se habla'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoriademenu`
--

INSERT INTO `categoriademenu` (`id`, `nombremenu`, `url_imagen`) VALUES
(1, 'COCTELERIA', '25-04-2022-13.10.51.png'),
(2, 'Bebidas Naturales', '29-04-2022-09.22.20.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idcliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `estado` enum('Abierto','Finalizado') DEFAULT NULL,
  `fecha_hora_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idcliente`, `id_usuario`, `id_mesa`, `nombre`, `estado`, `fecha_hora_registro`) VALUES
(1, 3, 1, 'Juenas', 'Finalizado', '2022-04-29 01:35:53'),
(2, 3, 1, 'roberto', 'Finalizado', '2022-04-29 01:46:56'),
(3, 3, 1, 'google', 'Finalizado', '2022-04-29 02:00:18'),
(4, 3, 1, 'nochebuean', 'Finalizado', '2022-04-29 02:08:52'),
(5, 3, 2, 'jejeHola', 'Finalizado', '2022-04-29 02:12:22'),
(6, 3, 1, 'Rubem', 'Finalizado', '2022-04-29 12:02:55'),
(7, 3, 1, 'jejeje', 'Finalizado', '2022-04-29 12:18:47'),
(8, 3, 2, 'roberto', 'Finalizado', '2022-04-29 13:46:36'),
(9, 3, 1, 'Rosa', 'Finalizado', '2022-05-02 01:43:29'),
(10, 3, 1, 'Jimena', 'Finalizado', '2022-05-02 01:44:22'),
(11, 3, 2, 'Reina', 'Finalizado', '2022-05-02 11:24:15'),
(12, 3, 1, 'asdajds', 'Finalizado', '2022-05-02 11:36:17'),
(13, 3, 1, 'adsa', 'Finalizado', '2022-05-02 11:41:23'),
(14, 3, 2, 'Jimena', 'Finalizado', '2022-05-02 11:42:44'),
(15, 3, 1, 'Ruben', 'Finalizado', '2022-05-02 11:46:48'),
(16, 3, 1, 'as,a', 'Finalizado', '2022-05-02 11:52:18'),
(17, 3, 3, 'JUELATRusa', 'Finalizado', '2022-05-02 11:53:56'),
(18, 3, 4, 'Weare', 'Finalizado', '2022-05-02 11:54:45'),
(19, 3, 1, 'fidel', 'Finalizado', '2022-05-02 11:56:36'),
(20, 3, 1, 'asdkjas', 'Finalizado', '2022-05-02 12:00:23'),
(21, 3, 1, 'sjs', 'Finalizado', '2022-05-02 12:02:15'),
(22, 3, 1, 'Javier', 'Finalizado', '2022-05-02 12:04:27'),
(23, 3, 1, 'JIJUE', 'Finalizado', '2022-05-02 12:25:26'),
(24, 3, 1, 'as', 'Finalizado', '2022-05-02 12:27:29'),
(25, 3, 1, 'as', 'Finalizado', '2022-05-02 12:27:31'),
(26, 3, 1, 'Nee', 'Finalizado', '2022-05-02 12:28:41'),
(27, 3, 1, 'Javier', 'Finalizado', '2022-05-02 12:49:44'),
(28, 3, 1, 'Ee', 'Finalizado', '2022-05-02 12:54:31'),
(29, 3, 1, 'Jejeje', 'Finalizado', '2022-05-02 13:00:34'),
(30, 3, 1, 'Luis', 'Finalizado', '2022-05-02 13:03:54'),
(31, 3, 1, 'Gerardo', 'Finalizado', '2022-05-02 13:37:57'),
(32, 3, 1, 'Raul', 'Finalizado', '2022-05-03 01:05:02'),
(33, 3, 1, 'jea', 'Finalizado', '2022-05-03 01:24:35'),
(35, 3, 1, 'Misael', 'Finalizado', '2022-05-03 11:50:09'),
(36, 3, 2, 'Gilbertona', 'Finalizado', '2022-05-03 12:11:59'),
(37, 3, 3, 'Luis', 'Finalizado', '2022-05-03 12:35:28'),
(38, 3, 5, 'juan', 'Finalizado', '2022-05-03 14:55:46'),
(39, 3, 6, 'juana', 'Finalizado', '2022-05-03 14:58:06'),
(40, 3, 5, 'Luismi', 'Finalizado', '2022-05-04 09:16:17'),
(41, 3, 6, 'Rogelio', 'Finalizado', '2022-05-04 10:25:59'),
(42, 3, 1, 'Gil', 'Finalizado', '2022-05-04 10:43:12'),
(43, 3, 1, 'Wiii', 'Finalizado', '2022-05-04 11:24:11'),
(44, 3, 5, 'Stoo', 'Finalizado', '2022-05-04 12:07:18'),
(45, 3, 1, 'Luiw', 'Finalizado', '2022-05-04 12:08:21'),
(46, 3, 2, 'Ruben', 'Finalizado', '2022-05-04 14:03:50'),
(48, 3, 1, 'Nu', 'Finalizado', '2022-05-08 12:21:10'),
(49, 3, 5, 'Uuu', 'Finalizado', '2022-05-08 12:41:43'),
(50, 3, 1, 'Yue', 'Abierto', '2022-05-21 00:56:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `idmesas` int(11) NOT NULL COMMENT 'identificador unico',
  `id_terrazas` int(11) NOT NULL COMMENT 'se almacena el identificar de las terrrazas para conocer a la que pertence cada mesa',
  `nummesa` varchar(70) NOT NULL COMMENT 'se almacena el nombre de la mesa con el cual se identifica',
  `estado` enum('ocupada','vacia','mantenimiento') DEFAULT NULL COMMENT 'Se almacena el estado de las mesas, para saber si estan en servicio o no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`idmesas`, `id_terrazas`, `nummesa`, `estado`) VALUES
(1, 1, 'Mesa 1', 'ocupada'),
(2, 1, 'Mesa 2', 'vacia'),
(3, 1, 'Mesa 3', 'vacia'),
(4, 1, 'Mesa 4', 'vacia'),
(5, 2, 'Mesa 1', 'vacia'),
(6, 2, 'Mesa 2', 'vacia'),
(7, 2, 'Mesa 3', 'vacia'),
(8, 2, 'Mesa 4', 'vacia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idpedididos` int(11) NOT NULL,
  `id_clientes` int(11) NOT NULL,
  `id_tiposcoctelesytragos` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `ingredientes` text DEFAULT 'c/todo',
  `fechayhora` datetime DEFAULT NULL,
  `status_orden` enum('ordenado','preparacion','servido','cancelado','finalizado') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`idpedididos`, `id_clientes`, `id_tiposcoctelesytragos`, `cantidad`, `ingredientes`, `fechayhora`, `status_orden`) VALUES
(1, 1, 2, 1, 'c/todo', '2022-04-29 01:36:15', 'finalizado'),
(2, 1, 4, 1, 'c/todo', '2022-04-29 01:36:15', 'finalizado'),
(3, 1, 3, 1, 'c/todo', '2022-04-29 01:36:16', 'finalizado'),
(4, 1, 3, 1, 'c/todo', '2022-04-29 01:36:16', 'finalizado'),
(5, 1, 3, 1, 'c/todo', '2022-04-29 01:36:16', 'finalizado'),
(6, 1, 3, 1, 'c/todo', '2022-04-29 01:36:16', 'finalizado'),
(7, 1, 3, 1, 'c/todo', '2022-04-29 01:36:16', 'finalizado'),
(8, 1, 3, 1, 'c/todo', '2022-04-29 01:36:16', 'finalizado'),
(9, 1, 3, 1, 'c/todo', '2022-04-29 01:36:16', 'finalizado'),
(10, 2, 1, 1, 'c/todo', '2022-04-29 01:48:43', 'finalizado'),
(11, 2, 4, 1, 'c/todo', '2022-04-29 01:48:44', 'finalizado'),
(12, 2, 2, 1, 'c/todo', '2022-04-29 01:48:44', 'finalizado'),
(13, 3, 2, 1, 'c/todo', '2022-04-29 02:06:59', 'finalizado'),
(15, 4, 2, 1, 'c/todo', '2022-04-29 02:09:26', 'finalizado'),
(16, 5, 5, 1, 'c/todo', '2022-04-29 11:17:14', 'finalizado'),
(17, 5, 6, 1, 'c/todo', '2022-04-29 11:17:14', 'finalizado'),
(19, 4, 7, 1, 'c/todo', '2022-04-29 12:02:35', 'finalizado'),
(20, 4, 7, 1, 'c/todo', '2022-04-29 12:02:35', 'finalizado'),
(21, 4, 7, 1, 'c/todo', '2022-04-29 12:02:35', 'finalizado'),
(22, 6, 4, 1, 'c/todo', '2022-04-29 12:03:13', 'finalizado'),
(23, 6, 7, 1, 'c/todo', '2022-04-29 12:03:13', 'finalizado'),
(24, 7, 2, 1, 'c/todo', '2022-04-29 12:34:51', 'finalizado'),
(25, 7, 6, 1, 'c/todo', '2022-04-29 12:34:51', 'finalizado'),
(26, 7, 3, 1, 'c/todo', '2022-04-29 12:34:51', 'finalizado'),
(27, 7, 1, 1, 'c/todo', '2022-04-29 12:34:51', 'finalizado'),
(28, 7, 4, 1, 'c/todo', '2022-04-29 12:34:51', 'finalizado'),
(29, 7, 1, 1, 'c/todo', '2022-04-29 12:34:51', 'finalizado'),
(30, 8, 6, 2, 'c/todo', '2022-04-29 13:47:05', 'finalizado'),
(31, 8, 3, 1, 'c/todo', '2022-04-29 13:47:06', 'finalizado'),
(32, 8, 5, 3, 'c/todo', '2022-04-29 13:47:06', 'finalizado'),
(33, 9, 1, 1, 'c/todo', '2022-05-02 01:43:55', 'finalizado'),
(34, 9, 4, 1, 'c/todo', '2022-05-02 01:43:56', 'finalizado'),
(35, 9, 4, 1, 'c/todo', '2022-05-02 01:43:56', 'finalizado'),
(36, 10, 2, 1, 'c/todo', '2022-05-02 01:44:42', 'finalizado'),
(37, 10, 4, 1, 'c/todo', '2022-05-02 01:44:42', 'finalizado'),
(38, 10, 6, 1, 'c/todo', '2022-05-02 01:44:43', 'finalizado'),
(39, 10, 5, 1, 'c/todo', '2022-05-02 01:44:43', 'finalizado'),
(40, 10, 3, 1, 'c/todo', '2022-05-02 01:44:43', 'finalizado'),
(41, 11, 7, 3, 'c/todo', '2022-05-02 11:24:31', 'finalizado'),
(42, 11, 4, 1, 'c/todo', '2022-05-02 11:29:25', 'finalizado'),
(43, 11, 6, 1, 'c/todo', '2022-05-02 11:29:25', 'finalizado'),
(44, 11, 2, 1, 'c/todo', '2022-05-02 11:29:25', 'finalizado'),
(45, 11, 5, 1, 'c/todo', '2022-05-02 11:29:25', 'finalizado'),
(46, 11, 7, 3, 'c/todo', '2022-05-02 11:34:04', 'finalizado'),
(47, 11, 3, 1, 'c/todo', '2022-05-02 11:34:05', 'finalizado'),
(48, 11, 6, 1, 'c/todo', '2022-05-02 11:34:05', 'finalizado'),
(49, 11, 5, 1, 'c/todo', '2022-05-02 11:34:05', 'finalizado'),
(50, 12, 1, 1, 'c/todo', '2022-05-02 11:40:31', 'finalizado'),
(51, 12, 6, 1, 'c/todo', '2022-05-02 11:40:32', 'finalizado'),
(52, 12, 6, 1, 'c/todo', '2022-05-02 11:40:32', 'finalizado'),
(53, 12, 6, 1, 'c/todo', '2022-05-02 11:40:32', 'finalizado'),
(54, 13, 1, 1, 'c/todo', '2022-05-02 11:41:37', 'finalizado'),
(55, 13, 1, 1, 'c/todo', '2022-05-02 11:41:38', 'finalizado'),
(56, 13, 1, 1, 'c/todo', '2022-05-02 11:41:38', 'finalizado'),
(57, 13, 1, 1, 'c/todo', '2022-05-02 11:41:38', 'finalizado'),
(58, 13, 1, 1, 'c/todo', '2022-05-02 11:41:38', 'finalizado'),
(59, 13, 6, 1, 'c/todo', '2022-05-02 11:41:38', 'finalizado'),
(60, 13, 6, 1, 'c/todo', '2022-05-02 11:41:38', 'finalizado'),
(61, 14, 1, 1, 'c/todo', '2022-05-02 11:42:57', 'finalizado'),
(62, 15, 1, 1, 'c/todo', '2022-05-02 11:47:01', 'finalizado'),
(63, 15, 6, 1, 'c/todo', '2022-05-02 11:47:01', 'finalizado'),
(64, 16, 1, 1, 'c/todo', '2022-05-02 11:52:43', 'finalizado'),
(65, 17, 1, 1, 'c/todo', '2022-05-02 11:54:07', 'finalizado'),
(66, 18, 7, 1, 'c/todo', '2022-05-02 11:54:56', 'finalizado'),
(67, 18, 7, 1, 'c/todo', '2022-05-02 11:54:56', 'finalizado'),
(68, 18, 7, 1, 'c/todo', '2022-05-02 11:54:56', 'finalizado'),
(69, 18, 7, 1, 'c/todo', '2022-05-02 11:54:56', 'finalizado'),
(70, 19, 3, 1, 'c/todo', '2022-05-02 11:56:54', 'finalizado'),
(71, 19, 6, 1, 'c/todo', '2022-05-02 11:56:54', 'finalizado'),
(72, 20, 1, 1, 'c/todo', '2022-05-02 12:00:35', 'finalizado'),
(73, 21, 1, 1, 'c/todo', '2022-05-02 12:02:29', 'finalizado'),
(74, 21, 6, 1, 'c/todo', '2022-05-02 12:02:30', 'finalizado'),
(75, 21, 6, 1, 'c/todo', '2022-05-02 12:02:30', 'finalizado'),
(76, 21, 6, 1, 'c/todo', '2022-05-02 12:02:30', 'finalizado'),
(77, 21, 6, 1, 'c/todo', '2022-05-02 12:02:30', 'finalizado'),
(78, 21, 6, 1, 'c/todo', '2022-05-02 12:02:30', 'finalizado'),
(79, 21, 6, 1, 'c/todo', '2022-05-02 12:02:30', 'finalizado'),
(80, 21, 6, 1, 'c/todo', '2022-05-02 12:02:30', 'finalizado'),
(81, 21, 6, 1, 'c/todo', '2022-05-02 12:02:30', 'finalizado'),
(82, 22, 7, 1, 'c/todo', '2022-05-02 12:05:25', 'finalizado'),
(83, 23, 1, 1, 'c/todo', '2022-05-02 12:25:37', 'finalizado'),
(84, 24, 1, 1, 'c/todo', '2022-05-02 12:27:46', 'finalizado'),
(85, 24, 1, 1, 'c/todo', '2022-05-02 12:27:47', 'finalizado'),
(86, 24, 1, 1, 'c/todo', '2022-05-02 12:27:47', 'finalizado'),
(87, 24, 1, 1, 'c/todo', '2022-05-02 12:27:47', 'finalizado'),
(88, 25, 7, 4, 'c/todo', '2022-05-02 12:28:53', 'finalizado'),
(89, 26, 5, 1, 'c/todo', '2022-05-02 12:50:02', 'finalizado'),
(90, 26, 6, 1, 'c/todo', '2022-05-02 12:50:02', 'finalizado'),
(91, 28, 1, 1, 'c/todo', '2022-05-02 13:00:48', 'finalizado'),
(92, 28, 1, 1, 'c/todo', '2022-05-02 13:00:48', 'finalizado'),
(93, 28, 1, 1, 'c/todo', '2022-05-02 13:00:48', 'finalizado'),
(94, 28, 1, 1, 'c/todo', '2022-05-02 13:00:48', 'finalizado'),
(95, 29, 5, 1, 'c/todo', '2022-05-02 13:04:06', 'finalizado'),
(96, 29, 5, 1, 'c/todo', '2022-05-02 13:04:06', 'finalizado'),
(97, 29, 5, 1, 'c/todo', '2022-05-02 13:04:06', 'finalizado'),
(98, 29, 5, 1, 'c/todo', '2022-05-02 13:04:06', 'finalizado'),
(99, 29, 5, 1, 'c/todo', '2022-05-02 13:04:06', 'finalizado'),
(100, 29, 5, 1, 'c/todo', '2022-05-02 13:04:06', 'finalizado'),
(101, 29, 5, 1, 'c/todo', '2022-05-02 13:04:07', 'finalizado'),
(102, 29, 5, 1, 'c/todo', '2022-05-02 13:04:07', 'finalizado'),
(103, 30, 2, 1, 'c/todo', '2022-05-02 13:38:11', 'finalizado'),
(104, 31, 1, 1, 'c/todo', '2022-05-03 01:06:13', 'finalizado'),
(105, 31, 6, 1, 'c/todo', '2022-05-03 01:06:14', 'finalizado'),
(106, 31, 5, 1, 'c/todo', '2022-05-03 01:06:15', 'finalizado'),
(107, 32, 1, 1, 'c/todo', '2022-05-03 09:15:46', 'finalizado'),
(108, 32, 1, 1, 'c/todo', '2022-05-03 09:15:47', 'finalizado'),
(109, 32, 6, 3, 'c/todo', '2022-05-03 09:15:47', 'finalizado'),
(110, 32, 2, 1, 'c/todo', '2022-05-03 10:04:38', 'finalizado'),
(111, 32, 2, 1, 'c/todo', '2022-05-03 10:13:46', 'finalizado'),
(112, 32, 5, 1, 'c/todo', '2022-05-03 10:13:46', 'finalizado'),
(113, 32, 5, 1, 'c/todo', '2022-05-03 10:13:46', 'finalizado'),
(114, 32, 5, 1, 'c/todo', '2022-05-03 10:13:47', 'finalizado'),
(115, 35, 1, 1, 'c/todo', '2022-05-03 11:52:50', 'finalizado'),
(116, 35, 7, 3, 'c/todo', '2022-05-03 11:53:16', 'finalizado'),
(117, 35, 7, 1, 'c/todo', '2022-05-03 12:11:36', 'finalizado'),
(118, 35, 7, 1, 'c/todo', '2022-05-03 12:11:36', 'finalizado'),
(119, 35, 7, 1, 'c/todo', '2022-05-03 12:11:36', 'finalizado'),
(120, 35, 7, 1, 'c/todo', '2022-05-03 12:11:36', 'finalizado'),
(121, 35, 7, 1, 'c/todo', '2022-05-03 12:11:36', 'finalizado'),
(122, 36, 2, 1, 'c/todo', '2022-05-03 12:12:14', 'finalizado'),
(123, 36, 3, 1, 'c/todo', '2022-05-03 12:12:14', 'finalizado'),
(124, 36, 6, 1, 'c/todo', '2022-05-03 12:12:14', 'finalizado'),
(125, 36, 1, 1, 'c/todo', '2022-05-03 12:35:01', 'finalizado'),
(126, 36, 2, 1, 'c/todo', '2022-05-03 12:35:01', 'finalizado'),
(127, 37, 4, 1, 'c/todo', '2022-05-03 12:35:52', 'finalizado'),
(128, 37, 6, 1, 'c/todo', '2022-05-03 12:35:52', 'finalizado'),
(129, 37, 5, 1, 'c/todo', '2022-05-03 12:35:52', 'finalizado'),
(130, 38, 1, 1, 'c/todo', '2022-05-03 14:56:02', 'finalizado'),
(131, 39, 3, 1, 'c/todo', '2022-05-03 14:58:21', 'finalizado'),
(132, 39, 6, 3, 'c/todo', '2022-05-03 14:58:21', 'finalizado'),
(133, 39, 5, 2, 'c/todo', '2022-05-03 14:58:21', 'finalizado'),
(134, 40, 1, 1, 'c/todo', '2022-05-04 09:17:18', 'cancelado'),
(135, 40, 6, 1, 'c/todo', '2022-05-04 09:17:19', 'finalizado'),
(136, 40, 2, 1, 'c/todo', '2022-05-04 09:17:19', 'cancelado'),
(137, 40, 7, 1, 'c/todo', '2022-05-04 09:17:19', 'cancelado'),
(138, 40, 3, 1, 'c/todo', '2022-05-04 09:17:19', 'cancelado'),
(139, 40, 5, 1, 'c/todo', '2022-05-04 10:02:04', 'finalizado'),
(140, 40, 6, 1, 'c/todo', '2022-05-04 10:02:04', 'finalizado'),
(141, 40, 7, 1, 'c/todo', '2022-05-04 10:11:57', 'cancelado'),
(142, 40, 7, 1, 'c/todo', '2022-05-04 10:11:59', 'finalizado'),
(143, 40, 7, 1, 'c/todo', '2022-05-04 10:11:59', 'finalizado'),
(144, 40, 1, 1, 'c/todo', '2022-05-04 10:24:12', 'finalizado'),
(145, 40, 1, 1, 'c/todo', '2022-05-04 10:24:12', 'finalizado'),
(146, 40, 1, 1, 'c/todo', '2022-05-04 10:24:12', 'finalizado'),
(147, 41, 1, 1, 'c/todo', '2022-05-04 10:26:10', 'finalizado'),
(148, 41, 1, 1, 'c/todo', '2022-05-04 10:26:10', 'finalizado'),
(149, 41, 1, 1, 'c/todo', '2022-05-04 10:26:10', 'finalizado'),
(150, 42, 3, 1, 'c/todo', '2022-05-04 10:43:37', 'finalizado'),
(151, 42, 6, 1, 'c/todo', '2022-05-04 10:43:37', 'finalizado'),
(152, 42, 5, 1, 'c/todo', '2022-05-04 10:43:37', 'finalizado'),
(153, 42, 2, 1, 'c/todo', '2022-05-04 10:43:37', 'finalizado'),
(154, 43, 2, 1, 'c/todo', '2022-05-04 11:24:37', 'finalizado'),
(155, 43, 6, 1, 'c/todo', '2022-05-04 11:24:37', 'finalizado'),
(156, 43, 5, 1, 'c/todo', '2022-05-04 11:24:37', 'finalizado'),
(157, 43, 3, 1, 'c/todo', '2022-05-04 11:24:37', 'finalizado'),
(158, 43, 7, 1, 'c/todo', '2022-05-04 11:24:37', 'finalizado'),
(159, 43, 7, 1, 'c/todo', '2022-05-04 11:24:37', 'finalizado'),
(160, 43, 7, 1, 'c/todo', '2022-05-04 11:24:37', 'finalizado'),
(161, 43, 7, 1, 'c/todo', '2022-05-04 11:24:37', 'finalizado'),
(162, 43, 1, 1, 'c/todo', '2022-05-04 11:29:02', 'finalizado'),
(163, 43, 1, 1, 'c/todo', '2022-05-04 11:29:02', 'finalizado'),
(164, 43, 1, 1, 'c/todo', '2022-05-04 11:29:02', 'finalizado'),
(165, 43, 1, 1, 'c/todo', '2022-05-04 11:29:02', 'finalizado'),
(166, 43, 1, 1, 'c/todo', '2022-05-04 11:29:02', 'finalizado'),
(167, 43, 1, 1, 'c/todo', '2022-05-04 11:29:02', 'finalizado'),
(168, 43, 3, 1, 'c/todo', '2022-05-04 11:43:19', 'finalizado'),
(169, 44, 2, 1, 'c/todo', '2022-05-04 12:07:41', 'finalizado'),
(170, 45, 2, 1, 'c/todo', '2022-05-04 12:08:33', 'finalizado'),
(171, 45, 6, 1, 'c/todo', '2022-05-04 12:08:33', 'finalizado'),
(172, 46, 1, 1, 'c/todo', '2022-05-04 14:04:02', 'finalizado'),
(173, 46, 1, 1, 'c/todo', '2022-05-04 14:04:02', 'finalizado'),
(174, 46, 1, 1, 'c/todo', '2022-05-04 14:04:02', 'finalizado'),
(175, 46, 1, 1, 'c/todo', '2022-05-04 14:04:02', 'finalizado'),
(176, 48, 6, 1, 'c/todo', '2022-05-08 12:22:45', 'finalizado'),
(177, 48, 5, 1, 'c/todo', '2022-05-08 12:22:45', 'finalizado'),
(178, 48, 1, 1, 'c/todo', '2022-05-08 12:22:45', 'finalizado'),
(179, 49, 7, 1, 'c/todo', '2022-05-08 12:41:57', 'finalizado'),
(180, 49, 7, 1, 'c/todo', '2022-05-08 12:41:57', 'finalizado'),
(181, 49, 7, 1, 'c/todo', '2022-05-08 12:41:57', 'finalizado'),
(182, 50, 3, 1, 'c/todo', '2022-05-21 00:56:59', 'ordenado'),
(183, 50, 7, 1, 'c/todo', '2022-05-21 01:15:18', 'ordenado'),
(184, 50, 7, 1, 'c/todo', '2022-05-21 01:15:18', 'ordenado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `terrazas`
--

CREATE TABLE `terrazas` (
  `idterrazas` int(11) NOT NULL COMMENT 'identificador unico de control de la tabla',
  `nombreterraza` varchar(50) NOT NULL COMMENT 'Se almacena el nombre con el cual se identifica cada terraza'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `terrazas`
--

INSERT INTO `terrazas` (`idterrazas`, `nombreterraza`) VALUES
(1, 'Terraza 1'),
(2, 'Terraza 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposcoctelesytragos`
--

CREATE TABLE `tiposcoctelesytragos` (
  `id` int(11) NOT NULL,
  `id_botellasycocteles` int(11) DEFAULT NULL,
  `nombrecob` varchar(250) DEFAULT NULL COMMENT 'Se guarda el nombre del coctel o de la bebida',
  `ingredientes` text NOT NULL,
  `precio` varchar(40) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tiposcoctelesytragos`
--

INSERT INTO `tiposcoctelesytragos` (`id`, `id_botellasycocteles`, `nombrecob`, `ingredientes`, `precio`, `descripcion`) VALUES
(1, 1, 'Margarina', 'Ingredientes', '70', 'jhfbbdsd'),
(2, 1, 'Piña Colada', 'ingredientes', '70', 'descripcion'),
(3, 1, 'Barrel Gin Tonic', '5 cl Bluecoat Gin Barrel Finished\r\n10-12 cl Tónica premium\r\nPiel de limón', '80', 'Prepárate un Gin Tonic con esta ginebra premium. El proceso de terminado en barricas quemadas redondea y suaviza #BluecoatGin Barrel Finished, aportándole toques de caramelo, vainilla y toffee, sin que se pierda la esencia original de ginebra y pimienta características de la Bluecoat Gin original.'),
(4, 1, 'Bluecoat Gin Tonic', '5 cl Bluecoat American Dry Gin\r\n10-12 cl Tónica\r\nNaranja', '80', 'añadir la ginebra Bluecoat American Dry Gin en una copa highball llena de hielo en roca. Agregar la tónica, remover y decorar con piel de naranja.'),
(5, 1, 'Orgasmo', '– 1 oz (30 ml) Bayleys\r\n– 1 oz (30 ml) Kahlua\r\n– 1 oz (30 ml) Disaronno\r\n– 2 oz (60 ml) leche o bebida vegetal\r\n– cubitos de hielo', '70', '1. Llena el vaso con hielo.\r\n2. Agrega todos los licores y revuelve con una cuchara.\r\n3. Opcionalmente añade leche (o leche vegetal).\r\n4. Disfruta el sabor “orgasmico”de este cocktail!'),
(6, 1, 'Mojito Cubano', '2  cucharaditas de azúcar blanco\r\n8 hojas de hierbabuena (2 ramitas de menta)\r\n30 ml de zumo de lima\r\n60 ml. de ron cubano (hemos empleado Havana Club Añejo 3 Años)\r\n1/2 lima en rodajas o cuartos\r\n120 ml. de Soda (Agua con gas con sifón)\r\nHielo picado o pilé\r\nUnas gotas de angostura (opcional)', '70', 'Para preparar un mojito perfecto se van a necesitar 6 ingredientes fundamentales: ron de calidad, hierbabuena, lima fresca, azúcar blanca, hielo y soda.'),
(7, 2, 'Agua Epura 1L', 'Agua natural', '25', 'Agua natural');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `id_datos_usuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `passw` varchar(50) NOT NULL,
  `tipo_usu` enum('ADMIN','MESERO','COCINERO','SuPPort') DEFAULT NULL,
  `ult_fecha_conexion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_datos_usuario`, `usuario`, `passw`, `tipo_usu`, `ult_fecha_conexion`) VALUES
(3, 3, 'e1', '123', 'MESERO', '2022-04-20 16:32:58'),
(4, 4, 'a1', '123', 'ADMIN', '2022-04-20 16:52:09'),
(5, 5, 'Beny123', '123', 'MESERO', '2022-04-22 20:54:30'),
(6, 6, 'c1', '123', 'COCINERO', '2022-05-03 01:17:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_datos`
--

CREATE TABLE `usuarios_datos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `num_tel` varchar(20) NOT NULL,
  `correo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios_datos`
--

INSERT INTO `usuarios_datos` (`id`, `nombre`, `apellidos`, `num_tel`, `correo`) VALUES
(3, 'Benito', 'Super Administrador', '7448556999', 'hshs@hajs.com'),
(4, 'Ernesto Javier', 'Roblez Méndez', '4545184', 'bsjsjs@jajd.con'),
(5, 'Beny Antonio', 'Jiménez Juárez', '7581883636', 'kajebdbjsjs@jajs.com'),
(6, 'Javier', 'Santos Roblez', '7581045588', 'javier@da.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `botellasycocteles`
--
ALTER TABLE `botellasycocteles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoriademenu`
--
ALTER TABLE `categoriademenu`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`idmesas`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idpedididos`);

--
-- Indices de la tabla `terrazas`
--
ALTER TABLE `terrazas`
  ADD PRIMARY KEY (`idterrazas`);

--
-- Indices de la tabla `tiposcoctelesytragos`
--
ALTER TABLE `tiposcoctelesytragos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_datos`
--
ALTER TABLE `usuarios_datos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `botellasycocteles`
--
ALTER TABLE `botellasycocteles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categoriademenu`
--
ALTER TABLE `categoriademenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria de la tabla, se encarga de llevar un registro unico', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `idmesas` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador unico', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idpedididos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT de la tabla `terrazas`
--
ALTER TABLE `terrazas`
  MODIFY `idterrazas` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador unico de control de la tabla', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tiposcoctelesytragos`
--
ALTER TABLE `tiposcoctelesytragos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios_datos`
--
ALTER TABLE `usuarios_datos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
