-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 18 2021 г., 18:37
-- Версия сервера: 10.4.21-MariaDB
-- Версия PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `new_pizza2021`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'Мясная'),
(2, 'Вегетарианская'),
(3, 'Морепродукты');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `submit_date` datetime NOT NULL,
  `edit_date` datetime DEFAULT NULL,
  `newsId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `likeCount` int(11) NOT NULL,
  `dislikeCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `text`, `picture`, `date`, `idUser`) VALUES
(1, 'Ever Given', 'asdasdasd', 'news3.jpg', '2021-10-15', 1),
(4, 'дефиците бумаги', 'Когда же в прессе на этих днях появились сообщения о возможном дефиците бумаги и бумажных изделий (любых, от туалетной бумаги до упаковочного картона), как по команде, полки магазинов, где выложены кухонные полотенца, одноразовые носовые платки и прочие предметы обихода, начали стремительно опустошаться.', 'news2.jpg', '2021-10-07', 1),
(6, 'прибыль перевозчиков', 'Только за 12 месяцев прибыль перевозчиков увеличилась четырехкратно, и рост не думает останавливаться: октябрь и, тем более, ноябрь — главные месяцы года, когда торговля пополняет запасы перед новогодними праздниками: от игрушек до парфюмерии и косметики.', 'news3.jpg', '2021-10-07', 1),
(9, 'ASUS', 'МОСКВА, 18 окт - РИА Новости. Состояние здоровья вернувшихся из космоса членов \"киноэкипажа\" актрисы Юлии Пересильд и режиссера Клима Шипенко удовлетворительное, заявил РИА Новости начальник медицинского управления Центра подготовки космонавтов Алексей Гришин.\r\n\"Состояние здоровья ожидаемое, удовлетворительное. Никаких сюрпризов они нам не преподнесли, кроме положительных\", - сказал он.\r\nСамолет Центра подготовки космонавтов с членами экипажа 66-й экспедиции на Международную космическую станцию на борту в аэропорту Чкаловский - РИА Новости, 1920, 17.10.2021\r\nВчера, 19:54\r\nКиноэкипаж вернулся в Россию после полета на МКС\r\nРанее сообщалось, что период реабилитации \"киноэкипажа\" продлится около недели.\r\nЭкипаж вернулся на землю утром 17 октября, приземлившись в степи Казахстана. Актриса и режиссер прибыли на МКС 5 октября. На станции они проводили съёмки первого в мировой истории художественного фильма в космосе.', 'admin.jpg', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `order_pizza`
--

CREATE TABLE `order_pizza` (
  `id` int(8) NOT NULL,
  `orderedPizza` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `orderdDate` date NOT NULL,
  `totalPrice` decimal(6,2) NOT NULL,
  `clientName` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `aadress` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `order_pizza`
--

INSERT INTO `order_pizza` (`id`, `orderedPizza`, `orderdDate`, `totalPrice`, `clientName`, `aadress`, `phone`, `email`) VALUES
(1, '8:2,9:1', '2021-09-01', '32.70', 'Peter Ivanov', 'Jõhvi, Rakvere 10-2', '22-33-55', 'peter@test.ee'),
(2, '8:2', '2021-09-05', '21.80', 'Maria Morozova', 'Jõhvi, Narva mnt 7-12', '33-55-77', 'maria@test.ee'),
(3, '13:1,', '2021-10-13', '10.90', 'danil', '', '545455', 'danilvrenita@gmail.com'),
(4, '13:1,', '2021-10-13', '10.90', 'danil', '', '45515', 'danilvrenita@gmail.com'),
(5, '13:1,', '2021-10-13', '10.90', 'danil', 'Jõhvi, Narva mnt 7-12', '42441051', '4'),
(6, '7:2,', '2021-10-14', '21.80', 'danil', 'Jõhvi, Narva mnt 7-12', '454546', 'danilvrenita@gmail.com'),
(7, '2:6,13:3,', '2021-10-15', '86.10', 'asd', 'asd', 'asd', 'asd@gmail.com'),
(8, '13:7,17:1,8:2,', '2021-10-16', '332.10', 'asd', 'asd', 'asd', 'asd@gmail.com'),
(9, '17:9,', '2021-10-17', '2106.00', 'asd', 'asd', 'asd', 'asd@gmail.com'),
(10, '17:3,', '2021-10-17', '702.00', 'asd', 'asd', 'asd', 'asd@gmail.com'),
(11, '19:1,', '2021-10-17', '123.00', 'asd', 'asd', 'asd', 'asd@gmail.com'),
(12, '17:1,', '2021-10-17', '234.00', 'asd', 'asd', 'asd', 'asd@gmail.com'),
(13, '2:6,', '2021-10-18', '53.40', 'asd', 'asd', 'asd', 'asd@gmail.com');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(4) NOT NULL,
  `idCategory` int(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` float(10,2) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `rating` float NOT NULL DEFAULT 0,
  `peopleRatingCount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `idCategory`, `name`, `description`, `price`, `photo`, `rating`, `peopleRatingCount`) VALUES
(1, 1, 'Пепперони', 'Соус фирменный, Сыр Моцарелла, Помидоры, Пепперони, Прованские травы, Маслины', 8.90, 'pepperoni.jpg', 5, 2),
(2, 1, 'Гавайская пицца', 'Цыпленок, томатный соус, моцарелла и ананасы', 8.90, 'hawaiian.jpg', 4.83333, 12),
(3, 2, 'Пицца 4 сыра', 'Соус сливочный, сыр Моцарелла, сыр Дор блю, сыр Чеддер, сыр Пармезан, Прованские травы', 8.90, '4cheese.jpg', 5, 1),
(4, 1, 'Мексиканская пицца', 'Цыпленок, томатный соус, сладкий перец, лук красный, моцарелла, острый перец халапеньо, томаты и соус сальса', 10.90, 'mexican.jpg', 1, 2),
(5, 1, 'Мясная', 'Цыпленок, ветчина, пикантная пепперони, томатный соус, острая чоризо и моцарелла', 8.90, 'meat.jpg', 4, 2),
(6, 1, 'Четыре сезона', 'Ветчина, пикантная пепперони, томатный соус, кубики брынзы, шампиньоны, моцарелла, томаты и орегано', 10.90, 'seasons.jpg', 5, 1),
(7, 1, 'Итальянская', 'Пикантная пепперони, томатный соус, шампиньоны, моцарелла, маслины и орегано', 10.90, 'italian.jpg', 2, 2),
(8, 3, 'Морская', 'Томатный соус, сладкий перец, лук красный, моцарелла, маслины и креветки', 10.90, 'sea.jpg', 5, 2),
(9, 3, 'Пицца с тунцом', 'Томатный соус, лук красный, моцарелла, маслины, орегано и тунец', 10.90, 'tunec.jpg', 5, 1),
(10, 1, 'Чизбургер-Пицца', 'Говядина (фарш), сырный соус, бекон, лук красный, моцарелла, томаты и огурцы консервированные', 10.90, 'cheeseburger.jpg', 5, 1),
(11, 1, 'Сырный цыпленок', 'Сырный соус, цыпленок, томаты и моцарелла', 8.90, 'cheesechicken.jpg', 5, 1),
(12, 2, 'Сальса', 'Томатный соус, шампиньоны, моцарелла и соус сальса', 8.90, 'salsa.jpg', 5, 1),
(13, 1, 'Жар-Баран', 'Томатный соус, моцарелла, томаты, колбаски из баранины и овощи-гриль', 10.90, 'baran.jpg', 4, 2),
(14, 2, 'Маргарита', 'Томатный соус, моцарелла, томаты и орегано', 8.90, 'margarita.jpg', 4.62963, 27),
(15, 2, 'Овощи и грибы', 'Томатный соус, кубики брынзы, шампиньоны, сладкий перец, лук красный, моцарелла, маслины, томаты и базилик', 8.90, 'vegetables.jpg', 5, 1),
(16, 2, 'Сырная', 'Томатный соус и моцарелла', 8.90, 'cheese.jpg', 5, 1),
(17, 1, 'asd', 'asd', 234.00, 'admin.jpg', 3.42061, 22),
(19, 2, 'asd', 'asdasd', 123.00, 'admin.jpg', 3.33408, 18);

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `submit_date` datetime NOT NULL,
  `edit_date` datetime DEFAULT NULL,
  `rating` enum('1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `likeCount` int(11) NOT NULL,
  `dislikeCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(4) NOT NULL,
  `username` varchar(50) NOT NULL,
  `epost` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','client') NOT NULL DEFAULT 'client',
  `picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `epost`, `password`, `role`, `picture`) VALUES
(1, 'admin', 'admin@test.ee', '$2y$10$S6bHNNMQI1ktbAW9d.6azOa0QHIyuGyerHMC3SQKlGI0WnYbymj9.', 'admin', 'admin.jpg'),
(5, 'dsa', 'asd@gmail.com', '$2y$10$ev7./iQpSeZOTalJAiKUyeR3ysshRphRt6pSHqk9CiDfnxBDXli3S', 'admin', 'emptyUser.png'),
(6, 'qwe', 'qwe@gmail.com', '$2y$10$o/KB.egQYMAgolNWcKV81.SqS4AMCrTHrRpvGwrxmltngZQtbSciu', 'client', 'emptyUser.png'),
(7, 'zxc', 'zxc@gmail.com', '$2y$10$rT.mDaQYVd70/Q6iW1MQieGq/K.jlg8W2H0IkdB.9Y/CpvxbHQAW6', 'client', 'admin.jpg'),
(8, 'asd', 'asd@gmail.com', '$2y$10$Qdu61OYwR03mTbiEuN/Mf.5ureUlLfL1w5sYUf8joSU3s5W6rihVi', 'admin', 'emptyUser.png');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `newsId` (`newsId`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `linna_ibfk_1` (`idUser`);

--
-- Индексы таблицы `order_pizza`
--
ALTER TABLE `order_pizza`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCategory` (`idCategory`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `order_pizza`
--
ALTER TABLE `order_pizza`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`newsId`) REFERENCES `news` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `linna_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`idCategory`) REFERENCES `category` (`id`);

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
