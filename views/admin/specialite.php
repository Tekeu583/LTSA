<?php
$page_title = "Cours par spécialité";
include  'views/template.php';
?>
<div class="row p-3"  >
    <?php if(isset($_SESSION['success'])): ?>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055">
        <div id="successToast" class="toast align-items-center text-white bg-info border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body mb-3 mt-4">
                    <?= $_SESSION['success'] ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    
    <?php unset($_SESSION['success']); elseif (isset(($_SESSION['error']))): ?>
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055">
        <div id="dangerToast" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body mb-3 mt-4">
                    <?= $_SESSION['error'] ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>    
    <?php unset($_SESSION['error']); endif; ?>
    <div class=" ">
        <h1 class="text-center">Spécialités et cours</h1>
        <?php if (isset($specialites) && count($specialites) == 0): ?>
        <p class="text-center">Aucune spécialité trouvée.</p>
        <?php else: ?>
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">

            <!-- Liste des spécialités -->
            <div class="bg-secondary text-white rounded px-2 py-1">
                <ul class="nav nav-underline" style="flex-direction: row; width: auto;">
                    <?php foreach ((is_array($specialites) ? $specialites : []) as $specialite): ?>
                        <?php
                            // Vérifie si l'id de la spécialité est dans l'URL
                            $active = (isset($_GET['id']) && $_GET['id'] == $specialite['id']) ? 'active fw-bold text-warning' : 'text-white';
                        ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $active ?> px-3 py-2" href="specialite?id=<?= $specialite['id'] ?>">
                                <?= htmlspecialchars($specialite['code']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Boutons -->
            <div class="d-flex gap-2">
                <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editSpecialiteModal">
                    <i class="bi bi-pencil-square"></i> Modifier
                </button>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSpecialiteModal">
                    <i class="bi bi-plus-circle"></i> Nouvelle Spécialité
                </button>
                
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <div class="table-responsive mt-4" >
        <button class="btn btn-outline-primary mb-3" data-bs-toggle="modal" data-bs-target="#addcours" >Nouveau Cours </button>
        <table class="table table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">Code EC</th>
                    <th class="text-center">Intitulé</th>
                    <th class="text-center">Coef</th>
                    <th class="text-center">CM</th>
                    <th class="text-center">TD</th>
                    <th class="text-center">TP</th>
                    <th class="text-center">TPE</th>
                    <th class="text-center">CCTS</th>
                    <th class="text-center text-warning">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($courses)): ?>
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">
                            Aucun cours enregistré pour cette spécialité
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($courses as $cours): ?>
                        <?php if ($cours['specialite'] == ($_GET['id'] ?? null)): ?>
                            <tr class="align-middle">
                                <td class="text-center"><?= htmlspecialchars($cours['codeEc'] ?? '') ?></td>
                                <td class="text-center"><?= htmlspecialchars($cours['intituleEc'] ?? '') ?></td>
                                <td class="text-center"><?= htmlspecialchars($cours['coef'] ?? '') ?></td>
                                <td class="text-center"><?= htmlspecialchars($cours['CM'] ?? '0') ?></td>
                                <td class="text-center"><?= htmlspecialchars($cours['TD'] ?? '0') ?></td>
                                <td class="text-center"><?= htmlspecialchars($cours['TP'] ?? '0') ?></td>
                                <td class="text-center"><?= htmlspecialchars($cours['TPE'] ?? '0') ?></td>
                                <td class="text-center"><?= htmlspecialchars($cours['CCTS'] ?? '0') ?></td>
                                <td class="text-center">
                                    <button 
                                        class="btn btn-outline-warning edit-course-btn"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editcours"
                                        data-id="<?= htmlspecialchars($cours['id']) ?>"
                                        data-codeec="<?= htmlspecialchars($cours['codeEc']) ?>"
                                        data-intitule="<?= htmlspecialchars($cours['intituleEc']) ?>"
                                        data-coef="<?= htmlspecialchars($cours['coef']) ?>"
                                        data-cm="<?= htmlspecialchars($cours['CM']) ?>"
                                        data-td="<?= htmlspecialchars($cours['TD']) ?>"
                                        data-tp="<?= htmlspecialchars($cours['TP']) ?>"
                                        data-tpe="<?= htmlspecialchars($cours['TPE']) ?>"
                                        data-ccts="<?= htmlspecialchars($cours['CCTS']) ?>"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </button>

                                    <button class="btn btn-danger del-course-btn" data-bs-toggle="modal" data-bs-target="#delcours"
                                     data-id="<?= htmlspecialchars($cours['id']) ?>"
                                     data-intitule="<?= htmlspecialchars($cours['intituleEc']) ?>">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- modal section -->
    <div class="modal fade" id="addSpecialiteModal" tabindex="-1" aria-labelledby="addSpecialiteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSpecialiteModalLabel">Ajouter une spécialité</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/admin/specialite">
                        <input type="hidden" name="action" value="addSpecialite">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom de la spécialité</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                            <label for="nom" class="form-label">Code de la spécialité</label>
                            <input type="text" class="form-control" id="code" name="code" required placeholder="ex:GI pour Génie Informatique">
                            <label for="nom" class="form-label">Description</label>
                            <textarea type="text-area" class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="liveToastBtn">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editSpecialiteModal" tabindex="-1" aria-labelledby="editSpecialiteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php 
                // Trouver la spécialité correspondante
                $specialiteToEdit = null;
                foreach ((array)$specialites as $specialite) {
                    if ($specialite['id'] == ($_GET['id'] ?? 0)) {
                        $specialiteToEdit = $specialite;
                        break;
                    }
                }
                
                if ($specialiteToEdit): ?>
                <div class="modal-header">
                    <h5 class="modal-title">Modifier la spécialité: '<?=htmlspecialchars($specialiteToEdit['nom']) ?>'</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/admin/specialite">
                        <input type="hidden" name="action" value="editSpecialite">
                        <input type="hidden" name="id" value="<?=$specialiteToEdit['id'] ?>">
                        
                        <div class="mb-3">
                            <label for="edit-nom" class="form-label">Nom de la spécialité</label>
                            <input type="text" class="form-control" id="edit-nom" name="nom" 
                                value="<?=htmlspecialchars($specialiteToEdit['nom']) ?>" required>
                            
                            <label for="edit-code" class="form-label">Code de la spécialité</label>
                            <input type="text" class="form-control" id="edit-code" name="code" 
                                value="<?=htmlspecialchars($specialiteToEdit['code']) ?>" 
                                required placeholder="ex:GI pour Génie Informatique">
                            
                            <label for="edit-description" class="form-label">Description</label>
                            <textarea class="form-control" id="edit-description" name="description" 
                                    rows="3" required><?=htmlspecialchars($specialiteToEdit['description']) ?></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
                <?php else: ?>
                <div class="modal-body">
                    <div class="alert alert-danger">Spécialité introuvable</div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="delspecialite" tabindex="-1" aria-labelledby="delspecialite" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="/admin/specialite" method="post">
                        <h4>Confirmer la suppression de la spécialité <span class="text-info"><?= htmlspecialchars($spec) ?></span></h4>
                        <input type="hidden" name="action" value="delspecialite">
                        <hr>                    
                        <div>
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-danger">confirmer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--cours-->
    <div class="modal fade" id="addcours" tabindex="-1" aria-labelledby="addcours" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ajouter un cours</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/admin/specialite">
                        <input type="hidden" name="action" value="addCours">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <input type="text"  class="form-control" id="id_specialite" name="id_specialite" value="<?= $_GET['id'] ?>" hidden>
                        <div class="mb-3">
                            <label for="codeEC" class="form-label">codeEC</label>
                            <input type="text" class="form-control" id="codeEC" name="codeEC" required placeholder="ex:GI pour Génie Informatique">
                            <label for="intiuleEC" class="form-label">intituleEC</label>
                            <input type="text" class="form-control" id="intituleEC" name="intituleEC" required >
                            <label for="coef" class="form-label">coef</label>
                            <input type="number" min="1" name="coef" id="coef" class="form-control" required >
                            <label for="cm" class="form-label">CM</label>
                            <input type="number" min="1"  name="cm" id="cm" class="form-control" required >
                            <label for="td" class="form-label">TD</label>
                            <input type="number" min="1"  name="td" id="td" class="form-control" required >
                            <label for="tp" class="form-label">TP</label>
                            <input type="number" min="1"  name="tp" id="tp" class="form-control" required >
                            <label for="tpe" class="form-label">TPE</label>
                            <input type="number" min="1"  name="tpe" id="tpe" class="form-control" required >
                            <label for="ccts" class="form-label">CCTS</label>
                            <input type="number" min="1"  name="ccts" id="ccts" class="form-control" required >                            
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>

                </div>
            </div>
        </div>
    </div>    
    
    <!--editcours-->
    <div class="modal fade" id="editcours" tabindex="-1" aria-labelledby="editcoursLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editcoursLabel">Modifier le cours</h4>
                    <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/admin/specialite">
                        <input type="hidden" name="action" value="editcours">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <input type="hidden" id="edit_cours_id" name="cours_id">
                        
                        <div class="mb-3">
                            <label for="edit_codeEC" class="form-label">codeEC</label>
                            <input type="text" class="form-control" id="edit_codeEC" name="codeEC" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_intituleEC" class="form-label">intituleEC</label>
                            <input type="text" class="form-control" id="edit_intituleEC" name="intituleEC" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_coef" class="form-label">coef</label>
                            <input type="number" min="1" name="coef" id="edit_coef" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_cm" class="form-label">CM</label>
                            <input type="number" min="0" name="cm" id="edit_cm" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_td" class="form-label">TD</label>
                            <input type="number" min="0" name="td" id="edit_td" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_tp" class="form-label">TP</label>
                            <input type="number" min="0" name="tp" id="edit_tp" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_tpe" class="form-label">TPE</label>
                            <input type="number" min="0" name="tpe" id="edit_tpe" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_ccts" class="form-label">CCTS</label>
                            <input type="number" min="0" name="ccts" id="edit_ccts" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--delete cours-->
    <div class="modal fade" id="delcours" tabindex="-1" aria-labelledby="delcours" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="/admin/specialite" method="post">
                        <input type="hidden" name="action" value="delcours" >
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <input type="hidden" name="cours_id" id="cours_id" value="">
                        <h4  id="delcourslabel"></h4>
                        <hr>
                        <div>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button class="btn btn-danger">Confirmer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>        

    </div>    

