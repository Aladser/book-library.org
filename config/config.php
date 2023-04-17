<?php
use \table_models\UsersModel;

require_once(dirname(__DIR__, 1).'/engine/table_models/UsersModel.php');
require_once(dirname(__DIR__, 1).'/engine/DB.php');
require_once(dirname(__DIR__, 1).'/engine/MyLogClass.php');

class ConfigClass{
	private $LOGS;
	private $HOST_DB = 'localhost';
	private $NAME_DB = 'book-library';
	private $USER_DB = 'admin';
	private $PASS_DB = '@admin@';
	private $VK_CLIENT_ID = 51613986;
	private $VK_CLIENT_SECRET = 'pL1sG0ctOLPHZiiPtZkj';
	private $VK_REDIRECT_URI = 'http://book-library.org/engine/auth/auth_vk.php';
	//const VK_REDIRECT_URI = 'https://2ebd-213-87-102-205.ngrok-free.app/engine/auth/auth_vk.php';
	const VK_VERSION = 5.131;
	private $DB;
	private $USERS_MODEl;
	private $getVKCodeURL;

	function __construct(){
		$this->LOGS = dirname(__DIR__, 1).'\data\logs.txt';
		$this->DB = new DB($this->HOST_DB, $this->NAME_DB, $this->USER_DB, $this->PASS_DB);
		$this->USERS_MODEl = new UsersModel($this->DB);
		$this->LOGS = new MyLogClass($this->LOGS);
		// запрос получения ВК-кода
		$vkCodeParams = array(
			'client_id'     => $this->VK_CLIENT_ID,
			'redirect_uri'  => $this->VK_REDIRECT_URI,
			'response_type' => 'code',
			'scope'         => 'photos,offline',
		);
		$this->getVKCodeURL = "http://oauth.vk.com/authorize?".http_build_query( $vkCodeParams );
	}

	function getDB(){
		return $this->DB;
	}

	function getUsersModel(){
		return $this->USERS_MODEl;
	}

	function getLogClass(){
		return $this->LOGS;
	}

	function getVKCodeURL(){
		return $this->getVKCodeURL;
	}

	function getVKAccessToken($code){
		$params = array(
			'client_id'     => $this->VK_CLIENT_ID,
			'client_secret' => $this->VK_CLIENT_SECRET,
			'code'          => $code,
			'redirect_uri'  => $this->VK_REDIRECT_URI
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
}

$CONFIG = new ConfigClass();