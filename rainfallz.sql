-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2023 at 08:12 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rainfallz`
--

-- --------------------------------------------------------

--
-- Table structure for table `climate`
--

CREATE TABLE `climate` (
  `id` int(255) NOT NULL,
  `period` varchar(255) NOT NULL,
  `temperature` decimal(65,2) NOT NULL,
  `air_pressure` decimal(65,2) NOT NULL,
  `humidity` decimal(65,2) NOT NULL,
  `wind_velocity` decimal(65,2) NOT NULL,
  `rainfall` decimal(65,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `climate`
--

INSERT INTO `climate` (`id`, `period`, `temperature`, `air_pressure`, `humidity`, `wind_velocity`, `rainfall`) VALUES
(1, 'January 2018', '27.10', '1008.40', '86.00', '4.00', '326.00'),
(2, 'February 2018', '26.50', '1010.80', '89.00', '4.00', '311.00'),
(3, 'March 2018', '26.80', '1009.70', '88.00', '3.00', '317.00'),
(4, 'April 2018', '27.60', '1009.20', '87.00', '3.00', '302.00'),
(5, 'May 2018', '27.60', '1009.90', '87.00', '3.00', '262.00'),
(6, 'June 2018', '27.80', '1010.20', '87.00', '4.00', '113.00'),
(7, 'July 2018', '27.70', '1010.60', '86.00', '4.00', '68.00'),
(8, 'August 2018', '27.90', '1010.60', '85.00', '4.00', '52.00'),
(9, 'September 2018', '27.60', '1011.50', '85.00', '4.00', '131.00'),
(10, 'October 2018', '28.10', '1011.00', '88.00', '4.00', '138.00'),
(11, 'November 2018', '27.50', '1010.60', '91.00', '3.00', '244.00'),
(12, 'December 2018', '27.40', '1010.20', '91.00', '3.00', '231.00'),
(13, 'January 2019', '23.20', '1010.81', '71.00', '4.40', '176.00'),
(14, 'February 2019', '23.20', '1011.64', '60.00', '3.41', '307.40'),
(15, 'March 2019', '22.10', '1010.58', '66.00', '3.81', '251.00'),
(16, 'April 2019', '22.80', '1009.90', '68.00', '3.14', '349.50'),
(17, 'May 2019', '24.20', '1010.09', '65.00', '3.51', '166.90'),
(18, 'June 2019', '23.00', '1009.83', '63.00', '3.56', '143.00'),
(19, 'July 2019', '23.00', '1010.85', '55.00', '4.02', '96.00'),
(20, 'August 2019', '22.40', '1011.25', '49.00', '4.85', '40.00'),
(21, 'September 2019', '22.00', '1012.02', '44.00', '4.89', '64.90'),
(22, 'October 2019', '22.80', '1010.52', '45.00', '4.50', '75.90'),
(23, 'November 2019', '23.60', '1010.39', '45.00', '3.20', '153.00'),
(24, 'December 2019', '22.40', '1010.29', '60.00', '3.90', '242.20'),
(25, 'January 2020', '23.00', '1010.43', '57.00', '4.02', '286.00'),
(26, 'February 2020', '23.00', '1010.90', '62.00', '4.30', '298.50'),
(27, 'March 2020', '22.40', '1010.10', '59.00', '3.62', '367.90'),
(28, 'April 2020', '22.80', '1010.30', '60.00', '3.10', '396.50'),
(29, 'May 2020', '22.80', '1009.20', '73.00', '3.33', '264.70'),
(30, 'June 2020', '22.00', '1009.70', '59.00', '3.50', '188.00'),
(31, 'July 2020', '23.20', '1009.10', '64.00', '3.56', '126.00'),
(32, 'August 2020', '23.00', '1009.70', '51.00', '4.30', '48.60'),
(33, 'September 2020', '22.60', '1009.90', '54.00', '3.90', '152.00'),
(34, 'October 2020', '21.60', '1009.50', '55.00', '3.26', '251.10'),
(35, 'November 2020', '22.80', '1009.90', '55.00', '3.00', '333.60'),
(36, 'December 2020', '22.00', '1009.10', '58.00', '3.44', '228.00'),
(37, 'January 2021', '27.70', '1008.30', '82.10', '3.90', '235.70'),
(38, 'February 2021', '28.20', '1008.90', '80.90', '4.10', '181.40'),
(39, 'March 2021', '28.80', '1008.30', '78.50', '2.80', '251.90'),
(40, 'April 2021', '29.20', '1008.90', '77.30', '2.30', '127.60'),
(41, 'May 2021', '29.80', '1007.70', '77.70', '2.40', '144.80'),
(42, 'June 2021', '29.80', '1009.00', '74.40', '2.80', '60.00'),
(43, 'July 2021', '29.50', '1008.70', '73.40', '3.30', '124.70'),
(44, 'August 2021', '28.80', '1009.30', '77.40', '3.10', '183.00'),
(45, 'September 2021', '29.20', '1008.70', '78.90', '3.00', '229.00'),
(46, 'October 2021', '30.10', '1008.40', '78.30', '2.80', '118.10'),
(47, 'November 2021', '28.90', '1007.40', '80.50', '2.00', '421.40'),
(48, 'December 2021', '28.80', '1009.10', '83.30', '3.00', '285.50'),
(49, 'January 2022', '27.30', '1010.40', '87.00', '2.00', '241.00'),
(50, 'February 2022', '27.50', '1009.10', '86.00', '2.00', '155.00'),
(51, 'March 2022', '28.10', '1008.80', '86.00', '2.00', '192.00'),
(52, 'April 2022', '28.40', '1009.00', '87.00', '3.00', '589.00'),
(53, 'May 2022', '28.50', '1008.70', '85.00', '4.00', '117.00'),
(54, 'June 2022', '27.50', '1009.00', '86.00', '2.00', '247.00'),
(55, 'July 2022', '27.70', '1009.90', '80.00', '4.00', '52.00'),
(56, 'August 2022', '27.50', '1009.30', '84.00', '4.00', '107.00'),
(57, 'September 2022', '27.60', '1010.40', '86.00', '5.00', '180.00'),
(58, 'October 2022', '27.40', '1010.10', '88.00', '5.00', '477.00'),
(59, 'November 2022', '28.10', '1009.40', '88.00', '3.00', '211.00'),
(60, 'December 2022', '27.40', '1008.00', '88.00', '3.00', '266.00');

-- --------------------------------------------------------

--
-- Table structure for table `forecasting_history`
--

CREATE TABLE `forecasting_history` (
  `id` int(100) NOT NULL,
  `forecasting_date` varchar(100) NOT NULL,
  `method` varchar(100) NOT NULL,
  `temperature` decimal(65,2) NOT NULL,
  `air_pressure` decimal(65,2) NOT NULL,
  `humidity` decimal(65,2) NOT NULL,
  `wind_velocity` decimal(65,2) NOT NULL,
  `prediction_result` decimal(65,2) NOT NULL,
  `error_rate` decimal(65,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forecasting_history`
