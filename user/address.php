<?php
include_once("header.php");

$choose_address = $user->choose_address($_SESSION['id']);

?>
<div class="py-4">
  <div class="container">
    <div class="row"></div>
  </div>
</div>

<form action="payment.php" method="POST">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-5 mb-md-0">
        <h3 class="mb-3 text-black text-center fuchidori">Shipping Address</h3>
        <div class="p-3 p-lg-5 border" style="border-radius:5%;">

          <table class="table table-bordered border text-center" style="border-color:#ff1aff;">
            <?php
              if($choose_address == TRUE) {
                foreach($choose_address as $key => $row) {
            ?>
            <tr class="text-center" style="border:solid #ff1aff 3px;">
              <td><input class="pt-5" type="radio" name="ua_id" value="<?php echo $row['ua_id']; ?>" required></td>
                <td style="font-size:20px;"><?php echo $row['ua_first_name']." ".$row['ua_last_name']."<br>".$row['ua_phone_number']."<br>".$row['ua_address']." ".$row['ua_prefecture']."<br>".$row['ua_area']."<br>".$row['ua_zip']; ?></td>
            </tr>
            <?php
                }
              }
            ?>
          </table>

          <a href="add_diff_address.php" class="mb-3 p-2 form-control btn btn-lg btn-block text-dark" style="height:100%; border-radius:50px; border-color:#ff1aff; background-color:#e0e0eb;">
            Add Different Address
          </a>

            <div class="row">
              <div class="col-lg-6 form-group">
                  <a href="cart.php" name="" class="form-control btn btn-lg btn-block text-dark" style="height:100%; border-radius:50px; border-color:#ff1aff; background-color:#e0e0eb;">
                  <i class="fa fa-hand-o-left fa-fw" aria-hidden="true"></i>  Go Back to Cart
                  </a>
              </div>
              <div class="col-lg-6 form-group">
                  <button type="submit" name="ship_add" class="form-control btn btn-lg btn-block text-dark" style="height:100%; border-radius:50px; border-color:#ff1aff; background-color:#e0e0eb;">
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