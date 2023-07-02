<?php

class Order extends DatabaseObject {
    static protected $table_name = "orders";
    static protected $db_columns = ['id', 'book_id', 'user_id', 'quantity', 'reference', 'amount', 'date_time'];

    public $id;
    public $book_id;
    public $user_id;
    public $quantity;
    public $amount;
    public $reference;
    public $date_time;

    public function __construct($args=[]) {
        $this->book_id = $args['book_id'] ?? '';
        $this->user_id = $args['user_id'] ?? '';
        $this->quantity = $args['quantity'] ?? '';
        $this->amount = $args['amount'] ?? '';
        $this->reference = $args['reference'] ?? '';
        $this->date_time = $args['date_time'] ?? '';
    }

    static public function find_by_user_id($id) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE user_id='" . self::$database->escape_string($id) . "'";
        return static::find_by_sql($sql);
    }

//    static public function get_book_id($orders) {
//        $book_id = [];
//        foreach ($orders as $order) {
//            $book_id[] = explode(",", $order->book_id);
//        }
//        return $book_id;
//    }
}
