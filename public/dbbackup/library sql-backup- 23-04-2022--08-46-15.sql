-- Database: `library` --
-- Table `book_member` --
CREATE TABLE `book_member` (
  `book_id` int(10) unsigned NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`book_id`,`member_id`),
  KEY `book_member_book_id_index` (`book_id`),
  KEY `book_member_member_id_index` (`member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table `books` --
CREATE TABLE `books` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edition` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publisher` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pages` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accessionno` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `classificationno` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bookno` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(10) unsigned NOT NULL DEFAULT '1',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0',
  `issuer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `books_member_id_foreign` (`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `books` (`id`, `title`, `author`, `edition`, `year`, `publisher`, `pages`, `accessionno`, `classificationno`, `subject`, `bookno`, `description`, `price`, `location`, `qty`, `member_id`, `issuer`, `created_at`, `updated_at`) VALUES
(1, 'Aizawlah Aizawler', 'Lalhruaitluanga Chawngte', '1st', '2018', 'The Mizo Hills', '270', '34', 'MZ-08', 'Mizo', '23', 'Donated by Lalrinthanga', '250', '77A', 0, 3, 'Admin', '2021-06-19 08:58:21', '2021-06-19 08:58:21'),
(2, 'Aizawlah Aizawler', 'Lalhruaitluanga Chawngte', '1st', '2018', 'The Mizo Hills', '270', '35', 'MZ-08', 'Mizo', '23', 'Donated by Lalrinthanga', '250', '77A', 0, 1, 'Admin', '2021-06-19 08:58:21', '2021-06-19 08:58:21'),
(11, 'Robinson Cruisoe', 'Robert T Peters', '2nd', '1878', 'Mulburry', '270', '577', 'Eng', 'Novel', '789', 'Library', '400', 'NG37', 1, 0, '', '2021-11-14 07:11:55', '2021-11-14 07:11:55'),
(4, 'Aizawlah Aizawler', 'Lalhruaitluanga Chawngte', '1st', '2018', 'The Mizo Hills', '270', '37', 'MZ-08', 'Mizo', '23', 'Donated by Lalrinthanga', '250', '77A', 0, 3, 'Admin', '2021-06-19 08:58:21', '2021-06-19 08:58:21'),
(6, 'Nunna tuikhur', 'Rev. Vanlalzuata', '1st', '2017', 'Ramthar Veng KTP', '185', '234', 'MZ-14', 'Mizo', '56', 'Ramthar Veng KTP', '150', 'MS/47', 1, 0, '', '2021-08-01 11:31:25', '2021-08-01 11:32:28'),
(7, 'Nunna tuikhur', 'Rev. Vanlalzuata', '1st', '2017', 'Ramthar Veng KTP', '185', '235', 'MZ-14', 'Mizo', '56', 'Ramthar Veng KTP', '150', 'MS/47', 0, 3, 'Lalchawimawia', '2021-08-01 11:31:25', '2021-08-01 11:32:38'),
(8, 'Nunna tuikhur', 'Rev. Vanlalzuata', '1st', '2017', 'Ramthar Veng KTP', '185', '236', 'MZ-14', 'Mizo', '56', 'Ramthar Veng KTP', '150', 'MS/47', 1, 0, '', '2021-08-01 11:31:25', '2021-08-01 11:32:47'),
(9, 'Nunna tuikhur', 'Rev. Vanlalzuata', '1st', '2017', 'Ramthar Veng KTP', '185', '237', 'MZ-14', 'Mizo', '56', 'Ramthar Veng KTP', '150', 'MS/47', 1, 0, '', '2021-08-01 11:31:25', '2021-08-01 11:32:55'),
(10, 'Nunna tuikhur', 'Upa Chuaungoa', '1st', '2010', 'Ramhlun KTP', '125', '99', 'MZ-14', 'Mizo', '89', 'Donated By KTP', '120', 'MS/47', 1, 0, '', '2021-08-02 07:36:20', '2021-08-07 06:29:50'),
(16, 'The witch and the dragon slayer', 'Richard Worm Wood', '1st', '1994', 'Oak Hill McGrow', '185', '768', 'Eng-01', 'Story', '926', 'State Library', '120', 'C-77', 0, 8, 'Lalchawimawia', '2021-11-20 06:02:35', '2021-11-20 06:02:35'),
(13, 'Robinson Cruisoe', 'Robert T Peters', '2nd', '1878', 'Mulburry', '270', '579', 'Eng', 'Novel', '789', 'Library', '400', 'NG37', 1, 0, '', '2021-11-14 07:11:55', '2021-11-14 07:11:55'),
(14, 'Robinson Cruisoe', 'Robert T Peters', '2nd', '1878', 'Mulburry', '270', '580', 'Eng', 'Novel', '789', 'Library', '400', 'NG37', 1, 0, '', '2021-11-14 07:11:55', '2021-11-14 07:11:55'),
(15, 'Robinson Cruisoe', 'Robert T Peters', '2nd', '1878', 'Mulburry', '270', '581', 'Eng', 'Novel', '789', 'Library', '400', 'NG37', 1, 0, '', '2021-11-14 07:11:55', '2021-11-14 07:11:55'),
(17, 'The witch and the dragon slayer', 'Richard Worm Wood', '1st', '1994', 'Oak Hill McGrow', '185', '769', 'Eng-01', 'Story', '926', 'State Library', '120', 'C-77', 1, 0, '', '2021-11-20 06:02:35', '2021-11-20 06:02:35'),
(18, 'The witch and the dragon slayer', 'Richard Worm Wood', '1st', '1994', 'Oak Hill McGrow', '185', '770', 'Eng-01', 'Story', '926', 'State Library', '120', 'C-77', 1, 0, '', '2021-11-20 06:02:35', '2021-11-20 06:02:35'),
(19, 'The witch and the dragon slayer', 'Richard Worm Wood', '1st', '1994', 'Oak Hill McGrow', '185', '771', 'Eng-01', 'Story', '926', 'State Library', '120', 'C-77', 1, 0, '', '2021-11-20 06:02:35', '2021-11-20 06:02:35'),
(20, 'The witch and the dragon slayer', 'Richard Worm Wood', '1st', '1994', 'Oak Hill McGrow', '185', '772', 'Eng-01', 'Story', '926', 'State Library', '120', 'C-77', 1, 0, '', '2021-11-20 06:02:35', '2021-11-20 06:02:35'),
(21, 'The witch and the dragon slayer', 'Richard Worm Wood', '1st', '1994', 'Oak Hill McGrow', '185', '773', 'Eng-01', 'Story', '926', 'State Library', '120', 'C-77', 1, 0, '', '2021-11-20 06:02:35', '2021-11-20 06:02:35'),
(22, 'The witch and the dragon slayer', 'Richard Worm Wood', '1st', '1994', 'Oak Hill McGrow', '185', '774', 'Eng-01', 'Story', '926', 'State Library', '120', 'C-77', 1, 0, '', '2021-11-20 06:02:35', '2021-11-20 06:02:35'),
(23, 'The witch and the dragon slayer', 'Richard Worm Wood', '1st', '1994', 'Oak Hill McGrow', '185', '775', 'Eng-01', 'Story', '926', 'State Library', '120', 'C-77', 1, 0, '', '2021-11-20 06:02:35', '2021-11-20 06:02:35'),
(24, 'The witch and the dragon slayer', 'Richard Worm Wood', '1st', '1994', 'Oak Hill McGrow', '185', '776', 'Eng-01', 'Story', '926', 'State Library', '120', 'C-77', 1, 0, '', '2021-11-20 06:02:35', '2021-11-20 06:02:35'),
(25, 'The witch and the dragon slayer', 'Richard Worm Wood', '1st', '1994', 'Oak Hill McGrow', '185', '777', 'Eng-01', 'Story', '926', 'State Library', '120', 'C-77', 1, 0, '', '2021-11-20 06:02:35', '2021-11-20 06:02:35'),
(26, 'The witch and the dragon slayer', 'Richard Worm Wood', '1st', '1994', 'Oak Hill McGrow', '185', '778', 'Eng-01', 'Story', '926', 'State Library', '120', 'C-77', 1, 0, '', '2021-11-20 06:02:35', '2021-11-20 06:02:35'),
(27, 'The witch and the dragon slayer', 'Richard Worm Wood', '1st', '1994', 'Oak Hill McGrow', '185', '779', 'Eng-01', 'Story', '926', 'State Library', '120', 'C-77', 1, 0, '', '2021-11-20 06:02:35', '2021-11-20 06:02:35'),
(28, 'The witch and the dragon slayer', 'Richard Worm Wood', '1st', '1994', 'Oak Hill McGrow', '185', '780', 'Eng-01', 'Story', '926', 'State Library', '120', 'C-77', 0, 7, 'Lalchawimawia', '2021-11-20 06:02:35', '2021-11-20 06:02:35'),
(29, 'The witch and the dragon slayer', 'Richard Worm Wood', '1st', '1994', 'Oak Hill McGrow', '185', '781', 'Eng-01', 'Story', '926', 'State Library', '120', 'C-77', 1, 0, '', '2021-11-20 06:02:35', '2021-11-20 06:02:35'),
(30, 'The witch and the dragon slayer', 'Richard Worm Wood', '1st', '1994', 'Oak Hill McGrow', '185', '782', 'Eng-01', 'Story', '926', 'State Library', '120', 'C-77', 1, 0, '', '2021-11-20 06:02:35', '2021-11-20 06:02:35'),
(31, 'Lal Hnam', 'Lalsavunga', '1st', '2006', 'Lalhnam', '120', '1021', '7A', 'Religion', '1021', 'Donated By Lalrinliana', '80', 'MZ/21', 1, 0, '', '2021-11-21 08:38:56', '2021-11-21 08:38:56'),
(32, 'Lal Hnam', 'Lalsavunga', '1st', '2006', 'Lalhnam', '120', '1022', '7A', 'Religion', '1021', 'Donated By Lalrinliana', '80', 'MZ/21', 1, 0, '', '2021-11-21 08:38:56', '2021-11-21 08:38:56'),
(33, 'Lal Hnam', 'Lalsavunga', '1st', '2006', 'Lalhnam', '120', '1023', '7A', 'Religion', '1021', 'Donated By Lalrinliana', '80', 'MZ/21', 1, 0, '', '2021-11-21 08:38:56', '2021-11-21 08:38:56'),
(34, 'Lal Hnam', 'Lalsavunga', '1st', '2006', 'Lalhnam', '120', '1024', '7A', 'Religion', '1021', 'Donated By Lalrinliana', '80', 'MZ/21', 1, 0, '', '2021-11-21 08:38:56', '2021-11-21 08:38:56'),
(35, 'Lal Hnam', 'Lalsavunga', '1st', '2006', 'Lalhnam', '120', '1025', '7A', 'Religion', '1021', 'Donated By Lalrinliana', '80', 'MZ/21', 1, 0, '', '2021-11-21 08:38:56', '2021-11-21 08:38:56'),
(36, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '120', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 0, 7, 'Admin', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(37, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '121', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(38, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '122', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(39, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '123', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(40, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '124', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(41, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '125', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(42, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '126', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(43, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '127', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(44, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '128', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(45, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '129', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(46, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '130', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(47, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '131', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(48, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '132', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(49, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '133', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(50, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '134', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(51, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '135', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(52, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '136', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(53, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '137', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(54, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '138', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(55, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '139', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(56, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '140', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(57, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '141', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(58, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '142', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(59, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '143', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(60, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '144', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(61, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '145', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(62, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '146', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(63, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '147', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(64, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '148', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(65, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '149', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(66, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '150', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(67, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '151', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(68, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '152', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(69, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '153', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(70, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '154', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(71, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '155', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(72, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '156', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(73, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '157', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(74, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '158', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(75, 'English zirna', 'Elvin', '2nd', '2007', 'Chawnghlut Pvt', '158', '159', 'MZ-08', 'Education', '75', 'Donated by Zirpuia', '340', '89C', 1, 0, '', '2022-04-10 08:22:06', '2022-04-10 08:22:06'),
(76, 'Ropuiliani', 'Lalsangzuali Sailo', '1st', '1997', 'Mizo Hill', '210', '2133', '562', 'MZ', '544', 'RLTF', '180', 'C/99', 1, 0, '', '2022-04-16 17:36:03', '2022-04-16 17:36:03'),
(77, 'Ropuiliani', 'Lalsangzuali Sailo', '1st', '1997', 'Mizo Hill', '210', '2134', '562', 'MZ', '544', 'RLTF', '180', 'C/99', 1, 0, '', '2022-04-16 17:36:03', '2022-04-16 17:36:03'),
(78, 'Ropuiliani', 'Lalsangzuali Sailo', '1st', '1997', 'Mizo Hill', '210', '2135', '562', 'MZ', '544', 'RLTF', '180', 'C/99', 1, 0, '', '2022-04-16 17:36:03', '2022-04-16 17:36:03'),
(79, 'Ropuiliani', 'Lalsangzuali Sailo', '1st', '1997', 'Mizo Hill', '210', '2136', '562', 'MZ', '544', 'RLTF', '180', 'C/99', 1, 0, '', '2022-04-16 17:36:03', '2022-04-16 17:36:03'),
(80, 'Ropuiliani', 'Lalsangzuali Sailo', '1st', '1997', 'Mizo Hill', '210', '2137', '562', 'MZ', '544', 'RLTF', '180', 'C/99', 1, 0, '', '2022-04-16 17:36:03', '2022-04-16 17:36:03'),
(81, 'Martate thlan', 'Lalngaihsaka', '1st', '2020', 'Mizo Hill', '120', '721', '554', 'MZ', '742', 'MMF', '80', 'C/91', 1, 0, '', '2022-04-16 17:42:39', '2022-04-16 17:42:39'),
(82, 'Martate thlan', 'Lalngaihsaka', '1st', '2020', 'Mizo Hill', '120', '722', '554', 'MZ', '742', 'MMF', '80', 'C/91', 1, 0, '', '2022-04-16 17:42:39', '2022-04-16 17:42:39'),
(83, 'Martate thlan', 'Lalngaihsaka', '1st', '2020', 'Mizo Hill', '120', '723', '554', 'MZ', '742', 'MMF', '80', 'C/91', 1, 0, '', '2022-04-16 17:42:39', '2022-04-16 17:42:39');

-- Table `dynamic_fields` --
CREATE TABLE `dynamic_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `memberId` int(10) unsigned NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dynamic_fields_memberid_foreign` (`memberId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table `issues` --
CREATE TABLE `issues` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` int(10) unsigned NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `users_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` int(10) unsigned DEFAULT NULL,
  `issueDate` datetime NOT NULL,
  `retDate` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `issues_book_id_foreign` (`book_id`),
  KEY `issues_member_id_foreign` (`member_id`),
  KEY `issues_users_id_foreign` (`users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `issues` (`id`, `book_id`, `member_id`, `users_name`, `users_id`, `issueDate`, `retDate`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Admin', 1, '2021-06-19 00:00:00', '2021-06-26 00:00:00', '2021-06-19 09:03:27', ''),
(5, 2, 1, 'Admin', 1, '2021-11-13 00:00:00', '2021-11-20 00:00:00', '2021-11-13 11:37:28', ''),
(7, 7, 3, 'Lalchawimawia', 2, '2021-11-13 00:00:00', '2021-11-20 00:00:00', '2021-11-13 14:50:22', ''),
(18, 16, 8, 'Lalchawimawia', 2, '2021-11-21 00:00:00', '2021-11-28 00:00:00', '2021-11-21 09:17:42', ''),
(20, 28, 7, 'Lalchawimawia', 2, '2021-11-10 00:00:00', '2021-11-17 00:00:00', '2021-11-21 09:24:48', ''),
(21, 36, 7, 'Admin', 1, '2022-04-15 00:00:00', '2022-04-22 00:00:00', '2022-04-15 10:00:45', ''),
(23, 4, 3, 'Admin', 1, '2022-03-29 00:00:00', '2022-04-05 00:00:00', '2022-04-18 06:15:08', '');

-- Table `members` --
CREATE TABLE `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'nil',
  `section` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown.jpg',
  `id_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `rid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` decimal(4,2) NOT NULL DEFAULT '0.00',
  `rating_user` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `members` (`id`, `name`, `fname`, `mname`, `gender`, `section`, `mobile`, `address`, `image`, `id_number`, `rid`, `year`, `rating`, `rating_user`, `created_at`, `updated_at`) VALUES
(1, 'Richard Lallawmawma Tochhawng', 'Justin Lalrinchhan Renthlei', 'Lalhriatrengi', 'Male', 'Vanapa', '9874654234', 'C-96, Tlangveng', '2021061908271416178.jpg', 'RL/21/001', '1', '2022', '1.90', 'Lalchawimawia', '2021-06-19 08:21:57', '2022-04-16 06:22:16'),
(3, 'F. Zomuanpuii', 'F. Lalhmachhuana', 'Lalramthari', 'Female', 'Vanapa', '9876543213', 'C-96, Tlangveng', '2021061908353387076.jpg', 'RL/21/002', '2', '2022', '4.00', 'Lalchawimawia', '2021-06-19 08:35:33', '2022-04-15 17:12:53'),
(7, 'John Lalramlawma', 'P.C Rosangliana', 'Lalrinkimi', 'Male', 'Vanapa', '9854637646', 'C-45, Tlangveng', 'unknown.jpg', 'RL/21/003', '3', '2022', '3.00', 'Admin', '2021-11-14 07:13:28', '2022-02-23 08:56:29'),
(8, 'Lalsangliana', 'Laldawngliana', 'Lalrinsangi', 'Male', 'Vanapa', '9847765748', 'C-92, Tlangveng', 'unknown.jpg', 'RL/21/004', '4', '2022', '1.50', 'Admin', '2021-11-14 00:00:00', '2022-04-15 17:35:04'),
(10, 'Zoramlawmi', 'Lalbuaia', 'Hmingliani', 'Female', 'Taitesena', '9873655363', 'T-97, Golden Street', 'unknown.jpg', 'RL/22/ 001', '1', '2022', '0.00', '', '2022-04-15 17:47:10', '2022-04-15 18:06:32'),
(11, 'Lalfana', 'Sibuta', 'Lianhii', 'Male', 'Khuangchera', '4387345783', 'K-88, Palak Lai', 'unknown.jpg', 'RL/22/002', '2', '2022', '0.00', '', '2022-04-15 17:51:13', '2022-04-15 17:51:13');

-- Table `migrations` --
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(12, '2014_10_12_000000_create_users_table', 2),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_02_20_190050_create_books_table', 1),
(4, '2020_02_25_121206_create_members_table', 1),
(5, '2020_03_10_045233_create_issue_table', 1),
(6, '2020_03_10_073416_create_dynamic_field', 1),
(7, '2020_03_22_114036_create_receipts_table', 1),
(8, '2020_03_23_100917_register', 1),
(9, '2020_03_25_152619_create_tasks_table', 1),
(10, '2021_02_13_114454_book_member_table', 1),
(11, '2021_05_13_112600_create_returnreports_table', 1);

-- Table `password_resets` --
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table `receipts` --
CREATE TABLE `receipts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` int(10) unsigned NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `noOfDays` int(10) unsigned NOT NULL,
  `receiptNo` int(10) unsigned NOT NULL,
  `billDate` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `receipts_book_id_foreign` (`book_id`),
  KEY `receipts_member_id_foreign` (`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `receipts` (`id`, `book_id`, `member_id`, `noOfDays`, `receiptNo`, `billDate`, `created_at`, `updated_at`) VALUES
(1, 35, 7, 12, 1, '2021-11-21 09:16:32', '2021-11-21 09:16:32', '2021-11-21 09:16:32'),
(2, 34, 8, 5, 2, '2021-11-21 09:18:43', '2021-11-21 09:18:43', '2021-11-21 09:18:43'),
(3, 10, 1, 1, 3, '2021-11-21 16:22:14', '2021-11-21 16:22:14', '2021-11-21 16:22:14'),
(4, 6, 1, 1, 4, '2021-11-21 16:23:52', '2021-11-21 16:23:52', '2021-11-21 16:23:52');

-- Table `registers` --
CREATE TABLE `registers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `year` int(10) unsigned NOT NULL,
  `month` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `issue` int(10) unsigned NOT NULL DEFAULT '0',
  `ret` int(10) unsigned NOT NULL DEFAULT '0',
  `tot_book` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `registers` (`id`, `year`, `month`, `issue`, `ret`, `tot_book`, `created_at`, `updated_at`) VALUES
(1, 2022, '01', 0, 0, 25, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2022, '02', 0, 0, 28, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2022, '03', 1, 0, 28, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 2022, '04', 0, 1, 76, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 2022, '05', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 2022, '06', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 2022, '07', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 2022, '08', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 2022, '09', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 2022, '10', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 2022, '11', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 2022, '12', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- Table `returnreports` --
CREATE TABLE `returnreports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` int(10) unsigned NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `issue_users` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `return_users` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issueDate` datetime NOT NULL,
  `retDate` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `returnreports_book_id_foreign` (`book_id`),
  KEY `returnreports_member_id_foreign` (`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `returnreports` (`id`, `book_id`, `member_id`, `issue_users`, `return_users`, `issueDate`, `retDate`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 'Lalchawimawia', 'Lalchawimawia', '2021-07-19 00:00:00', '2021-07-19 06:51:36', '2021-07-19 06:51:36', '2021-07-19 06:51:36'),
(2, 8, 1, 'Admin', 'Admin', '2021-11-13 00:00:00', '2021-11-13 11:14:49', '2021-11-13 11:14:49', '2021-11-13 11:14:49'),
(11, 35, 7, 'Lalchawimawia', 'Lalchawimawia', '2021-11-02 00:00:00', '2021-11-21 09:16:35', '2021-11-21 09:16:35', '2021-11-21 09:16:35'),
(12, 11, 8, 'Lalchawimawia', 'Lalchawimawia', '2021-11-19 00:00:00', '2021-11-21 09:17:26', '2021-11-21 09:17:26', '2021-11-21 09:17:26'),
(13, 34, 8, 'Lalchawimawia', 'Lalchawimawia', '2021-11-09 00:00:00', '2021-11-21 09:24:14', '2021-11-21 09:24:14', '2021-11-21 09:24:14'),
(14, 10, 1, 'Lalchawimawia', 'Lalchawimawia', '2021-11-13 00:00:00', '2021-11-21 16:22:20', '2021-11-21 16:22:20', '2021-11-21 16:22:20'),
(15, 6, 1, 'Admin', 'Lalchawimawia', '2021-11-13 00:00:00', '2021-11-21 16:23:58', '2021-11-21 16:23:58', '2021-11-21 16:23:58'),
(16, 11, 10, 'Admin', 'Admin', '2023-04-15 00:00:00', '2022-04-15 18:06:11', '2022-04-15 18:06:11', '2022-04-15 18:06:11');

-- Table `tasks` --
CREATE TABLE `tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tasks` (`id`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Delete hian Book emaw Member ah a reference transaction zawng zawng in delete vek rawh se', 1, '2021-11-13 11:10:39', '2021-11-13 11:10:39');

-- Table `users` --
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown.jpg',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin123@gmail.com', '', '$2y$10$ck/xLjoHlH7DNMT3RRVpMettulQPD4NKPfvO7C2LfzStna/VdN00y', 'unknown.jpg', 'lsNSazIkQaxSEwlvHrwfOttMURknK4mav4thWwYaQ46aj0WhD2LM1Gsg9V4J', '2021-03-17 07:01:06', '2021-03-17 07:01:06'),
(2, 'Lalchawimawia', 'chawia123@gmail.com', '', '$2y$10$W9ZK38jIBvvqHFF2G.doNe63V9sA93CR91OcP5qY0w4j8smPXeazu', 'unknown.jpg', 'SRSxY4HH3MAwkBhl5w2vbQvU5xnFMwFWrCXTI0wYrYOAfj6C9UBHq9pgRtnT', '2021-07-15 13:33:50', '2021-07-15 13:33:50');

