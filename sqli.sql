-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 12, 2024 at 06:50 AM
-- Server version: 10.11.8-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u759718842_qrpay`
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

--
-- Dumping data for table `bharatpe_tokens`
--

INSERT INTO `bharatpe_tokens` (`id`, `user_token`, `phoneNumber`, `token`, `cookie`, `merchantId`, `created_at`, `date`, `status`, `Upiid`, `user_id`) VALUES
(11, 'c6ee6a2e878b7966fc3dbdf32c7f9841', '9450000481', '', '', '', '2024-07-09 23:29:45', '2024-07-09 23:29:45', 'Deactive', NULL, NULL);

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

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user_token`, `status`, `amount`, `utr`, `plan_id`, `customer_name`, `customer_mobile`, `redirect_url`, `remark1`, `remark2`, `gateway_txn`, `method`, `HDFC_TXNID`, `upiLink`, `description`, `byteTransactionId`, `create_date`, `paytm_txn_ref`, `user_id`) VALUES
(50, 'QRPAY79056', '1ae0b12c53a3223c9ab631f71744bcea', 'FAILED', 10, '', '', '', '7029181219', 'https://qr.webupipay.online/pay/callback.php', 'Online Payment Request', 'QR PAY', '667430b25e4e9', 'PhonePe', '', '', '', 'COMPU17731718890674', '2024-06-20 19:07:54', NULL, 26),
(51, 'QRPAY68742', '1ae0b12c53a3223c9ab631f71744bcea', 'FAILED', 1, '', '', '', '9641763445', 'https://qr.webupipay.online/pay/callback.php', 'Online Payment Request', 'QR PAY', '6674315263e27', 'PhonePe', '', '', '', 'COMPU21731718890834', '2024-06-20 19:10:34', NULL, 26),
(52, 'QRPAY29893', '1ae0b12c53a3223c9ab631f71744bcea', 'SUCCESS', 1, '453811737880', '', '', '9641763445', 'https://qr.webupipay.online/pay/callback.php', 'Online Payment Request', 'QR PAY', '6674325e6db60', 'PhonePe', '', '', '', 'COMPU82151718891012', '2024-06-20 19:13:32', '1', 26),
(53, 'QRPAY54434', '1ae0b12c53a3223c9ab631f71744bcea', 'SUCCESS', 1, '453846084563', '', '', '7029181219', 'https://qr.webupipay.online/pay/callback.php', 'Online Payment Request', 'QR PAY', '66743285100da', 'Paytm', '', '', '', 'COMPU61511718891141', '2024-06-20 19:15:41', '2J2RrCdFTx1718891141', 26),
(54, 'QRPAY35929', '1ae0b12c53a3223c9ab631f71744bcea', 'FAILED', 1, '', '', '', '7029879877', 'https://qr.webupipay.online/pay/callback.php', 'Online Payment Request', 'QR PAY', '6674332ade2f5', 'Paytm', '', '', '', 'COMPU50841718891306', '2024-06-20 19:18:26', 'EfiVWvx2pe1718891306', 26),
(55, 'QRPAY68109', '1ae0b12c53a3223c9ab631f71744bcea', 'FAILED', 1, '', '', '', '918391938489', 'https://qr.webupipay.online/pay/callback.php', 'Online Payment Request', 'QR PAY', '6674337ec8584', 'Paytm', '', '', '', 'COMPU48251718891390', '2024-06-20 19:19:50', 'Qq8bZXeDhT1718891390', 26),
(56, 'QRPAY75526', '1ae0b12c53a3223c9ab631f71744bcea', 'SUCCESS', 10, '453849387688', '', '', '917029181219', 'https://qr.webupipay.online/pay/callback.php', 'Online Payment Request', 'QR PAY', '667436fedea34', 'Paytm', '', '', '', 'COMPU41891718892286', '2024-06-20 19:34:46', 'y1fahAdNuH1718892286', 26),
(57, 'QRPAY91463', '1ae0b12c53a3223c9ab631f71744bcea', 'SUCCESS', 1, '417234272145', '', '', '7029181219', 'https://qr.webupipay.online', 'Online Payment Request', 'QR PAY', '667437e4c4fa8', 'Paytm', '', '', '', 'COMPU57481718892516', '2024-06-20 19:38:36', 'A8RSaywQGZ1718892516', 26),
(58, 'QRPAY81707', '1ae0b12c53a3223c9ab631f71744bcea', 'SUCCESS', 1, '417234840754', '', '', '7029181219', 'https://qr.webupipay.online', 'Online Payment Request', 'QR PAY', '6674395d227de', 'Paytm', '', '', '', 'COMPU28851718892893', '2024-06-20 19:44:53', 'frcX5UNXZn1718892893', 26),
(59, 'QRPAY26717', '1ae0b12c53a3223c9ab631f71744bcea', 'SUCCESS', 1, '417219742605', '', '', '7029181219', 'https://qr.webupipay.online', 'Online Payment Request', 'QR PAY', '66743b45e6a88', 'PhonePe', '', '', '', 'COMPU79591718893280', '2024-06-20 19:51:20', '1', 26),
(60, 'QRPAY21085', '1ae0b12c53a3223c9ab631f71744bcea', 'SUCCESS', 10, '417235596196', '', '', '7029181219', 'https://qr.webupipay.online', 'Online Payment Request', 'QR PAY', '66743b7a55275', 'Paytm', '', '', '', 'COMPU48811718893434', '2024-06-20 19:53:54', 'kdiK8eXE8Z1718893434', 26),
(61, 'QRPAY46290', '1ae0b12c53a3223c9ab631f71744bcea', 'FAILED', 1, '', '', '', '7029181219', 'https://qr.webupipay.online', 'Online Payment Request', 'QR PAY', '667be010daa49', 'Paytm', '', '', '', 'COMPU79421719394320', '2024-06-26 15:02:00', 'XGi7lKCXPn1719394320', 26),
(62, 'QRPAY12620', '1ae0b12c53a3223c9ab631f71744bcea', 'FAILED', 1, '', '', '', '7029181219', 'https://qr.webupipay.online', 'Online Payment Request', 'QR PAY', '667c11eb0efbc', 'Paytm', '', '', '', 'COMPU31631719407083', '2024-06-26 18:34:43', 'zRzQbKvXfV1719407083', 26),
(63, 'QRPAY96151', '9e557314e16394255a3f2888aa89fad0', 'FAILED', 40, '', '', '', '6290035414', 'https://qr.webupipay.online', 'Online Payment Request', 'QR PAY', '66868b12d9fd4', 'PhonePe', '', '', '', 'COMPU36641720093458', '2024-07-04 17:14:18', NULL, 117),
(64, 'QRPAY71450', '1ae0b12c53a3223c9ab631f71744bcea', 'FAILED', 1, '', '', '', '8869871298', 'https://qr.webupipay.online', 'Online Payment Request', 'QR PAY', '668a3117a8d67', 'PhonePe', '', '', '', 'COMPU94451720332567', '2024-07-07 11:39:27', NULL, 26),
(65, 'QRPAY69861', '1ae0b12c53a3223c9ab631f71744bcea', 'FAILED', 1, '', '', '', '8869871298', 'https://qr.webupipay.online', 'Online Payment Request', 'QR PAY', '668a34820fe0f', 'Paytm', '', '', '', 'COMPU14701720333442', '2024-07-07 11:54:02', 'HbFoUmXzSF1720333442', 26),
(66, 'QRPAY49570', '1ae0b12c53a3223c9ab631f71744bcea', 'PENDING', 10, '', '', '', '7701992701', 'https://qr.webupipay.online', 'Online Payment Request', 'QR PAY', '6690cc5a5552f', 'PhonePe', '', '', '', 'COMPU47861720765530', '2024-07-12 11:55:30', NULL, 26),
(67, 'QRPAY20173', '1ae0b12c53a3223c9ab631f71744bcea', 'SUCCESS', 1, '419426062174', '', '', '7701992701', 'https://qr.webupipay.online', 'Online Payment Request', 'QR PAY', '6690cd2f2ac04', 'PhonePe', '', '', '', 'COMPU52201720765558', '2024-07-12 11:55:58', '1', 26),
(68, 'QRPAY40566', '1ae0b12c53a3223c9ab631f71744bcea', 'SUCCESS', 1, '456039274181', '', '', '7701992701', 'https://qr.webupipay.online', 'Online Payment Request', 'QR PAY', '6690cf4d29c2a', 'PhonePe', '', '', '', 'COMPU67461720766161', '2024-07-12 12:06:01', '1', 26),
(69, 'QRPAY77932', '1ae0b12c53a3223c9ab631f71744bcea', 'SUCCESS', 1, '419430005747', '', '', '8595306269', 'https://qr.webupipay.online', 'Online Payment Request', 'QR PAY', '6690cfebe5c02', 'Paytm', '', '', '', 'COMPU80401720766443', '2024-07-12 12:10:43', 'y54Hm2F8qn1720766443', 26);

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

