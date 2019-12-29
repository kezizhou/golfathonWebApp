FROM php:7.4-fpm-alpine

RUN apk update; \
    apk upgrade;

RUN docker-php-ext-install mysqli

# Start php-fpm service
CMD ["/usr/sbin/php-fpm7", "-F", "-R"]

EXPOSE 9000