-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 04 mrt 2020 om 15:01
-- Serverversie: 10.4.11-MariaDB
-- PHP-versie: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diary`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `dagboeken`
--

CREATE TABLE `dagboeken` (
  `id_dagboek` int(5) NOT NULL,
  `id_gebruiker` int(5) NOT NULL,
  `naam` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `dagboeken`
--

INSERT INTO `dagboeken` (`id_dagboek`, `id_gebruiker`, `naam`) VALUES
(34, 57, 'nieuw');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers`
--

CREATE TABLE `gebruikers` (
  `id_gebruiker` int(5) NOT NULL,
  `voornaam` varchar(50) NOT NULL,
  `tussenvoegsels` varchar(10) NOT NULL,
  `achternaam` varchar(50) NOT NULL,
  `email` varchar(254) NOT NULL,
  `wachtwoord` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` (`id_gebruiker`, `voornaam`, `tussenvoegsels`, `achternaam`, `email`, `wachtwoord`) VALUES
(57, 'deo', '', 'deo', 'deo@roc.nl', '$2y$10$wrq8qdT2DWgn7oxpGCSkBOuRKGcDuEVXV9VfebOCCvAaAjXF0fkhG');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `posts`
--

CREATE TABLE `posts` (
  `id_post` int(5) NOT NULL,
  `id_dagboek` int(5) NOT NULL,
  `post` text NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `posts`
--

INSERT INTO `posts` (`id_post`, `id_dagboek`, `post`, `datum`) VALUES
(39, 34, 'new', '2020-03-04');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `dagboeken`
--
ALTER TABLE `dagboeken`
  ADD PRIMARY KEY (`id_dagboek`),
  ADD KEY `id_gebruiker` (`id_gebruiker`);

--
-- Indexen voor tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`id_gebruiker`);

--
-- Indexen voor tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_dagboek` (`id_dagboek`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `dagboeken`
--
ALTER TABLE `dagboeken`
  MODIFY `id_dagboek` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT voor een tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  MODIFY `id_gebruiker` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `dagboeken`
--
ALTER TABLE `dagboeken`
  ADD CONSTRAINT `id_gebruiker` FOREIGN KEY (`id_gebruiker`) REFERENCES `gebruikers` (`id_gebruiker`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `id_dagboek` FOREIGN KEY (`id_dagboek`) REFERENCES `dagboeken` (`id_dagboek`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
