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
?>

<!-- Flex Market container  -->
<div class="con">
         <?php
        // Query the database to Fetch the Records
        $sql ="SELECT  * FROM market";
        $result = $conn-> query($sql);
          if ($result-> num_rows > 0) {
              // Loop them and print them
              while ($row = $result-> fetch_assoc())
            {
                 //img path & name
                  $pic = "Item_img/" . $row['img'];
 ?>

        <!-- Item container  -->
                   <div class="item-container" >
                     <!-- Item Form  -->
                       <form method="post" action="market.php?action=add&id=<?php echo $row["id"]; ?>">

                           <div class="form-group">
                              <img src="<?php echo $pic; ?>" id="item-pic">
                           </div>

                            <div class="form-group">
                              <h4 class="item-font-color"><?php echo $row["name"]; ?></h4>
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


                            <div class="form-group">
                              <input type="submit" id="add-botton" name="add_to_cart" class="btn" value="Add to Cart" />
                            </div>

                        </form>
                    </div>


                   <?php
                        }
                   }
                    ?>
            </div>
