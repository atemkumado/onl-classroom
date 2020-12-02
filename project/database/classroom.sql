-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 30, 2020 lúc 11:42 AM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `classroom`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `course_id` int(10) NOT NULL,
  `description` text NOT NULL,
  `file` text DEFAULT NULL,
  `time` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `activity`
--

INSERT INTO `activity` (`id`, `course_id`, `description`, `file`, `time`) VALUES
(184, 27, 'Lession 1', '', '2020-11-30'),
(185, 27, 'Lession 2', '', '2020-11-30'),
(186, 27, 'Lession 3', 'Webdriver để test web.docx', '2020-11-30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `activity_comment`
--

CREATE TABLE `activity_comment` (
  `activity_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `activity_comment`
--

INSERT INTO `activity_comment` (`activity_id`, `comment_id`) VALUES
(184, 80),
(184, 81);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(250) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `content`, `date`) VALUES
(80, 15, 'Ok', '2020-11-30'),
(81, 14, 'ok', '2020-11-30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `course`
--

CREATE TABLE `course` (
  `id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `gr` varchar(30) NOT NULL,
  `shift` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `course`
--

INSERT INTO `course` (`id`, `user_id`, `name`, `gr`, `shift`) VALUES
(27, 13, 'Web', '3', '2'),
(29, 14, 'TDS1', '5', '3'),
(30, 15, 'Android', '2', '2');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `course_activity`
--

CREATE TABLE `course_activity` (
  `course_id` int(10) NOT NULL,
  `activity_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `course_activity`
--

INSERT INTO `course_activity` (`course_id`, `activity_id`) VALUES
(27, 184),
(27, 185),
(27, 186);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `date` date NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `email`, `phone`, `date`, `password`) VALUES
(13, 'long', 'Long', 'long123@gmail.com', '08137571233', '2020-11-22', '123 '),
(14, 'kumado', 'kumado', 'kumado@gmail.com', '0912385432', '2020-11-25', '123 '),
(15, 'hieu', 'hieu', 'hieu@gmail.com', '0812313414', '2000-02-25', '123 '),
(16, 'admin', 'admin', 'admin@gmail.com', '1234567', '2020-11-10', '123 '),
(17, 'kien', 'kinhbinhphuoc', 'kinh123@gmail.com', '123', '2020-11-12', '123 ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_activity`
--

CREATE TABLE `user_activity` (
  `user_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user_activity`
--

INSERT INTO `user_activity` (`user_id`, `activity_id`) VALUES
(13, 184),
(13, 185),
(13, 186);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_comment`
--

CREATE TABLE `user_comment` (
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user_comment`
--

INSERT INTO `user_comment` (`user_id`, `comment_id`) VALUES
(15, 80),
(14, 81);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_course`
--

CREATE TABLE `user_course` (
  `user_id` int(11) NOT NULL,
  `course_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user_course`
--

INSERT INTO `user_course` (`user_id`, `course_id`) VALUES
(13, 27),
(14, 29),
(15, 30),
(15, 27);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_activity` (`course_id`);

--
-- Chỉ mục cho bảng `activity_comment`
--
ALTER TABLE `activity_comment`
  ADD KEY `ac_activity_id_FK` (`activity_id`),
  ADD KEY `ac_comment_id_FK` (`comment_id`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `course_activity`
--
ALTER TABLE `course_activity`
  ADD KEY `conn_activity` (`activity_id`),
  ADD KEY `course_w_activity` (`course_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user_activity`
--
ALTER TABLE `user_activity`
  ADD KEY `activity_id_FK` (`activity_id`),
  ADD KEY `user_id_FK` (`user_id`);

--
-- Chỉ mục cho bảng `user_comment`
--
ALTER TABLE `user_comment`
  ADD KEY `uc_user_id_FK` (`user_id`),
  ADD KEY `uc_comment_id_FK` (`comment_id`);

--
-- Chỉ mục cho bảng `user_course`
--
ALTER TABLE `user_course`
  ADD KEY `conn_course` (`course_id`),
  ADD KEY `conn_user` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT cho bảng `course`
--
ALTER TABLE `course`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `course_activity` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);

--
-- Các ràng buộc cho bảng `activity_comment`
--
ALTER TABLE `activity_comment`
  ADD CONSTRAINT `ac_activity_id_FK` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`),
  ADD CONSTRAINT `ac_comment_id_FK` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`);

--
-- Các ràng buộc cho bảng `course_activity`
--
ALTER TABLE `course_activity`
  ADD CONSTRAINT `conn_activity` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`),
  ADD CONSTRAINT `course_w_activity` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);

--
-- Các ràng buộc cho bảng `user_activity`
--
ALTER TABLE `user_activity`
  ADD CONSTRAINT `activity_id_FK` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`),
  ADD CONSTRAINT `user_id_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `user_comment`
--
ALTER TABLE `user_comment`
  ADD CONSTRAINT `uc_comment_id_FK` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`),
  ADD CONSTRAINT `uc_user_id_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `user_course`
--
ALTER TABLE `user_course`
  ADD CONSTRAINT `conn_course` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `conn_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
