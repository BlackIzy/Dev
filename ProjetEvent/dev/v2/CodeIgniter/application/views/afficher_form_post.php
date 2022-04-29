  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url();?>style/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url();?>style/css/sb-admin-2.min.css" rel="stylesheet">

<section class="countdown spad set-bg" data-setbg="<?php echo base_url();?>style/img/countdown-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="countdown__text">
                    <?php echo validation_errors(); ?>
                    <?php echo form_open('post/poster');; ?>
                    <div class="row">
                    <div class="col-xl-10 col-lg-12 col-md-9">
                    <h1><?php echo $error; ?></h1>
                    <?php 
                    if(isset($_SESSION [ 'message' ]))
                    {
                        echo "<h1>"; echo $_SESSION [ 'message' ]; echo "</h1>";
                    }
                    ?> 
                    <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div class="row">
                                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                    <div class="col-lg-6">
                                        <div class="p-5">
                                            <div class="text-center">
                                            <h1><?php echo $error; ?></h1>
                                                <h1 class="h4 text-gray-900 mb-4">Veillez remplir les champs</h1>
                                            </div>
                                            <form class="user">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-user" name="pass" placeholder="Pass">
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control form-control-user" name="mdp" placeholder="Mot de passe">
                                                </div>
                                                <div class="form-group">
                                                <textarea class="form-control form-control-user" placeholder="Message à poster" name="mssg" rows="3"></textarea>    
                                                </div>
                                                <input class="btn btn-primary" type="submit" name="submit" value="Poster" />
                                                <a href="<?php echo $this->config->base_url();?>index.php" class="btn btn-primary"> Annuler </a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
       
</section>
       

                                          