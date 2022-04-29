-- Activité 1 : 
-- Donnez tous les pseudos des organisateurs (administrateurs) et le texte des actualités qu’ils ont postées, s’il y en a.

SELECT cpt_login, act_texte FROM t_compte_cpt LEFT JOIN t_organisateur_org USING(cpt_login) LEFT JOIN t_actualite_act USING(org_id) WHERE cpt_etat = 'O'; 

--  Donnez à l’aide de deux méthodes différentes la liste de tous les pseudos des organisateurs (administrateurs) qui n’ont pas encore publié d’actualité
-- Methode 1:
SELECT cpt_login FROM t_organisateur_org
EXCEPT
SELECT cpt_login FROM t_compte_cpt JOIN t_organisateur_org USING(cpt_login) JOIN t_actualite_act USING(org_id);
-- Methode 2:
SELECT cpt_login FROM t_organisateur_org
WHERE cpt_login NOT IN(SELECT cpt_login FROM t_compte_cpt JOIN t_organisateur_org USING(cpt_login) JOIN t_actualite_act USING(org_id));
-- Methode 3:
SELECT cpt_login, act_texte FROM t_compte_cpt LEFT JOIN t_organisateur_org USING(cpt_login) LEFT JOIN t_actualite_act USING(org_id) WHERE cpt_etat = 'O' AND act_texte is NULL; 

-- Activité 2 :
--  Ecrire une fonction qui retourne la liste de tous les invités participant à une animation.
DELIMITER //
CREATE FUNCTION inviter_anim1(INT id_ani) RETURNS VARCHAR(5000)
BEGIN
SET @liste := (SELECT GROUP_CONCAT(DISTINCT inv_nom SEPARATOR "\n") 
FROM t_invite_inv JOIN tj_inv_ani USING(inv_id) JOIN t_animation_ani USING(ani_id) WHERE ani_id = id_ani);
RETURN @liste;
END;
// DELIMITER ;

--  Ecrire alors une procédure qui insère une actualité à la date d’aujourd’hui connaissant l’identifiant de l’animation et en précisant l’intitulé de l’animation, sa
-- date de début et de fin et la liste des invités prévus. L’auteur de l’actualité sera l’organisateur principal.
DELIMITER //
CREATE PROCEDURE ajout_actu_inv(IN id_anim INT)
BEGIN
SET @intitule := (SELECT ani_intitule FROM t_animation_ani WHERE ani_id = id_anim);
SET @date_debut:= (SELECT ani_date_debut FROM t_animation_ani WHERE ani_id = id_anim);
SET @date_fin := (SELECT ani_date_fin FROM t_animation_ani WHERE ani_id = id_anim);
SET @liste_inv :=  inviter_anim1(id_anim);
INSERT INTO t_actualite_act VALUES (NULL, 'INFO', concat('L\'animation', @intitule, 'débutera le', @date_debut, 'et prendra fin', @date_fin, 'avec comme invité', @liste_inv, 'venez massivement'), curdate(), 'P', 2);
END;
// DELIMITER ;

-- Testter la procedure
CALL ajout_actu_inv(2);

--  Puis, en réutilisant ce qui a été fait précédemment, créez un déclencheur (trigger) ajoutant une actualité dès l’ajout d’un invité à une animation.
DELIMITER //
CREATE TRIGGER ajout_actu_insert_inv
AFTER INSERT ON tj_inv_ani
FOR EACH ROW 
BEGIN 
CALL ajout_actu_inv(NEW.ani_id);
END;
// DELIMITER ;
-- Activer le trigger
INSERT INTO tj_inv_ani(8, _);

-- Activité 3 :  
-- Ecrivez une procédure qui renvoie en sortie le nombre d’animations déjà passées /
-- en cours / à venir.
DELIMITER //
CREATE PROCEDURE ani_pcv(OUT pas INT, OUT cur INT, OUT ven INT)
BEGIN 
SET pas := (SELECT count(ani_id) FROM t_animation_ani WHERE ani_date_fin < NOW());
SELECT count(ani_id) INTO cur FROM t_animation_ani WHERE NOW() BETWEEN ani_date_debut AND ani_date_fin;
SET ven := (SELECT count(ani_id) FROM t_animation_ani WHERE ani_date_debut > NOW());
END;
// DELIMITER ;

-- Test procedure
CALL ani_pcv(@p, @c, @v);
SELECT @p AS NB_ANI_PASSER, @c AS NB_ANI_COURS, @v AS NB_ANI_VENIR;