--
-- Dumping data for table `payment_links`
--

INSERT INTO `payment_links` (`id`, `link_token`, `order_id`, `created_at`) VALUES
(31, '2d37153560eca9962c90de1ead3b219e8f5f595855076475f30dca70ab60b447', '49117', '2024-06-20 13:40:49'),
(32, '6b2b198cfb54eabdb41062539425bd975a18e50ae05341a88bb7609c475fdfcd', '1234561718871318', '2024-06-20 13:45:18'),
(33, '56fd7cca67a047f33c265a54138e287f309d8f4f366dd713a0344fd3a143cda1', 'QRPAY29656', '2024-06-20 13:45:38'),
(34, '051f3af41d2c825d2f879da899dc6a8e9a99230aa2dbabdc1b80a215313b5e7f', '1234561718871476', '2024-06-20 13:47:56'),
(35, 'fe697af43014aae85ba05b5d429c40370a2bd013ee6e7dd22f770fa58db71d86', 'QRPAY39253', '2024-06-20 15:09:31'),
(36, 'acc80c4f733bdeaa5e077f3ca57188d8545ee75d25f99627a368842c6f5fd804', 'QRPAY38603', '2024-06-20 15:15:24'),
(37, '7d063da9a6d2be7ad1ad4065027baf756f062e6f449090f25107426c89149875', 'QRPAY42762', '2024-06-20 15:17:31'),
(38, '811539818a8f37a9b16dc51d3ac489f00dc5ef3d3b71d355fb9041e8d2b0283b', 'QRPAY96121', '2024-06-20 15:54:08'),
(39, '3a29692d9da5857c3744df9b9d3d695a7d8f5c235a149896f2066aac94415adc', 'QRPAY76973', '2024-06-20 15:54:28'),
(40, '7a2c144d0bdd65bc51f2930f8ecd82ededbd4854c01f034804b7f12183badb8e', 'QRPAY83164', '2024-06-20 16:23:18'),
(41, 'a82f018e263c58d279f4907f94cf638f4e052728bfebd01ec150b4e9ec1465d2', 'QRPAY61430', '2024-06-20 16:59:21'),
(42, 'ea79ccfbb9e15a5daae57e81d96416bf3b62c684d8570f3586567362ff0aa2ef', 'QRPAY45880', '2024-06-20 17:07:29'),
(43, '12df6f8afd0827f8ab71b8814dc5c78de0988b9d0096046e21eaff5455332055', '1234561718885227', '2024-06-20 17:37:07'),
(44, 'fc75c7d9ba5dd5e646d42ee9abd38b905ab420e8be3c2bc371dce7caaa1bd2ea', 'QRPAY94088', '2024-06-20 18:14:33'),
(45, '6519f428c27bc2035323990880652714c653cbe93d684eca22145640ed3ce708', '42_1718888779', '2024-06-20 18:36:22'),
(46, '0a3a37f580192d430a8409cc594fa25aeffb5bf239958fb8670e46cb1b181445', '43_1718888940', '2024-06-20 18:39:04'),
(47, '41cbcf35f1e3ec8f6ec706a47b1dd0d2058063dcb92c2c763c46d68905842eac', '44_1718889114', '2024-06-20 18:41:58'),
(48, 'e1b9bc831da736d6d76a258755c9e4be133c7468a47939cc164cd2357fcf6467', '44_1718889172', '2024-06-20 18:42:56'),
(49, '8ed3359cf7a9c845917f6828d2b4a8458a8878289760537e3a2839622666652c', 'QRPAY23001', '2024-06-20 18:56:19'),
(50, 'd2d1798f881177b53956007cf6261acafed5910eb737906830d41d7698d8e661', 'QRPAY79056', '2024-06-20 19:07:54'),
(51, '4bb34cb2aca67db54a72a5f00722f41283a4dd5d8a9579a331c2b8ab3d110c38', 'QRPAY68742', '2024-06-20 19:10:34'),
(52, '4973681542410a84b079f7240fd3da468c5234b1faaa08793c29d4b5f66d4a01', 'QRPAY29893', '2024-06-20 19:13:32'),
(53, 'f7b71021f388cf1e7d2dfa77b633e361011d3ab8bcfc1297be5b47d2f03f2a7a', 'QRPAY54434', '2024-06-20 19:15:41'),
(54, 'c8b36a7a2dcbf393486cab91ccbbfcf7d479fa5d7bc95c39d9569961b238c8f0', 'QRPAY35929', '2024-06-20 19:18:26'),
(55, '6044d7354f6d592a2233588e0a16daf17a2ef698a3cbc5c6e14f0d6eb922f3a0', 'QRPAY68109', '2024-06-20 19:19:50'),
(56, '0ffa9e9349e69aad31c511477f645caf2ff8cf7b291d9ae2e93d574d271353fa', 'QRPAY75526', '2024-06-20 19:34:46'),
(57, 'ed9e37cbd4846f3d93665c0169df58c1d8e06d74964257d456e05c6fba9c0859', 'QRPAY91463', '2024-06-20 19:38:36'),
(58, '20be4793a40737a16cc2bb178817e858336a8007ab5d2001f3aa87ed3e5c6e6a', 'QRPAY81707', '2024-06-20 19:44:53'),
(59, '05d7747612bded87fd8b201a6cb39445ed027779a29fb88e22bef6328f407bc3', 'QRPAY26717', '2024-06-20 19:51:20'),
(60, 'e7e2066e76f50710b254f47aa7e7e99c096c1fe93ca0b29db78df2079277a069', 'QRPAY21085', '2024-06-20 19:53:54'),
(61, 'e0ffa88cdf48cbb2edd68bb3b03d363bb1f0bfae87b9d6224329ba21db4d4eed', 'QRPAY46290', '2024-06-26 15:02:00'),
(62, 'a3cbd01206ef415fdab59b79fbf97b51fb39d857fab29db214d5f53de99b5fef', 'QRPAY12620', '2024-06-26 18:34:43'),
(63, '34c0d97f7bed01c7faddcea2e24ce80f70abb604021c07814563212fc7eece64', 'QRPAY96151', '2024-07-04 17:14:18'),
(64, '356cc7ce80f2a3a3ef6c4fcd4e8ab98de029d8f416a272d51615547b72701c85', 'QRPAY71450', '2024-07-07 11:39:27'),
(65, '57b6c17024c467ea70f213ef65c06eb538da83d4ad8e5e5a564308a0514bc4e2', 'QRPAY69861', '2024-07-07 11:54:02'),
(66, '948af0088ef4bf669709bf2fd92c0d45fd44073d59d543ca5afcf9617b0c6f69', 'QRPAY49570', '2024-07-12 11:55:30'),
(67, '7a985cf387cd5ac912e0d333e992f8f237bddd0b04e4d191e2f4def4324f9f0a', 'QRPAY20173', '2024-07-12 11:55:58'),
(68, '2f26f698da913251f91bbf1839131492d683a49894ab3222adfd9c986a3be7e7', 'QRPAY40566', '2024-07-12 12:06:01'),
(69, '6bcf450b154d84f2691256aea83d3a0197ffe882d2f46076d98e53e766a52152', 'QRPAY77932', '2024-07-12 12:10:43');

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

