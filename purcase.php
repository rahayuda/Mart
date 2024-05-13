<?php
include "sql_connection.php";
if (isset($_SESSION['userid'])) {
	$id_customer = $_SESSION['userid'];
	$que    = "SELECT cart.id AS cart_id, cart.*, product.* FROM cart INNER JOIN product ON cart.product_id = product.id where id_customer = $id_customer and status = 'pending'";
	$select = mysqli_query($con, $que);
	?>

	<div class="card">
		<i class="fas fa-th-list"></i>&nbsp;Cart<hr>
		<div class="table-container">
			<form action="index.php?page=purchase-up" method="post"> 
				<table>
					<thead>
						<tr>
							<th style="width: 10%;">No</th>
							<th style="width: 20%;">Product</th>
							<th style="width: 20%;">Quantity</th>
							<th style="width: 30%;">Total</th>
							<th style="width: 10%;"></th>
							<th style="width: 10%;"></th>
						</tr>
					</thead>

					<?php
					$total_amount = 0;
					$no = 0;

					if (mysqli_num_rows($select) > 0) {
						while ($data = mysqli_fetch_array($select)) {
							$no = $no + 1;
							?>
							<tbody>
								<tr>
									<input type="hidden" name="cart_id[]" value="<?php echo $data['cart_id']; ?>">	
									<td><?php echo $no ?></td>
									<td><?php echo $data['name'] ?></td>
									<td><?php echo $data['quantity'] ?> pcs</td>
									<td><?php echo number_format($data['total'], 0, ',', '.') ?></td>
									<td class="align-right"><i class="fas fa-pencil-alt"></i></td>
									<td><i class="fas fa-trash-alt"></i></td>
								</tr>
							</tbody>  
							<?php
						}
					} 
					?>

				</table>
			</div>

			<?php 
			$que1   = "SELECT SUM(total) AS total_amount FROM cart where id_customer = $id_customer and status = 'pending'";
			$sum    = mysqli_query($con, $que1);
			$row    = mysqli_fetch_assoc($sum);

			if ($row['total_amount'] !== null) {
				$total_amount = number_format($row['total_amount'], 0, ',', '.');
			} else {
				$total_amount = 0;
			}
			?>
			<hr>
			<table>
				<tbody>
					<tr>
						<td style="width: 10%;"><i class="fas fa-th-list"></i></td>
						<td style="width: 20%;">Total</td>
						<td style="width: 20%;"></td>
						<td style="width: 30%;"><?php echo $total_amount; ?></td>		
						<td style="width: 20%;" class="align-right"><button type="submit">Purchase</button></td>
					</tr>
				</thead>
			</table>
		</form>
	</div>
<?php } else { ?>
    <div class="card">
        <i class="fas fa-th-list"></i>&nbsp;-<hr>
    </div>
    <?php } ?>