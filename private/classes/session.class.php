<?php

class Session {

    public $user_id;
    public $username;
    public $role;
    public $cart;
    public $cart_total = 0;
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
        unset($_SESSION['cart_total']);
        unset($this->user_id);
        unset($this->username);
        unset($this->last_login);
        unset($this->role);
        unset($this->cart);
        unset($this->cart_total);
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
            $this->cart_total = $_SESSION['cart_total'];
        }
    }

    public function cart_count() {
        return count($this->cart);
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

    public function add_to_cart($id, $quantity, $price) {
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($id, $_SESSION['cart'])) {
                // update existing cart item
                $_SESSION['cart'][$id] += (int)$quantity;
                $_SESSION['cart_total'] += $price*$quantity;
                $this->cart = $_SESSION['cart'];
                $this->cart_total = $_SESSION['cart_total'];
            } else {
                // add new cart item
                $_SESSION['cart'][$id] = (int)$quantity;
                $_SESSION['cart_total'] = $price*$quantity;
                $this->cart = $_SESSION['cart'];
                $this->cart_total = $_SESSION['cart_total'];
            }
        } else {
            // create new session cart array
            $_SESSION['cart'] = array($id => (int)$quantity);
            $_SESSION['cart_total'] = $price;
            $this->cart = $_SESSION['cart'];
            $this->cart_total = $_SESSION['cart_total'];
        }
    }

    public function update_cart($id, $quantity, $price) {
        $_SESSION['cart'][$id] = (int)$quantity;
        $previous_total = $this->cart[$id] * $price;
        $_SESSION['cart_total'] = $_SESSION['cart_total'] - $previous_total + ($price*$quantity);
        $this->cart = $_SESSION['cart'];
        $this->cart_total = $_SESSION['cart_total'];
    }

    public function remove_from_cart($id, $price) {
        if (isset($_SESSION['cart']) && isset($_SESSION['cart'][$id])) {
            // update cart total and remove book from cart
            $previous_total = $_SESSION['cart'][$id] * $price;
            $_SESSION['cart_total'] -= $previous_total;
            $this->cart_total = $_SESSION['cart_total'];
            unset($_SESSION['cart'][$id]);
            unset($this->cart[$id]);
        }
    }

    public function delete_cart() {
        unset($_SESSION['cart']);
        unset($_SESSION['cart_total']);
        unset($this->cart);
        unset($this->cart_total);
        return true;
    }
}

?>
