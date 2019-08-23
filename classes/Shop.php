<?php
require_once "Item.php";

class Shop extends Item {

    public function show_fav($user_id) {
        $sql = "SELECT * FROM fav_lists WHERE user_id = '$user_id' AND fav_status != 'D'";
        $result = $this->conn->query($sql);

        if($result->num_rows > 0) {
            $sql = "SELECT * FROM fav_lists 
                    JOIN items ON fav_lists.item_id = items.item_id
                    WHERE fav_lists.user_id = '$user_id'
                    ORDER BY fav_lists.fav_id DESC";
            $result = $this->conn->query($sql);

            $list = array();
            while($row = $result->fetch_assoc()){
                $list[]= $row;
            }
            return $list;
        }
    }

    public function add_fav($user_id, $item_id) {
        $sql = "SELECT * FROM fav_lists WHERE item_id = '$item_id'";
        $result = $this->conn->query($sql);

        if($result->num_rows == 0) {
            $sql = "INSERT INTO fav_lists (user_id, item_id)
                    VALUES ('$user_id', '$item_id')";
            $result = $this->conn->query($sql);

            if($result == TRUE) {
                $this->redirect("shop-single.php?id=".$item_id);
            } else {
                echo "ERROR: " . $this->conn->error;
                exit;
            }
        }
        $this->conn->close();
    }

    public function check_fav($user_id, $item_id) {
        $sql = "SELECT * FROM fav_lists WHERE user_id = '$user_id' AND item_id = '$item_id'
                AND fav_status != 'D'";
        $result = $this->conn->query($sql);

        if($result->num_rows == 0) {
            return TRUE;
        }else{
            return FALSE;
        }
        $this->conn->close();
    }

    public function delete_fav($user_id, $item_id, $from_favlist) {
        $sql = "DELETE FROM fav_lists WHERE user_id = '$user_id' AND item_id = '$item_id'";
        $result = $this->conn->query($sql);
        
            if($result == TRUE) {
                if($from_favlist != null){
                    $this->redirect("fav_list.php");
                }else{
                    $this->redirect("shop-single.php?id=".$item_id);
                }
            }else{
                echo "ERROR: " . $this->conn->error;
                exit;
            }
            $this->conn->close();
    }

    public function count_fav($user_id) {
        $sql = "SELECT COUNT(*) AS count FROM fav_lists WHERE user_id = '$user_id'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['count'];
    }

    public function show_cart($user_id) {
        $sql = "SELECT * FROM carts WHERE user_id = '$user_id' AND cart_status != 'closed'";
        $result = $this->conn->query($sql);

        if($result->num_rows > 0) {
            $sql ="SELECT * FROM carts WHERE user_id = '$user_id' ORDER BY cart_id DESC LIMIT 1";
            $result = $this->conn->query($sql);
            $cart = $result->fetch_assoc();
            $cart_id = $cart['cart_id'];

            $sql = "SELECT * FROM carts JOIN cart_items ON cart_items.user_id = carts.user_id 
                    JOIN items ON cart_items.item_id = items.item_id
                    WHERE cart_items.user_id = '$user_id'
                    AND carts.cart_status != 'closed'
                    AND cart_items.cart_id = '$cart_id'
                    ORDER BY cart_items.cartitem_id DESC";
            $result = $this->conn->query($sql);

            $list = array();
            while($row = $result->fetch_assoc()){
                $list[]= $row;
            }
            return $list;
        }
    }

    public function add_cart($user_id, $item_id, $cartitem_qty) {
        $sql = "SELECT * FROM carts WHERE user_id = '$user_id' AND cart_status != 'closed'";
        $result = $this->conn->query($sql);

        $item = $this->show_one($item_id);
        $cartitem_price = $item['item_price'] * $cartitem_qty;

        if($result->num_rows == 0) {
            $sql = "INSERT INTO carts (user_id) VALUES ('$user_id')";
            $result = $this->conn->query($sql);

            if($result == TRUE) {
                $cart_id = $this->conn->insert_id;
                $result = $this->add_cart_item($cart_id, $user_id, $item_id, $cartitem_qty, $cartitem_price);

                if($result == TRUE) {
                    $this->redirect("shop-single.php?id=".$item_id);
                }else{
                    echo "error";
                }
            }
        }else{
            $row = $result->fetch_assoc();
            $cart_id = $row['cart_id'];
            $result = $this->add_cart_item($cart_id, $user_id, $item_id, $cartitem_qty, $cartitem_price);

            if($result == TRUE) {
                $this->redirect("shop-single.php?id=".$item_id);
            }else{
                echo "error";
            }
        }
        $this->conn->close();
    }

    public function add_cart_item($cart_id, $user_id, $item_id, $cartitem_qty, $cartitem_price) {
        $sql = "INSERT INTO cart_items (cart_id, user_id, item_id, cartitem_qty, cartitem_price)
                VALUES ('$cart_id', '$user_id', '$item_id', '$cartitem_qty', '$cartitem_price')";
        $result = $this->conn->query($sql);

            if($result == TRUE) {
                return TRUE;
        }
    }

