# FROM alpine:latest
# FROM httpd:2.4-alpine

# RUN apk update; \
#     apk upgrade;
# # Copy apache vhost file to proxy php requests to php-fpm container
# COPY golfathonapache.conf /usr/local/apache2/conf/golfathonapache.conf
# RUN echo "Include /usr/local/apache2/conf/golfathonapache.conf" \
#     >> /usr/local/apache2/conf/httpd.conf


FROM centos:8

RUN yum update -y
RUN yum install -y httpd

# # Install Apache 
# RUN apk add apache2

# # Disable httpd warning
# RUN echo "ServerName localhost" >> /etc/apache2/httpd.conf

# # Enable PHP
# COPY golfathonapache.conf /etc/apache2/conf.d

# # Add mobdules
# RUN sed -i "s/#LoadModule\ deflate_module/LoadModule\ deflate_module/" /etc/apache2/httpd.conf 

# Start httpd service
CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]

EXPOSE 80