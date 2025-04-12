<?php 
ob_start();
$titre="doctorant";
?>
    
    <h2 class="titre text-center">Les doctorants  de LTSA</h2>
    <div class="d-flex justify-content-end h2 w-100 w-md-50" ><a href="index.php?page=enseignant/a" class="pb-1 pt-1 pl-5 pr-5  float-right"style="background: var(--color-vert); border-radius: 50px; color: var(--text-white)">ajouter</a></div>
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
                        <tr class="border border-end-2">
                        <th>1</th>
                        <td>Pr ELE Pierre</td>
                        <td>Professeur</td>
                        <td>coordonnateur de LTSA</td>
                        <td>Université de Douala, Cameroun</td>
                        <td><a href="index.php?page=enseignant/m/"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td><form action="index.php?page=enseignant/s/" onsubmit="return confirm('voulez-vous vraiment supprimer ?'); ">
                                <button type="submit" class="border border-none" style="background: var(--text-white);"><i class="fa-solid fa-trash text-info transparent"></i></button>
                            </form>
                        </td>
                        </tr>
                        <tr class="border border-end-2">
                        <th>3</th>
                        <td>Pr DJANNA KOFFI Francis Lénine</td>
                        <td>Maître de Conférences</td>
                        <td>coordonnateur adjoint de LTSA</td>
                        <td>Université de Douala, Cameroun</td>
                        <td><a href="index.php?page=enseignant/m/"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td><form action="index.php?page=enseignant/s/" onsubmit="return confirm('voulez-vous vraiment supprimer ?'); ">
                                <button type="submit" class="border border-none" style="background: var(--text-white);"><i class="fa-solid fa-trash text-info transparent"></i></button>
                            </form>
                        </td>
                        </tr>
                        <tr class="border border-end-2">
                        <th>3</th>
                        <td>Pr ETAME Jacques</td>
                        <td>Professeur</td>
                        <td>Directeur de l'IUT DLA</td>
                        <td>Université de Douala, Cameroun</td>
                        <td><a href="index.php?page=enseignant/m/"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td><form action="index.php?page=enseignant/s/" onsubmit="return confirm('voulez-vous vraiment supprimer ?'); ">
                                <button type="submit" class="border border-none" style="background: var(--text-white);"><i class="fa-solid fa-trash text-info transparent"></i></button>
                            </form>
                        </td>
                        </tr>
                    </tbody>
                </table>
        </div>

<?php
$titre = "doctorant";
$content=ob_get_clean();
require("template.php");
?>
    
    
