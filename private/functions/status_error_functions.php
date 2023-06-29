<?php

function require_login() {
    global $session;
    if(!$session->is_logged_in()) {
        redirect_to(url_for('/login.php'));
    }
}

function require_admin() {
    global $session;
    if(!$session->is_admin()) {
        redirect_to(url_for('/index.php'));
    }
}

function display_errors($errors=array()) {
    $output = '';
    if(!empty($errors)) {
        $output .= "<div class=\"alert alert-danger\">";
        $output .= "Please fix the following errors:";
        $output .= "<ul class=\"list-group\">";
        foreach($errors as $error) {
            $output .= "<li class=\"list-group-item\">" . h($error) . "</li>";
        }
        $output .= "</ul>";
        $output .= "</div>";
    }
    return $output;
}

function display_session_message() {
    global $session;
    $msg = $session->message();
    if(isset($msg) && $msg != '') {
        $session->clear_message();
        return '<div class="alert alert-success">' . h($msg) . '</div>';
    }
}


