-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 21, 2026 at 03:30 PM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

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

DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `author_id` int NOT NULL AUTO_INCREMENT,
  `author_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(27, 'Eiichiro Oda', NULL),
(28, 'Philip Roth', 'Tác giả đạt giải Pulitzer người Mỹ.'),
(29, 'George R. R. Martin', 'Tác giả của bộ tiểu thuyết Trò chơi vương quyền.'),
(30, 'Trí', 'Tác giả trẻ với những dòng tản văn chữa lành.'),
(31, 'Nhiều tác giả', 'Tuyển tập các tác phẩm từ nhiều ngòi bút.'),
(32, 'Shima Mizuki', 'Tác giả tiểu thuyết chuyển thể từ anime Conan.'),
(33, 'Khotudien', 'Nhóm tác giả sáng tạo nội dung hài hước.'),
(34, 'Hae Min', 'Đại đức Hae Min - tác giả nổi tiếng Hàn Quốc.'),
(35, 'Lưu Hiểu Huy', 'Bác sĩ pháp y với những ghi chép thực tế.'),
(36, 'Hạ Mer', 'Tác giả trẻ chuyên viết về chủ đề gia đình và mẹ.'),
(37, 'Thảo Thảo', 'Tác giả tản văn truyền cảm hứng cho người trẻ.'),
(38, 'Alexandra Ripley', 'Nhà văn Mỹ nổi tiếng với hậu truyện của Cuốn Theo Chiều Gió.'),
(39, 'Uketsu', 'Tác giả trinh thám, kinh dị nổi tiếng từ Nhật Bản.'),
(40, 'Nguyễn Văn Khỏa', 'Nhà nghiên cứu văn hóa, dịch giả Thần thoại Hy Lạp.'),
(41, 'Kito Aya', 'Tác giả cuốn nhật ký đầy nghị lực Một Lít Nước Mắt.'),
(42, 'Khaled Hosseini', 'Văn hào người Mỹ gốc Afghanistan (Người Đua Diều).'),
(43, 'Di Li', 'Nữ nhà văn nổi tiếng với dòng truyện trinh thám và du ký.'),
(44, 'Jane Austen', 'Nữ văn hào kinh điển của văn học Anh quốc.'),
(45, 'Edmondo De Amicis', 'Nhà văn, nhà báo người Ý (Những Tấm Lòng Cao Cả).'),
(46, 'Hae Min', 'Đại đức Hae Min - tác giả Bước Chậm Lại Giữa Thế Gian Vội Vã.');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `book_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `publisher` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nhà cung cấp',
  `cover_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Hình thức bìa: Bìa mềm/Bìa cứng',
  `publication_year` int DEFAULT NULL,
  `isbn` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `stock` int NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint DEFAULT '1' COMMENT 'Soft Delete',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `language` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'Tiếng Việt' COMMENT 'Ngôn ngữ',
  `weight` int DEFAULT NULL COMMENT 'Trọng lượng (gram)',
  `size` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Kích thước (cm)',
  `page_count` int DEFAULT NULL COMMENT 'Số trang',
  `discount` int DEFAULT '0',
  PRIMARY KEY (`book_id`),
  KEY `author_id` (`author_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author_id`, `category_id`, `publisher`, `supplier`, `cover_type`, `publication_year`, `isbn`, `price`, `stock`, `description`, `image`, `is_active`, `created_at`, `language`, `weight`, `size`, `page_count`, `discount`) VALUES
(1, 'Mắt Biếc', 1, NULL, 'NXB Trẻ', NULL, NULL, NULL, '978-604-1-12345-6', 110000.00, 47, 'Tiểu thuyết tuổi học trò tại làng Đo Đo.', 'mat_biec.jpg', 1, '2025-12-19 04:00:46', 'Tiếng Việt', NULL, NULL, NULL, 20),
(2, 'Harry Potter 1', 2, 1, 'NXB Trẻ', 'Skybooks', 'Bìa mềm', 2004, '978-0-7475-3274-3', 150000.00, 97, 'Tập đầu series phù thủy nổi tiếng.', '1766813229_hary.jpg', 1, '2025-12-19 04:00:46', 'Tiếng Việt', 0, '20.5 x 13.5 x 1.2 cm', 220, 15),
(3, 'The God Father', 2, NULL, 'Kim Đồng', NULL, NULL, 2025, '123', 100000.00, 7, 'Tiểu thuyết hình sự kinh điển (demo).', 'thegodfather.jpg', 1, '2025-12-21 16:50:56', 'Tiếng Việt', NULL, NULL, NULL, 20),
(4, 'The God Father (bản 2)', 2, NULL, 'Kim Đồng', NULL, NULL, 2025, '123', 100000.00, 10, 'Bản khác dùng ảnh upload.', 'thegodfather_2.jpg', 0, '2025-12-21 16:51:06', 'Tiếng Việt', NULL, NULL, NULL, 15),
(5, 'Hello (demo)', 1, 1, '', '', '', 0, NULL, 100000.00, 0, 'Sách test dữ liệu.', 'default_book.jpg', 1, '2025-12-25 16:23:21', 'Tiếng Việt', 0, '', 0, 20),
(6, 'Bạn là cậu nhỏ của tớ', 3, NULL, 'Phụ nữ việt nam', 'Skybooks', 'Bìa mềm', 2023, NULL, 84000.00, 50, 'Vì Cậu Là Bạn Nhỏ Của Tớ\r\n\r\nVì cậu là bạn nhỏ của tớ” là cuốn sách đầu tay đánh dấu chặng hành trình phát triển, nỗ lực không ngừng nghỉ của Tác giả, MC, Content Creator Tun Phạm.\r\n\r\nNhờ vào góc nhìn và tâm tư sâu sắc, quyển sách như cẩm nang đồng hành cùng thế hệ trẻ vượt qua cơn bão “overthinking” với những cảm xúc, suy nghĩ tiêu cực trong các vấn đề khó khăn thường gặp.\r\n\r\nGenZ có lẽ là một thế hệ luôn loay hoay, bối rối với câu hỏi: “Liệu mình là ai và mình cần làm gì khi đến với thế giới này?”. Tác giả sẽ cùng bạn bước thật vững trong chặng đường thấu hiểu thế giới nội tâm, đưa ra các giải pháp cho các vấn đề thường nhật như: \r\n\r\n - Làm thế nào để người hướng nội có thể giao tiếp, ứng xử tốt hơn.\r\n\r\n- Thực hành tư duy biết ơn để trân trọng thực tại và khởi đầu niềm hạnh phúc tự thân.\r\n\r\n- Kiểm soát cơn lốc “overthinking” khiến người trẻ tổn hao tâm lực.\r\n\r\n- Khám phá giá trị nội tại và bí kíp tự tạo cơ hội giúp bản thân “rực sáng”.\r\n\r\n- Và nhiều vấn đề phổ biến mà người trẻ đang bận tâm tìm lời giải.\r\n\r\nBạn sẽ không còn cô độc, vì đã có tác giả dìu dắt bạn vượt qua những khoảng tối của hành trình trưởng thành, giúp bạn không còn lạc lối và dần tìm thấy hướng đi mà bạn vốn có.\r\n\r\nMong bạn luôn nhớ rằng: “Thật may mắn khi chúng ta gặp được nhau ở kiếp này. Vậy nên đừng vì những chuyện nhỏ nhặt mà rời đi nhé.”\r\n\r\nSau tất cả bạn luôn xứng đáng được trân trọng, thấu hiểu, Tun luôn bên bạn!', '1766745224_ban_nho.jpg', 1, '2025-12-26 10:33:44', 'Tiếng Việt', 260, '20.5 x 13.5 x 1.2 cm', 240, 15),
(7, 'Lược Sử Thời Gian', 1, 1, 'NXB Trẻ', 'Nhã Nam', 'Bìa mềm', 2023, NULL, 115000.00, 37, 'Cuốn sách khám phá những bí ẩn lớn nhất của vũ trụ, từ Big Bang đến lỗ đen, được viết bởi nhà vật lý thiên tài Stephen Hawking.', 'b1.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 300, '14 x 20.5 cm', 280, 20),
(8, 'Vũ Trụ (Cosmos)', 2, 1, 'NXB Thế Giới', 'Nhã Nam', 'Bìa cứng', 2022, NULL, 269000.00, 27, 'Hành trình khám phá vũ trụ vĩ đại, sự sống và nền văn minh nhân loại qua lăng kính khoa học đầy chất thơ.', 'b2.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 800, '16 x 24 cm', 500, 15),
(9, 'Code Dạo Ký Sự', 3, 1, 'NXB Dân Trí', 'Fahasa', 'Bìa mềm', 2021, NULL, 129000.00, 100, 'Những câu chuyện đời thường, hài hước nhưng thấm đẫm kinh nghiệm xương máu của một lập trình viên Full-stack.', 'b3.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 350, '14.5 x 20.5 cm', 320, 30),
(10, 'Nhà Đầu Tư Thông Minh', 4, 2, 'NXB Lao Động', 'Alpha Books', 'Bìa mềm', 2023, NULL, 199000.00, 25, 'Cuốn sách gối đầu giường cho mọi nhà đầu tư chứng khoán, dạy bạn cách đầu tư giá trị và kiểm soát cảm xúc.', 'b4.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 600, '16 x 24 cm', 600, 30),
(11, 'Chiến Tranh Tiền Tệ', 5, 2, 'NXB Lao Động', 'Alpha Books', 'Bìa mềm', 2020, NULL, 168000.00, 42, 'Bức màn bí mật về lịch sử tiền tệ thế giới và những âm mưu tài chính đứng sau các sự kiện lịch sử lớn.', 'b5.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 500, '15 x 23 cm', 450, 0),
(12, 'Marketing Giỏi Phải Kiếm Được Tiền', 6, 2, 'NXB Kinh Tế', 'Alpha Books', 'Bìa mềm', 2022, NULL, 145000.00, 60, 'Marketing không chỉ là sáng tạo, mục đích cuối cùng phải là bán được hàng. Cuốn sách thực chiến cho dân Marketer.', 'b6.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 400, '14 x 20.5 cm', 380, 0),
(13, 'Đắc Nhân Tâm (Khổ Lớn)', 7, 3, 'NXB Tổng Hợp TPHCM', 'First News', 'Bìa mềm', 2024, NULL, 86000.00, 200, 'Nghệ thuật thu phục lòng người. Cuốn sách self-help bán chạy nhất mọi thời đại.', 'b7.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 350, '14.5 x 20.5 cm', 320, 0),
(14, 'Tuổi Trẻ Đáng Giá Bao Nhiêu', 8, 3, 'NXB Hội Nhà Văn', 'Nhã Nam', 'Bìa mềm', 2021, NULL, 90000.00, 150, 'Kim chỉ nam cho người trẻ đang lạc lối, khơi dậy đam mê đọc sách và tự học.', 'b8.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 280, '13 x 20.5 cm', 290, 0),
(15, 'Đời Thay Đổi Khi Chúng Ta Thay Đổi', 9, 3, 'NXB Trẻ', 'NXB Trẻ', 'Bìa mềm', 2023, NULL, 78000.00, 78, 'Tập sách tranh hài hước giúp bạn nhìn nhận cuộc sống lạc quan và tích cực hơn.', 'b9.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 200, '14 x 20 cm', 250, 0),
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
(30, 'One Piece - Tập 100', 24, 8, 'NXB Kim Đồng', 'Kim Đồng', 'Bìa mềm', 2023, NULL, 25000.00, 450, 'Hành trình chinh phục kho báu One Piece của Luffy Mũ Rơm.', 'b24.jpg', 1, '2025-12-27 01:38:24', 'Tiếng Việt', 150, '11.3 x 17.6 cm', 200, 0),
(31, 'Mẹ Làm Gì Có Ước Mơ', 3, 2, 'NXB Văn Học', 'Người Trẻ Việt', 'Bìa mềm', 2023, '978-604-9-12301-1', 89000.00, 50, 'Tản văn về tình cảm gia đình cảm động.', '98bde27a91ea4bb412fb.jpg', 0, '2026-04-20 07:49:48', 'Tiếng Việt', 250, '13x20.5 cm', 200, 10),
(32, 'Cuối Con Đường Sẽ Gặp Một Người Thương', 4, 2, 'NXB Văn Học', 'Người Trẻ Việt', 'Bìa cứng', 2023, '978-604-9-12302-8', 125000.00, 30, 'Hành trình đi tìm hạnh phúc và tình yêu chân thành.', '021123-8.jpg', 1, '2026-04-20 07:49:48', 'Tiếng Việt', 300, '14.5x20.5 cm', 250, 15),
(33, 'Chanh Mật Ong - Trà Hoa Đậu Biếc', 5, 3, 'NXB Văn Học', 'Skybooks', 'Bìa mềm', 2023, '978-604-9-12303-5', 95000.00, 100, 'Câu chuyện thanh xuân ngọt ngào như vị trà.', '210723-8.jpg', 0, '2026-04-20 07:49:48', 'Tiếng Việt', 280, '13x19 cm', 220, 20),
(34, 'Không Gia Đình', 6, 1, 'NXB Văn Học', 'Đông A', 'Bìa mềm', 2022, '978-604-9-12304-2', 150000.00, 40, 'Kiệt tác văn học kinh điển về nghị lực sống.', '865131eccf7d5aaea74094b221caf805.jpg', 1, '2026-04-20 07:49:48', 'Tiếng Việt', 450, '16x24 cm', 500, 10),
(35, 'Chúng Ta Rồi Sẽ Hạnh Phúc Theo Những Cách Khác Nhau', 7, 2, 'NXB Văn Học', 'Người Trẻ Việt', 'Bìa mềm', 2021, '978-604-9-12305-9', 110000.00, 65, 'Lời nhắn nhủ dịu dàng cho những tâm hồn đang tổn thương.', '139990755_1302883240068333_3844579474690419303_n.jpg', 1, '2026-04-20 07:49:48', 'Tiếng Việt', 320, '14x20 cm', 280, 5),
(36, 'Nếu Biết Trăm Năm Là Hữu Hạn', 8, 2, 'NXB Thế Giới', 'Phương Nam Book', 'Bìa mềm', 2022, '978-604-7-12306-6', 99000.00, 80, 'Những suy ngẫm sâu sắc về cuộc đời và nhân sinh.', '8932000134008.jpg', 1, '2026-04-20 07:49:48', 'Tiếng Việt', 350, '14x20.5 cm', 300, 10),
(37, 'Trôi', 9, 1, 'NXB Trẻ', 'NXB Trẻ', 'Bìa mềm', 2023, '978-604-1-12307-3', 85000.00, 55, 'Tập truyện ngắn mới nhất của nhà văn Nguyễn Ngọc Tư.', '8934974190554.jpg', 1, '2026-04-20 07:49:48', 'Tiếng Việt', 200, '13x20 cm', 180, 15),
(38, 'Scarlett - Hậu Cuốn Theo Chiều Gió', 10, 1, 'NXB Văn Học', 'Huy Hoàng Book', 'Bìa cứng', 2020, '978-604-9-12308-0', 250000.00, 20, 'Phần tiếp theo đầy kịch tính của tác phẩm kinh điển.', '8935095623082.jpg', 1, '2026-04-20 07:49:48', 'Tiếng Việt', 600, '16x24 cm', 800, 25),
(39, 'Ngôi Nhà Kỳ Quái', 11, 4, 'NXB Phụ Nữ Việt Nam', 'Phúc Minh', 'Bìa mềm', 2023, '978-604-3-12309-7', 135000.00, 45, 'Tiểu thuyết trinh thám kinh dị gây sốt từ Nhật Bản.', '8935095632763.jpg', 1, '2026-04-20 07:49:48', 'Tiếng Việt', 380, '14.5x20.5 cm', 350, 12),
(40, 'Thần Thoại Hy Lạp', 12, 10, 'NXB Văn Học', 'Huy Hoàng Book', 'Bìa cứng', 2021, '978-604-9-12310-3', 195000.00, 35, 'Tuyển tập những câu chuyện thần thoại vĩ đại nhất.', '8935095633272.jpg', 1, '2026-04-20 07:49:48', 'Tiếng Việt', 500, '16x24 cm', 450, 10),
(41, 'Sơn Trà Nở Muộn', 13, 2, 'NXB Thanh Niên', 'Amun', 'Bìa mềm', 2024, '978-604-3-12311-0', 115000.00, 55, 'Tiểu thuyết ngôn tình hiện đại đầy chất thơ.', '8935212360913.jpg', 1, '2026-04-20 07:53:11', 'Tiếng Việt', 320, '14.5x20.5 cm', 380, 15),
(42, 'Chuyến Du Hành Vào Lòng Đất', 14, 1, 'NXB Thanh Niên', 'Đinh Tị Books', 'Bìa mềm', 2023, '978-604-3-12312-7', 98000.00, 42, 'Cuộc phiêu lưu kỳ thú của Jules Verne.', '8935212364683.jpg', 1, '2026-04-20 07:53:11', 'Tiếng Việt', 280, '13x20.5 cm', 320, 10),
(43, 'Không Gia Đình (Bìa Trắng)', 6, 1, 'NXB Văn Học', 'Người Trẻ Việt', 'Bìa mềm', 2022, '978-604-9-12313-4', 145000.00, 38, 'Tác phẩm giáo dục kinh điển về nghị lực của cậu bé Rémi.', '8935230009887.jpg', 1, '2026-04-20 07:53:11', 'Tiếng Việt', 400, '14x20 cm', 560, 20),
(44, 'Một Lít Nước Mắt', 15, 2, 'NXB Hội Nhà Văn', 'Nhã Nam', 'Bìa mềm', 2021, '978-604-9-12314-1', 85000.00, 90, 'Cuốn nhật ký đẫm nước mắt về nghị lực sống phi thường.', '8935235222076.jpg', 1, '2026-04-20 07:53:11', 'Tiếng Việt', 250, '13x20.5 cm', 260, 10),
(45, 'Người Đua Diều', 16, 1, 'NXB Hội Nhà Văn', 'Nhã Nam', 'Bìa mềm', 2023, '978-604-9-12315-8', 165000.00, 25, 'Câu chuyện về tình bạn, sự phản bội và chuộc lỗi tại Afghanistan.', '8935235237773.jpg', 1, '2026-04-20 07:53:11', 'Tiếng Việt', 450, '14x20.5 cm', 480, 15),
(46, 'Tật Xấu Người Việt', 17, 5, 'NXB Hội Nhà Văn', 'Nhã Nam', 'Bìa mềm', 2024, '978-604-9-12316-5', 120000.00, 70, 'Cái nhìn trực diện và hóm hỉnh về tính cách người Việt.', '8935235239500.jpg', 1, '2026-04-20 07:53:11', 'Tiếng Việt', 300, '14x20.5 cm', 310, 5),
(47, 'Những Chuyện Lạ Ở Tokyo', 18, 1, 'NXB Hội Nhà Văn', 'Nhã Nam', 'Bìa mềm', 2023, '978-604-9-12317-2', 110000.00, 48, 'Tập truyện ngắn mang phong cách huyền ảo của Haruki Murakami.', '8935235240308.jpg', 1, '2026-04-20 07:53:11', 'Tiếng Việt', 280, '14x20.5 cm', 290, 10),
(48, 'Kiêu Hãnh Và Định Kiến', 19, 1, 'NXB Văn Học', 'Minh Thắng Books', 'Bìa cứng', 2022, '978-604-9-12318-9', 210000.00, 20, 'Tác phẩm kinh điển về tình yêu và tầng lớp xã hội Anh quốc.', '8935236429955.jpg', 1, '2026-04-20 07:53:11', 'Tiếng Việt', 550, '16x24 cm', 520, 25),
(49, 'Không Gia Đình (Ấn Bản Kim Đồng)', 6, 1, 'NXB Kim Đồng', 'Kim Đồng', 'Bìa mềm', 2024, '978-604-2-12319-6', 130000.00, 60, 'Ấn bản dành cho thiếu nhi với minh họa tuyệt đẹp.', '8935244874372.jpg', 1, '2026-04-20 07:53:11', 'Tiếng Việt', 380, '14.5x20.5 cm', 450, 12),
(50, 'Hai Vạn Dặm Dưới Biển', 14, 1, 'NXB Kim Đồng', 'Kim Đồng', 'Bìa mềm', 2024, '978-604-2-12320-2', 105000.00, 35, 'Cuộc thám hiểm đại dương kỳ ảo trên con tàu Nautilus.', '8935244877489.jpg', 1, '2026-04-20 07:53:11', 'Tiếng Việt', 350, '14.5x20.5 cm', 400, 15),
(51, 'Không Gia Đình (Bìa Xanh Thẫm)', 6, 1, 'NXB Văn Học', 'Hải Đăng', 'Bìa cứng', 2023, '978-604-9-12321-9', 155000.00, 30, 'Ấn bản đặc biệt với minh họa màu kịch tính về hành trình của Rémi.', '8935275100556.jpg', 1, '2026-04-20 07:58:24', 'Tiếng Việt', 450, '16x24 cm', 520, 10),
(52, 'Một Cuốn Sách Buồn... Cười', 20, 3, 'NXB Phụ Nữ Việt Nam', 'Skybooks', 'Bìa mềm', 2024, '978-604-3-12322-6', 88000.00, 120, 'Tuyển tập những câu chuyện hài hước, giải trí cực mạnh.', '8935325000157.jpg', 1, '2026-04-20 07:58:24', 'Tiếng Việt', 200, '13x18 cm', 180, 20),
(53, '999 Lá Thư Gửi Cho Chính Mình', 21, 2, 'NXB Thanh Niên', 'Vạn Việt Books', 'Bìa mềm', 2022, '978-604-3-12323-3', 129000.00, 85, 'Phiên bản song ngữ Trung - Việt giúp bạn tìm lại bản thân.', '8935325010736.jpg', 1, '2026-04-20 07:58:24', 'Song ngữ', 350, '14.5x20.5 cm', 420, 15),
(54, 'Đám Trẻ Ở Đại Dương Đen', 22, 2, 'NXB Thế Giới', 'Wave Books', 'Bìa mềm', 2023, '978-604-7-12324-0', 95000.00, 65, 'Châu sa đáy mắt - Những tâm sự dành cho người trẻ cô đơn.', '8935325011559.jpg', 1, '2026-04-20 07:58:24', 'Tiếng Việt', 280, '13x19 cm', 240, 10),
(55, 'Đảo Giấu Vàng', 23, 1, 'NXB Văn Học', 'Đông A', 'Bìa mềm', 2024, '978-604-9-12325-7', 105000.00, 45, 'Cuộc truy tìm kho báu huyền thoại của thuyền trưởng Flint.', '8936067595512_1.jpg', 1, '2026-04-20 07:58:24', 'Tiếng Việt', 320, '13.5x20.5 cm', 300, 12),
(56, 'Ông Già Và Biển Cả (Bìa Trắng)', 24, 1, 'NXB Văn Học', 'Đông A', 'Bìa mềm', 2021, '978-604-9-12326-4', 75000.00, 55, 'Bản dịch Lê Huy Bắc về cuộc chiến không cân sức với đại dương.', '8936067604603.jpg', 1, '2026-04-20 07:58:24', 'Tiếng Việt', 220, '13x20.5 cm', 150, 5),
(57, 'Tam Quốc Diễn Nghĩa (Trọn Bộ 3 Tập)', 25, 4, 'NXB Văn Học', 'Đông A', 'Bìa cứng', 2022, '978-604-9-12327-1', 450000.00, 15, 'Bộ tiểu thuyết lịch sử kinh điển của La Quán Trung.', '8936067607024.jpg', 1, '2026-04-20 07:58:24', 'Tiếng Việt', 1800, '16x24 cm', 1200, 15),
(58, 'Thần Thoại Bắc Âu', 26, 10, 'NXB Thanh Niên', 'Minh Thắng Books', 'Bìa cứng', 2023, '978-604-3-12328-8', 185000.00, 40, 'Văn xuôi và thơ Edda - Những sử thi vĩ đại của vùng Bắc Âu.', '8936107813682.jpg', 1, '2026-04-20 07:58:24', 'Tiếng Việt', 500, '16x24 cm', 480, 10),
(59, 'Ông Già Và Biển Cả (Ấn Bản Minh Họa)', 24, 1, 'NXB Văn Học', 'Đông A', 'Bìa mềm', 2024, '978-604-9-12329-5', 99000.00, 35, 'Phiên bản minh họa đặc biệt mang đậm chất nghệ thuật.', '8936203361674.jpg', 1, '2026-04-20 07:58:24', 'Tiếng Việt', 300, '14.5x20.5 cm', 180, 15),
(60, 'Những Tấm Lòng Cao Cả', 27, 1, 'NXB Văn Học', 'Hải Đăng', 'Bìa mềm', 2023, '978-604-9-12330-1', 92000.00, 75, 'Cuốn nhật ký giáo dục đầy tính nhân văn của cậu bé En-ri-cô.', 'b_a-ntlcc.jpg', 1, '2026-04-20 07:58:24', 'Tiếng Việt', 310, '13x20.5 cm', 350, 10),
(61, 'Bình Yên Nước Mỹ', 28, 1, 'NXB Lao Động', 'Bách Việt', 'Bìa mềm', 2022, '978-604-3-12331-8', 185000.00, 25, 'Tác phẩm đạt giải Pulitzer 1998 của Philip Roth về xã hội Mỹ.', 'b_a-tr_c-b_nh-y_n-n_c-m_.jpg', 1, '2026-04-20 08:16:01', 'Tiếng Việt', 400, '14.5x20.5 cm', 530, 10),
(62, 'Lửa & Máu (Trọn bộ 2 quyển)', 29, 1, 'NXB Thanh Niên', 'Thanh Niên', 'Bìa mềm', 2023, '978-604-3-12332-5', 350000.00, 15, 'Tiền truyện của Game of Thrones về gia tộc Targaryen.', 'b_a-tr_c-l_a-v_-m_u-t_p-12.jpg', 1, '2026-04-20 08:16:01', 'Tiếng Việt', 850, '16x24 cm', 900, 15),
(63, '999 Lá Thư Gửi Cho Chính Mình (Bìa Đỏ)', 21, 2, 'NXB Thanh Niên', 'Vạn Việt Books', 'Bìa mềm', 2024, '978-604-3-12333-2', 135000.00, 60, 'Những lá thư ấn tượng nhất - Phiên bản song ngữ Trung Việt.', 'b1_2_10.jpg', 1, '2026-04-20 08:16:01', 'Song ngữ', 320, '14.5x20.5 cm', 390, 10),
(64, 'Cảm Ơn Anh Đã Đánh Mất Em', 30, 2, 'NXB Văn Học', 'Người Trẻ Việt', 'Bìa mềm', 2023, '978-604-9-12334-9', 92000.00, 110, 'Tản văn về sự trưởng thành sau những đổ vỡ tình cảm.', 'bbbcam-on-anh-da-danh-mat-em.jpg', 1, '2026-04-20 08:16:01', 'Tiếng Việt', 240, '13x20 cm', 210, 20),
(65, 'Chuyện Kể Rằng Có Nàng Và Tôi', 31, 2, 'NXB Phụ Nữ Việt Nam', 'Deep Books', 'Bìa mềm', 2024, '978-604-3-12335-6', 110000.00, 45, 'Tuyển tập truyện ngắn nhẹ nhàng về tình yêu và phái đẹp.', 'bia_chuyen-ke-rang-co-nang-va-toi_final.jpg', 1, '2026-04-20 08:16:01', 'Tiếng Việt', 270, '14x20.5 cm', 280, 5),
(66, 'Thám Tử Lừng Danh Conan: Tàu Ngầm Sắt Đen', 32, 1, 'NXB Kim Đồng', 'Kim Đồng', 'Bìa mềm', 2024, '978-604-2-12336-3', 65000.00, 200, 'Tiểu thuyết chuyển thể từ movie Conan thứ 26 cực kỳ hấp dẫn.', 'bia_conan_tau-ngam-sat-den.jpg', 1, '2026-04-20 08:16:01', 'Tiếng Việt', 180, '13x19 cm', 250, 10),
(67, 'Từ Điển Tiếng \"Em\"', 33, 3, 'NXB Phụ Nữ Việt Nam', 'Skybooks', 'Bìa mềm', 2023, '978-604-3-12337-0', 89000.00, 150, 'Giải mã những ngôn ngữ ẩn ý của phái đẹp một cách hài hước.', 'bia_tudientiengem-_1_.jpg', 1, '2026-04-20 08:16:01', 'Tiếng Việt', 200, '13x18 cm', 190, 15),
(68, 'Con Chim Xanh Biếc Bay Về', 1, 1, 'NXB Trẻ', 'NXB Trẻ', 'Bìa mềm', 2020, '978-604-1-12338-7', 150000.00, 80, 'Truyện dài của Nguyễn Nhật Ánh lấy bối cảnh tại Sài Gòn.', 'biamem.jpg', 1, '2026-04-20 08:16:01', 'Tiếng Việt', 350, '13x20 cm', 340, 12),
(69, 'Bước Chậm Lại Giữa Thế Gian Vội Vã', 34, 2, 'NXB Thế Giới', 'Nhã Nam', 'Bìa mềm', 2022, '978-604-7-12339-4', 95000.00, 95, 'Những chia sẻ về cách tìm lại sự tĩnh tại của đại đức Hae Min.', 'buoc_cham_lai_giua_the_gian_voi_va.u335.d20160817.t102115.612356.jpg', 1, '2026-04-20 08:16:01', 'Tiếng Việt', 310, '14x20.5 cm', 300, 10),
(70, 'Ghi Chép Pháp Y (Combo 2 tập)', 35, 9, 'NXB Thanh Niên', 'Bách Việt', 'Bìa mềm', 2024, '978-604-3-12340-0', 215000.00, 40, 'Những vụ án có thật qua lời kể của bác sĩ pháp y.', 'combo-8935325009433-8935325015106.png', 1, '2026-04-20 08:16:01', 'Tiếng Việt', 600, '14.5x20.5 cm', 720, 18);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(8, 'Truyện tranh', NULL),
(9, 'Trinh thám - Kinh dị', 'Sách về các vụ án, pháp y và bí ẩn kịch tính.'),
(10, 'Thần thoại - Sử thi', 'Các câu chuyện về thần linh và sử thi các nền văn minh.');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `city_id` int NOT NULL AUTO_INCREMENT,
  `city_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `coupon_id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_type` enum('percent','fixed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'percent',
  `discount_value` decimal(10,2) NOT NULL,
  `min_order_value` decimal(10,2) DEFAULT '0.00',
  `max_usage` int DEFAULT '100',
  `usage_count` int DEFAULT '0',
  `end_date` datetime DEFAULT NULL,
  `is_active` tinyint DEFAULT '1',
  PRIMARY KEY (`coupon_id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `code`, `discount_type`, `discount_value`, `min_order_value`, `max_usage`, `usage_count`, `end_date`, `is_active`) VALUES
(1, 'SALE50', 'percent', 50.00, 0.00, 100, 2, NULL, 1),
(2, 'FREESHIP', 'fixed', 30000.00, 200000.00, 100, 0, NULL, 1),
(3, 'TET2026', 'percent', 20.00, 1000000.00, 10, 1, '2026-01-07 12:39:00', 1),
(4, 'CATHANG4', 'fixed', 44000.00, 200000.00, 100, 0, '2027-04-02 23:59:59', 1),
(5, 'CHAO304', 'percent', 15.00, 300000.00, 500, 0, '2026-05-02 23:59:59', 1),
(6, 'THIEUNHI', 'fixed', 30000.00, 150000.00, 200, 0, '2026-06-02 23:59:59', 1),
(7, 'HELLOHE', 'percent', 10.00, 0.00, 1000, 0, '2026-08-31 23:59:59', 1),
(8, 'WELCOME', 'percent', 10.00, 0.00, 2000, 0, '2027-12-31 23:59:59', 1),
(9, 'NEWBIE50K', 'fixed', 50000.00, 200000.00, 1000, 0, '2027-12-31 23:59:59', 1),
(10, 'FREESHIP20K', 'fixed', 20000.00, 150000.00, 5000, 0, '2026-12-31 23:59:59', 1),
(11, 'FREESHIP50K', 'fixed', 50000.00, 350000.00, 2000, 0, '2026-12-31 23:59:59', 1),
(12, 'FLASH50', 'percent', 50.00, 400000.00, 50, 0, '2026-12-31 23:59:59', 1),
(13, 'NIGHTOWL', 'percent', 15.00, 150000.00, 300, 0, '2026-12-31 23:59:59', 1),
(14, 'MIDNIGHT', 'fixed', 30000.00, 200000.00, 200, 0, '2026-12-31 23:59:59', 1),
(15, 'MANGA10', 'percent', 10.00, 100000.00, 1000, 0, '2026-12-31 23:59:59', 1),
(16, 'IELTS100K', 'fixed', 100000.00, 600000.00, 500, 0, '2026-12-31 23:59:59', 1),
(17, 'VANHOC15', 'percent', 15.00, 250000.00, 800, 0, '2026-12-31 23:59:59', 1),
(18, 'BACK2SCHOOL', 'percent', 20.00, 300000.00, 1500, 0, '2026-09-30 23:59:59', 1),
(19, 'HALLOWEEN', 'fixed', 31000.00, 150000.00, 500, 0, '2026-10-31 23:59:59', 1),
(20, 'BLACKFRIDAY', 'percent', 40.00, 500000.00, 200, 0, '2026-11-30 23:59:59', 1),
(21, 'NOEL2026', 'fixed', 50000.00, 300000.00, 1000, 0, '2026-12-25 23:59:59', 1),
(22, 'YEAREND', 'percent', 25.00, 450000.00, 1000, 0, '2026-12-31 23:59:59', 1),
(23, 'PAYDAY', 'fixed', 40000.00, 250000.00, 800, 0, '2026-12-31 23:59:59', 1),
(24, 'DOUBLE10', 'percent', 10.00, 100000.00, 1010, 0, '2026-10-10 23:59:59', 1),
(25, 'DOUBLE11', 'percent', 11.00, 110000.00, 1111, 0, '2026-11-11 23:59:59', 1),
(26, 'VIPONLY', 'percent', 30.00, 1000000.00, 100, 0, '2027-12-31 23:59:59', 1),
(27, 'BUYMORE', 'fixed', 150000.00, 800000.00, 300, 0, '2027-12-31 23:59:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE IF NOT EXISTS `favorites` (
  `user_id` int NOT NULL,
  `book_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`,`book_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`user_id`, `book_id`, `created_at`) VALUES
(3, 6, '2025-12-26 17:05:49'),
(3, 7, '2025-12-27 05:13:32');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `coupon_id` int DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `total_amount` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) DEFAULT '0.00',
  `coupon_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','confirmed','shipping','delivered','cancelled') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `shipping_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'COD',
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`),
  KEY `coupon_id` (`coupon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `coupon_id`, `order_date`, `total_amount`, `discount_amount`, `coupon_code`, `status`, `shipping_address`, `payment_method`) VALUES
