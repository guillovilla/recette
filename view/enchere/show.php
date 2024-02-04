{{ include('header.php', {title:'Enchere Show'}) }}

    <main class="enchere-main">
        <article class="enchere-rectangle">
            <aside>
                <div class="show-img-big">
                    {% if enchereShow.recommande_id== enchere.id %}
                        <img class="recommande-show" src="{{path}}/assets/img/icones/logo-stamp-gold.svg" alt="logo-stamp-gold">
                    {% endif %}
                    <img class="enchere-stmap" src="{{path}}/assets/img/stamps/{{images[0]}}">
                </div>
                <div class="show-imgs-small">
                {% if images %}
                    {% for image in images %}
                        <a href="#">
                            <img class="image-small" src="{{ path }}/assets/img/stamps/{{ image }}">
                        </a>
                    {% endfor %}
                {% else %}
                    <img src="{{path}}/assets/img/logo/logo-gold.svg">
                {% endif %}
                </div>

                {% if (session.privilege == 1 or session.privilege == 2)%}
                <form action="" class="recommande">
                    {% if enchereShow.recommande_id == enchere.id %}
                    <a href="{{path}}recommande/anulle?enchere_id={{ enchere.id }}&user_id={{ user.id }}">
                        <i class="fa-solid fa-award"></i></i> Dérecommandez
                    </a>
                    {% else %}
                    <a href="{{path}}recommande/ajoute?enchere_id={{ enchere.id }}&user_id={{ user.id }}">
                        Recommandez
                    </a>
                    {% endif %}
                </form>
                {% endif %}

                <form action="" class="favori">
                    {% if favori == 1 %}
                    <a href="{{path}}favori/anulle?id={{ enchereShow.favori_id }}&enchere_id={{ enchere.id }}&user_id={{ user.id }}">
                        <i class="fa-solid fa-heart"></i> Annulez les favoris
                    </a>
                    {% else %}
                    <a href="{{path}}favori/ajoute?enchere_id={{ enchere.id }}&user_id={{ user.id }}">
                        <i class="fa-regular fa-heart"></i> Ajoutez aux favoris
                    </a>
                    {% endif %}
                </form>
            </aside>
            <div class="enchere-presentation">
                <h3 class="titre">{{ enchereShow.nom }}</h3>   
                <hr>
                <section class="enchere-detail">
                    <div class="description">
                        <p>{{enchereShow.description}}</p>
                    </div>
                    <div class="enchere-detail-liste">
                        <p><b>Anneé : </b>{{enchereShow.annee}}</p>
                        <p><b>Pays : </b>{{pays}}</p>
                        <p><b>Categorie : </b>{{categorie}}</p>
                    </div>
                </section>
                <section class="enchere-etat">
                    <div class="enchere-prix">
                        <h4>Mise Actuel : </h4>
                        <p><span class="prix-notation">$</span><span class="prix-montant">{{mise.prix}}</span></p>
                        
                        <form action="{{path}}mise/store" method="post">
                            <input type="hidden" id="enchere_id" name="enchere_id" value="{{enchere.id}}">
                            <input type="hidden" id="user_id" name="user_id" value="{{user.id}}">
                            <input type="number" id="prix" name="prix">
                            <p class="text-danger">{{ errors | raw }}</p>
                            <p class="text-normal">{{ message }}</p>
                            <input class="button-mise" type="submit" value="Placer une mise">
                        </form>

                        {% if session.user_id and session.user_id == enchere.user_id %}
                        <form action="{{path}}enchere/edit" method="post">
                            <input type="hidden" id="enchere_id" name="enchere_id" value="{{enchere.id}}">
                            <input type="hidden" id="user_id" name="user_id" value="{{user.id}}">
                            <input class="button-edit" type="submit" value="Modifier cette enchère">
                        </form>
                        {% endif %}

                        {% if (session.privilege == 1 or session.privilege == 2) or (session.user_id and session.user_id == enchere.user_id ) %}
                        <form action="{{path}}enchere/deleteEnchere" method="post">
                            <input type="hidden" id="enchere_id" name="enchere_id" value="{{enchere.id}}">
                            <input type="hidden" id="user_id" name="user_id" value="{{user.id}}">
                            <input class="button-edit" type="submit" value="Supprimer cette enchère">
                        </form>
                        {% endif %}
                    </div>
                    <div class="enchere-temps">
                        <p><b>Début : </b>{{enchere.date_debut}}</p>
                        <p><b>Fin : </b>{{enchere.date_fin}}</p>
                    </div> 
                </section>
            </div>
        </article>
    </main>
</body>
</html>