<?php

	require("db_connect.php");

	echo " email: ";
	echo $_POST["email"];

	echo " bid: ";
	echo $_POST["bid"];

	echo " rideid: ";
	echo $_POST["rideid"];


    $insert = "INSERT INTO bid VALUES('".$_POST["email"]."', '".$_POST["bid"]."', '".$_POST["rideid"]."') ";
    
    $insert_return = pg_query($con, $insert);
    if(!$insert_return){
		echo "Error: could not insert data.";
    }


    $update = "UPDATE ride SET price = '".$_POST["bid"]."' WHERE rideid = '".$_POST["rideid"]."'";

    $update_return = pg_query($con, $update);
    if(!$update_return){
		echo "Error: could not update data.";
    }


	require("db_close.php");
	require("ride.php");
?>
