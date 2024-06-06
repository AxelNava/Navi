-- phpMyAdmin SQL Dump
-- version 5.2.1-4.fc40
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 06-06-2024 a las 03:14:43
-- Versión del servidor: 10.11.6-MariaDB
-- Versión de PHP: 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `navi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_bioquimicos`
--

CREATE TABLE `api_bioquimicos` (
  `id_bioquimico` int(11) NOT NULL,
  `id_consulta_paciente` int(11) NOT NULL,
  `glucosa` smallint(6) NOT NULL,
  `hbAc1` tinyint(4) NOT NULL,
  `TG` decimal(10,2) NOT NULL,
  `CT` decimal(10,2) NOT NULL,
  `HDL` decimal(10,2) NOT NULL,
  `LDL` decimal(10,2) NOT NULL,
  `AST_perc` tinyint(4) NOT NULL,
  `ALT` decimal(10,2) NOT NULL,
  `TSH` decimal(10,2) NOT NULL,
  `T3` decimal(10,2) NOT NULL,
  `T4` decimal(10,2) NOT NULL,
  `Hb` decimal(10,2) NOT NULL,
  `hierro` decimal(10,2) NOT NULL,
  `transferrina` decimal(10,2) NOT NULL,
  `t3_libre` decimal(10,2) NOT NULL,
  `t4_libre` decimal(10,2) NOT NULL,
  `hto` tinyint(4) NOT NULL,
  `B12` decimal(10,2) NOT NULL,
  `folatos` decimal(10,2) NOT NULL,
  `PT` decimal(10,2) NOT NULL,
  `albumina` decimal(10,2) NOT NULL,
  `Ca` decimal(10,2) NOT NULL,
  `otros` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `api_bioquimicos`
--

INSERT INTO `api_bioquimicos` (`id_bioquimico`, `id_consulta_paciente`, `glucosa`, `hbAc1`, `TG`, `CT`, `HDL`, `LDL`, `AST_perc`, `ALT`, `TSH`, `T3`, `T4`, `Hb`, `hierro`, `transferrina`, `t3_libre`, `t4_libre`, `hto`, `B12`, `folatos`, `PT`, `albumina`, `Ca`, `otros`) VALUES
(64, 178, 680, 43, 60.55, 8783.51, 8898.28, 6018.84, 127, 7555.79, 9369.40, 8615.86, 624.44, 969.29, 7314.56, 828.58, 7805.82, 8578.94, 127, 2321.85, 8181.43, 1762.93, 330.07, 551.43, 'el campo de otros paciente 2'),
(50624, 17845, 60, 4, 60620.55, 87283.51, 84898.28, 60148.84, 14, 7955.79, 79969.40, 86215.86, 22624.44, 27969.29, 73154.56, 48828.58, 75805.82, 58578.94, 55, 23121.85, 81981.43, 11762.93, 37030.07, 5551.43, 'el campo de otros paciente 1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_composicion_corporal_diagnostico_obesidad`
--

CREATE TABLE `api_composicion_corporal_diagnostico_obesidad` (
  `id_comp_corp` int(11) NOT NULL,
  `id_consulta_paciente` int(11) NOT NULL,
  `peso` decimal(10,2) NOT NULL,
  `masa_muscular` decimal(10,2) NOT NULL,
  `mas_grasa_corporal` decimal(10,2) NOT NULL,
  `act` decimal(10,2) NOT NULL,
  `imc` decimal(10,2) NOT NULL,
  `pgc` decimal(10,2) NOT NULL,
  `rcc` decimal(10,2) NOT NULL,
  `metabolismo_kcal_basal` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `api_composicion_corporal_diagnostico_obesidad`
--

INSERT INTO `api_composicion_corporal_diagnostico_obesidad` (`id_comp_corp`, `id_consulta_paciente`, `peso`, `masa_muscular`, `mas_grasa_corporal`, `act`, `imc`, `pgc`, `rcc`, `metabolismo_kcal_basal`) VALUES
(438, 178, 6255.57, 1064.89, 9893.91, 788.27, 208.80, 4117.92, 2877.05, 500),
(4348, 845, 655.57, 104.89, 983.91, 798.27, 2508.80, 417.92, 287.05, 590),
(43848, 17845, 67255.57, 19704.89, 9783.91, 7898.27, 25208.80, 41817.92, 28777.05, 50),
(43852, 17849, 62.10, 26.40, 14.50, 34.90, 21.10, 23.30, 0.00, 0),
(43853, 17851, 21.00, 21.00, 65.00, 21.00, 65.00, 6.00, 621.00, 0),
(43854, 17852, 4.00, 65.00, 1.00, 3.00, 5.00, 46.00, 65.00, 0),
(43856, 17854, 6.00, 16.00, 549.00, 51.00, 98.00, 5.00, 19.00, 0),
(43857, 17855, 654.00, 89.00, 59.00, 51.00, 65.00, 989.00, 51.00, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_control_citas`
--

CREATE TABLE `api_control_citas` (
  `id_cita` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_registro_consulta` int(11) NOT NULL,
  `peso` decimal(10,2) NOT NULL,
  `IMC` decimal(10,2) NOT NULL,
  `masa_grasa_corporal` decimal(10,2) NOT NULL,
  `porcentaje_grasa_corporal` decimal(10,2) NOT NULL,
  `masa_muscular_kg` decimal(10,2) NOT NULL,
  `agua_corpolar` decimal(10,2) NOT NULL,
  `circunferencia_cintura` smallint(6) NOT NULL,
  `circunferencia_cadera` smallint(6) NOT NULL,
  `fecha_cita` date NOT NULL,
  `hora_cita` time NOT NULL,
  `fecha_prox_cita` date DEFAULT NULL,
  `control_musculo` decimal(10,2) DEFAULT NULL,
  `control_grasa` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `api_control_citas`
--

INSERT INTO `api_control_citas` (`id_cita`, `id_paciente`, `id_registro_consulta`, `peso`, `IMC`, `masa_grasa_corporal`, `porcentaje_grasa_corporal`, `masa_muscular_kg`, `agua_corpolar`, `circunferencia_cintura`, `circunferencia_cadera`, `fecha_cita`, `hora_cita`, `fecha_prox_cita`, `control_musculo`, `control_grasa`) VALUES
(1, 1, 1, 68.40, 23.30, 18.30, 26.70, 27.90, 36.70, 30, 28, '2024-05-01', '13:36:41', '2024-05-01', 4.90, 8.60),
(2, 2, 2, 50.00, 23.50, 26.60, 25.60, 28.50, 40.50, 30, 28, '2024-04-24', '17:36:41', '2024-05-15', 5.00, 2.00),
(610, 373, 178, 2432.22, 2251.48, 4005.07, 4774.08, 99.52, 293.11, 360, 320, '2020-08-20', '08:38:20', '2024-12-10', 3164.47, 150.58),
(6190, 3273, 845, 45.50, 1.00, 7.00, 15.57, 27.50, 30.50, 31, 31, '2024-05-15', '16:50:00', '2024-05-16', 6.50, -6.50),
(61900, 32973, 17845, 82432.22, 82251.48, 405.07, 47474.08, 85099.52, 29793.11, 30, 20, '2024-08-20', '08:18:20', '2024-10-20', 31564.47, 15070.58),
(61902, 32977, 17849, 62.10, 21.10, 14.50, 23.30, 26.40, 34.90, 78, 98, '2024-05-31', '16:24:00', NULL, NULL, NULL),
(61903, 32980, 17851, 21.00, 65.00, 65.00, 6.00, 21.00, 21.00, 2, 121, '2024-06-02', '23:04:00', NULL, NULL, NULL),
(61904, 32983, 17852, 4.00, 5.00, 1.00, 46.00, 65.00, 3.00, 561, 21, '2024-06-02', '23:18:00', NULL, NULL, NULL),
(61906, 32985, 17854, 6.00, 98.00, 549.00, 5.00, 16.00, 51.00, 516, 2, '2024-06-03', '01:32:00', NULL, NULL, NULL),
(61907, 32986, 17855, 654.00, 65.00, 59.00, 989.00, 89.00, 51.00, 61, 98, '2024-06-03', '04:55:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_datos_generales_dieta`
--

CREATE TABLE `api_datos_generales_dieta` (
  `id_dieta` int(11) NOT NULL,
  `id_consulta_paciente` int(11) NOT NULL,
  `objetivos_dieta` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tipo_dieta` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `kcal_dieta` decimal(10,2) NOT NULL,
  `prot_porcent_dieta` decimal(10,2) NOT NULL,
  `prot_kg_dia_dieta` decimal(10,2) NOT NULL,
  `lip_porcen_dieta` decimal(10,2) NOT NULL,
  `lip_g_dieta` decimal(10,2) NOT NULL,
  `hco_porcen_dieta` decimal(10,2) NOT NULL,
  `hco_g_dieta` decimal(10,2) NOT NULL,
  `suplementos` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `metas_smart` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `param_meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '{}' COMMENT 'Claves: peso, porcen_grasa,musculo,c_cintura, horarios,m_habitos,selec_alimentos,' CHECK (json_valid(`param_meta`)),
  `educacion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `monitoreo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `api_datos_generales_dieta`
--

INSERT INTO `api_datos_generales_dieta` (`id_dieta`, `id_consulta_paciente`, `objetivos_dieta`, `tipo_dieta`, `kcal_dieta`, `prot_porcent_dieta`, `prot_kg_dia_dieta`, `lip_porcen_dieta`, `lip_g_dieta`, `hco_porcen_dieta`, `hco_g_dieta`, `suplementos`, `metas_smart`, `param_meta`, `educacion`, `monitoreo`) VALUES
(31, 845, 'comer sano', 'voluptates voluptatem qui', 29.40, 88.86, 23.54, 71.43, 54.66, 28.30, 57.30, 'quis eius sit', 'Dolore alias et non.', '{}', 'Dolor voluptate voluptatem repellendus facere ducimus est.', 'Rem beatae sed odit distinctio velit et maiores autem.'),
(311, 178, 'estar en un peso ideal', 'voluptates voluptatem qui', 2889.40, 8488.86, 2473.54, 7441.43, 5244.66, 2608.30, 5657.30, 'quis eius sit', 'Dolore alias et non.', '{}', 'Dolor voluptate voluptatem repellendus facere ducimus est.', 'Rem beatae sed odit distinctio velit et maiores autem.'),
(3141, 17845, 'Bajar de peso', 'voluptates voluptatem qui', 22889.40, 84788.86, 24873.54, 74641.43, 52744.66, 26408.30, 56657.30, 'quis eius sit', 'Dolore alias et non.', '{}', 'Dolor voluptate voluptatem repellendus facere ducimus est.', 'Rem beatae sed odit distinctio velit et maiores autem.'),
(3142, 17854, 'sldkfjsldk', 'tipo dieta', 6.00, 54.00, 98.00, 234.00, 21.00, 98.00, 987.00, 'suplementos', 'sldkfjlskj', '{\"peso\":\"9\",\"porcen_grasa\":\"8\",\"musculo\":\"19\",\"c_cintura\":\"8951\",\"horarios\":\"lk\",\"m_habitos\":\"habitos mejorados\",\"selec_alimentos\":\"alimentos selcciondos\"}', 'lkjlkjl', 'lk');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_datos_nutriologo`
--

CREATE TABLE `api_datos_nutriologo` (
  `id_nutriologo` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `datos_alumno` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `api_datos_nutriologo`
--

INSERT INTO `api_datos_nutriologo` (`id_nutriologo`, `id_persona`, `datos_alumno`) VALUES
(1, 5, 'Cuatrimestre 7 Grupo A'),
(2, 3, 'Cuatrimestre 7 Grupo B'),
(5, 41, '\"\"'),
(6, 42, 'Dirección'),
(7, 32, 'Alumno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_datos_paciente`
--

CREATE TABLE `api_datos_paciente` (
  `id_dato_paciente` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `expediente` int(11) NOT NULL,
  `fecha_nacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `api_datos_paciente`
--

INSERT INTO `api_datos_paciente` (`id_dato_paciente`, `id_persona`, `expediente`, `fecha_nacimiento`) VALUES
(1, 1, 1, '2002-03-14'),
(2, 2, 2, '2002-05-20'),
(373, 6, 3, '2023-10-20'),
(3273, 10, 4, '2024-11-20'),
(32973, 30, 5, '2024-10-20'),
(32977, 36, 6, '2002-03-14'),
(32980, 45, 7, '2024-06-06'),
(32983, 48, 8, '2002-03-14'),
(32985, 50, 9, '2024-06-03'),
(32986, 51, 10, '2024-06-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_dieteticos_frecuencia_semanal`
--

CREATE TABLE `api_dieteticos_frecuencia_semanal` (
  `id_dietetico` int(11) NOT NULL,
  `id_consulta_paciente` int(11) NOT NULL,
  `frutas` tinyint(4) NOT NULL,
  `verduras` tinyint(4) NOT NULL,
  `cereales_s_g` tinyint(4) NOT NULL,
  `cereales_c_g` tinyint(4) NOT NULL,
  `leguminosas` tinyint(4) NOT NULL,
  `poa` tinyint(4) NOT NULL,
  `lacteos` tinyint(4) NOT NULL,
  `aceites_s_p` tinyint(4) NOT NULL,
  `aceites_c_p` tinyint(4) NOT NULL,
  `azucares` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `api_dieteticos_frecuencia_semanal`
--

INSERT INTO `api_dieteticos_frecuencia_semanal` (`id_dietetico`, `id_consulta_paciente`, `frutas`, `verduras`, `cereales_s_g`, `cereales_c_g`, `leguminosas`, `poa`, `lacteos`, `aceites_s_p`, `aceites_c_p`, `azucares`) VALUES
(360, 845, 92, 50, 70, 71, 20, 107, 67, 39, 67, 63),
(3860, 178, 127, 127, 127, 127, 127, 127, 127, 127, 127, 127),
(14672, 17845, 127, 127, 127, 127, 127, 127, 127, 127, 127, 127),
(14674, 17849, 4, 5, 6, 8, 7, 9, 2, 1, 3, 54),
(14675, 17851, 4, 8, 97, 5, 3, 1, 9, 52, 80, 23),
(14676, 17852, 4, 5, 6, 9, 8, 72, 6, 6, 87, 9),
(14678, 17854, 4, 6, 5, 9, 8, 7, 8, 1, 23, 5),
(14679, 17855, 4, 56, 4, 9, 1, 3, 5, 49, 8, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_dieteticos_instrumento_medicion`
--

CREATE TABLE `api_dieteticos_instrumento_medicion` (
  `id_dietetico_instru` int(11) NOT NULL,
  `id_consulta_paciente` int(11) NOT NULL,
  `tipo_instrumento` enum('Recorda 24/h','Dieta habitual semicuantitativa','Diario de alimentos') DEFAULT NULL,
  `desayuno_hora` time NOT NULL,
  `colacion1` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `comida_hora` time NOT NULL,
  `colacion2` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `cena_hora` time NOT NULL,
  `colacion3` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `grupo_total_eq` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '{}' CHECK (json_valid(`grupo_total_eq`)),
  `total_kcal` decimal(10,2) NOT NULL,
  `total_prot` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '{}' CHECK (json_valid(`total_prot`)),
  `total_lip` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '{}' CHECK (json_valid(`total_lip`)),
  `total_hco` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '{}' CHECK (json_valid(`total_hco`)),
  `adecuacion_porcen_ener_kcal` decimal(10,2) NOT NULL,
  `adecuacion_porcen_ene` decimal(10,2) NOT NULL,
  `adecuacion_porcen_prot` decimal(10,2) NOT NULL,
  `adecuacion_porcen_lip` decimal(10,2) NOT NULL,
  `adecuacion_porcen_hco` decimal(10,2) NOT NULL,
  `aspectos_cualita_dieta_habitual` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `api_dieteticos_instrumento_medicion`
--

INSERT INTO `api_dieteticos_instrumento_medicion` (`id_dietetico_instru`, `id_consulta_paciente`, `tipo_instrumento`, `desayuno_hora`, `colacion1`, `comida_hora`, `colacion2`, `cena_hora`, `colacion3`, `grupo_total_eq`, `total_kcal`, `total_prot`, `total_lip`, `total_hco`, `adecuacion_porcen_ener_kcal`, `adecuacion_porcen_ene`, `adecuacion_porcen_prot`, `adecuacion_porcen_lip`, `adecuacion_porcen_hco`, `aspectos_cualita_dieta_habitual`) VALUES
(930, 17845, 'Recorda 24/h', '01:04:51', 'manzana', '06:58:42', 'melon', '04:56:00', 'guineo', '{}', 90214.50, '{}', '{}', '{}', 16102.19, 23211.53, 17638.92, 10331.06, 41311.97, 'maiores ex perferendis'),
(955, 845, 'Diario de alimentos', '07:00:51', 'papaya', '08:48:42', 'fresa', '03:16:00', 'maracuya', '{}', 904.50, '{}', '{}', '{}', 12.19, 21.53, 18.92, 11.06, 41.97, 'maiores ex perferendis'),
(9305, 178, 'Dieta habitual semicuantitativa', '01:04:55', 'pera', '06:48:42', 'naranja', '04:16:00', 'melon', '{}', 914.50, '{}', '{}', '{}', 16102.19, 2321.53, 1638.92, 1031.06, 4311.97, 'maiores ex perferendis'),
(9306, 17854, 'Recorda 24/h', '18:20:00', 'jl', '23:38:00', 'lkj', '18:28:00', 'jl', '{\"verduras\":\"6\",\"frutas\":\"54\",\"cereales\":\"654\",\"leguminosas\":\"65\",\"carnes\":\"465\",\"leche\":\"46\",\"grasa\":\"54\",\"azucar\":\"6\"}', 23423.00, '{\"prot_porcent\":\"654\",\"prot_g\":\"654\"}', '{\"lip_porcent\":\"65\",\"lip_g\":\"46\"}', '{\"hco_porcent\":\"54\",\"hco_g\":\"654\"}', 21.00, 63.00, 987.00, 26.00, 9.00, 'aspectos de la dieta actual'),
(9307, 17854, 'Recorda 24/h', '18:20:00', 'jl', '23:38:00', 'lkj', '18:28:00', 'jl', '{\"verduras\":\"6\",\"frutas\":\"54\",\"cereales\":\"654\",\"leguminosas\":\"65\",\"carnes\":\"465\",\"leche\":\"46\",\"grasa\":\"54\",\"azucar\":\"6\"}', 23423.00, '{\"prot_porcent\":\"654\",\"prot_g\":\"654\"}', '{\"lip_porcent\":\"65\",\"lip_g\":\"46\"}', '{\"hco_porcent\":\"54\",\"hco_g\":\"654\"}', 21.00, 63.00, 987.00, 26.00, 9.00, 'aspectos de la dieta actual');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_estudio_gastrointestinal`
--

CREATE TABLE `api_estudio_gastrointestinal` (
  `id_registro_consulta` int(11) NOT NULL,
  `id_registro` int(11) DEFAULT NULL,
  `Escherichia_coli` decimal(3,2) NOT NULL,
  `Enterobacter_sp` decimal(3,2) NOT NULL,
  `Klebsiella_sp` decimal(3,2) NOT NULL,
  `Citrobacter_freudii` decimal(3,2) NOT NULL,
  `Pseudomonas_sp` decimal(3,2) NOT NULL,
  `Enterococcus_sp` decimal(3,2) NOT NULL,
  `Clostridium_perfringens` decimal(3,2) NOT NULL,
  `Fusobacterium_sp` decimal(3,2) NOT NULL,
  `Bacteroides_sp` decimal(3,2) NOT NULL,
  `Staphylococcus_sp` decimal(3,2) NOT NULL,
  `Lactobacillus_sp` decimal(3,2) NOT NULL,
  `Bifidobactetium_sp` decimal(3,2) NOT NULL,
  `Lactococcus_sp` decimal(3,2) NOT NULL,
  `Streptococcus_thermophilus` decimal(3,2) NOT NULL,
  `Saccharomyces_sp` decimal(3,2) NOT NULL,
  `Bifidobacterium` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_explo_fisica`
--

CREATE TABLE `api_explo_fisica` (
  `id_explo` int(11) NOT NULL,
  `id_consulta_paciente` int(11) NOT NULL,
  `pelo_unias` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `piel` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `ojos` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `musculo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `otros` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `intolerancia_alimentos` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `actividad_fis_actual` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `cambios_pos_estilo_vida` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `api_explo_fisica`
--

INSERT INTO `api_explo_fisica` (`id_explo`, `id_consulta_paciente`, `pelo_unias`, `piel`, `ojos`, `musculo`, `otros`, `intolerancia_alimentos`, `actividad_fis_actual`, `cambios_pos_estilo_vida`) VALUES
(914, 178, 'deteriorados', 'caucasico', 'rojisos', 'atrofiados', 'L', 'no pueded comer pescado', '{\r\n          \"frecuencia\": \"intensidad\",\r\n          \"tipo\": \"tiempo\"\r\n     }', 'cambio de actitud'),
(9214, 845, 'Fragil', 'Clara', 'Grisaseos', 'Te falta odio sasuke', 'YOLO', 'No pueded comer lacteos', '{\r\n          \"frecuencia\": \"intensidad\",\r\n          \"tipo\": \"tiempo\"\r\n     }', 'ta bien'),
(91214, 17845, 'bien', 'morena', 'amarillentos', 'eres debil sasuke', 'LMAO', 'no pueded comer palta', '{\r\n          \"regular\": \"baja\",\r\n          \"wea\": \"2 horas\"\r\n     }', 'por mejorar'),
(91218, 17849, 'pelo y uñas', 'piel', 'ojos', 'musculo', 'Estos son los otros de exploración física', 'sdfsdfste', 'Actividad', 'CAmbios'),
(91219, 17851, 'Pelo', 'Piel', 'ojos', 'musculo', 'otros explo fisica', 'sdfsdfsdf', 'asdfasdf', 'asdfasdf'),
(91220, 17852, 'u', 'go', 'u', 'hbu', 'ui', 'sdfsd', '9', 'hkl'),
(91222, 17854, 'lk', 'jl', 'kj', 'lk', 'jl', 'sdfsdf', 'sldkfjlk', 'lkjlkjlkjl'),
(91223, 17855, 'kjh', 'kj', 'hkj', 'hk', 'jhk', 'hdflkdj', 'l', 'kjlkj');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_masa_magra_grasa_segmental`
--

CREATE TABLE `api_masa_magra_grasa_segmental` (
  `id_masa` int(11) NOT NULL,
  `id_registro` int(11) NOT NULL,
  `brazo_derecho` decimal(10,2) NOT NULL,
  `brazo_izquierdo` decimal(10,2) NOT NULL,
  `brazo_derecho_evaluacion` enum('Bajo','Normal','Alto') NOT NULL,
  `brazo_izquierdo_evaluacion` enum('Bajo','Normal','Alto') NOT NULL,
  `tronco` decimal(10,2) NOT NULL,
  `tronco_evaluacion` enum('Bajo','Normal','Alto') NOT NULL,
  `pierna_derecha` decimal(10,2) NOT NULL,
  `pierna_izquierda` decimal(10,2) NOT NULL,
  `pierna_derecha_evaluacion` enum('Bajo','Normal','Alto') NOT NULL,
  `pierna_izquierda_evaluacion` enum('Bajo','Normal','Alto') NOT NULL,
  `brazo_grasa_derecho_porcen` decimal(10,2) NOT NULL,
  `brazo_grasa_derecho_valor` decimal(10,2) NOT NULL,
  `brazo_grasa_derecho_evaluacion` enum('Bajo','Normal','Alto') NOT NULL,
  `brazo_grasa_izquierdo_porcen` decimal(10,2) NOT NULL,
  `brazo_grasa_izquierdo_valor` decimal(10,2) NOT NULL,
  `brazo_grasa_izquierdo_evaluacion` enum('Bajo','Normal','Alto') NOT NULL,
  `tronco_grasa_porcen` decimal(10,2) NOT NULL,
  `tronco_grasa_valor` decimal(10,2) NOT NULL,
  `tronco_grasa_evaluacion` enum('Bajo','Normal','Alto') DEFAULT NULL,
  `pierna_grasa_derecha_porcen` decimal(10,2) NOT NULL,
  `pierna_grasa_derecha_valor` decimal(10,2) NOT NULL,
  `pierna_grasa_derecha_evaluacion` enum('Bajo','Normal','Alto') NOT NULL,
  `pierna_grasa_izquierda_porcen` decimal(10,2) NOT NULL,
  `pierna_grasa_izquierda_valor` decimal(10,2) NOT NULL,
  `pierna_grasa_izquierda_evaluacion` enum('Bajo','Normal','Alto') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `api_masa_magra_grasa_segmental`
--

INSERT INTO `api_masa_magra_grasa_segmental` (`id_masa`, `id_registro`, `brazo_derecho`, `brazo_izquierdo`, `brazo_derecho_evaluacion`, `brazo_izquierdo_evaluacion`, `tronco`, `tronco_evaluacion`, `pierna_derecha`, `pierna_izquierda`, `pierna_derecha_evaluacion`, `pierna_izquierda_evaluacion`, `brazo_grasa_derecho_porcen`, `brazo_grasa_derecho_valor`, `brazo_grasa_derecho_evaluacion`, `brazo_grasa_izquierdo_porcen`, `brazo_grasa_izquierdo_valor`, `brazo_grasa_izquierdo_evaluacion`, `tronco_grasa_porcen`, `tronco_grasa_valor`, `tronco_grasa_evaluacion`, `pierna_grasa_derecha_porcen`, `pierna_grasa_derecha_valor`, `pierna_grasa_derecha_evaluacion`, `pierna_grasa_izquierda_porcen`, `pierna_grasa_izquierda_valor`, `pierna_grasa_izquierda_evaluacion`) VALUES
(58, 845, 305.15, 782.54, 'Normal', 'Normal', 148.09, 'Alto', 52.64, 1.40, 'Alto', 'Bajo', 30.51, 947.74, 'Alto', 51.40, 72.77, 'Normal', 81.90, 4.84, 'Normal', 65.94, 79.09, 'Bajo', 300.94, 338.45, 'Normal'),
(4228, 178, 3305.15, 7382.54, 'Alto', 'Bajo', 418.09, 'Normal', 502.64, 185.40, 'Normal', 'Bajo', 361.51, 977.74, 'Bajo', 552.40, 729.77, 'Alto', 8791.90, 4118.84, 'Alto', 65.94, 729.09, 'Normal', 350.94, 378.45, 'Bajo'),
(42258, 17845, 33805.15, 73082.54, 'Normal', 'Alto', 14818.09, 'Normal', 50912.64, 1485.40, 'Normal', 'Normal', 3061.51, 94677.74, 'Bajo', 51152.40, 72049.77, 'Alto', 87961.90, 4118.84, 'Bajo', 6615.94, 72259.09, 'Alto', 35500.94, 37438.45, 'Normal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_nutriologo_paciente`
--

CREATE TABLE `api_nutriologo_paciente` (
  `id_primaria` smallint(6) NOT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `id_nutriologo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `api_nutriologo_paciente`
--

INSERT INTO `api_nutriologo_paciente` (`id_primaria`, `id_paciente`, `id_nutriologo`) VALUES
(1, 1, 1),
(2, 2, 1),
(4, 32980, 7),
(6, 32983, 7),
(8, 32985, 7),
(9, 32986, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_persona`
--

CREATE TABLE `api_persona` (
  `persona_id` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `edad` tinyint(4) NOT NULL,
  `genero` enum('M','F') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `api_persona`
--

INSERT INTO `api_persona` (`persona_id`, `nombre`, `edad`, `genero`) VALUES
(1, 'Axel', 22, 'M'),
(2, 'Pedro', 22, 'M'),
(3, 'Nutriologo1', 25, 'M'),
(4, 'Nutriologo2', 25, 'M'),
(5, 'Nutriologa3', 26, 'F'),
(6, 'Kenny McLaughlin', 30, 'M'),
(10, 'Carlton Satterfield', 26, 'M'),
(30, 'Woodrow Price', 40, 'M'),
(32, 'Diego', 22, 'M'),
(36, 'Carlos', 22, 'M'),
(41, 'JosueDiaz', 21, 'M'),
(42, 'Direccion nutrición', 0, NULL),
(45, 'Pepe', 22, 'M'),
(48, 'pepe2', 23, 'M'),
(50, 'Pepe 3 conectado', 22, 'M'),
(51, 'pepe 4', 23, 'M');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_referencias_composicion_corporal`
--

CREATE TABLE `api_referencias_composicion_corporal` (
  `id_ref_corp` tinyint(4) NOT NULL,
  `nivel_composicion` enum('Bajo','Normal','Alto') NOT NULL,
  `valor_normal_inicio` decimal(10,2) NOT NULL,
  `valor_normal_fin` decimal(10,2) NOT NULL,
  `fin_nivel_bajo` tinyint(4) NOT NULL,
  `fin_nivel_normal` tinyint(4) NOT NULL,
  `fin_nivel_alto` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_referencias_diagnostico_obesidad`
--

CREATE TABLE `api_referencias_diagnostico_obesidad` (
  `id_referencia_obe` int(11) NOT NULL,
  `valor_normal_inicio` decimal(10,2) NOT NULL,
  `valor_normal_final` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_registro_consulta`
--

CREATE TABLE `api_registro_consulta` (
  `id_registro` int(11) NOT NULL,
  `no_consulta_paciente` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `motivo_consulta` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `sintoma_gastro` enum('Estreñimiento','Diarrea','Bristol','Reflujo','Gastritis','Saciedad temprana','Apetito','Flatulencia','Otro') DEFAULT NULL,
  `escala_bristol` enum('Tipo 1','Tipo 2','Tipo 3','Tipo 4','Tipo 5','Tipo 6','Tipo 7') DEFAULT NULL,
  `motivacion` enum('extramadamente_desmotivado','muy_desmotivado','algo_desmotivado','ligeramente_desmotivado','ni_motivado_ni_desmotivado','ligeramente_motivado','algo_motivado','muy_motivado','altamente_motivado','extremadamente_motivado') DEFAULT NULL,
  `otros_sintoma_gastro` tinytext DEFAULT NULL,
  `apego_plan_anterior_barr_apego` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `hidratacion` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `sintomas_generales` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `clinicos` varchar(150) NOT NULL DEFAULT '''''',
  `dinamometria` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '\'{}\'' COMMENT 'La primera clave debe de ser dinamometria, la segunda clave interpretacion_dinamometrica',
  `medicamentos_suplementos` varchar(150) NOT NULL DEFAULT '''''',
  `pendientes` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `nutri_elaborate_data` tinytext DEFAULT NULL,
  `nutri_who_approved_data` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `api_registro_consulta`
--

INSERT INTO `api_registro_consulta` (`id_registro`, `no_consulta_paciente`, `id_paciente`, `motivo_consulta`, `sintoma_gastro`, `escala_bristol`, `motivacion`, `otros_sintoma_gastro`, `apego_plan_anterior_barr_apego`, `hidratacion`, `sintomas_generales`, `clinicos`, `dinamometria`, `medicamentos_suplementos`, `pendientes`, `nutri_elaborate_data`, `nutri_who_approved_data`) VALUES
(1, 1, 1, 'Estos son los motivos de consulta', 'Estreñimiento', NULL, 'ligeramente_desmotivado', NULL, 'Sin apego porque no había plan anterior', '{\"Hola como estas\":\"Vamos a ver si funciona\"}', 'Estos son los síntomas generales', '', '{}', '', NULL, NULL, NULL),
(2, 1, 2, 'Estos son los motivos de consulta', 'Diarrea', NULL, 'algo_desmotivado', NULL, 'Sin apego porque no había plan anterior', '{\r\n\"prueba\":\"100\",\r\n\"agua\":\"100ml\"\r\n}', 'Sintomas generales de Pedro', '', '{}', '', NULL, NULL, NULL),
(178, 7413, 373, 'im literally Ryan Gosling', 'Bristol', 'Tipo 4', 'algo_desmotivado', NULL, 'Maomenos', '{\"jugo, leche, agua, refresco\":\"Medio litro\"}', 'Sintomas', '', '{}', '', NULL, NULL, NULL),
(845, 7441, 3273, 'Ponerme como Dwayne Johnson', 'Gastritis', NULL, 'algo_motivado', NULL, 'Regular', '{\r\n          \"refresco\":\"Medio litro\",\r\n          \"jugo\":\"Litro\",\r\n          \"leche\":\"Medio Litro\",\r\n          \"agua\":\"2 Litros\"\r\n     }', 'Sintomas2', '', '{}', '', NULL, NULL, NULL),
(17845, 74413, 32973, 'Ponerme como Jason Momoa', 'Apetito', NULL, 'muy_motivado', NULL, 'SImon', '{\"agua\":\"2 litros\"}', 'Sintomas3', '', '{}', '', NULL, NULL, NULL),
(17849, 1, 32977, 'Esta es la consulta', 'Estreñimiento', NULL, 'ligeramente_motivado', '', 'Sin plan atenrior', '1000', 'Estos son los sintomas generales', 'Este es el diagnostico', '{\"dinamometria\":\"389\",\"interpretacion_dinamometrica\":\"La interpretaci\\u00f3n\"}', 'Los medicamentos', NULL, NULL, NULL),
(17851, 1, 32980, 'Estos son los motivos', 'Gastritis', NULL, 'ligeramente_motivado', '', 'Sin plan', '500', 'GEnerales', 'DIagnostico', '{\"dinamometria\":\"38\",\"interpretacion_dinamometrica\":\"Inter\"}', 'jslokfjoi', NULL, NULL, NULL),
(17852, 1, 32983, 'MOtivos', 'Reflujo', NULL, 'ligeramente_motivado', '', 'hl', '500', 'lsdk', 'dsfsdf', '{\"dinamometria\":\"23\",\"interpretacion_dinamometrica\":\"sdfsdfs\"}', 'sdfsdf', NULL, NULL, NULL),
(17854, 1, 32985, 'asldfakjl', 'Gastritis', NULL, 'algo_motivado', '', 'Sin plan atenrior', '500', 'sdfsdf', 'asdfasdfasd', '{\"dinamometria\":\"50\",\"interpretacion_dinamometrica\":\"asdfadsf\"}', 'asdfasdsdfsdf', 'jlkj', 'lkj', 'osidufpsdoif'),
(17855, 1, 32986, 'lljlkjk', 'Reflujo', NULL, 'ligeramente_motivado', '', 'llkjlk', '500', 'kjhjh', 'ldksjflkd', '{\"dinamometria\":\"12\",\"interpretacion_dinamometrica\":\"sdjflkjl\"}', 'suplemtnos', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `api_resultado_diagnostico`
--

CREATE TABLE `api_resultado_diagnostico` (
  `id_resultado` int(11) NOT NULL,
  `id_consulta_paciente` int(11) NOT NULL,
  `reque_ener` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `reque_proteina` decimal(10,2) NOT NULL,
  `reque_kg_dia` decimal(10,2) NOT NULL,
  `dx_nutricio` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `api_resultado_diagnostico`
--

INSERT INTO `api_resultado_diagnostico` (`id_resultado`, `id_consulta_paciente`, `reque_ener`, `reque_proteina`, `reque_kg_dia`, `dx_nutricio`) VALUES
(9, 845, 'Dolorem tempora id optio libero cumque necessitatibus eos occaecati est.', 489.16, 712.36, 'Est est occaecati ea consequatur veniam. Laborum sed rerum.'),
(189, 178, 'Dolorem tempora id optio libero cumque necessitatibus eos occaecati est.', 429.16, 7132.36, 'Est est occaecati ea consequatur veniam. Laborum sed rerum.'),
(1809, 17845, 'Dolorem tempora id optio libero cumque necessitatibus eos occaecati est.', 48329.16, 71322.36, 'Est est occaecati ea consequatur veniam. Laborum sed rerum.'),
(1810, 17854, '6', 49.00, 898.00, 'lsdkfjsldk'),
(1811, 17854, '6', 49.00, 898.00, 'lsdkfjsldk');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_registro` int(11) DEFAULT NULL,
  `comentario` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
(4, '2024_05_18_180506_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

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
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'director', 'web', '2024-06-02 10:39:32', '2024-06-02 10:39:32'),
(2, 'alumno', 'web', '2024-06-02 10:39:32', '2024-06-02 10:39:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('1AzcicJ0NxaJBOBavfnexU31sksJlbMlhq4DmCnN', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaktLYUt3aFFBSU5EM2h1a1hTVEVkbm1CZ0JNeDVWdzRmb0oydDZJbiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2NToiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9yZW5kZXJlci5qcy5tYXAiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo2NToiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9yZW5kZXJlci5qcy5tYXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717450628),
('1k3te1Ynd1w1B0ow6GjjcQxSwzuFMM6gA8mmf88m', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZGFsRkVDaktWQ0NTSVJYdzFnblpZOTNUazVybG5jTVZzelZsc1p2SiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2NToiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9yZW5kZXJlci5qcy5tYXAiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo2NToiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9yZW5kZXJlci5qcy5tYXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717450615),
('1SajwAlNg70ESSFqPpnxEWKRjkYCGXABAvnxrn5S', 2, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicTNJV0trekluS2JkTHFaWk01R3IzeWRhS0tKNlNnZTRJTGVJUEF0aSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9uYXZpLmxvY2FsL2FsdW1uby9hZ3JlZ2FyLXBhY2llbnRlIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1717516171),
('3egkAzhEufgrdTCkiZFCz8GnAf3lGGTnPIXyziLt', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMzBUSnZsRnRmbTJ0dFl6Y2s4OXRhWEM5TWRnOWwzWWNkb0IwVFlkNSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2ODoiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9pbnN0YWxsSG9vay5qcy5tYXAiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo2ODoiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9pbnN0YWxsSG9vay5qcy5tYXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717450738),
('5MHzyB1Jh1its4I9OeSGY0GQdzyYWHjhedZiw6z1', NULL, '127.0.0.1', 'HTTPie', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMk9nRzNOa2NkcmFkcVJGUHJoWWtTMDNIUVZWU2hCYnB2bUFURjV5RiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly9uYXZpLmxvY2FsL2FsdW1uby9saXN0YWRvLXJlZ2lzdHJvcy1wYWNpZW50ZXMvNyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1717461093),
('alx7naJBLDdJqLpZvlIhcApeBxuqp7UfP8lh7pbF', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRlgyQzVtdWRKcTBvN3JUZ0ZRRjFhc2wzdHFWOW14YWxSNFFGSEswYyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2ODoiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9pbnN0YWxsSG9vay5qcy5tYXAiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo2ODoiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9pbnN0YWxsSG9vay5qcy5tYXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717450628),
('AW7Gyq92YrWHkEo5SW3HOIkoRpjvYAgBWRsRnZdZ', NULL, '127.0.0.1', 'HTTPie', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibGZaVXk0bXI1SmtSMHFFZUlER2t5Zmx5dVVYU3RWc0dGWmQzTVNHbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly9uYXZpLmxvY2FsL2FsdW1uby9yZWdpc3Ryb3MtcGFjaWVudGUvMzczIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1717461582),
('cpb0NX5aaaKpgYnCJlM32XabVRGaxFsgzlCQTi2Q', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidnRLRnQwUjV4eFNPMGxVR3p5aVFLUmp4M01IbUNpQUpSNFpPa2R2diI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvaW5pY2lvIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9uYXZpLmxvY2FsL2RpcmVjdG9yL2luaWNpbyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1717442558),
('cz3oUEDEvbwwr5dOYf3XwVMXGm05Ngti95fcIbGM', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWEVvMkhRQ05uRHQ3R2dyS1htRzV5cDc5a1dqQjM3d2RzWlB4OGN4VCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2ODoiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9pbnN0YWxsSG9vay5qcy5tYXAiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo2ODoiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9pbnN0YWxsSG9vay5qcy5tYXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717450674),
('g2z92DsSpY2W2Y9SFdlSMDvE1h6ADIEQlUbFiv2p', NULL, '127.0.0.1', 'HTTPie', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQnc4NUl1eHR2bTdoMUc0ak1URzZvVXZpMnRnNTJVU09FWXhaOWpxRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly9uYXZpLmxvY2FsL2FsdW1uby9saXN0YWRvLXJlZ2lzdHJvcy1wYWNpZW50ZXMvMzIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717461260),
('HdBzh318sVzcYUVZbqVEBMOD4JBd9PlfPK6axlby', NULL, '127.0.0.1', 'HTTPie', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYVZTYlRxNlFkc21mSmxqVUlwbTBlZWtLR1FBR3JwbE5aNEZ2Z3NHUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly9uYXZpLmxvY2FsL2FsdW1uby9saXN0YWRvLXJlZ2lzdHJvcy1wYWNpZW50ZXMvMzIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717461193),
('JpcEj0X584nJrn938SW97zXv3Yrfk3EynLxP6AV4', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTEh5dzhpYlNkNWk3TEtPWTNlVG42REJSNlRzdWVzVDNsaFFvbkQxeSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2NToiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9yZW5kZXJlci5qcy5tYXAiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo2NToiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9yZW5kZXJlci5qcy5tYXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717450545),
('lU4Oah8SduvDztETH03sc7qoU68RHrnnOYd3WiSE', NULL, '127.0.0.1', 'HTTPie', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidWFSZmdGUDRpMk1kZEp3RDVMMldXd0xIdGNIb0JwT0Y3OXM5Zm1jSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly9uYXZpLmxvY2FsL2FsdW1uby9saXN0YWRvLXJlZ2lzdHJvcy1wYWNpZW50ZXMvMzIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717461127),
('LwewR8cfXtmPD20cry92EK5MOphAwusSEpZHgWzW', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRVlnS1c5c1FLbXVONVZ4OWNiQWI0ejk3bjN1cnBXWFQwZ245TFdQZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHA6Ly9uYXZpLmxvY2FsL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1717449929),
('m7DgDLEqZGJMCq64ED0Yh64TxNcupuP4ImcaxZxN', NULL, '127.0.0.1', 'HTTPie', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZFJJR0VMYnZKQkthaW9FZkNodHFJMDRiaW5HamtEd000V0s2MTJtYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly9uYXZpLmxvY2FsL2FsdW1uby9saXN0YWRvLXJlZ2lzdHJvcy1wYWNpZW50ZXMvMzIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717461170),
('MKOkaVfDuBAD24lOEOe3UVLjnTOMuYqLZ3oRXDa5', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYkVoOXVCNlg5MFY0OXBoSldtSlBGY1B6NmZha3JwSnJQbkZPYWhwcSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2NToiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9yZW5kZXJlci5qcy5tYXAiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo2NToiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9yZW5kZXJlci5qcy5tYXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717450744),
('ntgxqo0A32lMVEv6teYogdIiSRBvxrxvcMtqF0vU', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiczJBT05XaWVjN3ZIQ0IwSlJiUkJJanpQSHhyd3d0TVNaNTg5OVpQRyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1MToiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby8xIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly9uYXZpLmxvY2FsL2RpcmVjdG9yL2xpc3RhX3BhY2llbnRlc19hbHVtbm8vMSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1717449929),
('ODeL6WkBmEaLLi50kuO2nyUMdtd04IGm6TPm5DbJ', NULL, '127.0.0.1', 'HTTPie', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieUtleWxFajZocVQ5RGp3NHVIUjRzYmVRNXVrcFNDZFpmS0luTkVuQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly9uYXZpLmxvY2FsL2FsdW1uby9saXN0YWRvLXJlZ2lzdHJvcy1wYWNpZW50ZXMvMzIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717461270),
('OFf4Hja8R7PaqqqoVICkYULcYHQv2T7eeVF5BBse', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS0lWaWk1T1FZOG5oZmVpUVVoVGlyN3BueEdkSnNBWlh5clJSaVZ5ZyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2ODoiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9pbnN0YWxsSG9vay5qcy5tYXAiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo2ODoiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9pbnN0YWxsSG9vay5qcy5tYXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717450687),
('ooOmvIUTIk3AiI0ezq3LntoAt5pRRl0SFeuLtqeK', NULL, '127.0.0.1', 'HTTPie', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZEEyYUFUR3Y3VlMwVlpIdzFZUm1kNkhPYlR2RDJmNlo4ZTJOQ2NucCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly9uYXZpLmxvY2FsL2FsdW1uby9saXN0YWRvLXJlZ2lzdHJvcy1wYWNpZW50ZXMvNyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1717455609),
('OxPxMlhP6yQBzgHmliwCzU76bSwm1LIUY1gt1aFT', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibkNpWTRucU1ZVUJRUEtEY0t1dXBPcHNrQ0lSZnlEWW5BbGd0VWlYRSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2NToiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9yZW5kZXJlci5qcy5tYXAiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo2NToiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9yZW5kZXJlci5qcy5tYXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717450709),
('OY0Lzit7WVoGa1ntaTLRo2yaRhGtD8CLN7OC7yIB', NULL, '127.0.0.1', 'HTTPie', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU0ZibVFER0NSd2lGdlA3eDBnOUhKN3J1Nk5Ya2hENDhjUFV2eWtFVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly9uYXZpLmxvY2FsL2FsdW1uby9saXN0YWRvLXJlZ2lzdHJvcy1wYWNpZW50ZXMvMzIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717461202),
('ph48yqeZTdeSnbQLII5bKm7q8rJ0RKsuBVd4D4uN', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOVdoeFg4VUZydXV4Yk96bUN4N1FFM1dFZGJTYWxuRGN2b3lhOXJONSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2ODoiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9pbnN0YWxsSG9vay5qcy5tYXAiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo2ODoiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9pbnN0YWxsSG9vay5qcy5tYXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717450744),
('QBi2Ee2yjpsZsne4vKTWqGAY308EnHpYY0yFSbVw', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQmNYMlQxdmplcFBUa25kMkE0RERWOGpydzVGM254Qm1pSVdzYThKbCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2NToiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9yZW5kZXJlci5qcy5tYXAiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo2NToiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9yZW5kZXJlci5qcy5tYXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717450738),
('Sn4oFxQDQa0aS57da562veneVT459U5BrVdwrTL5', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUnhoaWVCSUk1VUR0MzRwMFFTc1R0N2ZDN01MZkVXMll3SFdNRUN1ZCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2ODoiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9pbnN0YWxsSG9vay5qcy5tYXAiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo2ODoiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9pbnN0YWxsSG9vay5qcy5tYXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717450545),
('sVCeTZceZJTJlsLgWu2Xlx7yGHcGLXzjFoLl6PsF', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNG5ZSGludHJ5MEswd3Rja3ZOQ29OaklnUDBURGoyNmZFbnJ4UFpaOSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2ODoiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9pbnN0YWxsSG9vay5qcy5tYXAiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo2ODoiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9pbnN0YWxsSG9vay5qcy5tYXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717450709),
('tUNnz6v2cPmSFbM6LWscosujm991RT3ma3WRkpqy', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicU1vd0lLUWNiY0dHV3U3a2RCMmk5OEw4WThWWWpvZHE1eTBpMXAxNiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2NToiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9yZW5kZXJlci5qcy5tYXAiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo2NToiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9yZW5kZXJlci5qcy5tYXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717450518),
('ungMRMW0sypBtCyiRbIpeoTSRa46DTfaY3LuCtst', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiamsyMnd0a3JxTVNKVHhjbk9scWl4Z01ySUZ5UUF5b0Z2bWM4TVJORiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2ODoiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9pbnN0YWxsSG9vay5qcy5tYXAiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo2ODoiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9pbnN0YWxsSG9vay5qcy5tYXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717450615),
('w6Rbe8uFM7ESRxUDu3GL1fL8C2hScQuf6L69Rzaf', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUkIyQlVuc2NQeXJBaWg2MEJ5ZXlIQXdhMm1zTXU3QVJpcE1NWXNLdyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2ODoiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9pbnN0YWxsSG9vay5qcy5tYXAiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo2ODoiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9pbnN0YWxsSG9vay5qcy5tYXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717450518),
('WiEWEUKZqNnNPms2W67jjUC0ifH3NGvMHhEnLA3b', NULL, '127.0.0.1', 'HTTPie', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWVVybjdYdWpVUHIzSVRZSmJPalpCNWVraDExN3ZtVnBUYUk0dG1BOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly9uYXZpLmxvY2FsL2FsdW1uby9saXN0YWRvLXJlZ2lzdHJvcy1wYWNpZW50ZXMvNyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1717455586),
('wsMHjFIeb3Ha8Aa2q2ISayVvg1F1S9Poch1kXd32', NULL, '127.0.0.1', 'HTTPie', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV2R6eTE1NHhoSk5NZlBMempZT3Vadk9EZnl3UzFBaG93T09iM1hXWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly9uYXZpLmxvY2FsL2FsdW1uby9saXN0YWRvLXJlZ2lzdHJvcy1wYWNpZW50ZXMvNyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1717455545),
('x7aQq2Hug2OrMsKESjalODshJmFAEr8hnMcTjJfU', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoid3UydkU3dGNYVENzblpxaGJORFF4YUhFT2JzVDRscEhsZDY2RjI1VyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2NToiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9yZW5kZXJlci5qcy5tYXAiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo2NToiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9yZW5kZXJlci5qcy5tYXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717450687),
('XFVB9bZxBwJ8bkiSNtfhBPTSJZAcFeTo1I5jV06u', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:126.0) Gecko/20100101 Firefox/126.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiV2puNU9NS0lob1FrWTV4RUNtRTg0bEJVTXBYVGNxV0VQdUw3a1V0dSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2NToiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9yZW5kZXJlci5qcy5tYXAiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo2NToiaHR0cDovL25hdmkubG9jYWwvZGlyZWN0b3IvbGlzdGFfcGFjaWVudGVzX2FsdW1uby9yZW5kZXJlci5qcy5tYXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717450674);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `persona_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `apellido`, `persona_id`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Director', '', 42, 'director@udem.com', NULL, '$2y$12$dEVTksurxne9uUWXDJZwYOyDEH66mqK.RVNmRB7nOqqVdwh1FBMHK', NULL, NULL, NULL),
(2, 'Diego', 'Mendoza', 32, 'diegomendoza@udem.com', NULL, '$2y$12$vfQxX7.UhNzM4IATJjJqxeHuu37WrKMIKKvnjBly3LY3KYmNhjZIO', NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `api_bioquimicos`
--
ALTER TABLE `api_bioquimicos`
  ADD PRIMARY KEY (`id_bioquimico`),
  ADD KEY `fk_id_consulta_paciente_b_id` (`id_consulta_paciente`);

--
-- Indices de la tabla `api_composicion_corporal_diagnostico_obesidad`
--
ALTER TABLE `api_composicion_corporal_diagnostico_obesidad`
  ADD PRIMARY KEY (`id_comp_corp`),
  ADD KEY `fk_id_consulta_paciente_c_c_d_o_id` (`id_consulta_paciente`);

--
-- Indices de la tabla `api_control_citas`
--
ALTER TABLE `api_control_citas`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `fk_id_paciente_c_c_id` (`id_paciente`),
  ADD KEY `fk_id_registro_c_c_r_c_id` (`id_registro_consulta`);

--
-- Indices de la tabla `api_datos_generales_dieta`
--
ALTER TABLE `api_datos_generales_dieta`
  ADD PRIMARY KEY (`id_dieta`),
  ADD KEY `fk_id_consulta_paciente_d_g_c_id` (`id_consulta_paciente`);

--
-- Indices de la tabla `api_datos_nutriologo`
--
ALTER TABLE `api_datos_nutriologo`
  ADD PRIMARY KEY (`id_nutriologo`),
  ADD KEY `fk_id_persona_id` (`id_persona`);

--
-- Indices de la tabla `api_datos_paciente`
--
ALTER TABLE `api_datos_paciente`
  ADD PRIMARY KEY (`id_dato_paciente`),
  ADD UNIQUE KEY `expediente` (`expediente`),
  ADD KEY `fk_id_persona_d_p_id` (`id_persona`);

--
-- Indices de la tabla `api_dieteticos_frecuencia_semanal`
--
ALTER TABLE `api_dieteticos_frecuencia_semanal`
  ADD PRIMARY KEY (`id_dietetico`),
  ADD KEY `fk_id_consulta_paciente_d_f_s_id` (`id_consulta_paciente`);

--
-- Indices de la tabla `api_dieteticos_instrumento_medicion`
--
ALTER TABLE `api_dieteticos_instrumento_medicion`
  ADD PRIMARY KEY (`id_dietetico_instru`),
  ADD KEY `fk_id_consulta_paciente_d_i_m_id` (`id_consulta_paciente`);

--
-- Indices de la tabla `api_estudio_gastrointestinal`
--
ALTER TABLE `api_estudio_gastrointestinal`
  ADD PRIMARY KEY (`id_registro_consulta`),
  ADD KEY `id_registro` (`id_registro`);

--
-- Indices de la tabla `api_explo_fisica`
--
ALTER TABLE `api_explo_fisica`
  ADD PRIMARY KEY (`id_explo`),
  ADD KEY `fk_id_consulta_paciente_e_f_id` (`id_consulta_paciente`);

--
-- Indices de la tabla `api_masa_magra_grasa_segmental`
--
ALTER TABLE `api_masa_magra_grasa_segmental`
  ADD PRIMARY KEY (`id_masa`),
  ADD KEY `fk_id_registro_m_m_g_s_id` (`id_registro`);

--
-- Indices de la tabla `api_nutriologo_paciente`
--
ALTER TABLE `api_nutriologo_paciente`
  ADD PRIMARY KEY (`id_primaria`),
  ADD UNIQUE KEY `id_nutriologo` (`id_nutriologo`,`id_paciente`),
  ADD KEY `api_nutriologo_paciente_ibfk_2` (`id_paciente`);

--
-- Indices de la tabla `api_persona`
--
ALTER TABLE `api_persona`
  ADD PRIMARY KEY (`persona_id`);

--
-- Indices de la tabla `api_referencias_composicion_corporal`
--
ALTER TABLE `api_referencias_composicion_corporal`
  ADD PRIMARY KEY (`id_ref_corp`);

--
-- Indices de la tabla `api_referencias_diagnostico_obesidad`
--
ALTER TABLE `api_referencias_diagnostico_obesidad`
  ADD PRIMARY KEY (`id_referencia_obe`);

--
-- Indices de la tabla `api_registro_consulta`
--
ALTER TABLE `api_registro_consulta`
  ADD PRIMARY KEY (`id_registro`),
  ADD UNIQUE KEY `id_registro` (`no_consulta_paciente`,`id_paciente`),
  ADD KEY `no_consulta_paciente` (`no_consulta_paciente`),
  ADD KEY `fk_id_paciente_r_c_id` (`id_paciente`);

--
-- Indices de la tabla `api_resultado_diagnostico`
--
ALTER TABLE `api_resultado_diagnostico`
  ADD PRIMARY KEY (`id_resultado`),
  ADD KEY `fk_id_consulta_paciente_r_d_id` (`id_consulta_paciente`);

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
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `fk_id_registro` (`id_registro`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_persona_id_foreign` (`persona_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `api_bioquimicos`
--
ALTER TABLE `api_bioquimicos`
  MODIFY `id_bioquimico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50625;

--
-- AUTO_INCREMENT de la tabla `api_composicion_corporal_diagnostico_obesidad`
--
ALTER TABLE `api_composicion_corporal_diagnostico_obesidad`
  MODIFY `id_comp_corp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43858;

--
-- AUTO_INCREMENT de la tabla `api_control_citas`
--
ALTER TABLE `api_control_citas`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61908;

--
-- AUTO_INCREMENT de la tabla `api_datos_generales_dieta`
--
ALTER TABLE `api_datos_generales_dieta`
  MODIFY `id_dieta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3143;

--
-- AUTO_INCREMENT de la tabla `api_datos_nutriologo`
--
ALTER TABLE `api_datos_nutriologo`
  MODIFY `id_nutriologo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `api_datos_paciente`
--
ALTER TABLE `api_datos_paciente`
  MODIFY `id_dato_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32987;

--
-- AUTO_INCREMENT de la tabla `api_dieteticos_frecuencia_semanal`
--
ALTER TABLE `api_dieteticos_frecuencia_semanal`
  MODIFY `id_dietetico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14680;

--
-- AUTO_INCREMENT de la tabla `api_dieteticos_instrumento_medicion`
--
ALTER TABLE `api_dieteticos_instrumento_medicion`
  MODIFY `id_dietetico_instru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9308;

--
-- AUTO_INCREMENT de la tabla `api_estudio_gastrointestinal`
--
ALTER TABLE `api_estudio_gastrointestinal`
  MODIFY `id_registro_consulta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `api_explo_fisica`
--
ALTER TABLE `api_explo_fisica`
  MODIFY `id_explo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91224;

--
-- AUTO_INCREMENT de la tabla `api_masa_magra_grasa_segmental`
--
ALTER TABLE `api_masa_magra_grasa_segmental`
  MODIFY `id_masa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42259;

--
-- AUTO_INCREMENT de la tabla `api_nutriologo_paciente`
--
ALTER TABLE `api_nutriologo_paciente`
  MODIFY `id_primaria` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `api_persona`
--
ALTER TABLE `api_persona`
  MODIFY `persona_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `api_referencias_composicion_corporal`
--
ALTER TABLE `api_referencias_composicion_corporal`
  MODIFY `id_ref_corp` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `api_referencias_diagnostico_obesidad`
--
ALTER TABLE `api_referencias_diagnostico_obesidad`
  MODIFY `id_referencia_obe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `api_registro_consulta`
--
ALTER TABLE `api_registro_consulta`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17856;

--
-- AUTO_INCREMENT de la tabla `api_resultado_diagnostico`
--
ALTER TABLE `api_resultado_diagnostico`
  MODIFY `id_resultado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1812;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `api_bioquimicos`
--
ALTER TABLE `api_bioquimicos`
  ADD CONSTRAINT `fk_id_consulta_paciente_b_id` FOREIGN KEY (`id_consulta_paciente`) REFERENCES `api_registro_consulta` (`id_registro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `api_composicion_corporal_diagnostico_obesidad`
--
ALTER TABLE `api_composicion_corporal_diagnostico_obesidad`
  ADD CONSTRAINT `fk_id_consulta_paciente_c_c_d_o_id` FOREIGN KEY (`id_consulta_paciente`) REFERENCES `api_registro_consulta` (`id_registro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `api_control_citas`
--
ALTER TABLE `api_control_citas`
  ADD CONSTRAINT `fk_id_paciente_c_c_id` FOREIGN KEY (`id_paciente`) REFERENCES `api_datos_paciente` (`id_dato_paciente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_registro_c_c_r_c_id` FOREIGN KEY (`id_registro_consulta`) REFERENCES `api_registro_consulta` (`id_registro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `api_datos_generales_dieta`
--
ALTER TABLE `api_datos_generales_dieta`
  ADD CONSTRAINT `fk_id_consulta_paciente_d_g_c_id` FOREIGN KEY (`id_consulta_paciente`) REFERENCES `api_registro_consulta` (`id_registro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `api_datos_nutriologo`
--
ALTER TABLE `api_datos_nutriologo`
  ADD CONSTRAINT `fk_id_persona_id` FOREIGN KEY (`id_persona`) REFERENCES `api_persona` (`persona_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `api_datos_paciente`
--
ALTER TABLE `api_datos_paciente`
  ADD CONSTRAINT `fk_id_persona_d_p_id` FOREIGN KEY (`id_persona`) REFERENCES `api_persona` (`persona_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `api_dieteticos_frecuencia_semanal`
--
ALTER TABLE `api_dieteticos_frecuencia_semanal`
  ADD CONSTRAINT `fk_id_consulta_paciente_d_f_s_id` FOREIGN KEY (`id_consulta_paciente`) REFERENCES `api_registro_consulta` (`id_registro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `api_dieteticos_instrumento_medicion`
--
ALTER TABLE `api_dieteticos_instrumento_medicion`
  ADD CONSTRAINT `fk_id_consulta_paciente_d_i_m_id` FOREIGN KEY (`id_consulta_paciente`) REFERENCES `api_registro_consulta` (`id_registro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `api_estudio_gastrointestinal`
--
ALTER TABLE `api_estudio_gastrointestinal`
  ADD CONSTRAINT `api_estudio_gastrointestinal_ibfk_1` FOREIGN KEY (`id_registro`) REFERENCES `api_registro_consulta` (`id_registro`);

--
-- Filtros para la tabla `api_explo_fisica`
--
ALTER TABLE `api_explo_fisica`
  ADD CONSTRAINT `fk_id_consulta_paciente_e_f_id` FOREIGN KEY (`id_consulta_paciente`) REFERENCES `api_registro_consulta` (`id_registro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `api_masa_magra_grasa_segmental`
--
ALTER TABLE `api_masa_magra_grasa_segmental`
  ADD CONSTRAINT `fk_id_registro_m_m_g_s_id` FOREIGN KEY (`id_registro`) REFERENCES `api_registro_consulta` (`id_registro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `api_nutriologo_paciente`
--
ALTER TABLE `api_nutriologo_paciente`
  ADD CONSTRAINT `api_nutriologo_paciente_ibfk_1` FOREIGN KEY (`id_nutriologo`) REFERENCES `api_datos_nutriologo` (`id_nutriologo`) ON DELETE CASCADE,
  ADD CONSTRAINT `api_nutriologo_paciente_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `api_datos_paciente` (`id_dato_paciente`) ON DELETE CASCADE;

--
-- Filtros para la tabla `api_registro_consulta`
--
ALTER TABLE `api_registro_consulta`
  ADD CONSTRAINT `fk_id_paciente_r_c_id` FOREIGN KEY (`id_paciente`) REFERENCES `api_datos_paciente` (`id_dato_paciente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `api_resultado_diagnostico`
--
ALTER TABLE `api_resultado_diagnostico`
  ADD CONSTRAINT `fk_id_consulta_paciente_r_d_id` FOREIGN KEY (`id_consulta_paciente`) REFERENCES `api_registro_consulta` (`id_registro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fk_id_registro` FOREIGN KEY (`id_registro`) REFERENCES `api_registro_consulta` (`id_registro`);

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_persona_id_foreign` FOREIGN KEY (`persona_id`) REFERENCES `api_persona` (`persona_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
