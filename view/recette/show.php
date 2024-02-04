{{ include('header.php', {title:'recette Show'}) }}

<div  class="about">
    <h1>Détail de {{ recette.nom }}</h1>
    <br>
    <p><strong>Descrption : </strong> {{ recette.description }}</p>
    <p><strong>Ingrédiants : </strong>{{ recette.ingrediants }}</p>
    <p><strong>Préparation : </strong>{{ recette.preparation }}</p>
</div>
</body>
</html>