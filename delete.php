<?php 
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	if(isset($_POST['cancel'])){
		header('Location: index.php');
		exit();
		return;
	}
	if($_REQUEST['profile_id'] != '')
	{
		$_SESSION['profile_id']=$_REQUEST['profile_id'];
		$profile_id = $_REQUEST['profile_id'];
	}
	else{
		$counter = 1;
		$profile_id = $_REQUEST['prof_id'];
		//echo "Profile Id :".$profile_id;
	}
	$link = mysqli_connect("localhost", "root", "", "test"); 
  
	if($link === false){ 
	    die("ERROR: Could not connect. " 
	                . mysqli_connect_error()); 
	} 
	if(isset($_REQUEST['profile_id']))
	{
		$emailErr = "";
		$sql = "SELECT * FROM profile WHERE profile_id= ".$profile_id;
		$res = mysqli_query($link, $sql);
		$row = mysqli_fetch_array($res);
		$_SESSION['email'] = $row['email'];
		$_REQUEST['profile_id'] = '';
		mysqli_close($link);
	}
	else{

		$sql = "DELETE FROM profile WHERE profile_id='$profile_id'";
		if ($link->query($sql) === TRUE) {
			$_SESSION['conformation_delete'] = "Profile deleted";
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $link->error;
		}
		header('Location: index.php');

	}
?>



<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Delete Page</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body  style="background-image: none;">
<div class="container">
	<h2><center>Deleteing Profile</center></h2>
	<form method="POST" action="delete.php?prof_id=<?php echo $profile_id; ?>">
		
		<div class="card-body">
		<div class="">
			<?php
				echo "First Name: ".$row['first_name'];
				echo "<br>";
				echo "<br>";
				echo "Last Name: ".$row['last_name'];
				echo "<br>";
				echo "<br>";
			 ?>
			 
		</div>
		<div>
            <button class="btn" type="submit" style="float: left;">Delete</button>
            &nbsp;&nbsp;
            <button class="btn" type="submit" name="cancel">Cancel</button>
        </div>
    </div>
	</form>
</div>
</p>
</div>
</body>
</html>
