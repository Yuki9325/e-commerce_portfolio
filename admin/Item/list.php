<?php
require_once "../../classes/Item.php";
$item = new Item;

include_once ("../header.php");

?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h4 class="m-0 font-weight-bold text-center">Item Table</h6>
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
            <td><?php echo $row['item_photo']; ?></td>
            <td><?php echo $row['item_name']; ?></td>
            <td><?php echo $row['item_price']; ?></td>
            <td><?php echo $row['item_qty']; ?></td>
            <td><?php echo $row['cat_name']; ?></td>
            <td class="text-center">
              <a class="btn btn-primary btn-block text-white" href="<?php echo $row['item_id']; ?>">
                Item Page
              </a>
              <a class="btn border-secondary btn-block text-black" href="<?php echo $row['item_id']; ?>">
                Edit
              </a>
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