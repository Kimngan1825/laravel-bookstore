-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2026 at 02:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.5.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(100) NOT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`, `bio`) VALUES
(1, 'Nguyễn Nhật Ánh', 'Nhà văn nổi tiếng'),
(2, 'J.K. Rowling', 'Tác giả Harry Potter'),
(3, 'Tun Phạm', NULL),
(4, 'Stephen Hawking', NULL),
(5, 'Carl Sagan', NULL),
(6, 'Phạm Huy Hoàng', NULL),
(7, 'Benjamin Graham', NULL),
(8, 'Song Hong Bing', NULL),
(9, 'Sergio Zyman', NULL),
(10, 'Dale Carnegie', NULL),
(11, 'Rosie Nguyễn', NULL),
(12, 'Andrew Matthews', NULL),
(13, 'Nguyễn Hiến Lê', NULL),
(14, 'Tony Buzan', NULL),
(15, 'Eran Katz', NULL),
(16, 'Gustave Le Bon', NULL),
(17, 'Dan Ariely', NULL),
(18, 'Thích Nhất Hạnh', NULL),
(19, 'Tô Hoài', NULL),
(20, 'Luis Sepúlveda', NULL),
(21, 'Antoine de Saint-Exupéry', NULL),
(22, 'Haruki Murakami', NULL),
(23, 'Mario Puzo', NULL),
(24, 'Jeffrey Archer', NULL),
(25, 'Fujiko F. Fujio', NULL),
(26, 'Gosho Aoyama', NULL),
(27, 'Eiichiro Oda', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `publisher` varchar(100) DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL COMMENT 'Nhà cung cấp',
  `cover_type` varchar(50) DEFAULT NULL COMMENT 'Hình thức bìa: Bìa mềm/Bìa cứng',
  `publication_year` int(11) DEFAULT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `stock` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1 COMMENT 'Soft Delete',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `language` varchar(50) DEFAULT 'Tiếng Việt' COMMENT 'Ngôn ngữ',
  `weight` int(11) DEFAULT NULL COMMENT 'Trọng lượng (gram)',
  `size` varchar(50) DEFAULT NULL COMMENT 'Kích thước (cm)',
  `page_count` int(11) DEFAULT NULL COMMENT 'Số trang',
  `discount` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author_id`, `category_id`, `publisher`, `supplier`, `cover_type`, `publication_year`, `isbn`, `price`, `stock`, `description`, `image`, `is_active`, `created_at`, `language`, `weight`, `size`, `page_count`, `discount`) VALUES
