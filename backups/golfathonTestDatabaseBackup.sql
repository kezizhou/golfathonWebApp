-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Generation Time: Dec 04, 2019 at 03:07 PM
-- Server version: 5.7.11-log
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbGolfathonDev`
--

-- --------------------------------------------------------

--
-- Table structure for table `TBenefits`
--

CREATE TABLE `TBenefits` (
  `intBenefitID` int(11) NOT NULL,
  `strBenefitDescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TBenefits`
--

INSERT INTO `TBenefits` (`intBenefitID`, `strBenefitDescription`) VALUES
(1, 'Recognition at Dinner'),
(2, 'Company Logo on Signage'),
(3, 'Lunch for Company Representatives'),
(4, 'Social Media Recognition'),
(5, 'VIP Golf Tournament Tickets'),
(6, 'Entered into Prize Raffle'),
(7, 'Priority Corporate Volunteer Event'),
(8, 'Golf Package for 1 Foursome'),
(9, 'Golf Package for 2 Foursomes'),
(10, 'Company Logo on Press Materials');

-- --------------------------------------------------------

--
-- Table structure for table `TCorporateSponsors`
--

CREATE TABLE `TCorporateSponsors` (
  `intCorporateSponsorID` int(11) NOT NULL,
  `strFirstName` varchar(255) NOT NULL,
  `strLastName` varchar(255) NOT NULL,
  `strAddress` varchar(255) NOT NULL,
  `strCity` varchar(255) NOT NULL,
  `strZip` varchar(255) NOT NULL,
  `strContactPhone` varchar(255) NOT NULL,
  `strContactEmail` varchar(255) NOT NULL,
  `intStateID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TCorporateSponsors`
--

INSERT INTO `TCorporateSponsors` (`intCorporateSponsorID`, `strFirstName`, `strLastName`, `strAddress`, `strCity`, `strZip`, `strContactPhone`, `strContactEmail`, `intStateID`) VALUES
(1, 'Sandy', 'Miller', '8126 Stonelake Ct.', 'Cincinnati', '45038', '513-431-5782', 'smiller@company.com', 2),
(2, 'Chris', 'Howard', '2697 Lakefield Way', 'Union', '41036', '859-765-4293', 'choward@company.com', 1),
(3, 'Phil', 'Brooks', '168 Meadow Dr.', 'Norwood', '45039', '513-726-8513', 'pbrooks@company.com', 2),
(4, 'Sally', 'Peterson', '6287 Charteroak Dr.', 'Blue Ash', '45028', '513-924-8135', 'speterson@company.com', 2),
(5, 'Eric', 'Jones', '681 Crestview Ct.', 'West Chester', '45039', '513-281-6432', 'ejones@company.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `TCorporateSponsorshipTypes`
--

CREATE TABLE `TCorporateSponsorshipTypes` (
  `intCorporateSponsorshipTypeID` int(11) NOT NULL,
  `strCorporateSponsorshipType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TCorporateSponsorshipTypes`
--

INSERT INTO `TCorporateSponsorshipTypes` (`intCorporateSponsorshipTypeID`, `strCorporateSponsorshipType`) VALUES
(1, 'Cart Sponsor'),
(2, 'Lunch Sponsor'),
(3, 'Shirt Sponsor'),
(4, 'Dinner Sponsor');

-- --------------------------------------------------------

--
-- Table structure for table `TEventCoordinators`
--

CREATE TABLE `TEventCoordinators` (
  `intEventCoordinatorID` int(11) NOT NULL,
  `strLoginID` varchar(20) NOT NULL,
  `strPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TEventCoordinators`
--

INSERT INTO `TEventCoordinators` (`intEventCoordinatorID`, `strLoginID`, `strPassword`) VALUES
(1, 'testadmin', '$2y$10$0C57AK996V395afc0WYaxOIO5pNYlJDHTAwA1pqkS8jVQC/KoTd4.'),
(2, 'testadmin2', '$2y$10$ZaC9KvjvFYx0uu2Cz6Ontu9XCXagvu4rFAj1yfUQaLWppbpzZHBTa');

-- --------------------------------------------------------

--
-- Table structure for table `TEventCorporateSponsorshipTypeBenefits`
--

CREATE TABLE `TEventCorporateSponsorshipTypeBenefits` (
  `intEventCorporateSponsorshipTypeBenefitID` int(11) NOT NULL,
  `intEventCorporateSponsorshipTypeID` int(11) NOT NULL,
  `intBenefitID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TEventCorporateSponsorshipTypeBenefits`
--

INSERT INTO `TEventCorporateSponsorshipTypeBenefits` (`intEventCorporateSponsorshipTypeBenefitID`, `intEventCorporateSponsorshipTypeID`, `intBenefitID`) VALUES
(1, 1, 1),
(2, 1, 4),
(3, 1, 6),
(4, 1, 10),
(5, 2, 1),
(6, 2, 2),
(7, 2, 5),
(8, 2, 6),
(9, 2, 8),
(10, 3, 1),
(11, 3, 3),
(12, 3, 6),
(13, 3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `TEventCorporateSponsorshipTypeCorporateSponsors`
--

CREATE TABLE `TEventCorporateSponsorshipTypeCorporateSponsors` (
  `intEventCorporateSponsorshipTypeCorporateSponsorsID` int(11) NOT NULL,
  `intEventCorporateSponsorshipTypeID` int(11) NOT NULL,
  `intCorporateSponsorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TEventCorporateSponsorshipTypeCorporateSponsors`
--

INSERT INTO `TEventCorporateSponsorshipTypeCorporateSponsors` (`intEventCorporateSponsorshipTypeCorporateSponsorsID`, `intEventCorporateSponsorshipTypeID`, `intCorporateSponsorID`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 2, 4),
(5, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `TEventCorporateSponsorshipTypes`
--

CREATE TABLE `TEventCorporateSponsorshipTypes` (
  `intEventCorporateSponsorshipTypeID` int(11) NOT NULL,
  `intCorporateSponsorshipTypeID` int(11) NOT NULL,
  `intEventID` int(11) NOT NULL,
  `dblSponsorshipCost` double NOT NULL,
  `intSponsorshipAvailable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TEventCorporateSponsorshipTypes`
--

INSERT INTO `TEventCorporateSponsorshipTypes` (`intEventCorporateSponsorshipTypeID`, `intCorporateSponsorshipTypeID`, `intEventID`, `dblSponsorshipCost`, `intSponsorshipAvailable`) VALUES
(1, 2, 1, 300, 5),
(2, 1, 1, 500, 3),
(3, 3, 1, 150, 7);

-- --------------------------------------------------------

--
-- Table structure for table `TEventGolfers`
--

CREATE TABLE `TEventGolfers` (
  `intEventGolferID` int(11) NOT NULL,
  `intEventID` int(11) NOT NULL,
  `intGolferID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TEventGolfers`
--

INSERT INTO `TEventGolfers` (`intEventGolferID`, `intEventID`, `intGolferID`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 1, 5),
(4, 1, 1),
(5, 1, 4),
(6, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `TEventGolferSponsors`
--

CREATE TABLE `TEventGolferSponsors` (
  `intEventGolferSponsorID` int(11) NOT NULL,
  `intEventGolferID` int(11) NOT NULL,
  `intSponsorID` int(11) NOT NULL,
  `intPaymentTypeID` int(11) NOT NULL,
  `intPaymentStatusID` int(11) NOT NULL,
  `dteDateOfPledge` date NOT NULL,
  `dblPledgePerHole` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TEventGolferSponsors`
