-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2023 at 03:02 PM
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
-- Database: `hms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `AppointmentID` int(4) NOT NULL,
  `AppointmentTime` time DEFAULT NULL,
  `AppointmentDate` date DEFAULT NULL,
  `PatientID` int(4) DEFAULT NULL,
  `WardID` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`AppointmentID`, `AppointmentTime`, `AppointmentDate`, `PatientID`, `WardID`) VALUES
(101, '13:30:00', '2023-12-03', 5111, 2001),
(102, '13:00:00', '2023-09-11', 5112, 2002),
(103, '09:00:00', '2023-08-01', 5113, 2002),
(104, '10:45:00', '2023-06-07', 5114, 2005),
(105, '14:30:00', '2023-08-23', 5115, 2004),
(106, '16:30:00', '2023-03-02', 5111, 2003),
(112, '17:45:00', '2023-02-10', 5111, 2002);

-- --------------------------------------------------------

--
-- Table structure for table `appointmentemployeelink`
--

CREATE TABLE `appointmentemployeelink` (
  `AppointmentEmployeeLinkID` int(4) NOT NULL,
  `AppointmentID` int(4) DEFAULT NULL,
  `EmployeeID` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `appointmentemployeelink`
--

INSERT INTO `appointmentemployeelink` (`AppointmentEmployeeLinkID`, `AppointmentID`, `EmployeeID`) VALUES
(201, 101, 1113),
(202, 102, 1116),
(203, 103, 1120),
(204, 104, 1113),
(205, 105, 1111),
(207, 112, 1112),
(208, 113, 1112),
(213, 114, 1112),
(214, 115, 1112),
(215, 116, 1112);

-- --------------------------------------------------------

--
-- Table structure for table `diagnostic`
--

CREATE TABLE `diagnostic` (
  `DiagnosticID` int(4) NOT NULL,
  `DiagnosticResult` varchar(20) DEFAULT NULL,
  `DiagnosticDetails` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `diagnostic`
--

INSERT INTO `diagnostic` (`DiagnosticID`, `DiagnosticResult`, `DiagnosticDetails`) VALUES
(3001, 'Infection', 'Patient has been diagnosed to have an infection.'),
(3002, 'Sprained Hand', 'Patient has been diagnosed with a sprained hand.'),
(3003, 'Common Cold', 'Patient has been diagnosed with a common cold.'),
(3004, 'Broken Hand', 'Patient has been diagnosed to have a broken hand.'),
(3005, 'Flu', 'Patient has been diagnosed with the flu.');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosticpatientemployeelink`
--

