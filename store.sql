-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 14 2022 г., 10:27
-- Версия сервера: 10.4.19-MariaDB
-- Версия PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `store`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cats`
--

CREATE TABLE `cats` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cats`
--

INSERT INTO `cats` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Apple', NULL, NULL),
(2, 'Samsung', NULL, NULL),
(3, 'Huawei', NULL, NULL),
(4, 'Honor', NULL, NULL),
(5, 'Xiaomi', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `name`, `desc`, `price`, `img`, `cat`, `created_at`, `updated_at`) VALUES
(1, 'iPad mini 2021 Wi-Fi+Cell 64 ГБ LTE', 'Apple iPad mini 2021. Дисплей Liquid Retina 8.3 дюйма на всю переднюю панель. Мощный чип A15 Bionic с системой Neural Engine. Сверхширокоугольная фронтальная камера 12 Мп с функцией «В центре внимания».', 61999, 'https://c.dns-shop.ru/thumb/st1/fit/500/500/3176f035609030cd861c0cdc19fb454b/ab73d4fae67ed22a45915d8c6237172db9bb8f119035a86b8b47db9b86696eff.png.webp', 1, NULL, NULL),
(6, 'iPad Pro 2020 Wi‑Fi 128 ГБ', 'Планшет Apple iPad Pro 2020 Wi Fi 128 ГБ – элегантный серебристый прибор с 12.9-дюймовым экраном, дополненным эффективным защитным покрытием. Установленная система iPadOS быстро реагирует на ваши команды благодаря работе 8-ядерного процессора и наличию 6 ГБ ОЗУ. Имеющихся 128 ГБ достаточной для установки набора важных приложений и хранения личной информации.\r\n', 77899, 'https://c.dns-shop.ru/thumb/st4/fit/500/500/6804273df3a48820163aebe18210548b/30e0c0d9647ff7e3b93c054c1f423eeced094a752fd19906f774a3553db261fa.jpg.webp', 1, NULL, NULL),
(7, 'Galaxy Tab S7 FE LTE 64GB Black', 'Современная штука. Идеальное устройство для продвинутых пользователей', 44999, 'https://img.mvideo.ru/Big/30057208bb.jpg', 2, NULL, NULL),
(8, 'MatePad 10.4\" 4+128GB WiFi Midnight Grey', 'Huawei MatePad – универсальный планшет для работы, учёбы и развлечений. Устройство с прочным металлическим корпусом весит 460 г и подойдёт для использования во время поездок. Встроенный аккумулятор позволяет в течение примерно 12 часов не задумываться о подзарядке.\r\n', 22999, 'https://img.mvideo.ru/Big/30054867bb.jpg', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_01_12_082321_cats', 1),
(6, '2022_01_12_082326_items', 1),
(7, '2022_01_14_045518_create_rews_table', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `rews`
--

CREATE TABLE `rews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `score` int(11) NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `item` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `rews`
--

INSERT INTO `rews` (`id`, `score`, `text`, `item`, `created_at`, `updated_at`) VALUES
(1, 4, 'пп', 1, '2022-01-14 02:25:35', '2022-01-14 02:25:35'),
(2, 4, 'пп', 1, '2022-01-14 02:26:03', '2022-01-14 02:26:03'),
(3, 4, 'пп', 1, '2022-01-14 02:26:35', '2022-01-14 02:26:35'),
(4, 5, 'класс', 1, '2022-01-14 02:27:40', '2022-01-14 02:27:40'),
(5, 1, 'мультики смотреть пойдет', 6, '2022-01-14 02:28:08', '2022-01-14 02:28:08'),
(6, 4, 'класс', 6, '2022-01-14 02:28:33', '2022-01-14 02:28:33'),
(7, 4, 'fsdf', 6, '2022-01-14 02:29:14', '2022-01-14 02:29:14'),
(8, 6, 'мультики смотреть пойдет', 6, '2022-01-14 02:36:17', '2022-01-14 02:36:17'),
(9, 4, 'круто!', 8, '2022-01-14 02:41:08', '2022-01-14 02:41:08'),
(10, 10, 'СУПЕР КРУТО ПЛАНШЕТ ДЛЯ ИГОР!!!!!!!!!!!!СУПЕР КРУТО ПЛАНШЕТ ДЛЯ ИГОР!!!!!!!!!!!!СУПЕР КРУТО ПЛАНШЕТ ДЛЯ ИГОР!!!!!!!!!!!!СУПЕР КРУТО ПЛАНШЕТ ДЛЯ ИГОР!!!!!!!!!!!!', 1, '2022-01-14 02:50:26', '2022-01-14 02:50:26'),
(11, 10, 'СУПЕР КРУТО ПЛАНШЕТ ДЛЯ ИГОР!!!!!!!!!!!!СУПЕР КРУТО ПЛАНШЕТ ДЛЯ ИГОР!!!!!!!!!!!!СУПЕР КРУТО ПЛАНШЕТ ДЛЯ ИГОР!!!!!!!!!!!!СУПЕР КРУТО ПЛАНШЕТ ДЛЯ ИГОР!!!!!!!!!!!!', 1, '2022-01-14 02:50:38', '2022-01-14 02:50:38'),
(12, 1, 'asds', 1, '2022-01-14 03:16:25', '2022-01-14 03:16:25'),
(13, 10, '35', 1, '2022-01-14 03:16:47', '2022-01-14 03:16:47'),
(14, 5, 'rdsf', 1, '2022-01-14 03:17:22', '2022-01-14 03:17:22'),
(15, 3, 'dsa', 1, '2022-01-14 03:17:55', '2022-01-14 03:17:55'),
(16, 5, '4', 8, '2022-01-14 03:21:54', '2022-01-14 03:21:54'),
(17, 5, 'f', 8, '2022-01-14 03:30:33', '2022-01-14 03:30:33'),
(18, 5, 'f', 8, '2022-01-14 03:51:06', '2022-01-14 03:51:06'),
(19, 5, 'ffds', 8, '2022-01-14 03:53:31', '2022-01-14 03:53:31'),
(20, 2, 'dsa', 8, '2022-01-14 03:53:47', '2022-01-14 03:53:47'),
(21, 3, 'd', 6, '2022-01-14 04:14:08', '2022-01-14 04:14:08'),
(22, 2, 'fds', 6, '2022-01-14 04:14:28', '2022-01-14 04:14:28'),
(23, 3, 'fds', 8, '2022-01-14 04:15:44', '2022-01-14 04:15:44'),
(24, 3, 'fds', 8, '2022-01-14 04:16:14', '2022-01-14 04:16:14'),
(25, 4, 'fds', 8, '2022-01-14 04:17:45', '2022-01-14 04:17:45'),
(26, 1, '121', 8, '2022-01-14 04:18:42', '2022-01-14 04:18:42'),
(27, 2, 'dfsd', 8, '2022-01-14 04:22:42', '2022-01-14 04:22:42'),
(28, 4, 'fds', 8, '2022-01-14 04:23:12', '2022-01-14 04:23:12');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cats`
--
ALTER TABLE `cats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cats_name_unique` (`name`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_at` (`updated_at`),
  ADD KEY `cat` (`cat`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `rews`
--
ALTER TABLE `rews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item` (`item`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cats`
--
ALTER TABLE `cats`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `rews`
--
ALTER TABLE `rews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`cat`) REFERENCES `cats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rews`
--
ALTER TABLE `rews`
  ADD CONSTRAINT `rews_ibfk_1` FOREIGN KEY (`item`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
