<?php $user = $_SESSION['username'] ?>

<?php if($compte->cpt_etat == "I"){ echo "<h1 class='h3 mb-0 text-gray-800'>"; echo "Bienvenue Invité ".$user." "; echo "</h1>"; ?>
    
<form class="needs-validation" novalidate>
  <div class="form-row">
  <?php foreach($profil as $prof) {
       $prof["inv_nom"] = str_replace(" ", "_", $prof["inv_nom"]); 
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
      <?php echo "<input class='form-control' type='text' placeholder=".stripslashes($prof['inv_nom'])." readonly>"; ?>
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
      <?php if(isset($rsl["rsl_nom"])){ ?> 
        <?php echo "<label for='validationTooltip02'>"; echo ''.$rsl["rsl_nom"].''; echo "</label>"; ?>
        <?php echo "<input class='form-control' type='text' placeholder=".$rsl["rsl_url"]." readonly>" ?>
      <?php } 
            else
            {
              echo "<input class='form-control' type='text' placeholder='Pas de lien pour cet invité' readonly>";
            }
      ?>
      <div class="valid-tooltip">
        Looks good!
      </div>
    </div>
  <?php }?>
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
        <?php  $traite[$prof["inv_nom"]]=1; } }?>
  </div>
  <div class="col-md-4 mb-4">
  <a href="<?php echo $this->config->base_url();?>index.php/compte/update_profil" class="btn btn-primary"> Modifier profil </a>
  </div>
</form>
<?php } 
else
{
    redirect('actualite/afficher_toutes');
} 
?>