-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 11, 2025 lúc 01:15 AM
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
(9, 'Danh Nhân', 2, '2025-06-10 20:05:54', NULL, 'danh-nhan', 'danh-nhan.jpg'),
(10, 'Tâm Lý - Kỹ Năng Sống', 2, '2025-06-10 20:05:54', NULL, 'tam-ly-ky-nang-song', 'tam-ly-ky-nang-song.jpg'),
(11, 'Sách Tin Học Ngoại Ngữ', 2, '2025-06-10 20:05:54', NULL, 'sach-tin-hoc-ngoai-ngu', 'sach-tin-hoc-ngoai-ngu.jpg'),
(12, 'Sách Chuyên Ngành', 2, '2025-06-10 20:05:54', NULL, 'sach-chuyen-nganh', 'sach-chuyen-nganh.jpg'),
(13, 'Sách Giáo Khoa - Giáo Trinh', 2, '2025-06-10 20:05:54', NULL, 'sach-giao-khoa-giao-trinh', 'sach-giao-khoa-giao-trinh.jpg'),
(14, 'a', 2, '2025-06-10 20:05:54', NULL, 'a', NULL),
(27, 'Ngoại Thương', 3, '2025-06-10 20:05:54', NULL, 'ngoai-thuong', NULL),
(28, 'Marketing - Bán Hàng', 3, '2025-06-10 20:05:54', NULL, 'marketing-ban-hang', NULL),
(29, 'Nhân Sự & Việc Làm', 3, '2025-06-10 20:05:54', NULL, 'nhan-su-va-viec-lam', NULL),
(30, 'Nhân Vật & Bài Học Kinh Doanh', 3, '2025-06-10 20:05:54', NULL, 'nhan-vat-va-bai-hoc-kinh-doanh', NULL),
(31, 'Phân Tích & Môi Trường Kinh Tế', 3, '2025-06-10 20:05:54', NULL, 'phan-tich-va-moi-truong-kinh-te', NULL),
(32, 'Quản Trị - Lãnh Đạo', 3, '2025-06-10 20:05:54', NULL, 'quan-tri-lanh-dao', NULL),
(33, 'Tài Chính & Tiền Tệ', 3, '2025-06-10 20:05:54', NULL, 'tai-chinh-va-tien-te', NULL),
(34, 'Tài Chính – Kế Toán', 3, '2025-06-10 20:05:54', NULL, 'tai-chinh-ke-toan', NULL),
(35, 'Văn Bản Luật', 3, '2025-06-10 20:05:54', NULL, 'van-ban-luat', NULL),
(36, 'Khởi Nghiệp/Kỹ Năng Làm Việc', 3, '2025-06-10 20:05:54', NULL, 'khoi-nghiep-ky-nang-lam-viec', NULL),
(37, 'Nhân Vật Văn Học/Nhân Vật Lịch Sử', 4, '2025-06-10 20:05:54', NULL, 'nhan-vat-van-hoc-nhan-vat-lich-su', NULL),
(38, 'Phê Bình Văn Học', 4, '2025-06-10 20:05:54', NULL, 'phe-binh-van-hoc', NULL),
(39, 'Phóng Sự, Ký Sự', 4, '2025-06-10 20:05:54', NULL, 'phong-su-ky-su', NULL),
(40, 'Thơ Ca', 4, '2025-06-10 20:05:54', NULL, 'tho-ca', NULL),
(41, 'Tiểu Thuyết', 4, '2025-06-10 20:05:54', NULL, 'tieu-thuyet', NULL),
(42, 'Tiểu Thuyết Lịch Sử', 4, '2025-06-10 20:05:54', NULL, 'tieu-thuyet-lich-su', NULL),
(43, 'Truyện & Thơ Ca Dân Gian', 4, '2025-06-10 20:05:54', NULL, 'truyen-tho-ca-dan-gian', NULL),
(44, 'Truyện Dài', 4, '2025-06-10 20:05:54', NULL, 'truyen-dai', NULL),
(45, 'Truyện Giả Tưởng – Thần Bí', 4, '2025-06-10 20:05:54', NULL, 'truyen-gia-tuong-than-bi', NULL),
(46, 'Truyện Kiếm Hiệp', 4, '2025-06-10 20:05:54', NULL, 'truyen-kiem-hiep', NULL),
(47, 'Truyện Ngắn – Tản Văn', 4, '2025-06-10 20:05:54', NULL, 'truyen-ngan-tan-van', NULL),
(48, 'Truyện Thiếu Nhi', 4, '2025-06-10 20:05:54', NULL, 'truyen-thieu-nhi', NULL),
(49, 'Truyện Trinh Thám, Vụ Án', 4, '2025-06-10 20:05:54', NULL, 'truyen-trinh-tham-vu-an', NULL),
(50, 'Tự Truyện - Hồi Ký', 4, '2025-06-10 20:05:54', NULL, 'tu-truyen-hoi-ky', NULL),
(51, 'Bí Quyết Làm Đẹp', 5, '2025-06-10 20:05:54', NULL, 'bi-quyet-lam-dep', NULL),
(52, 'Gia Đình, Nuôi Dạy Con', 5, '2025-06-10 20:05:54', NULL, 'gia-dinh-nuoi-day-con', NULL),
(53, 'Nhà Ở, Vật Nuôi', 5, '2025-06-10 20:05:54', NULL, 'nha-o-vat-nuoi', NULL),
(54, 'Sách Tâm Lý - Giới Tính', 5, '2025-06-10 20:05:54', NULL, 'sach-tam-ly-gioi-tinh', NULL),
(55, 'Nữ Công Gia Chánh', 5, '2025-06-10 20:05:54', NULL, 'nu-cong-gia-chanh', NULL),
(56, 'Khoa Học Tự Nhiên', 6, '2025-06-10 20:05:54', '2025-06-10 19:00:56', 'khoa-hoc-tu-nhien', NULL),
(57, 'Khoa Học Xã Hội', 6, '2025-06-10 20:05:54', '2025-06-10 19:00:56', 'khoa-hoc-xa-hoi', NULL),
(58, 'Mỹ Thuật, Âm Nhạc', 6, '2025-06-10 20:05:54', '2025-06-10 19:00:56', 'my-thuat-am-nhac', NULL),
(59, 'Sách Ngoại Ngữ', 6, '2025-06-10 20:05:54', '2025-06-10 19:00:56', 'sach-ngoai-ngu', NULL),
(60, 'Truyện Tranh', 6, '2025-06-10 20:05:54', '2025-06-10 19:00:56', 'truyen-tranh', NULL),
(61, 'Sách Học Làm Người', 7, '2025-06-10 20:05:54', NULL, 'sach-hoc-lam-nguoi', NULL),
(62, 'Danh Nhân', 7, '2025-06-10 20:05:54', NULL, 'danh-nhan', NULL),
(63, 'Tâm Lý - Kỹ Năng Sống', 7, '2025-06-10 20:05:54', NULL, 'tam-ly-ky-nang-song', NULL),
(64, 'Sách Ngoại Ngữ', 11, '2025-06-10 20:05:54', NULL, 'sach-ngoai-ngu', NULL),
(65, 'Từ Điển', 11, '2025-06-10 20:05:54', NULL, 'tu-dien', NULL),
(66, 'Tin Học', 11, '2025-06-10 20:05:54', NULL, 'tin-hoc', NULL),
(67, 'Âm Nhạc', 12, '2025-06-10 20:05:54', NULL, 'am-nhac', NULL),
(68, 'Chính Trị, Triết Học', 12, '2025-06-10 20:05:54', NULL, 'chinh-tri-triet-hoc', NULL),
(69, 'Du Lịch', 12, '2025-06-10 20:05:54', NULL, 'du-lich', NULL),
(70, 'Khoa Học Cơ Bản', 12, '2025-06-10 20:05:54', NULL, 'khoa-hoc-co-ban', NULL),
(71, 'Khoa Học Kỹ Thuật', 12, '2025-06-10 20:05:54', NULL, 'khoa-hoc-ky-thuat', NULL),
(72, 'Khoa Học Tự Nhiên - Xã Hội', 12, '2025-06-10 20:05:54', NULL, 'khoa-hoc-tu-nhien-xa-hoi', NULL),
(73, 'Mỹ Thuật, Kiến Trúc', 12, '2025-06-10 20:05:54', NULL, 'my-thuat-kien-truc', NULL),
(74, 'Nông Lâm Nghiệp', 12, '2025-06-10 20:05:54', NULL, 'nong-lam-nghiep', NULL),
(75, 'Pháp Luật', 12, '2025-06-10 20:05:54', NULL, 'phap-luat', NULL),
(76, 'Sách Học Nghề', 12, '2025-06-10 20:05:54', NULL, 'sach-hoc-nghe', NULL),
(77, 'Sách Tôn Giáo', 12, '2025-06-10 20:05:54', NULL, 'sach-ton-giao', NULL),
(78, 'Thể Thao', 12, '2025-06-10 20:05:54', NULL, 'the-thao', NULL),
(79, 'Văn Hoá Nghệ Thuật', 12, '2025-06-10 20:05:54', NULL, 'van-hoa-nghe-thuat', NULL),
(80, 'Y Học', 12, '2025-06-10 20:05:54', NULL, 'y-hoc', NULL),
(81, 'Nghiệp Vụ Báo Chí', 12, '2025-06-10 20:05:54', NULL, 'nghiep-vu-bao-chi', NULL),
(82, 'Cấp 1', 13, '2025-06-10 20:05:54', NULL, 'cap-1', NULL),
(83, 'Cấp 2', 13, '2025-06-10 20:05:54', NULL, 'cap-2', NULL),
(84, 'Cấp 3', 13, '2025-06-10 20:05:54', NULL, 'cap-3', NULL),
(85, 'Sách Tham Khảo', 13, '2025-06-10 20:05:54', NULL, 'sach-tham-khao', NULL),
(86, 'Đại Học', 13, '2025-06-10 20:05:54', NULL, 'dai-hoc', NULL),
(87, 'Bộ Sách Giáo Khoa', 13, '2025-06-10 20:05:54', NULL, 'bo-sach-giao-khoa', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhsachyeuthich`
--

CREATE TABLE `danhsachyeuthich` (
  `MaKH` bigint(20) DEFAULT NULL,
  `MaSP` bigint(20) DEFAULT NULL,
  `TrangThai` binary(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhsachyeuthich`
--

INSERT INTO `danhsachyeuthich` (`MaKH`, `MaSP`, `TrangThai`) VALUES
(1, 2, 0x01),
(1, 8, 0x01);

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
  `TrangThai` tinyint(4) DEFAULT 1,
  `MatKhau` varchar(255) DEFAULT NULL,
  `NgayTao` datetime DEFAULT current_timestamp(),
  `NgayCapNhat` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`MaKhachHang`, `Ho`, `Ten`, `Email`, `TrangThai`, `MatKhau`, `NgayTao`, `NgayCapNhat`, `remember_token`) VALUES
