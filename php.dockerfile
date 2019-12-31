# Installs PHP service by default
FROM php:7.4-fpm-alpine

RUN apk update; \
    apk upgrade;

# Required for mysqli functions
RUN docker-php-ext-install mysqli

# Turn on output buffering
RUN echo "output_buffering = On" \
    >> /usr/local/etc/php/php.ini-development
RUN echo "output_buffering = On" \
    >> /usr/local/etc/php/php.ini-production

# Start php-fpm service
CMD ["/usr/local/sbin/php-fpm", "-F", "-R"]

EXPOSE 9000