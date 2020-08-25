CREATE TABLE `cotizador_hogar` ( `id` bigint UNSIGNED NOT NULL, `tipo_documento` varchar(50) DEFAULT NULL, `documento` varchar(60) DEFAULT NULL, `nombre` varchar(150) DEFAULT NULL, `apellido` varchar(150) DEFAULT NULL, `ciudad` varchar(150) DEFAULT NULL, `telefono` varchar(150) DEFAULT NULL, `correo` varchar(150) DEFAULT NULL, `influencer_id` int NOT NULL, `status` int DEFAULT '1', `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, `updated_at` datetime DEFAULT NULL ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- -- Volcado de datos para la tabla `cotizador_hogar` -- 

 INSERT INTO `cotizador_hogar` (`id`, `tipo_documento`, `documento`, `nombre`, `apellido`, `ciudad`, `telefono`, `correo`, `influencer_id`, `status`, `created_at`, `updated_at`) VALUES (8, 'CEDULA', '1012391200', 'Juan', 'Perez', NULL, '111111111', 'test@gmail.com', 1, 1, '2020-07-29 15:02:09', '2020-08-21 01:02:01')
 ALTER TABLE `cotizador_hogar` ADD UNIQUE KEY `id_cotizador_hogar` (`id`)
 ALTER TABLE `cotizador_hogar` MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12

CREATE TABLE `cotizador_hogar_influencers` (
  `id` int NOT NULL,
  `names` varchar(100)  NOT NULL,
  `last_names` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `code` varchar(100)  DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cotizador_hogar_influencers`
--
ALTER TABLE `cotizador_hogar_influencers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cotizador_hogar_influencers`
--
ALTER TABLE `cotizador_hogar_influencers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

