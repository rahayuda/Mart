<?php

$host_name  = "sql210.infinityfree.com";
$port       = "3306"; 
$user_name  = "epiz_33724693";
$password   = "OLd96buhHp8V";
$database   = "epiz_33724693_mart";

$con = mysqli_connect($host_name . ":" . $port, $user_name, $password);
mysqli_select_db($con, $database);

?>