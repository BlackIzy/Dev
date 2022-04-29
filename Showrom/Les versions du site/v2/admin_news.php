<!-- 
Prénom et nom : Abdoulaye Berte
Date de connexion : 01/03/2021
Description : Site web pour vente de vêtement en ligne 
-->
<?php
session_start();
if(!isset($_SESSION['login'])) //A COMPLETER pour tester aussi le statut...
{
 //Si la session n'est pas ouverte, redirection vers la page du formulaire
header("Location:session.php");
exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | DataTables</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<?php include "admin/index.php"; ?>
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Gestion des profils</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                <?php
                        // Création de l'entête du tableau
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Numéro</th>";
                        echo "<th>Titre</th>";
                        echo "<th>Description de l'actualité</th>";
                        echo "<th>Date d'ajout de l'actualité</th>";
                        echo "<th>Etat de l'actualité</th>";
                        echo "<th>Ajouter par</th>";
                        echo "</tr>";
                        echo "</thead>";
                        // Connection à la base
                        $mysqli = new mysqli('localhost','zberteab0','bki5c6f6','zfl2-zberteab0');
                        //Si la connection echoue affiche un message
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
                        // Requete pour selectionner toutes les actualités 
                        $requete_news = "SELECT * FROM t_news_new;";
                        //echo($requete_news);
                        $requete_news_new = $mysqli -> query($requete_news);
                        //si la requete echoue affiche un message d'erreur
                        if($requete_news_new == false)
                        {
                            echo("Error: La requete a echoue \n");
                            echo("Error: " . $mysqli->connect_errno . "\n");
                            echo("Error: " . $mysqli->connect_error . "\n");
                        }
                        // recupere le nombre d'actualités dans la base et l'affiche
                        $ligne = $requete_news_new -> num_rows;
                        echo "<p>Nombre de profil = ".$ligne." </p>";
                        echo "<tbody>";
                        // Remplit le corps du tableau avec une boucle 
                        while($requete_news_news = $requete_news_new -> fetch_assoc())
                        {
                            echo "<tr>";
                            echo "<td>".$requete_news_news['new_numero']."</td>";
                            echo "<td>".$requete_news_news['new_titre']."</td>";
                            echo "<td>".$requete_news_news['new_texte']."</td>";
                            echo "<td>".$requete_news_news['new_date_de_publication']."</td>";
                            echo "<td>".$requete_news_news['new_etat']."</td>";
                            echo "<td>".$requete_news_news['cpt_pseudo']."</td>";
                            echo "</tr>";
                            
                        }                                      
                        echo "<tbody>";
                        $mysqli->close();
                ?>
                </table>
                
              </div>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ajout d'une nouvelle actualité</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <!-- Affichage du formulaire pour ajouter une nouvelle actualité avec la method post qui transmet les information recuprées à la page new_action.php -->
              <form id="quickForm" method = "post" action = "news_action.php"> 
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Titre</label>
                    <input type="texte" name="titre" class="form-control" id="exampleInputEmail1" placeholder="Titre" maxlength = 50>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <input type="texte" name="texte" class="form-control" id="exampleInputEmail1" placeholder="Texte" maxlength = 300>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Etat de l'actualité(En ligne/Brouillon)</label>
                    <input type="texte" name="etat" class="form-control" id="exampleInputEmail1" placeholder="Brouillon/En ligne" maxlength = 10>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Valider</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
            
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
  </div>
</html>