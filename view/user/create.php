{{ include('header.php', {title: 'Nouveau Utilisateur'}) }}

<div class="enchere-create">
        <form action="{{path}}user/store" method="post">
            <!-- <span class="text-danger">{{ errors | raw }}</span> -->

            <label>Email
                <input type="email" name="email" value="{{ user.email }}">
            </label>

            <label>Mot de passe
                <input type="password" name="password" value="{{ user.password }}">
            </label>
            <input type="hidden" name="privilege_id" value="1">
            <span class="text-danger">{{ errors | raw }}</span><br>
            <input type="submit" value="Enregistrer" class="button-enregistrer">
        </form>
    </div>
</body>
</html>