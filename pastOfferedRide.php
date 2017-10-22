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
    
    $rides = pg_query($con, "SELECT * FROM car, ride WHERE car.owner = '" . $_SESSION['email'] . "' AND car.carid = ride.carid
						ORDER BY ride.time_stamp DESC");
    
    if (pg_num_rows($rides) == 0) { 
		echo " <section>
			<svg width='1000' height='100'>
				<rect x='20' y='20' rx='20' ry='20' width='900' height='80'
				  style='fill:gray;stroke:black;stroke-width:5;opacity:0.5' />
				<text x='60' y='70' font-family='Verdana' font-size='30' fill='blue'> You did not offer any ride. </text>
				Sorry, your browser does not support inline SVG.
			</svg>
		</section>
		
		";
	} else {
		while($row = pg_fetch_assoc($rides)){
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
	} 
    
    require("db_close.php");
?>

	
</body>

</html>
