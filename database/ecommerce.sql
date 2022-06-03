-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31-Maio-2022 às 01:12
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


--
-- Banco de dados: `store_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `is_active`) VALUES
(1, 'Gustavo Dias', 'gustavodiias09@gmail.com', '$2y$10$stgXFO7gy9K5w31T8IjIWeN5KIQo40AFz1avp98KMtXEzJtHjbZJe', '0'),
(2, 'Lucas Luquesi', 'lucasluquesi@gmail.com', '$2y$10$JRrSvqflZyzzRX1Di5VwCOE2Ksl/TTrIwMCD/q6Tj9XNUdOIB1xCC', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(100) NOT NULL,
  `brand_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'Oakley'),
(2, 'Mcd'),
(7, 'Nike');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(250) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cart`
--

INSERT INTO `cart` (`id`, `p_id`, `ip_add`, `user_id`, `qty`) VALUES
(13, 14, '::1', 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(3, 'Feminino'),
(12, 'Tênis'),
(13, 'Camiseta'),
(14, 'Calça'),
(15, 'Moletom');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `trx_id` varchar(255) NOT NULL,
  `p_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `qty`, `trx_id`, `p_status`) VALUES
(1, 1, 14, 1, '5ST20243U7492473P', 'Completed'),
(2, 1, 15, 1, '5ST20243U7492473P', 'Completed');

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_cat` int(11) NOT NULL,
  `product_brand` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_qty`, `product_desc`, `product_image`, `product_keywords`) VALUES
