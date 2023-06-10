-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2023 at 05:00 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `whosoff`
--

-- --------------------------------------------------------

--
-- Table structure for table `academicyear`
--

CREATE TABLE `academicyear` (
  `Ayid` int(7) NOT NULL,
  `AcademicYear` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academicyear`
--

INSERT INTO `academicyear` (`Ayid`, `AcademicYear`) VALUES
(1, '2020-24'),
(2, '2021-25'),
(3, '2022-26');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `date` date NOT NULL,
  `ispresent` tinyint(4) NOT NULL,
  `Courseid` int(11) NOT NULL,
  `hour` time NOT NULL,
  `FacId` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `Branchid` int(11) NOT NULL,
  `BranchNAme` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`Branchid`, `BranchNAme`) VALUES
(1, 'IT'),
(2, 'EEE'),
(3, 'EC');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `CourseId` int(11) NOT NULL,
  `CourseCode` varchar(20) NOT NULL,
  `CourseName` varchar(255) NOT NULL,
  `BranchId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`CourseId`, `CourseCode`, `CourseName`, `BranchId`) VALUES
(1, 'ITT302', 'INTERNETWORKING WITH TCP/IP', 1),
(2, 'ITT306', 'DATA SCIENCE', 1),
(3, 'ITT304', 'ALGORITHM ANALYSIS \r\nAND DESIGN', 1),
(4, 'EEE103', 'Power Electronics', 2),
(5, 'EEE304', 'Microprocessors', 2);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `FacId` int(11) NOT NULL,
  `FacultyName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`FacId`, `FacultyName`, `password`, `email`, `status`, `date`) VALUES
(1, 'Jassim Rafeek', 'AAD', 'jassim@gmail.com', 5, '2020-03-15'),
(2, 'Jayanti', 'Micro', 'jayanti@gmail.com', 5, '2022-05-03');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_status`
--

CREATE TABLE `faculty_status` (
  `status` tinyint(4) NOT NULL,
  `designation` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `faculty_status`
--

INSERT INTO `faculty_status` (`status`, `designation`) VALUES
(1, 'Principal'),
(2, 'Dean'),
(3, 'HOD'),
(4, 'Staff Advisors'),
(5, 'Teachers');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_subject`
--

CREATE TABLE `faculty_subject` (
  `FacId` int(11) NOT NULL,
  `CourseId` int(11) NOT NULL,
  `Ayid` int(7) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `faculty_subject`
--

INSERT INTO `faculty_subject` (`FacId`, `CourseId`, `Ayid`) VALUES
(1, 3, 2020),
(2, 4, 2020),
(1, 3, 1),
(2, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `SemId` int(11) NOT NULL,
  `Semester` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`SemId`, `Semester`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(6, '6');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `sid` int(11) NOT NULL,
  `FName` varchar(55) NOT NULL,
  `LName` varchar(55) DEFAULT NULL,
  `AdmnNo` int(6) NOT NULL,
  `Gender` varchar(5) NOT NULL,
  `DOB` date NOT NULL,
  `PhoneNo` int(100) NOT NULL,
  `ParentNo` int(100) NOT NULL,
  `EmailId` varchar(55) NOT NULL,
  `RegNo` varchar(255) NOT NULL,
  `AyId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`sid`, `FName`, `LName`, `AdmnNo`, `Gender`, `DOB`, `PhoneNo`, `ParentNo`, `EmailId`, `RegNo`, `AyId`) VALUES
(1, 'Akshaya', 'M S', 8246, 'F', '2000-09-14', 2147483647, 2147483647, 'akshayams@gmail.com', 'TRV20IT014', 1),
(2, 'Gouri', 'B S', 8248, 'F', '2002-06-12', 2147483647, 2147483647, 'gouribs@gmail.com', 'TRV20IT036', 1),
(3, 'Pavithra', 'T', 8228, 'F', '2002-10-23', 2147483647, 2147483647, 'pavi8hrat@gmail.com', 'TRV20IT049', 1),
(4, 'Prajitha', 'P J', 8226, 'F', '2002-03-19', 2147483647, 2147483647, 'prajithapj@gmail.com', 'TRV20IT050', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_relation`
--

CREATE TABLE `student_relation` (
  `sid` int(11) NOT NULL,
  `SemId` int(11) NOT NULL,
  `Branchid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student_relation`
--

INSERT INTO `student_relation` (`sid`, `SemId`, `Branchid`) VALUES
(1, 6, 2),
(2, 6, 2),
(3, 6, 1),
(4, 6, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academicyear`
--
ALTER TABLE `academicyear`
  ADD PRIMARY KEY (`Ayid`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attid`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`Branchid`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`CourseId`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`FacId`);

--
-- Indexes for table `faculty_status`
--
ALTER TABLE `faculty_status`
  ADD PRIMARY KEY (`status`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`SemId`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
