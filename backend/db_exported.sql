-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 12, 2023 alle 16:13
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `viaggio`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `agenzie`
--

CREATE TABLE `agenzie` (
  `idagenzia` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `indirizzo` varchar(255) DEFAULT NULL,
  `iso` varchar(255) DEFAULT NULL,
  `esperienza` varchar(255) DEFAULT NULL,
  `rc` tinyint(1) DEFAULT NULL,
  `annullamento` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `commenti`
--

CREATE TABLE `commenti` (
  `idcommento` int(11) NOT NULL,
  `testo` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idagenzia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `offerta`
--

CREATE TABLE `offerta` (
  `idofferta` int(11) NOT NULL,
  `nBusta` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `tourOperator` varchar(255) DEFAULT NULL,
  `prezzo` decimal(10,0) DEFAULT NULL,
  `stelle` int(11) DEFAULT NULL,
  `nAlunni` int(11) DEFAULT NULL,
  `posizione` varchar(255) DEFAULT NULL,
  `mezzi` varchar(255) DEFAULT NULL,
  `ristorante` varchar(255) DEFAULT NULL,
  `servizioRistorante` varchar(255) DEFAULT NULL,
  `treno` varchar(255) DEFAULT NULL,
  `bus` varchar(255) DEFAULT NULL,
  `punti` varchar(255) DEFAULT NULL,
  `cig` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `organizza`
--

CREATE TABLE `organizza` (
  `id` int(11) NOT NULL,
  `idutente` int(11) NOT NULL,
  `cig` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `servizio`
--

CREATE TABLE `servizio` (
  `idServizio` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descrizione` varchar(255) DEFAULT NULL,
  `idofferta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `idutente` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `cognome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `tipologia` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`idutente`, `nome`, `cognome`, `email`, `password`, `telefono`, `tipologia`) VALUES
(1, 'giulio', 'bombarda', 'admin@gmail.com', 'admin123', '[value-5]', '1'),
(2, 'a', '[value-2]', 'a@a', 'aaa', '[value-5]', '[value-6]'),
(3, 'asasdasd', 'adsasdasd', 'asdasd@ffff', '<aa', NULL, NULL),
(4, 'Giulio', 'Bombarda', 'giuliobomby@gmail.com', '122334', NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `viaggio`
--

CREATE TABLE `viaggio` (
  `cig` int(11) NOT NULL,
  `nLotto` varchar(255) DEFAULT NULL,
  `meta` varchar(255) DEFAULT NULL,
  `giorn` varchar(255) DEFAULT NULL,
  `ngiorni` int(11) NOT NULL,
  `nstudenti` int(11) DEFAULT NULL,
  `ndocenti` int(11) DEFAULT NULL,
  `invalido` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `viaggio`
--

INSERT INTO `viaggio` (`cig`, `nLotto`, `meta`, `giorn`, `ngiorni`, `nstudenti`, `ndocenti`, `invalido`) VALUES
(1, '123', 'roma', '2023-03-09', 4, 12, 2, 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `agenzie`
--
ALTER TABLE `agenzie`
  ADD PRIMARY KEY (`idagenzia`);

--
-- Indici per le tabelle `commenti`
--
ALTER TABLE `commenti`
  ADD PRIMARY KEY (`idcommento`),
  ADD KEY `idagenzia` (`idagenzia`);

--
-- Indici per le tabelle `offerta`
--
ALTER TABLE `offerta`
  ADD PRIMARY KEY (`idofferta`),
  ADD KEY `cig` (`cig`);

--
-- Indici per le tabelle `organizza`
--
ALTER TABLE `organizza`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idutente` (`idutente`),
  ADD KEY `cig` (`cig`);

--
-- Indici per le tabelle `servizio`
--
ALTER TABLE `servizio`
  ADD PRIMARY KEY (`idServizio`),
  ADD KEY `idofferta` (`idofferta`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`idutente`);

--
-- Indici per le tabelle `viaggio`
--
ALTER TABLE `viaggio`
  ADD PRIMARY KEY (`cig`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `agenzie`
--
ALTER TABLE `agenzie`
  MODIFY `idagenzia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `commenti`
--
ALTER TABLE `commenti`
  MODIFY `idcommento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `offerta`
--
ALTER TABLE `offerta`
  MODIFY `idofferta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `organizza`
--
ALTER TABLE `organizza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `servizio`
--
ALTER TABLE `servizio`
  MODIFY `idServizio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `idutente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `viaggio`
--
ALTER TABLE `viaggio`
  MODIFY `cig` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `commenti`
--
ALTER TABLE `commenti`
  ADD CONSTRAINT `commenti_ibfk_1` FOREIGN KEY (`idagenzia`) REFERENCES `agenzie` (`idagenzia`) ON DELETE CASCADE;

--
-- Limiti per la tabella `offerta`
--
ALTER TABLE `offerta`
  ADD CONSTRAINT `offerta_ibfk_1` FOREIGN KEY (`cig`) REFERENCES `viaggio` (`cig`) ON DELETE CASCADE;

--
-- Limiti per la tabella `organizza`
--
ALTER TABLE `organizza`
  ADD CONSTRAINT `organizza_ibfk_1` FOREIGN KEY (`idutente`) REFERENCES `utente` (`idutente`) ON DELETE CASCADE,
  ADD CONSTRAINT `organizza_ibfk_2` FOREIGN KEY (`cig`) REFERENCES `viaggio` (`cig`) ON DELETE CASCADE;

--
-- Limiti per la tabella `servizio`
--
ALTER TABLE `servizio`
  ADD CONSTRAINT `servizio_ibfk_1` FOREIGN KEY (`idofferta`) REFERENCES `offerta` (`idofferta`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
