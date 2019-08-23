<?php

require_once "../../Classes/Order.php";
$order = new Order;

include_once ("../header.php");

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
          <tr>
            <th>Status</th>
            <th>Name</th>
            <th>Cart ID</th>
            <th>Payment Method</th>
            <th>Total Price</th>
            <th>Purchased Date</th>
            <th>Shipped Date</th>
            <th>Shipping Address</th>
            <th>Purchased Item</th>
            <th></th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Status</th>
            <th>Name</th>
            <th>Cart ID</th>
            <th>Payment Method</th>
            <th>Total Price</th>
            <th>Purchased Date</th>
            <th>Shipped Date</th>
            <th>Shipping Address</th>
            <th>Purchased Item</th>
            <th></th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          $show_orders = $order->show_all();
          $num = null;
            if($show_orders == TRUE) {
              foreach($show_orders as $key => $row){
                $address = $row['ua_address']."<br>".$row['ua_city']."<br>".$row['ua_prefecture']."<br>".$row['ua_zip'];
                
                if($row['cart_id'] == $num){
                  continue;
                }
                $num = $row['cart_id'];
          ?>
          <tr>
            <td>
              <?php 
                if($row['checkout_status'] == 'pending') {
              ?>
                <div class="border border-warning text-warning text-center" style="padding:10px; margin-bottom:10px; border-radius:10px;">
                  <strong>Waiting for Payment</strong></div> 

              <?php
                }elseif($row['checkout_status'] == 'confirmed'){
              ?>
                <div class="border border-success text-success text-center" style="padding:10px; margin-bottom:10px; border-radius:10px;">
                  <strong>Received Payment</strong></div>

              <?php 
                }elseif($row['checkout_status'] == 'shipped'){
              ?>
                <div class="border border-danger text-danger text-center" style="padding:10px; margin-bottom:10px; border-radius:10px;">
                  <strong>In Transit</strong></div>

              <?php
                }elseif($row['checkout_status'] == 'delivered') {
              ?>
                <div class="border border-success text-success text-center" style="padding:10px; margin-bottom:10px; border-radius:10px;">
                  <strong>Waiting for Receiving</strong></div>

              <?php
                }elseif($row['checkout_status'] == 'received') {
              ?>
                <div class="border border-secondary text-secondary text-center" style="padding:10px; margin-bottom:10px; border-radius:10px;">
                  <strong>Closed</strong></div>

              <?php
                }elseif($row['checkout_status'] == 'request_return') {
              ?>
                <div class="border border-danger text-danger text-center" style="padding:10px; margin-bottom:10px; border-radius:10px;">
                  <strong>Request for Return</strong></div>

              <?php
              }elseif($row['checkout_status'] == 'accept_return') {
              ?>
                <div class="border border-success text-success text-center" style="padding:10px; margin-bottom:10px; border-radius:10px;">
                  <strong>Waiting for Return</strong></div>

              <?php
              }elseif($row['checkout_status'] == 'return_item') {
              ?>
                <div class="border border-success text-success text-center" style="padding:10px; margin-bottom:10px; border-radius:10px;">
                  <strong>Returning</strong></div>

              <?php
              }elseif($row['checkout_status'] == 'returned') {
              ?>
                <div class="border border-danger text-danger text-center" style="padding:10px; margin-bottom:10px; border-radius:10px;">
                  <strong>Returned</strong></div>

              <?php
              }elseif($row['checkout_status'] == 'no_item_received') {
              ?>
              <div class="border border-danger text-danger text-center" style="padding:10px; margin-bottom:10px; border-radius:10px;">
                <strong>No Item Received</strong></div>

              <?php
              }elseif($row['checkout_status'] == 'cancelled') {
              ?>
                <div class="border border-secondary text-secondary text-center" style="padding:10px; margin-bottom:10px; border-radius:10px;">
                  <strong>Cancelled</strong></div>
              <?php
              }
              ?>
            </td>
            <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
            <td><?php echo $row['cart_id']; ?></td>
            <td><?php echo $row['payment_name']; ?></td>
            <td><?php echo  $total = $order->get_total_price($row['cart_id']); ?></td>
            <td><?php echo $row['purchased_date']; ?></td>
            <td><?php echo $row['shipped_date']; ?></td>
            <td><?php echo $address; ?></td>
            <td><?php echo "<a href='order_details.php?id=".$row['user_id']."' class='btn btn-secondary bg-white text-body'>Details</i></a>"; ?></td>

              <?php
                if($row['checkout_status'] == 'pending'){
              ?>
                <td class="text-center">
                  <form action="action.php?action=C_T_PAYMENT&id=<?php echo $row['checkout_id']; ?>" method="POST">
                    <button type="submit" name="c_t_payment" class="btn btn-success text-white">
                        Confirm the Payment
                    </button>
                </form>
                </td>
              <?php
                }
              elseif($row['checkout_status'] == 'confirmed') {
              ?>

              <td class="">
                <div class="row">
                  <div class="col-5">
                  <form action="action.php?action=SHIPPED&id=<?php echo $row['checkout_id']; ?>" method="POST">
                  <button type="submit" name="shipped" class="btn btn-primary text-white">
                      Ship
                  </button>
                </form>

                  </div>
                  <div class="col-5 mr-2">
                  <form action="action.php?action=CANCELLED&id=<?php echo $row['checkout_id']; ?>" method="POST">
                  <button type="button" name="cancelled" class="btn btn-danger text-white">
                      Cancel
                  </button>
                </form>
                  </div>
                </div>
              </td>
              <?php
              }else{
              ?>
              <td>
                <?php echo ""; ?>
              </td>
          </tr>
          <?php
              }
            }
          } else {
            echo "<td colspan='7' class='text-center'>No Order</td>";
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