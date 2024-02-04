<?php
RequirePage::model('CRUD');
RequirePage::model('Recette');
class ControllerHome extends Controller {

    public function index(){

      $recette = new Recette;
      $recettes = $recette->select();

      return Twig::render('home.php', ['recettes'=>$recettes]);
    }

    public function error($e = null){
        return 'error '.$e;
    }
}
?>