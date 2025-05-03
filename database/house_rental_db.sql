-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2025 at 04:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `house_rental_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Duplex (căn hộ thông tầng)'),
(2, 'Nhà đơn/ Nhà riêng'),
(3, 'Khu căn hộ'),
(4, 'Nhà 2 tầng'),
(5, 'Biệt thự'),
(6, 'Nhà cấp 4'),
(7, 'Chung cư');

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL DEFAULT 1,
  `house_no` varchar(50) NOT NULL,
  `category_id` int(30) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `address` varchar(300) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`id`, `user_id`, `house_no`, `category_id`, `description`, `price`, `address`, `image`, `created_at`) VALUES
(2, 1, 'Biệt thự số 1', 5, 'Biệt thự 300m², 3 tầng sân vườn đẹp, xe cộ thoải mái, mặt Hồ Tây, tiện ở kinh doanh, làm cty vv. Cho thuê lâu dài ổn định. Chọn các công ty có thương hiệu, uy tín trên thị trường để gửi gắm lâu dài. Giá thuê ổn định phù hợp thị trường. Ưu tiên thuê để ở.\r\nMặt Phố Từ Hoa - Xuân Diệu con phố VIP của Hồ Tây!', 180000000, 'TP.HCM', 'uploads/1745912955_bietthu-1.jpg', '2025-04-29 15:39:43'),
(3, 1, 'Nhà bình thường 1', 1, 'Nhà 2 tầng, 4PN + 1; tại mặt phố Bạch Mai, Hai Bà Trưng, Hà Nội đang cần cho thuê.', 8000000, 'Hà Nội', 'uploads/1745912987_canho-1.jpg', '2025-04-29 15:40:32'),
(4, 1, 'Nhà bình thường 62', 4, 'nhà đẹp có đủ tiện nghi', 2500000, 'Huế', 'uploads/1745913029_nha2tang-1.jpg', '2025-04-29 14:50:29'),
(12, 1, 'Nhà 2 tầng nhỏ', 4, 'nhỏ', 3000000, 'TP.HCM', 'uploads/1745913067_nha2tang-2.jpg', '2025-04-29 14:51:07'),
(13, 1, 'Biệt thự số 20', 5, 'nhà biệt thự siêu to khổng lồ á', 250000000, 'Bình Dương', 'uploads/1745913087_bietthu-2.png', '2025-04-29 14:51:27'),
(14, 1, 'Nhà nghèo 0', 6, 'nhỏ lắm', 2000000, 'TP.HCM', 'uploads/1745913111_nhacap4-1.jpg', '2025-04-29 14:51:51'),
(16, 1, 'Nhà bình thường 628', 3, 'Nhà đủ tiện nghi', 2000000, 'Tuyên Quang', 'uploads/1745913143_canho-2.jpg', '2025-04-29 14:52:23'),
(25, 2, 'Nhà bình thường', 2, 'phù hợp ở 1 mình', 3000000, 'Tuyên Quang', 'uploads/1745913306_nharieng-1.jpg', '2025-04-29 14:55:06'),
(30, 1, 'Biệt thự số 1', 5, 'Biệt thự hiện đại rộng rãi', 180000000, 'HCM', 'uploads/1745913256_bietthu-3.png', '2025-04-29 14:54:16'),
(32, 2, 'Biệt thự số 1', 2, 'Phù hợp với gia đình hạt nhân', 18000000, 'HCM', 'uploads/1745913489_nharieng-2.PNG', '2025-04-29 14:58:09'),
(36, 2, 'chung cư 1', 7, 'sạch', 5000000, 'hn', 'uploads/1746170821_chungcu-3.jpg', '2025-05-02 09:41:40'),
(40, 1, 'nhà cấp 4', 6, 'nhà cấp 4 bình thường', 5000000, 'TP.HCM', 'uploads/1746281114_nhacap4-3.jpg', '2025-05-03 21:05:14'),
(46, 2, 'nhà cấp 4', 6, 'nhỏ lắm', 5000000, 'hn', 'uploads/1746282449_nhacap4-4.jpg', '2025-05-03 16:27:29');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_requests`
--

