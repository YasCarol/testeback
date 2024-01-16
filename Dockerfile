FROM php:8.2.12-fpm-alpine

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apk update
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    krb5-dev \
    imap-dev \
    openssl-dev \
    autoconf \
    build-base \
    shadow

# Install PHP extensions
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl

RUN docker-php-ext-install  soap imap zip gd bcmath pcntl

RUN pecl install mongodb mailparse redis

RUN docker-php-ext-enable mongodb mailparse redis

# Get latest Composer
COPY --from=composer:2.1.12 /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www/html

USER $user

EXPOSE 9000