(1, 'a', 'a', 'admin@juice-sh.op', 1, '$2y$12$JBmZvFypXQ0ys8yr0/YJF.EiwI84E/ZHvIJrnNqULuaVA.e0hiQvK', '2025-06-10 12:39:44', NULL, NULL),
(2, 'a', 'a', 'quangbao@gmail.com', 1, '$2y$12$gStkX.52QlN6dmGCoC9FEuFGLdiy5ue7Souj7lqXjTy3eDRREv2lO', '2025-06-10 13:10:30', NULL, NULL),
(3, 'a', 'a', 'quangbao1@gmail.com', 1, '$2y$12$3xewEXe9sLByTSUVzlpgPO4gZlvFmL7JMWQtPydVEA41QiPE6/huK', '2025-06-10 14:04:51', '2025-06-11 01:25:03', 'PuWu18ExzwuEPtqld3snVYfkVP92DpMbLmLwfTDPAwkhFHCt0Sd3X2GIMoYv'),
(4, NULL, NULL, 'vana@example.com', 1, '$2y$12$K1sMsO4YXbKWdtT9zkIEBOY2Oy04MP6Bkc.Y4979UUO6p/f5g4Z2.', '2025-06-10 22:36:05', NULL, NULL),
(5, 'q', 'q', 'q@gmail.com', 1, '$2y$12$uZwJNaRGNPKfGz8RzBKnD.KoVY.9KIkapLkBoSnxm4F7TDAU39TVa', '2025-06-10 15:49:53', NULL, NULL);

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
-- Cấu trúc bảng cho bảng `sach`
--

