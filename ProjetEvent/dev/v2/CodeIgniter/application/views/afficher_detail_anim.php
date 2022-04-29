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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                        if($anim != NULL) {
                                            $cpt = 0;
                                            $verif =0;
                                            $verif_1 =0;
                                            $evrif_2 =0;
                                            foreach($anim as $all){
                                                if (!isset($traite[$all["ani_intitule"]])){
                                                    $ani_nom = $all["ani_intitule"];
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
                                       
                                                }
                                                echo "</td>";
                                                
                                                $traite[$all["ani_intitule"]]=1;
                                                
                                                

                                                echo "</tr>";
                                            }
                                        }
                                 
                            ?>
                        </tbody>
                    </table>

                    </div>
                </div>
            </div>
        </div>
</section>