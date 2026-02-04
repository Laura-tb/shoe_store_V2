-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-01-2026 a las 12:21:03
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
-- Base de datos: `shoe_store`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id_order`, `user_id`, `total`, `created_at`) VALUES
(1, 1, 102.94, '2025-12-06 12:52:32'),
(2, 2, 188.98, '2025-12-06 12:56:26'),
(3, 1, 73.90, '2025-12-06 12:58:47'),
(4, 3, 170.98, '2025-12-06 13:11:33'),
(5, 3, 25.99, '2025-12-06 13:13:41'),
(6, 3, 51.98, '2025-12-06 13:28:38'),
(7, 3, 232.97, '2025-12-06 13:29:27'),
(8, 3, 43.99, '2025-12-06 13:33:47'),
(9, 13, 73.90, '2025-12-06 13:38:56'),
(10, 13, 112.95, '2025-12-06 13:39:38'),
(11, 13, 42.99, '2025-12-06 13:45:21'),
(12, 13, 144.99, '2025-12-06 13:46:41'),
(13, 1, 164.93, '2025-12-06 15:02:51'),
(14, 1, 144.99, '2025-12-06 15:39:25'),
(15, 1, 36.95, '2025-12-06 15:49:08'),
(16, 1, 42.99, '2025-12-06 15:52:18'),
(17, 2, 42.99, '2025-12-06 15:59:42'),
(18, 2, 112.95, '2025-12-06 16:07:52'),
(19, 2, 112.95, '2025-12-06 16:09:29'),
(20, 2, 112.95, '2025-12-06 16:11:12'),
(21, 2, 112.95, '2025-12-06 16:11:52'),
(22, 16, 200.93, '2025-12-06 16:53:34'),
(23, 1, 59.95, '2025-12-06 19:23:27'),
(24, 1, 262.85, '2025-12-06 19:24:16'),
(25, 1, 186.85, '2025-12-06 19:26:03'),
(26, 1, 51.98, '2025-12-10 12:12:47'),
(27, 1, 149.90, '2025-12-10 19:36:45'),
(28, 1, 119.90, '2025-12-11 11:25:47'),
(29, 1, 186.85, '2025-12-11 11:36:09'),
(30, 1, 180.90, '2025-12-30 09:45:51'),
(31, 1, 225.90, '2025-12-30 15:14:20'),
(32, 1, 127.94, '2025-12-30 19:04:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_items`
--

CREATE TABLE `order_items` (
  `id_order_items` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty_order_items` int(11) NOT NULL,
  `unit_price_order_items` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `order_items`
--

INSERT INTO `order_items` (`id_order_items`, `order_id`, `product_id`, `qty_order_items`, `unit_price_order_items`) VALUES
(1, 1, 16, 1, 59.95),
(2, 1, 18, 1, 42.99),
(3, 2, 19, 1, 43.99),
(4, 2, 20, 1, 144.99),
(5, 3, 21, 2, 36.95),
(7, 4, 20, 1, 144.99),
(10, 7, 20, 1, 144.99),
(11, 7, 19, 2, 43.99),
(12, 8, 19, 1, 43.99),
(13, 9, 21, 2, 36.95),
(14, 10, 17, 1, 112.95),
(15, 11, 18, 1, 42.99),
(16, 12, 20, 1, 144.99),
(18, 13, 17, 1, 112.95),
(19, 14, 20, 1, 144.99),
(20, 15, 21, 1, 36.95),
(21, 16, 18, 1, 42.99),
(22, 17, 18, 1, 42.99),
(23, 18, 17, 1, 112.95),
(24, 19, 17, 1, 112.95),
(25, 20, 17, 1, 112.95),
(26, 21, 17, 1, 112.95),
(27, 22, 19, 2, 43.99),
(28, 22, 17, 1, 112.95),
(29, 23, 16, 1, 59.95),
(30, 24, 21, 1, 36.95),
(31, 24, 17, 2, 112.95),
(32, 25, 17, 1, 112.95),
(33, 25, 21, 2, 36.95),
(35, 27, 17, 1, 112.95),
(36, 27, 21, 1, 36.95),
(37, 28, 16, 2, 59.95),
(38, 29, 17, 1, 112.95),
(39, 29, 21, 2, 36.95),
(40, 30, 27, 1, 67.95),
(41, 30, 17, 1, 112.95),
(42, 31, 17, 2, 112.95),
(43, 32, 27, 1, 67.95),
(44, 32, 28, 1, 59.99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `image_product` varchar(255) DEFAULT NULL,
  `name_product` varchar(100) NOT NULL,
  `price_product` decimal(10,2) NOT NULL,
  `stock_product` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id_product`, `image_product`, `name_product`, `price_product`, `stock_product`, `created_at`) VALUES
