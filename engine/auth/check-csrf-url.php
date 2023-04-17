<?php

require_once(dirname(__DIR__, 2).'/config/config.php');
session_start();

// $_POST["token"] = 1;
if($_SESSION["CSRF"] === $_POST["token"]){
	header("Location: $getVKCodeURL");
}
else{
	$_SESSION['wrong-csrf'] = 1;
	header('Location: /index.php');
}

?>