(1, 2, NULL, '2025-12-19 04:00:46', 260000.00, 0.00, NULL, 'delivered', '123 Đường Lê Lợi, TP.HCM', 'COD'),
(2, 13, NULL, '2025-12-21 16:09:45', 110000.00, 0.00, NULL, 'pending', 'Van Quang - 0374220802 - HUB Đại học ngân hàng, TP HCM', 'COD'),
(3, 10, NULL, '2025-12-21 16:17:49', 110000.00, 0.00, NULL, 'delivered', 'Van Quang - 0374220802 - ngân hàng, TP HCM', 'COD'),
(4, 11, NULL, '2025-12-21 18:46:48', 110000.00, 0.00, NULL, 'delivered', 'An Huynh - 0374220802 - hello, TP HCM', 'COD'),
(5, 22, NULL, '2025-12-25 15:22:47', 110000.00, 0.00, NULL, 'cancelled', 'An Huynh - -9 - a, a', 'COD'),
(6, 26, NULL, '2025-12-25 15:23:35', 110000.00, 0.00, NULL, 'cancelled', 'An Huynh - a - a, a', 'COD'),
(16, 15, NULL, '2025-12-26 08:38:01', 150000.00, 0.00, NULL, 'delivered', 'Van Quang - 0374220802 - Viet Nam, Bình Thuận', 'COD'),
(17, 44, NULL, '2025-12-26 08:39:00', 200000.00, 0.00, NULL, 'cancelled', 'Van Quang - 0374220802 - Viet Nam, Cao Bằng', 'COD'),
(18, 26, NULL, '2025-12-26 08:46:19', 100000.00, 0.00, NULL, 'delivered', 'Van Quang - 0374220802 - Viet Nam, Cà Mau', 'COD'),
(19, 44, NULL, '2025-12-26 09:00:51', 200000.00, 0.00, NULL, 'delivered', 'Van Quang - 0374220802 - Viet Nam, Bình Dương', 'COD'),
(20, 46, NULL, '2025-12-27 05:10:06', 1515250.00, 0.00, NULL, 'delivered', 'Ngọc Thư - 0968143960 - thon 6, Bình Phước', 'COD'),
(21, 45, NULL, '2026-01-02 01:25:13', 228650.00, 0.00, NULL, 'cancelled', 'Quang Tèo - 0968143960 - thon 6, Bình Định', 'COD'),
(22, 37, NULL, '2026-01-02 02:04:03', 361200.00, 0.00, NULL, 'cancelled', 'Quang Tèo - 0968143960 - thon 6, Bình Thuận', 'COD'),
(23, 48, NULL, '2026-01-02 09:45:09', 835800.00, 0.00, NULL, 'pending', 'Quang Tèo - 0968143960 - thon 6, Cao Bằng', 'COD'),
(26, 30, 1, '2026-01-02 11:40:43', 417900.00, 417900.00, 'SALE50', 'delivered', 'tuanpham1 - 0968143960 - 123, Châu Thành, An Giang', 'COD'),
(27, 3, NULL, '2026-01-02 11:45:03', 644000.00, 0.00, NULL, 'delivered', 'tuanpham1 - 0968143960 - 123, Châu Thành, An Giang', 'COD'),
(28, 24, NULL, '2026-01-06 05:33:39', 228650.00, 0.00, NULL, 'pending', 'tuanpham1 - 0968143960 - 123, Châu Thành, An Giang', 'COD'),
(29, 10, 3, '2026-01-06 05:40:03', 1075200.00, 268800.00, 'TET2026', 'pending', 'tuanpham1 - 0968143960 - 123, Châu Thành, An Giang', 'COD'),
(30, 25, NULL, '2026-01-10 12:10:39', 557200.00, 0.00, NULL, 'cancelled', 'tuanpham1 - 0968143960 - 123, Châu Thành, An Giang', 'COD'),
(31, 46, 1, '2026-04-19 23:37:59', 150000.00, 150000.00, 'SALE50', 'pending', 'Trần Quản Trị - 0123456789 - Số nhà 10A, Khu phố A, Đường B, Khu phố C, phường D, Đồng Nai', 'BANK_TRANSFER'),
(32, 8, NULL, '2026-04-11 07:20:00', 330000.00, 0.00, NULL, 'delivered', 'Ký túc xá BUH, Thủ Đức, TP.HCM', 'Banking'),
(33, 45, NULL, '2026-04-12 03:30:00', 330000.00, 0.00, NULL, 'pending', 'Làng Đại học Quốc gia, Dĩ An, Bình Dương', 'COD'),
(34, 3, NULL, '2026-04-12 09:45:00', 150000.00, 0.00, NULL, '', '123 Võ Văn Ngân, Thủ Đức, TP.HCM', 'Banking'),
(35, 28, NULL, '2026-04-13 01:12:00', 354000.00, 0.00, NULL, 'delivered', 'Cổng sau Đại học Ngân hàng, TP.HCM', 'COD'),
(36, 30, NULL, '2026-04-14 12:25:00', 305000.00, 0.00, NULL, 'delivered', 'Thanh Xuân, Hà Nội', 'COD'),
(37, 14, NULL, '2026-04-15 04:00:00', 450000.00, 0.00, NULL, '', 'Quận 1, TP.HCM', 'Banking'),
(38, 31, NULL, '2026-04-15 08:30:00', 535000.00, 0.00, NULL, 'delivered', 'Bình Thạnh, TP.HCM', 'COD'),
(39, 10, NULL, '2026-04-16 02:45:00', 515000.00, 0.00, NULL, 'cancelled', 'Hải Châu, Đà Nẵng', 'COD'),
(40, 6, NULL, '2026-04-16 14:00:00', 154000.00, 0.00, NULL, 'delivered', 'Ký túc xá BUH, TP.HCM', 'Banking'),
(41, 46, NULL, '2026-04-17 06:20:00', 460000.00, 0.00, NULL, 'pending', 'Linh Xuân, Thủ Đức', 'COD'),
(42, 14, NULL, '2026-04-17 11:10:00', 470000.00, 0.00, NULL, 'delivered', 'Quận 7, TP.HCM', 'Banking'),
(43, 29, NULL, '2026-04-18 00:55:00', 497000.00, 0.00, NULL, 'delivered', 'Phú Nhuận, TP.HCM', 'COD'),
(44, 3, NULL, '2026-04-18 05:30:00', 180000.00, 0.00, NULL, '', 'Hàm Nghi, Quận 1', 'COD'),
(45, 26, NULL, '2026-04-19 07:15:00', 135000.00, 0.00, NULL, 'delivered', 'Cầu Giấy, Hà Nội', 'Banking'),
(46, 21, NULL, '2026-04-19 13:00:00', 75000.00, 0.00, NULL, 'delivered', 'Thủ Đức, TP.HCM', 'COD'),
(47, 28, NULL, '2026-04-20 01:00:00', 178000.00, 0.00, NULL, 'pending', 'Bình Tân, TP.HCM', 'COD'),
(48, 23, NULL, '2026-04-20 03:30:00', 184000.00, 0.00, NULL, 'delivered', 'Hoàn Kiếm, Hà Nội', 'Banking'),
(49, 29, NULL, '2026-04-20 04:45:00', 1115000.00, 0.00, NULL, '', 'Ký túc xá BUH, TP.HCM', 'COD'),
(50, 27, NULL, '2026-04-20 07:20:00', 372000.00, 0.00, NULL, 'delivered', 'Dĩ An, Bình Dương', 'COD'),
(51, 47, NULL, '2026-04-20 08:50:00', 275000.00, 0.00, NULL, 'delivered', 'Quận 3, TP.HCM', 'Banking'),
(52, 7, NULL, '2026-04-20 09:10:00', 277000.00, 0.00, NULL, 'delivered', 'Nha Trang, Khánh Hòa', 'COD'),
(53, 38, NULL, '2026-04-20 09:30:00', 105000.00, 0.00, NULL, 'pending', 'TP. Thủ Đức', 'COD'),
(54, 18, NULL, '2026-04-20 09:45:00', 185000.00, 0.00, NULL, '', 'Linh Tây, Thủ Đức', 'Banking'),
(55, 27, NULL, '2026-04-20 10:00:00', 350000.00, 0.00, NULL, 'delivered', 'Phú Nhuận, TP.HCM', 'COD'),
(56, 30, NULL, '2026-04-20 10:15:00', 244000.00, 0.00, NULL, 'delivered', 'Quận 10, TP.HCM', 'COD'),
(57, 17, NULL, '2026-04-20 10:30:00', 125000.00, 0.00, NULL, 'delivered', 'TP.HCM', 'Banking'),
(58, 45, NULL, '2026-04-20 10:45:00', 196000.00, 0.00, NULL, 'delivered', 'Bình Dương', 'COD'),
(59, 24, NULL, '2026-04-20 11:00:00', 325000.00, 0.00, NULL, 'delivered', 'TP.HCM', 'COD'),
(60, 32, NULL, '2026-04-20 11:15:00', 450000.00, 0.00, NULL, 'pending', 'Vũng Tàu', 'Banking'),
(61, 37, NULL, '2026-04-20 11:30:00', 92000.00, 0.00, NULL, 'delivered', 'Thủ Đức', 'COD'),
(62, 38, NULL, '2026-04-20 11:45:00', 294000.00, 0.00, NULL, 'delivered', 'TP.HCM', 'COD'),
(63, 30, NULL, '2026-04-20 12:00:00', 245000.00, 0.00, NULL, 'delivered', 'Phú Nhuận', 'Banking'),
(64, 35, NULL, '2026-04-20 12:15:00', 130000.00, 0.00, NULL, 'delivered', 'Quận 1', 'COD'),
(65, 32, NULL, '2026-04-20 12:30:00', 303000.00, 0.00, NULL, 'delivered', 'Ký túc xá', 'COD'),
(66, 5, NULL, '2026-04-20 12:45:00', 184000.00, 0.00, NULL, 'delivered', 'Bình Dương', 'Banking'),
(67, 28, NULL, '2026-04-20 13:00:00', 395000.00, 0.00, NULL, 'delivered', 'TP.HCM', 'COD'),
(68, 22, NULL, '2026-04-20 13:15:00', 185000.00, 0.00, NULL, 'delivered', 'Đà Nẵng', 'COD'),
(69, 26, NULL, '2026-04-20 13:30:00', 495000.00, 0.00, NULL, 'delivered', 'Thủ Đức', 'Banking'),
(70, 15, NULL, '2026-04-20 13:45:00', 350000.00, 0.00, NULL, 'delivered', 'TP.HCM', 'COD'),
(71, 44, NULL, '2026-04-20 14:00:00', 370000.00, 0.00, NULL, 'delivered', 'Phú Nhuận', 'COD'),
(72, 25, NULL, '2026-04-20 14:15:00', 135000.00, 0.00, NULL, 'delivered', 'Quận 1', 'Banking'),
(73, 41, NULL, '2026-04-20 14:30:00', 522000.00, 0.00, NULL, 'delivered', 'TP.HCM', 'COD'),
(74, 33, NULL, '2026-04-20 14:45:00', 445000.00, 0.00, NULL, 'delivered', 'Bình Dương', 'COD'),
(75, 37, NULL, '2026-04-20 15:00:00', 248000.00, 0.00, NULL, 'delivered', 'TP.HCM', 'Banking'),
(76, 38, NULL, '2026-04-20 15:15:00', 205000.00, 0.00, NULL, 'delivered', 'Cần Thơ', 'COD'),
(77, 29, NULL, '2026-04-20 15:30:00', 439000.00, 0.00, NULL, 'delivered', 'Thủ Đức', 'COD'),
(78, 28, NULL, '2026-04-20 15:45:00', 455000.00, 0.00, NULL, 'delivered', 'TP.HCM', 'Banking'),
(79, 50, NULL, '2026-04-20 16:00:00', 200000.00, 0.00, NULL, 'delivered', 'Phú Nhuận', 'COD'),
(80, 20, NULL, '2026-04-20 16:15:00', 290000.00, 0.00, NULL, 'delivered', 'Quận 5', 'COD'),
(81, 44, NULL, '2026-04-20 16:30:00', 210000.00, 0.00, NULL, 'delivered', 'TP. Thủ Đức, TP.HCM', 'COD'),
(82, 11, NULL, '2026-04-21 00:15:00', 185000.00, 0.00, NULL, 'delivered', 'Dĩ An, Bình Dương', 'Banking'),
(83, 20, NULL, '2026-04-21 01:30:00', 185000.00, 0.00, NULL, 'delivered', 'Quận Phú Nhuận, TP.HCM', 'COD'),
(84, 15, NULL, '2026-04-21 02:45:00', 125000.00, 0.00, NULL, 'pending', 'Hải Châu, Đà Nẵng', 'Banking'),
(85, 16, NULL, '2026-04-21 03:20:00', 370000.00, 0.00, NULL, 'delivered', 'Ký túc xá BUH, TP.HCM', 'COD'),
(86, 34, NULL, '2026-04-21 04:10:00', 350000.00, 0.00, NULL, '', 'Quận 1, TP.HCM', 'COD'),
(87, 21, NULL, '2026-04-21 05:00:00', 155000.00, 0.00, NULL, 'delivered', 'Bình Thạnh, TP.HCM', 'Banking'),
(88, 3, NULL, '2026-04-21 06:45:00', 215000.00, 0.00, NULL, 'delivered', 'Quận 10, TP.HCM', 'COD'),
(89, 47, NULL, '2026-04-21 07:30:00', 135000.00, 0.00, NULL, 'delivered', 'Thủ Đức, TP.HCM', 'Banking'),
(90, 30, NULL, '2026-04-21 08:15:00', 387000.00, 0.00, NULL, 'delivered', 'Làng Đại học, Bình Dương', 'COD'),
(91, 5, NULL, '2026-04-21 09:00:00', 135000.00, 0.00, NULL, 'delivered', 'Phú Nhuận, TP.HCM', 'Banking'),
(92, 33, NULL, '2026-04-21 09:50:00', 95000.00, 0.00, NULL, 'cancelled', 'Quận 3, TP.HCM', 'COD'),
(93, 49, NULL, '2026-04-21 10:30:00', 350000.00, 0.00, NULL, 'delivered', 'BUH Cơ sở Thủ Đức', 'COD'),
(94, 49, NULL, '2026-04-21 11:10:00', 98000.00, 0.00, NULL, 'delivered', 'Bình Dương', 'Banking'),
(95, 45, NULL, '2026-04-21 12:00:00', 150000.00, 0.00, NULL, 'delivered', 'TP.HCM', 'COD'),
(96, 28, NULL, '2026-04-21 12:45:00', 130000.00, 0.00, NULL, 'delivered', 'Quận 1, TP.HCM', 'Banking'),
(97, 3, NULL, '2026-04-21 13:30:00', 75000.00, 0.00, NULL, 'delivered', 'Ký túc xá', 'COD'),
(98, 26, NULL, '2026-04-21 14:15:00', 89000.00, 0.00, NULL, 'delivered', 'Thủ Đức', 'COD'),
(99, 24, NULL, '2026-04-21 15:00:00', 350000.00, 0.00, NULL, 'confirmed', 'TP.HCM', 'Banking'),
(100, 41, NULL, '2026-04-21 15:45:00', 350000.00, 0.00, NULL, 'delivered', 'Nha Trang', 'COD'),
(101, 35, NULL, '2026-04-22 01:30:00', 105000.00, 0.00, NULL, 'delivered', 'Thủ Đức', 'COD'),
(102, 48, NULL, '2026-04-22 02:15:00', 105000.00, 0.00, NULL, '', 'Bình Dương', 'Banking'),
(103, 34, NULL, '2026-04-22 03:00:00', 95000.00, 0.00, NULL, 'delivered', 'TP.HCM', 'COD'),
(104, 26, NULL, '2026-04-22 04:30:00', 75000.00, 0.00, NULL, 'delivered', 'Quận 1', 'Banking'),
(105, 28, NULL, '2026-04-22 05:45:00', 215000.00, 0.00, NULL, 'delivered', 'Ký túc xá BUH', 'COD'),
(111, 51, NULL, '2026-04-21 01:27:34', 156000.00, 0.00, NULL, 'shipping', 'Kim Ngan - 0123456789 - qưertyu, Đồng Nai', 'COD'),
(112, 51, NULL, '2026-04-21 02:00:56', 398000.00, 0.00, NULL, 'pending', 'Kim Ngan - 0123456789 - 12345, Đồng Nai', 'BANK_TRANSFER');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `order_item_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `book_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`order_item_id`),
  KEY `order_id` (`order_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(22, 30, 10, 4, 139300.00),
(23, 31, 2, 2, 150000.00),
(24, 32, 14, 2, 90000.00),
(25, 32, 34, 1, 150000.00),
(26, 33, 41, 1, 115000.00),
(27, 33, 70, 1, 215000.00),
(28, 34, 68, 1, 150000.00),
(29, 35, 31, 1, 89000.00),
(30, 35, 35, 1, 110000.00),
(31, 35, 14, 1, 98000.00),
(32, 36, 65, 1, 110000.00),
(33, 36, 40, 1, 195000.00),
(34, 37, 57, 1, 450000.00),
(35, 38, 62, 1, 350000.00),
(36, 38, 61, 1, 185000.00),
(37, 39, 43, 1, 145000.00),
(38, 39, 28, 2, 185000.00),
(39, 40, 66, 1, 65000.00),
(40, 40, 67, 1, 89000.00),
(41, 41, 47, 1, 110000.00),
(42, 41, 62, 1, 350000.00),
(43, 42, 49, 2, 130000.00),
(44, 42, 48, 1, 210000.00),
(45, 43, 9, 3, 129000.00),
(46, 43, 22, 1, 110000.00),
(47, 44, 26, 1, 180000.00),
(48, 45, 63, 1, 135000.00),
(49, 46, 56, 1, 75000.00),
(50, 47, 31, 2, 89000.00),
(51, 48, 60, 2, 92000.00),
(52, 49, 57, 2, 450000.00),
(53, 49, 70, 1, 215000.00),
(54, 50, 60, 1, 92000.00),
(55, 50, 69, 1, 95000.00),
(56, 50, 28, 1, 185000.00),
(57, 51, 51, 1, 155000.00),
(58, 51, 46, 1, 120000.00),
(59, 52, 58, 1, 185000.00),
(60, 52, 64, 1, 92000.00),
(61, 53, 50, 1, 105000.00),
(62, 54, 65, 1, 110000.00),
(63, 54, 56, 1, 75000.00),
(64, 55, 62, 1, 350000.00),
(65, 56, 43, 1, 145000.00),
(66, 56, 59, 1, 99000.00),
(67, 57, 32, 1, 125000.00),
(68, 58, 42, 2, 98000.00),
(69, 59, 70, 1, 215000.00),
(70, 59, 65, 1, 110000.00),
(71, 60, 57, 1, 450000.00),
(72, 61, 60, 1, 92000.00),
(73, 62, 14, 3, 98000.00),
(74, 63, 63, 1, 135000.00),
(75, 63, 65, 1, 110000.00),
(76, 64, 49, 1, 130000.00),
(77, 65, 52, 1, 88000.00),
(78, 65, 70, 1, 215000.00),
(79, 66, 31, 1, 89000.00),
(80, 66, 69, 1, 95000.00),
(81, 67, 50, 2, 105000.00),
(82, 67, 58, 1, 185000.00),
(83, 68, 58, 1, 185000.00),
(84, 69, 32, 1, 125000.00),
(85, 69, 28, 2, 185000.00),
(86, 70, 62, 1, 350000.00),
(87, 71, 51, 1, 155000.00),
(88, 71, 70, 1, 215000.00),
(89, 72, 63, 1, 135000.00),
(90, 73, 9, 3, 129000.00),
(91, 73, 63, 1, 135000.00),
(92, 74, 33, 1, 95000.00),
(93, 74, 62, 1, 350000.00),
(94, 75, 42, 1, 98000.00),
(95, 75, 34, 1, 150000.00),
(96, 76, 49, 1, 130000.00),
(97, 76, 56, 1, 75000.00),
(98, 77, 31, 1, 89000.00),
(99, 77, 29, 1, 350000.00),
(100, 78, 62, 1, 350000.00),
(101, 78, 50, 1, 105000.00),
(102, 79, 50, 1, 105000.00),
(103, 79, 69, 1, 95000.00),
(104, 80, 56, 1, 75000.00),
(105, 80, 70, 1, 215000.00),
(111, 111, 15, 2, 78000.00),
(112, 112, 10, 2, 199000.00);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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

DROP TABLE IF EXISTS `return_requests`;
CREATE TABLE IF NOT EXISTS `return_requests` (
  `request_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `user_id` int NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved','rejected','refunded') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`request_id`),
  KEY `order_id` (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `return_requests`
--

INSERT INTO `return_requests` (`request_id`, `order_id`, `user_id`, `reason`, `image_proof`, `status`, `created_at`) VALUES
(1, 1, 2, 'Sách bị rách bìa', NULL, 'pending', '2025-12-19 04:00:46');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `review_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `book_id` int NOT NULL,
  `rating` tinyint DEFAULT '5' COMMENT '1-5 sao',
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_approved` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`review_id`),
  KEY `user_id` (`user_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `book_id`, `rating`, `comment`, `created_at`, `is_approved`) VALUES
(1, 2, 1, 5, 'Sách rất hay, đóng gói đẹp.', '2025-12-19 04:00:46', 1),
(2, 27, 1, 4, 'Câu chuyện cảm động, văn phong nhẹ nhàng.', '2025-12-26 03:02:24', 1),
(3, 30, 1, 5, 'Rất hay, gợi nhớ nhiều kỷ niệm tuổi thơ.', '2025-12-26 03:02:24', 1),
(4, 17, 2, 5, 'Harry Potter luôn là tuổi thơ của mình.', '2025-12-26 03:02:24', 1),
(5, 43, 2, 4, 'Sách in đẹp, nội dung hấp dẫn.', '2025-12-26 03:02:24', 1),
(6, 14, 6, 5, 'hay', '2025-12-26 11:04:35', 1),
(7, 40, 8, 5, 'hay\'', '2025-12-27 03:19:31', 1),
(8, 7, 10, 5, 'hay', '2025-12-27 03:21:43', 1),
(9, 11, 10, 1, 'dở', '2025-12-27 03:21:51', 1),
(10, 35, 7, 5, 'hay', '2025-12-27 03:28:12', 1),
(11, 41, 7, 1, 'đc của ló.', '2025-12-27 04:39:21', 0),
(14, 49, 10, 5, 'hay qua', '2026-01-10 12:09:11', 0),
(15, 23, 7, 5, 'hay quá', '2026-01-11 15:00:14', 1),
(16, 17, 31, 5, 'Hình vẽ trong sách rất đẹp, nội dung về mẹ làm mình khóc luôn.', '2026-04-10 03:00:00', 1),
(17, 15, 34, 5, 'Không Gia Đình bản này in đẹp quá, rất đáng tiền.', '2026-04-11 08:30:00', 1),
(18, 22, 36, 4, 'Sách triết lý sâu sắc, giao hàng nhanh.', '2026-04-12 02:15:00', 1),
(19, 15, 39, 5, 'Truyện trinh thám Uketsu chưa bao giờ làm mình thất vọng, cuốn cực kỳ.', '2026-04-13 14:00:00', 1),
(20, 6, 44, 5, 'Một Lít Nước Mắt là cuốn sách thay đổi tư duy sống của mình. Cảm ơn shop.', '2026-04-14 07:20:00', 1),
(21, 35, 46, 3, 'Nội dung hóm hỉnh nhưng mình thấy hơi ngắn.', '2026-04-15 01:45:00', 1),
(22, 5, 48, 5, 'Bìa cứng Kiêu Hãnh Và Định Kiến quá sang xịn mịn.', '2026-04-16 04:10:00', 1),
(23, 19, 53, 4, '999 lá thư giúp mình học tiếng Trung tốt hơn nhiều.', '2026-04-17 09:50:00', 1),
(24, 29, 66, 5, 'Conan movie này đọc tiểu thuyết vẫn thấy hay như xem phim.', '2026-04-18 12:30:00', 1),
(25, 39, 68, 5, 'Bác Ánh viết truyện Sài Gòn vẫn cứ là đỉnh của chóp!', '2026-04-19 05:00:00', 1),
(26, 8, 69, 4, 'Sách giúp mình bình tâm hơn giữa áp lực học hành.', '2026-04-20 03:15:00', 1),
(27, 20, 70, 5, 'Ghi chép pháp y đọc hơi ghê nhưng cực kỳ lôi cuốn.', '2026-04-20 08:40:00', 1),
(28, 26, 37, 5, 'Văn phong Nguyễn Ngọc Tư lúc nào cũng buồn man mác nma hay.', '2026-04-20 13:20:00', 1),
(29, 17, 43, 4, 'Hơi buồn nma ý nghĩa.', '2026-04-21 02:00:00', 1),
(30, 8, 62, 5, 'Fan Game of Thrones nhất định phải mua cuốn Lửa và Máu này nha!', '2026-04-21 07:50:00', 1),
(31, 46, 64, 5, 'Sách giao nhanh, đóng gói rất cẩn thận, bìa đẹp lắm luôn!', '2026-04-20 08:43:52', 1),
(32, 41, 18, 5, 'Nội dung cực kỳ hay và ý nghĩa, rất đáng để mua nha mọi người.', '2026-04-20 08:43:52', 1),
(33, 44, 39, 4, 'Sách in rõ nét, giấy thơm, nội dung thì không có gì để chê.', '2026-04-20 08:43:52', 1),
(34, 15, 19, 5, 'Chất lượng tuyệt vời, giao hàng siêu tốc, 10 điểm cho shop!', '2026-04-20 08:43:52', 1),
(35, 40, 3, 5, 'Sách mới cứng, không bị móp méo góc nào, ưng ý cực kỳ.', '2026-04-20 08:43:52', 1),
(36, 44, 17, 4, 'Đã nhận được hàng, nội dung đúng như mô tả, hài lòng.', '2026-04-20 08:43:52', 1),
(37, 32, 15, 5, 'Cuốn này hay thực sự, đọc một lèo hết luôn, cực kỳ lôi cuốn.', '2026-04-20 08:43:52', 1),
(38, 19, 51, 3, 'Nội dung tạm ổn, tuy nhiên khâu giao hàng hơi lâu một chút.', '2026-04-20 08:43:52', 1),
(39, 43, 4, 5, 'Sách đẹp, dịch mượt, bọc chống sốc kỹ càng, rất an tâm.', '2026-04-20 08:43:52', 1),
(40, 38, 30, 5, 'Một cuốn sách rất đáng để đầu tư và suy ngẫm, vote 5 sao.', '2026-04-20 08:43:52', 1),
(41, 48, 41, 4, 'Giấy hơi mỏng một tí nhưng nội dung quá hay nên bỏ qua được.', '2026-04-20 08:43:52', 1),
(42, 9, 32, 5, 'Mua đúng đợt giảm giá nên giá rất hời, cảm ơn shop nhiều!', '2026-04-20 08:43:52', 1),
(43, 13, 23, 5, 'Sách hay, hình thức đẹp, shipper nhiệt tình, sẽ ủng hộ tiếp.', '2026-04-20 08:43:52', 1),
(44, 16, 6, 5, 'Đọc xong thấy học hỏi được nhiều điều, sách rất chất lượng.', '2026-04-20 08:43:52', 1),
(45, 40, 41, 4, 'Giao hàng đúng hẹn, đóng gói chuyên nghiệp, nội dung ổn.', '2026-04-20 08:43:52', 1),
(46, 34, 31, 5, 'Sách siêu đẹp, cầm chắc tay, nội dung cực kỳ cuốn hút.', '2026-04-20 08:43:52', 1),
(47, 19, 7, 5, 'Thực sự hài lòng với đơn hàng này, sách rất hay và bổ ích.', '2026-04-20 08:43:52', 1),
(48, 33, 57, 3, 'Sách bị nhăn một chút ở bìa sau nhưng nội dung vẫn rất tốt.', '2026-04-20 08:43:52', 1),
(49, 16, 43, 5, 'Rất thích cách trình bày của cuốn này, nội dung thì đỉnh rồi.', '2026-04-20 08:43:52', 1),
(50, 25, 18, 5, 'Sách hay, bọc plastic sẵn luôn, chăm sóc khách hàng rất tốt.', '2026-04-20 08:43:52', 1),
(51, 26, 21, 5, 'Sách hay ngoài mong đợi, shop tư vấn rất nhiệt tình luôn.', '2026-04-20 08:44:23', 1),
(52, 17, 17, 5, 'Bìa sách thiết kế quá đẹp, cầm trên tay rất thích.', '2026-04-20 08:44:23', 1),
(53, 29, 56, 4, 'Chất lượng giấy tốt, không bị nhòe mực, đóng gói chắc chắn.', '2026-04-20 08:44:23', 1),
(54, 28, 6, 5, 'Vừa đặt hôm qua mà hôm nay đã nhận được rồi, siêu nhanh!', '2026-04-20 08:44:23', 1),
(55, 46, 23, 5, 'Nội dung thực sự bổ ích, mình sẽ giới thiệu cho bạn bè mua cùng.', '2026-04-20 08:44:23', 1),
(56, 46, 38, 4, 'Giá cả hợp lý so với chất lượng, đóng gói có tâm.', '2026-04-20 08:44:23', 1),
(57, 49, 23, 5, 'Cuốn này mình tìm mãi mới thấy shop có bản đẹp như này.', '2026-04-20 08:44:23', 1),
(58, 36, 25, 5, 'Quá hài lòng, sách còn mới nguyên seal, không một vết trầy.', '2026-04-20 08:44:23', 1),
(59, 40, 58, 4, 'Nội dung sâu sắc, trình bày dễ hiểu, rất đáng đọc.', '2026-04-20 08:44:23', 1),
(60, 43, 46, 5, 'Dịch giả dịch rất thoát ý, đọc trôi chảy không bị vấp.', '2026-04-20 08:44:23', 1),
(61, 41, 5, 5, 'Shop bọc sách kỹ nhất mình từng mua, ủng hộ shop dài dài.', '2026-04-20 08:44:23', 1),
(62, 44, 13, 4, 'Shipper thân thiện, sách về tay vẫn giữ được form dáng.', '2026-04-20 08:44:23', 1),
(63, 19, 56, 5, 'Mọi thứ đều hoàn hảo từ nội dung đến hình thức.', '2026-04-20 08:44:23', 1),
(64, 17, 47, 5, 'Sách hay, truyền nhiều cảm hứng tích cực cho mình.', '2026-04-20 08:44:23', 1),
(65, 37, 32, 4, 'Rất đáng tiền, sẽ quay lại mua thêm nhiều cuốn nữa.', '2026-04-20 08:44:23', 1),
(66, 17, 54, 5, 'Màu sắc bìa rực rỡ, giấy bên trong sờ rất mịn tay.', '2026-04-20 08:44:23', 1),
(67, 15, 40, 5, 'Nội dung lôi cuốn từ những trang đầu tiên, tuyệt quá.', '2026-04-20 08:44:23', 1),
(68, 21, 59, 4, 'Sách nhẹ, dễ mang theo đọc khi đi cà phê hoặc xe buýt.', '2026-04-20 08:44:23', 1),
(69, 21, 2, 5, 'Chất lượng phục vụ của shop quá tốt, sách chất lượng.', '2026-04-20 08:44:23', 1),
(70, 14, 52, 5, 'Cảm ơn shop đã đem đến một cuốn sách hay như thế này.', '2026-04-20 08:44:23', 1),
(71, 19, 9, 4, 'Đóng gói đẹp đến mức không nỡ xé ra luôn á.', '2026-04-20 08:44:23', 1),
(72, 39, 30, 5, 'Kiến thức trong sách rất thực tế và dễ áp dụng.', '2026-04-20 08:44:23', 1),
(73, 44, 6, 5, 'Chờ đợi bấy lâu cuối cùng cũng sở hữu được em nó.', '2026-04-20 08:44:23', 1),
(74, 39, 40, 4, 'Sách in khổ to dễ đọc, không bị đau mắt.', '2026-04-20 08:44:23', 1),
(75, 31, 6, 5, 'Một món quà tuyệt vời để tự thưởng cho bản thân.', '2026-04-20 08:44:23', 1),
(76, 40, 39, 5, 'Shop giao đúng mẫu, đúng số lượng, đóng gói 5 sao.', '2026-04-20 08:44:23', 1),
(77, 27, 48, 5, 'Nội dung quá hay, mình đã đọc xong chỉ trong 2 ngày.', '2026-04-20 08:44:23', 1),
(78, 9, 8, 4, 'Hài lòng về mọi mặt, giá săn sale quá rẻ.', '2026-04-20 08:44:23', 1),
(79, 25, 55, 5, 'Sách chất lượng, kiến thức mới mẻ, rất thú vị.', '2026-04-20 08:44:23', 1),
(80, 36, 68, 5, 'Tuyệt phẩm! Mọi người nên mua để trải nghiệm nhé.', '2026-04-20 08:44:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('vVxNA657CBeyDTtAm3moa9gjzXDmxZaMuDzdeph2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYjQ2ODgwOXFhQW9sbHU3NkRqNTl6Q1BEcktsaHU1dVJZdWM1bFdCVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hdXRoL2dvb2dsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776746614);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_addresses`
--

DROP TABLE IF EXISTS `shipping_addresses`;
CREATE TABLE IF NOT EXISTS `shipping_addresses` (
  `address_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `address_line` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `is_default` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`address_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping_addresses`
--

INSERT INTO `shipping_addresses` (`address_id`, `user_id`, `full_name`, `phone`, `address_line`, `city`, `is_default`, `created_at`) VALUES
(1, 3, 'tuanpham1', '0968143960', '123, Châu Thành', 'An Giang', 0, '2025-12-26 16:53:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int DEFAULT '2',
  `status` tinyint DEFAULT '1' COMMENT '1: Active, 0: Banned',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `gender` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `full_name`, `phone`, `role_id`, `status`, `created_at`, `gender`, `date_of_birth`, `avatar`, `remember_token`) VALUES
(1, 'admin@bookstore.com', '$2y$10$hashedpasswordEXAMPLE', 'Nguyễn Quản Trị', '0901000001', 2, 1, '2025-12-19 04:00:45', NULL, NULL, NULL, NULL),
(2, 'khachhang@gmail.com', '$2y$10$hashedpasswordEXAMPLE', 'Trần Văn Mua', '0902000002', 1, 1, '2025-12-19 04:00:45', NULL, NULL, NULL, NULL),
(3, 'vovanquang01012005@gmail.com', '$2y$10$tzhNc6FfINQgK/jND4PHveCAzAmcqS08aO9yAuveXybXqw.deIawO', 'Quang Tèo', '0374220802', 1, 1, '2025-12-21 15:55:48', 'M', '2005-09-02', NULL, NULL),
(4, '030239230001@st.buh.edu.vn', '$2y$10$BC.9elRuiO1yaqpOsJAJGe/iBmczWl7kXupnR9M5BiY53q97kGISW', 'An Huynh', '0312333111', 2, 1, '2025-12-21 18:45:49', NULL, NULL, NULL, NULL),
(5, 'hoangquoc10@gmail.com', '$2y$10$tnHbpcge4iYhOkxK9quHFe740pZmoCHDh.BCtgjzWoNXAeopf3SSq', 'quocngu', '0312212221', 2, 1, '2025-12-25 15:22:18', NULL, NULL, NULL, NULL),
(6, '123@gmail.com', '$2y$10$5lXwb8RXab7PxnXXfO0o5ehqQR2CtkluOQpMUr7Sn9FZ2EGr3.TIq', 'Ngọc Thư', '0374220802', 2, 1, '2025-12-27 02:50:59', NULL, NULL, NULL, NULL),
(7, 'admin_1@bookstore.com', '$2y$12$j9362hly5LV5ptv3Ybdaq.G5hFACriGi1oRP9yPjdSFEQ/bfeTsdW', 'Trần Quản Trị', NULL, 2, 1, '2026-04-20 03:18:37', NULL, NULL, NULL, NULL),
(8, 'minhtam.le@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Lê Minh Tâm', '0901234567', 2, 1, '2026-04-20 08:38:02', 'N', '2003-05-15', NULL, NULL),
(9, 'thuthao.tran@yahoo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Trần Thị Thu Thảo', '0912345678', 2, 1, '2026-04-20 08:38:02', 'N', '2004-11-20', NULL, NULL),
(10, 'hoangnam.p@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Phạm Hoàng Nam', '0987654321', 2, 1, '2026-04-20 08:38:02', 'N', '2002-02-10', NULL, NULL),
(11, 'maichi.nguyen@outlook.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Nguyễn Mai Chi', '0933445566', 2, 1, '2026-04-20 08:38:02', 'N', '2005-08-25', NULL, NULL),
(12, 'trongvu.dev@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vũ Đình Trọng', '0944556677', 2, 1, '2026-04-20 08:38:02', 'N', '2001-12-30', NULL, NULL),
(13, 'thuha.dang@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Đặng Thu Hà', '0966778899', 2, 1, '2026-04-20 08:38:02', 'N', '2004-04-12', NULL, NULL),
(14, 'anhtuan.bui@hotmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Bùi Anh Tuấn', '0977889900', 2, 1, '2026-04-20 08:38:02', 'N', '2003-09-05', NULL, NULL),
(15, 'kimngan.do@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Đỗ Kim Ngân', '0911223344', 2, 1, '2026-04-20 08:38:02', 'N', '2002-06-18', NULL, NULL),
(16, 'thaivanh@yahoo.com.vn', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Hoàng Văn Thái', '0922334455', 2, 1, '2026-04-20 08:38:02', 'N', '1999-03-22', NULL, NULL),
(17, 'ky.ly@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Lý Nhã Kỳ', '0955667788', 2, 1, '2026-04-20 08:38:02', 'N', '2000-10-10', NULL, NULL),
(18, 'baotruong@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Trương Quốc Bảo', '0909090909', 2, 1, '2026-04-20 08:38:02', 'N', '2004-01-01', NULL, NULL),
(19, 'tuyetmai.phan@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Phan Tuyết Mai', '0888777666', 2, 1, '2026-04-20 08:38:02', 'N', '2003-12-12', NULL, NULL),
(20, 'khaingo.work@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ngô Quang Khải', '0777666555', 2, 1, '2026-04-20 08:38:02', 'N', '1998-05-20', NULL, NULL),
(21, 'giabaodinh@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Đinh Gia Bảo', '0666555444', 2, 1, '2026-04-20 08:38:02', 'N', '2005-02-14', NULL, NULL),
(22, 'thuyvi.lam@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Lâm Thúy Vi', '0555444333', 2, 1, '2026-04-20 08:38:02', 'N', '2004-07-07', NULL, NULL),
(23, 'longthanh@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Nguyễn Thành Long', '0444333222', 2, 1, '2026-04-20 08:38:02', 'N', '2002-11-11', NULL, NULL),
(24, 'baongoc.t@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Trần Bảo Ngọc', '0333222111', 2, 1, '2026-04-20 08:38:02', 'N', '2003-04-04', NULL, NULL),
(25, 'dangkhoa.p@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Phạm Đăng Khoa', '0901112223', 2, 1, '2026-04-20 08:38:02', 'N', '2001-08-08', NULL, NULL),
(26, 'mylinh.vuong@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Vương Mỹ Linh', '0902223334', 2, 1, '2026-04-20 08:38:02', 'N', '2004-09-09', NULL, NULL),
(27, 'nhatminh@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Tạ Minh Nhật', '0903334445', 2, 1, '2026-04-20 08:38:02', 'N', '2002-05-05', NULL, NULL),
(28, 'vinhluong@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Lương Thế Vinh', '0904445556', 2, 1, '2026-04-20 08:38:02', 'N', '2000-07-07', NULL, NULL),
(29, 'duongbach@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Bạch Dương', '0905556667', 2, 1, '2026-04-20 08:38:02', 'N', '2004-03-03', NULL, NULL),
(30, 'soncao@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Cao Thái Sơn', '0906667778', 2, 1, '2026-04-20 08:38:02', 'N', '1995-09-22', NULL, NULL),
(31, 'amanhdiep@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Diệp Lâm Anh', '0907778889', 2, 1, '2026-04-20 08:38:02', 'N', '2001-01-15', NULL, NULL),
(32, 'vanhua@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Hứa Vĩ Văn', '0908889990', 2, 1, '2026-04-20 08:38:02', 'N', '1998-12-25', NULL, NULL),
(33, 'tuankieu@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Kiều Minh Tuấn', '0909990001', 2, 1, '2026-04-20 08:38:02', 'N', '2000-02-29', NULL, NULL),
(34, 'lanngoc@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ninh Dương Lan Ngọc', '0901010101', 2, 1, '2026-04-20 08:38:02', 'N', '2003-04-04', NULL, NULL),
(35, 'mtp@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Sơn Tùng M-TP', '0902020202', 2, 1, '2026-04-20 08:38:02', 'N', '2004-07-05', NULL, NULL),
(36, 'denvau@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Nguyễn Đức Cường', '0903030303', 2, 1, '2026-04-20 08:38:02', 'N', '2001-05-13', NULL, NULL),
(37, 'hangocha@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Hồ Ngọc Hà', '0904040404', 2, 1, '2026-04-20 08:38:02', 'N', '1999-11-25', NULL, NULL),
(38, 'toctien@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Nguyễn Khoa Tóc Tiên', '0905050505', 2, 1, '2026-04-20 08:38:02', 'N', '2002-05-13', NULL, NULL),
(39, 'isaac@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Phạm Lưu Tuấn Tài', '0906060606', 2, 1, '2026-04-20 08:38:02', 'N', '2001-06-13', NULL, NULL),
(40, 'miule@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Lê Ánh Nhật', '0907070707', 2, 1, '2026-04-20 08:38:02', 'N', '2003-07-05', NULL, NULL),
(41, 'ngokienhuy@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Lê Thành Dương', '0908080808', 2, 1, '2026-04-20 08:38:02', 'N', '2000-06-29', NULL, NULL),
(42, 'dongnhi@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Mai Hồng Ngọc', '0909090910', 2, 1, '2026-04-20 08:38:02', 'N', '2001-10-13', NULL, NULL),
(43, 'caothang@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ông Cao Thắng', '0901231231', 2, 1, '2026-04-20 08:38:02', 'N', '1996-01-13', NULL, NULL),
(44, 'noo@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Nguyễn Phước Thịnh', '0903213213', 2, 1, '2026-04-20 08:38:02', 'N', '2002-12-18', NULL, NULL),
(45, 'thuytien@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Trần Thị Thủy Tiên', '0904564564', 2, 1, '2026-04-20 08:38:02', 'N', '1995-11-25', NULL, NULL),
(46, 'cv9@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Lê Công Vinh', '0907897897', 2, 1, '2026-04-20 08:38:02', 'N', '1995-12-10', NULL, NULL),
(47, 'dungbui@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Bùi Tiến Dũng', '0901472583', 2, 1, '2026-04-20 08:38:02', 'N', '2003-02-28', NULL, NULL),
(48, 'hai19@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Nguyễn Quang Hải', '0903692581', 2, 1, '2026-04-20 08:38:02', 'N', '2003-04-12', NULL, NULL),
(49, 'toanvt@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Nguyễn Văn Toàn', '0902581473', 2, 1, '2026-04-20 08:38:02', 'N', '2002-04-12', NULL, NULL),
(50, 'dungdo@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Đỗ Hùng Dũng', '0901593572', 2, 1, '2026-04-20 08:38:02', 'N', '2001-09-08', NULL, NULL),
(51, 'ndkngan010805@gmail.com', '$2y$10$Qb.k3QLB03D81t21rphFD.y6ktVsVsMPkgNolSVSEMyBto289xdDS', 'Ngân Kim', NULL, 2, 1, '2026-04-20 16:48:36', NULL, NULL, NULL, 'SedfPdM9IU5w6C29LLCBG8xEAzb7LaKrW1H9WKnxeg2XZ80BYPEzrV9pFhAi'),
(52, 'admin_2@bookstore.com', '$2y$12$o36jr7QBbi7FCM6aBqYr0.HmfdZLAnTMtqFVV6HngnSZ7.BEHvSEq', NULL, NULL, 1, 1, '2026-04-20 16:59:28', NULL, NULL, NULL, NULL);

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
