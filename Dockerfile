FROM amazonlinux

# Install Apache, PHP, and MySQL
RUN yum -y update
RUN yum -y install httpd 
RUN amazon-linux-extras install php7.3 

# Copy files to container
COPY root /var/www/html

# Apache user permissions
# RUN chmod 755 -R /var/www/html

# Disable httpd warning
RUN echo "ServerName localhost" >> /etc/httpd/conf/httpd.conf

# Non-privileged user
# USER 1000

# Start httpd and php-fpm services
CMD "/var/www/html/service_start.sh"

EXPOSE 80
EXPOSE 443