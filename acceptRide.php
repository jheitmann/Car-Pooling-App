<?php

	require("db_connect.php");
	
	$query = "SELECT * FROM bid WHERE bid.rideid = ".$_POST["rideid"]." AND bid.bid_price >= 
				ALL(SELECT ride.price FROM ride WHERE ride.rideid = ".$_POST["rideid"].")";
	$ride = pg_query($con, $query);
	$row = pg_fetch_assoc($ride);
	
	$insert = "INSERT INTO complete_ride VALUES('".$row["client"]."', ".$row["bid_price"].", ".$row["rideid"].")";
    $insert_return = pg_query($con, $insert);

    if(!$insert_return){
		echo "Error: could not insert data.";
		echo "Have you filled in all information?";
		echo $insert;
    }
	require("db_close.php");
	
	require("offeredRides.php");
?>
