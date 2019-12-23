FROM alpine:latest

# Install Apache
RUN apk add apache2

# Disable httpd warning
RUN echo "ServerName localhost" >> /etc/apache2/httpd.conf

# Enable PHP
COPY golfathonapache.conf /etc/apache2/conf.d

# Start httpd service
CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]

EXPOSE 80