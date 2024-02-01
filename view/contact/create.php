{{ include('header.php', {title: 'Contact'}) }}

    <div class="enchere-create">
        <form action="{{path}}contact/store" method="post">
            <label>Nom
                <input type="text" name="nom" value="{{contact.nom}}">
            </label>
            <label>Email
                <input type="email" name="email" value="{{contact.email}}">
            </label>
            <label>Message
                <textarea type="text" name="message" value="{{contact.message}}"></textarea>
            </label>
            <span class="text-danger">{{ errors | raw }}</span>
            <input type="submit" value="Envoye" class="button-enregistrer">
            <span class="text-center">{{ message }}</span>
        </form>
    </div>
</body>
</html>