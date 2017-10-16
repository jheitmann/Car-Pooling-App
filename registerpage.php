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
        <div class="row">
          <div class="input-field col s12 center">
            <img src="logo.png" alt="" class="responsive-img valign profile-image-login" style="padding: 5%; width:400px;height:150px;">
            <p class="center login-form-text"></p>
          </div>
        </div>
        
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input class="validate" id="email" type="email" name="email">
            <label for="email">Email</label>
          </div>
        </div>

        <?php if($email_not_available){
          echo '<div class="row">
                  <div class="input-field col s12">
                    Email already used
                  </div>
                </div>';
         } ?>
        
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="name" type="text" name ="name">
            <label for="name">Name</label>
          </div>
        </div>

        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" type="password" name ="password">
            <label for="password">Password</label>
          </div>
        </div>

        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password_again" type="password" name ="password_again">
            <label for="password_again">Re-type password</label>
          </div>
        </div>

        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="phone" type="number" name ="phone">
            <label for="Phone">Phone number</label>
          </div>
        </div>

        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="credit_number" type="text" name ="credit_number">
            <label for="credit_number">Credit Card number</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <?php if(!$pass_match){
              echo "Password doesnot match";
            } ?>
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