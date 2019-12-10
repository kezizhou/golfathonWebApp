FROM php:7.4.0-apache

# Copy files to container
COPY root /var/www/html

# Start Apache web server
CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]

EXPOSE 80
EXPOSE 443