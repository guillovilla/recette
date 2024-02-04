-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2024 at 12:12 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recete`
--

-- --------------------------------------------------------

--
-- Table structure for table `recete`
--

CREATE TABLE `recete` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `ingrediants` text NOT NULL,
  `preparation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recete`
--

INSERT INTO `recete` (`id`, `nom`, `description`, `ingrediants`, `preparation`) VALUES
(1, 'CRÊPES', 'Les crêpes, délicieuses et faciles à préparer, sont des disques minces et moelleux parfaits pour le petit-déjeuner ou le dessert. Pour concocter ces friandises, mélangez simplement de la farine avec des œufs, du lait, une pincée de sel et un soupçon de sucre. Fouettez la pâte jusqu\'à obtenir une consistance lisse, puis versez-la dans une poêle chaude et légèrement beurrée. Faites cuire chaque côté jusqu\'à ce qu\'il soit doré. Garnissez de votre choix : sirop d\'érable, sucre, Nutella, fruits frais, ou crème chantilly. Savourez ces crêpes pour une expérience gourmande et réconfortante !', '250 g  de farine / Un demi litre de lait / 2 œufs  / Une cuillérée à soupe d´huile / Une pincée de sel. / Un zeste de citron.', '1)	Mets la farine dans un grand bol. ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recete`
--
ALTER TABLE `recete`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recete`
--
ALTER TABLE `recete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
