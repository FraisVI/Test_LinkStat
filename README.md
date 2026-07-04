# LinkStat

Laravel-приложения для тестового задания: сервис коротких ссылок со статистикой переходов и личным кабинетом.

## Стек

- PHP 8.2
- Laravel 11
- FilamentPHP 3
- Nginx
- MySQL 8.4
- Docker Compose

## Запуск через Docker

Создать `.env`, если файла еще нет:

```bash
cp .env.example .env
```

Собрать и запустить контейнеры:

```bash
docker-compose up -d --build
```

Установить зависимости внутри контейнера, если папки `vendor/` нет:

```bash
docker-compose exec app composer install
```

Сгенерировать ключ приложения:

```bash
docker-compose exec app php artisan key:generate
```

Выполнить миграции:

```bash
docker-compose exec app php artisan migrate
```

Открыть приложение:

```text
http://localhost:8080
```

Личный кабинет:

```text
http://localhost:8080/cabinet
```

## База данных

Настройки базы данных для Docker уже указаны в `.env.example`:

```text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=linkstat
DB_USERNAME=linkstat
DB_PASSWORD=secret
```
