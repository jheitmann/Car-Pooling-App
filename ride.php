<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<body>
	
<!-- Navigation -->
<nav class="w3-bar w3-black">
  <a href="index.php" class="w3-button w3-bar-item">Home</a>
  <a href="ride.php" class="w3-button w3-bar-item">Rides</a>
  <a href="record.php" class="w3-button w3-bar-item">Past Rides</a>
  <a href="newAccount.php" class="w3-button w3-bar-item">Create Account</a>
  <a href="viewAccount.php" class="w3-button w3-bar-item">View Account</a>
</nav>

<?php
  	// Connect to the database. Please change the password in the following line accordingly
    
    $db     = pg_connect("host=localhost port=5432 dbname=carpool user=application password=database2017");	
    if(!$db){
		print "<h2> ERROR: CANNOT ESTABLISH CONNECTION TO DATABASE </h2> ";
		exit;
	}
	
	echo "<form name='update' action='ride.php' method='POST' >";
	$locations = pg_query($db, "SELECT DISTINCT origin FROM ride");
	echo "From : <select name='origin'><option value=''>Select...</option>";
	while($choices = pg_fetch_assoc($locations)){
		echo "<option value='".$choices['origin']."' ";
		if(isset($_POST[origin]) && $_POST[origin] == $choices['origin']){
			echo "selected";
		}
		echo">".$choices['origin']."</option>";
	}
	echo "</select>";
	
	$locations = pg_query($db, "SELECT DISTINCT  destination FROM ride");
	echo "To : <select name='destination'><option value=''>Select...</option>";
	while($choices = pg_fetch_assoc($locations)){
		echo "<option value='".$choices['destination']."' ";
		if(isset($_POST[destination]) && $_POST[destination] == $choices['destination']){
			echo "selected";
		}
		echo">".$choices['destination']."</option>";
	}
	echo "</select><input type='submit' name='submit' /></form>";
	
	
	
    $result = pg_query($db, "SELECT * FROM ride r 
		where r.rideid NOT IN (Select c.rideid from complete_ride c)
		AND r.origin LIKE '%".$_POST[origin]."%'
		AND r.destination LIKE '%".$_POST[destination]."%'
		ORDER BY time_stamp");
		
    if (!$result) {
		echo "<h2>An error occurred.</h2>";
		exit;
	}
    while($row    = pg_fetch_assoc($result)){
		echo " <section>
				<svg width='1000' height='240'>
					<rect x='20' y='20' rx='20' ry='20' width='900' height='200'
					  style='fill:gray;stroke:black;stroke-width:5;opacity:0.5' />
					<text x='60' y='70' font-family='Verdana' font-size='30' fill='blue'> ID : ".$row['rideid']." </text>
					<text x='80' y='110' font-family='Verdana' font-size='20' fill='black'> From : ".$row['origin']." </text>
					<text x='80' y='140' font-family='Verdana' font-size='20' fill='black'> To : ".$row['destination']." </text>
					<text x='80' y='170' font-family='Verdana' font-size='20' fill='black'> Date : ".$row['time_stamp']." </text>
					<text x='600' y='170' font-family='Verdana' font-size='20' fill='black'> Price : ".$row['price']." dollars </text>
					Sorry, your browser does not support inline SVG.
				</svg>
			</section>
		
		";
	}
    ?> 

	
</body>

</html>
