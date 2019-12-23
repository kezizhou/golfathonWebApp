FROM alpine:latest

# Install Apache
RUN apk add apache2

# Apache user permissions
# RUN chmod 755 -R /var/www/localhost/htdocs

# Disable httpd warning
RUN echo "ServerName localhost" >> /etc/apache2/httpd.conf

# Enable PHP
COPY golfathonapache.conf /etc/apache2/conf.d

# Non-privileged user
# USER 1000

# Start httpd service
CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]

EXPOSE 80