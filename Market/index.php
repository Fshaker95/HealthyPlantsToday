<!--
   Author: Fahad Shaker
-->
<?php
// Include File
include ('test_session.php');

// Set variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rescue_league_db";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




if (isset($_POST['add_to_cart'])) {
 if (isset($user_check)) {

   if (isset($_SESSION['shopping_cart'])) {
     // Assign item id to:
     $item_array_id = array_column ($_SESSION['shopping_cart'], "item_id");
     // Search for the item in an array:
    if (!in_array($_GET['id'], $item_array_id)) {
      // Count how many item in cart:
      $count = count($_SESSION['shopping_cart']);
      // Add to the cart if the item has not been added aready:
       $item_array = array (
         'item_id'   => $_GET['id'],
         'item_name'   => $_POST['hidden_name'],
         'item_price'   => $_POST['hidden_price'],
         'item_qty'   => $_POST['quantity'],
         'item_pic'   => $_POST['hidden_pic']
       );
       $_SESSION['shopping_cart'][$count] = $item_array;
     }

     // Do something else if the item exists
     else {
       // Count how many item in cart:
       $count = count($_SESSION['shopping_cart']);
       // Add to the cart if the item has not been added aready:
        $item_array = array (
          'item_id'   => $_GET['id'],
          'item_name'   => $_POST['hidden_name'],
          'item_price'   => $_POST['hidden_price'],
          'item_qty'   => $_POST['quantity'],
          'item_pic'   => $_POST['hidden_pic']

        );
        $_SESSION['shopping_cart'][$count] = $item_array;

     }

   }

   else {

     $item_array = array (
       'item_id'   => $_GET['id'],
       'item_name'   => $_POST['hidden_name'],
       'item_price'   => $_POST['hidden_price'],
       'item_qty'   => $_POST['quantity'],
       'item_pic'   => $_POST['hidden_pic']

     );

    $_SESSION['shopping_cart'][0] = $item_array;

   }
 }

 else {
   echo '<script>alert("PLease Sign In/Out to Add item ")</script>'; }
}


if (isset($_GET["action"]))
 {
      if($_GET["action"] == "delete")
      {
           foreach($_SESSION["shopping_cart"] as $keys => $values)
           {
                if($values["item_id"] == $_GET["id"])
                {
                     unset($_SESSION["shopping_cart"][$keys]);
                     echo '<script>alert("Item Removed")</script>';
                     echo '<script>window.location="Cart.php"</script>';
                }
           }
      }
 }


  ?>

<!DOCTYPE html>
<html>
<head>
	<!-- Title -->
	<title> HeathyPlantsToday </title>
  <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- CSS File -->
    <link  rel="stylesheet" href="CSS/Index.css" type="text/css" />
    <link  rel="stylesheet" href="CSS/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  </head>


<body>

<div class="container-fluid">
  <a class="brand nav-link" href="index.php"> Healthy Plants Today </a>

      <nav>
       <!-- Links -->
         <ul class="nav justify-content-center mr-auto">
           <li class="nav-item active">
             <a class="nav-link" href="index.php"> Home </a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="Market.php"> Market </a>
           </li>
        </ul>
     </nav>

  <!--  utitlties  Sticky tape  -->
  <div class="d-flex flex-wrap justify-content-around" >

        <!--  1st sub-flex container (Social Icon Container Icon links) -->
         <div class="social-icon-container">
         <!-- Share buttons for External Websites   -->
         <a href="https://twitter.com" ><img src="CSS/imgs/google.png" id="google" class="icons"></a>
          <a href="https://www.facebook.com"><img src="CSS/imgs/facebookk.png" id="facebook" class="icons"></a>
          <a href="https://www.google.com"><img src="CSS/imgs/twitter.png"  id="twitter" class="icons"></a>
        </div>


    <!--  2nd sub-flex container -->
           <!-- Search Box  -->
    <div class="py-5 flex-fill">
      <?php include ('Search_box.php'); ?>
    </div>


      <!--  3rd sub-flex container -->
      <!--  Sign In/Out & Logout Icon & Cart Icon-->
      <div class="user-profile-icon">

          <span class="input-group-text" style="background:#33b5e5;">
            <i class="fas fa-user ">
             <!-- show user name -->
                <?php
              if(isset($user_check)) {
                include ('User_name.php'); }

              elseif(isset($admin_check)) {
                  include ('User_name.php'); }    ?>
             </i>
           </span>


           <div class ="invisible-user-icons">
              <?php
               // Include Sign In/Out Icon
               if(isset($admin_check)) {
                 $r = 1;
               }
               elseif (!isset($user_check)) {
                  include ('invisible_sign_in_icon.html'); }
               ?>
          </div>



          <!--  Logout Icon -->
          <div class ="invisible-user-icons">
              <?php
              // The User logout
               if (isset($user_check)) {
                  include ('invisible_logout_icon.html'); }
                  // Admin User
               elseif (isset($admin_check)) {
                    include ('invisible_logout_icon.html');  }      ?>
         </div>
      </div>


      <!--  4th sub-flex container -->
      <!--  Cart Icon -->
        <?php  if (isset($user_check)) {
            include ('invisible_cart_icon.html'); }

               elseif (isset($admin_check)) {
                     include ('invisible_cart_icon.html');
                     include ('admin_feature.html');      }      ?>

  </div>
</div>

<br />




      <div class="d-flex justify-content-center flex-wrap index_container" >
        <div class="">
          <div class="paan_card" align="left">
            <h3 class="paan_header"> What is Paan ? </h3>
            <p class="paan_info"> Paan is a preparation combining betel leaf with areca nut widely <br> consumed throughout Southeast Asia, East Asia, and the Indian <br>
              subcontinent. It is chewed for its stimulant and psychoactive <br> effects. After chewing it is either spat out or swallowed. <br> Paan has many variations. </p>
          </div>
        </div>

        <div class="p-2">
          <div class="paan_video" align="right" style="text-align:center">
            <button class="btn btn-success" onclick="playPause()">Play/Pause</button>
            <br><br>
            <video width="700" height="420"  id="video">
            <source src="CSS/videos/successful_plant.mp4" type="video/mp4">
             Your browser does not support the video tag.
            </video>
          </div>
        </div>
      </div>



      <?php
      include ("Footer.php");
      ?>




          <script>
          var myVideo = document.getElementById("video");

          function playPause() {
            if (myVideo.paused)
              myVideo.play();
            else
              myVideo.pause();
          }

          </script>






  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

</body>
</html>
