-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Апр 23 2017 г., 13:21
-- Версия сервера: 5.6.24
-- Версия PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `f1stats`
--

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `alias` varchar(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`id`, `name`, `alias`) VALUES
(1, 'Украина', 'ukr'),
(2, 'Германия', 'ger'),
(3, 'Великобритания', 'gbr'),
(5, 'Италия', 'ita'),
(6, 'Бразилия', 'bra'),
(7, 'Австралия', 'aus'),
(8, 'Испания', 'esp'),
(9, 'Польша', 'pol'),
(10, 'Россия', 'rus'),
(11, 'Швейцария', 'che'),
(12, 'Финляндия', 'fin'),
(13, 'Индия', 'ind'),
(14, 'Япония', 'jap'),
(17, 'Франция', 'fra'),
(19, 'Малайзия', 'mal');

-- --------------------------------------------------------

--
-- Структура таблицы `drivers`
--

CREATE TABLE IF NOT EXISTS `drivers` (
  `id` int(10) unsigned NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `team_id` int(10) unsigned NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  `info` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `drivers`
--

INSERT INTO `drivers` (`id`, `first_name`, `last_name`, `team_id`, `country_id`, `info`) VALUES
(2, 'Марк', 'Уэббер', 3, 7, ''),
(3, 'Фернандо', 'Алонсо', 4, 8, ''),
(4, 'Дженсон', 'Баттон', 1, 3, ''),
(5, 'Фелипе', 'Масса', 15, 6, ''),
(6, 'Льюис', 'Хемильтон', 2, 3, ''),
(7, 'Роберт', 'Кубица', 6, 9, ''),
(8, 'Нико', 'Росберг', 2, 2, ''),
(9, 'Михаэль', 'Шумахер', 2, 2, ''),
(10, 'Адриан ', 'Сутиль', 7, 2, ''),
(11, 'Виттантонио', 'Люцци', 7, 5, ''),
(12, 'Рубенс', 'Барикелло', 15, 6, ''),
(13, 'Виталий ', 'Петров', 6, 10, ''),
(14, 'Хайме', 'Эльгассуари', 8, 8, ''),
(15, 'Нико', 'Хюлькенберг', 15, 2, ''),
(16, 'Себастьян', 'Буэми', 8, 11, ''),
(17, 'Педро', 'де ла Росса', 14, 8, ''),
(18, 'Хейки', 'Ковалайнен', 9, 12, ''),
(19, 'Карун ', 'Чандхок', 10, 13, ''),
(20, 'Бруно ', 'Сенна', 10, 6, ''),
(21, 'Ярно', 'Трулли', 9, 5, ''),
(22, 'Камуи', 'Кобаяши', 14, 14, ''),
(24, 'Eugene', 'Primachenko', 16, 1, 'test'),
(26, '1111111111111', '22222221', 16, 9, '');

-- --------------------------------------------------------

--
-- Структура таблицы `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `constructor` varchar(50) NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  `team_info` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `teams`
--

INSERT INTO `teams` (`id`, `name`, `constructor`, `country_id`, `team_info`) VALUES
(1, 'Vodafon McLaren Mercedes', 'McLaren', 3, ''),
(2, 'Mercedes GP Petronas', 'Mercedes-Benz', 2, ''),
(3, 'Red Bull Racing', 'Red Bull', 11, ''),
(4, 'Scuderia Ferrari Marlboro', 'Ferrari', 5, ''),
(6, 'Renault F1 Team', 'Renault', 17, ''),
(7, 'Force India F1 Team', 'Force India', 13, ''),
(8, 'Scuderia Toro Rosso', 'Toro Rosso', 5, ''),
(9, 'Lotus Racing', 'Lotus', 3, ''),
(10, 'Hispania Racing', 'Hispania Racing', 8, ''),
(11, 'BMW Sauber F1 Team', 'BMW Sauber', 2, ''),
(12, 'Virgin Racing', 'Virgin', 3, ''),
(13, 'Manor Racing', 'Manor', 3, ''),
(14, 'Sauber Petronas F1 Team', 'Sauber', 19, ''),
(15, 'AT&T WilliamsF1', 'Williams', 3, ''),
(16, 'PrimaRacingTeam', 'Primak', 1, '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT для таблицы `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT для таблицы `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
