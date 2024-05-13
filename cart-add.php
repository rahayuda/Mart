<?php

$product_id = $_REQUEST['product_id'];
$customer_id = $_REQUEST['customer_id'];
$quantity = $_REQUEST['quantity'];

// Query untuk mendapatkan harga produk dari tabel 'product'
$get_price_query = "SELECT price FROM product WHERE id = '$product_id'";
$get_price_result = mysqli_query($con, $get_price_query);

if ($get_price_result) {
    // Ambil harga produk dari hasil query
    $row = mysqli_fetch_assoc($get_price_result);
    $price = $row['price'];

    // Hitung total berdasarkan harga produk dan kuantitas
    $total = $price * $quantity;

    // Query untuk memasukkan data ke tabel 'cart' termasuk total yang dihitung
    $query = "INSERT INTO cart (product_id, id_customer, quantity, total) VALUES ('$product_id', '$customer_id', '$quantity', '$total')";
    
    // Eksekusi kueri
    mysqli_query($con, $query);

    // Tutup koneksi
    mysqli_close($con);

    // Redirect ke halaman index
    header("location:index.php");
} else {
    // Penanganan jika gagal mendapatkan harga produk
    echo "Failed to get product price.";
}
?>
