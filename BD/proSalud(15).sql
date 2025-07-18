-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 01-07-2025 a las 12:30:29
-- Versión del servidor: 10.6.15-MariaDB
-- Versión de PHP: 8.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proSalud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antecedentes`
--

CREATE TABLE `antecedentes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paciente_id` bigint(20) UNSIGNED NOT NULL,
  `alergias` varchar(255) DEFAULT NULL,
  `condiciones_medicas` varchar(255) DEFAULT NULL,
  `medicamentos` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `antecedentes`
--

INSERT INTO `antecedentes` (`id`, `paciente_id`, `alergias`, `condiciones_medicas`, `medicamentos`, `created_at`, `updated_at`) VALUES
(1, 1, 'Polen, Penicilina', 'Asma', 'Salbutamol', NULL, NULL),
(2, 1, 'Gluten', 'Diabetes Tipo 2', 'Metformina', NULL, NULL),
(3, 1, 'Nueces', 'Hipertensión', 'Enalapril', NULL, NULL),
(4, 1, 'Lácteos', 'Migrañas crónicas', 'Ibuprofeno', NULL, NULL),
(5, 1, 'Mariscos', 'Epilepsia', 'Valproato de sodio', NULL, NULL),
(6, 2, 'Gluten', 'Diabetes Tipo 1', 'Valproato de sodio', NULL, NULL),
(7, 4, 'Ibuprofeno', 'HTA, DM II, Cancer de cervix', 'Losartan, metformina', '2025-06-14 11:37:34', '2025-06-14 11:37:34'),
(8, 4, 'Ibuprofeno', 'HTA, DM II, Cancer de cervix', 'Losartan, metformina', '2025-06-14 11:37:35', '2025-06-14 11:37:35'),
(9, 5, 'Ibuprofeno', 'HTA, DM, epilepsia.', 'Losartán, metformina, aspirina, plávix.', '2025-06-14 18:28:06', '2025-06-14 18:28:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos_blog`
--

CREATE TABLE `articulos_blog` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `resumen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenido` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen_destacada` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` enum('borrador','publicado','archivado') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'borrador',
  `categoria_id` bigint(20) UNSIGNED NOT NULL,
  `autor_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_publicacion` timestamp NULL DEFAULT NULL,
  `seo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `vistas` int(11) NOT NULL DEFAULT 0,
  `destacado` tinyint(1) NOT NULL DEFAULT 0,
  `permite_comentarios` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articulos_blog`
--

INSERT INTO `articulos_blog` (`id`, `titulo`, `slug`, `resumen`, `contenido`, `imagen_destacada`, `estado`, `categoria_id`, `autor_id`, `fecha_publicacion`, `seo`, `vistas`, `destacado`, `permite_comentarios`, `created_at`, `updated_at`) VALUES
(2, 'XX', 'xx', 'CC', 'DD', 'blog/2/imagenes/1750798314_xx.jpg', 'publicado', 5, 33, '2025-06-24 17:49:00', '{\"title\":\"a\",\"description\":\"b\",\"keywords\":\"c,d\"}', 1, 1, 1, '2025-06-24 17:49:45', '2025-07-01 09:29:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo_etiqueta`
--

CREATE TABLE `articulo_etiqueta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `articulo_id` bigint(20) UNSIGNED NOT NULL,
  `etiqueta_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `articulo_etiqueta`
--

INSERT INTO `articulo_etiqueta` (`id`, `articulo_id`, `etiqueta_id`, `created_at`, `updated_at`) VALUES
(2, 2, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('prosalud_cache_paciente@prosalud.com|127.0.0.1', 'i:1;', 1751372801),
('prosalud_cache_paciente@prosalud.com|127.0.0.1:timer', 'i:1751372801;', 1751372801);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_blog`
--

CREATE TABLE `categorias_blog` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias_blog`
--

INSERT INTO `categorias_blog` (`id`, `nombre`, `slug`, `descripcion`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'XX', 'xx', 'CC', 1, '2025-06-24 17:34:01', '2025-06-24 17:34:01'),
(2, 'ZZ', 'zz', 'YYY', 1, '2025-06-24 17:35:35', '2025-06-24 17:35:35'),
(3, 'QQ', 'qq', 'EE', 1, '2025-06-24 17:36:18', '2025-06-24 17:36:18'),
(4, 'MM', 'mm', 'nn', 1, '2025-06-24 17:37:07', '2025-06-24 17:37:07'),
(5, 'Medicina Interna', 'medicina-interna', 'AAA', 1, '2025-06-24 17:43:08', '2025-06-24 17:43:08'),
(6, 'mmm', 'mmm', 'nnn', 1, '2025-06-24 18:48:50', '2025-06-24 18:48:50'),
(7, 'dfggfd', 'dfggfd', 'bvcb', 1, '2025-06-24 18:49:24', '2025-06-24 18:49:24'),
(8, 'Prueba', 'prueba', 'prueba', 1, '2025-06-24 18:50:28', '2025-06-24 18:50:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_profesionales`
--

CREATE TABLE `categoria_profesionales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria_profesionales`
--

INSERT INTO `categoria_profesionales` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`, `orden`) VALUES
(1, 'Médicos', 'Médicos', NULL, NULL, 1),
(2, 'Dentisas', 'Dentisas', NULL, NULL, 2),
(3, 'Psicólogos', 'Psicólogos', NULL, NULL, 3),
(4, 'Fisioterapeutas', 'Fisioterapeutas', NULL, NULL, 4),
(5, 'Médicos estéticos', 'Médicos estéticos', NULL, NULL, 5),
(6, 'Podólogos', 'Podólogos', NULL, NULL, 6),
(7, 'Odontólogo', 'Odontólogo', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paciente_id` bigint(20) UNSIGNED NOT NULL,
  `profesional_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `codigo_qr` varchar(255) NOT NULL,
  `modalidad` enum('presencial','videoconsulta') NOT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `consultorio_id` bigint(20) UNSIGNED DEFAULT NULL,
  `url_meet` varchar(255) DEFAULT NULL,
  `estado` enum('pendiente','aceptada','cancelada','completada','noacude') NOT NULL DEFAULT 'pendiente',
  `recordatorio_enviado` tinyint(1) NOT NULL DEFAULT 0,
  `informe_creado` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `especializacion_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `paciente_id`, `profesional_id`, `fecha_hora`, `codigo_qr`, `modalidad`, `motivo`, `consultorio_id`, `url_meet`, `estado`, `recordatorio_enviado`, `informe_creado`, `created_at`, `updated_at`, `especializacion_id`) VALUES
(44, 1, 1, '2025-06-26 23:21:52', 'XX', 'presencial', 'Dolor de cabeza', 32, NULL, 'pendiente', 1, 0, NULL, '2025-06-26 15:36:54', 19),
(46, 10, 19, '2025-06-26 17:30:00', '9L9RLLUI', 'presencial', NULL, 35, NULL, 'aceptada', 0, 0, '2025-06-25 17:22:33', '2025-06-25 17:22:33', 21),
(48, 1, 1, '2025-07-01 13:00:00', 'LVMXOJUD', 'videoconsulta', 'Revisión cardiólogo', NULL, 'https://meet.google.com/3u0-0bxn', 'aceptada', 0, 0, '2025-06-27 04:08:04', '2025-07-01 10:19:11', 19),
(49, 1, 1, '2025-07-01 17:30:00', 'ICV3JW4L', 'presencial', 'Problema de acceso', 8, NULL, 'aceptada', 0, 0, '2025-07-01 10:16:10', '2025-07-01 10:16:10', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provincia_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id`, `provincia_id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 1, 'Esmeraldas', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(2, 2, 'Portoviejo', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(3, 3, 'Santo Domingo', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(4, 4, 'Babahoyo', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(5, 5, 'Santa Elena', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(6, 6, 'Guayaquil', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(7, 6, 'Daule', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(8, 6, 'Samborondón', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(9, 6, 'Isla Mocolí', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(10, 6, 'Ciudad Celeste', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(11, 6, 'La Aurora', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(12, 7, 'Machala', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(13, 8, 'Tulcán', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(14, 9, 'Ibarra', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(15, 10, 'Quito', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(16, 10, 'Valle de los Chillos', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(17, 10, 'Cumbayá', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(18, 10, 'Tumbaco', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(19, 11, 'Latacunga', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(20, 12, 'Ambato', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(21, 13, 'Riobamba', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(22, 14, 'Guaranda', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(23, 15, 'Azogues', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(24, 16, 'Cuenca', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(25, 17, 'Loja', '2025-06-05 02:38:08', '2025-06-05 02:38:08'),
(26, 18, 'Nueva Loja', '2025-06-05 02:38:09', '2025-06-05 02:38:09'),
(27, 19, 'Tena', '2025-06-05 02:38:09', '2025-06-05 02:38:09'),
(28, 20, 'Francisco de Orellana', '2025-06-05 02:38:09', '2025-06-05 02:38:09'),
(29, 21, 'Puyo', '2025-06-05 02:38:09', '2025-06-05 02:38:09'),
(30, 22, 'Macas', '2025-06-05 02:38:09', '2025-06-05 02:38:09'),
(31, 23, 'Zamora', '2025-06-05 02:38:09', '2025-06-05 02:38:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultorios`
--

CREATE TABLE `consultorios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profesional_id` bigint(20) UNSIGNED NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `direccion_maps` varchar(255) DEFAULT NULL,
  `imagenes` varchar(255) DEFAULT NULL,
  `clinica` varchar(255) DEFAULT NULL,
  `info_adicional` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `consultorios`
--

INSERT INTO `consultorios` (`id`, `profesional_id`, `direccion`, `direccion_maps`, `imagenes`, `clinica`, `info_adicional`, `created_at`, `updated_at`) VALUES
(5, 3, 'Avenida Blazco Ibañez 72, 46470, Masanassa, Valencia', 'https://maps.app.goo.gl/dzFqPBX55xiFfkgJ9', 'imagen.png', 'Central Calixto García', 'No hay luz', '2025-06-05 03:05:58', '2025-06-05 03:05:58'),
(6, 3, 'Calle Juan  LLorens 35, 46006, Valencia', 'https://maps.app.goo.gl/dzFqPBX55xiFfkgJ9', 'imagen.png', 'Hospital La Fe', NULL, '2025-06-05 03:06:36', '2025-06-05 03:06:36'),
(8, 1, 'Maestro Aguilar 28, 46006, Valencia', 'https://maps.app.goo.gl/dzFqPBX55xiFfkgJ9', 'imagen.png', 'Central Calixto García', 'No hay agua', '2025-06-06 09:38:50', '2025-06-06 09:38:50'),
(11, 1, 'Calle Colón 27, 46006, valencia, España', 'https://maps.app.goo.gl/dzFqPBX55xiFfkgJ9', 'imagen.png', 'Central Calixto García', 'No hay luz', '2025-06-06 12:40:27', '2025-06-06 12:40:27'),
(13, 3, 'calle rogrigo maestre 87, 46005,Valencia,España', 'https://maps.app.goo.gl/dzFqPBX55xiFfkgJ9', 'imagen.png', 'Central Calixto García', 'No hay luz', '2025-06-06 13:52:09', '2025-06-06 13:52:09'),
(14, 4, 'calle rogrigo maestre 87, 46005, Valencia, España', 'https://maps.app.goo.gl/dzFqPBX55xiFfkgJ9', 'imagen.png', 'Hospital La Fe', 'No hay luz', '2025-06-09 14:50:01', '2025-06-09 14:50:01'),
(15, 4, 'Calle Colón 87, 46470, Valencia, España', 'https://maps.app.goo.gl/dzFqPBX55xiFfkgJ9', 'imagen.png', 'Hospital La Fe', 'No hay agua', '2025-06-09 14:50:45', '2025-06-09 14:50:45'),
(19, 4, 'Av. Rio amazonas E3-272 entre Inglaterra y Alemania, Quito, Ecuador', 'https://maps.app.goo.gl/dzFqPBX55xiFfkgJ9', 'imagen.png', 'Central Calixto García', 'No hay luz', '2025-06-09 15:29:30', '2025-06-09 15:29:30'),
(20, 6, 'Av. Dr. Jorge Perez Concha 905, Guayaquil 090511', NULL, NULL, 'Semedic', 'Atención 24 horas', '2025-06-10 15:46:07', '2025-06-10 15:46:07'),
(21, 6, 'Calle Abel Romeo Castillo 13 E NE y, Av. Juan Tanca Marengo, Guayaquil 090150', NULL, NULL, 'Torre Médica II Omni Hospital', 'PISO 8, CONSULTORIO 802', '2025-06-10 15:48:27', '2025-06-10 15:48:27'),
(22, 7, 'Torre Medica Xima, Av. Francisco Boloña 717, Guayaquil 090512', NULL, NULL, 'Medical Point Centro de Especialidades Medicas', 'HAY PARQUEO PRIVADO', '2025-06-10 16:43:32', '2025-06-10 16:43:32'),
(23, 7, 'Calle 29 y O\'connors, Guayaquil', NULL, NULL, 'Hospital Guayaquil Abel Gilbert Pontón', 'Atención 24 horas', '2025-06-10 16:45:02', '2025-06-10 16:45:02'),
(24, 8, 'Av. Mariana de Jesús s/n, Quito 170521', NULL, NULL, 'Hospital Metropolitano de Quito', 'Atención 24 horas', '2025-06-10 17:24:38', '2025-06-10 17:24:38'),
(25, 8, 'Vozandes y Av. América, Quito 170104', NULL, NULL, 'Centro Médico Integral AXXIS', 'HAY PARQUEO PRIVADO', '2025-06-10 17:27:09', '2025-06-10 17:27:09'),
(26, 9, 'Francisco Alava Oe6-64 y San Gabriel, Quito 170147', NULL, NULL, 'Alianza Hospital', 'PISO 5, CONSULTORIO 506', '2025-06-10 23:22:08', '2025-06-10 23:22:08'),
(27, 9, 'Av. Interoceánica km 12.5 y, Av. Florencia 1 2 y, Quito 170902', NULL, NULL, 'HOSPITAL DE LOS VALLES', 'Atención 24 horas', '2025-06-10 23:24:05', '2025-06-10 23:24:05'),
(28, 9, 'Av. de la Prensa, Quito 170104', NULL, NULL, 'NORTHOSPITAL', 'ATENCION SOLO SABADOS', '2025-06-10 23:25:44', '2025-06-10 23:25:44'),
(29, 10, 'Miguel Cordero Dávila 6-111, Cuenca 010107', NULL, NULL, 'Hospital Monte Sinaí', 'PISO 3, CONSULTORIO 303', '2025-06-10 23:50:39', '2025-06-10 23:50:39'),
(30, 10, 'Avenida 24 de Mayo y Avenida de las Américas, Cuenca', NULL, NULL, 'Hospital Del Río', 'TORRE 2, PISO 4, CONSULTORIO 408', '2025-06-10 23:53:14', '2025-06-10 23:53:14'),
(31, 11, 'Avenida Manuel J. Calle, Cuenca 010107', NULL, NULL, 'HOSPITAL SAN JUAN DE DIOS', 'PISO 6, CONSULTORIO 602', '2025-06-11 00:22:28', '2025-06-11 00:22:28'),
(32, 11, 'Agustín Cueva Vallejo Y Daniel Córdova Toral, Cuenca', NULL, NULL, 'HOSPITAL SANTA INES', 'PISO 5, CONSULTORIO 505', '2025-06-11 00:25:53', '2025-06-11 00:25:53'),
(33, 12, 'Av. 10 de Agosto N226-40', 'https://maps.app.goo.gl/kiv5oqjGpbhaZRh66', NULL, 'Hospital Metropilitano', 'Planta 8, consultio 812', '2025-06-11 13:50:17', '2025-06-11 13:50:17'),
(34, 19, 'Av. Amazonas N93-81', NULL, NULL, 'Hospital Metropilitano', 'Planta 8, consultio 812', '2025-06-25 17:00:48', '2025-06-25 17:00:48'),
(35, 19, 'Av. 10 de Agosto N226-40', NULL, NULL, 'Hospital Vozandes', 'Planta 14, consultio 145', '2025-06-25 17:01:19', '2025-06-25 17:01:19'),
(36, 5, 'Avenida de las Américas y calle 13E ne, Guayaquil, Ecuador', NULL, NULL, 'Central Calixto García', NULL, '2025-07-01 09:53:15', '2025-07-01 09:53:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultorio_imagenes`
--

CREATE TABLE `consultorio_imagenes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `consultorio_id` bigint(20) UNSIGNED NOT NULL,
  `imagen_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `consultorio_imagenes`
--

INSERT INTO `consultorio_imagenes` (`id`, `consultorio_id`, `imagen_path`, `created_at`, `updated_at`) VALUES
(3, 8, 'consultorios/8/6849911e350ab.jpg', '2025-06-11 12:22:22', '2025-06-11 12:22:22'),
(5, 8, 'consultorios/8/684997dbe3ce0.jpg', '2025-06-11 12:51:07', '2025-06-11 12:51:07'),
(9, 22, 'consultorios/22/6849b63bdc410.jpg', '2025-06-11 15:00:43', '2025-06-11 15:00:43'),
(10, 22, 'consultorios/22/6849b63bddac3.jpg', '2025-06-11 15:00:43', '2025-06-11 15:00:43'),
(14, 34, 'consultorios/34/685c4bd2c1dfb.jpg', '2025-06-25 17:19:46', '2025-06-25 17:19:46'),
(15, 35, 'consultorios/35/685c4beb8e00d.jpg', '2025-06-25 17:20:11', '2025-06-25 17:20:11'),
(16, 11, 'consultorios/11/685d4d37415d6.jpg', '2025-06-26 11:37:59', '2025-06-26 11:37:59'),
(17, 11, 'consultorios/11/685d4d434b751.jpg', '2025-06-26 11:38:11', '2025-06-26 11:38:11'),
(18, 11, 'consultorios/11/685d4d434bfc7.jpg', '2025-06-26 11:38:11', '2025-06-26 11:38:11'),
(23, 36, 'consultorios/36/6863cf8328cee.jpg', '2025-07-01 10:07:31', '2025-07-01 10:07:31'),
(24, 36, 'consultorios/36/6863cf832c530.jpg', '2025-07-01 10:07:31', '2025-07-01 10:07:31'),
(25, 36, 'consultorios/36/6863cf832d3d2.jpg', '2025-07-01 10:07:31', '2025-07-01 10:07:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos_admin`
--

CREATE TABLE `contactos_admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profesional_id` bigint(20) UNSIGNED NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `respuesta` text DEFAULT NULL,
  `estado` enum('pendiente','pasado') NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contactos_admin`
--

INSERT INTO `contactos_admin` (`id`, `profesional_id`, `motivo`, `descripcion`, `respuesta`, `estado`, `created_at`, `updated_at`) VALUES
(2, 1, 'Problema de acceso', 'Hola, buenos días. me falla el acceso a los informes médicos', 'los informes médicos debes llenarlo con los valores coprrespondientes y que el paciente esté activo. Revise esas condiciones por favor. Saludos', 'pendiente', '2025-05-15 05:52:01', '2025-05-15 05:52:01'),
(3, 1, 'Excelnete servicio', 'Muchas gracia spor el servicio que ofreces. Ya me funciona bien mi perfil', NULL, 'pendiente', '2025-05-15 05:58:28', '2025-05-15 05:58:28'),
(4, 1, 'XXXBBBB', 'probandooooo', NULL, 'pendiente', '2025-05-15 05:59:28', '2025-05-15 05:59:28'),
(5, 1, 'XX', 'AAA', NULL, 'pendiente', '2025-05-19 14:04:01', '2025-05-19 14:04:01'),
(6, 1, 'gfhg', 'hgfhgfhf', NULL, 'pendiente', '2025-05-19 14:06:14', '2025-05-19 14:06:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos_emergencia`
--

CREATE TABLE `contactos_emergencia` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paciente_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `relacion` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contactos_emergencia`
--

INSERT INTO `contactos_emergencia` (`id`, `paciente_id`, `nombre`, `relacion`, `telefono`, `created_at`, `updated_at`) VALUES
(1, 1, 'Juan Pérez', 'Padre', '123456789', NULL, NULL),
(2, 1, 'María López', 'Madre', '987654321', NULL, NULL),
(3, 1, 'Carlos Gómez', 'Hermano', '555666777', NULL, NULL),
(4, 1, 'Ana Torres', 'Esposa', '444333222', NULL, NULL),
(5, 1, 'Luis Martínez', 'Amigo', '888999000', NULL, NULL),
(6, 2, 'Juan Pérez', 'Hermano', '699789456', NULL, NULL),
(7, 4, 'Virgilio Gonzalez', 'Esposo', '0993730047', '2025-06-14 11:39:22', '2025-06-14 11:39:22'),
(8, 5, 'Juan Mercante', 'Esposo', '0993746652', '2025-06-14 18:28:59', '2025-06-14 18:28:59'),
(9, 7, 'Juan Córdova', 'Padre', '0991113561', '2025-06-15 15:40:20', '2025-06-15 15:40:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_cita`
--

CREATE TABLE `detalle_cita` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cita_id` bigint(20) UNSIGNED NOT NULL,
  `metodo_pago_id` bigint(20) UNSIGNED DEFAULT NULL,
  `estado_pago` enum('pendiente','pagado','cancelado') NOT NULL DEFAULT 'pendiente',
  `fecha_pago` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `monto` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_cita`
--

INSERT INTO `detalle_cita` (`id`, `cita_id`, `metodo_pago_id`, `estado_pago`, `fecha_pago`, `created_at`, `updated_at`, `monto`) VALUES
(15, 46, 1, 'pendiente', NULL, '2025-06-25 17:22:33', '2025-06-25 17:22:33', 50),
(17, 48, 2, 'pendiente', NULL, '2025-06-27 04:08:04', '2025-06-27 04:12:01', 50),
(18, 49, 1, 'pendiente', NULL, '2025-07-01 10:16:10', '2025-07-01 10:16:10', 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_horarios`
--

CREATE TABLE `detalle_horarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `horario_id` bigint(20) UNSIGNED NOT NULL,
  `hora_desde` time NOT NULL,
  `hora_hasta` time NOT NULL,
  `bloqueado` tinyint(1) NOT NULL DEFAULT 0,
  `consultorio_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_horarios`
--

INSERT INTO `detalle_horarios` (`id`, `horario_id`, `hora_desde`, `hora_hasta`, `bloqueado`, `consultorio_id`, `created_at`, `updated_at`) VALUES
(3275, 2400, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3277, 2401, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3279, 2402, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3281, 2403, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3283, 2404, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3285, 2405, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3287, 2406, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3289, 2407, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3291, 2408, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3293, 2409, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3295, 2410, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3297, 2411, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3299, 2412, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3301, 2413, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3303, 2414, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3305, 2415, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3307, 2416, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3309, 2417, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3311, 2418, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3313, 2419, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3315, 2420, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3317, 2421, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3319, 2422, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3321, 2423, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3323, 2424, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3325, 2425, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3327, 2426, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3329, 2427, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3331, 2428, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3333, 2429, '08:30:00', '13:00:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3335, 2430, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3336, 2431, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3337, 2432, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3338, 2433, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3339, 2434, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3340, 2435, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3341, 2436, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3342, 2437, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3343, 2438, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3344, 2439, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3345, 2440, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3346, 2441, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3347, 2442, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3348, 2443, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3349, 2444, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3350, 2445, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3351, 2446, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3352, 2447, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3353, 2448, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3354, 2449, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3355, 2450, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3356, 2451, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3357, 2452, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3358, 2453, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3359, 2454, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3360, 2455, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3361, 2456, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3362, 2457, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3363, 2458, '12:30:00', '20:30:00', 0, 8, '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(3364, 2459, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3365, 2460, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3366, 2461, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3367, 2462, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3368, 2463, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3369, 2464, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3370, 2465, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3371, 2466, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3372, 2467, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3373, 2468, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3374, 2469, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3375, 2470, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3376, 2471, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3377, 2472, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3378, 2473, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3379, 2474, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3380, 2475, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3381, 2476, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3382, 2477, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3383, 2478, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3384, 2479, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3385, 2480, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3386, 2481, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3387, 2482, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3388, 2483, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3389, 2484, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3390, 2485, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3391, 2486, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3392, 2487, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3393, 2488, '15:00:00', '21:30:00', 0, 11, '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(3394, 2489, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3395, 2490, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3396, 2491, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3397, 2492, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3398, 2493, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3399, 2494, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3400, 2495, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3401, 2496, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3402, 2497, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3403, 2498, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3404, 2499, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3405, 2500, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3406, 2501, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3407, 2502, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3408, 2503, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3409, 2504, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3410, 2505, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3411, 2506, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3412, 2507, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3413, 2508, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3414, 2509, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3415, 2510, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3416, 2511, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3417, 2512, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3418, 2513, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3419, 2514, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3420, 2515, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3421, 2516, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3422, 2517, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3423, 2518, '16:30:00', '19:30:00', 0, 8, '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(3424, 2519, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3425, 2520, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3426, 2521, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3427, 2522, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3428, 2523, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3429, 2524, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3430, 2525, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3431, 2526, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3432, 2527, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3433, 2528, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3434, 2529, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3435, 2530, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3436, 2531, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3437, 2532, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3438, 2533, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3439, 2534, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3440, 2535, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3441, 2536, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3442, 2537, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3443, 2538, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3444, 2539, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3445, 2540, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3446, 2541, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3447, 2542, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3448, 2543, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3449, 2544, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3450, 2545, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3451, 2546, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3452, 2547, '08:30:00', '10:30:00', 0, 11, '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(3453, 2548, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3454, 2549, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3455, 2550, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3456, 2551, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3457, 2552, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3458, 2553, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3459, 2554, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3460, 2555, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3461, 2556, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3462, 2557, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3463, 2558, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3464, 2559, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3465, 2560, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3466, 2561, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3467, 2562, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3468, 2563, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3469, 2564, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3470, 2565, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3471, 2566, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3472, 2567, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3473, 2568, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3474, 2569, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3475, 2570, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3476, 2571, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3477, 2572, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3478, 2573, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3479, 2574, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3480, 2575, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3481, 2576, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3482, 2577, '10:30:00', '15:30:00', 0, 5, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3483, 2578, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3484, 2579, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3485, 2580, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3486, 2581, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3487, 2582, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3488, 2583, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3489, 2584, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3490, 2585, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3491, 2586, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3492, 2587, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3493, 2588, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3494, 2589, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3495, 2590, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3496, 2591, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3497, 2592, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3498, 2593, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3499, 2594, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3500, 2595, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3501, 2596, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3502, 2597, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3503, 2598, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3504, 2599, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3505, 2600, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3506, 2601, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3507, 2602, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3508, 2603, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3509, 2604, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3510, 2605, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3511, 2606, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3512, 2607, '18:00:00', '22:00:00', 0, 6, '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(3513, 2608, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3514, 2608, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3515, 2609, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3516, 2609, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3517, 2610, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3518, 2610, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3519, 2611, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3520, 2611, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3521, 2612, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3522, 2612, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3523, 2613, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3524, 2613, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3525, 2614, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3526, 2614, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3527, 2615, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3528, 2615, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3529, 2616, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3530, 2616, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3531, 2617, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3532, 2617, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3533, 2618, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3534, 2618, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3535, 2619, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3536, 2619, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3537, 2620, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3538, 2620, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3539, 2621, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3540, 2621, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3541, 2622, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3542, 2622, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3543, 2623, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3544, 2623, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3545, 2624, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3546, 2624, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3547, 2625, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3548, 2625, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3549, 2626, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3550, 2626, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3551, 2627, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3552, 2627, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3553, 2628, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3554, 2628, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3555, 2629, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3556, 2629, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3557, 2630, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3558, 2630, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3559, 2631, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3560, 2631, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3561, 2632, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3562, 2632, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3563, 2633, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3564, 2633, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3565, 2634, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3566, 2634, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3567, 2635, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3568, 2635, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3569, 2636, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3570, 2636, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3571, 2637, '08:30:00', '12:30:00', 0, 14, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3572, 2637, '16:30:00', '20:00:00', 0, 15, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3573, 2638, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3574, 2639, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3575, 2640, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3576, 2641, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3577, 2642, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3578, 2643, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3579, 2644, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3580, 2645, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3581, 2646, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3582, 2647, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3583, 2648, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3584, 2649, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3585, 2650, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3586, 2651, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3587, 2652, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3588, 2653, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3589, 2654, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3590, 2655, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3591, 2656, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3592, 2657, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3593, 2658, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3594, 2659, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3595, 2660, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3596, 2661, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3597, 2662, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3598, 2663, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3599, 2664, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3600, 2665, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3601, 2666, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3602, 2667, '10:00:00', '13:30:00', 0, 19, '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(3603, 2668, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3604, 2668, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3605, 2669, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3606, 2669, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3607, 2670, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3608, 2670, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3609, 2671, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3610, 2671, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3611, 2672, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3612, 2672, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3613, 2673, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3614, 2673, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3615, 2674, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3616, 2674, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3617, 2675, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3618, 2675, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3619, 2676, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3620, 2676, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3621, 2677, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3622, 2677, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3623, 2678, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3624, 2678, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3625, 2679, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3626, 2679, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3627, 2680, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3628, 2680, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3629, 2681, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3630, 2681, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3631, 2682, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3632, 2682, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3633, 2683, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3634, 2683, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3635, 2684, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3636, 2684, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3637, 2685, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3638, 2685, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3639, 2686, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3640, 2686, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3641, 2687, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3642, 2687, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3643, 2688, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3644, 2688, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3645, 2689, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3646, 2689, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3647, 2690, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3648, 2690, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3649, 2691, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3650, 2691, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3651, 2692, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3652, 2692, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3653, 2693, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3654, 2693, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3655, 2694, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3656, 2694, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3657, 2695, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3658, 2695, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3659, 2696, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3660, 2696, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3661, 2697, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3662, 2698, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3663, 2699, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3664, 2700, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3665, 2701, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3666, 2702, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3667, 2703, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3668, 2704, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3669, 2705, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3670, 2706, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3671, 2707, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3672, 2708, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3673, 2709, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3674, 2710, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3675, 2711, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3676, 2712, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3677, 2713, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3678, 2714, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3679, 2715, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3680, 2716, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3681, 2717, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3682, 2718, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3683, 2719, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3684, 2720, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3685, 2721, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3686, 2722, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3687, 2723, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3688, 2724, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3689, 2725, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3690, 2726, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3691, 2727, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3692, 2727, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3693, 2728, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3694, 2728, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3695, 2729, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3696, 2729, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3697, 2730, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3698, 2730, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3699, 2731, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3700, 2731, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3701, 2732, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3702, 2732, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3703, 2733, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3704, 2733, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3705, 2734, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3706, 2734, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3707, 2735, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3708, 2735, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3709, 2736, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3710, 2736, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3711, 2737, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3712, 2737, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3713, 2738, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3714, 2738, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3715, 2739, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3716, 2739, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3717, 2740, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3718, 2740, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3719, 2741, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3720, 2741, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3721, 2742, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3722, 2742, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3723, 2743, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3724, 2743, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3725, 2744, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3726, 2744, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3727, 2745, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3728, 2745, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3729, 2746, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3730, 2746, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3731, 2747, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3732, 2747, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3733, 2748, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3734, 2748, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3735, 2749, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3736, 2749, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3737, 2750, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3738, 2750, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3739, 2751, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3740, 2751, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3741, 2752, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3742, 2752, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3743, 2753, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3744, 2753, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3745, 2754, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3746, 2754, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3747, 2755, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3748, 2755, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3749, 2756, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3750, 2756, '15:30:00', '19:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3751, 2757, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3752, 2758, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3753, 2759, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3754, 2760, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3755, 2761, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3756, 2762, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3757, 2763, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3758, 2764, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3759, 2765, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3760, 2766, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3761, 2767, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(3762, 2768, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3763, 2769, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3764, 2770, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3765, 2771, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3766, 2772, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3767, 2773, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3768, 2774, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3769, 2775, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3770, 2776, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3771, 2777, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3772, 2778, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3773, 2779, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3774, 2780, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3775, 2781, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3776, 2782, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3777, 2783, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3778, 2784, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3779, 2785, '15:00:00', '18:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3780, 2786, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3781, 2787, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3782, 2788, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3783, 2789, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3784, 2790, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3785, 2791, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3786, 2792, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3787, 2793, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3788, 2794, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3789, 2795, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3790, 2796, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3791, 2797, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3792, 2798, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3793, 2799, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3794, 2800, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3795, 2801, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3796, 2802, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3797, 2803, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3798, 2804, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3799, 2805, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3800, 2806, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3801, 2807, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3802, 2808, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3803, 2809, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3804, 2810, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3805, 2811, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3806, 2812, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3807, 2813, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3808, 2814, '10:00:00', '12:00:00', 0, 20, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3809, 2815, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3810, 2816, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3811, 2817, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3812, 2818, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3813, 2819, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3814, 2820, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3815, 2821, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3816, 2822, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3817, 2823, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3818, 2824, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3819, 2825, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3820, 2826, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3821, 2827, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3822, 2828, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3823, 2829, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3824, 2830, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3825, 2831, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3826, 2832, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3827, 2833, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3828, 2834, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3829, 2835, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3830, 2836, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3831, 2837, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3832, 2838, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3833, 2839, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3834, 2840, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3835, 2841, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3836, 2842, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3837, 2843, '10:00:00', '12:00:00', 0, 21, '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(4248, 3196, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4249, 3197, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4250, 3198, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4251, 3199, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4252, 3200, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4253, 3201, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4254, 3202, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4255, 3203, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4256, 3204, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4257, 3205, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4258, 3206, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4259, 3207, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4260, 3208, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4261, 3209, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4262, 3210, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4263, 3211, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4264, 3212, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4265, 3213, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4266, 3214, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4267, 3215, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4268, 3216, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4269, 3217, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4270, 3218, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4271, 3219, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4272, 3220, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4273, 3221, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4274, 3222, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4275, 3223, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32');
INSERT INTO `detalle_horarios` (`id`, `horario_id`, `hora_desde`, `hora_hasta`, `bloqueado`, `consultorio_id`, `created_at`, `updated_at`) VALUES
(4276, 3224, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4277, 3225, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4278, 3226, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4279, 3227, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4280, 3228, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4281, 3229, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4282, 3230, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4283, 3231, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4284, 3232, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4285, 3233, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4286, 3234, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4287, 3235, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4288, 3236, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4289, 3237, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4290, 3238, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4291, 3239, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4292, 3240, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4293, 3241, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4294, 3242, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4295, 3243, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4296, 3244, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4297, 3245, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4298, 3246, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4299, 3247, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4300, 3248, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4301, 3249, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4302, 3250, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4303, 3251, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4304, 3252, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4305, 3253, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4306, 3254, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4307, 3255, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4308, 3256, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4309, 3257, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4310, 3258, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4311, 3259, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4312, 3260, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4313, 3261, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4314, 3262, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4315, 3263, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4316, 3264, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4317, 3265, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4318, 3266, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4319, 3267, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4320, 3268, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4321, 3269, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4322, 3270, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4323, 3271, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4324, 3272, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4325, 3273, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4326, 3274, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4327, 3275, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4328, 3276, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4329, 3277, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4330, 3278, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4331, 3279, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4332, 3280, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4333, 3281, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4334, 3282, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4335, 3283, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4336, 3284, '09:30:00', '19:30:00', 0, 24, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4337, 3285, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4338, 3286, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4339, 3287, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4340, 3288, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4341, 3289, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4342, 3290, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4343, 3291, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4344, 3292, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4345, 3293, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4346, 3294, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4347, 3295, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4348, 3296, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4349, 3297, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4350, 3298, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4351, 3299, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4352, 3300, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4353, 3301, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4354, 3302, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4355, 3303, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4356, 3304, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4357, 3305, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4358, 3306, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4359, 3307, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4360, 3308, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4361, 3309, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4362, 3310, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4363, 3311, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4364, 3312, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4365, 3313, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4366, 3314, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4367, 3315, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4368, 3316, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4369, 3317, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4370, 3318, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4371, 3319, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4372, 3320, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4373, 3321, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4374, 3322, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4375, 3323, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4376, 3324, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4377, 3325, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4378, 3326, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4379, 3327, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4380, 3328, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4381, 3329, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4382, 3330, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4383, 3331, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4384, 3332, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4385, 3333, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4386, 3334, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4387, 3335, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4388, 3336, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4389, 3337, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4390, 3338, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4391, 3339, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4392, 3340, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4393, 3341, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4394, 3342, '16:00:00', '20:00:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4395, 3343, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4396, 3344, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4397, 3345, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4398, 3346, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4399, 3347, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4400, 3348, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4401, 3349, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4402, 3350, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4403, 3351, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(4404, 3352, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(4405, 3353, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(4406, 3354, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(4407, 3355, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(4408, 3356, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(4409, 3357, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(4410, 3358, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(4411, 3359, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(4412, 3360, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(4413, 3361, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(4414, 3362, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(4415, 3363, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(4416, 3364, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(4417, 3365, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(4418, 3366, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(4419, 3367, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(4420, 3368, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(4421, 3369, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(4422, 3370, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(4423, 3371, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(4424, 3372, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4425, 3373, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4426, 3374, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4427, 3375, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4428, 3376, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4429, 3377, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4430, 3378, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4431, 3379, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4432, 3380, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4433, 3381, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4434, 3382, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4435, 3383, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4436, 3384, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4437, 3385, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4438, 3386, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4439, 3387, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4440, 3388, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4441, 3389, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4442, 3390, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4443, 3391, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4444, 3392, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4445, 3393, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4446, 3394, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4447, 3395, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4448, 3396, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4449, 3397, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4450, 3398, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4451, 3399, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4452, 3400, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(4453, 3401, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4454, 3402, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4455, 3403, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4456, 3404, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4457, 3405, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4458, 3406, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4459, 3407, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4460, 3408, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4461, 3409, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4462, 3410, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4463, 3411, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4464, 3412, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4465, 3413, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4466, 3414, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4467, 3415, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4468, 3416, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4469, 3417, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4470, 3418, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4471, 3419, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4472, 3420, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4473, 3421, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4474, 3422, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4475, 3423, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4476, 3424, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4477, 3425, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4478, 3426, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4479, 3427, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4480, 3428, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4481, 3429, '10:00:00', '12:30:00', 0, 25, '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(4482, 3430, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4483, 3431, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4484, 3432, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4485, 3433, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4486, 3434, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4487, 3435, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4488, 3436, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4489, 3437, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4490, 3438, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4491, 3439, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4492, 3440, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4493, 3441, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4494, 3442, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4495, 3443, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4496, 3444, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4497, 3445, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4498, 3446, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4499, 3447, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4500, 3448, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4501, 3449, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4502, 3450, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4503, 3451, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4504, 3452, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4505, 3453, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4506, 3454, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4507, 3455, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4508, 3456, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4509, 3457, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4510, 3458, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4511, 3459, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4512, 3460, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4513, 3461, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4514, 3462, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4515, 3463, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4516, 3464, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4517, 3465, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4518, 3466, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4519, 3467, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4520, 3468, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4521, 3469, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4522, 3470, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4523, 3471, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4524, 3472, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4525, 3473, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4526, 3474, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4527, 3475, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4528, 3476, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4529, 3477, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4530, 3478, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4531, 3479, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4532, 3480, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4533, 3481, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4534, 3482, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4535, 3483, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4536, 3484, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4537, 3485, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4538, 3486, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4539, 3487, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4540, 3488, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(4541, 3489, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4542, 3490, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4543, 3491, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4544, 3492, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4545, 3493, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4546, 3494, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4547, 3495, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4548, 3496, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4549, 3497, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4550, 3498, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4551, 3499, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4552, 3500, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4553, 3501, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4554, 3502, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4555, 3503, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4556, 3504, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4557, 3505, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4558, 3506, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4559, 3507, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4560, 3508, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4561, 3509, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4562, 3510, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4563, 3511, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4564, 3512, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4565, 3513, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4566, 3514, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4567, 3515, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4568, 3516, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4569, 3517, '10:30:00', '17:30:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4570, 3518, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4571, 3519, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4572, 3520, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4573, 3521, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4574, 3522, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4575, 3523, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4576, 3524, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4577, 3525, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4578, 3526, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4579, 3527, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4580, 3528, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4581, 3529, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4582, 3530, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4583, 3531, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4584, 3532, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4585, 3533, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4586, 3534, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4587, 3535, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4588, 3536, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4589, 3537, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4590, 3538, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4591, 3539, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4592, 3540, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4593, 3541, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4594, 3542, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4595, 3543, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4596, 3544, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4597, 3545, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4598, 3546, '15:30:00', '19:00:00', 0, 26, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4599, 3547, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4600, 3548, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4601, 3549, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4602, 3550, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4603, 3551, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4604, 3552, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4605, 3553, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4606, 3554, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4607, 3555, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4608, 3556, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4609, 3557, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4610, 3558, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4611, 3559, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4612, 3560, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4613, 3561, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4614, 3562, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4615, 3563, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4616, 3564, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4617, 3565, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4618, 3566, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4619, 3567, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4620, 3568, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4621, 3569, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4622, 3570, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4623, 3571, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4624, 3572, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4625, 3573, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4626, 3574, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4627, 3575, '10:00:00', '17:00:00', 0, 27, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4628, 3576, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4629, 3577, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4630, 3578, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4631, 3579, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4632, 3580, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4633, 3581, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4634, 3582, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4635, 3583, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4636, 3584, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4637, 3585, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4638, 3586, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4639, 3587, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4640, 3588, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4641, 3589, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4642, 3590, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4643, 3591, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4644, 3592, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4645, 3593, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4646, 3594, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4647, 3595, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4648, 3596, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4649, 3597, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4650, 3598, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4651, 3599, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4652, 3600, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4653, 3601, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4654, 3602, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4655, 3603, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4656, 3604, '10:00:00', '13:00:00', 0, 28, '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(4657, 3605, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4658, 3605, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4659, 3606, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4660, 3606, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4661, 3607, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4662, 3607, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4663, 3608, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4664, 3608, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4665, 3609, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4666, 3609, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4667, 3610, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4668, 3610, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4669, 3611, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4670, 3611, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4671, 3612, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4672, 3612, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4673, 3613, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4674, 3613, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4675, 3614, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4676, 3614, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4677, 3615, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4678, 3615, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4679, 3616, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4680, 3616, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4681, 3617, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4682, 3617, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4683, 3618, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4684, 3618, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4685, 3619, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4686, 3619, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4687, 3620, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4688, 3620, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4689, 3621, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4690, 3621, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4691, 3622, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4692, 3622, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4693, 3623, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4694, 3623, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4695, 3624, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4696, 3624, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4697, 3625, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4698, 3625, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4699, 3626, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4700, 3626, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4701, 3627, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4702, 3627, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4703, 3628, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4704, 3628, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4705, 3629, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4706, 3629, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4707, 3630, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4708, 3630, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4709, 3631, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4710, 3631, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4711, 3632, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4712, 3632, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4713, 3633, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(4714, 3633, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4715, 3634, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4716, 3634, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4717, 3635, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4718, 3635, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4719, 3636, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4720, 3636, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4721, 3637, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4722, 3637, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4723, 3638, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4724, 3638, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4725, 3639, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4726, 3639, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4727, 3640, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4728, 3640, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4729, 3641, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4730, 3641, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4731, 3642, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4732, 3642, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4733, 3643, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4734, 3643, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4735, 3644, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4736, 3644, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4737, 3645, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4738, 3645, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4739, 3646, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4740, 3646, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4741, 3647, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4742, 3647, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4743, 3648, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4744, 3648, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4745, 3649, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4746, 3649, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4747, 3650, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4748, 3650, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4749, 3651, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4750, 3651, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4751, 3652, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4752, 3652, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4753, 3653, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4754, 3653, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4755, 3654, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4756, 3654, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4757, 3655, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4758, 3655, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4759, 3656, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4760, 3656, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4761, 3657, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4762, 3657, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4763, 3658, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4764, 3658, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4765, 3659, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4766, 3659, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4767, 3660, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4768, 3660, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4769, 3661, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4770, 3661, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4771, 3662, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4772, 3662, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4773, 3663, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4774, 3663, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4775, 3664, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4776, 3664, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4777, 3665, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4778, 3665, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4779, 3666, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4780, 3666, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4781, 3667, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4782, 3667, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4783, 3668, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4784, 3668, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4785, 3669, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4786, 3669, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4787, 3670, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4788, 3670, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4789, 3671, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4790, 3671, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4791, 3672, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4792, 3672, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4793, 3673, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4794, 3673, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4795, 3674, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4796, 3674, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4797, 3675, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4798, 3675, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4799, 3676, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4800, 3676, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4801, 3677, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4802, 3677, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4803, 3678, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4804, 3678, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4805, 3679, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4806, 3679, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4807, 3680, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4808, 3680, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4809, 3681, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4810, 3681, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4811, 3682, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4812, 3682, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4813, 3683, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4814, 3683, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4815, 3684, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4816, 3684, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4817, 3685, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4818, 3685, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4819, 3686, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4820, 3686, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4821, 3687, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4822, 3687, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4823, 3688, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4824, 3688, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4825, 3689, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4826, 3689, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4827, 3690, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4828, 3690, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4829, 3691, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4830, 3691, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4831, 3692, '08:00:00', '12:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4832, 3692, '16:00:00', '18:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4833, 3693, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4834, 3694, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4835, 3695, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16');
INSERT INTO `detalle_horarios` (`id`, `horario_id`, `hora_desde`, `hora_hasta`, `bloqueado`, `consultorio_id`, `created_at`, `updated_at`) VALUES
(4836, 3696, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4837, 3697, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4838, 3698, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4839, 3699, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4840, 3700, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4841, 3701, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4842, 3702, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4843, 3703, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4844, 3704, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4845, 3705, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4846, 3706, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4847, 3707, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4848, 3708, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4849, 3709, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4850, 3710, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4851, 3711, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4852, 3712, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4853, 3713, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4854, 3714, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4855, 3715, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4856, 3716, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4857, 3717, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4858, 3718, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4859, 3719, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4860, 3720, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4861, 3721, '10:00:00', '13:00:00', 0, 30, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4862, 3722, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4863, 3723, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4864, 3724, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4865, 3725, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4866, 3726, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4867, 3727, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4868, 3728, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4869, 3729, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4870, 3730, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4871, 3731, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4872, 3732, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4873, 3733, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4874, 3734, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4875, 3735, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4876, 3736, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4877, 3737, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4878, 3738, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4879, 3739, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4880, 3740, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4881, 3741, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4882, 3742, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4883, 3743, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4884, 3744, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4885, 3745, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4886, 3746, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4887, 3747, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4888, 3748, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4889, 3749, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4890, 3750, '10:00:00', '12:30:00', 0, 29, '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(4891, 3751, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4892, 3751, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4893, 3752, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4894, 3752, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4895, 3753, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4896, 3753, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4897, 3754, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4898, 3754, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4899, 3755, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4900, 3755, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4901, 3756, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4902, 3756, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4903, 3757, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4904, 3757, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4905, 3758, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4906, 3758, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4907, 3759, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4908, 3759, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4909, 3760, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4910, 3760, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4911, 3761, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4912, 3761, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4913, 3762, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4914, 3762, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4915, 3763, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4916, 3763, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4917, 3764, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4918, 3764, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4919, 3765, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4920, 3765, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4921, 3766, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4922, 3766, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4923, 3767, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4924, 3767, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4925, 3768, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4926, 3768, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4927, 3769, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4928, 3769, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4929, 3770, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4930, 3770, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4931, 3771, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4932, 3771, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4933, 3772, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4934, 3772, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4935, 3773, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4936, 3773, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4937, 3774, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4938, 3774, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4939, 3775, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4940, 3775, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4941, 3776, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4942, 3776, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4943, 3777, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4944, 3777, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4945, 3778, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4946, 3778, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4947, 3779, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4948, 3779, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4949, 3780, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4950, 3781, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4951, 3782, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4952, 3783, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4953, 3784, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4954, 3785, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4955, 3786, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4956, 3787, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4957, 3788, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4958, 3789, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4959, 3790, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4960, 3791, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4961, 3792, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4962, 3793, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4963, 3794, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4964, 3795, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4965, 3796, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4966, 3797, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4967, 3798, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4968, 3799, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4969, 3800, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4970, 3801, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4971, 3802, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4972, 3803, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4973, 3804, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4974, 3805, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4975, 3806, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4976, 3807, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4977, 3808, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4978, 3809, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4979, 3810, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4980, 3811, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4981, 3812, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4982, 3813, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4983, 3814, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4984, 3815, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4985, 3816, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4986, 3817, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4987, 3818, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4988, 3819, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4989, 3820, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4990, 3821, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4991, 3822, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4992, 3823, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4993, 3824, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4994, 3825, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4995, 3826, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4996, 3827, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4997, 3828, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4998, 3829, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(4999, 3830, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5000, 3831, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5001, 3832, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5002, 3833, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5003, 3834, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5004, 3835, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5005, 3836, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5006, 3837, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5007, 3838, '11:00:00', '18:00:00', 0, 32, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5008, 3839, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5009, 3839, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5010, 3840, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5011, 3840, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5012, 3841, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5013, 3841, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5014, 3842, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5015, 3842, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5016, 3843, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5017, 3843, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5018, 3844, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5019, 3844, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5020, 3845, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5021, 3845, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5022, 3846, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5023, 3846, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5024, 3847, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5025, 3847, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5026, 3848, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5027, 3848, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(5028, 3849, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5029, 3849, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5030, 3850, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5031, 3850, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5032, 3851, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5033, 3851, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5034, 3852, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5035, 3852, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5036, 3853, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5037, 3853, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5038, 3854, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5039, 3854, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5040, 3855, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5041, 3855, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5042, 3856, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5043, 3856, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5044, 3857, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5045, 3857, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5046, 3858, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5047, 3858, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5048, 3859, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5049, 3859, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5050, 3860, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5051, 3860, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5052, 3861, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5053, 3861, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5054, 3862, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5055, 3862, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5056, 3863, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5057, 3863, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5058, 3864, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5059, 3864, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5060, 3865, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5061, 3865, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5062, 3866, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5063, 3866, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5064, 3867, '10:00:00', '13:00:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5065, 3867, '16:30:00', '19:30:00', 0, 31, '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(5066, 3868, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5067, 3869, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5068, 3870, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5069, 3871, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5070, 3872, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5071, 3873, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5072, 3874, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5073, 3875, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5074, 3876, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5075, 3877, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5076, 3878, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5077, 3879, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5078, 3880, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5079, 3881, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5080, 3882, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5081, 3883, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5082, 3884, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5083, 3885, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5084, 3886, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5085, 3887, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5086, 3888, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5087, 3889, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5088, 3890, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5089, 3891, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5090, 3892, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5091, 3893, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5092, 3894, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5093, 3895, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5094, 3896, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5095, 3897, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5096, 3898, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5097, 3899, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5098, 3900, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5099, 3901, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5100, 3902, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5101, 3903, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5102, 3904, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5103, 3905, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5104, 3906, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5105, 3907, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5106, 3908, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5107, 3909, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5108, 3910, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5109, 3911, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5110, 3912, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5111, 3913, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5112, 3914, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5113, 3915, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5114, 3916, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5115, 3917, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5116, 3918, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5117, 3919, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5118, 3920, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5119, 3921, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5120, 3922, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5121, 3923, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5122, 3924, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5123, 3925, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5124, 3926, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5125, 3927, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5126, 3928, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5127, 3929, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5128, 3930, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5129, 3931, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5130, 3932, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5131, 3933, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5132, 3934, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5133, 3935, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5134, 3936, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5135, 3937, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5136, 3938, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5137, 3939, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5138, 3940, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5139, 3941, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5140, 3942, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5141, 3943, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5142, 3944, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5143, 3945, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5144, 3946, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5145, 3947, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5146, 3948, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5147, 3949, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5148, 3950, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5149, 3951, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5150, 3952, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5151, 3953, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5152, 3954, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5153, 3955, '08:00:00', '21:00:00', 0, 33, '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(5183, 3985, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5184, 3986, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5185, 3987, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5186, 3988, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5187, 3989, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5188, 3990, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5189, 3991, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5190, 3992, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5191, 3993, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5192, 3994, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5193, 3995, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5194, 3996, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5195, 3997, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5196, 3998, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5197, 3999, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5198, 4000, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5199, 4001, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5200, 4002, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5201, 4003, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5202, 4004, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5203, 4005, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5204, 4006, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5205, 4007, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5206, 4008, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5207, 4009, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5208, 4010, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5209, 4011, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5210, 4012, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5211, 4013, '13:30:00', '15:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5212, 4014, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5213, 4015, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5214, 4016, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5215, 4017, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5216, 4018, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5217, 4019, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5218, 4020, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5219, 4021, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5220, 4022, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5221, 4023, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5222, 4024, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5223, 4025, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5224, 4026, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5225, 4027, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5226, 4028, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5227, 4029, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5228, 4030, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5229, 4031, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5230, 4032, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5231, 4033, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5232, 4034, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5233, 4035, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5234, 4036, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5235, 4037, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5236, 4038, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5237, 4039, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5238, 4040, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5239, 4041, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5240, 4042, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5241, 4043, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5242, 4044, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5243, 4045, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5244, 4046, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5245, 4047, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5246, 4048, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5247, 4049, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5248, 4050, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5249, 4051, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5250, 4052, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5251, 4053, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5252, 4054, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5253, 4055, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5254, 4056, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5255, 4057, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5256, 4058, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5257, 4059, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5258, 4060, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5259, 4061, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5260, 4062, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5261, 4063, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5262, 4064, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5263, 4065, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5264, 4066, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5265, 4067, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5266, 4068, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5267, 4069, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5268, 4070, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5269, 4071, '10:00:00', '13:00:00', 0, 23, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5270, 4072, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5271, 4073, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5272, 4074, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5273, 4075, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5274, 4076, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5275, 4077, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5276, 4078, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5277, 4079, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5278, 4080, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5279, 4081, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5280, 4082, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5281, 4083, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5282, 4084, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5283, 4085, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5284, 4086, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5285, 4087, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5286, 4088, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5287, 4089, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5288, 4090, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5289, 4091, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5290, 4092, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5291, 4093, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5292, 4094, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5293, 4095, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5294, 4096, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5295, 4097, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5296, 4098, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5297, 4099, '14:00:00', '18:00:00', 0, 22, '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(5354, 4156, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5355, 4157, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5356, 4158, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5357, 4159, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5358, 4160, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5359, 4161, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5360, 4162, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5361, 4163, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5362, 4164, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5363, 4165, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5364, 4166, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5365, 4167, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5366, 4168, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5367, 4169, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5368, 4170, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5369, 4171, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5370, 4172, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5371, 4173, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5372, 4174, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5373, 4175, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5374, 4176, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5375, 4177, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5376, 4178, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5377, 4179, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5378, 4180, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5379, 4181, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5380, 4182, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5381, 4183, '17:00:00', '18:00:00', 0, 8, '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(5382, 4184, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5383, 4185, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5384, 4186, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5385, 4187, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5386, 4188, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5387, 4189, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5388, 4190, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5389, 4191, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5390, 4192, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5391, 4193, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5392, 4194, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5393, 4195, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5394, 4196, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5395, 4197, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5396, 4198, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5397, 4199, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5398, 4200, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5399, 4201, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5400, 4202, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5401, 4203, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5402, 4204, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5403, 4205, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5404, 4206, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5405, 4207, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5406, 4208, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5407, 4209, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5408, 4210, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5409, 4211, '18:00:00', '18:30:00', 0, 8, '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(5410, 4212, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5411, 4213, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5412, 4214, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5413, 4215, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5414, 4216, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5415, 4217, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5416, 4218, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5417, 4219, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5418, 4220, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5419, 4221, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5420, 4222, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5421, 4223, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5422, 4224, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5423, 4225, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5424, 4226, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5425, 4227, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5426, 4228, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5427, 4229, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5428, 4230, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5429, 4231, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5430, 4232, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5431, 4233, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5432, 4234, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5433, 4235, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5434, 4236, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5435, 4237, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5436, 4238, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5437, 4239, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5438, 4240, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5439, 4241, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5440, 4242, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5441, 4243, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5442, 4244, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5443, 4245, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5444, 4246, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5445, 4247, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5446, 4248, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5447, 4249, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5448, 4250, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5449, 4251, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5450, 4252, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5451, 4253, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5452, 4254, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5453, 4255, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5454, 4256, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5455, 4257, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5456, 4258, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5457, 4259, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5458, 4260, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5459, 4261, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5460, 4262, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5461, 4263, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5462, 4264, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5463, 4265, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5464, 4266, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5465, 4267, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5466, 4268, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5467, 4269, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5468, 4270, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5469, 4271, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5470, 4272, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5471, 4273, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5472, 4274, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5473, 4275, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5474, 4276, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5475, 4277, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5476, 4278, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5477, 4279, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5478, 4280, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5479, 4281, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5480, 4282, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14');
INSERT INTO `detalle_horarios` (`id`, `horario_id`, `hora_desde`, `hora_hasta`, `bloqueado`, `consultorio_id`, `created_at`, `updated_at`) VALUES
(5481, 4283, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5482, 4284, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5483, 4285, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5484, 4286, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5485, 4287, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5486, 4288, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5487, 4289, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5488, 4290, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5489, 4291, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5490, 4292, '15:00:00', '18:00:00', 0, 35, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5491, 4293, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5492, 4294, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5493, 4295, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5494, 4296, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5495, 4297, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5496, 4298, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5497, 4299, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5498, 4300, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5499, 4301, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5500, 4302, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5501, 4303, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5502, 4304, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5503, 4305, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5504, 4306, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5505, 4307, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5506, 4308, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5507, 4309, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5508, 4310, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5509, 4311, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5510, 4312, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5511, 4313, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5512, 4314, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5513, 4315, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5514, 4316, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5515, 4317, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5516, 4318, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(5517, 4319, '10:00:00', '12:00:00', 0, 34, '2025-06-25 17:22:14', '2025-06-25 17:22:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_horarios_videollamada`
--

CREATE TABLE `detalle_horarios_videollamada` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `horario_id` bigint(20) UNSIGNED NOT NULL,
  `hora_desde` time NOT NULL,
  `hora_hasta` time NOT NULL,
  `bloqueado` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_horarios_videollamada`
--

INSERT INTO `detalle_horarios_videollamada` (`id`, `horario_id`, `hora_desde`, `hora_hasta`, `bloqueado`, `created_at`, `updated_at`) VALUES
(1, 1, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(2, 2, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(3, 3, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(4, 4, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(5, 5, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(6, 6, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(7, 7, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(8, 8, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(9, 9, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(10, 10, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(11, 11, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(12, 12, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(13, 13, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(14, 14, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(15, 15, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(16, 16, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(17, 17, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(18, 18, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(19, 19, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(20, 20, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(21, 21, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(22, 22, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(23, 23, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(24, 24, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(25, 25, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(26, 26, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(27, 27, '08:00:00', '10:00:00', 0, '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(55, 55, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(56, 56, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(57, 57, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(58, 58, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(59, 59, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(60, 60, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(61, 61, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(62, 62, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(63, 63, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(64, 64, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(65, 65, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(66, 66, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(67, 67, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(68, 68, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(69, 69, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(70, 70, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(71, 71, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(72, 72, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(73, 73, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(74, 74, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(75, 75, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(76, 76, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(77, 77, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(78, 78, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(79, 79, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(80, 80, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(81, 81, '10:00:00', '15:00:00', 0, '2025-06-27 03:51:26', '2025-06-27 03:51:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_pacientes`
--

CREATE TABLE `documentos_pacientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paciente_id` bigint(20) UNSIGNED NOT NULL,
  `tipo_documento` varchar(255) NOT NULL,
  `archivo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_profesional`
--

CREATE TABLE `documentos_profesional` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profesional_id` bigint(20) UNSIGNED NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `archivo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `estado` enum('pendiente','denegado','aprobado','') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `documentos_profesional`
--

INSERT INTO `documentos_profesional` (`id`, `profesional_id`, `tipo`, `archivo`, `created_at`, `updated_at`, `nombre`, `estado`) VALUES
(8, 1, 'imagen', 'documentos/1/1750688494_PDFDeclaracion.pdf', '2025-06-23 12:21:34', '2025-06-26 05:26:49', 'Título de Medicina', 'aprobado'),
(9, 1, 'pdf', 'documentos/1/1750688620_Presupuesto_PRE0001A34.pdf', '2025-06-23 12:23:40', '2025-06-26 05:26:53', 'Título de Maestría en Cartdiología', 'aprobado'),
(11, 19, 'imagen', 'documentos/19/1750877581_ChatGPT Image 23 jun 2025, 22_22_36.png', '2025-06-25 16:53:01', '2025-06-25 16:53:01', 'Título de médico general', 'pendiente'),
(12, 19, 'imagen', 'documentos/19/1750877688_ChatGPT Image 23 jun 2025, 22_22_36.png', '2025-06-25 16:54:48', '2025-06-25 16:54:48', 'Título de Oncólogo', 'pendiente'),
(13, 5, 'imagen', 'documentos/5/1751370705_account_confirmation.pdf', '2025-07-01 09:51:45', '2025-07-01 09:52:15', 'Título Especialidad Cardiología', 'aprobado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emergencias`
--

CREATE TABLE `emergencias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipo` enum('Farmacia 24 horas','Ambulancia 24 horas') NOT NULL,
  `provincia_id` bigint(20) UNSIGNED NOT NULL,
  `ciudad_id` bigint(20) UNSIGNED NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `emergencias`
--

INSERT INTO `emergencias` (`id`, `tipo`, `provincia_id`, `ciudad_id`, `direccion`, `telefono`, `created_at`, `updated_at`) VALUES
(1, 'Farmacia 24 horas', 6, 6, 'Avenida Slavador Allende 170, Guayaquil', '987654321', NULL, NULL),
(2, 'Ambulancia 24 horas', 6, 6, 'Avenida Blazco Ibañez 72, 46470, Masanassa, Valencia', '654789123', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE `especialidades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `padre_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`, `padre_id`) VALUES
(1, 'Cardiología', 'Especialidad médica centrada en el diagnóstico y tratamiento de enfermedades cardiovasculares.', '2025-06-19 09:59:45', '2025-06-19 09:59:45', NULL),
(2, 'Neumología', 'Especialidad médica enfocada en el diagnóstico y tratamiento de enfermedades respiratorias.', '2025-06-19 10:00:49', '2025-06-19 10:00:49', NULL),
(3, 'Gastroenterología', 'Estudia el aparato digestivo y sus enfermedades.', '2025-06-19 10:01:25', '2025-06-19 10:01:25', NULL),
(4, 'Nefrología', 'Diagnóstico y tratamiento de enfermedades renales.', '2025-06-19 10:01:43', '2025-06-19 10:01:43', NULL),
(5, 'Endocrinología', 'Especialidad médica dedicada al estudio de las glándulas endocrinas y sus trastornos.', NULL, NULL, NULL),
(6, 'Hematología', 'Especialidad médica que estudia las enfermedades de la sangre y órganos hematopoyéticos.', NULL, NULL, NULL),
(7, 'Reumatología', 'Especialidad médica dedicada al diagnóstico y tratamiento de enfermedades musculoesqueléticas y autoinmunes.', NULL, NULL, NULL),
(8, 'Enfermedades Infecciosas', 'Diagnóstico, tratamiento y prevención de enfermedades causadas por agentes infecciosos.', NULL, NULL, NULL),
(9, 'Oncología Médica', 'Especialidad médica centrada en el tratamiento farmacológico del cáncer.', NULL, NULL, NULL),
(10, 'Medicina Intensiva', 'Cuidado integral de pacientes críticamente enfermos en unidades de cuidados intensivos.', NULL, NULL, NULL),
(11, 'Cirugía General', 'Área de la medicina que se encarga del tratamiento quirúrgico de diversas patologías del cuerpo humano.', NULL, NULL, NULL),
(12, 'Pediatría', 'Rama de la medicina que se dedica al estudio del crecimiento, desarrollo y enfermedades del niño.', NULL, NULL, NULL),
(13, 'Ginecología y Obstetricia', 'Especialidad médica que atiende la salud reproductiva de la mujer, embarazo y parto.', NULL, NULL, NULL),
(14, 'Psiquiatría', 'Especialidad médica que estudia, diagnostica y trata los trastornos mentales.', NULL, NULL, NULL),
(15, 'Neurología', 'Especialidad médica que diagnostica y trata enfermedades del sistema nervioso central y periférico.', NULL, NULL, NULL),
(16, 'Anestesiología y Reanimación', 'Especialidad médica enfocada en la administración de anestesia y manejo perioperatorio.', NULL, NULL, NULL),
(17, 'Traumatología y Ortopedia', 'Especialidad que diagnostica y trata enfermedades musculoesqueléticas y traumatológicas.', NULL, NULL, NULL),
(18, 'Dermatología', 'Especialidad enfocada en el diagnóstico y tratamiento de enfermedades de la piel.', NULL, NULL, NULL),
(19, 'Oftalmología', 'Especialidad médico-quirúrgica para el cuidado de la visión y enfermedades oculares.', NULL, NULL, NULL),
(20, 'Otorrinolaringología', 'Especialidad enfocada en el diagnóstico y tratamiento de enfermedades de oído, nariz y garganta.', NULL, NULL, NULL),
(21, 'Urología', 'Especialidad médico-quirúrgica para el diagnóstico y tratamiento de enfermedades del aparato urinario y genital masculino.', NULL, NULL, NULL),
(22, 'Radiología e Imagen Médica', 'Especialidad para diagnóstico e intervención guiada por imagen.', NULL, NULL, NULL),
(23, 'Medicina Familiar y Comunitaria', 'Atención integral y primaria para todas las edades y contextos.', NULL, NULL, NULL),
(24, 'Medicina Física y Rehabilitación', 'Rehabilitación integral para diferentes discapacidades físicas.', NULL, NULL, NULL),
(25, 'Anatomía Patológica', 'Diagnóstico y análisis de tejidos para enfermedades.', NULL, NULL, NULL),
(26, 'Inmunología', 'Estudio y diagnóstico de enfermedades inmunológicas.', NULL, NULL, NULL),
(27, 'Alergología', 'Diagnóstico y tratamiento de alergias y enfermedades alérgicas.', NULL, NULL, NULL),
(28, 'Genética Médica', 'Diagnóstico y manejo de enfermedades genéticas.', NULL, NULL, NULL),
(29, 'Oncología Radioterápica', 'Tratamiento del cáncer mediante radioterapia.', NULL, NULL, NULL),
(30, 'Cirugía Plástica, Estética y Reconstructiva', 'Restauración de forma y función mediante procedimientos quirúrgicos.', NULL, NULL, NULL),
(31, 'Medicina del Deporte', 'Diagnóstico y tratamiento de lesiones deportivas y enfermedades relacionadas.', NULL, NULL, NULL),
(32, 'Angiología y Cirugía Vascular', 'Especialidad de Angiología y Cirugía Vascular', NULL, NULL, NULL),
(33, 'Medicina Nuclear', 'Especialidad de Medicina Nuclear', NULL, NULL, NULL),
(35, 'Geriatría', 'Especialidad de Geriatría', NULL, NULL, NULL),
(36, 'Cuidados Paliativos', 'Especialidad de Cuidados Paliativos', NULL, NULL, NULL),
(37, 'Cirugía Cardíaca', 'Especialidad de Cirugía Cardíaca', NULL, NULL, NULL),
(38, 'Medicina Interna', 'Especialidad de Medicina Interna', NULL, NULL, NULL),
(99, 'Cardiología Intervencionista', 'Diagnóstico y tratamiento mediante procedimientos invasivos mínimamente invasivos.', '2025-06-19 09:59:45', '2025-06-19 09:59:45', 1),
(100, 'Electrofisiología Cardíaca', 'Estudio y tratamiento de las arritmias y sistemas eléctricos del corazón.', '2025-06-19 09:59:45', '2025-06-19 09:59:45', 1),
(101, 'Cardiología Clínica Avanzada', 'Atención especializada en pacientes con enfermedades cardiovasculares complejas.', '2025-06-19 09:59:45', '2025-06-19 09:59:45', 1),
(102, 'Imagen Cardiovascular Avanzada', 'Uso de tecnologías avanzadas de imagen para el diagnóstico cardiológico.', '2025-06-19 09:59:45', '2025-06-19 09:59:45', 1),
(103, 'Cardiología Pediátrica (Cardiología Congénita)', 'Tratamiento de enfermedades cardíacas en niños y cardiopatías congénitas.', '2025-06-19 09:59:45', '2025-06-19 09:59:45', 1),
(104, 'Insuficiencia Cardíaca y Trasplante Cardíaco', 'Manejo integral de la insuficiencia cardíaca y evaluación para trasplante.', '2025-06-19 09:59:45', '2025-06-19 09:59:45', 1),
(105, 'Hipertensión Arterial y Riesgo Cardiovascular', 'Prevención y control de la hipertensión y factores de riesgo.', '2025-06-19 09:59:45', '2025-06-19 09:59:45', 1),
(106, 'Cardiología Deportiva', 'Evaluación y tratamiento de problemas cardiovasculares en deportistas.', '2025-06-19 09:59:45', '2025-06-19 09:59:45', 1),
(107, 'Cardiología Crítica (UCI Cardíaca)', 'Atención intensiva a pacientes cardiológicos graves.', '2025-06-19 09:59:45', '2025-06-19 09:59:45', 1),
(108, 'Cardiología Geriátrica', 'Atención cardiovascular especializada en personas mayores.', '2025-06-19 09:59:45', '2025-06-19 09:59:45', 1),
(109, 'Vascular Cardiología (Cardiología Vascular)', 'Diagnóstico y tratamiento de enfermedades de los vasos sanguíneos.', '2025-06-19 09:59:45', '2025-06-19 09:59:45', 1),
(110, 'Rehabilitación Cardíaca y Prevención Secundaria', 'Programas de recuperación tras eventos cardiovasculares.', '2025-06-19 09:59:45', '2025-06-19 09:59:45', 1),
(111, 'Neumología Intervencionista', 'Técnicas diagnósticas y terapéuticas mínimamente invasivas en vías respiratorias.', '2025-06-19 10:00:49', '2025-06-19 10:00:49', 2),
(112, 'Enfermedades Pulmonares Obstructivas', 'Tratamiento del asma, EPOC y otras enfermedades con obstrucción del flujo aéreo.', '2025-06-19 10:00:49', '2025-06-19 10:00:49', 2),
(113, 'Enfermedades Pulmonares Intersticiales', 'Estudio de enfermedades que afectan el intersticio pulmonar, como fibrosis.', '2025-06-19 10:00:49', '2025-06-19 10:00:49', 2),
(114, 'Trastornos del Sueño y Ventilación', 'Diagnóstico y tratamiento de apnea del sueño y trastornos respiratorios nocturnos.', '2025-06-19 10:00:49', '2025-06-19 10:00:49', 2),
(115, 'Oncología Torácica', 'Diagnóstico y manejo de tumores pulmonares y pleurales.', '2025-06-19 10:00:49', '2025-06-19 10:00:49', 2),
(116, 'Hipertensión Pulmonar', 'Evaluación y tratamiento de la presión arterial alta en las arterias pulmonares.', '2025-06-19 10:00:49', '2025-06-19 10:00:49', 2),
(117, 'Infecciones Pulmonares y Tuberculosis', 'Atención especializada en infecciones respiratorias agudas y crónicas.', '2025-06-19 10:00:49', '2025-06-19 10:00:49', 2),
(118, 'Neumología Pediátrica', 'Tratamiento de enfermedades respiratorias en niños y adolescentes.', '2025-06-19 10:00:49', '2025-06-19 10:00:49', 2),
(119, 'Fisiología Respiratoria y Rehabilitación Pulmonar', 'Evaluación funcional respiratoria y programas de rehabilitación pulmonar.', '2025-06-19 10:00:49', '2025-06-19 10:00:49', 2),
(120, 'Cuidados Intensivos Respiratorios', 'Manejo crítico de pacientes con insuficiencia respiratoria severa.', '2025-06-19 10:00:49', '2025-06-19 10:00:49', 2),
(121, 'Gastroenterología Intervencionista', 'Técnicas endoscópicas diagnósticas y terapéuticas.', '2025-06-19 10:01:25', '2025-06-19 10:01:25', 3),
(122, 'Hepatología', 'Diagnóstico y tratamiento de enfermedades hepáticas.', '2025-06-19 10:01:25', '2025-06-19 10:01:25', 3),
(123, 'Gastroenterología Oncológica', 'Atención a cánceres del sistema digestivo.', '2025-06-19 10:01:25', '2025-06-19 10:01:25', 3),
(124, 'Enfermedades del Esófago y Motilidad Gastrointestinal', 'Trastornos del esófago y movimientos gastrointestinales.', '2025-06-19 10:01:25', '2025-06-19 10:01:25', 3),
(125, 'Enfermedades Funcionales y Trastornos de la Motilidad', 'Síndrome de intestino irritable y otros trastornos funcionales.', '2025-06-19 10:01:25', '2025-06-19 10:01:25', 3),
(126, 'Enfermedades Inflamatorias Intestinales', 'Enfermedad de Crohn, colitis ulcerosa y otras inflamaciones intestinales.', '2025-06-19 10:01:25', '2025-06-19 10:01:25', 3),
(127, 'Pancreatología', 'Diagnóstico y tratamiento de enfermedades del páncreas.', '2025-06-19 10:01:25', '2025-06-19 10:01:25', 3),
(128, 'Gastroenterología Pediátrica', 'Enfermedades digestivas en población pediátrica.', '2025-06-19 10:01:25', '2025-06-19 10:01:25', 3),
(129, 'Nutrición y Enfermedades Gastrointestinales', 'Relación entre nutrición y patologías digestivas.', '2025-06-19 10:01:25', '2025-06-19 10:01:25', 3),
(130, 'Gastroenterología Crítica y de Urgencias', 'Atención crítica digestiva y emergencias gastrointestinales.', '2025-06-19 10:01:25', '2025-06-19 10:01:25', 3),
(131, 'Nefrología Clínica', 'Atención médica integral de pacientes renales.', '2025-06-19 10:01:43', '2025-06-19 10:01:43', 4),
(132, 'Nefrología Intervencionista', 'Procedimientos diagnósticos y terapéuticos mínimamente invasivos.', '2025-06-19 10:01:43', '2025-06-19 10:01:43', 4),
(133, 'Hipertensión Arterial y Riesgo Cardiovascular', 'Tratamiento de la presión alta relacionada con enfermedad renal.', '2025-06-19 10:01:43', '2025-06-19 10:01:43', 4),
(134, 'Diálisis y Terapias de Reemplazo Renal', 'Técnicas como hemodiálisis, diálisis peritoneal, etc.', '2025-06-19 10:01:43', '2025-06-19 10:01:43', 4),
(135, 'Trasplante Renal', 'Evaluación y seguimiento de pacientes con trasplante de riñón.', '2025-06-19 10:01:43', '2025-06-19 10:01:43', 4),
(136, 'Nefrología Pediátrica', 'Enfermedades renales en niños y adolescentes.', '2025-06-19 10:01:43', '2025-06-19 10:01:43', 4),
(137, 'Nefrología Crítica', 'Atención de pacientes con fallo renal agudo grave.', '2025-06-19 10:01:43', '2025-06-19 10:01:43', 4),
(138, 'Litiasis Renal y Enfermedades Tubulointersticiales', 'Estudio y tratamiento de cálculos y trastornos del túbulo renal.', '2025-06-19 10:01:43', '2025-06-19 10:01:43', 4),
(139, 'Enfermedades Sistémicas con Afectación Renal', 'Lupus, diabetes y otras enfermedades que dañan el riñón.', '2025-06-19 10:01:43', '2025-06-19 10:01:43', 4),
(140, 'Diabetes y Metabolismo', 'Estudio y tratamiento de la diabetes mellitus y trastornos metabólicos.', NULL, NULL, 5),
(141, 'Enfermedades Tiroideas', 'Diagnóstico y tratamiento de trastornos de la glándula tiroides.', NULL, NULL, 5),
(142, 'Trastornos de la Glándula Suprarrenal', 'Estudio de disfunciones de las glándulas suprarrenales.', NULL, NULL, 5),
(143, 'Trastornos Hipofisarios', 'Tratamiento de enfermedades de la glándula hipófisis.', NULL, NULL, 5),
(144, 'Enfermedades del Metabolismo Óseo y Mineral', 'Estudio de enfermedades como osteoporosis y trastornos del calcio.', NULL, NULL, 5),
(145, 'Obesidad y Trastornos del Peso', 'Diagnóstico y manejo integral del sobrepeso y la obesidad.', NULL, NULL, 5),
(146, 'Trastornos del Crecimiento y Desarrollo', 'Evaluación de alteraciones en el crecimiento físico y puberal.', NULL, NULL, 5),
(147, 'Endocrinología Reproductiva', 'Manejo hormonal relacionado con la fertilidad y el ciclo reproductivo.', NULL, NULL, 5),
(148, 'Endocrinología Pediátrica', 'Tratamiento endocrinológico en la edad pediátrica.', NULL, NULL, 5),
(149, 'Endocrinología Oncológica', 'Intervención endocrina en enfermedades oncológicas.', NULL, NULL, 5),
(150, 'Endocrinología Crítica y Hospitalaria', 'Atención endocrina en pacientes hospitalizados y críticos.', NULL, NULL, 5),
(151, 'Hematología Clínica', 'Atención médica de enfermedades hematológicas en adultos.', NULL, NULL, 6),
(152, 'Hemato-Oncología', 'Estudio de los cánceres hematológicos como leucemias y linfomas.', NULL, NULL, 6),
(153, 'Coagulación y Trombosis', 'Tratamiento de trastornos de coagulación y trombosis.', NULL, NULL, 6),
(154, 'Transplante de Médula Ósea y Terapias Celulares', 'Uso clínico de trasplantes y terapias celulares.', NULL, NULL, 6),
(155, 'Hemoglobinopatías y Enfermedades de la Sangre', 'Enfermedades hereditarias como talasemia y anemia falciforme.', NULL, NULL, 6),
(156, 'Síndromes Mielodisplásicos y Trastornos Mieloproliferativos', 'Diagnóstico de enfermedades de la médula ósea.', NULL, NULL, 6),
(157, 'Inmunohematología', 'Estudio de antígenos eritrocitarios y compatibilidad sanguínea.', NULL, NULL, 6),
(158, 'Banco de Sangre y Medicina Transfusional', 'Gestión clínica del banco de sangre y transfusiones.', NULL, NULL, 6),
(159, 'Hematología Pediátrica', 'Manejo de enfermedades hematológicas en niños.', NULL, NULL, 6),
(160, 'Hematología Crítica y Hospitalaria', 'Atención hematológica en contextos críticos y hospitalarios.', NULL, NULL, 6),
(161, 'Enfermedades Autoinmunes Sistémicas', 'Tratamiento de lupus, vasculitis y otras enfermedades sistémicas.', NULL, NULL, 7),
(162, 'Artritis Inflamatorias', 'Estudio de enfermedades como artritis reumatoide y espondiloartritis.', NULL, NULL, 7),
(163, 'Enfermedades Metabólicas Óseas', 'Enfermedades como osteoporosis en el contexto reumatológico.', NULL, NULL, 7),
(164, 'Enfermedades del Tejido Conectivo y Fibromialgia', 'Tratamiento de trastornos del tejido conectivo.', NULL, NULL, 7),
(165, 'Gota y Enfermedades por Depósito de Cristales', 'Diagnóstico y tratamiento de enfermedades articulares por cristales.', NULL, NULL, 7),
(166, 'Reumatología Pediátrica', 'Atención reumatológica a niños y adolescentes.', NULL, NULL, 7),
(167, 'Reumatología Intervencionista', 'Procedimientos invasivos guiados para manejo de dolor e inflamación.', NULL, NULL, 7),
(168, 'Síndromes Autoinflamatorios', 'Estudio de enfermedades autoinflamatorias hereditarias.', NULL, NULL, 7),
(169, 'Reumatología en el Paciente Crítico', 'Atención reumatológica en cuidados intensivos.', NULL, NULL, 7),
(170, 'Infecciones Bacterianas', 'Diagnóstico y tratamiento de enfermedades causadas por bacterias.', NULL, NULL, 8),
(171, 'Infecciones Virales', 'Estudio de infecciones producidas por virus.', NULL, NULL, 8),
(172, 'Infecciones Fúngicas', 'Manejo de enfermedades causadas por hongos.', NULL, NULL, 8),
(173, 'Infecciones Parasitarias', 'Diagnóstico y tratamiento de infecciones por parásitos.', NULL, NULL, 8),
(174, 'Infecciones en Pacientes Inmunosuprimidos', 'Enfermedades infecciosas en pacientes con defensas disminuidas.', NULL, NULL, 8),
(175, 'Infecciones de Transmisión Sexual (ITS)', 'Estudio y manejo de infecciones adquiridas por contacto sexual.', NULL, NULL, 8),
(176, 'Medicina Tropical y Enfermedades Endémicas', 'Estudio de enfermedades propias de regiones tropicales.', NULL, NULL, 8),
(177, 'Infecciones Nosocomiales y Asociadas a Dispositivos Médicos', 'Infecciones adquiridas en entornos hospitalarios.', NULL, NULL, 8),
(178, 'Sepsis y Shock Séptico', 'Manejo de la respuesta inflamatoria sistémica por infección grave.', NULL, NULL, 8),
(179, 'Resistencia Antimicrobiana y Uso de Antibióticos', 'Estudio de microorganismos resistentes y políticas de uso racional.', NULL, NULL, 8),
(180, 'Oncología Torácica', 'Tratamiento de cánceres del pulmón, pleura y mediastino.', NULL, NULL, 9),
(181, 'Oncología Gastrointestinal', 'Cánceres del sistema digestivo: esófago, estómago, colon, etc.', NULL, NULL, 9),
(182, 'Oncología Genitourinaria', 'Manejo de tumores de riñón, vejiga, próstata y órganos genitales.', NULL, NULL, 9),
(183, 'Oncología Ginecológica', 'Tratamiento médico de cáncer de ovario, útero, cuello uterino, etc.', NULL, NULL, 9),
(184, 'Oncología de Cabeza y Cuello', 'Manejo de cánceres localizados en cabeza, cuello y vías aerodigestivas superiores.', NULL, NULL, 9),
(185, 'Oncología del Sistema Nervioso Central', 'Tratamiento médico de tumores cerebrales y medulares.', NULL, NULL, 9),
(186, 'Oncología Hematológica', 'Intervención médica en linfomas, leucemias y mielomas.', NULL, NULL, 9),
(187, 'Oncología Cutánea', 'Tratamiento de cánceres de piel como melanoma y carcinoma.', NULL, NULL, 9),
(188, 'Oncología Musculoesquelética', 'Manejo de tumores óseos y de tejidos blandos.', NULL, NULL, 9),
(189, 'Oncología Pediátrica', 'Tratamiento del cáncer en población pediátrica.', NULL, NULL, 9),
(190, 'Inmunoterapia y Terapias Dirigidas', 'Uso de terapias biológicas para tratar el cáncer.', NULL, NULL, 9),
(191, 'Oncología de Precisión y Medicina Personalizada', 'Aplicación de genómica y biomarcadores en tratamiento oncológico.', NULL, NULL, 9),
(192, 'Cuidados Paliativos y Manejo del Dolor Oncológico', 'Atención integral al paciente con cáncer avanzado.', NULL, NULL, 9),
(193, 'Oncología de Tumores Raros', 'Diagnóstico y tratamiento de cánceres poco frecuentes.', NULL, NULL, 9),
(194, 'Soporte Hemodinámico y Shock', 'Manejo avanzado de pacientes con disfunción cardiovascular.', NULL, NULL, 10),
(195, 'Ventilación Mecánica y Soporte Respiratorio', 'Soporte respiratorio avanzado para pacientes en fallo ventilatorio.', NULL, NULL, 10),
(196, 'Neurointensivismo', 'Cuidados críticos neurológicos y postquirúrgicos del sistema nervioso.', NULL, NULL, 10),
(197, 'Infecciones y Sepsis en UCI', 'Tratamiento especializado de infecciones graves en cuidados intensivos.', NULL, NULL, 10),
(198, 'Cuidados Críticos en Cardiología', 'Atención de pacientes con síndrome coronario agudo y otras cardiopatías graves.', NULL, NULL, 10),
(199, 'Cuidados Intensivos Nefrológicos', 'Manejo de insuficiencia renal aguda y terapia de reemplazo renal en UCI.', NULL, NULL, 10),
(200, 'Cuidados Intensivos en Hepatología', 'Tratamiento de insuficiencia hepática aguda y crónica en estado crítico.', NULL, NULL, 10),
(201, 'Soporte Nutricional y Metabólico en Pacientes Críticos', 'Manejo de requerimientos nutricionales y metabólicos en UCI.', NULL, NULL, 10),
(202, 'Trauma y Cirugía en Pacientes Críticos', 'Manejo del paciente politraumatizado en estado crítico.', NULL, NULL, 10),
(203, 'Cuidados Críticos en Paciente Pediátrico y Neonatal', 'Atención intensiva a recién nacidos y niños gravemente enfermos.', NULL, NULL, 10),
(204, 'Soporte en Trasplante de Órganos', 'Cuidados postoperatorios críticos en pacientes trasplantados.', NULL, NULL, 10),
(205, 'Manejo de Intoxicaciones y Emergencias Toxicológicas', 'Atención especializada en envenenamientos y sobredosis.', NULL, NULL, 10),
(206, 'Cuidados Paliativos en UCI', 'Atención al final de la vida en pacientes críticos.', NULL, NULL, 10),
(207, 'Cuidados Críticos Obstétricos', 'Manejo de complicaciones críticas en embarazadas.', NULL, NULL, 10),
(208, 'Cirugía Oncológica', 'Tratamiento quirúrgico de tumores benignos y malignos.', NULL, NULL, 11),
(209, 'Cirugía Laparoscópica y Mínimamente Invasiva', 'Cirugías realizadas con abordajes mínimamente invasivos.', NULL, NULL, 11),
(210, 'Cirugía Hepatobiliopancreática', 'Cirugía del hígado, vías biliares y páncreas.', NULL, NULL, 11),
(211, 'Cirugía Esofagogástrica', 'Tratamiento quirúrgico de enfermedades del esófago y estómago.', NULL, NULL, 11),
(212, 'Cirugía de Colon, Recto y Ano', 'Procedimientos quirúrgicos colorrectales.', NULL, NULL, 11),
(213, 'Cirugía Endocrina', 'Cirugía de tiroides, paratiroides, suprarrenales y páncreas endocrino.', NULL, NULL, 11),
(214, 'Cirugía de Pared Abdominal y Hernias', 'Reparación de defectos de la pared abdominal.', NULL, NULL, 11),
(215, 'Cirugía de Trauma y Emergencias', 'Atención quirúrgica urgente de pacientes traumatizados.', NULL, NULL, 11),
(216, 'Cirugía Vascular Periférica', 'Cirugía de arterias y venas fuera del corazón y cerebro.', NULL, NULL, 11),
(217, 'Cirugía de Trasplantes', 'Procedimientos quirúrgicos de trasplante de órganos sólidos.', NULL, NULL, 11),
(218, 'Cirugía Bariátrica y Metabólica', 'Cirugía para tratamiento de la obesidad y trastornos metabólicos.', NULL, NULL, 11),
(219, 'Cirugía Pediátrica General', 'Procedimientos quirúrgicos generales en niños.', NULL, NULL, 11),
(220, 'Cirugía Proctológica', 'Cirugía de patologías anorrectales.', NULL, NULL, 11),
(221, 'Cirugía de urgencias', 'Intervenciones quirúrgicas en situaciones de emergencia.', NULL, NULL, 11),
(222, 'Neonatología', 'Atención médica especializada al recién nacido.', NULL, NULL, 12),
(223, 'Pediatría de Urgencias y Cuidados Críticos', 'Atención urgente e intensiva en niños.', NULL, NULL, 12),
(224, 'Cardiología Pediátrica', 'Diagnóstico y tratamiento de enfermedades cardíacas en niños.', NULL, NULL, 12),
(225, 'Neumología Pediátrica', 'Enfermedades respiratorias en población pediátrica.', NULL, NULL, 12),
(226, 'Gastroenterología y Hepatología Pediátrica', 'Trastornos digestivos y hepáticos en niños.', NULL, NULL, 12),
(227, 'Endocrinología Pediátrica', 'Trastornos hormonales y del crecimiento en niños.', NULL, NULL, 12),
(228, 'Nefrología Pediátrica', 'Enfermedades renales pediátricas.', NULL, NULL, 12),
(229, 'Hematología y Oncología Pediátrica', 'Cáncer y enfermedades de la sangre en niños.', NULL, NULL, 12),
(230, 'Neurología Pediátrica', 'Trastornos neurológicos infantiles.', NULL, NULL, 12),
(231, 'Infectología Pediátrica', 'Enfermedades infecciosas en la infancia.', NULL, NULL, 12),
(232, 'Reumatología Pediátrica', 'Enfermedades reumáticas en niños y adolescentes.', NULL, NULL, 12),
(233, 'Alergología e Inmunología Pediátrica', 'Trastornos alérgicos e inmunológicos en la infancia.', NULL, NULL, 12),
(234, 'Psiquiatría Infantil y del Adolescente', 'Trastornos mentales y emocionales en menores.', NULL, NULL, 12),
(235, 'Dermatología Pediátrica', 'Enfermedades de la piel en población pediátrica.', NULL, NULL, 12),
(236, 'Cirugía Pediátrica', 'Procedimientos quirúrgicos en niños.', NULL, NULL, 12),
(237, 'Otorrinolaringología Pediátrica', 'Trastornos ORL en niños.', NULL, NULL, 12),
(238, 'Oftalmología Pediátrica', 'Trastornos de la visión en población infantil.', NULL, NULL, 12),
(239, 'Ortopedia y Traumatología Pediátrica', 'Manejo ortopédico y traumatológico pediátrico.', NULL, NULL, 12),
(240, 'Pediatría del Desarrollo y Rehabilitación', 'Seguimiento del desarrollo infantil y rehabilitación.', NULL, NULL, 12),
(241, 'Pediatría del Adolescente', 'Atención médica especializada en adolescentes.', NULL, NULL, 12),
(242, 'Obstetricia General', 'Atención integral del embarazo y parto.', NULL, NULL, 13),
(243, 'Medicina Materno-Fetal (Perinatología)', 'Cuidado de embarazos de alto riesgo y salud fetal.', NULL, NULL, 13),
(244, 'Ginecología General', 'Diagnóstico y tratamiento de enfermedades ginecológicas comunes.', NULL, NULL, 13),
(245, 'Ginecología Oncológica', 'Tratamiento quirúrgico y médico de cáncer ginecológico.', NULL, NULL, 13),
(246, 'Endocrinología Ginecológica y Reproducción Asistida', 'Trastornos hormonales femeninos e infertilidad.', NULL, NULL, 13),
(247, 'Cirugía Ginecológica y Endoscópica', 'Procedimientos quirúrgicos ginecológicos mínimamente invasivos.', NULL, NULL, 13),
(248, 'Uroginecología y Piso Pélvico', 'Trastornos del suelo pélvico y disfunciones urinarias.', NULL, NULL, 13),
(249, 'Ginecología Pediátrica y de la Adolescencia', 'Atención ginecológica en niñas y adolescentes.', NULL, NULL, 13),
(250, 'Sexología y Salud Sexual Femenina', 'Atención de disfunciones sexuales femeninas.', NULL, NULL, 13),
(251, 'Anticoncepción y Planificación Familiar', 'Métodos anticonceptivos y salud reproductiva.', NULL, NULL, 13),
(252, 'Infectología Ginecológica', 'Enfermedades infecciosas del aparato genital femenino.', NULL, NULL, 13),
(253, 'Obstetricia Crítica y Medicina Intensiva Obstétrica', 'Manejo de complicaciones críticas durante el embarazo.', NULL, NULL, 13),
(254, 'Psiquiatría General', 'Diagnóstico y tratamiento de trastornos psiquiátricos en adultos.', NULL, NULL, 14),
(255, 'Psiquiatría Infantil y del Adolescente', 'Salud mental en niños y adolescentes.', NULL, NULL, 14),
(256, 'Neuropsiquiatría', 'Intersección entre neurología y psiquiatría.', NULL, NULL, 14),
(257, 'Psiquiatría Geriátrica', 'Trastornos mentales en personas mayores.', NULL, NULL, 14),
(258, 'Psiquiatría de Enlace y Psicosomática', 'Intervención psiquiátrica en pacientes con enfermedades físicas.', NULL, NULL, 14),
(259, 'Psiquiatría Forense', 'Evaluación y tratamiento en contextos legales y judiciales.', NULL, NULL, 14),
(260, 'Adicciones y Psiquiatría de las Conductas Adictivas', 'Trastornos por consumo de sustancias y conductas adictivas.', NULL, NULL, 14),
(261, 'Trastornos de la Conducta Alimentaria', 'Anorexia, bulimia y otros trastornos relacionados.', NULL, NULL, 14),
(262, 'Sexología Clínica y Psiquiatría de la Sexualidad', 'Trastornos sexuales y disfunciones psicosexuales.', NULL, NULL, 14),
(263, 'Psiquiatría de Emergencias y Crisis', 'Intervención en situaciones psiquiátricas agudas.', NULL, NULL, 14),
(264, 'Terapias Biológicas y Neuromodulación', 'Uso de terapias como ECT, estimulación magnética y otros.', NULL, NULL, 14),
(265, 'Neurovascular', 'Diagnóstico y tratamiento de enfermedades cerebrovasculares.', NULL, NULL, 15),
(266, 'Trastornos del Movimiento', 'Diagnóstico y manejo de enfermedades que afectan el movimiento.', NULL, NULL, 15),
(267, 'Epileptología', 'Diagnóstico y tratamiento de la epilepsia y trastornos convulsivos.', NULL, NULL, 15),
(268, 'Neurología Cognitiva y Conductual', 'Trastornos de memoria, conducta y otras alteraciones cognitivas.', NULL, NULL, 15),
(269, 'Neuromuscular', 'Enfermedades de nervios periféricos, músculos y unión neuromuscular.', NULL, NULL, 15),
(270, 'Neuroinmunología y Enfermedades Desmielinizantes', 'Trastornos inmunológicos del sistema nervioso central.', NULL, NULL, 15),
(271, 'Cefaleas y Dolor Neurológico', 'Diagnóstico y tratamiento de cefaleas y dolor de origen neurológico.', NULL, NULL, 15),
(272, 'Neurooftalmología', 'Trastornos de la visión relacionados con enfermedades neurológicas.', NULL, NULL, 15),
(273, 'Trastornos del Sueño', 'Diagnóstico y manejo de trastornos del sueño.', NULL, NULL, 15),
(274, 'Neurología Pediátrica', 'Atención de enfermedades neurológicas en población infantil.', NULL, NULL, 15),
(275, 'Neurointensivismo', 'Atención crítica para enfermedades neurológicas agudas.', NULL, NULL, 15),
(276, 'Neurocirugía Funcional y Neuromodulación', 'Tratamientos quirúrgicos para enfermedades neurológicas.', NULL, NULL, 15),
(277, 'Neurogenética y Enfermedades Hereditarias', 'Estudio y tratamiento de enfermedades neurológicas genéticas.', NULL, NULL, 15),
(278, 'Anestesia General y Regional', 'Administración de anestesia general y bloqueos regionales.', NULL, NULL, 16),
(279, 'Anestesia Cardiotorácica', 'Anestesia para procedimientos cardíacos y torácicos.', NULL, NULL, 16),
(280, 'Anestesia Neuroquirúrgica', 'Anestesia para cirugías del sistema nervioso.', NULL, NULL, 16),
(281, 'Anestesia Obstétrica', 'Anestesia para procedimientos durante el embarazo y parto.', NULL, NULL, 16),
(282, 'Anestesia Pediátrica', 'Anestesia para procedimientos en población infantil.', NULL, NULL, 16),
(283, 'Anestesia para Cirugía Ambulatoria y Procedimientos Mínimamente Invasivos', 'Anestesia para procedimientos de corta duración y mínima invasión.', NULL, NULL, 16),
(284, 'Anestesia para Cirugía de Trasplantes', 'Anestesia para procedimientos de trasplante de órganos.', NULL, NULL, 16),
(285, 'Manejo del Dolor y Medicina del Dolor', 'Diagnóstico y tratamiento de síndromes dolorosos agudos y crónicos.', NULL, NULL, 16),
(286, 'Cuidados Críticos y Medicina Intensiva', 'Atención y monitorización de pacientes críticos.', NULL, NULL, 16),
(287, 'Anestesia en Cirugía de Trauma y Emergencias', 'Anestesia para procedimientos en situaciones de trauma y emergencia.', NULL, NULL, 16),
(288, 'Anestesia en Cirugía Vascular', 'Anestesia para procedimientos vasculares y endovasculares.', NULL, NULL, 16),
(289, 'Anestesia para Procedimientos Intervencionistas y Radiología', 'Anestesia para procedimientos guiados por imagen.', NULL, NULL, 16),
(290, 'Anestesia y Reanimación en Pacientes con Enfermedades Crónicas', 'Anestesia adaptada a enfermedades crónicas preexistentes.', NULL, NULL, 16),
(291, 'Cirugía de Columna Vertebral', 'Diagnóstico y tratamiento quirúrgico de trastornos de la columna.', NULL, NULL, 17),
(292, 'Cirugía de Mano y Miembro Superior', 'Procedimientos en la mano, muñeca, codo y miembro superior.', NULL, NULL, 17),
(293, 'Cirugía de Cadera y Rodilla', 'Procedimientos para enfermedades degenerativas de cadera y rodilla.', NULL, NULL, 17),
(294, 'Traumatología Deportiva', 'Tratamiento de lesiones deportivas y su rehabilitación.', NULL, NULL, 17),
(295, 'Ortopedia Pediátrica', 'Diagnóstico y tratamiento de trastornos musculoesqueléticos en la infancia.', NULL, NULL, 17),
(296, 'Cirugía de Hombro y Codo', 'Procedimientos en articulaciones de hombro y codo.', NULL, NULL, 17),
(297, 'Cirugía de Tobillo y Pie', 'Diagnóstico y tratamiento de enfermedades de tobillo y pie.', NULL, NULL, 17),
(298, 'Ortopedia Oncológica', 'Manejo de tumores óseos y de tejidos blandos.', NULL, NULL, 17),
(299, 'Cirugía del Trauma Ortopédico', 'Tratamiento de fracturas y otras lesiones traumáticas.', NULL, NULL, 17),
(300, 'Medicina Regenerativa y Terapias Biológicas', 'Utilización de células madre y factores de crecimiento para reparar tejidos.', NULL, NULL, 17),
(301, 'Infecciones Óseas y Cirugía Reconstructiva', 'Tratamiento de infecciones óseas y procedimientos reconstructivos.', NULL, NULL, 17),
(302, 'Cirugía de Artroscopia y Medicina del Cartílago', 'Diagnóstico y tratamiento mínimamente invasivo de articulaciones y cartílago.', NULL, NULL, 17),
(303, 'Dermatología General', 'Diagnóstico y tratamiento de enfermedades de la piel.', NULL, NULL, 18),
(304, 'Dermatología Pediátrica', 'Atención de enfermedades de la piel en población infantil.', NULL, NULL, 18),
(305, 'Dermatología Oncológica', 'Diagnóstico y tratamiento de neoplasias cutáneas.', NULL, NULL, 18),
(306, 'Dermatología Estética y Procedimientos Cosméticos', 'Procedimientos para mejorar la apariencia de la piel.', NULL, NULL, 18),
(307, 'Tricología y Enfermedades del Cabello', 'Diagnóstico y tratamiento de trastornos del cabello.', NULL, NULL, 18),
(308, 'Enfermedades Ampollosas Autoinmunes', 'Diagnóstico y tratamiento de enfermedades ampollosas.', NULL, NULL, 18),
(309, 'Infecciones Cutáneas', 'Diagnóstico y manejo de enfermedades infecciosas de la piel.', NULL, NULL, 18),
(310, 'Dermatología de Enfermedades Sistémicas', 'Manifestaciones cutáneas de enfermedades sistémicas.', NULL, NULL, 18),
(311, 'Enfermedades de las Uñas', 'Diagnóstico y manejo de enfermedades ungueales.', NULL, NULL, 18),
(312, 'Dermatopatología', 'Estudio histopatológico de enfermedades cutáneas.', NULL, NULL, 18),
(313, 'Fotodermatología y Fototerapia', 'Diagnóstico y terapia con luz para enfermedades de la piel.', NULL, NULL, 18),
(314, 'Dermatología Genética y Enfermedades Raras', 'Diagnóstico y manejo de enfermedades de la piel de origen genético.', NULL, NULL, 18),
(315, 'Cirugía Dermatológica', 'Procedimientos quirúrgicos para enfermedades de la piel.', NULL, NULL, 18),
(316, 'Cirugía Refractiva y Córnea', 'Corrección de defectos refractivos y enfermedades de la córnea.', NULL, NULL, 19),
(317, 'Glaucoma', 'Diagnóstico y manejo de enfermedades del nervio óptico.', NULL, NULL, 19),
(318, 'Cataratas y Cirugía del Cristalino', 'Tratamiento quirúrgico de cataratas.', NULL, NULL, 19),
(319, 'Retina y Vítreo', 'Diagnóstico y tratamiento de enfermedades de la retina y vítreo.', NULL, NULL, 19),
(320, 'Oftalmología Pediátrica y Estrabismo', 'Diagnóstico y tratamiento de enfermedades oculares en niños.', NULL, NULL, 19),
(321, 'Neurooftalmología', 'Trastornos visuales de origen neurológico.', NULL, NULL, 19),
(322, 'Oftalmología Oncológica', 'Diagnóstico y manejo de tumores oculares.', NULL, NULL, 19),
(323, 'Oftalmología de Segmento Anterior', 'Manejo de enfermedades de la superficie ocular y segmento anterior.', NULL, NULL, 19),
(324, 'Órbita y Oculoplastia', 'Tratamiento de enfermedades de la órbita y procedimientos estéticos.', NULL, NULL, 19),
(325, 'Superficie Ocular y Enfermedades Autoinmunes', 'Diagnóstico y manejo de enfermedades inmunológicas de la superficie ocular.', NULL, NULL, 19),
(326, 'Uveítis e Inflamación Ocular', 'Diagnóstico y tratamiento de enfermedades inflamatorias del ojo.', NULL, NULL, 19),
(327, 'Trauma Ocular y Urgencias Oftalmológicas', 'Manejo de emergencias y trauma ocular.', NULL, NULL, 19),
(328, 'Otología y Neurotología', 'Diagnóstico y manejo de trastornos del oído y sistema vestibular.', NULL, NULL, 20),
(329, 'Rinología y Cirugía de Senos Paranasales', 'Diagnóstico y tratamiento de enfermedades nasosinusales.', NULL, NULL, 20),
(330, 'Laringología y Trastornos de la Voz', 'Diagnóstico y manejo de trastornos laríngeos y de la voz.', NULL, NULL, 20),
(331, 'Otorrinolaringología Pediátrica', 'Diagnóstico y tratamiento de enfermedades de oídos, nariz y garganta en niños.', NULL, NULL, 20),
(332, 'Cirugía de Cabeza y Cuello', 'Procedimientos para enfermedades en cabeza y cuello.', NULL, NULL, 20),
(333, 'Trastornos del Equilibrio y Vértigo', 'Diagnóstico y manejo de trastornos vestibulares.', NULL, NULL, 20),
(334, 'Trastornos de la Deglución y Disfagia', 'Diagnóstico y tratamiento de trastornos de la deglución.', NULL, NULL, 20),
(335, 'Apnea del Sueño y Ronquidos', 'Diagnóstico y manejo de trastornos respiratorios del sueño.', NULL, NULL, 20),
(336, 'Cirugía Plástica Facial y Estética en ORL', 'Procedimientos estéticos y reconstructivos faciales.', NULL, NULL, 20),
(337, 'Trauma Facial y Cirugía Reconstructiva', 'Diagnóstico y reparación de trauma facial.', NULL, NULL, 20),
(338, 'Urología General', 'Diagnóstico y tratamiento de enfermedades del aparato urinario.', NULL, NULL, 21),
(339, 'Urología Oncológica', 'Diagnóstico y tratamiento de neoplasias urológicas.', NULL, NULL, 21),
(340, 'Endourología y Cirugía Mínimamente Invasiva', 'Procedimientos mínimamente invasivos para enfermedades urológicas.', NULL, NULL, 21),
(341, 'Andrología y Salud Sexual Masculina', 'Atención de trastornos de la sexualidad masculina.', NULL, NULL, 21),
(342, 'Urología Pediátrica', 'Diagnóstico y tratamiento de enfermedades urológicas en población infantil.', NULL, NULL, 21),
(343, 'Urología Femenina y Uroginecología', 'Diagnóstico y manejo de trastornos urogenitales en mujeres.', NULL, NULL, 21),
(344, 'Trasplante Renal y Urología de Insuficiencia Renal', 'Manejo de trasplantes y enfermedades renales.', NULL, NULL, 21),
(345, 'Neuro-urología y Disfunción del Tracto Urinario Inferior', 'Diagnóstico y manejo de trastornos neurogénicos urológicos.', NULL, NULL, 21),
(346, 'Trauma Urológico y Cirugía Reconstructiva', 'Tratamiento de trauma y procedimientos reconstructivos urológicos.', NULL, NULL, 21),
(347, 'Radiología General', 'Diagnóstico por imagen para diferentes patologías.', NULL, NULL, 22),
(348, 'Neurorradiología', 'Diagnóstico por imagen de enfermedades del sistema nervioso central.', NULL, NULL, 22),
(349, 'Radiología Musculoesquelética', 'Diagnóstico por imagen de trastornos musculoesqueléticos.', NULL, NULL, 22),
(350, 'Radiología Torácica', 'Imagen de enfermedades pulmonares y torácicas.', NULL, NULL, 22),
(351, 'Radiología Abdominal y Gastrointestinal', 'Imagen de enfermedades abdominales y del aparato digestivo.', NULL, NULL, 22),
(352, 'Radiología Genitourinaria', 'Diagnóstico por imagen de enfermedades genitourinarias.', NULL, NULL, 22),
(353, 'Radiología Pediátrica', 'Imagen para diagnóstico de enfermedades en población infantil.', NULL, NULL, 22),
(354, 'Radiología Intervencionista', 'Procedimientos guiados por imagen para diagnóstico y tratamiento.', NULL, NULL, 22),
(355, 'Radiología Oncológica', 'Imagen para diagnóstico y seguimiento de enfermedades neoplásicas.', NULL, NULL, 22),
(356, 'Radiología Mamaria', 'Imagen para diagnóstico de enfermedades de la mama.', NULL, NULL, 22),
(357, 'Radiología Cardiovascular', 'Diagnóstico por imagen de enfermedades cardiovasculares.', NULL, NULL, 22),
(358, 'Medicina Nuclear e Imagen Molecular', 'Imagen y diagnóstico molecular para diferentes patologías.', NULL, NULL, 22),
(359, 'Atención Primaria Integral', 'Atención integral para todas las etapas de la vida.', NULL, NULL, 23),
(360, 'Salud del Adulto y del Anciano', 'Atención para enfermedades comunes en adultos y adultos mayores.', NULL, NULL, 23),
(361, 'Salud Materno-Infantil', 'Atención a la mujer y al niño en diferentes etapas de la vida.', NULL, NULL, 23),
(362, 'Atención a la Salud Mental en Atención Primaria', 'Manejo de trastornos de salud mental en el ámbito primario.', NULL, NULL, 23),
(363, 'Medicina Preventiva y Comunitaria', 'Promoción de la salud y prevención de enfermedades en la comunidad.', NULL, NULL, 23),
(364, 'Atención a la Mujer y Planificación Familiar', 'Atención integral en planificación familiar y enfermedades de la mujer.', NULL, NULL, 23),
(365, 'Urgencias en Atención Primaria', 'Atención de urgencias y emergencias en el ámbito primario.', NULL, NULL, 23),
(366, 'Atención Domiciliaria y Cuidados Paliativos', 'Cuidados médicos y paliativos en el hogar.', NULL, NULL, 23),
(367, 'Medicina del Trabajo y Salud Ocupacional', 'Evaluación y manejo de la salud en el ambiente laboral.', NULL, NULL, 23),
(368, 'Medicina Rural y Atención en Zonas Desfavorecidas', 'Atención primaria adaptada a comunidades rurales.', NULL, NULL, 23),
(369, 'Gestión Sanitaria y Salud Pública', 'Administración y planificación de servicios de salud pública.', NULL, NULL, 23),
(370, 'Rehabilitación Neurológica', 'Rehabilitación para enfermedades neurológicas.', NULL, NULL, 24),
(371, 'Rehabilitación Musculoesquelética y Ortopédica', 'Rehabilitación para enfermedades musculoesqueléticas.', NULL, NULL, 24),
(372, 'Rehabilitación Cardiopulmonar', 'Rehabilitación para enfermedades cardiovasculares y pulmonares.', NULL, NULL, 24),
(373, 'Rehabilitación Pediátrica', 'Rehabilitación en población infantil.', NULL, NULL, 24),
(374, 'Manejo del Dolor y Técnicas de Intervención', 'Control y tratamiento del dolor.', NULL, NULL, 24),
(375, 'Rehabilitación en Lesiones Deportivas', 'Recuperación de lesiones deportivas.', NULL, NULL, 24),
(376, 'Rehabilitación en Pacientes con Quemaduras y Lesiones Cutáneas', 'Rehabilitación para quemaduras y enfermedades de la piel.', NULL, NULL, 24),
(377, 'Rehabilitación del Suelo Pélvico', 'Rehabilitación para trastornos del suelo pélvico.', NULL, NULL, 24),
(378, 'Rehabilitación en Enfermedades Reumatológicas', 'Rehabilitación para enfermedades reumatológicas.', NULL, NULL, 24),
(379, 'Tecnología en Rehabilitación y Asistencia Funcional', 'Utilización de dispositivos para la rehabilitación y asistencia.', NULL, NULL, 24),
(380, 'Terapias de Rehabilitación Avanzadas', 'Innovación y nuevas terapias para la rehabilitación física.', NULL, NULL, 24),
(381, 'Histopatología', 'Estudio microscópico de tejidos para diagnosticar enfermedades.', NULL, NULL, 25),
(382, 'Citopatología', 'Examen de células para diagnosticar enfermedades.', NULL, NULL, 25),
(383, 'Patología Molecular y Genética', 'Análisis molecular y genético de enfermedades.', NULL, NULL, 25),
(384, 'Inmunohistoquímica y Marcadores Tumorales', 'Estudio de marcadores para diagnosticar cáncer.', NULL, NULL, 25),
(385, 'Patología Forense', 'Análisis postmortem para diagnosticar causas de muerte.', NULL, NULL, 25),
(386, 'Patología Hematológica', 'Estudio de enfermedades de la sangre.', NULL, NULL, 25),
(387, 'Patología Renal', 'Diagnóstico de enfermedades renales.', NULL, NULL, 25),
(388, 'Patología Dermatológica', 'Estudio de enfermedades de la piel.', NULL, NULL, 25),
(389, 'Patología Pulmonar y Torácica', 'Diagnóstico de enfermedades respiratorias.', NULL, NULL, 25),
(390, 'Patología Ginecológica y Mamaria', 'Diagnóstico de enfermedades ginecológicas y de la mama.', NULL, NULL, 25),
(391, 'Patología Digestiva y Hepática', 'Estudio de enfermedades del sistema digestivo e hígado.', NULL, NULL, 25),
(392, 'Patología Endocrina', 'Diagnóstico de enfermedades endocrinas.', NULL, NULL, 25),
(393, 'Autopsia Clínica y Patología Postmortem', 'Exámenes postmortem para diagnóstico médico.', NULL, NULL, 25),
(394, 'Inmunología Clínica', 'Diagnóstico de trastornos inmunológicos.', NULL, NULL, 26),
(395, 'Inmunodeficiencias Primarias y Secundarias', 'Estudio y diagnóstico de inmunodeficiencias.', NULL, NULL, 26),
(396, 'Alergología e Hipersensibilidad', 'Diagnóstico de alergias e hipersensibilidad.', NULL, NULL, 26),
(397, 'Inmunoterapia y Modulación del Sistema Inmunológico', 'Tratamiento de enfermedades inmunológicas.', NULL, NULL, 26),
(398, 'Inmunohematología', 'Estudio inmunológico de la sangre.', NULL, NULL, 26),
(399, 'Inmunología del Trasplante', 'Manejo inmunológico de trasplantes.', NULL, NULL, 26),
(400, 'Inmunología de Enfermedades Infecciosas', 'Diagnóstico inmunológico de enfermedades infecciosas.', NULL, NULL, 26),
(401, 'Inmunología Reproductiva', 'Estudio de la inmunología en reproducción humana.', NULL, NULL, 26),
(402, 'Inmunología del Cáncer', 'Inmunoterapia y diagnóstico inmunológico de tumores.', NULL, NULL, 26),
(403, 'Inmunogenética', 'Estudio de la genética en inmunología.', NULL, NULL, 26),
(404, 'Inmunología Experimental y Avances en Inmunoterapia', 'Desarrollo de nuevas inmunoterapias.', NULL, NULL, 26),
(405, 'Alergia Respiratoria', 'Diagnóstico y manejo de alergias respiratorias.', NULL, NULL, 27),
(406, 'Alergias Alimentarias', 'Diagnóstico y manejo de alergias alimentarias.', NULL, NULL, 27),
(407, 'Alergia a Medicamentos y Químicos', 'Diagnóstico de alergias a medicamentos y químicos.', NULL, NULL, 27),
(408, 'Alergia a Veneno de Insectos', 'Diagnóstico de alergias a picaduras de insectos.', NULL, NULL, 27),
(409, 'Urticaria y Angioedema', 'Diagnóstico y manejo de urticaria y angioedema.', NULL, NULL, 27),
(410, 'Dermatitis y Enfermedades Alérgicas Cutáneas', 'Diagnóstico de alergias en piel.', NULL, NULL, 27),
(411, 'Alergia Ocupacional', 'Diagnóstico de alergias en el ambiente laboral.', NULL, NULL, 27),
(412, 'Inmunoterapia y Vacunas para Alergia', 'Tratamiento de alergias mediante inmunoterapia.', NULL, NULL, 27),
(413, 'Alergia Pediátrica', 'Diagnóstico de alergias en población infantil.', NULL, NULL, 27),
(414, 'Anafilaxia y Reacciones de Hipersensibilidad', 'Diagnóstico y manejo de reacciones alérgicas graves.', NULL, NULL, 27),
(415, 'Pruebas Diagnósticas en Alergología', 'Realización de pruebas para diagnosticar alergias.', NULL, NULL, 27),
(416, 'Genética Clínica', 'Diagnóstico de enfermedades genéticas.', NULL, NULL, 28),
(417, 'Genética del Cáncer', 'Estudio y diagnóstico de predisposición al cáncer.', NULL, NULL, 28),
(418, 'Genética Cardiovascular', 'Diagnóstico genético de enfermedades cardiovasculares.', NULL, NULL, 28),
(419, 'Genética Perinatal y Diagnóstico Prenatal', 'Detección de enfermedades genéticas en el embarazo.', NULL, NULL, 28),
(420, 'Genética de Enfermedades Neurológicas', 'Diagnóstico de trastornos neurológicos genéticos.', NULL, NULL, 28),
(421, 'Farmacogenética y Medicina Personalizada', 'Adecuación de medicamentos según la genética individual.', NULL, NULL, 28),
(422, 'Genética en Enfermedades Endocrinas y Metabólicas', 'Diagnóstico de trastornos endocrinos y metabólicos.', NULL, NULL, 28),
(423, 'Genética Reproductiva y Fertilidad', 'Diagnóstico genético de trastornos reproductivos.', NULL, NULL, 28),
(424, 'Genética del Sistema Inmunológico', 'Estudio de trastornos inmunológicos genéticos.', NULL, NULL, 28),
(425, 'Genética Dermatológica', 'Diagnóstico genético de enfermedades de la piel.', NULL, NULL, 28),
(426, 'Genética del Desarrollo y Síndromes Congénitos', 'Diagnóstico de malformaciones y síndromes genéticos.', NULL, NULL, 28),
(427, 'Terapias Genéticas y Avances en Genómica Médica', 'Tratamiento de enfermedades genéticas.', NULL, NULL, 28),
(428, 'Radiocirugía', 'Tratamiento de tumores mediante radiación de alta precisión.', NULL, NULL, 29),
(429, 'Radioterapia de Intensidad Modulada (IMRT)', 'Radioterapia avanzada para administrar dosis específicas.', NULL, NULL, 29),
(430, 'Braquiterapia', 'Radioterapia interna para tratar tumores.', NULL, NULL, 29),
(431, 'Oncología Radioterápica Pediátrica', 'Radioterapia adaptada para población infantil.', NULL, NULL, 29),
(432, 'Radioterapia Estereotáctica Corporal (SBRT)', 'Tratamiento de tumores con radiación precisa y de alta intensidad.', NULL, NULL, 29),
(433, 'Cirugía Estética (Cosmética)', 'Mejoras estéticas mediante procedimientos quirúrgicos.', NULL, NULL, 30),
(434, 'Cirugía Reconstructiva', 'Restauración de tejidos y estructuras corporales.', NULL, NULL, 30),
(435, 'Cirugía de la Mano', 'Procedimientos para reparar trastornos en la mano.', NULL, NULL, 30),
(436, 'Cirugía Craneofacial', 'Reparación y modificación de estructuras faciales.', NULL, NULL, 30),
(437, 'Microcirugía', 'Reparación de tejidos y vasos pequeños bajo microscopio.', NULL, NULL, 30),
(438, 'Cirugía de Quemaduras', 'Tratamiento quirúrgico de quemaduras y cicatrices.', NULL, NULL, 30),
(439, 'Cirugía Plástica Pediátrica', 'Procedimientos para corregir anomalías en niños.', NULL, NULL, 30),
(440, 'Medicina Deportiva Ortopédica', 'Tratamiento de trastornos musculoesqueléticos en deportistas.', NULL, NULL, 31),
(441, 'Medicina Deportiva de Atención Primaria', 'Manejo inicial de enfermedades y lesiones deportivas.', NULL, NULL, 31),
(442, 'Traumatología del Deporte', 'Diagnóstico y tratamiento de traumatismos en atletas.', NULL, NULL, 31),
(443, 'Nutrición en la Actividad Física y el Deporte', 'Optimización de la alimentación en atletas.', NULL, NULL, 31),
(444, 'Fisiología del Ejercicio', 'Estudio de adaptaciones físicas al ejercicio.', NULL, NULL, 31),
(445, 'Psicología del Deporte', 'Asesoría psicológica para atletas.', NULL, NULL, 31),
(446, 'Rehabilitación Deportiva', 'Recuperación de lesiones deportivas.', NULL, NULL, 31),
(447, 'Medicina del Deporte Pediátrica', 'Manejo médico de enfermedades deportivas en niños.', NULL, NULL, 31),
(448, 'Angiología y Cirugía Vascular', 'Especialidad de Angiología y Cirugía Vascular', NULL, NULL, NULL),
(449, 'Cirugía Endovascular', '', NULL, NULL, 32),
(450, 'Cirugía Vascular Convencional (Abierta)', '', NULL, NULL, 32),
(451, 'Flebología', '', NULL, NULL, 32),
(452, 'Linfología', '', NULL, NULL, 32),
(453, 'Angiología Médica', '', NULL, NULL, 32),
(454, 'Patología Arterial Periférica', '', NULL, NULL, 32),
(455, 'Patología Aórtica', '', NULL, NULL, 32),
(456, 'Accesos Vasculares para Hemodiálisis', 'XXXX', NULL, '2025-06-23 11:31:01', 32),
(457, 'Prevención y manejo de trombosis venosa y embolias', '', NULL, NULL, 32),
(458, 'Medicina Nuclear', 'Especialidad de Medicina Nuclear', NULL, NULL, NULL),
(459, 'Imagen Molecular Diagnóstica', '', NULL, NULL, 33),
(460, 'Terapia Radionúclida (Terapia Metabólica)', '', NULL, NULL, 33),
(461, 'PET/CT (Tomografía por Emisión de Positrones)', '', NULL, NULL, 33),
(462, 'SPECT/CT (Tomografía Computarizada por Emisión de Fotón Único)', '', NULL, NULL, 33),
(463, 'Medicina Nuclear Cardiológica', '', NULL, NULL, 33),
(464, 'Medicina Nuclear Oncológica', '', NULL, NULL, 33),
(465, 'Medicina Nuclear Neurológica', '', NULL, NULL, 33),
(466, 'Medicina Nuclear Endocrinológica', '', NULL, NULL, 33),
(467, 'Medicina Nuclear Ósea y Articular', '', NULL, NULL, 33),
(468, 'Radiofarmacia', '', NULL, NULL, 33),
(469, 'Geriatría', 'Especialidad de Geriatría', NULL, NULL, NULL),
(470, 'Geriatría Clínica', '', NULL, NULL, 35),
(471, 'Geriatría Aguda (Atención Hospitalaria)', '', NULL, NULL, 35),
(472, 'Rehabilitación Geriátrica', '', NULL, NULL, 35),
(473, 'Cuidados Paliativos en el Anciano', '', NULL, NULL, 35),
(474, 'Psiquiatría Geriátrica', '', NULL, NULL, 35),
(475, 'Gerontología Social', '', NULL, NULL, 35),
(476, 'Geriatría Comunitaria y Atención Domiciliaria', '', NULL, NULL, 35),
(477, 'Geriatría Preventiva', '', NULL, NULL, 35),
(478, 'Farmacogeriatría', '', NULL, NULL, 35),
(479, 'Neurología Geriátrica (incluyendo Demencias)', '', NULL, NULL, 35),
(480, 'Cuidados Paliativos', 'Especialidad de Cuidados Paliativos', NULL, NULL, NULL),
(481, 'Cuidados Paliativos Oncológicos', '', NULL, NULL, 36),
(482, 'Cuidados Paliativos No Oncológicos (cardiopatías, EPOC, insuficiencia renal, etc.)', '', NULL, NULL, 36),
(483, 'Cuidados Paliativos Pediátricos', '', NULL, NULL, 36),
(484, 'Psico-oncología y Apoyo Emocional', '', NULL, NULL, 36),
(485, 'Control de Síntomas Complejos', '', NULL, NULL, 36),
(486, 'Cuidados Paliativos en Enfermedades Neurológicas Degenerativas', '', NULL, NULL, 36),
(487, 'Bioética y Toma de Decisiones al Final de la Vida', '', NULL, NULL, 36),
(488, 'Cuidados Paliativos en Geriatría', '', NULL, NULL, 36),
(489, 'Espiritualidad y Acompañamiento Existencial', '', NULL, NULL, 36),
(490, 'Cuidados Paliativos Domiciliarios y Comunitarios', '', NULL, NULL, 36),
(491, 'Cirugía Coronaria', '', NULL, NULL, 37),
(492, 'Cirugía Valvular', '', NULL, NULL, 37),
(493, 'Cirugía de la Aorta', '', NULL, NULL, 37),
(494, 'Cirugía de las Arritmias', '', NULL, NULL, 37),
(495, 'Cirugía Cardíaca Pediátrica', '', NULL, NULL, 37),
(496, 'Trasplante Cardíaco y Asistencia Ventricular', '', NULL, NULL, 37),
(497, 'Cirugía Cardíaca Mínimamente Invasiva', '', NULL, NULL, 37),
(498, 'Cirugía de Tumores Cardíacos', '', NULL, NULL, 37),
(499, 'Enfermedades Infecciosas', '', NULL, NULL, 38),
(500, 'Paliativos', '', NULL, NULL, 38),
(501, 'Enfermedades Raras', '', NULL, NULL, 38),
(502, 'Enfermedades del Tejido Conectivo', '', NULL, NULL, 38),
(503, 'Riesgo Cardiovascular', '', NULL, NULL, 38);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especializaciones`
--

CREATE TABLE `especializaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profesional_id` bigint(20) UNSIGNED NOT NULL,
  `especialidad_id` bigint(20) UNSIGNED NOT NULL,
  `sub_especialidad_id` bigint(20) UNSIGNED DEFAULT NULL,
  `centro_educativo` varchar(255) NOT NULL,
  `pais` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `precio_presencial` decimal(8,2) NOT NULL DEFAULT 0.00,
  `precio_videoconsulta` decimal(8,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `especializaciones`
--

INSERT INTO `especializaciones` (`id`, `profesional_id`, `especialidad_id`, `sub_especialidad_id`, `centro_educativo`, `pais`, `created_at`, `updated_at`, `precio_presencial`, `precio_videoconsulta`) VALUES
(19, 1, 1, 100, 'Escuela LAtinoamericana de Medicina La Habana', 'Ecuador', '2025-06-20 06:03:35', '2025-06-20 06:03:35', 50.00, 60.00),
(20, 1, 35, 470, 'XX', 'AA', '2025-06-24 15:10:35', '2025-06-24 15:10:35', 200.00, 100.00),
(21, 19, 9, NULL, 'Universidad de las Américas', 'Ecuador', '2025-06-25 16:53:30', '2025-06-25 16:53:30', 50.00, 75.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas_blog`
--

CREATE TABLE `etiquetas_blog` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `etiquetas_blog`
--

INSERT INTO `etiquetas_blog` (`id`, `nombre`, `slug`, `descripcion`, `created_at`, `updated_at`) VALUES
(5, 'medicina', 'medicina', 'medicina', '2025-06-24 17:42:56', '2025-06-24 17:42:56'),
(6, 'cardio', 'cardio', 'cardio', '2025-06-24 18:50:38', '2025-06-24 18:50:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencias_laborales`
--

CREATE TABLE `experiencias_laborales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profesional_id` bigint(20) UNSIGNED NOT NULL,
  `puesto` varchar(255) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `clinica` varchar(255) NOT NULL,
  `pais` varchar(255) NOT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `experiencias_laborales`
--

INSERT INTO `experiencias_laborales` (`id`, `profesional_id`, `puesto`, `cargo`, `clinica`, `pais`, `provincia`, `ciudad`, `created_at`, `updated_at`) VALUES
(2, 1, 'Especialista en Medicina Interna', 'Jefe de unidad médica', 'Hospital Central', 'Argentina', 'Buenos Aires', 'Buenos Aires', '2025-05-13 15:54:50', '2025-05-13 15:54:50'),
(5, 3, 'Licenciado en Pqsiatría', 'Jefe de departamento', 'HOspital Central Guayas', 'Ecuador', 'Guayas', 'Guayaquil', '2025-06-09 07:26:45', '2025-06-09 07:26:45'),
(6, 4, 'Jefe de Sección Cardiología', 'Jefe', 'Central Calixto García', 'Ecuador', 'Guayas', 'Guayaquil', '2025-06-09 14:48:02', '2025-06-09 14:48:02'),
(7, 4, 'Encargado de Sección Nefrología', 'Encargado', 'Central Calixto García', 'España', 'Sevilla', 'Dos Hermanas', '2025-06-09 14:48:27', '2025-06-09 14:48:27'),
(8, 6, 'MEDICO RESIDENTE', 'CONSULTA', 'CLINICA ALCIVAR', 'ECUADOR', 'GUAYAS', 'GUAYAQUIL', '2025-06-10 15:31:49', '2025-06-10 15:31:49'),
(9, 7, 'MEDICO RESIDENTE', 'MEDICO DERMATOLOGO DE PLANTA', 'HOSPITAL DE PAMI', 'ARGENTINA', 'BUENOS AIRES', 'BUENOS AIRES', '2025-06-10 16:37:33', '2025-06-10 16:37:33'),
(10, 7, 'MEDICO RESIDENTE', 'MEDICO DERMATOLOGO DE PLANTA', 'CORPORACION MEDICA SAN MARTIN', 'ARGENTINA', NULL, NULL, '2025-06-10 16:41:58', '2025-06-10 16:41:58'),
(11, 8, 'Médico Tratante', 'Médico Tratante', 'Hospital Metropolitano de Quito', 'ECUADOR', NULL, NULL, '2025-06-10 17:19:01', '2025-06-10 17:19:01'),
(12, 8, 'Médico Tratante', 'Médico Tratante', 'Hospital Carlos Andrade Marín', 'ECUADOR', NULL, NULL, '2025-06-10 17:19:38', '2025-06-10 17:19:38'),
(13, 9, 'Médico Tratante', 'Médico Tratante', 'Hospital Metropolitano de Quito', 'ECUADOR', NULL, NULL, '2025-06-10 23:17:06', '2025-06-10 23:17:06'),
(14, 9, 'CIRUJANO', 'CIRUJANO', 'Alianza Hospital', 'ECUADOR', NULL, NULL, '2025-06-10 23:20:32', '2025-06-10 23:20:32'),
(15, 10, 'JEFE DEPARTAMENTO CIRUGIA', 'JEFE DEPARTAMENTO CIRUGIA', 'Hospital Metropolitano de Quito', 'ECUADOR', 'PICHINCHA', 'Quito', '2025-06-10 23:49:06', '2025-06-10 23:49:06'),
(16, 10, 'NEUROCIRUJANA', 'NEUROCIRUJANA', 'HOSPITAL POLICIA QUITO', 'ECUADOR', 'PICHINCHA', 'Quito', '2025-06-10 23:49:48', '2025-06-10 23:49:48'),
(17, 11, 'Urgencias pediátricas', 'Urgencias pediátricas', 'HOSPITAL SAN FRANCISCO DE QUITO', 'ECUADOR', 'PICHINCHA', 'Quito', '2025-06-11 00:20:29', '2025-06-11 00:20:29'),
(18, 11, 'Médico pediatra', 'Médico pediatra', 'HOSPITAL DEL RIO', 'ECUADOR', 'AZUAY', 'CUENCA', '2025-06-11 00:21:04', '2025-06-11 00:21:04'),
(19, 12, 'Jefe de servicio', 'Médico tratante', 'Hospital Metropilitano', 'Ecuador', 'Pichincha', 'Quito', '2025-06-11 13:47:40', '2025-06-11 13:47:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formaciones_adicionales`
--

CREATE TABLE `formaciones_adicionales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profesional_id` bigint(20) UNSIGNED NOT NULL,
  `tipo` enum('curso','master','taller','seminario','doctorado') NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `formaciones_adicionales`
--

INSERT INTO `formaciones_adicionales` (`id`, `profesional_id`, `tipo`, `nombre`, `created_at`, `updated_at`) VALUES
(4, 1, 'master', 'Máster en Epidemiología Clínica', '2025-05-13 15:41:37', '2025-05-13 15:41:37'),
(5, 1, 'taller', 'Taller de Reanimación Cardiopulmonar (RCP)', '2025-05-13 15:41:37', '2025-05-13 15:41:37'),
(7, 1, 'seminario', 'Seminario de Actualización en Medicina Interna', '2025-05-13 15:41:37', '2025-05-13 15:41:37'),
(9, 1, 'curso', 'Curso Básico de Medicina', NULL, NULL),
(12, 3, 'curso', 'Ingeniero vvv', '2025-06-06 13:51:04', '2025-06-06 13:51:04'),
(13, 4, 'curso', 'Curso 1', '2025-06-09 14:45:56', '2025-06-09 14:45:56'),
(14, 4, 'master', 'Máster 1', '2025-06-09 14:46:06', '2025-06-09 14:46:06'),
(15, 4, 'taller', 'Taller 1', '2025-06-09 14:46:14', '2025-06-09 14:46:14'),
(16, 4, 'seminario', 'Seminario 1', '2025-06-09 14:46:23', '2025-06-09 14:46:23'),
(17, 6, 'curso', 'GINECOLOGIA OBSTETRA', '2025-06-10 15:26:53', '2025-06-10 15:26:53'),
(18, 6, 'taller', 'PARTO SIN DOLOR', '2025-06-10 15:32:37', '2025-06-10 15:32:37'),
(19, 6, 'master', 'GINECOLOGIA OBSTETRA EN MUJERES JOVENES', '2025-06-10 15:33:08', '2025-06-10 15:33:08'),
(20, 6, 'seminario', 'LA GINECOLOGIA EN LAS JOVENES', '2025-06-10 15:33:32', '2025-06-10 15:33:32'),
(21, 6, 'seminario', 'IV ENCUENTRO DE GINECOLOGIA MIAMI 2020', '2025-06-10 15:33:56', '2025-06-10 15:33:56'),
(22, 7, 'master', 'ESPECIALISTA EN MEDICINA ESTETICA', '2025-06-10 16:34:18', '2025-06-10 16:34:18'),
(23, 7, 'curso', 'TRICOLOGIA', '2025-06-10 16:34:57', '2025-06-10 16:34:57'),
(24, 7, 'seminario', 'DERMATOSCOPIA EN ARGENTINA', '2025-06-10 16:35:24', '2025-06-10 16:35:24'),
(25, 7, 'master', 'ONCOLOGIA DERMATOLOGICA', '2025-06-10 16:35:47', '2025-06-10 16:35:47'),
(26, 8, 'curso', 'GASTROENTEROLOGIA EN NIÑOS', '2025-06-10 17:16:11', '2025-06-10 17:16:11'),
(27, 9, 'master', 'Escuela de Cirugía de Fer a Moulin', '2025-06-10 23:14:08', '2025-06-10 23:14:08'),
(28, 9, 'master', 'Master en arritmias cardiacas (2018 - 2020)', '2025-06-10 23:15:05', '2025-06-10 23:15:05'),
(29, 9, 'curso', 'Electrofisiología y Arritmias', '2025-06-10 23:15:30', '2025-06-10 23:15:30'),
(30, 9, 'curso', 'CONGRESO EN ESPAÑA DE CARDIOLOGIA 2008', '2025-06-10 23:16:12', '2025-06-10 23:16:12'),
(31, 10, 'seminario', 'SEMINARIO DE NEUROCIRUGIA PACIENTES CRITICOS NEW YORK 2020', '2025-06-10 23:47:20', '2025-06-10 23:47:20'),
(32, 10, 'seminario', 'SEMINARIO DE NEUROCIRUGIA PACIENTES DIABETICOS BRASIL 2015', '2025-06-10 23:48:01', '2025-06-10 23:48:01'),
(33, 11, 'master', 'Máster Nutrición Y dietética', '2025-06-11 00:19:24', '2025-06-11 00:19:24'),
(35, 1, 'doctorado', 'AAA', '2025-06-21 08:29:47', '2025-06-21 08:29:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profesional_id` bigint(20) UNSIGNED NOT NULL,
  `dia_semana` int(10) UNSIGNED DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `profesional_id`, `dia_semana`, `fecha`, `created_at`, `updated_at`) VALUES
(2400, 1, 1, '2025-06-09', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2401, 1, 1, '2025-06-16', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2402, 1, 1, '2025-06-23', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2403, 1, 1, '2025-06-30', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2404, 1, 1, '2025-07-07', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2405, 1, 1, '2025-07-14', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2406, 1, 1, '2025-07-21', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2407, 1, 1, '2025-07-28', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2408, 1, 1, '2025-08-04', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2409, 1, 1, '2025-08-11', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2410, 1, 1, '2025-08-18', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2411, 1, 1, '2025-08-25', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2412, 1, 1, '2025-09-01', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2413, 1, 1, '2025-09-08', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2414, 1, 1, '2025-09-15', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2415, 1, 1, '2025-09-22', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2416, 1, 1, '2025-09-29', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2417, 1, 1, '2025-10-06', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2418, 1, 1, '2025-10-13', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2419, 1, 1, '2025-10-20', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2420, 1, 1, '2025-10-27', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2421, 1, 1, '2025-11-03', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2422, 1, 1, '2025-11-10', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2423, 1, 1, '2025-11-17', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2424, 1, 1, '2025-11-24', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2425, 1, 1, '2025-12-01', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2426, 1, 1, '2025-12-08', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2427, 1, 1, '2025-12-15', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2428, 1, 1, '2025-12-22', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2429, 1, 1, '2025-12-29', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2430, 1, 5, '2025-06-13', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2431, 1, 5, '2025-06-20', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2432, 1, 5, '2025-06-27', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2433, 1, 5, '2025-07-04', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2434, 1, 5, '2025-07-11', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2435, 1, 5, '2025-07-18', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2436, 1, 5, '2025-07-25', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2437, 1, 5, '2025-08-01', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2438, 1, 5, '2025-08-08', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2439, 1, 5, '2025-08-15', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2440, 1, 5, '2025-08-22', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2441, 1, 5, '2025-08-29', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2442, 1, 5, '2025-09-05', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2443, 1, 5, '2025-09-12', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2444, 1, 5, '2025-09-19', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2445, 1, 5, '2025-09-26', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2446, 1, 5, '2025-10-03', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2447, 1, 5, '2025-10-10', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2448, 1, 5, '2025-10-17', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2449, 1, 5, '2025-10-24', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2450, 1, 5, '2025-10-31', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2451, 1, 5, '2025-11-07', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2452, 1, 5, '2025-11-14', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2453, 1, 5, '2025-11-21', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2454, 1, 5, '2025-11-28', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2455, 1, 5, '2025-12-05', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2456, 1, 5, '2025-12-12', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2457, 1, 5, '2025-12-19', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2458, 1, 5, '2025-12-26', '2025-06-09 00:08:20', '2025-06-09 00:08:20'),
(2459, 1, 2, '2025-06-10', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2460, 1, 2, '2025-06-17', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2461, 1, 2, '2025-06-24', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2462, 1, 2, '2025-07-01', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2463, 1, 2, '2025-07-08', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2464, 1, 2, '2025-07-15', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2465, 1, 2, '2025-07-22', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2466, 1, 2, '2025-07-29', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2467, 1, 2, '2025-08-05', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2468, 1, 2, '2025-08-12', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2469, 1, 2, '2025-08-19', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2470, 1, 2, '2025-08-26', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2471, 1, 2, '2025-09-02', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2472, 1, 2, '2025-09-09', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2473, 1, 2, '2025-09-16', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2474, 1, 2, '2025-09-23', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2475, 1, 2, '2025-09-30', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2476, 1, 2, '2025-10-07', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2477, 1, 2, '2025-10-14', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2478, 1, 2, '2025-10-21', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2479, 1, 2, '2025-10-28', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2480, 1, 2, '2025-11-04', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2481, 1, 2, '2025-11-11', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2482, 1, 2, '2025-11-18', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2483, 1, 2, '2025-11-25', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2484, 1, 2, '2025-12-02', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2485, 1, 2, '2025-12-09', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2486, 1, 2, '2025-12-16', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2487, 1, 2, '2025-12-23', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2488, 1, 2, '2025-12-30', '2025-06-09 00:09:47', '2025-06-09 00:09:47'),
(2489, 1, 1, '2025-06-09', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2490, 1, 1, '2025-06-16', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2491, 1, 1, '2025-06-23', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2492, 1, 1, '2025-06-30', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2493, 1, 1, '2025-07-07', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2494, 1, 1, '2025-07-14', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2495, 1, 1, '2025-07-21', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2496, 1, 1, '2025-07-28', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2497, 1, 1, '2025-08-04', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2498, 1, 1, '2025-08-11', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2499, 1, 1, '2025-08-18', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2500, 1, 1, '2025-08-25', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2501, 1, 1, '2025-09-01', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2502, 1, 1, '2025-09-08', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2503, 1, 1, '2025-09-15', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2504, 1, 1, '2025-09-22', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2505, 1, 1, '2025-09-29', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2506, 1, 1, '2025-10-06', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2507, 1, 1, '2025-10-13', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2508, 1, 1, '2025-10-20', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2509, 1, 1, '2025-10-27', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2510, 1, 1, '2025-11-03', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2511, 1, 1, '2025-11-10', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2512, 1, 1, '2025-11-17', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2513, 1, 1, '2025-11-24', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2514, 1, 1, '2025-12-01', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2515, 1, 1, '2025-12-08', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2516, 1, 1, '2025-12-15', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2517, 1, 1, '2025-12-22', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2518, 1, 1, '2025-12-29', '2025-06-09 00:10:22', '2025-06-09 00:10:22'),
(2519, 1, 5, '2025-06-13', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2520, 1, 5, '2025-06-20', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2521, 1, 5, '2025-06-27', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2522, 1, 5, '2025-07-04', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2523, 1, 5, '2025-07-11', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2524, 1, 5, '2025-07-18', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2525, 1, 5, '2025-07-25', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2526, 1, 5, '2025-08-01', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2527, 1, 5, '2025-08-08', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2528, 1, 5, '2025-08-15', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2529, 1, 5, '2025-08-22', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2530, 1, 5, '2025-08-29', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2531, 1, 5, '2025-09-05', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2532, 1, 5, '2025-09-12', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2533, 1, 5, '2025-09-19', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2534, 1, 5, '2025-09-26', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2535, 1, 5, '2025-10-03', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2536, 1, 5, '2025-10-10', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2537, 1, 5, '2025-10-17', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2538, 1, 5, '2025-10-24', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2539, 1, 5, '2025-10-31', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2540, 1, 5, '2025-11-07', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2541, 1, 5, '2025-11-14', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2542, 1, 5, '2025-11-21', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2543, 1, 5, '2025-11-28', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2544, 1, 5, '2025-12-05', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2545, 1, 5, '2025-12-12', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2546, 1, 5, '2025-12-19', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2547, 1, 5, '2025-12-26', '2025-06-09 00:19:58', '2025-06-09 00:19:58'),
(2548, 3, 1, '2025-06-09', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2549, 3, 1, '2025-06-16', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2550, 3, 1, '2025-06-23', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2551, 3, 1, '2025-06-30', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2552, 3, 1, '2025-07-07', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2553, 3, 1, '2025-07-14', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2554, 3, 1, '2025-07-21', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2555, 3, 1, '2025-07-28', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2556, 3, 1, '2025-08-04', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2557, 3, 1, '2025-08-11', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2558, 3, 1, '2025-08-18', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2559, 3, 1, '2025-08-25', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2560, 3, 1, '2025-09-01', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2561, 3, 1, '2025-09-08', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2562, 3, 1, '2025-09-15', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2563, 3, 1, '2025-09-22', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2564, 3, 1, '2025-09-29', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2565, 3, 1, '2025-10-06', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2566, 3, 1, '2025-10-13', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2567, 3, 1, '2025-10-20', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2568, 3, 1, '2025-10-27', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2569, 3, 1, '2025-11-03', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2570, 3, 1, '2025-11-10', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2571, 3, 1, '2025-11-17', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2572, 3, 1, '2025-11-24', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2573, 3, 1, '2025-12-01', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2574, 3, 1, '2025-12-08', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2575, 3, 1, '2025-12-15', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2576, 3, 1, '2025-12-22', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2577, 3, 1, '2025-12-29', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2578, 3, 2, '2025-06-10', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2579, 3, 2, '2025-06-17', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2580, 3, 2, '2025-06-24', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2581, 3, 2, '2025-07-01', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2582, 3, 2, '2025-07-08', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2583, 3, 2, '2025-07-15', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2584, 3, 2, '2025-07-22', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2585, 3, 2, '2025-07-29', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2586, 3, 2, '2025-08-05', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2587, 3, 2, '2025-08-12', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2588, 3, 2, '2025-08-19', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2589, 3, 2, '2025-08-26', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2590, 3, 2, '2025-09-02', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2591, 3, 2, '2025-09-09', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2592, 3, 2, '2025-09-16', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2593, 3, 2, '2025-09-23', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2594, 3, 2, '2025-09-30', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2595, 3, 2, '2025-10-07', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2596, 3, 2, '2025-10-14', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2597, 3, 2, '2025-10-21', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2598, 3, 2, '2025-10-28', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2599, 3, 2, '2025-11-04', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2600, 3, 2, '2025-11-11', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2601, 3, 2, '2025-11-18', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2602, 3, 2, '2025-11-25', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2603, 3, 2, '2025-12-02', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2604, 3, 2, '2025-12-09', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2605, 3, 2, '2025-12-16', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2606, 3, 2, '2025-12-23', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2607, 3, 2, '2025-12-30', '2025-06-09 07:27:22', '2025-06-09 07:27:22'),
(2608, 4, 1, '2025-06-09', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2609, 4, 1, '2025-06-16', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2610, 4, 1, '2025-06-23', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2611, 4, 1, '2025-06-30', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2612, 4, 1, '2025-07-07', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2613, 4, 1, '2025-07-14', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2614, 4, 1, '2025-07-21', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2615, 4, 1, '2025-07-28', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2616, 4, 1, '2025-08-04', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2617, 4, 1, '2025-08-11', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2618, 4, 1, '2025-08-18', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2619, 4, 1, '2025-08-25', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2620, 4, 1, '2025-09-01', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2621, 4, 1, '2025-09-08', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2622, 4, 1, '2025-09-15', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2623, 4, 1, '2025-09-22', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2624, 4, 1, '2025-09-29', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2625, 4, 1, '2025-10-06', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2626, 4, 1, '2025-10-13', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2627, 4, 1, '2025-10-20', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2628, 4, 1, '2025-10-27', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2629, 4, 1, '2025-11-03', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2630, 4, 1, '2025-11-10', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2631, 4, 1, '2025-11-17', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2632, 4, 1, '2025-11-24', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2633, 4, 1, '2025-12-01', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2634, 4, 1, '2025-12-08', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2635, 4, 1, '2025-12-15', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2636, 4, 1, '2025-12-22', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2637, 4, 1, '2025-12-29', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2638, 4, 3, '2025-06-11', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2639, 4, 3, '2025-06-18', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2640, 4, 3, '2025-06-25', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2641, 4, 3, '2025-07-02', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2642, 4, 3, '2025-07-09', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2643, 4, 3, '2025-07-16', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2644, 4, 3, '2025-07-23', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2645, 4, 3, '2025-07-30', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2646, 4, 3, '2025-08-06', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2647, 4, 3, '2025-08-13', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2648, 4, 3, '2025-08-20', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2649, 4, 3, '2025-08-27', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2650, 4, 3, '2025-09-03', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2651, 4, 3, '2025-09-10', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2652, 4, 3, '2025-09-17', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2653, 4, 3, '2025-09-24', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2654, 4, 3, '2025-10-01', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2655, 4, 3, '2025-10-08', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2656, 4, 3, '2025-10-15', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2657, 4, 3, '2025-10-22', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2658, 4, 3, '2025-10-29', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2659, 4, 3, '2025-11-05', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2660, 4, 3, '2025-11-12', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2661, 4, 3, '2025-11-19', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2662, 4, 3, '2025-11-26', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2663, 4, 3, '2025-12-03', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2664, 4, 3, '2025-12-10', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2665, 4, 3, '2025-12-17', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2666, 4, 3, '2025-12-24', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2667, 4, 3, '2025-12-31', '2025-06-09 15:39:51', '2025-06-09 15:39:51'),
(2668, 6, 1, '2025-06-16', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2669, 6, 1, '2025-06-23', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2670, 6, 1, '2025-06-30', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2671, 6, 1, '2025-07-07', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2672, 6, 1, '2025-07-14', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2673, 6, 1, '2025-07-21', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2674, 6, 1, '2025-07-28', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2675, 6, 1, '2025-08-04', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2676, 6, 1, '2025-08-11', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2677, 6, 1, '2025-08-18', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2678, 6, 1, '2025-08-25', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2679, 6, 1, '2025-09-01', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2680, 6, 1, '2025-09-08', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2681, 6, 1, '2025-09-15', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2682, 6, 1, '2025-09-22', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2683, 6, 1, '2025-09-29', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2684, 6, 1, '2025-10-06', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2685, 6, 1, '2025-10-13', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2686, 6, 1, '2025-10-20', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2687, 6, 1, '2025-10-27', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2688, 6, 1, '2025-11-03', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2689, 6, 1, '2025-11-10', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2690, 6, 1, '2025-11-17', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2691, 6, 1, '2025-11-24', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2692, 6, 1, '2025-12-01', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2693, 6, 1, '2025-12-08', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2694, 6, 1, '2025-12-15', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2695, 6, 1, '2025-12-22', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2696, 6, 1, '2025-12-29', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2697, 6, 2, '2025-06-10', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2698, 6, 2, '2025-06-17', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2699, 6, 2, '2025-06-24', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2700, 6, 2, '2025-07-01', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2701, 6, 2, '2025-07-08', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2702, 6, 2, '2025-07-15', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2703, 6, 2, '2025-07-22', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2704, 6, 2, '2025-07-29', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2705, 6, 2, '2025-08-05', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2706, 6, 2, '2025-08-12', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2707, 6, 2, '2025-08-19', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2708, 6, 2, '2025-08-26', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2709, 6, 2, '2025-09-02', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2710, 6, 2, '2025-09-09', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2711, 6, 2, '2025-09-16', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2712, 6, 2, '2025-09-23', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2713, 6, 2, '2025-09-30', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2714, 6, 2, '2025-10-07', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2715, 6, 2, '2025-10-14', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2716, 6, 2, '2025-10-21', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2717, 6, 2, '2025-10-28', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2718, 6, 2, '2025-11-04', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2719, 6, 2, '2025-11-11', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2720, 6, 2, '2025-11-18', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2721, 6, 2, '2025-11-25', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2722, 6, 2, '2025-12-02', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2723, 6, 2, '2025-12-09', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2724, 6, 2, '2025-12-16', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2725, 6, 2, '2025-12-23', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2726, 6, 2, '2025-12-30', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2727, 6, 3, '2025-06-11', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2728, 6, 3, '2025-06-18', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2729, 6, 3, '2025-06-25', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2730, 6, 3, '2025-07-02', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2731, 6, 3, '2025-07-09', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2732, 6, 3, '2025-07-16', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2733, 6, 3, '2025-07-23', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2734, 6, 3, '2025-07-30', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2735, 6, 3, '2025-08-06', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2736, 6, 3, '2025-08-13', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2737, 6, 3, '2025-08-20', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2738, 6, 3, '2025-08-27', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2739, 6, 3, '2025-09-03', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2740, 6, 3, '2025-09-10', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2741, 6, 3, '2025-09-17', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2742, 6, 3, '2025-09-24', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2743, 6, 3, '2025-10-01', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2744, 6, 3, '2025-10-08', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2745, 6, 3, '2025-10-15', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2746, 6, 3, '2025-10-22', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2747, 6, 3, '2025-10-29', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2748, 6, 3, '2025-11-05', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2749, 6, 3, '2025-11-12', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2750, 6, 3, '2025-11-19', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2751, 6, 3, '2025-11-26', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2752, 6, 3, '2025-12-03', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2753, 6, 3, '2025-12-10', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2754, 6, 3, '2025-12-17', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2755, 6, 3, '2025-12-24', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2756, 6, 3, '2025-12-31', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2757, 6, 4, '2025-06-12', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2758, 6, 4, '2025-06-19', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2759, 6, 4, '2025-06-26', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2760, 6, 4, '2025-07-03', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2761, 6, 4, '2025-07-10', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2762, 6, 4, '2025-07-17', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2763, 6, 4, '2025-07-24', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2764, 6, 4, '2025-07-31', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2765, 6, 4, '2025-08-07', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2766, 6, 4, '2025-08-14', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2767, 6, 4, '2025-08-21', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2768, 6, 4, '2025-08-28', '2025-06-10 15:59:57', '2025-06-10 15:59:57'),
(2769, 6, 4, '2025-09-04', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2770, 6, 4, '2025-09-11', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2771, 6, 4, '2025-09-18', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2772, 6, 4, '2025-09-25', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2773, 6, 4, '2025-10-02', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2774, 6, 4, '2025-10-09', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2775, 6, 4, '2025-10-16', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2776, 6, 4, '2025-10-23', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2777, 6, 4, '2025-10-30', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2778, 6, 4, '2025-11-06', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2779, 6, 4, '2025-11-13', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2780, 6, 4, '2025-11-20', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2781, 6, 4, '2025-11-27', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2782, 6, 4, '2025-12-04', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2783, 6, 4, '2025-12-11', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2784, 6, 4, '2025-12-18', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2785, 6, 4, '2025-12-25', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2786, 6, 5, '2025-06-13', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2787, 6, 5, '2025-06-20', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2788, 6, 5, '2025-06-27', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2789, 6, 5, '2025-07-04', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2790, 6, 5, '2025-07-11', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2791, 6, 5, '2025-07-18', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2792, 6, 5, '2025-07-25', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2793, 6, 5, '2025-08-01', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2794, 6, 5, '2025-08-08', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2795, 6, 5, '2025-08-15', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2796, 6, 5, '2025-08-22', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2797, 6, 5, '2025-08-29', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2798, 6, 5, '2025-09-05', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2799, 6, 5, '2025-09-12', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2800, 6, 5, '2025-09-19', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2801, 6, 5, '2025-09-26', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2802, 6, 5, '2025-10-03', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2803, 6, 5, '2025-10-10', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2804, 6, 5, '2025-10-17', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2805, 6, 5, '2025-10-24', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2806, 6, 5, '2025-10-31', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2807, 6, 5, '2025-11-07', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2808, 6, 5, '2025-11-14', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2809, 6, 5, '2025-11-21', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2810, 6, 5, '2025-11-28', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2811, 6, 5, '2025-12-05', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2812, 6, 5, '2025-12-12', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2813, 6, 5, '2025-12-19', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2814, 6, 5, '2025-12-26', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2815, 6, 6, '2025-06-14', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2816, 6, 6, '2025-06-21', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2817, 6, 6, '2025-06-28', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2818, 6, 6, '2025-07-05', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2819, 6, 6, '2025-07-12', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2820, 6, 6, '2025-07-19', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2821, 6, 6, '2025-07-26', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2822, 6, 6, '2025-08-02', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2823, 6, 6, '2025-08-09', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2824, 6, 6, '2025-08-16', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2825, 6, 6, '2025-08-23', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2826, 6, 6, '2025-08-30', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2827, 6, 6, '2025-09-06', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2828, 6, 6, '2025-09-13', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2829, 6, 6, '2025-09-20', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2830, 6, 6, '2025-09-27', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2831, 6, 6, '2025-10-04', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2832, 6, 6, '2025-10-11', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2833, 6, 6, '2025-10-18', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2834, 6, 6, '2025-10-25', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2835, 6, 6, '2025-11-01', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2836, 6, 6, '2025-11-08', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2837, 6, 6, '2025-11-15', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2838, 6, 6, '2025-11-22', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2839, 6, 6, '2025-11-29', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2840, 6, 6, '2025-12-06', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2841, 6, 6, '2025-12-13', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2842, 6, 6, '2025-12-20', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(2843, 6, 6, '2025-12-27', '2025-06-10 15:59:58', '2025-06-10 15:59:58'),
(3196, 8, 1, '2025-06-16', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3197, 8, 1, '2025-06-23', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3198, 8, 1, '2025-06-30', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3199, 8, 1, '2025-07-07', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3200, 8, 1, '2025-07-14', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3201, 8, 1, '2025-07-21', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3202, 8, 1, '2025-07-28', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3203, 8, 1, '2025-08-04', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3204, 8, 1, '2025-08-11', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3205, 8, 1, '2025-08-18', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3206, 8, 1, '2025-08-25', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3207, 8, 1, '2025-09-01', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3208, 8, 1, '2025-09-08', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3209, 8, 1, '2025-09-15', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3210, 8, 1, '2025-09-22', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3211, 8, 1, '2025-09-29', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3212, 8, 1, '2025-10-06', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3213, 8, 1, '2025-10-13', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3214, 8, 1, '2025-10-20', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3215, 8, 1, '2025-10-27', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3216, 8, 1, '2025-11-03', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3217, 8, 1, '2025-11-10', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3218, 8, 1, '2025-11-17', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3219, 8, 1, '2025-11-24', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3220, 8, 1, '2025-12-01', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3221, 8, 1, '2025-12-08', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3222, 8, 1, '2025-12-15', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3223, 8, 1, '2025-12-22', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3224, 8, 1, '2025-12-29', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3225, 8, 2, '2025-06-10', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3226, 8, 2, '2025-06-17', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3227, 8, 2, '2025-06-24', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3228, 8, 2, '2025-07-01', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3229, 8, 2, '2025-07-08', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3230, 8, 2, '2025-07-15', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3231, 8, 2, '2025-07-22', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3232, 8, 2, '2025-07-29', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3233, 8, 2, '2025-08-05', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3234, 8, 2, '2025-08-12', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3235, 8, 2, '2025-08-19', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3236, 8, 2, '2025-08-26', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3237, 8, 2, '2025-09-02', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3238, 8, 2, '2025-09-09', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3239, 8, 2, '2025-09-16', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3240, 8, 2, '2025-09-23', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3241, 8, 2, '2025-09-30', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3242, 8, 2, '2025-10-07', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3243, 8, 2, '2025-10-14', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3244, 8, 2, '2025-10-21', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3245, 8, 2, '2025-10-28', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3246, 8, 2, '2025-11-04', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3247, 8, 2, '2025-11-11', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3248, 8, 2, '2025-11-18', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3249, 8, 2, '2025-11-25', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3250, 8, 2, '2025-12-02', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3251, 8, 2, '2025-12-09', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3252, 8, 2, '2025-12-16', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3253, 8, 2, '2025-12-23', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3254, 8, 2, '2025-12-30', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3255, 8, 3, '2025-06-11', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3256, 8, 3, '2025-06-18', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3257, 8, 3, '2025-06-25', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3258, 8, 3, '2025-07-02', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3259, 8, 3, '2025-07-09', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3260, 8, 3, '2025-07-16', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3261, 8, 3, '2025-07-23', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3262, 8, 3, '2025-07-30', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3263, 8, 3, '2025-08-06', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3264, 8, 3, '2025-08-13', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3265, 8, 3, '2025-08-20', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3266, 8, 3, '2025-08-27', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3267, 8, 3, '2025-09-03', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3268, 8, 3, '2025-09-10', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3269, 8, 3, '2025-09-17', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3270, 8, 3, '2025-09-24', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3271, 8, 3, '2025-10-01', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3272, 8, 3, '2025-10-08', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3273, 8, 3, '2025-10-15', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3274, 8, 3, '2025-10-22', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3275, 8, 3, '2025-10-29', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3276, 8, 3, '2025-11-05', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3277, 8, 3, '2025-11-12', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3278, 8, 3, '2025-11-19', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3279, 8, 3, '2025-11-26', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3280, 8, 3, '2025-12-03', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3281, 8, 3, '2025-12-10', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3282, 8, 3, '2025-12-17', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3283, 8, 3, '2025-12-24', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3284, 8, 3, '2025-12-31', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3285, 8, 4, '2025-06-12', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3286, 8, 4, '2025-06-19', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3287, 8, 4, '2025-06-26', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3288, 8, 4, '2025-07-03', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3289, 8, 4, '2025-07-10', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3290, 8, 4, '2025-07-17', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3291, 8, 4, '2025-07-24', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3292, 8, 4, '2025-07-31', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3293, 8, 4, '2025-08-07', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3294, 8, 4, '2025-08-14', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3295, 8, 4, '2025-08-21', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3296, 8, 4, '2025-08-28', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3297, 8, 4, '2025-09-04', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3298, 8, 4, '2025-09-11', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3299, 8, 4, '2025-09-18', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3300, 8, 4, '2025-09-25', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3301, 8, 4, '2025-10-02', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3302, 8, 4, '2025-10-09', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3303, 8, 4, '2025-10-16', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3304, 8, 4, '2025-10-23', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3305, 8, 4, '2025-10-30', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3306, 8, 4, '2025-11-06', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3307, 8, 4, '2025-11-13', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3308, 8, 4, '2025-11-20', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3309, 8, 4, '2025-11-27', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3310, 8, 4, '2025-12-04', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3311, 8, 4, '2025-12-11', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3312, 8, 4, '2025-12-18', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3313, 8, 4, '2025-12-25', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3314, 8, 5, '2025-06-13', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3315, 8, 5, '2025-06-20', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3316, 8, 5, '2025-06-27', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3317, 8, 5, '2025-07-04', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3318, 8, 5, '2025-07-11', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3319, 8, 5, '2025-07-18', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3320, 8, 5, '2025-07-25', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3321, 8, 5, '2025-08-01', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3322, 8, 5, '2025-08-08', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3323, 8, 5, '2025-08-15', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3324, 8, 5, '2025-08-22', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3325, 8, 5, '2025-08-29', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3326, 8, 5, '2025-09-05', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3327, 8, 5, '2025-09-12', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3328, 8, 5, '2025-09-19', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3329, 8, 5, '2025-09-26', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3330, 8, 5, '2025-10-03', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3331, 8, 5, '2025-10-10', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3332, 8, 5, '2025-10-17', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3333, 8, 5, '2025-10-24', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3334, 8, 5, '2025-10-31', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3335, 8, 5, '2025-11-07', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3336, 8, 5, '2025-11-14', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3337, 8, 5, '2025-11-21', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3338, 8, 5, '2025-11-28', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3339, 8, 5, '2025-12-05', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3340, 8, 5, '2025-12-12', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3341, 8, 5, '2025-12-19', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3342, 8, 5, '2025-12-26', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3343, 8, 6, '2025-06-14', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3344, 8, 6, '2025-06-21', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3345, 8, 6, '2025-06-28', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3346, 8, 6, '2025-07-05', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3347, 8, 6, '2025-07-12', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3348, 8, 6, '2025-07-19', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3349, 8, 6, '2025-07-26', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3350, 8, 6, '2025-08-02', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3351, 8, 6, '2025-08-09', '2025-06-10 17:32:32', '2025-06-10 17:32:32'),
(3352, 8, 6, '2025-08-16', '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(3353, 8, 6, '2025-08-23', '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(3354, 8, 6, '2025-08-30', '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(3355, 8, 6, '2025-09-06', '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(3356, 8, 6, '2025-09-13', '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(3357, 8, 6, '2025-09-20', '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(3358, 8, 6, '2025-09-27', '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(3359, 8, 6, '2025-10-04', '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(3360, 8, 6, '2025-10-11', '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(3361, 8, 6, '2025-10-18', '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(3362, 8, 6, '2025-10-25', '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(3363, 8, 6, '2025-11-01', '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(3364, 8, 6, '2025-11-08', '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(3365, 8, 6, '2025-11-15', '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(3366, 8, 6, '2025-11-22', '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(3367, 8, 6, '2025-11-29', '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(3368, 8, 6, '2025-12-06', '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(3369, 8, 6, '2025-12-13', '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(3370, 8, 6, '2025-12-20', '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(3371, 8, 6, '2025-12-27', '2025-06-10 17:32:33', '2025-06-10 17:32:33'),
(3372, 8, 6, '2025-06-14', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3373, 8, 6, '2025-06-21', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3374, 8, 6, '2025-06-28', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3375, 8, 6, '2025-07-05', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3376, 8, 6, '2025-07-12', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3377, 8, 6, '2025-07-19', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3378, 8, 6, '2025-07-26', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3379, 8, 6, '2025-08-02', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3380, 8, 6, '2025-08-09', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3381, 8, 6, '2025-08-16', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3382, 8, 6, '2025-08-23', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3383, 8, 6, '2025-08-30', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3384, 8, 6, '2025-09-06', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3385, 8, 6, '2025-09-13', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3386, 8, 6, '2025-09-20', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3387, 8, 6, '2025-09-27', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3388, 8, 6, '2025-10-04', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3389, 8, 6, '2025-10-11', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3390, 8, 6, '2025-10-18', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3391, 8, 6, '2025-10-25', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3392, 8, 6, '2025-11-01', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3393, 8, 6, '2025-11-08', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3394, 8, 6, '2025-11-15', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3395, 8, 6, '2025-11-22', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3396, 8, 6, '2025-11-29', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3397, 8, 6, '2025-12-06', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3398, 8, 6, '2025-12-13', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3399, 8, 6, '2025-12-20', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3400, 8, 6, '2025-12-27', '2025-06-10 17:33:31', '2025-06-10 17:33:31'),
(3401, 8, 6, '2025-06-14', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3402, 8, 6, '2025-06-21', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3403, 8, 6, '2025-06-28', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3404, 8, 6, '2025-07-05', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3405, 8, 6, '2025-07-12', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3406, 8, 6, '2025-07-19', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3407, 8, 6, '2025-07-26', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3408, 8, 6, '2025-08-02', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3409, 8, 6, '2025-08-09', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3410, 8, 6, '2025-08-16', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3411, 8, 6, '2025-08-23', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3412, 8, 6, '2025-08-30', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3413, 8, 6, '2025-09-06', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3414, 8, 6, '2025-09-13', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3415, 8, 6, '2025-09-20', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3416, 8, 6, '2025-09-27', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3417, 8, 6, '2025-10-04', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3418, 8, 6, '2025-10-11', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3419, 8, 6, '2025-10-18', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3420, 8, 6, '2025-10-25', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3421, 8, 6, '2025-11-01', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3422, 8, 6, '2025-11-08', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3423, 8, 6, '2025-11-15', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3424, 8, 6, '2025-11-22', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3425, 8, 6, '2025-11-29', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3426, 8, 6, '2025-12-06', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3427, 8, 6, '2025-12-13', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3428, 8, 6, '2025-12-20', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3429, 8, 6, '2025-12-27', '2025-06-10 17:35:25', '2025-06-10 17:35:25'),
(3430, 9, 1, '2025-06-16', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3431, 9, 1, '2025-06-23', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3432, 9, 1, '2025-06-30', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3433, 9, 1, '2025-07-07', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3434, 9, 1, '2025-07-14', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3435, 9, 1, '2025-07-21', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3436, 9, 1, '2025-07-28', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3437, 9, 1, '2025-08-04', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3438, 9, 1, '2025-08-11', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3439, 9, 1, '2025-08-18', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3440, 9, 1, '2025-08-25', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3441, 9, 1, '2025-09-01', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3442, 9, 1, '2025-09-08', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3443, 9, 1, '2025-09-15', '2025-06-10 23:30:25', '2025-06-10 23:30:25');
INSERT INTO `horarios` (`id`, `profesional_id`, `dia_semana`, `fecha`, `created_at`, `updated_at`) VALUES
(3444, 9, 1, '2025-09-22', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3445, 9, 1, '2025-09-29', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3446, 9, 1, '2025-10-06', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3447, 9, 1, '2025-10-13', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3448, 9, 1, '2025-10-20', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3449, 9, 1, '2025-10-27', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3450, 9, 1, '2025-11-03', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3451, 9, 1, '2025-11-10', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3452, 9, 1, '2025-11-17', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3453, 9, 1, '2025-11-24', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3454, 9, 1, '2025-12-01', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3455, 9, 1, '2025-12-08', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3456, 9, 1, '2025-12-15', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3457, 9, 1, '2025-12-22', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3458, 9, 1, '2025-12-29', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3459, 9, 2, '2025-06-17', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3460, 9, 2, '2025-06-24', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3461, 9, 2, '2025-07-01', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3462, 9, 2, '2025-07-08', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3463, 9, 2, '2025-07-15', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3464, 9, 2, '2025-07-22', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3465, 9, 2, '2025-07-29', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3466, 9, 2, '2025-08-05', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3467, 9, 2, '2025-08-12', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3468, 9, 2, '2025-08-19', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3469, 9, 2, '2025-08-26', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3470, 9, 2, '2025-09-02', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3471, 9, 2, '2025-09-09', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3472, 9, 2, '2025-09-16', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3473, 9, 2, '2025-09-23', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3474, 9, 2, '2025-09-30', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3475, 9, 2, '2025-10-07', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3476, 9, 2, '2025-10-14', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3477, 9, 2, '2025-10-21', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3478, 9, 2, '2025-10-28', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3479, 9, 2, '2025-11-04', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3480, 9, 2, '2025-11-11', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3481, 9, 2, '2025-11-18', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3482, 9, 2, '2025-11-25', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3483, 9, 2, '2025-12-02', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3484, 9, 2, '2025-12-09', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3485, 9, 2, '2025-12-16', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3486, 9, 2, '2025-12-23', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3487, 9, 2, '2025-12-30', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3488, 9, 3, '2025-06-11', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3489, 9, 3, '2025-06-18', '2025-06-10 23:30:25', '2025-06-10 23:30:25'),
(3490, 9, 3, '2025-06-25', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3491, 9, 3, '2025-07-02', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3492, 9, 3, '2025-07-09', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3493, 9, 3, '2025-07-16', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3494, 9, 3, '2025-07-23', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3495, 9, 3, '2025-07-30', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3496, 9, 3, '2025-08-06', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3497, 9, 3, '2025-08-13', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3498, 9, 3, '2025-08-20', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3499, 9, 3, '2025-08-27', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3500, 9, 3, '2025-09-03', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3501, 9, 3, '2025-09-10', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3502, 9, 3, '2025-09-17', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3503, 9, 3, '2025-09-24', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3504, 9, 3, '2025-10-01', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3505, 9, 3, '2025-10-08', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3506, 9, 3, '2025-10-15', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3507, 9, 3, '2025-10-22', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3508, 9, 3, '2025-10-29', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3509, 9, 3, '2025-11-05', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3510, 9, 3, '2025-11-12', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3511, 9, 3, '2025-11-19', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3512, 9, 3, '2025-11-26', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3513, 9, 3, '2025-12-03', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3514, 9, 3, '2025-12-10', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3515, 9, 3, '2025-12-17', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3516, 9, 3, '2025-12-24', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3517, 9, 3, '2025-12-31', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3518, 9, 4, '2025-06-12', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3519, 9, 4, '2025-06-19', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3520, 9, 4, '2025-06-26', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3521, 9, 4, '2025-07-03', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3522, 9, 4, '2025-07-10', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3523, 9, 4, '2025-07-17', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3524, 9, 4, '2025-07-24', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3525, 9, 4, '2025-07-31', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3526, 9, 4, '2025-08-07', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3527, 9, 4, '2025-08-14', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3528, 9, 4, '2025-08-21', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3529, 9, 4, '2025-08-28', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3530, 9, 4, '2025-09-04', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3531, 9, 4, '2025-09-11', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3532, 9, 4, '2025-09-18', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3533, 9, 4, '2025-09-25', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3534, 9, 4, '2025-10-02', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3535, 9, 4, '2025-10-09', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3536, 9, 4, '2025-10-16', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3537, 9, 4, '2025-10-23', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3538, 9, 4, '2025-10-30', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3539, 9, 4, '2025-11-06', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3540, 9, 4, '2025-11-13', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3541, 9, 4, '2025-11-20', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3542, 9, 4, '2025-11-27', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3543, 9, 4, '2025-12-04', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3544, 9, 4, '2025-12-11', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3545, 9, 4, '2025-12-18', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3546, 9, 4, '2025-12-25', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3547, 9, 5, '2025-06-13', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3548, 9, 5, '2025-06-20', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3549, 9, 5, '2025-06-27', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3550, 9, 5, '2025-07-04', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3551, 9, 5, '2025-07-11', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3552, 9, 5, '2025-07-18', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3553, 9, 5, '2025-07-25', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3554, 9, 5, '2025-08-01', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3555, 9, 5, '2025-08-08', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3556, 9, 5, '2025-08-15', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3557, 9, 5, '2025-08-22', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3558, 9, 5, '2025-08-29', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3559, 9, 5, '2025-09-05', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3560, 9, 5, '2025-09-12', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3561, 9, 5, '2025-09-19', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3562, 9, 5, '2025-09-26', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3563, 9, 5, '2025-10-03', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3564, 9, 5, '2025-10-10', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3565, 9, 5, '2025-10-17', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3566, 9, 5, '2025-10-24', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3567, 9, 5, '2025-10-31', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3568, 9, 5, '2025-11-07', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3569, 9, 5, '2025-11-14', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3570, 9, 5, '2025-11-21', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3571, 9, 5, '2025-11-28', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3572, 9, 5, '2025-12-05', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3573, 9, 5, '2025-12-12', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3574, 9, 5, '2025-12-19', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3575, 9, 5, '2025-12-26', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3576, 9, 6, '2025-06-14', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3577, 9, 6, '2025-06-21', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3578, 9, 6, '2025-06-28', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3579, 9, 6, '2025-07-05', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3580, 9, 6, '2025-07-12', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3581, 9, 6, '2025-07-19', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3582, 9, 6, '2025-07-26', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3583, 9, 6, '2025-08-02', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3584, 9, 6, '2025-08-09', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3585, 9, 6, '2025-08-16', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3586, 9, 6, '2025-08-23', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3587, 9, 6, '2025-08-30', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3588, 9, 6, '2025-09-06', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3589, 9, 6, '2025-09-13', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3590, 9, 6, '2025-09-20', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3591, 9, 6, '2025-09-27', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3592, 9, 6, '2025-10-04', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3593, 9, 6, '2025-10-11', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3594, 9, 6, '2025-10-18', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3595, 9, 6, '2025-10-25', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3596, 9, 6, '2025-11-01', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3597, 9, 6, '2025-11-08', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3598, 9, 6, '2025-11-15', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3599, 9, 6, '2025-11-22', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3600, 9, 6, '2025-11-29', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3601, 9, 6, '2025-12-06', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3602, 9, 6, '2025-12-13', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3603, 9, 6, '2025-12-20', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3604, 9, 6, '2025-12-27', '2025-06-10 23:30:26', '2025-06-10 23:30:26'),
(3605, 10, 1, '2025-06-16', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3606, 10, 1, '2025-06-23', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3607, 10, 1, '2025-06-30', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3608, 10, 1, '2025-07-07', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3609, 10, 1, '2025-07-14', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3610, 10, 1, '2025-07-21', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3611, 10, 1, '2025-07-28', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3612, 10, 1, '2025-08-04', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3613, 10, 1, '2025-08-11', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3614, 10, 1, '2025-08-18', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3615, 10, 1, '2025-08-25', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3616, 10, 1, '2025-09-01', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3617, 10, 1, '2025-09-08', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3618, 10, 1, '2025-09-15', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3619, 10, 1, '2025-09-22', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3620, 10, 1, '2025-09-29', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3621, 10, 1, '2025-10-06', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3622, 10, 1, '2025-10-13', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3623, 10, 1, '2025-10-20', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3624, 10, 1, '2025-10-27', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3625, 10, 1, '2025-11-03', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3626, 10, 1, '2025-11-10', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3627, 10, 1, '2025-11-17', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3628, 10, 1, '2025-11-24', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3629, 10, 1, '2025-12-01', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3630, 10, 1, '2025-12-08', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3631, 10, 1, '2025-12-15', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3632, 10, 1, '2025-12-22', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3633, 10, 1, '2025-12-29', '2025-06-10 23:57:15', '2025-06-10 23:57:15'),
(3634, 10, 2, '2025-06-17', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3635, 10, 2, '2025-06-24', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3636, 10, 2, '2025-07-01', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3637, 10, 2, '2025-07-08', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3638, 10, 2, '2025-07-15', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3639, 10, 2, '2025-07-22', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3640, 10, 2, '2025-07-29', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3641, 10, 2, '2025-08-05', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3642, 10, 2, '2025-08-12', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3643, 10, 2, '2025-08-19', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3644, 10, 2, '2025-08-26', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3645, 10, 2, '2025-09-02', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3646, 10, 2, '2025-09-09', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3647, 10, 2, '2025-09-16', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3648, 10, 2, '2025-09-23', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3649, 10, 2, '2025-09-30', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3650, 10, 2, '2025-10-07', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3651, 10, 2, '2025-10-14', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3652, 10, 2, '2025-10-21', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3653, 10, 2, '2025-10-28', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3654, 10, 2, '2025-11-04', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3655, 10, 2, '2025-11-11', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3656, 10, 2, '2025-11-18', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3657, 10, 2, '2025-11-25', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3658, 10, 2, '2025-12-02', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3659, 10, 2, '2025-12-09', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3660, 10, 2, '2025-12-16', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3661, 10, 2, '2025-12-23', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3662, 10, 2, '2025-12-30', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3663, 10, 3, '2025-06-11', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3664, 10, 3, '2025-06-18', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3665, 10, 3, '2025-06-25', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3666, 10, 3, '2025-07-02', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3667, 10, 3, '2025-07-09', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3668, 10, 3, '2025-07-16', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3669, 10, 3, '2025-07-23', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3670, 10, 3, '2025-07-30', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3671, 10, 3, '2025-08-06', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3672, 10, 3, '2025-08-13', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3673, 10, 3, '2025-08-20', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3674, 10, 3, '2025-08-27', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3675, 10, 3, '2025-09-03', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3676, 10, 3, '2025-09-10', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3677, 10, 3, '2025-09-17', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3678, 10, 3, '2025-09-24', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3679, 10, 3, '2025-10-01', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3680, 10, 3, '2025-10-08', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3681, 10, 3, '2025-10-15', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3682, 10, 3, '2025-10-22', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3683, 10, 3, '2025-10-29', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3684, 10, 3, '2025-11-05', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3685, 10, 3, '2025-11-12', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3686, 10, 3, '2025-11-19', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3687, 10, 3, '2025-11-26', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3688, 10, 3, '2025-12-03', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3689, 10, 3, '2025-12-10', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3690, 10, 3, '2025-12-17', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3691, 10, 3, '2025-12-24', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3692, 10, 3, '2025-12-31', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3693, 10, 4, '2025-06-12', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3694, 10, 4, '2025-06-19', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3695, 10, 4, '2025-06-26', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3696, 10, 4, '2025-07-03', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3697, 10, 4, '2025-07-10', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3698, 10, 4, '2025-07-17', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3699, 10, 4, '2025-07-24', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3700, 10, 4, '2025-07-31', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3701, 10, 4, '2025-08-07', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3702, 10, 4, '2025-08-14', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3703, 10, 4, '2025-08-21', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3704, 10, 4, '2025-08-28', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3705, 10, 4, '2025-09-04', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3706, 10, 4, '2025-09-11', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3707, 10, 4, '2025-09-18', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3708, 10, 4, '2025-09-25', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3709, 10, 4, '2025-10-02', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3710, 10, 4, '2025-10-09', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3711, 10, 4, '2025-10-16', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3712, 10, 4, '2025-10-23', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3713, 10, 4, '2025-10-30', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3714, 10, 4, '2025-11-06', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3715, 10, 4, '2025-11-13', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3716, 10, 4, '2025-11-20', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3717, 10, 4, '2025-11-27', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3718, 10, 4, '2025-12-04', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3719, 10, 4, '2025-12-11', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3720, 10, 4, '2025-12-18', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3721, 10, 4, '2025-12-25', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3722, 10, 6, '2025-06-14', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3723, 10, 6, '2025-06-21', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3724, 10, 6, '2025-06-28', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3725, 10, 6, '2025-07-05', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3726, 10, 6, '2025-07-12', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3727, 10, 6, '2025-07-19', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3728, 10, 6, '2025-07-26', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3729, 10, 6, '2025-08-02', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3730, 10, 6, '2025-08-09', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3731, 10, 6, '2025-08-16', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3732, 10, 6, '2025-08-23', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3733, 10, 6, '2025-08-30', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3734, 10, 6, '2025-09-06', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3735, 10, 6, '2025-09-13', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3736, 10, 6, '2025-09-20', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3737, 10, 6, '2025-09-27', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3738, 10, 6, '2025-10-04', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3739, 10, 6, '2025-10-11', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3740, 10, 6, '2025-10-18', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3741, 10, 6, '2025-10-25', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3742, 10, 6, '2025-11-01', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3743, 10, 6, '2025-11-08', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3744, 10, 6, '2025-11-15', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3745, 10, 6, '2025-11-22', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3746, 10, 6, '2025-11-29', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3747, 10, 6, '2025-12-06', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3748, 10, 6, '2025-12-13', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3749, 10, 6, '2025-12-20', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3750, 10, 6, '2025-12-27', '2025-06-10 23:57:16', '2025-06-10 23:57:16'),
(3751, 11, 1, '2025-06-16', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3752, 11, 1, '2025-06-23', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3753, 11, 1, '2025-06-30', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3754, 11, 1, '2025-07-07', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3755, 11, 1, '2025-07-14', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3756, 11, 1, '2025-07-21', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3757, 11, 1, '2025-07-28', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3758, 11, 1, '2025-08-04', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3759, 11, 1, '2025-08-11', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3760, 11, 1, '2025-08-18', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3761, 11, 1, '2025-08-25', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3762, 11, 1, '2025-09-01', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3763, 11, 1, '2025-09-08', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3764, 11, 1, '2025-09-15', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3765, 11, 1, '2025-09-22', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3766, 11, 1, '2025-09-29', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3767, 11, 1, '2025-10-06', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3768, 11, 1, '2025-10-13', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3769, 11, 1, '2025-10-20', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3770, 11, 1, '2025-10-27', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3771, 11, 1, '2025-11-03', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3772, 11, 1, '2025-11-10', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3773, 11, 1, '2025-11-17', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3774, 11, 1, '2025-11-24', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3775, 11, 1, '2025-12-01', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3776, 11, 1, '2025-12-08', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3777, 11, 1, '2025-12-15', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3778, 11, 1, '2025-12-22', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3779, 11, 1, '2025-12-29', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3780, 11, 2, '2025-06-17', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3781, 11, 2, '2025-06-24', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3782, 11, 2, '2025-07-01', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3783, 11, 2, '2025-07-08', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3784, 11, 2, '2025-07-15', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3785, 11, 2, '2025-07-22', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3786, 11, 2, '2025-07-29', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3787, 11, 2, '2025-08-05', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3788, 11, 2, '2025-08-12', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3789, 11, 2, '2025-08-19', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3790, 11, 2, '2025-08-26', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3791, 11, 2, '2025-09-02', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3792, 11, 2, '2025-09-09', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3793, 11, 2, '2025-09-16', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3794, 11, 2, '2025-09-23', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3795, 11, 2, '2025-09-30', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3796, 11, 2, '2025-10-07', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3797, 11, 2, '2025-10-14', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3798, 11, 2, '2025-10-21', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3799, 11, 2, '2025-10-28', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3800, 11, 2, '2025-11-04', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3801, 11, 2, '2025-11-11', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3802, 11, 2, '2025-11-18', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3803, 11, 2, '2025-11-25', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3804, 11, 2, '2025-12-02', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3805, 11, 2, '2025-12-09', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3806, 11, 2, '2025-12-16', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3807, 11, 2, '2025-12-23', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3808, 11, 2, '2025-12-30', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3809, 11, 3, '2025-06-11', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3810, 11, 3, '2025-06-18', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3811, 11, 3, '2025-06-25', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3812, 11, 3, '2025-07-02', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3813, 11, 3, '2025-07-09', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3814, 11, 3, '2025-07-16', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3815, 11, 3, '2025-07-23', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3816, 11, 3, '2025-07-30', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3817, 11, 3, '2025-08-06', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3818, 11, 3, '2025-08-13', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3819, 11, 3, '2025-08-20', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3820, 11, 3, '2025-08-27', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3821, 11, 3, '2025-09-03', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3822, 11, 3, '2025-09-10', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3823, 11, 3, '2025-09-17', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3824, 11, 3, '2025-09-24', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3825, 11, 3, '2025-10-01', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3826, 11, 3, '2025-10-08', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3827, 11, 3, '2025-10-15', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3828, 11, 3, '2025-10-22', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3829, 11, 3, '2025-10-29', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3830, 11, 3, '2025-11-05', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3831, 11, 3, '2025-11-12', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3832, 11, 3, '2025-11-19', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3833, 11, 3, '2025-11-26', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3834, 11, 3, '2025-12-03', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3835, 11, 3, '2025-12-10', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3836, 11, 3, '2025-12-17', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3837, 11, 3, '2025-12-24', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3838, 11, 3, '2025-12-31', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3839, 11, 4, '2025-06-12', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3840, 11, 4, '2025-06-19', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3841, 11, 4, '2025-06-26', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3842, 11, 4, '2025-07-03', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3843, 11, 4, '2025-07-10', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3844, 11, 4, '2025-07-17', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3845, 11, 4, '2025-07-24', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3846, 11, 4, '2025-07-31', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3847, 11, 4, '2025-08-07', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3848, 11, 4, '2025-08-14', '2025-06-11 00:29:41', '2025-06-11 00:29:41'),
(3849, 11, 4, '2025-08-21', '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(3850, 11, 4, '2025-08-28', '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(3851, 11, 4, '2025-09-04', '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(3852, 11, 4, '2025-09-11', '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(3853, 11, 4, '2025-09-18', '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(3854, 11, 4, '2025-09-25', '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(3855, 11, 4, '2025-10-02', '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(3856, 11, 4, '2025-10-09', '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(3857, 11, 4, '2025-10-16', '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(3858, 11, 4, '2025-10-23', '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(3859, 11, 4, '2025-10-30', '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(3860, 11, 4, '2025-11-06', '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(3861, 11, 4, '2025-11-13', '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(3862, 11, 4, '2025-11-20', '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(3863, 11, 4, '2025-11-27', '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(3864, 11, 4, '2025-12-04', '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(3865, 11, 4, '2025-12-11', '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(3866, 11, 4, '2025-12-18', '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(3867, 11, 4, '2025-12-25', '2025-06-11 00:29:42', '2025-06-11 00:29:42'),
(3868, 12, 1, '2025-06-16', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3869, 12, 1, '2025-06-23', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3870, 12, 1, '2025-06-30', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3871, 12, 1, '2025-07-07', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3872, 12, 1, '2025-07-14', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3873, 12, 1, '2025-07-21', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3874, 12, 1, '2025-07-28', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3875, 12, 1, '2025-08-04', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3876, 12, 1, '2025-08-11', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3877, 12, 1, '2025-08-18', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3878, 12, 1, '2025-08-25', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3879, 12, 1, '2025-09-01', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3880, 12, 1, '2025-09-08', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3881, 12, 1, '2025-09-15', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3882, 12, 1, '2025-09-22', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3883, 12, 1, '2025-09-29', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3884, 12, 1, '2025-10-06', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3885, 12, 1, '2025-10-13', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3886, 12, 1, '2025-10-20', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3887, 12, 1, '2025-10-27', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3888, 12, 1, '2025-11-03', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3889, 12, 1, '2025-11-10', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3890, 12, 1, '2025-11-17', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3891, 12, 1, '2025-11-24', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3892, 12, 1, '2025-12-01', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3893, 12, 1, '2025-12-08', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3894, 12, 1, '2025-12-15', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3895, 12, 1, '2025-12-22', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3896, 12, 1, '2025-12-29', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3897, 12, 3, '2025-06-11', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3898, 12, 3, '2025-06-18', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3899, 12, 3, '2025-06-25', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3900, 12, 3, '2025-07-02', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3901, 12, 3, '2025-07-09', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3902, 12, 3, '2025-07-16', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3903, 12, 3, '2025-07-23', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3904, 12, 3, '2025-07-30', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3905, 12, 3, '2025-08-06', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3906, 12, 3, '2025-08-13', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3907, 12, 3, '2025-08-20', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3908, 12, 3, '2025-08-27', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3909, 12, 3, '2025-09-03', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3910, 12, 3, '2025-09-10', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3911, 12, 3, '2025-09-17', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3912, 12, 3, '2025-09-24', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3913, 12, 3, '2025-10-01', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3914, 12, 3, '2025-10-08', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3915, 12, 3, '2025-10-15', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3916, 12, 3, '2025-10-22', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3917, 12, 3, '2025-10-29', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3918, 12, 3, '2025-11-05', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3919, 12, 3, '2025-11-12', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3920, 12, 3, '2025-11-19', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3921, 12, 3, '2025-11-26', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3922, 12, 3, '2025-12-03', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3923, 12, 3, '2025-12-10', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3924, 12, 3, '2025-12-17', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3925, 12, 3, '2025-12-24', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3926, 12, 3, '2025-12-31', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3927, 12, 5, '2025-06-13', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3928, 12, 5, '2025-06-20', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3929, 12, 5, '2025-06-27', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3930, 12, 5, '2025-07-04', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3931, 12, 5, '2025-07-11', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3932, 12, 5, '2025-07-18', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3933, 12, 5, '2025-07-25', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3934, 12, 5, '2025-08-01', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3935, 12, 5, '2025-08-08', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3936, 12, 5, '2025-08-15', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3937, 12, 5, '2025-08-22', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3938, 12, 5, '2025-08-29', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3939, 12, 5, '2025-09-05', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3940, 12, 5, '2025-09-12', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3941, 12, 5, '2025-09-19', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3942, 12, 5, '2025-09-26', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3943, 12, 5, '2025-10-03', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3944, 12, 5, '2025-10-10', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3945, 12, 5, '2025-10-17', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3946, 12, 5, '2025-10-24', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3947, 12, 5, '2025-10-31', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3948, 12, 5, '2025-11-07', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3949, 12, 5, '2025-11-14', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3950, 12, 5, '2025-11-21', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3951, 12, 5, '2025-11-28', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3952, 12, 5, '2025-12-05', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3953, 12, 5, '2025-12-12', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3954, 12, 5, '2025-12-19', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3955, 12, 5, '2025-12-26', '2025-06-11 13:53:39', '2025-06-11 13:53:39'),
(3985, 7, 1, '2025-06-16', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(3986, 7, 1, '2025-06-23', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(3987, 7, 1, '2025-06-30', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(3988, 7, 1, '2025-07-07', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(3989, 7, 1, '2025-07-14', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(3990, 7, 1, '2025-07-21', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(3991, 7, 1, '2025-07-28', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(3992, 7, 1, '2025-08-04', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(3993, 7, 1, '2025-08-11', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(3994, 7, 1, '2025-08-18', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(3995, 7, 1, '2025-08-25', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(3996, 7, 1, '2025-09-01', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(3997, 7, 1, '2025-09-08', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(3998, 7, 1, '2025-09-15', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(3999, 7, 1, '2025-09-22', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4000, 7, 1, '2025-09-29', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4001, 7, 1, '2025-10-06', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4002, 7, 1, '2025-10-13', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4003, 7, 1, '2025-10-20', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4004, 7, 1, '2025-10-27', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4005, 7, 1, '2025-11-03', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4006, 7, 1, '2025-11-10', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4007, 7, 1, '2025-11-17', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4008, 7, 1, '2025-11-24', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4009, 7, 1, '2025-12-01', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4010, 7, 1, '2025-12-08', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4011, 7, 1, '2025-12-15', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4012, 7, 1, '2025-12-22', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4013, 7, 1, '2025-12-29', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4014, 7, 2, '2025-06-17', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4015, 7, 2, '2025-06-24', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4016, 7, 2, '2025-07-01', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4017, 7, 2, '2025-07-08', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4018, 7, 2, '2025-07-15', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4019, 7, 2, '2025-07-22', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4020, 7, 2, '2025-07-29', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4021, 7, 2, '2025-08-05', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4022, 7, 2, '2025-08-12', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4023, 7, 2, '2025-08-19', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4024, 7, 2, '2025-08-26', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4025, 7, 2, '2025-09-02', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4026, 7, 2, '2025-09-09', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4027, 7, 2, '2025-09-16', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4028, 7, 2, '2025-09-23', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4029, 7, 2, '2025-09-30', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4030, 7, 2, '2025-10-07', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4031, 7, 2, '2025-10-14', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4032, 7, 2, '2025-10-21', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4033, 7, 2, '2025-10-28', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4034, 7, 2, '2025-11-04', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4035, 7, 2, '2025-11-11', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4036, 7, 2, '2025-11-18', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4037, 7, 2, '2025-11-25', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4038, 7, 2, '2025-12-02', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4039, 7, 2, '2025-12-09', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4040, 7, 2, '2025-12-16', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4041, 7, 2, '2025-12-23', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4042, 7, 2, '2025-12-30', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4043, 7, 3, '2025-06-18', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4044, 7, 3, '2025-06-25', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4045, 7, 3, '2025-07-02', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4046, 7, 3, '2025-07-09', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4047, 7, 3, '2025-07-16', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4048, 7, 3, '2025-07-23', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4049, 7, 3, '2025-07-30', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4050, 7, 3, '2025-08-06', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4051, 7, 3, '2025-08-13', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4052, 7, 3, '2025-08-20', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4053, 7, 3, '2025-08-27', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4054, 7, 3, '2025-09-03', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4055, 7, 3, '2025-09-10', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4056, 7, 3, '2025-09-17', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4057, 7, 3, '2025-09-24', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4058, 7, 3, '2025-10-01', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4059, 7, 3, '2025-10-08', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4060, 7, 3, '2025-10-15', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4061, 7, 3, '2025-10-22', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4062, 7, 3, '2025-10-29', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4063, 7, 3, '2025-11-05', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4064, 7, 3, '2025-11-12', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4065, 7, 3, '2025-11-19', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4066, 7, 3, '2025-11-26', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4067, 7, 3, '2025-12-03', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4068, 7, 3, '2025-12-10', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4069, 7, 3, '2025-12-17', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4070, 7, 3, '2025-12-24', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4071, 7, 3, '2025-12-31', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4072, 7, 4, '2025-06-19', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4073, 7, 4, '2025-06-26', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4074, 7, 4, '2025-07-03', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4075, 7, 4, '2025-07-10', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4076, 7, 4, '2025-07-17', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4077, 7, 4, '2025-07-24', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4078, 7, 4, '2025-07-31', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4079, 7, 4, '2025-08-07', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4080, 7, 4, '2025-08-14', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4081, 7, 4, '2025-08-21', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4082, 7, 4, '2025-08-28', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4083, 7, 4, '2025-09-04', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4084, 7, 4, '2025-09-11', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4085, 7, 4, '2025-09-18', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4086, 7, 4, '2025-09-25', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4087, 7, 4, '2025-10-02', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4088, 7, 4, '2025-10-09', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4089, 7, 4, '2025-10-16', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4090, 7, 4, '2025-10-23', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4091, 7, 4, '2025-10-30', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4092, 7, 4, '2025-11-06', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4093, 7, 4, '2025-11-13', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4094, 7, 4, '2025-11-20', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4095, 7, 4, '2025-11-27', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4096, 7, 4, '2025-12-04', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4097, 7, 4, '2025-12-11', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4098, 7, 4, '2025-12-18', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4099, 7, 4, '2025-12-25', '2025-06-13 14:23:09', '2025-06-13 14:23:09'),
(4156, 1, 2, '2025-06-24', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4157, 1, 2, '2025-07-01', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4158, 1, 2, '2025-07-08', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4159, 1, 2, '2025-07-15', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4160, 1, 2, '2025-07-22', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4161, 1, 2, '2025-07-29', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4162, 1, 2, '2025-08-05', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4163, 1, 2, '2025-08-12', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4164, 1, 2, '2025-08-19', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4165, 1, 2, '2025-08-26', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4166, 1, 2, '2025-09-02', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4167, 1, 2, '2025-09-09', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4168, 1, 2, '2025-09-16', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4169, 1, 2, '2025-09-23', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4170, 1, 2, '2025-09-30', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4171, 1, 2, '2025-10-07', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4172, 1, 2, '2025-10-14', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4173, 1, 2, '2025-10-21', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4174, 1, 2, '2025-10-28', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4175, 1, 2, '2025-11-04', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4176, 1, 2, '2025-11-11', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4177, 1, 2, '2025-11-18', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4178, 1, 2, '2025-11-25', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4179, 1, 2, '2025-12-02', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4180, 1, 2, '2025-12-09', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4181, 1, 2, '2025-12-16', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4182, 1, 2, '2025-12-23', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4183, 1, 2, '2025-12-30', '2025-06-21 08:56:05', '2025-06-21 08:56:05'),
(4184, 1, 2, '2025-06-24', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4185, 1, 2, '2025-07-01', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4186, 1, 2, '2025-07-08', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4187, 1, 2, '2025-07-15', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4188, 1, 2, '2025-07-22', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4189, 1, 2, '2025-07-29', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4190, 1, 2, '2025-08-05', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4191, 1, 2, '2025-08-12', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4192, 1, 2, '2025-08-19', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4193, 1, 2, '2025-08-26', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4194, 1, 2, '2025-09-02', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4195, 1, 2, '2025-09-09', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4196, 1, 2, '2025-09-16', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4197, 1, 2, '2025-09-23', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4198, 1, 2, '2025-09-30', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4199, 1, 2, '2025-10-07', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4200, 1, 2, '2025-10-14', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4201, 1, 2, '2025-10-21', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4202, 1, 2, '2025-10-28', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4203, 1, 2, '2025-11-04', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4204, 1, 2, '2025-11-11', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4205, 1, 2, '2025-11-18', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4206, 1, 2, '2025-11-25', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4207, 1, 2, '2025-12-02', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4208, 1, 2, '2025-12-09', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4209, 1, 2, '2025-12-16', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4210, 1, 2, '2025-12-23', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4211, 1, 2, '2025-12-30', '2025-06-21 08:56:26', '2025-06-21 08:56:26'),
(4212, 19, 1, '2025-06-30', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4213, 19, 1, '2025-07-07', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4214, 19, 1, '2025-07-14', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4215, 19, 1, '2025-07-21', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4216, 19, 1, '2025-07-28', '2025-06-25 17:22:14', '2025-06-25 17:22:14');
INSERT INTO `horarios` (`id`, `profesional_id`, `dia_semana`, `fecha`, `created_at`, `updated_at`) VALUES
(4217, 19, 1, '2025-08-04', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4218, 19, 1, '2025-08-11', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4219, 19, 1, '2025-08-18', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4220, 19, 1, '2025-08-25', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4221, 19, 1, '2025-09-01', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4222, 19, 1, '2025-09-08', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4223, 19, 1, '2025-09-15', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4224, 19, 1, '2025-09-22', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4225, 19, 1, '2025-09-29', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4226, 19, 1, '2025-10-06', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4227, 19, 1, '2025-10-13', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4228, 19, 1, '2025-10-20', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4229, 19, 1, '2025-10-27', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4230, 19, 1, '2025-11-03', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4231, 19, 1, '2025-11-10', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4232, 19, 1, '2025-11-17', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4233, 19, 1, '2025-11-24', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4234, 19, 1, '2025-12-01', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4235, 19, 1, '2025-12-08', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4236, 19, 1, '2025-12-15', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4237, 19, 1, '2025-12-22', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4238, 19, 1, '2025-12-29', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4239, 19, 2, '2025-07-01', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4240, 19, 2, '2025-07-08', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4241, 19, 2, '2025-07-15', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4242, 19, 2, '2025-07-22', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4243, 19, 2, '2025-07-29', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4244, 19, 2, '2025-08-05', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4245, 19, 2, '2025-08-12', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4246, 19, 2, '2025-08-19', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4247, 19, 2, '2025-08-26', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4248, 19, 2, '2025-09-02', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4249, 19, 2, '2025-09-09', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4250, 19, 2, '2025-09-16', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4251, 19, 2, '2025-09-23', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4252, 19, 2, '2025-09-30', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4253, 19, 2, '2025-10-07', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4254, 19, 2, '2025-10-14', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4255, 19, 2, '2025-10-21', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4256, 19, 2, '2025-10-28', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4257, 19, 2, '2025-11-04', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4258, 19, 2, '2025-11-11', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4259, 19, 2, '2025-11-18', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4260, 19, 2, '2025-11-25', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4261, 19, 2, '2025-12-02', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4262, 19, 2, '2025-12-09', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4263, 19, 2, '2025-12-16', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4264, 19, 2, '2025-12-23', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4265, 19, 2, '2025-12-30', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4266, 19, 4, '2025-06-26', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4267, 19, 4, '2025-07-03', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4268, 19, 4, '2025-07-10', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4269, 19, 4, '2025-07-17', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4270, 19, 4, '2025-07-24', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4271, 19, 4, '2025-07-31', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4272, 19, 4, '2025-08-07', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4273, 19, 4, '2025-08-14', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4274, 19, 4, '2025-08-21', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4275, 19, 4, '2025-08-28', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4276, 19, 4, '2025-09-04', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4277, 19, 4, '2025-09-11', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4278, 19, 4, '2025-09-18', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4279, 19, 4, '2025-09-25', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4280, 19, 4, '2025-10-02', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4281, 19, 4, '2025-10-09', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4282, 19, 4, '2025-10-16', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4283, 19, 4, '2025-10-23', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4284, 19, 4, '2025-10-30', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4285, 19, 4, '2025-11-06', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4286, 19, 4, '2025-11-13', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4287, 19, 4, '2025-11-20', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4288, 19, 4, '2025-11-27', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4289, 19, 4, '2025-12-04', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4290, 19, 4, '2025-12-11', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4291, 19, 4, '2025-12-18', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4292, 19, 4, '2025-12-25', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4293, 19, 5, '2025-06-27', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4294, 19, 5, '2025-07-04', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4295, 19, 5, '2025-07-11', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4296, 19, 5, '2025-07-18', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4297, 19, 5, '2025-07-25', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4298, 19, 5, '2025-08-01', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4299, 19, 5, '2025-08-08', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4300, 19, 5, '2025-08-15', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4301, 19, 5, '2025-08-22', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4302, 19, 5, '2025-08-29', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4303, 19, 5, '2025-09-05', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4304, 19, 5, '2025-09-12', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4305, 19, 5, '2025-09-19', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4306, 19, 5, '2025-09-26', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4307, 19, 5, '2025-10-03', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4308, 19, 5, '2025-10-10', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4309, 19, 5, '2025-10-17', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4310, 19, 5, '2025-10-24', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4311, 19, 5, '2025-10-31', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4312, 19, 5, '2025-11-07', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4313, 19, 5, '2025-11-14', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4314, 19, 5, '2025-11-21', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4315, 19, 5, '2025-11-28', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4316, 19, 5, '2025-12-05', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4317, 19, 5, '2025-12-12', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4318, 19, 5, '2025-12-19', '2025-06-25 17:22:14', '2025-06-25 17:22:14'),
(4319, 19, 5, '2025-12-26', '2025-06-25 17:22:14', '2025-06-25 17:22:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios_videollamada`
--

CREATE TABLE `horarios_videollamada` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profesional_id` bigint(20) UNSIGNED NOT NULL,
  `dia_semana` varchar(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `horarios_videollamada`
--

INSERT INTO `horarios_videollamada` (`id`, `profesional_id`, `dia_semana`, `fecha`, `created_at`, `updated_at`) VALUES
(1, 1, '0', '2025-06-29', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(2, 1, '0', '2025-07-06', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(3, 1, '0', '2025-07-13', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(4, 1, '0', '2025-07-20', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(5, 1, '0', '2025-07-27', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(6, 1, '0', '2025-08-03', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(7, 1, '0', '2025-08-10', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(8, 1, '0', '2025-08-17', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(9, 1, '0', '2025-08-24', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(10, 1, '0', '2025-08-31', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(11, 1, '0', '2025-09-07', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(12, 1, '0', '2025-09-14', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(13, 1, '0', '2025-09-21', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(14, 1, '0', '2025-09-28', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(15, 1, '0', '2025-10-05', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(16, 1, '0', '2025-10-12', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(17, 1, '0', '2025-10-19', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(18, 1, '0', '2025-10-26', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(19, 1, '0', '2025-11-02', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(20, 1, '0', '2025-11-09', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(21, 1, '0', '2025-11-16', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(22, 1, '0', '2025-11-23', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(23, 1, '0', '2025-11-30', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(24, 1, '0', '2025-12-07', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(25, 1, '0', '2025-12-14', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(26, 1, '0', '2025-12-21', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(27, 1, '0', '2025-12-28', '2025-06-26 14:00:21', '2025-06-26 14:00:21'),
(55, 1, '2', '2025-07-01', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(56, 1, '2', '2025-07-08', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(57, 1, '2', '2025-07-15', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(58, 1, '2', '2025-07-22', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(59, 1, '2', '2025-07-29', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(60, 1, '2', '2025-08-05', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(61, 1, '2', '2025-08-12', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(62, 1, '2', '2025-08-19', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(63, 1, '2', '2025-08-26', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(64, 1, '2', '2025-09-02', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(65, 1, '2', '2025-09-09', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(66, 1, '2', '2025-09-16', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(67, 1, '2', '2025-09-23', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(68, 1, '2', '2025-09-30', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(69, 1, '2', '2025-10-07', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(70, 1, '2', '2025-10-14', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(71, 1, '2', '2025-10-21', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(72, 1, '2', '2025-10-28', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(73, 1, '2', '2025-11-04', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(74, 1, '2', '2025-11-11', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(75, 1, '2', '2025-11-18', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(76, 1, '2', '2025-11-25', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(77, 1, '2', '2025-12-02', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(78, 1, '2', '2025-12-09', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(79, 1, '2', '2025-12-16', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(80, 1, '2', '2025-12-23', '2025-06-27 03:51:26', '2025-06-27 03:51:26'),
(81, 1, '2', '2025-12-30', '2025-06-27 03:51:26', '2025-06-27 03:51:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informes_consultas`
--

CREATE TABLE `informes_consultas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cita_id` bigint(20) UNSIGNED NOT NULL,
  `motivo_consulta` text DEFAULT NULL,
  `antecedentes_familiares` text DEFAULT NULL,
  `antecedentes_personales` text DEFAULT NULL,
  `enfermedad_actual` text DEFAULT NULL,
  `exploracion_fisica` text DEFAULT NULL,
  `pruebas_complementarias` text DEFAULT NULL,
  `juicio_clinico` text DEFAULT NULL,
  `dibujo_dental` text DEFAULT NULL,
  `plan_terapeutico` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `informes_consultas`
--

INSERT INTO `informes_consultas` (`id`, `cita_id`, `motivo_consulta`, `antecedentes_familiares`, `antecedentes_personales`, `enfermedad_actual`, `exploracion_fisica`, `pruebas_complementarias`, `juicio_clinico`, `dibujo_dental`, `plan_terapeutico`, `created_at`, `updated_at`) VALUES
(16, 44, 'Dolor de cabeza', 'fdsfsd', 'fds', 'fds', 'DDD', 'vcx', 'dfs', 'AAA', 'WWW', '2025-06-23 12:56:51', '2025-06-23 12:56:51'),
(17, 48, 'Revisión cardiólogo', 'sdada', 'das', NULL, 'czxcz', 'cxz', 'cxz', 'cxz', 'cxzc', '2025-07-01 10:22:11', '2025-07-01 10:22:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intervalo_medicamentos`
--

CREATE TABLE `intervalo_medicamentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `intervalo_medicamentos`
--

INSERT INTO `intervalo_medicamentos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Cada hora', NULL, NULL),
(2, 'Cada 2 horas', NULL, NULL),
(3, 'Cada 4 horas', NULL, NULL),
(4, 'Cada 6 horas', NULL, NULL),
(5, 'Cada 8 horas', NULL, NULL),
(6, 'Cada 12 horas', NULL, NULL),
(7, 'Cada 24 horas (una vez al día)', NULL, NULL),
(8, 'Cada 48 horas (cada dos días)', NULL, NULL),
(9, 'Cada 72 horas (cada tres días)', NULL, NULL),
(10, 'Cada semana', NULL, NULL),
(11, 'Cada 2 semanas', NULL, NULL),
(12, 'Cada mes', NULL, NULL),
(13, 'En días alternos', NULL, NULL),
(14, 'Una vez al día', NULL, NULL),
(15, 'Dos veces al día', NULL, NULL),
(16, 'Tres veces al día', NULL, NULL),
(17, 'Antes de dormir', NULL, NULL),
(18, 'En ayunas', NULL, NULL),
(19, 'Según necesidad (PRN)', NULL, NULL),
(20, 'Una vez (dosis única)', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `medicamentos`
--

INSERT INTO `medicamentos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'FLUOR DESOXIGLUCOSA (18 - FDG)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(2, 'ABACAVIR (como sulfato)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(3, 'ACETATO DE ABIRATERONA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(4, 'ACETAZOLAMIDA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(5, 'ACETILCISTEINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(6, 'ACICLOVIR 3%', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(7, 'ACICLOVIR', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(8, 'ACICLOVIR (como sal sódica)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(9, 'ACIDO ACETILSALICILICO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(10, 'ACIDO ACETILSALICILICO 80 a', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(11, 'ACIDO ALENDRONICO (como alendronato sódico)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(12, 'ACIDO ASCORBICO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(13, 'ACIDO DIMERCAPTOSUCCINICO - -', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(14, 'ÁCIDO DIMERCAPTOSUCCINICO PENTAVALENTE (DMSA-V) - -', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(15, 'ACIDO FOLICO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(17, 'ACIDO FUSIDICO 2% CRM TOP 15', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(18, 'ACIDO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(19, 'ACIDO IBANDRONICO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(20, 'ACIDO IMINODIACETICO (IDA) - -', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(21, 'ACIDO P-AMINOSALICILICO 4g', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(22, 'ACIDO TRANEXAMICO 1g', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(23, 'ACIDO TRANEXAMICO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(24, 'ACIDO URSODEOXICOLICO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(25, 'ACIDO ZOLEDRONICO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(26, 'ACITRETINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(27, 'ACTINOMICINA D 500 mcg', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(28, 'ADALIMUMAB', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(29, 'ADENOSINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(30, 'AGALSIDASA BETA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(31, 'AGUA PARA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(32, 'AIRE MEDICINAL m3', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(33, 'ALBENDAZOL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(34, 'ALBUMINA HUMANA 20', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(35, 'ALCOHOL POLIVINILICO 1.4% SOL OFT', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(36, 'ALOPURINOL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(37, 'ALPRAZOLAM', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(38, 'ALTEPLASA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(39, 'ALUMINIO HIDROXIDO + MAGNESIO HIDROXIDO LIQ ORAL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(40, 'AMFOTERICINA B (como deoxicolato sódico)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(41, 'AMFOTERICINA B COMPLEJO LIPIDICO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(42, 'AMIKACINA (como sulfato)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(43, 'AMILO NITRITO LIQ INH', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(44, 'Código Principio Activo Concent. Form Farm Pres.', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(45, 'AMINOACIDOS CON ELECTROLITOS 10 -15%', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(46, 'AMINOACIDOS FORMULA PEDIATRICA 10% SOL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(47, 'CODIGO AMINOÁCIDOS S/E PARA INSUFICIENCIA HEPATICA 8%', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(48, 'AMINOÁCIDOS S/E PARA INSUFICIENCIA RENAL 7%', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(49, 'CODIGO AMINOACIDOS SIN ELECTROLITOS 10 -15%', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(50, 'AMINOFILINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(51, 'AMIODARONA CLORHIDRATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(52, 'AMISULPRIDA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(53, 'AMITRIPTILINA CLORHIDRATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(54, 'AMLODIPINO (como besilato)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(55, 'AMOXICILINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(56, 'AMOXICILINA + ACIDO CLAVULANICO (como sal potásica) LIQ ORAL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(57, 'AMOXICILINA + ACIDO CLAVULANICO (como sal potásica)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(58, 'AMPICILINA (como sal sódica) 1g', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(59, 'AMPICILINA (como sal sódica)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(60, 'AMPICILINA (como sal sódica) + SULBACTAM (como sal sódica) 1', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(61, 'ANASTROZOL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(62, 'ANTIHEMORROIDAL (Anestésico local + corticoide + aplicador) CRM', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(63, 'ANTIMONIATO MEGLUMINA antimonio', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(64, 'ANTITOXINA TETANICA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(65, 'APREPITANT', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(66, 'CODIGO ARIPIPRAZOL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(67, 'ARTEMETERO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(68, 'ARTESUNATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(69, 'ASPARAGINASA 10,000 UI', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(70, 'ATAZANAVIR (como sulfato)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(71, 'ATENOLOL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(72, 'ATORVASTATINA (como sal cálcica)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(73, 'ATROPINA SULFATO 1% SOL OFT', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(74, 'ATROPINA SULFATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(75, 'AZACITIDINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(76, 'AZATIOPRINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(77, 'AZITROMICINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(78, 'AZTREONAM 1g', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(79, 'BACLOFENO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(80, 'BARIO SULFATO SUS REC', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(81, 'BARIO SULFATO LIQ ORAL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(82, 'BECLOMETASONA DIPROPIONATO 250 mcg/dosis AER INH', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(83, 'BENCIDAMINA CLORHIDRATO 0.15% LIQ ORAL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(84, 'BENCILPENICILINA BENZATINA UI', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(85, 'BENCILPENICILINA SODICA UI', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(86, 'BENZNIDAZOL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(87, 'BETAMETASONA (COMO DIPROPIONATO) 0.05% CRM TOP 20g', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(88, 'BETAMETASONA (COMO FOSFATO SODICO)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(89, 'BEVACIZUMAB', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(90, 'BICALUTAMIDA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(91, 'BIPERIDENO CLORHIDRATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(92, 'BIPERIDENO LACTATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(93, 'BISACODILO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(94, 'BISMUTO SUBSALICILATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(95, 'BISMUTO SUBSALICILATO 87.33', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(96, 'BISOPROLOL FUMARATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(97, 'BLEOMICINA (como sulfato)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(98, 'BORTEZOMIB 3.5', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(99, 'BRIMONIDINA TARTRATO 0.15% SOL OFT', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(100, 'BROMOCRIPTINA COMO MESILATO 2.5', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(101, 'BUDESONIDA 100 mcg/dosis SPR NAS 200 DOSIS', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(102, 'BUDESONIDA 200 mcg/dosis AER INH 200 DOSIS', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(103, 'BUPIVACAINA CLORHIDRATO +', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(104, 'BUPIVACAINA CLORHIDRATO SIN PRESERVANTES 0.5%', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(105, 'BUPRENORFINA 35 mcg/h PTD', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(107, 'CABERGOLINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(109, 'CAFEINA CITRATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(111, 'CALCIO CITRATO + VITAMINA D3', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(112, 'CALCIO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(113, 'CALCIOEDETATO SODICO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(114, 'CALCITRIOL 0.25 mcg', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(115, 'CALCITRIOL 1 mcg/ml', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(116, 'CAPECITABINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(117, 'CAPTOPRIL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(118, 'CARBAMAZEPINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(119, 'CARBON ACTIVADO 50', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(120, 'CARBOPLATINO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(121, 'CARMUSTINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(122, 'CARVEDILOL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(123, 'CARVEDILOL 6.25', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(124, 'CASPOFUNGINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(125, 'CEFACLOR', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(126, 'CEFALEXINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(127, 'CEFAZOLINA (como sal sódica) 1g', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(128, 'CEFOPERAZONA + SULBACTAM IM/IV 1', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(129, 'CEFOTAXIMA (como sal sódica)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(130, 'CEFTAZIDIMA 1g', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(131, 'CEFTRIAXONA (como sal sódica) IV 1g', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(132, 'CEFUROXIMA (como axetil)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(133, 'CEFUROXIMA (como sal sódica)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(134, 'CETUXIMAB', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(135, 'CICLOFOSFAMIDA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(136, 'CICLOFOSFAMIDA 1g', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(137, 'CICLOPENTOLATO CLORHIDRATO 1% SOL OFT', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(138, 'CICLOSPORINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(139, 'CIPROFLOXACINO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(140, 'CIPROFLOXACINO (como clorhidrato) 0.3% SOL OTI', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(141, 'CIPROFLOXACINO (como clorhidrato) 0.3% SOL OFT', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(142, 'CIPROFLOXACINO (como clorhidrato)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(143, 'CIPROFLOXACINO (como lactato)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(144, 'CIPROTERONA ACETATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(145, 'CISPLATINO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(146, 'CITARABINA SIN PRESERVANTE', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(147, 'CITICOLINA 1g', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(148, 'CLARITROMICINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(149, 'CLINDAMICINA (como clorhidrato)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(150, 'CLINDAMICINA (como fosfato)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(151, 'CLINDAMICINA (como palmitato)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(152, 'CLOBAZAM', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(153, 'CLOBETASOL PROPIONATO 0.05% CRM TOP 25g', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(154, 'CLOMIFENO CITRATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(155, 'CLOMIPRAMINA CLORHIDRATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(156, 'CLONAZEPAM', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(157, 'CLONAZEPAM 500mcg (0,5mg)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(158, 'CLOPIDOGREL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(159, 'CLORAFENICOL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(160, 'CLORANFENICOL 0.5% SOL OFT', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(161, 'CLORANFENICOL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(162, 'CLORANFENICOL (como palmitato)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(163, 'CLORANFENICOL (como succinato sódico) 1g', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(164, 'CLORFENAMINA MALEATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(165, 'CLOROQUINA (como fosfato)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(166, 'CLORPROMAZINA CLORHIDRATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(167, 'CLOTRIMAZOL 1% CRM VAG', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(168, 'CLOTRIMAZOL 1% CRM TOP 20g', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(169, 'CLOTRIMAZOL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(170, 'CLOZAPINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(171, 'CODEINA FOSFATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(172, 'COLCHICINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(173, 'COLISTIMETATO DE SODIO O COLISTINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(174, 'COLOIDE DE AZUFRE KIT (A+B+C) X 3', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(175, 'COMPLEJO B', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(176, 'CONCENTRADO DE COMPLEJO FACTOR IX (Factor II, VII, IX y X)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(177, 'CONCENTRADO DE FACTOR VIII', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(178, 'CONJUGADO rEGF+rP64K 0.9mg/0.9', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(179, 'DACARBAZINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(180, 'CODIGO DACLATASVIR', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(181, 'DAPSONA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(182, 'DARUNAVIR ETANOLATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(183, 'DASATINIB', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(184, 'DAUNORUBICINA (como clorhidrato)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(185, 'DERIVADO PROTEICO PURIFICADO DE TUBERCULINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(186, 'DESMOPRESINA ACETATO 10mcg/dosis SPR NAS', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(187, 'DESOGESTREL 0.075', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(188, 'DEXAMETASONA 0.1% SOL OFT', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(189, 'DEXAMETASONA (como dexametasona fosfato sódico)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(190, 'DEXAMETASONA FOSFATO (como sal sódica)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(191, 'DEXRAZOXANO (como clorhidrato)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(192, 'DEXTRAN', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(193, 'DEXTROMETORFANO BROMHIDRATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(194, 'DIAZEPAM', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(195, 'DICLOFENACO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(196, 'DICLOFENACO SODICO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(197, 'DICLOFENACO SODICO 1%', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(198, 'DICLOFENACO SODICO 0.1% SOL OFT', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(199, 'DICLOXACILINA (como sal sódica)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(200, 'DIETIL TETRAPENTACETICO (DPTA) - -', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(201, 'DIGLUCONATO DE CLORHEXIDINA 0.12% SOL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(203, 'DIGOXINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(204, 'DILTIAZEM CLOHIDRATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(205, 'DIMENHIDRINATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(206, 'CODIGO DIOXIDO DE CARBONO MEDICINAL Kg', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(207, 'DIPIRIDAMOL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(208, 'DISULFIRAM', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(209, 'DOBUTAMINA (como clorhidrato) 12.5', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(210, 'DOCETAXEL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(211, 'DOPAMINA CLORHIDRATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(212, 'DORZOLAMIDA 2% SOL OFT', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(213, 'DOXAZOSINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(214, 'DOXICICLINA (como clorhidrato o hiclato)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(215, 'DOXORUBICINA CLORHIDRATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(216, 'EFAVIRENZ', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(217, 'EFAVIRENZ+EMTRICITABINA+TENOFOVIR DISOPROXIL FUMARATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(218, 'mg', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(219, 'ENALAPRIL MALEATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(220, 'ENOXAPARINA SODICA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(221, 'ENTECAVIR', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(222, 'EPINEFRINA (como clorhidrato o tartrato ácido)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(223, 'EPIRUBICINA CLORHIDRATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(224, 'EPOETINA ALFA (ERITROPOYETINA RECOMBINANTE HUMANA ALFA) 2,000 UI/ml', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(225, 'EPOETINA ALFA (ERITROPOYETINA RECOMBINANTE HUMANA ALFA) 4,000 UI/ml', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(226, 'EPOETINA BETA (ERITROPOYETINA BETA RECOMBINANTE HUMANA) 30,000 UI', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(228, 'ERGOCALCIFEROL LIQ ORAL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(230, 'ERGOCALCIFEROL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(231, 'ERGOMETRINA MALEATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(232, 'ERGOMETRINA MALEATO 0.2', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(233, 'ERITROMICINA (como estearato o etilsuccinato) 200-250', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(234, 'ERITROMICINA (como estearato o etilsuccinato)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(235, 'ERLOTINIB CLORHIDRATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(236, 'ERTAPENEM 1g', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(237, 'ESCOPOLAMINA BUTILBROMURO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(238, 'ESPIRONOLACTONA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(239, 'ESTAÑOSO CLORURO (Cl2Sn) - -', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(240, 'ESTAVUDINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(241, 'ESTRADIOL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(242, 'ESTRADIOL VALERATO + DROSPIRENONA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(243, 'ESTRADIOL CIPIONATO + MEDROXIPROGESTERONA ACETATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(244, 'ESTREPTOMICINA (como sulfato) 1g', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(245, 'ESTREPTOMICINA (como sulfato) 5g', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(246, 'ESTRIOL 0.1% CRM VAG 15', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(247, 'ETAMBUTOL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(248, 'ETAMSILATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(249, 'ETILEFRINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(250, 'ETILENDICISTEINA DIMERO 1.0', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(252, 'ETINILESTRADIOL+LEVONORGESTREL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(253, 'ETIONAMIDA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(254, 'ETOPOSIDO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(255, 'ETOSUXIMIDA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(256, 'ETRAVIRINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(257, 'EVEROLIMUS 0.75', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(258, 'CODIGO EVEROLIMUS', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(259, 'EXEMESTANO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(260, 'EXTRACTO ALTERNARIA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(261, 'EXTRACTO ASPERGILLUS', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(262, 'EXTRACTO HORMODENDRUM', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(263, 'EXTRACTO MUCOR', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(264, 'EXTRACTO PENICILLIUM', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(265, 'EXTRACTO POLVOS DE CASA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(266, 'EXTRACTO RHIZOPUS', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(267, 'FENAZOPIRIDINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(268, 'FENITOINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(269, 'FENITOINA SODICA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(270, 'FENOBARBITAL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(271, 'FENTANILO 8.4', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(272, 'FENTANILO (como citrato)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(273, 'FIBRINOLISINA BOVINA + DESOXIRRIBONUCLEASA + CLORANFENICOL CLEASA 99900 U', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(274, 'FILGRASTIM 30 000 000 UI', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(275, 'FILGRASTIM 48 000 000 UI', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(276, 'FINASTERIDA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(277, 'FITOMENADIONA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(278, 'FLAVOXATO CLORHIDRATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(279, 'FLUCONAZOL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(280, 'FLUDARABINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(281, 'FLUDARABINA FOSFATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(282, 'FLUFENAZINA DECANOATO O ENANTATO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(283, 'FLUMAZENIL', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(284, 'ml)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(285, 'FLUORESCEINA SODICA 10%', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(286, 'FLUORESCEINA SODICA 2% SOL OFT', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(287, 'FLUOROMETOLONA 0.1% SOL OFT', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(288, 'FLUOROURACILO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(289, 'FLUOXETINA (como clorhidrato)', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(290, 'FLUTAMIDA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(292, 'FLUTICASONA + SALMETEROL AER INH 60 DOSIS', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(294, 'FLUTICASONA PROPIONATO + SALMETEROL (como xinafoato) AER INH 120 DOSIS', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(295, 'FOLINATO CÁLCICO', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(296, 'FOLITROPINA BETA 600 UI / 0.72', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(297, 'FOSFATO DIBASICO DE SODIO HEPTAHIDRATADO PEDIATRICO 5.93', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(298, 'g', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(299, 'FOSFATO DIBASICO DE SODIO MONOHIDRATADO ADULTO FOSFATO SOL REC', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(300, 'FULVESTRANT', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(301, 'FURAZOLIDONA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(302, 'FUROSEMIDA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(303, 'GABAPENTINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(304, 'GALANTAMINA', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(305, 'GALIO 67 (Ga 67) - -', '2025-04-22 13:49:25', '2025-04-22 13:49:25'),
(306, 'GANCICLOVIR (como sal sódica)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(307, 'GEMCITABINA (como clorhidrato) 1g', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(308, 'GEMCITABINA (como clorhidrato)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(309, 'GEMFIBROZILO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(310, 'GENTAMICINA 3.5', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(311, 'GENTAMICINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(312, 'GENTAMICINA (como sulfato)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(313, 'GLIBENCLAMIDA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(314, 'GLICEROL SUP', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(315, 'GLICEROLTRINITRATO (NITROGLICERINA)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(316, 'GLUCOSA 33.3%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(317, 'GLUCOSA en Agua 10%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(318, 'GLUCOSA en Agua 50%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(319, 'GLUCOSA en Agua 5%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(320, 'GLUCOSA EN AGUA + SODIO CLORURO 5% + 0.9%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(321, 'GLUTAMINA LIBRE 20%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(322, 'GONADOTROPINA CORIONICA 5 000 UI', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(323, 'GUAIFENESINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(324, 'HALOPERIDOL', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(325, 'HALOPERIDOL (como decanoato)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(326, 'HELIO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(327, 'HEPARINA SODICA 5000 UI/ml', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(328, 'HIDROCLOROTIAZIDA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(329, 'HIDROCORTISONA (como acetato) 1% CRM TOP 20g', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(330, 'HIDROCORTISONA (como succinato sódico)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(331, 'HIDROXICARBAMIDA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(332, 'HIDROXICLOROQUINA SULFATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(333, 'CODIGO HIDROXIPROPIL METILCELULOSA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(334, 'HIDROXOCOBALAMINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(335, 'HIERRO (como sacarato)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(336, 'HIERRO (como sulfato)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(337, 'Fe + 400', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(338, 'HIERRO (como sulfato) + ACIDO FOLICO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(339, 'HIPOCLORITO DE SODIO 10% SOL', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(340, 'HOMATROPINA METILBROMURO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(341, 'HORMONA DE CRECIMIENTO HUMANA RECOMBINANTE 10 UI', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(342, 'IBUPROFENO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(343, 'IFOSFAMIDA 1g', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(344, 'IMATINIB (como mesilato)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(346, 'IMIPENEM + CILASTATINA (como sal sódica)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(347, 'INFLIXIMAB', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(348, 'INMUNOGLOBULINA ANTI-D (Rho)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(349, 'INMUNOGLOBULINA CONTRA EL TETANOS', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(350, 'INMUNOGLOBULINA CONTRA LA HEPATITIS B', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(351, 'INMUNOGLOBULINA CONTRA LA RABIA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(352, 'INMUNOGLOBULINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(353, 'INMUNOGLOBULINA HUMANA 10%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(354, 'INSULINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(355, 'INSULINA CRISTALINA 100 UI/ml', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(356, 'INSULINA DE ACCION INTERMEDIA (NPH) 100 UI/ml', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(357, 'CODIGO INSULINA ISOFANA HUMANA (NPH) (ADN recombinante) 100 UI/ml', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(358, 'INTERFERON ALFA 2a 3\'000.000 UI', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(359, 'INTERFERON ALFA 2a 9\'000.000 UI', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(361, 'INTERFERON ALFA 2b', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(362, 'UI', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(363, 'INTERFERON BETA 1 b 0.3', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(364, 'INTERFERON BETA 1a 132 mcg/1.5ml', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(365, 'INTERFERON PEGILADO ALFA 2 a 180 mcg', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(366, 'INTERFERON PEGILADO ALFA 2 b 100 mcg', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(367, 'IOBITRIDOL', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(368, 'CODIGO IOBITRIDOL', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(369, 'IOPAMIDOL', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(370, 'IPRATROPIO BROMURO 20 mcg/dosis AER INH 200 DOSIS', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(371, 'IRINOTECAN CLORHIDRATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(372, 'ISOCONAZOL 1% CRM VAG', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(373, 'ISOCONAZOL', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(374, 'ISOFLURANO 99.9 - 100% LIQ INH', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(375, 'ISONIAZIDA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(376, 'ISONIAZIDA + TIOACETAZONA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(377, 'ISONITRILOS', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(378, 'ISOSORBIDA DINITRATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(379, 'ISOSORBIDA MONONITRATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(380, 'ISOTRETINOINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(381, 'ISOXSUPRINA CLORHIDRATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(382, 'ITRACONAZOL', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(383, 'IVERMECTINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(384, 'IXABEPILONA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(385, 'KETAMINA (como clorhidrato)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(386, 'KETOPROFENO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(387, 'LACTULOSA 3.33', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(388, 'LAMIVUDINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(390, 'LAMIVUDINA + NEVIRAPINA +ESTAVUDINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(391, 'LAMIVUDINA + ZIDOVUDINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(392, 'LAMIVUDINA + ZIDOVUDINA + NEVIRAPINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(393, 'LAMOTRIGINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(394, 'LANATOSIDO C', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(395, 'LATANOPROST 0.005% SOL OFT 2.5', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(396, 'LEFLUNOMIDA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(397, 'LENALIDOMIDA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(398, 'LETROZOL 2.5', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(399, 'LEUPRORELINA ACETATO 7,5', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(400, 'LEUPRORELINA ACETATO 11.25', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(401, 'LEVETIRACETAM', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(402, 'LEVODOPA + CARBIDOPA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(403, 'LEVOFLOXACINO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(404, 'LEVOMEPROMAZINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(405, 'LEVOMEPROMAZINA (como maleato)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(406, 'LEVONORGESTREL 750 mcg', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(408, 'LEVOTIROXINA SODICA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(409, 'LIDOCAINA 10% AER TOP', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(410, 'LIDOCAINA CLORHIDRATO 2-4%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(411, 'LIDOCAINA CLORHIDRATO SIN PRESERVANTE SIN EPINEFRINA 2%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(412, 'LIDOCAINA CLORHIDRATO + EPINEFRINA 2%+ 1:80,000', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(413, 'LIDOCAINA CLORHIDRATO +PRESERVANTE +EPINEFRINA 2% + 1:200,000', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(414, 'LIDOCAINA CLORHIDRATO SIN EPINEFRINA 2%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(415, 'LIDOCAINA CLORHIDRATO SIN PRESERVANTE + EPINEFRINA 2% + 1:200,000', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(416, 'LIDOCAINA CLORHIDRATO+ PRESERVANTE SIN EPINEFRINA 2%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(417, 'LINEZOLID', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(418, 'LIPIDOS INTRAVENOSOS 20%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(419, 'LITIO CARBONATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(420, 'LOPINAVIR + RITONAVIR', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(421, 'LOPINAVIR + RITONAVIR LIQ ORAL', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(422, 'LORATADINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(423, 'LOSARTAN POTASICO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(424, 'MACRO AGREGADOS DE ALBUMINA (MAA) - -', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(425, 'POTASIO CLORURO + SODIO CLORURO + SODIO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(426, 'PLV', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(427, 'O SIN SODIO SULFATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(428, 'MAGNESIO SULFATO 20%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(429, 'MANITOL 20%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(430, 'MARAVIROC', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(431, 'MEFLOQUINA (como clorhidato)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(432, 'MEGESTROL ACETATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(433, 'MEMANTINA CLORHIDRATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(434, 'MEPIVACAINA + EPINEFRINA 2% + 1:100,000', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(435, 'MEPIVACAINA SIN VASOCONSTRICTOR 3%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(436, 'MERCAPTOPURINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(437, 'MEROPENEM 1g', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(438, 'MESALAZINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(439, 'MESNA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(440, 'METAIODO BENCILGUANIDINA-I 131 - -', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(441, 'METAMIZOL 0.5', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(442, 'METAMIZOL SODICO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(443, 'METFORMINA CLORHIDRATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(444, 'METILDOPA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(445, 'METILEN DIFOSFONATO (MDP) - -', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(446, 'METILFENIDATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(447, 'METILPREDNISOLONA (como succinato sódico)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(448, 'METILPREDNISOLONA ACEPONATO 0.1% SOL', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(449, 'METILPREDNISOLONA ACEPONATO Emulsión 0.1% LOC', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(450, 'METOCLOPRAMIDA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(451, 'METOTREXATO (como sal sódica) 2.5', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(452, 'METOTREXATO (como sal sódica) con preservante', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(453, 'CODIGO METOTREXATO (como sal sódica) sin preservante', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(454, 'METOXIPOLIETILENGLICOL EPOETINA BETA 100 mcg', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(455, 'METRONIDAZOL', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(456, 'METRONIDAZOL (como benzoato)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(457, 'MICOFENOLATO MOFETILO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(458, 'MIDAZOLAM MALEATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(459, 'MIDAZOLAM (como chorhidrato)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(460, 'MILTEFOSINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(461, 'MIRTAZAPINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(462, 'MITOMICINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(463, 'MITOXANTRONA (como diclorhidrato)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(464, 'MOCLOBEMIDA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(465, 'MODULO PROTEICO DE PROTEINAS 75-95% PLV Kg', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(466, 'MOMETASONA FUROATO (sin alcohol) 50mcg SPR NAS', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(467, 'MORFINA CLORHIDRATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(468, 'MORFINA SULFATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(469, 'MOSAPRIDA CITRATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(470, 'MOXIFLOXACINO (como clorhidrato)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(471, 'MUPIROCINA (como mupirocina cálcica) 2% CRM TOP 15g', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(472, 'NAFAZOLINA CORHIDRATO 0.012% SOL OFT', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(473, 'NANOCOLOIDE SEROALBUMINA HUMANA 1.0', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(474, 'NAPROXENO (como sal sódica)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(475, 'NEOSTIGMINA METILSULFATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(476, 'NEVIRAPINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(477, 'NIFURTIMOX', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(478, 'NILOTINIB', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(479, 'NIMODIPINO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(480, 'NIMOTUZUMAB', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(481, 'NISTATINA 100,000 UI/ml LIQ ORAL', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(482, 'NITROFURAL 0.2% POM 35g', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(483, 'NITROFURAL 0.2% POM 500', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(484, 'NITROFURAL 0.2% SOL', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(485, 'NITROFURANTOINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(486, 'CODIGO NITROGENO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(487, 'NITROPRUSIATO SODICO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(488, 'NOREPINEFRINA (como tartrato ácido)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(489, 'NUTRIENTE ENTERAL HIPERTÓNICO POLIMÉRICO PLV Kg', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(490, 'HIPOALERGENICO CON PROTEINAS TOTALMENTE', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(491, 'CODIGO PLV Kg', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(492, 'NUTRIENTE ENTERAL ISOTÓNICO SOL L', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(493, 'NUTRIENTE ENTERAL PARA ENFERMEDAD OBSTRUCTIVA CRÓNICA SOL L', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(494, 'NUTRIENTE ENTERAL PARA INSUFICIENCIA RENAL EN DIÁLISIS SOL L', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(495, 'NUTRIENTE ENTERAL PARA INSUFICIENCIA RENAL PRE - DIÁLISIS SOL L', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(496, 'NUTRIENTE ENTERAL PARA PACIENTE DIABÉTICO PLV Kg', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(497, 'NUTRIENTE ENTERAL PEPTÍDICO SOL L', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(498, 'NUTRIENTE ENTERAL POLIMÉRICO PEDIÁTRICO SOL L', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(499, 'NUTRIENTE ENTERAL REFORZADO CON INMUNONUTRIENTE PLV Kg', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(500, 'OCTREOTIDA 0.2', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(501, 'OCTREOTIDA ACETATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(502, 'OCTREOTIDO - Tc 99m - -', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(503, 'OFLOXACINO 0.3% SOL OTI', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(504, 'OLANZAPINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(505, 'OLIGOELEMENTOS SOLUCION', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(506, 'OLOPATADINA CLORHIDRATO 0.2% SOL OFT', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(507, 'OMEPRAZOL', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(508, 'OMEPRAZOL (como sal sódica)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(509, 'ONDANSETRON (Como Clorhidrato)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(510, 'ORFENADRINA CITRATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(511, 'OXACILINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(512, 'OXACILINA 1g', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(513, 'OXALIPLATINO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(514, 'OXCARBAZEPINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(515, 'OXICODONA CLORHIDRATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(516, 'OXIGENO MEDICINAL 99 - 100%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(517, 'OXITOCINA 10 UI/ml', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(518, 'PACLITAXEL', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(519, 'PARACETAMOL', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(520, 'PARICALCITOL 2 mcg', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(521, 'PARICALCITOL 5 mcg/ml', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(522, 'PAZOPANIB', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(523, 'PEMETREXED', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(524, 'PENICILAMINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(525, 'PENICILINA CLEMIZOL 1\'000.000 UI', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(526, 'PENTOXIFILINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(527, 'PERMETRINA 5% CRM TOP 60g', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(528, 'PERMETRINA 1% LOC', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(529, 'PERTECNETATO DE SODIO (Tc-99 m) - -', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(530, 'PETIDINA CLORHIDRATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(531, 'PILOCARPINA CLORHIDRATO 2% SOL OFT 10 -', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(532, 'PINAVERIO BROMURO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(533, 'PIOGLITAZONA CLORHIDRATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(534, 'PIPERACILINA + TAZOBACTAM SODICO 4', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(535, 'PIRAZINAMIDA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(536, 'PIRIDOSTIGMINA BROMURO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(537, 'PIRIDOXINA CLORHIDRATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(538, 'PIRIMETAMINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(539, 'PIROFOSFATO (pPl) - -', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(540, 'POLIESTER MUCOPOLISACARIDO DEL ACIDO SULFURICO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(541, 'POLIGELINA C/S ELECTROLITOS 3.5%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(542, 'POTASIO CLORURO 14.9%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(543, 'POTASIO FOSFATO 15%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(544, 'PRAMIPEXOL', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(545, 'PRAZICUANTEL', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(546, 'PREDNISOLONA ACETATO 1% SUS OFT', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(547, 'PREDNISONA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(548, 'PRIMAQUINA (como fosfato) 7.5', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(549, 'PRIMAQUINA (como fosfato)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(550, 'PROGESTERONA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(551, 'PROPAFENONA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(552, 'PROPARACAINA 0.5% SOL OFT', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(553, 'PROPOFOL 1%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(554, 'PROPRANOLOL CLORHIDRATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(555, 'PROTAMINA SULFATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(556, 'QUETIAPINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(557, 'QUININA SULFATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(558, 'RALOXIFENO CLORHIDRATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(559, 'RALTEGRAVIR', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(560, 'RANIBIZUMAB', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(561, 'RANITIDINA (como clorhidrato)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(562, 'REMIFENTANILO CLORHIDRATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(563, 'RIFABUTINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(564, 'RIFAMPICINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(565, 'RINGER LACTATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(566, 'RISPERIDONA DE LIBERACION PROLONGADA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(567, 'RITONAVIR', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(568, 'RITUXIMAB', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(569, 'RIVAROXABAN', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(570, 'RIVASTIGMINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(571, 'ROCURONIO BROMURO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(572, 'RUXOLITINIB', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(573, 'SALBUTAMOL (como sulfato)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(574, 'SALBUTAMOL (como sulfato) 100 mcg/dosis AER INH 200 dosis', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(575, 'SALES DE REHIDRATACION ORAL 20.5', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(576, 'SAMARIO 153 (Solución EDTMP) - -', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(577, 'SERTRALINA (como clorhidrato)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(578, 'SEVELAMERO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(579, 'SEVOFLURANO 100% LIQ INH', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(580, 'CODIGO SIMEPREVIR', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(581, 'SIMETICONA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(582, 'SITAGLIPTINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(583, 'SODIO ACETATO 22%-30%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(584, 'SODIO BICARBONATO 8.4%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(585, 'SODIO CLORURO 0.9%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(586, 'SODIO CLORURO 20%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(587, 'CODIGO SOFOSBUVIR', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(588, 'SOLIFENACINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(589, 'SOLUCION CONCENTRADA PARA HEMODIALISIS (Acida) SOL DIA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(591, 'SOLUCIÓN CONCENTRADA PARA HEMODIÁLISIS CON BICARBONATO SOL DIA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(592, 'SORAFENIB', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(593, 'SUCCINILCOLINA CLORHIDRATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(594, 'SUCRALFATO 1', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(595, 'SUERO ANTIBOTROPICO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(596, 'SUERO ANTICROTALICO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(597, 'SUERO ANTILACHESICO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(598, 'SUERO ANTILOXOSCELICO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(599, 'SUERO ANTIOFIDICO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(600, 'SUERO ANTIRRABICO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(601, 'SULFACETAMIDA SODICA 10-15% SOL OFT', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(602, 'SULFADIAZINA DE PLATA 1% CRM TOP 400', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(603, 'SULFADIAZINA DE PLATA 1% CRM TOP 50', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(604, 'SULFADOXINA + PIRIMETAMINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(605, 'SULFAMETOXASOL + TRIMETOPRIMA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(606, 'SULFAMETOXAZOL+TRIMETOPRIMA LIQ ORAL', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(607, 'SULFAMETOXAZOL+TRIMETOPRIMA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(608, 'SULFASALAZINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(609, 'SULFURO COLOIDAL LIOFOLIZADO 200 ugr. -', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(610, 'SULPIRIDA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(611, 'SUNITINIB', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(612, 'SURFACTANTE PULMONAR SOL INTRAT', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(613, 'TACROLIMUS', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(614, 'TADALAFILO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(615, 'TALIDOMIDA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(616, 'TALIO 201 (Tl 201) - -', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(617, 'TAMOXIFENO (como citrato)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(619, 'TAMSULOSINA CLORHIDRATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(620, 'TEGAFUR + URACILO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(621, 'TEMOZOLOMIDA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(622, 'TENOFOVIR DISOPROXIL FUMARATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(623, 'TENOFOVIR DISOPROXIL FUMARATO + EMTRICITABINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(624, 'TETRACICLINA CLORHIDRATO 1%', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(625, 'TIAMAZOL', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(626, 'TIAMINA CLORHIDRATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(627, 'TICAGRELOR', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(628, 'TIGECICLINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(629, 'TIMOLOL (como maleato) 0.5% SOL OFT', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(630, 'TINIDAZOL', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(631, 'TIOPENTAL SODICO 1g', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(632, 'TIROTROPINA ALFA 0.9', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(633, 'TOBRAMICINA 0.3% SOL OFT', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(634, 'TOCILIZUMAB', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(635, 'TOLTERODINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(636, 'TOPIRAMATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(637, 'TOPOTECAN', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(638, 'TRAMADOL CLORHIDRATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(639, 'TRASTUZUMAB', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(640, 'TRETINOINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(641, 'TRIAMCINOLONA ACETONIDO 0.025% LOC', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(642, 'TRIAMCINOLONA ACETONIDO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(643, 'TRICLABENDAZOL', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(644, 'TRIPTORELINA 3.75', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(645, 'TROPICAMIDA 1% SOL OFT', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(646, 'VACUNA CONTRA LA POLIOMIELITIS (IPV)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(647, 'VACUNA ANTIRUBEOLA + ANTISARAMPIONOSA + ANTIPAROTIDITIS', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(648, 'VACUNA CONTRA EL HAEMOPHILUS INFLUENZAE tipo B (HIB)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(649, 'VACUNA CONTRA EL NEUMOCOCO (adulto)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(650, 'VACUNA CONTRA EL NEUMOCOCO (pediátrico)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(651, 'VACUNA CONTRA EL SARAMPION', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(652, 'VACUNA CONTRA EL TÉTANOS', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(653, 'VACUNA CONTRA EL VIRUS DE LA INFLUENZA HSUR (adulto)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(654, 'VACUNA CONTRA EL VIRUS DEL PAPILOMA HUMANO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(655, 'VACUNA CONTRA LA DIFTERIA (adulto)', '2025-04-22 13:49:26', '2025-04-22 13:49:26');
INSERT INTO `medicamentos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(656, 'VACUNA CONTRA LA DIFTERIA (pediátrico)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(657, 'VACUNA CONTRA LA FIEBRE AMARILLA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(658, 'VACUNA CONTRA LA HEPATITIS A (adulto)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(659, 'VACUNA CONTRA LA HEPATITIS A (pediátrico)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(660, 'VACUNA CONTRA LA HEPATITIS B (HVB adulto)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(661, 'VACUNA CONTRA LA HEPATITIS B (HVB pediátrico)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(662, 'VACUNA CONTRA LA PAROTIDITIS', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(663, 'VACUNA CONTRA LA POLIOMIELITIS (OPV) LIQ ORAL', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(664, 'VACUNA CONTRA LA RABIA (preparado en cerebro ratón lactante)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(665, 'VACUNA CONTRA LA RABIA INACTIVADA (preparado en cultivo celular)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(666, 'VACUNA CONTRA LA RUBEOLA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(667, 'VACUNA CONTRA LA TOS FERINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(668, 'VACUNA CONTRA LA TUBERCULOSIS (BCG)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(669, 'VACUNA CONTRA LA VARICELA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(670, 'VACUNA CONTRA LEPTOSPIRA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(671, 'VACUNA CONTRA MENINGOCOCO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(672, 'VACUNA INTRAVESICAL - NC 2-8 x 10^8 UFC', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(673, 'VALGANCICLOVIR', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(674, 'VALPROATO SODICO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(675, 'VANCOMICINA (como clorhidrato)', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(676, 'VECURONIO BROMURO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(677, 'VERAPAMILO CLORHIDRATO 2.5', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(678, 'VERAPAMILO CLORHIDRATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(679, 'VINBLASTINA SULFATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(680, 'VINCRISTINA SULFATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(681, 'VINORELBINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(682, 'VITAMINAS PARA NUTRIC. PARENT. ADULTOS', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(683, 'VITAMINAS PARA NUTRIC. PARENT. PEDIÁTRICA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(684, 'VORICONAZOL', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(685, 'WARFARINA SODICA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(686, 'YODO 131 (I-131) - -', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(687, 'YODO-POVIDONA 7 a 10% SOL TOP ESPUMA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(688, 'YODO-POVIDONA 7 a 10% SOL TOP SOLUCION', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(689, 'ZIDOVUDINA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(690, 'ZINC SULFATO (equiv', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(691, 'ZIPRASIDONA', '2025-04-22 13:49:26', '2025-04-22 13:49:26'),
(692, 'ZOLPIDEM TARTRATO', '2025-04-22 13:49:26', '2025-04-22 13:49:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos_recetas`
--

CREATE TABLE `medicamentos_recetas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `receta_id` bigint(20) UNSIGNED NOT NULL,
  `medicamento_id` bigint(20) UNSIGNED NOT NULL,
  `presentacion_medicamentos_id` bigint(20) UNSIGNED NOT NULL,
  `dosis` varchar(255) NOT NULL,
  `via_administracion_medicamentos_id` bigint(20) UNSIGNED NOT NULL,
  `intervalo_medicamentos_id` bigint(20) UNSIGNED NOT NULL,
  `duracion` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `medicamentos_recetas`
--

INSERT INTO `medicamentos_recetas` (`id`, `receta_id`, `medicamento_id`, `presentacion_medicamentos_id`, `dosis`, `via_administracion_medicamentos_id`, `intervalo_medicamentos_id`, `duracion`, `created_at`, `updated_at`) VALUES
(23, 15, 4, 1, '3', 2, 3, '3 semanas', '2025-06-23 12:57:16', '2025-06-23 12:57:16'),
(24, 15, 61, 7, '3', 10, 6, '4 semanas', '2025-06-23 12:57:30', '2025-06-23 12:57:30'),
(25, 16, 7, 2, '3', 2, 2, '7', '2025-07-01 10:22:32', '2025-07-01 10:22:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_pagos`
--

CREATE TABLE `metodos_pagos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `metodos_pagos`
--

INSERT INTO `metodos_pagos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Efectivo', NULL, NULL),
(2, 'Tarjeta', NULL, NULL),
(3, 'Transferencia', NULL, NULL),
(4, 'Bizum', '2025-06-25 16:27:21', '2025-06-25 16:27:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodo_pago_profesional`
--

CREATE TABLE `metodo_pago_profesional` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profesional_id` bigint(20) UNSIGNED NOT NULL,
  `metodo_pago_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `metodo_pago_profesional`
--

INSERT INTO `metodo_pago_profesional` (`id`, `profesional_id`, `metodo_pago_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(6, 3, 1, NULL, NULL),
(8, 4, 1, NULL, NULL),
(10, 6, 1, NULL, NULL),
(12, 7, 1, NULL, NULL),
(17, 9, 1, NULL, NULL),
(20, 10, 1, NULL, NULL),
(22, 11, 1, NULL, NULL),
(24, 19, 1, NULL, NULL),
(25, 19, 2, NULL, NULL),
(26, 19, 3, NULL, NULL),
(27, 19, 4, NULL, NULL),
(28, 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_03_17_170602_create_especialidads_table', 2),
(5, '2025_04_22_131221_create_intervalo_medicamentos_table', 3),
(6, '2025_04_22_131244_create_presentacion_medicamentos_table', 3),
(7, '2025_04_22_131306_create_via_administracion_medicamentos_table', 3),
(8, '2025_04_22_131318_create_medicamentos_table', 3),
(9, '2025_04_22_141849_create_seguros_medicos_table', 4),
(10, '2025_04_23_122502_add_role_to_users_table', 5),
(13, '2025_05_13_091820_create_pacientes_table', 6),
(14, '2025_05_13_091845_create_antecedentes_table', 6),
(15, '2025_05_13_092000_create_paciente_seguro_table', 6),
(16, '2025_05_13_092016_create_contactos_emergencia_table', 6),
(17, '2025_05_13_092042_create_documentos_table', 6),
(19, '2025_05_13_094529_create_profesionales_table', 7),
(20, '2025_05_13_094535_create_titulos_universitarios_table', 7),
(22, '2025_05_13_094546_create_formaciones_adicionales_table', 7),
(23, '2025_05_13_094551_create_experiencias_laborales_table', 7),
(24, '2025_05_13_094557_create_consultorios_table', 7),
(25, '2025_05_13_094602_create_profesional_seguro_table', 7),
(27, '2025_05_13_094614_create_documentos_profesional_table', 7),
(28, '2025_05_14_180534_create_planes_table', 8),
(29, '2025_05_14_180932_add_plan_id_to_profesionales_table', 9),
(30, '2025_05_14_181015_create_suscripciones_planes_table', 9),
(31, '2025_05_14_190326_create_valoraciones_table', 10),
(32, '2025_05_15_073458_create_contactos_admin_table', 11),
(33, '2025_05_15_075411_add_respuesta_to_contactos_admin_table', 12),
(34, '2025_05_15_084542_create_citas_table', 13),
(35, '2025_05_16_213958_create_informes_consultas_table', 14),
(36, '2025_05_28_141059_create_recetas_table', 15),
(37, '2025_05_28_143000_create_medicamento_recetas_table', 16),
(38, '2025_06_01_005139_create_categoria_profesionales_table', 17),
(39, '2025_06_03_194827_create_proveedores_table', 18),
(40, '2025_06_03_220542_create_preguntas_expertos_table', 19),
(41, '2025_06_03_221336_create_respuestas_expertos_table', 19),
(42, '2025_06_05_094540_create_especializaciones_table', 20),
(43, '2025_06_05_023529_create_regions_table', 21),
(44, '2025_06_05_023539_create_provincias_table', 21),
(45, '2025_06_05_023545_create_ciudads_table', 21),
(46, '2025_06_05_023901_add_ciudad_id_to_profesionales', 22),
(47, '2025_06_05_051613_add_presencial_videoconsulta_to_profesionales', 23),
(48, '2025_06_08_150400_create_metodos_pagos_table', 24),
(49, '2025_06_08_150502_create_metodo_pago_profesional_table', 25),
(50, '2025_06_08_153235_create_detalle_cita_table', 26),
(51, '2025_06_08_164612_create_horarios_table', 27),
(52, '2025_06_08_164649_create_detalle_horarios_table', 27),
(53, '2025_06_09_060707_add_precios_to_especializaciones_table', 28),
(54, '2025_06_09_060717_add_especializacion_id_to_citas_table', 28),
(55, '2025_06_19_093654_create_emergencias_table', 29),
(56, '2025_06_11_140059_create_consultorio_imagenes_table', 30),
(57, '2025_06_19_074124_add_activo_to_users_table', 31),
(58, '2025_06_24_171007_create_categorias_blog_table', 32),
(59, '2025_06_24_171015_create_articulos_blog_table', 32),
(60, '2025_06_24_171027_create_etiquetas_blog_table', 32),
(61, '2025_06_24_171035_create_articulo_etiqueta_table', 32),
(62, '2025_06_26_000001_create_horarios_videollamada_tables', 33);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `genero` enum('Masculino','Femenino','Otro') DEFAULT NULL,
  `estado_civil` varchar(255) DEFAULT NULL,
  `nacionalidad` varchar(255) DEFAULT NULL,
  `celular` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cedula` varchar(255) DEFAULT NULL,
  `grupo_sanguineo` varchar(255) DEFAULT NULL,
  `ciudad_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `foto`, `nombre_completo`, `fecha_nacimiento`, `genero`, `estado_civil`, `nacionalidad`, `celular`, `email`, `direccion`, `user_id`, `created_at`, `updated_at`, `cedula`, `grupo_sanguineo`, `ciudad_id`) VALUES
(1, 'imagenes/pacientes/1/1-1750323165.avif', 'Paciente', '1991-07-08', 'Masculino', 'Soltero', 'Cubana', '604389778', 'jperezzuferri@gmail.com', 'Avenida Blazco Ibañez, 72, Masanassa, Valencia', 1, NULL, '2025-07-01 09:41:55', '12345678X', 'A+', 30),
(2, 'URL Foto Paciente2', 'Paciente Dos', '1991-07-24', 'Femenino', 'Casado', 'Española', '644156914', 'paciente2@gmail.com', 'Avenida Maestro Aguilar, 27, Valencia', 4, NULL, NULL, '98765432B', NULL, NULL),
(4, NULL, 'Luisa García', NULL, 'Femenino', 'Casada', 'Ecuatoriana', '0925823900', 'luisa.garcia@prosalud.com', 'Alborada N74-69', 22, '2025-06-14 11:27:20', '2025-06-14 11:35:23', '283323409', NULL, NULL),
(5, NULL, 'Sofía Flores', '1985-06-05', 'Femenino', 'Casada', 'Ecuatoriana', '0967730956', 'sofia.flores@prosalud.com', 'Av. Amazonas N93-81', 23, '2025-06-14 18:17:42', '2025-06-14 18:27:08', '159270960', NULL, NULL),
(6, NULL, 'Luis Gómez', NULL, NULL, NULL, NULL, NULL, 'luis.gomez@prosalud.com', NULL, 29, '2025-06-15 09:23:32', '2025-06-15 09:23:32', NULL, NULL, NULL),
(7, NULL, 'Ana Córdova', '1993-06-15', 'Femenino', 'Soltera', 'Ecuatoriana', '0991253561', 'anaco@gmail.com', 'Avenida 10 de agosto N202-15 y Portugal', 30, '2025-06-15 15:31:45', '2025-06-27 13:54:05', '1025350004', NULL, NULL),
(8, NULL, 'Manuel Sánchez Aguirre', NULL, NULL, NULL, NULL, NULL, 'manuel.sanchez@prosalud.com', NULL, 34, '2025-06-25 16:39:32', '2025-06-25 16:39:32', NULL, NULL, NULL),
(9, NULL, 'Antonio González Marín', NULL, NULL, NULL, NULL, NULL, 'antonio.gonzalez@prosalud.com', NULL, 35, '2025-06-25 16:41:26', '2025-06-25 16:41:26', NULL, NULL, NULL),
(10, NULL, 'Juan Chamba Martínes', NULL, NULL, NULL, NULL, NULL, 'juan.chamba@prosalud.com', NULL, 37, '2025-06-25 17:02:22', '2025-06-25 17:02:22', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_seguro`
--

CREATE TABLE `paciente_seguro` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paciente_id` bigint(20) UNSIGNED NOT NULL,
  `seguro_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `paciente_seguro`
--

INSERT INTO `paciente_seguro` (`id`, `paciente_id`, `seguro_id`, `created_at`, `updated_at`) VALUES
(3, 2, 7, NULL, NULL),
(4, 4, 3, NULL, NULL),
(5, 4, 7, NULL, NULL),
(6, 5, 2, NULL, NULL),
(7, 5, 7, NULL, NULL),
(8, 5, 10, NULL, NULL),
(9, 7, 1, NULL, NULL),
(10, 7, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` decimal(8,2) NOT NULL,
  `caracteristicas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id`, `nombre`, `descripcion`, `precio`, `caracteristicas`, `created_at`, `updated_at`) VALUES
(1, 'Básico', 'Plan básico mensual', 45.00, '[\r\n    \"Plataforma web y App móvil\",\r\n    \"Perfil de usuario\",\r\n    \"Visibilidad online (Google, Facebook, Instagram)\",\r\n    \"Agenda para el paciente\",\r\n    \"Estadísticas\",\r\n    \"Sincronización con Google Calendar\",\r\n    \"5 Video consultas\",\r\n    \"Llamadas gratuitas a consultorio\",\r\n    \"50 mensajes de WhatsApp\",\r\n    \"Reseñas post cita\"\r\n]', '2025-05-14 18:08:33', '2025-06-25 17:04:50'),
(2, 'Avanzado', 'Plan avanzado mensual', 65.00, '[\r\n    \"Todo lo del Básico\",\r\n    \"Chat de pacientes\",\r\n    \"Panel de tareas\",\r\n    \"100 WhatsApp\",\r\n    \"Emails ilimitados\",\r\n    \"Usuario adicional\",\r\n    \"Google My Business\",\r\n    \"Consultorio adicional\"\r\n]', '2025-05-14 18:08:33', '2025-06-25 17:03:28'),
(3, 'Premium', 'Plan premium mensual', 80.00, '[\r\n    \"Todo lo del Avanzado\",\r\n    \"Diseño personalizado\",\r\n    \"Ranking ProSalud\",\r\n    \"Consultorios ilimitados\",\r\n    \"Historia clínica digital\",\r\n    \"Recetas digitales\",\r\n    \"Campañas SMS\",\r\n    \"Facturas electrónicas\"\r\n]', '2025-05-14 18:08:33', '2025-05-14 18:08:33'),
(5, 'Platinum', 'platimum', 150.00, '[\r\n\"Todo\"\r\n]', '2025-06-25 16:29:26', '2025-06-26 05:41:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_expertos`
--

CREATE TABLE `preguntas_expertos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `especialidad_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_especialidad_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pregunta` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `preguntas_expertos`
--

INSERT INTO `preguntas_expertos` (`id`, `especialidad_id`, `sub_especialidad_id`, `pregunta`, `created_at`, `updated_at`) VALUES
(7, 35, 472, 'Puedo tomar paracetamol de 1 gramo con alcohol?', '2025-06-23 13:28:16', '2025-06-23 13:28:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion_medicamentos`
--

CREATE TABLE `presentacion_medicamentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `presentacion_medicamentos`
--

INSERT INTO `presentacion_medicamentos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Comprimidos', NULL, NULL),
(2, 'Cápsulas', NULL, NULL),
(3, 'Jarabe', NULL, NULL),
(4, 'Suspensión oral', NULL, NULL),
(5, 'Gotas orales', NULL, NULL),
(6, 'Solución inyectable', NULL, NULL),
(7, 'Inyección intramuscular (IM)', NULL, NULL),
(8, 'Inyección intravenosa (IV)', NULL, NULL),
(9, 'Inyección subcutánea (SC)', NULL, NULL),
(10, 'Crema', NULL, NULL),
(11, 'Pomada', NULL, NULL),
(12, 'Gel', NULL, NULL),
(13, 'Loción', NULL, NULL),
(14, 'Solución oftálmica', NULL, NULL),
(15, 'Gotas óticas', NULL, NULL),
(16, 'Aerosol nasal', NULL, NULL),
(17, 'Inhalador', NULL, NULL),
(18, 'Supositorio', NULL, NULL),
(19, 'Óvulo', NULL, NULL),
(20, 'Parches transdérmicos', NULL, NULL),
(21, 'Tableta sublingual', NULL, NULL),
(22, 'Tableta masticable', NULL, NULL),
(23, 'Polvo para suspensión', NULL, NULL),
(24, 'Implante', NULL, NULL),
(25, 'Solución tópica', NULL, NULL),
(26, 'Espuma', NULL, NULL),
(27, 'Enema', NULL, NULL),
(28, 'Emulsión', NULL, NULL),
(29, 'Pastilla bucal', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesionales`
--

CREATE TABLE `profesionales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `genero` enum('Hombre','Mujer','Otro') DEFAULT NULL,
  `telefono_personal` varchar(255) DEFAULT NULL,
  `telefono_profesional` varchar(255) DEFAULT NULL,
  `cedula_identidad` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `idiomas` varchar(255) DEFAULT NULL,
  `descripcion_profesional` text DEFAULT NULL,
  `anios_experiencia` int(11) DEFAULT NULL,
  `licencia_medica` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `numero_cuenta` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `plan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `num_colegiado` varchar(255) DEFAULT NULL,
  `categoria_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ciudad_id` bigint(20) UNSIGNED DEFAULT NULL,
  `presencial` tinyint(1) NOT NULL DEFAULT 0,
  `videoconsulta` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `profesionales`
--

INSERT INTO `profesionales` (`id`, `nombre_completo`, `foto`, `logo`, `fecha_nacimiento`, `genero`, `telefono_personal`, `telefono_profesional`, `cedula_identidad`, `email`, `idiomas`, `descripcion_profesional`, `anios_experiencia`, `licencia_medica`, `user_id`, `numero_cuenta`, `created_at`, `updated_at`, `plan_id`, `num_colegiado`, `categoria_id`, `ciudad_id`, `presencial`, `videoconsulta`) VALUES
(1, 'Dr. Juan Pérez', 'imagenes/medicos/1/1-1749224851.jpg', 'imagenes/medicos/1/1-1749224851.webp', '1985-04-11', 'Hombre', '123456789', '987654321', 'CI1234567', 'profesional@prosalud.com', 'Español, Inglés', 'La doctora Teresa Riaño Avanzini es una destacada especialista en Alergología e Inmunología. Tras licenciarse en Medicina y Cirugía por la Universidad del País Vasco (UPV-EHU), se especializó vía M.I.R. en Alergología e Inmunología por el Hospital Universitario Ramón y Cajal de Madrid y amplió su formación en alergia alimentaria en niños mediante rotaciones externas en el Hospital Mount Sinai (Nueva York) y en el Hospital Sant Joan de Déu (Barcelona).\r\n\r\nConcretamente, la doctora es experta en rinoconjuntivitis alérgica, asma, alergia infantil, alergia a alimentos, urticaria, dermatitis atópica y alergia a medicamentos.\r\n\r\nTras completar su formación como alergóloga en el Hospital Ramón y Cajal inició su actividad en el Hospital de Basurto (Bilbao), ampliando extensamente su formación en asma grave. \r\n\r\nEn la actualidad compagina su actividad hospitalaria con la consulta de alergología privada, acumulando así una extensa trayectoria. Ejerce como especialista en Alergología en el Centro Médico IMQ las Mercedes (Getxo) y en el centro Medikosta Henao (Bilbao), ambos ubicados en Bizkaia.', 15, 'licencia_juan.pdf', 2, 'ES872100258714783698', '2025-05-13 14:59:52', '2025-06-21 05:59:27', 2, '159357456', 1, 19, 1, 1),
(3, 'Profesional Dos', 'imagenes/medicos/3/3-1749099253.jpg', 'imagenes/medicos/3/3-1749099253.avif', '1990-12-25', 'Hombre', '604389778', '644789456', '12345678X', 'profesional2@prosalud.com', 'Español, Alemán', 'Excelente médico profesional', 10, NULL, 6, 'es123454564684565465465', '2025-06-03 12:49:30', '2025-06-09 07:25:50', NULL, NULL, 3, 6, 1, 1),
(4, 'Diego Cuenca', 'imagenes/medicos/4/4-1749646965.jpeg', 'imagenes/medicos/4/4-1749646965.avif', '1991-04-12', 'Hombre', '987654321', '987123456', '12345678X', 'diego@prosalud.com', 'Alemán, Español', 'La doctora Teresa Riaño Avanzini es una destacada especialista en Alergología e Inmunología. Tras licenciarse en Medicina y Cirugía por la Universidad del País Vasco (UPV-EHU), se especializó vía M.I.R. en Alergología e Inmunología por el Hospital Universitario Ramón y Cajal de Madrid y amplió su formación en alergia alimentaria en niños mediante rotaciones externas en el Hospital Mount Sinai (Nueva York) y en el Hospital Sant Joan de Déu (Barcelona).', 15, NULL, 11, 'ES1221003698741258963214', '2025-06-09 14:30:57', '2025-06-11 11:02:45', NULL, '147852369', NULL, 6, 1, 1),
(5, 'José Suárez', 'imagenes/medicos/5/5-1751370678.jpg', 'imagenes/medicos/5/5-1751370678.avif', '1981-02-25', 'Hombre', '0993790028', NULL, '0700783622', 'josesuarez@prosalud.com', 'Castellano, Inglés', 'Profesional con más de 15 años de graduado. Especialista en Medcina Interna y Cardiología', 15, NULL, 12, NULL, '2025-06-09 19:46:03', '2025-07-01 09:52:52', 2, NULL, NULL, 1, 1, 1),
(6, 'Andres Cabello', 'imagenes/medicos/6/6-1749829233.avif', 'imagenes/medicos/6/6-1749829245.avif', '1990-06-20', 'Hombre', '2858462', '0994562642', '1125636225', 'andres@prosalud.com', 'ESPAÑOL, ALEMAN, INGLES', 'El Doctor Andrés Cabello es especialista en Ginecología y Obstetricia y Colposcopista. Cuenta con más de 20 años de experiencia en el tratamiento de infecciones Vaginales, climaterio y menopausia, endocrinología ginecológica, cirugía ginecológica, entre otros. El doctor ofrece consulta presencial en Guayaquil y teleconsulta.', 6, '1028-04-519453', 14, '35245625571', '2025-06-10 13:37:48', '2025-06-13 13:40:45', NULL, NULL, NULL, 6, 1, 1),
(7, 'DRA  MARIA VILLA', 'imagenes/medicos/7/7-1749660403.jpg', 'imagenes/medicos/7/7-1749660412.jpg', '1987-02-05', 'Mujer', '2858463', '0994562841', '1125636222', 'maria@prosalud.com', 'ESPAÑOL, ALEMAN, INGLES, FRANCES', 'Especializada en dermatología oncológica, estética, dermatoscopía y tricología.\r\n\r\nBrindo atención integral para el cuidado de la piel, el cabello y las uñas, combinando ciencia, tecnología y experiencia para lograr resultados naturales y seguros.\r\n\r\nMe enfoco en detectar y tratar enfermedades cutáneas, acompañar en la prevención del cáncer de piel, y guiarte en el abordaje de afecciones como el acné, la rosácea, la caída capilar o el envejecimiento cutáneo.', 10, '1028-04-479453', 15, NULL, '2025-06-10 16:23:23', '2025-06-11 14:46:52', NULL, NULL, NULL, 6, 1, 0),
(8, 'DRA CAMILA CARRERA', 'imagenes/medicos/8/8-1749828676.png', 'imagenes/medicos/8/8-1749582204.png', NULL, NULL, '0959782165', '0959782165', '1125636220', 'camilac@prosalud.com', 'ESPAÑOL, INGLES', 'La doctora Camila Carrera es Gastroenteróloga subespecialista en trastornos esofágicos complejos. Realiza procedimientos endoscópicos diagnósticos y terapeúticos mediante endoscopia y colonoscopia. Tiene un entrenamiento especial en procedimientos de fisiología digestiva, como son la manometría esofágica y anorectal de alta resolución, así como pH-metría mas impedancia. Cuenta con mas de 12 años de experiencia en su área. Ofrece teleconsulta y consulta presencial en Quito, ya sea en idioma inglés o español.', 15, '1038-2016-1725844', 16, NULL, '2025-06-10 17:01:13', '2025-06-13 13:31:16', NULL, NULL, NULL, 15, 1, 1),
(9, 'DR PACO CASTRO', 'imagenes/medicos/9/9-1749659881.png', 'imagenes/medicos/9/9-1749659901.png', '1958-03-02', 'Hombre', '0959770065', '0959770000', '1125636221', 'pacoc@prosalud.com', 'ESPAÑOL, INGLES', 'El doctor Paco Castro es Cardiólogo especialista en Electrofisiología y Arritmias. Ha realizado diversos estudios en Ecuador, Colombia, España y Francia. Ofrece consulta presencial en Quito y teleconsulta para el Diagnóstico y tratamiento de arritmias cardíacas, Implante y seguimiento de marcapasos y Resincronizadores.', 20, '1038-1016-1255844', 17, '2656002251', '2025-06-10 23:06:13', '2025-06-11 14:38:21', NULL, NULL, NULL, 15, 1, 0),
(10, 'DRA CARLA PIEDRA', 'imagenes/medicos/10/10-1749828779.png', 'imagenes/medicos/10/10-1749606075.png', '1970-12-05', 'Mujer', '0989700165', '0989700105', '1125636223', 'carlapi@prosalud.com', 'ESPAÑOL, ALEMAN, INGLES, FRANCES', 'La doctora Carla Piedra Núñez es Neurocirujana formada en la Universidad San Francisco de Quito, brinda atención presencial en Cuenca y videoconsulta. Ha participado en hospitales nacionales e internacionales, y su formación profesional se ha complementado en el HDLV en Quito, en el HCAM, en el Hospital Eugenio Espejo, Hospital Baca Ortiz y una rotación en la Universidad de Utah (EEUU) en base de cráneo y cirugía endovascular.', 18, '1028-2004-519453', 18, NULL, '2025-06-10 23:33:43', '2025-06-13 13:32:59', NULL, NULL, NULL, 24, 1, 1),
(11, 'DR CARLOS PEREZ', 'imagenes/medicos/11/11-1749829179.png', 'imagenes/medicos/11/11-1749607872.png', '1976-11-25', 'Hombre', '0964782162', '0998782162', '1125636224', 'carlospe@prosalud.com', 'ESPAÑOL, INGLES', 'El Pediatra Carlos Pérez tiene su formación académica sobresaliente, el doctor tiene experiencia en su área de especialidad. El Dr. tiene numerosos años de experiencia laboral en su área de especialización. Al igual, él se ha desempeñado como miembro de diversas asociaciones médicas. Carlos Pérez ha formado parte en innumerables conferencias con la intención de lograr tener una formación continua en su ámbito de especialización y ha difundido importantes ediciones.', 14, '1028-2004-511223', 19, '2900002541', '2025-06-11 00:06:08', '2025-06-13 13:39:39', NULL, NULL, NULL, 24, 1, 0),
(12, 'Jorge Morales', 'imagenes/medicos/12/12-1749656790.jpg', 'imagenes/medicos/12/12-1749656776.jpg', '1987-02-12', 'Hombre', '0996520105', NULL, '157038086', 'jorge.morales@prosalud.com', 'Español, Inglés', 'Datos profesionales:\r\n\r\nEspecialidad: Cardiología Clínica\r\nNúmero de colegiatura: CMP-EC-15847\r\nUniversidad de formación: Universidad Central del Ecuador\r\nPosgrado: Especialización en Cardiología, Pontificia Universidad Católica del Ecuador (PUCE)\r\nCertificaciones adicionales:\r\nACLS (Advanced Cardiac Life Support)\r\nCurso de Ecocardiografía Doppler Avanzada\r\nExperiencia laboral:\r\n\r\nHospital Metropolitano de Quito\r\nCardiólogo tratante (2018 - Actualidad)\r\nDiagnóstico y manejo de enfermedades cardiovasculares, coordinación de programas de prevención y rehabilitación cardíaca.\r\nClínica Santa María – Guayaquil\r\nResidente de cardiología (2015 - 2018)\r\nAtención a pacientes en unidad coronaria, realización de electrocardiogramas, pruebas de esfuerzo y ecocardiogramas.\r\nHabilidades técnicas:\r\n\r\nInterpretación de electrocardiogramas y pruebas de esfuerzo\r\nManejo de insuficiencia cardíaca y arritmias\r\nRealización de ecocardiografía Doppler\r\nAtención en unidad de cuidados intensivos cardiológicos\r\nIdiomas: Español (nativo), Inglés (avanzado)', 15, NULL, 20, '2374722874980932', '2025-06-11 13:36:34', '2025-06-11 13:58:36', 1, NULL, NULL, 15, 1, 1),
(13, 'Paula López', NULL, NULL, NULL, NULL, '0982189229', NULL, '226880149', 'paula.lopez@prosalud.com', NULL, NULL, NULL, NULL, 21, NULL, '2025-06-14 08:07:17', '2025-06-14 08:07:17', NULL, NULL, NULL, NULL, 0, 0),
(14, 'Sofía García', NULL, NULL, NULL, NULL, '0998021503', NULL, '209052438', 'sofia.garcia@prosalud.com', NULL, NULL, NULL, NULL, 24, NULL, '2025-06-14 20:54:43', '2025-06-14 20:54:43', NULL, NULL, NULL, NULL, 0, 0),
(15, 'Roberto López', NULL, NULL, NULL, NULL, '0978100474', NULL, '219578260', 'roberto.lopez@prosalud.com', NULL, NULL, NULL, NULL, 25, NULL, '2025-06-14 20:59:51', '2025-06-14 20:59:51', NULL, NULL, NULL, NULL, 0, 0),
(16, 'Elena Castillo', NULL, NULL, NULL, NULL, '0990795101', NULL, '114604181', 'elena.castillo@prosalud.com', NULL, NULL, NULL, NULL, 26, NULL, '2025-06-14 21:05:04', '2025-06-14 21:05:04', NULL, NULL, NULL, NULL, 0, 0),
(17, 'Manuel Manuel', NULL, NULL, NULL, NULL, '0998745623', NULL, '123456789', 'manuel.manuel@prosalud.com', NULL, NULL, NULL, NULL, 31, NULL, '2025-06-18 17:17:52', '2025-06-18 17:17:52', NULL, NULL, NULL, NULL, 0, 0),
(18, 'jose jose', NULL, NULL, NULL, NULL, '0789563241', NULL, '123456789', 'jose.jose@prosalud.com', NULL, NULL, NULL, NULL, 32, NULL, '2025-06-18 17:19:20', '2025-06-18 17:19:20', NULL, NULL, NULL, NULL, 0, 0),
(19, 'Pedro Vélez Gómez', 'imagenes/medicos/19/19-1750877962.jpg', 'imagenes/medicos/19/19-1750877962.avif', '1976-07-13', 'Hombre', '0988746532', NULL, '0700873622', 'pedro.velez@prosalud.com', 'Español, Inglés', 'Oncologo especializado en cáncer de pulmón', 15, 'Médico oncólogo', 36, NULL, '2025-06-25 16:46:48', '2025-06-25 16:59:22', NULL, NULL, NULL, 15, 1, 1),
(20, 'David Morales Ludeña', NULL, NULL, NULL, NULL, '09987462633', NULL, '11048374623', 'david.morales@prosalud.com', NULL, NULL, NULL, NULL, 38, NULL, '2025-06-25 17:05:02', '2025-06-25 17:05:02', NULL, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesional_seguro`
--

CREATE TABLE `profesional_seguro` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profesional_id` bigint(20) UNSIGNED NOT NULL,
  `seguro_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `profesional_seguro`
--

INSERT INTO `profesional_seguro` (`id`, `profesional_id`, `seguro_id`, `created_at`, `updated_at`) VALUES
(11, 1, 7, NULL, NULL),
(14, 3, 6, NULL, NULL),
(20, 3, 1, NULL, NULL),
(21, 1, 6, NULL, NULL),
(27, 4, 6, NULL, NULL),
(28, 4, 7, NULL, NULL),
(30, 6, 1, NULL, NULL),
(31, 6, 4, NULL, NULL),
(32, 6, 18, NULL, NULL),
(33, 7, 14, NULL, NULL),
(34, 7, 21, NULL, NULL),
(35, 7, 9, NULL, NULL),
(36, 8, 4, NULL, NULL),
(37, 8, 9, NULL, NULL),
(38, 8, 6, NULL, NULL),
(39, 9, 1, NULL, NULL),
(40, 9, 6, NULL, NULL),
(41, 9, 7, NULL, NULL),
(42, 9, 10, NULL, NULL),
(43, 9, 14, NULL, NULL),
(44, 9, 20, NULL, NULL),
(45, 10, 3, NULL, NULL),
(46, 10, 7, NULL, NULL),
(47, 10, 4, NULL, NULL),
(48, 11, 1, NULL, NULL),
(49, 11, 6, NULL, NULL),
(50, 12, 1, NULL, NULL),
(51, 12, 4, NULL, NULL),
(52, 12, 18, NULL, NULL),
(53, 19, 1, NULL, NULL),
(54, 19, 4, NULL, NULL),
(55, 19, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tipo` enum('farmacia','laboratorio','centro_imagenes') NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `numero_identificacion` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `user_id`, `tipo`, `nombre`, `ciudad`, `direccion`, `numero_identificacion`, `email`, `telefono`, `created_at`, `updated_at`) VALUES
(1, 7, 'farmacia', 'FarmaValencia', 'Valencia', 'Maestro Aguilar 28, Valencia', '123456987M', 'proveedor2@prosalud.com', '987654321', '2025-06-03 18:11:29', '2025-06-03 18:11:29'),
(2, 39, 'farmacia', 'Santa Marianita', 'Riobamba', 'Sucre 14-54 y Amazonas', '11038475638', 'farmaciasantamarianita@prosalud.com', '09887382879', '2025-06-25 17:32:14', '2025-06-25 17:32:14'),
(3, 40, 'farmacia', 'Farmacia San Camilo', 'Cuenca', 'Av. Amazonas N93-81', '1108473627', 'farmaciasancamilo@prosalud.com', '0998573652', '2025-06-25 17:36:32', '2025-06-25 17:36:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `region_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id`, `region_id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 1, 'Esmeraldas', '2025-06-05 02:37:39', '2025-06-05 02:37:39'),
(2, 1, 'Manabí', '2025-06-05 02:37:39', '2025-06-05 02:37:39'),
(3, 1, 'Santo Domingo', '2025-06-05 02:37:39', '2025-06-05 02:37:39'),
(4, 1, 'Los Ríos', '2025-06-05 02:37:39', '2025-06-05 02:37:39'),
(5, 1, 'Santa Elena', '2025-06-05 02:37:39', '2025-06-05 02:37:39'),
(6, 1, 'Guayas', '2025-06-05 02:37:39', '2025-06-05 02:37:39'),
(7, 1, 'El Oro', '2025-06-05 02:37:39', '2025-06-05 02:37:39'),
(8, 2, 'Carchi', '2025-06-05 02:37:39', '2025-06-05 02:37:39'),
(9, 2, 'Imbabura', '2025-06-05 02:37:39', '2025-06-05 02:37:39'),
(10, 2, 'Pichincha', '2025-06-05 02:37:39', '2025-06-05 02:37:39'),
(11, 2, 'Cotopaxi', '2025-06-05 02:37:39', '2025-06-05 02:37:39'),
(12, 2, 'Tungurahua', '2025-06-05 02:37:39', '2025-06-05 02:37:39'),
(13, 2, 'Chimborazo', '2025-06-05 02:37:39', '2025-06-05 02:37:39'),
(14, 2, 'Bolívar', '2025-06-05 02:37:39', '2025-06-05 02:37:39'),
(15, 2, 'Cañar', '2025-06-05 02:37:39', '2025-06-05 02:37:39'),
(16, 2, 'Azuay', '2025-06-05 02:37:39', '2025-06-05 02:37:39'),
(17, 2, 'Loja', '2025-06-05 02:37:39', '2025-06-05 02:37:39'),
(18, 3, 'Sucumbíos', '2025-06-05 02:37:39', '2025-06-05 02:37:39'),
(19, 3, 'Napo', '2025-06-05 02:37:39', '2025-06-05 02:37:39'),
(20, 3, 'Orellana', '2025-06-05 02:37:39', '2025-06-05 02:37:39'),
(21, 3, 'Pastaza', '2025-06-05 02:37:39', '2025-06-05 02:37:39'),
(22, 3, 'Morona Santiago', '2025-06-05 02:37:39', '2025-06-05 02:37:39'),
(23, 3, 'Zamora Chinchipe', '2025-06-05 02:37:39', '2025-06-05 02:37:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `informe_consulta_id` bigint(20) UNSIGNED NOT NULL,
  `qr` varchar(255) DEFAULT NULL,
  `fecha_emision` datetime NOT NULL,
  `diagnostico` text DEFAULT NULL,
  `comentarios` text DEFAULT NULL,
  `ruta_firma` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`id`, `informe_consulta_id`, `qr`, `fecha_emision`, `diagnostico`, `comentarios`, `ruta_firma`, `created_at`, `updated_at`) VALUES
(15, 16, 'MD3RPYJK', '2025-06-24 14:56:55', 'dasdas', 'xzczxcx', NULL, '2025-06-23 12:56:55', '2025-06-23 12:57:00'),
(16, 17, 'JCHJNDKO', '2025-07-01 12:22:14', 'XX', 'BB', NULL, '2025-07-01 10:22:14', '2025-07-01 10:22:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regiones`
--

CREATE TABLE `regiones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `regiones`
--

INSERT INTO `regiones` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Costa', '2025-06-05 02:37:23', '2025-06-05 02:37:23'),
(2, 'Sierra', '2025-06-05 02:37:23', '2025-06-05 02:37:23'),
(3, 'Oriente', '2025-06-05 02:37:23', '2025-06-05 02:37:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_expertos`
--

CREATE TABLE `respuestas_expertos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `preguntas_expertos_id` bigint(20) UNSIGNED DEFAULT NULL,
  `respuesta` text NOT NULL,
  `profesional_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `respuestas_expertos`
--

INSERT INTO `respuestas_expertos` (`id`, `preguntas_expertos_id`, `respuesta`, `profesional_id`, `created_at`, `updated_at`) VALUES
(6, 7, 'No es práctico, pero deberías medicarte', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguros_medicos`
--

CREATE TABLE `seguros_medicos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `seguros_medicos`
--

INSERT INTO `seguros_medicos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'ASISKEN ASISTENCIA MEDICA S.A.', NULL, NULL),
(2, 'BEST DOCTORS S.A. EMPRESA DE MEDICINA PREPAGADA', NULL, NULL),
(3, 'BLUECARD ECUADOR S.A', NULL, NULL),
(4, 'BMI IGUALAS MEDICAS DEL ECUADOR S.A.', NULL, NULL),
(5, 'COMPAÑIA DE MEDICINA PREPAGADA INMEDICAL MEDICINA INTERNACIONAL S.A.', NULL, NULL),
(6, 'CONFIAMED S.A.', NULL, NULL),
(7, 'ECUASANITAS SA', NULL, NULL),
(9, 'MED-EC S.A', NULL, NULL),
(10, 'MEDIECUADOR-HUMANA S.A.', NULL, NULL),
(11, 'MEDICINA PREPAGADA CRUZBLANCA S.A.', NULL, NULL),
(12, 'MEDICOMPANIES C.A.', NULL, NULL),
(13, 'MEDIKEN MEDICINA INTEGRAL KENNEDY SA', NULL, NULL),
(14, 'PLAN VITAL VITALPLAN S.A.', NULL, NULL),
(15, 'PLUS MEDICAL SERVICES S.A. ECUATORIANA DE MEDICINA PREPAGADA', NULL, NULL),
(16, 'PRIMEPRE S.A', NULL, NULL),
(17, 'PROASSISLIFE S.A.', NULL, NULL),
(18, 'SALUDSA SISTEMA DE MEDICINA PRE-PAGADA DEL ECUADOR S.A.', NULL, NULL),
(19, 'SISTEMA DE MEDICINA PREPAGADA DEL ECUADOR VIDASANA S.A.', NULL, NULL),
(20, 'TRANSMEDICAL HEALTH SYSTEMS S.A.', NULL, NULL),
(21, 'VUMILATINA MEDICINA PREPAGADA S.A.', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('OKOGKG1un5xIpgzqc0S3XkpyVi5SuQswtaUTFrTg', 2, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaFpvZUdON2wwaGdtdG93VTBuWFVaTHVPREZrOWZtdUlNQ0VrbGRvViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9mZXNpb25hbC9jaXRhL2luZm9ybWUtY29uc3VsdGEvMTcvcmVjZXRhIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NTEzNzE3NjA7fX0=', 1751372552),
('uaRe47DwYROzwCSheh2CjNbO480RpqNGH6UjTcXl', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:109.0) Gecko/20100101 Firefox/115.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibGJBenZ3NTBqR1ZzbG8xemRQRUdRWldJcGljUWJDTVVkWWg4RHdCbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9mZXNpb25hbGVzL3JlZ2lzdHJvIjt9fQ==', 1751372978);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripciones_planes`
--

CREATE TABLE `suscripciones_planes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profesional_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pagado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `suscripciones_planes`
--

INSERT INTO `suscripciones_planes` (`id`, `profesional_id`, `plan_id`, `fecha_inicio`, `fecha_fin`, `created_at`, `updated_at`, `pagado`) VALUES
(4, 1, 3, '2025-05-19', '2025-06-18', '2025-05-19 14:38:06', '2025-05-19 14:38:06', 0),
(5, 12, 1, '2025-06-11', '2025-07-11', '2025-06-11 13:58:36', '2025-06-11 13:58:36', 0),
(6, 1, 2, '2025-06-21', '2025-07-21', '2025-06-21 05:59:27', '2025-06-26 10:16:33', 1),
(7, 5, 2, '2025-07-01', '2025-07-31', '2025-07-01 09:52:52', '2025-07-01 09:52:52', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulos_universitarios`
--

CREATE TABLE `titulos_universitarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profesional_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `centro_educativo` varchar(255) NOT NULL,
  `pais` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `titulos_universitarios`
--

INSERT INTO `titulos_universitarios` (`id`, `profesional_id`, `nombre`, `centro_educativo`, `pais`, `created_at`, `updated_at`) VALUES
(1, 1, 'Licenciatura en Medicina', 'Universidad Mayor de San Andrés', 'Bolivia', '2025-05-13 15:14:56', '2025-05-13 15:14:56'),
(3, 1, 'Maestría en Salud Pública', 'Universidad de Harvard', 'Estados Unidos', '2025-05-13 15:14:56', '2025-05-13 15:14:56'),
(4, 1, 'Diplomado en Terapia Intensiva', 'Universidad de Chile', 'Chile', '2025-05-13 15:14:56', '2025-05-13 15:14:56'),
(14, 1, 'Ingeniero Informático', 'CUJAE', 'Cuba', '2025-05-29 21:09:51', '2025-05-29 21:09:51'),
(15, 3, 'Ingeniero Informático', 'Escuela LAtinoamericana de Medicina La Habana', 'BB', '2025-06-06 13:50:27', '2025-06-06 13:50:27'),
(16, 4, 'Médico General', 'Universdidad de Guayquil', 'Ecuador', '2025-06-09 14:41:50', '2025-06-09 14:41:50'),
(17, 6, 'MEDICO GINECOLOGO', 'UNIVERSIDAD CATOLICA GUAYAQUIL', 'ECUADOR', '2025-06-10 15:21:35', '2025-06-10 15:21:35'),
(18, 7, 'MEDICA DERMATÓLOGA', 'UNIVERSIDAD CATOLICA QUITO', 'ECUADOR', '2025-06-10 16:32:13', '2025-06-10 16:32:13'),
(19, 8, 'MEDICA GASTROENTEROLOGA', 'Universidad San Francisco de Quito', 'ECUADOR', '2025-06-10 17:09:16', '2025-06-10 17:09:16'),
(20, 8, 'MEDICA CIRUJANA', 'Pontificia Universidad Católica del Ecuador', 'ECUADOR', '2025-06-10 17:10:16', '2025-06-10 17:10:16'),
(21, 9, 'MEDICO CIRUJANO GENERAL', 'Fundación Universitaria Juan N. Corpas', 'COLOMBIA', '2025-06-10 23:12:46', '2025-06-10 23:12:46'),
(22, 10, 'MEDICO CIRUJANO', 'Universidad Católica de Cuenca', 'ECUADOR', '2025-06-10 23:42:45', '2025-06-10 23:42:45'),
(23, 11, 'MEDICO GENERAL', 'UNIVERSIDAD CATOLICA QUITO', 'ECUADOR', '2025-06-11 00:12:19', '2025-06-11 00:12:19'),
(24, 12, 'Título de médico', 'Universidad central del Ecuador', 'Ecuador', '2025-06-11 13:43:44', '2025-06-11 13:43:44'),
(25, 19, 'Meédico General', 'Universidad de las Américas', 'Ecuador', '2025-06-25 16:52:31', '2025-06-25 16:52:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','paciente','profesional','proveedor') NOT NULL DEFAULT 'paciente',
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `activo`) VALUES
(1, 'Paciente', 'jperezzuferri@gmail.com', NULL, '$2y$12$G0DOWDpMpF2pJzwxP2zIxulqzaLisVjeSOvRes1BHBGOo5QLck5Em', '1uEZXtpHziTGLToy51OU0pSYhLUwMjDWcP00qk30zvuBR8QRwmJWaImbi1An', '2025-03-17 15:58:18', '2025-07-01 09:42:16', 'paciente', 1),
(2, 'Profesional', 'profesional@prosalud.com', NULL, '$2y$12$G0DOWDpMpF2pJzwxP2zIxulqzaLisVjeSOvRes1BHBGOo5QLck5Em', NULL, '2025-03-17 15:58:18', '2025-05-29 20:42:12', 'profesional', 1),
(3, 'Proveedor', 'proveedor@prosalud.com', NULL, '$2y$12$4G6kU0H9CAqhd/O57xaZP.KWW67g7FOwWf/FYajDreFn6Et6P0V/G', NULL, '2025-03-17 15:58:18', '2025-03-17 15:58:18', 'proveedor', 1),
(4, 'Paciente2', 'paciente2@prosalud.com', NULL, '$2y$12$4G6kU0H9CAqhd/O57xaZP.KWW67g7FOwWf/FYajDreFn6Et6P0V/G', NULL, '2025-03-17 15:58:18', '2025-03-17 15:58:18', 'paciente', 1),
(6, 'Profesional Dos', 'profesional2@prosalud.com', NULL, '$2y$12$G0DOWDpMpF2pJzwxP2zIxulqzaLisVjeSOvRes1BHBGOo5QLck5Em', NULL, '2025-06-03 12:49:30', '2025-06-03 12:49:30', 'profesional', 1),
(7, 'FarmaValencia', 'proveedor2@prosalud.com', NULL, '$2y$12$BxA0YHbqOUUwpo/f6hc5b.xILtegwp2hfp5fGkMG.wRHZmZDnuVGi', NULL, '2025-06-03 18:11:29', '2025-06-03 18:11:29', 'proveedor', 1),
(10, 'Pedro', 'paciente3@prosalud.com', NULL, '$2y$12$rrJFfAuMaAlxRBXCO69SO.22lifgZkTK8iGFGKlJEVcb6rnOwHBLu', NULL, '2025-06-03 19:47:29', '2025-06-03 19:47:29', 'paciente', 1),
(11, 'Diego Cuenca', 'diego@prosalud.com', NULL, '$2y$12$FFlfEn1RSK.EePsWTIbIme09tsbImMtUuaPcY2ZbYcEYQvGZlms/O', NULL, '2025-06-09 14:30:57', '2025-06-09 14:30:57', 'profesional', 1),
(12, 'José Suárez', 'josesuarez@prosalud.com', NULL, '$2y$12$G0DOWDpMpF2pJzwxP2zIxulqzaLisVjeSOvRes1BHBGOo5QLck5Em', NULL, '2025-06-09 19:46:03', '2025-06-09 19:46:03', 'profesional', 1),
(14, 'Andres Cabello', 'andres@prosalud.com', NULL, '$2y$12$Ncdalw77XhzhsLGdlhoQDuDab8WuZRVKKvmhgMcjoMTClvvicZPnC', NULL, '2025-06-10 13:37:48', '2025-06-10 13:37:48', 'profesional', 1),
(15, 'DRA  MARIA VILLA', 'maria@prosalud.com', NULL, '$2y$12$oi7gAcAp.PhXpsSqEInUgeRpmV9fti1dfvF05d0wT2SzMfUWHb4vi', NULL, '2025-06-10 16:23:23', '2025-06-10 16:23:23', 'profesional', 1),
(16, 'DRA CAMILA CARRERA', 'camilac@prosalud.com', NULL, '$2y$12$2T1eAYNBnWkt/p1VJiqp5ucQdhirGx22z06eSuMnpUxheXoAFJZmm', NULL, '2025-06-10 17:01:13', '2025-06-10 17:01:13', 'profesional', 1),
(17, 'DR PACO CASTRO', 'pacoc@prosalud.com', NULL, '$2y$12$/b0T4RgOwyLfej3YVIk6X..zC8Ho.7uxVi6RTwknzkM5n.RWjHbfu', NULL, '2025-06-10 23:06:13', '2025-06-10 23:06:13', 'profesional', 1),
(18, 'DRA CARLA PIEDRA', 'carlapi@prosalud.com', NULL, '$2y$12$5Gbe/oFaoHVT0LC9EdvPgOyJLvmI3c8wm1kDLKbRVCXsKKTNaRIj.', NULL, '2025-06-10 23:33:43', '2025-06-10 23:33:43', 'profesional', 1),
(19, 'DR CARLOS PEREZ', 'carlospe@prosalud.com', NULL, '$2y$12$2jAbVimNhrywLwa0AMBjQ.qhz5wP61EnqIUIyXkBiKGLL7CuXpsKy', NULL, '2025-06-11 00:06:08', '2025-06-11 00:06:08', 'profesional', 1),
(20, 'Jorge Morales', 'jorge.morales@prosalud.com', NULL, '$2y$12$ynuHeI4F4MbbcHS.zbJn4Oihtow/9u9lfX2WDTn4.kELTCQJ87IFm', NULL, '2025-06-11 13:36:34', '2025-06-11 13:36:34', 'profesional', 1),
(21, 'Paula López', 'paula.lopez@prosalud.com', NULL, '$2y$12$zzE/Fk1dGD.arsR3vVF/ZO/LQYq0Om3fII40c1.rZsKSGLQ2Azhc.', NULL, '2025-06-14 08:07:17', '2025-06-14 08:07:17', 'profesional', 1),
(22, 'Luisa García', 'luisa.garcia@prosalud.com', NULL, '$2y$12$WpCU2DlrfJjbLJh/b.wBie/fy0R.cyP8D9MXFMpPXfV3yvxPuTYoa', NULL, '2025-06-14 11:27:20', '2025-06-14 11:39:22', 'paciente', 1),
(23, 'Sofía Flores', 'sofia.flores@prosalud.com', NULL, '$2y$12$4L7PH5Cg.x7SFKs.CWK1revvVyY7J0LCBDCA1aj28cFyXHI5Iuxtm', NULL, '2025-06-14 18:17:42', '2025-06-14 18:31:31', 'paciente', 1),
(24, 'Sofía García', 'sofia.garcia@prosalud.com', NULL, '$2y$12$tKn4/hftdl.y0vqJpO.DAOZPYmsi6ytj80Sd4FQFia7SG7z7ExQhG', NULL, '2025-06-14 20:54:43', '2025-06-14 20:54:43', 'profesional', 1),
(25, 'Roberto López', 'roberto.lopez@prosalud.com', NULL, '$2y$12$Q3OjKjgqelIHWYb5qBfUi.6NaA.cz1HtdauXCMAgYJEKdgYKMzb56', NULL, '2025-06-14 20:59:51', '2025-06-14 20:59:51', 'profesional', 1),
(26, 'Elena Castillo', 'elena.castillo@prosalud.com', NULL, '$2y$12$bN1P2TPjQPfb5Laq1sftuOHTth0TeHyCUsJuqvE4Vw89VzFgrOXGW', NULL, '2025-06-14 21:05:04', '2025-06-14 21:05:04', 'profesional', 1),
(29, 'Luis Gómez', 'luis.gomez@prosalud.com', NULL, '$2y$12$S4LkeEJv2MDQnCMDgGSxTewybYwbcuV/IkwJEnDE1RrJIC0OruV7e', NULL, '2025-06-15 09:23:32', '2025-06-15 09:23:32', 'paciente', 1),
(30, 'Ana Córdova1', 'anaco@gmail.com', NULL, '$2y$12$gm1TGFi5YyMdzl./duH9WOxn26YJh6aGtOry3ZdI2TiUiI2PCDDEu', NULL, '2025-06-15 15:31:45', '2025-06-27 13:54:05', 'paciente', 1),
(31, 'Manuel Manuel', 'manuel.manuel@prosalud.com', NULL, '$2y$12$cZL6.nNdna99FiS1Q7RAbOKsLCzptsZfKBpGVfnIEa0vJDbgNNd/i', NULL, '2025-06-18 17:17:52', '2025-06-18 17:17:52', 'profesional', 1),
(32, 'jose jose', 'jose.jose@prosalud.com', NULL, '$2y$12$2wIpgE4m5OxEURb2vl8JIuNYSttKYpclUn58FMjAcCup2JMuVGYUC', NULL, '2025-06-18 17:19:20', '2025-06-18 17:19:20', 'profesional', 1),
(33, 'Administrador', 'admin@prosalud.com', NULL, '$2y$12$G0DOWDpMpF2pJzwxP2zIxulqzaLisVjeSOvRes1BHBGOo5QLck5Em', NULL, NULL, NULL, 'admin', 1),
(34, 'Manuel Sánchez Aguirre', 'manuel.sanchez@prosalud.com', NULL, '$2y$12$aomIYAv/T3HLyAnloSdHW.wvqDLf8QBN.le3IwcKAe4N1mQ3L8Mf2', NULL, '2025-06-25 16:39:32', '2025-06-25 16:39:32', 'paciente', 1),
(35, 'Antonio González Marín', 'antonio.gonzalez@prosalud.com', NULL, '$2y$12$scTuGQF.UrJuj3ZX1he3i.u50NY8gQ6hB0fkv/Gvr7ERPIX949Zw.', NULL, '2025-06-25 16:41:26', '2025-06-25 16:41:26', 'paciente', 1),
(36, 'Pedro Vélez Gómez', 'pedro.velez@prosalud.com', NULL, '$2y$12$XFcEk5nPRu27leXSc6RWiuIMsIl2nxiK26T20bCz.6nD2Bqld2U/O', NULL, '2025-06-25 16:46:48', '2025-06-25 16:46:48', 'profesional', 1),
(37, 'Juan Chamba Martínes', 'juan.chamba@prosalud.com', NULL, '$2y$12$0cDsJqLrOYXHkpdayTbiQ.dgPFTZo1mOqiCphXxCHtqvTNE4lAKzW', NULL, '2025-06-25 17:02:22', '2025-06-25 17:02:22', 'paciente', 1),
(38, 'David Morales Ludeña', 'david.morales@prosalud.com', NULL, '$2y$12$2XDlk9yMCzpEti07Ud2MF.PZurFE2ghxiZLaOSudQqVZVIyBqs6XK', NULL, '2025-06-25 17:05:02', '2025-06-25 17:05:02', 'profesional', 1),
(39, 'Santa Marianita', 'farmaciasantamarianita@prosalud.com', NULL, '$2y$12$CYy59cM6W0sElQ7q1zy..uMNbg20MPZZXxi5QaCpr7q.0ZGVVvGf.', NULL, '2025-06-25 17:32:14', '2025-06-25 17:32:14', 'proveedor', 1),
(40, 'Farmacia San Camilo', 'farmaciasancamilo@prosalud.com', NULL, '$2y$12$QIkh75EDvXuSiTOCDClDEesKmZmq9xwfWCsDJ1xCqvrz/XTn/H0Mu', NULL, '2025-06-25 17:36:32', '2025-06-25 17:36:32', 'proveedor', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE `valoraciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paciente_id` bigint(20) UNSIGNED NOT NULL,
  `profesional_id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `modalidad` enum('presencial','videollamada') NOT NULL,
  `puntuacion` tinyint(3) UNSIGNED NOT NULL,
  `comentario` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`id`, `paciente_id`, `profesional_id`, `fecha`, `modalidad`, `puntuacion`, `comentario`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-05-01', 'presencial', 5, 'Excelente atención y profesionalismo.', '2025-05-15 06:57:42', '2025-05-15 06:57:42'),
(2, 2, 1, '2025-04-28', 'videollamada', 4, 'Muy buena consulta, aunque hubo un poco de demora.', '2025-05-15 06:57:42', '2025-05-15 06:57:42'),
(3, 1, 1, '2025-05-10', 'presencial', 3, 'La atención fue correcta, pero esperaba un poco más.', '2025-05-15 06:57:42', '2025-05-15 06:57:42'),
(4, 1, 1, '2025-05-12', 'videollamada', 5, 'Muy claro en sus explicaciones, lo recomiendo.', '2025-05-15 06:57:42', '2025-05-15 06:57:42'),
(5, 1, 1, '2025-05-14', 'presencial', 2, 'No me sentí cómodo durante la consulta.', '2025-05-15 06:57:42', '2025-05-15 06:57:42'),
(6, 1, 1, '2025-05-19', 'presencial', 3, 'ha sido un desastre la consulta. mala atención. no llegó el médico', NULL, NULL),
(8, 1, 3, '2025-06-09', 'presencial', 5, 'Excelente servicio. Recomendado 100%', '2025-06-09 11:33:08', '2025-06-09 11:33:08'),
(9, 1, 1, '2025-06-18', 'presencial', 3, 'No llegó a tiempo a la reunión.', '2025-06-09 11:52:03', '2025-06-09 11:52:03'),
(10, 1, 1, '2025-06-06', 'presencial', 5, 'Excelente. Recomendado', '2025-06-09 11:53:15', '2025-06-09 11:53:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `via_administracion_medicamentos`
--

CREATE TABLE `via_administracion_medicamentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `via_administracion_medicamentos`
--

INSERT INTO `via_administracion_medicamentos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Oral', NULL, NULL),
(2, 'Sublingual', NULL, NULL),
(3, 'Bucofaríngea', NULL, NULL),
(4, 'Intravenosa (IV)', NULL, NULL),
(5, 'Intramuscular (IM)', NULL, NULL),
(6, 'Subcutánea (SC)', NULL, NULL),
(7, 'Intradérmica', NULL, NULL),
(8, 'Rectal', NULL, NULL),
(9, 'Vaginal', NULL, NULL),
(10, 'Tópica', NULL, NULL),
(11, 'Oftálmica', NULL, NULL),
(12, 'Ótica', NULL, NULL),
(13, 'Nasal', NULL, NULL),
(14, 'Inhalatoria (pulmonar)', NULL, NULL),
(15, 'Transdérmica', NULL, NULL),
(16, 'Intraarticular', NULL, NULL),
(17, 'Intratecal', NULL, NULL),
(18, 'Intraósea', NULL, NULL),
(19, 'Intraperitoneal', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `antecedentes`
--
ALTER TABLE `antecedentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `antecedentes_paciente_id_foreign` (`paciente_id`);

--
-- Indices de la tabla `articulos_blog`
--
ALTER TABLE `articulos_blog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `articulos_blog_slug_unique` (`slug`),
  ADD KEY `articulos_blog_categoria_id_foreign` (`categoria_id`),
  ADD KEY `articulos_blog_autor_id_foreign` (`autor_id`),
  ADD KEY `articulos_blog_estado_fecha_publicacion_index` (`estado`,`fecha_publicacion`),
  ADD KEY `articulos_blog_slug_index` (`slug`),
  ADD KEY `articulos_blog_destacado_index` (`destacado`);

--
-- Indices de la tabla `articulo_etiqueta`
--
ALTER TABLE `articulo_etiqueta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `articulo_etiqueta_articulo_id_etiqueta_id_unique` (`articulo_id`,`etiqueta_id`),
  ADD KEY `articulo_etiqueta_etiqueta_id_foreign` (`etiqueta_id`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `categorias_blog`
--
ALTER TABLE `categorias_blog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categorias_blog_slug_unique` (`slug`);

--
-- Indices de la tabla `categoria_profesionales`
--
ALTER TABLE `categoria_profesionales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `citas_codigo_qr_unique` (`codigo_qr`),
  ADD KEY `citas_paciente_id_foreign` (`paciente_id`),
  ADD KEY `citas_profesional_id_foreign` (`profesional_id`),
  ADD KEY `citas_consultorio_id_foreign` (`consultorio_id`),
  ADD KEY `citas_especializacion_id_foreign` (`especializacion_id`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ciudads_provincia_id_foreign` (`provincia_id`);

--
-- Indices de la tabla `consultorios`
--
ALTER TABLE `consultorios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consultorios_profesional_id_foreign` (`profesional_id`);

--
-- Indices de la tabla `consultorio_imagenes`
--
ALTER TABLE `consultorio_imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consultorio_imagenes_consultorio_id_foreign` (`consultorio_id`);

--
-- Indices de la tabla `contactos_admin`
--
ALTER TABLE `contactos_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contactos_admin_profesional_id_foreign` (`profesional_id`);

--
-- Indices de la tabla `contactos_emergencia`
--
ALTER TABLE `contactos_emergencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contactos_emergencia_paciente_id_foreign` (`paciente_id`);

--
-- Indices de la tabla `detalle_cita`
--
ALTER TABLE `detalle_cita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_cita_cita_id_foreign` (`cita_id`),
  ADD KEY `detalle_cita_metodo_pago_id_foreign` (`metodo_pago_id`);

--
-- Indices de la tabla `detalle_horarios`
--
ALTER TABLE `detalle_horarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_horarios_horario_id_foreign` (`horario_id`),
  ADD KEY `detalle_horarios_consultorio_id_foreign` (`consultorio_id`);

--
-- Indices de la tabla `detalle_horarios_videollamada`
--
ALTER TABLE `detalle_horarios_videollamada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_horarios_videollamada_horario_id_foreign` (`horario_id`);

--
-- Indices de la tabla `documentos_pacientes`
--
ALTER TABLE `documentos_pacientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documentos_pacientes_paciente_id_foreign` (`paciente_id`);

--
-- Indices de la tabla `documentos_profesional`
--
ALTER TABLE `documentos_profesional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documentos_profesional_profesional_id_foreign` (`profesional_id`);

--
-- Indices de la tabla `emergencias`
--
ALTER TABLE `emergencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emergencias_provincia_id_foreign` (`provincia_id`),
  ADD KEY `emergencias_ciudad_id_foreign` (`ciudad_id`);

--
-- Indices de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `especializaciones`
--
ALTER TABLE `especializaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `especializaciones_profesional_id_foreign` (`profesional_id`),
  ADD KEY `especializaciones_especialidad_id_foreign` (`especialidad_id`),
  ADD KEY `especializaciones_sub_especialidad_id_foreign` (`sub_especialidad_id`);

--
-- Indices de la tabla `etiquetas_blog`
--
ALTER TABLE `etiquetas_blog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `etiquetas_blog_slug_unique` (`slug`);

--
-- Indices de la tabla `experiencias_laborales`
--
ALTER TABLE `experiencias_laborales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `experiencias_laborales_profesional_id_foreign` (`profesional_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `formaciones_adicionales`
--
ALTER TABLE `formaciones_adicionales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formaciones_adicionales_profesional_id_foreign` (`profesional_id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `horarios_profesional_id_foreign` (`profesional_id`);

--
-- Indices de la tabla `horarios_videollamada`
--
ALTER TABLE `horarios_videollamada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `horarios_videollamada_profesional_id_foreign` (`profesional_id`);

--
-- Indices de la tabla `informes_consultas`
--
ALTER TABLE `informes_consultas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `informes_consultas_cita_id_foreign` (`cita_id`);

--
-- Indices de la tabla `intervalo_medicamentos`
--
ALTER TABLE `intervalo_medicamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medicamentos_recetas`
--
ALTER TABLE `medicamentos_recetas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medicamentos_recetas_receta_id_foreign` (`receta_id`),
  ADD KEY `medicamentos_recetas_medicamento_id_foreign` (`medicamento_id`),
  ADD KEY `medicamentos_recetas_presentacion_medicamentos_id_foreign` (`presentacion_medicamentos_id`),
  ADD KEY `medicamentos_recetas_via_administracion_medicamentos_id_foreign` (`via_administracion_medicamentos_id`),
  ADD KEY `medicamentos_recetas_intervalo_medicamentos_id_foreign` (`intervalo_medicamentos_id`);

--
-- Indices de la tabla `metodos_pagos`
--
ALTER TABLE `metodos_pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `metodo_pago_profesional`
--
ALTER TABLE `metodo_pago_profesional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `metodo_pago_profesional_profesional_id_foreign` (`profesional_id`),
  ADD KEY `metodo_pago_profesional_metodo_pago_id_foreign` (`metodo_pago_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pacientes_user_id_foreign` (`user_id`),
  ADD KEY `pacientes_ciudad_fk` (`ciudad_id`);

--
-- Indices de la tabla `paciente_seguro`
--
ALTER TABLE `paciente_seguro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paciente_seguro_paciente_id_foreign` (`paciente_id`),
  ADD KEY `paciente_seguro_seguro_id_foreign` (`seguro_id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `planes_nombre_unique` (`nombre`);

--
-- Indices de la tabla `preguntas_expertos`
--
ALTER TABLE `preguntas_expertos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preguntas_expertos_especialidad_id_foreign` (`especialidad_id`),
  ADD KEY `preguntas_expertos_sub_especialidad_id_foreign` (`sub_especialidad_id`);

--
-- Indices de la tabla `presentacion_medicamentos`
--
ALTER TABLE `presentacion_medicamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `profesionales`
--
ALTER TABLE `profesionales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profesionales_email_unique` (`email`),
  ADD KEY `profesionales_user_id_foreign` (`user_id`),
  ADD KEY `profesionales_plan_id_foreign` (`plan_id`),
  ADD KEY `profesionales_categoria_id_foreign` (`categoria_id`),
  ADD KEY `profesionales_ciudad_id_foreign` (`ciudad_id`);

--
-- Indices de la tabla `profesional_seguro`
--
ALTER TABLE `profesional_seguro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profesional_seguro_profesional_id_foreign` (`profesional_id`),
  ADD KEY `profesional_seguro_seguro_id_foreign` (`seguro_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `proveedores_numero_identificacion_unique` (`numero_identificacion`),
  ADD UNIQUE KEY `proveedores_email_unique` (`email`),
  ADD KEY `proveedores_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provincias_region_id_foreign` (`region_id`);

--
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recetas_informe_consulta_id_foreign` (`informe_consulta_id`);

--
-- Indices de la tabla `regiones`
--
ALTER TABLE `regiones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `regiones_nombre_unique` (`nombre`);

--
-- Indices de la tabla `respuestas_expertos`
--
ALTER TABLE `respuestas_expertos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `respuestas_expertos_preguntas_expertos_id_foreign` (`preguntas_expertos_id`),
  ADD KEY `respuestas_expertos_profesional_id_foreign` (`profesional_id`);

--
-- Indices de la tabla `seguros_medicos`
--
ALTER TABLE `seguros_medicos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `suscripciones_planes`
--
ALTER TABLE `suscripciones_planes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suscripciones_planes_profesional_id_foreign` (`profesional_id`),
  ADD KEY `suscripciones_planes_plan_id_foreign` (`plan_id`);

--
-- Indices de la tabla `titulos_universitarios`
--
ALTER TABLE `titulos_universitarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `titulos_universitarios_profesional_id_foreign` (`profesional_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `valoraciones_profesional_id_foreign` (`profesional_id`),
  ADD KEY `valoraciones_paciente_id_foreign` (`paciente_id`);

--
-- Indices de la tabla `via_administracion_medicamentos`
--
ALTER TABLE `via_administracion_medicamentos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `antecedentes`
--
ALTER TABLE `antecedentes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `articulos_blog`
--
ALTER TABLE `articulos_blog`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `articulo_etiqueta`
--
ALTER TABLE `articulo_etiqueta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `categorias_blog`
--
ALTER TABLE `categorias_blog`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `categoria_profesionales`
--
ALTER TABLE `categoria_profesionales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `consultorios`
--
ALTER TABLE `consultorios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `consultorio_imagenes`
--
ALTER TABLE `consultorio_imagenes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `contactos_admin`
--
ALTER TABLE `contactos_admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `contactos_emergencia`
--
ALTER TABLE `contactos_emergencia`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `detalle_cita`
--
ALTER TABLE `detalle_cita`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `detalle_horarios`
--
ALTER TABLE `detalle_horarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5599;

--
-- AUTO_INCREMENT de la tabla `detalle_horarios_videollamada`
--
ALTER TABLE `detalle_horarios_videollamada`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `documentos_pacientes`
--
ALTER TABLE `documentos_pacientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentos_profesional`
--
ALTER TABLE `documentos_profesional`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `emergencias`
--
ALTER TABLE `emergencias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=505;

--
-- AUTO_INCREMENT de la tabla `especializaciones`
--
ALTER TABLE `especializaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `etiquetas_blog`
--
ALTER TABLE `etiquetas_blog`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `experiencias_laborales`
--
ALTER TABLE `experiencias_laborales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `formaciones_adicionales`
--
ALTER TABLE `formaciones_adicionales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4401;

--
-- AUTO_INCREMENT de la tabla `horarios_videollamada`
--
ALTER TABLE `horarios_videollamada`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `informes_consultas`
--
ALTER TABLE `informes_consultas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `intervalo_medicamentos`
--
ALTER TABLE `intervalo_medicamentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=695;

--
-- AUTO_INCREMENT de la tabla `medicamentos_recetas`
--
ALTER TABLE `medicamentos_recetas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `metodos_pagos`
--
ALTER TABLE `metodos_pagos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `metodo_pago_profesional`
--
ALTER TABLE `metodo_pago_profesional`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `paciente_seguro`
--
ALTER TABLE `paciente_seguro`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `preguntas_expertos`
--
ALTER TABLE `preguntas_expertos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `presentacion_medicamentos`
--
ALTER TABLE `presentacion_medicamentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `profesionales`
--
ALTER TABLE `profesionales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `profesional_seguro`
--
ALTER TABLE `profesional_seguro`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `regiones`
--
ALTER TABLE `regiones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `respuestas_expertos`
--
ALTER TABLE `respuestas_expertos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `seguros_medicos`
--
ALTER TABLE `seguros_medicos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `suscripciones_planes`
--
ALTER TABLE `suscripciones_planes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `titulos_universitarios`
--
ALTER TABLE `titulos_universitarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `via_administracion_medicamentos`
--
ALTER TABLE `via_administracion_medicamentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `antecedentes`
--
ALTER TABLE `antecedentes`
  ADD CONSTRAINT `antecedentes_paciente_id_foreign` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `articulos_blog`
--
ALTER TABLE `articulos_blog`
  ADD CONSTRAINT `articulos_blog_autor_id_foreign` FOREIGN KEY (`autor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `articulos_blog_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias_blog` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `articulo_etiqueta`
--
ALTER TABLE `articulo_etiqueta`
  ADD CONSTRAINT `articulo_etiqueta_articulo_id_foreign` FOREIGN KEY (`articulo_id`) REFERENCES `articulos_blog` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `articulo_etiqueta_etiqueta_id_foreign` FOREIGN KEY (`etiqueta_id`) REFERENCES `etiquetas_blog` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_consultorio_id_foreign` FOREIGN KEY (`consultorio_id`) REFERENCES `consultorios` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `citas_especializacion_id_foreign` FOREIGN KEY (`especializacion_id`) REFERENCES `especializaciones` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `citas_paciente_id_foreign` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `citas_profesional_id_foreign` FOREIGN KEY (`profesional_id`) REFERENCES `profesionales` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD CONSTRAINT `ciudads_provincia_id_foreign` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `consultorios`
--
ALTER TABLE `consultorios`
  ADD CONSTRAINT `consultorios_profesional_id_foreign` FOREIGN KEY (`profesional_id`) REFERENCES `profesionales` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `consultorio_imagenes`
--
ALTER TABLE `consultorio_imagenes`
  ADD CONSTRAINT `consultorio_imagenes_consultorio_id_foreign` FOREIGN KEY (`consultorio_id`) REFERENCES `consultorios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `contactos_admin`
--
ALTER TABLE `contactos_admin`
  ADD CONSTRAINT `contactos_admin_profesional_id_foreign` FOREIGN KEY (`profesional_id`) REFERENCES `profesionales` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `contactos_emergencia`
--
ALTER TABLE `contactos_emergencia`
  ADD CONSTRAINT `contactos_emergencia_paciente_id_foreign` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_cita`
--
ALTER TABLE `detalle_cita`
  ADD CONSTRAINT `detalle_cita_cita_id_foreign` FOREIGN KEY (`cita_id`) REFERENCES `citas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_cita_metodo_pago_id_foreign` FOREIGN KEY (`metodo_pago_id`) REFERENCES `metodos_pagos` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `detalle_horarios`
--
ALTER TABLE `detalle_horarios`
  ADD CONSTRAINT `detalle_horarios_consultorio_id_foreign` FOREIGN KEY (`consultorio_id`) REFERENCES `consultorios` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `detalle_horarios_horario_id_foreign` FOREIGN KEY (`horario_id`) REFERENCES `horarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_horarios_videollamada`
--
ALTER TABLE `detalle_horarios_videollamada`
  ADD CONSTRAINT `detalle_horarios_videollamada_horario_id_foreign` FOREIGN KEY (`horario_id`) REFERENCES `horarios_videollamada` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `documentos_pacientes`
--
ALTER TABLE `documentos_pacientes`
  ADD CONSTRAINT `documentos_pacientes_paciente_id_foreign` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `documentos_profesional`
--
ALTER TABLE `documentos_profesional`
  ADD CONSTRAINT `documentos_profesional_profesional_id_foreign` FOREIGN KEY (`profesional_id`) REFERENCES `profesionales` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `emergencias`
--
ALTER TABLE `emergencias`
  ADD CONSTRAINT `emergencias_ciudad_id_foreign` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `emergencias_provincia_id_foreign` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `especializaciones`
--
ALTER TABLE `especializaciones`
  ADD CONSTRAINT `especializaciones_especialidad_id_foreign` FOREIGN KEY (`especialidad_id`) REFERENCES `especialidades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `especializaciones_profesional_id_foreign` FOREIGN KEY (`profesional_id`) REFERENCES `profesionales` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `especializaciones_sub_especialidad_id_foreign` FOREIGN KEY (`sub_especialidad_id`) REFERENCES `especialidades` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `experiencias_laborales`
--
ALTER TABLE `experiencias_laborales`
  ADD CONSTRAINT `experiencias_laborales_profesional_id_foreign` FOREIGN KEY (`profesional_id`) REFERENCES `profesionales` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `formaciones_adicionales`
--
ALTER TABLE `formaciones_adicionales`
  ADD CONSTRAINT `formaciones_adicionales_profesional_id_foreign` FOREIGN KEY (`profesional_id`) REFERENCES `profesionales` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_profesional_id_foreign` FOREIGN KEY (`profesional_id`) REFERENCES `profesionales` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `horarios_videollamada`
--
ALTER TABLE `horarios_videollamada`
  ADD CONSTRAINT `horarios_videollamada_profesional_id_foreign` FOREIGN KEY (`profesional_id`) REFERENCES `profesionales` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `informes_consultas`
--
ALTER TABLE `informes_consultas`
  ADD CONSTRAINT `informes_consultas_cita_id_foreign` FOREIGN KEY (`cita_id`) REFERENCES `citas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `medicamentos_recetas`
--
ALTER TABLE `medicamentos_recetas`
  ADD CONSTRAINT `medicamentos_recetas_intervalo_medicamentos_id_foreign` FOREIGN KEY (`intervalo_medicamentos_id`) REFERENCES `intervalo_medicamentos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medicamentos_recetas_medicamento_id_foreign` FOREIGN KEY (`medicamento_id`) REFERENCES `medicamentos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medicamentos_recetas_presentacion_medicamentos_id_foreign` FOREIGN KEY (`presentacion_medicamentos_id`) REFERENCES `presentacion_medicamentos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medicamentos_recetas_receta_id_foreign` FOREIGN KEY (`receta_id`) REFERENCES `recetas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medicamentos_recetas_via_administracion_medicamentos_id_foreign` FOREIGN KEY (`via_administracion_medicamentos_id`) REFERENCES `via_administracion_medicamentos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `metodo_pago_profesional`
--
ALTER TABLE `metodo_pago_profesional`
  ADD CONSTRAINT `metodo_pago_profesional_metodo_pago_id_foreign` FOREIGN KEY (`metodo_pago_id`) REFERENCES `metodos_pagos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `metodo_pago_profesional_profesional_id_foreign` FOREIGN KEY (`profesional_id`) REFERENCES `profesionales` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_ciudad_fk` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudades` (`id`),
  ADD CONSTRAINT `pacientes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `paciente_seguro`
--
ALTER TABLE `paciente_seguro`
  ADD CONSTRAINT `paciente_seguro_paciente_id_foreign` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `paciente_seguro_seguro_id_foreign` FOREIGN KEY (`seguro_id`) REFERENCES `seguros_medicos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `preguntas_expertos`
--
ALTER TABLE `preguntas_expertos`
  ADD CONSTRAINT `preguntas_expertos_especialidad_id_foreign` FOREIGN KEY (`especialidad_id`) REFERENCES `especialidades` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `preguntas_expertos_sub_especialidad_id_foreign` FOREIGN KEY (`sub_especialidad_id`) REFERENCES `especialidades` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `profesionales`
--
ALTER TABLE `profesionales`
  ADD CONSTRAINT `profesionales_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categoria_profesionales` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `profesionales_ciudad_id_foreign` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudades` (`id`),
  ADD CONSTRAINT `profesionales_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `planes` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `profesionales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `profesional_seguro`
--
ALTER TABLE `profesional_seguro`
  ADD CONSTRAINT `profesional_seguro_profesional_id_foreign` FOREIGN KEY (`profesional_id`) REFERENCES `profesionales` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `profesional_seguro_seguro_id_foreign` FOREIGN KEY (`seguro_id`) REFERENCES `seguros_medicos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `proveedores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD CONSTRAINT `provincias_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regiones` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD CONSTRAINT `recetas_informe_consulta_id_foreign` FOREIGN KEY (`informe_consulta_id`) REFERENCES `informes_consultas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `respuestas_expertos`
--
ALTER TABLE `respuestas_expertos`
  ADD CONSTRAINT `respuestas_expertos_preguntas_expertos_id_foreign` FOREIGN KEY (`preguntas_expertos_id`) REFERENCES `preguntas_expertos` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `respuestas_expertos_profesional_id_foreign` FOREIGN KEY (`profesional_id`) REFERENCES `profesionales` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `suscripciones_planes`
--
ALTER TABLE `suscripciones_planes`
  ADD CONSTRAINT `suscripciones_planes_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `planes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `suscripciones_planes_profesional_id_foreign` FOREIGN KEY (`profesional_id`) REFERENCES `profesionales` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `titulos_universitarios`
--
ALTER TABLE `titulos_universitarios`
  ADD CONSTRAINT `titulos_universitarios_profesional_id_foreign` FOREIGN KEY (`profesional_id`) REFERENCES `profesionales` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD CONSTRAINT `valoraciones_paciente_id_foreign` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `valoraciones_profesional_id_foreign` FOREIGN KEY (`profesional_id`) REFERENCES `profesionales` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
