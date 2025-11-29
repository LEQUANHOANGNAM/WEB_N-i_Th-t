-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 27, 2025 lúc 02:17 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `mystore`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(200) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'adminh', 'adminh@gmail.com', '$2a$12$Log.qfXXoYe0e8zJTsT5heTZeNbVPTIcX0C25Yf8vSowytYhQXzsC');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'Wayfair'),
(2, 'IKEA'),
(3, 'Simmons'),
(6, 'Pottery Barn');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_details`
--

CREATE TABLE `cart_details` (
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(2, 'Giường ngủ'),
(3, 'Bàn ăn'),
(4, 'Tủ áo'),
(5, 'Tủ chén'),
(6, 'Đèn chùm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_order`
--

CREATE TABLE `customer_order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `amount_due` decimal(10,2) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `total_products` int(11) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `order_status` enum('pending','completed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `customer_order`
--

INSERT INTO `customer_order` (`order_id`, `user_id`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`, `amount_due`, `invoice_number`, `total_products`, `order_date`, `order_status`) VALUES
(1, 0, 'minh', 'mih@gmail.com', '123123', '345345', 0.00, 1242089211, 0, '2024-08-14 21:34:51', 'pending'),
(2, 0, 'minh', 'minh@gma.com', '356456', 'hdcm', 14000000.00, 870687395, 1, '2024-08-14 21:36:53', 'pending');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_orders`
--

CREATE TABLE `customer_orders` (
  `order_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_address` text NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `total_products` int(11) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `total_price` decimal(10,2) NOT NULL,
  `order_status` enum('pending','completed','canceled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `customer_orders`
--

INSERT INTO `customer_orders` (`order_id`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`, `invoice_number`, `total_products`, `order_date`, `total_price`, `order_status`) VALUES
(1, 'Nguyễn Trần Bảo Long', 'ngtrbl@gmail.com', '0832010400', '18tmt13, phường tân chánh hiệp', 512035411, 1, '2024-08-27 09:36:16', 2500000.00, 'pending'),
(2, 'long', 'ngtrbl@gmail.com', '0832010400', '12tmt13, phuong tanchanhhiep', 1756177698, 2, '2024-08-27 09:55:39', 25990000.00, 'pending'),
(3, 'Hminh', 'hminh@gmail.com', '0912345676', 'Long Hải', 1200722306, 2, '2024-08-29 07:54:51', 17990000.00, 'pending'),
(4, 'SMinh', 'emia@gmail.com', '0912545878', 'tp Hồ Chí Minh', 57762958, 3, '2024-08-29 09:58:50', 19980000.00, 'pending');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders_pending`
--

CREATE TABLE `orders_pending` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders_pending`
--

