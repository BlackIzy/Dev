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
// Récuperont les données transmises dans des variables
$pseudo = $_SESSION['login'];
$statut = $_SESSION['statut']
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Izy</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<!--entête du fichier HTML-->




<?php   
// inclure le gabarit admin
include 'admin/index.php';

// condition pour récuperer les nom du statut si c'est un administrateur ou un responsable
$statut_nom = "Admin";
if($statut == "A")
{
  $statut_nom = "Admin";
}
else if($statut == "R")
{
  $statut_nom = "Responsable";
}
// Connection à la base
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
// Requête pour recuperer le profil complet 
$rec_profil = "SELECT * FROM t_utilisateur_uti WHERE cpt_pseudo = '".$pseudo."';"; 
//echo $rec_profil;
$rec_profil_query = $mysqli -> query($rec_profil);
// Affiche un message si le retour de la requete vaut false
if($rec_profil_query == false)
{
  echo("Error: La requete a echoue \n");
  echo("Error: " . $mysqli->connect_errno . "\n");
  echo("Error: " . $mysqli->connect_error . "\n");
}
$rec_profil_assoc = $rec_profil_query -> fetch_assoc();
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Bienvenue </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php // On affiche les information de l'administrateur connecter ?> 
    <div margin: 10px 50px 20px class="col-md-4" >
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username"><?php echo  " ".$rec_profil_assoc['uti_prenom']."  ".$rec_profil_assoc['uti_nom']." "; ?></h3>
                <h5 class="widget-user-desc"><?php echo $statut_nom ; ?></h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="dist/img/user1-128x128.jpg" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">Votre pseudo</h5>
                      <span class="description-text"><?php echo $pseudo; ?></span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">Votre E-mail</h5>
                      <span class="description-text"><?php echo  " ".$rec_profil_assoc['uti_mail']." " ?></span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">Création du profil</h5>
                      <span class="description-text"><?php echo  " ".$rec_profil_assoc['uti_date_de_creation']." " ?></span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
          <!-- /.col -->

          <?php 
                // Si l'utilisateur est un administrateur on inclut la page admin_compte
                if($statut == "A")
                {
                  include "admin_compte.php";
                }
                
          ?>

        
  </div>
  <!-- /.content-wrapper -->


<!-- ./wrapper -->
</html>