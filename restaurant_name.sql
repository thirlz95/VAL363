--
-- Table structure for table `visaApplicant`
--

DROP TABLE IF EXISTS `artists`;
CREATE TABLE IF NOT EXISTS `artists` (
  `artist_id` int(7) NOT NULL auto_increment,
  `artist_firstname` varchar(100) default NULL,
  `artist_surname` varchar(100) NOT NULL,
  `artist_genre` varchar(30) NOT NULL,
  `artist_image` varchar(30) NULL,
  `artist_notes` varchar(500) DEFAULT NULL,
   PRIMARY KEY `artist_id` (`artist_id`)
) DEFAULT CHARSET=latin1 AUTO_INCREMENT=2000;

--
-- Insert data for table `visaApplicant`
--

INSERT INTO `artists` (`artist_id`, `artist_firstname`, `artist_surname`, `artist_genre`, `artist_image`,`artist_notes`) VALUES

(1, 'Alan', 'Baker', 'blues', 'known for his fantastic live performance and sell out concerts'),
(2, 'Bob', 'Dylan', 'rock', 'World recognised artist who been around since the 60s and still sells out shows'),
(3, 'Geoff', 'Lamb', 'blues', 'New to the scene, a young artist who wants to leave a mark'),
(4, 'Joel', 'Zimmerman', 'Electronic', 'known as an outstanding producer and showman, with some of the most spectaular light shows know'),
(5, 'Tim', 'Berg', 'Electronic', 'Also known as Avicci has been hitting platium more time than you have had hot dinners'),
(6, 'Roger', 'McKenzie', 'Electronic', 'Also known as Wildchild, a british born DJ known for classic such as renegade master'),
(7, 'Mark', 'Kinchen', 'Electronic', 'Also know as MK. Hes been around for year, but now hes hitting chart singles everyother week'),
(8, 'ozzy', 'osbourne', 'rock', 'the bat biter is back for round two, this 60 year old rockstar has blasted away generations'),
(9, 'Britney', 'Spears', 'pop', 'she has ditched the bottle and has her next world tour booked over the next seven months'),
(10, 'David', 'Bowie', 'pop', 'He may have past but his ledgend lives on through his world class music');
