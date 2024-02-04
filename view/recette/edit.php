{{ include('header.php', {title: 'Recette Edit'}) }}

    <div class="enchere-create">
        <form enctype="multipart/form-data" action="{{path}}recette/update/{{ recette.id }}" method="post">

            <label>Nom de la recette
                <input type="text" name="nom" value="{{recette.nom}}">
            </label>
            <label>Description de la recette
                <textarea type="text" name="description" value="{{recette.description}}">{{recette.description}}</textarea>
            </label>
            <label>Ingrédiants de la recette
                <textarea type="text" name="ingrediants" value="{{recette.ingrediants}}">{{recette.description}}</textarea>
            </label>
            <label>Préparation de la recette
                <textarea type="text" name="preparation" value="{{recette.preparation}}">{{recette.description}}</textarea>
            </label>

            
            <span class="text-danger">{{ errors | raw }}</span><br>
            <input type="submit" value="Enregistrer" class="button-enregistrer">
        </form>
    </div>
</body>
</html>


