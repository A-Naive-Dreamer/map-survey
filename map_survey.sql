-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2018 at 02:50 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `map_survey`
--

-- --------------------------------------------------------

--
-- Table structure for table `city_list`
--

CREATE TABLE `city_list` (
  `id` int(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city_list`
--

INSERT INTO `city_list` (`id`, `city`, `latitude`, `longitude`) VALUES
(10, 'Medan', 3.784303, 98.694221),
(11, 'Palangka Raya', -2.2136, 113.9108),
(12, 'Jakarta', -6.121435, 106.774124),
(13, 'Padang', -0.94924, 100.35427),
(14, 'Surabaya', -7.250445, 112.768845),
(15, 'Semarang', -6.966667, 110.416664),
(16, 'Bandung', -6.90389, 107.61861),
(21, 'Banjarmasin', -3.316694, 114.59),
(22, 'Samarinda', -0.502106, 117.153709),
(23, 'pontianak', 0, 109.333336),
(24, 'Yogyakarta', -7.797068, 110.370529),
(25, 'Makassar', -5.147665, 119.432),
(26, 'Manado', 1.47483, 124.842079);

-- --------------------------------------------------------

--
-- Table structure for table `survey_data`
--

CREATE TABLE `survey_data` (
  `field_name` varchar(50) NOT NULL,
  `field_value` varchar(50) NOT NULL,
  `city_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_data`
--

INSERT INTO `survey_data` (`field_name`, `field_value`, `city_id`) VALUES
('Jumlah Penduduk', '200.000 Jiwa', 12),
('Luas', '400.000 km', 12),
('Tahun Lahir', '1600', 12),
('Luas', '350.000 km', 10),
('Tahun Lahir', '1800', 10),
('Jumlah Penduduk', '50.000 Jiwa', 11),
('Tahun Lahir', '1968', 11),
('Luas', '600.000 km', 11),
('Jumlah Penduduk', '100.000 Jiwa', 13),
('Tahun Lahir', '1900', 13),
('Luas', '300.000 km', 13),
('Nama Ibukota', 'HA', 12),
('Jumlah Penduduk', '140.000 Jiwa', 10),
('Jumlah Penduduk', '90.000 Jiwa', 16),
('Luas', '400.000 km', 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city_list`
--
ALTER TABLE `city_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_data`
--
ALTER TABLE `survey_data`
  ADD KEY `city_id` (`city_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city_list`
--
ALTER TABLE `city_list`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `survey_data`
--
ALTER TABLE `survey_data`
  ADD CONSTRAINT `survey_data_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city_list` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
