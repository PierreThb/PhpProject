-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 04, 2016 at 08:52 AM
-- Server version: 10.1.9-MariaDB-log
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teammanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `agenda_id` int(11) NOT NULL,
  `proposer_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `agenda_id`, `proposer_id`, `name`, `number`) VALUES
(1, 1, 15, 'apologies received', 1),
(2, 1, 15, 'agree agenda', 2),
(3, 1, 15, 'accept minutes of previous meeting', 3),
(4, 2, 15, 'apologies received', 1),
(5, 2, 15, 'agree agenda', 2),
(6, 2, 15, 'accept minutes of previous meeting', 3),
(7, 2, 15, 'A new item', 4),
(8, 2, 15, 'a second new item', 5),
(9, 2, 15, 'item item item', 6),
(10, 3, 15, 'apologies received', 1),
(11, 3, 15, 'agree agenda', 2),
(12, 3, 15, 'accept minutes of previous meeting', 3),
(13, 1, 15, 'A new item', 4),
(14, 4, 15, 'apologies received', 1),
(15, 4, 15, 'agree agenda', 2),
(16, 4, 15, 'accept minutes of previous meeting', 3);

-- --------------------------------------------------------

--
-- Table structure for table `item_action`
--

CREATE TABLE `item_action` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `implementer_id` int(11) DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deadline` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_action`
--

INSERT INTO `item_action` (`id`, `item_id`, `implementer_id`, `state`, `description`, `deadline`) VALUES
(1, NULL, 15, 'in_progress', 'a new action', '2016-05-04 04:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE `meeting` (
  `id` int(11) NOT NULL,
  `meeting_leader_id` int(11) DEFAULT NULL,
  `meeting_secretary_id` int(11) DEFAULT NULL,
  `duration` time NOT NULL,
  `date` datetime NOT NULL,
  `room` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ProjectMeetings` int(11) DEFAULT NULL,
  `deadline` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meeting`
--

INSERT INTO `meeting` (`id`, `meeting_leader_id`, `meeting_secretary_id`, `duration`, `date`, `room`, `ProjectMeetings`, `deadline`) VALUES
(1, 15, 13, '01:00:00', '2016-05-08 03:19:00', 'e202', 3, '2016-05-04 03:19:00'),
(2, 14, 15, '01:00:00', '2016-05-04 03:20:00', 'e202', 3, '2016-05-03 11:30:00'),
(3, 13, 15, '01:00:00', '2016-05-06 03:32:00', 'a312', 3, '2016-05-02 03:32:00'),
(4, 14, 16, '01:00:00', '2016-05-05 04:48:00', 'b102', 3, '2016-05-04 04:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `meetingagenda`
--

CREATE TABLE `meetingagenda` (
  `id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meetingagenda`
--

INSERT INTO `meetingagenda` (`id`, `meeting_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `meetingattendance`
--

