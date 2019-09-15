<?php
require_once "Config.php";

class Order extends Config {

    public function show_all() {
        $sql = "SELECT * FROM checkouts
        JOIN user_addresses ON checkouts.ua_id = user_addresses.ua_id
        JOIN users ON user_addresses.user_id = users.user_id
        JOIN cart_items ON checkouts.cart_id = cart_items.cart_id
        JOIN items ON cart_items.item_id = items.item_id
        JOIN payments ON checkouts.payment_id = payments.payment_id
        ORDER BY checkouts.checkout_id DESC";
        $result = $this->conn->query($sql);
    
        if($result->num_rows > 0) {
            $rows = array();
            while($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return false;
        } if($result == FALSE) {
            echo "ERROR: " . $this->conn->error;
        }
        $this->conn->close();
    }

    public function show_order($id) {
        $sql = "SELECT * FROM cart_items JOIN items 
                ON cart_items.item_id = items.item_id
                WHERE cart_id = '$id'";
        $result = $this->conn->query($sql);

        $list = array();
            while($row = $result->fetch_assoc()){
                $list[]= $row;
            }
            return $list;
    }

    public function show_ordered_list($user_id) {
        $sql = "SELECT * FROM checkouts JOIN carts
                ON checkouts.cart_id = carts.cart_id
                WHERE carts.user_id = '$user_id' AND carts.cart_status = 'closed'
                ORDER BY carts.cart_id DESC";
        $result = $this->conn->query($sql);

        $list = array();
            while($row = $result->fetch_assoc()){
                $list[]= $row;
            }
            return $list;
    }

    public function count_waiting_for_payment() {
        $sql = "SELECT COUNT(*) AS count FROM checkouts WHERE checkout_status = 'pending'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    public function count_received_payment() {
        $sql = "SELECT COUNT(*) AS count FROM checkouts WHERE checkout_status = 'confirmed'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    public function count_in_transit() {
        $sql = "SELECT COUNT(*) AS count FROM checkouts WHERE checkout_status = 'shipped'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    public function count_waiting_for_receiving() {
        $sql = "SELECT COUNT(*) AS count FROM checkouts WHERE checkout_status = 'delivered'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    public function count_request_for_return() {
        $sql = "SELECT COUNT(*) AS count FROM checkouts WHERE checkout_status = 'request_for_return'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    public function count_waiting_for_return() {
        $sql = "SELECT COUNT(*) AS count FROM checkouts WHERE checkout_status = 'accept_return'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    public function count_returning() {
        $sql = "SELECT COUNT(*) AS count FROM checkouts WHERE checkout_status = 'return_item'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    public function count_no_item_received() {
        $sql = "SELECT COUNT(*) AS count FROM checkouts WHERE checkout_status = 'no_item_received'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    public function confirm_the_payment($id) {
        $sql = "UPDATE checkouts SET checkout_status = 'confirmed' WHERE checkout_id = '$id'";
        $result = $this->conn->query($sql);

        if($result == TRUE AND isset($_POST['c_t_payment'])){
            $this->redirect("list.php");

        }elseif($result == TRUE AND isset($_POST['paid'])){
            $this->redirect("order_history.php");

        }else{
            echo "ERROR: " . $this->conn->error;
        }
        $this->conn->close();
    }

    public function shipped($id, $shipped_date) {
        $sql = "UPDATE checkouts SET checkout_status = 'shipped', shipped_date = '$shipped_date' WHERE checkout_id = '$id'";
        $result = $this->conn->query($sql);

        if($result == TRUE){
            $this->redirect("list.php");
        }else{
            echo "ERROR: " . $this->conn->error;
        }
        $this->conn->close();
    }

    public function delivered($id) {
        $sql = "UPDATE checkouts SET checkout_status = 'delivered' WHERE checkout_id = '$id'";
        $result = $this->conn->query($sql);

        if($result == TRUE){
            $this->redirect("list.php");
        }else{
            echo "ERROR: " . $this->conn->error;
        }
        $this->conn->close();
    }

    public function accept_return($id) {
        $sql = "UPDATE checkouts SET checkout_status = 'accept return' WHERE checkout_id = '$id'";
        $result = $this->conn->query($sql);

        if($result == TRUE){
            $this->redirect("list.php");
        }else{
            echo "ERROR: " . $this->conn->error;
        }
        $this->conn->close();
    }

    public function refund($id) {
        if(isset($_POST['received_and_refund'])){
            $sql = "UPDATE checkouts SET checkout_status = 'returned' WHERE checkout_id = '$id'";
            $result = $this->conn->query($sql);

                if($result == TRUE){
                    $this->redirect("list.php");
                }

        }elseif(isset($_POST['confirmed_and_refund'])){
            $sql = "UPDATE checkouts SET checkout_status = 'cancelled' WHERE checkout_id = '$id'";
            $result = $this->conn->query($sql);

                if($result == TRUE){
                    $this->redirect("list.php");
                }

        }else{
            echo "ERROR: " . $this->conn->error;
        }
        $this->conn->close();
    }

    public function cancelled($id) {
        $sql = "UPDATE checkouts SET checkout_status = 'cancelled' WHERE checkout_id = '$id'";
        $result = $this->conn->query($sql);

        if($result == TRUE){
            $this->redirect("list.php");
        }else{
            echo "ERROR: " . $this->conn->error;
        }
        $this->conn->close();
    }

    public function get_total_price($cart_id){
        $sql= "SELECT sum(purchased_price) as 'total' FROM checkouts WHERE cart_id = '$cart_id'";
        $result = $this->conn->query($sql);

        $total = $result->fetch_assoc();
        return $total['total'];
    }


    // order history for users

    public function received($id){
        $sql = "UPDATE checkouts SET checkout_status = 'closed' WHERE checkout_id = '$id'";
        $result = $this->conn->query($sql);

        if($result == TRUE){
            $this->redirect("order_history.php");
        }else{
            echo "ERROR: " . $this->conn->error;
        }
        $this->conn->close();
    }

    public function request_for_return($id){
        $sql = "UPDATE checkouts SET checkout_status = 'request for return' WHERE checkout_id = '$id'";
        $result = $this->conn->query($sql);

        if($result == TRUE){
            $this->redirect("order_history.php");
        }else{
            echo "ERROR: " . $this->conn->error;
        }
        $this->conn->close();
    }

    public function returned_item($id){
        $sql = "UPDATE checkouts SET checkout_status = 'returning' WHERE checkout_id = '$id'";
        $result = $this->conn->query($sql);

        if($result == TRUE){
            $this->redirect("order_history.php");
        }else{
            echo "ERROR: " . $this->conn->error;
        }
        $this->conn->close();
    }

    public function no_item_received($id){
        $sql = "UPDATE checkouts SET checkout_status = 'no item received' WHERE checkout_id = '$id'";
        $result = $this->conn->query($sql);

        if($result == TRUE){
            $this->redirect("order_history.php");
        }else{
            echo "ERROR: " . $this->conn->error;
        }
        $this->conn->close();
    }
}