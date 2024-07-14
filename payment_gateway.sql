-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2024 at 07:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payment_gateway`
--

-- --------------------------------------------------------

--
-- Table structure for table `bharatpe_tokens`
--

CREATE TABLE `bharatpe_tokens` (
  `id` int(11) NOT NULL,
  `user_token` longtext DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `cookie` varchar(255) DEFAULT NULL,
  `merchantId` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) DEFAULT 'Deactive',
  `Upiid` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `callback_report`
--

CREATE TABLE `callback_report` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `request_url` longtext NOT NULL,
  `response` longtext NOT NULL,
  `user_token` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc`
--

CREATE TABLE `hdfc` (
  `id` int(11) NOT NULL,
  `number` varchar(255) NOT NULL,
  `seassion` varchar(255) NOT NULL,
  `device_id` varchar(255) NOT NULL,
  `user_token` varchar(255) NOT NULL,
  `pin` varchar(255) NOT NULL,
  `upi_hdfc` varchar(255) NOT NULL,
  `UPI` varchar(255) NOT NULL,
  `tidlist` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` mediumtext NOT NULL,
  `user_token` longtext NOT NULL,
  `status` text NOT NULL,
  `amount` int(11) NOT NULL,
  `utr` longtext NOT NULL,
  `plan_id` longtext NOT NULL,
  `customer_name` longtext NOT NULL,
  `customer_mobile` longtext NOT NULL,
  `redirect_url` longtext NOT NULL,
  `remark1` longtext NOT NULL,
  `remark2` longtext NOT NULL,
  `gateway_txn` longtext NOT NULL,
  `method` text NOT NULL,
  `HDFC_TXNID` mediumtext NOT NULL,
  `upiLink` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `byteTransactionId` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `paytm_txn_ref` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_links`
--

CREATE TABLE `payment_links` (
  `id` int(11) NOT NULL,
  `link_token` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paytm_tokens`
--

CREATE TABLE `paytm_tokens` (
  `id` int(11) NOT NULL,
  `user_token` longtext NOT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `MID` varchar(255) DEFAULT NULL,
  `Upiid` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) DEFAULT 'Deactive',
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phonepe_tokens`
--

CREATE TABLE `phonepe_tokens` (
  `sl` int(11) NOT NULL,
  `user_token` longtext NOT NULL,
  `phoneNumber` longtext NOT NULL,
  `userId` longtext NOT NULL,
  `token` longtext NOT NULL,
  `refreshToken` longtext NOT NULL,
  `name` text NOT NULL,
  `device_data` longtext NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Deactive',
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `transactionId` mediumtext NOT NULL,
  `status` mediumtext NOT NULL,
  `order_id` mediumtext NOT NULL,
  `vpa` mediumtext NOT NULL,
  `paymentApp` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `user_token` mediumtext NOT NULL,
  `UTR` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `mobile` varchar(255) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `merchantTransactionId` varchar(255) DEFAULT NULL,
  `transactionNote` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_id`
--

CREATE TABLE `store_id` (
  `sl` int(11) NOT NULL,
  `user_token` longtext NOT NULL,
  `unitId` longtext NOT NULL,
  `roleName` longtext NOT NULL,
  `groupValue` longtext NOT NULL,
  `groupId` longtext NOT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `url_shortener`
--

CREATE TABLE `url_shortener` (
  `original_url` varchar(5000) NOT NULL,
  `short_code` varchar(500) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `role` enum('User','Admin','','') NOT NULL DEFAULT 'User',
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `pin` varchar(255) NOT NULL,
  `pan` varchar(255) NOT NULL,
  `aadhaar` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `user_token` varchar(255) NOT NULL,
  `expiry` date NOT NULL,
  `callback_url` longtext NOT NULL,
  `bptoken` longtext NOT NULL,
  `upiid` longtext NOT NULL,
  `acc_lock` int(11) NOT NULL DEFAULT 0,
  `acc_ban` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'off',
  `upi_id` mediumtext DEFAULT NULL COMMENT 'This is the UPI ID for PhonePe',
  `phonepe_connected` varchar(3) DEFAULT 'No',
  `hdfc_connected` varchar(3) DEFAULT 'No',
  `paytm_connected` varchar(3) DEFAULT 'No',
  `bharatpe_connected` varchar(3) DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `role`, `password`, `email`, `company`, `pin`, `pan`, `aadhaar`, `location`, `user_token`, `expiry`, `callback_url`, `bptoken`, `upiid`, `acc_lock`, `acc_ban`, `upi_id`, `phonepe_connected`, `hdfc_connected`, `paytm_connected`, `bharatpe_connected`) VALUES
(28, 'Compu-Tech', '1234567890', 'Admin', '$2y$12$cLUd0ceOsccInJGQeqUYnu4yd9TaCWuQ1H5ezO7sy9bYSOI7BssJC', 'admin@gmail.com', 'Compu-Tech', '335001', 'KLDPS7898J', '124545478554', 'india ', 'e8d2a2f1ac98d41d3b7422fd11ab98fa', '2027-12-22', 'https://qr.webupipay.online', '', '', 0, 'off', NULL, 'No', 'No', 'No', 'No');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bharatpe_tokens`
--
ALTER TABLE `bharatpe_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `callback_report`
--
ALTER TABLE `callback_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hdfc`
--
ALTER TABLE `hdfc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_links`
--
ALTER TABLE `payment_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paytm_tokens`
--
ALTER TABLE `paytm_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phonepe_tokens`
--
ALTER TABLE `phonepe_tokens`
  ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `merchantTransactionId` (`merchantTransactionId`);

--
-- Indexes for table `store_id`
--
ALTER TABLE `store_id`
  ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `url_shortener`
--
ALTER TABLE `url_shortener`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bharatpe_tokens`
--
ALTER TABLE `bharatpe_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `callback_report`
--
ALTER TABLE `callback_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hdfc`
--
ALTER TABLE `hdfc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_links`
--
ALTER TABLE `payment_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paytm_tokens`
--
ALTER TABLE `paytm_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phonepe_tokens`
--
ALTER TABLE `phonepe_tokens`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_id`
--
ALTER TABLE `store_id`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `url_shortener`
--
ALTER TABLE `url_shortener`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
