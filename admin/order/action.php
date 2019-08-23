<?php
session_start();
require_once "../../classes/Order.php";

$action = $_GET['action'];
$order = new Order;


//admin button
if($action == "C_T_PAYMENT" AND isset($_POST['c_t_payment'])){
    $id = $_GET['id'];
    $order->confirm_the_payment($id);
}

if($action == "SHIPPED" AND isset($_POST['shipped'])){
    $id = $_GET['id'];
    $shipped_date = date('Y-m-d');
    $order->shipped($id, $shipped_date);
}

if($action == "CANCELLED" AND isset($_POST['cancelled'])){
    $id = $_GET['id'];
    $order->cancelled($id);
}

if($action == "C_T_PAYMENT" AND isset($_POST['c_t_payment'])){
    $id = $_GET['id'];
    $order->confirm_the_payment($id);
}

if($action == "C_T_PAYMENT" AND isset($_POST['c_t_payment'])){
    $id = $_GET['id'];
    $order->confirm_the_payment($id);
}

if($action == "C_T_PAYMENT" AND isset($_POST['c_t_payment'])){
    $id = $_GET['id'];
    $order->confirm_the_payment($id);
}