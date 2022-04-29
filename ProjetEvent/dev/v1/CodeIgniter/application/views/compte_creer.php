<section class="countdown spad set-bg" data-setbg="<?php echo base_url();?>style/img/countdown-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="countdown__text">
                    <?php echo validation_errors(); ?>
                    <?php echo form_open('compte_creer'); ?>
                    <div class="row">
                            <div class=" col-md-12">
                                <h1><strong> Veillez remplir les champs </strong></12>
                            </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6">
                                    <input class="form-control" placeholder="Identifiant" type="text" name="id">
                                </div>
                                <div class="col-xl-16 col-lg-6 col-md-6 col-sm-6">
                                    <input class="form-control" placeholder="Mot de passe" type="password" name="mdp">
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                     <input type="submit" name="submit" value="Créer un compte" />
                                </div>
                            </div>
                           
                    </form>
                    </div>
                </div>
            </div>
        </div>
       
</section>


