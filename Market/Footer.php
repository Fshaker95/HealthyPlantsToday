<?php
// Create connection
$conn = new mysqli('localhost', 'root', '', 'rescue_league_db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); }
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
$req_name = "";
$req_email = "";
$req_msg = "";

    if (isset($_POST['send_msg'])) {
      if (empty($_POST['footer_name'])){
        $req_name = "Required Name *";
        $Formvaild = False;  }

        else {
        $name = test_input($_POST['footer_name']);
        }

        if (empty($_POST['footer_email'])){
          $req_email = "Required Email *";
          $Formvaild = False;  }

          else {
          $email = test_input($_POST['footer_email']);
          }



          if (empty($_POST['footer_message'])){
            $req_msg = "Required Meaasge *";
            $Formvaild = False;  }

            else {
              $message = test_input($_POST['footer_message']);
              // Get the values into Variables
              @$user_id = $_SESSION['lgoin_user_id'] ; }


              if($Formvaild) {
                // Query the Database to fetch the results
                $sql = "INSERT INTO  customers_messages (name, email, message, customers_id)
                VALUES ('$name','$email','$message','$user_id ')";
                $result = $conn->query($sql);
                echo "<script> alert('Your Message has been Sent') </script>";
              }

            }

?>


<style>


.page-footer  {
	margin-top: 150px;
	background:-webkit-radial-gradient(center, ellipse cover, #33b5e5, #0099CC);
	border-top: 2px solid #33b5e5 ;
	transition: all .50s;
}

.card-header {
	color: white;

}

.page-footer:hover   {
	border-top: 1.8px solid red;
	transition: all .50s;
}

#input_box {
	background-color:rgba(0, 0, 0, 0);
	border-bottom: 2px solid white;
	border-top: none;
	border-left: none;
	transition: all .25s ease .25s;
}

#input_box:focus {
    height:50px;
    font-size:16px;
		border: 1px solid white;
		transition: all .25s ease .25s;
		color: white;

}

.links_module {
	text-align: center;
	margin-top: 70px;
	padding-left: 200px;
	color: white;
}


.error {
  color: red;
}
</style>



      <!-- Footer -->
<footer class="page-footer">

 <!-- Footer Elements container -->
  <div class="container-fluid">

          <h3 class="card-header">Tell Us Something...</h3>

        <!--Grid row-->
        <div class="row">

             <!--Grid column 1 -->
             <div class="col-md">
                 <!-- column 1 contents -->
                <div class="links_module">

                    <!-- Contact phone -->
                      <div class="input-group form-group">
                        <span class="input-group-text" style="background:#33b5e5;"><i class="fas fa-phone "></i></span> &nbsp;
                        <h3>  +1 202-456-2113 </h3>
                      </div>

                      <br />

                      <!-- Contact Email -->
                      <div class="input-group form-group">
                      <span class="input-group-text" style="background:#33b5e5;"><i class="fas fa-at "></i></span> &nbsp;
                        <h3>  HealthyPlantsToday@hotmail.com </h3>
                     </div>


                </div>
            </div>



          <!--Grid column 2-->
          <div class="col-md">
            <!-- Form -->
              <div class="card-body">
                <form method="POST" >

                    <span class="error"> <?php echo $req_name; ?></span>
                    <div class="input-group form-group">
                       <input type="name" name="footer_name" class="form-control" value="<?php echo  $user_check_fname ?>"  id="input_box">
                       <span class="input-group-text" style="background:#33b5e5;"><i class="fas fa-user "></i></span>
                    </div>

                   <span class="error"> <?php echo $req_email; ?></span>
                   <div class="input-group form-group">
                     <input type="email" name="footer_email" class="form-control" value="<?php echo  $user_check ?>" id="input_box" <i class="fas fa-at"></i>
                     <span class="input-group-text" style="background:#33b5e5;"><i class="fas fa-at "></i></span>
                   </div>


                   <span class="error"> <?php echo $req_msg; ?></span>
                   <div class="input-group form-group">
                     <input type="name" name="footer_message" class="form-control" placeholder="Your Message" id="input_box">
                     <span class="input-group-text" style="background:#33b5e5;"><i class="fas fa-envelope"></i></span>
                   </div>



                  <div class="form-group">
                     <input type="submit" name="send_msg" value="Send Message" class="btn float-right btn-danger">
                  </div>
               </form>
            </div>
         </div>

    </div>
  </div>

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">
    <a href="https://mdbootstrap.com/education/bootstrap/" style="color:white;"> © 2019 HeathyPlantsToday:</a>
  </div>
  <!-- Copyright -->
</footer>
