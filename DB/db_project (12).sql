-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2024 at 02:15 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(60) NOT NULL,
  `admin_email` varchar(60) NOT NULL,
  `admin_password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(19, 'Ayan S', 'ayan@gmail.com', 'Ayan147@ks');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `booking_id` int(100) NOT NULL,
  `booking_amount` varchar(100) NOT NULL,
  `booking_status` int(11) NOT NULL DEFAULT 0,
  `booking_date` varchar(100) NOT NULL,
  `user_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`booking_id`, `booking_amount`, `booking_status`, `booking_date`, `user_id`) VALUES
(39, '400', 2, '2024-10-27', 21),
(40, '800', 2, '2024-10-27', 21),
(41, '1000', 2, '2024-10-27', 23),
(42, '400', 2, '2024-10-27', 17),
(43, '', 0, '', 17),
(44, '700', 2, '2024-11-01', 18),
(45, '500', 2, '2024-10-30', 18),
(46, '200', 2, '2024-10-31', 18),
(47, '200', 2, '2024-10-31', 18),
(48, '', 0, '', 18),
(49, '900', 2, '2024-11-01', 24),
(50, '500', 2, '2024-11-01', 30),
(51, '500', 2, '2024-11-01', 30);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `brand_name`) VALUES
(1, 'Tulsis'),
(4, 'happilo'),
(5, 'farmly'),
(6, 'Navitas Organics');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `cart_quantity` int(11) NOT NULL DEFAULT 1,
  `cart_status` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL,
  `deliveryagent_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `cart_quantity`, `cart_status`, `product_id`, `deliveryagent_id`, `booking_id`) VALUES
(54, 2, 3, 70, 12, 39),
(55, 2, 3, 77, 12, 40),
(56, 3, 3, 70, 12, 40),
(57, 3, 3, 78, 12, 41),
(58, 2, 3, 84, 12, 41),
(59, 2, 3, 72, 12, 42),
(60, 1, 3, 70, 12, 43),
(61, 1, 3, 70, 12, 44),
(62, 2, 3, 86, 12, 44),
(63, 1, 3, 72, 12, 44),
(64, 2, 3, 86, 12, 45),
(65, 1, 3, 70, 12, 45),
(66, 1, 3, 70, 12, 46),
(67, 1, 3, 79, 12, 47),
(68, 1, 3, 79, 12, 48),
(69, 2, 3, 88, 12, 49),
(70, 1, 3, 87, 12, 49),
(71, 2, 5, 90, 12, 50),
(72, 1, 5, 92, 12, 50),
(73, 1, 1, 87, 0, 51);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(20, 'Dry Fruits'),
(21, 'Nuts'),
(22, 'Seeds');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint`
--

