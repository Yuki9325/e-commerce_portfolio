<?php

include_once("header.php"); 

require_once "../classes/Order.php";
$order = new Order;
$show_order = $order->show_order($_GET['id']);
?>

<div class="py-4">
    <div class="container">
        <div class="row"></div>
    </div>
</div>

<div class="container">
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered border border-primary" id="dataTable" width="100%" cellspacing="0" style="border-color:pink;">
            <thead>
            <tr class="text-center">
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
            </thead>
            
            <tbody>
                <?php
                    if($show_order == TRUE) {
                        foreach($show_order as $key => $row){
                ?>
                <tr class="text-center">
                <td>
                    <a style="text-decoration:none;" target="_blank" href="shop-single.php?id=<?php echo $row['item_id']; ?>">
                    <?php echo "<img src='../admin/item/".$row["item_photo"]."' alt='item_photo' width='150' height='150'>"; ?>
                    </a>
                <?php echo $row['item_name']; ?></td>
                <td><?php echo '¥ '.number_format($row['item_price']); ?></td>
                <td><?php echo $row['cartitem_qty']; ?></td>
                <td><?php echo '¥ '.number_format($row['cartitem_price']); ?></td>
                </tr>
                <?php
                        }
                    }
                ?>
            </tbody>
        </table>
        </div>
    </div>
</div>

  <div class="py-4">
    <div class="container">
        <div class="row"></div>
    </div>
</div>

<?php include_once("footer.php"); ?>