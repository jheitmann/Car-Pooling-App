<?php require('header2.php');?>
<?php

	require("db_connect.php");
	
	if(isset($_POST[add])){
	
		$insert = "INSERT INTO complete_ride VALUES(".$_POST["rideid"].", '".$_POST["client"]."')";
		$insert_return = pg_query($con, $insert);
	}elseif(isset($_POST[remove])){
		$delete = "DELETE FROM complete_ride WHERE client = '".$_POST["client"]."' AND rideid = '".$_POST["rideid"]."';";
		$query = pg_query($con, $delete);
	}

	require("db_close.php");
	
	header("Location: admin_ride.php");
?>
