<!-- 
Prénom et nom : Abdoulaye Berte
Date de connexion : 01/03/2021
Description : Site web pour vente de vêtement en ligne 
-->
<?php
session_start();
if(!isset($_SESSION['login'])) 
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
  <title>Admin Izy</title>

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
                <h3 class="card-title">Gestion des sélections et élements</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                <?php
                        // Création de l'entête du tableau
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Titre de la sélection</th>";
                        echo "<th>Date d'ajout de la sélection</th>";
                        echo "<th>Pseudo</th>";
                        echo "<th>Numéro de la sélection</th>";
                        echo "<th>Elements</th>";
                        echo "<th>Etat de l'élement</th>";
                        echo "</tr>";
                        echo "</thead>";

                        // Connection à la base
                        $mysqli = new mysqli('localhost','zberteab0','bki5c6f6','zfl2-zberteab0');
                         // Si erreur affiche un message
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
 
                         // Requête qui recupère tout les selections avec leurs elements 
                         $req_sel = "SELECT * FROM t_selection_sel LEFT JOIN tj_sel_elt USING(sel_numero) LEFT JOIN t_element_elt USING(elt_numero);";
                         // echo $req_sel
                         $req_selec = $mysqli -> query($req_sel);
                         // Si le retour de la requete est false affiche un message
                         if($req_sel==false)
                         {
                             echo("Error: La requete a echoue \n");
                             echo("Error: " . $mysqli->connect_errno . "\n");
                             echo("Error: " . $mysqli->connect_error . "\n");
                         }
                         // Recupere le nombre de ligne et l'affiche 
                         $ligne = $req_selec -> num_rows;
                         echo "<p>Nombre de sélection = ".$ligne." </p>";
                         // Remplir le corps du tableau avec une boucle 
                         echo "<tbody>";
                         while($requete_selection = $req_selec -> fetch_assoc())
                         {  
                             echo "<tr>"; 
                             echo "<td>".$requete_selection['sel_titre']."</td>";
                             echo "<td>".$requete_selection['sel_date_dajout']."</td>";
                             echo "<td>".$requete_selection['cpt_pseudo']."</td>"; 
                             echo "<td>".$requete_selection['sel_numero']."</td>";
                             echo "<td>".$requete_selection['elt_numero']."</td>";
                             echo "<td>".$requete_selection['elt_etat']."</td>";
                             echo "</tr>";   
                         }                                              
                         echo "<tbody>";
                 ?>
                 </table>
                 
               </div>
               <?php
                     // Requete selectionnant tout les selections disponible dans la base 
                      $requete_se = "SELECT * FROM t_selection_sel;";
                      //echo $requete_se;
                      $requete_sele = $mysqli -> query($requete_se);
                      // Si retour est false affiche un message
                      if($requete_sele == False)
                      {
                          echo("Error: La requete a echoue \n");
                          echo("Error: " . $mysqli->connect_errno . "\n");
                          echo("Error: " . $mysqli->connect_error . "\n");
                      }
                      // Requete qui recupere toutes les sélections avec leurs éléments
                      $requete_el = "SELECT DISTINCT elt_numero FROM t_selection_sel LEFT JOIN tj_sel_elt USING(sel_numero) LEFT JOIN t_element_elt USING(elt_numero);";
                      //echo $requete_el;
                      $requete_elt = $mysqli -> query($requete_el);
                      // Si le retour de la requete vaut false affiche un message 
                      if($requete_elt == false)
                      {
                         echo("Error: La requete a echoue \n");
                         echo("Error: " . $mysqli->connect_errno . "\n");
                         echo("Error: " . $mysqli->connect_error . "\n");
                      }
                      // Creation des liste deroulantes avec la method poste qui redirige vers la page selection_action.php 
                      echo "<form action='selection_action.php' method='post'>";
                      echo "Selection : ";
                      echo "<select name='selection'>";
                      // Boucle pour afficher tous les selections
                      while($requete_selection1 = $requete_sele -> fetch_assoc())
                      {
                          echo "<option value=".$requete_selection1["sel_numero"]."><p> ".$requete_selection1["sel_numero"]." </p></option>";
                      }
                      echo "</select>";
                      echo " Element : ";
                      echo "<select name='element'>";
                      // Boucle pour afficher tout les elements 
                      while($requete_element = $requete_elt -> fetch_assoc())
                      {
                          echo "<option value=".$requete_element["elt_numero"]."><p> ".$requete_element["elt_numero"]." </p></option>";
                      }
                      echo "</select>";
                      echo "<p><input type='submit'value='Valider'></p>";
                      echo "</form>";  
                      
               ?>
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


