<?php require('header2.php');?>
<?php
    if(!empty($_GET)){
      require("db_connect.php");
      $carid = $_GET["carid"];
      $query = "SELECT * FROM car WHERE carid = '$carid'";
      $result = pg_query($con, $query);
      $row    = pg_fetch_assoc($result);
    }
    elseif(!empty($_POST)){
      require("db_connect.php");
      $carid = $_POST["old_carid"];
      $query = "UPDATE car SET carid = '".$_POST["carid"]."', model = '".$_POST["model"]."', color = '".$_POST["color"]."', capacity = '".$_POST["capacity"]."', owner = '".$_POST['owner']."' WHERE carid = '$carid';";
      $result = pg_query($con, $query);
      require("db_close.php");
      header("Location: admin_car.php");
      exit;
    }
    else{
      echo "INVALID ACCESS";
      exit;
    }
?>

<div class="container">
    <form class="form-horizontal" method="POST" action="admin_modifycar.php">
      <div class="form-group">
        <label for="carid">Car Number:</label>
        <?php echo '<input name="carid" type="text" class="form-control" id="carid" value = "'.$row["carid"].'"required>'; ?>
        <?php echo '<input name="old_carid" type="hidden" value = "'.$row["carid"].'">'; ?>
      </div>
      <div class="form-group">
        <label for="name">Model:</label>
        <?php echo '<input name="model" type="text" class="form-control" id="model" value = "'.$row["model"].'"required>'; ?>
      </div>
      <div class="form-group">
        <label for="color">Color:</label>
        <?php echo '<input name="color" type="text" class="form-control" id="color" value = "'.$row["color"].'"required>'; ?>
      </div>
      <div class="form-group">
        <label for="capacity">Capacity:</label>
          <?php echo '<input name="capacity" type="number" class="form-control" id="capacity" value = "'.$row["capacity"].'"required>'; ?>
        </div>
        <div class="form-group">
          <label for="owner">Owner:</label>
          <select class="form-control" id="owner" name="owner">
            <?php
            $users = pg_query($con, "SELECT email FROM person ORDER BY email");
            while($choices = pg_fetch_assoc($users)){
              echo "<option value='".$choices['email']."' ";
              if($row['owner'] == $choices['email']){
                echo "selected";
              }
              echo">".$choices['email']."</option>";
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
</body>
</html>