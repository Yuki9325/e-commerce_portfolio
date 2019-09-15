<?php
include_once("header.php");

$ua_id = $_GET['ua_id'];
$payment_id = $_GET['payment_id'];

$address = $user->show_chose_address($ua_id);

require_once "../classes/Shop.php";
$shop = new Shop;
$show_cart = $shop->show_cart($_SESSION['id']);
$delivery_fee = $shop->cal_shipping($ua_id);
?>

<div class="py-4">
  <div class="container">
    <div class="row"></div>
  </div>
</div>

  <form action="action.php?action=CHECKOUT&ua_id=<?php echo $ua_id;?>&payment_id=<?php echo $payment_id;?>&cart_id=<?php echo $show_cart[0]['cart_id'];?>" method="POST">

    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="mb-3 p-lg-5 border" style="border-radius:5%;">
                    <h3 class="mb-3 text-black text-center fuchidori">Shipping Address</h3>

                    <table class="table table-bordered text-center" style="border-color:#ff1aff;">

                        <tr>
                            <td style="font-size:20px;"><?php echo $address['ua_first_name']." ".$address['ua_last_name']; ?></td>
                        </tr>
                        <tr>
                            <td style="font-size:20px;"><?php echo $address['ua_phone_number']; ?></td>
                        </tr>
                        <tr>
                            <td class="pb-3" style="font-size:20px;"><?php echo $address['ua_address']." ".$address['ua_prefecture']."<br>".$address['ua_area']."<br>".$address['ua_zip']; ?></td>
                        </tr>
                    </table>

                    <a href="address.php" class="form-control btn btn-lg btn-block text-dark" style="height:100%; border-radius:50px; border-color:#ff1aff; background-color:#ff1aff;">
                        Edit
                    </a>
                </div>

                <div class="p-3 p-lg-5 border" style="border-radius:5%;">
                    <h3 class="mb-3 text-black text-center fuchidori">Payment</h3>
                        <p class="text-center" style="font-size:20px;"><?php 
                        switch($payment_id){
                            case 2:
                            echo "Bank Transfer";
                            break;
                            case 4:
                            echo "Credit Card";
                            break;
                            
                        }
                         ?></p>
                    <!-- <a href="payment.php" class="form-control btn btn-lg btn-block text-dark" style="height:100%; border-radius:50px; border-color:#ff1aff; background-color:#ff1aff;">
                        Edit
                    </a> -->
                </div>
            </div>

            <div class="flexbox mb-5 mb-md-0">
                <div class="p-3 p-lg-5 border" style="border-radius:5%;">
                    <h3 class="mb-3 text-black text-center fuchidori">Cart Totals</h3>
    			    <div class="pr-4 pl-4 text-right">
                        <div class="cart-total">
                                <table class="table table-bordered text-center">
                                    <p class="">
                                    <?php
                                        if($show_cart == TRUE) {
                                            foreach($show_cart as $key => $row){
                                    ?>
                                        <tr class="text-center" style="border:solid #ff1aff 3px;">
                                            <td class="text-center">
                                                <?php echo "<img src='../admin/item/".$row["item_photo"]."' alt='item_photo' width='150' height='150'>"; ?>
                                            </td>
                                        
                                            <td>
                                                <?php echo $row['item_name']."<br>".'¥ '.number_format($row['item_price'])."<br>Qty: ".$row['cartitem_qty']; ?>

                                            </td>
                                        </tr>

                                    <?php
                                            }
                                        }
                                    ?>
                                    </p>
                                </table>

                                    <p class="">
                                        <span class="col-md-6" style="font-size:20px;">Subtotal</span>
                                        <span class="col-md-6" style="font-size:20px;"><?php echo '¥ '.number_format($cartitem_price); ?></span>
                                    </p>
                                    
                                    <p class="">
                                        <span class="col-md-6" style="font-size:20px;">Delivery</span>
                                        <span class="col-md-6" style="font-size:20px;"><?php echo '¥ '.number_format($delivery_fee); ?></span>
                                    </p>

                                    <hr class="background-color:#ff1aff;">

                                    <p class="">
                                        <span class="col-md-6" style="font-size:20px;">Total</span>
                                        <span class="col-md-6" style="font-size:20px;"><?php echo '¥ '.number_format($cartitem_price+$delivery_fee); ?></span>
                                        <input type="hidden" name="purchased_price" value="<?php echo $cartitem_price+$delivery_fee; ?>">
                                    </p>
                        </div>
			        </div>
	            </div>
            </div>

        </div>

        <div class="row pt-5">
            <div class="col-lg-6 pt-5 form-group">
                <a href="payment.php?ua_id=<?php echo $ua_id; ?>" name="" class="form-control btn btn-lg btn-block text-dark" style="height:100%; border-radius:50px; border-color:#ff1aff; background-color:#e0e0eb;">
                    <i class="fa fa-hand-o-left fa-fw" aria-hidden="true"></i>  Go Back to Payment Method
                </a>
            </div>
            <div class="col-lg-6 pt-5 form-group">
                <button type="submit" name="checkout" class="form-control btn btn-lg btn-block text-dark" style="height:100%; border-radius:50px; border-color:#ff1aff; background-color:#e0e0eb;">
                    Place Order <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                </button>
            </div>
        </div>

   </div>

</form>
  
<div class="py-4">
    <div class="container">
        <div class="row"></div>
    </div>
</div>

<?php include_once("footer.php"); ?>