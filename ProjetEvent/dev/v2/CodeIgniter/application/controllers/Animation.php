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

    public function afficher_detail_anim()
    {
        $data['titre'] = 'Les détails de l\'animation sont les suivants  ';
        $id_anim = $this->uri->segment(3);
        $data['anim'] = $this->db_model->get_detail_anim($id_anim);
        
        $this->load->view('templates/haut');
        $this->load->view('afficher_detail_anim',$data);
        $this->load->view('templates/bas');

    }

    public function afficher_detail_anim_inv()
    {
        $data['titre'] = 'Les détails des invités de cette animation sont les suivant';
        $id_anim = $this->uri->segment(3);
        $data['inv'] = $this->db_model->get_detail_anim($id_anim);
        $data['pst'] = $this->db_model->get_all_post();
        $data['rsl'] = $this->db_model->get_all_rsl();
        $this->load->view('templates/haut');
        $this->load->view('afficher_detail_anim_inv',$data);
        $this->load->view('templates/bas');
    }

    public function afficher_detail_anim_lieu()
    {
        $data['titre'] = 'Les détails du lieu de cette animation et ses services sont les suivants';
        $id_anim = $this->uri->segment(3);
        $data['lieu'] = $this->db_model->get_detail_anim_lieu($id_anim);
        $this->load->view('templates/haut');
        $this->load->view('afficher_detail_anim_lieu',$data);
        $this->load->view('templates/bas');
    }




}