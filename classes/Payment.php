<?php
require_once "Config.php";

class Payment extends Config {

    public function show_all() {
        $sql = "SELECT * FROM payments ORDER BY payment_id DESC";
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

    public function show_one($id) {
        $sql = "SELECT * FROM payments WHERE payment_id = '$id'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    public function add($payment_name) {
        $sql = "SELECT * FROM payments WHERE payment_name = '$payment_name' AND pay_status != 'D'";
        $result = $this->conn->query($sql);

        if($result->num_rows == 0) {
            $sql = "INSERT INTO payments (payment_name) VALUES ('$payment_name')";
            $result = $this->conn->query($sql);

            if($result == TRUE) {
                $this->redirect("list.php");
            }
        } else {
            echo "this method already exist.";
        }
        $this->conn->close();
    }

    public function edit($payment_name, $id) {
        $sql = "SELECT SELECT * FROM payments WHERE payment_name = '$payment_name' AND pay_status != 'D'";
        $result = $this->conn->query($sql);

        if($result->num_rows == 0) {
            $sql = "UPDATE payments SET payment_name = '$payment_name' WHERE payment_id = '$id'";
            $result = $this->conn->query($sql);

            if($result == TRUE) {
                $this->redirect("list.php");
            }
        } else {
            echo "this method already exist.";
        }
        $this->conn->close();
    }

    public function delete($id) {
        $sql = "UPDATE payments SET pay_status = 'D' WHERE payment_id = '$id'";
        $result = $this->conn->query($sql);

        if($result == TRUE) {
            $this->redirect("list.php");
        } else {
            echo "ERROR: " . $this->conn->error;
        }
        $this->conn->close();
    }
}