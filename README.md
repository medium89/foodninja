# Генератор ссылок

Веб-приложение на Laravel с личным кабинетом на Filament v3.

Приложение позволяет:

- регистрироваться и входить в аккаунт;
- создавать короткие ссылки;
- переходить по короткой ссылке на оригинальный URL;
- записывать IP-адрес и дату каждого перехода;
- смотреть список своих ссылок;
- смотреть статистику переходов по каждой ссылке;
- удалять свои ссылки.

## Стек

- Laravel
- Filament v3
- Laravel Breeze
- MySQL
- Docker / Laravel Sail

## Требования

На компьютере должны быть установлены:

- Docker
- Docker Compose

PHP, Composer, Node.js и MySQL локально ставить не обязательно, они запускаются в Docker.

## Установка

Клонировать проект и перейти в папку:

```bash
git clone <repository-url>
cd project
```

Скопировать файл окружения:

```bash
cp .env.example .env
```

Установить зависимости Composer:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php85-composer:latest \
    composer install --ignore-platform-reqs
```

Запустить контейнеры:

```bash
docker compose up -d
```

Сгенерировать ключ приложения:

```bash
docker compose exec laravel.test php artisan key:generate
```

Установить frontend-зависимости и собрать assets:

```bash
docker compose exec laravel.test npm install
docker compose exec laravel.test npm run build
```

Запустить миграции:

```bash
docker compose exec laravel.test php artisan migrate
```

## Настройка .env

Основные параметры для локального запуска:

```env
APP_NAME="Генератор ссылок"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000
APP_PORT=8000

APP_LOCALE=ru
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=ru_RU

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password

FORWARD_DB_PORT=3307
```

Пояснение по портам:

- приложение открывается на `http://localhost:8000`;
- MySQL внутри Docker работает на `3306`;
- с компьютера MySQL доступен на `localhost:3307`.

## Демо-данные

Чтобы заполнить базу демонстрационными пользователями, ссылками и кликами:

```bash
docker compose exec laravel.test php artisan db:seed
```

Если нужно полностью пересоздать базу и сразу заполнить демо-данными:

```bash
docker compose exec laravel.test php artisan migrate:fresh --seed
```

## Демо-пользователь

После запуска сидера можно войти под готовым аккаунтом:

```text
email: demo@example.com
password: password
```

У Demo-пользователя уже есть несколько коротких ссылок и история переходов, чтобы можно было сразу проверить интерфейс статистики.

## Основные URL

Главная страница:

```text
http://localhost:8000
```

Регистрация:

```text
http://localhost:8000/register
```

Вход:

```text
http://localhost:8000/login
```

Filament-кабинет:

```text
http://localhost:8000/admin
```

Список коротких ссылок:

```text
http://localhost:8000/admin/short-links
```

## Короткие ссылки

Короткие ссылки работают через публичный маршрут:

```text
http://localhost:8000/{code}
```

Например, после запуска сидера доступны ссылки:

```text
http://localhost:8000/laravel
http://localhost:8000/panel3
http://localhost:8000/offer1
```

При переходе по короткой ссылке приложение:

1. находит запись по коду;
2. сохраняет IP-адрес и дату перехода;
3. перенаправляет пользователя на оригинальный URL.

## Полезные команды

Запустить контейнеры:

```bash
docker compose up -d
```

Остановить контейнеры:

```bash
docker compose down
```

Запустить миграции:

```bash
docker compose exec laravel.test php artisan migrate
```

Запустить сидер:

```bash
docker compose exec laravel.test php artisan db:seed
```

Запустить тесты:

```bash
docker compose exec laravel.test php artisan test
```

Очистить кэш конфигурации:

```bash
docker compose exec laravel.test php artisan config:clear
```
