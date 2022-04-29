-- Requête SQL PWE(Projet web event) :

--  Actualités :
-- Sprint1 :

-- 1.  Requête listant toutes les actualités de la table des actualités et leur auteur (login) : 
SELECT act_intitule, act_texte, cpt_login 
FROM t_actualite_act JOIN t_organisateur_org USING(org_id);

-- 2. Requête donnant les données d'une actualité dont on connaît l'identifiant (n°) :
SELECT * FROM t_actualite_act 
WHERE act_id = "Le nuéro de l'actualité sans les guillemets";

-- 3. Requête listant les 5 dernières actualités dans l'ordre décroissant :
SELECT * FROM t_actualite_act 
ORDER BY (act_id)
DESC
LIMIT 5;

-- 4. Requête recherchant et donnant la (ou les) actualité(s) contenant un mot particulier :
SELECT * FROM t_actualite_act 
WHERE act_texte LIKE("%Le mot à chercher sans enlever les pourcentages%");

-- 5. Requête listant toutes les actualités postées à une date particulière + le login de l’auteur :
SELECT act_intitule, act_texte, cpt_login FROM t_actualite_act JOIN t_organisateur_org USING(org_id) 
WHERE acte_date_de_pub = '2021-10-11';

-- Sprint3 :

-- 6. Requête d'ajout d'une actualité :
INSERT INTO t_actualite_act 
VALUES(6,"intitule", "texte de moins de 200 caractere", curdate(), "etat avec un seul caractere P(publié) ou B(brouillon)", 2);

-- 7 Requête listant toutes les actualités postées par un auteur particulier  (connaissant le login de l’administrateur connecté) :
SELECT act_intitule, act_texte, cpt_login 
FROM t_actualite_act JOIN t_organisateur_org USING(org_id)
WHERE cpt_login = "organisateur2";

-- 8 Requête qui compte les actualités ajoutées avant une date précise :
SELECT COUNT(*) as NB_ACTU FROM t_actualite_act 
WHERE acte_date_de_pub < "2021-10-16";

-- 9 Requête de modification d'une actualité :
UPDATE t_actualite_act 
SET act_intitule = "Pour modifier l'intitulé",
act_texte = "Pour modifier le texte qui ne doit pas depasser 200 charactère",
act_etat = "Pour modifier l'etat P (publier) B (brouillon)"
WHERE org_id = "L'id de l'organisateur sans les guillements";

-- 10.  Requête de suppression d'une actualité à partir de son ID (n°)
DELETE FROM t_actualite_act
WHERE act_id = "L'id de l'actualité sans les guillements";

-- 11. Requête supprimant toutes les actualités postées par un auteur particulie :
DELETE FROM t_actualite_act
WHERE act_id IN 
(SELECT act_id FROM t_actualite_act JOIN t_organisateur_org USING(org_id) 
WHERE cpt_login = "organisateur2");


-- Sprint2 :
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

-- Sprint1 :
-- 12.  Requête listant tous les posts associés à un invité particulier :
SELECT * FROM t_post_pst JOIN t_passeport_pas USING(pas_id) WHERE inv_id = "L'id de l'invité sans les guillements";

-- 13. . Requête listant tous les invités n’ayant pas de post :
SELECT DISTINCT inv_id FROM t_passeport_pas 
WHERE inv_id NOT IN (SELECT inv_id FROM t_post_pst JOIN t_passeport_pas USING(pas_id));

-- Profils (administrateurs / invité) :
-- Sprint1: 
-- 1. Requête listant toutes les données de tous les profils classés par statut : 
SELECT * FROM t_compte_cpt LEFT JOIN t_organisateur_org USING(cpt_login) LEFT JOIN t_invite_inv USING(cpt_login) ORDER BY cpt_etat;

-- 2. Requête de vérification des données de connexion (login et mot de passe) :
SELECT * FROM t_compte_cpt WHERE cpt_login = "Le login" AND cpt_mdp = "Le mot de passe";

-- 3. Requête récupérant les données d'un profil particulier (utilisateur connecté)
SELECT * FROM t_compte_cpt LEFT JOIN t_organisateur_org USING(cpt_login) LEFT JOIN t_invite_inv USING(cpt_login) WHERE cpt_login = "Le login de l'utilisateur";

-- 4 Requête de mise à jour du mot de passe d'un profil
UPDATE t_compte_cpt
SET cpt_mdp = "Nouveau mot de passe";

