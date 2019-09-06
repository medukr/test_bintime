-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Сен 06 2019 г., 13:01
-- Версия сервера: 5.7.27-0ubuntu0.18.04.1
-- Версия PHP: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bintime_test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_index` varchar(5) NOT NULL,
  `country` varchar(2) NOT NULL,
  `city` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `house` varchar(255) NOT NULL,
  `office` int(11) DEFAULT NULL,
  `is_active` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `address`
--

INSERT INTO `address` (`id`, `user_id`, `post_index`, `country`, `city`, `street`, `house`, `office`, `is_active`) VALUES
(19, 16, '01000', 'UA', 'Киев', 'Улица', '22Б', 1, 1),
(20, 16, '01001', 'РУ', 'London', 'Street', '4', 22, 1),
(21, 17, '01040', 'RU', 'Purpe', 'газонокосильщиков', '3', NULL, 1),
(22, 18, '00225', 'US', 'New York City', 'Brighton 4Th St', '1', 1, 1),
(23, 19, '8526', 'CN', 'Shenzhen', 'Gaudun', '555', 555, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1567618531),
('m190904_171942_create_users_table', 1567620368),
('m190904_172847_create_address_table', 1567620368),
('m190905_110045_add_active_column_to_users_table', 1567681449),
('m190905_110252_add_active_column_to_address_table', 1567681449);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `sex` int(1) NOT NULL,
  `created_ad` datetime NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_active` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `last_name`, `sex`, `created_ad`, `email`, `is_active`) VALUES
(16, 'user1', '$2y$13$9U/Sgzt6mNx.7JJwR2lUKOPQ/5od5q4We2STxQwGETM5sPQw8j7oK', 'петро', 'Петрович', 1, '2019-09-06 12:29:03', 'perto@petro.petro', 1),
(17, 'user2', '$2y$13$Pz5lEtJO/MC.1l.dY9JJWudgzTHNyLu7JDntbyuHhYE1.ysHDNS0e', 'Galyna', 'Galynich', 2, '2019-09-06 12:32:21', 'galya@mail.com', 1),
(18, 'user3', '$2y$13$PALX5VLqe17pztUy9uOoveGwHpv6XfPtBrMmSM4aQF5zRS6tW38Km', 'User3', 'User3', 0, '2019-09-06 12:52:03', 'who@is.it', 1),
(19, 'USer4', '$2y$13$GV9o4NpJV56fS0Y8Jayj0ubDABM8LWpg/MtV65JL3.KqZRJsGMMtG', '&lt;b&gt;USER&lt;/b&gt;', '&lt;a href=&quot;https://google.com&quot;&gt;hello&lt;/a&gt;', 0, '2019-09-06 12:55:35', 'anonimus@is.us', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
