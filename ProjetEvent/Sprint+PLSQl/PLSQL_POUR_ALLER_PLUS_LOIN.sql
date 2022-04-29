-- Activité 4 :
--  Trigger 1
-- Créez un trigger qui, suite à la modification des données d’une animation, insère une
-- nouvelle actualité dans la table de gestion des actualités en annonçant la modification
-- dans le texte de la nouvelle actualité.

DELIMITER // 
CREATE TRIGGER insert_actu_anim
AFTER UPDATE ON t_animation_ani
FOR EACH ROW
BEGIN

IF NEW.ani_intitule != OLD.ani_intitule && NEW.ani_date_debut = OLD.ani_date_debut && NEW.ani_date_fin = OLD.ani_date_fin THEN
	INSERT INTO t_actualite_act VALUES
	(NULL, 'INFO ANIMATION', concat('L\'intitulé de l\'animation ', OLD.ani_intitule, ' à été changer en ', NEW.ani_intitule), NOW(), 'P', 1);
	
	
ELSEIF NEW.ani_intitule = OLD.ani_intitule && NEW.ani_date_debut != OLD.ani_date_debut && NEW.ani_date_fin = OLD.ani_date_fin THEN 
	INSERT INTO t_actualite_act VALUES
	(NULL, 'INFO ANIMATION', concat('ATTENTION la date de début de l\'animation ', OLD.ani_intitule, ' à été modifier, elle commencera donc à ', NEW.ani_date_debut), NOW(), 'P', 1);
	

ELSEIF NEW.ani_intitule = OLD.ani_intitule && NEW.ani_date_debut = OLD.ani_date_debut && NEW.ani_date_fin != OLD.ani_date_fin THEN 
	INSERT INTO t_actualite_act VALUES
	(NULL, 'INFO ANIMATION', concat('ATTENTION la date de fin de l\'animation', OLD.ani_intitule, 'à été modifier, elle prendra fin à', NEW.ani_date_fin), NOW(), 'P', 1);
	

ELSEIF NEW.ani_intitule != OLD.ani_intitule && NEW.ani_date_debut != OLD.ani_date_debut && NEW.ani_date_fin = OLD.ani_date_fin THEN 
	INSERT INTO t_actualite_act VALUES
	(NULL, 'MODIFICATION MAJEUR ', concat('L\'intitulé de l\'animation ', OLD.ani_intitule, ' à été changer en ', NEW.ani_intitule, ' ET  sa date de début ', OLD.ani_date_debut, ' à été modifier, elle commencera donc à ', NEW.ani_date_debut), NOW(), 'P', 1);


ELSEIF NEW.ani_intitule != OLD.ani_intitule && NEW.ani_date_debut = OLD.ani_date_debut && NEW.ani_date_fin != OLD.ani_date_fin THEN 
	INSERT INTO t_actualite_act VALUES
	(NULL, 'MODIFICATION MAJEUR ', concat('L\'intitulé de l\'animation ', OLD.ani_intitule, ' à été changer en ', NEW.ani_intitule, ' ET  sa date de fin ', OLD.ani_date_fin, ' à été modifier, elle prendra fin à ', NEW.ani_date_fin), NOW(), 'P', 1);

ELSEIF NEW.ani_intitule = OLD.ani_intitule && NEW.ani_date_debut != OLD.ani_date_debut && NEW.ani_date_fin != OLD.ani_date_fin THEN 
	INSERT INTO t_actualite_act VALUES
	(NULL, 'MODIFICATION MAJEUR ', concat('La date de début de l\'animation ', OLD.ani_intitule, ' à été modifier elle debutera à ', NEW.ani_date_debut, ' et sa date de fin qui était à ', OLD.ani_date_fin, ' à été modifier, elle prendra fin à ', NEW.ani_date_fin), NOW(), 'P', 1);		

ELSEIF NEW.ani_intitule != OLD.ani_intitule && NEW.ani_date_debut != OLD.ani_date_debut && NEW.ani_date_fin != OLD.ani_date_fin THEN 
	INSERT INTO t_actualite_act VALUES
	(NULL, 'MODIFICATION MAJEUR ', concat('L\'intitulé de l\'animation ', OLD.ani_intitule, ' à été changer en ', NEW.ani_intitule, ', sa date de début ', OLD.ani_date_debut, ' à été modifier, elle commencera donc à ', NEW.ani_date_debut, ' et sa date de fin ',OLD.ani_date_fin, ' à été modifier, elle prendra fin à ', NEW.ani_date_fin), NOW(), 'P', 1);
	
ELSE
	DELETE FROM t_actualite_act WHERE act_date_de_pub = NOW();
END IF;	
END; 
// DELIMITER ;

-- Test quand il n'y a pas eu de mofication 
UPDATE t_animation_ani SET ani_intitule = 'Concert' WHERE ani_intitule = 'Concert';

