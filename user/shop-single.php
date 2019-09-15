<?php
$id = $_GET['id'];
include_once("header.php");

require_once "../classes/Item.php";
$item = new Item;

require_once "../classes/Shop.php";
$shop = new Shop;
$check_fav = $shop->check_fav($_SESSION['id'], $id);

?>
		<section class="section">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-6 my-5">
            <?php
              $item = $item->show_one($id);
              if($item == TRUE) {
                    echo "<img src='../admin/item/".$item['item_photo']."' class='img-fluid' alt='item_photo'></a>";
            ?>
    			</div>
    			<div class="col-lg-6 product-details pl-md-5 mb-5">
            <h1 class="text-left fuchidori m-0 mt-5 mb-3"><?php echo $item['item_name']; ?></h1>
            <h3 class="text-left mb-3"><?php echo '¥ '.number_format($item['item_price']); ?></h3>

            <div class="form-group col-md-6 mb-5 text-left pl-0">
              <?php if($item['item_qty'] == TRUE) {
              ?>
            <p class="">Quantity: 

              <select name="item_qty" id="quantity" class="form-control">
                  <?php
                      for($count = 1; $count <= $item['item_qty']; $count++){
                  ?>
                  <option value="<?php echo $count; ?>"><?php echo $count;?>
                  </option>
                  <?php
                      }
                  ?>
              </select>
                  <?php
                    }else{
                  ?>
                  <h3 class="text-danger">
                    OUT OF STOCK
                    </h3>
                  <?php
                    }
                  ?>
            </p>
            </div>

            <div class="form-group text-center d-flex">
              <?php
                  if($check_fav == TRUE){
              ?> 
              <form action="action.php?action=ADD_FAV&id=<?php echo $id; ?>" method="POST">
                <button type="submit" name="add_fav" class="p-3" style="border-radius:50px; border-color:#ff1aff; background-color:#e0e0eb;">
                <i class="fa fa-heartbeat" style="color:#ff1aff;" aria-hidden="true"></i>
                  Add to Favorite List
                </button>
              </form>
              <?php
                }else{
              ?>
              <form action="action.php?action=DELETE_FAV&id=<?php echo $id; ?>" method="POST">
                <button type="submit" name="delete_fav" class="p-3" style="border-radius:50px; border-color:#ff1aff; background-color:#e0e0eb;">
                <i class="fa fa-heart-o" style="color:#ff1aff;" aria-hidden="true"></i>
                  Favorited
                </button>
              </form>
              <?php
                }
              ?>

              <?php
                if($item['item_qty'] == TRUE) {
              ?>
              <div class="form-group text-center ml-3">
              <form action="action.php?action=ADD_CART&id=<?php echo $id; ?>" method="POST">
                <input type="hidden" name="item_qty" id="get_qty" min="1" max="<?php echo $item['item_qty']; ?>" value="1">
                <a href="cart.php?id=<?php echo $id; ?>" style="text-decoration:none;">
                  <button type="submit" name="add_cart" class="p-3" style="border-radius:50px; border-color:#ff1aff; background-color:#e0e0eb;">
                    <i class="fa fa-shopping-cart" style="color:#ff1aff;" aria-hidden="true"></i>
                    Add to Cart
                  </button>
                </a>
              </form>
              </div>
            <?php
              } else {
            ?>
              <div class="form-group text-center ml-3">
              <form action="action.php?action=ここに何か入れる&id=<?php echo $id; ?>" method="POST">
                <input type="hidden" name="item_qty" id="get_qty" min="1" max="<?php echo $item['item_qty']; ?>" value="1">
                <a href="cart.php?id=<?php echo $id; ?>" style="text-decoration:none;">
                  <button type="submit" name="add_cart" class="p-3" style="border-radius:50px; border-color:#ff1aff; background-color:#e0e0eb;">
                  <i class="fa fa-bell-o" style="color:#ff1aff;" aria-hidden="true"></i>
                    Alert me when you restock
                  </button>
                </a>
              </form>
              </div>
            <?php
              }
            ?>
            </div>
            
            <div class="description">
              <p><?php echo $item['item_description']; ?></p>
            </div>
    		</div>
    	</div>
    </section>
    <?php
              }
    ?>

<?php include_once("footer.php"); ?>