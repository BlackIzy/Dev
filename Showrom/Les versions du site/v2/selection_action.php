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
    // Recuperation des données transmise avec la method POST dans des variables
    $selection = $_POST['selection'];
    $elt = $_POST['element'];
    // Connection à la base
    $mysqli = new mysqli('localhost','zberteab0','bki5c6f6','zfl2-zberteab0');
    // Si la connection echoue affiche un message
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
    // Requuete pour supprimer l'élément de la selection 
    $requete_sup_tj = "DELETE FROM tj_sel_elt WHERE sel_numero = $selection and elt_numero = $elt;";
    //echo $requete_val;
    // Insertion de la modification dans la base
    $requete_sup_elt = $mysqli -> query($requete_sup_tj);
    // Si le retour de la modification vaut true redirection vers admin_selection.php
    if($requete_sup_elt == true)
    {
        header("Location:admin_selection.php");

    }
    //Sinon affiche un message 
    else
    {
        echo "<h1> Erreur </h1>";
    }
    
    $mysqli->close();
   
}

?>