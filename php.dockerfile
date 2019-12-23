FROM alpine:latest

# Install PHP
RUN apk add php7 php7-fpm

# Replace existing config file to allow Apache listener
COPY www.conf /etc/php7/php-fpm.d/www.conf

# Start php-fpm service
CMD ["/usr/sbin/php-fpm7", "-F", "-R"]

EXPOSE 9000