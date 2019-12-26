# FROM alpine:latest
# FROM mysql:8.0

FROM centos:8

RUN yum install wget
RUN wget http://repo.mysql.com/mysql80-community-release-el6-1.noarch.rpm
RUN rpm -Uvh mysql80-community-release-el6-1.noarch.rpm
RUN yum update -y
RUN yum install -y mysql56-server

# Start mysql service
# CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]

EXPOSE 3306