--

INSERT INTO `forecasting_history` (`id`, `forecasting_date`, `method`, `temperature`, `air_pressure`, `humidity`, `wind_velocity`, `prediction_result`, `error_rate`) VALUES
(1, '13 February 2023', 'FIS Tsukamoto', '22.40', '1010.29', '60.00', '3.90', '190.70', '100.55'),
(2, '13 February 2023', 'FIS Tsukamoto & Artificial Bee Colony', '22.40', '1010.29', '60.00', '3.90', '105.44', '74.23'),
(3, '13 February 2023', 'FIS Tsukamoto & Artificial Bee Colony', '22.40', '1010.29', '60.00', '3.90', '261.65', '70.49'),
(4, '19 February 2023', 'FIS Tsukamoto', '22.40', '1011.25', '49.00', '4.85', '188.80', '122.96'),
(5, '19 February 2023', 'FIS Tsukamoto & Artificial Bee Colony', '22.40', '1011.25', '49.00', '4.85', '99.97', '75.77'),
(6, '19 February 2023', 'FIS Tsukamoto & Artificial Bee Colony', '22.40', '1010.29', '60.00', '3.90', '249.25', '71.83'),
(7, '04 March 2023', 'FIS Tsukamoto', '22.40', '1010.29', '60.00', '3.90', '270.48', '60.15');

