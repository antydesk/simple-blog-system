<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/dunglas/frankenphp">
        <img src="https://img.shields.io/github/stars/dunglas/frankenphp.svg" alt="GitHub Stars">
    </a>
    <a href="https://packagist.org/packages/dunglas/frankenphp">
        <img src="https://img.shields.io/packagist/v/dunglas/frankenphp.svg" alt="Latest Version">
    </a>
    <a href="https://github.com/dunglas/frankenphp/blob/main/LICENSE">
        <img src="https://img.shields.io/github/license/dunglas/frankenphp.svg" alt="License">
    </a>
</p>

---

## 📘 Описание проекта

RESTful API, разработанный с использованием **Laravel**, аутентификация реализована через **Laravel Passport**.
Присутствует поддержка **Swagger** для автоматической генерации документации.

---

### Стек

- Laravel ^12
- PHP ^8.4
- Laravel Passport ^12
- L5 Swagger ^9.0
- Spatie Laravel Data ^4
- Тестирование через Laravel Feature Tests

## 🚀 Установка

1. Клонируйте репозиторий:
   ```bash
   git clone git@github.com:antydesk/simple-blog-system.git
   cd simple-blog-system
   ```

2. Установите зависимости:
   ```bash
   composer install
   ```

3. Скопируйте `.env`:
   ```bash
   cp .env.example .env
   ```

4. Сгенерируйте ключ приложения:
   ```bash
   php artisan key:generate
   ```

5. Настройте базу данных в `.env`, затем выполните миграции:
   ```bash
   php artisan migrate
   ```

6. Установите Passport:
   ```bash
   php artisan passport:install
   ```

7. Добавьте в `.env`: (Используйте пункт 2 в секции Laravel Passport для создания отдельного клиента для Password Grant:)
   ```env
   PASSPORT_PERSONAL_ACCESS_CLIENT_ID=client-id
   PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET=client-secret
   ```
# Laravel Passport

1. Создать ключи шифрования и стандартных клиентов:
 ```bash
    php artisan passport:key
```

2. Создать отдельного клиента для Password Grant:
 ```bash
    php artisan passport:client --password
```

3. Создать клиента для Personal Access Token:
 ```bash
    php artisan passport:client --personal
```
---

## 📚 API Маршруты

### Аутентификация

| Метод | URI                   | Middleware | Описание                                    |
|-------|-----------------------|------------|---------------------------------------------|
| POST  | `/auth/register`      | -          | Регистрация                                 |
| POST  | `/auth/login`         | -          | Авторизация                                 |
| POST  | `/auth/logout`        | `auth:api` | Выход                                       |
| POST  | `/auth/refresh-token` | -          | Обновление токена                           |
| GET   | `/auth/me`            | `auth:api` | Получение информации о текущем пользователе |

### Пользователи (требует `auth:api`)

| Метод  | URI                       |
|--------|---------------------------|
| GET    | `/api/v1/users/{user_id}` |
| PUT    | `/api/v1/users/{user_id}` |
| DELETE | `/api/v1/users/{user_id}` |

### Посты (вложенные маршруты `/users/{user_id}/posts`)

| Метод  | URI                                |
|--------|------------------------------------|
| GET    | `/api/v1/users/{user_id}/posts`           |
| GET    | `/api/v1/users/{user_id}/posts/{post_id}` |
| POST   | `/api/v1/users/{user_id}/posts`           |
| PUT    | `/api/v1/users/{user_id}/posts/{post_id}` |
| DELETE | `/api/v1/users/{user_id}/posts/{post_id}` |

### Комментарии (вложенные маршруты `/posts/{post_id}/comments`)

| Метод  | URI                                                               |
|--------|-------------------------------------------------------------------|
| GET    | `/api/v1/users/{user_id}/posts/{post_id}/comments`                       |
| GET    | `/api/v1/users/{user_id}/posts/{post_id}/comments/{comment_id}`          |
| POST   | `/api/v1/users/{user_id}/posts/{post_id}/comments`                       |
| PUT    | `/api/v1/users/{user_id}/posts/{post_id}/comments/{comment_id}`          |
| DELETE | `/api/v1/users/{user_id}/posts/{post_id}/comments/{comment_id}`          |
| GET    | `/api/v1/users/{user_id}/posts/{post_id}/comments/{comment_id}/children` |


## Лайки на посты (вложенные маршруты `/posts/{post_id}/likes`)

| Метод | URI                                                  |
|--------|------------------------------------------------------|
| POST   | `/api/v1/users/{user_id}/posts/{post_id}/likes`     |
| GET    | `/api/v1/users/{user_id}/posts/{post_id}/likes`     |

## Лайки на комментарии (вложенные маршруты `/comments/{comment_id}/likes`)

| Метод | URI                                                                 |
|--------|----------------------------------------------------------------------|
| POST   | `/api/v1/users/{user_id}/posts/{post_id}/comments/{comment_id}/likes` |
| GET    | `/api/v1/users/{user_id}/posts/{post_id}/comments/{comment_id}/likes` |

---

## 🚀 Запуск проекта
   ```bash
   php artisan serve
   ```

## 📚 Документация API

Swagger-документация доступна по адресу:
   ```cp
   /api/documentation
   ```

## 🧪 Тестирование

Для тестирования API можно использовать Postman или Insomnia. Не забудьте указать заголовок
`Authorization: Bearer {access_token}` для защищённых маршрутов.


Для запуска тестов необходимо создать файл `.env.testing` с параметрами для тестового окружения. Вы можете использовать следующие настройки как пример:

1. Создайте файл `.env.testing` в корне проекта.
   ```bash
   cp .env.example .env.testing
   ```
2. Сгенерируйте ключ приложения:
    ```bash
    php artisan key:generate
    ```

3. Добавьте в него настройки для тестирования:

```dotenv
APP_ENV=testing
DB_CONNECTION=mysql
DB_DATABASE=testing_db

LOG_CHANNEL=testlog
LOG_STACK=single
```

4. затем выполните миграции:
   ```bash
   php artisan migrate --env=testing
   ```

5. Для запуска Feature тестов
   ```bash
   php artisan test
   ```

---
