<!--



   Author: fahad shaker




-->


<?php
session_start();// Starting Session
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$conn = new mysqli('localhost', 'root', '', 'rescue_league_db');

// Storing Session
@$admin_check = $_SESSION ['login_admin'];
@$user_check = $_SESSION['login_user'];
@$user_check_fname = $_SESSION['login_user_fname'];
@$user_check_lname = $_SESSION['login_user_lname'];
@$user_check_phone = $_SESSION['login_user_phone'];
@$user_id = $_SESSION['lgoin_user_id'] ;
@$admin_id = $_SESSION['lgoin_admin_id'] ;


// SQL Query To Fetch Complete Information Of User
$sql="select Email from customers where  Email ='$user_check'";
$sql_admin = "select admin_user from admin where admin_user = '$admin_check'";
$result = $conn->query($sql);
$result_admin = $conn-> query($sql_admin);
$row = mysqli_fetch_array($result);
$row_admin = mysqli_fetch_array($result_admin);

/*
if(!isset($user_check)) {

 echo "<script type='text/javascript'>alert('Please Register/Login')</script>";
// header('Location: register_login.html'); // if no session Redirecting To Home Page
}
*/
?>
