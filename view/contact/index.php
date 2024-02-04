{{ include('header.php', {title: 'Contact List'}) }}

    <div class="form">
        <table>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Message</th>
            </tr>
            {% for contact in contacts %}
                <tr>
                    <td>{{contact.nom}}</td>
                    <td>{{contact.email}}</td>
                    <td>{{contact.message}}</td>
                </tr>
            {% endfor %}
        </table>
</body>
</html>