    public function delete_cart($user_id, $item_id) {
        $sql = "DELETE FROM cart_items WHERE user_id = '$user_id' AND item_id = '$item_id'";
        $result = $this->conn->query($sql);
                
            if($result == TRUE) {
                $this->redirect("cart.php");
            }else{
                echo "ERROR: " . $this->conn->error;
                exit;
            }
            $this->conn->close();
    }

    public function count_cart($user_id) {
        $sql = "SELECT SUM(cartitem_qty) AS qty FROM cart_items 
        JOIN carts ON cart_items.cartitem_id = carts.cart_id
        WHERE carts.user_id = '$user_id' AND carts.cart_status != 'closed'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();

        if($result == TRUE){
            return $row['qty'];
        }else{
            return 0 ;
        }
        $this->conn->close();
    }

    public function change_qty($qty, $ci_id, $item_id) {
        $item = $this->show_one($item_id);
        $cartitem_price = $item['item_price'] * $qty;
        $sql = "UPDATE cart_items SET cartitem_qty = '$qty', cartitem_price = '$cartitem_price' WHERE cartitem_id = '$ci_id'";
        $result = $this->conn->query($sql);

        if($result == TRUE) {
            return TRUE;
        }
    }

    public function search($keyword) {
        $sql = "SELECT * FROM items JOIN categories ON items.category_id = categories.category_id
                WHERE (item_name LIKE '%$keyword%' OR cat_name LIKE '%$keyword%')
                AND items.item_status != 'D'";
        $result = $this->conn->query($sql);

        $list = array();
        while($search = $result->fetch_assoc()){
            $list[]= $search;
        }
        return $list;
    }

    public function cal_shipping($id) {
        $sql = "SELECT ua_area FROM user_addresses WHERE user_id = '$id'";
        $result = $this->conn->query($sql);
        $area = $result->fetch_assoc();

            switch ($area['ua_area']) {
                case 'Honsyu':
                return 400;
                break;

                case 'Shikoku, Kyusyu':
                return 500;
                break;

                case 'Okinawa':
                return 800;
                break;

                case 'Hokkaido':
                return 800;
                break;
                }
    }

    public function checkout($user_id, $ua_id, $cart_id, $payment_id, $credit_f_name, $credit_l_name, $credit_c_number, $credit_exp_month, $credit_exp_year, $credit_security, $purchased_price, $purchased_date) {
        $sql = "INSERT INTO checkouts (cart_id, ua_id, payment_id, purchased_price, purchased_date)
                VALUES ('$cart_id', '$ua_id', '$payment_id', '$purchased_price', '$purchased_date')";
        $result = $this->conn->query($sql);

        if($result == TRUE) {

            if($payment_id == 4) {
                $sql = "INSERT INTO credit_cards (user_id, credit_f_name, credit_l_name, credit_c_number, credit_exp_month, credit_exp_year, credit_security)
                        VALUES('$user_id', '$credit_f_name', '$credit_l_name', '$credit_c_number', '$credit_exp_month', '$credit_exp_year', '$credit_security')";
                $result = $this->conn->query($sql);

                $sql = "UPDATE checkouts SET checkout_status = 'confirmed' WHERE payment_id = '$payment_id'";
                $result = $this->conn->query($sql);

                $this->change_stock($cart_id);

                        if($result == TRUE) {
                            $sql = "UPDATE carts SET cart_status = 'closed' WHERE cart_id = '$cart_id'";
                            $result = $this->conn->query($sql);

                            if($result == TRUE) {
                                $this->redirect("thankyou.php");
                            } else {
                                echo "ERROR: " . $this->conn->error;
                                exit;
                            }
                        }
            }else {
                $sql = "UPDATE checkouts SET checkout_status = 'pending' WHERE payment_id = '$payment_id'";
                $result = $this->conn->query($sql);
    
                $sql = "UPDATE carts SET cart_status = 'closed' WHERE cart_id = '$cart_id'";
                $result = $this->conn->query($sql);
                $this->change_stock($cart_id);

                    if($result == TRUE) {
                        $this->redirect("thankyou.php");
                    } else {
                        echo "ERROR: " . $this->conn->error;
                        exit;
                    }
            }
                
        } 
        $this->conn->close();
}


    public function change_stock($cart_id){
        $sql = "SELECT * FROM cart_items 
                WHERE cart_id = '$cart_id'";
        $result = $this->conn->query($sql);
        $lists = array();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $lists[] = $row;
            }
        }

        foreach($lists as $list){
            $bought_items = $list['cartitem_qty'];
            $item_id =  $list['item_id'];

            $sql = "UPDATE items SET item_qty = (item_qty - '$bought_items') 
                    WHERE item_id = '$item_id'";
            $result = $this->conn->query($sql);
            
        }

    }

}