   <!-- Begin Page Content -->
   <?php  ?>
 
      <?php
        if ($this->session->userdata('username') !== FALSE) 
        {
            $user = $this->session->userdata('username');
            if($compte->cpt_etat == "I")
            {
                $this->load->view('templates/menu_invite');        
                
            }
            else if($compte->cpt_etat == "O"){

                $this->load->view('templates/menu_admin');   
                
            }
        } 
        else 
        {
            redirect('actualite/afficher','refresh', 301);
        } 
        
         
      ?>



                        

