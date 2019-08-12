<?php
session_start();
require_once "../../classes/User.php";

$action = $_GET['action'];
$user = new User;

if($action == "DELETE" AND isset($_POST['delete'])){
    $id = $_POST['user_id'];

    $user->delete($id);
}