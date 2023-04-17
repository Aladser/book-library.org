<?php

    // проверка куки
    $user = null;
    $userRole = null;
    // авторизация через сессию
    if(isset($_SESSION['login'])){
        $user = $_SESSION['login'];
        $userRole = $usersModel->getUserRole($user);
    }
    // авторизация вк через сессию
    elseif(isset($_SESSION['vkid'])){
        $user = $_SESSION["name"];
        $userRole = 'uservk';
        $_SESSION['auth'] = 1;
    }
    // авторизация пользователя через куки
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
        }
        // ВК
        elseif(isset($_COOKIE["uservk"])){
            $cookieName = $_COOKIE["name"] ?? null;
            $user = $cookieName;
            $userRole = 'uservk';
            $_SESSION['auth'] = 1;
        }
    }

    //****** CSRF *****  
    $wrongCsrf = isset($_SESSION['wrong-csrf']) ? $_SESSION['wrong-csrf'] : null;       
    $token = hash('gost-crypto', random_int(0,999999));
    $_SESSION["CSRF"] = $token;