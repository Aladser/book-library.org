<!-- модальное окно входа -->
<container id='loginInputSection' class='modal'>
    <container class='modalWindow loginWindow'>
        <input type='button' class='modalWindow__closeBtn' id='modalWindow__closeBtn' value='x'>
        <h3 class='loginWindow__header'> Авторизация</h3>

        <form method="POST" class='loginWindow__form' id='loginWindow__form'>
            <input type='text' class='loginWindow__input loginWindow__loginInput' name='db_login' id='loginInput' value ='user' placeholder="Логин">
            <br>
            <input type="password" class='loginWindow__input loginWindow__passwordInput' name='password' id='passwordInput' value= 'user@@user' placeholder="Пароль">
            <br>
            <input type='submit' class='loginWindow__btn' id='loginWindow__sendBtn' value='Войти'>
            <br>
            <input type='button' class='loginWindow__btn' id='loginWindow__regBtn' value='Регистрация'> 
            <br>
            <input type="checkbox" class='loginWindow__saveAuth' id="loginWindow__saveAuth" name="saveAuth" checked/>
            <label for="loginWindow__saveAuth">Запомнить меня</label>   
            <p class='loginWindow__error hidden' id='loginWindow__error'>Ошибка</p>         
            <? // auth и токен ?>
            <input type="hidden" name="auth" value=1>
            <input type="hidden" name="token" value="<?=$token?>">
        </form>

        <p class='page-social-btn-text-delimiter'>или войти с помощью</p>

        <form method="POST" class='authvkForm' action="/engine/auth/auth_vk_check_csrf.php">
            <input type="hidden" name="token" value="<?=$token?>">
            <input type="submit" class='authvkForm__submit' value=''>
        </form>
    </container>
</container>