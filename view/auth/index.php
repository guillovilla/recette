{{ include('header.php', {title: 'Login'}) }}


    <div class="enchere-create">
        <form action="{{path}}login/auth" method="post">
            <label>Email
                <input type="email" name="email" value="{{usager.email}}">
            </label>
            <label>Mot de passe
                <input type="password" name="password" value="{{usager.mot_de_passe}}">
            </label>
            <span class="text-danger">{{ errors | raw }}</span>
            <br>
            <input class="button-enregistrer" type="submit" value="Connecter" class="btn">
            <a href="{{path}}login/forgot" >Mot de passe oublié</a>
        </form>
    </div>
</body>
</html>