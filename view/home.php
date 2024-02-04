{{ include('header.php', {title:'Accueil'}) }}

    <main class="grille-catalogue">
        {% for recette in recettes %}
        <a href="{{path}}recette/show/{{recette.id}}">
            <section class="item">

                <p>{{recette.nom}}</p>
                <p>{{recette.description}}</p>
                <p>{{recette.ingrediants}}</p>
                <p>{{recette.preparation}}</p>
            </section>
        {% endfor %}
        </a>
    </main>
</body>
</html>