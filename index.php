<?php 
    require_once('config/config.php');
    session_start();
    // проверка куки
    $user = null;
    $userRole = null;
    // авторизация через сессию
    if(isset($_SESSION['login'])){
        $user = $_SESSION['login'];
        $userRole = $usersModel->getUserRole($user);
    }
    // авторизация вк через сессию
    elseif(isset($_SESSION['userid'])){
        $user = $_SESSION['first_name'].' '.$_SESSION['last_name'];
        $userRole = 'uservk';
        $_SESSION['auth'] = 1;
    }
    // авторизация пользователя из БД/ВК через куки
    elseif(!isset($_SESSION['auth'])){
        $cookieLogin = $_COOKIE["login"] ?? null;
        $cookieHash = $_COOKIE["hash"] ?? null;
        // БД
        if(!is_null($cookieLogin) && !is_null($cookieHash)){
            if($usersModel->checkUserHash($cookieLogin, $cookieHash)){
                $user = $cookieLogin;
                $_SESSION['login'] = $cookieLogin;
                $_SESSION['hash'] = $cookieHash;
                $userRole = $usersModel->getUserRole($cookieLogin);
                $_SESSION['auth'] = 1;
            }
        }// ВК
        elseif(isset($_COOKIE["uservk"])){
            $cookieName = $_COOKIE["name"] ?? null;
            $user = $cookieName;
            $userRole = 'uservk';
            $_SESSION['auth'] = 1;
        }
    }

    //****** токены *****         
    $token = hash('gost-crypto', random_int(0,999999));
    $_SESSION["CSRF"] = $token;
?>
    <link rel="stylesheet" href="public_html/css/reset_cs.css">
    <link rel="stylesheet" href="public_html/css/general.css">
    <link rel="stylesheet" href="public_html/css/modal.css">
    <link rel="stylesheet" href="public_html/css/header.css">
    <link rel="stylesheet" href="public_html/css/login.css">
    <link rel="stylesheet" href="public_html/css/main-view.css">

<?php
    include 'views/login_view.php'; 
    include 'views/main_view.php';
?>

    <script type='text/javascript' src='public_html/js/login.js'></script>

