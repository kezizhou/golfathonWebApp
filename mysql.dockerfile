# FROM alpine:latest
# FROM mysql:8.0

FROM centos:8

RUN yum install mysql56-server

# Start mysql service
# CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]

EXPOSE 3306