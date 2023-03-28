-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 26 Sty 2023, 15:57
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `automat4gc`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `automat`
--

CREATE TABLE `automat` (
  `id` int(2) NOT NULL,
  `nazwa` varchar(20) DEFAULT NULL,
  `cena` float DEFAULT NULL,
  `ilosc` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `automat`
--

INSERT INTO `automat` (`id`, `nazwa`, `cena`, `ilosc`) VALUES
(1, 'Grześki', 3.2, '10'),
(2, '7 days', 4.8, '5'),
(3, 'Sezamki', 5.7, '5'),
(4, 'Tymbark', 6, '3'),
(5, 'Coca-Cola', 6, '3');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `automat`
--
ALTER TABLE `automat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `automat`
--
ALTER TABLE `automat`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
