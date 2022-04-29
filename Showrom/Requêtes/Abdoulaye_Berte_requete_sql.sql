-- Requêtes SQL pour l'application Showroom : 

-- Profils et comptes :
-- 1. Requêtes d'ajout des données d'un profil + compte associé :

INSERT INTO t_utilisateur_uti VALUES 
('Squart1', 'Fouine', 's@mail.com', 'A', 'A',  curdate(), 'squart');
INSERT INTO t_compte_cpt  VALUES
('squart', MD5('Fouine'));

-- 2. Requête de vérification des données de connexion (pseudo et mot de passe) : 
 SELECT *
 FROM t_compte_cpt
 JOIN t_utilisateur_uti  USING(cpt_pseudo)
 WHERE cpt_pseudo = 'Le pseudo de l utilisateur'
 AND cpt_mot_de_passe = MD5('le mot de passe');
 
 -- OU
 SELECT COUNT(*) AS VERIFICATION 
 FROM t_compte_cpt
 JOIN t_utilisateur_uti  USING(cpt_pseudo)
 WHERE cpt_pseudo = 'Le pseudo de l utilisateur'
 AND cpt_mot_de_passe = MD5('le mot de passe');
 
 -- 3. Requête de récupération de toutes les données d'un profil (dont on connaît le pseudo) :
 SELECT *
 FROM t_utilisateur_uti
 WHERE cpt_pseudo = 'Le pseudo de l utilisateur';
 
 -- 4. Requête permettant de connaître le statut d’un utilisateur dont on connaît le nom et le prénom :
 SELECT uti_statut
 FROM t_utilisateur_uti
 WHERE uti_nom = 'Nom de utilisateur' and uti_prenom = 'Prenom de l utilisateur';
 
 -- 5. Requête de modification des données d'un profil (pseudo connu) :
 -- a) Modifier toutes les colonnes de la table Utilisateur :  
UPDATE t_utilisateur_uti
SET uti_nom = 'Nouveau nom',
uti_prenom = 'Nouveau prenom',
uti_statut = 'Nouveau statut',
uti_valide = 'Nouvelle validite',
uti_date_de_creation = curdate(), -- Date de modif
cpt_pseudo = 'Nouveau pseudo',
WHERE cpt_pseudo = 'Le pseudo à modif';
-- b) Modifier une seule colonne de la table Utilisateur :
-- PS : après SET le nom de la colonne à modifier, dans mon cas le nom 
UPDATE t_utilisateur_uti
SET uti_nom = 'Nom à deternimer'
WHERE cpt_pseudo = 'Le pseudo à modif';

-- 6. Requête de mise à jour du mot de passe d'un compte (pseudo connu)
UPDATE t_compte_cpt
SET cpt_mot_de_passe = MD5('Le nouveau mot de passe')
WHERE cpt_pseudo = 'Le pseudo à modif';

-- 7. Requête listant toutes les données des profils + comptes associés
SELECT * 
FROM t_utilisateur_uti JOIN t_compte_cpt USING(cpt_pseudo);

-- 8. Requête de validation d'un profil (pseudo connu)
UPDATE t_utilisateur_uti
SET uti_valide = 'A' -- A pour active, D pour desactive
WHERE cpt_pseudo = 'Le pseudo à validé';

-- 9. Requête de désactivation (/activation) d'un profil (pseudo connu)
UPDATE t_utilisateur_uti
SET uti_valide = 'D' -- A pour active, D pour desactive
WHERE cpt_pseudo = 'Le pseudo à validé';

--  Présentation :

-- 10. Requête d’ajout des informations de la structure
INSERT INTO t_presentation_pre VALUES
(NULL,'IZY', '12  rue marques izy', 'izy@mail.com', '0204620246', '24/24', 'Bienvenue sur notre site internet Izy la marque de la fabrique', 'gestionnaire1');

-- 11. Requête vérifiant qu’il n’y a qu’une seule ligne dans la table de gestion de la présentation
SELECT COUNT(pre_numero) AS nombre_de_ligne
FROM t_presentation_pre;

-- 12. Requête donnant les informations sur la structure
SELECT *
FROM t_presentation_pre;

-- 13. Requête de modification de l’adresse, du n° de téléphone et de l’adresse e-mail de la structure
UPDATE t_presentation_pre
SET pre_adresse = 'Nouvelle adresse',
pre_tel = 'Nouveau numero',
pre_mail = 'Nouevelle email';

