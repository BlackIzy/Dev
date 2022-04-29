-- Comptes :

INSERT INTO t_compte_cpt VALUES
("organisateur", "org21**TNEVE", "O"),
("organisateur2", "Azerty_2022", "O"),
("Guims", "Azerty_2022", "I"),
("Dadju", "Azerty_2022", "I"),
("MS", "Azerty_2022", "I"),
("CC", "Azerty_2022", "I"),
("Twins", "Azerty_2022", "I"),
("EA", "Azerty_2022", "I"),
("Witty Crew", "Azerty_2022", "I"),
("Cauet", "Azerty_2022", "I");

-- Organisateurs 
INSERT INTO t_organisateur_org VALUES
(1,"Marc", "Valérie", "vm@univ-brest.fr", "organisateur"),
(2,"Berte", "Abdoulaye", "ab@etudiant-univ-brest.fr", "organisateur2");

-- Invités :
INSERT INTO t_invite_inv VALUES

(1,"Guims", "Rappeur", "Gims, de son vrai nom Gandhi Djuna, né le 6 mai 1986 à Kinshasa, est un auteur-compositeur-interprète et rappeur.", "Issue d'une famille musiciens.Il arrive en France à l'âge de 2 ans. A suivi des études de graphisme/communication", "photo" ,"Guims"),
(2,"Dadju","Rappeur",  "Dadju, de son nom complet Djuna Nsungula1, né le 2 mai 1991 à Bobigny, est un auteur-compositeur-interprète français.", "Issu de parents d’origine congolaise. Il fait partie d'une fratrie de 14 enfants, dont certains sont également chanteurs", "photo", "Dadju"),
(3,"Magic Système", "Zoglou",  "Magic System est un groupe de musique ivoirien de genre zouglou. Célèbre pour être interprète de chansons à thème festif", "Chanteurs Ivoirien, le groupe comptait plus de cinquantaine membres.Les membres actuels : Asalfo, Goudé, Tino et Manadja", "photo", "MS"),
(4,"Claudio Capéo", "Chanteur", "Claudio Ruccolo1 dit Claudio Capéo, né le 10 janvier 1985 à Mulhouse, est un chanteur et accordéoniste français", "Claudio Capéo est d'origine italienne.  Il apprend l'accordéon dès l'âge de six ans, À 16 ans il rejoint un groupe de metal qui s'essouffle quelque temps après. En 2008 il crée le groupe Claudio Capéo avec lequelle il sort deux albums...", "photo", "CC"), 
(5,"Les Twins", "Danseurs", "Les Twins sont un duo de danseurs-chorégraphes, chanteurs, acteurs et mannequins français, composé de Larry Bourgeois, alias Ca Blaze, et Laurent Bourgeois, alias Lil Beast.", "Nés à Sarcelles, dans la banlieue nord de Paris, le 6 décembre 1988, dans une famille de neuf frères et sœurs, et d'ascendance guadeloupéenne2, ils intègrent le groupe Criminalz crew créé à l'idée d'un groupe d'amis et danseurs originaire de la banlieue parisienne.","photo", "Twins"),
(6,"Eric Antoine", "Magicien", "Éric Antoine, né le 23 septembre 1976 à Enghien-les-Bains (Val-d'Oise), est un magicien-humoriste d'un nouveau genre, « humourillusioniste »1, et metteur en scène de théâtre2 français.", "Éric Antoine est l'aîné des trois enfants d'un père entrepreneur et d'une mère psychothérapeute d'origine italienne. Cet admirateur de Woody Allen s'inspire notamment de l'humour juif. Durant son adolescence, il souffre d'une crise de croissance. Souvent alité, il se passionne alors pour la magie.","photo", "EA");
(NULL, "Sébastien Cauet", "Présentateur", "Sébastien Cauet, surnommé simplement Cauet, né le 28 avril 1972 à Saint-Quentin, est un animateur français.", "Sébastien Jean Maurice Cauet, dit Cauet, est né le 28 avril 1972 à Saint-Quentin. Fils d'ouvriers de la sucrerie de Marle1. Cauet a passé son enfance à Marle (Aisne)", "photo", "Cauet");
-- Actualités :
INSERT INTO t_actualite_act VALUES
(1,"Présentation", "Notre Université à le plaisir de vous accueillir pour son bal de promo de fin d'année, qui se déroulera sur un weekend complet. Venez vous amusez.", curdate(), "A", 2),
(2,"Horaire", "Il commencera dès le vendredi, samedi, dimanchhe 18h et prendra fin à 02h du matin.", curdate(), "A", 2),
(3,"Reservation", "Vous pouvez prendre un ticket dès à présent sur se site web, ou appeler au numéro suivant : 06XXXXXX",curdate() ,"A", 2),
(4,"Objet trouvé", "Vous avez perdu quelque chose lors du bal ? Pas d'inquiétude vous pouvez appeler le numéro suivant pour savoir si elle se trouve dans les objets trouvé.",curdate(), "A", 2),
(5,"Invités", "Les invités prévue au bal sont au nombre de 6 plus un invités surprise, aller les découvrir dans la section invités.", curdate(), "A", 2);

