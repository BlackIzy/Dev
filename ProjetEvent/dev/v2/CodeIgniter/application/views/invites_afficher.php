 <!-- Event Section Begin -->
 <section class="countdown spad set-bg" data-setbg="<?php echo base_url();?>style/img/countdown-bg.jp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title center-title">
                        <h2>Nos invités</h2>
                      
                    </div>
                </div>
            </div>

            <div class="row">
            <?php
                if(isset($inv))
                {
                    foreach ($inv as $all_inv){
                        $inv_nom = $all_inv["inv_nom"];
                        echo "<div class='col-lg-4 col-md-6 col-sm-6'>";
                            echo "<div class='discography__item'>";
                                echo "<div class='discography__item__pic'>";
                                    echo "<img src='../../style/".$all_inv["inv_photo"]."' alt=''>";   
                                echo "</div>";
                                echo "<div class='discography__item__text'>";
                                    echo "<span>"; echo $all_inv["inv_nom"]; echo "</span>";
                                    $cpt = 0;
                                    foreach($pst as $all_post){
                                        
                                        if(strcmp($inv_nom,$all_post["inv_nom"])==0){
                                                if(isset($all_post["pst_mssg"])){
                                                    if($cpt < 2){
                                                        echo "<p>"; echo $all_post["pass_id"]; echo " a posté "; echo $all_post["pst_mssg"]; echo "</p>";
                                                    } 
                                                }
                                                else{
                                                    if($cpt == 0){
                                                        echo "<p>";
                                                        echo "Aucun posts disponible pour l'instant :(";
                                                        echo "</p>";
                                                    }
                                                    
                                                }
                                                $cpt++;    
                                        }
                                        
                                    }
                                    echo "<div class='col-lg-12 offset-lg-1 col-md-12'>";
                                    echo "<div class='footer__social'>";
                                    echo "<div class='footer__social__links'>";
                                    foreach($rsl as $all_rsl){
                                        if(strcmp($inv_nom,$all_rsl["inv_nom"])==0){
                                            if(isset($all_rsl["rsl_url"])){
                                                if($all_rsl["rsl_nom"] == "Facebook"){
                                                    echo "<a href='".$all_rsl["rsl_url"]."'>"; echo "<i class='fa fa-facebook'>"; echo "</i>"; echo "</a>";
                                                }
                                                if($all_rsl["rsl_nom"] == "Twitter"){
                                                    echo "<a href='".$all_rsl["rsl_url"]."'>"; echo "<i class='fa fa-twitter'>"; echo "</i>"; echo "</a>";
                                                }
                                                if($all_rsl["rsl_nom"] == "Instagram"){
                                                    echo "<a href='".$all_rsl["rsl_url"]."'>"; echo "<i class='fa fa-instagram'>"; echo "</i>"; echo "</a>";
                                                }  
                                            }
                                            else{
                                                echo "<p>";
                                                echo "Aucun résaux disponilble pour l'instant";
                                                echo "</p>";
                                            }
                                           
                                        }     
                                    }             
                                        echo "</div>";
                                    echo "</div>";
                                echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>"; 
                    }
                }
                else
                {
                    echo "<h1>"; echo "Aucun invités pour le moment"; echo "</h1>";
                }
                
               
            ?>
            </div>
        </div>
    </section>
    <!-- Event Section End -->