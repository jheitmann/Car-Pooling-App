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
    
    $rides = pg_query($con, "SELECT * FROM ride_price, bid WHERE bid.client = '" . $_SESSION['email'] . "' AND ride_price.rideid = bid.rideid
						ORDER BY ride_price.time_stamp DESC");
    
    if (pg_num_rows($rides) == 0) { 
		echo '<div class="error-msg">
				<i class="fa fa-times-circle"></i>
				There are no bids
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
		        <th>Your Bid</th>
		        <th>Current Highest Bid</th>
		        <th>Status</th>
		      </tr>
		    </thead>
		    <tbody>
		<?php
		while($row = pg_fetch_assoc($rides)){
			$query = "SELECT bid_price FROM bid WHERE client = '".$_SESSION["email"]."' AND rideid = ".$row["rideid"];
			$yourprice = pg_fetch_assoc(pg_query($con,$query));
			$yourprice = $yourprice["bid_price"];

			$query = "SELECT * FROM complete_ride WHERE rideid = ".$row["rideid"];
			$result = pg_query($con,$query);
			if(pg_num_rows($result) == 0){
				//The ride has not been fixed yet
				$status = "PENDING";
			}
			else{
				$result = pg_fetch_assoc($result);
				if(strcmp($_SESSION["email"], $result["client"]) == 0){
					//The current user is winner
					$status = "APPROVED";
				}
				else{
					$status = "REJECTED";
				}
			}
			echo " <tr>
		        <td>".$row['origin']."</td>
		        <td>".$row['destination']."</td>
		        <td>".$row['time_stamp']."</td>
		        <td>$ ".$yourprice."</td>
		        <td>$ ".($row['bid_price']?$row['bid_price']:$row['price'])."</td>";
		    echo '<td><form action = "rideDetails.php" method="POST">
		  	<input type = "hidden" name = "rideid" value = "'.$row["rideid"].'">';

		        if(strcmp($status, "PENDING")==0){
		        	echo '<button type="submit" class="btn">BID MORE</button>';
		        }
		        elseif (strcmp($status, "APPROVED")==0) {
					echo "<button type='submit' class='btn btn-success'>APPROVED</button>";
		        }
		        elseif (strcmp($status, "REJECTED")==0) {
		        	echo "<button type='submit' class='btn btn-danger'>REJECTED</button>";
		        }
			echo " </form></td></tr>";
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
