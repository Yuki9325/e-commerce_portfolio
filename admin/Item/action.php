<?php
session_start();
require_once "../../classes/Item.php";

$action = $_GET['action'];
$item = new Item;

if($action == "ADD" AND isset($_POST['add'])) {
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];
    $item_qty = $_POST['item_qty'];
    $category_id = $_POST['category_id'];
    $item_description = $_POST['item_description'];
    $item_photo_filename = $_FILES['item_photo']['name'];
    $item_photo_tmpname = $_FILES['item_photo']['tmp_name'];
    $directory = "images/";

    $item->add($item_name, $item_price, $item_qty, $category_id, $item_description, $item_photo_filename, $item_photo_tmpname, $directory);
}
if($action == "EDIT" AND isset($_POST['edit'])) {
    $id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];
    $item_qty = $_POST['item_qty'];
    $category_id = $_POST['category_id'];
    $item_description = $_POST['item_description'];
    $item_photo_filename = $_FILES['item_photo']['name'];
    $item_photo_tmpname = $_FILES['item_photo']['tmp_name'];
    $directory = "images/";

    $item->edit($id, $item_name, $item_price, $item_qty, $category_id, $item_description, $item_photo_filename, $item_photo_tmpname, $directory);
}

if($action == "DELETE" AND isset($_POST['delete'])) {
    $id = $_POST['item_id'];

    $item->delete($id);
}
