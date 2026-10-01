-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Gen 25, 2021 alle 22:54
-- Versione del server: 5.7.30
-- Versione PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `POPAZON`
--
CREATE DATABASE IF NOT EXISTS `POPAZON` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `POPAZON`;

-- --------------------------------------------------------

--
-- Struttura della tabella `avanzamento`
--

CREATE TABLE `avanzamento` (
  `stato` int(5) NOT NULL,
  `ordine` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `avanzamento`
--

INSERT INTO `avanzamento` (`stato`, `ordine`, `data`) VALUES
(0, 8, '2021-01-25 09:05:51'),
(0, 9, '2021-01-25 10:08:32'),
(0, 10, '2021-01-25 10:28:18'),
(0, 12, '2021-01-25 10:39:13'),
(1, 8, '2021-01-25 09:07:45'),
(1, 9, '2021-01-25 10:27:41'),
(1, 10, '2021-01-25 10:33:32'),
(1, 12, '2021-01-25 10:39:19'),
(2, 8, '2021-01-25 09:39:08');

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `numOrdine` int(11) NOT NULL,
  `catP` varchar(50) NOT NULL,
  `numero` int(11) NOT NULL,
  `qt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `carrello`
--

INSERT INTO `carrello` (`numOrdine`, `catP`, `numero`, `qt`) VALUES
(8, 'Television', 290, 1),
(9, 'Disney', 21, 1),
(9, 'Disney', 56, 1),
(9, 'Movies', 63, 2),
(10, 'Disney', 34, 1),
(12, 'Animation', 73, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria_principale`
--

CREATE TABLE `categoria_principale` (
  `titolo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `categoria_principale`
--

INSERT INTO `categoria_principale` (`titolo`) VALUES
('Animation'),
('Disney'),
('Games'),
('Movie Moment'),
('Movies'),
('Rides'),
('Television'),
('Town');

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria_specifica`
--

CREATE TABLE `categoria_specifica` (
  `titolo` varchar(50) NOT NULL,
  `titoloP` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `categoria_specifica`
--

INSERT INTO `categoria_specifica` (`titolo`, `titoloP`) VALUES
('Attack on Titan', 'Animation'),
('Naruto', 'Animation'),
('One Piece', 'Animation'),
('Mickey The True Original - 90 Years', 'Disney'),
('Nightmare Before Christmas', 'Disney'),
('Toy Story', 'Disney'),
('Up', 'Disney'),
('Horizon', 'Games'),
('The Last Of Us', 'Games'),
('Back to the Future', 'Movies'),
('Despicable Me', 'Movies'),
('Ghostbusters', 'Movies'),
('Lord of the Rings', 'Movies'),
('Titanic', 'Movies'),
('Game Of Thrones', 'Rides'),
('Marvel', 'Rides'),
('Star Wars', 'Rides'),
('Friends', 'Television'),
('Outlander', 'Television'),
('Sherlock', 'Television'),
('The Big Bang Theory', 'Television'),
('The Simpsons', 'Television'),
('Batman', 'Town'),
('Beetlejuice', 'Town'),
('My Hero Academia', 'Town');

-- --------------------------------------------------------

--
-- Struttura della tabella `notifica`
--

CREATE TABLE `notifica` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `stato` tinyint(1) NOT NULL,
  `preview` tinytext NOT NULL,
  `testo` text NOT NULL,
  `oggetto` varchar(255) NOT NULL,
  `destinatario` varchar(50) NOT NULL,
  `mittente` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `notifica`
--

INSERT INTO `notifica` (`id`, `data`, `stato`, `preview`, `testo`, `oggetto`, `destinatario`, `mittente`) VALUES
(1, '2021-01-25', 1, 'Wow, un nuovo c', 'Wow, un nuovo cliente si è registrato. Ecco alcune informazioni utili:<br/> Plinio Folliero </br>', 'Nuovo cliente', 'admin@email.com', 'plinio.folliero@email.com'),
(2, '2021-01-25', 1, 'É arrivata una', 'É arrivata una nuova richiesta di ordine, ecco il riepilogo:<br/>\r\nOrdine: 8 <br/>\r\ncliente: \r\n\n                    nome: Plinio <br/>\n                    cognome: Folliero <br/>\n                    cellulare: 1010101010 <br/>\n                    citta: Roma <br/>\n                    via: Via Romolo I  numero:1 <br/>\n                    cap: 100 <br/>\n                    provincia: RM <br/>\n                \r\nProdotti: <br/>\r\n<br/>nome: Sherlock with Skull quantità: 1 <br/>\r\nTotale: 16.99\r\n</p>\r\n<p>\r\nPer approvare e gestire gli stati andare sulla pagina gestisci ordini. ', 'Nuovo ordine', 'admin@email.com', 'plinio.folliero@email.com'),
(3, '2021-01-25', 1, 'É arrivata una', 'É arrivata una nuova richiesta di ordine, ecco il riepilogo:<br/>\r\nOrdine: 8 <br/>\r\ncliente: \r\n\n                    nome: Plinio <br/>\n                    cognome: Folliero <br/>\n                    cellulare: 1010101010 <br/>\n                    citta: Roma <br/>\n                    via: Via Romolo I  numero:1 <br/>\n                    cap: 100 <br/>\n                    provincia: RM <br/>\n                \r\nProdotti: <br/>\r\n<br/>nome: Sherlock with Skull quantità: 1 <br/>\r\nTotale: 16.99\r\n</p>\r\n<p>\r\nPer approvare e gestire gli stati andare sulla pagina gestisci ordini. ', 'Nuovo ordine', 'plinio.folliero@email.com', 'admin@email.com'),
(4, '2021-01-25', 1, 'Wow, un nuovo c', 'Wow, un nuovo cliente si è registrato. Ecco alcune informazioni utili:<br/> Gino Pino </br>', 'Nuovo cliente', 'admin@email.com', 'ginopino@tecweb.com'),
(5, '2021-01-25', 1, 'É arrivata una', 'É arrivata una nuova richiesta di ordine, ecco il riepilogo:<br/>\r\nOrdine: 9 <br/>\r\ncliente: \r\n\n                    nome: Gino <br/>\n                    cognome: Pino <br/>\n                    cellulare: 1231231231 <br/>\n                    citta: Padova <br/>\n                    via: Via della Pace numero:2 <br/>\n                    cap: 35131 <br/>\n                    provincia: PD <br/>\n                \r\nProdotti: <br/>\r\n<br/>nome: Sleeping Beauty Castle and Mickey Mouse quantità: 1 <br/>nome: Woody with RC quantità: 1 <br/>nome: Witch King on Fellbeast quantità: 2 <br/>\r\nTotale: 109.96\r\n</p>\r\n<p>\r\nPer approvare e gestire gli stati andare sulla pagina gestisci ordini. ', 'Nuovo ordine', 'admin@email.com', 'ginopino@tecweb.com'),
(6, '2021-01-25', 1, 'É arrivata una', 'É arrivata una nuova richiesta di ordine, ecco il riepilogo:<br/>\r\nOrdine: 9 <br/>\r\ncliente: \r\n\n                    nome: Gino <br/>\n                    cognome: Pino <br/>\n                    cellulare: 1231231231 <br/>\n                    citta: Padova <br/>\n                    via: Via della Pace numero:2 <br/>\n                    cap: 35131 <br/>\n                    provincia: PD <br/>\n                \r\nProdotti: <br/>\r\n<br/>nome: Sleeping Beauty Castle and Mickey Mouse quantità: 1 <br/>nome: Woody with RC quantità: 1 <br/>nome: Witch King on Fellbeast quantità: 2 <br/>\r\nTotale: 109.96\r\n</p>\r\n<p>\r\nPer approvare e gestire gli stati andare sulla pagina gestisci ordini. ', 'Nuovo ordine', 'ginopino@tecweb.com', 'admin@email.com'),
(7, '2021-01-25', 0, 'Anche gli ultim', 'Anche gli ultimi pop disponibili di catP num nome sono terminati.', 'Prodotto esaurito', 'admin@email.com', 'admin@email.com'),
(8, '2021-01-25', 0, 'É arrivata una', 'É arrivata una nuova richiesta di ordine, ecco il riepilogo:<br/>\r\nOrdine: 10 <br/>\r\ncliente: \r\n\n                    nome: Gino <br/>\n                    cognome: Pino <br/>\n                    cellulare: 1231231231 <br/>\n                    citta: Padova <br/>\n                    via: Via della Pace numero:2 <br/>\n                    cap: 35131 <br/>\n                    provincia: PD <br/>\n                \r\nProdotti: <br/>\r\n<br/>nome: Agnes quantità: 1 <br/>\r\nTotale: 12.99\r\n</p>\r\n<p>\r\nPer approvare e gestire gli stati andare sulla pagina gestisci ordini. ', 'Nuovo ordine', 'admin@email.com', 'ginopino@tecweb.com'),
(9, '2021-01-25', 1, 'É arrivata una', 'É arrivata una nuova richiesta di ordine, ecco il riepilogo:<br/>\r\nOrdine: 10 <br/>\r\ncliente: \r\n\n                    nome: Gino <br/>\n                    cognome: Pino <br/>\n                    cellulare: 1231231231 <br/>\n                    citta: Padova <br/>\n                    via: Via della Pace numero:2 <br/>\n                    cap: 35131 <br/>\n                    provincia: PD <br/>\n                \r\nProdotti: <br/>\r\n<br/>nome: Agnes quantità: 1 <br/>\r\nTotale: 12.99\r\n</p>\r\n<p>\r\nPer approvare e gestire gli stati andare sulla pagina gestisci ordini. ', 'Nuovo ordine', 'ginopino@tecweb.com', 'admin@email.com'),
(10, '2021-01-25', 0, 'É arrivata una', 'É arrivata una nuova richiesta di ordine, ecco il riepilogo:<br/>\r\nOrdine: 12 <br/>\r\ncliente: \r\n\n                    nome: Gino <br/>\n                    cognome: Pino <br/>\n                    cellulare: 1231231231 <br/>\n                    citta: Padova <br/>\n                    via: Via della Pace numero:2 <br/>\n                    cap: 35131 <br/>\n                    provincia: PD <br/>\n                \r\nProdotti: <br/>\r\n<br/>nome: Jiraiya on Toad quantità: 1 <br/>\r\nTotale: 24.99\r\n</p>\r\n<p>\r\nPer approvare e gestire gli stati andare sulla pagina gestisci ordini. ', 'Nuovo ordine', 'admin@email.com', 'ginopino@tecweb.com'),
(11, '2021-01-25', 1, 'É arrivata una', 'É arrivata una nuova richiesta di ordine, ecco il riepilogo:<br/>\r\nOrdine: 12 <br/>\r\ncliente: \r\n\n                    nome: Gino <br/>\n                    cognome: Pino <br/>\n                    cellulare: 1231231231 <br/>\n                    citta: Padova <br/>\n                    via: Via della Pace numero:2 <br/>\n                    cap: 35131 <br/>\n                    provincia: PD <br/>\n                \r\nProdotti: <br/>\r\n<br/>nome: Jiraiya on Toad quantità: 1 <br/>\r\nTotale: 24.99\r\n</p>\r\n<p>\r\nPer approvare e gestire gli stati andare sulla pagina gestisci ordini. ', 'Nuovo ordine', 'ginopino@tecweb.com', 'admin@email.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `notifica_base`
--

CREATE TABLE `notifica_base` (
  `oggetto` varchar(255) NOT NULL,
  `testo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `notifica_base`
--

INSERT INTO `notifica_base` (`oggetto`, `testo`) VALUES
('Nuovo cliente', 'Wow, un nuovo cliente si è registrato. Ecco alcune informazioni utili:<br/> infoCliente'),
('Nuovo ordine', 'É arrivata una nuova richiesta di ordine, ecco il riepilogo:<br/>\r\nOrdine: numOrdine <br/>\r\ncliente: \r\ninfoCliente\r\nProdotti: <br/>\r\nlistaProdotti\r\nTotale: tot\r\n</p>\r\n<p>\r\nPer approvare e gestire gli stati andare sulla pagina gestisci ordini. '),
('Nuovo prodotto', 'Abbiamo il piacere di informarla che è stato aggiunto il nuovo prodotto exclusive: catP num nome'),
('Prodotto disponibile', 'Il prodotto catP numero nome è di nuovo disponibile'),
('Prodotto eliminato', 'Ci dispiace informarla che il prodotto catP num nome è stato rimosso dal catalogo'),
('Prodotto esaurito', 'Anche gli ultimi pop disponibili di catP num nome sono terminati.'),
('Terminato prodotto', 'Ci dispiace informarla che il prodotto catP num nome è terminato, se vuole sapere quando tornerà di nuovo disponibile si iscriva alla newsletter');

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `num` int(11) NOT NULL,
  `totale` float NOT NULL,
  `compratore` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ordine`
--

INSERT INTO `ordine` (`num`, `totale`, `compratore`) VALUES
(8, 16.99, 'plinio.folliero@email.com'),
(9, 109.96, 'ginopino@tecweb.com'),
(10, 12.99, 'ginopino@tecweb.com'),
(11, 0, 'admin@email.com'),
(12, 24.99, 'ginopino@tecweb.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `persona`
--

CREATE TABLE `persona` (
  `email` varchar(50) NOT NULL,
  `pw` varchar(100) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `cognome` varchar(25) NOT NULL,
  `cel` bigint(10) NOT NULL,
  `salt` char(4) NOT NULL,
  `provincia` char(2) NOT NULL,
  `cap` int(5) NOT NULL,
  `numero` int(4) NOT NULL,
  `via` varchar(100) NOT NULL,
  `citta` varchar(50) NOT NULL,
  `newsletter` tinyint(1) DEFAULT NULL,
  `pIva` bigint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `persona`
--

INSERT INTO `persona` (`email`, `pw`, `nome`, `cognome`, `cel`, `salt`, `provincia`, `cap`, `numero`, `via`, `citta`, `newsletter`, `pIva`) VALUES
('admin@email.com', '298a6de4f498618821fec26f0b109448', 'ADMIN', 'ADMIN', 1234567890, 'ozid', 'RN', 47837, 3, 'Via Roma', 'Riccione', 0, 12345678901),
('ginopino@tecweb.com', '36764f841a1223cba20f6927239a4655', 'Gino', 'Pino', 1231231231, 'lg9o', 'PD', 35131, 2, 'Via della Pace', 'Padova', 1, NULL),
('plinio.folliero@email.com', 'b7a30505d00142614974891db1130f0c', 'Plinio', 'Folliero', 1010101010, 'n57u', 'RM', 100, 1, 'Via Romolo I ', 'Roma', 1, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `portafoglio`
--

CREATE TABLE `portafoglio` (
  `id` int(11) NOT NULL,
  `proprietario` varchar(50) NOT NULL,
  `saldo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `portafoglio`
--

INSERT INTO `portafoglio` (`id`, `proprietario`, `saldo`) VALUES
(1, 'admin@email.com', 0),
(4, 'plinio.folliero@email.com', 3.01),
(5, 'ginopino@tecweb.com', 37.06);

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

CREATE TABLE `prodotto` (
  `catP` varchar(50) NOT NULL,
  `prezzo` float NOT NULL,
  `qt` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descr` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `catS` varchar(50) NOT NULL,
  `exclusive` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `prodotto`
--

INSERT INTO `prodotto` (`catP`, `prezzo`, `qt`, `numero`, `nome`, `descr`, `img`, `catS`, `exclusive`) VALUES
('Animation', 24.99, 9, 73, 'Jiraiya on Toad', 'Finalmente è arrivato il Pop! Esclusivo di Jiraiya on Toad! \r\nFunko Pop! Vinyl Hot Topic Exclusive, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Animation!\r\n\r\n\r\n', 'jiraiyaontoad73.jpeg', 'Naruto', 1),
('Animation', 12.99, 10, 101, 'Trafalgar Law', 'Finalmente è arrivato il Pop! di Trafalgar Law! \r\nFunko Pop! Vinyl prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Animation!\r\n', 'trafalgarlaw101.jpeg', 'One Piece', 0),
('Animation', 16.99, 10, 179, 'Kaguya Otsutsuki', 'Finalmente è arrivato il Pop! Esclusivo di Kaguya Otsutsuki! \r\nFunko Pop! Vinyl Nycc Exclusive, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Animation!\r\n', 'kaguyaotsutsuki179.jpeg', 'Naruto', 1),
('Animation', 16.99, 10, 185, 'Naruto (sage mode)', 'Finalmente è arrivato il Pop! Esclusivo di Naruto! \r\nFunko Pop! Vinyl GameStop Exclusive, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Animation!\r\n', 'naruto(sagemode)185.jpeg', 'Naruto', 1),
('Animation', 12.99, 10, 327, 'Zoro', 'Finalmente è arrivato il Pop! di Zoro! \r\nFunko Pop! Vinyl, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Animation!\r\n', 'zoro327.jpeg', 'One Piece', 0),
('Animation', 12.99, 10, 328, 'Nami', 'Finalmente è arrivato il Pop! di Nami! \r\nFunko Pop! Vinyl, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Animation!\r\n', 'nami328.jpeg', 'One Piece', 0),
('Animation', 16.99, 10, 358, 'Brook', 'Finalmente è arrivato il Pop! Esclusivo di Brook! \r\nFunko Pop! Vinyl Sdcc exclusive, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Animation!', 'brook358.jpeg', 'One Piece', 1),
('Animation', 16.99, 10, 722, 'Madara (reanimation)', 'Finalmente è arrivato il Pop! Esclusivo di Madara! \r\nFunko Pop! Vinyl GameStop Exclusive, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Animation!\r\n', 'madara(reanimation)722.jpeg', 'Naruto', 1),
('Animation', 39.99, 10, 732, 'Sasuke VS. Naruto', 'Finalmente è arrivato il Pop! di Sasuke vs. Naruto! \r\nFunko Pop! Vinyl GameStop exclusive, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Animation!\r\n', 'narutovssasuke732.jpeg', 'Naruto', 1),
('Animation', 16.99, 10, 822, 'Kakashi (Lightning Blade)', 'Finalmente è arrivato il Pop! Esclusivo di Kakashi! \r\nFunko Pop! Vinyl, GameStop Exclusive, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Animation!\r\n', 'kakashi(lightningblade)822.jpeg', 'Naruto', 1),
('Disney', 34.99, 20, 7, 'Jack Skellington & Jack House', 'Finalmente è arrivato il Pop! di Jack Skellington with Jack House! \r\nFunko Pop! Vinyl, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Disney!\r\n', 'jackskellingtonandjackshouse07.jpg', 'Nightmare Before Christmas', 0),
('Disney', 12.99, 10, 13, 'Lotso', 'Finalmente è arrivato il Pop! di Lotso! \r\nFunko Pop! Vinyl, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Disney!\r\n', 'lotso13.jpg', 'Toy Story', 0),
('Disney', 34.99, 4, 21, 'Sleeping Beauty Castle and Mickey Mouse', 'Finalmente è arrivato il Pop! di Mickey Mouse with Sleeping Beauty Castle! \r\nFunko Pop! Vinyl, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Disney!\r\n', 'sleepingbeautycastleandmickeymouse21.jpg', 'Mickey The True Original - 90 Years', 0),
('Disney', 12.99, 5, 33, 'Gru', 'Finalmente è arrivato il Pop! di Gru! \r\nFunko Pop! Vinyl, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Disney!\r\n', 'gru33.jpg', 'Despicable Me', 0),
('Disney', 12.99, 0, 34, 'Agnes', 'Finalmente è arrivato il Pop! di Agnes! \r\nFunko Pop! Vinyl, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Disney!\r\n', 'agnes34.jpg', 'Despicable Me', 0),
('Disney', 12.99, 5, 35, 'Carl', 'Finalmente è arrivato il Pop! di Carl! \r\nFunko Pop! Vinyl, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Disney!\r\n', 'carl35.jpg', 'Despicable Me', 0),
('Disney', 12.99, 5, 36, 'Dave', 'Finalmente è arrivato il Pop! di Dave! \r\nFunko Pop! Vinyl, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Disney!\r\n', 'dave36.jpg', 'Despicable Me', 0),
('Disney', 24.99, 9, 56, 'Woody with RC', 'Finalmente è arrivato il Pop! di Woody with RC!  \r\nFunko Pop! Vinyl, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Disney!\r\n\r\n', 'woodywithrc56.jpg', 'Toy Story', 0),
('Disney', 12.99, 10, 59, 'Carl', 'Finalmente è arrivato il Pop! di Carl! Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Disney!', 'Carl59.jpeg', 'Up', 0),
('Disney', 12.99, 5, 60, 'Russel', 'Finalmente è arrivato il Pop! di Russel! \r\nFunko Pop! Vinyl, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Disney!\r\n', 'russel60.jpg', 'Up', 0),
('Disney', 12.99, 20, 171, 'Rex', 'Finalmente è arrivato il Pop! di Rex! \r\nFunko Pop! Vinyl, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Disney!\r\n', 'rex171.jpg', 'Toy Story', 0),
('Disney', 12.99, 10, 428, 'Conductor Mickey', 'Finalmente è arrivato il Pop! di Mickey Mouse! \r\nFunko Pop! Vinyl, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Disney!\r\n', 'conductormickey428.jpg', 'Mickey The True Original - 90 Years', 0),
('Disney', 12.99, 10, 429, 'Brave Little Tailor', 'Finalmente è arrivato il Pop! di Mickey Mouse! \r\nFunko Pop! Vinyl, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Disney!\r\n', 'bravelittletailor429.jpg', 'Mickey The True Original - 90 Years', 0),
('Disney', 12.99, 10, 455, 'Holiday Mickey', 'Finalmente è arrivato il Pop! di Mickey Mouse! \r\nFunko Pop! Vinyl, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Disney!\r\n', 'holidaymickey455.jpg', 'Mickey The True Original - 90 Years', 0),
('Disney', 34.99, 5, 481, 'Sorcerer Mickey', 'Finalmente è arrivato il Pop! Esclusivo di Mickey Mouse! \r\nFunko Pop! Vinyl Box Lunch Exclusive, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Disney!\r\n', 'sorcerermickey481.jpg', 'Mickey The True Original - 90 Years', 1),
('Disney', 12.99, 10, 520, 'Bullseye', 'Finalmente è arrivato il Pop! di Bullseye! \r\nFunko Pop! Vinyl, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Disney!\r\n', 'bullseye520.jpg', 'Toy Story', 0),
('Disney', 16.99, 20, 525, 'Alien', 'Finalmente è arrivato il Pop! Esclusivo di Alien! \r\nFunko Pop! Vinyl FYE Exclusive, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Disney!\r\n', 'alien525.jpg', 'Toy Story', 1),
('Disney', 19.99, 20, 535, 'Sheriff Woody holding Forky', 'Finalmente è arrivato il Pop! Esclusivo di Woody with Forky! \r\nFunko Pop! Vinyl Funko Shop Exclusive, prodotto originale Funko.\r\nCompleta la tua collezione Funko Pop! Disney!\r\n', 'sheriffwoodyholdingforky535.jpg', 'Toy Story', 1),
('Games', 12.99, 5, 257, 'Aloy', 'Finalmente è arrivato il Pop! di Aloy!  Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Games!', 'aloy257.jpeg', 'Horizon', 0),
('Games', 12.99, 5, 260, 'Watcher', 'Finalmente è arrivato il Pop! di Watcher!  Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Games!', 'watcher260.jpeg', 'Horizon', 0),
('Games', 12.99, 5, 601, 'Ellie', 'Finalmente è arrivato il Pop! di Ellie!  Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Games!', 'ellie601.jpeg', 'The Last Of Us', 0),
('Games', 16.99, 5, 620, 'Joel', 'Finalmente è arrivato il Pop! di Esclusivo di Joel!  Funko Pop! Vinyl Playstation Exclusive, prodotto originale Funko. Completa la tua collezione Funko Pop! Games!', 'joel620.jpeg', 'The Last Of Us', 1),
('Movies', 34.99, 10, 15, 'Doc with Clock Tower', 'Finalmente è arrivato il Pop! di Doc with Clock Tower! \r\nFunko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Movies!', 'docwithclocktower15.jpg', 'Back To The Future', 1),
('Movies', 24.99, 8, 63, 'Witch King on Fellbeast', 'Finalmente è arrivato il Pop! di Witch King on Fellbeast! \r\nFunko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Movies!', 'witchkingonfellbeast63.jpg', 'Lord Of The Rings', 0),
('Movies', 12.99, 5, 308, 'Rowan Ghost', 'Finalmente è arrivato il Pop! di Rowan Ghost! \r\nFunko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Movies!\r\n', 'rowansghost308.jpg', 'Ghostbusters', 0),
('Movies', 12.99, 10, 444, 'Frodo Baggins', 'Finalmente è arrivato il Pop! di Frodo! \r\nFunko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Movies!', 'frodobaggins444.jpg', 'Lord Of The Rings', 0),
('Movies', 24.99, 5, 445, 'Samwise Gamgee', 'Finalmente è arrivato il Pop! di Samwise! \r\nFunko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Movies!', 'samwisegamgee445.jpg', 'Lord Of The Rings', 0),
('Movies', 16.99, 5, 449, 'Twilight Ringwraith', 'Finalmente è arrivato il Pop! Esclusivo di Twilight Ringwraith! \r\nFunko Pop! Vinyl Hot Topic Exclusive prodotto originale Funko. Completa la tua collezione Funko Pop! Movies!', 'twilightringwraith449.jpg', 'Lord Of The Rings', 1),
('Movies', 12.99, 5, 702, 'Rose', 'Finalmente è arrivato il Pop! di Rose! \r\nFunko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Movies!', 'rose705.jpg', 'Titanic', 0),
('Movies', 12.99, 5, 706, 'Jack', 'Finalmente è arrivato il Pop! di Jack! \r\nFunko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Movies!', 'jack706.jpg', 'Titanic', 0),
('Movies', 16.99, 5, 744, 'Dr. Peter Venkman', 'Finalmente è arrivato il Pop! Esclusivo di Dr. Peter Venkman! \r\nFunko Pop! Vinyl Walmart Exclusive, prodotto originale Funko. Completa la tua collezione Funko Pop! Movies! ', 'drpetervenkman744.jpg', 'Ghostbusters', 1),
('Movies', 12.99, 5, 747, 'Slimer', 'Finalmente è arrivato il Pop! di Slimer! \r\nFunko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Movies!', 'slimer747.jpg', 'Ghostbusters', 0),
('Movies', 19.99, 5, 965, 'Marty checking watch', 'Finalmente è arrivato il Pop! Esclusivo di Marty! \r\nFunko Pop! Vinyl, Funko Shop Exclusive prodotto originale Funko. Completa la tua collezione Funko Pop! Movies!', 'martycheckingwatch965.jpg', 'Back To The Future', 1),
('Rides', 35.99, 5, 68, 'Daenerys And Fiery Drogon', 'Finalmente è arrivato il Pop! di Daenerys and Drogon!  Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Rides!', 'daenerysandfierydrogon68.jpeg', 'Game of Thrones', 0),
('Rides', 35.99, 5, 86, 'Valkyrie Flight', 'Finalmente è arrivato il Pop! di Valkyrie!  Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Rides!', 'valkyriesflight86.jpeg', 'Marvel', 0),
('Rides', 35.99, 5, 167, 'Jon Snow riding Raeghal', 'Finalmente è arrivato il Pop! di Jon Snow and Raeghal!  Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Rides!', 'jonsnowridingraeghal67.jpeg', 'Game of Thrones', 0),
('Rides', 24.99, 5, 228, 'Princess Leia with speeder bike', 'Finalmente è arrivato il Pop! di Princess Leia!  Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Rides!', 'princessleiawithspeederbike228.jpeg', 'Star Wars', 0),
('Television', 12.99, 5, 250, 'Claire Randall', 'Finalmente è arrivato il Pop! di Claire Randall!  Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Television!', 'clairerandall250.jpg', 'Outlander', 0),
('Television', 12.99, 5, 251, 'Jamie Fraser', 'Finalmente è arrivato il Pop! di Jamie Fraser!  Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Television!', 'jamiefraser251.jpg', 'Outlander', 0),
('Television', 12.99, 5, 254, 'Black Jack Randall', 'Finalmente è arrivato il Pop! di Black Jack Randall!  Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Television!', 'blackjackrandall254.jpg', 'Outlander', 0),
('Television', 12.99, 5, 261, 'Rachel Green', 'Finalmente è arrivato il Pop! di Rachel Green!  Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Television!', 'rachelgreen261.jpg', 'Friends', 0),
('Television', 12.99, 5, 262, 'Ross Geller', 'Finalmente è arrivato il Pop! di Ross Geller!  Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Television! ', 'rossgeller262.jpg', 'Friends', 0),
('Television', 12.99, 5, 263, 'Monica Geller', 'Finalmente è arrivato il Pop! di Monica Geller!  Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Television! ', 'monicageller263.jpg', 'Friends', 0),
('Television', 12.99, 5, 264, 'Chandler Bing', 'Finalmente è arrivato il Pop! di Chandler Bing!  Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Television! ', 'chandlerbing264.jpg', 'Friends', 0),
('Television', 12.99, 5, 266, 'Phoebe Buffay', 'Finalmente è arrivato il Pop! di Phoebe Buffay!  Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Television! ', 'phoebebuffay266.jpg', 'Friends', 0),
('Television', 12.99, 5, 285, 'Dr. John Watson', 'Finalmente è arrivato il Pop! di  Dr. John Watson!  Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Television!', 'drjohnwatson285.jpg', 'Sherlock', 0),
('Television', 12.99, 5, 286, 'Jim Moriarty', 'Finalmente è arrivato il Pop! di Jim Moriarty!  Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Television!', 'jimmoriarty286.jpg', 'Sherlock', 0),
('Television', 12.99, 5, 287, 'Mycroft Holmes', 'Finalmente è arrivato il Pop! di Mycroft Holmes!  Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Television!', 'mycroftholmes287.jpg', 'Sherlock', 0),
('Television', 16.99, 4, 290, 'Sherlock with Skull', 'Finalmente è arrivato il Pop! Esclusivo di Sherlock!  Funko Pop! Vinyl Hot Topic Exclusive, prodotto originale Funko. Completa la tua collezione Funko Pop! Television!\r\n', 'sherlockwithskull290.jpg', 'Sherlock', 1),
('Television', 12.99, 5, 702, 'Ross Geller', 'Finalmente è arrivato il Pop! di Ross Geller!  Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Television! ', 'rossgeller702.jpg', 'Friends', 0),
('Television', 12.99, 20, 776, 'Sheldon Cooper', 'Finalmente è arrivato il Pop! di Sheldon Cooper!  Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Television! ', 'sheldoncooper776.jpg', 'The Big Bang Theory', 0),
('Television', 12.99, 5, 777, 'Howard Wolowitz In Space Suit', 'Finalmente è arrivato il Pop! di Howard Wolowitz! Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Television!', 'howardwolowitzinspacesuit777.jpg', 'The Big Bang Theory', 0),
('Television', 12.99, 5, 778, 'Leonard Hofstadter In Robe', 'Finalmente è arrivato il Pop! di Leonard Hofstadter!  \r\nFunko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Television!', 'leonardhofstadteeinrobe778.jpg', 'The Big Bang Theory', 0),
('Television', 12.99, 5, 779, 'Amy Farrah Fowler', 'Finalmente è arrivato il Pop! di Amy Farrah Fowler!  \r\nFunko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Television!', 'amyfarrahfowler779.jpg', 'The Big Bang Theory', 0),
('Television', 12.99, 5, 780, 'Penny', 'Finalmente è arrivato il Pop! di Penny!  \r\nFunko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Television!', 'penny780.jpg', 'The Big Bang Theory', 0),
('Television', 12.99, 5, 781, 'Raj Koothrappali', ' Finalmente è arrivato il Pop! di Raj Koothrappali! \r\nFunko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Television!', 'rajkoothrappali781.jpg', 'The Big Bang Theory', 0),
('Television', 12.99, 5, 1064, 'Gunther', ' Finalmente è arrivato il Pop! di Gunther! Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Television!', 'gunther1064.jpg', 'Friends', 0),
('Town', 35.99, 5, 0, 'Deku with U.A. High School', 'Finalmente è arrivato il Pop! di Deku with U.A. High School! Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Town!', 'dekuinuniformwithuahighschool.jpeg', 'Beetlejuice', 1),
('Town', 35.99, 5, 6, 'Beetlejuice with Dante Inferno room', 'Finalmente è arrivato il Pop! Esclusivo di Beetlejuice with Dante Inferno room! Funko Pop! Vinyl Hot Topic Exclusive, prodotto originale Funko. Completa la tua collezione Funko Pop! Town!', 'beetlejuicewithdanteinfernoroom06.jpeg', 'Beetlejuice', 1),
('Town', 35.99, 5, 13, 'Alfred Pennyworth with Wayne manor', 'Finalmente è arrivato il Pop! di Alfred Pennyworth with Wayne manor! Funko Pop! Vinyl, prodotto originale Funko. Completa la tua collezione Funko Pop! Town!', 'alfredpennyworthwithwaynemanor13.jpeg', 'Batman', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `ricarica`
--

CREATE TABLE `ricarica` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `importo` int(11) NOT NULL,
  `portafoglio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ricarica`
--

INSERT INTO `ricarica` (`id`, `data`, `importo`, `portafoglio`) VALUES
(1, '2021-01-25', 15, 4),
(2, '2021-01-25', 5, 4),
(3, '2021-01-25', 50, 5),
(4, '2021-01-25', 50, 5),
(5, '2021-01-25', 10, 5),
(6, '2021-01-25', 5, 5),
(7, '2021-01-25', 20, 5),
(8, '2021-01-25', 50, 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `stato`
--

CREATE TABLE `stato` (
  `id` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `stato`
--

INSERT INTO `stato` (`id`, `nome`) VALUES
(0, 'BOZZA'),
(1, 'IN ELABORAZIONE'),
(2, 'APPROVATO'),
(3, 'SPEDITO'),
(4, 'CONSEGNATO');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `avanzamento`
--
ALTER TABLE `avanzamento`
  ADD PRIMARY KEY (`stato`,`ordine`),
  ADD KEY `FKava_ORD` (`ordine`);

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`numOrdine`,`catP`,`numero`),
  ADD KEY `FKcon_PRO` (`catP`,`numero`);

--
-- Indici per le tabelle `categoria_principale`
--
ALTER TABLE `categoria_principale`
  ADD PRIMARY KEY (`titolo`);

--
-- Indici per le tabelle `categoria_specifica`
--
ALTER TABLE `categoria_specifica`
  ADD PRIMARY KEY (`titolo`),
  ADD KEY `FKsuddivisa` (`titoloP`);

--
-- Indici per le tabelle `notifica`
--
ALTER TABLE `notifica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKriceve` (`destinatario`),
  ADD KEY `FKscrive` (`mittente`),
  ADD KEY `FKdiTipo` (`oggetto`);

--
-- Indici per le tabelle `notifica_base`
--
ALTER TABLE `notifica_base`
  ADD PRIMARY KEY (`oggetto`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`num`),
  ADD KEY `FKacquisto` (`compratore`);

--
-- Indici per le tabelle `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`email`);

--
-- Indici per le tabelle `portafoglio`
--
ALTER TABLE `portafoglio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `FKpossiede_ID` (`proprietario`);

--
-- Indici per le tabelle `prodotto`
--
ALTER TABLE `prodotto`
  ADD PRIMARY KEY (`catP`,`numero`),
  ADD KEY `FKappartieneS` (`catS`);

--
-- Indici per le tabelle `ricarica`
--
ALTER TABLE `ricarica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKsu` (`portafoglio`);

--
-- Indici per le tabelle `stato`
--
ALTER TABLE `stato`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `notifica`
--
ALTER TABLE `notifica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `portafoglio`
--
ALTER TABLE `portafoglio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `ricarica`
--
ALTER TABLE `ricarica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `stato`
--
ALTER TABLE `stato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `avanzamento`
--
ALTER TABLE `avanzamento`
  ADD CONSTRAINT `FKava_ORD` FOREIGN KEY (`ordine`) REFERENCES `ordine` (`num`),
  ADD CONSTRAINT `FKava_STA` FOREIGN KEY (`stato`) REFERENCES `stato` (`id`);

--
-- Limiti per la tabella `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `FKcon_ORD` FOREIGN KEY (`numOrdine`) REFERENCES `ordine` (`num`),
  ADD CONSTRAINT `FKcon_PRO` FOREIGN KEY (`catP`,`numero`) REFERENCES `prodotto` (`catP`, `numero`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `categoria_specifica`
--
ALTER TABLE `categoria_specifica`
  ADD CONSTRAINT `FKsuddivisa` FOREIGN KEY (`titoloP`) REFERENCES `categoria_principale` (`titolo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `notifica`
--
ALTER TABLE `notifica`
  ADD CONSTRAINT `FKdiTipo` FOREIGN KEY (`oggetto`) REFERENCES `notifica_base` (`oggetto`),
  ADD CONSTRAINT `FKriceve` FOREIGN KEY (`destinatario`) REFERENCES `persona` (`email`),
  ADD CONSTRAINT `FKscrive` FOREIGN KEY (`mittente`) REFERENCES `persona` (`email`);

--
-- Limiti per la tabella `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `FKacquisto` FOREIGN KEY (`compratore`) REFERENCES `persona` (`email`);

--
-- Limiti per la tabella `portafoglio`
--
ALTER TABLE `portafoglio`
  ADD CONSTRAINT `FKpossiede_FK` FOREIGN KEY (`proprietario`) REFERENCES `persona` (`email`);

--
-- Limiti per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  ADD CONSTRAINT `FKappartieneP` FOREIGN KEY (`catP`) REFERENCES `categoria_principale` (`titolo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKappartieneS` FOREIGN KEY (`catS`) REFERENCES `categoria_specifica` (`titolo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ricarica`
--
ALTER TABLE `ricarica`
  ADD CONSTRAINT `FKsu` FOREIGN KEY (`portafoglio`) REFERENCES `portafoglio` (`id`);
