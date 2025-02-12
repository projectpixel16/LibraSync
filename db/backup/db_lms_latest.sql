-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2025 at 04:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `confirm_password` varchar(100) NOT NULL,
  `admin_image` varchar(100) NOT NULL,
  `admin_type` varchar(100) NOT NULL,
  `admin_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `confirm_password`, `admin_image`, `admin_type`, `admin_added`) VALUES
(1, 'Jane', 'M.', 'Doe', 'admin', 'admin', 'admin', '', 'Admin', '2015-09-05 11:40:50'),
(2, 'John', 'J.', 'Doe', 'encoder', 'encoder', 'encoder', '', 'Encoder', '2015-09-29 11:40:50'),
(3, 'Anonymous', 'Anonymous', 'Anonymous', 'anonymous', 'anonymous', 'anonymous', '', 'Encoder', '2015-11-25 15:21:01');

-- --------------------------------------------------------

--
-- Table structure for table `allowed_book`
--

CREATE TABLE `allowed_book` (
  `allowed_book_id` int(11) NOT NULL,
  `qntty_books` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `allowed_book`
--

INSERT INTO `allowed_book` (`allowed_book_id`, `qntty_books`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `allowed_days`
--

CREATE TABLE `allowed_days` (
  `allowed_days_id` int(11) NOT NULL,
  `no_of_days` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `allowed_days`
--

INSERT INTO `allowed_days` (`allowed_days_id`, `no_of_days`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `barcode`
--

CREATE TABLE `barcode` (
  `barcode_id` int(11) NOT NULL,
  `pre_barcode` varchar(100) NOT NULL,
  `mid_barcode` int(100) NOT NULL,
  `suf_barcode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `barcode`
--

