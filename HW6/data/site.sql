-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 14 2021 г., 22:20
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `site`
--

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` int NOT NULL,
  `name` varchar(256) NOT NULL,
  `feedback` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `feedback`) VALUES
(18, 'Здравствуй', 'Здравствуйте'),
(19, 'Студент', 'Доброго времени суток!'),
(20, 'Студент', 'Спасибо за уроки');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `likes` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `name`, `likes`) VALUES
(1, '01.jpg', 1),
(2, '02.jpg', 4),
(3, '03.jpg', 0),
(4, '04.jpg', 0),
(5, '05.jpg', 1),
(6, '06.jpg', 0),
(7, '07.jpg', 0),
(8, '08.jpg', 3),
(9, '09.jpg', 0),
(10, '10.jpg', 0),
(11, '11.jpg', 0),
(12, '12.jpg', 0),
(13, '13.jpg', 1),
(14, '14.jpg', 0),
(15, '15.jpg', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `price` int NOT NULL DEFAULT '0',
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name`, `image`, `price`, `description`) VALUES
(1, 'Виски Dewar\'s 12 years old, 0.5 л', '1.jpg', 2050, 'Фильтрация:\r\nХолодная фильтрация<br>\r\nВыдержка:\r\n12 лет<br>\r\nТип бочки:\r\nДубовые бочки\r\n'),
(2, 'Виски Dewar\'s Caribbean Smooth 8 years, gift box, 0,7', '2.jpg', 1851, 'Фильтрация:\r\nХолодная фильтрация<br>\r\nВыдержка:\r\n8 лет<br>\r\nТип бочки:\r\nДубовые бочки\r\n'),
(3, 'Виски Dewar\'s White Label, gift box, 1 л', '3.jpg', 2666, 'Страна:\r\nШотландия<br>\r\n \r\nПроизводитель:\r\nJohn Dewar and Sons<br>\r\n \r\nБренд:\r\nDewar\'s<br>\r\n\r\nФильтрация:\r\nХолодная фильтрация<br>\r\nТип бочки:\r\nДубовые бочки\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `name`) VALUES
(1, '1.png'),
(2, '2.png'),
(3, '3.png'),
(4, '4.png'),
(5, '5.png'),
(6, '6.png'),
(7, '7.png'),
(8, '8.png');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(256) NOT NULL,
  `image` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `description`, `price`) VALUES
(1, 'Футболка', '1.png', 'Футболка с принтом', 900),
(2, 'Кепка', '2.png', 'Кепка обычная', 600),
(3, 'Джинсы', '3.png', 'Джинсы синие, обычные', 2000),
(4, 'Рубаха', '4.png', 'Рубаха Kostin', 2500),
(5, 'Куртка', '5.png', 'Куртка-ветровка Dino', 4500),
(6, 'Солнечные очки', '6.png', 'Очки Aviator pontorez', 3500),
(7, 'Худи', '7.png', 'кофта с капюшоном, принт !220V!', 3000),
(8, 'Шорты', '8.png', 'Шорты комбаты цвета хаки', 2250);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
