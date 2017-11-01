<?php require('header2.php'); ?>

<?php
    require("db_connect.php");
	$query = "DELETE FROM ride WHERE rideid = ".$_POST["rideid"].";";
    $result = pg_query($con, $query);
    require("db_close.php");        
    header("Location: admin_ride.php");
	exit;
?>
