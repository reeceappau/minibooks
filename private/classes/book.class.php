<?php

class Book extends DatabaseObject {

    static protected $table_name = "books";
    static protected $db_columns = ['id', 'title', 'pages', 'year', 'description', 'author', 'quantity'];

    public $id;
    public $title;
    public $pages;
    public $year;
    public $description;
    public $author;
    public $quantity;

    public function __construct($args=[]) {
        $this->title = $args['title'] ?? '';
        $this->pages = $args['pages'] ?? '';
        $this->year = $args['year'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->author = $args['author'] ?? '';
        $this->quantity = $args['quantity'] ?? '';
    }

    public function name(): string {
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

        if(is_blank($this->quantity)) {
            $this->errors[] = "Quantity cannot be blank.";
        } elseif (!has_length_greater_than($this->quantity, 1)) {
            $this->errors[] = "Quantity cannot be less than one";
        }
    }

}

