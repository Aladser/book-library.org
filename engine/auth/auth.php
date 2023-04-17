<?php

    // проверка куки
    $user = null;
    $userRole = null;
    // авторизация через сессию
    if(isset($_SESSION['db_login'])){
        $user = $_SESSION['db_login'];
        $userRole = 'user';
        $_SESSION['auth'] = 1;
    }
    // авторизация вк через сессию
    elseif(isset($_SESSION['vk_login'])){
        $user = $_SESSION["name"];
        $userRole = 'uservk';
        $_SESSION['auth'] = 1;
    }
    // авторизация пользователя через куки
    elseif(!isset($_SESSION['auth'])){
        $cookieLogin = $_COOKIE["db_login"] ?? null;
        $cookieHash = $_COOKIE["hash"] ?? null;
        // БД
        if(!is_null($cookieLogin) && !is_null($cookieHash)){
            if($CONFIG->getUsersModel()->checkUserHash($cookieLogin, $cookieHash)){
                $user = $cookieLogin;
                $_SESSION['db_login'] = $cookieLogin;
                $_SESSION['hash'] = $cookieHash;
                $userRole = 'user';
                $_SESSION['auth'] = 1;
            }
        }
        // ВК
        elseif(isset($_COOKIE["uservk"])){
            $name = $_COOKIE['vk_login'] ?? null;
            $query = $CONFIG->getDB()->query("select user_name from vk_users where user_login='$name'");
            $user = $query->fetch(PDO::FETCH_ASSOC)['user_name'];
            $userRole = 'uservk';
            $_SESSION['auth'] = 1;
        }
    }

    //****** CSRF *****         
    $token = hash('gost-crypto', random_int(0,999999));
    $_SESSION["CSRF"] = $token;