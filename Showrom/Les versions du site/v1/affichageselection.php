<!-- 
Prénom et nom : Abdoulaye Berte
Date de connexion : 01/03/2021
Description : Site web pour vente de vêtement en ligne 
-->

<?php
    //connexion à la base de donnée
    $mysqli = new mysqli('localhost','zberteab0','bki5c6f6','zfl2-zberteab0');
    //si connexion échoue
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
    
    //echo ("Connexion BDD réussie \n");
    
    //Requête selectionnant le contenue de la table presentation
    $requete_presentation = "SELECT * FROM t_presentation_pre;";
    //echo($requete_presentation);

    $requete_presentation = $mysqli -> query($requete_presentation);

    // Si valeur de retour de la requête == false message d'erreur
    if($requete_presentation == false)
    {
        echo("Error: La requete a echoue \n");
        echo("Error: " . $mysqli->connect_errno . "\n");
        echo("Error: " . $mysqli->connect_error . "\n");
    }
    $requete = $requete_presentation -> fetch_assoc();   
       
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Izy</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- owl css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- awesome fontfamily -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->

<body class="main-layout">
   

     <div class="sidebar">
            <!-- Sidebar  -->
            <nav id="sidebar">

                <div id="dismiss">
                    <i class="fa fa-arrow-left"></i>
                </div>

                <ul class="list-unstyled components">

                    <li class="active">
                        <a href="index.php">Accueil</a>
                    </li>
                    <li>
                        <a href="selection.php">Selection</a>
                    </li>
                   
                </ul>

            </nav>
        </div>

    <div id="content">
    <!-- header -->
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="full">
                        <a class="logo" href="index.php"><img src="images/izy.png" alt="#" /></a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="full">
                        <div class="right_header_info">
                            <ul>
                                <li class="dinone">Contactez-nous : <img style="margin-right: 15px;margin-left: 15px;" src="images/phone_icon.png" alt="#"><a href="#"><?php echo $requete['pre_tel'] ?></a></li>
                                <li class="dinone"><img style="margin-right: 15px;" src="images/mail_icon.png" alt="#"><a href="#"><?php echo $requete['pre_mail'] ?></a></li>
                                <li class="dinone"><img style="margin-right: 15px;height: 21px;position: relative;top: -2px;" src="images/location_icon.png" alt="#"><a href="#"><?php echo $requete['pre_adresse'] ?></a></li>
                                <li class="button_user"><a class="button active" href="session.php">Se connecter</a><a class="button" href="inscription.php">Crée un compte</a></li>
                                <li><img style="margin-right: 15px;" src="images/search_icon.png" alt="#"></li>
                                <li>
                                    <button type="button" id="sidebarCollapse">
                                        <img src="images/menu_icon.png" alt="#">
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="title">
                <h1><strong class = "white"><?php echo $requete['pre_texte_de_bienvenue'] ?> </strong></h1>
            </div>
        </div>
    </header>
    <!-- end header -->
    <!-- Our Client -->
