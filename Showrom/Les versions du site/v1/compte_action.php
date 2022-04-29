<!-- 
Prénom et nom : Abdoulaye Berte
Date de connexion : 01/03/2021
Description : Site web pour vente de vêtement en ligne 
-->
<?php
/* Vérification ci-dessous à faire sur toutes les pages dont l'accès est
autorisé à un utilisateur connecté. */
session_start();
if(!isset($_SESSION['login'])) //A COMPLETER pour tester aussi le statut...
{
 //Si la session n'est pas ouverte, redirection vers la page du formulaire
header("Location:session.php");
exit();
}
$pseudo = $_SESSION['login'];
?>
<?php
if($_POST)
{
    // Recuperation des données transmises 
    $valide = $_POST['validite'];

    $valide1 = 'A';
    $valide2 = 'D';
    // Connexion à la base
    $mysqli = new mysqli('localhost','zberteab0','bki5c6f6','zfl2-zberteab0');
    if ($mysqli->connect_errno)
    {
        // Affichage d'un message d'erreur
        echo "Error: Problème de connexion à la BDD \n";
        echo "Errno: " . $mysqli->connect_errno . "\n";
        echo "Error: " . $mysqli->connect_error . "\n";
        // Arrêt du chargement de la page
        exit();
    }
    if (!$mysqli->set_charset("utf8")) 
    {
        printf("Pb de chargement du jeu de car. utf8: %s\n", $mysqli->error);
        exit();
    }
    // Recuperer les données du profil transmis par la method POST
    $requete_val = "SELECT * FROM t_utilisateur_uti WHERE cpt_pseudo ='".$valide."';";
    // echo $requete_val;
    $requete_valid = $mysqli -> query($requete_val);
    // Si la requete retour false afficher une erreur 
    if($requete_valid == False)
    {
        echo("Error: La requete a echoue \n");
        echo("Error: " . $mysqli->connect_errno . "\n");
        echo("Error: " . $mysqli->connect_error . "\n");
    }
    // Sinon
    else
    {
        // tranformation de la requete en tableau associatif
        $requete_validite = $requete_valid -> fetch_assoc();
        // Si la validite du profil == A (Active) on la transforme en D (Desactive)
        if($requete_validite['uti_valide'] == $valide1)
        {
            $requete_mod = "UPDATE t_utilisateur_uti SET uti_valide ='".$valide2."' WHERE cpt_pseudo ='".$valide."';";
            echo $requete_mod;
    
        }
        else // Sinon on fait l'inverse
        {
            $requete_mod = "UPDATE t_utilisateur_uti SET uti_valide ='".$valide1."' WHERE cpt_pseudo ='".$valide."';";
            echo $requete_mod;
        }
        // Modification dans la base
        $requete_modif = $mysqli -> query($requete_mod);
        
        // Si le retour de la modification est true redirection vers admin_acceuil.php
        if($requete_modif == true)
        {
            header("Location:admin_accueil.php");
    
        }
        // Sinon affiche un message 
        else
        {
            echo "<h1> Erreur </h1>";
        }
        $mysqli->close();
    }
   
}

?>