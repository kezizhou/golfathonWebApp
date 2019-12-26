# FROM alpine:latest
# FROM mysql:8.0

FROM centos:8

RUN rpm -Uvh mysql80-community-release-el6-1.noarch.rpm
RUN yum update
RUN yum install mysql56-server

# Start mysql service
# CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]

EXPOSE 3306