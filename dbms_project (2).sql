-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2019 at 11:35 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbms project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(15) NOT NULL,
  `Name` text NOT NULL,
  `Company_Name` text NOT NULL,
  `Password` text NOT NULL,
  `Mobile` bigint(15) NOT NULL,
  `Email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `Name`, `Company_Name`, `Password`, `Mobile`, `Email`) VALUES
('AshokBhai', 'Ashokbhai Patadiya', 'Shree Hari Gold Ornaments', 'af0dc77e04eb681f7ae6a61a6c64d7d8', 9426330371, 'Ashokshreehari30573@gmail.com'),
('MANAV', 'MANAV DHOLAKIYA', 'KALYAN JWE', '25f9e794323b453885f5181f1b624d0b', 8849973174, 'robotics439@gmail.com'),
('preet', 'Preet Maheshbhai Nagadia', 'TanishQ', '25f9e794323b453885f5181f1b624d0b', 9426818926, 'nagadiapreet@gmail.com'),
('SHUBHAM', 'SHREE HARI GOLD', '9408815175', 'f4417ac8e5c9d874c72d0394eaa6e739', 9099723420, 'shubhampatadiya007@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `C_ID` varchar(5) NOT NULL,
  `S_ID` varchar(5) NOT NULL,
  `A_ID` varchar(25) NOT NULL,
  `C_NAME` text NOT NULL,
  `C_ADDRESS` text NOT NULL,
  `BILL PENDING` double(10,2) NOT NULL DEFAULT '0.00',
  `BILL` double(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`C_ID`, `S_ID`, `A_ID`, `C_NAME`, `C_ADDRESS`, `BILL PENDING`, `BILL`) VALUES
('C001', 'S001', 'preet', 'kaushal', 'nadiad', 29400.00, 75000.00),
('C002', 'S001', 'preet', 'vivek', 'Kheda', 146809.50, 204409.50),
('C003', 'S002', 'preet', 'Bhavesh', 'Bhavnagar', 93348.00, 389050.50),
('C004', 'S003', 'preet', 'raja', 'BARUCH', 0.00, 35625.00),
('C005', 'S001', 'preet', 'ketan', 'valsad', 0.00, 0.00),
('C007', 'S002', 'preet', 'MIHIR TRIVEDI', 'Bhavnagar', 0.00, 48136.50),
('C008', 'S002', 'preet', 'HEET', 'surat', 0.00, 14905.50),
('C101', 'S101', 'AshokBhai', 'BHARGAV', 'Bhavnagar', 0.00, 50616.00);

-- --------------------------------------------------------

--
-- Table structure for table `customer_contact`
--

CREATE TABLE `customer_contact` (
  `C_ID` varchar(5) NOT NULL,
  `CONTACT1` bigint(13) DEFAULT NULL,
  `CONTACT2` bigint(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_contact`
--

INSERT INTO `customer_contact` (`C_ID`, `CONTACT1`, `CONTACT2`) VALUES
('C001', 9408815175, 7283921127),
('C002', 984561237845, 8899775512),
('C003', 9462923999, 98268136001),
('C004', 8877451296, 8857959812),
('C005', 9408815172, 7284021128),
('C007', 9462923597, 9426189265),
('C008', 9898987474, 9426189265),
('C101', 9998990111, 9998990445);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `P_ID` varchar(5) NOT NULL,
  `W_ID` varchar(5) DEFAULT NULL,
  `A_ID` varchar(25) NOT NULL,
  `P_TYPE` text NOT NULL,
  `P_WEIGHT` float(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`P_ID`, `W_ID`, `A_ID`, `P_TYPE`, `P_WEIGHT`) VALUES
('', NULL, 'preet', '', 0.00),
('P102', NULL, 'AshokBhai', 'chain', 20.00),
('P114', NULL, 'preet', 'ring', 6.50),
('P115', NULL, 'preet', 'set', 25.36),
('P116', NULL, 'preet', 'EARRINGS', 10.00),
('P117', NULL, 'preet', 'chain', 15.68),
('P118', NULL, 'preet', 'lucky', 16.00),
('P120', NULL, 'preet', 'EARRINGS', 5.23),
('P122', NULL, 'preet', 'chain', 16.89),
('P200', NULL, 'preet', 'chain', 0.00),
('P201', NULL, 'preet', 'chain', 16.00),
('P300', NULL, 'preet', 'chain', 16.89);

