-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jan 27, 2016 at 08:52 PM
-- Server version: 10.0.23-MariaDB
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kalpanad_ezaev2`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `moduleseq` bigint(20) DEFAULT NULL,
  `userseq` bigint(20) DEFAULT NULL,
  `iscompleted` tinyint(4) DEFAULT NULL,
  `progress` int(11) DEFAULT NULL,
  `dateofplay` datetime DEFAULT NULL,
  `learningplanseq` bigint(20) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`seq`),
  KEY `foreign_activities_learningplan` (`learningplanseq`),
  KEY `foreign_key03` (`moduleseq`),
  KEY `foreign_key04` (`userseq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=577 ;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`seq`, `moduleseq`, `userseq`, `iscompleted`, `progress`, `dateofplay`, `learningplanseq`, `score`) VALUES
(169, 2, 3209, 0, 0, '2015-08-13 18:02:37', 5, 0),
(170, 1, 3210, 1, 100, '2015-08-14 04:48:55', 4, 105),
(171, 2, 3212, 1, 100, '2015-08-14 04:50:20', 5, 70),
(172, 2, 3213, 0, 0, '2015-08-14 06:17:53', 5, 0),
(173, 2, 3214, 0, 0, '2015-08-14 07:26:43', 5, 0),
(174, 1, 3217, 0, 0, '2015-08-14 18:28:47', 4, 0),
(175, 2, 3215, 1, 100, '2015-08-15 09:12:19', 5, 70),
(176, 2, 3218, 0, 75, '2015-08-15 12:13:47', 5, 50),
(177, 2, 3219, 1, 100, '2015-08-17 06:47:17', 5, 175),
(178, 2, 3221, 1, 100, '2015-08-17 06:58:32', 5, 125),
(179, 2, 3220, 1, 100, '2015-08-17 10:41:33', 5, 90),
(180, 2, 3222, 1, 100, '2015-08-17 15:34:01', 5, 95),
(181, 2, 3223, 1, 100, '2015-08-17 17:12:47', 5, 90),
(182, 2, 3224, 1, 100, '2015-08-18 12:57:18', 5, 220),
(183, 2, 3225, 1, 100, '2015-08-18 17:10:23', 5, 75),
(184, 1, 3211, 1, 100, '2015-08-19 09:36:34', 4, 90),
(185, 1, 3227, 1, 100, '2015-08-19 10:02:30', 4, 90),
(186, 1, 3228, 1, 100, '2015-08-19 13:43:56', 4, 160),
(187, 1, 3208, 0, 0, '2015-08-20 05:15:57', 4, 0),
(188, 1, 3230, 1, 100, '2015-08-20 07:46:27', 4, 230),
(189, 1, 3231, 0, 25, '2015-08-20 08:38:02', 4, 0),
(190, 1, 3209, 0, 0, '2015-08-20 09:15:16', 4, 0),
(192, 1, 3232, 1, 100, '2015-08-22 07:54:02', 4, 470),
(193, 2, 3216, 1, 100, '2015-08-25 09:08:51', 5, 280),
(194, 1, 3233, 0, 0, '2015-08-28 08:03:45', 4, 0),
(195, 2, 3234, 1, 100, '2015-09-05 03:51:16', 5, 305),
(196, 2, 3235, 1, 100, '2015-09-05 07:23:21', 5, 190),
(197, 2, 3236, 1, 100, '2015-09-08 09:28:15', 5, 275),
(198, 2, 3237, 1, 100, '2015-09-09 11:37:46', 5, 230),
(199, 2, 3239, 1, 100, '2015-09-14 13:03:53', 5, 215),
(200, 2, 3240, 1, 100, '2015-09-14 15:46:49', 5, 215),
(201, 2, 3241, 1, 100, '2015-09-14 16:54:35', 5, 265),
(202, 2, 3242, 1, 100, '2015-09-14 19:07:53', 5, 175),
(203, 2, 3243, 1, 100, '2015-09-15 01:49:03', 5, 190),
(204, 2, 3244, 0, 25, '2015-09-15 09:05:26', 5, 0),
(205, 2, 3245, 1, 100, '2015-09-15 11:00:05', 5, 205),
(206, 2, 3246, 1, 100, '2015-09-15 16:47:41', 5, 205),
(207, 2, 3247, 1, 100, '2015-09-16 06:22:25', 5, 190),
(208, 2, 3248, 0, 25, '2015-09-16 06:24:50', 5, 0),
(209, 2, 3238, 0, 75, '2015-09-16 11:58:23', 5, 105),
(210, 2, 3249, 1, 100, '2015-09-23 05:07:45', 5, 190),
(211, 2, 3250, 1, 100, '2015-09-23 06:36:27', 5, 190),
(212, 2, 3251, 0, 0, '2015-09-23 06:40:44', 5, 0),
(213, 2, 3252, 1, 100, '2015-09-23 14:08:57', 5, 230),
(214, 2, 3253, 1, 100, '2015-09-28 17:08:32', 5, 230),
(215, 2, 3254, 0, 0, '2015-09-29 11:57:25', 5, 0),
(216, 2, 3255, 0, 75, '2015-10-01 07:35:33', 5, 165),
(217, 2, 3256, 1, 100, '2015-10-01 09:22:31', 5, 460),
(218, 2, 3257, 1, 100, '2015-10-02 15:26:27', 5, 215),
(219, 2, 3258, 0, 25, '2015-10-05 05:57:02', 5, 0),
(220, 2, 3259, 0, 25, '2015-10-05 06:13:57', 5, 190),
(221, 1, 3261, 0, 0, '2015-10-14 10:40:30', 4, 0),
(222, 2, 3265, 0, 50, '2015-10-14 10:43:20', 5, 0),
(223, 2, 3266, 0, 25, '2015-10-14 10:50:06', 5, 0),
(224, 2, 3267, 1, 100, '2015-10-15 12:18:18', 5, 160),
(225, 2, 3268, 0, 0, '2015-10-15 13:29:25', 5, 0),
(226, 1, 3288, 0, 50, '2015-11-01 19:38:27', 4, 0),
(227, 1, 3290, 1, 100, '2015-11-14 11:45:00', 4, 310),
(228, 1, 3292, 0, 25, '2015-11-19 13:45:11', 4, 0),
(233, 2, 3309, 0, 0, '2015-11-26 16:56:16', 5, 0),
(234, 1, 3310, 0, 0, '2015-11-26 17:10:48', 4, 275),
(235, 2, 3311, 1, 100, '2015-11-26 18:55:38', 5, 260),
(236, 2, 3312, 0, 25, '2015-11-27 17:08:08', 5, 0),
(240, 2, 3316, 1, 100, '2015-12-02 19:52:50', 5, 335),
(242, 2, 3318, 1, 100, '2015-12-09 15:06:34', 5, 260),
(243, 2, 3319, 1, 100, '2015-12-09 23:02:15', 5, 160),
(245, 2, 3321, 0, 0, '2015-12-17 20:04:59', 5, 0),
(246, 2, 3322, 1, 100, '2015-12-17 22:00:31', 5, 190),
(247, 2, 3323, 1, 100, '2015-12-31 17:30:40', 5, 205),
(248, 2, 3324, 1, 100, '2016-01-03 18:18:17', 5, 295),
(249, 2, 3325, 1, 100, '2016-01-05 12:02:51', 5, 305),
(250, 2, 3327, 1, 100, '2016-01-06 00:08:11', 5, 205),
(251, 2, 3328, 1, 100, '2016-01-06 12:31:07', 5, 350),
(252, 2, 3329, 1, 100, '2016-01-06 16:11:51', 5, 265),
(253, 2, 3330, 0, 0, '2016-01-08 11:31:46', 5, 0),
(254, 2, 3333, 0, 75, '2016-01-09 09:58:52', 5, 90),
(255, 2, 3332, 1, 100, '2016-01-09 18:50:29', 5, 230),
(256, 2, 3334, 1, 100, '2016-01-10 13:37:59', 5, 230),
(257, 2, 3335, 1, 100, '2016-01-11 10:31:09', 5, 235),
(258, 2, 3337, 1, 100, '2016-01-11 18:27:35', 5, 160),
(259, 2, 3336, 1, 100, '2016-01-11 18:29:40', 5, 470),
(260, 2, 3338, 1, 100, '2016-01-12 10:29:20', 5, 230),
(261, 2, 3339, 0, 0, '2016-01-12 21:59:30', 5, 0),
(262, 2, 3340, 1, 100, '2016-01-13 22:06:02', 5, 160),
(263, 2, 3341, 0, 75, '2016-01-14 16:43:02', 5, 105),
(264, 2, 3343, 1, 100, '2016-01-15 12:37:43', 5, 250),
(265, 2, 3345, 1, 100, '2016-01-15 15:27:30', 5, 465),
(266, 2, 3347, 1, 100, '2016-01-17 19:41:37', 5, 160),
(267, 2, 3349, 1, 100, '2016-01-18 12:35:53', 5, 190),
(268, 2, 3352, 1, 100, '2016-01-18 12:44:48', 5, 215),
(269, 2, 3353, 0, 0, '2016-01-18 12:45:12', 5, 0),
(270, 2, 3356, 1, 100, '2016-01-18 12:52:29', 5, 235),
(271, 2, 3357, 1, 100, '2016-01-18 12:55:08', 5, 235),
(272, 2, 3358, 1, 100, '2016-01-18 12:55:32', 5, 160),
(273, 2, 3354, 1, 100, '2016-01-18 12:59:40', 5, 175),
(274, 1, 3359, 0, 0, '2016-01-18 13:00:08', 4, 0),
(275, 2, 3360, 0, 25, '2016-01-18 13:02:11', 5, 0),
(276, 1, 3360, 0, 25, '2016-01-18 13:03:15', 4, 0),
(277, 2, 3361, 1, 100, '2016-01-18 13:06:43', 5, 335),
(278, 2, 3362, 1, 100, '2016-01-18 13:07:42', 5, 315),
(279, 2, 3363, 0, 0, '2016-01-18 13:14:47', 5, 0),
(280, 2, 3364, 1, 100, '2016-01-18 13:35:19', 5, 305),
(281, 2, 3366, 1, 100, '2016-01-18 14:01:01', 5, 335),
(282, 2, 3370, 1, 100, '2016-01-18 14:58:38', 5, 160),
(283, 2, 3371, 1, 100, '2016-01-18 15:01:11', 5, 205),
(284, 2, 3372, 1, 100, '2016-01-18 15:04:14', 5, 340),
(285, 2, 3374, 1, 100, '2016-01-18 15:14:29', 5, 230),
(286, 2, 3376, 0, 50, '2016-01-18 15:34:11', 5, 0),
(287, 2, 3375, 1, 100, '2016-01-18 15:59:11', 5, 190),
(288, 2, 3378, 1, 100, '2016-01-18 16:05:24', 5, 250),
(289, 2, 3373, 1, 100, '2016-01-18 16:13:03', 5, 190),
(290, 2, 3380, 1, 100, '2016-01-18 16:53:40', 5, 320),
(291, 2, 3381, 1, 100, '2016-01-18 16:58:46', 5, 190),
(292, 2, 3383, 1, 100, '2016-01-18 17:09:25', 5, 205),
(293, 2, 3384, 1, 100, '2016-01-18 17:14:37', 5, 365),
(294, 2, 3367, 0, 75, '2016-01-18 17:28:54', 5, 100),
(295, 2, 3385, 0, 25, '2016-01-18 17:33:23', 5, 0),
(296, 2, 3387, 1, 100, '2016-01-18 17:44:04', 5, 275),
(297, 2, 3388, 1, 100, '2016-01-18 19:29:45', 5, 325),
(298, 2, 3389, 1, 100, '2016-01-18 19:47:16', 5, 290),
(299, 2, 3391, 1, 100, '2016-01-18 19:52:17', 5, 230),
(300, 2, 3390, 1, 100, '2016-01-18 19:54:03', 5, 160),
(301, 2, 3393, 1, 100, '2016-01-18 21:05:03', 5, 325),
(302, 2, 3394, 1, 100, '2016-01-18 22:20:07', 5, 310),
(303, 2, 3395, 1, 100, '2016-01-18 23:55:07', 5, 215),
(304, 2, 3396, 1, 100, '2016-01-19 09:41:08', 5, 345),
(305, 2, 3397, 0, 0, '2016-01-19 10:05:05', 5, 0),
(306, 2, 3399, 1, 100, '2016-01-19 12:03:39', 5, 400),
(307, 2, 3403, 1, 100, '2016-01-19 12:42:10', 5, 245),
(308, 2, 3404, 1, 100, '2016-01-19 12:44:02', 5, 365),
(309, 2, 3406, 1, 100, '2016-01-19 12:50:16', 5, 175),
(310, 2, 3405, 1, 100, '2016-01-19 12:53:27', 5, 250),
(311, 2, 3407, 1, 100, '2016-01-19 13:20:47', 5, 235),
(312, 2, 3409, 0, 25, '2016-01-19 13:32:23', 5, 0),
(313, 2, 3410, 0, 75, '2016-01-19 13:33:20', 5, 135),
(314, 2, 3411, 1, 100, '2016-01-19 13:40:50', 5, 280),
(315, 2, 3412, 1, 100, '2016-01-19 13:46:03', 5, 305),
(316, 2, 3413, 1, 100, '2016-01-19 13:56:11', 5, 405),
(317, 2, 3377, 0, 75, '2016-01-19 13:57:25', 5, 105),
(318, 2, 3414, 1, 100, '2016-01-19 14:01:04', 5, 260),
(319, 2, 3415, 0, 75, '2016-01-19 14:01:47', 5, 135),
(320, 2, 3419, 1, 100, '2016-01-19 15:23:35', 5, 365),
(321, 2, 3418, 1, 100, '2016-01-19 15:23:46', 5, 295),
(322, 2, 3421, 1, 100, '2016-01-19 15:59:29', 5, 205),
(323, 2, 3342, 0, 0, '2016-01-19 16:28:26', 5, 0),
(324, 2, 3423, 1, 100, '2016-01-19 16:30:30', 5, 260),
(325, 2, 3426, 1, 100, '2016-01-19 17:10:37', 5, 230),
(326, 2, 3427, 1, 100, '2016-01-19 17:16:28', 5, 190),
(327, 2, 3428, 1, 100, '2016-01-19 17:18:58', 5, 255),
(328, 2, 3429, 0, 75, '2016-01-19 17:24:13', 5, 120),
(329, 2, 3431, 1, 100, '2016-01-19 17:42:42', 5, 250),
(330, 2, 3400, 1, 100, '2016-01-19 18:15:50', 5, 220),
(331, 2, 3351, 1, 100, '2016-01-19 19:30:08', 5, 230),
(332, 2, 3434, 1, 100, '2016-01-19 19:44:28', 5, 215),
(333, 2, 3402, 1, 100, '2016-01-19 19:47:57', 5, 235),
(334, 2, 3435, 1, 100, '2016-01-19 20:15:59', 5, 175),
(335, 2, 3436, 1, 100, '2016-01-19 20:16:19', 5, 205),
(336, 2, 3438, 0, 50, '2016-01-19 20:31:31', 5, 0),
(337, 2, 3439, 1, 100, '2016-01-19 20:38:21', 5, 395),
(338, 2, 3440, 1, 100, '2016-01-19 21:01:26', 5, 175),
(339, 2, 3441, 1, 100, '2016-01-19 22:17:05', 5, 190),
(340, 2, 3445, 1, 100, '2016-01-19 23:09:51', 5, 230),
(341, 2, 3444, 1, 100, '2016-01-19 23:16:22', 5, 265),
(342, 2, 3446, 1, 100, '2016-01-20 00:48:32', 5, 255),
(343, 2, 3447, 1, 100, '2016-01-20 07:41:41', 5, 235),
(344, 2, 3448, 1, 100, '2016-01-20 08:14:44', 5, 430),
(345, 2, 3449, 1, 100, '2016-01-20 09:13:10', 5, 275),
(346, 2, 3450, 1, 100, '2016-01-20 09:57:06', 5, 260),
(347, 2, 3451, 1, 100, '2016-01-20 10:04:18', 5, 315),
(348, 2, 3453, 1, 100, '2016-01-20 10:13:49', 5, 220),
(349, 2, 3454, 1, 100, '2016-01-20 10:20:05', 5, 190),
(350, 2, 3432, 1, 100, '2016-01-20 10:24:40', 5, 205),
(351, 2, 3455, 1, 100, '2016-01-20 10:28:00', 5, 190),
(352, 2, 3457, 1, 100, '2016-01-20 10:32:21', 5, 170),
(353, 2, 3459, 1, 100, '2016-01-20 10:32:30', 5, 205),
(354, 2, 3458, 1, 100, '2016-01-20 10:33:54', 5, 190),
(355, 2, 3456, 1, 100, '2016-01-20 10:41:48', 5, 275),
(356, 2, 3460, 1, 100, '2016-01-20 10:43:25', 5, 175),
(358, 2, 3464, 1, 100, '2016-01-20 11:08:50', 5, 205),
(359, 2, 3465, 1, 100, '2016-01-20 11:10:15', 5, 175),
(360, 2, 3467, 1, 100, '2016-01-20 11:14:26', 5, 160),
(361, 2, 3466, 1, 100, '2016-01-20 11:24:36', 5, 205),
(362, 2, 3463, 1, 100, '2016-01-20 11:33:52', 5, 305),
(363, 2, 3469, 1, 100, '2016-01-20 11:35:47', 5, 255),
(364, 2, 3471, 1, 100, '2016-01-20 11:55:09', 5, 265),
(365, 2, 3468, 1, 100, '2016-01-20 12:01:14', 5, 220),
(366, 2, 3472, 1, 100, '2016-01-20 12:08:15', 5, 160),
(367, 2, 3473, 1, 100, '2016-01-20 12:13:27', 5, 205),
(368, 2, 3474, 1, 100, '2016-01-20 12:19:55', 5, 250),
(369, 2, 3475, 1, 100, '2016-01-20 12:21:04', 5, 205),
(370, 2, 3479, 1, 100, '2016-01-20 12:30:07', 5, 230),
(371, 2, 3480, 1, 100, '2016-01-20 12:30:11', 5, 260),
(372, 2, 3478, 1, 100, '2016-01-20 12:32:52', 5, 220),
(373, 2, 3481, 1, 100, '2016-01-20 12:34:22', 5, 370),
(374, 2, 3482, 1, 100, '2016-01-20 12:35:27', 5, 205),
(375, 2, 3461, 1, 100, '2016-01-20 12:43:19', 5, 275),
(376, 2, 3483, 1, 100, '2016-01-20 12:46:51', 5, 205),
(377, 2, 3485, 1, 100, '2016-01-20 13:00:13', 5, 220),
(379, 2, 3486, 1, 100, '2016-01-20 13:01:18', 5, 200),
(380, 2, 3487, 0, 25, '2016-01-20 13:03:51', 5, 0),
(381, 2, 3369, 1, 100, '2016-01-20 13:09:42', 5, 290),
(382, 2, 3484, 1, 100, '2016-01-20 13:12:48', 5, 255),
(383, 2, 3488, 0, 25, '2016-01-20 13:17:21', 5, 0),
(384, 2, 3491, 1, 100, '2016-01-20 13:33:15', 5, 305),
(385, 2, 3490, 1, 100, '2016-01-20 13:40:54', 5, 220),
(386, 2, 3496, 1, 100, '2016-01-20 14:06:54', 5, 200),
(387, 2, 3497, 1, 100, '2016-01-20 14:11:19', 5, 420),
(389, 2, 3398, 0, 0, '2016-01-20 14:43:41', 5, 0),
(390, 2, 3499, 1, 100, '2016-01-20 14:47:08', 5, 245),
(391, 2, 3489, 1, 100, '2016-01-20 15:13:08', 5, 320),
(392, 2, 3500, 1, 100, '2016-01-20 15:13:09', 5, 160),
(393, 2, 3501, 1, 100, '2016-01-20 15:18:26', 5, 205),
(394, 2, 3502, 1, 100, '2016-01-20 15:29:00', 5, 220),
(395, 2, 3503, 1, 100, '2016-01-20 15:31:23', 5, 205),
(396, 2, 3430, 1, 100, '2016-01-20 15:32:37', 5, 350),
(397, 2, 3498, 0, 75, '2016-01-20 15:37:16', 5, 105),
(398, 2, 3505, 0, 0, '2016-01-20 15:38:13', 5, 0),
(399, 2, 3507, 1, 100, '2016-01-20 15:46:46', 5, 220),
(400, 2, 3506, 0, 75, '2016-01-20 15:46:55', 5, 195),
(401, 2, 3504, 1, 100, '2016-01-20 15:58:10', 5, 205),
(402, 2, 3508, 1, 100, '2016-01-20 16:07:38', 5, 190),
(403, 2, 3509, 1, 100, '2016-01-20 16:14:36', 5, 160),
(404, 2, 3510, 0, 0, '2016-01-20 16:31:00', 5, 0),
(405, 2, 3511, 1, 100, '2016-01-20 16:38:18', 5, 205),
(406, 2, 3512, 1, 100, '2016-01-20 16:38:56', 5, 390),
(407, 2, 3513, 1, 100, '2016-01-20 16:43:27', 5, 160),
(408, 2, 3514, 1, 100, '2016-01-20 16:55:30', 5, 305),
(409, 2, 3515, 1, 100, '2016-01-20 17:02:34', 5, 280),
(410, 2, 3516, 1, 100, '2016-01-20 17:07:30', 5, 245),
(411, 2, 3517, 1, 100, '2016-01-20 17:07:42', 5, 305),
(412, 2, 3518, 1, 100, '2016-01-20 17:10:09', 5, 255),
(413, 2, 3520, 1, 100, '2016-01-20 17:19:28', 5, 190),
(414, 2, 3521, 1, 100, '2016-01-20 17:20:20', 5, 205),
(415, 2, 3522, 1, 100, '2016-01-20 17:29:05', 5, 215),
(416, 2, 3519, 1, 100, '2016-01-20 17:32:45', 5, 205),
(417, 2, 3523, 1, 100, '2016-01-20 17:46:06', 5, 245),
(418, 2, 3526, 1, 100, '2016-01-20 18:18:12', 5, 175),
(419, 2, 3527, 0, 0, '2016-01-20 18:19:17', 5, 0),
(420, 2, 3528, 1, 100, '2016-01-20 18:23:59', 5, 175),
(421, 2, 3529, 0, 0, '2016-01-20 18:29:23', 5, 0),
(422, 2, 3530, 1, 100, '2016-01-20 18:31:33', 5, 270),
(423, 2, 3532, 0, 0, '2016-01-20 18:49:24', 5, 0),
(424, 2, 3533, 1, 100, '2016-01-20 18:50:51', 5, 205),
(425, 2, 3534, 1, 100, '2016-01-20 18:53:13', 5, 245),
(426, 2, 3525, 1, 100, '2016-01-20 19:17:58', 5, 295),
(427, 2, 3537, 1, 100, '2016-01-20 19:33:01', 5, 240),
(428, 2, 3538, 1, 100, '2016-01-20 19:41:12', 5, 235),
(429, 2, 3541, 1, 100, '2016-01-20 20:01:06', 5, 205),
(430, 2, 3542, 1, 100, '2016-01-20 20:20:37', 5, 245),
(431, 2, 3536, 1, 100, '2016-01-20 20:22:14', 5, 225),
(432, 2, 3543, 1, 100, '2016-01-20 20:30:26', 5, 240),
(433, 2, 3544, 1, 100, '2016-01-20 21:07:32', 5, 485),
(434, 2, 3545, 1, 100, '2016-01-20 21:08:58', 5, 220),
(435, 2, 3546, 1, 100, '2016-01-20 21:14:46', 5, 175),
(436, 2, 3547, 1, 100, '2016-01-20 21:20:37', 5, 190),
(437, 2, 3549, 1, 100, '2016-01-20 21:47:20', 5, 250),
(438, 2, 3365, 1, 100, '2016-01-20 22:09:33', 5, 230),
(439, 2, 3442, 1, 100, '2016-01-20 22:16:11', 5, 240),
(440, 2, 3550, 1, 100, '2016-01-20 22:19:29', 5, 190),
(441, 2, 3462, 1, 100, '2016-01-20 22:54:34', 5, 190),
(442, 2, 3552, 1, 100, '2016-01-20 23:42:27', 5, 175),
(443, 2, 3553, 1, 100, '2016-01-20 23:43:33', 5, 245),
(444, 2, 3420, 1, 100, '2016-01-21 12:26:41', 5, 350),
(445, 2, 3555, 1, 100, '2016-01-21 14:08:17', 5, 205),
(446, 2, 3556, 1, 100, '2016-01-21 15:27:45', 5, 205),
(447, 2, 3559, 1, 100, '2016-01-21 15:50:30', 5, 310),
(448, 2, 3558, 1, 100, '2016-01-21 15:56:21', 5, 190),
(449, 2, 3561, 1, 100, '2016-01-21 16:13:53', 5, 175),
(450, 2, 3563, 1, 100, '2016-01-21 16:15:25', 5, 220),
(451, 2, 3565, 1, 100, '2016-01-21 16:17:46', 5, 280),
(452, 2, 3564, 1, 100, '2016-01-21 16:19:54', 5, 175),
(453, 2, 3562, 1, 100, '2016-01-21 16:22:25', 5, 205),
(454, 2, 3560, 1, 100, '2016-01-21 16:25:11', 5, 240),
(455, 2, 3567, 0, 0, '2016-01-21 16:33:30', 5, 0),
(456, 2, 3568, 1, 100, '2016-01-21 16:36:17', 5, 250),
(457, 2, 3569, 1, 100, '2016-01-21 16:45:19', 5, 175),
(458, 2, 3570, 1, 100, '2016-01-21 16:49:12', 5, 220),
(459, 2, 3494, 1, 100, '2016-01-21 16:55:37', 5, 390),
(460, 2, 3573, 1, 100, '2016-01-21 16:58:45', 5, 230),
(461, 2, 3571, 1, 100, '2016-01-21 16:59:35', 5, 290),
(462, 2, 3576, 0, 0, '2016-01-21 17:05:34', 5, 0),
(463, 2, 3579, 1, 100, '2016-01-21 17:08:10', 5, 175),
(464, 2, 3580, 1, 100, '2016-01-21 17:08:45', 5, 360),
(465, 2, 3524, 1, 100, '2016-01-21 17:10:28', 5, 275),
(466, 2, 3577, 1, 100, '2016-01-21 17:11:18', 5, 215),
(467, 2, 3581, 1, 100, '2016-01-21 17:15:44', 5, 305),
(468, 2, 3417, 1, 100, '2016-01-21 17:16:31', 5, 205),
(469, 2, 3575, 1, 100, '2016-01-21 17:18:25', 5, 200),
(470, 2, 3584, 1, 100, '2016-01-21 17:19:59', 5, 220),
(471, 2, 3583, 1, 100, '2016-01-21 17:20:24', 5, 305),
(472, 2, 3416, 1, 100, '2016-01-21 17:20:57', 5, 280),
(473, 2, 3585, 1, 100, '2016-01-21 17:22:04', 5, 395),
(474, 2, 3586, 1, 100, '2016-01-21 17:32:32', 5, 330),
(475, 2, 3587, 1, 100, '2016-01-21 17:40:45', 5, 240),
(476, 2, 3590, 1, 100, '2016-01-21 17:44:43', 5, 220),
(477, 2, 3591, 1, 100, '2016-01-21 17:48:09', 5, 350),
(478, 2, 3592, 0, 75, '2016-01-21 17:55:15', 5, 90),
(479, 2, 3593, 0, 0, '2016-01-21 18:04:33', 5, 0),
(480, 2, 3594, 1, 100, '2016-01-21 18:11:01', 5, 190),
(481, 2, 3598, 1, 100, '2016-01-21 18:58:37', 5, 190),
(482, 2, 3600, 1, 100, '2016-01-21 19:01:52', 5, 220),
(483, 2, 3601, 1, 100, '2016-01-21 19:02:08', 5, 395),
(484, 2, 3599, 1, 100, '2016-01-21 19:02:46', 5, 190),
(485, 2, 3602, 0, 75, '2016-01-21 19:11:29', 5, 120),
(486, 2, 3604, 1, 100, '2016-01-21 19:25:31', 5, 190),
(487, 2, 3603, 1, 100, '2016-01-21 19:30:52', 5, 175),
(488, 2, 3605, 1, 100, '2016-01-21 19:37:32', 5, 335),
(489, 2, 3588, 1, 100, '2016-01-21 20:20:49', 5, 240),
(490, 2, 3606, 1, 100, '2016-01-21 20:27:56', 5, 480),
(491, 2, 3607, 1, 100, '2016-01-21 20:28:52', 5, 190),
(492, 2, 3608, 1, 100, '2016-01-21 21:19:46', 5, 190),
(493, 2, 3609, 1, 100, '2016-01-21 22:10:58', 5, 245),
(494, 2, 3610, 1, 100, '2016-01-21 22:58:38', 5, 160),
(495, 2, 3611, 1, 100, '2016-01-22 00:04:06', 5, 345),
(496, 2, 3612, 1, 100, '2016-01-22 08:20:26', 5, 245),
(497, 2, 3614, 0, 25, '2016-01-22 10:03:55', 5, 0),
(498, 2, 3551, 1, 100, '2016-01-22 10:20:48', 5, 175),
(499, 2, 3617, 1, 100, '2016-01-22 10:38:15', 5, 190),
(500, 2, 3616, 1, 100, '2016-01-22 10:38:48', 5, 220),
(501, 2, 3618, 1, 100, '2016-01-22 11:08:15', 5, 320),
(502, 2, 3619, 1, 100, '2016-01-22 11:25:07', 5, 365),
(503, 2, 3621, 1, 100, '2016-01-22 11:33:57', 5, 205),
(504, 2, 3622, 1, 100, '2016-01-22 11:56:03', 5, 175),
(505, 2, 3623, 1, 100, '2016-01-22 11:59:55', 5, 310),
(506, 2, 3624, 1, 100, '2016-01-22 12:01:50', 5, 190),
(507, 2, 3626, 1, 100, '2016-01-22 12:29:58', 5, 190),
(508, 2, 3627, 1, 100, '2016-01-22 12:39:56', 5, 220),
(509, 2, 3597, 0, 75, '2016-01-22 12:43:27', 5, 315),
(510, 2, 3628, 1, 100, '2016-01-22 12:49:42', 5, 330),
(511, 2, 3625, 1, 100, '2016-01-22 12:52:30', 5, 175),
(512, 2, 3566, 1, 100, '2016-01-22 12:56:27', 5, 175),
(513, 2, 3629, 1, 100, '2016-01-22 13:00:26', 5, 210),
(514, 2, 3630, 1, 100, '2016-01-22 13:03:45', 5, 220),
(515, 2, 3631, 1, 100, '2016-01-22 13:07:29', 5, 190),
(516, 2, 3572, 1, 100, '2016-01-22 13:07:44', 5, 460),
(517, 2, 3632, 0, 0, '2016-01-22 13:11:14', 5, 0),
(518, 2, 3633, 1, 100, '2016-01-22 13:11:38', 5, 220),
(519, 2, 3634, 1, 100, '2016-01-22 13:19:47', 5, 220),
(520, 2, 3636, 1, 100, '2016-01-22 13:26:27', 5, 220),
(521, 2, 3638, 1, 100, '2016-01-22 13:42:51', 5, 280),
(522, 2, 3639, 1, 100, '2016-01-22 13:44:14', 5, 190),
(523, 2, 3637, 1, 100, '2016-01-22 13:45:07', 5, 250),
(524, 2, 3641, 1, 100, '2016-01-22 13:54:24', 5, 350),
(525, 2, 3643, 1, 100, '2016-01-22 14:04:11', 5, 235),
(526, 2, 3644, 1, 100, '2016-01-22 14:28:17', 5, 190),
(527, 2, 3596, 1, 100, '2016-01-22 14:35:24', 5, 255),
(528, 2, 3640, 1, 100, '2016-01-22 14:41:57', 5, 190),
(529, 2, 3646, 1, 100, '2016-01-22 14:51:13', 5, 275),
(530, 2, 3645, 1, 100, '2016-01-22 14:52:05', 5, 160),
(531, 2, 3613, 0, 75, '2016-01-22 14:59:28', 5, 165),
(532, 2, 3648, 1, 100, '2016-01-22 15:01:32', 5, 190),
(533, 2, 3647, 1, 100, '2016-01-22 15:02:43', 5, 190),
(534, 2, 3649, 1, 100, '2016-01-22 15:36:00', 5, 205),
(535, 2, 3651, 1, 100, '2016-01-22 16:11:13', 5, 175),
(536, 2, 3652, 1, 100, '2016-01-22 16:32:16', 5, 460),
(537, 2, 3557, 1, 100, '2016-01-22 16:53:58', 5, 175),
(538, 2, 3408, 1, 100, '2016-01-22 17:45:05', 5, 220),
(539, 2, 3655, 1, 100, '2016-01-22 18:02:17', 5, 160),
(540, 2, 3656, 1, 100, '2016-01-22 18:08:28', 5, 290),
(541, 2, 3657, 1, 100, '2016-01-22 19:13:52', 5, 205),
(542, 2, 3658, 1, 100, '2016-01-22 19:17:13', 5, 190),
(543, 2, 3659, 1, 100, '2016-01-22 19:26:49', 5, 190),
(544, 2, 3660, 1, 100, '2016-01-22 19:28:26', 5, 190),
(545, 2, 3654, 0, 0, '2016-01-22 19:44:43', 5, 0),
(546, 2, 3661, 1, 100, '2016-01-22 20:20:58', 5, 300),
(547, 2, 3662, 1, 100, '2016-01-22 21:24:03', 5, 175),
(548, 2, 3663, 1, 100, '2016-01-22 21:54:20', 5, 240),
(549, 2, 3664, 0, 75, '2016-01-23 10:54:36', 5, 105),
(550, 2, 3425, 0, 75, '2016-01-23 14:16:49', 5, 105),
(551, 2, 3668, 1, 100, '2016-01-23 23:53:53', 5, 305),
(552, 2, 3669, 0, 0, '2016-01-24 10:46:33', 5, 175),
(553, 2, 3671, 1, 100, '2016-01-24 11:55:18', 5, 340),
(554, 2, 3672, 1, 100, '2016-01-24 13:48:00', 5, 310),
(555, 2, 3673, 1, 100, '2016-01-24 14:04:04', 5, 215),
(556, 2, 3674, 1, 100, '2016-01-24 14:44:13', 5, 305),
(557, 2, 3675, 1, 100, '2016-01-24 17:00:22', 5, 415),
(558, 2, 3676, 1, 100, '2016-01-24 18:00:42', 5, 280),
(559, 2, 3677, 0, 0, '2016-01-24 20:10:33', 5, 0),
(560, 2, 3650, 1, 100, '2016-01-24 20:47:27', 5, 215),
(561, 2, 3679, 1, 100, '2016-01-24 21:28:04', 5, 335),
(562, 2, 3680, 1, 100, '2016-01-24 21:35:21', 5, 300),
(563, 2, 3682, 1, 100, '2016-01-24 23:47:14', 5, 175),
(564, 2, 3684, 1, 100, '2016-01-25 09:38:33', 5, 190),
(565, 2, 3685, 1, 100, '2016-01-25 11:01:33', 5, 220),
(566, 2, 3686, 1, 100, '2016-01-25 11:35:44', 5, 230),
(567, 2, 3687, 1, 100, '2016-01-25 11:39:11', 5, 200),
(568, 2, 3688, 1, 100, '2016-01-25 12:07:57', 5, 160),
(569, 2, 3689, 1, 100, '2016-01-25 14:08:39', 5, 205),
(570, 2, 3690, 1, 100, '2016-01-25 14:50:33', 5, 215),
(571, 2, 3691, 1, 100, '2016-01-26 17:01:22', 5, 205),
(572, 2, 3692, 0, 0, '2016-01-27 10:51:52', 5, 0),
(573, 2, 3666, 1, 100, '2016-01-27 13:41:35', 5, 230),
(574, 2, 3693, 0, 75, '2016-01-27 13:51:16', 5, 135),
(575, 2, 3694, 0, 0, '2016-01-27 17:16:33', 5, 0),
(576, 2, 3719, 0, 0, '2016-01-27 13:11:31', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `adminmodules`
--

CREATE TABLE IF NOT EXISTS `adminmodules` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `companyseq` bigint(20) NOT NULL,
  `adminseq` bigint(20) NOT NULL,
  `moduleseq` bigint(20) NOT NULL,
  PRIMARY KEY (`seq`),
  KEY `foreign_adminmodule_admin` (`adminseq`),
  KEY `foreign_adminmodule_company` (`companyseq`),
  KEY `foreign_adminmodule_module` (`moduleseq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `username` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `emailid` varchar(100) DEFAULT NULL,
  `mobileno` varchar(20) DEFAULT NULL,
  `companyseq` bigint(20) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `isenabled` tinyint(4) DEFAULT NULL,
  `issuper` bit(1) DEFAULT NULL,
  `lastmodifiedon` datetime NOT NULL,
  `signupformheader` text,
  `ismanager` tinyint(4) DEFAULT NULL,
  `parentadminseq` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`seq`),
  KEY `foreign_key02` (`companyseq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`seq`, `name`, `username`, `password`, `emailid`, `mobileno`, `companyseq`, `createdon`, `isenabled`, `issuper`, `lastmodifiedon`, `signupformheader`, `ismanager`, `parentadminseq`) VALUES
(1, '', 'baljeet', 'bb', 'baljeetgaheer@gmail.com', '9814600356', 1, '2016-01-15 10:21:24', 1, b'0', '2016-01-15 10:21:24', NULL, NULL, NULL),
(2, 'HCL', 'hcl', 'hcladmin', 'amandeepdubey@gmail.com', '9814600356', 2, '2016-01-15 10:47:30', 1, b'0', '2016-01-15 10:47:30', '<h3><img data-cke-saved-src="http://www.ezae.in/images/hcl.jpg" src="http://www.ezae.in/images/hcl.jpg" style="width: 103px; height: 124.617px;">â€‹Welcome to PRIDE/GENERAL - New Hire Induction Module<br></h3><p>Please refer to your appointment letter to fill out the information below, and start your training.&nbsp;<br></p>', NULL, NULL),
(3, 'HCL Pride Manager', 'hclpridemanager', 'system', 'munishsethi777@gmail.com', '', 2, '2016-01-27 13:52:26', 1, b'0', '2016-01-27 13:52:26', NULL, 1, 2),
(4, 'HCL General Manager', 'hclgeneralmanager', 'system', 'munishsethi777@gmail.com', '', 2, '2016-01-27 13:19:45', 1, b'0', '2016-01-27 13:19:45', NULL, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `emailid` varchar(100) DEFAULT NULL,
  `mobileno` varchar(20) DEFAULT NULL,
  `contactperson` varchar(100) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `isenabled` tinyint(4) DEFAULT NULL,
  `address` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `prefix` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`, `prefix`) VALUES
(1, 'Demo', 'demo', 'munishsethi77@gmail.com', '9814600356', 'Munish', '2016-01-15 10:21:24', 1, 'munish', '', NULL),
(2, 'HCL', 'HCL', 'munishsethi777@gmail.com', '9417265865', '', '2016-01-15 10:47:30', 1, '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `companymodules`
--

CREATE TABLE IF NOT EXISTS `companymodules` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `companyseq` bigint(20) NOT NULL,
  `adminseq` bigint(20) NOT NULL,
  `moduleseq` bigint(20) NOT NULL,
  `addedon` datetime DEFAULT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `companymodules`
--

INSERT INTO `companymodules` (`seq`, `companyseq`, `adminseq`, `moduleseq`, `addedon`) VALUES
(1, 2, 2, 1, '2016-01-15 02:00:00'),
(2, 2, 2, 2, '2016-01-15 00:00:00'),
(4, 2, 2, 3, '2016-01-21 07:52:24'),
(6, 2, 2, 4, '2016-01-21 08:03:24'),
(8, 2, 2, 5, '2016-01-27 10:50:56');

-- --------------------------------------------------------

--
-- Table structure for table `leaderboard`
--

CREATE TABLE IF NOT EXISTS `leaderboard` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `leaderboardtype` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `learningplanseq` bigint(20) DEFAULT NULL,
  `moduleseq` bigint(20) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `lastmodifiedon` datetime DEFAULT NULL,
  `isenabled` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`seq`),
  KEY `foreign_leaderboard` (`learningplanseq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `leaderboard`
--

INSERT INTO `leaderboard` (`seq`, `name`, `leaderboardtype`, `learningplanseq`, `moduleseq`, `createdon`, `lastmodifiedon`, `isenabled`) VALUES
(8, 'Pride Learning Plan', 'LearningPlan', 4, 0, '2016-01-27 12:18:39', '2016-01-27 12:18:39', 1),
(10, 'General Learning Plan', 'LearningPlan', 5, 0, '2016-01-27 13:06:24', '2016-01-27 13:06:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `learningplanmodules`
--

CREATE TABLE IF NOT EXISTS `learningplanmodules` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `learningplanseq` bigint(20) NOT NULL,
  `courseseq` bigint(20) NOT NULL,
  `isenableleaderboard` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `learningplanmodules`
--

INSERT INTO `learningplanmodules` (`seq`, `learningplanseq`, `courseseq`, `isenableleaderboard`) VALUES
(11, 4, 1, 1),
(13, 5, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `learningplanprofiles`
--

CREATE TABLE IF NOT EXISTS `learningplanprofiles` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `learningplanseq` bigint(20) NOT NULL,
  `learningprofileseq` bigint(20) NOT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `learningplanprofiles`
--

INSERT INTO `learningplanprofiles` (`seq`, `learningplanseq`, `learningprofileseq`) VALUES
(10, 4, 3),
(12, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `learningplans`
--

CREATE TABLE IF NOT EXISTS `learningplans` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `adminseq` bigint(20) NOT NULL,
  `companyseq` bigint(20) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `description` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `isleaderboard` tinyint(4) DEFAULT NULL,
  `issequencelocked` tinyint(4) DEFAULT NULL,
  `isactive` tinyint(4) DEFAULT NULL,
  `deactivateon` datetime DEFAULT NULL,
  `createdon` datetime NOT NULL,
  `lastmodifiedon` datetime NOT NULL,
  `activateon` datetime DEFAULT NULL,
  PRIMARY KEY (`seq`),
  UNIQUE KEY `learningplans_index01` (`seq`,`companyseq`,`title`),
  UNIQUE KEY `learningplans_index02` (`companyseq`,`title`),
  KEY `foreign_lp_admin` (`adminseq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `learningplans`
--

INSERT INTO `learningplans` (`seq`, `adminseq`, `companyseq`, `title`, `description`, `isleaderboard`, `issequencelocked`, `isactive`, `deactivateon`, `createdon`, `lastmodifiedon`, `activateon`) VALUES
(4, 2, 2, 'Pride Learning Plan', 'Pride Learning Plan', 1, 0, 1, NULL, '2016-01-27 12:18:38', '2016-01-27 12:18:38', NULL),
(5, 2, 2, 'General Learning Plan', 'General Learning Plan', 1, 0, 1, NULL, '2016-01-27 13:06:24', '2016-01-27 13:06:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `learningprofiles`
--

CREATE TABLE IF NOT EXISTS `learningprofiles` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `tag` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `adminseq` bigint(20) NOT NULL,
  `companyseq` bigint(20) NOT NULL,
  `createdon` datetime NOT NULL,
  `description` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `lastmodifiedon` datetime NOT NULL,
  `awesomefontid` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`seq`),
  UNIQUE KEY `unique_index` (`companyseq`,`awesomefontid`),
  KEY `foreign_tag_admin` (`adminseq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `learningprofiles`
--

INSERT INTO `learningprofiles` (`seq`, `tag`, `adminseq`, `companyseq`, `createdon`, `description`, `lastmodifiedon`, `awesomefontid`) VALUES
(3, 'Pride', 2, 2, '2016-01-27 12:16:55', 'Pride', '2016-01-27 12:16:55', 'fa-medium'),
(5, 'General', 2, 2, '2016-01-27 12:18:04', 'General', '2016-01-27 12:18:04', 'fa-sellsy');

-- --------------------------------------------------------

--
-- Table structure for table `mailmessage`
--

CREATE TABLE IF NOT EXISTS `mailmessage` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mailmessageaction`
--

CREATE TABLE IF NOT EXISTS `mailmessageaction` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `messageid` bigint(20) DEFAULT NULL,
  `sendondate` datetime DEFAULT NULL,
  `messagecondition` varchar(45) DEFAULT NULL,
  `gettingmarksvalue` int(11) DEFAULT NULL,
  `moduleseq` bigint(20) DEFAULT NULL,
  `learningplanseq` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`seq`),
  UNIQUE KEY `unique_index` (`messagecondition`,`moduleseq`,`learningplanseq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mailmessagelearningprofiles`
--

CREATE TABLE IF NOT EXISTS `mailmessagelearningprofiles` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `messageid` bigint(20) DEFAULT NULL,
  `learningprofileid` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mailmessagemails`
--

CREATE TABLE IF NOT EXISTS `mailmessagemails` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `messageactionseq` bigint(20) DEFAULT NULL,
  `userseq` bigint(20) DEFAULT NULL,
  `adminseq` bigint(20) DEFAULT NULL,
  `failurecounter` int(11) DEFAULT NULL,
  `failureerror` varchar(1000) DEFAULT NULL,
  `savedon` datetime DEFAULT NULL,
  `senton` datetime DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `sendon` datetime DEFAULT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `managercriteria`
--

CREATE TABLE IF NOT EXISTS `managercriteria` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `managerseq` bigint(20) NOT NULL,
  `criteriatype` varchar(20) CHARACTER SET utf8 NOT NULL,
  `criteriavalue` varchar(250) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `managercriteria`
--

INSERT INTO `managercriteria` (`seq`, `managerseq`, `criteriatype`, `criteriavalue`) VALUES
(4, 4, 'learningPlan', '5'),
(7, 3, 'learningPlan', '4');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE IF NOT EXISTS `managers` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `companyseq` bigint(20) NOT NULL,
  `adminseq` bigint(20) NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `isenabled` tinyint(4) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `lastmodifiedon` datetime DEFAULT NULL,
  `mobile` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`seq`),
  KEY `foreign_managers_admin` (`adminseq`),
  KEY `foreign_managers_company` (`companyseq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `matchingrules`
--

CREATE TABLE IF NOT EXISTS `matchingrules` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `usernamefield` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `emailfield` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `passwordfield` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `adminseq` bigint(20) NOT NULL,
  `companyseq` bigint(20) NOT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `matchingrules`
--

INSERT INTO `matchingrules` (`seq`, `usernamefield`, `emailfield`, `passwordfield`, `adminseq`, `companyseq`) VALUES
(2, 'Email', 'Email', NULL, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `modulequestions`
--

CREATE TABLE IF NOT EXISTS `modulequestions` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `moduleseq` bigint(20) DEFAULT NULL,
  `questionseq` bigint(20) DEFAULT NULL,
  `addedon` datetime DEFAULT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `modulequestions`
--

INSERT INTO `modulequestions` (`seq`, `moduleseq`, `questionseq`, `addedon`) VALUES
(2, 3, 1, '2016-01-21 07:52:24'),
(3, 3, 2, '2016-01-21 07:52:24'),
(5, 5, 1, '2016-01-27 10:50:56');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) DEFAULT NULL,
  `description` varchar(2500) CHARACTER SET utf8 DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `isenabled` tinyint(4) DEFAULT NULL,
  `ispaid` tinyint(4) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `lastmodifiedon` datetime NOT NULL,
  `maxscore` double DEFAULT NULL,
  `passpercent` double DEFAULT NULL,
  `companyseq` bigint(20) NOT NULL,
  `timeallowed` int(11) DEFAULT NULL,
  `tagline` varchar(500) DEFAULT NULL,
  `imagepath` varchar(500) DEFAULT NULL,
  `synopsis` varchar(500) DEFAULT NULL,
  `author` varchar(250) DEFAULT NULL,
  `moduletype` varchar(100) DEFAULT NULL,
  `tags` varchar(500) DEFAULT NULL,
  `prerequisties` varchar(500) DEFAULT NULL,
  `prework` varchar(500) DEFAULT NULL,
  `videourl` varchar(500) DEFAULT NULL,
  `typedetails` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`seq`, `title`, `description`, `createdon`, `isenabled`, `ispaid`, `price`, `lastmodifiedon`, `maxscore`, `passpercent`, `companyseq`, `timeallowed`, `tagline`, `imagepath`, `synopsis`, `author`, `moduletype`, `tags`, `prerequisties`, `prework`, `videourl`, `typedetails`) VALUES
(1, 'Pride for HCL', 'Pride for HCL', '2016-01-15 00:00:00', 1, 0, 0, '0000-00-00 00:00:00', 100, NULL, 2, NULL, NULL, NULL, NULL, NULL, 'flash', NULL, NULL, NULL, NULL, NULL),
(2, 'Non Pride for HCL', 'Pride for HCL', '2016-01-15 00:00:00', 1, 0, 0, '2016-01-15 00:00:00', 100, NULL, 2, NULL, NULL, NULL, NULL, NULL, 'flash', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `my_log`
--

CREATE TABLE IF NOT EXISTS `my_log` (
  `timestamp` varchar(32) DEFAULT NULL,
  `logger` varchar(64) DEFAULT NULL,
  `level` varchar(32) DEFAULT NULL,
  `message` varchar(9999) DEFAULT NULL,
  `thread` varchar(32) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `line` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questionanswers`
--

CREATE TABLE IF NOT EXISTS `questionanswers` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `questionseq` bigint(20) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `feedback` varchar(500) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `questionanswers`
--

INSERT INTO `questionanswers` (`seq`, `questionseq`, `title`, `feedback`, `marks`) VALUES
(1, 1, 'india', 'good ', 100),
(2, 1, 'us ', 'bad', 0),
(3, 2, 'Hindi', 'correct answer', 10),
(4, 2, 'English', 'incorrect answer', 0),
(5, 2, 'Punjabi', 'incorrect answer', 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) DEFAULT NULL,
  `maxmarks` int(11) DEFAULT NULL,
  `timeallowed` int(11) DEFAULT NULL,
  `questiontype` varchar(20) DEFAULT NULL,
  `adminseq` bigint(20) DEFAULT NULL,
  `companyseq` bigint(20) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `isenabled` tinyint(4) DEFAULT NULL,
  `lastmodifiedon` date DEFAULT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`seq`, `title`, `maxmarks`, `timeallowed`, `questiontype`, `adminseq`, `companyseq`, `createdon`, `isenabled`, `lastmodifiedon`) VALUES
(1, 'what is your coountry', 0, NULL, 'single', 2, 2, '2016-01-21 07:49:10', 1, '2016-01-21'),
(2, 'What is your national language', 0, NULL, 'single', 2, 2, '2016-01-21 07:52:22', 1, '2016-01-21');

-- --------------------------------------------------------

--
-- Table structure for table `quizprogress`
--

CREATE TABLE IF NOT EXISTS `quizprogress` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `moduleseq` bigint(20) NOT NULL,
  `learningplanseq` bigint(20) NOT NULL,
  `questionseq` bigint(20) NOT NULL,
  `answerseq` bigint(20) NOT NULL,
  `userseq` bigint(20) NOT NULL,
  `dated` datetime NOT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `quizprogress`
--

INSERT INTO `quizprogress` (`seq`, `moduleseq`, `learningplanseq`, `questionseq`, `answerseq`, `userseq`, `dated`) VALUES
(1, 3, 3, 1, 1, 3370, '2016-01-21 07:55:17'),
(2, 3, 3, 2, 5, 3370, '2016-01-21 07:56:49');

-- --------------------------------------------------------

--
-- Table structure for table `signupformfields`
--

CREATE TABLE IF NOT EXISTS `signupformfields` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `adminseq` bigint(20) NOT NULL,
  `companyseq` bigint(20) NOT NULL,
  `customfieldseq` bigint(20) NOT NULL,
  `isrequired` tinyint(4) DEFAULT NULL,
  `isvisible` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`seq`),
  KEY `foreign_key01` (`adminseq`),
  KEY `foreign_key02` (`companyseq`),
  KEY `foreign_key03` (`customfieldseq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=217 ;

--
-- Dumping data for table `signupformfields`
--

INSERT INTO `signupformfields` (`seq`, `adminseq`, `companyseq`, `customfieldseq`, `isrequired`, `isvisible`) VALUES
(207, 2, 2, 17, 1, 1),
(208, 2, 2, 18, 1, 1),
(209, 2, 2, 19, 0, 1),
(210, 2, 2, 20, 0, 1),
(211, 2, 2, 21, 0, 1),
(212, 2, 2, 22, 1, 1),
(213, 2, 2, 23, 0, 1),
(214, 2, 2, 24, 1, 1),
(215, 2, 2, 25, 0, 0),
(216, 2, 2, 26, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usercustomfields`
--

CREATE TABLE IF NOT EXISTS `usercustomfields` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `companyseq` bigint(20) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `title` varchar(256) DEFAULT NULL,
  `fieldtype` varchar(20) DEFAULT NULL,
  `adminseq` bigint(20) NOT NULL,
  `lastmodifiedon` datetime NOT NULL,
  `possiblevalues` text,
  PRIMARY KEY (`seq`),
  UNIQUE KEY `unique_index` (`companyseq`,`name`),
  KEY `foreign_key06` (`companyseq`),
  KEY `foreign_uc_admin` (`adminseq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `usercustomfields`
--

INSERT INTO `usercustomfields` (`seq`, `companyseq`, `name`, `title`, `fieldtype`, `adminseq`, `lastmodifiedon`, `possiblevalues`) VALUES
(17, 2, 'firstName', 'First Name', 'Text', 2, '2016-01-27 12:10:08', ''),
(18, 2, 'lastName', 'Last Name', 'Text', 2, '2016-01-27 12:09:59', ''),
(19, 2, 'location', 'Office Location', 'Dropdown', 2, '2016-01-27 12:09:42', 'Ahmedabad\r\nBangalore\r\nBhopal\r\nBhubaneshwar\r\nChandigarh\r\nChennai\r\nCochin \r\nCoimbatore\r\nDehradun\r\nDelhi\r\nGurgaon\r\nGuwahati\r\nHO - Noida\r\nHyderabad\r\nJaipur\r\nKolkata\r\nLucknow\r\nMumbai\r\nNagpur\r\nNoida\r\nPatna\r\nPune\r\nRaipur\r\nRanchi\r\nSrinagar\r\nTrichy\r\nUttranchal - UMO\r\nNorth1\r\nNorth 2\r\nEast 1\r\nEast 2\r\nWest\r\nSouth'),
(20, 2, 'position', 'Position', 'Dropdown', 2, '2016-01-27 12:12:28', 'AREA SALES EXECUTIVE\r\nAREA SALES MANAGER\r\nASSISTANT\r\nASSISTANT GENERAL MANAGER\r\nASSISTANT MANAGER\r\nASSISTANT MANAGER - MARKETING\r\nASSISTANT MANAGER-FINANCE &amp; COMMERCIAL\r\nASSOCIATE\r\nASSOCIATE MANAGER - LOGISTICS\r\nASSOCIATE VICE PRESIDENT\r\nBRANCH MANAGER\r\nBRANCH SALES OPERATIONS MANAGER\r\nBUSINESS FINANCE CONTROLLER\r\nBUSINESS FINANCE LEADER - DISTRIBUTION\r\nDEMAND PLANNER\r\nDEPUTY GENERAL MANAGER\r\nDEPUTY MANAGER\r\nEXECUTIVE\r\nEXECUTIVE - ACCOUNTS\r\nEXECUTIVE - HR\r\nEXECUTIVE - LOGISTICS\r\nEXECUTIVE - LOGISTICS &amp; COMMERCIAL\r\nEXECUTIVE - MIS\r\nEXECUTIVE ASSISTANT\r\nGENERAL MANAGER\r\nGLOBAL HEAD - PRODUCT MGMT (MOB.SOLU.)\r\nHEAD - BU OPERATIONS\r\nHEAD - DEMAND PLANNING\r\nHEAD - SALES DEV. &amp; NEW INITIATIVE\r\nHR HEAD - DISTRIBUTION BUSINESS\r\nJOINT PRESIDENT\r\nJUNIOR MANAGER\r\nKEY ACCOUNT EXECUTIVE\r\nKEY ACCOUNT MANAGER\r\nLOGISTICS &amp; COMMERCIAL COORDINATOR\r\nLOGISTICS &amp; COMMERCIAL EXECUTIVE\r\nMANAGER\r\nMANAGER - HR\r\nMANAGER - LOGISTICS\r\nMANAGER - SALES\r\nMANAGER - TRAINING\r\nMIS EXECUTIVE\r\nMRE\r\nNATIONAL MANAGER\r\nON THE JOB TRAINEE\r\nPRODUCT MANAGER\r\nREGIONAL ACCOUNTS OFFICER\r\nREGIONAL BUSINESS HEAD\r\nREGIONAL DEMAND PLANNER\r\nREGIONAL FIELD FORCE MANAGER\r\nREGIONAL MANAGER\r\nREGIONAL MANAGER - LOGISTICS\r\nREGIONAL SALES OPERATIONS MANAGER\r\nSALES CO-ORDINATOR\r\nSALES EXECUTIVE\r\nSALES HEAD-E COMMERCE\r\nSALES MANAGER\r\nSALES MANAGER - DEVICES\r\nSALES OFFICER\r\nSENIOR ANALYST\r\nSENIOR CUSTOMER ENGINEER\r\nSENIOR EXECUTIVE\r\nSENIOR EXECUTIVE-SALES ACCOUNTANT\r\nSENIOR MANAGER\r\nTEAM LEADER\r\nVICE PRESIDENT'),
(21, 2, 'department', 'Department', 'Dropdown', 2, '2016-01-27 12:14:03', 'DISTRIBUTION-DE &amp; COMPUTING       \r\nCONSUMER ELECTRONICS &amp; HOME APPLIANCES\r\nDMS COMMON\r\nNOKIA-DEVICE\r\nNOKIA-GEAR       \r\nDMS - LOGISTICS      \r\nDMS ACCOUNTS\r\nDMS ACCOUNTS SHARED       \r\nDMS HR      \r\nDMS QUALITY'),
(22, 2, 'reportingManager', 'Reporting Manager', 'Text', 2, '2016-01-27 12:14:29', ''),
(23, 2, 'grade', 'Grade', 'Dropdown', 2, '2016-01-27 12:15:31', 'E4\r\nKM\r\nKN\r\nKT\r\nN3\r\nP1\r\nP2\r\nP3\r\nP4\r\nP5\r\nP6\r\nP6 and above\r\nRG\r\nX0\r\nX1\r\nX2\r\nX3\r\nX4\r\nX5'),
(24, 2, 'mobileNumber', 'Mobile Number', 'Text', 2, '2016-01-27 12:15:45', ''),
(25, 2, 'userType', 'userType', 'Text', 2, '2016-01-27 12:07:26', ''),
(26, 2, 'Email', 'Email Id', 'Text', 2, '2016-01-27 12:11:03', '');

-- --------------------------------------------------------

--
-- Table structure for table `userlearningprofiles`
--

CREATE TABLE IF NOT EXISTS `userlearningprofiles` (
  `seq` int(11) NOT NULL AUTO_INCREMENT,
  `userseq` bigint(20) DEFAULT NULL,
  `tagseq` bigint(20) NOT NULL,
  `adminseq` bigint(20) NOT NULL,
  PRIMARY KEY (`seq`),
  UNIQUE KEY `unique_index` (`userseq`,`tagseq`),
  KEY `foreign_ut_admin` (`adminseq`),
  KEY `foreign_ut_tag` (`tagseq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=839 ;

--
-- Dumping data for table `userlearningprofiles`
--

INSERT INTO `userlearningprofiles` (`seq`, `userseq`, `tagseq`, `adminseq`) VALUES
(261, 3492, 3, 2),
(262, 3233, 3, 2),
(263, 3232, 3, 2),
(264, 3261, 3, 2),
(265, 3288, 3, 2),
(266, 3310, 3, 2),
(267, 3292, 3, 2),
(268, 3290, 3, 2),
(269, 3231, 3, 2),
(270, 3230, 3, 2),
(271, 3217, 3, 2),
(272, 3211, 3, 2),
(273, 3210, 3, 2),
(274, 3226, 3, 2),
(275, 3227, 3, 2),
(276, 3229, 3, 2),
(277, 3228, 3, 2),
(278, 3359, 3, 2),
(280, 3584, 5, 2),
(281, 3329, 5, 2),
(282, 3585, 5, 2),
(283, 3330, 5, 2),
(284, 3586, 5, 2),
(285, 3331, 5, 2),
(286, 3587, 5, 2),
(287, 3332, 5, 2),
(288, 3588, 5, 2),
(289, 3333, 5, 2),
(290, 3589, 5, 2),
(291, 3334, 5, 2),
(292, 3590, 5, 2),
(293, 3335, 5, 2),
(294, 3591, 5, 2),
(295, 3336, 5, 2),
(296, 3592, 5, 2),
(297, 3337, 5, 2),
(298, 3593, 5, 2),
(299, 3338, 5, 2),
(300, 3594, 5, 2),
(301, 3339, 5, 2),
(302, 3595, 5, 2),
(303, 3340, 5, 2),
(304, 3596, 5, 2),
(305, 3341, 5, 2),
(306, 3597, 5, 2),
(307, 3342, 5, 2),
(308, 3598, 5, 2),
(309, 3343, 5, 2),
(310, 3599, 5, 2),
(311, 3344, 5, 2),
(312, 3600, 5, 2),
(313, 3345, 5, 2),
(314, 3601, 5, 2),
(315, 3346, 5, 2),
(316, 3602, 5, 2),
(317, 3347, 5, 2),
(318, 3603, 5, 2),
(319, 3348, 5, 2),
(320, 3604, 5, 2),
(321, 3349, 5, 2),
(322, 3605, 5, 2),
(323, 3350, 5, 2),
(324, 3606, 5, 2),
(325, 3351, 5, 2),
(326, 3607, 5, 2),
(327, 3352, 5, 2),
(328, 3608, 5, 2),
(329, 3353, 5, 2),
(330, 3609, 5, 2),
(331, 3354, 5, 2),
(332, 3610, 5, 2),
(333, 3355, 5, 2),
(334, 3611, 5, 2),
(335, 3356, 5, 2),
(336, 3612, 5, 2),
(337, 3357, 5, 2),
(338, 3613, 5, 2),
(339, 3358, 5, 2),
(340, 3614, 5, 2),
(341, 3615, 5, 2),
(342, 3360, 5, 2),
(343, 3616, 5, 2),
(344, 3361, 5, 2),
(345, 3617, 5, 2),
(346, 3362, 5, 2),
(347, 3618, 5, 2),
(348, 3363, 5, 2),
(349, 3619, 5, 2),
(350, 3364, 5, 2),
(351, 3620, 5, 2),
(352, 3365, 5, 2),
(353, 3621, 5, 2),
(354, 3366, 5, 2),
(355, 3622, 5, 2),
(356, 3367, 5, 2),
(357, 3623, 5, 2),
(358, 3368, 5, 2),
(359, 3624, 5, 2),
(360, 3369, 5, 2),
(361, 3625, 5, 2),
(362, 3370, 5, 2),
(363, 3626, 5, 2),
(364, 3371, 5, 2),
(365, 3627, 5, 2),
(366, 3372, 5, 2),
(367, 3628, 5, 2),
(368, 3373, 5, 2),
(369, 3629, 5, 2),
(370, 3374, 5, 2),
(371, 3630, 5, 2),
(372, 3375, 5, 2),
(373, 3631, 5, 2),
(374, 3376, 5, 2),
(375, 3632, 5, 2),
(376, 3377, 5, 2),
(377, 3633, 5, 2),
(378, 3378, 5, 2),
(399, 3500, 5, 2),
(400, 3245, 5, 2),
(401, 3244, 5, 2),
(402, 3499, 5, 2),
(403, 3498, 5, 2),
(404, 3243, 5, 2),
(405, 3501, 5, 2),
(406, 3246, 5, 2),
(407, 3248, 5, 2),
(408, 3504, 5, 2),
(409, 3503, 5, 2),
(410, 3247, 5, 2),
(411, 3502, 5, 2),
(412, 3242, 5, 2),
(413, 3497, 5, 2),
(426, 3249, 5, 2),
(427, 3505, 5, 2),
(428, 3259, 5, 2),
(429, 3515, 5, 2),
(430, 3514, 5, 2),
(431, 3258, 5, 2),
(432, 3257, 5, 2),
(433, 3513, 5, 2),
(434, 3260, 5, 2),
(435, 3516, 5, 2),
(436, 3519, 5, 2),
(437, 3264, 5, 2),
(438, 3518, 5, 2),
(439, 3262, 5, 2),
(440, 3517, 5, 2),
(441, 3512, 5, 2),
(442, 3256, 5, 2),
(443, 3507, 5, 2),
(444, 3252, 5, 2),
(445, 3251, 5, 2),
(446, 3506, 5, 2),
(447, 3250, 5, 2),
(448, 3508, 5, 2),
(449, 3253, 5, 2),
(450, 3255, 5, 2),
(451, 3511, 5, 2),
(452, 3510, 5, 2),
(453, 3254, 5, 2),
(454, 3509, 5, 2),
(483, 3328, 5, 2),
(515, 3634, 5, 2),
(516, 3379, 5, 2),
(517, 3635, 5, 2),
(518, 3385, 5, 2),
(519, 3640, 5, 2),
(520, 3384, 5, 2),
(521, 3639, 5, 2),
(522, 3383, 5, 2),
(523, 3638, 5, 2),
(524, 3382, 5, 2),
(525, 3637, 5, 2),
(526, 3381, 5, 2),
(527, 3636, 5, 2),
(528, 3380, 5, 2),
(529, 3428, 5, 2),
(530, 3683, 5, 2),
(531, 3427, 5, 2),
(532, 3682, 5, 2),
(533, 3426, 5, 2),
(534, 3681, 5, 2),
(535, 3425, 5, 2),
(536, 3680, 5, 2),
(537, 3424, 5, 2),
(538, 3679, 5, 2),
(539, 3423, 5, 2),
(540, 3678, 5, 2),
(541, 3677, 5, 2),
(542, 3422, 5, 2),
(543, 3421, 5, 2),
(544, 3641, 5, 2),
(545, 3386, 5, 2),
(546, 3642, 5, 2),
(547, 3387, 5, 2),
(548, 3643, 5, 2),
(549, 3388, 5, 2),
(550, 3644, 5, 2),
(551, 3389, 5, 2),
(552, 3645, 5, 2),
(553, 3390, 5, 2),
(554, 3646, 5, 2),
(555, 3391, 5, 2),
(556, 3647, 5, 2),
(557, 3392, 5, 2),
(558, 3648, 5, 2),
(559, 3393, 5, 2),
(560, 3649, 5, 2),
(561, 3394, 5, 2),
(562, 3650, 5, 2),
(563, 3395, 5, 2),
(564, 3651, 5, 2),
(565, 3396, 5, 2),
(566, 3652, 5, 2),
(567, 3397, 5, 2),
(568, 3398, 5, 2),
(569, 3653, 5, 2),
(570, 3654, 5, 2),
(571, 3399, 5, 2),
(572, 3655, 5, 2),
(573, 3400, 5, 2),
(574, 3656, 5, 2),
(575, 3401, 5, 2),
(576, 3657, 5, 2),
(577, 3402, 5, 2),
(578, 3658, 5, 2),
(579, 3403, 5, 2),
(580, 3659, 5, 2),
(581, 3404, 5, 2),
(582, 3660, 5, 2),
(583, 3405, 5, 2),
(584, 3661, 5, 2),
(585, 3406, 5, 2),
(586, 3662, 5, 2),
(587, 3407, 5, 2),
(588, 3663, 5, 2),
(589, 3408, 5, 2),
(590, 3664, 5, 2),
(591, 3409, 5, 2),
(592, 3665, 5, 2),
(593, 3410, 5, 2),
(594, 3676, 5, 2),
(595, 3420, 5, 2),
(596, 3675, 5, 2),
(597, 3419, 5, 2),
(598, 3674, 5, 2),
(599, 3418, 5, 2),
(600, 3673, 5, 2),
(601, 3417, 5, 2),
(602, 3672, 5, 2),
(603, 3416, 5, 2),
(604, 3671, 5, 2),
(605, 3415, 5, 2),
(606, 3670, 5, 2),
(607, 3414, 5, 2),
(608, 3666, 5, 2),
(609, 3411, 5, 2),
(610, 3667, 5, 2),
(611, 3412, 5, 2),
(612, 3668, 5, 2),
(613, 3413, 5, 2),
(614, 3669, 5, 2),
(615, 3684, 5, 2),
(616, 3429, 5, 2),
(617, 3685, 5, 2),
(618, 3430, 5, 2),
(619, 3686, 5, 2),
(620, 3431, 5, 2),
(621, 3687, 5, 2),
(622, 3432, 5, 2),
(623, 3688, 5, 2),
(624, 3433, 5, 2),
(625, 3689, 5, 2),
(626, 3434, 5, 2),
(627, 3690, 5, 2),
(628, 3435, 5, 2),
(629, 3691, 5, 2),
(630, 3436, 5, 2),
(631, 3692, 5, 2),
(632, 3693, 5, 2),
(633, 3437, 5, 2),
(634, 3438, 5, 2),
(635, 3694, 5, 2),
(636, 3439, 5, 2),
(637, 3440, 5, 2),
(638, 3441, 5, 2),
(639, 3442, 5, 2),
(640, 3443, 5, 2),
(641, 3444, 5, 2),
(642, 3445, 5, 2),
(643, 3446, 5, 2),
(644, 3447, 5, 2),
(645, 3448, 5, 2),
(646, 3449, 5, 2),
(647, 3450, 5, 2),
(648, 3451, 5, 2),
(649, 3452, 5, 2),
(650, 3453, 5, 2),
(651, 3454, 5, 2),
(652, 3455, 5, 2),
(653, 3456, 5, 2),
(654, 3457, 5, 2),
(655, 3458, 5, 2),
(656, 3459, 5, 2),
(657, 3460, 5, 2),
(658, 3461, 5, 2),
(659, 3462, 5, 2),
(660, 3463, 5, 2),
(661, 3208, 5, 2),
(662, 3464, 5, 2),
(663, 3209, 5, 2),
(664, 3465, 5, 2),
(665, 3466, 5, 2),
(666, 3467, 5, 2),
(667, 3212, 5, 2),
(668, 3468, 5, 2),
(669, 3213, 5, 2),
(670, 3469, 5, 2),
(671, 3214, 5, 2),
(672, 3470, 5, 2),
(673, 3215, 5, 2),
(674, 3471, 5, 2),
(675, 3216, 5, 2),
(676, 3472, 5, 2),
(677, 3473, 5, 2),
(678, 3218, 5, 2),
(679, 3474, 5, 2),
(680, 3219, 5, 2),
(681, 3475, 5, 2),
(682, 3220, 5, 2),
(683, 3476, 5, 2),
(684, 3221, 5, 2),
(685, 3477, 5, 2),
(686, 3222, 5, 2),
(687, 3478, 5, 2),
(688, 3223, 5, 2),
(689, 3479, 5, 2),
(690, 3224, 5, 2),
(691, 3480, 5, 2),
(692, 3225, 5, 2),
(693, 3481, 5, 2),
(694, 3482, 5, 2),
(695, 3483, 5, 2),
(696, 3484, 5, 2),
(697, 3485, 5, 2),
(698, 3486, 5, 2),
(699, 3487, 5, 2),
(700, 3488, 5, 2),
(701, 3489, 5, 2),
(702, 3234, 5, 2),
(703, 3235, 5, 2),
(704, 3490, 5, 2),
(705, 3491, 5, 2),
(706, 3236, 5, 2),
(707, 3237, 5, 2),
(708, 3493, 5, 2),
(709, 3238, 5, 2),
(710, 3494, 5, 2),
(711, 3239, 5, 2),
(712, 3240, 5, 2),
(713, 3496, 5, 2),
(714, 3241, 5, 2),
(715, 3539, 5, 2),
(716, 3283, 5, 2),
(717, 3284, 5, 2),
(718, 3540, 5, 2),
(719, 3541, 5, 2),
(720, 3285, 5, 2),
(721, 3538, 5, 2),
(722, 3282, 5, 2),
(723, 3280, 5, 2),
(724, 3535, 5, 2),
(725, 3536, 5, 2),
(726, 3281, 5, 2),
(727, 3537, 5, 2),
(728, 3286, 5, 2),
(729, 3542, 5, 2),
(730, 3548, 5, 2),
(731, 3547, 5, 2),
(732, 3293, 5, 2),
(733, 3549, 5, 2),
(734, 3294, 5, 2),
(735, 3520, 5, 2),
(736, 3265, 5, 2),
(737, 3560, 5, 2),
(738, 3561, 5, 2),
(739, 3304, 5, 2),
(740, 3559, 5, 2),
(741, 3558, 5, 2),
(742, 3303, 5, 2),
(743, 3562, 5, 2),
(744, 3563, 5, 2),
(745, 3566, 5, 2),
(746, 3311, 5, 2),
(747, 3565, 5, 2),
(748, 3309, 5, 2),
(749, 3564, 5, 2),
(750, 3302, 5, 2),
(751, 3557, 5, 2),
(752, 3297, 5, 2),
(753, 3553, 5, 2),
(754, 3552, 5, 2),
(755, 3296, 5, 2),
(756, 3551, 5, 2),
(757, 3298, 5, 2),
(758, 3554, 5, 2),
(759, 3556, 5, 2),
(760, 3301, 5, 2),
(761, 3300, 5, 2),
(762, 3555, 5, 2),
(763, 3299, 5, 2),
(764, 3567, 5, 2),
(765, 3312, 5, 2),
(766, 3579, 5, 2),
(767, 3324, 5, 2),
(768, 3323, 5, 2),
(769, 3578, 5, 2),
(770, 3577, 5, 2),
(771, 3322, 5, 2),
(772, 3580, 5, 2),
(773, 3325, 5, 2),
(774, 3327, 5, 2),
(775, 3583, 5, 2),
(776, 3582, 5, 2),
(777, 3326, 5, 2),
(778, 3581, 5, 2),
(779, 3321, 5, 2),
(780, 3576, 5, 2),
(781, 3571, 5, 2),
(782, 3316, 5, 2),
(783, 3570, 5, 2),
(784, 3569, 5, 2),
(785, 3568, 5, 2),
(786, 3572, 5, 2),
(787, 3317, 5, 2),
(788, 3319, 5, 2),
(789, 3575, 5, 2),
(790, 3574, 5, 2),
(791, 3318, 5, 2),
(792, 3573, 5, 2),
(793, 3295, 5, 2),
(794, 3550, 5, 2),
(795, 3530, 5, 2),
(796, 3275, 5, 2),
(797, 3274, 5, 2),
(798, 3529, 5, 2),
(799, 3528, 5, 2),
(800, 3273, 5, 2),
(801, 3531, 5, 2),
(802, 3278, 5, 2),
(803, 3276, 5, 2),
(804, 3534, 5, 2),
(805, 3533, 5, 2),
(806, 3277, 5, 2),
(807, 3532, 5, 2),
(808, 3272, 5, 2),
(809, 3527, 5, 2),
(810, 3267, 5, 2),
(811, 3523, 5, 2),
(812, 3522, 5, 2),
(813, 3266, 5, 2),
(814, 3521, 5, 2),
(815, 3268, 5, 2),
(816, 3524, 5, 2),
(817, 3526, 5, 2),
(818, 3271, 5, 2),
(819, 3270, 5, 2),
(820, 3525, 5, 2),
(821, 3269, 5, 2),
(823, 3279, 5, 2),
(824, 3287, 5, 2),
(825, 3543, 5, 2),
(826, 3544, 5, 2),
(827, 3289, 5, 2),
(828, 3545, 5, 2),
(829, 3546, 5, 2),
(830, 3291, 5, 2),
(831, 3713, 3, 2),
(832, 3714, 3, 2),
(833, 3715, 3, 2),
(834, 3716, 3, 2),
(835, 3717, 5, 2),
(836, 3718, 5, 2),
(837, 3719, 5, 2),
(838, 3721, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(56) DEFAULT NULL,
  `password` varchar(56) CHARACTER SET utf8 DEFAULT NULL,
  `emailid` varchar(150) DEFAULT NULL,
  `companyseq` bigint(20) DEFAULT NULL,
  `customfieldvalues` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `isenabled` tinyint(4) DEFAULT NULL,
  `adminseq` bigint(20) DEFAULT NULL,
  `lastmodifiedon` datetime DEFAULT NULL,
  PRIMARY KEY (`seq`),
  UNIQUE KEY `username` (`username`),
  KEY `foreign_key01` (`companyseq`),
  KEY `foreign_user_admin` (`adminseq`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3722 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`seq`, `username`, `password`, `emailid`, `companyseq`, `customfieldvalues`, `createdon`, `isenabled`, `adminseq`, `lastmodifiedon`) VALUES
(3208, 'munishsethi777@gmail.com', '11111', 'munishsethi777@gmail.com', 2, 'firstName:Munish;lastName:Sethi;location:Ahmedabad;position:AREA+SALES+EXECUTIVE;department:DISTRIBUTION-DE+%26+COMPUTING;reportingManager:12;grade:E4;mobileNumber:123213213;userType:General;', '2015-08-13 11:25:36', 1, 2, '2016-01-27 17:21:00'),
(3209, 'saurabhniilm@gmail.com', 'sk@123', 'saurabhniilm@gmail.com', 2, 'firstName:Saurabh;lastName:Kapoor;location:Noida;position:Training+Manager;department:Nokia+;reportingManager:Ajay+Tyagi+;grade:P4;mobileNumber:9910305155;userType:General;', '2015-08-13 11:42:02', 1, 2, '2016-01-27 17:21:00'),
(3210, 'gulshaneyeslies@gmail.com', 'rahilbano123', 'gulshaneyeslies@gmail.com', 2, 'firstName:Gulshan_Test;lastName:Test;location:Delhi;position:ASSISTANT;department:DMS+HR;reportingManager:Aman;grade:KN;mobileNumber:9717304607;userType:Pride;', '2015-08-13 12:52:25', 1, 2, '2016-01-27 17:21:00'),
(3211, 'sannikumar.learntech@gmail.com', '1234', 'sannikumar.learntech@gmail.com', 2, 'firstName:Sanni+Test;lastName:Singh;location:Delhi;position:BRANCH+MANAGER;department:DISTRIBUTION-DE+%26+COMPUTING;reportingManager:a.k+;grade:KM;mobileNumber:9891464808;userType:Pride;', '2015-08-13 12:53:55', 1, 2, '2016-01-27 17:21:00'),
(3212, 'design@learntech.in', '1234', 'design@learntech.in', 2, 'firstName:Sanni+Test+non+pride;lastName:Singh;location:hauz+khas;position:manager;department:abc;reportingManager:ak;grade:b;mobileNumber:9891464808;userType:General;', '2015-08-13 12:57:42', 1, 2, '2016-01-27 17:21:00'),
(3213, 'saurabh.kapoor@hcl.com', 'hcl@123', 'saurabh.kapoor@hcl.com', 2, 'firstName:Saurabh;lastName:Kapoor;location:NOIDA;position:SENIOR+MANAGER;department:Human+Resource;reportingManager:Ajay+Tyagi+;grade:P4;mobileNumber:9910305155;userType:General;', '2015-08-14 06:17:14', 1, 2, '2016-01-27 17:21:00'),
(3214, 'xcv@hotmail.com', 'xcv@123', 'xcv@hotmail.com', 2, 'firstName:xcv;lastName:xcv;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:xcv;reportingManager:xcv;grade:P0;mobileNumber:9910305155;userType:General;', '2015-08-14 07:25:58', 1, 2, '2016-01-27 17:21:00'),
(3215, 'saurabh.goyal93@hcl.com', 'sona1993', 'saurabh.goyal93@hcl.com', 2, 'firstName:Saurabh;lastName:Goyal;location:NOIDA;position:CONSULTANT;department:Pre+Sales+-+ESSN;reportingManager:Shraddha+Nand+Mishra;grade:P1;mobileNumber:%2B919999952342;userType:General;', '2015-08-14 11:47:04', 1, 2, '2016-01-27 17:21:00'),
(3216, 'sagata.dasnath@gmail.com', 'sagatanath', 'sagata.dasnath@gmail.com', 2, 'firstName:Sagata;lastName:Nath;location:KOLKATA;position:SENIOR+EXECUTIVE;department:sales;reportingManager:Ranjan+Samanta;grade:X3;mobileNumber:9230519787;userType:General;', '2015-08-14 12:15:38', 1, 2, '2016-01-27 17:21:00'),
(3217, 'eminj1984@gmail.com', 'ezae.in', 'eminj1984@gmail.com', 2, 'firstName:Eric+;lastName:Minj;location:Bangalore;position:KEY+ACCOUNT+MANAGER;department:DISTRIBUTION-DE+%26+COMPUTING;reportingManager:Naveen+Kumar;grade:P4;mobileNumber:9742380005;userType:Pride;', '2015-08-14 18:28:11', 1, 2, '2016-01-27 17:21:00'),
(3218, 'danish.kagzi@hcl.com', 'danish@1986', 'danish.kagzi@hcl.com', 2, 'firstName:Danish;lastName:Kagzi;location:MUMBAI;position:ASSOCIATE+MANAGER;department:Enterprise+Distribution;reportingManager:Parimal+Borkar;grade:P3;mobileNumber:9833883615;userType:General;', '2015-08-15 12:12:30', 1, 2, '2016-01-27 17:21:00'),
(3219, 'deeptigrg@gmail.com', 'india2000', 'deeptigrg@gmail.com', 2, 'firstName:deepika;lastName:garg;location:NOIDA+SECTOR-11;position:SENIOR+EXECUTIVE+-+SALES;department:Digital+convergence;reportingManager:anil+george;grade:P2;mobileNumber:8373911217;userType:General;', '2015-08-17 06:45:28', 1, 2, '2016-01-27 17:21:00'),
(3220, 'nidhi.sapra@hcl.com', 'google@12', 'nidhi.sapra@hcl.com', 2, 'firstName:Nidhi;lastName:Sapra;location:NOIDA;position:MANAGER;department:Finance;reportingManager:Karan+Gupta;grade:P4;mobileNumber:9871106169;userType:General;', '2015-08-17 06:46:17', 1, 2, '2016-01-27 17:21:00'),
(3221, 'loveleen.talwar@hcl.com', 'ganesh711', 'loveleen.talwar@hcl.com', 2, 'firstName:Loveleen;lastName:Talwar;location:NOIDA+SECTOR-11;position:PRODUCT+MANAGER;department:Microsoft;reportingManager:Swati+Khanna;grade:P4;mobileNumber:8010670609;userType:General;', '2015-08-17 06:51:38', 1, 2, '2016-01-27 17:21:00'),
(3222, 'vivekananddell@gmail.com', 'india@1947', 'vivekananddell@gmail.com', 2, 'firstName:kumar;lastName:vivekanand;location:NOIDA+SECTOR-11;position:ASSOCIATE;department:Chain++%26++Bussiness;reportingManager:Ajay+Kumar;grade:P1;mobileNumber:9910704205;userType:General;', '2015-08-17 10:54:19', 1, 2, '2016-01-27 17:21:00'),
(3223, 'ashish.walia@hcl.com', 'awalia5', 'ashish.walia@hcl.com', 2, 'firstName:Ashish;lastName:Walia;location:NOIDA+SECTOR-11;position:SENIOR+EXECUTIVE;department:CBT;reportingManager:Sandeep+Kumar+Bhatia;grade:P2;mobileNumber:9654381916;userType:General;', '2015-08-17 17:12:21', 1, 2, '2016-01-27 17:21:00'),
(3224, 'reshmapatel12000@yahoo.com', 'zeeshan', 'reshmapatel12000@yahoo.com', 2, 'firstName:Reshma;lastName:Patel;location:NOIDA;position:BUSINESS+MANAGER;department:ESSN;reportingManager:Rajan+Sharma;grade:P5;mobileNumber:9819815361;userType:General;', '2015-08-18 12:56:53', 1, 2, '2016-01-27 17:21:00'),
(3225, 'gracioustangy@gmail.com', 'tarang', 'gracioustangy@gmail.com', 2, 'firstName:Tarang+;lastName:Seth;location:NOIDA+SECTOR-11;position:CONSULTANT;department:HR;reportingManager:Monika+Singh;grade:P0;mobileNumber:9811224608;userType:General;', '2015-08-18 17:10:01', 1, 2, '2016-01-27 17:21:00'),
(3226, 'malikjehangeer@gmail.com', 'sameer1111', 'malikjehangeer@gmail.com', 2, 'firstName:jehangeer;lastName:malik;location:Srinagar;position:ASSOCIATE;department:NOKIA-DEVICE;reportingManager:arshid+qureshi;grade:E4;mobileNumber:9622122786;userType:Pride;', '2015-08-19 04:52:50', 1, 2, '2016-01-27 17:21:00'),
(3227, 'arvindrawat.learntech@gmail.com', 'rahilbano123', 'arvindrawat.learntech@gmail.com', 2, 'firstName:Arvind;lastName:Rawat;location:Delhi;position:AREA+SALES+EXECUTIVE;department:DISTRIBUTION-DE+%26+COMPUTING;reportingManager:Gulshan;grade:E4;mobileNumber:9999999999;userType:Pride;', '2015-08-19 10:01:02', 1, 2, '2016-01-27 17:21:00'),
(3228, 'eric.minj@hcl.com', 'ezae.in', 'eric.minj@hcl.com', 2, 'firstName:Eric;lastName:Minj;location:Bangalore;position:KEY+ACCOUNT+MANAGER;department:CONSUMER+ELECTRONICS+%26+HOME+APPLIANCES;reportingManager:Naveen+Kumar;grade:E4;mobileNumber:9742380005;userType:Pride;', '2015-08-19 13:43:18', 1, 2, '2016-01-27 17:21:00'),
(3229, 'sankarananth.s@hcl.com', 'Iamlegend@82', 'sankarananth.s@hcl.com', 2, 'firstName:Sankar;lastName:Ananth;location:Bangalore;position:REGIONAL+MANAGER;department:DMS+COMMON;reportingManager:priyanka+priyadharshini;grade:P4;mobileNumber:9731704455;userType:Pride;', '2015-08-20 04:37:54', 1, 2, '2016-01-27 17:21:00'),
(3230, 'manoj.cpmnokia@gmail.com', 'saini2480', 'manoj.cpmnokia@gmail.com', 2, 'firstName:Manoj;lastName:Saini;location:Chandigarh;position:SALES+OFFICER;department:NOKIA-DEVICE;reportingManager:Sanjeev+Sharma;grade:KN;mobileNumber:9805311123;userType:Pride;', '2015-08-20 07:45:41', 1, 2, '2016-01-27 17:21:00'),
(3231, 'id@learntech.in', 'rahilbano123', 'id@learntech.in', 2, 'firstName:Gulshan_Test1;lastName:k;location:Delhi;position:ASSISTANT;department:DMS+COMMON;reportingManager:Sanni;grade:E4;mobileNumber:8888888888;userType:Pride;', '2015-08-20 08:37:52', 1, 2, '2016-01-27 17:21:00'),
(3232, 'puneet_20shrm@yahoo.com', 'aircel1234', 'puneet_20shrm@yahoo.com', 2, 'firstName:Puneet;lastName:Sharma;location:Chandigarh;position:ASSOCIATE;department:DISTRIBUTION-DE+%26+COMPUTING;reportingManager:sanjeev+sharma;grade:E4;mobileNumber:9857114196;userType:Pride;', '2015-08-22 07:53:29', 1, 2, '2016-01-27 17:21:00'),
(3233, 'satish.abhi@hcl.com', 'exch@2121', 'satish.abhi@hcl.com', 2, 'firstName:Satish;lastName:Abhishek;location:Patna;position:AREA+SALES+EXECUTIVE;department:NOKIA-DEVICE;reportingManager:Mr.+Naveen+Singh;grade:P4;mobileNumber:9631949145;userType:Pride;', '2015-08-28 08:02:52', 1, 2, '2016-01-27 17:21:00'),
(3234, 'abhijit033@gmail.com', 'Babin@007', 'abhijit033@gmail.com', 2, 'firstName:ABHIJIT;lastName:SARKAR;location:NOIDA;position:SENIOR+MANAGER;department:Enterprise+distribution;reportingManager:Bimal+Das;grade:P5;mobileNumber:9910677902;userType:General;', '2015-09-05 03:50:23', 1, 2, '2016-01-27 17:21:00'),
(3235, 'sunnygupta541@gmail.com', 'sam@5517', 'sunnygupta541@gmail.com', 2, 'firstName:Sandeep;lastName:Gupta;location:NOIDA;position:ASSISTANT+MANAGER;department:Enterprise+Distribution;reportingManager:Ms.+Swati+Khanna;grade:P3;mobileNumber:7503337463;userType:General;', '2015-09-05 07:22:47', 1, 2, '2016-01-27 17:21:00'),
(3236, 'c.saravana26@gmail.com', 'hclpwd123', 'c.saravana26@gmail.com', 2, 'firstName:SARAVANAKUMAR;lastName:CHANDRASEKARAN;location:CHENNAI;position:MANAGER+PRE+SALES;department:ESSN;reportingManager:Mr.+V+R+Karthikeyan;grade:P3;mobileNumber:9884443563;userType:General;', '2015-09-08 09:27:55', 1, 2, '2016-01-27 17:21:00'),
(3237, 'divya.pn@hcl.com', 'divyanair', 'divya.pn@hcl.com', 2, 'firstName:Divya;lastName:Nair;location:PUNE;position:SENIOR+EXECUTIVE;department:Enterprise+Distribution;reportingManager:Rahul+Gadam;grade:X2;mobileNumber:7774049414;userType:General;', '2015-09-09 11:37:07', 1, 2, '2016-01-27 17:21:00'),
(3238, 'deepti.chopra@hcl.in', 'deepti15', 'deepti.chopra@hcl.in', 2, 'firstName:deepti+;lastName:chopra;location:NOIDA+SECTOR-11;position:SENIOR+EXECUTIVE;department:enterprise+distribution+;reportingManager:bimal+das;grade:P3;mobileNumber:11011207;userType:General;', '2015-09-14 10:44:47', 1, 2, '2016-01-27 17:21:00'),
(3239, 'souma.kanti@hcl.com', 'monibha@22', 'souma.kanti@hcl.com', 2, 'firstName:Souma+Kanti;lastName:Mitra;location:KOLKATA;position:BUSINESS+DEVELOPMENT+MANAGER;department:EDS;reportingManager:Swati+Khanna;grade:P2;mobileNumber:8017990665;userType:General;', '2015-09-14 13:02:00', 1, 2, '2016-01-27 17:21:00'),
(3240, 'swati.gunsola@hcl.com', 'Swati@123', 'swati.gunsola@hcl.com', 2, 'firstName:SWATI;lastName:GUNSOLA;location:NOIDA+SECTOR-11;position:SENIOR+EXECUTIVE;department:MICROSOFT+INDIA;reportingManager:SWATI+KHANNA;grade:P2;mobileNumber:9958021080;userType:General;', '2015-09-14 15:28:15', 1, 2, '2016-01-27 17:21:00'),
(3241, 'chawla.puneet@hcl.com', 'Puneet@987', 'chawla.puneet@hcl.com', 2, 'firstName:Puneet;lastName:Chawla;location:NOIDA;position:BUSINESS+DEVELOPMENT+MANAGER;department:ED;reportingManager:Mukesh+Choudhary;grade:P4;mobileNumber:9953150709;userType:General;', '2015-09-14 16:54:06', 1, 2, '2016-01-27 17:21:00'),
(3242, 'waytoish@gmail.com', '1234567', 'waytoish@gmail.com', 2, 'firstName:Ishan;lastName:Narula;location:MUMBAI;position:AREA+SALES+MANAGER;department:IT+SALES;reportingManager:Mr.+Parimal+Borkar;grade:P3;mobileNumber:9617777746;userType:General;', '2015-09-14 19:06:40', 1, 2, '2016-01-27 17:21:00'),
(3243, 'deepesh.belwal@hcl.com', 'hcli@1989', 'deepesh.belwal@hcl.com', 2, 'firstName:DeepeshED;lastName:Belwal;location:NOIDA;position:SENIOR+EXECUTIVE;department:ED;reportingManager:Swati+Khanna;grade:P2;mobileNumber:7838410231;userType:General;', '2015-09-15 01:48:46', 1, 2, '2016-01-27 17:21:00'),
(3244, 'gulshan.db@gmail.com', 'rahilbano123', 'gulshan.db@gmail.com', 2, 'firstName:Gulshan+Kumar;lastName:Verma;location:DELHI;position:ASSISTANT;department:HCL;reportingManager:Sanni;grade:P3;mobileNumber:9717304607;userType:General;', '2015-09-15 09:05:02', 1, 2, '2016-01-27 17:21:00'),
(3245, 'gunjanguptaapj@gmail.com', 'hcl123', 'gunjanguptaapj@gmail.com', 2, 'firstName:Gunjan;lastName:Gupta;location:NOIDA;position:ASSISTANT+MANAGER;department:Operations+and+Procurement;reportingManager:Swati+Khanna;grade:P3;mobileNumber:9650432616;userType:General;', '2015-09-15 10:59:44', 1, 2, '2016-01-27 17:21:00'),
(3246, 'mangal.rakesh@yahoo.com', 'Rkm@2307', 'mangal.rakesh@yahoo.com', 2, 'firstName:Rakesh;lastName:Kumar;location:NOIDA;position:MANAGER+PRE+SALES;department:AVSI;reportingManager:Anil+George+Punnoose;grade:P4;mobileNumber:08285448888;userType:General;', '2015-09-15 16:47:18', 1, 2, '2016-01-27 17:21:00'),
(3247, 'gayatri.mehta@hcl.com', 'voda@1234', 'gayatri.mehta@hcl.com', 2, 'firstName:Gayatri;lastName:Mehta+Jain;location:MUMBAI;position:ACCOUNT+MANAGER;department:sales;reportingManager:parimal+borkar;grade:P3;mobileNumber:9930651009;userType:General;', '2015-09-16 06:22:09', 1, 2, '2016-01-27 17:21:00'),
(3248, 'deepti.chopra@hcl.com', 'deepti@15', 'deepti.chopra@hcl.com', 2, 'firstName:deepti;lastName:chopra;location:NOIDA+SECTOR-11;position:SENIOR+EXECUTIVE;department:Enterprise+distribution;reportingManager:Bimal+Das;grade:P3;mobileNumber:9810332180;userType:General;', '2015-09-16 06:24:41', 1, 2, '2016-01-27 17:21:00'),
(3249, 'simran.kaur@uidai.net.in', 'uidai', 'simran.kaur@uidai.net.in', 2, 'firstName:simran;lastName:k;location:DELHI;position:ASSOCIATE;department:Distribution;reportingManager:RT;grade:P0;mobileNumber:9876543210;userType:General;', '2015-09-23 05:06:42', 1, 2, '2016-01-27 17:21:00'),
(3250, 'armaan@gmail.com', 'armaan', 'armaan@gmail.com', 2, 'firstName:armaan;lastName:P;location:BANGALORE;position:ASSOCIATE+VICE+PRESIDENT;department:services;reportingManager:bimal;grade:P7;mobileNumber:9876523410;userType:General;', '2015-09-23 06:36:05', 1, 2, '2016-01-27 17:21:00'),
(3251, 'prachi.govil@hcl.com', 'prachigovil', 'prachi.govil@hcl.com', 2, 'firstName:Prachi;lastName:Govil;location:NOIDA;position:ASSISTANT+GENERAL+MANAGER;department:Human+Resource;reportingManager:Rajiv+Kumar;grade:P6;mobileNumber:9311867555;userType:General;', '2015-09-23 06:40:28', 1, 2, '2016-01-27 17:21:00'),
(3252, 'deepiagarwal20@gmail.com', 'deepi2010', 'deepiagarwal20@gmail.com', 2, 'firstName:Deepi;lastName:Agarwal;location:NOIDA+SECTOR-11;position:ASSOCIATE+MANAGER;department:Marketing;reportingManager:Nihit+Sharda;grade:P3;mobileNumber:9711609655;userType:General;', '2015-09-23 14:01:51', 1, 2, '2016-01-27 17:21:00'),
(3253, 'gaurav_gupta86@rocketmail.com', 'gaurav925700', 'gaurav_gupta86@rocketmail.com', 2, 'firstName:Gaurav+;lastName:Gupta;location:MUMBAI;position:AREA+SALES+MANAGER;department:Sales;reportingManager:Parimal+Krishna+Borkar;grade:P3;mobileNumber:986718460;userType:General;', '2015-09-28 17:07:58', 1, 2, '2016-01-27 17:21:00'),
(3254, 'prachisharma20885@gmail.com', 'sharma@123', 'prachisharma20885@gmail.com', 2, 'firstName:Prachi;lastName:Sharma;location:NOIDA;position:SENIOR+EXECUTIVE;department:Training+and+Development-HR;reportingManager:Jayanta+Chaudhari;grade:P2;mobileNumber:%2B919899960381;userType:General;', '2015-09-29 11:56:53', 1, 2, '2016-01-27 17:21:00'),
(3255, 'kirti.shukla@hcl.com', 'saibaba123', 'kirti.shukla@hcl.com', 2, 'firstName:Kirti;lastName:Shukla;location:NOIDA;position:SENIOR+EXECUTIVE;department:HR;reportingManager:Sherine+George;grade:P2;mobileNumber:8750869514;userType:General;', '2015-10-01 07:35:22', 1, 2, '2016-01-27 17:21:00'),
(3256, 'hetdshah@gmail.com', 'krishna1', 'hetdshah@gmail.com', 2, 'firstName:HETAL;lastName:WANI;location:AHEMDABAD;position:SENIOR+EXECUTIVE;department:ENTERPRISE+DISTRIBUTION;reportingManager:SAILEShailendra+Sarup;grade:X2;mobileNumber:9879505788;userType:General;', '2015-10-01 09:21:00', 1, 2, '2016-01-27 17:21:00'),
(3257, 'ancgoel@gmail.com', 'anchal@321', 'ancgoel@gmail.com', 2, 'firstName:ANCHAL+;lastName:GOEL;location:NOIDA+SECTOR-11;position:ASSISTANT+MANAGER;department:PRODUCT;reportingManager:Rohit+Rameshchandra+Arora;grade:P3;mobileNumber:9711074035;userType:General;', '2015-10-02 15:25:56', 1, 2, '2016-01-27 17:21:00'),
(3258, 'raj.shaktis@gmail.com', 'shakti@1980', 'raj.shaktis@gmail.com', 2, 'firstName:Shakti+Raj;lastName:Sharma;location:NOIDA;position:PRODUCT+MANAGER;department:enterprise+distribution;reportingManager:Rajan+Sharma;grade:P4;mobileNumber:9910037461;userType:General;', '2015-10-05 05:56:45', 1, 2, '2016-01-27 17:21:00'),
(3259, 'simran@gmail.com', 'simran', 'simran@gmail.com', 2, 'firstName:simran;lastName:K;location:NOIDA;position:SENIOR+MANAGER;department:HR;reportingManager:R;grade:P5;mobileNumber:9124365659;userType:General;', '2015-10-05 06:13:29', 1, 2, '2016-01-27 17:21:00'),
(3260, 'hardeep.r@hcl.com', 'forgot!296', 'hardeep.r@hcl.com', 2, 'firstName:Hardeep;lastName:Randhava;location:MUMBAI;position:ASSISTANT+MANAGER;department:HR;reportingManager:Sai+Preethi+Ramesh;grade:P3;mobileNumber:9920979953;userType:General;', '2015-10-06 07:18:57', 1, 2, '2016-01-27 17:21:00'),
(3261, 'arvindsinghrawat260@gmail.com', '9876', 'arvindsinghrawat260@gmail.com', 2, 'firstName:Arvind;lastName:Rawat;location:Delhi;position:ASSISTANT+GENERAL+MANAGER;department:DISTRIBUTION-DE+%26+COMPUTING;reportingManager:Gulshan;grade:E4;mobileNumber:8527524255;userType:Pride;', '2015-10-14 10:39:02', 1, 2, '2016-01-27 17:21:00'),
(3262, 'akshatha.learntech@gmail.com', '1234', 'akshatha.learntech@gmail.com', 2, 'firstName:Akshatha;lastName:Ganapathy;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:HR;reportingManager:Amandeep+Dubey;grade:P0;mobileNumber:9999216698;userType:General;', '2015-10-14 10:40:40', 1, 2, '2016-01-27 17:21:00'),
(3264, 'gulshan@gmail.com', '12345', 'gulshan@gmail.com', 2, 'firstName:Gulshan;lastName:Kumar;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:a;reportingManager:a;grade:P0;mobileNumber:aaaaaaaaaa;userType:General;', '2015-10-14 10:43:14', 1, 2, '2016-01-27 17:21:00'),
(3265, 'abc@gmail.com', '1234', 'abc@gmail.com', 2, 'firstName:Sanni;lastName:Singh;location:DELHI;position:AREA+SALES+EXECUTIVE;department:designer;reportingManager:gulshan;grade:P8;mobileNumber:981464808;userType:General;', '2015-10-14 10:43:15', 1, 2, '2016-01-27 17:21:00'),
(3266, 'gulshan1@gmail.com', '12345', 'gulshan1@gmail.com', 2, 'firstName:Gulshan_Sample;lastName:Sample;location:DELHI;position:AREA+SALES+MANAGER;department:Sales;reportingManager:Sanni;grade:P1;mobileNumber:91747474787;userType:General;', '2015-10-14 10:46:07', 1, 2, '2016-01-27 17:21:00'),
(3267, 'deepshikha308@gmail.com', 'ranu1234', 'deepshikha308@gmail.com', 2, 'firstName:Deepshikha;lastName:Pingle;location:INDORE;position:EXECUTIVE;department:Sales;reportingManager:Abhishar+shrivastava;grade:X1;mobileNumber:9039552136;userType:General;', '2015-10-15 12:17:45', 1, 2, '2016-01-27 17:21:00'),
(3268, 'priya.venkat@hcl.com', 'dollar', 'priya.venkat@hcl.com', 2, 'firstName:Priya+;lastName:Venkat;location:CHENNAI;position:JUNIOR+MANAGER;department:Learning+;reportingManager:Anand;grade:P4;mobileNumber:9840978487;userType:General;', '2015-10-15 13:28:48', 1, 2, '2016-01-27 17:21:00'),
(3269, 'hcl.aslam@gmail.com', 'digital24', 'hcl.aslam@gmail.com', 2, 'firstName:Mohammed;lastName:Aslam;location:COCHIN;position:ACCOUNT+MANAGER;department:EBU;reportingManager:Maninder+Pal+Singh;grade:P3;mobileNumber:09567765421;userType:General;', '2015-10-16 20:17:21', 1, 2, '2016-01-27 17:21:00'),
(3270, 'sibiraj.krishnan@gmail.com', 'sree', 'sibiraj.krishnan@gmail.com', 2, 'firstName:Sibiraj;lastName:Krishnan;location:COCHIN;position:BRANCH+MANAGER;department:Enterprise+Distribution;reportingManager:Maninder+Pal+Singh;grade:P4;mobileNumber:9895775872;userType:General;', '2015-10-16 23:00:14', 1, 2, '2016-01-27 17:21:00'),
(3271, 'prakhar.vashisht@hcl.com', 'Training@19', 'prakhar.vashisht@hcl.com', 2, 'firstName:Prakhar;lastName:Vashisht;location:NOIDA+SECTOR-11;position:ACCOUNT+MANAGER;department:Sales+and+Marketing;reportingManager:Vishal+Sawhney;grade:P4;mobileNumber:8527423865;userType:General;', '2015-10-17 23:56:31', 1, 2, '2016-01-27 17:21:00'),
(3272, 'aniket.das@hcl.com', 'aniket@1989', 'aniket.das@hcl.com', 2, 'firstName:Aniket+;lastName:Das;location:MUMBAI;position:AREA+SALES+MANAGER;department:ED;reportingManager:Parimal+Borkar;grade:P2;mobileNumber:7718993801;userType:General;', '2015-10-18 09:10:44', 1, 2, '2016-01-27 17:21:00'),
(3273, 'bhupesh.jaiswal@hcl.com', 'german', 'bhupesh.jaiswal@hcl.com', 2, 'firstName:Bhupesh;lastName:Jaiswal;location:NOIDA;position:MANAGER;department:HR;reportingManager:Sai+Preethi;grade:P4;mobileNumber:9910063437;userType:General;', '2015-10-18 18:06:21', 1, 2, '2016-01-27 17:21:00'),
(3274, 'GK@gmail.com', 'rahilbano123', 'GK@gmail.com', 2, 'firstName:Gulshan_Test;lastName:Kumar;location:DELHI;position:AREA+SALES+EXECUTIVE;department:Graphic;reportingManager:Sample;grade:P0;mobileNumber:1234567890;userType:General;', '2015-10-19 11:52:23', 1, 2, '2016-01-27 17:21:00'),
(3275, 'hr.tarunahuja@gmail.com', 'hhelibeb', 'hr.tarunahuja@gmail.com', 2, 'firstName:tarun;lastName:ahuja;location:NOIDA+SECTOR-11;position:EXECUTIVE+-+HR;department:HR;reportingManager:Sai+preethi+Ramesh;grade:P2;mobileNumber:9540098425;userType:General;', '2015-10-19 11:55:37', 1, 2, '2016-01-27 17:21:00'),
(3276, 'akshatha@gmail.com', '1234', 'akshatha@gmail.com', 2, 'firstName:Akshatha;lastName:Ganapathy;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:HR;reportingManager:Amandeep+Dubey;grade:P0;mobileNumber:9999219698;userType:General;', '2015-10-19 12:03:10', 1, 2, '2016-01-27 17:21:00'),
(3277, 'mehul.bhatthi@hcl.com', 'meh@2121', 'mehul.bhatthi@hcl.com', 2, 'firstName:Mehul;lastName:Bhatthi;location:AHEMDABAD;position:BRANCH+MANAGER;department:Sales;reportingManager:Mr.+Shailendra+Sarup;grade:P4;mobileNumber:9825196109;userType:General;', '2015-10-20 09:09:32', 1, 2, '2016-01-27 17:21:00'),
(3278, 'ag.learntech@gmail.com', '1234', 'ag.learntech@gmail.com', 2, 'firstName:Akshatha;lastName:Ganapathy;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:HR;reportingManager:Amandeep+dubey;grade:P0;mobileNumber:8465932991;userType:General;', '2015-10-20 14:37:12', 1, 2, '2016-01-27 17:21:00'),
(3279, 'agid.learntech@gmail.com', '1234', 'agid.learntech@gmail.com', 2, 'firstName:akshatha;lastName:ganapathy;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:HR;reportingManager:Amandeep+dubey;grade:P0;mobileNumber:8647459321;userType:General;', '2015-10-20 14:41:26', 1, 2, '2016-01-27 17:21:00'),
(3280, 'g@gmail.com', '12345', 'g@gmail.com', 2, 'firstName:Gulshan_Test+2;lastName:Test+2;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:Graphic;reportingManager:Sanni;grade:P0;mobileNumber:3232323322;userType:General;', '2015-10-20 14:48:42', 1, 2, '2016-01-27 17:21:00'),
(3281, 'shakti.raj@hcl.com', 'komal@1708', 'shakti.raj@hcl.com', 2, 'firstName:shakti+raj;lastName:sharma;location:NOIDA;position:PRODUCT+MANAGER;department:Enterprise+distribution;reportingManager:Rajan+Sharma;grade:P4;mobileNumber:9910037461;userType:General;', '2015-10-21 17:10:20', 1, 2, '2016-01-27 17:21:00'),
(3282, 'pramod.rg09@gmail.com', 'pramod19', 'pramod.rg09@gmail.com', 2, 'firstName:Pramood;lastName:RG;location:HUBLI;position:AREA+SALES+MANAGER;department:Sales;reportingManager:Prabhu+AJ;grade:P2;mobileNumber:9886665829;userType:General;', '2015-10-26 19:43:08', 1, 2, '2016-01-27 17:21:00'),
(3283, 'tanmayved@gmail.com', 'satansden123', 'tanmayved@gmail.com', 2, 'firstName:Tanmay;lastName:Ved;location:PUNE;position:ACCOUNT+MANAGER;department:Enterprise+Distribution;reportingManager:Rahul+Gadam;grade:P3;mobileNumber:9769369679;userType:General;', '2015-10-26 22:40:41', 1, 2, '2016-01-27 17:21:00'),
(3284, 'abhinandan.khatua@gmail.com', 'boxer123', 'abhinandan.khatua@gmail.com', 2, 'firstName:Abhinandan;lastName:Khatua;location:BHUBANESHWAR;position:AREA+SALES+MANAGER;department:Sales;reportingManager:Subir+Mahapatra;grade:P3;mobileNumber:9437960999;userType:General;', '2015-10-28 15:11:33', 1, 2, '2016-01-27 17:21:00'),
(3285, 'antrasharan@gmail.com', 'richa', 'antrasharan@gmail.com', 2, 'firstName:Antra;lastName:Sharan;location:NOIDA;position:EXECUTIVE+-+HR;department:Human+Resource;reportingManager:Jayanta+Chaudhuri;grade:P1;mobileNumber:8527018620;userType:General;', '2015-10-30 12:35:34', 1, 2, '2016-01-27 17:21:00'),
(3286, 'smrita.gupta@hcl.com', 'hcl@0987', 'smrita.gupta@hcl.com', 2, 'firstName:smrita+;lastName:gupta;location:NOIDA+SECTOR-11;position:AREA+SALES+EXECUTIVE;department:HR;reportingManager:subramanian;grade:P3;mobileNumber:8826577663;userType:General;', '2015-10-30 13:15:05', 1, 2, '2016-01-27 17:21:00'),
(3287, 'dheeraj.belwal@hcl.com', 'shaadi@11', 'dheeraj.belwal@hcl.com', 2, 'firstName:Dheeraj;lastName:Belwal;location:NOIDA;position:MANAGER;department:Human+resources;reportingManager:subramaniam+arumugam;grade:P4;mobileNumber:9560506292;userType:General;', '2015-10-30 14:51:34', 1, 2, '2016-01-27 17:21:00'),
(3288, 'mdowlamcom@gmail.com', 'dowla123', 'mdowlamcom@gmail.com', 2, 'firstName:Mahaboobdowla;lastName:S;location:Bangalore;position:ASSISTANT+MANAGER-FINANCE+%26+COMMERCIAL;department:DISTRIBUTION-DE+%26+COMPUTING;reportingManager:Rajiv+Puri;grade:X3;mobileNumber:9686862448;userType:Pride;', '2015-11-01 19:37:54', 1, 2, '2016-01-27 17:21:00'),
(3289, 'nabarup4u@gmail.com', 'rinku@143', 'nabarup4u@gmail.com', 2, 'firstName:NABARUP;lastName:CHAKRAVORTY;location:KOLKATA;position:REGIONAL+MANAGER;department:SALES;reportingManager:REGIONAL+SALES+DIRECTOR;grade:P4;mobileNumber:9674911052;userType:General;', '2015-11-13 08:03:40', 1, 2, '2016-01-27 17:21:00'),
(3290, 'ikramulatwork@gmail.com', 'hclinfo', 'ikramulatwork@gmail.com', 2, 'firstName:IKRAMUL;lastName:HUSSAIN;location:Guwahati;position:AREA+SALES+EXECUTIVE;department:DISTRIBUTION-DE+%26+COMPUTING;reportingManager:SWAKSHAR+CHAKRAVARTY;grade:P1;mobileNumber:9864883335;userType:Pride;', '2015-11-13 17:46:53', 1, 2, '2016-01-27 17:21:00'),
(3291, 'nilaykmajmudar@gmail.com', 'nilay_15', 'nilaykmajmudar@gmail.com', 2, 'firstName:Nilay;lastName:Majmudar;location:MUMBAI;position:BUSINESS+DEVELOPMENT+MANAGER;department:Sales;reportingManager:Shailendra+Swaroop;grade:P4;mobileNumber:9545552333;userType:General;', '2015-11-14 12:04:25', 1, 2, '2016-01-27 17:21:00'),
(3292, 'sanjay.deka12@yahoo.com', 'guwahati2010', 'sanjay.deka12@yahoo.com', 2, 'firstName:Sanjay;lastName:Deka;location:Guwahati;position:AREA+SALES+MANAGER;department:DISTRIBUTION-DE+%26+COMPUTING;reportingManager:Swakshar+Chakravarty;grade:P4;mobileNumber:9854053558;userType:Pride;', '2015-11-16 12:55:17', 1, 2, '2016-01-27 17:21:00'),
(3293, 'nitin.raj@hcl.com', 'testing', 'nitin.raj@hcl.com', 2, 'firstName:Nitin;lastName:Raj;location:DELHI;position:VICE+PRESIDENT;department:Marketing;reportingManager:Sumit+Bhattacharya;grade:P8;mobileNumber:9810571113;userType:General;', '2015-11-16 17:23:08', 1, 2, '2016-01-27 17:21:00'),
(3294, 'palak-assoc@hcl.com', 'palak.30', 'palak-assoc@hcl.com', 2, 'firstName:Palak;lastName:Mehta;location:NOIDA;position:SENIOR+ASSOCIATE;department:Enterprise+Distribution;reportingManager:Nihit+Sharda;grade:P0;mobileNumber:8130211655;userType:General;', '2015-11-17 22:17:49', 1, 2, '2016-01-27 17:21:00'),
(3295, 'amandeepdubey@gmail.com', '12345', 'amandeepdubey@gmail.com', 2, 'firstName:Aman+test;lastName:Dubey;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:Depart+;reportingManager:test+manager;grade:P0;mobileNumber:%2B919999219698;userType:General;', '2015-11-18 13:12:07', 1, 2, '2016-01-27 17:21:00'),
(3296, 'aks@gmail.com', '1234', 'aks@gmail.com', 2, 'firstName:Akshatha;lastName:Ganapathy;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:HR;reportingManager:Aman+Deep+Dubey;grade:P0;mobileNumber:293750294;userType:General;', '2015-11-18 13:52:31', 1, 2, '2016-01-27 17:21:00'),
(3297, 'arvi@gmail.com', '1234', 'arvi@gmail.com', 2, 'firstName:Arving;lastName:Singh+Rawat;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:HR;reportingManager:Aman+Deep+Dubey;grade:P0;mobileNumber:92385030886;userType:General;', '2015-11-18 14:00:30', 1, 2, '2016-01-27 17:21:00'),
(3298, 'arvind@gmail.com', '1234', 'arvind@gmail.com', 2, 'firstName:Arvind;lastName:Singh+Rawat;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:HR;reportingManager:Amandeep+Dubey;grade:P0;mobileNumber:7869038947;userType:General;', '2015-11-18 14:02:48', 1, 2, '2016-01-27 17:21:00'),
(3299, 'aksi@gmail.com', '1234', 'aksi@gmail.com', 2, 'firstName:Akshatha;lastName:Ganapathy;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:HR;reportingManager:Amandeep+Dubey;grade:P0;mobileNumber:8949937919;userType:General;', '2015-11-18 14:57:29', 1, 2, '2016-01-27 17:21:00'),
(3300, 'arvinds@gmail.com', '12345', 'arvinds@gmail.com', 2, 'firstName:arvind;lastName:rawat;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:adada;reportingManager:aman+deep+dubey;grade:P0;mobileNumber:5542955558;userType:General;', '2015-11-18 15:04:03', 1, 2, '2016-01-27 17:21:00'),
(3301, 'arvindr@gmail.in', '7894', 'arvindr@gmail.in', 2, 'firstName:Arvind;lastName:Rawat;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:Learntech;reportingManager:Aman;grade:P0;mobileNumber:9560056325;userType:General;', '2015-11-18 17:51:35', 1, 2, '2016-01-27 17:21:00'),
(3302, 'arvindf@gmail.com', '7896', 'arvindf@gmail.com', 2, 'firstName:Arvind;lastName:Rawat;location:BHOPAL;position:AREA+SALES+EXECUTIVE;department:Office;reportingManager:Aman+Deep+Dubey;grade:P0;mobileNumber:9868170132;userType:General;', '2015-11-19 17:41:51', 1, 2, '2016-01-27 17:21:00'),
(3303, 't.prasadrao@hcl.com', 'Toshiba@2121', 't.prasadrao@hcl.com', 2, 'firstName:tamada+prasad;lastName:rao;location:NOIDA;position:PRODUCT+MANAGER;department:OA+division;reportingManager:kishore+Krishnan;grade:P3;mobileNumber:8130988447;userType:General;', '2015-11-22 18:56:23', 1, 2, '2016-01-27 17:21:00'),
(3304, 'prasadraoar@yahoo.com', 'Toshiba@2121', 'prasadraoar@yahoo.com', 2, 'firstName:tamada+prasad;lastName:rao;location:NOIDA;position:PRODUCT+MANAGER;department:OA++division;reportingManager:kishore+krishnan;grade:P3;mobileNumber:8130988447;userType:General;', '2015-11-22 19:27:25', 1, 2, '2016-01-27 17:21:00'),
(3309, 'munish@learntech.in', '12345', 'munish@learntech.in', 2, 'firstName:Munish;lastName:Dubey;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:sales;reportingManager:Aman+Dubey;grade:P0;mobileNumber:101010101;userType:General;', '2015-11-26 16:56:06', 1, 2, '2016-01-27 17:21:00'),
(3310, 'sanni.singh91@gmail.com', '1234', 'sanni.singh91@gmail.com', 2, 'firstName:Sanni;lastName:Singh;location:Delhi;position:ASSISTANT+GENERAL+MANAGER;department:DISTRIBUTION-DE+%26+COMPUTING;reportingManager:Gulshan;grade:E4;mobileNumber:96891464808;userType:Pride;', '2015-11-26 17:10:33', 1, 2, '2016-01-27 17:21:00'),
(3311, 'G@abc.com', '123456', 'G@abc.com', 2, 'firstName:Gulshan_Test_New;lastName:T;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:Graphic;reportingManager:Sanni;grade:P0;mobileNumber:1212121212;userType:General;', '2015-11-26 18:23:14', 1, 2, '2016-01-27 17:21:00'),
(3312, 'chetna.soren@hcl.com', 'rukmoni19', 'chetna.soren@hcl.com', 2, 'firstName:Chetna;lastName:Soren;location:NOIDA+SECTOR-11;position:SENIOR+MANAGEMENT+TRAINEE;department:COrporate;reportingManager:Sumit+Bhaatacharya;grade:P4;mobileNumber:7042411966;userType:General;', '2015-11-27 17:05:27', 1, 2, '2016-01-27 17:21:00'),
(3316, 'shipra.gpt07@gmail.com', 'tarun@1234', 'shipra.gpt07@gmail.com', 2, 'firstName:shipra;lastName:gupta;location:JAIPUR;position:SENIOR+EXECUTIVE;department:Business+Enterprise;reportingManager:Ravindra+Singh;grade:X2;mobileNumber:9983480485;userType:General;', '2015-12-02 19:52:19', 1, 2, '2016-01-27 17:21:00'),
(3317, 'vivekgoel2005@yahoo.co.in', 'MOMdad@1986', 'vivekgoel2005@yahoo.co.in', 2, 'firstName:VIVEK;lastName:GOEL;location:NOIDA+SECTOR-11;position:ASSISTANT+MANAGER+-+PRESALES;department:ISS;reportingManager:Mr.+Shraddha+Nand+Misra;grade:P3;mobileNumber:9560122911;userType:General;', '2015-12-09 08:46:19', 1, 2, '2016-01-27 17:21:00'),
(3318, 'arya.meeta@gmail.com', 'meeta@hcl', 'arya.meeta@gmail.com', 2, 'firstName:Meeta;lastName:Arya;location:NOIDA+SECTOR-11;position:ACCOUNT+MANAGER;department:Sales;reportingManager:Vishal+Sawhney;grade:P4;mobileNumber:9650304541;userType:General;', '2015-12-09 15:03:30', 1, 2, '2016-01-27 17:21:00'),
(3319, 'rekunverma@gmail.com', '22716721', 'rekunverma@gmail.com', 2, 'firstName:Rekun;lastName:Verma;location:NOIDA+SECTOR-11;position:PRODUCT+MANAGER;department:ED;reportingManager:Mr.+Anil+George+Punnoose;grade:P4;mobileNumber:9582772222;userType:General;', '2015-12-09 23:01:45', 1, 2, '2016-01-27 17:21:00'),
(3321, 'antu_a2000@yahoo.co.in', 'Arup@123', 'antu_a2000@yahoo.co.in', 2, 'firstName:Arup;lastName:Chakraborty;location:HYDERABAD;position:ACCOUNT+MANAGER;department:Sales+%26+Marketing;reportingManager:Mr.+Thomas+PJ;grade:P3;mobileNumber:9949197733;userType:General;', '2015-12-17 20:04:22', 1, 2, '2016-01-27 17:21:00'),
(3322, 'ajay.singh2@hcl.com', 'Ajay@1987', 'ajay.singh2@hcl.com', 2, 'firstName:AJAY;lastName:SINGH;location:MUMBAI;position:ACCOUNT+MANAGER;department:Sales;reportingManager:Parimal+Krishna+Borkar;grade:P3;mobileNumber:7045350790;userType:General;', '2015-12-17 21:59:54', 1, 2, '2016-01-27 17:21:00'),
(3323, 'siva.vr@gmail.com', 'admin@123', 'siva.vr@gmail.com', 2, 'firstName:Sivaraman;lastName:V.R.;location:CHENNAI;position:MANAGER+PRE+SALES;department:ESD;reportingManager:V.R.+Karthikeyan;grade:P3;mobileNumber:9884069780;userType:General;', '2015-12-31 14:39:56', 1, 2, '2016-01-27 17:21:00'),
(3324, 'himanshugera4@gmail.com', 'Arnav@123', 'himanshugera4@gmail.com', 2, 'firstName:Himanshu;lastName:Gera;location:NOIDA;position:ASSISTANT+MANAGER;department:Finance;reportingManager:Dinesh+Chandak;grade:P3;mobileNumber:9711902565;userType:General;', '2016-01-03 18:17:46', 1, 2, '2016-01-27 17:21:00'),
(3325, 'jitender.thakur@hcl.com', 'hcl@124', 'jitender.thakur@hcl.com', 2, 'firstName:Jitender+;lastName:Thakur;location:CHANDIGARH;position:AREA+SALES+MANAGER;department:Nokia+DMS;reportingManager:Vikas+Kumar+Jha;grade:P3;mobileNumber:9736000725;userType:General;', '2016-01-05 11:28:31', 1, 2, '2016-01-27 17:21:00'),
(3326, 'taslim.tadvi@hcl.com', 'taslim123', 'taslim.tadvi@hcl.com', 2, 'firstName:Taslim;lastName:Tadvi;location:NOIDA;position:SENIOR+MANAGEMENT+TRAINEE;department:Corporate+Strategy;reportingManager:Sumit+Bhattacharya;grade:P4;mobileNumber:7042411866;userType:General;', '2016-01-05 12:40:07', 1, 2, '2016-01-27 17:21:00'),
(3327, 'dial2karthik@gmail.com', 'tn22ck5508', 'dial2karthik@gmail.com', 2, 'firstName:Karthik;lastName:Krishnaswamy;location:CHENNAI;position:ACCOUNT+MANAGER;department:Enterprise+Distribution;reportingManager:Mohan+Satagopan;grade:P3;mobileNumber:9840268779;userType:General;', '2016-01-06 00:07:58', 1, 2, '2016-01-27 17:21:00'),
(3328, 'abhishektripathi2326@gmail.com', '2323abhi', 'abhishektripathi2326@gmail.com', 2, 'firstName:abhishek;lastName:tripathi;location:MUMBAI;position:SALES+MANAGER;department:gear;reportingManager:mr%2C+himanshu;grade:P3;mobileNumber:8574245510;userType:General;', '2016-01-06 12:30:21', 1, 2, '2016-01-27 17:21:00'),
(3329, 'durganath.tiwari@hcl.com', 'durga@601', 'durganath.tiwari@hcl.com', 2, 'firstName:durganath;lastName:tiwari;location:MUMBAI;position:SENIOR+EXECUTIVE;department:sales;reportingManager:Parimal+Borkar;grade:P2;mobileNumber:7739593981;userType:General;', '2016-01-06 16:11:37', 1, 2, '2016-01-27 17:21:00'),
(3330, 'shivani.aggarwal@hcl.com', 'srishti', 'shivani.aggarwal@hcl.com', 2, 'firstName:Shvani;lastName:Aggarwal;location:NOIDA+SECTOR-11;position:EXECUTIVE+-+ACCOUNTS;department:DMS;reportingManager:Mr.+Madhusudan;grade:P1;mobileNumber:9999094989;userType:General;', '2016-01-08 11:31:02', 1, 2, '2016-01-27 17:21:00'),
(3331, 'manash.protim@hcl.com', 'hcl@135', 'manash.protim@hcl.com', 2, 'firstName:MANASH+PROTIM;lastName:BARUAH;location:GUWAHATI;position:AREA+SALES+EXECUTIVE;department:DMS;reportingManager:SWAKSHAR+CHAKRABARTY;grade:P1;mobileNumber:7086008672;userType:General;', '2016-01-08 13:17:19', 1, 2, '2016-01-27 17:21:00'),
(3332, 'jyoti.rekha@hcl.com', '9707052864', 'jyoti.rekha@hcl.com', 2, 'firstName:JYOTI+REKHA;lastName:BEZBARUAH;location:GUWAHATI;position:AREA+SALES+EXECUTIVE;department:DMS;reportingManager:SWAKSHAR+CHAKRAVARTY;grade:P1;mobileNumber:7086009797;userType:General;', '2016-01-08 13:55:57', 1, 2, '2016-01-27 17:21:00'),
(3333, 'priyagopal.shaw@hcl.com', 'priya@135', 'priyagopal.shaw@hcl.com', 2, 'firstName:Priyagopal;lastName:Shaw;location:KOLKATA;position:SENIOR+EXECUTIVE;department:DMS;reportingManager:Yugdeep+Khawas;grade:X2;mobileNumber:9903333336;userType:General;', '2016-01-09 09:58:08', 1, 2, '2016-01-27 17:21:00'),
(3334, 'kapiljaldawar@gmail.com', 'sairamkaps', 'kapiljaldawar@gmail.com', 2, 'firstName:kapil+;lastName:jaldawar;location:PUNE;position:AREA+SALES+MANAGER;department:Sales+;reportingManager:Rahul+Gadam;grade:P3;mobileNumber:9923920312;userType:General;', '2016-01-10 13:37:06', 1, 2, '2016-01-27 17:21:00'),
(3335, 'anand.rakesh@hcl.com', 'R0y@l@654321', 'anand.rakesh@hcl.com', 2, 'firstName:Rakesh;lastName:Anand;location:NOIDA+SECTOR-11;position:MANAGER+PRE+SALES;department:Enterprise+Distribution;reportingManager:Ms+Swati+Khanna;grade:P4;mobileNumber:%2B919971701270;userType:General;', '2016-01-11 10:30:33', 1, 2, '2016-01-27 17:21:00'),
(3336, 'suresh.svn@hcl.com', 'hcl@2015', 'suresh.svn@hcl.com', 2, 'firstName:suresh;lastName:s;location:COIMBATORE;position:AREA+SALES+EXECUTIVE;department:DMS;reportingManager:vp+balaji;grade:P2;mobileNumber:9003391033;userType:General;', '2016-01-11 18:10:40', 1, 2, '2016-01-27 17:21:00'),
(3337, 'shah.keyur@hcl.com', 'ziya1110', 'shah.keyur@hcl.com', 2, 'firstName:keyur;lastName:shah;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:nokia+device;reportingManager:amit+zha;grade:P2;mobileNumber:9099967111;userType:General;', '2016-01-11 18:27:06', 1, 2, '2016-01-27 17:21:00'),
(3338, 'varul.saigal@hcl.com', 'varul@12', 'varul.saigal@hcl.com', 2, 'firstName:Varul;lastName:Saigal;location:NOIDA;position:AREA+SALES+EXECUTIVE;department:DMS-Nokia;reportingManager:Vikram+Parashar;grade:P1;mobileNumber:8696297700;userType:General;', '2016-01-12 10:28:35', 1, 2, '2016-01-27 17:21:00'),
(3339, 'ankitgpta@hcl.com', 'hcli123', 'ankitgpta@hcl.com', 2, 'firstName:Ankit;lastName:Gupta;location:NOIDA+SECTOR-11;position:KEY+ACCOUNT+EXECUTIVE;department:DMD+-+Nokia;reportingManager:Rajesh+Malik;grade:P2;mobileNumber:9999140450;userType:General;', '2016-01-12 21:56:38', 1, 2, '2016-01-27 17:21:00'),
(3340, 'kratika.singh@hcl.com', 'krishna_94', 'kratika.singh@hcl.com', 2, 'firstName:Kratika;lastName:Singh;location:NOIDA+SECTOR-11;position:KEY+ACCOUNT+EXECUTIVE;department:DMS;reportingManager:Rajesh+Malik;grade:P1;mobileNumber:9971719549;userType:General;', '2016-01-13 22:05:14', 1, 2, '2016-01-27 17:21:00'),
(3341, 'subsahoo@gmail.com', 'P@$$w0rd', 'subsahoo@gmail.com', 2, 'firstName:SUBHASHIS;lastName:SAHOO;location:MUMBAI;position:MANAGER+PRE+SALES;department:Sales;reportingManager:Alok++Pradhan;grade:P4;mobileNumber:9845979278;userType:General;', '2016-01-14 16:42:50', 1, 2, '2016-01-27 17:21:00'),
(3342, 'tanveer.tali@gmail.com', 'spiccy@20', 'tanveer.tali@gmail.com', 2, 'firstName:TANVEER;lastName:TALI;location:CHANDIGARH;position:AREA+SALES+EXECUTIVE;department:General+Trade;reportingManager:Arshid+Qurashi;grade:P3;mobileNumber:09797710005;userType:General;', '2016-01-15 12:33:17', 1, 2, '2016-01-27 17:21:00'),
(3343, 'jithin.s@hcl.com', 'jith@72941', 'jithin.s@hcl.com', 2, 'firstName:Jithin;lastName:S+V;location:COCHIN;position:AREA+SALES+MANAGER;department:Sales;reportingManager:Varghese+Jacob;grade:P3;mobileNumber:9961389998;userType:General;', '2016-01-15 12:36:48', 1, 2, '2016-01-27 17:21:00'),
(3344, 'sanjeevsharma-assoc@hcl.com', 'sanj3232', 'sanjeevsharma-assoc@hcl.com', 2, 'firstName:Sanjeev;lastName:Sharma;location:LUCKNOW;position:SALES+EXECUTIVE;department:DMS;reportingManager:Musanna+Sir;grade:P0;mobileNumber:8353969030;userType:General;', '2016-01-15 13:09:08', 1, 2, '2016-01-27 17:21:00'),
(3345, 'supriya.paul@hcl.com', 'symbian123', 'supriya.paul@hcl.com', 2, 'firstName:Supriya;lastName:Paul;location:KOLKATA;position:AREA+SALES+EXECUTIVE;department:DMS;reportingManager:Amal+Ghosh;grade:P3;mobileNumber:09830049900;userType:General;', '2016-01-15 15:27:14', 1, 2, '2016-01-27 17:21:00'),
(3346, 'kumar.rajender-assoc@hcl.com', 'kum@2121', 'kumar.rajender-assoc@hcl.com', 2, 'firstName:rajender;lastName:kumar;location:UMO+RUDARPUR;position:SALES+EXECUTIVE;department:sales;reportingManager:gaurav+kumar;grade:X5;mobileNumber:9817678910;userType:General;', '2016-01-15 22:28:31', 1, 2, '2016-01-27 17:21:00'),
(3347, 'arup.chakraborty@hcl.com', 'Arup@123', 'arup.chakraborty@hcl.com', 2, 'firstName:Arup;lastName:Chakraborty;location:HYDERABAD;position:ACCOUNT+MANAGER;department:Sales;reportingManager:PJ+Thomas;grade:P3;mobileNumber:9949197733;userType:General;', '2016-01-17 19:37:37', 1, 2, '2016-01-27 17:21:00'),
(3348, 'Bhupendra.Singh-assoc@hcl.com', 'hcl@2323', 'Bhupendra.Singh-assoc@hcl.com', 2, 'firstName:Bhupendra+;lastName:singh;location:JAIPUR;position:SALES+EXECUTIVE;department:Nokia+dms;reportingManager:Ashish+sukala+;grade:P0;mobileNumber:9166666790;userType:General;', '2016-01-18 08:16:22', 1, 2, '2016-01-27 17:21:00'),
(3349, 'kr.pavan@hcl.com', 'hcli@1234', 'kr.pavan@hcl.com', 2, 'firstName:Pavan;lastName:Kumar;location:NOIDA+SECTOR-11;position:PRODUCT+MANAGER;department:DMS;reportingManager:Sagnik+Sen;grade:P3;mobileNumber:9910505206;userType:General;', '2016-01-18 12:34:40', 1, 2, '2016-01-27 17:21:00'),
(3350, 'sri.sudharsana@hcl.com', 'nikond530', 'sri.sudharsana@hcl.com', 2, 'firstName:SRISUDHARSANAGIRI;lastName:KR;location:CHENNAI;position:AREA+SALES+EXECUTIVE;department:NOKIA+DMS;reportingManager:MANIKAPRABHU;grade:P1;mobileNumber:9677773836;userType:General;', '2016-01-18 12:38:35', 1, 2, '2016-01-27 17:21:00'),
(3351, 'johnson.bhikhubhai@hcl.com', 'NewYork_05', 'johnson.bhikhubhai@hcl.com', 2, 'firstName:johnson;lastName:christian;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:dms+nokia;reportingManager:Vidhu+s+Trivedi+;grade:P1;mobileNumber:8347772012;userType:General;', '2016-01-18 12:41:51', 1, 2, '2016-01-27 17:21:00'),
(3352, 'shivam.saurabh@hcl.com', 'usha@9453', 'shivam.saurabh@hcl.com', 2, 'firstName:shivam;lastName:saurabh;location:BHOPAL;position:AREA+SALES+EXECUTIVE;department:DMS-+sales;reportingManager:hitesh+kumar+chouhan;grade:P1;mobileNumber:07275907339;userType:General;', '2016-01-18 12:44:18', 1, 2, '2016-01-27 17:21:00'),
(3353, 'himanshu.singh.84@gmail.com', 'himanshu229', 'himanshu.singh.84@gmail.com', 2, 'firstName:Himanshu;lastName:Singh;location:NOIDA;position:ASSISTANT+MANAGER;department:PLANNING+-+DMS;reportingManager:Sagnik+Sen+;grade:P3;mobileNumber:919958897892;userType:General;', '2016-01-18 12:44:51', 1, 2, '2016-01-27 17:21:00'),
(3354, 'achal.maloo@hcl.com', 'newbeg16!', 'achal.maloo@hcl.com', 2, 'firstName:Achal;lastName:Maloo;location:NAGPUR;position:BRANCH+MANAGER;department:Nokia-+Device;reportingManager:Himanshu+Shekhar+Niraj;grade:P5;mobileNumber:7597948107;userType:General;', '2016-01-18 12:45:17', 1, 2, '2016-01-27 17:21:00'),
(3355, 'naveen.sharma-assoc@hcl.com', 'Naveen@321', 'naveen.sharma-assoc@hcl.com', 2, 'firstName:Naveen;lastName:Sharma;location:JAIPUR;position:SALES+CO-ORDINATOR;department:Nokia+DMS;reportingManager:Vikram+Parashar;grade:P0;mobileNumber:9610087076;userType:General;', '2016-01-18 12:49:21', 1, 2, '2016-01-27 17:21:00'),
(3356, 'ulaganathan.m@hcl.com', 'dec@2015', 'ulaganathan.m@hcl.com', 2, 'firstName:ULAGANATHAN;lastName:M;location:CHENNAI;position:BRANCH+SALES+OPERATIONS+MANAGER;department:NOKIA+DMS;reportingManager:MANICKA+PRABHU;grade:P4;mobileNumber:9894734043;userType:General;', '2016-01-18 12:51:08', 1, 2, '2016-01-27 17:21:00'),
(3357, 'md.nazmuddin@hcl.com', 'nazmuddin12', 'md.nazmuddin@hcl.com', 2, 'firstName:Md;lastName:Nazmuddin;location:NOIDA+SECTOR-11;position:DEPUTY+MANAGER;department:Finance;reportingManager:Anuj+Minocha;grade:X4;mobileNumber:9810705658;userType:General;', '2016-01-18 12:53:17', 1, 2, '2016-01-27 17:21:00'),
(3358, 'SANJEEV.SARAF@HCL.COM', 'ishu@135', 'SANJEEV.SARAF@HCL.COM', 2, 'firstName:SANJEEV;lastName:SARAF;location:NOIDA;position:SENIOR+MANAGER;department:FINANCE;reportingManager:DEEPAK+JAJODIA;grade:P6;mobileNumber:9971666934;userType:General;', '2016-01-18 12:55:25', 1, 2, '2016-01-27 17:21:00'),
(3359, 'design@textmail.com', '123456', 'design@textmail.com', 2, 'firstName:test;lastName:Kumar;location:Ahmedabad;position:AREA+SALES+EXECUTIVE;department:DISTRIBUTION-DE+%26+COMPUTING;reportingManager:Sanni;grade:E4;mobileNumber:9717304622;userType:Pride;', '2016-01-18 12:59:56', 1, 2, '2016-01-27 17:21:00'),
(3360, 'test@testmail.com', '123456', 'test@testmail.com', 2, 'firstName:test2;lastName:Kumar;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:s;reportingManager:sa;grade:P0;mobileNumber:123123123;userType:General;', '2016-01-18 13:02:02', 1, 2, '2016-01-27 17:21:00'),
(3361, 'juned.khan@hcl.com', 'priyanka*11', 'juned.khan@hcl.com', 2, 'firstName:Juned+;lastName:Khan;location:LUCKNOW;position:MANAGER+-+SALES;department:DMS;reportingManager:Mr+S+Musanna;grade:P3;mobileNumber:7897554445;userType:General;', '2016-01-18 13:05:01', 1, 2, '2016-01-27 17:21:00'),
(3362, 'gagandeep.oberoi@hcl.com', 'Lovecity@13', 'gagandeep.oberoi@hcl.com', 2, 'firstName:Gagandeep+Singh;lastName:Oberoi;location:NOIDA+-+DDMS;position:SALES+MANAGER;department:DDMS-Nokia+Gears;reportingManager:Dheeraj+Joshi;grade:P3;mobileNumber:9810507134;userType:General;', '2016-01-18 13:07:10', 1, 2, '2016-01-27 17:21:00'),
(3363, 'aman@learntech.in', '1234', 'aman@learntech.in', 2, 'firstName:Amanda;lastName:Dubey;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:23;reportingManager:23e4;grade:P0;mobileNumber:09999219698;userType:General;', '2016-01-18 13:14:38', 1, 2, '2016-01-27 17:21:00'),
(3364, 'rajinder.ksharma10@gmail.com', 'rajinder10', 'rajinder.ksharma10@gmail.com', 2, 'firstName:rajender;lastName:kumar;location:DEHRADUN;position:ASSOCIATE;department:dms;reportingManager:vikram+parashar;grade:P0;mobileNumber:9817678910;userType:General;', '2016-01-18 13:34:05', 1, 2, '2016-01-27 17:21:00'),
(3365, 'bhavyesh.mukesh@hcl.com', 'bhavyesh21', 'bhavyesh.mukesh@hcl.com', 2, 'firstName:Bhavyesh+;lastName:Bhatt;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:NOKIA+DMS;reportingManager:vidhu+s+trivedi;grade:P1;mobileNumber:8511333391;userType:General;', '2016-01-18 13:56:21', 1, 2, '2016-01-27 17:21:00'),
(3366, 'kmprabhu@hcl.com', 'Prabhu@79', 'kmprabhu@hcl.com', 2, 'firstName:Manicka;lastName:Prabhu;location:CHENNAI;position:BRANCH+MANAGER;department:Consumer+business;reportingManager:Dean+George;grade:P5;mobileNumber:9840594540;userType:General;', '2016-01-18 13:59:08', 1, 2, '2016-01-27 17:21:00'),
(3367, 'arunbabu@hcl.com', 'arun12!', 'arunbabu@hcl.com', 2, 'firstName:ARUN+BABU;lastName:SELVARAJU;location:CHENNAI;position:ASSISTANT+MANAGER;department:Nokia+DMS;reportingManager:Manicka+Prabhu;grade:P3;mobileNumber:9600025906;userType:General;', '2016-01-18 14:16:19', 1, 2, '2016-01-27 17:21:00'),
(3368, 'rajamax9@gmail.com', 'royal@1234', 'rajamax9@gmail.com', 2, 'firstName:Ranjan+Kumar;lastName:Jaiswal;location:NOIDA;position:ASSISTANT+MANAGER;department:DMS;reportingManager:Yugdeep+Khawas;grade:X3;mobileNumber:9953288018;userType:General;', '2016-01-18 14:36:07', 1, 2, '2016-01-27 17:21:00'),
(3369, 'ranjan.jaiswal@hcl.com', 'royal@1234', 'ranjan.jaiswal@hcl.com', 2, 'firstName:Ranjan+Kumar;lastName:Jaiswal;location:NOIDA;position:ASSISTANT+MANAGER;department:DMS;reportingManager:Yugdeep+Khawas;grade:X3;mobileNumber:9953288018;userType:General;', '2016-01-18 14:41:27', 1, 2, '2016-01-27 17:21:00'),
(3370, 's.ehtisham@hcl.com', 'varisha@575', 's.ehtisham@hcl.com', 2, 'firstName:Syed;lastName:Ehtisham+Musanna;location:LUCKNOW;position:AREA+SALES+EXECUTIVE;department:DMS;reportingManager:Heemanshu+Kumar+Sinha;grade:P3;mobileNumber:9198997771;userType:General;', '2016-01-18 14:56:50', 1, 2, '2016-01-27 17:21:00'),
(3371, 'rohan.dubey@hcl.com', 'devkiran', 'rohan.dubey@hcl.com', 2, 'firstName:rohan;lastName:dubey;location:LUCKNOW;position:ASSISTANT+MANAGER;department:marketing;reportingManager:Heemanshu+sinha;grade:P3;mobileNumber:9956066196;userType:General;', '2016-01-18 14:59:30', 1, 2, '2016-01-27 17:21:00'),
(3372, 'kumar.ajit@hcl.com', 'rinki@123', 'kumar.ajit@hcl.com', 2, 'firstName:AJIT+KUMAR;lastName:VISVAKARMA;location:LUCKNOW;position:MANAGER+-+MARKETING;department:NOKIA;reportingManager:S.E.Musanna;grade:P3;mobileNumber:9695308882;userType:General;', '2016-01-18 15:03:34', 1, 2, '2016-01-27 17:21:00'),
(3373, 'renu.sharma@hcl.com', 'hcli@471', 'renu.sharma@hcl.com', 2, 'firstName:Renu;lastName:Sharma;location:NOIDA+SECTOR-11;position:SENIOR+EXECUTIVE;department:DMS+Finance+%26+Accounts;reportingManager:Shashank+Jain;grade:P2;mobileNumber:9910220683;userType:General;', '2016-01-18 15:11:31', 1, 2, '2016-01-27 17:21:00'),
(3374, 'ojt-rita.dwivedi@hcl.com', 'dwivedi@01', 'ojt-rita.dwivedi@hcl.com', 2, 'firstName:Rita;lastName:Dwivedi;location:NOIDA+SECTOR-11;position:ASSOCIATE;department:DMS;reportingManager:Shshank+Jain;grade:P0;mobileNumber:8826181456;userType:General;', '2016-01-18 15:13:50', 1, 2, '2016-01-27 17:21:00'),
(3375, 'vinod.singh-assoc@hcl.com', 'ashtonsubba', 'vinod.singh-assoc@hcl.com', 2, 'firstName:Vinod;lastName:Singh;location:LUCKNOW;position:SALES+CO-ORDINATOR;department:DMS+Nokia;reportingManager:SE+Musanna;grade:X3;mobileNumber:9670113113;userType:General;', '2016-01-18 15:17:26', 1, 2, '2016-01-27 17:21:00'),
(3376, 'rajkumar.h@hcl.com', 'rajesh123', 'rajkumar.h@hcl.com', 2, 'firstName:Rajkumar;lastName:Sharma;location:BANGALORE;position:MANAGER;department:NOKIA+DEVICE;reportingManager:SAGNIK+SEN;grade:P4;mobileNumber:9008025303;userType:General;', '2016-01-18 15:32:55', 1, 2, '2016-01-27 17:21:00'),
(3377, 'krishna.prakash-assoc@hcl.com', 'kris4845', 'krishna.prakash-assoc@hcl.com', 2, 'firstName:Krishna;lastName:Prakash;location:LUCKNOW;position:ASSOCIATE;department:dms;reportingManager:s.musanna;grade:P0;mobileNumber:9839870470;userType:General;', '2016-01-18 16:03:32', 1, 2, '2016-01-27 17:21:00');
INSERT INTO `users` (`seq`, `username`, `password`, `emailid`, `companyseq`, `customfieldvalues`, `createdon`, `isenabled`, `adminseq`, `lastmodifiedon`) VALUES
(3378, 'fazal.mateen@hcl.com', 'salman@123', 'fazal.mateen@hcl.com', 2, 'firstName:Fazal;lastName:Mateen;location:LUCKNOW;position:SALES+MANAGER;department:DMS;reportingManager:Syed+Ehtisham+Musanna;grade:P3;mobileNumber:9935435666;userType:General;', '2016-01-18 16:05:06', 1, 2, '2016-01-27 17:21:00'),
(3379, 'himangshu_99@yahoo.co.in', 'prabhat', 'himangshu_99@yahoo.co.in', 2, 'firstName:himangshu;lastName:barman;location:GUWAHATI;position:ASSOCIATE;department:nokia+device;reportingManager:swaskar+chakrabarty;grade:P0;mobileNumber:8811089021;userType:General;', '2016-01-18 16:16:34', 1, 2, '2016-01-27 17:21:00'),
(3380, 'satheesh.kmr@hcl.com', 'charus16', 'satheesh.kmr@hcl.com', 2, 'firstName:Satheesh;lastName:Kumar;location:CHENNAI;position:AREA+SALES+MANAGER;department:Sales;reportingManager:Branch+Manager;grade:P4;mobileNumber:9790009730;userType:General;', '2016-01-18 16:36:07', 1, 2, '2016-01-27 17:21:00'),
(3381, 'prakash.avs@hcl.com', 'arjarapu', 'prakash.avs@hcl.com', 2, 'firstName:Arjarapu+Venkata+SUrya;lastName:Prakash;location:BANGALORE;position:AREA+SALES+EXECUTIVE;department:DMS;reportingManager:Dean+Isaac+George;grade:P5;mobileNumber:9246309273;userType:General;', '2016-01-18 16:58:28', 1, 2, '2016-01-27 17:21:00'),
(3382, 'sri.sudharshana@hcl.cim', 'nikond530', 'sri.sudharshana@hcl.cim', 2, 'firstName:SRISUDHARSANAGIRI;lastName:KR;location:CHENNAI;position:AREA+SALES+EXECUTIVE;department:NOKIA+DMS;reportingManager:MANIKA+PRABHU;grade:P1;mobileNumber:9677773836;userType:General;', '2016-01-18 17:05:42', 1, 2, '2016-01-27 17:21:00'),
(3383, 'anant.jeet-assoc@hcl.com', 'Jppandey04', 'anant.jeet-assoc@hcl.com', 2, 'firstName:Anant;lastName:Anand;location:LUCKNOW;position:ASSOCIATE+MANAGER+-+SALES;department:General+Trade;reportingManager:Mr.+S+Ehtisham+Musanna;grade:P0;mobileNumber:9936679996;userType:General;', '2016-01-18 17:09:01', 1, 2, '2016-01-27 17:21:00'),
(3384, 'ebin.varghese@hcl.com', 'yamaha@135', 'ebin.varghese@hcl.com', 2, 'firstName:EBIN;lastName:VARGHESE;location:COCHIN;position:AREA+SALES+EXECUTIVE;department:DMS+NOKIA;reportingManager:DILIP+AC;grade:P2;mobileNumber:8589999978;userType:General;', '2016-01-18 17:14:27', 1, 2, '2016-01-27 17:21:00'),
(3385, 'rajinder.kumar-assoc@hcl.com', 'aarohi@123', 'rajinder.kumar-assoc@hcl.com', 2, 'firstName:Rajinder;lastName:Kumar;location:CHANDIGARH;position:SALES+EXECUTIVE;department:DMS;reportingManager:Mr+Sanjeev+Sharma;grade:P0;mobileNumber:9318035000;userType:General;', '2016-01-18 17:18:58', 1, 2, '2016-01-27 17:21:00'),
(3386, 'vp.balaji@hcl.com', 'bala@1234', 'vp.balaji@hcl.com', 2, 'firstName:Balaji;lastName:VP;location:COIMBATORE;position:AREA+SALES+MANAGER;department:DMS;reportingManager:K+Manicka+Prabhu;grade:P4;mobileNumber:9600971933;userType:General;', '2016-01-18 17:28:02', 1, 2, '2016-01-27 17:21:00'),
(3387, 'arul.selvan@hcl.com', 'dell@123', 'arul.selvan@hcl.com', 2, 'firstName:V+;lastName:Arulselvan;location:CHENNAI;position:SALES+MANAGER;department:Nokia+-+Device;reportingManager:Manicka+Prabhu;grade:P3;mobileNumber:9500888857;userType:General;', '2016-01-18 17:43:36', 1, 2, '2016-01-27 17:21:00'),
(3388, 'anuj.minocha@hcl.com', 'great@987', 'anuj.minocha@hcl.com', 2, 'firstName:Anuj;lastName:Minocha;location:NOIDA+SECTOR-11;position:MANAGER+-+ACCOUNTS;department:DMS;reportingManager:Sanjeev+Saraf;grade:P4;mobileNumber:9811757647;userType:General;', '2016-01-18 19:29:33', 1, 2, '2016-01-27 17:21:00'),
(3389, 'zameer_lko@rediffmail.com', 'zameer@123', 'zameer_lko@rediffmail.com', 2, 'firstName:MOHAMMAD+ZAMEER;lastName:SIDDIQUI;location:LUCKNOW;position:ASSOCIATE+MANAGER+-+SALES;department:MICROSOFT+MOBILE+DIVISION;reportingManager:FAZAL+MATEEN;grade:P0;mobileNumber:9956382221;userType:General;', '2016-01-18 19:46:14', 1, 2, '2016-01-27 17:21:00'),
(3390, 'naveen@hcl.com', 'tn25z8047', 'naveen@hcl.com', 2, 'firstName:Naveen+Kumar+;lastName:S;location:CHENNAI;position:SALES+MANAGER;department:Attach+Business;reportingManager:Mr.+Manicka+Prabhu;grade:P3;mobileNumber:98404046369;userType:General;', '2016-01-18 19:51:35', 1, 2, '2016-01-27 17:21:00'),
(3391, 'lajiba@gmail.com', 'vtamilselvii', 'lajiba@gmail.com', 2, 'firstName:balaji;lastName:vp;location:COIMBATORE;position:AREA+SALES+MANAGER;department:DMS+Nokia;reportingManager:k+Manicka+prabhu;grade:P4;mobileNumber:09942354000;userType:General;', '2016-01-18 19:51:56', 1, 2, '2016-01-27 17:21:00'),
(3392, 'abhishekreddy.t@outlook.com', 'ABHIvin*501', 'abhishekreddy.t@outlook.com', 2, 'firstName:Abhishek;lastName:Reddy;location:NOIDA;position:SENIOR+EXECUTIVE;department:IT;reportingManager:Mr.+Pavan+Jai+Jha;grade:P2;mobileNumber:09611557779;userType:General;', '2016-01-18 20:42:03', 1, 2, '2016-01-27 17:21:00'),
(3393, 'SRI.SUDHARSHANA@HCL.COM', 'nikond530', 'SRI.SUDHARSHANA@HCL.COM', 2, 'firstName:SRISUDHARSANAGIRI;lastName:KR;location:CHENNAI;position:AREA+SALES+EXECUTIVE;department:NOKIA+DMS;reportingManager:MANIKA+PRABHU;grade:P1;mobileNumber:9677773836;userType:General;', '2016-01-18 21:04:03', 1, 2, '2016-01-27 17:21:00'),
(3394, 'abhishake.koul@hcl.com', 'Akkoul@87', 'abhishake.koul@hcl.com', 2, 'firstName:Abhishake;lastName:koul;location:CHANDIGARH;position:SALES+MANAGER;department:DMS;reportingManager:Arshid+ahmad;grade:P3;mobileNumber:9906336031;userType:General;', '2016-01-18 22:19:50', 1, 2, '2016-01-27 17:21:00'),
(3395, 'raktim.ghosh@hcl.com', 'yvessaint', 'raktim.ghosh@hcl.com', 2, 'firstName:Raktim;lastName:Ghosh;location:KOLKATA;position:AREA+SALES+EXECUTIVE;department:DMS;reportingManager:Amal+Ghosh;grade:P2;mobileNumber:9831176143;userType:General;', '2016-01-18 23:54:26', 1, 2, '2016-01-27 17:21:00'),
(3396, 'jacob.varghese@hcl.com', 'jacob@815', 'jacob.varghese@hcl.com', 2, 'firstName:Varghese;lastName:Jacob;location:COCHIN;position:BRANCH+MANAGER;department:DMS;reportingManager:Dean+George;grade:P5;mobileNumber:9895327733;userType:General;', '2016-01-19 09:40:25', 1, 2, '2016-01-27 17:21:00'),
(3397, 'rawat.ritu@hcl.com', 'RemembeR', 'rawat.ritu@hcl.com', 2, 'firstName:Ritu;lastName:Rawat;location:NOIDA;position:ASSISTANT;department:DMS;reportingManager:Sutikshan+Naithani;grade:X3;mobileNumber:8800499744;userType:General;', '2016-01-19 10:04:56', 1, 2, '2016-01-27 17:21:00'),
(3398, 'tamal.ghosal@hcl.com', 'tama@108', 'tamal.ghosal@hcl.com', 2, 'firstName:TAMAL;lastName:GHOSAL;location:KOLKATA;position:MANAGER;department:HUMAN+RESOURCES;reportingManager:PRIYANKA+PRIYADARSHINI;grade:P5;mobileNumber:8585021255;userType:General;', '2016-01-19 11:29:19', 1, 2, '2016-01-27 17:21:00'),
(3399, 'debojo.rajeev@hcl.com', 'debo4512', 'debojo.rajeev@hcl.com', 2, 'firstName:Debojo;lastName:Rajeev;location:KOLKATA;position:BRANCH+MANAGER;department:DMS;reportingManager:Heemanshu+Kumar+Sinha;grade:P5;mobileNumber:9903815000;userType:General;', '2016-01-19 12:03:18', 1, 2, '2016-01-27 17:21:00'),
(3400, 'd.john@hcl.com', 'john4514', 'd.john@hcl.com', 2, 'firstName:John;lastName:Thoppil;location:BANGALORE;position:AREA+SALES+EXECUTIVE;department:SALES;reportingManager:P+Sesha+Sai+Srinivas;grade:P2;mobileNumber:9500172849;userType:General;', '2016-01-19 12:05:58', 1, 2, '2016-01-27 17:21:00'),
(3401, 'sisir.koley@hcl.com', 'hcl@123', 'sisir.koley@hcl.com', 2, 'firstName:Sisir+kumar;lastName:Kumar;location:NOIDA+SECTOR-11;position:DEPUTY+MANAGER;department:Accounts+;reportingManager:Virender+Pasricha+;grade:P4;mobileNumber:9811046265+;userType:General;', '2016-01-19 12:17:48', 1, 2, '2016-01-27 17:21:00'),
(3402, 'dennis.mathew@hcl.com', 'gr8promise', 'dennis.mathew@hcl.com', 2, 'firstName:DENNIS;lastName:Mathew+;location:BANGALORE;position:KEY+ACCOUNT+MANAGER;department:DMS;reportingManager:Amit+Chaturvedi+;grade:P5;mobileNumber:9591964964;userType:General;', '2016-01-19 12:29:40', 1, 2, '2016-01-27 17:21:00'),
(3403, 'pankajmilu@gmail.com', 'pankaj100', 'pankajmilu@gmail.com', 2, 'firstName:Pankaj;lastName:Behera;location:BHUBANESHWAR;position:ASSOCIATE;department:DMS;reportingManager:Amit+Jha;grade:P0;mobileNumber:7894426824;userType:General;', '2016-01-19 12:41:39', 1, 2, '2016-01-27 17:21:00'),
(3404, 'msanthosh@hcl.com', 'CL@ss2014', 'msanthosh@hcl.com', 2, 'firstName:Santhosh;lastName:Mathew+M;location:COCHIN;position:MANAGER+-+MARKETING;department:Marketing;reportingManager:Varghese+Jacob;grade:P3;mobileNumber:9567350678;userType:General;', '2016-01-19 12:43:43', 1, 2, '2016-01-27 17:21:00'),
(3405, 'chittranjan.kumar-assoc@hcl.com', 'chitt@1986', 'chittranjan.kumar-assoc@hcl.com', 2, 'firstName:Chittranjan;lastName:Singh;location:RANCHI;position:SALES+CO-ORDINATOR;department:Nokia+DMS;reportingManager:Ravi+Rai;grade:P0;mobileNumber:7766916740;userType:General;', '2016-01-19 12:48:08', 1, 2, '2016-01-27 17:21:00'),
(3406, 'ghosh.sudeep@hcl.com', 'nokia12@', 'ghosh.sudeep@hcl.com', 2, 'firstName:SUDEEP;lastName:GHOSH;location:RANCHI;position:AREA+SALES+MANAGER;department:DMS;reportingManager:HEEMANSHU+KUMAR+SINHA;grade:P3;mobileNumber:7781018079;userType:General;', '2016-01-19 12:49:13', 1, 2, '2016-01-27 17:21:00'),
(3407, 'soumitra.bhandary@hcl.com', 'soumitra1985', 'soumitra.bhandary@hcl.com', 2, 'firstName:SOUMITRA;lastName:BHANDARY;location:KOLKATA;position:EXECUTIVE;department:SUPPLY+CHAIN;reportingManager:SANJIB+SEN;grade:X2;mobileNumber:08585023075;userType:General;', '2016-01-19 13:14:52', 1, 2, '2016-01-27 17:21:00'),
(3408, 'sanjib.sen@hcl.com', 'san6789', 'sanjib.sen@hcl.com', 2, 'firstName:Sanjib;lastName:Sen;location:AHEMDABAD;position:REGIONAL+MANAGER;department:Supply+Chain;reportingManager:Devesh+Shankar;grade:P3;mobileNumber:9903062915;userType:General;', '2016-01-19 13:19:00', 1, 2, '2016-01-27 17:21:00'),
(3409, 'sunil.bansal-assoc@hcl.com', 'sunil@7745', 'sunil.bansal-assoc@hcl.com', 2, 'firstName:sunil;lastName:bansal;location:RAJASTHAN;position:ASSOCIATE;department:dms-sales;reportingManager:ashish+shukla;grade:P0;mobileNumber:9694357745;userType:General;', '2016-01-19 13:31:39', 1, 2, '2016-01-27 17:21:00'),
(3410, 'amrita.bhattacharya@hcl.com', 'adrija2014', 'amrita.bhattacharya@hcl.com', 2, 'firstName:AMRITA;lastName:BHATTACHARYA;location:KOLKATA;position:ASSISTANT+MANAGER;department:FINANCE+%26+COMMERCIAL;reportingManager:SANJAY+GURNANI;grade:P3;mobileNumber:7044033879;userType:General;', '2016-01-19 13:33:09', 1, 2, '2016-01-27 17:21:00'),
(3411, 'abhijeet.mukherjee@hcl.com', 'abhi@7237', 'abhijeet.mukherjee@hcl.com', 2, 'firstName:ABHIJEET;lastName:MUKHERJEE;location:KOLKATA;position:MANAGER+-+MARKETING;department:NOKIA+DMS;reportingManager:DEBOJO+RAJEEV;grade:P3;mobileNumber:9007664663;userType:General;', '2016-01-19 13:40:38', 1, 2, '2016-01-27 17:21:00'),
(3412, 'seeraj.sharma-assoc@hcl.com', 'Seeraj*5287', 'seeraj.sharma-assoc@hcl.com', 2, 'firstName:Seeraj;lastName:Sharma;location:JAIPUR;position:SALES+EXECUTIVE;department:Nokia-DMS;reportingManager:JN+Rai;grade:P0;mobileNumber:9983395555;userType:General;', '2016-01-19 13:45:19', 1, 2, '2016-01-27 17:21:00'),
(3413, 'jayanta.sarkar-assoc@hcl.com', 'hcl@135', 'jayanta.sarkar-assoc@hcl.com', 2, 'firstName:Jayanta;lastName:Sarkar;location:KOLKATA;position:ASSOCIATE+MANAGER+-+SALES;department:DMS;reportingManager:Debojo+Rajeev;grade:P0;mobileNumber:9748186260;userType:General;', '2016-01-19 13:54:21', 1, 2, '2016-01-27 17:21:00'),
(3414, 'jagpreetrocky@gmail.com', 'rockymba', 'jagpreetrocky@gmail.com', 2, 'firstName:jagpreet;lastName:singh;location:DELHI;position:ASSISTANT+MANAGER;department:Marketing;reportingManager:Nikhil+Jain;grade:P3;mobileNumber:09711733677;userType:General;', '2016-01-19 13:58:57', 1, 2, '2016-01-27 17:21:00'),
(3415, 'SUJOY.SAHA-ASSOC@HCL.COM', 'sujoy@123', 'SUJOY.SAHA-ASSOC@HCL.COM', 2, 'firstName:SUJOY;lastName:SAHA;location:GUWAHATI;position:ASSOCIATE;department:NOKIA-DEVICE;reportingManager:SANJAY+DEKE;grade:P0;mobileNumber:8811090647;userType:General;', '2016-01-19 14:01:30', 1, 2, '2016-01-27 17:21:00'),
(3416, 'ranjanrajesh@hcl.com', 'rajesh12', 'ranjanrajesh@hcl.com', 2, 'firstName:RAJESH;lastName:RANJAN;location:GUWAHATI;position:EXECUTIVE+-+COMMERCIAL;department:DMS;reportingManager:SANJIB+SEN;grade:X1;mobileNumber:8811032366;userType:General;', '2016-01-19 14:30:51', 1, 2, '2016-01-27 17:21:00'),
(3417, 'gauravsingh@hcl.com', '987654123@', 'gauravsingh@hcl.com', 2, 'firstName:Gaurav;lastName:singh;location:LUCKNOW;position:EXECUTIVE+-+COMMERCIAL;department:Integrated+Supply+Chain+Management;reportingManager:Sanjib+Sen;grade:X1;mobileNumber:8400399888;userType:General;', '2016-01-19 14:37:42', 1, 2, '2016-01-27 17:21:00'),
(3418, 'hymavathi.venkata@hcl.com', 'Hyma7Nalini7', 'hymavathi.venkata@hcl.com', 2, 'firstName:DUDDU;lastName:HYMAVATHI+VENKATA;location:BANGALORE;position:AREA+SALES+EXECUTIVE;department:DMS+NOKIA;reportingManager:ERIC+MINJ;grade:P0;mobileNumber:9980966078;userType:General;', '2016-01-19 15:22:20', 1, 2, '2016-01-27 17:21:00'),
(3419, 'madhukumar.mudi-assoc@hcl.com', 'hcl@2015', 'madhukumar.mudi-assoc@hcl.com', 2, 'firstName:mudi;lastName:madhu+kumar;location:HYDERABAD;position:ASSOCIATE;department:DMS;reportingManager:ANANTH+SAKARY;grade:P0;mobileNumber:9680993663;userType:General;', '2016-01-19 15:22:49', 1, 2, '2016-01-27 17:21:00'),
(3420, 'mohana.a@hcl.com', 'prakamo@29', 'mohana.a@hcl.com', 2, 'firstName:Mohana;lastName:A+V;location:CHENNAI;position:SENIOR+EXECUTIVE;department:Accounts;reportingManager:J+Govindanaathan;grade:X2;mobileNumber:9710910505;userType:General;', '2016-01-19 15:42:29', 1, 2, '2016-01-27 17:21:00'),
(3421, 'vaisakh.gangadharan@hcl.com', 'vais4512', 'vaisakh.gangadharan@hcl.com', 2, 'firstName:Vaisakh;lastName:Gangadharan;location:BANGALORE;position:AREA+SALES+EXECUTIVE;department:DMS;reportingManager:Sesha+sai+Srinivas;grade:P2;mobileNumber:9567760508;userType:General;', '2016-01-19 15:51:43', 1, 2, '2016-01-27 17:21:00'),
(3422, 'ojt-kumar.santosh@hcl.com', 'santy007', 'ojt-kumar.santosh@hcl.com', 2, 'firstName:santosh;lastName:kumar;location:RANCHI;position:AREA+SALES+EXECUTIVE;department:DMS;reportingManager:Ravi+Rai;grade:P0;mobileNumber:7763811114;userType:General;', '2016-01-19 16:12:23', 1, 2, '2016-01-27 17:21:00'),
(3423, 'tanveer.rasool@hcl.com', 'spiccy20', 'tanveer.rasool@hcl.com', 2, 'firstName:TANVEER;lastName:TALI;location:CHANDIGARH;position:AREA+SALES+EXECUTIVE;department:DMS;reportingManager:Arshid+Qurashi;grade:P3;mobileNumber:09797710005;userType:General;', '2016-01-19 16:30:25', 1, 2, '2016-01-27 17:21:00'),
(3424, 'm.kumaran67@gmail.com', '2tfrooty', 'm.kumaran67@gmail.com', 2, 'firstName:M;lastName:Kumaran;location:BANGALORE;position:SENIOR+EXECUTIVE;department:Integrated+Supply+Chain+Management;reportingManager:A.+Jaya+Kumar;grade:P2;mobileNumber:09611115842;userType:General;', '2016-01-19 16:33:37', 1, 2, '2016-01-27 17:21:00'),
(3425, 'pankaj.srivastava-assoc@hcl.com', 'pankajhcl', 'pankaj.srivastava-assoc@hcl.com', 2, 'firstName:PANKAJ;lastName:SRIVASTAVA;location:LUCKNOW;position:AREA+SALES+EXECUTIVE;department:SALES;reportingManager:ANIMESH+CHANDRA;grade:P0;mobileNumber:8009259595;userType:General;', '2016-01-19 16:36:12', 1, 2, '2016-01-27 17:21:00'),
(3426, 'hemant.singhal@hcl.com', 'saumay@27', 'hemant.singhal@hcl.com', 2, 'firstName:HEMANT;lastName:SINGHAL;location:NOIDA+SECTOR-11;position:SENIOR+EXECUTIVE;department:DMS+-+FINANCE+%26+ACCOUNTS;reportingManager:SANJAY+GURGANI;grade:X2;mobileNumber:9650922066;userType:General;', '2016-01-19 16:57:00', 1, 2, '2016-01-27 17:21:00'),
(3427, 'manaskumar@hcl.com', '123456', 'manaskumar@hcl.com', 2, 'firstName:Manas;lastName:Kumar;location:LUCKNOW;position:AREA+MANAGER;department:DMS;reportingManager:S+E+Musanna;grade:P3;mobileNumber:%2B919695229997;userType:General;', '2016-01-19 17:16:06', 1, 2, '2016-01-27 17:21:00'),
(3428, 'm.sheik@hcl.com', 'akmal@2009', 'm.sheik@hcl.com', 2, 'firstName:Mahaboob+Dowla;lastName:sheik;location:BANGALORE;position:ASSISTANT+MANAGER;department:Finance+%26+Commercial;reportingManager:Dilip+Chellani;grade:X3;mobileNumber:9686862448;userType:General;', '2016-01-19 17:18:37', 1, 2, '2016-01-27 17:21:00'),
(3429, 'abhishek.basu@hcl.com', 'January@2015', 'abhishek.basu@hcl.com', 2, 'firstName:Abhishek;lastName:Basu;location:KOLKATA;position:AREA+SALES+MANAGER;department:DMS;reportingManager:Debojo+Rajeev;grade:P3;mobileNumber:9903378811;userType:General;', '2016-01-19 17:23:50', 1, 2, '2016-01-27 17:21:00'),
(3430, 'jehangeer.ahmad-assoc@hcl.com', 'sameer111', 'jehangeer.ahmad-assoc@hcl.com', 2, 'firstName:jehangeer;lastName:malik;location:CHANDIGARH;position:ASSOCIATE;department:divices;reportingManager:arshid+ahmad+shah+qureshi;grade:P0;mobileNumber:9622122786;userType:General;', '2016-01-19 17:30:33', 1, 2, '2016-01-27 17:21:00'),
(3431, 'shibinlal.k@hcl.com', 'Lal@9895', 'shibinlal.k@hcl.com', 2, 'firstName:SHIBIN+LAL;lastName:K+S;location:COCHIN;position:BRANCH+SALES+OPERATIONS+MANAGER;department:DMS;reportingManager:VARGHESE+JACOB;grade:P3;mobileNumber:9895015767;userType:General;', '2016-01-19 17:41:55', 1, 2, '2016-01-27 17:21:00'),
(3432, 'kumar.brajendra@hcl.com', 'hcli@123', 'kumar.brajendra@hcl.com', 2, 'firstName:BRAJENDRA;lastName:VERMA;location:NOIDA+SECTOR-11;position:SENIOR+EXECUTIVE;department:DMS;reportingManager:SANJAY+GURNANI;grade:X2;mobileNumber:9560027004;userType:General;', '2016-01-19 17:55:49', 1, 2, '2016-01-27 17:21:00'),
(3433, 'Sandeepk-assoc@hcl.com', 'sand9873', 'Sandeepk-assoc@hcl.com', 2, 'firstName:Sandeep+Kumar;lastName:Gupta;location:NOIDA+X1;position:SALES+EXECUTIVE;department:DMS;reportingManager:Aditya+Rana;grade:P0;mobileNumber:9559920444;userType:General;', '2016-01-19 18:06:23', 1, 2, '2016-01-27 17:21:00'),
(3434, 'swakshar.chakravarty@hcl.com', 'jyotinagar21', 'swakshar.chakravarty@hcl.com', 2, 'firstName:swakshar;lastName:chakravarty;location:GUWAHATI;position:BRANCH+MANAGER;department:General+Trade;reportingManager:Heemanshu+Kumar+Sinha;grade:P5;mobileNumber:7086099788;userType:General;', '2016-01-19 19:44:08', 1, 2, '2016-01-27 17:21:00'),
(3435, 'asif.rahaman@hcl.com', 'asif786', 'asif.rahaman@hcl.com', 2, 'firstName:ASIF+;lastName:RAHAMAN;location:NOIDA;position:AREA+SALES+EXECUTIVE;department:ORGANIZED+TRADE;reportingManager:SWAKSHAR+CHAKRAARTY;grade:P1;mobileNumber:7086023461%2F9614505487;userType:General;', '2016-01-19 20:15:30', 1, 2, '2016-01-27 17:21:00'),
(3436, 'mahesh.vepuri@hcl.com', 'mahi@nikky', 'mahesh.vepuri@hcl.com', 2, 'firstName:Mahesh+Rayudu;lastName:Vepuri;location:HYDERABAD;position:AREA+SALES+MANAGER;department:DMS;reportingManager:Sridhar+C;grade:P3;mobileNumber:8978866441;userType:General;', '2016-01-19 20:15:31', 1, 2, '2016-01-27 17:21:00'),
(3437, 'sambit.mohapatra-assoc@gmail.com', 'sambithcl', 'sambit.mohapatra-assoc@gmail.com', 2, 'firstName:SAMBIT;lastName:MOHAPATRA;location:BHUBANESHWAR;position:ASSOCIATE;department:GENERAL+TRADE+DMS;reportingManager:s.shekhar;grade:P0;mobileNumber:9776523357;userType:General;', '2016-01-19 20:24:36', 1, 2, '2016-01-27 17:21:00'),
(3438, 'syed.muntazar-assoc@hcl.com', 'syed7272', 'syed.muntazar-assoc@hcl.com', 2, 'firstName:SYED;lastName:MUNTAZAR;location:BANGALORE;position:AREA+SALES+EXECUTIVE;department:SALES;reportingManager:SRINIVAS;grade:P0;mobileNumber:9902048909;userType:General;', '2016-01-19 20:30:52', 1, 2, '2016-01-27 17:21:00'),
(3439, 'c.m-assoc@hcl.com', 'rash4517', 'c.m-assoc@hcl.com', 2, 'firstName:C+M;lastName:Rashinkar;location:BANGALORE;position:AREA+SALES+EXECUTIVE;department:SALES;reportingManager:P+Sesha+Sai+Srinivas;grade:P0;mobileNumber:8095600212;userType:General;', '2016-01-19 20:37:54', 1, 2, '2016-01-27 17:21:00'),
(3440, 'rm.vangalapudi@hcl.com', 'kavya@0512', 'rm.vangalapudi@hcl.com', 2, 'firstName:RM+PRASAD;lastName:VANGALAPUDI;location:HYDERABAD;position:SALES+EXECUTIVE;department:DMS;reportingManager:SARPENDRA+NVPR;grade:P1;mobileNumber:9000144323;userType:General;', '2016-01-19 21:01:03', 1, 2, '2016-01-27 17:21:00'),
(3441, 'BABUSURESH@HCL.COM', 'Manju@11', 'BABUSURESH@HCL.COM', 2, 'firstName:GUNTI+;lastName:SURESH+BABU;location:HYDERABAD;position:SALES+MANAGER;department:SALES;reportingManager:SRIDHAR+C;grade:P3;mobileNumber:9866811169;userType:General;', '2016-01-19 21:50:08', 1, 2, '2016-01-27 17:21:00'),
(3442, 'sarpendra@hcl.com', 'razia@3606', 'sarpendra@hcl.com', 2, 'firstName:V+P+R++SARPENDRA;lastName:NEELAM;location:HYDERABAD;position:SALES+MANAGER;department:SALES;reportingManager:SRIDHAR+C;grade:P4;mobileNumber:9573102777;userType:General;', '2016-01-19 21:54:12', 1, 2, '2016-01-27 17:21:00'),
(3443, 'jitendra.raghuvanshi-assoc@hcl.com', 'jitendra@123', 'jitendra.raghuvanshi-assoc@hcl.com', 2, 'firstName:jitendra;lastName:raghuwanshi;location:BHOPAL;position:ASSOCIATE;department:DMS;reportingManager:mr.+gourav+shrivastava;grade:P0;mobileNumber:8889905051;userType:General;', '2016-01-19 22:39:33', 1, 2, '2016-01-27 17:21:00'),
(3444, 'sethupathy.m@hcl.com', 'Sethu@07', 'sethupathy.m@hcl.com', 2, 'firstName:Sethupathy;lastName:Murugesan;location:CHENNAI;position:SALES+MANAGER;department:OT;reportingManager:Dennis+Mathew;grade:P3;mobileNumber:9791977222;userType:General;', '2016-01-19 22:46:35', 1, 2, '2016-01-27 17:21:00'),
(3445, 'sanjay.deka@hcl.com', 'guwahati2010', 'sanjay.deka@hcl.com', 2, 'firstName:SANJAY;lastName:DEKA;location:GUWAHATI;position:AREA+SALES+MANAGER;department:DMS;reportingManager:SWAKSHAR+CHAKRAVARTY;grade:P4;mobileNumber:7086053558;userType:General;', '2016-01-19 23:09:28', 1, 2, '2016-01-27 17:21:00'),
(3446, 'vinayak.jha@hcl.com', 'Vin12@', 'vinayak.jha@hcl.com', 2, 'firstName:Vinayak+Jha;lastName:Jha;location:MUMBAI;position:ASSISTANT+MANAGER+-+IMPORTS;department:Sales;reportingManager:Yugdeep;grade:P3;mobileNumber:7718880179;userType:General;', '2016-01-20 00:48:20', 1, 2, '2016-01-27 17:21:00'),
(3447, 'kumarnavin@hcl.com', 'vaishali@1', 'kumarnavin@hcl.com', 2, 'firstName:Navin+Kumar;lastName:Singh;location:PATNA;position:BRANCH+MANAGER;department:DMS;reportingManager:Heemanshu+Kumar+Sinha;grade:P5;mobileNumber:8877224488;userType:General;', '2016-01-20 07:41:18', 1, 2, '2016-01-27 17:21:00'),
(3448, 'kumar.vikash@hcl.com', 'hcl@2016', 'kumar.vikash@hcl.com', 2, 'firstName:VIKASH;lastName:KUMAR;location:PATNA;position:SALES+MANAGER;department:CONSUMER+DISTRIBUTION;reportingManager:NAVIN+KUMAR;grade:P3;mobileNumber:7766908101;userType:General;', '2016-01-20 08:14:20', 1, 2, '2016-01-27 17:21:00'),
(3449, 'sanjai.kumar@hcl.com', 'Sanj21901', 'sanjai.kumar@hcl.com', 2, 'firstName:SANJAI;lastName:JHA;location:PATNA;position:SALES+MANAGER;department:DMS;reportingManager:NAVIN+KUMAR+SINGH;grade:P3;mobileNumber:9771498296;userType:General;', '2016-01-20 09:12:51', 1, 2, '2016-01-27 17:21:00'),
(3450, 'kumarkundan@hcl.com', 'hcl@6666', 'kumarkundan@hcl.com', 2, 'firstName:Kundan;lastName:+Kumar;location:NOIDA;position:SENIOR+EXECUTIVE;department:DMS+Nokia;reportingManager:Nikhil+Jain;grade:P2;mobileNumber:9891054953;userType:General;', '2016-01-20 09:56:52', 1, 2, '2016-01-27 17:21:00'),
(3451, 'singh.indrajeet@hcl.com', 'inder@4283', 'singh.indrajeet@hcl.com', 2, 'firstName:Indrajeet;lastName:singh;location:PATNA;position:SALES+MANAGER;department:DMS;reportingManager:Navin+Kumar+Singh;grade:P3;mobileNumber:8877700065;userType:General;', '2016-01-20 10:03:53', 1, 2, '2016-01-27 17:21:00'),
(3452, 'kumar.suresh-assoc@gmail.com', 'sure4535', 'kumar.suresh-assoc@gmail.com', 2, 'firstName:suresh;lastName:grandhi;location:HYDERABAD;position:SALES+EXECUTIVE;department:DMS;reportingManager:sarpendra+NVPR;grade:P0;mobileNumber:9000142242;userType:General;', '2016-01-20 10:13:15', 1, 2, '2016-01-27 17:21:00'),
(3453, 'vikramsj@hcl.com', 'Khushiram@20', 'vikramsj@hcl.com', 2, 'firstName:Vikram;lastName:Jamnal;location:NOIDA;position:ASSISTANT+MANAGER;department:CONSUMER+DISTRIBUTION;reportingManager:ANUJ+MINOCHA;grade:X3;mobileNumber:9871113457;userType:General;', '2016-01-20 10:13:30', 1, 2, '2016-01-27 17:21:00'),
(3454, 'sorabh.jain@hcl.com', 'reenuzee1', 'sorabh.jain@hcl.com', 2, 'firstName:Sorabh+Goel;lastName:Jain;location:NOIDA;position:PRODUCT+MANAGER;department:DMS;reportingManager:Rajiv+Kenue;grade:P5;mobileNumber:9999766390;userType:General;', '2016-01-20 10:19:46', 1, 2, '2016-01-27 17:21:00'),
(3455, 'jitesh.sawhney@hcl.com', 'jitesh@9818', 'jitesh.sawhney@hcl.com', 2, 'firstName:JITESH;lastName:SAWHNEY;location:NOIDA+SECTOR-11;position:SENIOR+EXECUTIVE;department:FINANCE+%26+ACCCOUNTS;reportingManager:Mr+Anuj+Minocha;grade:P2;mobileNumber:9818765152;userType:General;', '2016-01-20 10:27:47', 1, 2, '2016-01-27 17:21:00'),
(3456, 'soumyadip.pal@hcl.com', 'Swami@1983', 'soumyadip.pal@hcl.com', 2, 'firstName:Soumyadip;lastName:Pal;location:NOIDA;position:REGIONAL+SALES+MANAGER;department:Consumer+Distribution;reportingManager:Sagnik+Sen;grade:P5;mobileNumber:9717772935;userType:General;', '2016-01-20 10:27:48', 1, 2, '2016-01-27 17:21:00'),
(3457, 'manohar.nadigatla@hcl.com', 'balaji', 'manohar.nadigatla@hcl.com', 2, 'firstName:MANOHAR;lastName:NADIGATLA;location:MUMBAI;position:KEY+ACCOUNT+MANAGER;department:DMS+-+OT;reportingManager:AMIT+CHATURVEDI;grade:P5;mobileNumber:9892009194;userType:General;', '2016-01-20 10:32:02', 1, 2, '2016-01-27 17:21:00'),
(3458, 'prakash.chandra-assoc@hcl.com', 'soni@500110', 'prakash.chandra-assoc@hcl.com', 2, 'firstName:prakash;lastName:trivedi;location:LUCKNOW;position:ASSOCIATE;department:DMS-nokia;reportingManager:manas+kumar;grade:P4;mobileNumber:9838662655;userType:General;', '2016-01-20 10:32:09', 1, 2, '2016-01-27 17:21:00'),
(3459, 'garg.saurabh@hcl.com', 'Cargill@1100', 'garg.saurabh@hcl.com', 2, 'firstName:Saurabh;lastName:Garg;location:NOIDA;position:REGIONAL+MANAGER;department:Integrated+Supply+Chain;reportingManager:Devesh+Shankar;grade:P4;mobileNumber:9560003172;userType:General;', '2016-01-20 10:32:14', 1, 2, '2016-01-27 17:21:00'),
(3460, 'manu.bishnoi-assoc@hcl.com', 'manu@1234', 'manu.bishnoi-assoc@hcl.com', 2, 'firstName:MANU;lastName:BISHNOI;location:NOIDA;position:ASSOCIATE;department:FINAC;reportingManager:SANJAY+GURNANI;grade:X0;mobileNumber:8860690868;userType:General;', '2016-01-20 10:33:34', 1, 2, '2016-01-27 17:21:00'),
(3461, 'pravish.ponnappan@hcl.com', '1244927888', 'pravish.ponnappan@hcl.com', 2, 'firstName:Pravish;lastName:Ponnappan;location:NOIDA;position:EXECUTIVE;department:Integrated+Supply+Chain;reportingManager:Ranjit+Singh;grade:P1;mobileNumber:7042555629;userType:General;', '2016-01-20 10:34:25', 1, 2, '2016-01-27 17:21:00'),
(3462, 'rajeshtnair@hcl.com', '71296@123', 'rajeshtnair@hcl.com', 2, 'firstName:RAJESH+T.;lastName:NAIR;location:NOIDA;position:DEPUTY+MANAGER;department:FINANCE;reportingManager:SANJEEV+KUMAR+SARAF;grade:X4;mobileNumber:9810205495;userType:General;', '2016-01-20 10:45:32', 1, 2, '2016-01-27 17:21:00'),
(3463, 'ashish.singh@hcl.com', 'Abhiraj$04', 'ashish.singh@hcl.com', 2, 'firstName:ASHISH;lastName:SINGH;location:NOIDA;position:KEY+ACCOUNT+MANAGER;department:NOKIA+SALES;reportingManager:AJITABH+MOHAN+JERATH;grade:P5;mobileNumber:09818009216;userType:General;', '2016-01-20 11:02:07', 1, 2, '2016-01-27 17:21:00'),
(3464, 'heemanshu.kumar@hcl.com', 'hcli@001', 'heemanshu.kumar@hcl.com', 2, 'firstName:Heemanshu;lastName:Sinha;location:KOLKATA;position:REGIONAL+MANAGER;department:DMS;reportingManager:Sutikshan+Naithani;grade:P7;mobileNumber:7755857775;userType:General;', '2016-01-20 11:08:36', 1, 2, '2016-01-27 17:21:00'),
(3465, 'manish.anand-assoc@hcl.com', 'green@12', 'manish.anand-assoc@hcl.com', 2, 'firstName:MANISH;lastName:ANAND;location:DEHRADUN;position:ASSISTANT;department:NOKIA+DMS;reportingManager:VIKRAM+PARASHAR;grade:P0;mobileNumber:8449204060;userType:General;', '2016-01-20 11:09:58', 1, 2, '2016-01-27 17:21:00'),
(3466, 'shuchi.jha@hcl.com', 'shuchi@4455', 'shuchi.jha@hcl.com', 2, 'firstName:Shuchi;lastName:Jha;location:NOIDA+SECTOR-11;position:SALES+CO-ORDINATOR;department:Non+sales;reportingManager:Sanjay+Gurnani;grade:P1;mobileNumber:9717511191;userType:General;', '2016-01-20 11:13:02', 1, 2, '2016-01-27 17:21:00'),
(3467, 'malik.rajesh@hcl.com', 'donna', 'malik.rajesh@hcl.com', 2, 'firstName:Rajesh;lastName:Malik;location:NOIDA+SECTOR-11;position:KEY+ACCOUNT+MANAGER;department:DMS;reportingManager:Amit+Chaturvedi;grade:P4;mobileNumber:8826080008;userType:General;', '2016-01-20 11:13:44', 1, 2, '2016-01-27 17:21:00'),
(3468, 'rajeeb.kumar@hcl.com', 'hcli123', 'rajeeb.kumar@hcl.com', 2, 'firstName:RAJEEB;lastName:SUBUDHI;location:NOIDA;position:ASSISTANT+MANAGER;department:ACCOUNTS+%26+FINANCE;reportingManager:P+T+JAGGANATHAN;grade:X3;mobileNumber:9810233055;userType:General;', '2016-01-20 11:24:52', 1, 2, '2016-01-27 17:21:00'),
(3469, 'sridharc@hcl.com', 'sridhar', 'sridharc@hcl.com', 2, 'firstName:Sridhar;lastName:C;location:HYDERABAD;position:BRANCH+MANAGER;department:Sales;reportingManager:Himanshu+Niraj;grade:P4;mobileNumber:9032855566;userType:General;', '2016-01-20 11:35:17', 1, 2, '2016-01-27 17:21:00'),
(3470, 'vasudha.seru@hcl.com', '12345', 'vasudha.seru@hcl.com', 2, 'firstName:Vasudha+Seru;lastName:Seru;location:NOIDA+SECTOR-11;position:KEY+ACCOUNT+EXECUTIVE;department:DMS;reportingManager:Mr.Rajesh+Malik;grade:P1;mobileNumber:9582143204;userType:General;', '2016-01-20 11:48:29', 1, 2, '2016-01-27 17:21:00'),
(3471, 'Punya.t@hcl.com', 'Jhpatel1234', 'Punya.t@hcl.com', 2, 'firstName:PUNYA;lastName:PATEL;location:BANGALORE;position:ASSISTANT+MANAGER;department:MARKETING;reportingManager:REGIONAL+SALES+MANAGER;grade:P3;mobileNumber:9900804303;userType:General;', '2016-01-20 11:52:27', 1, 2, '2016-01-27 17:21:00'),
(3472, 'wadhwa.rachit@hcl.com', 'rachit@12', 'wadhwa.rachit@hcl.com', 2, 'firstName:Rachit+;lastName:Wadhwa;location:DELHI;position:KEY+ACCOUNT+MANAGER;department:DMS+;reportingManager:Naveen+Kumar;grade:P4;mobileNumber:9899635303;userType:General;', '2016-01-20 12:08:00', 1, 2, '2016-01-27 17:21:00'),
(3473, 'verma.ritu@hcl.com', 'rituv@0308', 'verma.ritu@hcl.com', 2, 'firstName:Ritu+;lastName:Verma;location:NOIDA;position:ASSISTANT+MANAGER;department:Online+Sales;reportingManager:Gurpreet+Bawa;grade:X3;mobileNumber:9716599333;userType:General;', '2016-01-20 12:12:43', 1, 2, '2016-01-27 17:21:00'),
(3474, 'satya.kalluri@hcl.com', 'hcl.com', 'satya.kalluri@hcl.com', 2, 'firstName:Satya+Abhiram;lastName:Kalluri;location:HYDERABAD;position:BRANCH+SALES+OPERATIONS+MANAGER;department:DMS;reportingManager:Vikas+Sachdeva;grade:P3;mobileNumber:9885037705;userType:General;', '2016-01-20 12:19:11', 1, 2, '2016-01-27 17:21:00'),
(3475, 'kumar.kishore@hcl.com', 'assholesk', 'kumar.kishore@hcl.com', 2, 'firstName:Kishorekumar;lastName:Kesagani;location:NOIDA;position:BUSINESS+MANAGER;department:DMS;reportingManager:sagnik+sen;grade:P4;mobileNumber:8527374242;userType:General;', '2016-01-20 12:20:10', 1, 2, '2016-01-27 17:21:00'),
(3476, 'gupta.tanmay@hcl.com', 'tanmay@0912', 'gupta.tanmay@hcl.com', 2, 'firstName:Tanmay;lastName:Gupta;location:NOIDA+SECTOR-11;position:SALES+EXECUTIVE;department:DDMS;reportingManager:gurpreet+bawa;grade:P1;mobileNumber:7042727368;userType:General;', '2016-01-20 12:22:41', 1, 2, '2016-01-27 17:21:00'),
(3477, 'vasudha.seru@gmail.com', '12345', 'vasudha.seru@gmail.com', 2, 'firstName:Vasudha;lastName:Seru;location:NOIDA+SECTOR-11;position:AREA+SALES+EXECUTIVE;department:DMS;reportingManager:mr.Rajesh+Malik;grade:P1;mobileNumber:9582143204;userType:General;', '2016-01-20 12:26:33', 1, 2, '2016-01-27 17:21:00'),
(3478, 'malik.rajesh1112@gmail.com', 'RAJMAL', 'malik.rajesh1112@gmail.com', 2, 'firstName:Rajesh+;lastName:Malik;location:NOIDA+SECTOR-11;position:KEY+ACCOUNT+MANAGER;department:DMS;reportingManager:Amit+Chaturvedi;grade:P4;mobileNumber:8826080008;userType:General;', '2016-01-20 12:29:09', 1, 2, '2016-01-27 17:21:00'),
(3479, 'nikhiljain@hcl.com', 'nikh1234', 'nikhiljain@hcl.com', 2, 'firstName:Nikhil;lastName:Jain;location:NOIDA;position:SENIOR+MANAGER;department:Marketing;reportingManager:Sagnik+Sen;grade:P5;mobileNumber:9999100721;userType:General;', '2016-01-20 12:29:49', 1, 2, '2016-01-27 17:21:00'),
(3480, 'acharya.akash@hcl.com', 'akash@12', 'acharya.akash@hcl.com', 2, 'firstName:AKASH+;lastName:ACHARYA;location:KOLKATA;position:EXECUTIVE;department:PARENT+-LOGISTICS;reportingManager:MR+SANJIB+SEN+;grade:X1;mobileNumber:9937478715;userType:General;', '2016-01-20 12:29:51', 1, 2, '2016-01-27 17:21:00'),
(3481, 'ananth.kumar@hcl.com', 'ap11ap6681', 'ananth.kumar@hcl.com', 2, 'firstName:Ananth+Kumar;lastName:Sakaray;location:HYDERABAD;position:AREA+SALES+MANAGER;department:DMS;reportingManager:C+Sridhar;grade:P3;mobileNumber:9985813693;userType:General;', '2016-01-20 12:31:27', 1, 2, '2016-01-27 17:21:00'),
(3482, 'ksrawat@hcl.com', 'ksr@007', 'ksrawat@hcl.com', 2, 'firstName:kundan;lastName:rawat;location:NOIDA+SECTOR-11;position:ASSOCIATE+MANAGER;department:logistic;reportingManager:rajan+bansal;grade:X3;mobileNumber:9818553377;userType:General;', '2016-01-20 12:31:56', 1, 2, '2016-01-27 17:21:00'),
(3483, 'kr.manish@hcl.om', 'ccna0786', 'kr.manish@hcl.om', 2, 'firstName:Manish;lastName:Kumar;location:NOIDA;position:EXECUTIVE;department:DMS;reportingManager:Deepankar;grade:X1;mobileNumber:9650509204;userType:General;', '2016-01-20 12:45:45', 1, 2, '2016-01-27 17:21:00'),
(3484, 'sukrit.sareen@hcl.com', 'Vivaan@2011', 'sukrit.sareen@hcl.com', 2, 'firstName:Sukrit;lastName:Sareen;location:NOIDA;position:SENIOR+EXECUTIVE+-+SALES;department:DDMS;reportingManager:Gurpreet+Bawa;grade:P2;mobileNumber:9810802822;userType:General;', '2016-01-20 12:55:12', 1, 2, '2016-01-27 17:21:00'),
(3485, 'lalit.rathore@hcl.com', 'hcl@10519', 'lalit.rathore@hcl.com', 2, 'firstName:lalit;lastName:rathore;location:NOIDA+SECTOR-11;position:EXECUTIVE;department:Sales+DMS;reportingManager:Deepankar;grade:P1;mobileNumber:8447946425;userType:General;', '2016-01-20 13:00:00', 1, 2, '2016-01-27 17:21:00'),
(3486, 'dhirajkumar@hcl.com', 'hcl@2121', 'dhirajkumar@hcl.com', 2, 'firstName:dhiraj;lastName:kumar;location:PATNA;position:SALES+MANAGER;department:DMS;reportingManager:navin+singh;grade:P3;mobileNumber:8051300222;userType:General;', '2016-01-20 13:01:03', 1, 2, '2016-01-27 17:21:00'),
(3487, 'gautam.ku@hcl.com', 'Gunja_007', 'gautam.ku@hcl.com', 2, 'firstName:Gautam;lastName:kumar;location:NOIDA;position:ASSISTANT+MANAGER;department:DMS;reportingManager:Deepankar;grade:X3;mobileNumber:9999092333;userType:General;', '2016-01-20 13:02:47', 1, 2, '2016-01-27 17:21:00'),
(3488, 'tomar.ashish2003@gmail.com', 'hcl@2016', 'tomar.ashish2003@gmail.com', 2, 'firstName:ASHISH;lastName:TOMAR;location:NOIDA;position:KEY+ACCOUNT+EXECUTIVE;department:DMS;reportingManager:RAJESH+MALIK;grade:P2;mobileNumber:9968617445;userType:General;', '2016-01-20 13:16:36', 1, 2, '2016-01-27 17:21:00'),
(3489, 'akanksha.rajak@hcl.com', 'Akanksha@1', 'akanksha.rajak@hcl.com', 2, 'firstName:Akanksha;lastName:Rajak;location:MUMBAI;position:SENIOR+SALES+EXECUTIVE;department:DMS+-+Nokia;reportingManager:Manohar+Nadigatla;grade:P2;mobileNumber:9619715071;userType:General;', '2016-01-20 13:20:42', 1, 2, '2016-01-27 17:21:00'),
(3490, 'vinayak.sharma@hcl.com', 'sharma@707', 'vinayak.sharma@hcl.com', 2, 'firstName:Vinayak;lastName:Sharma;location:NOIDA+SECTOR-11;position:ASSISTANT+MANAGER;department:DMS+-+Consumer+Distribution;reportingManager:Sanjay+Gurnani;grade:P3;mobileNumber:9818876170;userType:General;', '2016-01-20 13:24:21', 1, 2, '2016-01-27 17:21:00'),
(3491, 'subramanya.sharma@hcl.com', 'p@ssw0rd6', 'subramanya.sharma@hcl.com', 2, 'firstName:Subramanya+Sharma;lastName:VVTS;location:HYDERABAD;position:SALES+MANAGER;department:DMS;reportingManager:C+Sridhar;grade:P2;mobileNumber:8008883247;userType:General;', '2016-01-20 13:32:43', 1, 2, '2016-01-27 17:21:00'),
(3492, '123@hcl.com', '1234', '123@hcl.com', 2, 'firstName:Test+16jan;lastName:123;location:Ahmedabad;position:AREA+SALES+EXECUTIVE;department:DISTRIBUTION-DE+%26+COMPUTING;reportingManager:12;grade:E4;mobileNumber:1;userType:Pride;', '2016-01-20 13:35:51', 1, 2, '2016-01-27 17:21:00'),
(3493, '1243@hcl.com', '1234', '1243@hcl.com', 2, 'firstName:Test+16jan;lastName:123;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:123;reportingManager:123;grade:P0;mobileNumber:123;userType:General;', '2016-01-20 13:36:08', 1, 2, '2016-01-27 17:21:00'),
(3494, 'neerajnagori17@gmail.com', 'Orkut789', 'neerajnagori17@gmail.com', 2, 'firstName:Neeraj;lastName:Nagori;location:JAIPUR;position:SALES+EXECUTIVE;department:Nokia+DMS;reportingManager:Jai+Narayan+Rai;grade:P0;mobileNumber:9252257475;userType:General;', '2016-01-20 13:46:13', 1, 2, '2016-01-27 17:21:00'),
(3496, 'rajeshranjan@hcl.com', 'rajesh@1211', 'rajeshranjan@hcl.com', 2, 'firstName:Rajesh;lastName:Ranjan;location:NOIDA+SECTOR-11;position:ASSISTANT+MANAGER;department:credit+control+function;reportingManager:rajiv+manchanda;grade:P3;mobileNumber:09717034611;userType:General;', '2016-01-20 14:06:32', 1, 2, '2016-01-27 17:21:00'),
(3497, 'debasish.basak@hcl.com', 'hcl@135n', 'debasish.basak@hcl.com', 2, 'firstName:debasish;lastName:basak;location:AHEMDABAD;position:SALES+MANAGER;department:DMS;reportingManager:Debojoo+Rajeev;grade:P4;mobileNumber:9832019655;userType:General;', '2016-01-20 14:10:59', 1, 2, '2016-01-27 17:21:00'),
(3498, 'prakash.kamble@hcl.com', '16041971', 'prakash.kamble@hcl.com', 2, 'firstName:PRAKASH;lastName:KAMBLE;location:ANDHERI-MUMBAI;position:ASSISTANT+MANAGER;department:ACCOUNTS+AND+FINANCE;reportingManager:DILIP+P+CHELLANI;grade:X3;mobileNumber:9967190695;userType:General;', '2016-01-20 14:33:25', 1, 2, '2016-01-27 17:21:00'),
(3499, 'santosh.sahani-assoc@hcl.com', 'santosh100', 'santosh.sahani-assoc@hcl.com', 2, 'firstName:SANTOSH;lastName:SAHANI;location:BHUBANESHWAR;position:ASSOCIATE;department:DMS;reportingManager:MANAS+SAHU;grade:P0;mobileNumber:9937257214;userType:General;', '2016-01-20 14:46:14', 1, 2, '2016-01-27 17:21:00'),
(3500, 's.jayachandran@hcl.com', 'hcl@1978', 's.jayachandran@hcl.com', 2, 'firstName:jayachandran+;lastName:sk;location:COCHIN;position:AREA+MANAGER;department:DMS;reportingManager:varghese+jacob;grade:P4;mobileNumber:9995481278;userType:General;', '2016-01-20 15:06:59', 1, 2, '2016-01-27 17:21:00'),
(3501, 'sarda.siddhant@hcl.com', 'MH22@AB5094', 'sarda.siddhant@hcl.com', 2, 'firstName:siddhant;lastName:sarda;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:DDMS;reportingManager:Gurpreet+Bawa;grade:P2;mobileNumber:08983143633;userType:General;', '2016-01-20 15:18:02', 1, 2, '2016-01-27 17:21:00'),
(3502, 'ashok.bisht@hcl.com', 'hcli@123', 'ashok.bisht@hcl.com', 2, 'firstName:ASHOK;lastName:BISHT;location:NOIDA;position:SENIOR+EXECUTIVE;department:DMS;reportingManager:Anuj+Minocha;grade:X2;mobileNumber:9717778684;userType:General;', '2016-01-20 15:28:39', 1, 2, '2016-01-27 17:21:00'),
(3503, 'manoj.arya@hcl.com', 'Raja@143', 'manoj.arya@hcl.com', 2, 'firstName:Manoj;lastName:Kumar;location:NOIDA;position:ASSISTANT+MANAGER;department:DMS-Quality;reportingManager:Vishal+Ranjan;grade:P3;mobileNumber:7042413555;userType:General;', '2016-01-20 15:30:56', 1, 2, '2016-01-27 17:21:00'),
(3504, 'navneet.bansal@hcl.com', 'sharda03', 'navneet.bansal@hcl.com', 2, 'firstName:NAVNEET;lastName:BANSAL;location:NOIDA+SECTOR-11;position:HEAD+-+SALES+OPERATIONS;department:NOKIA+GEARS;reportingManager:SAGNIK+SEN;grade:P2;mobileNumber:9971050937;userType:General;', '2016-01-20 15:37:25', 1, 2, '2016-01-27 17:21:00'),
(3505, 'dilippc@hcl.com', 'DGRIP', 'dilippc@hcl.com', 2, 'firstName:Dilip;lastName:Chellani;location:MUMBAI;position:MANAGER+-+ACCOUNTS;department:FInance+and+Accounts;reportingManager:Sanjeev+Saraf;grade:P5;mobileNumber:9867566004;userType:General;', '2016-01-20 15:37:46', 1, 2, '2016-01-27 17:21:00'),
(3506, 'pushkar.tiwari-assoc@hcl.com', 'pis@2121', 'pushkar.tiwari-assoc@hcl.com', 2, 'firstName:pushkar;lastName:tiwari;location:LUCKNOW;position:ASSOCIATE;department:DMS;reportingManager:S.Mussana;grade:P0;mobileNumber:9559453222;userType:General;', '2016-01-20 15:45:25', 1, 2, '2016-01-27 17:21:00'),
(3507, 'manojagrawal@hcl.com', 'manoj@25', 'manojagrawal@hcl.com', 2, 'firstName:MANOJ;lastName:AGRAWAL;location:NOIDA;position:SENIOR+EXECUTIVE;department:DMS;reportingManager:SANJAY+GURNANI;grade:X2;mobileNumber:9555433098;userType:General;', '2016-01-20 15:45:41', 1, 2, '2016-01-27 17:21:00'),
(3508, 'guptamanish@hcl.com', 'exch@123', 'guptamanish@hcl.com', 2, 'firstName:Manish;lastName:Gupta;location:BHOPAL;position:SALES+MANAGER;department:DMS-Nokia;reportingManager:Hitesh+Chouhan;grade:P4;mobileNumber:9669840011;userType:General;', '2016-01-20 16:06:59', 1, 2, '2016-01-27 17:21:00'),
(3509, 'arjun.kumar-assoc@hcl.com', 'arjun@11', 'arjun.kumar-assoc@hcl.com', 2, 'firstName:ARJUN;lastName:KUMAR;location:CHANDIGARH;position:SALES+CO-ORDINATOR;department:OPERATION+WORKS;reportingManager:ARSHID+QURESHI;grade:P0;mobileNumber:9596807676;userType:General;', '2016-01-20 16:14:10', 1, 2, '2016-01-27 17:21:00'),
(3510, 'syed.muntazar_assoc@hcl.com', 'syed7272', 'syed.muntazar_assoc@hcl.com', 2, 'firstName:SYED;lastName:MUNTAZAR;location:BANGALORE;position:AREA+SALES+EXECUTIVE;department:SALES;reportingManager:SRINIVAS+PISIPATHI;grade:P0;mobileNumber:9902048909;userType:General;', '2016-01-20 16:30:27', 1, 2, '2016-01-27 17:21:00'),
(3511, 'hem.chandra@hcl.com', 'hcp@12246', 'hem.chandra@hcl.com', 2, 'firstName:HEM;lastName:PANDE;location:NOIDA+SECTOR-11;position:SENIOR+EXECUTIVE;department:DMS-CONSUMER;reportingManager:MR.+DEVESH+SHANKAR;grade:X2;mobileNumber:9818428855;userType:General;', '2016-01-20 16:35:22', 1, 2, '2016-01-27 17:21:00'),
(3512, 'debayan.roy@hcl.com', 'deba@3288', 'debayan.roy@hcl.com', 2, 'firstName:Debayan;lastName:Roy;location:KOLKATA;position:AREA+SALES+EXECUTIVE;department:DMS;reportingManager:Abhishek+Basu;grade:P1;mobileNumber:9831058492;userType:General;', '2016-01-20 16:38:28', 1, 2, '2016-01-27 17:21:00'),
(3513, 'santosh.hegde@hcl.com', 'santoshhcl', 'santosh.hegde@hcl.com', 2, 'firstName:Santosh;lastName:Hegde;location:BANGALORE;position:KEY+ACCOUNT+EXECUTIVE;department:DDMS;reportingManager:key+Acount+Manager;grade:P2;mobileNumber:9538111106;userType:General;', '2016-01-20 16:43:07', 1, 2, '2016-01-27 17:21:00'),
(3514, 'animesh.chandra@hcl.com', 'animesh', 'animesh.chandra@hcl.com', 2, 'firstName:Animesh;lastName:Chandra;location:NOIDA+SECTOR-11;position:SALES+MANAGER;department:DMS;reportingManager:Ashish+Singh;grade:P3;mobileNumber:9935278222;userType:General;', '2016-01-20 16:52:44', 1, 2, '2016-01-27 17:21:00'),
(3515, 'purnendu.chakraborty@hcl.com', 'purnendu1989', 'purnendu.chakraborty@hcl.com', 2, 'firstName:Purnendu+;lastName:Chakraborty;location:KOLKATA;position:AREA+SALES+MANAGER;department:DMS;reportingManager:Debojo+Rajeev;grade:P3;mobileNumber:7044072409;userType:General;', '2016-01-20 16:57:55', 1, 2, '2016-01-27 17:21:00'),
(3516, 'diwakar-assoc@hcl.com', 'sunday1254@', 'diwakar-assoc@hcl.com', 2, 'firstName:Diwakar;lastName:Srivastava;location:PATNA;position:SENIOR+EXECUTIVE;department:Nokia-DMS;reportingManager:Dhiraj+Kumar;grade:P0;mobileNumber:8877700061;userType:General;', '2016-01-20 17:05:14', 1, 2, '2016-01-27 17:21:00'),
(3517, 'tiwari.arvind@hcl.com', 'Hcl@2016', 'tiwari.arvind@hcl.com', 2, 'firstName:arvind;lastName:Tiwary;location:PATNA;position:SALES+MANAGER;department:DMS;reportingManager:Navin+kumar+singh;grade:P4;mobileNumber:7763816890;userType:General;', '2016-01-20 17:07:01', 1, 2, '2016-01-27 17:21:00'),
(3518, 'vijendra.rathore@hcl.com', '14041986', 'vijendra.rathore@hcl.com', 2, 'firstName:Vijendra+Singh;lastName:Rathore;location:BHOPAL;position:AREA+SALES+EXECUTIVE;department:DMS;reportingManager:Mr.+Manish+Gupta;grade:P2;mobileNumber:8889100012;userType:General;', '2016-01-20 17:09:08', 1, 2, '2016-01-27 17:21:00'),
(3519, 'yugdeep.khawas@hcl.com', 'Pass1word2$', 'yugdeep.khawas@hcl.com', 2, 'firstName:Yugdeep;lastName:Khawas;location:NOIDA;position:MANAGER;department:Demand+Planning;reportingManager:Sagnik+Sen;grade:X4;mobileNumber:9650918686;userType:General;', '2016-01-20 17:12:12', 1, 2, '2016-01-27 17:21:00'),
(3520, 's.shekhar@hcl.com', 'hcli', 's.shekhar@hcl.com', 2, 'firstName:SHEKHAR;lastName:S;location:BHUBANESHWAR;position:AREA+SALES+MANAGER;department:DMS;reportingManager:MANAS+SAHU;grade:P3;mobileNumber:9831023160;userType:General;', '2016-01-20 17:18:47', 1, 2, '2016-01-27 17:21:00'),
(3521, 'gurpreet.bawa@hcl.com', 'gur@2292', 'gurpreet.bawa@hcl.com', 2, 'firstName:Gurpreet;lastName:Bawa;location:NOIDA;position:MANAGER;department:DMS;reportingManager:Naveen;grade:X4;mobileNumber:9910034347;userType:General;', '2016-01-20 17:19:57', 1, 2, '2016-01-27 17:21:00'),
(3522, 'ranaprathap@hcl.com', 'kappurana', 'ranaprathap@hcl.com', 2, 'firstName:Ranaprathap;lastName:Madugundu;location:HYDERABAD;position:AREA+SALES+MANAGER;department:DMS-NOKIA;reportingManager:SRIDHAR+C;grade:P3;mobileNumber:9701344466;userType:General;', '2016-01-20 17:28:17', 1, 2, '2016-01-27 17:21:00'),
(3523, 'ashish.sutar-assoc@hcl.com', 'hcl@123', 'ashish.sutar-assoc@hcl.com', 2, 'firstName:Ashish;lastName:Sutar;location:BHOPAL;position:ASSOCIATE;department:DMS-Nokia;reportingManager:Hitesh+Kumar+Chouhan;grade:P0;mobileNumber:9827086333;userType:General;', '2016-01-20 17:45:41', 1, 2, '2016-01-27 17:21:00'),
(3524, 'vikas.sah-assoc@hcl.com', 'deep@2312', 'vikas.sah-assoc@hcl.com', 2, 'firstName:vikash;lastName:sah;location:PATNA;position:ASSOCIATE;department:DMS;reportingManager:Navin+Singh;grade:P0;mobileNumber:8877772244;userType:General;', '2016-01-20 18:04:23', 1, 2, '2016-01-27 17:21:00'),
(3525, 'pankaj.mehra@hcl.com', 'devlop', 'pankaj.mehra@hcl.com', 2, 'firstName:pankaj;lastName:mehra;location:INDORE;position:ASSISTANT+MANAGER;department:Marketing;reportingManager:Himanshu+Sinha;grade:P3;mobileNumber:9200000166;userType:General;', '2016-01-20 18:13:21', 1, 2, '2016-01-27 17:21:00'),
(3526, 'gourango.mukherjee@hcl.com', 'Mana@1986', 'gourango.mukherjee@hcl.com', 2, 'firstName:Gourango;lastName:Mukherjee;location:KOLKATA;position:AREA+SALES+EXECUTIVE;department:DMS;reportingManager:Debojo+Rajeev;grade:P2;mobileNumber:%2B919007295986;userType:General;', '2016-01-20 18:17:00', 1, 2, '2016-01-27 17:21:00'),
(3527, 'vishal.ranja@hcl.com', 'ranjan@353', 'vishal.ranja@hcl.com', 2, 'firstName:VISHAL+;lastName:RANJAN;location:NOIDA;position:ASSISTANT+GENERAL+MANAGER;department:QUALITY;reportingManager:ANAND+PRAKASH;grade:P6;mobileNumber:9958555410;userType:General;', '2016-01-20 18:18:00', 1, 2, '2016-01-27 17:21:00'),
(3528, 'ganesh.chandra@hcl.com', 'gcbhui_419', 'ganesh.chandra@hcl.com', 2, 'firstName:Ganesh+Chandra;lastName:Bhui;location:NOIDA;position:SENIOR+EXECUTIVE;department:DMS;reportingManager:Gautam+Sahni;grade:X2;mobileNumber:8826000653;userType:General;', '2016-01-20 18:23:25', 1, 2, '2016-01-27 17:21:00'),
(3529, 'shailendra.tiwari-assocc@hcl.com', 'Vicky2143', 'shailendra.tiwari-assocc@hcl.com', 2, 'firstName:SHAILENDRA;lastName:TIWARI;location:RAIPUR;position:ASSOCIATE;department:DMS;reportingManager:HITESH+KUMAR+CHOUHAN;grade:P0;mobileNumber:7024153565;userType:General;', '2016-01-20 18:24:07', 1, 2, '2016-01-27 17:21:00'),
(3530, 'akbar.mitayighar@hcl.com', 'akbar@1988', 'akbar.mitayighar@hcl.com', 2, 'firstName:akbar;lastName:saleem;location:HYDERABAD;position:SALES+EXECUTIVE;department:DMS;reportingManager:Ranaprathap;grade:P1;mobileNumber:9000144646;userType:General;', '2016-01-20 18:30:16', 1, 2, '2016-01-27 17:21:00'),
(3531, 'sen.sagnik@gmail.com', 'exch@3333', 'sen.sagnik@gmail.com', 2, 'firstName:Sagnik;lastName:Sen;location:NOIDA;position:HEAD+-+SALES+OPERATIONS;department:Consumer+Distribution;reportingManager:Sutikshan+Naithani;grade:P6;mobileNumber:9910019303;userType:General;', '2016-01-20 18:44:48', 1, 2, '2016-01-27 17:21:00'),
(3532, 'sagnik.sen@hcl.com', 'exch@2222', 'sagnik.sen@hcl.com', 2, 'firstName:Sagnik;lastName:Sen;location:NOIDA;position:HEAD+-+SALES+OPERATIONS;department:Consumer+Distribution;reportingManager:Sutikshan+Naithani;grade:P6;mobileNumber:9910019303;userType:General;', '2016-01-20 18:49:13', 1, 2, '2016-01-27 17:21:00'),
(3533, 'vishal.ranjan@hcl.com', 'ranjan@353', 'vishal.ranjan@hcl.com', 2, 'firstName:VISHAL+;lastName:RANJAN;location:NOIDA;position:ASSISTANT+GENERAL+MANAGER;department:QUALITY;reportingManager:ANAND+PRAKASH;grade:P6;mobileNumber:9958555410;userType:General;', '2016-01-20 18:50:47', 1, 2, '2016-01-27 17:21:00'),
(3534, 'hitesh.chouhan@hcl.com', 'summer@123', 'hitesh.chouhan@hcl.com', 2, 'firstName:Hitesh;lastName:Chouhan;location:BHOPAL;position:BRANCH+MANAGER;department:DMS+Nokia+business;reportingManager:Heemanshu+Sinha;grade:P4;mobileNumber:7024144466;userType:General;', '2016-01-20 18:52:18', 1, 2, '2016-01-27 17:21:00'),
(3535, 'shailendra.tiwari-assoc@hcl.com', 'Vicky@143', 'shailendra.tiwari-assoc@hcl.com', 2, 'firstName:SHAILENDRA;lastName:TIWARI;location:RAIPUR;position:SALES+EXECUTIVE;department:DMS;reportingManager:HITESH+KUMAR+CHOUHAN;grade:P0;mobileNumber:7024153565;userType:General;', '2016-01-20 19:16:23', 1, 2, '2016-01-27 17:21:00'),
(3536, 'rounak.joshi-assoc@hcl.com', 'rou@2121', 'rounak.joshi-assoc@hcl.com', 2, 'firstName:rounak;lastName:joshi;location:BHOPAL;position:SALES+EXECUTIVE;department:sales+;reportingManager:Raviendra+Sable;grade:P0;mobileNumber:09770988731;userType:General;', '2016-01-20 19:16:42', 1, 2, '2016-01-27 17:21:00'),
(3537, 'uttam.sengar-assoc@hcl.com', 'hcl@2015', 'uttam.sengar-assoc@hcl.com', 2, 'firstName:uttam+singh;lastName:sengar;location:BHOPAL;position:ASSOCIATE;department:sales;reportingManager:gaurav+shrivastava;grade:P0;mobileNumber:8889910633;userType:General;', '2016-01-20 19:31:55', 1, 2, '2016-01-27 17:21:00'),
(3538, 'himangshu_99@rediffmail.com', 'prabhat', 'himangshu_99@rediffmail.com', 2, 'firstName:himangshu;lastName:barman;location:GUWAHATI;position:ASSOCIATE;department:nokia-device;reportingManager:swaskar+chakravarty;grade:P0;mobileNumber:8811089021;userType:General;', '2016-01-20 19:32:15', 1, 2, '2016-01-27 17:21:00');
INSERT INTO `users` (`seq`, `username`, `password`, `emailid`, `companyseq`, `customfieldvalues`, `createdon`, `isenabled`, `adminseq`, `lastmodifiedon`) VALUES
(3539, 'suhankar.chakraborty-assoc@hcl.com', 'subh1987', 'suhankar.chakraborty-assoc@hcl.com', 2, 'firstName:subhankar;lastName:chakraborty;location:KOLKATA;position:SALES+EXECUTIVE;department:dms;reportingManager:debojo+rajeev;grade:P0;mobileNumber:9831063621;userType:General;', '2016-01-20 19:44:14', 1, 2, '2016-01-27 17:21:00'),
(3540, 'subhankar-chkraborty-assov@hcl.com', 'subh12345', 'subhankar-chkraborty-assov@hcl.com', 2, 'firstName:subhankar;lastName:chakraborty;location:KOLKATA;position:SALES+EXECUTIVE;department:DMS;reportingManager:debojo+rajeev;grade:P0;mobileNumber:9831063621;userType:General;', '2016-01-20 19:49:34', 1, 2, '2016-01-27 17:21:00'),
(3541, 'subhankar.chakraborty-assoc@hcl.com', 'subha1234', 'subhankar.chakraborty-assoc@hcl.com', 2, 'firstName:subhankar;lastName:chakraborty;location:KOLKATA;position:SALES+EXECUTIVE;department:dms;reportingManager:debojo+rajeev;grade:P0;mobileNumber:9831063621;userType:General;', '2016-01-20 20:00:40', 1, 2, '2016-01-27 17:21:00'),
(3542, 'aniveshita@hcl.com', '04091986', 'aniveshita@hcl.com', 2, 'firstName:Aniveshita;lastName:Srivastava;location:NOIDA;position:ASSISTANT+MANAGER;department:HR;reportingManager:Priyanka+Priyadarshini;grade:P3;mobileNumber:9560629555;userType:General;', '2016-01-20 20:20:25', 1, 2, '2016-01-27 17:21:00'),
(3543, 'jitendraraghu@live.com', 'jitendra@123', 'jitendraraghu@live.com', 2, 'firstName:jitendra;lastName:raghuvanshi;location:BHOPAL;position:AREA+SALES+EXECUTIVE;department:DMS;reportingManager:gourav+shrivastava;grade:P0;mobileNumber:8889905051;userType:General;', '2016-01-20 20:29:49', 1, 2, '2016-01-27 17:21:00'),
(3544, 'shahid.ahmad-assoc@hcl.com', 'shah@123', 'shahid.ahmad-assoc@hcl.com', 2, 'firstName:shahid;lastName:ahmad;location:NOIDA+SECTOR-11;position:SALES+EXECUTIVE;department:sales;reportingManager:arshid+qureshi;grade:P1;mobileNumber:9796123459;userType:General;', '2016-01-20 21:05:48', 1, 2, '2016-01-27 17:21:00'),
(3545, 'ravindra.sable@hcl.com', 'Ravi@123', 'ravindra.sable@hcl.com', 2, 'firstName:RAVINDRA;lastName:SABLE;location:RAIPUR;position:AREA+MANAGER;department:DMS;reportingManager:HITESH+KUMAR+CHOHAN;grade:P4;mobileNumber:9993552688;userType:General;', '2016-01-20 21:08:39', 1, 2, '2016-01-27 17:21:00'),
(3546, 'bharat.dixit@hcl.com', 'bharat@74', 'bharat.dixit@hcl.com', 2, 'firstName:Bharat;lastName:Dixit;location:PUNE;position:BRANCH+SALES+OPERATIONS+MANAGER;department:DMS;reportingManager:Vikas+Sachdeva;grade:P4;mobileNumber:7507939977;userType:General;', '2016-01-20 21:14:04', 1, 2, '2016-01-27 17:21:00'),
(3547, 'shrivastava.gourav@hcl.com', 'Hcl@2085', 'shrivastava.gourav@hcl.com', 2, 'firstName:Gourav+;lastName:shrivastava;location:BHOPAL;position:AREA+SALES+MANAGER;department:dms+nokia;reportingManager:hitesh+chouhan;grade:P3;mobileNumber:9754015951;userType:General;', '2016-01-20 21:19:50', 1, 2, '2016-01-27 17:21:00'),
(3548, 'mukeshk-assoc@hcl.com', '44016407', 'mukeshk-assoc@hcl.com', 2, 'firstName:Mukesh+Kumar+;lastName:Gupta;location:PATNA;position:AREA+SALES+EXECUTIVE;department:Nokia+DMS;reportingManager:Arvind+tiwari;grade:P1;mobileNumber:7541806777;userType:General;', '2016-01-20 21:24:09', 1, 2, '2016-01-27 17:21:00'),
(3549, 'gaurav.shrivastava@hcl.com', 'devika@2535', 'gaurav.shrivastava@hcl.com', 2, 'firstName:gaurav;lastName:shrivastava;location:NOIDA+SECTOR-11;position:AREA+SALES+MANAGER;department:dms-nokia;reportingManager:ashish+singh;grade:P3;mobileNumber:8959570517;userType:General;', '2016-01-20 21:46:55', 1, 2, '2016-01-27 17:21:00'),
(3550, 'sharma.nishant@hcl.com', 'general25', 'sharma.nishant@hcl.com', 2, 'firstName:Nishant;lastName:Sharma;location:AHEMDABAD;position:SALES+MANAGER;department:DMS;reportingManager:Vidhu+Shekhar+Trivedi;grade:P3;mobileNumber:9998000695;userType:General;', '2016-01-20 22:13:48', 1, 2, '2016-01-27 17:21:00'),
(3551, 'Abhishekjoshi60@gmail.com', 'abhishek8999', 'Abhishekjoshi60@gmail.com', 2, 'firstName:Abhishek+;lastName:Joshi+;location:AHEMDABAD;position:ASSOCIATE;department:DMS+Nokia+;reportingManager:Vidhu+shekhar+Trivedi+;grade:P0;mobileNumber:8238414314;userType:General;', '2016-01-20 23:00:13', 1, 2, '2016-01-27 17:21:00'),
(3552, 'sahil@hcl.com', 'Sahil@12', 'sahil@hcl.com', 2, 'firstName:Sahil;lastName:Sareen;location:DELHI;position:EXECUTIVE+-+HR;department:HR;reportingManager:Priyanka+Priyadarshini;grade:P2;mobileNumber:9873990024;userType:General;', '2016-01-20 23:14:26', 1, 2, '2016-01-27 17:21:00'),
(3553, 'shashwat.s@hcl.com', 'hcl123', 'shashwat.s@hcl.com', 2, 'firstName:SHASHWAT;lastName:SINHA;location:HYDERABAD;position:KEY+ACCOUNT+EXECUTIVE;department:DMS;reportingManager:DENNIS+MATHEW;grade:P3;mobileNumber:8105601010;userType:General;', '2016-01-20 23:43:21', 1, 2, '2016-01-27 17:21:00'),
(3554, 'harish.chopra@hcl.com', 'adit@1963', 'harish.chopra@hcl.com', 2, 'firstName:HARISH;lastName:CHOPRA;location:NOIDA+SECTOR-11;position:MANAGER;department:SCM;reportingManager:DEVESH+SHANKAR;grade:P5;mobileNumber:9818092538;userType:General;', '2016-01-21 10:54:58', 1, 2, '2016-01-27 17:21:00'),
(3555, 'khatri.paresh@hcl.com', 'Radhe@2506', 'khatri.paresh@hcl.com', 2, 'firstName:PARESH;lastName:KHATRI;location:NAGPUR;position:AREA+SALES+EXECUTIVE;department:DMS;reportingManager:RATNESH+PATEL+;grade:P2;mobileNumber:9860082000;userType:General;', '2016-01-21 14:07:09', 1, 2, '2016-01-27 17:21:00'),
(3556, 'amit.dayal@hcl.com', 'amit@2014', 'amit.dayal@hcl.com', 2, 'firstName:AMIT;lastName:DAYAL;location:DEHRADUN;position:SALES+MANAGER;department:NOKIA+DMS;reportingManager:ASHISH+SINGH;grade:P3;mobileNumber:8449000900;userType:General;', '2016-01-21 15:27:18', 1, 2, '2016-01-27 17:21:00'),
(3557, 'nishant.rana@hcl.com', 'Admin123', 'nishant.rana@hcl.com', 2, 'firstName:Nishant;lastName:rana;location:NOIDA+SECTOR-11;position:AREA+SALES+EXECUTIVE;department:DDMS;reportingManager:Dheeraj+Joshi;grade:P2;mobileNumber:9996164252;userType:General;', '2016-01-21 15:36:24', 1, 2, '2016-01-27 17:21:00'),
(3558, 'shantanu.dixit@hcl.com', 'troubler@1', 'shantanu.dixit@hcl.com', 2, 'firstName:Shantanu;lastName:Dixit;location:NOIDA;position:MANAGER+-+SALES;department:Nokia+-+DMS;reportingManager:Dheeraj+Joshi;grade:P4;mobileNumber:9988555775;userType:General;', '2016-01-21 15:37:01', 1, 2, '2016-01-27 17:21:00'),
(3559, 'somnath.barik-assoc@hcl.com', 'hcli@123', 'somnath.barik-assoc@hcl.com', 2, 'firstName:Somnath;lastName:Barik;location:KOLKATA;position:SALES+CO-ORDINATOR;department:DMS;reportingManager:Debojo+Rajeev;grade:P0;mobileNumber:9831162449;userType:General;', '2016-01-21 15:50:17', 1, 2, '2016-01-27 17:21:00'),
(3560, 'k.khati@hcl.com', 'pranay', 'k.khati@hcl.com', 2, 'firstName:Kunwar+;lastName:Khati;location:NOIDA+SECTOR-11;position:DEPUTY+MANAGER;department:Logistics;reportingManager:Mr.+Devesh+Shankar;grade:P8;mobileNumber:9650526888;userType:General;', '2016-01-21 16:13:13', 1, 2, '2016-01-27 17:21:00'),
(3561, 'protyush.karmakar-assoc@hcl.com', 'p@ssw0rd', 'protyush.karmakar-assoc@hcl.com', 2, 'firstName:Protyush;lastName:Karmakar;location:KOLKATA;position:SALES+CO-ORDINATOR;department:DMS;reportingManager:Heemanshu+Sinha;grade:P0;mobileNumber:9831067552;userType:General;', '2016-01-21 16:13:37', 1, 2, '2016-01-27 17:21:00'),
(3562, 'bablu.sharma-assoc@hcl.com', 'Jan@2016', 'bablu.sharma-assoc@hcl.com', 2, 'firstName:Babloo;lastName:Sharma;location:NOIDA;position:EXECUTIVE;department:DMS;reportingManager:Vikas+Kumar+Jha;grade:P0;mobileNumber:9560620093;userType:General;', '2016-01-21 16:15:00', 1, 2, '2016-01-27 17:21:00'),
(3563, 'manishsingh-assoc@hcl.com', 'manish@2960', 'manishsingh-assoc@hcl.com', 2, 'firstName:Manish;lastName:Bhadoria;location:DEHRADUN;position:ASSOCIATE;department:nokia+dms;reportingManager:Amit+Dayal;grade:P0;mobileNumber:8958773000;userType:General;', '2016-01-21 16:15:07', 1, 2, '2016-01-27 17:21:00'),
(3564, 'mayank@hcl.com', 'mayank@1990', 'mayank@hcl.com', 2, 'firstName:Mayank;lastName:.;location:NOIDA;position:ASSOCIATE;department:DBMS;reportingManager:Hem+chandra+Pandey;grade:X0;mobileNumber:8802262156;userType:General;', '2016-01-21 16:16:06', 1, 2, '2016-01-27 17:21:00'),
(3565, 'kallol.dutta@hcl.com', 'kd181174', 'kallol.dutta@hcl.com', 2, 'firstName:Kallol+Kumar;lastName:Dutta;location:KOLKATA;position:REGIONAL+SALES+MANAGER;department:DMS;reportingManager:Heemangshu+Kr+Sinha;grade:P5;mobileNumber:9903387744;userType:General;', '2016-01-21 16:17:32', 1, 2, '2016-01-27 17:21:00'),
(3566, 'trilok.singh@hcl.com', 'adhikari@16', 'trilok.singh@hcl.com', 2, 'firstName:TRILOK;lastName:ADHIKARI;location:NOIDA;position:ASSOCIATE;department:DMS;reportingManager:HEM+PANDE;grade:X0;mobileNumber:9560897795;userType:General;', '2016-01-21 16:29:13', 1, 2, '2016-01-27 17:21:00'),
(3567, 'tradesupport.cc@hcl.com', 'sadik@1234', 'tradesupport.cc@hcl.com', 2, 'firstName:Sadik+;lastName:hasan;location:NOIDA;position:ASSOCIATE;department:Commercial+;reportingManager:Krishan+Dutt+Upadhyay+;grade:X0;mobileNumber:9818004914;userType:General;', '2016-01-21 16:31:15', 1, 2, '2016-01-27 17:21:00'),
(3568, 'sumesh.s@hcl.com', 'Password123', 'sumesh.s@hcl.com', 2, 'firstName:Sumesh;lastName:Panicker;location:COCHIN;position:AREA+SALES+EXECUTIVE;department:Sales;reportingManager:Jithin+S+V;grade:P1;mobileNumber:9567271821;userType:General;', '2016-01-21 16:35:30', 1, 2, '2016-01-27 17:21:00'),
(3569, 'tradesupport.seven@hcl.com', 'mamta@5858', 'tradesupport.seven@hcl.com', 2, 'firstName:Rakesh;lastName:Nougaine;location:NOIDA;position:ASSOCIATE;department:DMS;reportingManager:Hem+Chandra+Pande;grade:X0;mobileNumber:9871444311;userType:General;', '2016-01-21 16:36:36', 1, 2, '2016-01-27 17:21:00'),
(3570, 'ojt-y.chary@hcl.com', 'P@ssw0rd16', 'ojt-y.chary@hcl.com', 2, 'firstName:Y+VITTALA;lastName:CHARY;location:HYDERABAD;position:ASSOCIATE;department:DMS;reportingManager:SRIDHAR+C;grade:P0;mobileNumber:9177499052;userType:General;', '2016-01-21 16:48:45', 1, 2, '2016-01-27 17:21:00'),
(3571, 'ajay.sabareesh-assoc@hcl.com', '9500039893', 'ajay.sabareesh-assoc@hcl.com', 2, 'firstName:Ajay++;lastName:Sabareesh;location:CHENNAI;position:ASSOCIATE;department:Microsoft%2FNokia+DMS;reportingManager:VP+Balaji;grade:P0;mobileNumber:9500039893;userType:General;', '2016-01-21 16:51:03', 1, 2, '2016-01-27 17:21:00'),
(3572, 'jai.rai@hcl.com', 'Nokia123', 'jai.rai@hcl.com', 2, 'firstName:Jai+Narayan+;lastName:Rai;location:JAIPUR;position:AREA+SALES+MANAGER;department:Nokia+DMS;reportingManager:Vikram+Parashar;grade:P3;mobileNumber:9660786999;userType:General;', '2016-01-21 16:56:50', 1, 2, '2016-01-27 17:21:00'),
(3573, 'sijo.george-assoc@hcl.com', 'sijo@4151', 'sijo.george-assoc@hcl.com', 2, 'firstName:Sijo;lastName:George;location:COCHIN;position:ASSOCIATE;department:DMS;reportingManager:Varghese+Jacob;grade:P0;mobileNumber:9946396396;userType:General;', '2016-01-21 16:58:32', 1, 2, '2016-01-27 17:21:00'),
(3574, 'Jain.ankit@hcl.com', 'aditijain', 'Jain.ankit@hcl.com', 2, 'firstName:Ankit;lastName:Jain;location:DELHI;position:SALES+MANAGER;department:Nokia;reportingManager:Ashish+singh;grade:P3;mobileNumber:9910188099;userType:General;', '2016-01-21 16:58:48', 1, 2, '2016-01-27 17:21:00'),
(3575, 'ojt-dhandapani.k@hcl.com', 'Dandy', 'ojt-dhandapani.k@hcl.com', 2, 'firstName:Dhandapani;lastName:Karunakaran;location:CHENNAI;position:ASSOCIATE;department:DMS;reportingManager:Manicka+Prabhu+K;grade:P0;mobileNumber:9840939594;userType:General;', '2016-01-21 16:59:29', 1, 2, '2016-01-27 17:21:00'),
(3576, 'pawanjaiswal009@gmail.com', 'pawan@334', 'pawanjaiswal009@gmail.com', 2, 'firstName:Pawan;lastName:Jaiswal;location:BHOPAL;position:ASSOCIATE;department:DMS;reportingManager:Hitesh+Kumar+Chouhan;grade:P0;mobileNumber:09755549976;userType:General;', '2016-01-21 17:05:08', 1, 2, '2016-01-27 17:21:00'),
(3577, 'raman.kumar-assoc@hcl.com', 'singer@123', 'raman.kumar-assoc@hcl.com', 2, 'firstName:Raman;lastName:Kumar;location:CHANDIGARH;position:ASSOCIATE;department:DMS;reportingManager:Hitender+Kumar;grade:P0;mobileNumber:8146586644;userType:General;', '2016-01-21 17:06:25', 1, 2, '2016-01-27 17:21:00'),
(3578, 'gauravsin87@hcl.com', '987654123@', 'gauravsin87@hcl.com', 2, 'firstName:Gaurav;lastName:singh;location:LUCKNOW;position:EXECUTIVE+-+COMMERCIAL;department:Integrated+Supply+Chain+Management;reportingManager:Sanjib+Sen;grade:X1;mobileNumber:8400399888;userType:General;', '2016-01-21 17:07:28', 1, 2, '2016-01-27 17:21:00'),
(3579, 'pawanjaiswal-assoc@hcl.com', 'PAWAN@334', 'pawanjaiswal-assoc@hcl.com', 2, 'firstName:pawan;lastName:Jaiswal;location:BHOPAL;position:ASSOCIATE;department:DMS;reportingManager:Hitesh+Kumar+Chouhan;grade:P0;mobileNumber:09755549976;userType:General;', '2016-01-21 17:08:00', 1, 2, '2016-01-27 17:21:00'),
(3580, 'Atul.Sharma-assoc@hcl.com', 'Ashi!111', 'Atul.Sharma-assoc@hcl.com', 2, 'firstName:Atul;lastName:Sharma;location:CHANDIGARH;position:ASSOCIATE;department:DMS;reportingManager:Dheeraj+joshi;grade:P0;mobileNumber:8146608283;userType:General;', '2016-01-21 17:08:22', 1, 2, '2016-01-27 17:21:00'),
(3581, 'praveen.dutta@hcl.com', 'datta@1973', 'praveen.dutta@hcl.com', 2, 'firstName:PRAVEEN+KUMAR+;lastName:DATTA;location:BHOPAL;position:EXECUTIVE+-+ACCOUNTS;department:DMS+ACCOUNTS+SHARED;reportingManager:NARENDRA+NAUTIYAL;grade:X2;mobileNumber:9630027722;userType:General;', '2016-01-21 17:14:01', 1, 2, '2016-01-27 17:21:00'),
(3582, 'sush.choudhary85@gmail.com', 'rishit15', 'sush.choudhary85@gmail.com', 2, 'firstName:Sushma;lastName:Lama;location:NEW+DELHI;position:SENIOR+EXECUTIVE+-+CREDIT+COLLECTION;department:Credit+Control;reportingManager:Rajiv+Manchanda;grade:P2;mobileNumber:08527455977;userType:General;', '2016-01-21 17:15:54', 1, 2, '2016-01-27 17:21:00'),
(3583, 'sanjeevkumar-assoc@hcl.com', 'sanjeev@1986', 'sanjeevkumar-assoc@hcl.com', 2, 'firstName:sanjeev+;lastName:kumar;location:RANCHI;position:AREA+SALES+EXECUTIVE;department:DMS;reportingManager:SUDEEP+GHOSH;grade:P0;mobileNumber:8294630286;userType:General;', '2016-01-21 17:19:13', 1, 2, '2016-01-27 17:21:00'),
(3584, 'lakshmi.jeya@hcl.com', 'DONTASKME', 'lakshmi.jeya@hcl.com', 2, 'firstName:Jeya+Lakshmi;lastName:Maharaj;location:NOIDA+-+DDMS;position:AREA+SALES+EXECUTIVE;department:Consumer+Distribution;reportingManager:Gurpreet+Bawa;grade:P0;mobileNumber:7042477553;userType:General;', '2016-01-21 17:19:47', 1, 2, '2016-01-27 17:21:00'),
(3585, 'apurva.pandya-assoc@hcl.com', 'lovely240630', 'apurva.pandya-assoc@hcl.com', 2, 'firstName:apurva;lastName:pandya;location:JAIPUR;position:ASSOCIATE;department:sales;reportingManager:jai+narayan+rai;grade:P0;mobileNumber:9887778859;userType:General;', '2016-01-21 17:19:47', 1, 2, '2016-01-27 17:21:00'),
(3586, 'shanmuganathan.a-assoc@hcl.com', 'Shyam@123', 'shanmuganathan.a-assoc@hcl.com', 2, 'firstName:shanmuganathan;lastName:A;location:CHENNAI;position:ASSOCIATE;department:DMS;reportingManager:Ms.Ulaganathan;grade:P0;mobileNumber:9840139691;userType:General;', '2016-01-21 17:31:41', 1, 2, '2016-01-27 17:21:00'),
(3587, 'mukeshkumr-assoc@hcl.com', 'fortis@123', 'mukeshkumr-assoc@hcl.com', 2, 'firstName:Mukesh+;lastName:Kumar;location:KOLKATA;position:SALES+EXECUTIVE;department:DMS;reportingManager:Debasish+Basak;grade:P0;mobileNumber:8509678802;userType:General;', '2016-01-21 17:39:22', 1, 2, '2016-01-27 17:21:00'),
(3588, 'ganesh.shanker-assoc@hcl.com', '123456', 'ganesh.shanker-assoc@hcl.com', 2, 'firstName:Ganesh;lastName:Saxena;location:LUCKNOW;position:ASSOCIATE;department:DMS;reportingManager:Manas+Kumar;grade:P0;mobileNumber:7080274888;userType:General;', '2016-01-21 17:41:54', 1, 2, '2016-01-27 17:21:00'),
(3589, 'abhishek.lohia-assoc@hcl.com', 'loh@33', 'abhishek.lohia-assoc@hcl.com', 2, 'firstName:Abhishek;lastName:Lohia;location:KOLKATA;position:SALES+EXECUTIVE;department:DMS;reportingManager:Debasish+Basak;grade:P0;mobileNumber:9732018151;userType:General;', '2016-01-21 17:42:03', 1, 2, '2016-01-27 17:21:00'),
(3590, 'manas.sahu@hcl.com', 'tiger1234#', 'manas.sahu@hcl.com', 2, 'firstName:MANAS;lastName:SAHU;location:BHUBANESHWAR;position:BRANCH+MANAGER;department:DMS;reportingManager:HEEMANSHU+KUMAR+SINHA;grade:P4;mobileNumber:9937492006;userType:General;', '2016-01-21 17:44:14', 1, 2, '2016-01-27 17:21:00'),
(3591, 'golok_dea@yahoo.in', '1234', 'golok_dea@yahoo.in', 2, 'firstName:golok;lastName:deka;location:GUWAHATI;position:ASSOCIATE;department:dms;reportingManager:sanjay+deka;grade:P0;mobileNumber:8811093909;userType:General;', '2016-01-21 17:47:47', 1, 2, '2016-01-27 17:21:00'),
(3592, 'poorna.chandra-assoc@hcl.com', 'hcl@123', 'poorna.chandra-assoc@hcl.com', 2, 'firstName:poorna+chandra+rao;lastName:Inapala;location:HYDERABAD;position:SALES+EXECUTIVE;department:NOKIA;reportingManager:Ranaprathap+M;grade:P0;mobileNumber:8008888752;userType:General;', '2016-01-21 17:53:32', 1, 2, '2016-01-27 17:21:00'),
(3593, 'sda@gmail.com', 'sdfgh', 'sda@gmail.com', 2, 'firstName:sudeep;lastName:kuma;location:HUBLI;position:AREA+SALES+EXECUTIVE;department:dms;reportingManager:sheu;grade:P0;mobileNumber:9463154454;userType:General;', '2016-01-21 18:04:21', 1, 2, '2016-01-27 17:21:00'),
(3594, 'manas.pradhan-assoc@hcl.com', 'manas7878', 'manas.pradhan-assoc@hcl.com', 2, 'firstName:manas;lastName:pradhan;location:BHUBANESHWAR;position:ASSOCIATE;department:DMS;reportingManager:MANAS+SAHU;grade:P0;mobileNumber:7894426805;userType:General;', '2016-01-21 18:10:38', 1, 2, '2016-01-27 17:21:00'),
(3595, 'mucherla.rajesh_assoc@hcl.com', 'rajesh@8792', 'mucherla.rajesh_assoc@hcl.com', 2, 'firstName:rajesh;lastName:mucherla;location:HYDERABAD;position:SALES+EXECUTIVE;department:dms;reportingManager:mahesh+vepuri;grade:P0;mobileNumber:9000144737;userType:General;', '2016-01-21 18:19:59', 1, 2, '2016-01-27 17:21:00'),
(3596, 'mucherla.rajesh-assoc@hcl.com', 'much8768', 'mucherla.rajesh-assoc@hcl.com', 2, 'firstName:rajesh;lastName:mucherla;location:HYDERABAD;position:SENIOR+SALES+EXECUTIVE;department:dms;reportingManager:mahes+vepurui;grade:P0;mobileNumber:9000144737;userType:General;', '2016-01-21 18:31:29', 1, 2, '2016-01-27 17:21:00'),
(3597, 'praveen.rannaot@hcl.com', 'hcl@125', 'praveen.rannaot@hcl.com', 2, 'firstName:praveen;lastName:rannaot;location:CHANDIGARH;position:MANAGER+-+MARKETING;department:Marketing;reportingManager:nikhil+jain;grade:P3;mobileNumber:9857814023;userType:General;', '2016-01-21 18:54:27', 1, 2, '2016-01-27 17:21:00'),
(3598, 'm.jothimani-assoc@hcl.com', 'noid5483', 'm.jothimani-assoc@hcl.com', 2, 'firstName:JOTHI;lastName:MANI;location:CHENNAI;position:ASSOCIATE;department:DMS;reportingManager:SATHEESHKUMAR;grade:P0;mobileNumber:9840605295;userType:General;', '2016-01-21 18:57:37', 1, 2, '2016-01-27 17:21:00'),
(3599, 'Krajesh-assoc@hcl.com', 'rajesh@23', 'Krajesh-assoc@hcl.com', 2, 'firstName:Rajesh;lastName:Kumar;location:PATNA;position:ASSOCIATE;department:HCL+Infosystems+Ltd.;reportingManager:ASM;grade:P0;mobileNumber:7070984645;userType:General;', '2016-01-21 18:59:08', 1, 2, '2016-01-27 17:21:00'),
(3600, 'sambit.mohapatra-assoc@hcl.com', 'sambithcl', 'sambit.mohapatra-assoc@hcl.com', 2, 'firstName:sambit;lastName:mohapatra;location:BHUBANESHWAR;position:ASSOCIATE;department:general+trade+dms;reportingManager:s.shekhar;grade:P0;mobileNumber:9776523357;userType:General;', '2016-01-21 19:00:50', 1, 2, '2016-01-27 17:21:00'),
(3601, 'kowsik.sethu-assoc@hcl.com', 'kowsiksr12@', 'kowsik.sethu-assoc@hcl.com', 2, 'firstName:Kowsik;lastName:Sethu+Raman;location:CHENNAI;position:ASSOCIATE;department:Dms;reportingManager:Satheesh;grade:P0;mobileNumber:9894576704;userType:General;', '2016-01-21 19:01:20', 1, 2, '2016-01-27 17:21:00'),
(3602, 'tradesupport.two@hcl.com', 'ravi@4182', 'tradesupport.two@hcl.com', 2, 'firstName:Ravi;lastName:chuatala;location:NOIDA;position:ASSOCIATE;department:DMS;reportingManager:HEM+CHANDRA+PANDE;grade:X0;mobileNumber:8527400449;userType:General;', '2016-01-21 19:11:09', 1, 2, '2016-01-27 17:21:00'),
(3603, 'tradesupport.one@hcl.com', 'sbansal123', 'tradesupport.one@hcl.com', 2, 'firstName:SUNIT;lastName:KUMAR;location:NOIDA;position:ASSOCIATE;department:DMS;reportingManager:HEM+CHANDRA+PANDE;grade:X0;mobileNumber:9990277567;userType:General;', '2016-01-21 19:21:42', 1, 2, '2016-01-27 17:21:00'),
(3604, 'vijay.singh-assoc@hcl.com', 'abhay22015', 'vijay.singh-assoc@hcl.com', 2, 'firstName:VIJAY+SINGH;lastName:KUSHWAHA;location:NOIDA+SECTOR-11;position:ASSOCIATE;department:DMS;reportingManager:HEM+PANDEY;grade:X0;mobileNumber:9560886133;userType:General;', '2016-01-21 19:25:17', 1, 2, '2016-01-27 17:21:00'),
(3605, 'syedmuntazar27@gmail.com', 'syed7272', 'syedmuntazar27@gmail.com', 2, 'firstName:SYED;lastName:MUNTAZAR;location:BANGALORE;position:AREA+SALES+EXECUTIVE;department:SALES;reportingManager:SRINIVAS+PISIPATHI;grade:P0;mobileNumber:9902048909;userType:General;', '2016-01-21 19:37:22', 1, 2, '2016-01-27 17:21:00'),
(3606, 'jitendra.kum-assoc@hcl.com', 'ayushi', 'jitendra.kum-assoc@hcl.com', 2, 'firstName:jitendra+kumar;lastName:singh;location:PATNA;position:ASSOCIATE;department:sales;reportingManager:ASM;grade:P0;mobileNumber:9015377939;userType:General;', '2016-01-21 20:27:30', 1, 2, '2016-01-27 17:21:00'),
(3607, 'binoyn@hcl.com', 'aRTIST@1982', 'binoyn@hcl.com', 2, 'firstName:BINOY;lastName:N;location:SEC11-NOIDA;position:SENIOR+CUSTOMER+ENGINEER;department:CONSUMER+DISTRIBUTION;reportingManager:DEEPANKAR+SRIVASTAVA;grade:P2;mobileNumber:9871341760;userType:General;', '2016-01-21 20:28:44', 1, 2, '2016-01-27 17:21:00'),
(3608, 'ratnesh.patel@hcl.com', 'ratnesh123', 'ratnesh.patel@hcl.com', 2, 'firstName:Ratnesh;lastName:Patel;location:NAGPUR;position:SALES+MANAGER;department:DMS;reportingManager:Achal+Maloo;grade:P4;mobileNumber:9824949464;userType:General;', '2016-01-21 21:19:11', 1, 2, '2016-01-27 17:21:00'),
(3609, 'earnest.ragul-assoc@hcl.com', 'noid5477', 'earnest.ragul-assoc@hcl.com', 2, 'firstName:Earnest;lastName:Ragul;location:CHENNAI;position:ASSOCIATE;department:DMS;reportingManager:Manicka+Prabhu;grade:P0;mobileNumber:9791106038;userType:General;', '2016-01-21 22:10:28', 1, 2, '2016-01-27 17:21:00'),
(3610, 'paras.saxena@hcl.com', '9891245213', 'paras.saxena@hcl.com', 2, 'firstName:Paras;lastName:Saxena;location:NOIDA;position:ASSISTANT+MANAGER;department:Marketing+DDMS;reportingManager:Nikhil+Jain;grade:P3;mobileNumber:9818309869;userType:General;', '2016-01-21 22:58:15', 1, 2, '2016-01-27 17:21:00'),
(3611, 'srinivas.mh@hcl.com', 'renukadevi45', 'srinivas.mh@hcl.com', 2, 'firstName:Srinivas;lastName:Kumar;location:BANGALORE;position:AREA+SALES+MANAGER;department:sales;reportingManager:Srinivas+pisapati;grade:P3;mobileNumber:9916824827;userType:General;', '2016-01-22 00:03:38', 1, 2, '2016-01-27 17:21:00'),
(3612, 'tunav.dev@hcl.com', 'tunav@15', 'tunav.dev@hcl.com', 2, 'firstName:Tunav+;lastName:Dev;location:AHEMDABAD;position:KEY+ACCOUNT+EXECUTIVE;department:DMS-Sales;reportingManager:Manohar+Nadigatla;grade:P2;mobileNumber:7600003437;userType:General;', '2016-01-22 08:19:42', 1, 2, '2016-01-27 17:21:00'),
(3613, 'dilip.a@hcl.com', 'arathil@3870', 'dilip.a@hcl.com', 2, 'firstName:Dilip;lastName:AC;location:COCHIN;position:AREA+SALES+MANAGER;department:DMS;reportingManager:Varghese+Jacob+;grade:P4;mobileNumber:8119363535;userType:General;', '2016-01-22 09:54:49', 1, 2, '2016-01-27 17:21:00'),
(3614, 'anilvig@hcl.com', 'hcli@2282', 'anilvig@hcl.com', 2, 'firstName:ANIL;lastName:VIG;location:NOIDA+SECTOR-11;position:CONSULTANT;department:F%26A;reportingManager:Rashmi+Srivastava+;grade:P6;mobileNumber:9599221490;userType:General;', '2016-01-22 10:03:14', 1, 2, '2016-01-27 17:21:00'),
(3615, 'aneesh.porwal@hcl.com', '9374713479', 'aneesh.porwal@hcl.com', 2, 'firstName:Aneesh;lastName:Porwal;location:MUMBAI;position:KEY+ACCOUNT+EXECUTIVE;department:DMS;reportingManager:Manohar+Rajayya+Nadigatla;grade:P1;mobileNumber:7043303344;userType:General;', '2016-01-22 10:06:33', 1, 2, '2016-01-27 17:21:00'),
(3616, 'siba.prasad-assoc@hcl.com', 'siba1234', 'siba.prasad-assoc@hcl.com', 2, 'firstName:Sibaprasad;lastName:kanungo;location:BHUBANESHWAR;position:ASSOCIATE;department:DMS;reportingManager:S+Shekhar;grade:P0;mobileNumber:7752017654;userType:General;', '2016-01-22 10:23:51', 1, 2, '2016-01-27 17:21:00'),
(3617, 'pradumn.chaturvedi@hcl.com', 'nunu1987', 'pradumn.chaturvedi@hcl.com', 2, 'firstName:Pradumn;lastName:Chaturvedi;location:PUNE;position:ASSISTANT+MANAGER;department:Marekting;reportingManager:Himanshu+Shekhar+Niraj;grade:P2;mobileNumber:9769383998;userType:General;', '2016-01-22 10:37:57', 1, 2, '2016-01-27 17:21:00'),
(3618, 'm.aparna@hcl.com', 'aparna1983', 'm.aparna@hcl.com', 2, 'firstName:Aparna;lastName:M;location:CHENNAI;position:SENIOR+EXECUTIVE;department:Finance+and+Accounts+-+Trichy;reportingManager:J.+Govindanathan;grade:P2;mobileNumber:9894998900;userType:General;', '2016-01-22 11:00:15', 1, 2, '2016-01-27 17:21:00'),
(3619, 'kumar.suresh-assoc@hcl.com', 'sure4535', 'kumar.suresh-assoc@hcl.com', 2, 'firstName:suresh;lastName:grandhi;location:HYDERABAD;position:ASSOCIATE;department:DMS;reportingManager:SARPENDRA;grade:P0;mobileNumber:9000142242;userType:General;', '2016-01-22 11:24:42', 1, 2, '2016-01-27 17:21:00'),
(3620, 'pravenish@msn.com', 'hcl@125', 'pravenish@msn.com', 2, 'firstName:praveen;lastName:rannaot;location:CHANDIGARH;position:MANAGER+-+MARKETING;department:marketing;reportingManager:nikhil+jain;grade:P3;mobileNumber:9857814023;userType:General;', '2016-01-22 11:31:32', 1, 2, '2016-01-27 17:21:00'),
(3621, 'kenchagundi-assoc@hcl.com', 'Jan@2016', 'kenchagundi-assoc@hcl.com', 2, 'firstName:CHANDRASHEKHAR;lastName:KENCHAGUNDI;location:PUNE;position:SALES+CO-ORDINATOR;department:DMS;reportingManager:MURLIDHAR+KONGOVI;grade:P0;mobileNumber:7720082144;userType:General;', '2016-01-22 11:33:11', 1, 2, '2016-01-27 17:21:00'),
(3622, 'vidhushekhar.trivedi@hcl.com', 'saibaba1976', 'vidhushekhar.trivedi@hcl.com', 2, 'firstName:Vidhu;lastName:Trivedi;location:AHEMDABAD;position:BRANCH+MANAGER;department:consumer+Distribution;reportingManager:Ajitabh+Jereth;grade:P5;mobileNumber:8758275027;userType:General;', '2016-01-22 11:55:17', 1, 2, '2016-01-27 17:21:00'),
(3623, 'biswajit.dey@hcl.com', 'Bisw@3010', 'biswajit.dey@hcl.com', 2, 'firstName:Biswajit;lastName:Dey;location:PATNA;position:EXECUTIVE;department:DMS;reportingManager:Sanjib+Sen;grade:X1;mobileNumber:7763816317;userType:General;', '2016-01-22 11:58:25', 1, 2, '2016-01-27 17:21:00'),
(3624, 'rakesh.meghani@hcl.com', 'kiramegh', 'rakesh.meghani@hcl.com', 2, 'firstName:RAKESH;lastName:MEGHANI;location:BHOPAL;position:BRANCH+SALES+OPERATIONS+MANAGER;department:NOKIA-DEVICE;reportingManager:HITESH+CHOUHAN;grade:P3;mobileNumber:8718077777;userType:General;', '2016-01-22 12:01:20', 1, 2, '2016-01-27 17:21:00'),
(3625, 'parvez.ahmad@hcl.com', 'Affaan@2014', 'parvez.ahmad@hcl.com', 2, 'firstName:Parvez;lastName:Khan;location:PUNE;position:SALES+MANAGER;department:Sales;reportingManager:Murlidhar+Kongovi;grade:P3;mobileNumber:9960330009;userType:General;', '2016-01-22 12:20:17', 1, 2, '2016-01-27 17:21:00'),
(3626, 'arshid.ahmad@hcl.com', 'arshad123', 'arshid.ahmad@hcl.com', 2, 'firstName:Qurashi;lastName:Arshid;location:CHANDIGARH;position:REGIONAL+MANAGER;department:Sales;reportingManager:Ajitabh+Mohan+Jerath;grade:P4;mobileNumber:8803848384;userType:General;', '2016-01-22 12:27:43', 1, 2, '2016-01-27 17:21:00'),
(3627, 'rajesh.mangwani@hcl.com', 'lovehurts', 'rajesh.mangwani@hcl.com', 2, 'firstName:Rajesh;lastName:Mangwani;location:AHEMDABAD;position:SALES+MANAGER;department:DMS;reportingManager:Vidhu+Shekhar+Trivedi;grade:P4;mobileNumber:8980007868;userType:General;', '2016-01-22 12:39:26', 1, 2, '2016-01-27 17:21:00'),
(3628, 'sohel.s-assoc@hcl.com', 'sohe8921', 'sohel.s-assoc@hcl.com', 2, 'firstName:SOHEL;lastName:SHAIKH;location:AHEMDABAD;position:ASSOCIATE;department:NOKIA+DMS;reportingManager:VIDHU+SHEKHAR+TRIVEDI;grade:P0;mobileNumber:9979118016;userType:General;', '2016-01-22 12:49:20', 1, 2, '2016-01-27 17:21:00'),
(3629, 'shrikant.daphal65@gmail.com', 'nokia@12', 'shrikant.daphal65@gmail.com', 2, 'firstName:SHRIKANT;lastName:DAPHAL;location:PUNE;position:ASSOCIATE;department:SALES;reportingManager:NAGESH+HALGALI;grade:P0;mobileNumber:8380063702;userType:General;', '2016-01-22 12:59:55', 1, 2, '2016-01-27 17:21:00'),
(3630, 'abhaya.kumar-assoc@hcl.com', 'abhaya100', 'abhaya.kumar-assoc@hcl.com', 2, 'firstName:Abhaya+kumar;lastName:Sethy;location:BHUBANESHWAR;position:ASSOCIATE;department:DMS;reportingManager:S+Shekhar;grade:P0;mobileNumber:7752017655;userType:General;', '2016-01-22 13:03:35', 1, 2, '2016-01-27 17:21:00'),
(3631, 'muppana.anilkumar-assoc@hcl.com', 'mupp6541', 'muppana.anilkumar-assoc@hcl.com', 2, 'firstName:muppana;lastName:anilkumar;location:HYDERABAD;position:AREA+SALES+EXECUTIVE;department:DMS;reportingManager:suresh+babu+gunti;grade:P0;mobileNumber:8978885433;userType:General;', '2016-01-22 13:06:43', 1, 2, '2016-01-27 17:21:00'),
(3632, 'santosh.kumar-assoc@hcl.com', 'harshit@14', 'santosh.kumar-assoc@hcl.com', 2, 'firstName:Santosh;lastName:Gupta;location:DELHI;position:ASSOCIATE;department:DMS;reportingManager:Virender+singh;grade:X5;mobileNumber:9311119316;userType:General;', '2016-01-22 13:10:54', 1, 2, '2016-01-27 17:21:00'),
(3633, 'SOUMYA.SANKET-ASSOC@HCL.COM', 'SOUMYA100', 'SOUMYA.SANKET-ASSOC@HCL.COM', 2, 'firstName:Soumya;lastName:Sanket;location:BHUBANESHWAR;position:ASSOCIATE;department:DMS;reportingManager:RAKESH+PADHI;grade:P0;mobileNumber:9937142282;userType:General;', '2016-01-22 13:11:32', 1, 2, '2016-01-27 17:21:00'),
(3634, 'AMIT.JHA@HCL.COM', 'AMIT100', 'AMIT.JHA@HCL.COM', 2, 'firstName:AMIT;lastName:JHA;location:BHUBANESHWAR;position:AREA+SALES+MANAGER;department:DMS;reportingManager:MANAS+SAHU;grade:P3;mobileNumber:7077704455;userType:General;', '2016-01-22 13:19:40', 1, 2, '2016-01-27 17:21:00'),
(3635, 'gopal.kumar-assoc@hcl.com', 'gopal@30', 'gopal.kumar-assoc@hcl.com', 2, 'firstName:Gopal+;lastName:kumar;location:NAGPUR;position:AREA+SALES+EXECUTIVE;department:sales+nokia+device+;reportingManager:Sumit+Mishra+;grade:P0;mobileNumber:9975187173;userType:General;', '2016-01-22 13:22:44', 1, 2, '2016-01-27 17:21:00'),
(3636, 'rakesh.padhi@hcl.com', 'RAKESH100', 'rakesh.padhi@hcl.com', 2, 'firstName:RAKESH+KUMAR;lastName:PADHI;location:BHUBANESHWAR;position:AREA+SALES+MANAGER;department:DMS;reportingManager:MANAS+SAHU;grade:P3;mobileNumber:7873009990;userType:General;', '2016-01-22 13:26:21', 1, 2, '2016-01-27 17:21:00'),
(3637, 'sushma.lama@hcl.com', 'rishit15', 'sushma.lama@hcl.com', 2, 'firstName:Sushma;lastName:Lama;location:NEW+DELHI;position:SENIOR+EXECUTIVE+-+CREDIT+COLLECTION;department:DMS+Accounts;reportingManager:Rajiv+Manchanda;grade:P2;mobileNumber:08527455977;userType:General;', '2016-01-22 13:42:16', 1, 2, '2016-01-27 17:21:00'),
(3638, 'sabyasachi.deb@hcl.com', 'jan@2016', 'sabyasachi.deb@hcl.com', 2, 'firstName:Sabyasachi+;lastName:Deb;location:GUWAHATI;position:SALES+MANAGER;department:DMS;reportingManager:Swakshar+Chakravarty;grade:P4;mobileNumber:7086058699;userType:General;', '2016-01-22 13:42:22', 1, 2, '2016-01-27 17:21:00'),
(3639, 'dheeraj.joshi587@gmail.com', 'dheeraj@121', 'dheeraj.joshi587@gmail.com', 2, 'firstName:Dheeraj;lastName:Joshi;location:CHANDIGARH;position:BRANCH+MANAGER;department:DMS;reportingManager:Ajitabh+Mohan+Jerath;grade:P5;mobileNumber:9717299011;userType:General;', '2016-01-22 13:43:51', 1, 2, '2016-01-27 17:21:00'),
(3640, 'gibin.george@hcl.com', 'hcl@clt', 'gibin.george@hcl.com', 2, 'firstName:GIBIN;lastName:GEORGE;location:COCHIN;position:SALES+MANAGER;department:DMS;reportingManager:VARGHESE+JACOB;grade:P3;mobileNumber:9895542222;userType:General;', '2016-01-22 13:44:28', 1, 2, '2016-01-27 17:21:00'),
(3641, 'chenactoca@hcl.com', 'babu@123', 'chenactoca@hcl.com', 2, 'firstName:Babu;lastName:P+V;location:CHENNAI;position:ASSOCIATE;department:Accounts;reportingManager:J.Govindanaathan;grade:X0;mobileNumber:9791113682;userType:General;', '2016-01-22 13:53:12', 1, 2, '2016-01-27 17:21:00'),
(3642, 'skypatil01@gmail.com', '9657592414', 'skypatil01@gmail.com', 2, 'firstName:purushottam+;lastName:patil;location:PUNE;position:SALES+EXECUTIVE;department:sales+;reportingManager:Ritesh+ranjan;grade:P0;mobileNumber:9011141718;userType:General;', '2016-01-22 14:01:47', 1, 2, '2016-01-27 17:21:00'),
(3643, 'rupesh.kansara-assoc@hcl.com', 'D7551_@007RK', 'rupesh.kansara-assoc@hcl.com', 2, 'firstName:RUPESH;lastName:KANSARA;location:JAIPUR;position:AREA+SALES+EXECUTIVE;department:NOKIA+DMS;reportingManager:AKASH+SINGH;grade:P0;mobileNumber:9929111837;userType:General;', '2016-01-22 14:03:48', 1, 2, '2016-01-27 17:21:00'),
(3644, 'kamalakanna.nagarajan@hcl.com', 'Kamal@05', 'kamalakanna.nagarajan@hcl.com', 2, 'firstName:Kamalakannan;lastName:Nagarajan;location:CHENNAI;position:AREA+SALES+EXECUTIVE;department:DMS;reportingManager:Satheesh+Kumar+S;grade:P1;mobileNumber:9566066256;userType:General;', '2016-01-22 14:09:29', 1, 2, '2016-01-27 17:21:00'),
(3645, 'dhamole.nilesh-assoc@hcl.com', 'gajanan21', 'dhamole.nilesh-assoc@hcl.com', 2, 'firstName:Nilesh;lastName:Dhamole;location:NAGPUR;position:ASSOCIATE;department:DMS;reportingManager:Sumit+Mishra;grade:P0;mobileNumber:9922842230;userType:General;', '2016-01-22 14:49:58', 1, 2, '2016-01-27 17:21:00'),
(3646, 'bodiud.zaman@hcl.com', 'lutfar13@', 'bodiud.zaman@hcl.com', 2, 'firstName:Bodiud;lastName:Zaman;location:GUWAHATI;position:MANAGER+-+SALES;department:sales;reportingManager:Swakshar+Chakravarty;grade:P3;mobileNumber:8811027526;userType:General;', '2016-01-22 14:50:57', 1, 2, '2016-01-27 17:21:00'),
(3647, 'sambhaji65@gmail.com', 'HCLI@123', 'sambhaji65@gmail.com', 2, 'firstName:Sambhaji+;lastName:Kadam;location:MUMBAI;position:ASSOCIATE;department:DMS+SUPPLY+CHAIN+MANAGEMENT;reportingManager:Dilip+chellani;grade:P0;mobileNumber:9920793949;userType:General;', '2016-01-22 14:57:56', 1, 2, '2016-01-27 17:21:00'),
(3648, 'vikas.sachdeva@hcl.com', 'vikas@22', 'vikas.sachdeva@hcl.com', 2, 'firstName:VIKAS;lastName:SACHDEVA;location:MUMBAI;position:BRANCH+MANAGER;department:DMS;reportingManager:SAGNIK+SEN;grade:P4;mobileNumber:7387003954;userType:General;', '2016-01-22 15:01:04', 1, 2, '2016-01-27 17:21:00'),
(3649, 'gsmishra64@gmail.com', 'hcli@123', 'gsmishra64@gmail.com', 2, 'firstName:GHANSHYAM;lastName:MISHRA;location:MUMBAI;position:ASSOCIATE;department:DMS+SUPPLY+CHAIN+MANAGEMENT;reportingManager:DILIP+CHELLANI;grade:P0;mobileNumber:986756604;userType:General;', '2016-01-22 15:02:14', 1, 2, '2016-01-27 17:21:00'),
(3650, 'm.kumaran@hcl.com', '2tfrooty', 'm.kumaran@hcl.com', 2, 'firstName:Kumaran;lastName:M;location:BANGALORE;position:SENIOR+EXECUTIVE;department:Integrated+Supply+Chain+Management;reportingManager:A+Jayakumar;grade:P2;mobileNumber:9611115842;userType:General;', '2016-01-22 15:04:21', 1, 2, '2016-01-27 17:21:00'),
(3651, 'srinivas.pisipati@hcl.com', '10101991', 'srinivas.pisipati@hcl.com', 2, 'firstName:Srinivas;lastName:Pisipati;location:BANGALORE;position:BRANCH+MANAGER;department:DMS;reportingManager:Dean+Isaac+George;grade:P5;mobileNumber:9866438394;userType:General;', '2016-01-22 16:10:34', 1, 2, '2016-01-27 17:21:00'),
(3652, 'vikram.parashar@hcl.com', 'Nokia123', 'vikram.parashar@hcl.com', 2, 'firstName:Vikram;lastName:Parashar;location:JAIPUR;position:BRANCH+MANAGER;department:Nokia+DMS;reportingManager:Ajitabh+mohan;grade:P2;mobileNumber:9555702015;userType:General;', '2016-01-22 16:31:45', 1, 2, '2016-01-27 17:21:00'),
(3653, 'neeraj.c@hcl.com', 'mata@123', 'neeraj.c@hcl.com', 2, 'firstName:Neeraj;lastName:Chaturvedi;location:NOIDA+SECTOR-11;position:MANAGER+-+SALES;department:DMS;reportingManager:Hitender+Kumar+Yadav;grade:P3;mobileNumber:9779152241;userType:General;', '2016-01-22 16:55:24', 1, 2, '2016-01-27 17:21:00'),
(3654, 'rajat.mukherjee-assoc@hcl.com', 'abcd123', 'rajat.mukherjee-assoc@hcl.com', 2, 'firstName:Rajat;lastName:Mukherjee;location:GUWAHATI;position:SALES+CO-ORDINATOR;department:DMS;reportingManager:Swakshar+Chakravarty;grade:P0;mobileNumber:7896016413;userType:General;', '2016-01-22 17:00:24', 1, 2, '2016-01-27 17:21:00'),
(3655, 'mansris@hcl.com', 'jaya@pari16', 'mansris@hcl.com', 2, 'firstName:MANISH+;lastName:SRIVASTAVA;location:LUCKNOW;position:ASSISTANT+MANAGER;department:ACCOUNTS;reportingManager:MR.+VIRENDER+PASRICHA;grade:X3;mobileNumber:91-9956043434;userType:General;', '2016-01-22 18:01:58', 1, 2, '2016-01-27 17:21:00'),
(3656, 'rajat.bhardwaj@hcl.com', 'abcd@1234', 'rajat.bhardwaj@hcl.com', 2, 'firstName:rajat;lastName:bhardwaj;location:NOIDA;position:AREA+SALES+MANAGER;department:DDMS;reportingManager:Dheeraj+Joshi;grade:P3;mobileNumber:8130933533;userType:General;', '2016-01-22 18:03:38', 1, 2, '2016-01-27 17:21:00'),
(3657, 'sumit.mishra@hcl.com', 'sumit@123', 'sumit.mishra@hcl.com', 2, 'firstName:Sumit;lastName:Mishra;location:NAGPUR;position:MANAGER+-+SALES;department:NOKIA+-+DEVICE;reportingManager:Achal+Maloo;grade:P3;mobileNumber:7798850088;userType:General;', '2016-01-22 19:11:56', 1, 2, '2016-01-27 17:21:00'),
(3658, 'mahire.rakesh-assoc@hcl.com', 'Tanu@14321', 'mahire.rakesh-assoc@hcl.com', 2, 'firstName:Rakesh;lastName:mahire;location:PUNE;position:SALES+EXECUTIVE;department:DMS;reportingManager:Ritesh+Ranjan;grade:P0;mobileNumber:9011858283;userType:General;', '2016-01-22 19:16:55', 1, 2, '2016-01-27 17:21:00'),
(3659, 'patil.purushottam-assoc@hcl.com', 'Jitu@1234', 'patil.purushottam-assoc@hcl.com', 2, 'firstName:Purushottam+;lastName:Patil;location:PUNE;position:SALES+EXECUTIVE;department:DMS;reportingManager:Ritesh+Ranjan;grade:P0;mobileNumber:9011141718;userType:General;', '2016-01-22 19:26:18', 1, 2, '2016-01-27 17:21:00'),
(3660, 'pawar.yashwant@hcl.com', 'Rathod', 'pawar.yashwant@hcl.com', 2, 'firstName:Yashwant;lastName:Rathod;location:PUNE;position:SALES+EXECUTIVE;department:DMS;reportingManager:Parvej+Khan;grade:P0;mobileNumber:7720078999;userType:General;', '2016-01-22 19:28:23', 1, 2, '2016-01-27 17:21:00'),
(3661, 'r.ramakanth@hcl.com', 'ramu*8252', 'r.ramakanth@hcl.com', 2, 'firstName:Ramakanth;lastName:Rangari;location:HYDERABAD;position:AREA+SALES+EXECUTIVE;department:DMS-Nokia;reportingManager:Sureshbabu+Gunti;grade:P1;mobileNumber:900014420;userType:General;', '2016-01-22 20:20:29', 1, 2, '2016-01-27 17:21:00'),
(3662, 'kumar.hitesh-assoc@hcl.com', 'Admin123', 'kumar.hitesh-assoc@hcl.com', 2, 'firstName:Hitesh;lastName:Kumar;location:CHANDIGARH;position:ASSOCIATE;department:DDMS;reportingManager:Dheeraj+Joshi;grade:P0;mobileNumber:9812103882;userType:General;', '2016-01-22 20:52:31', 1, 2, '2016-01-27 17:21:00'),
(3663, 'nilesh.nagar@hcl.com', 'Nnn@@9876', 'nilesh.nagar@hcl.com', 2, 'firstName:NILESH;lastName:NAGAR;location:AHEMDABAD;position:SALES+MANAGER;department:Devices;reportingManager:Vidhu+Shekhar+Trivedi;grade:P4;mobileNumber:9904158778;userType:General;', '2016-01-22 21:54:06', 1, 2, '2016-01-27 17:21:00'),
(3664, 'bishwa.deepak-accoc@hcl.com', 'Deepak@1986', 'bishwa.deepak-accoc@hcl.com', 2, 'firstName:BISHWA;lastName:RAVI;location:RANCHI;position:AREA+SALES+EXECUTIVE;department:DMS;reportingManager:SUDEEP+GHOSH;grade:P0;mobileNumber:8252554989;userType:General;', '2016-01-23 10:53:27', 1, 2, '2016-01-27 17:21:00'),
(3665, 'ritas@hcl.com', 'rita@1234', 'ritas@hcl.com', 2, 'firstName:RITA;lastName:SHARMA;location:NOIDA+SECTOR-11;position:DEPUTY+MANAGER;department:ACCOUNTS;reportingManager:Virender+Kumar+Pasricha;grade:X5;mobileNumber:9911649222;userType:General;', '2016-01-23 11:44:01', 1, 2, '2016-01-27 17:21:00'),
(3666, 'jayanta.h-assoc@hcl.com', 'hcl@123', 'jayanta.h-assoc@hcl.com', 2, 'firstName:JAYANTA+;lastName:HAZARIKA;location:GUWAHATI;position:AREA+SALES+EXECUTIVE;department:SALES+DEVICE;reportingManager:SWAKSHAR+CHAKRWARTY;grade:P0;mobileNumber:9854086875;userType:General;', '2016-01-23 12:32:22', 1, 2, '2016-01-27 17:21:00'),
(3667, 'sanjeev.verma-assoc@hcl.com', 'sanj2485', 'sanjeev.verma-assoc@hcl.com', 2, 'firstName:sanjeev;lastName:verma;location:AHEMDABAD;position:AREA+SALES+EXECUTIVE;department:sales;reportingManager:arshid+ahmed+qureshi;grade:P1;mobileNumber:9797677333;userType:General;', '2016-01-23 21:06:38', 1, 2, '2016-01-27 17:21:00'),
(3668, 'parag.bora@hcl.com', 'parag@15', 'parag.bora@hcl.com', 2, 'firstName:PARAG+;lastName:Bora;location:GUWAHATI;position:AREA+SALES+MANAGER;department:SALES;reportingManager:SWAKSHAR+CHAKRAVARTY;grade:P3;mobileNumber:8811078174;userType:General;', '2016-01-23 23:53:23', 1, 2, '2016-01-27 17:21:00'),
(3669, 'jha.vikas@hcl.com', 'Vikas@1983', 'jha.vikas@hcl.com', 2, 'firstName:Vikas+Kumar;lastName:Jha;location:CHANDIGARH;position:REGIONAL+SALES+MANAGER;department:Nokia+DMS;reportingManager:Sagnik+Sen;grade:P4;mobileNumber:8527425557;userType:General;', '2016-01-24 10:45:59', 1, 2, '2016-01-27 17:21:00'),
(3670, 'suresh.kmr-assoc@hcl.com', 'sur@2121', 'suresh.kmr-assoc@hcl.com', 2, 'firstName:Suresh+;lastName:Kumar;location:CHANDIGARH;position:SALES+EXECUTIVE;department:sales;reportingManager:Sanjeev+Sharma;grade:P1;mobileNumber:9816060201;userType:General;', '2016-01-24 11:29:46', 1, 2, '2016-01-27 17:21:00'),
(3671, 'sharma.sanjeev@hcl.com', 'Shakti@123', 'sharma.sanjeev@hcl.com', 2, 'firstName:sanjeev;lastName:sharma;location:CHANDIGARH;position:BRANCH+MANAGER;department:sales;reportingManager:Ajitabh+Mohan;grade:P5;mobileNumber:8968706665;userType:General;', '2016-01-24 11:54:56', 1, 2, '2016-01-27 17:21:00'),
(3672, 'ashish.shukla@hcl.com', 'sheryll@21', 'ashish.shukla@hcl.com', 2, 'firstName:ASHISH;lastName:SHUKLA;location:JAIPUR;position:AREA+SALES+MANAGER;department:SALES;reportingManager:VIKRAM+PARASHAR;grade:P4;mobileNumber:7727881010;userType:General;', '2016-01-24 13:47:38', 1, 2, '2016-01-27 17:21:00'),
(3673, 'gurpreet.singh-assoc@hcl.com', 'gurpreet@509', 'gurpreet.singh-assoc@hcl.com', 2, 'firstName:Gurpreet;lastName:Gujral;location:JAIPUR;position:AREA+SALES+EXECUTIVE;department:SALES;reportingManager:Vikram+parashar+;grade:P0;mobileNumber:9983320111;userType:General;', '2016-01-24 14:03:35', 1, 2, '2016-01-27 17:21:00'),
(3674, 'singh.akash@hcl.com', 'carbine', 'singh.akash@hcl.com', 2, 'firstName:Akash;lastName:Singh;location:JAIPUR;position:SALES+MANAGER;department:Nokia+Device;reportingManager:Vikram+Parashar;grade:P3;mobileNumber:9680061182;userType:General;', '2016-01-24 14:43:36', 1, 2, '2016-01-27 17:21:00'),
(3675, 'jabir.husan-assoc@hcl.com', 'jabir@321', 'jabir.husan-assoc@hcl.com', 2, 'firstName:Jabir;lastName:Hushan;location:PATNA;position:AREA+SALES+EXECUTIVE;department:DMS;reportingManager:sanjai+jha;grade:P0;mobileNumber:9122686707;userType:General;', '2016-01-24 16:59:34', 1, 2, '2016-01-27 17:21:00'),
(3676, 'avinash.kumar-assoc@hcl.com', 'rocky@999', 'avinash.kumar-assoc@hcl.com', 2, 'firstName:avinash;lastName:singh;location:PATNA;position:ASSOCIATE;department:dms;reportingManager:Inderjeet+singh;grade:P1;mobileNumber:8877700064;userType:General;', '2016-01-24 17:51:34', 1, 2, '2016-01-27 17:21:00'),
(3677, 'ridhi.vaid@hcl.com', 'vaid_2887', 'ridhi.vaid@hcl.com', 2, 'firstName:Ridhi;lastName:Vaid;location:MUMBAI;position:EXECUTIVE+-+HR;department:DMS;reportingManager:Priyanka+Priyadarshini;grade:P1;mobileNumber:9920760521;userType:General;', '2016-01-24 20:10:10', 1, 2, '2016-01-27 17:21:00'),
(3678, 'debjyoti.paul-assoc@hcl.com', 'agt@123', 'debjyoti.paul-assoc@hcl.com', 2, 'firstName:DEBJYOTI;lastName:PAUL;location:GUWAHATI;position:AREA+SALES+EXECUTIVE;department:DMS;reportingManager:SABHYASACHI+DEB;grade:P1;mobileNumber:9774213794;userType:General;', '2016-01-24 20:58:45', 1, 2, '2016-01-27 17:21:00'),
(3679, 'ritesh.ranjan@hcl.com', 'Jan@2015', 'ritesh.ranjan@hcl.com', 2, 'firstName:Ritesh;lastName:Ranjan;location:PUNE;position:SALES+MANAGER;department:Sales;reportingManager:Muralidhar+Kongari;grade:P3;mobileNumber:9028199222;userType:General;', '2016-01-24 21:27:25', 1, 2, '2016-01-27 17:21:00'),
(3680, 'Muralidhar.Kongovi@hcl.com', 'hotspice', 'Muralidhar.Kongovi@hcl.com', 2, 'firstName:Muralidhar;lastName:Kongovi;location:PUNE;position:BRANCH+MANAGER;department:DMS+Sales;reportingManager:Himanshu+Shekar+Niraj;grade:P4;mobileNumber:9945358006;userType:General;', '2016-01-24 21:32:28', 1, 2, '2016-01-27 17:21:00'),
(3681, 'satish-assoc@hcl.com', 'satish', 'satish-assoc@hcl.com', 2, 'firstName:satish;lastName:kumar;location:CHANDIGARH;position:ASSOCIATE;department:nokia+device;reportingManager:dheerajb+joshi;grade:P0;mobileNumber:9671123450;userType:General;', '2016-01-24 22:53:36', 1, 2, '2016-01-27 17:21:00'),
(3682, 'sourab@hcl.com', 'sale', 'sourab@hcl.com', 2, 'firstName:SOURAB;lastName:ABROL;location:JAIPUR;position:SALES+MANAGER;department:DMS;reportingManager:VIKRAM+PRASHAR;grade:P4;mobileNumber:9001991966;userType:General;', '2016-01-24 23:22:07', 1, 2, '2016-01-27 17:21:00'),
(3683, 'susheel.kumar@hcl.com', 'exch@1300', 'susheel.kumar@hcl.com', 2, 'firstName:SUSHEEL;lastName:KADSHOLI;location:CHANDIGARH;position:SALES+MANAGER;department:SALES;reportingManager:SANJEEV+SHARMA;grade:P3;mobileNumber:09857109990;userType:General;', '2016-01-25 00:08:33', 1, 2, '2016-01-27 17:21:00'),
(3684, 'rohitashwa.prasad-assoc@hcl.com', 'Rohitga@2010', 'rohitashwa.prasad-assoc@hcl.com', 2, 'firstName:Rohitashwa;lastName:Prasad;location:NOIDA+X1;position:ASSOCIATE;department:Finance+%26+Accounts;reportingManager:P+T+Jegannathan;grade:P0;mobileNumber:9810646336;userType:General;', '2016-01-25 09:38:20', 1, 2, '2016-01-27 17:21:00'),
(3685, 'chaturvedi.amit@hcl.com', 'hcli@12345', 'chaturvedi.amit@hcl.com', 2, 'firstName:amit;lastName:chaturvedi;location:NOIDA;position:KEY+ACCOUNT+MANAGER;department:dms;reportingManager:sutikshan+naithani;grade:P6;mobileNumber:9811801776;userType:General;', '2016-01-25 11:01:01', 1, 2, '2016-01-27 17:21:00'),
(3686, 'saipratik.jaywant@hcl.com', 'saipratik@17', 'saipratik.jaywant@hcl.com', 2, 'firstName:saipratik;lastName:sawant;location:MUMBAI;position:EXECUTIVE;department:Nokia-DMS;reportingManager:Himanhsu+Singh;grade:P2;mobileNumber:7738386801;userType:General;', '2016-01-25 11:35:28', 1, 2, '2016-01-27 17:21:00'),
(3687, 'nishant.shekhar-assoc@hcl.com', 'nish@123', 'nishant.shekhar-assoc@hcl.com', 2, 'firstName:Nishant;lastName:Shekhar;location:WARANGAL;position:BRANCH+SALES+OPERATIONS+MANAGER;department:sales;reportingManager:sanjai+jha;grade:P0;mobileNumber:9570595340;userType:General;', '2016-01-25 11:38:32', 1, 2, '2016-01-27 17:21:00'),
(3688, 'anil.pillai@hcl.com', 'anil@35007', 'anil.pillai@hcl.com', 2, 'firstName:anil;lastName:pillai;location:NOIDA+SECTOR-11;position:SENIOR+EXECUTIVE;department:finance;reportingManager:Sanjeev+Saraf;grade:X1;mobileNumber:9971769205;userType:General;', '2016-01-25 12:03:55', 1, 2, '2016-01-27 17:21:00'),
(3689, 'pawar.shailesh-assoc@hcl.com', 'pawar', 'pawar.shailesh-assoc@hcl.com', 2, 'firstName:Shailesh;lastName:Pawar;location:PUNE;position:SALES+EXECUTIVE;department:DMS;reportingManager:Nagesh;grade:P0;mobileNumber:9673220444;userType:General;', '2016-01-25 14:08:17', 1, 2, '2016-01-27 17:21:00'),
(3690, 'kumar.hitender@hcl.com', 'ranbir@123', 'kumar.hitender@hcl.com', 2, 'firstName:Hitender;lastName:Yadav;location:CHANDIGARH;position:BRANCH+MANAGER;department:DMS;reportingManager:Ajitabh+Mohan+jerath;grade:P5;mobileNumber:9888556555;userType:General;', '2016-01-25 14:49:34', 1, 2, '2016-01-27 17:21:00'),
(3691, 'gaurav.marwaha@hcl.com', 'msdec@2015', 'gaurav.marwaha@hcl.com', 2, 'firstName:Gaurav;lastName:Marwaha;location:SEC11-NOIDA;position:REGIONAL+MANAGER;department:DMS;reportingManager:Ajitabh+Jerath;grade:P4;mobileNumber:9810071962;userType:General;', '2016-01-26 17:00:47', 1, 2, '2016-01-27 17:21:00'),
(3692, 'baljeet', 'bb', 'baljeetgaheer@gmail.com', 2, 'firstName:Suresh+;lastName:Kumar;location:CHANDIGARH;position:SALES+EXECUTIVE;department:sales;reportingManager:Sanjeev+Sharma;grade:P1;mobileNumber:9816060201;userType:General;', '2016-01-27 00:00:00', 1, 2, '2016-01-27 17:21:00'),
(3693, 'kripa241288@gmail.com', 'kmal@3657', 'kripa241288@gmail.com', 2, 'firstName:Kripa;lastName:Malhotra;location:CHENNAI;position:AREA+SALES+EXECUTIVE;department:content+development;reportingManager:Priya+Venkat;grade:P2;mobileNumber:09840364170;userType:General;', '2016-01-27 13:50:52', 1, 2, '2016-01-27 17:21:00'),
(3694, 'ikramul.hussain@hcl.com', 'hclinfo', 'ikramul.hussain@hcl.com', 2, 'firstName:ikramul;lastName:hussain;location:GUWAHATI;position:AREA+SALES+EXECUTIVE;department:sales;reportingManager:swakshar+chakravarty;grade:P1;mobileNumber:7086044932;userType:General;', '2016-01-27 17:16:04', 1, 2, '2016-01-27 17:21:00'),
(3716, 'baljeetgaheer@gmail.com', 'pp', 'baljeetgaheer@gmail.com', 2, 'firstName:bb;lastName:bb;location:Ahmedabad\n;position:AREA SALES EXECUTIVE\n;department:DISTRIBUTION-DE & COMPUTING       \n;reportingManager:mm;grade:E4\n;mobileNumber:2321423424;Email:baljeetgaheer@gmail.com;default_password:pp;', '2016-01-27 13:03:45', 1, 2, '2016-01-27 13:03:45'),
(3717, 'munishsethi@gmail.com', 'pp', 'munishsethi@gmail.com', 2, 'firstName:gg;lastName:gg;location:Ahmedabad\n;position:AREA SALES EXECUTIVE\n;department:DISTRIBUTION-DE & COMPUTING       \n;reportingManager:mm;grade:E4\n;mobileNumber:456789;Email:munishsethi@gmail.com;default_password:pp;', '2016-01-27 13:05:34', 1, 2, '2016-01-27 13:05:34'),
(3718, 'dewanpowerpress@gmail.com', 'pp', 'dewanpowerpress@gmail.com', 2, 'firstName:bn;lastName:bn;location:Ahmedabad\n;position:AREA SALES EXECUTIVE\n;department:DISTRIBUTION-DE & COMPUTING       \n;reportingManager:mm;grade:E4\n;mobileNumber:987456321;Email:dewanpowerpress@gmail.com;default_password:pp;', '2016-01-27 13:09:49', 1, 2, '2016-01-27 13:09:49'),
(3719, 'dn@gmail.com', 'pp', 'dn@gmail.com', 2, 'firstName:bn;lastName:bb;location:Ahmedabad\n;position:AREA SALES EXECUTIVE\n;department:DISTRIBUTION-DE & COMPUTING       \n;reportingManager:mu;grade:E4\n;mobileNumber:987456311;Email:dn@gmail.com;default_password:pp;', '2016-01-27 13:11:18', 1, 2, '2016-01-27 13:11:18');
INSERT INTO `users` (`seq`, `username`, `password`, `emailid`, `companyseq`, `customfieldvalues`, `createdon`, `isenabled`, `adminseq`, `lastmodifiedon`) VALUES
(3721, 'baljeetgaheer1@gmail.com', 'pp', 'baljeetgaheer1@gmail.com', 2, 'firstName:pride;lastName:pride;location:Ahmedabad\n;position:AREA SALES EXECUTIVE\n;department:DISTRIBUTION-DE & COMPUTING       \n;reportingManager:mm;grade:E4\n;mobileNumber:89541212;Email:baljeetgaheer1@gmail.com;default_password:pp;', '2016-01-27 13:15:11', 1, 2, '2016-01-27 13:15:11');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `foreign_activities_learningplan` FOREIGN KEY (`learningplanseq`) REFERENCES `learningplans` (`seq`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `foreign_activities_user` FOREIGN KEY (`userseq`) REFERENCES `users` (`seq`) ON UPDATE NO ACTION;

--
-- Constraints for table `adminmodules`
--
ALTER TABLE `adminmodules`
  ADD CONSTRAINT `foreign_adminmodule_admin` FOREIGN KEY (`adminseq`) REFERENCES `admins` (`seq`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `foreign_adminmodule_company` FOREIGN KEY (`companyseq`) REFERENCES `companies` (`seq`) ON UPDATE NO ACTION;

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `foreign_admin_company` FOREIGN KEY (`companyseq`) REFERENCES `companies` (`seq`) ON UPDATE NO ACTION;

--
-- Constraints for table `learningplans`
--
ALTER TABLE `learningplans`
  ADD CONSTRAINT `foreign_lp_admin` FOREIGN KEY (`adminseq`) REFERENCES `admins` (`seq`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `foreign_lp_company` FOREIGN KEY (`companyseq`) REFERENCES `companies` (`seq`) ON UPDATE NO ACTION;

--
-- Constraints for table `learningprofiles`
--
ALTER TABLE `learningprofiles`
  ADD CONSTRAINT `foreign_tag_admin` FOREIGN KEY (`adminseq`) REFERENCES `admins` (`seq`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `foreign_tag_company` FOREIGN KEY (`companyseq`) REFERENCES `companies` (`seq`) ON UPDATE NO ACTION;

--
-- Constraints for table `managers`
--
ALTER TABLE `managers`
  ADD CONSTRAINT `foreign_managers_admin` FOREIGN KEY (`adminseq`) REFERENCES `admins` (`seq`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `foreign_managers_company` FOREIGN KEY (`companyseq`) REFERENCES `companies` (`seq`) ON UPDATE NO ACTION;

--
-- Constraints for table `signupformfields`
--
ALTER TABLE `signupformfields`
  ADD CONSTRAINT `foreign_key01` FOREIGN KEY (`adminseq`) REFERENCES `admins` (`seq`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `foreign_key02` FOREIGN KEY (`companyseq`) REFERENCES `companies` (`seq`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `foreign_key03` FOREIGN KEY (`customfieldseq`) REFERENCES `usercustomfields` (`seq`) ON UPDATE NO ACTION;

--
-- Constraints for table `usercustomfields`
--
ALTER TABLE `usercustomfields`
  ADD CONSTRAINT `foreign_uc_admin` FOREIGN KEY (`adminseq`) REFERENCES `admins` (`seq`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `foreign_uc_company` FOREIGN KEY (`companyseq`) REFERENCES `companies` (`seq`) ON UPDATE NO ACTION;

--
-- Constraints for table `userlearningprofiles`
--
ALTER TABLE `userlearningprofiles`
  ADD CONSTRAINT `foreign_ut_admin` FOREIGN KEY (`adminseq`) REFERENCES `admins` (`seq`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `foreign_ut_tag` FOREIGN KEY (`tagseq`) REFERENCES `learningprofiles` (`seq`) ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `foreign_user_admin` FOREIGN KEY (`adminseq`) REFERENCES `admins` (`seq`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `foreign_user_company` FOREIGN KEY (`companyseq`) REFERENCES `companies` (`seq`) ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
