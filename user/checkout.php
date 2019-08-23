<?php
include_once("header.php");

$address = $user->show_address($_SESSION['id']);

require_once "../classes/Shop.php";
$shop = new Shop;
$show_cart = $shop->show_cart($_SESSION['id']);
$delivery_fee = $shop->cal_shipping($_SESSION['id']);
?>
<div class="py-4">
  <div class="container">
    <div class="row"></div>
  </div>
</div>

<form action="action.php?action=CHECKOUT&ua_id=<?php echo $address['ua_id'];?>&cart_id=<?php echo $show_cart[0]['cart_id'];?>" method="POST">
<div class="container">
  <div class="row">
            <div class="col-md-6 mb-5 mb-md-0">
              <h3 class="mb-3 text-black fuchidori">Billing Details</h3>
              <div class="p-3 p-lg-5 border" style="border-radius:5%;">

                <table class="table table-bordered" style="border-color:#ff1aff;">
                <tr>
                    <th style="font-size:25px;">First Name</th>
                    <td style="font-size:20px;"><?php echo $row['first_name']; ?></td>
                </tr>
                <tr>
                    <th style="font-size:25px;">Last Name</th>
                    <td style="font-size:20px;"><?php echo $row['last_name']; ?></td>
                </tr>
                <tr>
                    <th style="font-size:25px;">Address</th>
                    <td style="font-size:20px;"><?php echo $address['ua_address']; ?></td>
                </tr>
                <tr>
                    <th style="font-size:25px;">Prefecture</th>
                    <td style="font-size:20px;"><?php echo $address['ua_prefecture']; ?></td>
                </tr>
                <tr>
                    <th style="font-size:25px;">Delivery Area</th>
                    <td style="font-size:20px;"><?php echo $address['ua_area']; ?></td>
                </tr>
                <tr>
                    <th style="font-size:25px;">Zip Code</th>
                    <td style="font-size:20px;"><?php echo $address['ua_zip']; ?></td>
                </tr>
                <tr>
                    <th style="font-size:25px;">Phone number</th>
                    <td style="font-size:20px;"><?php echo $address['ua_phone_number']; ?></td>
                </tr>
                </table>
                <div class="form-group">
                    <a href="profile.php" class="btn btn-lg btn-block text-dark" name="checkout" style="border-radius:50px; border-color:#ff1aff;">
                      Edit Address
                    </a>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-block text-dark" name="checkout" style="border-radius:50px; border-color:#ff1aff;">
                      Ship to Different Address
                    </button>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              
              <div class="row mb-5">
                <div class="col-md-12">
                  <h2 class="h3 mb-3 text-black fuchidori">Your Order & Payment</h2>
                  <div class="p-3 p-lg-5 border" style="border-radius:5%;">
                    <div class="card mb-5" style="background:#e0e0eb; border:solid #ff1aff 3px;">
                      <div class="text-right">
                        <div class="cart-total my-3 b-3">
                          <h3 class="text-center mb-3">Cart Totals</h3>
                          <p class="">
                          <?php
                            if($show_cart == TRUE) {
                          ?>
                            <span class="col-md-6" style="font-size:20px;">Subtotal</span>
                            <span class="col-md-6" style="font-size:20px;"><?php echo '¥ '.number_format($cartitem_price); ?></span>
                          </p>
                          <p class="">
                            <span class="col-md-6" style="font-size:20px;">Delivery</span>
                            <span class="col-md-6" style="font-size:20px;"><?php echo '¥ '.number_format($delivery_fee); ?></span>
                          </p>
                          <hr class="" style="border-color:#ff1aff;">
                          <p class="">
                            <span class="col-md-6" style="font-size:20px;">Total</span>
                            <span class="col-md-6" style="font-size:20px;"><?php echo '¥ '.number_format($cartitem_price+$delivery_fee); ?></span>
                            <input type="hidden" name="cartitem_price" value="<?php echo ($cartitem_price+$delivery_fee); ?>">
                          </p>
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                    </div>

                    <div class="border p-3 mb-3">
                        <a class="d-block text-dark" style="text-decoration:none; font-size:25px;" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">
                          Bank Transfer
                        </a>
                      <div class="collapse" id="collapsebank">
                        <div class="pt-4">
                        <p style="display:inline-block; font-size:20px;">
                          <input type="radio" name="payment_id" value="2" required> Choose Bank Transfer
                        </p>
                          <p class="mb-0">Will send our bank account information by email once you place an order.</p><br>
                          <p class="text-danger">All bank charges must be paid by the customer.</p>
                        </div>
                      </div>
                    </div>

                    <div class="border p-3 mb-3">
                        <a class="d-block text-dark" style="text-decoration:none; font-size:25px;" data-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">
                          Credit Card
                        </a>
                      <div class="collapse" id="collapsecheque">
                        <div class="py-4">
                        <p style="display:inline-block; font-size:20px;">
                          <input type="radio" name="payment_id" value="4" required> Choose Credit Card
                        </p>
                          <div class="form-group row">
                            <div class="col-md-6">
                              <label class="text-black">First Name <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="credit_f_name">
                            </div>
                            <div class="col-md-6">
                              <label class="text-black">Last Name <span class="text-danger">*</span></label>
                              <input type="text" class="form-control"  name="credit_l_name">
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="col-md-12">
                              <label class="text-black">Card Number<span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="credit_c_number">
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="col-md-6">
                              <label class="text-black">Expiration Month<span class="text-danger">*</span></label>
                                <select class="form-control" name="credit_exp_month">
                                  <?php
                                    $thisMonth = date('m');

                                    for ($i=1; $i <= 12; $i++) {
                                      if ($i==$thisMonth) {
                                          echo "<option value={$i} selected>{$i}</option>", "\n";
                                      } else {
                                         echo "<option value={$i}>{$i}</option>", "\n";
                                         }
                                      }
                                  ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                              <label class="text-black">Expiration Year<span class="text-danger">*</span></label>
                                <select class="form-control" name="credit_exp_year">
                                  <?php
                                    $thisYear = date('Y');
                                    $endYear = $thisYear + 21;

                                    for($i=$thisYear; $i <= $endYear; $i++) {
                                        if ($i==$thisYear) {
                                          echo "<option value={$i} selected>{$i}</option>" , "\n";
                                              } else {
                                          echo "<option value={$i}>{$i}</option>" , "\n";
                                              }
                                    }    
                                  ?>
                                </select>
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="col-md-6">
                              <label for="c_diff_fname" class="text-black">Security Number<span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="credit_security">
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="mt-5 btn btn-lg btn-block text-dark" name="checkout" style="border-radius:50px; border-color:#ff1aff;">
                          Place Order
                        </button>
                      </form>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
</div>
<?php
include_once("footer.php");
?>