-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-09-2013 a las 04:52:03
-- Versión del servidor: 5.5.27-log
-- Versión de PHP: 5.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `confe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE IF NOT EXISTS `archivos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `access` text NOT NULL,
  `descripcion` text NOT NULL,
  `email` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conferencias`
--

CREATE TABLE IF NOT EXISTS `conferencias` (
  `cve` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `opcion` text NOT NULL,
  `cve_confe` int(11) NOT NULL,
  PRIMARY KEY (`cve`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `conferencias`
--

INSERT INTO `conferencias` (`cve`, `nombre`, `opcion`, `cve_confe`) VALUES
(1, 'aviso_principal', '<h2 style=\\"text-align: center;\\">EJEMPLO</h2>\r\n<p>&nbsp;</p>\r\n<h2 style=\\"text-align: center;\\">&nbsp;</h2>', 1),
(2, 'hab_tip_usur', '0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_menu` text NOT NULL,
  `accion` text NOT NULL,
  `tipusr` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `nom_menu`, `accion`, `tipusr`) VALUES
(1, 'Evaluacion', 'evaluar', 10),
(2, 'Avisos', 'avisos', 100),
(3, 'Aspirante', 'aspirante', 1),
(4, 'Agenda', 'agenda', 100),
(5, 'Organizacion', 'organizar', 100),
(7, 'Datos Personales', 'aspirante', 10),
(8, 'Datos Personales', 'aspirante', 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ponencias`
--

CREATE TABLE IF NOT EXISTS `ponencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_confe` text NOT NULL,
  `email` text NOT NULL,
  `onsevd` text NOT NULL,
  `situa` text NOT NULL,
  `miembros` text NOT NULL,
  `ortog` text NOT NULL,
  `presen` text NOT NULL,
  `explic` text NOT NULL,
  `refere` text NOT NULL,
  `dates` date NOT NULL,
  `hours` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ponencias`
--

INSERT INTO `ponencias` (`id`, `nom_confe`, `email`, `onsevd`, `situa`, `miembros`, `ortog`, `presen`, `explic`, `refere`, `dates`, `hours`) VALUES
(1, 'USUARIO', 'usuario@localhost', 'gfdgdfgg', 'Se asigno horario de exposicion', '<p>Miembro 1</p>\r\n<p>Miembro 2</p>\r\n<p>Miembro 3</p>', '2', '3', '0', '1', '2001-12-02', '15:00:00'),
(2, 'USUARIO12', 'daiel.ccc', 'fsdfsdfsdf', 'Se asigno horario de exposicion', 'sdfdsfsdf\r\ndsfsdf\r\nfsdf', '1', '2', '3', '0', '2013-06-05', '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `lastnm` text NOT NULL,
  `tipusr` int(11) NOT NULL,
  `passwd` text,
  `email` text NOT NULL,
  `instedu` text NOT NULL,
  `sitacad` text NOT NULL,
  `subject` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `name`, `lastnm`, `tipusr`, `passwd`, `email`, `instedu`, `sitacad`, `subject`) VALUES
(1, 'Organizador', '', 100, 'organ', 'daniel.cruzry@hotmail.com', 'Facultad de Ingenieria Mecanica y Electrica', '', ''),
(2, 'Evaluador', 'dd', 10, 'eval', 'eval@localhost', 'wewewee', 'wewewe', ''),
(3, 'Usuario', 'Comun', 1, 'usuario', 'usuario@localhost', 'FIME', 'ITS', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
