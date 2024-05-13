<?php
$query = "SELECT * FROM best_product LEFT JOIN product ON best_product.product_id = product.id";
$result = mysqli_query($con, $query);
?>

<table>
	<?php while ($row = mysqli_fetch_assoc($result)) { ?>
		<tr>
			<td style="width: 30%;"><?php echo $row['product_name'] ?></td>
			<td>
				<progress style="width: 100%;" value="<?php echo $row['total_quantity']; ?>" max="100" title="<?php echo $row['total_quantity']; ?>">
				</progress>
				
			</td>
		</tr>
	<?php } ?>
</table>
