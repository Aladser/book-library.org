<?php
require_once(dirname(__DIR__, 2).'/config/config.php');
session_start();
 
$params = array(
	'client_id'     => VK_CLIENT_ID,
	'redirect_uri'  => VK_REDIRECT_URI,
	'response_type' => 'code',
	'scope'         => 'photos,offline',
);
$header = "Location: http://oauth.vk.com/authorize?".http_build_query( $params );

// авторизация вк
if(isset($_GET['reg'])){
	header($header);
}

// аутентификация вк
else{
	if($_SESSION["CSRF"] === $_POST["token"]){
		header($header);
	}
	else{
		$_SESSION['wrong-csrf'] = 1;
		header('Location: /index.php');
	}
}

?>