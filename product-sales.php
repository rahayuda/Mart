<?php
$query = "SELECT * FROM cart LEFT JOIN product ON cart.product_id = product.id where status = 'purchased' order by quantity DESC";
$result = mysqli_query($con, $query);
?>

<table>
	<?php while ($row = mysqli_fetch_assoc($result)) { ?>
		<tr>
			<td style="width: 30%;"><?php echo $row['name'] ?></td>
			<td>
				<progress style="width: 100%;" value="<?php echo $row['quantity']; ?>" max="100" title="<?php echo $row['quantity']; ?>">
				</progress>
				
			</td>
		</tr>
	<?php } ?>
</table>
