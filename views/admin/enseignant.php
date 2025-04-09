<?php 
ob_start();
    if(!empty($_SESSION['alert'])):
        ?>
        <div class="alert alert-<?=$_SESSION['alert']['type']?>" role="alert">
        <?=$_SESSION['alert']['msg']?>
        </div>
        
        <?php 
        unset($_SESSION['alert']);
    endif;
    $titre="enseignant";
?>
    <h2 class="titre text-center">Les enseignants chercheur  de LTSA</h2>
    <div class="d-flex justify-content-end h2 w-100 w-md-50" ><a href="index.php?page=enseignant/a" class="pb-1 pt-1 pl-5 pr-5  float-right"style="background: var(--color-vert); border-radius: 50px; color: var(--text-white)">ajouter</a></div>
    <div class="justify-content-center">
        <?php if (!empty($error)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($error as $errors): ?>
                                <li><?php echo htmlspecialchars($errors);?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
        </div>
    <div class="table table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr class="border border-end-2">
                        <th>Id</th>
                        <th>Noms et Prénoms</th>
                        <th>Grade</th>
                        <th>Fonction</th>
                        <th>Lieu de Travail</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($enseignants) && count($enseignants) == 0): ?>
                            <tr class="border border-end-2">
                                <td colspan="7" class="text-center">Aucun enseignant trouvé.</td>
                            </tr>                
                        <?php else: ?>
                        <?php foreach ($enseignants as $enseignant): ?>        
                            <tr class="border border-end-2">
                                <td><?php echo $enseignant['id']; ?></td>
                                <td><?php echo $enseignant['nom']; ?></td>
                                <td><?php echo $enseignant['grade']; ?></td>
                                <td><?php echo $enseignant['fonction']; ?></td>
                                <td><?php echo $enseignant['lieuTravail']; ?></td>
                                <td><a href="index.php?page=enseignant/m/<?=$enseignant['id']?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                <td>
                                    <form method="post" action="index.php?page=enseignant/s/<?=$enseignant['id'] ?>" onsubmit="return confirm('voulez-vous vraiment supprimer ?'); ">
                                        <button type="submit" class="border border-none" style="background: var(--text-white);"><i class="fa-solid fa-trash text-info transparent"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        
                    </tbody>
                </table>
        </div>

<?php
$content=ob_get_clean();
require("template.php");
?>
    
    
