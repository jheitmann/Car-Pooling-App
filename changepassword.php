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

  <form action='changepassword.php' method = 'POST'> 
    Old Password : <input type="password" name="old_password"><br>
                <?php if($incorrect_old){
                  echo "Incorrect old password<br>";
                } ?>
    New Password : <input type="password" name="new_password"><br>
    Retype New Password : <input type="password" name="new_password2"><br>
                <?php if(!$match){
                  echo "Password doesnot match<br>";
                } ?>
    <input type="submit" value="Submit">
  </form>
</body>
</html>
