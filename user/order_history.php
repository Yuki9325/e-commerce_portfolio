<?php

include_once("header.php"); 

require_once "../classes/Order.php";
$order = new Order;
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
                <th>Order#</th>
                <th>Date</th>
                <th>Total</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>
            
            <tbody>
            <?php
            $show_ordered_list = $order->show_ordered_list($_SESSION['id']);
            $num = null;
                if($show_ordered_list == TRUE) {
                foreach($show_ordered_list as $key => $row){
                    
                    if($row['cart_id'] == $num){
                    continue;
                    }
                    $num = $row['cart_id'];
            ?>
                <tr class="text-center" style="border:solid #ff1aff 3px;">
                    <td><?php echo "<a href='ordered_items.php?id=".$row['cart_id']."' class='text-body' target='_blank'>".$row['cart_id']."</a>"; ?></td>
                    <td><?php echo $row['purchased_date']; ?></td>
                    <td><?php echo '¥ '.number_format($total = $order->get_total_price($row['cart_id'])); ?></td>

                    <?php 
                        if($row['checkout_status'] == 'pending') {
                    ?>
                    <td>
                    <div class="border text-center" style="padding:10px; margin-bottom:10px; border-radius:10px;">
                        <strong>Waiting for Payment</strong>
                    </div>
                    </td>

                    <?php
                        }elseif($row['checkout_status'] == 'confirmed'){
                    ?>
                    <td>
                    <div class="border text-center" style="padding:10px; margin-bottom:10px; border-radius:10px;">
                        <strong>Preparing</strong>

                    <?php 
                        }elseif($row['checkout_status'] == 'shipped'){
                    ?>
                    <td>
                    <div class="border text-center" style="padding:10px; margin-bottom:10px; border-radius:10px;">
                        <strong>Shipped</strong>

                    <?php
                        }elseif($row['checkout_status'] == 'delivered') {
                    ?>
                    <td>
                    <div class="border text-center" style="padding:10px; margin-bottom:10px; border-radius:10px;">
                        <strong>Delivered</strong>

                    <?php
                        }elseif($row['checkout_status'] == 'received') {
                    ?>
                    <td>
                    <div class="border text-center" style="padding:10px; margin-bottom:10px; border-radius:10px;">
                        <strong>Closed</strong></div>

                    <?php
                        }elseif($row['checkout_status'] == 'request for return') {
                    ?>
                    <td>
                    <div class="border text-center" style="padding:10px; margin-bottom:10px; border-radius:10px;">
                        <strong>Processing</strong>

                    <?php
                    }elseif($row['checkout_status'] == 'accept return') {
                    ?>
                    <td>
                    <div class="border text-center" style="padding:10px; margin-bottom:10px; border-radius:10px;">
                        <strong>Please Return the Item</strong>

                    <?php
                    }elseif($row['checkout_status'] == 'returning') {
                    ?>
                    <td>
                    <div class="border text-center" style="padding:10px; margin-bottom:10px; border-radius:10px;">
                        <strong>Returning</strong></div>

                    <?php
                    }elseif($row['checkout_status'] == 'returned') {
                    ?>
                    <td>
                    <div class="border text-center" style="padding:10px; margin-bottom:10px; border-radius:10px; background-color:black; color:#ff1aff;">
                        <strong>Returned and Refund</strong>
                    </div> 
                    </td>

                    <?php
                    }elseif($row['checkout_status'] == 'no item received') {
                    ?>
                    <td>
                    <div class="border text-center" style="padding:10px; margin-bottom:10px; border-radius:10px;">
                        <strong>Processing</strong>
                    </div> 
                    </td>

                    <?php
                    }elseif($row['checkout_status'] == 'cancelled') {
                    ?>
                    <td>
                    <div class="border text-center" style="padding:10px; margin-bottom:10px; border-radius:10px; background-color:black; color:#ff1aff;">
                        <strong>Cancelled</strong>
                    </div> 
                    </td>

                    <?php
                    }elseif($row['checkout_status'] == 'closed') {
                    ?>
                    <td>
                    <div class="border text-center" style="padding:10px; margin-bottom:10px; border-radius:10px; background-color:black; color:#ff1aff;">
                        <strong>Thank you!</strong>
                    </div> 
                    </td>
                    <?php
                    }
                    ?>


                    <td class="text-center">
                <?php
                    if($row['checkout_status'] == 'pending'){
                ?>
                    <form action="action.php?action=PAID&id=<?php echo $row['checkout_id']; ?>" method="POST">
                        <button type="submit" name="paid" class="btn text-black form-control" style="background-color:#ff1aff;">
                            Paid
                        </button>
                    </form>
                <?php
                    }
                elseif($row['checkout_status'] == 'confirmed') {
                echo "";
                }
                elseif($row['checkout_status'] == 'shipped'){
                ?>
                    <form action="action.php?action=RECEIVED&id=<?php echo $row['checkout_id']; ?>" method="POST">
                        <button type="submit" name="received" class="btn text-black form-control" style="background-color:#ff1aff;">
                            Received
                        </button>
                    </form><br>
                    <form action="action.php?action=REQUEST_FOR_RETURN&id=<?php echo $row['checkout_id']; ?>" method="POST">
                        <button type="submit" name="request_for_return" class="btn form-control" style="background-color:black; color:#ff1aff;">
                            Request for Return
                        </button>
                    </form><br>
                    <form action="action.php?action=NO_ITEM_RECEIVED&id=<?php echo $row['checkout_id']; ?>" method="POST">
                        <button type="submit" name="no_item_received" class="btn form-control" style="background-color:black; color:#ff1aff;">
                            No Item Received
                        </button>
                    </form>
                <?php
                }
                elseif($row['checkout_status'] == 'delivered'){
                    echo "";
                }
                elseif($row['checkout_status'] == 'request for return'){
                    echo "";
                }
                elseif($row['checkout_status'] == 'accept return'){
                ?>
                    <form action="action.php?action=RETURNED_ITEM&id=<?php echo $row['checkout_id']; ?>" method="POST">
                        <button type="submit" name="returned_item" class="btn text-black form-control" style="background-color:#ff1aff;">
                            Returned Item
                        </button>
                    </form>
                <?php
                }
                elseif($row['checkout_status'] == 'returning'){
                    echo "";
                }
                elseif($row['checkout_status'] == 'no item received') {
                    echo "";
                }
                    }
                } else {
                    echo "<td colspan='5' class='text-center'>No Order</td>";
                }
                ?>
                </td>
                </tr>
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