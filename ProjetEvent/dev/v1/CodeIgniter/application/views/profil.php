<?php $user = $_SESSION['username'] ?>

<?php 
    echo $compte->cpt_etat;
    if($compte->cpt_etat == "I")
    {  
        echo 
        redirect('compte/profil_invite');
    }
    else if($compte->cpt_etat == "O")
    { 
        redirect('compte/profil_admin');
    }
    else
    { 
        redirect('actualite/page_accueil');
    }
?>
    