(16, '16.webp', 'Adidas Performance Runfalcon 5', 45.95, 27, '2025-11-24 09:29:04'),
(17, '17.webp', 'Nike Performance Vomero 18', 112.95, 45, '2025-11-24 09:33:49'),
(18, '18.webp', 'Adidas Performance Galaxy 7 Hombre', 42.99, 17, '2025-11-24 09:34:46'),
(19, '19.webp', 'Adidas Performance Galaxy 7 Mujer', 43.99, 25, '2025-11-24 09:35:58'),
(20, '20.webp', 'Asics Gel Kayano 32 Hombre', 144.99, 12, '2025-11-24 09:39:52'),
(21, '21.webp', 'Adidas Performance Runfalcon 5 Hombre', 36.95, 41, '2025-11-24 09:41:30'),
(24, '24.webp', 'Puma Cell Thrill Dash Mujer', 59.95, 20, '2025-12-11 11:12:57'),
(25, '25.webp', 'Joma Master 1000 Clay Hombre', 36.76, 2, '2025-12-11 11:14:17'),
(26, '26.webp', 'Asics Patriot RWC 14 Mujer', 57.95, 12, '2025-12-11 11:15:12'),
(27, '27.webp', 'Puma PWR Hybrid TR Mujer', 67.95, 44, '2025-12-11 11:16:10'),
(28, '28.webp', 'Adidas Run 70S 2.0 Hombre', 59.99, 2, '2025-12-11 11:16:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(120) NOT NULL,
  `name` varchar(80) NOT NULL,
  `surname` varchar(150) NOT NULL,
  `pass_hash` varchar(255) NOT NULL,
  `role` enum('admin','client') NOT NULL DEFAULT 'client',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `surname`, `pass_hash`, `role`, `created_at`) VALUES
(1, 'laura@gmail.com', 'Laura', 'Perez López', 'Laura_12345', 'client', '2025-11-07 12:15:56'),
(2, 'pablo@gmail.com', 'Pablo', 'Lopez Martinez', 'Pablo_12345', 'client', '2025-11-07 12:17:39'),
(3, 'sonia@gmail.com', 'Sonia', 'Fernandez Ruiz', 'Sonia_12345', 'client', '2025-11-07 12:18:36'),
(4, 'admin1@test.com', 'Admin', 'Admin', 'Admin1_00000', 'admin', '2025-11-07 12:20:10'),
(13, 'alba@gmail.com', 'Alba', 'Rodriguez', 'Alba_12345', 'client', '2025-11-17 10:40:59'),
(16, 'lucas@gmail.com', 'Lucas', 'Rodriguez', 'Lucas_11111', 'client', '2025-11-23 12:43:33'),
(31, 'alfredo@gmail.com', 'Alfredo', 'González', 'Alfredo_00000', 'client', '2025-12-11 11:36:59'),
(32, 'lorena@gmail.com', 'Lorena', 'Garcia', 'Lorena_12345', 'client', '2025-12-30 14:47:07');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id_order_items`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id_order_items` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id_order`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_product`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