-- 14. Requête de suppression de toutes les informations de la structure
DELETE FROM t_presentation_pre;

--  Actualités :

-- 15. Requête d'ajout d'une actualité
INSERT INTO t_news_new VALUES
(NULL,'Solde', 'Les soldes hivernal sont en cours allez vite regardez',NOW(), 'En ligne', 'gestionnaire1');

-- 16. Requête donnant la dernière actualité ajoutée
SELECT *
FROM t_news_new
WHERE new_numero IN (SELECT MAX(new_numero) FROM t_news_new);

-- 17. Requête listant toutes les actualités et leur auteur
SELECT *
FROM t_utilisateur_uti JOIN t_news_new USING(cpt_pseudo);

-- 18. Requête listant les 5 dernières actualités ajoutées et leur auteur
SELECT new_numero, new_titre, uti_nom, uti_prenom, t_utilisateur_uti.cpt_pseudo
FROM t_utilisateur_uti JOIN t_news_new USING(cpt_pseudo)
ORDER BY new_numero DESC
LIMIT 5;

-- 19. Requête de modification d'une actualité
UPDATE t_news_new
SET new_titre = 'Le nouveau titre',
new_texte = 'La nouvelle description',
new_date_de_publication = 'La nouvelle date de publication',
new_etat = 'Le nouvelle etat en ligne ou pas',
cpt_pseudo = 'Le pseudo de la personne qui modifie l actu'
WHERE new_numero = 'Le numero de l actu à modifie sans les entrecote';

-- 20. Requête de suppression d'une actualité à partir de son ID (n°)
DELETE FROM t_news_new
WHERE new_numero = 'Le numero de l actu sans les entrecote';

-- 21. Requête de désactivation de toutes les actualités publiées avant une certaine date
UPDATE t_news_new
SET new_etat = 'Pas en ligne'
WHERE new_date_de_publication < 'La date de publication à mettre dans le format 2021-02-04';



-- Sélections / éléments (+ liens) :

-- 22. Requête d'ajout d'une sélection
INSERT INTO t_selection_sel VALUES 
(NULL,'Nom de la selection', 'Texte introductive', curdate(), 'pseudo de la personne qui ajoute');

-- 23. Requête listant tous les éléments d’une sélection particulière
SELECT *
FROM t_selection_sel JOIN tj_sel_elt USING(sel_numero) JOIN t_element_elt USING(elt_numero)
WHERE sel_titre = 'La selection particulière à mettre ici';

-- 24. Requête comptant le nombre de sélections qui existent dans la base de données
SELECT COUNT(sel_numero) AS NB_SELECTION
FROM t_selection_sel;

-- 25. Requête listant toutes les sélections et leurs éléments éventuels (+ lien(s))
SELECT *
FROM t_selection_sel LEFT JOIN tj_sel_elt USING(sel_numero) LEFT JOIN t_element_elt USING(elt_numero) LEFT JOIN t_liens_lie USING(elt_numero);

-- 26. Requête de modification d'une sélection
UPDATE t_selection_sel
SET sel_titre = 'Le nouveau titre',
sel_texte_introductive = 'Nouvelle description',
sel_date_dajout = curdate(),
cpt_pseudo = 'Le pseudo qui a fait la modif'
WHERE sel_numero = 'Le numero de la selection à modifie';

-- 27. Requête(s) de suppression d'une sélection à partir de son identifiant (ID)
DELETE t_selection_sel
WHERE sel_numero = 'Le numero de la selection à supprimer';

-- 28. Requête listant toutes les sélections qui n’ont pas d’élément associé
SELECT sel_titre
FROM t_selection_sel
EXCEPT
SELECT sel_titre
FROM t_selection_sel JOIN tj_sel_elt USING(sel_numero) JOIN t_element_elt USING(elt_numero);

-- 29. Requête récupérant toutes les données d’un élément dont on connaît l’identifiant (ID)
SELECT *
FROM t_element_elt
WHERE elt_numero = 'identifiant de l element';

-- 30. Requête d'ajout d'un élément pour une sélection particulière (ID connu)
-- ajout de l'element
INSERT INTO t_element_elt VALUES
(NULL,'Nom de l element', 'description de l element', curdate(), 'lien de l image' , 'etat');
-- correspondance avec la selection
INSERT INTO tj_sel_elt VALUES 
(numero de la selection, numero de l element);

