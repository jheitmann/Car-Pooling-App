<?php require("header2.php");
  require("db_connect.php");
  if(!empty($_POST)){
    $query = "SELECT * FROM car WHERE carid = '".$_POST['carid']."'";
    $result = pg_query($con, $query);
    $row    = pg_fetch_assoc($result);
    if(empty($row)){
      $query = "INSERT INTO car VALUES('".$_POST["carid"]."', '".$_POST["model"]."', '".$_POST["color"]."', ".$_POST["capacity"].", '".$_POST["owner"]."');";
      $result = pg_query($con, $query);
      // $row    = pg_fetch_assoc($result);
      require("db_close.php");
      header("Location: admin_car.php");
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
  <div class="container">
    <form class="form-horizontal" method="POST" action="admin_addCar.php">
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
        <label for="owner">Owner:</label>
        <select class="form-control" id="owner" name="owner">
          <?php
          $users = pg_query($con, "SELECT email FROM person ORDER BY email");
          $choices = pg_fetch_assoc($users);
          echo $choices["email"];
          while($choices = pg_fetch_assoc($users)){
            echo "<option value='".$choices['email']."'>".$choices['email']."</option>";
          }
          ?>
        </select>
      </div>
      <div class="form-group"> 
        <div class="text-center">
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </div>
    </form> 
  </div>