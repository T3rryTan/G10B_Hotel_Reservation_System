-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2016 at 08:46 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_r`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(10) NOT NULL,
  `adminFullname` varchar(50) NOT NULL,
  `adminName` varchar(50) NOT NULL,
  `adminPassword` varchar(50) NOT NULL,
  `adminEmail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminFullname`, `adminName`, `adminPassword`, `adminEmail`) VALUES
(1, 'admin', 'admin', 'admin123', 'admin.admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_type`
--

CREATE TABLE `hotel_type` (
  `hotelTypeID` int(10) NOT NULL,
  `hotelTypeName` varchar(50) NOT NULL,
  `hotelTypePhone` varchar(50) NOT NULL,
  `hotelTypeAddress` varchar(100) NOT NULL,
  `hotelTypeImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotel_type`
--

INSERT INTO `hotel_type` (`hotelTypeID`, `hotelTypeName`, `hotelTypePhone`, `hotelTypeAddress`, `hotelTypeImage`) VALUES
(1, 'HOLIDAY INN', '+60 6-285 9000', 'Jalan Syed Ab. Aziz, 75000 Malacca, Malaysia', '/MAL_HOLINNMEL_1.jpg'),
(2, 'HOTEL EQUATORIAL MELAKA', '+60 6-282 8333', ' Bandar Hilir, 75000 Melaka, Malaysia', '/southeast2005.1132140660.100_0005.jpg'),
(3, 'HATTEN HOTEL MELAKA', '+60 6-286 9696', 'Hatten Square, Jalan Merdeka, Bandar Hilir, 75000 Melaka, Malaysia', '/hatten-hotel-melaka-melaka_160720120719226620.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `id` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `orderStatus` varchar(50) NOT NULL,
  `orderDateTime` varchar(50) NOT NULL,
  `orderCreditCard` varchar(50) NOT NULL,
  `orderCCV` varchar(50) NOT NULL,
  `orderVaildDate` varchar(50) NOT NULL,
  `orderVaildYear` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `id`, `username`, `orderStatus`, `orderDateTime`, `orderCreditCard`, `orderCCV`, `orderVaildDate`, `orderVaildYear`, `total`) VALUES
(1, '2', 'Terry02', 'paid', '2016-02-15 13:43:33', '2534634665474575', '464', '', '', ''),
(2, '2', 'Terry02', 'paid', '2016-02-15 14:28:49', '4414141414141412', '323', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_room`
--

CREATE TABLE `order_room` (
  `orderRoomID` int(11) NOT NULL,
  `orderID` varchar(50) NOT NULL,
  `roomID` varchar(50) NOT NULL,
  `orderRoomPrice` varchar(50) NOT NULL,
  `orderRoomQuantity` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `days` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_room`
--

INSERT INTO `order_room` (`orderRoomID`, `orderID`, `roomID`, `orderRoomPrice`, `orderRoomQuantity`, `date`, `days`) VALUES
(1, '1', '2', '6360', '2', '2016-02-10', '12'),
(2, '2', '2', '1590', '2', '2016-02-03', '3');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomID` int(10) NOT NULL,
  `roomName` varchar(50) NOT NULL,
  `hotelTypeID` varchar(50) NOT NULL,
  `roomDetail` varchar(200) NOT NULL,
  `roomPrice` varchar(50) NOT NULL,
  `roomImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomID`, `roomName`, `hotelTypeID`, `roomDetail`, `roomPrice`, `roomImage`) VALUES
(2, 'HOLIDAY INN-Deluxe Room', '1', 'Bed type and smoking preferences are not guaranteed it will be allocated upon arrival and subject to hotels availability. standard rooms have maximum capacity for 2 adult guests only.', '265', '1/MKZJM_4010140946_5174991159_P.jpg'),
(3, 'HOLIDAY INN-Deluxe King', '1', 'NON-smoking.Enjoy the scenic historical melaka city view through the large windows in your room & high speed internet lets you keep up with email and you can browse satellite channels on the flat scre', '315', '1/deluxe_king-12.jpg'),
(4, 'HOTEL EQUATORIAL MELAKA-Deluxe Double or Twin Room', '2', 'Featuring floor-to-ceiling windows, this room is fitted with a minibar, tea/coffee-making facilities and safety deposit box.  Room facilities: Balcony, View, TV, Telephone, Radio, Cable Channels, Flat', '235', '2/61961334.jpg'),
(5, 'HOTEL EQUATORIAL MELAKA-Premier Double or Twin Roo', '2', 'This twin/double room features a minibar, view and air conditioning.  Room facilities: View, TV, Telephone, Radio, Cable Channels, Flat-screen TV, Safety Deposit Box, Air Conditioning, Iron, Desk, Iro', '315', '2/39896774.jpg'),
(6, 'HATTEN HOTEL MELAKA-Premier Deluxe Suite', '3', 'Room benefits include:  - Express check-in and check-out at Premier Lounge at Level 12  - Welcome drink at Premier Lounge, complimentary standard fruit plate upon arrival  - Drinks in the minibar, in-', '334', '3/DS4.jpg'),
(7, 'HATTEN HOTEL MELAKA-Deluxe Suite', '3', 'Spacious air-conditioned room offers 2 flat-screen TVs, personal safe, work space and private marble bathroom with rain shower. Guests enjoy views of the city or sea.  Room facilities: Sea view, City ', '258', '3/17013221.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `birthday` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `s_question` varchar(50) NOT NULL,
  `s_answer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `username`, `password`, `phone`, `email`, `gender`, `birthday`, `address`, `s_question`, `s_answer`) VALUES
(1, 'TianKee', 'TianKee', 'ee269354e0e8289824f912b642c36dcb', '0177401800', 'hee.tian@gmail.com', 'Male', '2016-02-15', '7,Jalan Pinang Liar, Taman Soga,23232', '1', 'pet'),
(2, 'Terry02', 'Terry02', 'e10adc3949ba59abbe56e057f20f883e', '1234567890', '123@hgg.com', 'Male', '2016-02-17', '23456789', '2', 'wtgwg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `hotel_type`
--
ALTER TABLE `hotel_type`
  ADD PRIMARY KEY (`hotelTypeID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `order_room`
--
ALTER TABLE `order_room`
  ADD PRIMARY KEY (`orderRoomID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hotel_type`
--
ALTER TABLE `hotel_type`
  MODIFY `hotelTypeID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `order_room`
--
ALTER TABLE `order_room`
  MODIFY `orderRoomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
