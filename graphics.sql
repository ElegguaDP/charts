-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 26 2016 г., 18:49
-- Версия сервера: 5.6.31
-- Версия PHP: 5.6.23

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `graphics`
--

-- --------------------------------------------------------

--
-- Структура таблицы `chart_data`
--

CREATE TABLE IF NOT EXISTS `chart_data` (
  `id` bigint(20) NOT NULL,
  `chart_id` int(11) NOT NULL,
  `y_value` float NOT NULL,
  `x_value` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `chart_data`
--

INSERT INTO `chart_data` (`id`, `chart_id`, `y_value`, `x_value`) VALUES
(1, 2, 2, 1),
(2, 3, 2, 1),
(3, 3, 3, 2),
(4, 3, 7, 3),
(5, 3, 5, 4),
(6, 2, 12, 4),
(7, 2, 14, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '10',
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `auth_key` varchar(255) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `password_hash`, `status`, `password_reset_token`, `email`, `auth_key`, `created_at`, `updated_at`) VALUES
(2, 'admin', '$2y$13$4Oa3/if1nGT5jeDC1lbpIuaNXk9xsYp6efgqflRcNFPp8K8cXe6p6', 10, NULL, 'admin@admin.com', '7IuOiVOP4vPZoXvgyu7aME9C8mjF-ngz', 1472117321, 1472117321);

-- --------------------------------------------------------

--
-- Структура таблицы `user_charts`
--

CREATE TABLE IF NOT EXISTS `user_charts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `title_x` varchar(255) DEFAULT NULL,
  `title_y` varchar(255) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_charts`
--

INSERT INTO `user_charts` (`id`, `user_id`, `url`, `title`, `description`, `title_x`, `title_y`, `created_at`, `updated_at`) VALUES
(1, 2, 'kUD1iAv', 'test 1', 'test 1', NULL, NULL, 1472136821, NULL),
(2, 2, '9X0GCK', 'asd', 'dsa', 'asd', 'dsa', 1472205628, 1472222116),
(3, 2, 'MSE_r2sUYh', 'test 3', 'test', 'X', 'Y', 1472208000, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `chart_data`
--
ALTER TABLE `chart_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chart_id` (`chart_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_charts`
--
ALTER TABLE `user_charts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `chart_data`
--
ALTER TABLE `chart_data`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `user_charts`
--
ALTER TABLE `user_charts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `chart_data`
--
ALTER TABLE `chart_data`
  ADD CONSTRAINT `fk_data_2_chart` FOREIGN KEY (`chart_id`) REFERENCES `user_charts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_charts`
--
ALTER TABLE `user_charts`
  ADD CONSTRAINT `fk_chart_2_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
