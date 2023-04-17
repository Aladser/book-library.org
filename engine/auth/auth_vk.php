<?php

session_start();
require_once(dirname(__DIR__, 2).'/config/ConfigClass.php');

// получение access_token
if(isset($_GET['code'])){
	$params = $CONFIG->getVKAccessToken($_GET['code']);
	$vkToken = $params['vktoken'];
	// запись токена в БД
	$query = $CONFIG->getDB()->query("select count(*) as count from config where name='vktoken'");
	$isVKToken = $query->fetch(PDO::FETCH_ASSOC)['count'] === 1;
	if($isVKToken){
		$rslt = $CONFIG->getDB()->exec("update config set value='$vkToken' where name='vktoken'");
	}
	else{
		$rslt = $CONFIG->getDB()->exec("insert into config(name, value) values('vktoken', '$vkToken')");
	}

	if($rslt !== 1){
		throw new Exception('Ошибка добавления access_token в БД');
	}
	// запись id в сессию
	else{
		$_SESSION['vk_login'] = $params['vkid'];
		$_SESSION['vktoken'] = $params['vktoken'];
	}
}

// провека наличия vk_login в сессии или куки
$vkId = null;
if(isset($_SESSION['vk_login'])){
	$vkToken = $_SESSION['vktoken'];
	$vkId = $_SESSION['vk_login'];
}
elseif(isset($_COOKIE['vk_login'])){
	$query = $db->query("select value as vktoken from config where name='vktoken'");
	$vkToken = $query->fetch(PDO::FETCH_ASSOC)['vktoken'];
	$vkId = $_COOKIE['vk_login'];
}

// получение информации о пользователе
if($vkId){
	$params = array(
		'v' => ConfigClass::VK_VERSION, // Версия API
		'access_token' => $vkToken, // Токен
		'user_ids' => $vkId, // ID пользователей
		'fields' => 'photo_100,about' // Список опциональных полей https://vk.com/dev/objects/user
	);

	if (!$content = @file_get_contents('https://api.vk.com/method/users.get?' . http_build_query($params))) {
		$error = error_get_last();
		throw new Exception('HTTP request failed. Error: ' . $error['message']);
	}
	$response = json_decode($content);
	if (isset($response->error)) {
		var_dump($response->error);
		exit;
	}

	$_SESSION['auth'] = 1;
	$response = $response->response;
	// добавление пользователя вк в БД, если не существует
	foreach ($response as $userItem) {
		$_SESSION['name'] = $userItem->first_name.' '.$userItem->last_name;
		$isUser = $CONFIG->getDB()->query("select count(*) as count from vk_users where user_login='$vkId'");
		$isUser = $isUser->fetch(PDO::FETCH_ASSOC)['count'] === 1;
		if(!$isUser){
			$name = $_SESSION['name'];
			$rslt = $CONFIG->getDB()->exec("insert into vk_users(user_login, user_name) values('$vkId', '$name')");
		}
	}

	setcookie('uservk', 1, time()+60*60*24, '/');
	setcookie('vk_login', $_SESSION['vk_login'], time()+60*60*24, '/');
}

header('Location: /index.php');