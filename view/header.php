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
            <img src="{{path}}assets/img/logo/logo-gold.svg" alt="logo">
        </article>
        <h3>Lord Reginald</h3>
        <a href="{{path}}home"><i class="fa-solid fa-house"></i> Accueil</a>
        <a href="{{path}}enchere/index?etat=encours"><h4><i class="fa-solid fa-spinner"></i> En cours</h4></a>
        <a href="{{path}}enchere/index?etat=passe"><h4><i class="fa-solid fa-clock-rotate-left"></i> Passées</h4></a>
        <a href="{{path}}enchere/create"><h4><i class="fa-solid fa-square-plus"></i> Ajoutez Enchere</h4></a>
        <a href="{{path}}news">Actualité</a>
        <a href="{{path}}about">À propos</a>
        <a href="{{path}}contact/create">Nous contactez</a>

        {% if guest %}
        <a href="{{ path }}user/create"><h4>Inscrivez Membre</h4></a>
        {% else %}
            {% if session.privilege == 1 or session.privilege == 2 %}
            <a href="{{ path }}user/create"><h4>Nouvel Utilisateur</h4></a>
            {% endif %}
        {% endif %}

        {% if guest %}
        <a href="{{path}}login">Login</a>
        {% else %}
            {% if session.privilege == 1 %}
            <a href="{{path}}user/index"><h4>Liste d'Usernmae </h4></a>
            {% endif %}

            {% if session.privilege == 1 or session.privilege == 2 %}
            <a href="{{path}}contact/index"><h4>Liste de contact </h4></a>
            {% endif %}

            <a class="username">Bienvenu : {{session.username}}</a>
            <a class="log" href="{{path}}login/logout">Logout</a>
        {% endif %}
    </nav>