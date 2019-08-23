<?php
session_start();
require_once "../../classes/Category.php";

$action = $_GET['action'];
$category = new Category;

if($action == "ADD" AND isset($_POST['add'])) {
    $cat_name = $_POST['cat_name']; 

    $category->add($cat_name);
}

if($action == "EDIT" AND isset($_POST['edit'])) {
    $cat_name = $_POST['cat_name'];
    $id = $_POST['category_id'];

    // print_r($cat_name);
    // print_r($id);

    $category->edit($cat_name, $id);
}

if($action == "DELETE" AND isset($_POST['delete'])) {
    $id = $_POST['category_id'];

    $category->delete($id);
}