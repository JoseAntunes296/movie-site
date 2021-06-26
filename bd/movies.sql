-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Jun-2021 às 12:05
-- Versão do servidor: 10.4.19-MariaDB
-- versão do PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `movies`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `add_to_list`
--

CREATE TABLE `add_to_list` (
  `id_list` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_movie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `add_to_list`
--

INSERT INTO `add_to_list` (`id_list`, `id_user`, `id_movie`) VALUES
(3, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargos`
--

CREATE TABLE `cargos` (
  `id_cargo` int(11) NOT NULL,
  `cargos` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cargos`
--

INSERT INTO `cargos` (`id_cargo`, `cargos`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `comentario` longtext NOT NULL,
  `id_filme` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('Ativo','Inativo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `id_sender`, `comentario`, `id_filme`, `data`, `status`) VALUES
(1, 1, 'testing', 2, '2021-06-20 11:34:35', 'Ativo'),
(2, 1, 'Love IT', 2, '2021-06-20 12:15:08', 'Ativo'),
(3, 1, 'Love IT\r\n', 1, '2021-06-20 22:03:57', 'Ativo'),
(4, 1, 'T\r\nT\r\nT', 1, '2021-06-20 22:04:05', 'Ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `filmes`
--

CREATE TABLE `filmes` (
  `id_movie` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `genero` varchar(255) NOT NULL,
  `data de estreia` date NOT NULL,
  `realizador` varchar(255) NOT NULL,
  `ano` int(11) NOT NULL,
  `duracao` int(11) NOT NULL,
  `desc` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `filmes`
--

INSERT INTO `filmes` (`id_movie`, `name`, `genero`, `data de estreia`, `realizador`, `ano`, `duracao`, `desc`, `image`, `rating`) VALUES
(1, 'The Conjuring 3 - A Obra do Diabo', 'Terror', '2021-06-03', 'Michael Chaves', 2021, 112, 'A arrepiante história de terror, homicídio e de uma entidade malévola que chocou até os experientes investigadores de atividades paranormais, Ed e Lorraine Warren. Este é um dos mais sensacionais casos dos seus arquivos, que começa com a luta pela alma de um jovem rapaz, levando-os para além de algo que nunca tinham visto. Pela primeira vez na história dos EUA, um suspeito de homicídio declara estar possuído por um demónio para se defender. Vera Farmiga e Patrick Wilson estão de volta como Lorraine e Ed Warren, sob a realização de Michael Chaves (“A Maldição Da Mulher Que Chora”).', 'conjuring-3.jpg', 0),
(2, 'The Conjuring 2: A Evocação', 'Terror', '2016-06-10', 'James Wan', 2016, 135, 'Ed e Lorraine Warren, o casal especialista em casos paranormais, está de regresso numa das suas investigações mais aterradoras. Em Londres irão ajudar uma mãe solteira a criar quatro crianças numa casa assombrada por espíritos maliciosos.', 'conjuring-2.jpg', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `cargo` int(11) NOT NULL,
  `status` enum('Activo','Inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `email`, `cargo`, `status`) VALUES
(1, 'Darkness', 'dac8dac98ec4d67f78e08cafe23a9d70', 'joseroldao296@gmail.com', 1, 'Activo');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `add_to_list`
--
ALTER TABLE `add_to_list`
  ADD PRIMARY KEY (`id_list`),
  ADD KEY `id_movie` (`id_movie`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices para tabela `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Índices para tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_sender` (`id_sender`),
  ADD KEY `id_filme` (`id_filme`);

--
-- Índices para tabela `filmes`
--
ALTER TABLE `filmes`
  ADD PRIMARY KEY (`id_movie`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `cargo` (`cargo`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `add_to_list`
--
ALTER TABLE `add_to_list`
  MODIFY `id_list` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `filmes`
--
ALTER TABLE `filmes`
  MODIFY `id_movie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `add_to_list`
--
ALTER TABLE `add_to_list`
  ADD CONSTRAINT `add_to_list_ibfk_1` FOREIGN KEY (`id_movie`) REFERENCES `filmes` (`id_movie`),
  ADD CONSTRAINT `add_to_list_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Limitadores para a tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_sender`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_filme`) REFERENCES `filmes` (`id_movie`);

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`cargo`) REFERENCES `cargos` (`id_cargo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
