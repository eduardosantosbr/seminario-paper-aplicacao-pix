
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `telefone` varchar(30) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `endereco`, `telefone`, `usuario`, `senha`) VALUES
(19, 'Arthur Rogado Reis', 'Rua 10', ' 5562991514140', 'arthur', '$2y$10$lMHX4qPQTjymbI8w3Xf9FOBpySgv/xyVMh2RsMnTsRo513s3CJ9b2'),
(20, 'Juila Alvin das Costas', 'Rua W24, Solta Gato, Uçuaru', ' 5562984643664', 'juila', '$2y$10$5mSxdOVW1vbnyFNRfJzEl.9RzJ.UrEd.J3r9nOGb9.4yn1TO3G1hC'),
(25, 'Carlos Eduardo Jesus dos Reis', 'Rua 10', '62993281462', 'carlos', '$2y$10$wAOpKVdzAWItm.fqRv8Y1eQFhSQLx17UOFYHnSsBzn.Q0uCm3OTb6'),
(34, 'Samuel', 'Rua formosa', '000000001', 'samuel', '$2y$10$onguc9hwdpU34miEyxnzYOYqscklrIFzazv2OFRZWTtOhvYdRb2EG');


ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO categorias (descricao) VALUES
('Alimentação'),
('Assinatura de serviços'),
('Compras'),
('Doação'),
('Dividas e emprestimos'),
('Financiamento'),
('Investimento');

--
-- Estrutura da tabela `lancamentos`
--

CREATE TABLE `lancamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(250) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `tipo` CHAR(1) DEFAULT NULL,
  `dataCriacao` date NOT NULL,
  `dataLancamento` date NOT NULL,
  `usuario_id` int,
  `categoria_id` int,
  PRIMARY KEY (`id`),
  CONSTRAINT fk_usuario FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`),
  CONSTRAINT fk_categoria FOREIGN KEY (`categoria_id`) REFERENCES `categorias`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


