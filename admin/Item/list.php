<?php
include_once ("../header.php");

require_once "../../classes/Item.php";
$item = new Item;

require_once "../../classes/Category.php";
$category = new Category;

?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h4 class="m-0 font-weight-bold text-center">Item Table
      <button type="button" class="btn btn-primary text-white float-right" data-toggle="modal" data-target="#itemAddModal" data-id="<?php echo $row['item_id']; ?>">
        Add Items
      </button>
    </h4>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th></th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Category</th>
            <th></th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th></th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Category</th>
            <th></th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          $get_items = $item->show_all();
            if($get_items == TRUE) {
              foreach($get_items as $key => $row){
          ?>
          <tr>
            <td class="text-center"><?php echo "<img src='".$row["item_photo"]."' alt='item_photo' width='150' height='150'>"; ?></td>
            <td><?php echo $row['item_name']; ?></td>
            <td><?php echo '¥ '.number_format($row['item_price']); ?></td>

            <?php if($row['item_qty'] > 0) { 
              echo "<td>".$row['item_qty']."</td>";
            } else {
              echo "<td class='text-danger'>NO STOCK</td>";
            }
            ?>

            <td><?php echo $row['cat_name']; ?></td>
            <td class="text-center">
              <a class="btn btn-primary btn-block text-white" href="<?php echo $row['item_id']; ?>">
                Item Page
              </a>
              <button type="button" class="btn btn-secondary btn-block text-white edit-item" data-toggle="modal" data-target="#itemEditModal" data-id="<?php echo $row['item_id']; ?>">
                Edit
              </button>
              <button type="button" class="btn btn-danger btn-block text-white delete-item" data-toggle="modal" data-target="#itemDeleteModal" data-id="<?php echo $row['item_id']; ?>">
                Delete
              </button>
            </td>
          </tr>
          <?php
              }
          } else {
            echo "<td colspan='6' class='text-center'>No Item</td>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

        <div class="modal fade" id="itemAddModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h2 class="modal-title text-white" id="myModalLabel">Add</h2>
                    </div>
                    <form action="action.php?action=ADD" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <h5>Name</h5>
                              <input type="text" class="form-control" id="modal-cat-id" name="item_name"><br>
                            <h5>Price</h5>
                              <input type="text" class="form-control" id="modal-cat-id" name="item_price"><br>
                            <h5>Stock</h5>
                              <input type="text" class="form-control" id="modal-cat-id" name="item_qty"><br>
                            <h5>Category</h5>
                              <select id="category" name="category_id" class="form-control">
                                <?php
                                  $show_cat = $category->show_all();
                                  if($show_cat == TRUE) {
                                    foreach ($show_cat as $key => $row) {
                                        echo "<option value ='".$row['category_id']."'>".$row['cat_name']."</option>";
                                    }
                                  }
                                ?>
                              </select><br>
                            <h5>Description</h5>
                              <textarea name="item_description" id="" cols="80" rows="3" class="form-control"></textarea><br>
                              
                            <div class="form-group p-3" style="background-color:lightgray;">
                                <label for="">Image Upload</label><br>
                                <input type="file" name="item_photo">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="cancel" class="btn btn-default border" style="font-size:20px;" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="add" class="btn btn-primary" style="font-size:20px;">Add</button>
                        </div>
                    </form>
                </div>
            </div>
      </div>

      <div class="modal fade" id="itemEditModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h2 class="modal-title text-white" id="myModalLabel">Edit</h2>
                    </div>
                    <form action="action.php?action=EDIT" id="editItem" method="POST" enctype="multipart/form-data">
                      <!-- form is inside edit.php -->
                    </form>
                </div>
            </div>
      </div>

      <div class="modal fade" id="itemDeleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h2 class="modal-title text-white" id="myModalLabel">Delete</h2>
                    </div>
                    <form action="action.php?action=DELETE" method="POST">
                      <div class="modal-body">
                        <input type="hidden" id="modal-item-id" name="item_id">
                          <h4>Are you sure to delete this item?</h4>
                      </div>
                      <div class="modal-footer">
                          <button type="submit" name="cancel" class="btn btn-default border" style="font-size:20px;" data-dismiss="modal">Cancel</button>
                          <button type="submit" name="delete" class="btn btn-danger" style="font-size:20px;">Delete</button>
                      </div>
                    </form>
                </div>
            </div>
      </div>

<?php include_once("../footer.php"); ?>