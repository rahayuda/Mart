<?php

$host_name  = "localhost";
$port       = "3307"; 
$user_name  = "root";
$password   = "maria";
$database   = "mart";

$con = mysqli_connect($host_name . ":" . $port, $user_name, $password);
mysqli_select_db($con, $database);

?>