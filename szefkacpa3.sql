-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Czas generowania: 05 Gru 2024, 14:59
-- Wersja serwera: 10.5.26-MariaDB-0+deb11u2
-- Wersja PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `szefkacpa3`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `informacje`
--

CREATE TABLE `informacje` (
                              `id` int(11) NOT NULL,
                              `tytul` varchar(50) NOT NULL,
                              `tresc` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `informacje`
--

INSERT INTO `informacje` (`id`, `tytul`, `tresc`) VALUES
                                                      (1, 'o_nas', 'Witaj na stronie sklepu TRNSHOP.\r\n\r\nJest to sklep z taborem kolejowym wraz z jego serwisem.\r\nMożesz tu kupić lub wynająć lokomotywy elektryczne i spalinowe oraz wagony towarowe i pasażerskie.\r\n\r\nOdbiór i transport nabytego taboru\r\nOferujemy dostarczenie nabytego taboru kolejowego do wskazanego przez kupującego miejsca lub bocznicy kolejowej.\r\nMożliwy jest też odbiór osobisty w naszym sklepie ulokowanym w centrum Polski – Piotrkowie Trybunalskim przy ulicy Towarowej 1.\r\n\r\nSklep\r\nOferujemy szeroki dostęp do lokomotyw i wagonów na sprzedaż czy na wynajem.\r\nZajrzyj do naszego katalogu i wybierz dostępny u nas tabor.\r\n\r\nSerwis\r\nW naszym serwisie ulokowanym przy sklepie i zajezdni wykonywane są prace utrzymania pojazdu P2.1, P2.2, P3, P4 oraz PS. Mamy szybki i szeroki dostęp do nowych części zamiennych trzymanych w naszym magazynie.'),
                                                      (2, 'regulamin', '\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Integer et orci purus. In a nisi sed augue elementum cursus. Cras at dictum orci. Donec aliquam urna id fringilla gravida. Ut aliquet scelerisque est nec imperdiet. Maecenas porta dolor odio, vel mattis diam fringilla non. Pellentesque viverra neque eu feugiat lacinia. Sed tempor enim lorem, et accumsan turpis suscipit sed. Sed nisl nibh, sagittis nec euismod id, elementum at lacus. Sed finibus vel nisi vel feugiat. Cras sollicitudin suscipit eros, ac rhoncus mauris sagittis nec. Fusce ac ornare dolor.\r\n\r\nPellentesque mattis sem eget ultrices eleifend. Phasellus sit amet interdum mi, eu gravida ipsum. Sed in tempor mi. Vivamus ac sodales quam. Ut non mi ut felis pellentesque accumsan. Sed ac risus convallis, dapibus massa id, tincidunt nibh. Integer semper lacinia aliquet. Cras urna leo, pulvinar in iaculis eu, suscipit eget velit. Integer in diam ut augue ultrices scelerisque. Pellentesque euismod arcu ac libero cursus, vel mollis sem vehicula. Mauris quis lorem efficitur, elementum ipsum dapibus, sagittis purus. Sed vel rutrum ipsum. Praesent ut nisl nec enim eleifend lobortis in in erat. Mauris suscipit lacus est, convallis iaculis justo cursus vel. Sed tristique mauris risus, non posuere velit tempus id. Fusce sed consectetur magna, sed tincidunt orci.\r\n\r\nSed malesuada augue nec lectus placerat, ut mattis quam molestie. Quisque sagittis dolor in augue volutpat, ut pretium massa ultricies. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris turpis dui, euismod sit amet porta vitae, mattis et purus. Cras aliquet fermentum quam, eget dapibus nunc pretium a. Maecenas ut placerat eros. Morbi volutpat interdum laoreet. Phasellus sed ligula gravida, sollicitudin nulla ac, eleifend nunc. Pellentesque eleifend orci ac velit bibendum pellentesque eu a urna.\r\n\r\nCurabitur convallis eros vel lacus bibendum efficitur. Aenean rutrum ex in elit iaculis, in feugiat ligula vulputate. Curabitur sed viverra tortor. Nullam eros ante, vestibulum in lectus non, finibus porttitor magna. Nulla laoreet suscipit nunc, sed rhoncus dui feugiat nec. Nam non mauris malesuada, molestie elit nec, tristique sem. Nulla sed euismod tellus. Fusce id ex faucibus, elementum magna eget, hendrerit purus. Etiam ut erat tellus. Quisque sit amet sapien eget sem iaculis facilisis. Quisque commodo mi tellus.\r\n\r\nMauris pulvinar dui in arcu viverra hendrerit. Vivamus in lacus ac tortor efficitur consectetur. Maecenas tellus magna, dapibus a lacus nec, aliquet blandit dolor. Nullam a ipsum lectus. Sed ut gravida erat, vel vulputate lacus. In nisi dolor, pretium in ultrices sed, elementum nec est. Nam maximus sem ac tincidunt malesuada. Vestibulum at nulla magna.\r\n\r\nMauris sit amet cursus lacus. In nec libero vel ex egestas vulputate. Ut egestas est vel felis congue, sed interdum turpis congue. Nam euismod lacus eget velit rutrum bibendum. Praesent ut placerat metus. Quisque vel quam et ante accumsan ultrices et ut urna. Maecenas non felis nec neque mattis iaculis at id lacus. Sed in nulla blandit nibh ornare interdum. Etiam at blandit risus, at semper nunc. Ut varius non nisl non gravida. Ut nec felis id nunc lobortis consectetur et sit amet arcu. Donec egestas pretium orci, elementum malesuada nulla congue non. Aliquam laoreet efficitur ligula nec tempus.\r\n\r\nInteger vitae magna enim. Quisque ornare urna id turpis dapibus, eget gravida ipsum tristique. Aliquam sodales in nisl vitae fermentum. Suspendisse potenti. Nulla bibendum mattis felis, nec pretium diam pulvinar nec. Donec nunc lacus, dapibus ut magna eu, varius dapibus justo. Aliquam hendrerit rutrum orci. Suspendisse sit amet finibus eros. Integer non orci ligula. Curabitur vel interdum justo, nec consequat mauris. Curabitur condimentum ipsum ac fringilla congue. Proin non mi vitae neque sodales cursus. Morbi imperdiet facilisis lectus, ac sagittis arcu lobortis sed.\r\n\r\nNunc malesuada nulla nisl, eget elementum justo imperdiet commodo. Ut aliquam, purus ut rhoncus tincidunt, ex urna luctus quam, ut gravida mi tellus vitae tellus. Aliquam tellus mauris, cursus eu aliquam ut, porttitor a est. Proin sed augue nec eros semper finibus. Phasellus pretium maximus nunc eget porta. Quisque vestibulum libero et nulla feugiat, vitae aliquam orci semper. Donec molestie est arcu. Praesent in mi quis turpis convallis tincidunt quis in turpis. Curabitur finibus rutrum ante. Maecenas mollis felis nibh, nec facilisis neque ultrices at. Maecenas lectus felis, mattis quis lacus vitae, tempor finibus justo. Nullam in mi non lectus aliquet facilisis a in turpis. Nam ultricies ornare turpis, ac suscipit sapien tincidunt non. Cras id malesuada mauris. Vivamus quis dui ut mauris egestas vulputate nec in felis.\r\n\r\nQuisque sed porttitor tortor. In at molestie mi. Fusce tristique et metus vel consequat. Fusce laoreet risus et quam molestie, in consectetur velit cursus. Aenean mollis et purus ac pellentesque. Nunc eget lorem non leo finibus cursus. Praesent ut ante hendrerit risus aliquet sagittis. Sed et augue eget lorem vehicula malesuada sit amet et enim. Vestibulum sollicitudin pulvinar arcu, vel vulputate erat malesuada id. Mauris sollicitudin, ante et imperdiet pharetra, nisi augue porta tellus, vitae tristique orci tellus eget purus. Phasellus aliquet nisl et tellus aliquet semper. Morbi id porta tortor. In nec nisl a lorem ultrices tincidunt. Aliquam iaculis convallis lorem vitae interdum. In at est egestas, ullamcorper odio sed, pulvinar diam.\r\n\r\nSed ante neque, egestas non pretium sit amet, pellentesque a elit. Praesent justo libero, ornare et ex in, imperdiet posuere metus. Pellentesque consequat, risus sit amet rhoncus maximus, turpis turpis ultricies neque, sit amet mollis diam odio in enim. Vestibulum vel imperdiet diam. Quisque ipsum erat, dignissim sed nisl et, egestas lacinia libero. Cras ipsum enim, molestie at lorem in, convallis tempor ex. In tincidunt viverra augue in faucibus.\r\n\r\nIn scelerisque velit nisl, sit amet accumsan arcu venenatis eget. Integer ex turpis, rhoncus a consectetur vel, varius vel nisl. Maecenas vitae fringilla neque. Nunc aliquet sagittis aliquet. Praesent tincidunt ultricies leo, ac convallis dolor porta id. Aliquam eu magna nisi. Suspendisse eget lobortis eros, et fermentum justo. Donec tincidunt, ligula quis blandit iaculis, est orci interdum tortor, sit amet vestibulum tellus enim in ipsum. Sed augue arcu, pellentesque eu justo id, dignissim tincidunt tellus. Suspendisse gravida metus eu maximus fringilla. Phasellus nec facilisis tortor, ut ullamcorper risus. Phasellus vitae rhoncus. ');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
                             `id` int(11) NOT NULL,
                             `nazwa` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `kategorie`
--

INSERT INTO `kategorie` (`id`, `nazwa`) VALUES
                                            (3, 'lokomotywa elektryczna'),
                                            (2, 'lokomotywa spalinowa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszyk`
--

CREATE TABLE `koszyk` (
                          `id` int(11) NOT NULL,
                          `id_klient` int(11) NOT NULL,
                          `id_produktu` int(11) NOT NULL,
                          `ilosc` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `koszyk`
--

INSERT INTO `koszyk` (`id`, `id_klient`, `id_produktu`, `ilosc`) VALUES
                                                                     (29, 13, 7, 1),
                                                                     (33, 1, 3, 1);

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`id`, `nazwa`, `cena`, `id_kategoria`, `opis`) VALUES
                                                                           (1, 'HCP 301D', '650000', 2, 'Masa służbowa: 102t\r\nDługość: 18900mm\r\nMoc znamionowa: 1250kW\r\nPrędkość konstrukcyjna: 120 km/h\r\nUkład osi: Co’Co’'),
                                                                           (2, 'ŁTZ M62', '550000', 2, 'Masa służbowa: 116,5t\r\nDługość: 17550mm\r\nMoc znamionowa: 1472kW\r\nPrędkość konstrukcyjna: 100 km/h\r\nUkład osi: Co’Co’'),
                                                                           (3, 'CKD S200', '300000', 2, 'Masa służbowa: 114,6t\r\nDługość: 17240mm\r\nMoc znamionowa: 993kW\r\nPrędkość konstrukcyjna: 90 km/h\r\nUkład osi: Co’Co’'),
                                                                           (4, 'Fablok 411D', '300000', 2, 'Masa służbowa: 116,4t\r\nDługość: 17000mm\r\nMoc znamionowa: 880kW\r\nPrędkość konstrukcyjna: 80 km/h\r\nUkład osi: Co’Co’'),
                                                                           (5, 'Fablok 6D', '450000', 2, 'Masa służbowa: 70t\r\nDługość: 14240mm\r\nMoc znamionowa: 588kW\r\nPrędkość konstrukcyjna: 90 km/h\r\nUkład osi: Bo’Bo’'),
                                                                           (6, 'jeżdżące g ibiza rozwalone sprzęgło', '7', 2, 'Masa: 1130kg\r\nMoc znamionowa: 63kW'),
                                                                           (7, 'Bombardier TRAXX III 188', '5500000', 3, 'Masa służbowa: 82t\r\nDługość: 18900mm\r\nMoc ciągła: 5600kW\r\nPrędkość konstrukcyjna: 140 km/h\r\nUkład osi: Bo’Bo’'),
                                                                           (8, 'ASEA E150', '175000', 3, 'Masa służbowa: 81,2t\r\nDługość: 14170mm\r\nMoc ciągła: 1620kW\r\nPrędkość konstrukcyjna: 100 km/h\r\nUkład osi: Bo’Bo’'),
                                                                           (9, 'Pafawag 104E', '800000', 3, 'Masa służbowa: 83,5t\r\nDługość: 16740mm\r\nMoc ciągła: 2920kW\r\nPrędkość konstrukcyjna: 160 km/h\r\nUkład osi: Bo’Bo’'),
                                                                           (10, 'Pafawag 3E', '300000', 3, 'Masa służbowa: 121t/114t(3E/1)\r\nDługość: 16820mm\r\nMoc ciągła: 1860kW\r\nPrędkość konstrukcyjna: 100 km/h\r\nUkład osi: Co’Co’'),
                                                                           (11, 'Pafawag 4E', '750000', 3, 'Masa służbowa: 80t\r\nDługość: 15915mm\r\nMoc ciągła: 2000kW\r\nPrędkość konstrukcyjna: 125 km/h\r\nUkład osi: Bo’Bo’'),
                                                                           (12, 'Skoda 79E', '800000', 3, 'Masa służbowa: 84,8t\r\nDługość: 17210mm\r\nMoc ciągła: 2040kW\r\nPrędkość konstrukcyjna: 100 km/h\r\nUkład osi: Bo’Bo’'),
                                                                           (13, 'Skoda 43E', '800000', 3, 'Masa służbowa: 88t\r\nDługość: 16140mm\r\nMoc ciągła: 2032kW\r\nPrędkość konstrukcyjna: 90 km/h\r\nUkład osi: Bo’Bo’'),
                                                                           (14, 'HCP 203E', '1800000', 3, 'Masa służbowa: 167t\r\nDługość: 31860mm\r\nMoc ciągła: 4000kW\r\nPrędkość konstrukcyjna: 125 km/h\r\nUkład osi: Bo’Bo’+Bo’Bo’'),
                                                                           (15, 'Skoda 77E', '1750000', 3, 'Masa służbowa: 164t\r\nDługość: 34420mm\r\nMoc ciągła: 4080kW\r\nPrędkość konstrukcyjna: 100 km/h\r\nUkład osi: Bo’Bo’+Bo’Bo’'),
                                                                           (16, 'Pafawag 201E', '1100000', 3, 'Masa służbowa: 120t\r\nDługość: 19240mm\r\nMoc ciągła: 3000kW\r\nPrędkość konstrukcyjna: 125 km/h\r\nUkład osi: Co’Co’');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reset_hasla`
--

CREATE TABLE `reset_hasla` (
                               `id` int(11) NOT NULL,
                               `email` varchar(255) NOT NULL,
                               `token` varchar(255) NOT NULL,
                               `data` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `imie`, `nazwisko`, `email`, `haslo`, `adres`, `kod_pocztowy`, `miasto`, `telefon`, `created_at`) VALUES
                                                                                                                                       (0, 'admin', 'admin', 'admin@admin.admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin', 'admin', 'admin', 'admin', '1999-12-31 23:00:00'),
                                                                                                                                       (1, 'NOT_LOGIN', 'NOT_LOGIN', 'NOT_LOGIN', 'NOT_LOGIN', 'NOT_LOGIN', 'NLOGIN', 'NOT_LOGIN', 'NOT_LOGIN', '1999-12-31 23:00:00'),
                                                                                                                                       (5, 'kapec', 'kapec', 'kaperglichy@gmail.com', '458bc9a646f061e4e556983b98c81c27a5de4c9b0d936954d73b359d0f108351', 'kapec', '08-123', 'kapec', '123456789', '2024-10-01 13:45:57'),
                                                                                                                                       (7, 'kapec', 'kaperr', 'kacpergluchowsk@gmail.com', '458bc9a646f061e4e556983b98c81c27a5de4c9b0d936954d73b359d0f108351', '234234', '242344', 'erwer', '23423', '2024-10-04 14:06:19'),
                                                                                                                                       (8, 'kapec', 'kapec', 'kacpergluchowski.krypto@gmail.com', 'dcd23169008850eaacb69a553a071178e8fd9a24971b86209112f1f9ed019b58', 'kapec', '123456', 'kapec', '123456789', '2024-10-04 14:08:52'),
                                                                                                                                       (9, 'Mati', 'Plutą', 'mati.gareol@gmail.com', 'a2e052fd5cd9ee8f40c2fb025fc9ffa1782b2d5c24da5cf6ff2d4133e216eea5', 'Piaski Przedmiejskie 2', '08-110', 'Siedlce', '728121933', '2024-10-04 14:13:44'),
                                                                                                                                       (10, 'aaa', 'aaa', 'aaa@aaa.eee', 'f78838c3e13d08b1309f3437ad723ec52481bf3631d0f5207e5e257428e9c362', 'aaa', 'aaa', 'aaa', 'aaa', '2024-10-04 17:41:31'),
                                                                                                                                       (13, 'ademo', 'ademo', 'kacpergluchowski.praca@gmail.com', 'e33367e38d6c23a7457472939fb331af6ce658489eab1a3df9b3ebb0b3341be9', 'ademk', 'ademo', 'ademk', '159357258', '2024-11-27 06:34:06'),
                                                                                                                                       (14, 'chuj', 'gluch', 'gluchy@chuj.com', 'e02dcd324ace03505c5331538e7c774fdea7fd54f8179d08cbe40af12b075d9b', 'mordowiertara', '12-345', 'miasto', '123456789', '2024-11-27 18:10:05'),
                                                                                                                                       (15, 'Jacek', 'Jaworek', 'SesbianLex@gmail.com', '40079bdb2754748850de095f664941c7da9037aa7fcb258917a36318f6f3ed66', 'Piaski Przedmiejskie 2', '08-110', 'Siedlce', '711922822', '2024-11-27 20:51:43');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
                              `id` int(11) NOT NULL,
                              `id_klient` int(11) NOT NULL,
                              `id_produkt` int(11) NOT NULL,
                              `ilosc` int(11) NOT NULL,
                              `status` varchar(35) NOT NULL DEFAULT 'przyjęte',
                              `imie` varchar(50) NOT NULL,
                              `nazwisko` varchar(50) NOT NULL,
                              `adres` varchar(100) NOT NULL,
                              `miasto` varchar(50) NOT NULL,
                              `kod_pocztowy` char(6) NOT NULL,
                              `email` varchar(50) NOT NULL,
                              `status_platnosci` varchar(20) NOT NULL DEFAULT 'nieopłacone',
                              `data` datetime NOT NULL,
                              `telefon` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`id`, `id_klient`, `id_produkt`, `ilosc`, `status`, `imie`, `nazwisko`, `adres`, `miasto`, `kod_pocztowy`, `email`, `status_platnosci`, `data`, `telefon`) VALUES
                                                                                                                                                                                         (1, 14, 2, 2, 'w realizacji', '', '', '', '', '', '', 'nieopłacone', '2024-11-27 00:00:00', ''),
                                                                                                                                                                                         (2, 1, 6, 2, 'W realizacji', '', '', '', '', '', '', 'nieopłacone', '0000-00-00 00:00:00', ''),
                                                                                                                                                                                         (3, 13, 7, 1, 'W realizacji', '', '', '', '', '', '', 'nieopłacone', '0000-00-00 00:00:00', ''),
                                                                                                                                                                                         (4, 13, 16, 1, 'W realizacji', '', '', '', '', '', '', 'nieopłacone', '0000-00-00 00:00:00', ''),
                                                                                                                                                                                         (5, 1, 7, 1, 'W realizacji', '', '', '', '', '', '', 'nieopłacone', '0000-00-00 00:00:00', ''),
                                                                                                                                                                                         (6, 13, 7, 1, 'Oczekujące', 'kacper', 'kacper', 'kacper', 'kacper', 'kacper', 'kacpergluchowski.praca@gmail.com', 'nieopłacone', '0000-00-00 00:00:00', 'kacper'),
                                                                                                                                                                                         (11, 13, 10, 1, 'Oczekujące', 'kacper', 'kacper', 'sdfsfs', 'gjgjf', 'gjkgjh', 'kacpergluchowski.praca@gmail.com', 'nieopłacone', '0000-00-00 00:00:00', 'hkhk'),
                                                                                                                                                                                         (12, 13, 6, 1, 'Oczekujące', 'kacper', 'kacper', 'sdfsfs', 'gjgjf', 'gjkgjh', 'kacpergluchowski.praca@gmail.com', 'nieopłacone', '0000-00-00 00:00:00', 'hkhk'),
                                                                                                                                                                                         (13, 13, 7, 1, 'OczekujÄ…ce', 'sdfgsdf', 'dsfdsg', 'gsdgsdgf', 'sdgfsdg', 'sdfgsd', 'ys4hcgi57@mozmail.com', 'nieopłacone', '0000-00-00 00:00:00', 'sdf'),
                                                                                                                                                                                         (14, 13, 7, 1, 'OczekujÄ…ce', 'gfhfdh', 'dfghdfgh', 'dfhgfdgh', 'dfghdfhd', 'fhdfhg', 'ys4hcgi57@mozmail.com', 'nieopłacone', '0000-00-00 00:00:00', 'dfh'),
                                                                                                                                                                                         (15, 1, 9, 1, 'OczekujÄ…ce', 'aaa', 'aaa', 'werewr', 'Animi magna nisi in', '08110', 'aaa@aaa.pl', 'nieopłacone', '0000-00-00 00:00:00', '+1 (766) 593-7352'),
                                                                                                                                                                                         (16, 1, 1, 1, 'OczekujÄ…ce', 'aaa', 'aaa', 'werewr', 'Animi magna nisi in', '08110', 'aaa@aaa.pl', 'nieopłacone', '0000-00-00 00:00:00', '+1 (766) 593-7352');

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
-- Indeksy dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
    ADD PRIMARY KEY (`id`),
  ADD KEY `id_produktu` (`id_produktu`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
    ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategoria` (`id_kategoria`);

--
-- Indeksy dla tabeli `reset_hasla`
--
ALTER TABLE `reset_hasla`
    ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `informacje`
--
ALTER TABLE `informacje`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT dla tabeli `reset_hasla`
--
ALTER TABLE `reset_hasla`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
