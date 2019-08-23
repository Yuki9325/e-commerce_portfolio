<?php
include_once("header.php");

require_once "../classes/Item.php";
$item = new Item;

require_once "../classes/Shop.php";
$shop = new Shop;

if(isset($_POST['search'])){
    $keyword = $_POST['search'];
	$search = $shop->search($keyword);
}

?>

<div class="py-4">
	<div class="container">
		<div class="row"></div>
	</div>
</div>

<div class="container-fluid">
	<h3 class="text-center fuchidori">Shop</h3>
	<div class="row">
		<form action="" method="POST" class="col-md-11 text-right mb-5">
			<i class="fa fa-search" aria-hidden="true"></i>
			<input type="text" name="search" class="border-top-0 border-left-0 border-right-0 rounded-0" style="border-color:#ff1aff; background-color:#e0e0eb;">
		</form>
	</div>


	<div class="row">
			<?php
				if(isset($search)) {
					foreach($search as $key => $row){
			?>
				<div class="col-md-3 col-xs-12 text-center mb-5">
				<?php echo "<a href='shop-single.php?id=".$row["item_id"]."'>
							<img src='../admin/item/".$row["item_photo"]."' alt='item_photo' width='300' height='300'>
							</a>"; ?>
				</div>
			<?php
					}
				}else{
					if(isset($_GET['category'])){
						$get_items = $item->show_by_category($_GET['category']);
					}else{
						$get_items = $item->show_all();
					}
				if($get_items == TRUE) {
				foreach($get_items as $key => $row){
			?>
			<div class="col-md-3 col-xs-12 text-center mb-5">
			<?php echo "<a href='shop-single.php?id=".$row["item_id"]."'>
						<img src='../admin/item/".$row["item_photo"]."' alt='item_photo' width='300' height='300'>
						</a>"; ?>
			</div>
		
			<?php
					}
				}
			}
			?>		
	</div>
</div>

<div class="py-4">
	<div class="container">
		<div class="row"></div>
	</div>
</div>

<?php include_once("footer.php"); ?>