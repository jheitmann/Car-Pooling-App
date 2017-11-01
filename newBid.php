<?php

	require("db_connect.php");

	# If statement protecting from change if the current price in the databse is higher than the new bid "bid"

	

	$bidHackProtection = "SELECT * FROM bid WHERE rideid='".$_POST["rideid"]."' AND price > ".$_POST["bid"];
	$hackCheck = pg_query($con,$bidHackProtection);

	# Make it so that the first bid can be equal to the "min Prize"

	if(!pg_fetch_assoc($hackCheck)){
		$checkBid = "SELECT * FROM bid WHERE client='".$_POST["email"]."' AND rideid=".$_POST["rideid"];
		$check = pg_query($con,$checkBid);
		
		if(!pg_fetch_assoc($check)){
			$insertBid = "INSERT INTO bid VALUES('".$_POST["email"]."', ".$_POST["bid"].", ".$_POST["rideid"].") ";

			$insert_return = pg_query($con, $insertBid);
		    if(!$insert_return){
				echo "Error: could not insert Bid.";
	    	}	
	    } else {
	    	$updateBid = "UPDATE bid SET bid_price = '".$_POST["bid"]."' WHERE client='".$_POST["email"]."' AND rideid = '".$_POST["rideid"]."'";

		    $update_return = pg_query($con, $updateBid);
		    if(!$update_return){
				echo "Error: could not update Bid.";
		    }
	    }

	    $update = "UPDATE ride SET price = '".$_POST["bid"]."' WHERE rideid = '".$_POST["rideid"]."'";

	    $update_return = pg_query($con, $update);
	    if(!$update_return){
			echo "Error: could not update data.";
	    }

		require("db_close.php");
		require("ride.php");
	}
?>
