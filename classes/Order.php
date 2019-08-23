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

    public function confirm_the_payment($id) {
        $sql = "UPDATE checkouts SET checkout_status = 'confirmed' WHERE checkout_id = '$id'";
        $result = $this->conn->query($sql);

        if($result == TRUE){
            $this->redirect("list.php");
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

    public function returned($id) {
        $sql = "UPDATE checkouts SET checkout_status = 'returned' WHERE checkout_id = '$id'";
        $result = $this->conn->query($sql);

        if($result == TRUE){
            $this->redirect("list.php");
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
        $sql=
        "SELECT sum(purchased_price) as 'total' FROM checkouts WHERE cart_id = '$cart_id'";
        $result = $this->conn->query($sql);

        $total = $result->fetch_assoc();
        return $total['total'];
    }
}