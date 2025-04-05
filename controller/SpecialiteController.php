<?php

require_once  __DIR__ ."/../Models/Specialite.php";


class SpecialiteController {
    
    
    public  function showSpecialite() {
        $specialite = new Specialite();
        $specialites = $specialite->getAllSpecialites();

        require_once __DIR__ .'/../views/admin/cours-specialié.php';
    }
    public function showCourses($specialite_id) {
        $specialite = new Specialite();
        $courses = $specialite->get_courses_by_specialite($specialite_id);

        require_once __DIR__ .'/../views/admin/cours-specialié.php';
    }
}
?>