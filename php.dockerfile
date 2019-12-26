# FROM alpine:latest
# FROM php:7.4-fpm-alpine

# RUN apk update; \
#     apk upgrade;

# RUN docker-php-ext-install mysqli

FROM centos:8

RUN yum install php70 php70-mysqlnd mysql56-server


# # Install PHP
# RUN apk add php7 php7-fpm

# # Replace existing config file to allow Apache listener
# COPY www.conf /etc/php7/php-fpm.d/www.conf

# # Start php-fpm service
# CMD ["/usr/sbin/php-fpm7", "-F", "-R"]

EXPOSE 9000