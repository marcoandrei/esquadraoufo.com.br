-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Tempo de geração: 21/12/2024 às 22:36
-- Versão do servidor: 5.7.44
-- Versão do PHP: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `esq_ufo`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cedentes`
--

CREATE TABLE `cedentes` (
  `id` int(11) NOT NULL,
  `nome` varchar(128) NOT NULL,
  `nacionalidade` varchar(32) NOT NULL,
  `estado_civil` char(1) NOT NULL,
  `profissao` varchar(32) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(11) NOT NULL,
  `sexo` char(1) NOT NULL COMMENT 'F=feminino; M=masculino; O=outro',
  `data_nasc` date NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `cidade` varchar(64) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `pais` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `celular` varchar(16) NOT NULL,
  `selfie_nomearq` varchar(512) DEFAULT NULL,
  `identidade_nomearq` varchar(512) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `responsavel` varchar(32) DEFAULT NULL,
  `data_entrada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `cedentes`
--

INSERT INTO `cedentes` (`id`, `nome`, `nacionalidade`, `estado_civil`, `profissao`, `cpf`, `rg`, `sexo`, `data_nasc`, `endereco`, `cidade`, `estado`, `pais`, `email`, `celular`, `selfie_nomearq`, `identidade_nomearq`, `status`, `responsavel`, `data_entrada`) VALUES
(24, 'Marco Andrei', 'brasileira', 'C', 'empresário', '673.253.350-91', '2044900617', 'M', '1972-09-07', 'Rua Uruguai 91 sala 516', 'Porto Alegre', 'RS', 'Brasil', 'mandrei@gmail.com', '(51) 9 9868-6436', 'Mad_Men_OG.pdf', '704478_175976452543680_1759067607_o.jpg', 0, NULL, '2024-12-21 22:34:51');

-- --------------------------------------------------------

--
-- Estrutura para tabela `obras`
--

CREATE TABLE `obras` (
  `id` int(11) NOT NULL,
  `cedente_id` int(11) NOT NULL,
  `titulo` varchar(128) NOT NULL,
  `duracao` smallint(6) NOT NULL COMMENT 'Em segundos. Máximo: 600s (10min).',
  `data_obra` date NOT NULL,
  `ineditismo` char(1) NOT NULL COMMENT 'P=publicada; I=inédita',
  `data_gravacao` date NOT NULL,
  `hora_gravacao` time NOT NULL,
  `local_gravacao` varchar(512) NOT NULL,
  `cidade_gravacao` varchar(128) NOT NULL,
  `direcao_objeto` varchar(128) NOT NULL,
  `descricao_ocorrido` varchar(1024) NOT NULL,
  `testemunhas` varchar(512) NOT NULL,
  `video_nomearq` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `obras`
--

INSERT INTO `obras` (`id`, `cedente_id`, `titulo`, `duracao`, `data_obra`, `ineditismo`, `data_gravacao`, `hora_gravacao`, `local_gravacao`, `cidade_gravacao`, `direcao_objeto`, `descricao_ocorrido`, `testemunhas`, `video_nomearq`) VALUES
(13, 24, 'UFO', 20, '2010-10-01', 'I', '2010-10-01', '07:23:00', 'Rua das Flores', 'Matatu das Grota', 'Sul', 'Passou voando', 'Minha esposa', 'Snapinsta.app_video_474F6A58C562A54265F1DBBCDD578E91_video_dashinit.mp4');

-- --------------------------------------------------------

--
-- Estrutura para tabela `obras_fotos`
--

CREATE TABLE `obras_fotos` (
  `id` int(11) NOT NULL,
  `obra_id` int(11) NOT NULL,
  `foto_nomearq` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `admin`) VALUES
(1, 'Marco Andrei', 'mandrei@arsnova.digital', '67a34edf5f639998d674b841fc630683', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cedentes`
--
ALTER TABLE `cedentes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `obras`
--
ALTER TABLE `obras`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `obras_fotos`
--
ALTER TABLE `obras_fotos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cedentes`
--
ALTER TABLE `cedentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `obras`
--
ALTER TABLE `obras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `obras_fotos`
--
ALTER TABLE `obras_fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
