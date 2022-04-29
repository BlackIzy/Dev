
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="countdown__text">
                    <h1><?php echo $titre;?></h1>
                        <br />
                        <?php 
                            echo "<p>";
                            if($pseudos != NULL) {
                            foreach($pseudos as $login){
                                
                                echo "<h4>";
                                echo $login["cpt_login"];
                                echo "</h4>";
                                echo "<h4>";
                                echo $login["cpt_mdp"];
                                echo "</h4>";
                                
                            }
                            echo "</p>";
                            }
                            else {
                                echo "<h4>";
                                echo "Aucun compte !";
                                echo "</h4>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <!-- Countdown Section End -->