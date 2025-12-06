FROM php:8.3-cli

RUN apt-get update \
    && apt-get install -y git unzip sqlite3 libsqlite3-dev pkg-config libssl-dev

RUN docker-php-ext-configure pcntl --enable-pcntl \
&& docker-php-ext-install \
pcntl

RUN pecl install --onlyreqdeps --force redis \
&& rm -rf /tmp/pear \
&& docker-php-ext-enable redis

RUN docker-php-ext-install pdo pdo_sqlite

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libssl-dev \
    libcurl4-openssl-dev \
    libpcre2-dev \
    build-essential \
    && docker-php-ext-install zip \
    && rm -rf /var/lib/apt/lists/*

RUN pecl install swoole \
    && docker-php-ext-enable swoole

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer update

EXPOSE 8000

CMD ["php", "engineer", "server:start"]
