<?php
include "sql_connection.php";

if(isset($_SESSION['userid'])) {
	$id_customer = $_SESSION['userid'];
	$que    = "SELECT * FROM cart INNER JOIN product ON cart.product_id = product.id where id_customer = $id_customer and status = 'pending'";
	$select = mysqli_query($con, $que);

	if (mysqli_num_rows($select) > 0) {
		while ($data = mysqli_fetch_array($select)) {
			echo $data['name'] . ", " . $data['quantity'] . " pcs, " . number_format($data['total'], 0, ',', '.') . "<br>";  
		}
	} else {
		echo "-";
	}

	$que1   = "SELECT SUM(total) AS total_amount FROM cart where id_customer = $id_customer and status = 'pending'";
	$sum    = mysqli_query($con, $que1);
	$row    = mysqli_fetch_assoc($sum);

	if ($row['total_amount'] !== null) {
		echo "<hr>Total Amount, " . number_format($row['total_amount'], 0, ',', '.');
	} else {
		echo "<hr>Total Amount, 0";
	}

}
?>