-- RS : 
INSERT INTO t_reseau_social_rsl VALUES
(1,"Facebook", "https://www.facebook.com/gims/"),
(2,"Instagram", "https://www.instagram.com/gims/"),
(3,"Facebook", "https://fr-fr.facebook.com/DADJU"),
(4,"Instagram", "https://www.instagram.com/dadju/"),
(5,"Facebook", "https://fr-fr.facebook.com/MagicSystemOfficiel"),
(6,"Instagram", "https://www.instagram.com/magicsystemofficiel"),
(7,"Facebook", "https://fr-fr.facebook.com/claudiocapeo"),
(8,"Instagram", "https://www.instagram.com/claudiocapeo"),
(9,"Facebook", "https://www.facebook.com/OfficialLesTwins"),
(10,"Instagram", "https://www.instagram.com/officiallestwins"),
(11,"Facebook", "https://www.facebook.com/ericantoineoff"),
(12,"Instagram", "https://www.instagram.com/ericantoineoff"),
(13, "Facebook", "https://fr-fr.facebook.com/cauetofficiel"),
(14, "Instagram", "https://www.instagram.com/cauetofficiel");

-- Jointure Invités réseaux_social
INSERT INTO tj_inv_rsl VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 5),
(3, 6),
(4, 7),
(4, 8),
(5, 9),
(5, 10),
(6, 11),
(6, 12),
(7, 13),
(7, 14);

-- Passeports :
INSERT INTO t_passeport_pas VALUES
(1, "Manager_Guims", "Azerty_2022?Bal_de_promo", 1),
(2, "Attache_press_Guims", "Azerty_2022?Bal_de_promo", 1),
(3, "Manager_Dadju", "Azerty_2022?Bal_de_promo", 2),
(4, "Attache_press_Dadju", "Azerty_2022?Bal_de_promo", 2),
(5, "Manag_MagicS", "Azerty_2022?Bal_de_promo", 3),
(6, "Attache_press_MS", "Azerty_2022?Bal_de_promo", 3),
(7, "Manag_ClaudioC", "Azerty_2022?Bal_de_promo", 4),
(8, "Attache_press_CC", "Azerty_2022?Bal_de_promo", 4),
(9, "Manager_Twins", "Azerty_2022?Bal_de_promo", 5),
(10, "Attache_press_Twins", "Azerty_2022?Bal_de_promo", 5),
(11, "Manager_EricA", "Azerty_2022?Bal_de_promo", 6),
(12, "Attache_press_EricA", "Azerty_2022?Bal_de_promo", 6),
(13, "Manager_Cauet", "Azerty_2022?Bal_de_promo", 7),
(14, "Attache_press_Cauet", "Azerty_2022?Bal_de_promo", 7);

-- Post :
INSERT INTO t_post_pst VALUES
(NULL,"Venez voir Guims sur scène, à l'ocassion d'un bal de promo, il sera en live rien que pour vous !", 1),
(NULL,"Deux prestations auront lieux, une pendant le concert, et une durant la reception du bal, prenez vite le ticket VIP", 1),
(NULL,"Guims sera en plus avec son frère 'le prince Dadju' un moment unique pour deux grand rappeur pour vous aussi si vous êtes là :)", 1),
(NULL,"Après le covid19, notre artiste de retour sur scène pour un bal de fin d'année, raté pas cette occasion ;)", 2),
(NULL,"Venez nous soutenir masivement lors de ce bal de fin d'année", 2),
(NULL,"Venez voir Dadju sur scène, à l'ocassion d'un bal de promo, il sera en live rien que pour vous !", 3),
(NULL,"Deux prestations auront lieux, une pendant le concert, et une durant la reception du bal, prenez vite le ticket VIP", 3),
(NULL,"Dadju sera en plus avec son frère Guims un moment unique pour deux grand rappeur pour vous aussi si vous êtes là :)", 4),
(NULL,"Après le covid19, notre artiste de retour sur scène pour un bal de fin d'année, raté pas cette occasion ;)", 4),
(NULL,"Venez nous soutenir masivement lors de ce bal de fin d'année",  4),
(NULL,"Venez voir Magic Système sur scène, à l'ocassion d'un bal de promo, il seront en live rien que pour vous !", 5),
(NULL,"Deux prestations auront lieux, une pendant le concert, et une durant la reception du bal, prenez vite le ticket VIP",  5),
(NULL,"Magic Système au complet un moment unique pour ses zouglouman, pour vous aussi si vous êtes là :)",  5),
(NULL,"Après le covid19, nos zouglouman de retour sur scène pour un bal de fin d'année, raté pas cette occasion ;)", 6),
(NULL,"Venez nous soutenir masivement lors de ce bal de fin d'année",  6),
(NULL,"Venez voir Claudio Capéo sur scène, à l'ocassion d'un bal de promo, il sera en live rien que pour vous !", 7),
(NULL,"Deux prestations auront lieux, une pendant le concert, et une durant la reception du bal, prenez vite le ticket VIP", 7),
(NULL,"Claudio Capéo en live un moment unique à partager avec vous ses fans soyez présent", 8),
(NULL,"Après le covid19, notre artiste de retour sur scène pour un bal de fin d'année, raté pas cette occasion ;)", 8),
(NULL,"Venez nous soutenir masivement lors de ce bal de fin d'année",  8),
(NULL,"De la danse hip hop comme vous en avez jamais vue, un chaud à la auteur des Twins", 9),
(NULL,"Deux prestations auront lieux, une pendant le concert, et une durant la reception du bal, prenez vite le ticket VIP", 9),
(NULL,"Ëtre avec vous, pendant ce bal, tout en vous donnant le meilleur d'eux même, une promesse des Twins", 9),
(NULL,"Après le covid19, nos danseurs de retour sur scène pour un bal de fin d'année, raté pas cette occasion ;)", 10),
(NULL,"Venez nous soutenir masivement lors de ce bal de fin d'année", 10),
(NULL,"Eric Antoine pour un shox inédit rien que pour vous !", 11),
(NULL,"Deux prestations auront lieux, une pendant le concert, et une durant la reception du bal, prenez vite le ticket VIP", 11),
(NULL,"Ëtre avec vous, pendant ce bal, tout en vous donnant le meilleur d'eux même, une promesse d'Eric Antoine", 12),
(NULL,"Après le covid19, notre magicien de retour sur scène pour un bal de fin d'année, raté pas cette occasion ;)", 12),
(NULL,"Venez nous soutenir masivement lors de ce bal de fin d'année", 12),
(NULL,"Cauet pour un show inédit rien que pour vous !", 13),
(NULL,"Cauet votre animateur préféré sera présent tout au long du bal pour des prestations comme jamais, prenez vite le ticket VIP", 14);

