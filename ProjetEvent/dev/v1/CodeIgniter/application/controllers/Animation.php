<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Animation extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url_helper');
    }

    public function afficher_toutes()
    {
        
        $data['titre'] = 'Vous trouverez l\'ensemble de la programmation du bal dans le tableau ci-dessous ';
        $data['anim'] = $this->db_model->get_all_anim_caract();    
        $this->load->view('templates/haut');
        $this->load->view('animations_afficher',$data);
        $this->load->view('templates/bas');
      
    }






}