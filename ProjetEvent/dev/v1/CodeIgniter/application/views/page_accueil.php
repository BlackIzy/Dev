  <!-- Hero Section Begin -->
  <section class="hero spad set-bg" data-setbg="<?php echo base_url();?>style/img/hero-bg.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero__text">
                        <span>UNIVERSITE OCCIDENTAL DE BRETAGNE</span>
                        <h1>BAL DE PROMO</h1>
                        <p> A l'occasion de leurs fin de cycle en licence, nos diplomés en mention informatique organisent 
                            un bal de promo. Venez massivement pour vivre une expérience que personne ne veut se faire raconter. </p>
                        <h1>Du 31-06-2022 au 03-07-2022</h1>
                        <h1>Brest</h1>
                    </div>
                </div>
            </div>
        </div>
       
    </section>
    <!-- Hero Section End -->
 
 

      <!-- Countdown Section Begin -->
  <section class="countdown spad set-bg" data-setbg="<?php echo base_url();?>style/img/countdown-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="countdown__text">
                    <h1><?php echo $titre;?></h1>
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                            <th scope="col">Titre</th>
                            <th scope="col">Texte</th>
                            <th scope="col">Date</th>
                            <th scope="col">Auteur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                        if($actu != NULL) {
                                            foreach($actu as $all){
                                                echo "<tr>";
                                                echo "<th scope='row'>"; echo $all['act_intitule']; echo "</th>";
                                                echo "<td>"; echo $all['act_texte']; echo "</td>"; 
                                                echo "<td>"; echo $all['acte_date_de_pub']; echo "</td>";
                                                echo "<td>"; echo $all['cpt_login']; echo "</td>";
                                                echo "</tr>";
                                            }
                                        }
                                        else {
                                            echo "<h4>";
                                            echo "Aucune actualités disponible revenez plus tard :)";
                                            echo "</h4>";
                                        }
                                 
                            ?>
                        </tbody>
                    </table>

                    </div>
                </div>
            </div>
        </div>
</section>
 
 