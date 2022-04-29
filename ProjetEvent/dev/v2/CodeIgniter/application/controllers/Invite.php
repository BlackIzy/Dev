<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Invite extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url_helper');
    }

    public function afficher_toutes()
    {
        
        $data['titre'] = 'Vous trouverez l\'ensemble des invités et les informations les concernants ci-dessous ';
        //$data['inv'] = $this->db_model->get_all_invite();    
        $data['inv'] = $this->db_model->get_all_inv();
        $data['pst'] = $this->db_model->get_all_post();
        $data['rsl'] = $this->db_model->get_all_rsl();
        $this->load->view('templates/haut');
        $this->load->view('invites_afficher',$data);
        $this->load->view('templates/bas');
      
    }




}