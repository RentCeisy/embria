<h1 align="center">Embria</h1>

## About Task

Тестовое задание

Имеются таблицы: пользователей, новостей и фотографий
на базе стека Laravel, Vue и postgers(или mysql) реализовать функционал
управления новостями и фотографиями (CRUD)
и возможность пользователем поставить лайк новости или фотографии

Реализация

После настройки как указано ниже можно войти под тестовым аккаунтом. 
Также можно создать свой аккаунт, после авторизации - перекинет на страницу с новостями.
Внимание: Редактировать новость может только автор.

Login: <strong>test@test.com</strong>
Password: <strong>qwertyui</strong>


## Install project for local machine

```bash
    - git clone git@github.com:RentCeisy/embria.git
    - composer install
    - npm install
    - npm run dev
```
Создать .env файл в соответствии со своими настройками.

Migration database:

```bash
    - php artisan migrate
```

DB seeds:

```bash
    - php artisan db:seed
```



