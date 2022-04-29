 <!-- Countdown Section Begin -->
 <section class="countdown spad set-bg" data-setbg="<?php echo base_url();?>style/img/countdown-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="countdown__text">
                        <h1>Tomorrowland 2020</h1>
                        <h4>Music festival start in</h4>
                    </div>
                    <div class="countdown__timer" id="countdown-time">
                        <div class="countdown__item">
                            <span>20</span>
                            <p>days</p>
                        </div>
                        <div class="countdown__item">
                            <span>45</span>
                            <p>hours</p>
                        </div>
                        <div class="countdown__item">
                            <span>18</span>
                            <p>minutes</p>
                        </div>
                        <div class="countdown__item">
                            <span>09</span>
                            <p>seconds</p>
                        </div>
                    </div>
                    <div class="buy__tickets">
                        <a href="#" class="primary-btn">Buy tickets</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Countdown Section End -->

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
                                 
                            ?>
                        </tbody>
                    </table>

                    </div>
                </div>
            </div>
        </div>
</section>
 
 