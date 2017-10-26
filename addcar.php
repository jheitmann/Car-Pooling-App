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


  <div class="container">
      <form class="form-horizontal" method="POST" action="addcar.php">
        <div class="form-group">
          <label for="model">Car Model:</label>
          <input name="model" type="text" class="form-control" id="model" required>
        </div>
        <div class="form-group">
          <label for="color">Car Color:</label>
          <input name="color" type="text" class="form-control" id="color" required>
        </div>
        <div class="form-group">
          <label for="carid">Car Number:</label>
          <input name = "carid" type="text" class="form-control" id="carid" required>
          <?php if($carnumberused){
            ?>
                <span class="help-block">Car Number already Registered in system</span>
            <?php
          } ?>
        </div>
        <div class="form-group">
          <label for="capacity">Car Capacity offered:</label>
          <input name="capacity" type="number" class="form-control" id="capacity" value = "1" min = "1" step = "1" required>
        </div>
        <div class="form-group"> 
          <div class="text-center">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
      </form> 
    </div>
    

</body>
</html>
