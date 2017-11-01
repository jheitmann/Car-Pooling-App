<?php
  session_start();
  if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit;
  }


	require("db_connect.php");
	
	$query = "SELECT * FROM bid WHERE rideid = ".$_POST["rideid"];
	$bids = pg_query($con, $query);
		
	if(pg_num_rows($bids) == 0) {
		$minBid = $row['price'];
	} else {
		$minBid = $row['price'] + 0.5;
	}

	if($minBid <= $_POST["bid"]){
		$checkBid = "SELECT * FROM bid WHERE client='".$_SESSION['email']."' AND rideid=".$_POST["rideid"];
		$check = pg_query($con,$checkBid);
		
		if(!pg_fetch_assoc($check)){
			$insertBid = "INSERT INTO bid VALUES('".$_SESSION['email']."', ".$_POST["bid"].", ".$_POST["rideid"].") ";

			$insert_return = pg_query($con, $insertBid);
		    if(!$insert_return){
				echo $insertBid;
				echo "Error: could not insert Bid.";
	    	}	
	    } else {
	    	$updateBid = "UPDATE bid SET bid_price = '".$_POST["bid"]."' WHERE client='".$_SESSION['email']."' AND rideid = '".$_POST["rideid"]."'";

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
		#require("ride.php");
		require($_POST["returnPage"]);
	}
?>
 
