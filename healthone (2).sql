-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 30 nov 2020 om 18:11
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
CREATE DATABASE IF NOT EXISTS `healthone` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `healthone`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `medicijnen`
--

CREATE TABLE `medicijnen` (
  `id` int(11) NOT NULL,
  `naam` varchar(100) NOT NULL,
  `maker` varchar(100) NOT NULL,
  `compensated` float(5,2) NOT NULL,
  `side_efect` varchar(200) NOT NULL,
  `benefits` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `medicijnen`
--

INSERT INTO `medicijnen` (`id`, `naam`, `maker`, `compensated`, `side_efect`, `benefits`) VALUES
(14, 'diclofenac', 'bart', 1.00, 'pijn op de borst, kortademingheid, zwarte of zeer donkere ontlasting, ophoesten van bloed, blauwe plekken', 'pijnstiller, koortsverlagende werking, ontstekingsremmende werking. Goed bij acute pijn en chronische ziektes zoals reuma en jicht'),
(15, 'amoxicilline', 'jan', 1.00, 'braken, buikpijn, diarree, spijsverteringsstoornissen, huidirritaties, maagdarm-stoornissen', 'breedspectrum antibioticum, actief tegen grampositieve en gramnegatieve bacteriën'),
(16, 'omeprazol', 'henk', 1.00, 'duizeligheid, verwarring, snelle en onregelmatige hartslag, schokkende spierbewegingen, zich schrikachtig voelen, spierkrampen, spierzwakte of slap gevoel.', 'remt de productie van overmatig maagzuur. Omeprazol behoort tot de klasse van protonremmers. Omeprazol wordt ingezet ter preventie en behandeling van maagzweren.');

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
(32, 'Kees Ver kerk', '2500 PT', 'Markt 1 Den Haag', 'ZK250012018', '04-08-2000', 'basis'),
(33, 'Hilbert van der Duim', '2500 PT', 'Markt 2 Den Haag', 'ZK250022015', '04-08-2000', 'basis'),
(34, 'Yvonne van Gennip', '2500 PT', 'Markt 3 Den Haag', 'ZK250032000', '04-08-2000', 'basis');

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
  `duration` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `receipt`
--

INSERT INTO `receipt` (`id`, `patientid`, `drugid`, `notitie`, `herhaling`, `date`, `duration`) VALUES
(26, 32, 14, 'Harry', 'geen herhaling', 'Monday 30th of November 2020 06:04:31 PM', '9-sep'),
(27, 33, 15, 'Ties', 'geen herhaling', 'Monday 30th of November 2020 06:04:59 PM', '16-sep'),
(28, 34, 16, 'Wilma', 'geen herhaling', 'Monday 30th of November 2020 06:05:42 PM', '25-sep');

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
(1, 'admin', '81fdff283ec2829b4002384ad18370f64e7a48618c45058e3d112d965e27f72e', 'alles', 'admin'),
(5, 'aphoteker', '81fdff283ec2829b4002384ad18370f64e7a48618c45058e3d112d965e27f72e', ' iets', 'aphoteker'),
(6, 'arts', '81fdff283ec2829b4002384ad18370f64e7a48618c45058e3d112d965e27f72e', ' niet iets', 'arts');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT voor een tabel `patienten`
--
ALTER TABLE `patienten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT voor een tabel `receipt`
--
ALTER TABLE `receipt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
