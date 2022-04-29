<?php
$pas_id = $passeport->pas_id;
if($this->db_model->set_post($pas_id, $mssg))
{
    $_SESSION [ 'message' ]  =  'Votre post à bien été ajouter' ; 
    $this -> session -> mark_as_flash ( 'message' );
    redirect('post/poster');
                        
}
else
{
    $_SESSION [ 'message' ]  =  'Votre post n\'a pas été ajouter' ; 
    $this -> session -> mark_as_flash ( 'message' );
    redirect('post/poster');                      
}
?>