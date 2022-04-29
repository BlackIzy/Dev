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


-- Passeports / posts :

-- 12.  Requête listant tous les posts associés à un invité particulier :
SELECT * FROM t_post_pst JOIN t_passeport_pas USING(pas_id) WHERE inv_id = "L'id de l'invité sans les guillements";

-- OU

SELECT * FROM t_post_pst JOIN t_passeport_pas USING(pas_id) WHERE inv_nom = "Le nom de l'invité";


-- 13. . Requête listant tous les invités n’ayant pas de post :
SELECT * FROM t_passeport_pas 
WHERE inv_id NOT IN (SELECT inv_id FROM t_post_pst JOIN t_passeport_pas USING(pas_id));

-- OU

SELECT inv_nom FROM t_invite_inv
EXCEPT
SELECT inv_nom FROM t_invite_inv JOIN t_passeport_pas USING(inv_id) JOIN t_post_pst USING(pas_id); 

-- Profils (administrateurs / invité) :

-- 1. Requête listant toutes les données de tous les profils classés par statut : 
SELECT * FROM t_compte_cpt LEFT JOIN t_organisateur_org USING(cpt_login) LEFT JOIN t_invite_inv USING(cpt_login) ORDER BY cpt_etat;

-- 2. Requête de vérification des données de connexion (login et mot de passe) :
SELECT * FROM t_compte_cpt WHERE cpt_login = "Le login" AND cpt_mdp = "Le mot de passe";

-- 3. Requête récupérant les données d'un profil particulier (utilisateur connecté)
SELECT * FROM t_compte_cpt LEFT JOIN t_organisateur_org USING(cpt_login) LEFT JOIN t_invite_inv USING(cpt_login) WHERE cpt_login = "Le login de l'utilisateur";

-- 4 Requête de mise à jour du mot de passe d'un profil
UPDATE t_compte_cpt
SET cpt_mdp = "Nouveau mot de passe"
WHERE cpt_login = "Login de l'utilisateur";


-- Données des invités :

-- 1. Requête listant toutes les données de tous les invités : 
SELECT * FROM t_invite_inv;

-- 2. Requête donnant les données d'un invité à partir de son ID (ou n°) : 
SELECT * FROM t_invite_inv
WHERE inv_id = "L'id de l'invité sans les guillements";


-- 3.  Requête(s) listant les données d'un invité à partir de son ID (ou n°) + toutes les animations auxquelles il participe :
SELECT inv_nom, ani_intitule FROM t_invite_inv JOIN tj_inv_ani USING(inv_id) JOIN t_animation_ani USING(ani_id)
WHERE inv_id = "L'id de l'invité sans les guillements";


-- 5. Requête de recherche d'un invité via un mot-clé contenu dans sa biographie :
SELECT * FROM t_invite_inv WHERE inv_biographie LIKE('%le mot à chercher dans la biographie%');


-- Animations :

-- 1. Requête listant toutes les animations, leur lieu et le nom du (ou des) invité(s) : 
SELECT inv_nom, ani_intitule, lie_nom FROM t_invite_inv JOIN tj_inv_ani USING (inv_id) JOIN t_animation_ani USING(ani_id) JOIN t_lieu_lie USING(lie_id); 

-- 2. Requête qui récupère dans la table de gestion des animations les données d'une animation en particulier (connaissant son ID / son intitulé) :
SELECT * FROM t_animation_ani WHERE ani_id = "L'id de l'animation sans les guillements";

-- 3. Requête donnant toutes les animations sur une plage horaire (ex : matin) :
SELECT * FROM t_animation_ani 
WHERE ( HOUR(ani_date_debut) BETWEEN "11:00:00" AND "14:00:00" ) 
AND ( HOUR(ani_date_fin) BETWEEN "00:00:00" AND "02:00:00" ); 

-- 4. Requête donnant toutes les animations sur un lieu et une plage horaire
SELECT lie_nom, ani_intitule, ani_date_debut, ani_date_fin FROM t_lieu_lie JOIN t_animation_ani USING(lie_id)
WHERE lie_nom = "Le nom de l'animation ex = Terrain de Foot" AND ( HOUR(ani_date_debut) BETWEEN "11:00:00" AND "14:00:00" ) 
AND ( HOUR(ani_date_fin) BETWEEN "00:00:00" AND "02:00:00" ); 

-- 5. Requête récupérant toutes les animations d'un invité (connaissant son ID) : 
SELECT * FROM t_invite_inv JOIN tj_inv_ani USING(inv_id) JOIN t_animation_ani USING(ani_id)
WHERE inv_id = "L'id de l'invité";

-- 6. Requête qui liste les animations collectives + nom des invités :
SELECT ani_intitule, GROUP_CONCAT(inv_nom), COUNT(ani_id) 
FROM t_invite_inv JOIN tj_inv_ani USING(inv_id) JOIN t_animation_ani USING(ani_id)
GROUP BY ani_intitule
HAVING COUNT(ani_id) > 1;



-- Lieux/Services :
-- 1. Requête donnant tous les lieux :
SELECT * FROM t_lieu_lie;


-- 2. Requête donnant les caractéristiques d'un lieu connu par son nom ou son ID :
SELECT * FROM t_lieu_lie WHERE lie_id = "L'id sans les guillements";
SELECT * FROM t_lieu_lie WHERE lie_nom = "Le nom du lieu";


-- 3. Requête qui récupère tous les services pour un lieu sélectionné en particulier :
SELECT * FROM t_lieu_lie JOIN t_service_ser USING(lie_id)
WHERE lie_id = "L'id sans les guillements";

-- OU 

SELECT * FROM t_lieu_lie JOIN t_service_ser USING(lie_id)
WHERE lie_nom = "Le nom du lieu";

-- 4. Requête qui liste tous les lieux sans service :
SELECT lie_nom FROM t_lieu_lie
EXCEPT
SELECT lie_nom FROM t_lieu_lie JOIN t_service_ser USING(lie_id);

-- OU

SELECT * FROM t_lieu_lie 
WHERE lie_id NOT IN(SELECT lie_id FROM t_lieu_lie JOIN t_service_ser USING(lie_id)); 


-- 5. Requête qui liste toutes les animations sur un lieu particulier :
SELECT * FROM t_lieu_lie JOIN t_animation_ani USING(lie_id) WHERE lie_id = "L'id sans les guillements";
   





