<?php
$query = "SELECT * FROM cart LEFT JOIN product ON cart.product_id = product.id where status = 'purchased' order by quantity DESC LIMIT 1";
$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    ?>
    <i class="fas fa-th-list"></i>&nbsp;<?php echo $row['name']; ?><hr>
    <img src="<?php echo $row['image']; ?>" class="product-img">
    <p>
        <?php echo $row['category']; ?> | <?php echo $row['stock']; ?> <br>
        <?php echo number_format($row['price'], 0, ',', '.'); ?>
    </p>
    <hr>
    <p>
        <form action="index.php?page=cart-add" method="post"> 
            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>"> 
            <input type="number" name="quantity" value="1" min="1" max="<?php echo $row['stock']; ?>" step="1" oninput="validity.valid||(value='');">
            <?php if(isset($_SESSION['userid'])) { ?>
                <input type="hidden" name="customer_id" value="<?php echo $_SESSION['userid']; ?>">
                <button type="submit" name="buy">Buy</button> 
            <?php } ?>
        </form>
    </p>

<?php } else { ?>
    <i class="fas fa-th-list"></i>&nbsp;Best Product<hr>
<?php } ?>