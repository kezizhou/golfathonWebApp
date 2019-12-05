#
# Cookbook:: golfathonWebApp
# Recipe:: install
#
# Copyright:: 2019, Keziah Zhou, All Rights Reserved.

execute 'Get files from S3' do
    command "aws s3 cp s3:://golfathon-web-app-dev/ #{node['phpInstall']['htmlRootDir'l} --recursive"
    not_if { ::File.exist?("#{node['phpInstall']['htmlRootDir'l}/default_site") }
end

# yum update -y
# yum install -y httpd24 php70 mysql56-server php70-mysqlnd
# service httpd start
# chkconfig httpd on
# group add dev
# usermod -a -G dev ec2-user
# chgrp -R dev /var/www
# sudo chmod 2775 /var/www
# find /var/www -type d -exec sudo chmod 2775 {}
# find /var/www -type f -exec sudo chmod 0664 {} 