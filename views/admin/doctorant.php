<?php 
ob_start();
?>
    
    <h2 class="titre text-center">Les doctorants  de LTSA</h2>
    
    <div class="d-flex justify-content-end h2 w-100 w-md-50" ><a href="index.php?page=doctorant/a" class="pb-1 pt-1 pl-5 pr-5  float-right"style="background: var(--color-vert); border-radius: 50px; color: var(--text-white)">ajouter</a></div>
    <div class="table table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr class="border border-end-2">
                        <th>Id</th>
                        <th>Noms et Prénoms</th>
                        <th>intitulé de la thése</th>
                        <th>dates de soutenance</th>
                        <th>formation</th>
                        <th>Numéro d'ordre dans le fichier des theses</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($doctorants as $doctorant): ?>
                        <tr class="border border-end-2">
                        <th><?php echo $doctorant['id'];?></th>
                        <td><?php echo $doctorant['nom'];?></td>
                        <td><?php echo $doctorant['intitule'];?></td>
                        <td><?php echo $doctorant['dates'];?></td>
                        <td><?php echo $doctorant['formation'];?></td>
                        <td><?php echo $doctorant['numero'];?></td>
                        <td><a href="index.php?page=doctorant/m/<?= $doctorant['id'];?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td>
                            <form action="index.php?page=doctorant/s/<?= $doctorant['id'];?>" onsubmit="return confirm('voulez-vous vraiment supprimer ?'); ">
                                <button type="submit" class="border border-none" style="background: var(--text-white);"><i class="fa-solid fa-trash text-info transparent"></i></button>
                            </form>
                        </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
        </div>
<?php
$titre = "doctorant";
$content=ob_get_clean();
require("template.php");
?>
    
    
