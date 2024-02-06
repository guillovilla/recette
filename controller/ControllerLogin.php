<?php
RequirePage::model('CRUD');
RequirePage::model('User');
RequirePage::model('Utilisateur');
RequirePage::library('Validation');

class ControllerLogin extends controller {
    public function index(){
        Twig::render('auth/index.php');
    }

    public function auth(){
        $validation = new Validation;
        extract($_POST);
        $validation->name('email')->value($email)->max(50)->required()->pattern('email');
        $validation->name('mot de passe')->value($password)->max(20)->min(6);

        if(!$validation->isSuccess()){
            $errors =  $validation->displayErrors();
         return Twig::render('auth/index.php', ['errors' =>$errors,  'user' => $_POST]);
         exit();
        }

        $user= new Utilisateur;
        $checkUser = $user->checkUser($_POST['email'], $_POST['password']);

        Twig::render('about.php');

    }

    public function logout(){
        session_destroy();
        RequirePage::url('login');
    }

    // public function forgot(){
    //     Twig::render('auth/forgot.php');
    // }

    // public function tempPass(){
    //     $validation = new Validation;
    //     extract($_POST);
    //     $validation->name('email')->value($email)->max(50)->required()->pattern('email');
    
    //     if(!$validation->isSuccess()){
    //         $errors = $validation->displayErrors();
    //         return Twig::render('auth/forgot.php', [
    //             'errors' => $errors, 
    //             'user' => $_POST
    //         ]);
    //         exit();
    //     }

    //     $user = new user;
    //     $checkUser = $user->checkUser($_POST['email']);
    //     //print_r($checkUser);
    //     return Twig::render('auth/forgot.php', [
    //         'errors' => $checkUser, 
    //         'user' => $_POST
    //     ]);
    //     die();
    // }

    // public function newPassword(){
    //     //print_r($_GET);
    //     //die();
    //     $user = new User;
    //     $check = $user->checkTempPassword($_GET['user'], $_GET['temp']);
    //     if($check == 1){
    //         Twig::render('auth/new-password.php', [
    //             'id'=> $_GET['user']
    //         ]);
    //     }else{
    //         return Twig::render('auth/forgot.php', [
    //             'errors'=>'Verifier vos donnees'
    //         ]); 
    //     }
    // }

    // public function newPasswordUpdate(){
    //    // print_r($_POST);
    //    $validation = new Validation;
    //    extract($_POST);
    //    $validation->name('mot de passe')->value($password)->max(20)->min(6);
    
    //     if(!$validation->isSuccess()){
    //         $errors = $validation->displayErrors();
    //         return Twig::render('auth/new-password.php', [
    //             'errors' => $errors, 
    //             'id' => $_POST['id']
    //         ]);
    //         exit();
    //    }
    //     $user = new User;
    //     $_POST['tempPassword'] = null;
    //     $options = ['cost'=>10];
    //     $salt = "H3@_l?a";
    //     $passwordSalt = $_POST['password'].$salt;
    //     $_POST['password'] = password_hash($passwordSalt, PASSWORD_BCRYPT, $options);
    //     $user->update($_POST);
    //     RequirePage::url('login');
    // }
}
?>