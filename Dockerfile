FROM php:7.4.0-apache

# Copy files to container
COPY root /var/www/html

# Create Apache group permissions
RUN chgrp -R apache /var/www/html \
find /var/www/html -type d -exec chmod g=rwxs "{}" + \
find /var/www/html -type f -exec chmod g=rws "{}" +

# Start Apache web server
CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]

EXPOSE 80
EXPOSE 443