<?php include_once("header.php"); ?>

<div class="py-4">
      <div class="container">
        <div class="row"></div>
      </div>
    </div>
<div class="container">
  <div class="row">
    <div class="col-md-12 mb-5 mb-md-0">
        <h3 class="mb-3 text-center text-black fuchidori">Order History</h3>
        <div class="p-3 p-lg-5 border">
            <button type="button" class="btn btn-primary text-white ship-order" data-toggle="modal" data-target="#orderShipModal" data-id="<?php echo $row['order_id']; ?>">
                Received Item
            </button>
            <button type="button" class="btn btn-primary text-white ship-order" data-toggle="modal" data-target="#orderShipModal" data-id="<?php echo $row['order_id']; ?>">
                Item Not Received
            </button>
            <button type="button" class="btn btn-primary text-white ship-order" data-toggle="modal" data-target="#orderShipModal" data-id="<?php echo $row['order_id']; ?>">
                Request for Return & Refund
            </button>


        </div>
    </div>
</div>
</div>

<?php include_once("footer.php"); ?>