(14, 15, 2, 'MOLETOM CANGURU FECHADO RGB', 380, 100, 'MOLETOM FELPADO 310G | 50% ALGODÃO 50% POLIÉSTER', '1653463268_Moletom MCD.png', 'mcd, moletom'),
(15, 15, 2, 'MOLETOM CANGURU FECHADO LOGOMANIA', 479, 100, 'MOLETOM FELPADO 250G | 50% ALGODÃO 50% POLIÉSTER', '1653463395_Moletom MCD2.png', 'mcd, moletom'),
(16, 15, 2, 'SUÉTER JACQUARD FULL SKULL', 470, 100, '100% LÃ ACRÍLICA | TRICOT JACQUARD', '1653463577_Moletom MCD4.png', 'mcd, moletom'),
(17, 13, 2, 'T-SHIRT REGULAR ONDULAÇÃO', 130, 200, 'M. MALHA PENTEADA 30/1 | 100% ALGODÃO', '1653463760_Camiseta MCD.png', 'camiseta, mcd'),
(18, 13, 2, 'T-SHIRT REGULAR LIQUIFY', 150, 200, 'M. MALHA PENTEADA 30/1 | 100% ALGODÃO', '1653463859_Camiseta MCD2.png', 'camiseta, mcd'),
(19, 13, 2, 'T-SHIRT REGULAR DISSECTION', 140, 200, 'M. MALHA PENTEADA 30/1 | 100% ALGODÃO', '1653464165_Camiseta MCD3.png', 'camiseta, mcd'),
(20, 14, 2, 'CALÇA DENIM LOOSE FIT', 330, 200, 'ÍNDIGO 8,4OZ | 98% ALGODÃO 2% ELASTANO', '1653464361_Calça MCD.png', 'calça, mcd'),
(21, 14, 2, 'CALÇA RGB', 440, 200, 'MICRO FIBRA | 100% POLIAMIDA', '1653464437_Calça MCD2.png', 'calça, mcd'),
(23, 12, 1, 'TÊNIS OAKLEY FLAK II ', 600, 200, 'O tênis Flak II é para os apaixonados pela Oakley e para quem prioriza qualidade, este tênis possui design que vai conferir muito estilo as suas composições.\r\n\r\nO tênis Oakley masculino ainda conta com excelentes materiais e é ideal para utilizar nas mais diversas ocasiões. O cabedal (parte superior do calçado) é têxtil e em couro, que promove mais charme e exclusividade a peça.\r\n\r\nA lingueta é acolchoada e flexível, palmilha removível e solado de borracha tratorada. Compre já seu tênis Oakley Flak II!', '1653464999_Tênis Oakley2.png', 'tênis, oakley'),
(24, 12, 1, 'TÊNIS OAKLEY MODOC LOW ll', 400, 300, 'Para você que busca algo estiloso e perfeito para os dias de aventura, o Tênis Oakley Modoc Low II é ideal. O cabedal (parte superior do calçado) em têxtil, sintético e camurça, com solado em borracha tratorada. O tênis masculino conta com forro têxtil e reforço acolchoado proporcionando mais proteção. A palmilha é macia, forrada e removível facilitando a limpeza. Não perca tempo e se destaque com esse tênis!', '1653465183_Tênis Oakley3.png', 'tênis, oakley'),
(25, 12, 1, 'TÊNIS OAKLEY BRAVOS', 500, 200, 'Conheça o Tênis Oakley Bravos \r\nModerno e inconfundível, o Tênis Oakley Masculino, é a opção ideal em todos os momentos. O cabedal (parte superior do calçado) em sintético proporciona suporte, apoio e durabilidade. Já a entressola e solado emborrachados, garantem maior estabilidade e aderência em todas as superfícies. Além disso, seu design possibilita um look despojado para você que é cheio de atitude. Confira e compre hoje! ', '1653465300_Tênis Oakley4.png', 'tênis, oakley'),
(26, 3, 7, 'TÊNIS NIKE DOWNSHIFTER 11', 229, 200, 'Desde uma tranquila caminhada aos treinos fitness e corrida leve faz do Tênis Nike Downshifter 11 uma ótima opção. Seu cabedal (parte superior do calçado) é em têxtil leve e macio para um encaixe confortável e flexível. Já a entressola em espuma garante um leve e duradouro amortecimento com solado emborrachado e ranhuras, combinação perfeita entre aderência uma naturalidade na distribuição das passadas. Confira de perto a versatilidade do Nike Downshifter 11 e aproveite o preço para comprar o seu!', '1653949918_nike01.png', 'feminino, nike, tênis'),
(27, 3, 7, 'TÊNIS NIKE REVOLUTION 5 ', 199, 200, 'Versátil e ultra confortável para a academia, treinos leves de corrida e uso diário.\r\nQuer um tênis Nike com o melhor custo benefício? O Revolution 5 é para você mulher dinâmica e moderna.\r\nSeu cabedal (parte superior do tênis) apresenta leveza, respirabilidade, mantém o frescor e flexibilidade dos movimentos. Na entressola, a inserção da espuma em toda a extensão garante uma pisada macia e suave com leve amortecimento.\r\nJá o solado do Nike Revolution 5 feminino oferece excelente tração e uma distribuição natural das passadas.\r\n\r\nVenha conferir aqui na Centauro, não perca a oportunidade. Compre já!', '1653950033_nike02.png', 'feminino, nike, tênis'),
(28, 3, 7, 'TÊNIS NIKE DOWNSHIFTER 11', 229, 200, 'Desde uma tranquila caminhada aos treinos fitness e corrida leve faz do Tênis Nike Downshifter 11 uma ótima opção. Seu cabedal (parte superior do calçado) é em têxtil leve e macio para um encaixe confortável e flexível. Já a entressola em espuma garante um leve e duradouro amortecimento com solado emborrachado e ranhuras, combinação perfeita entre aderência uma naturalidade na distribuição das passadas. Confira de perto a versatilidade do Nike Downshifter 11 e aproveite o preço para comprar o seu!', '1653950157_nike04.png', 'feminino, nike, tênis');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `address2` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user_info`
--

INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address1`, `address2`) VALUES
(1, 'Carlos ', 'Dias', 'guguasu279@gmail.com', '25f9e794323b453885f5181f1b624d0b', '1997480089', 'xxxx', 'xxxx'),
(2, 'Gustavo', 'Noite', 'teste@teste.com', '17003122b89ccb2a3d7d4970de0d91ae', '1699748008', 'Rua Germano Zaiantick, 147', '147');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Índices para tabela `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Índices para tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_product_cat` (`product_cat`),
  ADD KEY `fk_product_brand` (`product_brand`);

--
-- Índices para tabela `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_product_brand` FOREIGN KEY (`product_brand`) REFERENCES `brands` (`brand_id`),
  ADD CONSTRAINT `fk_product_cat` FOREIGN KEY (`product_cat`) REFERENCES `categories` (`cat_id`);
COMMIT;

