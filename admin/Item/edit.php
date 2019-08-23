<?php
$id = $_GET['id'];
require_once "../../classes/Item.php";
$item = new Item;
$row = $item->show_one($id);

require_once "../../classes/Category.php";
$category = new Category;

?>

<div class="modal-body">
<input type="hidden" name="item_id" value="<?php echo $id; ?>">
    <label for="">Name</label>
        <input type="text" name="item_name" class="form-control" value="<?php echo $row['item_name']; ?>"><br>

        <label for="">Price</label>
        <input type="text" name="item_price" class="form-control" value="<?php echo $row['item_price']; ?>"><br>

        <label for="">Stock</label>
        <input type="text" name="item_qty" class="form-control" value="<?php echo $row['item_qty']; ?>"><br>

    <label for="">Category</label>
        <select name="category_id" class="form-control">
            <?php
                $show_cat = $category->show_all();
                foreach ($show_cat as $key => $value) {
            ?>
            <option value="<?php echo $value['category_id']; ?>"
                <?php if($row['category_id'] == $value['category_id']) echo "selected"; ?>>
                <?php echo $value['cat_name']; ?>
            </option>
            <?php
                }
            ?>
        </select><br>

    <div class="form-group">
        <label for="">Description</label><br>
        <textarea name="item_description" id="" cols="80" rows="3" class="form-control"><?php echo $row['item_description']; ?></textarea>
    </div><br>

    <div class="form-group p-3" style="background-color:lightgray;">
        <label for="">Image Upload</label><br>
        <input type="file" name="item_photo">
    </div>
</div>

<div class="modal-footer">
    <button type="submit" name="cancel" class="btn btn-default border" style="font-size:20px;"
        data-dismiss="modal">Cancel</button>
    <button type="submit" name="edit" class="btn btn-secondary" style="font-size:20px;">Change</button>
</div>