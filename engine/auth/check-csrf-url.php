<?php

require_once(dirname(__DIR__, 2).'/config/config.php');
require_once(dirname(__DIR__, 1).'/log.php');
session_start();

// проверка CSRF сслыки для авторизации ВК
if($_POST["token"]){
	if($_SESSION["CSRF"] === $_POST["token"]){
		header("Location: $getVKCodeURL");
	}
	else{
		writeLog('Неудачная попытка входа: двойная попытка входа');
		$_SESSION['wrong-csrf'] = 1;
		header('Location: /index.php');
	}
}

?>