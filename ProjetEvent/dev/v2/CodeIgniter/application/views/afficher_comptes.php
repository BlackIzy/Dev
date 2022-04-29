<?php if($compte->cpt_etat == "O"){ ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="countdown__text">
                        <?php echo "<h1>"; echo $titre; echo "</h1>"; ?>
                        <br />
                        <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                            <th scope="col">Pseudo</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Etat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($cpt as $all)
                                {
                                    echo "<tr>";
                                    echo "<th>"; echo $all["cpt_login"]; echo "</th>";
                                    if($all["cpt_etat"] == "I"){ echo "<td>"; echo $all["inv_nom"]; echo "</td>";}
                                    else{echo "<td>"; echo $all["org_nom"]; echo "</td>";}
                                    echo "<td>"; echo $all["org_prenom"]; echo "</td>";
                                    echo "<td>"; echo $all["org_email"]; echo "</td>";
                                    echo "<td>"; echo $all["cpt_etat"]; echo "</td>";
                                    echo "</tr>";
                                }
                                 
                            ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
<?php }
else
{
    redirect('actualite/afficher_toutes');
}
?>