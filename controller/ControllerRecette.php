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
            return Twig::render('enchere/index.php', [
                'encheres' => $selectRecette

            ]);
    }

}
?>