-- Test quand l'intitulé est modifier
UPDATE t_animation_ani SET ani_intitule = 'Concert1' WHERE ani_intitule = 'Concert';

-- Test quand la date de début est modifié 
UPDATE t_animation_ani SET ani_date_debut = '2021-11-01 00:00:00' WHERE ani_intitule = 'Concert1';

-- Test quand la date de fin est maudifié
UPDATE t_animation_ani SET ani_date_fin = '2021-11-01 00:00:00' WHERE ani_intitule = 'Concert1';

-- Test quand la date de début et l'intitulé sont modifié
UPDATE t_animation_ani SET 
ani_date_fin = '2021-12-02 00:00:00',
ani_intitule = 'Concert2'
WHERE ani_intitule = 'Concert1';

-- Test quand la date de fin et l'intitulé sont modifié 
UPDATE t_animation_ani SET 
ani_date_fin = '2021-12-04 00:00:00',
ani_intitule = 'Concert3'
WHERE ani_intitule = 'Concert2';

-- Test quand la date de fin et la date de début sont modifié
UPDATE t_animation_ani SET 
ani_date_fin = '2021-12-05 00:00:00',
ani_date_debut = '2021-11-07 00:00:00'
WHERE ani_intitule = 'Concert3';

-- Test quand les trois champs sont modifié 
UPDATE t_animation_ani SET 
ani_date_fin = '2021-12-02 00:00:00',
ani_date_debut = '2021-12-07 00:00:00',
ani_intitule = 'Concert4'
WHERE ani_intitule = 'Concert3';

-- Trigger 2 
-- Créez un trigger qui suite à la suppression d’une animation programmée, supprime, dans
-- la table des actualités, toutes celles qui font référence (« parlent ») à l’animation
-- concernée (normalement, l’intitulé de l’animation concernée apparaît dans le texte des
-- actualités, cf activités précédentes).

DELIMITER //
CREATE TRIGGER supp_actu_anim
AFTER DELETE ON t_animation_ani
FOR EACH ROW
BEGIN
DELETE FROM t_actualite_act WHERE act_texte LIKE concat('%',OLD.ani_intitule,'%');
END;
// DELIMITER ;

-- Test trigger 2 :
DELETE FROM tj_inv_ani WHERE ani_id = 1;
DELETE FROM t_animation_ani WHERE ani_id = 1;

-- Activité 5 :
-- Préparez plusieurs vues, procedures, fonctions, triggers pour votre base de données (au moins une de chaque par étudiant).

-- Mon activité 5 rassemble 5 vues, 4 procedures dont 2 pour une levée d'exeption, 2 fonctions et 7 triggers.

-- PS : L'appel à mes lévées d'exception fonction mais en l'utilisant dans un trigger le message d'erreur ne s'affiche pas 
-- PS : En utilisant le delete à la place de l'appel d'exception dans le trigger 8 un message d'erreur est affiché 
-- 1. une vue des invités et leurs reseaux sociaux
CREATE VIEW invite_reseau AS 
SELECT inv_nom, inv_discipline, rsl_nom, rsl_url FROM t_invite_inv JOIN tj_inv_rsl USING(inv_id) JOIN t_reseau_social_rsl USING(rsl_id);
-- Test 1.
-- SELECT * FROM invite_reseau;

-- 2. une vue des objets trouvés et leurs lieux associés :
CREATE VIEW lieu_objet AS 
SELECT lie_nom, obt_nom, obt_descriptif FROM t_objet_trouve_obt JOIN t_lieu_lie USING(lie_id);
--Test 2.
-- SELECT * FROM lieu_objet;

-- 3. une vue des lieux et leurs services associés :
CREATE VIEW lieu_service AS
SELECT lie_nom, ser_nom, ser_descriptif FROM t_lieu_lie JOIN t_service_ser USING(lie_id);
-- Test 3.
-- SELECT * FROM lieu_service

-- 4. une vue des invités et du nombres de passeport leurs etant associés :
CREATE VIEW t_invit_nbpass AS
SELECT inv_nom, count(pass_id) FROM t_invite_inv JOIN t_passeport_pas USING(inv_id) GROUP BY inv_nom;
-- Test4. 
-- SELECT * FROM t_invit_nbpass;

-- 5. une vue des passeports avec tout les posts leurs etant associés :
CREATE VIEW pass_post AS
SELECT pass_id, pst_mssg FROM t_passeport_pas JOIN t_post_pst USING(pas_id);
-- Test5.
-- SELECT * FROM pass_post;

-- 6. une procedure qui génère une exception avec un message d'erreur 
CREATE PROCEDURE error_post()
BEGIN
   DECLARE EXIT HANDLER
   FOR 1146
   BEGIN
      SIGNAL SQLSTATE '45000' SET
      MESSAGE_TEXT = 'L''ajout de certain mots ne sont pas tolérer merci de révoir votre post !';
   END;
   -- this will produce a 1146 error
	SELECT `c` FROM `temptab`;
