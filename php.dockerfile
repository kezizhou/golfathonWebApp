FROM alpine:latest

# Install PHP
RUN apk add php7 php7-fpm

# Replace existing config file to allow Apache listener
COPY www.conf /etc/php7/php-fpm.d/www.conf

# PHP user permissions
# RUN chmod 755 -R /var/www/localhost/htdocs

# Non-privileged user
# USER 1000

# Start php-fpm service
CMD ["/usr/sbin/php-fpm7", "-F", "-R"]

EXPOSE 9000