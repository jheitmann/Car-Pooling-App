<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Register | Instructor</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
          .nav-tabs li {
              width: 50%;
            }
        </style>
  </head>
  <body>
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <h1>Instructor Login</h1>
            <ul class="nav nav-tabs">
                <li><a href="login.php">Login</a></li>
                <li class="active"><a href="register.php">Register</a></li>
            </ul>
            <br>
            <form action="{% url 'feeder:instructor_register' %}" method="post">
                  {% csrf_token %}
                 {% if error_message %}<p><strong>{{ error_message }}</strong></p>{% endif %}
                  {% for field in form %}
                    <div class="form-group">
                        {% if field.errors %} <p style="color: rgb(255,0,0)">{{field.errors}}</p>{% endif %}
                        {{ field.label_tag }} {{ field }}
                        {% if field.help_text %}
                        <p class="help">{{ field.help_text|safe }}</p>
                        {% endif %}
                    </div>
                  {% endfor %}
                <div align="center">
                    <button type="submit" class="btn btn-success">Register</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>