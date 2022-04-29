<!-- 
Prénom et nom : Abdoulaye Berte
Date de connexion : 01/03/2021
Description : Site web pour vente de vêtement en ligne 
-->
<?php
session_start(); // Ouverture de la session 

// Si la variable global post à des informations on entre dans le if 
if($_POST)
{
    // Recuperation des données transmis dans des variables
    $pseudo=htmlspecialchars(addslashes($_POST["pseudo"]));
	$mdp=htmlspecialchars(addslashes($_POST["mdp"]));
    
    // Connexion à la base 
    $mysqli = new mysqli('localhost','zberteab0','bki5c6f6','zfl2-zberteab0');
    // Si la connection echoue affiche un message d'erreur
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
    
   
    $requete_ses = "SELECT * FROM t_compte_cpt JOIN t_utilisateur_uti  USING(cpt_pseudo) WHERE cpt_pseudo = '".$pseudo."' AND cpt_mot_de_passe = MD5('".$mdp."') AND uti_valide = 'A';";
    //echo $requete_ses;
    $requete_sess = $mysqli -> query($requete_ses);
    //Si retour de la requete vaut false affiche un message d'erreur 
    if($requete_sess == false)
    {
        echo("Error: La requete a echoue \n");
        echo("Error: " . $mysqli->connect_errno . "\n");
        echo("Error: " . $mysqli->connect_error . "\n");
    }
    else
    {
        $ligne=$requete_sess->fetch_assoc();
        // Si on a une ligne de retour on entre dans le if
        if($requete_sess -> num_rows == 1)
        {
            // On met à jour la variable goblal session la cle login etant egal au pseudo et la cle statut au statut de l'utilisateur connecter
            $_SESSION['login'] = $pseudo;
            $_SESSION['statut'] = $ligne['uti_statut'];
            header("Location:admin_accueil.php");
            
        }
        else
        {
            echo "pseudo/mot de passe incorrect(s) ou profil inconnu !";
            echo "<br /><a href=\"./session.php\">Cliquez ici pour réafficher le formulaire</a>";

        }
    

    }

}
else
{
    echo "<p><a href = 'session.php'>remplissez le formulaire</a><p>";
}

?>