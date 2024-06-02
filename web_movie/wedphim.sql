-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 20, 2023 lúc 10:15 AM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `wedphim`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`id`, `title`, `description`, `slug`, `status`, `position`) VALUES
(12, 'Phim Bộ', 'phim-bo', 'phim-bo', 1, 1),
(13, 'Phim Lẻ', 'phim-le', 'phim-le', 1, 2),
(14, 'Phim Chiếu Rạp', 'Phim Chiếu Rạp', 'phim-chieu-rap', 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_muc_phim`
--

CREATE TABLE `danh_muc_phim` (
  `id` int(11) NOT NULL,
  `phim_id` int(11) NOT NULL,
  `danh_muc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `danh_muc_phim`
--

INSERT INTO `danh_muc_phim` (`id`, `phim_id`, `danh_muc_id`) VALUES
(1, 25, 12),
(2, 25, 13),
(5, 27, 12),
(6, 27, 13),
(7, 28, 14),
(9, 26, 14),
(10, 28, 12),
(11, 28, 14),
(12, 26, 13);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `info_web`
--

CREATE TABLE `info_web` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `mota` text NOT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `info_web`
--

INSERT INTO `info_web` (`id`, `title`, `mota`, `logo`) VALUES
(7, 'Home', '- Phim HNP Nơi Các Bạn Có Thể Tìm Kiếm Những Thức Phim Hay Mới Nhất', '1640099744378949.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_09_22_025045_create_chitiet', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phim`
--

CREATE TABLE `phim` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `trailer` text DEFAULT NULL,
  `time_phim` varchar(100) NOT NULL,
  `hot` int(11) NOT NULL,
  `phim_le` int(11) DEFAULT NULL,
  `tap_phim` bigint(20) DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `vietsub` int(11) NOT NULL,
  `resolution` int(11) NOT NULL,
  `description` text NOT NULL,
  `name_e` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `danh_muc_id` int(11) NOT NULL,
  `quoc_gia_id` int(11) NOT NULL,
  `ngaytao` date DEFAULT NULL,
  `ngaycapnhat` date DEFAULT NULL,
  `image` text DEFAULT NULL,
  `the_loai_id` int(11) NOT NULL,
  `topview` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `phim`
--

INSERT INTO `phim` (`id`, `title`, `slug`, `trailer`, `time_phim`, `hot`, `phim_le`, `tap_phim`, `tags`, `vietsub`, `resolution`, `description`, `name_e`, `status`, `danh_muc_id`, `quoc_gia_id`, `ngaytao`, `ngaycapnhat`, `image`, `the_loai_id`, `topview`, `year`, `views`, `position`) VALUES
(25, 'Vua Hải Tặc', 'vua-hai-tac', '89aYxQcGGA4', '24 Phút', 1, 0, 1075, 'ádasdadd', 1, 1, 'ádasdsadad', 'One Piece', 1, 1, 7, '2023-10-18', '2023-10-18', '81yXBIxF-0L612.jpg', 5, NULL, NULL, 831, 1),
(26, 'Vua Hải Tặc phần 2', 'vua-hai-tac-phan-2', '89aYxQcGGA4', '24 Phút', 1, 0, 1075, 'ádasdad', 1, 1, 'ádasdad', 'One Piece 2', 1, 1, 7, '2023-10-18', '2023-10-20', 'guardians-of-the-galaxy-vol-three289.jpg', 8, NULL, NULL, 298, 2),
(27, 'haaaaa', 'haaaaa', 'AeaD3Q-bFjU&t', '20 phút', 1, 1, 1, 'ádasdasd', 1, 1, 'âsdasdas', 'Day 2', 1, 1, 7, '2023-10-20', '2023-10-20', '46b0014b8bdaec1a96584e77d442f632890.jpg', 3, NULL, NULL, 840, 3),
(28, 'phimmmmm', 'phimmmmm', 'aWzlQ2N6qqg', '150 Phút', 0, 0, 1075, 'aaaaaaaaaaaaa', 1, 1, 'aaaaaaaaaaa', 'aaaaaaa', 1, 1, 7, '2023-10-20', '2023-10-20', 'guardians-of-the-galaxy-vol-three92.jpg', 8, NULL, NULL, 195, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quocgia`
--

CREATE TABLE `quocgia` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `quocgia`
--

INSERT INTO `quocgia` (`id`, `title`, `description`, `status`, `slug`) VALUES
(7, 'Việt Nam', 'viet-nam', 1, 'viet-nam'),
(8, 'Trung Quốc', 'trung-quoc', 1, 'trung-quoc'),
(9, 'Nhật Bản', 'nhat-ban', 1, 'nhat-ban'),
(10, 'Hàn Quốc', 'han-quoc', 1, 'han-quoc'),
(11, 'Thái Lan', 'thai-lan', 1, 'thai-lan'),
(12, 'Âu-Mỹ', 'au-my', 1, 'au-my'),
(13, 'HongKong', 'hongkong', 1, 'hongkong');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tap_phim`
--

CREATE TABLE `tap_phim` (
  `id` int(11) NOT NULL,
  `phim_id` int(11) NOT NULL,
  `link` text NOT NULL,
  `sotap` int(11) NOT NULL,
  `ngaytao` date DEFAULT NULL,
  `ngaycapnhat` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tap_phim`
--

INSERT INTO `tap_phim` (`id`, `phim_id`, `link`, `sotap`, `ngaytao`, `ngaycapnhat`) VALUES
(16, 22, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/AeaD3Q-bFjU\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, '2023-10-16', '2023-10-16'),
(17, 25, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/AeaD3Q-bFjU\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, '2023-10-18', '2023-10-18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `theloai`
--

CREATE TABLE `theloai` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `theloai`
--

INSERT INTO `theloai` (`id`, `title`, `description`, `slug`, `status`) VALUES
(3, 'Phim Chiêu Rạp', 'phim-chieu-rap', 'phim-chieu-rap', 1),
(4, 'Phim Tình Cảm', 'phim-tinh-cam', 'phim-tinh-cam', 1),
(5, 'Phim Cổ Trang', 'phim-co-trang', 'phim-co-trang', 1),
(6, 'Phim Tâm Lý', 'phim-tam-ly', 'phim-tam-ly', 1),
(8, 'Phim Võ Thuật', 'phim-vo-thuat', 'phim-vo-thuat', 1),
(9, 'Phim Kinh Dị', 'phim-kinh-di', 'phim-kinh-di', 1),
(10, 'Phim Phiêu Lưu', 'phim-phieu-luu', 'phim-phieu-luu', 1),
(13, 'Phim Thần Thoại', 'phim-than-thoai', 'phim-than-thoai', 1),
(14, 'Phim Viễn Tưởng', 'phim-vien-tuong', 'phim-vien-tuong', 1),
(15, 'Phim Hài', 'phim-hai', 'phim-hai', 1),
(16, 'Phim Hành Động', 'phim-hanh-dong', 'phim-hanh-dong', 1),
(17, 'Phim Hình Sự', 'phim-hinh-su', 'phim-hinh-su', 1),
(18, 'Phim TV Show', 'phim-tv-show', 'phim-tv-show', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `the_loai_phim`
--

CREATE TABLE `the_loai_phim` (
  `id` int(11) NOT NULL,
  `phim_id` int(11) NOT NULL,
  `the_loai_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `the_loai_phim`
--

INSERT INTO `the_loai_phim` (`id`, `phim_id`, `the_loai_id`) VALUES
(55, 22, 3),
(56, 22, 4),
(57, 22, 5),
(58, 22, 6),
(70, 25, 3),
(71, 25, 4),
(72, 25, 5),
(73, 26, 4),
(74, 26, 5),
(75, 26, 8),
(76, 27, 3),
(77, 28, 3),
(78, 28, 4),
(79, 28, 5),
(80, 28, 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Kieu Anh Phat', 'kieuphat122@gmail.com', NULL, '$2y$10$iaHEPvx9NRYGziTyP.IBtuMkVtKymu1VyA2kVM67NtXiNi5ka3E46', 'IkMxTnMzzQyFMtuVhqCQzcQak9nxIHxgKbt2nqLBSt6cGfUpP7IScFqO8aB0', '2023-09-22 10:59:09', '2023-09-22 10:59:09');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `danh_muc_phim`
--
ALTER TABLE `danh_muc_phim`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `info_web`
--
ALTER TABLE `info_web`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `phim`
--
ALTER TABLE `phim`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `quocgia`
--
ALTER TABLE `quocgia`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tap_phim`
--
ALTER TABLE `tap_phim`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `the_loai_phim`
--
ALTER TABLE `the_loai_phim`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `danh_muc_phim`
--
ALTER TABLE `danh_muc_phim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `info_web`
--
ALTER TABLE `info_web`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `phim`
--
ALTER TABLE `phim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `quocgia`
--
ALTER TABLE `quocgia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `tap_phim`
--
ALTER TABLE `tap_phim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `theloai`
--
ALTER TABLE `theloai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `the_loai_phim`
--
ALTER TABLE `the_loai_phim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
