<?php
session_start();
require_once(dirname(__DIR__, 2).'/config/config.php');

$params = array(
	'client_id'     => VK_CLIENT_ID,
	'client_secret' => VK_CLIENT_SECRET,
	'code'          => $_GET['code'],
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

$token = $response->access_token; // Токен
$userId = $response->user_id; // ID авторизовавшегося пользователя
$_SESSION['userid'] = $userId;
	
// Формируем запрос
$params = array(
	'v' => VK_VERSION, // Версия API
	'access_token' => $token, // Токен
	'user_ids' => $userId, // ID пользователей
	'fields' => 'photo_100,about' // Список опциональных полей https://vk.com/dev/objects/user
);
if (!$content = @file_get_contents('https://api.vk.com/method/users.get?' . http_build_query($params))) {
	$error = error_get_last();
	throw new Exception('HTTP request failed. Error: ' . $error['message']);
}
	
$response = json_decode($content);
if (isset($response->error)) {
	throw new Exception('При отправке запроса к API VK возникла ошибка. Error: ' . $response->error . '. Error description: ' . $response->error_description);
}
$response = $response->response;
foreach ($response as $userItem) {
	$_SESSION['first_name'] = $userItem->first_name; // Имя
	$_SESSION['last_name'] = $userItem->last_name; // Фамилия
}

$_SESSION['auth'] = 1;
setcookie('name', $_SESSION['first_name'].' '.$_SESSION['last_name'], time()+60*60*24, '/');
setcookie('uservk', 1, time()+60*60*24, '/');
header('Location: /index.php');