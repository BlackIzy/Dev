-- Jointures
-- 1) Donnez les numéros et textes des éléments qui existent dans la base de données et les liens correspondants.

SELECT t_element_elt.elt_numero, t_element_elt.elt_descriptif, t_liens_lie.lie_titre
FROM t_element_elt JOIN t_liens_lie ON t_element_elt.elt_numero = t_liens_lie.elt_numero

-- 2) Donnez l’intitulé de l’élément auquel correspond le titre du lien contenant « grue ».
SELECT t_element_elt.elt_intitule
FROM t_element_elt JOIN t_liens_lie ON t_element_elt.elt_numero = t_liens_lie.elt_numero
WHERE lie_titre like '%grue%';

-- 3)a) Donnez les intitulés des liens associés à des éléments actifs (en ligne). 
SELECT t_liens_lie.lie_titre
FROM t_element_elt JOIN t_liens_lie ON t_element_elt.elt_numero = t_liens_lie.elt_numero
WHERE elt_etat like 'Publié';

-- 3)b) En utilisant la requête donnée à la question 3a), donnez les intitulés des liens des éléments cachés (qui ne sont pas en ligne).
SELECT t_liens_lie.lie_titre
FROM t_element_elt JOIN t_liens_lie ON t_element_elt.elt_numero = t_liens_lie.elt_numero
WHERE elt_etat like 'Brouillon';

-- 4) Donnez le nom, le prénom et le pseudo du profil associé à l'actualité d'identifiant « 2 ».
SELECT t_utilisateur_uti.uti_nom, t_utilisateur_uti.uti_prenom, t_utilisateur_uti.cpt_pseudo
FROM t_utilisateur_uti JOIN t_compte_cpt ON t_compte_cpt.cpt_pseudo = t_utilisateur_uti.cpt_pseudo JOIN t_news_new ON t_compte_cpt.cpt_pseudo = t_news_new.cpt_pseudo
WHERE t_news_new.new_numero = 2;

-- 5) Donnez les noms des profils qui n'ont pas encore posté d'actualité.
SELECT t_utilisateur_uti.uti_nom 
FROM t_utilisateur_uti
WHERE NOT IN (SELECT t_utilisateur_uti.uti_nom, t_utilisateur_uti.uti_prenom, t_utilisateur_uti.cpt_pseudo
FROM t_utilisateur_uti JOIN t_compte_cpt ON t_compte_cpt.cpt_pseudo = t_utilisateur_uti.cpt_pseudo JOIN t_news_new ON t_compte_cpt.cpt_pseudo = t_news_new.cpt_pseudo);

-- 6) Donnez le numéro, l’intitulé de toutes les sélections ajoutées par « vmarc » et ses éléments en ligne (publiés).
SELECT t_selection_sel.sel_numero, t_selection_sel.sel_titre
FROM t_selection_sel JOIN t_compte_cpt ON t_compte_cpt.cpt_pseudo = t_selection_sel.cpt_pseudo JOIN tj_sel_elt ON t_selection_sel.sel_numero = tj_sel_elt.sel_numero JOIN t_element_elt ON tj_sel_elt.elt_numero = t_element_elt.elt_numero
WHERE t_compte_cpt.cpt_pseudo LIKE 'vmarc' AND t_element_elt.elt_etat LIKE 'Publie';

-- 7) Donnez les URL des éléments associés aux sélections ajoutées par « Valérie MARC ».
SELECT t_selection_sel.sel_numero, t_liens_lie.lie_url
FROM t_utilisateur_uti JOIN t_compte_cpt ON t_compte_cpt.cpt_pseudo = t_utilisateur_uti.cpt_pseudo JOIN t_selection_sel ON t_compte_cpt.cpt_pseudo = t_selection_sel.cpt_pseudo JOIN tj_sel_elt ON t_selection_sel.sel_numero = tj_sel_elt.sel_numero JOIN t_element_elt ON tj_sel_elt.elt_numero = t_element_elt.elt_numero JOIN t_liens_lie ON t_element_elt.elt_numero = t_liens_lie.elt_numero
WHERE t_utilisateur_uti.uti_nom LIKE 'MARC' AND t_utilisateur_uti.uti_prenom LIKE 'Valérie';

