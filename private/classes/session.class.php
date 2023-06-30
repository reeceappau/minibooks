<?php

class Session {

    public $user_id;
    public $username;
    public $role;
    private $last_login;

    public const MAX_LOGIN_AGE = 60*60*24*3; // 3 days

    public function __construct() {
        session_start();
        $this->check_stored_login();
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
        unset($this->user_id);
        unset($this->username);
        unset($this->last_login);
        unset($this->role);
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
}

?>