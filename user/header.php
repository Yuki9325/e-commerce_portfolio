<?php
session_start();
$_SESSION['user'];

require_once "../classes/User.php";
$user = new User; 
$row = $user->show_one($_SESSION['id']);

require_once "../classes/Shop.php";
$shop = new Shop;
$count_fav = $shop->count_fav($_SESSION['id']);
$count_cart = $shop->count_cart($_SESSION['id']);
$show_cart = $shop->show_cart($_SESSION['id']);


$current_cart_qty = 0;
$cartitem_price = 0;

if(!empty($show_cart)){
  foreach($show_cart as $cart){
      $current_cart_qty += $cart['cartitem_qty'];
    }

    foreach($show_cart as $cart){
      $cartitem_price += $cart['cartitem_price'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Shrikhand&display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>

.dropdown.no-arrow .dropdown-toggle::after {
  display: none;
}

.fuchidori {
  font-weight: bold;
  color: rgba(0, 0, 0, 0);
  text-shadow: 3px 3px 0 #80ff80;
  -webkit-text-stroke: 1px #ff1aff;
  text-stroke: 1px #80aaff;
  padding: 0 0 10px;
}

body {
  font-family: 'Shrikhand', cursive;
  background-color: #e0e0eb;
}

.navbar {
  border-bottom:solid #ff1aff 5px;
}

.nav-link {
  font-size: 20px;
  color: black;
}

.border {
  border: solid #ff1aff 5px!important;
}

.footer-border {
  border-top: solid #ff1aff 5px!important;
}

.btn-social-square {
  display: inline-block;
  text-decoration: none;
  width: 50px;
  margin:2px;
  height: 50px;
  line-height: 50px;
  font-size: 23px;
  color:white;
  border-radius: 12px;
  text-align: center;
  overflow: hidden;
  font-weight: bold;
  transition: .3s;
}

.btn-social-square:hover {
  -webkit-transform: translateY(-5px);
  transform: translateY(-5px);
}

.btn-social-square--twitter {
    background: #22b8ff;
}

.fa-twitter {
    color: white;
    background: #22b8ff;
}

.btn-social-square--instagram .insta {
    position: relative;/*相対配置*/
    display: inline-block;
    width: 50px;/*幅*/
    height: 50px;/*高さ*/
    background: -webkit-linear-gradient(135deg, #427eff 0%, #f13f79 70%) no-repeat;
    background: linear-gradient(135deg, #427eff 0%, #f13f79 70%) no-repeat;/*グラデーション①*/
    overflow: hidden;/*はみ出た部分を隠す*/
    border-radius: 13px;/*角丸に*/
}

.btn-social-square--instagram .insta:before{/*グラデーションを重ねるため*/
  content: '';
  position: absolute;/*絶対配置*/
  top: 23px;/*ずらす*/
  left: -18px;/*ずらす*/
  width: 60px;/*グラデーションカバーの幅*/
  height: 60px;/*グラデーションカバーの高さ*/
  background: -webkit-radial-gradient(#ffdb2c 10%, rgba(255, 105, 34, 0.65) 55%, rgba(255, 88, 96, 0) 70%);
  background: radial-gradient(#ffdb2c 10%, rgba(255, 105, 34, 0.65) 55%, rgba(255, 88, 96, 0) 70%);/*グラデーション②*/
}

.fa-instagram{/*アイコン*/
  position: relative;/*z-indexを使うため*/
  z-index: 2;/*グラデーションより前に*/
  line-height: 50px;/*高さと合わせる*/
  color: white;
  background: -webkit-linear-gradient(135deg, #427eff 0%, #f13f79 70%) no-repeat;
    background: linear-gradient(135deg, #427eff 0%, #f13f79 70%) no-repeat;/*グラデーション①*/
  background: -webkit-radial-gradient(#ffdb2c 10%, rgba(255, 105, 34, 0.65) 55%, rgba(255, 88, 96, 0) 70%);
  background: radial-gradient(#ffdb2c 10%, rgba(255, 105, 34, 0.65) 55%, rgba(255, 88, 96, 0) 70%);/*グラデーション②*/
}

</style>
</head>

  <body>

    <nav class="navbar navbar-expand-sm sticky-top" style="background-color:#e0e0eb;">
        <a href="dashboard.php" class="navbar-logo"><img src="images/jenny.jpg"></a>

        <ul class="navbar-content mr-auto">
          <li class="nav-item d-inline-block mr-5">
            <a href="about.php" class="nav-link">ABOUT</a>
          </li>

          <li class="nav-item dropdown d-inline-block mr-5 no-arrow">
            <a href="" id="navbardrop" data-toggle="dropdown" class="nav-link dropdown-toggle">SHOP</a>
                <div class="dropdown-menu">
                    <a href="shop.php" class="dropdown-item">Show All</a>
                    <a href="shop.php?category=Apparel" class="dropdown-item">Apparel</a>
                    <a href="shop.php?category=Books" class="dropdown-item">Books</a>
                    <a href="shop.php?category=Accessories" class="dropdown-item">Accessories</a>
                    <a href="shop.php?category=Cosmetics" class="dropdown-item">Cosmetics</a>
                    <a href="shop.php?category=Stationaries" class="dropdown-item">Stationaries</a>
                    <a href="shop.php?category=iPhone Cases" class="dropdown-item">iPhone Cases</a>
                    <a href="shop.php?category=Others" class="dropdown-item">Others</a>
                </div>
          </li>
        </ul>

        <ul class="navbar-btn my-0 my-lg-0">
          <a href="fav_list.php" style="text-decoration:none;">
            <button type="submit" class="ml-3 p-3" style="border-radius:50px; border-color:#ff1aff; background-color:#e0e0eb;">
              <i class="fa fa-heartbeat" style="color:#ff1aff;" aria-hidden="true"></i>
              <?php 
                if($count_fav == 0) {
                  echo "0";
                }else{
                  echo $count_fav; 
                }
                ?>
            </button>
          </a>

          <a href="cart.php" style="text-decoration:none;">
            <button type="submit" class="ml-3 p-3" style="border-radius:50px; border-color:#ff1aff; background-color:#e0e0eb;">
              <i class="fa fa-shopping-cart" style="color:#ff1aff;" aria-hidden="true"></i>
              <?php 
                if($current_cart_qty == 0) {
                  echo "0";
                }else{
                  echo $current_cart_qty; 
                }
                ?>
            </button>
          </a>

          <li class="nav-item dropdown d-inline-block p-3 no-arrow">
            <?php
              if($row['profile_photo'] != null){
                echo "<img class='rounded-circle' id='userDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' style='width:70px; height:70px;' 
                src='".$row['profile_photo']."'>";
              }else{
                echo "<img class='rounded-circle' id='userDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' style='width:70px; height:70px;' 
                src='images/profile.png'>";
              } ?>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="profile.php">Profile</a>
              <a class="dropdown-item" href="order_history.php">Order History</a>
              <a class="dropdown-item" href="../logout.php">Logout</a>
            </div>
          </li>

        </ul>
    </nav>

    <div class="py-2">
      <div class="container">
        <div class="row"></div>
      </div>
    </div>