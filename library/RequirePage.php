<?php
class RequirePage {
    static public function model($model){
        return require_once('model/'.$model.'.php');
    }

    static public function library($library){
        return require_once('library/'.$library.'.php');
    }

    static public function header($title){
        return `
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Enchère</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <link rel="stylesheet" href="{{path}}/assets/css/styles.css">
        </head>
        <body>
            <nav>
                <h3>Catalogue</h3>
                <h3>d'Enchère</h3>
                <a href="{{path}}/home.php"><i class="fa-solid fa-house"></i> Accueil</a>
                <a href="{{path}}/enchere/show.php"><h4><i class="fa-solid fa-spinner"></i> En cours</h4></a>
                <a href="{{path}}/enchere/show.php"><h4><i class="fa-solid fa-clock-rotate-left"></i> Passées</h4></a>
                <p>Le mandat consiste à réaliser une plateforme de vente aux enchères facilement déclinable, intuitive et simple d’utilisation afin de permettre aux philatélistes du Royaume-Uni et d’un peu partout dans le monde, de trouver rapidement la perle rare qui manque à leur collection. </p>
                <a href="{{path}}/enchere/create"><h4>Ajouter Enchere</h4></a>
                </nav>
        `;
    }

    static public function url($url){
        header('location:'.PATH_DIR.$url);
    }
}
?>