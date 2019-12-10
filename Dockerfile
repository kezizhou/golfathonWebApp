FROM amazonlinux

# Install PApache and PHP
RUN yum- y update \
    yum -y install httpd 
RUN amazon-linux-extras -y install php7.3 

# Copy files to container
COPY root /var/www/html

# Start Apache web server
CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]

EXPOSE 80
EXPOSE 443