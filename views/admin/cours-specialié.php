<?php
$page_title = "Cours par spécialité";
?>
<div class="row" >
    <div class="col-md-12">
        <h1 class="text-center">Spécialités et cours</h1>

        <h3 class="text-center">Liste des spécialités</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom de la spécialité</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($specialites) && count($specialites) == 0): ?>
                    <tr>
                        <td colspan="3" class="text-center">Aucune spécialité trouvée.</td>
                    </tr>                
                <?php else: ?>
                <?php foreach ($specialites as $specialite): ?>        
                    <tr>
                        <td><?php echo $specialite['id']; ?></td>
                        <td><?php echo $specialite['nom']; ?></td>
                        <td><a href="?id=<?php echo $specialite['id']; ?>" class="btn btn-primary">Voir les cours</a></td>
                    </tr>
                <?php endforeach; ?>
                
            </tbody>
        </table>
    </div>
    <div class="col-md-12 text-center">
        <a href="index.php" class="btn btn-success">Ajouter un cours</a>
        <a href="index.php" class="btn btn-secondary">Retour</a>
    </div>
    <?php endif; ?>
</div>