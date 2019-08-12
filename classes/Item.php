<?php
require_once "Config.php";

class Item extends Config {
    public function show_all() {
        $sql = "SELECT * FROM items 
                JOIN categories ON items.category_id = categories.category_id
                WHERE item_status != 'D' AND categories.cat_status != 'D' 
                ORDER BY item_id DESC";
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

    public function edit() {
    }

    public function delete($id) {
        $sql = "UPDATE items SET item_status = 'D' WHERE item_id ='$id'";
        $result = $this->conn->query($sql);

        if($result == TRUE) {
            $this->redirect("list.php");
        } else {
            echo "ERROR: " . $this->conn->error;
        }
        $this->conn->close();
    }
}