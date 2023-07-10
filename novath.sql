-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-07-2023 a las 17:56:10
-- Versión del servidor: 8.0.33
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `novath`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int NOT NULL,
  `cod_entrada` int DEFAULT NULL,
  `id_evento` int DEFAULT NULL,
  `id_usuario` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `cod_entrada` int NOT NULL,
  `id_evento` int DEFAULT NULL,
  `qr` varchar(1000) DEFAULT NULL,
  `butaca` varchar(10) DEFAULT NULL,
  `precio` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `entrada`
--

INSERT INTO `entrada` (`cod_entrada`, `id_evento`, `qr`, `butaca`, `precio`) VALUES
(1, 1, '', '', 6000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `id_evento` int NOT NULL,
  `artista` varchar(60) DEFAULT NULL,
  `nombre_evento` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `horario` varchar(15) DEFAULT NULL,
  `descripcion` varchar(2000) DEFAULT NULL,
  `imagen` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`id_evento`, `artista`, `nombre_evento`, `fecha`, `horario`, `descripcion`, `imagen`) VALUES
(1, 'PARAMOUNT', 'REAL SELF', '2023-07-07', '20:00', 'VUELVE A BUENOS AIRES LA PRIMERA EXPERIENCIA INMERSIVA EN TOTAL ANONIMATO\r\nUn espectáculo diferente a todo lo conocido, donde el verdadero protagonista sos vos.\r\n\r\nREAL SELF quiere decir “SER REAL” y a eso te invita. A que te animes a ser quien realmente sos. Cada función de REAL SELF es exclusiva para 200 personas (capacidad limitada). Quienes participan, lo hacen, poniéndose un traje y una máscara para sumergirse en un TOTAL ANONIMATO frente al resto de los participantes.\r\n\r\nTodo transcurre a través de una voz en off, música original y un mapping 360°, donde los protagonistas son guiados en un gran espacio a vivir distintas emociones, que van desde la euforia más auténtica hasta la reflexión interna más profunda.\r\n\r\nEs una experiencia muy individual y al mismo tiempo absolutamente colectiva.\r\nNo se puede explicar, tenés que vivirlo.\r\n¿TE ANIMAS A SER REAL?\r\n\r\nREAL SELF fue declarado por la prensa especializada, como la evolución del Teatro.\r\n\r\nTe recomendamos asistir con ropa liviana y calzado cómodo (evitar usar tacos altos) ya que vas a estar durante toda la experiencia en constante movimiento. También te recomendamos llegar 30 minutos antes del horario de la función.\r\nTener en cuenta que una vez comenzada la función no se puede ingresar a vivir la experiencia.\r\nApto para mayores de 18 años', '1688990012_RealSelf.jpg'),
(3, 'CAMILA BOCCA FEDERICO FERNÁNDEZ ROCÍO AGÜERO Y MÁS', 'BAB', '2023-07-13', '13:00', '\"Raymonda\" Unos de los clásicos de Marius Petipá que menos se interpretan en Argentina pero de los más hermosos y académicos, Estarán las Primeras Figuras y Solistas del Teatro Colón y del Teatro Argentino interpretando esta pieza con la música de Alexander Glazunov con un vestuario deslumbrante.', '1688990303_bab_ticketek_960x400.png'),
(4, 'EMIR SENSINI', 'EMIR SENSINI', '2023-07-26', '20:30', 'Emir Sensini es un cantante argentino reconocido a nivel mundial, el cual se ha convertido en uno de los grandes exponentes de la música cristiana.\r\n\r\nEl cantante oriundo de Rosario, Santa Fe hoy radica junto a su esposa en Miami Florida y juntos han compuesto gran parte de sus canciones.\r\n\r\nCon una trayectoria de 20 años y 5 álbumes grabados sus canciones se han popularizado en muchos países. En 2016 fue nominado al Latin Grammy a mejor “Álbum de música cristiana en español” Este mes de Julio estará realizando una gira por el País donde estará interpretando gran parte de su repertorio, canciones como “Que tu Espíritu descienda” “Yo sé quien soy” “En lo secreto” “Gracia sublime es” “Recibo mi milagro” y muchas otras más.\r\n\r\nEl artista se encuentra dando su \"Tour 2023\", luego de su gira por Argentina estará visitando ciudades de Costa Rica, Colombia, Estados Unidos, Honduras, Paraguay y Puerto Rico. Este 26 de julio vení a experimentar una verdadera noche de Alabanza y Adoración a Dios. No te lo pierdas!', '1688990353_emir960.png'),
(5, 'ANTONIO NAJARRO', 'QUERENCIA', '2023-07-27', '20:30', 'Tras el gran éxito del último espectáculo de la Compañía de Antonio Najarro, Alento, en el que el que la Danza Estilizada y el Flamenco evolucionan a formas más contemporáneas, mostrando así un nuevo lenguaje y estética dancística, Antonio Najarro afronta su sexta producción, con el deseo de revisitar sus orígenes, de recuperar y ensalzar la inspiración del lenguaje de los grandes ballets coreográficos que en su día hicieron grandes a figuras como Antonio Ruiz Soler, Mariemma, entre otros.\r\n\r\nEspectáculo de danza de gran formato, de 1 hora 15 min de duración sin entreacto, compuesto por 11 cuadros, con 14 bailarines en escena, en igualdad de hombres y mujeres, que convierte a la Compañía de Danza de Antonio Najarro, en la compañía de danza privada con mayor representatividad nacional e internacional de los valores, historia y contenido de toda la Danza Española.\r\n\r\nComo soporte musical de esta gran producción, Najarro ha encargado componer una música original para orquesta sinfónica. Este es otro de los grandes retos de ‘Querencia’, dotar al repertorio de la música española de una nueva composición que llene el vacío que existe en las actuales composiciones sinfónicas para creadores de Danza Española.\r\n\r\nEsta música ha sido compuesta por el pianista Moisés Sánchez y grabada por la Orquesta de Extremadura. Una composición en la que tienen protagonismo los tiempos boleros, ritmos flamencos y melodías que hacen referencia a creaciones de repertorio de grandes compositores como Falla, Turina, Granados, Albéniz, etc, pero con una visión y sonidos totalmente actuales. \r\n\r\nUn espectáculo en el que se pone en valor la Danza Española en todos sus estilos.', '1688990465_querencia.png'),
(6, 'LOS PERICOS', 'LOS PERICOS', '2023-08-05', '21:00', 'En este show repasaran su repertorio plagado de hits y continuaran presentando su nuevo disco Viva Pericos!\r\n\r\nEl proyecto original del disco Viva Pericos tenía como base interpretar clásicos del repertorio musical de habla hispana. Con este punto de partida, Los Pericos armaron una selección de aquellas canciones latinas que marcaron la historia en toda la región, a los cuales le darán una impronta marcada por el clásico sonido “PERICOS”, que ya es marca registrada.\r\n\r\nEsta selección no fue fácil. Tuvieron que ponerse de acuerdo y elegir 11 canciones entre un repertorio de más de quinientas.\r\n\r\nAdemás de los dos singles que ya salieron, hay temas muy conocidos de Miguel Matamorros, Marco Antonio Solís, Los Rodríguez, Jorge Drexler, Julio Iglesias, Robi Draco Rosa, y Daniel Melero.\r\n\r\nCuentan con invitados de lujo como Rubén Albarrán (“Me estás atrapando otra vez”), Carlos Vives (“Tratame suavemente”), Emiliano Brancciari (“La edad del cielo”) y La Delio Valdéz (“Vete ya”).\r\n\r\nEl arte de tapa es un cuadro del artista plástico Milo Lockett. La foto interna es de Nora Lezano. \r\n\r\n¡A disfrutar de este nuevo viaje, que los llevará a recorrer aquellas canciones que marcaron la historia de la música de habla hispana, reversionadas con el clásico sonido Pericos! ', '1688990529_lospericos.png'),
(7, 'ADios', 'Chau', '2023-07-20', '21:00', 'Hola', '1688996189_dabope_un-plan-perfecto_ticketek_960px-x-400px.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contrasena` varchar(200) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `descuento_acumulativo` int DEFAULT NULL,
  `suspension` tinyint(1) DEFAULT NULL,
  `administrador` tinyint(1) DEFAULT NULL,
  `super_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `email`, `contrasena`, `telefono`, `descuento_acumulativo`, `suspension`, `administrador`, `super_admin`) VALUES
(1, 'Emilio', 'Pereira', 'emi@gmail.com', '$2y$10$N9uHs2/9f/UXWijPCvIUEu38D536cG.dB12A0TX9lCXNQJ2ggFMI2', '1111111111', 0, 0, 0, 1),
(2, 'Emilio', 'Pereira', 'pereira@gmail.com', '$2y$10$Vu3pG0EgDhQnUVrDtUkISey.LoFaGIGavasusZUQ6UprRG8fBpBH6', '1111111111', 30, 0, 1, 0),
(3, 'Lucas', 'Bolla', 'lucas@gmail.com', '$2y$10$10cw2UKEDEz/hBeAS5lX/u1iBw4V9VSzTAmDWNf1BxVn0ff7jeM0q', '1111111111', 0, 0, 0, 0),
(4, 'Gonzalo', 'Sánchez', 'gonza@gmail.com', '$2y$10$3WcZqfEKwPde88eGpzIyluMgsfq6dkeYUmuNkWR/Qoi7ShDvJIjKm', '1111111111', 0, 0, 0, 0),
(5, 'Emi', 'Orrego', 'orrego@gmail.com', '$2y$10$byKtHqRYHUIZS2uoNAltJO6k7zj2bNHg0IYnSF4dlIMANb8HTbCyW', '1111111111', 30, 0, 0, 0),
(6, 'hola', 'hola', 'hola@gmail.com', '$2y$10$Vu3pG0EgDhQnUVrDtUkISey.LoFaGIGavasusZUQ6UprRG8fBpBH6', '1111111111', 0, 0, 0, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_evento` (`id_evento`),
  ADD KEY `cod_entrada` (`cod_entrada`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`cod_entrada`),
  ADD KEY `id_evento` (`id_evento`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id_evento`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `cod_entrada` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `id_evento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id_evento`),
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`cod_entrada`) REFERENCES `entrada` (`cod_entrada`),
  ADD CONSTRAINT `compra_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `entrada_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id_evento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