CREATE TABLE `sach` (
  `MaSach` bigint(20) NOT NULL,
  `TenSach` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `GiaNhap` decimal(15,2) DEFAULT NULL,
  `GiaBan` decimal(15,2) DEFAULT NULL,
  `SoLuong` int(11) DEFAULT NULL,
  `NamXuatBan` int(11) DEFAULT NULL,
  `MoTa` text DEFAULT NULL,
  `TrangThai` tinyint(4) DEFAULT NULL,
  `LuotMua` varchar(255) DEFAULT NULL,
  `HinhAnh` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sach`
--

INSERT INTO `sach` (`MaSach`, `TenSach`, `category_id`, `GiaNhap`, `GiaBan`, `SoLuong`, `NamXuatBan`, `MoTa`, `TrangThai`, `LuotMua`, `HinhAnh`, `created_at`, `updated_at`, `slug`) VALUES
(1, 'Trường Ca Achilles', 27, 70000.00, 117000.00, 5000, 2012, 'HUYỀN THOẠI BẮT ĐẦU…\r\n\r\nHy Lạp vào thời hoàng kim của các anh hùng. Patroclus là một hoàng tử trẻ vụng về, bị trục xuất tới vương quốc Phthia và được nuôi dạy dưới sự che chở của vua Peleus cùng cậu con trai hoàng kim của ngài, Achilles. “Người Hy Lạp vĩ đại nhất” – mạnh mẽ, đẹp đẽ, và mang nửa dòng máu của một nữ thần – Achilles là tất cả những gì mà Patroclus không bao giờ có được. Nhưng bất chấp sự khác biệt giữa họ, hai cậu bé trở thành chiến hữu trung thành của nhau. Tình cảm giữa họ càng đậm sâu khi cả hai lớn lên thành những chàng trai trẻ, thành thạo trong kĩ nghệ chiến đấu và y dược.\r\n\r\nKhi tin tức truyền tới rằng nàng Helen xứ Sparta đã bị bắt cóc, những chiến binh Hy Lạp, bị trói buộc bởi lời thề máu, phải nhân danh nàng mà vây hãm thành Troy. Bị cám dỗ bởi lời hứa hẹn về một số mệnh huy hoàng, Achilles tham gia hàng ngũ của họ. Bị giằng xé giữa tình yêu và nỗi lo sợ dành cho người bạn của mình, Patroclus ra trận theo Achilles. Họ không hay biết rằng các nữ thần Số Phận sẽ thử thách cả hai người họ hơn bao giờ hết và đòi hỏi một sự hi sinh khủng khiếp.\r\n\r\nDựa trên nền tảng của sử thi Iliad, câu chuyện về cuộc chiến thành Troy vĩ đại đã được Madeline Miller kể lại với tiết tấu dồn dập, lôi cuốn, và không kém phần xúc động, đánh dấu sự khởi đầu của một sự nghiệp rực rỡ.\r\n\r\nTrường Ca Achilles đã đoạt giải Orange năm 2012 và luôn nằm trong top các sách bán chạy của tờ New York Times.', 1, '10', '1736334720_TruongngCaAchilles.png', '2025-01-07 17:00:00', '2025-01-07 17:00:00', 'truong-ca-achilles'),
(2, 'Nhà Giả Kim', 28, 80000.00, 120000.00, 5000, 2020, 'Tất cả những trải nghiệm trong chuyến phiêu du theo đuổi vận mệnh của mình đã giúp Santiago thấu hiểu được ý nghĩa sâu xa nhất của hạnh phúc, hòa hợp với vũ trụ và con người. \r\n\r\nTiểu thuyết Nhà giả kim của Paulo Coelho như một câu chuyện cổ tích giản dị, nhân ái, giàu chất thơ, thấm đẫm những minh triết huyền bí của phương Đông. Trong lần xuất bản đầu tiên tại Brazil vào năm 1988, sách chỉ bán được 900 bản. Nhưng, với số phận đặc biệt của cuốn sách dành cho toàn nhân loại, vượt ra ngoài biên giới quốc gia, Nhà giả kim đã làm rung động hàng triệu tâm hồn, trở thành một trong những cuốn sách bán chạy nhất mọi thời đại, và có thể làm thay đổi cuộc đời người đọc.\r\n\r\n“Nhưng nhà luyện kim đan không quan tâm mấy đến những điều ấy. Ông đã từng thấy nhiều người đến rồi đi, trong khi ốc đảo và sa mạc vẫn là ốc đảo và sa mạc. Ông đã thấy vua chúa và kẻ ăn xin đi qua biển cát này, cái biển cát thường xuyên thay hình đổi dạng vì gió thổi nhưng vẫn mãi mãi là biển cát mà ông đã biết từ thuở nhỏ. Tuy vậy, tự đáy lòng mình, ông không thể không cảm thấy vui trước hạnh phúc của mỗi người lữ khách, sau bao ngày chỉ có cát vàng với trời xanh nay được thấy chà là xanh tươi hiện ra trước mắt. ‘Có thể Thượng đế tạo ra sa mạc chỉ để cho con người biết quý trọng cây chà là,’ ông nghĩ.”\r\n\r\n- Trích Nhà giả kim', 1, '35', '1736334731_NhaGiaKim.png', '2025-01-07 17:00:00', '2025-01-07 17:00:00', 'nha-gia-kim-tai-ban-2020'),
(3, 'Trốn Lên Mái Nhà Để Khóc', 29, 50000.00, 95000.00, 5000, 2020, 'Những cơn gió heo may len lỏi vào từng góc phố nhỏ, mùa thu về gợi nhớ bao yêu thương đong đầy, bao xúc cảm dịu dàng của ký ức. Đó là nỗi nhớ đau đáu những hương vị quen thuộc của đồng nội, là hoài niệm bất chợt khi đi trên con đường cũ in dấu bao kỷ niệm... để rồi ta ước có một chuyến tàu kỳ diệu trở về những năm tháng ấy, trở về nơi nương náu bình yên sau những tháng ngày loay hoay để học cách trở thành một người lớn. Bạn sẽ được đắm mình trong những cảm xúc đẹp đẽ xen lẫn những tiếc nuối đầy lắng đọng trong “Trốn lên mái nhà đẻ khóc” của Lam.\r\n\r\n“Trốn lên mái nhà để khóc” là cuốn nhật ký nhỏ ghi lại những hoài niệm đẹp đẽ cất giữ vào góc nhỏ nơi sâu thẳm của trái tim của mỗi người, đồng thời cũng là người bạn đồng hành để chúng ta tiếp tục bước đi đến tương lai. Sau khi “Trốn lên mái nhà và khóc” khép lại, hãy mạnh mẽ để sống hết mình và để lại “những tháng năm rực rỡ”.', 1, '30', '1736334951_TronLenMaiNhaDeKhoc.png', '2025-01-07 17:00:00', '2025-01-07 17:00:00', 'tron-len-mai-nha-de-khoc'),
(4, 'Quản Trị Bằng Văn Hóa ', 30, 80000.00, 200000.00, 5000, 2020, 'Thông qua cuốn sách, TS Giản Tư Trung cũng mong muốn góp phần cổ vũ và thúc đẩy cho sự phát triển của một phương cách quản trị mới, vừa nhân văn, vừa hiệu quả, đó là “Quản trị bằng Văn hóa / Quản trị bằng Tự trị” (Management by Culture /\r\n\r\nManagement by Self-Mangement). Bởi lẽ tác giả tin rằng, bên cạnh các phương cách quản trị truyền thống như Quản trị bằng Luật lệ (Mangement by Polices) hay Quản trị bằng Mục tiêu (Management by Objectives) thì Quản trị bằng Văn hóa (Management by Culture) chính là tương lai của quản trị và tương lai của lãnh đạo trong một thế giới đầy biến động và trong một thời đại mà con người ngày càng trở nên độc lập và tự do hơn. Cuốn sách này có sự tích hợp xuyên suốt từ tinh thần, tư tưởng và triết lý cho đến phương pháp và giải pháp, cũng như có sự kết nối 5 chủ thể văn hóa là cá nhân, bộ phận, tổ chức, kinh thương, và quốc gia. Đặc biệt, những tư duy và phương pháp cốt lõi về xây dựng và chuyển đổi văn hóa được chia sẻ trong cuốn sách này có tính nguyên lý, nên không chỉ áp dụng cho các doanh nghiệp, mà còn có thể áp dụng cho mọi loại hình tổ chức khác, bao gồm cả trường học, bệnh viện, báo chí, các tổ chức xã hội, cơ quan nhà nước, hay các tổ chức phi chính phủ.\r\n\r\nVề tác giả Giản Tư Trung:\r\n\r\nTác giả Giản Tư Trung hiện là Chủ tịch sáng lập Học viện Quản Lý PACE, Hiệu trưởng Trường Doanh Nhân PACE, Viện trưởng Viện Giáo Dục IRED, Phó Chủ tịch Quỹ Văn hóa Phan Châu Trinh, Trưởng Ban Tổ chức Giải thưởng Sách Hay và Chủ nhiệm IPL Scholarship. Ông nhận bằng Thạc sĩ về Nghiên cứu Phát triển tại Học viện Sau Đại học Geneva; Tu nghiệp về Chính sách Giáo dục Quốc tế tại Đại học Harvard; Tốt nghiệp Tiến sĩ về Giáo dục tại Học viện Giáo dục Quốc gia Singapore; và tốt nghiệp Tiến sĩ về Giáo dục tại Đại học London (UCL). Với những cống hiến của Ông cho giáo dục, Diễn Đàn Kinh Tế Thế Giới đã vinh danh Ông là một Nhà lãnh đạo toàn cầu trong vai trò là một Nhà hoạt động giáo dục.', 1, '30', '1736334864_QuanTriVanHoa.png', '2025-01-07 17:00:00', '2025-01-07 17:00:00', 'quan-tri-bang-van-hoa-cach-thuc-kien-tao-va-tai'),
(5, 'Hồ Sơ Tâm Lí Tội Phạm - Tập 1', 31, 80000.00, 120000.00, 5000, 2020, 'BỘ SÁCH CHẤN ĐỘNG NHẤT VỀ TÂM LÍ TỘI PHẠM. PHƠI BÀY TRỌN VẸN NHỮNG GÓC KHUẤT NỘI TÂM CỦA KẺ THỦ ÁC.\r\n\r\nKể từ khi nghiên cứu tâm lí học tội phạm đến nay, tôi đã chứng kiến rất nhiều tội ác muôn hình vạn trạng, nhưng hầu hết tất cả những hành vi biến thái đó đều ẩn chứa đằng sau một động cơ chung: Khát vọng được quan tâm và yêu thương.\"\r\n\r\nTrước đây, trên thế giới từng có những vụ trọng án đi vào ngõ cụt, bởi tất cả các bằng chứng và dấu vết đã bị kẻ thủ ác khôn ngoan xóa sạch. Trong lịch sử, không hề hiếm những vụ án mà cảnh sát phải bó tay, không thể bắt hung thủ hiện nguyên hình.\r\nNgày nay, ngoài các kĩ thuật hình sự hỗ trợ điều tra tội phạm, thì tâm lí học tội phạm chính là một trong những “kĩ thuật bóc tách” hung thủ từ các nghi can. Những kẻ giết người hàng loạt thực hiện hành vi tàn nhẫn hết lần này đến lần khác mà không để lại chút sơ hở nào, vậy giữa biển người mênh mông làm sao có thể khoanh vùng và tìm được kẻ thủ ác? Những nhà tâm lí học tội phạm dựa vào các hành vi gây án hay còn gọi là chứng cứ hành vi để phân tích tâm lí của kẻ thủ ác và bước đầu phác họa hồ sơ tội phạm, giúp thu hẹp phạm vi điều tra.\r\n\r\nTừ sự nắm bắt và quan sát tinh vi dựa trên tâm lí, các cảnh sát hình sự phải mò mẫm trong con đường hầm mờ tối để lần ra manh mối và dấu vết. Con đường ấy vô cùng vất vả và gian truân, sẽ có những vấp ngã, sẽ có đau đớn và hiểm nguy, nhưng cuối đường hầm luôn là ánh sáng. Bởi vì công lí cuối cùng sẽ đánh bại cái ác, kể cả khi công lí tới sau. Cuốn sách mà các bạn đang cầm trên tay sẽ đưa chúng ta đến với những trải nghiệm của các điều tra viên, thấu hiểu sự hi sinh và mất mát của lực lượng cảnh sát, đào sâu tìm hiểu những kiến thức tâm lí học tội phạm ứng dụng. Các tình tiết truyện đan xen, hấp dẫn nhưng cũng chất chứa trong đó giá trị nhân văn sâu sắc. Có lẽ khi đọc cuốn tiểu thuyết này, chúng ta càng thấm thía câu nói: “Hiền dữ phải đâu là tính sẵn. Phần nhiều do giáo dục mà nên.”\r\n\r\nTác giả Cương Tuyết Ấn là người thành phố Đại Liên, tỉnh Liêu Ninh. Những năm trở lại đây, ông kiên trì sáng tác những tác phẩm trinh thám về điều tra hình sự có liên quan tới tâm lí tội phạm.\r\n\r\nMỗi câu chuyện dưới ngòi bút của ông đều dẫn dắt người đọc vào thế giới suy luận hồi hộp, gay cấn đến nghẹt thở. Tác phẩm tiêu biểu – bộ tiểu thuyết Hồ sơ tâm lí tội phạm – bán chạy ở thị trường Trung Quốc đại lục, Hồng Kông, Đài Loan… Năm 2016 tác phẩm được xuất bản bằng tiếng Anh, bán ở thị trường nước ngoài.', 1, '30', '1736334872_HoSoTamLyToiPham.png', '2025-01-07 17:00:00', '2025-01-07 17:00:00', 'ho-so-tam-li-toi-pham-tap-1'),
(6, '5 Nguyên Tắc Thép', 32, 30000.00, 60000.00, 5000, 2020, '5 nguyên tắc thép, 15 thuật bán hàng thành công\n\nKhách hàng có mua sản phẩm của bạn hay không, điều này không chỉ phụ thuộc vào chất lượng sản phẩm ưu việt bạn mang lại, mà còn phụ thuộc vào kĩ năng bán hàng tuyệt vời của bạn. Trong quá trình mua hàng và bán hàng tồn tại rất nhiều hoạt động tâm lí có thể ảnh hưởng đến hành vi của khách hàng. Cuốn sách này sẽ lí giải trong quá trình bán hàng, người bán hàng cần có kĩ năng gì, nên áp dụng các thuật tâm lí như thế nào để tác động tích cực đến khách hàng và khiến khách hàng nảy sinh hành vi mua hàng.\n\nNếu như bạn là một người tiêu dùng, sau khi đọc cuốn sách này rồi, tôi hi vọng trước khi mở hầu bao, bạn nên thử nghiêm túc nghĩ xem: Thứ mà mình định mua có thực sự cần thiết hay không? Nếu bạn là một người bán hàng, tôi hi vọng rằng bạn, với nhân cách cao đẹp của mình, có thể sử dụng tốt những kĩ năng bán hàng mà tất cả mọi người đều có thể chấp nhận đã được mô tả cuốn sách này để phát triển được một thị trường rộng lớn hơn, và tạo ra doanh số bán hàng tuyệt vời hơn.', 1, '40', '1736334880_5NguyenTacThep.png', '2025-01-07 17:00:00', '2025-01-07 17:00:00', '5-nguyen-tac-thep-15-thuat-ban-hang-thanh-cong'),
(7, 'Chính Sách Tiền Tệ Thế Kỷ 21', 32, 80000.00, 300000.00, 5000, 2020, 'Cuốn sách đầu tiên bàn về lịch sử chống lạm phát & khủng hoảng của Cục Dự trữ Liên bang Hoa Kỳ\r\n\r\nChính sách tiền tệ thế kỷ 21 xem xét Fed – cơ quan quản lý chính sách tiền tệ Mỹ của hiện tại và tương lai chủ yếu thông qua lăng kính lịch sử, nhằm giúp người đọc hiểu được Fed đã làm thế nào để đạt được vị trí như ngày nay, học được gì từ những thách thức đa dạng phải đối mặt, và có thể phát triển như thế nào trong tương lai.\r\n\r\nĐược viết bởi Ben S. Bernanke – người giữ chức Chủ tịch Fed từ năm 2006 đến năm 2014, cuốn sách mang đến cái nhìn tổng quan về quá trình hoạch định chính sách của Fed trong 70 năm qua, cho thấy những thay đổi trong nền kinh tế đã thúc đẩy những đổi mới của Fed như thế nào cũng như những thách thức mới mà Fed phải đối mặt, bao gồm: lạm phát quay trở lại, tiền điện tử, rủi ro bất ổn tài chính gia tăng và các mối đe dọa đối với tính độc lập của tổ chức này.\r\n\r\nNgoài việc giải thích các công cụ hoạch định chính sách mới của hệ thống ngân hàng trung ương, cuốn sách còn kể về những khoảnh khắc kịch tính mà với đó, các quyết định của Fed dưới triết lý của những người từng chèo lái tổ chức này - đã tạo nên nhiều tác động đáng kể. Sách gồm 4 phần:\r\n\r\n1. Sự tăng giảm của lạm phát: bàn về các chiến lược ứng phó của Fed trước Đại Lạm Phát (thập niên 60-80 thế kỷ 20) và giai đoạn bùng nổ 1990.\r\n\r\n2. Khủng hoảng tài chính toàn cầu và Đại Suy thoái: bàn về những thách thức của thiên niên kỷ mới, trong đó có suy thoái 2001, giảm phát 2003, Khủng hoảng tài chính toàn cầu (2007-2008) và Đại Suy thoái (2009).\r\n\r\n3. Từ nâng lãi suất đến đại dịch Covid-19: bàn về chiến lược của Fed từ sau thời Bernanke (2014) đến đại dịch Covid-19, gồm các chính sách nâng lãi suất, chính sách tiền tệ trung lập, nỗ lực đảm bảo tính độc lập của Fed và các biến động dưới thời Jay Powell, và chiến lược ứng phó khủng hoảng trong thời kỳ đại dịch Covid-19.\r\n\r\n4. Tương lai phía trước: đánh giá lại các công cụ mà Fed đã áp dụng, bàn về các phương án & công cụ mới để xây dựng chính sách hiệu quả, mạnh mẽ hơn, vai trò của chính sách tiền tệ trong việc duy trì ổn định tài chính, về tính độc lập và vai trò của Fed trong xã hội.\r\n\r\nNhững đánh giá thành công hay thất bại và những bài học trong chính sách tiền tệ của Mỹ trong 70 năm qua từ một chuyên gia như Bernanke chắc chắn là những kiến thức quý báu cho các nhà hoạch định chính sách và các nhà nghiên cứu kinh tế trên thế giới. Hơn thế, người đọc còn học được từ trong cuốn sách này những bài học về lãnh đạo trong những tình huống khó khăn, về các lựa chọn mà những nhà làm chính sách phải đưa ra trong bối cảnh thông tin không đầy đủ.', 1, '30', '1736334887_ChinhSachTienTeTheKy21.png', '2025-01-07 17:00:00', '2025-01-07 17:00:00', 'chinh-sach-tien-te-the-ky-21'),
(8, 'Thám Tử Lừng Danh Conan - Tập 105', 32, 10000.00, 30000.00, 5000, 2020, 'Thám Tử Lừng Danh Conan - Tập 105\r\n\r\nOoka Momiji bị đe doạ đến tính mạng trên tàu shinkansen. Liệu quản gia Iori Muga và mọi người có thể giải cứu cô an toàn!?\r\n\r\nRan dẫn Heiji và các bạn tới một thắng cảnh tuyệt đẹp… Nhưng khi ở trên núi, họ tình cờ gặp một vụ án mạng kì bí! Kaito Kid và Conan sẽ bắt tay hợp tác!? Đối thủ của họ là… Hakuba Saguru!!', 1, '30', '1736334904_ThamTuLungDanhConan105.png', '2025-01-07 17:00:00', '2025-01-07 17:00:00', 'tham-tu-lung-danh-conan-tap-105'),
(9, 'Danh Nhân Thế Giới - Marie Curie', 27, 8000.00, 30000.00, 5000, 2022, 'Marie Curie là nhà khoa học nữ đầu tiên được nhận hai giải Nobel. Bà đã dành trọn cuộc đời để nghiên cứu khoa học, và cống hiến trọn vẹn những thành tựu to lớn cho nhân loại. Từ nhỏ, Marie Curie là một cô bé thông minh, ham học và rất yêu thích khoa học tự nhiên. Nhưng vì gia đình quá nghèo nên bà phải lao động để kiếm sống. Sau bao nhiêu vất vả gian nan cuối cùng bà đã thực hiện được mơ ước: Bước chân vào giảng đường đại học. Nhờ tài năng, trí thông minh và sự cần cù, Marie Curie đã lần lượt nhận được bằng cử nhân về Vật lí và Toán học.\r\n\r\nBà đã cùng chồng là Pierre Curie nghiên cứu và phát hiện ra nguyên tố mang tính phóng xạ radium và được trao giải Nobel Vật lí. Sau khi ông Pierre qua đời, bà vẫn tiếp tục nghiên cứu, và một lần nữa bà lại được nhận giải thưởng Nobel Hóa học.\r\n\r\nSuốt cuộc đời, cho đến khi trút hơi thở cuối cùng vào năm 1934, bà đã không ngừng nghiên cứu, đóng góp công sức cho khoa học và cho hạnh phúc nhân loại. Cuộc đời của Marie Curie là một tấm gương sáng ngời về nhân cách của một nhà khoa học luôn dành tình yêu cho đất nước, cho khoa học chân chính.', 1, '30', '1736334897_NhanDanhTheGioiMarieCurie.png', '2025-01-07 17:00:00', '2025-01-07 17:00:00', 'danh-nhan-the-gioi-marie-curie-tai-ban-2022'),
(10, 'Cỏ Hoa Tự Tại', 27, 20000.00, 30000.00, 100, 2024, 'Vui vẻ là chính mình,\n\nMỗi ngày bình thường\n\nĐều không tầm thường.\n\nNhững bài thơ trong “Cỏ hoa tự tại” được tác giả Thanh Thảo chắt lọc từ những quan sát tinh tế về cuộc sống xung quanh, hòa quyện cùng nét vẽ màu nước sống động và mơ màng của họa sĩ Huyền Anh (Hajazana), khiến những điều bình dị được tôn lên đầy ấn tượng và giàu cảm xúc, tựa như những lát cắt cuộc sống muôn màu muôn vẻ mà đôi khi ta thường bỏ quên.', 1, '30', 'co-hoa-tu-tai.jpg', '2025-01-16 14:32:47', '2025-01-16 14:32:47', 'co-hoa-tu-tai'),
(11, 'Nhật kí cha và con', 27, 30000.00, 40000.00, 100, 2023, 'Những cảm xúc đời thường trước những gợn sóng tâm tư khiến tâm hồn xao động…\r\n\r\nCha và con như hai người bạn, khi ở xa, lúc gần gũi, luôn luôn song hành và tràn đầy yêu thương…\r\n\r\nTôi không được ở cùng con hằng ngày. Nhưng mỗi khi nhớ đến con, nghĩ đến cô con gái xinh xắn, bé bỏng của mình, đôi lúc tôi hình dung con như giọt mật ong, trong như hổ phách, lấp lánh, ngọt ngào, và dính chặt lấy trái tim tôi. Giọt mật ong bé tí xíu nhưng đủ sức làm dịu đi mọi nỗi mệt nhọc, buồn phiền hay thổi bùng lên những niềm vui, hạnh phúc.\r\n\r\nSự xuất hiện của Bamby khiến tôi hình dung cuộc đời mình chia làm hai nửa: Mông lung > < Sắc nét, Bất định > < Rõ ràng, Trước con > < Sau con.', 1, '30', 'nhat-ki-cha-va-con.jpg', '2025-01-17 12:45:54', '2025-01-17 12:45:57', 'nhat-ki-cha-va-con'),
(12, 'Cây cam ngọt của tôi', 27, 20000.00, 40000.00, 100, 2020, '“Vị chua chát của cái nghèo hòa trộn với vị ngọt ngào khi khám phá ra những điều khiến cuộc đời này đáng sống... một tác phẩm kinh điển của Brazil.” - Booklist\n\n“Một cách nhìn cuộc sống gần như hoàn chỉnh từ con mắt trẻ thơ… có sức mạnh sưởi ấm và làm tan nát cõi lòng, dù người đọc ở lứa tuổi nào.” - The National\n\nHãy làm quen với Zezé, cậu bé tinh nghịch siêu hạng đồng thời cũng đáng yêu bậc nhất, với ước mơ lớn lên trở thành nhà thơ cổ thắt nơ bướm. Chẳng phải ai cũng công nhận khoản “đáng yêu” kia đâu nhé. Bởi vì, ở cái xóm ngoại ô nghèo ấy, nỗi khắc khổ bủa vây đã che mờ mắt người ta trước trái tim thiện lương cùng trí tưởng tượng tuyệt vời của cậu bé con năm tuổi.\n\nCó hề gì đâu bao nhiêu là hắt hủi, đánh mắng, vì Zezé đã có một người bạn đặc biệt để trút nỗi lòng: cây cam ngọt nơi vườn sau. Và cả một người bạn nữa, bằng xương bằng thịt, một ngày kia xuất hiện, cho cậu bé nhạy cảm khôn sớm biết thế nào là trìu mến, thế nào là nỗi đau, và mãi mãi thay đổi cuộc đời cậu.\n\nMở đầu bằng những thanh âm trong sáng và kết thúc lắng lại trong những nốt trầm hoài niệm, Cây cam ngọt của tôi khiến ta nhận ra vẻ đẹp thực sự của cuộc sống đến từ những điều giản dị như bông hoa trắng của cái cây sau nhà, và rằng cuộc đời thật khốn khổ nếu thiếu đi lòng yêu thương và niềm trắc ẩn. Cuốn sách kinh điển này bởi thế không ngừng khiến trái tim người đọc khắp thế giới thổn thức, kể từ khi ra mắt lần đầu năm 1968 tại Brazil.', 1, '30', 'cay_cam_ngot_cua_toi.jpg', '2025-01-17 12:45:58', '2025-01-17 12:46:04', 'cay_cam_ngot_cua_toi'),
(13, 'Lén nhặt chuyện đời', 27, 50000.00, 70000.00, 1000, 2022, 'Tại vùng ngoại ô xứ Đan Mạch xưa, người thợ kim hoàn Per Enevoldsen đã cho ra mắt một món đồ trang sức lấy ý tưởng từ Pandora - người phụ nữ đầu tiên của nhân loại mang vẻ đẹp như một ngọc nữ phù dung, kiêu sa và bí ẩn trong Thần thoại Hy Lạp. Vòng Pandora được kết hợp từ một sợi dây bằng vàng, bạc hoặc bằng da cùng với những viên charm được chế tác đa dạng, tỉ mỉ. Ý tưởng của ông, mỗi viên charm như một câu chuyện, một kỷ niệm đáng nhớ của người sở hữu chiếc vòng. Khi một viên charm được thêm vào sợi Pandora là cuộc đời lại có thêm một ký ức cần lưu lại để nhớ, để thương, để trân trọng. Lén nhặt chuyện đời ra mắt trong khoảng thời gian chông chênh nhất của bản thân, hay nói cách khác là một cậu bé mới lớn, vừa bước ra khỏi cái vỏ bọc vốn an toàn của mình. Những câu chuyện trong Lén nhặt chuyện đời là những câu chuyện tôi được nghe kể lại, hoặc vô tình bắt gặp, hoặc nhặt nhạnh ở đâu đó trong miền ký ức rời rạc của quá khứ, không theo một trình tự hay một thời gian nào nhất định.\n\nMỗi một câu chuyện là một viên charm lấp lánh, kiêu kỳ, có sức hút mạnh mẽ đối với một người trẻ như tôi luôn tò mò với những điều dung dị trong cuộc sống. Tôi âm thầm nhặt những viên charm ấy về, kết thành sợi Pandora cho chính mình. Lén ở đây không phải là một cái gì đó vụng trộm, âm thầm sợ người khác phát hiện. Mà nó là lặng lẽ. Tôi lặng lẽ nghe, lặng lẽ quan sát, lặng lẽ đi tìm và lặng lẽ viết nên quyển sách này. Tôi vẫn thích dùng từ Lén hơn, vì đơn giản, tôi thấy bản thân mình trong đó. Lén nhặt chuyện đời được chia thành năm chương: chương thứ nhất nói về tình yêu của cả giới trẻ và người tu sĩ; chương thứ hai viết về gia đình; chương thứ ba dành cho những người trẻ; chương thứ tư là những câu chuyện bên đời, những bài tâm sự của người tu sĩ; chương năm là thơ và chương cuối cùng là tâm sự của bản thân khi tôi đã về già. Nếu ai nghĩ Lén nhặt chuyện đời sẽ giảng thuyết về chân lý, định hướng cho người trẻ hay chữa lành những vết thương… thì đã tìm sai chỗ, bản thân chưa bao giờ nghĩ quyển sách này sẽ làm được điều đó.', 1, '45', 'len_nhat_chuyen_doi.jpg', '2025-01-17 12:46:00', '2025-01-17 12:46:03', 'len-nhat-chuyen-doi'),
(14, 'Nếu biết trăm năm là hữu hạn', 27, 40000.00, 60000.00, 6, 2021, 'Nếu Biết Trăm Năm Là Hữu Hạn ngay từ tên gọi đã rất gợi mở và đầy ẩn ý. Với những cảm xúc sâu lắng, bao gồm những bài viết ngắn, đầy chất thơ, chiêm nghiệm về mọi vấn đề của cuộc sống hôm nay, với những buồn vui như hạt mưa trong tưới mát tâm hồn, cuốn sách đã chạm được đến những mẫu số chung của mỗi người khi trình bày những thứ tình cảm thân thương từ tình cảm gia đình cho đến tình yêu, tình bạn…\n\nKhông phải ngẫu nhiên mà tác phẩm này nhận được nhiều sự yêu mến đến vậy, khi tái bản lên tới con số 30 lần. Những trang viết của Nếu Biết Trăm Năm Là Hữu Hạn suốt bao nhiêu năm qua vẫn như người bạn tâm tình cùng bao thế hệ bạn đọc, xứng đáng trở thành một trong những cuốn sách được yêu thích nhất ở Việt Nam.\n\n“Đọc nó, ta như tìm được lời giải đáp cho những suy tư của chính mình. Đọc nó, ta như tìm lại được chốn bình yên trong tâm hồn mình. Để rồi ta nhìn cuộc đời bao dung hơn, nhìn con người vị tha hơn, và bản thân ta cũng dũng cảm hơn trong cuộc sống. Khi đó, ta chính là ta, và sống một cuộc đời chân thực nhất.” – Cao Hạnh Quyên\n\n“Đây là cuốn sách giúp mình tiết kiệm đến nửa cuộc đời.” – Nguyễn Khánh\n\n“Đây xứng đáng là một quyển sách có ở mỗi gia đình, để khi người ta cảm thấy mất phương hướng có thể tìm lại ở đó, phát hiện ra chút hy vọng của hạnh phúc trong cuộc đời mình.” – Đặng Ngọc Tú', 1, '30', 'neu_biet_tram_nam_la_huu_han.jpg', '2025-01-17 12:46:01', '2025-01-17 12:46:02', 'neu-biet-tram-nam-la-huu-han'),
(15, 'Hai Mặt Của Gia Đình', 27, 55000.00, 75000.00, 12, 2020, 'Cuốn sách nói về những góc khuất và sự thật đằng sau một gia đình hiện đại.', 1, '30', 'hai_mat_cua_gia_dinh.jpg', '2025-01-16 22:05:28', '2025-01-16 22:05:28', 'hai-mat-cua-gia-dinh'),
(16, 'Ghi Chép Pháp Y', 27, 60000.00, 85000.00, 1000, 2021, 'Những câu chuyện chân thực về ngành pháp y và những vụ án nổi tiếng.', 1, '30', 'ghi_chep_phap_y.jpg', '2025-01-16 22:05:28', '2025-01-16 22:05:28', 'ghi-chep-phap-y'),
(17, 'Sự Im Lặng Của Bầy Cừu', 35, 70000.00, 95000.00, 8, 2019, 'Tiểu thuyết trinh thám kinh điển về những vụ án rùng rợn.', 1, '30', 'su_im_lang_cua_bay_cuu.jpg', '2025-01-16 22:05:28', '2025-01-16 22:05:28', 'su-im-lang-cua-bay-cuu'),
(18, 'Sói Già Phố Wall - Phần 3', 27, 75000.00, 100000.00, 7, 2022, 'Cuộc đời đầy sóng gió của một doanh nhân phố Wall.', 1, '30', 'soi_gia_pho_wall_3.jpg', '2025-01-16 22:05:28', '2025-01-16 22:05:28', 'soi-gia-pho-wall-3'),
(19, 'Sói Già Phố Wall - Phần 2', 27, 72000.00, 98000.00, 9, 2021, 'Phần tiếp theo trong chuỗi câu chuyện về doanh nhân phố Wall.', 1, '30', 'soi_gia_pho_wall_2.jpg', '2025-01-16 22:05:28', '2025-01-16 22:05:28', 'soi-gia-pho-wall-2'),
(20, 'Vị Giám Đốc Một Phút', 37, 50000.00, 75000.00, 11, 2023, 'Cuốn sách kinh điển về quản lý thời gian và lãnh đạo hiệu quả.', 1, '30', 'vi_giam_doc_mot_phut.jpg', '2025-01-16 22:05:28', '2025-01-16 22:05:28', 'vi-giam-doc-mot-phut'),
(21, 'Tiếp Thị Tốt Hơn 6', 30, 60000.00, 85000.00, 12, 2020, 'Những chiến lược tiếp thị hiện đại được tóm gọn trong cuốn sách này.', 1, '30', 'tiep_thi_6.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'tiep-thi-tot-hon-6'),
(22, 'Tiếp Thị Tốt Hơn 5', 31, 55000.00, 80000.00, 8, 2019, 'Tóm lược về các kỹ năng tiếp thị cho thời đại số.', 1, '44', 'tiep_thi_5.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'tiep-thi-tot-hon-5'),
(23, 'Chip War', 27, 45000.00, 65000.00, 9, 2022, 'Cuộc chiến chip bán dẫn và tương lai công nghệ.', 1, '30', 'chip_war.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'chip-war'),
(24, 'Bố Già Châu Á', 27, 70000.00, 100000.00, 15, 2018, 'Tiểu thuyết về cuộc đời của một bố già huyền thoại tại châu Á.', 1, '30', 'bo_gia_chau_a.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'bo-gia-chau-a'),
(25, 'Tuổi Thơ Dữ Dội', 29, 65000.00, 90000.00, 11, 2000, 'Một câu chuyện cảm động về tuổi thơ đầy sóng gió.', 1, '30', 'tuoi_tho_du_doi.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'tuoi-tho-du-doi'),
(26, 'Tuổi Thơ Dữ Dội 2', 29, 60000.00, 85000.00, 10, 2005, 'Phần tiếp theo của hành trình đầy cảm xúc.', 1, '30', 'tuoi_tho_du_doi_2.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'tuoi-tho-du-doi-2'),
(27, 'Thơ Bảy Màu', 32, 45000.00, 65000.00, 14, 2010, 'Tập thơ tràn đầy màu sắc và cảm xúc.', 1, '30', 'tho_bay_mau.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'tho-bay-mau'),
(28, 'Hồ Sơ Chinh Khách 23', 27, 80000.00, 110000.00, 20, 2023, 'Cuộc đời và sự nghiệp của các chinh khách nổi tiếng.', 1, '30', 'hsck_23.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'ho-so-chinh-khach-23'),
(29, '100 Kỹ Năng Sinh Tồn', 27, 50000.00, 75000.00, 13, 2020, 'Những kỹ năng sinh tồn cơ bản và nâng cao.', 1, '30', '100_ky_nang_sinh_ton.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', '100-ky-nang-sinh-ton'),
(30, 'Doanh Nhân Thế Giới', 27, 55000.00, 80000.00, 9, 2019, 'Tiểu sử các doanh nhân nổi tiếng toàn cầu.', 1, '30', 'doanh_nhan_the_gioi.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'doanh-nhan-the-gioi'),
(31, 'Thiền Sư Và Bé Năm Tuổi', 34, 60000.00, 90000.00, 16, 2022, 'Một câu chuyện đầy ý nghĩa về cuộc đời và thiền.', 1, '30', 'thien_su_va_e_be_5_tuoi.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'thien-su-va-be-nam-tuoi'),
(32, 'Đừng Là Tết', 27, 50000.00, 75000.00, 10, 2021, 'Tuyển tập truyện ngắn về chủ đề Tết Việt.', 1, '30', 'dung_la_tet.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'dung-la-tet'),
(33, 'Hiểu Về Trái Tim', 27, 45000.00, 65000.00, 12, 2018, 'Cuốn sách tâm lý giúp bạn hiểu rõ hơn về cảm xúc.', 1, '30', 'hieu_ve_trai_tim.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'hieu-ve-trai-tim'),
(34, 'Saiyuki', 27, 60000.00, 90000.00, 8, 2020, 'Câu chuyện phiêu lưu kinh điển của Nhật Bản.', 1, '30', 'saiyuki.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'saiyuki'),
(35, 'Flow', 27, 70000.00, 100000.00, 7, 2023, 'Khám phá dòng chảy của sự sáng tạo và hiệu quả.', 1, '30', 'flow.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'flow'),
(36, 'Câu Lạc Bộ Những Kẻ Mất Ngủ', 27, 50000.00, 75000.00, 10, 2021, 'Câu lạc bộ đặc biệt dành cho những người không ngủ.', 1, '30', 'clb_nhung_ke_mat_ngu.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'clb-nhung-ke-mat-ngu'),
(37, 'Blue Lock', 27, 55000.00, 85000.00, 12, 2022, 'Truyện tranh thể thao hấp dẫn về bóng đá.', 1, '30', 'bluelock.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'blue-lock'),
(38, 'Claymore 3', 27, 45000.00, 65000.00, 15, 2018, 'Phần 3 của bộ truyện hành động nổi tiếng.', 1, '30', 'claymore_3.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'claymore-3'),
(39, 'Tính Cách Bạn Màu Gì?', 28, 60000.00, 90000.00, 8, 2020, 'Phân tích tính cách qua màu sắc yêu thích.', 1, '30', 'tinh_cach_ban_mau_gi.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'tinh-cach-ban-mau-gi'),
(40, 'Gỡ Mụn', 27, 50000.00, 75000.00, 20, 2017, 'Hướng dẫn chăm sóc da và trị mụn hiệu quả.', 1, '30', 'go_mun.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'go-mun'),
(41, 'Tuyển Tập Sherlock Holmes', 27, 65000.00, 95000.00, 18, 2022, 'Tập hợp các câu chuyện trinh thám kinh điển của Sherlock Holmes.', 1, '30', 'tuyen_tap_sherlock.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'tuyen-tap-sherlock-holmes'),
(42, 'Ăn Chay Tốt Cho Sức Khỏe', 27, 55000.00, 80000.00, 15, 2021, 'Những lợi ích và thực đơn ăn chay hàng ngày.', 1, '30', 'an_chay_tot_cho_sk.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'an-chay-tot-cho-sk'),
(43, 'Thiên Thần Nổi Giận', 33, 70000.00, 100000.00, 12, 2019, 'Câu chuyện kỳ bí về thiên thần và nhân loại.', 1, '30', 'thien_than_noi_gian.jpg', '2025-01-16 22:03:02', '2025-01-16 22:03:02', 'thien-than-noi-gian');

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
('ycqWgXZ1SUrF7H0u888UPhqh2cWqyVV6ymiEqGqV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 OPR/119.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVUxnZDEzUGVmUTZzbTdrTlhuTlp5bkF2YURzS21Rb1dXQTdSSTZBTyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zcC9kYW5oLW5oYW4tdGhlLWdpb2ktbWFyaWUtY3VyaWUtdGFpLWJhbi0yMDIyIjt9fQ==', 1749597255);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `baiviet`
--
ALTER TABLE `baiviet`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `baiviet` ADD FULLTEXT KEY `tieude` (`tieude`,`noidung`,`chude`);

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
-- Chỉ mục cho bảng `danhsachyeuthich`
--
ALTER TABLE `danhsachyeuthich`
  ADD KEY `MaKH` (`MaKH`),
  ADD KEY `MaSP` (`MaSP`);

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
-- Chỉ mục cho bảng `phuongthucthanhtoan`
--
ALTER TABLE `phuongthucthanhtoan`
  ADD PRIMARY KEY (`MaPhuongThuc`);

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
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `baiviet`
--
ALTER TABLE `baiviet`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  MODIFY `MaChiTietHoaDon` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

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
  MODIFY `MaSach` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- Các ràng buộc cho các bảng đã đổ
--

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
-- Các ràng buộc cho bảng `danhsachyeuthich`
--
ALTER TABLE `danhsachyeuthich`
  ADD CONSTRAINT `danhsachyeuthich_ibfk_1` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`MaKhachHang`),
  ADD CONSTRAINT `danhsachyeuthich_ibfk_2` FOREIGN KEY (`MaSP`) REFERENCES `sach` (`MaSach`);

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`MaKhachHang`) REFERENCES `khachhang` (`MaKhachHang`);

--
-- Các ràng buộc cho bảng `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `sach_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `danhmuc` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
