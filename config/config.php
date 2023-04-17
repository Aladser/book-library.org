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

// запрос получения ВК-кода
$getVKCodeParams = array(
	'client_id'     => VK_CLIENT_ID,
	'redirect_uri'  => VK_REDIRECT_URI,
	'response_type' => 'code',
	'scope'         => 'photos,offline',
);
$getVKCodeURL = "http://oauth.vk.com/authorize?".http_build_query( $getVKCodeParams );

function GetVKAccessToken($code){
	$params = array(
		'client_id'     => VK_CLIENT_ID,
		'client_secret' => VK_CLIENT_SECRET,
		'code'          => $code,
		'redirect_uri'  => VK_REDIRECT_URI
	);
	if (!$content = @file_get_contents('https://oauth.vk.com/access_token?' . http_build_query($params))) {
		$error = error_get_last();
		throw new Exception('HTTP request failed. Error: ' . $error['message']);
	}

	$response = json_decode($content);
	if (isset($response->error)) {
		throw new Exception('При получении токена произошла ошибка. Error: ' . $response->error . '. Error description: ' . $response->error_description);
	}

	return ['vktoken'=>$response->access_token, 'vkid'=>$response->user_id];
}