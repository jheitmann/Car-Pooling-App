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

	$cars = pg_query($con, "SELECT car.model, car.carid FROM car WHERE car.owner = '" . $_SESSION['email'] . "'");
	if (pg_num_rows($cars) == 0) { 
		echo " <section>
			<svg width='1000' height='100'>
				<rect x='20' y='20' rx='20' ry='20' width='900' height='80'
				  style='fill:gray;stroke:black;stroke-width:5;opacity:0.5' />
				<text x='60' y='70' font-family='Verdana' font-size='30' fill='blue'> You need to add a car to your profile first. </text>
				Sorry, your browser does not support inline SVG.
			</svg>
		</section>
		
		";
	} 
	
	echo "<form name = update action='insertRide.php' method = 'POST'> Car : <select name='carid'><option value=''>Select...</option>";
	while($choices = pg_fetch_assoc($cars)) { 
		echo "<option value='".$choices['carid']."' ";
		echo">".$choices['model'].", ".$choices['carid']."</option>";
	} 
	echo "</select><br>";
	
?>
		Origin:
		<input type="text" name="origin" value="Kent Ridge"><br>
		Destination:
		<input type="text" name="destination" value="Marina Bay"><br>
		Minimum Price:
		<input type="number" name="min" value="0" step="1" min="0"><br>
		Date:
		<input type="date" name="date" value="2017-10-23" step="1" name="IncidentDate">
		Hour:
		<input type="number" name="hour" value="12" step="1" min="0" max="23">
		Minute:
		<input type="number" name="minute" value="00" step="1" min="0" max="59"><br>
		<br>
		<input type="submit" value="Submit">
	</form> 
	
	<p></p>
	
<?php
	require("db_close.php");
?>

	
</body>

</html>
