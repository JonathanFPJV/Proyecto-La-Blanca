-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2024 a las 04:55:08
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `la_blanca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenes`
--

CREATE TABLE `almacenes` (
  `Id_Almacen` bigint(20) UNSIGNED NOT NULL,
  `Nombre_almacen` varchar(100) NOT NULL,
  `Direccion_almacen` varchar(100) NOT NULL,
  `Capacidad` int(11) NOT NULL,
  `capacidad_disponible` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `id_comentario` bigint(20) UNSIGNED NOT NULL,
  `Puntuacion` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Comentario` text NOT NULL,
  `ID_Usuario` bigint(20) UNSIGNED NOT NULL,
  `Id_Producto` bigint(20) UNSIGNED NOT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  `estado` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `idCompras` bigint(20) UNSIGNED NOT NULL,
  `id_orden` varchar(50) NOT NULL,
  `id_pedido` varchar(45) DEFAULT NULL,
  `id_envio` varchar(45) DEFAULT NULL,
  `Estado` varchar(45) NOT NULL,
  `Monto` double NOT NULL,
  `Fecha` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta_bancarias`
--

CREATE TABLE `cuenta_bancarias` (
  `id_cuenta` bigint(20) UNSIGNED NOT NULL,
  `Tipo_cuenta` varchar(50) NOT NULL,
  `Nombre_banco` varchar(255) DEFAULT NULL,
  `Num_cuenta` varchar(50) DEFAULT NULL,
  `paypal_email` varchar(255) DEFAULT NULL,
  `ID_Usuario` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios`
--

CREATE TABLE `envios` (
  `n_envio` varchar(45) NOT NULL,
  `Monto` double NOT NULL,
  `Fecha_ENTREGA` date NOT NULL,
  `Direccion_entrega` varchar(255) NOT NULL,
  `Estado` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Estructura de tabla para la tabla `logisticas`
--

CREATE TABLE `logisticas` (
  `Id_Logistica` bigint(20) UNSIGNED NOT NULL,
  `Id_usuario` bigint(20) UNSIGNED NOT NULL,
  `Id_Almacen` bigint(20) UNSIGNED NOT NULL,
  `Id_Producto` bigint(20) UNSIGNED NOT NULL,
  `n_orden` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(4, '2024_06_06_143305_create_productos_table', 2),
(5, '2024_06_01_000004_create_productos_table', 3),
(6, '2024_06_01_000005_create_almacens_table', 3),
(7, '2024_06_01_000006_create_logisticas_table', 3),
(8, '2024_06_06_162322_add_imagen_to_productos_table', 4),
(9, '2024_06_09_211055_create_tipo_usuarios_table', 5),
(10, '2024_06_09_000005_create_tipo_usuarios_table', 6),
(11, '2024_06_09_000007_create_almacens_table', 6),
(12, '2024_06_09_000008_create_productos_table', 6),
(13, '2024_06_09_000009_create_comentarios_table', 7),
(14, '2024_06_09_000010_create_pedidos_table', 7),
(15, '2024_06_09_000011_create_envios_table', 7),
(16, '2024_06_09_000012_create_compras_table', 8),
(17, '2024_06_09_000013_add_custom_fields_to_users_table', 8),
(18, '2024_06_09_000007_create_almacenes_table', 9),
(19, '2024_06_09_000014_create_cuenta_bancarias_table', 10),
(20, '2024_06_09_000015_create_compras_table', 11),
(21, '2024_06_09_000016_create_logisticas_table', 12);

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
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `n_pedido` varchar(45) NOT NULL,
  `Estado` varchar(45) NOT NULL,
  `Fecha_pedido` date NOT NULL,
  `Monto_total` double NOT NULL,
  `metodo_pago` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `Id_Producto` bigint(20) UNSIGNED NOT NULL,
  `Codigo_producto` varchar(45) NOT NULL,
  `Nombre_producto` varchar(45) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  `Precio` double NOT NULL,
  `Categoria` varchar(45) NOT NULL,
  `Talla` varchar(45) NOT NULL,
  `Color` varchar(45) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `precio_descuento` double DEFAULT NULL,
  `descuento` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
('gcE62gphrq7AzAhmIha9YeaETl0uZKtuYtQ4aHeo', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidWkyYXhJbTBIcXp1a1FxNEJreFlmaFY0YldSYzR2VnV6MmJ1S2UzUyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozODoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL3Byb2R1Y3Rvcy9jcmVhdGUiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozODoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL3Byb2R1Y3Rvcy9jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1717692536),
('SnYQbt8AWuhhDJHXzKPUljbvGdlXASEUFMN56TS8', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQWVMM0xENUJTYTVrT3FjdnZURkxBQzVDdTVpTHZXTTVLSlE5a0FnTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wYXlwYWwiO319', 1717808134);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuarios`
--

CREATE TABLE `tipo_usuarios` (
  `ID_Tipo` bigint(20) UNSIGNED NOT NULL,
  `Nombre_tipo` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `nombreusuario` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `avatar_original` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `ID_Tipo` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  ADD PRIMARY KEY (`Id_Almacen`);

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
  ADD KEY `comentarios_id_usuario_foreign` (`ID_Usuario`),
  ADD KEY `comentarios_id_producto_foreign` (`Id_Producto`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`idCompras`),
  ADD UNIQUE KEY `compras_id_orden_unique` (`id_orden`),
  ADD KEY `compras_id_pedido_foreign` (`id_pedido`),
  ADD KEY `compras_id_envio_foreign` (`id_envio`);

--
-- Indices de la tabla `cuenta_bancarias`
--
ALTER TABLE `cuenta_bancarias`
  ADD PRIMARY KEY (`id_cuenta`),
  ADD KEY `cuenta_bancarias_id_usuario_foreign` (`ID_Usuario`);

--
-- Indices de la tabla `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`n_envio`);

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
-- Indices de la tabla `logisticas`
--
ALTER TABLE `logisticas`
  ADD PRIMARY KEY (`Id_Logistica`),
  ADD KEY `logisticas_id_usuario_foreign` (`Id_usuario`),
  ADD KEY `logisticas_id_almacen_foreign` (`Id_Almacen`),
  ADD KEY `logisticas_id_producto_foreign` (`Id_Producto`),
  ADD KEY `logisticas_n_orden_foreign` (`n_orden`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`n_pedido`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Id_Producto`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `tipo_usuarios`
--
ALTER TABLE `tipo_usuarios`
  ADD PRIMARY KEY (`ID_Tipo`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_id_tipo_foreign` (`ID_Tipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  MODIFY `Id_Almacen` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `idCompras` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuenta_bancarias`
--
ALTER TABLE `cuenta_bancarias`
  MODIFY `id_cuenta` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT de la tabla `logisticas`
--
ALTER TABLE `logisticas`
  MODIFY `Id_Logistica` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `Id_Producto` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_usuarios`
--
ALTER TABLE `tipo_usuarios`
  MODIFY `ID_Tipo` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_id_producto_foreign` FOREIGN KEY (`Id_Producto`) REFERENCES `productos` (`Id_Producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentarios_id_usuario_foreign` FOREIGN KEY (`ID_Usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_id_envio_foreign` FOREIGN KEY (`id_envio`) REFERENCES `envios` (`n_envio`) ON DELETE CASCADE,
  ADD CONSTRAINT `compras_id_pedido_foreign` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`n_pedido`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cuenta_bancarias`
--
ALTER TABLE `cuenta_bancarias`
  ADD CONSTRAINT `cuenta_bancarias_id_usuario_foreign` FOREIGN KEY (`ID_Usuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `logisticas`
--
ALTER TABLE `logisticas`
  ADD CONSTRAINT `logisticas_id_almacen_foreign` FOREIGN KEY (`Id_Almacen`) REFERENCES `almacenes` (`Id_Almacen`),
  ADD CONSTRAINT `logisticas_id_producto_foreign` FOREIGN KEY (`Id_Producto`) REFERENCES `productos` (`Id_Producto`),
  ADD CONSTRAINT `logisticas_id_usuario_foreign` FOREIGN KEY (`Id_usuario`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `logisticas_n_orden_foreign` FOREIGN KEY (`n_orden`) REFERENCES `compras` (`id_orden`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_tipo_foreign` FOREIGN KEY (`ID_Tipo`) REFERENCES `tipo_usuarios` (`ID_Tipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
