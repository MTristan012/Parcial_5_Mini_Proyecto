-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-07-2023 a las 06:09:46
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `miniproyector`
--

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
  `permission` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `address` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `dni` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `permission`, `status`, `address`, `birthday`, `class`, `dni`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin', NULL, '$2y$10$a8P2B5pzYVszljU974NRguxpHIo2HBdrBQ2urWOmuGRveuijHwBj2', 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-07-08 01:18:38', '2023-07-08 01:18:38'),
(2, 'Teacher', 'teacher@teacher', NULL, '$2y$10$0akXLqrB7bT1Skg28uHPX.u2BB7LuBu8LXjTXteu54XunBDHooncW', 2, 1, NULL, NULL, NULL, NULL, NULL, '2023-07-08 09:40:18', '2023-07-08 09:40:18'),
(3, 'Student', 'student@student', NULL, '$2y$10$zJySqsKLjV5vzkeiVv9YZu.Iz7xwTDDxPb4zf/gHhvIv/J3yYiA5G', 3, 1, NULL, NULL, NULL, NULL, NULL, '2023-07-08 09:47:00', '2023-07-08 09:47:00'),
(4, 'User', 'user@user', NULL, '$2y$10$ccjyPLNs1p6q4m0HvgHSJeVFkEP2zcUq86xl.F62MBCiklM3QEq4S', 0, 1, NULL, NULL, NULL, NULL, NULL, '2023-07-08 10:04:42', '2023-07-08 10:04:42');

--
-- Índices para tablas volcadas
--

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
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
