<?php
require_once "Config.php";

class Category extends Config {

    public function show_all() {
        $sql = "SELECT * FROM categories WHERE cat_status != 'D' AND categories.category_id != 'D' ORDER BY category_id DESC";
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
        $sql = "SELECT * FROM categories WHERE category_id = '$id'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    public function add($cat_name) {
        $sql = "SELECT * FROM categories WHERE cat_name = '$cat_name' AND cat_status != 'D'";
        $result = $this->conn->query($sql);

        if($result->num_rows == 0) {
            $sql = "INSERT INTO categories (cat_name) VALUES ('$cat_name')";
            $result = $this->conn->query($sql);

            if($result == TRUE) {
                $this->redirect("list.php");
            }
        } else {
            echo "this category already exist.";
        }
        $this->conn->close();
    }

    public function edit($cat_name, $id) {
        $sql = "SELECT * FROM categories WHERE cat_name = '$cat_name' AND cat_status != 'D'";
        $result = $this->conn->query($sql);

        if($result->num_rows == 0) {
            $sql = "UPDATE categories SET cat_name = '$cat_name' WHERE category_id = '$id'";
            $result = $this->conn->query($sql);

            if($result == TRUE) {
                $this->redirect("list.php");
            }
        } else {
            echo "this category already exist.";
        }
        $this->conn->close();
    }

    public function delete($id) {
        $sql = "UPDATE categories SET cat_status = 'D' WHERE category_id ='$id'";
        $result = $this->conn->query($sql);

        if($result == TRUE) {
            $this->redirect("list.php");
        } else {
            echo "ERROR: " . $this->conn->error;
        }
        $this->conn->close();
    }
}