<?php
$query = "SELECT *, SUM(cart.quantity) AS total_quantity
FROM cart
LEFT JOIN product ON cart.product_id = product.id
WHERE cart.status = 'purchased'
GROUP BY product.id, product.name
ORDER BY total_quantity DESC";
$result = mysqli_query($con, $query);
?>

<table>
	<?php while ($row = mysqli_fetch_assoc($result)) { ?>
		<tr>
			<td style="width: 30%;"><?php echo $row['name'] ?></td>
			<td>
				<progress style="width: 100%;" value="<?php echo $row['total_quantity']; ?>" max="100" title="<?php echo $row['total_quantity']; ?>">
				</progress>
				
			</td>
		</tr>
	<?php } ?>
</table>