CREATE TABLE `maintenance_requests` (
  `id` int(11) NOT NULL,
  `tenant_name` varchar(255) NOT NULL,
  `room_number` varchar(50) NOT NULL,
  `issue` text NOT NULL,
  `request_date` date NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Đang sửa','Đã sửa xong') DEFAULT 'Đang sửa',
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintenance_requests`
--

INSERT INTO `maintenance_requests` (`id`, `tenant_name`, `room_number`, `issue`, `request_date`, `image_path`, `created_at`, `status`, `user_id`) VALUES
(1, 'nguoidungb', '101', 'mất nước', '2025-04-29', NULL, '2025-04-29 07:08:17', 'Đang sửa', NULL),
(2, 'nguoidungb', '101', 'MẤT NƯỚC', '2025-05-03', NULL, '2025-05-03 14:52:08', 'Đang sửa', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT 'general',
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `message`, `created_at`, `user_id`, `type`, `is_read`) VALUES
(1, 'admin thông báo', 'cắt điện từ 10h ngày 29/4 đến 10h ngày 30/4', '2025-04-29 03:35:29', NULL, 'general', 0),
(2, 'admin', 'không có gì', '2025-04-29 03:42:41', NULL, 'general', 0),
(3, 'Yêu cầu bảo trì', '🔧 Người dùng nguoidungb đã gửi yêu cầu bảo trì phòng 101', '2025-05-03 14:52:08', NULL, 'user_to_admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(30) NOT NULL,
  `tenant_id` int(30) NOT NULL,
  `amount` float NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `review_text` text DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `house_id` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `date_in` date NOT NULL,
  `time_in` time NOT NULL,
  `location` varchar(100) NOT NULL,
  `house_type` varchar(100) NOT NULL,
  `price_range` varchar(100) NOT NULL,
  `note` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `name`, `house_id`, `phone`, `date_in`, `time_in`, `location`, `house_type`, `price_range`, `note`, `status`) VALUES
(1, 'Nguyễn B', 46, '0967528690', '2025-05-10', '21:50:00', 'Ba Đình', 'Chung cư', 'Dưới 1 tỷ', 'KHÔNG', 0);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'House Rental Management System', 'suarez081119@gmail.com', '+639272777334', '1603344720_1602738120_pngtree-purple-hd-business-banner-image_5493.jpg', '&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&rsquo;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `id` int(30) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `house_id` int(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = active, 0= inactive',
  `date_in` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address_user` varchar(300) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cccd` varchar(12) NOT NULL,
  `gender` varchar(10) NOT NULL DEFAULT 'male',
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=Admin,2=Staff',
  `dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `phone`, `address_user`, `email`, `cccd`, `gender`, `type`, `dob`) VALUES
(1, 'Administrator', 'admin', '0192023a7bbd73250516f069df18b500', '0912345678', 'dịch vọng hậu, cầu giấy, hà nội', 'admin@gmail.com', '012345678912', 'male', 1, '2005-03-08'),
(2, 'Nguyễn B', 'nguoidungb', '827ccb0eea8a706c4c34a16891f84e7b', '0967528690', 'quận 1, thành phố hồ chí minh', 'b@gmail.com', '092865820027', 'female', 2, '1998-03-12'),
(3, 'A', 'NA', '827ccb0eea8a706c4c34a16891f84e7b', '1234567890', 'TP HCM', 'nguyenthilehang29112004@gmai.com', '098765432123', 'male', 2, '2002-05-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_houses_category` (`category_id`),
  ADD KEY `fk_houses_user` (`user_id`);

--
-- Indexes for table `maintenance_requests`
--
ALTER TABLE `maintenance_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_payments_tenant` (`tenant_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reviews_house` (`house_id`),
  ADD KEY `fk_reviews_tenant` (`tenant_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_schedules_houses` (`house_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tenants_house` (`house_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `maintenance_requests`
--
ALTER TABLE `maintenance_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `houses`
--
ALTER TABLE `houses`
  ADD CONSTRAINT `fk_houses_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_houses_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payments_tenant` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_house` FOREIGN KEY (`house_id`) REFERENCES `houses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reviews_tenant` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `fk_schedules_houses` FOREIGN KEY (`house_id`) REFERENCES `houses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tenants`
--
ALTER TABLE `tenants`
  ADD CONSTRAINT `fk_tenants_house` FOREIGN KEY (`house_id`) REFERENCES `houses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
