-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Des 2024 pada 07.24
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uts_10122491`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `games`
--

INSERT INTO `games` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Mobile Legends', 'mobilegend.jpg', '2024-12-07 07:16:22', '2024-12-14 19:33:08'),
(2, 'PUBG Mobile', 'pubg.jpg', '2024-12-07 07:16:22', '2024-12-08 15:00:51'),
(3, 'Free Fire', 'freefire.jpg', '2024-12-07 07:16:22', '2024-12-07 13:11:44'),
(4, 'Genshin Impact', 'genshin.jpg', '2024-12-07 10:27:39', '2024-12-07 13:11:44'),
(19, 'Honor Of King', 'hok_11.jpg', '2024-12-07 06:12:22', '2024-12-07 06:16:37'),
(21, 'Clash Of Clans', 'coc_3.jpg', '2024-12-07 06:16:01', '2024-12-09 15:49:53'),
(22, 'Clash Royale', 'cr.jpg', '2024-12-08 08:03:10', '2024-12-08 08:03:31'),
(23, 'Call Of Duty', 'cod.jpg', '2024-12-09 10:30:18', '2024-12-09 10:30:18'),
(25, 'Arena Of Valor', 'aov.jpg', '2024-12-11 10:26:07', '2024-12-11 10:26:07'),
(26, 'Valorant', 'valorant.jpg', '2024-12-11 10:38:12', '2024-12-11 10:38:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `game_id` int(11) DEFAULT NULL,
  `package_name` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `currency_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `packages`
--

INSERT INTO `packages` (`id`, `game_id`, `package_name`, `price`, `currency_type`) VALUES
(1, 1, '10 Diamond', 3000.00, 'IDR'),
(2, 1, '20 diamond', 6000.00, 'IDR'),
(3, 2, '10 UC', 5000.00, 'IDR'),
(4, 1, '30 diamond', 9000.00, 'IDR'),
(5, 1, '40 diamond', 12000.00, 'IDR'),
(6, 2, '20 UC', 10000.00, 'IDR'),
(7, 1, 'Weekly Pass diamond', 27500.00, 'IDR'),
(9, 4, '10 Primogems', 6000.00, 'IDR'),
(10, 4, '20 Primogems', 12000.00, 'IDR'),
(14, 2, '31 UC', 45000.00, 'IDR'),
(20, 1, '1000 Diamond', 1000000.00, 'IDR'),
(21, 4, '30 Primogems', 24000.00, 'IDR'),
(22, 1, '10000 Diamond', 1500000.00, 'IDR'),
(24, 1, '2 Weekly Diamond Pass ', 54000.00, 'IDR');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `username_game` varchar(100) NOT NULL,
  `game_user_id` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `game_id`, `package_id`, `username_game`, `game_user_id`, `email`, `payment_method`, `created_at`) VALUES
(1, 2, 1, 1, 'dodo', '218967', 'admin@gmail.com', 'qris', '2024-12-10 06:53:03'),
(3, 1, 1, 1, 'Admin1234', '1234567', 'admin1@gmail.com', NULL, '2024-12-11 06:40:36'),
(5, 3, 1, 20, 'userml', '87878787', 'user@gmail.com', 'Qris', '2024-12-11 13:35:00'),
(16, 1, 1, 1, 'dodo', '1234567', 'afirdo06@gmail.com', 'credit_card', '2024-12-14 19:59:07'),
(17, 2, 2, 2, 'apip', '11111111', 'afirdo06@gmail.com', 'credit_card', '2024-12-14 19:59:54'),
(18, 5, 1, 1, 'pakpahan', '879583', 'afirdo06@gmail.com', 'dana', '2024-12-14 20:01:18'),
(19, 5, 1, 1, 'kenrik', '344343434334', 'afirdo06@gmail.com', 'qris', '2024-12-14 13:29:32'),
(20, 5, 1, 1, 'kenrik', '777777777', 'admin1@gmail.com', 'qris', '2024-12-14 13:35:01'),
(21, 5, 1, 7, 'rawr ', '87453278', 'admin1@gmail.com', 'qris', '2024-12-14 13:35:58'),
(22, 3, 1, 20, 'keyra', '666666666', 'admin@gmail.com', 'qris', '2024-12-14 13:38:54'),
(23, 3, 1, 24, 'tarta', '0000000000', 'admin1@gmail.com', 'qris', '2024-12-14 13:39:46'),
(24, 3, 1, 1, 'dodo', '218967', 'admin1@gmail.com', 'qris', '2024-12-14 13:40:22'),
(25, 3, 1, 1, 'dodo', '11111111', 'afirdor@gmail.com', 'qris', '2024-12-14 13:41:07'),
(26, 3, 1, 1, 'wewew', '222222222222', 'admin@gmail.com', 'dana', '2024-12-14 13:42:21'),
(27, 3, NULL, 1, 'rrrrrrrrr', '44444444444', 'afirdor@gmail.com', 'qris', '2024-12-14 13:48:42'),
(28, 3, 1, 4, 'rrrrrrrrr', '555555555555', 'afirdo06@gmail.com', 'dana', '2024-12-14 13:49:47'),
(29, 3, 2, 14, 'prtz', '8788787878', 'admin1@gmail.com', 'qris', '2024-12-14 13:52:17'),
(30, 3, 1, 22, 'hbuhuhji', '8888888888', 'afirdo06@gmail.com', 'bni', '2024-12-14 14:11:58'),
(31, 1, 1, 1, 'Admin1234', '1234567', 'afirdo06@gmail.com', 'dana', '2024-12-14 21:15:24'),
(32, 1, 1, 1, 'Admin1234', '1234567', 'afirdo06@gmail.com', 'dana', '2024-12-14 21:26:56'),
(33, 1, 1, 2, 'Admin1234', '11111111', 'admin1@gmail.com', 'dana', '2024-12-14 21:28:07'),
(34, 1, 2, 1, 'Admin1234', '11111111', 'admin1@gmail.com', 'qris', '2024-12-14 21:28:23'),
(35, 1, 1, 22, 'dodo', '1234567', 'afirdo06@gmail.com', 'alfamart', '2024-12-14 21:32:22'),
(36, 1, 1, 1, 'apip', '218967', 'afirdo06@gmail.com', 'gopay', '2024-12-14 14:33:56'),
(37, 1, 1, 7, 'afirdo', '546736178', 'afirdo06@gmail.com', 'bca', '2024-12-15 13:42:46'),
(38, 3, 1, 1, 'kenrik', '1234567', 'admin@gmail.com', 'indomart', '2024-12-15 06:43:27'),
(39, 3, 1, 24, 'rrrrrrrrr', '1234567', 'afirdo06@gmail.com', 'bni', '2024-12-15 06:44:39'),
(40, 1, 1, 1, 'fajar', '63636266463', 'afirdo06@gmail.com', 'indomart', '2024-12-17 07:02:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'admin', 'admin1234', 'admin', '2024-12-07 09:09:49'),
(2, 'afirdo', 'afirdo', 'admin', '2024-12-07 13:17:56'),
(3, 'user', 'user1234', 'user', '2024-12-11 08:51:49'),
(4, 'user', 'user1234', 'user', '2024-12-11 08:51:52'),
(5, 'pakpahan', 'pakpahan', 'admin', '2024-12-14 20:00:43');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
