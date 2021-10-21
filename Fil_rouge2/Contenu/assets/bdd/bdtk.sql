-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 21 oct. 2021 à 09:38
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdtk`
--

DELIMITER $$
--
-- Procédures (FLAVIE)
--
DROP PROCEDURE IF EXISTS `prcAddBd`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `prcAddBd` (IN `newisbn` BIGINT(13), IN `title` VARCHAR(50), IN `num` CHAR(3), IN `price` DECIMAL(4,2), IN `newresume` VARCHAR(1500), IN `image` VARCHAR(100), IN `miniImage` VARCHAR(100), IN `newserie` INT, IN `newauthor` INT)  BEGIN
	INSERT INTO album VALUES (newisbn, title, num, price, newresume, image, miniImage, newserie, newauthor);
END$$

DROP PROCEDURE IF EXISTS `prcDeleteBd`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `prcDeleteBd` (IN `id` BIGINT(13))  BEGIN
DELETE FROM album WHERE isbn = id;
END$$

DROP PROCEDURE IF EXISTS `prcSearchAuthor`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `prcSearchAuthor` (IN `author` VARCHAR(50))  BEGIN
SELECT Titre_album, ISBN, Nom_serie, Nom_auteur FROM `album` al
        JOIN `auteur` au ON al.idAuteur = au.idAuteur 
        JOIN `serie` s ON al.idSerie = s.idSerie WHERE `Nom_auteur` LIKE CONCAT('%', author, '%');
END$$

DROP PROCEDURE IF EXISTS `prcSearchSerie`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `prcSearchSerie` (IN `serie` VARCHAR(100))  BEGIN
SELECT Titre_album, ISBN, Nom_serie, Nom_auteur FROM `album` al
        JOIN `auteur` au ON al.idAuteur = au.idAuteur 
        JOIN `serie` s ON al.idSerie = s.idSerie WHERE `Nom_serie` LIKE CONCAT('%', serie, '%');
END$$

DROP PROCEDURE IF EXISTS `prcSearchTitle`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `prcSearchTitle` (IN `title` VARCHAR(100))  BEGIN 
SELECT Titre_album, ISBN, Nom_serie, Nom_auteur FROM `album` al
            JOIN `auteur` au ON al.idAuteur = au.idAuteur 
            JOIN `serie` s ON al.idSerie = s.idSerie WHERE `Titre_album` LIKE CONCAT("%", title, "%");
END$$

DROP PROCEDURE IF EXISTS `prcUpdateBd`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `prcUpdateBd` (IN `title` VARCHAR(50), `num` CHAR(3), `price` DECIMAL(4,2), `newresume` VARCHAR(1500), `newserie` INT, `newauthor` INT, `image` VARCHAR(100), `miniImage` VARCHAR(100), `id` BIGINT(13))  BEGIN
UPDATE `album` SET `Titre_album` = title, 
                            `Numero_album` = num, `Prix` = price, 
                            `Resume` = newresume, `idSerie` = newserie, `idAuteur` = newauthor, `ID_image` = image, 
                            `Id_mini_image` = miniImage
                            WHERE `ISBN` = id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `album`
--

DROP TABLE IF EXISTS `album`;
CREATE TABLE IF NOT EXISTS `album` (
  `ISBN` bigint(13) NOT NULL,
  `Titre_album` varchar(50) NOT NULL,
  `Numero_album` char(3) NOT NULL,
  `Prix` decimal(4,2) NOT NULL,
  `Resume` varchar(1500) DEFAULT NULL,
  `ID_image` varchar(100) DEFAULT NULL,
  `Id_mini_image` varchar(100) DEFAULT NULL,
  `idSerie` int(11) NOT NULL,
  `idAuteur` int(11) NOT NULL,
  PRIMARY KEY (`ISBN`),
  KEY `idSerie` (`idSerie`),
  KEY `_Album__Auteur1_FK` (`idAuteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `album`
--

