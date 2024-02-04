{{ include('header.php', {title: 'Enchere Ajoute'}) }}

    <div class="enchere-create">
        <form enctype="multipart/form-data" action="{{path}}enchere/store" method="post">
            <label>Date de début
                <input type="date" name="date_debut" value="{{enchere.date_debut}}">
            </label>
            <label>Date de fin
                <input type="date" name="date_fin" value="{{enchere.date_fin}}">
            </label>

            <script>
            function addFileInput() {
                var input = document.createElement('input');
                input.type = 'file';
                input.name = 'images[]';
                input.multiple = true;
                document.getElementById('fileInputs').appendChild(input);
            }
            </script>
            
            <div id="fileInputs">
                <label>Ajoutez l'image du timbre
                    <input type="file" name="images[]" multiple>
                </label>
            </div>
            <button class="button-ajoute" type="button" onclick="addFileInput()">Ajouter un autre fichier</button>

            <label>Titre du timbre
                <textarea type="text" name="nom" value="{{enchereShow.nom}}"></textarea>
            </label>
            <label>Description du timbre
                <textarea type="text" name="description" value="{{enchereShow.description}}"></textarea>
            </label>
            <label>Année d'émission
                <input type="text" name="annee" value="{{enchereShow.annee}}">
            </label>
            <label>Categorie
                <select name="categorie">
                    <option value="">Selectionner un categorie</option>
                    {%  for categorie in categories %}
                   <!-- <option value="{{ categorie.id }}" {% if categorie.id == enchereShow.categorie_id %} selected {% endif %}>{{ categorie.categorie }}</option> -->
                   <option value="{{ categorie.id }}" {% if categorie.id == (enchereShow.categorie_id ?? '') %} selected {% endif %}>{{ categorie.categorie }}</option>
                    {% endfor %}
                </select>
            </label>
            <label>Pays
                <select name="pays">
                    <option value="">Selectionner un pays</option>
                    {%  for pays in pays %}
                   <!-- <option value="{{ pays.id }}" {% if pays.id == enchereShow.pays_id %} selected {% endif %}>{{ pays.pays }}</option> -->
                   <option value="{{ pays.id }}" {% if pays.id == (enchereShow.pays_id ?? '') %} selected {% endif %}>{{ pays.pays }}</option>
                    {% endfor %}
                </select>
            </label>
            <!-- <input type="hidden" name="id" value="{{enchereShow.id}}"> -->
            <label>Prix de départ (optionnel)
                <input type="number" name="prix_depart" value="{{ enchere.prix_depart}}">
            </label>
            <input type="hidden" name="id" value="{{ session.user_id }}">
            <span class="text-danger">{{ errors | raw }}</span><br>
            <input type="submit" value="Enregistrer" class="button-enregistrer">
        </form>
    </div>
</body>
</html>


