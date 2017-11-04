<?php
    session_start();
    if(!isset($_SESSION['email'])){
	  header("Location: login.php");
	  exit;
    }

	require("db_connect.php");
	
	$query = "SELECT price, bid_price FROM ride_price WHERE rideid = ".$_POST["rideid"];
	$result = pg_query($con, $query);
		
	if(pg_num_rows($result) == 0) {
		echo "Error: rideid not valid.";
	} else {
		$ride_price = pg_fetch_assoc($result);
		if(is_null($ride_price['bid_price'])) {
			if($_POST["bid"] >= $ride_price['price']) {
				$insertBid = "INSERT INTO bid VALUES('".$_SESSION['email']."', ".$_POST["bid"].", ".$_POST["rideid"].") ";

				$insert_return = pg_query($con, $insertBid);
				if(!$insert_return){
					echo $insertBid;
					echo "Error: could not insert Bid.";
				}
			} 
		} else {
			$query = "SELECT * FROM bid WHERE rideid = ".$_POST["rideid"]." AND client = '".$_SESSION['email']."'";
			$result = pg_query($con, $query);
			if($_POST["bid"] > $ride_price['bid_price']) {
				if(pg_num_rows($result) == 0) {
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
			}
		}
	}

	require("db_close.php");
	require($_POST["returnPage"]);
?>
 
