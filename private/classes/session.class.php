<?php

class Session {

    public $user_id;
    public $username;
    public $role;
    public $cart;
    private $last_login;

    public const MAX_LOGIN_AGE = 60*60*24*3; // 3 days

    public function __construct() {
        session_start();
        $this->check_stored_login();
        $this->check_stored_cart();
    }

    public function login($admin) {
        if($admin) {
            // prevent session fixation attacks
            session_regenerate_id();

            $this->user_id = $_SESSION['user_id'] = $admin->id;
            $this->username = $_SESSION['username'] = $admin->username;
            $this->role = $_SESSION['role'] = $admin->role;
            $this->last_login = $_SESSION['last_login'] = time();
        }
        return true;
    }

    public function is_logged_in() {
        return isset($this->user_id) && $this->last_login_is_recent();
    }

    public function is_admin() {
        return $this->role === "admin";
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['last_login']);
        unset($_SESSION['role']);
        unset($_SESSION['message']);
        unset($_SESSION['cart']);
        unset($this->user_id);
        unset($this->username);
        unset($this->last_login);
        unset($this->role);
        unset($this->cart);
        return true;
    }

    //checks if session data is present and assigns them
    private function check_stored_login() {
        if(isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->username = $_SESSION['username'];
            $this->last_login = $_SESSION['last_login'];
            $this->role = $_SESSION['role'];
        }
    }

    private function check_stored_cart() {
        if(isset($_SESSION['cart'])) {
            $this->cart = $_SESSION['cart'];
        }
    }

    public function cart_count() {
        $quantities = array_values($this->cart);
        $count = 0;
        foreach ($quantities as $quantity) {
            $count += $quantity;
        }
        return $count;
    }

    private function last_login_is_recent() {
        if(!isset($this->last_login)) {
            return false;
        } elseif(($this->last_login + self::MAX_LOGIN_AGE) < time()) {
            return false;
        } else {
            return true;
        }
    }

    public function message($msg="") {
        if(!empty($msg)) {
            // Then this is a "set" message
            $_SESSION['message'] = $msg;
            return true;
        } else {
            // Then this is a "get" message
            return $_SESSION['message'] ?? '';
        }
    }

    public function clear_message() {
        unset($_SESSION['message']);
    }

    public function add_to_cart($id, $quantity) {
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($id, $_SESSION['cart'])) {
                // update existing cart item
                $_SESSION['cart'][$id] += (int)$quantity;
                $this->cart = $_SESSION['cart'];
            } else {
                // add new cart item
                $_SESSION['cart'][$id] = (int)$quantity;
                $this->cart = $_SESSION['cart'];
            }
        } else {
            // create new session cart array
            $_SESSION['cart'] = array($id => (int)$quantity);
            $this->cart = $_SESSION['cart'];
        }
    }

    public function update_cart($id, $quantity) {
        $_SESSION['cart'][$id] = (int)$quantity;
        $this->cart = $_SESSION['cart'];
    }

    public function remove_from_cart($id) {
        if (isset($_SESSION['cart']) && isset($_SESSION['cart'][$id])) {
            // Remove the book from the cart
            unset($_SESSION['cart'][$id]);
            unset($this->cart);
        }
    }
}

?>
