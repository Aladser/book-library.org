<?php
use \table_models\UsersModel;

require_once(dirname(__DIR__, 1).'/engine/table_models/UsersModel.php');
require_once(dirname(__DIR__, 1).'/engine/DB.php');

define('LOGS', dirname(__DIR__, 1).'\data\logs.txt');

define('HOST_DB', 'localhost');
define('NAME_DB','galleryDB');
define('USER_DB', 'admin');
define('PASS_DB','@admin@');

$db = new DB(HOST_DB, NAME_DB, USER_DB, PASS_DB);
$usersModel = new UsersModel($db);