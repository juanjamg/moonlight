-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-05-2026 a las 06:04:01
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
-- Base de datos: `tienda_videojuegos_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `rfc` varchar(13) DEFAULT NULL,
  `puntos_acumulados` int(11) DEFAULT 0,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `telefono`, `email`, `rfc`, `puntos_acumulados`, `fecha_registro`) VALUES
(10, 'Yael Ivan', '6251234567', 'yael@gmail.com', 'MIDY123021ABC', 0, '2026-04-14 01:23:05'),
(11, 'Juan Javier', '6146795922', 'jajuan095@gmail.com', 'MIGJ990818AAA', 0, '2026-04-14 05:01:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detalle` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id_detalle`, `id_venta`, `id_producto`, `cantidad`, `precio_unitario`) VALUES
(7, 9, 8, 1, 750.00),
(8, 10, 8, 1, 750.00),
(14, 20, 15, 1, 3000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plataformas`
--

CREATE TABLE `plataformas` (
  `id_plataforma` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `plataformas`
--

INSERT INTO `plataformas` (`id_plataforma`, `nombre`) VALUES
(3, 'Nintendo Switch'),
(4, 'PC'),
(1, 'PlayStation 5'),
(5, 'Retro'),
(2, 'Xbox Series X');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `codigo_barras` varchar(50) DEFAULT NULL,
  `id_plataforma` int(11) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `precio_costo` decimal(10,2) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `es_usado` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `codigo_barras`, `id_plataforma`, `stock`, `precio_costo`, `precio_venta`, `es_usado`, `fecha_registro`) VALUES
(8, 'Minecraft', '123456789987456321', 4, 1, 750.00, 1000.00, 0, '2025-11-29 00:07:44'),
(14, 'Control', '789987', 2, 18, 1500.00, 3000.00, 0, '2025-12-02 01:20:27'),
(15, 'Mouse gamer', '12323234', 4, 1, 2500.00, 3000.00, 0, '2025-12-05 21:42:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `rol` enum('Admin','Vendedor') NOT NULL DEFAULT 'Vendedor',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_completo`, `nombre_usuario`, `password_hash`, `rol`, `fecha_creacion`) VALUES
(3, 'Administrador Principal', 'juanja', '$2y$10$yld04rMgbRn9LP8WOeanQ.svmhz8AbKCYXMK3eGviYo22VMrkxwYe', 'Admin', '2025-11-18 20:41:31'),
(4, 'Yael Miranda Delgado', 'yael', '$2y$10$m209j9fvQQCQqdIJjPJ2luh6tTuzSkP9x1aPYC670uHgMRlGDtXCS', 'Vendedor', '2026-05-09 21:45:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `fecha_venta` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `metodo_pago` enum('Efectivo','Tarjeta','Transferencia') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_usuario`, `id_cliente`, `fecha_venta`, `total`, `metodo_pago`) VALUES
(1, 3, NULL, '2025-11-18 23:07:14', 800.00, 'Efectivo'),
(2, 3, NULL, '2025-11-18 23:09:47', 800.00, 'Efectivo'),
(3, 3, NULL, '2025-11-18 23:16:15', 1600.00, 'Tarjeta'),
(4, 3, NULL, '2025-11-21 17:44:05', 800.00, 'Efectivo'),
(5, 3, NULL, '2025-11-21 17:44:19', 800.00, 'Tarjeta'),
(6, 3, NULL, '2025-11-21 17:48:41', 1200.00, 'Transferencia'),
(9, 3, NULL, '2025-11-28 18:15:49', 750.00, 'Efectivo'),
(10, 3, NULL, '2025-11-28 18:29:54', 750.00, 'Transferencia'),
(20, 3, NULL, '2025-12-05 17:31:09', 3000.00, 'Efectivo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `rfc` (`rfc`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `fk_detalle_producto` (`id_producto`);

--
-- Indices de la tabla `plataformas`
--
ALTER TABLE `plataformas`
  ADD PRIMARY KEY (`id_plataforma`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `codigo_barras` (`codigo_barras`),
  ADD KEY `id_plataforma` (`id_plataforma`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `fk_venta_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `plataformas`
--
ALTER TABLE `plataformas`
  MODIFY `id_plataforma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_detalle_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_plataforma`) REFERENCES `plataformas` (`id_plataforma`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_venta_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE SET NULL,
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
