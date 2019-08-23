<?php
require_once "../../classes/Payment.php";
$payment = new Payment;

include_once ("../header.php");

?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h4 class="m-0 font-weight-bold text-center">Method of Payments
      <button type="button" class="btn btn-primary text-white float-right" data-toggle="modal" data-target="#paymentAddModal">
        Add Method
      </button>
    </h4>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Method</th>
            <th></th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Method</th>
            <th></th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          $show_methods = $payment->show_all();
            if($show_methods == TRUE) {
              foreach($show_methods as $key => $row){
          ?>
          <tr>
            <td><?php echo $row['payment_name']; ?></td>
            <td class="text-center">
              <button type="button" class="btn btn-secondary text-white edit-payment" data-toggle="modal" data-target="#paymentEditModal" data-name="<?php echo $row['payment_name']; ?>" 
              data-id="<?php echo $row['payment_id']; ?>">
                Edit
              </button>
              <button type="button" class="btn btn-danger text-white delete-payment" data-toggle="modal" data-target="#paymentDeleteModal" data-id="<?php echo $row['payment_id']; ?>">
                Delete
              </button>
            </td>
          </tr>
          <?php
              }
          } else {
            echo "<td colspan='2' class='text-center'>No Method of Payment</td>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->
        <div class="modal fade" id="paymentAddModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h2 class="modal-title" id="myModalLabel">Add</h2>
                    </div>
                      <form action="action.php?action=ADD" method="POST">
                        <div class="modal-body">
                            <h5>Method</h5>
                            <input type="text" class="form-control" id="modal-payment-id" name="payment_name">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="cancel" class="btn btn-default border" style="font-size:20px;" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="add" class="btn btn-primary" style="font-size:20px;">Add</button>
                        </div>
                      </form>
                </div>
            </div>
      </div>

      <div class="modal fade" id="paymentEditModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h2 class="modal-title text-white" id="myModalLabel">Edit</h2>
                    </div>
                    <form action="action.php?action=EDIT" id="editPayment" method="POST">
                      
                    </form>
                </div>
            </div>
      </div>

      <div class="modal fade" id="paymentDeleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h2 class="modal-title" id="myModalLabel">Delete</h2>
                    </div>
                    <form action="action.php?action=DELETE" method="POST">
                      <div class="modal-body">
                        <input type="hidden" id="modal-payment-id-2" name="payment_id">
                          <h4>Are you sure to delete this method?</h4>
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