-- Sprint3 :
-- 5. Requête d'ajout des données d'un profil administrateur (/ invité)
-- Pour l'invité :
INSERT INTO t_invite_inv VALUES
("L'id de l'ivité sans guillements","Nom de l'invité", "Discipline", "Une presentation de 200 caractère maximum", "Une biographie de 300 caractère maximum", "chemin vers la photo" ,"login de l'invité crée dans la table compte");
-- Pour l'organisateur : 
INSERT INTO t_organisateur_org VALUES
("L'id de l'organisateur sans les guillemets","Nom de l'organisateur", "Prénom de l'organisateur", "Email de l'organisateur", "login de l'oragnisateur déjà definie dans la table compte");

-- 6. Requête / code SQL de vérification de l’existence (ou non) d’un profil administrateur (/ invité) associé à un compte dont on connaît l’D (ou n°) : 
-- A revoir parce qu'il n'y a pas de colonne id dans la table des comptes !

-- 7. Requête de désactivation d'un profil :
UPDATE t_compte_cpt LEFT JOIN t_organisateur_org USING(cpt_login) LEFT JOIN t_invite_inv USING(cpt_login)
SET cpt_etat = "A"
WHERE cpt_login = "Guims";

-- 8. Requête(s) de suppression d’un profil administrateur / invité et des données associées à ce profil (sans supprimer les données d’une animation démarrée !) : 
-- A réfaire !!

-- Données des invités :
-- Sprint1/Sprint2 :
-- 1. Requête listant toutes les données de tous les invités : 
SELECT * FROM t_invite_inv;

-- 2. Requête donnant les données d'un invité à partir de son ID (ou n°) : 
SELECT * FROM t_invite_inv
WHERE inv_id = "L'id de l'invité sans les guillements";


-- 3.  Requête(s) listant les données d'un invité à partir de son ID (ou n°) + toutes les animations auxquelles il participe :
SELECT inv_nom, ani_intitule FROM t_invite_inv JOIN tj_inv_ani USING(inv_id) JOIN t_animation_ani USING(ani_id)
WHERE inv_id = "L'id de l'invité sans les guillements";


-- 4. Requête de mise à jour des données d'un invité : 
UPDATE t_invite_inv
SET 
inv_nom = "Nouveau nom de l'invité",
inv_discipline = "Nouvelle displine de l'invité",
inv_presentation = "Nouvelle presentation de l'invité",
inv_biographie = "Nouvelle biographie de l'invité",
inv_photo = "Nouveau chemin pour une nouvelle photo pour l'invité";

-- 5. Requête de recherche d'un invité via un mot-clé contenu dans sa biographie :
SELECT * FROM t_invite_inv WHERE inv_biographie LIKE('%le mot à chercher dans la biographie%');


-- 6. Requête(s) / Code SQL de suppression des données d'un invité en particulier (connaissant son ID) :
-- A faire !!! 

-- Animations :
-- 1. Requête listant toutes les animations, leur lieu et le nom du (ou des) invité(s) : 
SELECT inv_nom, ani_intitule, lie_nom FROM t_invite_inv JOIN tj_inv_ani USING (inv_id) JOIN t_animation_ani USING(ani_id) JOIN t_lieu_lie USING(lie_id); 

-- 2. Requête qui récupère dans la table de gestion des animations les données d'une animation en particulier (connaissant son ID / son intitulé) :
SELECT * FROM t_animation_ani WHERE ani_id = 2;

-- 3. Requête donnant toutes les animations sur une plage horaire (ex : matin) :
-- A faire !!

-- 4. Requête donnant toutes les animations sur un lieu et une plage horaire
SELECT lie_nom, ani_intitule, ani_date_debut, ani_date_fin FROM t_lieu_lie JOIN t_animation_ani USING(lie_id);

-- 5. . Requête récupérant toutes les animations d'un invité (connaissant son ID) : 
SELECT * FROM t_invite_inv JOIN tj_inv_ani USING(inv_id) JOIN t_animation_ani USING(ani_id)
WHERE inv_id = 2;







-- 2. Requête donnant les données d'un invité à partir de son ID (ou n°) :
SELECT * FROM t_invite_inv WHERE inv_id = "L'id de l'invité sans les guillements";

-- 3. Requête(s) listant les données d'un invité à partir de son ID (ou n°) + toutes les animations auxquelles il participe



