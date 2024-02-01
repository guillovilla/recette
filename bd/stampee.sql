

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `categorie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `categorie` (`id`, `categorie`) VALUES
(1, 'Art'),
(2, 'Science'),
(3, 'Histoire'),
(4, 'Personnage'),
(5, 'Animal'),
(6, 'Plante');

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `message` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `contact` (`id`, `nom`, `email`, `message`) VALUES
(1, 'Peter', 'peter@gmail.com', 'Bon !'),
(2, 'Sharon', 'sharon@gmail.com', 'Tres bon !'),
(3, 'Richard', 'richard@gmail.com', 'Pas mal !'),
(4, 'Sharon', 'sharon@gmail.com', 'Hello !'),
(7, 'Richard', 'richard@gmail.com', 'Allo !'),
(8, 'Jason', 'jason@gmail.com', 'Bonjour !'),
(9, 'tim', '1@1.com', 'adflghanglkj ahrgl'),
(10, 'Tim', 'tim@gmail.com', 'zzzzzzzzzzzzzzzzz');

CREATE TABLE `enchere` (
  `id` int(11) NOT NULL,
  `prix_depart` double NOT NULL DEFAULT '0',
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `enchere` (`id`, `prix_depart`, `date_debut`, `date_fin`, `user_id`) VALUES
(1, 0, '2023-12-04 00:00:00', '2024-12-31 00:00:00', 1),
(2, 0, '2023-12-04 00:00:00', '2024-12-31 00:00:00', 2),
(3, 0, '2023-12-04 00:00:00', '2024-12-31 00:00:00', 3),
(4, 0, '2023-12-04 00:00:00', '2024-12-31 00:00:00', 4),
(5, 0, '2023-12-04 00:00:00', '2024-12-31 00:00:00', 5),
(6, 0, '2023-12-04 00:00:00', '2024-12-31 00:00:00', 6),
(73, 1111, '1111-11-11 00:00:00', '1111-11-11 00:00:00', 7),
(74, 0, '2024-01-05 00:00:00', '2024-01-06 00:00:00', 7),
(75, 3333, '0333-12-31 00:00:00', '0333-03-03 00:00:00', 7),
(76, 22, '0222-02-02 00:00:00', '0222-02-02 00:00:00', 2),
(77, 90, '2000-09-09 00:00:00', '2000-09-09 00:00:00', 7),
(78, 100, '2000-09-09 00:00:00', '2000-09-09 00:00:00', 7),
(79, 120, '2000-09-09 00:00:00', '2000-09-09 00:00:00', 7),
(80, 0, '2000-09-09 00:00:00', '2000-09-09 00:00:00', 7),
(81, 100, '2024-01-08 00:00:00', '2024-02-08 00:00:00', 7),
(84, 100, '2024-01-08 00:00:00', '2024-02-10 00:00:00', 1),
(85, 100, '2024-01-08 00:00:00', '2024-02-10 00:00:00', 1),
(86, 100, '2024-01-08 00:00:00', '2024-01-31 00:00:00', 1),
(87, 100, '2024-01-08 00:00:00', '2024-01-31 00:00:00', 1),
(88, 100, '2024-01-08 00:00:00', '2024-01-31 00:00:00', 1),
(89, 100, '2024-01-08 00:00:00', '2024-01-31 00:00:00', 1),
(90, 100, '2024-01-08 00:00:00', '2024-01-31 00:00:00', 1),
(91, 100, '2024-01-08 00:00:00', '2024-01-31 00:00:00', 1),
(99, 1000, '2024-01-08 00:00:00', '2024-01-31 00:00:00', 1),
(100, 1000, '2024-01-08 00:00:00', '2024-01-31 00:00:00', 1),
(102, 10, '2024-01-09 00:00:00', '2024-01-09 00:00:00', 2),
(104, 90, '2024-01-01 00:00:00', '2024-02-10 00:00:00', 7),
(105, -0, '2024-01-06 00:00:00', '2024-02-03 00:00:00', 7),
(107, 100, '2024-01-10 00:00:00', '2024-02-10 00:00:00', 1),
(108, 100, '2024-01-01 00:00:00', '2024-02-10 00:00:00', 1);

CREATE TABLE `favori` (
  `id` int(11) NOT NULL,
  `enchere_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `favori` (`id`, `enchere_id`, `user_id`) VALUES
