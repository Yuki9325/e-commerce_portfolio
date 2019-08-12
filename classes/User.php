<?php
require_once "Config.php";

class User extends Config {

    public function login($email, $password) {
        $hashed_password = md5($password);
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$hashed_password'";
        $result = $this->conn->query($sql);
        $user = $result->fetch_assoc();

        if($result == TRUE && $user['permission'] == 'admin') {
            $_SESSION['user'] = $user['first_name']." ".$user['last_name'];
            $this->redirect("admin/dashboard.php");

        } elseif ($result == TRUE && $user['permission'] == 'user') {
            $_SESSION['user'] =$user['first_name']." ".$user['last_name'];
            $this->redirect("user/home.php");
        } else {
            echo "ERROR: " . $this->conn->error;
        }
        $this->conn->close();
    }

    public function show_all() {
        $sql = "SELECT * FROM users WHERE status !='D' AND permission = 'user' ORDER BY user_id DESC";
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

    public function add($first_name, $last_name, $email, $password, $repeatpassword, $permission) {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $this->conn->query($sql);
        
        if(empty($password) || empty($repeatpassword)) {
            echo "Please enter your password.";
        }elseif($password !== $repeatpassword) {
            echo "Please type same password.";
        }else{
            if($result->num_rows == 0) {
                $hashed_password = md5($password);
                $sql = "INSERT INTO users(first_name, last_name, email, password, permission)
                        VALUES ('$first_name', '$last_name', '$email', '$hashed_password', '$permission')";
                $result = $this->conn->query($sql);
                
                if($result == TRUE) {
                    $this->redirect("user/home.php");
                } else {
                    echo "ERROR: " . $this->conn->error;
                }
            } else {
                echo "email address is already exist.";
            }
        }
        $this->conn->close();
    }

    public function delete($id) {
        $sql ="UPDATE users SET status = 'D' WHERE user_id ='$id'";
        $result = $this->conn->query($sql);

        if($result == TRUE) {
            $this->redirect("list.php");
        } else {
            echo "ERROR: " . $this->conn->error;
        }
        $this->conn->close();
    }
}