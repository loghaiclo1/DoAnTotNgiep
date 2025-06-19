-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 18, 2025 lúc 10:11 PM
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
-- Cơ sở dữ liệu: `bookshop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `administrative_regions`
--

CREATE TABLE `administrative_regions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `code_name` varchar(255) DEFAULT NULL,
  `code_name_en` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `administrative_regions`
--

INSERT INTO `administrative_regions` (`id`, `name`, `name_en`, `code_name`, `code_name_en`) VALUES
(1, 'Đông Bắc Bộ', 'Northeast', 'dong_bac_bo', 'northest'),
(2, 'Tây Bắc Bộ', 'Northwest', 'tay_bac_bo', 'northwest'),
(3, 'Đồng bằng sông Hồng', 'Red River Delta', 'dong_bang_song_hong', 'red_river_delta'),
(4, 'Bắc Trung Bộ', 'North Central Coast', 'bac_trung_bo', 'north_central_coast'),
(5, 'Duyên hải Nam Trung Bộ', 'South Central Coast', 'duyen_hai_nam_trung_bo', 'south_central_coast'),
(6, 'Tây Nguyên', 'Central Highlands', 'tay_nguyen', 'central_highlands'),
(7, 'Đông Nam Bộ', 'Southeast', 'dong_nam_bo', 'southeast'),
(8, 'Đồng bằng sông Cửu Long', 'Mekong River Delta', 'dong_bang_song_cuu_long', 'southwest');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `administrative_units`
--

CREATE TABLE `administrative_units` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `full_name_en` varchar(255) DEFAULT NULL,
  `short_name` varchar(255) DEFAULT NULL,
  `short_name_en` varchar(255) DEFAULT NULL,
  `code_name` varchar(255) DEFAULT NULL,
  `code_name_en` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `administrative_units`
--

INSERT INTO `administrative_units` (`id`, `full_name`, `full_name_en`, `short_name`, `short_name_en`, `code_name`, `code_name_en`) VALUES
(1, 'Thành phố trực thuộc trung ương', 'Municipality', 'Thành phố', 'City', 'thanh_pho_truc_thuoc_trung_uong', 'municipality'),
(2, 'Tỉnh', 'Province', 'Tỉnh', 'Province', 'tinh', 'province'),
(3, 'Thành phố thuộc thành phố trực thuộc trung ương', 'Municipal city', 'Thành phố', 'City', 'thanh_pho_thuoc_thanh_pho_truc_thuoc_trung_uong', 'municipal_city'),
(4, 'Thành phố thuộc tỉnh', 'Provincial city', 'Thành phố', 'City', 'thanh_pho_thuoc_tinh', 'provincial_city'),
(5, 'Quận', 'Urban district', 'Quận', 'District', 'quan', 'urban_district'),
(6, 'Thị xã', 'District-level town', 'Thị xã', 'Town', 'thi_xa', 'district_level_town'),
(7, 'Huyện', 'District', 'Huyện', 'District', 'huyen', 'district'),
(8, 'Phường', 'Ward', 'Phường', 'Ward', 'phuong', 'ward'),
(9, 'Thị trấn', 'Commune-level town', 'Thị trấn', 'Township', 'thi_tran', 'commune_level_town'),
(10, 'Xã', 'Commune', 'Xã', 'Commune', 'xa', 'commune');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baiviet`
--

CREATE TABLE `baiviet` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tieude` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `noidung` varchar(1000) NOT NULL,
  `anhbaiviet` varchar(255) NOT NULL,
  `trangthai` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `chude` varchar(255) DEFAULT NULL,
  `nguoi_dang` varchar(255) DEFAULT NULL,
  `luot_xem` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `baiviet`
--

INSERT INTO `baiviet` (`id`, `tieude`, `slug`, `noidung`, `anhbaiviet`, `trangthai`, `created_at`, `updated_at`, `chude`, `nguoi_dang`, `luot_xem`) VALUES
(2, 'Review Sách tranh tô màu: Góc Nhỏ Có Nắng – mảnh ghép bình yên cho tâm hồn sau những mỏi mệt của cuộc sống', 'review-sach-tranh-to-mau-goc-nho-co-nang', 'Cuốn sách tranh tô màu “Góc Nhỏ Có Nắng” không chỉ là một cuốn sách tô màu thông thường mà còn là một tác phẩm giúp người đọc tìm thấy sự bình yên trong những khoảnh khắc giản dị của cuộc sống. Được thiết kế với bìa mềm, sách tranh tô màu này mang đến một', 'goc-nho-co-nang.jpg', 1, '2024-12-22 10:00:00', '2024-12-22 10:00:00', 'Sách hay', NULL, 0),
(4, 'Review sách “Đắc Nhân Tâm”: Những nguyên tắc vàng để xây dựng mối quan hệ vững chắc', 'review-sach-dac-nhan-tam-nhung-nguyen-tac-vang-de-xay-dung-moi-quan-he-vung-chac', 'Đắc Nhân Tâm (tên gốc: How to Win Friends and Influence People) là một trong những cuốn sách kinh điển về nghệ thuật giao tiếp và xây dựng mối quan hệ của tác giả Dale Carnegie.\r\n\r\nĐược xuất bản lần đầu tiên vào năm 1936, cuốn sách đã nhanh chóng trở thàn', 'dac-nhan-tam.jpg', 1, '2025-01-01 09:07:09', '2025-01-02 09:07:09', 'Sách hay', NULL, 0),
(5, 'Review sách “Người Đàn Ông Mang Tên Ove” –  câu chuyện cảm động về tình yêu và sự thấu hiểu', 'review-sach-nguoi-dan-ong-mang-ten-ove-cau-chuyen-cam-dong-ve-tinh-yeu-va-su-thau-hieu', 'Cuốn sách “Người Đàn Ông Mang Tên Ove” của tác giả Fredrik Backman kể về Ove người đàn ông già nua, khó tính cộc cằn và không còn niềm vui nào trong cuộc sống. Sự xuất hiện của những người hàng xóm mới, cùng những sự kiện bất ngờ, dần dần khiến Ove thay đ', 'ove.jpg', 1, '2025-01-03 09:07:57', '2025-01-07 09:07:57', 'Sách hay', NULL, 0),
(6, 'Cô đơn là môn học bắt buộc của cuộc đời, những trích đoạn chiêm nghiệm về sự trưởng thành qua sách “Trong cô đơn bất ngờ gặp phiên bản tốt hơn của chính mình”', 'co-don-la-mon-hoc-bat-buoc-cua-cuoc-doi-nhung-trich-doan-chiem-nghiem-ve-su-truong-thanh-qua-sach-trong-co-don-bat-ngo-gap-phien-ban-tot-hon-cua-chinh-minh', '“Trong Cô Đơn Bất Ngờ Gặp Phiên Bản Tốt Hơn Của Chính Mình” là một tác phẩm đầy cảm xúc của Tả Tiểu Kỳ, một nhà thơ và nhà văn trẻ thuộc thế hệ 9x đến từ Trung Quốc. Cuốn sách chạm đến một khía cạnh sâu kín trong tâm hồn mỗi người, đặc biệt là những người', 'co-don.jpg', 1, '2025-01-02 09:08:09', '2025-01-06 09:08:09', 'Sách hay', NULL, 0),
(7, 'Bé vui chơi – Mẹ an tâm: Gợi ý đồ chơi cho bé tha hồ sáng tạo', 'be-vui-choi-me-an-tam-goi-y-do-choi-cho-be-tha-ho-sang-tao', 'Bé 0-12 tháng tuổi\r\nDành cho những nhóc 0-12 tháng tuổi, có một loạt đồ chơi hấp dẫn và phát triển, giúp bé khám phá thế giới xung quanh một cách an toàn và thú vị:\r\n\r\nBập bênh: Một chiếc bập bênh mềm mại với màu sắc sáng và âm thanh nhẹ nhàng sẽ là một đ', 'me-va-be.jpg', 1, '2025-01-01 09:08:22', '2025-01-05 09:08:22', 'Sách thiếu nhi', NULL, 0),
(8, 'Bí Quyết Giúp Bé Phát Triển Toàn Diện Nhờ Các Món Đồ Chơi Thông Minh', 'bi-quyet-giup-be-phat-trien-toan-dien-nho-cac-mon-do-choi-thong-minh', '1. Bộ bảng chữ cái tương tác\r\nBộ bảng chữ cái tương tác là món đồ chơi giáo dục hiện đại, tích hợp nhiều tính năng giúp bé học chữ một cách thú vị và hiệu quả. Bảng chữ cái được thiết kế với các chữ cái đầy màu sắc, âm thanh vui tai và các trò chơi tương ', 'bo-sach-thieu-nhi.jpg', 1, '2025-01-06 09:08:43', '2025-01-08 09:08:43', 'Sách thiếu nhi', NULL, 0),
(9, 'Các món đồ chơi phù hợp cho bé gái từ 1 đến 3 tuổi', 'cac-mon-do-choi-phu-hop-cho-be-gai-tu-1-den-3-tuoi', 'Đồ chơi búp bê\r\nBúp bê luôn là một trong những món đồ chơi yêu thích của bé gái. Từ những con búp bê vải mềm mại đến những búp bê nhựa có thể cử động tay chân, mỗi loại búp bê đều mang lại niềm vui và sự thú vị riêng cho trẻ. Búp bê không chỉ là người bạn', 'do-choi-tre-em.jpg', 1, '2025-01-06 09:08:59', '2025-01-07 09:08:59', 'Sách thiếu nhi', NULL, 0),
(11, 'Truyện Kiều của Nguyễn Du: Một tác phẩm văn học kinh điển của Việt Nam', 'truyen-kieu-nguyen-du', 'Truyện Kiều của Nguyễn Du là một tác phẩm nổi bật trong nền văn học cổ điển Việt Nam, được viết bằng thể thơ lục bát, kể về cuộc đời đầy bi thương của nàng Kiều. Tác phẩm không chỉ phản ánh được xã hội phong kiến mà còn gửi gắm nhiều giá trị nhân văn sâu ', 'image1.jpg', 1, '2025-01-09 08:59:02', '2025-01-09 08:59:02', 'VĂN HỌC CỔ ĐIỂN', NULL, 0),
(12, 'Chinh Phục Con Đường Văn Học Cổ Điển: Những Tác Phẩm Để Đời', 'chinh-phuc-con-duong-van-hoc-co-dien', 'Văn học cổ điển không chỉ là một phần di sản văn hóa mà còn là cầu nối giữa quá khứ và hiện tại, giúp chúng ta hiểu thêm về những giá trị nhân văn trong xã hội phong kiến. Từ những bài thơ của Hồ Xuân Hương cho đến các tác phẩm nổi bật của Phan Bội Châu, ', 'image2.jpg', 1, '2025-01-09 08:59:02', '2025-01-09 08:59:02', 'VĂN HỌC CỔ ĐIỂN', NULL, 0),
(13, 'Văn Học Cổ Điển Việt Nam: Những Tác Phẩm Gắn Liền Với Thời Gian', 'van-hoc-co-dien-viet-nam-tac-pham', 'Văn học cổ điển Việt Nam không chỉ là những tác phẩm văn học nổi tiếng mà còn là nền tảng vững chắc cho sự phát triển của nền văn học dân tộc. Từ những bài thơ lục bát của Nguyễn Du, Hồ Xuân Hương cho đến các tác phẩm văn xuôi của Phan Bội Châu, văn học c', 'image3.jpg', 1, '2025-01-09 08:59:02', '2025-01-09 08:59:02', 'VĂN HỌC CỔ ĐIỂN', NULL, 0),
(14, 'Sự Giao Thoa Giữa Văn Học Cổ Điển Và Hiện Đại Trong Văn Học Việt Nam', 'giao-thoa-van-hoc-co-dien-hien-dai', 'Văn học Việt Nam qua các thời kỳ luôn có sự giao thoa giữa các giá trị cổ điển và hiện đại. Từ những tác phẩm văn học cổ điển như Truyện Kiều của Nguyễn Du đến các tác phẩm văn học hiện đại như của Nguyễn Minh Châu, chúng ta có thể thấy rõ sự thay đổi tro', 'image4.jpg', 1, '2025-01-09 08:59:02', '2025-01-09 08:59:02', 'VĂN HỌC CỔ ĐIỂN', NULL, 0),
(15, 'Văn Học Cổ Điển Và Những Giá Trị Vĩnh Cửu Của Văn Minh Nhân Loại', 'van-hoc-co-dien-gia-tri-vinh-cuu', 'Văn học cổ điển không chỉ là những tác phẩm nghệ thuật mà còn là một phần của di sản văn hóa nhân loại. Những tác phẩm này đã truyền lại những giá trị đạo đức, nhân văn qua nhiều thế kỷ và vẫn còn nguyên giá trị cho đến ngày nay. Từ những tác phẩm của các', 'image5.jpg', 1, '2025-01-09 08:59:02', '2025-01-09 08:59:02', 'VĂN HỌC CỔ ĐIỂN', NULL, 0),
(16, 'Văn Học Hiện Đại Việt Nam: Những Tác Phẩm Gây Chấn Động', 'van-hoc-hien-dai-viet-nam', 'Văn học hiện đại Việt Nam đã phát triển mạnh mẽ trong suốt những thập kỷ qua, với những tác phẩm không chỉ phản ánh hiện thực xã hội mà còn khắc họa những khía cạnh sâu sắc của tâm lý con người. Các tác giả đương đại như Nguyễn Minh Châu, Bảo Ninh, Dương ', 'image6.jpg', 1, '2025-01-09 08:59:02', '2025-01-09 08:59:02', 'VĂN HỌC HIỆN ĐẠI', NULL, 0),
(17, 'Bước Chuyển Mình Của Văn Học Hiện Đại Việt Nam', 'buoc-chuyen-minh-van-hoc-hien-dai', 'Văn học hiện đại Việt Nam là sự phản ánh những thay đổi trong xã hội Việt Nam sau những biến động lớn. Những tác phẩm của các tác giả đương đại không chỉ tập trung vào các chủ đề lịch sử, mà còn khai thác sâu vào những vấn đề hiện đại như mối quan hệ giữa', 'image7.jpg', 1, '2025-01-09 08:59:02', '2025-01-09 08:59:02', 'VĂN HỌC HIỆN ĐẠI', NULL, 0),
(18, 'Những Tác Phẩm Văn Học Hiện Đại Việt Nam Và Sự Phát Triển Của Nền Văn Học Đương Đại', 'nhung-tac-pham-van-hoc-hien-dai', 'Văn học hiện đại Việt Nam đã và đang có những bước phát triển mạnh mẽ. Từ các tác phẩm nổi bật như của Nguyễn Minh Châu đến Bảo Ninh, văn học hiện đại không chỉ phản ánh cuộc sống xã hội mà còn phản ánh sự chuyển mình của con người Việt Nam trong thời kỳ ', 'image8.jpg', 1, '2025-01-09 08:59:02', '2025-01-09 08:59:02', 'VĂN HỌC HIỆN ĐẠI', NULL, 0),
(19, 'Những Chân Trời Mới Của Văn Học Hiện Đại Việt Nam', 'chan-troi-moi-van-hoc-hien-dai', 'Văn học hiện đại Việt Nam có sự chuyển biến mạnh mẽ trong những năm qua, với những tác phẩm mang tính cách mạng về tư duy và nghệ thuật. Những tác phẩm này không chỉ phản ánh cuộc sống hiện thực mà còn mở ra những chân trời mới về tri thức, về cách sống v', 'image9.jpg', 1, '2025-01-09 08:59:02', '2025-01-09 08:59:02', 'VĂN HỌC HIỆN ĐẠI', NULL, 0),
(20, 'Chuyện Kể Của Những Con Vật Thông Minh', 'chuyen-ke-cua-nhung-con-vat-thong-minh', '“Chuyện Kể Của Những Con Vật Thông Minh” là một bộ sách thiếu nhi được viết với mục đích giáo dục trẻ em về các giá trị sống qua những câu chuyện đầy hấp dẫn và mang tính giáo dục cao. Bộ sách gồm những câu chuyện về những con vật thông minh, khéo léo và ', 'imagea.jpg', 1, '2025-01-09 09:00:42', '2025-01-09 09:00:42', 'Sách thiếu nhi', NULL, 0),
(21, 'Cuộc Phiêu Lưu Của Cô Bé Mạnh Mẽ', 'cuoc-phieu-luu-cua-co-be-manh-me', '“Cuộc Phiêu Lưu Của Cô Bé Mạnh Mẽ” là câu chuyện về một cô bé dũng cảm, luôn sẵn sàng đối mặt với những thử thách để bảo vệ gia đình và bạn bè của mình. Mặc dù còn nhỏ, cô bé này không bao giờ ngần ngại bước vào những cuộc phiêu lưu mới, vượt qua mọi khó ', 'imageb.jpg', 1, '2025-01-09 09:00:42', '2025-01-09 09:00:42', 'Sách thiếu nhi', NULL, 0),
(22, 'Những Người Bạn Đặc Biệt Của Bé', 'nhung-nguoi-ban-dac-biet-cua-be', '“Những Người Bạn Đặc Biệt Của Bé” là một câu chuyện về tình bạn chân thành giữa một cô bé và những người bạn đặc biệt của mình, bao gồm cả một con chó, một con mèo, và một con thỏ. Những người bạn này cùng nhau khám phá thế giới và học hỏi từ nhau rất nhi', 'imagec.jpg', 1, '2025-01-09 09:00:42', '2025-01-09 09:00:42', 'Sách thiếu nhi', NULL, 0),
(23, 'Tâm lý học là gì? Những khái niệm cơ bản về tâm lý con người', 'tam-ly-hoc-la-gi-nhung-khai-niem-co-ban-ve-tam-ly-con-nguoi', 'Tâm lý học là một ngành khoa học nghiên cứu về các yếu tố tác động đến hành vi và cảm xúc của con người. Ngành này không chỉ nghiên cứu những lý thuyết, mô hình và phương pháp nghiên cứu tâm lý mà còn khám phá những yếu tố ảnh hưởng đến tư duy, cảm xúc, h', 'image11.jpg', 1, '2025-01-09 09:34:08', '2025-01-09 09:34:08', 'Tâm lý học', NULL, 0),
(24, 'Các phương pháp nghiên cứu trong tâm lý học', 'cac-phuong-phap-nghien-cuu-trong-tam-ly-hoc', 'Trong tâm lý học, có rất nhiều phương pháp nghiên cứu được sử dụng để thu thập dữ liệu và phân tích hành vi của con người. Các phương pháp này có thể được chia thành ba nhóm chính: phương pháp quan sát, phương pháp thực nghiệm và phương pháp khảo sát. Phư', 'image12.jpg', 1, '2025-01-09 09:34:08', '2025-01-09 09:34:08', 'Tâm lý học', NULL, 0),
(25, 'Tâm lý học hành vi: Khám phá và ứng dụng', 'tam-ly-hoc-hanh-vi-kham-pha-va-ung-dung', 'Tâm lý học hành vi là một lĩnh vực nghiên cứu trong tâm lý học tập trung vào việc quan sát, phân tích và giải thích các hành vi của con người thông qua các yếu tố môi trường và tình huống xung quanh. Trường phái hành vi, do John B. Watson và B.F. Skinner ', 'image13.jpg', 1, '2025-01-09 09:34:08', '2025-01-09 09:34:08', 'Tâm lý học', NULL, 0),
(26, 'Tâm lý học phát triển: Sự thay đổi tâm lý theo từng giai đoạn', 'tam-ly-hoc-phat-trien-su-thay-doi-tam-ly-theo-tung-giai-doan', 'Tâm lý học phát triển là một nhánh của tâm lý học nghiên cứu sự thay đổi trong hành vi, tư duy và cảm xúc của con người qua các giai đoạn phát triển từ khi sinh ra đến khi trưởng thành. Mỗi giai đoạn phát triển đều có những đặc điểm và thách thức riêng bi', 'image14.jpg', 1, '2025-01-09 09:34:08', '2025-01-09 09:34:08', 'Tâm lý học', NULL, 0),
(27, 'Tâm lý học lâm sàng: Chẩn đoán và điều trị rối loạn tâm lý', 'tam-ly-hoc-lam-sang-chan-doan-va-dieu-tri-roi-loan-tam-ly', 'Tâm lý học lâm sàng là lĩnh vực nghiên cứu và ứng dụng trong việc chẩn đoán, điều trị và hỗ trợ những người gặp phải các vấn đề về tâm lý, từ các rối loạn tâm lý nhẹ như lo âu, trầm cảm đến các rối loạn nghiêm trọng như rối loạn tâm thần. Các chuyên gia t', 'image15.jpg', 1, '2025-01-09 09:34:08', '2025-01-09 09:34:08', 'Tâm lý học', NULL, 0),
(28, 'Demo', 'demo', 'Demo', 'demo.jpg', 1, '2024-12-31 21:53:49', '2025-01-10 10:38:34', 'Thông tin nhóm', NULL, 0),
(29, 'Khám phá vật lý lượng tử', 'kham-pha-vat-ly-luong-tu', 'Vật lý lượng tử là một trong những ngành khoa học hiện đại hấp dẫn nhất hiện nay. Nó nghiên cứu hành vi của các hạt cực nhỏ như electron và photon, nơi các định luật vật lý cổ điển không còn chính xác. Bài viết này sẽ giúp bạn hiểu những nguyên lý cơ bản như nguyên lý bất định Heisenberg, chồng chập lượng tử và rối lượng tử.', '1.jpg', 1, '2025-06-04 05:53:57', '2025-06-04 05:53:57', 'KHOA HỌC', NULL, 0),
(30, 'Hệ mặt trời và các hành tinh', 'he-mat-troi-va-cac-hanh-tinh', 'Hệ mặt trời bao gồm Mặt Trời và các hành tinh quay quanh nó như Trái Đất, Sao Hỏa, Sao Mộc và Sao Thổ. Mỗi hành tinh đều có những đặc điểm riêng biệt về khí hậu, địa hình và cấu tạo. Bài viết sẽ giúp bạn khám phá chi tiết từng hành tinh và vai trò của chúng trong vũ trụ bao la.', '2.jpg', 1, '2025-06-04 05:53:57', '2025-06-04 05:53:57', 'KHOA HỌC', NULL, 0),
(31, 'Sinh học tế bào cơ bản', 'sinh-hoc-te-bao-co-ban', 'Tế bào là đơn vị cơ bản của sự sống. Trong bài viết này, chúng ta sẽ tìm hiểu về cấu trúc của tế bào nhân thực và tế bào nhân sơ, cũng như các bào quan quan trọng như nhân, ty thể, ribosome và mạng lưới nội chất. Kiến thức này rất cần thiết cho học sinh trung học và những người yêu thích sinh học.', '3.jpg', 1, '2025-06-04 05:53:57', '2025-06-04 05:53:57', 'KHOA HỌC', NULL, 0),
(32, 'Khoa học và đời sống', 'khoa-hoc-va-doi-song', 'Khoa học không chỉ tồn tại trong phòng thí nghiệm mà còn ảnh hưởng sâu rộng đến đời sống hàng ngày của chúng ta. Từ điện thoại thông minh, y học hiện đại đến công nghệ nông nghiệp tiên tiến, bài viết sẽ cho bạn thấy ứng dụng thực tiễn của khoa học và lý do vì sao nên đầu tư vào giáo dục khoa học.', '4.jpg', 1, '2025-06-04 05:53:57', '2025-06-04 05:53:57', 'KHOA HỌC', NULL, 0),
(33, 'Phát minh vĩ đại làm thay đổi thế giới', 'phat-minh-thay-doi-the-gioi', 'Lịch sử nhân loại chứng kiến nhiều phát minh vĩ đại như bóng đèn, internet, máy bay và vaccine. Những phát minh này không chỉ giúp nâng cao chất lượng cuộc sống mà còn mở ra thời kỳ phát triển vượt bậc cho nhân loại. Cùng điểm qua một số phát minh đã tạo nên bước ngoặt lớn trong lịch sử.', '5.jpg', 1, '2025-06-04 05:53:57', '2025-06-04 05:53:57', 'KHOA HỌC', NULL, 0),
(34, 'Học tiếng Anh hiệu quả', 'hoc-tieng-anh-hieu-qua', 'Để học tiếng Anh hiệu quả, bạn cần có kế hoạch học rõ ràng và phù hợp với trình độ. Bài viết này sẽ hướng dẫn bạn cách lập kế hoạch học từ vựng, luyện nghe, nói và viết. Đồng thời chia sẻ mẹo học giúp duy trì động lực và ghi nhớ kiến thức lâu dài.', '6.jpg', 1, '2025-06-04 05:53:57', '2025-06-04 05:53:57', 'NGOẠI NGỮ', NULL, 0),
(35, 'Luyện phát âm chuẩn tiếng Anh', 'luyen-phat-am-chuan', 'Phát âm chuẩn là yếu tố quan trọng để giao tiếp tiếng Anh hiệu quả. Bài viết cung cấp các quy tắc phát âm phổ biến, cách sử dụng bảng phiên âm IPA và giới thiệu một số công cụ hỗ trợ luyện phát âm như ứng dụng di động, video luyện nói và bài tập thực hành.', '7.jpg', 1, '2025-06-04 05:53:57', '2025-06-04 05:53:57', 'NGOẠI NGỮ', NULL, 0),
(36, 'Từ vựng tiếng Anh theo chủ đề', 'tu-vung-tieng-anh-theo-chu-de', 'Học từ vựng theo chủ đề giúp người học ghi nhớ lâu hơn và dễ dàng áp dụng vào thực tế. Bài viết giới thiệu các nhóm từ vựng thông dụng như: gia đình, công việc, du lịch, và học tập, kèm theo ví dụ minh họa và bài tập thực hành để củng cố kiến thức.', '8.jpg', 1, '2025-06-04 05:53:57', '2025-06-04 05:53:57', 'NGOẠI NGỮ', NULL, 0),
(37, 'Giao tiếp tiếng Anh hàng ngày', 'giao-tiep-tieng-anh-hang-ngay', 'Giao tiếp tiếng Anh không chỉ là học từ vựng mà còn là sử dụng thành thạo các mẫu câu thông dụng. Bài viết cung cấp các đoạn hội thoại thực tế, mẹo diễn đạt tự nhiên và các lỗi phổ biến cần tránh trong giao tiếp hàng ngày.', '9.jpg', 1, '2025-06-04 05:53:57', '2025-06-04 05:53:57', 'NGOẠI NGỮ', NULL, 0),
(38, 'Ngữ pháp cơ bản cho người mới bắt đầu', 'ngu-phap-co-ban-cho-nguoi-moi', 'Ngữ pháp là nền tảng của mọi ngôn ngữ. Bài viết này giúp người mới bắt đầu làm quen với các thì cơ bản, cấu trúc câu, cách dùng danh từ, động từ, tính từ... Nội dung được trình bày dễ hiểu và kèm theo bài tập thực hành để kiểm tra kiến thức.', '10.jpg', 1, '2025-06-04 05:53:57', '2025-06-04 05:53:57', 'NGOẠI NGỮ', NULL, 0),
(39, 'Test sách hay 5', 'test-sach-hay-5', 'Nội dung test', 'default.jpg', 1, '2025-06-05 05:08:13', '2025-06-05 05:08:13', 'SÁCH HAY', NULL, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_holds`
--

CREATE TABLE `cart_holds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `book_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart_holds`
--

INSERT INTO `cart_holds` (`id`, `user_id`, `session_id`, `book_id`, `quantity`, `expires_at`, `created_at`, `updated_at`) VALUES
(265, NULL, 'bniISbI8H1AO6wQAOg7Wp2yhDwoOldJbT431K8bZ', 22, 8, '2025-06-12 09:32:38', '2025-06-12 09:17:38', '2025-06-12 09:17:38'),
(279, NULL, 'mSIbQ7mrLoSbPBshPQST95ZqHuZt1UrBKMMNmEnR', 6, 1, '2025-06-12 09:48:43', '2025-06-12 09:33:43', '2025-06-12 09:33:43'),
(280, NULL, 'mSIbQ7mrLoSbPBshPQST95ZqHuZt1UrBKMMNmEnR', 39, 1, '2025-06-12 09:48:45', '2025-06-12 09:33:45', '2025-06-12 09:33:45'),
(281, NULL, 'mSIbQ7mrLoSbPBshPQST95ZqHuZt1UrBKMMNmEnR', 10, 1, '2025-06-12 09:48:47', '2025-06-12 09:33:47', '2025-06-12 09:33:47'),
(283, NULL, 'Grccffi3gIJpTh7MIHdjIQQOxh3UYvVigKllfERi', 4, 1, '2025-06-12 09:49:35', '2025-06-12 09:34:35', '2025-06-12 09:34:35'),
(285, NULL, 'txmAQ8PSLLG5Bc5alDwxddLRkaaXsnuV4HH5aXwQ', 22, 1, '2025-06-12 09:51:24', '2025-06-12 09:36:24', '2025-06-12 09:36:24'),
(286, NULL, 'txmAQ8PSLLG5Bc5alDwxddLRkaaXsnuV4HH5aXwQ', 13, 1, '2025-06-12 09:51:25', '2025-06-12 09:36:25', '2025-06-12 09:36:25'),
(287, NULL, 'txmAQ8PSLLG5Bc5alDwxddLRkaaXsnuV4HH5aXwQ', 2, 1, '2025-06-12 09:51:26', '2025-06-12 09:36:26', '2025-06-12 09:36:26'),
(296, NULL, 'K6qhrxWBJuJyVFlPQuGNlSHKsDyhHzHPbim9J18y', 22, 1, '2025-06-12 09:53:08', '2025-06-12 09:38:08', '2025-06-12 09:38:08'),
(297, NULL, 'K6qhrxWBJuJyVFlPQuGNlSHKsDyhHzHPbim9J18y', 13, 1, '2025-06-12 09:53:09', '2025-06-12 09:38:09', '2025-06-12 09:38:09'),
(298, NULL, 'K6qhrxWBJuJyVFlPQuGNlSHKsDyhHzHPbim9J18y', 2, 1, '2025-06-12 09:53:10', '2025-06-12 09:38:10', '2025-06-12 09:38:10'),
(303, NULL, 'W3nd2vlP53ZR1B3hXu1j97YfnXNuJks7yzSzHiVk', 43, 1, '2025-06-12 09:53:38', '2025-06-12 09:38:38', '2025-06-12 09:38:38'),
(308, NULL, 'k6mga5ZUfUuUgFtBktvF6f0fsQQm7npIiSoxkBYz', 3, 1, '2025-06-12 09:55:12', '2025-06-12 09:40:12', '2025-06-12 09:40:12'),
(313, NULL, 'Cg3swNuH9QX2JuUvML35G6b8gHLfdpoR6kI7uetv', 39, 1, '2025-06-12 09:55:46', '2025-06-12 09:40:46', '2025-06-12 09:40:46'),
(314, NULL, 'Cg3swNuH9QX2JuUvML35G6b8gHLfdpoR6kI7uetv', 31, 1, '2025-06-12 09:55:48', '2025-06-12 09:40:48', '2025-06-12 09:40:48'),
(319, NULL, 'pChyl7bpei1OAIlh3Gd7rwnivLD3ItrdsW4fbYUe', 37, 1, '2025-06-12 09:58:16', '2025-06-12 09:43:16', '2025-06-12 09:43:16'),
(320, NULL, 'pChyl7bpei1OAIlh3Gd7rwnivLD3ItrdsW4fbYUe', 5, 1, '2025-06-12 09:58:17', '2025-06-12 09:43:17', '2025-06-12 09:43:17'),
(325, NULL, '9NSdCXhrUhIgmFsWhJKkKjjbgohB3AdA1TUmA9qW', 42, 1, '2025-06-12 09:59:40', '2025-06-12 09:44:40', '2025-06-12 09:44:40'),
(326, NULL, '9NSdCXhrUhIgmFsWhJKkKjjbgohB3AdA1TUmA9qW', 26, 1, '2025-06-12 09:59:48', '2025-06-12 09:44:48', '2025-06-12 09:44:48'),
(331, NULL, '6lt4Ix0XN77D8KfQvIzp7yOxc7JfxiOcalxsA6HR', 20, 1, '2025-06-12 10:00:21', '2025-06-12 09:45:21', '2025-06-12 09:45:21'),
(332, NULL, '6lt4Ix0XN77D8KfQvIzp7yOxc7JfxiOcalxsA6HR', 6, 1, '2025-06-12 10:00:22', '2025-06-12 09:45:22', '2025-06-12 09:45:22'),
(337, NULL, 'kuGfsXYEy7TDFWFG6htcKZGKR9pFyPWXgB0mkgzI', 19, 1, '2025-06-12 10:01:24', '2025-06-12 09:46:24', '2025-06-12 09:46:24'),
(338, NULL, 'kuGfsXYEy7TDFWFG6htcKZGKR9pFyPWXgB0mkgzI', 13, 1, '2025-06-12 10:01:25', '2025-06-12 09:46:25', '2025-06-12 09:46:25'),
(346, NULL, 'U9pGexAAAUvoIiJzWIbUnLWi1JAigUtQdoBtIcvB', 3, 1, '2025-06-12 10:06:45', '2025-06-12 09:51:45', '2025-06-12 09:51:45'),
(348, NULL, '2bMSDgIjAOMCIpnLAkvO7FeKJRG5wigfboD2zjcU', 9, 1, '2025-06-12 10:07:34', '2025-06-12 09:52:34', '2025-06-12 09:52:34'),
(349, NULL, '2bMSDgIjAOMCIpnLAkvO7FeKJRG5wigfboD2zjcU', 32, 1, '2025-06-12 10:07:35', '2025-06-12 09:52:35', '2025-06-12 09:52:35'),
(351, NULL, 'mq7OeRTerQCs54caaphFm2kvvbI40lcuda5I9yFF', 2, 1, '2025-06-12 10:08:11', '2025-06-12 09:53:11', '2025-06-12 09:53:11'),
(353, NULL, 'mq7OeRTerQCs54caaphFm2kvvbI40lcuda5I9yFF', 13, 1, '2025-06-12 10:08:13', '2025-06-12 09:53:13', '2025-06-12 09:53:13'),
(355, NULL, 'mR1kkgrOlpvZqXRW3m00KLhMLS7LrLU4FQ1m6qNq', 2, 1, '2025-06-12 10:12:21', '2025-06-12 09:57:21', '2025-06-12 09:57:21'),
(356, NULL, 'mR1kkgrOlpvZqXRW3m00KLhMLS7LrLU4FQ1m6qNq', 6, 1, '2025-06-12 10:12:22', '2025-06-12 09:57:22', '2025-06-12 09:57:22'),
(357, NULL, 'mR1kkgrOlpvZqXRW3m00KLhMLS7LrLU4FQ1m6qNq', 13, 1, '2025-06-12 10:12:23', '2025-06-12 09:57:23', '2025-06-12 09:57:23'),
(358, NULL, 'mR1kkgrOlpvZqXRW3m00KLhMLS7LrLU4FQ1m6qNq', 22, 1, '2025-06-12 10:12:24', '2025-06-12 09:57:24', '2025-06-12 09:57:24'),
(367, NULL, '6eINu2rzBrA1dsmqXmF4QtNT8VgYIGpv2AHBO8Ho', 19, 1, '2025-06-12 10:12:52', '2025-06-12 09:57:52', '2025-06-12 09:57:52'),
(374, NULL, 'E4CGqfi2FQi8bMU5ccmTRlOCNoT5DOzE3zyW9lkR', 9, 1, '2025-06-12 10:13:15', '2025-06-12 09:58:15', '2025-06-12 09:58:15'),
(375, NULL, 'E4CGqfi2FQi8bMU5ccmTRlOCNoT5DOzE3zyW9lkR', 4, 1, '2025-06-12 10:13:17', '2025-06-12 09:58:17', '2025-06-12 09:58:17'),
(385, NULL, 'dj4nlGTvxbQmBV7LfnNHG9DpP8nOjsOlODxfrmAX', 22, 8, '2025-06-12 10:32:31', '2025-06-12 10:17:31', '2025-06-12 10:17:31'),
(387, NULL, '26AcgVfrUFjqcLsBTeFpFnHBPiqtA1IvAZrXXGf8', 6, 1, '2025-06-12 10:33:55', '2025-06-12 10:18:55', '2025-06-12 10:18:55'),
(395, NULL, 'EtcJkusZjHOpbMUDe4Rqrav9p202tqC556UFJTL7', 22, 7, '2025-06-12 10:31:37', '2025-06-12 10:30:55', '2025-06-12 10:31:37'),
(396, NULL, '7TCE9q476krx0g1tDA1z0oQazoZoSGbRkQKlxXUa', 22, 1, '2025-06-12 10:31:09', '2025-06-12 10:31:09', '2025-06-12 10:31:09'),
(397, NULL, '7TCE9q476krx0g1tDA1z0oQazoZoSGbRkQKlxXUa', 2, 2, '2025-06-12 10:31:10', '2025-06-12 10:31:10', '2025-06-12 10:31:10'),
(398, NULL, '7TCE9q476krx0g1tDA1z0oQazoZoSGbRkQKlxXUa', 1, 1, '2025-06-12 10:31:12', '2025-06-12 10:31:12', '2025-06-12 10:31:12'),
(399, NULL, '7TCE9q476krx0g1tDA1z0oQazoZoSGbRkQKlxXUa', 8, 1, '2025-06-12 10:31:14', '2025-06-12 10:31:14', '2025-06-12 10:31:14'),
(433, NULL, 'PdN1nSolPIvMWY7zhO3PI77x9YzQDpQ27VKbF3Lp', 6, 1, '2025-06-12 10:39:16', '2025-06-12 10:39:16', '2025-06-12 10:39:16'),
(434, NULL, 'PdN1nSolPIvMWY7zhO3PI77x9YzQDpQ27VKbF3Lp', 43, 1, '2025-06-12 10:39:17', '2025-06-12 10:39:17', '2025-06-12 10:39:17'),
(439, NULL, 'mzrg3IrDXSVhYnzmsqdpKi5nc246VpN2yq4xWrM3', 22, 1, '2025-06-12 10:40:24', '2025-06-12 10:40:24', '2025-06-12 10:40:24'),
(440, NULL, 'mzrg3IrDXSVhYnzmsqdpKi5nc246VpN2yq4xWrM3', 2, 1, '2025-06-12 10:40:24', '2025-06-12 10:40:24', '2025-06-12 10:40:24'),
(441, NULL, 'mzrg3IrDXSVhYnzmsqdpKi5nc246VpN2yq4xWrM3', 4, 1, '2025-06-12 10:40:26', '2025-06-12 10:40:26', '2025-06-12 10:40:26'),
(442, 1, 'A6VO64iYBTJYE1ePRrU9E05u8K8ikgsFqQ9uUhLn', 22, 1, '2025-06-12 10:40:37', '2025-06-12 10:40:33', '2025-06-12 10:40:37'),
(444, 1, 'A6VO64iYBTJYE1ePRrU9E05u8K8ikgsFqQ9uUhLn', 4, 1, '2025-06-12 10:40:37', '2025-06-12 10:40:33', '2025-06-12 10:40:37'),
(445, 1, 'IyPq4s2d2jWIslacDdButeTJAUQCajEBpjczKcHF', 22, 5, '2025-06-12 10:42:44', '2025-06-12 10:40:41', '2025-06-12 10:42:44'),
(447, 1, 'IyPq4s2d2jWIslacDdButeTJAUQCajEBpjczKcHF', 4, 4, '2025-06-12 10:42:44', '2025-06-12 10:40:41', '2025-06-12 10:42:44'),
(448, 1, 'm6Y8kssm13iUWIz2WJTYcgJjYlduCBPQGqQtcono', 22, 2, '2025-06-12 10:40:53', '2025-06-12 10:40:51', '2025-06-12 10:40:53'),
(450, 1, 'm6Y8kssm13iUWIz2WJTYcgJjYlduCBPQGqQtcono', 4, 2, '2025-06-12 10:40:53', '2025-06-12 10:40:51', '2025-06-12 10:40:53'),
(451, 1, 'WgQiijFKwkMyVrPKP7vwRo1SOhKMDGRFuhXhDVEb', 22, 5, '2025-06-12 10:41:35', '2025-06-12 10:41:06', '2025-06-12 10:41:35'),
(453, 1, 'WgQiijFKwkMyVrPKP7vwRo1SOhKMDGRFuhXhDVEb', 4, 5, '2025-06-12 10:41:35', '2025-06-12 10:41:06', '2025-06-12 10:41:35'),
(454, 1, 'SmBxAsVO5ekD8yw6QDFE4JNrr1xwAx6eBK2ACZ3Z', 22, 5, '2025-06-12 10:41:48', '2025-06-12 10:41:48', '2025-06-12 10:41:48'),
(456, 1, 'SmBxAsVO5ekD8yw6QDFE4JNrr1xwAx6eBK2ACZ3Z', 4, 5, '2025-06-12 10:41:48', '2025-06-12 10:41:48', '2025-06-12 10:41:48'),
(457, NULL, 'rz0ec2w5N1C4zRqveB8PxYbRPyJIJ3EodpVtKXXK', 14, 1, '2025-06-12 10:41:56', '2025-06-12 10:41:56', '2025-06-12 10:41:56'),
(458, NULL, 'rz0ec2w5N1C4zRqveB8PxYbRPyJIJ3EodpVtKXXK', 16, 1, '2025-06-12 10:41:57', '2025-06-12 10:41:57', '2025-06-12 10:41:57'),
(459, 1, 'VoQF3XYbjE9ROTkn1ph8eaSjWeET7CCbhOhJIKuO', 14, 1, '2025-06-12 10:42:20', '2025-06-12 10:42:02', '2025-06-12 10:42:20'),
(461, 1, 'VoQF3XYbjE9ROTkn1ph8eaSjWeET7CCbhOhJIKuO', 22, 5, '2025-06-12 10:42:20', '2025-06-12 10:42:06', '2025-06-12 10:42:20'),
(463, 1, 'VoQF3XYbjE9ROTkn1ph8eaSjWeET7CCbhOhJIKuO', 4, 4, '2025-06-12 10:42:20', '2025-06-12 10:42:06', '2025-06-12 10:42:20'),
(464, 1, 'IyPq4s2d2jWIslacDdButeTJAUQCajEBpjczKcHF', 14, 1, '2025-06-12 10:42:44', '2025-06-12 10:42:27', '2025-06-12 10:42:44'),
(466, 3, 'ILGP43xiBDd5qFLo4dDN5hS9HJOvmm9nuNiGLgQy', 35, 5, '2025-06-12 18:00:51', '2025-06-12 18:00:32', '2025-06-12 18:00:51'),
(467, NULL, 'q7k8etZLf1Z56zOLAyj9tnngDHXuByjuaQ1AlTg6', 12, 1, '2025-06-18 17:55:17', '2025-06-18 17:55:17', '2025-06-18 17:55:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietgiohang`
--

CREATE TABLE `chitietgiohang` (
  `MaChiTietGioHang` bigint(20) NOT NULL,
  `MaGioHang` bigint(20) NOT NULL,
  `MaKhachHang` bigint(20) NOT NULL,
  `MaSach` bigint(20) DEFAULT NULL,
  `TrangThai` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietgiohang`
--

INSERT INTO `chitietgiohang` (`MaChiTietGioHang`, `MaGioHang`, `MaKhachHang`, `MaSach`, `TrangThai`) VALUES
(1, 1, 1, 5, 1),
(2, 1, 1, 4, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `MaChiTietHoaDon` bigint(20) NOT NULL,
  `MaHoaDon` bigint(20) DEFAULT NULL,
  `MaSach` bigint(20) DEFAULT NULL,
  `SoLuong` int(11) DEFAULT NULL,
  `DonGia` decimal(15,2) DEFAULT NULL,
  `TongTien` decimal(15,2) GENERATED ALWAYS AS (`SoLuong` * `DonGia`) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`MaChiTietHoaDon`, `MaHoaDon`, `MaSach`, `SoLuong`, `DonGia`) VALUES
(1, 5, 7, 1, 300000.00),
(2, 5, 8, 1, 30000.00),
(3, 6, 9, 1, 300000.00),
(4, 7, 1, 1, 117000.00),
(5, 8, 9, 1, 30000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhgiasanpham`
--

CREATE TABLE `danhgiasanpham` (
  `MaDanhGia` bigint(20) UNSIGNED NOT NULL,
  `MaHoaDon` bigint(20) NOT NULL,
  `MaKhachHang` bigint(20) NOT NULL,
  `MaSach` bigint(20) NOT NULL,
  `NoiDung` text DEFAULT NULL,
  `SoSao` int(10) NOT NULL,
  `NgayDanhGia` datetime DEFAULT NULL,
  `TrangThai` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`id`, `name`, `parent_id`, `created_at`, `updated_at`, `slug`, `image`) VALUES
(1, 'Việt Nam', NULL, '2025-06-10 18:40:15', NULL, NULL, NULL),
(2, 'Quốc Tế', NULL, '2025-06-10 20:05:54', NULL, NULL, NULL),
(3, 'Sách Kinh Tế', 1, '2025-06-10 20:05:54', NULL, 'sach-kinh-te', 'sach-kinh-te.jpg'),
(4, 'Sách Văn Học Trong Nước', 1, '2025-06-10 20:05:54', NULL, 'sach-van-hoc-trong-nuoc', 'sach-van-hoc-trong-nuoc.jpg'),
(5, 'Sách Thưởng Thức Đời Sống', 1, '2025-06-10 20:05:54', NULL, 'sach-thuong-thuc-doi-song', 'sach-thuong-thuc-doi-song.jpg'),
(6, 'Sách Thiếu Nhi', 1, '2025-06-10 20:05:54', NULL, 'sach-thieu-nhi', 'sach-thieu-nhi.jpg'),
(7, 'Sách Phát Triển Bản Thân', 2, '2025-06-10 20:05:54', NULL, 'sach-phat-trien-ban-than', 'sach-phat-trien-ban-than.jpg'),
(8, 'Sách Học Làm Người', 2, '2025-06-10 20:05:54', NULL, 'sach-hoc-lam-nguoi', 'sach-hoc-lam-nguoi.jpg'),
(9, 'Danh Nhân', 2, '2025-06-10 20:05:54', NULL, 'danh-nhan', 'sach-danh-nhan.jpg'),
(10, 'Tâm Lý - Kỹ Năng Sống', 2, '2025-06-10 20:05:54', NULL, 'tam-ly-ky-nang-song', 'sach-tam-ly-ky-nang-song.jpg'),
(11, 'Sách Tin Học Ngoại Ngữ', 2, '2025-06-10 20:05:54', NULL, 'sach-tin-hoc-ngoai-ngu', 'sach-tin-hoc-ngoai-ngu.jpg'),
(12, 'Sách Chuyên Ngành', 2, '2025-06-10 20:05:54', NULL, 'sach-chuyen-nganh', 'sach-chuyen-nganh.jpg'),
(13, 'Sách Giáo Khoa - Giáo Trinh', 2, '2025-06-10 20:05:54', NULL, 'sach-giao-khoa-giao-trinh', 'sach-gk-gt.jpg'),
(14, 'Ngoại Thương', 3, '2025-06-10 13:05:54', NULL, 'ngoai-thuong', NULL),
(15, 'Marketing - Bán Hàng', 3, '2025-06-10 13:05:54', NULL, 'marketing-ban-hang', NULL),
(16, 'Nhân Sự & Việc Làm', 3, '2025-06-10 13:05:54', NULL, 'nhan-su-va-viec-lam', NULL),
(17, 'Nhân Vật & Bài Học Kinh Doanh', 3, '2025-06-10 13:05:54', NULL, 'nhan-vat-va-bai-hoc-kinh-doanh', NULL),
(18, 'Phân Tích & Môi Trường Kinh Tế', 3, '2025-06-10 13:05:54', NULL, 'phan-tich-va-moi-truong-kinh-te', NULL),
(19, 'Quản Trị - Lãnh Đạo', 3, '2025-06-10 13:05:54', NULL, 'quan-tri-lanh-dao', NULL),
(20, 'Tài Chính & Tiền Tệ', 3, '2025-06-10 13:05:54', NULL, 'tai-chinh-va-tien-te', NULL),
(21, 'Tài Chính – Kế Toán', 3, '2025-06-10 13:05:54', NULL, 'tai-chinh-ke-toan', NULL),
(22, 'Văn Bản Luật', 3, '2025-06-10 13:05:54', NULL, 'van-ban-luat', NULL),
(23, 'Khởi Nghiệp/Kỹ Năng Làm Việc', 3, '2025-06-10 13:05:54', NULL, 'khoi-nghiep-ky-nang-lam-viec', NULL),
(24, 'Nhân Vật Văn Học/Nhân Vật Lịch Sử', 4, '2025-06-10 13:05:54', NULL, 'nhan-vat-van-hoc-nhan-vat-lich-su', NULL),
(25, 'Phê Bình Văn Học', 4, '2025-06-10 13:05:54', NULL, 'phe-binh-van-hoc', NULL),
(26, 'Phóng Sự, Ký Sự', 4, '2025-06-10 13:05:54', NULL, 'phong-su-ky-su', NULL),
(27, 'Thơ Ca', 4, '2025-06-10 13:05:54', NULL, 'tho-ca', NULL),
(28, 'Tiểu Thuyết', 4, '2025-06-10 13:05:54', NULL, 'tieu-thuyet', NULL),
(29, 'Tiểu Thuyết Lịch Sử', 4, '2025-06-10 13:05:54', NULL, 'tieu-thuyet-lich-su', NULL),
(30, 'Truyện & Thơ Ca Dân Gian', 4, '2025-06-10 13:05:54', NULL, 'truyen-tho-ca-dan-gian', NULL),
(31, 'Truyện Dài', 4, '2025-06-10 13:05:54', NULL, 'truyen-dai', NULL),
(32, 'Truyện Giả Tưởng – Thần Bí', 4, '2025-06-10 13:05:54', NULL, 'truyen-gia-tuong-than-bi', NULL),
(33, 'Truyện Kiếm Hiệp', 4, '2025-06-10 13:05:54', NULL, 'truyen-kiem-hiep', NULL),
(34, 'Truyện Ngắn – Tản Văn', 4, '2025-06-10 13:05:54', NULL, 'truyen-ngan-tan-van', NULL),
(35, 'Truyện Thiếu Nhi', 4, '2025-06-10 13:05:54', NULL, 'truyen-thieu-nhi', NULL),
(36, 'Truyện Trinh Thám, Vụ Án', 4, '2025-06-10 13:05:54', NULL, 'truyen-trinh-tham-vu-an', NULL),
(37, 'Tự Truyện - Hồi Ký', 4, '2025-06-10 13:05:54', NULL, 'tu-truyen-hoi-ky', NULL),
(38, 'Bí Quyết Làm Đẹp', 5, '2025-06-10 13:05:54', NULL, 'bi-quyet-lam-dep', NULL),
(39, 'Gia Đình, Nuôi Dạy Con', 5, '2025-06-10 13:05:54', NULL, 'gia-dinh-nuoi-day-con', NULL),
(40, 'Nhà Ở, Vật Nuôi', 5, '2025-06-10 13:05:54', NULL, 'nha-o-vat-nuoi', NULL),
(41, 'Sách Tâm Lý - Giới Tính', 5, '2025-06-10 13:05:54', NULL, 'sach-tam-ly-gioi-tinh', NULL),
(42, 'Nữ Công Gia Chánh', 5, '2025-06-10 13:05:54', NULL, 'nu-cong-gia-chanh', NULL),
(43, 'Khoa Học Tự Nhiên', 6, '2025-06-10 13:05:54', '2025-06-10 12:00:56', 'khoa-hoc-tu-nhien', NULL),
(44, 'Khoa Học Xã Hội', 6, '2025-06-10 13:05:54', '2025-06-10 12:00:56', 'khoa-hoc-xa-hoi', NULL),
(45, 'Mỹ Thuật, Âm Nhạc', 6, '2025-06-10 13:05:54', '2025-06-10 12:00:56', 'my-thuat-am-nhac', NULL),
(46, 'Sách Ngoại Ngữ', 6, '2025-06-10 13:05:54', '2025-06-10 12:00:56', 'sach-ngoai-ngu', NULL),
(47, 'Truyện Tranh', 6, '2025-06-10 13:05:54', '2025-06-10 12:00:56', 'truyen-tranh', NULL),
(48, 'Sách Học Làm Người 2', 7, '2025-06-10 13:05:54', NULL, 'sach-hoc-lam-nguoi-2', NULL),
(49, 'Danh Nhân', 7, '2025-06-10 13:05:54', NULL, 'danh-nhan', NULL),
(50, 'Tâm Lý - Kỹ Năng Sống', 7, '2025-06-10 13:05:54', NULL, 'tam-ly-ky-nang-song', NULL),
(51, 'Sách Ngoại Ngữ', 8, '2025-06-10 13:05:54', NULL, 'sach-ngoai-ngu', NULL),
(52, 'Từ Điển', 8, '2025-06-10 13:05:54', NULL, 'tu-dien', NULL),
(53, 'Tin Học', 8, '2025-06-10 13:05:54', NULL, 'tin-hoc', NULL),
(54, 'Âm Nhạc', 8, '2025-06-10 13:05:54', NULL, 'am-nhac', NULL),
(55, 'Chính Trị, Triết Học', 9, '2025-06-10 13:05:54', NULL, 'chinh-tri-triet-hoc', NULL),
(56, 'Du Lịch', 9, '2025-06-10 13:05:54', NULL, 'du-lich', NULL),
(57, 'Khoa Học Cơ Bản', 9, '2025-06-10 13:05:54', NULL, 'khoa-hoc-co-ban', NULL),
(58, 'Khoa Học Kỹ Thuật', 9, '2025-06-10 13:05:54', NULL, 'khoa-hoc-ky-thuat', NULL),
(59, 'Khoa Học Tự Nhiên - Xã Hội', 10, '2025-06-10 13:05:54', NULL, 'khoa-hoc-tu-nhien-xa-hoi', NULL),
(60, 'Mỹ Thuật, Kiến Trúc', 10, '2025-06-10 13:05:54', NULL, 'my-thuat-kien-truc', NULL),
(61, 'Nông Lâm Nghiệp', 10, '2025-06-10 13:05:54', NULL, 'nong-lam-nghiep', NULL),
(62, 'Pháp Luật', 10, '2025-06-10 13:05:54', NULL, 'phap-luat', NULL),
(63, 'Sách Học Nghề', 11, '2025-06-10 13:05:54', NULL, 'sach-hoc-nghe', NULL),
(64, 'Sách Tôn Giáo', 11, '2025-06-10 13:05:54', NULL, 'sach-ton-giao', NULL),
(65, 'Thể Thao', 12, '2025-06-10 13:05:54', NULL, 'the-thao', NULL),
(66, 'Văn Hoá Nghệ Thuật', 12, '2025-06-10 13:05:54', NULL, 'van-hoa-nghe-thuat', NULL),
(67, 'Y Học', 12, '2025-06-10 13:05:54', NULL, 'y-hoc', NULL),
(68, 'Nghiệp Vụ Báo Chí', 12, '2025-06-10 13:05:54', NULL, 'nghiep-vu-bao-chi', NULL),
(69, 'Cấp 1', 12, '2025-06-10 13:05:54', NULL, 'cap-1', NULL),
(70, 'Cấp 2', 13, '2025-06-10 13:05:54', NULL, 'cap-2', NULL),
(71, 'Cấp 3', 13, '2025-06-10 13:05:54', NULL, 'cap-3', NULL),
(72, 'Sách Tham Khảo', 13, '2025-06-10 13:05:54', NULL, 'sach-tham-khao', NULL),
(73, 'Đại Học', 13, '2025-06-10 13:05:54', NULL, 'dai-hoc', NULL),
(74, 'Bộ Sách Giáo Khoa', 13, '2025-06-10 13:05:54', NULL, 'bo-sach-giao-khoa', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dia_chi_nhan_hang`
--

CREATE TABLE `dia_chi_nhan_hang` (
  `id` bigint(20) NOT NULL,
  `khachhang_id` bigint(20) NOT NULL,
  `ten_nguoi_nhan` varchar(255) DEFAULT NULL,
  `so_dien_thoai` varchar(20) DEFAULT NULL,
  `dia_chi_cu_the` text DEFAULT NULL,
  `phuong_xa_id` varchar(20) DEFAULT NULL,
  `quan_huyen_id` varchar(20) DEFAULT NULL,
  `tinh_thanh_id` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `footers`
--

CREATE TABLE `footers` (
  `id` int(11) NOT NULL,
  `loai_du_lieu` enum('thong_tin_chung','muc_con') NOT NULL,
  `ten_muc` varchar(255) DEFAULT NULL,
  `noi_dung` varchar(255) DEFAULT NULL,
  `duong_dan` varchar(255) DEFAULT NULL,
  `ten_cong_ty` varchar(255) DEFAULT NULL,
  `dia_chi` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `dien_thoai` varchar(20) DEFAULT NULL,
  `mo_ta` text DEFAULT NULL,
  `ngay_tao` timestamp NOT NULL DEFAULT current_timestamp(),
  `ngay_cap_nhat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `logo_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `footers`
--

INSERT INTO `footers` (`id`, `loai_du_lieu`, `ten_muc`, `noi_dung`, `duong_dan`, `ten_cong_ty`, `dia_chi`, `email`, `dien_thoai`, `mo_ta`, `ngay_tao`, `ngay_cap_nhat`, `logo_url`) VALUES
(1, 'thong_tin_chung', NULL, NULL, NULL, 'DEMO', ' TP. HCM và Long An', 'cskh@DEMO.com.vn', '10', 'DEMO.com nhận đặt hàng trực tuyến và giao hàng tận nơi.', '2025-06-02 06:24:41', '2025-06-02 13:44:53', 'storage/logo.png'),
(2, 'muc_con', 'Dịch Vụ', 'Điều khoản sử dụng', '#', NULL, NULL, NULL, NULL, NULL, '2025-06-02 06:24:41', '2025-06-02 06:24:41', NULL),
(3, 'muc_con', 'Dịch Vụ', 'Chính sách bảo mật thông tin cá nhân', '#', NULL, NULL, NULL, NULL, NULL, '2025-06-02 06:24:41', '2025-06-02 06:24:41', NULL),
(4, 'muc_con', 'Dịch Vụ', 'Chính sách bảo mật thanh toán', '#', NULL, NULL, NULL, NULL, NULL, '2025-06-02 06:24:41', '2025-06-02 06:24:41', NULL),
(5, 'muc_con', 'Dịch Vụ', 'Giới thiệu demo', '#', NULL, NULL, NULL, NULL, NULL, '2025-06-02 06:24:41', '2025-06-02 06:37:51', NULL),
(6, 'muc_con', 'Dịch Vụ', 'Hệ thống trung tâm - nhà sách', '#', NULL, NULL, NULL, NULL, NULL, '2025-06-02 06:24:41', '2025-06-02 06:24:41', NULL),
(7, 'muc_con', 'Hỗ Trợ', 'Chính sách đổi - trả - hoàn tiền', '#', NULL, NULL, NULL, NULL, NULL, '2025-06-02 06:24:41', '2025-06-02 06:24:41', NULL),
(8, 'muc_con', 'Hỗ Trợ', 'Chính sách bảo hành - bồi hoàn', '#', NULL, NULL, NULL, NULL, NULL, '2025-06-02 06:24:41', '2025-06-02 06:24:41', NULL),
(9, 'muc_con', 'Hỗ Trợ', 'Chính sách vận chuyển', '#', NULL, NULL, NULL, NULL, NULL, '2025-06-02 06:24:41', '2025-06-02 06:24:41', NULL),
(10, 'muc_con', 'Hỗ Trợ', 'Chính sách khách sỉ', '#', NULL, NULL, NULL, NULL, NULL, '2025-06-02 06:24:41', '2025-06-02 06:24:41', NULL),
(11, 'muc_con', 'Tài Khoản Của Tôi', 'Đăng nhập/Tạo mới tài khoản', '#', NULL, NULL, NULL, NULL, NULL, '2025-06-02 06:24:41', '2025-06-02 06:24:41', NULL),
(12, 'muc_con', 'Tài Khoản Của Tôi', 'Thay đổi địa chỉ khách hàng', '#', NULL, NULL, NULL, NULL, NULL, '2025-06-02 06:24:41', '2025-06-02 06:24:41', NULL),
(13, 'muc_con', 'Tài Khoản Của Tôi', 'Chi tiết tài khoản', '#', NULL, NULL, NULL, NULL, NULL, '2025-06-02 06:24:41', '2025-06-02 06:24:41', NULL),
(14, 'muc_con', 'Tài Khoản Của Tôi', 'Lịch sử mua hàng', '#', NULL, NULL, NULL, NULL, NULL, '2025-06-02 06:24:41', '2025-06-02 06:24:41', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `MaGioHang` bigint(20) NOT NULL,
  `MaKhachHang` bigint(20) DEFAULT NULL,
  `TongTien` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `giohang`
--

INSERT INTO `giohang` (`MaGioHang`, `MaKhachHang`, `TongTien`) VALUES
(1, 1, 320000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `MaHoaDon` bigint(20) NOT NULL,
  `MaKhachHang` bigint(20) DEFAULT NULL,
  `NgayLap` datetime DEFAULT NULL,
  `TongTien` decimal(15,2) DEFAULT NULL,
  `TrangThai` varchar(50) DEFAULT NULL,
  `PT_ThanhToan` bigint(20) DEFAULT NULL,
  `DiaChi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`MaHoaDon`, `MaKhachHang`, `NgayLap`, `TongTien`, `TrangThai`, `PT_ThanhToan`, `DiaChi`) VALUES
(1, 1, '2025-01-08 18:40:00', 250000.00, 'Hủy đơn', 1, NULL),
(2, 2, '2025-01-08 18:50:00', 300000.00, 'Hoàn thành', 2, '98 Nam Kỳ Khởi Nghĩa, Q.1, TP.HCM'),
(3, 3, '2025-01-08 19:00:00', 50000.00, 'Đang giao hàng', 1, '18 Tôn Đức Thắng, Q.1, TP.HCM'),
(4, 4, '2025-01-08 19:10:00', 100000.00, 'Đang chờ', 2, '45 Trần Hưng Đạo, Q.5, TP.HCM'),
(5, 1, '2025-01-08 17:50:41', 330000.00, 'Hủy đơn', 1, '65 Huỳnh Thúc Kháng, Bến Nghé, Quận 1, Hồ Chí Minh 700000'),
(6, 1, '2025-01-08 17:50:41', 30000.00, 'Hủy đơn', 1, '65 Huỳnh Thúc Kháng, Bến Nghé, Quận 1, Hồ Chí Minh 700000'),
(7, 1, '2025-01-08 17:53:34', 117000.00, 'Hoàn thành', 1, '65 Huỳnh Thúc Kháng, Bến Nghé, Quận 1, Hồ Chí Minh 700000'),
(8, 1, '2025-01-08 17:53:34', 30000.00, 'đã hủy', 1, '65 Huỳnh Thúc Kháng, Bến Nghé, Quận 1, Hồ Chí Minh 700000'),
(9, 1, '2025-01-08 18:00:00', 150000.00, 'Hoàn thành', 1, '123 Nguyễn Trãi, Q.1, TP.HCM'),
(10, 2, '2025-01-08 18:10:00', 200000.00, 'Đang chờ', 2, '456 Lý Tự Trọng, Q.1, TP.HCM'),
(11, 3, '2025-01-08 18:20:00', 120000.00, 'Đang giao hàng', 1, '789 Lê Lai, Q.1, TP.HCM'),
(12, 4, '2025-01-08 18:30:00', 175000.00, 'Hoàn thành', 2, '12 Pasteur, Q.3, TP.HCM');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `MaKhachHang` bigint(20) NOT NULL,
  `Ho` varchar(100) DEFAULT NULL,
  `Ten` varchar(100) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `TrangThai` tinyint(4) DEFAULT 1,
  `MatKhau` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`MaKhachHang`, `Ho`, `Ten`, `Email`, `role`, `TrangThai`, `MatKhau`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'a', 'a', 'admin@juice-sh.op', 'user', 1, '$2y$12$JBmZvFypXQ0ys8yr0/YJF.EiwI84E/ZHvIJrnNqULuaVA.e0hiQvK', NULL, '2025-06-10 12:39:44', NULL),
(2, 'a', 'a', 'quangbao@gmail.com', 'user', 1, '$2y$12$gStkX.52QlN6dmGCoC9FEuFGLdiy5ue7Souj7lqXjTy3eDRREv2lO', NULL, '2025-06-10 13:10:30', NULL),
(3, 'a', 'a', 'quangbao1@gmail.com', 'user', 1, '$2y$12$3xewEXe9sLByTSUVzlpgPO4gZlvFmL7JMWQtPydVEA41QiPE6/huK', 'xl1XGRLLOj87kujt4BBu4nXfxa3HnVeX5cix3ZYgxjKICiGLfa1EA9NZJ85X', '2025-06-10 14:04:51', '2025-06-13 01:18:56'),
(4, NULL, NULL, 'vana@example.com', 'user', 1, '$2y$12$K1sMsO4YXbKWdtT9zkIEBOY2Oy04MP6Bkc.Y4979UUO6p/f5g4Z2.', NULL, '2025-06-10 22:36:05', NULL),
(5, 'q', 'q', 'q@gmail.com', 'user', 1, '$2y$12$uZwJNaRGNPKfGz8RzBKnD.KoVY.9KIkapLkBoSnxm4F7TDAU39TVa', NULL, '2025-06-10 15:49:53', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `MaKhuyenMai` bigint(20) NOT NULL,
  `TenKhuyenMai` varchar(255) NOT NULL,
  `MoTa` text DEFAULT NULL,
  `NgayBatDau` datetime NOT NULL,
  `NgayKetThuc` datetime NOT NULL,
  `PhanTramGiamGia` int(11) NOT NULL,
  `TrangThai` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khuyenmai`
--

INSERT INTO `khuyenmai` (`MaKhuyenMai`, `TenKhuyenMai`, `MoTa`, `NgayBatDau`, `NgayKetThuc`, `PhanTramGiamGia`, `TrangThai`) VALUES
(1, 'GIAMGIA10', 'Giảm giá 10%', '2025-01-08 17:05:23', '2025-01-31 17:05:23', 10, 1),
(2, 'GIAMGIA15', 'Giảm giá 15%', '2025-01-08 17:05:23', '2025-01-31 17:05:23', 15, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lien_he`
--

CREATE TABLE `lien_he` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ho_ten` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `chu_de` varchar(255) NOT NULL,
  `noi_dung` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lien_he`
--

INSERT INTO `lien_he` (`id`, `ho_ten`, `email`, `chu_de`, `noi_dung`, `created_at`, `updated_at`) VALUES
(1, 'a', 'admin@juice-sh.op', 'a', 'a', '2025-06-02 06:40:42', '2025-06-02 06:40:42'),
(2, 'a', 'longhai1112a@gmail.com', 'dsa', 'a', '2025-06-02 06:47:58', '2025-06-02 06:47:58'),
(3, 'a', 'longhai1112a@gmail.com', 'a', 'a', '2025-06-02 06:54:08', '2025-06-02 06:54:08'),
(4, 'a', 'longhai1112a@gmail.com', 'a', 'a', '2025-06-02 07:05:06', '2025-06-02 07:05:06'),
(5, 'dsasad', 'ưq@gmail.com', 'ádsa', 'sadsa', '2025-06-02 07:05:27', '2025-06-02 07:05:27'),
(6, 'a', 'admin@juice-sh.op', 'a', 'a', '2025-06-02 07:06:26', '2025-06-02 07:06:26'),
(7, 'long', 'longhai1112a@gmail.com', 'a', 'a', '2025-06-04 06:58:51', '2025-06-04 06:58:51'),
(8, 'demo', 'nhlong1112@gmail.com', 'demo', 'demo', '2025-06-05 20:55:28', '2025-06-05 20:55:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_12_07_120151_rename_categories_to_danhmuc', 2),
(5, '2025_01_01_080230_create_lien_he_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phuong`
--

CREATE TABLE `phuong` (
  `code` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `full_name_en` varchar(255) DEFAULT NULL,
  `code_name` varchar(255) DEFAULT NULL,
  `district_code` varchar(20) DEFAULT NULL,
  `administrative_unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phuong`
--

INSERT INTO `phuong` (`code`, `name`, `name_en`, `full_name`, `full_name_en`, `code_name`, `district_code`, `administrative_unit_id`) VALUES
('00001', 'Phúc Xá', 'Phuc Xa', 'Phường Phúc Xá', 'Phuc Xa Ward', 'phuc_xa', '001', 8),
('00004', 'Trúc Bạch', 'Truc Bach', 'Phường Trúc Bạch', 'Truc Bach Ward', 'truc_bach', '001', 8),
('00006', 'Vĩnh Phúc', 'Vinh Phuc', 'Phường Vĩnh Phúc', 'Vinh Phuc Ward', 'vinh_phuc', '001', 8),
('00007', 'Cống Vị', 'Cong Vi', 'Phường Cống Vị', 'Cong Vi Ward', 'cong_vi', '001', 8),
('00008', 'Liễu Giai', 'Lieu Giai', 'Phường Liễu Giai', 'Lieu Giai Ward', 'lieu_giai', '001', 8),
('00013', 'Quán Thánh', 'Quan Thanh', 'Phường Quán Thánh', 'Quan Thanh Ward', 'quan_thanh', '001', 8),
('00016', 'Ngọc Hà', 'Ngoc Ha', 'Phường Ngọc Hà', 'Ngoc Ha Ward', 'ngoc_ha', '001', 8),
('00019', 'Điện Biên', 'Dien Bien', 'Phường Điện Biên', 'Dien Bien Ward', 'dien_bien', '001', 8),
('00022', 'Đội Cấn', 'Doi Can', 'Phường Đội Cấn', 'Doi Can Ward', 'doi_can', '001', 8),
('00025', 'Ngọc Khánh', 'Ngoc Khanh', 'Phường Ngọc Khánh', 'Ngoc Khanh Ward', 'ngoc_khanh', '001', 8),
('00028', 'Kim Mã', 'Kim Ma', 'Phường Kim Mã', 'Kim Ma Ward', 'kim_ma', '001', 8),
('00031', 'Giảng Võ', 'Giang Vo', 'Phường Giảng Võ', 'Giang Vo Ward', 'giang_vo', '001', 8),
('00034', 'Thành Công', 'Thanh Cong', 'Phường Thành Công', 'Thanh Cong Ward', 'thanh_cong', '001', 8),
('00037', 'Phúc Tân', 'Phuc Tan', 'Phường Phúc Tân', 'Phuc Tan Ward', 'phuc_tan', '002', 8),
('00040', 'Đồng Xuân', 'Dong Xuan', 'Phường Đồng Xuân', 'Dong Xuan Ward', 'dong_xuan', '002', 8),
('00043', 'Hàng Mã', 'Hang Ma', 'Phường Hàng Mã', 'Hang Ma Ward', 'hang_ma', '002', 8),
('00046', 'Hàng Buồm', 'Hang Buom', 'Phường Hàng Buồm', 'Hang Buom Ward', 'hang_buom', '002', 8),
('00049', 'Hàng Đào', 'Hang Dao', 'Phường Hàng Đào', 'Hang Dao Ward', 'hang_dao', '002', 8),
('00052', 'Hàng Bồ', 'Hang Bo', 'Phường Hàng Bồ', 'Hang Bo Ward', 'hang_bo', '002', 8),
('00055', 'Cửa Đông', 'Cua Dong', 'Phường Cửa Đông', 'Cua Dong Ward', 'cua_dong', '002', 8),
('00058', 'Lý Thái Tổ', 'Ly Thai To', 'Phường Lý Thái Tổ', 'Ly Thai To Ward', 'ly_thai_to', '002', 8),
('00061', 'Hàng Bạc', 'Hang Bac', 'Phường Hàng Bạc', 'Hang Bac Ward', 'hang_bac', '002', 8),
('00064', 'Hàng Gai', 'Hang Gai', 'Phường Hàng Gai', 'Hang Gai Ward', 'hang_gai', '002', 8),
('00067', 'Chương Dương', 'Chuong Duong', 'Phường Chương Dương', 'Chuong Duong Ward', 'chuong_duong', '002', 8),
('00070', 'Hàng Trống', 'Hang Trong', 'Phường Hàng Trống', 'Hang Trong Ward', 'hang_trong', '002', 8),
('00073', 'Cửa Nam', 'Cua Nam', 'Phường Cửa Nam', 'Cua Nam Ward', 'cua_nam', '002', 8),
('00076', 'Hàng Bông', 'Hang Bong', 'Phường Hàng Bông', 'Hang Bong Ward', 'hang_bong', '002', 8),
('00079', 'Tràng Tiền', 'Trang Tien', 'Phường Tràng Tiền', 'Trang Tien Ward', 'trang_tien', '002', 8),
('00082', 'Trần Hưng Đạo', 'Tran Hung Dao', 'Phường Trần Hưng Đạo', 'Tran Hung Dao Ward', 'tran_hung_dao', '002', 8),
('00085', 'Phan Chu Trinh', 'Phan Chu Trinh', 'Phường Phan Chu Trinh', 'Phan Chu Trinh Ward', 'phan_chu_trinh', '002', 8),
('00088', 'Hàng Bài', 'Hang Bai', 'Phường Hàng Bài', 'Hang Bai Ward', 'hang_bai', '002', 8),
('00091', 'Phú Thượng', 'Phu Thuong', 'Phường Phú Thượng', 'Phu Thuong Ward', 'phu_thuong', '003', 8),
('00094', 'Nhật Tân', 'Nhat Tan', 'Phường Nhật Tân', 'Nhat Tan Ward', 'nhat_tan', '003', 8),
('00097', 'Tứ Liên', 'Tu Lien', 'Phường Tứ Liên', 'Tu Lien Ward', 'tu_lien', '003', 8),
('00100', 'Quảng An', 'Quang An', 'Phường Quảng An', 'Quang An Ward', 'quang_an', '003', 8),
('00103', 'Xuân La', 'Xuan La', 'Phường Xuân La', 'Xuan La Ward', 'xuan_la', '003', 8),
('00106', 'Yên Phụ', 'Yen Phu', 'Phường Yên Phụ', 'Yen Phu Ward', 'yen_phu', '003', 8),
('00109', 'Bưởi', 'Buoi', 'Phường Bưởi', 'Buoi Ward', 'buoi', '003', 8),
('00112', 'Thụy Khuê', 'Thuy Khue', 'Phường Thụy Khuê', 'Thuy Khue Ward', 'thuy_khue', '003', 8),
('00115', 'Thượng Thanh', 'Thuong Thanh', 'Phường Thượng Thanh', 'Thuong Thanh Ward', 'thuong_thanh', '004', 8),
('00118', 'Ngọc Thụy', 'Ngoc Thuy', 'Phường Ngọc Thụy', 'Ngoc Thuy Ward', 'ngoc_thuy', '004', 8),
('00121', 'Giang Biên', 'Giang Bien', 'Phường Giang Biên', 'Giang Bien Ward', 'giang_bien', '004', 8),
('00124', 'Đức Giang', 'Duc Giang', 'Phường Đức Giang', 'Duc Giang Ward', 'duc_giang', '004', 8),
('00127', 'Việt Hưng', 'Viet Hung', 'Phường Việt Hưng', 'Viet Hung Ward', 'viet_hung', '004', 8),
('00130', 'Gia Thụy', 'Gia Thuy', 'Phường Gia Thụy', 'Gia Thuy Ward', 'gia_thuy', '004', 8),
('00133', 'Ngọc Lâm', 'Ngoc Lam', 'Phường Ngọc Lâm', 'Ngoc Lam Ward', 'ngoc_lam', '004', 8),
('00136', 'Phúc Lợi', 'Phuc Loi', 'Phường Phúc Lợi', 'Phuc Loi Ward', 'phuc_loi', '004', 8),
('00139', 'Bồ Đề', 'Bo De', 'Phường Bồ Đề', 'Bo De Ward', 'bo_de', '004', 8),
('00145', 'Long Biên', 'Long Bien', 'Phường Long Biên', 'Long Bien Ward', 'long_bien', '004', 8),
('00148', 'Thạch Bàn', 'Thach Ban', 'Phường Thạch Bàn', 'Thach Ban Ward', 'thach_ban', '004', 8),
('00151', 'Phúc Đồng', 'Phuc Dong', 'Phường Phúc Đồng', 'Phuc Dong Ward', 'phuc_dong', '004', 8),
('00154', 'Cự Khối', 'Cu Khoi', 'Phường Cự Khối', 'Cu Khoi Ward', 'cu_khoi', '004', 8),
('00157', 'Nghĩa Đô', 'Nghia Do', 'Phường Nghĩa Đô', 'Nghia Do Ward', 'nghia_do', '005', 8),
('00160', 'Nghĩa Tân', 'Nghia Tan', 'Phường Nghĩa Tân', 'Nghia Tan Ward', 'nghia_tan', '005', 8),
('00163', 'Mai Dịch', 'Mai Dich', 'Phường Mai Dịch', 'Mai Dich Ward', 'mai_dich', '005', 8),
('00166', 'Dịch Vọng', 'Dich Vong', 'Phường Dịch Vọng', 'Dich Vong Ward', 'dich_vong', '005', 8),
('00167', 'Dịch Vọng Hậu', 'Dich Vong Hau', 'Phường Dịch Vọng Hậu', 'Dich Vong Hau Ward', 'dich_vong_hau', '005', 8),
('00169', 'Quan Hoa', 'Quan Hoa', 'Phường Quan Hoa', 'Quan Hoa Ward', 'quan_hoa', '005', 8),
('00172', 'Yên Hoà', 'Yen Hoa', 'Phường Yên Hoà', 'Yen Hoa Ward', 'yen_hoa', '005', 8),
('00175', 'Trung Hoà', 'Trung Hoa', 'Phường Trung Hoà', 'Trung Hoa Ward', 'trung_hoa', '005', 8),
('00178', 'Cát Linh', 'Cat Linh', 'Phường Cát Linh', 'Cat Linh Ward', 'cat_linh', '006', 8),
('00181', 'Văn Miếu - Quốc Tử Giám', 'Van Mieu - Quoc Tu Giam', 'Phường Văn Miếu - Quốc Tử Giám', 'Van Mieu - Quoc Tu Giam Ward', 'van_mieu_quoc_tu_giam', '006', 8),
('00187', 'Láng Thượng', 'Lang Thuong', 'Phường Láng Thượng', 'Lang Thuong Ward', 'lang_thuong', '006', 8),
('00190', 'Ô Chợ Dừa', 'O Cho Dua', 'Phường Ô Chợ Dừa', 'O Cho Dua Ward', 'o_cho_dua', '006', 8),
('00193', 'Văn Chương', 'Van Chuong', 'Phường Văn Chương', 'Van Chuong Ward', 'van_chuong', '006', 8),
('00196', 'Hàng Bột', 'Hang Bot', 'Phường Hàng Bột', 'Hang Bot Ward', 'hang_bot', '006', 8),
('00199', 'Láng Hạ', 'Lang Ha', 'Phường Láng Hạ', 'Lang Ha Ward', 'lang_ha', '006', 8),
('00202', 'Khâm Thiên', 'Kham Thien', 'Phường Khâm Thiên', 'Kham Thien Ward', 'kham_thien', '006', 8),
('00205', 'Thổ Quan', 'Tho Quan', 'Phường Thổ Quan', 'Tho Quan Ward', 'tho_quan', '006', 8),
('00208', 'Nam Đồng', 'Nam Dong', 'Phường Nam Đồng', 'Nam Dong Ward', 'nam_dong', '006', 8),
('00214', 'Quang Trung', 'Quang Trung', 'Phường Quang Trung', 'Quang Trung Ward', 'quang_trung', '006', 8),
('00217', 'Trung Liệt', 'Trung Liet', 'Phường Trung Liệt', 'Trung Liet Ward', 'trung_liet', '006', 8),
('00226', 'Phương Liên - Trung Tự', 'Phuong Lien - Trung Tu', 'Phường Phương Liên - Trung Tự', 'Phuong Lien - Trung Tu Ward', 'phuong_lien_trung_tu', '006', 8),
('00229', 'Kim Liên', 'Kim Lien', 'Phường Kim Liên', 'Kim Lien Ward', 'kim_lien', '006', 8),
('00232', 'Phương Mai', 'Phuong Mai', 'Phường Phương Mai', 'Phuong Mai Ward', 'phuong_mai', '006', 8),
('00235', 'Thịnh Quang', 'Thinh Quang', 'Phường Thịnh Quang', 'Thinh Quang Ward', 'thinh_quang', '006', 8),
('00238', 'Khương Thượng', 'Khuong Thuong', 'Phường Khương Thượng', 'Khuong Thuong Ward', 'khuong_thuong', '006', 8),
('00241', 'Nguyễn Du', 'Nguyen Du', 'Phường Nguyễn Du', 'Nguyen Du Ward', 'nguyen_du', '007', 8),
('00244', 'Bạch Đằng', 'Bach Dang', 'Phường Bạch Đằng', 'Bach Dang Ward', 'bach_dang', '007', 8),
('00247', 'Phạm Đình Hổ', 'Pham Dinh Ho', 'Phường Phạm Đình Hổ', 'Pham Dinh Ho Ward', 'pham_dinh_ho', '007', 8),
('00256', 'Lê Đại Hành', 'Le Dai Hanh', 'Phường Lê Đại Hành', 'Le Dai Hanh Ward', 'le_dai_hanh', '007', 8),
('00259', 'Đồng Nhân', 'Dong Nhan', 'Phường Đồng Nhân', 'Dong Nhan Ward', 'dong_nhan', '007', 8),
('00262', 'Phố Huế', 'Pho Hue', 'Phường Phố Huế', 'Pho Hue Ward', 'pho_hue', '007', 8),
('00268', 'Thanh Lương', 'Thanh Luong', 'Phường Thanh Lương', 'Thanh Luong Ward', 'thanh_luong', '007', 8),
('00271', 'Thanh Nhàn', 'Thanh Nhan', 'Phường Thanh Nhàn', 'Thanh Nhan Ward', 'thanh_nhan', '007', 8),
('00277', 'Bách Khoa', 'Bach Khoa', 'Phường Bách Khoa', 'Bach Khoa Ward', 'bach_khoa', '007', 8),
('00280', 'Đồng Tâm', 'Dong Tam', 'Phường Đồng Tâm', 'Dong Tam Ward', 'dong_tam', '007', 8),
('00283', 'Vĩnh Tuy', 'Vinh Tuy', 'Phường Vĩnh Tuy', 'Vinh Tuy Ward', 'vinh_tuy', '007', 8),
('00289', 'Quỳnh Mai', 'Quynh Mai', 'Phường Quỳnh Mai', 'Quynh Mai Ward', 'quynh_mai', '007', 8),
('00292', 'Bạch Mai', 'Bach Mai', 'Phường Bạch Mai', 'Bach Mai Ward', 'bach_mai', '007', 8),
('00295', 'Minh Khai', 'Minh Khai', 'Phường Minh Khai', 'Minh Khai Ward', 'minh_khai', '007', 8),
('00298', 'Trương Định', 'Truong Dinh', 'Phường Trương Định', 'Truong Dinh Ward', 'truong_dinh', '007', 8),
('00301', 'Thanh Trì', 'Thanh Tri', 'Phường Thanh Trì', 'Thanh Tri Ward', 'thanh_tri', '008', 8),
('00304', 'Vĩnh Hưng', 'Vinh Hung', 'Phường Vĩnh Hưng', 'Vinh Hung Ward', 'vinh_hung', '008', 8),
('00307', 'Định Công', 'Dinh Cong', 'Phường Định Công', 'Dinh Cong Ward', 'dinh_cong', '008', 8),
('00310', 'Mai Động', 'Mai Dong', 'Phường Mai Động', 'Mai Dong Ward', 'mai_dong', '008', 8),
('00313', 'Tương Mai', 'Tuong Mai', 'Phường Tương Mai', 'Tuong Mai Ward', 'tuong_mai', '008', 8),
('00316', 'Đại Kim', 'Dai Kim', 'Phường Đại Kim', 'Dai Kim Ward', 'dai_kim', '008', 8),
('00319', 'Tân Mai', 'Tan Mai', 'Phường Tân Mai', 'Tan Mai Ward', 'tan_mai', '008', 8),
('00322', 'Hoàng Văn Thụ', 'Hoang Van Thu', 'Phường Hoàng Văn Thụ', 'Hoang Van Thu Ward', 'hoang_van_thu', '008', 8),
('00325', 'Giáp Bát', 'Giap Bat', 'Phường Giáp Bát', 'Giap Bat Ward', 'giap_bat', '008', 8),
('00328', 'Lĩnh Nam', 'Linh Nam', 'Phường Lĩnh Nam', 'Linh Nam Ward', 'linh_nam', '008', 8),
('00331', 'Thịnh Liệt', 'Thinh Liet', 'Phường Thịnh Liệt', 'Thinh Liet Ward', 'thinh_liet', '008', 8),
('00334', 'Trần Phú', 'Tran Phu', 'Phường Trần Phú', 'Tran Phu Ward', 'tran_phu', '008', 8),
('00337', 'Hoàng Liệt', 'Hoang Liet', 'Phường Hoàng Liệt', 'Hoang Liet Ward', 'hoang_liet', '008', 8),
('00340', 'Yên Sở', 'Yen So', 'Phường Yên Sở', 'Yen So Ward', 'yen_so', '008', 8),
('00343', 'Nhân Chính', 'Nhan Chinh', 'Phường Nhân Chính', 'Nhan Chinh Ward', 'nhan_chinh', '009', 8),
('00346', 'Thượng Đình', 'Thuong Dinh', 'Phường Thượng Đình', 'Thuong Dinh Ward', 'thuong_dinh', '009', 8),
('00349', 'Khương Trung', 'Khuong Trung', 'Phường Khương Trung', 'Khuong Trung Ward', 'khuong_trung', '009', 8),
('00352', 'Khương Mai', 'Khuong Mai', 'Phường Khương Mai', 'Khuong Mai Ward', 'khuong_mai', '009', 8),
('00355', 'Thanh Xuân Trung', 'Thanh Xuan Trung', 'Phường Thanh Xuân Trung', 'Thanh Xuan Trung Ward', 'thanh_xuan_trung', '009', 8),
('00358', 'Phương Liệt', 'Phuong Liet', 'Phường Phương Liệt', 'Phuong Liet Ward', 'phuong_liet', '009', 8),
('00364', 'Khương Đình', 'Khuong Dinh', 'Phường Khương Đình', 'Khuong Dinh Ward', 'khuong_dinh', '009', 8),
('00367', 'Thanh Xuân Bắc', 'Thanh Xuan Bac', 'Phường Thanh Xuân Bắc', 'Thanh Xuan Bac Ward', 'thanh_xuan_bac', '009', 8),
('00373', 'Hạ Đình', 'Ha Dinh', 'Phường Hạ Đình', 'Ha Dinh Ward', 'ha_dinh', '009', 8),
('00376', 'Sóc Sơn', 'Soc Son', 'Thị trấn Sóc Sơn', 'Soc Son Township', 'soc_son', '016', 9),
('00379', 'Bắc Sơn', 'Bac Son', 'Xã Bắc Sơn', 'Bac Son Commune', 'bac_son', '016', 10),
('00382', 'Minh Trí', 'Minh Tri', 'Xã Minh Trí', 'Minh Tri Commune', 'minh_tri', '016', 10),
('00385', 'Hồng Kỳ', 'Hong Ky', 'Xã Hồng Kỳ', 'Hong Ky Commune', 'hong_ky', '016', 10),
('00388', 'Nam Sơn', 'Nam Son', 'Xã Nam Sơn', 'Nam Son Commune', 'nam_son', '016', 10),
('00391', 'Trung Giã', 'Trung Gia', 'Xã Trung Giã', 'Trung Gia Commune', 'trung_gia', '016', 10),
('00394', 'Tân Hưng', 'Tan Hung', 'Xã Tân Hưng', 'Tan Hung Commune', 'tan_hung', '016', 10),
('00397', 'Minh Phú', 'Minh Phu', 'Xã Minh Phú', 'Minh Phu Commune', 'minh_phu', '016', 10),
('00400', 'Phù Linh', 'Phu Linh', 'Xã Phù Linh', 'Phu Linh Commune', 'phu_linh', '016', 10),
('00403', 'Bắc Phú', 'Bac Phu', 'Xã Bắc Phú', 'Bac Phu Commune', 'bac_phu', '016', 10),
('00406', 'Tân Minh', 'Tan Minh', 'Xã Tân Minh', 'Tan Minh Commune', 'tan_minh', '016', 10),
('00409', 'Quang Tiến', 'Quang Tien', 'Xã Quang Tiến', 'Quang Tien Commune', 'quang_tien', '016', 10),
('00412', 'Hiền Ninh', 'Hien Ninh', 'Xã Hiền Ninh', 'Hien Ninh Commune', 'hien_ninh', '016', 10),
('00415', 'Tân Dân', 'Tan Dan', 'Xã Tân Dân', 'Tan Dan Commune', 'tan_dan', '016', 10),
('00418', 'Tiên Dược', 'Tien Duoc', 'Xã Tiên Dược', 'Tien Duoc Commune', 'tien_duoc', '016', 10),
('00421', 'Việt Long', 'Viet Long', 'Xã Việt Long', 'Viet Long Commune', 'viet_long', '016', 10),
('00424', 'Xuân Giang', 'Xuan Giang', 'Xã Xuân Giang', 'Xuan Giang Commune', 'xuan_giang', '016', 10),
('00427', 'Mai Đình', 'Mai Dinh', 'Xã Mai Đình', 'Mai Dinh Commune', 'mai_dinh', '016', 10),
('00430', 'Đức Hoà', 'Duc Hoa', 'Xã Đức Hoà', 'Duc Hoa Commune', 'duc_hoa', '016', 10),
('00433', 'Thanh Xuân', 'Thanh Xuan', 'Xã Thanh Xuân', 'Thanh Xuan Commune', 'thanh_xuan', '016', 10),
('00436', 'Đông Xuân', 'Dong Xuan', 'Xã Đông Xuân', 'Dong Xuan Commune', 'dong_xuan', '016', 10),
('00439', 'Kim Lũ', 'Kim Lu', 'Xã Kim Lũ', 'Kim Lu Commune', 'kim_lu', '016', 10),
('00442', 'Phú Cường', 'Phu Cuong', 'Xã Phú Cường', 'Phu Cuong Commune', 'phu_cuong', '016', 10),
('00445', 'Phú Minh', 'Phu Minh', 'Xã Phú Minh', 'Phu Minh Commune', 'phu_minh', '016', 10),
('00448', 'Phù Lỗ', 'Phu Lo', 'Xã Phù Lỗ', 'Phu Lo Commune', 'phu_lo', '016', 10),
('00451', 'Xuân Thu', 'Xuan Thu', 'Xã Xuân Thu', 'Xuan Thu Commune', 'xuan_thu', '016', 10),
('00454', 'Đông Anh', 'Dong Anh', 'Thị trấn Đông Anh', 'Dong Anh Township', 'dong_anh', '017', 9),
('00457', 'Xuân Nộn', 'Xuan Non', 'Xã Xuân Nộn', 'Xuan Non Commune', 'xuan_non', '017', 10),
('00460', 'Thuỵ Lâm', 'Thuy Lam', 'Xã Thuỵ Lâm', 'Thuy Lam Commune', 'thuy_lam', '017', 10),
('00463', 'Bắc Hồng', 'Bac Hong', 'Xã Bắc Hồng', 'Bac Hong Commune', 'bac_hong', '017', 10),
('00466', 'Nguyên Khê', 'Nguyen Khe', 'Xã Nguyên Khê', 'Nguyen Khe Commune', 'nguyen_khe', '017', 10),
('00469', 'Nam Hồng', 'Nam Hong', 'Xã Nam Hồng', 'Nam Hong Commune', 'nam_hong', '017', 10),
('00472', 'Tiên Dương', 'Tien Duong', 'Xã Tiên Dương', 'Tien Duong Commune', 'tien_duong', '017', 10),
('00475', 'Vân Hà', 'Van Ha', 'Xã Vân Hà', 'Van Ha Commune', 'van_ha', '017', 10),
('00478', 'Uy Nỗ', 'Uy No', 'Xã Uy Nỗ', 'Uy No Commune', 'uy_no', '017', 10),
('00481', 'Vân Nội', 'Van Noi', 'Xã Vân Nội', 'Van Noi Commune', 'van_noi', '017', 10),
('00484', 'Liên Hà', 'Lien Ha', 'Xã Liên Hà', 'Lien Ha Commune', 'lien_ha', '017', 10),
('00487', 'Việt Hùng', 'Viet Hung', 'Xã Việt Hùng', 'Viet Hung Commune', 'viet_hung', '017', 10),
('00490', 'Kim Nỗ', 'Kim No', 'Xã Kim Nỗ', 'Kim No Commune', 'kim_no', '017', 10),
('00493', 'Kim Chung', 'Kim Chung', 'Xã Kim Chung', 'Kim Chung Commune', 'kim_chung', '017', 10),
('00496', 'Dục Tú', 'Duc Tu', 'Xã Dục Tú', 'Duc Tu Commune', 'duc_tu', '017', 10),
('00499', 'Đại Mạch', 'Dai Mach', 'Xã Đại Mạch', 'Dai Mach Commune', 'dai_mach', '017', 10),
('00502', 'Vĩnh Ngọc', 'Vinh Ngoc', 'Xã Vĩnh Ngọc', 'Vinh Ngoc Commune', 'vinh_ngoc', '017', 10),
('00505', 'Cổ Loa', 'Co Loa', 'Xã Cổ Loa', 'Co Loa Commune', 'co_loa', '017', 10),
('00508', 'Hải Bối', 'Hai Boi', 'Xã Hải Bối', 'Hai Boi Commune', 'hai_boi', '017', 10),
('00511', 'Xuân Canh', 'Xuan Canh', 'Xã Xuân Canh', 'Xuan Canh Commune', 'xuan_canh', '017', 10),
('00514', 'Võng La', 'Vong La', 'Xã Võng La', 'Vong La Commune', 'vong_la', '017', 10),
('00517', 'Tàm Xá', 'Tam Xa', 'Xã Tàm Xá', 'Tam Xa Commune', 'tam_xa', '017', 10),
('00520', 'Mai Lâm', 'Mai Lam', 'Xã Mai Lâm', 'Mai Lam Commune', 'mai_lam', '017', 10),
('00523', 'Đông Hội', 'Dong Hoi', 'Xã Đông Hội', 'Dong Hoi Commune', 'dong_hoi', '017', 10),
('00526', 'Yên Viên', 'Yen Vien', 'Thị trấn Yên Viên', 'Yen Vien Township', 'yen_vien', '018', 9),
('00529', 'Yên Thường', 'Yen Thuong', 'Xã Yên Thường', 'Yen Thuong Commune', 'yen_thuong', '018', 10),
('00532', 'Yên Viên', 'Yen Vien', 'Xã Yên Viên', 'Yen Vien Commune', 'yen_vien', '018', 10),
('00535', 'Ninh Hiệp', 'Ninh Hiep', 'Xã Ninh Hiệp', 'Ninh Hiep Commune', 'ninh_hiep', '018', 10),
('00541', 'Thiên Đức', 'Thien Duc', 'Xã Thiên Đức', 'Thien Duc Commune', 'thien_duc', '018', 10),
('00544', 'Phù Đổng', 'Phu Dong', 'Xã Phù Đổng', 'Phu Dong Commune', 'phu_dong', '018', 10),
('00550', 'Lệ Chi', 'Le Chi', 'Xã Lệ Chi', 'Le Chi Commune', 'le_chi', '018', 10),
('00553', 'Cổ Bi', 'Co Bi', 'Xã Cổ Bi', 'Co Bi Commune', 'co_bi', '018', 10),
('00556', 'Đặng Xá', 'Dang Xa', 'Xã Đặng Xá', 'Dang Xa Commune', 'dang_xa', '018', 10),
('00562', 'Phú Sơn', 'Phu Son', 'Xã Phú Sơn', 'Phu Son Commune', 'phu_son', '018', 10),
('00565', 'Trâu Quỳ', 'Trau Quy', 'Thị trấn Trâu Quỳ', 'Trau Quy Township', 'trau_quy', '018', 9),
('00568', 'Dương Quang', 'Duong Quang', 'Xã Dương Quang', 'Duong Quang Commune', 'duong_quang', '018', 10),
('00571', 'Dương Xá', 'Duong Xa', 'Xã Dương Xá', 'Duong Xa Commune', 'duong_xa', '018', 10),
('00577', 'Đa Tốn', 'Da Ton', 'Xã Đa Tốn', 'Da Ton Commune', 'da_ton', '018', 10),
('00580', 'Kiêu Kỵ', 'Kieu Ky', 'Xã Kiêu Kỵ', 'Kieu Ky Commune', 'kieu_ky', '018', 10),
('00583', 'Bát Tràng', 'Bat Trang', 'Xã Bát Tràng', 'Bat Trang Commune', 'bat_trang', '018', 10),
('00589', 'Kim Đức', 'Kim Duc', 'Xã Kim Đức', 'Kim Duc Commune', 'kim_duc', '018', 10),
('00592', 'Cầu Diễn', 'Cau Dien', 'Phường Cầu Diễn', 'Cau Dien Ward', 'cau_dien', '019', 8),
('00595', 'Thượng Cát', 'Thuong Cat', 'Phường Thượng Cát', 'Thuong Cat Ward', 'thuong_cat', '021', 8),
('00598', 'Liên Mạc', 'Lien Mac', 'Phường Liên Mạc', 'Lien Mac Ward', 'lien_mac', '021', 8),
('00601', 'Đông Ngạc', 'Dong Ngac', 'Phường Đông Ngạc', 'Dong Ngac Ward', 'dong_ngac', '021', 8),
('00602', 'Đức Thắng', 'Duc Thang', 'Phường Đức Thắng', 'Duc Thang Ward', 'duc_thang', '021', 8),
('00604', 'Thụy Phương', 'Thuy Phuong', 'Phường Thụy Phương', 'Thuy Phuong Ward', 'thuy_phuong', '021', 8),
('00607', 'Tây Tựu', 'Tay Tuu', 'Phường Tây Tựu', 'Tay Tuu Ward', 'tay_tuu', '021', 8),
('00610', 'Xuân Đỉnh', 'Xuan Dinh', 'Phường Xuân Đỉnh', 'Xuan Dinh Ward', 'xuan_dinh', '021', 8),
('00611', 'Xuân Tảo', 'Xuan Tao', 'Phường Xuân Tảo', 'Xuan Tao Ward', 'xuan_tao', '021', 8),
('00613', 'Minh Khai', 'Minh Khai', 'Phường Minh Khai', 'Minh Khai Ward', 'minh_khai', '021', 8),
('00616', 'Cổ Nhuế 1', 'Co Nhue 1', 'Phường Cổ Nhuế 1', 'Ward Co Nhue 1', 'co_nhue_1', '021', 8),
('00617', 'Cổ Nhuế 2', 'Co Nhue 2', 'Phường Cổ Nhuế 2', 'Ward Co Nhue 2', 'co_nhue_2', '021', 8),
('00619', 'Phú Diễn', 'Phu Dien', 'Phường Phú Diễn', 'Phu Dien Ward', 'phu_dien', '021', 8),
('00620', 'Phúc Diễn', 'Phuc Dien', 'Phường Phúc Diễn', 'Phuc Dien Ward', 'phuc_dien', '021', 8),
('00622', 'Xuân Phương', 'Xuan Phuong', 'Phường Xuân Phương', 'Xuan Phuong Ward', 'xuan_phuong', '019', 8),
('00623', 'Phương Canh', 'Phuong Canh', 'Phường Phương Canh', 'Phuong Canh Ward', 'phuong_canh', '019', 8),
('00625', 'Mỹ Đình 1', 'My Dinh 1', 'Phường Mỹ Đình 1', 'Ward My Dinh 1', 'my_dinh_1', '019', 8),
('00626', 'Mỹ Đình 2', 'My Dinh 2', 'Phường Mỹ Đình 2', 'Ward My Dinh 2', 'my_dinh_2', '019', 8),
('00628', 'Tây Mỗ', 'Tay Mo', 'Phường Tây Mỗ', 'Tay Mo Ward', 'tay_mo', '019', 8),
('00631', 'Mễ Trì', 'Me Tri', 'Phường Mễ Trì', 'Me Tri Ward', 'me_tri', '019', 8),
('00632', 'Phú Đô', 'Phu Do', 'Phường Phú Đô', 'Phu Do Ward', 'phu_do', '019', 8),
('00634', 'Đại Mỗ', 'Dai Mo', 'Phường Đại Mỗ', 'Dai Mo Ward', 'dai_mo', '019', 8),
('00637', 'Trung Văn', 'Trung Van', 'Phường Trung Văn', 'Trung Van Ward', 'trung_van', '019', 8),
('00640', 'Văn Điển', 'Van Dien', 'Thị trấn Văn Điển', 'Van Dien Township', 'van_dien', '020', 9),
('00643', 'Tân Triều', 'Tan Trieu', 'Xã Tân Triều', 'Tan Trieu Commune', 'tan_trieu', '020', 10),
('00646', 'Thanh Liệt', 'Thanh Liet', 'Xã Thanh Liệt', 'Thanh Liet Commune', 'thanh_liet', '020', 10),
('00649', 'Tả Thanh Oai', 'Ta Thanh Oai', 'Xã Tả Thanh Oai', 'Ta Thanh Oai Commune', 'ta_thanh_oai', '020', 10),
('00652', 'Hữu Hoà', 'Huu Hoa', 'Xã Hữu Hoà', 'Huu Hoa Commune', 'huu_hoa', '020', 10),
('00655', 'Tam Hiệp', 'Tam Hiep', 'Xã Tam Hiệp', 'Tam Hiep Commune', 'tam_hiep', '020', 10),
('00658', 'Tứ Hiệp', 'Tu Hiep', 'Xã Tứ Hiệp', 'Tu Hiep Commune', 'tu_hiep', '020', 10),
('00661', 'Yên Mỹ', 'Yen My', 'Xã Yên Mỹ', 'Yen My Commune', 'yen_my', '020', 10),
('00664', 'Vĩnh Quỳnh', 'Vinh Quynh', 'Xã Vĩnh Quỳnh', 'Vinh Quynh Commune', 'vinh_quynh', '020', 10),
('00667', 'Ngũ Hiệp', 'Ngu Hiep', 'Xã Ngũ Hiệp', 'Ngu Hiep Commune', 'ngu_hiep', '020', 10),
('00670', 'Duyên Hà', 'Duyen Ha', 'Xã Duyên Hà', 'Duyen Ha Commune', 'duyen_ha', '020', 10),
('00673', 'Ngọc Hồi', 'Ngoc Hoi', 'Xã Ngọc Hồi', 'Ngoc Hoi Commune', 'ngoc_hoi', '020', 10),
('00676', 'Vạn Phúc', 'Van Phuc', 'Xã Vạn Phúc', 'Van Phuc Commune', 'van_phuc', '020', 10),
('00679', 'Đại áng', 'Dai ang', 'Xã Đại áng', 'Dai ang Commune', 'dai_ang', '020', 10),
('00682', 'Liên Ninh', 'Lien Ninh', 'Xã Liên Ninh', 'Lien Ninh Commune', 'lien_ninh', '020', 10),
('00685', 'Đông Mỹ', 'Dong My', 'Xã Đông Mỹ', 'Dong My Commune', 'dong_my', '020', 10),
('00688', 'Quang Trung', 'Quang Trung', 'Phường Quang Trung', 'Quang Trung Ward', 'quang_trung', '024', 8),
('00691', 'Trần Phú', 'Tran Phu', 'Phường Trần Phú', 'Tran Phu Ward', 'tran_phu', '024', 8),
('00692', 'Ngọc Hà', 'Ngoc Ha', 'Phường Ngọc Hà', 'Ngoc Ha Ward', 'ngoc_ha', '024', 8),
('00694', 'Nguyễn Trãi', 'Nguyen Trai', 'Phường Nguyễn Trãi', 'Nguyen Trai Ward', 'nguyen_trai', '024', 8),
('00697', 'Minh Khai', 'Minh Khai', 'Phường Minh Khai', 'Minh Khai Ward', 'minh_khai', '024', 8),
('00700', 'Ngọc Đường', 'Ngoc Duong', 'Xã Ngọc Đường', 'Ngoc Duong Commune', 'ngoc_duong', '024', 10),
('00703', 'Kim Thạch', 'Kim Thach', 'Xã Kim Thạch', 'Kim Thach Commune', 'kim_thach', '030', 10),
('00706', 'Phú Linh', 'Phu Linh', 'Xã Phú Linh', 'Phu Linh Commune', 'phu_linh', '030', 10),
('00709', 'Kim Linh', 'Kim Linh', 'Xã Kim Linh', 'Kim Linh Commune', 'kim_linh', '030', 10),
('00712', 'Phó Bảng', 'Pho Bang', 'Thị trấn Phó Bảng', 'Pho Bang Township', 'pho_bang', '026', 9),
('00715', 'Lũng Cú', 'Lung Cu', 'Xã Lũng Cú', 'Lung Cu Commune', 'lung_cu', '026', 10),
('00718', 'Má Lé', 'Ma Le', 'Xã Má Lé', 'Ma Le Commune', 'ma_le', '026', 10),
('00721', 'Đồng Văn', 'Dong Van', 'Thị trấn Đồng Văn', 'Dong Van Township', 'dong_van', '026', 9),
('00724', 'Lũng Táo', 'Lung Tao', 'Xã Lũng Táo', 'Lung Tao Commune', 'lung_tao', '026', 10),
('00727', 'Phố Là', 'Pho La', 'Xã Phố Là', 'Pho La Commune', 'pho_la', '026', 10),
('00730', 'Thài Phìn Tủng', 'Thai Phin Tung', 'Xã Thài Phìn Tủng', 'Thai Phin Tung Commune', 'thai_phin_tung', '026', 10),
('00733', 'Sủng Là', 'Sung La', 'Xã Sủng Là', 'Sung La Commune', 'sung_la', '026', 10),
('00736', 'Xà Phìn', 'Xa Phin', 'Xã Xà Phìn', 'Xa Phin Commune', 'xa_phin', '026', 10),
('00739', 'Tả Phìn', 'Ta Phin', 'Xã Tả Phìn', 'Ta Phin Commune', 'ta_phin', '026', 10),
('00742', 'Tả Lủng', 'Ta Lung', 'Xã Tả Lủng', 'Ta Lung Commune', 'ta_lung', '026', 10),
('00745', 'Phố Cáo', 'Pho Cao', 'Xã Phố Cáo', 'Pho Cao Commune', 'pho_cao', '026', 10),
('00748', 'Sính Lủng', 'Sinh Lung', 'Xã Sính Lủng', 'Sinh Lung Commune', 'sinh_lung', '026', 10),
('00751', 'Sảng Tủng', 'Sang Tung', 'Xã Sảng Tủng', 'Sang Tung Commune', 'sang_tung', '026', 10),
('00754', 'Lũng Thầu', 'Lung Thau', 'Xã Lũng Thầu', 'Lung Thau Commune', 'lung_thau', '026', 10),
('00757', 'Hố Quáng Phìn', 'Ho Quang Phin', 'Xã Hố Quáng Phìn', 'Ho Quang Phin Commune', 'ho_quang_phin', '026', 10),
('00760', 'Vần Chải', 'Van Chai', 'Xã Vần Chải', 'Van Chai Commune', 'van_chai', '026', 10),
('00763', 'Lũng Phìn', 'Lung Phin', 'Xã Lũng Phìn', 'Lung Phin Commune', 'lung_phin', '026', 10),
('00766', 'Sủng Trái', 'Sung Trai', 'Xã Sủng Trái', 'Sung Trai Commune', 'sung_trai', '026', 10),
('00769', 'Mèo Vạc', 'Meo Vac', 'Thị trấn Mèo Vạc', 'Meo Vac Township', 'meo_vac', '027', 9),
('00772', 'Thượng Phùng', 'Thuong Phung', 'Xã Thượng Phùng', 'Thuong Phung Commune', 'thuong_phung', '027', 10),
('00775', 'Pải Lủng', 'Pai Lung', 'Xã Pải Lủng', 'Pai Lung Commune', 'pai_lung', '027', 10),
('00778', 'Xín Cái', 'Xin Cai', 'Xã Xín Cái', 'Xin Cai Commune', 'xin_cai', '027', 10),
('00781', 'Pả Vi', 'Pa Vi', 'Xã Pả Vi', 'Pa Vi Commune', 'pa_vi', '027', 10),
('00784', 'Giàng Chu Phìn', 'Giang Chu Phin', 'Xã Giàng Chu Phìn', 'Giang Chu Phin Commune', 'giang_chu_phin', '027', 10),
('00787', 'Sủng Trà', 'Sung Tra', 'Xã Sủng Trà', 'Sung Tra Commune', 'sung_tra', '027', 10),
('00790', 'Sủng Máng', 'Sung Mang', 'Xã Sủng Máng', 'Sung Mang Commune', 'sung_mang', '027', 10),
('00793', 'Sơn Vĩ', 'Son Vi', 'Xã Sơn Vĩ', 'Son Vi Commune', 'son_vi', '027', 10),
('00796', 'Tả Lủng', 'Ta Lung', 'Xã Tả Lủng', 'Ta Lung Commune', 'ta_lung', '027', 10),
('00799', 'Cán Chu Phìn', 'Can Chu Phin', 'Xã Cán Chu Phìn', 'Can Chu Phin Commune', 'can_chu_phin', '027', 10),
('00802', 'Lũng Pù', 'Lung Pu', 'Xã Lũng Pù', 'Lung Pu Commune', 'lung_pu', '027', 10),
('00805', 'Lũng Chinh', 'Lung Chinh', 'Xã Lũng Chinh', 'Lung Chinh Commune', 'lung_chinh', '027', 10),
('00808', 'Tát Ngà', 'Tat Nga', 'Xã Tát Ngà', 'Tat Nga Commune', 'tat_nga', '027', 10),
('00811', 'Nậm Ban', 'Nam Ban', 'Xã Nậm Ban', 'Nam Ban Commune', 'nam_ban', '027', 10),
('00814', 'Khâu Vai', 'Khau Vai', 'Xã Khâu Vai', 'Khau Vai Commune', 'khau_vai', '027', 10),
('00815', 'Niêm Tòng', 'Niem Tong', 'Xã Niêm Tòng', 'Niem Tong Commune', 'niem_tong', '027', 10),
('00817', 'Niêm Sơn', 'Niem Son', 'Xã Niêm Sơn', 'Niem Son Commune', 'niem_son', '027', 10),
('00820', 'Yên Minh', 'Yen Minh', 'Thị trấn Yên Minh', 'Yen Minh Township', 'yen_minh', '028', 9),
('00823', 'Thắng Mố', 'Thang Mo', 'Xã Thắng Mố', 'Thang Mo Commune', 'thang_mo', '028', 10),
('00826', 'Phú Lũng', 'Phu Lung', 'Xã Phú Lũng', 'Phu Lung Commune', 'phu_lung', '028', 10),
('00829', 'Sủng Tráng', 'Sung Trang', 'Xã Sủng Tráng', 'Sung Trang Commune', 'sung_trang', '028', 10),
('00832', 'Bạch Đích', 'Bach Dich', 'Xã Bạch Đích', 'Bach Dich Commune', 'bach_dich', '028', 10),
('00835', 'Na Khê', 'Na Khe', 'Xã Na Khê', 'Na Khe Commune', 'na_khe', '028', 10),
('00838', 'Sủng Thài', 'Sung Thai', 'Xã Sủng Thài', 'Sung Thai Commune', 'sung_thai', '028', 10),
('00841', 'Hữu Vinh', 'Huu Vinh', 'Xã Hữu Vinh', 'Huu Vinh Commune', 'huu_vinh', '028', 10),
('00844', 'Lao Và Chải', 'Lao Va Chai', 'Xã Lao Và Chải', 'Lao Va Chai Commune', 'lao_va_chai', '028', 10),
('00847', 'Mậu Duệ', 'Mau Due', 'Xã Mậu Duệ', 'Mau Due Commune', 'mau_due', '028', 10),
('00850', 'Đông Minh', 'Dong Minh', 'Xã Đông Minh', 'Dong Minh Commune', 'dong_minh', '028', 10),
('00853', 'Mậu Long', 'Mau Long', 'Xã Mậu Long', 'Mau Long Commune', 'mau_long', '028', 10),
('00856', 'Ngam La', 'Ngam La', 'Xã Ngam La', 'Ngam La Commune', 'ngam_la', '028', 10),
('00859', 'Ngọc Long', 'Ngoc Long', 'Xã Ngọc Long', 'Ngoc Long Commune', 'ngoc_long', '028', 10),
('00862', 'Đường Thượng', 'Duong Thuong', 'Xã Đường Thượng', 'Duong Thuong Commune', 'duong_thuong', '028', 10),
('00865', 'Lũng Hồ', 'Lung Ho', 'Xã Lũng Hồ', 'Lung Ho Commune', 'lung_ho', '028', 10),
('00868', 'Du Tiến', 'Du Tien', 'Xã Du Tiến', 'Du Tien Commune', 'du_tien', '028', 10),
('00871', 'Du Già', 'Du Gia', 'Xã Du Già', 'Du Gia Commune', 'du_gia', '028', 10),
('00874', 'Tam Sơn', 'Tam Son', 'Thị trấn Tam Sơn', 'Tam Son Township', 'tam_son', '029', 9),
('00877', 'Bát Đại Sơn', 'Bat Dai Son', 'Xã Bát Đại Sơn', 'Bat Dai Son Commune', 'bat_dai_son', '029', 10),
('00880', 'Nghĩa Thuận', 'Nghia Thuan', 'Xã Nghĩa Thuận', 'Nghia Thuan Commune', 'nghia_thuan', '029', 10),
('00883', 'Cán Tỷ', 'Can Ty', 'Xã Cán Tỷ', 'Can Ty Commune', 'can_ty', '029', 10),
('00886', 'Cao Mã Pờ', 'Cao Ma Po', 'Xã Cao Mã Pờ', 'Cao Ma Po Commune', 'cao_ma_po', '029', 10),
('00889', 'Thanh Vân', 'Thanh Van', 'Xã Thanh Vân', 'Thanh Van Commune', 'thanh_van', '029', 10),
('00892', 'Tùng Vài', 'Tung Vai', 'Xã Tùng Vài', 'Tung Vai Commune', 'tung_vai', '029', 10),
('00895', 'Đông Hà', 'Dong Ha', 'Xã Đông Hà', 'Dong Ha Commune', 'dong_ha', '029', 10),
('00898', 'Quản Bạ', 'Quan Ba', 'Xã Quản Bạ', 'Quan Ba Commune', 'quan_ba', '029', 10),
('00901', 'Lùng Tám', 'Lung Tam', 'Xã Lùng Tám', 'Lung Tam Commune', 'lung_tam', '029', 10),
('00904', 'Quyết Tiến', 'Quyet Tien', 'Xã Quyết Tiến', 'Quyet Tien Commune', 'quyet_tien', '029', 10),
('00907', 'Tả Ván', 'Ta Van', 'Xã Tả Ván', 'Ta Van Commune', 'ta_van', '029', 10),
('00910', 'Thái An', 'Thai An', 'Xã Thái An', 'Thai An Commune', 'thai_an', '029', 10),
('00913', 'Vị Xuyên', 'Vi Xuyen', 'Thị trấn Vị Xuyên', 'Vi Xuyen Township', 'vi_xuyen', '030', 9),
('00916', 'Nông Trường Việt Lâm', 'Nong Truong Viet Lam', 'Thị trấn Nông Trường Việt Lâm', 'Nong Truong Viet Lam Township', 'nong_truong_viet_lam', '030', 9),
('00919', 'Minh Tân', 'Minh Tan', 'Xã Minh Tân', 'Minh Tan Commune', 'minh_tan', '030', 10),
('00922', 'Thuận Hoà', 'Thuan Hoa', 'Xã Thuận Hoà', 'Thuan Hoa Commune', 'thuan_hoa', '030', 10),
('00925', 'Tùng Bá', 'Tung Ba', 'Xã Tùng Bá', 'Tung Ba Commune', 'tung_ba', '030', 10),
('00928', 'Thanh Thủy', 'Thanh Thuy', 'Xã Thanh Thủy', 'Thanh Thuy Commune', 'thanh_thuy', '030', 10),
('00931', 'Thanh Đức', 'Thanh Duc', 'Xã Thanh Đức', 'Thanh Duc Commune', 'thanh_duc', '030', 10),
('00934', 'Phong Quang', 'Phong Quang', 'Xã Phong Quang', 'Phong Quang Commune', 'phong_quang', '030', 10),
('00937', 'Xín Chải', 'Xin Chai', 'Xã Xín Chải', 'Xin Chai Commune', 'xin_chai', '030', 10),
('00940', 'Phương Tiến', 'Phuong Tien', 'Xã Phương Tiến', 'Phuong Tien Commune', 'phuong_tien', '030', 10),
('00943', 'Lao Chải', 'Lao Chai', 'Xã Lao Chải', 'Lao Chai Commune', 'lao_chai', '030', 10),
('00946', 'Phương Độ', 'Phuong Do', 'Xã Phương Độ', 'Phuong Do Commune', 'phuong_do', '024', 10),
('00949', 'Phương Thiện', 'Phuong Thien', 'Xã Phương Thiện', 'Phuong Thien Commune', 'phuong_thien', '024', 10),
('00952', 'Cao Bồ', 'Cao Bo', 'Xã Cao Bồ', 'Cao Bo Commune', 'cao_bo', '030', 10),
('00955', 'Đạo Đức', 'Dao Duc', 'Xã Đạo Đức', 'Dao Duc Commune', 'dao_duc', '030', 10),
('00958', 'Thượng Sơn', 'Thuong Son', 'Xã Thượng Sơn', 'Thuong Son Commune', 'thuong_son', '030', 10),
('00961', 'Linh Hồ', 'Linh Ho', 'Xã Linh Hồ', 'Linh Ho Commune', 'linh_ho', '030', 10),
('00964', 'Quảng Ngần', 'Quang Ngan', 'Xã Quảng Ngần', 'Quang Ngan Commune', 'quang_ngan', '030', 10),
('00967', 'Việt Lâm', 'Viet Lam', 'Xã Việt Lâm', 'Viet Lam Commune', 'viet_lam', '030', 10),
('00970', 'Ngọc Linh', 'Ngoc Linh', 'Xã Ngọc Linh', 'Ngoc Linh Commune', 'ngoc_linh', '030', 10),
('00973', 'Ngọc Minh', 'Ngoc Minh', 'Xã Ngọc Minh', 'Ngoc Minh Commune', 'ngoc_minh', '030', 10),
('00976', 'Bạch Ngọc', 'Bach Ngoc', 'Xã Bạch Ngọc', 'Bach Ngoc Commune', 'bach_ngoc', '030', 10),
('00979', 'Trung Thành', 'Trung Thanh', 'Xã Trung Thành', 'Trung Thanh Commune', 'trung_thanh', '030', 10),
('00982', 'Minh Sơn', 'Minh Son', 'Xã Minh Sơn', 'Minh Son Commune', 'minh_son', '031', 10),
('00985', 'Giáp Trung', 'Giap Trung', 'Xã Giáp Trung', 'Giap Trung Commune', 'giap_trung', '031', 10),
('00988', 'Yên Định', 'Yen Dinh', 'Xã Yên Định', 'Yen Dinh Commune', 'yen_dinh', '031', 10),
('00991', 'Yên Phú', 'Yen Phu', 'Thị trấn Yên Phú', 'Yen Phu Township', 'yen_phu', '031', 9),
('00994', 'Minh Ngọc', 'Minh Ngoc', 'Xã Minh Ngọc', 'Minh Ngoc Commune', 'minh_ngoc', '031', 10),
('00997', 'Yên Phong', 'Yen Phong', 'Xã Yên Phong', 'Yen Phong Commune', 'yen_phong', '031', 10),
('01000', 'Lạc Nông', 'Lac Nong', 'Xã Lạc Nông', 'Lac Nong Commune', 'lac_nong', '031', 10),
('01003', 'Phú Nam', 'Phu Nam', 'Xã Phú Nam', 'Phu Nam Commune', 'phu_nam', '031', 10),
('01006', 'Yên Cường', 'Yen Cuong', 'Xã Yên Cường', 'Yen Cuong Commune', 'yen_cuong', '031', 10),
('01009', 'Thượng Tân', 'Thuong Tan', 'Xã Thượng Tân', 'Thuong Tan Commune', 'thuong_tan', '031', 10),
('01012', 'Đường Âm', 'Duong Am', 'Xã Đường Âm', 'Duong Am Commune', 'duong_am', '031', 10),
('01015', 'Đường Hồng', 'Duong Hong', 'Xã Đường Hồng', 'Duong Hong Commune', 'duong_hong', '031', 10),
('01018', 'Phiêng Luông', 'Phieng Luong', 'Xã Phiêng Luông', 'Phieng Luong Commune', 'phieng_luong', '031', 10),
('01021', 'Vinh Quang', 'Vinh Quang', 'Thị trấn Vinh Quang', 'Vinh Quang Township', 'vinh_quang', '032', 9),
('01024', 'Bản Máy', 'Ban May', 'Xã Bản Máy', 'Ban May Commune', 'ban_may', '032', 10),
('01027', 'Thàng Tín', 'Thang Tin', 'Xã Thàng Tín', 'Thang Tin Commune', 'thang_tin', '032', 10),
('01030', 'Thèn Chu Phìn', 'Then Chu Phin', 'Xã Thèn Chu Phìn', 'Then Chu Phin Commune', 'then_chu_phin', '032', 10),
('01033', 'Pố Lồ', 'Po Lo', 'Xã Pố Lồ', 'Po Lo Commune', 'po_lo', '032', 10),
('01036', 'Bản Phùng', 'Ban Phung', 'Xã Bản Phùng', 'Ban Phung Commune', 'ban_phung', '032', 10),
('01039', 'Túng Sán', 'Tung San', 'Xã Túng Sán', 'Tung San Commune', 'tung_san', '032', 10),
('01042', 'Chiến Phố', 'Chien Pho', 'Xã Chiến Phố', 'Chien Pho Commune', 'chien_pho', '032', 10),
('01045', 'Đản Ván', 'Dan Van', 'Xã Đản Ván', 'Dan Van Commune', 'dan_van', '032', 10),
('01048', 'Tụ Nhân', 'Tu Nhan', 'Xã Tụ Nhân', 'Tu Nhan Commune', 'tu_nhan', '032', 10),
('01051', 'Tân Tiến', 'Tan Tien', 'Xã Tân Tiến', 'Tan Tien Commune', 'tan_tien', '032', 10),
('01054', 'Nàng Đôn', 'Nang Don', 'Xã Nàng Đôn', 'Nang Don Commune', 'nang_don', '032', 10),
('01057', 'Pờ Ly Ngài', 'Po Ly Ngai', 'Xã Pờ Ly Ngài', 'Po Ly Ngai Commune', 'po_ly_ngai', '032', 10),
('01060', 'Sán Xả Hồ', 'San Xa Ho', 'Xã Sán Xả Hồ', 'San Xa Ho Commune', 'san_xa_ho', '032', 10),
('01063', 'Bản Luốc', 'Ban Luoc', 'Xã Bản Luốc', 'Ban Luoc Commune', 'ban_luoc', '032', 10),
('01066', 'Ngàm Đăng Vài', 'Ngam Dang Vai', 'Xã Ngàm Đăng Vài', 'Ngam Dang Vai Commune', 'ngam_dang_vai', '032', 10),
('01069', 'Bản Nhùng', 'Ban Nhung', 'Xã Bản Nhùng', 'Ban Nhung Commune', 'ban_nhung', '032', 10),
('01072', 'Tả Sử Choóng', 'Ta Su Choong', 'Xã Tả Sử Choóng', 'Ta Su Choong Commune', 'ta_su_choong', '032', 10),
('01075', 'Nậm Dịch', 'Nam Dich', 'Xã Nậm Dịch', 'Nam Dich Commune', 'nam_dich', '032', 10),
('01081', 'Hồ Thầu', 'Ho Thau', 'Xã Hồ Thầu', 'Ho Thau Commune', 'ho_thau', '032', 10),
('01084', 'Nam Sơn', 'Nam Son', 'Xã Nam Sơn', 'Nam Son Commune', 'nam_son', '032', 10),
('01087', 'Nậm Tỵ', 'Nam Ty', 'Xã Nậm Tỵ', 'Nam Ty Commune', 'nam_ty', '032', 10),
('01090', 'Thông Nguyên', 'Thong Nguyen', 'Xã Thông Nguyên', 'Thong Nguyen Commune', 'thong_nguyen', '032', 10),
('01093', 'Nậm Khòa', 'Nam Khoa', 'Xã Nậm Khòa', 'Nam Khoa Commune', 'nam_khoa', '032', 10),
('01096', 'Cốc Pài', 'Coc Pai', 'Thị trấn Cốc Pài', 'Coc Pai Township', 'coc_pai', '033', 9),
('01099', 'Nàn Xỉn', 'Nan Xin', 'Xã Nàn Xỉn', 'Nan Xin Commune', 'nan_xin', '033', 10),
('01102', 'Bản Díu', 'Ban Diu', 'Xã Bản Díu', 'Ban Diu Commune', 'ban_diu', '033', 10),
('01105', 'Chí Cà', 'Chi Ca', 'Xã Chí Cà', 'Chi Ca Commune', 'chi_ca', '033', 10),
('01108', 'Xín Mần', 'Xin Man', 'Xã Xín Mần', 'Xin Man Commune', 'xin_man', '033', 10),
('01114', 'Thèn Phàng', 'Then Phang', 'Xã Thèn Phàng', 'Then Phang Commune', 'then_phang', '033', 10),
('01117', 'Trung Thịnh', 'Trung Thinh', 'Xã Trung Thịnh', 'Trung Thinh Commune', 'trung_thinh', '033', 10),
('01120', 'Pà Vầy Sủ', 'Pa Vay Su', 'Xã Pà Vầy Sủ', 'Pa Vay Su Commune', 'pa_vay_su', '033', 10),
('01123', 'Cốc Rế', 'Coc Re', 'Xã Cốc Rế', 'Coc Re Commune', 'coc_re', '033', 10),
('01126', 'Thu Tà', 'Thu Ta', 'Xã Thu Tà', 'Thu Ta Commune', 'thu_ta', '033', 10),
('01129', 'Nàn Ma', 'Nan Ma', 'Xã Nàn Ma', 'Nan Ma Commune', 'nan_ma', '033', 10),
('01132', 'Tả Nhìu', 'Ta Nhiu', 'Xã Tả Nhìu', 'Ta Nhiu Commune', 'ta_nhiu', '033', 10),
('01135', 'Bản Ngò', 'Ban Ngo', 'Xã Bản Ngò', 'Ban Ngo Commune', 'ban_ngo', '033', 10),
('01138', 'Chế Là', 'Che La', 'Xã Chế Là', 'Che La Commune', 'che_la', '033', 10),
('01141', 'Nấm Dẩn', 'Nam Dan', 'Xã Nấm Dẩn', 'Nam Dan Commune', 'nam_dan', '033', 10),
('01144', 'Quảng Nguyên', 'Quang Nguyen', 'Xã Quảng Nguyên', 'Quang Nguyen Commune', 'quang_nguyen', '033', 10),
('01147', 'Nà Chì', 'Na Chi', 'Xã Nà Chì', 'Na Chi Commune', 'na_chi', '033', 10),
('01150', 'Khuôn Lùng', 'Khuon Lung', 'Xã Khuôn Lùng', 'Khuon Lung Commune', 'khuon_lung', '033', 10),
('01153', 'Việt Quang', 'Viet Quang', 'Thị trấn Việt Quang', 'Viet Quang Township', 'viet_quang', '034', 9),
('01156', 'Vĩnh Tuy', 'Vinh Tuy', 'Thị trấn Vĩnh Tuy', 'Vinh Tuy Township', 'vinh_tuy', '034', 9),
('01159', 'Tân Lập', 'Tan Lap', 'Xã Tân Lập', 'Tan Lap Commune', 'tan_lap', '034', 10),
('01162', 'Tân Thành', 'Tan Thanh', 'Xã Tân Thành', 'Tan Thanh Commune', 'tan_thanh', '034', 10),
('01165', 'Đồng Tiến', 'Dong Tien', 'Xã Đồng Tiến', 'Dong Tien Commune', 'dong_tien', '034', 10),
('01168', 'Đồng Tâm', 'Dong Tam', 'Xã Đồng Tâm', 'Dong Tam Commune', 'dong_tam', '034', 10),
('01171', 'Tân Quang', 'Tan Quang', 'Xã Tân Quang', 'Tan Quang Commune', 'tan_quang', '034', 10),
('01174', 'Thượng Bình', 'Thuong Binh', 'Xã Thượng Bình', 'Thuong Binh Commune', 'thuong_binh', '034', 10),
('01177', 'Hữu Sản', 'Huu San', 'Xã Hữu Sản', 'Huu San Commune', 'huu_san', '034', 10),
('01180', 'Kim Ngọc', 'Kim Ngoc', 'Xã Kim Ngọc', 'Kim Ngoc Commune', 'kim_ngoc', '034', 10),
('01183', 'Việt Vinh', 'Viet Vinh', 'Xã Việt Vinh', 'Viet Vinh Commune', 'viet_vinh', '034', 10),
('01186', 'Bằng Hành', 'Bang Hanh', 'Xã Bằng Hành', 'Bang Hanh Commune', 'bang_hanh', '034', 10),
('01189', 'Quang Minh', 'Quang Minh', 'Xã Quang Minh', 'Quang Minh Commune', 'quang_minh', '034', 10),
('01192', 'Liên Hiệp', 'Lien Hiep', 'Xã Liên Hiệp', 'Lien Hiep Commune', 'lien_hiep', '034', 10),
('01195', 'Vô Điếm', 'Vo Diem', 'Xã Vô Điếm', 'Vo Diem Commune', 'vo_diem', '034', 10),
('01198', 'Việt Hồng', 'Viet Hong', 'Xã Việt Hồng', 'Viet Hong Commune', 'viet_hong', '034', 10),
('01201', 'Hùng An', 'Hung An', 'Xã Hùng An', 'Hung An Commune', 'hung_an', '034', 10),
('01204', 'Đức Xuân', 'Duc Xuan', 'Xã Đức Xuân', 'Duc Xuan Commune', 'duc_xuan', '034', 10),
('01207', 'Tiên Kiều', 'Tien Kieu', 'Xã Tiên Kiều', 'Tien Kieu Commune', 'tien_kieu', '034', 10),
('01210', 'Vĩnh Hảo', 'Vinh Hao', 'Xã Vĩnh Hảo', 'Vinh Hao Commune', 'vinh_hao', '034', 10),
('01213', 'Vĩnh Phúc', 'Vinh Phuc', 'Xã Vĩnh Phúc', 'Vinh Phuc Commune', 'vinh_phuc', '034', 10),
('01216', 'Đồng Yên', 'Dong Yen', 'Xã Đồng Yên', 'Dong Yen Commune', 'dong_yen', '034', 10),
('01219', 'Đông Thành', 'Dong Thanh', 'Xã Đông Thành', 'Dong Thanh Commune', 'dong_thanh', '034', 10),
('01222', 'Xuân Minh', 'Xuan Minh', 'Xã Xuân Minh', 'Xuan Minh Commune', 'xuan_minh', '035', 10),
('01225', 'Tiên Nguyên', 'Tien Nguyen', 'Xã Tiên Nguyên', 'Tien Nguyen Commune', 'tien_nguyen', '035', 10),
('01228', 'Tân Nam', 'Tan Nam', 'Xã Tân Nam', 'Tan Nam Commune', 'tan_nam', '035', 10),
('01231', 'Bản Rịa', 'Ban Ria', 'Xã Bản Rịa', 'Ban Ria Commune', 'ban_ria', '035', 10),
('01234', 'Yên Thành', 'Yen Thanh', 'Xã Yên Thành', 'Yen Thanh Commune', 'yen_thanh', '035', 10),
('01237', 'Yên Bình', 'Yen Binh', 'Thị trấn Yên Bình', 'Yen Binh Township', 'yen_binh', '035', 9),
('01240', 'Tân Trịnh', 'Tan Trinh', 'Xã Tân Trịnh', 'Tan Trinh Commune', 'tan_trinh', '035', 10),
('01243', 'Tân Bắc', 'Tan Bac', 'Xã Tân Bắc', 'Tan Bac Commune', 'tan_bac', '035', 10),
('01246', 'Bằng Lang', 'Bang Lang', 'Xã Bằng Lang', 'Bang Lang Commune', 'bang_lang', '035', 10),
('01249', 'Yên Hà', 'Yen Ha', 'Xã Yên Hà', 'Yen Ha Commune', 'yen_ha', '035', 10),
('01252', 'Hương Sơn', 'Huong Son', 'Xã Hương Sơn', 'Huong Son Commune', 'huong_son', '035', 10),
('01255', 'Xuân Giang', 'Xuan Giang', 'Xã Xuân Giang', 'Xuan Giang Commune', 'xuan_giang', '035', 10),
('01258', 'Nà Khương', 'Na Khuong', 'Xã Nà Khương', 'Na Khuong Commune', 'na_khuong', '035', 10),
('01261', 'Tiên Yên', 'Tien Yen', 'Xã Tiên Yên', 'Tien Yen Commune', 'tien_yen', '035', 10),
('01264', 'Vĩ Thượng', 'Vi Thuong', 'Xã Vĩ Thượng', 'Vi Thuong Commune', 'vi_thuong', '035', 10),
('01267', 'Sông Hiến', 'Song Hien', 'Phường Sông Hiến', 'Song Hien Ward', 'song_hien', '040', 8),
('01270', 'Sông Bằng', 'Song Bang', 'Phường Sông Bằng', 'Song Bang Ward', 'song_bang', '040', 8),
('01273', 'Hợp Giang', 'Hop Giang', 'Phường Hợp Giang', 'Hop Giang Ward', 'hop_giang', '040', 8),
('01276', 'Tân Giang', 'Tan Giang', 'Phường Tân Giang', 'Tan Giang Ward', 'tan_giang', '040', 8),
('01279', 'Ngọc Xuân', 'Ngoc Xuan', 'Phường Ngọc Xuân', 'Ngoc Xuan Ward', 'ngoc_xuan', '040', 8),
('01282', 'Đề Thám', 'De Tham', 'Phường Đề Thám', 'De Tham Ward', 'de_tham', '040', 8),
('01285', 'Hoà Chung', 'Hoa Chung', 'Phường Hoà Chung', 'Hoa Chung Ward', 'hoa_chung', '040', 8),
('01288', 'Duyệt Trung', 'Duyet Trung', 'Phường Duyệt Trung', 'Duyet Trung Ward', 'duyet_trung', '040', 8),
('01290', 'Pác Miầu', 'Pac Miau', 'Thị trấn Pác Miầu', 'Pac Miau Township', 'pac_miau', '042', 9),
('01291', 'Đức Hạnh', 'Duc Hanh', 'Xã Đức Hạnh', 'Duc Hanh Commune', 'duc_hanh', '042', 10),
('01294', 'Lý Bôn', 'Ly Bon', 'Xã Lý Bôn', 'Ly Bon Commune', 'ly_bon', '042', 10),
('01296', 'Nam Cao', 'Nam Cao', 'Xã Nam Cao', 'Nam Cao Commune', 'nam_cao', '042', 10),
('01297', 'Nam Quang', 'Nam Quang', 'Xã Nam Quang', 'Nam Quang Commune', 'nam_quang', '042', 10),
('01300', 'Vĩnh Quang', 'Vinh Quang', 'Xã Vĩnh Quang', 'Vinh Quang Commune', 'vinh_quang', '042', 10),
('01303', 'Quảng Lâm', 'Quang Lam', 'Xã Quảng Lâm', 'Quang Lam Commune', 'quang_lam', '042', 10),
('01304', 'Thạch Lâm', 'Thach Lam', 'Xã Thạch Lâm', 'Thach Lam Commune', 'thach_lam', '042', 10),
('01309', 'Vĩnh Phong', 'Vinh Phong', 'Xã Vĩnh Phong', 'Vinh Phong Commune', 'vinh_phong', '042', 10),
('01312', 'Mông Ân', 'Mong An', 'Xã Mông Ân', 'Mong An Commune', 'mong_an', '042', 10),
('01315', 'Thái Học', 'Thai Hoc', 'Xã Thái Học', 'Thai Hoc Commune', 'thai_hoc', '042', 10),
('01316', 'Thái Sơn', 'Thai Son', 'Xã Thái Sơn', 'Thai Son Commune', 'thai_son', '042', 10),
('01318', 'Yên Thổ', 'Yen Tho', 'Xã Yên Thổ', 'Yen Tho Commune', 'yen_tho', '042', 10),
('01321', 'Bảo Lạc', 'Bao Lac', 'Thị trấn Bảo Lạc', 'Bao Lac Township', 'bao_lac', '043', 9),
('01324', 'Cốc Pàng', 'Coc Pang', 'Xã Cốc Pàng', 'Coc Pang Commune', 'coc_pang', '043', 10),
('01327', 'Thượng Hà', 'Thuong Ha', 'Xã Thượng Hà', 'Thuong Ha Commune', 'thuong_ha', '043', 10),
('01330', 'Cô Ba', 'Co Ba', 'Xã Cô Ba', 'Co Ba Commune', 'co_ba', '043', 10),
('01333', 'Bảo Toàn', 'Bao Toan', 'Xã Bảo Toàn', 'Bao Toan Commune', 'bao_toan', '043', 10),
('01336', 'Khánh Xuân', 'Khanh Xuan', 'Xã Khánh Xuân', 'Khanh Xuan Commune', 'khanh_xuan', '043', 10),
('01339', 'Xuân Trường', 'Xuan Truong', 'Xã Xuân Trường', 'Xuan Truong Commune', 'xuan_truong', '043', 10),
('01342', 'Hồng Trị', 'Hong Tri', 'Xã Hồng Trị', 'Hong Tri Commune', 'hong_tri', '043', 10),
('01343', 'Kim Cúc', 'Kim Cuc', 'Xã Kim Cúc', 'Kim Cuc Commune', 'kim_cuc', '043', 10),
('01345', 'Phan Thanh', 'Phan Thanh', 'Xã Phan Thanh', 'Phan Thanh Commune', 'phan_thanh', '043', 10),
('01348', 'Hồng An', 'Hong An', 'Xã Hồng An', 'Hong An Commune', 'hong_an', '043', 10),
('01351', 'Hưng Đạo', 'Hung Dao', 'Xã Hưng Đạo', 'Hung Dao Commune', 'hung_dao', '043', 10),
('01352', 'Hưng Thịnh', 'Hung Thinh', 'Xã Hưng Thịnh', 'Hung Thinh Commune', 'hung_thinh', '043', 10),
('01354', 'Huy Giáp', 'Huy Giap', 'Xã Huy Giáp', 'Huy Giap Commune', 'huy_giap', '043', 10),
('01357', 'Đình Phùng', 'Dinh Phung', 'Xã Đình Phùng', 'Dinh Phung Commune', 'dinh_phung', '043', 10),
('01359', 'Sơn Lập', 'Son Lap', 'Xã Sơn Lập', 'Son Lap Commune', 'son_lap', '043', 10),
('01360', 'Sơn Lộ', 'Son Lo', 'Xã Sơn Lộ', 'Son Lo Commune', 'son_lo', '043', 10),
('01363', 'Thông Nông', 'Thong Nong', 'Thị trấn Thông Nông', 'Thong Nong Township', 'thong_nong', '045', 9),
('01366', 'Cần Yên', 'Can Yen', 'Xã Cần Yên', 'Can Yen Commune', 'can_yen', '045', 10),
('01367', 'Cần Nông', 'Can Nong', 'Xã Cần Nông', 'Can Nong Commune', 'can_nong', '045', 10),
('01372', 'Lương Thông', 'Luong Thong', 'Xã Lương Thông', 'Luong Thong Commune', 'luong_thong', '045', 10),
('01375', 'Đa Thông', 'Da Thong', 'Xã Đa Thông', 'Da Thong Commune', 'da_thong', '045', 10),
('01378', 'Ngọc Động', 'Ngoc Dong', 'Xã Ngọc Động', 'Ngoc Dong Commune', 'ngoc_dong', '045', 10),
('01381', 'Yên Sơn', 'Yen Son', 'Xã Yên Sơn', 'Yen Son Commune', 'yen_son', '045', 10),
('01384', 'Lương Can', 'Luong Can', 'Xã Lương Can', 'Luong Can Commune', 'luong_can', '045', 10),
('01387', 'Thanh Long', 'Thanh Long', 'Xã Thanh Long', 'Thanh Long Commune', 'thanh_long', '045', 10),
('01392', 'Xuân Hòa', 'Xuan Hoa', 'Thị trấn Xuân Hòa', 'Xuan Hoa Township', 'xuan_hoa', '045', 9),
('01393', 'Lũng Nặm', 'Lung Nam', 'Xã Lũng Nặm', 'Lung Nam Commune', 'lung_nam', '045', 10),
('01399', 'Trường Hà', 'Truong Ha', 'Xã Trường Hà', 'Truong Ha Commune', 'truong_ha', '045', 10),
('01402', 'Cải Viên', 'Cai Vien', 'Xã Cải Viên', 'Cai Vien Commune', 'cai_vien', '045', 10),
('01411', 'Nội Thôn', 'Noi Thon', 'Xã Nội Thôn', 'Noi Thon Commune', 'noi_thon', '045', 10),
('01414', 'Tổng Cọt', 'Tong Cot', 'Xã Tổng Cọt', 'Tong Cot Commune', 'tong_cot', '045', 10),
('01417', 'Sóc Hà', 'Soc Ha', 'Xã Sóc Hà', 'Soc Ha Commune', 'soc_ha', '045', 10),
('01420', 'Thượng Thôn', 'Thuong Thon', 'Xã Thượng Thôn', 'Thuong Thon Commune', 'thuong_thon', '045', 10),
('01429', 'Hồng Sỹ', 'Hong Sy', 'Xã Hồng Sỹ', 'Hong Sy Commune', 'hong_sy', '045', 10),
('01432', 'Quý Quân', 'Quy Quan', 'Xã Quý Quân', 'Quy Quan Commune', 'quy_quan', '045', 10),
('01435', 'Mã Ba', 'Ma Ba', 'Xã Mã Ba', 'Ma Ba Commune', 'ma_ba', '045', 10),
('01438', 'Ngọc Đào', 'Ngoc Dao', 'Xã Ngọc Đào', 'Ngoc Dao Commune', 'ngoc_dao', '045', 10),
('01447', 'Trà Lĩnh', 'Tra Linh', 'Thị trấn Trà Lĩnh', 'Tra Linh Township', 'tra_linh', '047', 9),
('01453', 'Tri Phương', 'Tri Phuong', 'Xã Tri Phương', 'Tri Phuong Commune', 'tri_phuong', '047', 10),
('01456', 'Quang Hán', 'Quang Han', 'Xã Quang Hán', 'Quang Han Commune', 'quang_han', '047', 10),
('01462', 'Xuân Nội', 'Xuan Noi', 'Xã Xuân Nội', 'Xuan Noi Commune', 'xuan_noi', '047', 10),
('01465', 'Quang Trung', 'Quang Trung', 'Xã Quang Trung', 'Quang Trung Commune', 'quang_trung', '047', 10),
('01468', 'Quang Vinh', 'Quang Vinh', 'Xã Quang Vinh', 'Quang Vinh Commune', 'quang_vinh', '047', 10),
('01471', 'Cao Chương', 'Cao Chuong', 'Xã Cao Chương', 'Cao Chuong Commune', 'cao_chuong', '047', 10),
('01474', 'Quốc Toản', 'Quoc Toan', 'Xã Quốc Toản', 'Quoc Toan Commune', 'quoc_toan', '049', 10),
('01477', 'Trùng Khánh', 'Trung Khanh', 'Thị trấn Trùng Khánh', 'Trung Khanh Township', 'trung_khanh', '047', 9),
('01480', 'Ngọc Khê', 'Ngoc Khe', 'Xã Ngọc Khê', 'Ngoc Khe Commune', 'ngoc_khe', '047', 10),
('01481', 'Ngọc Côn', 'Ngoc Con', 'Xã Ngọc Côn', 'Ngoc Con Commune', 'ngoc_con', '047', 10),
('01483', 'Phong Nậm', 'Phong Nam', 'Xã Phong Nậm', 'Phong Nam Commune', 'phong_nam', '047', 10),
('01489', 'Đình Phong', 'Dinh Phong', 'Xã Đình Phong', 'Dinh Phong Commune', 'dinh_phong', '047', 10),
('01495', 'Đàm Thuỷ', 'Dam Thuy', 'Xã Đàm Thuỷ', 'Dam Thuy Commune', 'dam_thuy', '047', 10),
('01498', 'Khâm Thành', 'Kham Thanh', 'Xã Khâm Thành', 'Kham Thanh Commune', 'kham_thanh', '047', 10),
('01501', 'Chí Viễn', 'Chi Vien', 'Xã Chí Viễn', 'Chi Vien Commune', 'chi_vien', '047', 10),
('01504', 'Lăng Hiếu', 'Lang Hieu', 'Xã Lăng Hiếu', 'Lang Hieu Commune', 'lang_hieu', '047', 10),
('01507', 'Phong Châu', 'Phong Chau', 'Xã Phong Châu', 'Phong Chau Commune', 'phong_chau', '047', 10),
('01516', 'Trung Phúc', 'Trung Phuc', 'Xã Trung Phúc', 'Trung Phuc Commune', 'trung_phuc', '047', 10),
('01519', 'Cao Thăng', 'Cao Thang', 'Xã Cao Thăng', 'Cao Thang Commune', 'cao_thang', '047', 10),
('01522', 'Đức Hồng', 'Duc Hong', 'Xã Đức Hồng', 'Duc Hong Commune', 'duc_hong', '047', 10),
('01525', 'Đoài Dương', 'Doai Duong', 'Xã Đoài Dương', 'Doai Duong Commune', 'doai_duong', '047', 10),
('01534', 'Minh Long', 'Minh Long', 'Xã Minh Long', 'Minh Long Commune', 'minh_long', '048', 10),
('01537', 'Lý Quốc', 'Ly Quoc', 'Xã Lý Quốc', 'Ly Quoc Commune', 'ly_quoc', '048', 10),
('01540', 'Thắng Lợi', 'Thang Loi', 'Xã Thắng Lợi', 'Thang Loi Commune', 'thang_loi', '048', 10),
('01543', 'Đồng Loan', 'Dong Loan', 'Xã Đồng Loan', 'Dong Loan Commune', 'dong_loan', '048', 10),
('01546', 'Đức Quang', 'Duc Quang', 'Xã Đức Quang', 'Duc Quang Commune', 'duc_quang', '048', 10),
('01549', 'Kim Loan', 'Kim Loan', 'Xã Kim Loan', 'Kim Loan Commune', 'kim_loan', '048', 10),
('01552', 'Quang Long', 'Quang Long', 'Xã Quang Long', 'Quang Long Commune', 'quang_long', '048', 10),
('01555', 'An Lạc', 'An Lac', 'Xã An Lạc', 'An Lac Commune', 'an_lac', '048', 10),
('01558', 'Thanh Nhật', 'Thanh Nhat', 'Thị trấn Thanh Nhật', 'Thanh Nhat Township', 'thanh_nhat', '048', 9),
('01561', 'Vinh Quý', 'Vinh Quy', 'Xã Vinh Quý', 'Vinh Quy Commune', 'vinh_quy', '048', 10),
('01564', 'Thống Nhất', 'Thong Nhat', 'Xã Thống Nhất', 'Thong Nhat Commune', 'thong_nhat', '048', 10),
('01567', 'Cô Ngân', 'Co Ngan', 'Xã Cô Ngân', 'Co Ngan Commune', 'co_ngan', '048', 10),
('01573', 'Thị Hoa', 'Thi Hoa', 'Xã Thị Hoa', 'Thi Hoa Commune', 'thi_hoa', '048', 10),
('01576', 'Quảng Uyên', 'Quang Uyen', 'Thị trấn Quảng Uyên', 'Quang Uyen Township', 'quang_uyen', '049', 9),
('01579', 'Phi Hải', 'Phi Hai', 'Xã Phi Hải', 'Phi Hai Commune', 'phi_hai', '049', 10),
('01582', 'Quảng Hưng', 'Quang Hung', 'Xã Quảng Hưng', 'Quang Hung Commune', 'quang_hung', '049', 10),
('01594', 'Độc Lập', 'Doc Lap', 'Xã Độc Lập', 'Doc Lap Commune', 'doc_lap', '049', 10),
('01597', 'Cai Bộ', 'Cai Bo', 'Xã Cai Bộ', 'Cai Bo Commune', 'cai_bo', '049', 10),
('01603', 'Phúc Sen', 'Phuc Sen', 'Xã Phúc Sen', 'Phuc Sen Commune', 'phuc_sen', '049', 10),
('01606', 'Chí Thảo', 'Chi Thao', 'Xã Chí Thảo', 'Chi Thao Commune', 'chi_thao', '049', 10),
('01609', 'Tự Do', 'Tu Do', 'Xã Tự Do', 'Tu Do Commune', 'tu_do', '049', 10),
('01615', 'Hồng Quang', 'Hong Quang', 'Xã Hồng Quang', 'Hong Quang Commune', 'hong_quang', '049', 10),
('01618', 'Ngọc Động', 'Ngoc Dong', 'Xã Ngọc Động', 'Ngoc Dong Commune', 'ngoc_dong', '049', 10),
('01624', 'Hạnh Phúc', 'Hanh Phuc', 'Xã Hạnh Phúc', 'Hanh Phuc Commune', 'hanh_phuc', '049', 10),
('01627', 'Tà Lùng', 'Ta Lung', 'Thị trấn Tà Lùng', 'Ta Lung Township', 'ta_lung', '049', 9),
('01630', 'Bế Văn Đàn', 'Be Van Dan', 'Xã Bế Văn Đàn', 'Be Van Dan Commune', 'be_van_dan', '049', 10),
('01636', 'Cách Linh', 'Cach Linh', 'Xã Cách Linh', 'Cach Linh Commune', 'cach_linh', '049', 10),
('01639', 'Đại Sơn', 'Dai Son', 'Xã Đại Sơn', 'Dai Son Commune', 'dai_son', '049', 10),
('01645', 'Tiên Thành', 'Tien Thanh', 'Xã Tiên Thành', 'Tien Thanh Commune', 'tien_thanh', '049', 10),
('01648', 'Hoà Thuận', 'Hoa Thuan', 'Thị trấn Hoà Thuận', 'Hoa Thuan Township', 'hoa_thuan', '049', 9),
('01651', 'Mỹ Hưng', 'My Hung', 'Xã Mỹ Hưng', 'My Hung Commune', 'my_hung', '049', 10),
('01654', 'Nước Hai', 'Nuoc Hai', 'Thị trấn Nước Hai', 'Nuoc Hai Township', 'nuoc_hai', '051', 9),
('01657', 'Dân Chủ', 'Dan Chu', 'Xã Dân Chủ', 'Dan Chu Commune', 'dan_chu', '051', 10),
('01660', 'Nam Tuấn', 'Nam Tuan', 'Xã Nam Tuấn', 'Nam Tuan Commune', 'nam_tuan', '051', 10);
INSERT INTO `phuong` (`code`, `name`, `name_en`, `full_name`, `full_name_en`, `code_name`, `district_code`, `administrative_unit_id`) VALUES
('01666', 'Đại Tiến', 'Dai Tien', 'Xã Đại Tiến', 'Dai Tien Commune', 'dai_tien', '051', 10),
('01669', 'Đức Long', 'Duc Long', 'Xã Đức Long', 'Duc Long Commune', 'duc_long', '051', 10),
('01672', 'Ngũ Lão', 'Ngu Lao', 'Xã Ngũ Lão', 'Ngu Lao Commune', 'ngu_lao', '051', 10),
('01675', 'Trương Lương', 'Truong Luong', 'Xã Trương Lương', 'Truong Luong Commune', 'truong_luong', '051', 10),
('01687', 'Hồng Việt', 'Hong Viet', 'Xã Hồng Việt', 'Hong Viet Commune', 'hong_viet', '051', 10),
('01693', 'Vĩnh Quang', 'Vinh Quang', 'Xã Vĩnh Quang', 'Vinh Quang Commune', 'vinh_quang', '040', 10),
('01696', 'Hoàng Tung', 'Hoang Tung', 'Xã Hoàng Tung', 'Hoang Tung Commune', 'hoang_tung', '051', 10),
('01699', 'Nguyễn Huệ', 'Nguyen Hue', 'Xã Nguyễn Huệ', 'Nguyen Hue Commune', 'nguyen_hue', '051', 10),
('01702', 'Quang Trung', 'Quang Trung', 'Xã Quang Trung', 'Quang Trung Commune', 'quang_trung', '051', 10),
('01705', 'Hưng Đạo', 'Hung Dao', 'Xã Hưng Đạo', 'Hung Dao Commune', 'hung_dao', '040', 10),
('01708', 'Bạch Đằng', 'Bach Dang', 'Xã Bạch Đằng', 'Bach Dang Commune', 'bach_dang', '051', 10),
('01711', 'Bình Dương', 'Binh Duong', 'Xã Bình Dương', 'Binh Duong Commune', 'binh_duong', '051', 10),
('01714', 'Lê Chung', 'Le Chung', 'Xã Lê Chung', 'Le Chung Commune', 'le_chung', '051', 10),
('01720', 'Chu Trinh', 'Chu Trinh', 'Xã Chu Trinh', 'Chu Trinh Commune', 'chu_trinh', '040', 10),
('01723', 'Hồng Nam', 'Hong Nam', 'Xã Hồng Nam', 'Hong Nam Commune', 'hong_nam', '051', 10),
('01726', 'Nguyên Bình', 'Nguyen Binh', 'Thị trấn Nguyên Bình', 'Nguyen Binh Township', 'nguyen_binh', '052', 9),
('01729', 'Tĩnh Túc', 'Tinh Tuc', 'Thị trấn Tĩnh Túc', 'Tinh Tuc Township', 'tinh_tuc', '052', 9),
('01732', 'Yên Lạc', 'Yen Lac', 'Xã Yên Lạc', 'Yen Lac Commune', 'yen_lac', '052', 10),
('01735', 'Triệu Nguyên', 'Trieu Nguyen', 'Xã Triệu Nguyên', 'Trieu Nguyen Commune', 'trieu_nguyen', '052', 10),
('01738', 'Ca Thành', 'Ca Thanh', 'Xã Ca Thành', 'Ca Thanh Commune', 'ca_thanh', '052', 10),
('01744', 'Vũ Nông', 'Vu Nong', 'Xã Vũ Nông', 'Vu Nong Commune', 'vu_nong', '052', 10),
('01747', 'Minh Tâm', 'Minh Tam', 'Xã Minh Tâm', 'Minh Tam Commune', 'minh_tam', '052', 10),
('01750', 'Thể Dục', 'The Duc', 'Xã Thể Dục', 'The Duc Commune', 'the_duc', '052', 10),
('01756', 'Mai Long', 'Mai Long', 'Xã Mai Long', 'Mai Long Commune', 'mai_long', '052', 10),
('01762', 'Vũ Minh', 'Vu Minh', 'Xã Vũ Minh', 'Vu Minh Commune', 'vu_minh', '052', 10),
('01765', 'Hoa Thám', 'Hoa Tham', 'Xã Hoa Thám', 'Hoa Tham Commune', 'hoa_tham', '052', 10),
('01768', 'Phan Thanh', 'Phan Thanh', 'Xã Phan Thanh', 'Phan Thanh Commune', 'phan_thanh', '052', 10),
('01771', 'Quang Thành', 'Quang Thanh', 'Xã Quang Thành', 'Quang Thanh Commune', 'quang_thanh', '052', 10),
('01774', 'Tam Kim', 'Tam Kim', 'Xã Tam Kim', 'Tam Kim Commune', 'tam_kim', '052', 10),
('01777', 'Thành Công', 'Thanh Cong', 'Xã Thành Công', 'Thanh Cong Commune', 'thanh_cong', '052', 10),
('01780', 'Thịnh Vượng', 'Thinh Vuong', 'Xã Thịnh Vượng', 'Thinh Vuong Commune', 'thinh_vuong', '052', 10),
('01783', 'Hưng Đạo', 'Hung Dao', 'Xã Hưng Đạo', 'Hung Dao Commune', 'hung_dao', '052', 10),
('01786', 'Đông Khê', 'Dong Khe', 'Thị trấn Đông Khê', 'Dong Khe Township', 'dong_khe', '053', 9),
('01789', 'Canh Tân', 'Canh Tan', 'Xã Canh Tân', 'Canh Tan Commune', 'canh_tan', '053', 10),
('01792', 'Kim Đồng', 'Kim Dong', 'Xã Kim Đồng', 'Kim Dong Commune', 'kim_dong', '053', 10),
('01795', 'Minh Khai', 'Minh Khai', 'Xã Minh Khai', 'Minh Khai Commune', 'minh_khai', '053', 10),
('01801', 'Đức Thông', 'Duc Thong', 'Xã Đức Thông', 'Duc Thong Commune', 'duc_thong', '053', 10),
('01804', 'Thái Cường', 'Thai Cuong', 'Xã Thái Cường', 'Thai Cuong Commune', 'thai_cuong', '053', 10),
('01807', 'Vân Trình', 'Van Trinh', 'Xã Vân Trình', 'Van Trinh Commune', 'van_trinh', '053', 10),
('01810', 'Thụy Hùng', 'Thuy Hung', 'Xã Thụy Hùng', 'Thuy Hung Commune', 'thuy_hung', '053', 10),
('01813', 'Quang Trọng', 'Quang Trong', 'Xã Quang Trọng', 'Quang Trong Commune', 'quang_trong', '053', 10),
('01816', 'Trọng Con', 'Trong Con', 'Xã Trọng Con', 'Trong Con Commune', 'trong_con', '053', 10),
('01819', 'Lê Lai', 'Le Lai', 'Xã Lê Lai', 'Le Lai Commune', 'le_lai', '053', 10),
('01822', 'Đức Long', 'Duc Long', 'Xã Đức Long', 'Duc Long Commune', 'duc_long', '053', 10),
('01828', 'Lê Lợi', 'Le Loi', 'Xã Lê Lợi', 'Le Loi Commune', 'le_loi', '053', 10),
('01831', 'Đức Xuân', 'Duc Xuan', 'Xã Đức Xuân', 'Duc Xuan Commune', 'duc_xuan', '053', 10),
('01834', 'Nguyễn Thị Minh Khai', 'Nguyen Thi Minh Khai', 'Phường Nguyễn Thị Minh Khai', 'Nguyen Thi Minh Khai Ward', 'nguyen_thi_minh_khai', '058', 8),
('01837', 'Sông Cầu', 'Song Cau', 'Phường Sông Cầu', 'Song Cau Ward', 'song_cau', '058', 8),
('01840', 'Đức Xuân', 'Duc Xuan', 'Phường Đức Xuân', 'Duc Xuan Ward', 'duc_xuan', '058', 8),
('01843', 'Phùng Chí Kiên', 'Phung Chi Kien', 'Phường Phùng Chí Kiên', 'Phung Chi Kien Ward', 'phung_chi_kien', '058', 8),
('01846', 'Huyền Tụng', 'Huyen Tung', 'Phường Huyền Tụng', 'Huyen Tung Ward', 'huyen_tung', '058', 8),
('01849', 'Dương Quang', 'Duong Quang', 'Xã Dương Quang', 'Duong Quang Commune', 'duong_quang', '058', 10),
('01852', 'Nông Thượng', 'Nong Thuong', 'Xã Nông Thượng', 'Nong Thuong Commune', 'nong_thuong', '058', 10),
('01855', 'Xuất Hóa', 'Xuat Hoa', 'Phường Xuất Hóa', 'Xuat Hoa Ward', 'xuat_hoa', '058', 8),
('01858', 'Bằng Thành', 'Bang Thanh', 'Xã Bằng Thành', 'Bang Thanh Commune', 'bang_thanh', '060', 10),
('01861', 'Nhạn Môn', 'Nhan Mon', 'Xã Nhạn Môn', 'Nhan Mon Commune', 'nhan_mon', '060', 10),
('01864', 'Bộc Bố', 'Boc Bo', 'Xã Bộc Bố', 'Boc Bo Commune', 'boc_bo', '060', 10),
('01867', 'Công Bằng', 'Cong Bang', 'Xã Công Bằng', 'Cong Bang Commune', 'cong_bang', '060', 10),
('01870', 'Giáo Hiệu', 'Giao Hieu', 'Xã Giáo Hiệu', 'Giao Hieu Commune', 'giao_hieu', '060', 10),
('01873', 'Xuân La', 'Xuan La', 'Xã Xuân La', 'Xuan La Commune', 'xuan_la', '060', 10),
('01876', 'An Thắng', 'An Thang', 'Xã An Thắng', 'An Thang Commune', 'an_thang', '060', 10),
('01879', 'Cổ Linh', 'Co Linh', 'Xã Cổ Linh', 'Co Linh Commune', 'co_linh', '060', 10),
('01882', 'Nghiên Loan', 'Nghien Loan', 'Xã Nghiên Loan', 'Nghien Loan Commune', 'nghien_loan', '060', 10),
('01885', 'Cao Tân', 'Cao Tan', 'Xã Cao Tân', 'Cao Tan Commune', 'cao_tan', '060', 10),
('01888', 'Chợ Rã', 'Cho Ra', 'Thị trấn Chợ Rã', 'Cho Ra Township', 'cho_ra', '061', 9),
('01891', 'Bành Trạch', 'Banh Trach', 'Xã Bành Trạch', 'Banh Trach Commune', 'banh_trach', '061', 10),
('01894', 'Phúc Lộc', 'Phuc Loc', 'Xã Phúc Lộc', 'Phuc Loc Commune', 'phuc_loc', '061', 10),
('01897', 'Hà Hiệu', 'Ha Hieu', 'Xã Hà Hiệu', 'Ha Hieu Commune', 'ha_hieu', '061', 10),
('01900', 'Cao Thượng', 'Cao Thuong', 'Xã Cao Thượng', 'Cao Thuong Commune', 'cao_thuong', '061', 10),
('01906', 'Khang Ninh', 'Khang Ninh', 'Xã Khang Ninh', 'Khang Ninh Commune', 'khang_ninh', '061', 10),
('01909', 'Nam Mẫu', 'Nam Mau', 'Xã Nam Mẫu', 'Nam Mau Commune', 'nam_mau', '061', 10),
('01912', 'Thượng Giáo', 'Thuong Giao', 'Xã Thượng Giáo', 'Thuong Giao Commune', 'thuong_giao', '061', 10),
('01915', 'Địa Linh', 'Dia Linh', 'Xã Địa Linh', 'Dia Linh Commune', 'dia_linh', '061', 10),
('01918', 'Yến Dương', 'Yen Duong', 'Xã Yến Dương', 'Yen Duong Commune', 'yen_duong', '061', 10),
('01921', 'Chu Hương', 'Chu Huong', 'Xã Chu Hương', 'Chu Huong Commune', 'chu_huong', '061', 10),
('01924', 'Quảng Khê', 'Quang Khe', 'Xã Quảng Khê', 'Quang Khe Commune', 'quang_khe', '061', 10),
('01927', 'Mỹ Phương', 'My Phuong', 'Xã Mỹ Phương', 'My Phuong Commune', 'my_phuong', '061', 10),
('01930', 'Hoàng Trĩ', 'Hoang Tri', 'Xã Hoàng Trĩ', 'Hoang Tri Commune', 'hoang_tri', '061', 10),
('01933', 'Đồng Phúc', 'Dong Phuc', 'Xã Đồng Phúc', 'Dong Phuc Commune', 'dong_phuc', '061', 10),
('01936', 'Nà Phặc', 'Na Phac', 'Thị trấn Nà Phặc', 'Na Phac Township', 'na_phac', '062', 9),
('01939', 'Thượng Ân', 'Thuong An', 'Xã Thượng Ân', 'Thuong An Commune', 'thuong_an', '062', 10),
('01942', 'Bằng Vân', 'Bang Van', 'Xã Bằng Vân', 'Bang Van Commune', 'bang_van', '062', 10),
('01945', 'Cốc Đán', 'Coc Dan', 'Xã Cốc Đán', 'Coc Dan Commune', 'coc_dan', '062', 10),
('01948', 'Trung Hoà', 'Trung Hoa', 'Xã Trung Hoà', 'Trung Hoa Commune', 'trung_hoa', '062', 10),
('01951', 'Đức Vân', 'Duc Van', 'Xã Đức Vân', 'Duc Van Commune', 'duc_van', '062', 10),
('01954', 'Vân Tùng', 'Van Tung', 'Thị trấn Vân Tùng', 'Van Tung Township', 'van_tung', '062', 9),
('01957', 'Thượng Quan', 'Thuong Quan', 'Xã Thượng Quan', 'Thuong Quan Commune', 'thuong_quan', '062', 10),
('01960', 'Hiệp Lực', 'Hiep Luc', 'Xã Hiệp Lực', 'Hiep Luc Commune', 'hiep_luc', '062', 10),
('01963', 'Thuần Mang', 'Thuan Mang', 'Xã Thuần Mang', 'Thuan Mang Commune', 'thuan_mang', '062', 10),
('01969', 'Phủ Thông', 'Phu Thong', 'Thị trấn Phủ Thông', 'Phu Thong Township', 'phu_thong', '063', 9),
('01975', 'Vi Hương', 'Vi Huong', 'Xã Vi Hương', 'Vi Huong Commune', 'vi_huong', '063', 10),
('01978', 'Sĩ Bình', 'Si Binh', 'Xã Sĩ Bình', 'Si Binh Commune', 'si_binh', '063', 10),
('01981', 'Vũ Muộn', 'Vu Muon', 'Xã Vũ Muộn', 'Vu Muon Commune', 'vu_muon', '063', 10),
('01984', 'Đôn Phong', 'Don Phong', 'Xã Đôn Phong', 'Don Phong Commune', 'don_phong', '063', 10),
('01990', 'Lục Bình', 'Luc Binh', 'Xã Lục Bình', 'Luc Binh Commune', 'luc_binh', '063', 10),
('01993', 'Tân Tú', 'Tan Tu', 'Xã Tân Tú', 'Tan Tu Commune', 'tan_tu', '063', 10),
('01999', 'Nguyên Phúc', 'Nguyen Phuc', 'Xã Nguyên Phúc', 'Nguyen Phuc Commune', 'nguyen_phuc', '063', 10),
('02002', 'Cao Sơn', 'Cao Son', 'Xã Cao Sơn', 'Cao Son Commune', 'cao_son', '063', 10),
('02005', 'Quân Hà', 'Quan Ha', 'Xã Quân Hà', 'Quan Ha Commune', 'quan_ha', '063', 10),
('02008', 'Cẩm Giàng', 'Cam Giang', 'Xã Cẩm Giàng', 'Cam Giang Commune', 'cam_giang', '063', 10),
('02011', 'Mỹ Thanh', 'My Thanh', 'Xã Mỹ Thanh', 'My Thanh Commune', 'my_thanh', '063', 10),
('02014', 'Dương Phong', 'Duong Phong', 'Xã Dương Phong', 'Duong Phong Commune', 'duong_phong', '063', 10),
('02017', 'Quang Thuận', 'Quang Thuan', 'Xã Quang Thuận', 'Quang Thuan Commune', 'quang_thuan', '063', 10),
('02020', 'Bằng Lũng', 'Bang Lung', 'Thị trấn Bằng Lũng', 'Bang Lung Township', 'bang_lung', '064', 9),
('02023', 'Xuân Lạc', 'Xuan Lac', 'Xã Xuân Lạc', 'Xuan Lac Commune', 'xuan_lac', '064', 10),
('02026', 'Nam Cường', 'Nam Cuong', 'Xã Nam Cường', 'Nam Cuong Commune', 'nam_cuong', '064', 10),
('02029', 'Đồng Lạc', 'Dong Lac', 'Xã Đồng Lạc', 'Dong Lac Commune', 'dong_lac', '064', 10),
('02032', 'Tân Lập', 'Tan Lap', 'Xã Tân Lập', 'Tan Lap Commune', 'tan_lap', '064', 10),
('02035', 'Bản Thi', 'Ban Thi', 'Xã Bản Thi', 'Ban Thi Commune', 'ban_thi', '064', 10),
('02038', 'Quảng Bạch', 'Quang Bach', 'Xã Quảng Bạch', 'Quang Bach Commune', 'quang_bach', '064', 10),
('02041', 'Bằng Phúc', 'Bang Phuc', 'Xã Bằng Phúc', 'Bang Phuc Commune', 'bang_phuc', '064', 10),
('02044', 'Yên Thịnh', 'Yen Thinh', 'Xã Yên Thịnh', 'Yen Thinh Commune', 'yen_thinh', '064', 10),
('02047', 'Yên Thượng', 'Yen Thuong', 'Xã Yên Thượng', 'Yen Thuong Commune', 'yen_thuong', '064', 10),
('02050', 'Phương Viên', 'Phuong Vien', 'Xã Phương Viên', 'Phuong Vien Commune', 'phuong_vien', '064', 10),
('02053', 'Ngọc Phái', 'Ngoc Phai', 'Xã Ngọc Phái', 'Ngoc Phai Commune', 'ngoc_phai', '064', 10),
('02059', 'Đồng Thắng', 'Dong Thang', 'Xã Đồng Thắng', 'Dong Thang Commune', 'dong_thang', '064', 10),
('02062', 'Lương Bằng', 'Luong Bang', 'Xã Lương Bằng', 'Luong Bang Commune', 'luong_bang', '064', 10),
('02065', 'Bằng Lãng', 'Bang Lang', 'Xã Bằng Lãng', 'Bang Lang Commune', 'bang_lang', '064', 10),
('02068', 'Đại Sảo', 'Dai Sao', 'Xã Đại Sảo', 'Dai Sao Commune', 'dai_sao', '064', 10),
('02071', 'Nghĩa Tá', 'Nghia Ta', 'Xã Nghĩa Tá', 'Nghia Ta Commune', 'nghia_ta', '064', 10),
('02077', 'Yên Mỹ', 'Yen My', 'Xã Yên Mỹ', 'Yen My Commune', 'yen_my', '064', 10),
('02080', 'Bình Trung', 'Binh Trung', 'Xã Bình Trung', 'Binh Trung Commune', 'binh_trung', '064', 10),
('02083', 'Yên Phong', 'Yen Phong', 'Xã Yên Phong', 'Yen Phong Commune', 'yen_phong', '064', 10),
('02086', 'Đồng Tâm', 'Dong Tam', 'Thị trấn Đồng Tâm', 'Dong Tam Township', 'dong_tam', '065', 9),
('02089', 'Tân Sơn', 'Tan Son', 'Xã Tân Sơn', 'Tan Son Commune', 'tan_son', '065', 10),
('02092', 'Thanh Vận', 'Thanh Van', 'Xã Thanh Vận', 'Thanh Van Commune', 'thanh_van', '065', 10),
('02095', 'Mai Lạp', 'Mai Lap', 'Xã Mai Lạp', 'Mai Lap Commune', 'mai_lap', '065', 10),
('02098', 'Hoà Mục', 'Hoa Muc', 'Xã Hoà Mục', 'Hoa Muc Commune', 'hoa_muc', '065', 10),
('02101', 'Thanh Mai', 'Thanh Mai', 'Xã Thanh Mai', 'Thanh Mai Commune', 'thanh_mai', '065', 10),
('02104', 'Cao Kỳ', 'Cao Ky', 'Xã Cao Kỳ', 'Cao Ky Commune', 'cao_ky', '065', 10),
('02107', 'Nông Hạ', 'Nong Ha', 'Xã Nông Hạ', 'Nong Ha Commune', 'nong_ha', '065', 10),
('02110', 'Yên Cư', 'Yen Cu', 'Xã Yên Cư', 'Yen Cu Commune', 'yen_cu', '065', 10),
('02113', 'Thanh Thịnh', 'Thanh Thinh', 'Xã Thanh Thịnh', 'Thanh Thinh Commune', 'thanh_thinh', '065', 10),
('02116', 'Yên Hân', 'Yen Han', 'Xã Yên Hân', 'Yen Han Commune', 'yen_han', '065', 10),
('02122', 'Như Cố', 'Nhu Co', 'Xã Như Cố', 'Nhu Co Commune', 'nhu_co', '065', 10),
('02125', 'Bình Văn', 'Binh Van', 'Xã Bình Văn', 'Binh Van Commune', 'binh_van', '065', 10),
('02131', 'Quảng Chu', 'Quang Chu', 'Xã Quảng Chu', 'Quang Chu Commune', 'quang_chu', '065', 10),
('02137', 'Văn Vũ', 'Van Vu', 'Xã Văn Vũ', 'Van Vu Commune', 'van_vu', '066', 10),
('02140', 'Văn Lang', 'Van Lang', 'Xã Văn Lang', 'Van Lang Commune', 'van_lang', '066', 10),
('02143', 'Lương Thượng', 'Luong Thuong', 'Xã Lương Thượng', 'Luong Thuong Commune', 'luong_thuong', '066', 10),
('02146', 'Kim Hỷ', 'Kim Hy', 'Xã Kim Hỷ', 'Kim Hy Commune', 'kim_hy', '066', 10),
('02152', 'Cường Lợi', 'Cuong Loi', 'Xã Cường Lợi', 'Cuong Loi Commune', 'cuong_loi', '066', 10),
('02155', 'Yến Lạc', 'Yen Lac', 'Thị trấn Yến Lạc', 'Yen Lac Township', 'yen_lac', '066', 9),
('02158', 'Kim Lư', 'Kim Lu', 'Xã Kim Lư', 'Kim Lu Commune', 'kim_lu', '066', 10),
('02161', 'Sơn Thành', 'Son Thanh', 'Xã Sơn Thành', 'Son Thanh Commune', 'son_thanh', '066', 10),
('02170', 'Văn Minh', 'Van Minh', 'Xã Văn Minh', 'Van Minh Commune', 'van_minh', '066', 10),
('02173', 'Côn Minh', 'Con Minh', 'Xã Côn Minh', 'Con Minh Commune', 'con_minh', '066', 10),
('02176', 'Cư Lễ', 'Cu Le', 'Xã Cư Lễ', 'Cu Le Commune', 'cu_le', '066', 10),
('02179', 'Trần Phú', 'Tran Phu', 'Xã Trần Phú', 'Tran Phu Commune', 'tran_phu', '066', 10),
('02185', 'Quang Phong', 'Quang Phong', 'Xã Quang Phong', 'Quang Phong Commune', 'quang_phong', '066', 10),
('02188', 'Dương Sơn', 'Duong Son', 'Xã Dương Sơn', 'Duong Son Commune', 'duong_son', '066', 10),
('02191', 'Xuân Dương', 'Xuan Duong', 'Xã Xuân Dương', 'Xuan Duong Commune', 'xuan_duong', '066', 10),
('02194', 'Đổng Xá', 'Dong Xa', 'Xã Đổng Xá', 'Dong Xa Commune', 'dong_xa', '066', 10),
('02197', 'Liêm Thuỷ', 'Liem Thuy', 'Xã Liêm Thuỷ', 'Liem Thuy Commune', 'liem_thuy', '066', 10),
('02200', 'Phan Thiết', 'Phan Thiet', 'Phường Phan Thiết', 'Phan Thiet Ward', 'phan_thiet', '070', 8),
('02203', 'Minh Xuân', 'Minh Xuan', 'Phường Minh Xuân', 'Minh Xuan Ward', 'minh_xuan', '070', 8),
('02206', 'Tân Quang', 'Tan Quang', 'Phường Tân Quang', 'Tan Quang Ward', 'tan_quang', '070', 8),
('02209', 'Tràng Đà', 'Trang Da', 'Xã Tràng Đà', 'Trang Da Commune', 'trang_da', '070', 10),
('02212', 'Nông Tiến', 'Nong Tien', 'Phường Nông Tiến', 'Nong Tien Ward', 'nong_tien', '070', 8),
('02215', 'Ỷ La', 'Y La', 'Phường Ỷ La', 'Y La Ward', 'y_la', '070', 8),
('02216', 'Tân Hà', 'Tan Ha', 'Phường Tân Hà', 'Tan Ha Ward', 'tan_ha', '070', 8),
('02218', 'Hưng Thành', 'Hung Thanh', 'Phường Hưng Thành', 'Hung Thanh Ward', 'hung_thanh', '070', 8),
('02221', 'Na Hang', 'Na Hang', 'Thị trấn Na Hang', 'Na Hang Township', 'na_hang', '072', 9),
('02227', 'Sinh Long', 'Sinh Long', 'Xã Sinh Long', 'Sinh Long Commune', 'sinh_long', '072', 10),
('02230', 'Thượng Giáp', 'Thuong Giap', 'Xã Thượng Giáp', 'Thuong Giap Commune', 'thuong_giap', '072', 10),
('02233', 'Phúc Yên', 'Phuc Yen', 'Xã Phúc Yên', 'Phuc Yen Commune', 'phuc_yen', '071', 10),
('02239', 'Thượng Nông', 'Thuong Nong', 'Xã Thượng Nông', 'Thuong Nong Commune', 'thuong_nong', '072', 10),
('02242', 'Xuân Lập', 'Xuan Lap', 'Xã Xuân Lập', 'Xuan Lap Commune', 'xuan_lap', '071', 10),
('02245', 'Côn Lôn', 'Con Lon', 'Xã Côn Lôn', 'Con Lon Commune', 'con_lon', '072', 10),
('02248', 'Yên Hoa', 'Yen Hoa', 'Xã Yên Hoa', 'Yen Hoa Commune', 'yen_hoa', '072', 10),
('02251', 'Khuôn Hà', 'Khuon Ha', 'Xã Khuôn Hà', 'Khuon Ha Commune', 'khuon_ha', '071', 10),
('02254', 'Hồng Thái', 'Hong Thai', 'Xã Hồng Thái', 'Hong Thai Commune', 'hong_thai', '072', 10),
('02260', 'Đà Vị', 'Da Vi', 'Xã Đà Vị', 'Da Vi Commune', 'da_vi', '072', 10),
('02263', 'Khau Tinh', 'Khau Tinh', 'Xã Khau Tinh', 'Khau Tinh Commune', 'khau_tinh', '072', 10),
('02266', 'Lăng Can', 'Lang Can', 'Thị trấn Lăng Can', 'Lang Can Township', 'lang_can', '071', 9),
('02269', 'Thượng Lâm', 'Thuong Lam', 'Xã Thượng Lâm', 'Thuong Lam Commune', 'thuong_lam', '071', 10),
('02275', 'Sơn Phú', 'Son Phu', 'Xã Sơn Phú', 'Son Phu Commune', 'son_phu', '072', 10),
('02281', 'Năng Khả', 'Nang Kha', 'Xã Năng Khả', 'Nang Kha Commune', 'nang_kha', '072', 10),
('02284', 'Thanh Tương', 'Thanh Tuong', 'Xã Thanh Tương', 'Thanh Tuong Commune', 'thanh_tuong', '072', 10),
('02287', 'Vĩnh Lộc', 'Vinh Loc', 'Thị trấn Vĩnh Lộc', 'Vinh Loc Township', 'vinh_loc', '073', 9),
('02290', 'Bình An', 'Binh An', 'Xã Bình An', 'Binh An Commune', 'binh_an', '071', 10),
('02293', 'Hồng Quang', 'Hong Quang', 'Xã Hồng Quang', 'Hong Quang Commune', 'hong_quang', '071', 10),
('02296', 'Thổ Bình', 'Tho Binh', 'Xã Thổ Bình', 'Tho Binh Commune', 'tho_binh', '071', 10),
('02299', 'Phúc Sơn', 'Phuc Son', 'Xã Phúc Sơn', 'Phuc Son Commune', 'phuc_son', '071', 10),
('02302', 'Minh Quang', 'Minh Quang', 'Xã Minh Quang', 'Minh Quang Commune', 'minh_quang', '071', 10),
('02305', 'Trung Hà', 'Trung Ha', 'Xã Trung Hà', 'Trung Ha Commune', 'trung_ha', '073', 10),
('02308', 'Tân Mỹ', 'Tan My', 'Xã Tân Mỹ', 'Tan My Commune', 'tan_my', '073', 10),
('02311', 'Hà Lang', 'Ha Lang', 'Xã Hà Lang', 'Ha Lang Commune', 'ha_lang', '073', 10),
('02314', 'Hùng Mỹ', 'Hung My', 'Xã Hùng Mỹ', 'Hung My Commune', 'hung_my', '073', 10),
('02317', 'Yên Lập', 'Yen Lap', 'Xã Yên Lập', 'Yen Lap Commune', 'yen_lap', '073', 10),
('02320', 'Tân An', 'Tan An', 'Xã Tân An', 'Tan An Commune', 'tan_an', '073', 10),
('02323', 'Bình Phú', 'Binh Phu', 'Xã Bình Phú', 'Binh Phu Commune', 'binh_phu', '073', 10),
('02326', 'Xuân Quang', 'Xuan Quang', 'Xã Xuân Quang', 'Xuan Quang Commune', 'xuan_quang', '073', 10),
('02329', 'Ngọc Hội', 'Ngoc Hoi', 'Xã Ngọc Hội', 'Ngoc Hoi Commune', 'ngoc_hoi', '073', 10),
('02332', 'Phú Bình', 'Phu Binh', 'Xã Phú Bình', 'Phu Binh Commune', 'phu_binh', '073', 10),
('02335', 'Hòa Phú', 'Hoa Phu', 'Xã Hòa Phú', 'Hoa Phu Commune', 'hoa_phu', '073', 10),
('02338', 'Phúc Thịnh', 'Phuc Thinh', 'Xã Phúc Thịnh', 'Phuc Thinh Commune', 'phuc_thinh', '073', 10),
('02341', 'Kiên Đài', 'Kien Dai', 'Xã Kiên Đài', 'Kien Dai Commune', 'kien_dai', '073', 10),
('02344', 'Tân Thịnh', 'Tan Thinh', 'Xã Tân Thịnh', 'Tan Thinh Commune', 'tan_thinh', '073', 10),
('02347', 'Trung Hòa', 'Trung Hoa', 'Xã Trung Hòa', 'Trung Hoa Commune', 'trung_hoa', '073', 10),
('02350', 'Kim Bình', 'Kim Binh', 'Xã Kim Bình', 'Kim Binh Commune', 'kim_binh', '073', 10),
('02353', 'Hòa An', 'Hoa An', 'Xã Hòa An', 'Hoa An Commune', 'hoa_an', '073', 10),
('02356', 'Vinh Quang', 'Vinh Quang', 'Xã Vinh Quang', 'Vinh Quang Commune', 'vinh_quang', '073', 10),
('02359', 'Tri Phú', 'Tri Phu', 'Xã Tri Phú', 'Tri Phu Commune', 'tri_phu', '073', 10),
('02362', 'Nhân Lý', 'Nhan Ly', 'Xã Nhân Lý', 'Nhan Ly Commune', 'nhan_ly', '073', 10),
('02365', 'Yên Nguyên', 'Yen Nguyen', 'Xã Yên Nguyên', 'Yen Nguyen Commune', 'yen_nguyen', '073', 10),
('02368', 'Linh Phú', 'Linh Phu', 'Xã Linh Phú', 'Linh Phu Commune', 'linh_phu', '073', 10),
('02371', 'Bình Nhân', 'Binh Nhan', 'Xã Bình Nhân', 'Binh Nhan Commune', 'binh_nhan', '073', 10),
('02374', 'Tân Yên', 'Tan Yen', 'Thị trấn Tân Yên', 'Tan Yen Township', 'tan_yen', '074', 9),
('02377', 'Yên Thuận', 'Yen Thuan', 'Xã Yên Thuận', 'Yen Thuan Commune', 'yen_thuan', '074', 10),
('02380', 'Bạch Xa', 'Bach Xa', 'Xã Bạch Xa', 'Bach Xa Commune', 'bach_xa', '074', 10),
('02383', 'Minh Khương', 'Minh Khuong', 'Xã Minh Khương', 'Minh Khuong Commune', 'minh_khuong', '074', 10),
('02386', 'Yên Lâm', 'Yen Lam', 'Xã Yên Lâm', 'Yen Lam Commune', 'yen_lam', '074', 10),
('02389', 'Minh Dân', 'Minh Dan', 'Xã Minh Dân', 'Minh Dan Commune', 'minh_dan', '074', 10),
('02392', 'Phù Lưu', 'Phu Luu', 'Xã Phù Lưu', 'Phu Luu Commune', 'phu_luu', '074', 10),
('02395', 'Minh Hương', 'Minh Huong', 'Xã Minh Hương', 'Minh Huong Commune', 'minh_huong', '074', 10),
('02398', 'Yên Phú', 'Yen Phu', 'Xã Yên Phú', 'Yen Phu Commune', 'yen_phu', '074', 10),
('02401', 'Tân Thành', 'Tan Thanh', 'Xã Tân Thành', 'Tan Thanh Commune', 'tan_thanh', '074', 10),
('02404', 'Bình Xa', 'Binh Xa', 'Xã Bình Xa', 'Binh Xa Commune', 'binh_xa', '074', 10),
('02407', 'Thái Sơn', 'Thai Son', 'Xã Thái Sơn', 'Thai Son Commune', 'thai_son', '074', 10),
('02410', 'Nhân Mục', 'Nhan Muc', 'Xã Nhân Mục', 'Nhan Muc Commune', 'nhan_muc', '074', 10),
('02413', 'Thành Long', 'Thanh Long', 'Xã Thành Long', 'Thanh Long Commune', 'thanh_long', '074', 10),
('02416', 'Bằng Cốc', 'Bang Coc', 'Xã Bằng Cốc', 'Bang Coc Commune', 'bang_coc', '074', 10),
('02419', 'Thái Hòa', 'Thai Hoa', 'Xã Thái Hòa', 'Thai Hoa Commune', 'thai_hoa', '074', 10),
('02422', 'Đức Ninh', 'Duc Ninh', 'Xã Đức Ninh', 'Duc Ninh Commune', 'duc_ninh', '074', 10),
('02425', 'Hùng Đức', 'Hung Duc', 'Xã Hùng Đức', 'Hung Duc Commune', 'hung_duc', '074', 10),
('02431', 'Quí Quân', 'Qui Quan', 'Xã Quí Quân', 'Qui Quan Commune', 'qui_quan', '075', 10),
('02434', 'Lực Hành', 'Luc Hanh', 'Xã Lực Hành', 'Luc Hanh Commune', 'luc_hanh', '075', 10),
('02437', 'Kiến Thiết', 'Kien Thiet', 'Xã Kiến Thiết', 'Kien Thiet Commune', 'kien_thiet', '075', 10),
('02440', 'Trung Minh', 'Trung Minh', 'Xã Trung Minh', 'Trung Minh Commune', 'trung_minh', '075', 10),
('02443', 'Chiêu Yên', 'Chieu Yen', 'Xã Chiêu Yên', 'Chieu Yen Commune', 'chieu_yen', '075', 10),
('02446', 'Trung Trực', 'Trung Truc', 'Xã Trung Trực', 'Trung Truc Commune', 'trung_truc', '075', 10),
('02449', 'Xuân Vân', 'Xuan Van', 'Xã Xuân Vân', 'Xuan Van Commune', 'xuan_van', '075', 10),
('02452', 'Phúc Ninh', 'Phuc Ninh', 'Xã Phúc Ninh', 'Phuc Ninh Commune', 'phuc_ninh', '075', 10),
('02455', 'Hùng Lợi', 'Hung Loi', 'Xã Hùng Lợi', 'Hung Loi Commune', 'hung_loi', '075', 10),
('02458', 'Trung Sơn', 'Trung Son', 'Xã Trung Sơn', 'Trung Son Commune', 'trung_son', '075', 10),
('02461', 'Tân Tiến', 'Tan Tien', 'Xã Tân Tiến', 'Tan Tien Commune', 'tan_tien', '075', 10),
('02464', 'Tứ Quận', 'Tu Quan', 'Xã Tứ Quận', 'Tu Quan Commune', 'tu_quan', '075', 10),
('02467', 'Đạo Viện', 'Dao Vien', 'Xã Đạo Viện', 'Dao Vien Commune', 'dao_vien', '075', 10),
('02470', 'Tân Long', 'Tan Long', 'Xã Tân Long', 'Tan Long Commune', 'tan_long', '075', 10),
('02473', 'Yên Sơn', 'Yen Son', 'Thị trấn Yên Sơn', 'Yen Son Township', 'yen_son', '075', 9),
('02476', 'Kim Quan', 'Kim Quan', 'Xã Kim Quan', 'Kim Quan Commune', 'kim_quan', '075', 10),
('02479', 'Lang Quán', 'Lang Quan', 'Xã Lang Quán', 'Lang Quan Commune', 'lang_quan', '075', 10),
('02482', 'Phú Thịnh', 'Phu Thinh', 'Xã Phú Thịnh', 'Phu Thinh Commune', 'phu_thinh', '075', 10),
('02485', 'Công Đa', 'Cong Da', 'Xã Công Đa', 'Cong Da Commune', 'cong_da', '075', 10),
('02488', 'Trung Môn', 'Trung Mon', 'Xã Trung Môn', 'Trung Mon Commune', 'trung_mon', '075', 10),
('02491', 'Chân Sơn', 'Chan Son', 'Xã Chân Sơn', 'Chan Son Commune', 'chan_son', '075', 10),
('02494', 'Thái Bình', 'Thai Binh', 'Xã Thái Bình', 'Thai Binh Commune', 'thai_binh', '075', 10),
('02497', 'Kim Phú', 'Kim Phu', 'Xã Kim Phú', 'Kim Phu Commune', 'kim_phu', '070', 10),
('02500', 'Tiến Bộ', 'Tien Bo', 'Xã Tiến Bộ', 'Tien Bo Commune', 'tien_bo', '075', 10),
('02503', 'An Khang', 'An Khang', 'Xã An Khang', 'An Khang Commune', 'an_khang', '070', 10),
('02506', 'Mỹ Bằng', 'My Bang', 'Xã Mỹ Bằng', 'My Bang Commune', 'my_bang', '075', 10),
('02509', 'Mỹ Lâm', 'My Lam', 'Phường Mỹ Lâm', 'My Lam Ward', 'my_lam', '070', 8),
('02512', 'An Tường', 'An Tuong', 'Phường An Tường', 'An Tuong Ward', 'an_tuong', '070', 8),
('02515', 'Lưỡng Vượng', 'Luong Vuong', 'Xã Lưỡng Vượng', 'Luong Vuong Commune', 'luong_vuong', '070', 10),
('02518', 'Hoàng Khai', 'Hoang Khai', 'Xã Hoàng Khai', 'Hoang Khai Commune', 'hoang_khai', '075', 10),
('02521', 'Thái Long', 'Thai Long', 'Xã Thái Long', 'Thai Long Commune', 'thai_long', '070', 10),
('02524', 'Đội Cấn', 'Doi Can', 'Phường Đội Cấn', 'Doi Can Ward', 'doi_can', '070', 8),
('02527', 'Nhữ Hán', 'Nhu Han', 'Xã Nhữ Hán', 'Nhu Han Commune', 'nhu_han', '075', 10),
('02530', 'Nhữ Khê', 'Nhu Khe', 'Xã Nhữ Khê', 'Nhu Khe Commune', 'nhu_khe', '075', 10),
('02533', 'Đội Bình', 'Doi Binh', 'Xã Đội Bình', 'Doi Binh Commune', 'doi_binh', '075', 10),
('02536', 'Sơn Dương', 'Son Duong', 'Thị trấn Sơn Dương', 'Son Duong Township', 'son_duong', '076', 9),
('02539', 'Trung Yên', 'Trung Yen', 'Xã Trung Yên', 'Trung Yen Commune', 'trung_yen', '076', 10),
('02542', 'Minh Thanh', 'Minh Thanh', 'Xã Minh Thanh', 'Minh Thanh Commune', 'minh_thanh', '076', 10),
('02545', 'Tân Trào', 'Tan Trao', 'Xã Tân Trào', 'Tan Trao Commune', 'tan_trao', '076', 10),
('02548', 'Vĩnh Lợi', 'Vinh Loi', 'Xã Vĩnh Lợi', 'Vinh Loi Commune', 'vinh_loi', '076', 10),
('02551', 'Thượng Ấm', 'Thuong Am', 'Xã Thượng Ấm', 'Thuong Am Commune', 'thuong_am', '076', 10),
('02554', 'Bình Yên', 'Binh Yen', 'Xã Bình Yên', 'Binh Yen Commune', 'binh_yen', '076', 10),
('02557', 'Lương Thiện', 'Luong Thien', 'Xã Lương Thiện', 'Luong Thien Commune', 'luong_thien', '076', 10),
('02560', 'Tú Thịnh', 'Tu Thinh', 'Xã Tú Thịnh', 'Tu Thinh Commune', 'tu_thinh', '076', 10),
('02563', 'Cấp Tiến', 'Cap Tien', 'Xã Cấp Tiến', 'Cap Tien Commune', 'cap_tien', '076', 10),
('02566', 'Hợp Thành', 'Hop Thanh', 'Xã Hợp Thành', 'Hop Thanh Commune', 'hop_thanh', '076', 10),
('02569', 'Phúc Ứng', 'Phuc Ung', 'Xã Phúc Ứng', 'Phuc Ung Commune', 'phuc_ung', '076', 10),
('02572', 'Đông Thọ', 'Dong Tho', 'Xã Đông Thọ', 'Dong Tho Commune', 'dong_tho', '076', 10),
('02575', 'Kháng Nhật', 'Khang Nhat', 'Xã Kháng Nhật', 'Khang Nhat Commune', 'khang_nhat', '076', 10),
('02578', 'Hợp Hòa', 'Hop Hoa', 'Xã Hợp Hòa', 'Hop Hoa Commune', 'hop_hoa', '076', 10),
('02584', 'Quyết Thắng', 'Quyet Thang', 'Xã Quyết Thắng', 'Quyet Thang Commune', 'quyet_thang', '076', 10),
('02587', 'Đồng Quý', 'Dong Quy', 'Xã Đồng Quý', 'Dong Quy Commune', 'dong_quy', '076', 10),
('02590', 'Tân Thanh', 'Tan Thanh', 'Xã Tân Thanh', 'Tan Thanh Commune', 'tan_thanh', '076', 10),
('02596', 'Văn Phú', 'Van Phu', 'Xã Văn Phú', 'Van Phu Commune', 'van_phu', '076', 10),
('02599', 'Chi Thiết', 'Chi Thiet', 'Xã Chi Thiết', 'Chi Thiet Commune', 'chi_thiet', '076', 10),
('02602', 'Đông Lợi', 'Dong Loi', 'Xã Đông Lợi', 'Dong Loi Commune', 'dong_loi', '076', 10),
('02605', 'Thiện Kế', 'Thien Ke', 'Xã Thiện Kế', 'Thien Ke Commune', 'thien_ke', '076', 10),
('02608', 'Hồng Sơn', 'Hong Son', 'Xã Hồng Sơn', 'Hong Son Commune', 'hong_son', '076', 10),
('02611', 'Phú Lương', 'Phu Luong', 'Xã Phú Lương', 'Phu Luong Commune', 'phu_luong', '076', 10),
('02614', 'Ninh Lai', 'Ninh Lai', 'Xã Ninh Lai', 'Ninh Lai Commune', 'ninh_lai', '076', 10),
('02617', 'Đại Phú', 'Dai Phu', 'Xã Đại Phú', 'Dai Phu Commune', 'dai_phu', '076', 10),
('02620', 'Sơn Nam', 'Son Nam', 'Xã Sơn Nam', 'Son Nam Commune', 'son_nam', '076', 10),
('02623', 'Hào Phú', 'Hao Phu', 'Xã Hào Phú', 'Hao Phu Commune', 'hao_phu', '076', 10),
('02626', 'Tam Đa', 'Tam Da', 'Xã Tam Đa', 'Tam Da Commune', 'tam_da', '076', 10),
('02632', 'Trường Sinh', 'Truong Sinh', 'Xã Trường Sinh', 'Truong Sinh Commune', 'truong_sinh', '076', 10),
('02635', 'Duyên Hải', 'Duyen Hai', 'Phường Duyên Hải', 'Duyen Hai Ward', 'duyen_hai', '080', 8),
('02641', 'Lào Cai', 'Lao Cai', 'Phường Lào Cai', 'Lao Cai Ward', 'lao_cai', '080', 8),
('02644', 'Cốc Lếu', 'Coc Leu', 'Phường Cốc Lếu', 'Coc Leu Ward', 'coc_leu', '080', 8),
('02647', 'Kim Tân', 'Kim Tan', 'Phường Kim Tân', 'Kim Tan Ward', 'kim_tan', '080', 8),
('02650', 'Bắc Lệnh', 'Bac Lenh', 'Phường Bắc Lệnh', 'Bac Lenh Ward', 'bac_lenh', '080', 8),
('02653', 'Pom Hán', 'Pom Han', 'Phường Pom Hán', 'Pom Han Ward', 'pom_han', '080', 8),
('02656', 'Xuân Tăng', 'Xuan Tang', 'Phường Xuân Tăng', 'Xuan Tang Ward', 'xuan_tang', '080', 8),
('02658', 'Bình Minh', 'Binh Minh', 'Phường Bình Minh', 'Binh Minh Ward', 'binh_minh', '080', 8),
('02659', 'Thống Nhất', 'Thong Nhat', 'Xã Thống Nhất', 'Thong Nhat Commune', 'thong_nhat', '080', 10),
('02662', 'Đồng Tuyển', 'Dong Tuyen', 'Xã Đồng Tuyển', 'Dong Tuyen Commune', 'dong_tuyen', '080', 10),
('02665', 'Vạn Hoà', 'Van Hoa', 'Xã Vạn Hoà', 'Van Hoa Commune', 'van_hoa', '080', 10),
('02668', 'Bắc Cường', 'Bac Cuong', 'Phường Bắc Cường', 'Bac Cuong Ward', 'bac_cuong', '080', 8),
('02671', 'Nam Cường', 'Nam Cuong', 'Phường Nam Cường', 'Nam Cuong Ward', 'nam_cuong', '080', 8),
('02674', 'Cam Đường', 'Cam Duong', 'Xã Cam Đường', 'Cam Duong Commune', 'cam_duong', '080', 10),
('02677', 'Tả Phời', 'Ta Phoi', 'Xã Tả Phời', 'Ta Phoi Commune', 'ta_phoi', '080', 10),
('02680', 'Hợp Thành', 'Hop Thanh', 'Xã Hợp Thành', 'Hop Thanh Commune', 'hop_thanh', '080', 10),
('02683', 'Bát Xát', 'Bat Xat', 'Thị trấn Bát Xát', 'Bat Xat Township', 'bat_xat', '082', 9),
('02686', 'A Mú Sung', 'A Mu Sung', 'Xã A Mú Sung', 'A Mu Sung Commune', 'a_mu_sung', '082', 10),
('02689', 'Nậm Chạc', 'Nam Chac', 'Xã Nậm Chạc', 'Nam Chac Commune', 'nam_chac', '082', 10),
('02692', 'A Lù', 'A Lu', 'Xã A Lù', 'A Lu Commune', 'a_lu', '082', 10),
('02695', 'Trịnh Tường', 'Trinh Tuong', 'Xã Trịnh Tường', 'Trinh Tuong Commune', 'trinh_tuong', '082', 10),
('02701', 'Y Tý', 'Y Ty', 'Xã Y Tý', 'Y Ty Commune', 'y_ty', '082', 10),
('02704', 'Cốc Mỳ', 'Coc My', 'Xã Cốc Mỳ', 'Coc My Commune', 'coc_my', '082', 10),
('02707', 'Dền Sáng', 'Den Sang', 'Xã Dền Sáng', 'Den Sang Commune', 'den_sang', '082', 10),
('02710', 'Bản Vược', 'Ban Vuoc', 'Xã Bản Vược', 'Ban Vuoc Commune', 'ban_vuoc', '082', 10),
('02713', 'Sàng Ma Sáo', 'Sang Ma Sao', 'Xã Sàng Ma Sáo', 'Sang Ma Sao Commune', 'sang_ma_sao', '082', 10),
('02716', 'Bản Qua', 'Ban Qua', 'Xã Bản Qua', 'Ban Qua Commune', 'ban_qua', '082', 10),
('02719', 'Mường Vi', 'Muong Vi', 'Xã Mường Vi', 'Muong Vi Commune', 'muong_vi', '082', 10),
('02722', 'Dền Thàng', 'Den Thang', 'Xã Dền Thàng', 'Den Thang Commune', 'den_thang', '082', 10),
('02725', 'Bản Xèo', 'Ban Xeo', 'Xã Bản Xèo', 'Ban Xeo Commune', 'ban_xeo', '082', 10),
('02728', 'Mường Hum', 'Muong Hum', 'Xã Mường Hum', 'Muong Hum Commune', 'muong_hum', '082', 10),
('02731', 'Trung Lèng Hồ', 'Trung Leng Ho', 'Xã Trung Lèng Hồ', 'Trung Leng Ho Commune', 'trung_leng_ho', '082', 10),
('02734', 'Quang Kim', 'Quang Kim', 'Xã Quang Kim', 'Quang Kim Commune', 'quang_kim', '082', 10),
('02737', 'Pa Cheo', 'Pa Cheo', 'Xã Pa Cheo', 'Pa Cheo Commune', 'pa_cheo', '082', 10),
('02740', 'Nậm Pung', 'Nam Pung', 'Xã Nậm Pung', 'Nam Pung Commune', 'nam_pung', '082', 10),
('02743', 'Phìn Ngan', 'Phin Ngan', 'Xã Phìn Ngan', 'Phin Ngan Commune', 'phin_ngan', '082', 10),
('02746', 'Cốc San', 'Coc San', 'Xã Cốc San', 'Coc San Commune', 'coc_san', '080', 10),
('02749', 'Tòng Sành', 'Tong Sanh', 'Xã Tòng Sành', 'Tong Sanh Commune', 'tong_sanh', '082', 10),
('02752', 'Pha Long', 'Pha Long', 'Xã Pha Long', 'Pha Long Commune', 'pha_long', '083', 10),
('02755', 'Tả Ngải Chồ', 'Ta Ngai Cho', 'Xã Tả Ngải Chồ', 'Ta Ngai Cho Commune', 'ta_ngai_cho', '083', 10),
('02758', 'Tung Chung Phố', 'Tung Chung Pho', 'Xã Tung Chung Phố', 'Tung Chung Pho Commune', 'tung_chung_pho', '083', 10),
('02761', 'Mường Khương', 'Muong Khuong', 'Thị trấn Mường Khương', 'Muong Khuong Township', 'muong_khuong', '083', 9),
('02764', 'Dìn Chin', 'Din Chin', 'Xã Dìn Chin', 'Din Chin Commune', 'din_chin', '083', 10),
('02767', 'Tả Gia Khâu', 'Ta Gia Khau', 'Xã Tả Gia Khâu', 'Ta Gia Khau Commune', 'ta_gia_khau', '083', 10),
('02770', 'Nậm Chảy', 'Nam Chay', 'Xã Nậm Chảy', 'Nam Chay Commune', 'nam_chay', '083', 10),
('02773', 'Nấm Lư', 'Nam Lu', 'Xã Nấm Lư', 'Nam Lu Commune', 'nam_lu', '083', 10),
('02776', 'Lùng Khấu Nhin', 'Lung Khau Nhin', 'Xã Lùng Khấu Nhin', 'Lung Khau Nhin Commune', 'lung_khau_nhin', '083', 10),
('02779', 'Thanh Bình', 'Thanh Binh', 'Xã Thanh Bình', 'Thanh Binh Commune', 'thanh_binh', '083', 10),
('02782', 'Cao Sơn', 'Cao Son', 'Xã Cao Sơn', 'Cao Son Commune', 'cao_son', '083', 10),
('02785', 'Lùng Vai', 'Lung Vai', 'Xã Lùng Vai', 'Lung Vai Commune', 'lung_vai', '083', 10),
('02788', 'Bản Lầu', 'Ban Lau', 'Xã Bản Lầu', 'Ban Lau Commune', 'ban_lau', '083', 10),
('02791', 'La Pan Tẩn', 'La Pan Tan', 'Xã La Pan Tẩn', 'La Pan Tan Commune', 'la_pan_tan', '083', 10),
('02794', 'Tả Thàng', 'Ta Thang', 'Xã Tả Thàng', 'Ta Thang Commune', 'ta_thang', '083', 10),
('02797', 'Bản Sen', 'Ban Sen', 'Xã Bản Sen', 'Ban Sen Commune', 'ban_sen', '083', 10),
('02800', 'Nàn Sán', 'Nan San', 'Xã Nàn Sán', 'Nan San Commune', 'nan_san', '084', 10),
('02803', 'Thào Chư Phìn', 'Thao Chu Phin', 'Xã Thào Chư Phìn', 'Thao Chu Phin Commune', 'thao_chu_phin', '084', 10),
('02806', 'Bản Mế', 'Ban Me', 'Xã Bản Mế', 'Ban Me Commune', 'ban_me', '084', 10),
('02809', 'Si Ma Cai', 'Si Ma Cai', 'Thị trấn Si Ma Cai', 'Si Ma Cai Township', 'si_ma_cai', '084', 9),
('02812', 'Sán Chải', 'San Chai', 'Xã Sán Chải', 'San Chai Commune', 'san_chai', '084', 10),
('02818', 'Lùng Thẩn', 'Lung Than', 'Xã Lùng Thẩn', 'Lung Than Commune', 'lung_than', '084', 10),
('02821', 'Cán Cấu', 'Can Cau', 'Xã Cán Cấu', 'Can Cau Commune', 'can_cau', '084', 10),
('02824', 'Sín Chéng', 'Sin Cheng', 'Xã Sín Chéng', 'Sin Cheng Commune', 'sin_cheng', '084', 10),
('02827', 'Quan Hồ Thẩn', 'Quan Ho Than', 'Xã Quan Hồ Thẩn', 'Quan Ho Than Commune', 'quan_ho_than', '084', 10),
('02836', 'Nàn Xín', 'Nan Xin', 'Xã Nàn Xín', 'Nan Xin Commune', 'nan_xin', '084', 10),
('02839', 'Bắc Hà', 'Bac Ha', 'Thị trấn Bắc Hà', 'Bac Ha Township', 'bac_ha', '085', 9),
('02842', 'Lùng Cải', 'Lung Cai', 'Xã Lùng Cải', 'Lung Cai Commune', 'lung_cai', '085', 10),
('02848', 'Lùng Phình', 'Lung Phinh', 'Xã Lùng Phình', 'Lung Phinh Commune', 'lung_phinh', '085', 10),
('02851', 'Tả Van Chư', 'Ta Van Chu', 'Xã Tả Van Chư', 'Ta Van Chu Commune', 'ta_van_chu', '085', 10),
('02854', 'Tả Củ Tỷ', 'Ta Cu Ty', 'Xã Tả Củ Tỷ', 'Ta Cu Ty Commune', 'ta_cu_ty', '085', 10),
('02857', 'Thải Giàng Phố', 'Thai Giang Pho', 'Xã Thải Giàng Phố', 'Thai Giang Pho Commune', 'thai_giang_pho', '085', 10),
('02863', 'Hoàng Thu Phố', 'Hoang Thu Pho', 'Xã Hoàng Thu Phố', 'Hoang Thu Pho Commune', 'hoang_thu_pho', '085', 10),
('02866', 'Bản Phố', 'Ban Pho', 'Xã Bản Phố', 'Ban Pho Commune', 'ban_pho', '085', 10),
('02869', 'Bản Liền', 'Ban Lien', 'Xã Bản Liền', 'Ban Lien Commune', 'ban_lien', '085', 10),
('02875', 'Na Hối', 'Na Hoi', 'Xã Na Hối', 'Na Hoi Commune', 'na_hoi', '085', 10),
('02878', 'Cốc Ly', 'Coc Ly', 'Xã Cốc Ly', 'Coc Ly Commune', 'coc_ly', '085', 10),
('02881', 'Nậm Mòn', 'Nam Mon', 'Xã Nậm Mòn', 'Nam Mon Commune', 'nam_mon', '085', 10),
('02884', 'Nậm Đét', 'Nam Det', 'Xã Nậm Đét', 'Nam Det Commune', 'nam_det', '085', 10),
('02887', 'Nậm Khánh', 'Nam Khanh', 'Xã Nậm Khánh', 'Nam Khanh Commune', 'nam_khanh', '085', 10),
('02890', 'Bảo Nhai', 'Bao Nhai', 'Xã Bảo Nhai', 'Bao Nhai Commune', 'bao_nhai', '085', 10),
('02893', 'Nậm Lúc', 'Nam Luc', 'Xã Nậm Lúc', 'Nam Luc Commune', 'nam_luc', '085', 10),
('02896', 'Cốc Lầu', 'Coc Lau', 'Xã Cốc Lầu', 'Coc Lau Commune', 'coc_lau', '085', 10),
('02899', 'Bản Cái', 'Ban Cai', 'Xã Bản Cái', 'Ban Cai Commune', 'ban_cai', '085', 10),
('02902', 'N.T Phong Hải', 'N.T Phong Hai', 'Thị trấn N.T Phong Hải', 'N.T Phong Hai Township', 'n.t_phong_hai', '086', 9),
('02905', 'Phố Lu', 'Pho Lu', 'Thị trấn Phố Lu', 'Pho Lu Township', 'pho_lu', '086', 9),
('02908', 'Tằng Loỏng', 'Tang Loong', 'Thị trấn Tằng Loỏng', 'Tang Loong Township', 'tang_loong', '086', 9),
('02911', 'Bản Phiệt', 'Ban Phiet', 'Xã Bản Phiệt', 'Ban Phiet Commune', 'ban_phiet', '086', 10),
('02914', 'Bản Cầm', 'Ban Cam', 'Xã Bản Cầm', 'Ban Cam Commune', 'ban_cam', '086', 10),
('02917', 'Thái Niên', 'Thai Nien', 'Xã Thái Niên', 'Thai Nien Commune', 'thai_nien', '086', 10),
('02920', 'Phong Niên', 'Phong Nien', 'Xã Phong Niên', 'Phong Nien Commune', 'phong_nien', '086', 10),
('02923', 'Gia Phú', 'Gia Phu', 'Xã Gia Phú', 'Gia Phu Commune', 'gia_phu', '086', 10),
('02926', 'Xuân Quang', 'Xuan Quang', 'Xã Xuân Quang', 'Xuan Quang Commune', 'xuan_quang', '086', 10),
('02929', 'Sơn Hải', 'Son Hai', 'Xã Sơn Hải', 'Son Hai Commune', 'son_hai', '086', 10),
('02932', 'Xuân Giao', 'Xuan Giao', 'Xã Xuân Giao', 'Xuan Giao Commune', 'xuan_giao', '086', 10),
('02935', 'Trì Quang', 'Tri Quang', 'Xã Trì Quang', 'Tri Quang Commune', 'tri_quang', '086', 10),
('02938', 'Sơn Hà', 'Son Ha', 'Xã Sơn Hà', 'Son Ha Commune', 'son_ha', '086', 10),
('02944', 'Phú Nhuận', 'Phu Nhuan', 'Xã Phú Nhuận', 'Phu Nhuan Commune', 'phu_nhuan', '086', 10),
('02947', 'Phố Ràng', 'Pho Rang', 'Thị trấn Phố Ràng', 'Pho Rang Township', 'pho_rang', '087', 9),
('02950', 'Tân Tiến', 'Tan Tien', 'Xã Tân Tiến', 'Tan Tien Commune', 'tan_tien', '087', 10),
('02953', 'Nghĩa Đô', 'Nghia Do', 'Xã Nghĩa Đô', 'Nghia Do Commune', 'nghia_do', '087', 10),
('02956', 'Vĩnh Yên', 'Vinh Yen', 'Xã Vĩnh Yên', 'Vinh Yen Commune', 'vinh_yen', '087', 10),
('02959', 'Điện Quan', 'Dien Quan', 'Xã Điện Quan', 'Dien Quan Commune', 'dien_quan', '087', 10),
('02962', 'Xuân Hoà', 'Xuan Hoa', 'Xã Xuân Hoà', 'Xuan Hoa Commune', 'xuan_hoa', '087', 10),
('02965', 'Tân Dương', 'Tan Duong', 'Xã Tân Dương', 'Tan Duong Commune', 'tan_duong', '087', 10),
('02968', 'Thượng Hà', 'Thuong Ha', 'Xã Thượng Hà', 'Thuong Ha Commune', 'thuong_ha', '087', 10),
('02971', 'Kim Sơn', 'Kim Son', 'Xã Kim Sơn', 'Kim Son Commune', 'kim_son', '087', 10),
('02974', 'Cam Cọn', 'Cam Con', 'Xã Cam Cọn', 'Cam Con Commune', 'cam_con', '087', 10),
('02977', 'Minh Tân', 'Minh Tan', 'Xã Minh Tân', 'Minh Tan Commune', 'minh_tan', '087', 10),
('02980', 'Xuân Thượng', 'Xuan Thuong', 'Xã Xuân Thượng', 'Xuan Thuong Commune', 'xuan_thuong', '087', 10),
('02983', 'Việt Tiến', 'Viet Tien', 'Xã Việt Tiến', 'Viet Tien Commune', 'viet_tien', '087', 10),
('02986', 'Yên Sơn', 'Yen Son', 'Xã Yên Sơn', 'Yen Son Commune', 'yen_son', '087', 10),
('02989', 'Bảo Hà', 'Bao Ha', 'Xã Bảo Hà', 'Bao Ha Commune', 'bao_ha', '087', 10),
('02992', 'Lương Sơn', 'Luong Son', 'Xã Lương Sơn', 'Luong Son Commune', 'luong_son', '087', 10),
('02998', 'Phúc Khánh', 'Phuc Khanh', 'Xã Phúc Khánh', 'Phuc Khanh Commune', 'phuc_khanh', '087', 10),
('03001', 'Sa Pa', 'Sa Pa', 'Phường Sa Pa', 'Sa Pa Ward', 'sa_pa', '088', 8),
('03002', 'Sa Pả', 'Sa Pa', 'Phường Sa Pả', 'Sa Pa Ward', 'sa_pa', '088', 8),
('03003', 'Ô Quý Hồ', 'O Quy Ho', 'Phường Ô Quý Hồ', 'O Quy Ho Ward', 'o_quy_ho', '088', 8),
('03004', 'Ngũ Chỉ Sơn', 'Ngu Chi Son', 'Xã Ngũ Chỉ Sơn', 'Ngu Chi Son Commune', 'ngu_chi_son', '088', 10),
('03006', 'Phan Si Păng', 'Phan Si Pang', 'Phường Phan Si Păng', 'Phan Si Pang Ward', 'phan_si_pang', '088', 8),
('03010', 'Trung Chải', 'Trung Chai', 'Xã Trung Chải', 'Trung Chai Commune', 'trung_chai', '088', 10),
('03013', 'Tả Phìn', 'Ta Phin', 'Xã Tả Phìn', 'Ta Phin Commune', 'ta_phin', '088', 10),
('03016', 'Hàm Rồng', 'Ham Rong', 'Phường Hàm Rồng', 'Ham Rong Ward', 'ham_rong', '088', 8),
('03019', 'Hoàng Liên', 'Hoang Lien', 'Xã Hoàng Liên', 'Hoang Lien Commune', 'hoang_lien', '088', 10),
('03022', 'Thanh Bình', 'Thanh Binh', 'Xã Thanh Bình', 'Thanh Binh Commune', 'thanh_binh', '088', 10),
('03028', 'Cầu Mây', 'Cau May', 'Phường Cầu Mây', 'Cau May Ward', 'cau_may', '088', 8),
('03037', 'Mường Hoa', 'Muong Hoa', 'Xã Mường Hoa', 'Muong Hoa Commune', 'muong_hoa', '088', 10),
('03040', 'Tả Van', 'Ta Van', 'Xã Tả Van', 'Ta Van Commune', 'ta_van', '088', 10),
('03043', 'Mường Bo', 'Muong Bo', 'Xã Mường Bo', 'Muong Bo Commune', 'muong_bo', '088', 10),
('03046', 'Bản Hồ', 'Ban Ho', 'Xã Bản Hồ', 'Ban Ho Commune', 'ban_ho', '088', 10),
('03052', 'Liên Minh', 'Lien Minh', 'Xã Liên Minh', 'Lien Minh Commune', 'lien_minh', '088', 10),
('03055', 'Khánh Yên', 'Khanh Yen', 'Thị trấn Khánh Yên', 'Khanh Yen Township', 'khanh_yen', '089', 9),
('03061', 'Võ Lao', 'Vo Lao', 'Xã Võ Lao', 'Vo Lao Commune', 'vo_lao', '089', 10),
('03064', 'Sơn Thuỷ', 'Son Thuy', 'Xã Sơn Thuỷ', 'Son Thuy Commune', 'son_thuy', '089', 10),
('03067', 'Nậm Mả', 'Nam Ma', 'Xã Nậm Mả', 'Nam Ma Commune', 'nam_ma', '089', 10),
('03070', 'Tân Thượng', 'Tan Thuong', 'Xã Tân Thượng', 'Tan Thuong Commune', 'tan_thuong', '089', 10),
('03073', 'Nậm Rạng', 'Nam Rang', 'Xã Nậm Rạng', 'Nam Rang Commune', 'nam_rang', '089', 10),
('03076', 'Nậm Chầy', 'Nam Chay', 'Xã Nậm Chầy', 'Nam Chay Commune', 'nam_chay', '089', 10),
('03079', 'Tân An', 'Tan An', 'Xã Tân An', 'Tan An Commune', 'tan_an', '089', 10),
('03082', 'Khánh Yên Thượng', 'Khanh Yen Thuong', 'Xã Khánh Yên Thượng', 'Khanh Yen Thuong Commune', 'khanh_yen_thuong', '089', 10),
('03085', 'Nậm Xé', 'Nam Xe', 'Xã Nậm Xé', 'Nam Xe Commune', 'nam_xe', '089', 10),
('03088', 'Dần Thàng', 'Dan Thang', 'Xã Dần Thàng', 'Dan Thang Commune', 'dan_thang', '089', 10),
('03091', 'Chiềng Ken', 'Chieng Ken', 'Xã Chiềng Ken', 'Chieng Ken Commune', 'chieng_ken', '089', 10),
('03094', 'Làng Giàng', 'Lang Giang', 'Xã Làng Giàng', 'Lang Giang Commune', 'lang_giang', '089', 10),
('03097', 'Hoà Mạc', 'Hoa Mac', 'Xã Hoà Mạc', 'Hoa Mac Commune', 'hoa_mac', '089', 10),
('03100', 'Khánh Yên Trung', 'Khanh Yen Trung', 'Xã Khánh Yên Trung', 'Khanh Yen Trung Commune', 'khanh_yen_trung', '089', 10),
('03103', 'Khánh Yên Hạ', 'Khanh Yen Ha', 'Xã Khánh Yên Hạ', 'Khanh Yen Ha Commune', 'khanh_yen_ha', '089', 10),
('03106', 'Dương Quỳ', 'Duong Quy', 'Xã Dương Quỳ', 'Duong Quy Commune', 'duong_quy', '089', 10),
('03109', 'Nậm Tha', 'Nam Tha', 'Xã Nậm Tha', 'Nam Tha Commune', 'nam_tha', '089', 10),
('03112', 'Minh Lương', 'Minh Luong', 'Xã Minh Lương', 'Minh Luong Commune', 'minh_luong', '089', 10),
('03115', 'Thẩm Dương', 'Tham Duong', 'Xã Thẩm Dương', 'Tham Duong Commune', 'tham_duong', '089', 10),
('03118', 'Liêm Phú', 'Liem Phu', 'Xã Liêm Phú', 'Liem Phu Commune', 'liem_phu', '089', 10),
('03121', 'Nậm Xây', 'Nam Xay', 'Xã Nậm Xây', 'Nam Xay Commune', 'nam_xay', '089', 10),
('03124', 'Noong Bua', 'Noong Bua', 'Phường Noong Bua', 'Noong Bua Ward', 'noong_bua', '094', 8),
('03127', 'Him Lam', 'Him Lam', 'Phường Him Lam', 'Him Lam Ward', 'him_lam', '094', 8),
('03130', 'Thanh Bình', 'Thanh Binh', 'Phường Thanh Bình', 'Thanh Binh Ward', 'thanh_binh', '094', 8),
('03133', 'Tân Thanh', 'Tan Thanh', 'Phường Tân Thanh', 'Tan Thanh Ward', 'tan_thanh', '094', 8),
('03136', 'Mường Thanh', 'Muong Thanh', 'Phường Mường Thanh', 'Muong Thanh Ward', 'muong_thanh', '094', 8),
('03139', 'Nam Thanh', 'Nam Thanh', 'Phường Nam Thanh', 'Nam Thanh Ward', 'nam_thanh', '094', 8),
('03142', 'Thanh Trường', 'Thanh Truong', 'Phường Thanh Trường', 'Thanh Truong Ward', 'thanh_truong', '094', 8),
('03145', 'Thanh Minh', 'Thanh Minh', 'Xã Thanh Minh', 'Thanh Minh Commune', 'thanh_minh', '094', 10),
('03148', 'Sông Đà', 'Song Da', 'Phường Sông Đà', 'Song Da Ward', 'song_da', '095', 8),
('03151', 'Na Lay', 'Na Lay', 'Phường Na Lay', 'Na Lay Ward', 'na_lay', '095', 8),
('03154', 'Sín Thầu', 'Sin Thau', 'Xã Sín Thầu', 'Sin Thau Commune', 'sin_thau', '096', 10),
('03155', 'Sen Thượng', 'Sen Thuong', 'Xã Sen Thượng', 'Sen Thuong Commune', 'sen_thuong', '096', 10),
('03156', 'Nậm Tin', 'Nam Tin', 'Xã Nậm Tin', 'Nam Tin Commune', 'nam_tin', '103', 10),
('03157', 'Chung Chải', 'Chung Chai', 'Xã Chung Chải', 'Chung Chai Commune', 'chung_chai', '096', 10),
('03158', 'Leng Su Sìn', 'Leng Su Sin', 'Xã Leng Su Sìn', 'Leng Su Sin Commune', 'leng_su_sin', '096', 10),
('03159', 'Pá Mỳ', 'Pa My', 'Xã Pá Mỳ', 'Pa My Commune', 'pa_my', '096', 10),
('03160', 'Mường Nhé', 'Muong Nhe', 'Xã Mường Nhé', 'Muong Nhe Commune', 'muong_nhe', '096', 10),
('03161', 'Nậm Vì', 'Nam Vi', 'Xã Nậm Vì', 'Nam Vi Commune', 'nam_vi', '096', 10),
('03162', 'Nậm Kè', 'Nam Ke', 'Xã Nậm Kè', 'Nam Ke Commune', 'nam_ke', '096', 10),
('03163', 'Mường Toong', 'Muong Toong', 'Xã Mường Toong', 'Muong Toong Commune', 'muong_toong', '096', 10),
('03164', 'Quảng Lâm', 'Quang Lam', 'Xã Quảng Lâm', 'Quang Lam Commune', 'quang_lam', '096', 10),
('03165', 'Pa Tần', 'Pa Tan', 'Xã Pa Tần', 'Pa Tan Commune', 'pa_tan', '103', 10),
('03166', 'Chà Cang', 'Cha Cang', 'Xã Chà Cang', 'Cha Cang Commune', 'cha_cang', '103', 10),
('03167', 'Na Cô Sa', 'Na Co Sa', 'Xã Na Cô Sa', 'Na Co Sa Commune', 'na_co_sa', '103', 10),
('03168', 'Nà Khoa', 'Na Khoa', 'Xã Nà Khoa', 'Na Khoa Commune', 'na_khoa', '103', 10),
('03169', 'Nà Hỳ', 'Na Hy', 'Xã Nà Hỳ', 'Na Hy Commune', 'na_hy', '103', 10),
('03170', 'Nà Bủng', 'Na Bung', 'Xã Nà Bủng', 'Na Bung Commune', 'na_bung', '103', 10),
('03171', 'Nậm Nhừ', 'Nam Nhu', 'Xã Nậm Nhừ', 'Nam Nhu Commune', 'nam_nhu', '103', 10),
('03172', 'Mường Chà', 'Muong Cha', 'Thị trấn Mường Chà', 'Muong Cha Township', 'muong_cha', '097', 9),
('03173', 'Nậm Chua', 'Nam Chua', 'Xã Nậm Chua', 'Nam Chua Commune', 'nam_chua', '103', 10),
('03174', 'Nậm Khăn', 'Nam Khan', 'Xã Nậm Khăn', 'Nam Khan Commune', 'nam_khan', '103', 10),
('03175', 'Chà Tở', 'Cha To', 'Xã Chà Tở', 'Cha To Commune', 'cha_to', '103', 10),
('03176', 'Vàng Đán', 'Vang Dan', 'Xã Vàng Đán', 'Vang Dan Commune', 'vang_dan', '103', 10),
('03177', 'Huổi Lếnh', 'Huoi Lenh', 'Xã Huổi Lếnh', 'Huoi Lenh Commune', 'huoi_lenh', '096', 10),
('03178', 'Xá Tổng', 'Xa Tong', 'Xã Xá Tổng', 'Xa Tong Commune', 'xa_tong', '097', 10),
('03181', 'Mường Tùng', 'Muong Tung', 'Xã Mường Tùng', 'Muong Tung Commune', 'muong_tung', '097', 10),
('03184', 'Lay Nưa', 'Lay Nua', 'Xã Lay Nưa', 'Lay Nua Commune', 'lay_nua', '095', 10),
('03187', 'Chà Nưa', 'Cha Nua', 'Xã Chà Nưa', 'Cha Nua Commune', 'cha_nua', '103', 10),
('03190', 'Hừa Ngài', 'Hua Ngai', 'Xã Hừa Ngài', 'Hua Ngai Commune', 'hua_ngai', '097', 10),
('03191', 'Huổi Mí', 'Huoi Mi', 'Xã Huổi Mí', 'Huoi Mi Commune', 'huoi_mi', '097', 10),
('03193', 'Pa Ham', 'Pa Ham', 'Xã Pa Ham', 'Pa Ham Commune', 'pa_ham', '097', 10),
('03194', 'Nậm Nèn', 'Nam Nen', 'Xã Nậm Nèn', 'Nam Nen Commune', 'nam_nen', '097', 10),
('03196', 'Huổi Lèng', 'Huoi Leng', 'Xã Huổi Lèng', 'Huoi Leng Commune', 'huoi_leng', '097', 10),
('03197', 'Sa Lông', 'Sa Long', 'Xã Sa Lông', 'Sa Long Commune', 'sa_long', '097', 10),
('03198', 'Phìn Hồ', 'Phin Ho', 'Xã Phìn Hồ', 'Phin Ho Commune', 'phin_ho', '103', 10),
('03199', 'Si Pa Phìn', 'Si Pa Phin', 'Xã Si Pa Phìn', 'Si Pa Phin Commune', 'si_pa_phin', '103', 10),
('03200', 'Ma Thì Hồ', 'Ma Thi Ho', 'Xã Ma Thì Hồ', 'Ma Thi Ho Commune', 'ma_thi_ho', '097', 10),
('03201', 'Na Sang', 'Na Sang', 'Xã Na Sang', 'Na Sang Commune', 'na_sang', '097', 10),
('03202', 'Mường Mươn', 'Muong Muon', 'Xã Mường Mươn', 'Muong Muon Commune', 'muong_muon', '097', 10),
('03203', 'Điện Biên Đông', 'Dien Bien Dong', 'Thị trấn Điện Biên Đông', 'Dien Bien Dong Township', 'dien_bien_dong', '101', 9),
('03205', 'Na Son', 'Na Son', 'Xã Na Son', 'Na Son Commune', 'na_son', '101', 10),
('03208', 'Phì Nhừ', 'Phi Nhu', 'Xã Phì Nhừ', 'Phi Nhu Commune', 'phi_nhu', '101', 10),
('03211', 'Chiềng Sơ', 'Chieng So', 'Xã Chiềng Sơ', 'Chieng So Commune', 'chieng_so', '101', 10),
('03214', 'Mường Luân', 'Muong Luan', 'Xã Mường Luân', 'Muong Luan Commune', 'muong_luan', '101', 10),
('03217', 'Tủa Chùa', 'Tua Chua', 'Thị trấn Tủa Chùa', 'Tua Chua Township', 'tua_chua', '098', 9),
('03220', 'Huổi Só', 'Huoi So', 'Xã Huổi Só', 'Huoi So Commune', 'huoi_so', '098', 10),
('03223', 'Xín Chải', 'Xin Chai', 'Xã Xín Chải', 'Xin Chai Commune', 'xin_chai', '098', 10),
('03226', 'Tả Sìn Thàng', 'Ta Sin Thang', 'Xã Tả Sìn Thàng', 'Ta Sin Thang Commune', 'ta_sin_thang', '098', 10),
('03229', 'Lao Xả Phình', 'Lao Xa Phinh', 'Xã Lao Xả Phình', 'Lao Xa Phinh Commune', 'lao_xa_phinh', '098', 10),
('03232', 'Tả Phìn', 'Ta Phin', 'Xã Tả Phìn', 'Ta Phin Commune', 'ta_phin', '098', 10),
('03235', 'Tủa Thàng', 'Tua Thang', 'Xã Tủa Thàng', 'Tua Thang Commune', 'tua_thang', '098', 10),
('03238', 'Trung Thu', 'Trung Thu', 'Xã Trung Thu', 'Trung Thu Commune', 'trung_thu', '098', 10),
('03241', 'Sính Phình', 'Sinh Phinh', 'Xã Sính Phình', 'Sinh Phinh Commune', 'sinh_phinh', '098', 10),
('03244', 'Sáng Nhè', 'Sang Nhe', 'Xã Sáng Nhè', 'Sang Nhe Commune', 'sang_nhe', '098', 10),
('03247', 'Mường Đun', 'Muong Dun', 'Xã Mường Đun', 'Muong Dun Commune', 'muong_dun', '098', 10),
('03250', 'Mường Báng', 'Muong Bang', 'Xã Mường Báng', 'Muong Bang Commune', 'muong_bang', '098', 10),
('03253', 'Tuần Giáo', 'Tuan Giao', 'Thị trấn Tuần Giáo', 'Tuan Giao Township', 'tuan_giao', '099', 9),
('03256', 'Mường Ảng', 'Muong Ang', 'Thị trấn Mường Ảng', 'Muong Ang Township', 'muong_ang', '102', 9),
('03259', 'Phình Sáng', 'Phinh Sang', 'Xã Phình Sáng', 'Phinh Sang Commune', 'phinh_sang', '099', 10),
('03260', 'Rạng Đông', 'Rang Dong', 'Xã Rạng Đông', 'Rang Dong Commune', 'rang_dong', '099', 10),
('03262', 'Mùn Chung', 'Mun Chung', 'Xã Mùn Chung', 'Mun Chung Commune', 'mun_chung', '099', 10),
('03263', 'Nà Tòng', 'Na Tong', 'Xã Nà Tòng', 'Na Tong Commune', 'na_tong', '099', 10),
('03265', 'Ta Ma', 'Ta Ma', 'Xã Ta Ma', 'Ta Ma Commune', 'ta_ma', '099', 10),
('03268', 'Mường Mùn', 'Muong Mun', 'Xã Mường Mùn', 'Muong Mun Commune', 'muong_mun', '099', 10),
('03269', 'Pú Xi', 'Pu Xi', 'Xã Pú Xi', 'Pu Xi Commune', 'pu_xi', '099', 10),
('03271', 'Pú Nhung', 'Pu Nhung', 'Xã Pú Nhung', 'Pu Nhung Commune', 'pu_nhung', '099', 10),
('03274', 'Quài Nưa', 'Quai Nua', 'Xã Quài Nưa', 'Quai Nua Commune', 'quai_nua', '099', 10),
('03277', 'Mường Thín', 'Muong Thin', 'Xã Mường Thín', 'Muong Thin Commune', 'muong_thin', '099', 10),
('03280', 'Tỏa Tình', 'Toa Tinh', 'Xã Tỏa Tình', 'Toa Tinh Commune', 'toa_tinh', '099', 10),
('03283', 'Nà Sáy', 'Na Say', 'Xã Nà Sáy', 'Na Say Commune', 'na_say', '099', 10),
('03284', 'Mường Khong', 'Muong Khong', 'Xã Mường Khong', 'Muong Khong Commune', 'muong_khong', '099', 10),
('03286', 'Mường Đăng', 'Muong Dang', 'Xã Mường Đăng', 'Muong Dang Commune', 'muong_dang', '102', 10),
('03287', 'Ngối Cáy', 'Ngoi Cay', 'Xã Ngối Cáy', 'Ngoi Cay Commune', 'ngoi_cay', '102', 10),
('03289', 'Quài Cang', 'Quai Cang', 'Xã Quài Cang', 'Quai Cang Commune', 'quai_cang', '099', 10),
('03292', 'Ẳng Tở', 'Ang To', 'Xã Ẳng Tở', 'Ang To Commune', 'ang_to', '102', 10),
('03295', 'Quài Tở', 'Quai To', 'Xã Quài Tở', 'Quai To Commune', 'quai_to', '099', 10),
('03298', 'Chiềng Sinh', 'Chieng Sinh', 'Xã Chiềng Sinh', 'Chieng Sinh Commune', 'chieng_sinh', '099', 10),
('03299', 'Chiềng Đông', 'Chieng Dong', 'Xã Chiềng Đông', 'Chieng Dong Commune', 'chieng_dong', '099', 10),
('03301', 'Búng Lao', 'Bung Lao', 'Xã Búng Lao', 'Bung Lao Commune', 'bung_lao', '102', 10),
('03302', 'Xuân Lao', 'Xuan Lao', 'Xã Xuân Lao', 'Xuan Lao Commune', 'xuan_lao', '102', 10);
INSERT INTO `phuong` (`code`, `name`, `name_en`, `full_name`, `full_name_en`, `code_name`, `district_code`, `administrative_unit_id`) VALUES
('03304', 'Tênh Phông', 'Tenh Phong', 'Xã Tênh Phông', 'Tenh Phong Commune', 'tenh_phong', '099', 10),
('03307', 'Ẳng Nưa', 'Ang Nua', 'Xã Ẳng Nưa', 'Ang Nua Commune', 'ang_nua', '102', 10),
('03310', 'Ẳng Cang', 'Ang Cang', 'Xã Ẳng Cang', 'Ang Cang Commune', 'ang_cang', '102', 10),
('03312', 'Nặm Lịch', 'Nam Lich', 'Xã Nặm Lịch', 'Nam Lich Commune', 'nam_lich', '102', 10),
('03313', 'Mường Lạn', 'Muong Lan', 'Xã Mường Lạn', 'Muong Lan Commune', 'muong_lan', '102', 10),
('03316', 'Nà Tấu', 'Na Tau', 'Xã Nà Tấu', 'Na Tau Commune', 'na_tau', '094', 10),
('03317', 'Nà Nhạn', 'Na Nhan', 'Xã Nà Nhạn', 'Na Nhan Commune', 'na_nhan', '094', 10),
('03319', 'Mường Pồn', 'Muong Pon', 'Xã Mường Pồn', 'Muong Pon Commune', 'muong_pon', '100', 10),
('03322', 'Thanh Nưa', 'Thanh Nua', 'Xã Thanh Nưa', 'Thanh Nua Commune', 'thanh_nua', '100', 10),
('03323', 'Hua Thanh', 'Hua Thanh', 'Xã Hua Thanh', 'Hua Thanh Commune', 'hua_thanh', '100', 10),
('03325', 'Mường Phăng', 'Muong Phang', 'Xã Mường Phăng', 'Muong Phang Commune', 'muong_phang', '094', 10),
('03326', 'Pá Khoang', 'Pa Khoang', 'Xã Pá Khoang', 'Pa Khoang Commune', 'pa_khoang', '094', 10),
('03328', 'Thanh Luông', 'Thanh Luong', 'Xã Thanh Luông', 'Thanh Luong Commune', 'thanh_luong', '100', 10),
('03331', 'Thanh Hưng', 'Thanh Hung', 'Xã Thanh Hưng', 'Thanh Hung Commune', 'thanh_hung', '100', 10),
('03334', 'Thanh Xương', 'Thanh Xuong', 'Xã Thanh Xương', 'Thanh Xuong Commune', 'thanh_xuong', '100', 10),
('03337', 'Thanh Chăn', 'Thanh Chan', 'Xã Thanh Chăn', 'Thanh Chan Commune', 'thanh_chan', '100', 10),
('03340', 'Pa Thơm', 'Pa Thom', 'Xã Pa Thơm', 'Pa Thom Commune', 'pa_thom', '100', 10),
('03343', 'Thanh An', 'Thanh An', 'Xã Thanh An', 'Thanh An Commune', 'thanh_an', '100', 10),
('03346', 'Thanh Yên', 'Thanh Yen', 'Xã Thanh Yên', 'Thanh Yen Commune', 'thanh_yen', '100', 10),
('03349', 'Noong Luống', 'Noong Luong', 'Xã Noong Luống', 'Noong Luong Commune', 'noong_luong', '100', 10),
('03352', 'Noọng Hẹt', 'Noong Het', 'Xã Noọng Hẹt', 'Noong Het Commune', 'noong_het', '100', 10),
('03355', 'Sam Mứn', 'Sam Mun', 'Xã Sam Mứn', 'Sam Mun Commune', 'sam_mun', '100', 10),
('03356', 'Pom Lót', 'Pom Lot', 'Xã Pom Lót', 'Pom Lot Commune', 'pom_lot', '100', 10),
('03358', 'Núa Ngam', 'Nua Ngam', 'Xã Núa Ngam', 'Nua Ngam Commune', 'nua_ngam', '100', 10),
('03359', 'Hẹ Muông', 'He Muong', 'Xã Hẹ Muông', 'He Muong Commune', 'he_muong', '100', 10),
('03361', 'Na Ư', 'Na U', 'Xã Na Ư', 'Na U Commune', 'na_u', '100', 10),
('03364', 'Mường Nhà', 'Muong Nha', 'Xã Mường Nhà', 'Muong Nha Commune', 'muong_nha', '100', 10),
('03365', 'Na Tông', 'Na Tong', 'Xã Na Tông', 'Na Tong Commune', 'na_tong', '100', 10),
('03367', 'Mường Lói', 'Muong Loi', 'Xã Mường Lói', 'Muong Loi Commune', 'muong_loi', '100', 10),
('03368', 'Phu Luông', 'Phu Luong', 'Xã Phu Luông', 'Phu Luong Commune', 'phu_luong', '100', 10),
('03370', 'Pú Nhi', 'Pu Nhi', 'Xã Pú Nhi', 'Pu Nhi Commune', 'pu_nhi', '101', 10),
('03371', 'Nong U', 'Nong U', 'Xã Nong U', 'Nong U Commune', 'nong_u', '101', 10),
('03373', 'Xa Dung', 'Xa Dung', 'Xã Xa Dung', 'Xa Dung Commune', 'xa_dung', '101', 10),
('03376', 'Keo Lôm', 'Keo Lom', 'Xã Keo Lôm', 'Keo Lom Commune', 'keo_lom', '101', 10),
('03379', 'Luân Giới', 'Luan Gioi', 'Xã Luân Giới', 'Luan Gioi Commune', 'luan_gioi', '101', 10),
('03382', 'Phình Giàng', 'Phinh Giang', 'Xã Phình Giàng', 'Phinh Giang Commune', 'phinh_giang', '101', 10),
('03383', 'Pú Hồng', 'Pu Hong', 'Xã Pú Hồng', 'Pu Hong Commune', 'pu_hong', '101', 10),
('03384', 'Tìa Dình', 'Tia Dinh', 'Xã Tìa Dình', 'Tia Dinh Commune', 'tia_dinh', '101', 10),
('03385', 'Háng Lìa', 'Hang Lia', 'Xã Háng Lìa', 'Hang Lia Commune', 'hang_lia', '101', 10),
('03386', 'Quyết Thắng', 'Quyet Thang', 'Phường Quyết Thắng', 'Quyet Thang Ward', 'quyet_thang', '105', 8),
('03387', 'Tân Phong', 'Tan Phong', 'Phường Tân Phong', 'Tan Phong Ward', 'tan_phong', '105', 8),
('03388', 'Quyết Tiến', 'Quyet Tien', 'Phường Quyết Tiến', 'Quyet Tien Ward', 'quyet_tien', '105', 8),
('03389', 'Đoàn Kết', 'Doan Ket', 'Phường Đoàn Kết', 'Doan Ket Ward', 'doan_ket', '105', 8),
('03390', 'Tam Đường', 'Tam Duong', 'Thị trấn Tam Đường', 'Tam Duong Township', 'tam_duong', '106', 9),
('03391', 'Lả Nhì Thàng', 'La Nhi Thang', 'Xã Lả Nhì Thàng', 'La Nhi Thang Commune', 'la_nhi_thang', '109', 10),
('03394', 'Thèn Sin', 'Then Sin', 'Xã Thèn Sin', 'Then Sin Commune', 'then_sin', '106', 10),
('03400', 'Tả Lèng', 'Ta Leng', 'Xã Tả Lèng', 'Ta Leng Commune', 'ta_leng', '106', 10),
('03403', 'Sùng Phài', 'Sung Phai', 'Xã Sùng Phài', 'Sung Phai Commune', 'sung_phai', '105', 10),
('03405', 'Giang Ma', 'Giang Ma', 'Xã Giang Ma', 'Giang Ma Commune', 'giang_ma', '106', 10),
('03406', 'Hồ Thầu', 'Ho Thau', 'Xã Hồ Thầu', 'Ho Thau Commune', 'ho_thau', '106', 10),
('03408', 'Đông Phong', 'Dong Phong', 'Phường Đông Phong', 'Dong Phong Ward', 'dong_phong', '105', 8),
('03409', 'San Thàng', 'San Thang', 'Xã San Thàng', 'San Thang Commune', 'san_thang', '105', 10),
('03412', 'Bình Lư', 'Binh Lu', 'Xã Bình Lư', 'Binh Lu Commune', 'binh_lu', '106', 10),
('03413', 'Sơn Bình', 'Son Binh', 'Xã Sơn Bình', 'Son Binh Commune', 'son_binh', '106', 10),
('03415', 'Nùng Nàng', 'Nung Nang', 'Xã Nùng Nàng', 'Nung Nang Commune', 'nung_nang', '106', 10),
('03418', 'Bản Giang', 'Ban Giang', 'Xã Bản Giang', 'Ban Giang Commune', 'ban_giang', '106', 10),
('03421', 'Bản Hon', 'Ban Hon', 'Xã Bản Hon', 'Ban Hon Commune', 'ban_hon', '106', 10),
('03424', 'Bản Bo', 'Ban Bo', 'Xã Bản Bo', 'Ban Bo Commune', 'ban_bo', '106', 10),
('03427', 'Nà Tăm', 'Na Tam', 'Xã Nà Tăm', 'Na Tam Commune', 'na_tam', '106', 10),
('03430', 'Khun Há', 'Khun Ha', 'Xã Khun Há', 'Khun Ha Commune', 'khun_ha', '106', 10),
('03433', 'Mường Tè', 'Muong Te', 'Thị trấn Mường Tè', 'Muong Te Township', 'muong_te', '107', 9),
('03434', 'Nậm Nhùn', 'Nam Nhun', 'Thị trấn Nậm Nhùn', 'Nam Nhun Township', 'nam_nhun', '112', 9),
('03436', 'Thu Lũm', 'Thu Lum', 'Xã Thu Lũm', 'Thu Lum Commune', 'thu_lum', '107', 10),
('03439', 'Ka Lăng', 'Ka Lang', 'Xã Ka Lăng', 'Ka Lang Commune', 'ka_lang', '107', 10),
('03440', 'Tá Bạ', 'Ta Ba', 'Xã Tá Bạ', 'Ta Ba Commune', 'ta_ba', '107', 10),
('03442', 'Pa ủ', 'Pa u', 'Xã Pa ủ', 'Pa u Commune', 'pa_u', '107', 10),
('03445', 'Mường Tè', 'Muong Te', 'Xã Mường Tè', 'Muong Te Commune', 'muong_te', '107', 10),
('03448', 'Pa Vệ Sử', 'Pa Ve Su', 'Xã Pa Vệ Sử', 'Pa Ve Su Commune', 'pa_ve_su', '107', 10),
('03451', 'Mù Cả', 'Mu Ca', 'Xã Mù Cả', 'Mu Ca Commune', 'mu_ca', '107', 10),
('03454', 'Bum Tở', 'Bum To', 'Xã Bum Tở', 'Bum To Commune', 'bum_to', '107', 10),
('03457', 'Nậm Khao', 'Nam Khao', 'Xã Nậm Khao', 'Nam Khao Commune', 'nam_khao', '107', 10),
('03460', 'Hua Bun', 'Hua Bun', 'Xã Hua Bun', 'Hua Bun Commune', 'hua_bun', '112', 10),
('03463', 'Tà Tổng', 'Ta Tong', 'Xã Tà Tổng', 'Ta Tong Commune', 'ta_tong', '107', 10),
('03466', 'Bum Nưa', 'Bum Nua', 'Xã Bum Nưa', 'Bum Nua Commune', 'bum_nua', '107', 10),
('03467', 'Vàng San', 'Vang San', 'Xã Vàng San', 'Vang San Commune', 'vang_san', '107', 10),
('03469', 'Kan Hồ', 'Kan Ho', 'Xã Kan Hồ', 'Kan Ho Commune', 'kan_ho', '107', 10),
('03472', 'Mường Mô', 'Muong Mo', 'Xã Mường Mô', 'Muong Mo Commune', 'muong_mo', '112', 10),
('03473', 'Nậm Chà', 'Nam Cha', 'Xã Nậm Chà', 'Nam Cha Commune', 'nam_cha', '112', 10),
('03474', 'Nậm Manh', 'Nam Manh', 'Xã Nậm Manh', 'Nam Manh Commune', 'nam_manh', '112', 10),
('03475', 'Nậm Hàng', 'Nam Hang', 'Xã Nậm Hàng', 'Nam Hang Commune', 'nam_hang', '112', 10),
('03478', 'Sìn Hồ', 'Sin Ho', 'Thị trấn Sìn Hồ', 'Sin Ho Township', 'sin_ho', '108', 9),
('03481', 'Lê Lợi', 'Le Loi', 'Xã Lê Lợi', 'Le Loi Commune', 'le_loi', '112', 10),
('03484', 'Pú Đao', 'Pu Dao', 'Xã Pú Đao', 'Pu Dao Commune', 'pu_dao', '112', 10),
('03487', 'Chăn Nưa', 'Chan Nua', 'Xã Chăn Nưa', 'Chan Nua Commune', 'chan_nua', '108', 10),
('03488', 'Nậm Pì', 'Nam Pi', 'Xã Nậm Pì', 'Nam Pi Commune', 'nam_pi', '112', 10),
('03490', 'Huổi Luông', 'Huoi Luong', 'Xã Huổi Luông', 'Huoi Luong Commune', 'huoi_luong', '109', 10),
('03493', 'Pa Tần', 'Pa Tan', 'Xã Pa Tần', 'Pa Tan Commune', 'pa_tan', '108', 10),
('03496', 'Phìn Hồ', 'Phin Ho', 'Xã Phìn Hồ', 'Phin Ho Commune', 'phin_ho', '108', 10),
('03499', 'Hồng Thu', 'Hong Thu', 'Xã Hồng Thu', 'Hong Thu Commune', 'hong_thu', '108', 10),
('03502', 'Nậm Ban', 'Nam Ban', 'Xã Nậm Ban', 'Nam Ban Commune', 'nam_ban', '112', 10),
('03503', 'Trung Chải', 'Trung Chai', 'Xã Trung Chải', 'Trung Chai Commune', 'trung_chai', '112', 10),
('03505', 'Phăng Sô Lin', 'Phang So Lin', 'Xã Phăng Sô Lin', 'Phang So Lin Commune', 'phang_so_lin', '108', 10),
('03508', 'Ma Quai', 'Ma Quai', 'Xã Ma Quai', 'Ma Quai Commune', 'ma_quai', '108', 10),
('03509', 'Lùng Thàng', 'Lung Thang', 'Xã Lùng Thàng', 'Lung Thang Commune', 'lung_thang', '108', 10),
('03511', 'Tả Phìn', 'Ta Phin', 'Xã Tả Phìn', 'Ta Phin Commune', 'ta_phin', '108', 10),
('03514', 'Sà Dề Phìn', 'Sa De Phin', 'Xã Sà Dề Phìn', 'Sa De Phin Commune', 'sa_de_phin', '108', 10),
('03517', 'Nậm Tăm', 'Nam Tam', 'Xã Nậm Tăm', 'Nam Tam Commune', 'nam_tam', '108', 10),
('03520', 'Tả Ngảo', 'Ta Ngao', 'Xã Tả Ngảo', 'Ta Ngao Commune', 'ta_ngao', '108', 10),
('03523', 'Pu Sam Cáp', 'Pu Sam Cap', 'Xã Pu Sam Cáp', 'Pu Sam Cap Commune', 'pu_sam_cap', '108', 10),
('03526', 'Nậm Cha', 'Nam Cha', 'Xã Nậm Cha', 'Nam Cha Commune', 'nam_cha', '108', 10),
('03527', 'Pa Khoá', 'Pa Khoa', 'Xã Pa Khoá', 'Pa Khoa Commune', 'pa_khoa', '108', 10),
('03529', 'Làng Mô', 'Lang Mo', 'Xã Làng Mô', 'Lang Mo Commune', 'lang_mo', '108', 10),
('03532', 'Noong Hẻo', 'Noong Heo', 'Xã Noong Hẻo', 'Noong Heo Commune', 'noong_heo', '108', 10),
('03535', 'Nậm Mạ', 'Nam Ma', 'Xã Nậm Mạ', 'Nam Ma Commune', 'nam_ma', '108', 10),
('03538', 'Căn Co', 'Can Co', 'Xã Căn Co', 'Can Co Commune', 'can_co', '108', 10),
('03541', 'Tủa Sín Chải', 'Tua Sin Chai', 'Xã Tủa Sín Chải', 'Tua Sin Chai Commune', 'tua_sin_chai', '108', 10),
('03544', 'Nậm Cuổi', 'Nam Cuoi', 'Xã Nậm Cuổi', 'Nam Cuoi Commune', 'nam_cuoi', '108', 10),
('03547', 'Nậm Hăn', 'Nam Han', 'Xã Nậm Hăn', 'Nam Han Commune', 'nam_han', '108', 10),
('03549', 'Phong Thổ', 'Phong Tho', 'Thị trấn Phong Thổ', 'Phong Tho Township', 'phong_tho', '109', 9),
('03550', 'Sì Lở Lầu', 'Si Lo Lau', 'Xã Sì Lở Lầu', 'Si Lo Lau Commune', 'si_lo_lau', '109', 10),
('03553', 'Mồ Sì San', 'Mo Si San', 'Xã Mồ Sì San', 'Mo Si San Commune', 'mo_si_san', '109', 10),
('03559', 'Pa Vây Sử', 'Pa Vay Su', 'Xã Pa Vây Sử', 'Pa Vay Su Commune', 'pa_vay_su', '109', 10),
('03562', 'Vàng Ma Chải', 'Vang Ma Chai', 'Xã Vàng Ma Chải', 'Vang Ma Chai Commune', 'vang_ma_chai', '109', 10),
('03565', 'Tông Qua Lìn', 'Tong Qua Lin', 'Xã Tông Qua Lìn', 'Tong Qua Lin Commune', 'tong_qua_lin', '109', 10),
('03568', 'Mù Sang', 'Mu Sang', 'Xã Mù Sang', 'Mu Sang Commune', 'mu_sang', '109', 10),
('03571', 'Dào San', 'Dao San', 'Xã Dào San', 'Dao San Commune', 'dao_san', '109', 10),
('03574', 'Ma Ly Pho', 'Ma Ly Pho', 'Xã Ma Ly Pho', 'Ma Ly Pho Commune', 'ma_ly_pho', '109', 10),
('03577', 'Bản Lang', 'Ban Lang', 'Xã Bản Lang', 'Ban Lang Commune', 'ban_lang', '109', 10),
('03580', 'Hoang Thèn', 'Hoang Then', 'Xã Hoang Thèn', 'Hoang Then Commune', 'hoang_then', '109', 10),
('03583', 'Khổng Lào', 'Khong Lao', 'Xã Khổng Lào', 'Khong Lao Commune', 'khong_lao', '109', 10),
('03586', 'Nậm Xe', 'Nam Xe', 'Xã Nậm Xe', 'Nam Xe Commune', 'nam_xe', '109', 10),
('03589', 'Mường So', 'Muong So', 'Xã Mường So', 'Muong So Commune', 'muong_so', '109', 10),
('03592', 'Sin Suối Hồ', 'Sin Suoi Ho', 'Xã Sin Suối Hồ', 'Sin Suoi Ho Commune', 'sin_suoi_ho', '109', 10),
('03595', 'Than Uyên', 'Than Uyen', 'Thị trấn Than Uyên', 'Than Uyen Township', 'than_uyen', '110', 9),
('03598', 'Tân Uyên', 'Tan Uyen', 'Thị trấn Tân Uyên', 'Tan Uyen Township', 'tan_uyen', '111', 9),
('03601', 'Mường Khoa', 'Muong Khoa', 'Xã Mường Khoa', 'Muong Khoa Commune', 'muong_khoa', '111', 10),
('03602', 'Phúc Khoa', 'Phuc Khoa', 'Xã Phúc Khoa', 'Phuc Khoa Commune', 'phuc_khoa', '111', 10),
('03604', 'Thân Thuộc', 'Than Thuoc', 'Xã Thân Thuộc', 'Than Thuoc Commune', 'than_thuoc', '111', 10),
('03605', 'Trung Đồng', 'Trung Dong', 'Xã Trung Đồng', 'Trung Dong Commune', 'trung_dong', '111', 10),
('03607', 'Hố Mít', 'Ho Mit', 'Xã Hố Mít', 'Ho Mit Commune', 'ho_mit', '111', 10),
('03610', 'Nậm Cần', 'Nam Can', 'Xã Nậm Cần', 'Nam Can Commune', 'nam_can', '111', 10),
('03613', 'Nậm Sỏ', 'Nam So', 'Xã Nậm Sỏ', 'Nam So Commune', 'nam_so', '111', 10),
('03616', 'Pắc Ta', 'Pac Ta', 'Xã Pắc Ta', 'Pac Ta Commune', 'pac_ta', '111', 10),
('03618', 'Phúc Than', 'Phuc Than', 'Xã Phúc Than', 'Phuc Than Commune', 'phuc_than', '110', 10),
('03619', 'Mường Than', 'Muong Than', 'Xã Mường Than', 'Muong Than Commune', 'muong_than', '110', 10),
('03622', 'Tà Mít', 'Ta Mit', 'Xã Tà Mít', 'Ta Mit Commune', 'ta_mit', '111', 10),
('03625', 'Mường Mít', 'Muong Mit', 'Xã Mường Mít', 'Muong Mit Commune', 'muong_mit', '110', 10),
('03628', 'Pha Mu', 'Pha Mu', 'Xã Pha Mu', 'Pha Mu Commune', 'pha_mu', '110', 10),
('03631', 'Mường Cang', 'Muong Cang', 'Xã Mường Cang', 'Muong Cang Commune', 'muong_cang', '110', 10),
('03632', 'Hua Nà', 'Hua Na', 'Xã Hua Nà', 'Hua Na Commune', 'hua_na', '110', 10),
('03634', 'Tà Hừa', 'Ta Hua', 'Xã Tà Hừa', 'Ta Hua Commune', 'ta_hua', '110', 10),
('03637', 'Mường Kim', 'Muong Kim', 'Xã Mường Kim', 'Muong Kim Commune', 'muong_kim', '110', 10),
('03638', 'Tà Mung', 'Ta Mung', 'Xã Tà Mung', 'Ta Mung Commune', 'ta_mung', '110', 10),
('03640', 'Tà Gia', 'Ta Gia', 'Xã Tà Gia', 'Ta Gia Commune', 'ta_gia', '110', 10),
('03643', 'Khoen On', 'Khoen On', 'Xã Khoen On', 'Khoen On Commune', 'khoen_on', '110', 10),
('03646', 'Chiềng Lề', 'Chieng Le', 'Phường Chiềng Lề', 'Chieng Le Ward', 'chieng_le', '116', 8),
('03649', 'Tô Hiệu', 'To Hieu', 'Phường Tô Hiệu', 'To Hieu Ward', 'to_hieu', '116', 8),
('03652', 'Quyết Thắng', 'Quyet Thang', 'Phường Quyết Thắng', 'Quyet Thang Ward', 'quyet_thang', '116', 8),
('03655', 'Quyết Tâm', 'Quyet Tam', 'Phường Quyết Tâm', 'Quyet Tam Ward', 'quyet_tam', '116', 8),
('03658', 'Chiềng Cọ', 'Chieng Co', 'Xã Chiềng Cọ', 'Chieng Co Commune', 'chieng_co', '116', 10),
('03661', 'Chiềng Đen', 'Chieng Den', 'Xã Chiềng Đen', 'Chieng Den Commune', 'chieng_den', '116', 10),
('03664', 'Chiềng Xôm', 'Chieng Xom', 'Xã Chiềng Xôm', 'Chieng Xom Commune', 'chieng_xom', '116', 10),
('03667', 'Chiềng An', 'Chieng An', 'Phường Chiềng An', 'Chieng An Ward', 'chieng_an', '116', 8),
('03670', 'Chiềng Cơi', 'Chieng Coi', 'Phường Chiềng Cơi', 'Chieng Coi Ward', 'chieng_coi', '116', 8),
('03673', 'Chiềng Ngần', 'Chieng Ngan', 'Xã Chiềng Ngần', 'Chieng Ngan Commune', 'chieng_ngan', '116', 10),
('03676', 'Hua La', 'Hua La', 'Xã Hua La', 'Hua La Commune', 'hua_la', '116', 10),
('03679', 'Chiềng Sinh', 'Chieng Sinh', 'Phường Chiềng Sinh', 'Chieng Sinh Ward', 'chieng_sinh', '116', 8),
('03682', 'Mường Chiên', 'Muong Chien', 'Xã Mường Chiên', 'Muong Chien Commune', 'muong_chien', '118', 10),
('03685', 'Cà Nàng', 'Ca Nang', 'Xã Cà Nàng', 'Ca Nang Commune', 'ca_nang', '118', 10),
('03688', 'Chiềng Khay', 'Chieng Khay', 'Xã Chiềng Khay', 'Chieng Khay Commune', 'chieng_khay', '118', 10),
('03694', 'Mường Giôn', 'Muong Gion', 'Xã Mường Giôn', 'Muong Gion Commune', 'muong_gion', '118', 10),
('03697', 'Pá Ma Pha Khinh', 'Pa Ma Pha Khinh', 'Xã Pá Ma Pha Khinh', 'Pa Ma Pha Khinh Commune', 'pa_ma_pha_khinh', '118', 10),
('03700', 'Chiềng Ơn', 'Chieng On', 'Xã Chiềng Ơn', 'Chieng On Commune', 'chieng_on', '118', 10),
('03703', 'Mường Giàng', 'Muong Giang', 'Thị trấn Mường Giàng', 'Muong Giang Township', 'muong_giang', '118', 9),
('03706', 'Chiềng Bằng', 'Chieng Bang', 'Xã Chiềng Bằng', 'Chieng Bang Commune', 'chieng_bang', '118', 10),
('03709', 'Mường Sại', 'Muong Sai', 'Xã Mường Sại', 'Muong Sai Commune', 'muong_sai', '118', 10),
('03712', 'Nậm ét', 'Nam et', 'Xã Nậm ét', 'Nam et Commune', 'nam_et', '118', 10),
('03718', 'Chiềng Khoang', 'Chieng Khoang', 'Xã Chiềng Khoang', 'Chieng Khoang Commune', 'chieng_khoang', '118', 10),
('03721', 'Thuận Châu', 'Thuan Chau', 'Thị trấn Thuận Châu', 'Thuan Chau Township', 'thuan_chau', '119', 9),
('03724', 'Phổng Lái', 'Phong Lai', 'Xã Phổng Lái', 'Phong Lai Commune', 'phong_lai', '119', 10),
('03727', 'Mường é', 'Muong e', 'Xã Mường é', 'Muong e Commune', 'muong_e', '119', 10),
('03730', 'Chiềng Pha', 'Chieng Pha', 'Xã Chiềng Pha', 'Chieng Pha Commune', 'chieng_pha', '119', 10),
('03733', 'Chiềng La', 'Chieng La', 'Xã Chiềng La', 'Chieng La Commune', 'chieng_la', '119', 10),
('03736', 'Chiềng Ngàm', 'Chieng Ngam', 'Xã Chiềng Ngàm', 'Chieng Ngam Commune', 'chieng_ngam', '119', 10),
('03739', 'Liệp Tè', 'Liep Te', 'Xã Liệp Tè', 'Liep Te Commune', 'liep_te', '119', 10),
('03742', 'é Tòng', 'e Tong', 'Xã é Tòng', 'e Tong Commune', 'e_tong', '119', 10),
('03745', 'Phổng Lập', 'Phong Lap', 'Xã Phổng Lập', 'Phong Lap Commune', 'phong_lap', '119', 10),
('03748', 'Phổng Ly', 'Phong Ly', 'Xã Phổng Ly', 'Phong Ly Commune', 'phong_ly', '119', 10),
('03754', 'Noong Lay', 'Noong Lay', 'Xã Noong Lay', 'Noong Lay Commune', 'noong_lay', '119', 10),
('03757', 'Mường Khiêng', 'Muong Khieng', 'Xã Mường Khiêng', 'Muong Khieng Commune', 'muong_khieng', '119', 10),
('03760', 'Mường Bám', 'Muong Bam', 'Xã Mường Bám', 'Muong Bam Commune', 'muong_bam', '119', 10),
('03763', 'Long Hẹ', 'Long He', 'Xã Long Hẹ', 'Long He Commune', 'long_he', '119', 10),
('03766', 'Chiềng Bôm', 'Chieng Bom', 'Xã Chiềng Bôm', 'Chieng Bom Commune', 'chieng_bom', '119', 10),
('03769', 'Thôm Mòn', 'Thom Mon', 'Xã Thôm Mòn', 'Thom Mon Commune', 'thom_mon', '119', 10),
('03772', 'Tông Lạnh', 'Tong Lanh', 'Xã Tông Lạnh', 'Tong Lanh Commune', 'tong_lanh', '119', 10),
('03775', 'Tông Cọ', 'Tong Co', 'Xã Tông Cọ', 'Tong Co Commune', 'tong_co', '119', 10),
('03778', 'Bó Mười', 'Bo Muoi', 'Xã Bó Mười', 'Bo Muoi Commune', 'bo_muoi', '119', 10),
('27061', '2', '2', 'Phường 2', 'Ward 2', '2', '768', 8),
('27064', '8', '8', 'Phường 8', 'Ward 8', '8', '768', 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phuongthucthanhtoan`
--

CREATE TABLE `phuongthucthanhtoan` (
  `MaPhuongThuc` bigint(20) NOT NULL,
  `TenPhuongThuc` varchar(255) DEFAULT NULL,
  `MoTa` text DEFAULT NULL,
  `TrangThai` binary(1) DEFAULT NULL,
  `PhiGiaoDich` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phuongthucthanhtoan`
--

INSERT INTO `phuongthucthanhtoan` (`MaPhuongThuc`, `TenPhuongThuc`, `MoTa`, `TrangThai`, `PhiGiaoDich`) VALUES
(1, 'PT1', 'Tien mat', 0x01, 100000.00),
(2, 'PT2', 'Chuyen khoan', 0x01, 20000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quan`
--

CREATE TABLE `quan` (
  `code` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `full_name_en` varchar(255) DEFAULT NULL,
  `code_name` varchar(255) DEFAULT NULL,
  `province_code` varchar(20) DEFAULT NULL,
  `administrative_unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `quan`
--

INSERT INTO `quan` (`code`, `name`, `name_en`, `full_name`, `full_name_en`, `code_name`, `province_code`, `administrative_unit_id`) VALUES
('001', 'Ba Đình', 'Ba Dinh', 'Quận Ba Đình', 'Ba Dinh District', 'ba_dinh', '01', 5),
('002', 'Hoàn Kiếm', 'Hoan Kiem', 'Quận Hoàn Kiếm', 'Hoan Kiem District', 'hoan_kiem', '01', 5),
('003', 'Tây Hồ', 'Tay Ho', 'Quận Tây Hồ', 'Tay Ho District', 'tay_ho', '01', 5),
('004', 'Long Biên', 'Long Bien', 'Quận Long Biên', 'Long Bien District', 'long_bien', '01', 5),
('005', 'Cầu Giấy', 'Cau Giay', 'Quận Cầu Giấy', 'Cau Giay District', 'cau_giay', '01', 5),
('006', 'Đống Đa', 'Dong Da', 'Quận Đống Đa', 'Dong Da District', 'dong_da', '01', 5),
('007', 'Hai Bà Trưng', 'Hai Ba Trung', 'Quận Hai Bà Trưng', 'Hai Ba Trung District', 'hai_ba_trung', '01', 5),
('008', 'Hoàng Mai', 'Hoang Mai', 'Quận Hoàng Mai', 'Hoang Mai District', 'hoang_mai', '01', 5),
('009', 'Thanh Xuân', 'Thanh Xuan', 'Quận Thanh Xuân', 'Thanh Xuan District', 'thanh_xuan', '01', 5),
('016', 'Sóc Sơn', 'Soc Son', 'Huyện Sóc Sơn', 'Soc Son District', 'soc_son', '01', 7),
('017', 'Đông Anh', 'Dong Anh', 'Huyện Đông Anh', 'Dong Anh District', 'dong_anh', '01', 7),
('018', 'Gia Lâm', 'Gia Lam', 'Huyện Gia Lâm', 'Gia Lam District', 'gia_lam', '01', 7),
('019', 'Nam Từ Liêm', 'Nam Tu Liem', 'Quận Nam Từ Liêm', 'Nam Tu Liem District', 'nam_tu_liem', '01', 5),
('020', 'Thanh Trì', 'Thanh Tri', 'Huyện Thanh Trì', 'Thanh Tri District', 'thanh_tri', '01', 7),
('021', 'Bắc Từ Liêm', 'Bac Tu Liem', 'Quận Bắc Từ Liêm', 'Bac Tu Liem District', 'bac_tu_liem', '01', 5),
('024', 'Hà Giang', 'Ha Giang', 'Thành phố Hà Giang', 'Ha Giang City', 'ha_giang', '02', 4),
('026', 'Đồng Văn', 'Dong Van', 'Huyện Đồng Văn', 'Dong Van District', 'dong_van', '02', 7),
('027', 'Mèo Vạc', 'Meo Vac', 'Huyện Mèo Vạc', 'Meo Vac District', 'meo_vac', '02', 7),
('028', 'Yên Minh', 'Yen Minh', 'Huyện Yên Minh', 'Yen Minh District', 'yen_minh', '02', 7),
('029', 'Quản Bạ', 'Quan Ba', 'Huyện Quản Bạ', 'Quan Ba District', 'quan_ba', '02', 7),
('030', 'Vị Xuyên', 'Vi Xuyen', 'Huyện Vị Xuyên', 'Vi Xuyen District', 'vi_xuyen', '02', 7),
('031', 'Bắc Mê', 'Bac Me', 'Huyện Bắc Mê', 'Bac Me District', 'bac_me', '02', 7),
('032', 'Hoàng Su Phì', 'Hoang Su Phi', 'Huyện Hoàng Su Phì', 'Hoang Su Phi District', 'hoang_su_phi', '02', 7),
('033', 'Xín Mần', 'Xin Man', 'Huyện Xín Mần', 'Xin Man District', 'xin_man', '02', 7),
('034', 'Bắc Quang', 'Bac Quang', 'Huyện Bắc Quang', 'Bac Quang District', 'bac_quang', '02', 7),
('035', 'Quang Bình', 'Quang Binh', 'Huyện Quang Bình', 'Quang Binh District', 'quang_binh', '02', 7),
('040', 'Cao Bằng', 'Cao Bang', 'Thành phố Cao Bằng', 'Cao Bang City', 'cao_bang', '04', 4),
('042', 'Bảo Lâm', 'Bao Lam', 'Huyện Bảo Lâm', 'Bao Lam District', 'bao_lam', '04', 7),
('043', 'Bảo Lạc', 'Bao Lac', 'Huyện Bảo Lạc', 'Bao Lac District', 'bao_lac', '04', 7),
('045', 'Hà Quảng', 'Ha Quang', 'Huyện Hà Quảng', 'Ha Quang District', 'ha_quang', '04', 7),
('047', 'Trùng Khánh', 'Trung Khanh', 'Huyện Trùng Khánh', 'Trung Khanh District', 'trung_khanh', '04', 7),
('048', 'Hạ Lang', 'Ha Lang', 'Huyện Hạ Lang', 'Ha Lang District', 'ha_lang', '04', 7),
('049', 'Quảng Hòa', 'Quang Hoa', 'Huyện Quảng Hòa', 'Quang Hoa District', 'quang_hoa', '04', 7),
('051', 'Hoà An', 'Hoa An', 'Huyện Hoà An', 'Hoa An District', 'hoa_an', '04', 7),
('052', 'Nguyên Bình', 'Nguyen Binh', 'Huyện Nguyên Bình', 'Nguyen Binh District', 'nguyen_binh', '04', 7),
('053', 'Thạch An', 'Thach An', 'Huyện Thạch An', 'Thach An District', 'thach_an', '04', 7),
('058', 'Bắc Kạn', 'Bac Kan', 'Thành phố Bắc Kạn', 'Bac Kan City', 'bac_kan', '06', 4),
('060', 'Pác Nặm', 'Pac Nam', 'Huyện Pác Nặm', 'Pac Nam District', 'pac_nam', '06', 7),
('061', 'Ba Bể', 'Ba Be', 'Huyện Ba Bể', 'Ba Be District', 'ba_be', '06', 7),
('062', 'Ngân Sơn', 'Ngan Son', 'Huyện Ngân Sơn', 'Ngan Son District', 'ngan_son', '06', 7),
('063', 'Bạch Thông', 'Bach Thong', 'Huyện Bạch Thông', 'Bach Thong District', 'bach_thong', '06', 7),
('064', 'Chợ Đồn', 'Cho Don', 'Huyện Chợ Đồn', 'Cho Don District', 'cho_don', '06', 7),
('065', 'Chợ Mới', 'Cho Moi', 'Huyện Chợ Mới', 'Cho Moi District', 'cho_moi', '06', 7),
('066', 'Na Rì', 'Na Ri', 'Huyện Na Rì', 'Na Ri District', 'na_ri', '06', 7),
('070', 'Tuyên Quang', 'Tuyen Quang', 'Thành phố Tuyên Quang', 'Tuyen Quang City', 'tuyen_quang', '08', 4),
('071', 'Lâm Bình', 'Lam Binh', 'Huyện Lâm Bình', 'Lam Binh District', 'lam_binh', '08', 7),
('072', 'Na Hang', 'Na Hang', 'Huyện Na Hang', 'Na Hang District', 'na_hang', '08', 7),
('073', 'Chiêm Hóa', 'Chiem Hoa', 'Huyện Chiêm Hóa', 'Chiem Hoa District', 'chiem_hoa', '08', 7),
('074', 'Hàm Yên', 'Ham Yen', 'Huyện Hàm Yên', 'Ham Yen District', 'ham_yen', '08', 7),
('075', 'Yên Sơn', 'Yen Son', 'Huyện Yên Sơn', 'Yen Son District', 'yen_son', '08', 7),
('076', 'Sơn Dương', 'Son Duong', 'Huyện Sơn Dương', 'Son Duong District', 'son_duong', '08', 7),
('080', 'Lào Cai', 'Lao Cai', 'Thành phố Lào Cai', 'Lao Cai City', 'lao_cai', '10', 4),
('082', 'Bát Xát', 'Bat Xat', 'Huyện Bát Xát', 'Bat Xat District', 'bat_xat', '10', 7),
('083', 'Mường Khương', 'Muong Khuong', 'Huyện Mường Khương', 'Muong Khuong District', 'muong_khuong', '10', 7),
('084', 'Si Ma Cai', 'Si Ma Cai', 'Huyện Si Ma Cai', 'Si Ma Cai District', 'si_ma_cai', '10', 7),
('085', 'Bắc Hà', 'Bac Ha', 'Huyện Bắc Hà', 'Bac Ha District', 'bac_ha', '10', 7),
('086', 'Bảo Thắng', 'Bao Thang', 'Huyện Bảo Thắng', 'Bao Thang District', 'bao_thang', '10', 7),
('087', 'Bảo Yên', 'Bao Yen', 'Huyện Bảo Yên', 'Bao Yen District', 'bao_yen', '10', 7),
('088', 'Sa Pa', 'Sa Pa', 'Thị xã Sa Pa', 'Sa Pa Town', 'sa_pa', '10', 6),
('089', 'Văn Bàn', 'Van Ban', 'Huyện Văn Bàn', 'Van Ban District', 'van_ban', '10', 7),
('094', 'Điện Biên Phủ', 'Dien Bien Phu', 'Thành phố Điện Biên Phủ', 'Dien Bien Phu City', 'dien_bien_phu', '11', 4),
('095', 'Mường Lay', 'Muong Lay', 'Thị xã Mường Lay', 'Muong Lay Town', 'muong_lay', '11', 6),
('096', 'Mường Nhé', 'Muong Nhe', 'Huyện Mường Nhé', 'Muong Nhe District', 'muong_nhe', '11', 7),
('097', 'Mường Chà', 'Muong Cha', 'Huyện Mường Chà', 'Muong Cha District', 'muong_cha', '11', 7),
('098', 'Tủa Chùa', 'Tua Chua', 'Huyện Tủa Chùa', 'Tua Chua District', 'tua_chua', '11', 7),
('099', 'Tuần Giáo', 'Tuan Giao', 'Huyện Tuần Giáo', 'Tuan Giao District', 'tuan_giao', '11', 7),
('100', 'Điện Biên', 'Dien Bien', 'Huyện Điện Biên', 'Dien Bien District', 'dien_bien', '11', 7),
('101', 'Điện Biên Đông', 'Dien Bien Dong', 'Huyện Điện Biên Đông', 'Dien Bien Dong District', 'dien_bien_dong', '11', 7),
('102', 'Mường Ảng', 'Muong Ang', 'Huyện Mường Ảng', 'Muong Ang District', 'muong_ang', '11', 7),
('103', 'Nậm Pồ', 'Nam Po', 'Huyện Nậm Pồ', 'Nam Po District', 'nam_po', '11', 7),
('105', 'Lai Châu', 'Lai Chau', 'Thành phố Lai Châu', 'Lai Chau City', 'lai_chau', '12', 4),
('106', 'Tam Đường', 'Tam Duong', 'Huyện Tam Đường', 'Tam Duong District', 'tam_duong', '12', 7),
('107', 'Mường Tè', 'Muong Te', 'Huyện Mường Tè', 'Muong Te District', 'muong_te', '12', 7),
('108', 'Sìn Hồ', 'Sin Ho', 'Huyện Sìn Hồ', 'Sin Ho District', 'sin_ho', '12', 7),
('109', 'Phong Thổ', 'Phong Tho', 'Huyện Phong Thổ', 'Phong Tho District', 'phong_tho', '12', 7),
('110', 'Than Uyên', 'Than Uyen', 'Huyện Than Uyên', 'Than Uyen District', 'than_uyen', '12', 7),
('111', 'Tân Uyên', 'Tan Uyen', 'Huyện Tân Uyên', 'Tan Uyen District', 'tan_uyen', '12', 7),
('112', 'Nậm Nhùn', 'Nam Nhun', 'Huyện Nậm Nhùn', 'Nam Nhun District', 'nam_nhun', '12', 7),
('116', 'Sơn La', 'Son La', 'Thành phố Sơn La', 'Son La City', 'son_la', '14', 4),
('118', 'Quỳnh Nhai', 'Quynh Nhai', 'Huyện Quỳnh Nhai', 'Quynh Nhai District', 'quynh_nhai', '14', 7),
('119', 'Thuận Châu', 'Thuan Chau', 'Huyện Thuận Châu', 'Thuan Chau District', 'thuan_chau', '14', 7),
('120', 'Mường La', 'Muong La', 'Huyện Mường La', 'Muong La District', 'muong_la', '14', 7),
('121', 'Bắc Yên', 'Bac Yen', 'Huyện Bắc Yên', 'Bac Yen District', 'bac_yen', '14', 7),
('122', 'Phù Yên', 'Phu Yen', 'Huyện Phù Yên', 'Phu Yen District', 'phu_yen', '14', 7),
('123', 'Mộc Châu', 'Moc Chau', 'Thị xã Mộc Châu', 'Moc Chau Town', 'moc_chau', '14', 6),
('124', 'Yên Châu', 'Yen Chau', 'Huyện Yên Châu', 'Yen Chau District', 'yen_chau', '14', 7),
('125', 'Mai Sơn', 'Mai Son', 'Huyện Mai Sơn', 'Mai Son District', 'mai_son', '14', 7),
('126', 'Sông Mã', 'Song Ma', 'Huyện Sông Mã', 'Song Ma District', 'song_ma', '14', 7),
('127', 'Sốp Cộp', 'Sop Cop', 'Huyện Sốp Cộp', 'Sop Cop District', 'sop_cop', '14', 7),
('128', 'Vân Hồ', 'Van Ho', 'Huyện Vân Hồ', 'Van Ho District', 'van_ho', '14', 7),
('132', 'Yên Bái', 'Yen Bai', 'Thành phố Yên Bái', 'Yen Bai City', 'yen_bai', '15', 4),
('133', 'Nghĩa Lộ', 'Nghia Lo', 'Thị xã Nghĩa Lộ', 'Nghia Lo Town', 'nghia_lo', '15', 6),
('135', 'Lục Yên', 'Luc Yen', 'Huyện Lục Yên', 'Luc Yen District', 'luc_yen', '15', 7),
('136', 'Văn Yên', 'Van Yen', 'Huyện Văn Yên', 'Van Yen District', 'van_yen', '15', 7),
('137', 'Mù Căng Chải', 'Mu Cang Chai', 'Huyện Mù Căng Chải', 'Mu Cang Chai District', 'mu_cang_chai', '15', 7),
('138', 'Trấn Yên', 'Tran Yen', 'Huyện Trấn Yên', 'Tran Yen District', 'tran_yen', '15', 7),
('139', 'Trạm Tấu', 'Tram Tau', 'Huyện Trạm Tấu', 'Tram Tau District', 'tram_tau', '15', 7),
('140', 'Văn Chấn', 'Van Chan', 'Huyện Văn Chấn', 'Van Chan District', 'van_chan', '15', 7),
('141', 'Yên Bình', 'Yen Binh', 'Huyện Yên Bình', 'Yen Binh District', 'yen_binh', '15', 7),
('148', 'Hòa Bình', 'Hoa Binh', 'Thành phố Hòa Bình', 'Hoa Binh City', 'hoa_binh', '17', 4),
('150', 'Đà Bắc', 'Da Bac', 'Huyện Đà Bắc', 'Da Bac District', 'da_bac', '17', 7),
('152', 'Lương Sơn', 'Luong Son', 'Huyện Lương Sơn', 'Luong Son District', 'luong_son', '17', 7),
('153', 'Kim Bôi', 'Kim Boi', 'Huyện Kim Bôi', 'Kim Boi District', 'kim_boi', '17', 7),
('154', 'Cao Phong', 'Cao Phong', 'Huyện Cao Phong', 'Cao Phong District', 'cao_phong', '17', 7),
('155', 'Tân Lạc', 'Tan Lac', 'Huyện Tân Lạc', 'Tan Lac District', 'tan_lac', '17', 7),
('156', 'Mai Châu', 'Mai Chau', 'Huyện Mai Châu', 'Mai Chau District', 'mai_chau', '17', 7),
('157', 'Lạc Sơn', 'Lac Son', 'Huyện Lạc Sơn', 'Lac Son District', 'lac_son', '17', 7),
('158', 'Yên Thủy', 'Yen Thuy', 'Huyện Yên Thủy', 'Yen Thuy District', 'yen_thuy', '17', 7),
('159', 'Lạc Thủy', 'Lac Thuy', 'Huyện Lạc Thủy', 'Lac Thuy District', 'lac_thuy', '17', 7),
('164', 'Thái Nguyên', 'Thai Nguyen', 'Thành phố Thái Nguyên', 'Thai Nguyen City', 'thai_nguyen', '19', 4),
('165', 'Sông Công', 'Song Cong', 'Thành phố Sông Công', 'Song Cong City', 'song_cong', '19', 4),
('167', 'Định Hóa', 'Dinh Hoa', 'Huyện Định Hóa', 'Dinh Hoa District', 'dinh_hoa', '19', 7),
('168', 'Phú Lương', 'Phu Luong', 'Huyện Phú Lương', 'Phu Luong District', 'phu_luong', '19', 7),
('169', 'Đồng Hỷ', 'Dong Hy', 'Huyện Đồng Hỷ', 'Dong Hy District', 'dong_hy', '19', 7),
('170', 'Võ Nhai', 'Vo Nhai', 'Huyện Võ Nhai', 'Vo Nhai District', 'vo_nhai', '19', 7),
('171', 'Đại Từ', 'Dai Tu', 'Huyện Đại Từ', 'Dai Tu District', 'dai_tu', '19', 7),
('172', 'Phổ Yên', 'Pho Yen', 'Thành phố Phổ Yên', 'Pho Yen City', 'pho_yen', '19', 4),
('173', 'Phú Bình', 'Phu Binh', 'Huyện Phú Bình', 'Phu Binh District', 'phu_binh', '19', 7),
('178', 'Lạng Sơn', 'Lang Son', 'Thành phố Lạng Sơn', 'Lang Son City', 'lang_son', '20', 4),
('180', 'Tràng Định', 'Trang Dinh', 'Huyện Tràng Định', 'Trang Dinh District', 'trang_dinh', '20', 7),
('181', 'Bình Gia', 'Binh Gia', 'Huyện Bình Gia', 'Binh Gia District', 'binh_gia', '20', 7),
('182', 'Văn Lãng', 'Van Lang', 'Huyện Văn Lãng', 'Van Lang District', 'van_lang', '20', 7),
('183', 'Cao Lộc', 'Cao Loc', 'Huyện Cao Lộc', 'Cao Loc District', 'cao_loc', '20', 7),
('184', 'Văn Quan', 'Van Quan', 'Huyện Văn Quan', 'Van Quan District', 'van_quan', '20', 7),
('185', 'Bắc Sơn', 'Bac Son', 'Huyện Bắc Sơn', 'Bac Son District', 'bac_son', '20', 7),
('186', 'Hữu Lũng', 'Huu Lung', 'Huyện Hữu Lũng', 'Huu Lung District', 'huu_lung', '20', 7),
('187', 'Chi Lăng', 'Chi Lang', 'Huyện Chi Lăng', 'Chi Lang District', 'chi_lang', '20', 7),
('188', 'Lộc Bình', 'Loc Binh', 'Huyện Lộc Bình', 'Loc Binh District', 'loc_binh', '20', 7),
('189', 'Đình Lập', 'Dinh Lap', 'Huyện Đình Lập', 'Dinh Lap District', 'dinh_lap', '20', 7),
('193', 'Hạ Long', 'Ha Long', 'Thành phố Hạ Long', 'Ha Long City', 'ha_long', '22', 4),
('194', 'Móng Cái', 'Mong Cai', 'Thành phố Móng Cái', 'Mong Cai City', 'mong_cai', '22', 4),
('195', 'Cẩm Phả', 'Cam Pha', 'Thành phố Cẩm Phả', 'Cam Pha City', 'cam_pha', '22', 4),
('196', 'Uông Bí', 'Uong Bi', 'Thành phố Uông Bí', 'Uong Bi City', 'uong_bi', '22', 4),
('198', 'Bình Liêu', 'Binh Lieu', 'Huyện Bình Liêu', 'Binh Lieu District', 'binh_lieu', '22', 7),
('199', 'Tiên Yên', 'Tien Yen', 'Huyện Tiên Yên', 'Tien Yen District', 'tien_yen', '22', 7),
('200', 'Đầm Hà', 'Dam Ha', 'Huyện Đầm Hà', 'Dam Ha District', 'dam_ha', '22', 7),
('201', 'Hải Hà', 'Hai Ha', 'Huyện Hải Hà', 'Hai Ha District', 'hai_ha', '22', 7),
('202', 'Ba Chẽ', 'Ba Che', 'Huyện Ba Chẽ', 'Ba Che District', 'ba_che', '22', 7),
('203', 'Vân Đồn', 'Van Don', 'Huyện Vân Đồn', 'Van Don District', 'van_don', '22', 7),
('205', 'Đông Triều', 'Dong Trieu', 'Thành phố Đông Triều', 'Dong Trieu City', 'dong_trieu', '22', 4),
('206', 'Quảng Yên', 'Quang Yen', 'Thị xã Quảng Yên', 'Quang Yen Town', 'quang_yen', '22', 6),
('207', 'Cô Tô', 'Co To', 'Huyện Cô Tô', 'Co To District', 'co_to', '22', 7),
('213', 'Bắc Giang', 'Bac Giang', 'Thành phố Bắc Giang', 'Bac Giang City', 'bac_giang', '24', 4),
('215', 'Yên Thế', 'Yen The', 'Huyện Yên Thế', 'Yen The District', 'yen_the', '24', 7),
('216', 'Tân Yên', 'Tan Yen', 'Huyện Tân Yên', 'Tan Yen District', 'tan_yen', '24', 7),
('217', 'Lạng Giang', 'Lang Giang', 'Huyện Lạng Giang', 'Lang Giang District', 'lang_giang', '24', 7),
('218', 'Lục Nam', 'Luc Nam', 'Huyện Lục Nam', 'Luc Nam District', 'luc_nam', '24', 7),
('219', 'Lục Ngạn', 'Luc Ngan', 'Huyện Lục Ngạn', 'Luc Ngan District', 'luc_ngan', '24', 7),
('220', 'Sơn Động', 'Son Dong', 'Huyện Sơn Động', 'Son Dong District', 'son_dong', '24', 7),
('222', 'Việt Yên', 'Viet Yen', 'Thị xã Việt Yên', 'Viet Yen Town', 'viet_yen', '24', 6),
('223', 'Hiệp Hòa', 'Hiep Hoa', 'Huyện Hiệp Hòa', 'Hiep Hoa District', 'hiep_hoa', '24', 7),
('224', 'Chũ', 'Chu', 'Thị xã Chũ', 'Chu Town', 'chu', '24', 6),
('227', 'Việt Trì', 'Viet Tri', 'Thành phố Việt Trì', 'Viet Tri City', 'viet_tri', '25', 4),
('228', 'Phú Thọ', 'Phu Tho', 'Thị xã Phú Thọ', 'Phu Tho Town', 'phu_tho', '25', 6),
('230', 'Đoan Hùng', 'Doan Hung', 'Huyện Đoan Hùng', 'Doan Hung District', 'doan_hung', '25', 7),
('231', 'Hạ Hoà', 'Ha Hoa', 'Huyện Hạ Hoà', 'Ha Hoa District', 'ha_hoa', '25', 7),
('232', 'Thanh Ba', 'Thanh Ba', 'Huyện Thanh Ba', 'Thanh Ba District', 'thanh_ba', '25', 7),
('233', 'Phù Ninh', 'Phu Ninh', 'Huyện Phù Ninh', 'Phu Ninh District', 'phu_ninh', '25', 7),
('234', 'Yên Lập', 'Yen Lap', 'Huyện Yên Lập', 'Yen Lap District', 'yen_lap', '25', 7),
('235', 'Cẩm Khê', 'Cam Khe', 'Huyện Cẩm Khê', 'Cam Khe District', 'cam_khe', '25', 7),
('236', 'Tam Nông', 'Tam Nong', 'Huyện Tam Nông', 'Tam Nong District', 'tam_nong', '25', 7),
('237', 'Lâm Thao', 'Lam Thao', 'Huyện Lâm Thao', 'Lam Thao District', 'lam_thao', '25', 7),
('238', 'Thanh Sơn', 'Thanh Son', 'Huyện Thanh Sơn', 'Thanh Son District', 'thanh_son', '25', 7),
('239', 'Thanh Thuỷ', 'Thanh Thuy', 'Huyện Thanh Thuỷ', 'Thanh Thuy District', 'thanh_thuy', '25', 7),
('240', 'Tân Sơn', 'Tan Son', 'Huyện Tân Sơn', 'Tan Son District', 'tan_son', '25', 7),
('243', 'Vĩnh Yên', 'Vinh Yen', 'Thành phố Vĩnh Yên', 'Vinh Yen City', 'vinh_yen', '26', 4),
('244', 'Phúc Yên', 'Phuc Yen', 'Thành phố Phúc Yên', 'Phuc Yen City', 'phuc_yen', '26', 4),
('246', 'Lập Thạch', 'Lap Thach', 'Huyện Lập Thạch', 'Lap Thach District', 'lap_thach', '26', 7),
('247', 'Tam Dương', 'Tam Duong', 'Huyện Tam Dương', 'Tam Duong District', 'tam_duong', '26', 7),
('248', 'Tam Đảo', 'Tam Dao', 'Huyện Tam Đảo', 'Tam Dao District', 'tam_dao', '26', 7),
('249', 'Bình Xuyên', 'Binh Xuyen', 'Huyện Bình Xuyên', 'Binh Xuyen District', 'binh_xuyen', '26', 7),
('250', 'Mê Linh', 'Me Linh', 'Huyện Mê Linh', 'Me Linh District', 'me_linh', '01', 7),
('251', 'Yên Lạc', 'Yen Lac', 'Huyện Yên Lạc', 'Yen Lac District', 'yen_lac', '26', 7),
('252', 'Vĩnh Tường', 'Vinh Tuong', 'Huyện Vĩnh Tường', 'Vinh Tuong District', 'vinh_tuong', '26', 7),
('253', 'Sông Lô', 'Song Lo', 'Huyện Sông Lô', 'Song Lo District', 'song_lo', '26', 7),
('256', 'Bắc Ninh', 'Bac Ninh', 'Thành phố Bắc Ninh', 'Bac Ninh City', 'bac_ninh', '27', 4),
('258', 'Yên Phong', 'Yen Phong', 'Huyện Yên Phong', 'Yen Phong District', 'yen_phong', '27', 7),
('259', 'Quế Võ', 'Que Vo', 'Thị xã Quế Võ', 'Que Vo Town', 'que_vo', '27', 6),
('260', 'Tiên Du', 'Tien Du', 'Huyện Tiên Du', 'Tien Du District', 'tien_du', '27', 7),
('261', 'Từ Sơn', 'Tu Son', 'Thành phố Từ Sơn', 'Tu Son City', 'tu_son', '27', 4),
('262', 'Thuận Thành', 'Thuan Thanh', 'Thị xã Thuận Thành', 'Thuan Thanh Town', 'thuan_thanh', '27', 6),
('263', 'Gia Bình', 'Gia Binh', 'Huyện Gia Bình', 'Gia Binh District', 'gia_binh', '27', 7),
('264', 'Lương Tài', 'Luong Tai', 'Huyện Lương Tài', 'Luong Tai District', 'luong_tai', '27', 7),
('268', 'Hà Đông', 'Ha Dong', 'Quận Hà Đông', 'Ha Dong District', 'ha_dong', '01', 5),
('269', 'Sơn Tây', 'Son Tay', 'Thị xã Sơn Tây', 'Son Tay Town', 'son_tay', '01', 6),
('271', 'Ba Vì', 'Ba Vi', 'Huyện Ba Vì', 'Ba Vi District', 'ba_vi', '01', 7),
('272', 'Phúc Thọ', 'Phuc Tho', 'Huyện Phúc Thọ', 'Phuc Tho District', 'phuc_tho', '01', 7),
('273', 'Đan Phượng', 'Dan Phuong', 'Huyện Đan Phượng', 'Dan Phuong District', 'dan_phuong', '01', 7),
('274', 'Hoài Đức', 'Hoai Duc', 'Huyện Hoài Đức', 'Hoai Duc District', 'hoai_duc', '01', 7),
('275', 'Quốc Oai', 'Quoc Oai', 'Huyện Quốc Oai', 'Quoc Oai District', 'quoc_oai', '01', 7),
('276', 'Thạch Thất', 'Thach That', 'Huyện Thạch Thất', 'Thach That District', 'thach_that', '01', 7),
('277', 'Chương Mỹ', 'Chuong My', 'Huyện Chương Mỹ', 'Chuong My District', 'chuong_my', '01', 7),
('278', 'Thanh Oai', 'Thanh Oai', 'Huyện Thanh Oai', 'Thanh Oai District', 'thanh_oai', '01', 7),
('279', 'Thường Tín', 'Thuong Tin', 'Huyện Thường Tín', 'Thuong Tin District', 'thuong_tin', '01', 7),
('280', 'Phú Xuyên', 'Phu Xuyen', 'Huyện Phú Xuyên', 'Phu Xuyen District', 'phu_xuyen', '01', 7),
('281', 'Ứng Hòa', 'Ung Hoa', 'Huyện Ứng Hòa', 'Ung Hoa District', 'ung_hoa', '01', 7),
('282', 'Mỹ Đức', 'My Duc', 'Huyện Mỹ Đức', 'My Duc District', 'my_duc', '01', 7),
('288', 'Hải Dương', 'Hai Duong', 'Thành phố Hải Dương', 'Hai Duong City', 'hai_duong', '30', 4),
('290', 'Chí Linh', 'Chi Linh', 'Thành phố Chí Linh', 'Chi Linh City', 'chi_linh', '30', 4),
('291', 'Nam Sách', 'Nam Sach', 'Huyện Nam Sách', 'Nam Sach District', 'nam_sach', '30', 7),
('292', 'Kinh Môn', 'Kinh Mon', 'Thị xã Kinh Môn', 'Kinh Mon Town', 'kinh_mon', '30', 6),
('293', 'Kim Thành', 'Kim Thanh', 'Huyện Kim Thành', 'Kim Thanh District', 'kim_thanh', '30', 7),
('294', 'Thanh Hà', 'Thanh Ha', 'Huyện Thanh Hà', 'Thanh Ha District', 'thanh_ha', '30', 7),
('295', 'Cẩm Giàng', 'Cam Giang', 'Huyện Cẩm Giàng', 'Cam Giang District', 'cam_giang', '30', 7),
('296', 'Bình Giang', 'Binh Giang', 'Huyện Bình Giang', 'Binh Giang District', 'binh_giang', '30', 7),
('297', 'Gia Lộc', 'Gia Loc', 'Huyện Gia Lộc', 'Gia Loc District', 'gia_loc', '30', 7),
('298', 'Tứ Kỳ', 'Tu Ky', 'Huyện Tứ Kỳ', 'Tu Ky District', 'tu_ky', '30', 7),
('299', 'Ninh Giang', 'Ninh Giang', 'Huyện Ninh Giang', 'Ninh Giang District', 'ninh_giang', '30', 7),
('300', 'Thanh Miện', 'Thanh Mien', 'Huyện Thanh Miện', 'Thanh Mien District', 'thanh_mien', '30', 7),
('303', 'Hồng Bàng', 'Hong Bang', 'Quận Hồng Bàng', 'Hong Bang District', 'hong_bang', '31', 5),
('304', 'Ngô Quyền', 'Ngo Quyen', 'Quận Ngô Quyền', 'Ngo Quyen District', 'ngo_quyen', '31', 5),
('305', 'Lê Chân', 'Le Chan', 'Quận Lê Chân', 'Le Chan District', 'le_chan', '31', 5),
('306', 'Hải An', 'Hai An', 'Quận Hải An', 'Hai An District', 'hai_an', '31', 5),
('307', 'Kiến An', 'Kien An', 'Quận Kiến An', 'Kien An District', 'kien_an', '31', 5),
('308', 'Đồ Sơn', 'Do Son', 'Quận Đồ Sơn', 'Do Son District', 'do_son', '31', 5),
('309', 'Dương Kinh', 'Duong Kinh', 'Quận Dương Kinh', 'Duong Kinh District', 'duong_kinh', '31', 5),
('311', 'Thuỷ Nguyên', 'Thuy Nguyen', 'Thành phố Thuỷ Nguyên', 'Thuy Nguyen City', 'thuy_nguyen', '31', 4),
('312', 'An Dương', 'An Duong', 'Quận An Dương', 'An Duong District', 'an_duong', '31', 5),
('313', 'An Lão', 'An Lao', 'Huyện An Lão', 'An Lao District', 'an_lao', '31', 7),
('314', 'Kiến Thuỵ', 'Kien Thuy', 'Huyện Kiến Thuỵ', 'Kien Thuy District', 'kien_thuy', '31', 7),
('315', 'Tiên Lãng', 'Tien Lang', 'Huyện Tiên Lãng', 'Tien Lang District', 'tien_lang', '31', 7),
('316', 'Vĩnh Bảo', 'Vinh Bao', 'Huyện Vĩnh Bảo', 'Vinh Bao District', 'vinh_bao', '31', 7),
('317', 'Cát Hải', 'Cat Hai', 'Huyện Cát Hải', 'Cat Hai District', 'cat_hai', '31', 7),
('318', 'Bạch Long Vĩ', 'Bach Long Vi', 'Huyện Bạch Long Vĩ', 'Bach Long Vi District', 'bach_long_vi', '31', 7),
('323', 'Hưng Yên', 'Hung Yen', 'Thành phố Hưng Yên', 'Hung Yen City', 'hung_yen', '33', 4),
('325', 'Văn Lâm', 'Van Lam', 'Huyện Văn Lâm', 'Van Lam District', 'van_lam', '33', 7),
('326', 'Văn Giang', 'Van Giang', 'Huyện Văn Giang', 'Van Giang District', 'van_giang', '33', 7),
('327', 'Yên Mỹ', 'Yen My', 'Huyện Yên Mỹ', 'Yen My District', 'yen_my', '33', 7),
('328', 'Mỹ Hào', 'My Hao', 'Thị xã Mỹ Hào', 'My Hao Town', 'my_hao', '33', 6),
('329', 'Ân Thi', 'An Thi', 'Huyện Ân Thi', 'An Thi District', 'an_thi', '33', 7),
('330', 'Khoái Châu', 'Khoai Chau', 'Huyện Khoái Châu', 'Khoai Chau District', 'khoai_chau', '33', 7),
('331', 'Kim Động', 'Kim Dong', 'Huyện Kim Động', 'Kim Dong District', 'kim_dong', '33', 7),
('332', 'Tiên Lữ', 'Tien Lu', 'Huyện Tiên Lữ', 'Tien Lu District', 'tien_lu', '33', 7),
('333', 'Phù Cừ', 'Phu Cu', 'Huyện Phù Cừ', 'Phu Cu District', 'phu_cu', '33', 7),
('336', 'Thái Bình', 'Thai Binh', 'Thành phố Thái Bình', 'Thai Binh City', 'thai_binh', '34', 4),
('338', 'Quỳnh Phụ', 'Quynh Phu', 'Huyện Quỳnh Phụ', 'Quynh Phu District', 'quynh_phu', '34', 7),
('339', 'Hưng Hà', 'Hung Ha', 'Huyện Hưng Hà', 'Hung Ha District', 'hung_ha', '34', 7),
('340', 'Đông Hưng', 'Dong Hung', 'Huyện Đông Hưng', 'Dong Hung District', 'dong_hung', '34', 7),
('341', 'Thái Thụy', 'Thai Thuy', 'Huyện Thái Thụy', 'Thai Thuy District', 'thai_thuy', '34', 7),
('342', 'Tiền Hải', 'Tien Hai', 'Huyện Tiền Hải', 'Tien Hai District', 'tien_hai', '34', 7),
('343', 'Kiến Xương', 'Kien Xuong', 'Huyện Kiến Xương', 'Kien Xuong District', 'kien_xuong', '34', 7),
('344', 'Vũ Thư', 'Vu Thu', 'Huyện Vũ Thư', 'Vu Thu District', 'vu_thu', '34', 7),
('347', 'Phủ Lý', 'Phu Ly', 'Thành phố Phủ Lý', 'Phu Ly City', 'phu_ly', '35', 4),
('349', 'Duy Tiên', 'Duy Tien', 'Thị xã Duy Tiên', 'Duy Tien Town', 'duy_tien', '35', 6),
('350', 'Kim Bảng', 'Kim Bang', 'Thị xã Kim Bảng', 'Kim Bang Town', 'kim_bang', '35', 6),
('351', 'Thanh Liêm', 'Thanh Liem', 'Huyện Thanh Liêm', 'Thanh Liem District', 'thanh_liem', '35', 7),
('352', 'Bình Lục', 'Binh Luc', 'Huyện Bình Lục', 'Binh Luc District', 'binh_luc', '35', 7),
('353', 'Lý Nhân', 'Ly Nhan', 'Huyện Lý Nhân', 'Ly Nhan District', 'ly_nhan', '35', 7),
('356', 'Nam Định', 'Nam Dinh', 'Thành phố Nam Định', 'Nam Dinh City', 'nam_dinh', '36', 4),
('359', 'Vụ Bản', 'Vu Ban', 'Huyện Vụ Bản', 'Vu Ban District', 'vu_ban', '36', 7),
('360', 'Ý Yên', 'Y Yen', 'Huyện Ý Yên', 'Y Yen District', 'y_yen', '36', 7),
('361', 'Nghĩa Hưng', 'Nghia Hung', 'Huyện Nghĩa Hưng', 'Nghia Hung District', 'nghia_hung', '36', 7),
('362', 'Nam Trực', 'Nam Truc', 'Huyện Nam Trực', 'Nam Truc District', 'nam_truc', '36', 7),
('363', 'Trực Ninh', 'Truc Ninh', 'Huyện Trực Ninh', 'Truc Ninh District', 'truc_ninh', '36', 7),
('364', 'Xuân Trường', 'Xuan Truong', 'Huyện Xuân Trường', 'Xuan Truong District', 'xuan_truong', '36', 7),
('365', 'Giao Thủy', 'Giao Thuy', 'Huyện Giao Thủy', 'Giao Thuy District', 'giao_thuy', '36', 7),
('366', 'Hải Hậu', 'Hai Hau', 'Huyện Hải Hậu', 'Hai Hau District', 'hai_hau', '36', 7),
('370', 'Tam Điệp', 'Tam Diep', 'Thành phố Tam Điệp', 'Tam Diep City', 'tam_diep', '37', 4),
('372', 'Nho Quan', 'Nho Quan', 'Huyện Nho Quan', 'Nho Quan District', 'nho_quan', '37', 7),
('373', 'Gia Viễn', 'Gia Vien', 'Huyện Gia Viễn', 'Gia Vien District', 'gia_vien', '37', 7),
('374', 'Hoa Lư', 'Hoa Lu', 'Thành phố Hoa Lư', 'Hoa Lu City', 'hoa_lu', '37', 4),
('375', 'Yên Khánh', 'Yen Khanh', 'Huyện Yên Khánh', 'Yen Khanh District', 'yen_khanh', '37', 7),
('376', 'Kim Sơn', 'Kim Son', 'Huyện Kim Sơn', 'Kim Son District', 'kim_son', '37', 7),
('377', 'Yên Mô', 'Yen Mo', 'Huyện Yên Mô', 'Yen Mo District', 'yen_mo', '37', 7),
('380', 'Thanh Hóa', 'Thanh Hoa', 'Thành phố Thanh Hóa', 'Thanh Hoa City', 'thanh_hoa', '38', 4),
('381', 'Bỉm Sơn', 'Bim Son', 'Thị xã Bỉm Sơn', 'Bim Son Town', 'bim_son', '38', 6),
('382', 'Sầm Sơn', 'Sam Son', 'Thành phố Sầm Sơn', 'Sam Son City', 'sam_son', '38', 4),
('384', 'Mường Lát', 'Muong Lat', 'Huyện Mường Lát', 'Muong Lat District', 'muong_lat', '38', 7),
('385', 'Quan Hóa', 'Quan Hoa', 'Huyện Quan Hóa', 'Quan Hoa District', 'quan_hoa', '38', 7),
('386', 'Bá Thước', 'Ba Thuoc', 'Huyện Bá Thước', 'Ba Thuoc District', 'ba_thuoc', '38', 7),
('387', 'Quan Sơn', 'Quan Son', 'Huyện Quan Sơn', 'Quan Son District', 'quan_son', '38', 7),
('388', 'Lang Chánh', 'Lang Chanh', 'Huyện Lang Chánh', 'Lang Chanh District', 'lang_chanh', '38', 7),
('389', 'Ngọc Lặc', 'Ngoc Lac', 'Huyện Ngọc Lặc', 'Ngoc Lac District', 'ngoc_lac', '38', 7),
('390', 'Cẩm Thủy', 'Cam Thuy', 'Huyện Cẩm Thủy', 'Cam Thuy District', 'cam_thuy', '38', 7),
('391', 'Thạch Thành', 'Thach Thanh', 'Huyện Thạch Thành', 'Thach Thanh District', 'thach_thanh', '38', 7),
('392', 'Hà Trung', 'Ha Trung', 'Huyện Hà Trung', 'Ha Trung District', 'ha_trung', '38', 7),
('393', 'Vĩnh Lộc', 'Vinh Loc', 'Huyện Vĩnh Lộc', 'Vinh Loc District', 'vinh_loc', '38', 7),
('394', 'Yên Định', 'Yen Dinh', 'Huyện Yên Định', 'Yen Dinh District', 'yen_dinh', '38', 7),
('395', 'Thọ Xuân', 'Tho Xuan', 'Huyện Thọ Xuân', 'Tho Xuan District', 'tho_xuan', '38', 7),
('396', 'Thường Xuân', 'Thuong Xuan', 'Huyện Thường Xuân', 'Thuong Xuan District', 'thuong_xuan', '38', 7),
('397', 'Triệu Sơn', 'Trieu Son', 'Huyện Triệu Sơn', 'Trieu Son District', 'trieu_son', '38', 7),
('398', 'Thiệu Hóa', 'Thieu Hoa', 'Huyện Thiệu Hóa', 'Thieu Hoa District', 'thieu_hoa', '38', 7),
('399', 'Hoằng Hóa', 'Hoang Hoa', 'Huyện Hoằng Hóa', 'Hoang Hoa District', 'hoang_hoa', '38', 7),
('400', 'Hậu Lộc', 'Hau Loc', 'Huyện Hậu Lộc', 'Hau Loc District', 'hau_loc', '38', 7),
('401', 'Nga Sơn', 'Nga Son', 'Huyện Nga Sơn', 'Nga Son District', 'nga_son', '38', 7),
('402', 'Như Xuân', 'Nhu Xuan', 'Huyện Như Xuân', 'Nhu Xuan District', 'nhu_xuan', '38', 7),
('403', 'Như Thanh', 'Nhu Thanh', 'Huyện Như Thanh', 'Nhu Thanh District', 'nhu_thanh', '38', 7),
('404', 'Nông Cống', 'Nong Cong', 'Huyện Nông Cống', 'Nong Cong District', 'nong_cong', '38', 7),
('406', 'Quảng Xương', 'Quang Xuong', 'Huyện Quảng Xương', 'Quang Xuong District', 'quang_xuong', '38', 7),
('407', 'Nghi Sơn', 'Nghi Son', 'Thị xã Nghi Sơn', 'Nghi Son Town', 'nghi_son', '38', 6),
('412', 'Vinh', 'Vinh', 'Thành phố Vinh', 'Vinh City', 'vinh', '40', 4),
('414', 'Thái Hoà', 'Thai Hoa', 'Thị xã Thái Hoà', 'Thai Hoa Town', 'thai_hoa', '40', 6),
('415', 'Quế Phong', 'Que Phong', 'Huyện Quế Phong', 'Que Phong District', 'que_phong', '40', 7),
('416', 'Quỳ Châu', 'Quy Chau', 'Huyện Quỳ Châu', 'Quy Chau District', 'quy_chau', '40', 7),
('417', 'Kỳ Sơn', 'Ky Son', 'Huyện Kỳ Sơn', 'Ky Son District', 'ky_son', '40', 7),
('418', 'Tương Dương', 'Tuong Duong', 'Huyện Tương Dương', 'Tuong Duong District', 'tuong_duong', '40', 7),
('419', 'Nghĩa Đàn', 'Nghia Dan', 'Huyện Nghĩa Đàn', 'Nghia Dan District', 'nghia_dan', '40', 7),
('420', 'Quỳ Hợp', 'Quy Hop', 'Huyện Quỳ Hợp', 'Quy Hop District', 'quy_hop', '40', 7),
('421', 'Quỳnh Lưu', 'Quynh Luu', 'Huyện Quỳnh Lưu', 'Quynh Luu District', 'quynh_luu', '40', 7),
('422', 'Con Cuông', 'Con Cuong', 'Huyện Con Cuông', 'Con Cuong District', 'con_cuong', '40', 7),
('423', 'Tân Kỳ', 'Tan Ky', 'Huyện Tân Kỳ', 'Tan Ky District', 'tan_ky', '40', 7),
('424', 'Anh Sơn', 'Anh Son', 'Huyện Anh Sơn', 'Anh Son District', 'anh_son', '40', 7),
('425', 'Diễn Châu', 'Dien Chau', 'Huyện Diễn Châu', 'Dien Chau District', 'dien_chau', '40', 7),
('426', 'Yên Thành', 'Yen Thanh', 'Huyện Yên Thành', 'Yen Thanh District', 'yen_thanh', '40', 7),
('427', 'Đô Lương', 'Do Luong', 'Huyện Đô Lương', 'Do Luong District', 'do_luong', '40', 7),
('428', 'Thanh Chương', 'Thanh Chuong', 'Huyện Thanh Chương', 'Thanh Chuong District', 'thanh_chuong', '40', 7),
('429', 'Nghi Lộc', 'Nghi Loc', 'Huyện Nghi Lộc', 'Nghi Loc District', 'nghi_loc', '40', 7),
('430', 'Nam Đàn', 'Nam Dan', 'Huyện Nam Đàn', 'Nam Dan District', 'nam_dan', '40', 7),
('431', 'Hưng Nguyên', 'Hung Nguyen', 'Huyện Hưng Nguyên', 'Hung Nguyen District', 'hung_nguyen', '40', 7),
('432', 'Hoàng Mai', 'Hoang Mai', 'Thị xã Hoàng Mai', 'Hoang Mai Town', 'hoang_mai', '40', 6),
('436', 'Hà Tĩnh', 'Ha Tinh', 'Thành phố Hà Tĩnh', 'Ha Tinh City', 'ha_tinh', '42', 4),
('437', 'Hồng Lĩnh', 'Hong Linh', 'Thị xã Hồng Lĩnh', 'Hong Linh Town', 'hong_linh', '42', 6),
('439', 'Hương Sơn', 'Huong Son', 'Huyện Hương Sơn', 'Huong Son District', 'huong_son', '42', 7),
('440', 'Đức Thọ', 'Duc Tho', 'Huyện Đức Thọ', 'Duc Tho District', 'duc_tho', '42', 7),
('441', 'Vũ Quang', 'Vu Quang', 'Huyện Vũ Quang', 'Vu Quang District', 'vu_quang', '42', 7),
('442', 'Nghi Xuân', 'Nghi Xuan', 'Huyện Nghi Xuân', 'Nghi Xuan District', 'nghi_xuan', '42', 7),
('443', 'Can Lộc', 'Can Loc', 'Huyện Can Lộc', 'Can Loc District', 'can_loc', '42', 7),
('444', 'Hương Khê', 'Huong Khe', 'Huyện Hương Khê', 'Huong Khe District', 'huong_khe', '42', 7),
('445', 'Thạch Hà', 'Thach Ha', 'Huyện Thạch Hà', 'Thach Ha District', 'thach_ha', '42', 7),
('446', 'Cẩm Xuyên', 'Cam Xuyen', 'Huyện Cẩm Xuyên', 'Cam Xuyen District', 'cam_xuyen', '42', 7),
('447', 'Kỳ Anh', 'Ky Anh', 'Huyện Kỳ Anh', 'Ky Anh District', 'ky_anh', '42', 7),
('449', 'Kỳ Anh', 'Ky Anh', 'Thị xã Kỳ Anh', 'Ky Anh Town', 'ky_anh', '42', 6),
('450', 'Đồng Hới', 'Dong Hoi', 'Thành phố Đồng Hới', 'Dong Hoi City', 'dong_hoi', '44', 4),
('452', 'Minh Hóa', 'Minh Hoa', 'Huyện Minh Hóa', 'Minh Hoa District', 'minh_hoa', '44', 7),
('453', 'Tuyên Hóa', 'Tuyen Hoa', 'Huyện Tuyên Hóa', 'Tuyen Hoa District', 'tuyen_hoa', '44', 7),
('454', 'Quảng Trạch', 'Quang Trach', 'Huyện Quảng Trạch', 'Quang Trach District', 'quang_trach', '44', 7),
('455', 'Bố Trạch', 'Bo Trach', 'Huyện Bố Trạch', 'Bo Trach District', 'bo_trach', '44', 7),
('456', 'Quảng Ninh', 'Quang Ninh', 'Huyện Quảng Ninh', 'Quang Ninh District', 'quang_ninh', '44', 7),
('457', 'Lệ Thủy', 'Le Thuy', 'Huyện Lệ Thủy', 'Le Thuy District', 'le_thuy', '44', 7),
('458', 'Ba Đồn', 'Ba Don', 'Thị xã Ba Đồn', 'Ba Don Town', 'ba_don', '44', 6),
('461', 'Đông Hà', 'Dong Ha', 'Thành phố Đông Hà', 'Dong Ha City', 'dong_ha', '45', 4),
('462', 'Quảng Trị', 'Quang Tri', 'Thị xã Quảng Trị', 'Quang Tri Town', 'quang_tri', '45', 6),
('464', 'Vĩnh Linh', 'Vinh Linh', 'Huyện Vĩnh Linh', 'Vinh Linh District', 'vinh_linh', '45', 7),
('465', 'Hướng Hóa', 'Huong Hoa', 'Huyện Hướng Hóa', 'Huong Hoa District', 'huong_hoa', '45', 7),
('466', 'Gio Linh', 'Gio Linh', 'Huyện Gio Linh', 'Gio Linh District', 'gio_linh', '45', 7),
('467', 'Đa Krông', 'Da Krong', 'Huyện Đa Krông', 'Da Krong District', 'da_krong', '45', 7),
('468', 'Cam Lộ', 'Cam Lo', 'Huyện Cam Lộ', 'Cam Lo District', 'cam_lo', '45', 7),
('469', 'Triệu Phong', 'Trieu Phong', 'Huyện Triệu Phong', 'Trieu Phong District', 'trieu_phong', '45', 7),
('470', 'Hải Lăng', 'Hai Lang', 'Huyện Hải Lăng', 'Hai Lang District', 'hai_lang', '45', 7),
('471', 'Cồn Cỏ', 'Con Co', 'Huyện Cồn Cỏ', 'Con Co District', 'con_co', '45', 7),
('474', 'Thuận Hóa', 'Thuan Hoa', 'Quận Thuận Hóa', 'Thuan Hoa District', 'thuan_hoa', '46', 5),
('475', 'Phú Xuân', 'Phu Xuan', 'Quận Phú Xuân', 'Phu Xuan District', 'phu_xuan', '46', 5),
('476', 'Phong Điền', 'Phong Dien', 'Thị xã Phong Điền', 'Phong Dien Town', 'phong_dien', '46', 6),
('477', 'Quảng Điền', 'Quang Dien', 'Huyện Quảng Điền', 'Quang Dien District', 'quang_dien', '46', 7),
('478', 'Phú Vang', 'Phu Vang', 'Huyện Phú Vang', 'Phu Vang District', 'phu_vang', '46', 7),
('479', 'Hương Thủy', 'Huong Thuy', 'Thị xã Hương Thủy', 'Huong Thuy Town', 'huong_thuy', '46', 6),
('480', 'Hương Trà', 'Huong Tra', 'Thị xã Hương Trà', 'Huong Tra Town', 'huong_tra', '46', 6),
('481', 'A Lưới', 'A Luoi', 'Huyện A Lưới', 'A Luoi District', 'a_luoi', '46', 7),
('482', 'Phú Lộc', 'Phu Loc', 'Huyện Phú Lộc', 'Phu Loc District', 'phu_loc', '46', 7),
('490', 'Liên Chiểu', 'Lien Chieu', 'Quận Liên Chiểu', 'Lien Chieu District', 'lien_chieu', '48', 5),
('491', 'Thanh Khê', 'Thanh Khe', 'Quận Thanh Khê', 'Thanh Khe District', 'thanh_khe', '48', 5),
('492', 'Hải Châu', 'Hai Chau', 'Quận Hải Châu', 'Hai Chau District', 'hai_chau', '48', 5),
('493', 'Sơn Trà', 'Son Tra', 'Quận Sơn Trà', 'Son Tra District', 'son_tra', '48', 5),
('494', 'Ngũ Hành Sơn', 'Ngu Hanh Son', 'Quận Ngũ Hành Sơn', 'Ngu Hanh Son District', 'ngu_hanh_son', '48', 5),
('495', 'Cẩm Lệ', 'Cam Le', 'Quận Cẩm Lệ', 'Cam Le District', 'cam_le', '48', 5),
('497', 'Hòa Vang', 'Hoa Vang', 'Huyện Hòa Vang', 'Hoa Vang District', 'hoa_vang', '48', 7),
('498', 'Hoàng Sa', 'Hoang Sa', 'Huyện Hoàng Sa', 'Hoang Sa District', 'hoang_sa', '48', 7),
('502', 'Tam Kỳ', 'Tam Ky', 'Thành phố Tam Kỳ', 'Tam Ky City', 'tam_ky', '49', 4),
('503', 'Hội An', 'Hoi An', 'Thành phố Hội An', 'Hoi An City', 'hoi_an', '49', 4),
('504', 'Tây Giang', 'Tay Giang', 'Huyện Tây Giang', 'Tay Giang District', 'tay_giang', '49', 7),
('505', 'Đông Giang', 'Dong Giang', 'Huyện Đông Giang', 'Dong Giang District', 'dong_giang', '49', 7),
('506', 'Đại Lộc', 'Dai Loc', 'Huyện Đại Lộc', 'Dai Loc District', 'dai_loc', '49', 7),
('507', 'Điện Bàn', 'Dien Ban', 'Thị xã Điện Bàn', 'Dien Ban Town', 'dien_ban', '49', 6),
('508', 'Duy Xuyên', 'Duy Xuyen', 'Huyện Duy Xuyên', 'Duy Xuyen District', 'duy_xuyen', '49', 7),
('509', 'Quế Sơn', 'Que Son', 'Huyện Quế Sơn', 'Que Son District', 'que_son', '49', 7),
('510', 'Nam Giang', 'Nam Giang', 'Huyện Nam Giang', 'Nam Giang District', 'nam_giang', '49', 7),
('511', 'Phước Sơn', 'Phuoc Son', 'Huyện Phước Sơn', 'Phuoc Son District', 'phuoc_son', '49', 7),
('512', 'Hiệp Đức', 'Hiep Duc', 'Huyện Hiệp Đức', 'Hiep Duc District', 'hiep_duc', '49', 7),
('513', 'Thăng Bình', 'Thang Binh', 'Huyện Thăng Bình', 'Thang Binh District', 'thang_binh', '49', 7),
('514', 'Tiên Phước', 'Tien Phuoc', 'Huyện Tiên Phước', 'Tien Phuoc District', 'tien_phuoc', '49', 7),
('515', 'Bắc Trà My', 'Bac Tra My', 'Huyện Bắc Trà My', 'Bac Tra My District', 'bac_tra_my', '49', 7),
('516', 'Nam Trà My', 'Nam Tra My', 'Huyện Nam Trà My', 'Nam Tra My District', 'nam_tra_my', '49', 7),
('517', 'Núi Thành', 'Nui Thanh', 'Huyện Núi Thành', 'Nui Thanh District', 'nui_thanh', '49', 7),
('518', 'Phú Ninh', 'Phu Ninh', 'Huyện Phú Ninh', 'Phu Ninh District', 'phu_ninh', '49', 7),
('522', 'Quảng Ngãi', 'Quang Ngai', 'Thành phố Quảng Ngãi', 'Quang Ngai City', 'quang_ngai', '51', 4),
('524', 'Bình Sơn', 'Binh Son', 'Huyện Bình Sơn', 'Binh Son District', 'binh_son', '51', 7),
('525', 'Trà Bồng', 'Tra Bong', 'Huyện Trà Bồng', 'Tra Bong District', 'tra_bong', '51', 7),
('527', 'Sơn Tịnh', 'Son Tinh', 'Huyện Sơn Tịnh', 'Son Tinh District', 'son_tinh', '51', 7),
('528', 'Tư Nghĩa', 'Tu Nghia', 'Huyện Tư Nghĩa', 'Tu Nghia District', 'tu_nghia', '51', 7),
('529', 'Sơn Hà', 'Son Ha', 'Huyện Sơn Hà', 'Son Ha District', 'son_ha', '51', 7),
('530', 'Sơn Tây', 'Son Tay', 'Huyện Sơn Tây', 'Son Tay District', 'son_tay', '51', 7),
('531', 'Minh Long', 'Minh Long', 'Huyện Minh Long', 'Minh Long District', 'minh_long', '51', 7),
('532', 'Nghĩa Hành', 'Nghia Hanh', 'Huyện Nghĩa Hành', 'Nghia Hanh District', 'nghia_hanh', '51', 7),
('533', 'Mộ Đức', 'Mo Duc', 'Huyện Mộ Đức', 'Mo Duc District', 'mo_duc', '51', 7),
('534', 'Đức Phổ', 'Duc Pho', 'Thị xã Đức Phổ', 'Duc Pho Town', 'duc_pho', '51', 6),
('535', 'Ba Tơ', 'Ba To', 'Huyện Ba Tơ', 'Ba To District', 'ba_to', '51', 7),
('536', 'Lý Sơn', 'Ly Son', 'Huyện Lý Sơn', 'Ly Son District', 'ly_son', '51', 7),
('540', 'Quy Nhơn', 'Quy Nhon', 'Thành phố Quy Nhơn', 'Quy Nhon City', 'quy_nhon', '52', 4),
('542', 'An Lão', 'An Lao', 'Huyện An Lão', 'An Lao District', 'an_lao', '52', 7),
('543', 'Hoài Nhơn', 'Hoai Nhon', 'Thị xã Hoài Nhơn', 'Hoai Nhon Town', 'hoai_nhon', '52', 6),
('544', 'Hoài Ân', 'Hoai An', 'Huyện Hoài Ân', 'Hoai An District', 'hoai_an', '52', 7),
('545', 'Phù Mỹ', 'Phu My', 'Huyện Phù Mỹ', 'Phu My District', 'phu_my', '52', 7),
('546', 'Vĩnh Thạnh', 'Vinh Thanh', 'Huyện Vĩnh Thạnh', 'Vinh Thanh District', 'vinh_thanh', '52', 7),
('547', 'Tây Sơn', 'Tay Son', 'Huyện Tây Sơn', 'Tay Son District', 'tay_son', '52', 7),
('548', 'Phù Cát', 'Phu Cat', 'Huyện Phù Cát', 'Phu Cat District', 'phu_cat', '52', 7),
('549', 'An Nhơn', 'An Nhon', 'Thị xã An Nhơn', 'An Nhon Town', 'an_nhon', '52', 6),
('550', 'Tuy Phước', 'Tuy Phuoc', 'Huyện Tuy Phước', 'Tuy Phuoc District', 'tuy_phuoc', '52', 7),
('551', 'Vân Canh', 'Van Canh', 'Huyện Vân Canh', 'Van Canh District', 'van_canh', '52', 7),
('555', 'Tuy Hoà', 'Tuy Hoa', 'Thành phố Tuy Hoà', 'Tuy Hoa City', 'tuy_hoa', '54', 4),
('557', 'Sông Cầu', 'Song Cau', 'Thị xã Sông Cầu', 'Song Cau Town', 'song_cau', '54', 6),
('558', 'Đồng Xuân', 'Dong Xuan', 'Huyện Đồng Xuân', 'Dong Xuan District', 'dong_xuan', '54', 7),
('559', 'Tuy An', 'Tuy An', 'Huyện Tuy An', 'Tuy An District', 'tuy_an', '54', 7),
('560', 'Sơn Hòa', 'Son Hoa', 'Huyện Sơn Hòa', 'Son Hoa District', 'son_hoa', '54', 7),
('561', 'Sông Hinh', 'Song Hinh', 'Huyện Sông Hinh', 'Song Hinh District', 'song_hinh', '54', 7),
('562', 'Tây Hoà', 'Tay Hoa', 'Huyện Tây Hoà', 'Tay Hoa District', 'tay_hoa', '54', 7),
('563', 'Phú Hoà', 'Phu Hoa', 'Huyện Phú Hoà', 'Phu Hoa District', 'phu_hoa', '54', 7),
('564', 'Đông Hòa', 'Dong Hoa', 'Thị xã Đông Hòa', 'Dong Hoa Town', 'dong_hoa', '54', 6),
('568', 'Nha Trang', 'Nha Trang', 'Thành phố Nha Trang', 'Nha Trang City', 'nha_trang', '56', 4),
('569', 'Cam Ranh', 'Cam Ranh', 'Thành phố Cam Ranh', 'Cam Ranh City', 'cam_ranh', '56', 4),
('570', 'Cam Lâm', 'Cam Lam', 'Huyện Cam Lâm', 'Cam Lam District', 'cam_lam', '56', 7),
('571', 'Vạn Ninh', 'Van Ninh', 'Huyện Vạn Ninh', 'Van Ninh District', 'van_ninh', '56', 7),
('572', 'Ninh Hòa', 'Ninh Hoa', 'Thị xã Ninh Hòa', 'Ninh Hoa Town', 'ninh_hoa', '56', 6),
('573', 'Khánh Vĩnh', 'Khanh Vinh', 'Huyện Khánh Vĩnh', 'Khanh Vinh District', 'khanh_vinh', '56', 7),
('574', 'Diên Khánh', 'Dien Khanh', 'Huyện Diên Khánh', 'Dien Khanh District', 'dien_khanh', '56', 7),
('575', 'Khánh Sơn', 'Khanh Son', 'Huyện Khánh Sơn', 'Khanh Son District', 'khanh_son', '56', 7),
('576', 'Trường Sa', 'Truong Sa', 'Huyện Trường Sa', 'Truong Sa District', 'truong_sa', '56', 7),
('582', 'Phan Rang-Tháp Chàm', 'Phan Rang-Thap Cham', 'Thành phố Phan Rang-Tháp Chàm', 'Phan Rang-Thap Cham City', 'phan_rang-thap_cham', '58', 4),
('584', 'Bác Ái', 'Bac Ai', 'Huyện Bác Ái', 'Bac Ai District', 'bac_ai', '58', 7),
('585', 'Ninh Sơn', 'Ninh Son', 'Huyện Ninh Sơn', 'Ninh Son District', 'ninh_son', '58', 7),
('586', 'Ninh Hải', 'Ninh Hai', 'Huyện Ninh Hải', 'Ninh Hai District', 'ninh_hai', '58', 7),
('587', 'Ninh Phước', 'Ninh Phuoc', 'Huyện Ninh Phước', 'Ninh Phuoc District', 'ninh_phuoc', '58', 7),
('588', 'Thuận Bắc', 'Thuan Bac', 'Huyện Thuận Bắc', 'Thuan Bac District', 'thuan_bac', '58', 7),
('589', 'Thuận Nam', 'Thuan Nam', 'Huyện Thuận Nam', 'Thuan Nam District', 'thuan_nam', '58', 7),
('593', 'Phan Thiết', 'Phan Thiet', 'Thành phố Phan Thiết', 'Phan Thiet City', 'phan_thiet', '60', 4),
('594', 'La Gi', 'La Gi', 'Thị xã La Gi', 'La Gi Town', 'la_gi', '60', 6),
('595', 'Tuy Phong', 'Tuy Phong', 'Huyện Tuy Phong', 'Tuy Phong District', 'tuy_phong', '60', 7),
('596', 'Bắc Bình', 'Bac Binh', 'Huyện Bắc Bình', 'Bac Binh District', 'bac_binh', '60', 7),
('597', 'Hàm Thuận Bắc', 'Ham Thuan Bac', 'Huyện Hàm Thuận Bắc', 'Ham Thuan Bac District', 'ham_thuan_bac', '60', 7),
('598', 'Hàm Thuận Nam', 'Ham Thuan Nam', 'Huyện Hàm Thuận Nam', 'Ham Thuan Nam District', 'ham_thuan_nam', '60', 7),
('599', 'Tánh Linh', 'Tanh Linh', 'Huyện Tánh Linh', 'Tanh Linh District', 'tanh_linh', '60', 7),
('600', 'Đức Linh', 'Duc Linh', 'Huyện Đức Linh', 'Duc Linh District', 'duc_linh', '60', 7),
('601', 'Hàm Tân', 'Ham Tan', 'Huyện Hàm Tân', 'Ham Tan District', 'ham_tan', '60', 7),
('602', 'Phú Quí', 'Phu Qui', 'Huyện Phú Quí', 'Phu Qui District', 'phu_qui', '60', 7),
('608', 'Kon Tum', 'Kon Tum', 'Thành phố Kon Tum', 'Kon Tum City', 'kon_tum', '62', 4),
('610', 'Đắk Glei', 'Dak Glei', 'Huyện Đắk Glei', 'Dak Glei District', 'dak_glei', '62', 7),
('611', 'Ngọc Hồi', 'Ngoc Hoi', 'Huyện Ngọc Hồi', 'Ngoc Hoi District', 'ngoc_hoi', '62', 7),
('612', 'Đắk Tô', 'Dak To', 'Huyện Đắk Tô', 'Dak To District', 'dak_to', '62', 7),
('613', 'Kon Plông', 'Kon Plong', 'Huyện Kon Plông', 'Kon Plong District', 'kon_plong', '62', 7),
('614', 'Kon Rẫy', 'Kon Ray', 'Huyện Kon Rẫy', 'Kon Ray District', 'kon_ray', '62', 7),
('615', 'Đắk Hà', 'Dak Ha', 'Huyện Đắk Hà', 'Dak Ha District', 'dak_ha', '62', 7),
('616', 'Sa Thầy', 'Sa Thay', 'Huyện Sa Thầy', 'Sa Thay District', 'sa_thay', '62', 7),
('617', 'Tu Mơ Rông', 'Tu Mo Rong', 'Huyện Tu Mơ Rông', 'Tu Mo Rong District', 'tu_mo_rong', '62', 7),
('618', 'Ia H\' Drai', 'Ia H\' Drai', 'Huyện Ia H\' Drai', 'Ia H\' Drai District', 'ia_h_drai', '62', 7),
('622', 'Pleiku', 'Pleiku', 'Thành phố Pleiku', 'Pleiku City', 'pleiku', '64', 4),
('623', 'An Khê', 'An Khe', 'Thị xã An Khê', 'An Khe Town', 'an_khe', '64', 6),
('624', 'Ayun Pa', 'Ayun Pa', 'Thị xã Ayun Pa', 'Ayun Pa Town', 'ayun_pa', '64', 6),
('625', 'KBang', 'KBang', 'Huyện KBang', 'KBang District', 'kbang', '64', 7),
('626', 'Đăk Đoa', 'Dak Doa', 'Huyện Đăk Đoa', 'Dak Doa District', 'dak_doa', '64', 7),
('627', 'Chư Păh', 'Chu Pah', 'Huyện Chư Păh', 'Chu Pah District', 'chu_pah', '64', 7),
('628', 'Ia Grai', 'Ia Grai', 'Huyện Ia Grai', 'Ia Grai District', 'ia_grai', '64', 7),
('629', 'Mang Yang', 'Mang Yang', 'Huyện Mang Yang', 'Mang Yang District', 'mang_yang', '64', 7),
('630', 'Kông Chro', 'Kong Chro', 'Huyện Kông Chro', 'Kong Chro District', 'kong_chro', '64', 7),
('631', 'Đức Cơ', 'Duc Co', 'Huyện Đức Cơ', 'Duc Co District', 'duc_co', '64', 7),
('632', 'Chư Prông', 'Chu Prong', 'Huyện Chư Prông', 'Chu Prong District', 'chu_prong', '64', 7),
('633', 'Chư Sê', 'Chu Se', 'Huyện Chư Sê', 'Chu Se District', 'chu_se', '64', 7),
('634', 'Đăk Pơ', 'Dak Po', 'Huyện Đăk Pơ', 'Dak Po District', 'dak_po', '64', 7),
('635', 'Ia Pa', 'Ia Pa', 'Huyện Ia Pa', 'Ia Pa District', 'ia_pa', '64', 7),
('637', 'Krông Pa', 'Krong Pa', 'Huyện Krông Pa', 'Krong Pa District', 'krong_pa', '64', 7),
('638', 'Phú Thiện', 'Phu Thien', 'Huyện Phú Thiện', 'Phu Thien District', 'phu_thien', '64', 7),
('639', 'Chư Pưh', 'Chu Puh', 'Huyện Chư Pưh', 'Chu Puh District', 'chu_puh', '64', 7),
('643', 'Buôn Ma Thuột', 'Buon Ma Thuot', 'Thành phố Buôn Ma Thuột', 'Buon Ma Thuot City', 'buon_ma_thuot', '66', 4),
('644', 'Buôn Hồ', 'Buon Ho', 'Thị xã Buôn Hồ', 'Buon Ho Town', 'buon_ho', '66', 6),
('645', 'Ea H\'leo', 'Ea H\'leo', 'Huyện Ea H\'leo', 'Ea H\'leo District', 'ea_hleo', '66', 7),
('646', 'Ea Súp', 'Ea Sup', 'Huyện Ea Súp', 'Ea Sup District', 'ea_sup', '66', 7),
('647', 'Buôn Đôn', 'Buon Don', 'Huyện Buôn Đôn', 'Buon Don District', 'buon_don', '66', 7),
('648', 'Cư M\'gar', 'Cu M\'gar', 'Huyện Cư M\'gar', 'Cu M\'gar District', 'cu_mgar', '66', 7),
('649', 'Krông Búk', 'Krong Buk', 'Huyện Krông Búk', 'Krong Buk District', 'krong_buk', '66', 7),
('650', 'Krông Năng', 'Krong Nang', 'Huyện Krông Năng', 'Krong Nang District', 'krong_nang', '66', 7),
('651', 'Ea Kar', 'Ea Kar', 'Huyện Ea Kar', 'Ea Kar District', 'ea_kar', '66', 7),
('652', 'M\'Đrắk', 'M\'Drak', 'Huyện M\'Đrắk', 'M\'Drak District', 'mdrak', '66', 7),
('653', 'Krông Bông', 'Krong Bong', 'Huyện Krông Bông', 'Krong Bong District', 'krong_bong', '66', 7),
('654', 'Krông Pắc', 'Krong Pac', 'Huyện Krông Pắc', 'Krong Pac District', 'krong_pac', '66', 7),
('655', 'Krông A Na', 'Krong A Na', 'Huyện Krông A Na', 'Krong A Na District', 'krong_a_na', '66', 7),
('656', 'Lắk', 'Lak', 'Huyện Lắk', 'Lak District', 'lak', '66', 7),
('657', 'Cư Kuin', 'Cu Kuin', 'Huyện Cư Kuin', 'Cu Kuin District', 'cu_kuin', '66', 7),
('660', 'Gia Nghĩa', 'Gia Nghia', 'Thành phố Gia Nghĩa', 'Gia Nghia City', 'gia_nghia', '67', 4),
('661', 'Đăk Glong', 'Dak Glong', 'Huyện Đăk Glong', 'Dak Glong District', 'dak_glong', '67', 7),
('662', 'Cư Jút', 'Cu Jut', 'Huyện Cư Jút', 'Cu Jut District', 'cu_jut', '67', 7),
('663', 'Đắk Mil', 'Dak Mil', 'Huyện Đắk Mil', 'Dak Mil District', 'dak_mil', '67', 7),
('664', 'Krông Nô', 'Krong No', 'Huyện Krông Nô', 'Krong No District', 'krong_no', '67', 7),
('665', 'Đắk Song', 'Dak Song', 'Huyện Đắk Song', 'Dak Song District', 'dak_song', '67', 7),
('666', 'Đắk R\'Lấp', 'Dak R\'Lap', 'Huyện Đắk R\'Lấp', 'Dak R\'Lap District', 'dak_rlap', '67', 7),
('667', 'Tuy Đức', 'Tuy Duc', 'Huyện Tuy Đức', 'Tuy Duc District', 'tuy_duc', '67', 7),
('672', 'Đà Lạt', 'Da Lat', 'Thành phố Đà Lạt', 'Da Lat City', 'da_lat', '68', 4),
('673', 'Bảo Lộc', 'Bao Loc', 'Thành phố Bảo Lộc', 'Bao Loc City', 'bao_loc', '68', 4),
('674', 'Đam Rông', 'Dam Rong', 'Huyện Đam Rông', 'Dam Rong District', 'dam_rong', '68', 7),
('675', 'Lạc Dương', 'Lac Duong', 'Huyện Lạc Dương', 'Lac Duong District', 'lac_duong', '68', 7),
('676', 'Lâm Hà', 'Lam Ha', 'Huyện Lâm Hà', 'Lam Ha District', 'lam_ha', '68', 7),
('677', 'Đơn Dương', 'Don Duong', 'Huyện Đơn Dương', 'Don Duong District', 'don_duong', '68', 7),
('678', 'Đức Trọng', 'Duc Trong', 'Huyện Đức Trọng', 'Duc Trong District', 'duc_trong', '68', 7),
('679', 'Di Linh', 'Di Linh', 'Huyện Di Linh', 'Di Linh District', 'di_linh', '68', 7),
('680', 'Bảo Lâm', 'Bao Lam', 'Huyện Bảo Lâm', 'Bao Lam District', 'bao_lam', '68', 7),
('682', 'Đạ Tẻh', 'Da Teh', 'Huyện Đạ Tẻh', 'Da Teh District', 'da_teh', '68', 7),
('688', 'Phước Long', 'Phuoc Long', 'Thị xã Phước Long', 'Phuoc Long Town', 'phuoc_long', '70', 6),
('689', 'Đồng Xoài', 'Dong Xoai', 'Thành phố Đồng Xoài', 'Dong Xoai City', 'dong_xoai', '70', 4),
('690', 'Bình Long', 'Binh Long', 'Thị xã Bình Long', 'Binh Long Town', 'binh_long', '70', 6),
('691', 'Bù Gia Mập', 'Bu Gia Map', 'Huyện Bù Gia Mập', 'Bu Gia Map District', 'bu_gia_map', '70', 7),
('692', 'Lộc Ninh', 'Loc Ninh', 'Huyện Lộc Ninh', 'Loc Ninh District', 'loc_ninh', '70', 7),
('693', 'Bù Đốp', 'Bu Dop', 'Huyện Bù Đốp', 'Bu Dop District', 'bu_dop', '70', 7),
('694', 'Hớn Quản', 'Hon Quan', 'Huyện Hớn Quản', 'Hon Quan District', 'hon_quan', '70', 7),
('695', 'Đồng Phú', 'Dong Phu', 'Huyện Đồng Phú', 'Dong Phu District', 'dong_phu', '70', 7),
('696', 'Bù Đăng', 'Bu Dang', 'Huyện Bù Đăng', 'Bu Dang District', 'bu_dang', '70', 7),
('697', 'Chơn Thành', 'Chon Thanh', 'Thị xã Chơn Thành', 'Chon Thanh Town', 'chon_thanh', '70', 6),
('698', 'Phú Riềng', 'Phu Rieng', 'Huyện Phú Riềng', 'Phu Rieng District', 'phu_rieng', '70', 7),
('703', 'Tây Ninh', 'Tay Ninh', 'Thành phố Tây Ninh', 'Tay Ninh City', 'tay_ninh', '72', 4),
('705', 'Tân Biên', 'Tan Bien', 'Huyện Tân Biên', 'Tan Bien District', 'tan_bien', '72', 7),
('706', 'Tân Châu', 'Tan Chau', 'Huyện Tân Châu', 'Tan Chau District', 'tan_chau', '72', 7),
('707', 'Dương Minh Châu', 'Duong Minh Chau', 'Huyện Dương Minh Châu', 'Duong Minh Chau District', 'duong_minh_chau', '72', 7),
('708', 'Châu Thành', 'Chau Thanh', 'Huyện Châu Thành', 'Chau Thanh District', 'chau_thanh', '72', 7),
('709', 'Hòa Thành', 'Hoa Thanh', 'Thị xã Hòa Thành', 'Hoa Thanh Town', 'hoa_thanh', '72', 6),
('710', 'Gò Dầu', 'Go Dau', 'Huyện Gò Dầu', 'Go Dau District', 'go_dau', '72', 7),
('711', 'Bến Cầu', 'Ben Cau', 'Huyện Bến Cầu', 'Ben Cau District', 'ben_cau', '72', 7),
('712', 'Trảng Bàng', 'Trang Bang', 'Thị xã Trảng Bàng', 'Trang Bang Town', 'trang_bang', '72', 6),
('718', 'Thủ Dầu Một', 'Thu Dau Mot', 'Thành phố Thủ Dầu Một', 'Thu Dau Mot City', 'thu_dau_mot', '74', 4),
('719', 'Bàu Bàng', 'Bau Bang', 'Huyện Bàu Bàng', 'Bau Bang District', 'bau_bang', '74', 7),
('720', 'Dầu Tiếng', 'Dau Tieng', 'Huyện Dầu Tiếng', 'Dau Tieng District', 'dau_tieng', '74', 7),
('721', 'Bến Cát', 'Ben Cat', 'Thành phố Bến Cát', 'Ben Cat City', 'ben_cat', '74', 4),
('722', 'Phú Giáo', 'Phu Giao', 'Huyện Phú Giáo', 'Phu Giao District', 'phu_giao', '74', 7),
('723', 'Tân Uyên', 'Tan Uyen', 'Thành phố Tân Uyên', 'Tan Uyen City', 'tan_uyen', '74', 4),
('724', 'Dĩ An', 'Di An', 'Thành phố Dĩ An', 'Di An City', 'di_an', '74', 4),
('725', 'Thuận An', 'Thuan An', 'Thành phố Thuận An', 'Thuan An City', 'thuan_an', '74', 4),
('726', 'Bắc Tân Uyên', 'Bac Tan Uyen', 'Huyện Bắc Tân Uyên', 'Bac Tan Uyen District', 'bac_tan_uyen', '74', 7),
('731', 'Biên Hòa', 'Bien Hoa', 'Thành phố Biên Hòa', 'Bien Hoa City', 'bien_hoa', '75', 4),
('732', 'Long Khánh', 'Long Khanh', 'Thành phố Long Khánh', 'Long Khanh City', 'long_khanh', '75', 4),
('734', 'Tân Phú', 'Tan Phu', 'Huyện Tân Phú', 'Tan Phu District', 'tan_phu', '75', 7),
('735', 'Vĩnh Cửu', 'Vinh Cuu', 'Huyện Vĩnh Cửu', 'Vinh Cuu District', 'vinh_cuu', '75', 7),
('736', 'Định Quán', 'Dinh Quan', 'Huyện Định Quán', 'Dinh Quan District', 'dinh_quan', '75', 7),
('737', 'Trảng Bom', 'Trang Bom', 'Huyện Trảng Bom', 'Trang Bom District', 'trang_bom', '75', 7),
('738', 'Thống Nhất', 'Thong Nhat', 'Huyện Thống Nhất', 'Thong Nhat District', 'thong_nhat', '75', 7),
('739', 'Cẩm Mỹ', 'Cam My', 'Huyện Cẩm Mỹ', 'Cam My District', 'cam_my', '75', 7),
('740', 'Long Thành', 'Long Thanh', 'Huyện Long Thành', 'Long Thanh District', 'long_thanh', '75', 7),
('741', 'Xuân Lộc', 'Xuan Loc', 'Huyện Xuân Lộc', 'Xuan Loc District', 'xuan_loc', '75', 7),
('742', 'Nhơn Trạch', 'Nhon Trach', 'Huyện Nhơn Trạch', 'Nhon Trach District', 'nhon_trach', '75', 7),
('747', 'Vũng Tàu', 'Vung Tau', 'Thành phố Vũng Tàu', 'Vung Tau City', 'vung_tau', '77', 4),
('748', 'Bà Rịa', 'Ba Ria', 'Thành phố Bà Rịa', 'Ba Ria City', 'ba_ria', '77', 4),
('750', 'Châu Đức', 'Chau Duc', 'Huyện Châu Đức', 'Chau Duc District', 'chau_duc', '77', 7),
('751', 'Xuyên Mộc', 'Xuyen Moc', 'Huyện Xuyên Mộc', 'Xuyen Moc District', 'xuyen_moc', '77', 7),
('753', 'Long Đất', 'Long Dat', 'Huyện Long Đất', 'Long Dat District', 'long_dat', '77', 7),
('754', 'Phú Mỹ', 'Phu My', 'Thành phố Phú Mỹ', 'Phu My City', 'phu_my', '77', 4),
('755', 'Côn Đảo', 'Con Dao', 'Huyện Côn Đảo', 'Con Dao District', 'con_dao', '77', 7),
('760', '1', '1', 'Quận 1', 'District 1', '1', '79', 5),
('761', '12', '12', 'Quận 12', 'District 12', '12', '79', 5),
('764', 'Gò Vấp', 'Go Vap', 'Quận Gò Vấp', 'Go Vap District', 'go_vap', '79', 5),
('765', 'Bình Thạnh', 'Binh Thanh', 'Quận Bình Thạnh', 'Binh Thanh District', 'binh_thanh', '79', 5),
('766', 'Tân Bình', 'Tan Binh', 'Quận Tân Bình', 'Tan Binh District', 'tan_binh', '79', 5),
('767', 'Tân Phú', 'Tan Phu', 'Quận Tân Phú', 'Tan Phu District', 'tan_phu', '79', 5),
('768', 'Phú Nhuận', 'Phu Nhuan', 'Quận Phú Nhuận', 'Phu Nhuan District', 'phu_nhuan', '79', 5);
INSERT INTO `quan` (`code`, `name`, `name_en`, `full_name`, `full_name_en`, `code_name`, `province_code`, `administrative_unit_id`) VALUES
('769', 'Thủ Đức', 'Thu Duc', 'Thành phố Thủ Đức', 'Thu Duc City', 'thu_duc', '79', 3),
('770', '3', '3', 'Quận 3', 'District 3', '3', '79', 5),
('771', '10', '10', 'Quận 10', 'District 10', '10', '79', 5),
('772', '11', '11', 'Quận 11', 'District 11', '11', '79', 5),
('773', '4', '4', 'Quận 4', 'District 4', '4', '79', 5),
('774', '5', '5', 'Quận 5', 'District 5', '5', '79', 5),
('775', '6', '6', 'Quận 6', 'District 6', '6', '79', 5),
('776', '8', '8', 'Quận 8', 'District 8', '8', '79', 5),
('777', 'Bình Tân', 'Binh Tan', 'Quận Bình Tân', 'Binh Tan District', 'binh_tan', '79', 5),
('778', '7', '7', 'Quận 7', 'District 7', '7', '79', 5),
('783', 'Củ Chi', 'Cu Chi', 'Huyện Củ Chi', 'Cu Chi District', 'cu_chi', '79', 7),
('784', 'Hóc Môn', 'Hoc Mon', 'Huyện Hóc Môn', 'Hoc Mon District', 'hoc_mon', '79', 7),
('785', 'Bình Chánh', 'Binh Chanh', 'Huyện Bình Chánh', 'Binh Chanh District', 'binh_chanh', '79', 7),
('786', 'Nhà Bè', 'Nha Be', 'Huyện Nhà Bè', 'Nha Be District', 'nha_be', '79', 7),
('787', 'Cần Giờ', 'Can Gio', 'Huyện Cần Giờ', 'Can Gio District', 'can_gio', '79', 7),
('794', 'Tân An', 'Tan An', 'Thành phố Tân An', 'Tan An City', 'tan_an', '80', 4),
('795', 'Kiến Tường', 'Kien Tuong', 'Thị xã Kiến Tường', 'Kien Tuong Town', 'kien_tuong', '80', 6),
('796', 'Tân Hưng', 'Tan Hung', 'Huyện Tân Hưng', 'Tan Hung District', 'tan_hung', '80', 7),
('797', 'Vĩnh Hưng', 'Vinh Hung', 'Huyện Vĩnh Hưng', 'Vinh Hung District', 'vinh_hung', '80', 7),
('798', 'Mộc Hóa', 'Moc Hoa', 'Huyện Mộc Hóa', 'Moc Hoa District', 'moc_hoa', '80', 7),
('799', 'Tân Thạnh', 'Tan Thanh', 'Huyện Tân Thạnh', 'Tan Thanh District', 'tan_thanh', '80', 7),
('800', 'Thạnh Hóa', 'Thanh Hoa', 'Huyện Thạnh Hóa', 'Thanh Hoa District', 'thanh_hoa', '80', 7),
('801', 'Đức Huệ', 'Duc Hue', 'Huyện Đức Huệ', 'Duc Hue District', 'duc_hue', '80', 7),
('802', 'Đức Hòa', 'Duc Hoa', 'Huyện Đức Hòa', 'Duc Hoa District', 'duc_hoa', '80', 7),
('803', 'Bến Lức', 'Ben Luc', 'Huyện Bến Lức', 'Ben Luc District', 'ben_luc', '80', 7),
('804', 'Thủ Thừa', 'Thu Thua', 'Huyện Thủ Thừa', 'Thu Thua District', 'thu_thua', '80', 7),
('805', 'Tân Trụ', 'Tan Tru', 'Huyện Tân Trụ', 'Tan Tru District', 'tan_tru', '80', 7),
('806', 'Cần Đước', 'Can Duoc', 'Huyện Cần Đước', 'Can Duoc District', 'can_duoc', '80', 7),
('807', 'Cần Giuộc', 'Can Giuoc', 'Huyện Cần Giuộc', 'Can Giuoc District', 'can_giuoc', '80', 7),
('808', 'Châu Thành', 'Chau Thanh', 'Huyện Châu Thành', 'Chau Thanh District', 'chau_thanh', '80', 7),
('815', 'Mỹ Tho', 'My Tho', 'Thành phố Mỹ Tho', 'My Tho City', 'my_tho', '82', 4),
('816', 'Gò Công', 'Go Cong', 'Thành phố Gò Công', 'Go Cong City', 'go_cong', '82', 4),
('817', 'Cai Lậy', 'Cai Lay', 'Thị xã Cai Lậy', 'Cai Lay Town', 'cai_lay', '82', 6),
('818', 'Tân Phước', 'Tan Phuoc', 'Huyện Tân Phước', 'Tan Phuoc District', 'tan_phuoc', '82', 7),
('819', 'Cái Bè', 'Cai Be', 'Huyện Cái Bè', 'Cai Be District', 'cai_be', '82', 7),
('820', 'Cai Lậy', 'Cai Lay', 'Huyện Cai Lậy', 'Cai Lay District', 'cai_lay', '82', 7),
('821', 'Châu Thành', 'Chau Thanh', 'Huyện Châu Thành', 'Chau Thanh District', 'chau_thanh', '82', 7),
('822', 'Chợ Gạo', 'Cho Gao', 'Huyện Chợ Gạo', 'Cho Gao District', 'cho_gao', '82', 7),
('823', 'Gò Công Tây', 'Go Cong Tay', 'Huyện Gò Công Tây', 'Go Cong Tay District', 'go_cong_tay', '82', 7),
('824', 'Gò Công Đông', 'Go Cong Dong', 'Huyện Gò Công Đông', 'Go Cong Dong District', 'go_cong_dong', '82', 7),
('825', 'Tân Phú Đông', 'Tan Phu Dong', 'Huyện Tân Phú Đông', 'Tan Phu Dong District', 'tan_phu_dong', '82', 7),
('829', 'Bến Tre', 'Ben Tre', 'Thành phố Bến Tre', 'Ben Tre City', 'ben_tre', '83', 4),
('831', 'Châu Thành', 'Chau Thanh', 'Huyện Châu Thành', 'Chau Thanh District', 'chau_thanh', '83', 7),
('832', 'Chợ Lách', 'Cho Lach', 'Huyện Chợ Lách', 'Cho Lach District', 'cho_lach', '83', 7),
('833', 'Mỏ Cày Nam', 'Mo Cay Nam', 'Huyện Mỏ Cày Nam', 'Mo Cay Nam District', 'mo_cay_nam', '83', 7),
('834', 'Giồng Trôm', 'Giong Trom', 'Huyện Giồng Trôm', 'Giong Trom District', 'giong_trom', '83', 7),
('835', 'Bình Đại', 'Binh Dai', 'Huyện Bình Đại', 'Binh Dai District', 'binh_dai', '83', 7),
('836', 'Ba Tri', 'Ba Tri', 'Huyện Ba Tri', 'Ba Tri District', 'ba_tri', '83', 7),
('837', 'Thạnh Phú', 'Thanh Phu', 'Huyện Thạnh Phú', 'Thanh Phu District', 'thanh_phu', '83', 7),
('838', 'Mỏ Cày Bắc', 'Mo Cay Bac', 'Huyện Mỏ Cày Bắc', 'Mo Cay Bac District', 'mo_cay_bac', '83', 7),
('842', 'Trà Vinh', 'Tra Vinh', 'Thành phố Trà Vinh', 'Tra Vinh City', 'tra_vinh', '84', 4),
('844', 'Càng Long', 'Cang Long', 'Huyện Càng Long', 'Cang Long District', 'cang_long', '84', 7),
('845', 'Cầu Kè', 'Cau Ke', 'Huyện Cầu Kè', 'Cau Ke District', 'cau_ke', '84', 7),
('846', 'Tiểu Cần', 'Tieu Can', 'Huyện Tiểu Cần', 'Tieu Can District', 'tieu_can', '84', 7),
('847', 'Châu Thành', 'Chau Thanh', 'Huyện Châu Thành', 'Chau Thanh District', 'chau_thanh', '84', 7),
('848', 'Cầu Ngang', 'Cau Ngang', 'Huyện Cầu Ngang', 'Cau Ngang District', 'cau_ngang', '84', 7),
('849', 'Trà Cú', 'Tra Cu', 'Huyện Trà Cú', 'Tra Cu District', 'tra_cu', '84', 7),
('850', 'Duyên Hải', 'Duyen Hai', 'Huyện Duyên Hải', 'Duyen Hai District', 'duyen_hai', '84', 7),
('851', 'Duyên Hải', 'Duyen Hai', 'Thị xã Duyên Hải', 'Duyen Hai Town', 'duyen_hai', '84', 6),
('855', 'Vĩnh Long', 'Vinh Long', 'Thành phố Vĩnh Long', 'Vinh Long City', 'vinh_long', '86', 4),
('857', 'Long Hồ', 'Long Ho', 'Huyện Long Hồ', 'Long Ho District', 'long_ho', '86', 7),
('858', 'Mang Thít', 'Mang Thit', 'Huyện Mang Thít', 'Mang Thit District', 'mang_thit', '86', 7),
('859', 'Vũng Liêm', 'Vung Liem', 'Huyện Vũng Liêm', 'Vung Liem District', 'vung_liem', '86', 7),
('860', 'Tam Bình', 'Tam Binh', 'Huyện Tam Bình', 'Tam Binh District', 'tam_binh', '86', 7),
('861', 'Bình Minh', 'Binh Minh', 'Thị xã Bình Minh', 'Binh Minh Town', 'binh_minh', '86', 6),
('862', 'Trà Ôn', 'Tra On', 'Huyện Trà Ôn', 'Tra On District', 'tra_on', '86', 7),
('863', 'Bình Tân', 'Binh Tan', 'Huyện Bình Tân', 'Binh Tan District', 'binh_tan', '86', 7),
('866', 'Cao Lãnh', 'Cao Lanh', 'Thành phố Cao Lãnh', 'Cao Lanh City', 'cao_lanh', '87', 4),
('867', 'Sa Đéc', 'Sa Dec', 'Thành phố Sa Đéc', 'Sa Dec City', 'sa_dec', '87', 4),
('868', 'Hồng Ngự', 'Hong Ngu', 'Thành phố Hồng Ngự', 'Hong Ngu City', 'hong_ngu', '87', 4),
('869', 'Tân Hồng', 'Tan Hong', 'Huyện Tân Hồng', 'Tan Hong District', 'tan_hong', '87', 7),
('870', 'Hồng Ngự', 'Hong Ngu', 'Huyện Hồng Ngự', 'Hong Ngu District', 'hong_ngu', '87', 7),
('871', 'Tam Nông', 'Tam Nong', 'Huyện Tam Nông', 'Tam Nong District', 'tam_nong', '87', 7),
('872', 'Tháp Mười', 'Thap Muoi', 'Huyện Tháp Mười', 'Thap Muoi District', 'thap_muoi', '87', 7),
('873', 'Cao Lãnh', 'Cao Lanh', 'Huyện Cao Lãnh', 'Cao Lanh District', 'cao_lanh', '87', 7),
('874', 'Thanh Bình', 'Thanh Binh', 'Huyện Thanh Bình', 'Thanh Binh District', 'thanh_binh', '87', 7),
('875', 'Lấp Vò', 'Lap Vo', 'Huyện Lấp Vò', 'Lap Vo District', 'lap_vo', '87', 7),
('876', 'Lai Vung', 'Lai Vung', 'Huyện Lai Vung', 'Lai Vung District', 'lai_vung', '87', 7),
('877', 'Châu Thành', 'Chau Thanh', 'Huyện Châu Thành', 'Chau Thanh District', 'chau_thanh', '87', 7),
('883', 'Long Xuyên', 'Long Xuyen', 'Thành phố Long Xuyên', 'Long Xuyen City', 'long_xuyen', '89', 4),
('884', 'Châu Đốc', 'Chau Doc', 'Thành phố Châu Đốc', 'Chau Doc City', 'chau_doc', '89', 4),
('886', 'An Phú', 'An Phu', 'Huyện An Phú', 'An Phu District', 'an_phu', '89', 7),
('887', 'Tân Châu', 'Tan Chau', 'Thị xã Tân Châu', 'Tan Chau Town', 'tan_chau', '89', 6),
('888', 'Phú Tân', 'Phu Tan', 'Huyện Phú Tân', 'Phu Tan District', 'phu_tan', '89', 7),
('889', 'Châu Phú', 'Chau Phu', 'Huyện Châu Phú', 'Chau Phu District', 'chau_phu', '89', 7),
('890', 'Tịnh Biên', 'Tinh Bien', 'Thị xã Tịnh Biên', 'Tinh Bien Town', 'tinh_bien', '89', 6),
('891', 'Tri Tôn', 'Tri Ton', 'Huyện Tri Tôn', 'Tri Ton District', 'tri_ton', '89', 7),
('892', 'Châu Thành', 'Chau Thanh', 'Huyện Châu Thành', 'Chau Thanh District', 'chau_thanh', '89', 7),
('893', 'Chợ Mới', 'Cho Moi', 'Huyện Chợ Mới', 'Cho Moi District', 'cho_moi', '89', 7),
('894', 'Thoại Sơn', 'Thoai Son', 'Huyện Thoại Sơn', 'Thoai Son District', 'thoai_son', '89', 7),
('899', 'Rạch Giá', 'Rach Gia', 'Thành phố Rạch Giá', 'Rach Gia City', 'rach_gia', '91', 4),
('900', 'Hà Tiên', 'Ha Tien', 'Thành phố Hà Tiên', 'Ha Tien City', 'ha_tien', '91', 4),
('902', 'Kiên Lương', 'Kien Luong', 'Huyện Kiên Lương', 'Kien Luong District', 'kien_luong', '91', 7),
('903', 'Hòn Đất', 'Hon Dat', 'Huyện Hòn Đất', 'Hon Dat District', 'hon_dat', '91', 7),
('904', 'Tân Hiệp', 'Tan Hiep', 'Huyện Tân Hiệp', 'Tan Hiep District', 'tan_hiep', '91', 7),
('905', 'Châu Thành', 'Chau Thanh', 'Huyện Châu Thành', 'Chau Thanh District', 'chau_thanh', '91', 7),
('906', 'Giồng Riềng', 'Giong Rieng', 'Huyện Giồng Riềng', 'Giong Rieng District', 'giong_rieng', '91', 7),
('907', 'Gò Quao', 'Go Quao', 'Huyện Gò Quao', 'Go Quao District', 'go_quao', '91', 7),
('908', 'An Biên', 'An Bien', 'Huyện An Biên', 'An Bien District', 'an_bien', '91', 7),
('909', 'An Minh', 'An Minh', 'Huyện An Minh', 'An Minh District', 'an_minh', '91', 7),
('910', 'Vĩnh Thuận', 'Vinh Thuan', 'Huyện Vĩnh Thuận', 'Vinh Thuan District', 'vinh_thuan', '91', 7),
('911', 'Phú Quốc', 'Phu Quoc', 'Thành phố Phú Quốc', 'Phu Quoc City', 'phu_quoc', '91', 4),
('912', 'Kiên Hải', 'Kien Hai', 'Huyện Kiên Hải', 'Kien Hai District', 'kien_hai', '91', 7),
('913', 'U Minh Thượng', 'U Minh Thuong', 'Huyện U Minh Thượng', 'U Minh Thuong District', 'u_minh_thuong', '91', 7),
('914', 'Giang Thành', 'Giang Thanh', 'Huyện Giang Thành', 'Giang Thanh District', 'giang_thanh', '91', 7),
('916', 'Ninh Kiều', 'Ninh Kieu', 'Quận Ninh Kiều', 'Ninh Kieu District', 'ninh_kieu', '92', 5),
('917', 'Ô Môn', 'O Mon', 'Quận Ô Môn', 'O Mon District', 'o_mon', '92', 5),
('918', 'Bình Thuỷ', 'Binh Thuy', 'Quận Bình Thuỷ', 'Binh Thuy District', 'binh_thuy', '92', 5),
('919', 'Cái Răng', 'Cai Rang', 'Quận Cái Răng', 'Cai Rang District', 'cai_rang', '92', 5),
('923', 'Thốt Nốt', 'Thot Not', 'Quận Thốt Nốt', 'Thot Not District', 'thot_not', '92', 5),
('924', 'Vĩnh Thạnh', 'Vinh Thanh', 'Huyện Vĩnh Thạnh', 'Vinh Thanh District', 'vinh_thanh', '92', 7),
('925', 'Cờ Đỏ', 'Co Do', 'Huyện Cờ Đỏ', 'Co Do District', 'co_do', '92', 7),
('926', 'Phong Điền', 'Phong Dien', 'Huyện Phong Điền', 'Phong Dien District', 'phong_dien', '92', 7),
('927', 'Thới Lai', 'Thoi Lai', 'Huyện Thới Lai', 'Thoi Lai District', 'thoi_lai', '92', 7),
('930', 'Vị Thanh', 'Vi Thanh', 'Thành phố Vị Thanh', 'Vi Thanh City', 'vi_thanh', '93', 4),
('931', 'Ngã Bảy', 'Nga Bay', 'Thành phố Ngã Bảy', 'Nga Bay City', 'nga_bay', '93', 4),
('932', 'Châu Thành A', 'Chau Thanh A', 'Huyện Châu Thành A', 'Chau Thanh A District', 'chau_thanh_a', '93', 7),
('933', 'Châu Thành', 'Chau Thanh', 'Huyện Châu Thành', 'Chau Thanh District', 'chau_thanh', '93', 7),
('934', 'Phụng Hiệp', 'Phung Hiep', 'Huyện Phụng Hiệp', 'Phung Hiep District', 'phung_hiep', '93', 7),
('935', 'Vị Thuỷ', 'Vi Thuy', 'Huyện Vị Thuỷ', 'Vi Thuy District', 'vi_thuy', '93', 7),
('936', 'Long Mỹ', 'Long My', 'Huyện Long Mỹ', 'Long My District', 'long_my', '93', 7),
('937', 'Long Mỹ', 'Long My', 'Thị xã Long Mỹ', 'Long My Town', 'long_my', '93', 6),
('941', 'Sóc Trăng', 'Soc Trang', 'Thành phố Sóc Trăng', 'Soc Trang City', 'soc_trang', '94', 4),
('942', 'Châu Thành', 'Chau Thanh', 'Huyện Châu Thành', 'Chau Thanh District', 'chau_thanh', '94', 7),
('943', 'Kế Sách', 'Ke Sach', 'Huyện Kế Sách', 'Ke Sach District', 'ke_sach', '94', 7),
('944', 'Mỹ Tú', 'My Tu', 'Huyện Mỹ Tú', 'My Tu District', 'my_tu', '94', 7),
('945', 'Cù Lao Dung', 'Cu Lao Dung', 'Huyện Cù Lao Dung', 'Cu Lao Dung District', 'cu_lao_dung', '94', 7),
('946', 'Long Phú', 'Long Phu', 'Huyện Long Phú', 'Long Phu District', 'long_phu', '94', 7),
('947', 'Mỹ Xuyên', 'My Xuyen', 'Huyện Mỹ Xuyên', 'My Xuyen District', 'my_xuyen', '94', 7),
('948', 'Ngã Năm', 'Nga Nam', 'Thị xã Ngã Năm', 'Nga Nam Town', 'nga_nam', '94', 6),
('949', 'Thạnh Trị', 'Thanh Tri', 'Huyện Thạnh Trị', 'Thanh Tri District', 'thanh_tri', '94', 7),
('950', 'Vĩnh Châu', 'Vinh Chau', 'Thị xã Vĩnh Châu', 'Vinh Chau Town', 'vinh_chau', '94', 6),
('951', 'Trần Đề', 'Tran De', 'Huyện Trần Đề', 'Tran De District', 'tran_de', '94', 7),
('954', 'Bạc Liêu', 'Bac Lieu', 'Thành phố Bạc Liêu', 'Bac Lieu City', 'bac_lieu', '95', 4),
('956', 'Hồng Dân', 'Hong Dan', 'Huyện Hồng Dân', 'Hong Dan District', 'hong_dan', '95', 7),
('957', 'Phước Long', 'Phuoc Long', 'Huyện Phước Long', 'Phuoc Long District', 'phuoc_long', '95', 7),
('958', 'Vĩnh Lợi', 'Vinh Loi', 'Huyện Vĩnh Lợi', 'Vinh Loi District', 'vinh_loi', '95', 7),
('959', 'Giá Rai', 'Gia Rai', 'Thị xã Giá Rai', 'Gia Rai Town', 'gia_rai', '95', 6),
('960', 'Đông Hải', 'Dong Hai', 'Huyện Đông Hải', 'Dong Hai District', 'dong_hai', '95', 7),
('961', 'Hoà Bình', 'Hoa Binh', 'Huyện Hoà Bình', 'Hoa Binh District', 'hoa_binh', '95', 7),
('964', 'Cà Mau', 'Ca Mau', 'Thành phố Cà Mau', 'Ca Mau City', 'ca_mau', '96', 4),
('966', 'U Minh', 'U Minh', 'Huyện U Minh', 'U Minh District', 'u_minh', '96', 7),
('967', 'Thới Bình', 'Thoi Binh', 'Huyện Thới Bình', 'Thoi Binh District', 'thoi_binh', '96', 7),
('968', 'Trần Văn Thời', 'Tran Van Thoi', 'Huyện Trần Văn Thời', 'Tran Van Thoi District', 'tran_van_thoi', '96', 7),
('969', 'Cái Nước', 'Cai Nuoc', 'Huyện Cái Nước', 'Cai Nuoc District', 'cai_nuoc', '96', 7),
('970', 'Đầm Dơi', 'Dam Doi', 'Huyện Đầm Dơi', 'Dam Doi District', 'dam_doi', '96', 7),
('971', 'Năm Căn', 'Nam Can', 'Huyện Năm Căn', 'Nam Can District', 'nam_can', '96', 7),
('972', 'Phú Tân', 'Phu Tan', 'Huyện Phú Tân', 'Phu Tan District', 'phu_tan', '96', 7),
('973', 'Ngọc Hiển', 'Ngoc Hien', 'Huyện Ngọc Hiển', 'Ngoc Hien District', 'ngoc_hien', '96', 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sach`
--

--
-- Đang đổ dữ liệu cho bảng `sach`
--

INSERT INTO `sach` (`MaSach`, `TenSach`, `category_id`, `GiaNhap`, `GiaBan`, `SoLuong`, `NamXuatBan`, `MoTa`, `TrangThai`, `LuotMua`, `HinhAnh`, `created_at`, `updated_at`, `slug`) VALUES
(1, 'Trường Ca Achilles', 14, 70000.00, 20000.00, 5000, 2012, 'HUYỀN THOẠI BẮT ĐẦU…\r\n\r\nHy Lạp vào thời hoàng kim của các anh hùng. Patroclus là một hoàng tử trẻ vụng về, bị trục xuất tới vương quốc Phthia và được nuôi dạy dưới sự che chở của vua Peleus cùng cậu con trai hoàng kim của ngài, Achilles. “Người Hy Lạp vĩ đại nhất” – mạnh mẽ, đẹp đẽ, và mang nửa dòng máu của một nữ thần – Achilles là tất cả những gì mà Patroclus không bao giờ có được. Nhưng bất chấp sự khác biệt giữa họ, hai cậu bé trở thành chiến hữu trung thành của nhau. Tình cảm giữa họ càng đậm sâu khi cả hai lớn lên thành những chàng trai trẻ, thành thạo trong kĩ nghệ chiến đấu và y dược.\r\n\r\nKhi tin tức truyền tới rằng nàng Helen xứ Sparta đã bị bắt cóc, những chiến binh Hy Lạp, bị trói buộc bởi lời thề máu, phải nhân danh nàng mà vây hãm thành Troy. Bị cám dỗ bởi lời hứa hẹn về một số mệnh huy hoàng, Achilles tham gia hàng ngũ của họ. Bị giằng xé giữa tình yêu và nỗi lo sợ dành cho người bạn của mình, Patroclus ra trận theo Achilles. Họ không hay biết rằng các nữ thần Số Phận sẽ thử thách cả hai người họ hơn bao giờ hết và đòi hỏi một sự hi sinh khủng khiếp.\r\n\r\nDựa trên nền tảng của sử thi Iliad, câu chuyện về cuộc chiến thành Troy vĩ đại đã được Madeline Miller kể lại với tiết tấu dồn dập, lôi cuốn, và không kém phần xúc động, đánh dấu sự khởi đầu của một sự nghiệp rực rỡ.\r\n\r\nTrường Ca Achilles đã đoạt giải Orange năm 2012 và luôn nằm trong top các sách bán chạy của tờ New York Times.', 1, '10', '1736334720_TruongngCaAchilles.png', '2025-01-07 17:00:00', '2025-01-07 17:00:00', 'truong-ca-achilles'),
(2, 'Nhà Giả Kim', 15, 80000.00, 120000.00, 5000, 2020, 'Tất cả những trải nghiệm trong chuyến phiêu du theo đuổi vận mệnh của mình đã giúp Santiago thấu hiểu được ý nghĩa sâu xa nhất của hạnh phúc, hòa hợp với vũ trụ và con người. \r\n\r\nTiểu thuyết Nhà giả kim của Paulo Coelho như một câu chuyện cổ tích giản dị, nhân ái, giàu chất thơ, thấm đẫm những minh triết huyền bí của phương Đông. Trong lần xuất bản đầu tiên tại Brazil vào năm 1988, sách chỉ bán được 900 bản. Nhưng, với số phận đặc biệt của cuốn sách dành cho toàn nhân loại, vượt ra ngoài biên giới quốc gia, Nhà giả kim đã làm rung động hàng triệu tâm hồn, trở thành một trong những cuốn sách bán chạy nhất mọi thời đại, và có thể làm thay đổi cuộc đời người đọc.\r\n\r\n“Nhưng nhà luyện kim đan không quan tâm mấy đến những điều ấy. Ông đã từng thấy nhiều người đến rồi đi, trong khi ốc đảo và sa mạc vẫn là ốc đảo và sa mạc. Ông đã thấy vua chúa và kẻ ăn xin đi qua biển cát này, cái biển cát thường xuyên thay hình đổi dạng vì gió thổi nhưng vẫn mãi mãi là biển cát mà ông đã biết từ thuở nhỏ. Tuy vậy, tự đáy lòng mình, ông không thể không cảm thấy vui trước hạnh phúc của mỗi người lữ khách, sau bao ngày chỉ có cát vàng với trời xanh nay được thấy chà là xanh tươi hiện ra trước mắt. ‘Có thể Thượng đế tạo ra sa mạc chỉ để cho con người biết quý trọng cây chà là,’ ông nghĩ.”\r\n\r\n- Trích Nhà giả kim', 1, '35', '1736334731_NhaGiaKim.png', '2025-01-07 17:00:00', '2025-01-07 17:00:00', 'nha-gia-kim-tai-ban-2020'),
(3, 'Trốn Lên Mái Nhà Để Khóc', 16, 50000.00, 95000.00, 5000, 2020, 'Những cơn gió heo may len lỏi vào từng góc phố nhỏ, mùa thu về gợi nhớ bao yêu thương đong đầy, bao xúc cảm dịu dàng của ký ức. Đó là nỗi nhớ đau đáu những hương vị quen thuộc của đồng nội, là hoài niệm bất chợt khi đi trên con đường cũ in dấu bao kỷ niệm... để rồi ta ước có một chuyến tàu kỳ diệu trở về những năm tháng ấy, trở về nơi nương náu bình yên sau những tháng ngày loay hoay để học cách trở thành một người lớn. Bạn sẽ được đắm mình trong những cảm xúc đẹp đẽ xen lẫn những tiếc nuối đầy lắng đọng trong “Trốn lên mái nhà đẻ khóc” của Lam.\r\n\r\n“Trốn lên mái nhà để khóc” là cuốn nhật ký nhỏ ghi lại những hoài niệm đẹp đẽ cất giữ vào góc nhỏ nơi sâu thẳm của trái tim của mỗi người, đồng thời cũng là người bạn đồng hành để chúng ta tiếp tục bước đi đến tương lai. Sau khi “Trốn lên mái nhà và khóc” khép lại, hãy mạnh mẽ để sống hết mình và để lại “những tháng năm rực rỡ”.', 1, '30', '1736334951_TronLenMaiNhaDeKhoc.png', '2025-01-07 17:00:00', '2025-01-07 17:00:00', 'tron-len-mai-nha-de-khoc'),
(4, 'Quản Trị Bằng Văn Hóa ', 17, 80000.00, 200000.00, 5000, 2020, 'Thông qua cuốn sách, TS Giản Tư Trung cũng mong muốn góp phần cổ vũ và thúc đẩy cho sự phát triển của một phương cách quản trị mới, vừa nhân văn, vừa hiệu quả, đó là “Quản trị bằng Văn hóa / Quản trị bằng Tự trị” (Management by Culture /\r\n\r\nManagement by Self-Mangement). Bởi lẽ tác giả tin rằng, bên cạnh các phương cách quản trị truyền thống như Quản trị bằng Luật lệ (Mangement by Polices) hay Quản trị bằng Mục tiêu (Management by Objectives) thì Quản trị bằng Văn hóa (Management by Culture) chính là tương lai của quản trị và tương lai của lãnh đạo trong một thế giới đầy biến động và trong một thời đại mà con người ngày càng trở nên độc lập và tự do hơn. Cuốn sách này có sự tích hợp xuyên suốt từ tinh thần, tư tưởng và triết lý cho đến phương pháp và giải pháp, cũng như có sự kết nối 5 chủ thể văn hóa là cá nhân, bộ phận, tổ chức, kinh thương, và quốc gia. Đặc biệt, những tư duy và phương pháp cốt lõi về xây dựng và chuyển đổi văn hóa được chia sẻ trong cuốn sách này có tính nguyên lý, nên không chỉ áp dụng cho các doanh nghiệp, mà còn có thể áp dụng cho mọi loại hình tổ chức khác, bao gồm cả trường học, bệnh viện, báo chí, các tổ chức xã hội, cơ quan nhà nước, hay các tổ chức phi chính phủ.\r\n\r\nVề tác giả Giản Tư Trung:\r\n\r\nTác giả Giản Tư Trung hiện là Chủ tịch sáng lập Học viện Quản Lý PACE, Hiệu trưởng Trường Doanh Nhân PACE, Viện trưởng Viện Giáo Dục IRED, Phó Chủ tịch Quỹ Văn hóa Phan Châu Trinh, Trưởng Ban Tổ chức Giải thưởng Sách Hay và Chủ nhiệm IPL Scholarship. Ông nhận bằng Thạc sĩ về Nghiên cứu Phát triển tại Học viện Sau Đại học Geneva; Tu nghiệp về Chính sách Giáo dục Quốc tế tại Đại học Harvard; Tốt nghiệp Tiến sĩ về Giáo dục tại Học viện Giáo dục Quốc gia Singapore; và tốt nghiệp Tiến sĩ về Giáo dục tại Đại học London (UCL). Với những cống hiến của Ông cho giáo dục, Diễn Đàn Kinh Tế Thế Giới đã vinh danh Ông là một Nhà lãnh đạo toàn cầu trong vai trò là một Nhà hoạt động giáo dục.', 1, '30', '1736334864_QuanTriVanHoa.png', '2025-01-07 17:00:00', '2025-01-07 17:00:00', 'quan-tri-bang-van-hoa-cach-thuc-kien-tao-va-tai'),
(5, 'Hồ Sơ Tâm Lí Tội Phạm - Tập 1', 18, 80000.00, 120000.00, 5000, 2020, 'BỘ SÁCH CHẤN ĐỘNG NHẤT VỀ TÂM LÍ TỘI PHẠM. PHƠI BÀY TRỌN VẸN NHỮNG GÓC KHUẤT NỘI TÂM CỦA KẺ THỦ ÁC.\r\n\r\nKể từ khi nghiên cứu tâm lí học tội phạm đến nay, tôi đã chứng kiến rất nhiều tội ác muôn hình vạn trạng, nhưng hầu hết tất cả những hành vi biến thái đó đều ẩn chứa đằng sau một động cơ chung: Khát vọng được quan tâm và yêu thương.\"\r\n\r\nTrước đây, trên thế giới từng có những vụ trọng án đi vào ngõ cụt, bởi tất cả các bằng chứng và dấu vết đã bị kẻ thủ ác khôn ngoan xóa sạch. Trong lịch sử, không hề hiếm những vụ án mà cảnh sát phải bó tay, không thể bắt hung thủ hiện nguyên hình.\r\nNgày nay, ngoài các kĩ thuật hình sự hỗ trợ điều tra tội phạm, thì tâm lí học tội phạm chính là một trong những “kĩ thuật bóc tách” hung thủ từ các nghi can. Những kẻ giết người hàng loạt thực hiện hành vi tàn nhẫn hết lần này đến lần khác mà không để lại chút sơ hở nào, vậy giữa biển người mênh mông làm sao có thể khoanh vùng và tìm được kẻ thủ ác? Những nhà tâm lí học tội phạm dựa vào các hành vi gây án hay còn gọi là chứng cứ hành vi để phân tích tâm lí của kẻ thủ ác và bước đầu phác họa hồ sơ tội phạm, giúp thu hẹp phạm vi điều tra.\r\n\r\nTừ sự nắm bắt và quan sát tinh vi dựa trên tâm lí, các cảnh sát hình sự phải mò mẫm trong con đường hầm mờ tối để lần ra manh mối và dấu vết. Con đường ấy vô cùng vất vả và gian truân, sẽ có những vấp ngã, sẽ có đau đớn và hiểm nguy, nhưng cuối đường hầm luôn là ánh sáng. Bởi vì công lí cuối cùng sẽ đánh bại cái ác, kể cả khi công lí tới sau. Cuốn sách mà các bạn đang cầm trên tay sẽ đưa chúng ta đến với những trải nghiệm của các điều tra viên, thấu hiểu sự hi sinh và mất mát của lực lượng cảnh sát, đào sâu tìm hiểu những kiến thức tâm lí học tội phạm ứng dụng. Các tình tiết truyện đan xen, hấp dẫn nhưng cũng chất chứa trong đó giá trị nhân văn sâu sắc. Có lẽ khi đọc cuốn tiểu thuyết này, chúng ta càng thấm thía câu nói: “Hiền dữ phải đâu là tính sẵn. Phần nhiều do giáo dục mà nên.”\r\n\r\nTác giả Cương Tuyết Ấn là người thành phố Đại Liên, tỉnh Liêu Ninh. Những năm trở lại đây, ông kiên trì sáng tác những tác phẩm trinh thám về điều tra hình sự có liên quan tới tâm lí tội phạm.\r\n\r\nMỗi câu chuyện dưới ngòi bút của ông đều dẫn dắt người đọc vào thế giới suy luận hồi hộp, gay cấn đến nghẹt thở. Tác phẩm tiêu biểu – bộ tiểu thuyết Hồ sơ tâm lí tội phạm – bán chạy ở thị trường Trung Quốc đại lục, Hồng Kông, Đài Loan… Năm 2016 tác phẩm được xuất bản bằng tiếng Anh, bán ở thị trường nước ngoài.', 1, '30', '1736334872_HoSoTamLyToiPham.png', '2025-01-07 17:00:00', '2025-01-07 17:00:00', 'ho-so-tam-li-toi-pham-tap-1'),
(6, '5 Nguyên Tắc Thép', 19, 30000.00, 60000.00, 5000, 2020, '5 nguyên tắc thép, 15 thuật bán hàng thành công\n\nKhách hàng có mua sản phẩm của bạn hay không, điều này không chỉ phụ thuộc vào chất lượng sản phẩm ưu việt bạn mang lại, mà còn phụ thuộc vào kĩ năng bán hàng tuyệt vời của bạn. Trong quá trình mua hàng và bán hàng tồn tại rất nhiều hoạt động tâm lí có thể ảnh hưởng đến hành vi của khách hàng. Cuốn sách này sẽ lí giải trong quá trình bán hàng, người bán hàng cần có kĩ năng gì, nên áp dụng các thuật tâm lí như thế nào để tác động tích cực đến khách hàng và khiến khách hàng nảy sinh hành vi mua hàng.\n\nNếu như bạn là một người tiêu dùng, sau khi đọc cuốn sách này rồi, tôi hi vọng trước khi mở hầu bao, bạn nên thử nghiêm túc nghĩ xem: Thứ mà mình định mua có thực sự cần thiết hay không? Nếu bạn là một người bán hàng, tôi hi vọng rằng bạn, với nhân cách cao đẹp của mình, có thể sử dụng tốt những kĩ năng bán hàng mà tất cả mọi người đều có thể chấp nhận đã được mô tả cuốn sách này để phát triển được một thị trường rộng lớn hơn, và tạo ra doanh số bán hàng tuyệt vời hơn.', 1, '40', '1736334880_5NguyenTacThep.png', '2025-01-07 17:00:00', '2025-01-07 17:00:00', '5-nguyen-tac-thep-15-thuat-ban-hang-thanh-cong'),
(7, 'Chính Sách Tiền Tệ Thế Kỷ 21', 20, 80000.00, 300000.00, 5000, 2020, 'Cuốn sách đầu tiên bàn về lịch sử chống lạm phát & khủng hoảng của Cục Dự trữ Liên bang Hoa Kỳ\r\n\r\nChính sách tiền tệ thế kỷ 21 xem xét Fed – cơ quan quản lý chính sách tiền tệ Mỹ của hiện tại và tương lai chủ yếu thông qua lăng kính lịch sử, nhằm giúp người đọc hiểu được Fed đã làm thế nào để đạt được vị trí như ngày nay, học được gì từ những thách thức đa dạng phải đối mặt, và có thể phát triển như thế nào trong tương lai.\r\n\r\nĐược viết bởi Ben S. Bernanke – người giữ chức Chủ tịch Fed từ năm 2006 đến năm 2014, cuốn sách mang đến cái nhìn tổng quan về quá trình hoạch định chính sách của Fed trong 70 năm qua, cho thấy những thay đổi trong nền kinh tế đã thúc đẩy những đổi mới của Fed như thế nào cũng như những thách thức mới mà Fed phải đối mặt, bao gồm: lạm phát quay trở lại, tiền điện tử, rủi ro bất ổn tài chính gia tăng và các mối đe dọa đối với tính độc lập của tổ chức này.\r\n\r\nNgoài việc giải thích các công cụ hoạch định chính sách mới của hệ thống ngân hàng trung ương, cuốn sách còn kể về những khoảnh khắc kịch tính mà với đó, các quyết định của Fed dưới triết lý của những người từng chèo lái tổ chức này - đã tạo nên nhiều tác động đáng kể. Sách gồm 4 phần:\r\n\r\n1. Sự tăng giảm của lạm phát: bàn về các chiến lược ứng phó của Fed trước Đại Lạm Phát (thập niên 60-80 thế kỷ 20) và giai đoạn bùng nổ 1990.\r\n\r\n2. Khủng hoảng tài chính toàn cầu và Đại Suy thoái: bàn về những thách thức của thiên niên kỷ mới, trong đó có suy thoái 2001, giảm phát 2003, Khủng hoảng tài chính toàn cầu (2007-2008) và Đại Suy thoái (2009).\r\n\r\n3. Từ nâng lãi suất đến đại dịch Covid-19: bàn về chiến lược của Fed từ sau thời Bernanke (2014) đến đại dịch Covid-19, gồm các chính sách nâng lãi suất, chính sách tiền tệ trung lập, nỗ lực đảm bảo tính độc lập của Fed và các biến động dưới thời Jay Powell, và chiến lược ứng phó khủng hoảng trong thời kỳ đại dịch Covid-19.\r\n\r\n4. Tương lai phía trước: đánh giá lại các công cụ mà Fed đã áp dụng, bàn về các phương án & công cụ mới để xây dựng chính sách hiệu quả, mạnh mẽ hơn, vai trò của chính sách tiền tệ trong việc duy trì ổn định tài chính, về tính độc lập và vai trò của Fed trong xã hội.\r\n\r\nNhững đánh giá thành công hay thất bại và những bài học trong chính sách tiền tệ của Mỹ trong 70 năm qua từ một chuyên gia như Bernanke chắc chắn là những kiến thức quý báu cho các nhà hoạch định chính sách và các nhà nghiên cứu kinh tế trên thế giới. Hơn thế, người đọc còn học được từ trong cuốn sách này những bài học về lãnh đạo trong những tình huống khó khăn, về các lựa chọn mà những nhà làm chính sách phải đưa ra trong bối cảnh thông tin không đầy đủ.', 1, '30', '1736334887_ChinhSachTienTeTheKy21.png', '2025-01-07 17:00:00', '2025-01-07 17:00:00', 'chinh-sach-tien-te-the-ky-21'),
(8, 'Thám Tử Lừng Danh Conan - Tập 105', 21, 10000.00, 30000.00, 5000, 2020, 'Thám Tử Lừng Danh Conan - Tập 105\r\n\r\nOoka Momiji bị đe doạ đến tính mạng trên tàu shinkansen. Liệu quản gia Iori Muga và mọi người có thể giải cứu cô an toàn!?\r\n\r\nRan dẫn Heiji và các bạn tới một thắng cảnh tuyệt đẹp… Nhưng khi ở trên núi, họ tình cờ gặp một vụ án mạng kì bí! Kaito Kid và Conan sẽ bắt tay hợp tác!? Đối thủ của họ là… Hakuba Saguru!!', 1, '30', '1736334904_ThamTuLungDanhConan105.png', '2025-01-07 17:00:00', '2025-01-07 17:00:00', 'tham-tu-lung-danh-conan-tap-105'),
(9, 'Danh Nhân Thế Giới - Marie Curie', 22, 8000.00, 30000.00, 5000, 2022, 'Marie Curie là nhà khoa học nữ đầu tiên được nhận hai giải Nobel. Bà đã dành trọn cuộc đời để nghiên cứu khoa học, và cống hiến trọn vẹn những thành tựu to lớn cho nhân loại. Từ nhỏ, Marie Curie là một cô bé thông minh, ham học và rất yêu thích khoa học tự nhiên. Nhưng vì gia đình quá nghèo nên bà phải lao động để kiếm sống. Sau bao nhiêu vất vả gian nan cuối cùng bà đã thực hiện được mơ ước: Bước chân vào giảng đường đại học. Nhờ tài năng, trí thông minh và sự cần cù, Marie Curie đã lần lượt nhận được bằng cử nhân về Vật lí và Toán học.\r\n\r\nBà đã cùng chồng là Pierre Curie nghiên cứu và phát hiện ra nguyên tố mang tính phóng xạ radium và được trao giải Nobel Vật lí. Sau khi ông Pierre qua đời, bà vẫn tiếp tục nghiên cứu, và một lần nữa bà lại được nhận giải thưởng Nobel Hóa học.\r\n\r\nSuốt cuộc đời, cho đến khi trút hơi thở cuối cùng vào năm 1934, bà đã không ngừng nghiên cứu, đóng góp công sức cho khoa học và cho hạnh phúc nhân loại. Cuộc đời của Marie Curie là một tấm gương sáng ngời về nhân cách của một nhà khoa học luôn dành tình yêu cho đất nước, cho khoa học chân chính.', 1, '30', '1736334897_NhanDanhTheGioiMarieCurie.png', '2025-01-07 17:00:00', '2025-01-07 17:00:00', 'danh-nhan-the-gioi-marie-curie-tai-ban-2022'),
(10, 'Cỏ Hoa Tự Tại', 23, 20000.00, 30000.00, 100, 2024, 'Vui vẻ là chính mình,\n\nMỗi ngày bình thường\n\nĐều không tầm thường.\n\nNhững bài thơ trong “Cỏ hoa tự tại” được tác giả Thanh Thảo chắt lọc từ những quan sát tinh tế về cuộc sống xung quanh, hòa quyện cùng nét vẽ màu nước sống động và mơ màng của họa sĩ Huyền Anh (Hajazana), khiến những điều bình dị được tôn lên đầy ấn tượng và giàu cảm xúc, tựa như những lát cắt cuộc sống muôn màu muôn vẻ mà đôi khi ta thường bỏ quên.', 1, '30', 'co-hoa-tu-tai.jpg', '2025-01-16 14:32:47', '2025-01-16 14:32:47', 'co-hoa-tu-tai'),
(11, 'Nhật kí cha và con', 24, 30000.00, 40000.00, 100, 2023, 'Những cảm xúc đời thường trước những gợn sóng tâm tư khiến tâm hồn xao động…\r\n\r\nCha và con như hai người bạn, khi ở xa, lúc gần gũi, luôn luôn song hành và tràn đầy yêu thương…\r\n\r\nTôi không được ở cùng con hằng ngày. Nhưng mỗi khi nhớ đến con, nghĩ đến cô con gái xinh xắn, bé bỏng của mình, đôi lúc tôi hình dung con như giọt mật ong, trong như hổ phách, lấp lánh, ngọt ngào, và dính chặt lấy trái tim tôi. Giọt mật ong bé tí xíu nhưng đủ sức làm dịu đi mọi nỗi mệt nhọc, buồn phiền hay thổi bùng lên những niềm vui, hạnh phúc.\r\n\r\nSự xuất hiện của Bamby khiến tôi hình dung cuộc đời mình chia làm hai nửa: Mông lung > < Sắc nét, Bất định > < Rõ ràng, Trước con > < Sau con.', 1, '30', 'nhat-ki-cha-va-con.jpg', '2025-01-17 12:45:54', '2025-01-17 12:45:57', 'nhat-ki-cha-va-con'),
(12, 'Cây cam ngọt của tôi', 25, 20000.00, 40000.00, 100, 2020, '“Vị chua chát của cái nghèo hòa trộn với vị ngọt ngào khi khám phá ra những điều khiến cuộc đời này đáng sống... một tác phẩm kinh điển của Brazil.” - Booklist\n\n“Một cách nhìn cuộc sống gần như hoàn chỉnh từ con mắt trẻ thơ… có sức mạnh sưởi ấm và làm tan nát cõi lòng, dù người đọc ở lứa tuổi nào.” - The National\n\nHãy làm quen với Zezé, cậu bé tinh nghịch siêu hạng đồng thời cũng đáng yêu bậc nhất, với ước mơ lớn lên trở thành nhà thơ cổ thắt nơ bướm. Chẳng phải ai cũng công nhận khoản “đáng yêu” kia đâu nhé. Bởi vì, ở cái xóm ngoại ô nghèo ấy, nỗi khắc khổ bủa vây đã che mờ mắt người ta trước trái tim thiện lương cùng trí tưởng tượng tuyệt vời của cậu bé con năm tuổi.\n\nCó hề gì đâu bao nhiêu là hắt hủi, đánh mắng, vì Zezé đã có một người bạn đặc biệt để trút nỗi lòng: cây cam ngọt nơi vườn sau. Và cả một người bạn nữa, bằng xương bằng thịt, một ngày kia xuất hiện, cho cậu bé nhạy cảm khôn sớm biết thế nào là trìu mến, thế nào là nỗi đau, và mãi mãi thay đổi cuộc đời cậu.\n\nMở đầu bằng những thanh âm trong sáng và kết thúc lắng lại trong những nốt trầm hoài niệm, Cây cam ngọt của tôi khiến ta nhận ra vẻ đẹp thực sự của cuộc sống đến từ những điều giản dị như bông hoa trắng của cái cây sau nhà, và rằng cuộc đời thật khốn khổ nếu thiếu đi lòng yêu thương và niềm trắc ẩn. Cuốn sách kinh điển này bởi thế không ngừng khiến trái tim người đọc khắp thế giới thổn thức, kể từ khi ra mắt lần đầu năm 1968 tại Brazil.', 1, '30', 'cay_cam_ngot_cua_toi.jpg', '2025-01-17 12:45:58', '2025-01-17 12:46:04', 'cay_cam_ngot_cua_toi'),
(13, 'Lén nhặt chuyện đời', 26, 50000.00, 70000.00, 1000, 2022, 'Tại vùng ngoại ô xứ Đan Mạch xưa, người thợ kim hoàn Per Enevoldsen đã cho ra mắt một món đồ trang sức lấy ý tưởng từ Pandora - người phụ nữ đầu tiên của nhân loại mang vẻ đẹp như một ngọc nữ phù dung, kiêu sa và bí ẩn trong Thần thoại Hy Lạp. Vòng Pandora được kết hợp từ một sợi dây bằng vàng, bạc hoặc bằng da cùng với những viên charm được chế tác đa dạng, tỉ mỉ. Ý tưởng của ông, mỗi viên charm như một câu chuyện, một kỷ niệm đáng nhớ của người sở hữu chiếc vòng. Khi một viên charm được thêm vào sợi Pandora là cuộc đời lại có thêm một ký ức cần lưu lại để nhớ, để thương, để trân trọng. Lén nhặt chuyện đời ra mắt trong khoảng thời gian chông chênh nhất của bản thân, hay nói cách khác là một cậu bé mới lớn, vừa bước ra khỏi cái vỏ bọc vốn an toàn của mình. Những câu chuyện trong Lén nhặt chuyện đời là những câu chuyện tôi được nghe kể lại, hoặc vô tình bắt gặp, hoặc nhặt nhạnh ở đâu đó trong miền ký ức rời rạc của quá khứ, không theo một trình tự hay một thời gian nào nhất định.\n\nMỗi một câu chuyện là một viên charm lấp lánh, kiêu kỳ, có sức hút mạnh mẽ đối với một người trẻ như tôi luôn tò mò với những điều dung dị trong cuộc sống. Tôi âm thầm nhặt những viên charm ấy về, kết thành sợi Pandora cho chính mình. Lén ở đây không phải là một cái gì đó vụng trộm, âm thầm sợ người khác phát hiện. Mà nó là lặng lẽ. Tôi lặng lẽ nghe, lặng lẽ quan sát, lặng lẽ đi tìm và lặng lẽ viết nên quyển sách này. Tôi vẫn thích dùng từ Lén hơn, vì đơn giản, tôi thấy bản thân mình trong đó. Lén nhặt chuyện đời được chia thành năm chương: chương thứ nhất nói về tình yêu của cả giới trẻ và người tu sĩ; chương thứ hai viết về gia đình; chương thứ ba dành cho những người trẻ; chương thứ tư là những câu chuyện bên đời, những bài tâm sự của người tu sĩ; chương năm là thơ và chương cuối cùng là tâm sự của bản thân khi tôi đã về già. Nếu ai nghĩ Lén nhặt chuyện đời sẽ giảng thuyết về chân lý, định hướng cho người trẻ hay chữa lành những vết thương… thì đã tìm sai chỗ, bản thân chưa bao giờ nghĩ quyển sách này sẽ làm được điều đó.', 1, '45', 'len_nhat_chuyen_doi.jpg', '2025-01-17 12:46:00', '2025-01-17 12:46:03', 'len-nhat-chuyen-doi'),
(14, 'Nếu biết trăm năm là hữu hạn', 27, 40000.00, 60000.00, 6, 2021, 'Nếu Biết Trăm Năm Là Hữu Hạn ngay từ tên gọi đã rất gợi mở và đầy ẩn ý. Với những cảm xúc sâu lắng, bao gồm những bài viết ngắn, đầy chất thơ, chiêm nghiệm về mọi vấn đề của cuộc sống hôm nay, với những buồn vui như hạt mưa trong tưới mát tâm hồn, cuốn sách đã chạm được đến những mẫu số chung của mỗi người khi trình bày những thứ tình cảm thân thương từ tình cảm gia đình cho đến tình yêu, tình bạn…\n\nKhông phải ngẫu nhiên mà tác phẩm này nhận được nhiều sự yêu mến đến vậy, khi tái bản lên tới con số 30 lần. Những trang viết của Nếu Biết Trăm Năm Là Hữu Hạn suốt bao nhiêu năm qua vẫn như người bạn tâm tình cùng bao thế hệ bạn đọc, xứng đáng trở thành một trong những cuốn sách được yêu thích nhất ở Việt Nam.\n\n“Đọc nó, ta như tìm được lời giải đáp cho những suy tư của chính mình. Đọc nó, ta như tìm lại được chốn bình yên trong tâm hồn mình. Để rồi ta nhìn cuộc đời bao dung hơn, nhìn con người vị tha hơn, và bản thân ta cũng dũng cảm hơn trong cuộc sống. Khi đó, ta chính là ta, và sống một cuộc đời chân thực nhất.” – Cao Hạnh Quyên\n\n“Đây là cuốn sách giúp mình tiết kiệm đến nửa cuộc đời.” – Nguyễn Khánh\n\n“Đây xứng đáng là một quyển sách có ở mỗi gia đình, để khi người ta cảm thấy mất phương hướng có thể tìm lại ở đó, phát hiện ra chút hy vọng của hạnh phúc trong cuộc đời mình.” – Đặng Ngọc Tú', 1, '30', 'neu_biet_tram_nam_la_huu_han.jpg', '2025-01-17 12:46:01', '2025-01-17 12:46:02', 'neu-biet-tram-nam-la-huu-han'),
(15, 'Hai Mặt Của Gia Đình', 28, 55000.00, 75000.00, 12, 2020, 'Cuốn sách nói về những góc khuất và sự thật đằng sau một gia đình hiện đại.', 1, '30', 'hai_mat_cua_gia_dinh.jpg', '2025-01-16 22:05:28', '2025-01-16 22:05:28', 'hai-mat-cua-gia-dinh'),
(16, 'Ghi Chép Pháp Y', 29, 60000.00, 85000.00, 1000, 2021, 'Những câu chuyện chân thực về ngành pháp y và những vụ án nổi tiếng.', 1, '30', 'ghi_chep_phap_y.jpg', '2025-01-16 22:05:28', '2025-01-16 22:05:28', 'ghi-chep-phap-y'),
(17, 'Sự Im Lặng Của Bầy Cừu', 30, 70000.00, 95000.00, 8, 2019, 'Tiểu thuyết trinh thám kinh điển về những vụ án rùng rợn.', 1, '30', 'su_im_lang_cua_bay_cuu.jpg', '2025-01-16 22:05:28', '2025-01-16 22:05:28', 'su-im-lang-cua-bay-cuu'),
(18, 'Sói Già Phố Wall - Phần 3', 31, 75000.00, 100000.00, 7, 2022, 'Cuộc đời đầy sóng gió của một doanh nhân phố Wall.', 1, '30', 'soi_gia_pho_wall_3.jpg', '2025-01-16 22:05:28', '2025-01-16 22:05:28', 'soi-gia-pho-wall-3'),
(19, 'Sói Già Phố Wall - Phần 2', 32, 72000.00, 98000.00, 9, 2021, 'Phần tiếp theo trong chuỗi câu chuyện về doanh nhân phố Wall.', 1, '30', 'soi_gia_pho_wall_2.jpg', '2025-01-16 22:05:28', '2025-01-16 22:05:28', 'soi-gia-pho-wall-2'),
(20, 'Vị Giám Đốc Một Phút', 33, 50000.00, 75000.00, 11, 2023, 'Cuốn sách kinh điển về quản lý thời gian và lãnh đạo hiệu quả.', 1, '30', 'vi_giam_doc_mot_phut.jpg', '2025-01-16 22:05:28', '2025-01-16 22:05:28', 'vi-giam-doc-mot-phut'),
(21, 'Tiếp Thị Tốt Hơn 6', 34, 60000.00, 85000.00, 12, 2020, 'Những chiến lược tiếp thị hiện đại được tóm gọn trong cuốn sách này.', 1, '30', 'tiep_thi_6.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'tiep-thi-tot-hon-6'),
(22, 'Tiếp Thị Tốt Hơn 5', 35, 55000.00, 80000.00, 8, 2019, 'Tóm lược về các kỹ năng tiếp thị cho thời đại số.', 1, '44', 'tiep_thi_5.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'tiep-thi-tot-hon-5'),
(23, 'Chip War', 36, 45000.00, 65000.00, 9, 2022, 'Cuộc chiến chip bán dẫn và tương lai công nghệ.', 1, '30', 'chip_war.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'chip-war'),
(24, 'Bố Già Châu Á', 37, 70000.00, 100000.00, 15, 2018, 'Tiểu thuyết về cuộc đời của một bố già huyền thoại tại châu Á.', 1, '30', 'bo_gia_chau_a.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'bo-gia-chau-a'),
(25, 'Tuổi Thơ Dữ Dội', 38, 65000.00, 90000.00, 11, 2000, 'Một câu chuyện cảm động về tuổi thơ đầy sóng gió.', 1, '30', 'tuoi_tho_du_doi.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'tuoi-tho-du-doi'),
(26, 'Tuổi Thơ Dữ Dội 2', 39, 60000.00, 85000.00, 10, 2005, 'Phần tiếp theo của hành trình đầy cảm xúc.', 1, '30', 'tuoi_tho_du_doi_2.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'tuoi-tho-du-doi-2'),
(27, 'Thơ Bảy Màu', 40, 45000.00, 65000.00, 14, 2010, 'Tập thơ tràn đầy màu sắc và cảm xúc.', 1, '30', 'tho_bay_mau.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'tho-bay-mau'),
(28, 'Hồ Sơ Chinh Khách 23', 41, 80000.00, 110000.00, 20, 2023, 'Cuộc đời và sự nghiệp của các chinh khách nổi tiếng.', 1, '30', 'hsck_23.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'ho-so-chinh-khach-23'),
(29, '100 Kỹ Năng Sinh Tồn', 42, 50000.00, 75000.00, 13, 2020, 'Những kỹ năng sinh tồn cơ bản và nâng cao.', 1, '30', '100_ky_nang_sinh_ton.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', '100-ky-nang-sinh-ton'),
(30, 'Doanh Nhân Thế Giới', 43, 55000.00, 80000.00, 9, 2019, 'Tiểu sử các doanh nhân nổi tiếng toàn cầu.', 1, '30', 'doanh_nhan_the_gioi.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'doanh-nhan-the-gioi'),
(31, 'Thiền Sư Và Bé Năm Tuổi', 44, 60000.00, 90000.00, 16, 2022, 'Một câu chuyện đầy ý nghĩa về cuộc đời và thiền.', 1, '30', 'thien_su_va_e_be_5_tuoi.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'thien-su-va-be-nam-tuoi'),
(32, 'Đừng Là Tết', 45, 50000.00, 75000.00, 10, 2021, 'Tuyển tập truyện ngắn về chủ đề Tết Việt.', 1, '30', 'dung_la_tet.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'dung-la-tet'),
(33, 'Hiểu Về Trái Tim', 46, 45000.00, 65000.00, 12, 2018, 'Cuốn sách tâm lý giúp bạn hiểu rõ hơn về cảm xúc.', 1, '30', 'hieu_ve_trai_tim.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'hieu-ve-trai-tim'),
(34, 'Saiyuki', 47, 60000.00, 90000.00, 8, 2020, 'Câu chuyện phiêu lưu kinh điển của Nhật Bản.', 1, '30', 'saiyuki.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'saiyuki'),
(35, 'Flow', 48, 70000.00, 100000.00, 7, 2023, 'Khám phá dòng chảy của sự sáng tạo và hiệu quả.', 1, '30', 'flow.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'flow'),
(36, 'Câu Lạc Bộ Những Kẻ Mất Ngủ', 49, 50000.00, 75000.00, 10, 2021, 'Câu lạc bộ đặc biệt dành cho những người không ngủ.', 1, '30', 'clb_nhung_ke_mat_ngu.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'clb-nhung-ke-mat-ngu'),
(37, 'Blue Lock', 50, 55000.00, 85000.00, 12, 2022, 'Truyện tranh thể thao hấp dẫn về bóng đá.', 1, '30', 'bluelock.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'blue-lock'),
(38, 'Claymore 3', 51, 45000.00, 65000.00, 15, 2018, 'Phần 3 của bộ truyện hành động nổi tiếng.', 1, '30', 'claymore_3.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'claymore-3'),
(39, 'Tính Cách Bạn Màu Gì?', 52, 60000.00, 90000.00, 8, 2020, 'Phân tích tính cách qua màu sắc yêu thích.', 1, '30', 'tinh_cach_ban_mau_gi.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'tinh-cach-ban-mau-gi'),
(40, 'Gỡ Mụn', 53, 50000.00, 75000.00, 20, 2017, 'Hướng dẫn chăm sóc da và trị mụn hiệu quả.', 1, '30', 'go_mun.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'go-mun'),
(41, 'Tuyển Tập Sherlock Holmes', 54, 65000.00, 95000.00, 18, 2022, 'Tập hợp các câu chuyện trinh thám kinh điển của Sherlock Holmes.', 1, '30', 'tuyen_tap_sherlock.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'tuyen-tap-sherlock-holmes'),
(42, 'Ăn Chay Tốt Cho Sức Khỏe', 55, 55000.00, 80000.00, 15, 2021, 'Những lợi ích và thực đơn ăn chay hàng ngày.', 1, '30', 'an_chay_tot_cho_sk.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'an-chay-tot-cho-sk'),
(43, 'Thiên Thần Nổi Giận', 56, 70000.00, 100000.00, 12, 2019, 'Câu chuyện kỳ bí về thiên thần và nhân loại.', 1, '30', 'thien_than_noi_gian.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'thien-than-noi-gian'),
(44, 'Sách mẫu 44', 14, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-44'),
(45, 'Sách mẫu 45', 14, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-45'),
(46, 'Sách mẫu 46', 15, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-46'),
(47, 'Sách mẫu 47', 15, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-47'),
(48, 'Sách mẫu 48', 16, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-48'),
(49, 'Sách mẫu 49', 16, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-49'),
(50, 'Sách mẫu 50', 17, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-50'),
(51, 'Sách mẫu 51', 17, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-51'),
(52, 'Sách mẫu 52', 18, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-52'),
(53, 'Sách mẫu 53', 18, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-53'),
(54, 'Sách mẫu 54', 19, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-54'),
(55, 'Sách mẫu 55', 19, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-55'),
(56, 'Sách mẫu 56', 20, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-56'),
(57, 'Sách mẫu 57', 20, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-57'),
(58, 'Sách mẫu 58', 21, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-58'),
(59, 'Sách mẫu 59', 21, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-59'),
(60, 'Sách mẫu 60', 22, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-60'),
(61, 'Sách mẫu 61', 22, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-61'),
(62, 'Sách mẫu 62', 23, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-62'),
(63, 'Sách mẫu 63', 23, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-63'),
(64, 'Sách mẫu 64', 24, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-64'),
(65, 'Sách mẫu 65', 24, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-65'),
(66, 'Sách mẫu 66', 25, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-66'),
(67, 'Sách mẫu 67', 25, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-67'),
(68, 'Sách mẫu 68', 26, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-68'),
(69, 'Sách mẫu 69', 26, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-69'),
(70, 'Sách mẫu 70', 27, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-70'),
(71, 'Sách mẫu 71', 27, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-71'),
(72, 'Sách mẫu 72', 28, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-72'),
(73, 'Sách mẫu 73', 28, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-73'),
(74, 'Sách mẫu 74', 29, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-74'),
(75, 'Sách mẫu 75', 29, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-75'),
(76, 'Sách mẫu 76', 30, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-76'),
(77, 'Sách mẫu 77', 30, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-77'),
(78, 'Sách mẫu 78', 31, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-78'),
(79, 'Sách mẫu 79', 31, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-79'),
(80, 'Sách mẫu 80', 32, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-80'),
(81, 'Sách mẫu 81', 32, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-81'),
(82, 'Sách mẫu 82', 33, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-82'),
(83, 'Sách mẫu 83', 33, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-83'),
(84, 'Sách mẫu 84', 34, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-84'),
(85, 'Sách mẫu 85', 34, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-85'),
(86, 'Sách mẫu 86', 35, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-86'),
(87, 'Sách mẫu 87', 35, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-87'),
(88, 'Sách mẫu 88', 36, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-88'),
(89, 'Sách mẫu 89', 36, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-89'),
(90, 'Sách mẫu 90', 37, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-90'),
(91, 'Sách mẫu 91', 37, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-91'),
(92, 'Sách mẫu 92', 38, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-92'),
(93, 'Sách mẫu 93', 38, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-93'),
(94, 'Sách mẫu 94', 39, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-94'),
(95, 'Sách mẫu 95', 39, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-95'),
(96, 'Sách mẫu 96', 40, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-96'),
(97, 'Sách mẫu 97', 40, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-97'),
(98, 'Sách mẫu 98', 41, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-98'),
(99, 'Sách mẫu 99', 41, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-99'),
(100, 'Sách mẫu 100', 42, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-100'),
(101, 'Sách mẫu 101', 42, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-101'),
(102, 'Sách mẫu 102', 43, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-102'),
(103, 'Sách mẫu 103', 43, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-103'),
(104, 'Sách mẫu 104', 44, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-104'),
(105, 'Sách mẫu 105', 44, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-105'),
(106, 'Sách mẫu 106', 45, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-106'),
(107, 'Sách mẫu 107', 45, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-107'),
(108, 'Sách mẫu 108', 46, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-108'),
(109, 'Sách mẫu 109', 46, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-109'),
(110, 'Sách mẫu 110', 47, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-110'),
(111, 'Sách mẫu 111', 47, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-111'),
(112, 'Sách mẫu 112', 48, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-112'),
(113, 'Sách mẫu 113', 48, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-113'),
(114, 'Sách mẫu 114', 49, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-114'),
(115, 'Sách mẫu 115', 49, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-115'),
(116, 'Sách mẫu 116', 50, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-116'),
(117, 'Sách mẫu 117', 50, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-117'),
(118, 'Sách mẫu 118', 51, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-118'),
(119, 'Sách mẫu 119', 51, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-119'),
(120, 'Sách mẫu 120', 52, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-120'),
(121, 'Sách mẫu 121', 52, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-121'),
(122, 'Sách mẫu 122', 53, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-122'),
(123, 'Sách mẫu 123', 53, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-123'),
(124, 'Sách mẫu 124', 54, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-124'),
(125, 'Sách mẫu 125', 54, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-125'),
(126, 'Sách mẫu 126', 55, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-126'),
(127, 'Sách mẫu 127', 55, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-127'),
(128, 'Sách mẫu 128', 56, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-128'),
(129, 'Sách mẫu 129', 56, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-129'),
(130, 'Sách mẫu 130', 57, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-130'),
(131, 'Sách mẫu 131', 57, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-131'),
(132, 'Sách mẫu 132', 57, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-132'),
(133, 'Sách mẫu 133', 58, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-133'),
(134, 'Sách mẫu 134', 58, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-134'),
(135, 'Sách mẫu 135', 58, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-135'),
(136, 'Sách mẫu 136', 59, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-136'),
(137, 'Sách mẫu 137', 59, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-137'),
(138, 'Sách mẫu 138', 59, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-138'),
(139, 'Sách mẫu 139', 60, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-139'),
(140, 'Sách mẫu 140', 60, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-140'),
(141, 'Sách mẫu 141', 60, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-141'),
(142, 'Sách mẫu 142', 61, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-142'),
(143, 'Sách mẫu 143', 61, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-143'),
(144, 'Sách mẫu 144', 61, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-144'),
(145, 'Sách mẫu 145', 62, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-145'),
(146, 'Sách mẫu 146', 62, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-146'),
(147, 'Sách mẫu 147', 62, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-147'),
(148, 'Sách mẫu 148', 63, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-148'),
(149, 'Sách mẫu 149', 63, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-149'),
(150, 'Sách mẫu 150', 63, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-150'),
(151, 'Sách mẫu 151', 64, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-151'),
(152, 'Sách mẫu 152', 64, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-152'),
(153, 'Sách mẫu 153', 64, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-153'),
(154, 'Sách mẫu 154', 65, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-154'),
(155, 'Sách mẫu 155', 65, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-155'),
(156, 'Sách mẫu 156', 65, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-156'),
(157, 'Sách mẫu 157', 66, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-157'),
(158, 'Sách mẫu 158', 66, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-158'),
(159, 'Sách mẫu 159', 66, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-159'),
(160, 'Sách mẫu 160', 67, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-160'),
(161, 'Sách mẫu 161', 67, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-161'),
(162, 'Sách mẫu 162', 67, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-162'),
(163, 'Sách mẫu 163', 68, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-163'),
(164, 'Sách mẫu 164', 68, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-164'),
(165, 'Sách mẫu 165', 68, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-165'),
(166, 'Sách mẫu 166', 69, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-166'),
(167, 'Sách mẫu 167', 69, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-167'),
(168, 'Sách mẫu 168', 69, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-168'),
(169, 'Sách mẫu 169', 70, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-169'),
(170, 'Sách mẫu 170', 70, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-170'),
(171, 'Sách mẫu 171', 70, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-171'),
(172, 'Sách mẫu 172', 71, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-172'),
(173, 'Sách mẫu 173', 71, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-173'),
(174, 'Sách mẫu 174', 71, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-174'),
(175, 'Sách mẫu 175', 72, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-175'),
(176, 'Sách mẫu 176', 72, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-176'),
(177, 'Sách mẫu 177', 72, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-177'),
(178, 'Sách mẫu 178', 73, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-178'),
(179, 'Sách mẫu 179', 73, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-179'),
(180, 'Sách mẫu 180', 73, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-180');
INSERT INTO `sach` (`MaSach`, `TenSach`, `category_id`, `GiaNhap`, `GiaBan`, `SoLuong`, `NamXuatBan`, `MoTa`, `TrangThai`, `LuotMua`, `HinhAnh`, `created_at`, `updated_at`, `slug`) VALUES
(181, 'Sách mẫu 181', 74, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-181'),
(182, 'Sách mẫu 182', 74, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-182'),
(183, 'Sách mẫu 183', 74, 80000.00, 120000.00, 100, 2020, 'Mô tả sách mẫu', 1, '10', 'default.png', '2025-06-12 18:13:59', '2025-06-12 18:13:59', 'sach-mau-183');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('q7k8etZLf1Z56zOLAyj9tnngDHXuByjuaQ1AlTg6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 OPR/119.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic0p0b0REV1h5dHhMVUNuQ1ZoVXhaUktlSGloMDNKUXZSVVdpeWpwQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jaGVja291dCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NDoiY2FydCI7YToxOntpOjEyO2E6NDp7czo0OiJuYW1lIjtzOjI2OiJDw6J5IGNhbSBuZ+G7jXQgY+G7p2EgdMO0aSI7czo1OiJwcmljZSI7czo4OiI0MDAwMC4wMCI7czo4OiJxdWFudGl0eSI7aToxO3M6NToiaW1hZ2UiO3M6MjQ6ImNheV9jYW1fbmdvdF9jdWFfdG9pLmpwZyI7fX19', 1750270100);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tinh`
--

CREATE TABLE `tinh` (
  `code` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `full_name_en` varchar(255) DEFAULT NULL,
  `code_name` varchar(255) DEFAULT NULL,
  `administrative_unit_id` int(11) DEFAULT NULL,
  `administrative_region_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tinh`
--

INSERT INTO `tinh` (`code`, `name`, `name_en`, `full_name`, `full_name_en`, `code_name`, `administrative_unit_id`, `administrative_region_id`) VALUES
('01', 'Hà Nội', 'Ha Noi', 'Thành phố Hà Nội', 'Ha Noi City', 'ha_noi', 1, 3),
('02', 'Hà Giang', 'Ha Giang', 'Tỉnh Hà Giang', 'Ha Giang Province', 'ha_giang', 2, 1),
('04', 'Cao Bằng', 'Cao Bang', 'Tỉnh Cao Bằng', 'Cao Bang Province', 'cao_bang', 2, 1),
('06', 'Bắc Kạn', 'Bac Kan', 'Tỉnh Bắc Kạn', 'Bac Kan Province', 'bac_kan', 2, 1),
('08', 'Tuyên Quang', 'Tuyen Quang', 'Tỉnh Tuyên Quang', 'Tuyen Quang Province', 'tuyen_quang', 2, 1),
('10', 'Lào Cai', 'Lao Cai', 'Tỉnh Lào Cai', 'Lao Cai Province', 'lao_cai', 2, 2),
('11', 'Điện Biên', 'Dien Bien', 'Tỉnh Điện Biên', 'Dien Bien Province', 'dien_bien', 2, 2),
('12', 'Lai Châu', 'Lai Chau', 'Tỉnh Lai Châu', 'Lai Chau Province', 'lai_chau', 2, 2),
('14', 'Sơn La', 'Son La', 'Tỉnh Sơn La', 'Son La Province', 'son_la', 2, 2),
('15', 'Yên Bái', 'Yen Bai', 'Tỉnh Yên Bái', 'Yen Bai Province', 'yen_bai', 2, 2),
('17', 'Hoà Bình', 'Hoa Binh', 'Tỉnh Hoà Bình', 'Hoa Binh Province', 'hoa_binh', 2, 2),
('19', 'Thái Nguyên', 'Thai Nguyen', 'Tỉnh Thái Nguyên', 'Thai Nguyen Province', 'thai_nguyen', 2, 1),
('20', 'Lạng Sơn', 'Lang Son', 'Tỉnh Lạng Sơn', 'Lang Son Province', 'lang_son', 2, 1),
('22', 'Quảng Ninh', 'Quang Ninh', 'Tỉnh Quảng Ninh', 'Quang Ninh Province', 'quang_ninh', 2, 1),
('24', 'Bắc Giang', 'Bac Giang', 'Tỉnh Bắc Giang', 'Bac Giang Province', 'bac_giang', 2, 1),
('25', 'Phú Thọ', 'Phu Tho', 'Tỉnh Phú Thọ', 'Phu Tho Province', 'phu_tho', 2, 1),
('26', 'Vĩnh Phúc', 'Vinh Phuc', 'Tỉnh Vĩnh Phúc', 'Vinh Phuc Province', 'vinh_phuc', 2, 3),
('27', 'Bắc Ninh', 'Bac Ninh', 'Tỉnh Bắc Ninh', 'Bac Ninh Province', 'bac_ninh', 2, 3),
('30', 'Hải Dương', 'Hai Duong', 'Tỉnh Hải Dương', 'Hai Duong Province', 'hai_duong', 2, 3),
('31', 'Hải Phòng', 'Hai Phong', 'Thành phố Hải Phòng', 'Hai Phong City', 'hai_phong', 1, 3),
('33', 'Hưng Yên', 'Hung Yen', 'Tỉnh Hưng Yên', 'Hung Yen Province', 'hung_yen', 2, 3),
('34', 'Thái Bình', 'Thai Binh', 'Tỉnh Thái Bình', 'Thai Binh Province', 'thai_binh', 2, 3),
('35', 'Hà Nam', 'Ha Nam', 'Tỉnh Hà Nam', 'Ha Nam Province', 'ha_nam', 2, 3),
('36', 'Nam Định', 'Nam Dinh', 'Tỉnh Nam Định', 'Nam Dinh Province', 'nam_dinh', 2, 3),
('37', 'Ninh Bình', 'Ninh Binh', 'Tỉnh Ninh Bình', 'Ninh Binh Province', 'ninh_binh', 2, 3),
('38', 'Thanh Hóa', 'Thanh Hoa', 'Tỉnh Thanh Hóa', 'Thanh Hoa Province', 'thanh_hoa', 2, 4),
('40', 'Nghệ An', 'Nghe An', 'Tỉnh Nghệ An', 'Nghe An Province', 'nghe_an', 2, 4),
('42', 'Hà Tĩnh', 'Ha Tinh', 'Tỉnh Hà Tĩnh', 'Ha Tinh Province', 'ha_tinh', 2, 4),
('44', 'Quảng Bình', 'Quang Binh', 'Tỉnh Quảng Bình', 'Quang Binh Province', 'quang_binh', 2, 4),
('45', 'Quảng Trị', 'Quang Tri', 'Tỉnh Quảng Trị', 'Quang Tri Province', 'quang_tri', 2, 4),
('46', 'Huế', 'Hue', 'Thành phố Huế', 'Hue City', 'hue', 1, 4),
('48', 'Đà Nẵng', 'Da Nang', 'Thành phố Đà Nẵng', 'Da Nang City', 'da_nang', 1, 5),
('49', 'Quảng Nam', 'Quang Nam', 'Tỉnh Quảng Nam', 'Quang Nam Province', 'quang_nam', 2, 5),
('51', 'Quảng Ngãi', 'Quang Ngai', 'Tỉnh Quảng Ngãi', 'Quang Ngai Province', 'quang_ngai', 2, 5),
('52', 'Bình Định', 'Binh Dinh', 'Tỉnh Bình Định', 'Binh Dinh Province', 'binh_dinh', 2, 5),
('54', 'Phú Yên', 'Phu Yen', 'Tỉnh Phú Yên', 'Phu Yen Province', 'phu_yen', 2, 5),
('56', 'Khánh Hòa', 'Khanh Hoa', 'Tỉnh Khánh Hòa', 'Khanh Hoa Province', 'khanh_hoa', 2, 5),
('58', 'Ninh Thuận', 'Ninh Thuan', 'Tỉnh Ninh Thuận', 'Ninh Thuan Province', 'ninh_thuan', 2, 5),
('60', 'Bình Thuận', 'Binh Thuan', 'Tỉnh Bình Thuận', 'Binh Thuan Province', 'binh_thuan', 2, 5),
('62', 'Kon Tum', 'Kon Tum', 'Tỉnh Kon Tum', 'Kon Tum Province', 'kon_tum', 2, 6),
('64', 'Gia Lai', 'Gia Lai', 'Tỉnh Gia Lai', 'Gia Lai Province', 'gia_lai', 2, 6),
('66', 'Đắk Lắk', 'Dak Lak', 'Tỉnh Đắk Lắk', 'Dak Lak Province', 'dak_lak', 2, 6),
('67', 'Đắk Nông', 'Dak Nong', 'Tỉnh Đắk Nông', 'Dak Nong Province', 'dak_nong', 2, 6),
('68', 'Lâm Đồng', 'Lam Dong', 'Tỉnh Lâm Đồng', 'Lam Dong Province', 'lam_dong', 2, 6),
('70', 'Bình Phước', 'Binh Phuoc', 'Tỉnh Bình Phước', 'Binh Phuoc Province', 'binh_phuoc', 2, 7),
('72', 'Tây Ninh', 'Tay Ninh', 'Tỉnh Tây Ninh', 'Tay Ninh Province', 'tay_ninh', 2, 7),
('74', 'Bình Dương', 'Binh Duong', 'Tỉnh Bình Dương', 'Binh Duong Province', 'binh_duong', 2, 7),
('75', 'Đồng Nai', 'Dong Nai', 'Tỉnh Đồng Nai', 'Dong Nai Province', 'dong_nai', 2, 7),
('77', 'Bà Rịa - Vũng Tàu', 'Ba Ria - Vung Tau', 'Tỉnh Bà Rịa - Vũng Tàu', 'Ba Ria - Vung Tau Province', 'ba_ria_vung_tau', 2, 7),
('79', 'Hồ Chí Minh', 'Ho Chi Minh', 'Thành phố Hồ Chí Minh', 'Ho Chi Minh City', 'ho_chi_minh', 1, 7),
('80', 'Long An', 'Long An', 'Tỉnh Long An', 'Long An Province', 'long_an', 2, 8),
('82', 'Tiền Giang', 'Tien Giang', 'Tỉnh Tiền Giang', 'Tien Giang Province', 'tien_giang', 2, 8),
('83', 'Bến Tre', 'Ben Tre', 'Tỉnh Bến Tre', 'Ben Tre Province', 'ben_tre', 2, 8),
('84', 'Trà Vinh', 'Tra Vinh', 'Tỉnh Trà Vinh', 'Tra Vinh Province', 'tra_vinh', 2, 8),
('86', 'Vĩnh Long', 'Vinh Long', 'Tỉnh Vĩnh Long', 'Vinh Long Province', 'vinh_long', 2, 8),
('87', 'Đồng Tháp', 'Dong Thap', 'Tỉnh Đồng Tháp', 'Dong Thap Province', 'dong_thap', 2, 8),
('89', 'An Giang', 'An Giang', 'Tỉnh An Giang', 'An Giang Province', 'an_giang', 2, 8),
('91', 'Kiên Giang', 'Kien Giang', 'Tỉnh Kiên Giang', 'Kien Giang Province', 'kien_giang', 2, 8),
('92', 'Cần Thơ', 'Can Tho', 'Thành phố Cần Thơ', 'Can Tho City', 'can_tho', 1, 8),
('93', 'Hậu Giang', 'Hau Giang', 'Tỉnh Hậu Giang', 'Hau Giang Province', 'hau_giang', 2, 8),
('94', 'Sóc Trăng', 'Soc Trang', 'Tỉnh Sóc Trăng', 'Soc Trang Province', 'soc_trang', 2, 8),
('95', 'Bạc Liêu', 'Bac Lieu', 'Tỉnh Bạc Liêu', 'Bac Lieu Province', 'bac_lieu', 2, 8),
('96', 'Cà Mau', 'Ca Mau', 'Tỉnh Cà Mau', 'Ca Mau Province', 'ca_mau', 2, 8);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `administrative_regions`
--
ALTER TABLE `administrative_regions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `administrative_units`
--
ALTER TABLE `administrative_units`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `baiviet`
--
ALTER TABLE `baiviet`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `baiviet` ADD FULLTEXT KEY `tieude` (`tieude`,`noidung`,`chude`);

--
-- Chỉ mục cho bảng `cart_holds`
--
ALTER TABLE `cart_holds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_session_id` (`session_id`),
  ADD KEY `idx_book_id` (`book_id`),
  ADD KEY `idx_expires_at` (`expires_at`);

--
-- Chỉ mục cho bảng `chitietgiohang`
--
ALTER TABLE `chitietgiohang`
  ADD PRIMARY KEY (`MaChiTietGioHang`),
  ADD KEY `MaSach` (`MaSach`),
  ADD KEY `fk_giohang` (`MaGioHang`);

--
-- Chỉ mục cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`MaChiTietHoaDon`),
  ADD KEY `MaHoaDon` (`MaHoaDon`),
  ADD KEY `MaSach` (`MaSach`);

--
-- Chỉ mục cho bảng `danhgiasanpham`
--
ALTER TABLE `danhgiasanpham`
  ADD PRIMARY KEY (`MaDanhGia`),
  ADD KEY `MaHoaDon` (`MaHoaDon`),
  ADD KEY `MaKhachHang` (`MaKhachHang`),
  ADD KEY `MaSach` (`MaSach`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `dia_chi_nhan_hang`
--
ALTER TABLE `dia_chi_nhan_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_diachi_khachhang` (`khachhang_id`),
  ADD KEY `fk_diachi_phuong` (`phuong_xa_id`),
  ADD KEY `fk_diachi_quan` (`quan_huyen_id`),
  ADD KEY `fk_diachi_tinh` (`tinh_thanh_id`);

--
-- Chỉ mục cho bảng `footers`
--
ALTER TABLE `footers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`MaGioHang`),
  ADD KEY `MaKhachHang` (`MaKhachHang`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`MaHoaDon`),
  ADD KEY `MaKhachHang` (`MaKhachHang`),
  ADD KEY `PT_ThanhToan` (`PT_ThanhToan`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MaKhachHang`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Email_2` (`Email`);

--
-- Chỉ mục cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`MaKhuyenMai`);

--
-- Chỉ mục cho bảng `lien_he`
--
ALTER TABLE `lien_he`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `phuong`
--
ALTER TABLE `phuong`
  ADD PRIMARY KEY (`code`),
  ADD KEY `idx_wards_district` (`district_code`),
  ADD KEY `idx_wards_unit` (`administrative_unit_id`);

--
-- Chỉ mục cho bảng `phuongthucthanhtoan`
--
ALTER TABLE `phuongthucthanhtoan`
  ADD PRIMARY KEY (`MaPhuongThuc`);

--
-- Chỉ mục cho bảng `quan`
--
ALTER TABLE `quan`
  ADD PRIMARY KEY (`code`),
  ADD KEY `idx_districts_province` (`province_code`),
  ADD KEY `idx_districts_unit` (`administrative_unit_id`);

--
-- Chỉ mục cho bảng `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`MaSach`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `tinh`
--
ALTER TABLE `tinh`
  ADD PRIMARY KEY (`code`),
  ADD KEY `idx_provinces_region` (`administrative_region_id`),
  ADD KEY `idx_provinces_unit` (`administrative_unit_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `baiviet`
--
ALTER TABLE `baiviet`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `cart_holds`
--
ALTER TABLE `cart_holds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=468;

--
-- AUTO_INCREMENT cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  MODIFY `MaChiTietHoaDon` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT cho bảng `dia_chi_nhan_hang`
--
ALTER TABLE `dia_chi_nhan_hang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `footers`
--
ALTER TABLE `footers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `MaGioHang` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `MaHoaDon` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MaKhachHang` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  MODIFY `MaKhuyenMai` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `lien_he`
--
ALTER TABLE `lien_he`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `phuongthucthanhtoan`
--
ALTER TABLE `phuongthucthanhtoan`
  MODIFY `MaPhuongThuc` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `sach`
--
ALTER TABLE `sach`
  MODIFY `MaSach` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart_holds`
--
ALTER TABLE `cart_holds`
  ADD CONSTRAINT `fk_ch_book` FOREIGN KEY (`book_id`) REFERENCES `sach` (`MaSach`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ch_user` FOREIGN KEY (`user_id`) REFERENCES `khachhang` (`MaKhachHang`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `chitietgiohang`
--
ALTER TABLE `chitietgiohang`
  ADD CONSTRAINT `chitietgiohang_ibfk_1` FOREIGN KEY (`MaGioHang`) REFERENCES `giohang` (`MaGioHang`),
  ADD CONSTRAINT `chitietgiohang_ibfk_2` FOREIGN KEY (`MaSach`) REFERENCES `sach` (`MaSach`),
  ADD CONSTRAINT `fk_giohang` FOREIGN KEY (`MaGioHang`) REFERENCES `giohang` (`MaGioHang`);

--
-- Các ràng buộc cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD CONSTRAINT `chitiethoadon_ibfk_1` FOREIGN KEY (`MaHoaDon`) REFERENCES `hoadon` (`MaHoaDon`),
  ADD CONSTRAINT `chitiethoadon_ibfk_2` FOREIGN KEY (`MaSach`) REFERENCES `sach` (`MaSach`);

--
-- Các ràng buộc cho bảng `danhgiasanpham`
--
ALTER TABLE `danhgiasanpham`
  ADD CONSTRAINT `danhgiasanpham_ibfk_1` FOREIGN KEY (`MaHoaDon`) REFERENCES `hoadon` (`MaHoaDon`),
  ADD CONSTRAINT `danhgiasanpham_ibfk_2` FOREIGN KEY (`MaKhachHang`) REFERENCES `khachhang` (`MaKhachHang`),
  ADD CONSTRAINT `danhgiasanpham_ibfk_3` FOREIGN KEY (`MaSach`) REFERENCES `sach` (`MaSach`);

--
-- Các ràng buộc cho bảng `dia_chi_nhan_hang`
--
ALTER TABLE `dia_chi_nhan_hang`
  ADD CONSTRAINT `fk_diachi_khachhang` FOREIGN KEY (`khachhang_id`) REFERENCES `khachhang` (`MaKhachHang`),
  ADD CONSTRAINT `fk_diachi_phuong` FOREIGN KEY (`phuong_xa_id`) REFERENCES `phuong` (`code`),
  ADD CONSTRAINT `fk_diachi_quan` FOREIGN KEY (`quan_huyen_id`) REFERENCES `quan` (`code`),
  ADD CONSTRAINT `fk_diachi_tinh` FOREIGN KEY (`tinh_thanh_id`) REFERENCES `tinh` (`code`);

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`MaKhachHang`) REFERENCES `khachhang` (`MaKhachHang`);

--
-- Các ràng buộc cho bảng `phuong`
--
ALTER TABLE `phuong`
  ADD CONSTRAINT `wards_administrative_unit_id_fkey` FOREIGN KEY (`administrative_unit_id`) REFERENCES `administrative_units` (`id`),
  ADD CONSTRAINT `wards_district_code_fkey` FOREIGN KEY (`district_code`) REFERENCES `quan` (`code`);

--
-- Các ràng buộc cho bảng `quan`
--
ALTER TABLE `quan`
  ADD CONSTRAINT `districts_administrative_unit_id_fkey` FOREIGN KEY (`administrative_unit_id`) REFERENCES `administrative_units` (`id`),
  ADD CONSTRAINT `districts_province_code_fkey` FOREIGN KEY (`province_code`) REFERENCES `tinh` (`code`);

--
-- Các ràng buộc cho bảng `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `sach_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `danhmuc` (`id`);

--
-- Các ràng buộc cho bảng `tinh`
--
ALTER TABLE `tinh`
  ADD CONSTRAINT `provinces_administrative_region_id_fkey` FOREIGN KEY (`administrative_region_id`) REFERENCES `administrative_regions` (`id`),
  ADD CONSTRAINT `provinces_administrative_unit_id_fkey` FOREIGN KEY (`administrative_unit_id`) REFERENCES `administrative_units` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