CREATE TABLE `diagnosticpatientemployeelink` (
  `DiagnosticPatientEmployeeLinkID` int(4) NOT NULL,
  `DiagnosticDate` date DEFAULT NULL,
  `DiagnosticTreatmentType` varchar(30) DEFAULT NULL,
  `EmployeeID` int(4) DEFAULT NULL,
  `DiagnosticID` int(4) DEFAULT NULL,
  `PatientID` int(4) DEFAULT NULL,
  `DiagnosticNotes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `diagnosticpatientemployeelink`
--

INSERT INTO `diagnosticpatientemployeelink` (`DiagnosticPatientEmployeeLinkID`, `DiagnosticDate`, `DiagnosticTreatmentType`, `EmployeeID`, `DiagnosticID`, `PatientID`, `DiagnosticNotes`) VALUES
(1211, '2022-04-22', 'Perscription', 1111, 3001, 5111, 'Appointment has been made.'),
(1212, '2023-01-03', 'Perscription', 1113, 3002, 5112, ''),
(1213, '2022-04-01', 'Bed Rest', 1116, 3003, 5115, ''),
(1214, '2022-12-23', 'Minor Surgery', 1120, 3004, 5126, ''),
(1215, '2023-01-11', 'Perscription', 1111, 3005, 5130, ''),
(1216, '2023-02-17', 'Perscription', 1128, 3003, 5111, ''),
(1218, '2023-02-09', 'Phsyiotherapy', 1128, 3004, 5111, '');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmployeeID` int(4) NOT NULL,
  `EmployeeFirstName` varchar(20) DEFAULT NULL,
  `EmployeeLastName` varchar(20) DEFAULT NULL,
  `RoleID` int(4) DEFAULT NULL,
  `SpecialityID` int(4) DEFAULT NULL,
  `EmployeeDoB` date DEFAULT NULL,
  `GenderID` varchar(4) DEFAULT NULL,
  `EmployeeContactNumber` varchar(50) DEFAULT NULL,
  `EmployeeEmail` varchar(50) DEFAULT NULL,
  `EmployeeAddress` varchar(20) DEFAULT NULL,
  `EmployeeHireDate` date DEFAULT NULL,
  `LoginDetailsID` int(4) DEFAULT NULL,
  `ManagerID` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmployeeID`, `EmployeeFirstName`, `EmployeeLastName`, `RoleID`, `SpecialityID`, `EmployeeDoB`, `GenderID`, `EmployeeContactNumber`, `EmployeeEmail`, `EmployeeAddress`, `EmployeeHireDate`, `LoginDetailsID`, `ManagerID`) VALUES
(1111, 'James', 'King', 1, 1001, '1996-02-13', 'M', '07885996883', 'j.king@gmail.com', '13, Oak Drive', '2016-12-13', 11, 1122),
(1112, 'Sarah', 'Thames', 4, 1003, '1992-05-10', 'F', '07558499382', 's.thames@gmail.com', '01, Carter Close', '2016-01-02', 12, 1124),
(1113, 'Ben', 'Hope', 2, 1004, '2000-07-06', 'M', '07553664637', 'bhope@yahoo.co.uk', '67, Barter Street', '2020-04-20', 13, 1125),
(1114, 'Harman', 'Jordan', 6, 1003, '2001-01-02', 'PFNS', '07664755574', 'hjordan12@msn.com', '102, Hatton Grove', '2010-09-19', 14, 1124),
(1115, 'July', 'Richardson', 2, 1006, '1998-03-13', 'F', '07775884993', 'jrichardson09@gmail.com', '09, Bakes Avenue', '2022-10-04', 15, 1127),
(1116, 'Hannah', 'Banks', 6, 1007, '1967-10-17', 'F', '0777488377', 'hbanks8@gmail.com', '18, Pico Park', '2022-11-06', 16, 1128),
(1117, 'Hank', 'Larson', 1, 1002, '1946-08-20', 'M', '07226638945', 'hlarson88@yahoo.co.uk', '07, Langley Close', '2023-01-04', 17, 1123),
(1119, 'Harrison', 'Jones', 2, 1005, '2003-11-01', 'M', '07893338847', 'hjones4@gmail.com', '23, Ringo Road', '2019-06-11', 18, 1126),
(1120, 'Helen', 'Emmerson', 2, 1002, '1993-06-06', 'F', '07883366476', 'h.emmerson66@gmail.com', '92, Kirston View', '2018-04-21', 19, 1123),
(1121, 'Harry', 'Hank', 2, 1003, '0000-00-00', 'M', '7446388299', 'hh32@gmail.com', '70, Bank Hall', '0000-00-00', 20, 4003),
(1122, 'John', 'Stones', 5, 1001, '2000-04-10', 'M', '07847584938', 'jstones222@gmail.com', '13, Sparker Drive', '2013-01-16', 21, NULL),
(1123, 'Mike', 'King', 5, 1002, '1992-01-05', 'M', '07449583774', 'mikek@gmail.com', '02, Acre Street', '2003-06-04', 22, NULL),
(1124, 'Jessica', 'Benjamin', 5, 1003, '1987-07-11', 'F', '07849958874', 'jessb12@gmail.com', '07, Bentley Avenue', '1999-12-08', 23, NULL),
(1125, 'Larry', 'Tomb', 5, 1003, '1964-11-21', 'M', '07857488839', 'larrytomb43@gmail.com', '10, King View', '2002-10-03', 24, NULL),
(1126, 'Jones', 'Cole', 5, 1004, '2001-01-12', 'PFNS', '07746653372', 'jcole32@gmail.com', '46, Gantry Road', '2022-12-11', 25, NULL),
(1127, 'July', 'Sides', 5, 1005, '1999-03-08', 'F', '07444639990', 'jsides01@gmail.com', '110, Load Rise', '2020-03-08', 26, NULL),
(1128, 'Suzy', 'Hunt', 5, 1006, '1969-02-04', 'F', '07885778490', 'shunt5@gmail.com', '04, Banksy Walk', '2019-06-21', 27, NULL),
(1138, 'Carter', 'Jones', 3, 1001, '1992-03-25', 'M', '7844638476', 'c.jones19@gmail.com', '218, Barker Street', '2023-02-15', 28, 1122),
(1151, 'Harriet', 'Parker', 5, 1004, '1992-06-26', 'F', '7448599830', 'hparker6@gmail.com', '5, Boat Park View', '2023-02-11', 40, NULL),
(1161, 'Matthew', 'Richards', 4, 1001, '2002-01-08', 'M', '7884775932', 'mrichards63@gmail.com', '13, Kings Drive', '2023-02-22', 46, 1122),
(1163, 'Ben', 'Collins', 2, 1002, '1993-07-31', 'PFNS', '7553627364', 'bc43@gmail.com', '89, Julius Street', '2023-02-22', 47, 1123);

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `GenderID` varchar(4) DEFAULT NULL,
  `GenderTitle` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`GenderID`, `GenderTitle`) VALUES
('M', 'Male'),
('F', 'Female'),
('PFNS', 'Prefer Not To Say');

-- --------------------------------------------------------

--
-- Table structure for table `labresult`
--

CREATE TABLE `labresult` (
  `LabResultID` int(4) NOT NULL,
  `ResultType` varchar(15) DEFAULT NULL,
  `ResultDetails` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `labresult`
--

INSERT INTO `labresult` (`LabResultID`, `ResultType`, `ResultDetails`) VALUES
(501, 'Diabetes', 'It has been found that the patient has Diabetes.'),
(502, 'Iron Deficiency', 'It has been found that the patient has an Iron Deficiency.'),
(503, 'Low Blood Sugar', 'It has been found that the patient has Low Blood Sugars.');

-- --------------------------------------------------------

--
-- Table structure for table `labresultpatientemployeelink`
--

CREATE TABLE `labresultpatientemployeelink` (
  `LabResultPatientEmployeeLinkID` int(4) NOT NULL,
  `ResultDate` date DEFAULT NULL,
  `PatientID` int(4) DEFAULT NULL,
  `EmployeeID` int(4) DEFAULT NULL,
  `LabResultID` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `labresultpatientemployeelink`
--

INSERT INTO `labresultpatientemployeelink` (`LabResultPatientEmployeeLinkID`, `ResultDate`, `PatientID`, `EmployeeID`, `LabResultID`) VALUES
(601, '2022-12-03', 5111, 1111, 501),
(602, '2023-01-02', 5114, 1117, 502),
(603, '2021-04-23', 5120, 1120, 503),
(618, '2023-02-10', 5111, 1128, 502);

-- --------------------------------------------------------

--
-- Table structure for table `logindetails`
--

CREATE TABLE `logindetails` (
  `LoginDetailsID` int(4) NOT NULL,
  `LoginDetailsUsername` varchar(30) DEFAULT NULL,
  `LoginDetailsPassword` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `logindetails`
--

INSERT INTO `logindetails` (`LoginDetailsID`, `LoginDetailsUsername`, `LoginDetailsPassword`) VALUES
(11, 'hs99384', 'bing12'),
(12, 'hs88374', 'bright1'),
(13, 'hs16263', 'hell0'),
(14, 'hs33527', 'DrjSk2'),
(15, 'hs10229', 'j4339J'),
(16, 'hs90028', 'HaLLow98'),
(17, 'hs78221', 'timeJust2'),
(18, 'hs10023', 'King783'),
(19, 'hs88392', 'JDkiL23'),
(20, 'hs78832', 'ko98JK'),
(21, 'hs48839', 'Jne77'),
(22, 'hs77466', 'Tingo34'),
(23, 'hs89588', 'jjHHk4'),
(24, 'hs33744', 'hhJJ3OO4'),
(25, 'hs99928', 'Lkkd33'),
(26, 'hs99228', 'jUMpJ4'),
(27, 'hs33221', 'iJkLll3'),
(28, 'hs66473', 'jcarter12'),
(30, 'hs80123', 'jsummers1'),
(40, 'hs77489', 'hrr4H'),
(41, 'hs77489', 'hrr4H'),
(46, 'hs84773', 'mrich4'),
(47, 'hs26338', 'bcoll2'),
(48, 'uhuewuhf', 'iuhweihfwe');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `PatientID` int(4) NOT NULL,
  `PatientFirstName` varchar(20) DEFAULT NULL,
  `PatientLastName` varchar(20) DEFAULT NULL,
  `PatientDoB` date DEFAULT NULL,
  `GenderID` varchar(4) DEFAULT NULL,
  `PatientContactNumber` varchar(50) DEFAULT NULL,
  `PatientAddress` varchar(30) DEFAULT NULL,
  `WardID` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`PatientID`, `PatientFirstName`, `PatientLastName`, `PatientDoB`, `GenderID`, `PatientContactNumber`, `PatientAddress`, `WardID`) VALUES
(5111, 'Ahmed', 'Camacho', '2002-12-06', 'M', '7483749876', '13, Ivory Close', 2006),
(5112, 'Rory', 'Mcclure', '1967-08-11', 'M', '7594857654', '113, Kings Drive', 2002),
(5113, 'David', 'Arroyo', '1996-03-24', 'PFNS', '7577684773', '453, Carter Street', 2004),
(5114, 'Spencer', 'Trevino', '2005-10-02', 'M', '7321135766', '01, Longsdale Drive', 2006),
(5115, 'Sam', 'Sherman', '1998-03-01', 'PFNS', '7883746632', '21, Banks Avenue', 2006),
(5116, 'Luna', 'Silva', '2007-09-15', 'F', '7894766379', '04, Houston Drive', 2001),
(5117, 'Ishaan', 'Orr', '2002-11-01', 'PFNS', '7348772945', '108, Hillary Rise', 2005),
(5118, 'Tim', 'Jordan', '1978-02-20', 'M', '7839447592', '17, King Street', 2006),
(5119, 'Blake', 'Crawford', '2000-07-18', 'M', '7314582044', '76, Harper Grove', 2006),
(5120, 'Francesco', 'Leonard', '1952-12-03', 'M', '7293885731', '44, Hamilton Drive', 2001),
(5121, 'Yasir', 'Cordova', '1943-06-01', 'F', '7483984823', '30, Reacher Road', 2006),
(5122, 'Aiden', 'Shepard', '2004-07-12', 'M', '7499384562', '98, Imola Close', 2005),
(5123, 'Gareth', 'Blake', '1988-02-19', 'M', '7992847752', '04, Bank Drive', 2006),
(5124, 'Usman', 'Hutchinson', '1999-10-06', 'M', '7399747821', '08, Sutton Avenue', 2006),
(5125, 'Clarence', 'Farmer', '2003-11-09', 'M', '7884736642', '67, Jarston Grove', 2002),
(5126, 'Francis', 'Duran', '1967-04-03', 'M', '7993846766', '21, Huddle View', 2006),
(5127, 'Rahim', 'Henderson', '1995-09-15', 'M', '7339277488', '07, Pink Street', 2004),
(5128, 'Faith', 'Kreiger', '1998-02-01', 'F', '7123388574', '19, Garver Road', 2006),
(5129, 'Amaan', 'Nash', '2002-03-11', 'PFNS', '7399488345', '10, Sauber Road', 2005);

-- --------------------------------------------------------

--
-- Table structure for table `patientsinwardlink`
--

CREATE TABLE `patientsinwardlink` (
  `PatientsInWardLinkID` int(4) NOT NULL,
  `PatientID` int(4) DEFAULT NULL,
  `WardID` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `patientsinwardlink`
--

INSERT INTO `patientsinwardlink` (`PatientsInWardLinkID`, `PatientID`, `WardID`) VALUES
(1, 5112, 2002),
(2, 5113, 2004),
(3, 5116, 2001),
(4, 5117, 2005),
(5, 5120, 2003),
(6, 5122, 2005),
(7, 5125, 2004),
(8, 5127, 2004),
(9, 5129, 2005),
(10, 5130, 2001);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `RoleID` int(4) NOT NULL,
  `RoleTitle` varchar(20) DEFAULT NULL,
  `RoleDescription` text DEFAULT NULL,
  `RoleSalary` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`RoleID`, `RoleTitle`, `RoleDescription`, `RoleSalary`) VALUES
(1, 'Doctor', 'The doctor is someone who is experienced and certified to practice medicine to help maintain or restore physical and mental health. A doctor is taked with interacting with patients, diagnosing medical problems and successfully treating illness or injury.', 50000),
(2, 'Nurse', 'The nurse will take care of patients in and off the ward. There role will be to ensure that patients are well looked after, handing out perscribed medicines and moving patients around the hospital.', 40000),
(3, 'Receptionist', 'The receptionist is responsible for managing patients entry and exit of the hospital. A receptionist will also be responsible for taking a patients details and registering them to the system.', 25000),
(4, 'Administrator', 'The Administrator will be resposnbile for general maintaince of the system. The administrator will also add and remove staff from the system as needed.', 30000),
(5, 'Manager', 'The Manager will be in charge of the management of the hospital and will ensure that the hospital is running smoothly.', 100000),
(6, 'Surgeon', 'The surgeon will be responsible for handling and carrying out minor and major surgeries on patients.', 70000);

-- --------------------------------------------------------

--
-- Table structure for table `speciality`
--

CREATE TABLE `speciality` (
  `SpecialityID` int(4) NOT NULL,
  `SpecialityTitle` varchar(20) DEFAULT NULL,
  `SpecialityDescription` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `speciality`
--

INSERT INTO `speciality` (`SpecialityID`, `SpecialityTitle`, `SpecialityDescription`) VALUES
(1001, 'General Care', 'This speciality is for staff that specialise in General Care issues.'),
(1002, 'Critial Care', 'This speciality is for staff that specialise in Critial Care issues.'),
(1003, 'Mental Health', 'This speciality is for staff that specialise in Menthal Health issues.'),
(1004, 'Dermatology', 'This speciality is for staff that specialise in Dermatology.'),
(1005, 'Public Health', 'This speciality is for staff that specialise in Public Health issues.'),
(1006, 'Dental', 'This speciality is for staff that specialise in Dental Care issues.'),
(1007, 'Trauma', 'This speciality is for staff that specialise in Trauma Care.');

-- --------------------------------------------------------

--
-- Table structure for table `ward`
--

CREATE TABLE `ward` (
  `WardID` int(4) NOT NULL,
  `WardName` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ward`
--

INSERT INTO `ward` (`WardID`, `WardName`) VALUES
(2001, 'West View Ward'),
(2002, 'Garter Ward'),
(2003, 'Battersby Ward'),
(2004, 'Hattersly Ward'),
(2005, 'East View Ward'),
(2006, 'Not In Hospital');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`AppointmentID`);

