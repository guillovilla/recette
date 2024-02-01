{{ include('header.php', {title: 'Login'}) }}
<body>
    <div class="container">
        <form action="{{path}}login/newPasswordUpdate" method="post">
            <h3>New pass</h3>
            <span class="text-danger">{{ errors | raw }}</span>
            <label>Mot de passe
                <input type="password" name="password">
                <input type="hidden" name="id" value="{{id}}">
            </label>
            <input type="submit" value="Reset" class="btn">
        </form>
    </div>
</body>
</html>