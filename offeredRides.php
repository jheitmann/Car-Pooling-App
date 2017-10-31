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
<?php require('header.html'); ?>

<?php
    require("db_connect.php");
    echo "<p></p>";
									
	$allRides = pg_query($con, "SELECT r.rideid, r.origin, r.destination, r.time_stamp, r.price FROM ride r, car c 
								   WHERE r.carid = c.carid
								   AND c.owner = '" . $_SESSION['email'] . "'
								   ORDER BY r.time_stamp DESC");	
									   
    if (pg_num_rows($allRides) == 0) { 
		echo " <section>
			<svg width='1000' height='100'>
				<rect x='20' y='20' rx='20' ry='20' width='900' height='80'
				  style='fill:gray;stroke:black;stroke-width:5;opacity:0.5' />
				<text x='60' y='70' font-family='Verdana' font-size='30' fill='blue'> You do not have any active rides. </text>
				Sorry, your browser does not support inline SVG.
			</svg>
		</section>
		
		";
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
			$query = "SELECT * FROM bid WHERE rideid = ".$row['rideid'];
			$bids = pg_query($con,$query);
			if(pg_num_rows($completed_rides) == 0){
				if(pg_num_rows($bids) == 0) {
					$status = "PENDING";
				} else {
					$status = "ACCEPT";
				}
			}
			else{
				$status = "COMPLETED";
			}
			echo " <tr>
		        <td>".$row['origin']."</td>
		        <td>".$row['destination']."</td>
		        <td>".$row['time_stamp']."</td>";
		        
		        if(strcmp($status, "ACCEPT")==0){
					echo "<td>".$row['price']."</td>";
		        	echo '<td><form action = "acceptRide.php" method="POST">
		  	<input type = "hidden" name = "rideid" value = "'.$row["rideid"].'">
		  	  <button type="submit" class="btn btn-block">ACCEPT</button>
		  </form></td>';
		        }
		        else if(strcmp($status, "PENDING")==0) {
					echo "<td>-</td>";
					echo "<td><button class='btn btn-danger btn-block'>PENDING</button></td>";
		        }
		        else {
					echo "<td>".$row['price']."</td>";
					echo "<td><button class='btn btn-success btn-block'>COMPLETED</button></td>";
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