--
-- Dumping data for table `paytm_tokens`
--

INSERT INTO `paytm_tokens` (`id`, `user_token`, `phoneNumber`, `MID`, `Upiid`, `created_at`, `date`, `status`, `user_id`) VALUES
(1, 'c6259865c004787b455073d56eb526cb', '9799754037', '', '', '2024-06-07 08:02:19', '2024-06-07 08:02:19', 'Deactive', NULL),
(5, '1ae0b12c53a3223c9ab631f71744bcea', '8595306269', 'vypzvn30021252525229', 'paytmqroimthzia9v@paytm', '2024-07-12 06:38:09', '2024-07-12 06:38:09', 'Active', 26);

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

--
-- Dumping data for table `phonepe_tokens`
--

INSERT INTO `phonepe_tokens` (`sl`, `user_token`, `phoneNumber`, `userId`, `token`, `refreshToken`, `name`, `device_data`, `status`, `date`, `user_id`) VALUES
(10, '8677755db88bcab95dff98ff56f158c3', '7029181219', 'GU1910020847544961266027', 'hq4wOGdzX31IuPyyh7/7AYOLiipO42P8QtgmusudZHta7zUAMbV5uMV5f6kF1hmvwf6VioZku1ZmTjZdaPr7WiNdzwbSAMv3hzcNjBghpzFfDJakLaVeanlz5vYTq7p3VMJLm+1ovru69G5TVkyctk4DlqWBEsc5rjhOodWz4TYUNq8ttWs7Xf+I1JlKLjpx9FT9BizuJuUdqEg4HmPmb0df7gFv7HdkgdvEWuSPo5XBYXiG1Nxs0nopDVvFKPWrO3V6aOsz9XsuhYXV9j3rBUn2Bmd9/7Ku2uRyECKcM1Vudf3oG4g/BreMo91ze0ijjUSKB1yqWfqsh0vMolZFGgiGbGlMpJ1Ya5Wc5NJBsCTsF4l9gJw3mWXAm1/Db8ODT6Efe6mnE8hkZfRGr+zzYGMUROAE3ApQwpxUql/tQe2TQ7jJ5Qh46EXk3KXIpuY7WlcFJPjQyNq3O/m64uqOxpJLZ7DPUL/FrKvzvMxW4Y30hs1bMgYLwxgjIIV8eSF1WF3twBAVeIUvGv+3w0j+AtPczeCQdN1N2ICz8HM0XMHesSrOdyRkdkVEEDojeu7qQ3+uXUZqjake8NeDYntPYL7kZMHYl/y00CMhPAB3tOSkkdGZSvnJBE9Xfaxn4Ga8DBBWnxA+v2V1N2/R8Vtrdp3Dn+pvv+WQTT/N13eHsVOJFulmsdRw49Ol39rRmPEObNrVb0nYhOKuziiPhv+qK75QkSJZ+0A8LN3kaYoD3zmNoFxKpHWJl5pelGtD/SSnF2Ap8mwv5a06BwQorcjEaMqQIZ60TZiP1ARTXUS605KCyAssfS/GH0a8xnAvP8I52NN1m2YUFJ76urCJyLPrlqCx6aFFFlpAgiE4onDGtEQtdZAfQhPX0b8UK026cMBR7SW7QwwWTzVnlMl03V+HfY8FRQc/gIWK2Qg+S40stNg/zoGPRHGIfNHVI8ApePxfHqTYQMkYzfPUDNqVlOVFyWHKSMPlUkEU9tiRC0/bPYXESyydVHOVHv/0VBZxuFz2oxlVEANROmSop6lj1YHTGOV4Tk6K/XwZjoulRuDXmSBWgOaFR2FX/rsILjc2svLliGsq93IAGC1Tqzg6HAhKJtCiABLAC6SzChy3JTGyq0EV+MF9q+vEdhjsQEeQudY0aiPyy+jochitmh8Y5Dcst0IPCbBAAwqA+rGGGeDQDvcSem90mt0aus7DFLxaG3JID+OKxSzFElGylSuQ3gTrOtljWPbFsaENZY62Tv/GC3MiVVoMv7vYyiFukw7rBh+S/6pvcJ0Wgl/mlcYWyq3TdeCYvDX+91o1INa4NbIFPL671gOF8su3mJXCGkORwBSvRt9OZS2lJUMJFasbn3xa2rf0fi5YEGO9Q10g/uTLlMnzSS5IBWpGaN8YTWScFlco4pXkcJwcTKhvUmgxhllYaExoZFJv6aoV+qAQQ9L3MarRphJz7qdgBtZVl1Po/lVIOVfWkyPKrOwCjPG/Yec3ZajhqYe2e5/hpNA6N3zmJ5unR6An4eOm9GCMWg8bIZGmyZc5DXFLMRWkJBS1+L/yW7arE4zNLd0gX3wfrO9pA0+9xaaHuhTT8ub5waY4BwLH+k3mFvnscWMSP9ISBEAo++cLH+H4Z4fVARdm0KoRjXPBDbwhz8TJJYIhnSjiKfn7yxer+eI1CzvRDy6fB/40Pp4RvR4kl/aJqsl1ewkvN26kddKkHKmqqPdOxkIykhw2sRqTTFpzAmB7VWESUkP7+rG9lxyuSSKQAemeMfAKvfXYThrDSbSvzPPz7IQGfXu7rImhcyrExNQ136jk1spx7MfGWpYVhc15LEOowCG32RhiSrwW8WW9EBToWBTijGp1qps0VqgeTjDmS79TATbcPE+sHFhz3DCA4RngQyKZ23zrAzWQdV4ErCR4UW6lqGE3r+9X4PqOTYuZMdxTJ/a1CnTEjq9r0V7dQXIYbjx/4ByEzQTXMV5SMHFz1uYcazHB7qwPaTrqL4Xylv+0shryT3AXPue8T8wF53gZ2GaQabQh32zOanmqz88OmVjQ/ha6AHKTq2ketMviWFjPk+W7swXXXJtYF/OMuRjZgcQZVYb+Eg3M6kUEFCCh9mUJY9HrWzHdpfPZTuuO8GcogkFohfGixnxD0Kz0J8uCqrLyZkW1R/atXwn7XpmezLyL7cuQHy8Jl/NN8/l1Qou4LWNHbj+nQaECV5Awcd5g+mEThp+9KV5ZT3AhSHJDRyhQYc/LVHonv/AaQpYvpBQRm1eM4Vhk9UB3nnns9PDO2KrXwVabCWi0QFliNQWQO3TjHh066Qvv4E7ntH0ulzJQDr4dn6tetkYgbwfY/b1dmgN1cIVi2oJq9OQjdU2kZwX7fqPLppX35DN9XtwdRbXCWfoqCeL6tyiMUcF+MUIJoCFdpTGoW8O5Nbj0oczFmW/P/QXn04JtsP2YJSL9phTc3Zmqcevktm+E8aPFi6ftqudUXQGd5ByuubwSpDo2Fi9WVdt8UtsCxiLIdQnhtDtXw6emtssjYMJzokkBnTHf7l2a3jVtTamdafQw5MTLx/Ra4CsWJUEjnAGtvZ6GqcIYcOwvpDPSsdpZ36U2jPysVXxB', '41214984b75e1be36aa909c3c8191056', 'sanjay dutt', '34633635666637316231666564646437633139663834303666333662633136362e38306461333265656330313236316536613530393736386431333535663234642e5869616f6d692e633433373636633063346163316437383434616438346431373631336263353730353936383463383265373664396335626237336161313930366664373533667c7c36616164323466623338326532643764633252744e6a4d322d63574e7662512d7c7c31372e39302e38362e3435', 'Active', '2024-06-20 12:16:37', 115),
(21, 'a5e994fa2ed4f95b353a518b93686b2c', '9519388380', 'GU2309171012033226717056', 'hq4wOGdzX31IuPyyh7/7AYOLiipO42P8QtgmusudZHta7zUAMbV5uMV5f6kF1hmvwf6VioZku1ZmTjZdafjVXmFd3yzdAsvjzTQdkFIjmSEVD4a4LKVednhz5vYTq7p3VMJLm+1ovru79X5XVEyMmE0DlqWBEsc5rjhOodWz4TYUNq8ttWs7Xf+I1JlKLjpx9FT9BizuJuUdqEg4HmPmb0df7gFv7HdkgdvEWuSPo5XBYXiG1Nxs0nopDVvFKPWrO3V6aOsz9XsuhYXV9j3rBUn2Bmd9/7Ku2uRyECKcM1Vudf3oG4g/BreMo91ze0ijjUSKNRGsLfqisUvMpVl7BVOVWRJMpZ1YaJ+cgItHsBnROZp+gbAeiT3CpluPb+2XAKMxXa6jANh6dq57sOvGG18XRr0D3ApQwqtptVH5N+6CbILdvglvwQLKz9WJs+EjXVMrHvfQ5vymOP618cWdwZdlSqjgUODRuJzzu+9Dy46RgvIBEwQlz1shIKd/eSFhWF/DzFsVRoUrGe+3xUv9AtjY2eeQXOcuxYai828abc7apSvnKSB0fhhdPAgtftPcUFGXD01+nMlH3/qfPnpcQdnPeMLNudaN2Al6chBcsNW5r9qeENPLGBJWV4lmyly0MSE+m3M+v2V1DjGi9GVmAaL4n8c3qt+TEyzh10m3nUy4EtIA+cB74PWJ6c7Hi8MrT9bAaDnEhs+Lyi+miNLNOPpLqCVS0n0oP9/3ar0D8QPHu3JNw2nQiMpelGsI/0GgB3wX6jYuy6IKHAQ44cvTGYmQeZntT4i9kgdTawWt7YGWyTJFcjvGGEeX+Ep1BqQMy8BYrWYWPYahrLCgiLP4ieSK6cEBHU42giE/gy7vmkdzdp8cRgWh5Ms6Ky3nZOJKqByBZkw7ZQs4ucl0xXOERNM7Ri59rLq/gCEtW506oO082aqTRkSyQvPKJ502dP48VZ78T80zzZLOCt6al+ZRxjzOT6jib3wh8/aFF0XIF6/DcWWZd3XiHsjFSB11ggP5hTJSH2JQA3+ipYBsiKv+Lv9+SVKG/hcFm46qWuDUsyBag42dTmRYiagIRwo4ntDuiG8U+3IDJiEaqzguUwpkLpWgOR3CJdKwQQ3sPjOYhngF+KRf4Oq+TBTWHm6vu+wsew/uwOHGTzarnQ4L5yk87BkOHrMALCeHs6asGaXQDvs4TVcIg/JqvsjDfuFGMSpuQc6K3SnGGUrslS2lhBjGMoR1cvXfnJtMYoq3Tvz+OnAmfWYQ4KLmlSFu4yDPNwu3+LlacJ09r2L2jfk/4a3seaqBgTK93AQ1ffinA7EEYa6+xlu/8taWse7IMzrbwBCCWd9eR2alQB4PFKwA+Vdc1pP9clRaPXfCGE0Sw/THksaHURBIFWtHHvQFW2ioJlUoy63hf/gGcqgeV2lHrUROZGRYdGR14qcZ0LgtYYLvDZv6kixsrY9dAdB+z1+34lk2PHj7gyXKre8Yp8C4SswkH9jNl6KdSbTLntg4I1jRMZTSX59RmvuY50uEVxs2KpPVko8LBltIPUb0OAS2/a+sW62sJvTIAYc7BH8P3/RlOiXN7Zecvxf6yPnxpuJoFzPh+mDiLM3aSAJCOdIvL3dPhaogRdv4fNytPRFyruMC0SuCJ6hdke/1Ntg+oFLDM+74gwO4p+oYGDeQCxGQIuMaQ44QlA1nuc+Gp85LTQkyLEftf8KkWamp069zowN6q35GzwWsQ2VnKzJBSE4RZ1/69YShuBeVVR2PcPWfFMUVvOrzUwzPZ4DU6djp0vEMeUan9KSyYGLSsvZkk7Xf6P86ooHQYpJ3s/cHNljJ8C2AjTBsZaEUmHOnITDLQHvxkmhcto87UpEochuYR+V4Rg+4S1W0Z3lR11D5zTv/PSWN2UCxCSqYb0Zmi30DVXHflWcwtM5AuOU31lFbV8I/hcbdhg==', '070d8c029ff56e42b55979e2eeec6929', '9519388380', '64623935356565353835336136313939353462363332653865666533366635392e64396131353137636139623639396131353765323035303235663337626636332e5869616f6d692e643039333732646535386336663731343165636135383839326664626233313935633038633865636431666233316330663834636630653062323366626335367c7c61643139386431383538353135326331633252744e6a4d322d63574e7662512d7c7c34342e3133302e3138322e323231', 'Active', '2024-06-28 12:32:25', 116),
(23, '9e557314e16394255a3f2888aa89fad0', '6290035414', 'GU2311231320325854899170', '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', '9427fd71be42a8f454cfaab0591c9ba5', '6290035414', '38396532633164323138613938626265306335343766383864613033633230322e66383562653033363436343864616162663132323333313537633731376366372e5869616f6d692e323639663938303131376533653464376564363362633231393331333030366532373739616633363338306261336237366638333661393365333337356238627c7c64646238323563613865613965353733633252744e6a4d322d63574e7662512d7c7c35362e3233312e32362e3430', 'Active', '2024-07-04 11:44:03', 117);

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

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `transactionId`, `status`, `order_id`, `vpa`, `paymentApp`, `amount`, `user_token`, `UTR`, `description`, `date`, `mobile`, `user_name`, `merchantTransactionId`, `transactionNote`, `user_id`) VALUES
(1, '453895050581', 'SUCCESS', '1234561718868706', '', '', '1', '1ae0b12c53a3223c9ab631f71744bcea', '', '', '2024-06-20 08:27:59', '1234567890', '', NULL, NULL, NULL),
(2, '453892390852', 'SUCCESS', '1234561718870026', '', '', '1', '1ae0b12c53a3223c9ab631f71744bcea', '', '', '2024-06-20 08:27:59', '1234567890', '', NULL, NULL, NULL),
(3, '453807162107', 'SUCCESS', '49117', '', '', '1', '1ae0b12c53a3223c9ab631f71744bcea', '', '', '2024-06-20 08:27:59', '7029181219', '', NULL, NULL, NULL),
(4, '9257169470', 'SUCCESS', 'QRPAY42762', 'test@bharatpe', 'PhonePe', '1', '8677755db88bcab95dff98ff56f158c3', '417255743458', '2433158094', '2024-06-20 09:48:53', '', NULL, NULL, NULL, 115),
(5, '5165218187', 'SUCCESS', 'QRPAY76973', 'test@bharatpe', 'PhonePe', '1', '8677755db88bcab95dff98ff56f158c3', '417297235094', '5315391387', '2024-06-20 10:25:51', '', NULL, NULL, NULL, 115),
(6, '417218447076', 'SUCCESS', 'QRPAY94088', 'xxxxxxxxxxxx@nsdl', 'UPI', '1', '1ae0b12c53a3223c9ab631f71744bcea', '', '', '2024-06-20 12:54:41', '', 'SANJAY DUTTA', 'UPB42291718887473', 'ARC147171888794813', 26),
(7, '20240620110820000010628306099411729', 'TXN_SUCCESS', 'QRPAY54434', 'test@paytm', 'PPBL', '1', '1ae0b12c53a3223c9ab631f71744bcea', '', '', '2024-06-20 13:46:09', '', 'NULL', '2J2RrCdFTx1718891141', NULL, 26),
(8, '20240620110890000010633215850843754', 'TXN_SUCCESS', 'QRPAY75526', 'test@paytm', 'PPBL', '10', '1ae0b12c53a3223c9ab631f71744bcea', '', '', '2024-06-20 14:05:38', '', 'NULL', 'y1fahAdNuH1718892286', NULL, 26),
(9, '20240620111060000010634154771541976', 'TXN_SUCCESS', 'QRPAY91463', 'test@paytm', 'PPBL', '1', '1ae0b12c53a3223c9ab631f71744bcea', '', '', '2024-06-20 14:09:41', '', 'NULL', 'A8RSaywQGZ1718892516', NULL, 26),
(10, '20240620111070000010635679523060446', 'TXN_SUCCESS', 'QRPAY81707', 'test@paytm', 'PPBL', '1', '1ae0b12c53a3223c9ab631f71744bcea', '', '', '2024-06-20 14:15:29', '', 'NULL', 'frcX5UNXZn1718892893', NULL, 26),
(11, '417219742605', 'SUCCESS', 'QRPAY26717', 'xxxxxxxxxxxx@nsdl', 'UPI', '1', '1ae0b12c53a3223c9ab631f71744bcea', '', '', '2024-06-20 14:22:53', '', 'SANJAY DUTTA', 'COMPU79591718893280', 'ARC281171889333976', 26),
(12, '20240620110900000010637923206770628', 'TXN_SUCCESS', 'QRPAY21085', 'test@paytm', 'PPBL', '10', '1ae0b12c53a3223c9ab631f71744bcea', '', '', '2024-06-20 14:24:22', '', 'NULL', 'kdiK8eXE8Z1718893434', NULL, 26),
(13, '419426062174', 'SUCCESS', 'QRPAY20173', 'xxxxxxxxxx@naviaxis', 'UPI', '1', '1ae0b12c53a3223c9ab631f71744bcea', '', '', '2024-07-12 06:28:05', '', 'SAMINA  KHATUN', 'COMPU52201720765558', 'ARC559172076561032', 26),
(14, '456039274181', 'SUCCESS', 'QRPAY40566', 'xxxxxxxxxx@ptaxis', 'PAYTM', '1', '1ae0b12c53a3223c9ab631f71744bcea', '', '', '2024-07-12 06:37:15', '', 'SAMINA  KHATUN', 'COMPU67461720766161', 'ARC452172076618647', 26),
(15, '20240712110990000018494037860311465', 'TXN_SUCCESS', 'QRPAY77932', 'test@paytm', 'PPBL', '1', '1ae0b12c53a3223c9ab631f71744bcea', '', '', '2024-07-12 06:41:45', '', 'NULL', 'y54Hm2F8qn1720766443', NULL, 26);

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

