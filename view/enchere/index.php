{{ include('header.php', {title:'Catalogue'}) }}

    <main class="grille-catalogue">
        {% for enchere in encheres %}
        <a href="{{path}}enchere/show/{{enchere.id}}">
            <section class="item">
                <div class="item-grille">
                    {% if enchere.recommande_id == enchere.id %}
                        <img class="recommande-index" src="{{path}}/assets/img/icones/logo-stamp-gold.svg">
                    {% endif %}

                    {% if enchere.firstImage %}
                        <img src="{{path}}/assets/img/stamps/{{enchere.firstImage}}">
                    {% else %}
                        <img src="{{path}}/assets/img/logo/logo-gold.svg">
                    {% endif %}
                </div>
                <hr>
                <p>{{enchere.nom}}</p>
            </section>
        {% endfor %}
        </a>
    </main>
</body>
</html>