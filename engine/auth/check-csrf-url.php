<?php

require_once(dirname(__DIR__, 2).'/config/config.php');
session_start();

// проверка CSRF-ссылки для авторизации ВК
if($_POST["token"]){
	if($_SESSION["CSRF"] === $_POST["token"]){
		header("Location: $getVKCodeURL");
	}
	else{
		$logs->writeLog('Неудачная попытка входа: двойная попытка входа');
		$_SESSION['wrong-csrf'] = 1;
		header('Location: /index.php');
	}
}

?>