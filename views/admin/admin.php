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
    $titre="administrateurs";
    ?>
    <h2 class="titre text-center">les administrateurs du site   de LTSA</h2>
    <div class="d-flex justify-content-end h2 w-100 w-md-50" ><a href="index.php?page=admin/a" class="pb-1 pt-1 pl-5 pr-5  float-right"style="background: var(--color-vert); border-radius: 50px; color: var(--text-white)">ajouter</a></div>
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
                        <th>Email</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($admins) && count($admins) == 0): ?>
                        <tr class="border border-end-2">
                            <td colspan="5" class="text-center">Aucun administrateur trouvé.</td>
                        </tr>
                    <?php else: ?>
                    <?php foreach ($admins as $admin): ?>        
                        <tr class="border border-end-2">
                            <td><?php echo $admin['id']; ?></td>
                            <td><?php echo $admin['nom']; ?></td>
                            <td><?php echo $admin['email']; ?></td>
                            <td><a href="index.php?page=admin/m/<?= $admin['id']?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                            <td>
                                <form method="post" action="index.php?page=admin/s/<?= $admin['id'] ?>" onsubmit="return confirm('voulez-vous vraiment supprimer ?'); ">
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