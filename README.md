# Книжная библиотека

Сайт представляет собой демо-версию сайта книжной коллекции

**engine/auth/auth.php** - авторизация на сайте

**engine/auth/auth_db.php** - регистрация и авторизация через логин - пароль

**engine/auth/auth_vk.php** - авторизация вк

проверка CSRF-токена происходит в **engine/auth/auth_vk_check_csrf.php** для ВК и **engine/auth/auth_db.php** для логина-пароля

Роль пользователя - обычный или ВК - прописывается в сессию и куки при авторизации в **файле engine/auth/auth.php**

В зависимости от роли и авторизации на главной странице разное содержание. Текст показывается всем пользователям, картинки - пользователям ВК.

**engine/MyLogClass.php** - класс записи логов. В проекте записываются неудачные попытки входа

дамп БД в **data**
