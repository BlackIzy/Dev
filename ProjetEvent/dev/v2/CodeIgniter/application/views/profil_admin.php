<?php $user = $_SESSION['username'] ?>
<?php if($compte->cpt_etat == "O"){
        echo "<h1 class='h3 mb-0 text-gray-800'>"; echo "Bienvenue Organisateur ".$user." "; echo "</h1>"; 
?>
<form class="needs-validation" novalidate>
  <div class="form-row">
  <?php foreach($profil as $prof) {
            ?>
    <div class="col-md-4 mb-3">
      <label for="validationTooltip01">Pseudo</label>
      <?php echo "<input class='form-control' type='text' placeholder=".$prof["cpt_login"]." readonly>" ?>
      <div class="valid-tooltip">
        Looks good!
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationTooltip01">Pseudo</label>
      <?php echo "<input class='form-control' type='text' placeholder=".$prof["org_nom"]." readonly>" ?>
      <div class="valid-tooltip">
        Looks good!
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationTooltip01">Nom</label>
      <?php echo "<input class='form-control' type='text' placeholder=".$prof["org_prenom"]." readonly>" ?>
      <div class="valid-tooltip">
        Looks good!
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationTooltip01">Email</label>
      <?php echo "<input class='form-control' type='text' placeholder=".$prof["org_email"]." readonly>" ?>
      <div class="valid-tooltip">
        Looks good!
      </div>
    </div>
  </div>
  <div class="col-md-4 mb-4">
  <a href="<?php echo $this->config->base_url();?>index.php/compte/update_profil" class="btn btn-primary"> Modifier profil </a>
  </div>
</form>
<?php } }

else 
{
    redirect('actualite/afficher_toutes');
}?>
