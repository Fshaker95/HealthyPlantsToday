<!--
   Author: Fahad Shaker
-->

<?php

// Create connection
$conn = new mysqli('localhost', 'root', '', 'rescue_league_db');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); }

    // call custumer table for input check:
    $sql_check = "SELECT  * FROM customers";
    $result_check = $conn-> query($sql_check);
    $row_check = $result_check-> fetch_assoc();
?>

<?php

// Clean user input:
Function test_input($data) {
  // removes whitespace
  $data = trim($data);
  // removes backslashes
  $data = stripslashes($data);
  //
  $data = htmlspecialchars($data);
  return $data;
}

// Set Form vaildtation to true if any fields are empty it switch to false:
$Formvaild = True;
// Set error msg variables
$req_fields = "";
$req_fname = "";
$req_lname = "";
$req_email = "";
$req_phone = "";
$req_pass = "";
$req_confirm_pass = "";


// Submit the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["fname"])) {
    $req_fname = "First name is required *";
    $Formvaild = False; }
  else {
      $fname = test_input($_POST["fname"]);
       }


  if (empty($_POST["lname"])) {
    $req_lname = "Last name is required *";
    $Formvaild = False; }
  else {
      $lname = test_input($_POST["lname"]);
       }

  if (empty($_POST["email"])) {
    $req_email = "Email is required *";
      $Formvaild = False;
  }
  else {
      $email = test_input($_POST["email"]);
       }


  if (empty($_POST["phone"])) {
    $req_phone = "Phone Number is required *";
    $Formvaild = False;}
  else {
      $phone = test_input($_POST["phone"]);
       }



  if (empty($_POST["password"])) {
    $req_pass = "Password is required *";
    $Formvaild = False;}
  else {
      $pass = test_input($_POST["password"]);   }



// If no fields are empty then $Formvaild is True and the form will submit to the database:
  if ($Formvaild) {

    // Check if Eamil is already exists in the database:
    if ($_POST["email"] == $row_check["Email"]) {
            echo '<script>alert("Eamil Already Exists!")</script>';
}

   else {
     $sql = "INSERT INTO  customers (First_Name, Last_Name, Email, Phone, Pass) values('$fname','$lname', '$email', '$phone', '$pass')";
     $result = $conn->query($sql);
     echo '<script>alert("Registeration Successful")</script>';
     echo "<script>setTimeout(\"location.href = 'Market.php';\",500);
     </script>";
 }
}

}


?>
<!DOCTYPE html>
<html>
<head>
	<!-- Title -->
	<title> Rescue league </title>
  <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- CSS File -->

    <link  rel="stylesheet" href="CSS/Sign_in_up.css" type="text/css" />
    <!--Bootsrap 4 CDN-->
    <link  rel="stylesheet" href="CSS/bootstrap.min.css" type="text/css" />

        <!--Fontawesome CDN-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  </head>



<style>
.error {
  color: red;
}

label {
  color: white;
}
</style>




<body class="body">
  <div class="container">
	<div class="d-flex justify-content-center h-200 ">
		<div class="card">

      <div class="card-header">
				<h3>Sign Up</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>

    	<div class="card-body">
				<form method="POST">


          <span class="error"> <?php echo $req_fields; ?> </span> <br>
          <span class="error"> <?php echo $req_fname; ?> </span>
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" name="fname" class="form-control" placeholder="First Name">
          </div>



          <span class="error"> <?php echo $req_lname; ?> </span>
          <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name="lname" class="form-control" placeholder="Last Name">
					</div>



          <span class="error"> <?php echo $req_email; ?> </span>
          <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-at"></i></span>
						</div>
						<input type="email" name="email" class="form-control" placeholder="Email">
					</div>


          <span class="error"> <?php echo $req_phone; ?> </span>
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-phone"></i></span>
            </div>
            <input type="phone" name="phone" class="form-control" placeholder="Phone Number">
          </div>


          <span class="error"> <?php echo $req_pass; ?> </span>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password" id="password" class="form-control" placeholder="Password">
					</div>
          <input type="checkbox" id="checkbox"  onclick="myFunction()"> <label for="checkbox"> Show Password </label>



					<div class="form-group">
						<input type="submit" name="submit" value="Register" class="btn float-right" id="login_btn">
					</div>
				</form>
			</div>


		</div>
	</div>
</div>

<script>
function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
          }
        }

</script>

</body>
</html>
