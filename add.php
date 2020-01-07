<?php
	session_start();
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
    session_start();
    if(isset($_POST['cancel'])){
        echo "hello";
        header('Location: index.php');
        exit();
        return;
    }
		$link = mysqli_connect("localhost", "root", "", "test"); 
	  
	if($link === false){ 
	    die("ERROR: Could not connect. " 
	                . mysqli_connect_error()); 
	} 
	//echo $_POST['first_name'];
	$user_id = $_SESSION['user_id'];
	//echo $user_id;
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$headline = $_POST['headline'];
	$summary = $_POST['summary'];
/*    if(!isset($first_name) || (!isset($last_name)) || (!isset($email)) || (!isset($headline)) || (!isset($summary))){
        header('Location: index.php');
    }*/
	//echo "Email".($_POST['email']).'.';
	if($_POST['email'] != ''){
		$sql = "INSERT INTO profile (user_id,first_name, last_name, email,headline,summary) VALUES ('$user_id','$first_name', '$last_name', '$email','$headline','$summary')";
		if(mysqli_query($link, $sql)){
            $_SESSION['conformation'] = "Profile added";
	    echo "Records added successfully.";
		} else{
		    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
	mysqli_close($link);
	header('Location: index.php');
	}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Au Register Forms by Pankaj</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body style="background-image: url('http://getwallpapers.com/wallpaper/full/a/5/d/544750.jpg');">
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Add Registration Form</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="add.php">
                        <div>
                            <center><p id="message" style="color: red"></p></center> 
                        </div>
                        
                        <div class="form-row m-b-55">
                            <div class="name">Name</div>
                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" id="first_name" type="text" value="" name="first_name" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" id="last_name" type="text" value="" name="last_name" placeholder="Last Name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Email</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" id="email" type="email" value="" name="email" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Head Line</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" id="headline" type="text" name="headline" value="" placeholder="Head Line">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Summary</div>
                            <div class="value">
                                <div class="input-group">
  									<textarea class=""  id="summary" name="summary" style="width: 500px; height: 150px;"></textarea>
                                </div>
                            </div>
                        </div>
                        <div>
                            <input class="btn btn--radius-2 btn--red" onclick="return doValidate();" type="submit" name="add" value="Add"  style="width: 25%;">
                                &nbsp;  &nbsp;  &nbsp;  &nbsp;
                            <input class="btn btn--radius-2 btn--red" type="submit" name="cancel" value="Cancel" style="width: 25%;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->

<script>
    function doValidate() {
        console.log('Validating...');
        first_name = document.getElementById('first_name').value;
        console.log(first_name);
        try {
            first_name = document.getElementById('first_name').value;
            last_name = document.getElementById('last_name').value;
            email = document.getElementById('email').value;
            headline = document.getElementById('headline').value;
            summary = document.getElementById('summary').value;
            //summary.replace(/ /g, "");
/*            if(summary == "")
            {
                summary = "";
            }*/
            console.log(first_name);
            console.log("Summary:"+(summary));

            if (first_name == null || first_name == "" || last_name == null || last_name == "" || email == null || email == ""
                 || headline == null || headline == "" || summary == null || summary == "") {
                document.getElementById("message").innerHTML = "All values are required";
                //alert("All values are required");
                return false;
            }
            return true;
        } catch(e) {
            console.log('exception occured');
            return false;
        }
        return false;
    }
</script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->