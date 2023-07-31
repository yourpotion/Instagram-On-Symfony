# Установка базового образа
FROM php:8.1-apache

# Копирование и установка зависимостей
COPY . /var/www/html
WORKDIR /var/www/html

# Установка необходимых пакетов
RUN apt-get update \
    && apt-get install -qq -y --no-install-recommends \
       cron vim locales coreutils apt-utils git libicu-dev g++ libpng-dev libxml2-dev libzip-dev libonig-dev libxslt-dev \
    && rm -rf /var/lib/apt/lists/*

# Настройка локали
RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && \
    echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen && \
    locale-gen

# Установка Composer
RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
   mv composer.phar /usr/local/bin/composer

# Установка и настройка расширений PHP
RUN docker-php-ext-configure intl
RUN docker-php-ext-install pdo pdo_mysql mysqli gd opcache intl zip calendar dom mbstring zip gd xsl && a2enmod rewrite
RUN pecl install apcu && docker-php-ext-enable apcu

# Установка RabbitMQ расширения
RUN curl -sSL https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions -o /usr/local/bin/install-php-extensions
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions amqp

# Настройка Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Установка зависимостей проекта
RUN composer install --no-scripts --no-autoloader

# Копирование файла .env
COPY .env /var/www/html/.env

# Установка прав доступа
RUN chown -R www-data:www-data /var/www/html

# Открытие порта
EXPOSE 8005

# Команда запуска приложения
CMD ["apache2-foreground"]