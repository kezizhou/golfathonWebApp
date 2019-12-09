FROM amazonlinux

# Install PHP and MySQL
RUN yum update -y \
    yum install -y httpd24 php70 mysql56-server php70-mysqlnd

# Copy files to container
COPY root /var/www/html

# Create Apache group permissions
# RUN chgrp -R www-data /var/www/html \
#     find /var/www/html -type d -exec chmod g+rx {} + \
#     find /var/www/html -type f -exec chmod g+r {} + 

# Start Apache web server
ENTRYPOINT ["/usr/sbin/httpd", "-D", "FOREGROUND"]

EXPOSE 80
EXPOSE 443