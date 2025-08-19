
-- Cleaned SQL Dump for Hostinger Migration

CREATE DATABASE IF NOT EXISTS `db_streetwear`;
USE `db_streetwear`;

CREATE TABLE `tbl_categoria` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `nm_categoria` varchar(45) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_categoria` (`id_categoria`, `nm_categoria`) VALUES
(1, 'Vestido'), (2, 'Calça'), (3, 'Blusa'), (4, 'Body'), (5, 'Cropped');

CREATE TABLE `tbl_marca` (
  `id_marca` int NOT NULL AUTO_INCREMENT,
  `nm_marca` varchar(45) NOT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_marca` (`id_marca`, `nm_marca`) VALUES
(1, 'BellaB');

CREATE TABLE `tbl_produtos` (
  `id_produto` int NOT NULL AUTO_INCREMENT,
  `nm_nome` varchar(75) NOT NULL,
  `ds_resumo_produto` text NOT NULL,
  `vl_produto` decimal(7,2) NOT NULL,
  `nm_color_produto` varchar(40) NOT NULL,
  `nm_artigo` varchar(8) NOT NULL,
  `ds_img` varchar(255) NOT NULL,
  `id_marca` int NOT NULL,
  `id_categoria` int NOT NULL,
  `qtd_estoque` int NOT NULL,
  `prod_lanc` char(1) NOT NULL,
  PRIMARY KEY (`id_produto`),
  FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categoria` (`id_categoria`),
  FOREIGN KEY (`id_marca`) REFERENCES `tbl_marca` (`id_marca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_produtos` (`id_produto`, `nm_nome`, `ds_resumo_produto`, `vl_produto`, `nm_color_produto`, `nm_artigo`, `ds_img`, `id_marca`, `id_categoria`, `qtd_estoque`, `prod_lanc`) VALUES
(24, 'camisa azul', 'camisa azul P', 60.00, 'azul', '001', 'f12d1d6227bcfa8ad35c661fb69980b6.jpg', 1, 3, 1, 'S'),
(25, 'calça preta', 'calça preta M', 70.00, 'Preto', '30', 'bb2750e770bff1bc3514b72888dcc801.jpg', 1, 2, 1, 'N');

CREATE TABLE `tbl_usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nm_usuario` varchar(80) NOT NULL,
  `sbnm_usuario` varchar(80) NOT NULL,
  `cell_usuario` char(15) NOT NULL,
  `desc_email` varchar(80) NOT NULL,
  `desc_senha` char(10) NOT NULL,
  `desc_status` tinyint(1) NOT NULL,
  `desc_endereco` varchar(80) NOT NULL,
  `desc_cidade` varchar(30) NOT NULL,
  `num_cep` char(11) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_usuario` (`id_usuario`, `nm_usuario`, `sbnm_usuario`, `cell_usuario`, `desc_email`, `desc_senha`, `desc_status`, `desc_endereco`, `desc_cidade`, `num_cep`) VALUES
(1, 'Felipe', 'Jobim', '(54) 99324-4622', 'lipejobim@gmail.com', '123', 1, 'Rua guaíba', 'getulio vargas', '99 900-000'),
(5, 'Comprador', '1', '(55) 55555-555', 'compra@gmail.com', '123', 0, '123', '123', '31 231-233');

CREATE TABLE `tbl_vendas` (
  `id_venda` int NOT NULL AUTO_INCREMENT,
  `nm_ticket` varchar(13) NOT NULL,
  `id_cliente` int DEFAULT NULL,
  `id_produto` int NOT NULL,
  `qtd_produto` int NOT NULL,
  `vl_produto` decimal(7,2) NOT NULL,
  `vl_total` decimal(10,2) DEFAULT NULL,
  `data_venda` date NOT NULL,
  PRIMARY KEY (`id_venda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Note: Trigger and views removed for compatibility
