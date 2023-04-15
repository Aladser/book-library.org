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
            <container class='library-container'>
                <div class='book'>
                    <?php if($userRole === 'uservk'): ?>
                         <div class='book_image-block'>
                            <img class='book_image' src="data/img/pikovaya_dama.jpeg" alt="Пиковая дама">
                        </div>
                    <?php endif; ?>
                    <br>
                    <div class='book__info'>
                    <p class='book__header'>
                        <span class='book__author'>Александр Пушкин</span>
                        &nbsp;-&nbsp;
                        <span class='book__name'>Пиковая дама</span>
                    </p>
                    <br>
                    <p class='book__desciption'>
                        Успех повести "Пиковая дама" начался с первого издания в 1834 году в журнале "Библиотека для чтения", не утихает он и сегодня. 
                        Три заветные игральные карты, некогда принесшие крупный выигрыш графине, не оставляют в покое Германна. Одержимый их разгадкой, 
                        непрошеный гость дожидается возвращения графини у неё дома, где и совершается непоправимое. 
                        Монохромные иллюстрации Дементия Алексеевича Шмаринова создают атмосферу мистического зимнего Петербурга, где Германн, 
                        во власти страстей, искушает свою судьбу. Вереница событий приводит к исходу, фатальному для главного героя.
                    </p>
                    </div>
                </div>
                <div class='book'>
                    <?php if($userRole === 'uservk'): ?>
                        <div class='book_image-block'>
                            <<img class='book_image' src="data/img/buduschee.jpeg" alt="Будущее">
                        </div>
                    <?php endif; ?>
                    <br>
                    <div class='book__info'>
                    <p class='book__header'>
                        <span class='book__author'>Дмитрий Глуховский</span>
                        &nbsp;-&nbsp;
                        <span  class='book__name'>Будущее</span>
                    </p>
                    <br>
                    <p class='book__desciption'> 
                        НА ЧТО ТЫ ГОТОВ РАДИ ВЕЧНОЙ ЖИЗНИ? Уже при нашей жизни будут сделаны открытия, которые позволят людям оставаться вечно молодыми. 
                        Смерти больше нет. Наши дети не умрут никогда. Добро пожаловать в будущее. В мир, населенный вечно юными, совершенно здоровыми, счастливыми людьми. 
                        Но будут ли они такими же, как мы? Нужны ли дети, если за них придется пожертвовать бессмертием? Нужна ли семья тем, кто не может завести детей? 
                        Нужна ли душа людям, тело которых не стареет?.
                    </p>
                    </div>
                </div>
                <div class='book'>
                    <?php if($userRole === 'uservk'): ?>
                        <div class='book_image-block'>
                            <img class='book_image' src="data/img/zelenaya_milya.jpeg" alt="Зеленая миля">
                        </div>
                    <?php endif; ?>
                    <br>
                    <div class='book__info'>
                    <p class='book__header'>
                        <span class='book__author'>Стивен Кинг</span>
                        &nbsp;-&nbsp;
                        <span  class='book__name'>Зеленая миля</span>
                    </p>
                    <br>
                    <p class='book__desciption'>
                        Стивен Кинг приглашает читателей в жуткий мир тюремного блока смертников, откуда уходят, чтобы не вернуться, 
                        приоткрывает дверь последнего пристанища тех, кто преступил не только человеческий, но и Божий закон. 
                        По эту сторону электрического стула нет более смертоносного местечка! Ничто из того, что вы читали раньше, не сравнится с 
                        самым дерзким из ужасных опытов Стивена Кинга — с историей, что начинается на Дороге Смерти и уходит в глубины самых чудовищных тайн 
                        человеческой души...
                    </p>
                    </div>
                </div>
            </container>
        <?php endif; ?>

    </main>
</body>

</html>