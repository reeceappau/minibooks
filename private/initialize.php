<?php
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
const PUBLIC_PATH = PROJECT_PATH . '/public';
const SHARED_PATH = PRIVATE_PATH . '/shared';

$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);

//database credentials
require_once('db_credentials.php');

// php functions
require_once('functions/functions.php');
require_once('functions/status_error_functions.php');
require_once('functions/database_functions.php');
require_once('functions/validation_functions.php');

//load classes
require_once('classes/session.class.php');
require_once('classes/databaseobject.class.php');
require_once('classes/user.class.php');
require_once('classes/book.class.php');

$database = db_connect();
DatabaseObject::set_database($database);

$session = new Session;
