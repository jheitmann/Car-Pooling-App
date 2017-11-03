<?php require('header2.php'); ?>

<?php
	if(!empty($_GET)){
	    require("db_connect.php");
		$query = "DELETE FROM car WHERE carid = '".$_GET["carid"]."';";
	    $result = pg_query($con, $query);
	    require("db_close.php");        
		header("Location: admin_car.php");
		exit;
	}
?>
