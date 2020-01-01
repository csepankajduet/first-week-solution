<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	//include 'pdo.php';
	session_start();
	unset($_SESSION['name']);
	unset($_SESSION['user_id']);
	if(isset($_POST['cancel'])){
		header('Location: index.php');
		return;
	}
	$salt = 'XxZzy12*_';
	if(isset($_POST['email']) && isset($_POST['password'])){
		if (strlen($_POST['email']) < 1 || strlen($_POST['password']) < 1) {
			$_SESSION['error'] = "Email or Password is required";
			header('Location: login1.php');
		}
	}
	$email = $_POST['email'];
	$check = hash('md5', $salt.$_POST['password']);
	$link = mysqli_connect("localhost", "root", "", "test"); 
	  
	if($link === false){ 
	    die("ERROR: Could not connect. " 
	                . mysqli_connect_error()); 
	} 
	  
	$sql = "SELECT * FROM users WHERE email= '".$email;
	$sql .= "' AND password='".$check;
	$sql .= "'";
	$res = mysqli_query($link, $sql);
	//echo $sql;
	$row = mysqli_fetch_array($res);
	$name = $row['name'];
	$_SESSION['name'] = $name;
	$_SESSION['user_id'] = $row['user_id'];
	//echo $_SESSION['name'].$_SESSION['user_id'];
	if($email === $row['email'] && $check === $row['password']){
		header('Location: index.php');
	}
	
	mysqli_close($link);
?>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
				<form method="POST" action="login1.php"> 
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" id="email" name="email" class="form-control" placeholder="email">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" id="password" name="password" class="form-control" placeholder="password">
					</div>
					<div class="row align-items-center remember">
						<input type="checkbox">Remember Me
					</div>
					<div class="form-group align-items-center">
						<input style="position: absolute; bottom: 100px;" type="submit" name="cancel" value="Cancel" class="btn float-right login_btn">
					</div>
					
					<div class="form-group">
						<input type="submit" onclick="return doValidate();" value="Log In" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="#">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="#">Forgot your password?</a>
				</div>
			</div>
		</div>
	</div>
</div>
</p>
<script>
function doValidate() {
    console.log('Validating...');
    try {
        emailAddr = document.getElementById('email').value;
        password = document.getElementById('password').value;
        console.log(emailAddr);
        console.log(password);
        console.log("Validating emailAddr="+emailAddr+" password="+password);
        if (emailAddr == null || emailAddr == "" || password == null || password == "") {
            alert("Both fields must be filled out");
            return false;
        }
        if ( emailAddr.indexOf('@') == -1 ) {
            alert("Invalid email address");
            return false;
        }
        return true;
    } catch(e) {
        return false;
    }
    return false;
}
</script>

</div>
</body>
</html>