-- Donnez la liste de tous les pseudos ayant ou non posté une actualité.
SELECT t_compte_cpt.cpt_pseudo 
FROM t_compte_cpt OUTER JOIN t_news_new ON t_compte_cpt.cpt_pseudo = t_news_new.cpt_pseudo

-- 8) Donnez la liste de tous les pseudos ayant ou non posté une actualité.
-- Gauche externe : 
SELECT * 
FROM t_compte_cpt LEFT JOIN t_news_new ON t_compte_cpt.cpt_pseudo = t_news_new.cpt_pseudo;
-- Droite externe : 
SELECT * 
FROM t_news_new RIGHT JOIN t_compte_cpt ON t_compte_cpt.cpt_pseudo = t_news_new.cpt_pseudo;

-- Requête sql : 
 -- 1. insérez un compte puis le profil associé en une seule manipulation !
INSERT INTO t_compte_cpt  VALUES
('squart', MD5(Fouine));
INSERT INTO t_utilisateur_uti VALUES 
('Squart1', 'Fouine', 's@mail.com', 'A', 'A',  curdate, squart);

-- 2. modifiez la validité d’un profil connaissant le pseudo de l'utilisateur.
UPDATE t_utilisateur_uti 
SET uti_valide = 'R'
WHERE cpt_pseudo = 'Azer1';

-- 3. Supprimez une ligne connaissant le pseudo d'un utilisateur.
DELETE FROM t_utilisateur_uti
WHERE cpt_pseudo = 'Azer1';

-- 4. a) Listez tous les noms, prénoms et statuts des utilisateurs suivant l'ordre alphabétique des noms de famille.
SELECT uti_nom, uti_prenom, uti_statut
FROM t_utilisateur_uti
ORDER BY (uti_nom) ASC;
-- b) Listez tous les noms, prénoms et statuts des utilisateurs rassemblés par statut.
SELECT uti_nom, uti_prenom, uti_statut
FROM t_utilisateur_uti
ORDER BY (uti_statut) ASC;

-- 5. Listez tous les noms, prénoms et @email des utilisateurs de statut 'R' (Rédacteurs) dans l'ordre alphabétique décroissant des prénoms.
SELECT uti_nom, uti_prenom, uti_statut, uti_mail
FROM t_utilisateur_uti
WHERE uti_staut = 'R'
ORDER BY (uti_prenom) DESC;

-- 6. listez le nom et le prénom des profils ajoutés en 2018,
SELECT uti_nom, uti_prenom
FROM t_utilisateur_uti
WHERE uti_date_de_creation like '%2018%';

-- 7. insérer la date du jour lors de l'ajout d’une sélection,
INSERT INTO t_selection_sel VALUES
(7, 'test', 'test123', curdate(), Azer);

-- 8. déterminez le numéro de la dernière actualité ajoutée et son texte,
SELECT new_numero, new_texte, max(new_date_de_publication)
FROM t_news_new;

-- 9. déterminez toutes les actualités ajoutées entre 2 dates à spécifier,
SELECT *
FROM t_news_new
WHERE new_date BETWEEN '2020-01-04' AND '2020-02-31';

-- 10.dénombrez les Responsables puis les Administrateurs,
SELECT COUNT(uti_statut)
FROM t_utilisateur_uti
WHERE uti_statut = 'A';
-- PS pour denombre les statut R suffit juste de changer le A en R

-- 11




--12
 SELECT *
 FROM t_compte_cpt
 JOIN t_utilisateur_uti ON cpt_pseudo
 WHERE cpt_pseudo = 'AZER'
 AND cpt_mot_de_passe = 'le mot de passe';
 
UPDATE t_element_elt, t_selection_sel
SET elt_intitule = 'Nouveau intitule',
elt_date_dajout = curdate(),
elt_descriptif = 'Nouvelle description',
elt_fichier_image = 'Chemin de l image',
elt_etat = 'Etat du nouveau element',
WHERE elt_numero = 'Numero de l element à modif' and sel_numero = 'Numero de la selection associe a l element à modif';