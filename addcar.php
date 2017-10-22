<?php
  session_start();
  if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit;
  }

  if(!empty($_POST)){
    require("db_connect.php");
    $email = $_SESSION["email"];
    $query = "SELECT * FROM car WHERE carid = '".$_POST['carid']."'";
    $result = pg_query($con, $query);
    $row    = pg_fetch_assoc($result);
    if(empty($row)){
      $query = "INSERT INTO car VALUES('".$_POST["carid"]."', '".$_POST["model"]."', '".$_POST["color"]."', ".$_POST["capacity"].", '".$email."');";
      echo $query;
      $result = pg_query($con, $query);
      // $row    = pg_fetch_assoc($result);
      require("db_close.php");
      header("Location: profile.php");
      exit;
    }
    else{
      $carnumberused = true;
    }
  }
  else{
    $carnumberused = false;
  }
?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<body>
  	
  <!-- Navigation -->
  <?php require('header.html');  ?>
  <form action='addcar.php' method = 'POST'> 
    Car Model : <input type="text" name="model"> <br>
    Car Color : <input type="text" name="color"> <br>
    Car Number : <input type="text" name="carid"> <br>
    <?php if($carnumberused){
      echo "Car Number already Registered in system<br>";
    } ?>
    Car available Capacity : <input type="number" name="capacity"> <br>
    <input type="submit" value="Submit">
  </form> 

</body>
</html>