(22, 2, 2),
(23, 2, 3),
(24, 2, 4),
(25, 2, 5),
(26, 2, 6),
(42, 3, 2),
(43, 77, 7),
(44, 78, 7),
(52, 3, 3),
(53, 3, 3),
(54, 3, 3),
(55, 3, 3),
(56, 3, 3),
(57, 3, 3),
(59, 2, 7),
(93, 1, 8),
(94, 81, 2),
(97, 100, 7),
(102, 74, 7),
(103, 74, 7),
(104, 74, 7),
(106, 104, 7),
(110, 1, 7);

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `timbre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `image` (`id`, `filename`, `timbre_id`) VALUES
(1, '1.jpg', 1),
(2, '2.jpg', 2),
(3, '3.jpg', 3),
(4, '4.jpg', 4),
(5, '5.jpg', 5),
(6, '6.jpg', 6),
(8, '12.jpg', 2),
(9, '13.jpg', 3),
(10, '14.jpg', 4),
(11, '15.jpg', 5),
(12, '16.jpg', 6),
(14, '22.jpg', 2),
(15, '23.jpg', 3),
(16, '24.jpg', 4),
(17, '25.jpg', 5),
(18, '26.jpg', 6),
(45, 'image-659aea5dbd94f.jpg', 32),
(46, 'image-659ae9be7ed75.jpg', 33),
(47, 'image-659aeb353f791.jpg', 34),
(48, 'image-659aea5dbd94f.jpg', 35),
(49, 'image-659ae9be7ed75.jpg', 36),
(50, 'image-659aea5dbd94f.jpg', 37),
(52, 'image-659aeb353f791.jpg', 39),
(53, 'image-659aebbb2603a.jpg', 40),
(54, 'image-659c464367c3d.jpg', 41),
(62, 'i-659cd6c1c4bcc-0.jpg', 51),
(63, 'i-659cd6c1c4eb7-1.jpg', 51),
(64, 'i-659cd6c1c4fab-2.jpg', 51),
(66, 'i-659cd71ade504-1.jpg', 52),
(67, 'i-659cd71ade5bc-2.jpg', 52),
(69, 'i-659ce42762582-0.jpeg', 54),
(70, 'i-659ce4276272c-1.jpg', 54),
(75, 'i-659df3ac1449e-0.jpg', 59),
(76, 'i-659df4f9a0d1a-0.jpg', 60),
(78, 'i-659f1ead913fe-0.jpeg', 62),
(79, 'i-659f1ead916df-1.jpg', 62),
(80, 'i-65a5ea369f724-0.jpg', 63);

CREATE TABLE `mise` (
  `id` int(11) NOT NULL,
  `enchere_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prix` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `mise` (`id`, `enchere_id`, `user_id`, `prix`) VALUES
(1, 1, 1, 100),
(2, 1, 2, 120),
(3, 1, 3, 130),
(4, 2, 1, 210),
(5, 2, 2, 220),
(6, 2, 3, 230),
(7, 3, 3, 300),
(8, 4, 4, 400),
(9, 5, 5, 500),
(10, 1, 2, 140),
(11, 1, 2, 150),
(12, 1, 2, 160),
(13, 1, 2, 170),
(14, 1, 2, 0),
(15, 1, 2, 0),
(16, 1, 2, 0),
(17, 1, 2, 0),
(18, 73, 2, 1200),
(19, 73, 2, 1300),
(20, 73, 2, 1400),
(21, 73, 2, 1500),
(22, 73, 2, 1600),
(23, 76, 2, 30),
(24, 76, 2, 40),
(25, 76, 2, 50),
(31, 2, 1, 300),
(32, 2, 1, 310),
(33, 3, 2, 320),
(34, 3, 2, 330),
(35, 3, 2, 340),
(37, 73, 1, 1900),
(38, 73, 1, 2000),
(39, 100, 1, 1100),
(40, 1, 8, 190),
(41, 1, 8, 200),
(42, 1, 2, 210),
(43, 1, 2, 220),
(44, 1, 2, 230),
(45, 1, 2, 240),
(51, 2, 1, 350),
(52, 2, 1, 400),
(53, 1, 1, 250),
(54, 1, 7, 260);

CREATE TABLE `pays` (
  `id` int(11) NOT NULL,
  `pays` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `pays` (`id`, `pays`) VALUES
(1, 'Canada'),
(2, "États-Unis d\'Amérique"),
(3, 'Royaume-Uni'),
(4, 'France'),
(5, 'Japon'),
(6, 'Chine');

CREATE TABLE `privilege` (
  `id` int(11) NOT NULL,
  `privilege` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `privilege` (`id`, `privilege`) VALUES
(1, 'admin'),
(2, 'employee'),
(3, 'membre');

CREATE TABLE `recommande` (
  `id` int(11) NOT NULL,
  `enchere_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `recommande` (`id`, `enchere_id`) VALUES
