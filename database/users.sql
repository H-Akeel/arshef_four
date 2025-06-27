-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3305
-- Generation Time: 27 يونيو 2025 الساعة 13:51
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- بنية الجدول `user_name`
--

CREATE TABLE `user_name` (
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'مستخدم'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `user_name`
--

INSERT INTO `user_name` (`username`, `password`, `role`) VALUES
('1', '$2y$10$epsCf.9.1YYGyYE8KACL4O4JmbckInvpYM8dvGlUtGneMgmW/YYj.', 'admin'),
('_h47k', '$2y$10$iREGTgmbPs4wRINZknX6GuSNts6VNqjdHS5lDMiPAo6Co/gAG8DKu', 'admin'),
('e1', '$2y$10$gfelnerykhUe/QPPqxHOPOyvSqCu39NWKQBgHkCJSz0uCBeOpg31q', 'sport_emp'),
('e2', '$2y$10$bEhpmWmHbjh0oucj/YTY3ulMPemegETU23EuXWNf1lggEh3IX5rGq', 'star_emp'),
('e3', '$2y$10$pRL3dUtTH9Va6bZknOnRJ.GdMqxZKv7coVRZ1pCcbC6oKMi6W37hy', 'admin'),
('e33', '$2y$10$ztntceAswhGaLBouZPCk8ux.VX67jWqekv9PnMQfNJbjIOn1fIKzm', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
