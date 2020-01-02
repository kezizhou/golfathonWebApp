# Installs PHP service by default
FROM php:7.4-fpm-alpine

RUN apk update; \
    apk upgrade;

# Required for mysqli functions
RUN docker-php-ext-install mysqli

# Start php-fpm service
CMD ["/usr/local/sbin/php-fpm", "-F", "-R"]

EXPOSE 9000