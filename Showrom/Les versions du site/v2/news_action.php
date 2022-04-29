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
    // Récuperation des données trasmis avec la variable global POST
    $titre = $_POST['titre'];
    $texte = $_POST['texte'];
    $etat = $_POST['etat'];
    //echo $titre;
    // Connection à la base
    $mysqli = new mysqli('localhost','zberteab0','bki5c6f6','zfl2-zberteab0');
    // Si la connection echoue affiche une erreur 
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
    // Requete recuperant toutes les actualites 
    $requete_ne = "SELECT MAX(new_numero) FROM t_news_new;";
    //echo $requete_val;
    $requete_new = $mysqli -> query($requete_ne);
    //Si retour de la requete est false affiche une erreur 
    if($requete_new == false)
    {
        echo "Error: Problème de connexion à la BDD \n";
        echo "Errno: " . $mysqli->connect_errno . "\n";
        echo "Error: " . $mysqli->connect_error . "\n";

    }
    // Requete d'insertion d'un nouvelle actualite avec les données recuperées
    $requete_insert_ne = "INSERT INTO t_news_new VALUES (NULL,'".$titre."', '".$texte."', curdate(),'".$etat."','".$pseudo."');";

    //echo $requete_insert_ne;
    // execution de l'insertion dans la base'
    $requete_insert_new = $mysqli -> query($requete_insert_ne);
    // Si le retour de l'insertion est false affiche un message sinon redirection vers la page news_acceuil.php
    if($requete_insert_new == false)
    {
        echo "<h1> Erreur </h1>";
    }
    else
    {
        header("Location:admin_news.php");
    }

    $mysqli->close(); 
}
?>