END;
-- Test 6.
CALL error_post();

-- 7. un trigger qui empêche l'insertion d'un post si le post contient certain mots avec l'appel à la procedure error_post
DELIMITER // 
CREATE TRIGGER avant_ajout_post1 
BEFORE INSERT ON t_post_pst
FOR EACH ROW 
BEGIN 
IF NEW.pst_mssg LIKE('%connerie%') OR NEW.pst_mssg LIKE('%con%') OR NEW.pst_mssg LIKE('%bête%') OR NEW.pst_mssg LIKE('%idiot%') OR NEW.pst_mssg LIKE('%impoli%') 
THEN 
	CALL error_post();
END IF;
END;
// DELIMITER ;  
-- Test 7.
INSERT INTO t_post_pst VALUES
(1,'Dadju est impoli !', 1);

-- 8. Le même trigger que la 7 mais avec un delete au lieu d'une exception lévée 
DELIMITER // 
CREATE TRIGGER avant_ajout_post2 
AFTER INSERT ON t_post_pst
FOR EACH ROW 
BEGIN 
IF NEW.pst_mssg LIKE('%connerie%') OR NEW.pst_mssg LIKE('%con%') OR NEW.pst_mssg LIKE('%bête%') OR NEW.pst_mssg LIKE('%idiot%') OR NEW.pst_mssg LIKE('%impoli%') 
THEN 
	DELETE FROM t_post_pst WHERE pst_id = NEW.pst_id;
END IF;
END;
// DELIMITER ;  
-- Test 8.
INSERT INTO t_post_pst VALUES
(1,'Dadju est impoli !', 1);

-- 9. un trigger qui après l'insertion d'un objet trouvé l'affiche dans la liste des actualités
DELIMITER //
CREATE TRIGGER insert_objet_act 
AFTER INSERT ON t_objet_trouve_obt
FOR EACH ROW 
BEGIN 
INSERT INTO t_actualite_act VALUES 
(NULL, concat('OBJECT TROUVER N°', NEW.obt_id), concat('L\'objet  ', NEW.obt_nom, ' à été trouver avec la description suivante : ', NEW.obt_descriptif, ' pour le récupérer veiller contacter le service des objets trouvés.'), NOW(), 'P', 1);
END;
// DELIMITER ;
-- Test 9. 
 INSERT INTO t_objet_trouve_obt VALUES
(NULL,"Sac à dos", "Un sac à dos de couleur noir marque adidas", 1, NULL);

-- 10. un trigger qui après suppression d'un objet trouvé supprime l'actualité le concernant 
DELIMITER //
CREATE TRIGGER supp_act_obt
AFTER DELETE ON t_objet_trouve_obt
FOR EACH ROW 
BEGIN 
DELETE FROM t_actualite_act WHERE act_intitule LIKE concat('%',OLD.obt_id, '%');
END;
// DELIMITER ;
-- Test 10.
DELETE FROM t_objet_trouve_obt WHERE obt_id = '';
 
-- 11. un trigger qui après récuperation d'un objet trouvé par un participant supprime l'actualite le concernant 
DELIMITER //
CREATE TRIGGER recup_obt_part
AFTER UPDATE ON t_objet_trouve_obt
FOR EACH ROW 
BEGIN
IF NEW.par_id NOT LIKE('NULL') THEN 
DELETE FROM t_actualite_act WHERE act_intitule LIKE concat('%',OLD.obt_id, '%');
END IF;
END;
// DELIMITER ;
-- Test 11.
UPDATE t_objet_trouve_obt SET par_id = 25 WHERE obt_id = 25;
 
-- 12. une procedure qui renvoie sur une plage donnée en entré les invités sur celles-ci
DELIMITER //
CREATE PROCEDURE plage_inv(IN num1 INT, IN num2 INT)
BEGIN 
SELECT inv_id, inv_nom FROM t_invite_inv LIMIT num1, num2;
END;
// DELIMITER ;
-- Test 12.
CALL plage_inv(0, 8);

-- 13. une procedure qui génère une exception avec un message d'erreur
DELIMITER //
CREATE PROCEDURE error_cpt_org1()
BEGIN
   DECLARE EXIT HANDLER
   FOR 1146
   BEGIN
      SIGNAL SQLSTATE '45000' SET
      MESSAGE_TEXT = 'L\'organisateur 1 ne peut être supprimer !';
   END;
   -- this will produce a 1146 error
	SELECT `c` FROM `temptab`;
END;
// DELIMITER ;
-- Test 13.
CALL error_cpt_org1();

