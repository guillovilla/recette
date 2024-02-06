<?php
RequirePage::model('CRUD');
RequirePage::model('Utilisateur');
RequirePage::model('Privilege');
RequirePage::library('Validation');
RequirePage::library('CheckSession');

class ControllerUtilisateur extends controller {
    public function index(){
        $user = new Utilisateur;
        $selectUser = $user->select('email');
        $privilege = new Privilege;
        $i = 0;
        foreach($selectUser as $user){
             $selectId = $privilege->selectId($user['privilege_id']);
             $selectUser[$i]['privilege'] = $selectId['privilege'];
             $i++;
        }
        return Twig::render('user/index.php', [
            'users' => $selectUser
        ]);
    }

    public function create(){ 
        $privilege = new Privilege;
        $select = $privilege->select('privilege');
        return Twig::render('user/create.php', [
            'privileges' => $select
        ]);
    }

    public function store(){
        // print_r($_POST);echo"<br><br>";
        $validation = new Validation;
        extract($_POST);
        
        $validation->name('utilisateur')->value($username)->max(50)->required();
        $validation->name('email')->value($email)->max(50)->required()->pattern('email');
        $validation->name('mot de passe')->value($password)->max(20)->min(6);
        $validation->name('privilege')->value($privilege_id)->required();

        if(!$validation->isSuccess()){
            // var_dump($validation->getErrors());
            $errors =  $validation->displayErrors();
            // echo $errors;
            $privilege = new Privilege;
            $select = $privilege->select('privilege');
            return Twig::render('user/create.php', [
                'privileges' => $select,
                'user' => $_POST,
                'errors' => $errors
            ]);
            exit();
        }

        $user = new Usager;
        // echo"user :<br>";print_r($user);echo"<br><br>";
        // echo"email :<br>";print_r($email);echo"<br><br>";        
        $existingUser = $user->selectValue('email', $email);
        // echo"existingUser :<br>";print_r($existingUser);echo"<br><br>";
        // die();

        if ($existingUser) {
            $errors = 'Cette adresse email est enregistrée.';
            // echo"$errors :<br>";print_r($errors);echo"<br><br>";
            // die();
            $privilege = new Privilege;
            $select = $privilege->select('privilege');

            return Twig::render('user/create.php', [
                'privileges' => $select,
                'user' => $_POST,
                'errors' => $errors
            ]);
            exit();
        }

        // print_r('ok');die();
        $options = ['cost'=>10];
        $salt = "H3@_l?a";
        $passwordSalt = $_POST['password'].$salt;
        $_POST['password'] = password_hash($passwordSalt, PASSWORD_BCRYPT, $options);
        $insert = $user->insert($_POST);
        RequirePage::url('login');
    }

    public function delete(){

        CheckSession::sessionAuth();
    
        if($_SESSION['privilege'] == 1){
            $user = new Usager;
            $delete = $user->deleteRecord('user', 'id', $_POST['id']);
            
            if($delete === true){
                $user = new Usager;
                $selectUser = $user->select('email');
                $privilege = new Privilege;
                $i = 0;
                foreach($selectUser as $user){
                     $selectId = $privilege->selectId($user['privilege_id']);
                     $selectUser[$i]['privilege'] = $selectId['privilege'];
                     $i++;
                }
                        
                $message = "Supprimé avec succès";
                return Twig::render('user/index.php', [
                    'users' => $selectUser,
                    'message' => $message
                ]);
            } else {
                RequirePage::url('user/index');
            }
        } else {
            RequirePage::url('login');
        }
    }
}
?>