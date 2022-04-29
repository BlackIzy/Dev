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

    // Requête selectionnant toute les selections de la base
    $requete_selec = "SELECT * FROM t_selection_sel;";
    //echo($requete_selec);
    $requete_sel = $mysqli -> query($requete_selec);
    //Si la requête vaut false affiche un message d'erreur 
    if($requete_sel == false)
    {
        echo("Error: La requete a echoue \n");
        echo("Error: " . $mysqli->connect_errno . "\n");
        echo("Error: " . $mysqli->connect_error . "\n");
    }
                
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
                        <a href="index.php">Acceuil</a>
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



    <!-- blog -->
    <div class="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                    <h2 margin-top : 100px>Nos sélections</h2>
                    </div>
                </div>
                <?php // boucle qui affiche toute les sélections ?>
                <?php while($donne = $requete_sel -> fetch_assoc()) { ?>  
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mar_bottom">
                    <div class="blog_box">
                    <div class="blog_img_box">
                    <figure><img src="images/selizy.png" alt="#"/>
                        <span><?php echo ($donne['sel_date_dajout']) ?></span>
                    </figure>
                    </div>
                    <?php 
                            // requete qui selectionne le premier élement de la selection qui se trouve dans la clause where de la requête 
                            $req_sel =  "SELECT * FROM t_selection_sel JOIN tj_sel_elt USING(sel_numero) JOIN t_element_elt USING(elt_numero) WHERE sel_titre LIKE('".$donne["sel_titre"]."') LIMIT 1 ;"; 
                            //echo $req_sel;

                            $req_query = $mysqli -> query($req_sel);
                            // Si la requête vaut false affiche un message 
                            if($req_query == False)
                            {
                                echo("Error: La requete a echoue \n");
                                echo("Error: " . $mysqli->connect_errno . "\n");
                                echo("Error: " . $mysqli->connect_error . "\n");
                            }
                            // transformation en tableau associatif 
                            $req_fetch = $req_query -> fetch_assoc();   
                    ?>
                    <?php // Constitution du lien vers la page affichageselection avec le numero de la selection et son premier element ?>
                   <h3><?php echo ("<a href ='affichageselection.php?sel_id=".$req_fetch["sel_numero"]."&elt_id=".$req_fetch["elt_numero"]."'> ".$donne["sel_titre"]." </a>") ?></h3>
                    <p><?php echo $donne['sel_texte_introductive'] ?> </p>
                    </div>
                </div>
                <?php } $mysqli->close(); ?>
                
            </div>
        </div>
    </div>
    <!-- footer -->
    <fooetr>
            <div class="copyright">
                <div class="container">
                    <p>© 2019 All Rights Reserved. Design by<a href="https://html.design/"> Free Html Templates</a></p>
                </div>
            </div>
        </div>
    </fooetr>
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