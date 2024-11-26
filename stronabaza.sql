-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lis 26, 2024 at 09:08 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stronabaza`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `informacje`
--

CREATE TABLE `informacje` (
                              `id` int(11) NOT NULL,
                              `tytul` varchar(50) NOT NULL,
                              `tresc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
                             `id` int(11) NOT NULL,
                             `nazwa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategorie`
--

INSERT INTO `kategorie` (`id`, `nazwa`) VALUES
    (2, 'lokomotywa spalinowa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
                            `id` int(11) NOT NULL,
                            `nazwa` varchar(50) NOT NULL,
                            `cena` decimal(10,0) NOT NULL,
                            `id_kategoria` int(11) NOT NULL,
                            `opis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`id`, `nazwa`, `cena`, `id_kategoria`, `opis`) VALUES
                                                                           (1, 'HCP 301D', 650000, 2, 'Masa służbowa: 102t\r\nDługość: 18900mm\r\nMoc znamionowa: 1250kW\r\nPrędkość konstrukcyjna: 120 km/h\r\nUkład osi: Co’Co’'),
                                                                           (2, 'ŁTZ M62', 550000, 2, 'Masa służbowa: 116,5t\r\nDługość: 17550mm\r\nMoc znamionowa: 1472kW\r\nPrędkość konstrukcyjna: 100 km/h\r\nUkład osi: Co’Co’'),
                                                                           (3, 'CKD S200', 300000, 2, 'Masa służbowa: 114,6t\r\nDługość: 17240mm\r\nMoc znamionowa: 993kW\r\nPrędkość konstrukcyjna: 90 km/h\r\nUkład osi: Co’Co’'),
                                                                           (4, 'Fablok 411D', 300000, 2, 'Masa służbowa: 116,4t\r\nDługość: 17000mm\r\nMoc znamionowa: 880kW\r\nPrędkość konstrukcyjna: 80 km/h\r\nUkład osi: Co’Co’'),
                                                                           (5, 'Fablok 6D', 450000, 2, 'Masa służbowa: 70t\r\nDługość: 14240mm\r\nMoc znamionowa: 588kW\r\nPrędkość konstrukcyjna: 90 km/h\r\nUkład osi: Bo’Bo’');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
                               `id` int(11) NOT NULL,
                               `imie` varchar(50) NOT NULL,
                               `nazwisko` varchar(50) NOT NULL,
                               `email` varchar(100) NOT NULL,
                               `haslo` varchar(255) NOT NULL,
                               `adres` varchar(255) DEFAULT NULL,
                               `kod_pocztowy` char(6) DEFAULT NULL,
                               `miasto` varchar(100) DEFAULT NULL,
                               `telefon` varchar(22) DEFAULT NULL,
                               `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `imie`, `nazwisko`, `email`, `haslo`, `adres`, `kod_pocztowy`, `miasto`, `telefon`, `created_at`) VALUES
                                                                                                                                       (0, 'admin', 'admin', 'admin@admin.admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin', '00-000', 'admin', '000000000', '1999-12-31 23:00:00'),
                                                                                                                                       (1, 'kacper', 'kacper', 'kacpergluchowski@gmail.com', '458bc9a646f061e4e556983b98c81c27a5de4c9b0d936954d73b359d0f108351', 'kacper', '08-111', 'kacper', '123456789', '2024-09-26 18:46:48'),
                                                                                                                                       (5, 'kapec', 'kapec', 'kaperglichy@gmail.com', '458bc9a646f061e4e556983b98c81c27a5de4c9b0d936954d73b359d0f108351', 'kapec', '08-123', 'kapec', '123456789', '2024-10-01 13:45:57'),
                                                                                                                                       (7, 'kapec', 'kaperr', 'kacpergluchowsk@gmail.com', '458bc9a646f061e4e556983b98c81c27a5de4c9b0d936954d73b359d0f108351', '234234', '242344', 'erwer', '23423', '2024-10-04 14:06:19'),
                                                                                                                                       (8, 'kapec', 'kapec', 'kacpergluchowski.krypto@gmail.com', 'dcd23169008850eaacb69a553a071178e8fd9a24971b86209112f1f9ed019b58', 'kapec', '123456', 'kapec', '123456789', '2024-10-04 14:08:52'),
                                                                                                                                       (9, 'Mati', 'Plutą', 'mati.gareol@gmail.com', 'a2e052fd5cd9ee8f40c2fb025fc9ffa1782b2d5c24da5cf6ff2d4133e216eea5', 'Piaski Przedmiejskie 2', '08-110', 'Siedlce', '728121933', '2024-10-04 14:13:44'),
                                                                                                                                       (10, 'aaa', 'aaa', 'aaa@aaa.eee', 'f78838c3e13d08b1309f3437ad723ec52481bf3631d0f5207e5e257428e9c362', 'aaa', 'aaa', 'aaa', 'aaa', '2024-10-04 17:41:31');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
                              `id` int(11) NOT NULL,
                              `id_klient` int(11) NOT NULL,
                              `id_produkt` int(11) NOT NULL,
                              `ilosc` int(11) NOT NULL,
                              `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `informacje`
--
ALTER TABLE `informacje`
    ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
    ADD PRIMARY KEY (`id`),
  ADD KEY `nazwa` (`nazwa`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
    ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategoria` (`id_kategoria`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
    ADD PRIMARY KEY (`id`),
  ADD KEY `id_klient` (`id_klient`,`id_produkt`),
  ADD KEY `id_produkt` (`id_produkt`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `informacje`
--
ALTER TABLE `informacje`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategorie`
--
ALTER TABLE `kategorie`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produkty`
--
ALTER TABLE `produkty`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `zamowienia`
--
ALTER TABLE `zamowienia`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produkty`
--
ALTER TABLE `produkty`
    ADD CONSTRAINT `produkty_ibfk_1` FOREIGN KEY (`id_kategoria`) REFERENCES `kategorie` (`id`);

--
-- Constraints for table `zamowienia`
--
ALTER TABLE `zamowienia`
    ADD CONSTRAINT `zamowienia_ibfk_1` FOREIGN KEY (`id_produkt`) REFERENCES `produkty` (`id`),
  ADD CONSTRAINT `zamowienia_ibfk_2` FOREIGN KEY (`id_klient`) REFERENCES `uzytkownicy` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
