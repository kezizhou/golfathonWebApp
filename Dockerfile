FROM amazonlinux

USER root

# Install PHP and MySQL
RUN yum update -y \
    yum install httpd24 php70 mysql56-server php70-mysqlnd

# Start Apache web server
RUN service httpd start \
    chkconfig httpd on

# Copy files to container
COPY root /var/www/html

# Create dev group and add permissions
RUN group add dev \
    usermod -a -G dev ec2-user \ 
    chgrp -R dev-golfathon /var/www/html \
    chmod -R 2774 /var/www/html

EXPOSE 80

USER golfathonUser