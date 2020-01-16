<?php // line 1 added to trigger color syntax highlight

function validatePos(){
  for($i=1; $i<=9; $i++) {
    if ( ! isset($_POST['year'.$i]) ) continue;
    if ( ! isset($_POST['desc'.$i]) ) continue;

    $year = $_POST['year'.$i];
    $desc = $_POST['desc'.$i];

    if ( strlen($year) == 0 || strlen($desc) == 0 ) {
      return "All fields are required";
    }

    if ( ! is_numeric($year) ) {
      return "Position year must be numeric";
    }
  }
  return true;
}

function validateProfile(){
  if( (strlen($_POST['first_name']) == 0) || (strlen($_POST['last_name']) == 0) || (strlen($_POST['email']) == 0) || (strlen($_POST['headline']) == 0) || (strlen($_POST['summary']) == 0)){
    return "All fields are required";
  }
    if(strpos($_POST['email'], '@') === false){
      return "Email Address must contain @";
    }
  return true;
}
