<?php
class Accueil extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function afficher()
	 {
		 
		 $this->load->view('templates/haut');
		 $this->load->view('page_accueil');
		 $this->load->view('templates/bas');
	 }


 
}
?>