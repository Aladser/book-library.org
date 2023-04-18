<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Книги</title>
</head>

<body>
    <header class='header'>
        <p class='header__title'>Книги</p>
        <!-- кнопка войти-выйти -->
        <?php if(isset($_SESSION['auth'])): ?>
            <input type="button" class='page-btn header__login-btn' id='login-btn' value='Выйти'>
            <div class='header__username' id='header__username'><?=$user?></div>
        <?php else: ?>
            <input type="button" class='page-btn header__login-btn' id='login-btn' value='Войти'>
        <?php endif; ?>
    </header>
    <main>
        <?php if(!isset($_SESSION['auth'])): ?>
            <div class='main-info'>
                <h3 class='main-info__header'>Книжная библиотека</h3>
                <p class='main-info__text'>Авторизуйтесь, чтобы увидеть вашу библиотеку</p>
            </div>
        <?php else: ?>       
            <?php include 'library_view.php'; ?>
        <?php endif; ?>
    </main>
</body>

</html>