<?php
include_once("header.php");

require_once "../classes/Shop.php";
$shop = new Shop;
$show_cart = $shop->show_cart($_SESSION['id']);

$ua_id = null;

if(isset($_POST['ua_id'])){
    $ua_id = $_POST['ua_id'];
}else{
    $ua_id = $_GET['ua_id'];
}

?>

<div class="py-4">
  <div class="container">
    <div class="row"></div>
  </div>
</div>

  <form action="action.php?action=REGISTER_PAYMENT&ua_id=<?php echo $ua_id; ?>" method="POST">
  <div class="container">
    <div class="row">
        <div class="col-md-12 mb-5 mb-md-0">
            <h3 class="mb-3 text-black text-center fuchidori">Choose Payment Method</h3>
            <div class="p-3 p-lg-5 border" style="border-radius:5%;">
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

                <div class="row pt-5">
                    <div class="col-lg-6 form-group">
                        <a href="address.php" name="" class="form-control btn btn-lg btn-block text-dark" style="height:100%; border-radius:50px; border-color:#ff1aff; background-color:#e0e0eb;">
                            <i class="fa fa-hand-o-left fa-fw" aria-hidden="true"></i>  Go Back to Address
                        </a>
                    </div>
                    <div class="col-lg-6 form-group">
                    <button type="submit" name="register_payment" class="form-control btn btn-lg btn-block text-dark" style="height:100%; border-radius:50px; border-color:#ff1aff; background-color:#e0e0eb;">
                      Next   <i class="fa fa-hand-o-right fa-fw" aria-hidden="true"></i>
                    </button>
                    </div>
                </div>

            </div>
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