<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Compte extends CI_Controller {
    
        public function __construct()
        {
            parent::__construct();
            $this->load->model('db_model');
            $this->load->helper('url_helper');
        }

        public function connecter()
        {
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('pseudo', 'pseudo', 'required', array( "required" =>  "<h1> Veillez remplir le champs Identifiant</h1>"));
            $this->form_validation->set_rules('mdp', 'mdp', 'required',  array( "required" => "<h1>Veillez remplir le champs Mot de passe</h1>"));
            
            if ($this->form_validation->run() == FALSE)
            {
                $data['error'] = NULL;
                $this->load->view('templates/haut');
                $this->load->view('compte_connecter', $data);
                $this->load->view('templates/bas');
            }
            else
            {
                $username = $this->input->post('pseudo'); 
                $password = $this->input->post('mdp'); 
                if($this->db_model->connect_compte($username,$password))
                { 
                    $session_data = array('username' => $username);
                    $this->session->set_userdata($session_data);
                    $data['compte'] = $this->db_model->get_compte($_SESSION['username']);
                    $this->load->view('profil', $data); 
                }
                else
                {
                    $data['error'] = "Identifiant éronné !";
                    $this->load->view('templates/haut');
                    $this->load->view('compte_connecter', $data);
                    $this->load->view('templates/bas');
                }
            }
        }

        public function destroy()
        {
            $this->session->sess_destroy();
            $data['titre'] = 'Toutes les Actualités :';
            $data['actu'] = $this->db_model->get_all_actualite(); 
            $this->load->view('templates/haut');
            $this->load->view('page_accueil', $data);
            $this->load->view('templates/bas'); 
        }

        public function profil()
        {
            if(isset($_SESSION['username']))
            {
                $data['compte'] = $this->db_model->get_compte($_SESSION['username']);
                $data['profil'] = $this->db_model->get_profil($_SESSION['username']);
                $this->load->view('templates/haut_admin');
                $this->load->view('compte_menu', $data);
                $this->load->view('profil', $data);            
                $this->load->view('templates/bas_admin');
            }
            else
            {
                redirect('actualite/afficher_toutes');
            } 
        }

        public function profil_invite()
        {
            if(isset($_SESSION['username']))
            {
                $data['compte'] = $this->db_model->get_compte($_SESSION['username']);
                $data['profil'] = $this->db_model->get_profil($_SESSION['username']);
                $this->load->view('templates/haut_admin');
                $this->load->view('compte_menu', $data);
                $this->load->view('profil_inv', $data);            
                $this->load->view('templates/bas_admin');
            }
            else
            {
                redirect('actualite/afficher_toutes');
            } 
        }

        public function profil_admin()
        {
            if(isset($_SESSION['username']))
            {
                $data['compte'] = $this->db_model->get_compte($_SESSION['username']);
                $data['profil'] = $this->db_model->get_profil($_SESSION['username']);
                $this->load->view('templates/haut_admin');
                $this->load->view('compte_menu', $data);
                $this->load->view('profil_admin', $data);            
                $this->load->view('templates/bas_admin');
            }
            else
            {
                redirect('actualite/afficher_toutes');
            } 
        }

        public function update_profil()
        {
            if(isset($_SESSION['username']))
            {
                $this->load->helper('form');
                $this->load->library('form_validation');
                $this->form_validation->set_rules('mdp', 'mdp', 'required|matches[mdp_c]', array( "required" =>  "<p> Veillez remplir le champs Mot de passe</p>", "matches" => "<p> Vérifier que les mots de passe sont identiques !</p>"));
                $this->form_validation->set_rules('mdp_c', 'mdp_c', 'required',  array( "required" => "<p>Veillez remplir le champs de confirmation</p>"));

                if ($this->form_validation->run() == FALSE)
                {
                    $data['succes'] = NULL;
                    $data['compte'] = $this->db_model->get_compte($_SESSION['username']);
                    $data['profil'] = $this->db_model->get_profil($_SESSION['username']);
                    $this->load->view('templates/haut_admin');
                    $this->load->view('compte_menu', $data);
                    $this->load->view('modif_profil', $data);
                    $this->load->view('templates/bas_admin');
                }
                else
                {
                    $password = $this->input->post('mdp'); 
                    if($this->db_model->update_compte_invite($password))
                    {
                        $data['succes'] = "Vos modifications ont été bien pris en compte";
                        $data['compte'] = $this->db_model->get_compte($_SESSION['username']);
                        $data['profil'] = $this->db_model->get_profil($_SESSION['username']);
                        $this->load->view('templates/haut_admin');
                        $this->load->view('compte_menu', $data);
                        $this->load->view('modif_profil', $data);
                        $this->load->view('templates/bas_admin');
                        
                    }
                    else
                    {
                        $data['succes'] = "Vos modifications n'ont pas été pris en compte";
                        $data['compte'] = $this->db_model->get_compte($_SESSION['username']);
                        $data['profil'] = $this->db_model->get_profil($_SESSION['username']);
                        $this->load->view('templates/haut_admin');
                        $this->load->view('compte_menu', $data);
                        $this->load->view('modif_profil', $data);
                        $this->load->view('templates/bas_admin');
                    }
                }
               
            }
            else
            {
                $data['titre'] = 'Toutes les Actualités :';
                $data['actu'] = $this->db_model->get_all_actualite(); 
                $this->load->view('templates/haut');
                $this->load->view('page_accueil', $data);
                $this->load->view('templates/bas');
            }
             
        }
        public function afficher_animations()
        {
            $data['titre'] = 'Toutes les animations :';
            $data['anim'] = $this->db_model->get_all_anim_caract();    
            $data['compte'] = $this->db_model->get_compte($_SESSION['username']);
            $data['profil'] = $this->db_model->get_profil($_SESSION['username']);
            $this->load->view('templates/haut_admin');
            $this->load->view('compte_menu', $data);
            $this->load->view('afficher_anim_admin',$data);
            $this->load->view('templates/bas_admin');
          
        }

        public function all_compte()
        {
            $data['titre'] = 'Tout les comptes :';
            $data['cpt'] = $this->db_model->get_all_compte();    
            $data['compte'] = $this->db_model->get_compte($_SESSION['username']);
            $data['profil'] = $this->db_model->get_profil($_SESSION['username']);
            $this->load->view('templates/haut_admin');
            $this->load->view('compte_menu', $data);
            $this->load->view('afficher_comptes', $data);
            $this->load->view('templates/bas_admin');
        }

        public function supprimer_animation()
        {
            $id_anim = $this->uri->segment(3);
            $this->db_model->delete_anim($id_anim);
            $_SESSION [ 'mssg_supp' ]  =  'L\'animation à été supprimer' ; 
            $this -> session -> mark_as_flash ( 'mssg_supp' );
            redirect('compte/afficher_animations');
        }

      
     

      
    }
?>