<?php 
  if(!empty($_POST)){
    session_start();
    require("db_connect.php");
    $query = "SELECT * FROM person WHERE email = '".$_POST["email"]."'";
    $result = pg_query($con, $query);
    $row    = pg_fetch_assoc($result);
    if(empty($row)){
      $email_not_available = false;
      $pass = $_POST["password"];
      $repass = $_POST["password_again"];
      if(strcmp($pass,$repass)==0){
        $pass_match = true;
        // $pass = hash('sha256',$pass);
        $query = "INSERT INTO person VALUES('".$_POST["email"]."', '".$_POST["name"]."', ".
                  $_POST["phone"].", '".$_POST["credit_number"]."', '".$pass."')";
        $result = pg_query($con, $query);
        if(!$result){
          echo "Error";
          exit;
        }
        else{
          $_SESSION['email'] = $_POST["email"];
          require("db_close.php");        
          header("Location: login.php");
          exit;
        }
      }
      else{
        $pass_match = false;
      }
    }
    else{
      $email_not_available = true;
    }
    require("db_close.php");
  }
  else{
    $email_not_available = false;
    $pass_match = true;
  }
  require("registerpage.php");
?>
