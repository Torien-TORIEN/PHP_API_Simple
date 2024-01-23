-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 23 jan. 2024 à 23:45
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `php_api`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(80) NOT NULL,
  `email` varchar(30) NOT NULL,
  `date_of_birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `date_of_birth`) VALUES
(10, 'Marie', '$2y$10$hiVPyTpHvsQ906DME9ZPw.1rXi8J4e9n4EKrOoZTYaDGzLqJP88LG', 'marie@gmail.com', '1999-12-31'),
(11, 'TOTO', '$2y$10$6J99gWRP/xzbrsr0LBQuHO0VJSNtSvidD8jwpI0AOHetDPNG8hj2S', 'toto@gmail.com', '1999-05-24'),
(12, 'TORIEN', '$2y$10$2SH56gwnLrEt7tninGpNWOrCBuDXduqcMitBTDhVpcj2981A2PXPK', 'torien1227@gmail.com', '1999-05-24'),
(13, 'TATA', '$2y$10$zIVy.wfwWsd6kpKH9HZ0me2Cui.CEQgvTSEbK7ShUcdkUBTxgnW8K', 'tata@gmail.com', '2003-09-06');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
