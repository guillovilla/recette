<?php
RequirePage::model('CRUD');
RequirePage::model('Enchere');
RequirePage::model('Categorie');
RequirePage::model('Pays');
RequirePage::model('User');
RequirePage::model('Mise');
RequirePage::model('Timbre');
RequirePage::model('Image');
RequirePage::model('Favori');
RequirePage::model('Recommande');
RequirePage::library('Validation');
RequirePage::library('CheckSession');

class ControllerEnchere extends controller {
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

        $enchere = new Enchere;
        $selectEnchere = $enchere->enchereIndex($etat);

        // $image = new Image;
        foreach ($selectEnchere as &$enchereItem) {
            // $enchereItem['images'] = $enchere->getImages($enchereItem['id']);
            $enchereItem['firstImage'] = $enchere->getFirstImage($enchereItem['id']);
        }

        $categorie = new Categorie;
        $selectCategories = $categorie->select('categorie');

        $pays = new Pays;
        $selectPays = $pays->select('pays');

        // print_r($selectEnchere); die();
        return Twig::render('enchere/index.php', [
            'encheres' => $selectEnchere,
            'categories' => $selectCategories,
            'pays' => $selectPays
        ]);
    }
    
////////////////////////// SHOW //////////////////////////
    public function show($id){
        if (isset($_SESSION['user_id'])) {
            $user = new User;
            $selectUser = $user->selectId($_SESSION['user_id']);
        } else {
            $selectUser = null;
        }

        $enchere = new Enchere;
        $selectEnchere = $enchere->selectId($id);
        // echo"selectEnchere: <br>";print_r($selectEnchere);echo"<br><br>";
        // die();

        $selectEnchereShow = $enchere->enchereShow($id);
        // echo"selectEnchereShow: <br>";print_r($selectEnchereShow);echo"<br><br>";
        // die();
        
        $recommande = new Recommande;
        $selectRecommande = $recommande->selectId($id);
        // echo"selectRecommande: <br>";print_r($selectRecommande);echo"<br><br>";
        // die();

     	/* if(!isset($_SESSION['user_id']) || !in_array($_SESSION['user_id'], $selectEnchereShow['favori_user_ids'])){
            $favori['resultat'] = 0; 
            // echo"favori: <br>";print_r($favori);echo"<br><br>";
       }else if(in_array($_SESSION['user_id'], $selectEnchereShow['favori_user_ids'])){
            $favori = new Favori;
            // echo"favori: <br>";print_r($favori);echo"<br><br>";
            $favori = $favori->favoriId($selectEnchereShow['id'], $_SESSION['user_id']);
            // echo"favori: <br>";print_r($favori);echo"<br><br>";
            $favori['resultat'] = 1;
        }*/

	$favori = new Favori;
	$favori_resultat = "";
        // echo"favori: <br>";print_r($favori);echo"<br><br>";
        $favori_id = $favori->favoriId($selectEnchereShow['id'], $_SESSION['user_id']);
   	if ($favori_id['id'] > 0) $favori_resultat = 1;
	// echo  $favori_resultat;

        $categorie = new Categorie;
        $selectCategorie = $categorie->selectId($selectEnchereShow['categorie_id']);
        // echo"selectCategorie: <br>";print_r($selectCategorie);echo"<br><br>";
        // die();

        $pays = new Pays;
        $selectPays = $pays->selectId($selectEnchereShow['pays_id']);
        // print_r($selectPays);

        // $image = new Image;
        // $selectImages = $image->getImages($selectEnchereShow['id']);
        $selectImages = $enchere->getImages($selectEnchere['id']);
        // echo"selectImages: <br>";print_r($selectImages);echo"<br><br>";
        // die();

        $mise = new Mise;
        $maxMise = $mise->miseEnchere($selectEnchere['id']);
        if(!$maxMise){
            $maxMise['prix'] = $selectEnchere['prix_depart'];
        }
        // echo"maxMise: <br>";print_r($maxMise);echo"<br><br>";
        // die();

        return Twig::render('enchere/show.php', [
            'enchere' => $selectEnchere, 
            'enchereShow' => $selectEnchereShow,
            'user' => $selectUser,
            'categorie' => $selectCategorie['categorie'],
            'pays' => $selectPays['pays'],
            'mise' => $maxMise,
            'images' => $selectImages,
            'favori' => $favori_resultat,
            'recommande' => $selectRecommande
        ]);
    }

    public function create(){
        CheckSession::sessionAuth();

        if($_SESSION['privilege'] == 1 || $_SESSION['privilege'] == 2 || $_SESSION['privilege'] == 3){
            $categorie = new Categorie;
            $selectCategorie = $categorie->select('categorie');
            // print_r($selectCategorie);echo"<br>";

            $pays = new Pays;
            $selectPays = $pays->select('pays');
            // print_r($selectPays);echo"<br>";

            $user = new User;
            $selectUser = $user->selectId($_SESSION['user_id']);
            // echo $_SESSION['user_id'];echo"<br>";
            // print_r($selectUser);echo"<br>";

            // RequirePage::url('enchere/show'); 
            return Twig::render('enchere/create.php', [
                'categories' => $selectCategorie,
                'pays' => $selectPays,
                'user' => $selectUser
            ]);
        // }else{
        //     RequirePage::url('login'); 
        }
    }

    public function store(){
        // echo"<br>";print_r($_POST);echo"<br><br>";
        // die();

        $newFileName = []; 
        if (!empty($_FILES["images"]["name"][0])) {
            // echo'FILES["images"]';print_r($_FILES["images"]);echo"<br><br>";
            // die();
            $uploadedFiles = $_FILES["images"];
            $numberFiles = count($uploadedFiles["name"]);
            
            for ($i = 0; $i < $numberFiles; $i++) {
                $originalFilename = $uploadedFiles["name"][$i];
                $tmpFilename = $uploadedFiles["tmp_name"][$i];
            
                $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);
                $uniqId = uniqid();
                $newFilename = "i-$uniqId-$i.$extension";
                $basePath = dirname(__DIR__) . '/';
                $destination = $basePath . 'assets/img/stamps/' . $newFilename;
                move_uploaded_file($tmpFilename, $destination);

                $newFileNames[] = $newFilename;
            }
        }
        // print_r($newFileNames);echo"<br><br>";
        // die();
        $validation = new Validation;
        extract($_POST); // 使数据库的table名称timbre.nom转变成数值$nom
        $categorie_id = $_POST['categorie'];
        $pays_id = $_POST['pays'];
        $currentDate = date('Y-m-d');
        $validation->name('nom')->value($nom)->max(200)->min(1);
        $validation->name('descritpion')->value($description)->max(2000)->min(1);
        $validation->name("catégorie")->value($categorie_id)->pattern('int')->required();
        $validation->name('pays')->value($pays_id)->pattern('int')->required();
        $validation->name("date de début")->value($date_debut)->required();
        $validation->name('date de fin')->value($date_fin)->required();
        $validation->name("année d'émission")->value($annee)->required();
        $validation->name("prix de départ")->value($prix_depart)->customPattern('^[1-9]\d*(\.\d+)?$');

        // print_r($validation->isSuccess());//成功为1
        // die();
        if(!$validation->isSuccess()){
            $categorie = new Categorie;
            $selectCategorie = $categorie->select('categorie');

            $pays = new Pays;
            $selectPays = $pays->select('pays');

            $errors = $validation->displayErrors();
            return Twig::render('enchere/create.php', [
                'categories' => $selectCategorie,
                'pays' => $selectPays,
                'enchere' => $_POST,
                'errors' => $errors
            ]);
            exit();
        }

        $enchere = new Enchere;
        $prixDepart = isset($_POST['prix_depart']) ? floatval($_POST['prix_depart']) : 0;
        // print_r($prixDepart);
        // die();

        $table_enchere = array(
            'prix_depart' => $prixDepart,
            'date_debut' => $_POST['date_debut'],
            'date_fin' => $_POST['date_fin'],
            'user_id' => $_SESSION['user_id']
        );
        // echo"table_enchere: <br>";print_r($table_enchere);echo"<br><br>";
        $enchere_id = $enchere->insert($table_enchere);
        // echo"enchere_id: <br>";print_r($enchere_id);echo"<br><br>";
        // die();

        $timbre = new Timbre;
        $table_timbre = array(
            'nom' => $_POST['nom'],
            'description' => $_POST['description'],
            'annee' => $_POST['annee'],
            'enchere_id' => $enchere_id,
            'categorie_id' => $_POST['categorie'],
            'pays_id' => $_POST['pays']
        );
        // print_r($table_timbre);echo"<br>";
        $timbre_id = $timbre->insert($table_timbre);
        // print_r($timbre_id);echo"<br>";
        // die();
        
        $image = new Image;
        // print_r($newFileName);echo"<br><br>";
        foreach ($newFileNames as $newFileName) {
            $table_image = array(
                'filename' => $newFileName,
                'timbre_id' => $timbre_id
            );
    
            // print_r($table_image); echo "<br>";
            $image_id = $image->insert($table_image);
            // print_r($image_id); echo "<br>";
        }    
        // die();
        RequirePage::url('enchere/show/'.$enchere_id);
    }

    public function edit(){
        // print_r($_POST);echo"<br><br>";
        $enchere_id = $_POST['enchere_id'];
        $user_id = $_POST['user_id'];
        // die();

        $user = new User;
        $selectUser = $user->selectId($user_id);
        // echo"selectUser<br>";print_r($selectUser);echo"<br><br>";
 
        $enchere = new Enchere;
        $selectEnchere = $enchere->selectId($enchere_id);
        // echo"selectEnchere<br>";print_r($selectEnchere);echo"<br><br>";
        $selectEnchereShow = $enchere->enchereShow($enchere_id);
        // echo"selectEnchereShow<br>";print_r($selectEnchereShow);echo"<br><br>";
        // $selectImages = $enchere->getImages($$enchere_id);
        // echo"selectImages<br>";print_r($selectImages);echo"<br><br>";

        $categorie = new Categorie;
        $selectCategories = $categorie->select('categorie');
        // echo"selectCategories<br>";print_r($selectCategories);echo"<br><br>";

        $pays = new Pays;
        $selectPays = $pays->select('pays');
        // echo"selectPays<br>";print_r($selectPays);echo"<br><br>";

        return Twig::render('enchere/edit.php', [
            'user' => $selectUser,
            'enchere' => $selectEnchere, 
            'enchereShow' => $selectEnchereShow,
            'categories' => $selectCategories,
            'pays' => $selectPays
        ]);
    }

    public function update(){
        //print_r($_POST);echo"<br><br>";
        $enchere_id = $_POST['enchere_id'];
        $user_id = $_POST['user_id'];
        $timbre_id = $_POST['timbre_id'];
        $newFileName = [];

        if (!empty($_FILES["images"]["name"][0])) {
            $uploadedFiles = $_FILES["images"];
            $numberFiles = count($uploadedFiles["name"]);
            
            for ($i = 0; $i < $numberFiles; $i++) {
                $originalFilename = $uploadedFiles["name"][$i];
                $tmpFilename = $uploadedFiles["tmp_name"][$i];
            
                $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);
                $uniqId = uniqid();
                $newFilename = "i-$uniqId-$i.$extension";
                $basePath = dirname(__DIR__) . '/';
                $destination = $basePath . 'assets/img/stamps/' . $newFilename;
                move_uploaded_file($tmpFilename, $destination);

                $newFileNames[] = $newFilename;
            }
        }
       
        $validation = new Validation;
        extract($_POST); // 使数据库的table名称timbre.nom转变成数值$nom
        $categorie_id = $_POST['categorie'];
        $pays_id = $_POST['pays'];
        $currentDate = date('Y-m-d');
        $validation->name('nom')->value($nom)->max(200)->min(1);
        $validation->name('descritpion')->value($description)->max(2000)->min(1);
        $validation->name("catégorie")->value($categorie_id)->pattern('int')->required();
        $validation->name('pays')->value($pays_id)->pattern('int')->required();
        $validation->name("date de début")->value($date_debut)->required();
        $validation->name('date de fin')->value($date_fin)->required();
        $validation->name("année d'émission")->value($annee)->required();
        $validation->name("prix de départ")->value($prix_depart)->customPattern('^[1-9]\d*(\.\d+)?$');

        if(!$validation->isSuccess()){
            $categorie = new Categorie;
            $selectCategorie = $categorie->select('categorie');

            $pays = new Pays;
            $selectPays = $pays->select('pays');

            $errors = $validation->displayErrors();
            return Twig::render('enchere/create.php', [
                'categories' => $selectCategorie,
                'pays' => $selectPays,
                'enchere' => $_POST,
                'errors' => $errors
            ]);
            exit();
        }

        $enchere = new Enchere;
        $prixDepart = isset($_POST['prix_depart']) ? floatval($_POST['prix_depart']) : 0;

        $table_enchere = array(
            'id' => $enchere_id,
            'prix_depart' => $prixDepart,
            'date_debut' => $_POST['date_debut'],
            'date_fin' => $_POST['date_fin'],
            'user_id' => $_SESSION['user_id']
        );
        $updateEnchere = $enchere->update($table_enchere);

        $timbre = new Timbre;
        $table_timbre = array(
            'id' => $timbre_id,
            'nom' => $_POST['nom'],
            'description' => $_POST['description'],
            'annee' => $_POST['annee'],
            'enchere_id' => $enchere_id,
            'categorie_id' => $_POST['categorie'],
            'pays_id' => $_POST['pays']
        );
        $updateTimbre = $timbre->update($table_timbre);
        
        $image = new Image;
        foreach ($newFileNames as $newFileName) {
            $table_image = array(
                'filename' => $newFileName,
                'timbre_id' => $timbre_id
            );
    
            $image_id = $image->insert($table_image);
        }    
        RequirePage::url('enchere/show/'.$enchere_id);
    }

    public function deleteEnchere(){
        print_r($_POST);echo"<br>";
        $enchere_id = $_POST['enchere_id'];
        $user_id = $_POST['user_id'];
        // die();
        CheckSession::sessionAuth();
        if($_SESSION['privilege'] == 1 or $_SESSION['user_id'] == $user_id){
            $enchere = new Enchere;
            $update = $enchere->deleteEnchere($enchere_id);
            RequirePage::url('enchere/index');
        }else{
            RequirePage::url('login');
        }
    }
}
?>
