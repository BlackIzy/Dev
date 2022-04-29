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

   
    
    <fooetr>
        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                 
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                      
                        <form id = "main_slider" action = "action.php" method = "post">
                            <div class="row">
                            <div class=" col-md-12">
                                    <?php   
                                              // Si la method poste contient des données on entre dans le if
                                              if($_POST)
                                              {
                                                   // Des variable qui vont nous permettre de verifier des conditions plus en bas dans le code
                                                    $ok_uti = false;
                                                    $ok_cpt = false;
                                                    $ok_saisie = true;


                                                    // les valeurs du statut de profil et de la validite dans des variables 
                                                    $statut_profil = "R";
                                                    $valid_profil = "D";

                                                    // Vérification des données transmises 
                                                    $nom = htmlspecialchars(addslashes($_POST['nom']));
                                                    $prenom = htmlspecialchars(addslashes($_POST['prenom']));
                                                    $e_mail = htmlspecialchars(addslashes($_POST['e-mail']));
                                                    $pseudo = htmlspecialchars(addslashes($_POST['pseudo']));
                                                    $mdp = htmlspecialchars(addslashes($_POST['mdp']));
                                                    $mdp1 = htmlspecialchars(addslashes($_POST['mdp1']));


                                                    // Requete verifie l'existance de ce pseudo dans la base
                                                    $requete_pseudo = "SELECT COUNT(*) as result FROM t_compte_cpt JOIN t_utilisateur_uti USING(cpt_pseudo) WHERE cpt_pseudo='".$pseudo."';";
                                                    $row = $mysqli -> query($requete_pseudo);
                                                    
                                                    // Si la requête == false affiche un message d'erreur
                                                    if($row == false)
                                                    {
                                                        echo("Error: La requete a echoue \n");
                                                        echo("Error: " . $mysqli->connect_errno . "\n");
                                                        echo("Error: " . $mysqli->connect_error . "\n");
                                                    }
                                                    // Transformation en tableau associatif
                                                    $row1 = $row -> fetch_assoc();
                                              }
                                              // Si la method post ne contient pas d'élément affiche un lien pour revenir sur la page d'inscription
                                              else
                                              {
                                                echo("<div class=\"row\">");
                                                echo("<div class=\"col-md-12\">");
                                                echo("<h2>Rendez vous sur le formualire <a href ='inscription.php'> Cliquez ici :)<strong class=\"white\"> </strong></a></h2>");
                                                echo("</div>");
                                                  exit();
                                              }
                                                // Si la method post maque d'un element on affiche un message et la variable ok_saise == false
                                                if(empty($_POST['nom']) && empty($_POST['prenom']) && empty($_POST['e_mail']) && empty($_POST['pseudo']) && empty($_POST['mdp']) && empty($_POST['mdp']) && $_POST['mdp1'])
                                                {
                                                    echo("<div class=\"row\">");
                                                    echo("<div class=\"col-md-12\">");
                                                    echo("<h2>Remplissez tous<strong class=\"white\"> les champs  </strong></h2>");
                                                    echo("</div>");
                                                    $ok_saisie = false;
                                                }
                                                // Si le champs mdp et vmdp sont pas identique on affiche un message ok_saisie == false
                                                elseif(strcmp($_POST['mdp'], $_POST['mdp1']) != 0)
                                                {
                                                    echo("<div class=\"row\">");
                                                    echo("<div class=\"col-md-12\">");
                                                    echo("<h2>Mot de  <strong class=\"white\"> passe différents  </strong></h2>");
                                                    echo("</div>");
                                                    $ok_saisie = false;
                                                }
                                                // S'il y'a déjà le pseudo dans la base affiche un message 
                                                elseif( $row1["result"] > 0)
                                                {
                                                    echo("<div class=\"row\">");
                                                    echo("<div class=\"col-md-12\">");
                                                    echo("<h2>Le pseudo  <strong class=\"white\"> existe déjà  </strong></h2>");
                                                    echo("</div>");
                                                    $ok_saisie = false;
                                                }
                                                // Si le mot de passe est inferieur est à afficher un message
                                                elseif( strlen($mdp) < 3)
                                                {
                                                    echo("<div class=\"row\">");
                                                    echo("<div class=\"col-md-12\">");
                                                    echo("<h2>Mot de passe  <strong class=\"white\"> trop court  </strong></h2>");
                                                    echo("</div>");
                                                    $ok_saisie = false;
                                                }
                                                // Si l'adresse email ne contient pas le @ affiche un message
                                                elseif(preg_match('#@#', $e_mail) == 0)
                                                {
                                                    echo("<div class=\"row\">");
                                                    echo("<div class=\"col-md-12\">");
                                                    echo("<h2>Saisissez une adresse  <strong class=\"white\"> mail correct :)  </strong></h2>");
                                                    echo("</div>");
                                                }
                                                // Sinon on insert le pseudo et le mot de passe dans la table des comptes et on place le resultat dans la variable ok_cpt qui vallait false au debut
                                                else
                                                {
                                                    $insertion_des_donnees_cpt = "INSERT INTO t_compte_cpt VALUES('".$pseudo."' ,  MD5('".$mdp."') );";
                                                    $ok_cpt = $mysqli ->query($insertion_des_donnees_cpt);
                                                }
                                                // Si la variable ok_cpt == true on insert les données de la table utilisateur
                                                if($ok_cpt == true)
                                                {
                                                    $insertion_des_donnees_uti = "INSERT INTO t_utilisateur_uti VALUES('".$nom."' , '".$prenom."' , '".$e_mail."', '".$valid_profil."', '".$statut_profil."' , curdate() , '".$pseudo."');";
                                                    $ok_uti = $mysqli -> query($insertion_des_donnees_uti);
                                                }
                                                // Sinon on efface on s'assure qu'aucune donnée n'a été entre dans la base
                                                else
                                                {
                                                    $delete_uti = "DELETE FROM t_utilisateur_uti WHERE uti_nom = '".$nom."' AND uti_prenom = '".$prenom."';";
                                                    $delete_uti_t = $mysqli -> query($delete_uti);
                                                }
                                                // Si les deux variables ok_cpt et ok_uti == true On affiche un message pour dire que l'inscription à reussie
                                                if($ok_cpt == true && $ok_uti == true)
                                                {
                                                    echo("<div class=\"row\">");
                                                    echo("<div class=\"col-md-12\">");
                                                    echo("<h2><strong class=\"white\"> Inscription réussie </strong></h2>");
                                                    echo("</div>");
                                                    echo("<h2>Page d'accueil <a href ='inscription.php'> Cliquez ici :)<strong class=\"white\"> </strong></a></h2>");
                                                    echo("</div>");
                                                    exit();
                                                }
                                                // Sinon on s'assure qu'aucune données n'a été entre dans la base et on affiche un message pour dire que l'inscription à échouer
                                                else
                                                {
                                                    $delete_uti = "DELETE FROM t_utilisateur_uti WHERE uti_nom = '".$nom."' AND uti_prenom = '".$prenom."';";
                                                    $delete_uti_t = $mysqli -> query($delete_uti);
                                                    $delete_cpt = "DELETE FROM t_compte_cpt WHERE cpt_pseudo = '".$pseudo."' AND cpt_mot_de_passe = MD5('".$mdp."');";
                                                    $delete_cpt_t = $mysqli -> query($delete_cpt);
                                                    echo("<div class=\"row\">");
                                                    echo("<div class=\"col-md-12\">");
                                                    echo("<h2><strong class=\"white\"> Inscription échoué </strong></h2>");
                                                    echo("</div>");
                                                    $ok_saisie = false;
                                                }
                                                // Après avoir saisie les données et affichez les messages d'erreur on réaffiche le formulaire avec les valeurs déjà entre sauf pour les champs mdp 
                                                // Si la valeur ok_sasie == false
                                                if($ok_saisie == false)
                                                {
                                                    echo("<form id = \"main_slider\" action = \"action.php\" method = \"post\">");
                                                            echo("<div class=\"col-xl-12 col-lg-12 col-md-12 col-sm-12\">");
                                                                echo("<input class=\"form-control\" placeholder=\"Nom\" type=\"text\" value = \"$nom\"  name=\"nom\">");
                                                            echo("</div>");
                                                            echo("<div class=\"col-xl-12 col-lg-12 col-md-12 col-sm-12\">");
                                                                echo("<input class=\"form-control\" placeholder=\"Prénom\" type=\"text\" value = \"$prenom\"  name=\"prenom\">");
                                                            echo("</div>");
                                                            echo("<div class=\"col-xl-12 col-lg-12 col-md-12 col-sm-12\">");
                                                                echo("<input class=\"form-control\" placeholder=\"E-mail\" type=\"text\" value = \"$e_mail\"  name=\"e-mail\">");
                                                                echo("</div>");
                                                            echo("<div class=\"col-xl-12 col-lg-12 col-md-12 col-sm-12\">");
                                                                echo("<input class=\"form-control\" placeholder=\"Pseudo\" type=\"text\" value = \"$pseudo\"  name=\"pseudo\">");
                                                            echo("</div>");
                                                            echo("<div class=\"col-xl-12 col-lg-12 col-md-12 col-sm-12\">");
                                                                echo("<input class=\"form-control\" placeholder=\"Mot de passe\" type=\"password\" value =   name=\"mdp\">");
                                                            echo("</div>");
                                                            echo("<div class=\"col-xl-12 col-lg-12 col-md-12 col-sm-12\">");
                                                                echo("<input class=\"form-control\" placeholder=\"Vérification mot de passe\" type=\"password\" value =   name=\"mdp1\">");
                                                            echo("</div>");
                                                            echo("<div class=\"col-xl-12 col-lg-12 col-md-12 col-sm-12\">");
                                                                echo("<button class=\"send\"> Envoyer </\"button\">"); 
                                                            echo("</div>");
                                                        echo("</div>");
                                                    echo("</form>");
                                                }
                                                 // Deconnection de la base
                                                    $mysqli->close(); 
                                            ?>
                        </form>
                    </div>
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