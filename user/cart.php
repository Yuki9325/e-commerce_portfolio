<?php
include_once("header.php");

require_once "../classes/Shop.php";
$shop = new Shop;
$show_cart = $shop->show_cart($_SESSION['id']);
$delivery_fee = $shop->cal_shipping($_SESSION['id']);

?>

<div class="py-4">
	<div class="container">
		<div class="row"></div>
	</div>
</div>

<h3 class="mb-5 text-center fuchidori">Cart</h3>

<div class="container">
	<table class="table m-0" id="dataTable" width="100%" cellspacing="0">
		<thead>
			<tr class="text-center" style="border:solid #ff1aff 3px;">
				<td colspan="2">Product</td>
				<td>Price</td>
				<td>Qty</td>
				<td>Total</td>
				<td></td>
			</tr>
		</thead>

		<tbody>
		<?php
			if($show_cart == TRUE) {
			foreach($show_cart as $key => $row){
		?>
			<tr class="text-center" style="border:solid #ff1aff 3px;">
				<td class="text-center">
					<a style="text-decoration:none;" href="shop-single.php?id=<?php echo $row['item_id']; ?>">
						<?php echo "<img src='../admin/item/".$row["item_photo"]."' alt='item_photo' width='150' height='150'>"; ?>
					</a>
				</td>
				<td>
					<?php echo $row['item_name']; ?>
				</td>

				<td><?php echo '¥ '.number_format($row['item_price']); ?></td>

				<td>
				<select name="item_qty" class="form-control cartitem_qty" data-id="<?php echo $row['cartitem_id'];?>"">
						<?php
							for($count = 1; $count <= $row['item_qty']; $count++){
						?>
						<option value="<?php echo $count; ?>"
							<?php if($count == $row['cartitem_qty']) echo "selected"; ?>>
							<?php echo $count; ?>
						</option>
						<?php
							}
						?>
				</select>
				<input type="hidden" class="item_id_<?php echo $row['cartitem_id']; ?>" value="<?php echo $row['item_id']; ?>">
				<input type="hidden" class="cartitem_id_<?php echo $row['cartitem_id']; ?>" value="<?php echo $row['cartitem_id']; ?>">
				</td>

				<td><?php echo '¥ '.number_format($row['cartitem_price']); ?></td>

				<td>
					<form action="action.php?action=DELETE_CART&id=<?php echo $row['item_id']; ?>" method="POST">
						<button type="submit" name="delete_cart" class="btn btn-block text-dark"><i class="fa fa-times" aria-hidden="true"></i></button>
					</form>
				</td>
			</tr>
		<?php
			}
		?>
		</tbody>
	</table>

	<div class="row justify-content-end">
		<div class="card col-md-6 mt-5 mr-3" style="background:#e0e0eb; border:solid #ff1aff 3px;">
			<div class="text-right">
				<div class="cart-total my-3">
					<h3 class="text-center mb-5">Cart Totals</h3>
					<p class="">
						<span class="col-md-6" style="font-size:20px;">Subtotal</span>
						<span class="col-md-6" style="font-size:20px;"><?php echo '¥ '.number_format($cartitem_price); ?></span>
					</p>
					<p class="">
						<span class="col-md-6" style="font-size:20px;">Delivery</span>
						<span class="col-md-6" style="font-size:20px;"><?php echo '¥ '.number_format($delivery_fee); ?></span>
					</p>
					<hr class="background-color:#ff1aff;">
					<p class="">
						<span class="col-md-6" style="font-size:20px;">Total</span>
						<span class="col-md-6" style="font-size:20px;"><?php echo '¥ '.number_format($cartitem_price+$delivery_fee); ?></span>
					</p>
				</div>
					<a href="checkout.php" name="proceed_order" class="form-control btn btn-block text-dark mb-3" style="border-radius:50px; border-color:#ff1aff; background-color:#e0e0eb;">
						Proceed to Checkout
					</a>
			</div>
		</div>
	</div>
	<?php
	} else {
		echo "<tbody><tr><td colspan='6' class='text-center' style='border:solid #ff1aff 3px; font-size:50px;'>No Item Inside the Cart<br><i class='fa fa-frown-o' aria-hidden='true'></i></td></tr></tbody></table>";
	}
	?>
</div>

<div class="py-4">
	<div class="container">
		<div class="row"></div>
	</div>
</div>

<?php include_once ('footer.php');?>