--
-- Indexes for table `appointmentemployeelink`
--
ALTER TABLE `appointmentemployeelink`
  ADD PRIMARY KEY (`AppointmentEmployeeLinkID`);

--
-- Indexes for table `diagnostic`
--
ALTER TABLE `diagnostic`
  ADD PRIMARY KEY (`DiagnosticID`);

--
-- Indexes for table `diagnosticpatientemployeelink`
--
ALTER TABLE `diagnosticpatientemployeelink`
  ADD PRIMARY KEY (`DiagnosticPatientEmployeeLinkID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indexes for table `labresult`
--
ALTER TABLE `labresult`
  ADD PRIMARY KEY (`LabResultID`);

--
-- Indexes for table `labresultpatientemployeelink`
--
ALTER TABLE `labresultpatientemployeelink`
  ADD PRIMARY KEY (`LabResultPatientEmployeeLinkID`);

--
-- Indexes for table `logindetails`
--
ALTER TABLE `logindetails`
  ADD PRIMARY KEY (`LoginDetailsID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`PatientID`);

--
-- Indexes for table `patientsinwardlink`
--
ALTER TABLE `patientsinwardlink`
  ADD PRIMARY KEY (`PatientsInWardLinkID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`RoleID`);

--
-- Indexes for table `speciality`
--
ALTER TABLE `speciality`
  ADD PRIMARY KEY (`SpecialityID`);

--
-- Indexes for table `ward`
--
ALTER TABLE `ward`
  ADD PRIMARY KEY (`WardID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `AppointmentID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `appointmentemployeelink`
--
ALTER TABLE `appointmentemployeelink`
  MODIFY `AppointmentEmployeeLinkID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT for table `diagnostic`
--
ALTER TABLE `diagnostic`
  MODIFY `DiagnosticID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3006;

--
-- AUTO_INCREMENT for table `diagnosticpatientemployeelink`
--
ALTER TABLE `diagnosticpatientemployeelink`
  MODIFY `DiagnosticPatientEmployeeLinkID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1220;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EmployeeID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1166;

--
-- AUTO_INCREMENT for table `labresult`
--
ALTER TABLE `labresult`
  MODIFY `LabResultID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=504;

--
-- AUTO_INCREMENT for table `labresultpatientemployeelink`
--
ALTER TABLE `labresultpatientemployeelink`
  MODIFY `LabResultPatientEmployeeLinkID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=621;

--
-- AUTO_INCREMENT for table `logindetails`
--
ALTER TABLE `logindetails`
  MODIFY `LoginDetailsID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `PatientID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5153;

--
-- AUTO_INCREMENT for table `patientsinwardlink`
--
ALTER TABLE `patientsinwardlink`
  MODIFY `PatientsInWardLinkID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `RoleID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `speciality`
--
ALTER TABLE `speciality`
  MODIFY `SpecialityID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1008;

--
-- AUTO_INCREMENT for table `ward`
--
ALTER TABLE `ward`
  MODIFY `WardID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2007;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
