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
    <h2 class="titre text-center">Les messages des visiteurs  de LTSA</h2>
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
                        <th>Objet</th>
                        <th>Message</th>
                        <th>Statut</th>
                        <th>Repondre</th>
                        <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($enseignants) && count($enseignants) == 0): ?>
                            <tr class="border border-end-2">
                                <td colspan="7" class="text-center">Aucun message trouvé.</td>
                            </tr>                
                        <?php else: ?>
                        <?php foreach ($messages as $message): ?>        
                            <tr class="border border-end-2">
                                <td><?php echo $message['id']; ?></td>
                                <td><?php echo $message['nom']; ?></td>
                                <td><?php echo $message['email']; ?></td>
                                <td><?php echo $message['objet']; ?></td>
                                <td><?php echo $message['message']; ?></td>
                                <td><?php echo $message['statut']; ?></td>
                                <td><a href="index.php?page=contact/formresponse/<?=$message['id']?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                <td>
                                    <form method="post" action="index.php?page=contact/suppMail/<?=$message['id'] ?>" onsubmit="return confirm('voulez-vous vraiment supprimer ?'); ">
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
$titre = "messages";
$content=ob_get_clean();
require("template.php");
?>
    
    
