<?php
RequirePage::model('CRUD');
RequirePage::model('Enchere');
RequirePage::model('Categorie');
RequirePage::model('Pays');
RequirePage::model('User');
RequirePage::model('Mise');
RequirePage::model('Timbre');
RequirePage::model('Image');
RequirePage::library('Validation');
RequirePage::library('CheckSession');

class ControllerMise extends controller {
    public function index(){
        $mise = new Mise;
        $selectMise = $mise->select();
        return Twig::render('enchere/show.php', [
            'mise' => $selectMise
        ]);
    }

    public function store(){
        if(!$_SESSION['user_id']){
            RequirePage::url('login');
        }
        $user_id = $_SESSION['user_id'];
        $enchere_id = $_POST['enchere_id'];
        $prix = $_POST['prix'];
        //print_r($_POST);die;

        $enchere = new Enchere;
        $selectEnchere = $enchere->selectId($enchere_id);
        $selectEnchereShow = $enchere->enchereShow($enchere_id);
        $selectImages = $enchere->getImages($enchere_id);

        $categorie = new Categorie;
        $selectCategorie = $categorie->selectId($selectEnchereShow['categorie_id']);

        $pays = new Pays;
        $selectPays = $pays->selectId($selectEnchereShow['pays_id']);

        $user = new User;
        $selectUser = $user->selectId($user_id);    

        $mise = new Mise;
        // echo"mise<br>";print_r($mise);echo"<br><br>";
        $maxMise = $mise->miseEnchere($enchere_id);
        if(!$maxMise){
            $maxMise['prix'] = $selectEnchere['prix_depart'];;
        }

        if($prix <= $maxMise['prix']){
            $errors = "La mise doiv être plus élevées que le prix actuel";

            return Twig::render('enchere/show.php', [
                'user' => $selectUser,
                'enchere' => $selectEnchere,
                'enchereShow' => $selectEnchereShow,
                'images' => $selectImages,
                'categorie' => $selectCategorie['categorie'],
                'pays' => $selectPays['pays'],
                'mise' => $maxMise,
                'errors' => $errors
            ]);
            exit();
        }

        $mise = new Mise;
        // echo"mise<br>";print_r($mise);echo"<br><br>";
        $insert = $mise->insert($_POST);
        //echo"insert<br>";print_r($insert);echo"<br><br>";die;
        $maxMise = $mise->miseEnchere($selectEnchere['id']);
        if(!$maxMise){
            $maxMise['prix'] = $selectEnchere['prix_depart'];;
        }

        $message = "Soumettre l'offre avec succès";

        // RequirePage::url('enchere/index');
        return Twig::render('enchere/show.php', [
            'enchere' => $selectEnchere,
            'user' => $selectUser,
            'enchereShow' => $selectEnchereShow,
            'images' => $selectImages,
            'categorie' => $selectCategorie['categorie'],
            'pays' => $selectPays['pays'],
            'mise' => $maxMise,
            'message' => $message,
        ]);
    }
}
?>