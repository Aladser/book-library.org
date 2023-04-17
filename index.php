<?php 
    require_once('config/config.php');
    session_start();
    include 'engine/auth/auth.php';
?>

    <link rel="stylesheet" href="public_html/css/reset_cs.css">
    <link rel="stylesheet" href="public_html/css/general.css">
    <link rel="stylesheet" href="public_html/css/modal.css">
    <link rel="stylesheet" href="public_html/css/header.css">
    <link rel="stylesheet" href="public_html/css/login.css">
    <link rel="stylesheet" href="public_html/css/main-view.css">
    <input type="hidden" id='loginCsrf' value="<?=$wrongCsrf?>">
    
<?php
    include 'views/login_view.php'; 
    include 'views/main_view.php';
?>

    <script type='text/javascript' src='public_html/js/login.js'></script>

