-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Jun-2020 às 00:33
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `acad`
--
CREATE DATABASE IF NOT EXISTS `acad` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `acad`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm`
--

CREATE TABLE `adm` (
  `cod_adm` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `adm`
--

INSERT INTO `adm` (`cod_adm`, `nome`, `email`, `senha`) VALUES
(2, 'root', 'root@root.com.br', '123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `cod` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `data_nasc` date NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `peso` decimal(10,0) NOT NULL,
  `endereco` varchar(30) NOT NULL,
  `numero` int(11) NOT NULL,
  `id_plano` int(11) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `senha` char(40) NOT NULL,
  `altura` decimal(10,0) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`cod`, `nome`, `data_nasc`, `cpf`, `peso`, `endereco`, `numero`, `id_plano`, `tel`, `senha`, `altura`, `email`) VALUES
(1, 'Andre Crozatti', '2020-05-30', '511.190.028-42', '0', 'teste endereco', 0, 0, '', '669a9781d875a136013367b13985273ad7a1ec65', '0', '123@123.com.br'),
(2, 'cleiton', '0000-00-00', '123123123123', '0', 'asijdhgsaudy', 0, 0, '', '669a9781d875a136013367b13985273ad7a1ec65', '0', 'teste@teste.com.br'),
(3, 'valdecir', '0000-00-00', '123123123123', '0', 'asijdhgsaudy', 3213, 0, '', '669a9781d875a136013367b13985273ad7a1ec65', '0', ''),
(4, 'jobson', '0000-00-00', '123123123123', '2123', 'asijdhgsaudy', 3213, 0, '', '669a9781d875a136013367b13985273ad7a1ec65', '0', ''),
(5, 'asdsadas', '2020-05-04', '123123123123', '2123', 'asijdhgsaudy', 3213, 0, '', '669a9781d875a136013367b13985273ad7a1ec65', '123213', ''),
(6, 'asdsadas', '2020-05-04', '123123123123', '2123', 'asijdhgsaudy', 3213, 0, '12321312', '669a9781d875a136013367b13985273ad7a1ec65', '123213', ''),
(8, 'Andre teste 2', '1998-11-17', '21321321', '100', 'teste endereco', 314, 0, '34343434', '669a9781d875a136013367b13985273ad7a1ec65', '100', 'andrecrozatti12@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aulas`
--

CREATE TABLE `aulas` (
  `cod_aula` int(11) NOT NULL,
  `nome_aula` varchar(20) NOT NULL,
  `hora` time NOT NULL,
  `duracao` time NOT NULL,
  `cod_prof` int(11) NOT NULL,
  `semana` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `aulas`
--

INSERT INTO `aulas` (`cod_aula`, `nome_aula`, `hora`, `duracao`, `cod_prof`, `semana`) VALUES
(1, 'Jumping', '20:09:00', '02:00:52', 1, ''),
(2, 'spinnig', '13:00:00', '01:00:00', 1, 'Segunda'),
(4, 'Musculação', '00:19:00', '00:01:00', 2, 'Segunda');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aula_aluno`
--

CREATE TABLE `aula_aluno` (
  `cod_aula` int(11) NOT NULL,
  `cod_aluno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `aula_aluno`
--

INSERT INTO `aula_aluno` (`cod_aula`, `cod_aluno`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `cod_prof` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `data_nasc` date NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `endereco` varchar(30) NOT NULL,
  `numero` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`cod_prof`, `nome`, `data_nasc`, `cpf`, `endereco`, `numero`, `email`, `tel`, `senha`) VALUES
(1, 'cleiton', '2020-05-21', '12343214', 'teste endereco', 3213, 'andrecrozatti12@gmail.com', '321351651651', ''),
(2, 'vagner', '1998-11-17', '65165', '1askhdgbsaudyhb', 12, '', '321321321', ''),
(4, 'Ronaldo de Souza', '1999-06-18', '1444444444', 'RUA XYZ', 314, '', '3434343434', ''),
(5, 'Kleberson', '1998-11-17', '1651651', 'endereço', 314, 'teste123@teste.com.br', '34343434', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `adm`
--
ALTER TABLE `adm`
  ADD PRIMARY KEY (`cod_adm`);

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`cod_aula`);

--
-- Índices para tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`cod_prof`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adm`
--
ALTER TABLE `adm`
  MODIFY `cod_adm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `aulas`
--
ALTER TABLE `aulas`
  MODIFY `cod_aula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `cod_prof` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
