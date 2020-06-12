FROM php:7.2.31-cli

RUN apt-get update && \
    apt-get install -y --no-install-recommends zlib1g-dev zip unzip && \
    docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
