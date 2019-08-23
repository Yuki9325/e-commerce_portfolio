<?php
require_once "Config.php";

class User extends Config {

    public function login($email, $password) {
        $hashed_password = md5($password);
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$hashed_password'";
        $result = $this->conn->query($sql);
        $user = $result->fetch_assoc();

        if($result == TRUE && $user['permission'] == 'admin') {
            $_SESSION['id'] = $user['user_id'];
            $_SESSION['user'] = $user['first_name']." ".$user['last_name'];
            $this->redirect("admin/dashboard.php");

        } elseif ($result == TRUE && $user['permission'] == 'user') {
            $_SESSION['id'] = $user['user_id'];
            $_SESSION['user'] =$user['first_name']." ".$user['last_name'];
            $this->redirect("user/dashboard.php");
        } else {
            echo "ERROR: " . $this->conn->error;
        }
        $this->conn->close();
    }

    public function show_all() {
        $sql = "SELECT * FROM users
                INNER JOIN user_addresses ON users.user_id = user_addresses.user_id
                WHERE users.status !='D' AND users.permission = 'user' 
                AND user_addresses.ua_status ='default' ORDER BY users.user_id DESC";
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
        $sql = "SELECT * FROM users WHERE user_id = '$id'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    public function show_address($id) {
        $sql = "SELECT * FROM users
                INNER JOIN user_addresses ON users.user_id = user_addresses.user_id
                WHERE user_addresses.ua_status = 'default' AND users.user_id = '$id'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
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
                    $this->redirect("login.php");
                } else {
                    echo "ERROR: " . $this->conn->error;
                    exit;
                }
            } else {
                echo "email address is already exist.";
            }
        }
        $this->conn->close();
    }

    public function update_profile_photo($id, $profile_photo_filename, $profile_photo_tmpname, $directory) {
        $extension = pathinfo($profile_photo_filename, PATHINFO_EXTENSION);
        $photo_extension = array('png', 'jpg', 'jpeg', 'gif', 'jfif');
        $new_directory = $directory.$profile_photo_filename;

        if(in_array(strtolower($extension), $photo_extension)){
            if(move_uploaded_file($profile_photo_tmpname, $new_directory)){
                $sql = "UPDATE users SET profile_photo = '$new_directory'
                        WHERE user_id = '$id'";
                $result = $this->conn->query($sql);

                if($result == TRUE) {
                    $this->redirect("profile.php");
                }
            }
        }else{
            echo "Invalid File Format";
        }
        $this->conn->close();
    }

    public function edit_profile($id, $user_name, $email, $ua_phone_number, $ua_address, $ua_city, $ua_prefecture, $ua_area, $ua_zip) {
        $sql = "SELECT * FROM user_addresses WHERE ua_phone_number = '$ua_phone_number' AND user_id != '$id'";
        $result = $this->conn->query($sql);
        $result_email = $this->validate_email($email,$id);

        $add_check = $this->address_check($id);
        if($add_check->num_rows == 0){
            $this->create_address($id, $ua_phone_number, $ua_phone_number, $ua_address, $ua_city, $ua_prefecture, $ua_area, $ua_zip);
        }
            if($result->num_rows == 0 AND $result_email->num_rows == 0) {
                $sql = "UPDATE users SET users.first_name = '$user_name[0]',
                        users.last_name = '$user_name[1]', users.email = '$email'
                        WHERE  user_id = '$id'";
                $result = $this->conn->query($sql);

                    if($result == TRUE) {
                        $this->edit_address($id,$ua_phone_number, $ua_address, $ua_city, $ua_prefecture, $ua_area, $ua_zip);

                    } else {
                        echo "ERROR: " . $this->conn->error;
                    }
            }else{
                echo "duplicate phone number";
            }
             $this->conn->close();
    }

    public function address_check($id){
        $sql = "SELECT * FROM user_addresses WHERE user_id = '$id'";
        $result = $this->conn->query($sql);
        return $result;
  
    }

    public function create_address($id, $ua_phone_number, $ua_address, $ua_city, $ua_prefecture, $ua_area, $ua_zip){
        $sql = "INSERT INTO user_addresses (user_id, ua_phone_number, ua_address, 
                ua_city, ua_prefecture, ua_area, ua_zip)
                VALUES ('$id', '$ua_phone_number', '$ua_address', '$ua_city', '$ua_prefecture', '$ua_area', '$ua_zip')";
        $result = $this->conn->query($sql);

        if($result == TRUE) {
            $this->redirect("profile.php");
        } else {
            echo "ERROR: " . $this->conn->error;
            exit;
        }
        $this->conn->close();
    }

    public function validate_email($email,$id) {
        $sql = "SELECT * FROM users WHERE  email = '$email' AND user_id != '$id'";
        $result = $this->conn->query($sql);

        if($result->num_rows == 0){
            return $result;
        }else{
            echo "email duplicarte";
            exit;
        }
    }

    public function edit_address($id,$ua_phone_number,$ua_address, $ua_city, $ua_prefecture, $ua_area, $ua_zip){
        $sql = "UPDATE user_addresses 
                SET ua_phone_number = '$ua_phone_number', ua_address = '$ua_address', ua_city = '$ua_city',
                ua_prefecture = '$ua_prefecture', ua_area = '$ua_area', ua_zip = '$ua_zip'
                WHERE ua_status = 'default' AND user_id = '$id'";
        $result = $this->conn->query($sql);

            if($result == TRUE) {
                $this->redirect("profile.php");
            }else {
                echo "ERROR: " . $this->conn->error;
                exit;
            }
            $this->conn->close();
    }

    public function delete($id) {
        $sql = "UPDATE users SET status = 'D' WHERE user_id ='$id'";
        $result = $this->conn->query($sql);

        if($result == TRUE) {
            $sql = "UPDATE user_addresses SET ua_status = 'delete' WHERE user_id ='$id'";
            $result = $this->conn->query($sql);

            if($result == TRUE) {
                $this->redirect("list.php");
            } else {
                echo "ERROR: " . $this->conn->error;
            }
        } else {
            echo "ERROR: " . $this->conn->error;
        }
        $this->conn->close();
    }

    public function delete_profile_photo($id) {
        $sql = "UPDATE users SET profile_photo = '' WHERE user_id ='$id'";
        $result = $this->conn->query($sql);

        if($result == TRUE) {
            $this->redirect("profile.php");
        } else {
            echo "ERROR: " . $this->conn->error;
            exit;
        }
        $this->conn->close();
    }
}