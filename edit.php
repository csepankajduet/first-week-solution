<?php
    require_once 'util.php';
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
	$custId=$_REQUEST['custId'];
	//echo 'hello'.$profile_id;
	//echo $custId;
	$link = mysqli_connect("localhost", "root", "", "test"); 
	  
	if($link === false){ 
	    die("ERROR: Could not connect. " 
	                . mysqli_connect_error()); 
	} 
	$check = $profile_id;
	$email = ($_POST["email"]);
	if(isset($_REQUEST['profile_id']))
	{
		$sql = "SELECT * FROM profile WHERE profile_id= ".$profile_id;
        $sql2 = "SELECT * FROM position WHERE profile_id= ".$profile_id;
		$res = mysqli_query($link, $sql);
        //$res2 = mysqli_query($link, $sql2);
		$row = mysqli_fetch_array($res);
        $query2 = mysqli_query($link, $sql2 );  
        //$row2 = mysqli_fetch_array($res2);
        //echo $row2;
        $positions = array();
        while ($row2 = mysqli_fetch_array($query2)) {
            $positions[] = $row2;
        }
        print_r($positions);
		$_SESSION['email'] = $row['email'];
		//echo $_SESSION['email'];
		$_REQUEST['profile_id'] = '';
		mysqli_close($link);
	}
	else
	{
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$headline = $_POST['headline'];
			$summary = $_POST['summary'];
			$idn = $_SESSION['profile_id'];

            $sql = "DELETE FROM position WHERE profile_id='$profile_id'";
            if ($link->query($sql) === TRUE) {
                $_SESSION['conformation_delete'] = "Profile deleted";
                echo "Record deleted successfully";
            } else {
                echo "Error deleting record: " . $link->error;
            }
            $rank = 1;
            for($i=1; $i<=9; $i++) {
              if ( ! isset($_POST['year'.$i]) ) continue;
              if ( ! isset($_POST['desc'.$i]) ) continue;
              $year = $_POST['year'.$i];
              $desc = $_POST['desc'.$i];
              $stmt = "INSERT INTO position (profile_id, rank, year, description) VALUES ('$profile_id', '$rank', '$year', '$desc')";
              mysqli_query($link, $stmt);
              $rank++;
            }
			$sql = "UPDATE profile SET first_name='$first_name',last_name='$last_name',email='$email',headline='$headline',summary='$summary' WHERE profile_id='$profile_id'";
			$_SESSION['edit'] = "Profile updated";
			echo $sql;
			if (mysqli_query($link, $sql)) {
			    echo "Record updated successfully";
			} else {
			    echo "Error updating record: " . mysqli_error($link);
			}

			mysqli_close($link);
			header('Location: index.php');
/*	}*/
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
                    <h2 class="title">Edit Registration Form</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="edit.php?prof_id=<?php echo $profile_id; ?>">
                    	<div>
                    		<p id="message" style="color: red;"></p>
                    	</div>
                        <div class="form-row m-b-55">
                            <div class="name">Name</div>
                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" value="<?php echo $row['first_name'];?>" name="first_name" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" value="<?php echo $row['last_name'];?>" name="last_name" placeholder="Last Name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Email</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" id="email" value="<?php echo $row['email'];?>" name="email" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Head Line</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="headline" value="<?php echo $row['headline'];?>" placeholder="Head Line">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Summary</div>
                            <div class="value">
                                <div class="input-group">
  									<textarea class="input--style-5" rows="3" id="summary" name="summary" style="width: 500px; height: 150px;">
  										<?php echo $row['summary'];?>
  									</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Position</div>
                            <div class="value">
                                <div class="">
                                    <input style="width: 6%;border: none;height: 33px;font-size: 24px;" id="addPos" type="submit" name="addPos" value="+">
                                </div>
                            </div>
                        </div>


                        <?php 
                            $pos = 0;
                            foreach ($positions as $key => $position) {
                                $pos++;

                                echo ('<div class="input--style-5" id="position'.$pos.'">'."\n");
                                echo ('<p> Year: <input style="width: 130px" type="text" name="year'.$pos.'"');
                                echo ('value="'.$position['year'].'"/>'."\n");
                                echo ('<input style="width: 7%;border: none;height: 22px;font-size: 16px;" type="button"');
                                echo ('value="-" \ onclick="$(\'#position'.$pos.'\').remove();return false;"/>'."\n");
                                echo('</p> '."\n");
                                echo ('<textarea name="desc'.$pos.'" rows="8" cols="80">'."\n");
                                echo (htmlentities($position['description']))."\n";
                                echo('</textarea>'."\n");
                                echo ('</div>'."\n");
                            }
                        ?>
                        <div class="form-row" id="position_fields">
                            
                        </div>
                        <div>
                            <input onclick="return doValidate();" class="btn btn--radius-2 btn--red" type="submit" name="save" value="Save" style="width: 25%;">
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
   
    <script type="text/javascript">
        $(document).ready(function() {
            //countPos = 0;
            countPos = "<?php echo $pos ?>";
            console.log('Document Ready Called');
            $('#addPos').click(function(event) {
                event.preventDefault();
                if(countPos >= 9)
                {
                    alert("Maximum of nine position entries exceeded");
                    return;
                }
                countPos++;
                $('#position_fields').append(
                    '<div class="input--style-5" id="position'+countPos+'"> \
                    <p> Year: <input style="width: 130px" type="text" name="year'+countPos+'" value=""/> \
                <input style="width: 7%;border: none;height: 22px;font-size: 16px;" type="button" value="-" \ onclick="$(\'#position'+countPos+'\').remove();return false;"/> \
                     </p> \
                    <textarea name="desc'+countPos+'" rows="8" cols="80"></textarea> \
                    </div>'
                    );
            });
        });
    function doValidate() {
        console.log('Validating...');
        //var email = document.getElementById('email').value;
        //console.log(email);
        try {
            email = document.getElementById('email').value;
			if(email.includes("@"))
			{
				//document.form.message.focus();
				return true;
			}
			else
			{
				document.getElementById("message").innerHTML = "Email address must contain @";
				return false;
			}

            /*if (first_name == null || first_name == "" || last_name == null || last_name == "" || email == null || email == ""
                 || headline == null || headline == "" || summary == null || summary == "") {
                document.getElementById("message").innerHTML = "All values are required";
                //alert("All values are required");
                return false;
            }*/
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