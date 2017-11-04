<?php
  session_start();
  if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit;
  }
?>


<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<body>
	
<!-- Navigation -->
<?php require('header.php'); ?>

<?php
    require("db_connect.php");
    echo "<p></p>";
									
	$allRides = pg_query($con, "SELECT r.rideid, r.origin, r.destination, r.time_stamp, r.price FROM ride r, car c 
								   WHERE r.carid = c.carid
								   AND c.owner = '" . $_SESSION['email'] . "'
								   ORDER BY r.time_stamp DESC");	
									   
    if (pg_num_rows($allRides) == 0) { 
		echo '<div class="error-msg">
				<i class="fa fa-times-circle"></i>
				You did not offer a ride
			  </div>';
	} else {
		?>

		<div class="table-responsive">          
		  <table class="table table-hover">
		    <thead>
		      <tr>
		        <th>Origin</th>
		        <th>Destination</th>
		        <th>Date & Time</th>
		        <th>Highest Bid</th>
		        <th>Status</th>
		      </tr>
		    </thead>
		    <tbody>
				
		<?php
		while($row = pg_fetch_assoc($allRides)){
			$query = "SELECT * FROM complete_ride WHERE rideid = ".$row['rideid'];
			$completed_rides = pg_query($con,$query);
			$query = "SELECT price, bid_price FROM ride_price WHERE rideid = ".$row['rideid'];
			$view_query = pg_query($con,$query);
			$ride_price = pg_fetch_assoc($view_query);
			if(pg_num_rows($completed_rides) == 0){
				if(is_null($ride_price['bid_price'])) {
					$status = "PENDING";
					$price = $row['price'];
				} else {
					$status = "ACCEPT";
					$price = $ride_price['bid_price'];
				}
			}
			else{
				$status = "COMPLETED";
				$price = $ride_price['bid_price'];
			}
			echo " <tr>
		        <td>".$row['origin']."</td>
		        <td>".$row['destination']."</td>
		        <td>".$row['time_stamp']."</td>";
		        
		        if(strcmp($status, "ACCEPT")==0){
					echo "<td>".$price."</td>";
		        	echo '<td><form action = "acceptRide.php" method="POST">
		  	<input type = "hidden" name = "rideid" value = "'.$row["rideid"].'">
		  	  <button type="submit" class="btn btn-block">ACCEPT</button>
		  </form></td>';
		        }
		        else if(strcmp($status, "PENDING")==0) {
					echo "<td>-</td>";
					echo "<td><form action = 'rideDetails.php' method='POST'>
		  	<input type = 'hidden' name = 'rideid' value = '".$row['rideid']."'><button type='submit' class='btn btn-danger btn-block'>PENDING</button></form></td>";
		        }
		        else {
					echo "<td>".$row['price']."</td>";
					echo "<td><form action = 'rideDetails.php' method='POST'>
		  	<input type = 'hidden' name = 'rideid' value = '".$row['rideid']."'><button type='submit'class='btn btn-success btn-block'>COMPLETED</button></form></td>";
				}

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