</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js" integrity="sha384-VQqxDN0EQCkWoxt/0vsQvZswzTHUVOImccYmSyhJTp7kGtPed0Qcx8rK9h9YEgx+" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gérer le clic sur les boutons d'édition
        document.querySelectorAll('.edit-course-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Récupérer les données de l'attribut data
                const id = this.getAttribute('data-id');
                const codeEC = this.getAttribute('data-codeec');
                const intitule = this.getAttribute('data-intitule');
                const coef = this.getAttribute('data-coef');
                const cm = this.getAttribute('data-cm');
                const td = this.getAttribute('data-td');
                const tp = this.getAttribute('data-tp');
                const tpe = this.getAttribute('data-tpe');
                const ccts = this.getAttribute('data-ccts');
                
                // Mettre à jour le titre du modal
                document.getElementById('editcoursLabel').textContent = `Modifier le cours '${intitule}'`;
                
                // Remplir le formulaire
                document.getElementById('edit_cours_id').value = id;
                document.getElementById('edit_codeEC').value = codeEC;
                document.getElementById('edit_intituleEC').value = intitule;
                document.getElementById('edit_coef').value = coef;
                document.getElementById('edit_cm').value = cm;
                document.getElementById('edit_td').value = td;
                document.getElementById('edit_tp').value = tp;
                document.getElementById('edit_tpe').value = tpe;
                document.getElementById('edit_ccts').value = ccts;
            });
        });
        document.querySelectorAll('.del-course-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const intitule = this.getAttribute('data-intitule');

                // Mettre à jour le titre du modal
                document.getElementById('delcourslabel').innerHTML = `Supprimer  le cours <span class="text-info">${intitule}</span> de la specialité <span class="text-warning"><?= htmlspecialchars($spec) ?></span> ?`;
                document.getElementById('cours_id').value = id;

                
            });
        });
    });
    
    function handleToastWithHover(toastId) {
    const toastEl = document.getElementById(toastId);
    if (!toastEl) return;

    const toastInstance = new bootstrap.Toast(toastEl, {
        autohide: true
    });

    toastEl.addEventListener('mouseenter', () => {
        toastInstance._config.autohide = false;
    });

    toastEl.addEventListener('mouseleave', () => {
        toastInstance._config.autohide = true;
        toastInstance.hide();
    });

    toastInstance.show();
}

    
    handleToastWithHover('successToast');
    handleToastWithHover('dangerToast');


</script>