-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2023 at 03:00 PM
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
-- Database: `matkulfix`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `email`, `password`) VALUES
(1, 'michelle@yahoo.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 'admin@yahoo.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `isbn` varchar(13) NOT NULL,
  `author` varchar(50) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `price` float(4,2) DEFAULT NULL,
  `categoryid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`isbn`, `author`, `title`, `price`, `categoryid`) VALUES
('0-672-31697-8', 'Michael Morgan', 'Java 2 for Professional Developers', 34.99, 4),
('0-672-31745-1', 'Thomas Down', 'Installing Debian GNU/Linux', 24.99, 4),
('0-672-31509-2', 'Pruitt, et al.', 'Teach Yourself GIMP in 24 Hours', 24.99, 4),
('0-672-31769-9', 'Thomas Schenk', 'Caldera OpenLinux System Administration Unleashed', 49.99, 4),
('0-672-31281-1', 'Clarita Michelle', 'Jakarta dan Debu Adalah Kawan', 66.99, 2),
('0-999-70789-3', 'Leila S Chudori', 'Laut Bercerita', 11.99, 2),
('0-672-31281-7', 'Mulya Irwansyah', 'Cara Pintar Memasak', 60.99, 1),
('0-699-37609-1', 'John Smith', 'The Book of Secrets', 11.99, 1),
('0-123-45678-9', 'Jane Doe', 'Mystery Mansion', 14.99, 2),
('0-987-65432-1', 'Michael Johnson', 'Science Unleashed', 9.99, 4),
('0-111-22222-3', 'Sarah Adams', 'The Adventure Begins', 12.49, 3),
('0-333-55555-5', 'Robert White', 'History in Pages', 10.99, 1),
('0-444-77777-7', 'Emily Brown', 'Fictional Tales', 13.29, 2),
('0-666-99999-0', 'David Lee', 'Exploring the Unknown', 8.99, 4),
('0-888-22222-1', 'Jennifer King', 'The Magical World', 11.99, 3),
('0-999-33333-2', 'Daniel Johnson', 'Into the Wild', 14.49, 1),
('0-000-44444-4', 'Lisa Adams', 'Detective Stories', 10.49, 2),
('0-123-56789-0', 'Matthew White', 'Astronomy Today', 12.99, 4),
('0-555-11111-5', 'Olivia Smith', 'Fantasy Realm', 9.99, 3),
('0-999-77777-1', 'Sophia Lee', 'The Mystery Box', 13.99, 1),
('0-123-99999-9', 'William Brown', 'Ancient Wonders', 11.49, 2),
('0-222-44444-4', 'Ella Adams', 'Historical Journeys', 14.99, 4),
('0-333-66666-6', 'James Johnson', 'The Time Traveler', 10.99, 3),
('0-444-88888-8', 'Emma Smith', 'Whodunit?', 12.49, 1),
('0-123-55555-5', 'Noah Lee', 'Deep Sea Exploration', 9.49, 2),
('0-555-99999-9', 'Ava Brown', 'Adventures in Wonderland', 13.99, 4),
('0-777-22222-2', 'Mia Adams', 'Fairy Tales', 10.99, 3),
('0-888-55555-5', 'Liam White', 'Space Odyssey', 12.99, 1),
('0-999-66666-6', 'Isabella Lee', 'Secret Agents', 11.49, 2),
('0-565-908768-', 'Grace Johnson', 'Mythical Creatures', 9.99, 3),
('0-672-31765-0', 'Kamal Baswara', 'Mulya', 11.00, 2),
('0-111-22222-2', 'Alice Johnson', 'The Enchanted Forest', 15.99, 1),
('0-222-33333-3', 'Benjamin White', 'Underwater Adventures', 12.49, 2),
('0-333-44444-4', 'Charlotte Adams', 'The Mystery Mansion', 9.99, 4),
('0-444-55555-5', 'Daniel Lee', 'Exploring Space', 16.99, 3),
('0-555-66666-6', 'Ella Smith', 'The Lost Treasure', 13.99, 1),
('0-666-77777-7', 'Frank Johnson', 'Ancient Civilizations', 14.99, 2),
('0-777-88888-8', 'Grace Adams', 'Magical Creatures', 11.49, 4),
('0-888-99999-9', 'Hannah White', 'The Time Machine', 15.49, 3),
('0-999-00000-0', 'Isaac Lee', 'Adventures in Wonderland', 13.99, 1),
('0-000-11111-1', 'James Smith', 'Fairy Tales', 12.49, 2),
('1-234-56789-0', 'Hiroshi Suzuki', 'One Piece: Volume 1', 9.99, 3),
('3-456-78901-2', 'Akiko Tanaka', 'Naruto: The Complete Series', 19.99, 3),
('5-678-90123-4', 'Yukihiro Yamamoto', 'Attack on Titan: Volume 1', 12.99, 3),
('7-456-78321-2', 'Jessica Parker', 'The Amazing Spider-Man', 13.99, 3),
('5-278-94423-4', 'Daniel Kim', 'Batman: The Dark Knight Returns', 15.99, 3),
('7-833-22345-6', 'Sophia Miller', 'Deadpool: The Merc with a Mouth', 12.99, 3),
('9-876-54321-0', 'Eleanor Smith', 'The Secrets We Keep', 15.99, 2),
('9-876-52322-4', 'Eleanor Smith', 'The Secrets We Keep', 15.99, 2),
('9-333-43238-9', 'James Mitchell', 'Love in Paris', 12.99, 2),
('7-654-32109-8', 'Sophia White', 'Mystery on the Moors', 14.99, 2);

-- --------------------------------------------------------

--
-- Table structure for table `book_reviews`
--

CREATE TABLE `book_reviews` (
  `isbn` char(13) NOT NULL,
  `review` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `book_reviews`
--

INSERT INTO `book_reviews` (`isbn`, `review`) VALUES
('0-672-31697-8', 'Morgan\'s book is clearly written and goes well beyond \r\n                     most of the basic Java books out there.'),
('0-000-11111-1', 'coba review'),
('0-000-11111-1', 'buku ini sangat menarik');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryid`, `name`) VALUES
(1, 'Encyclopedia'),
(2, 'Novel'),
(3, 'Comic'),
(4, 'Scientific Books');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerid` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerid`, `name`, `address`, `city`) VALUES
(1, 'Michelle Arthur', '357 North Road A', 'Yarraville'),
(2, 'Anne', 'Boulevard \' Street', 'Box Hill'),
(3, 'Melly', 'Vicoria Street', 'Airport West'),
(4, 'Rose', 'Queen Street', 'Airport West'),
(5, 'Alan Wonga', 'Buanglow Street', 'Airport West'),
(6, 'Dionysius Mario', 'Jl. Nangka IV No. 39, RT 04/RW 01, Cengkareng Barat', 'Box Hill');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderid` int(10) UNSIGNED NOT NULL,
  `customerid` int(10) UNSIGNED NOT NULL,
  `amount` float(6,2) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `customerid`, `amount`, `date`) VALUES
(1, 3, 69.98, '2000-04-02'),
(2, 1, 49.99, '2000-04-15'),
(3, 2, 74.98, '2000-04-19'),
(4, 3, 24.99, '2000-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `orderid` int(10) UNSIGNED NOT NULL,
  `isbn` char(13) NOT NULL,
  `quantity` tinyint(3) UNSIGNED DEFAULT NULL,
  `order_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`orderid`, `isbn`, `quantity`, `order_date`) VALUES
(1, '0-672-31697-8', 2, '2023-09-14'),
(2, '0-672-31769-9', 1, '2023-09-11'),
(3, '0-672-31769-9', 1, '2023-09-16'),
(3, '0-672-31509-2', 1, '2023-08-07'),
(4, '0-672-31745-1', 3, '2023-09-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`isbn`),
  ADD KEY `fk_buku_category` (`categoryid`);

--
-- Indexes for table `book_reviews`
--
ALTER TABLE `book_reviews`
  ADD KEY `isbn` (`isbn`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`orderid`,`isbn`),
  ADD KEY `fk_order_items_isbn` (`isbn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
