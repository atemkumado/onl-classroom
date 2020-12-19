-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2020 at 04:44 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `classroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `course_id` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `file` text DEFAULT NULL,
  `time` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `course_id`, `description`, `file`, `time`) VALUES
(191, '98772', 'Kiểm tra qua trình ngày 10/12, các em đi học đầy đủ nhé!', '', '2020-12-01'),
(192, '7264e', 'Các em làm bài kiểm tra trên Elearning trước khi học tại Hội trường', '', '2020-12-01'),
(193, '0ba52', 'Các em thực hiện đúng quy định doanh nghiệp trong quá trình học thực tập nhé!', '', '2020-12-01'),
(196, '76369', 'Thứ 5 tuần này kiểm tra 20% trên lớp, các em đi học đầy đủ', '', '2020-12-01'),
(200, '0ba52', 'Hình ảnh hoạt động', 'uploads/AH3IK.jfif', '2020-12-01'),
(201, 'f301e', 'Ảnh Bác Hồ', 'uploads/Bac Ho moi GS Tran Dai Nghia ve nuoc.jpg', '2020-12-02'),
(205, 'f301e', 'Ảnh Bác Hồ với đồng bào', 'uploads/6j2ef9pniv-74999_13645223721838383162_Anh_19.4_w550.jpg', '2020-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `activity_comment`
--

CREATE TABLE `activity_comment` (
  `activity_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activity_comment`
--

INSERT INTO `activity_comment` (`activity_id`, `comment_id`) VALUES
(193, 88),
(191, 90),
(191, 91);

-- --------------------------------------------------------

--
-- Table structure for table `backgrounds`
--

CREATE TABLE `backgrounds` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `backgrounds`
--

INSERT INTO `backgrounds` (`id`, `image`) VALUES
(1, 'img/Backtoschool.jpg'),
(2, 'img/Code.jpg'),
(3, 'img/Design.jpg'),
(4, 'img/Geography.jpg'),
(5, 'img/Geometry.jpg'),
(6, 'img/Physics.jpg'),
(7, 'img/Violin.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(250) NOT NULL,
  `date` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `content`, `date`) VALUES
(88, 20, 'Cám ơn thầy ạ', '2020-12-01'),
(90, 19, 'hôm đó nhà em có cv ạ. cho em xin bù bữa khác đc k thầy?', '2020-12-01'),
(91, 20, 'Oke em', '2020-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gr` varchar(30) NOT NULL,
  `shift` varchar(30) NOT NULL,
  `background` text  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `user_id`, `name`, `gr`, `shift`, `background`) VALUES
('0ba52', 18, 'Thực tập doanh nghiệp', 'F507', '3', 'img/Geography.jpg'),
('32f5e', 21, 'ĐƯỜNG LỐI CM CỦA ĐCSVN', '34', '3', 'img\\Backtoschool.jpg'),
('7264e', 20, 'Thái độ sống 2', '23', '1', 'img\\Backtoschool.jpg'),
('76369', 18, 'Phương Pháp Lập Trình', '20', '2', 'img\\Backtoschool.jpg'),
('98772', 20, 'Cầu lông', '27', '4', 'img/Physics.jpg'),
('e7b6e', 21, 'Học thuyết Mac-Lenin', '43', '4', 'img/Violin.jpg'),
('f301e', 21, 'Tư tưởng HCM', '12', '3', 'img/Geography.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `course_activity`
--

CREATE TABLE `course_activity` (
  `course_id` varchar(10) NOT NULL,
  `activity_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_activity`
--

INSERT INTO `course_activity` (`course_id`, `activity_id`) VALUES
('98772', 191),
('7264e', 192),
('0ba52', 193),
('76369', 196),
('0ba52', 200),
('f301e', 201),
('f301e', 205);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `date` date NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'img/user.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `email`, `phone`, `date`, `avatar`) VALUES
(18, 'hieutada', '25f9e794323b453885f5181f1b624d0b', 'Hieu Ta', 'hieutada2k@gmail.com', '0833432056', '2000-02-02', 'img/user.png'),
(19, 'thanhlong', '25f9e794323b453885f5181f1b624d0b', 'Thanh Long', 'thanhlong@gmail.com', '0923567343', '2000-01-01', 'img/user.png'),
(20, 'toanpham', '25f9e794323b453885f5181f1b624d0b', 'Toan Pham', 'hongtoan20042000@gmail.com', '0918472345', '2000-06-01', 'img/user.png'),
(21, 'quocminh', '25f9e794323b453885f5181f1b624d0b', 'Tran Quoc Minh', 'quocminh1975@gmail.com', '0918304304', '1975-01-01', 'img/user.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE `user_activity` (
  `user_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`user_id`, `activity_id`) VALUES
(20, 191),
(20, 192),
(18, 193),
(18, 196),
(18, 200),
(21, 201),
(21, 205);

-- --------------------------------------------------------

--
-- Table structure for table `user_comment`
--

CREATE TABLE `user_comment` (
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_comment`
--

INSERT INTO `user_comment` (`user_id`, `comment_id`) VALUES
(20, 88),
(19, 90),
(20, 91);

-- --------------------------------------------------------

--
-- Table structure for table `user_course`
--

CREATE TABLE `user_course` (
  `user_id` int(11) NOT NULL,
  `course_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_course`
--

INSERT INTO `user_course` (`user_id`, `course_id`) VALUES
(18, '0ba52'),
(18, '76369'),
(20, '0ba52'),
(20, '98772'),
(20, '7264e'),
(19, '98772'),
(19, '76369'),
(21, '32f5e'),
(21, 'f301e'),
(21, 'e7b6e'),
(20, 'f301e'),
(19, 'f301e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_activity` (`course_id`);

--
-- Indexes for table `activity_comment`
--
ALTER TABLE `activity_comment`
  ADD KEY `ac_activity_id_FK` (`activity_id`),
  ADD KEY `ac_comment_id_FK` (`comment_id`);

--
-- Indexes for table `backgrounds`
--
ALTER TABLE `backgrounds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_activity`
--
ALTER TABLE `course_activity`
  ADD KEY `conn_activity` (`activity_id`),
  ADD KEY `course_w_activity` (`course_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD KEY `activity_id_FK` (`activity_id`),
  ADD KEY `user_id_FK` (`user_id`);

--
-- Indexes for table `user_comment`
--
ALTER TABLE `user_comment`
  ADD KEY `uc_user_id_FK` (`user_id`),
  ADD KEY `uc_comment_id_FK` (`comment_id`);

--
-- Indexes for table `user_course`
--
ALTER TABLE `user_course`
  ADD KEY `conn_course` (`course_id`),
  ADD KEY `conn_user` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `backgrounds`
--
ALTER TABLE `backgrounds`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `course_activity` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);

--
-- Constraints for table `activity_comment`
--
ALTER TABLE `activity_comment`
  ADD CONSTRAINT `ac_activity_id_FK` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`),
  ADD CONSTRAINT `ac_comment_id_FK` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`);

--
-- Constraints for table `course_activity`
--
ALTER TABLE `course_activity`
  ADD CONSTRAINT `conn_activity` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`),
  ADD CONSTRAINT `course_w_activity` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);

--
-- Constraints for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD CONSTRAINT `activity_id_FK` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`),
  ADD CONSTRAINT `user_id_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_comment`
--
ALTER TABLE `user_comment`
  ADD CONSTRAINT `uc_comment_id_FK` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`),
  ADD CONSTRAINT `uc_user_id_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_course`
--
ALTER TABLE `user_course`
  ADD CONSTRAINT `conn_course` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `conn_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
