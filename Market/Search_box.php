<!--
   Author: Fahad Shaker
-->
<?php

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



<style>
.search_container {
  display: flex;

}

.search_box {
    width: 60%;
    background: -webkit-linear-gradient(left , #33b5e5, white);
		height: 40%;
	  border: 1px solid #33b5e5;
	  border-right: none;
	  padding: 8.5px;
	  border-radius: 15px;
	  outline: none;
		font-family: 'Open Sans', sans-serif;
		transition: all .25s ease .25s;
		margin-left: 260px;

	}

.searchButton {
  width: 45px;
  height: 45px;
	margin-left: 10px;
  border: 1px solid #33b5e5 ;
	background: #33b5e5;
  text-align: center;
	border-radius: 30px;
  cursor: pointer;
  font-size: 20px;
}


::placeholder {
color: white;


}


.search_box:hover {
	border: 2px solid white;
	transition: all .25s ease;
}

.result-container {
  position: absolute;
  width: 300px;
  margin: 10px;
  text-align: center;
  line-height: 75px;
  font-size: 30px;
  border-radius: 30px 30px 30px 30px;
  border: 3px solid #33b5e5;
  align:center;
  color: red;
  background: #33b5e5;
}

#item-pic {
  width: 100%;
  background-position: 50% 50%;
  background-repeat: no-repeat;
  background-size: cover;
  border-radius: 25px 25px 0px 0px;
  }

#close_box {
  background: #33b5e5;
  border-radius: 60px;

}

#qty_box {
	margin-left: 70px;
  width:150px;
  border-radius: 30px;

}

#search_box {
  color: white;
}


</style>


<form method="POST">
<div class="search_container">
  <input type="text" name="s_value" class="search_box" placeholder="What are you looking for ?"  id="search_box">
  <button type="submit" name="s_button" class="searchButton">
    <i> <img src="CSS/imgs/search1.png" width="30"></i>
  </button>
</div>
</form>


<?php
if(isset($_POST['s_button'])) {
  $search_value = $_POST['s_value'];
  $sql = "select *  from market where name = '$search_value'";
  $result = $conn->query($sql);
  $row = mysqli_fetch_array($result);
  if (isset($row['name'])) {



  ?>

    <div class="result-container" id="result-container">

          <button onclick="hide_result()" class="input-group-text" id="close_box">
             <i class="fas fa-times"></i>
          </button>

     <form method="post">
        <div class="form-group">
           <?php include ('item_imgs.php'); ?>
        </div>
         <div class="form-group">
           <h4 class="item-font-color"><?php echo $row["name"]; ?></h4>
         </div>
         <div class="form-group">
           <h4 class="text-danger">$<?php echo $row["price"]; ?></h4>
         </div>
         <div class="form-group">
           <label for="quantity"> <h4 class="item-font-color">Qty:</h4> </label>
           <input type="text" name="quantity"  onkeypress="isInputNumber(event)"  id="qty_box" class="form-control" value="1" />
         </div>
         <div class="form-group">
           <input type="submit" id="add-botton" name="add_to_cart" class="btn" value="Add to Cart" />
         </div>
     </form>
   </div>

     <?php
}
  else {
    echo "<script>alert('No Item Found') </script>";
  }
}

?>


<!-- hide result -->
<script>
function hide_result() {
document.getElementById("result-container").style.display= "none"; }
</script>
