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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body class="w3-light-grey">
	
<!-- Navigation -->
<?php require('header.php'); ?>

<?php require("db_connect.php");?>

<?php $rideq = pg_query($con , "SELECT * FROM ride r, car c, person p WHERE
r.carid = c.carid AND c.owner = p.email AND r.rideid='".$_POST['rideid']."'");
if (!$rideq) {
	echo "ERROR DATABASE";
	exit;
}
$ride = pg_fetch_assoc($rideq);
if (!$ride) {
	echo "ERROR RIDE UNDEFINED";
	exit;
}

$rideq =  pg_query($con , "Select * FROM complete_ride WHERE rideid = '".$_POST['rideid']."'");
if (!$rideq) {
	echo "ERROR DATABASE";
	exit;
}
$complete = pg_fetch_assoc($rideq);
$canSee = false;
if($complete){
	$canSee = $cansee || $complete['client'] == $_SESSION['email'];
}

$bids = pg_query($con ,"Select * FROM bid b WHERE b.rideid ='".$_POST[rideid]."' ORDER BY b.bid_price DESC" );
if (!$bids) {
	echo "ERROR DATABASE";
	exit;
}
$bestBid = pg_fetch_assoc($bids);
?>
<div class="w3-content w3-margin-top" font="Verdana" style="max-width:1400px;">

  <!-- The Grid -->
  <div class="w3-row-padding">

	<!-- Left Column -->
	<div class="w3-third">
	
		<div class="w3-white w3-text-grey w3-card-4">
          <div class="w3-display-upperleft w3-container w3-text-black">
            <h2><i class="fa fa-user-o fa-fw w3-margin-right w3-text-teal"></i><?php echo $ride['name'];?></h2>
          </div>
          <div class="w3-container">
          <hr>
          <p class="w3-large"><b><i class="fa fa-address-card fa-fw w3-margin-right w3-text-teal"></i>Contact</b></p>
          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $ride['email'];?></p>
          <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i>  <?php echo $ride['phone'];?></p>
          <hr>
		  <p class="w3-large"><b><i class="fa fa-car fa-fw w3-margin-right w3-text-teal"></i>Car</b></p>
          <p><?php echo $ride['model']?></p>
          <p><?php echo $ride['color']?></p>
          <p><i class="w3-text-teal">Capacity :</i><?php echo $ride['capacity']?></p>
          <?php if($canSee){
			  echo "<p>".$ride['carid']."</p>";
		  }
          ?>
		  </div>
		<br>
		</div>
	</div>
	<!--END LEFT-->
	
	<!-- Right Column -->
    <div class="w3-twothird">
		<div class="w3-container w3-card w3-white w3-margin-bottom">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-map-o fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Ride</h2>
			<div class="w3-container ">
				<h5 class="w3-opacity"><i class="fa fa-location-arrow fa-fw w3-margin-right w3-large w3-text-real"></i><i class="w3-margin-right w3-text-teal">Departure</i><?php echo $ride['origin']?></h5>
				<h5 class="w3-opacity"><i class="fa fa-map-marker fa-fw w3-margin-right w3-large w3-text-real"></i><i class=" w3-margin-right w3-text-teal">Arrival</i><?php echo $ride['destination']?></h5>
				<h5 class="w3-opacity"><i class="fa fa-calendar fa-fw w3-margin-right w3-large w3-text-real"></i><i class="w3-margin-right w3-text-teal">Date</i><?php echo $ride['time_stamp']?></h5>
			</div>
        </div>
        
        <!-- BIDS -->
        <div class="w3-container w3-card w3-white">
		<?php
		if($complete){
			echo"
			<h2 class='w3-text-grey w3-padding-16'><i class='fa fa-handshake-o fa-fw w3-margin-right w3-xxlarge w3-text-teal'></i>Status</h2>
			<div class='w3-container'>";
			if($canSee){
				echo "<h3 class='w3-opacity'><b>Your offer was accepted by the driver for ".$complete['final_price']."$</b></h3>";
			}else{
				echo "<h3 class='w3-opacity'><b>This ride is no longer available</b></h3>";
			}
			echo "</div>";
		}else{
			$current_best = false;
			echo "
			
				<h2 class='w3-text-grey w3-padding-16'><i class='fa fa-line-chart fa-fw w3-margin-right w3-xxlarge w3-text-teal'></i></h2>
				<div class='w3-row-padding'>
					<div class='w3-twothird'>
			";
			if($bestBid){
				$current_best = $bestBid['client'] == $_SESSION['email'];
				echo "
						<h5 class='w3-xlarge'><g>Current price = </g><i class='w3-text-".($current_best?"green":"deep-orange")."'>".$bestBid['bid_price']."</i></h5>
						<hr>
						<h5 class='w3-large'>".($current_best?"<b class='w3-text-grey'>You are already offering the best bid </b>":"")."</h5>
				";
			}else{
				echo "<h5 class='w3-large'>There is no bid at the moment</h5>
					<h5 class='w3-xlarge'><g>Starting Price = </g><i class='w3-text-blue'>".$ride['price']."</i></h5>
					<hr>";
			} // Add the action here!!! And we need to define minbid
				
				if(!$bestBid) {    	// $ride instead of $row
					$minBid = $ride['price'];
				} else {
					$minBid = $bestBid['bid_price'] + 0.5;
				}

				echo " 
					<form class='w3-container' name='newBid' action='newBid.php' method='POST'>

					<input type='hidden' name='rideid' value=".$ride['rideid'].">
					<input type='hidden' name='min_bid' value=".$minBid.">

					<input type='hidden' type='text' name='returnPage' value='rideDetails.php'>

					<p><b class='w3-text-black'>Make an".($current_best?" new":"")." offer</b></p>
					<input class='w3-input' type='number' placeholder='Price' name='bid' step=0.5 min='".$minBid."' />
					<input class='w3-btn w3-teal' type='submit' value='New Bid'>
				  <br></form>
				  <br>
				"; //	<input class='w3-input' type='text' placeholder='Price'>	<button class='w3-bar w3-teal'>BID</button> 

			
			echo "</div><div class='w3-third'>
			<table class='w3-table w3-striped'>
			<tr>
			  <th>Last Bids</th>
			</tr>
			";
			while($bestBid){
				echo "
					<tr>
					  <td>".$bestBid['bid_price']."</td>
					</tr>
				
				";
				$bestBid = pg_fetch_assoc($bids);
			};
			echo"</table></div></div>";
				
			
		}	
		
		
		?>

        </div>
        
	</div>	
	
 </div>
</div>


<?php require("db_close.php");?>

	
</body>

</html>
