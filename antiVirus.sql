-- AntiVirus Database

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00"; 

-- Table of approved Users
CREATE TABLE approvedUsers (
    user_id UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    firstName VarChar(30) NOT NULL,
    lastName VarChar(30) NOT NULL,
    email VarChar(30) NOT NULL, 
    userName VarChar(30) NOT NULL, 
    secretPas VarChar(30) NOT NULL,
    accessTier VarChar(30) NOT NULL,
    lastChange TIMESTAMP,
    dateRegistered TIMESTAMP  
); 

-- Table of Known Malware from the Userinput 
CREATE TABLE knownMalware(
	mal_id UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	nameOfMalware VarChar(40) NOT NULL, 
	-- Not sure what type signature needs to be
	malSignature VarChar(40) NOT NULL,
	dateKnown TIMESTAMP
);

CREATE TABLE submissionQuery(
	submit_id UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	nameOfRequest VarChar(40) NOT NULL,
	signature VarChar(40) NOT NULL, 
	submissionFrom VarChar(40) NOT NULL, 
	submissionDate TIMESTAMP
);


-- Example Inputs
INSERT INTO  `knownMalware`(`mal_id`, `nameOfMalware`, `malSignature`, `dateKnown`)
VALUES (1, 'mal1', 'aa;dkfanl;dfa', '2017-11-2 11:20:17'), (2, 'storm', 'aknd;faklnd;fakakld;', '2017-10-3 10:20:12'), (3, 'incensePanda', 'pandaa', '2017-12-3 1:22:12');

INSERT INTO `approvedUsers` (`user_id`, `firstName`, `lastName`, `email`, `userName`, `secretPas`, `accessTier`, `lastChange`, `dateRegistered`) 
VALUES (NULL, 'tester', 'test', 'tester@sjsu.edu', 'ThisIsATester', 'SupercaliFrag', 'user', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);