<?php
$id = $_GET['id'];
require_once "../../classes/Category.php";
$category = new Category;
$row = $category->show_one($id);
?>

<div class="modal-body">
    <h5>Title</h5>
    <input type="hidden" name="category_id" value="<?php echo $id; ?>">
    <input type="text" name="cat_name" class="form-control" value="<?php echo $row['cat_name']; ?>">
</div>

<div class="modal-footer">
    <button type="submit" name="cancel" class="btn btn-default border" style="font-size:20px;"
        data-dismiss="modal">Cancel</button>
    <button type="submit" name="edit" class="btn btn-secondary" style="font-size:20px;">Change</button>
</div>