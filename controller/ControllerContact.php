<?php
RequirePage::model('CRUD');
RequirePage::model('Contact');
RequirePage::library('Validation');

class ControllerContact extends Controller {
    public function index(){
        $contact = new Contact;
        $selectContact = $contact->select();
        return Twig::render('contact/index.php',[
            'contacts' => $selectContact
        ]);
    }

    public function create(){
        return Twig::render('contact/create.php');
    }

  public function store(){
        $validation = new Validation;
        extract($_POST);
        $validation->name('nom')->value($nom)->max(200)->min(1);
        $validation->name('email')->value($email)->max(200)->min(1);
        $validation->name('Message')->value($message)->max(200)->min(1);

        if(!$validation->isSuccess()){
            $errors = $validation->displayErrors();
            return Twig::render('contact/create.php', [
                'errors' => $errors
            ]);
            exit();
        }

        $contact = new Contact;
        $insert = $contact->insert($_POST);
        $message = "Envoyée avec succès";
        return Twig::render('contact/create.php', [
            'message' => $message
        ]);
    }
}
?>