--
-- Dumping data for table `store_id`
--

INSERT INTO `store_id` (`sl`, `user_token`, `unitId`, `roleName`, `groupValue`, `groupId`, `user_id`) VALUES
(3, '8677755db88bcab95dff98ff56f158c3', 'Compu-Tech', 'Admin', 'M466Q1UGE', '964928', 115),
(8, 'a5e994fa2ed4f95b353a518b93686b2c', 'Sweet', 'Supervisor', 'MMDEA1M65', '9299361', 116),
(9, '9e557314e16394255a3f2888aa89fad0', 'HP GAS', 'Admin', 'M22K6N623GK2X', '11458658', 117);

-- --------------------------------------------------------

--
-- Table structure for table `url_shortener`
--

CREATE TABLE `url_shortener` (
  `original_url` varchar(5000) NOT NULL,
  `short_code` varchar(500) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `url_shortener`
--

INSERT INTO `url_shortener` (`original_url`, `short_code`, `id`) VALUES
('https://qr.webupipay.online/payment2/instant-pay/2d37153560eca9962c90de1ead3b219e8f5f595855076475f30dca70ab60b447', 'zm9uD5', 6),
('https://qr.webupipay.online/payment2/instant-pay/56fd7cca67a047f33c265a54138e287f309d8f4f366dd713a0344fd3a143cda1', 'lRDcN4', 7),
('https://qr.webupipay.online/payment4/instant-pay/fe697af43014aae85ba05b5d429c40370a2bd013ee6e7dd22f770fa58db71d86', 'RjmnEy', 8),
('https://qr.webupipay.online/payment4/instant-pay/acc80c4f733bdeaa5e077f3ca57188d8545ee75d25f99627a368842c6f5fd804', 'gzXL9D', 9),
('https://qr.webupipay.online/payment4/instant-pay/7d063da9a6d2be7ad1ad4065027baf756f062e6f449090f25107426c89149875', 'HE8gVR', 10),
('https://qr.webupipay.online/payment4/instant-pay/811539818a8f37a9b16dc51d3ac489f00dc5ef3d3b71d355fb9041e8d2b0283b', 'cEKFzy', 11),
('https://qr.webupipay.online/payment4/instant-pay/3a29692d9da5857c3744df9b9d3d695a7d8f5c235a149896f2066aac94415adc', 'nTRZh4', 12),
('https://qr.webupipay.online/payment4/instant-pay/7a2c144d0bdd65bc51f2930f8ecd82ededbd4854c01f034804b7f12183badb8e', 'QR2PUN', 13),
('https://qr.webupipay.online/payment4/instant-pay/a82f018e263c58d279f4907f94cf638f4e052728bfebd01ec150b4e9ec1465d2', 'uqP8tO', 14),
('https://qr.webupipay.online/payment4/instant-pay/ea79ccfbb9e15a5daae57e81d96416bf3b62c684d8570f3586567362ff0aa2ef', 'Rlpmrz', 15),
('https://qr.webupipay.online/payment2/instant-pay/fc75c7d9ba5dd5e646d42ee9abd38b905ab420e8be3c2bc371dce7caaa1bd2ea', 'QNUviJ', 16),
('https://qr.webupipay.online/payment2/instant-pay/8ed3359cf7a9c845917f6828d2b4a8458a8878289760537e3a2839622666652c', 'c38NqJ', 17),
('https://qr.webupipay.online/payment2/instant-pay/d2d1798f881177b53956007cf6261acafed5910eb737906830d41d7698d8e661', 'KGpQwx', 18),
('https://qr.webupipay.online/payment2/instant-pay/4bb34cb2aca67db54a72a5f00722f41283a4dd5d8a9579a331c2b8ab3d110c38', 'iF1RNz', 19),
('https://qr.webupipay.online/payment2/instant-pay/4973681542410a84b079f7240fd3da468c5234b1faaa08793c29d4b5f66d4a01', '5zQUcH', 20),
('https://qr.webupipay.online/payment3/instant-pay/f7b71021f388cf1e7d2dfa77b633e361011d3ab8bcfc1297be5b47d2f03f2a7a', 'tVSo31', 21),
('https://qr.webupipay.online/payment3/instant-pay/c8b36a7a2dcbf393486cab91ccbbfcf7d479fa5d7bc95c39d9569961b238c8f0', 'FVJQcp', 22),
('https://qr.webupipay.online/payment3/instant-pay/6044d7354f6d592a2233588e0a16daf17a2ef698a3cbc5c6e14f0d6eb922f3a0', 'B4vcF5', 23),
('https://qr.webupipay.online/payment3/instant-pay/0ffa9e9349e69aad31c511477f645caf2ff8cf7b291d9ae2e93d574d271353fa', '5zZWh8', 24),
('https://qr.webupipay.online/payment3/instant-pay/ed9e37cbd4846f3d93665c0169df58c1d8e06d74964257d456e05c6fba9c0859', 'we1iZd', 25),
('https://qr.webupipay.online/payment3/instant-pay/20be4793a40737a16cc2bb178817e858336a8007ab5d2001f3aa87ed3e5c6e6a', '9mlIRx', 26),
('https://qr.webupipay.online/payment2/instant-pay/05d7747612bded87fd8b201a6cb39445ed027779a29fb88e22bef6328f407bc3', '8pYNjd', 27),
('https://qr.webupipay.online/payment3/instant-pay/e7e2066e76f50710b254f47aa7e7e99c096c1fe93ca0b29db78df2079277a069', '5F2Uoi', 28),
('https://qr.webupipay.online/payment3/instant-pay/e0ffa88cdf48cbb2edd68bb3b03d363bb1f0bfae87b9d6224329ba21db4d4eed', 'qmd38s', 29),
('https://qr.webupipay.online/payment3/instant-pay/a3cbd01206ef415fdab59b79fbf97b51fb39d857fab29db214d5f53de99b5fef', '0lfM6e', 30),
('https://qr.webupipay.online/payment2/instant-pay/34c0d97f7bed01c7faddcea2e24ce80f70abb604021c07814563212fc7eece64', 'As3EOP', 31),
('https://qr.webupipay.online/payment2/instant-pay/356cc7ce80f2a3a3ef6c4fcd4e8ab98de029d8f416a272d51615547b72701c85', 'OQUaRI', 32),
('https://qr.webupipay.online/payment3/instant-pay/57b6c17024c467ea70f213ef65c06eb538da83d4ad8e5e5a564308a0514bc4e2', 'hslEwk', 33),
('https://qr.webupipay.online/payment2/instant-pay/948af0088ef4bf669709bf2fd92c0d45fd44073d59d543ca5afcf9617b0c6f69', 'RBseqQ', 34),
('https://qr.webupipay.online/payment2/instant-pay/7a985cf387cd5ac912e0d333e992f8f237bddd0b04e4d191e2f4def4324f9f0a', '9j3ftC', 35),
('https://qr.webupipay.online/payment2/instant-pay/2f26f698da913251f91bbf1839131492d683a49894ab3222adfd9c986a3be7e7', 'zsAj9F', 36),
('https://qr.webupipay.online/payment3/instant-pay/6bcf450b154d84f2691256aea83d3a0197ffe882d2f46076d98e53e766a52152', 'eqyl7L', 37);

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
(26, 'Compu-Tech', '7029181219', 'User', '$2y$12$GfqVpFWD6t7mBI/tXb8eVuZs5dKcCqqSeWnsLadKLQyTpOh8pOBYy', 'user@gmail.com', 'Compu-Tech', '335001', 'KLDPS7899J', '111111111111', 'india ', '1ae0b12c53a3223c9ab631f71744bcea', '2024-07-13', 'https://qr.webupipay.online/', '', '', 0, 'off', 'Q896044841@ybl', 'No', 'No', 'Yes', 'No'),
(28, 'Compu-Tech', '1234567890', 'Admin', '$2y$12$cLUd0ceOsccInJGQeqUYnu4yd9TaCWuQ1H5ezO7sy9bYSOI7BssJC', 'admin@gmail.com', 'Compu-Tech', '335001', 'KLDPS7898J', '124545478554', 'india ', 'e8d2a2f1ac98d41d3b7422fd11ab98fa', '2027-12-22', 'https://qr.webupipay.online', '', '', 0, 'off', NULL, 'No', 'No', 'No', 'No'),
(116, 'Jeet Ray', '9918014419', 'User', '$2y$10$BaDMb6WDUm407uhtEfKnWOZ83xJfTNWXsDiKVOogH2Tu8Cg2VWEI2', 'jeetray399@gmail.com', 'Fire', '228145', '', '', 'MustabadsaraiyaBengalisweetshop', 'a5e994fa2ed4f95b353a518b93686b2c', '2024-07-01', '', '', '', 0, 'off', 'Q721998622@ybl', 'Yes', 'No', 'No', 'No'),
(117, 'Irfan Sk', '6290035414', 'User', '$2y$10$AWOuNnVe6P4Ts98cq5boG.jwDT3e1JKeZh7CWCnJmNMuWkHB9ID16', 'ip7519489@gmail.com', 'Little Tavern', '58734', '', '', 'Kolkata', '9e557314e16394255a3f2888aa89fad0', '2024-07-07', '', '', '', 0, 'off', '', 'Yes', 'No', 'No', 'No'),
(118, 'Ankit Prajapati', '0886987129', 'User', '$2y$10$Bjw4r56YoSnpjMguioctc.qkh5JJsxP.xZ/gxY9GfjdEZ.I1aH9BC', 'ankitkumarprajapati718@gmail.com', 'Ecommerce ', '246735', '', '', 'GohawarjaitNoorpur', '8987b2699b8eb6856dabdeb2b2fdcc40', '2024-07-09', '', '', '', 0, 'off', NULL, 'No', 'No', 'No', 'No'),
(119, 'Abhi', '9450000481', 'User', '$2y$10$sXA1wfiuls0cd5HYi45aQOqnIZbuT4gYR7DT1S6u5EYz.K/P5HiU2', 'yadav1998412@gmail.com', 'Asb studies ', '110032', '', '', 'Delhi', 'c6ee6a2e878b7966fc3dbdf32c7f9841', '2024-07-12', '', '', '', 0, 'off', NULL, 'No', 'No', 'No', 'No');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `callback_report`
--
ALTER TABLE `callback_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hdfc`
--
ALTER TABLE `hdfc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `payment_links`
--
ALTER TABLE `payment_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `paytm_tokens`
--
ALTER TABLE `paytm_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `phonepe_tokens`
--
ALTER TABLE `phonepe_tokens`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `store_id`
--
ALTER TABLE `store_id`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `url_shortener`
--
ALTER TABLE `url_shortener`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