INSERT INTO `barcode` (`barcode_id`, `pre_barcode`, `mid_barcode`, `suf_barcode`) VALUES
(1, 'RMSML', 1, 'LMS'),
(2, 'RMSML', 2, 'LMS'),
(3, 'RMSML', 3, 'LMS'),
(4, 'RMSML', 4, 'LMS'),
(5, 'RMSML', 5, 'LMS'),
(6, 'RMSML', 6, 'LMS'),
(7, 'RMSML', 7, 'LMS');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `book_title` varchar(100) NOT NULL,
  `category_id` int(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `author_2` varchar(100) NOT NULL,
  `author_3` varchar(100) NOT NULL,
  `author_4` varchar(100) NOT NULL,
  `author_5` varchar(100) NOT NULL,
  `book_copies` int(11) NOT NULL,
  `book_pub` varchar(100) NOT NULL,
  `publisher_name` varchar(100) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `copyright_year` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `book_barcode` varchar(100) NOT NULL,
  `book_image` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL,
  `remarks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `book_title`, `category_id`, `author`, `author_2`, `author_3`, `author_4`, `author_5`, `book_copies`, `book_pub`, `publisher_name`, `isbn`, `copyright_year`, `status`, `book_barcode`, `book_image`, `date_added`, `remarks`) VALUES
(1, 'English Expressways : Second Year', 1, 'Virginia F. Bermudez', 'Remedios F. Nery', 'Josephine M. Cruz', 'Milagrosa A. San Juan', '', 15, '2010', 'SD Publications, INC.', '978-971-0315-72-7', 2010, 'Old', 'RMSML1LMS', 'IMG_0019.JPG', '2015-12-14 01:06:46', 'Available'),
(2, 'DAYBOOK of Critical Reading and Writing', 8, 'Fran Claggett', 'Louann Reid', 'Ruth Vinz', '', '', 20, '1978', 'Doubleday Canada Limited', '0-669-46432-5', 1978, 'Old', 'RMSML2LMS', 'IMG_0006 - Copy.JPG', '2015-12-14 01:11:06', 'Available'),
(3, 'Getting to Know-Puerto Rico', 2, 'Frances Robins', '', '', '', '', 1, 'Coward-McCann', '1967', '', 0, 'Old', 'RMSML3LMS', '', '2015-12-14 01:21:47', 'Available'),
(4, 'Lotta on Troublemaker Street', 2, 'Astrid Lindgren', '', '', '', '', 0, 'Aladdin Paperbacks', '2001', '0-689-84673-8', 1962, 'Replacement', 'RMSML4LMS', '', '2015-12-14 01:43:06', 'Not Available'),
(5, 'Great Days of Whailing', 8, 'Henry Beetle Hough', '', '', '', '', 1, '', '', '', 0, 'Damaged', 'RMSML5LMS', '', '2015-12-14 02:05:16', 'Not Available'),
(6, 'Even Big Guys Cry', 2, 'Alex Karras', '', '', '', '', 1, '', '', '', 0, 'Lost', 'RMSML6LMS', '', '2015-12-14 02:05:47', 'Not Available'),
(7, 'Gintong Pamana Wika at Panitikan - Ikalawang Taon', 6, 'Lolita R. Nakpil', 'Leticia F. Dominguez', '', '', '', 11, '2000', 'SD Publications, INC.', '971-07-1885-1', 2000, 'Old', 'RMSML7LMS', 'IMG_0029 - Copy.JPG', '2015-12-14 02:20:36', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `borrow_book`
--

CREATE TABLE `borrow_book` (
  `borrow_book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `date_borrowed` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `date_returned` datetime NOT NULL,
  `pickup_date` varchar(25) DEFAULT NULL,
  `borrowed_status` varchar(100) NOT NULL,
  `book_penalty` varchar(100) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1-accepted,2-declined'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `borrow_book`
--

INSERT INTO `borrow_book` (`borrow_book_id`, `user_id`, `book_id`, `date_borrowed`, `due_date`, `date_returned`, `pickup_date`, `borrowed_status`, `book_penalty`, `status`) VALUES
(1, 2, 7, '2015-11-14 02:50:27', '2015-11-17 02:50:27', '2015-12-14 02:57:34', NULL, 'returned', '27', 0),
(2, 1, 7, '2015-11-14 02:50:58', '2015-11-17 02:50:58', '2015-12-14 02:57:37', NULL, 'returned', '27', 0),
(3, 4, 7, '2015-12-14 02:51:59', '2015-12-17 02:51:59', '2015-12-14 02:57:45', NULL, 'returned', 'No Penalty', 0),
(4, 4, 3, '2015-12-14 02:53:15', '2015-12-17 02:53:15', '2015-12-14 02:57:48', NULL, 'returned', 'No Penalty', 0),
(5, 17, 7, '2015-12-14 03:08:49', '2015-12-17 03:08:49', '0000-00-00 00:00:00', NULL, 'borrowed', '', 0),
(6, 4, 7, '2015-12-14 03:08:59', '2015-12-17 03:08:59', '0000-00-00 00:00:00', NULL, 'borrowed', '', 0),
(7, 20, 7, '2015-12-14 03:09:07', '2015-12-17 03:09:07', '0000-00-00 00:00:00', NULL, 'borrowed', '', 0),
(8, 14, 4, '2015-12-14 08:32:14', '2015-12-17 08:32:14', '0000-00-00 00:00:00', NULL, 'borrowed', '', 0),
(9, 41, 7, '2025-02-04 23:12:17', '2025-02-07 23:12:17', '2025-02-09 23:14:06', NULL, 'returned', '40', 0),
(10, 41, 7, '2025-02-05 22:01:26', '2025-02-08 22:01:26', '2025-02-05 22:02:12', NULL, 'returned', 'No Penalty', 0),
(11, 41, 7, '2025-02-06 22:00:58', '2025-02-09 22:00:58', '0000-00-00 00:00:00', NULL, 'borrowed', '', 1),
(12, 41, 3, '2025-02-06 22:40:44', '2025-02-09 22:40:44', '2025-02-06 22:54:20', NULL, 'returned', 'No Penalty', 1),
(13, 41, 3, '2025-02-06 22:55:07', '2025-02-09 22:57:05', '2025-02-06 22:58:10', NULL, 'returned', 'No Penalty', 1),
(14, 41, 3, '2025-02-06 22:58:52', '2025-02-09 22:59:36', '2025-02-06 23:00:08', NULL, 'returned', 'No Penalty', 1),
(15, 41, 3, '2025-02-06 23:00:17', '2025-02-09 23:04:18', '2025-02-06 23:07:46', NULL, 'returned', 'No Penalty', 1),
(16, 41, 3, '2025-02-06 23:08:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'declined', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `classname` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `classname`) VALUES
(1, 'Textbook'),
(2, 'English'),
(3, 'Math'),
(4, 'Science'),
(5, 'Encyclopedia'),
(6, 'Filipiniana'),
(7, 'Novel'),
(8, 'General'),
(9, 'References');

-- --------------------------------------------------------

--
-- Table structure for table `penalty`
--

CREATE TABLE `penalty` (
  `penalty_id` int(11) NOT NULL,
  `penalty_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `penalty`
--

INSERT INTO `penalty` (`penalty_id`, `penalty_amount`) VALUES
(1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `detail_action` varchar(100) NOT NULL,
  `date_transaction` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `book_id`, `user_id`, `admin_name`, `detail_action`, `date_transaction`) VALUES
(1, 7, 2, 'Jane M. Doe', 'Borrowed Book', '2015-12-14 02:50:30'),
(2, 7, 1, 'Jane M. Doe', 'Borrowed Book', '2015-12-14 02:51:00'),
(3, 7, 4, 'Jane M. Doe', 'Borrowed Book', '2015-12-14 02:52:01'),
(4, 3, 4, 'Jane M. Doe', 'Borrowed Book', '2015-12-14 02:53:16'),
(5, 7, 2, 'Jane M. Doe', 'Returned Book', '2015-12-14 02:57:34'),
(6, 7, 1, 'Jane M. Doe', 'Returned Book', '2015-12-14 02:57:37'),
(7, 7, 4, 'Jane M. Doe', 'Returned Book', '2015-12-14 02:57:45'),
(8, 3, 4, 'Jane M. Doe', 'Returned Book', '2015-12-14 02:57:48'),
(9, 7, 17, 'Jane M. Doe', 'Borrowed Book', '2015-12-14 03:08:51'),
(10, 7, 4, 'Jane M. Doe', 'Borrowed Book', '2015-12-14 03:09:01'),
(11, 7, 20, 'Jane M. Doe', 'Borrowed Book', '2015-12-14 03:09:08'),
(12, 4, 14, 'Jane M. Doe', 'Borrowed Book', '2015-12-14 08:32:16'),
(13, 7, 41, 'Jane M. Doe', 'Borrowed Book', '2025-02-04 23:12:37'),
(14, 7, 41, 'Jane M. Doe', 'Returned Book', '2025-02-09 23:14:07'),
(15, 7, 41, 'Jane M. Doe', 'Borrowed Book', '2025-02-05 22:01:33'),
(16, 7, 41, 'Jane M. Doe', 'Returned Book', '2025-02-05 22:02:12'),
(17, 7, 41, 'Jane M. Doe', 'Borrowed Book', '2025-02-06 22:40:08'),
(18, 3, 41, 'Jane M. Doe', 'Borrowed Book', '2025-02-06 22:40:58'),
(19, 3, 41, 'Jane M. Doe', 'Returned Book', '2025-02-06 22:54:20'),
(20, 3, 41, 'Jane M. Doe', 'Borrowed Book', '2025-02-06 22:57:36'),
(21, 3, 41, 'Jane M. Doe', 'Returned Book', '2025-02-06 22:58:10'),
(22, 3, 41, 'Jane M. Doe', 'Borrowed Book', '2025-02-06 22:59:54'),
(23, 3, 41, 'Jane M. Doe', 'Returned Book', '2025-02-06 23:00:08'),
(24, 3, 41, 'Jane M. Doe', 'Borrowed Book', '2025-02-06 23:04:23'),
(25, 3, 41, 'Jane M. Doe', 'Returned Book', '2025-02-06 23:07:46');

-- --------------------------------------------------------

--
-- Table structure for table `return_book`
--

CREATE TABLE `return_book` (
  `return_book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `date_borrowed` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `date_returned` datetime NOT NULL,
  `book_penalty` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `return_book`
--

INSERT INTO `return_book` (`return_book_id`, `user_id`, `book_id`, `date_borrowed`, `due_date`, `date_returned`, `book_penalty`) VALUES
(1, 2, 7, '2015-11-14 02:50:27', '2015-11-17 02:50:27', '2015-12-14 02:57:31', '27'),
(2, 1, 7, '2015-11-14 02:50:58', '2015-11-17 02:50:58', '2015-12-14 02:57:30', '27'),
(3, 4, 7, '2015-12-14 02:51:59', '2015-12-17 02:51:59', '2015-12-13 02:57:29', 'No Penalty'),
(4, 4, 3, '2015-12-14 02:53:15', '2015-12-17 02:53:15', '2015-12-14 02:57:45', 'No Penalty'),
(5, 41, 7, '2025-02-04 23:12:17', '2025-02-07 23:12:17', '2025-02-09 23:13:58', '40'),
(6, 41, 7, '2025-02-05 22:01:26', '2025-02-08 22:01:26', '2025-02-05 22:02:07', 'No Penalty'),
(7, 41, 3, '2025-02-06 22:40:44', '2025-02-09 22:40:44', '2025-02-06 22:54:16', 'No Penalty'),
(8, 41, 3, '2025-02-06 22:55:07', '2025-02-09 22:57:05', '2025-02-06 22:58:07', 'No Penalty'),
(9, 41, 3, '2025-02-06 22:58:52', '2025-02-09 22:59:36', '2025-02-06 23:00:06', 'No Penalty'),
(10, 41, 3, '2025-02-06 23:00:17', '2025-02-09 23:04:18', '2025-02-06 23:07:44', 'No Penalty');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `school_number` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `section` varchar(100) NOT NULL,
  `user_image` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `user_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `school_number`, `firstname`, `middlename`, `lastname`, `contact`, `gender`, `address`, `type`, `level`, `section`, `user_image`, `status`, `password`, `email`, `user_added`) VALUES
(1, '117504060067', 'KERVIN KARL', 'OSORIO', 'CABUS', '', 'Male', 'PALOMA, BACOLOD', 'Student', 'Grade 9', 'Antimony', '', 'Active', NULL, NULL, '2015-12-14 02:47:56'),
(2, '117429060061', 'RONALD', 'PANIERGO', 'FLORES', '', 'Male', 'PALOMA, BACOLOD', 'Student', 'Grade 9', 'Antimony', '', 'Active', NULL, NULL, '2015-12-14 02:47:56'),
(3, '117427060036', 'GERALD', 'MANOSO', 'PELINGON', '', 'Male', 'PACOL, BACOLOD', 'Student', 'Grade 9', 'Antimony', '', 'Active', NULL, NULL, '2015-12-14 02:47:56'),
(4, '117429060130', 'RAM CHRISTIAN', 'DAYOT', 'PENUELA', '', 'Male', 'POBLACION, BACOLOD', 'Student', 'Grade 9', 'Antimony', '', 'Active', NULL, NULL, '2015-12-14 02:47:56'),
(5, '117429060132', 'JAN MICHAEL', 'ALABE', 'PORCEL', '', 'Male', 'POBLACION, BACOLOD', 'Student', 'Grade 9', 'Antimony', '', 'Active', NULL, NULL, '2015-12-14 02:47:56'),
(6, '117425060048', 'ROSIE', 'DE LA CRUZ', 'PELINGON', '', 'Female', 'MABINI, BACOLOD', 'Student', 'Grade 9', 'Antimony', '', 'Active', NULL, NULL, '2015-12-14 02:47:57'),
(7, '117425060051', 'ANDRIA', 'CASIANO', 'PIT', '', 'Female', 'MABINI, BACOLOD', 'Student', 'Grade 9', 'Antimony', '', 'Active', NULL, NULL, '2015-12-14 02:47:57'),
(8, '302694140043', 'ANGELA', 'CASTILLO', 'REJAS', '', 'Female', 'MABINI, PULUPANDAN', 'Student', 'Grade 9', 'Antimony', '', 'Active', NULL, NULL, '2015-12-14 02:47:57'),
(9, '117422060063', 'ROWELA', 'UNTAL', 'ROGERO', '', 'Female', 'DOLDOL, BACOLOD', 'Student', 'Grade 9', 'Antimony', '', 'Active', NULL, NULL, '2015-12-14 02:47:57'),
(10, '117425060056', 'REGINE', 'DOMINGUEZ', 'SALANATIN', '', 'Female', 'MABINI, BACOLOD', 'Student', 'Grade 9', 'Antimony', '', 'Active', NULL, NULL, '2015-12-14 02:47:57'),
(11, '115856050005', 'JOHN MARK', 'PAMPLIEGA', 'CASTEN', '', 'Male', 'PALAKA SUR, PULUPANDAN', 'Student', 'Grade 10', 'Amethyst', '', 'Active', NULL, NULL, '2015-12-14 02:47:57'),
(12, '117425050023', 'SUNDAY', 'HECHANOVA', 'FELIPE', '', 'Male', 'MABINI, BACOLOD', 'Student', 'Grade 10', 'Amethyst', '', 'Active', NULL, NULL, '2015-12-14 02:47:57'),
(13, '117425050025', 'JOEMAR', 'MENDOZA', 'FRANCISCO', '', 'Male', 'MABINI, BACOLOD', 'Student', 'Grade 10', 'Amethyst', '', 'Active', NULL, NULL, '2015-12-14 02:47:57'),
(14, '117429050043', 'CHRISTOPHER', 'ARGUELLES', 'FRIAS', '', 'Male', 'TANDANG SORA, QUEZON CITY', 'Student', 'Grade 10', 'Amethyst', '', 'Active', NULL, NULL, '2015-12-14 02:47:58'),
(15, '117429050044', 'REYNAN', 'DATULAYTA', 'GABALES', '', 'Male', 'PALAKA, BACOLOD', 'Student', 'Grade 10', 'Amethyst', '', 'Active', NULL, NULL, '2015-12-14 02:47:58'),
(16, '117422050037', 'RATCHEL', 'YANOS', 'GALVAN', '', 'Female', 'BAYABAS, BACOLOD', 'Student', 'Grade 10', 'Amethyst', '', 'Active', NULL, NULL, '2015-12-14 02:47:58'),
(17, '302694140009', 'CRISTY GAYLE', 'CADAYDAY', 'GOSIAOCO', '', 'Female', 'SAGUA BANUA, BACOLOD', 'Student', 'Grade 10', 'Amethyst', '', 'Active', NULL, NULL, '2015-12-14 02:47:58'),
(18, '117324050063', 'ROZEL CHILES', 'PALMA', 'JANDOG', '', 'Female', 'PALAKA, BACOLOD', 'Student', 'Grade 10', 'Amethyst', '', 'Active', NULL, NULL, '2015-12-14 02:47:58'),
(19, '117429050063', 'MARY BERYL', 'TULMO', 'LUMAPAN', '', 'Female', 'POBLACION, BACOLOD', 'Student', 'Grade 10', 'Amethyst', '', 'Active', NULL, NULL, '2015-12-14 02:47:58'),
(20, '117429050066', 'REGINA MARIE', 'DELAPER', 'MACHAN', '', 'Female', 'POBLACION, BACOLOD', 'Student', 'Grade 10', 'Amethyst', '', 'Active', NULL, NULL, '2015-12-14 02:47:58'),
(21, '117427080005', 'MARLON', 'GAJO', 'BALANGAO', '', 'Male', 'PACOL, BACOLOD', 'Student', 'Grade 7', 'Earth', '', 'Active', NULL, NULL, '2015-12-14 08:35:58'),
(22, '117321080006', 'KENNETH', 'JUANEZA', 'BENIT', '', 'Male', 'PALAKA SUR, PULUPANDAN', 'Student', 'Grade 7', 'Earth', '', 'Active', NULL, NULL, '2015-12-14 08:35:58'),
(23, '117429080037', 'MARK ANGELO', 'BOJOS', 'CAMACHO', '', 'Male', 'POBLACION, BACOLOD', 'Student', 'Grade 7', 'Earth', '', 'Active', NULL, NULL, '2015-12-14 08:35:58'),
(24, '117321080009', 'RGEE LOUIZE', 'ESTARES', 'DELIMA', '', 'Male', 'PALAKA SUR, PULUPANDAN', 'Student', 'Grade 7', 'Earth', '', 'Active', NULL, NULL, '2015-12-14 08:35:58'),
(25, '117321080014', 'JOEZER COLENE', 'LEGIRO', 'GALIMBA', '', 'Male', 'PALAKA SUR, PULUPANDAN', 'Student', 'Grade 7', 'Earth', '', 'Active', NULL, NULL, '2015-12-14 08:35:58'),
(26, '117427080001', 'JULIAH', 'ARANGOTE', 'ABEDONG', '', 'Female', 'PACOL, BACOLOD', 'Student', 'Grade 7', 'Earth', '', 'Active', NULL, NULL, '2015-12-14 08:35:59'),
(27, '117321080002', 'CHRISTINE MAE', 'SALAZAR', 'ABETO', '', 'Female', 'PALAKA SUR, PULUPANDAN', 'Student', 'Grade 7', 'Earth', '', 'Active', NULL, NULL, '2015-12-14 08:35:59'),
(28, '117427080002', 'NICOLE ANN', 'PAGSUBERON', 'ABILGOS', '', 'Female', 'PACOL, BACOLOD', 'Student', 'Grade 7', 'Earth', '', 'Active', NULL, NULL, '2015-12-14 08:35:59'),
(29, '117425080013', 'JANESSA', 'DOROTEO', 'ARGUELLES', '', 'Female', 'MABINI, BACOLOD', 'Student', 'Grade 7', 'Earth', '', 'Active', NULL, NULL, '2015-12-14 08:35:59'),
(30, '117429080020', 'MARNYL', 'DUNLAO', 'BACOLINA', '', 'Female', 'PALAKA, BACOLOD', 'Student', 'Grade 7', 'Earth', '', 'Active', NULL, NULL, '2015-12-14 08:36:00'),
(31, '117320070006', 'REXXER ANDREI', 'DE LOS SANTOS', 'BELEBER', '', 'Male', 'MABINI, PULUPANDAN', 'Student', 'Grade 8', 'Charity', '', 'Active', NULL, NULL, '2015-12-14 08:36:00'),
(32, '117422070016', 'JOSHUA', 'SUICO', 'CARPENTERO', '', 'Male', 'ALIJIS, BACOLOD', 'Student', 'Grade 8', 'Charity', '', 'Active', NULL, NULL, '2015-12-14 08:36:00'),
(33, '117429070043', 'JERSON', 'PIDO', 'DAMPOG', '', 'Male', 'PALAKA, BACOLOD', 'Student', 'Grade 8', 'Charity', '', 'Active', NULL, NULL, '2015-12-14 08:36:00'),
(34, '117425070018', 'JESS LORD', 'ARROYO', 'DE LA CRUZ', '', 'Male', 'MABINI, PULUPANDAN', 'Student', 'Grade 8', 'Charity', '', 'Active', NULL, NULL, '2015-12-14 08:36:00'),
(35, '117422070022', 'RALPH JERO', 'CENTINO', 'DEMERIN', '', 'Male', 'ALIJIS, BACOLOD', 'Student', 'Grade 8', 'Charity', '', 'Active', NULL, NULL, '2015-12-14 08:36:00'),
(36, '117427070001', 'TRESHIA', 'SALVANTE', 'ABENIR', '', 'Female', 'PACOL, BACOLOD', 'Student', 'Grade 8', 'Charity', '', 'Active', NULL, NULL, '2015-12-14 08:36:00'),
(37, '117321070003', 'MA THERESA MAE', 'CORDOVA', 'ALLES', '', 'Female', 'PALAKA, BACOLOD', 'Student', 'Grade 8', 'Charity', '', 'Active', NULL, NULL, '2015-12-14 08:36:01'),
(38, '117429070018', 'ELLA MARIE', 'MARTENECIO', 'ALVAREZ', '', 'Female', 'PALAKA, BACOLOD', 'Student', 'Grade 8', 'Charity', '', 'Active', NULL, NULL, '2015-12-14 08:36:01'),
(39, '117422070005', 'LOVELY ANN', 'YUBARA', 'AMAR', '', 'Female', 'BAYABAS, BACOLOD', 'Student', 'Grade 8', 'Charity', '', 'Active', NULL, NULL, '2015-12-14 08:36:01'),
(40, '117479070029', 'CRISTALLY', 'MALAPITAN', 'ANIAN', '', 'Female', 'BARANGAY 16 (POB.), BACOLOD CITY (Capital)', 'Student', 'Grade 8', 'Charity', '', 'Active', NULL, NULL, '2015-12-14 08:36:01'),
(41, '61772882', 'Trial Entry', 'Trial Entry', 'Trial Entry', '09983893839', 'Male', 'asdasdsadasd', 'Student', '', '', '', 'Active', '123', NULL, '2025-02-04 22:44:52'),
(42, '213123', 'asdas', 'dasd', 'asdasd', '09349934894', 'Male', 'asdasdasd', 'Student', '', '', '', 'Active', 'admin123', 'asdasd@email.com', '2025-02-06 21:05:44'),
(43, '1233331', 'agay1', 'agay1', 'agay1', '09348893841', 'Female', 'asdasdasd1', '', '', '', '', 'Active', 'awtsgege', 'agay1@email.com', '2025-02-06 21:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `user_log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `date_log` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`user_log_id`, `user_id`, `user_name`, `date_log`) VALUES
(1, 19, 'MARY BERYL TULMO LUMAPAN', '2015-12-14 08:33:56'),
(2, 40, 'CRISTALLY MALAPITAN ANIAN', '2015-12-14 08:39:11'),
(3, 1, 'KERVIN KARL OSORIO CABUS', '2015-12-14 10:35:20'),
(4, 7, 'ANDRIA CASIANO PIT', '2015-12-14 10:36:12'),
(5, 10, 'REGINE DOMINGUEZ SALANATIN', '2015-12-14 10:36:29'),
(6, 18, 'ROZEL CHILES PALMA JANDOG', '2015-12-14 10:37:03'),
(7, 3, 'GERALD MANOSO PELINGON', '2015-12-14 10:37:23'),
(8, 8, 'ANGELA CASTILLO REJAS', '2015-12-14 10:37:26'),
(9, 17, 'CRISTY GAYLE CADAYDAY GOSIAOCO', '2015-12-14 10:37:38'),
(10, 9, 'ROWELA UNTAL ROGERO', '2015-12-14 10:38:05'),
(11, 17, 'CRISTY GAYLE CADAYDAY GOSIAOCO', '2015-12-14 10:38:29'),
(12, 16, 'RATCHEL YANOS GALVAN', '2015-12-14 10:38:29'),
(13, 15, 'REYNAN DATULAYTA GABALES', '2015-12-14 10:38:34'),
(14, 12, 'SUNDAY HECHANOVA FELIPE', '2015-12-14 10:38:37'),
(15, 12, 'SUNDAY HECHANOVA FELIPE', '2015-12-14 10:38:48'),
(16, 9, 'ROWELA UNTAL ROGERO', '2015-12-14 10:38:56'),
(17, 7, 'ANDRIA CASIANO PIT', '2015-12-14 10:39:01'),
(18, 5, 'JAN MICHAEL ALABE PORCEL', '2015-12-14 10:39:04'),
(19, 5, 'JAN MICHAEL ALABE PORCEL', '2015-12-14 10:39:06'),
(20, 17, 'CRISTY GAYLE CADAYDAY GOSIAOCO', '2015-12-14 10:40:34'),
(21, 16, 'RATCHEL YANOS GALVAN', '2015-12-14 10:40:39'),
(22, 15, 'REYNAN DATULAYTA GABALES', '2015-12-14 10:40:45'),
(23, 14, 'CHRISTOPHER ARGUELLES FRIAS', '2015-12-14 10:40:51'),
(24, 14, 'CHRISTOPHER ARGUELLES FRIAS', '2015-12-14 10:41:01'),
(25, 25, 'JOEZER COLENE LEGIRO GALIMBA', '2015-12-14 10:41:08'),
(26, 18, 'ROZEL CHILES PALMA JANDOG', '2015-12-14 10:41:16'),
(27, 20, 'REGINA MARIE DELAPER MACHAN', '2015-12-14 10:41:20'),
(28, 19, 'MARY BERYL TULMO LUMAPAN', '2015-12-14 10:41:21'),
(29, 20, 'REGINA MARIE DELAPER MACHAN', '2015-12-14 10:41:22'),
(30, 23, 'MARK ANGELO BOJOS CAMACHO', '2015-12-14 10:41:28'),
(31, 23, 'MARK ANGELO BOJOS CAMACHO', '2015-12-14 10:41:29'),
(32, 24, 'RGEE LOUIZE ESTARES DELIMA', '2015-12-14 10:41:29'),
(33, 22, 'KENNETH JUANEZA BENIT', '2015-12-14 10:41:31'),
(34, 19, 'MARY BERYL TULMO LUMAPAN', '2015-12-14 10:41:32'),
(35, 18, 'ROZEL CHILES PALMA JANDOG', '2015-12-14 10:41:32'),
(36, 13, 'JOEMAR MENDOZA FRANCISCO', '2015-12-14 10:41:37'),
(37, 11, 'JOHN MARK PAMPLIEGA CASTEN', '2015-12-14 10:41:41'),
(38, 10, 'REGINE DOMINGUEZ SALANATIN', '2015-12-14 10:41:45'),
(39, 10, 'REGINE DOMINGUEZ SALANATIN', '2015-12-14 10:41:48'),
(40, 10, 'REGINE DOMINGUEZ SALANATIN', '2015-12-14 10:41:50'),
(41, 25, 'JOEZER COLENE LEGIRO GALIMBA', '2015-12-14 10:42:06'),
(42, 26, 'JULIAH ARANGOTE ABEDONG', '2015-12-14 10:42:07'),
(43, 19, 'MARY BERYL TULMO LUMAPAN', '2015-12-14 10:42:11'),
(44, 19, 'MARY BERYL TULMO LUMAPAN', '2015-12-14 10:42:16'),
(45, 23, 'MARK ANGELO BOJOS CAMACHO', '2015-12-14 10:42:22'),
(46, 21, 'MARLON GAJO BALANGAO', '2015-12-14 10:43:00'),
(47, 18, 'ROZEL CHILES PALMA JANDOG', '2015-12-14 10:43:48'),
(48, 18, 'ROZEL CHILES PALMA JANDOG', '2015-12-14 10:43:55'),
(49, 20, 'REGINA MARIE DELAPER MACHAN', '2015-12-14 10:44:01'),
(50, 25, 'JOEZER COLENE LEGIRO GALIMBA', '2015-12-14 10:44:07'),
(51, 23, 'MARK ANGELO BOJOS CAMACHO', '2015-12-14 10:44:25'),
(52, 23, 'MARK ANGELO BOJOS CAMACHO', '2015-12-14 10:44:27'),
(53, 23, 'MARK ANGELO BOJOS CAMACHO', '2015-12-14 10:44:32'),
(54, 28, 'NICOLE ANN PAGSUBERON ABILGOS', '2015-12-14 11:05:19'),
(55, 35, 'RALPH JERO CENTINO DEMERIN', '2015-12-14 11:05:22'),
(56, 28, 'NICOLE ANN PAGSUBERON ABILGOS', '2015-12-14 11:05:28'),
(57, 28, 'NICOLE ANN PAGSUBERON ABILGOS', '2015-12-14 11:09:11'),
(58, 32, 'JOSHUA SUICO CARPENTERO', '2015-12-14 11:09:18'),
(59, 36, 'TRESHIA SALVANTE ABENIR', '2015-12-14 11:16:09'),
(60, 38, 'ELLA MARIE MARTENECIO ALVAREZ', '2015-12-14 11:16:13'),
(61, 38, 'ELLA MARIE MARTENECIO ALVAREZ', '2015-12-14 11:16:15'),
(62, 37, 'MA THERESA MAE CORDOVA ALLES', '2015-12-14 11:16:19'),
(63, 36, 'TRESHIA SALVANTE ABENIR', '2015-12-14 11:16:48'),
(64, 38, 'ELLA MARIE MARTENECIO ALVAREZ', '2015-12-14 11:16:50'),
(65, 39, 'LOVELY ANN YUBARA AMAR', '2015-12-14 11:16:55'),
(66, 38, 'ELLA MARIE MARTENECIO ALVAREZ', '2015-12-14 11:32:50'),
(67, 33, 'JERSON PIDO DAMPOG', '2015-12-14 11:33:15'),
(68, 19, 'MARY BERYL TULMO LUMAPAN', '2015-12-14 11:33:16'),
(69, 27, 'CHRISTINE MAE SALAZAR ABETO', '2015-12-14 11:33:18'),
(70, 28, 'NICOLE ANN PAGSUBERON ABILGOS', '2015-12-14 11:33:19'),
(71, 19, 'MARY BERYL TULMO LUMAPAN', '2015-12-14 11:34:29'),
(72, 18, 'ROZEL CHILES PALMA JANDOG', '2015-12-14 11:34:39'),
(73, 24, 'RGEE LOUIZE ESTARES DELIMA', '2015-12-14 11:34:42'),
(74, 33, 'JERSON PIDO DAMPOG', '2015-12-14 11:35:04'),
(75, 9, 'ROWELA UNTAL ROGERO', '2015-12-14 11:35:21'),
(76, 5, 'JAN MICHAEL ALABE PORCEL', '2015-12-14 11:35:24'),
(77, 33, 'JERSON PIDO DAMPOG', '2015-12-14 11:38:01'),
(78, 33, 'JERSON PIDO DAMPOG', '2015-12-14 11:40:11'),
(79, 30, 'MARNYL DUNLAO BACOLINA', '2015-12-14 11:40:17'),
(80, 31, 'REXXER ANDREI DE LOS SANTOS BELEBER', '2015-12-14 11:49:45'),
(81, 30, 'MARNYL DUNLAO BACOLINA', '2015-12-14 11:49:50'),
(82, 33, 'JERSON PIDO DAMPOG', '2015-12-14 11:50:45'),
(83, 28, 'NICOLE ANN PAGSUBERON ABILGOS', '2015-12-14 11:50:56'),
(84, 29, 'JANESSA DOROTEO ARGUELLES', '2015-12-14 11:53:03'),
(85, 20, 'REGINA MARIE DELAPER MACHAN', '2015-12-14 13:52:30'),
(86, 34, 'JESS LORD ARROYO DE LA CRUZ', '2015-12-14 14:11:26'),
(87, 30, 'MARNYL DUNLAO BACOLINA', '2015-12-14 14:12:05'),
(88, 33, 'JERSON PIDO DAMPOG', '2015-12-14 14:24:28'),
(89, 33, 'JERSON PIDO DAMPOG', '2015-12-14 14:25:03'),
(90, 33, 'JERSON PIDO DAMPOG', '2015-12-14 14:25:06'),
(91, 33, 'JERSON PIDO DAMPOG', '2015-12-14 14:25:12'),
(92, 28, 'NICOLE ANN PAGSUBERON ABILGOS', '2015-12-14 14:25:56'),
(93, 34, 'JESS LORD ARROYO DE LA CRUZ', '2015-12-14 14:26:46'),
(94, 30, 'MARNYL DUNLAO BACOLINA', '2015-12-14 14:26:52'),
(95, 30, 'MARNYL DUNLAO BACOLINA', '2015-12-14 14:27:44'),
(96, 34, 'JESS LORD ARROYO DE LA CRUZ', '2015-12-14 14:28:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `allowed_book`
--
ALTER TABLE `allowed_book`
  ADD PRIMARY KEY (`allowed_book_id`);

--
-- Indexes for table `allowed_days`
--
ALTER TABLE `allowed_days`
  ADD PRIMARY KEY (`allowed_days_id`);

--
-- Indexes for table `barcode`
--
ALTER TABLE `barcode`
  ADD PRIMARY KEY (`barcode_id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `borrow_book`
--
ALTER TABLE `borrow_book`
  ADD PRIMARY KEY (`borrow_book_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_id` (`category_id`),
  ADD KEY `classid` (`category_id`);

--
-- Indexes for table `penalty`
--
ALTER TABLE `penalty`
  ADD PRIMARY KEY (`penalty_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `return_book`
--
ALTER TABLE `return_book`
  ADD PRIMARY KEY (`return_book_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`user_log_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `allowed_book`
--
ALTER TABLE `allowed_book`
  MODIFY `allowed_book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `allowed_days`
--
ALTER TABLE `allowed_days`
  MODIFY `allowed_days_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barcode`
--
ALTER TABLE `barcode`
  MODIFY `barcode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `borrow_book`
--
ALTER TABLE `borrow_book`
  MODIFY `borrow_book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=801;

--
-- AUTO_INCREMENT for table `penalty`
--
ALTER TABLE `penalty`
  MODIFY `penalty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `return_book`
--
ALTER TABLE `return_book`
  MODIFY `return_book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `user_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
