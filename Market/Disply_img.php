<!DOCTYPE html>
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

$ret_sql = "SELECT * FROM test";
$results = $conn->query($ret_sql);
while ($row = $results-> fetch_assoc()) {
$pic = "picture/" . $row['name'];
echo "<img src= '$pic' width= 50% /> ";
}
?>

<html>
<body>

<form action="test.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>



</body>
</html>
