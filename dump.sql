-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18/06/2024 às 05:23
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

DROP DATABASE IF EXISTS db_task_explorer;
CREATE DATABASE db_task_explorer;
USE db_task_explorer;


CREATE TABLE `tasks` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `task_name` VARCHAR(190),
  `task_description` VARCHAR(250),
  `task_image` VARCHAR(50),
  `task_date` DATE,
  `id_usuario` INT,
  FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
);


CREATE TABLE `tbl_list` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `list` varchar(255) NOT NULL,
  `painel` int(11) DEFAULT NULL,
  `id_task` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `tipo_usuario` enum('usuário','Administrador') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_tasks_UNIQUE` (`id`),
  ADD KEY `id_usuario_tasks_idx` (`id_usuario`);

ALTER TABLE `tbl_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_tarefa_UNIQUE` (`id`),
  ADD KEY `id_tasks_list_idx` (`id_task`);



ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `id_usuario_UNIQUE` (`id_usuario`);


ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `tbl_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `tasks`
  ADD CONSTRAINT `id_usuario_tasks` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `tbl_list`
  ADD CONSTRAINT `id_tasks_list` FOREIGN KEY (`id_task`) REFERENCES `tasks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
