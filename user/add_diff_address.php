<?php
include_once("header.php");

$address = $user->show_address($_SESSION['id']);
?>

<div class="row">
    <div class="col-md-2"></div>

    <div class="col-md-8 my-5">
        <h3 class="m-2 text-center fuchidori">Addtional Address</h3>
        <div class="card-block">
            <?php
                if(isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger'>". $_SESSION['error']."</div>";
                    unset($_SESSION['error']);
                }
            ?>
            <form action="action.php?action=ADD_DIFF_ADDRESS&id=<?php echo $_SESSION['id']; ?>" method="POST">
                <div class="form-group">
                    <label class="m-0" style="font-size:20px;">Name</label>
                    <input type="text" name="user_name" class="form-control">
                </div>
                <div class="form-group">
                    <label class="m-0" style="font-size:20px;">Phone Number</label>
                    <input type="text" name="ua_phone_number" class="form-control">
                </div>
                <div class="form-group">
                    <label style="font-size:20px;">Address</label>
                        <div class="pb-3">
                            <label class="m-0">Street Address</label>
                            <input type="text" name="ua_address" class="mb-3 col-md-5 form-control">
                            
                            <label class="m-0">City</label>
                            <input type="text" name="ua_city" class="mb-3 col-md-5 form-control">
                            
                            <label class="m-0">Prefecture</label>
                            <input type="text" name="ua_prefecture" class="mb-3 col-md-5 form-control">
                            
                            <div class="form-group">
                            <label class="m-0">Delivery Area</label>
                              <select class="col-md-5 form-control" name="ua_area">
                                <option value="0">Please Select</option>
                                <option value="Honsyu">Honsyu</option>
                                <option value="Shikoku, Kyusyu">Shikoku, Kyusyu</option>
                                <option value="Okinawa">Okinawa</option>
                                <option value="Hokkaido">Hokkaido</option>
                              </select>
                                <p class="text-danger">To know the shipping fee, please see the cart calculation.</p>
                            </div>

                            <label class="m-0">Zip Code</label>
                            <input type="text" name="ua_zip" class="mb-3 col-md-5 form-control">
                        </div>
                </div>
                <div class="form-group">
                    <button type="submit" name="add_diff_address" class="form-control btn btn-lg btn-block text-dark" style="height:100%; border-radius:50px; border-color:#ff1aff; background-color:#ff1aff;">Add</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="col-md-2"></div>
</div>

<?php include_once("footer.php"); ?>