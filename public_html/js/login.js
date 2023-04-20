const openLoginWindowBtn = document.querySelector('#login-btn');         // Кнопка Войти на главной странице 
const loginInputSection = document.querySelector('#loginInputSection');  // модальное окно входа
const loginWindowError = document.querySelector('#loginWindow__error');  // поле ошибки входа
document.querySelector('#loginWindow__regBtn').onclick = () => location.href = '../views/registration_view.php'; // кнопка регистрации
document.querySelector('#modalWindow__closeBtn').onclick = () => {
    loginInputSection.classList.remove('modal_active'); // кнопка закрытия модального окна
    loginWindowError.classList.add('hidden');
}

//Кнопка Открыть модальное окно/Выйти главной страницы
openLoginWindowBtn.onclick = () => {
    if(openLoginWindowBtn.value === 'Войти') 
        loginInputSection.classList.add('modal_active');
    else
        location.href = '/engine/auth/logout.php';
}

//***** авторизация *****//
document.querySelector('#loginWindow__form').addEventListener('submit', function(e){
    e.preventDefault();
    let form = new FormData(this);
    e.target.reset();
    fetch('../engine/auth/auth_db.php', {method: 'POST', body: form}).then(response => response.text()).then(data => {
        if(data !== 'auth') {
            loginWindowError.classList.remove('hidden');
            if(data === 'wrongpass') loginWindowError.innerHTML = 'Неверный пароль';
            else if(data === 'nouser') loginWindowError.innerHTML = 'Пользователь не найден';
            else loginWindowError.innerHTML = 'Двойная попытка входа';
        }
        else{
            location.href = '/index.php';
        }
    });
});

// проверка авторизации вк
if( document.querySelector('#loginCsrf').value !== ''){
    loginWindowError.classList.remove('hidden');
    loginWindowError.innerHTML = 'Двойная попытка входа';
    loginInputSection.classList.add('modal_active');
}

// Проверка на пустоту
let loginInput = document.querySelector('#loginInput');
let passwordInput = document.querySelector('#passwordInput');
let loginSendBtn = document.querySelector('#loginWindow__sendBtn');
const checkInputFields = () => loginSendBtn.disabled = loginInput.value!=='' && passwordInput.value!=='' ? false : true;
checkInputFields();
loginInput.oninput = checkInputFields;
passwordInput.oninput =  checkInputFields;