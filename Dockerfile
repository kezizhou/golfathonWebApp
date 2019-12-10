FROM amazonlinux

# Install PApache and PHP
RUN yum update -y \
    yum install -y httpd 
RUN amazon-linux-extras install -y php7.3 

# Copy files to container
COPY root /var/www/html

# Start Apache web server
CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]

EXPOSE 80
EXPOSE 443