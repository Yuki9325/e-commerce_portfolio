<?php
require_once "Config.php";

class Item extends Config {

    public function show_all() {
        $sql = "SELECT * FROM items 
                JOIN categories ON items.category_id = categories.category_id
                WHERE items.item_status != 'D' AND categories.cat_status != 'D' 
                ORDER BY items.item_id DESC";
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

    public function show_by_category($category) {
        $sql = "SELECT * FROM items 
                JOIN categories ON items.category_id = categories.category_id
                WHERE items.item_status != 'D' AND categories.cat_status != 'D' 
                AND categories.cat_name = '$category'
                ORDER BY items.item_id DESC";
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
        $sql = "SELECT * FROM items WHERE item_id = '$id'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    public function add($item_name, $item_price, $item_qty, $category_id, $item_description, $item_photo_filename, $item_photo_tmpname, $directory) {
        $extension = pathinfo($item_photo_filename, PATHINFO_EXTENSION);
        $photo_extension = array('png', 'jpg', 'jpeg', 'gif', 'jfif');

            if (!empty($item_photo_filename)){
                $new_directory = $directory.$item_photo_filename;

                if(in_array(strtolower($extension), $photo_extension)){
                    if(move_uploaded_file($item_photo_tmpname, $new_directory)){
                        $sql = "INSERT INTO items (item_name, item_price, item_qty, category_id, item_description, item_photo)
                                VALUES ('$item_name', '$item_price', '$item_qty', '$category_id', '$item_description', '$new_directory')";
                        $result = $this->conn->query($sql);

                        if($result == TRUE) {
                            $this->redirect("list.php");
                        }
                    }
                }else{
                    echo "Invalid File Format";
                }   
            }else{
                echo "Please upload with photo.";
            }
            $this->conn->close();
    }

    public function edit($id, $item_name, $item_price, $item_qty, $category_id, $item_description, $item_photo_filename, $item_photo_tmpname, $directory) {
        $sql = "UPDATE items SET item_name ='$item_name', item_price = '$item_price', item_qty = '$item_qty',
                category_id = '$category_id', item_description = '$item_description'
                WHERE item_id = '$id'";
        $result = $this->conn->query($sql);

        if($result == TRUE) {
            $this->redirect("list.php");
        }

        $extension = pathinfo($item_photo_filename, PATHINFO_EXTENSION);
        $photo_extension = array('png', 'jpg', 'jpeg', 'gif', 'jfif');

        if (in_array(strtolower($extension), $photo_extension)){
        $new_directory = $directory.$item_photo_filename;

            if(move_uploaded_file($item_photo_tmpname, $new_directory)){
                $sql = "UPDATE items SET item_name ='$item_name', item_price = '$item_price', item_qty = '$item_qty', 
                        category_id = '$category_id', item_description = '$item_description', item_photo = '$new_directory'
                        WHERE item_id = '$id'";
                $result = $this->conn->query($sql);

                if($result == TRUE) {
                    $this->redirect("list.php");
                }
            }  
        }else{
            echo "Invalid File Format";
        }
        $this->conn->close();
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