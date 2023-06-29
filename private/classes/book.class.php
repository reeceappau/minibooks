<?php

class Book extends DatabaseObject {

    static protected $table_name = "books";
    static protected $db_columns = ['id', 'title', 'pages', 'year', 'description', 'author'];

    public $id;
    public $title;
    public $pages;
    public $year;
    public $description;
    public $author;

    public function __construct($args=[]) {
        $this->title = $args['title'] ?? '';
        $this->pages = $args['pages'] ?? '';
        $this->year = $args['year'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->author = $args['author'] ?? '';
    }

    public function name() {
        return $this->title . " by " . $this->author;
    }

    protected function validate() {
        $this->errors = [];

        if(is_blank($this->title)) {
            $this->errors[] = "Title cannot be blank.";
        } elseif (!has_length($this->title, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "Title must be between 2 and 255 characters.";
        }

        if(is_blank($this->author)) {
            $this->errors[] = "Author cannot be blank.";
        } elseif (!has_length($this->author, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "Author must be between 2 and 255 characters.";
        }

        if(is_blank($this->year)) {
            $this->errors[] = "Year cannot be blank.";
        } elseif (!has_length($this->year, array('exact' => 4))) {
            $this->errors[] = "Year must be in the format, YYYY";
        } elseif ($this->year > date("Y")) {
            $this->errors[] = "Year cannot be greater than current year";
        }

        if(is_blank($this->pages)) {
            $this->errors[] = "Pages cannot be blank.";
        }

        if(is_blank($this->description)) {
            $this->errors[] = "Please add some description.";
        }
    }

//    protected function validate() {
//        $this->errors = [];
//
//        if(is_blank($this->first_name)) {
//            $this->errors[] = "First name cannot be blank.";
//        } elseif (!has_length($this->first_name, array('min' => 2, 'max' => 255))) {
//            $this->errors[] = "First name must be between 2 and 255 characters.";
//        }
//
//        if(is_blank($this->last_name)) {
//            $this->errors[] = "Last name cannot be blank.";
//        } elseif (!has_length($this->last_name, array('min' => 2, 'max' => 255))) {
//            $this->errors[] = "Last name must be between 2 and 255 characters.";
//        }
//
//        if(is_blank($this->email)) {
//            $this->errors[] = "Email cannot be blank.";
//        } elseif (!has_length($this->email, array('max' => 255))) {
//            $this->errors[] = "Last name must be less than 255 characters.";
//        } elseif (!has_valid_email_format($this->email)) {
//            $this->errors[] = "Email must be a valid format.";
//        }
//
//        if(is_blank($this->username)) {
//            $this->errors[] = "Username cannot be blank.";
//        } elseif (!has_length($this->username, array('min' => 8, 'max' => 255))) {
//            $this->errors[] = "Username must be between 8 and 255 characters.";
//        } elseif (!has_unique_username($this->username, $this->id ?? 0)) {
//            $this->errors[] = "Username not allowed. Try another.";
//        }
//
//        if($this->password_required) {
//            if(is_blank($this->password)) {
//                $this->errors[] = "Password cannot be blank.";
//            } elseif (!has_length($this->password, array('min' => 12))) {
//                $this->errors[] = "Password must contain 12 or more characters";
//            } elseif (!preg_match('/[A-Z]/', $this->password)) {
//                $this->errors[] = "Password must contain at least 1 uppercase letter";
//            } elseif (!preg_match('/[a-z]/', $this->password)) {
//                $this->errors[] = "Password must contain at least 1 lowercase letter";
//            } elseif (!preg_match('/[0-9]/', $this->password)) {
//                $this->errors[] = "Password must contain at least 1 number";
//            } elseif (!preg_match('/[^A-Za-z0-9\s]/', $this->password)) {
//                $this->errors[] = "Password must contain at least 1 symbol";
//            }
//
//            if(is_blank($this->confirm_password)) {
//                $this->errors[] = "Confirm password cannot be blank.";
//            } elseif ($this->password !== $this->confirm_password) {
//                $this->errors[] = "Password and confirm password must match.";
//            }
//        }
//
//        return $this->errors;
//    }

}

