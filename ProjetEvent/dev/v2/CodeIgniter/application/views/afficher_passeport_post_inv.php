<?php if($compte->cpt_etat == "I"){?>
<div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="countdown__text">
                        <br />
                        <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                            <th scope="col">Passeport</th>
                            <th scope="col">Post</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($pass_post != NULL)
                            {
                                foreach($pass_post as $all)
                                {
                                    
                                    if (!isset($traite[$all["pass_id"]])){
                                        $pass_nom = $all["pass_id"];
                                        echo "<tr>";
                                        echo "<th>"; echo $all["pass_id"]; echo "</th>";
                                        foreach($pass_post as $post)
                                        {
                                            if($pass_nom === $post['pass_id'])
                                            {
                                                if(isset($post["pst_mssg"]))
                                                {
                                                    echo "<td>"; 
                                                    echo "<ul>";
                                                    echo "<li>"; echo $post["pst_mssg"]; echo "</li>";
                                                    echo "</ul>";
                                                    echo "</td>";
                                                }
                                                else
                                                {
                                                    echo "<td>"; 
                                                    echo "<ul>";
                                                    echo "<li>"; echo "Pas de post pour ce passeport"; echo "</li>";
                                                    echo "</ul>";
                                                    echo "</td>";
                                                }
                                            
                                            }  
                                            
                                            
                                        }
                                        echo "</tr>";
                                        $traite[$all['pass_id']] = 1;
                                    }
                                }
                            }
                            else
                            {
                                echo "<h1>"; echo "Vous n'avez pas de passeport associer à votre compte !"; echo "</h1>";
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
