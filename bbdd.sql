-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 10-04-2018 a las 21:40:16
-- Versión del servidor: 5.5.59-0+deb8u1
-- Versión de PHP: 5.6.33-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `ranking`
--

DELIMITER $$
--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `UPDATETIMES`() RETURNS text CHARSET latin1
BEGIN 
  
  DECLARE granequipo VARCHAR(50);
  DECLARE equipo VARCHAR(50);
  DECLARE prueba TIME;
  DECLARE id INT;
  DECLARE puntosC1 INT;
  DECLARE puntosC2 INT;
  DECLARE puntosC3 INT;
  DECLARE lapC1 TIME;
  DECLARE lapC2 TIME;
  DECLARE lapC3 TIME;
  DECLARE pista VARCHAR(50);
  DECLARE score INT;
  DECLARE tiempo TIME;
  DECLARE done1 INT DEFAULT FALSE;
  DECLARE csrteam CURSOR FOR 
  	SELECT TEAM FROM EQUIPOS;
  
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done1 = TRUE;


  SET puntosC1 = 0;
  SET puntosC2 = 0;
  SET puntosC3 = 0;
  SET lapC1 = "01:00:00";
  SET lapC2 = "01:00:00";
  SET lapC3 = "01:00:00";

  OPEN csrteam;
  read_loop: LOOP
    FETCH csrteam INTO granequipo;
    
    
      SET puntosC1 = 0;
      SET puntosC2 = 0;
      SET puntosC3 = 0;
      SET lapC1 = "01:00:00";
      SET lapC2 = "01:00:00";
      SET lapC3 = "01:00:00";

    IF done1 THEN
      LEAVE read_loop;
    END IF;

   BLOCK2: BEGIN
   		DECLARE done2 INT DEFAULT FALSE;
	    DECLARE csr CURSOR FOR 
	    	SELECT ID, TEAM, TRACK, PUNTOS, LAP_TIME FROM DATOSJUSTOS r WHERE r.TEAM = granequipo;
		
	    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done2 = TRUE; 
        
	    OPEN csr;
	    inner_loop: LOOP 
	    	FETCH csr INTO id, equipo, pista, score, tiempo;
			
	    	IF done2 THEN 
	    		LEAVE inner_loop;
	    	END IF;
            			            	
	    	IF pista = 'Circuito 1' THEN
	    		IF score > puntosC1 THEN
	    			SET puntosC1 = score;
	    			SET lapC1 = tiempo;
	    		ELSEIF score = puntosC1 AND lapC1 > tiempo THEN
	    			SET lapC1 = tiempo;
	    		END IF;
	    	ELSEIF pista = 'Circuito 2' THEN
	    		IF score > puntosC2 THEN
	    			SET puntosC2 = score;
	    			SET lapC2 = tiempo;
	    		ELSEIF score = puntosC2 AND lapC2 > tiempo THEN
	    			SET lapC2 = tiempo;
	    		END IF;
	    	ELSEIF pista = 'Circuito 3' THEN
	    		IF score > puntosC3 THEN
	    			SET puntosC3 = score;
	    			SET lapC3 = tiempo;
	    		ELSEIF score = puntosC3 AND lapC3 > tiempo THEN
	    			SET lapC3 = tiempo;
	    		END IF;
	    	END IF;
	    	
	    END LOOP inner_loop;
		CLOSE csr;
	END BLOCK2;
	IF granequipo = 'Equipo 2' THEN
		SET prueba = lapC3;
	END IF;

    UPDATE EQUIPOS e SET e.SCOREC1 = puntosC1, e.SCOREC2 = puntosC2, e.SCOREC3 = puntosC3, e.TIMEC1 = lapC1, e.TIMEC2 = lapC2, e.TIMEC3 = lapC3, e.SCORE = (puntosC1 + puntosC3 + puntosC2), e.BEST_TIME = (lapC1 + lapC2 + lapC3) WHERE e.TEAM = granequipo;

    
  END LOOP read_loop;
  CLOSE csrteam;

  
  
  RETURN prueba;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `DATOSJUSTOS`
--
CREATE TABLE IF NOT EXISTS `DATOSJUSTOS` (
`TEAM` varchar(40)
,`TRACK` varchar(40)
,`PUNTOS` bigint(15)
,`LAP_TIME` time
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EQUIPOS`
--

CREATE TABLE IF NOT EXISTS `EQUIPOS` (
  `TEAM` varchar(30) NOT NULL,
  `SCOREC1` int(11) NOT NULL DEFAULT '0',
  `SCOREC2` int(11) NOT NULL DEFAULT '0',
  `SCOREC3` int(11) NOT NULL DEFAULT '0',
  `TIMEC1` time NOT NULL DEFAULT '01:00:00',
  `TIMEC2` time NOT NULL DEFAULT '01:00:00',
  `TIMEC3` time NOT NULL DEFAULT '01:00:00',
  `SCORE` int(11) NOT NULL DEFAULT '0',
  `BEST_TIME` time NOT NULL DEFAULT '01:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `PARRILLA`
--
CREATE TABLE IF NOT EXISTS `PARRILLA` (
`TEAM` varchar(30)
,`SCORE` int(11)
,`BEST_TIME` time
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `REGISTROS`
--

CREATE TABLE IF NOT EXISTS `REGISTROS` (
  `TEAM` varchar(40) NOT NULL,
  `TRACK` varchar(40) NOT NULL,
  `RED` int(11) NOT NULL,
  `GREEN` int(11) NOT NULL,
  `BLUE` int(11) NOT NULL,
  `ORDER` int(11) NOT NULL,
  `BASE` int(11) NOT NULL,
  `LAP_TIME` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Estructura para la vista `DATOSJUSTOS`
--
DROP TABLE IF EXISTS `DATOSJUSTOS`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `DATOSJUSTOS` AS select `r`.`TEAM` AS `TEAM`,`r`.`TRACK` AS `TRACK`,((((`r`.`RED` + `r`.`GREEN`) + `r`.`BLUE`) + `r`.`ORDER`) + `r`.`BASE`) AS `PUNTOS`,`r`.`LAP_TIME` AS `LAP_TIME` from `REGISTROS` `r`;

-- --------------------------------------------------------

--
-- Estructura para la vista `PARRILLA`
--
DROP TABLE IF EXISTS `PARRILLA`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `PARRILLA` AS select `EQUIPOS`.`TEAM` AS `TEAM`,`EQUIPOS`.`SCORE` AS `SCORE`,`EQUIPOS`.`BEST_TIME` AS `BEST_TIME` from `EQUIPOS`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
