<?php if($compte->cpt_etat == "I"){   echo "<h1>"; echo $succes; echo "</h1>"; ?>
<form class="needs-validation" novalidate>
  <div class="form-row">
  <?php foreach($profil as $prof) {
            if (!isset($traite[$prof["inv_nom"]])){ 
            ?>
    <div class="col-md-4 mb-3">
      <label for="validationTooltip01">Pseudo</label>
      <?php echo "<input class='form-control' type='text' placeholder=".$prof["cpt_login"]." readonly>" ?>
      <div class="valid-tooltip">
        Looks good!
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationTooltip01">Nom</label>
      <?php echo "<input class='form-control' type='text' placeholder=".$prof["inv_nom"]." readonly>" ?>
      <div class="valid-tooltip">
        Looks good!
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationTooltip02">Discipline</label>
      <?php echo "<input class='form-control' type='text' placeholder=".$prof["inv_discipline"]." readonly>" ?>
      <div class="valid-tooltip">
        Looks good!
      </div>
    </div>
  
  <?php foreach($profil as $rsl) { ?>
    <div class="col-md-4 mb-3">
      <?php echo "<label for='validationTooltip02'>"; echo ''.$rsl["rsl_nom"].''; echo "</label>"; ?>
      <?php echo "<input class='form-control' type='text' placeholder=".$rsl["rsl_url"]." readonly>" ?>
      <div class="valid-tooltip">
        Looks good!
      </div>
    </div>
  <?php }?>
  
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationTooltip03">Présentation</label>
       <input class='form-control' type='text' placeholder="Saisser une nouvelle présentation" readonly>
      <div class="invalid-tooltip">
        Please provide a valid city.
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationTooltip04">Biographie</label>
      <input class='form-control' type='text' placeholder="Saisser une nouvelle biographie" readonly>
      <div class="invalid-tooltip">
        Please provide a valid state.
      </div>
    </div>
    <div class="col-md-12 mb-6">
    <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">Biographie</th>
            <th scope="col">Présentation</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <?php echo "<td>"; echo ''.$prof["inv_biographie"].''; echo "</td>";
            echo "<td>"; echo ''.$prof["inv_presentation"].''; echo "</td>";
            ?>
            </tr>
        </tbody>
    </table>
    </div>
    </div>
    </div>
</form>

<?php echo validation_errors(); ?>
<?php echo form_open('compte/update_profil');; ?>
    <form class="user">
    <div class="col-md-4 mb-3">
        <div class="form-group">
            <input type="password" class="form-control form-control-user" name="mdp" placeholder="Mot de passe">
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="form-group">
            <input type="password" class="form-control form-control-user" name="mdp_c" placeholder="Confirmer le mot de passe">
        </div>
    </div>    
    <div class="col-md-12 mb-6">
    <div class="col-md-3 mb-3">
            <input type="submit" class="btn btn-primary" name="submit" value="Modifier" />
    </div>
    <div class="col-md-3 mb-3">
            <a href="<?php echo $this->config->base_url();?>index.php/compte/profil" class="btn btn-primary"> Annuler </a>
    </div>
    </div>
    </form>

<?php  $traite[$prof["inv_nom"]]=1; } }?>
<?php }
    else if($compte->cpt_etat == "O"){
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
</form>

<?php echo validation_errors(); ?>
<?php echo form_open('compte/update_profil');; ?>
    <form class="user">
    <div class="col-md-4 mb-3">
        <div class="form-group">
            <input type="password" class="form-control form-control-user" name="mdp" placeholder="Mot de passe">
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="form-group">
            <input type="password" class="form-control form-control-user" name="mdp_c" placeholder="Confirmer le mot de passe">
        </div>
    </div>    
    <div class="col-md-12 mb-6">
    <div class="col-md-3 mb-3">
            <input type="submit" class="btn btn-primary" name="submit" value="Modifier" />
    </div>
    <div class="col-md-3 mb-3">
            <a href="<?php echo $this->config->base_url();?>index.php/compte/profil" class="btn btn-primary"> Annuler </a>
    </div>
    </div>
    </form>
<?php } }?>

