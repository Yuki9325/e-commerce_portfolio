<?php
session_start();
require_once "classes/User.php";

$action = $_GET['action'];
$user = new User;

if($action == "LOGIN" AND isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user->login($email, $password);
}

if($action == "ADD" AND isset($_POST['add'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatpassword = $_POST['repeatpassword'];
    $permission = 'user';

    $user->add($first_name, $last_name, $email, $password, $repeatpassword, $permission);
}