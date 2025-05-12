FROM php:8.2-apache

RUN apt-get update -qq && \
apt-get install -y --no-install-recommends git zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev && \
docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd && \
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
a2enmod rewrite && \
echo 'ServerName localhost' >> /etc/apache2/apache2.conf

WORKDIR /var/www/html

# Копируем только файлы, необходимые для установки зависимостей
COPY composer.json composer.lock ./

# Установка composer зависимостей
RUN composer install --optimize-autoloader --no-interaction --no-scripts

# Копируем остальные файлы
COPY . .

# Настройка прав
RUN chown -R www-data:www-data /var/www/html && \
chmod -R 775 storage bootstrap/cache

CMD ["apache2-foreground"]
