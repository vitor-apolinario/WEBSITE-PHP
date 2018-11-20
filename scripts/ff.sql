-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 20-Nov-2018 às 17:59
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ff`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `caminhao`
--

CREATE TABLE `caminhao` (
  `placa` varchar(7) NOT NULL,
  `apelido` varchar(15) NOT NULL,
  `tipo` varchar(3) NOT NULL,
  `motorista` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `caminhoneiro`
--

CREATE TABLE `caminhoneiro` (
  `cpf` varchar(11) NOT NULL,
  `cnh` char(1) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `fone` varchar(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `dtnasc` date NOT NULL,
  `ender` varchar(50) NOT NULL,
  `ender_cida` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `caminhoneiro`
--

INSERT INTO `caminhoneiro` (`cpf`, `cnh`, `nome`, `fone`, `email`, `dtnasc`, `ender`, `ender_cida`) VALUES
('08680686913', 'D', 'Vitor Antonio Apolinário', '3329-3275', 'vitorapoli@gmail.com', '1999-06-10', 'julio gasparetto', 'POA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

CREATE TABLE `cidade` (
  `sigla` varchar(3) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `estado` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cidade`
--

INSERT INTO `cidade` (`sigla`, `nome`, `estado`) VALUES
('CBW', 'Curitiba', 'PR'),
('POA', 'Porto Alegre', 'RS'),
('SPO', 'São Paulo', 'SP'),
('XAP', 'Chapecó', 'SC');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `cnpj` varchar(14) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `ender` varchar(30) NOT NULL,
  `fone` varchar(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `ender_cidad` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`cnpj`, `nome`, `ender`, `fone`, `email`, `ender_cidad`) VALUES
('75639534000161', 'Apoli representações comerciais', 'julio gasparetto', '33293275', 'apoli@yahoo.com', 'CBW');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