-- --------------------------------------------------------

--
-- Table structure for table `rule`
--

CREATE TABLE `rule` (
  `id` int(100) NOT NULL,
  `temperature` varchar(100) NOT NULL,
  `humidity` varchar(100) NOT NULL,
  `air_pressure` varchar(100) NOT NULL,
  `wind_velocity` varchar(100) NOT NULL,
  `rainfall` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rule`
--

INSERT INTO `rule` (`id`, `temperature`, `humidity`, `air_pressure`, `wind_velocity`, `rainfall`) VALUES
(1, 'cold', 'moist', 'low', 'calm', 'rain'),
(2, 'cold', 'moist', 'low', 'strong', 'rain'),
(3, 'cold', 'moist', 'low', 'veryStrong', 'rain'),
(4, 'cold', 'moist', 'medium', 'calm', 'rain'),
(5, 'cold', 'moist', 'medium', 'strong', 'rain'),
(6, 'cold', 'moist', 'medium', 'veryStrong', 'rain'),
(7, 'cold', 'moist', 'high', 'calm', 'rain'),
(8, 'cold', 'moist', 'high', 'strong', 'rain'),
(9, 'cold', 'moist', 'high', 'veryStrong', 'light rain'),
(10, 'cold', 'wet', 'low', 'calm', 'rain'),
(11, 'cold', 'wet', 'low', 'strong', 'rain'),
(12, 'cold', 'wet', 'low', 'veryStrong', 'rain'),
(13, 'cold', 'wet', 'medium', 'calm', 'rain'),
(14, 'cold', 'wet', 'medium', 'strong', 'cloudy'),
(15, 'cold', 'wet', 'medium', 'veryStrong', 'cloudy'),
(16, 'cold', 'wet', 'high', 'calm', 'rain'),
(17, 'cold', 'wet', 'high', 'strong', 'cloudy'),
(18, 'cold', 'wet', 'high', 'veryStrong', 'light rain'),
(19, 'cold', 'dry', 'low', 'calm', 'rain'),
(20, 'cold', 'dry', 'low', 'strong', 'light rain'),
(21, 'cold', 'dry', 'low', 'veryStrong', 'light rain'),
(22, 'cold', 'dry', 'medium', 'calm', 'light rain'),
(23, 'cold', 'dry', 'medium', 'strong', 'cloudy'),
(24, 'cold', 'dry', 'medium', 'veryStrong', 'sunny'),
(25, 'cold', 'dry', 'high', 'calm', 'light rain'),
(26, 'cold', 'dry', 'high', 'strong', 'light rain'),
(27, 'cold', 'dry', 'high', 'veryStrong', 'sunny'),
(28, 'warm', 'moist', 'low', 'calm', 'rain'),
(29, 'warm', 'moist', 'low', 'strong', 'rain'),
(30, 'warm', 'moist', 'low', 'veryStrong', 'light rain'),
(31, 'warm', 'moist', 'medium', 'calm', 'rain'),
(32, 'warm', 'moist', 'medium', 'strong', 'cloudy'),
(33, 'warm', 'moist', 'medium', 'veryStrong', 'cloudy'),
(34, 'warm', 'moist', 'high', 'calm', 'light rain'),
(35, 'warm', 'moist', 'high', 'strong', 'cloudy'),
(36, 'warm', 'moist', 'high', 'veryStrong', 'sunny'),
(37, 'warm', 'wet', 'low', 'calm', 'rain'),
(38, 'warm', 'wet', 'low', 'strong', 'light rain'),
(39, 'warm', 'wet', 'low', 'veryStrong', 'cloudy'),
(40, 'warm', 'wet', 'medium', 'calm', 'cloudy'),
(41, 'warm', 'wet', 'medium', 'strong', 'cloudy'),
(42, 'warm', 'wet', 'medium', 'veryStrong', 'cloudy'),
(43, 'warm', 'wet', 'high', 'calm', 'cloudy'),
(44, 'warm', 'wet', 'high', 'strong', 'cloudy'),
(45, 'warm', 'wet', 'high', 'veryStrong', 'sunny'),
(46, 'warm', 'dry', 'low', 'calm', 'light rain'),
(47, 'warm', 'dry', 'low', 'strong', 'cloudy'),
(48, 'warm', 'dry', 'low', 'veryStrong', 'sunny'),
(49, 'warm', 'dry', 'medium', 'calm', 'cloudy'),
(50, 'warm', 'dry', 'medium', 'strong', 'cloudy'),
(51, 'warm', 'dry', 'medium', 'veryStrong', 'sunny'),
(52, 'warm', 'dry', 'high', 'calm', 'sunny'),
(53, 'warm', 'dry', 'high', 'strong', 'cloudy'),
(54, 'warm', 'dry', 'high', 'veryStrong', 'sunny'),
(55, 'hot', 'moist', 'low', 'calm', 'rain'),
(56, 'hot', 'moist', 'low', 'strong', 'light rain'),
(57, 'hot', 'moist', 'low', 'veryStrong', 'cloudy'),
(58, 'hot', 'moist', 'medium', 'calm', 'light rain'),
(59, 'hot', 'moist', 'medium', 'strong', 'cloudy'),
(60, 'hot', 'moist', 'medium', 'veryStrong', 'sunny'),
(61, 'hot', 'moist', 'high', 'calm', 'sunny'),
(62, 'hot', 'moist', 'high', 'strong', 'sunny'),
(63, 'hot', 'moist', 'high', 'veryStrong', 'sunny'),
(64, 'hot', 'wet', 'low', 'calm', 'cloudy'),
(65, 'hot', 'wet', 'low', 'strong', 'cloudy'),
(66, 'hot', 'wet', 'low', 'veryStrong', 'sunny'),
(67, 'hot', 'wet', 'medium', 'calm', 'cloudy'),
(68, 'hot', 'wet', 'medium', 'strong', 'sunny'),
(69, 'hot', 'wet', 'medium', 'veryStrong', 'cloudy'),
(70, 'hot', 'wet', 'high', 'calm', 'sunny'),
(71, 'hot', 'wet', 'high', 'strong', 'sunny'),
(72, 'hot', 'wet', 'high', 'veryStrong', 'sunny'),
(73, 'hot', 'dry', 'low', 'calm', 'cloudy'),
(74, 'hot', 'dry', 'low', 'strong', 'sunny'),
(75, 'hot', 'dry', 'low', 'veryStrong', 'sunny'),
(76, 'hot', 'dry', 'medium', 'calm', 'sunny'),
(77, 'hot', 'dry', 'medium', 'strong', 'sunny'),
(78, 'hot', 'dry', 'medium', 'veryStrong', 'sunny'),
(79, 'hot', 'dry', 'high', 'calm', 'sunny'),
(80, 'hot', 'dry', 'high', 'strong', 'sunny'),
(81, 'hot', 'dry', 'high', 'veryStrong', 'sunny');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `climate`
--
ALTER TABLE `climate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forecasting_history`
--
ALTER TABLE `forecasting_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rule`
--
ALTER TABLE `rule`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `climate`
--
ALTER TABLE `climate`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `forecasting_history`
--
ALTER TABLE `forecasting_history`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rule`
--
ALTER TABLE `rule`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
