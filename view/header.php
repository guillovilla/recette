<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enchère</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{path}}assets/css/styles.css">
    <script src="{{path}}enchere/create" defer></script>
</head>
<body>
    <nav>
        <article class="hearder-logo">
            <img src="{{path}}assets/img/logo/logo-restaurant.svg" alt="logo">
        </article>
        <h3>Restaurant</h3>
        <h3>Délicieux</h3>
        <a href="{{path}}enchere/create"><h4>Ajoutez Recette</h4></a>
        <a href="{{path}}user/create"><h4>Ajoutez Utilisateur </h4></a>
        <a href="{{path}}user/index"><h4>Liste d'Usernmae </h4></a>
        <a href="{{path}}login">Login</a>
        <a class="username">Bienvenu : {{session.username}}</a>
        <a class="log" href="{{path}}login/logout">Logout</a>
    </nav>