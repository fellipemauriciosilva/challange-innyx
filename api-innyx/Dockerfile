FROM php:8.0-apache

RUN docker-php-ext-install pdo pdo_mysql

RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf

RUN a2enmod rewrite

EXPOSE 80

COPY . /var/www/html/

ENV APP_ENV=local
ENV APP_KEY=base64:Kzx6bRMB0b+9ymOHVCyoJgAlbTzG8TOq99HzgcAaZ6c=
ENV DB_CONNECTION=mysql
ENV DB_HOST=mysql
ENV DB_PORT=3306
ENV DB_DATABASE=innyx
ENV DB_USERNAME=root
ENV DB_PASSWORD=12345678

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-interaction --no-dev --prefer-dist

RUN php artisan key:generate

CMD ["apache2-foreground"]