INSERT INTO `album` (`ISBN`, `Titre_album`, `Numero_album`, `Prix`, `Resume`, `ID_image`, `Id_mini_image`, `idSerie`, `idAuteur`) VALUES
(9780312429621, 'Fordlandia', '6', '9.98', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Marsupilami-06-Fordlandia.jpg', 'Marsupilami-06-Fordlandia.jpg', 6, 11),
(9781849183635, 'Le bébé du bout du monde', '2', '11.33', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Marsupilami-02-Le bébé du bout du monde.jpg', 'Marsupilami-02-Le bébé du bout du monde.jpg', 6, 12),
(9781849185424, 'Baby Prinz', '5', '11.00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Marsupilami-05-Baby Prinz.jpg', 'Marsupilami-05-Baby Prinz.jpg', 6, 11),
(9782012788114, 'A Moscou', '42', '10.95', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Spirou et Fantasio-42-A Moscou.jpg', 'Spirou et Fantasio-42-A Moscou.jpg', 2, 6),
(9782205086881, '(Avant la quête) L\'ami Javin', 'A01', '14.10', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'La quête de loiseau du temps-A01-(Avant la quête) Lami Javin.jpg', 'La quête de loiseau du temps-A01-(Avant la quête) Lami Javin.jpg', 22, 8),
(9782302001534, 'Le Waltras', '7', '15.20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Marlysa-07-Le Waltras.jpg', 'Marlysa-07-Le Waltras.jpg', 13, 1),
(9782302011021, 'La guerre des gloutons (II)', '13', '14.50', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Trolls de Troy-13-La guerre des gloutons (II).jpg', 'Trolls de Troy-13-La guerre des gloutons (II).jpg', 16, 4),
(9782302026841, 'La bête fabuleuse', '8', '14.50', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lanfeust de Troy-08-La bête fabuleuse.jpg', 'Lanfeust de Troy-08-La bête fabuleuse.jpg', 9, 3),
(9782302028661, 'Le sang des comètes', '8', '14.50', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lanfeust des étoiles-08-Le sang des comètes.jpg', 'Lanfeust des étoiles-08-Le sang des comètes.jpg', 18, 3),
(9782354260354, 'Croc vert', '23', '24.50', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Marsupilami-23-Croc vert.jpg', 'Marsupilami-23-Croc vert.jpg', 6, 5),
(9782354260866, 'Mars le noir', '3', '12.20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Marsupilami-03-Mars le noir.jpg', 'Marsupilami-03-Mars le noir.jpg', 6, 11),
(9782505067665, 'Le jour du Mayflower', '20', '12.00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'XIII-20-Le jour du Mayflower.jpg', 'XIII-20-Le jour du Mayflower.jpg', 10, 7),
(9782723434249, 'La loi du préau', '9', '10.50', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Titeuf-09-La loi du préau.jpg', 'Titeuf-09-La loi du préau.jpg', 23, 9),
(9782723454834, 'Mes meilleurs copains', '11', '11.00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Titeuf-11-Mes meilleurs copains.jpg', 'Titeuf-11-Mes meilleurs copains.jpg', 23, 9),
(9782800146225, 'Le rayon noir', '44', '9.98', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Spirou et Fantasio-44-Le rayon noir.jpg', 'Spirou et Fantasio-44-Le rayon noir.jpg', 2, 6),
(9782845650046, 'La griffe de Rome', '3', '14.50', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Le chant dexcalibur-03-La griffe de Rome.jpg', 'Le chant dexcalibur-03-La griffe de Rome.jpg', 17, 2),
(9782869678538, 'Les runes de Gartagueul', '1', '14.20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Kran-01-Les runes de Gartagueul.jpg', 'Kran-01-Les runes de Gartagueul.jpg', 24, 10),
(9782869678941, 'Le Walou Walou ancestral', '2', '13.90', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Kran-02-Le Walou Walou ancestral.jpg', 'Kran-02-Le Walou Walou ancestral.jpg', 24, 10),
(9782869679290, 'Gare aux garous', '3', '11.40', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Kran-03-Gare aux garous.jpg', 'Kran-03-Gare aux garous.jpg', 24, 10),
(9782908462470, 'L\'or de Boavista', '7', '12.00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Marsupilami-07-Lor de Boavista.jpg', 'Marsupilami-07-Lor de Boavista.jpg', 6, 11),
(9782908462555, 'Le temple de Boavista', '8', '10.95', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Marsupilami-08-Le temple de Boavista.jpg', 'Marsupilami-08-Le temple de Boavista.jpg', 6, 11),
(9782912536457, 'Capturez un Marsupilami !', '0', '10.54', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Marsupilami-00-Capturez un Marsupilami .jpg', 'Marsupilami-00-Capturez un Marsupilami .jpg', 6, 13),
(9783551733498, 'Nadia se marie', '10', '12.50', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Titeuf-10-Nadia se marie.jpg', 'Titeuf-10-Nadia se marie.jpg', 23, 9),
(9783551799159, 'Le pollen du monte Urticando', '4', '10.25', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Marsupilami-04-Le pollen du monte Urticando.jpg', 'Marsupilami-04-Le pollen du monte Urticando.jpg', 6, 11),
(9788434509580, 'La queue du Marsupilami', '1', '10.47', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Marsupilami-01-La queue du Marsupilami.jpg', 'Marsupilami-01-La queue du Marsupilami.jpg', 6, 12),
(9788447803866, 'Luna fatale', '45', '10.00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Spirou et Fantasio-45-Luna fatale.jpg', 'Spirou et Fantasio-45-Luna fatale.jpg', 2, 6),
(9788471092175, 'Le sens de la vie', '12', '10.50', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Titeuf-12-Le sens de la vie.jpg', 'Titeuf-12-Le sens de la vie.jpg', 23, 9),
(9791034709168, 'La vallée des bannis', '41', '11.50', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Spirou et Fantasio-41-La vallée des bannis.jpg', 'Spirou et Fantasio-41-La vallée des bannis.jpg', 2, 6),
(9791034709182, 'Vito la déveine', '43', '10.42', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Spirou et Fantasio-43-Vito la déveine.jpg', 'Spirou et Fantasio-43-Vito la déveine.jpg', 2, 6),
(9791034709212, 'Machine qui rêve', '46', '23.50', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Spirou et Fantasio-46-Machine qui rêve.jpg', 'Spirou et Fantasio-46-Machine qui rêve.jpg', 2, 6);

--
-- Déclencheurs `album` (FLAVIE)
--
DROP TRIGGER IF EXISTS `avant_delete_BD`;
DELIMITER $$
CREATE TRIGGER `avant_delete_BD` BEFORE DELETE ON `album` FOR EACH ROW BEGIN
 DECLARE finished INT DEFAULT 0;
 DECLARE exp VARCHAR(17);
 DECLARE exemplaires CURSOR FOR
 	SELECT id_exemplaire
    FROM exemplaire 
    where isbn = old.isbn;
 DECLARE CONTINUE HANDLER 
 FOR NOT FOUND SET finished = 1;
 IF (OLD.isbn IN (SELECT isbn FROM exemplaire)) THEN
	OPEN exemplaires;
getExemplaire:LOOP
    FETCH exemplaires into exp;
    IF finished = 1 THEN 
		LEAVE getExemplaire;
	END IF;
	IF (exp IN(SELECT id_exemplaire FROM emprunt) AND (SELECT date_retour from emprunt WHERE id_exemplaire = exp) IS NULL) THEN
    	SIGNAL SQLSTATE '45000'
    	SET MESSAGE_TEXT = "emprunt en cours",
    	MYSQL_ERRNO = 2008;
    END IF;
END LOOP;
CLOSE exemplaires;
END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `avant_insert_BD`;
DELIMITER $$
CREATE TRIGGER `avant_insert_BD` BEFORE INSERT ON `album` FOR EACH ROW BEGIN
IF (NEW.isbn IN (SELECT isbn FROM album)) THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'ISBN déjà existant',
    MYSQL_ERRNO = 2004;
END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `avant_update_BD`;
DELIMITER $$
CREATE TRIGGER `avant_update_BD` BEFORE UPDATE ON `album` FOR EACH ROW BEGIN
IF (NEW.idAuteur NOT IN(SELECT idAuteur FROM auteur)) THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Auteur inexistant',
    MYSQL_ERRNO = 2005;
ELSEIF (NEW.idSerie NOT IN(SELECT idSerie FROM serie)) THEN
	SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Série inexistante',
    MYSQL_ERRNO = 2006;
ELSEIF (NEW.Numero_album IN(SELECT Numero_album FROM album WHERE idSerie = NEW.idSerie AND isbn <> NEW.isbn)) THEN
	SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Doublon tome',
    MYSQL_ERRNO = 2009;
ELSEIF (NEW.Titre_album IN(SELECT Titre_album FROM album WHERE idSerie = NEW.idSerie AND isbn <> NEW.isbn)) THEN
	SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Doublon titre',
    MYSQL_ERRNO = 2010;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `amendes` 
--

DROP TABLE IF EXISTS `amendes`;
CREATE TABLE IF NOT EXISTS `amendes` (
  `ID_Amende` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `Tarif_base` decimal(4,2) NOT NULL,
  PRIMARY KEY (`ID_Amende`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `amendes`
--

INSERT INTO `amendes` (`ID_Amende`, `label`, `Tarif_base`) VALUES
(1, 'Retard', '0.50'),
(2, 'Perte', '10.00');

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE IF NOT EXISTS `auteur` (
  `idAuteur` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_auteur` varchar(50) NOT NULL,
  PRIMARY KEY (`idAuteur`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`idAuteur`, `Nom_auteur`) VALUES
(1, 'Gaudin, Danard'),
(2, 'Arleston, Hubsch'),
(3, 'Arleston, Tarquin'),
(4, 'Arleston, Mourier'),
(5, 'Franquin, Batem, Colman'),
(6, 'Tome, Janry'),
(7, 'Jigounov, Sente'),
(8, 'Le Tendre, Loisel, Lidwine'),
(9, 'Zep'),
(10, 'Herenguel Eric'),
(11, 'Franquin, Batem, Yann'),
(12, 'Franquin, Batem, Greg'),
(13, 'Franquin'),
(14, 'Reynès, Brémaud, Krings'),
(15, 'Fournier'),
(16, 'Franquin, Roba, Greg'),
(17, 'Franquin, Greg'),
(18, 'Franquin, Roba'),
(19, 'Achdé, Erroc'),
(20, 'Ptiluc'),
(21, 'Hergé'),
(22, 'Watch, J.C De la royère'),
(23, 'Derib, Job'),
(24, 'Bercovici, Corteggiani'),
(25, 'Goscinny, Uderzo'),
(26, 'Rocher, Dufranne'),
(27, 'Bercovici, Cauvin'),
(28, 'Jung'),
(29, 'Loisel'),
(30, 'Lecureux, Cheret'),
(31, 'Peyo'),
(32, 'Morris'),
(33, 'Morris, Goscinny'),
(34, 'Morris, Fauche, Léturgie'),
(35, 'Morris, Achdé, Gerra'),
(36, 'Diaz canales, Guarnido'),
(37, 'Franquin, Batem, Dugomier'),
(38, 'Franquin, Batem, Bourcquardez'),
(39, 'Franquin, Batem, Kaminka'),
(40, 'Franquin, Batem'),
(41, 'Franquin, Batem, Fauche'),
(42, 'Franquin, Jidéhem, Greg'),
(43, 'Franquin, Jijé'),
(44, 'Le Tendre, Loisel, Mallié'),
(45, 'Le Tendre, Loisel, Aouamri'),
(46, 'Le Tendre, Loisel'),
(47, 'Arleston, Dav, Tarquin, Lyse'),
(48, 'Arnaud, Stambecco'),
(49, 'Godard, Bollée, Al Coutelis'),
(50, 'Mangin, Gajic'),
(51, 'Morvan, Munuera'),
(52, 'Nic, Cauvin'),
(53, 'Yoann, Vehlmann'),
(54, 'Morvan, Yann, Munuera'),
(55, 'Franquin, Wilbur, Conrad'),
(56, 'Geluck'),
(57, 'Astier, Dupré'),
(58, 'Rosinski, Van Hamme'),
(59, 'Coyote'),
(60, 'Bar'),
(61, 'Fane'),
(62, 'Jenfèvre, Perna'),
(63, 'Arleston, Hubsch, Lebreton'),
(64, 'Gaudin, Danard, Fuentes'),
(65, 'Arleston, Tota'),
(66, 'Francq, Van Hamme'),
(67, 'Marcello, Maric'),
(68, 'Cauvin, Hardy'),
(69, 'De Groot, Turk'),
(70, 'Rodolphe, Rouge'),
(71, 'Rodolphe, Allot'),
(72, 'Tybo, Goupil'),
(73, 'Tolkien'),
(74, 'Li, Danverre'),
(75, 'Kubert'),
(76, 'Warnant'),
(77, 'Gazzotti'),
(78, 'Reynès, Brrémaud, Toulon'),
(79, 'Servais'),
(80, 'Font'),
(81, 'Charlier, Giraud'),
(82, 'Crisse, Keramidas'),
(83, 'Arleston, Floch'),
(84, 'Bourjac, Gadioux'),
(85, 'Franquin, Jidéhem'),
(86, 'Franquin, Jidéhem, Delporte'),
(87, 'Chaland'),
(88, 'Corbeyran, Guerineau, Merlet'),
(89, 'Corbeyran, Guerineau'),
(90, 'Jacobs'),
(91, 'Vance, Van Hamme'),
(92, 'Giraud, Van Hamme'),
(93, 'Aleston, Tota, Lamirand'),
(94, 'Arleston, Hubsch, MelanÃ¿n'),
(95, 'Gaudin, Danard, Guillo'),
(96, 'Delaf, Dubuc'),
(97, 'Roulot, Martinage'),
(98, 'Laudec, Cauvin'),
(99, 'Matt, Groening'),
(100, 'Midam'),
(101, 'Beka, Poupard'),
(102, 'Godi, Fidrou'),
(103, 'Davis'),
(104, 'Djian, Legrand, Etien'),
(105, 'Convard, Falque'),
(106, 'Sobral'),
(107, 'Gaby, Dzack'),
(108, 'Richez, Cazenove, Bloz'),
(109, 'Clarke, Gilson'),
(110, 'Roba'),
(111, 'Roba'),
(112, 'Domon'),
(113, 'Gursel'),
(114, 'Djian, Corbet'),
(115, 'Miniac'),
(116, 'Coppée'),
(117, 'Veys, Toulon, Guenard'),
(118, 'Midam, Adam'),
(119, 'Achdé, Pennac'),
(120, 'Vrancken, Desberg'),
(121, 'Dubois, Fourquemin'),
(122, 'Lang, Poinsot'),
(123, 'Dufaux, Aubin, Schréder'),
(124, 'Achdé'),
(125, 'Istin, Duarte, Saito'),
(126, 'Bar, Fane'),
(127, 'Funcken'),
(128, 'Luz'),
(129, 'Nerac, Djian, Teron, Kangaro'),
(130, 'Desberg, Lalor'),
(131, 'Nob'),
(132, 'Barjam'),
(133, 'Francq, Giaconetti'),
(134, 'Le Tendre, Loisel, Etien'),
(135, '60 auteurs');

-- --------------------------------------------------------

--
-- Structure de la table `bibliotheque`
--

DROP TABLE IF EXISTS `bibliotheque`;
CREATE TABLE IF NOT EXISTS `bibliotheque` (
  `idBibli` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_bibli` varchar(50) NOT NULL,
  PRIMARY KEY (`idBibli`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bibliotheque`
--

INSERT INTO `bibliotheque` (`idBibli`, `Nom_bibli`) VALUES
(1, 'Alexis de Tocqueville'),
(2, 'Chemin-vert'),
(3, 'Folie-CouvreChef'),
(4, 'Grâce-de-Dieu'),
(5, 'Guérinière'),
(6, 'Maladrerie');

-- --------------------------------------------------------

--
-- Structure de la table `emplacement`
--

DROP TABLE IF EXISTS `emplacement`;
CREATE TABLE IF NOT EXISTS `emplacement` (
  `idEmplacement` int(11) NOT NULL AUTO_INCREMENT,
  `Code_emplacement` char(3) NOT NULL,
  `idBibli` int(11) NOT NULL,
  PRIMARY KEY (`idEmplacement`),
  KEY `_Emplacement__Bibliotheque1_FK` (`idBibli`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `emplacement`
--

INSERT INTO `emplacement` (`idEmplacement`, `Code_emplacement`, `idBibli`) VALUES
(11, 'E00', 1),
(12, 'E01', 1),
(13, 'E02', 1),
(14, 'E03', 1),
(15, 'E04', 1),
(16, 'E01', 2),
(17, 'E02', 2),
(18, 'E03', 2),
(19, 'E04', 2),
(20, 'E05', 2),
(21, 'E06', 2),
(22, 'E01', 3),
(23, 'E02', 3),
(24, 'E03', 3),
(25, 'E01', 4),
(26, 'E02', 4),
(27, 'E03', 4),
(28, 'E04', 4),
(29, 'E05', 4),
(30, 'E01', 5),
(31, 'E02', 5),
(32, 'E03', 5),
(33, 'E04', 5),
(34, 'E05', 5),
(35, 'E06', 5),
(36, 'E01', 6),
(37, 'E02', 6),
(38, 'E03', 6),
(39, 'E04', 6),
(40, 'E05', 6),
(41, 'E05', 1),
(42, 'E06', 1),
(43, 'E07', 1),
(44, 'E08', 1),
(45, 'E09', 1),
(46, 'E00', 2),
(47, 'E07', 2),
(48, 'E08', 2),
(49, 'E09', 2),
(50, 'E00', 3);

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

DROP TABLE IF EXISTS `emprunt`;
CREATE TABLE IF NOT EXISTS `emprunt` (
  `id_emprunt` int(6) NOT NULL AUTO_INCREMENT,
  `Date_emprunt` date NOT NULL,
  `Date_retour` date DEFAULT NULL,
  `id_user` bigint(10) UNSIGNED ZEROFILL NOT NULL,
  `ID_exemplaire` varchar(17) NOT NULL,
  PRIMARY KEY (`id_emprunt`),
  KEY `_Emprunt__User_FK` (`id_user`),
  KEY `Emprunt_Exemplaire_FK` (`ID_exemplaire`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `emprunt`
--

INSERT INTO `emprunt` (`id_emprunt`, `Date_emprunt`, `Date_retour`, `id_user`, `ID_exemplaire`) VALUES
(1, '2021-09-17', NULL, 1336977764, '9780312429621_1'),
(2, '2021-10-20', NULL, 4126127561, '9780312429621_2'),
(3, '2021-10-20', NULL, 0436342955, '9791034709212_1'),
(4, '2021-10-20', NULL, 0436342955, '9791034709182_1'),
(5, '2021-10-20', NULL, 0436342955, '9791034709168_1'),
(6, '2021-10-20', NULL, 0218924837, '9782354260354_5'),
(7, '2021-10-20', NULL, 3378180016, '9781849185424_3'),
(8, '2021-10-20', NULL, 1526943621, '9781849185424_2'),
(9, '2021-10-20', NULL, 4223351145, '9781849185424_5'),
(10, '2021-10-20', NULL, 4238885261, '9782302011021_4'),
(11, '2021-10-21', NULL, 5772151915, '9782354260354_1'),
(12, '2021-10-21', NULL, 5772151915, '9781849183635_1'),
(13, '2021-10-21', NULL, 6213494418, '9782908462470_1'),
(14, '2021-10-21', NULL, 8735962639, '9782908462555_1'),
(15, '2021-10-21', NULL, 8735962639, '9782912536457_1');

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

DROP TABLE IF EXISTS `etat`;
CREATE TABLE IF NOT EXISTS `etat` (
  `idEtat` tinyint(1) UNSIGNED NOT NULL,
  `Label etat` varchar(10) NOT NULL,
  PRIMARY KEY (`idEtat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`idEtat`, `Label etat`) VALUES
(0, 'Neuf'),
(1, 'Abîmé'),
(2, 'Détruit');

-- --------------------------------------------------------

--
-- Structure de la table `exemplaire`
--

DROP TABLE IF EXISTS `exemplaire`;
CREATE TABLE IF NOT EXISTS `exemplaire` (
  `ID_exemplaire` varchar(17) NOT NULL,
  `Date_entree_exemplaire` date NOT NULL,
  `Commentaire` varchar(500) NOT NULL,
  `idEmplacement` int(11) DEFAULT NULL,
  `Statut` tinyint(1) NOT NULL,
  `idEtat` tinyint(1) UNSIGNED NOT NULL,
  `ISBN` bigint(13) NOT NULL,
  PRIMARY KEY (`ID_exemplaire`),
  KEY `_Exemplaire__Etat2_FK` (`idEtat`),
  KEY `_Exemplaire__Album3_FK` (`ISBN`),
  KEY `_Exemplaire__Emplacement0_AK` (`idEmplacement`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `exemplaire`
--

INSERT INTO `exemplaire` (`ID_exemplaire`, `Date_entree_exemplaire`, `Commentaire`, `idEmplacement`, `Statut`, `idEtat`, `ISBN`) VALUES
('9780312429621_1', '2016-11-23', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 12, 0, 1, 9780312429621),
('9780312429621_2', '2017-01-27', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 17, 0, 0, 9780312429621),
('9781849183635_1', '2021-07-26', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 12, 0, 0, 9781849183635),
('9781849183635_2', '2006-03-28', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 17, 0, 1, 9781849183635),
('9781849183635_3', '2006-10-27', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 23, 0, 0, 9781849183635),
('9781849183635_4', '2007-12-13', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 26, 0, 1, 9781849183635),
('9781849185424_1', '2017-04-21', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 12, 0, 1, 9781849185424),
('9781849185424_2', '2017-05-26', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 17, 0, 0, 9781849185424),
('9781849185424_3', '2017-09-19', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 23, 0, 0, 9781849185424),
('9781849185424_4', '2018-02-07', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 26, 0, 0, 9781849185424),
('9781849185424_5', '2021-10-20', 'Neque porro quisquam est qui dolorem ipsum quia do...', 37, 0, 1, 9781849185424),
('9782012788114_1', '2014-08-07', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 11, 0, 1, 9782012788114),
('9782012788114_2', '2015-04-13', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 16, 1, 1, 9782012788114),
('9782205086881_1', '2019-09-11', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 1, 9782205086881),
('9782205086881_2', '2020-10-06', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 0, 9782205086881),
('9782302001534_1', '2014-01-17', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 15, 0, 0, 9782302001534),
('9782302001534_2', '2014-02-13', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 19, 0, 1, 9782302001534),
('9782302001534_3', '2014-08-15', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 22, 0, 1, 9782302001534),
('9782302001534_4', '2015-06-22', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 0, 9782302001534),
('9782302011021_1', '2007-07-26', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 20, 0, 0, 9782302011021),
('9782302011021_2', '2008-04-18', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 29, 0, 0, 9782302011021),
('9782302011021_3', '2008-06-02', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 34, 0, 1, 9782302011021),
('9782302011021_4', '2009-02-17', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 40, 0, 1, 9782302011021),
('9782302011021_5', '2009-10-15', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 20, 0, 0, 9782302011021),
('9782302011021_6', '2010-02-05', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 29, 0, 1, 9782302011021),
('9782302026841_1', '2018-06-21', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 13, 0, 1, 9782302026841),
('9782302028661_1', '2017-01-26', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 1, 1, 9782302028661),
('9782302028661_2', '2017-02-07', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 1, 9782302028661),
('9782302028661_3', '2018-06-12', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 0, 9782302028661),
('9782354260354_1', '2020-02-19', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 12, 0, 0, 9782354260354),
('9782354260354_2', '2021-03-25', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 17, 0, 0, 9782354260354),
('9782354260354_3', '2019-12-03', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 23, 1, 1, 9782354260354),
('9782354260354_4', '2005-10-04', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 26, 0, 0, 9782354260354),
('9782354260354_5', '2007-01-23', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 31, 0, 0, 9782354260354),
('9782354260866_1', '2021-01-18', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 12, 0, 0, 9782354260866),
('9782354260866_2', '2021-05-17', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 17, 0, 1, 9782354260866),
('9782505067665_1', '2010-02-16', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 14, 0, 1, 9782505067665),
('9782505067665_2', '2011-02-04', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 18, 0, 0, 9782505067665),
('9782723434249_1', '2012-01-24', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 0, 9782723434249),
('9782723434249_2', '2012-08-20', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 1, 9782723434249),
('9782723434249_3', '2012-11-19', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 1, 9782723434249),
('9782723434249_4', '2013-01-01', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 0, 9782723434249),
('9782723434249_5', '2013-01-03', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 1, 9782723434249),
('9782723434249_6', '2013-04-09', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 1, 9782723434249),
('9782723434249_7', '2014-10-08', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 1, 1, 9782723434249),
('9782723434249_8', '2016-06-14', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 0, 9782723434249),
('9782723434249_9', '2016-07-04', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 1, 9782723434249),
('9782723454834_1', '2008-05-21', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 1, 9782723454834),
('9782800146225_1', '2011-05-12', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 11, 0, 1, 9782800146225),
('9782800146225_2', '2011-05-26', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 16, 0, 0, 9782800146225),
('9782800146225_3', '2011-12-22', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 22, 0, 1, 9782800146225),
('9782845650046_1', '2011-11-10', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 21, 0, 1, 9782845650046),
('9782845650046_2', '2011-11-23', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 35, 0, 1, 9782845650046),
('9782845650046_3', '2013-04-04', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 1, 9782845650046),
('9782869678538_1', '2010-06-30', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 1, 9782869678538),
('9782869678538_2', '2012-04-20', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 1, 0, 9782869678538),
('9782869678941_1', '2008-02-14', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 1, 9782869678941),
('9782869679290_1', '2018-01-18', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 1, 9782869679290),
('9782869679290_2', '2018-06-20', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 0, 9782869679290),
('9782869679290_3', '2020-01-14', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 0, 9782869679290),
('9782869679290_4', '2020-12-16', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 0, 9782869679290),
('9782869679290_5', '2021-04-13', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 1, 9782869679290),
('9782869679290_6', '2021-09-03', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 0, 9782869679290),
('9782869679290_7', '2006-02-22', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 1, 9782869679290),
('9782869679290_8', '2006-03-03', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 1, 9782869679290),
('9782869679290_9', '2007-03-06', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 1, 9782869679290),
('9782908462470_1', '2014-02-11', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 12, 0, 1, 9782908462470),
('9782908462470_2', '2014-12-24', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 17, 0, 0, 9782908462470),
('9782908462470_3', '2016-04-25', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 23, 0, 1, 9782908462470),
('9782908462555_1', '2012-11-30', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 12, 0, 1, 9782908462555),
('9782912536457_1', '2010-02-11', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 12, 0, 0, 9782912536457),
('9782912536457_2', '2010-11-02', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 17, 0, 1, 9782912536457),
('9782912536457_3', '2010-11-25', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 23, 0, 1, 9782912536457),
('9783551733498_1', '2008-07-28', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 1, 9783551733498),
('9783551733498_2', '2008-08-21', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 1, 0, 9783551733498),
('9783551733498_3', '2010-01-22', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 1, 9783551733498),
('9783551733498_4', '2010-03-19', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 0, 9783551733498),
('9783551733498_5', '2010-11-11', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 1, 9783551733498),
('9783551733498_6', '2011-06-01', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 0, 9783551733498),
('9783551733498_7', '2011-07-22', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 1, 9783551733498),
('9783551799159_1', '2018-08-15', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 12, 0, 1, 9783551799159),
('9783551799159_2', '2019-06-05', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 17, 0, 0, 9783551799159),
('9783551799159_3', '2019-06-11', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 23, 0, 0, 9783551799159),
('9783551799159_4', '2020-05-01', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 26, 0, 0, 9783551799159),
('9783551799159_5', '2020-06-17', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 31, 0, 0, 9783551799159),
('9788434509580_1', '2008-01-11', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 12, 0, 1, 9788434509580),
('9788434509580_2', '2008-03-05', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 17, 0, 0, 9788434509580),
('9788434509580_3', '2008-04-14', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 23, 0, 1, 9788434509580),
('9788434509580_4', '2008-05-12', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 26, 0, 1, 9788434509580),
('9788434509580_5', '2008-07-09', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 31, 1, 0, 9788434509580),
('9788434509580_6', '2009-05-08', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 37, 0, 1, 9788434509580),
('9788434509580_7', '2009-06-17', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 12, 0, 1, 9788434509580),
('9788447803866_1', '2014-07-07', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 11, 0, 1, 9788447803866),
('9788471092175_1', '2021-05-21', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 1, 9788471092175),
('9788471092175_2', '2005-09-23', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 1, 9788471092175),
('9788471092175_3', '2005-10-21', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', NULL, 0, 0, 9788471092175),
('9791034709168_1', '2019-12-25', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 11, 0, 0, 9791034709168),
('9791034709182_1', '2016-05-26', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 11, 0, 0, 9791034709182),
('9791034709182_2', '2017-05-19', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 16, 0, 1, 9791034709182),
('9791034709182_3', '2017-07-04', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 22, 0, 1, 9791034709182),
('9791034709182_4', '2019-10-15', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 25, 0, 1, 9791034709182),
('9791034709212_1', '2007-05-28', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 11, 0, 0, 9791034709212);

--
-- Déclencheurs `exemplaire` (FLAVIE)
--
DROP TRIGGER IF EXISTS `avant_delete_exemplaire`;
DELIMITER $$
CREATE TRIGGER `avant_delete_exemplaire` BEFORE DELETE ON `exemplaire` FOR EACH ROW BEGIN
	IF (OLD.id_exemplaire IN(SELECT id_exemplaire FROM emprunt) AND (SELECT date_retour from emprunt WHERE id_exemplaire = OLD.id_exemplaire) IS NULL) THEN
    	SIGNAL SQLSTATE '45000'
    	SET MESSAGE_TEXT = "emprunt en cours",
    	MYSQL_ERRNO = 2008;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `lettres`
--

DROP TABLE IF EXISTS `lettres`;
CREATE TABLE IF NOT EXISTS `lettres` (
  `ID_Lettre` int(4) NOT NULL,
  `Date_lettre` date NOT NULL,
  `id_emprunt` int(6) NOT NULL,
  PRIMARY KEY (`ID_Lettre`),
  KEY `_Lettres__Emprunt_FK` (`id_emprunt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `lettres`
--

INSERT INTO `lettres` (`ID_Lettre`, `Date_lettre`, `id_emprunt`) VALUES
(1, '2021-11-05', 1);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(1) NOT NULL,
  `Label_role` varchar(50) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `Label_role`) VALUES
(1, 'administrateur'),
(2, 'responsable'),
(3, 'bibliothécaire'),
(4, 'gestionnaire'),
(5, 'adhérent');

-- --------------------------------------------------------

--
-- Structure de la table `serie`
--

DROP TABLE IF EXISTS `serie`;
CREATE TABLE IF NOT EXISTS `serie` (
  `idSerie` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_serie` varchar(50) NOT NULL,
  PRIMARY KEY (`idSerie`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `serie`
--

INSERT INTO `serie` (`idSerie`, `Nom_serie`) VALUES
(2, 'Spirou et Fantasio'),
(3, 'Peter Pan'),
(5, 'Le petit Spirou'),
(6, 'Marsupilami'),
(9, 'Lanfeust de Troy'),
(10, 'XIII'),
(12, 'Largo Winch'),
(13, 'Marlysa'),
(16, 'Trolls de Troy'),
(17, 'Le chant d\'excalibur'),
(18, 'Lanfeust des étoiles'),
(22, 'La quête de l\'oiseau du temps'),
(23, 'Titeuf'),
(24, 'Kran'),
(25, 'Les informaticiens'),
(26, 'Les informaticiens'),
(27, 'C.R.S = Détresse'),
(28, 'Pacush blues'),
(29, 'Les aventures de Tintin'),
(30, 'Spirou'),
(31, 'Yakari'),
(32, 'Testar le robot'),
(33, 'Astérix'),
(34, 'Les aventures de Bédé'),
(35, 'Les femmes en blanc'),
(36, 'Kwaïdan'),
(37, 'Rahan fils des âges farouches'),
(38, 'Histoires de Schtroumpfs'),
(39, 'Lucky Luke'),
(40, 'Blacksad'),
(41, 'Gnomes de Troy'),
(42, 'Le petit Rahan'),
(43, 'Finn'),
(44, 'Le vagabond des limbes'),
(45, 'Le fléau des dieux'),
(46, 'Marsu kids'),
(47, 'Le chat'),
(48, 'Kaamelott'),
(49, 'Le grand pouvoir du Chninkel'),
(50, 'Litteul Kévin'),
(51, 'Joe bar team'),
(52, 'Les conquérants de Troy'),
(53, 'Cristal'),
(54, 'Pierre tombal'),
(55, 'Thorgal'),
(56, 'Léonard'),
(57, 'Les écluses du ciel'),
(58, 'Divers'),
(59, 'Métropoles'),
(60, 'Soda'),
(61, 'Lanfeust odyssey'),
(62, 'Le triangle secret I.N.R.I.'),
(63, 'Elle s\'appelle Taxi'),
(64, 'Blueberry'),
(65, 'Luuna'),
(66, 'Les naufragés d\'Ythaq'),
(67, 'Arkezone'),
(68, 'Gaston'),
(69, 'Le chant des Stryges'),
(70, 'Blake et Mortimer'),
(71, 'Goblin\'s'),
(72, 'Les nombrils'),
(73, 'Cédric'),
(74, 'Les simpson'),
(75, 'Kidpaddle'),
(76, 'Les rugbymen'),
(77, 'L\'élève ducobu'),
(78, 'Garfield'),
(79, 'Boule et bill'),
(80, 'Le triangle secret Les gardiens du sang'),
(81, 'Les quatre de baker street'),
(82, 'Le triangle secret'),
(83, 'Le triangle secret hertz'),
(84, 'Les légendaires'),
(85, 'Les blondes'),
(86, 'Les fondus'),
(87, 'Mélusine'),
(88, 'Koh-Lanta'),
(89, 'Les foot furieux'),
(90, 'Les grandes enquêtes des p\'tits philous'),
(91, 'Les blagues de Toto'),
(92, 'Le fayot'),
(93, 'toto'),
(94, 'Game over'),
(95, 'I.R.$.'),
(96, 'La légende du changeling'),
(97, 'Le donjon de Naheulbeuk'),
(98, 'Kid Lucky'),
(99, 'Le rédempteur'),
(100, 'Elfes'),
(101, 'Harald le viking'),
(102, 'Le triangle secret lacrima christi'),
(103, 'Private liberty'),
(104, 'Dad'),
(105, 'Universal war one');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` bigint(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `Nom_user` varchar(50) NOT NULL,
  `Prenom_user` varchar(50) NOT NULL,
  `MDP` varchar(50) NOT NULL,
  `Adresse_1_user` varchar(50) NOT NULL,
  `Adresse_2_user` varchar(50) DEFAULT NULL,
  `CP_user` varchar(5) NOT NULL,
  `Ville_user` varchar(50) NOT NULL,
  `Date_cotisation` date DEFAULT NULL,
  `id_role` int(1) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `MDP` (`MDP`),
  KEY `_User__Role_FK` (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=9724349550 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `Nom_user`, `Prenom_user`, `MDP`, `Adresse_1_user`, `Adresse_2_user`, `CP_user`, `Ville_user`, `Date_cotisation`, `id_role`) VALUES
(0218924837, 'Drax', 'Guillaume', 'sYfT!3$9', '29, avenue de Cohen', NULL, '14280', 'Saint-Germain-la-Blanche-Herbe', '2020-09-29', 5),
(0436342955, 'Ecu', 'Sandrine', '5$4Nr$Bx', '93, avenue Astrid Jacques', NULL, '14000', 'Caen', '2021-08-24', 5),
(1336977764, 'Lupine', 'Amélie', '89$QIgt?', '22, impasse Gilles Bernard', '', '14123', 'ifs', '2021-10-19', 5),
(1526943621, 'Merlot', 'Isabelle', '0?N7Ch$e', 'Résidence Les Hauts-bois 2B', 'chemin Fernandez', '14200', 'Hérouville-Saint-Clair', '2021-07-10', 5),
(1598771384, 'Villard', 'Augustin', 'Y5?j_0Cj', '44, rue du Vent', NULL, '14000', 'Caen', '2020-03-23', 5),
(2529228893, 'Langlois', 'Mélodie', '5u4!OlF!', '41 boulevard Richemond', NULL, '14000', 'Caen', '2020-08-31', 5),
(3234631127, 'Malandrain', 'Justine', 'i6UIe1$!', '1 rue du Bengal', NULL, '14000', 'Caen', NULL, 3),
(3378180016, 'Weiss', 'Henriette', 'Ze!?8uU7', 'Résidence des hirondelles, appartement 42', '21 rue Pierre Cassin', '14000', 'Caen', '2021-01-27', 5),
(3534247901, 'Noir', 'Mireille', 'P9!1$Zyi', '50, avenue du Maréchal Juin', NULL, '14000', 'Caen', NULL, 3),
(4126127561, 'Lebrec', 'Audrey', 'Sv_09x?N', '70, rue Devaux', NULL, '14000', 'Caen', '2021-04-17', 5),
(4223351145, 'Lupin', 'Bernard', 'Gy5v3M_?', '9, place Denise Boyer', NULL, '14123', 'Fleury-sur-Orne', '2020-09-16', 5),
(4238885261, 'Jouan', 'Zoé', 'pt!0WW7?', '54, place Bourgeois', '', '14000', 'Caen', '2021-10-20', 5),
(4450752613, 'Djouadi', 'Ibrahim', '5Jk!?Ly4', '6 avenue Foch', NULL, '14280', 'Saint-Germain-la-Blanche-Herbe', NULL, 2),
(5772151915, 'Le Gall', 'Arthur', 'i*E_Z2m7', '97, boulevard Gros', NULL, '73901', 'Legendreboeuf', '2021-10-03', 5),
(5936989908, 'Lebrec', 'Thimothée', 'tS9v5!C_', '70, rue Devaux', NULL, '14000', 'Caen', '2021-03-28', 5),
(5981680957, 'Kabeczerze', 'Théocrf', 'C?y8xG3!', '16, rue Cujasse', 'Résidence du style', '45000', 'CoulonNe', NULL, 1),
(6213494418, 'Montembault', 'Louis', 'u8aAW?4?', '77, place Théophile Hamel', NULL, '14530', 'Luc-sur-Mer', '2021-08-23', 5),
(6321447697, 'Querny', 'Maëlle', '60pw!?QK', '65, avenue Marie', NULL, '14280', 'Saint-Contest', '2021-01-29', 5),
(6621960167, 'Leguerrec', 'Soizic', 'Y$Il7?7v', '18 rue Josselin', NULL, '56000', 'Vannes', NULL, 1),
(6665531746, 'Fournier', 'Maggie', '9A$k7lV_', '223, impasse de Delahaye', NULL, '14530', 'Luc-sur-Mer', '2020-12-16', 5),
(7066785097, 'Boucher', 'Frédérique', 'u8?Vx!2F', '15, rue de Faure', NULL, '44427', 'Maury', NULL, 4),
(7115589590, 'Petit', 'Marion', 'ZSu!g1_8', '6, rue du Paradis', NULL, '14530', 'Luc-sur-Mer', '2021-08-25', 5),
(7874843335, 'Parent', 'Thérèse', '!1z0yV!O', '77, rue Grondin', NULL, '17364', 'Perretbourg', '2021-01-21', 5),
(8710381536, 'Fray', 'Hugo', 't0$6Vd$V', '48, avenue Lamy', NULL, '45816', 'Coulon', NULL, 4),
(8710555894, 'Aubusson', 'Ludivine', '$g1rV8?C', '6, rue des Orfèvres', NULL, '14000', 'Caen', '2020-12-18', 5),
(8711290529, 'Duhamel', 'Marin', '?3m9uKH_', '23 rue Laennec', NULL, '14200', 'Herouville-Saint-Clair', NULL, 4),
(8735962639, 'Justice', 'Marceau', '!Z$23mmY', '6, place de Vidal', NULL, '81856', 'Dupuis', '2021-09-27', 5),
(9041744554, 'Valentini', 'Myriam', 'U!g18cH!', '24, chemin de Didier', NULL, '81856', 'Dupuis', NULL, 2),
(9084584451, 'Joseph', 'Margot', '_2Vh9B?d', '969, rue de Bousquet', NULL, '81856', 'Dupuis', '2021-06-22', 5),
(9096810147, 'Organ', 'Julien', 'r_V?37Jd', '77, boulevard de Mallet', NULL, '45816', 'Coulon', '2021-06-04', 5),
(9127944279, 'Serpentard', 'Viviane', '2n5fK_W$', '23, chemin Lacroix', NULL, '14000', 'Caen', '2021-01-24', 5),
(9288270246, 'Rivière', 'Charlotte', 'Nh?t8C3_', '8, boulevard Becker', NULL, '14000', 'Caen', '2020-08-14', 5),
(9438246098, 'Mimi', 'Florient', 'r?3cO_6I', '80, rue Roland Guichard', NULL, '81856', 'Dupuis', '2020-12-31', 5),
(9583161311, 'Yvetot', 'Pierre', 'Z_S!ms91', '40, rue Marchal', NULL, '45816', 'Coulon', NULL, 3),
(9724349537, 'Libellule', 'Pauline', 'Q$27$bcV', '40, rue Fournier', NULL, '14000', 'Caen', '2021-02-13', 5),
(9724349538, 'Menestrelle', 'Aurélie', '@J35u15dr0l3', '6 impasse de la cambrousse', '', '16852', 'Cambrousse', '2021-01-04', 5),
(9724349539, 'Lepecheur', 'Clément', 'Gp3t3d3s0l3.', '4 rue des poissons', 'Résidence des Cannes', '14500', 'Vire', NULL, 3),
(9724349540, 'Lagrimpe', 'Manon', '@Cand52kjdbzjke', '42 rue des champs', '', '14000', 'Caen', '2021-10-19', 5),
(9724349541, 'Mimine', 'Amanda', '$peR5236d', '2 rue de Poik', NULL, '14500', 'Vire', '2021-05-22', 5),
(9724349542, 'King', 'Fred', '$peR52rah', '7 avenue du Soleil', NULL, '14300', 'Gerrots', NULL, 1),
(9724349543, 'Manon', 'ssgd', '$regex2Mille', 'vsdvqs', '', '15000', 'sdvsd', '2021-10-19', 5),
(9724349547, 'Lagrimpe', 'Manon', '*CandyL1k3', '5 impasse de l\'herbe verte', '', '13250', 'Saint-Chamas', '2021-10-19', 5),
(9724349548, 'Vieux', 'Matthieu', '*Bonjour54', 'ejbzc,ndc', 'fbfg', '12452', 'ncnh', NULL, 1),
(9724349549, 'Bowie', 'David', '@GroundK0ntr0L', '36 Tin Can', '', '22222', 'Space', NULL, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `_Album__Auteur1_FK` FOREIGN KEY (`idAuteur`) REFERENCES `auteur` (`idAuteur`),
  ADD CONSTRAINT `_Album__Serie0_FK` FOREIGN KEY (`idSerie`) REFERENCES `serie` (`idSerie`);

--
-- Contraintes pour la table `emplacement`
--
ALTER TABLE `emplacement`
  ADD CONSTRAINT `_Emplacement__Bibliotheque1_FK` FOREIGN KEY (`idBibli`) REFERENCES `bibliotheque` (`idBibli`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `Emprunt_Exemplaire_FK` FOREIGN KEY (`ID_exemplaire`) REFERENCES `exemplaire` (`ID_exemplaire`),
  ADD CONSTRAINT `Emprunt_User_FK` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `exemplaire`
--
ALTER TABLE `exemplaire`
  ADD CONSTRAINT `Exemplaire__Album3_FK` FOREIGN KEY (`ISBN`) REFERENCES `album` (`ISBN`) ON DELETE CASCADE,
  ADD CONSTRAINT `Exemplaire__Emplacement0_FK` FOREIGN KEY (`idEmplacement`) REFERENCES `emplacement` (`idEmplacement`),
  ADD CONSTRAINT `Exemplaire__Etat2_FK` FOREIGN KEY (`idEtat`) REFERENCES `etat` (`idEtat`);

--
-- Contraintes pour la table `lettres`
--
ALTER TABLE `lettres`
  ADD CONSTRAINT `FK_LETTRES_EMPRUNT` FOREIGN KEY (`id_emprunt`) REFERENCES `emprunt` (`id_emprunt`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `User__Role_FK` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
