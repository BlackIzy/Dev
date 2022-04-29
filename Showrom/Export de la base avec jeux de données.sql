-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  Dim 18 avr. 2021 à 14:16
-- Version du serveur :  10.3.9-MariaDB
-- Version de PHP :  7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `zfl2-zberteab0`
--

-- --------------------------------------------------------

--
-- Structure de la table `tj_sel_elt`
--

CREATE TABLE `tj_sel_elt` (
  `sel_numero` int(11) NOT NULL,
  `elt_numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tj_sel_elt`
--

INSERT INTO `tj_sel_elt` (`sel_numero`, `elt_numero`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(4, 1),
(4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `t_compte_cpt`
--

CREATE TABLE `t_compte_cpt` (
  `cpt_pseudo` varchar(20) NOT NULL,
  `cpt_mot_de_passe` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_compte_cpt`
--

INSERT INTO `t_compte_cpt` (`cpt_pseudo`, `cpt_mot_de_passe`) VALUES
('black', '8d916055dc1adaf2e8da3f6bad0b607e'),
('Chiwa', '83ea007bfdd589f29b820552b3f94260'),
('Cok', '83ea007bfdd589f29b820552b3f94260'),
('Datsol', '83ea007bfdd589f29b820552b3f94260'),
('gestionnaire1', '388d4ca7d89f912a8fe96b04fb3d8e22'),
('Jin', '83ea007bfdd589f29b820552b3f94260'),
('Keta', '83ea007bfdd589f29b820552b3f94260'),
('Maki', '83ea007bfdd589f29b820552b3f94260'),
('Nita', '83ea007bfdd589f29b820552b3f94260'),
('Raku', '83ea007bfdd589f29b820552b3f94260'),
('Rana', '83ea007bfdd589f29b820552b3f94260'),
('Valerie-Marc', '83ea007bfdd589f29b820552b3f94260');

-- --------------------------------------------------------

--
-- Structure de la table `t_element_elt`
--

CREATE TABLE `t_element_elt` (
  `elt_numero` int(11) NOT NULL,
  `elt_intitule` varchar(200) NOT NULL,
  `elt_descriptif` varchar(100) NOT NULL,
  `elt_date_dajout` date NOT NULL,
  `elt_fichier_images` varchar(100) NOT NULL,
  `elt_etat` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_element_elt`
--

INSERT INTO `t_element_elt` (`elt_numero`, `elt_intitule`, `elt_descriptif`, `elt_date_dajout`, `elt_fichier_images`, `elt_etat`) VALUES
(1, 'T-SHIRTS', 'Le t-shirt est un vêtement emblématique et nécessaire par sa simplicité.', '2021-04-18', 'images/t-shirt.jpeg', 'Publié'),
(2, 'CHEMISES', 'La chemise s adapte très bien à de nombreux styles.', '2021-04-18', 'images/chemise.jpg', 'Publié'),
(3, 'PANTALON & JEAN', 'Le pantalon se décline en de nombreuses coupes.', '2021-04-18', 'images\\pantalon.jpeg', 'Publié'),
(4, 'BLOUSONS', 'EN peridode hivernal faut toujours un blouson :)', '2021-04-18', 'images\\blouson.jpg', 'Publié'),
(5, 'BOTTES', 'Les bottes sont tendance mais aussi necessaire :)', '2021-04-18', 'images\\bottes.jpg', 'Publié'),
(6, 'BASKETES', 'Les baskets sont idéales pour créer un look dynamique.', '2021-04-18', 'images\\basket.jpg', 'Publié'),
(7, 'TONGS', 'Idéal pour les vacances ou pour se promener lors des fortes chaleurs.', '2021-04-18', 'images\\tong.jpg', 'Publié'),
(8, 'SANDALES', 'La sandale homme trouve un nouveau public et réinvestit la mode.', '2021-04-18', 'images\\sandales.jpg', 'Publié'),
(9, 'MONTRES', 'Au-delà de donner l heure, la montre est un véritable accessoire de mode.', '2021-04-18', 'images\\montre.jpg', 'Brouillon'),
(10, 'SACS & SACOCHES', 'Sacs Sacoches vous trouverez tout se qui vous convient', '2021-04-18', 'images\\sac.jpg', 'Publié'),
(11, 'CEINTURES', 'La ceinture est un accessoire indispensable.', '2021-04-18', 'images\\ceinture.jpg', 'Publié'),
(12, 'GANTS', 'En hiver le gant est l accessoire indispensable.', '2021-04-18', 'images\\gant.jpg', 'Publié'),
(13, 'BRACELETS', 'Le bracelet est un accessoire indémodable qui se décline à l infini.', '2021-04-18', 'images\\bracelet.jpg', 'Publié'),
(14, 'FACEBOOK', 'Toute les news nous consernant en dehors du site sur une page facebook', '2021-04-18', 'images\\logo-facebook.jpg', 'Publié'),
(15, 'INSTAGRAM', 'Toute les news nous consernant en dehors du site sur une page INSTAGRAM', '2021-04-18', 'images\\logo-instagram.jpeg', 'Publié'),
(16, 'TWITER', 'Toute les news nous consernant en dehors du site sur une page INSTAGRAM', '2021-04-18', 'images\\logo-twitter.jpeg', 'Publié');

-- --------------------------------------------------------

--
-- Structure de la table `t_liens_lie`
--

CREATE TABLE `t_liens_lie` (
  `lie_numero` int(11) NOT NULL,
  `lie_titre` varchar(100) NOT NULL,
  `lie_url` varchar(200) NOT NULL,
  `lie_auteur` varchar(100) NOT NULL,
  `lie_date_de_publication` date NOT NULL,
  `elt_numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_liens_lie`
--

INSERT INTO `t_liens_lie` (`lie_numero`, `lie_titre`, `lie_url`, `lie_auteur`, `lie_date_de_publication`, `elt_numero`) VALUES
(1, 'Page facebook', 'https://fr-fr.facebook.com/', 'gestionnaire1', '2021-04-18', 14),
(2, 'Page instagram', 'https://twitter.com/?lang=fr', 'gestionnaire1', '2021-04-18', 15),
(3, 'Page twiter', 'https://www.instagram.com/?hl=fr', 'gestionnaire1', '2021-04-18', 16);

-- --------------------------------------------------------

--
-- Structure de la table `t_news_new`
--

CREATE TABLE `t_news_new` (
  `new_numero` int(11) NOT NULL,
  `new_titre` varchar(50) NOT NULL,
  `new_texte` varchar(300) NOT NULL,
  `new_date_de_publication` date NOT NULL,
  `new_etat` char(20) NOT NULL,
  `cpt_pseudo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_news_new`
--

INSERT INTO `t_news_new` (`new_numero`, `new_titre`, `new_texte`, `new_date_de_publication`, `new_etat`, `cpt_pseudo`) VALUES
(1, 'Solde', 'Les soldes hivernal sont en cours allez vite regardez', '2021-04-18', 'En ligne', 'gestionnaire1'),
(2, 'Reduction', 'Les reductions sont enormes cette année de 10-60%. Les manqués pas !', '2021-04-18', 'En ligne', 'gestionnaire1'),
(3, 'Rubrique', 'Creation d une nouvelle selection promo regroupant toute les promos sur le site', '2021-04-18', 'En ligne', 'gestionnaire1'),
(4, 'Rubrique reseaux', 'Vous pouvez nous suivre et nous envoye vos look pour qu elle soit publie tu te verra peut être sur le site IZY ;)', '2021-04-18', 'En ligne', 'gestionnaire1'),
(5, 'Livraison', 'Vous serez livré dans les plus bref delais, en raison de la pandemi, notre services client reste à votre disposition', '2021-04-18', 'En ligne', 'gestionnaire1'),
(6, 'Boutique', 'blabklzdzejfdizjezjesfjizejf', '2021-04-18', 'Brouillon', 'Cok'),
(7, 'Testvm', 'eval', '2021-04-18', 'En ligne', 'black');

-- --------------------------------------------------------

--
-- Structure de la table `t_presentation_pre`
--

CREATE TABLE `t_presentation_pre` (
  `pre_numero` int(11) NOT NULL,
  `pre_nom_de_la_structure` varchar(60) NOT NULL,
  `pre_adresse` varchar(100) NOT NULL,
  `pre_mail` varchar(20) NOT NULL,
  `pre_tel` varchar(12) NOT NULL,
  `pre_horaire` varchar(60) NOT NULL,
  `pre_texte_de_bienvenue` varchar(300) NOT NULL,
  `cpt_pseudo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_presentation_pre`
--

INSERT INTO `t_presentation_pre` (`pre_numero`, `pre_nom_de_la_structure`, `pre_adresse`, `pre_mail`, `pre_tel`, `pre_horaire`, `pre_texte_de_bienvenue`, `cpt_pseudo`) VALUES
(1, 'IZY', '12  rue marques izy', 'izy@mail.com', '0204620246', '24/24', 'Bienvenue sur notre site internet Izy la marque de la fabrique', 'gestionnaire1');

-- --------------------------------------------------------

--
-- Structure de la table `t_selection_sel`
--

CREATE TABLE `t_selection_sel` (
  `sel_numero` int(11) NOT NULL,
  `sel_titre` varchar(60) NOT NULL,
  `sel_texte_introductive` varchar(200) NOT NULL,
  `sel_date_dajout` date NOT NULL,
  `cpt_pseudo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_selection_sel`
--

INSERT INTO `t_selection_sel` (`sel_numero`, `sel_titre`, `sel_texte_introductive`, `sel_date_dajout`, `cpt_pseudo`) VALUES
(1, 'VETEMENTS', 'Ensemble des vêtements disponible sur le site : Blousons, T-shirts, Chemises, Pantalon & Jean', '2021-04-18', 'gestionnaire1'),
(2, 'CHAUSSURES', 'Ensemble des chaussures disponible sur le site : Bottes, Baskets, Tongs, Sandales', '2021-04-18', 'gestionnaire1'),
(3, 'ACCESOIRES', 'Ensemble des accessoires disponible sur le site : Montres, Sacs & Sacoches, Ceintures, Bracelets, Gants', '2021-04-18', 'gestionnaire1'),
(4, 'PROMOS', 'Ensemble des promos disponible sur le site', '2021-04-18', 'gestionnaire1');

-- --------------------------------------------------------

--
-- Structure de la table `t_utilisateur_uti`
--

CREATE TABLE `t_utilisateur_uti` (
  `uti_nom` varchar(60) NOT NULL,
  `uti_prenom` varchar(60) NOT NULL,
  `uti_mail` varchar(80) NOT NULL,
  `uti_valide` char(1) NOT NULL,
  `uti_statut` char(1) NOT NULL,
  `uti_date_de_creation` date NOT NULL,
  `cpt_pseudo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_utilisateur_uti`
--

INSERT INTO `t_utilisateur_uti` (`uti_nom`, `uti_prenom`, `uti_mail`, `uti_valide`, `uti_statut`, `uti_date_de_creation`, `cpt_pseudo`) VALUES
('M', 'V', 'V-M@yahoo.fr', 'A', 'R', '2021-01-25', 'Valerie-Marc'),
('Berte', 'Abdoulaye', 'buzz@gmail.com', 'A', 'A', '2021-01-25', 'gestionnaire1'),
('Naruto', 'Uzamaki', 'uzamaki@gmail.com', 'A', 'A', '2021-01-25', 'Maki'),
('Weei', 'Soldat', 'soldat@gmail.com', 'A', 'A', '2021-01-25', 'Datsol'),
('Neji', 'Hyûga', 'neji@gmail.com', 'A', 'A', '2021-01-25', 'Jin'),
('Hinata', 'Hyûga', 'nita@gmail.com', 'A', 'A', '2021-01-25', 'Nita'),
('Sakura', 'Haruno', 'raku@gmail.com', 'A', 'A', '2021-01-25', 'Raku'),
('Lee', 'Rock', 'lee@gmail.com', 'A', 'A', '2021-01-25', 'Cok'),
('Shimaru', 'Nara', 'nara@gmail.com', 'D', 'A', '2021-01-25', 'Rana'),
('Kakashi', 'Hatake', 'take@gmail.com', 'D', 'A', '2021-01-25', 'Keta'),
('Sasuke', 'Uchiwa', 'suke@gmail.com', 'D', 'A', '2021-01-25', 'Chiwa'),
('Curieur', 'test', 'zoz@gm.com', 'A', 'R', '2021-04-18', 'black');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tj_sel_elt`
--
ALTER TABLE `tj_sel_elt`
  ADD PRIMARY KEY (`sel_numero`,`elt_numero`),
  ADD KEY `tj_sel_t_elt_FK` (`elt_numero`);

--
-- Index pour la table `t_compte_cpt`
--
ALTER TABLE `t_compte_cpt`
  ADD PRIMARY KEY (`cpt_pseudo`);

--
-- Index pour la table `t_element_elt`
--
ALTER TABLE `t_element_elt`
  ADD PRIMARY KEY (`elt_numero`);

--
-- Index pour la table `t_liens_lie`
--
ALTER TABLE `t_liens_lie`
  ADD PRIMARY KEY (`lie_numero`),
  ADD KEY `t_lie_t_elt_FK` (`elt_numero`);

--
-- Index pour la table `t_news_new`
--
ALTER TABLE `t_news_new`
  ADD PRIMARY KEY (`new_numero`),
  ADD KEY `t_new_t_cpt_FK` (`cpt_pseudo`);

--
-- Index pour la table `t_presentation_pre`
--
ALTER TABLE `t_presentation_pre`
  ADD PRIMARY KEY (`pre_numero`),
  ADD KEY `t_pre_t_cpt_FK` (`cpt_pseudo`);

--
-- Index pour la table `t_selection_sel`
--
ALTER TABLE `t_selection_sel`
  ADD PRIMARY KEY (`sel_numero`),
  ADD KEY `t_sel_t_cpt_FK` (`cpt_pseudo`);

--
-- Index pour la table `t_utilisateur_uti`
--
ALTER TABLE `t_utilisateur_uti`
  ADD KEY `t_uti_t_cpt_FK` (`cpt_pseudo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_element_elt`
--
ALTER TABLE `t_element_elt`
  MODIFY `elt_numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `t_liens_lie`
--
ALTER TABLE `t_liens_lie`
  MODIFY `lie_numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `t_news_new`
--
ALTER TABLE `t_news_new`
  MODIFY `new_numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `t_presentation_pre`
--
ALTER TABLE `t_presentation_pre`
  MODIFY `pre_numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `t_selection_sel`
--
ALTER TABLE `t_selection_sel`
  MODIFY `sel_numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tj_sel_elt`
--
ALTER TABLE `tj_sel_elt`
  ADD CONSTRAINT `tj_sel_t_elt_FK` FOREIGN KEY (`elt_numero`) REFERENCES `t_element_elt` (`elt_numero`),
  ADD CONSTRAINT `tj_sel_t_sel_FK` FOREIGN KEY (`sel_numero`) REFERENCES `t_selection_sel` (`sel_numero`);

--
-- Contraintes pour la table `t_liens_lie`
--
ALTER TABLE `t_liens_lie`
  ADD CONSTRAINT `t_lie_t_elt_FK` FOREIGN KEY (`elt_numero`) REFERENCES `t_element_elt` (`elt_numero`);

--
-- Contraintes pour la table `t_news_new`
--
ALTER TABLE `t_news_new`
  ADD CONSTRAINT `t_new_t_cpt_FK` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_compte_cpt` (`cpt_pseudo`);

--
-- Contraintes pour la table `t_presentation_pre`
--
ALTER TABLE `t_presentation_pre`
  ADD CONSTRAINT `t_pre_t_cpt_FK` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_compte_cpt` (`cpt_pseudo`);

--
-- Contraintes pour la table `t_selection_sel`
--
ALTER TABLE `t_selection_sel`
  ADD CONSTRAINT `t_sel_t_cpt_FK` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_compte_cpt` (`cpt_pseudo`);

--
-- Contraintes pour la table `t_utilisateur_uti`
--
ALTER TABLE `t_utilisateur_uti`
  ADD CONSTRAINT `t_uti_t_cpt_FK` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_compte_cpt` (`cpt_pseudo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
