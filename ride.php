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
    
    $db     = pg_connect("host=localhost port=5432 dbname=carpool user=postgres password=Camcam5647");	
    if(!$db){
		print "<h2> ERROR: CANNOT ESTABLISH CONNECTION TO DATABASE </h2> ";
		exit;
	}
	
    $result = pg_query($db, "SELECT rideid FROM ride");
    if (!$result) {
		echo "<h2>An error occurred.</h2>";
		exit;
	}
    while($row    = pg_fetch_assoc($result)){
		echo " <section>
				<svg width='1000' height='300'>
					<rect x='20' y='20' rx='20' ry='20' width='900' height='200'
					  style='fill:gray;stroke:black;stroke-width:5;opacity:0.5' />
					<text x='80' y='70' font-family='Verdana' font-size='20' fill='blue'> ".$row['rideid']." </text>
					 
					Sorry, your browser does not support inline SVG.
				</svg>
			</section>
		
		";
	}
    ?> 

	
</body>

</html>