CREATE TABLE `tbl_complaint` (
  `complaint_id` int(11) NOT NULL,
  `complaint_date` varchar(100) NOT NULL,
  `complaint_reply` varchar(500) NOT NULL,
  `complaint_status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `complaint_title` varchar(250) NOT NULL,
  `complaint_description` varchar(500) NOT NULL,
  `complaint_file` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_complaint`
--

INSERT INTO `tbl_complaint` (`complaint_id`, `complaint_date`, `complaint_reply`, `complaint_status`, `user_id`, `product_id`, `complaint_title`, `complaint_description`, `complaint_file`) VALUES
(1, '2024-07-12', 'thankuuu', 1, 19, 62, 'about cashew ', ' good quality cashew', 'Cashews.jpg'),
(8, '2024-08-04', 'sorry for the inconvenience', 1, 21, 68, 'bad', ' Not fresh', 'Pineapple.jpg'),
(9, '2024-08-16', 'sorry for the inconvenience', 1, 22, 70, 'bad', ' not fresh', 'Pistachio.jpg'),
(10, '2024-10-05', '', 0, 18, 66, 'Bad', ' bad', 'Screenshot (1).png'),
(11, '2024-10-08', '', 0, 23, 78, 'Bad', ' not fresh', 'Cucharas con varios frutos secos _ Foto Gratis.jpeg'),
(12, '2024-10-27', '', 0, 23, 78, 'Wrong product', ' wrong product received', 'Hazelnuts.jpg'),
(13, '2024-10-27', 'very sorry', 1, 17, 72, 'good', ' bad', 'Walnuts.jpg'),
(14, '2024-10-27', '', 0, 17, 72, 'Bad', ' bad prduct', 'Screenshot (2).png'),
(15, '2024-10-30', '', 0, 18, 70, 'hjgyh', ' lkhbju7bt6yh', 'Screenshot (1).png'),
(16, '2024-11-01', '', 0, 24, 88, 'good', ' jkh', 'Chia.jpg'),
(17, '2024-11-01', '', 0, 24, 88, 'bad', ' nkjh', 'Watermelon.jpg'),
(18, '2024-11-01', 'very sorry ', 1, 30, 90, 'good', ' thbdy', 'images3.jpg'),
(19, '2024-11-01', '', 0, 30, 90, 'bad', ' jkjbuyjm', 'Watermelon.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_deliveryagent`
--

CREATE TABLE `tbl_deliveryagent` (
  `deliveryagent_id` int(11) NOT NULL,
  `deliveryagent_name` varchar(250) NOT NULL,
  `deliveryagent_gender` varchar(100) NOT NULL,
  `deliveryagent_email` varchar(200) NOT NULL,
  `deliveryagent_password` varchar(100) NOT NULL,
  `deliveryagent_photo` varchar(1000) NOT NULL,
  `deliveryagent_contact` varchar(100) NOT NULL,
  `seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_deliveryagent`
--

INSERT INTO `tbl_deliveryagent` (`deliveryagent_id`, `deliveryagent_name`, `deliveryagent_gender`, `deliveryagent_email`, `deliveryagent_password`, `deliveryagent_photo`, `deliveryagent_contact`, `seller_id`) VALUES
(5, 'Arun S', 'Male', 'arun@gmail.com', '1212', 'image2.jpg', '8606540112', 3),
(6, 'Arjun ', 'Male', 'arjun@gmail.com', '98574', 'images1.jpg', '8606540398', 6),
(7, 'Lakshmi', 'Female', 'lachu@gmail.com', '123', 'image2.jpg', '9890453600', 5),
(9, 'Sanjay', 'Male', 'sanjay@gmail.com', '123', 'b640d7cb7f9b9f6fc0d869012d1b9e79.jpg', '860654011200', 8),
(10, 'Gokul', 'Male', 'gokul@gmail.com', '951', 'Screenshot (2).png', '987456123', 8),
(11, 'Elvin', 'Male', 'elvin@gmail.com', '426', 'download (2).jpeg', '5347986348546', 9),
(12, 'Sivasoorya', 'Male', 'sivasooryavvvv@gmail.com', '862', 'images1.jpg', '69545532562564', 13);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`) VALUES
(8, 'kollam'),
(9, 'ekm'),
(20, 'thrissur'),
(21, 'Palakkad'),
(23, 'Kozhikod');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery`
--

CREATE TABLE `tbl_gallery` (
  `gallery_id` int(11) NOT NULL,
  `gallery_image` varchar(500) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_gallery`
--

INSERT INTO `tbl_gallery` (`gallery_id`, `gallery_image`, `product_id`) VALUES
(2, 'Cashews.jpg', 0),
(3, 'Cashews.jpg', 62),
(4, 'Strawberry.jpg', 63),
(5, 'Mango.jpg', 63),
(6, 'Cranberry.jpg', 67),
(8, 'Pineapple.jpg', 68),
(9, 'Watermelon.jpg', 69),
(10, 'Pumpkin.jpg', 0),
(11, 'Cranberry.jpg', 0),
(12, 'Cranberry.jpg', 0),
(13, 'Pistachio.jpg', 0),
(14, 'Pistachio.jpg', 0),
(15, 'Pistachio.jpg', 0),
(16, 'Pistachio.jpg', 0),
(17, 'brooke-lark-atzWFItRHy8-unsplash.jpg', 0),
(18, 'Pistachio.jpg', 0),
(20, 'Pumpkin.jpg', 64),
(21, 'Watermelon.jpg', 87),
(22, 'Pumpkin.jpg', 87);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(60) NOT NULL,
  `place_pincode` int(11) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `place_name`, `place_pincode`, `district_id`) VALUES
(4, 'tripunithura', 682312, 9),
(5, 'mulanturuthy', 682311, 9),
(6, 'mayyanad', 682315, 8),
(7, 'guruvayoor', 682308, 20),
(8, 'malampuzha', 682321, 21),
(9, 'chittor', 682394, 0),
(10, 'chottanikkara', 682312, 9),
(11, 'Hospital jn', 9665465, 23);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `product_price` int(60) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `product_details` varchar(60) NOT NULL,
  `product_photo` varchar(100) NOT NULL,
  `seller_id` int(100) NOT NULL,
  `brand_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_price`, `subcategory_id`, `product_details`, `product_photo`, `seller_id`, `brand_id`) VALUES
(64, 'pumpkin', 300, 36, '30g', 'Pumpkin.jpg', 5, 4),
(65, 'sunflower seed', 150, 38, '10g', 'Sunflower.jpg', 3, 5),
(67, 'cranberry', 300, 29, '30g', 'cranberry.jpg', 6, 4),
(68, 'Pineapple dry', 150, 19, 'sweet pineapple.Dried', 'Pineapple.jpg', 3, 4),
(69, 'Warermelon seeds', 120, 37, '100g', 'Watermelon.jpg', 6, 6),
(70, 'Pistachio', 200, 33, '200g', 'Pistachio.jpg', 8, 1),
(72, 'anjeer dry', 200, 12, '200g', 'Anjeer.jpg', 5, 6),
(74, 'walnut', 550, 32, 'djhfcdugj', 'Walnuts.jpg', 5, 5),
(75, 'hazelnuts', 100, 34, '50g', 'Hazelnuts.jpg', 6, 4),
(77, 'chia seeds', 100, 39, '10g', 'Chia.jpg', 8, 5),
(78, 'Strawberry dried', 200, 18, '100g', 'Strawberry.jpg', 9, 6),
(79, 'kiwi fruit', 200, 17, '100g', 'Kiwi.jpg', 8, 4),
(84, 'Spicy cashew', 200, 31, '150g', 'Cashews.jpg', 9, 6),
(86, 'Mango dried', 150, 16, '70g', 'Mango.jpg', 5, 5),
(87, 'Dates', 500, 15, '200g', 'Dates.jpg', 10, 5),
(88, 'watermelon seed', 200, 37, '100g', 'Watermelon.jpg', 10, 1),
(90, 'Strawberry dried', 200, 18, '40g', 'Strawberry.jpg', 13, 1),
(92, 'Sunflower seed', 100, 38, '60g', 'Sunflower.jpg', 13, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `rating_id` int(11) NOT NULL,
  `rating_datetime` varchar(10) NOT NULL,
  `rating_value` int(11) NOT NULL,
  `rating_content` varchar(500) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_rating`
--

INSERT INTO `tbl_rating` (`rating_id`, `rating_datetime`, `rating_value`, `rating_content`, `product_id`, `user_id`) VALUES
(1, '2024-08-03', 4, 'wewdcwe', 63, 18),
(2, '2024-08-03', 4, 'very good quality', 62, 18),
(3, '2024-08-04', 3, 'averge', 69, 17),
(4, '2024-08-16', 4, 'good', 64, 19),
(5, '2024-10-05', 4, 'Goid', 66, 18),
(6, '2024-10-08', 4, 'good\n', 78, 23),
(7, '2024-10-27', 2, 'Average', 78, 23),
(8, '2024-11-01', 4, 'good', 86, 30);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seller`
--

CREATE TABLE `tbl_seller` (
  `seller_id` int(11) NOT NULL,
  `seller_name` varchar(100) NOT NULL,
  `seller_email` varchar(100) NOT NULL,
  `seller_contact` varchar(100) NOT NULL,
  `seller_password` varchar(100) NOT NULL,
  `seller_proof` varchar(100) NOT NULL,
  `seller_status` int(11) NOT NULL DEFAULT 0,
  `seller_logo` varchar(400) NOT NULL,
  `place_id` int(11) NOT NULL,
  `seller_gender` varchar(100) NOT NULL,
  `seller_photo` varchar(1000) NOT NULL,
  `district_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_seller`
--

INSERT INTO `tbl_seller` (`seller_id`, `seller_name`, `seller_email`, `seller_contact`, `seller_password`, `seller_proof`, `seller_status`, `seller_logo`, `place_id`, `seller_gender`, `seller_photo`, `district_id`) VALUES
(5, 'Devanand', 'devanand@gmail.com', '8606548750', '268', 'images3.jpg', 2, 'images1.jpg', 4, 'Male', 'image2.jpg', 9),
(6, 'Madhav', 'madhav@gmail.com', '75654257986', '123', 'images3.jpg', 1, 'image2.jpg', 5, 'Male', 'images1.jpg', 9),
(8, 'Lakshmi Valsalan', 'lachu@gmail.com', '689045331', '987', 'd2.jpg', 1, 'image (1).jpg', 6, 'Female', 'image2.jpg', 8),
(9, 'Gadha', 'gadha@gmail.com', '8606540310', '582', 'brooke-lark-atzWFItRHy8-unsplash.jpg', 0, '9ff6ac6fdee0b819cad2c0248bf8908c.jpg', 7, 'Female', 'pic6.jpg', 20),
(10, 'Jayakrishnan', 'jayakrishnan@123', '98745632', 'J.123', 'Screenshot (2).png', 2, 'Screenshot 2024-08-09 113425.png', 8, 'Male', 'download (2).jpeg', 21),
(12, 'Naveen', 'naveen@gmail.com', '987465256', '741', 'download.jpeg', 1, 'download.jpeg', 7, 'Male', 'download.jpeg', 20),
(13, 'anjana ginesh', 'anjanaginesh925@gmail.com', '95434152345', '456', 'Screenshot 2024-08-09 113445.png', 1, 'Screenshot (2).png', 6, 'Female', 'Screenshot 2024-08-09 113425.png', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE `tbl_stock` (
  `stock_id` int(11) NOT NULL,
  `stock_date` varchar(100) NOT NULL,
  `stock_quantity` varchar(100) NOT NULL,
  `product_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_stock`
--

INSERT INTO `tbl_stock` (`stock_id`, `stock_date`, `stock_quantity`, `product_id`) VALUES
(72, '2024-10-27', '10', 70),
(73, '2024-10-27', '100', 70),
(74, '2024-10-27', '50', 79),
(75, '2024-10-27', '25', 77),
(76, '2024-10-27', '20', 84),
(77, '2024-10-27', '5', 78),
(78, '2024-10-27', '5', 72),
(79, '2024-10-30', '25', 86),
(80, '2024-10-30', '30', 74),
(81, '2024-11-01', '10', 87),
(82, '2024-11-01', '5', 88),
(83, '2024-11-01', '10', 92),
(84, '2024-11-01', '12', 90),
(85, '2024-11-01', '5', 90);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE `tbl_subcategory` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name` varchar(60) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_subcategory`
--

INSERT INTO `tbl_subcategory` (`subcategory_id`, `subcategory_name`, `category_id`) VALUES
(12, 'Anjeer', 20),
(13, 'Apricot', 20),
(14, 'Raisin', 20),
(15, 'Dates', 20),
(16, 'Mango', 20),
(17, 'Kiwi', 20),
(18, 'Strawberry', 20),
(19, 'Pineapple', 20),
(20, 'Amla', 20),
(29, 'Cranberry', 20),
(30, 'Almonds', 21),
(31, 'Cashews', 21),
(32, 'Walnuts', 21),
(33, 'Pistachio', 21),
(34, 'Hazelnuts', 21),
(35, 'Flax', 22),
(36, 'Pumpkin', 22),
(37, 'Watermelon', 22),
(38, 'Sunflower', 22),
(39, 'Chia', 22);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_gender` varchar(100) NOT NULL,
  `user_contact` varchar(60) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_photo` varchar(500) NOT NULL,
  `user_proof` varchar(500) NOT NULL,
  `place_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `user_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_gender`, `user_contact`, `user_email`, `user_password`, `user_photo`, `user_proof`, `place_id`, `district_id`, `user_address`) VALUES
(17, 'basil johny', 'Male', '7565425750', 'basil@gmail.com', '369', 'images3.jpg', 'image2.jpg', 7, 20, '20C,Thiruvaniyoor'),
(19, 'Vinu', 'Male', '8606540001', 'vinu@gmail.com', '258', 'images3.jpg', 'images3.jpg', 5, 9, 'Gokulam,Mamala'),
(22, 'Niranjana', 'Female', '9874561254', 'niranjana@gmail.com', '987', 'd4.jpg', 'd1.jpg', 6, 8, '3B,Darshn Enclave'),
(24, 'Smitha', 'Female', '985962336', 'smitha@gmail.com', 'Smitha@123', 'WhatsApp Image 2024-09-25 at 6.42.27 AM.jpeg', 'Screenshot 2024-08-09 113425.png', 5, 9, 'kattokkara house'),
(25, 'Sneha', 'Female', '8606540000', 'sneha@gmail.com', '963', 'download.jpeg', '#art #anime #hinhnen #wallpaper #kawaii #cutegirl #anime #wallpaper  #art #wallpaperforyourphone  #w', 6, 8, '98c,shneha apartments'),
(30, 'Adhya k s', 'Female', '8606540312', 'adhya1704@gmail.com', '852', 'Adhu pic.jpg', 'Screenshot 2024-08-09 113425.png', 10, 9, 'kattokkara house');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `wishlist_date` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`wishlist_id`, `wishlist_date`, `product_id`, `user_id`) VALUES
(1, '2024-08-03', 66, 21),
(2, '2024-08-04', 68, 21),
(3, '2024-08-09', 63, 18),
(4, '2024-10-05', 73, 18),
(5, '2024-10-05', 72, 22),
(6, '2024-10-09', 67, 18),
(7, '2024-10-27', 77, 23),
(8, '2024-10-30', 68, 18),
(9, '2024-11-01', 70, 24),
(10, '2024-11-01', 67, 26);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `tbl_deliveryagent`
--
ALTER TABLE `tbl_deliveryagent`
  ADD PRIMARY KEY (`deliveryagent_id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `tbl_place`
--
ALTER TABLE `tbl_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `tbl_seller`
--
ALTER TABLE `tbl_seller`
  ADD PRIMARY KEY (`seller_id`);

--
-- Indexes for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD PRIMARY KEY (`wishlist_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `booking_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_deliveryagent`
--
ALTER TABLE `tbl_deliveryagent`
  MODIFY `deliveryagent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_seller`
--
ALTER TABLE `tbl_seller`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
