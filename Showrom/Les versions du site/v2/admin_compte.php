<!-- 
Prénom et nom : Abdoulaye Berte
Date de connexion : 01/03/2021
Description : Site web pour vente de vêtement en ligne 
-->


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
                        // Creation de l'entete du tableau
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Nom</th>";
                        echo "<th>Prénom</th>";
                        echo "<th>E-mail</th>";
                        echo "<th>Validité du compte</th>";
                        echo "<th>Statut du compte</th>";
                        echo "<th>Date de création du compte</th>";
                        echo "<th>Pseudo du compte</th>";
                        echo "</tr>";
                        echo "</thead>";

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
                        // Requete pour recuperer tout les profils de la base
                        $requete_uti = "SELECT * FROM t_utilisateur_uti;";
                        $requete_utilisa = $mysqli -> query($requete_uti);
                        // Recuperer le nombre de ligne avec num_rows et l'afficher
                        $ligne = $requete_utilisa -> num_rows;
                        echo "<p>Nombre de profil = ".$ligne." </p>";
                        // Corps du tableau avec une boucle qui remplit toutes les colonnes 
                        echo "<tbody>";
                        while($requete_utilisateur = $requete_utilisa -> fetch_assoc())
                        {
                            echo "<tr>";
                            echo "<td>".$requete_utilisateur['uti_nom']."</td>";
                            echo "<td>".$requete_utilisateur['uti_prenom']."</td>";
                            echo "<td>".$requete_utilisateur['uti_mail']."</td>";
                            echo "<td>".$requete_utilisateur['uti_valide']."</td>";
                            echo "<td>".$requete_utilisateur['uti_statut']."</td>";
                            echo "<td>".$requete_utilisateur['uti_date_de_creation']."</td>";
                            echo "<td>".$requete_utilisateur['cpt_pseudo']."</td>";
                            echo "</tr>";
                            
                        }                                      
                        echo "<tbody>";
                ?>
                </table>
                
              </div>
              <?php
                      // requete pour recuperer tous les utilisateurs 
                      $requete_utili = "SELECT * FROM t_utilisateur_uti;";
                      $requete_utilisat = $mysqli -> query($requete_utili);
                      // Creation du boutton associer à une liste roulante pour selectionner le profil à desactiver
                      echo "<form action='compte_action.php' method='post'>";
                      echo "<select name='validite'>";
                      
                      while($requete_utilisateur1 = $requete_utilisat -> fetch_assoc())
                      {
                          echo "<option value=".$requete_utilisateur1['cpt_pseudo']."><p>".$requete_utilisateur1['cpt_pseudo']."</p></option>";
                      }
                      
                      echo "</select>";
                      echo "<p><input type='submit'value='Valider'></p>";
                      echo "</form>";
                      $mysqli->close();
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