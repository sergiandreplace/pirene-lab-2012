# Estructura de la base de dades #
Tenim 3 taules:

  * node\_description: llista de nodes (aparells amb sensors)
  * sensor\_types: llista dels diferents tipus de sensors reconeguts
  * sensor\_readings: llista de dades recollides per cada sensor de cada node

```
--
-- Database: `pirenelab-sensors`
--

-- --------------------------------------------------------

--
-- Table structure for table `node_description`
--

CREATE TABLE IF NOT EXISTS `node_description` (
  `id` int(11) NOT NULL auto_increment,
  `name` text collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci NOT NULL,
  `lat` float NOT NULL,
  `lon` float NOT NULL,
  `alt` float NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `node_description`
--

INSERT INTO `node_description` (`id`, `name`, `description`, `lat`, `lon`, `alt`) VALUES
(1, 'El primer node', 'Arduino board del pirenelab', 42.4565, 1.00138, 100);

-- --------------------------------------------------------

--
-- Table structure for table `sensor_readings`
--

CREATE TABLE IF NOT EXISTS `sensor_readings` (
  `id` int(11) NOT NULL auto_increment,
  `reading_id` int(11) NOT NULL,
  `node_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `type` text collate utf8_unicode_ci NOT NULL,
  `value` double NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `node_id` (`node_id`),
  KEY `reading_id` (`reading_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `sensor_readings`
--

INSERT INTO `sensor_readings` (`id`, `reading_id`, `node_id`, `timestamp`, `type`, `value`) VALUES
(1, 1, 1, '2012-07-22 04:24:20', 'h', 65),
(2, 1, 1, '2012-07-22 04:24:20', 'l', 123.123),
(3, 1, 1, '2012-07-22 04:24:20', 's', 234.234),
(4, 1, 1, '2012-07-22 04:24:20', 't', 25.3),
(5, 1, 1, '2012-07-22 04:24:20', 'lat', 42.456497),
(6, 1, 1, '2012-07-22 04:24:20', 'lon', 1.001376),
(7, 1, 1, '2012-07-22 04:24:20', 'alt', 100),
(8, 2, 1, '2012-07-22 04:24:20', 'h', 67.3),
(9, 2, 1, '2012-07-22 04:24:20', 'l', 125.123),
(10, 2, 1, '2012-07-22 04:24:20', 's', 235.234),
(11, 2, 1, '2012-07-22 04:24:20', 't', 55.3),
(12, 2, 1, '2012-07-22 04:24:20', 'lat', 42.456497),
(13, 2, 1, '2012-07-22 04:24:20', 'lon', 1.001376),
(14, 2, 1, '2012-07-22 04:24:20', 'alt', 100);

-- --------------------------------------------------------

--
-- Table structure for table `sensor_types`
--

CREATE TABLE IF NOT EXISTS `sensor_types` (
  `type` text collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sensor_types`
--

INSERT INTO `sensor_types` (`type`, `description`) VALUES
('h', 'Humitat relativa'),
('l', 'Il.luminació (nivell de llum)'),
('s', 'Só'),
('t', 'Temperatura');
```

# MySQL query #

Query per obtenir la última lectura de tots els sensors del node 1:

```
SELECT * 
FROM  `sensor_readings` 
WHERE node_id =1
AND reading_id = ( 
SELECT MAX( reading_id ) 
FROM sensor_readings
WHERE node_id =1 )
```

# Json Proposal #

Objecte node:

id:int

name:str

desc:str

lat:f

lon:f

alt:f

sensors:array<name:str,value:float,timestamp:long>