-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2018 at 08:08 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adfrs`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_activity`
--

CREATE TABLE `t_activity` (
  `activity_id` int(25) NOT NULL,
  `activity` varchar(500) NOT NULL,
  `log_id` int(11) NOT NULL,
  `bill_id` int(11) DEFAULT NULL,
  `incoming_id` int(11) DEFAULT NULL,
  `outgoing_id` int(11) DEFAULT NULL,
  `voucher_id` int(25) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  `user_id` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_activity`
--

INSERT INTO `t_activity` (`activity_id`, `activity`, `log_id`, `bill_id`, `incoming_id`, `outgoing_id`, `voucher_id`, `file_id`, `user_id`) VALUES
(1027, 'Rizon Repunte just Logged in ', 1690, NULL, NULL, NULL, NULL, NULL, 1),
(1028, 'Rizon Repunte added a new bill with an attachment, JRS for the month of August year 2018', 1691, NULL, NULL, NULL, NULL, NULL, NULL),
(1029, 'Rizon Repunte added a new voucher record with an attachment, JRS invoice date at 2018-08-09', 1692, NULL, NULL, NULL, NULL, NULL, NULL),
(1030, 'Rizon Repunte added a new incoming record with an attachment, Sender: CITY HALL date received: 2018-08-07', 1693, NULL, NULL, NULL, NULL, NULL, NULL),
(1031, 'Rizon Repunte added a new outgoing record with an attachment, sended to CITY HALL released at 2018-08-09', 1694, NULL, NULL, NULL, NULL, NULL, NULL),
(1032, 'Siegfried Quimbo just Logged in ', 1695, NULL, NULL, NULL, NULL, NULL, 24),
(1037, 'Siegfried Quimbo added a new bill with an attachment, LMWD for the month of August year 2018', 1699, NULL, NULL, NULL, NULL, NULL, NULL),
(1038, 'Siegfried Quimbo added a new bill with an attachment, LEYECO for the month of August year 2018', 1700, NULL, NULL, NULL, NULL, NULL, NULL),
(1039, 'Siegfried Quimbo added a new voucher record with an attachment, LEYECO invoice date at 2018-08-10', 1701, NULL, NULL, NULL, NULL, NULL, NULL),
(1042, 'Siegfried Quimbo added a new incoming record with an attachment, Sender: DDROS date received: 2018-08-10', 1702, NULL, NULL, NULL, NULL, NULL, NULL),
(1043, 'Siegfried Quimbo added a new outgoing record with an attachment, sended to SAMDO released at 2018-08-10', 1703, NULL, NULL, NULL, NULL, NULL, NULL),
(1045, 'Siegfried Quimbo deleted the bill of LEYECO for the month of August, year 2018 along with the attachment with a filename of tracking-records.pdf', 1704, NULL, NULL, NULL, NULL, NULL, NULL),
(1046, 'Siegfried Quimbo deleted the bill of LMWD for the month of August, year 2018 along with the attachment with a filename of ROMEL REPUNTE.pdf', 1705, NULL, NULL, NULL, NULL, NULL, NULL),
(1047, 'Siegfried Quimbo deleted the bill of LMWD for the month of August, year 2018 along with the attachment with a filename of ROMEL REPUNTE.pdf', 1706, NULL, NULL, NULL, NULL, NULL, NULL),
(1048, 'Siegfried Quimbo deleted the bill of LMWD for the month of August, year 2018 along with the attachment with a filename of ROMEL REPUNTE.pdf', 1707, NULL, NULL, NULL, NULL, NULL, NULL),
(1049, 'Rizon Repunte deleted a file with a filename of tracking-records.pdf for the Bill of JRS month of August year 2018', 1708, NULL, NULL, NULL, NULL, NULL, NULL),
(1050, 'Siegfried Quimbo deleted the bill of JRS for the month of August, year 2018', 1709, NULL, NULL, NULL, NULL, NULL, NULL),
(1051, 'Siegfried Quimbo added a new bill with an attachment, JRS for the month of August year 2018', 1710, NULL, NULL, NULL, NULL, NULL, NULL),
(1052, 'Siegfried Quimbo updated the bill of JRS for the month of August, year 2018', 1711, NULL, NULL, NULL, NULL, NULL, NULL),
(1053, 'Siegfried Quimbo updated the bill of JRS for the month of August, year 2018', 1712, NULL, NULL, NULL, NULL, NULL, NULL),
(1054, 'Siegfried Quimbo updated the bill of JRS for the month of August, year 2018', 1713, NULL, NULL, NULL, NULL, NULL, NULL),
(1055, 'Siegfried Quimbo updated the bill of JRS for the month of August, year 2018', 1714, NULL, NULL, NULL, NULL, NULL, NULL),
(1056, 'Siegfried Quimbo updated the bill of JRS for the month of August, year 2018', 1715, NULL, NULL, NULL, NULL, NULL, NULL),
(1057, 'Siegfried Quimbo updated the bill of JRS for the month of August, year 2018', 1716, NULL, NULL, NULL, NULL, NULL, NULL),
(1058, 'Siegfried Quimbo updated the bill of JRS for the month of August, year 2018', 1717, NULL, NULL, NULL, NULL, NULL, NULL),
(1059, 'Siegfried Quimbo updated the bill of JRS for the month of August, year 2018 from paid to unpaid', 1718, NULL, NULL, NULL, NULL, NULL, NULL),
(1060, 'Siegfried Quimbo updated the bill of JRS for the month of August, year 2018', 1719, NULL, NULL, NULL, NULL, NULL, NULL),
(1061, 'Siegfried Quimbo changed some details of JRS for the month of August, year 2018', 1720, NULL, NULL, NULL, NULL, NULL, NULL),
(1062, 'Siegfried Quimbo updated the bill of JRS for the month of August, year 2018', 1721, NULL, NULL, NULL, NULL, NULL, NULL),
(1063, 'Siegfried Quimbo changed some details of JRS for the month of August, year 2018', 1722, NULL, NULL, NULL, NULL, NULL, NULL),
(1064, 'Siegfried Quimbo updated the bill of JRS for the month of August, year 2018', 1723, NULL, NULL, NULL, NULL, NULL, NULL),
(1065, 'Siegfried Quimbo changed some details of JRS for the month of August, year 2018', 1724, NULL, NULL, NULL, NULL, NULL, NULL),
(1066, 'Siegfried Quimbo updated the bill of JRS for the month of August, year 2018', 1725, NULL, NULL, NULL, NULL, NULL, NULL),
(1067, 'Siegfried Quimbo updated the bill of JRS for the month of August, year 2018', 1726, NULL, NULL, NULL, NULL, NULL, NULL),
(1068, 'Siegfried Quimbo updated the bill of JRS for the month of August, year 2018', 1727, NULL, NULL, NULL, NULL, NULL, NULL),
(1069, 'Siegfried Quimbo updated the bill of JRS for the month of August, year 2018', 1728, NULL, NULL, NULL, NULL, NULL, NULL),
(1070, 'Siegfried Quimbo updated the bill of JRS for the month of August, year 2018', 1729, NULL, NULL, NULL, NULL, NULL, NULL),
(1071, 'Siegfried Quimbo updated the bill of JRS for the month of August, year 2018 from unpaid to paid', 1730, NULL, NULL, NULL, NULL, NULL, NULL),
(1072, 'Siegfried Quimbo updated the bill of JRS for the month of August, year 2018 from unpaid to paid', 1731, NULL, NULL, NULL, NULL, NULL, NULL),
(1073, 'Siegfried Quimbo updated the bill of JRS for the month of August, year 2018 from paid to unpaid', 1732, NULL, NULL, NULL, NULL, NULL, NULL),
(1074, 'Rizon Repunte deleted a file with a filename of TroubleshootingFINAL.pdf for the Bill of JRS month of August year 2018', 1733, NULL, NULL, NULL, NULL, NULL, NULL),
(1075, 'Siegfried Quimbo updated the details of voucher record, LEYECO invoiced date at 2018-08-10', 1734, NULL, NULL, NULL, NULL, NULL, NULL),
(1076, 'Rizon Repunte deleted a file with a filename of tracking-records.pdf for the Bill of JRS month of August year 2018', 1735, NULL, NULL, NULL, NULL, NULL, NULL),
(1077, 'Siegfried Quimbo updated the details of voucher record, LEYECO invoiced date at 2018-08-10', 1736, NULL, NULL, NULL, NULL, NULL, NULL),
(1078, 'Rizon Repunte deleted the file with a filename of Bills.pdf for voucher record, LEYECO invoiced date at, 2018-08-10', 1737, NULL, NULL, NULL, NULL, NULL, NULL),
(1079, 'Rizon Repunte deleted the file with a filename of TroubleshootingFINAL.pdf for voucher record, JRS invoiced date at, 2018-08-09', 1738, NULL, NULL, NULL, NULL, NULL, NULL),
(1080, 'Siegfried Quimbo added a new file for voucher record, LEYECO invoiced date at 2018-08-10', 1739, NULL, NULL, NULL, NULL, NULL, NULL),
(1081, 'Siegfried Quimbo deleted the file with a filename of tracking-records.pdf for voucher record, LEYECO invoiced date at, 2018-08-10', 1740, NULL, NULL, NULL, NULL, NULL, NULL),
(1082, 'Siegfried Quimbo deleted a file with a filename of TroubleshootingFINAL.pdf for the Bill of JRS month of August year 2018', 1741, NULL, NULL, NULL, NULL, NULL, NULL),
(1083, 'Siegfried Quimbo deleted a file with a filename of ROMEL REPUNTE.pdf for the Bill of JRS month of August year 2018', 1742, NULL, NULL, NULL, NULL, NULL, NULL),
(1084, 'Siegfried Quimbo added a new file for voucher record, JRS invoiced date at 2018-08-09', 1743, NULL, NULL, NULL, NULL, NULL, NULL),
(1086, 'Siegfried Quimbo updated the incoming communication record of DDROS received at: 2018-08-10', 1744, NULL, NULL, NULL, NULL, NULL, NULL),
(1087, 'Siegfried Quimbo deleted the incoming communication record, name of the Sender: CITY HALL received at 2018-08-07 along with the attachment with a filename of Rizon Repunte-Certificate.pdf', 1745, NULL, NULL, NULL, NULL, NULL, NULL),
(1088, 'Siegfried Quimbo deleted the incoming communication record, name of the Sender: SAMDO received at 2018-08-10 along with the attachment with a filename of Rizon Repunte-Certificate.pdf', 1746, NULL, NULL, NULL, NULL, NULL, NULL),
(1091, 'Siegfried Quimbo deleted the file of incoming communication record, Name of sender: SAMDO received at 2018-08-10 with a filename of Rizon Repunte-Certificate.pdf', 1747, NULL, NULL, NULL, NULL, NULL, NULL),
(1092, 'Siegfried Quimbo deleted the file of incoming communication record, Name of sender: DDROS received at 2018-08-10 with a filename of PROGRAM FOR INDUCTION PARTY.pdf', 1748, NULL, NULL, NULL, NULL, NULL, NULL),
(1093, 'Siegfried Quimbo deleted the incoming communication record, Name of the Sender SAMDO received at 2018-08-10', 1749, NULL, NULL, NULL, NULL, NULL, NULL),
(1094, 'Siegfried Quimbo updated the incoming communication record of DDROS received at: 2018-08-10', 1750, NULL, NULL, NULL, NULL, NULL, NULL),
(1095, 'Siegfried Quimbo updated the information of outgoing communication record, Name of sender NBI addressed to: SAMDO, date released at 2018-08-10', 1751, NULL, NULL, NULL, NULL, NULL, NULL),
(1096, 'Siegfried Quimbo updated the information of outgoing communication record, Name of sender NBI addressed to: SAMDO, date released at 2018-08-10', 1752, NULL, NULL, NULL, NULL, NULL, NULL),
(1097, 'Siegfried Quimbo delete a record from outgoing communications, Sended to SAMDO released at 2018-08-10 along with an attachment with a filename of PROGRAM FOR INDUCTION PARTY.pdf', 1753, NULL, NULL, NULL, NULL, NULL, NULL),
(1098, 'Siegfried Quimbo deleted the file of the outgoing communication record sended to CITY HALL released at 2018-08-09', 1754, NULL, NULL, NULL, NULL, NULL, NULL),
(1099, 'Siegfried Quimbo added a new file for outgoing communication record, sended to: CITY HALL released at 2018-08-09', 1755, NULL, NULL, NULL, NULL, NULL, NULL),
(1100, 'Siegfried Quimbo deleted the file of the outgoing communication record sended to CITY HALL released at 2018-08-09', 1756, NULL, NULL, NULL, NULL, NULL, NULL),
(1102, 'Siegfried Quimbo delete a record from outgoing communications, Sended to CITY HALL released at 2018-08-09', 1757, NULL, NULL, NULL, NULL, NULL, NULL),
(1103, 'Siegfried Quimbo deleted the incoming communication record, Name of the Sender DDROS received at 2018-08-10', 1758, NULL, NULL, NULL, NULL, NULL, NULL),
(1105, 'Siegfried Quimbo deleted the file with a filename of ROMEL REPUNTE.pdf for voucher record, JRS invoiced date at, 2018-08-09', 1759, NULL, NULL, NULL, NULL, NULL, NULL),
(1106, 'Siegfried Quimbo updated the details of voucher record, LEYECO invoiced date at 2018-08-10', 1760, NULL, NULL, NULL, NULL, NULL, NULL),
(1107, 'Siegfried Quimbo updated the details of voucher record, LEYECO invoiced date at 2018-08-10', 1761, NULL, NULL, NULL, NULL, NULL, NULL),
(1109, 'Siegfried Quimbo deleted the voucher record of JRS invoiced date at 2018-08-09', 1762, NULL, NULL, NULL, NULL, NULL, NULL),
(1110, 'Siegfried Quimbo deleted the voucher record of LEYECO invoiced date at 2018-08-10', 1763, NULL, NULL, NULL, NULL, NULL, NULL),
(1111, 'Siegfried Quimbo deleted a file with a filename of ROMEL REPUNTE.pdf for the Bill of JRS month of August year 2018', 1764, NULL, NULL, NULL, NULL, NULL, NULL),
(1112, 'Siegfried Quimbo deleted the bill of JRS for the month of August, year 2018', 1765, NULL, NULL, NULL, NULL, NULL, NULL),
(1113, 'Siegfried Quimbo added a new bill with an attachment, JRS for the month of August year 2018', 1766, NULL, NULL, NULL, NULL, NULL, NULL),
(1114, 'Siegfried Quimbo deleted the bill of JRS for the month of August, year 2018 along with the attachment with a filename of Bills.pdf', 1767, NULL, NULL, NULL, NULL, NULL, NULL),
(1115, 'Siegfried Quimbo added a new bill with an attachment, JRS for the month of August year 2018', 1768, NULL, NULL, NULL, NULL, NULL, NULL),
(1116, 'Siegfried Quimbo updated the bill of JRS for the month of August, year 2018 from unpaid to paid', 1769, NULL, NULL, NULL, NULL, NULL, NULL),
(1117, 'Siegfried Quimbo added a new voucher record with an attachment, LMWD invoice date at 2018-08-10', 1770, NULL, NULL, NULL, NULL, NULL, NULL),
(1118, 'Siegfried Quimbo updated the details of voucher record, LMWD invoiced date at 2018-08-10', 1771, NULL, NULL, NULL, NULL, NULL, NULL),
(1119, 'Siegfried Quimbo updated the details of voucher record, LMWD invoiced date at 2018-08-10', 1772, NULL, NULL, NULL, NULL, NULL, NULL),
(1120, 'Siegfried Quimbo deleted the file with a filename of tracking-records.pdf for voucher record, LMWD invoiced date at, 2018-08-10', 1773, NULL, NULL, NULL, NULL, NULL, NULL),
(1121, 'Siegfried Quimbo added a new file for voucher record, LMWD invoiced date at 2018-08-10', 1774, NULL, NULL, NULL, NULL, NULL, NULL),
(1122, 'Siegfried Quimbo deleted the voucher record of LMWD invoiced date at 2018-08-10 along with the attachment with a filename of tracking-records.pdf', 1775, NULL, NULL, NULL, NULL, NULL, NULL),
(1124, 'Siegfried Quimbo deleted the incoming communication record, name of the Sender: DDROS received at 2018-08-10 along with the attachment with a filename of TroubleshootingFINAL.pdf', 1776, NULL, NULL, NULL, NULL, NULL, NULL),
(1125, 'Siegfried Quimbo added a new incoming record with an attachment, Sender: DDROS received: 2018-08-10', 1777, NULL, NULL, NULL, NULL, NULL, NULL),
(1126, 'Siegfried Quimbo deleted the incoming communication record, name of the Sender: DDROS received at 2018-08-10 along with the attachment with a filename of ROMEL REPUNTE.pdf', 1778, NULL, NULL, NULL, NULL, NULL, NULL),
(1127, 'Siegfried Quimbo updated the incoming communication record of DDROS received at: 2018-08-10', 1779, NULL, NULL, NULL, NULL, NULL, NULL),
(1128, 'Siegfried Quimbo updated the incoming communication record of DDROS received at: 2018-08-10', 1780, NULL, NULL, NULL, NULL, NULL, NULL),
(1129, 'Siegfried Quimbo deleted the file of incoming communication record, Name of sender: DDROS received at 2018-08-10 with a filename of ROMEL REPUNTE.pdf', 1781, NULL, NULL, NULL, NULL, NULL, NULL),
(1130, 'Siegfried Quimbo added a new file for incoming communication record, DDROS received date at 2018-08-10', 1782, NULL, NULL, NULL, NULL, NULL, NULL),
(1131, 'Siegfried Quimbo deleted the incoming communication record, name of the Sender: DDROS received at 2018-08-10 along with the attachment with a filename of TroubleshootingFINAL.pdf', 1783, NULL, NULL, NULL, NULL, NULL, NULL),
(1132, 'Siegfried Quimbo has logged out', 1784, NULL, NULL, NULL, NULL, NULL, 24),
(1133, 'Rizon Repunte just Logged in ', 1785, NULL, NULL, NULL, NULL, NULL, 1),
(1134, 'Rizon Repunte has logged out', 1786, NULL, NULL, NULL, NULL, NULL, 1),
(1135, 'Siegfried Quimbo just Logged in ', 1787, NULL, NULL, NULL, NULL, NULL, 24),
(1136, 'Siegfried Quimbo deleted the bill of JRS for the month of August, year 2018 along with the attachment with a filename of Bills.pdf', 1788, NULL, NULL, NULL, NULL, NULL, NULL),
(1137, 'Siegfried Quimbo has logged out', 1789, NULL, NULL, NULL, NULL, NULL, 24),
(1138, 'Rizon Repunte just Logged in ', 1790, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_administrator_code`
--

CREATE TABLE `t_administrator_code` (
  `administrator_code_id` int(11) NOT NULL,
  `administrator_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_administrator_code`
--

INSERT INTO `t_administrator_code` (`administrator_code_id`, `administrator_code`) VALUES
(2, '$2y$10$9dEarxp6NxcGwQZ.Hi6Kgu5RDI5f5znTmXl95f2oHhLCdDKqRo78S');

-- --------------------------------------------------------

--
-- Table structure for table `t_bill_info`
--

CREATE TABLE `t_bill_info` (
  `bill_id` int(11) NOT NULL,
  `payee` varchar(255) NOT NULL,
  `bill_month` varchar(255) NOT NULL,
  `bill_year` year(4) NOT NULL,
  `date_receive` date NOT NULL,
  `bill_amount` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `receipt_no` varchar(255) NOT NULL,
  `status_id` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `t_bill_status`
--

CREATE TABLE `t_bill_status` (
  `status_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_bill_status`
--

INSERT INTO `t_bill_status` (`status_id`, `status`) VALUES
(1, 'paid'),
(2, 'unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `t_files`
--

CREATE TABLE `t_files` (
  `file_id` int(11) NOT NULL,
  `bill_id` int(11) DEFAULT NULL,
  `incoming_id` int(11) DEFAULT NULL,
  `outgoing_id` int(11) DEFAULT NULL,
  `voucher_id` int(11) DEFAULT NULL,
  `filename` varchar(255) NOT NULL,
  `filetype` varchar(20) NOT NULL,
  `filesize` int(11) NOT NULL,
  `filepath` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_incoming`
--

CREATE TABLE `t_incoming` (
  `incoming_id` int(11) NOT NULL,
  `incoming_sender` varchar(255) NOT NULL,
  `incoming_addressee` varchar(255) NOT NULL,
  `date_received` date NOT NULL,
  `scheduled_event` date NOT NULL,
  `incoming_reference_number` int(11) NOT NULL,
  `incoming_remarks` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_logs`
--

CREATE TABLE `t_logs` (
  `log_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `log_date` date NOT NULL,
  `log_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_logs`
--

INSERT INTO `t_logs` (`log_id`, `user_id`, `log_date`, `log_time`) VALUES
(1689, 24, '2018-08-09', '09:02:21'),
(1690, 1, '2018-08-09', '09:04:23'),
(1691, 1, '2018-08-09', '09:05:10'),
(1692, 1, '2018-08-09', '09:05:52'),
(1693, 1, '2018-08-09', '09:06:29'),
(1694, 1, '2018-08-09', '09:07:24'),
(1695, 24, '2018-08-09', '09:08:24'),
(1696, 24, '2018-08-09', '09:15:02'),
(1697, 24, '2018-08-09', '09:18:16'),
(1698, 24, '2018-08-10', '07:11:02'),
(1699, 24, '2018-08-10', '07:11:40'),
(1700, 24, '2018-08-10', '07:15:08'),
(1701, 24, '2018-08-10', '07:24:31'),
(1702, 24, '2018-08-10', '08:57:57'),
(1703, 24, '2018-08-10', '09:01:03'),
(1704, 24, '2018-08-10', '09:27:09'),
(1705, 24, '2018-08-10', '09:27:14'),
(1706, 24, '2018-08-10', '09:27:36'),
(1707, 24, '2018-08-10', '09:41:39'),
(1708, 24, '2018-08-10', '10:04:43'),
(1709, 24, '2018-08-10', '10:31:26'),
(1710, 24, '2018-08-10', '10:34:06'),
(1711, 24, '2018-08-10', '10:46:55'),
(1712, 24, '2018-08-10', '10:47:52'),
(1713, 24, '2018-08-10', '10:48:07'),
(1714, 24, '2018-08-10', '10:55:12'),
(1715, 24, '2018-08-10', '11:13:25'),
(1716, 24, '2018-08-10', '11:14:52'),
(1717, 24, '2018-08-10', '11:22:47'),
(1718, 24, '2018-08-10', '11:28:44'),
(1719, 24, '2018-08-10', '11:41:49'),
(1720, 24, '2018-08-10', '11:41:49'),
(1721, 24, '2018-08-10', '11:42:00'),
(1722, 24, '2018-08-10', '11:42:00'),
(1723, 24, '2018-08-10', '11:43:03'),
(1724, 24, '2018-08-10', '11:43:03'),
(1725, 24, '2018-08-10', '11:43:50'),
(1726, 24, '2018-08-10', '11:44:40'),
(1727, 24, '2018-08-10', '11:45:05'),
(1728, 24, '2018-08-10', '11:46:33'),
(1729, 24, '2018-08-10', '11:55:21'),
(1730, 24, '2018-08-10', '11:58:41'),
(1731, 24, '2018-08-10', '11:58:51'),
(1732, 24, '2018-08-10', '11:59:02'),
(1733, 24, '2018-08-10', '12:00:02'),
(1734, 24, '2018-08-10', '12:12:15'),
(1735, 24, '2018-08-10', '12:12:45'),
(1736, 24, '2018-08-10', '12:16:29'),
(1737, 24, '2018-08-10', '12:36:50'),
(1738, 24, '2018-08-10', '12:37:01'),
(1739, 24, '2018-08-10', '12:40:07'),
(1740, 24, '2018-08-10', '12:40:33'),
(1741, 24, '2018-08-10', '12:41:41'),
(1742, 24, '2018-08-10', '12:44:25'),
(1743, 24, '2018-08-10', '12:48:22'),
(1744, 24, '2018-08-10', '12:55:48'),
(1745, 24, '2018-08-10', '01:05:18'),
(1746, 24, '2018-08-10', '01:05:31'),
(1747, 24, '2018-08-10', '01:12:02'),
(1748, 24, '2018-08-10', '01:12:17'),
(1749, 24, '2018-08-10', '01:36:52'),
(1750, 24, '2018-08-10', '01:37:06'),
(1751, 24, '2018-08-10', '01:41:29'),
(1752, 24, '2018-08-10', '01:41:35'),
(1753, 24, '2018-08-10', '01:43:59'),
(1754, 24, '2018-08-10', '01:46:17'),
(1755, 24, '2018-08-10', '01:46:25'),
(1756, 24, '2018-08-10', '01:46:41'),
(1757, 24, '2018-08-10', '01:48:29'),
(1758, 24, '2018-08-10', '01:48:42'),
(1759, 24, '2018-08-10', '01:50:02'),
(1760, 24, '2018-08-10', '01:50:13'),
(1761, 24, '2018-08-10', '01:50:18'),
(1762, 24, '2018-08-10', '01:52:12'),
(1763, 24, '2018-08-10', '01:52:22'),
(1764, 24, '2018-08-10', '01:53:00'),
(1765, 24, '2018-08-10', '01:53:07'),
(1766, 24, '2018-08-10', '01:53:36'),
(1767, 24, '2018-08-10', '01:53:45'),
(1768, 24, '2018-08-10', '01:54:10'),
(1769, 24, '2018-08-10', '01:54:36'),
(1770, 24, '2018-08-10', '01:55:01'),
(1771, 24, '2018-08-10', '01:55:08'),
(1772, 24, '2018-08-10', '01:55:13'),
(1773, 24, '2018-08-10', '01:55:19'),
(1774, 24, '2018-08-10', '01:55:25'),
(1775, 24, '2018-08-10', '01:55:35'),
(1776, 24, '2018-08-10', '01:57:53'),
(1777, 24, '2018-08-10', '01:58:47'),
(1778, 24, '2018-08-10', '01:59:05'),
(1779, 24, '2018-08-10', '01:59:12'),
(1780, 24, '2018-08-10', '01:59:17'),
(1781, 24, '2018-08-10', '01:59:21'),
(1782, 24, '2018-08-10', '01:59:30'),
(1783, 24, '2018-08-10', '01:59:37'),
(1784, 24, '2018-08-10', '02:03:55'),
(1785, 1, '2018-08-10', '02:03:59'),
(1786, 1, '2018-08-10', '02:04:05'),
(1787, 24, '2018-08-10', '02:04:09'),
(1788, 24, '2018-08-10', '02:04:14'),
(1789, 24, '2018-08-10', '02:04:19'),
(1790, 1, '2018-08-10', '02:04:22');

-- --------------------------------------------------------

--
-- Table structure for table `t_outgoing`
--

CREATE TABLE `t_outgoing` (
  `outgoing_id` int(25) NOT NULL,
  `outgoing_sender` varchar(255) NOT NULL,
  `outgoing_addressee` varchar(255) NOT NULL,
  `date_released` date NOT NULL,
  `outgoing_reference_number` int(11) NOT NULL,
  `outgoing_remarks` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_role`
--

CREATE TABLE `t_role` (
  `role_id` int(11) NOT NULL,
  `role_type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_role`
--

INSERT INTO `t_role` (`role_id`, `role_type`) VALUES
(1, 'Administrator'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `t_status`
--

CREATE TABLE `t_status` (
  `user_status_id` int(25) NOT NULL,
  `user_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_status`
--

INSERT INTO `t_status` (`user_status_id`, `user_status`) VALUES
(1, 'active'),
(2, 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `office_position` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`user_id`, `username`, `password`, `fname`, `mname`, `lname`, `office_position`, `role_id`, `user_status_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Rizon', 'Ercilla', 'Repunte', 'Administrative Office Clerk II', 1, 1),
(22, 'errol', '3c373db6a5cad964a0289a1765d577d9', 'Errol', 'Operaria', 'Abella', 'Technician', 2, 2),
(24, 'sieg', '6ae357dc98f739341238fc52aea9d00d', 'Siegfried', 'Caande', 'Quimbo', 'Admin Aide II', 2, 1),
(25, 'segundina', '469299624fcdcd4f173430ceff0bc896', 'Ako', 'L.', 'Piangco', 'Administrative Office Clerk', 2, 2),
(26, 'angel', 'f4f068e71e0d87bf0ad51e6214ab84e9', 'Angelika', 'Ercilla', 'Repunte', 'Admin Aide I', 2, 2),
(27, 'NoraAlvarez', 'e83ccc252563749415560b057599bb5b', 'Nora', 'C.', 'Alvarez', 'Administrative Office Clerk', 2, 1),
(28, 'segundina', '469299624fcdcd4f173430ceff0bc896', 'Segundina', 'L.', 'Piangco', 'Administrative Office Clerk II', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_voucher_info`
--

CREATE TABLE `t_voucher_info` (
  `voucher_id` int(25) NOT NULL,
  `payee` varchar(255) NOT NULL,
  `invoice_date` date NOT NULL,
  `invoice_amount` int(25) NOT NULL,
  `particulars` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_activity`
--
ALTER TABLE `t_activity`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `t_activity_ibfk_2` (`file_id`),
  ADD KEY `voucher_id` (`voucher_id`),
  ADD KEY `incoming_id` (`incoming_id`),
  ADD KEY `outgoing_id` (`outgoing_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `log_id` (`log_id`);

--
-- Indexes for table `t_administrator_code`
--
ALTER TABLE `t_administrator_code`
  ADD PRIMARY KEY (`administrator_code_id`);

--
-- Indexes for table `t_bill_info`
--
ALTER TABLE `t_bill_info`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `t_bill_status`
--
ALTER TABLE `t_bill_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `t_files`
--
ALTER TABLE `t_files`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `t_files_ibfk_1` (`bill_id`),
  ADD KEY `voucher_id` (`voucher_id`),
  ADD KEY `incoming_id` (`incoming_id`),
  ADD KEY `outgoing_id` (`outgoing_id`);

--
-- Indexes for table `t_incoming`
--
ALTER TABLE `t_incoming`
  ADD PRIMARY KEY (`incoming_id`);

--
-- Indexes for table `t_logs`
--
ALTER TABLE `t_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `t_outgoing`
--
ALTER TABLE `t_outgoing`
  ADD PRIMARY KEY (`outgoing_id`);

--
-- Indexes for table `t_role`
--
ALTER TABLE `t_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `t_status`
--
ALTER TABLE `t_status`
  ADD PRIMARY KEY (`user_status_id`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `user_status_id` (`user_status_id`);

--
-- Indexes for table `t_voucher_info`
--
ALTER TABLE `t_voucher_info`
  ADD PRIMARY KEY (`voucher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_activity`
--
ALTER TABLE `t_activity`
  MODIFY `activity_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1139;
--
-- AUTO_INCREMENT for table `t_administrator_code`
--
ALTER TABLE `t_administrator_code`
  MODIFY `administrator_code_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_bill_info`
--
ALTER TABLE `t_bill_info`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `t_bill_status`
--
ALTER TABLE `t_bill_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_files`
--
ALTER TABLE `t_files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `t_incoming`
--
ALTER TABLE `t_incoming`
  MODIFY `incoming_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `t_logs`
--
ALTER TABLE `t_logs`
  MODIFY `log_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1791;
--
-- AUTO_INCREMENT for table `t_outgoing`
--
ALTER TABLE `t_outgoing`
  MODIFY `outgoing_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `t_role`
--
ALTER TABLE `t_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_status`
--
ALTER TABLE `t_status`
  MODIFY `user_status_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `t_voucher_info`
--
ALTER TABLE `t_voucher_info`
  MODIFY `voucher_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_activity`
--
ALTER TABLE `t_activity`
  ADD CONSTRAINT `t_activity_ibfk_2` FOREIGN KEY (`file_id`) REFERENCES `t_files` (`file_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `t_activity_ibfk_3` FOREIGN KEY (`voucher_id`) REFERENCES `t_voucher_info` (`voucher_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `t_activity_ibfk_4` FOREIGN KEY (`incoming_id`) REFERENCES `t_incoming` (`incoming_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `t_activity_ibfk_5` FOREIGN KEY (`outgoing_id`) REFERENCES `t_outgoing` (`outgoing_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `t_activity_ibfk_6` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `t_activity_ibfk_7` FOREIGN KEY (`log_id`) REFERENCES `t_logs` (`log_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_activity_ibfk_8` FOREIGN KEY (`bill_id`) REFERENCES `t_bill_info` (`bill_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `t_bill_info`
--
ALTER TABLE `t_bill_info`
  ADD CONSTRAINT `t_bill_info_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `t_bill_status` (`status_id`);

--
-- Constraints for table `t_files`
--
ALTER TABLE `t_files`
  ADD CONSTRAINT `t_files_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `t_bill_info` (`bill_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_files_ibfk_2` FOREIGN KEY (`voucher_id`) REFERENCES `t_voucher_info` (`voucher_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_files_ibfk_3` FOREIGN KEY (`incoming_id`) REFERENCES `t_incoming` (`incoming_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_files_ibfk_4` FOREIGN KEY (`outgoing_id`) REFERENCES `t_outgoing` (`outgoing_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_logs`
--
ALTER TABLE `t_logs`
  ADD CONSTRAINT `t_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `t_user`
--
ALTER TABLE `t_user`
  ADD CONSTRAINT `t_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `t_role` (`role_id`),
  ADD CONSTRAINT `t_user_ibfk_2` FOREIGN KEY (`user_status_id`) REFERENCES `t_status` (`user_status_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