<div class="Client">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="title">
          <i><img src="images/title.png" alt="#"/></i>
          <h2>Sélection</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 offset-md-3">
         <div class="Client_box">
        <?php 
                // On verifie que la variale global GET à des données qui lui on été transmise si c'est le cas on entre dans le if 
                if($_GET['sel_id'] && $_GET['elt_id'])
                {
                    //echo "<h3> Eléments disponible </h3>"; 
                    // On récupère les valeurs de sel_id et elt_id dans des variables
                    $valeur_sel_id = $_GET['sel_id'];
                    $valeur_elt_id = $_GET['elt_id']; 

                    // Requete recuperant les autres données de la selection et l'element fournis par la variable global GET
                    $requete_sel = "SELECT * FROM t_selection_sel JOIN tj_sel_elt USING(sel_numero) JOIN t_element_elt USING(elt_numero) WHERE sel_numero = ".$valeur_sel_id." and elt_numero = ".$valeur_elt_id." LIMIT 1;";
                    $requete_selec = $mysqli -> query($requete_sel);

                    // Si la requete vaut false affiche un message 
                    if($requete_selec == false)
                    {
                        echo("Error: La requete a echoue \n");
                        echo("Error: " . $mysqli->connect_errno . "\n");
                        echo("Error: " . $mysqli->connect_error . "\n");
                    }
                    // Tableau associatif crée avec la requête et affiche les données ensuite 
                    $requete_selection = $requete_selec -> fetch_assoc();
                    echo "<img src= ".$requete_selection['elt_fichier_image']." />";
                    echo "<h3> ".$requete_selection['elt_intitule']."  </h3>";
                    echo "<p> ".$requete_selection['elt_descriptif']." </p>";

                    // Requête selectionnant l'élément précedent 
                    $req_sel2 =  "SELECT * FROM t_selection_sel JOIN tj_sel_elt USING(sel_numero) JOIN t_element_elt USING(elt_numero) WHERE sel_numero = ".$valeur_sel_id." and elt_numero < ".$requete_selection['elt_numero']." ORDER BY elt_numero DESC LIMIT 1;";
                    //echo $req_sel2;
                    $req_query2 = $mysqli -> query($req_sel2);
                    if($req_query2 == false)
                    {
                        echo("Error: La requete a echoue \n");
                        echo("Error: " . $mysqli->connect_errno . "\n");
                        echo("Error: " . $mysqli->connect_error . "\n");
                    }
                    // transformation en tableau associatif
                    $req_fetch2 = $req_query2 -> fetch_assoc(); 
                    // Si le tableau associatif avec la clé elt_numero n'est pas vide affiche une flèche en image pour aller sur l'élément precedent 
                    if($req_fetch2['elt_numero'])
                    {
                        echo ("<i><a href ='affichageselection.php?sel_id=".$req_fetch2["sel_numero"]."&elt_id=".$req_fetch2["elt_numero"]."'> <img src='images/icon.jpg'/> </a></i>");
                    }
                    // Requete selectionnant l'élément suivant 
                    $req_sel =  "SELECT * FROM t_selection_sel JOIN tj_sel_elt USING(sel_numero) JOIN t_element_elt USING(elt_numero) WHERE sel_numero = ".$valeur_sel_id." and elt_numero > ".$requete_selection['elt_numero']." LIMIT 1;"; 
                    // echo $req_sel;
                    $req_query = $mysqli -> query($req_sel);

                    if($req_query == false)
                    {
                        echo("Error: La requete a echoue \n");
                        echo("Error: " . $mysqli->connect_errno . "\n");
                        echo("Error: " . $mysqli->connect_error . "\n");
                    }
                    // transformation en tableau associatif
                    $req_fetch = $req_query -> fetch_assoc(); 
                    // Si le tableau associatif avec la clé elt_numero n'est pas vide affiche une flèche en image pour aller sur l'élément suivant 
                    if($req_fetch['elt_numero'])
                    {
                        echo ("<i><a href ='affichageselection.php?sel_id=".$req_fetch["sel_numero"]."&elt_id=".$req_fetch["elt_numero"]."'><img src='images/-2.jpg'/></a></i>");
                    }   
                }
                // Si GET n'a pas d'information à transmettre on affiche un message et un lien pour revenir vers la page selection 
                else
                { 
                    echo "<h3> Pas d'éléments disponible </h3>"; 
                    echo "<p><a href ='selection.php'/> Révenir sur les sélections disponible :) </p>";    
                }  
        ?>
         </div>
      </div>
    </div>
  </div>
</div>  
<!-- end Our Client -->


    <!-- footer -->
    
            <div class="copyright">
                <div class="container">
                    <p>© 2019 All Rights Reserved. Design by<a href="https://html.design/"> Free Html Templates</a></p>
                </div>
            </div>
    
    <!-- end footer -->

    </div>
    </div>
    <div class="overlay"></div>
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>
     <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    
     <script src="js/jquery-3.0.0.min.js"></script>
   <script type="text/javascript">
        $(document).ready(function() {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function() {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>

    <style>
    #owl-demo .item{
        margin: 3px;
    }
    #owl-demo .item img{
        display: block;
        width: 100%;
        height: auto;
    }
    </style>

     
      <script>
         $(document).ready(function() {
           var owl = $('.owl-carousel');
           owl.owlCarousel({
             margin: 10,
             nav: true,
             loop: true,
             responsive: {
               0: {
                 items: 1
               },
               600: {
                 items: 2
               },
               1000: {
                 items: 5
               }
             }
           })
         })
      </script>

</body>

</html>