<?php
ob_start();
$page_title = "Cours par spécialité";
include 'views/admin/template.php';
?>

<div class="row p-3">
    <!-- Notifications Toast -->
    <?php if(isset($_SESSION['success'])): ?>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055">
        <div id="successToast" class="toast align-items-center text-white bg-info border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body mb-3 mt-4">
                    <?= $_SESSION['success'] ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php unset($_SESSION['success']); elseif (isset($_SESSION['error'])): ?>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055">
        <div id="dangerToast" class="toast align-items-center text-white bg-danger border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body mb-3 mt-4">
                    <?= $_SESSION['error'] ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>    
    <?php unset($_SESSION['error']); endif; ?>

    <div class="">
        <h1 class="text-center">Spécialités et cours</h1>
        
        <?php if (isset($specialites) && count($specialites) == 0): ?>
            <p class="text-center">Aucune spécialité trouvée.</p>
        <?php else: ?>
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
            <!-- Navigation des spécialités -->
            <div class="bg-secondary text-white rounded px-2 py-1">
                <ul class="nav nav-underline" style="flex-direction: row; width: auto;">
                    <?php foreach ((is_array($specialites) ? $specialites : []) as $specialite): ?>
                        <?php $active = (isset($_GET['id']) && $_GET['id'] == $specialite['id']) ? 'active fw-bold text-warning' : 'text-white'; ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $active ?> px-3 py-2" href="specialite?id=<?= $specialite['id'] ?>">
                                <?= htmlspecialchars($specialite['code']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    <li class="nav-item">
                        <a class="nav-link <?= isset($_GET['id']) && $_GET['id'] == 'doctorat' ? 'active fw-bold text-warning' : 'text-white' ?> px-3 py-2" 
                           href="/admin/specialite?id=doctorat">
                            Cycle Doctorat
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Boutons d'actions -->
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
    
    <!-- Contenu principal -->
    <div class="table-responsive mt-4">
        <button class="btn btn-outline-primary mb-3" data-bs-toggle="modal" data-bs-target="#addcours">
            Nouveau Cours
        </button>

        <?php $id = $_GET['id'] ?? null; ?>
        <?php $isDoctorat = ($id === 'doctorat'); ?>

        <!-- Tableau des cours -->
        <?php if ($isDoctorat): ?>
            <!-- Tableau des cours de doctorat -->
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">CodeEC</th>
                        <th class="text-center">IntituléEC</th>
                        <th class="text-center">CréditEC</th>
                        <th class="text-center">AnnéeDoctorat</th>
                        <th class="text-center text-warning">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($doctoratCourses)): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Aucun cours enregistré pour le doctorat
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($doctoratCourses as $cours): ?>
                            <tr class="align-middle">
                                <td class="text-center"><?= htmlspecialchars($cours['codeEc']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($cours['intituleEc']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($cours['creditEc']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($cours['anneeDoctorat']) ?></td>
                                <td class="text-center">
                                    <button class="btn btn-outline-warning edit-course-btn"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editcours"
                                            data-id="<?= $cours['id'] ?>"
                                            data-codeec="<?= $cours['codeEc'] ?>"
                                            data-intitule="<?= $cours['intituleEc'] ?>"
                                            data-credit="<?= $cours['creditEc'] ?>"
                                            data-annee="<?= $cours['anneeDoctorat'] ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-danger del-course-btn" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#delcours"
                                            data-id="<?= $cours['id'] ?>"
                                            data-intitule="<?= $cours['intituleEc'] ?>">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php elseif (ctype_digit($id)): ?>
            <!-- Tableau des cours de spécialité -->
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
                    <?php if (empty($courses)): ?>
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
                                Aucun cours enregistré pour cette spécialité
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($courses as $cours): ?>
                            <?php if ($cours['specialite'] == $id): ?>
                                <tr class="align-middle">
                                    <td class="text-center"><?= htmlspecialchars($cours['codeEc']) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($cours['intituleEc']) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($cours['coef']) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($cours['CM']) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($cours['TD']) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($cours['TP']) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($cours['TPE']) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($cours['CCTS']) ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-warning edit-course-btn"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editcours"
                                                data-id="<?= $cours['id'] ?>"
                                                data-codeec="<?= $cours['codeEc'] ?>"
                                                data-intitule="<?= $cours['intituleEc'] ?>"
                                                data-coef="<?= $cours['coef'] ?>"
                                                data-cm="<?= $cours['CM'] ?>"
                                                data-td="<?= $cours['TD'] ?>"
                                                data-tp="<?= $cours['TP'] ?>"
                                                data-tpe="<?= $cours['TPE'] ?>"
                                                data-ccts="<?= $cours['CCTS'] ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-danger del-course-btn" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#delcours"
                                                data-id="<?= $cours['id'] ?>"
                                                data-intitule="<?= $cours['intituleEc'] ?>">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning text-center mt-4">
                Spécialité inconnue ou ID invalide.
            </div>
        <?php endif; ?>
    </div>

    <!-- Modals -->
    <!-- Modal Ajout Spécialité -->
    <div class="modal fade" id="addSpecialiteModal" tabindex="-1" aria-labelledby="addSpecialiteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une spécialité</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/admin/specialite">
                        <input type="hidden" name="action" value="addSpecialite">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom de la spécialité</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                            
                            <label for="code" class="form-label">Code de la spécialité</label>
                            <input type="text" class="form-control" id="code" name="code" required placeholder="ex:GI pour Génie Informatique">
                            
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Édition Spécialité/Doctorat -->
    <?php
    $specialiteToEdit = null;
    $isDoctorat = false;
    $id = $_GET['id'] ?? null;

    if (ctype_digit($id)) {
        $id = (int)$id;
        foreach ((array)$specialites as $specialite) {
            if ((int)$specialite['id'] === $id) {
                $specialiteToEdit = $specialite;
                break;
            }
        }
    }
    elseif ($id === 'doctorat') {
        $isDoctorat = true;        
        $specialiteToEdit = [
            'nom' => $doctoratData['nom'] ?? 'Doctorat',
            'code' => $doctoratData['code'] ?? 'PHD',
            'description' => $doctoratData['description'] ?? 'Troisième cycle universitaire',
            'id' => 'doctorat'
        ];
    }
    ?>

    <div class="modal fade" id="editSpecialiteModal" tabindex="-1" aria-labelledby="editSpecialiteModalLabel" aria-hidden="true">
        <div class="modal-dialog"> 
            <div class="modal-content">
                <?php if ($specialiteToEdit): ?>
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Modifier <?= $isDoctorat ? "le programme Doctorat" : "la spécialité : '" . htmlspecialchars($specialiteToEdit['nom']) . "'" ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="/admin/specialite">
                            <input type="hidden" name="action" value="<?= $isDoctorat ? 'editDoctorat' : 'editSpecialite' ?>">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($specialiteToEdit['id']) ?>">

                            <div class="mb-3">
                                <label for="edit-nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="edit-nom" name="nom"
                                    value="<?= htmlspecialchars($specialiteToEdit['nom']) ?>" required>

                                <label for="edit-code" class="form-label mt-2">Code</label>
                                <input type="text" class="form-control" id="edit-code" name="code"
                                    value="<?= htmlspecialchars($specialiteToEdit['code']) ?>"
                                    required <?= $isDoctorat ? 'readonly' : '' ?>>

                                <label for="edit-description" class="form-label mt-2">Description</label>
                                <textarea class="form-control" id="edit-description" name="description"
                                    rows="3" required><?= htmlspecialchars($specialiteToEdit['description']) ?></textarea>
                            </div>

                            <?php if ($isDoctorat): ?>
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle-fill"></i> Vous modifiez les informations du programme doctorat.
                                </div>
                            <?php endif; ?>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="modal-body">
                        <div class="alert alert-danger">Spécialité ou programme introuvable.</div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal Suppression Spécialité -->
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

    <!-- Modal Ajout Cours -->
    <div class="modal fade" id="addcours" tabindex="-1" aria-labelledby="addcours" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= $isDoctorat ? "Ajouter un cours doctorat" : "Ajouter un cours" ?></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/admin/specialite">
                        <input type="hidden" name="action" value="<?= $isDoctorat ? 'addCoursDoctorat' : 'addCours' ?>">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <input type="hidden" name="id_specialite" value="<?= htmlspecialchars($id) ?>">

                        <div class="mb-3">
                            <label for="codeEC" class="form-label">Code EC</label>
                            <input type="text" class="form-control" id="codeEC" name="codeEC" required placeholder="ex: GI101">

                            <label for="intituleEC" class="form-label">Intitulé EC</label>
                            <input type="text" class="form-control" id="intituleEC" name="intituleEC" required>
                        </div>

                        <?php if ($isDoctorat): ?>
                            <div class="mb-3">
                                <label for="creditEC" class="form-label">Crédit EC</label>
                                <input type="number" class="form-control" name="creditEC" id="creditEC" min="1" required>

                                <label for="anneeDoctorat" class="form-label mt-2">Année du doctorat</label>
                                <select class="form-control" name="anneeDoctorat" id="anneeDoctorat" required>
                                    <option value="1">1ère année</option>
                                    <option value="2">2ème année</option>
                                    <option value="3">3ème année</option>
                                </select>
                            </div>
                        <?php else: ?>
                            <div class="mb-3">
                                <label for="coef" class="form-label">Coef</label>
                                <input type="number" min="1" name="coef" id="coef" class="form-control" required>

                                <label for="cm" class="form-label">CM</label>
                                <input type="number" min="0" name="cm" id="cm" class="form-control" required>

                                <label for="td" class="form-label">TD</label>
                                <input type="number" min="0" name="td" id="td" class="form-control" required>

                                <label for="tp" class="form-label">TP</label>
                                <input type="number" min="0" name="tp" id="tp" class="form-control" required>

                                <label for="tpe" class="form-label">TPE</label>
                                <input type="number" min="0" name="tpe" id="tpe" class="form-control" required>

                                <label for="ccts" class="form-label">CCTS</label>
                                <input type="number" min="0" name="ccts" id="ccts" class="form-control" required>
                            </div>
                        <?php endif; ?>

                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--=======================-->
    <!-- Modal Édition Cours -->
    <!--=======================-->
    <div class="modal fade" id="editcours" tabindex="-1" aria-labelledby="editcoursLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editcoursLabel">Modifier le cours</h4>
                    <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/admin/specialite">
                        <input type="hidden" name="action" value="<?= $isDoctorat ? 'editcoursDoctorat' : 'editcours' ?>">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <input type="hidden" id="edit_cours_id" name="cours_id" value="">
                        <input type="hidden" name="specialite_id" value="<?= htmlspecialchars($id) ?>">

                        <div class="mb-3">
                            <label for="edit_codeEC" class="form-label">Code EC</label>
                            <input type="text" class="form-control" id="edit_codeEC" name="codeEC" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_intituleEC" class="form-label">Intitulé EC</label>
                            <input type="text" class="form-control" id="edit_intituleEC" name="intituleEC" required>
                        </div>

                        <?php if ($isDoctorat): ?>
                            <div class="mb-3">
                                <label for="edit_creditEC" class="form-label">Crédit EC</label>
                                <input type="number" min="1" name="creditEC" id="edit_creditEC" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_anneeDoctorat" class="form-label">Année du doctorat</label>
                                <select name="anneeDoctorat" id="edit_anneeDoctorat" class="form-control" required>
                                    <option value="1">1ère année</option>
                                    <option value="2">2ème année</option>
                                    <option value="3">3ème année</option>
                                </select>
                            </div>
                        <?php else: ?>
                            <div class="mb-3">
                                <label for="edit_coef" class="form-label">Coef</label>
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
                        <?php endif; ?>

                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Suppression Cours -->
    <div class="modal fade" id="delcours" tabindex="-1" aria-labelledby="delcours" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="/admin/specialite" method="post">
                        <input type="hidden" name="action" value="<?= $isDoctorat ? 'delCoursDoctorat' : 'delcours' ?>">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <input type="hidden" name="cours_id" id="cours_id" value="">
                        <input type="hidden" name="specialite_id" value="<?= htmlspecialchars($id) ?>">
                        <h4 id="delcourslabel"></h4>
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

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion de l'édition des cours
    document.querySelectorAll('.edit-course-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const codeEC = this.getAttribute('data-codeec');
            const intitule = this.getAttribute('data-intitule');
            
            document.getElementById('editcoursLabel').textContent = `Modifier le cours '${intitule}'`;
            document.getElementById('edit_cours_id').value = id;
            document.getElementById('edit_codeEC').value = codeEC;
            document.getElementById('edit_intituleEC').value = intitule;

            <?php if ($isDoctorat): ?>
                const credit = this.getAttribute('data-credit');
                const annee = this.getAttribute('data-annee');
                document.getElementById('edit_creditEC').value = credit;
                document.getElementById('edit_anneeDoctorat').value = annee;
            <?php else: ?>
                const coef = this.getAttribute('data-coef');
                const cm = this.getAttribute('data-cm');
                const td = this.getAttribute('data-td');
                const tp = this.getAttribute('data-tp');
                const tpe = this.getAttribute('data-tpe');
                const ccts = this.getAttribute('data-ccts');
                
                document.getElementById('edit_coef').value = coef;
                document.getElementById('edit_cm').value = cm;
                document.getElementById('edit_td').value = td;
                document.getElementById('edit_tp').value = tp;
                document.getElementById('edit_tpe').value = tpe;
                document.getElementById('edit_ccts').value = ccts;
            <?php endif; ?>
        });
    });

    // Gestion de la suppression des cours
    document.querySelectorAll('.del-course-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const intitule = this.getAttribute('data-intitule');
            const spec = "<?= $isDoctorat ? 'Doctorat' : htmlspecialchars($spec) ?>";

            document.getElementById('delcourslabel').innerHTML = 
                `Supprimer le cours <span class="text-info">${intitule}</span> de ${spec} ?`;
            document.getElementById('cours_id').value = id;
        });
    });

    // Gestion des toasts
    function handleToastWithHover(toastId) {
        const toastEl = document.getElementById(toastId);
        if (!toastEl) return;

        const toastInstance = new bootstrap.Toast(toastEl, { autohide: true });

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
});
</script>