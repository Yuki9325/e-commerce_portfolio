<?php
require_once "../../Classes/User.php";
$user = new User;

include_once ("../header.php");

?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h4 class="m-0 font-weight-bold text-center">User Table</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th></th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th></th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          $get_users = $user->show_all();
            if($get_users == TRUE) {
              foreach($get_users as $key => $row){
          ?>
          <tr>
            <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td class="text-center">
              <button type="button" class="btn btn-danger text-white delete-user" data-toggle="modal" data-target="#userDeleteModal" data-id="<?php echo $row['user_id']; ?>">
                Delete
              </button>
            </td>
          </tr>
          <?php
              }
          } else {
            echo "<td colspan='3' class='text-center'>No User</td>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

      <div class="modal fade" id="userDeleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h2 class="modal-title" id="myModalLabel">Delete</h2>
                    </div>
                    <form action="action.php?action=DELETE" method="POST">
                      <div class="modal-body">
                        <input type="hidden" id="modal-user-id" name="user_id">
                          <h4>Are you sure to delete this user?</h4>
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