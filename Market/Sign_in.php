<!--

   Author: fahad shaker

-->

<?php
 // Start the Session
 include ('test_session.php');
// Create connection
$conn = new mysqli('localhost', 'root', '', 'rescue_league_db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); }
?>

<?php



// Set variables
$invalid_user = "";
$req_email= "";
$req_pass = "";


// Submit the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {


  $email= $_POST['email'];
  $pass = $_POST['password'];

     // Match user input with the eamil on the database:
     $sql_user = "select *  from customers where Email = '$email' and pass ='$pass'";
     $sql_admin = "select *  from admin where admin_user = '$email' and admin_pass ='$pass'";

     // store sql query to result
     $result_user = $conn->query($sql_user);
     $result_admin = $conn->query($sql_admin);

    // store result to array and then make user row
    $row_user = mysqli_fetch_array($result_user);
    $row_admin = mysqli_fetch_array($result_admin);

    // Send error msg if email field is empty
    if (empty($_POST["email"])) {
        $req_email = "Email is Required *";
        }
    // Send error msg if password field is empty
       elseif (empty($_POST["password"])) {
         $req_pass = "Password is Required *"; }

    // login the admin and assign it to a session
       elseif ($row_admin['admin_user']  == $email && $row_admin['admin_pass'] == $pass) {
         $_SESSION['login_admin'] = $row_admin['admin_user'];
         $_SESSION['lgoin_admin_id'] = $row_admin['admin_id'];
         header('Location:index.php');
       }


    // login the user and assign it to a session
       elseif ($row_user['Email']  == $email && $row_user['pass'] == $pass) {
	       $_SESSION['login_user'] = $row_user['Email'];
	       $_SESSION['login_user_fname'] = $row_user['First_Name'];
	       $_SESSION['login_user_lname'] = $row_user['Last_Name'];
	       $_SESSION['login_user_phone'] = $row_user['Phone'];
	       $_SESSION['lgoin_user_id'] = $row_user['C_id'];
	       header('Location:index.php'); }

            else {
              $invalid_user = "Email/Password is incorrect *"; }

}
?>


<!DOCTYPE html>
<html>
<head>

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
        <h3>Sign In</h3>
      </div>


    	<div class="card-body">
				<form method="POST" >
          <span class="error"> <?php echo $invalid_user; ?> </span>
          <span class="error"> <?php echo $req_email; ?> </span>
          <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-at"></i></span>
						</div>
						<input type="email" name="email" class="form-control" placeholder="Email">
					</div>


          <span class="error"> <?php echo $req_pass; ?></span>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password" id="password" class="form-control" placeholder="Password">
					</div>
          <input type="checkbox" id="checkbox"  onclick="myFunction()"> <label for="checkbox"> Show Password </label>


					<div class="form-group">
						<input type="submit" name="submit" value="Login in" class="btn float-right" id="login_btn">
					</div>
				</form>
			</div>

      <div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="Sign_up.php">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center links">
					<a href="#">Forgot your password?</a>
				</div>
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
