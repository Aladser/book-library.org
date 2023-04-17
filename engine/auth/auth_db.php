<?php

session_start();
require_once(dirname(__DIR__, 2).'/config/config.php');

// функция авторизации
function logIn($usersModel, $login, $saveAuth=false){
    // добавить хэш пользователю
    $usersModel->addUserHash($login); 
    // Ставим куки
    if($saveAuth){
        setcookie('db_login', $login, time()+60*60*24, '/');
        setcookie('hash', $usersModel->getUserHash($login), time()+60*60*24, '/');
    }
    $_SESSION['auth'] = 1;
    $_SESSION['db_login'] = $login;
}

// аутентификация
if(isset($_POST['auth']))
{
    if($_POST['token'] === $_SESSION['CSRF']){
        $login = $_POST['db_login'];
        if($CONFIG->getUsersModel()->existsUser($login))
        {
            if($CONFIG ->getUsersModel()->isAuthentication($login, $_POST['password'])){
                $saveAuth = isset($_POST['saveAuth']) ? true : false;
                logIn($CONFIG->getUsersModel(), $login, $saveAuth);
                $rslt = 'auth';
            }
            else {
                $CONFIG ->getLogClass()->writeLog('Неудачная попытка входа: неверный пароль');
                $rslt = 'wrongpass';
            }
        }
        else {
            $CONFIG ->getLogClass()->writeLog('Неудачная попытка входа: указанный пользователь не существует');
            $rslt = 'nouser';
        }
    }
    else{
        $CONFIG ->getLogClass()->writeLog('Неудачная попытка входа: двойная попытка входа');
        $rslt = 'bootforce';
    }
    echo $rslt;
}

// регистрация 
if(isset($_POST['newLogin'])){
    $newLogin = $_POST['newLogin'];
    $newPass = $_POST['newPassword'];
    // проверяем логин
    if(!preg_match("/^[a-zA-Z0-9]+$/",$newLogin))
    {
        $_SESSION['error'] = "Логин может состоять только из букв английского алфавита и цифр";
    }
    elseif(strlen($newLogin) < 3 || strlen($newLogin) > 30)
    {
        $_SESSION['error'] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }
    elseif($CONFIG ->getUsersModel()->existsUser($newLogin)){
        $_SESSION['error'] = " $newLogin уже существует";
    }
    // добавление пользователя
    else{
        $rslt = $CONFIG ->getUsersModel()->addUser($newLogin, $newPass); 
        logIn($CONFIG ->getUsersModel(), $newLogin);
        if($rslt === 1) $rslt = 'auth';
        else $_SESSION['error'] = " $newLogin: ошибка добавления пользователя";
    }
    // редирект
    if(isset($_SESSION['error'])) 
        header('Location: ../../views/registration_view.php');
    else {
        header('Location: ../../index.php');
    }
}

// Выход
if(isset($_GET['logout'])){
    unset($_SESSION['auth']);
    unset($_SESSION['vk_login']);
    unset($_SESSION['db_login']);
    unset($_SESSION['vktoken']);
    
    setcookie("db_login", "", time()-3600, '/');
    setcookie('vk_login', "", time()-1000, '/');
    setcookie("hash", "", time()-3600, '/');
    setcookie('uservk', "", time()-1000, '/');

    header('Location: ../../index.php');
}