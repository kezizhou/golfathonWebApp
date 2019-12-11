FROM amazonlinux

# Install Apache and PHP
RUN yum -y update
RUN yum -y install httpd 
RUN amazon-linux-extras install php7.3 

# Copy files to container
COPY root /var/www/html

# Apache user permissions
RUN chmod 755 -R /var/www/html

# Disable httpd warning
RUN echo "ServerName localhost" >> /etc/httpd/conf/httpd.conf

# Non-privileged user
USER 1000

# Start Apache web server
CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]

EXPOSE 80
EXPOSE 443