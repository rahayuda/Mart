<?php
include "sql_connection.php";

$id_customer = null;

if (isset($_SESSION['userid'])) {
    $id_customer = $_SESSION['userid'];

    $que = "SELECT sales.*, cart.product_id, cart.quantity, cart.total, product.name 
    FROM sales 
    INNER JOIN cart ON sales.id_cart = cart.id
    INNER JOIN product ON cart.product_id = product.id
    WHERE cart.id_customer = $id_customer ORDER BY sales.timestamp DESC";

    $select = mysqli_query($con, $que);

    if ($select !== false) {
    }

    ?>

    <div class="card">
        <i class="fas fa-th-list"></i>&nbsp;History<hr>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 10%;">Code</th>
                        <th style="width: 10%;">Product</th>
                        <th style="width: 10%;">Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <?php
                if (mysqli_num_rows($select) > 0) {
                    $no = 0;
                    $last_timestamp = null; 
                    while ($data = mysqli_fetch_array($select)) {

                        $current_timestamp = $data['timestamp']; 

                        if ($last_timestamp !== null && $last_timestamp !== $current_timestamp) {
                            echo "<tbody><tr><td colspan='6'><hr></td></tr></tbody>"; 
                        }

                        $no++;
                        ?>
                        <tbody>
                            <tr>
                                <td>
                                    <?php 
                                    $timestamp = $data['timestamp'];
                                    $formatted_timestamp = date('YmdHis', strtotime($timestamp));
                                    echo $formatted_timestamp;
                                    ?>
                                </td>
                                <td><?php echo $data['name'] ?></td>
                                <td><?php echo $data['quantity'] ?> pcs</td>
                                <td><?php echo number_format($data['total'], 0, ',', '.') ?></td>
                            </tr>
                        </tbody>
                        <?php

                        $last_timestamp = $current_timestamp;
                    }
                } else {
                    echo "<tbody><tr><td colspan='6'>No sales history found.</td></tr></tbody>";
                }
                ?>
            </table>
        </div>
    </div>
<?php } else { ?>
    <div class="card">
        <i class="fas fa-th-list"></i>&nbsp;-<hr>
    </div>
    <?php } ?>