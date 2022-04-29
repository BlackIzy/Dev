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
                            <th scope="col">Lieux</th>
                            <th scope="col">Services</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                        if($lieu != NULL) 
                                        {
                                            foreach($lieu as $all)
                                            {
                                                if (!isset($traite[$all["lie_nom"]]))
                                                {
                                                    $lie_nom = $all["lie_nom"];
                                                    echo "<tr>";
                                                        echo "<th scope='row'>"; echo $all['lie_nom']; echo "</th>";
                                                        echo "<th scope='row'>";
                                                        foreach($lieu as $serv)
                                                        {
                                                           
                                                            if($serv["lie_nom"] == $all["lie_nom"])
                                                            {
                                                                if(isset($serv["ser_nom"]))
                                                                {
                                                                    echo "<ul>"; echo "<li>"; echo $serv['ser_nom']; echo "</li>"; echo "</ul>";
                                                                }
                                                                else
                                                                {
                                                                    echo "<ul>"; echo "<li>"; echo "Aucun service disponible revenez plus tard"; echo "</li>"; echo "</ul>";
                                                                }
                                                                
                                                                
                                                            }
                                                             
                                                        }
                                                        echo "</th>";
                                                    echo "</tr>";
                                                }
                                                $traite[$all["lie_nom"]]=1;
                                            }

                                        }
                                        else {
                                            echo "<h4>";
                                            echo "Aucun lieu disponible revenez plus tard :)";
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
 
 