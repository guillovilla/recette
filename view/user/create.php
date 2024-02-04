{{ include('header.php', {title: 'Nouveau Utilisateur'}) }}

<div class="enchere-create">
        <form action="{{path}}user/store" method="post">
            <!-- <span class="text-danger">{{ errors | raw }}</span> -->
            <label>Nom d'utilisateur
                <input type="text" name="username" value="{{ user.username }}">
            </label>

            <label>Email
                <input type="email" name="email" value="{{ user.email }}">
            </label>

            {% if guest %}
            {#  {% if session.privilege == 3 %} #}
            <label>Telephone
                <input type="tel" name="phone" value="{{ user.phone }}">
            </label>
    
            <label>Address
                <input type="text" name="address" value="{{ user.address }}">
            </label>
            {% endif %}

            <label>Mot de passe
                <input type="password" name="password" value="{{ user.password }}">
            </label>

            {% if session.privilege == 1 or session.privilege == 2 %}
            <label>Privilege
                <select name="privilege_id">
                    <option value="">Selectionner un privilege</option>
                    {% for privilege in privileges %}
                    <option value="{{ privilege.id }}" {% if privilege.id == user.privilege_id %} selected {% endif %}>{{ privilege.privilege }}</option>
                    {% endfor %}
                </select>
            </label>
            {% else %}
            <input type="hidden" name="privilege_id" value="3">
            {% endif %}
            <span class="text-danger">{{ errors | raw }}</span><br>
            <input type="submit" value="Enregistrer" class="button-enregistrer">
        </form>
    </div>
</body>
</html>