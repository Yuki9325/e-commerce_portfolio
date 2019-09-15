<?php

include_once("../header.php"); 

require_once "../../classes/Order.php";
$order = new Order;
$show_order = $order->show_order($_GET['id']);

?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h4 class="m-0 font-weight-bold text-center">Orders List</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr class="text-center">
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
          </tr>
        </thead>
        <tfoot>
          <tr class="text-center">
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
          </tr>
        </tfoot>
        <tbody>
            <?php
                if($show_order == TRUE) {
                    foreach($show_order as $key => $row){
            ?>
            <tr>
              <td class="text-center">
                <a style="text-decoration:none;" href="../../user/shop-single.php?id=<?php echo $row['item_id']; ?>">
                  <?php echo "<img src='../item/".$row["item_photo"]."' alt='item_photo' width='150' height='150'>"; ?>
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

</div>
<!-- /.container-fluid -->

      <div class="modal fade" id="orderCancelModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h2 class="modal-title" id="myModalLabel">Cancel</h2>
                    </div>
                    <form action="action.php?action=CANCEL" method="POST">
                      <div class="modal-body">
                        <input type="hidden" id="modal-order-id" name="order_id">
                          <h4>Are you sure to cancel this order?</h4>
                      </div>
                      <div class="modal-footer">
                          <button type="submit" name="goback" class="btn btn-default border" style="font-size:20px;" data-dismiss="modal">Go Back</button>
                          <button type="submit" name="cancel" class="btn btn-danger" style="font-size:20px;">Cancel</button>
                      </div>
                    </form>
                </div>
            </div>
      </div>

<?php include_once("../footer.php"); ?>