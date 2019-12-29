FROM php:7.4-fpm-alpine
# Starts PHP service by default

RUN apk update; \
    apk upgrade;

RUN docker-php-ext-install mysqli

EXPOSE 9000