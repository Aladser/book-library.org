<?php

session_start();
require_once(dirname(__DIR__, 2).'/config/ConfigClass.php');

// проверка CSRF-ссылки для авторизации ВК
if($_POST["token"]){
	if($_SESSION["CSRF"] === $_POST["token"]){
		$getVKCodeURL = $CONFIG->getVKCodeURL();
		header("Location: $getVKCodeURL");
	}
	else{
		$CONFIG ->getLogClass()->writeLog('Неудачная попытка входа через ВК: двойная попытка входа');
		$_SESSION['wrong-csrf'] = 1;
		header('Location: /index.php');
	}
}

?>