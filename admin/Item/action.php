<?php
session_start();
require_once "../../classes/Item.php";

$action = $_GET['action'];
$item = new Item;

if($action == "DELETE" AND isset($_POST['delete'])) {
    $id = $_POST['item_id'];

    $item->delete($id);
}
