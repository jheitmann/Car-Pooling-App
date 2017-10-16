<?php
  session_start();
  if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit;
  }

  if(!empty($_POST)){
    require("db_connect.php");
    $email = $_SESSION["email"];
    $query = "SELECT * FROM person WHERE email = '$email'";
    $result = pg_query($con, $query);
    $row    = pg_fetch_assoc($result);
    if(!empty($row)){
      $pass = $_POST["old_password"];
      // $pass = hash('sha256',$pass);
      if(strcmp($pass,$row["password"])==0){
        $incorrect_old = false;
        if(strcmp($row['new_password'],$row["new_password2"])==0){
          $match = true;
          $query = "UPDATE person SET password = '".$row[new_password]."' WHERE email = '$email'";
          $result = pg_query($con, $query);
          require("db_close.php");
          header("Location: profile.php");
          exit;
        }
        else{
          $match = false;
        }
      }
      else{
        $incorrect_old = true;
      }
    }
  }
  $incorrect_old = false;
  $match = true;
?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<body>
	
<!-- Navigation -->
<?php require('header.html');?>

<main style="background-color: #fff">
  <div class="container" align="center" style="margin-left: 20px">
    <div class="col l8 offset-l2"> 
      <h5 style="text-align: center;padding: 20px;padding-bottom:0">
        <?php echo $row["name"]; ?> </h5>
        <div class="container" style="margin-bottom: 20px;margin-top: 25px;">
          <form class="login-form" method="post">
            <div class="row margin">
              <div class="input-field col s12">
                <i class="mdi-action-lock-outline prefix"></i>
                <input id="password" type="password" name ="old_password">
                <label for="old_password">Old Password</label>
              </div>
            </div>
            
            <div class="row">
              <div class="input-field col s12">
                <?php if($incorrect_old){
                  echo "Incorrect old password";
                } ?>
              </div>
            </div>
            
            <div class="row margin">
              <div class="input-field col s12">
                <i class="mdi-action-lock-outline prefix"></i>
                <input id="password" type="password" name ="new_password">
                <label for="new_password">New Password</label>
              </div>
            </div>
            <div class="row margin">
              <div class="input-field col s12">
                <i class="mdi-action-lock-outline prefix"></i>
                <input id="password" type="password" name ="new_password2">
                <label for="new_password2">Retype New Password</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <?php if($match){
                  echo "Password doesnot match";
                } ?>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <button type='submit' name='btn_login' class='btn waves-effect waves-light col s12'>Submit</button>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</main>


</body>
</html>
