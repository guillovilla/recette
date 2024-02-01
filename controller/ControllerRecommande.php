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
RequirePage::model('Recommande');
RequirePage::library('Validation');
RequirePage::library('CheckSession');

class ControllerRecommande extends Controller {
    public function index(){
        $recommande = new Recommande;
        $selectRecommande = $recommande->select();
        return Twig::render('enchere/show.php', [
            'recommande' => $selectRecommande
        ]);
    }

    public function ajoute(){
        if(!$_SESSION['user_id']){
            RequirePage::url('login');
        }
        
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
	$enchere_id = $tab['enchere_id'];

        $recommande = new Recommande;
        // echo"recommande :<br>";print_r($recommande);echo"<br><br>";
        $insert = $recommande->insert(['enchere_id' => $enchere_id]);
        // echo"insert :<br>";print_r($insert);echo"<br><br>";
        // die();

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
	$enchere_id = $tab['enchere_id'];
        $user_id = $tab['user_id'];

        $recommande = new Recommande;
        $delete = $recommande->deleteValue('enchere_id', $enchere_id);
        // echo"delete: ";print_r($delete); //如果删除会显示1
        // die();
	
      	RequirePage::url('enchere/show/'.$enchere_id);
        exit;

    }
}
?>