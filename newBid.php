<?php

	require("db_connect.php");

	$checkBid = "SELECT * FROM bid WHERE client = '".$_POST["email"]."' AND rideid ='".$_POST["rideid"]."'";

	if(!pg_fetch_assoc($checkBid)){
		$insertBid = "INSERT INTO bid VALUES('".$_POST["email"]."', '".$_POST["bid"]."', '".$_POST["rideid"]."') ";

		$insert_return = pg_query($con, $insertBid);
	    if(!$insert_return){
			echo "Error: could not insert Bid.";
    	}	
    } else {
    	$updateBid = "UPDATE bid SET bid_price = '".$_POST["bid"]."' WHERE rideid = '".$_POST["rideid"]."'";

	    $update_return = pg_query($con, $updateBid);
	    if(!$update_return){
			echo "Error: could not update Bid.";
	    }
    }
/*
    $update = "UPDATE ride SET price = '".$_POST["bid"]."' WHERE rideid = '".$_POST["rideid"]."'";

    $update_return = pg_query($con, $update);
    if(!$update_return){
		echo "Error: could not update data.";
    }*/

	require("db_close.php");
	require("ride.php");
?>
