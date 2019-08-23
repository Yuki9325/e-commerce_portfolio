<?php
include_once("header.php");

require_once "../classes/Shop.php";
$shop = new Shop;
$show_fav = $shop->show_fav($_SESSION['id']);

?>

<div class="py-4">
	<div class="container">
		<div class="row"></div>
	</div>
</div>

<h3 class="mb-5 text-center fuchidori">Favorites List</h3>

<div class="container">
    <div class="card mb-4" style="background:#e0e0eb; border-color:#ff1aff;">
    <div class="card-body p-0">
        <div class="table-responsive">
        <table class="table m-0" id="dataTable" width="100%" cellspacing="0">
            <tbody>
            <?php
                if($show_fav == TRUE) {
                foreach($show_fav as $key => $row){
            ?>
            <tr style="border:solid #ff1aff 3px;">
                <td class="text-center">
                    <a href="shop-single.php?id=<?php echo $row['item_id']; ?>">
                        <?php echo "<img src='../admin/item/".$row["item_photo"]."' alt='item_photo' width='150' height='150'>"; ?>
                    </a>
                </td>
                <td><?php echo $row['item_name']; ?><br><?php echo $row['item_price']; ?></td>
                <td class="text-center">
                    <form action="action.php?action=DELETE_FAV&from=FAV_LIST&id=<?php echo $row['item_id']; ?>" method="POST">
						<button type="submit" name="delete_fav" class="btn btn-block text-dark"><i class="fa fa-times" aria-hidden="true"></i></button>
					</form>
                </td>
            </tr>
            <?php
                }
            } else {
                echo "<td colspan='3' class='text-center' style='font-size:50px;'>No Favorite<br><i class='fa fa-frown-o' aria-hidden='true'></i></td>";
            }
            ?>
            </tbody>
        </table>
        </div>
    </div>
    </div>
</div>

<?php include_once("footer.php"); ?>