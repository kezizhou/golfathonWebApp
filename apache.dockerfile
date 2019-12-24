FROM alpine:latest

# Install Apache
RUN apk add apache2

# Disable httpd warning
RUN echo "ServerName localhost" >> /etc/apache2/httpd.conf

# Enable PHP
COPY golfathonapache.conf /etc/apache2/conf.d

# Add mobdules
RUN sed -i "s/#LoadModule\ deflate_module/LoadModule\ deflate_module/" /etc/apache2/httpd.conf 

# Start httpd service
CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]

EXPOSE 80