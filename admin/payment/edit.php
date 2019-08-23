<?php
$id = $_GET['id'];
require_once "../../classes/Payment.php";
$payment = new Payment;
$row = $payment->show_one($id);
?>

<div class="modal-body">
    <h5>Method</h5>
    <input type="hidden" name="payment_id" value="<?php echo $id; ?>">
    <input type="text" name="payment_name" class="form-control" value="<?php echo $row['payment_name']; ?>">
</div>

<div class="modal-footer">
    <button type="submit" name="cancel" class="btn btn-default border" style="font-size:20px;"
        data-dismiss="modal">Cancel</button>
    <button type="submit" name="edit" class="btn btn-secondary" style="font-size:20px;">Change</button>
</div>