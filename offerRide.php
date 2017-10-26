<?php
  session_start();
  if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit;
  }
  ?>


<?php require('header.html'); ?>

<!-- Bootstrap Date-Picker Plugin -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/jquery.datetimepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>
<?php
    require("db_connect.php");
    echo "<p></p>";

	$cars = pg_query($con, "SELECT car.model, car.carid FROM car WHERE car.owner = '" . $_SESSION['email'] . "'");
	if (pg_num_rows($cars) == 0) {

		?>
		<section>
			<svg width='1000' height='100'>
				<rect x='20' y='20' rx='20' ry='20' width='900' height='80'
				  style='fill:gray;stroke:black;stroke-width:5;opacity:0.5' />
				<text x='60' y='70' font-family='Verdana' font-size='30' fill='blue'> You need to add a car to your profile first. </text>
				Sorry, your browser does not support inline SVG.
			</svg>
		</section>

		<?php
	}
	else{
		?>
		<div class="container">
			<form class="form-horizontal" method="POST" action="insertRide.php">
				<div class="form-group">
				  <label for="carid">Car:</label>
				  <select class="form-control" id="carid" name="carid">
				    <!-- <option>Select...</option> -->
				    <?php
				    	while($choices = pg_fetch_assoc($cars)) { 
							echo "<option value='".$choices['carid']."' ";
							echo">".$choices['model'].", ".$choices['carid']."</option>";
						}
				    ?>
				  </select>
				</div>
				<div class="form-group">
				  <label for="origin">Origin:</label>
				  <input name="origin" type="text" class="form-control" id="origin" value="Kent Ridge" required>
				</div>
				<div class="form-group">
				  <label for="destination">Destination:</label>
				  <input name="destination" type="text" class="form-control" id="destination" value="Marina Bay" required>
				</div>
				<div class="form-group">
				  <label for="min">Minimum Price:</label>
				  <input name = "min" type="number" class="form-control" id="min" value="0" step = "1" min = "1" required>
				</div>
				<div class="form-group">
				  <label for="datetime">Date & Time:</label>
				  <input name = "datetime" type="text" class="form-control" id="datetimepicker" required>
				</div>
				<div class="form-group"> 
				  <div class="col-sm-offset-2 col-sm-10">
				    <button type="submit" class="btn btn-default">Submit</button>
				  </div>
				</div>
			</form>	
		</div>
<?php
	}
	require("db_close.php");
?>
<script>
      $(document).ready(function() {
          $.datetimepicker.setLocale('EN');
        $('#datetimepicker').datetimepicker();
      });
</script>
</body>
</html>