(1, 'Mắt Biếc', 1, NULL, 'NXB Trẻ', NULL, NULL, NULL, '978-604-1-12345-6', 110000.00, 47, 'Tiểu thuyết tuổi học trò tại làng Đo Đo.', 'mat_biec.jpg', 1, '2025-12-19 04:00:46', 'Tiếng Việt', NULL, NULL, NULL, 20),
(2, 'Harry Potter 1', 2, 1, 'NXB Trẻ', 'Skybooks', 'Bìa mềm', 2004, '978-0-7475-3274-3', 150000.00, 99, 'Tập đầu series phù thủy nổi tiếng.', '1766813229_hary.jpg', 1, '2025-12-19 04:00:46', 'Tiếng Việt', 0, '20.5 x 13.5 x 1.2 cm', 220, 15),
(3, 'The God Father', 2, NULL, 'Kim Đồng', NULL, NULL, 2025, '123', 100000.00, 7, 'Tiểu thuyết hình sự kinh điển (demo).', 'god_father.jpg', 0, '2025-12-21 16:50:56', 'Tiếng Việt', NULL, NULL, NULL, 20),
(4, 'The God Father (bản 2)', 2, NULL, 'Kim Đồng', NULL, NULL, 2025, '123', 100000.00, 10, 'Bản khác dùng ảnh upload.', 'book_1766336783_3959.webp', 0, '2025-12-21 16:51:06', 'Tiếng Việt', NULL, NULL, NULL, 15),
(5, 'Hello (demo)', 1, 1, '', '', '', 0, NULL, 100000.00, 0, 'Sách test dữ liệu.', 'default_book.jpg', 1, '2025-12-25 16:23:21', 'Tiếng Việt', 0, '', 0, 20),
(6, 'Bạn là cậu nhỏ của tớ', 3, NULL, 'Phụ nữ việt nam', 'Skybooks', 'Bìa mềm', 2023, NULL, 84000.00, 50, 'Vì Cậu Là Bạn Nhỏ Của Tớ\r\n\r\nVì cậu là bạn nhỏ của tớ” là cuốn sách đầu tay đánh dấu chặng hành trình phát triển, nỗ lực không ngừng nghỉ của Tác giả, MC, Content Creator Tun Phạm.\r\n\r\nNhờ vào góc nhìn và tâm tư sâu sắc, quyển sách như cẩm nang đồng hành cùng thế hệ trẻ vượt qua cơn bão “overthinking” với những cảm xúc, suy nghĩ tiêu cực trong các vấn đề khó khăn thường gặp.\r\n\r\nGenZ có lẽ là một thế hệ luôn loay hoay, bối rối với câu hỏi: “Liệu mình là ai và mình cần làm gì khi đến với thế giới này?”. Tác giả sẽ cùng bạn bước thật vững trong chặng đường thấu hiểu thế giới nội tâm, đưa ra các giải pháp cho các vấn đề thường nhật như: \r\n\r\n - Làm thế nào để người hướng nội có thể giao tiếp, ứng xử tốt hơn.\r\n\r\n- Thực hành tư duy biết ơn để trân trọng thực tại và khởi đầu niềm hạnh phúc tự thân.\r\n\r\n- Kiểm soát cơn lốc “overthinking” khiến người trẻ tổn hao tâm lực.\r\n\r\n- Khám phá giá trị nội tại và bí kíp tự tạo cơ hội giúp bản thân “rực sáng”.\r\n\r\n- Và nhiều vấn đề phổ biến mà người trẻ đang bận tâm tìm lời giải.\r\n\r\nBạn sẽ không còn cô độc, vì đã có tác giả dìu dắt bạn vượt qua những khoảng tối của hành trình trưởng thành, giúp bạn không còn lạc lối và dần tìm thấy hướng đi mà bạn vốn có.\r\n\r\nMong bạn luôn nhớ rằng: “Thật may mắn khi chúng ta gặp được nhau ở kiếp này. Vậy nên đừng vì những chuyện nhỏ nhặt mà rời đi nhé.”\r\n\r\nSau tất cả bạn luôn xứng đáng được trân trọng, thấu hiểu, Tun luôn bên bạn!', '1766745224_ban_nho.jpg', 1, '2025-12-26 10:33:44', 'Tiếng Việt', 260, '20.5 x 13.5 x 1.2 cm', 240, 15),
(7, 'Lược Sử Thời Gian', 1, 1, 'NXB Trẻ', 'Nhã Nam', 'Bìa mềm', 2023, NULL, 115000.00, 37, 'Cuốn sách khám phá những bí ẩn lớn nhất của vũ trụ, từ Big Bang đến lỗ đen, được viết bởi nhà vật lý thiên tài Stephen Hawking.', 'b1.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 300, '14 x 20.5 cm', 280, 20),
(8, 'Vũ Trụ (Cosmos)', 2, 1, 'NXB Thế Giới', 'Nhã Nam', 'Bìa cứng', 2022, NULL, 269000.00, 27, 'Hành trình khám phá vũ trụ vĩ đại, sự sống và nền văn minh nhân loại qua lăng kính khoa học đầy chất thơ.', 'b2.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 800, '16 x 24 cm', 500, 15),
(9, 'Code Dạo Ký Sự', 3, 1, 'NXB Dân Trí', 'Fahasa', 'Bìa mềm', 2021, NULL, 129000.00, 100, 'Những câu chuyện đời thường, hài hước nhưng thấm đẫm kinh nghiệm xương máu của một lập trình viên Full-stack.', 'b3.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 350, '14.5 x 20.5 cm', 320, 30),
(10, 'Nhà Đầu Tư Thông Minh', 4, 2, 'NXB Lao Động', 'Alpha Books', 'Bìa mềm', 2023, NULL, 199000.00, 27, 'Cuốn sách gối đầu giường cho mọi nhà đầu tư chứng khoán, dạy bạn cách đầu tư giá trị và kiểm soát cảm xúc.', 'b4.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 600, '16 x 24 cm', 600, 30),
(11, 'Chiến Tranh Tiền Tệ', 5, 2, 'NXB Lao Động', 'Alpha Books', 'Bìa mềm', 2020, NULL, 168000.00, 42, 'Bức màn bí mật về lịch sử tiền tệ thế giới và những âm mưu tài chính đứng sau các sự kiện lịch sử lớn.', 'b5.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 500, '15 x 23 cm', 450, 0),
(12, 'Marketing Giỏi Phải Kiếm Được Tiền', 6, 2, 'NXB Kinh Tế', 'Alpha Books', 'Bìa mềm', 2022, NULL, 145000.00, 60, 'Marketing không chỉ là sáng tạo, mục đích cuối cùng phải là bán được hàng. Cuốn sách thực chiến cho dân Marketer.', 'b6.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 400, '14 x 20.5 cm', 380, 0),
(13, 'Đắc Nhân Tâm (Khổ Lớn)', 7, 3, 'NXB Tổng Hợp TPHCM', 'First News', 'Bìa mềm', 2024, NULL, 86000.00, 200, 'Nghệ thuật thu phục lòng người. Cuốn sách self-help bán chạy nhất mọi thời đại.', 'b7.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 350, '14.5 x 20.5 cm', 320, 0),
(14, 'Tuổi Trẻ Đáng Giá Bao Nhiêu', 8, 3, 'NXB Hội Nhà Văn', 'Nhã Nam', 'Bìa mềm', 2021, NULL, 90000.00, 150, 'Kim chỉ nam cho người trẻ đang lạc lối, khơi dậy đam mê đọc sách và tự học.', 'b8.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 280, '13 x 20.5 cm', 290, 0),
(15, 'Đời Thay Đổi Khi Chúng Ta Thay Đổi', 9, 3, 'NXB Trẻ', 'NXB Trẻ', 'Bìa mềm', 2023, NULL, 78000.00, 80, 'Tập sách tranh hài hước giúp bạn nhìn nhận cuộc sống lạc quan và tích cực hơn.', 'b9.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 200, '14 x 20 cm', 250, 0),
(16, 'Tự Học - Một Nhu Cầu Thời Đại', 10, 4, 'NXB Văn Hóa', 'NXB Văn Hóa', 'Bìa mềm', 2019, NULL, 65000.00, 50, 'Phương pháp tự học hiệu quả để thích nghi với sự thay đổi không ngừng của tri thức nhân loại.', 'b10.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 200, '13 x 19 cm', 200, 0),
(17, 'Sơ Đồ Tư Duy (Mind Map)', 11, 4, 'NXB Lao Động', 'Alpha Books', 'Bìa mềm', 2022, NULL, 120000.00, 70, 'Công cụ vạn năng để kích hoạt não bộ, giúp ghi nhớ và sáng tạo vượt trội.', 'b11.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 300, '15 x 15 cm', 220, 0),
(18, 'Bí Mật Của Một Trí Nhớ Siêu Phàm', 12, 4, 'NXB Lao Động', 'Alpha Books', 'Bìa mềm', 2021, NULL, 110000.00, 40, 'Phương pháp rèn luyện trí nhớ từ kỷ lục gia Guinness, giúp bạn nhớ lâu và học nhanh hơn.', 'b12.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 350, '14 x 20.5 cm', 300, 0),
(19, 'Tâm Lý Học Đám Đông', 13, 5, 'NXB Thế Giới', 'Nhã Nam', 'Bìa mềm', 2020, NULL, 135000.00, 30, 'Nghiên cứu kinh điển về cách đám đông suy nghĩ và hành động, lý giải các hiện tượng xã hội.', 'b13.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 400, '14 x 20.5 cm', 380, 0),
(20, 'Phi Lý Trí', 14, 5, 'NXB Lao Động', 'Alpha Books', 'Bìa mềm', 2023, NULL, 155000.00, 45, 'Tại sao chúng ta lại hành động trái logic? Cuốn sách bóc trần những điểm mù trong tư duy con người.', 'b14.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 450, '14 x 20.5 cm', 420, 0),
(21, 'Giận', 15, 5, 'NXB Hồng Đức', 'Phương Nam', 'Bìa mềm', 2022, NULL, 88000.00, 100, 'Phương pháp chuyển hóa cơn giận thành năng lượng tích cực và yêu thương của Thiền sư Thích Nhất Hạnh.', 'b15.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 250, '13 x 20 cm', 240, 0),
(22, 'Dế Mèn Phiêu Lưu Ký', 16, 6, 'NXB Kim Đồng', 'Kim Đồng', 'Bìa cứng', 2024, NULL, 50000.00, 300, 'Tác phẩm văn học thiếu nhi kinh điển nhất Việt Nam về chú dế mèn cường tráng và những bài học đường đời.', 'b16.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 150, '18 x 25 cm', 140, 0),
(23, 'Chuyện Con Mèo Dạy Hải Âu Bay', 17, 6, 'NXB Hội Nhà Văn', 'Nhã Nam', 'Bìa mềm', 2023, NULL, 45000.00, 200, 'Câu chuyện cảm động về lời hứa, tình yêu thương và nỗ lực vượt qua giới hạn bản thân.', 'b17.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 120, '14 x 20.5 cm', 140, 0),
(24, 'Hoàng Tử Bé', 18, 6, 'NXB Hội Nhà Văn', 'Nhã Nam', 'Bìa cứng', 2022, NULL, 75000.00, 150, 'Cuốn sách dành cho trẻ em nhưng người lớn đọc lại càng thấm thía về tình yêu và tình bạn.', 'b18.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 130, '19 x 24 cm', 90, 0),
(25, 'Rừng Na Uy', 19, 7, 'NXB Hội Nhà Văn', 'Nhã Nam', 'Bìa mềm', 2021, NULL, 140000.00, 60, 'Bản tình ca u sầu và ám ảnh về tuổi trẻ, tình yêu và sự mất mát của Haruki Murakami.', 'b19.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 500, '14 x 20.5 cm', 550, 0),
(26, 'Bố Già (The Godfather)', 20, 7, 'NXB Văn Học', 'Đông A', 'Bìa mềm', 2023, NULL, 180000.00, 40, 'Tuyệt tác về thế giới ngầm Mafia, về gia đình, danh dự và quyền lực.', 'b20.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 600, '16 x 24 cm', 650, 0),
(27, 'Hai Số Phận', 21, 7, 'NXB Văn Học', 'Huy Hoàng', 'Bìa mềm', 2020, NULL, 160000.00, 35, 'Câu chuyện đầy kịch tính về cuộc đời của hai người đàn ông sinh cùng ngày giờ nhưng khác biệt hoàn toàn về số phận.', 'b21.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 700, '14.5 x 20.5 cm', 720, 0),
(28, 'Doraemon Truyện Ngắn - Tập 1', 22, 8, 'NXB Kim Đồng', 'Kim Đồng', 'Bìa mềm', 2024, NULL, 25000.00, 500, 'Khởi đầu của tình bạn đẹp giữa chú mèo máy và cậu bé Nobita.', 'b22.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 150, '11.3 x 17.6 cm', 192, 0),
(29, 'Thám Tử Lừng Danh Conan - Tập 100', 23, 8, 'NXB Kim Đồng', 'Kim Đồng', 'Bìa mềm', 2023, NULL, 25000.00, 400, 'Tập kỷ niệm cột mốc lịch sử với vụ án đối đầu Tổ chức Áo đen gay cấn.', 'b23.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 150, '11.3 x 17.6 cm', 180, 0),
(30, 'One Piece - Tập 100', 24, 8, 'NXB Kim Đồng', 'Kim Đồng', 'Bìa mềm', 2023, NULL, 25000.00, 450, 'Hành trình chinh phục kho báu One Piece của Luffy Mũ Rơm.', 'b24.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 150, '11.3 x 17.6 cm', 200, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `description`) VALUES
(1, 'Khoa học - Kỹ thuật', NULL),
(2, 'Kinh tế', NULL),
(3, 'Kỹ năng sống', NULL),
(4, 'Sách học tập', NULL),
(5, 'Tâm lý - Xã hội', NULL),
(6, 'Thiếu nhi', NULL),
(7, 'Tiểu thuyết', NULL),
(8, 'Truyện tranh', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`) VALUES
(1, 'An Giang'),
(2, 'Bà Rịa - Vũng Tàu'),
(3, 'Bắc Giang'),
(4, 'Bắc Kạn'),
(5, 'Bạc Liêu'),
(6, 'Bắc Ninh'),
(7, 'Bến Tre'),
(8, 'Bình Định'),
(9, 'Bình Dương'),
(10, 'Bình Phước'),
(11, 'Bình Thuận'),
(12, 'Cà Mau'),
(13, 'Cần Thơ'),
(14, 'Cao Bằng'),
(15, 'Đà Nẵng'),
(16, 'Đắk Lắk'),
(17, 'Đắk Nông'),
(18, 'Điện Biên'),
(19, 'Đồng Nai'),
(20, 'Đồng Tháp'),
(21, 'Gia Lai'),
(22, 'Hà Giang'),
(23, 'Hà Nam'),
(24, 'Hà Nội'),
(25, 'Hà Tĩnh'),
(26, 'Hải Dương'),
(27, 'Hải Phòng'),
(28, 'Hậu Giang'),
(29, 'Hòa Bình'),
(30, 'Hưng Yên'),
(31, 'Khánh Hòa'),
(32, 'Kiên Giang'),
(33, 'Kon Tum'),
(34, 'Lai Châu'),
(35, 'Lâm Đồng'),
(36, 'Lạng Sơn'),
(37, 'Lào Cai'),
(38, 'Long An'),
(39, 'Nam Định'),
(40, 'Nghệ An'),
(41, 'Ninh Bình'),
(42, 'Ninh Thuận'),
(43, 'Phú Thọ'),
(44, 'Phú Yên'),
(45, 'Quảng Bình'),
(46, 'Quảng Nam'),
(47, 'Quảng Ngãi'),
(48, 'Quảng Ninh'),
(49, 'Quảng Trị'),
(50, 'Sóc Trăng'),
(51, 'Sơn La'),
(52, 'Tây Ninh'),
(53, 'Thái Bình'),
(54, 'Thái Nguyên'),
(55, 'Thanh Hóa'),
(56, 'Thừa Thiên Huế'),
(57, 'Tiền Giang'),
(58, 'TP. Hồ Chí Minh'),
(59, 'Trà Vinh'),
(60, 'Tuyên Quang'),
(61, 'Vĩnh Long'),
(62, 'Vĩnh Phúc'),
(63, 'Yên Bái');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `discount_type` enum('percent','fixed') NOT NULL DEFAULT 'percent',
  `discount_value` decimal(10,2) NOT NULL,
  `min_order_value` decimal(10,2) DEFAULT 0.00,
  `max_usage` int(11) DEFAULT 100,
  `usage_count` int(11) DEFAULT 0,
  `end_date` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `code`, `discount_type`, `discount_value`, `min_order_value`, `max_usage`, `usage_count`, `end_date`, `is_active`) VALUES
(1, 'SALE50', 'percent', 50.00, 0.00, 100, 1, NULL, 1),
(2, 'FREESHIP', 'fixed', 30000.00, 200000.00, 100, 0, NULL, 1),
(3, 'TET2026', 'percent', 20.00, 1000000.00, 10, 1, '2026-01-07 12:39:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`user_id`, `book_id`, `created_at`) VALUES
(3, 6, '2025-12-26 17:05:49'),
(3, 7, '2025-12-27 05:13:32');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) DEFAULT 0.00,
  `coupon_code` varchar(50) DEFAULT NULL,
  `status` enum('pending','confirmed','shipping','delivered','cancelled') DEFAULT 'pending',
  `shipping_address` text NOT NULL,
  `payment_method` varchar(50) DEFAULT 'COD'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `coupon_id`, `order_date`, `total_amount`, `discount_amount`, `coupon_code`, `status`, `shipping_address`, `payment_method`) VALUES
(1, 2, NULL, '2025-12-19 04:00:46', 260000.00, 0.00, NULL, 'delivered', '123 Đường Lê Lợi, TP.HCM', 'COD'),
(2, 3, NULL, '2025-12-21 16:09:45', 110000.00, 0.00, NULL, 'pending', 'Van Quang - 0374220802 - HUB Đại học ngân hàng, TP HCM', 'COD'),
(3, 3, NULL, '2025-12-21 16:17:49', 110000.00, 0.00, NULL, 'delivered', 'Van Quang - 0374220802 - ngân hàng, TP HCM', 'COD'),
(4, 4, NULL, '2025-12-21 18:46:48', 110000.00, 0.00, NULL, 'delivered', 'An Huynh - 0374220802 - hello, TP HCM', 'COD'),
(5, 4, NULL, '2025-12-25 15:22:47', 110000.00, 0.00, NULL, 'cancelled', 'An Huynh - -9 - a, a', 'COD'),
(6, 4, NULL, '2025-12-25 15:23:35', 110000.00, 0.00, NULL, 'cancelled', 'An Huynh - a - a, a', 'COD'),
(16, 3, NULL, '2025-12-26 08:38:01', 150000.00, 0.00, NULL, 'delivered', 'Van Quang - 0374220802 - Viet Nam, Bình Thuận', 'COD'),
(17, 3, NULL, '2025-12-26 08:39:00', 200000.00, 0.00, NULL, 'cancelled', 'Van Quang - 0374220802 - Viet Nam, Cao Bằng', 'COD'),
(18, 3, NULL, '2025-12-26 08:46:19', 100000.00, 0.00, NULL, 'delivered', 'Van Quang - 0374220802 - Viet Nam, Cà Mau', 'COD'),
(19, 3, NULL, '2025-12-26 09:00:51', 200000.00, 0.00, NULL, 'delivered', 'Van Quang - 0374220802 - Viet Nam, Bình Dương', 'COD'),
(20, 6, NULL, '2025-12-27 05:10:06', 1515250.00, 0.00, NULL, 'delivered', 'Ngọc Thư - 0968143960 - thon 6, Bình Phước', 'COD'),
(21, 3, NULL, '2026-01-02 01:25:13', 228650.00, 0.00, NULL, 'cancelled', 'Quang Tèo - 0968143960 - thon 6, Bình Định', 'COD'),
(22, 3, NULL, '2026-01-02 02:04:03', 361200.00, 0.00, NULL, 'cancelled', 'Quang Tèo - 0968143960 - thon 6, Bình Thuận', 'COD'),
(23, 3, NULL, '2026-01-02 09:45:09', 835800.00, 0.00, NULL, 'pending', 'Quang Tèo - 0968143960 - thon 6, Cao Bằng', 'COD'),
(26, 3, 1, '2026-01-02 11:40:43', 417900.00, 417900.00, 'SALE50', 'delivered', 'tuanpham1 - 0968143960 - 123, Châu Thành, An Giang', 'COD'),
(27, 3, NULL, '2026-01-02 11:45:03', 644000.00, 0.00, NULL, 'delivered', 'tuanpham1 - 0968143960 - 123, Châu Thành, An Giang', 'COD'),
(28, 3, NULL, '2026-01-06 05:33:39', 228650.00, 0.00, NULL, 'pending', 'tuanpham1 - 0968143960 - 123, Châu Thành, An Giang', 'COD'),
(29, 3, 3, '2026-01-06 05:40:03', 1075200.00, 268800.00, 'TET2026', 'pending', 'tuanpham1 - 0968143960 - 123, Châu Thành, An Giang', 'COD'),
(30, 3, NULL, '2026-01-10 12:10:39', 557200.00, 0.00, NULL, 'cancelled', 'tuanpham1 - 0968143960 - 123, Châu Thành, An Giang', 'COD');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `book_id`, `quantity`, `price`) VALUES
(1, 1, 1, 1, 110000.00),
(2, 1, 2, 1, 150000.00),
(3, 2, 1, 1, 110000.00),
(4, 3, 1, 1, 110000.00),
(5, 4, 1, 1, 110000.00),
(6, 5, 1, 1, 110000.00),
(7, 6, 1, 1, 110000.00),
(8, 16, 2, 1, 150000.00),
(9, 17, 3, 2, 100000.00),
(10, 18, 3, 1, 100000.00),
(11, 19, 3, 2, 100000.00),
(12, 20, 7, 6, 115000.00),
(13, 20, 10, 1, 139300.00),
(14, 20, 8, 3, 228650.00),
(15, 21, 8, 1, 228650.00),
(16, 22, 9, 4, 90300.00),
(17, 23, 10, 6, 139300.00),
(18, 26, 10, 6, 139300.00),
(19, 27, 7, 7, 92000.00),
(20, 28, 8, 1, 228650.00),
(21, 29, 11, 8, 168000.00),
(22, 30, 10, 4, 139300.00);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('vovanquang01012005@gmail.com', '372db29c88875e5a18262028c61a5137e8fc6d1bba74f07bb2a92c8db7e46937', '2025-12-27 01:31:40');

-- --------------------------------------------------------

--
-- Table structure for table `return_requests`
--

CREATE TABLE `return_requests` (
  `request_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  `image_proof` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected','refunded') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `return_requests`
--

INSERT INTO `return_requests` (`request_id`, `order_id`, `user_id`, `reason`, `image_proof`, `status`, `created_at`) VALUES
(1, 1, 2, 'Sách bị rách bìa', NULL, 'pending', '2025-12-19 04:00:46');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `rating` tinyint(4) DEFAULT 5 COMMENT '1-5 sao',
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `is_approved` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `book_id`, `rating`, `comment`, `created_at`, `is_approved`) VALUES
(1, 2, 1, 5, 'Sách rất hay, đóng gói đẹp.', '2025-12-19 04:00:46', 1),
(2, 3, 1, 4, 'Câu chuyện cảm động, văn phong nhẹ nhàng.', '2025-12-26 03:02:24', 1),
(3, 4, 1, 5, 'Rất hay, gợi nhớ nhiều kỷ niệm tuổi thơ.', '2025-12-26 03:02:24', 1),
(4, 5, 2, 5, 'Harry Potter luôn là tuổi thơ của mình.', '2025-12-26 03:02:24', 1),
(5, 2, 2, 4, 'Sách in đẹp, nội dung hấp dẫn.', '2025-12-26 03:02:24', 1),
(6, 3, 6, 5, 'hay', '2025-12-26 11:04:35', 1),
(7, 6, 8, 5, 'hay\'', '2025-12-27 03:19:31', 1),
(8, 6, 10, 5, 'hay', '2025-12-27 03:21:43', 1),
(9, 6, 10, 1, 'dở', '2025-12-27 03:21:51', 1),
(10, 6, 7, 5, 'hay', '2025-12-27 03:28:12', 1),
(11, 6, 7, 1, 'đc của ló.', '2025-12-27 04:39:21', 0),
(14, 3, 10, 5, 'hay qua', '2026-01-10 12:09:11', 0),
(15, 3, 7, 5, 'hay quá', '2026-01-11 15:00:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_addresses`
--

CREATE TABLE `shipping_addresses` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address_line` varchar(500) NOT NULL,
  `city` varchar(100) NOT NULL,
  `is_default` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping_addresses`
--

INSERT INTO `shipping_addresses` (`address_id`, `user_id`, `full_name`, `phone`, `address_line`, `city`, `is_default`, `created_at`) VALUES
(1, 3, 'tuanpham1', '0968143960', '123, Châu Thành', 'An Giang', 0, '2025-12-26 16:53:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role_id` int(11) DEFAULT 2,
  `status` tinyint(4) DEFAULT 1 COMMENT '1: Active, 0: Banned',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `gender` varchar(1) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `full_name`, `phone`, `role_id`, `status`, `created_at`, `gender`, `date_of_birth`, `avatar`) VALUES
(1, 'admin@bookstore.com', '$2y$10$hashedpasswordEXAMPLE', 'Nguyễn Quản Trị', '0901000001', 2, 1, '2025-12-19 04:00:45', NULL, NULL, NULL),
(2, 'khachhang@gmail.com', '$2y$10$hashedpasswordEXAMPLE', 'Trần Văn Mua', '0902000002', 2, 1, '2025-12-19 04:00:45', NULL, NULL, NULL),
(3, 'vovanquang01012005@gmail.com', '$2y$10$tzhNc6FfINQgK/jND4PHveCAzAmcqS08aO9yAuveXybXqw.deIawO', 'Quang Tèo', '0374220802', 1, 1, '2025-12-21 15:55:48', 'M', '2005-09-02', NULL),
(4, '030239230001@st.buh.edu.vn', '$2y$10$BC.9elRuiO1yaqpOsJAJGe/iBmczWl7kXupnR9M5BiY53q97kGISW', 'An Huynh', '0312333111', 2, 1, '2025-12-21 18:45:49', NULL, NULL, NULL),
(5, 'hoangquoc10@gmail.com', '$2y$10$tnHbpcge4iYhOkxK9quHFe740pZmoCHDh.BCtgjzWoNXAeopf3SSq', 'quocngu', '0312212221', 2, 1, '2025-12-25 15:22:18', NULL, NULL, NULL),
(6, '123@gmail.com', '$2y$10$5lXwb8RXab7PxnXXfO0o5ehqQR2CtkluOQpMUr7Sn9FZ2EGr3.TIq', 'Ngọc Thư', '0374220802', 2, 1, '2025-12-27 02:50:59', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`user_id`,`book_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `coupon_id` (`coupon_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `return_requests`
--
ALTER TABLE `return_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `return_requests`
--
ALTER TABLE `return_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk_books_authors` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_books_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_coupons` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`coupon_id`),
  ADD CONSTRAINT `fk_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_items_books` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `fk_items_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `return_requests`
--
ALTER TABLE `return_requests`
  ADD CONSTRAINT `fk_returns_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `fk_returns_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_books` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_reviews_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD CONSTRAINT `shipping_addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
