-- Activité 1 :
-- 1. récupérez, dans une variable, l’identifiant auto-incrémenté de la ligne du profil (/compte) nouvellement insérée dans la base pour pouvoir le réutiliser pour insérer le
compte d’un administrateur / invité
SET @mav := (SELECT MAX(par_id) FROM t_participant_par);
SELECT @mav;

-- 2.  Affectez à une variable @annee l’année de création d’un compte (ou de publication d’une actualité) la plus ancienne apparaissant dans la base de données.
SET @mav1 := (SELECT acte_date_de_pub FROM t_actualite_act WHERE act_id = 2);
SELECT @mav1;
-- Activité 2 :
-- 3.  créez une vue contenant uniquement les noms et prénoms du contenu de la table de gestion des profils.
CREATE VIEW NOM_PRENOM_ORG 
AS SELECT org_prenom, org_nom FROM t_organisateur_org; 
-- 4.  Visualisez alors le contenu de cette nouvelle vue :
SELECT * FROM NOM_PRENOM_ORG;
-- Activité 3 :
--  5. créez une fonction retournant l’âge du titulaire d’un profil d’après sa date de naissance passée en paramètre (ajoutez, en utilisant la commande ALTER TABLE, une colonne à votre table de gestion des profils si cela est nécessaire) :
DELIMITER // 
CREATE FUNCTION age(born DATE) RETURNS INT
BEGIN 
RETURN TIMESTAMPDIFF(YEAR, born,curdate());
END;
// DELIMITER ;
-- PS : Le dernier delimiter doit avoir un espace avcec la vrigule.

-- 6.  Appelez la fonction créée : 
SELECT age("1997-11-18");

-- Activité4 :
-- créez une procédure renvoyant l’âge du titulaire d’un profil en sortie à partir de son identifiant en entrée :

DELIMITER //
CREATE PROCEDURE age_profil (IN id_profil INT, OUT age YEAR)
BEGIN
SET @a := (SELECT pfl_date_naissance FROM t_profil_pfl WHERE pfl_id = id_profil);
SET age := (SELECT age_annee(@a));
END;
// DELIMITER ;

--  Utilisez la procédure créée pour connaître l’âge du titulaire d’un profil d’identifiant 1 dans la base de données.
CALL age_profil(1);

--  Puis écrivez une autre procédure utilisant la fonction créée dans l’activité 3 dans le but d’afficher le message « majeur » si le titulaire d’un profil a plus de 18 ans ou
-- « mineur » si le titulaire du profil a moins de 18 ans.
DELIMITER //
CREATE PROCEDURE majeur_mineur_profil(IN id INT,  OUT texte VARCHAR(20))
BEGIN
SET @a := (SELECT pfl_date FROM t_profil_pfl WHERE pfl_id = id_profil);
SET @age := (SELECT age_annee(@a));
IF @age >= 18 THEN
	SET texte := "Majeur";
ELSE 
	SET texte := "Mineur";
END IF;
END;
// DELIMITER ;

--  Créez une nouvelle vue contenant les noms, prénoms et âges des titulaires des profils du contenu de la table de gestion des profils, 
CREATE VIEW NOM_PRENOM_AGE_PFL AS
SELECT pfl_nom, pfl_prenom, (SELECT age_annee(pfl_date_naissance)) AS age FROM t_profil_pfl;

--  et créez une procédure qui renvoie en sortie l’âge moyen des profils dans la base.
DELIMITER //
CREATE PROCEDURE age_moyen_pfl(OUT moyen DOUBLE)
BEGIN
SET moyen := (SELECT AVG(age) FROM NOM_PRENOM_AGE_PFL);
END;
// DELIMITER ;

-- Activité 5 :
--  créez un « trigger » qui applique à la date de création du profil la date du jour d’insertion des données du nouveau profil.
DELIMITER //
CREATE TRIGGER date_jour_insertion_pfl
AFTER INSERT ON t_profil_pfl
UPDATE t_profil_pfl SET pfl_date_naissance = CURDATE( );
END;
//
DELIMITER ;

-- 
DELIMITER //
CREATE TRIGGER mise_ajour_modif1
AFTER UPDATE ON t_compte_cpt
FOR EACH ROW 
BEGIN
UPDATE t_profil_pfl SET pfl_date = CURDATE() 
WHERE pfl_id = NEW.pfl_id;
END;
// DELIMITER ; 

-- Test 2 declencheurs :
-- 1
INSERT INTO t_profil_pfl VALUES
(NULL, 'Abdou', 'Berte', 'abdou@berte', 'A', 'A', '1970-12-01', '1997-11-18');
-- 2
UPDATE t_compte_cpt set cpt_mot_de_passe = 'Nouveau mot de passe pour activer le trigger' WHERE pfl_id = vmarc;