CREATE TABLE `estado` (
  `sigla` varchar(3) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estado`
--

INSERT INTO `estado` (`sigla`, `nome`) VALUES
('PR', 'Paraná'),
('RS', 'Rio Grande do Sul'),
('SC', 'Santa Catarina'),
('SP', 'São Paulo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `frete`
--

CREATE TABLE `frete` (
  `ciot` bigint(20) UNSIGNED NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `peso` decimal(10,2) NOT NULL,
  `volume` decimal(10,2) NOT NULL,
  `ret_local` varchar(50) NOT NULL,
  `ent_local` varchar(50) NOT NULL,
  `ret_dthr` datetime NOT NULL,
  `ent_dthr` datetime DEFAULT NULL,
  `tipo_cami` varchar(3) DEFAULT NULL,
  `contratante` varchar(14) NOT NULL,
  `motorista` varchar(11) DEFAULT NULL,
  `ret_cidad` varchar(3) NOT NULL,
  `ent_cidad` varchar(3) NOT NULL,
  `tipo` varchar(3) NOT NULL,
  `obs` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `frete`
--

INSERT INTO `frete` (`ciot`, `valor`, `peso`, `volume`, `ret_local`, `ent_local`, `ret_dthr`, `ent_dthr`, `tipo_cami`, `contratante`, `motorista`, `ret_cidad`, `ent_cidad`, `tipo`, `obs`) VALUES
(15, '3.00', '1.00', '2.00', 'rua das bromelias', '34234', '2018-01-01 20:20:00', '2018-11-19 19:50:18', 'NA', '75639534000161', '08680686913', 'CBW', 'POA', 'FIG', 'testetestetestetestetestetestetestetestetesteteste'),
(16, '212.00', '213.00', '1231.00', 'rua das bromelias', 'rua dos canisso', '2018-01-01 20:20:00', '2018-11-19 20:03:27', 'CMB', '75639534000161', '08680686913', 'XAP', 'POA', 'GRN', '123123wefdsdfsdfgw4tr345345'),
(17, '4234.00', '5312.00', '4324.00', 'rua das bromelias', 'rua dos canisso', '2018-11-20 14:30:00', '2018-11-20 17:32:17', 'CRT', '75639534000161', '08680686913', 'CBW', 'POA', 'FIG', 'esta funcionando essa bosta?'),
(18, '340.00', '5566.00', '4324.00', 'rua das bromelias', 'rua dos canisso', '2018-01-01 20:26:00', '2018-11-20 17:44:36', 'CRT', '75639534000161', '08680686913', 'CBW', 'POA', 'FIG', '34234234234234'),
(19, '4234.00', '3423.00', '3423.00', 'rua das bromelias', '324324', '2018-01-01 20:22:00', '2018-11-20 17:51:51', 'CMB', '75639534000161', '08680686913', 'POA', 'CBW', 'GRN', '4234234'),
(20, '342.00', '34234.00', '34234.00', 'rua das bromelias', '42342', '2018-02-20 19:20:00', '2018-11-20 17:52:39', 'TRK', '75639534000161', '08680686913', 'POA', 'XAP', 'IND', '234234234');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tpcaminhao`
--

CREATE TABLE `tpcaminhao` (
  `sig` varchar(3) NOT NULL,
  `descr` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tpcaminhao`
--

INSERT INTO `tpcaminhao` (`sig`, `descr`) VALUES
('CMB', 'Caminhão Combinado'),
('CRT', 'Carreta'),
('CTQ', 'Caminhão 3/4'),
('NA', 'Não especificado'),
('TCO', 'Semipesado (Toco)'),
('TRK', 'Pesado (Truck)'),
('VUC', 'Veículo Urbano de Carga');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tpcarga`
--

CREATE TABLE `tpcarga` (
  `sigla` varchar(3) NOT NULL,
  `descr` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tpcarga`
--

INSERT INTO `tpcarga` (`sigla`, `descr`) VALUES
('FIG', 'Frigorífica'),
('GRN', 'Granel'),
('IND', 'Indivisíveis'),
('PER', 'Perigosa'),
('SEC', 'Produto seco'),
('VIV', 'Viva');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `fl_tipo` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`email`, `senha`, `fl_tipo`) VALUES
('apoli@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'E'),
('vitorapoli@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'C');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `caminhao`
--
ALTER TABLE `caminhao`
  ADD PRIMARY KEY (`placa`),
  ADD KEY `idx_caminhao_tipo` (`tipo`),
  ADD KEY `idx_caminhao_motorista` (`motorista`);

--
-- Indexes for table `caminhoneiro`
--
ALTER TABLE `caminhoneiro`
  ADD PRIMARY KEY (`cpf`),
  ADD KEY `idx_caminhoneiro_ender_cida` (`ender_cida`);

--
-- Indexes for table `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`sigla`),
  ADD KEY `idx_cidade_estado` (`estado`);

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`cnpj`),
  ADD KEY `idx_empresa_ender_cidad` (`ender_cidad`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`sigla`);

--
-- Indexes for table `frete`
--
ALTER TABLE `frete`
  ADD PRIMARY KEY (`ciot`),
  ADD UNIQUE KEY `ciot` (`ciot`),
  ADD KEY `idx_frete_tipo_cami` (`tipo_cami`),
  ADD KEY `idx_frete_motorista` (`motorista`),
  ADD KEY `idx_frete_contratante` (`contratante`),
  ADD KEY `idx_frete_ret_cidad` (`ret_cidad`),
  ADD KEY `idx_frete_ent_cidad` (`ent_cidad`),
  ADD KEY `idx_frete_tipo` (`tipo`);

--
-- Indexes for table `tpcaminhao`
--
ALTER TABLE `tpcaminhao`
  ADD PRIMARY KEY (`sig`);

--
-- Indexes for table `tpcarga`
--
ALTER TABLE `tpcarga`
  ADD PRIMARY KEY (`sigla`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `frete`
--
ALTER TABLE `frete`
  MODIFY `ciot` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `caminhao`
--
ALTER TABLE `caminhao`
  ADD CONSTRAINT `fk_caminhao_motorista` FOREIGN KEY (`motorista`) REFERENCES `caminhoneiro` (`cpf`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_caminhao_tpcaminhao` FOREIGN KEY (`tipo`) REFERENCES `tpcaminhao` (`sig`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `caminhoneiro`
--
ALTER TABLE `caminhoneiro`
  ADD CONSTRAINT `fk_caminhoneiro_cidade` FOREIGN KEY (`ender_cida`) REFERENCES `cidade` (`sigla`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `cidade`
--
ALTER TABLE `cidade`
  ADD CONSTRAINT `fk_cidade_estado` FOREIGN KEY (`estado`) REFERENCES `estado` (`sigla`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `fk_empresa_cidade` FOREIGN KEY (`ender_cidad`) REFERENCES `cidade` (`sigla`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `frete`
--
ALTER TABLE `frete`
  ADD CONSTRAINT `fk_frete_caminhoneiro` FOREIGN KEY (`motorista`) REFERENCES `caminhoneiro` (`cpf`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_frete_cidade_entrega` FOREIGN KEY (`ent_cidad`) REFERENCES `cidade` (`sigla`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_frete_cidade_retirada` FOREIGN KEY (`ret_cidad`) REFERENCES `cidade` (`sigla`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_frete_empresa` FOREIGN KEY (`contratante`) REFERENCES `empresa` (`cnpj`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_frete_tpcaminhao` FOREIGN KEY (`tipo_cami`) REFERENCES `tpcaminhao` (`sig`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_frete_tpcarga` FOREIGN KEY (`tipo`) REFERENCES `tpcarga` (`sigla`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
