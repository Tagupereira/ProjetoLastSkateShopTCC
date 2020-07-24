-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           5.1.72-community - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para last
CREATE DATABASE IF NOT EXISTS `last` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `last`;

-- Copiando estrutura para tabela last.agenda
CREATE TABLE IF NOT EXISTS `agenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evento` varchar(50) NOT NULL,
  `dataEvento` date NOT NULL,
  `hora` varchar(50) NOT NULL,
  `localidade` varchar(50) NOT NULL,
  `situacao` varchar(10) NOT NULL DEFAULT 'Pendente',
  `observacao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4028 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela last.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `whatsapp` varchar(10) DEFAULT NULL,
  `instagram` varchar(50) DEFAULT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `situacao` varchar(7) NOT NULL DEFAULT 'ativo',
  `dataCadastro` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela last.contasapagar
CREATE TABLE IF NOT EXISTS `contasapagar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  `pagamento` varchar(50) NOT NULL,
  `dataVencimento` date NOT NULL,
  `valor` decimal(14,2) NOT NULL,
  `situacao` varchar(10) NOT NULL,
  `ocorrencia` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela last.contasareceber
CREATE TABLE IF NOT EXISTS `contasareceber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  `pagamento` varchar(50) NOT NULL,
  `dataVencimento` date NOT NULL,
  `valor` decimal(14,2) NOT NULL,
  `situacao` varchar(10) NOT NULL,
  `ocorrencia` varchar(10) NOT NULL,
  `datarecebimento` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela last.empresa
CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `cnpj` varchar(18) DEFAULT NULL,
  `telefone` varchar(12) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `logo` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela last.fornecedor
CREATE TABLE IF NOT EXISTS `fornecedor` (
  `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT,
  `razao_social` varchar(50) DEFAULT NULL,
  `telefone` varchar(10) DEFAULT NULL,
  `celular` varchar(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `web` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_fornecedor`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para evento last.func_atualiza_data
DELIMITER //
CREATE EVENT `func_atualiza_data` ON SCHEDULE EVERY 10 SECOND STARTS '2020-07-14 20:34:27' ON COMPLETION PRESERVE ENABLE DO BEGIN

	call tr_atualiza_data();
END//
DELIMITER ;

-- Copiando estrutura para tabela last.login
CREATE TABLE IF NOT EXISTS `login` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(25) NOT NULL,
  `senha` varchar(8) NOT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `funcao` varchar(50) NOT NULL,
  `situacao` varchar(50) NOT NULL DEFAULT 'Ativo',
  `apelido` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela last.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `cod_produto` int(4) NOT NULL,
  `nome_produto` varchar(50) NOT NULL,
  `descricao_produto` varchar(50) NOT NULL,
  `quantidade` int(5) NOT NULL DEFAULT '0',
  `fabricante` varchar(50) DEFAULT 'N/A',
  `tipo` varchar(50) DEFAULT 'N/A',
  `preco_custo` double(14,2) NOT NULL,
  `preco_venda` double(14,2) NOT NULL,
  `data_entrada` date DEFAULT NULL,
  `arquivo` varchar(50) DEFAULT NULL,
  `id_fornecedor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_produto`),
  KEY `id_fornecedor` (`id_fornecedor`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para procedure last.tr_atualiza_data
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `tr_atualiza_data`()
BEGIN
	SET GLOBAL EVENT_scheduler= ON;
	
	UPDATE contasapagar SET situacao='atrasado' where dataVencimento < curdate() and situacao != 'confirmado';
	UPDATE contasareceber SET situacao='atrasado' where dataVencimento < curdate() and situacao != 'confirmado';
	
END//
DELIMITER ;

-- Copiando estrutura para tabela last.vendas
CREATE TABLE IF NOT EXISTS `vendas` (
  `id_venda` int(11) NOT NULL AUTO_INCREMENT,
  `cod_venda` int(11) NOT NULL,
  `cod_produto` int(4) NOT NULL,
  `nome_produto` varchar(50) NOT NULL,
  `fabricante` varchar(20) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `quantidade` int(5) NOT NULL,
  `preco_venda` double(14,2) NOT NULL,
  `data_venda` date NOT NULL,
  `vendedor` varchar(50) NOT NULL,
  `idCliente` int(11) DEFAULT NULL,
  `cliente` varchar(50) DEFAULT NULL,
  `pagamento` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_venda`),
  KEY `cod_produto` (`cod_produto`)
) ENGINE=MyISAM AUTO_INCREMENT=98 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
