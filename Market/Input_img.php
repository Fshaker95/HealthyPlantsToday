<!--
   Author: fahad shaker
	A file for fetching all the dog records from the database
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

$file = $_FILES["fileToUpload"]["name"];
$target_dir = "picture/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

   // Insert record
$sql = "INSERT INTO test (name) VALUES ('$file')";
$conn->query($sql);

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

    } else {
        echo "Sorry, there was an error uploading your file.";
    }

?>
