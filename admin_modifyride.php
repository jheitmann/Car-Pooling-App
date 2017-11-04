<?php require('header2.php');?>
<?php
    if(!empty($_GET)){
      require("db_connect.php");
      $rideid = $_GET["rideid"];
      $query = "SELECT * FROM ride r WHERE r.rideid = '$rideid'";
      $result = pg_query($con, $query);
      $row    = pg_fetch_assoc($result);
      
      $query = "SELECT * FROM car";
      $cars = pg_query($con, $query);
      require("db_close.php");
    }
    elseif(!empty($_POST)){
      require("db_connect.php");
      
      $query = "UPDATE ride SET carid = '".$_POST["carid"]."', origin = '".$_POST["origin"]."', destination = '".$_POST["destination"]."', price = '".$_POST["price"]."', time_stamp='".$_POST["time"]."' WHERE rideid =".$_POST["rideid"].";";
      $result = pg_query($con, $query);
      require("db_close.php");
      header("Location: admin_ride.php");
      exit;
    }
    else{
      echo "INVALID ACCESS";
      require("db_close.php");
      exit;
    }
?>

<div class="container">
    <form class="form-horizontal" method="POST" action="admin_modifyride.php">
      <div class="form-group">
	<?php echo '<input name="rideid" type="hidden" value = "'.$row["rideid"].'">'; ?>

        <label for="carid">Driver and Car:</label>
        <select class="form-control" id="carid" name="carid">
			<?php
			while($car=pg_fetch_assoc($cars)){
					echo '<option value="'.$car["carid"].'" '.(strcmp($car["carid"],$row[carid])? "":"selected").'><i color=blue>'.$car["owner"].'</i> : '.$car["model"].' '.$car["color"].'</option>  ';
			}
			
			?>
        </select>
      </div>
      <div class="form-group">
        <label for="name">Origin:</label>
        <?php echo '<input name="origin" type="text" class="form-control" id="origin" value = "'.$row["origin"].'"required>'; ?>
      </div>
      <div class="form-group">
        <label for="phone">Destination:</label>
        <?php echo '<input name="destination" type="text" class="form-control" id="destination" value = "'.$row["destination"].'"required>'; ?>
      </div>
      <div class="form-group">
        <label for="creditcard">Price:</label>
        <?php echo '<input name="price" type="number" step=0.5 class="form-control" id="price" value = "'.$row["price"].'"required>'; ?>
      </div>
      <div class="form-group">
        <label for="creditcard">Date and Time:</label>
        <?php echo '<input name="time" type="datetime" class="form-control" id="time" value = "'.$row["time_stamp"].'"required>'; ?>
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
