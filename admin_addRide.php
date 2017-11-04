<?php require("header2.php"); ?>

<?php
	require("db_connect.php");
	if(!empty($_POST)){
		$result = pg_query($con , "SELECT r.rideid FROM ride r WHERE r.rideid >= ALL(SELECT r2.rideid FROM ride r2)");
		$newid = pg_fetch_assoc($result)['rideid'] +1;
		$query = "INSERT INTO ride VALUES ('".$_POST[carid]."','".$_POST[time]."','".$_POST[origin]."','".$_POST[destination]."',".$_POST[price].",".$newid.")";
		pg_query($con,$query);
		header("Location: admin_ride.php");
		exit;
	}
	
	$cars = pg_query($con, "SELECT * FROM car");
	require("db_close.php");
?>
<div class="container">
    <form class="form-horizontal" method="POST" action="admin_addRide.php">
      <div class="form-group">
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
        <input name="origin" type="text" class="form-control" id="origin" required>
      </div>
      <div class="form-group">
        <label for="phone">Destination:</label>
        <input name="destination" type="text" class="form-control" id="destination" required>
      </div>
      <div class="form-group">
        <label for="creditcard">Price:</label>
       <input name="price" type="number" step=0.5 class="form-control" id="price" required>
      </div>
      <div class="form-group">
        <label for="time">Date and Time:</label>
        <input name="time" type="datetime" class="form-control" id="time" required>
      </div>
      <div class="form-group"> 
        <div class="text-center">
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </div>
    </form> 
  </div>
