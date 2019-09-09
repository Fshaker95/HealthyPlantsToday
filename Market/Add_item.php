<!--

   Author: fahad shaker

-->

<?php
// Create connection 	header( "Location: dogs.php" );
$conn = new mysqli('localhost', 'root', '','rescue_league_db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


<?php
$img = $_FILES['image']['name'];
$target_dir = "Item_img/";
$name = $_POST['name'];
$description = $_POST['description'];
$price  = $_POST['price'];


if (isset($_POST['submit1'])) {
         $sql = "INSERT  INTO market (name, description, price) VALUES ('$name','$description', '$price')";
          $conn->query($sql);
          $retriv = "SELECT MAX(id) AS max_id FROM market";
          $retriv_results = $conn->query($retriv);
          $row = $retriv_results-> fetch_assoc();
          $lastID = $row["max_id"];




       foreach($img as $key=>$val){
         $sql_img = "INSERT INTO imgs (keyval, value, item_id) VALUES ('$key','$val', '$lastID')";
         $target_path = $target_dir . basename($_FILES["image"]["name"][$key]);
         move_uploaded_file($_FILES['image']['tmp_name'][$key],$target_path);
         $conn->query($sql_img);

       }


}
?>

<?php
echo "<script>setTimeout(\"location.href = 'Market.php';\",1000);
</script>";
echo "If the page taken too long to redirect!";
?> <a href="Market.php">Press Here</a>
</body>
</html>