INSERT INTO `orders_pending` (`order_id`, `user_id`, `invoice_number`, `product_id`, `quantity`, `order_status`) VALUES
(1, 3, 1730584781, 1, 3, 'pending'),
(2, 3, 1155795418, 5, 1, 'pending'),
(3, 0, 287334187, 2, 2, 'pending'),
(4, 0, 1017139893, 2, 2, 'pending'),
(5, 1, 295144174, 2, 2, 'pending'),
(6, 1, 340997621, 2, 2, 'pending'),
(7, 0, 1479263765, 2, 2, 'pending'),
(8, 0, 1419949149, 5, 1, 'pending'),
(9, 0, 244030074, 6, 1, 'pending'),
(11, 0, 95412458, 3, 1, 'pending'),
(12, 3, 168268248, 6, 1, 'pending'),
(13, 3, 2089979650, 7, 1, 'pending'),
(14, 5, 117406171, 28, 1, 'pending');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_keywords` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_description`, `product_keywords`, `category_id`, `brand_id`, `product_image1`, `product_image2`, `product_price`, `date`, `status`) VALUES
(1, 'Bàn ăn IKEA PS 2012', 'Bàn ăn thông minh với cánh thả linh hoạt, mặt bàn bằng tre bền bỉ, chân nhôm sơn tĩnh điện. Thiết kế phù hợp cho không gian nhỏ từ 2-4 người.', 'bàn ăn, bàn gỗ, bàn gỗ chân kim loại, IKEA, PS 2012, table, dining table', 3, 2, 'banan1.png', 'banan2.png', '2500000', '2024-08-29 03:02:47', 'true'),
(2, 'Tủ áo Wardrobe', 'Tủ quần áo thiết kế hiện đại, tối giản. Bên trong chia nhiều ngăn treo và xếp khoa học, giúp tối ưu không gian lưu trữ cho phòng ngủ.', 'tủ áo, tủ, IKEA, PAX, Wardrobe', 4, 2, 'tuao2.png', 'tuao1.png', '4000000', '2024-08-27 02:39:12', 'true'),
(3, 'Giường BEAUTYSLEEP III', 'Giường ngủ cao cấp kết hợp đệm lò xo túi độc lập giúp nâng đỡ cột sống. Thiết kế sang trọng, bọc vải êm ái mang lại giấc ngủ sâu.', 'giường, nệm, giường ngủ, simmons', 2, 3, 'giuong1.png', 'giuong2.png', '14000000', '2024-08-11 10:55:46', 'true'),
(4, 'Giường YC03-229 Charlie', 'Giường gỗ sồi phong cách cổ điển Pottery Barn. Khung giường chắc chắn, đầu giường bọc nệm chần nút tinh tế, màu sắc trang nhã.', 'giường, giường ngủ, bed, YC03-229 Charlie, Pottery Barn, nệm', 2, 6, 'giuong3.jpg', 'giuong4.jpg', '5990000', '2024-08-10 08:06:51', 'true'),
(5, 'Tủ đựng chén Pantry', 'Tủ bếp đa năng phong cách Farmhouse. Nhiều ngăn lưu trữ đồ khô, bát đĩa. Chất liệu gỗ công nghiệp chống ẩm, dễ dàng vệ sinh.', 'tủ, tủ chén, tủ gỗ, đồ gỗ, tủ đựng bát, tủ bếp, nhà bếp', 5, 6, 'tuchen1.jpg', 'tuchen2.jpg', '3990000', '2024-08-10 08:07:01', 'true'),
(6, 'IEnjoy', 'Giường ngủ hiện đại bọc nỉ cao cấp. Khung gỗ tự nhiên đã qua xử lý chống mối mọt. Thiết kế chân thấp an toàn và tối giản.', 'giường, nệm, giường ngủ, wayfair', 2, 1, 'giuong5.jpg', 'giuong6.jpg', '12900000', '2024-08-13 03:39:21', 'true'),
(7, 'IKEA - LADY001-1250', 'Đèn chùm thiết kế độc đáo với ánh sáng tỏa đều, tạo không gian ấm cúng và lãng mạn. Phù hợp treo trần phòng khách hoặc phòng ăn.', 'đèn, đèn chùm, đèn treo trần', 6, 2, 'den4.jpg', 'den5.jpg', '11990000', '2024-08-27 14:14:33', 'true'),
(8, 'Yong', 'Bàn ăn gỗ tự nhiên nguyên khối với vân gỗ sắc nét. Chân bàn thiết kế vững chãi, mang phong cách mộc mạc nhưng đầy tinh tế.', 'bàn, bàn ăn', 3, 2, 'ban3.jpg', 'den5.jpg', '15000000', '2024-08-29 03:40:55', 'true'),
(9, 'Giường ngủ gỗ sồi Bắc Âu', 'Giường ngủ phong cách Scandinavian. Gỗ sồi nhập khẩu 100%, vân gỗ sáng màu tự nhiên, kết cấu chịu lực tốt, bền đẹp theo thời gian.', 'giường, gỗ sồi, bắc âu, bed, nordic', 2, 2, 'giuong_go_soi_1.jpg', 'giuong_go_soi_2.jpg', '8500000', '2025-11-27 00:52:15', 'true'),
(10, 'Giường bọc nệm Luxury King', 'Giường King Size bọc nhung cao cấp màu xám ghi. Đầu giường thiết kế tựa lưng êm ái, khung gỗ tần bì chắc chắn.', 'giường, nệm, luxury, king size, simmons', 2, 3, 'giuong_nem_1.jpg', 'giuong_nem_2.jpg', '18900000', '2025-11-27 00:52:15', 'true'),
(11, 'Giường tầng trẻ em thông minh', 'Giường tầng tích hợp hệ thấu ngăn kéo cầu thang và kệ sách. Giải pháp tiết kiệm diện tích và an toàn tuyệt đối cho bé.', 'giường tầng, trẻ em, kids, bunk bed', 2, 1, 'giuong_tang_1.jpg', 'giuong_tang_2.jpg', '6200000', '2025-11-27 00:52:15', 'true'),
(12, 'Giường ngủ phong cách Vintage', 'Giường gỗ chạm khắc hoa văn tinh xảo theo phong cách hoài cổ. Màu sơn giả cổ độc đáo tạo điểm nhấn nghệ thuật cho phòng ngủ.', 'giường, cổ điển, vintage, pottery barn', 2, 6, 'giuong_vintage_1.jpg', 'giuong_vintage_2.jpg', '12500000', '2025-11-27 00:52:15', 'true'),
(13, 'Bàn ăn mặt đá Marble 6 ghế', 'Bộ bàn ăn mặt đá cẩm thạch trắng vân mây, chống ố, chịu nhiệt tốt. Chân bàn inox mạ vàng PVD kèm 6 ghế bọc da sang trọng.', 'bàn ăn, mặt đá, dining table, marble', 3, 1, 'ban_da_1.jpg', 'ban_da_2.jpg', '14500000', '2025-11-27 00:52:15', 'true'),
(14, 'Bàn ăn gỗ óc chó nguyên tấm', 'Tuyệt phẩm bàn ăn gỗ óc chó (Walnut) Bắc Mỹ nguyên tấm. Màu nâu trầm socola sang trọng, vân gỗ cuộn xoáy tự nhiên đẳng cấp.', 'bàn ăn, gỗ óc chó, walnut, cao cấp', 3, 6, 'ban_occho_1.jpg', 'ban_occho_2.jpg', '25000000', '2025-11-27 00:52:15', 'true'),
(15, 'Bàn ăn thông minh gấp gọn', 'Bàn ăn thông minh có thể mở rộng hoặc gấp gọn khi không dùng. Tích hợp bánh xe di chuyển, phù hợp căn hộ diện tích nhỏ.', 'bàn ăn, gấp gọn, thông minh, smart table', 3, 2, 'ban_gap_1.jpg', 'ban_gap_2.jpg', '3200000', '2025-11-27 00:52:15', 'true'),
(16, 'Bộ bàn ăn tròn phong cách Bistro', 'Bộ bàn tròn chân trụ sắt sơn tĩnh điện kèm 2 ghế tựa lưng cong. Phong cách Bistro lãng mạn, thích hợp cho ban công hoặc góc bếp.', 'bàn tròn, bistro, cafe, ikea', 3, 2, 'ban_tron_1.jpg', 'ban_tron_2.jpg', '2800000', '2025-11-27 00:52:15', 'true'),
(17, 'Tủ quần áo cửa lùa 2 cánh', 'Tủ áo cửa trượt vận hành êm ái với ray giảm chấn. Gỗ MDF lõi xanh chống ẩm, màu trắng tinh tế giúp không gian trông rộng hơn.', 'tủ áo, cửa lùa, sliding door, wardrobe', 4, 2, 'tu_lua_1.jpg', 'tu_lua_2.jpg', '5500000', '2025-11-27 00:52:15', 'true'),
(18, 'Tủ áo gỗ tự nhiên 4 cánh', 'Tủ quần áo gỗ xoan đào 4 cánh rộng rãi. Nội thất chia khoang treo và xếp hợp lý. Gỗ được tẩm sấy kỹ càng, không cong vênh.', 'tủ áo, gỗ tự nhiên, 4 cánh, classic', 4, 1, 'tu_go_4canh_1.jpg', 'tu_go_4canh_2.jpg', '9800000', '2025-11-27 00:52:15', 'true'),
(19, 'Tủ quần áo âm tường Modern', 'Hệ tủ áo thiết kế kịch trần (âm tường) tối ưu diện tích. Cánh kính cường lực tràn viền kết hợp đèn LED cảm biến hiện đại.', 'tủ âm tường, modern, wardrobe', 4, 6, 'tu_am_tuong_1.jpg', 'tu_am_tuong_2.jpg', '15000000', '2025-11-27 00:52:15', 'true'),
(20, 'Tủ vải khung gỗ lắp ghép', 'Tủ quần áo khung gỗ lắp ghép tiện lợi, bọc vải Canvas dày dặn chống thấm nước. Dễ dàng tháo lắp, di chuyển, giá thành tiết kiệm.', 'tủ vải, lắp ghép, giá rẻ, sinh viên', 4, 1, 'tu_vai_1.jpg', 'tu_vai_2.jpg', '850000', '2025-11-27 00:52:15', 'true'),
(21, 'Tủ bếp treo tường Acrylic', 'Tủ bếp trên cánh Acrylic bóng gương An Cường. Chống bám bẩn, dễ vệ sinh, màu sắc tươi sáng giúp căn bếp thêm phần hiện đại.', 'tủ bếp, acrylic, tủ treo, kitchen', 5, 2, 'tu_bep_1.jpg', 'tu_bep_2.jpg', '4200000', '2025-11-27 00:52:15', 'true'),
(22, 'Tủ chén gỗ xoan đào cổ điển', 'Tủ chén bát truyền thống gỗ xoan đào. Cánh tủ phối kính mờ, hoa văn chạm trổ nhẹ nhàng. Bền đẹp, chống mối mọt.', 'tủ chén, gỗ xoan đào, tủ bát', 5, 1, 'tu_chen_go_1.jpg', 'tu_chen_go_2.jpg', '3900000', '2025-11-27 00:52:15', 'true'),
(23, 'Kệ bát đĩa đa năng 3 tầng', 'Kệ để bát đĩa khung thép sơn tĩnh điện đen nhám. Các tầng gỗ cao su chống nước. Thiết kế mở thoáng khí giúp bát đĩa khô ráo.', 'kệ bát, đa năng, shelf, kitchen', 5, 2, 'ke_bat_1.jpg', 'ke_bat_2.jpg', '1500000', '2025-11-27 00:52:15', 'true'),
(24, 'Tủ rượu phòng khách cao cấp', 'Tủ rượu trưng bày cánh kính cường lực trong suốt. Hệ thống đèn LED hắt sáng làm nổi bật bộ sưu tập rượu quý. Gỗ công nghiệp cao cấp.', 'tủ rượu, phòng khách, wine cabinet', 5, 6, 'tu_ruou_1.jpg', 'tu_ruou_2.jpg', '8900000', '2025-11-27 00:52:15', 'true'),
(25, 'Đèn chùm pha lê quý tộc', 'Đèn chùm pha lê K9 cao cấp, tán sắc 7 màu rực rỡ. Khung đèn hợp kim mạ vàng 24K, mang lại vẻ đẹp vương giả cho phòng khách.', 'đèn chùm, pha lê, crystal, luxury', 6, 6, 'den_chum_1.jpg', 'den_chum_2.jpg', '7600000', '2025-11-27 00:52:15', 'true'),
(26, 'Đèn thả trần hình học', 'Đèn thả trần khung sắt tạo hình khối đa diện độc đáo. Phong cách Industrial cá tính, phù hợp không gian quán cafe hoặc bàn ăn.', 'đèn thả, industrial, decor', 6, 2, 'den_tha_1.jpg', 'den_tha_2.jpg', '1200000', '2025-11-27 00:52:15', 'true'),
(27, 'Đèn cây đứng đọc sách', 'Đèn sàn thân kim loại uốn cong linh hoạt, chao đèn vải bố tản sáng dịu nhẹ. Tích hợp công tắc điều chỉnh độ sáng tiện lợi.', 'đèn cây, đèn đứng, reading lamp, floor lamp', 6, 1, 'den_cay_1.jpg', 'den_cay_2.jpg', '1800000', '2025-11-27 00:52:15', 'true'),
(28, 'Đèn ngủ để bàn gốm sứ', 'Đèn ngủ thân gốm sứ tráng men thủ công họa tiết hoa sen. Chao đèn vải lụa xuyên sáng tốt, tạo không gian ấm cúng, thư giãn.', 'đèn ngủ, đèn bàn, table lamp, ceramic', 6, 3, 'den_ngu_1.jpg', 'den_ngu_2.jpg', '950000', '2025-11-27 00:52:15', 'true');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_orders`
--

CREATE TABLE `user_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount_due` int(255) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `total_products` int(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_orders`
--

