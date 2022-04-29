<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lieu extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url_helper');
    }

    public function afficher_toutes()
    {
        
        $data['titre'] = 'Vous trouverez l\'ensemble des lieux et leurs services dans le tableau suivant ';
        $data['lieu'] = $this->db_model->get_all_place();    
        $this->load->view('templates/haut');
        $this->load->view('lieux_afficher',$data);
        $this->load->view('templates/bas');
      
    }




}