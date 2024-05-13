<?php
if(isset($_POST['cart_id'])) {
	$cart_ids = $_POST['cart_id'];

	mysqli_begin_transaction($con);

	try {
		$select_cart_query = "SELECT quantity, product_id FROM cart WHERE id IN (".implode(',', $cart_ids).")";
		$cart_result = mysqli_query($con, $select_cart_query);

		if($cart_result) {
			while($cart_row = mysqli_fetch_assoc($cart_result)) {
				$quantity = $cart_row['quantity'];
				$product_id = $cart_row['product_id'];

				$update_product_query = "UPDATE product SET stock = stock - $quantity WHERE id = $product_id";

				if(mysqli_query($con, $update_product_query)) {
					echo "Stok produk dengan ID " . $product_id . " berhasil diperbarui.";
				} else {
					throw new Exception("Gagal memperbarui stok produk.");
				}
			}

			foreach($cart_ids as $cart_id) {
				$update_cart_query = "UPDATE cart SET status = 'purchased' WHERE id = $cart_id";
				mysqli_query($con, $update_cart_query);

				$insert_query = "INSERT INTO sales (id_cart) VALUES ($cart_id)";

				if(mysqli_query($con, $insert_query)) {
					echo "Data berhasil dimasukkan ke dalam tabel sales.";
				} else {
					throw new Exception("Gagal memasukkan data ke dalam tabel sales.");
				}
			}

			mysqli_commit($con);
		} else {
			throw new Exception("Gagal mengambil data keranjang.");
		}
	} catch (Exception $e) {
		mysqli_rollback($con);
	}
}

header("location:index.php?page=history");
?>