CREATE TABLE `meetingattendance` (
  `id` int(11) NOT NULL,
  `userAnswer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meetingId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meetingattendance`
--

INSERT INTO `meetingattendance` (`id`, `userAnswer`, `meetingId`, `userId`) VALUES
(1, 'notanswer', 1, 12),
(2, 'notanswer', 1, 13),
(3, 'notanswer', 1, 14),
(4, 'yes', 1, 15),
(5, 'notanswer', 1, 16),
(6, 'notanswer', 1, 17),
(7, 'notanswer', 2, 12),
(8, 'notanswer', 2, 13),
(9, 'notanswer', 2, 14),
(10, 'yes', 2, 15),
(11, 'notanswer', 2, 16),
(12, 'notanswer', 2, 17),
(13, 'notanswer', 3, 12),
(14, 'notanswer', 3, 13),
(15, 'notanswer', 3, 14),
(16, 'yes', 3, 15),
(17, 'notanswer', 3, 16),
(18, 'notanswer', 3, 17),
(19, 'notanswer', 4, 12),
(20, 'notanswer', 4, 13),
(21, 'notanswer', 4, 14),
(22, 'notanswer', 4, 15),
(23, 'notanswer', 4, 16),
(24, 'notanswer', 4, 17);

-- --------------------------------------------------------

--
-- Table structure for table `meeting_minutes`
--

CREATE TABLE `meeting_minutes` (
  `id` int(11) NOT NULL,
  `meeting_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meeting_minutes`
--

INSERT INTO `meeting_minutes` (`id`, `meeting_id`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `minutes_comment`
--

CREATE TABLE `minutes_comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `meeting_minute_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `minutes_comment`
--

INSERT INTO `minutes_comment` (`id`, `user_id`, `meeting_minute_id`, `content`) VALUES
(1, 15, 1, 'a new comment'),
(2, 15, 1, 'a new commet 2');

-- --------------------------------------------------------

--
-- Table structure for table `minute_item`
--

CREATE TABLE `minute_item` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `postponed` tinyint(1) NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `presence`
--

CREATE TABLE `presence` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `meeting_id` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `presence`
--

INSERT INTO `presence` (`id`, `user_id`, `meeting_id`, `type`) VALUES
(1, 12, 1, 'absent_no_apologies'),
(2, 13, 1, 'absent_no_apologies'),
(3, 14, 1, 'absent_no_apologies'),
(4, 15, 1, 'absent_no_apologies'),
(5, 16, 1, 'absent_no_apologies'),
(6, 17, 1, 'absent_no_apologies');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `leader_id` int(11) DEFAULT NULL,
  `secretary_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `islocked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `leader_id`, `secretary_id`, `name`, `islocked`) VALUES
(1, 15, 13, 'Maths', 1),
(2, 15, 14, 'Pho', 1),
(3, 15, 16, 'Php', 0),
(4, 13, 15, 'C++', 0),
(5, 18, 15, 'Java', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_user`
--

CREATE TABLE `project_user` (
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_user`
--

INSERT INTO `project_user` (`project_id`, `user_id`) VALUES
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(3, 17),
(4, 12),
(4, 13),
(4, 14),
(4, 15),
(4, 16),
(4, 17),
(5, 12),
(5, 13),
(5, 15),
(5, 18);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `userName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `userName`, `password`, `isAdmin`) VALUES
(12, 'admin', '$2y$13$SzLf3eRRql4Uf6orBZwg2ukm5kphWa78QP0qmlddSH6HLHUfYpCJq', 1),
(13, 'Paul', '$2y$13$xGUiVilX/AycBnIVMkzt/.PMNO1dd0BfsYTAtrDmYuAarzgiRjaze', 0),
(14, 'Henry', '$2y$13$SwX06.LL0SHua2bGSCcWXeHcxDoAqsmK4MZxbY0v11/GU0yuQaZmO', 0),
(15, 'Pierre', '$2y$13$fGFLgmJic2A0BgVqVQJYPOeiuFn4wCjNMHHIwx3KkUXv0sLUb8c0y', 0),
(16, 'Mark', '$2y$13$Xhs9LzWDptS42cZ9aV/UkeZxnQrtUD7uISRIPn1a6MGBQZniez9EG', 0),
(17, 'Jean', '$2y$13$L6yu0rbp0cjxgVk91DexWOnc8G3nt.A8h1e65CG.JGXPdGXzlsM0y', 0),
(18, 'Matt', '$2y$13$kz7VmGeZteM5jZX9ZebjIeiBdRKYX7rdL4Aifjs2l9jpfHgmZcsbK', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userrequest`
--

CREATE TABLE `userrequest` (
  `id` int(11) NOT NULL,
  `agenda_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `userrequest`
--

INSERT INTO `userrequest` (`id`, `agenda_id`, `user_id`, `item_id`, `type`, `state`, `content`) VALUES
(1, 2, 15, NULL, 'additional', 'agreed', 'A new item'),
(2, 2, 15, NULL, 'additional', 'agreed', 'a second new item'),
(3, 2, 15, NULL, 'additional', 'agreed', 'item item item'),
(4, 1, 15, NULL, 'additional', 'agreed', 'A new item'),
(5, 1, 15, NULL, 'additional', 'pending', 'eezeze'),
(6, 1, 15, NULL, 'additional', 'pending', 'a item');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1F1B251EEA67784A` (`agenda_id`),
  ADD KEY `IDX_1F1B251EB13FA634` (`proposer_id`);

--
-- Indexes for table `item_action`
--
ALTER TABLE `item_action`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C135F95D126F525E` (`item_id`),
  ADD KEY `IDX_C135F95D845CC5FA` (`implementer_id`);

--
-- Indexes for table `meeting`
--
ALTER TABLE `meeting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F515E139853FF9A2` (`meeting_leader_id`),
  ADD KEY `IDX_F515E13982E5D80F` (`meeting_secretary_id`),
  ADD KEY `IDX_F515E139D71BE332` (`ProjectMeetings`);

--
-- Indexes for table `meetingagenda`
--
ALTER TABLE `meetingagenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CEE466EB67433D9C` (`meeting_id`);

--
-- Indexes for table `meetingattendance`
--
ALTER TABLE `meetingattendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9908182AF334E9B3` (`meetingId`),
  ADD KEY `IDX_9908182A64B64DCC` (`userId`);

--
-- Indexes for table `meeting_minutes`
--
ALTER TABLE `meeting_minutes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_38B9022E67433D9C` (`meeting_id`);

--
-- Indexes for table `minutes_comment`
--
ALTER TABLE `minutes_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_36911946A76ED395` (`user_id`),
  ADD KEY `IDX_369119466B67886D` (`meeting_minute_id`);

--
-- Indexes for table `minute_item`
--
ALTER TABLE `minute_item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_69264862126F525E` (`item_id`);

--
-- Indexes for table `presence`
--
ALTER TABLE `presence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6977C7A5A76ED395` (`user_id`),
  ADD KEY `IDX_6977C7A567433D9C` (`meeting_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2FB3D0EE73154ED4` (`leader_id`),
  ADD KEY `IDX_2FB3D0EEA2A63DB2` (`secretary_id`);

--
-- Indexes for table `project_user`
--
ALTER TABLE `project_user`
  ADD PRIMARY KEY (`project_id`,`user_id`),
  ADD KEY `IDX_B4021E51166D1F9C` (`project_id`),
  ADD KEY `IDX_B4021E51A76ED395` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userrequest`
--
ALTER TABLE `userrequest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_684B4ABDEA67784A` (`agenda_id`),
  ADD KEY `IDX_684B4ABDA76ED395` (`user_id`),
  ADD KEY `IDX_684B4ABD126F525E` (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `item_action`
--
ALTER TABLE `item_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `meeting`
--
ALTER TABLE `meeting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `meetingagenda`
--
ALTER TABLE `meetingagenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `meetingattendance`
--
ALTER TABLE `meetingattendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `meeting_minutes`
--
ALTER TABLE `meeting_minutes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `minutes_comment`
--
ALTER TABLE `minutes_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `minute_item`
--
ALTER TABLE `minute_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `presence`
--
ALTER TABLE `presence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `userrequest`
--
ALTER TABLE `userrequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `FK_1F1B251EB13FA634` FOREIGN KEY (`proposer_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_1F1B251EEA67784A` FOREIGN KEY (`agenda_id`) REFERENCES `meetingagenda` (`id`);

--
-- Constraints for table `item_action`
--
ALTER TABLE `item_action`
  ADD CONSTRAINT `FK_C135F95D126F525E` FOREIGN KEY (`item_id`) REFERENCES `minute_item` (`id`),
  ADD CONSTRAINT `FK_C135F95D845CC5FA` FOREIGN KEY (`implementer_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `meeting`
--
ALTER TABLE `meeting`
  ADD CONSTRAINT `FK_F515E13982E5D80F` FOREIGN KEY (`meeting_secretary_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_F515E139853FF9A2` FOREIGN KEY (`meeting_leader_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_F515E139D71BE332` FOREIGN KEY (`ProjectMeetings`) REFERENCES `project` (`id`);

--
-- Constraints for table `meetingagenda`
--
ALTER TABLE `meetingagenda`
  ADD CONSTRAINT `FK_CEE466EB67433D9C` FOREIGN KEY (`meeting_id`) REFERENCES `meeting` (`id`);

--
-- Constraints for table `meetingattendance`
--
ALTER TABLE `meetingattendance`
  ADD CONSTRAINT `FK_9908182A64B64DCC` FOREIGN KEY (`userId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_9908182AF334E9B3` FOREIGN KEY (`meetingId`) REFERENCES `meeting` (`id`);

--
-- Constraints for table `meeting_minutes`
--
ALTER TABLE `meeting_minutes`
  ADD CONSTRAINT `FK_38B9022E67433D9C` FOREIGN KEY (`meeting_id`) REFERENCES `meeting` (`id`);

--
-- Constraints for table `minutes_comment`
--
ALTER TABLE `minutes_comment`
  ADD CONSTRAINT `FK_369119466B67886D` FOREIGN KEY (`meeting_minute_id`) REFERENCES `meeting_minutes` (`id`),
  ADD CONSTRAINT `FK_36911946A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `minute_item`
--
ALTER TABLE `minute_item`
  ADD CONSTRAINT `FK_69264862126F525E` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`);

--
-- Constraints for table `presence`
--
ALTER TABLE `presence`
  ADD CONSTRAINT `FK_6977C7A567433D9C` FOREIGN KEY (`meeting_id`) REFERENCES `meeting_minutes` (`id`),
  ADD CONSTRAINT `FK_6977C7A5A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `FK_2FB3D0EE73154ED4` FOREIGN KEY (`leader_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_2FB3D0EEA2A63DB2` FOREIGN KEY (`secretary_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `project_user`
--
ALTER TABLE `project_user`
  ADD CONSTRAINT `FK_B4021E51166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B4021E51A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `userrequest`
--
ALTER TABLE `userrequest`
  ADD CONSTRAINT `FK_684B4ABD126F525E` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
  ADD CONSTRAINT `FK_684B4ABDA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_684B4ABDEA67784A` FOREIGN KEY (`agenda_id`) REFERENCES `meetingagenda` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