(38, 1),
(26, 2),
(12, 3),
(14, 4),
(27, 5),
(28, 6),
(1, 73),
(2, 74),
(3, 75),
(32, 77),
(5, 78),
(6, 79),
(7, 80),
(8, 81),
(17, 99),
(19, 102),
(11, 105);

CREATE TABLE `timbre` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `annee` varchar(4) DEFAULT NULL,
  `enchere_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `pays_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `timbre` (`id`, `nom`, `description`, `annee`, `enchere_id`, `categorie_id`, `pays_id`) VALUES
(1, 'SG197 VFU Wmk Inverted, part oval datestamp', 'Le Penny Black est le premier timbre postal de l\'histoire. Il a été émis le 1er mai 1840 au Royaume-Uni de Grande-Bretagne et d\'Irlande à l\'initiative de Rowland Hill, pour un usage officiel à partir du 6 mai, dans le cadre de la réforme du système postal britannique destinée à faire désormais payer l\'expéditeur plutôt que le destinataire.', '1887', 1, 1, 1),
(2, 'SG94 Pl.14 Mint Unmounted o.g. example (RK)', 'Le Penny Black est le premier timbre postal de l\'histoire. Il a été émis le 1er mai 1840 au Royaume-Uni de Grande-Bretagne et d\'Irlande à l\'initiative de Rowland Hill, pour un usage officiel à partir du 6 mai, dans le cadre de la réforme du système postal britannique destinée à faire désormais payer l\'expéditeur plutôt que le destinataire.', '1873', 2, 2, 2),
(3, 'SG197 VFU Wmk Inverted, part oval datestamp', 'Le Penny Black est le premier timbre postal de l\'histoire. Il a été émis le 1er mai 1840 au Royaume-Uni de Grande-Bretagne et d\'Irlande à l\'initiative de Rowland Hill, pour un usage officiel à partir du 6 mai, dans le cadre de la réforme du système postal britannique destinée à faire désormais payer l\'expéditeur plutôt que le destinataire.', '1887', 3, 3, 3),
(4, 'SGO67 Official(Govt. Parcels) unused o.g. example', 'Le Penny Black est le premier timbre postal de l\'histoire. Il a été émis le 1er mai 1840 au Royaume-Uni de Grande-Bretagne et d\'Irlande à l\'initiative de Rowland Hill, pour un usage officiel à partir du 6 mai, dans le cadre de la réforme du système postal britannique destinée à faire désormais payer l\'expéditeur plutôt que le destinataire.', '1888', 4, 4, 4),
(5, 'SG197 VFU Wmk Inverted, part oval datestamp', 'Le Penny Black est le premier timbre postal de l\'histoire. Il a été émis le 1er mai 1840 au Royaume-Uni de Grande-Bretagne et d\'Irlande à l\'initiative de Rowland Hill, pour un usage officiel à partir du 6 mai, dans le cadre de la réforme du système postal britannique destinée à faire désormais payer l\'expéditeur plutôt que le destinataire.', '1887', 5, 5, 5),
(6, 'SG94 Unmounted o.g. example (RK)', 'Le Penny Black est le premier timbre postal de l\'histoire. Il a été émis le 1er mai 1840 au Royaume-Uni de Grande-Bretagne et d\'Irlande à l\'initiative de Rowland Hill, pour un usage officiel à partir du 6 mai, dans le cadre de la réforme du système postal britannique destinée à faire désormais payer l\'expéditeur plutôt que le destinataire.', '1873', 6, 6, 6),
(32, '1111', '1111', '1111', 73, 5, 1),
(33, '2222', '2222', '2222', 74, 5, 1),
(34, '3333', '3333', '3333', 75, 5, 1),
(35, '2222', '2222', '2222', 76, 1, 6),
(36, 'SG197 VFU Wmk Inverted, part oval datestamp', 'Le Penny Black est le premier timbre postal de l\'histoire. Il a été émis le 1er mai 1840 au Royaume-Uni de Grande-Bretagne et d\'Irlande à l\'initiative de Rowland Hill, pour un usage officiel à partir du 6 mai, dans le cadre de la réforme du système postal britannique destinée à faire désormais payer l\'expéditeur plutôt que le destinataire.', '1888', 77, 1, 4),
(37, 'SG197 VFU Wmk Inverted, part oval datestamp', 'Le Penny Black est le premier timbre postal de l\'histoire. Il a été émis le 1er mai 1840 au Royaume-Uni de Grande-Bretagne et d\'Irlande à l\'initiative de Rowland Hill, pour un usage officiel à partir du 6 mai, dans le cadre de la réforme du système postal britannique destinée à faire désormais payer l\'expéditeur plutôt que le destinataire.', '2000', 78, 2, 1),
(39, 'SG197 VFU Wmk Inverted, part oval datestamp', 'Le Penny Black est le premier timbre postal de l\'histoire. Il a été émis le 1er mai 1840 au Royaume-Uni de Grande-Bretagne et d\'Irlande à l\'initiative de Rowland Hill, pour un usage officiel à partir du 6 mai, dans le cadre de la réforme du système postal britannique destinée à faire désormais payer l\'expéditeur plutôt que le destinataire.', '1888', 79, 4, 2),
(40, 'SG197 VFU Wmk Inverted, part oval datestamp', "Le Penny Black est le premier timbre postal de l\'histoire. Il a été émis le 1er mai 1840 au Royaume-Uni de Grande-Bretagne et d\'Irlande à l\'initiative de Rowland Hill, pour un usage officiel à partir du 6 mai.", '1999', 80, 6, 6),
(41, "SG94 Pl.14 Mint Unmounted o.g. example (RK)", "Grande-Bretagne et d\'Irlande à l\'initiative de Rowland Hill, pour un usage officiel à partir du 6 mai, dans le cadre de la réforme du système postal britannique destinée à faire désormais payer l\'expéditeur plutôt que le destinataire.", '1900', 81, 2, 4),
(51, "Le Penny Black est le premier timbre postal de l\'histoire", "Il a été émis le 1er mai 1840 au Royaume-Uni de Grande-Bretagne et d\'Irlande à l\'initiative de Rowland Hill, pour un usage officiel à partir du 6 mai, dans le cadre de la réforme du système postal britannique destinée à faire désormais payer l\'expéditeur plutôt que le destinataire.", '1900', 99, 1, 1),
(52, "Le Penny Black est le premier timbre postal de l\'histoire", "Il a été émis le 1er mai 1840 au Royaume-Uni de Grande-Bretagne et d\'Irlande à l\'initiative de Rowland Hill, pour un usage officiel à partir du 6 mai, dans le cadre de la réforme du système postal britannique destinée à faire désormais payer l\'expéditeur plutôt que le destinataire.", '1900', 100, 1, 1),
(54, "G197 VFU Wmk Inverted, part oval datestamp", "Royaume-Uni de Grande-Bretagne et d\'Irlande à l\'initiative de Rowland Hill, pour un usage officiel à partir du 6 mai, dans le cadre de la réforme du système postal britannique destinée à faire désormais payer l\'expéditeur plutôt que le destinataire", '2000', 102, 1, 4),
(59, "SG197 VFU Wmk Inverted, part oval datestamp", "Royaume-Uni de Grande-Bretagne et d\'Irlande à l\'initiative de Rowland Hill, pour un usage officiel à partir du 6 mai, dans le cadre de la réforme du système postal britannique destinée à faire désormais payer l\'expéditeur plutôt que le destinataire", '1987', 104, 3, 1),
(60, "Le Penny Black est le premier timbre postal de l\'histoire. ", "Il a été émis le 1er mai 1840 au Royaume-Uni de Grande-Bretagne et d\'Irlande à l\'initiative de Rowland Hill, pour un usage officiel à partir du 6 mai, dans le cadre de la réforme du système postal britannique destinée à faire désormais payer l\'expéditeur plutôt que le destinataire.", '1900', 105, 5, 6),
(62, "Titre du timbre", "Description du timbre \r\n", '1900', 107, 4, 1),
(63, "#2TCv - HRH Prince Albert (1851) 6d", "Rawdon, Wright, Hatch and Edson of New York", '1900', 108, 1, 1);

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `tempPassword` varchar(255) DEFAULT NULL,
  `privilege_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `username`, `email`, `phone`, `address`, `password`, `tempPassword`, `privilege_id`) VALUES
(1, 'Tim', 'tim@gmail.com', '000000', '000000', '$2y$10$PEpbCnd1roxLR.TsPUejA.II9HNEEitWooDTgkg60c/UmLUCVmJoW', NULL, 3),
(2, 'Judy', 'judy@gmail.com', '000000', '000000', '$2y$10$52XSI8XiyRtoYP8bIIPhBeimw36RJyYCLkebZVp7PydtuUBTpRO96', NULL, 3),
(3, 'Mike', 'mike@gmail.com', '000000', '000000', '$2y$10$OJoR6zRsoPz1j2Tl4JO0huUDk4i5YfLjvCxcgdeWHSlyQmcx8XPbK', NULL, 3),
(4, 'Nancy', 'nancy@gmail.com', '000000', '000000', '$2y$10$qZ5hS1yQouIXtiE1BglzM.e.QGkBbnpTGaaxzJHf9SwSCSFLohaXy', NULL, 3),
(5, 'Sam', 'sam@gmail.com', '000000', '000000', '$2y$10$IdYLH71jU5ulcZhKUQVUdeEOg38IjSRVvd/owX1PrGn47tH4bnIZ2', NULL, 3),
(6, 'Jhon', 'jhon@gmail.com', '000000', '000000', '$2y$10$ZeLcnY.1MpHR0RKVQLBX2.Ea8Yv9nTwwxKGJiwlJbtjjJjq4STC0W', NULL, 3),
(7, 'Admin', 'admin@gmail.com', NULL, NULL, '$2y$10$pOb7QGmuFp0Y3vhPydy3mOHJcNaRE4lKJ8kjSJsyEBFKN5ie/jDv.', NULL, 1),
(8, 'Employee', 'employee@gmail.com', NULL, NULL, '$2y$10$lzhGnucLq/mSIaG.0BCdkuvAEKNGt3HmaUxwm3JGx0Sd6wKMuJ9xy', NULL, 2),
(11, 'Peter', 'peter@gmail.com', '000000', '000000', '$2y$10$5FF.lx6PwqYINu2AjBi03uRJcKK5ElsYtEcvjVdXRxYfSkQo/SY2u', NULL, 3);
