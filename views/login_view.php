<!-- модальное окно входа -->
<section id='loginInputSection' class='modal'>
    <div class='modalWindow loginWindow'>
        <h3 class='modal__header'> Авторизация</h3>
        <form method="POST" class='loginWindow__form' id='loginWindow__form'>
            <input type='button' class='modal__closeBtn loginWindow__closeBtn' value='x'>

            <div class='loginWindow__formRow'>
                <label for="loginInput" class='loginWindow__label'>Логин:</label>
                <input type='text' class='loginWindow__input loginWindow__loginInput' name='login' id='loginInput' autocomplete='on' value ='user' placeholder="Логин">
            </div> 

            <div class='loginWindow__formRow'>
                <label for="passwordInput" class='loginWindow__label'>Пароль:</label>
                <input type="password" class='loginWindow__input loginWindow__passwordInput' name='password' id='passwordInput' autocomplete='off' value= 'user@@user' placeholder="Пароль">
            </div>

            <div class='loginWindow__formRow loginWindow__btnRow'> 
                <input type='submit' class='loginWindow__btn' id='loginWindow__sendBtn' value='Войти'>
                <input type='button' class='loginWindow__btn' id='loginWindow__regBtn' value='Регистрация'>            
            </div>

            <input type="checkbox" id="loginWindow__saveAuth" class='loginWindow__saveAuth' name="saveAuth" checked/>
            <label for="loginWindow__saveAuth">Запомнить меня</label>
            
            <p class='page-social-btn-text-delimiter'>или войти с помощью</p>
            <a href="http://oauth.vk.com/authorize?<?=$urlQuery?>"><img src="public_html/img/vk-logo.png" alt="Войти через ВК"></a>
            <div class='loginWindow__error hidden'>Ошибка</div>
            <? // auth и токен ?>
            <input type="hidden" name="auth" value=1>
            <input type="hidden" name="token" value="<?=$token?>">

        </form>
    </div>
</section>