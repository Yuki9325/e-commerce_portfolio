<?php
session_start();
require_once "../../classes/Payment.php";

$action = $_GET['action'];
$payment = new Payment;

if($action == "ADD" AND isset($_POST['add'])) {
    $payment_name = $_POST['payment_name'];

    $payment->add($payment_name);
}

if($action == "EDIT" AND isset($_POST['edit'])) {
    $payment_name = $_POST['payment_name'];
    $id = $_POST['payment_id'];

    $payment->edit($payment_name, $id);
}

if($action == "DELETE" AND isset($_POST['delete'])) {
    $id = $_POST['payment_id'];

    $payment->delete($id);
}