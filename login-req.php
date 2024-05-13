<?php 
session_start();
include 'sql_connection.php';
 
$username   = $_POST['username'];
$password   = $_POST['password'];
$key        = "informatika";
$hashedpassword = hash_hmac("sha256", $password, $key);

$data = mysqli_query($con, "SELECT * FROM customer WHERE username='$username' AND password='$hashedpassword'");
$cek = mysqli_num_rows($data);
 
if($cek > 0){
    $row = mysqli_fetch_assoc($data);
    $userid = $row['id'];

    $_SESSION['username'] = $username;
    $_SESSION['userid'] = $userid;
    $_SESSION['status'] = "login";

    header("location:index.php");
}else{
    header("location:index.php?page=login");
}
?>

