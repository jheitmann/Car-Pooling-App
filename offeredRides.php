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
    
    $activesRides = pg_query($con, "SELECT b.rideid, MAX(b.bid_price) AS max_bid FROM bid b, ride r, car c
									WHERE b.rideid NOT IN (SELECT cr.rideid FROM complete_ride cr)
									AND b.rideid = r.rideid
									AND r.carid = c.carid
									AND c.owner = '" . $_SESSION['email'] . "' 
									GROUP BY b.rideid 
									ORDER BY b.rideid DESC");
    
    if (pg_num_rows($activesRides) == 0) { 
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
		while($row = pg_fetch_assoc($activesRides)){
			echo " <section>
					<svg width='1000' height='100'>
						<rect x='20' y='20' rx='20' ry='20' width='900' height='60'
						style='fill:gray;stroke:black;stroke-width:5;opacity:0.5' />
						<text x='60' y='60' font-family='Verdana' font-size='30' fill='blue'> ID : ".$row['rideid']." </text>
						<text x='300' y='60' font-family='Verdana' font-size='20' fill='black'> Highest Bid : ".$row['max_bid']." </text>
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
