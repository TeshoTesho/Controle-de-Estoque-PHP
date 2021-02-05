-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 28/01/2021 às 19:55
-- Versão do servidor: 10.4.15-MariaDB
-- Versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u117147188_estoque`
--
CREATE DATABASE IF NOT EXISTS `u117147188_estoque` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `u117147188_estoque`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_baixa`
--

CREATE TABLE `tb_baixa` (
  `cd_baixa` int(11) NOT NULL,
  `cd_produto` int(11) NOT NULL,
  `cd_quantidade` double NOT NULL,
  `cd_funcionario` int(11) NOT NULL,
  `dt_baixa` date NOT NULL,
  `hr_baixa` time NOT NULL,
  `cd_estoque` int(11) NOT NULL,
  `cd_qtd_devolvido` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_categoria`
--

CREATE TABLE `tb_categoria` (
  `cd_categoria` int(11) NOT NULL,
  `nm_categoria` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tb_categoria`
--

INSERT INTO `tb_categoria` (`cd_categoria`, `nm_categoria`) VALUES
(1, 'Carne'),
(2, 'Mantimento'),
(3, 'Condimento'),
(4, 'Laticínio'),
(5, 'Hortifruti');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_devolucao`
--

CREATE TABLE `tb_devolucao` (
  `cd_devolucao` int(11) NOT NULL,
  `ic_aberto` int(1) DEFAULT 0,
  `dt_devolucao` date NOT NULL,
  `hr_devolucao` time NOT NULL,
  `cd_quantidade` double NOT NULL,
  `cd_produto` int(11) NOT NULL,
  `cd_funcionario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_entrega`
--

CREATE TABLE `tb_entrega` (
  `cd_nfe` int(11) NOT NULL,
  `dt_entrega` date NOT NULL,
  `hr_entrega` time NOT NULL,
  `ic_entrega` int(11) NOT NULL DEFAULT 0,
  `cd_funcionario` int(11) NOT NULL,
  `cd_fornecedor` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_entrega_produto`
--

CREATE TABLE `tb_entrega_produto` (
  `cd_entrega_produto` int(11) NOT NULL,
  `cd_nfe` int(11) NOT NULL,
  `dt_validade` date NOT NULL,
  `cd_produto` int(11) NOT NULL,
  `cd_quantidade` double NOT NULL,
  `cd_sif` int(11) NOT NULL,
  `cd_lote` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_estoque`
--

CREATE TABLE `tb_estoque` (
  `cd_estoque` int(11) NOT NULL,
  `cd_quantidade` double NOT NULL DEFAULT 0,
  `cd_entrega_produto` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_fornecedor`
--

CREATE TABLE `tb_fornecedor` (
  `cd_fornecedor` int(11) NOT NULL,
  `nm_fornecedor` varchar(50) NOT NULL,
  `cd_cnpj` bigint(14) NOT NULL,
  `cd_incricao_estadual` bigint(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tb_fornecedor`
--

INSERT INTO `tb_fornecedor` (`cd_fornecedor`, `nm_fornecedor`, `cd_cnpj`, `cd_incricao_estadual`) VALUES
(1, 'Estoque', 62336276000283, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_funcionario`
--

CREATE TABLE `tb_funcionario` (
  `cd_funcionario` int(11) NOT NULL,
  `nm_funcionario` varchar(50) NOT NULL,
  `ic_acesso` int(1) NOT NULL DEFAULT 0,
  `cd_senha` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tb_funcionario`
--

INSERT INTO `tb_funcionario` (`cd_funcionario`, `nm_funcionario`, `ic_acesso`, `cd_senha`) VALUES
(1, 'User', 5, '5');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_item`
--

CREATE TABLE `tb_item` (
  `cd_item` int(11) NOT NULL,
  `cd_uspesp` varchar(50) DEFAULT NULL,
  `nm_item` varchar(50) NOT NULL,
  `cd_sub_categoria` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tb_item`
--

INSERT INTO `tb_item` (`cd_item`, `cd_uspesp`, `nm_item`, `cd_sub_categoria`) VALUES
(1, 'CA00007', 'Bisteca', 3),
(2, 'CA00012', 'Costela Fresca', 3),
(3, 'CA00012', 'Costela Salgada', 3),
(4, 'CA00031', 'Pernil', 3),
(5, 'CA00036', 'Tender', 3),
(6, 'CA00037', 'Barriga', 3),
(7, 'CA00052', 'Calabresa', 3),
(8, 'CA00055', 'Paio', 3),
(9, 'CA00056', 'Toscana', 3),
(10, 'CA00040', 'Coxa e Sobre Coxa', 5),
(11, 'CA00042', 'Filé De Coxa', 5),
(12, 'CA00043', 'Filé De Peito', 5),
(13, 'LA00010', 'Presunto', 4),
(14, 'LA00022', 'Salsicha', 4),
(15, 'CA00038', 'Chesster', 5),
(16, 'CA00001', 'Acem', 1),
(17, 'CA00003', 'Almondega', 1),
(18, 'CA00013', 'Coxão Duro', 1),
(19, 'CA00014', 'Coxão Mole', 1),
(20, 'CA00016', 'Fraldinha', 1),
(21, 'CA00022', 'Maminha', 1),
(22, 'CA00023', 'Moída', 1),
(23, 'CA00027', 'Paleta', 1),
(24, 'CA00010', 'Contra Filé', 1),
(25, 'CA00015', 'Cupim', 1),
(26, 'CA00019', 'Largato', 1),
(27, 'CA00035', 'Seca', 1),
(28, 'CA00063', 'Camarão', 2),
(29, 'CA00062', 'Merluza', 2),
(30, 'CA00065', 'Cação', 2),
(31, 'CA00080', 'Pangasius', 2),
(32, 'CA000', 'Kani', 2),
(33, 'MA00365', 'Gelatina De Cereja', 12),
(34, 'MA00366', 'Gelatina De Uva', 12),
(35, 'MA00367', 'Gelatina De Pêssego', 12),
(36, 'MA00387', 'Gelatina De Limão', 12),
(37, 'MA00388', 'Gelatina De Morango', 12),
(38, 'MA00395', 'Gelatina De Abacaxi', 12),
(39, 'MA00396', 'Gelatina De Framboesa', 12),
(40, 'MA00427', 'Chá De Hortelã', 13),
(41, 'MA00083', 'Chá De Camomila', 13),
(42, 'MA00087', 'Chá De Morango', 13),
(43, 'MA00088', 'Chá Mate', 13),
(44, 'MA00090', 'Chá Preto', 13),
(45, 'MA00004', 'Achocolatado', 16),
(46, 'LA00014', 'Mussarela', 19),
(47, 'LA00012', 'Queijo Branco', 19),
(48, 'LA00017', 'Queijo Ralado', 19),
(49, 'LA00005', 'Leite', 20),
(50, 'LA00006', 'Caixa de Leite', 20),
(51, 'HF00002', 'Abacaxi', 21),
(52, 'HF00015', 'Banana', 21),
(53, 'HF00042', 'Goiaba', 21),
(54, 'HF00047', 'Laranja', 21),
(55, 'HF00049', 'Limão', 21),
(56, 'HF00050', 'Maçã', 21),
(57, 'HF00052', 'Mamão', 21),
(58, 'HF00055', 'Manga', 21),
(59, 'HF00056', 'Maracujá', 21),
(60, 'HF00057', 'Melancia', 21),
(61, 'HF00058', 'Melão', 21),
(62, 'HF00059', 'Mexerica', 21),
(63, 'HF00061', 'Morango', 21),
(64, 'HF00079', 'Tomate', 21),
(65, 'HF00080', 'Uva', 21),
(66, 'HF00084', 'Pêssego', 21),
(67, 'HF00021', 'Caqui', 21),
(68, 'HF00006', 'Acelga', 22),
(69, 'HF00007', 'Agrião', 22),
(70, 'HF00086', 'Alface Americana', 22),
(71, 'HF00088', 'Alface crespa', 22),
(72, 'HF00009', 'Alface lisa', 22),
(73, 'HF00089', 'Alface mimosa', 22),
(74, 'HF00087', 'Alface roxa', 22),
(75, 'HF00012', 'Almeirão', 22),
(76, 'HF00020', 'Brócolis', 22),
(77, 'HF00034', 'Coentro', 22),
(78, 'HF00035', 'Couve', 22),
(79, 'HF00036', 'Couve-flor', 22),
(80, 'HF00030', 'Escarola', 22),
(81, 'HF00090', 'Hortelã', 22),
(82, 'HF00074', 'Repolho', 22),
(83, 'HF00076', 'Repolho Roxo', 22),
(84, 'HF00077', 'Rúcula', 22),
(85, 'HF00029', 'Salsa', 22),
(86, 'HF00078', 'Salsão', 22),
(87, 'HF00004', 'Abobrinha', 23),
(88, 'HF00016', 'Batata', 24),
(89, 'HF00018', 'Berinjela', 23),
(90, 'HF00019', 'Beterraba', 23),
(91, 'HF00025', 'Cebola', 24),
(92, 'HF00027', 'Cenoura', 23),
(93, 'HF00031', 'Chuchu', 23),
(94, 'HF00053', 'Mandioca', 23),
(95, 'HF00054', 'Mandioquinha', 23),
(96, 'HF00066', 'Pepino', 23),
(97, 'HF00069', 'Pimentão Amarelo', 23),
(98, 'HF00070', 'Pimentão Verde', 23),
(99, 'HF00071', 'Pimentão Vermelho', 23),
(100, 'HF00072', 'Quiabo', 23),
(101, 'HF00073', 'Rabanete', 23),
(102, 'HF00083', 'Vagem', 23),
(103, 'HF00010', 'Alho', 24),
(104, 'MA00001', 'Abacaxi Em Calda', 7),
(105, 'MA00003', 'Açafrão', 16),
(106, 'MA00005', 'Açúcar', 16),
(107, 'MA00138', 'Açúcar Sachê', 14),
(108, 'MA00008', 'Adoçante', 15),
(109, 'MA00013', 'Alho Balde', 18),
(110, 'MA00015', 'Amaciante De Carne', 16),
(111, 'MA00017', 'Ameixa Preta Seca', 15),
(112, 'MA00020', 'Amido De Milho', 6),
(113, 'MA00022', 'Arroz', 10),
(114, 'MA00024', 'Atum', 7),
(115, 'MA00025', 'Azeite', 9),
(116, 'MA00030', 'Azeitona Fatiada', 18),
(117, 'MA00567', 'Batata Chips', 25),
(118, 'MA00034', 'Batata Palha', 15),
(119, 'MA00036', 'Batata Palito', 25),
(120, 'MA00464', 'Bolacha Champagne', 15),
(121, 'MA00060', 'Café', 16),
(122, 'MA00065', 'Caldo De Carne', 16),
(123, 'MA00067', 'Caldo De Galinha', 16),
(124, 'MA00068', 'Caldo De Legumes', 16),
(125, 'MA00069', 'Caldo De Peixe', 16),
(126, 'MA00100', 'Calorífico', 16),
(127, 'MA00072', 'Canela Em Pó', 16),
(128, 'MA00073', 'Canelone', 8),
(129, 'MA00080', 'Ketchup', 17),
(130, 'MA00092', 'Champignon', 17),
(131, 'MA00095', 'Chocolate Em Pó', 15),
(132, 'MA00098', 'Coco Ralado', 15),
(133, 'MA00104', 'Cravo', 15),
(134, 'MA00107', 'Creme De Cebola', 16),
(135, 'MA00109', 'Creme De Leite', 20),
(136, 'MA00289', 'Curau', 15),
(137, 'MA00162', 'Doce De Figo Em Calda', 7),
(138, 'MA00125', 'Doce De Leite', 20),
(139, 'MA00134', 'Erva Doce', 18),
(140, 'MA00136', 'Ervilha', 7),
(141, 'MA00137', 'Ervilha Seca', 10),
(142, 'MA00140', 'Essência De Baunilha', 17),
(143, 'MA00148', 'Extrato De Tomate', 26),
(144, 'MA00150', 'Farinha De Mandioca', 6),
(145, 'MA00151', 'Farinha De Mandioca Grossa', 6),
(146, 'MA00153', 'Farinha De Milho', 6),
(147, 'MA00154', 'Farinha De Rosca', 6),
(148, 'MA00155', 'Farinha De Trigo', 6),
(149, 'MA00157', 'Feijão Carioca', 10),
(150, 'MA00158', 'Feijão Preto', 10),
(151, 'MA00159', 'Fermento', 15),
(152, 'MA00161', 'Fermento Biológico', 15),
(153, 'MA00164', 'Flan', 15),
(154, 'MA00167', 'Fubá', 6),
(155, 'MA00168', 'Gelatina Natural', 12),
(156, 'MA00393', 'Geleia Sache', 14),
(157, 'MA00188', 'Goiaba Em Calda', 15),
(158, 'MA00189', 'Goiabada', 7),
(159, 'MA00192', 'Gordura Vegetal', 15),
(160, 'MA00096', 'Granulado', 15),
(161, 'MA00193', 'Grão De Bico', 10),
(162, 'MA00194', 'Groselha', 11),
(163, 'MA00197', 'Leite Condensado', 20),
(164, 'MA00196', 'Leite De Coco', 20),
(165, 'MA00198', 'Lentilha', 10),
(166, 'MA00200', 'Louro', 16),
(167, 'MA00349', 'Macarrão Espaguete', 8),
(168, 'MA00203', 'Macarrão Parafuso', 8),
(169, 'MA00201', 'Macarrão Sopa', 8),
(170, 'MA00206', 'Maionese', 17),
(171, 'MA00211', 'Margarina', 15),
(172, 'MA00491', 'Margarina Sachê', 14),
(173, 'MA00222', 'Milho Verde', 7),
(174, 'MA00230', 'Molho De Pimenta', 26),
(175, 'MA00233', 'Molho De Tomate', 26),
(176, 'MA00234', 'Molho Escuro', 26),
(177, 'MA00235', 'Molho Inglês', 26),
(178, 'MA00236', 'Molho Shoyo', 26),
(179, 'MA00237', 'Mostarda', 17),
(180, 'MA00246', 'Óleo Composto', 9),
(181, 'MA00247', 'Óleo De Soja', 9),
(182, 'MA00248', 'Orégano', 17),
(183, 'MA00250', 'Ovo', 15),
(184, 'MA00270', 'Pão De Forma', 27),
(185, 'MA00260', 'Pão Francês', 27),
(186, 'MA00273', 'Pão Integral', 27),
(187, 'MA00277', 'Páprica', 16),
(188, 'MA00279', 'Pêssego Em Calda', 17),
(189, 'MA00293', 'Polenta', 25),
(191, 'MA00298', 'Purê De Batata', 15),
(192, 'MA00307', 'Sagu', 15),
(193, 'MA00308', 'Sal', 16),
(194, 'MA00513', 'Sal Sachê', 14),
(195, 'MA00311', 'Sardinha', 7),
(196, 'MA00318', 'Suco Abacaxi', 11),
(197, 'MA00320', 'Suco Caju', 11),
(198, 'MA00321', 'Suco Goiaba', 11),
(199, 'MA00322', 'Suco Laranja', 11),
(200, 'MA00323', 'Suco Manga', 11),
(201, 'MA00324', 'Suco Maracujá', 11),
(202, 'MA00327', 'Suco Uva', 11),
(203, 'MA00321', 'Suco Tangerina', 11),
(204, 'MA00333', 'Tempero Fondor', 16),
(205, 'MA00338', 'Trigo Para Kibe', 6),
(206, 'MA00340', 'Uva Passa', 15),
(207, 'MA00341', 'Vinagre', 17),
(208, 'MA00291', 'Baunilha', 28),
(209, 'MA00291', 'Caramelo', 28),
(210, 'MA00291', 'Chocolate', 28),
(211, 'MA00291', 'Coco', 28),
(212, 'MA00291', 'Morango', 28),
(213, 'MA00442', 'Bolacha Salgada', 15),
(214, 'MA00526', 'Chá Melissa', 13),
(219, 'MA00312', 'Soja', 10),
(220, 'MA00018', 'Amêndoa Sem Casca', 10),
(221, 'MA00347', 'Vinho', 29),
(222, 'MA00086', 'Chá de Erva doce', 13),
(223, 'yakissoba', 'Yakissoba', 8),
(224, 'gergelim', 'Gergelim', 10),
(225, 'farinha', 'Farinha de Mandioca Torrada', 6),
(226, 'canela', 'Canela em Rama', 15),
(230, 'MA00085', 'Chá de Erva Cidreira', 13),
(231, 'MA00537', 'Chá de Hibisco', 13),
(232, 'cod', '', 0),
(233, 'cod', '', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produto`
--

CREATE TABLE `tb_produto` (
  `cd_produto` int(11) NOT NULL,
  `cd_barra` bigint(20) NOT NULL,
  `nm_marca` varchar(50) NOT NULL,
  `ds_peso` double NOT NULL,
  `cd_medida` int(11) NOT NULL,
  `cd_item` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tb_produto`
--

INSERT INTO `tb_produto` (`cd_produto`, `cd_barra`, `nm_marca`, `ds_peso`, `cd_medida`, `cd_item`) VALUES
(1, 7898357411357, 'Andinas', 2, 1, 116),
(2, 7898482040293, 'Arrico', 2, 1, 187),
(3, 7898623590946, 'Asiafood', 500, 2, 32),
(4, 7897389300837, 'Belacor', 1, 1, 126),
(5, 7898921567510, 'Bem Brasil', 2, 1, 116),
(6, 7896894900013, 'Caravelaso', 1, 1, 106),
(7, 7899840801525, 'Chefs', 1, 1, 206),
(8, 7898282180328, 'Citro', 5, 4, 196),
(9, 7897001010014, 'Cocamar', 900, 5, 181),
(10, 7896728934269, 'Coronata', 5, 1, 47),
(11, 7896005286524, 'Dona Benta', 500, 2, 167),
(12, 7896005286555, 'Dona Benta', 500, 2, 168),
(13, 7896455001135, 'Ekma', 3.3, 1, 129),
(14, 7896455002088, 'Ekma', 3, 4, 177),
(15, 7896455004457, 'Ekma', 2.1, 4, 175),
(16, 7896455004488, 'Ekma', 5, 4, 176),
(17, 7896455004518, 'Ekma', 1, 4, 174),
(18, 751320175984, 'Empório ', 1, 1, 149),
(19, 751320175991, 'Empório', 1, 1, 150),
(20, 7896635500472, 'Grupo Pq Alimentos', 1.1, 1, 126),
(21, 7896635500694, 'Grupo Pq Alimentos', 5, 1, 141),
(22, 7896635501134, 'Grupo Pq Alimentos', 5, 1, 161),
(23, 7896635501165, 'Grupo Pq Alimentos', 5, 1, 165),
(24, 7896102812060, 'Guarani', 4.98, 1, 107),
(25, 7891965120253, 'Hikari', 1, 1, 147),
(26, 7891965130221, 'Hikari', 2, 1, 145),
(27, 7891965132195, 'Hikari', 1, 1, 144),
(28, 7891965153176, 'Hikari', 5, 1, 154),
(29, 7891965153299, 'Hikari', 1, 1, 191),
(30, 7898563240055, 'Imperial', 0, 2, 118),
(31, 7898080640611, 'Italac', 1, 4, 49),
(32, 7898080640673, 'Italac', 400, 2, 45),
(33, 17898080640618, 'Italac', 1, 9, 50),
(34, 7898304250893, 'Jaguá', 1, 1, 10),
(35, 7891515502140, 'Kidelli', 2.5, 1, 7),
(36, 7891150036956, 'Knorr', 1.01, 1, 125),
(37, 7896415100496, 'Marpa', 500, 2, 146),
(38, 7898994047971, 'Marsul', 300, 2, 114),
(39, 7896534403966, 'Modena', 1, 1, 148),
(40, 7896079431158, 'Namorado', 5, 1, 113),
(41, 7896392200042, 'Nobre', 1, 1, 193),
(42, 7898922555059, 'Nova Safra', 1, 1, 48),
(43, 7898583132880, 'Ouro Preto', 5, 1, 27),
(44, 7898949840060, 'Palladio', 750, 5, 207),
(45, 7892222100544, 'Pele', 250, 2, 120),
(46, 7897389302053, 'Penina', 1.05, 1, 123),
(47, 7896089011357, 'Pilão', 500, 2, 121),
(48, 7899566302429, 'Plena', 2, 1, 17),
(49, 7891122113104, 'Qualimax', 1, 1, 38),
(50, 7891122113111, 'Qualimax', 1, 1, 33),
(51, 7891122113128, 'Qualimax', 1, 1, 39),
(52, 7891122113159, 'Qualimax', 1, 1, 35),
(53, 7891122113173, 'Qualimax', 1, 1, 34),
(54, 7891122113197, 'Qualimax', 1, 1, 36),
(55, 7891122113227, 'Qualimax', 1, 1, 37),
(56, 7891122123318, 'Qualimax', 510, 2, 155),
(57, 7897609502829, 'Quati', 1, 1, 113),
(58, 7896102501018, 'Quero', 200, 2, 139),
(59, 7896102501254, 'Quero', 2, 1, 173),
(60, 7791688000323, 'Rapipap', 2, 1, 118),
(62, 7894904578153, 'Rezende', 3.5, 1, 13),
(63, 7897167100338, 'Sosal', 2, 1, 194),
(64, 7899567250293, 'Swift', 2, 1, 22),
(65, 7898486573711, 'Temperabem', 1, 1, 105),
(66, 7898486574442, 'Temperabem', 1.01, 1, 125),
(67, 7898486574541, 'Temperabem', 1.01, 1, 134),
(69, 7898905153784, 'Tomodoro', 2, 1, 175),
(70, 7898221690031, 'Toyo', 500, 2, 144),
(71, 7898909755380, 'Tozzi', 400, 2, 104),
(72, 7898919754021, 'Tradição', 500, 5, 115),
(73, 7896434920570, 'Triangulo Mineiro', 395, 5, 163),
(74, 7896434920723, 'Triangulo Mineiro', 200, 2, 135),
(75, 7898370746061, 'Valle', 500, 2, 9),
(76, 7896094910904, 'Zero Cal', 100, 5, 108),
(77, 7891122113203, 'Qualimax', 1, 1, 210),
(78, 7896022205164, 'Renata', 400, 2, 213),
(79, 7891098038456, 'Matte Leão', 250, 2, 43),
(80, 7891098010568, 'Matte Eão', 240, 2, 43),
(81, 7898366311198, 'Santo Chá', 40, 2, 40),
(82, 7896022200169, 'Renata', 500, 2, 169),
(83, 7898366311662, 'Santo Chá', 30, 2, 214),
(84, 7896051145219, 'Itambe', 800, 2, 138),
(85, 7899840801365, 'Smart', 1, 1, 132),
(86, 7891122123554, 'Qualimax', 2, 2, 151),
(87, 7896036092934, 'Maria', 0, 2, 115),
(88, 7891962035451, 'Bauducco', 150, 2, 120),
(89, 7898947566177, 'Energy', 1, 1, 106),
(90, 7896102501155, 'Quero', 200, 2, 173),
(91, 7898357411128, 'Andina', 2, 1, 130),
(92, 7891122113210, 'Qualimax', 1, 1, 211),
(93, 7891122113180, 'Qualimax', 1, 1, 208),
(94, 7891122113302, 'Qualimax', 1, 1, 153),
(95, 7891122113357, 'Qualimax', 1, 1, 136),
(96, 7891167011687, 'Gomes Da Costa', 500, 2, 114),
(97, 7891122115443, 'Qualimax', 1, 1, 45),
(98, 7896025802919, 'Cepera', 1, 1, 179),
(99, 7897077820593, 'Confeitero', 1, 1, 160),
(100, 7896635503459, 'Pq Alimentos', 1, 1, 112),
(101, 7898486570284, 'Temperabem', 500, 2, 127),
(102, 7896021810017, 'Nordeste', 1, 1, 148),
(103, 7898909755014, 'Tozzi', 400, 2, 137),
(104, 7896481600029, 'Gb', 400, 2, 188),
(105, 7891122115436, 'Qualimax', 1, 1, 110),
(106, 7897389302022, 'Penina', 1, 1, 122),
(107, 7896102509496, 'Quero', 1, 1, 170),
(108, 7898239020042, 'Rei Do Alho', 3, 1, 109),
(109, 7896006746157, 'Pop', 1, 1, 149),
(110, 7896635502438, 'Pq Alimentos', 5, 1, 192),
(111, 7896635501110, 'Pq Alimentos', 5, 1, 154),
(112, 7896635500816, 'Pq Alimentos', 5, 1, 146),
(113, 7891098000415, 'Leão', 16, 2, 44),
(114, 7891098000170, 'Leão', 16, 2, 40),
(115, 7891098001511, 'Leao Fuze', 20, 2, 42),
(116, 7891098010575, 'Leão', 15, 2, 41),
(117, 7891150024519, 'Knnor', 1, 1, 176),
(118, 7896047801020, 'Indiano', 500, 5, 164),
(119, 7892222310509, 'Pele', 1, 1, 121),
(120, 7896804600637, 'Bom Sabor', 15, 2, 156),
(121, 7896102819106, 'Junior', 10, 2, 172),
(122, 7898282180267, 'Citro', 5, 4, 202),
(123, 7898282180021, 'Citro', 5, 4, 199),
(124, 7891107101621, 'Soya', 900, 5, 181),
(125, 7896076220052, 'Palhinha', 750, 5, 207),
(126, 7899840801266, 'Chefs', 1, 1, 220),
(127, 7896635502957, 'Pq Alimentos', 1, 1, 219),
(128, 7897517207281, 'Fugini', 2, 1, 129),
(129, 7891132005840, 'Sazon', 1, 1, 122),
(130, 7891150055308, 'Knorr', 1, 1, 187),
(131, 7891132005833, 'Sazon', 1, 1, 123),
(132, 7896699307048, 'Nutrimax', 1, 1, 131),
(133, 7899840801228, 'Smart', 1, 1, 111),
(134, 7899840801181, 'Smart', 500, 2, 182),
(135, 7897389303135, 'Penina', 1, 1, 124),
(136, 7896635500724, 'Pq Alimentos', 5, 1, 144),
(137, 7898665611623, 'Amizade', 1, 1, 148),
(138, 7893500020318, 'Biju', 5, 1, 113),
(139, 7896434920464, 'Triangulo Mineiro', 300, 2, 138),
(140, 7898366311488, 'Santo Cha', 30, 2, 231),
(141, 7298366317211, 'Santo Cha', 30, 2, 41),
(142, 7898366311211, 'Santo Chá', 30, 2, 41),
(143, 78985632400, 'Crocks', 500, 2, 118),
(144, 7897507400036, 'Piccoli', 4, 4, 221),
(145, 78911221131159, 'Qualimax', 1, 1, 35),
(146, 7891167700338, 'Sosal', 1, 2, 194),
(147, 7896248101486, 'Iandy', 15, 1, 159),
(148, 7896148101486, 'Iandy', 15, 1, 159),
(149, 7891098001504, 'Chá Leão', 20, 2, 222),
(150, 732783036906, 'Dalia', 1, 9, 50),
(151, 7895000318452, 'Qualita', 200, 2, 135),
(152, 7898622811028, 'Portobello', 2, 1, 109),
(153, 7896421606746, 'Junior', 1, 1, 110),
(154, 7896735115330, 'Sabor Do Sul', 5, 1, 113),
(155, 7898357410268, 'Andinas', 2, 1, 116),
(156, 7891965120154, 'Hikari', 500, 2, 144),
(157, 789248101486, 'Iandy', 15, 1, 159),
(158, 17896183202184, 'Quata', 1, 9, 50),
(159, 7896804600101, 'Bom Sabor', 1, 1, 107),
(160, 7891122113234, 'Qualimax', 1, 1, 212),
(161, 7896048258014, 'Castelo', 750, 5, 207),
(162, 7891150035959, 'Hellmanns', 3, 1, 170),
(163, 7896102509045, 'Quero', 150, 5, 177),
(164, 7897963900064, 'Santa Luzia', 1, 1, 145),
(165, 7896228302148, 'Romariz', 5, 1, 205),
(166, 7896022205232, 'Renata', 360, 2, 213),
(167, 7892300030060, 'Sinha', 900, 5, 181),
(168, 7898486575944, 'Temperabem', 1, 1, 191),
(169, 7898936322067, 'Tribom', 5, 1, 113),
(170, 7898905153302, 'Bonare', 2, 1, 140),
(171, 1789609162018, 'Polly', 1, 9, 50),
(172, 7898080640529, 'Italac', 270, 2, 163),
(173, 7898215151784, 'Piracanjuba', 200, 2, 135),
(174, 7898905153777, 'Bonare', 2, 1, 143),
(175, 7891132005857, 'Sazon', 1, 1, 124),
(176, 7896025802674, 'Cepera', 3, 1, 129),
(177, 7898174850247, 'Tio Paco', 3, 1, 116),
(178, 7897389300332, 'Penina', 500, 2, 133),
(179, 7898486576743, 'Temperabem', 500, 2, 226),
(180, 7892222300500, 'Pelé', 500, 2, 121),
(181, 7891965120345, 'Hikari', 500, 2, 154),
(183, 7891965120192, 'Hikari', 500, 2, 225),
(184, 7898944855106, 'Davi', 3, 1, 109),
(185, 7898097960092, 'Bifum', 500, 2, 223),
(186, 7898622811011, 'Portobello', 400, 2, 109),
(187, 7898124620012, 'Dunorte', 1, 1, 193),
(188, 7896434920594, 'Triangulo Mineiro', 5, 1, 138),
(190, 7899840801440, 'Smart', 1, 1, 224),
(191, 7898366377798, 'Santo Chá', 40, 2, 40),
(192, 7292366371358, 'Santo Chá', 50, 2, 230),
(193, 7898246070917, 'Ornela', 15, 1, 171),
(194, 789624810146, 'Iandy', 15, 1, 159),
(195, 7899840801389, 'Chefs', 1, 1, 132),
(196, 7896005202074, 'Dona Benta', 1, 1, 148),
(197, 7896076220021, 'Palhinha', 750, 5, 207),
(198, 17891910020147, 'União', 2, 1, 107),
(199, 7898486572707, 'Temperabem', 500, 2, 187),
(200, 7898905153289, 'Bonare', 200, 2, 140),
(201, 7896455004501, 'Ekma', 1, 4, 178),
(202, 7896096041651, 'Carmelita', 500, 5, 115),
(203, 7896292300507, 'Predilecta', 200, 2, 173),
(204, 7896635502858, 'Pw', 0, 0, 165),
(205, 7896005286593, 'Dona Benta', 500, 2, 168),
(206, 7897517205553, 'Fugini', 2, 1, 170),
(207, 7891965120642, 'Hikari', 500, 2, 205),
(208, 7898140021053, 'A Meneirinha', 500, 2, 118),
(209, 7898920404045, 'Real', 2, 1, 130),
(210, 7896005400043, 'Da Fruta', 5, 4, 198),
(211, 7896005400029, 'Da Fruta', 5, 4, 197),
(212, 7898080640413, 'Italac', 395, 2, 163),
(213, 27896094910904, 'Teste', 100, 2, 19),
(214, 7896089010916, 'Caboclo', 500, 2, 121),
(215, 7897517209056, 'Fugini', 200, 2, 140),
(216, 7896006751113, 'Camil', 0, 0, 150),
(217, 7891965153190, 'Hikari', 5, 1, 205),
(218, 7898930206141, 'Patriota', 5, 1, 113),
(219, 7896005400050, 'Dafruta', 500, 5, 200),
(221, 9223372036854775807, 'Fribev', 28, 2, 16),
(222, 9223372036854775807, 'Ribev', 20.85, 1, 18),
(224, 7898357418523, 'Olea', 2, 1, 130);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_sub_categoria`
--

CREATE TABLE `tb_sub_categoria` (
  `cd_sub_categoria` int(11) NOT NULL,
  `nm_sub_categoria` varchar(50) NOT NULL,
  `cd_categoria` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tb_sub_categoria`
--

INSERT INTO `tb_sub_categoria` (`cd_sub_categoria`, `nm_sub_categoria`, `cd_categoria`) VALUES
(1, 'Bovina', 1),
(2, 'Peixe', 1),
(3, 'Suina', 1),
(4, 'Frios', 1),
(5, 'Frango', 1),
(6, 'Farinha', 2),
(7, 'Enlatado', 2),
(8, 'Massa', 2),
(9, 'Liquidos', 2),
(10, 'Grãos', 2),
(11, 'Suco', 2),
(12, 'Gelatina', 2),
(13, 'Chá', 2),
(14, 'Sachê', 2),
(15, 'Diversos', 2),
(16, 'Em pó', 3),
(17, 'Liquido', 3),
(18, 'Solido', 3),
(19, 'Queijo', 4),
(20, 'Leite e Derivados', 4),
(21, 'Fruta', 5),
(22, 'Verdura', 5),
(23, 'Legume', 5),
(24, 'Raiz', 5),
(25, 'Congelados', 2),
(26, 'Molho', 2),
(27, 'Pão', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_unidade_medida`
--

CREATE TABLE `tb_unidade_medida` (
  `cd_medida` int(11) NOT NULL,
  `nm_medida` varchar(50) NOT NULL,
  `cd_simbolo` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `tb_unidade_medida`
--

INSERT INTO `tb_unidade_medida` (`cd_medida`, `nm_medida`, `cd_simbolo`) VALUES
(1, 'Quilo', 'Kg'),
(2, 'Gramas', 'g'),
(3, 'Miligrama', 'mg'),
(4, 'Litro', 'l'),
(5, 'Mililitro', 'ml'),
(6, 'Unidade', 'UND'),
(7, 'Pacote', 'PCT'),
(8, 'Balde', 'BLD'),
(9, 'Caixa', 'CX');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_baixa`
--
ALTER TABLE `tb_baixa`
  ADD PRIMARY KEY (`cd_baixa`),
  ADD KEY `fk_produto_baixa` (`cd_produto`),
  ADD KEY `fk_funcionario_baixa` (`cd_funcionario`);

--
-- Índices de tabela `tb_categoria`
--
ALTER TABLE `tb_categoria`
  ADD PRIMARY KEY (`cd_categoria`);

--
-- Índices de tabela `tb_devolucao`
--
ALTER TABLE `tb_devolucao`
  ADD PRIMARY KEY (`cd_devolucao`),
  ADD KEY `fk_produto_devolucao` (`cd_produto`),
  ADD KEY `fk_funcionario_devolucao` (`cd_funcionario`);

--
-- Índices de tabela `tb_entrega`
--
ALTER TABLE `tb_entrega`
  ADD PRIMARY KEY (`cd_nfe`),
  ADD KEY `fk_funcionario` (`cd_funcionario`),
  ADD KEY `fk_fornecedor` (`cd_fornecedor`);

--
-- Índices de tabela `tb_entrega_produto`
--
ALTER TABLE `tb_entrega_produto`
  ADD PRIMARY KEY (`cd_entrega_produto`),
  ADD KEY `fk_nfe` (`cd_nfe`),
  ADD KEY `fk_produto` (`cd_produto`);

--
-- Índices de tabela `tb_estoque`
--
ALTER TABLE `tb_estoque`
  ADD PRIMARY KEY (`cd_estoque`),
  ADD KEY `fk_entrega_produto_estoque` (`cd_entrega_produto`);

--
-- Índices de tabela `tb_fornecedor`
--
ALTER TABLE `tb_fornecedor`
  ADD PRIMARY KEY (`cd_fornecedor`);

--
-- Índices de tabela `tb_funcionario`
--
ALTER TABLE `tb_funcionario`
  ADD PRIMARY KEY (`cd_funcionario`);

--
-- Índices de tabela `tb_item`
--
ALTER TABLE `tb_item`
  ADD PRIMARY KEY (`cd_item`),
  ADD KEY `fk_sub_categoria` (`cd_sub_categoria`);

--
-- Índices de tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  ADD PRIMARY KEY (`cd_produto`),
  ADD KEY `fk_item` (`cd_item`),
  ADD KEY `fk_medida` (`cd_medida`);

--
-- Índices de tabela `tb_sub_categoria`
--
ALTER TABLE `tb_sub_categoria`
  ADD PRIMARY KEY (`cd_sub_categoria`),
  ADD KEY `fk_categoria` (`cd_categoria`);

--
-- Índices de tabela `tb_unidade_medida`
--
ALTER TABLE `tb_unidade_medida`
  ADD PRIMARY KEY (`cd_medida`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_baixa`
--
ALTER TABLE `tb_baixa`
  MODIFY `cd_baixa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_categoria`
--
ALTER TABLE `tb_categoria`
  MODIFY `cd_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_devolucao`
--
ALTER TABLE `tb_devolucao`
  MODIFY `cd_devolucao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_entrega_produto`
--
ALTER TABLE `tb_entrega_produto`
  MODIFY `cd_entrega_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_estoque`
--
ALTER TABLE `tb_estoque`
  MODIFY `cd_estoque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_fornecedor`
--
ALTER TABLE `tb_fornecedor`
  MODIFY `cd_fornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tb_funcionario`
--
ALTER TABLE `tb_funcionario`
  MODIFY `cd_funcionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_item`
--
ALTER TABLE `tb_item`
  MODIFY `cd_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT de tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  MODIFY `cd_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT de tabela `tb_sub_categoria`
--
ALTER TABLE `tb_sub_categoria`
  MODIFY `cd_sub_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `tb_unidade_medida`
--
ALTER TABLE `tb_unidade_medida`
  MODIFY `cd_medida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;