<?php 
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
		$profile_id = $_REQUEST['profile_id'];
		$link = mysqli_connect("localhost", "root", "", "test"); 
	  
		if($link === false){ 
		    die("ERROR: Could not connect. " 
		                . mysqli_connect_error()); 
		} 

		$sql = "SELECT * FROM profile WHERE profile_id= ".$profile_id;
		$res = mysqli_query($link, $sql);
		$row = mysqli_fetch_array($res);
		mysqli_close($link);
?>



<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>View Page</title>
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
	<h2><center>Profile information</center></h2>
	<div class="d-flex justify-content-center h-100">
		<?php
			echo "First Name: ".$row['first_name'];
			echo "<br>";
			echo "<br>";
			echo "Last Name: ".$row['last_name'];
			echo "<br>";
			echo "<br>";
			echo "Email: ".$row['email'];
			echo "<br>";
			echo "<br>";
			echo "Headline: ".$row['headline'];
			echo "<br>";
			echo "<br>";
			echo "Summary: ".$row['summary'];
			echo "<br>";
			echo "<br>";
		 ?>
		 <div>
		 	<p style="position: absolute;bottom: 275px;left: 550px;"><a href="index.php"> Done</a></p>
		 </div>
		 
	</div>
</div>
</p>
</div>
</body>
</html>
