<?php
	session_start();
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	$link = mysqli_connect("localhost", "root", "", "test"); 
  
	if($link === false){ 
    die("ERROR: Could not connect. " 
                . mysqli_connect_error()); 
  
	} 
	$sql = "SELECT * FROM profile";
	$res = mysqli_query($link, $sql);

 ?>
<!DOCTYPE html>
<html>
<head>
<title>Pankaj Mallik's Resume Registry</title>
<!-- bootstrap.php - this is HTML -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" 
    crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" 
    integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" 
    crossorigin="anonymous">

</head>
<body style="background-color: blanchedalmond;">
<div class="container">
<h2><center>Pankaj Mallik's Resume Registry</center></h2>
<input type="hidden" id="custId" name="custId" value="1">
<p><a href="login.php"> <?php if(!isset($_SESSION['name'])) 
{
	echo "Please log in";
}?></a></p>
<p><a href="logout.php">
<?php if(isset($_SESSION['name']))
	echo "log out";
?></a></p>
<table class="table" border="1">
<thead>
	<tr>
		<th><center>Name</center></th>
		<th><center>Headline</center></th>
		<?php if(isset($_SESSION['name'])) 
		echo '<th><center>Action</center></th>';
		?>
	</tr>
</thead>
<?php
foreach ($res as $key => $row) {
//echo $row['first_name']; 
?>
<tbody>
	<tr>
		<td>
			<a href="view.php?profile_id=<?php echo $row["profile_id"]; ?>"><center><?php echo $row['first_name'].' '.$row['last_name'];?></center></a>
		</td>
		<td>
			<center><?php echo $row['headline'];?></center>
		</td>
		<?php if(isset($_SESSION['name'])){?>
		<td><center>
			<a href="edit.php?profile_id=<?php echo $row["profile_id"]; ?>">Edit</a>
			<a href="delete.php?profile_id=<?php echo $row["profile_id"]; ?>">Delete</a>
			</center>
		</td>
				<?php 
			}
		?>
	</tr>
</tbody>
<?php
}
 ?>
</table>
<a href="add.php"><?php if(isset($_SESSION['name']))
	echo "Add New Entry";
?></a>
</div>
</body>