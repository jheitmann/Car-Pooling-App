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
  	// Connect to the database. Please change the password in the following line accordingly
    require("db_connect.php");?>
	<form name='update' action='ride.php' method='GET' >
	<?php
	$locations = pg_query($con, "SELECT DISTINCT origin FROM ride");
	echo "Departure : <select name='origin'><option value=''>Select...</option>";
	while($choices = pg_fetch_assoc($locations)){
		echo "<option value='".$choices['origin']."' ";
		if(isset($_GET[origin]) && $_GET[origin] == $choices['origin']){
			echo "selected";
		}
		echo">".$choices['origin']."</option>";
	}
	echo "</select>";
	
	$locations = pg_query($con, "SELECT DISTINCT  destination FROM ride");
	echo "Destination : <select name='destination'><option value=''>Select...</option>";
	while($choices = pg_fetch_assoc($locations)){
		echo "<option value='".$choices['destination']."' ";
		if(isset($_GET[destination]) && $_GET[destination] == $choices['destination']){
			echo "selected";
		}
		echo">".$choices['destination']."</option>";
	}
	echo "</select>";
	
	?>
	<p>
			Sort by
		<select name="order">
			<option value="time_stamp">Date</option>
			<option value="price">Price</option>
		</select>
		<input type='submit' name='submit' />
	</p></form>
	
	
	<!-- QUERY AND PRINT RESULT -->
	<?php
	
    $result = pg_query($con, "SELECT * FROM ride r 
		where r.rideid NOT IN (Select c.rideid from complete_ride c)
		AND r.origin LIKE '%".$_GET[origin]."%'
		AND r.destination LIKE '%".$_GET[destination]."%'
		ORDER BY ".( isset($_GET[order])? $_GET[order] :"time_stamp"));

    $update = pg_query($con, "UPDATE ride SET price = '".$POST["bid"]."' WHERE rideid = '".$row["rideid"]."'");

    $insertBid = pg_query($con, "INSERT INTO bid VALUES('".$_SESSION['email']."', '".$POST["bid"]."', '". $row["carid"]."')");
		
    if (!$result) {
		echo "<h2>An error occurred.</h2>";
		exit;
	}
    while($row    = pg_fetch_assoc($result)){
    	$minBid = $row['price'] + 1;
		echo " <section>
				<svg width='1000' height='240'>
					<rect x='20' y='20' rx='20' ry='20' width='900' height='200'
					  style='fill:gray;stroke:black;stroke-width:5;opacity:0.5' />
					<text x='80' y='110' font-family='Verdana' font-size='20' fill='black'> From : ".$row['origin']." </text>
					<text x='80' y='140' font-family='Verdana' font-size='20' fill='black'> To : ".$row['destination']." </text>
					<text x='80' y='170' font-family='Verdana' font-size='20' fill='black'> Date : ".$row['time_stamp']." </text>
					<text x='600' y='170' font-family='Verdana' font-size='20' fill='black'> Price : ".$row['price']." dollars </text>
				</svg>
				<form name='rideDetails' action='rideDetails.php' method='POST'>
				<input type='hidden' name='rideid' value='".$row['rideid']."' />
				<button type='submit' value='s'>Details</button>
				</form>


				<form name='newBid' action='newBid.php' method='POST'>
				<input type='hidden' name='email' value='".$_SESSION['email']."'>
				<input type='hidden' name='rideid' value='".$row["rideid"]."'>
				<input type='number' name='bid' value='".$minBid."' step='1' min='".$minBid."' />
				<input type='submit' value='New Bid'>
				</form>
			</section>
		
		";

	}
	
	require("db_close.php");
    ?> 

	
</body>

</html>
