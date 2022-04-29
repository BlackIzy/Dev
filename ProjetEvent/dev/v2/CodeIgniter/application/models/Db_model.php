<?php
class Db_model extends CI_Model {

/* -----------------------------------------------------------------
    Constructeur du db model
   -----------------------------------------------------------------
*/
    public function __construct()
    {
        $this->load->database();
    }
    
/* -----------------------------------------------------------------
    Fonction qui récupère tous les compte de la base
   -----------------------------------------------------------------
*/
    public function get_all_compte()
    {
        $query = $this->db->query("SELECT * FROM t_compte_cpt LEFT JOIN t_organisateur_org USING(cpt_login) LEFT JOIN t_invite_inv USING(cpt_login);");
        return $query->result_array();
    }

/* -----------------------------------------------------------------
    Fonction qui récupère une actualité à partir de son id
   -----------------------------------------------------------------
*/
    public function get_actualite($numero)
    {
        $query = $this->db->query("SELECT act_id,act_texte FROM t_actualite_act WHERE act_id=".$numero.";");
        return $query->row();
    }
/* -----------------------------------------------------------------
    Fonction qui récupère toutes les actualités
   -----------------------------------------------------------------
*/
    public function get_all_actualite()
    {
        $query = $this->db->query("SELECT act_intitule,act_texte,acte_date_de_pub,cpt_login FROM t_actualite_act JOIN t_organisateur_org USING(org_id) WHERE act_etat = 'P' ORDER BY act_id DESC LIMIT 5;");
        return $query->result_array();
    }
/* -------------------------------------------------------------------------------------
    Fonction qui récupère tous les invités, leurs animations, et le lieu des animations
   --------------------------------------------------------------------------------------
*/
    public function get_all_anim_caract()
    {
        $query = $this->db->query("SELECT * FROM t_animation_ani LEFT JOIN tj_inv_ani USING(ani_id) LEFT JOIN t_invite_inv USING(inv_id) LEFT JOIN t_lieu_lie USING(lie_id) ORDER BY ani_date_debut;");
        return $query->result_array();
    }
/* --------------------------------------------------------------------------------------------------------------------
    Fonction qui récupère tous les invités, leurs passeport, leurs résaux sociaux et les posts qui leurs sont associés
   ---------------------------------------------------------------------------------------------------------------------
*/
    public function get_all_invite()
    {
        $query = $this->db->query("SELECT * FROM t_invite_inv LEFT JOIN tj_inv_rsl USING(inv_id) LEFT JOIN t_reseau_social_rsl USING(rsl_id) LEFT JOIN t_passeport_pas USING(inv_id) LEFT JOIN t_post_pst USING(pas_id) ORDER BY pas_id DESC;");

        return $query->result_array();
    }

/* -------------------------------------------
    Fonction qui récupère tous les invités
   -------------------------------------------
*/
    public function get_all_inv()
    {
        $query = $this->db->query("SELECT * FROM t_invite_inv;");
        return $query->result_array();
    }

/* --------------------------------------------------------------
    Fonction qui récupère tous les invités et leurs résaux sociaux
   ---------------------------------------------------------------
*/
    public function  get_all_rsl()
    {
        $query = $this->db->query("SELECT * FROM t_invite_inv LEFT JOIN tj_inv_rsl USING(inv_id) LEFT JOIN t_reseau_social_rsl USING(rsl_id);");
        return $query->result_array();
    }

/* ----------------------------------------------------------------------------------
    Fonction qui récupère tous les invités et les posts publié par leurs entourages
   -----------------------------------------------------------------------------------
*/
    public function get_all_post()
    {
        $query = $this->db->query("SELECT * FROM t_invite_inv LEFT JOIN t_passeport_pas USING(inv_id) LEFT JOIN t_post_pst USING(pas_id) ORDER BY pst_id DESC;");
        return $query->result_array();
    }


/* ----------------------------------------------------------------------------------
    Fonction pour insérer un nouveau compte invité dans la base 
   -----------------------------------------------------------------------------------
*/
    public function set_compte_invite()
    {
        $this->load->helper('url');
        $id=$this->input->post('id');
        $mdp=$this->input->post('mdp');
        $req="INSERT INTO t_compte_cpt VALUES ('".$id."','".$mdp."', 'I');";
        $query = $this->db->query($req);
        return ($query);
    }
/* ----------------------------------------------------------------------------------
    Fonction de vérification avant connexion à l'espace admin 
   -----------------------------------------------------------------------------------
*/
    public function connect_compte($username, $password)
    {
        $salt = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
        $password = hash('sha256', $salt.$password);
        $query =$this->db->query("SELECT cpt_login,cpt_mdp FROM t_compte_cpt WHERE cpt_login='".$username."' AND cpt_mdp='".$password."';");
        if($query->num_rows() > 0) 
        { 
            return true; 
        } 
        else 
        { 
            return false;
        } 
        
    }

/* ----------------------------------------------------------------------------------
    Fonction qui recupere les données d'un compte passé en parmètre
   -----------------------------------------------------------------------------------
*/
public function get_compte($username)
{
    $query =$this->db->query("SELECT * FROM t_compte_cpt WHERE cpt_login LIKE('".$username."');");
    return $query->row();
}

/* ----------------------------------------------------------------------------------
    Fonction qui recupere les informations liée à un invité passé en paramètre
   -----------------------------------------------------------------------------------
*/

public function get_profil($username)
{
    $query =$this->db->query("SELECT * FROM t_compte_cpt LEFT JOIN t_organisateur_org USING(cpt_login) LEFT JOIN t_invite_inv USING(cpt_login) LEFT JOIN tj_inv_rsl USING(inv_id) LEFT JOIN t_reseau_social_rsl USING(rsl_id) WHERE cpt_login LIKE('".$username."');");
    return $query->result_array();
}

/* ----------------------------------------------------------------------------------
    Fonction qui modifie le mot de passe d'un compte
   -----------------------------------------------------------------------------------
*/

public function update_compte_invite($mdp)
{
    $salt = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
    $mdp = hash('sha256', $salt.$mdp);
    $req="UPDATE t_compte_cpt SET cpt_mdp = '".$mdp."'  WHERE cpt_login LIKE('".$_SESSION["username"]."');";
    $query = $this->db->query($req);
    return ($query);
}

/* ----------------------------------------------------------------------------------
    Fonction recupère tout les lieux, et services s'il y'en a présent dans la base
   -----------------------------------------------------------------------------------
*/

public function get_all_place()
{
    $query =$this->db->query("SELECT * FROM t_lieu_lie LEFT JOIN t_service_ser USING(lie_id);");
    return $query->result_array();
}

/* ----------------------------------------------------------------------------------
    Fonction les détails de tout les animation "lieu, invités s'il y'en a"
   -----------------------------------------------------------------------------------
*/
public function get_detail_anim($id_anim)
{
    //$query = $this->db->query("SELECT  * FROM t_invite_inv RIGHT JOIN tj_inv_ani USING (inv_id) RIGHT JOIN t_animation_ani USING(ani_id) RIGHT JOIN t_lieu_lie USING(lie_id) WHERE ani_id = ".$id_anim." ;");
    $query = $this->db->query("SELECT  * FROM t_animation_ani LEFT JOIN tj_inv_ani USING(ani_id) LEFT JOIN t_invite_inv USING(inv_id) LEFT JOIN t_lieu_lie USING(lie_id) WHERE ani_id = ".$id_anim." ;");
    return $query->result_array();
}

/* ----------------------------------------------------------------------------------
    Fonction les détails de tout les animation "lieu, invités"
   -----------------------------------------------------------------------------------
*/

public function get_detail_anim_inv($id_anim)
{
    $query = $this->db->query("SELECT * FROM t_animation_ani LEFT JOIN tj_inv_ani USING(ani_id) LEFT JOIN t_invite_inv  USING(inv_id) LEFT JOIN tj_inv_rsl USING(inv_id) LEFT JOIN t_reseau_social_rsl USING(rsl_id) LEFT JOIN t_passeport_pas USING(inv_id) LEFT JOIN t_post_pst USING(pas_id) WHERE ani_id = ".$id_anim.";");
    return $query->result_array();
}

/* ----------------------------------------------------------------------------------
    Fonction qui récupère les lieux et services d'un animation passé en paramètre
   -----------------------------------------------------------------------------------
*/

public function get_detail_anim_lieu($id_anim)
{
    $query =$this->db->query("SELECT * FROM t_animation_ani LEFT JOIN t_lieu_lie USING(lie_id) LEFT JOIN t_service_ser USING(lie_id) WHERE ani_id = ".$id_anim.";");
    return $query->result_array();
}

/* ----------------------------------------------------------------------------------
    Fonction verifie l'existence d'un passeport
   -----------------------------------------------------------------------------------
*/

public function get_passport($pass, $mdp)
{
    $salt = "OnRajouteDuSelPourAllongerleMDP123!!45678__Test";
    $mdp = hash('sha256', $salt.$mdp);
    $query =$this->db->query("SELECT * FROM t_passeport_pas WHERE pass_id='".$pass."' AND pas_mdp='".$mdp."';");
    if($query->num_rows() > 0) 
    { 
        return true; 
    } 
    else 
    { 
        return false;
    } 
}

/* ----------------------------------------------------------------------------------
    Fonction qui insère un post qui aurait du s'appeler add
   -----------------------------------------------------------------------------------
*/

public function set_post($pass, $mssg)
{
    $mssg = addslashes($mssg);
    $req="INSERT INTO t_post_pst VALUES ('NULL', '".$mssg."', '".$pass."');";
    $query = $this->db->query($req);
    return ($query);
}

/* ----------------------------------------------------------------------------------
    Fonction qui récupère tout les passeports d'un invités 
   -----------------------------------------------------------------------------------
*/

public function get_data_passeport($pass)
{
    $query =$this->db->query("SELECT * FROM  t_passeport_pas LEFT JOIN t_invite_inv USING(inv_id) LEFT JOIN t_post_pst USING(pas_id) WHERE cpt_login='".$pass."';");
    return $query->result_array();
}

/* ----------------------------------------------------------------------------------
    Fonction qui récupère id d'un passeport avec son pass_nom en paramètre
   -----------------------------------------------------------------------------------
*/

public function get_pass_passeport($pass)
{
    $query =$this->db->query("SELECT pas_id FROM t_passeport_pas WHERE pass_id='".$pass."';");
    return $query->row();
}

/* ----------------------------------------------------------------------------------
    Fonction qui supprime une animation passé en paramètre avec une procédure
   -----------------------------------------------------------------------------------
*/

public function delete_anim($ani_id)
{
    $query = $this->db->query("CALL supprime_anim('".$ani_id."');");
}

}
?>