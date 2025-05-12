
## Инсталляция
1. Клонируем репозиторий
   ```
    git clone https://github.com/Herman461/laravel-rs-app
    ```
2. Установка контейнера
    ```
    docker-composer up -d --build
    ```
3. Вход в контейнер
    ```
    docker-compose exec app bash
    ````
4. Запуск миграций и сидов
    ```
    php artisan migrate --seed
    ```
5. Сайт будет доступен по URL: http://localhost:8000
