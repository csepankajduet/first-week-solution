<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	$profile_id = $_REQUEST['profile_id'];
	$link = mysqli_connect("localhost", "root", "", "test"); 
	  
	if($link === false){ 
	    die("ERROR: Could not connect. " 
	                . mysqli_connect_error()); 
	} 
	// sql to delete a record
	$sql = "DELETE FROM profile WHERE profile_id='$profile_id'";
	//echo $sql;
	if ($link->query($sql) === TRUE) {
	    echo "Record deleted successfully";
	} else {
	    echo "Error deleting record: " . $link->error;
	}
	header('Location: index.php');
?>	