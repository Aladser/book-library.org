<?php

session_start();

unset($_SESSION['auth']);
unset($_SESSION['vk_login']);
unset($_SESSION['db_login']);
unset($_SESSION['vktoken']);

setcookie("db_login", "", time()-3600, '/');
setcookie('vk_login', "", time()-1000, '/');
setcookie("hash", "", time()-3600, '/');
setcookie('uservk', "", time()-1000, '/');

header('Location: ../../index.php');