INSERT INTO `user_orders` (`order_id`, `user_id`, `amount_due`, `invoice_number`, `total_products`, `order_date`, `order_status`) VALUES
(1, 3, 16890000, 168268248, 2, '2024-08-28 07:56:05', 'Hoàn thành'),
(2, 3, 15980000, 2089979650, 2, '2024-08-28 13:39:28', 'Hoàn thành'),
(3, 5, 950000, 117406171, 1, '2025-11-27 01:15:33', 'pending');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_payments`
--

CREATE TABLE `user_payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_payments`
--

INSERT INTO `user_payments` (`payment_id`, `order_id`, `invoice_number`, `amount`, `payment_mode`, `date`) VALUES
(5, 1, 168268248, 16890000, 'Tiền mặt', '2024-08-28 07:56:05'),
(6, 2, 2089979650, 15980000, 'Tiền mặt', '2024-08-28 13:39:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_mobile` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_table`
--

INSERT INTO `user_table` (`user_id`, `username`, `user_email`, `user_password`, `user_image`, `user_ip`, `user_address`, `user_mobile`) VALUES
(3, 'Minh', 'minh@go.com', '$2y$10$9IMRSGMb.nZojM7tsx8ZIefQI40HOflek5ilAiWhFZYB8eETXRn92', '11.jpg', '::1', 'brvt', '1234511'),
(4, 'Long', 'long@gmail.com', '$2y$10$7Pe0CfbWAZK4rDW9AD3dTOCs86UJgoZP3TCdXY/3WHrPLX8spMggm', '11.jpg', '::1', 'hcm', '11323213'),
(5, 'levantruyen', 'levantruyen23022004@gmail.com', '$2y$10$jWWMd0mzrYKFVUtQ2NkZnuZppob8hqTX4blOZLb6XdcYs.1GkPBqu', 'default_avatar.png', '::1', '325 ht13', '0869168312');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Chỉ mục cho bảng `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `customer_orders`
--
ALTER TABLE `customer_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `orders_pending`
--
ALTER TABLE `orders_pending`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `user_payments`
--
ALTER TABLE `user_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Chỉ mục cho bảng `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `customer_orders`
--
ALTER TABLE `customer_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `orders_pending`
--
ALTER TABLE `orders_pending`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `user_payments`
--
ALTER TABLE `user_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
