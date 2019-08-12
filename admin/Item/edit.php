<?php include_once ("../header.php"); ?>

<form action="" method="POST" enctype="multipart/form-data">
        <div class="py-4 mb-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 mr-auto">
                        <a href="posts_table.php" class="btn btn-block border border-dark text-dark" style="text-decoration:none;">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>  Back To Item List
                        </a>
                    </div>

                    <div class="col-md-3">
                        <button type="submit" value="save" name="save" class="btn btn-success btn-block text-white">
                            <i class="fa fa-check" aria-hidden="true"></i>  Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
                <div class="row">
                        <div class="col-md-12">
                            <div class="card-header m-0"><h4>Edit Item</h4></div>
                            <div class="card-block">
                                <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="title" class="form-control" value="<?php echo $get_post_info['item_name']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select name="category" class="form-control" value="<?php echo $get_post_info['cat_name']; ?>">
                                        <?php
                                        foreach ($c_list as $key => $values){
                                            echo "<option value ='".$values['category_id']."'>".$values['cat_name']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group p-3" style="background-color:lightgray;">
                                    <label for="">Image Upload</label><br>
                                    <input type="file" name="post_photo">
                                </div>

                                <div class="form-group">
                                    <label for="">Description</label><br>
                                    <textarea name="comment" id="" cols="80" rows="3" class="form-control"><?php echo $get_post_info['post_comment']; ?></textarea>
                                </div>
                            </div>
                        </div>
                </div>
        </div>
    </form>

<?php include_once ("../footer.php"); ?>