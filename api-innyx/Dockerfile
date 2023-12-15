# Use a imagem oficial do PHP
FROM php:8.2-fpm

# Instale as extensões do PHP necessárias
RUN docker-php-ext-install pdo pdo_mysql

# Instale o Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Defina o diretório de trabalho para o seu aplicativo Laravel
WORKDIR /var/www/html

# Copie o código-fonte do aplicativo para o contêiner
COPY . .

# Instale as dependências do Composer
RUN composer install --no-interaction --no-dev --prefer-dist

# Configure as permissões para o Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Exponha a porta 9000 para o servidor web (pode variar dependendo do seu servidor web)
EXPOSE 9000

# Inicie o servidor PHP-FPM
CMD ["php-fpm"]