-- --------------------------------------------------------

--
-- Table structure for table `salesmen`
--

CREATE TABLE `salesmen` (
  `S_ID` varchar(5) NOT NULL,
  `A_ID` varchar(25) NOT NULL,
  `S_NAME` text NOT NULL,
  `S_ADDRESS` text NOT NULL,
  `S_EMAIL` text NOT NULL,
  `COMMISSION` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salesmen`
--

INSERT INTO `salesmen` (`S_ID`, `A_ID`, `S_NAME`, `S_ADDRESS`, `S_EMAIL`, `COMMISSION`) VALUES
('S001', 'preet', 'shyam', 'Surat', 's@gmail.com', 2072.99),
('S002', 'preet', 'Parytosh', 'Rajkot', 'kishan123@gmail.com', 8946.43),
('S003', 'preet', 'yash', 'Kodinar', 'b@gmail.com', 2151.71),
('S004', 'preet', 'RAJ', 'jamnagar', 'r@gmail.com', 1527.59),
('S005', 'preet', 'RAM', 'RAJASTHAN', 'RAM@gmail.com', 534.38),
('S101', 'AshokBhai', 'yash', 'Surat', 'yash@gmail.com', 759.24);

-- --------------------------------------------------------

--
-- Table structure for table `salesmen_contact`
--

CREATE TABLE `salesmen_contact` (
  `S_ID` varchar(5) NOT NULL,
  `CONTACT1` bigint(13) DEFAULT NULL,
  `CONTACT2` bigint(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salesmen_contact`
--

INSERT INTO `salesmen_contact` (`S_ID`, `CONTACT1`, `CONTACT2`) VALUES
('S001', 9898987474, 9426189265),
('S002', 7755468912, 7845961235),
('S003', 9462923597, 9426189262),
('S004', 9898987888, 9998990444),
('S005', 9426818925, 9998990445),
('S101', 7755468912, 98268136001);

-- --------------------------------------------------------

--
-- Table structure for table `supplied`
--

CREATE TABLE `supplied` (
  `S_ID` varchar(5) NOT NULL,
  `A_ID` varchar(25) NOT NULL,
  `S_NAME` text NOT NULL,
  `S_EMAIL` text NOT NULL,
  `S_ADDRESS` text NOT NULL,
  `BILL PENDING` double(10,2) NOT NULL DEFAULT '0.00',
  `BILL` double(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplied`
--

INSERT INTO `supplied` (`S_ID`, `A_ID`, `S_NAME`, `S_EMAIL`, `S_ADDRESS`, `BILL PENDING`, `BILL`) VALUES
('S001', 'preet', 'R.M JWE', 'r@gmail.com', 'nadiad', 23142.00, 68623.80),
('S002', 'preet', 'SHUBHLAXMI JWE', 'SP@gmail.com', 'Bhavnagar', 13230.00, 101839.50),
('S003', 'preet', 'D V JWE', 'DW@ gmail.com', 'surat', 0.00, 77949.90),
('S004', 'preet', 'RAJ JWE', 'RA@gmail.com', 'mahuva', 0.00, 0.00),
('S005', 'preet', 'K R SONS', 'KR@gmail.com', 'mahuva', 0.00, 0.00),
('TSL10', 'AshokBhai', 'Kishan', 'kishan123@gmail.com', 'Rajkot', 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `supplied_contact`
--

CREATE TABLE `supplied_contact` (
  `S_ID` varchar(5) NOT NULL,
  `CONTACT1` bigint(13) DEFAULT NULL,
  `CONTACT2` bigint(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplied_contact`
--

INSERT INTO `supplied_contact` (`S_ID`, `CONTACT1`, `CONTACT2`) VALUES
('S001', 9462923597, 9426189262),
('S002', 9898987878, 8945612310),
('S003', 8945612375, 9966554400),
('S004', 9462923597, 9426189262),
('S005', 9408815715, 9426330371),
('TSL10', 9898987474, 7418529630);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `S_ID` varchar(5) NOT NULL,
  `A_ID` varchar(25) NOT NULL,
  `S_NAME` text NOT NULL,
  `S_ADDRESS` text NOT NULL,
  `S_EMAIL` text NOT NULL,
  `BILL PENDING` double(10,2) NOT NULL DEFAULT '0.00',
  `BILL` double(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`S_ID`, `A_ID`, `S_NAME`, `S_ADDRESS`, `S_EMAIL`, `BILL PENDING`, `BILL`) VALUES
('BSL10', 'AshokBhai', 'JAIN CHAIN', 'Ahemdabad', 'b@gmail.com', 0.00, 62700.00),
('S001', 'preet', 'JAIN CHAIN', 'Rajkot', 'JAIN@gamil.com', 18915.00, 111555.00),
('S002', 'preet', 'SKY JWE', 'bombay', 'SK@gmail.com', 28500.00, 102297.60),
('S003', 'preet', 'ORA JWE', 'Kodinar', 'ORA@gmail.com', 47040.00, 91728.00),
('S004', 'preet', 'shyam JWE', 'Surat', 'SS@gmail.com', 0.00, 0.00),
('S005', 'preet', 'BHAGWATI JWE', 'nadiad', 'BHAG@gmail.com', 0.00, 99313.20),
('S006', 'preet', 'MEHUL JWE', 'jamnagar', 'MS@gmail.com', 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_contact`
--

CREATE TABLE `supplier_contact` (
  `S_ID` varchar(5) NOT NULL,
  `CONTACT1` bigint(13) DEFAULT NULL,
  `CONTACT2` bigint(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_contact`
--

INSERT INTO `supplier_contact` (`S_ID`, `CONTACT1`, `CONTACT2`) VALUES
('S001', 9426818925, 9426189262),
('S002', 8899663388, 0),
('S003', 9462923597, 0),
('S004', 998990446, 8877561234),
('S005', 9426330375, 9990881511),
('S006', 9408815215, 9898986806),
('BSL10', 8527419630, 9638527411);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `A_ID` varchar(25) NOT NULL,
  `S_ID` varchar(5) DEFAULT NULL,
  `TS_ID` varchar(5) DEFAULT NULL,
  `BS_ID` varchar(5) DEFAULT NULL,
  `C_ID` varchar(5) DEFAULT NULL,
  `T_DATE` date NOT NULL,
  `P_ID` varchar(5) NOT NULL,
  `P_TYPE` text,
  `P_WEIGHT` text,
  `AMOUNT` double(10,2) NOT NULL,
  `PAID` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`A_ID`, `S_ID`, `TS_ID`, `BS_ID`, `C_ID`, `T_DATE`, `P_ID`, `P_TYPE`, `P_WEIGHT`, `AMOUNT`, `PAID`) VALUES
('preet', 'S001', NULL, NULL, 'C001', '2018-10-15', 'P001', 'chain', '16.00', 45600.00, 1),
('preet', 'S001', NULL, NULL, 'C001', '2018-10-15', 'P002', 'ring', '10.00', 29400.00, 0),
('preet', 'S002', NULL, NULL, 'C002', '2018-10-15', 'P003', 'lucky', '20.00', 57600.00, 1),
('preet', 'S002', NULL, NULL, 'C002', '2018-10-15', 'P004', 'set', '50.45', 146809.50, 0),
('preet', 'S002', NULL, NULL, 'C003', '2018-10-15', 'P005', 'EARRINGS', '8.25', 23512.50, 1),
('preet', 'S003', NULL, NULL, 'C003', '2018-10-15', 'P006', 'chain', '25.45', 74823.00, 0),
('preet', 'S003', 'S001', NULL, NULL, '2018-10-15', 'P008', 'EARRINGS', '8.12', 23142.00, 0),
('preet', 'S004', 'S002', NULL, NULL, '2018-10-15', 'P009', 'chain', '30.45', 88609.50, 1),
('preet', 'S004', 'S002', NULL, NULL, '2018-10-15', 'P110', 'ring', '4.50', 13230.00, 0),
('preet', 'S002', 'S003', NULL, NULL, '2018-10-15', 'P111', 'chain', '16.89', 49149.90, 1),
('preet', 'S002', 'S003', NULL, NULL, '2018-10-15', 'P112', 'ring', '10.00', 28800.00, 1),
('preet', NULL, NULL, 'S001', NULL, '2018-10-15', 'P113', 'chain', '16.00', 47040.00, 1),
('preet', NULL, NULL, 'S002', NULL, '2018-10-15', 'P115', 'set', '25.36', 73797.60, 1),
('preet', NULL, NULL, 'S002', NULL, '2018-10-15', 'P116', 'EARRINGS', '10.00', 28500.00, 0),
('preet', NULL, NULL, 'S003', NULL, '2018-10-15', 'P117', 'chain', '15.68', 44688.00, 1),
('preet', NULL, NULL, 'S003', NULL, '2018-10-15', 'P118', 'lucky', '16', 47040.00, 0),
('preet', 'S002', NULL, NULL, 'C003', '2018-10-15', 'P119', 'set', '52.10', 148485.00, 1),
('preet', NULL, NULL, 'S005', NULL, '2018-10-15', 'P122', 'chain', '16.89', 49656.60, 1),
('preet', 'S005', NULL, NULL, 'C004', '2018-10-15', 'P121', 'chain', '12.50', 35625.00, 1),
('preet', 'S001', NULL, NULL, 'C003', '2018-10-17', 'P007', 'lucky', '15.47', 44089.50, 1),
('preet', 'S002', NULL, NULL, 'C007', '2018-10-18', 'P123', 'chain', '16.89', 48136.50, 1),
('preet', NULL, NULL, 'S001', NULL, '2018-10-31', 'P200', 'chain', '', 0.00, 0),
('preet', NULL, NULL, 'S001', NULL, '2018-10-31', 'P201', 'chain', '16.00', 45600.00, 1),
('preet', NULL, NULL, 'S005', NULL, '2018-11-11', '', '', '', 0.00, 0),
('preet', NULL, NULL, 'S005', NULL, '2018-11-11', 'P300', 'chain', '16.89', 49656.60, 1),
('AshokBhai', NULL, NULL, 'BSL10', NULL, '2019-03-14', 'P102', 'chain', '20.00', 62700.00, 1),
('AshokBhai', 'S101', NULL, NULL, 'C101', '2019-03-14', 'P101', 'chain', '16.00', 50616.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `W_ID` varchar(5) NOT NULL,
  `A_ID` varchar(25) NOT NULL,
  `W_NAME` text NOT NULL,
  `W_ADDRESS` text NOT NULL,
  `W_SALARY` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`W_ID`, `A_ID`, `W_NAME`, `W_ADDRESS`, `W_SALARY`) VALUES
('W001', 'preet', 'DIPAK', 'rajkot', 15000),
('W002', 'preet', 'VIJAY', 'BHAVNAGAR', 10000),
('W003', 'preet', 'MASKA', 'SHIHOR', 5000),
('W004', 'preet', 'DHRUV', 'AHMDABAD', 22000),
('W005', 'preet', 'SUNNY', 'nadiad', 6000),
('W101', 'AshokBhai', 'VIJAY', 'rajkot', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `workers_contact`
--

CREATE TABLE `workers_contact` (
  `W_ID` varchar(5) NOT NULL,
  `CONTACT1` bigint(13) DEFAULT NULL,
  `CONTACT2` bigint(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workers_contact`
--

INSERT INTO `workers_contact` (`W_ID`, `CONTACT1`, `CONTACT2`) VALUES
('W001', 9137414040, 9137452357),
('W002', 9512367842, 8842561378),
('W003', 7845152369, 9998527461),
('W004', 8527461390, 7946132580),
('W005', 8527413690, 9632587410),
('W101', 8140140182, 9408696944);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`C_ID`),
  ADD KEY `S_ID` (`S_ID`),
  ADD KEY `A_ID` (`A_ID`);

--
-- Indexes for table `customer_contact`
--
ALTER TABLE `customer_contact`
  ADD KEY `C_ID` (`C_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`P_ID`),
  ADD KEY `A_ID` (`A_ID`),
  ADD KEY `W_ID` (`W_ID`);

--
-- Indexes for table `salesmen`
--
ALTER TABLE `salesmen`
  ADD PRIMARY KEY (`S_ID`),
  ADD KEY `A_ID` (`A_ID`);

--
-- Indexes for table `salesmen_contact`
--
ALTER TABLE `salesmen_contact`
  ADD KEY `S_ID` (`S_ID`);

--
-- Indexes for table `supplied`
--
ALTER TABLE `supplied`
  ADD PRIMARY KEY (`S_ID`),
  ADD KEY `A_ID` (`A_ID`);

--
-- Indexes for table `supplied_contact`
--
ALTER TABLE `supplied_contact`
  ADD KEY `S_ID` (`S_ID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`S_ID`),
  ADD KEY `A_ID` (`A_ID`);

--
-- Indexes for table `supplier_contact`
--
ALTER TABLE `supplier_contact`
  ADD KEY `S_ID` (`S_ID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD KEY `C_ID` (`C_ID`),
  ADD KEY `S_ID` (`S_ID`),
  ADD KEY `A_ID` (`A_ID`),
  ADD KEY `BS_ID` (`BS_ID`),
  ADD KEY `TS_ID` (`TS_ID`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`W_ID`),
  ADD KEY `A_ID` (`A_ID`);

--
-- Indexes for table `workers_contact`
--
ALTER TABLE `workers_contact`
  ADD KEY `W_ID` (`W_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`S_ID`) REFERENCES `salesmen` (`S_ID`),
  ADD CONSTRAINT `customers_ibfk_2` FOREIGN KEY (`A_ID`) REFERENCES `admin` (`id`);

--
-- Constraints for table `customer_contact`
--
ALTER TABLE `customer_contact`
  ADD CONSTRAINT `customer_contact_ibfk_1` FOREIGN KEY (`C_ID`) REFERENCES `customers` (`C_ID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`A_ID`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`W_ID`) REFERENCES `workers` (`W_ID`);

--
-- Constraints for table `salesmen`
--
ALTER TABLE `salesmen`
  ADD CONSTRAINT `salesmen_ibfk_1` FOREIGN KEY (`A_ID`) REFERENCES `admin` (`id`);

--
-- Constraints for table `salesmen_contact`
--
ALTER TABLE `salesmen_contact`
  ADD CONSTRAINT `salesmen_contact_ibfk_1` FOREIGN KEY (`S_ID`) REFERENCES `salesmen` (`S_ID`);

--
-- Constraints for table `supplied`
--
ALTER TABLE `supplied`
  ADD CONSTRAINT `supplied_ibfk_1` FOREIGN KEY (`A_ID`) REFERENCES `admin` (`id`);

--
-- Constraints for table `supplied_contact`
--
ALTER TABLE `supplied_contact`
  ADD CONSTRAINT `supplied_contact_ibfk_1` FOREIGN KEY (`S_ID`) REFERENCES `supplied` (`S_ID`);

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`A_ID`) REFERENCES `admin` (`id`);

--
-- Constraints for table `supplier_contact`
--
ALTER TABLE `supplier_contact`
  ADD CONSTRAINT `supplier_contact_ibfk_1` FOREIGN KEY (`S_ID`) REFERENCES `supplier` (`S_ID`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`C_ID`) REFERENCES `customers` (`C_ID`),
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`S_ID`) REFERENCES `salesmen` (`S_ID`),
  ADD CONSTRAINT `transaction_ibfk_4` FOREIGN KEY (`A_ID`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `transaction_ibfk_5` FOREIGN KEY (`BS_ID`) REFERENCES `supplier` (`S_ID`),
  ADD CONSTRAINT `transaction_ibfk_6` FOREIGN KEY (`TS_ID`) REFERENCES `supplied` (`S_ID`);

--
-- Constraints for table `workers`
--
ALTER TABLE `workers`
  ADD CONSTRAINT `workers_ibfk_1` FOREIGN KEY (`A_ID`) REFERENCES `admin` (`id`);

--
-- Constraints for table `workers_contact`
--
ALTER TABLE `workers_contact`
  ADD CONSTRAINT `workers_contact_ibfk_1` FOREIGN KEY (`W_ID`) REFERENCES `workers` (`W_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
