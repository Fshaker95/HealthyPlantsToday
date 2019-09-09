
<?php
if (isset($_POST['submit1'])) {
$img = $_FILES['image']['name'];
$target_dir = "picture/";
$target_path = $target_dir . basename($_FILES["image"]["name"]);

$img_sql = "INSERT  INTO dogs (img) VALUES ($img')";
$conn->query($img_sql);
move_uploaded_file($_FILES['image']['tmp_name'],$target_path);
}



 ?>
