-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 12/05/2014 às 17:24
-- Versão do servidor: 5.5.37-0ubuntu0.14.04.1
-- Versão do PHP: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `jk.tenil.com.br_001`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tenilacl_privileges`
--

CREATE TABLE IF NOT EXISTS `tenilacl_privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `resource_id` (`resource_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Fazendo dump de dados para tabela `tenilacl_privileges`
--

INSERT INTO `tenilacl_privileges` (`id`, `role_id`, `resource_id`, `nome`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Visualizar', '2014-05-05 00:00:00', '2014-05-05 00:00:00'),
(2, 5, 2, 'Incluir', '2014-05-05 00:00:00', '2014-05-05 00:00:00'),
(3, 6, 1, 'Excluir', '2014-05-05 00:00:00', '2014-05-07 15:08:08'),
(5, 1, 2, 'Listar', '2014-05-07 15:07:28', '2014-05-07 15:07:28'),
(6, 5, 5, 'Listar', '2014-05-07 15:13:18', '2014-05-07 15:13:18'),
(7, 11, 6, 'Incluir', '2014-05-07 15:16:31', '2014-05-07 15:16:31'),
(8, 11, 6, 'Editar', '2014-05-07 15:16:52', '2014-05-07 15:16:52'),
(9, 11, 6, 'Excluir', '2014-05-07 15:17:07', '2014-05-07 15:17:07'),
(10, 11, 6, 'Listar', '2014-05-07 15:17:15', '2014-05-07 15:17:15'),
(11, 12, 7, 'Listar', '2014-05-08 16:14:22', '2014-05-08 16:14:22');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tenilacl_resources`
--

CREATE TABLE IF NOT EXISTS `tenilacl_resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Fazendo dump de dados para tabela `tenilacl_resources`
--

INSERT INTO `tenilacl_resources` (`id`, `nome`, `created_at`, `updated_at`) VALUES
(1, 'Posts', '2014-05-05 00:00:00', '2014-05-05 00:00:00'),
(2, 'Páginas', '2014-05-05 00:00:00', '2014-05-05 00:00:00'),
(4, 'Teste', '2014-05-05 18:30:43', '2014-05-06 14:55:45'),
(5, 'Área Diferente', '2014-05-07 15:12:19', '2014-05-07 15:12:19'),
(6, 'Área Administrativa de Usuários', '2014-05-07 15:16:11', '2014-05-07 15:16:11'),
(7, 'Área Administrativa da Revista Mensagem', '2014-05-08 16:13:54', '2014-05-08 16:13:54');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tenilacl_roles`
--

CREATE TABLE IF NOT EXISTS `tenilacl_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Fazendo dump de dados para tabela `tenilacl_roles`
--

INSERT INTO `tenilacl_roles` (`id`, `parent_id`, `nome`, `is_admin`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Visitante', 0, '2014-05-01 00:00:00', '2014-05-01 00:00:00'),
(5, 1, 'Registrado', 0, '2014-05-01 00:00:00', '2014-05-01 00:00:00'),
(6, 5, 'Redator', 0, '2014-05-01 00:00:00', '2014-05-01 00:00:00'),
(7, NULL, 'Admin', 1, '2014-05-01 00:00:00', '2014-05-01 00:00:00'),
(11, 1, 'Administrador de Usuários', 0, '2014-05-07 15:15:26', '2014-05-07 15:15:26'),
(12, 1, 'Revista Mensagem', 0, '2014-05-08 16:13:29', '2014-05-08 16:13:29');

-- --------------------------------------------------------

--
-- Estrutura para tabela `teniluser_user`
--

CREATE TABLE IF NOT EXISTS `teniluser_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `activation_key` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Fazendo dump de dados para tabela `teniluser_user`
--

INSERT INTO `teniluser_user` (`id`, `nome`, `email`, `password`, `salt`, `active`, `activation_key`, `updated_at`, `created_at`) VALUES
(1, 'Roberto', 'roberto.tenil@gmail.com', 'tg==', 'dPmYXr/T4IY=', 0, '109eb20047dade7a3f24a0b3548e8774', '2014-03-10 15:31:34', '2014-03-10 15:31:34'),
(3, 'Roberval', 'tenil@outlook.com', '1A==', '42yzmkurYKs=', 1, '61d2bd91b9eb72f74476f1acff576ed4', '2014-03-10 15:40:40', '2014-03-10 15:40:40'),
(4, 'Roberto', 'roberto.tenil1321@gmail.com', 'eQ==', 'E7aL2XjaVEY=', 0, '20b75e719a9206c230bd06b9e18d1bba', '2014-03-10 17:03:01', '2014-03-10 17:03:01'),
(5, 'Hugo Oliveira Agape', 'hugo.o.apage@gmail.com', 'Ng==', 'xLoNxvvLqKs=', 0, 'a0b55803b24b7586ba5d4567ef52ffa5', '2014-03-10 17:25:20', '2014-03-10 17:25:20'),
(6, 'datahora', 'asdfasfasdf@asdfasdf.com', 'wA==', 'dgjdudfLQ2Y=', 0, 'c3308d6a5bbec377b127ef77a3ab17b7', '2014-05-06 12:51:21', '2014-05-05 19:56:12'),
(7, 'Teste de data e hora', 'datahora@gmail.com', 'tA==', 'a8KD9DOzGuU=', 0, '60f4e496320844fa968e63865caec80d', '2014-05-06 14:51:26', '2014-05-06 14:51:04');

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `tenilacl_privileges`
--
ALTER TABLE `tenilacl_privileges`
  ADD CONSTRAINT `tenilacl_privileges_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tenilacl_roles` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tenilacl_privileges_ibfk_2` FOREIGN KEY (`resource_id`) REFERENCES `tenilacl_resources` (`id`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `tenilacl_roles`
--
ALTER TABLE `tenilacl_roles`
  ADD CONSTRAINT `tenilacl_roles_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `tenilacl_roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
