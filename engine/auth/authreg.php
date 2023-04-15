<?php
require_once(dirname(__DIR__, 2).'/config/config.php');
 
$params = array(
	'client_id'     => VK_CLIENT_ID,
	'redirect_uri'  => VK_REDIRECT_URI,
	'response_type' => 'code',
	'scope'         => 'photos,offline',
);
$urlQuery = http_build_query( $params );