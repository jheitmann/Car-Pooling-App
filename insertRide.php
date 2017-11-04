<?php

	require("db_connect.php");
	
	$max = pg_query($con, "SELECT MAX(rideid) + 1 AS max_id FROM ride");
	$row = pg_fetch_assoc($max);
	$datetime = str_replace("/","-",$_POST["datetime"]);
	$datetime = $datetime.":00";
	$insert = "INSERT INTO ride VALUES('".$_POST["carid"]."', '".$datetime."', '".$_POST["origin"]."', '". $_POST["destination"]."', ".$_POST["min"].", ".$row["max_id"].")";
    $insert_return = pg_query($con, $insert);

    if(!$insert_return){
		echo "Error: could not insert data.";
		echo "Have you filled in all information?";
		require("db_close.php");
		
		require("offerRide.php");
    }
    else{
    	require("offeredRides.php");
    }
?>
