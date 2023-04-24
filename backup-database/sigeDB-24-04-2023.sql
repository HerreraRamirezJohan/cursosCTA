-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-04-2023 a las 22:01:10
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sige`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cupo` int(11) NOT NULL DEFAULT 0,
  `ultimo_inventario` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Nunca',
  `tipo_espacio` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `equipamiento` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No Especificado' COMMENT 'Sin Equipo, Proyector, computadora, videoconferencia, Proyector, botonera y pantalla',
  `sede` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edificio` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `piso` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coordinacion` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen_1` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Sin imagen',
  `imagen_2` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Sin imagen',
  `activo` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `cupo`, `ultimo_inventario`, `tipo_espacio`, `equipamiento`, `sede`, `edificio`, `piso`, `division`, `coordinacion`, `area`, `imagen_1`, `imagen_2`, `activo`, `created_at`, `updated_at`) VALUES
(1, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio B', 'Piso 1', 'Cátedra Emile Durkheim.', 'Cátedra Emile Durkheim.', 'Cátedra Emile Durkheim.', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:38:28'),
(2, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'Cátedra José Martí', 'Cátedra José Martí', 'Cátedra José Martí', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:33:23'),
(3, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'Cátedra Latinoamericana Julio Cortázar', 'Cátedra Latinoamericana Julio Cortázar', 'Cátedra Latinoamericana Julio Cortázar', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:28:52'),
(4, 0, '2021', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'División de Estudios de Estado y Sociedad', 'Departamento de Estudios sobre Movimientos Sociales', 'Centro de Estudios Observatorio Social', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-10-02 23:29:44'),
(5, 0, 'Nunca', 'Administrativa', 'Proyector', 'Belenes', 'Edificio A', 'Piso 3', 'Secretaría Académica', 'Departamento de Estudios del Pacífico', 'Departamento de Estudios del Pacífico', '1631379142FBA1.JPG', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:27:02'),
(6, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio A', 'Piso 3', 'División de Estudios de Estado y Sociedad', 'Departamento de Estudios de Lenguas Modernas', 'Centro de Estudios Japoneses', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(7, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio A', 'Piso 3', 'División de Estudios de Estado y Sociedad', 'Departamento de Estudios del Pacífico', 'Centro de Estudios sobre América del Norte', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(8, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio F', 'Piso 1', 'División de Estudios de Estado y Sociedad', 'Departamento de Estudios del Pacífico', 'Maestría en Global Politics and Transpacific Studies', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(9, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio A', 'Piso 3', 'División de Estudios de Estado y Sociedad', 'Departamento de Estudios en Educación', 'Depto. de Estudios en Educación', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-03-01 19:33:20'),
(10, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio F 4', 'Piso 1', 'División de Estudios de Estado y Sociedad', 'Departamento de Estudios en Educación', 'Centro de Estudios de Género Belenes', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-02-14 19:07:38'),
(11, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio F 4', 'Piso 1', 'División de Estudios de Estado y Sociedad', 'Departamento de Estudios en Educación', 'Doctorado en Cognición y Aprendizaje', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-03-24 18:36:17'),
(12, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio A', 'Piso 3', 'División de Estudios de Estado y Sociedad', 'Departamento de Estudios en Educación', 'Doctorado en Educación', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(13, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio C', 'Planta Baja', 'División de Estudios de Estado y Sociedad', 'Departamento de Estudios en Educación', 'Maestría en Investigación Educativa', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(14, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'División de Estudios de Estado y Sociedad', 'Departamento de Estudios Ibéricos y Latinoamericanos', 'Departamento de Estudios Ibéricos y Latinoamericanos (DEILA)', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:38:48'),
(15, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'División de Estudios de Estado y Sociedad', 'Departamento de Estudios Ibéricos y Latinoamericanos', 'Centro de Estudios Europeos', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(16, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'División de Estudios de Estado y Sociedad', 'DESMOS. Departamento de Estudios sobre Movimientos Sociales', 'DESMOS. Departamento de Estudios sobre Movimientos Sociales', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:33:55'),
(17, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 3', 'División de Estudios de Estado y Sociedad', 'Departamento de Estudios Socio Urbanos', 'Departamento de Estudios Socio Urbanos', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:33:38'),
(18, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Tomás V. Gómez 121', 'Planta Baja', 'División de Estudios de Estado y Sociedad', 'Departamento de Estudios Socio Urbanos', 'Centro de Estudios Estratégicos para el Desarrollo', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(19, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio C', 'Planta Baja', 'División de Estudios de Estado y Sociedad', 'Departamento de Estudios Socio Urbanos', 'Centro de Estudios Estratégicos para el Desarrollo, Doctorado en Geografía y Ordenación Territorial', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(20, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', '-', '-', 'Div. de Estudios de Estado y Sociedad', 'Depto. de Estudios Socio Urbanos', 'C. de Estudios Urbanos', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(21, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio B', 'Piso 1', 'División de Estudios de Estado y Sociedad', 'Departamento de Estudios Socio Urbanos', 'Doctorado en Ciencias Sociales', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(22, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Garibaldi 1859', 'Planta Baja', 'División de Estudios de Estado y Sociedad', 'Departamento de Estudios Socio Urbanos', 'Maestría en Arquitectura y Diseño Urbano', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(23, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'División de Estudios de Estado y Sociedad', 'División de Estudios de Estado y Sociedad', 'División de Estudios de Estado y Sociedad', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:33:08'),
(24, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio C', 'Piso 3', 'División de Estudios de la Cultura', 'Departamento de Estudios de la Comunicación Social', 'Departamento de Estudios de la Comunicación Social', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-09-08 15:27:50'),
(25, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio A', 'Piso 2', 'División de Estudios de la Cultura', 'Estudios de la Comunicación Social, , Departamento de', 'Maestría en Comunicación', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-12-13 22:14:29'),
(26, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio H', 'Planta Baja', 'División de Estudios de la Cultura', 'Departamento de Estudios de Lenguas Modernas', 'Departamento de Estudios de Lenguas Modernas', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2023-02-28 17:15:36'),
(27, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio A', 'Planta Baja', 'División de Estudios de la Cultura', 'Departamento de Estudios en Lenguas Indígenas', 'Departamento de Estudios en Lenguas Indígenas', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:31:38'),
(28, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio A', 'Planta Baja', 'Division de Estudios de la Cultura', 'Departamento de Estudios en Lenguas Indígenas', 'Maestría en Lingüística Aplicada', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(29, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio A', 'Piso 1', 'División de Estudios de la Cultura', 'Departamento de Estudios Literarios', 'Depto. de Estudios Literarios', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-03-01 19:25:46'),
(30, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'División de Estudios de la Cultura', 'Departamento de Estudios Literarios', 'Centro de Estudios de Literatura Latinoamericana Julio Cortázar', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(31, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio A', 'Piso 1', 'División de Estudios de la Cultura', 'Departamento de Estudios Literarios', 'Doctorado en Estudios Literarios y Lingüísticos', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(32, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio B', 'Planta Baja', 'División de Estudios de la Cultura', 'Departamento de Estudios Literarios', 'Doctorado en Humanidades', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(33, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio A', 'Piso 1', 'División de Estudios de la Cultura', 'Departamento de Estudios Literarios', 'Maestría en Literaturas Comparadas', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(34, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio A', 'Planta Baja', 'División de Estudios de la Cultura', 'Departamento de Estudios Mesoamericanos y Mexicanos', 'Depto. de Estudios Mesoamericanos y Mexicanos', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-03-01 19:24:04'),
(35, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio A', 'Piso 3', 'División de Estudios de la Cultura', 'División de Estudios de la Cultura', 'División de Estudios de la Cultura', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:27:41'),
(36, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio A', 'Planta Baja', 'División de Estudios de la Cultura', 'Licenciatura en Comunicación Pública', 'Licenciatura en Comunicación Pública', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:27:28'),
(37, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio A', 'Piso 1', 'División de Estudios de la Cultura', 'Departamento de Estudios Literarios', 'Licenciatura en Escritura Creativa', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(38, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'La Normal', 'Edificio N', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Departamento de Filosofía', 'Depto. de Filosofía', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-03-01 20:36:50'),
(39, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'Division de Estudios Históricos y Humanos', 'Departamento de Filosofía', 'Centro de Estudios sobre Religión y Sociedad', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(40, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio F 4', 'Piso 1', 'División de Estudios Históricos y Humanos', 'Departamento de Filosofía', 'Maestía en Bioética', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-02-14 19:07:14'),
(41, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', '-', '-', 'División de Estudios Históricos y Humanos', 'Departamento de Filosofía', 'Maestría en Estudios Filosóficos', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(42, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio F4', '-', 'División de Estudios Históricos y Humanos', 'Departamento de Historia', 'Doctorado en Historia', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(43, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio B', 'Piso 2', 'División de Estudios Históricos y Humanos', 'Departamento de Historia', 'Maestría en Historia de México', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(44, 0, 'Nunca', 'Laboratorio', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Departamento de Lenguas Modernas', 'Centro de Autoacceso', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(45, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Departamentoto de Lenguas Modernas', 'Centro de Investigaciones Filológicas', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(46, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Departamento de Lenguas Modernas', 'Centro de Lenguas Extranjeras (CELEX)', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(47, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'Division de Estudios Históricos y Humanos', 'Departamento de Lenguas Modernas', 'Maestría en Enseñanza del Inglés como Lengua Extranjera', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(48, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio F 4', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Departamento de Lenguas Modernas', 'Maestría en Estudios de las Lengua y Culturas Inglesas', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-03-01 19:35:07'),
(49, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Departamento de Lenguas Modernas', 'Maestría Interinstitucional en Deutsch als Fremdsprache', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(50, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio N', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Departamento de Letras', 'Departamento de Letras', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:26:47'),
(51, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio C', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Departamento de Letras', 'Maestría en Estudios de Literatura Mexicana', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-01-16 18:00:40'),
(52, 0, '2021', 'Administrativa', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'División de Estudios Históricos y Humanos', 'División de Estudios Históricos y Humanos', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-03-16 20:22:27'),
(53, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio C', 'Piso 1', 'División de Estudios Históricos y Humanos', 'Departamento de Geografía y Ordenación Territorial', 'Maestría en Desarrollo Local y Territorio', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-02-28 19:30:50'),
(54, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'La Normal', 'Edificio N', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Departamento de Geografía y Ordenación Territorial', 'Depto. de Geografía y Ordenación Territorial', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-03-01 21:20:35'),
(55, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Departamento de Historia', 'Departamento de Historia', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:25:40'),
(56, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'La Normal', '-', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Departamento de Lenguas Modernas', 'Depto. de Lenguas Modernas', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-03-01 20:52:50'),
(57, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'División de Estudios Jurídicos', 'Departamento de Derecho Global', 'Departamento de Derecho Global', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:25:08'),
(58, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'División de Estudios Jurídicos', 'Departamento de Derecho Privado', 'Departamento de Derecho Privado', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2023-03-27 16:42:09'),
(59, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 4', 'División de Estudios Jurídicos', 'Departamento de Derecho Privado', 'Licenciatura en Criminología', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-03-07 17:53:53'),
(60, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'División de Estudios Jurídicos', 'Departamento de Derecho Público', 'Departamento de Derecho Público', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:24:38'),
(61, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'División de Estudios Jurídicos', 'Departamento de Derecho Social', 'DEPTO. DE DERECHO SOCIAL Y DISCIPLINAS SOBRE EL DERECHO', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-12 17:51:10'),
(62, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'División de Estudios Jurídicos', 'Departamento de Disciplinas sobre el Derecho', 'Departamento de Disciplinas sobre el Derecho', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:24:12'),
(63, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-09-05 14:34:49'),
(64, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'División de Estudios Jurídicos', 'Doctorado en Derecho', 'Doctorado en Derecho', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:23:59'),
(65, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'La Normal', 'Edificio G', 'Planta Baja', 'División de Estudios Políticos y Sociales', 'Departamento de Desarrollo Social', 'Depto. de Desarrollo Social', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-03-01 21:21:59'),
(66, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio F 4', 'Planta Baja', 'División de Estudios Políticos y Sociales', 'Departamento de Desarrollo Social', 'Maestría en Gestión y Desarrollo Social', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-03-06 17:06:51'),
(67, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio F 5', 'Piso 2', 'División de Estudios Políticos y Sociales', 'Departamento de Estudios Internacionales', 'Depto. de Estudios Internacionales', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-03-01 19:39:14'),
(68, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio F', 'Planta Baja', 'División de Estudios Políticos y Sociales', 'Departamento de Estudios Internacionales', 'Maestría en Relaciones Internacionales de Gobiernos y Actores Locales', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(69, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 2', 'División de Estudios Políticos y Sociales', 'Departamento de Estudios Políticos', 'Depto. de Estudios Políticos', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-03-01 19:31:30'),
(70, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio C', 'Piso 2', 'División de Estudios Políticos y Sociales', 'Departamento de Estudios Políticos', 'Doctorado en Ciencia Política', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(71, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'División de Estudios Políticos y Sociales', 'Departamento de Estudios Políticos', 'Instituto de Investigaciones en Innovación y Gobernanza', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(72, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio C', 'Piso 2', 'División de Estudios Políticos y Sociales', 'Departamento de Estudios Políticos', 'Maestría en Ciencia Política', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(73, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio F 5', 'Planta Baja', 'Div. de Estudios Políticos y Sociales', 'Depto. de Sociología', 'Depto. de Sociología', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-02-14 19:03:21'),
(74, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio F3', 'Piso 2', 'División de Estudios Políticos y Sociales', 'Departamento de Sociología', 'Instituto de Investigaciones Sociológicas', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-08-15 19:56:43'),
(75, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'F5', 'Piso 1', 'División de Estudios Políticos y Sociales', 'Departamento de Trabajo Social', 'Depto. de Trabajo Social', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-03-01 19:59:02'),
(76, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'edificio E', 'Piso 1', 'División de Estudios Políticos y Sociales', 'División de Estudios Políticos y Sociales', 'División de Estudios Políticos y Sociales', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-02-12 18:19:06'),
(77, 0, 'Nunca', 'Laboratorio', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'División Estudios Históricos y Humanos', 'Laboratorios de Estudios Históricos y Humanos I,', 'Laboratorios de Estudios Históricos y Humanos I,', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:21:59'),
(79, 0, 'Nunca', 'Laboratorio', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'División Estudios Históricos y Humanos', 'Laboratorios Estudios Históricos y Humanos II', 'Laboratorios Estudios Históricos y Humanos II', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:21:45'),
(80, 0, 'Nunca', 'Laboratorio', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'División Estudios Históricos y Humanos', 'Laboratorios Estudios Internacionales', 'Laboratorios Estudios Internacionales', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:21:30'),
(81, 0, 'Nunca', 'Laboratorio', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'División Estudios Históricos y Humanos', 'Geografía', 'Laboratorio Cartografía  (b143) geotecnologias', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-10-04 21:57:28'),
(82, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'Rectoría', 'Contraloría', 'Contraloría', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-09-07 19:28:12'),
(83, 0, 'Nunca', 'Laboratorio', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'Rectoria', 'Laboratorios Documentación Electrónica', 'Laboratorios Documentación Electrónica', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:20:53'),
(84, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio A', 'Planta Baja', 'Secretaría Académica', 'Coordinación de Docencia', 'Coordinación', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-12-13 15:38:14'),
(85, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'Secretaría Académica', 'Coordinación de Docencia', 'Unidad de Seguimiento de los Procesos de Calidad de los Programas Educativos', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-12-13 15:45:13'),
(86, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'Secretaría Académica', 'Coordinación de Investigación', 'Coord. de Investigación', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-03-01 20:56:43'),
(87, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'Secretaría Académica', 'Coordinación de Investigación', 'Unidad de Investigación', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-09-19 13:27:03'),
(88, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'Secretaría Académica', 'Coordinación de Planeación', 'Coordinación de Planeación', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-09-05 16:48:04'),
(89, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'Secretaría Académica', 'Coordinación de Planeación', 'Área de Seguimiento y Evaluación', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-09-05 16:48:38'),
(90, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'Secretaría Académica', 'Coordinación de Planeación', 'Unidad de Planeación', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-09-05 16:48:46'),
(91, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'Secretaría Académica', 'Coordinación de Posgrado', 'Unidad de Posgrado', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-09-14 16:35:51'),
(92, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'Secretaría Académica', 'Coordinación de Servicios Academicos', 'Coordinación de Servicios Académicos', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-11-22 17:42:05'),
(93, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'Secretaría Académica', 'Coordinación de Servicios Académicos', 'Unidad de Becas e Intercambio', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-02-26 00:28:43'),
(94, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'La Normal', '-', 'Planta Baja', 'Secretaría Académica', 'Coordinación de Servicios Academicos', 'Bibliotecas', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-02-28 19:39:34'),
(95, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'Secretaría Académica', 'Servicios Académicos, Coordinación', 'Unidad de Intercambio', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-11-22 17:41:05'),
(96, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Liceo', 'Planta Baja', 'Secretaría Académica', 'Bufetes jurídicos', 'Bufetes jurídicos', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:16:43'),
(97, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Piso 2', 'Secretaría Académica', 'CTA', 'Taller', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-08-19 19:42:51'),
(98, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio B', 'Planta Baja', 'Secretaría Académica', 'CTA', 'Unidad de Cómputo (Octavio Cortázar)', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(99, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'Secretaría Académica', 'CTA', 'U. de Multimedia Instruccional', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(100, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio B', 'Planta Baja', 'Secretaría Académica', 'CTA', 'Oficina Redes', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(101, 0, 'Nunca', 'Registro eliminado', 'No Especificado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(102, 0, 'Nunca', 'Registro eliminado', 'No Especificado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(103, 0, 'Nunca', 'Registro eliminado', 'No Especificado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(104, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', '-', '-', 'Secretaría Académica', 'Secretaría Académica', 'Secretaría Académica', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:38:14'),
(105, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Juan Manuel', 'Planta Baja', 'Secretaría Académica', 'Extensión', 'Editorial, Unidad de apoyo', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(106, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio A', 'Planta Baja', 'Secretaría Académica', 'Coordinación de Extensión', 'Coordinación de Extensión', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-05 20:39:58'),
(107, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Planta Baja', 'Secretaría Académica', 'Unidad de Servicio Social', 'Unidad de Servicio Social', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-02-27 19:27:08'),
(108, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'Secretaría Académica', 'Unidad de Vinculación', 'Unidad de Vinculación', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:36:05'),
(109, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'Secretaría Administrativa', 'Control Escolar', 'Coordinación de Control Escolar', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-12 16:40:46'),
(110, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 2', 'Secretaría Administrativa', 'Control Escolar', 'Área de Documentación y Archivo', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-03-15 15:00:54'),
(111, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'Secretaría Administrativa', 'Control Escolar', 'Área de Registro de Títulos', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(112, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'Secretaría Administrativa', 'Control Escolar', 'Unidad de Atención', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(113, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'Secretaría Administrativa', 'Control Escolar', 'Unidad de Control', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(114, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'Secretaría Administrativa', 'Control Escolar', 'Unidad de Ingreso', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(115, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'Secretaría Administrativa', 'Difusión, Coord. de', 'Coordinación', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(116, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Piso 3', 'Secretaría Administrativa', 'Coordinación de Finanzas', 'Coordinación de Finanzas', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-07-04 18:02:35'),
(117, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio A', 'Planta Baja', 'Secretaría Administrativa', 'Coordinación de Finanzas', 'Unidad de Contabilidad y Control Interno', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-09-14 15:55:42'),
(118, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio A', 'Planta Baja', 'Secretaría Administrativa', 'Coordinación de Finanzas', 'Unidad de Ingresos Autogenerados', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-09-14 15:56:43'),
(119, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio A', 'Planta Baja', 'Secretaría Administrativa', 'Coordinación de Finanzas', 'Unidad de Nóminas', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-09-14 15:57:43'),
(120, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio A', 'Planta Baja', 'Secretaría Administrativa', 'Coordinación de Finanzas', 'Unidad de Presupuesto', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-09-14 15:59:22'),
(121, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio A', 'Planta Baja', 'Secretaría Administrativa', 'Coordinación de Personal', 'Coordinación de Personal', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-09-08 18:02:41'),
(122, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio A', 'Planta Baja', 'Secretaría Administrativa', 'Coordinación de Personal', 'Unidad de Contratos Civiles y Laborales', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-09-08 18:02:31'),
(123, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio A', 'Planta Baja', 'Secretaría Administrativa', 'Coordinación de Personal', 'Unidad de Personal Académico', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-09-08 18:02:20'),
(124, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio A', 'Planta Baja', 'Secretaría Administrativa', 'Coordinación de Personal', 'Unidad de Personal Administrativo', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-09-08 18:01:56'),
(125, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio D', 'Planta Baja', 'Secretaría Administrativa', 'Coordinación de Servicios Generales', 'Coordinación de Servicios Generales', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-09-19 13:47:01'),
(126, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio Servicios Generales Belenes', 'Piso 1', 'Secretaría Administrativa', 'Coordinación de Servicios Generales', 'Unidad de Adquisiciones y Suministros', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-02-28 19:40:58'),
(127, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio D', 'Planta Baja', 'Secretaría Administrativa', 'Coordinación de Servicios Generales', 'Unidad de Mantenimiento', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(128, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio Servicios Generales Belenes', 'Piso 1', 'Secretaría Administrativa', 'Coordinación de Servicios Generales', 'Unidad de Patrimonio', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-09-02 15:36:41'),
(129, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio D', 'Planta Baja', 'Secretaría Administrativa', 'Coordinación de Servicios Generales', 'Unidad de Proyectos', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(130, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio I', 'Planta Baja', 'Secretaría Administrativa', 'Coordinación de Servicios Generales', 'Unidad Médica y Protección Civil', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(131, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'Secretaría Administrativa', 'Secretaría Administrativa', 'Secretaría Administrativa', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:35:46'),
(132, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Piso 3', 'Secretaría Administrativa', 'Unidad de Enseñanza Incorporada', 'Unidad de Enseñanza Incorporada', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-08-25 15:47:16'),
(133, 0, 'Nunca', 'Laboratorio', 'No Especificado', 'La Normal', '-', 'Planta Baja', '-', 'Laboratorios Consulta de Acervo Bibliográfico', 'Laboratorios Consulta de Acervo Bibliográfico', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:35:15'),
(134, 0, 'Nunca', 'Auditorio', 'No Especificado', 'Belenes', 'Edificio D', 'Planta Baja', 'Secretaría Académica', 'Auditorio', 'Auditorio Edificio D Isoptica', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(135, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Piso 3', 'Secretaría Académica', 'CTA', 'Bodega CTA', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(136, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio A', 'Planta Baja', 'Secretaría Académica', 'CTA', 'Bodega Personal', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(137, 0, '2022', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio D', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 10', '1665252431WhatsApp Image 2022-10-08 at 1.06.13 PM.jpeg', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-10-08 18:07:11'),
(138, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio D', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 11', '1666209076D-11-1.jpeg', '1666209076D-11-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-19 19:51:16'),
(139, 0, '2022', 'Laboratorio', 'Sin Equipo', 'Belenes', 'Edificio D', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 12', '1665252639WhatsApp Image 2022-10-08 at 1.10.25 PM.jpeg', '1631387522EDIFICIO_D_AULA_12_PISO_2(2).jpeg', 1, '2021-03-23 17:30:00', '2022-10-08 18:10:39'),
(140, 0, '2022', 'Aula', 'Proyector, computadora, videoconferencia', 'Belenes', 'Edificio D', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 13', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-03-18 23:27:32'),
(141, 0, '2022', 'Aula', 'Proyector, computadora, videoconferencia', 'Belenes', 'Edificio D', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 14', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-03-18 23:27:32'),
(142, 0, '2022', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio D', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 15', '1666208969D-15-1.jpeg', '1666208969D-15-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-19 19:49:29'),
(143, 0, '2022', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio D', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 16', '1666208889D-16-1.jpeg', '1666208889D-16-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-19 19:48:09'),
(144, 0, '2022', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio D', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 17', '1665253037WhatsApp Image 2022-10-08 at 1.14.11 PM.jpeg', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-10-08 18:17:17'),
(145, 0, '2022', 'Aula', 'Proyector, computadora, videoconferencia', 'Belenes', 'Edificio D', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 18', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-03-18 23:27:32'),
(146, 0, '2022', 'Laboratorio', 'Proyector, computadora', 'Belenes', 'Edificio D', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 19', '1631387629EDIFICIO_D_AULA_19_PISO_3.jpeg', '1631387629EDIFICIO_D_AULA_19_PISO_3(2).jpeg', 1, '2021-03-23 17:30:00', '2022-08-27 17:24:02'),
(147, 0, '2022', 'Aula', 'Proyector, computadora', 'Belenes', 'Edificio D', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 20', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-03-18 23:27:32'),
(148, 0, '2022', 'Aula', 'Proyector, computadora, videoconferencia', 'Belenes', 'Edificio D', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 21', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-06-15 20:58:23'),
(149, 0, '2022', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio D', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 22', '1665252315D22.jpeg', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-10-08 18:05:15'),
(150, 0, '2022', 'Aula', 'Proyector, computadora', 'Belenes', 'Edificio D', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 23', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-06-21 19:36:23'),
(151, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio D', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 3', '1665252241WhatsApp Image 2022-10-08 at 1.03.20 PM.jpeg', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-10-08 18:04:01'),
(152, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio D', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 4', '1665252305WhatsApp Image 2022-10-08 at 1.04.30 PM.jpeg', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-10-08 18:05:05'),
(153, 0, '2022', 'Laboratorio', 'Proyector, computadora', 'Belenes', 'Edificio D', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 5', '1631387583EDIFICIO_D_AULA_5_PISO_1.jpeg', '1631387583EDIFICIO_D_AULA_5_PISO_1(2).jpeg', 1, '2021-03-23 17:30:00', '2022-03-19 19:33:44'),
(154, 0, '2022', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio D', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 6', '1666208853D-16-1.jpeg', '1666208853D-16-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-19 19:47:33'),
(155, 0, '2022', 'Aula', 'Proyector, computadora, videoconferencia', 'Belenes', 'Edificio D', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 7', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-03-18 23:27:32'),
(156, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio D', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 8', '1665252250D8.jpeg', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-10-08 18:04:10'),
(157, 0, '2022', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio D', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 9', '1665254216D9 (2).jpeg', '1665254216D9.jpeg', 1, '2021-03-23 17:30:00', '2022-10-08 18:36:56'),
(158, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio D', 'Piso 4', 'Secretaría Administrativa', 'Secretaría Administrativa', 'CAG', '166439562020220928_135639.jpg', '166439562020220928_140243.jpg', 1, '2021-03-23 17:30:00', '2022-09-28 20:07:00'),
(159, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio F4', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'F4 1', '1666041457F4-1-1.jpeg', '1666041457F4-1-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-17 21:17:37'),
(160, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio F4', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'F4 10', '1665252776WhatsApp Image 2022-10-08 at 1.11.29 PM.jpeg', '1665252776WhatsApp Image 2022-10-08 at 1.11.29 PM.jpeg', 1, '2021-03-23 17:30:00', '2022-10-08 18:12:56'),
(161, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio F4', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'F4 3', '1666040289F4-3-1.jpeg', '1666040289F4-3-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-17 20:58:09'),
(162, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio F4', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'F4 4', '1666041254F4-4-1.jpeg', '1666041254F4-4-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-17 21:14:14'),
(163, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio F4', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'F4 5', '1666040070F4-5-1.jpeg', '1666040070F4-5-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-17 20:54:30'),
(164, 0, '2022', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio F4', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'F4 6', '1666041163F4-6-1.jpeg', '1666041163F4-6-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-17 21:12:43'),
(165, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio F4', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'F4 7', '1666041345F4-7-1.jpeg', '1666041345F4-7-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-17 21:15:45'),
(166, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio F4', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'F4 8', '1666040394F4-8-1.jpeg', '1666040394F4-8-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-17 20:59:54'),
(167, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio F4', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'F4 9', '1666040560F4-9-1.jpeg', '1666040560F4-9-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-17 21:02:40'),
(168, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio A', 'Planta Baja', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBA 1', '1639766720FBA1.tmp', '1639766720FBA1.tmp', 1, '2021-03-23 17:30:00', '2022-09-08 22:44:17'),
(169, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio A', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBA 10', '1639766563FBA10.JPG', '1631383871AULA10(2).JPG', 1, '2021-03-23 17:30:00', '2021-12-17 18:42:43'),
(170, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio A', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBA 11', '1666208096FBA-11-1.jpeg', '1666208096FBA-11-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-19 19:34:56'),
(171, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio A', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBA 12', '1666207967FBA-12-1.jpeg', '1666207967FBA-12-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-19 19:32:47'),
(172, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio A', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBA 13', '1665255278FBA 13 (2).jpeg', '1665255278FBA 13.jpeg', 1, '2021-03-23 17:30:00', '2022-10-08 18:54:38'),
(173, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio A', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBA 14', '1631384126AULA14.JPG', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-09-29 22:42:20'),
(174, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio A', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBA 15', '1631384173AULA15.JPG', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-09-11 23:16:13'),
(175, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio A', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBA 16', '1631384192AULA16.JPG', '1631381006FBA16(2).JPG', 1, '2021-03-23 17:30:00', '2021-09-11 23:16:32'),
(176, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio A', 'Planta Baja', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBA 2', '1666208746FBA-2-1.jpeg', '1666208746FBA-2-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-19 19:45:46'),
(177, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio A', 'Planta Baja', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBA 3', '1666208536FBA-3-1.jpeg', '1666208536FBA-3-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-19 19:42:16'),
(178, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio A', 'Planta Baja', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBA 4', '1666208640FBA-4-1.jpeg', '1666208640FBA-4-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-19 19:44:00'),
(179, 0, '2022', 'Laboratorio', 'Proyector,PC', 'Belenes', 'Edificio A', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBA 5', '1639769740FBA5.JPG', '1639769740FBA5(2).JPG', 1, '2021-03-23 17:30:00', '2022-09-29 22:17:28'),
(180, 0, 'Nunca', 'Laboratorio', 'Proyector,PC', 'Belenes', 'Edificio A', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBA 6', '1639769806FBA6.JPG', '1639769806FBA6(2).JPG', 1, '2021-03-23 17:30:00', '2022-09-29 22:18:04'),
(181, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio A', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBA 7', '1666208276FBA-7-1.jpeg', '1666208276FBA-7-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-19 19:37:56'),
(182, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio A', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBA 8', '1666208431FBA-8-1.jpeg', '1666208431FBA-8-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-19 19:40:31'),
(183, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio A', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBA 9', '1631383828AULA9.JPG', '1631383828AULA9(2).JPG', 1, '2021-03-23 17:30:00', '2021-09-11 23:10:28'),
(184, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio C', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 10', '1639770518FBC10.JPG', '1639770518FBC10(2).JPG', 1, '2021-03-23 17:30:00', '2022-01-24 21:16:44'),
(185, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio C', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 12', '1631384060FBC12.JPG', '1631384060FBC12(2).JPG', 1, '2021-03-23 17:30:00', '2022-02-14 21:34:06'),
(186, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio C', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 13', '1639770816FBC13.JPG', '1639770816FBC13(2).JPG', 1, '2021-03-23 17:30:00', '2022-02-14 21:33:54'),
(187, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio C', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 14', '1631384162FBC14.JPG', '1631384162FBC14(2).JPG', 1, '2021-03-23 17:30:00', '2022-02-14 21:33:38'),
(188, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio C', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 15', '1631384198FBC15.JPG', '1631384198FBC15(2).JPG', 1, '2021-03-23 17:30:00', '2022-01-24 21:17:42'),
(189, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio C', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 17', '1665251882fbc 17.jpeg', '1665251882fbc 17_2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-08 17:58:02'),
(190, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio C', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 18', '1631384420FBC18.JPG', '1631384420FBC18(2).JPG', 1, '2021-03-23 17:30:00', '2022-02-14 21:33:06');
INSERT INTO `areas` (`id`, `cupo`, `ultimo_inventario`, `tipo_espacio`, `equipamiento`, `sede`, `edificio`, `piso`, `division`, `coordinacion`, `area`, `imagen_1`, `imagen_2`, `activo`, `created_at`, `updated_at`) VALUES
(191, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio C', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 19', '1665255067WhatsApp Image 2022-10-08 at 1.26.08 PM.jpeg', '1631384450FBC19(2).JPG', 1, '2021-03-23 17:30:00', '2022-10-08 18:51:07'),
(192, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio C', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 2', '1639769716FBC2.JPG', '1639769716FBC2(2).JPG', 1, '2021-03-23 17:30:00', '2022-01-24 21:14:40'),
(193, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio C', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 20', '1665254048FBC 20 (2).jpeg', '1665254048FBC 20.jpeg', 1, '2021-03-23 17:30:00', '2022-10-08 18:34:08'),
(194, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio C', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 3', '1639769834FBC3.JPG', '1639769834FBC3.JPG', 1, '2021-03-23 17:30:00', '2022-01-24 21:14:53'),
(195, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio C', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 4', '1631382832FBC4.JPG', '1631382832FBC4(2).JPG', 1, '2021-03-23 17:30:00', '2022-01-24 21:15:06'),
(196, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio C', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 5', '1639770077FBC5.JPG', '1639770077FBC5(2).JPG', 1, '2021-03-23 17:30:00', '2022-01-24 21:15:19'),
(197, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio C', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 6', '1631382929FBC6.JPG', '1631382929FBC6(2).JPG', 1, '2021-03-23 17:30:00', '2022-01-24 21:15:33'),
(198, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio C', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 7', '1639770239FBC7.JPG', '1639770239FBC7(2).JPG', 1, '2021-03-23 17:30:00', '2022-01-24 21:15:46'),
(199, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio C', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 8', '1639770366FBC8.JPG', '1639770366FBC8(2).JPG', 1, '2021-03-23 17:30:00', '2022-01-24 21:16:17'),
(200, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio C', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 9', '1639770432FBC9.JPG', '1639770432FBC9(2).JPG', 1, '2021-03-23 17:30:00', '2022-01-24 21:16:30'),
(201, 0, 'Nunca', 'Laboratorio', 'Proyector', 'Belenes', 'Edificio A', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'Uso Libre Belenes', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-11-29 18:01:31'),
(202, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 2', 'Secretaría Académica', 'CTA', 'Coordinación Tecnologías para el Aprendizaje', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-03-01 19:23:01'),
(203, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio B', 'Planta Alta', 'Secretaría Académica', 'CTA', 'Coordinación', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(204, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'Secretaría Académica', 'CTA', 'Coordinación de Redes y Telecomunicaciones', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-01-26 19:16:09'),
(205, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio C', 'Planta Baja', 'Secretaría Académica', 'CTA - Espacios Comunes', 'Recepción Edificio C', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(206, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Piso 4', 'Secretaría Académica', 'Rectoría', 'Oficina de Rectoría', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(207, 0, 'Nunca', 'Auditorio', 'Proyector, botonera y pantalla', 'Belenes', 'Edificio C', 'Planta Baja', 'Secretaría Académica', 'CTA - Espacios Comunes', 'Sala de Juntas Sur', '1631385445SALAS_DE_JUNTAS_1_SUR.JPG', '1631385445SALAS_DE_JUNTAS_2_SUR.JPG', 1, '2021-03-23 17:30:00', '2021-09-11 23:37:25'),
(208, 0, 'Nunca', 'Auditorio', 'Proyector, botonera y pantalla', 'Belenes', 'Edificio C', 'Planta Baja', 'Secretaría Académica', 'CTA - Espacios Comunes', 'Sala de Usos Múltiples', '1631385491USOS MULTIPLES.JPG', '1631385491USOS MULTIPLES(2).JPG', 1, '2021-03-23 17:30:00', '2021-09-11 23:38:11'),
(209, 0, 'Nunca', 'Laboratorio', 'No Especificado', 'Belenes', 'Edificio F1', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'Uso Libre Belenes', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-11-29 18:01:23'),
(210, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio B', 'Planta Baja', 'Secretaría Administrativa', 'Secretaría Administrativa', 'Uso Libre La Normal', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(211, 0, 'Nunca', 'Aula', 'Proyector, computadora, videoconferencia', 'Belenes', 'Edificio E', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'E 1', '1631381661AULA1_PISO2.JPG', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-11-01 18:56:29'),
(212, 0, 'Nunca', 'Aula', 'Proyector, computadora, videoconferencia', 'Belenes', 'Edificio E', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'E 2', '1631381833AULA2_PISO2.JPG', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-09-11 22:37:13'),
(213, 0, 'Nunca', 'Aula', 'Proyector, computadora, videoconferencia', 'Belenes', 'Edificio E', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'E 3', '1631381980AULA3_PISO2.JPG', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-09-11 22:39:40'),
(214, 0, 'Nunca', 'Aula', 'Proyector, computadora, videoconferencia', 'Belenes', 'Edificio E', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'E 4', '1631382043AULA4_PISO2.JPG', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-09-11 22:40:43'),
(215, 0, 'Nunca', 'Aula', 'Proyector, botonera y pantalla', 'Belenes', 'Edificio E', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'E 6', '1631382207AULA6_PISO2.JPG', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-09-11 22:43:27'),
(216, 0, 'Nunca', 'Aula', 'Proyector, computadora, videoconferencia', 'Belenes', 'Edificio E', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'E 7', '1631380032AULA7 PISO3.JPG', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-09-11 22:24:52'),
(217, 0, 'Nunca', 'Aula', 'Proyector, computadora, videoconferencia', 'Belenes', 'Edificio E', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'E 8', '1631379603AULA8 PISO3.JPG', '1631379603AULA8 PISO3.JPG', 1, '2021-03-23 17:30:00', '2021-09-11 22:25:07'),
(218, 0, '2022', 'Aula', 'Proyector, computadora, videoconferencia', 'Belenes', 'Edificio E', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'E 9', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-03-18 23:27:32'),
(219, 0, 'Nunca', 'Aula', 'Proyector, computadora, videoconferencia', 'Belenes', 'Edificio E', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'E 10', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-09-11 22:25:39'),
(220, 0, 'Nunca', 'Aula', 'Proyector, botonera y pantalla', 'Belenes', 'Edificio E', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'E 11', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(221, 0, 'Nunca', 'Aula', 'Proyector, botonera y pantalla', 'Belenes', 'Edificio E', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'E 12', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(222, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 3', 'División de Estudios Jurídicos', 'CTA - Espacios Comunes', 'IDF Edificio E Piso 3', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-02-27 21:18:33'),
(223, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio D', 'Piso 4', 'Secretaría Académica', 'CTA - Espacios Comunes', 'IDF Edificio D Piso 4', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(224, 0, '2022', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio F4', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'F4 11', '1666041531F4-11-1.jpeg', '1666041531F4-11-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-17 21:18:51'),
(225, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio F4', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'F4 12', '1665254310F4 12 (2).jpeg', '1665254310F4 12.jpeg', 1, '2021-03-23 17:30:00', '2022-10-08 18:38:30'),
(226, 0, '2022', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio F4', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'F4 13', '1665252401F4-13.jpeg', '1665252401F4-13_2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-08 18:06:41'),
(227, 0, '2022', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio F4', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'F4 14', '1666040781F4-14-1.jpeg', '1666040781F4-14-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-17 21:06:21'),
(228, 0, '2022', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio F4', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'F4 15', '1666040871F4-15-1.jpeg', '1666040871F4-15-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-17 21:07:51'),
(229, 0, '2022', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio F4', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'F4 16', '1666041613F4-16-1.jpeg', '1666041613F4-16-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-17 21:20:13'),
(230, 0, '2022', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio F4', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'F4 17', '1666040711F4-17-1.jpeg', '1666040711F4-17-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-17 21:05:11'),
(231, 0, '2022', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio F4', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'F4 18', '1666040648F4-18-1.jpeg', '1666040648F4-18-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-17 21:04:08'),
(232, 0, '2022', 'Aula', 'Proyector, computadora', 'Belenes', 'Edificio F4', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'F4 19', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-08-27 17:22:09'),
(233, 0, '2022', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio F4', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'F4 20', '1665255171WhatsApp Image 2022-10-08 at 1.17.58 PM (2).jpeg', '1665255171WhatsApp Image 2022-10-08 at 1.17.58 PM (2).jpeg', 1, '2021-03-23 17:30:00', '2022-10-08 18:52:51'),
(235, 0, 'Nunca', 'Auditorio', 'Sin Equipo', 'Belenes', 'Edificio A', 'Piso 1', 'Secretaría Académica', 'CTA - Espacion comunes', 'Auditorio Fernando Pozos', '1631381578FERNANDO_POZOS.JPG', '1631381578FERNANDO_POZOS(2).JPG', 1, '2021-03-23 17:30:00', '2022-12-06 17:34:36'),
(236, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'E 5', '1668630862IMG_20221116_142824.jpg', '1668630862IMG_20221116_142750.jpg', 1, '2021-03-23 17:30:00', '2022-11-16 20:34:22'),
(237, 0, '2022', 'Laboratorio', 'Sin Equipo', 'Belenes', 'Edificio F1', 'Piso 1', 'Secretaría Académica', 'CTA', 'Laboratorio Cómputo F1 1', '1665255632FB1 1 (2).jpeg', '1665255632FB1 1.jpeg', 1, '2021-03-23 17:30:00', '2022-10-08 19:00:32'),
(238, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio D', 'Piso 4', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 24', 'Sin imagen', '1665254257D 24.jpeg', 1, '2021-03-23 17:30:00', '2022-10-08 18:37:37'),
(239, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio D', 'Piso 4', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 25', '1665255121WhatsApp Image 2022-10-08 at 1.25.22 PM.jpeg', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-10-08 18:52:01'),
(240, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio D', 'Planta Baja', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 1', '1665254101D1 (2).jpeg', '1665254101D1.jpeg', 1, '2021-03-23 17:30:00', '2022-10-08 18:35:01'),
(241, 0, 'Nunca', 'Aula', 'Proyector, computadora', 'Belenes', 'Edificio D', 'Planta Baja', 'Secretaría Académica', 'CTA - Espacios Comunes', 'D 2', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-10-19 17:09:41'),
(242, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Piso 1', 'CALAS', 'CALAS', 'CALAS', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:32:36'),
(243, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Núcleo Auditorios', 'Planta Baja', 'Secretaría Académica', 'CTA', 'VideoSala', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(244, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Cabaña', 'Planta Baja', 'Secretaría Administrativa', 'Coordinación de Servicios Generales', 'Vigilancia y Monitoreo', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(245, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio A', 'Planta Baja', 'Secretaría Académica', 'CTA - Espacios Comunes', 'IDF Edificio A Planta Baja', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(246, 0, 'Nunca', 'Administrativa', 'Proyector, botonera y pantalla', 'Belenes', 'Edificio A', 'Piso 3', 'Div. de Estudios de Estado y Sociedad', 'Depto. de Estudios del Pacífico', 'Centro de Estudios Japones', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(247, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio A', 'Planta Baja', 'Secretaría Académica', 'CTA - Espacios Comunes', 'IDF Rectoría', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(248, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio A', 'Planta Baja', 'Rectoria', 'Rectoría', 'Oficina Rector', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(249, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio B', 'Planta Baja', 'Secretaría Académica', 'CTA', 'Site Principal', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(250, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio C', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 16', 'Sin imagen', '1665253991FBC 16.jpeg', 1, '2021-03-23 17:30:00', '2022-10-08 18:33:11'),
(251, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio C', 'Planta Baja', 'Secretaría Académica', 'CTA - Espacios Comunes', 'IDF Edificio C Planta Baja', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(253, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Planta Baja', 'Secretaría Académica', 'Control Escolar', 'Coordinación de Control Escolar', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-12 16:40:28'),
(254, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', '-', '-', 'División de Estudios Históricos y Humanos', 'Departamento de Geografía y Ordenación Territorial', 'Doctorado en Geografía', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(255, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio F', 'Planta Baja', 'Secretaría Académica', 'Espacios Comunes', 'Pasillo Edificio F Piso 1', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(256, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio F', 'Planta Baja', 'Secretaría Académica', 'Espacios Comunes', 'Pasillo Edificio F Piso 2', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(257, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio F', 'Planta Baja', 'Secretaría Académica', 'Espacios Comunes', 'Pasillo Edificio F Piso 3', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(258, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'Secretaría Académica', 'Cátedra UNESCO', 'Cátedra UNESCO', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:32:20'),
(259, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio G', 'Planta Baja', 'División de Estudios Jurídicos', 'Comité de Alumnos', 'Comité de Alumnos RGA', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-02-03 18:56:37'),
(260, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'Secretaría Académica', 'Difusión, Coord. de', 'Eventos (Ex UMI)', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(261, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Núcleo Auditorios', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'Sala de Juicios Orales: Mariano Otero', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(262, 0, 'Nunca', 'Laboratorio', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'Laboratorio de Cómputo Jurídicos', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(263, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'Div. de Estudios Jurídicos', 'Espacios Comunes', 'Pasillos Edificio G Piso 2', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(264, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'Secretaría Académica', 'Espacios Comunes', 'Pasillos Edificio G Piso 3', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(265, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'Secretaría Académica', 'Espacios Comunes', 'Pasillos Edificio G Piso 4', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(266, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'Sala de Directores', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(267, 0, 'Nunca', 'Laboratorio', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'Secretaría Académica', 'CTA', 'Laboratorio Trabajo Social (Sin uso)', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(268, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'Secretaría Académica', 'Espacios Comunes', 'Pasillo Edificio H Piso 3', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(269, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'Secretaría Académica', 'Espacios Comunes', 'Pasillo Edificio H Piso 4', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(270, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio I', 'Planta Baja', 'Secretaría Administrativa', 'Espacios Comunes', 'Pasillo Edificio I Planta Baja', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(271, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio O', 'Planta Baja', 'Divivisión de Estudios de Estado y Sociedad', 'Departamento de Estudios del Pacífico', 'Aula Corea', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(272, 0, 'Nunca', 'Laboratorio', 'No Especificado', 'La Normal', 'Edificio P', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Departamento de Historia', 'Laboratorio del Departamento de Historia (Antropología)', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-03-07 20:57:18'),
(273, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio Q', 'Planta Baja', 'Secretaría Administrativa', 'Espacios Comunes', 'Jardín de Filosofía', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(274, 0, 'Nunca', 'Auditorio', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'Secretaría Académica', 'Secretaría Académica', 'Auditorio Adalberto Navarro', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(275, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Núcleo Auditorios', 'Planta Baja', 'Secretaría Académica', 'Auditorio Salvador Allende', 'Cabina Auditorio Salvador Allende', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(276, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio B', 'Planta Baja', 'Secretaría Académica', 'CTA', 'Taller CTA', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(277, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio A', 'Planta Baja', 'Secretaría Académica', 'Secretaría Académica', 'Sala de Maestros', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(278, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio A', 'Planta Baja', 'Rectoria', 'Rectoría', 'Secretaría Técnica', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-10-05 15:36:28'),
(279, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio K', 'Planta Baja', 'Secretaría Administrativa', 'Servicios Generales, Coordinación', 'Mantenimiento, Vigilancia y Monitoreo (Ing. Móises Chávez)', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(280, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio A', 'Planta Baja', 'Secretaría Administrativa', 'Secretaría Administrativa', 'Unidad de Transparencia', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-09-05 15:45:57'),
(281, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio K', 'Planta Baja', 'Secretaría Académica', 'CTA - Espacios Comunes', 'IDF Depto. Letras', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(282, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio N', 'Planta Baja', 'Divivisión de Estudios Históricos y Humanos', 'Departamento de Lenguas Modernas', 'Servicio Alemán de Intercambio Académico (DAAD)', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(283, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Desconocido', 'Planta Baja', 'Desconocida', 'Desconocida', 'Objeto No Localizado', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(284, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio B', 'Planta Baja', 'Secretaría Académica', 'CTA', 'Reportes', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(285, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'Secretaría Académica', 'Secretaría Académica', 'Secretaría Académica', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:31:21'),
(286, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio A', 'Planta Baja', 'Rectoria', 'Rectoría', 'Rectoría', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:31:04'),
(287, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio B', 'Planta Baja', 'Secretaría Académica', 'CTA', 'Cursos en línea', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(288, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'Pasillo Piso 3 Edif E', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(289, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Piso 4', 'Secretaría Administrativa', 'Coordinación de Servicios Generales', 'Administración de espacios (Aulas y Laboratorios)', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(290, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio A', 'Planta Baja', 'Rectoría', 'Rectoría', 'Secretaría Privada', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-10-05 15:44:12'),
(291, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'Pasillo Piso 2 Edif E', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(292, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Planta Baja', 'Secretaría Académica', 'CTA - Espacios Comunes', 'Pasillo Planta Baja Edif E', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(293, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'Pasillo Piso 1 Edif E', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(294, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Piso 4', 'Secretaría Académica', 'CTA - Espacios Comunes', 'Pasillo Piso 4 Edif E', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(295, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio D', 'Piso 4', 'Secretaría Académica', 'CTA - Espacios Comunes', 'Pasillo Piso 4 Edif D', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(296, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio D', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'Pasillo Piso 3 Edif D', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(297, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio D', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'Pasillo Piso 2 Edif D', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(298, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio D', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'Pasillo Piso 1 Edif D', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(299, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio D', 'Planta Baja', 'Secretaría Académica', 'CTA - Espacios Comunes', 'Pasillo Planta Baja Edif D', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(300, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio F4', 'Planta Baja', 'Secretaría Académica', 'CTA - Espacios Comunes', 'Pasillo Planta Baja Edif F4', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(301, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio F4', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'Pasillo Piso 1', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-02-14 19:05:14'),
(302, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio F4', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'Pasillo Piso 2', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-02-14 19:05:33'),
(303, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Piso 4', 'Rectoría', 'Rectoría', 'Oficina Rectoría - Coordinación', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2023-03-01 18:30:56'),
(304, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Piso 4', 'Rectoría', 'CTA', 'Cubículos Abiertos Rectoría', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(305, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Piso 1', 'Rectoría', 'Rectoría', 'Mesa de elecciones 2019', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(306, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio A', 'Planta Baja', 'Rectoría', 'Rectoría', 'Mesa de elecciones 2019', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(307, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'Rectoría', 'Rectoría', 'Mesa de elecciones 2019', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(308, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'Rectoría', 'Rectoría', 'Mesa de elecciones 2019', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(309, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio N', 'Planta Baja', 'Rectoría', 'Rectoría', 'Mesa de Elecciones 2019', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(310, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'Rectoría', 'Rectoría', 'Módulo de venta Leones Negros', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(311, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'F5', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'Pasillo P2 Edificio F5', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(312, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio D', 'Piso 4', 'Secretaría Académica', 'CTA - Espacios Comunes', 'Cafetería', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(313, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio L', 'Planta Baja', 'Secretaría Académica', 'coordinación de Extensión', 'Unidad de Deportes', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(314, 0, 'Nunca', 'Laboratorio', 'No Especificado', 'La Normal', 'Edificio L', 'Planta Baja', 'Secretaría Académica', 'Espacios Comunes', 'Aula Eduardo Aviña Batiz', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(315, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Cabaña', 'Planta Baja', 'Secretaría Administrativa', 'Servicios Generales Belenes', 'Servicios Generales Belenes', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:28:38'),
(316, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Planta Baja', 'División de Estudios Políticos y Sociales', 'División de Estudios Políticos y Sociales', 'División de Estudios Polìticos y Sociales', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(317, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio F4', 'Planta Baja', 'Maestría en Estudios Interculturales de lengua, Literatura y Culturas Alemanas', 'Secretaría Administrativa', 'Maestría en Estudios Interculturales de lengua, Literatura y Culturas Alemanas', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(318, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio Servicios Generales Belenes', 'Planta Baja', 'Secretaría Académica', 'Coordinación de Extensión', 'Unidad de Deportes Belenes', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-01-15 17:11:54'),
(319, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio F2', 'Planta Baja', 'secretaría Administrativa', 'Desarrollo local y territorio', 'Maestría', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(320, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio B', 'Primer Piso', 'Secretaría Administrativa', 'Doc.Ciencias Sociales', 'Doc.Ciencias Sociales', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-01 22:28:24'),
(321, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Piso 4', 'Secretaría Académica', 'Coordinación de Docencia', 'Rectoría Belenes', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(323, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', '-', 'Planta Baja', 'Centro Universitario de Ciencias Sociales y Humanidades', '-', 'CUCSH La Normal', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(324, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Desconocido', 'Desconocido', 'Delegación Académica de Políticos y sociales', 'División de Estudios Políticos y Sociales', 'Doctorado en Ciencia Política', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-06-07 22:13:33'),
(325, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Desconocido', 'Piso -1', 'Maestría en filosofía.', 'Históricos y Humanos.', 'Pasillo Piso 1 Edificio D', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(326, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio C', 'Planta Baja', 'Módulos de Información', 'Coordinación de Servicios Generales', 'Unidad de Control', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(327, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Ladron de guevara', 'Planta Baja', 'División de Estudios de Estado y Sociedad', 'Socio Urbanos, Departamento de Estudios', 'Centro de Estudios Urbanos', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(328, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Cabaña', 'Planta Baja', 'Secretaria Administrativa', 'Servicios Generales', 'Servicios de salud', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(329, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', '-', '-', 'C.U. DE CS. SOCIALES Y HUMANIDADES', 'C.U. DE CS. SOCIALES Y HUMANIDADES', 'C. U. DE CS. SOCIALES Y HUMANIDADES', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-02-28 20:24:26'),
(330, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio D', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'IDF Edificio D piso 2', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(331, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio A', 'Planta Baja', 'Secretaría Académica', 'CTA', 'Site Principal (MDF)', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-12-06 17:34:59'),
(332, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio D', 'Piso 1', 'Secretaría Académica', 'CTA', 'Doctorado en Historia', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(333, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio D', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'IDF Edificio D Piso 1', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(334, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Piso 4', 'Secretaría Académica', 'CTA - Espacios Comunes', 'IDF Edificio E Piso 4', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(335, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio A', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'IDF Edificio A Piso 1', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(336, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio F5', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'IDF Edificio F5 Piso 1', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(337, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio C', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'IDF Edificio C Piso 3', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(338, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio A', 'Planta Baja', 'Secretaría Académica', 'CTA', 'Recepción CTA', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(339, 0, 'Nunca', 'Laboratorio', 'No Especificado', 'La Normal', 'Edificio B', 'Planta Baja', 'Secretaría Académica', 'Biblioteca Central La Normal', 'Base de Datos en Línea', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(340, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio D', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'IDF Edificio D Piso 3', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(341, 0, '2021', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'División de Estudios Jurídicos', 'Derecho Público, Departamento de', 'C. DE INVESTIGACION OBSERVATORIO SOBRE SEGURIDAD', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-05 19:42:38'),
(342, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio B', 'Planta Baja', 'Secretaría Académica', 'Servicios Academicos, Coordinación', 'Bibliotecas', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-02-28 19:28:07'),
(343, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Planta Baja', 'Secretaría Académica', 'CTA - Espacios Comunes', 'IDF Edificio E Planta Baja', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(344, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio F5', 'Planta Baja', 'Secretaria Academica', 'CTA - Espacios Comunes', 'IDF Edificio F5 Planta Baja', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(345, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio F5', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'IDF Edificio F5 Piso 2', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(346, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Piso 2', '-', 'Servicios Generales Belenes', 'Bodega Servicios Generales', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(347, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio C', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'IDF Edificio C Piso 2', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(348, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio C', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'IDF Edificio C Piso 1', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(349, 0, '2021', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio D', 'Planta Baja', 'Secretaría Académica', 'CTA - Espacios Comunes', 'IDF Edificio D Planta Baja', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-12-16 17:54:23'),
(350, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio L', 'Planta Baja', 'Rectoria', 'Rectoría', 'Sistema Universitario del Adulto Mayor (SUAM)', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(351, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio D', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Departamento de Estudios de Lenguas Modernas', 'Maestría Interinstitucional en Deutsch als Fremdsprache: Estudios Interculturales de Lengua, Literatura y Cultura Alemanas', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-03-01 19:48:17'),
(352, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio Servicios Generales Belenes', 'Planta Baja', 'Rectoría', 'Secretaría Particular', 'Oficialía de partes', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-12-01 20:51:27'),
(353, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio O', 'Planta Baja', 'División Estudios Históricos y Humanos', 'Departamento de Letras', 'Centro de Estudios Urbanos', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(354, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 3', 'Secretearía Académica', 'Secretaría Académica', 'Comisiones del Honorable Consejo del CUCSH', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-02-10 19:02:32'),
(357, 0, '2022', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio F4', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'F4 2', '1666040491F4-2-1.jpeg', '1666040491F4-2-2.jpeg', 1, '2021-03-23 17:30:00', '2022-10-17 21:01:31'),
(376, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio C', 'Piso 2', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 11', '1639770598FBC11.JPG', '1639770598FBC11(2).JPG', 1, '2021-03-23 17:30:00', '2022-02-14 21:32:07'),
(377, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio C', 'Piso 1', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 1', '1639769490FBC1.JPG', '1639769490FBC1(2).JPG', 1, '2021-03-23 17:30:00', '2022-02-14 21:30:55'),
(378, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio C', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 21', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-14 21:36:04'),
(379, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio C', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 22', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-14 21:35:50'),
(380, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio I', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'I 71', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(381, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio I', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'I 72', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(382, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio I', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'I 73', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(383, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio I', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'I 74', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(384, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio I', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'I 79', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(385, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio I', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'I 80', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(386, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio L', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'L 81', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(387, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio L', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'L 82', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(388, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio L', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'L 83', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(389, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio O', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'O 110', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(390, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio O', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'O 111', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(391, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio O', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'O 112', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(392, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio O', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'O 113', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(393, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio O', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'O 114', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(394, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio O', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'O 115', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(395, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio O', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'O 116', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(396, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio O', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'O 117', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(397, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio O', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'O 118', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(398, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio O', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'O 119', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(399, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio O', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'O 120', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(400, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio P', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'P 122', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(401, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio P', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'P 121', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(402, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio P', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'P 123', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(403, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio P', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'P 124', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(404, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio P', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'P 125', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(405, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio P', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'P 126', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(406, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio P', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'P 127', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(407, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio P', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'P 128', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(408, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio P', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'P 129', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(409, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio P', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'P 158', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(410, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio P', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'P 159', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(411, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 86', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(412, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 87', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(413, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 88', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(414, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 89', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(415, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 90', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(416, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 91', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(417, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 92', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00');
INSERT INTO `areas` (`id`, `cupo`, `ultimo_inventario`, `tipo_espacio`, `equipamiento`, `sede`, `edificio`, `piso`, `division`, `coordinacion`, `area`, `imagen_1`, `imagen_2`, `activo`, `created_at`, `updated_at`) VALUES
(418, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 93', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(419, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 94', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(420, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 95', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(421, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 96', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(422, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 97', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(423, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 98', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(424, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 99', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(425, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 100', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(426, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 101', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(427, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 102', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(428, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 103', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(429, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 104', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(430, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 105', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(431, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 106', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(432, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 107', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(433, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 108', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(434, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio Q', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'Q 131', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(435, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio Q', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'Q 132', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(436, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio Q', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'Q 133', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(437, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio Q', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'Q 134', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(438, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio Q', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'Q 135', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(439, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio Q', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'Q 136', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(440, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio Q', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'Q 137', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(441, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'H 50', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(442, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'H 51', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(443, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'H 52', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(444, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'H 53', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(445, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'H 54', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(446, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'H 55', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(447, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'H 56', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(448, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'H 57', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(449, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'H 58', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(450, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'H 59', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(451, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'H 60', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(452, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'H 49', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(453, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'H 61', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(454, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'H 62', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(455, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'H 63', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(456, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'H 64', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(457, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'H 65', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(458, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'H 66', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(459, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'H 67', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(460, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'H 68', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(461, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'H 69', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(462, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'H 70', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(465, 0, 'Nunca', 'Laboratorio', 'No Especificado', 'La Normal', 'Edificio M', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'M 85', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(466, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio R', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'R 159', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(467, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio R', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'R 160', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(468, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio I', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'I 75', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(469, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio L', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'L 78', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(470, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio L', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'L 77', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(471, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio I', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'I 149', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(472, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio P', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Espacios Comunes', 'P 157', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(476, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio B', 'Planta Baja', 'Secretaría Académica', 'CTA', 'Bajas CTA Bodega', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(477, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio G', 'Planta Baja', 'Cultura', 'Cultura', 'Cátedra Latinoamericana Julio Cortázar', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(478, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio F4', 'Planta Baja', 'División de Estudios Políticos y Sociales', 'Departamento de Desarrollo Social', 'Coordinación en la Maestría en Desarrollo Social', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(479, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Calle Paseo Poniente 2093, Col', 'Planta Baja', 'División de Estudios Jurídicos', 'Maestría en Derecho', 'Coordinación en la Maestría en Derecho', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(480, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio F 4', 'Piso 1', 'División de Estudios de Estado y Sociedad', 'Maestría en Ciencias Sociales', 'Maestría en Ciencias Sociales', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-03-01 19:38:24'),
(481, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'La Normal', 'Edificio H', 'Planta Baja', 'División Estudios Históricos y Humanos', 'Departamento de Lenguas Modernas', 'Licenciatura en Didáctica Del Francés', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2023-03-01 21:21:19'),
(482, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'División Estudios Históricos y Humanos', 'Departamento de Lenguas Modernas', 'Coordinación de Licenciatura en Docencia del Inglés', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(483, 0, 'Nunca', 'Aula', 'Proyector,PC', 'Belenes', 'Edificio B', 'Piso 1', 'ESPACIOS', 'Aulas', 'FB1 1', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-10-08 18:58:25'),
(484, 0, 'Nunca', 'Registro eliminado', 'No Especificado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(485, 0, 'Nunca', 'Registro eliminado', 'No Especificado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-02-19 19:13:27'),
(486, 0, 'Nunca', 'Laboratorio', 'No Especificado', 'La Normal', 'Edificio K', 'Primer Piso', 'prueba', 'ANDRES', 'prueba', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-02-19 19:04:46'),
(487, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Piso 4', 'Secretaría Académica', 'CTA', 'Ajuste', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(488, 0, 'Nunca', 'Registro eliminado', 'No Especificado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Registro eliminado', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(489, 0, 'Nunca', 'Aula', 'Proyector, botonera y pantalla', 'Belenes', 'Edificio C', 'Planta Baja', 'Secretaría Académica', 'CTA - Espacios Comunes', 'Sala de Juntas Norte', '1631385416SALAS_DE_JUNTAS_1_NTE.JPG', '1631385416SALAS_DE_JUNTAS_2_NTE.JPG', 1, '2021-03-23 17:30:00', '2021-09-11 23:36:56'),
(490, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'XY', 'Desconocido', 'Rectoría', 'Observatorio (Division Jurídicos)', 'Unidad de Ingresos Autogenerados', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(491, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Piso 4', 'Secretaría Académica', 'CTA', 'Jefatura Cómputo Belenes', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(492, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Avenida Periférico Norte 1695', 'Planta Baja', '-', 'Festival Internacional de Cine de Guadalajara (FICG)', 'Área de Sistemas', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(493, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 1', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 5', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:31:45'),
(494, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 1', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 6', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:31:37'),
(495, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 1', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 7', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:31:24'),
(496, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 1', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 8', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:31:14'),
(497, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 1', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 9', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:31:07'),
(498, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 1', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 10', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:31:01'),
(499, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 2', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 12', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:30:54'),
(500, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 2', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 13', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:30:49'),
(501, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 2', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 14', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:30:44'),
(502, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 2', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 15', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:30:37'),
(503, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 2', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 16', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:30:31'),
(504, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 2', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 17', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:30:25'),
(505, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 2', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 18', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:30:19'),
(506, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 2', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 19', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:30:13'),
(507, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 2', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 20', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:30:04'),
(508, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 2', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 21', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:29:58'),
(509, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 3', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 23', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:29:51'),
(510, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 3', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 24', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:29:41'),
(511, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 3', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 25', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:29:35'),
(512, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 3', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 26', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:29:30'),
(513, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 3', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 27', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:29:24'),
(514, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 3', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 28', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:29:17'),
(515, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 3', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 29', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:29:11'),
(516, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 3', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 30', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:29:05'),
(517, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio G', 'Piso 3', 'División de Estudios Jurídicos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio G Aula 31', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-03-10 17:28:28'),
(523, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio L', 'Planta Alta', 'División de Estudios Históricos y Humanos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio L Aula 79', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(524, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio L', 'Planta Alta', 'División de Estudios Históricos y Humanos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio L Aula 80', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(543, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio I', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Secretaria académica - CTA - Espacios Comunes', 'Edificio I Aula S/N', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(548, 0, 'Nunca', 'Aula', 'No Especificado', 'La Normal', 'Edificio O', 'Planta Baja', 'Divivisión de Estudios Históricos y Humanos', 'Departamento de Letras', 'Centro de Investigación y Certificación del Español como Lengua Extranjera y Materna (CICELEM )(Aula corea)', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(549, 0, 'Nunca', 'Laboratorio', 'Sin Equipo', 'Belenes', 'Edificio F4', 'Piso 2', 'Secretaría Académica', 'Secretaria académica - CTA - Espacios Comunes', 'Uso Libre Belenes (Laboratorio F4 piso 2)', '1665254491FB4 USO LIBRE (2).jpeg', '1665254491FB4 USO LIBRE.jpeg', 1, '2021-03-23 17:30:00', '2022-10-08 18:41:31'),
(550, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio A', 'Piso 3', 'División de Estudios de la Cultura', 'Socio Urbanos, Departamento de Estudios', 'Unidad de Seguimiento de los Procesos de Calidad de los Programas Educativos', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-09-30 16:59:16'),
(551, 0, 'Nunca', 'Laboratorio', 'No Especificado', 'La Normal', '-', '-', '-', 'NULL', 'NULL', 'Sin imagen', 'Sin imagen', 0, '2021-03-23 17:30:00', '2022-02-19 18:58:29'),
(552, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio B', 'Planta Baja', 'Secretearía Académica', 'CTA - Secretaria académica', 'Ajuste', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2021-03-23 17:30:00'),
(553, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio A', 'Piso 2', 'División de Estudios Jurídicos', 'Doctorado en Derecho', 'Doctorado en Derecho', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-06-20 18:40:08'),
(554, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio E', 'Planta Baja', 'Secretaría Administrativa', 'Coordinación de Personal', 'Coordinación de Personal', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-12 19:20:37'),
(555, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio M', 'Piso 1', 'Secretaría Administrativa', 'Servicios Generales', 'IDF sociologia LA NORMAL', 'Sin imagen', 'Sin imagen', 1, '2021-05-17 23:13:50', '2021-05-17 23:13:50'),
(556, 0, 'Nunca', 'Administrativa', 'No Especificado', 'La Normal', 'Edificio A', 'Piso 1', 'Secretaría Académica', 'CTA', 'Apoyo Servicio Social', 'Sin imagen', 'Sin imagen', 1, '2021-05-24 23:56:39', '2021-05-24 23:56:39'),
(557, 0, 'Nunca', 'Auditorio', 'No Especificado', 'La Normal', 'Edificio H', 'Planta Baja', 'Secretaría Académica', 'Secretaría Académica', 'Auditorio Silvano Barba', 'Sin imagen', 'Sin imagen', 1, '2021-06-18 00:14:34', '2021-06-18 00:14:34'),
(558, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio F', 'Planta Baja', 'Secretaría Administrativa', 'Secretaría Administrativa', 'Culturas Inglesas', 'Sin imagen', 'Sin imagen', 1, '2021-06-22 22:06:18', '2021-06-22 22:06:18'),
(559, 0, 'Nunca', 'Administrativa', 'No Especificado', 'Belenes', 'Edificio D', 'Piso 3', 'Secretaría Académica', 'CTA', 'Oficina Prestadores Servicio Social', 'Sin imagen', 'Sin imagen', 1, '2021-06-26 23:20:30', '2021-06-26 23:20:30'),
(560, 0, 'Nunca', 'Administrativa', 'Botonera y pantalla', 'Belenes', 'Edificio E', 'Piso 3', 'Secretaría Académica', 'Difusión, Coordinación', 'Difusión Oficina Belenes', 'Sin imagen', 'Sin imagen', 1, '2021-07-21 04:35:52', '2021-07-21 04:35:52'),
(561, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio A', 'Piso 2', 'Secretaría Administrativa', 'CTA - Espacion comunes', 'IDF Edificio A Piso 2', 'Sin imagen', 'Sin imagen', 1, '2021-08-16 18:38:09', '2021-08-16 18:38:09'),
(562, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio F 4', 'Piso 3', 'Secretaría Académica', 'CTA - Espacion comunes', 'Pasillo Piso 3', 'Sin imagen', 'Sin imagen', 1, '2021-08-21 23:45:58', '2023-02-14 19:05:53'),
(563, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio A', 'Planta Baja', 'Secretaría Administrativa', 'CTA - Espacion comunes', 'Pasillo PB Edif A', 'Sin imagen', 'Sin imagen', 1, '2021-08-27 01:22:36', '2021-08-27 01:22:36'),
(564, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio A', 'Planta Baja', 'Secretaría Administrativa', 'CTA - Espacion comunes', 'Pasillo Piso 1 Edif A', 'Sin imagen', 'Sin imagen', 1, '2021-08-27 01:22:52', '2021-08-27 01:22:52'),
(565, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio A', 'Planta Baja', 'Secretaría Administrativa', 'CTA - Espacion comunes', 'Pasillo Piso 2 Edif A', 'Sin imagen', 'Sin imagen', 1, '2021-08-27 01:22:58', '2021-08-27 01:22:58'),
(566, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio A', 'Planta Baja', 'Secretaría Administrativa', 'CTA - Espacion comunes', 'Pasillo Piso 3 Edif A', 'Sin imagen', 'Sin imagen', 1, '2021-08-27 01:23:04', '2021-08-27 01:23:04'),
(567, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Planta Baja', 'Secretaría Administrativa', 'Secretaría Administrativa', 'Recursos Humanos', 'Sin imagen', 'Sin imagen', 1, '2021-09-09 00:28:12', '2021-09-09 00:28:12'),
(568, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio G', 'Piso 2', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 23', '1666373856G 23.jfif', '1666373856G 23.1.jfif', 1, '2021-09-16 01:31:26', '2022-10-25 22:39:58'),
(569, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio G', 'Piso 1', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 7', '1666371931G 7.jfif', '1666371931G 7.1.jfif', 1, '2021-09-16 01:34:03', '2022-10-25 22:37:35'),
(570, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio G', 'Piso 2', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 17', '1666372891G 17.jfif', '1666372891G 17.1.jfif', 1, '2021-09-16 01:34:45', '2022-10-25 22:39:02'),
(571, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio G', 'Piso 1', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 9', '1666372055G 9.jfif', '1666372055G 9.1.jfif', 1, '2021-09-16 01:35:30', '2022-10-25 22:37:52'),
(572, 0, '2022', 'Aula', 'Proyector, computadora', 'Belenes', 'Edificio G', 'Piso 1', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 9', 'Sin imagen', 'Sin imagen', 0, '2021-09-16 01:35:33', '2022-03-18 23:27:32'),
(573, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio G', 'Piso 2', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 19', '1666372992G 19.jfif', '1666372992G 19.1.jfif', 1, '2021-09-16 01:36:23', '2022-10-25 22:39:27'),
(574, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio G', 'Piso 1', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 11', '1666372491G 11.jfif', '1666372491G 11.1.jfif', 1, '2021-09-16 01:36:24', '2022-10-25 22:38:10'),
(575, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio G', 'Piso 1', 'División de Estudios Políticos y Sociales', 'División de Estudios Jurídicos', 'G 13', '1666372619G 13.jfif', '1666372619G 13.1.jfif', 1, '2021-09-16 01:37:32', '2022-10-25 22:38:25'),
(576, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio G', 'Piso 2', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 21', '1666373748G 21.jfif', '1666373748G 21.1.jfif', 1, '2021-09-16 01:38:34', '2022-10-25 22:39:43'),
(577, 0, 'Nunca', 'Aula', 'Proyector, computadora', 'Belenes', 'Edificio G', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'Salón 1 Planta Baja', 'Sin imagen', 'Sin imagen', 0, '2021-09-16 01:38:37', '2021-10-08 02:02:09'),
(578, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio G', 'Piso 1', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 15', '1666372770G 15.jfif', '1666372770G 15.1.jfif', 1, '2021-09-16 01:38:40', '2022-10-25 22:38:45'),
(579, 0, 'Nunca', 'Aula', 'TV', 'Belenes', 'Edificio G', 'Piso 2', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 25', '1666373951G 25.jfif', '1666373951G 25.1.jfif', 1, '2021-09-16 01:39:52', '2022-10-25 22:40:12'),
(580, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio G', 'Piso 1', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 8', '1666371999G 8.jfif', '1666371999G 8.1.jfif', 1, '2021-09-16 01:39:53', '2022-10-25 22:37:44'),
(581, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio G', 'Piso 2', 'División de Estudios Políticos y Sociales', 'División de Estudios Jurídicos', 'G 18', '1666372939G 18.jfif', '1666372939G 18.1.jfif', 1, '2021-09-16 01:42:10', '2022-10-25 22:39:10'),
(582, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio G', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 3', '1666371662G 3.jfif', '1666371662G 3.1.jfif', 1, '2021-09-16 01:43:23', '2022-10-25 22:36:38'),
(583, 0, '2021', 'Aula', 'TV,PC', 'Belenes', 'Edificio G', 'Piso 1', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 10', '1633540694G10-1.jfif', '1633540694G10.jfif', 1, '2021-09-16 01:43:27', '2022-10-25 22:38:01'),
(584, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio G', 'Piso 2', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 20', '1666373160G 20.jfif', '1666373160G 20.1.jfif', 1, '2021-09-16 01:43:41', '2022-10-27 19:49:45'),
(585, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 1', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 12', '1666372556G 12.jfif', '1666372556G 12.1.jfif', 1, '2021-09-16 01:44:21', '2022-10-21 17:15:56'),
(586, 0, 'Nunca', 'Administrativa', 'Proyector, computadora', 'Belenes', 'Edificio G', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'Salón 3 Planta Baja', 'Sin imagen', 'Sin imagen', 1, '2021-09-16 01:44:40', '2021-09-16 01:44:40'),
(587, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 2', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 22', '1666373802G 22.jfif', '1666373802G 22.1.jfif', 1, '2021-09-16 01:44:54', '2022-10-21 17:36:42'),
(588, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio G', 'Piso 1', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 14', '1666372680G 14.jfif', '1666372680G 14.1.jfif', 1, '2021-09-16 01:45:08', '2022-10-25 22:38:37'),
(589, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio G', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 2', '1666371589G 2.jfif', '1666371589G 2.1.jfif', 1, '2021-09-16 01:45:52', '2022-10-25 22:36:22'),
(590, 0, 'Nunca', 'Aula', 'TV', 'Belenes', 'Edificio G', 'Piso 2', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 24', 'Sin imagen', 'Sin imagen', 1, '2021-09-16 01:45:59', '2022-10-25 22:33:02'),
(591, 0, 'Nunca', 'Aula', 'TV', 'Belenes', 'Edificio G', 'Piso 2', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 26', '1666374003G 26.jfif', '1666374003G 26.1.jfif', 1, '2021-09-16 01:47:08', '2022-10-25 22:40:22'),
(592, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 3', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 27', '1666374066G 27.jfif', '1666374066G 27.1.jfif', 1, '2021-09-16 01:47:10', '2022-10-21 17:41:06'),
(593, 0, 'Nunca', 'Administrativa', 'Proyector, computadora', 'Belenes', 'Edificio G', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'Salón 5 Planta Baja', 'Sin imagen', 'Sin imagen', 0, '2021-09-16 01:47:37', '2021-10-20 15:36:53'),
(594, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 3', 'División de Estudios Políticos y Sociales', 'División de Estudios Jurídicos', 'G 37', '1666375004G 37.jfif', '1666375004G 37.1.jfif', 1, '2021-09-16 01:50:31', '2022-10-21 17:56:44'),
(595, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 3', 'División de Estudios Políticos y Sociales', 'División de Estudios Jurídicos', 'G 29', '1666374165G 29.jfif', '1666374165G 29.1.jfif', 1, '2021-09-16 01:50:33', '2022-10-21 17:42:45'),
(596, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 3', 'División de Estudios Políticos y Sociales', 'División de Estudios Jurídicos', 'G 28', '1666374115G 28.jfif', '1666374115G 28.1.jfif', 1, '2021-09-16 01:51:31', '2022-10-21 17:41:55'),
(597, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 3', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 33', '1666374808G 33.jfif', '1666374808G 33.1.jfif', 1, '2021-09-16 01:51:40', '2022-10-21 17:53:28'),
(598, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 3', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 30', '1666374229G 30.jfif', '1666374229G 30.1.jfif', 1, '2021-09-16 01:52:36', '2022-10-21 17:43:49'),
(599, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 3', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 35', '1666374904G 35.jfif', '1666374904G 35.1.jfif', 1, '2021-09-16 01:52:43', '2022-10-21 17:55:04'),
(600, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 3', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 32', '1666374752G 32.jfif', '1666374752G 32.1.jfif', 1, '2021-09-16 01:53:30', '2022-10-21 17:52:32'),
(601, 0, 'Nunca', 'Administrativa', 'Proyector, computadora', 'Belenes', 'Edificio G', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'Salón 6 Planta Baja', 'Sin imagen', 'Sin imagen', 1, '2021-09-16 01:53:30', '2021-09-16 01:53:30'),
(602, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 3', 'División de Estudios Políticos y Sociales', 'División de Estudios Jurídicos', 'G 34', '1666374852G 34.jfif', '1666374852G 34.1.jfif', 1, '2021-09-16 01:54:11', '2022-10-21 17:54:12'),
(603, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 3', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 31', '1666374705G 31.jfif', '1666374705G 31.1.jfif', 1, '2021-09-16 01:55:15', '2022-10-21 17:51:45'),
(604, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio D', 'Planta Baja', 'División de Estudios de la Cultura', 'Departamento de Estudios de Lenguas Modernas', 'Maestría en Alemàn', 'Sin imagen', 'Sin imagen', 1, '2021-09-22 22:39:36', '2021-09-22 22:39:36'),
(605, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio G', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 1', '1666371510G 1.jfif', '1666371510G 1.1.jfif', 1, '2021-09-22 23:22:01', '2022-10-25 22:34:24'),
(606, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Planta Baja', 'Secretaría Académica', 'CTA - Espacion comunes', 'G 1', 'Sin imagen', 'Sin imagen', 0, '2021-09-22 23:26:18', '2021-10-08 02:45:06'),
(607, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 1', 'Secretaría Académica', 'CTA - Espacion comunes', 'Edificio G Piso 1 Aula 7', 'Sin imagen', 'Sin imagen', 0, '2021-09-22 23:30:48', '2021-10-08 01:40:20'),
(608, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 1', 'Secretaría Académica', 'CTA - Espacion comunes', 'Edificio G Piso 1 Aula 2', 'Sin imagen', 'Sin imagen', 0, '2021-09-22 23:33:59', '2021-10-08 01:42:41'),
(609, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 1', 'Secretaría Académica', 'CTA - Espacion comunes', 'Edificio G Piso 1 Aula 6', 'Sin imagen', 'Sin imagen', 0, '2021-09-22 23:34:49', '2021-10-08 01:44:44'),
(610, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 2', 'Secretaría Académica', 'CTA - Espacion comunes', 'Edificio G Piso 2 Aula 2', 'Sin imagen', 'Sin imagen', 0, '2021-09-22 23:35:10', '2021-10-08 01:21:24'),
(611, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 1', 'Secretaría Académica', 'CTA - Espacion comunes', 'Edificio G Piso 1 Aula 1', 'Sin imagen', 'Sin imagen', 0, '2021-09-22 23:35:31', '2021-10-08 01:46:48'),
(612, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 2', 'Secretaría Académica', 'CTA - Espacion comunes', 'Edificio G Piso 2 Aula 7', 'Sin imagen', 'Sin imagen', 0, '2021-09-22 23:36:12', '2021-10-08 01:20:36'),
(613, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 1', 'Secretaría Académica', 'CTA - Espacion comunes', 'Edificio G Piso 1 Aula 4', 'Sin imagen', 'Sin imagen', 0, '2021-09-22 23:36:23', '2021-10-08 01:45:52'),
(614, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 2', 'Secretaría Académica', 'CTA - Espacion comunes', 'Edificio G Piso 2 Aula 3', 'Sin imagen', 'Sin imagen', 0, '2021-09-22 23:36:36', '2021-10-08 01:24:24'),
(615, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 1', 'Secretaría Académica', 'CTA - Espacion comunes', 'Edificio G Piso 1 Aula 9', 'Sin imagen', 'Sin imagen', 0, '2021-09-22 23:36:47', '2021-10-08 01:40:03'),
(616, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 2', 'Secretaría Académica', 'CTA - Espacion comunes', 'Edificio G Piso 2 Aula 4', 'Sin imagen', 'Sin imagen', 0, '2021-09-22 23:37:05', '2021-10-08 01:09:42'),
(617, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 1', 'Secretaría Académica', 'CTA - Espacion comunes', 'Edificio G Piso 1 Aula 5', 'Sin imagen', 'Sin imagen', 0, '2021-09-22 23:37:14', '2021-10-08 01:44:19'),
(618, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio G', 'Piso 1', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 16', '1666372835G 16.jfif', '1666372835G 16.1.jfif', 1, '2021-09-22 23:37:42', '2022-10-25 22:38:53'),
(619, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 2', 'Secretaría Académica', 'CTA - Espacion comunes', 'Edificio G Piso 2 Aula 1', 'Sin imagen', 'Sin imagen', 0, '2021-09-22 23:48:30', '2021-10-08 01:24:47'),
(620, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 2', 'Secretaría Académica', 'CTA - Espacion comunes', 'Edificio G Piso 2 Aula 6', 'Sin imagen', 'Sin imagen', 0, '2021-09-22 23:48:49', '2021-10-08 01:23:08'),
(621, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio G', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 5', '1666371740G 5.jfif', '1666371740G 5.1.jfif', 1, '2021-09-28 01:41:47', '2022-10-25 22:37:13'),
(622, 0, 'Nunca', 'Aula', 'Proyector, computadora, videoconferencia', 'Belenes', 'Edificio G', 'Planta Baja', 'Secretaría Académica', 'CTA - Espacion comunes', 'G 2', 'Sin imagen', 'Sin imagen', 0, '2021-09-28 01:42:43', '2021-10-18 21:15:26'),
(623, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio G', 'Planta Baja', 'Secretaría Académica', 'CTA', 'IDF Edificio G Planta Baja', 'Sin imagen', 'Sin imagen', 1, '2021-10-06 03:29:49', '2021-10-06 03:29:49'),
(624, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 1', 'Secretaría Académica', 'CTA', 'IDF Edificio G Piso 1', 'Sin imagen', 'Sin imagen', 1, '2021-10-06 03:30:18', '2021-10-06 03:30:18'),
(625, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 2', 'Secretaría Académica', 'CTA', 'IDF Edificio G Piso 2', 'Sin imagen', 'Sin imagen', 1, '2021-10-06 03:30:38', '2021-10-06 03:30:38'),
(626, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 3', 'Secretaría Académica', 'CTA', 'IDF Edificio G Piso 3', 'Sin imagen', 'Sin imagen', 1, '2021-10-06 03:31:05', '2021-10-06 03:31:05'),
(627, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 4', 'Secretaría Académica', 'CTA', 'IDF Edificio G Piso 4', 'Sin imagen', 'Sin imagen', 1, '2021-10-06 03:31:28', '2021-10-06 03:31:28'),
(628, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'Secretaría Académica', 'CTA', 'Aula Virtual', 'Sin imagen', 'Sin imagen', 1, '2021-10-06 21:18:30', '2021-10-06 21:18:30'),
(629, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio G', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 4', '1665253576g4.jpeg', 'Sin imagen', 1, '2021-10-08 02:01:59', '2022-10-25 22:37:02'),
(630, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Juan Manuel 130', 'Edificio A', 'Planta Baja', 'Secretaría Académica', 'CTA', 'Bodega Baja Juan Manuel', 'Sin imagen', 'Sin imagen', 1, '2021-10-14 22:47:56', '2021-10-14 22:47:56'),
(631, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'Secretaría Académica', 'CTA', 'Coordinación de Redes Belenes', 'Sin imagen', 'Sin imagen', 1, '2021-10-16 16:24:04', '2021-10-16 16:24:04'),
(632, 0, 'Nunca', 'Aula', 'Proyector, computadora', 'Belenes', 'Edificio E', 'Piso 1', 'Secretaría Académica', 'CTA - Espacion comunes', 'E 1', 'Sin imagen', 'Sin imagen', 0, '2021-10-18 15:52:41', '2021-10-26 23:36:03'),
(633, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Papirolas', 'Edificio A', 'Planta Baja', 'Rectoría', 'CTA', 'Papirolas', 'Sin imagen', 'Sin imagen', 1, '2021-11-03 19:00:33', '2022-01-15 17:15:50'),
(634, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'Rectoría', 'Secretaría Particular', 'Secretaria Particular', 'Sin imagen', 'Sin imagen', 1, '2021-11-18 17:06:53', '2023-02-27 20:19:49'),
(635, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'Rectoría', 'Rectoría', 'Recepción Rectoría (Ana Contreras)', 'Sin imagen', 'Sin imagen', 1, '2021-11-22 19:30:52', '2021-11-22 19:30:52'),
(636, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 4', 'División de Estudios Jurídicos', 'Bufetes jurídicos', 'Coordinación de Bufetes jurídicos', 'Sin imagen', 'Sin imagen', 1, '2021-11-23 18:34:01', '2021-11-23 18:34:01'),
(637, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 4', 'División de Estudios Jurídicos', 'Bufetes jurídicos', 'Coordinación de Bufetes jurídicos', 'Sin imagen', 'Sin imagen', 0, '2021-11-23 18:34:28', '2021-11-23 19:26:07'),
(638, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'FIL', 'Edificio A', 'Planta Baja', 'Secretaría Académica', 'CTA', 'FIL en ExpoGuadalajara', 'Sin imagen', 'Sin imagen', 1, '2021-11-30 20:45:10', '2021-11-30 20:45:10'),
(639, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio F', 'Planta Baja', 'Secretaría Académica', 'CTA', 'IDF Edificio Servicios Generales', 'Sin imagen', 'Sin imagen', 1, '2021-12-01 20:12:11', '2021-12-01 20:12:11'),
(640, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Prestamo Externo', 'Edificio A', 'Planta Baja', 'Secretaría Académica', 'CTA', 'Préstamo Externo a Alumnos y Administrativos', 'Sin imagen', 'Sin imagen', 1, '2022-01-06 17:09:33', '2022-01-06 17:09:33'),
(641, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio Servicios Generales Belenes', 'Planta Baja', 'Secretaría Académica', 'Extensión, , Coordinación', 'Unidad de Deportes Belenes', 'Sin imagen', 'Sin imagen', 0, '2022-01-13 18:17:49', '2022-01-15 17:14:12'),
(642, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio Servicios Generales Belenes', 'Planta Baja', 'Rectoría', 'Servicios Generales Belenes', 'Mantenimiento Belenes (Julio)', 'Sin imagen', 'Sin imagen', 1, '2022-02-03 19:53:16', '2022-02-03 19:53:16'),
(643, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'La Normal', 'Edificio A', 'Planta Baja', 'C.U. DE CS. SOCIALES Y HUMANIDADES', 'C.U. DE CS. SOCIALES Y HUMANIDADES', 'C.U. DE CS. SOCIALES Y HUMANIDADES', 'Sin imagen', 'Sin imagen', 1, '2022-02-05 20:02:58', '2023-02-23 19:09:51'),
(644, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio I', 'Planta Baja', 'División de Estudios Jurídicos', 'CTA', 'IDF Edificio I Planta Baja', 'Sin imagen', 'Sin imagen', 1, '2022-02-10 20:08:11', '2022-02-10 20:08:11'),
(645, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 1', 'División de Estudios Jurídicos', 'CTA', 'IDF Edificio I Piso 1', 'Sin imagen', 'Sin imagen', 1, '2022-02-10 20:08:12', '2022-02-10 20:08:12'),
(646, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 2', 'División de Estudios Jurídicos', 'CTA', 'IDF Edificio I Piso 2', 'Sin imagen', 'Sin imagen', 1, '2022-02-10 20:08:14', '2022-02-10 20:08:14'),
(647, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 3', 'División de Estudios Jurídicos', 'CTA', 'IDF Edificio I Piso 3', 'Sin imagen', 'Sin imagen', 1, '2022-02-10 20:08:17', '2022-02-10 20:08:17'),
(648, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 4', 'División de Estudios Jurídicos', 'CTA', 'IDF Edificio I Piso 4', 'Sin imagen', 'Sin imagen', 1, '2022-02-10 20:08:20', '2022-02-10 20:08:20'),
(649, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio C', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 23', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-14 21:35:30'),
(650, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio C', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 24', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-14 21:35:15'),
(651, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio C', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 25', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-14 21:34:29'),
(652, 0, 'Nunca', 'Aula', 'Proyector', 'Belenes', 'Edificio C', 'Piso 3', 'Secretaría Académica', 'CTA - Espacios Comunes', 'FBC 26', 'Sin imagen', 'Sin imagen', 1, '2021-03-23 17:30:00', '2022-02-14 21:34:16');
INSERT INTO `areas` (`id`, `cupo`, `ultimo_inventario`, `tipo_espacio`, `equipamiento`, `sede`, `edificio`, `piso`, `division`, `coordinacion`, `area`, `imagen_1`, `imagen_2`, `activo`, `created_at`, `updated_at`) VALUES
(653, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 3', 'División de Estudios Políticos y Sociales', 'División de Estudios Jurídicos', 'G 36', '1666374951G 36.jfif', '1666374951G 36.1.jfif', 1, '2021-09-16 01:50:31', '2022-10-21 17:55:51'),
(654, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'G 6', '1666371872G 6.jfif', '1666371872G 6.1.jfif', 1, '2021-09-16 01:34:03', '2023-01-19 21:47:49'),
(655, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 1', '1666208192WhatsApp Image 2022-09-28 at 13.38.35.jpeg', '1666208192WhatsApp Image 2022-09-28 at 13.38.35 (1).jpeg', 1, '2022-02-11 18:28:44', '2022-10-25 22:44:11'),
(656, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio I', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 2', '1666208824WhatsApp Image 2022-09-28 at 13.38.58.jpeg', '1666208824WhatsApp Image 2022-09-28 at 13.38.59.jpeg', 1, '2022-02-11 18:32:28', '2022-10-25 22:41:12'),
(657, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 3', '1644604473IMG_20220211_113338.jpg', '1644604473IMG_20220211_113353.jpg', 1, '2022-02-11 18:34:33', '2022-02-11 18:34:33'),
(658, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio I', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 4', '1666208931WhatsApp Image 2022-09-28 at 13.39.51.jpeg', '1666208931WhatsApp Image 2022-09-28 at 13.39.51 (1).jpeg', 1, '2022-02-11 18:38:28', '2022-10-25 22:41:30'),
(659, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 5', '1644604866IMG_20220211_113440.jpg', '1644604866IMG_20220211_113450.jpg', 1, '2022-02-11 18:41:06', '2022-02-11 18:41:06'),
(660, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio I', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 6', '1666209021WhatsApp Image 2022-09-28 at 13.40.25.jpeg', '1666209021WhatsApp Image 2022-09-28 at 13.40.25 (1).jpeg', 1, '2022-02-11 18:45:05', '2022-10-25 22:41:39'),
(661, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 1', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 7', '1666209094WhatsApp Image 2022-09-28 at 13.40.51.jpeg', '1666209094WhatsApp Image 2022-09-28 at 13.40.51 (1).jpeg', 1, '2022-02-11 18:47:09', '2022-10-19 19:51:34'),
(662, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio I', 'Piso 1', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 8', '1666209147WhatsApp Image 2022-09-28 at 13.41.11.jpeg', '1666209147WhatsApp Image 2022-09-28 at 13.41.11 (1).jpeg', 1, '2022-02-11 18:50:41', '2022-10-19 19:52:27'),
(663, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio I', 'Piso 1', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 9', '1666211152I 9.1.jfif', '1666211152I 9.2.jfif', 1, '2022-02-11 18:53:12', '2022-10-25 22:41:58'),
(664, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 1', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 10', '1666211222I 10.jfif', '1666211222I 10.1.jfif', 1, '2022-02-11 18:56:57', '2022-10-19 20:27:02'),
(665, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 1', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 11', '1666209404WhatsApp Image 2022-09-28 at 15.26.39.jpeg', '1666209404WhatsApp Image 2022-09-28 at 15.26.39 (1).jpeg', 1, '2022-02-11 18:59:23', '2022-10-19 19:56:44'),
(666, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio I', 'Piso 1', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 12', '1666209467WhatsApp Image 2022-09-28 at 15.27.16 (1).jpeg', '1666209467WhatsApp Image 2022-09-28 at 15.27.16.jpeg', 1, '2022-02-11 19:00:55', '2022-10-25 22:42:07'),
(667, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 1', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 13', '1666209522WhatsApp Image 2022-09-28 at 15.27.31.jpeg', '1666209522WhatsApp Image 2022-09-28 at 15.27.31 (1).jpeg', 1, '2022-02-11 19:03:15', '2022-10-19 19:58:42'),
(668, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio I', 'Piso 1', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 14', '1666209574WhatsApp Image 2022-09-28 at 15.27.54 (1).jpeg', '1666209574WhatsApp Image 2022-09-28 at 15.27.54.jpeg', 1, '2022-02-11 19:04:50', '2022-10-25 22:42:16'),
(669, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 1', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 15', '1666209644WhatsApp Image 2022-09-28 at 15.28.14.jpeg', '1666209644WhatsApp Image 2022-09-28 at 15.28.14 (1).jpeg', 1, '2022-02-11 19:06:42', '2022-10-19 20:00:44'),
(670, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 1', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 16', '1666209734WhatsApp Image 2022-09-28 at 15.28.42.jpeg', '1666209734WhatsApp Image 2022-09-28 at 15.28.42 (1).jpeg', 1, '2022-02-11 19:08:22', '2022-10-19 20:02:14'),
(671, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio I', 'Piso 2', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 17', '1666209780WhatsApp Image 2022-09-28 at 15.29.03.jpeg', '1666209780WhatsApp Image 2022-09-28 at 15.29.03 (1).jpeg', 1, '2022-02-11 19:10:12', '2022-10-25 22:42:24'),
(672, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio I', 'Piso 2', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 18', '1666209818WhatsApp Image 2022-09-28 at 15.29.22.jpeg', '1666209818WhatsApp Image 2022-09-28 at 15.29.22 (1).jpeg', 1, '2022-02-11 19:11:34', '2022-10-25 22:42:33'),
(673, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio I', 'Piso 2', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 19', '1666209873WhatsApp Image 2022-09-28 at 15.29.38.jpeg', '1666209873WhatsApp Image 2022-09-28 at 15.29.38 (1).jpeg', 1, '2022-02-11 19:12:38', '2022-10-19 20:04:33'),
(674, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio I', 'Piso 2', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 20', '1666209922WhatsApp Image 2022-09-28 at 15.30.00.jpeg', '1666209922WhatsApp Image 2022-09-28 at 15.30.01.jpeg', 1, '2022-02-11 19:14:06', '2022-10-25 22:42:48'),
(675, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 2', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 21', '1666210965WhatsApp Image 2022-10-19 at 15.22.05.jpeg', '1666210965WhatsApp Image 2022-10-19 at 15.22.05 (1).jpeg', 1, '2022-02-11 19:15:29', '2022-10-19 20:22:45'),
(676, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio I', 'Piso 2', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 22', '1666209970WhatsApp Image 2022-09-28 at 15.30.19.jpeg', '1666209970WhatsApp Image 2022-09-28 at 15.30.19 (1).jpeg', 1, '2022-02-11 19:17:14', '2022-10-25 22:42:57'),
(677, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio I', 'Piso 2', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 23', '1666210015WhatsApp Image 2022-09-28 at 15.30.47.jpeg', '1666210015WhatsApp Image 2022-09-28 at 15.30.47 (1).jpeg', 1, '2022-02-11 19:19:02', '2022-10-25 22:43:06'),
(678, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 2', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 24', '1666210064WhatsApp Image 2022-09-28 at 15.31.05.jpeg', '1666210064WhatsApp Image 2022-09-28 at 15.31.05 (1).jpeg', 1, '2022-02-11 19:21:03', '2022-10-19 20:07:44'),
(679, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 2', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 25', '1666210130WhatsApp Image 2022-09-28 at 15.31.30.jpeg', '1666210130WhatsApp Image 2022-09-28 at 15.31.30 (1).jpeg', 1, '2022-02-11 19:23:04', '2022-10-19 20:08:50'),
(680, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio I', 'Piso 2', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 26', '1666210185WhatsApp Image 2022-09-28 at 15.31.45.jpeg', '1666210185WhatsApp Image 2022-09-28 at 15.31.45 (1).jpeg', 1, '2022-02-11 19:25:27', '2022-10-25 22:43:15'),
(681, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 3', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 27', '1666210438WhatsApp Image 2022-09-28 at 15.31.59.jpeg', '1666210438WhatsApp Image 2022-09-28 at 15.31.59 (1).jpeg', 1, '2022-02-11 19:27:39', '2022-10-25 22:44:21'),
(682, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 3', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 28', '1666210485WhatsApp Image 2022-09-28 at 15.32.16.jpeg', '1666210485WhatsApp Image 2022-09-28 at 15.32.16 (1).jpeg', 1, '2022-02-11 19:28:52', '2022-10-19 20:14:45'),
(683, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 3', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 29', '1666210521WhatsApp Image 2022-09-28 at 15.32.31.jpeg', '1666210521WhatsApp Image 2022-09-28 at 15.32.31 (1).jpeg', 1, '2022-02-11 19:32:08', '2022-10-19 20:15:21'),
(684, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 3', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 30', '1666209714I 30.1.jfif', '1666209714I 30.2.jfif', 1, '2022-02-11 20:06:06', '2022-10-19 20:01:54'),
(685, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 3', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 31', '1666209836I 31.jfif', '1666209836I 31.1.jfif', 1, '2022-02-11 20:12:27', '2022-10-19 20:03:56'),
(686, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 3', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 32', '1666209941I 32.jfif', '1666209941I 32.1.jfif', 1, '2022-02-11 20:18:10', '2022-10-19 20:05:41'),
(687, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 3', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 33', '1666210010I 33.jfif', '1666210010I 33.1.jfif', 1, '2022-02-11 20:22:56', '2022-10-19 20:06:50'),
(688, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 3', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 34', '1666210060I 34.jfif', '1666210060I 34.1.jfif', 1, '2022-02-11 20:24:17', '2022-10-19 20:07:40'),
(689, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 3', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 36', '1666210179I 36.jfif', '1666210179I 36.1.jfif', 1, '2022-02-11 20:29:29', '2022-10-19 20:09:39'),
(690, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 3', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 35', '1666210135I 35.jfif', '1666210135I 35.1.jfif', 1, '2022-02-11 20:29:33', '2022-10-19 20:08:55'),
(691, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 3', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 37', '1666210220I 37.jfif', '1666210220I 37.1.jfif', 1, '2022-02-11 20:33:16', '2022-10-19 20:10:20'),
(692, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 3', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'I 38', '1666210285I 38.jfif', '1666210285I 38.1.jfif', 1, '2022-02-11 20:33:16', '2022-10-19 20:11:25'),
(693, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Planta Baja', 'Secretaría Administrativa', 'Coordinación de Personal', 'Unidad de Contratos Civiles y Laboratorios', 'Sin imagen', 'Sin imagen', 1, '2022-02-12 19:30:10', '2022-02-12 19:30:10'),
(694, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Planta Baja', 'Secretaría Administrativa', 'Coordinación de Personal', 'Unidad de Personal Académico', 'Sin imagen', 'Sin imagen', 1, '2022-02-12 19:33:58', '2022-02-12 19:33:58'),
(695, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Planta Baja', 'Secretaría Administrativa', 'Coordinación de Personal', 'Unidad de Personal Administrativo', 'Sin imagen', 'Sin imagen', 1, '2022-02-12 19:35:19', '2022-02-12 19:35:19'),
(696, 0, 'Nunca', 'Aula', 'Sin Equipo', 'La Normal', 'Edificio L', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'CTA - Espacion comunes', 'L 79', 'Sin imagen', 'Sin imagen', 1, '2022-02-14 21:05:00', '2022-02-14 21:05:00'),
(697, 0, 'Nunca', 'Aula', 'Sin Equipo', 'La Normal', 'Edificio L', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'CTA - Espacion comunes', 'L 80', 'Sin imagen', 'Sin imagen', 1, '2022-02-14 21:06:52', '2022-02-14 21:06:52'),
(698, 0, 'Nunca', 'Aula', 'Sin Equipo', 'La Normal', 'Edificio N', 'Planta Baja', 'C.U. DE CS. SOCIALES Y HUMANIDADES', 'CTA - Espacion comunes', 'N 156', 'Sin imagen', 'Sin imagen', 1, '2022-02-16 16:21:47', '2022-02-16 16:21:47'),
(699, 0, 'Nunca', 'Aula', 'Sin Equipo', 'La Normal', 'Edificio O', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'CTA - Espacion comunes', 'O 109', 'Sin imagen', 'Sin imagen', 1, '2022-02-16 16:32:47', '2022-02-16 16:32:47'),
(700, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio Servicios Generales Belenes', 'Piso 1', 'Secretaría Administrativa', 'Servicios Generales, Coordinación', 'Unidad de Mantenimiento', 'Sin imagen', 'Sin imagen', 1, '2022-02-21 14:23:13', '2023-02-28 20:41:36'),
(701, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'Sala de Juicios Orales', '1665253115SALA DE JUICIOS2.jpeg', '1665253115SALA DE JUICIOS.jpeg', 1, '2022-02-23 16:16:18', '2022-10-08 18:18:35'),
(702, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Planta Baja', 'Rectoría', 'Rectoría', 'Sala de exposiciones planta baja', 'Sin imagen', 'Sin imagen', 1, '2022-03-05 16:44:29', '2022-03-05 16:44:29'),
(703, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio I', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'Auditorio 1 (Edificio \"I\"), Planta Baja.', 'Sin imagen', 'Sin imagen', 1, '2022-03-08 17:58:38', '2022-03-08 18:54:36'),
(704, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio I', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'Auditorio 2 (Edificio \"I\"), Planta Baja.', 'Sin imagen', 'Sin imagen', 1, '2022-03-08 18:03:06', '2022-03-08 18:55:51'),
(705, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 4', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'Sin imagen', 'Sin imagen', 1, '2022-03-10 16:45:25', '2022-03-10 16:45:25'),
(706, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 4', 'División de Estudios Jurídicos', 'Doctorado en Derecho', 'Doctorado en Derecho', 'Sin imagen', 'Sin imagen', 1, '2022-03-10 16:47:23', '2022-03-10 16:47:23'),
(707, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 4', 'División de Estudios Jurídicos', 'Departamento de Disciplinas sobre el Derecho', 'Departamento de Disciplinas sobre el Derecho', 'Sin imagen', 'Sin imagen', 1, '2022-03-10 16:58:29', '2022-03-10 16:58:29'),
(708, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 4', 'División de Estudios Jurídicos', 'Departamento de Derecho Social', 'Depto. de Derecho Social y Disciplinas sobre el Derecho', 'Sin imagen', 'Sin imagen', 1, '2022-03-10 16:59:55', '2022-03-10 16:59:55'),
(709, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 4', 'División de Estudios Jurídicos', 'Departamento de Derecho Público', 'Departamento de Derecho Público', 'Sin imagen', 'Sin imagen', 1, '2022-03-10 17:01:10', '2022-03-10 17:01:10'),
(710, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 4', 'División de Estudios Jurídicos', 'Departamento de Derecho Privado', 'Departamento de Derecho Privado', 'Sin imagen', 'Sin imagen', 1, '2022-03-10 17:01:49', '2022-09-09 18:20:50'),
(711, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 4', 'División de Estudios Jurídicos', 'Departamento de Derecho Global', 'Departamento de Derecho Global', 'Sin imagen', 'Sin imagen', 1, '2022-03-10 17:02:27', '2022-03-10 17:02:27'),
(712, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 4', 'División de Estudios Jurídicos', 'Maestría en Derecho', 'Coordinación en la Maestría en Derecho', 'Sin imagen', 'Sin imagen', 1, '2022-03-10 17:05:19', '2022-03-10 17:05:19'),
(713, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 4', 'División de Estudios Jurídicos', 'Departamento de Derecho Público', 'C. de Investigación Observatorio sobre Seguridad', 'Sin imagen', 'Sin imagen', 1, '2022-03-10 17:06:37', '2022-03-10 17:06:37'),
(714, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 4', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'Sala de Directores', 'Sin imagen', 'Sin imagen', 1, '2022-03-10 17:07:29', '2022-03-10 17:07:29'),
(715, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 4', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'Sala de Juicios Orales: Mariano Otero', 'Sin imagen', 'Sin imagen', 1, '2022-03-10 17:08:27', '2022-03-10 17:08:27'),
(716, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 4', 'División de Estudios Jurídicos', 'Coordinación de Carrera Presencial de Licenciatura en Derecho', 'Licenciatura en Derecho Presencial', 'Sin imagen', 'Sin imagen', 1, '2022-03-10 17:15:42', '2023-03-01 20:55:01'),
(717, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 4', 'División de Estudios Jurídicos', 'Coordinación de Carrera Semipresencial de Licenciatura en Derecho', 'Coordinación de Carrera Semipresencial de Licenciatura en Derecho', 'Sin imagen', 'Sin imagen', 1, '2022-03-10 17:19:24', '2022-03-10 17:19:24'),
(718, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio I', 'Piso 4', 'División de Estudios Jurídicos', 'Coordinación de la Maestría en Ciencias Forenses y Criminología', 'Coordinación de la Maestría en Ciencias Forenses y Criminología', 'Sin imagen', 'Sin imagen', 1, '2022-03-10 17:20:57', '2022-09-12 18:34:22'),
(719, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 4', 'División de Estudios Jurídicos', 'Departamento de Estudios Interdisciplinarios en Ciencias Penales', 'Departamento de Estudios Interdisciplinarios en Ciencias Penales', 'Sin imagen', 'Sin imagen', 1, '2022-03-10 17:23:45', '2022-03-10 17:23:45'),
(720, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 4', 'División de Estudios Jurídicos', 'Coord. de carreras semiescolarizadas.', 'Coordinación de carreras Semi-escolarizadas', 'Sin imagen', 'Sin imagen', 1, '2022-03-10 20:31:35', '2022-03-10 20:31:35'),
(721, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio Servicios Generales Belenes', 'Planta Baja', 'Secretaría Administrativa', 'Coordinación de Servicios Generales', 'Unidad Médica y Protección Civil Belenes', 'Sin imagen', 'Sin imagen', 1, '2022-03-17 17:45:15', '2022-03-17 17:45:15'),
(722, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio F', 'Piso 2', 'División de Estudios Políticos y Sociales', 'Depto. de Sociología', 'Lab. de Estudios de Violencia (LESVI)', 'Sin imagen', 'Sin imagen', 1, '2022-04-25 16:54:19', '2022-04-25 16:54:19'),
(723, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio A', 'Piso 1', 'División de Estudios de la Cultura', 'departamento de estudios literarios', 'maestria en licenciaturas interamericanas', 'Sin imagen', 'Sin imagen', 1, '2022-04-27 18:43:28', '2022-04-27 18:43:28'),
(724, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'Rectoría', 'Rectoría', 'Secretaria privada', 'Sin imagen', 'Sin imagen', 0, '2022-06-27 18:12:55', '2022-12-08 17:26:39'),
(725, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 3', 'Rectoría', 'Rectoría', 'Proyectos Digitalización Secretaria Privada', 'Sin imagen', 'Sin imagen', 1, '2022-06-27 18:18:50', '2022-06-27 18:18:50'),
(726, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 2', 'Secretaría Administrativa', 'CTA', 'Diseño web', 'Sin imagen', 'Sin imagen', 1, '2022-06-27 18:58:50', '2022-08-19 19:40:18'),
(727, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'La Normal', 'Edificio G', 'Piso 1', 'Rectoría', 'Congreso ALAS', 'Congreso ALAS', 'Sin imagen', 'Sin imagen', 1, '2022-08-10 16:20:22', '2022-08-10 16:20:56'),
(728, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 2', 'Secretaría Académica', 'CTA', 'Soporte', 'Sin imagen', 'Sin imagen', 1, '2022-08-19 19:44:59', '2022-08-19 19:44:59'),
(729, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'Secretaría Administrativa', 'Secretaría Administrativa', 'Secretaría Administrativa', 'Sin imagen', 'Sin imagen', 1, '2022-08-26 16:23:59', '2022-08-26 16:23:59'),
(730, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 3', 'Secretaría Administrativa', 'Unidad de transparencia', 'Unidad de Transparencia', 'Sin imagen', 'Sin imagen', 1, '2022-09-01 20:22:37', '2022-09-05 15:46:51'),
(731, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'Secretaría Académica', 'Coordinación de Planeación', 'Coordinación de Planeación', 'Sin imagen', 'Sin imagen', 1, '2022-09-05 15:59:25', '2022-09-05 15:59:25'),
(732, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'Secretaría Académica', 'Coordinación de Planeación', 'Unidad de Planeación', 'Sin imagen', 'Sin imagen', 1, '2022-09-05 16:25:03', '2022-09-05 16:25:03'),
(733, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 3', 'Secretaría Administrativa', 'Coordinación de Finanzas', 'Unidad de Presupuesto', 'Sin imagen', 'Sin imagen', 1, '2022-09-14 15:13:20', '2022-09-14 15:13:20'),
(734, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 3', 'Secretaría Administrativa', 'Coordinación de Finanzas', 'Unidad de Nóminas', 'Sin imagen', 'Sin imagen', 1, '2022-09-14 15:37:04', '2022-09-14 15:37:04'),
(735, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 3', 'Secretaría Administrativa', 'Coordinación de Finanzas', 'Unidad de Ingresos Autogenerados', 'Sin imagen', 'Sin imagen', 1, '2022-09-14 15:43:21', '2022-09-14 15:43:21'),
(736, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 3', 'Secretaría Administrativa', 'Coordinación de Finanzas', 'Unidad de Contabilidad y Control Interno', 'Sin imagen', 'Sin imagen', 1, '2022-09-14 15:48:41', '2022-09-14 15:48:41'),
(737, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'Secretaría Académica', 'Coordinación de Posgrado', 'Unidad de Posgrado', 'Sin imagen', 'Sin imagen', 1, '2022-09-14 16:24:50', '2022-09-14 16:24:50'),
(738, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'Secretaría Académica', 'Coordinación de Investigación', 'Unidad de Investigación', 'Sin imagen', 'Sin imagen', 1, '2022-09-19 13:24:28', '2022-09-19 13:24:28'),
(739, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio Servicios Generales Belenes', 'Piso 1', 'Secretaría Administrativa', 'Coordinación de Servicios Generales', 'Coordinación de Servicios Generales', 'Sin imagen', 'Sin imagen', 1, '2022-09-19 13:36:30', '2022-09-19 13:36:30'),
(740, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 2', 'Secretaría Académica', 'CTA', 'Librero Coordinación CTA', 'Sin imagen', 'Sin imagen', 1, '2022-09-21 17:15:36', '2022-09-21 17:15:36'),
(741, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'Rectoría', 'Rectoría', 'Secretaría Técnica', 'Sin imagen', 'Sin imagen', 1, '2022-10-05 15:31:19', '2022-10-05 15:31:19'),
(742, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'Rectoría', 'Rectoría', 'Secretaría Privada', 'Sin imagen', 'Sin imagen', 1, '2022-10-05 15:40:21', '2022-10-05 15:40:21'),
(743, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Laboratorio de Arqueología', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Historia, Departamento de', 'Laboratorio de Arqueología', 'Sin imagen', 'Sin imagen', 1, '2022-10-27 19:01:15', '2023-04-19 19:05:08'),
(744, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 3', 'C.U. DE CS. SOCIALES Y HUMANIDADES', 'Sindicato', 'Delegación Academica', 'Sin imagen', 'Sin imagen', 1, '2022-10-31 20:39:17', '2022-10-31 20:39:17'),
(745, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 3', 'Secretaría Administrativa', 'Rectoría', 'Sala de Juntas E piso 3', 'Sin imagen', 'Sin imagen', 1, '2022-11-14 20:59:04', '2022-11-14 20:59:04'),
(746, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio H', 'Planta Baja', 'Secretaría Administrativa', 'CTA', 'IDF Edificio H Planta Baja', 'Sin imagen', 'Sin imagen', 1, '2022-11-25 22:47:40', '2022-11-25 22:47:40'),
(747, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 1', 'Secretaría Administrativa', 'CTA', 'Aula 1', 'Sin imagen', 'Sin imagen', 0, '2022-11-25 23:40:36', '2023-01-19 21:48:07'),
(748, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio H', 'Planta Baja', 'Secretaría Administrativa', 'CTA', 'Auditorio', 'Sin imagen', 'Sin imagen', 0, '2022-11-25 23:52:55', '2022-11-25 23:58:51'),
(749, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio H', 'Planta Baja', 'Secretaría Administrativa', 'CTA', 'Auditorio Edificio H', 'Sin imagen', 'Sin imagen', 1, '2022-11-25 23:58:21', '2022-11-25 23:58:21'),
(750, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Planta Baja', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 1', 'Sin imagen', 'Sin imagen', 1, '2022-11-26 16:23:55', '2022-12-14 22:33:44'),
(751, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Planta Baja', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 2', 'Sin imagen', 'Sin imagen', 1, '2022-11-26 16:24:34', '2022-12-14 22:36:50'),
(752, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Planta Baja', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 5', 'Sin imagen', 'Sin imagen', 1, '2022-11-26 16:25:04', '2022-12-14 22:39:18'),
(753, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Planta Baja', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 6', 'Sin imagen', 'Sin imagen', 1, '2022-11-26 16:26:03', '2022-12-14 22:49:54'),
(754, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Piso 1', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 8', 'Sin imagen', 'Sin imagen', 1, '2022-11-26 16:26:32', '2023-02-09 19:15:09'),
(755, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Piso 1', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 9', 'Sin imagen', 'Sin imagen', 1, '2022-11-26 16:27:08', '2023-02-09 19:16:01'),
(756, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Piso 1', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 12', 'Sin imagen', 'Sin imagen', 1, '2022-11-26 16:27:33', '2023-02-09 19:16:27'),
(757, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Piso 1', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 13', 'Sin imagen', 'Sin imagen', 1, '2022-11-26 16:28:42', '2022-12-14 22:56:42'),
(758, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Piso 1', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 16', 'Sin imagen', 'Sin imagen', 1, '2022-11-26 16:29:05', '2022-12-14 22:57:32'),
(759, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Piso 2', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 17', 'Sin imagen', 'Sin imagen', 1, '2022-11-26 16:29:28', '2023-02-09 19:19:20'),
(760, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Piso 2', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 20', 'Sin imagen', 'Sin imagen', 1, '2022-11-26 16:29:55', '2023-02-09 19:19:47'),
(761, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Piso 2', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 21', 'Sin imagen', 'Sin imagen', 1, '2022-11-26 16:30:27', '2023-02-09 19:20:09'),
(762, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Piso 2', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 24', 'Sin imagen', 'Sin imagen', 1, '2022-11-26 16:30:50', '2023-02-09 19:20:36'),
(763, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Piso 2', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 25', 'Sin imagen', 'Sin imagen', 1, '2022-11-26 16:31:23', '2023-02-09 19:20:54'),
(764, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio H', 'Piso 3', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 28', 'Sin imagen', 'Sin imagen', 1, '2022-11-26 16:31:50', '2023-02-09 19:22:16'),
(765, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio H', 'Piso 3', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 29', 'Sin imagen', 'Sin imagen', 1, '2022-11-26 16:32:15', '2023-02-09 19:22:39'),
(766, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio H', 'Piso 3', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 32', 'Sin imagen', 'Sin imagen', 1, '2022-11-26 16:32:55', '2022-12-14 23:19:50'),
(767, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio H', 'Piso 3', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 33', 'Sin imagen', 'Sin imagen', 1, '2022-11-26 16:33:20', '2022-12-14 23:20:32'),
(768, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio H', 'Piso 3', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 35', 'Sin imagen', 'Sin imagen', 1, '2022-11-26 16:33:47', '2022-12-14 23:21:18'),
(769, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio H', 'Piso 3', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 38', 'Sin imagen', 'Sin imagen', 1, '2022-11-26 16:34:07', '2022-12-14 23:26:01'),
(770, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio C', 'Planta Baja', 'División de Estudios Jurídicos', 'Rectoría', 'Sala de Juntas Tutorías', 'Sin imagen', 'Sin imagen', 1, '2022-11-28 23:32:25', '2022-11-28 23:32:25'),
(771, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio A', 'Piso 2', 'División de Estudios de la Cultura', 'Departamento de Estudios Mesoamericanos y Mexicanos', 'Maestría en Estudios Mesoamericanos', 'Sin imagen', 'Sin imagen', 1, '2022-12-05 21:03:09', '2022-12-05 21:04:06'),
(772, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 3', 'División de Estudios Jurídicos', 'DIVISION DE ESTUDIOS JURIDICOS', 'G 38', 'Sin imagen', 'Sin imagen', 1, '2022-12-07 22:32:09', '2022-12-07 22:32:09'),
(773, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'Secretaría Académica', 'Coordinación de Docencia', 'Unidad de Seguimiento de los Procesos de Calidad de los Programas Educativos', 'Sin imagen', 'Sin imagen', 1, '2022-12-13 15:41:36', '2022-12-13 15:41:36'),
(774, 0, 'Nunca', 'Administrativa', 'Sin Equipo', 'Belenes', 'Edificio H', 'Planta Baja', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 3', 'Sin imagen', 'Sin imagen', 1, '2022-12-13 18:33:12', '2022-12-13 18:34:25'),
(775, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Planta Baja', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 4', 'Sin imagen', 'Sin imagen', 1, '2022-12-13 18:33:57', '2022-12-14 22:55:56'),
(776, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Piso 1', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 7', 'Sin imagen', 'Sin imagen', 1, '2022-12-13 18:43:09', '2022-12-14 23:06:27'),
(777, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Piso 1', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 10', 'Sin imagen', 'Sin imagen', 1, '2022-12-13 18:44:02', '2022-12-14 23:15:55'),
(778, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Piso 2', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'H 23', 'Sin imagen', 'Sin imagen', 1, '2022-12-13 18:45:32', '2022-12-14 23:22:43'),
(779, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Piso 2', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'H 22', 'Sin imagen', 'Sin imagen', 1, '2022-12-13 18:48:26', '2022-12-14 23:23:23'),
(780, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Piso 2', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'H 19', 'Sin imagen', 'Sin imagen', 1, '2022-12-13 18:51:38', '2022-12-14 23:24:08'),
(781, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Piso 2', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'H 18', 'Sin imagen', 'Sin imagen', 1, '2022-12-13 18:53:34', '2022-12-14 23:24:50'),
(782, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Piso 1', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 11', 'Sin imagen', 'Sin imagen', 1, '2022-12-13 18:55:00', '2022-12-14 23:17:01'),
(783, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Piso 1', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 14', 'Sin imagen', 'Sin imagen', 1, '2022-12-13 18:56:21', '2022-12-14 23:18:19'),
(784, 0, 'Nunca', 'Aula', 'TV,PC', 'Belenes', 'Edificio H', 'Piso 1', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 15', 'Sin imagen', 'Sin imagen', 1, '2022-12-13 18:56:56', '2022-12-14 22:29:47'),
(785, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio H', 'Piso 2', 'División de Estudios Jurídicos', 'División de estudios jurídicos', 'H 26', 'Sin imagen', 'Sin imagen', 1, '2022-12-13 19:10:55', '2022-12-13 19:10:55'),
(786, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio C', 'Piso 3', 'División de Estudios Políticos y Sociales', 'Departamento de Sociología', 'Revista Vinculos', 'Sin imagen', 'Sin imagen', 1, '2023-01-24 18:09:10', '2023-01-24 18:09:10'),
(787, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio G', 'Piso 4', 'División de Estudios Jurídicos', 'Estudios Juridicos', 'Dirección de estudios juridicos', 'Sin imagen', 'Sin imagen', 1, '2023-01-26 15:50:35', '2023-01-26 15:50:35'),
(788, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'La Normal', 'Edificio G', 'Piso 2', 'División de Estudios Jurídicos', 'Revista Derecho Global CUCSH', 'Revista Derecho Global CUCSH', 'Sin imagen', 'Sin imagen', 1, '2023-02-07 16:23:39', '2023-02-07 16:23:39'),
(789, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio F', 'Piso 1', 'División de Estudios Políticos y Sociales', 'Sociología', 'Maestría en sociología', 'Sin imagen', 'Sin imagen', 1, '2023-02-09 18:51:54', '2023-02-09 18:51:54'),
(790, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio H', 'Planta Baja', 'División de Estudios Jurídicos', 'Division de estudios juridicos', 'H 3', 'Sin imagen', 'Sin imagen', 1, '2023-02-09 19:00:11', '2023-02-09 19:00:11'),
(791, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio H', 'Piso 3', 'División de Estudios Jurídicos', 'Division de estudios juridicos', 'H 27', 'Sin imagen', 'Sin imagen', 1, '2023-02-09 19:02:08', '2023-02-09 19:02:08'),
(792, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio H', 'Piso 3', 'División de Estudios Jurídicos', 'Division de estudios juridicos', 'H 30', 'Sin imagen', 'Sin imagen', 1, '2023-02-09 19:03:05', '2023-02-09 19:03:05'),
(793, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio H', 'Piso 3', 'División de Estudios Jurídicos', 'Division de estudios juridicos', 'H 31', 'Sin imagen', 'Sin imagen', 1, '2023-02-09 19:04:22', '2023-02-09 19:04:22'),
(794, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio H', 'Piso 3', 'División de Estudios Jurídicos', 'Division de estudios juridicos', 'H 34', 'Sin imagen', 'Sin imagen', 1, '2023-02-09 19:05:33', '2023-02-09 19:05:33'),
(795, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio H', 'Piso 3', 'División de Estudios Jurídicos', 'Division de estudios juridicos', 'H 36', 'Sin imagen', 'Sin imagen', 1, '2023-02-09 19:06:37', '2023-02-09 19:06:37'),
(796, 0, 'Nunca', 'Aula', 'Sin Equipo', 'Belenes', 'Edificio H', 'Piso 3', 'División de Estudios Jurídicos', 'Division de estudios juridicos', 'H 37', 'Sin imagen', 'Sin imagen', 1, '2023-02-09 19:07:29', '2023-02-09 19:07:29'),
(797, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio Servicios Generales Belenes', 'Planta Baja', 'C.U. DE CS. SOCIALES Y HUMANIDADES', 'Secretaría Particular', 'Unidad de Mensajería y Transporte', 'Sin imagen', 'Sin imagen', 1, '2023-02-17 16:46:57', '2023-02-28 19:42:25'),
(798, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 2', 'Rectoría', 'Rectoría', 'Comedor', 'Sin imagen', 'Sin imagen', 1, '2023-02-17 17:49:00', '2023-02-17 17:49:00'),
(799, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio I', 'Planta Baja', 'División de Estudios Jurídicos', 'División de Estudios Jurídicos', 'Auditorio Edificio I', 'Sin imagen', 'Sin imagen', 1, '2023-02-21 17:22:06', '2023-02-21 17:22:06'),
(800, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio E', 'Planta Baja', 'Secretaría Administrativa', 'COORD. DE CONTROL ESCOLAR', 'Atención', 'Sin imagen', 'Sin imagen', 1, '2023-02-26 00:26:22', '2023-02-26 00:27:37'),
(801, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 3', 'Rectoría', 'Rectoría', 'Recepción Edificio E Piso 3', 'Sin imagen', 'Sin imagen', 1, '2023-02-27 20:34:32', '2023-02-27 20:34:32'),
(802, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio H', 'Piso 3', 'División de Estudios Jurídicos', 'CTA', 'IDF Edificio H Piso 3', 'Sin imagen', 'Sin imagen', 1, '2023-02-27 21:16:34', '2023-02-27 21:19:53'),
(803, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio H', 'Piso 4', 'División de Estudios Jurídicos', 'CTA', 'IDF Edificio H Piso 4', 'Sin imagen', 'Sin imagen', 1, '2023-02-27 21:17:17', '2023-02-27 21:19:42'),
(804, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio H', 'Piso 2', 'División de Estudios Jurídicos', 'CTA', 'IDF Edificio H Piso 2', 'Sin imagen', 'Sin imagen', 1, '2023-02-27 21:17:37', '2023-02-27 21:18:21'),
(805, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio H', 'Piso 1', 'División de Estudios Jurídicos', 'CTA', 'IDF Edificio H Piso 1', 'Sin imagen', 'Sin imagen', 1, '2023-02-27 21:17:51', '2023-02-27 21:18:10'),
(806, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio C', 'Piso 1', 'División de Estudios de Estado y Sociedad', 'DEPTO. DE ESTUDIOS SOCIO URBANOS', 'DOCTORADO EN CIENCIAS SOCIALES', 'Sin imagen', 'Sin imagen', 1, '2023-02-28 20:46:59', '2023-02-28 20:46:59'),
(807, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio A', 'Piso 1', 'División de Estudios de la Cultura', 'Depto. de Estudios de la Comunicación Social', 'Licenciatura en Comunicación Pública', 'Sin imagen', 'Sin imagen', 1, '2023-03-01 19:53:21', '2023-03-01 19:53:21'),
(808, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'Secretaría Académica', 'Secretaría Académica', 'Unidad de Vinculación', 'Sin imagen', 'Sin imagen', 1, '2023-03-01 20:14:52', '2023-03-01 20:14:52'),
(809, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'C.U. DE CS. SOCIALES Y HUMANIDADES', 'Rectoría', 'Rectoría', 'Sin imagen', 'Sin imagen', 1, '2023-03-01 20:40:41', '2023-03-01 20:40:41'),
(810, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'Secretaría Académica', 'Coord. de Posgrado', 'Coord. de Posgrado', 'Sin imagen', 'Sin imagen', 1, '2023-03-01 20:50:19', '2023-03-01 20:50:19'),
(811, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'Secretaría Académica', 'Coord. de Docencia', 'Coord. de Docencia', 'Sin imagen', 'Sin imagen', 1, '2023-03-01 21:06:26', '2023-03-01 21:06:26'),
(812, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio F 3', 'Piso 3', 'División de Estudios Políticos y Sociales', 'Departamento de Sociología', 'Centro sobre la Violencia (antes CESCI)', 'Sin imagen', 'Sin imagen', 1, '2023-03-01 23:38:21', '2023-03-01 23:38:21'),
(813, 0, 'Nunca', 'Auditorio', 'Sin Equipo', 'Belenes', 'Edificio D', 'Planta Baja', 'Rectoría', 'Rectoria', 'Auditorio Rosario Castellano', 'Sin imagen', 'Sin imagen', 1, '2023-03-06 20:44:46', '2023-03-06 20:44:46'),
(814, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 2', 'Secretaría Académica', 'CTA', 'Bajas por robo', 'Sin imagen', 'Sin imagen', 1, '2023-03-13 17:13:56', '2023-03-13 17:13:56'),
(815, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio F 4', 'Piso 1', 'División de Estudios de Estado y Sociedad', 'Departamento de Estudios en Educación', 'Maestría en Estudios de Género', 'Sin imagen', 'Sin imagen', 1, '2023-03-16 18:00:45', '2023-03-16 18:02:00'),
(816, 0, 'Nunca', 'Laboratorio', 'Sin Equipo', 'La Normal', 'Edificio Q', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Departamento de Geografía y Ordenación Territorial', 'Laboratorio de Geografia', 'Sin imagen', 'Sin imagen', 1, '2023-03-17 15:43:02', '2023-03-21 16:54:44'),
(817, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 2', 'Secretaría Académica', 'Servicios Académicos', 'Primer Contacto', 'Sin imagen', 'Sin imagen', 1, '2023-03-17 19:26:34', '2023-03-17 19:26:34'),
(818, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio F 4', 'Planta Baja', 'División de Estudios Históricos y Humanos', 'Departamento de Lenguas Modernas', 'Centro de Lenguas Extranjeras (CELEX)', 'Sin imagen', 'Sin imagen', 1, '2023-03-23 17:56:35', '2023-03-23 17:56:35'),
(819, 0, 'Nunca', 'Administrativo', 'Sin Equipo', 'Belenes', 'Edificio E', 'Piso 4', 'Rectoría', 'Rectoría', 'Rectoría', 'Sin imagen', 'Sin imagen', 1, '2023-03-23 21:01:39', '2023-03-23 21:01:39'),
(820, 0, 'Nunca', 'Auditorio', 'Sin Equipo', 'La Normal', 'Edificio C', 'Planta Baja', 'Núcleo de Auditorios', 'Servicios Generales', 'Auditorio Carlos Ramírez Ladewig', 'Sin imagen', 'Sin imagen', 1, '2023-04-20 19:01:04', '2023-04-20 19:01:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nrc` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `curso_nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observaciones` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departamento` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alumnos_registrados` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `nivel` enum('licenciatura','maestria','doctorado') COLLATE utf8mb4_unicode_ci NOT NULL,
  `profesor` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dia` enum('lunes','martes','miercoles','jueves','viernes','sabado') COLLATE utf8mb4_unicode_ci NOT NULL,
  `horario` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_curso` bigint(20) UNSIGNED DEFAULT NULL,
  `id_area` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_04_21_212519_create_sessions_table', 1),
(7, '2023_04_24_184028_create_cursos_table', 1),
(8, '2023_04_24_184206_create_horarios_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ZDskGRaD5bQJIqCdkN3nk5xMUtiNHVaANZCcwX79', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiV3RhdTFXSFA2OXZralZteFVzNlZTWUE0RHNzeFNrelZMbkNkQkFrMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly9sb2NhbGhvc3QvY3Vyc29zQ1RBL3B1YmxpYy9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEwJDNWbGo3YlI5U3dkRWd6d1ZqSEN6VWU1aEt0MVZFZnFyUWNOOTh5a0t3LmEuRTdtWGJhRUllIjt9', 1682366325);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Omar Guzman', 'omar@gmail.com', NULL, '$2y$10$3Vlj7bR9SwdEgzwVjHCzUe5hKt1VEfqrQcN98ykKw.a.E7mXbaEIe', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-25 01:58:44', '2023-04-25 01:58:44');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `horarios_id_curso_foreign` (`id_curso`),
  ADD KEY `horarios_id_area_foreign` (`id_area`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=821;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_id_area_foreign` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`),
  ADD CONSTRAINT `horarios_id_curso_foreign` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
