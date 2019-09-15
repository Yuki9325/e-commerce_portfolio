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

    echo "hi";
    exit;
}

if($action == "DELIVERED" AND isset($_POST['delivered'])){
    $id = $_GET['id'];
    $order->delivered($id);
}

if($action == "ACCEPT_RETURN" AND isset($_POST['accept_return'])){
    $id = $_GET['id'];
    $order->accept_return($id);
}

if($action == "RECEIVED_AND_REFUND" AND isset($_POST['received_and_refund'])){
    $id = $_GET['id'];
    $order->refund($id);
}

if($action == "C_T_PAYMENT" AND isset($_POST['c_t_payment'])){
    $id = $_GET['id'];
    $order->confirm_the_payment($id);
}

if($action == "CONFIRMED_AND_REFUND" AND isset($_POST['confirmed_and_refund'])){
    $id = $_GET['id'];
    $order->refund($id);
}
