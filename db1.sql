-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2021 at 01:57 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db1`
--

-- --------------------------------------------------------

--
-- Table structure for table `activated`
--

CREATE TABLE `activated` (
  `quizname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activated`
--

INSERT INTO `activated` (`quizname`) VALUES
('Demo');

-- --------------------------------------------------------

--
-- Table structure for table `activequiznames`
--

CREATE TABLE `activequiznames` (
  `quizname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activequiznames`
--

INSERT INTO `activequiznames` (`quizname`) VALUES
('Demo');

-- --------------------------------------------------------

--
-- Table structure for table `demoshow`
--

CREATE TABLE `demoshow` (
  `quizname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `demoshow`
--

INSERT INTO `demoshow` (`quizname`) VALUES
('Demo');

-- --------------------------------------------------------

--
-- Table structure for table `malicious`
--

CREATE TABLE `malicious` (
  `Id` int(7) NOT NULL,
  `ename` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `roll` varchar(20) NOT NULL,
  `quizname` varchar(255) NOT NULL,
  `emessage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `malicious`
--

INSERT INTO `malicious` (`Id`, `ename`, `email`, `roll`, `quizname`, `emessage`) VALUES
(1, 'Sarvesh Anand Mankar', 'mankarsarvesh2543@gmail.com', '194009', 'Demo', 'Changed Tab 3 times!');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `Id` int(7) NOT NULL,
  `quizname` varchar(255) NOT NULL,
  `question` varchar(500) NOT NULL,
  `opt1` varchar(255) NOT NULL,
  `opt2` varchar(255) NOT NULL,
  `opt3` varchar(255) NOT NULL,
  `opt4` varchar(255) NOT NULL,
  `ans` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`Id`, `quizname`, `question`, `opt1`, `opt2`, `opt3`, `opt4`, `ans`) VALUES
(1, 'Unit-3', 'What will be output of following code if today’s Date is 18/12/2021?\r\n<?php\r\n$txt = \"PHP\";\r\necho date(\"dS F, Y\");\r\n?>', '18 Dec, 2021', '18th Dec, 2021', '18th December 2021', 'December 18, 2021', '18th December 2021'),
(2, 'Unit-3', 'Which function is used to set a particular time zone?', 'time()', 'date_default_timezone_set()', 'timezone_set()', 'time_zone()', 'date_default_timezone_set()'),
(3, 'Unit-3', 'Which function is used to producing a timestamp based on a given date and time?', 'time()', 'mrtime()', 'mtime()', 'mktime()', 'mktime()'),
(4, 'Unit-3', 'What are advantages of Functions?', 'Makes code less Complex', 'Enhances Readability', 'Saves coding time', 'All of Above', 'All of Above'),
(5, 'Unit-3', 'To create an object and set the date to December 18, 2022, which one of the following statement should be executed?', '$date = Date(“18 December 2022“)', '$date = new Date(“December 18 2022“)', '$date = new DateTime(“18 December 2022“)', '$date = ToDate (“18 December 2022“)', '$date = new DateTime(“18 December 2022“)'),
(6, 'Unit-3', 'What will be output of following code?\r\n<?php\r\n$txt = \"I am cwitain!\";\r\necho ucword($txt);\r\n?>\r\n', 'I Am Cwitain!', 'I am cwitain!', 'i am cwitain!', 'None of above', 'None of above'),
(7, 'Unit-3', 'Which functions is used to find position of first occurrence of a particular character in a string?', 'strpostion()', 'pos()', 'strpos()', 'None of the above', 'strpos()'),
(8, 'Unit-3', 'Which function is used to count number of words in a string?', 'str_count()', 'str_word_count()', 'word_count()', 'count()', 'str_word_count()'),
(9, 'Unit-3', 'How to define a function in PHP?', 'function {function body}', 'data type functionName(parameters) {function body}', 'function functionName(parameters) {function body}', 'functionName(parameters) {function body}', 'function functionName(parameters) {function body}'),
(10, 'Unit-3', 'What will be output of following code?\r\n<?php\r\n    function First()  \r\n    {\r\n        function Second()\r\n        {\r\n            echo \'I am Second\';\r\n 	}\r\n        echo \'I am First\';\r\n    }\r\n    Second();\r\n    First();\r\n?>', 'I am SecondI am First', 'I am Second', 'I am FirstI am SecondI am First', 'Error', 'Error'),
(11, 'Unit-3', 'What is output of following code?\r\n<?php  \r\n$a = 15;  \r\nfunction show(){  \r\n$a = 20;  \r\necho \"$a\";  \r\n}  \r\nshow();  \r\necho \"$a\";  \r\n?>  ', '1520', '2020', '2015', '1515', '2015'),
(12, 'Unit-3', 'Which method is usually used when we have to save a website as a Bookmark?', 'GET Method', 'POST Method', 'PUT Method', 'None of Above', 'GET Method'),
(13, 'Unit-3', 'Which method is for user authentication?', 'GET Method', 'POST Method', 'PUT Method', 'None of Above', 'POST Method'),
(14, 'Unit-3', 'What will be the output of given code?\r\n<?php\r\nfunction hello($name){\r\n	return \"Hello $name\";\r\n}\r\n\r\nhello(\"Suresh\");\r\n?>\r\n', 'Hello Suresh!', 'Hello $name!', 'No Output', 'Error', 'No Output'),
(15, 'Unit-3', 'What will be the output of given code?\r\n<?php\r\nfunction sub($n1,$n2=10){\r\n	echo $n1-$n2;\r\n}\r\n\r\nsub (30);\r\nsub (10,20);\r\n?> \r\n', '2030', '3010', '20-10', 'Error', '20-10'),
(16, 'Unit-3', 'Which type of Function calling is used in given code?\r\n<?php\r\n function calc($price, $tax){ \r\n$total = $price + $tax; \r\n} \r\n$pricetag = 15; \r\n$taxtag = 3; \r\ncalc($pricetag, $taxtag);\r\n?>', 'Call By Value', 'Call By Reference', 'Default Argument Value', 'Type Hinting', 'Call By Value'),
(17, 'Unit-3', 'Which of the following are valid function names?\r\n\r\ni) function() \r\nii) .function() \r\niii) €() \r\niv) $function()', 'Only iv)', 'Only ii) and i)', 'Only iii)', 'None of Above', 'Only iii)'),
(18, 'Unit-3', 'What will be the output of the code?\r\n\r\n<?php \r\nfunction sub(...$numbers) {\r\n$sub = 0; \r\nforeach ($numbers as $n) { \r\n$sub -= $n; \r\n} return $sub; \r\n} \r\necho sub(1, 2, 3, 4);\r\necho sub(1,10);  \r\n?>', '1011', '10 Error', '-10-11', 'Error', '-10-11'),
(19, 'Unit-3', 'PHP supports variable length argument function with the help of which operator?', 'Tilde Operator', 'Ellipses Operator', 'Bacticks Operator', 'PHP Supports no such Feature', 'Ellipses Operator'),
(20, 'Unit-3', 'Which predefined variable is used to get data from a POST method?', '$POST', '$_POST', '$_POST_METHOD', 'None of Above', '$_POST'),
(21, 'Demo', 'Hello', '1', '2', '3', '4', '1'),
(22, 'Demo', 'Hello\r\nHello\r\n', '1', '2', '3', '4', '2'),
(23, 'Demo', 'Hello\r\nHello\r\nHello', '1', '2', '3', '4', '3');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Id` int(7) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ename` varchar(255) NOT NULL,
  `roll` varchar(20) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `done` varchar(10) NOT NULL,
  `marks` int(7) NOT NULL,
  `per` double NOT NULL,
  `ttime` varchar(255) NOT NULL,
  `quizname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Id`, `email`, `ename`, `roll`, `mobile`, `done`, `marks`, `per`, `ttime`, `quizname`) VALUES
(1, 'mankarsarvesh2543@gmail.com', 'Sarvesh Anand Mankar', '194009', '+918208419540', 'yes', 3, 100, '23/12/21 01:52:13pm', 'Demo');

-- --------------------------------------------------------

--
-- Table structure for table `studentresult`
--

CREATE TABLE `studentresult` (
  `Id` int(7) NOT NULL,
  `quizname` varchar(255) NOT NULL,
  `setting` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `Id` int(7) NOT NULL,
  `rollno` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `quizname` varchar(50) NOT NULL,
  `ques` varchar(500) NOT NULL,
  `opt1` varchar(500) NOT NULL,
  `opt2` varchar(500) NOT NULL,
  `opt3` varchar(500) NOT NULL,
  `opt4` varchar(500) NOT NULL,
  `cans` varchar(500) NOT NULL,
  `gans` varchar(500) NOT NULL,
  `cw` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submission`
--

INSERT INTO `submission` (`Id`, `rollno`, `email`, `quizname`, `ques`, `opt1`, `opt2`, `opt3`, `opt4`, `cans`, `gans`, `cw`) VALUES
(1, '194009', 'mankarsarvesh2543@gmail.com', 'Demo', 'Hello\r\nHello\r\nHello', '1', '2', '3', '4', '3', '3', 'correct'),
(2, '194009', 'mankarsarvesh2543@gmail.com', 'Demo', 'Hello\r\nHello\r\n', '1', '2', '3', '4', '2', '2', 'correct'),
(3, '194009', 'mankarsarvesh2543@gmail.com', 'Demo', 'Hello', '1', '2', '3', '4', '1', '1', 'correct');

-- --------------------------------------------------------

--
-- Table structure for table `tempresult`
--

CREATE TABLE `tempresult` (
  `quizname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tempresult`
--

INSERT INTO `tempresult` (`quizname`) VALUES
('Demo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `malicious`
--
ALTER TABLE `malicious`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `studentresult`
--
ALTER TABLE `studentresult`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `malicious`
--
ALTER TABLE `malicious`
  MODIFY `Id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `Id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `Id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `studentresult`
--
ALTER TABLE `studentresult`
  MODIFY `Id` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `Id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
