<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EASIERIDE Registration</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">

<style type="text/css">
html,
body {
    height: 100%;
}
html {
    display: table;
    margin: auto;
}
body {
    display: table-cell;
    vertical-align: middle;
}
.margin {
  margin: 0 !important;
}
</style>
  
</head>

<body class="white">
    <div class="col s12 z-depth-6 card-panel">
      <form class="login-form" method="post">
        <div class="row margin">
          <div class="input-field col s12">
            <input class="validate" id="email" type="email" name="email" required>
            <label for="email">Email</label>
            <?php if($email_not_available){
              ?>
                <span class="help-block">Email already used</span>
              <?php
            } ?>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <input id="name" type="text" name ="name" required>
            <label for="name">Name</label>
          </div>
        </div>

        <div class="row margin">
          <div class="input-field col s12">
            <input id="password" type="password" name ="password" required>
            <label for="password">Password</label>
          </div>
        </div>

        <div class="row margin">
          <div class="input-field col s12">
            <input id="password_again" type="password" name ="password_again" required> 
            <label for="password_again">Re-type password</label>
            <?php if(!$pass_match){
              ?>
                <span class="help-block">Password doesnot match</span>
              <?php
            } ?>
            </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <input id="phone" type="number" name ="phone" required>
            <label for="Phone">Phone number</label>
          </div>
        </div>

        <div class="row margin">
          <div class="input-field col s12">
            <input id="credit_number" type="text" name ="credit_number" required>
            <label for="credit_number">Credit Card number</label>
          </div>
        </div>


        <div class="row">
          <div class="input-field col s12">
            <button type='submit' name='btn_login' class='btn waves-effect waves-light col s12'>Register</button>
          </div>
          <div class="input-field col s12">
            <p class="margin center medium-small sign-up">Already have an account? <a href="login.php">Login</a></p>
          </div>
        </div>
      </form>
    </div>
</body>


<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>

</html>