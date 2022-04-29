
  <!-- Countdown Section Begin -->
  <section class="countdown spad set-bg" data-setbg="<?php echo base_url();?>style/img/countdown-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="countdown__text">
                    <h1><?php echo $titre;?></h1>
                        <br />
                        <?php 
                            if(isset($actu)) {
                                echo "<h4>";
                                echo $actu->act_id; 
                                echo "</h4>";
                                echo "</br>";
                                echo "<p>";
                                echo $actu->act_texte;
                                echo("</p>");
                            }
                            else {
                                echo "<br />";
                                echo "pas d’actualité !";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Countdown Section End -->

 <!-- Countdown Section Begin -->
 <section class="countdown spad set-bg" data-setbg="../../style/img/countdown-bg.jpg">
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


