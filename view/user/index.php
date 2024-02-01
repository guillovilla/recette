{{ include('header.php', {title: 'User List'}) }}

    <div class="form">
        <table>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Telephone</th>
                <th>Adresse</th>
                <th>Privilege</th>
                <th>Delete</th>
            </tr>
            {% for user in users %}
                <tr>
                    <td>{{user.username}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.phone}}</td>
                    <td>{{user.address}}</td>
                    <td>{{user.privilege}}</td>
                    <td>
                        <form action="{{path}}user/delete" method="post">
                        <input type="hidden" name="id" value="{{user.id}}">
                            <input type="submit" value="Delete" class="btn-danger" {% if session.privilege != 1 %} disabled {% endif %}>
                        </form>
                    </td>
                </tr>
            {% endfor %}
        </table>
        <br>
        <p class="text-normal">{{ message }}</p>
        <br>
        <a href="{{path}}user/create" class="btn">Ajouter</a>
</body>
</html>