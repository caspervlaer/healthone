-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 29 nov 2020 om 16:07
-- Serverversie: 10.4.14-MariaDB
-- PHP-versie: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthone`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `medicijnen`
--

CREATE TABLE `medicijnen` (
  `id` int(11) NOT NULL,
  `naam` varchar(100) NOT NULL,
  `maker` varchar(100) NOT NULL,
  `compensated` float(5,2) NOT NULL,
  `side_efect` varchar(100) NOT NULL,
  `benefits` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `medicijnen`
--

INSERT INTO `medicijnen` (`id`, `naam`, `maker`, `compensated`, `side_efect`, `benefits`) VALUES
(3, 'jas', 'asd', 1.00, 'asdasd', 'alles'),
(6, 'asda', 'asd', 0.00, '', ''),
(7, 'sad', '', 0.00, '', ''),
(8, 'sad', '', 0.00, '', ''),
(9, 'sad', '', 0.00, '', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `patienten`
--

CREATE TABLE `patienten` (
  `id` int(11) NOT NULL,
  `naam` varchar(100) NOT NULL,
  `adres` varchar(100) NOT NULL,
  `woonplaats` varchar(100) NOT NULL,
  `zknummer` varchar(12) NOT NULL,
  `geboortedatum` varchar(100) NOT NULL,
  `soortverzekering` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `patienten`
--

INSERT INTO `patienten` (`id`, `naam`, `adres`, `woonplaats`, `zknummer`, `geboortedatum`, `soortverzekering`) VALUES
(21, 'casper', 'van arembergelaan 88', 'voorburg', '24153235115', '04-08-2000', 'basic'),
(22, 'test', 'test', 'test', 'test', 'test', 'test'),
(29, 'asd', 's', '', '', '04-08-2000', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `receipt`
--

CREATE TABLE `receipt` (
  `id` int(11) NOT NULL,
  `patientid` int(11) NOT NULL,
  `drugid` int(11) NOT NULL,
  `notitie` varchar(100) NOT NULL,
  `herhaling` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `receipt`
--

INSERT INTO `receipt` (`id`, `patientid`, `drugid`, `notitie`, `herhaling`, `date`, `duration`) VALUES
(20, 22, 7, '12312', '12312', 'Saturday 28th of November 2020 06:38:48 PM', 123),
(21, 26, 7, 'voor hemroids', 'ja', 'Saturday 28th of November 2020 11:52:12 PM', 0),
(25, 29, 3, 'sadasd', '1231', 'Sunday 29th of November 2020 03:25:10 PM', 10);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(12) NOT NULL,
  `wachtwoord` varchar(64) NOT NULL,
  `apotheek` varchar(100) NOT NULL,
  `role` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `name`, `wachtwoord`, `apotheek`, `role`) VALUES
(1, 'admin', '81fdff283ec2829b4002384ad18370f64e7a48618c45058e3d112d965e27f72e', 'alles', 'admin');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `medicijnen`
--
ALTER TABLE `medicijnen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `patienten`
--
ALTER TABLE `patienten`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientid` (`patientid`),
  ADD KEY `drugid` (`drugid`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `medicijnen`
--
ALTER TABLE `medicijnen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `patienten`
--
ALTER TABLE `patienten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT voor een tabel `receipt`
--
ALTER TABLE `receipt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
