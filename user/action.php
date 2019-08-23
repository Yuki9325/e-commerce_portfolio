<?php
session_start();
require_once "../classes/User.php";
require_once "../classes/Shop.php";

$action = $_GET['action'];
$user = new User;
$shop = new Shop;

//profile
if($action == "EDIT" AND isset($_POST['edit'])){
    function split_name($name){
        $name = str_replace('　', ' ', $name);
        $name = trim($name);
        $name = preg_replace('/\s+/', ' ', $name);
        $name = explode(' ',$name);
    
        $first_name = $last_name = null;
    
        if(!empty($name[0])){
            $first_name = $name[0];
        }
    
        if(!empty($name[1])){
            $last_name = $name[1];
        }
    
        return [$first_name, $last_name];
    }

    $id = $_SESSION['id'];
    $user_name = split_name(trim($_POST['user_name']));
    $email = $_POST['email'];
    $ua_phone_number = $_POST['ua_phone_number'];
    $ua_address = $_POST['ua_address'];
    $ua_city = $_POST['ua_city'];
    $ua_prefecture = $_POST['ua_prefecture'];
    $ua_area = $_POST['ua_area'];
    $ua_zip = $_POST['ua_zip'];
    if($ua_area != 0){
        $user->edit_profile($id, $user_name, $email, $ua_phone_number, $ua_address, $ua_city, $ua_prefecture, $ua_area, $ua_zip);
    } else {
        $_SESSION['error'] = "Make sure all the fields are filled.";
        $user->redirect("profile.php");
    }
}

if($action == "UPDATE_PROFILE" AND isset($_POST['update_profile_photo'])){
    $user_name = $_POST['first_name']." ".$POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    $user->update_profile($id, $user_name, $email, $phone_number, $address);
}

if($action == "UPDATE_PHOTO" AND isset($_POST['update_profile_photo'])){
    $id = $_SESSION['id'];
    $profile_photo_filename = $_FILES['profile_photo']['name'];
    $profile_photo_tmpname = $_FILES['profile_photo']['tmp_name'];
    $directory = "images/";

    $user->update_profile_photo($id, $profile_photo_filename, $profile_photo_tmpname, $directory);
}

if($action == "DELETE_PHOTO" AND isset($_POST['delete_profile_photo'])){
    $id = $_SESSION['id'];

    $user->delete_profile_photo($id);
}

//fav list
if($action == "ADD_FAV" AND isset($_POST['add_fav'])){
    $user_id = $_SESSION['id'];
    $item_id = $_GET['id'];

    $shop->add_fav($user_id, $item_id);
}

if($action == "DELETE_FAV" AND isset($_POST['delete_fav'])){
    $user_id = $_SESSION['id'];
    $item_id = $_GET['id'];
    $from_favlist = null;
    if(isset($_GET['from'])){
        $from_favlist = $_GET['from'];
    }

    $shop->delete_fav($user_id, $item_id,$from_favlist);
}

// cart
if($action == "ADD_CART" AND isset($_POST['add_cart'])){
    $user_id = $_SESSION['id'];
    $item_id = $_GET['id'];
    $cartitem_qty = $_POST['item_qty'];

    $shop->add_cart($user_id, $item_id, $cartitem_qty);
}

if($action == "DELETE_CART" AND isset($_POST['delete_cart'])){
    $user_id = $_SESSION['id'];
    $item_id = $_GET['id'];

    $shop->delete_cart($user_id, $item_id);
}

if($action == "CHANGE_QTY") {
    $qty = $_POST['qty'];
    $ci_id = $_POST['ci_id'];
    $item_id = $_POST['item_id'];

    $result = $shop->change_qty($qty, $ci_id, $item_id);
}

//checkout
if($action == "CHECKOUT" AND isset($_POST['checkout'])) {
    $user_id = $_SESSION['id'];
    $ua_id = $_GET['ua_id'];
    $cart_id = $_GET['cart_id'];
    $payment_id = $_POST['payment_id'];
    //credit card info
    $credit_f_name = $_POST['credit_f_name'];
    $credit_l_name = $_POST['credit_l_name'];
    $credit_c_number = $_POST['credit_c_number'];
    $credit_exp_month = $_POST['credit_exp_month'];
    $credit_exp_year = $_POST['credit_exp_year'];
    $credit_security = $_POST['credit_security'];
    $purchased_price = $_POST['cartitem_price'];
    $purchased_date = date('Y-m-d');

    $shop->checkout($user_id, $ua_id, $cart_id, $payment_id, $credit_f_name, $credit_l_name, $credit_c_number, $credit_exp_month, $credit_exp_year, $credit_security, $purchased_price, $purchased_date);

    // if($result == TRUE AND $payment_id == 1) {

    // }
}