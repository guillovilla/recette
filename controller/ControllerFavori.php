<?php
RequirePage::model('CRUD');
RequirePage::model('Favori');
RequirePage::model('Enchere');
RequirePage::model('Categorie');
RequirePage::model('Pays');
RequirePage::model('User');
RequirePage::model('Mise');
RequirePage::model('Timbre');
RequirePage::model('Image');
RequirePage::library('Validation');
RequirePage::library('CheckSession');

class ControllerFavori extends Controller {
    public function index(){
        $favori = new Favori;
        $insert = $favori->insert($_POST);
        return Twig::render('cenchere/show.php', [
        ]);
    }

    public function ajoute(){
	// Obtenez l'URL actuelle
	$url = $_SERVER['REQUEST_URI'];

	// Divisez l'URL en utilisant le caractere "?" comme separateur
	$parts = explode('?', $url);

	// Verifiez s'il y a des parametres GET dans l'URL
	if (count($parts) > 1) {
    		// Le deuxieme element du tableau $parts contiendra les parametres GET
    		$query = $parts[1];

    		// Divisez les parametres GET en utilisant le caractere "&" comme separateur
    		$params = explode('&', $query);

 		$tab = array();
    		// Parcourez les parametres GET et affichez-les
    		foreach ($params as $param) {
        		list($key, $value) = explode('=', $param);
			//echo "Cle : $key, Valeur : $value<br>";
			$tab[$key] = $value;
    		}
	}

        if(!$_SESSION['user_id']){
            RequirePage::url('login');
        }
        // echo"get: ";print_r($_GET);echo"<br><br>";
       	// $enchere_id = $_GET['enchere_id'];
        // $user_id = $_GET['user_id'];
        
        $favori = new Favori;
        $insert = $favori->insert($tab);
	//$favori['resultat'] = 1;

	$enchere_id = $tab['enchere_id'];
      	RequirePage::url('enchere/show/'.$enchere_id);
        exit;
    }

    public function anulle(){
	$url = $_SERVER['REQUEST_URI'];
	$parts = explode('?', $url);
	$query = $parts[1];
	$params = explode('&', $query);
	$tab = array();
    	foreach ($params as $param) {
        	list($key, $value) = explode('=', $param);
		$tab[$key] = $value;
    	}
	//print_r($tab);echo"<br><br>";
	$favori_id = $tab['id'];
	$enchere_id = $tab['enchere_id'];
	$user_id = $tab['user_id'];
	
        $favori = new Favori;
        $delete = $favori->delete($favori_id);

        //echo"delete: ";print_r($delete); //如果删除会显示1
        //die();

      	RequirePage::url('enchere/show/'.$enchere_id);
        exit;
    }
}
?>