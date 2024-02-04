<?php
RequirePage::model('CRUD');
RequirePage::model('Recette');
RequirePage::library('Validation');
RequirePage::library('CheckSession');

class ControllerRecette extends Controller {
    public function index(){
        $url = $_SERVER['REQUEST_URI'];
        //echo"url<br>";print_r($url);echo"<br><br>";
    
        $parts = explode('?', $url);
        //echo"parts<br>";print_r($parts);echo"<br><br>";
    
        if (count($parts) > 1) {
            $query = $parts[1];
            $params = explode('&', $query);
            $tab = array();
                foreach ($params as $param) {
                    list($key, $value) = explode('=', $param);
                $tab[$key] = $value;
                $etat = $tab['etat'];
            }
            //echo"tab<br>";print_r($tab);echo"<br><br>";
        }else{
                $etat = 'all';
            }
            //echo"etat<br>";print_r($etat);echo"<br><br>";
    
            $recette = new Recette;
            $selectRecette = $recette->select();

    
            // print_r($selectRecette); die();
            return Twig::render('recette/index.php', [
                'recettes' => $selectRecette

            ]);
    }

    public function show(){

        // $recette_id = $_POST['recette_id'];
        $recette_id = 1;

        $recette = new recette;
        $selectRecette = $recette->selectId($recette_id);

        return Twig::render('recette/show.php', [
            'recette' => $selectRecette
        ]);
    }


    public function edit(){
        // $_POST['id'] = $_POST['recette_id'];

        // Pour tester
        $_POST['id'] = 2;

        $recette = new Recette;
        $selectRecette = $recette->selectId($_POST['id']);
       
        return Twig::render('recette/edit.php', [
            'recette' => $selectRecette
        ]);
    }


    public function update(){
        
        // $_POST['id'] = $_POST['recette_id'];
        
        // Pour tester
        $_POST['id'] = 2;

        $validation = new Validation;
        extract($_POST);  

        $validation->name('nom')->value($nom)->max(200)->min(1);
        $validation->name('description')->value($description)->max(2000)->min(1);
        $validation->name('ingrediants')->value($description)->max(2000)->min(1);
        $validation->name('preparation')->value($description)->max(2000)->min(1);

        if(!$validation->isSuccess()){

            $errors = $validation->displayErrors();
            return Twig::render('recette/create.php', [
                'recette' => $_POST,
                'errors' => $errors
            ]);
            exit();
        }

        $recette = new Recette;

        $updaterecette = $recette->update($_POST);
       
        RequirePage::url('recette/show/');
    }
}
?>