--

INSERT INTO `TEventGolferSponsors` (`intEventGolferSponsorID`, `intEventGolferID`, `intSponsorID`, `intPaymentTypeID`, `intPaymentStatusID`, `dteDateOfPledge`, `dblPledgePerHole`) VALUES
(1, 1, 1, 1, 1, '2019-11-21', 20),
(2, 5, 2, 3, 1, '2019-11-21', 15),
(3, 3, 3, 2, 1, '2019-11-21', 100);

-- --------------------------------------------------------

--
-- Table structure for table `TEventGolferTeamandClubs`
--

CREATE TABLE `TEventGolferTeamandClubs` (
  `intEventGolferTeamandClubID` int(11) NOT NULL,
  `intEventGolferID` int(11) NOT NULL,
  `intTeamandClubID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TEventGolferTeamandClubs`
--

INSERT INTO `TEventGolferTeamandClubs` (`intEventGolferTeamandClubID`, `intEventGolferID`, `intTeamandClubID`) VALUES
(1, 1, 14),
(2, 3, 8),
(3, 2, 5),
(4, 4, 13),
(5, 5, 2),
(6, 6, 12);

-- --------------------------------------------------------

--
-- Table structure for table `TEvents`
--

CREATE TABLE `TEvents` (
  `intEventID` int(11) NOT NULL,
  `dteEventYear` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TEvents`
--

INSERT INTO `TEvents` (`intEventID`, `dteEventYear`) VALUES
(1, 2020);

-- --------------------------------------------------------

--
-- Table structure for table `TGenders`
--

CREATE TABLE `TGenders` (
  `intGenderID` int(11) NOT NULL,
  `strGender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TGenders`
--

INSERT INTO `TGenders` (`intGenderID`, `strGender`) VALUES
(1, 'Female'),
(2, 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `TGolfers`
--

CREATE TABLE `TGolfers` (
  `intGolferID` int(11) NOT NULL,
  `strFirstName` varchar(255) NOT NULL,
  `strLastName` varchar(255) NOT NULL,
  `strAddress` varchar(255) NOT NULL,
  `strCity` varchar(255) NOT NULL,
  `strZip` varchar(255) NOT NULL,
  `strPhone` varchar(255) NOT NULL,
  `strEmail` varchar(255) NOT NULL,
  `intStateID` int(11) NOT NULL,
  `intShirtSizeID` int(11) NOT NULL,
  `intGenderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TGolfers`
--

INSERT INTO `TGolfers` (`intGolferID`, `strFirstName`, `strLastName`, `strAddress`, `strCity`, `strZip`, `strPhone`, `strEmail`, `intStateID`, `intShirtSizeID`, `intGenderID`) VALUES
(1, 'Mary', 'Jane', '123', 'Cincinnati', '45022', '123-456-7890', 'maryj@gmail.com', 2, 2, 1),
(2, 'Mark', 'Phillips', '456', 'Florence', '45027', '859-138-5168', 'mphillips@gmail.com', 1, 8, 2),
(3, 'Bo', 'Nields', '8741', 'Mason', '41042', '513-249-4513', 'bnuields@gmail.com', 2, 1, 1),
(4, 'Joe', 'Fields', '2334', 'Norwood', '45024', '513-276-4592', 'jfields@yahoo.com', 2, 5, 2),
(5, 'Charles', 'William', '716 Spring Dr.', 'Cincinnati', '45022', '5137562943', 'cwilliam@yahoo.com', 2, 6, 2),
(6, 'Peter', 'Brown', '5481 Fields Dr.', 'Mason', '45081', '513-581-5612', 'jbrown@yahoo.com', 2, 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `TLevelofTeams`
--

CREATE TABLE `TLevelofTeams` (
  `intLevelofTeamID` int(11) NOT NULL,
  `strLevelOfTeam` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TLevelofTeams`
--

INSERT INTO `TLevelofTeams` (`intLevelofTeamID`, `strLevelOfTeam`) VALUES
(1, 'JV'),
(2, 'Varsity'),
(3, 'Professional');

-- --------------------------------------------------------

--
-- Table structure for table `TPaymentStatuses`
--

CREATE TABLE `TPaymentStatuses` (
  `intPaymentStatusID` int(11) NOT NULL,
  `strPaymentStatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TPaymentStatuses`
--

INSERT INTO `TPaymentStatuses` (`intPaymentStatusID`, `strPaymentStatus`) VALUES
(1, 'Unpaid'),
(2, 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `TPaymentTypes`
--

CREATE TABLE `TPaymentTypes` (
  `intPaymentTypeID` int(11) NOT NULL,
  `strPaymentType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TPaymentTypes`
--

INSERT INTO `TPaymentTypes` (`intPaymentTypeID`, `strPaymentType`) VALUES
(1, 'Cash'),
(2, 'Check'),
(3, 'Credit');

-- --------------------------------------------------------

--
-- Table structure for table `TShirtSizes`
--

CREATE TABLE `TShirtSizes` (
  `intShirtSizeID` int(11) NOT NULL,
  `strShirtSize` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TShirtSizes`
--

INSERT INTO `TShirtSizes` (`intShirtSizeID`, `strShirtSize`) VALUES
(1, 'Women S'),
(2, 'Women M'),
(3, 'Women L'),
(4, 'Women XL'),
(5, 'Men S'),
(6, 'Men M'),
(7, 'Men L'),
(8, 'Men XL');

-- --------------------------------------------------------

--
-- Table structure for table `TSponsors`
--

CREATE TABLE `TSponsors` (
  `intSponsorID` int(11) NOT NULL,
  `strFirstName` varchar(255) NOT NULL,
  `strLastName` varchar(255) NOT NULL,
  `strAddress` varchar(255) NOT NULL,
  `strCity` varchar(255) NOT NULL,
  `strZip` varchar(255) NOT NULL,
  `strPhone` varchar(255) NOT NULL,
  `strEmail` varchar(255) NOT NULL,
  `intStateID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TSponsors`
--

INSERT INTO `TSponsors` (`intSponsorID`, `strFirstName`, `strLastName`, `strAddress`, `strCity`, `strZip`, `strPhone`, `strEmail`, `intStateID`) VALUES
(1, 'Beth', 'Franklin', '6843 Oceanmist Dr.', 'Indianapolis', '45318', '2734684835', 'bfranklin@gmail.com', 3),
(2, 'Jacob', 'Fisher', '843 Meadow Dr.', 'West Chester', '45037', '513-752-4627', 'jfisher@outlook.com', 2),
(3, 'Drew', 'Baker', '7216 Mooncrest Ct.', 'Ft. Mitchell', '45017', '859-273-4813', 'dbaker@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `TStates`
--

CREATE TABLE `TStates` (
  `intStateID` int(11) NOT NULL,
  `strState` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TStates`
--

INSERT INTO `TStates` (`intStateID`, `strState`) VALUES
(1, 'KY'),
(2, 'OH'),
(3, 'IN');

-- --------------------------------------------------------

--
-- Table structure for table `TTeamandClubs`
--

CREATE TABLE `TTeamandClubs` (
  `intTeamandClubID` int(11) NOT NULL,
  `intTypeofTeamID` int(11) NOT NULL,
  `intLevelofTeamID` int(11) NOT NULL,
  `intGenderofTeamID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TTeamandClubs`
--

INSERT INTO `TTeamandClubs` (`intTeamandClubID`, `intTypeofTeamID`, `intLevelofTeamID`, `intGenderofTeamID`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 2),
(3, 1, 2, 1),
(4, 1, 2, 2),
(5, 2, 1, 1),
(6, 2, 1, 2),
(7, 2, 2, 1),
(8, 2, 2, 2),
(9, 2, 3, 1),
(10, 2, 3, 2),
(11, 3, 1, 1),
(12, 3, 1, 2),
(13, 3, 2, 1),
(14, 3, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `TTypeofTeams`
--

CREATE TABLE `TTypeofTeams` (
  `intTypeofTeamID` int(11) NOT NULL,
  `strTypeofTeam` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `TTypeofTeams`
--

INSERT INTO `TTypeofTeams` (`intTypeofTeamID`, `strTypeofTeam`) VALUES
(1, 'Junior'),
(2, 'Adult'),
(3, 'Senior');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `TBenefits`
--
ALTER TABLE `TBenefits`
  ADD PRIMARY KEY (`intBenefitID`);

--
-- Indexes for table `TCorporateSponsors`
--
ALTER TABLE `TCorporateSponsors`
  ADD PRIMARY KEY (`intCorporateSponsorID`),
  ADD KEY `intStateID` (`intStateID`);

--
-- Indexes for table `TCorporateSponsorshipTypes`
--
ALTER TABLE `TCorporateSponsorshipTypes`
  ADD PRIMARY KEY (`intCorporateSponsorshipTypeID`);

--
-- Indexes for table `TEventCoordinators`
--
ALTER TABLE `TEventCoordinators`
  ADD PRIMARY KEY (`intEventCoordinatorID`);

--
-- Indexes for table `TEventCorporateSponsorshipTypeBenefits`
--
ALTER TABLE `TEventCorporateSponsorshipTypeBenefits`
  ADD PRIMARY KEY (`intEventCorporateSponsorshipTypeBenefitID`),
  ADD KEY `intBenefitID` (`intBenefitID`),
  ADD KEY `intEventCorporateSponsorshipTypeID` (`intEventCorporateSponsorshipTypeID`);

--
-- Indexes for table `TEventCorporateSponsorshipTypeCorporateSponsors`
--
ALTER TABLE `TEventCorporateSponsorshipTypeCorporateSponsors`
  ADD PRIMARY KEY (`intEventCorporateSponsorshipTypeCorporateSponsorsID`),
  ADD KEY `intEventCorporateSponsorshipTypeID` (`intEventCorporateSponsorshipTypeID`),
  ADD KEY `intCorporateSponsorID` (`intCorporateSponsorID`);

--
-- Indexes for table `TEventCorporateSponsorshipTypes`
--
ALTER TABLE `TEventCorporateSponsorshipTypes`
  ADD PRIMARY KEY (`intEventCorporateSponsorshipTypeID`),
  ADD KEY `intSponsorshipAvailable` (`intSponsorshipAvailable`),
  ADD KEY `intCorporateSponsorTypeID` (`intCorporateSponsorshipTypeID`),
  ADD KEY `intEventID` (`intEventID`);

--
-- Indexes for table `TEventGolfers`
--
ALTER TABLE `TEventGolfers`
  ADD PRIMARY KEY (`intEventGolferID`),
  ADD KEY `intEventID` (`intEventID`),
  ADD KEY `intGolferID` (`intGolferID`);

--
-- Indexes for table `TEventGolferSponsors`
--
ALTER TABLE `TEventGolferSponsors`
  ADD PRIMARY KEY (`intEventGolferSponsorID`),
  ADD KEY `intEventGolferID` (`intEventGolferID`),
  ADD KEY `intSponsorID` (`intSponsorID`),
  ADD KEY `intPaymentTypeID` (`intPaymentTypeID`),
  ADD KEY `intPaymentStatusID` (`intPaymentStatusID`);

--
-- Indexes for table `TEventGolferTeamandClubs`
--
ALTER TABLE `TEventGolferTeamandClubs`
  ADD PRIMARY KEY (`intEventGolferTeamandClubID`),
  ADD KEY `intEventGolferID` (`intEventGolferID`),
  ADD KEY `intTeamandClubID` (`intTeamandClubID`);

--
-- Indexes for table `TEvents`
--
ALTER TABLE `TEvents`
  ADD PRIMARY KEY (`intEventID`);

--
-- Indexes for table `TGenders`
--
ALTER TABLE `TGenders`
  ADD PRIMARY KEY (`intGenderID`);

--
-- Indexes for table `TGolfers`
--
ALTER TABLE `TGolfers`
  ADD PRIMARY KEY (`intGolferID`),
  ADD KEY `intStateID` (`intStateID`),
  ADD KEY `intShirtSizeID` (`intShirtSizeID`),
  ADD KEY `intGenderID` (`intGenderID`);

--
-- Indexes for table `TLevelofTeams`
--
ALTER TABLE `TLevelofTeams`
  ADD PRIMARY KEY (`intLevelofTeamID`);

--
-- Indexes for table `TPaymentStatuses`
--
ALTER TABLE `TPaymentStatuses`
  ADD PRIMARY KEY (`intPaymentStatusID`);

--
-- Indexes for table `TPaymentTypes`
--
ALTER TABLE `TPaymentTypes`
  ADD PRIMARY KEY (`intPaymentTypeID`);

--
-- Indexes for table `TShirtSizes`
--
ALTER TABLE `TShirtSizes`
  ADD PRIMARY KEY (`intShirtSizeID`);

--
-- Indexes for table `TSponsors`
--
ALTER TABLE `TSponsors`
  ADD PRIMARY KEY (`intSponsorID`),
  ADD KEY `intStateID` (`intStateID`) USING BTREE;

--
-- Indexes for table `TStates`
--
ALTER TABLE `TStates`
  ADD PRIMARY KEY (`intStateID`);

--
-- Indexes for table `TTeamandClubs`
--
ALTER TABLE `TTeamandClubs`
  ADD PRIMARY KEY (`intTeamandClubID`),
  ADD KEY `intGenderofTeamID` (`intGenderofTeamID`),
  ADD KEY `intLevelofTeamID` (`intLevelofTeamID`),
  ADD KEY `intTypeofTeamID` (`intTypeofTeamID`);

--
-- Indexes for table `TTypeofTeams`
--
ALTER TABLE `TTypeofTeams`
  ADD PRIMARY KEY (`intTypeofTeamID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `TBenefits`
--
ALTER TABLE `TBenefits`
  MODIFY `intBenefitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `TCorporateSponsors`
--
ALTER TABLE `TCorporateSponsors`
  MODIFY `intCorporateSponsorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `TCorporateSponsorshipTypes`
--
ALTER TABLE `TCorporateSponsorshipTypes`
  MODIFY `intCorporateSponsorshipTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `TEventCoordinators`
--
ALTER TABLE `TEventCoordinators`
  MODIFY `intEventCoordinatorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `TEventCorporateSponsorshipTypeBenefits`
--
ALTER TABLE `TEventCorporateSponsorshipTypeBenefits`
  MODIFY `intEventCorporateSponsorshipTypeBenefitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `TEventCorporateSponsorshipTypeCorporateSponsors`
--
ALTER TABLE `TEventCorporateSponsorshipTypeCorporateSponsors`
  MODIFY `intEventCorporateSponsorshipTypeCorporateSponsorsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `TEventCorporateSponsorshipTypes`
--
ALTER TABLE `TEventCorporateSponsorshipTypes`
  MODIFY `intEventCorporateSponsorshipTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `TEventGolfers`
--
ALTER TABLE `TEventGolfers`
  MODIFY `intEventGolferID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `TEventGolferSponsors`
--
ALTER TABLE `TEventGolferSponsors`
  MODIFY `intEventGolferSponsorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `TEventGolferTeamandClubs`
--
ALTER TABLE `TEventGolferTeamandClubs`
  MODIFY `intEventGolferTeamandClubID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `TEvents`
--
ALTER TABLE `TEvents`
  MODIFY `intEventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `TGenders`
--
ALTER TABLE `TGenders`
  MODIFY `intGenderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `TGolfers`
--
ALTER TABLE `TGolfers`
  MODIFY `intGolferID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `TLevelofTeams`
--
ALTER TABLE `TLevelofTeams`
  MODIFY `intLevelofTeamID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `TPaymentStatuses`
--
ALTER TABLE `TPaymentStatuses`
  MODIFY `intPaymentStatusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `TPaymentTypes`
--
ALTER TABLE `TPaymentTypes`
  MODIFY `intPaymentTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `TShirtSizes`
--
ALTER TABLE `TShirtSizes`
  MODIFY `intShirtSizeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `TSponsors`
--
ALTER TABLE `TSponsors`
  MODIFY `intSponsorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `TStates`
--
ALTER TABLE `TStates`
  MODIFY `intStateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `TTeamandClubs`
--
ALTER TABLE `TTeamandClubs`
  MODIFY `intTeamandClubID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `TTypeofTeams`
--
ALTER TABLE `TTypeofTeams`
  MODIFY `intTypeofTeamID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `TCorporateSponsors`
--
ALTER TABLE `TCorporateSponsors`
  ADD CONSTRAINT `tcorporatesponsors_ibfk_1` FOREIGN KEY (`intStateID`) REFERENCES `TStates` (`intStateID`) ON DELETE CASCADE;

--
-- Constraints for table `TEventCorporateSponsorshipTypeBenefits`
--
ALTER TABLE `TEventCorporateSponsorshipTypeBenefits`
  ADD CONSTRAINT `teventcorporatesponsorshiptypebenefits_ibfk_1` FOREIGN KEY (`intBenefitID`) REFERENCES `TBenefits` (`intBenefitID`) ON DELETE CASCADE,
  ADD CONSTRAINT `teventcorporatesponsorshiptypebenefits_ibfk_2` FOREIGN KEY (`intEventCorporateSponsorshipTypeID`) REFERENCES `TEventCorporateSponsorshipTypes` (`intEventCorporateSponsorshipTypeID`) ON DELETE CASCADE;

--
-- Constraints for table `TEventCorporateSponsorshipTypeCorporateSponsors`
--
ALTER TABLE `TEventCorporateSponsorshipTypeCorporateSponsors`
  ADD CONSTRAINT `teventcorporatesponsorshiptypecorporatesponsors_ibfk_1` FOREIGN KEY (`intCorporateSponsorID`) REFERENCES `TCorporateSponsors` (`intCorporateSponsorID`) ON DELETE CASCADE,
  ADD CONSTRAINT `teventcorporatesponsorshiptypecorporatesponsors_ibfk_2` FOREIGN KEY (`intEventCorporateSponsorshipTypeID`) REFERENCES `TEventCorporateSponsorshipTypes` (`intEventCorporateSponsorshipTypeID`) ON DELETE CASCADE;

--
-- Constraints for table `TEventCorporateSponsorshipTypes`
--
ALTER TABLE `TEventCorporateSponsorshipTypes`
  ADD CONSTRAINT `teventcorporatesponsorshiptypes_ibfk_1` FOREIGN KEY (`intCorporateSponsorshipTypeID`) REFERENCES `TCorporateSponsorshipTypes` (`intCorporateSponsorshipTypeID`) ON DELETE CASCADE,
  ADD CONSTRAINT `teventcorporatesponsorshiptypes_ibfk_2` FOREIGN KEY (`intEventID`) REFERENCES `TEvents` (`intEventID`) ON DELETE CASCADE;

--
-- Constraints for table `TEventGolfers`
--
ALTER TABLE `TEventGolfers`
  ADD CONSTRAINT `teventgolfers_ibfk_1` FOREIGN KEY (`intEventID`) REFERENCES `TEvents` (`intEventID`) ON DELETE CASCADE,
  ADD CONSTRAINT `teventgolfers_ibfk_2` FOREIGN KEY (`intGolferID`) REFERENCES `TGolfers` (`intGolferID`) ON DELETE CASCADE;

--
-- Constraints for table `TEventGolferSponsors`
--
ALTER TABLE `TEventGolferSponsors`
  ADD CONSTRAINT `teventgolfersponsors_ibfk_1` FOREIGN KEY (`intSponsorID`) REFERENCES `TSponsors` (`intSponsorID`) ON DELETE CASCADE,
  ADD CONSTRAINT `teventgolfersponsors_ibfk_2` FOREIGN KEY (`intPaymentStatusID`) REFERENCES `TPaymentStatuses` (`intPaymentStatusID`) ON DELETE CASCADE,
  ADD CONSTRAINT `teventgolfersponsors_ibfk_3` FOREIGN KEY (`intPaymentTypeID`) REFERENCES `TPaymentTypes` (`intPaymentTypeID`) ON DELETE CASCADE,
  ADD CONSTRAINT `teventgolfersponsors_ibfk_4` FOREIGN KEY (`intEventGolferID`) REFERENCES `TEventGolfers` (`intEventGolferID`) ON DELETE CASCADE;

--
-- Constraints for table `TEventGolferTeamandClubs`
--
ALTER TABLE `TEventGolferTeamandClubs`
  ADD CONSTRAINT `teventgolferteamandclubs_ibfk_1` FOREIGN KEY (`intTeamandClubID`) REFERENCES `TTeamandClubs` (`intTeamandClubID`) ON DELETE CASCADE,
  ADD CONSTRAINT `teventgolferteamandclubs_ibfk_2` FOREIGN KEY (`intEventGolferID`) REFERENCES `TEventGolfers` (`intEventGolferID`) ON DELETE CASCADE;

--
-- Constraints for table `TGolfers`
--
ALTER TABLE `TGolfers`
  ADD CONSTRAINT `tgolfers_ibfk_1` FOREIGN KEY (`intStateID`) REFERENCES `TStates` (`intStateID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tgolfers_ibfk_2` FOREIGN KEY (`intGenderID`) REFERENCES `TGenders` (`intGenderID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tgolfers_ibfk_3` FOREIGN KEY (`intShirtSizeID`) REFERENCES `TShirtSizes` (`intShirtSizeID`) ON DELETE CASCADE;

--
-- Constraints for table `TSponsors`
--
ALTER TABLE `TSponsors`
  ADD CONSTRAINT `tsponsors_ibfk_1` FOREIGN KEY (`intStateID`) REFERENCES `TStates` (`intStateID`) ON DELETE CASCADE;

--
-- Constraints for table `TTeamandClubs`
--
ALTER TABLE `TTeamandClubs`
  ADD CONSTRAINT `tteamandclubs_ibfk_1` FOREIGN KEY (`intTypeofTeamID`) REFERENCES `TTypeofTeams` (`intTypeofTeamID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tteamandclubs_ibfk_2` FOREIGN KEY (`intLevelofTeamID`) REFERENCES `TLevelofTeams` (`intLevelofTeamID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tteamandclubs_ibfk_3` FOREIGN KEY (`intGenderofTeamID`) REFERENCES `TGenders` (`intGenderID`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
