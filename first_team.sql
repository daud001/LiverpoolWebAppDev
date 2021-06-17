SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE IF NOT EXISTS `first_team` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `PlayerName` text NOT NULL,
  `PlayerNumber` int(2) NOT NULL,
  `Position` varchar(15) NOT NULL,
  `Age` int(3) NOT NULL,
  `Nationality` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `first_team` (`ID`, `PlayerName`, `PlayerNumber`, `Position`, `Age`, `Nationality`) VALUES
(1, 'Alisson Becker', 1, 'Goalkeeper', 28, 'Brazil'),
(2, 'Trent Alexander-Arnold', 66, 'Defender', 22, 'England'),
(3, 'Virgil van Dijk', 4, 'Defender', 29, 'Netherlands'),
(4, 'Joel Matip', 32, 'Defender', 29, 'Germany'),
(5, 'Ozan Kabak', 19, 'Defender', 20, 'Turkey'),
(6, 'Andy Robertson', 26, 'Defender', 27, 'Scotland'),
(7, 'Fabinho', 3, 'Midfielder', 27, 'Brazil'),
(8, 'Georginio Wijnaldum', 5, 'Midfielder', 30, 'Netherlands'),
(9, 'Jordan Henderson', 14, 'Midfielder', 30, 'England'),
(10, 'Sadio Mane', 10, 'Attacker', 28, 'Senegal'),
(11, 'Mohamed Salah', 11, 'Attacker', 28, 'Egypt'),
(12, 'Roberto Firmino', 9, 'Attacker', 29, 'Brazil'),
(13, 'James Milner', 7, 'Midfielder', 35, 'England');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
