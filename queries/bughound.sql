/* Database after Iteration 2*/

-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2020 at 05:18 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bughound`
-- 

-- --------------------------------------------------------
USE bughound;

INSERT INTO `employees` (`emp_id`, `name`, `username`, `password`, `userlevel`) VALUES
(1002, 'Bob', 'smithbob', '0c3e99453b4ae505617a3c9b6ce73fc3', 3),
(1003, 'Sue', 'jonessue', 'bd51bf09f884e61302ababa5afd015a6', 2),
(1004, 'Habib', 'smithhabib', '2d06fd7c4b398be6eca7da0d36f82dca', 2),
(1005, 'Yoshi', 'jonesyoshi', '325f0ef75aada50400f915311517b624', 3),
(1006, 'Francois', 'smithfrancois', '1c7fb0d741298a07bad588717c669bfd', 2),
(1007, 'Becky', 'jonesbecky', '27b2d3f8c329040739f3b94e1ae68df5', 1),
(1008, 'Felix', 'smithfelix', '7e174d670368c9fb2de183997d12bdd5', 2);

INSERT INTO `programs` (`prog_id`, `program`, `program_release`, `program_version`) VALUES
(1000, 'Ada95 Coder', '1', '1'),
(1001, 'Bughound', '1', '1'),
(1002, 'COBOL Coder', '1', '1'),
(1003, 'COBOL Coder', '2', '1'),
(1004, 'COBOL Coder', '1', '2'),
(1005, 'Pascal Coder', '1', '1'),
(1006, 'Word Writer 2019', '1', '1');

INSERT INTO `areas` (`area_id`, `prog_id`, `area`) VALUES
(1000, 1000, 'Ada95 Parser'),
(1001, 1000, 'Ada95 Lexer'),
(1002, 1000, 'Ada95 IDE'),
(1003, 1001, 'Logon'),
(1004, 1001, 'Start'),
(1005, 1001, 'DB Maintenance'),
(1006, 1001, 'Search'),
(1007, 1001, 'Insert New'),
(1008, 1001, 'Search Results'),
(1009, 1001, 'Add Edit Areas'),
(1010, 1001, 'Add Employees'),
(1011, 1001, 'Add Programs'),
(1012, 1001, 'View Bugs'),
(1013, 1002, 'Lexer'),
(1014, 1002, 'Parser'),
(1015, 1002, 'Code Generator'),
(1016, 1002, 'Linker'),
(1017, 1003, 'Lexer'),
(1018, 1003, 'Parser'),
(1019, 1003, 'Code Generator'),
(1020, 1003, 'Linker'),
(1021, 1004, 'Lexer'),
(1022, 1004, 'Parser'),
(1023, 1004, 'Code Generator'),
(1024, 1004, 'Linker'),
(1025, 1004, 'IDE'),
(1026, 1005, 'Lexer'),
(1027, 1005, 'Parser'),
(1028, 1005, 'Code Generator'),
(1029, 1005, 'Linker'),
(1030, 1005, 'IDE'),
(1031, 1006, 'Editor'),
(1032, 1006, 'Spell Checker'),
(1033, 1006, 'Dynodraw'),
(1034, 1006, 'Formulator'),
(1035, 1001, 'Export');

INSERT INTO `bugoptional` (`bugOp_id`, `area_id`, `aEmp`, `comments`, `status`, `priority`, `resolution`, `res_version`, `rEmp`, `rDate`, `tEmp`, `tDate`, `deferred`) VALUES
(1000, NULL, NULL, '', 'Open', 0, '', 0, NULL, '0000-00-00', NULL, '0000-00-00', 0),
(1001, NULL, NULL, '', 'Open', 0, '', 0, NULL, '0000-00-00', NULL, '0000-00-00', 0),
(1002, NULL, NULL, '', 'Open', 0, '', 0, NULL, '0000-00-00', NULL, '0000-00-00', 0),
(1003, NULL, NULL, '', 'Open', 0, '', 0, NULL, '0000-00-00', NULL, '0000-00-00', 0),
(1004, NULL, NULL, '', 'Open', 0, '', 0, NULL, '0000-00-00', NULL, '0000-00-00', 0),
(1005, 1009, 1008, '', 'Closed', 1, '', 0, NULL, '0000-00-00', NULL, '0000-00-00', 0),
(1006, NULL, NULL, '', 'Open', 0, '', 0, NULL, '0000-00-00', NULL, '0000-00-00', 0);

INSERT INTO `bugs` (`bug_id`, `prog_id`, `bug_type`, `severity`, `summary`, `reproduce`, `problem`, `suggest_fix`, `emp_id`, `dDate`, `bugOp_id`) VALUES
(1000, 1000, 'Coding Error', 'Minor', 'The last two lines of output are concatenated on a single line', 1, 'Lines 32 and 33 in the output report\r\nare not on separate lines', '', 1004, '2020-04-30', 1000),
(1001, 1000, 'Design Issue', 'Minor', 'Sue says IDE File->Print defaults to PDF â€“ should be blank ini', 1, 'Sue says IDE File->Print defaults to PDF â€“ should be\r\nblank initially.', '', 1003, '2020-04-30', 1001),
(1002, 1006, 'Design Issue', 'Serious', 'Felix says Formulator missing capital Greek Sigma', 1, 'Felix says Formulator missing capital Greek Sigma', '', 1008, '2020-04-30', 1002),
(1003, 1005, 'Suggestion', 'Minor', 'Becky says IDE should have a toolbar for compiling, linking, run', 1, 'Becky says IDE should have a toolbar for compiling, linking, running.', '', 1007, '2020-04-30', 1003),
(1004, 1002, 'Design Issue', 'Serious', 'Francois says ', 1, 'Francois says \"La distance n\'est pas en kilomÃ¨tres!\"', '', 1006, '2020-04-30', 1004),
(1005, 1001, 'Coding Error', 'Serious', 'Sue says \"add areas page\" has no means to Cancel or quit after adding.', 1, 'Sue says \"add areas page\" has no means to Cancel or quit after adding.', '\"Add Cancel button to page.\"', 1003, '2020-04-30', 1005),
(1006, 1000, 'Coding Error', 'Fatal', 'Habib reports that the math.p library is not found by the linker', 1, 'Habib reports that the math.p library is not found by the linker', '', 1004, '2020-04-30', 1006);

INSERT INTO `attachments` (`attach_id`, `bug_id`, `attach_name`, `attach_type`, `attach_data`) VALUES
(1000, 1004, 'translate.txt', 'text/plain', 0x746865207472616e736c6174696f6e206f662074686520224c612064697374616e6365206e276573740d0a70617320656e206b696c6f6de8747265732220697320225468652064697374616e6365206973206e6f7420696e0d0a6b696c6f6d6574657273222e);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
