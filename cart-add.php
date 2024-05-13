<?php

$product_id = $_REQUEST['product_id'];
$customer_id = $_REQUEST['customer_id'];
$quantity = $_REQUEST['quantity'];

$query = "INSERT INTO cart (product_id, id_customer, quantity) VALUES ('$product_id', '$customer_id', '$quantity')";

mysqli_query($con, $query);

mysqli_close($con);

header("location:index.php");
?>