-- 31. Requête(s) de suppression d'un élément particulier (ID connu)
DELETE FROM tj_sel_elt
WHERE sel_numero = 'numero de la selection à effacer de la table sans entrecote' and elt_numero = 'numero de l element à effacer de la table sans entrecote';
DELETE FROM t_element_elt
WHERE elt_numero = 'numero de l element';

-- 32. Requête donnant l’ID de l’élément suivant connaissant l’ID de l’élément actuel choisi dans une sélection d’ID connu
-- Element suivant
SELECT elt_numero 
FROM t_selection_sel JOIN tj_sel_elt USING(sel_numero) JOIN t_element_elt USING(elt_numero)
WHERE sel_numero = 'Numero de la selection' and elt_numero > 'Numero de l element'
LIMIT 1;
-- Element precedent
SELECT elt_numero 
FROM t_selection_sel JOIN tj_sel_elt USING(sel_numero) JOIN t_element_elt USING(elt_numero)
WHERE sel_numero = 'Numero de la selection' and elt_numero < 'Numero de l element'
LIMIT 1;

-- 33. Requête de modification d'un élément d'une sélection particulière (ID connus)
UPDATE t_element_elt, t_selection_sel
SET elt_intitule = 'Nouveau intitule',
elt_date_dajout = curdate(),
elt_descriptif = 'Nouvelle description',
elt_fichier_image = 'Chemin de l image',
elt_etat = 'Etat du nouveau element'
WHERE elt_numero = 'Numero de l element à modif' and sel_numero = 'Numero de la selection associe a l element à modif';

-- 34. Requête(s) de suppression de tous les éléments d’une sélection particulière (ID connu)
DELETE FROM tj_sel_elt
WHERE sel_numero = 'Numero de la selection pour effacer les jointure faites';
DELETE FROM t_element_elt
WHERE elt_numero IN (SELECT elt_numero FROM t_selection_sel JOIN tj_sel_elt USING(sel_numero) JOIN t_element_elt USING(elt_numero) WHERE sel_numero = 'Numero de la selection');

-- 35. Requête de suppression de toutes les sélections n’ayant pas d’élément associé
DELETE FROM t_selection_sel
WHERE sel_numero NOT IN (SELECT sel_numero FROM t_selection_sel JOIN tj_sel_elt USING(sel_numero) JOIN t_element_elt USING(elt_numero));

-- 36. Requête de désactivation (remise à l’état brouillon) d’un élément particulier (ID connu)
UPDATE t_element_elt
SET elt_etat = 'Brouillon'
WHERE elt_numero = 'Numero de l element à modifie';

-- 37. Requête cachant tous les éléments ajoutés par un utilisateur particulier dont on connaît le pseudo
UPDATE t_element_elt, t_compte_cpt
SET elt_etat = 'Brouillon'
WHERE cpt_pseudo = 'gestionnaire1';

-- 38. Requête qui récupère toutes les données associées (sans oublier les liens) à une sélection particulière dont on connaît l’identifiant (ID)
SELECT *
FROM t_selection_sel LEFT JOIN tj_sel_elt USING(sel_numero) LEFT JOIN t_element_elt USING(elt_numero) LEFT JOIN t_liens_lie USING(elt_numero)
WHERE sel_numero = 'Numero de la selection';

-- 39. Requête ajoutant un lien pour l’élément choisi
INSERT INTO t_liens_lie VALUES
(NULL,'Page facebook', 'https://fr-fr.facebook.com/', 'gestionnaire1', curdate(), 14);

-- 40. Requête de suppression d’un lien dont on connaît l’URL
DELETE FROM t_liens_lie
WHERE lie_url = 'URL à effacer';

-- 41. Requête listant toutes les URL des liens de la base, sans redondance
SELECT DISTINCT lie_url
FROM t_liens_lie;

-- 42. Requête listant tous les éléments, leur sélection et les URL des liens, s’il y en a
SELECT *
FROM t_selection_sel LEFT JOIN tj_sel_elt USING(sel_numero) LEFT JOIN t_element_elt USING(elt_numero) LEFT JOIN t_liens_lie USING(elt_numero);

-- 43. Requête listant les URL des liens associés à un élément dont on connaît l’identifiant (ID)
SELECT lie_url
FROM t_element_elt JOIN t_liens_lie USING(elt_numero)
WHERE elt_numero = 'Numero de l element';

-- 44. Requête qui vérifie l’existence (ou non) d’une URL d’un lien parmi les URL qui existent
SELECT COUNT(*)
FROM t_liens_lie 
WHERE lie_url = 'URL à verifier';







