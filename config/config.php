<?php
use \table_models\UsersModel;

require_once(dirname(__DIR__, 1).'/engine/table_models/UsersModel.php');
require_once(dirname(__DIR__, 1).'/engine/DB.php');

define('LOGS', dirname(__DIR__, 1).'\data\logs.txt');

define('HOST_DB', 'localhost');
define('NAME_DB','book-library');
define('USER_DB', 'admin');
define('PASS_DB','@admin@');

define('VK_CLIENT_ID', 51613986);
define('VK_CLIENT_SECRET','pL1sG0ctOLPHZiiPtZkj');
define('VK_REDIRECT_URI','http://book-library.org/engine/auth/auth_vk.php');
//define('VK_REDIRECT_URI','http://17d9-213-87-102-205.ngrok-free.app/engine/auth/auth_vk.php');
define('VK_VERSION', 5.131);

$db = new DB(HOST_DB, NAME_DB, USER_DB, PASS_DB);
$usersModel = new UsersModel($db);