<!--
   Author: Fahad Shaker
-->
<?php
// Include File
include ('test_session.php');
include ('remove_item.php');


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
    <link  rel="stylesheet" href="CSS/Market.css" type="text/css" />
    <link  rel="stylesheet" href="CSS/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  </head>


<body>
  <a class="brand" href="#"> Healthy Plants Today </a>
<div class="container-fluid">
      <nav >
       <!-- Links -->
         <ul class="nav justify-content-center mr-auto">
           <li class="nav-item">
             <a class="nav-link" href="index.php"> Home </a>
           </li>
           <li class="nav-item active">
             <a class="nav-link" href="Market.php"> Market </a>
           </li>
        </ul>
     </nav>

  <!--  utitlties  Sticky tape  -->
  <div class="d-flex flex-wrap justify-content-around" >

        <!--  1st sub-flex container (Social Icon Container Icon links) -->
         <div class="social-icon-container">
         <!-- Share buttons for External Websites   -->
         <a href="https://www.google.com" ><img src="CSS/imgs/google.png" id="google" class="icons"></a>
          <a href="https://www.facebook.com"><img src="CSS/imgs/facebookk.png" id="facebook" class="icons"></a>
          <a href="https://twitter.com"><img src="CSS/imgs/twitter.png"  id="twitter" class="icons"></a>
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

               <!-- Market sign -->
        <h2 id="Market_sign"> Market </h2>



             <!-- Flex Market container  -->
             <div class="con">

                      <?php
                     // Query the database to Fetch the Records
                     $sql ="SELECT  * FROM market";
                     $result = $conn->query($sql);

                       if ($result-> num_rows > 0 ) {
                           // Loop them and print them
                           while ($row = $result-> fetch_assoc())
                         {
              ?>
              <!-- Item container  -->
                   <div class="item-container" >
                     <!-- Item Form  -->
                       <form method="post" action="market.php?action=add&id=<?php echo $row["id"]; ?>">
                         <!-- Include Admin Feature  -->

                       <?php if (isset($admin_check)) { ?>
                       <input type="submit" name="remove"  value="Remove"  class="input-group-text" id="close_box">
                       <?php } ?>

                       <!-- include display image file -->
                            <?php include ('item_imgs.php');
                             ?>

                             <a href="item_ImgArray.php"> </a>

                             <div class="form-group">
                               <h4 class="item-font-color "> <?php echo $row["name"]; ?></h4>
                             </div>


                            <div class="form-group">
                              <h4 class="text-danger">$<?php echo $row["price"]; ?></h4>
                            </div>

                            <div class="form-group">
                              <label for="quantity"> <h4 class="item-font-color">Qty:</h4> </label>
                              <input type="text" name="quantity"  onkeypress="isInputNumber(event)"   class="form-control" value="1" style="width:150px; border-radius: 30px;"/>
                            </div>

                            <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                            <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>"   />
                            <input type="hidden" name="hidden_pic" value="<?php echo $pic; ?>"   />
                            <input type="hidden" name="hidden_id" value="<?php echo $row["id"]; ?>"   />


                            <div class="form-group">
                              <input type="submit" onclick="remove_item()" id="add-botton" name="add_to_cart" class="btn" value="Add to Cart" />
                            </div>

                            <button   onclick="remove_item()"  name="add_to_cart" class="btn" value="Add to Cart" >
                            </button>

                            <script>
                            function remove_item() {
                              var xhttp;
                              xhttp = new XMLHttpRequest();
                              xhttp.onreadystatechange = function() {
                              xhttp.open("GET", "remove.php", true);
                              xhttp.send();
                            }
                          }

                            </script>

                        </form>
                    </div>


                   <?php
                        }
                   }
                    ?>
            </div>

    <?php
    include ("Footer.php");
    ?>






<script>
function isInputNumber(event) {
  var ch = String.fromCharCode(event.which);

  if (!(/[0-9]/.test(ch)) ) {
    event.preventDefault();
  }
}
</script>





<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

</body>
</html>
