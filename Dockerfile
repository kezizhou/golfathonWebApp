FROM php:7.4.0-apache

# Copy files to container
COPY root /var/www/html

# Apache user permissions
RUN chmod 755 -R /var/www/html

# Disable httpd warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Start Apache web server
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]

EXPOSE 80
EXPOSE 443