START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `musica` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE musica;

DROP TABLE IF EXISTS `album`;
CREATE TABLE `album` (
  `album_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `label_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL
) ;

INSERT INTO `album` (`album_id`, `artist_id`, `label_id`, `name`, `stock`) VALUES
(1, 1, 1, 'Dónde está el país de las hadas', 0),
(2, 1, 1, 'Mecano', 2),
(3, 1, 3, 'Descanso Dominical', 10),
(4, 2, 2, 'Sgt. Pepper\'s Lonely Hearts Club Band', 5),
(5, 2, 2, 'Abbey Road', 0),
(6, 2, 2, 'Rubber Soul', 2),
(7, 3, 1, 'Like a Prayer', 10),
(8, 3, 3, 'Ray of Light', 0),
(9, 3, 3, 'Confessions on a Dance Floor', 0);

DROP TABLE IF EXISTS `artist`;
CREATE TABLE `artist` (
  `artist_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL
) ;

INSERT INTO `artist` (`artist_id`, `name`, `start_date`, `end_date`) VALUES
(1, 'Mecano', '1981-06-22', '1991-06-14'),
(2, 'Beatles', '1963-03-22', '1970-05-08'),
(3, 'Madonna', '1982-10-06', NULL);

DROP TABLE IF EXISTS `label`;
CREATE TABLE `label` (
  `label_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `telephone` varchar(9) NOT NULL,
  `email` varchar(20) NOT NULL
) ;

INSERT INTO `label` (`label_id`, `name`, `telephone`, `email`) VALUES
(1, 'BGM', '987546311', 'bgm@label.es'),
(2, 'Apple', '902145638', 'apple@label.com'),
(3, 'Warner', '986102457', 'warner@label.com');

DROP TABLE IF EXISTS `manager`;
CREATE TABLE `manager` (
  `manager_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `telephone` varchar(9) NOT NULL,
  `email` varchar(20) NOT NULL
) ;

INSERT INTO `manager` (`manager_id`, `artist_id`, `name`, `telephone`, `email`) VALUES
(1, 1, 'Juan', '634520123', 'juan@manager.es'),
(2, 3, 'Giorgio', '602154576', 'giorgio@manager.es'),
(3, 2, 'George Martin', '601453722', 'george@manager.com');

DROP TABLE IF EXISTS `song`;
CREATE TABLE `song` (
  `song_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ;

INSERT INTO `song` (`song_id`, `album_id`, `name`) VALUES
(1, 1, 'Dónde está el país de las hadas'),
(2, 1, 'La bola de cristal'),
(3, 2, 'Maquillaje'),
(4, 2, 'Quiero vivir en la ciudad'),
(5, 3, 'El cine'),
(6, 3, 'No hay marcha en NY'),
(7, 3, 'Fabula'),
(8, 4, 'Sgt. Pepper\'s Lonely Hearts Club Band'),
(9, 4, 'Lucy in the Sky with Diamonds'),
(10, 5, 'Something'),
(11, 5, 'Here Comes the Sun'),
(12, 6, 'Rubber Soul'),
(13, 6, 'Rubber Soul'),
(14, 7, 'Like a Prayer'),
(15, 7, 'Express Yourself'),
(16, 8, 'Ray of Light'),
(17, 8, 'Frozen'),
(18, 9, 'Hung Up'),
(19, 9, 'Sorry');

ALTER TABLE `album`
  ADD PRIMARY KEY (`album_id`),
  ADD KEY `label_id` (`label_id`),
  ADD KEY `artist_id` (`artist_id`);

ALTER TABLE `artist`
  ADD PRIMARY KEY (`artist_id`);

ALTER TABLE `label`
  ADD PRIMARY KEY (`label_id`);

ALTER TABLE `manager`
  ADD PRIMARY KEY (`manager_id`),
  ADD KEY `artist_id` (`artist_id`);

ALTER TABLE `song`
  ADD PRIMARY KEY (`song_id`),
  ADD KEY `album_id` (`album_id`);

ALTER TABLE `album`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `artist`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `label`
  MODIFY `label_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `manager`
  MODIFY `manager_id` int(11) NOT NULL AUTO_INCREMENT;
  
ALTER TABLE `song`
  MODIFY `song_id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`artist_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `album_ibfk_2` FOREIGN KEY (`label_id`) REFERENCES `label` (`label_id`) ON DELETE CASCADE;

ALTER TABLE `manager`
  ADD CONSTRAINT `artist_id` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`artist_id`);
  
ALTER TABLE `song`
  ADD CONSTRAINT `album_id` FOREIGN KEY (`album_id`) REFERENCES `album` (`album_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
