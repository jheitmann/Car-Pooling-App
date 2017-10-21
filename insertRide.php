<?php

	require("db_connect.php");
	$insert = "INSERT INTO ride VALUES('".$_POST["carid"]."', '".$_POST["datetime"]."', '".$_POST["origin"]."', '".
                  $_POST["destination"]."', ".$_POST["min"].".00, 'ride300')";
    $insert_return = pg_query($con, $insert);
    if(!$insert_return){
		echo "Error: could not insert data.";
    }
	require("db_close.php");
	
	require("offerRide.php");
?>
	
	