-- Lieu :
INSERT INTO t_lieu_lie VALUES
(1,"Terrain de Foot", "G"),
(2,"Gymnase", "P"),
(3, "Salle de jeux", P);

-- Services :
INSERT INTO t_service_ser VALUES
(1,"Toilette publique", "Des toilettes publique sont installé en dehors du terrain de foot pour vos besoins", 1),
(2,"Food Truck", "Pour cette occasion on a fait appel à une des meilleur food truck du coin (les plats sont tous à base de crêpe hummm)", 1),
(3,"Sécurité", "Des gardes sont à l'entrée en cas d'emeute de bagarre pour votre sécurité", 1),
(4,"Infirmérie", "L'infirmérie de la faculté sera ouverte pour cette occasion, en cas de mal l'aise ou aurre....", 1),
(5,"Distributeur de billets", "Un distributeur de billet se trouve, derrière la route au cas ou !", 1),
(6,"Toilette", "Les toilettes du gysmnase sont à votre disposition pour vos besoins et merci de les gardés propres ;)", 2),
(7,"Bar", "Un bar est ouvert tout au long de la reception, allez y vous servir", 2),
(8,"Sécurité", "Des gardes seront à l'entrée pour votre sécurité, en cas de problème, vous pouvez aller les voir", 2),
(9,"Infirmérie", "L'infirmérie de la faculté sera ouverte pour cette occasion, en cas de mal l'aise ou aurre....", 2);

-- Animation : 
INSERT INTO t_animation_ani VALUES
(1,"Concert", "2022-07-01T12:00:00", "2022-07-02T02:00:00", 1),
(2,"Reception", "2022-07-02T18:00:00", "2022-07-03T02:00:00", 2),
(3, "Danse", "2022-07-03T16:00:00", "2022-07-03T20:00:00", 2),
(5, "Jeux", "2022-07-03T16:00:00", "2022-07-03T20:00:00", 3);
(4, "Hypnose", "2022-07-03T22:00:00", "2022-07-03T00:00:00", 2);

-- Table de jointure invités animation : 
INSERT INTO tj_inv_ani VALUES
(1,1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 3),
(6, 4),
(7, 1),
(7, 2),
(7, 3),
(7, 4);

-- Objet trouvés :
INSERT INTO t_objet_trouve_obt VALUES
(1,"Sac à dos", "Un sac à dos de couleur noir marque adidas", 1, NULL),
(2,"Collier", "Collier de couleur or", 1, NULL),
(3,"Blouson", "Blouson noir en cuire marque Dainese", 1, NULL), 
(4,"Sac à dos", "Un sac à dos de couleur bleu marque nike", 1, NULL),
(5,"Appareil photo", "Appareil photo canon", 2, NULL),
(6,"Téléphone", "Téléphone portable marque samsung", 2, NULL),
(7,"Ordinateur", "Ordinateur portable marque Asus", 2, NULL),
(8,"Sac à dos", "Un sac à dos de couleur rose marque hp", 2, NULL);

