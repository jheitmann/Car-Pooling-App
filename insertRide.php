<?php

	require("db_connect.php");
	
	$max = pg_query("SELECT MAX(rideid) + 1 AS max_id FROM ride");
	$row = pg_fetch_assoc($max);
	
	$insert = "INSERT INTO ride VALUES('".$_POST["carid"]."', '".$_POST["date"]." ".$_POST["hour"].":".$_POST["minute"].":00"."', 
				'".$_POST["origin"]."', '". $_POST["destination"]."', ".$_POST["min"].".00, ".$row["max_id"].")";
    $insert_return = pg_query($con, $insert);

    if(!$insert_return){
		echo "Error: could not insert data.";
		echo "Have you filled in all information?";
    }
	require("db_close.php");
	
	require("offerRide.php");
?>
