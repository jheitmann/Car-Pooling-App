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
        if(strcmp($_POST['new_password'],$_POST["new_password2"])==0){
          $match = true;
          $query = "UPDATE person SET password = '".$_POST["new_password"]."' WHERE email = '$email'";
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
        $match = true;
        $incorrect_old = true;
      }
    }
  }
  else{
    $incorrect_old = false;
    $match = true;
  }
?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<body>
  
<!-- Navigation -->
<?php require('header.html');?>  
  <div class="container">
      <form class="form-horizontal" method="POST" action="changepassword.php">
        <div class="form-group">
          <label for="old_password">Old Password:</label>
          <input name="old_password" type="password" class="form-control" id="old_password" required>
          <?php if($incorrect_old){
            ?>
                <span class="help-block">Incorrect old password</span>
            <?php
          } ?>
        </div>
        <div class="form-group">
          <label for="new_password">New Password:</label>
          <input name="new_password" type="password" class="form-control" id="new_password" required>
        </div>
        <div class="form-group">
          <label for="new_password2">Retype New Password:</label>
          <input name="new_password2" type="password" class="form-control" id="new_password2" required>
          <?php if(!$match){
            ?>
                <span class="help-block">Password doesnot match</span>
            <?php
          } ?>
        </div>
        <div class="form-group"> 
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Submit</button>
          </div>
        </div>
      </form> 
    </div>
</body>
</html>
