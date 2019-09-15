<?php
include_once("header.php");

$address = $user->show_address($_SESSION['id']);
?>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-7 my-5">
        <h3 class="m-2 text-center fuchidori">Edit Profile</h3>
        <div class="card-block">
            <?php
                if(isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger'>". $_SESSION['error']."</div>";
                    unset($_SESSION['error']);
                }
            ?>
            <form action="action.php?action=EDIT" method="POST">
                <div class="form-group">
                    <label class="m-0" style="font-size:20px;">Name</label>
                    <input type="text" name="user_name" class="form-control" value="<?php echo $row['first_name']." ".$row['last_name']; ?>">
                </div>
                <div class="form-group">
                    <label class="m-0" style="font-size:20px;">Email</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $row['email']; ?>">
                </div>
                <div class="form-group">
                    <label class="m-0" style="font-size:20px;">Phone Number</label>
                    <input type="text" name="ua_phone_number" class="form-control" value="<?php echo $address['ua_phone_number']; ?>">
                </div>
                <div class="form-group">
                    <label style="font-size:20px;">Default Address</label>
                        <div class="pb-3">
                            <label class="m-0">Street Address</label>
                            <input type="text" name="ua_address" class="mb-3 col-md-5 form-control" value="<?php echo $address['ua_address']; ?>">
                            
                            <label class="m-0">City</label>
                            <input type="text" name="ua_city" class="mb-3 col-md-5 form-control" value="<?php echo $address['ua_city']; ?>">
                            
                            <label class="m-0">Prefecture</label>
                            <input type="text" name="ua_prefecture" class="mb-3 col-md-5 form-control" value="<?php echo $address['ua_prefecture']; ?>">
                            
                            <div class="form-group">
                            <label class="m-0">Delivery Area</label>
                              <select class="col-md-5 form-control" name="ua_area">
                                <option value="0">Please Select</option>
                                <option <?php echo $address['ua_area'] == 'Honsyu' ? 'selected' : '';?> value="Honsyu">Honsyu</option>
                                <option <?php echo $address['ua_area'] == 'Shikoku, Kyusyu' ? 'selected' : '';?> value="Shikoku, Kyusyu">Shikoku, Kyusyu</option>
                                <option <?php echo $address['ua_area'] == 'Okinawa' ? 'selected' : '';?> value="Okinawa">Okinawa</option>
                                <option <?php echo $address['ua_area'] == 'Hokkaido' ? 'selected' : '';?> value="Hokkaido">Hokkaido</option>
                              </select>
                                <p class="text-danger">To know the shipping fee, please see the cart calculation.</p>
                            </div>

                            <label class="m-0">Zip Code</label>
                            <input type="text" name="ua_zip" class="mb-3 col-md-5 form-control" value="<?php echo $address['ua_zip']; ?>">
                        </div>
                </div>
                <div class="form-group">
                    <button type="submit" name="edit" class="form-control btn btn-lg btn-block text-dark" style="height:100%; border-radius:50px; border-color:#ff1aff; background-color:#ff1aff;">Update</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-2 my-5">
        <h3 class="m-2 mb-5 text-center fuchidori">Your Avatar</h3>
            <?php
                if($row['profile_photo'] != null){
                    echo "<img src='".$row['profile_photo']."' alt='avator' class='img-fluid d-block rounded-circle'>";
                }else{
                    echo "<img src='images/profile.png' alt='avator' class='img-fluid d-block rounded-circle'>";
                }
            ?>
        <div class="mt-5">
            <?php
                if($row['profile_photo'] != null){
            ?>
                    <button type='button' class='btn btn-block mb-1' id='edit-profile-photo' style='background-color:#e0e0eb; font:#e0e0eb; border-color:#ff1aff;' data-toggle='modal' data-target='#editPhotoModal' data-id='<?php echo $row['user_id']; ?>'>Edit Image</button>
                    <form action='action.php?action=DELETE_PHOTO' method='POST'>
                        <button type='submit' name='delete_profile_photo' class='btn btn-block' style='font:#e0e0eb; border-color:#ff1aff;'>Delete Image</button>
                    </form>
            <?php
                }else{
                    echo "<button type='button' class='btn btn-block mb-1' id='edit-profile-photo' style='background-color:#e0e0eb; font:#e0e0eb; border-color:#ff1aff;' data-toggle='modal' data-target='#editPhotoModal'>Add Image</button>";
                    echo "<button disabled type='submit' name='delete_profile_photo' class='btn btn-block' style='font:#b; border-color:#ff1aff;'>Delete Image</button>";
                }
            ?>
        </div>
    </div>
    <div class="col-md-1"></div>
</div> <!-- end of row -->

<div class="modal fade" id="editPhotoModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-color:#ff1aff;">
                <h2 class="modal-title" id="myModalLabel">Change Photo</h2>
            </div>
            <form action="action.php?action=UPDATE_PHOTO" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group p-3 m-0" style="background-color:lightgray;">
                        <label for="">Image Upload</label><br>
                        <input type="file" name="profile_photo">
                    </div>
                </div>
                <div class="modal-footer" style="border-color:#ff1aff;">
                    <button type="submit" name="cancel" class="btn" style="font-size:20px; border-color:#ff1aff;">Cancel</button>
                    <button type="submit" name="update_profile_photo" class="btn" style="font-size:20px; border-color:#ff1aff;">Apply</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once("footer.php"); ?>