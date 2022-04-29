-- Requête SQL PWE(Projet web event) :

-- Passeports / posts :

-- 1. Requête listant tous les passeports :
SELECT * FROM t_passeport_pas;

-- 2.  Requête listant tous les passeports associés à un invité dont connaît l’ID (ou n°) :
SELECT * FROM t_passeport_pas WHERE inv_id = "L'id de l'invité dans les guillements";

-- 3. Requête d’ajout d’un nouveau passeport
("id du passeport sans les guillements", "Nom du membre de l'entourage", "Mot de passe de son passeport", "L'invité à qui le passe est associé sans les guillements");

-- 4. Requête de modification d’un passeport :
UPDATE t_passeport_pas 
SET pas_mdp = "Nouveau mot de passe";

-- 5. Requête de désactivation d’un passeport :
-- Faut ajouté une colonne etat dans la table passeport 
-- Ajout d'une colonne etat pour désactiver ou activé les passeport 
ALTER TABLE t_passeport_pas ADD etat CHAR(1) NOT NULL; 
UPDATE t_passeport_pas 
SET etat = "D";


-- 6.  Requête de suppression d’un passeport :
-- Faut bien suppromer les post liée au passeport avant de supprimer son passeport !
DELETE FROM t_post_pst
WHERE pas_id = "L'id du pass sans les guillements";

DELETE FROM t_passeport_pas
WHERE pas_id = "L'id du pass sans les guillements";

-- 7. Requête listant tous les posts :
SELECT * FROM t_post_pst;

-- 8. Requête / code SQL d’ajout d’un post de 140 caractères maximum :
("l'id du post sans les guillements","Venez voir Guims sur scène, à l'ocassion d'un bal de promo, il sera en live rien que pour vous !", "L'id du passeport qui a fait l'jout sans les guillements");

-- 9. Requête de modération (désactivation) d’un post
-- Ajout d'une colonne etat pour désactiver ou activé les passeport 
ALTER TABLE t_post_pst ADD etat CHAR(1) NOT NULL; 

UPDATE t_post_pst 
SET etat = "D";

-- 10. . Requête de suppression d’un post en particulier :
DELETE FROM t_post_pst
WHERE post_id = "L'id du post sans les guillements";

-- 11.  Requête de suppression de tous les posts d’un invité en particulier :
DELETE FROM t_post_pst
WHERE pst_id IN (SELECT pst_id FROM t_post_pst JOIN t_passeport_pas USING(pas_id) WHERE inv_id = "L'id de l'invité sans les guillements");

-- Données des invités :

-- 4. Requête de mise à jour des données d'un invité : 
UPDATE t_invite_inv
SET 
inv_nom = "Nouveau nom de l'invité",
inv_discipline = "Nouvelle displine de l'invité",
inv_presentation = "Nouvelle presentation de l'invité",
inv_biographie = "Nouvelle biographie de l'invité",
inv_photo = "Nouveau chemin pour une nouvelle photo pour l'invité";

-- 6. Requête(s) / Code SQL de suppression des données d'un invité en particulier (connaissant son ID) :

-- Animations :

-- 7. Requête d'ajout d'une animation avec précision du lieu et du (des) invité(s) concerné(s) !
 
INSERT INTO t_animation_ani VALUES
('L\'id de l\'animation sans les guillements', "L\'intitulé de l\'animation", "La de de début de l\'animation", "La date de fin de l\'animation", 'l\'id du lieu de l\'animation sans les guillements');
 
INSERT INTO tj_inv_ani VALUES
('L\'id de l\'invité participant à l\'animation', 'L\'id de l\'animation participer par l\'invité');
-- PS EX de date : 2022-07-03T16:00:00.

-- 8. . Requête de mise à jour des données d'une animation dont on connaît l'ID :
UPDATE t_animation_ani
SET ani_intitule = 'Nouveau nom de l\'animation',
ani_date_debut = 'Nouvelle date de début',
ani_date_fin = 'Nouvelle date de fin'
WHERE ani_id = 'L\'id de l\'animation sans les guillements';

-- 9. Requête(s) de suppression de toutes les participations à des animations d'un invité en particulier (connaissant son ID) !?
DELETE FROM tj_inv_ani WHERE inv_id = 'L\id de l\'invité';

-- 10. Requête(s) / Code SQL de suppression des données d'une animation en particulier (connaissant son ID) !?
DELETE FROM tj_inv_ani WHERE ani_id = 'L\id de l\'animation sans les guillements';
DELETE FROM t_animation_ani WHERE ani_id = 'L\id de l\'animation sans les guillements';
-- OPTIONNEL : DELETE FROM t_lieu_lie WHERE ani_id = 'L\'id de l\'animation sans les guillements';
-- PS si d'autre animations sont rattaché à se lieu il ne faut pas le supprimer !

