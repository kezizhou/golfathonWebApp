FROM alpine:latest

# Install PHP
RUN apk add php7 php7-fpm

# PHP user permissions
# RUN chmod 755 -R /var/www/localhost/htdocs

# Non-privileged user
# USER 1000

# Start php-fpm service
CMD ["/usr/sbin/php-fpm7", "-D", "FOREGROUND"]