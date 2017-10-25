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
<body>
	
<!-- Navigation -->
<?php require('header.html'); ?>

<?php
    require("db_connect.php");
    echo "<p></p>";
    
    $activeRides = pg_query($con, "SELECT b.rideid, MAX(b.bid_price) AS max_bid FROM bid b, ride r, car c
									WHERE b.rideid NOT IN (SELECT cr.rideid FROM complete_ride cr)
									AND b.rideid = r.rideid
									AND r.carid = c.carid
									AND c.owner = '" . $_SESSION['email'] . "' 
									GROUP BY b.rideid 
									ORDER BY b.rideid DESC");
									
	$activeRides = pg_query($con, "SELECT r.rideid, r.origin, r.destination, r.time_stamp, r.price FROM ride r, car c 
								   WHERE r.carid = c.carid
								   AND c.owner = '" . $_SESSION['email'] . "'
								   AND r.rideid NOT IN (SELECT cr.rideid FROM complete_ride cr)
								   ORDER BY r.time_stamp DESC");	
									   
    if (pg_num_rows($activeRides) == 0) { 
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
		        <th>Current Highest Bid</th>
		        <th>Status</th>
		      </tr>
		    </thead>
		    <tbody>
				
		<?php
		while($row = pg_fetch_assoc($activeRides)){
			$query = "SELECT * FROM bid WHERE bid.rideid = ".$row["rideid"];
			$result = pg_query($con,$query);
			if(pg_num_rows($result) == 0){
				$status = "PENDING";
				
			}
			else{
				$status = "ACCEPT";
			}
			echo " <tr>
		        <td>".$row['origin']."</td>
		        <td>".$row['destination']."</td>
		        <td>".$row['time_stamp']."</td>
		        <td>$ ".$row['price']."</td>";

		        if(strcmp($status, "ACCEPT")==0){
					$query = "SELECT client FROM bid WHERE bid_price = ".$row["price"];
		        	echo '<td><form action = "acceptRide.php" method="POST">
		  	<input type = "hidden" name = "rideid" value = "'.$row["rideid"].'">
		  	<input type = "hidden" name = "client" value = "'.pg_fetch_assoc(pg_query($con, $query))["client"].'">
		  	  <input type="submit" value="ACCEPT">
		  </form></td>';
		        }
		        else {
					echo "<td><button style='background-color:red'>PENDING</button></td>";
		        }

		     echo " </tr>";
		}
		?>
		    </tbody>
		  </table>
		  </div>s
		  		
		<?php 
	} 
    
    require("db_close.php");
?>

	
</body>

</html>
