<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Post extends CI_Controller {
    
        public function __construct()
        {
            parent::__construct();
            $this->load->model('db_model');
            $this->load->helper('url_helper');
        }

        public function poster()
        {
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('pass', 'pass', 'required', array( "required" =>  "<h1> Veillez remplir le champ Pass</h1>"));
            $this->form_validation->set_rules('mdp', 'mdp', 'required',  array( "required" => "<h1>Veillez remplir le champ Mot de passe</h1>"));
            $this->form_validation->set_rules('mssg', 'mssg', 'required|max_length[140]',  array( "required" => "<h1>Veillez remplir le champ message</h1>", "max_length" => "<h1> Le message ne doit pas dépasser 140 caractères ! </h1>"));
            
            if ($this->form_validation->run() == FALSE)
            {
                $data['error'] = NULL;
                $this->load->view('templates/haut');
                $this->load->view('afficher_form_post', $data);
                $this->load->view('templates/bas');
            }
            else
            {
                $pass = $this->input->post('pass'); 
                $password = $this->input->post('mdp'); 
                $mssg = $this->input->post('mssg'); 
                if($this->db_model->get_passport($pass,$password))
                { 
                    $data['passeport'] = $this->db_model->get_pass_passeport($pass);
                    $data['mssg'] = $mssg;
                    $this->load->view('insertion', $data, $mssg);
                    
                }
                else
                {
                    $data['error'] = "Identifiant éronné !";
                    $this->load->view('templates/haut');
                    $this->load->view('afficher_form_post', $data);
                    $this->load->view('templates/bas');
                    
                }
            }
        }

        public function afficher_pass_post()
        {
            $data['pass_post'] = $this->db_model->get_data_passeport($_SESSION['username']);
            $data['compte'] = $this->db_model->get_compte($_SESSION['username']);
            $data['profil'] = $this->db_model->get_profil($_SESSION['username']);
            $this->load->view('templates/haut_admin');
            $this->load->view('compte_menu', $data);
            $this->load->view('afficher_passeport_post_inv', $data);         
            $this->load->view('templates/bas_admin');
        }
}