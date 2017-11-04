<?php require('header2.php'); ?>

<?php
    require("db_connect.php");
    echo "<p></p>";
    
	$cars = pg_query($con, "SELECT * FROM car ORDER BY carid;");
    if (pg_num_rows($cars) == 0) { 
		echo '<div class="error-msg">
				<i class="fa fa-times-circle"></i>
				There are no cars
			  </div>';
	} else {
		?>

		<div class="table-responsive">          
		  <table class="table table-hover">
		    <thead>
		      <tr>
		        <th>Car Number</th>
		        <th>Model</th>
		        <th>Color</th>
		        <th>Capacity</th>
		        <th>Owner</th>
		        <th colspan="2"><button class='btn btn-success' align = "center" onclick="location.href = './admin_addCar.php'">Add Car</button></th>
		      </tr>
		    </thead>
		    <tbody>
		<?php
		while($row = pg_fetch_assoc($cars)){
			$query = "SELECT * FROM person WHERE email = '".$row['owner']."';";
	    	$user = pg_query($con, $query);
	    	$user = pg_fetch_assoc($user);
			echo " <tr>
		        <td>".$row['carid']."</td>
		        <td>".$row['model']."</td>
		        <td>".$row['color']."</td>
		        <td>".$row['capacity']."</td>";
		    echo "<td><a href = ./admin_viewuser.php?email=".$row['owner'].">".$user['name']."</a></td>";
		  		echo '<td><form action = "admin_modifycar.php" method="GET">
		  	<input type = "hidden" name = "carid" value = "'.$row["carid"].'">
		  	  <button type="submit" class="btn">Modify</button>
		  </form></td>';
		  		echo '<td><form action = "admin_deletecar.php" method="GET">
		  	<input type = "hidden" name = "carid" value = "'.$row["carid"].'">
		  	  <button type="submit" class="btn btn-danger">Delete</button>
		  </form></td>';
			echo " </tr>";
		}
		?>
		</tbody>
		  </table>
		  </div>
		<?php 
	}
	require("db_close.php");
?>
</body>
</html>
