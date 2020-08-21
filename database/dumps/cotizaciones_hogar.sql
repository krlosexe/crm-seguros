ALTER TABLE `cotizador_hogar` CHANGE `cod_influencer` `influencer_id` INT(150) NOT NULL; 


CREATE TABLE `cotizador_hogar_influencers` (
  `id` int NOT NULL,
  `names` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_names` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
