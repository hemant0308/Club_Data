CREATE DATABASE IF NOT EXISTS club_data;
 USE club_data;
CREATE TABLE `department_data` (
  `Department_Code` varchar(10) NOT NULL,
  `Department_Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Department_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
INSERT INTO department_data VALUES("01000101","Corp.Office,CMD Secratariat)");
INSERT INTO department_data VALUES("01000103","Corp.Office,D(P) Secretariat)");
INSERT INTO department_data VALUES("03000126","sdfhy4tyefghe");
INSERT INTO department_data VALUES("03007900","IT");
INSERT INTO department_data VALUES("031245","Information Technology");
INSERT INTO department_data VALUES("04000350","Personal(HR Plant)");
INSERT INTO department_data VALUES("04003300","BF");
INSERT INTO department_data VALUES("12","Information Technology");
CREATE TABLE `employee_data` (
  `First_Name` varchar(15) NOT NULL,
  `Last_Name` varchar(15) NOT NULL,
  `Member_Number` varchar(10) NOT NULL,
  `Employee_ID` varchar(10) NOT NULL,
  `Employee_Status` varchar(25) NOT NULL,
  `Department_Code` varchar(10) NOT NULL,
  `Designation` varchar(30) NOT NULL,
  `Phone_Number` varchar(15) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Date_Of_Birth` date NOT NULL,
  `Date_Of_Marriage` date NOT NULL,
  `Date_Of_Retire` date NOT NULL,
  `Profile_Picture` varchar(100) NOT NULL,
  PRIMARY KEY (`Employee_ID`),
  UNIQUE KEY `Employee_ID` (`Employee_ID`),
  KEY `Department_Code` (`Department_Code`),
  KEY `Employee_ID_2` (`Employee_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Member_database';
INSERT INTO employee_data VALUES("S Gopal","","2126","118687","Active(On Rolls)","01000101","","jkl","","kljh","0000-00-00","0000-00-00","0000-00-00","../profile_pictures/01000101.png");
INSERT INTO employee_data VALUES("hema sundar rao","ginni","521","1255","Active(On Rolls)","01000101","student","8464868507","ginnis143@gmail.com","Palasa","2016-07-29","2016-07-22","0000-00-00","../profile_pictures/03007900.jpg");
