
## Инсталляция

1. Установка контейнера
    ```
    docker-composer up -d --build
    ```
2. Вход в контейнер
    ```
    docker-compose exec app php
    ````
3. Запуск миграций
    ```
    php artisan migrate
    ```
4. Запуск миграций и сидов
    ```
    php artisan migrate --seed
    ```
5. Сайт будет доступен по URL: http://localhost:8000
