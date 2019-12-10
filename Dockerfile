FROM amazonlinux

# Install PHP and MySQL
RUN yum update -y \
    yum install httpd -y

RUN amazon-linux-extras install php7.3 -y

# Copy files to container
COPY root /var/www/html

# Start Apache web server
# CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]

EXPOSE 80
EXPOSE 443