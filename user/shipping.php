<?php
include_once("header.php");

$address = $user->show_address($_SESSION['id']);
?>

<div class="box_payment">
    <div class="container text-center">
		<h2>Delivery Address</h2>
		<p class="h2_sub">Please choose your delivery address.</p>
		
        <form name="form1" id="form1" method="post" action="?" autocomplete="off">      		
			<table class="table table-bordered">
				<tbody>
					<tr style="border:solid #ff1aff 3px;">
                        <td valign="bottom" class="td_delivery_left_02" style="border:solid #ff1aff 3px;">
                                <input type="radio" name="deliv_check" id="chk_id_1" value="-1" checked="checked">
                        </td>
					<td class="td_delivery_right">
						<p class="fll">
                            <?php echo $address['ua_address']; ?><br>
                            <?php echo $address['ua_city']; ?><br>
                            <?php echo $address['ua_prefecture']; ?><br>
                            <?php echo $address['ua_zip']; ?><br>
                            <?php echo $row['first_name']." ".$row['last_name']; ?>
                        </p>
                    </td>
                </tbody>
            </table>
			
			<div class="box_btn cmn_cl">
				<input type="submit" value="次へ" class="btn_buy btn_pink">
				<input type="button" value="戻る" onclick="location.href='https://shop.sanrio.co.jp/cart/index.php';" class="btn_back btn_whi">
			<!-- / .box_btn -->
			</div>
		</form>
		
		<!-- <div class="btn_pink link_arrow_04 btn_delivery_03">
            <a href="/mypage/delivery_addr.php"  class="btn btn-lg btn-block text-dark" style="border-radius:50px; border-color:#ff1aff;" onclick="window.open('/mypage/delivery_addr.php?page=/shopping/deliv.php','新しいお届け先を追加する','width=1000, menubar=no, toolbar=no, scrollbars=yes') ; return false; ">
                Ship to Different Address
            </a>
		</div> -->
	
	<!--==== / .box_payment ====-->
    </div>
</div>
<?php
include_once("footer.php");
?>