-- 14. un trigger qui empêche la suppression du compte de l'organisateur 1 avec un appel à la procedure 13
DELIMITER //
CREATE TRIGGER bloc_supp_cpt1
BEFORE DELETE ON t_compte_cpt
FOR EACH ROW 
BEGIN  
IF OLD.cpt_login LIKE('organisateurs') AND OLD.cpt_etat LIKE('O') THEN 
CALL error_cpt_org1();
END IF;
END;
// DELIMITER ;
-- Test 14.
DELETE FROM t_actualite_act WHERE org_id = 1;
DELETE FROM t_organisateur_org WHERE org_id = 1;

-- programmes liés :
-- 15. vue qui rassemble les invités
-- Test 15.
SELECT * FROM invite; 
-- 16. fonction qui retourne le nombre d'invités 
-- Test 16.
SELECT nb_inv();
-- 17. fonction qui retourne la liste des invités
-- Test 17.
SELECT liste_inviter_anim();
-- 18. procedure qui ajoute le nombre d'invités dans les actualités avec leurs noms
-- Test 18.
CALL insert_nb_inv();
-- 19. trigger qui ajoute le nombre d'invite (fonction 16) avec la liste de leurs noms (fonction 17), en utilisant la procedure (18) après l'insertion d'un nouveau invité, et efface l'ancien ajout 'Si y'en a'. 
-- Test 19.
INSERT INTO t_compte_cpt VALUES
("AA", "Azerty", "I");

INSERT INTO t_invite_inv VALUES
(1,"AA", "Rappeur", "Gims, de son vrai nom Gandhi Djuna, né le 6 mai 1986 à Kinshasa, est un auteur-compositeur-interprète et rappeur.", "Issue d'une famille musiciens.Il arrive en France à l'âge de 2 ans. A suivi des études de graphisme/communication", "photo" ,"AA");


-- 15.
CREATE VIEW invite AS 
SELECT inv_nom as nombre FROM t_invite_inv;

-- 16
DELIMITER //
CREATE FUNCTION nb_inv() RETURNS INT 
BEGIN 
SET @nb = (SELECT count(inv_nom) FROM t_invite_inv);
RETURN @nb;
END;
// DELIMITER ;

-- 17.
DELIMITER //
CREATE FUNCTION liste_inviter_anim() RETURNS VARCHAR(5000)
BEGIN
SET @liste := (SELECT GROUP_CONCAT(DISTINCT inv_nom)  FROM t_invite_inv);
RETURN @liste;
END;
// DELIMITER ;

-- 18.
DELIMITER //
CREATE PROCEDURE insert_nb_inv()
BEGIN 
SET @nb := (SELECT nb_inv());
SET @liste := (SELECT liste_inviter_anim());
INSERT INTO t_actualite_act VALUES(NULL, 'Les invités présent à l\'évènement', CONCAT('Les invités présent à l\'évènement sont au nombrre de : ', @nb, ' dont ', @liste, ' venez les voir massivement'), NOW(), 'P', 1);
END;
// DELIMITER ;

-- 19.
DELIMITER //
CREATE TRIGGER ajout_inv_act
AFTER INSERT ON t_invite_inv
FOR EACH ROW
BEGIN 
SET @nb := (SELECT count(act_id)  FROM t_actualite_act WHERE act_intitule LIKE ('Les invités présent à l\'évènement'));
IF @nb := 0 THEN 
CALL insert_nb_inv();
ELSE 
DELETE FROM t_actualite_act WHERE act_intitule LIKE ('Les invités présent à l\'évènement');
CALL insert_nb_inv();
END IF;
END;
// DELIMITER ;



-- 20. une procedure qui supprime une animation particulière avec son id en paramètre d'entrée
DELIMITER //
CREATE PROCEDURE supprime_anim(id INT)
BEGIN 
DELETE FROM tj_inv_ani WHERE ani_id = id;
DELETE FROM t_animation_ani WHERE ani_id = id;
END;
// DELIMITER ;

DELIMITER // 
CREATE TRIGGER ajout_actu_post
BEFORE INSERT ON t_post_pst
FOR EACH ROW
BEGIN
SET @nb_post := (SELECT nb_post(NEW.pas_id));
SET @nom_pass := (SELECT pass_id FROM t_passeport_pas WHERE pas_id = NEW.pas_id);
INSERT INTO t_actualite_act VALUES(NULL, "Nouveau POST", concat("Nouveau post de ", @nom_pass, " il à publié ", @nb_post, " post en tout !"), NOW(), "P", 1);
END;
// DELIMITER ;

DELIMITER //
CREATE FUNCTION nb_post(pass_id INT) RETURNS INT
BEGIN
SET @nb_post := (SELECT COUNT(pst_mssg) FROM t_post_pst WHERE pas_id = pass_id);
RETURN @nb_post;
END;
// DELIMITER ;
