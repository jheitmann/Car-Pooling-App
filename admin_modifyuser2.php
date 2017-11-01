<?php require('header2.php');?>
<?php
    if(!empty($_POST)){
      require("db_connect.php");
      $email = $_POST["email"];
      if(strcmp($_POST["is_admin"],"yes")==0){
        $query = "UPDATE person SET email = '".$_POST["email"]."', name = '".$_POST["name"]."', phone = '".$_POST["phone"]."', creditcard = '".$_POST["creditcard"]."', is_admin = TRUE WHERE email = '$email';";
      }
      else{
        $query = "UPDATE person SET email = '".$_POST["email"]."', name = '".$_POST["name"]."', phone = '".$_POST["phone"]."', creditcard = '".$_POST["creditcard"]."', is_admin = FALSE WHERE email = '$email';";
      }
      $result = pg_query($con, $query);
      require("db_close.php");
      header("Location: admin_user.php");
      // echo "dansjkdnasjdbhadbasbdhsabndkjnjknjk";
      exit;
    }
    else{
      echo "ACCESS DENIED";
    }
?>