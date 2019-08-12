<?php
require_once "../../classes/Category.php";
$category = new Category;

include_once ("../header.php");

?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h4 class="m-0 font-weight-bold text-center">Categories</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Title</th>
            <th></th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Title</th>
            <th></th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          $get_categories = $category->show_all();
            if($get_categories == TRUE) {
              foreach($get_categories as $key => $row){
          ?>
          <tr>
            <td><?php echo $row['cat_name']; ?></td>
            <td class="text-center">
              <button type="button" class="btn border-secondary text-black edit-cat" data-toggle="modal" data-target="#catEditModal" data-name="<?php echo $row['cat_name']; ?>" 
              data-id="<?php echo $row['category_id']; ?>">
                Edit
              </button>
              <button type="button" class="btn btn-danger text-white delete-cat" data-toggle="modal" data-target="#catDeleteModal" data-id="<?php echo $row['category_id']; ?>">
                Delete
              </button>
            </td>
          </tr>
          <?php
              }
          } else {
            echo "<td colspan='2' class='text-center'>No Category</td>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->
      <div class="modal fade" id="catEditModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-white">
                        <h2 class="modal-title text-black" id="myModalLabel">Edit</h2>
                    </div>
                    <form action="action.php?action=EDIT" method="POST">
                      <div class="modal-body">
                          <h5>Title</h5>
                          <input type="text" class="form-control" id="modal-cat-id" name="cat_name">

                          <input type="hidden" class="form-control" id="modal-cat-id-2" name="category_id">
                      </div>
                      <div class="modal-footer">
                          <button type="submit" name="cancel" class="btn btn-default border" style="font-size:20px;" data-dismiss="modal">Cancel</button>
                          <button type="submit" name="edit" class="btn btn-warning" style="font-size:20px;">Change</button>
                      </div>
                    </form>
                </div>
            </div>
      </div>

      <div class="modal fade" id="catDeleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h2 class="modal-title" id="myModalLabel">Delete</h2>
                    </div>
                    <form action="action.php?action=DELETE" method="POST">
                      <div class="modal-body">
                        <input type="hidden" id="modal-cat-id-3" name="category_id">
                          <h4>Are you sure to delete this category?</h4>
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