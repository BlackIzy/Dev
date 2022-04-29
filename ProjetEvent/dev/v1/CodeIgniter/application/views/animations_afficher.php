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
                                <th scope="col">Date de début</th>
                                <th scope="col">Date de fin</th>
                                <th scope="col">Lieu</th>
                                <th scope="col">Invités</th>
                                <th scope="col">Détails</th>
                            </tr>
                    </thead>
                        <tbody>
                            <?php
                                        if($anim !== NULL) {
                                            $cpt = 0;
                                            $verif =0;
                                            $verif_1 =0;
                                            $evrif_2 =0;
                                            foreach($anim as $all){
                                                if (!isset($traite[$all["ani_intitule"]])){
                                                    $ani_nom = $all["ani_intitule"];
                                                    
                                                    $date = date("Y-m-d H:i:s");
                                                    
                                                    if($all["ani_date_fin"] < $date){ $etat = "Animation passée";}
                                                    else if($all["ani_date_debut"] > $date){$etat = "Animation à venir"; }
                                                    else if($date > $all["ani_date_debut"] &&  $date < $all["ani_date_fin"]){$etat = "Animation en cours"; }
                                                    else{echo "verifier la date";}
                                                    
                                                    if($verif == 0 && $etat == "Animation passée"){
                                                        echo "<th>";
                                                        
                                                        echo "<div class='container'>";
                                                        echo "<div class='row'>";
                                                        echo "<div class='col-lg-12'>";
                                                        echo "<div class='hero__text'>";
                                                            
                                                            echo "<p>"; echo $etat; echo "</p>";
                                                        echo "</div>";
                                                        echo "</div>";   
                                                        echo "</div>";
                                                        echo "</div>";
                                                        
                                                        echo "</th>";
                                                        
                                                        $verif++;
                                                    }
                                                    else if($verif_1 == 0 && $etat == "Animation en cours"){
                                                        echo "<td>";
                                                        echo "<div class='container'>";
                                                        echo "<div class='row'>";
                                                        echo "<div class='col-lg-12'>";
                                                        echo "<div class='hero__text'>";
                                                            
                                                            echo "<p>"; echo $etat; echo "</p>";
                                                        echo "</div>";
                                                        echo "</div>";   
                                                        echo "</div>";
                                                        echo "</div>";
                                                        echo "</td>";
                                                        $verif_1++;
                                                    }
                                                    else if($evrif_2 == 0 && $etat == "Animation à venir"){
                                                        echo "<td>";
                                                        echo "<div class='container'>";
                                                        echo "<div class='row'>";
                                                        echo "<div class='col-lg-12'>";
                                                        echo "<div class='hero__text'>";
                                                            
                                                            echo "<p>"; echo $etat; echo "</p>";
                                                        echo "</div>";
                                                        echo "</div>";   
                                                        echo "</div>";
                                                        echo "</div>";
                                                        echo "</td>";
                                                        $evrif_2++;
                                                    }
                                                        
                                                    
                                                    echo "<tr>"; 
                                                    echo "<td>"; echo $all['ani_intitule']; echo "</td>"; 
                                                    echo "<td>"; echo $all['ani_date_debut']; echo "</td>";
                                                    echo "<td>"; echo $all['ani_date_fin']; echo "</td>";
                                                    if(isset($all["lie_nom"])){
                                                        echo "<td>"; echo $all['lie_nom']; echo "</td>";
                                                    }
                                                    else{
                                                        echo "<h4>";
                                                            echo "Aucun lieu disponible revenez plus tard :)";
                                                            echo "</h4>";
                                                    }
                                                    
                                                    echo "<td>"; 

                                                    foreach($anim as $all_inv){
                                                        echo "<ul class='list-group'>";
                                                        if(strcmp($ani_nom,$all_inv["ani_intitule"])==0){
                                                            if(isset($all_inv["inv_nom"])){
                                                                echo "<li class='list-group-item list-group-item-dark'>"; echo $all_inv["inv_nom"]; echo "--"; echo $all_inv["inv_discipline"]; echo "</li>";
                                                            }
                                                            else{
                                                                echo "<span>";
                                                                echo "Aucun invités disponible revenez plus tard :)";
                                                                echo "</span>";
                                                            }
                                                           
                                                             
                                                        }
                                                        echo "</ul>";
                                                    }
                                                        
                                                        echo "</td>"; 
                                                       
                                                        echo "<td>"; 
                                                        echo "<div class='col-lg-12'>";
                                                        echo "<div class='hero__text'>"; 
                                                        ?>
                                                        <a href="<?php echo $this->config->base_url();?>index.php/animation/afficher_detail_anim/<?php echo $all["ani_id"]?>" class="btn btn-secondary">Détail</a>
                                                        <?php
                                                        echo "</div>";
                                                        echo "</div>";
                                                        echo "<div class='col-lg-12'>";
                                                        echo "<div class='hero__text'>"; 
                                                        ?>
                                                        <a href="<?php echo $this->config->base_url();?>index.php/animation/afficher_detail_anim_inv/<?php echo $all["ani_id"]?>" class="btn btn-secondary">Invités</a>
                                                        <?php
                                                        echo "</div>";
                                                        echo "</div>";
                                                        echo "<div class='col-lg-12'>";
                                                        echo "<div class='hero__text'>";
                                                        ?>
                                                        <a href="<?php echo $this->config->base_url();?>index.php/animation/afficher_detail_anim_lieu/<?php echo $all["ani_id"]?>" class="btn btn-secondary">Lieu</a>
                                                        <?php
                                                        echo "</div>";
                                                        echo "</div>";
                                                        echo "</td>";
                                                    
                                                        
                                                   
                                                    echo "</tr>";

                                                    }
                                                    
                                                    $traite[$all["ani_intitule"]]=1;
                                                    
                                                }
                                                
                                        }
                                        else
                                        {
                                            echo "<h1>"; echo "Aucune animations disponible pour le moment"; echo "</h1>";
                                        }
                                 
                            ?>
                        </tbody>
                    </table>

                    </div>
                </div>
            </div>
        </div>
</section>